<?php

namespace Tests\Unit;

use App\Utils\TransactionUtil;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

class TransactionUtilDraftReceiptTotalTest extends TestCase
{
    public function testDraftReceiptTotalFallsBackToCalculatedAfterDiscountAmount(): void
    {
        $util = (new ReflectionClass(TransactionUtil::class))->newInstanceWithoutConstructor();
        $method = new ReflectionMethod(TransactionUtil::class, 'getDraftReceiptDisplayTotal');
        $method->setAccessible(true);

        $transaction = (object) [
            'final_total' => 0,
            'status' => 'draft',
            'total_before_tax' => 0,
            'discount_type' => 'fixed',
            'discount_amount' => 58.50,
            'discount2_type' => null,
            'discount2_amount' => 0,
            'tax_amount' => 0,
            'shipping_charges' => 0,
            'packing_charge' => 0,
            'packing_charge_type' => null,
            'rp_redeemed_amount' => 0,
            'round_off_amount' => 0,
        ];

        $this->assertEqualsWithDelta(
            1111.50,
            $method->invoke($util, $transaction, 1170.00, 1),
            0.00001
        );
    }

    public function testDraftReceiptTotalKeepsStoredFinalTotalWhenPresent(): void
    {
        $util = (new ReflectionClass(TransactionUtil::class))->newInstanceWithoutConstructor();
        $method = new ReflectionMethod(TransactionUtil::class, 'getDraftReceiptDisplayTotal');
        $method->setAccessible(true);

        $transaction = (object) [
            'final_total' => 250,
            'status' => 'draft',
            'total_before_tax' => 1000,
        ];

        $this->assertSame(250.0, $method->invoke($util, $transaction, 1170.00, 1));
    }
}
