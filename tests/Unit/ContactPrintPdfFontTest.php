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
}
