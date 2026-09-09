<?php

namespace Tests\Unit;

use App\Http\Controllers\PurchaseOrderController;
use PDO;
use PHPUnit\Framework\TestCase;

class PurchaseOrderIndexTotalTest extends TestCase
{
    public function testMissingTotalsUseActiveLinesAndPreserveValidTotals(): void
    {
        $db = new PDO('sqlite::memory:');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec('CREATE TABLE transactions (id INTEGER, final_total REAL DEFAULT 0,
            total_before_tax REAL DEFAULT 0, discount_type TEXT, discount_amount REAL DEFAULT 0,
            discount2_type TEXT, discount2_amount REAL DEFAULT 0, tax_amount REAL DEFAULT 0,
            shipping_charges REAL DEFAULT 0, additional_expense_value_1 REAL DEFAULT 0,
            additional_expense_value_2 REAL DEFAULT 0, additional_expense_value_3 REAL DEFAULT 0,
            additional_expense_value_4 REAL DEFAULT 0)');
        $db->exec('CREATE TABLE purchase_lines (transaction_id INTEGER, quantity REAL,
            purchase_price_inc_tax REAL, deleted_at TEXT)');
        $db->exec("INSERT INTO transactions (id) VALUES (1), (2), (3), (4), (5)");
        $db->exec("UPDATE transactions SET discount_type = 'percentage', discount_amount = 10,
            discount2_type = 'fixed', discount2_amount = 5, tax_amount = 8,
            shipping_charges = 3, additional_expense_value_4 = 2 WHERE id = 2");
        $db->exec('UPDATE transactions SET final_total = 77 WHERE id = 3');
        $db->exec('UPDATE transactions SET total_before_tax = 100 WHERE id = 4');
        $db->exec("INSERT INTO purchase_lines VALUES (1, 2, 50, NULL), (1, 1, 25, NULL),
            (1, 10, 100, '2026-09-01'), (2, 2, 50, NULL), (3, 2, 50, NULL), (4, 2, 50, NULL)");

        $controller = (new \ReflectionClass(PurchaseOrderController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod($controller, 'purchaseOrderIndexTotalSql');
        $method->setAccessible(true);
        $sql = $method->invoke($controller);
        $rows = $db->query("SELECT transactions.id, {$sql} AS final_total FROM transactions
            LEFT JOIN purchase_lines AS pl ON pl.transaction_id = transactions.id AND pl.deleted_at IS NULL
            GROUP BY transactions.id ORDER BY final_total DESC")->fetchAll(PDO::FETCH_KEY_PAIR);

        $this->assertEquals([1 => 125, 2 => 98, 3 => 77, 4 => 0, 5 => 0], $rows);
        $this->assertSame([1, 2, 3], array_slice(array_keys($rows), 0, 3));
    }
}
