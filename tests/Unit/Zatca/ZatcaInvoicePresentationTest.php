<?php

namespace Tests\Unit\Zatca;

use Tests\TestCase;
use Tests\Support\BuildsZatcaInvoices;

class ZatcaInvoicePresentationTest extends TestCase
{
    use BuildsZatcaInvoices;

    public function testReportedInvoiceUsesReportedCompliancePresentation(): void
    {
        $invoice = $this->makeZatcaInvoice([
            'sync_status' => 'reported',
            'validation_status' => 'passed',
            'zatca_reporting_status' => 'REPORTED',
        ]);

        $presentation = $invoice->getCompliancePresentation();

        $this->assertSame('success', $presentation['tone']);
        $this->assertSame('Reported to ZATCA', $presentation['status_en']);
        $this->assertStringContainsString('reported to ZATCA successfully', $presentation['headline_en']);
    }

    public function testLocalValidationFailureUsesDangerPresentation(): void
    {
        $invoice = $this->makeZatcaInvoice([
            'validation_status' => 'failed',
            'failure_category' => 'local_validation',
            'zatca_status' => 'LOCAL_VALIDATION_FAILED',
            'sync_status' => 'failed',
        ]);

        $presentation = $invoice->getCompliancePresentation();

        $this->assertSame('danger', $presentation['tone']);
        $this->assertSame('Local validation failed', $presentation['status_en']);
        $this->assertStringContainsString('failed local ZATCA validation', $presentation['headline_en']);
    }

    public function testDocumentTitlesSwitchForCreditAndDebitNotes(): void
    {
        $creditNote = $this->makeZatcaInvoice(['invoice_type_code' => '381']);
        $debitNote = $this->makeZatcaInvoice(['invoice_type_code' => '383']);

        $this->assertTrue($creditNote->isCreditNote());
        $this->assertSame('Credit Note', $creditNote->getDocumentTitleEnglish());
        $this->assertSame('إشعار دائن', $creditNote->getDocumentTitleArabic());

        $this->assertTrue($debitNote->isDebitNote());
        $this->assertSame('Debit Note', $debitNote->getDocumentTitleEnglish());
        $this->assertSame('إشعار مدين', $debitNote->getDocumentTitleArabic());
    }
}
