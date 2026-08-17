<?php

namespace Tests\Unit\Zatca;

use Modules\ZATCA\Services\ZatcaPdfService;
use Tests\TestCase;
use Tests\Support\BuildsZatcaInvoices;

class ZatcaPdfServiceTest extends TestCase
{
    use BuildsZatcaInvoices;

    public function testReportedInvoicePdfUsesStatusAwareMessaging(): void
    {
        $invoice = $this->makeZatcaInvoice([
            'sync_status' => 'reported',
            'validation_status' => 'passed',
            'zatca_reporting_status' => 'REPORTED',
        ]);

        $html = (new ZatcaPdfService())->generatePdfHtml($invoice);

        $this->assertStringContainsString('This invoice was reported to ZATCA successfully.', $html);
        $this->assertStringContainsString('Tax Invoice / فاتورة ضريبية', $html);
        $this->assertStringContainsString('Status on this printout reflects the latest invoice record stored in this system at the time of download.', $html);
        $this->assertStringNotContainsString('generated in compliance with ZATCA e-invoicing regulations', $html);
    }

    public function testPdfUsesQrPlaceholderWhenImageRenderingIsUnavailable(): void
    {
        $invoice = $this->makeZatcaInvoice([
            'sync_status' => 'reported',
            'validation_status' => 'passed',
            'qr_code' => 'QR-PAYLOAD',
        ]);

        $service = new class extends ZatcaPdfService {
            protected function generateQrCodeImage(string $data): string
            {
                return '';
            }
        };

        $html = $service->generatePdfHtml($invoice);

        $this->assertStringContainsString('QR available in system record', $html);
        $this->assertStringContainsString('PDF server could not render the QR image', $html);
    }

    public function testDebitNotePdfUsesDebitTitleAndOriginalInvoiceContext(): void
    {
        $invoice = $this->makeZatcaInvoice([
            'invoice_type_code' => '383',
            'original_invoice_number' => 'INV-ORIG-900',
            'original_invoice_uuid' => 'orig-uuid-900',
            'note_reason' => 'Price correction',
        ]);

        $html = (new ZatcaPdfService())->generatePdfHtml($invoice);

        $this->assertStringContainsString('Debit Note / إشعار مدين', $html);
        $this->assertStringContainsString('Original Invoice / الفاتورة الأصلية', $html);
        $this->assertStringContainsString('Price correction', $html);
    }
}
