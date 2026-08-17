<?php

namespace Tests\Unit;

use App\Http\Controllers\SellController;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class SellControllerDisplayTotalTest extends TestCase
{
    public function testFinalSaleZeroSavedTotalDisplaysCalculatedReceivableAndDueStatus(): void
    {
        $controller = (new ReflectionClass(SellController::class))->newInstanceWithoutConstructor();

        $transaction = (object) [
            'type' => 'sell',
            'status' => 'final',
            'payment_status' => 'paid',
            'transaction_date' => '2026-08-11 18:26:10',
            'pay_term_number' => null,
            'pay_term_type' => null,
            'final_total' => 0,
            'total_before_tax' => 104485.20,
            'discount_type' => null,
            'discount_amount' => 0,
            'discount2_type' => null,
            'discount2_amount' => 0,
            'tax_amount' => 0,
            'shipping_charges' => 0,
            'packing_charge' => 0,
            'packing_charge_type' => null,
            'rp_redeemed_amount' => 0,
            'round_off_amount' => 0,
            'payment_lines' => [],
        ];

        $total_method = new \ReflectionMethod(SellController::class, 'getSaleDisplayFinalTotal');
        $total_method->setAccessible(true);
        $display_total = $total_method->invoke($controller, $transaction);

        $status_method = new \ReflectionMethod(SellController::class, 'getDisplayPaymentStatus');
        $status_method->setAccessible(true);
        $display_status = $status_method->invoke($controller, $transaction, $display_total, 0.0);

        $this->assertSame(104485.20, $display_total);
        $this->assertSame('due', $display_status);
    }
}
