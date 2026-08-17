<?php

namespace Tests\Unit\Zatca;

use Modules\ZATCA\Services\ZatcaInvoiceValidatorService;
use Tests\TestCase;
use Tests\Support\BuildsZatcaInvoices;

class ZatcaInvoiceValidatorServiceTest extends TestCase
{
    use BuildsZatcaInvoices;

    protected ZatcaInvoiceValidatorService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new ZatcaInvoiceValidatorService();
    }

    public function testValidB2bInvoicePassesLocalValidation(): void
    {
        $invoice = $this->makeZatcaInvoice();

        $result = $this->service->validate($invoice);

        $this->assertTrue($result['valid']);
        $this->assertSame([], $result['errors']);
        $this->assertSame([], $result['warnings']);
    }

    public function testCreditNoteRequiresOriginalInvoiceReferenceAndReason(): void
    {
        $invoice = $this->makeZatcaInvoice([
            'invoice_type_code' => '381',
            'original_invoice_number' => '',
            'note_reason' => '',
        ]);

        $result = $this->service->validate($invoice);

        $this->assertFalse($result['valid']);
        $this->assertContains('Credit and debit notes must reference the original invoice number.', $result['errors']);
        $this->assertContains('Credit and debit notes must include an issuance reason.', $result['errors']);
    }

    public function testDocumentDiscountCannotExceedLineTotals(): void
    {
        $invoice = $this->makeZatcaInvoice([
            'document_discount_amount' => 150.00,
            'total_excluding_vat' => 0.00,
            'total_vat' => 15.00,
            'total_including_vat' => 15.00,
            'payable_amount' => 15.00,
        ]);

        $result = $this->service->validate($invoice);

        $this->assertFalse($result['valid']);
        $this->assertContains('Document discount cannot exceed the sum of invoice lines.', $result['errors']);
    }
}
