<?php

namespace Tests\Unit;

use App\Transaction;
use Illuminate\Support\Facades\DB;
use Modules\Accounting\Utils\AccountingRemapUtil;
use Tests\TestCase;

class PayrollAdvanceAccountingDefaultsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');

        DB::statement('CREATE TABLE business_locations (id INTEGER PRIMARY KEY, business_id INTEGER, accounting_default_map TEXT, default_payment_accounts TEXT)');
        DB::statement('CREATE TABLE accounting_accounts (id INTEGER PRIMARY KEY, business_id INTEGER, name TEXT, status TEXT)');

        DB::table('accounting_accounts')->insert([
            ['id' => 1, 'business_id' => 1, 'name' => 'Cash in Hand', 'status' => 'active'],
            ['id' => 2, 'business_id' => 1, 'name' => 'Payroll liabilities', 'status' => 'active'],
            ['id' => 3, 'business_id' => 1, 'name' => 'Payroll Advance Clearing', 'status' => 'active'],
            ['id' => 4, 'business_id' => 1, 'name' => 'Bank Account', 'status' => 'active'],
        ]);
    }

    public function test_payroll_advance_defaults_and_payment_method_override(): void
    {
        DB::table('business_locations')->insert([
            'id' => 1,
            'business_id' => 1,
            'accounting_default_map' => null,
            'default_payment_accounts' => null,
        ]);

        $transaction = new Transaction([
            'location_id' => 1,
            'sub_status' => 'cash',
        ]);

        $util = new AccountingRemapUtil();
        [$credit, $debit] = $util->getPayrollAdvanceDefaultAccounts($transaction, 1);

        $this->assertSame('Cash in Hand', $credit->name);
        $this->assertSame('Payroll liabilities', $debit->name);

        DB::table('business_locations')->where('id', 1)->update([
            'accounting_default_map' => json_encode([
                'payroll_advance' => ['payment_account' => 3, 'deposit_to' => 2],
            ]),
        ]);

        [$credit, $debit] = $util->getPayrollAdvanceDefaultAccounts($transaction, 1);
        $this->assertSame(3, $credit->id);
        $this->assertSame(2, $debit->id);

        DB::table('business_locations')->where('id', 1)->update([
            'default_payment_accounts' => json_encode([
                'bank_transfer' => ['account' => 4],
            ]),
        ]);
        $transaction->sub_status = 'bank_transfer';

        [$credit, $debit] = $util->getPayrollAdvanceDefaultAccounts($transaction, 1);
        $this->assertSame(4, $credit->id);
        $this->assertSame(2, $debit->id);
    }
}
