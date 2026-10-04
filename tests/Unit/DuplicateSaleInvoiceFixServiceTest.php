<?php

namespace Tests\Unit;

use App\Services\DuplicateSaleInvoiceFixService;
use App\Transaction;
use App\Utils\TransactionUtil;
use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use Mockery;
use PHPUnit\Framework\TestCase;
use Spatie\Activitylog\ActivityLogStatus;
use Spatie\Activitylog\ActivityLogger;

class DuplicateSaleInvoiceFixServiceTest extends TestCase
{
    private $previousContainer;
    private $previousFacade;
    private $previousResolver;
    private $capsule;
    private $transactionUtil;
    private $service;

    protected function setUp(): void
    {
        $this->previousContainer = Container::getInstance();
        $this->previousFacade = Facade::getFacadeApplication();
        $this->previousResolver = Model::getConnectionResolver();

        $this->capsule = new Capsule();
        $app = $this->capsule->getContainer();
        Container::setInstance($app);
        $this->capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $app->instance('db', $this->capsule->getDatabaseManager());
        $app->instance('db.schema', $this->capsule->getConnection()->getSchemaBuilder());
        $config = new Repository([
            'database' => ['default' => 'default', 'connections' => ['default' => ['driver' => 'sqlite', 'database' => ':memory:']]],
            'constants' => ['invoice_scheme_separator' => '-'],
            'activitylog' => ['default_log_name' => 'default', 'enabled' => false],
        ]);
        $app->instance('config', $config);
        $app->instance(\Illuminate\Contracts\Config\Repository::class, $config);
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($app);
        $this->capsule->bootEloquent();
        Model::unsetEventDispatcher();
        $activityLogger = Mockery::mock(ActivityLogger::class);
        $activityLogger->shouldReceive('useLog')->andReturnSelf();
        $activityLogger->shouldReceive('setLogStatus')->andReturnSelf();
        $activityLogger->shouldReceive('performedOn')->andReturnSelf();
        $activityLogger->shouldReceive('withProperties')->andReturnSelf();
        $activityLogger->shouldReceive('log')->andReturnNull();
        $app->instance(ActivityLogger::class, $activityLogger);
        $app->instance(ActivityLogStatus::class, new ActivityLogStatus($config));

        $schema = $this->capsule->getConnection()->getSchemaBuilder();
        $schema->create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id');
            $table->integer('location_id')->nullable();
            $table->integer('contact_id')->nullable();
            $table->string('type');
            $table->string('status');
            $table->string('transaction_date');
            $table->decimal('final_total', 22, 4);
            $table->string('invoice_no')->nullable();
            $table->string('fbr_invoice_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        $schema->create('transaction_sell_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaction_id');
            $table->integer('product_id')->nullable();
            $table->integer('variation_id')->nullable();
            $table->decimal('quantity', 22, 4)->nullable();
            $table->decimal('unit_price', 22, 4)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        $schema->create('business_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id');
            $table->integer('invoice_scheme_id')->nullable();
            $table->string('loc_code')->nullable();
            $table->timestamps();
        });

        $this->transactionUtil = Mockery::mock(TransactionUtil::class);
        $this->service = new DuplicateSaleInvoiceFixService($this->transactionUtil);
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

        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->previousFacade);
        Container::setInstance($this->previousContainer);
    }

    public function test_it_deletes_the_later_exact_copy_even_when_fbr_numbers_differ(): void
    {
        $keeper = $this->createSale('SI012026-0384', 'FBR-KEEP');
        $duplicate = $this->createSale('SI012026-0397', 'FBR-DUPLICATE');
        $this->addSaleLine($keeper, 1, '407.7800');
        $this->addSaleLine($duplicate, 1, '407.78');

        $this->transactionUtil->shouldReceive('deleteSale')
            ->once()
            ->with(1, $duplicate, false, true)
            ->andReturnUsing(function ($businessId, $transactionId) {
                Transaction::where('id', $transactionId)->delete();

                return ['success' => true];
            });

        $summary = $this->service->fixBusiness(1, ['sell', 'sales_order'], true);

        $this->assertSame(1, $summary['deleted_count']);
        $this->assertSame([$duplicate], $summary['deleted_transaction_ids']);
        $this->assertSame(0, $summary['renumbered_count']);
        $this->assertSame([$keeper], Transaction::pluck('id')->all());
        $this->assertNotNull(Transaction::withTrashed()->find($duplicate)->deleted_at);
    }

    public function test_it_keeps_same_header_sales_when_their_sale_lines_differ(): void
    {
        $first = $this->createSale('SI012026-0384', 'FBR-1');
        $second = $this->createSale('SI012026-0397', 'FBR-2');
        $this->addSaleLine($first, 1, '407.78');
        $this->addSaleLine($second, 2, '203.89');

        $this->transactionUtil->shouldNotReceive('deleteSale');

        $summary = $this->service->fixBusiness(1, ['sell', 'sales_order'], true);

        $this->assertSame(0, $summary['deleted_count']);
        $this->assertSame(0, $summary['renumbered_count']);
        $this->assertSame(2, Transaction::count());
    }

    public function test_it_still_renumbers_invoice_collisions_when_sale_lines_differ(): void
    {
        $first = $this->createSale('SI012026-0384', 'FBR-1');
        $second = $this->createSale('SI012026-0384', 'FBR-2');
        $this->addSaleLine($first, 1, '407.78');
        $this->addSaleLine($second, 2, '203.89');

        $this->transactionUtil->shouldNotReceive('deleteSale');

        $summary = $this->service->fixBusiness(1, ['sell', 'sales_order'], true);

        $this->assertSame(0, $summary['deleted_count']);
        $this->assertSame(1, $summary['renumbered_count']);
        $this->assertSame(['SI012026-0384', 'SI012026-0385'], Transaction::orderBy('id')->pluck('invoice_no')->all());
    }

    private function createSale(string $invoiceNo, string $fbrInvoiceNo): int
    {
        return DB::table('transactions')->insertGetId([
            'business_id' => 1,
            'location_id' => 1,
            'contact_id' => 10,
            'type' => 'sell',
            'status' => 'final',
            'transaction_date' => '2026-10-04 10:03:00',
            'final_total' => '407.7800',
            'invoice_no' => $invoiceNo,
            'fbr_invoice_no' => $fbrInvoiceNo,
            'created_at' => '2026-10-04 10:03:00',
            'updated_at' => '2026-10-04 10:03:00',
        ]);
    }

    private function addSaleLine(int $transactionId, int $quantity, string $unitPrice): void
    {
        DB::table('transaction_sell_lines')->insert([
            'transaction_id' => $transactionId,
            'product_id' => 5,
            'variation_id' => 8,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'created_at' => '2026-10-04 10:03:00',
            'updated_at' => '2026-10-04 10:03:00',
        ]);
    }
}
