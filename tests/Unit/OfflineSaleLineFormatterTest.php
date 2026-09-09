<?php

namespace Tests\Unit;

use App\Product;
use App\Services\OfflineSaleLineFormatter;
use App\TransactionSellLine;
use App\Utils\TransactionUtil;
use PHPUnit\Framework\TestCase;

class OfflineSaleLineFormatterTest extends TestCase
{
    private function format(array $attributes, array $units = null): array
    {
        $stored = new TransactionSellLine();
        $stored->setRawAttributes(array_merge([
            'quantity' => 20, 'foc_quantity' => 0, 'quantity_returned' => 0,
            'sub_unit_id' => 14, 'foc_sub_unit_id' => null,
            'unit_price_before_discount' => 48, 'unit_price' => 48,
            'unit_price_inc_tax' => 48, 'item_tax' => 0,
            'line_discount_type' => 'percentage', 'line_discount_amount' => 0,
        ], $attributes));
        $product = new Product();
        $product->setRawAttributes(['unit_id' => 2]);
        $product->setAppends([]);
        $stored->setRelation('product', $product);
        $util = $this->createMock(TransactionUtil::class);
        $util->method('getSubUnits')->with(2, 2)->willReturn($units ?? [
            2 => ['multiplier' => 1], 14 => ['multiplier' => 10], 15 => ['multiplier' => 5],
        ]);
        $before = $stored->getAttributes();
        $result = (new OfflineSaleLineFormatter())->format(2, $stored, $util);
        $this->assertSame($before, $stored->getAttributes());

        return json_decode($result->toJson(), true);
    }

    public function test_two_packs_are_sent_as_two_not_twenty(): void
    {
        $line = $this->format([]);
        $this->assertEquals(2, $line['quantity']);
        $this->assertEquals(480, $line['unit_price']);
        $this->assertEquals(14, $line['sub_unit_id']);
    }

    public function test_nine_singles_stay_nine(): void
    {
        foreach ([null, 2] as $unit) {
            $line = $this->format(['quantity' => 9, 'sub_unit_id' => $unit]);
            $this->assertEquals(9, $line['quantity']);
            $this->assertEquals(48, $line['unit_price']);
        }
    }

    public function test_free_items_are_removed_from_paid_quantity_without_a_paid_sub_unit(): void
    {
        $line = $this->format(['quantity' => 19, 'sub_unit_id' => null, 'foc_quantity' => 10, 'foc_sub_unit_id' => 14]);
        $this->assertEquals(9, $line['quantity']);
        $this->assertEquals(1, $line['foc_quantity']);
    }

    public function test_free_items_in_base_units_are_not_counted_twice(): void
    {
        $line = $this->format(['quantity' => 12, 'sub_unit_id' => null, 'foc_quantity' => 3]);
        $this->assertEquals(9, $line['quantity']);
        $this->assertEquals(3, $line['foc_quantity']);
    }

    public function test_paid_and_free_units_have_independent_multipliers(): void
    {
        $line = $this->format(['quantity' => 25, 'foc_quantity' => 5, 'foc_sub_unit_id' => 15, 'quantity_returned' => 10]);
        $this->assertEquals(2, $line['quantity']);
        $this->assertEquals(1, $line['foc_quantity']);
        $this->assertEquals(1, $line['quantity_returned']);
    }

    public function test_fixed_discounts_and_tax_are_converted_but_percentages_are_preserved(): void
    {
        $line = $this->format(['line_discount_type' => 'fixed', 'line_discount_amount' => 2,
            'line_discount2_type' => 'percentage', 'line_discount2_amount' => 5, 'item_tax' => 3]);
        $this->assertEquals(20, $line['line_discount_amount']);
        $this->assertEquals(5, $line['line_discount2_amount']);
        $this->assertEquals(30, $line['item_tax']);
        $line = $this->format(['line_discount2_type' => 'fixed', 'line_discount2_amount' => 3]);
        $this->assertEquals(30, $line['line_discount2_amount']);
    }

    public function test_unknown_or_invalid_units_fail_instead_of_sending_base_quantity_as_packs(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->format([], [2 => ['multiplier' => 1]]);
    }

    public function test_zero_multiplier_is_rejected(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->format([], [14 => ['multiplier' => 0]]);
    }
}
