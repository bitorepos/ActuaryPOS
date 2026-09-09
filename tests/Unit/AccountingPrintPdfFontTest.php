<?php

namespace Tests\Unit;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

class AccountingPrintPdfFontTest extends TestCase
{
    public function testReceivablePdfFillsPagesInsteadOfBreakingAtPreviewRowGroups(): void
    {
        $this->app->instance('request', Request::create('/print', 'GET', ['font_offset' => 4]));
        $rows = [];
        for ($i = 1; $i <= 90; $i++) {
            $rows[] = ['customer_name' => sprintf('Customer %03d', $i), 'current' => $i * 10];
        }
        $source = file_get_contents(base_path('Modules/Accounting/Resources/views/report/account_receivable_ageing_print.blade.php'));
        $html = Blade::render($source, [
            'is_pdf' => true, 'print_url' => '/print', 'report_title' => 'Ageing',
            'business_name' => 'Test business', 'location_name' => 'All locations',
            'generated_at' => '2026-09-09', 'currency_symbol' => '$',
            'sections' => [['title' => 'Summary', 'pages' => array_chunk($rows, 24), 'rows' => $rows,
                'columns' => [['key' => 'customer_name', 'label' => 'Customer name'],
                    ['key' => 'current', 'label' => 'Current', 'type' => 'money', 'total' => true]],
                'totals' => ['current' => 40950]]],
        ]);
        $pdf = new Dompdf();
        $lastRowBottoms = [];
        $customers = [];
        $cellBounds = [];
        $pdf->setCallbacks([['event' => 'end_frame', 'f' => function ($frame) use ($pdf, &$lastRowBottoms, &$customers, &$cellBounds) {
            $node = $frame->get_node();
            if ($node->nodeName === 'td' || $node->nodeName === 'th') {
                $position = $frame->get_position();
                $cellBounds[] = [$position['x'], $position['y'], $position['x'] + $frame->get_margin_width(), $position['y'] + $frame->get_margin_height()];
            }
            if ($node->nodeName === 'td' && preg_match('/^Customer \d{3}$/', trim($node->textContent))) {
                $customers[] = trim($node->textContent);
                $lastRowBottoms[$pdf->getCanvas()->get_page_number()] = $frame->get_position()['y'] + $frame->get_margin_height();
            }
        }]]);
        $pdf->loadHtml($html);
        $pdf->setPaper('a4', 'landscape');
        $pdf->render();
        $this->assertSame(array_column($rows, 'customer_name'), $customers);
        foreach ($cellBounds as [$left, $top, $right, $bottom]) {
            $this->assertGreaterThanOrEqual(28, $left, 'Left page margin must be at least 10mm.');
            $this->assertGreaterThanOrEqual(28, $top, 'Top page margin must be at least 10mm.');
            $this->assertLessThanOrEqual(814, $right, 'Right page margin must be at least 10mm.');
            $this->assertLessThanOrEqual(556, $bottom, 'Bottom page margin must reserve footer space.');
        }
        $this->assertGreaterThan(1, count($lastRowBottoms));
        array_pop($lastRowBottoms); // The final page can legitimately be shorter.
        foreach ($lastRowBottoms as $bottom) {
            $this->assertGreaterThan(500, $bottom, 'Intermediate pages should be filled with rows.');
        }
    }

    public function testAgeingSummaryBoxesStayOnOneRowInPdf(): void
    {
        foreach (['account_receivable_ageing_print', 'account_payable_ageing_print'] as $name) {
            $source = file_get_contents(base_path('Modules/Accounting/Resources/views/report/'.$name.'.blade.php'));
            $html = Blade::render($source, [
                'is_pdf' => true, 'print_url' => '/print', 'report_title' => 'Ageing',
                'business_name' => 'Test business', 'location_name' => 'All locations',
                'generated_at' => '2026-09-09', 'currency_symbol' => '$',
                'sections' => [['title' => 'Summary', 'pages' => [[]], 'rows' => [],
                    'columns' => [['key' => 'name', 'label' => 'Customer']], 'totals' => []]],
            ]);
            $positions = [];
            $pdf = new Dompdf();
            $pdf->setCallbacks([['event' => 'end_frame', 'f' => function ($frame) use (&$positions) {
                if ($frame->get_node()->nodeName === 'strong') {
                    $positions[] = $frame->get_position();
                }
            }]]);
            $pdf->loadHtml($html);
            $pdf->setPaper('a4', 'landscape');
            $pdf->render();
            $this->assertCount(7, $positions, $name);
            foreach ($positions as $index => $position) {
                $this->assertEqualsWithDelta($positions[0]['y'], $position['y'], 0.1, $name);
                if ($index > 0) {
                    $this->assertGreaterThan($positions[$index - 1]['x'], $position['x'], $name);
                }
            }
            $this->assertSame(1, $pdf->getCanvas()->get_page_count());
        }
    }

    public function testEveryAccountingPrintTemplateExportsAdjustedTableFonts(): void
    {
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(base_path('Modules/Accounting/Resources/views')));
        $checked = 0;
        foreach ($files as $file) {
            if (! $file->isFile() || ! str_ends_with($file->getFilename(), '.blade.php')) {
                continue;
            }
            $source = file_get_contents($file->getPathname());
            if (! str_contains($source, "@include('report.partials.crystal_report_scripts')")) {
                continue;
            }
            // Use the real template's styles and a small table to inspect PDF text sizes.
            preg_match('/\.(\S+) table\s*\{[^}]*?\$is_pdf \? \(([\d.]+) \+/s', $source, $table);
            $this->assertNotEmpty($table, $file->getPathname());
            $class = $table[1];
            $base = (float) $table[2];
            preg_match('/\.'.preg_quote($class, '/').' th\s*\{[^}]*?\$is_pdf \? \(([\d.]+) \+/s', $source, $header);
            $this->assertNotEmpty($header, $file->getPathname());
            $head = strstr($source, '</head>', true).'</head>';

            foreach ([0, 4, -2] as $offset) {
                $this->app->instance('request', Request::create('/print', 'GET', ['font_offset' => $offset]));
                $html = Blade::render($head, [
                    'is_pdf' => true, 'sections' => [], 'report_title' => 'Font test',
                    'print_url' => '/print',
                ]);
                $html .= '<body><div class="'.$class.'"><table><thead><tr><th>Header</th></tr></thead>'
                    .'<tbody><tr><td>Body</td></tr></tbody><tfoot><tr><td>Total</td></tr></tfoot></table></div></body></html>';
                $pdf = new Dompdf();
                $pdf->loadHtml($html);
                $pdf->setPaper('a4', 'landscape');
                $pdf->render();
                $bytes = $pdf->output(['compress' => 0]);
                preg_match_all('/\/F\d+ ([\d.]+) Tf/', $bytes, $fontCommands);
                $exportedSizes = array_map('floatval', $fontCommands[1]);
                foreach ([$base, (float) $header[1]] as $font) {
                    $size = round($font + $offset * 0.75, 3);
                    $this->assertContains($size, $exportedSizes,
                        $file->getPathname().' offset '.$offset);
                }
            }
            $checked++;
        }
        $this->assertSame(14, $checked);
    }
}
