<?php

namespace Tests\Unit;

use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Tests\TestCase;

class ContactPrintPdfFontTest extends TestCase
{
    public function testFontOffsetIsValidatedAndBounded(): void
    {
        $controller = (new \ReflectionClass(ContactController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod($controller, 'getContactPrintFilters');
        $method->setAccessible(true);
        foreach (['2' => 2, '-3' => -3, '999' => 12, '-999' => -6, 'bad' => 0] as $value => $expected) {
            $filters = $method->invoke($controller, new Request(['font_offset' => $value]));
            $this->assertSame($expected, $filters['font_offset']);
        }
    }

    public function testPdfRendererUsesTheSelectedFontSize(): void
    {
        foreach ([0 => 5.8, 2 => 7.3, -2 => 4.3] as $offset => $size) {
            $html = view('contact.contact_print_pdf', [
                'filters' => ['font_offset' => $offset], 'orientation' => 'portrait',
                'tab' => 'ledger', 'report_title' => 'Ledger', 'business_name' => 'Test',
                'location_name' => '', 'generated_at' => '2026-09-09', 'use_mpdf_footer' => true,
                'raw_html_pages' => ['<table id="ledger_table"><thead><tr><th>Invoice</th></tr></thead><tbody><tr><td>FONT_SAMPLE</td></tr></tbody></table>'],
            ])->render();
            $pdf = new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir(), 'format' => 'A4']);
            $pdf->SetCompression(false);
            $pdf->WriteHTML($html);
            $bytes = $pdf->Output('', 'S');
            $this->assertMatchesRegularExpression('/\/F\d+ '.preg_quote(sprintf('%.3f', $size), '/').' Tf/', $bytes);
        }
    }

    public function testContactIndexPrintHeadersKeepTheirIntentionalLineBreaks(): void
    {
        $controller = (new \ReflectionClass(ContactController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod($controller, 'getContactIndexPrintHeaderLines');
        $method->setAccessible(true);

        $this->assertSame(
            ['Total Purchase', 'Return Due'],
            $method->invoke($controller, 'return_due', 'Total Purchase Return Due')
        );
        $this->assertSame(
            ['Current Stock', 'Value'],
            $method->invoke($controller, 'total_stock_value', 'Current Stock Value')
        );
        $this->assertSame(
            ['Email'],
            $method->invoke($controller, 'email', 'Email')
        );

        $html = view('contact.contact_print_pdf', [
            'filters' => ['font_offset' => 0],
            'orientation' => 'landscape',
            'tab' => 'contact_index',
            'report_title' => 'Suppliers',
            'business_name' => 'Test',
            'location_name' => '',
            'generated_at' => '2026-09-23',
            'use_mpdf_footer' => true,
            'row_pages' => [[]],
            'rows' => [],
            'columns' => [[
                'key' => 'return_due',
                'label' => 'Total Purchase Return Due',
                'header_lines' => ['Total Purchase', 'Return Due <unsafe>'],
                'type' => 'money',
            ]],
            'currency_symbol' => 'GBP',
        ])->render();

        $this->assertMatchesRegularExpression('/Total Purchase\s*<br>\s*Return Due &lt;unsafe&gt;/', $html);
        $this->assertStringNotContainsString('Return Due <unsafe>', $html);
    }

    public function testWideLandscapeContactIndexUsesTheAvailablePageHeight(): void
    {
        $controller = (new \ReflectionClass(ContactController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod($controller, 'getContactIndexPrintRowsPerPage');
        $method->setAccessible(true);

        $this->assertSame(43, $method->invoke($controller, 'landscape', 19, false));
        $this->assertSame(43, $method->invoke($controller, 'landscape', 19, true));
    }
}
