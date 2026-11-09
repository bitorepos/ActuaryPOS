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

    public function test_admin_edits_the_cashiers_open_register_instead_of_the_admins_register(): void
    {
        DB::table('cash_registers')->where('id', 1)->update(['user_id' => 8]);
        DB::table('cash_registers')->insert([
            'id' => 2,
            'user_id' => 7,
            'status' => 'open',
            'is_offline' => false,
        ]);

        $this->updateSalePaymentMethods();

        $active_payments = CashRegisterTransaction::where('cash_register_id', 1)
            ->whereNull('deleted_at')
            ->get();
        $this->assertSame(2, $active_payments->count());
        $this->assertEquals(1500, $active_payments->where('pay_method', 'cash')->sum('amount'));
        $this->assertEquals(501, $active_payments->where('pay_method', 'bank_transfer')->sum('amount'));
        $this->assertSame(
            0,
            CashRegisterTransaction::where('cash_register_id', 2)->whereNull('deleted_at')->count()
        );

        $cash_register_util = new CashRegisterUtil();
        $cash_register_util->deleteSellPayment(
            (object) ['transaction_id' => 42, 'method' => 'cash', 'amount' => 1500]
        );
        $cash_register_util->deleteTransactionPayments($this->saleTransaction());
        $this->assertSame(
            0,
            CashRegisterTransaction::where('cash_register_id', 1)->whereNull('deleted_at')->count()
        );
    }

    public function test_admin_can_edit_a_payment_in_the_cashiers_open_register(): void
    {
        DB::table('cash_registers')->where('id', 1)->update(['user_id' => 8]);

        (new CashRegisterUtil())->updatePayment(
            (object) ['transaction_id' => 42, 'method' => 'cash', 'amount' => 2001],
            (object) ['method' => 'bank_transfer', 'sub_method' => null, 'amount' => 1800]
        );

        $payment = CashRegisterTransaction::where('cash_register_id', 1)->first();
        $this->assertSame('bank_transfer', $payment->pay_method);
        $this->assertEquals(1800, $payment->amount);
    }

    public function test_restoring_a_payment_does_not_change_a_register_after_it_is_closed(): void
    {
        $cash_register_util = new CashRegisterUtil();
        $cash_register_util->deleteTransactionPayments($this->saleTransaction());
        DB::table('cash_registers')->where('id', 1)->update(['status' => 'close']);

        $cash_register_util->restoreTransactionPayments($this->saleTransaction());

        $this->assertSame(
            0,
            CashRegisterTransaction::where('cash_register_id', 1)->whereNull('deleted_at')->count()
        );
        $this->assertSame(
            1,
            CashRegisterTransaction::withTrashed()
                ->where('cash_register_id', 1)
                ->whereNotNull('deleted_at')
                ->count()
        );
    }

    public function test_closed_register_summary_uses_values_captured_at_close(): void
    {
        $cash_register_util = new CashRegisterUtil();
        $register_details = (object) [
            'status' => 'close',
            'total_sale' => 17238,
            'no_of_sales' => 13,
        ];
        $details = [
            'transaction_details' => (object) [
                'total_sales' => 17238,
                'total_sales_return' => 0,
                'total_discount' => 20,
            ],
            'total_tax_collected' => 2511.65,
            'total_product_discount' => 0,
            'types_of_service_details' => collect([
                (object) ['types_of_service_name' => 'Dine-in', 'no_of_transactions' => 2],
            ]),
            'expense_details' => collect([
                (object) ['ref_no' => 'EXP-1', 'final_total' => 400],
            ]),
        ];
        $snapshot = $cash_register_util->captureRegisterSummarySnapshot($register_details, $details);

        $register_details->total_sale = 15237;
        $register_details->no_of_sales = 12;
        $details['transaction_details']->total_sales = 15237;
        $details['transaction_details']->total_discount = 0;
        $details['total_tax_collected'] = 2206.55;
        $details['types_of_service_details'] = collect();
        $details['expense_details'] = collect();

        $details = $cash_register_util->applyRegisterSummarySnapshot($register_details, $details, $snapshot);

        $this->assertSame(17238, $register_details->total_sale);
        $this->assertSame(13, $register_details->no_of_sales);
        $this->assertSame(17238, $details['transaction_details']->total_sales);
        $this->assertSame(20, $details['transaction_details']->total_discount);
        $this->assertSame(2511.65, $details['total_tax_collected']);
        $this->assertSame('Dine-in', $details['types_of_service_details']->first()->types_of_service_name);
        $this->assertSame('EXP-1', $details['expense_details']->first()->ref_no);
    }

    public function test_editing_or_deleting_a_sale_does_not_change_closed_registers(): void
    {
        DB::table('cash_registers')->where('id', 1)->update(['status' => 'close', 'user_id' => 8]);
        DB::table('cash_registers')->insert([
            'id' => 2,
            'user_id' => 7,
            'status' => 'open',
            'is_offline' => false,
        ]);

        $this->updateSalePaymentMethods();
        (new CashRegisterUtil())->deleteSellPayment(
            (object) ['transaction_id' => 42, 'method' => 'cash', 'amount' => 2001]
        );
        (new CashRegisterUtil())->deleteTransactionPayments($this->saleTransaction());

        $this->assertSame(
            1,
            CashRegisterTransaction::where('cash_register_id', 1)->whereNull('deleted_at')->count()
        );
        $this->assertSame(
            0,
            CashRegisterTransaction::where('cash_register_id', 2)->whereNull('deleted_at')->count()
        );
    }

    private function assertPaymentMethodAllocationIsReconciled(int $expectedDeletedRows): void
    {
        $this->updateSalePaymentMethods();

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

    private function updateSalePaymentMethods(): void
    {
        (new CashRegisterUtil())->updateSellPayments('final', $this->saleTransaction(), [
            ['method' => 'cash', 'amount' => 1500, 'is_return' => 0],
            ['method' => 'bank_transfer', 'amount' => 501, 'is_return' => 0],
        ]);
    }

    private function saleTransaction(): Transaction
    {
        $transaction = new Transaction();
        $transaction->id = 42;
        $transaction->location_id = 2;
        $transaction->type = 'sell';
        $transaction->status = 'final';

        return $transaction;
    }
}
