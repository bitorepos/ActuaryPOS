# RetailMan Connector API for Kustoma

This document describes the Connector read APIs and the Kustoma source export/webhook support added in this code version. The new snapshot and webhook management APIs become available only after deploying the code and running the Connector module migrations. They are not evidence that the live Kustoma tenant has already been updated.

## Base URL and authentication

Use the RetailMan tenant's configured application URL as `{RETAILMAN_BASE_URL}`. The source base URL must be confirmed for the target tenant before sending it to Kustoma.

All endpoints below use OAuth2 Bearer tokens issued by Laravel Passport. The existing Connector client setup creates password-grant clients. The current Scribe guidance uses `POST {RETAILMAN_BASE_URL}/oauth/token` with `grant_type=password`, `client_id`, `client_secret`, the integration user's `username` and `password`, and `scope` set to `*`. Send the returned `access_token` as `Authorization: Bearer <token>`. Use a dedicated least-privilege integration user for server-to-server access; mobile app credentials alone are not a separate machine identity. Never send client secrets or user passwords by ordinary email.

The token response includes `access_token`, `refresh_token`, and `expires_in`. Renew an expired or soon-to-expire access token by posting form-encoded fields to the same `/oauth/token` endpoint with `grant_type=refresh_token`, `refresh_token`, `client_id`, and `client_secret`; use the new token values returned in the response. Keep both tokens and client credentials in a secrets manager, and revoke the integration user/client when the integration is decommissioned. Connector API access also requires the authenticated user's business to have an active package that includes Connector Module.

The API limiter is 120 requests per minute, keyed by authenticated user ID (or IP before authentication). This is the application throttle, not a throughput commitment. Reverse proxies or tenant-specific hosting may add limits.

## Existing read endpoints

All existing paths are relative to `{RETAILMAN_BASE_URL}`:

| Method and path | Purpose |
|---|---|
| `GET /connector/api/product` | Paginated product records with variants, stock-by-location details, category, image URL, and price/group-price fields. |
| `GET /connector/api/product/{ids}` | Fetch comma-separated product IDs. |
| `GET /connector/api/variation` | Paginated sellable variation records, stock details, image URL, category, default selling price, and optional selling-price-group data. |
| `GET /connector/api/business-location` | Business location IDs and branch details for mapping. |

The product list accepts `page`, `per_page` (default 10; `-1` disables pagination and is not recommended for large exports), `location_id`, `category_id`, `sub_category_id`, `brand_id`, `sku`, `name`, `order_by`, `order_direction`, and `selling_price_group=1`. The variation endpoint accepts `page`, `per_page`, `product_id`, `location_id`, category/brand filters, `sku`, `name`, and `selling_price_group=1`.

Both product and variation list queries accept `updated_at` in a parseable date/time format and return records with later product/variation/group-price timestamps. This is timestamp filtering, not a durable change log: consumers should overlap polling windows and deduplicate by stable IDs. Soft-deleted products are included in product reads; consumers should inspect `is_inactive` and deletion fields where returned. Variation IDs and product IDs are RetailMan database IDs; SKUs/sub-SKUs are strings. Product `barcode_type` identifies the barcode symbology, not a separate barcode value. Image URLs depend on the tenant's public asset configuration.

Pagination uses Laravel's `data`, `links`, and `meta` shape. Do not request `per_page=-1` for a large production catalogue.

## Kustoma snapshot export

`GET /connector/snapshots?source_account_id={assigned-account-id}` creates a materialized export. It returns `contract`, `source_account_id`, `snapshot_id`, `events`, and `next_cursor`. Follow-up requests pass the same account and snapshot IDs plus the returned numeric cursor:

`GET /connector/snapshots?source_account_id=...&snapshot_id=...&cursor=2`

Pages contain at most 100 events by default; configure with `CONNECTOR_SNAPSHOT_PAGE_SIZE` (maximum 100). Snapshot records expire after 60 minutes by default (`CONNECTOR_SNAPSHOT_TTL_MINUTES`). A missing or expired snapshot returns HTTP 410; restart the export. Snapshot payload pages are materialized and repeatable after creation, though the source database is read over multiple chunks while the export is first built, so this is not a cross-table transactional point-in-time snapshot.

Source account and location identifiers are stable external-ID mappings. Defaults are `business-{id}` and `location-{id}`. A business administrator can set the Kustoma-assigned account/location IDs before export:

- `GET /connector/external-ids`
- `POST /connector/external-ids` with `{ "resource_type": "business|location", "resource_id": 123, "external_id": "assigned-id" }`

Mapping IDs must be configured before the first export and kept stable; existing mappings cannot be changed through the API. The snapshot emits `normalised-v2` catalogue, product-created, default price, and stock events. Prices use the business currency and tax-inclusive values. A location price is emitted when that location is assigned to an explicit selling-price group with a resolvable variation price. Kustoma's draft allows at most 50 variants in one product event; products outside that constraint need a revised contract before export.

Known field limitations to validate in Kustoma staging: RetailMan has barcode symbology but no general primary/additional barcode value in the exposed product schema; variant attributes are derived from RetailMan variation labels; image export includes the primary product image when its URL is HTTPS; tags, collections, and additional images are not currently represented. Available quantity reflects the stored `qty_available` balance and does not calculate a separate reservations deduction. Negative balances are exported as zero, and non-stock-tracked products need an agreed availability policy. Outlet price groups shared by multiple outlets cannot be safely expressed as a unique outlet override by the webhook path. Kustoma's draft caps imports at 20,000 events; a full export can contain multiple events per sellable item-location record and may exceed that cap, so the proposed 20,000-record scale needs a staging load test and possibly a higher Kustoma import limit.

## Outbound webhooks

After migrations, a business administrator can create a subscription with `POST /connector/webhooks`:

```json
{
  "name": "Kustoma staging",
  "endpoint_url": "https://receiver.example/events",
  "event_types": ["product.created", "product.updated", "product.deactivated", "inventory.updated", "price.updated"]
}
```

The response returns a generated signing secret once. Store it securely. Subscriptions can be listed with `GET /connector/webhooks` and removed with `DELETE /connector/webhooks/{id}`. Endpoints must use HTTPS and resolve to a public IP address. The sender posts one JSON event per request and signs `timestamp + "." + raw_request_body` with HMAC-SHA256. Headers are `X-RetailMan-Event-Id`, `X-RetailMan-Timestamp`, and `X-RetailMan-Signature: sha256=<hex>`.

The event types captured by the current model hooks are product create/update/deactivation, product category/brand changes, inventory row changes, default variation price changes, and explicit variation group price changes where one location maps unambiguously to the group. Revisions are monotonic per resource stream and shared between snapshots and webhooks. Delivery is at least once when an asynchronous queue is configured; the receiver should deduplicate event IDs and ignore stale revisions. A 2xx response marks delivery successful. Failures retry up to 8 total attempts with configured backoff (5s, 15s, 30s, 60s, 120s, 5m, 10m, 20m), honoring a valid `Retry-After` when present. Inspect delivery records with `GET /connector/webhooks/outbox`; replay a failed or pending record with `POST /connector/webhooks/outbox/{id}/replay`.

The production deployment must use a functioning asynchronous Laravel queue worker for delivery and retries. The repository's default queue is `sync`; while it remains selected, captured events stay pending in the outbox and automatic delivery/replay is disabled. Delivery latency is therefore not guaranteed by code alone. Direct SQL/bulk updates that bypass Eloquent model events are not captured; polling the existing API remains necessary as reconciliation. No rate/throughput SLA or 30-second delivery commitment is established by this implementation.

## Operational configuration

Optional environment settings:

```dotenv
CONNECTOR_SNAPSHOT_PAGE_SIZE=100
CONNECTOR_SNAPSHOT_TTL_MINUTES=60
CONNECTOR_WEBHOOK_TIMEOUT_SECONDS=5
CONNECTOR_WEBHOOK_MAX_ATTEMPTS=8
```

Run the normal Laravel deployment migration process to create Connector external-ID, snapshot, webhook subscription, and outbox tables. Configure a database/Redis queue and worker before enabling a production webhook. Use an HTTPS receiver URL, exchange the signing secret through an approved secure channel, confirm Kustoma's assigned account/location IDs, and validate connection, import, price, stock, retry, and replay behavior in the Kustoma staging tenant before production use.
