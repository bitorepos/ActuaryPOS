<?php

namespace Tests\Unit;

use App\Http\Controllers\OfflineSyncController;
use App\Utils\TransactionUtil;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

class OfflineSyncPaymentStatusTest extends TestCase
{
    private $previousFacade;
    private $previousConnectionResolver;

    protected function setUp(): void
    {
        $this->previousFacade = Facade::getFacadeApplication();
        $this->previousConnectionResolver = Model::getConnectionResolver();
        $capsule = new Manager(new Container());
        $capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $capsule->bootEloquent();
        $capsule->getContainer()->instance('db', $capsule->getDatabaseManager());
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($capsule->getContainer());
        $capsule->getConnection()->getPdo()->sqliteCreateFunction(
            'IF',
            static function ($condition, $ifTrue, $ifFalse) {
                return $condition ? $ifTrue : $ifFalse;
            }
        );

        DB::statement('CREATE TABLE transactions (
            id INTEGER PRIMARY KEY, business_id INTEGER, invoice_no TEXT, type TEXT, status TEXT,
            payment_status TEXT, final_total NUMERIC, deleted_at TEXT, sync_date TEXT,
            created_at TEXT, updated_at TEXT
        )');
        DB::statement('CREATE TABLE transaction_payments (
            id INTEGER PRIMARY KEY, business_id INTEGER, transaction_id INTEGER, payment_ref_no TEXT,
            amount NUMERIC, is_return INTEGER, deleted_at TEXT, sync_date TEXT,
            created_at TEXT, updated_at TEXT
        )');

        DB::table('transactions')->insert([
            'id' => 1,
            'business_id' => 2,
            'invoice_no' => 'INV-1',
            'type' => 'sell',
            'status' => 'final',
            'payment_status' => 'paid',
            'final_total' => 447.04,
        ]);
        DB::table('transaction_payments')->insert([
            'id' => 1,
            'business_id' => 2,
            'transaction_id' => 1,
            'payment_ref_no' => 'PAY-1',
            'amount' => 379,
            'is_return' => 0,
        ]);
    }

    protected function tearDown(): void
    {
        if ($this->previousConnectionResolver === null) {
            Model::unsetConnectionResolver();
        } else {
            Model::setConnectionResolver($this->previousConnectionResolver);
        }
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->previousFacade);
    }

    public function test_successful_sync_reconciles_workstation_sale_payment_status(): void
    {
        $this->markSynced([[
            'invoice_no' => 'INV-1',
            'payment_lines' => [['payment_ref_no' => 'PAY-1']],
        ]]);

        $this->assertSame('partial', DB::table('transactions')->where('id', 1)->value('payment_status'));
        $this->assertNotNull(DB::table('transactions')->where('id', 1)->value('sync_date'));
        $this->assertNotNull(DB::table('transaction_payments')->where('id', 1)->value('sync_date'));
    }

    private function markSynced(array $responseData): void
    {
        $controller = (new ReflectionClass(OfflineSyncController::class))->newInstanceWithoutConstructor();
        $transactionUtil = new ReflectionProperty(OfflineSyncController::class, 'transactionUtil');
        $transactionUtil->setAccessible(true);
        $transactionUtil->setValue($controller, new TransactionUtil());

        $method = new ReflectionMethod(OfflineSyncController::class, 'markSyncedInBulk');
        $method->setAccessible(true);
        $method->invoke($controller, 2, $responseData);
    }
}
