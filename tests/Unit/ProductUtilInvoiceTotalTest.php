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
}
