# Workstation expenses and expense payments

With `IS_OFFLINE=true`, the **Expenses** menu is available under the existing expense module and user permissions. Users with `expense.add` can create expenses. Users with `expense.payments` can add payments to finalized expenses created by this workstation.

Adding expense categories or subcategories is disabled offline: the Add button is hidden and both create/save endpoints return HTTP 403. Create categories on the cloud and download them to the workstation.

## Download expense categories

Open **Synchronization > Download Synchronization > Expense Categories and Subcategories > Sync**. This uses the configured cloud address/token and existing `GET /connector/api/expense-categories` endpoint; no additional cloud migration is required for category downloads. The workstation requires `access_offline_module` permission and verifies that the cloud token belongs to the same business.

The download preserves cloud IDs and parent relationships, adds missing categories, updates names/codes/budgets, and restores matching active cloud categories that were soft-deleted locally. Validation or cross-business ID conflicts roll back the entire import. Repeated downloads are safe. Categories absent from the response are retained because the cloud endpoint only returns active records, without deletion markers. The displayed last-sync time changes only after a successful download.

Both `LOCATION_ID` and `STATION_ID` are required. With IDs `01` / `01`, the standard expense prefix `EV`, payment prefix `EP`, year enabled, separator `-`, and counter 1:

```
EV2026-0101000001
EP2026-0101000001
```

Configured reference prefixes and year settings continue to apply. Online numbering remains unchanged. The workstation expense reference field is generated automatically.

## Cloud installation

Deploy the changed code to both installations, including the shared `WorkstationSyncSupport` trait used by purchase and expense uploads. Keep `IS_OFFLINE=false` on the cloud. Apply this migration to the intended cloud tenant:

```sh
php artisan migrate --path=database/migrations/2026_09_05_190100_create_workstation_expense_syncs_table.php --force
```

Select the tenant using the deployment's normal `TENANT_DOMAIN` configuration when needed. Refresh cached configuration/routes through the normal deployment process.

The authenticated Connector endpoint is `POST /connector/api/workstation-expenses`. The cloud token must belong to the same business and have `access_offline_module`, `expense.add`, and `expense.payments` when payments are included. Location permissions are enforced on both installations.

## Upload

Use the existing workstation cloud authorization settings. Open **Synchronization → Upload Synchronization → Expenses and Payments (EV / EP) → Sync**. Finalized expenses and linked direct payments upload in batches. Drafts stay local until finalized. Payments added after an expense's initial upload are included on the next sync.

The receiver preserves references, assigns cloud primary keys, creates expense/tax/payment accounting events, recalculates payment status, and records the source mapping in one database transaction. Retries cannot duplicate the expense or payments. Expense uploads do not change stock.

Contacts resolve by contact code. Expense categories resolve by name, optional code, and parent category, so cloud category IDs may differ. Missing or ambiguous categories stop the upload with an explanation. Employees, ledger accounts, payment accounts, taxes, and project references must exist in the correct business on cloud.

## Scope

- Uploads new finalized expenses and linked direct expense payments, including later payments.
- Post-sync edits or removals require reconciliation on cloud. The receiver rejects changed snapshots instead of replacing existing transactions/payments; deleted local expenses are not uploaded as deletion commands.
- Expense refunds, standalone/unallocated payments, advance/contact allocations, file attachments, Truckmate job-sheet links, and cash-register reconciliation are outside this upload.
- Recurring schedules are not copied to cloud. Each finalized workstation expense can upload individually without starting a second schedule.
- Existing cloud references without a matching workstation source record are reported as collisions.

## Verification

The shared purchase/expense tests run in an isolated SQLite database:

```sh
php vendor/bin/phpunit --do-not-cache-result tests/Unit/WorkstationPurchaseSyncTest.php
```
