<?php

namespace Tests\Unit;

use Modules\Essentials\Utils\PakistanSalaryTax;
use PHPUnit\Framework\TestCase;

class PakistanSalaryTaxTest extends TestCase
{
    /** @dataProvider taxYear2027Examples */
    public function test_tax_year_2027_slabs(float $income, float $expected): void
    {
        $tax = new PakistanSalaryTax();

        $this->assertEquals($expected, $tax->annualTax($income, 2027));
    }

    public function taxYear2027Examples(): array
    {
        return [
            'exempt ceiling' => [600000, 0],
            'one percent slab' => [1000000, 4000],
            'eleven percent slab' => [1800000, 72000],
            'twenty percent slab' => [2700000, 216000],
            'twenty five percent slab' => [3500000, 391000],
            'twenty nine percent slab' => [5000000, 802000],
            'thirty two percent slab' => [6000000, 1104000],
            'top slab' => [10000000, 2474000],
        ];
    }

    public function test_tax_year_follows_july_to_june_cycle(): void
    {
        $tax = new PakistanSalaryTax();

        $this->assertSame(2026, $tax->taxYear('2026-06-01'));
        $this->assertSame(2027, $tax->taxYear('2026-07-01'));
    }

    public function test_monthly_calculation_includes_annual_adjustment(): void
    {
        $result = (new PakistanSalaryTax())->calculate(100000, '2026-07-01', 600000);

        $this->assertSame(2027, $result['tax_year']);
        $this->assertEquals(1800000, $result['annual_taxable_salary']);
        $this->assertEquals(6000, $result['monthly_tax']);
    }

    public function test_tax_year_2026_surcharge_above_ten_million(): void
    {
        $tax = new PakistanSalaryTax();

        $this->assertEqualsWithDelta(3303790, $tax->annualTax(11000000, 2026), 0.0001);
    }
}
