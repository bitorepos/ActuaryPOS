# Offline sale sub-unit sync and repair

## Automatic repair when updating the cloud application

The live server diagnostic confirmed its actual database name is **`actu_sharifat2`**.
The original database-name check skipped it, although the first three migrations were
marked complete. The new `2026_09_09_100000_repair_sharifas_hosted_inventory.php`
migration retries the repair for this explicitly verified database. Deploy it together
with the updated original migration, repair service and diagnostic command. Existing
business and line validation still apply; other tenant databases remain excluded.

After deploying these files, run the application update, or run this on the live server:

```bash
cd /www/wwwroot/sharifas.actuarypos.com
TENANT_DOMAIN=sharifas.actuarypos.com php artisan migrate --path=database/migrations/2026_09_09_100000_repair_sharifas_hosted_inventory.php --force
TENANT_DOMAIN=sharifas.actuarypos.com php artisan repair:sharifas-inventory-status
```

The diagnostic should now show `database_allowed_by_repair: true` and an audit table.
Check its repair/review counts and confirm the example line quantity is 20. Live
execution of this follow-up has not yet been verified; the user runs it on the server.

Migration: `database/migrations/2026_09_08_200000_repair_sharifas_synced_subunit_inventory.php`.

Follow-up migrations `2026_09_08_210000_retry_sharifas_subunit_inventory_repair.php`
and `2026_09_08_220000_complete_sharifas_signed_subunit_repair.php` handle installations
where the first migration was already recorded, including the restored test database.
Deploy all three migration files and the current repair service.

The migration now includes the verified local baseline for **145 candidate lines,
59 sales and 66 products** in `database/data/sharifas_subunit_sales_20260908.json`.
It does not require you to export a cloud snapshot or manually requeue invoices.
The older command workflow below remains available for investigation and review cases.

Deploy the migration, its JSON baseline and `app/Services/SharifasSubunitInventoryRepair.php`
with the application update. Also deploy the sender formatter/controller changes to
the workstation to prevent future incorrect sync payloads. The application's update
routine in `app/Http/Controllers/Install/InstallController.php` invokes `migrate --force`.
Run that update for the **sharifas cloud tenant**; merely copying files does not execute
migrations. With a shared tenant codebase, migrations must run in this tenant's database.

Automatic repair runs only when the active database is `actu_sharifat2`, `sharifas` or the explicitly
supported restored test database `sharifas_live`, offline
mode is false, and the business ID/name matches the baseline. It leaves the correct
offline database untouched. It examines each listed invoice and each product's own
pack multiplier, identifies the double-conversion quantity/price signature, and:

- Sets the sell line's base quantity and prices/tax/fixed discounts back to the
  verified local values, correcting stock history.
- Restores the excess deduction to that product's location stock (for example,
  200 to 20 restores 180 pieces).
- Releases excess purchase allocations and reduces their `quantity_sold` counters,
  including overselling-placeholder mappings.
- Handles confirmed negative sale quantities with signed stock and allocation
  corrections (for example, -288 to -24 removes the excess 264-piece stock increase).
- Preserves invoice totals and payments; it does not replay the entire invoice.
- Stores original line, stock, mapping and affected purchase records in
  `subunit_inventory_repairs` before the transaction commits.

Each invoice is atomic, and an audit key prevents a second stock increment on retry.
Migration rollback deliberately does not reinstate damaged inventory or delete the
audit trail. Back up the database before the normal production application update.

Correct records are marked `matches`. Changed invoice identity, returns, repeated variations,
invalid units, inconsistent stock/allocation records, free-item mismatches and
unrecognized corruption patterns are marked `review` without changing that invoice.
This is a repair of the verified historical baseline, not a rule that divides all
sub-unit sales. Sales absent from that baseline need separate verification. Stock is
corrected by the excess sale deduction; if stock was already independently rebuilt
while sell lines stayed wrong, reconcile that case separately before running this repair.

After the update, check its log summary and audit table:

```sql
SELECT status, COUNT(*) AS records
FROM subunit_inventory_repairs
WHERE repair_key = 'sharifas-subunits-20260908-v1'
GROUP BY status;

SELECT invoice_no, sell_line_id, details
FROM subunit_inventory_repairs
WHERE repair_key = 'sharifas-subunits-20260908-v1' AND status = 'review';
```

The restored `sharifas_live` database was tested on 2026-09-08. The first migration
had been marked complete but skipped it because its database name was not `sharifas`.
The follow-ups now support that test database and allow known Connector differences:
direct-sale classification, recomputed totals, omitted sales-order links and unused
free-unit selections. Cloud header totals and metadata are preserved; each changed
line still requires the exact double-conversion quantity/price signature.

The restored database repair completed with **129 repaired lines, 16 matching lines
and zero outstanding review invoices**. Four earlier review records are retained
as `resolved`. Invoice `SI01012026-00132`, product 1606, is now 20 base pieces at 48;
`SI01012026-00120` remains 9 pieces. Verification compared 1,036 stock rows and
611 purchase rows against the pre-repair backup plus recorded correction deltas,
and checked that invoice headers were unchanged. A second repair pass left all stock,
purchase counters and sale quantities/prices unchanged.

Test-database backup: `storage/app/sharifas-live-before-subunit-repair-20260908-133450.json`.
This is the affected-record backup, not a full database dump. No remote production
database was changed. Automated tests also cover multiple products/sales, pack sizes,
signed quantities, audit backups, idempotence and rollback on inconsistent counters.

## Bulk audit and repair: all products and synced invoices

The sync formatter applies to every sale line; it is not restricted to product
1606 or either example invoice. A read-only scan of local `sharifas` business 2
found **145 candidate pack/free-unit lines across 59 synced sales and 66 products**.
These are candidates, not 59 proven corrupted sales. The full candidate invoice
list is in `storage/app/offline-sale-candidates-20260908.json`.

Use `offline:audit-sale-quantities` for the bulk workflow. It never queues anything
by default. It compares full invoices, preserving correct lines alongside affected
lines, and reports these statuses:

| Status | Meaning / next action |
| --- | --- |
| `candidate` | Local sub-unit sale; cloud comparison is still needed. |
| `matches` | Compared quantities, prices and other checked fields match; leave it alone. |
| `confirmed_double_conversion` | Quantities are multiplied again and unit prices are divided by the same pack size; eligible for reviewed requeue. |
| `review` | Missing/duplicate invoice, returns, repeated variations, combo lines, different unit mappings, header/payment differences, or another mismatch pattern. Inspect separately. |

The command checks each product's own unit multiplier, not a fixed factor of 10.
It reports mismatched product/variation IDs, local/cloud base quantities, and the
expected stock correction. A quantity-only mismatch also goes to review: it could
reflect a different defect or a legitimate edit. Free-item mismatches are reported
but not automatically queued by this initial repair classifier.

### 1. Read-only local audit

From the project directory in PowerShell:

```powershell
$env:TENANT_DOMAIN = 'localhost'
php artisan offline:audit-sale-quantities 2 --report=storage/app/subunit-audit-new.json
```

Choose a new output filename for each run; existing reports are not overwritten.
No cloud URL or access token was configured in this checkout at inspection time,
including the sync controller's root `.env` fallback, so a cloud snapshot is needed.

### 2. Export the cloud baseline

Deploy the new command and service files to the cloud codebase. On the cloud host,
from its project directory, select the **sharifas tenant** and its business ID 2:

```bash
TENANT_DOMAIN=sharifas.actuarypos.com php artisan offline:audit-sale-quantities 2 --export=storage/app/sharifas-cloud-sale-snapshot.json
```

This only reads records and writes a JSON file. Keep the snapshot in private storage;
it contains sale details. Copy it to the workstation's `storage/app` directory.
The export must run with cloud offline mode disabled. The comparator checks business
ID and business name; do not use an export from another tenant.

### 3. Compare every candidate invoice

```powershell
$env:TENANT_DOMAIN = 'localhost'
php artisan offline:audit-sale-quantities 2 --cloud-snapshot=storage/app/sharifas-cloud-sale-snapshot.json --report=storage/app/subunit-comparison.json
```

Read `sales[].reasons` and `sales[].changes` in the report. Review the full invoices
before selecting repairs: the normal update also writes prices, totals and payments.
The classifier compares key header and line fields plus payment amounts/methods/dates;
it does not establish that every possible invoice metadata field is identical.
Do not overwrite newer cloud edits. Keep sales editing and automatic sync paused
during the final snapshot, review and requeue to avoid changing the baseline.

### 4. Queue confirmed invoices together

Back up affected records, then select the confirmed invoices explicitly. Repeat
`--invoice` for as many invoices as needed; the following shows the reported example:

```powershell
php artisan offline:audit-sale-quantities 2 --cloud-snapshot=storage/app/sharifas-cloud-sale-snapshot.json --queue --invoice=SI01012026-00132
```

The command rechecks selected invoices against current local records. All selected
invoices must be `confirmed_double_conversion`; otherwise nothing is queued. The
cloud snapshot must be less than 30 minutes old. It saves original local sync markers
to `storage/app/offline-sale-requeue-*.json`, then updates all selected markers in
one database transaction. Concurrent parent-transaction changes or ambiguous local
invoice numbers roll back the batch. It keeps each marker **non-null** to force the
existing PUT/update route, not POST/create. It does not upload sales itself.

Resume Sales Sync using the fixed sender. The ordinary cloud update corrects each
sale's lines, stock difference and purchase allocations. Freshly export and compare
again afterwards; repaired invoices should have no remaining quantity/price changes.
Check stock history and allocations for the affected products. Review cases remain
visible for separate reconciliation; the tool does not silently repair them.

No queue or cloud repair has been executed during this investigation. Tests cover
multiple products and pack sizes, correct lines mixed with damaged lines, exclusions,
bulk marker updates and rollback on concurrent changes using an isolated test database.

## Verified locally on 2026-09-08

HTTP host `localhost` selects database `sharifas`, with `constants.is_offline = true`.
Business ID is 2. Product 1606 uses base unit 2 and related units 2 and 14;
unit 14 contains 10 base pieces.

| Invoice | Local transaction | Local line | Stored base quantity | Selected-unit payload | Base unit price |
| --- | ---: | ---: | ---: | --- | ---: |
| SI01012026-00120 | 22199 | 180745 | 9 | 9 singles at 48 | 48 |
| SI01012026-00132 | 22190 | 180648 | 20 | 2 packs at 480 | 48 |

The reported cloud quantity of 200 is consistent with sending the stored 20 as
pack quantity, which the Connector multiplies by 10 again. The existing checkout
already converted this particular line correctly before this change. The faulty
historical payload and deployed cloud code have not been inspected, so the exact
historical cause is not proven.

`OfflineSaleLineFormatter` now owns the conversion shared by create and update
sync: subtract stored free quantity, divide paid/free quantities by their respective
multipliers, and scale prices, tax and fixed discounts to selected units. Invalid
or unrelated selected units stop the upload. This also fixes free items being counted
twice when the paid sale has no sub-unit. Persisted local lines are not modified.

## Repair the existing invoice

Use the normal Connector **update** path to replay the verified local invoice.
It updates sell lines, adjusts stock by the old/new quantity difference, and adjusts
purchase/sale allocations. A standalone stock adjustment would leave the history
line wrong. A create retry can be ignored by invoice deduplication.

1. Back up the affected local and cloud records. Install the updated sender on
   the workstation that performs sync. Confirm cloud unit 14 belongs to this
   product's base unit and still has multiplier 10.
2. Compare the entire invoice on cloud with the local invoice before replaying:
   this is a full sale update, including prices, totals and payments. Local invoice
   22190 has 23 active lines, no repeated variation IDs and no return transactions
   at inspection time. Do not replay over newer cloud edits or cloud returns.
   If these exist, reconcile the affected lines separately first. For other invoices,
   also check repeated variations: the current offline update matches by variation,
   so repeated variations need a separate line-matching repair.
3. On the **local `sharifas` database only**, preview the exact target:

   ```sql
   SELECT id, business_id, invoice_no, status, updated_at, sync_date
   FROM sharifas.transactions
   WHERE id = 22190 AND business_id = 2
     AND invoice_no = 'SI01012026-00132';
   ```

4. After confirming the comparison, queue this invoice for update:

   ```sql
   UPDATE sharifas.transactions
   SET sync_date = DATE_SUB(updated_at, INTERVAL 1 SECOND)
   WHERE id = 22190 AND business_id = 2
     AND invoice_no = 'SI01012026-00132'
     AND type = 'sell' AND status = 'final'
     AND deleted_at IS NULL AND sync_date IS NOT NULL;
   ```

   Keep `sync_date` non-null: that selects PUT/update instead of POST/create.
   This query changes only the local sync marker; local stock and quantities stay
   intact. Automatic background sync may pick it up once queued.
5. Run Sales Sync on localhost if background sync has not already processed it.
   Confirm the update succeeded and the local sync marker is current.
6. Verify on cloud, locating the transaction by business and invoice number rather
   than assuming its numeric ID matches local:
   - Product 1606's line is 20 base pieces, sub-unit 14, base price 48.
   - Stock history shows **-20**, and the excess 180-piece deduction is restored
     relative to stock immediately before repair, allowing for intervening activity.
   - Purchase allocations and invoice/payment totals reconcile.
   - SI01012026-00120 still shows **-9**.

No repair SQL or cloud upload was executed during this investigation.

## Other previously synced invoices

Find local candidates with the query below and compare against cloud by business,
invoice and line identity. Having a sub-unit does not prove a sale is corrupted;
do not divide every cloud sub-unit sale by its multiplier. Replay only confirmed
mismatches after the same full-invoice checks above, retaining non-null sync dates.

```sql
SELECT t.id, t.invoice_no, t.location_id, sl.id AS local_line_id,
       sl.product_id, sl.variation_id, sl.sub_unit_id, sl.foc_sub_unit_id,
       sl.quantity AS expected_base_quantity,
       sl.foc_quantity AS expected_base_free_quantity, sl.unit_price
FROM sharifas.transactions t
JOIN sharifas.transaction_sell_lines sl ON sl.transaction_id = t.id
WHERE t.business_id = 2 AND t.type = 'sell' AND t.status = 'final'
  AND t.deleted_at IS NULL AND sl.deleted_at IS NULL
  AND t.sync_date IS NOT NULL
  AND (sl.sub_unit_id IS NOT NULL OR sl.foc_sub_unit_id IS NOT NULL)
ORDER BY t.id, sl.id;
```

Regression tests: `php vendor/bin/phpunit --do-not-cache-result tests/Unit/OfflineSaleLineFormatterTest.php`.
These test payload conversion in isolation; a live cloud round trip remains to be verified.
