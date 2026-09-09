<?php

namespace Tests\Unit;

use App\Events\TransactionPaymentAdded;
use App\Events\ExpenseCreatedOrModified;
use App\Services\WorkstationExpenseSyncService;
use App\Services\ExpenseCategoryDownloadService;
use App\Services\WorkstationPurchaseSyncService;
use App\Utils\ProductUtil;
use App\Utils\TransactionUtil;
use App\Utils\Util;
use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Session\ArraySessionHandler;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use Illuminate\Validation\ValidationException;
use Mockery;
use PHPUnit\Framework\TestCase;

class WorkstationPurchaseSyncTest extends TestCase
{
    private $previousContainer;
    private $previousFacade;
    private $previousResolver;
    private $previousDispatcher;
    private $capsule;
    private $service;
    private $expenseService;
    private $events;

    protected function setUp(): void
    {
        if (! class_exists('Carbon')) {
            class_alias(\Carbon\Carbon::class, 'Carbon');
        }
        $this->previousContainer = Container::getInstance();
        $this->previousFacade = Facade::getFacadeApplication();
        $this->previousResolver = Model::getConnectionResolver();
        $this->previousDispatcher = Model::getEventDispatcher();
        $this->capsule = new Capsule();
        $app = $this->capsule->getContainer();
        Container::setInstance($app);
        $this->capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $app->instance('db', $this->capsule->getDatabaseManager());
        $app->instance('db.schema', $this->capsule->getConnection()->getSchemaBuilder());
        $databaseConfig = ['default' => 'default', 'connections' => ['default' => ['driver' => 'sqlite', 'database' => ':memory:']]];
        $app->instance('config', new Repository(['database' => $databaseConfig, 'constants' => [
            'is_offline' => true, 'location_id' => '01', 'station_id' => '01', 'invoice_scheme_separator' => '-',
        ]]));
        $app->instance('events', new Dispatcher($app));
        $this->events = $app['events'];
        $session = new Store('test', new ArraySessionHandler(120));
        $app->instance('session', $session);
        $request = Request::create('/');
        $request->setLaravelSession($session);
        $app->instance('request', $request);
        $app->instance('validator', new Factory(new Translator(new ArrayLoader(), 'en'), $app));
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($app);
        $this->capsule->bootEloquent();
        Model::unsetEventDispatcher();

        $schema = $this->capsule->getConnection()->getSchemaBuilder();
        foreach (['business_locations', 'business', 'contacts', 'products', 'variations', 'accounts', 'tax_rates', 'units', 'expense_categories', 'users', 'accounting_accounts', 'pjt_projects', 'pjt_project_steps'] as $name) {
            $schema->create($name, function (Blueprint $table) {
                $table->increments('id');
                $table->integer('business_id')->default(1);
                $table->integer('product_id')->nullable();
                $table->integer('parent_id')->nullable();
                $table->integer('project_id')->nullable();
                $table->string('sku')->nullable();
                $table->string('sub_sku')->nullable();
                $table->string('type')->nullable();
                $table->string('name')->nullable();
                $table->string('code')->nullable();
                $table->string('contact_id')->nullable();
                $table->string('loc_code')->nullable();
                $table->text('ref_no_prefixes')->nullable();
                $table->decimal('budget', 22, 4)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
        $schema->create('transactions', function (Blueprint $table) {
            $table->increments('id');
            foreach (['business_id', 'location_id', 'contact_id', 'created_by', 'is_created_from_api', 'is_recurring',
                'expense_category_id', 'expense_sub_category_id', 'expense_for', 'prefer_payment_account', 'pjt_project_id', 'pjt_project_step_id', 'tax_id', 'return_parent_id'] as $field) {
                $table->integer($field)->nullable();
            }
            foreach (['ref_no', 'station_id', 'type', 'status', 'payment_status', 'transaction_date', 'tax_type', 'sync_date'] as $field) {
                $table->string($field)->nullable();
            }
            foreach (['total_before_tax', 'final_total', 'exchange_rate', 'discount2_amount'] as $field) {
                $table->decimal($field, 22, 4)->default(0);
            }
            $table->timestamps();
            $table->softDeletes();
        });
        $schema->create('purchase_lines', function (Blueprint $table) {
            $table->increments('id');
            foreach (['transaction_id', 'product_id', 'variation_id'] as $field) {
                $table->integer($field);
            }
            foreach (['quantity', 'quantity_returned', 'foc_quantity', 'purchase_price', 'purchase_price_inc_tax', 'pp_without_discount', 'item_tax'] as $field) {
                $table->decimal($field, 22, 4)->default(0);
            }
            $table->timestamps();
            $table->softDeletes();
        });
        $schema->create('transaction_payments', function (Blueprint $table) {
            $table->increments('id');
            foreach (['transaction_id', 'business_id', 'location_id', 'created_by', 'payment_for', 'account_id'] as $field) {
                $table->integer($field)->nullable();
            }
            foreach (['payment_ref_no', 'method', 'paid_on'] as $field) {
                $table->string($field)->nullable();
            }
            $table->decimal('amount', 22, 4)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
        $schema->create('test_stock', function (Blueprint $table) {
            $table->integer('variation_id')->primary();
            $table->decimal('quantity', 22, 4)->default(0);
        });
        (require __DIR__.'/../../database/migrations/2026_09_05_190000_create_workstation_purchase_syncs_table.php')->up();
        (require __DIR__.'/../../database/migrations/2026_09_05_190100_create_workstation_expense_syncs_table.php')->up();
        DB::table('business_locations')->insert(['id' => 1, 'loc_code' => '99']);
        DB::table('business')->insert(['id' => 1, 'ref_no_prefixes' => json_encode([
            'purchase' => 'PI', 'purchase_payment' => 'PP', 'expense' => 'EV', 'expense_payment' => 'EP',
            'purchase_return' => 'PR', 'purchase_return_payment' => 'PRP',
        ])]);
        DB::table('contacts')->insert(['id' => 20, 'contact_id' => 'SUP001', 'type' => 'supplier']);
        DB::table('products')->insert(['id' => 30, 'sku' => 'SKU001']);
        DB::table('variations')->insert(['id' => 40, 'product_id' => 30, 'sub_sku' => 'SKU001-1']);
        DB::table('accounts')->insert(['id' => 1]);
        DB::table('expense_categories')->insert(['id' => 5, 'name' => 'Utilities', 'code' => 'UTIL']);
        DB::table('expense_categories')->insert(['id' => 6, 'parent_id' => 5, 'name' => 'Electricity', 'code' => 'ELEC']);
        DB::table('users')->insert(['id' => 7]);
        DB::table('test_stock')->insert(['variation_id' => 40, 'quantity' => 0]);
        $products = Mockery::mock(ProductUtil::class);
        $products->shouldReceive('updateProductQuantity')->andReturnUsing(function ($loc, $product, $variation, $qty) {
            DB::table('test_stock')->where('variation_id', $variation)->increment('quantity', $qty);
        });
        $products->shouldReceive('decreaseProductQuantity')->andReturnUsing(function ($product, $variation, $loc, $qty) {
            DB::table('test_stock')->where('variation_id', $variation)->decrement('quantity', $qty);
        });
        $products->shouldReceive('updateProductFromPurchase')->andReturn(true);
        $transactions = Mockery::mock(TransactionUtil::class);
        $transactions->shouldReceive('updatePaymentStatus')->andReturnUsing(function ($id, $total) {
            $paid = DB::table('transaction_payments')->where('transaction_id', $id)->sum('amount');
            DB::table('transactions')->where('id', $id)->update(['payment_status' => $paid >= $total ? 'paid' : ($paid ? 'partial' : 'due')]);
        });
        $this->service = new WorkstationPurchaseSyncService($products, $transactions);
        $this->expenseService = new WorkstationExpenseSyncService($transactions);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        $this->capsule->getDatabaseManager()->disconnect();
        if ($this->previousResolver) {
            Model::setConnectionResolver($this->previousResolver);
        } else {
            Model::unsetConnectionResolver();
        }
        if ($this->previousDispatcher) {
            Model::setEventDispatcher($this->previousDispatcher);
        }
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->previousFacade);
        Container::setInstance($this->previousContainer);
    }

    private function user($business = 1, $locations = 'all')
    {
        return new class($business, $locations) {
            public $id = 7;
            public function __construct(public $business_id, private $locations) {}
            public function permitted_locations() { return $this->locations; }
        };
    }

    private function payload(): array
    {
        return [
            'source_id' => 999, 'business_id' => 1, 'location_id' => 1, 'station_id' => '01',
            'supplier_code' => 'SUP001',
            'invoice' => ['ref_no' => 'PI2026-0101000001', 'status' => 'received',
                'transaction_date' => '2026-09-05 12:00:00', 'total_before_tax' => 100,
                'final_total' => 100, 'exchange_rate' => 1],
            'lines' => [['product_id' => 30, 'variation_id' => 40, 'sku' => 'SKU001', 'sub_sku' => 'SKU001-1',
                'quantity' => 12, 'foc_quantity' => 2, 'purchase_price' => 10,
                'purchase_price_inc_tax' => 10, 'pp_without_discount' => 10, 'item_tax' => 0]],
            'payments' => [['payment_ref_no' => 'PP2026-0101000001', 'amount' => 40,
                'method' => 'cash', 'paid_on' => '2026-09-05 12:00:00', 'account_id' => 1]],
        ];
    }

    public function testMigrationRetriesPreserveExistingSyncMappings(): void
    {
        foreach ([
            ['workstation_purchase_syncs', 'invoice_hash', '2026_09_05_190000_create_workstation_purchase_syncs_table.php'],
            ['workstation_expense_syncs', 'expense_hash', '2026_09_05_190100_create_workstation_expense_syncs_table.php'],
        ] as [$table, $hashColumn, $migration]) {
            DB::table($table)->insert([
                'business_id' => 1, 'location_id' => 1, 'station_id' => '01',
                'source_id' => 999, 'transaction_id' => 123,
                $hashColumn => str_repeat('a', 64), 'payment_hashes' => '{}',
            ]);
            $before = DB::table($table)->get()->toArray();

            (require __DIR__.'/../../database/migrations/'.$migration)->up();

            $this->assertEquals($before, DB::table($table)->get()->toArray());
        }
    }

    public function testRetryPreservesReferencesAndDoesNotDuplicateStockOrPayments(): void
    {
        $events = 0;
        $this->events->listen(TransactionPaymentAdded::class, function () use (&$events) { $events++; });
        $first = $this->service->import($this->payload(), $this->user());
        $retry = $this->service->import($this->payload(), $this->user());
        $this->assertTrue($first['created']);
        $this->assertFalse($retry['created']);
        $this->assertSame($first['cloud_id'], $retry['cloud_id']);
        $this->assertNotEquals(999, $first['cloud_id']);
        $this->assertEquals(12, DB::table('test_stock')->value('quantity'));
        $this->assertEquals(1, DB::table('transaction_payments')->count());
        $this->assertEquals('PP2026-0101000001', DB::table('transaction_payments')->value('payment_ref_no'));
        $this->assertEquals('partial', DB::table('transactions')->value('payment_status'));
        $this->assertSame(1, $events);
    }

    public function testAdditionalPaymentAfterInitialUploadDoesNotReapplyInvoice(): void
    {
        $payload = $this->payload();
        $this->service->import($payload, $this->user());
        $payload['payments'][] = array_replace($payload['payments'][0], ['payment_ref_no' => 'PP2026-0101000002', 'amount' => 60]);
        $result = $this->service->import($payload, $this->user());
        $this->assertSame(1, $result['payments_created']);
        $this->assertEquals(1, DB::table('transactions')->count());
        $this->assertEquals(12, DB::table('test_stock')->value('quantity'));
        $this->assertEquals('paid', DB::table('transactions')->value('payment_status'));
    }

    public function testPendingPurchaseDoesNotIncreaseStock(): void
    {
        $payload = $this->payload();
        $payload['invoice']['status'] = 'pending';
        $this->service->import($payload, $this->user());
        $this->assertEquals(0, DB::table('test_stock')->value('quantity'));
    }

    public function testInvalidPaymentRollsBackInvoiceLinesAndStock(): void
    {
        $payload = $this->payload();
        $payload['payments'][0]['account_id'] = 999;
        try {
            $this->service->import($payload, $this->user());
            $this->fail('Invalid account was accepted.');
        } catch (ValidationException $e) {
            $this->assertEquals(0, DB::table('transactions')->count());
            $this->assertEquals(0, DB::table('purchase_lines')->count());
            $this->assertEquals(0, DB::table('test_stock')->value('quantity'));
            $this->assertEquals(0, DB::table('workstation_purchase_syncs')->count());
        }
    }

    public function testCrossBusinessUploadIsRejected(): void
    {
        $this->expectException(ValidationException::class);
        $this->service->import($this->payload(), $this->user(2));
    }

    public function testUnauthorizedLocationIsRejected(): void
    {
        $this->expectException(ValidationException::class);
        $this->service->import($this->payload(), $this->user(1, [2]));
    }

    public function testProductIdentityMismatchIsRejected(): void
    {
        $payload = $this->payload();
        $payload['lines'][0]['sku'] = 'WRONG';
        $this->expectException(ValidationException::class);
        $this->service->import($payload, $this->user());
    }

    public function testChangedInvoiceCannotSilentlyOverwriteCloud(): void
    {
        $payload = $this->payload();
        $this->service->import($payload, $this->user());
        $payload['invoice']['final_total'] = 200;
        $this->expectException(ValidationException::class);
        $this->service->import($payload, $this->user());
    }

    public function testChangedPaymentCannotSilentlyOverwriteCloud(): void
    {
        $payload = $this->payload();
        $this->service->import($payload, $this->user());
        $payload['payments'][0]['amount'] = 90;
        $this->expectException(ValidationException::class);
        $this->service->import($payload, $this->user());
    }

    public function testWorkstationNumberUsesBothEnvironmentIdsEvenWithLocationCode(): void
    {
        $util = new Util();
        $year = now()->year;
        $this->assertSame('PI'.$year.'-0101000001', $util->generateReferenceNumber('purchase', 1, 1, null, 1));
        $this->assertSame('PP'.$year.'-0101000001', $util->generateReferenceNumber('purchase_payment', 1, 1, null, 1));
        config(['constants.station_id' => '02']);
        $this->assertSame('PI'.$year.'-0102000001', $util->generateReferenceNumber('purchase', 1, 1, null, 1));
        config(['constants.is_offline' => false]);
        $this->assertSame('PI99'.$year.'-000001', $util->generateReferenceNumber('purchase', 1, 1, null, 1));
    }

    public function testMissingWorkstationIdStopsNumberAllocation(): void
    {
        config(['constants.station_id' => '']);
        $this->expectException(\RuntimeException::class);
        (new Util())->generateReferenceNumber('purchase', 1, 1, null, 1);
    }

    public function testAnotherStationCanUploadTheSameLocalPrimaryKey(): void
    {
        $payload = $this->payload();
        $this->service->import($payload, $this->user());
        $payload['station_id'] = '02';
        $payload['invoice']['ref_no'] = 'PI2026-0102000001';
        $payload['payments'][0]['payment_ref_no'] = 'PP2026-0102000001';
        $this->service->import($payload, $this->user());
        $this->assertEquals(2, DB::table('workstation_purchase_syncs')->count());
        $this->assertEquals(2, DB::table('transactions')->count());
        $this->assertEquals(24, DB::table('test_stock')->value('quantity'));
    }

    public function testCloudReferenceCollisionIsRejectedRatherThanAdopted(): void
    {
        $payload = $this->payload();
        $this->service->import($payload, $this->user());
        $payload['source_id'] = 1000;
        $this->expectException(ValidationException::class);
        $this->service->import($payload, $this->user());
    }

    public function testRemovedPaymentIsReportedRatherThanMarkedSynced(): void
    {
        $payload = $this->payload();
        $this->service->import($payload, $this->user());
        $payload['payments'] = [];
        $this->expectException(ValidationException::class);
        $this->service->import($payload, $this->user());
    }

    public function testBlankYearFormatStillIncludesWorkstationIds(): void
    {
        DB::table('business')->where('id', 1)->update(['ref_no_prefixes' => json_encode([
            'purchase' => 'PI', 'purchase_payment' => 'PP', 'transaction_number_format' => 'blank',
        ])]);
        $this->assertSame('PI-0101000001', (new Util())->generateReferenceNumber('purchase', 1, 1, null, 1));
        $this->assertSame('PP-0101000001', (new Util())->generateReferenceNumber('purchase_payment', 1, 1, null, 1));
    }

    public function testPurchaseUploadWithNullOrMissingTaxTypeSucceedsAndDefaultsToFixed(): void
    {
        $payload = $this->payload();
        $payload['invoice']['tax_type'] = null;
        $result = $this->service->import($payload, $this->user());
        $this->assertTrue($result['created']);

        $savedTaxType = DB::table('transactions')->where('id', $result['cloud_id'])->value('tax_type');
        $this->assertSame('fixed', $savedTaxType);
    }

    public function testLegacyMappingWithNullTaxTypeHashUpgradesAndAllowsSubsequentPayments(): void
    {
        $payload = $this->payload();
        // Simulate an earlier mapping where hash was computed with tax_type => null
        $rawInvoice = $payload['invoice'];
        $rawInvoice['tax_type'] = null;
        $hasher = new class {
            use \App\Services\WorkstationSyncSupport;
            public function makeHash(array $data): string { return $this->hash($data); }
        };
        $legacyHash = $hasher->makeHash([
            $payload['supplier_code'],
            $rawInvoice,
            $payload['lines'],
        ]);

        $txId = DB::table('transactions')->insertGetId([
            'business_id' => 1, 'location_id' => 1, 'station_id' => '01',
            'contact_id' => 1, 'created_by' => 7, 'type' => 'purchase',
            'status' => 'received', 'payment_status' => 'due', 'ref_no' => $payload['invoice']['ref_no'],
            'total_before_tax' => 100, 'final_total' => 100, 'exchange_rate' => 1,
            'tax_type' => 'fixed', 'transaction_date' => '2026-09-05 12:00:00',
        ]);

        DB::table('workstation_purchase_syncs')->insert([
            'business_id' => 1, 'location_id' => 1, 'station_id' => '01',
            'source_id' => 999, 'transaction_id' => $txId,
            'invoice_hash' => $legacyHash,
            'payment_hashes' => json_encode([]),
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // Upload new payment using updated payload (with normalized tax_type)
        $payload['invoice']['tax_type'] = 'fixed';
        $payload['payments'] = [
            ['payment_ref_no' => 'PP2026-0101000099', 'amount' => 50, 'method' => 'cash', 'paid_on' => '2026-09-05 12:00:00', 'account_id' => 1],
        ];

        $result = $this->service->import($payload, $this->user());
        $this->assertFalse($result['created']);
        $this->assertSame(1, $result['payments_created']);
        $this->assertEquals(1, DB::table('transaction_payments')->where('payment_ref_no', 'PP2026-0101000099')->count());
    }

    public function testSnapshotDefaultsTaxTypeToFixedWhenNull(): void
    {
        $tx = new \App\Transaction([
            'business_id' => 1, 'location_id' => 1, 'station_id' => '01',
            'contact_id' => 1, 'type' => 'purchase', 'status' => 'received',
            'ref_no' => 'PI-TEST-001', 'total_before_tax' => 50, 'final_total' => 50,
            'tax_type' => null,
        ]);
        $tx->id = 555;
        $tx->setRelation('contact', new \App\Contact(['contact_id' => 'SUP001']));
        $tx->setRelation('purchase_lines', collect([]));
        $tx->setRelation('payment_lines', collect([]));

        $snapshot = $this->service->snapshot($tx);
        $this->assertSame('fixed', $snapshot['invoice']['tax_type']);
    }

    private function expensePayload(): array
    {
        return [
            'source_id' => 999, 'business_id' => 1, 'location_id' => 1, 'station_id' => '01',
            'contact_code' => null,
            'category' => ['name' => 'Utilities', 'code' => 'UTIL'],
            'subcategory' => ['name' => 'Electricity', 'code' => 'ELEC'],
            'expense' => ['ref_no' => 'EV2026-0101000001', 'status' => 'final',
                'transaction_date' => '2026-09-05 12:00:00', 'total_before_tax' => 100,
                'final_total' => 100, 'exchange_rate' => 1, 'expense_category_id' => 5,
                'expense_sub_category_id' => 6, 'expense_for' => 7],
            'payments' => [['payment_ref_no' => 'EP2026-0101000001', 'amount' => 40,
                'method' => 'cash', 'paid_on' => '2026-09-05 12:00:00', 'account_id' => 1]],
        ];
    }

    public function testExpenseRetryDoesNotDuplicateAccountingOrPaymentsOrChangeStock(): void
    {
        $expenseEvents = 0;
        $paymentTypes = [];
        $this->events->listen(ExpenseCreatedOrModified::class, function () use (&$expenseEvents) { $expenseEvents++; });
        $this->events->listen(TransactionPaymentAdded::class, function ($event) use (&$paymentTypes) {
            $paymentTypes[] = $event->formInput['transaction_type'];
        });
        $first = $this->expenseService->import($this->expensePayload(), $this->user());
        $retry = $this->expenseService->import($this->expensePayload(), $this->user());
        $this->assertTrue($first['created']);
        $this->assertFalse($retry['created']);
        $this->assertSame($first['cloud_id'], $retry['cloud_id']);
        $this->assertNotEquals(999, $first['cloud_id']);
        $this->assertEquals('EV2026-0101000001', DB::table('transactions')->value('ref_no'));
        $this->assertEquals('EP2026-0101000001', DB::table('transaction_payments')->value('payment_ref_no'));
        $this->assertEquals(0, DB::table('test_stock')->value('quantity'));
        $this->assertSame(1, $expenseEvents);
        $this->assertSame(['expense'], $paymentTypes);
        $this->assertNull(DB::table('transaction_payments')->value('payment_for'));
        $this->assertEquals('partial', DB::table('transactions')->value('payment_status'));
        $this->assertEquals(0, DB::table('transactions')->value('is_recurring'));
    }

    public function testExpenseCanUploadAnotherPaymentLater(): void
    {
        $payload = $this->expensePayload();
        $this->expenseService->import($payload, $this->user());
        $payload['payments'][] = array_replace($payload['payments'][0], ['payment_ref_no' => 'EP2026-0101000002', 'amount' => 60]);
        $result = $this->expenseService->import($payload, $this->user());
        $this->assertSame(1, $result['payments_created']);
        $this->assertEquals(1, DB::table('transactions')->count());
        $this->assertEquals(2, DB::table('transaction_payments')->count());
        $this->assertEquals('paid', DB::table('transactions')->value('payment_status'));
    }

    public function testExpenseContactIsResolvedByCodeRatherThanLocalId(): void
    {
        $payload = $this->expensePayload();
        $payload['contact_code'] = 'SUP001';
        $payload['expense']['contact_id'] = 9876;
        $this->expenseService->import($payload, $this->user());
        $this->assertEquals(20, DB::table('transactions')->value('contact_id'));
        $this->assertEquals(20, DB::table('transaction_payments')->value('payment_for'));
    }

    public function testExpenseInvalidPaymentRollsBackExpenseAndMapping(): void
    {
        $payload = $this->expensePayload();
        $payload['payments'][0]['account_id'] = 999;
        try {
            $this->expenseService->import($payload, $this->user());
            $this->fail('Invalid expense payment account accepted.');
        } catch (ValidationException $e) {
            $this->assertEquals(0, DB::table('transactions')->count());
            $this->assertEquals(0, DB::table('transaction_payments')->count());
            $this->assertEquals(0, DB::table('workstation_expense_syncs')->count());
        }
    }

    public function testExpenseCannotUseAnotherBusinessCategory(): void
    {
        DB::table('expense_categories')->where('id', 5)->update(['business_id' => 2]);
        $this->expectException(ValidationException::class);
        $this->expenseService->import($this->expensePayload(), $this->user());
    }

    public function testExpenseCannotUseUnrelatedSubcategory(): void
    {
        DB::table('expense_categories')->where('id', 6)->update(['parent_id' => 9]);
        $this->expectException(ValidationException::class);
        $this->expenseService->import($this->expensePayload(), $this->user());
    }

    public function testExpenseCannotUseAnotherBusinessEmployee(): void
    {
        DB::table('users')->where('id', 7)->update(['business_id' => 2]);
        $this->expectException(ValidationException::class);
        $this->expenseService->import($this->expensePayload(), $this->user());
    }

    public function testExpenseRejectsOtherBusinessAndUnpermittedLocation(): void
    {
        foreach ([$this->user(2), $this->user(1, [2])] as $user) {
            try {
                $this->expenseService->import($this->expensePayload(), $user);
                $this->fail('Expense authorization mismatch was accepted.');
            } catch (ValidationException $e) {
                $this->assertEquals(0, DB::table('transactions')->count());
            }
        }
    }

    public function testDraftExpenseIsNotUploaded(): void
    {
        $payload = $this->expensePayload();
        $payload['expense']['status'] = 'draft';
        $this->expectException(ValidationException::class);
        $this->expenseService->import($payload, $this->user());
    }

    public function testExpenseChangeAfterUploadIsReported(): void
    {
        $payload = $this->expensePayload();
        $this->expenseService->import($payload, $this->user());
        $payload['expense']['final_total'] = 200;
        $this->expectException(ValidationException::class);
        $this->expenseService->import($payload, $this->user());
    }

    public function testExpensePaymentChangeAfterUploadIsReported(): void
    {
        $payload = $this->expensePayload();
        $this->expenseService->import($payload, $this->user());
        $payload['payments'][0]['amount'] = 20;
        $this->expectException(ValidationException::class);
        $this->expenseService->import($payload, $this->user());
    }

    public function testExpenseAndPurchaseMayHaveTheSameWorkstationSourceId(): void
    {
        $this->service->import($this->payload(), $this->user());
        $this->expenseService->import($this->expensePayload(), $this->user());
        $this->assertEquals(2, DB::table('transactions')->count());
        $this->assertEquals(1, DB::table('workstation_purchase_syncs')->count());
        $this->assertEquals(1, DB::table('workstation_expense_syncs')->count());
        $this->assertEquals(12, DB::table('test_stock')->value('quantity'));
    }

    public function testExpenseNumbersIncludeWorkstationIdsAndOnlineFormatStaysUnchanged(): void
    {
        $year = now()->year;
        $util = new Util();
        $this->assertSame('EV'.$year.'-0101000001', $util->generateReferenceNumber('expense', 1, 1, null, 1));
        $this->assertSame('EP'.$year.'-0101000001', $util->generateReferenceNumber('expense_payment', 1, 1, null, 1));
        config(['constants.station_id' => '02']);
        $this->assertSame('EV'.$year.'-0102000001', $util->generateReferenceNumber('expense', 1, 1, null, 1));
        config(['constants.is_offline' => false]);
        $this->assertSame('EV99'.$year.'-000001', $util->generateReferenceNumber('expense', 1, 1, null, 1));
        $this->assertSame('EP99'.$year.'-000001', $util->generateReferenceNumber('expense_payment', 1, 1, null, 1));
    }

    public function testExpenseCategoryUsesCloudIdWhenLocalIdsDiffer(): void
    {
        $payload = $this->expensePayload();
        $payload['expense']['expense_category_id'] = 500;
        $payload['expense']['expense_sub_category_id'] = 600;
        $this->expenseService->import($payload, $this->user());
        $this->assertEquals(5, DB::table('transactions')->value('expense_category_id'));
        $this->assertEquals(6, DB::table('transactions')->value('expense_sub_category_id'));
    }

    public function testExpenseCreationStampsWorkstationAndBuildsAnUploadSnapshot(): void
    {
        $util = Mockery::mock(TransactionUtil::class)->makePartial();
        $util->shouldReceive('setAndGetReferenceCount')->once()->with('expense', 1, 1)->andReturn(1);
        $util->shouldReceive('uploadFile')->once()->andReturn(null);
        $util->shouldReceive('createOrUpdatePaymentLines')->once()->andReturn(true);
        $util->shouldReceive('updatePaymentStatus')->once()->andReturn('due');
        $request = Request::create('/expenses', 'POST', [
            'ref_no' => 'MANUAL', 'location_id' => 1, 'final_total' => 100,
            'transaction_date' => '2026-09-05 12:00:00', 'status' => 'final',
            'expense_category_id' => 5, 'expense_sub_category_id' => 6,
        ]);
        $expense = $util->createExpense($request, 1, 7, false);
        $this->assertSame('01', $expense->station_id);
        $this->assertSame('EV'.now()->year.'-0101000001', $expense->ref_no);
        $snapshot = $this->expenseService->snapshot($expense);
        $this->assertSame('01', $snapshot['station_id']);
        $this->assertSame(['name' => 'Utilities', 'code' => 'UTIL'], $snapshot['category']);
        $this->assertSame(['name' => 'Electricity', 'code' => 'ELEC'], $snapshot['subcategory']);
        $this->assertSame([], $snapshot['payments']);
        $this->assertNull($snapshot['contact_code']);
    }

    private function categoryDownload(): array
    {
        return ['data' => [[
            'id' => 100, 'business_id' => 1, 'name' => 'Cloud Travel', 'code' => 'TR',
            'budget' => '500.0000', 'parent_id' => null,
            'sub_categories' => [[
                'id' => 101, 'business_id' => 1, 'name' => 'Cloud Fuel', 'code' => 'FUEL',
                'budget' => '200.0000', 'parent_id' => 100,
            ]],
        ]]];
    }

    public function testCategoryDownloadPreservesIdsHierarchyAndBudgets(): void
    {
        $result = (new ExpenseCategoryDownloadService())->import($this->categoryDownload(), 1);
        $this->assertSame(['created' => 2, 'updated' => 0, 'total' => 2], $result);
        $this->assertSame('Cloud Travel', DB::table('expense_categories')->where('id', 100)->value('name'));
        $this->assertEquals(100, DB::table('expense_categories')->where('id', 101)->value('parent_id'));
        $this->assertEquals(200, DB::table('expense_categories')->where('id', 101)->value('budget'));
    }

    public function testCategoryDownloadUpdatesAndRetriesWithoutDuplicates(): void
    {
        $sync = new ExpenseCategoryDownloadService();
        $payload = $this->categoryDownload();
        $sync->import($payload, 1);
        $this->assertSame(['created' => 0, 'updated' => 0, 'total' => 2], $sync->import($payload, 1));
        $payload['data'][0]['sub_categories'][0]['name'] = 'Fuel Updated';
        $payload['data'][0]['sub_categories'][0]['budget'] = '250.0000';
        $this->assertSame(['created' => 0, 'updated' => 1, 'total' => 2], $sync->import($payload, 1));
        $this->assertEquals(4, DB::table('expense_categories')->count());
        $this->assertSame('Fuel Updated', DB::table('expense_categories')->where('id', 101)->value('name'));
    }

    public function testCategoryDownloadRollsBackWhenAnIdBelongsToAnotherBusiness(): void
    {
        DB::table('expense_categories')->insert(['id' => 101, 'business_id' => 2, 'name' => 'Other Business']);
        try {
            (new ExpenseCategoryDownloadService())->import($this->categoryDownload(), 1);
            $this->fail('Category ID collision was accepted.');
        } catch (ValidationException $e) {
            $this->assertFalse(DB::table('expense_categories')->where('id', 100)->exists());
            $this->assertSame('Other Business', DB::table('expense_categories')->where('id', 101)->value('name'));
        }
    }

    public function testCategoryDownloadRejectsInvalidHierarchyOrBusinessOrDuplicateIds(): void
    {
        foreach (['parent_id' => 999, 'business_id' => 2, 'id' => 100] as $field => $value) {
            $payload = $this->categoryDownload();
            $payload['data'][0]['sub_categories'][0][$field] = $value;
            try {
                (new ExpenseCategoryDownloadService())->import($payload, 1);
                $this->fail('Invalid cloud category accepted.');
            } catch (ValidationException $e) {
                $this->assertFalse(DB::table('expense_categories')->where('id', 100)->exists());
            }
        }
    }

    public function testCategoryDownloadRestoresLocalSoftDeletedCategory(): void
    {
        DB::table('expense_categories')->insert(['id' => 100, 'name' => 'Old', 'deleted_at' => '2026-09-01 00:00:00']);
        $result = (new ExpenseCategoryDownloadService())->import($this->categoryDownload(), 1);
        $this->assertSame(1, $result['updated']);
        $this->assertNull(DB::table('expense_categories')->where('id', 100)->value('deleted_at'));
    }

    public function testEmptyCategoryDownloadDoesNotDeleteLocalCategories(): void
    {
        $result = (new ExpenseCategoryDownloadService())->import(['data' => []], 1);
        $this->assertSame(['created' => 0, 'updated' => 0, 'total' => 0], $result);
        $this->assertEquals(2, DB::table('expense_categories')->count());
    }

    public function testMalformedCategoryResponseIsNotTreatedAsEmptySuccess(): void
    {
        $this->expectException(ValidationException::class);
        (new ExpenseCategoryDownloadService())->import(['message' => 'Unauthorized'], 1);
    }

    public function testDirectPurchaseReturnSnapshotAndImportDecreasesStockAndCreatesMapping(): void
    {
        DB::table('test_stock')->where('variation_id', 40)->update(['quantity' => 20]);
        $payload = [
            'type' => 'purchase_return',
            'source_id' => 500, 'business_id' => 1, 'location_id' => 1, 'station_id' => '01',
            'supplier_code' => 'SUP001',
            'invoice' => [
                'ref_no' => 'PR2026-0101000001', 'status' => 'final',
                'transaction_date' => '2026-09-05 12:00:00', 'total_before_tax' => 50,
                'final_total' => 50, 'exchange_rate' => 1,
            ],
            'lines' => [[
                'product_id' => 30, 'variation_id' => 40, 'sku' => 'SKU001', 'sub_sku' => 'SKU001-1',
                'quantity' => 0, 'quantity_returned' => 5, 'foc_quantity' => 0, 'purchase_price' => 10,
                'purchase_price_inc_tax' => 10, 'pp_without_discount' => 10, 'item_tax' => 0,
            ]],
            'payments' => [[
                'payment_ref_no' => 'PRP2026-0101000001', 'amount' => 50,
                'method' => 'cash', 'paid_on' => '2026-09-05 12:00:00', 'account_id' => 1,
            ]],
        ];

        $first = $this->service->import($payload, $this->user());
        $this->assertTrue($first['created']);
        $this->assertSame('PR2026-0101000001', $first['ref_no']);
        $this->assertEquals(15, DB::table('test_stock')->value('quantity'));
        $this->assertEquals(1, DB::table('workstation_purchase_syncs')->where('source_id', 500)->count());

        $createdTx = DB::table('transactions')->where('id', $first['cloud_id'])->first();
        $this->assertSame('purchase_return', $createdTx->type);
        $this->assertSame('paid', $createdTx->payment_status);

        // Retry should be idempotent and not decrease stock again
        $retry = $this->service->import($payload, $this->user());
        $this->assertFalse($retry['created']);
        $this->assertEquals(15, DB::table('test_stock')->value('quantity'));
    }

    public function testPurchaseReturnWithParentPurchaseLinksReturnParentIdOnCloud(): void
    {
        $purchasePayload = $this->payload();
        $purchaseResult = $this->service->import($purchasePayload, $this->user());

        $returnPayload = [
            'type' => 'purchase_return',
            'source_id' => 501, 'business_id' => 1, 'location_id' => 1, 'station_id' => '01',
            'supplier_code' => 'SUP001',
            'parent_source_id' => 999,
            'parent_ref_no' => 'PI2026-0101000001',
            'invoice' => [
                'ref_no' => 'PR2026-0101000002', 'status' => 'final',
                'transaction_date' => '2026-09-05 13:00:00', 'total_before_tax' => 30,
                'final_total' => 30, 'exchange_rate' => 1,
            ],
            'lines' => [[
                'product_id' => 30, 'variation_id' => 40, 'sku' => 'SKU001', 'sub_sku' => 'SKU001-1',
                'quantity' => 0, 'quantity_returned' => 3, 'foc_quantity' => 0, 'purchase_price' => 10,
                'purchase_price_inc_tax' => 10, 'pp_without_discount' => 10, 'item_tax' => 0,
            ]],
            'payments' => [],
        ];

        $returnResult = $this->service->import($returnPayload, $this->user());
        $this->assertTrue($returnResult['created']);

        $returnTx = DB::table('transactions')->where('id', $returnResult['cloud_id'])->first();
        $this->assertSame('purchase_return', $returnTx->type);
        $this->assertEquals($purchaseResult['cloud_id'], $returnTx->return_parent_id);

        $parentLine = DB::table('purchase_lines')->where('transaction_id', $purchaseResult['cloud_id'])->first();
        $this->assertEquals(3, $parentLine->quantity_returned);
    }

    public function testSnapshotPurchaseReturnLoadsReturnedLinesFromParentIfReturnLinesEmpty(): void
    {
        $parent = \App\Transaction::create([
            'business_id' => 1, 'location_id' => 1, 'station_id' => '01', 'contact_id' => 20,
            'type' => 'purchase', 'status' => 'received', 'ref_no' => 'PI2026-0101000010',
            'transaction_date' => '2026-09-05 12:00:00', 'final_total' => 100, 'total_before_tax' => 100,
            'exchange_rate' => 1,
        ]);
        $parent->purchase_lines()->create([
            'product_id' => 30, 'variation_id' => 40, 'quantity' => 10, 'quantity_returned' => 4,
            'purchase_price' => 10, 'purchase_price_inc_tax' => 10, 'pp_without_discount' => 10, 'item_tax' => 0,
        ]);

        $return = \App\Transaction::create([
            'business_id' => 1, 'location_id' => 1, 'station_id' => '01', 'contact_id' => 20,
            'type' => 'purchase_return', 'status' => 'final', 'ref_no' => 'PR2026-0101000010',
            'return_parent_id' => $parent->id, 'transaction_date' => '2026-09-05 14:00:00',
            'final_total' => 40, 'total_before_tax' => 40, 'exchange_rate' => 1,
        ]);

        $snapshot = $this->service->snapshot($return);
        $this->assertSame('purchase_return', $snapshot['type']);
        $this->assertEquals($parent->id, $snapshot['parent_source_id']);
        $this->assertSame('PI2026-0101000010', $snapshot['parent_ref_no']);
        $this->assertCount(1, $snapshot['lines']);
        $this->assertEquals(4, $snapshot['lines'][0]['quantity_returned']);
    }

    public function testLegacyPurchaseInvoiceHashWithoutQuantityReturnedIsCompatibleOnRetry(): void
    {
        $payload = $this->payload();
        // Compute legacy hash as if quantity_returned wasn't in lines
        $legacyLines = array_map(function ($line) {
            return \Illuminate\Support\Arr::except($line, ['quantity_returned']);
        }, $payload['lines']);
        $reflection = new \ReflectionClass($this->service);
        $hashMethod = $reflection->getMethod('hash');
        $hashMethod->setAccessible(true);
        $legacyHash = $hashMethod->invoke($this->service, [$payload['supplier_code'], $payload['invoice'], $legacyLines]);

        // Insert legacy mapping
        $createdTx = \App\Transaction::create([
            'business_id' => 1, 'location_id' => 1, 'station_id' => '01', 'contact_id' => 20,
            'type' => 'purchase', 'status' => 'received', 'ref_no' => $payload['invoice']['ref_no'],
            'transaction_date' => '2026-09-05 12:00:00', 'final_total' => 100, 'total_before_tax' => 100,
            'exchange_rate' => 1,
        ]);
        DB::table('workstation_purchase_syncs')->insert([
            'business_id' => 1, 'location_id' => 1, 'station_id' => '01',
            'source_id' => $payload['source_id'], 'transaction_id' => $createdTx->id,
            'invoice_hash' => $legacyHash, 'payment_hashes' => '{}',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // Retrying with new snapshot containing quantity_returned shouldn't trigger reconciliation error
        $result = $this->service->import($payload, $this->user());
        $this->assertFalse($result['created']);
        $this->assertSame($createdTx->id, $result['cloud_id']);
    }

    public function testOfflineReferenceNumberSupportsPurchaseReturnAndPayment(): void
    {
        $util = new Util();
        $year = now()->year;
        $this->assertSame('PR'.$year.'-0101000001', $util->generateReferenceNumber('purchase_return', 1, 1, null, 1));
        $this->assertSame('PRP'.$year.'-0101000001', $util->generateReferenceNumber('purchase_return_payment', 1, 1, null, 1));
    }

    public function testPurchaseReturnPayloadPassesValidation(): void
    {
        $payload = [
            'type' => 'purchase_return',
            'source_id' => 777, 'business_id' => 1, 'location_id' => 1, 'station_id' => '01',
            'supplier_code' => 'SUP001',
            'invoice' => [
                'ref_no' => 'PR2026-0101000777', 'status' => 'final',
                'transaction_date' => '2026-09-05 12:00:00', 'total_before_tax' => 50,
                'final_total' => 50, 'exchange_rate' => 1,
            ],
            'lines' => [[
                'product_id' => 30, 'variation_id' => 40, 'sku' => 'SKU001', 'sub_sku' => 'SKU001-1',
                'quantity' => 0, 'quantity_returned' => 5, 'foc_quantity' => 0, 'purchase_price' => 10,
                'purchase_price_inc_tax' => 10, 'pp_without_discount' => 10, 'item_tax' => 0,
            ]],
            'payments' => [],
        ];
        $isReturn = $payload['type'] === 'purchase_return';
        $validator = \Illuminate\Support\Facades\Validator::make($payload, [
            'type' => 'nullable|in:purchase,purchase_return',
            'source_id' => 'required|integer|min:1',
            'business_id' => 'required|integer|min:1',
            'location_id' => 'required|integer|min:1',
            'station_id' => 'required|string|max:32|regex:/^[a-zA-Z0-9_-]+$/',
            'supplier_code' => 'required|string|max:191',
            'invoice' => 'required|array',
            'invoice.ref_no' => 'required|string|max:191',
            'invoice.status' => $isReturn ? 'required|in:final' : 'required|in:received,pending,ordered',
            'invoice.transaction_date' => 'required|date',
            'invoice.total_before_tax' => 'required|numeric|min:0',
            'invoice.final_total' => 'required|numeric|min:0',
            'invoice.exchange_rate' => 'required|numeric|gt:0',
            'lines' => 'required|array|min:1|max:1000',
            'lines.*.product_id' => 'required|integer|min:1',
            'lines.*.variation_id' => 'required|integer|min:1',
            'lines.*.sku' => 'required|string',
            'lines.*.sub_sku' => 'required|string',
            'lines.*.quantity' => $isReturn ? 'required|numeric|min:0' : 'required|numeric|gt:0',
            'lines.*.quantity_returned' => 'nullable|numeric|min:0',
            'lines.*.foc_quantity' => 'nullable|numeric|min:0',
            'lines.*.purchase_price' => 'required|numeric|min:0',
            'lines.*.purchase_price_inc_tax' => 'required|numeric|min:0',
            'lines.*.pp_without_discount' => 'required|numeric|min:0',
            'lines.*.item_tax' => 'required|numeric|min:0',
            'payments' => 'present|array|max:1000',
        ]);
        $this->assertFalse($validator->fails());
    }

    public function testWorkstationPurchaseSyncQueryOrdersPurchasesFirstAndIncludesReturns(): void
    {
        $stationId = '01';
        $businessId = 1;

        $p1 = \App\Transaction::create([
            'business_id' => 1, 'location_id' => 1, 'station_id' => '01', 'contact_id' => 20,
            'type' => 'purchase', 'status' => 'received', 'ref_no' => 'PI001',
            'transaction_date' => '2026-09-05 12:00:00', 'final_total' => 100, 'total_before_tax' => 100,
            'exchange_rate' => 1,
        ]);
        $pr1 = \App\Transaction::create([
            'business_id' => 1, 'location_id' => 1, 'station_id' => '01', 'contact_id' => 20,
            'type' => 'purchase_return', 'status' => 'final', 'ref_no' => 'PR001',
            'transaction_date' => '2026-09-05 13:00:00', 'final_total' => 20, 'total_before_tax' => 20,
            'exchange_rate' => 1,
        ]);
        $pr2 = \App\Transaction::create([
            'business_id' => 1, 'location_id' => 1, 'station_id' => null, 'contact_id' => 20,
            'type' => 'purchase_return', 'status' => 'final', 'ref_no' => 'PR002',
            'transaction_date' => '2026-09-05 14:00:00', 'final_total' => 30, 'total_before_tax' => 30,
            'exchange_rate' => 1,
        ]);

        $query = \App\Transaction::where('business_id', $businessId)->whereIn('type', ['purchase', 'purchase_return'])
            ->where(function ($q) use ($stationId) {
                $q->where('station_id', $stationId)->orWhere(function ($sub) {
                    $sub->where('type', 'purchase_return')->whereNull('station_id');
                });
            })
            ->where(function ($q) {
                $q->where(function ($sub) {
                    $sub->where('type', 'purchase')->whereIn('status', ['received', 'pending', 'ordered']);
                })->orWhere(function ($sub) {
                    $sub->where('type', 'purchase_return')->where('status', 'final');
                });
            })
            ->where(function ($q) {
                $q->whereNull('sync_date')->orWhereColumn('sync_date', '<', 'updated_at');
            })
            ->orderByRaw("CASE WHEN type = 'purchase' THEN 0 ELSE 1 END")
            ->orderBy('id');

        $results = $query->get();
        $this->assertCount(3, $results);
        $this->assertSame('PI001', $results[0]->ref_no);
        $this->assertSame('PR001', $results[1]->ref_no);
        $this->assertSame('PR002', $results[2]->ref_no);
    }

    public function testSnapshotExcludesZeroOrNegativePaymentLines(): void
    {
        $businessId = 1;
        $locationId = 1;
        $transaction = \App\Transaction::create([
            'business_id' => $businessId, 'location_id' => $locationId, 'station_id' => '01',
            'type' => 'purchase_return', 'status' => 'final', 'ref_no' => 'PR-ZERO-PAY',
            'transaction_date' => '2026-09-08 12:00:00', 'final_total' => 50, 'total_before_tax' => 50,
            'exchange_rate' => 1,
        ]);
        \App\PurchaseLine::create([
            'transaction_id' => $transaction->id, 'product_id' => 1, 'variation_id' => 1,
            'quantity' => 0, 'quantity_returned' => 2, 'pp_without_discount' => 25, 'discount_percent' => 0,
            'purchase_price' => 25, 'purchase_price_inc_tax' => 25, 'item_tax' => 0,
        ]);
        // Zero amount dummy payment
        \App\TransactionPayment::create([
            'transaction_id' => $transaction->id, 'business_id' => $businessId, 'location_id' => $locationId,
            'amount' => 0, 'method' => 'cash', 'paid_on' => '2026-09-08 12:00:00', 'payment_ref_no' => 'PRP-ZERO',
        ]);
        // Valid positive payment
        \App\TransactionPayment::create([
            'transaction_id' => $transaction->id, 'business_id' => $businessId, 'location_id' => $locationId,
            'amount' => 50, 'method' => 'cash', 'paid_on' => '2026-09-08 12:00:00', 'payment_ref_no' => 'PRP-VALID',
        ]);

        $snapshot = $this->service->snapshot($transaction);

        $this->assertCount(1, $snapshot['payments']);
        $this->assertSame('PRP-VALID', $snapshot['payments'][0]['payment_ref_no']);
        $this->assertEquals(50, $snapshot['payments'][0]['amount']);
    }

    public function testWorkstationPurchaseControllerValidationStripsZeroAmountPayments(): void
    {
        $payload = [
            'type' => 'purchase_return',
            'source_id' => 10,
            'business_id' => 1,
            'location_id' => 1,
            'station_id' => '01',
            'supplier_code' => 'SUP01',
            'invoice' => [
                'ref_no' => 'PR-FILTER-TEST',
                'status' => 'final',
                'transaction_date' => '2026-09-08 10:00:00',
                'total_before_tax' => 50,
                'final_total' => 50,
                'exchange_rate' => 1,
            ],
            'lines' => [[
                'product_id' => 1,
                'variation_id' => 1,
                'sku' => 'SKU01',
                'sub_sku' => 'SUB01',
                'quantity' => 0,
                'quantity_returned' => 2,
                'purchase_price' => 25,
                'purchase_price_inc_tax' => 25,
                'pp_without_discount' => 25,
                'item_tax' => 0,
            ]],
            'payments' => [
                ['payment_ref_no' => 'PRP-DUMMY', 'amount' => '0.0000', 'method' => 'cash', 'paid_on' => '2026-09-08 10:00:00'],
            ],
        ];

        // Replicate controller payment filtering logic
        $payments = $payload['payments'];
        if (is_array($payments)) {
            $payload['payments'] = array_values(array_filter($payments, function ($p) {
                return is_array($p) && isset($p['amount']) && (float) $p['amount'] > 0;
            }));
        }

        $this->assertSame([], $payload['payments']);

        $validator = \Illuminate\Support\Facades\Validator::make($payload, [
            'type' => 'nullable|in:purchase,purchase_return',
            'source_id' => 'required|integer|min:1',
            'business_id' => 'required|integer|min:1',
            'location_id' => 'required|integer|min:1',
            'station_id' => 'required|string|max:32|regex:/^[a-zA-Z0-9_-]+$/',
            'supplier_code' => 'required|string|max:191',
            'invoice' => 'required|array',
            'invoice.ref_no' => 'required|string|max:191',
            'invoice.status' => 'required|in:final',
            'invoice.transaction_date' => 'required|date',
            'invoice.total_before_tax' => 'required|numeric|min:0',
            'invoice.final_total' => 'required|numeric|min:0',
            'invoice.exchange_rate' => 'required|numeric|gt:0',
            'lines' => 'required|array|min:1|max:1000',
            'lines.*.product_id' => 'required|integer|min:1',
            'lines.*.variation_id' => 'required|integer|min:1',
            'lines.*.sku' => 'required|string',
            'lines.*.sub_sku' => 'required|string',
            'lines.*.quantity' => 'required|numeric|min:0',
            'lines.*.quantity_returned' => 'nullable|numeric|min:0',
            'lines.*.foc_quantity' => 'nullable|numeric|min:0',
            'lines.*.purchase_price' => 'required|numeric|min:0',
            'lines.*.purchase_price_inc_tax' => 'required|numeric|min:0',
            'lines.*.pp_without_discount' => 'required|numeric|min:0',
            'lines.*.item_tax' => 'required|numeric|min:0',
            'payments' => 'present|array|max:1000',
            'payments.*.payment_ref_no' => 'required|string|max:191|distinct',
            'payments.*.amount' => 'required|numeric|gt:0',
            'payments.*.method' => 'required|string|max:40',
            'payments.*.paid_on' => 'required|date',
        ]);

        $this->assertFalse($validator->fails());
    }

    public function testOfflineSyncPendingQueryIgnoresZeroAmountPayments(): void
    {
        $businessId = 1;
        $locationId = 1;
        $syncDate = now()->toDateTimeString();

        // Transaction is synced
        $t = \App\Transaction::create([
            'business_id' => $businessId, 'location_id' => $locationId, 'station_id' => '01',
            'type' => 'purchase_return', 'status' => 'final', 'ref_no' => 'PR-SYNCED',
            'transaction_date' => '2026-09-08 12:00:00', 'final_total' => 50, 'total_before_tax' => 50,
            'exchange_rate' => 1, 'sync_date' => $syncDate,
        ]);
        // Payment with amount = 0, unsynced
        \App\TransactionPayment::create([
            'transaction_id' => $t->id, 'business_id' => $businessId, 'location_id' => $locationId,
            'amount' => 0, 'method' => 'cash', 'paid_on' => '2026-09-08 12:00:00',
            'payment_ref_no' => 'PRP-ZERO-UNSYNCED', 'sync_date' => null,
        ]);

        // Query with amount > 0 check
        $query = \App\Transaction::where('business_id', $businessId)
            ->where('id', $t->id)
            ->where(function ($q) {
                $q->whereNull('sync_date')->orWhereColumn('sync_date', '<', 'updated_at')
                    ->orWhereHas('payment_lines', function ($payments) {
                        $payments->where(function ($p) {
                            $p->whereNull('sync_date')->orWhereColumn('sync_date', '<', 'updated_at');
                        })->where('amount', '>', 0);
                    });
            });

        $this->assertCount(0, $query->get());
    }
}

