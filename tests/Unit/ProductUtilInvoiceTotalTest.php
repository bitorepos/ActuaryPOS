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

    public function testStockHistoryProfitExcludesSchemeRevenueButKeepsItsCost(): void
    {
        $util = new ProductUtil();
        $method = new \ReflectionMethod(ProductUtil::class, 'calculateSellHistoryAmounts');
        $method->setAccessible(true);

        $scheme_only = $method->invoke($util, 1, 1, 2000, 0, 500);
        $this->assertSame(0.0, $scheme_only['sell_total']);
        $this->assertSame(500.0, $scheme_only['cost_total']);
        $this->assertTrue($scheme_only['is_scheme_quantity']);
        $this->assertSame(-500.0, $scheme_only['sell_total'] - $scheme_only['cost_total']);

        $paid_and_scheme = $method->invoke($util, 3, 1, 100, 10, 60);
        $this->assertSame(200.0, $paid_and_scheme['sell_total']);
        $this->assertSame(180.0, $paid_and_scheme['cost_total']);
        $this->assertSame(20.0, $paid_and_scheme['tax_total']);
        $this->assertTrue($paid_and_scheme['is_scheme_quantity']);
        $this->assertSame(20.0, $paid_and_scheme['sell_total'] - $paid_and_scheme['cost_total']);

        $paid_only = $method->invoke($util, 1, 0, 100, 10, 60);
        $this->assertFalse($paid_only['is_scheme_quantity']);
    }
}
