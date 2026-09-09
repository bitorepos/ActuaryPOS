<?php

namespace Tests\Unit;

use App\Events\CosCreatedOrModified;
use App\Jobs\ProcessStockReindex;
use App\Utils\ProductUtil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Modules\Accounting\Listeners\MapCosTransaction;
use Modules\Accounting\Utils\AccountingUtil;
use Tests\TestCase;

class UnmanagedStockReindexTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        Event::forget(CosCreatedOrModified::class);
        Event::listen(CosCreatedOrModified::class, [MapCosTransaction::class, 'handle']);

        foreach ([
            'business' => 'id INTEGER PRIMARY KEY',
            'business_locations' => 'id INTEGER PRIMARY KEY, business_id INTEGER, name TEXT, is_active INTEGER, accounting_default_map TEXT',
            'products' => 'id INTEGER PRIMARY KEY, business_id INTEGER, enable_stock INTEGER, name TEXT, deleted_at TEXT',
            'variations' => 'id INTEGER PRIMARY KEY, product_id INTEGER, product_variation_id INTEGER, sub_sku TEXT, default_purchase_price REAL, dpp_inc_tax REAL, deleted_at TEXT',
            'transactions' => 'id INTEGER PRIMARY KEY, business_id INTEGER, location_id INTEGER, type TEXT, status TEXT, return_parent_id INTEGER, transaction_date TEXT, created_by INTEGER, deleted_at TEXT',
            'transaction_sell_lines' => 'id INTEGER PRIMARY KEY, transaction_id INTEGER, product_id INTEGER, variation_id INTEGER, quantity REAL, foc_quantity REAL, quantity_returned REAL, cost_price REAL, deleted_at TEXT',
            'purchase_lines' => 'id INTEGER PRIMARY KEY, transaction_id INTEGER, product_id INTEGER, variation_id INTEGER, purchase_price REAL, quantity REAL, quantity_sold REAL, quantity_adjusted REAL, quantity_returned REAL, mfg_quantity_used REAL, deleted_at TEXT',
            'transaction_sell_lines_purchase_lines' => 'id INTEGER PRIMARY KEY, sell_line_id INTEGER, purchase_line_id INTEGER, quantity REAL, qty_returned REAL, deleted_at TEXT',
            'ledger_discount_lines' => 'id INTEGER PRIMARY KEY, purchase_line_id INTEGER, amount REAL, deleted_at TEXT',
            'variation_location_details' => 'id INTEGER PRIMARY KEY, variation_id INTEGER, location_id INTEGER, qty_available REAL',
            'accounting_accounts_transactions' => 'id INTEGER PRIMARY KEY AUTOINCREMENT, accounting_account_id INTEGER, transaction_id INTEGER, transaction_payment_id INTEGER, sub_type TEXT, map_type TEXT, type TEXT, amount REAL, created_by INTEGER, operation_date TEXT, note TEXT, created_at TEXT, updated_at TEXT, deleted_at TEXT',
            'notifications' => 'id TEXT PRIMARY KEY, data TEXT, read_at TEXT, created_at TEXT, updated_at TEXT',
        ] as $table => $columns) {
            DB::statement("CREATE TABLE $table ($columns)");
        }
        DB::table('business')->insert(['id' => 1]);
        foreach ([1, 2] as $location) {
            DB::table('business_locations')->insert(['id' => $location, 'business_id' => 1, 'name' => 'Branch '.$location, 'is_active' => 1,
                'accounting_default_map' => json_encode(['cost_of_sale' => ['deposit_to' => 20, 'payment_account' => 10]])]);
        }
        foreach ([1 => 36, 2 => 14] as $id => $cost) {
            DB::table('products')->insert(['id' => $id, 'business_id' => 1, 'enable_stock' => 1, 'name' => 'Product '.$id]);
            DB::table('variations')->insert(['id' => $id, 'product_id' => $id, 'default_purchase_price' => $cost, 'dpp_inc_tax' => $cost]);
        }
    }

    private function sale(int $id, int $location = 1, bool $mixed = false, bool $free = false): void
    {
        DB::table('transactions')->insert(['id' => $id, 'business_id' => 1, 'location_id' => $location, 'type' => 'sell', 'status' => 'final', 'transaction_date' => '2026-09-01', 'created_by' => 1]);
        foreach ($mixed ? [1, 2] : [1] as $product) {
            DB::table('transaction_sell_lines')->insert(['id' => $id * 10 + $product, 'transaction_id' => $id, 'product_id' => $product, 'variation_id' => $product, 'quantity' => 1, 'foc_quantity' => $free ? 1 : 0, 'quantity_returned' => 0, 'cost_price' => 0]);
        }
        (new AccountingUtil)->saveMap($free ? 'foc_cos' : 'cos', $id, 1, 1, 20, 10);
    }

    private function disable(int $product = 1): void
    {
        DB::table('products')->where('id', $product)->update(['enable_stock' => 0]);
    }

    private function amount(int $transaction, string $subtype = 'cos'): float
    {
        return (float) DB::table('accounting_accounts_transactions')->where('transaction_id', $transaction)
            ->where('sub_type', $subtype)->where('map_type', 'payment_account')->whereNull('deleted_at')->sum('amount');
    }

    public function test_product_reindex_removes_only_unmanaged_cost_and_is_repeatable(): void
    {
        $this->sale(1, 1, true);
        $this->sale(2, 2);
        $this->assertSame(50.0, $this->amount(1));
        DB::table('accounting_accounts_transactions')->insert(['transaction_id' => 1, 'sub_type' => 'sell', 'map_type' => 'payment_account', 'type' => 'credit', 'amount' => 100]);
        $this->disable();
        $util = new ProductUtil;
        $this->assertTrue($util->reindexVariationQuantityDetails(1, 1, 1));
        $this->assertSame(14.0, $this->amount(1));
        $this->assertSame(36.0, $this->amount(2));
        $util->reindexVariationQuantityDetails(1, 1, 1);
        $this->assertSame(14.0, $this->amount(1));
        $this->assertEquals(14, DB::table('accounting_accounts_transactions')->where('transaction_id', 1)->where('type', 'debit')->whereNull('deleted_at')->sum('amount'));
        $util->reindexUnmanagedVariationAccounting(2, 1);
        $this->assertSame(36.0, $this->amount(2));
        $util->reindexUnmanagedVariationAccounting(1, 1);
        $this->assertSame(0.0, $this->amount(2));
        $this->assertEquals(100, DB::table('accounting_accounts_transactions')->where('transaction_id', 1)->where('sub_type', 'sell')->whereNull('deleted_at')->sum('amount'));
    }

    public function test_reindex_clears_return_and_free_item_postings(): void
    {
        $this->sale(1);
        $this->sale(2, 1, false, true);
        DB::table('transaction_sell_lines')->where('transaction_id', 1)->update(['quantity_returned' => 1]);
        DB::table('transactions')->insert(['id' => 3, 'business_id' => 1, 'location_id' => 1, 'type' => 'sell_return', 'status' => 'final', 'return_parent_id' => 1, 'transaction_date' => '2026-09-02', 'created_by' => 1]);
        (new AccountingUtil)->saveMap('cos', 3, 1, 1, 20, 10);
        $this->assertSame(36.0, $this->amount(3));
        $this->assertSame(36.0, $this->amount(2, 'foc_cos'));
        $this->disable();
        (new ProductUtil)->reindexVariationQuantityForLocations(1, 1, 1, true);
        $this->assertSame(0.0, $this->amount(3));
        $this->assertSame(0.0, $this->amount(2, 'foc_cos'));
    }

    /** @dataProvider globalModes */
    public function test_global_reindex_includes_disabled_products_without_quantity_mismatch(string $mode): void
    {
        $this->sale(1);
        $this->disable();
        $this->disable(2);
        (new ProcessStockReindex(null, 1, $mode, 1, 'test'))->handle(new ProductUtil);
        $this->assertSame(0.0, $this->amount(1));
    }

    public function globalModes(): array
    {
        return [['all'], ['mismatch']];
    }
}
