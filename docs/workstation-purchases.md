# Workstation purchase invoices, returns, and payments

With `IS_OFFLINE=true`, users with `purchase.create` can open **Purchases → Add Purchase**, and users with `purchase_returns.create` can create **Purchase Returns**. PI and PR numbers are generated automatically; use the second reference field for the supplier's invoice number. Users with `purchase.payments` can add PP to workstation purchases and PRP to workstation purchase returns.

The active environment must contain `LOCATION_ID` and `STATION_ID`. Leading zeroes are preserved. With both IDs set to `01`, the standard PI/PP and PR/PRP prefixes, year enabled, separator `-`, and counter 1, references are:

```
PI2026-0101000001
PP2026-0101000001
PR2026-0101000001
PRP2026-0101000001
```

The six-digit counter remains scoped by the existing business/location/year settings. Each workstation must have its own station ID. Online numbering is unchanged. With year disabled, the examples become `PI-0101000001`, `PP-0101000001`, `PR-0101000001`, and `PRP-0101000001`.

## Install on the cloud

Deploy the changed application files to both installations. On the cloud, keep `IS_OFFLINE=false` and apply the new migration to the intended tenant database:

```sh
php artisan migrate --path=database/migrations/2026_09_05_190000_create_workstation_purchase_syncs_table.php --force
```

Use the deployment's normal tenant selection (`TENANT_DOMAIN`) when needed. Refresh configuration/routes through the normal deployment process if cached.

The cloud Connector receives `POST /connector/api/workstation-purchases` through the existing authenticated Connector route group. Its token must belong to the same business and have `access_offline_module`, `purchase.create` (or `purchase_returns.create` for returns), and, when uploading PP/PRP, `purchase.payments`. Location permissions are checked on both sides.

## Upload

### Cloud route not found (HTTP 404 / 405)

If authentication works but `connector/api/workstation-purchases` is not found, the cloud receiver has not been deployed or its route cache is stale. Changing the workstation environment or regenerating the token does not install the receiver.

Deploy the application revision containing these files to the cloud using the normal release process:

- `modules/Connector/Routes/api.php`
- `modules/Connector/Http/Controllers/Api/WorkstationPurchaseController.php`
- `app/Services/WorkstationPurchaseSyncService.php`
- `app/Services/WorkstationSyncSupport.php`
- `database/migrations/2026_09_05_190000_create_workstation_purchase_syncs_table.php`

The route file also registers the expense receiver, so deploy the full revision, including `WorkstationExpenseController.php`, `WorkstationExpenseSyncService.php`, and its migration, rather than copying only the route file.

From the cloud application directory, select the intended tenant (for example, `export TENANT_DOMAIN=testing.actuarypos.com` on Linux), keep its `IS_OFFLINE=false`, then run:

```sh
php artisan migrate --path=database/migrations/2026_09_05_190000_create_workstation_purchase_syncs_table.php --force
php artisan migrate --path=database/migrations/2026_09_05_190100_create_workstation_expense_syncs_table.php --force
php artisan route:clear
php artisan route:list --path=workstation-purchases
php artisan route:list --path=workstation-expenses
```

Both route listings must show a POST route. Rebuild route/config caches according to the deployment's tenant-aware release process, then retry Sync on the workstation. Failed uploads remain pending; do not manually set `sync_date`.

Configure the existing cloud authorization (`SUBDOMAIN_ADDRESS` / `ACCESS_TOKEN`) through the workstation's synchronization setup. Ensure the supplier, products, variations, taxes, units, and payment accounts already exist on the cloud.

Open **Synchronization → Upload Synchronization → Purchase Invoices, Returns and Payments (PI / PR / PP) → Sync**. The browser continues through batches and displays failures. A failed upload stays pending; retrying an acknowledged or interrupted upload does not create duplicate stock or payments. Later direct payments on the same PI or PR are included on the next sync.

The receiver creates PI / PR, purchase lines, stock adjustments (increases for received purchases, decreases for returns), payment/account events, payment status, and the source mapping in one database transaction. It preserves PI/PP and PR/PRP references and assigns cloud primary keys. Stored purchase quantity already includes free quantity and unit conversion, so these are not applied twice.

## Current scope

- Uploads new workstation PI, PR, and their linked direct PP/PRP. It does not download purchases or upload standalone supplier advances/unallocated payments.
- A PI, PR, PP, or PRP changed/deleted after upload is reported as a reconciliation conflict; existing cloud records are not replaced. Purchase Edit is available offline with `purchase.update`; the existing edit-window and return restrictions still apply. Delete remains hidden offline.
- Advance/contact allocations are rejected with an explanatory sync error.
- File attachments, purchase-order/requisition links, and cash-register reconciliation are outside this upload. Existing register synchronization remains separate.
- Existing cloud references without a matching workstation source record are reported as collisions, rather than silently adopted.

## Verification

```sh
php vendor/bin/phpunit --do-not-cache-result tests/Unit/WorkstationPurchaseSyncTest.php
```

These tests use an isolated SQLite database. No cloud account or business database is used by the tests.
