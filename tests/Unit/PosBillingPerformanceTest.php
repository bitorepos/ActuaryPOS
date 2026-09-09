<?php

namespace Tests\Unit;

use App\TransactionSellLine;
use App\Utils\ProductUtil;
use App\Utils\TransactionUtil;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\TestCase;

class PosBillingPerformanceTest extends TestCase
{
    private $database;
    private $previousApplication;
    private $previousResolver;

    protected function setUp(): void
    {
        parent::setUp();
        $this->previousApplication = Facade::getFacadeApplication();
        $this->previousResolver = Model::getConnectionResolver();
        $this->database = new Capsule();
        $this->database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $this->database->bootEloquent();
        $container = $this->database->getContainer();
        $container->instance('db', $this->database->getDatabaseManager());
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($container);
        DB::statement('CREATE TABLE products (id INTEGER, unit_id INTEGER, brand_id INTEGER, category_id INTEGER, deleted_at TEXT)');
        DB::statement('CREATE TABLE variations (id INTEGER, product_id INTEGER, product_variation_id INTEGER, deleted_at TEXT)');
        foreach (['units', 'brands', 'categories', 'product_variations', 'tax_rates', 'users'] as $table) {
            DB::statement("CREATE TABLE $table (id INTEGER, name TEXT, deleted_at TEXT)");
            DB::table($table)->insert(['id' => 1, 'name' => 'Test']);
        }
        DB::statement('CREATE TABLE transaction_sell_lines (id INTEGER, transaction_id INTEGER, product_id INTEGER, variation_id INTEGER, tax_id INTEGER, res_service_staff_id INTEGER, parent_sell_line_id INTEGER, children_type TEXT, unit_price_inc_tax REAL, deleted_at TEXT)');
        DB::statement('CREATE TABLE transactions (id INTEGER, business_id INTEGER, contact_id INTEGER, type TEXT, status TEXT, transaction_date TEXT, deleted_at TEXT)');
        DB::table('products')->insert(['id' => 1, 'unit_id' => 1, 'brand_id' => 1, 'category_id' => 1]);
        DB::table('variations')->insert(['id' => 1, 'product_id' => 1, 'product_variation_id' => 1]);
    }

    protected function tearDown(): void
    {
        $this->database->getDatabaseManager()->disconnect();
        if ($this->previousResolver) {
            Model::setConnectionResolver($this->previousResolver);
        } else {
            Model::unsetConnectionResolver();
        }
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->previousApplication);
        parent::tearDown();
    }

    public function test_receipt_relationship_query_count_does_not_grow_with_bill_lines(): void
    {
        $util = new class extends TransactionUtil {
            public function preload($lines) { $this->loadReceiptSellLineProducts($lines); }
        };
        $counts = [];
        foreach ([1, 30] as $count) {
            $lines = TransactionSellLine::hydrate(array_fill(0, $count, [
                'id' => 1, 'product_id' => 1, 'variation_id' => 1, 'tax_id' => 1, 'res_service_staff_id' => 1,
            ]));
            DB::flushQueryLog();
            DB::enableQueryLog();
            $util->preload($lines);
            $counts[] = count(DB::getQueryLog());
            foreach ($lines as $line) {
                $this->assertSame(1, $line->product->unit->id);
                $this->assertSame(1, $line->product->brand->id);
                $this->assertSame(1, $line->product->category->id);
                $this->assertSame(1, $line->variations->product_variation->id);
                $this->assertSame(1, $line->tax->id);
                $this->assertSame(1, $line->service_staff->id);
            }
            $this->assertCount(end($counts), DB::getQueryLog(), 'Reading receipt fields must not issue per-line queries');
            DB::disableQueryLog();
        }
        $this->assertSame($counts[0], $counts[1]);
        $this->assertLessThanOrEqual(9, $counts[1]);
    }

    public function test_modifier_products_are_preloaded_without_changing_line_values(): void
    {
        DB::table('transaction_sell_lines')->insert([
            'id' => 2, 'parent_sell_line_id' => 1, 'children_type' => 'modifier',
            'product_id' => 1, 'variation_id' => 1, 'unit_price_inc_tax' => 12.5,
        ]);
        $lines = TransactionSellLine::hydrate([['id' => 1, 'product_id' => 1, 'variation_id' => 1]]);
        $util = new class extends TransactionUtil {
            public function preload($lines) { $this->loadReceiptSellLineProducts($lines); }
        };
        $util->preload($lines);
        DB::flushQueryLog();
        DB::enableQueryLog();
        $modifier = $lines[0]->modifiers->first();
        $this->assertEquals(12.5, $modifier->unit_price_inc_tax);
        $this->assertSame(1, $modifier->product->unit->id);
        $this->assertSame(1, $modifier->product->brand->id);
        $this->assertSame(1, $modifier->product->category->id);
        $this->assertSame(1, $modifier->variations->id);
        $this->assertCount(0, DB::getQueryLog());
        DB::disableQueryLog();
    }

    public function test_last_price_uses_latest_final_non_deleted_sale_for_this_business_and_customer(): void
    {
        $util = new class extends ProductUtil {
            public function priceQuery() { return $this->lastCustomerSoldPriceQuery(1, 1); }
        };
        $cases = [
            [1, 1, 'final', null, null, '2026-09-01', 10],
            [1, 1, 'final', null, null, '2026-09-03', 20],
            [1, 1, 'final', null, null, '2026-09-03', 25],
            [1, 1, 'draft', null, null, '2026-09-04', 30],
            [2, 1, 'final', null, null, '2026-09-04', 40],
            [1, 2, 'final', null, null, '2026-09-04', 50],
            [1, 1, 'final', '2026-09-05', null, '2026-09-04', 60],
            [1, 1, 'final', null, '2026-09-05', '2026-09-04', 70],
        ];
        foreach ($cases as $index => [$business, $contact, $status, $deleted, $lineDeleted, $date, $price]) {
            DB::table('transactions')->insert(['id' => $index + 1, 'business_id' => $business, 'contact_id' => $contact, 'type' => 'sell', 'status' => $status, 'transaction_date' => $date, 'deleted_at' => $deleted]);
            DB::table('transaction_sell_lines')->insert(['id' => $index + 1, 'transaction_id' => $index + 1, 'product_id' => 1, 'variation_id' => 1, 'unit_price_inc_tax' => $price, 'deleted_at' => $lineDeleted]);
        }
        DB::table('variations')->insert(['id' => 2, 'product_id' => 1]);
        $rows = DB::table('variations')->join('products', 'products.id', '=', 'variations.product_id')
            ->select('variations.id')->selectSub($util->priceQuery(), 'price')->orderBy('variations.id')->get();
        $this->assertCount(2, $rows);
        $this->assertEquals(25, $rows[0]->price);
        $this->assertNull($rows[1]->price);
    }
}
