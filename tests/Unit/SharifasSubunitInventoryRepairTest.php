<?php

namespace Tests\Unit;

use App\Services\SharifasSubunitInventoryRepair;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\TestCase;

class SharifasSubunitInventoryRepairTest extends TestCase
{
    public function test_confirmed_live_database_is_allowed_but_other_tenants_and_offline_are_not(): void
    {
        foreach (['sharifas', 'sharifas_live', 'actu_sharifat2'] as $database) {
            $this->assertTrue(SharifasSubunitInventoryRepair::supportsDatabase($database, false));
            $this->assertFalse(SharifasSubunitInventoryRepair::supportsDatabase($database, true));
        }
        foreach (['alaskab', 'bitorepos502', 'other_sharifas', 'actu_sharifat3'] as $database) {
            $this->assertFalse(SharifasSubunitInventoryRepair::supportsDatabase($database, false));
        }
    }

    private $previousFacade;
    private $baseline;

    protected function setUp(): void
    {
        $this->previousFacade = Facade::getFacadeApplication();
        $capsule = new Manager(new Container());
        $capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $capsule->getContainer()->instance('db', $capsule->getDatabaseManager());
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($capsule->getContainer());
        foreach ([
            'business' => 'id INTEGER PRIMARY KEY, name TEXT',
            'transactions' => 'id INTEGER PRIMARY KEY, business_id INTEGER, type TEXT, status TEXT, invoice_no TEXT,
                location_id INTEGER, final_total DECIMAL, is_created_from_api INTEGER, return_parent_id INTEGER, deleted_at TEXT',
            'products' => 'id INTEGER PRIMARY KEY, business_id INTEGER, type TEXT, unit_id INTEGER, enable_stock INTEGER',
            'units' => 'id INTEGER PRIMARY KEY, business_id INTEGER, base_unit_id INTEGER, base_unit_multiplier DECIMAL',
            'transaction_sell_lines' => 'id INTEGER PRIMARY KEY, transaction_id INTEGER, product_id INTEGER, variation_id INTEGER,
                sub_unit_id INTEGER, foc_sub_unit_id INTEGER, quantity_returned DECIMAL DEFAULT 0, children_type TEXT,
                line_discount_type TEXT, line_discount2_type TEXT, quantity DECIMAL, foc_quantity DECIMAL DEFAULT 0,
                unit_price DECIMAL, unit_price_before_discount DECIMAL, unit_price_inc_tax DECIMAL, item_tax DECIMAL DEFAULT 0,
                line_discount_amount DECIMAL DEFAULT 0, line_discount2_amount DECIMAL DEFAULT 0, deleted_at TEXT',
            'variation_location_details' => 'id INTEGER PRIMARY KEY, product_id INTEGER, variation_id INTEGER, location_id INTEGER,
                qty_available DECIMAL, deleted_at TEXT',
            'transaction_sell_lines_purchase_lines' => 'id INTEGER PRIMARY KEY, sell_line_id INTEGER, purchase_line_id INTEGER,
                quantity DECIMAL, qty_returned DECIMAL DEFAULT 0, updated_at TEXT, deleted_at TEXT',
            'purchase_lines' => 'id INTEGER PRIMARY KEY, transaction_id INTEGER, product_id INTEGER, variation_id INTEGER, quantity_sold DECIMAL',
            'subunit_inventory_repairs' => 'id INTEGER PRIMARY KEY AUTOINCREMENT, repair_key TEXT, business_id INTEGER,
                invoice_no TEXT, sell_line_id INTEGER, status TEXT, details TEXT, updated_at TEXT',
        ] as $table => $columns) DB::statement("CREATE TABLE {$table} ({$columns})");
        DB::table('business')->insert(['id' => 2, 'name' => 'Fixture shop']);
        DB::table('transactions')->insert(['id' => 1, 'business_id' => 2, 'type' => 'sell', 'status' => 'final',
            'invoice_no' => 'INV1', 'location_id' => 2, 'final_total' => 960, 'is_created_from_api' => 1]);
        DB::table('transactions')->insert(['id' => 2, 'business_id' => 2, 'type' => 'purchase', 'location_id' => 2]);
        DB::table('products')->insert(['id' => 1606, 'business_id' => 2, 'type' => 'single', 'unit_id' => 2, 'enable_stock' => 1]);
        DB::table('units')->insert(['id' => 14, 'business_id' => 2, 'base_unit_id' => 2, 'base_unit_multiplier' => 10]);
        DB::table('transaction_sell_lines')->insert(['id' => 10, 'transaction_id' => 1, 'product_id' => 1606, 'variation_id' => 1606,
            'sub_unit_id' => 14, 'children_type' => '', 'line_discount_type' => 'percentage', 'quantity' => 200,
            'unit_price' => 4.8, 'unit_price_before_discount' => 4.8, 'unit_price_inc_tax' => 4.8]);
        DB::table('variation_location_details')->insert(['id' => 1, 'product_id' => 1606, 'variation_id' => 1606, 'location_id' => 2, 'qty_available' => -200]);
        foreach ([1 => 100, 2 => 100] as $id => $quantity) {
            DB::table('purchase_lines')->insert(['id' => $id, 'transaction_id' => 2, 'product_id' => 1606, 'variation_id' => 1606, 'quantity_sold' => $quantity]);
            DB::table('transaction_sell_lines_purchase_lines')->insert(['id' => $id, 'sell_line_id' => 10, 'purchase_line_id' => $id, 'quantity' => $quantity]);
        }
        $this->baseline = ['business_id' => 2, 'business_name' => 'Fixture shop', 'sales' => [[
            'invoice_no' => 'INV1', 'header' => ['location_id' => 2, 'final_total' => 960], 'line_count' => 1,
            'has_returns' => false, 'repeated_variations' => false, 'lines' => [[
                'identity' => ['product_id' => 1606, 'variation_id' => 1606, 'sub_unit_id' => 14,
                    'quantity_returned' => 0, 'children_type' => '', 'line_discount_type' => 'percentage', 'line_discount2_type' => null,
                    'product_type' => 'single', 'product_unit_id' => 2, 'multiplier' => 10, 'foc_multiplier' => 1],
                'quantity' => 20, 'foc_quantity' => 0, 'unit_price' => 48, 'unit_price_before_discount' => 48,
                'unit_price_inc_tax' => 48, 'item_tax' => 0, 'line_discount_amount' => 0, 'line_discount2_amount' => 0,
            ]],
        ]]];
    }

    protected function tearDown(): void
    {
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->previousFacade);
    }

    private function runRepair(): array
    {
        return (new SharifasSubunitInventoryRepair())->run($this->baseline);
    }

    public function test_repairs_stock_prices_and_multiple_purchase_allocations_once(): void
    {
        $this->assertSame(['repaired' => 1], $this->runRepair());
        $this->assertEquals(20, DB::table('transaction_sell_lines')->value('quantity'));
        $this->assertEquals(48, DB::table('transaction_sell_lines')->value('unit_price'));
        $this->assertEquals(-20, DB::table('variation_location_details')->value('qty_available'));
        $this->assertEquals(20, DB::table('purchase_lines')->sum('quantity_sold'));
        $this->assertEquals(20, DB::table('transaction_sell_lines_purchase_lines')->whereNull('deleted_at')->sum('quantity'));
        $this->assertEquals(960, DB::table('transactions')->where('id', 1)->value('final_total'));
        $this->assertSame(['already_repaired' => 1], $this->runRepair());
        $this->assertEquals(-20, DB::table('variation_location_details')->value('qty_available'));
        $backup = json_decode(DB::table('subunit_inventory_repairs')->value('details'), true);
        $this->assertEquals(200, $backup['before_line']['quantity']);
        $this->assertCount(2, $backup['before_mappings']);
    }

    public function test_correct_line_is_untouched(): void
    {
        DB::table('transaction_sell_lines')->update(['quantity' => 20, 'unit_price' => 48, 'unit_price_before_discount' => 48, 'unit_price_inc_tax' => 48]);
        DB::table('variation_location_details')->update(['qty_available' => -20]);
        $this->assertSame(['matches' => 1], $this->runRepair());
        $this->assertEquals(-20, DB::table('variation_location_details')->value('qty_available'));
    }

    public function test_partial_failure_rolls_back_released_purchase_allocations(): void
    {
        DB::table('purchase_lines')->where('id', 1)->update(['quantity_sold' => 0]);
        $this->assertSame(['review_invoices' => 1], $this->runRepair());
        $this->assertEquals(100, DB::table('purchase_lines')->where('id', 2)->value('quantity_sold'));
        $this->assertSame(2, DB::table('transaction_sell_lines_purchase_lines')->whereNull('deleted_at')->count());
        $this->assertEquals(200, DB::table('transaction_sell_lines')->value('quantity'));
        $this->assertEquals(-200, DB::table('variation_location_details')->value('qty_available'));
    }

    public function test_overselling_placeholder_can_be_reduced(): void
    {
        DB::table('transaction_sell_lines_purchase_lines')->where('id', 2)->update(['purchase_line_id' => 0]);
        $this->assertSame(['repaired' => 1], $this->runRepair());
        $this->assertEquals(20, DB::table('transaction_sell_lines_purchase_lines')->whereNull('deleted_at')->sum('quantity'));
    }

    public function test_quantity_only_mismatch_is_left_for_review(): void
    {
        DB::table('transaction_sell_lines')->update(['unit_price' => 48]);
        $this->assertSame(['review_invoices' => 1], $this->runRepair());
        $this->assertEquals(-200, DB::table('variation_location_details')->value('qty_available'));
    }

    public function test_cloud_recomputed_totals_and_sale_classification_do_not_block_verified_lines(): void
    {
        $this->baseline['sales'][0]['header']['is_direct_sale'] = 1;
        $this->baseline['sales'][0]['header']['total_before_tax'] = 960;
        DB::table('transactions')->where('id', 1)->update(['final_total' => 960.4008]);
        $this->assertSame(['repaired' => 1], $this->runRepair());
        $this->assertEquals(20, DB::table('transaction_sell_lines')->value('quantity'));
        $this->assertEquals(960.4008, DB::table('transactions')->where('id', 1)->value('final_total'));
    }

    public function test_changed_location_still_blocks_repair(): void
    {
        DB::table('transactions')->where('id', 1)->update(['location_id' => 3]);
        $this->assertSame(['review_invoices' => 1], $this->runRepair());
        $this->assertEquals(200, DB::table('transaction_sell_lines')->value('quantity'));
    }

    public function test_negative_sale_lines_correct_stock_and_signed_allocations(): void
    {
        $this->baseline['sales'][0]['lines'][0]['quantity'] = -20;
        DB::table('transaction_sell_lines')->update(['quantity' => -200]);
        DB::table('variation_location_details')->update(['qty_available' => 200]);
        DB::table('transaction_sell_lines_purchase_lines')->update(['quantity' => -100]);
        DB::table('purchase_lines')->update(['quantity_sold' => -100]);
        $this->assertSame(['repaired' => 1], $this->runRepair());
        $this->assertEquals(-20, DB::table('transaction_sell_lines')->value('quantity'));
        $this->assertEquals(20, DB::table('variation_location_details')->value('qty_available'));
        $this->assertEquals(-20, DB::table('purchase_lines')->sum('quantity_sold'));
        $this->assertEquals(-20, DB::table('transaction_sell_lines_purchase_lines')->whereNull('deleted_at')->sum('quantity'));
    }

    public function test_omitted_order_link_and_unused_free_unit_do_not_block_repair(): void
    {
        $this->baseline['sales'][0]['lines'][0]['identity']['so_line_id'] = 123;
        $this->baseline['sales'][0]['lines'][0]['identity']['foc_sub_unit_id'] = 14;
        $this->assertSame(['repaired' => 1], $this->runRepair());
        $this->assertEquals(20, DB::table('transaction_sell_lines')->value('quantity'));
    }

    public function test_returns_block_automatic_repair(): void
    {
        DB::table('transactions')->insert(['id' => 3, 'business_id' => 2, 'type' => 'sell_return', 'return_parent_id' => 1]);
        $this->assertSame(['review_invoices' => 1], $this->runRepair());
        $this->assertEquals(200, DB::table('transaction_sell_lines')->value('quantity'));
    }

    public function test_wrong_business_is_untouched(): void
    {
        $this->baseline['business_name'] = 'Another shop';
        $this->assertSame(['wrong_business' => 1], $this->runRepair());
        $this->assertSame(0, DB::table('subunit_inventory_repairs')->count());
    }

    public function test_changed_unit_mapping_is_left_for_review(): void
    {
        DB::table('units')->update(['base_unit_multiplier' => 12]);
        $this->assertSame(['review_invoices' => 1], $this->runRepair());
        $this->assertEquals(-200, DB::table('variation_location_details')->value('qty_available'));
    }

    public function test_multiple_sales_and_products_use_their_own_pack_sizes(): void
    {
        DB::table('transactions')->insert(['id' => 4, 'business_id' => 2, 'type' => 'sell', 'status' => 'final',
            'invoice_no' => 'INV2', 'location_id' => 2, 'final_total' => 1152, 'is_created_from_api' => 1]);
        DB::table('products')->insert(['id' => 2500, 'business_id' => 2, 'type' => 'single', 'unit_id' => 2, 'enable_stock' => 1]);
        DB::table('units')->insert(['id' => 15, 'business_id' => 2, 'base_unit_id' => 2, 'base_unit_multiplier' => 12]);
        DB::table('transaction_sell_lines')->insert(['id' => 11, 'transaction_id' => 4, 'product_id' => 2500, 'variation_id' => 3000,
            'sub_unit_id' => 15, 'children_type' => '', 'line_discount_type' => 'percentage', 'quantity' => 288,
            'unit_price' => 4, 'unit_price_before_discount' => 4, 'unit_price_inc_tax' => 4]);
        DB::table('variation_location_details')->insert(['id' => 2, 'product_id' => 2500, 'variation_id' => 3000, 'location_id' => 2, 'qty_available' => -288]);
        $second = $this->baseline['sales'][0];
        $second['invoice_no'] = 'INV2';
        $second['header']['final_total'] = 1152;
        $second['lines'][0]['quantity'] = 24;
        $second['lines'][0]['identity'] = array_merge($second['lines'][0]['identity'], [
            'product_id' => 2500, 'variation_id' => 3000, 'sub_unit_id' => 15, 'multiplier' => 12,
        ]);
        $this->baseline['sales'][] = $second;
        $this->assertSame(['repaired' => 2], $this->runRepair());
        $this->assertEquals(-20, DB::table('variation_location_details')->where('id', 1)->value('qty_available'));
        $this->assertEquals(-24, DB::table('variation_location_details')->where('id', 2)->value('qty_available'));
        $this->assertEquals(48, DB::table('transaction_sell_lines')->where('id', 11)->value('unit_price'));
    }
}
