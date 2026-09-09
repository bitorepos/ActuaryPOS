<?php

namespace Tests\Unit;

use App\Services\OfflineSaleQuantityAudit;
use PHPUnit\Framework\TestCase;

class OfflineSaleQuantityAuditTest extends TestCase
{
    private function sale(): array
    {
        return ['header' => ['final_total' => 960, 'location_id' => 2], 'payments' => [], 'has_returns' => false,
            'lines' => [[
                'identity' => ['product_id' => 1606, 'variation_id' => 1606, 'multiplier' => 10,
                    'foc_multiplier' => 1, 'sub_unit_id' => 14, 'children_type' => '', 'product_type' => 'single',
                    'quantity_returned' => 0, 'line_discount_type' => 'percentage', 'line_discount2_type' => null],
                'quantity' => 20, 'foc_quantity' => 0, 'unit_price' => 48, 'unit_price_before_discount' => 48,
                'unit_price_inc_tax' => 48, 'item_tax' => 0, 'line_discount_amount' => 0, 'line_discount2_amount' => 0,
            ]]];
    }

    private function corrupted(array $sale): array
    {
        foreach ($sale['lines'] as &$line) {
            $m = $line['identity']['multiplier'];
            $line['quantity'] *= $m;
            foreach (['unit_price', 'unit_price_before_discount', 'unit_price_inc_tax', 'item_tax'] as $field) {
                $line[$field] /= $m;
            }
        }
        return $sale;
    }

    public function test_multiple_products_with_different_pack_sizes_are_identified(): void
    {
        $local = $this->sale();
        $second = $local['lines'][0];
        $second['identity']['product_id'] = 2500;
        $second['identity']['variation_id'] = 3000;
        $second['identity']['multiplier'] = 12;
        $second['quantity'] = 24;
        $local['lines'][] = $second;
        $result = (new OfflineSaleQuantityAudit())->compare($local, $this->corrupted($local));
        $this->assertSame('confirmed_double_conversion', $result['status']);
        $this->assertCount(2, $result['changes']);
        $this->assertEquals(180, $result['changes'][0]['stock_to_restore']);
        $this->assertEquals(264, $result['changes'][1]['stock_to_restore']);
    }

    public function test_matching_invoices_are_not_queued(): void
    {
        $local = $this->sale();
        $this->assertSame('matches', (new OfflineSaleQuantityAudit())->compare($local, $local)['status']);
    }

    public function test_quantity_only_mismatch_requires_review(): void
    {
        $local = $this->sale();
        $cloud = $local;
        $cloud['lines'][0]['quantity'] = 200;
        $this->assertSame('review', (new OfflineSaleQuantityAudit())->compare($local, $cloud)['status']);
    }

    public function test_returns_repeated_variations_and_cloud_edits_block_requeue(): void
    {
        $local = $this->sale();
        $cloud = $this->corrupted($local);
        foreach (['return', 'duplicate', 'payment', 'header', 'unit', 'missing'] as $case) {
            $modified = $cloud;
            if ($case === 'return') $modified['has_returns'] = true;
            if ($case === 'duplicate') $modified['lines'][] = $modified['lines'][0];
            if ($case === 'payment') $modified['payments'][] = ['amount' => 123];
            if ($case === 'header') $modified['header']['final_total'] = 1000;
            if ($case === 'unit') $modified['lines'][0]['identity']['multiplier'] = 12;
            if ($case === 'missing') $modified['lines'] = [];
            $this->assertSame('review', (new OfflineSaleQuantityAudit())->compare($local, $modified)['status'], $case);
        }
    }

    public function test_free_quantity_mismatch_is_not_automatically_repaired(): void
    {
        $local = $this->sale();
        $local['lines'][0]['foc_quantity'] = 2;
        $cloud = $this->corrupted($local);
        $this->assertSame('review', (new OfflineSaleQuantityAudit())->compare($local, $cloud)['status']);
    }

    public function test_healthy_lines_can_share_an_invoice_with_corrupted_lines(): void
    {
        $local = $this->sale();
        $cloud = $this->corrupted($local);
        $healthy = $local['lines'][0];
        $healthy['identity']['variation_id'] = 999;
        $local['lines'][] = $healthy;
        array_unshift($cloud['lines'], $healthy);
        $result = (new OfflineSaleQuantityAudit())->compare($local, $cloud);
        $this->assertSame('confirmed_double_conversion', $result['status']);
        $this->assertCount(1, $result['changes']);
    }
}
