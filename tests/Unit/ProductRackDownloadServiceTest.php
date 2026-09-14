<?php

namespace Tests\Unit;

use App\Services\ProductRackDownloadService;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\TestCase;

class ProductRackDownloadServiceTest extends TestCase
{
    private $database;
    private $previousApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->previousApplication = Facade::getFacadeApplication();
        $this->database = new Capsule();
        $this->database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $this->database->getContainer()->instance('db', $this->database->getDatabaseManager());
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->database->getContainer());
        foreach (['products', 'business_locations'] as $name) {
            DB::connection()->getSchemaBuilder()->create($name, function (Blueprint $table) {
                $table->integer('id')->primary();
                $table->integer('business_id');
            });
        }
        DB::connection()->getSchemaBuilder()->create('product_racks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id');
            $table->integer('product_id');
            $table->integer('location_id');
            foreach (['rack', 'row', 'position'] as $field) {
                $table->string($field)->nullable();
            }
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('products')->insert(['id' => 10, 'business_id' => 1]);
        DB::table('business_locations')->insert(['id' => 20, 'business_id' => 1]);
    }

    protected function tearDown(): void
    {
        $this->database->getDatabaseManager()->disconnect();
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->previousApplication);
        parent::tearDown();
    }

    private function apply(array $racks, $businessId = 1): void
    {
        (new ProductRackDownloadService())->applyPage(1, [
            ['id' => 10, 'business_id' => $businessId, 'rack_details' => $racks],
        ]);
    }

    public function test_backfill_update_clear_and_restore_are_idempotent(): void
    {
        $rack = ['id' => 999, 'location_id' => 20, 'rack' => 'A', 'row' => '0', 'position' => '3'];
        $this->apply([$rack]);
        $localId = DB::table('product_racks')->value('id');
        $this->assertNotEquals(999, $localId);
        $rack['rack'] = 'B';
        $rack['position'] = null;
        $this->apply([$rack]);
        $this->assertSame(1, DB::table('product_racks')->count());
        $saved = DB::table('product_racks')->first();
        $this->assertSame('B', $saved->rack);
        $this->assertSame('0', $saved->row);
        $this->assertNull($saved->position);
        $this->apply([]);
        $this->assertNotNull(DB::table('product_racks')->value('deleted_at'));
        $this->apply([$rack]);
        $this->assertNull(DB::table('product_racks')->value('deleted_at'));
        $this->assertEquals($localId, DB::table('product_racks')->value('id'));
    }

    public function test_missing_location_rolls_back_page_without_clearing_details(): void
    {
        $this->apply([['location_id' => 20, 'rack' => 'Original']]);
        try {
            $this->apply([['location_id' => 20, 'rack' => 'Changed'], ['location_id' => 99]]);
            $this->fail('Missing location must fail the sync.');
        } catch (\RuntimeException $e) {
            $this->assertStringContainsString('Business Locations', $e->getMessage());
        }
        $this->assertSame('Original', DB::table('product_racks')->value('rack'));
    }

    public function test_other_business_snapshot_is_rejected(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->apply([], 2);
    }
}
