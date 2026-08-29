<?php

namespace Tests\Unit;

use App\Utils\ProductUtil;
use Tests\TestCase;

class ProductUtilInvoiceTotalTest extends TestCase
{
    public function testInvoiceTotalRoundsEachLineToBusinessCurrencyPrecision(): void
    {
        session(['business.currency_precision' => 2]);

        $total = (new ProductUtil())->calculateInvoiceTotal([
            ['quantity' => 1, 'unit_price_inc_tax' => '10.005'],
            ['quantity' => 1, 'unit_price_inc_tax' => '10.005'],
            ['quantity' => 1, 'unit_price_inc_tax' => '10.005'],
        ], null);

        $this->assertEqualsWithDelta(30.03, $total['total_before_tax'], 0.00001);
        $this->assertEqualsWithDelta(30.03, $total['final_total'], 0.00001);
    }

    public function testInvoiceTotalAppliesSecondInvoiceDiscountBeforeTax(): void
    {
        session(['business.currency_precision' => 2]);

        $total = (new ProductUtil())->calculateInvoiceTotal(
            [
                ['quantity' => 2, 'unit_price_inc_tax' => '100'],
            ],
            null,
            ['discount_type' => 'percentage', 'discount_amount' => 10],
            true,
            ['discount_type' => 'fixed', 'discount_amount' => 15]
        );

        $this->assertEqualsWithDelta(200, $total['total_before_tax'], 0.00001);
        $this->assertEqualsWithDelta(20, $total['discount'], 0.00001);
        $this->assertEqualsWithDelta(15, $total['discount2'], 0.00001);
        $this->assertEqualsWithDelta(165, $total['final_total'], 0.00001);
    }
}
