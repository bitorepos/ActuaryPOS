<?php

namespace Tests\Unit;

use App\Services\OfflineSaleRepairQueue;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\TestCase;

class OfflineSaleRepairQueueTest extends TestCase
{
    private $previousFacade;

    protected function setUp(): void
    {
        $this->previousFacade = Facade::getFacadeApplication();
        $capsule = new Manager(new Container());
        $capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $capsule->getContainer()->instance('db', $capsule->getDatabaseManager());
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($capsule->getContainer());
        DB::statement('CREATE TABLE transactions (id INTEGER PRIMARY KEY, business_id INTEGER, invoice_no TEXT,
            type TEXT, status TEXT, deleted_at TEXT, updated_at TEXT, sync_date TEXT)');
        foreach ([1, 2] as $id) {
            DB::table('transactions')->insert(['id' => $id, 'business_id' => 2, 'invoice_no' => 'INV' . $id,
                'type' => 'sell', 'status' => 'final', 'updated_at' => '2026-09-03 11:45:37', 'sync_date' => '2026-09-03 11:45:37']);
        }
    }

    protected function tearDown(): void
    {
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->previousFacade);
    }

    private function row(int $id): array
    {
        return ['local_id' => $id, 'invoice_no' => 'INV' . $id, 'status' => 'confirmed_double_conversion',
            'updated_at' => '2026-09-03 11:45:37', 'sync_date' => '2026-09-03 11:45:37'];
    }

    public function test_bulk_queue_only_backdates_sync_markers(): void
    {
        $before = DB::table('transactions')->orderBy('id')->get()->all();
        (new OfflineSaleRepairQueue())->queue(2, [$this->row(1), $this->row(2)]);
        foreach ($before as $row) $row->sync_date = '2026-09-03 11:45:36';
        $this->assertEquals($before, DB::table('transactions')->orderBy('id')->get()->all());
    }

    public function test_concurrent_change_rolls_back_entire_batch(): void
    {
        DB::table('transactions')->where('id', 2)->update(['updated_at' => '2026-09-04 00:00:00']);
        try {
            (new OfflineSaleRepairQueue())->queue(2, [$this->row(1), $this->row(2)]);
            $this->fail('Expected concurrent change rejection');
        } catch (\RuntimeException $e) {
            $this->assertStringContainsString('rolled back', $e->getMessage());
        }
        $this->assertSame('2026-09-03 11:45:37', DB::table('transactions')->where('id', 1)->value('sync_date'));
    }

    public function test_unconfirmed_invoice_rolls_back_entire_batch(): void
    {
        $second = $this->row(2);
        $second['status'] = 'review';
        try {
            (new OfflineSaleRepairQueue())->queue(2, [$this->row(1), $second]);
            $this->fail('Expected review rejection');
        } catch (\RuntimeException $e) {
            $this->assertStringContainsString('Only confirmed', $e->getMessage());
        }
        $this->assertSame('2026-09-03 11:45:37', DB::table('transactions')->where('id', 1)->value('sync_date'));
    }
}
