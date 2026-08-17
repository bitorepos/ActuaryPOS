<?php

namespace Tests\Unit\Zatca;

use Illuminate\Support\Carbon;
use Modules\ZATCA\Services\ZatcaXmlBuilderService;
use Tests\TestCase;
use Tests\Support\BuildsZatcaInvoices;

class ZatcaXmlBuilderServiceTest extends TestCase
{
    use BuildsZatcaInvoices;

    protected ZatcaXmlBuilderService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new ZatcaXmlBuilderService();
    }

    public function testGenerateXmlIncludesCreditNoteReferencesAllowanceAndInstructionNote(): void
    {
        $invoice = $this->makeZatcaInvoice([
            'invoice_type_code' => '381',
            'original_invoice_number' => 'INV-ORIG-001',
            'original_invoice_uuid' => 'orig-uuid-123',
            'original_invoice_date' => Carbon::parse('2026-03-01'),
            'note_reason' => 'Return against original invoice',
            'document_discount_amount' => 10.00,
            'document_discount_reason' => 'Return discount',
            'total_excluding_vat' => 90.00,
            'total_vat' => 15.00,
            'total_including_vat' => 105.00,
            'payable_amount' => 105.00,
        ]);

        $xml = $this->service->generateXml($invoice);

        $this->assertStringContainsString('<cac:BillingReference>', $xml);
        $this->assertStringContainsString('<cbc:ID>INV-ORIG-001</cbc:ID>', $xml);
        $this->assertStringContainsString('<cbc:InstructionNote>Return against original invoice</cbc:InstructionNote>', $xml);
        $this->assertStringContainsString('<cbc:AllowanceChargeReason>Return discount</cbc:AllowanceChargeReason>', $xml);
        $this->assertStringContainsString('<cac:Delivery>', $xml);
        $this->assertStringContainsString('<cbc:CitySubdivisionName>Al Olaya</cbc:CitySubdivisionName>', $xml);
    }

    public function testGenerateQrCodeIncludesCryptographicTagsForSimplifiedInvoicesOnly(): void
    {
        $b2cInvoice = $this->makeZatcaInvoice(['invoice_sub_type' => 'B2C']);
        $b2bInvoice = $this->makeZatcaInvoice(['invoice_sub_type' => 'B2B']);
        $signatureData = [
            'invoice_hash' => 'HASH123',
            'signature_value' => 'SIG123',
            'public_key' => "\x30\x59\x30\x13",
            'certificate_signature' => "\xDE\xAD\xBE\xEF",
        ];

        $b2cTags = $this->parseBase64Tlv($this->service->generateQrCode($b2cInvoice, $signatureData));
        $b2bTags = $this->parseBase64Tlv($this->service->generateQrCode($b2bInvoice, $signatureData));

        $this->assertSame('Test Seller', $b2cTags[1]);
        $this->assertSame('300000000000003', $b2cTags[2]);
        $this->assertSame('HASH123', $b2cTags[6]);
        $this->assertSame('SIG123', $b2cTags[7]);
        $this->assertArrayHasKey(8, $b2cTags);
        $this->assertArrayHasKey(9, $b2cTags);

        $this->assertArrayNotHasKey(8, $b2bTags);
        $this->assertArrayNotHasKey(9, $b2bTags);
    }

    public function testInjectQrCodeIntoXmlReplacesExistingQrReference(): void
    {
        $invoice = $this->makeZatcaInvoice([
            'invoice_sub_type' => 'B2C',
            'qr_code' => 'OLD-QR',
        ]);

        $xml = $this->service->generateXml($invoice);
        $updatedXml = $this->service->injectQrCodeIntoXml($xml, 'NEW-QR');
        $document = new \DOMDocument();
        $document->loadXML($updatedXml);
        $xpath = new \DOMXPath($document);
        $xpath->registerNamespace('cac', 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
        $xpath->registerNamespace('cbc', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
        $qrNodes = $xpath->query("//cac:AdditionalDocumentReference[cbc:ID='QR']");
        $qrValue = $xpath->query("//cac:AdditionalDocumentReference[cbc:ID='QR']/cac:Attachment/cbc:EmbeddedDocumentBinaryObject")
            ->item(0)?->nodeValue;

        $this->assertSame(1, $qrNodes->length);
        $this->assertSame('NEW-QR', $qrValue);
        $this->assertStringNotContainsString('OLD-QR', $updatedXml);
    }

    public function testGenerateXmlUsesInvoiceLevelIcvAndPihWhenPresent(): void
    {
        $invoice = $this->makeZatcaInvoice([
            'icv_value' => 7,
            'pih_value' => 'CHAINED-HASH-007',
        ], null, [
            'invoice_counter' => 99,
            'previous_invoice_hash' => 'ONBOARDING-HASH',
        ]);

        $xml = $this->service->generateXml($invoice);

        $this->assertStringContainsString('<cbc:ID>ICV</cbc:ID>', $xml);
        $this->assertStringContainsString('<cbc:UUID>7</cbc:UUID>', $xml);
        $this->assertStringContainsString('CHAINED-HASH-007', $xml);
        $this->assertStringNotContainsString('<cbc:UUID>99</cbc:UUID>', $xml);
        $this->assertStringNotContainsString('ONBOARDING-HASH', $xml);
    }
}
