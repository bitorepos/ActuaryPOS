<?php

namespace Tests\Unit;

use App\CashRegisterTransaction;
use App\Transaction;
use App\Utils\CashRegisterUtil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CashRegisterPaymentMethodEditTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'database.connections.sqlite.foreign_key_constraints' => false,
            'constants.is_offline' => false,
        ]);
        DB::purge('sqlite');

        Schema::create('cash_registers', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('status');
            $table->boolean('is_offline')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('cash_register_transactions', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('cash_register_id');
            $table->decimal('amount', 22, 4);
            $table->string('pay_method');
            $table->string('pay_sub_method')->nullable();
            $table->string('type');
            $table->string('transaction_type');
            $table->unsignedInteger('transaction_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('business_locations', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('business_id')->nullable();
            $table->text('default_payment_accounts')->nullable();
        });

        DB::table('cash_registers')->insert([
            'id' => 1,
            'user_id' => 7,
            'status' => 'open',
            'is_offline' => false,
        ]);
        DB::table('business_locations')->insert([
            'id' => 2,
            'default_payment_accounts' => json_encode([
                'cash' => ['sub_method' => null],
                'bank_transfer' => ['sub_method' => null],
            ]),
        ]);
        DB::table('cash_register_transactions')->insert([
            'cash_register_id' => 1,
            'amount' => 2001,
            'pay_method' => 'cash',
            'type' => 'credit',
            'transaction_type' => 'sell',
            'transaction_id' => 42,
        ]);

        Auth::shouldReceive('user')->andReturn((object) ['id' => 7]);
    }

    public function test_editing_payment_methods_reallocates_register_sales_without_recording_a_return(): void
    {
        $this->assertPaymentMethodAllocationIsReconciled(1);
    }

    public function test_resaving_an_invoice_repairs_its_existing_sale_and_return_register_rows(): void
    {
        DB::table('cash_register_transactions')->insert([
            [
                'cash_register_id' => 1,
                'amount' => 501,
                'pay_method' => 'cash',
                'type' => 'debit',
                'transaction_type' => 'refund',
                'transaction_id' => 42,
            ],
            [
                'cash_register_id' => 1,
                'amount' => 501,
                'pay_method' => 'bank_transfer',
                'type' => 'credit',
                'transaction_type' => 'sell',
                'transaction_id' => 42,
            ],
        ]);

        $this->assertPaymentMethodAllocationIsReconciled(3);
    }

    private function assertPaymentMethodAllocationIsReconciled(int $expectedDeletedRows): void
    {
        $transaction = new Transaction();
        $transaction->id = 42;
        $transaction->location_id = 2;
        $transaction->type = 'sell';
        $transaction->status = 'final';

        (new CashRegisterUtil())->updateSellPayments('final', $transaction, [
            ['method' => 'cash', 'amount' => 1500, 'is_return' => 0],
            ['method' => 'bank_transfer', 'amount' => 501, 'is_return' => 0],
        ]);

        $active_payments = CashRegisterTransaction::where('cash_register_id', 1)
            ->where('transaction_id', 42)
            ->whereNull('deleted_at')
            ->get();

        $this->assertSame(2, $active_payments->count());
        $this->assertSame(0, $active_payments->where('transaction_type', 'refund')->count());
        $this->assertEquals(1500, $active_payments->where('pay_method', 'cash')->sum('amount'));
        $this->assertEquals(501, $active_payments->where('pay_method', 'bank_transfer')->sum('amount'));
        $this->assertSame(
            $expectedDeletedRows,
            CashRegisterTransaction::withTrashed()
                ->where('transaction_id', 42)
                ->whereNotNull('deleted_at')
                ->count()
        );
    }
}
