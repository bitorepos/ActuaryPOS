<?php

namespace Tests\Unit;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\TestCase;

class HamidsPurchaseOrderRepairTest extends TestCase
{
    private $previousApplication;
    private $database;

    protected function setUp(): void
    {
        parent::setUp();
        $this->previousApplication = Facade::getFacadeApplication();
        $this->database = new Capsule();
        $this->database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $this->database->getContainer()->instance('db', $this->database->getDatabaseManager());
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->database->getContainer());
        DB::connection()->getPdo();
        DB::connection()->setDatabaseName('hamids');

        DB::connection()->getSchemaBuilder()->create('transactions', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('business_id')->default(3);
            $table->string('type');
            $table->string('ref_no')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
        DB::connection()->getSchemaBuilder()->create('purchase_lines', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('transaction_id');
            $table->integer('purchase_order_line_id')->nullable();
            $table->decimal('quantity', 22, 4)->default(0);
            $table->decimal('po_quantity_purchased', 22, 4)->default(0);
            $table->timestamp('deleted_at')->nullable();
        });
    }

    protected function tearDown(): void
    {
        $this->database->getDatabaseManager()->disconnect();
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->previousApplication);
        parent::tearDown();
    }

    private function repair(): void
    {
        $migration = require dirname(__DIR__, 2) . '/database/migrations/2026_09_05_150000_repair_hamids_purchase_order_quantities.php';
        $migration->up();
    }

    private function seedOrder(): void
    {
        DB::table('transactions')->insert(['id' => 81, 'type' => 'purchase_order', 'ref_no' => 'PO012026-000005']);
        DB::table('purchase_lines')->insert(['id' => 1, 'transaction_id' => 81, 'quantity' => 12, 'po_quantity_purchased' => 12]);
    }

    public function testRepairIgnoresDeletedInvoicesAndLinesAndPreservesActivePurchases(): void
    {
        $this->seedOrder();
        DB::table('transactions')->insert(['id' => 82, 'type' => 'purchase', 'deleted_at' => '2026-09-03 12:00:00']);
        DB::table('transactions')->insert(['id' => 83, 'type' => 'purchase']);
        DB::table('transactions')->insert(['id' => 84, 'type' => 'purchase_order', 'ref_no' => 'OTHER-PO']);
        DB::table('purchase_lines')->insert(['id' => 2, 'transaction_id' => 81, 'quantity' => 6, 'po_quantity_purchased' => 6]);
        DB::table('purchase_lines')->insert(['id' => 3, 'transaction_id' => 84, 'quantity' => 10, 'po_quantity_purchased' => 10]);
        DB::table('purchase_lines')->insert(['id' => 4, 'transaction_id' => 81, 'po_quantity_purchased' => 8, 'deleted_at' => '2026-09-03 12:00:00']);
        DB::table('purchase_lines')->insert(['id' => 5, 'transaction_id' => 82, 'purchase_order_line_id' => 1, 'quantity' => 12]);
        DB::table('purchase_lines')->insert(['id' => 6, 'transaction_id' => 83, 'purchase_order_line_id' => 2, 'quantity' => 6, 'deleted_at' => '2026-09-03 12:00:00']);
        DB::table('purchase_lines')->insert(['id' => 7, 'transaction_id' => 83, 'purchase_order_line_id' => 2, 'quantity' => 2.5]);
        DB::table('purchase_lines')->insert(['id' => 8, 'transaction_id' => 83, 'purchase_order_line_id' => 2, 'quantity' => 0.5]);

        $this->repair();
        $this->repair(); // Re-running the repair must not subtract quantities twice.

        $this->assertEquals(0, DB::table('purchase_lines')->where('id', 1)->value('po_quantity_purchased'));
        $this->assertEquals(3, DB::table('purchase_lines')->where('id', 2)->value('po_quantity_purchased'));
        $this->assertEquals(10, DB::table('purchase_lines')->where('id', 3)->value('po_quantity_purchased'));
        $this->assertEquals(8, DB::table('purchase_lines')->where('id', 4)->value('po_quantity_purchased'));
        $this->assertNotNull(DB::table('transactions')->where('id', 82)->value('deleted_at'));
    }

    public function testRepairDoesNotTouchOtherDatabases(): void
    {
        $this->seedOrder();
        DB::connection()->setDatabaseName('another_tenant');
        $this->repair();
        $this->assertEquals(12, DB::table('purchase_lines')->where('id', 1)->value('po_quantity_purchased'));
    }

    public function testLoaderUsesActiveInvoicesOnAnyTenantWithoutChangingStoredCounters(): void
    {
        DB::connection()->setDatabaseName('hosting_prefix_hamids');
        DB::table('transactions')->insert(['id' => 100, 'business_id' => 17, 'type' => 'purchase_order']);
        DB::table('transactions')->insert(['id' => 101, 'business_id' => 17, 'type' => 'purchase', 'deleted_at' => '2026-09-03 12:00:00']);
        DB::table('transactions')->insert(['id' => 102, 'business_id' => 17, 'type' => 'purchase']);
        DB::table('transactions')->insert(['id' => 103, 'business_id' => 18, 'type' => 'purchase']);
        DB::table('purchase_lines')->insert(['id' => 1, 'transaction_id' => 100, 'quantity' => 12, 'po_quantity_purchased' => 12]);
        DB::table('purchase_lines')->insert(['id' => 2, 'transaction_id' => 100, 'quantity' => 6, 'po_quantity_purchased' => 6]);
        DB::table('purchase_lines')->insert(['id' => 3, 'transaction_id' => 101, 'purchase_order_line_id' => 1, 'quantity' => 12]);
        DB::table('purchase_lines')->insert(['id' => 4, 'transaction_id' => 102, 'purchase_order_line_id' => 1, 'quantity' => 12, 'deleted_at' => '2026-09-03 12:00:00']);
        DB::table('purchase_lines')->insert(['id' => 5, 'transaction_id' => 102, 'purchase_order_line_id' => 2, 'quantity' => 2.5]);
        DB::table('purchase_lines')->insert(['id' => 6, 'transaction_id' => 102, 'purchase_order_line_id' => 2, 'quantity' => 0.5]);
        DB::table('purchase_lines')->insert(['id' => 7, 'transaction_id' => 103, 'purchase_order_line_id' => 1, 'quantity' => 12]);

        $order = DB::table('transactions')->where('id', 100)->first();
        $order->purchase_lines = DB::table('purchase_lines')->where('transaction_id', 100)->get();
        $controller = (new \ReflectionClass(\App\Http\Controllers\PurchaseController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod($controller, 'refreshPurchaseOrderReceivedQuantities');
        $method->setAccessible(true);
        $method->invoke($controller, $order);

        $this->assertEquals(0, $order->purchase_lines[0]->po_quantity_purchased);
        $this->assertEquals(3, $order->purchase_lines[1]->po_quantity_purchased);
        $this->assertEquals(12, DB::table('purchase_lines')->where('id', 1)->value('po_quantity_purchased'));
    }
}
