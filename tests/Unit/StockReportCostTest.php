<?php

namespace Tests\Unit;

use App\Support\StockReportCost;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\TestCase;

class StockReportCostTest extends TestCase
{
    private $previousApplication;
    private $database;

    protected function setUp(): void
    {
        parent::setUp();
        $this->previousApplication = Facade::getFacadeApplication();
        $this->database = new Capsule();
        $this->database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $container = $this->database->getContainer();
        $container->instance('db', $this->database->getDatabaseManager());
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($container);
        DB::statement('CREATE TABLE variations (id INTEGER, default_purchase_price REAL, dpp_inc_tax REAL)');
        DB::statement('CREATE TABLE variation_location_details (variation_id INTEGER, location_id INTEGER, qty_available REAL)');
        DB::statement('CREATE TABLE transactions (id INTEGER, business_id INTEGER, location_id INTEGER, type TEXT, status TEXT, transaction_date TEXT, deleted_at TEXT)');
        DB::statement('CREATE TABLE purchase_lines (id INTEGER, transaction_id INTEGER, variation_id INTEGER, quantity REAL, foc_quantity REAL, quantity_returned REAL, purchase_price REAL, purchase_price_inc_tax REAL, deleted_at TEXT)');
        DB::table('variations')->insert(['id' => 1, 'default_purchase_price' => 7, 'dpp_inc_tax' => 8]);
        DB::table('variation_location_details')->insert(['variation_id' => 1, 'location_id' => 1, 'qty_available' => 5]);
    }

    protected function tearDown(): void
    {
        $this->database->getDatabaseManager()->disconnect();
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->previousApplication);
        parent::tearDown();
    }

    private function receipt(int $id, float $quantity, float $price, array $transaction = [], array $line = []): void
    {
        DB::table('transactions')->insert(array_merge([
            'id' => $id, 'business_id' => 1, 'location_id' => 1, 'type' => 'purchase',
            'status' => 'received', 'transaction_date' => '2026-09-01', 'deleted_at' => null,
        ], $transaction));
        DB::table('purchase_lines')->insert(array_merge([
            'id' => $id, 'transaction_id' => $id, 'variation_id' => 1, 'quantity' => $quantity,
            'foc_quantity' => 0, 'quantity_returned' => 0, 'purchase_price' => $price,
            'purchase_price_inc_tax' => $price * 1.1, 'deleted_at' => null,
        ], $line));
    }

    private function cost(string $method, bool $excludeTax = true): object
    {
        $query = DB::table('variations')->join('variation_location_details as vld', 'vld.variation_id', '=', 'variations.id');
        $cost = StockReportCost::unitCost($query, 1, ['cost_method' => $method, 'show_price_exc_tax' => $excludeTax]);
        return $query->selectRaw("$cost as cost, ($cost) * SUM(vld.qty_available) as value")
            ->groupBy('variations.id', 'vld.location_id')->first();
    }

    public function test_received_costs_are_weighted_and_latest_cost_uses_transaction_date(): void
    {
        $this->receipt(1, 10, 10, ['transaction_date' => '2026-09-03']);
        $this->receipt(2, 30, 20, ['transaction_date' => '2026-09-02']);
        $this->assertEqualsWithDelta(17.5, $this->cost('average_cost')->cost, 0.00001);
        $this->assertEqualsWithDelta(87.5, $this->cost('average_cost')->value, 0.00001);
        $this->assertEqualsWithDelta(19.25, $this->cost('average_cost', false)->cost, 0.00001);
        $this->assertEquals(10, $this->cost('last_cost')->cost);
        $this->assertEquals(11, $this->cost('last_cost', false)->cost);
    }

    public function test_costs_exclude_other_locations_businesses_deleted_pending_and_returned_receipts(): void
    {
        $this->receipt(1, 10, 10);
        $this->receipt(2, 10, 99, ['location_id' => 2]);
        $this->receipt(3, 10, 99, ['business_id' => 2]);
        $this->receipt(4, 10, 99, ['deleted_at' => '2026-09-02']);
        $this->receipt(5, 10, 99, ['status' => 'pending']);
        $this->receipt(6, 10, 99, [], ['deleted_at' => '2026-09-02']);
        $this->receipt(7, 10, 99, [], ['quantity_returned' => 10]);
        foreach (['last_cost', 'average_cost'] as $method) {
            $this->assertEquals(10, $this->cost($method)->cost);
        }
    }

    public function test_fallback_zero_cost_returns_and_negative_stock(): void
    {
        foreach (['last_cost', 'average_cost'] as $method) {
            $this->assertEquals(7, $this->cost($method)->cost);
            $this->assertEquals(8, $this->cost($method, false)->cost);
        }
        $this->receipt(1, 20, 10, [], ['quantity_returned' => 10]);
        $this->receipt(2, 10, 0);
        $this->assertEquals(5, $this->cost('average_cost')->cost);
        $this->assertEquals(0, $this->cost('last_cost')->cost);
        DB::table('variation_location_details')->update(['qty_available' => -5]);
        $this->assertEquals(-25, $this->cost('average_cost')->value);
    }

    public function test_fifo_and_invalid_selection_leave_existing_cost_query_unchanged(): void
    {
        foreach ([null, 'fifo', 'invalid', ['last_cost']] as $method) {
            $query = DB::table('variations');
            $sql = $query->toSql();
            $this->assertSame('fifo', StockReportCost::normalize($method));
            $this->assertNull(StockReportCost::unitCost($query, 1, ['cost_method' => $method]));
            $this->assertSame($sql, $query->toSql());
        }
    }

    public function test_opening_and_current_costs_can_be_selected_together_without_future_receipts_in_opening(): void
    {
        $this->receipt(1, 10, 10, ['transaction_date' => '2026-09-01']);
        $this->receipt(2, 10, 20, ['transaction_date' => '2026-09-02']);
        $this->receipt(3, 20, 40, ['transaction_date' => '2026-09-03']);

        foreach (['last_cost' => [20, 40], 'average_cost' => [15, 27.5]] as $method => $expected) {
            $query = DB::table('variations')->join('variation_location_details as vld', 'vld.variation_id', '=', 'variations.id');
            $filters = ['cost_method' => $method, 'show_price_exc_tax' => true];
            $current = StockReportCost::unitCost($query, 1, $filters);
            $opening = StockReportCost::unitCost($query, 1, $filters, '2026-09-03');
            $row = $query->selectRaw("$opening as opening_cost, $current as current_cost")->first();
            $this->assertEqualsWithDelta($expected[0], $row->opening_cost, 0.00001);
            $this->assertEqualsWithDelta($expected[1], $row->current_cost, 0.00001);
        }
    }
}
