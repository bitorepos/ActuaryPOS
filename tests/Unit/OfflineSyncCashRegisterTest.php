<?php

namespace Tests\Unit;

use App\CashRegister;
use App\Http\Controllers\OfflineSyncController;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

class OfflineSyncCashRegisterTest extends TestCase
{
    public function test_sale_sync_uses_the_linked_cloud_cash_register_id(): void
    {
        $controller = (new ReflectionClass(OfflineSyncController::class))->newInstanceWithoutConstructor();
        $method = new ReflectionMethod(OfflineSyncController::class, 'getLiveCashRegisterIdForSaleSync');
        $method->setAccessible(true);

        $sell = (object) [
            'cash_register_payments' => new Collection([
                (object) [
                    'cash_register' => (object) ['live_id' => 742],
                ],
            ]),
        ];

        $this->assertSame(742, $method->invoke($controller, $sell));
    }

    public function test_sale_sync_without_a_linked_cloud_cash_register_returns_null(): void
    {
        $controller = (new ReflectionClass(OfflineSyncController::class))->newInstanceWithoutConstructor();
        $method = new ReflectionMethod(OfflineSyncController::class, 'getLiveCashRegisterIdForSaleSync');
        $method->setAccessible(true);

        $sell = (object) [
            'cash_register_payments' => new Collection([
                (object) ['cash_register' => null],
            ]),
        ];

        $this->assertNull($method->invoke($controller, $sell));
    }

    public function test_linking_an_existing_cash_register_requeues_its_synced_sales(): void
    {
        $previous_facade = Facade::getFacadeApplication();
        $previous_resolver = Model::getConnectionResolver();
        $capsule = new Manager(new Container());
        $capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $capsule->bootEloquent();
        $capsule->getContainer()->instance('db', $capsule->getDatabaseManager());
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($capsule->getContainer());

        try {
            DB::statement('CREATE TABLE transactions (
                id INTEGER PRIMARY KEY, business_id INTEGER, type TEXT, status TEXT,
                sync_date TEXT, updated_at TEXT, deleted_at TEXT
            )');
            DB::statement('CREATE TABLE cash_register_transactions (
                id INTEGER PRIMARY KEY, cash_register_id INTEGER, transaction_id INTEGER,
                transaction_type TEXT, deleted_at TEXT
            )');
            DB::table('transactions')->insert([
                'id' => 1,
                'business_id' => 2,
                'type' => 'sell',
                'status' => 'final',
                'sync_date' => '2026-10-04 10:00:00',
                'updated_at' => '2026-10-04 10:00:00',
            ]);
            DB::table('cash_register_transactions')->insert([
                'id' => 1,
                'cash_register_id' => 50,
                'transaction_id' => 1,
                'transaction_type' => 'sell',
            ]);

            $controller = (new ReflectionClass(OfflineSyncController::class))->newInstanceWithoutConstructor();
            $method = new ReflectionMethod(OfflineSyncController::class, 'requeueSyncedSalesForCashRegister');
            $method->setAccessible(true);
            $register = new CashRegister();
            $register->id = 50;
            $method->invoke($controller, $register, 2);

            $this->assertSame(
                '2026-10-04 10:00:01',
                DB::table('transactions')->where('id', 1)->value('updated_at')
            );
        } finally {
            if ($previous_resolver === null) {
                Model::unsetConnectionResolver();
            } else {
                Model::setConnectionResolver($previous_resolver);
            }
            Facade::clearResolvedInstances();
            Facade::setFacadeApplication($previous_facade);
        }
    }
}
