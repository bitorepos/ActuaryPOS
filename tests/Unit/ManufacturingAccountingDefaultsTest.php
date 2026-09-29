<?php

namespace Tests\Unit;

use App\Transaction;
use Illuminate\Support\Facades\DB;
use Modules\Accounting\Utils\AccountingRemapUtil;
use Tests\TestCase;

class ManufacturingAccountingDefaultsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');

        DB::statement('CREATE TABLE business_locations (id INTEGER PRIMARY KEY, business_id INTEGER, accounting_default_map TEXT, default_payment_accounts TEXT)');
        DB::statement('CREATE TABLE accounting_accounts (id INTEGER PRIMARY KEY, business_id INTEGER, name TEXT, status TEXT)');

        DB::table('accounting_accounts')->insert([
            ['id' => 1, 'business_id' => 1, 'name' => 'Stock Inventory', 'status' => 'active'],
            ['id' => 2, 'business_id' => 1, 'name' => 'Production Clearing', 'status' => 'active'],
            ['id' => 3, 'business_id' => 1, 'name' => 'Reverse Production Clearing', 'status' => 'active'],
        ]);

        DB::table('business_locations')->insert([
            'id' => 1,
            'business_id' => 1,
            'accounting_default_map' => null,
            'default_payment_accounts' => null,
        ]);
    }

    public function test_production_and_reverse_production_use_inventory_defaults_and_saved_choices(): void
    {
        $util = new AccountingRemapUtil();
        $production = new Transaction(['location_id' => 1]);
        $reverse = new Transaction(['location_id' => 1, 'sub_type' => 'reverse']);

        foreach ([$production, $reverse] as $transaction) {
            [$credit, $debit] = $util->getProductionDefaultAccounts($transaction, 1);
            $this->assertSame('Stock Inventory', $credit->name);
            $this->assertSame('Stock Inventory', $debit->name);
        }

        DB::table('business_locations')->where('id', 1)->update([
            'accounting_default_map' => json_encode([
                'manufacturing_production' => ['payment_account' => 2, 'deposit_to' => 1],
                'manufacturing_reverse_production' => ['payment_account' => 3, 'deposit_to' => 2],
            ]),
        ]);

        [$credit, $debit] = $util->getProductionDefaultAccounts($production, 1);
        $this->assertSame(2, $credit->id);
        $this->assertSame(1, $debit->id);

        [$credit, $debit] = $util->getProductionDefaultAccounts($reverse, 1);
        $this->assertSame(3, $credit->id);
        $this->assertSame(2, $debit->id);
    }
}
