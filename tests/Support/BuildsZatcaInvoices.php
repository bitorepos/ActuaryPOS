<?php

namespace Tests\Support;

use Illuminate\Support\Carbon;
use Modules\ZATCA\Entities\ZatcaInvoice;
use Modules\ZATCA\Entities\ZatcaInvoiceItem;
use Modules\ZATCA\Entities\ZatcaOnboarding;

trait BuildsZatcaInvoices
{
    protected function makeZatcaInvoice(array $overrides = [], ?array $items = null, array $onboardingOverrides = []): ZatcaInvoice
    {
        $invoice = new ZatcaInvoice(array_merge([
            'business_id' => 1,
            'location_id' => 1,
            'invoice_number' => 'INV-1001',
            'uuid' => '11111111-2222-3333-4444-555555555555',
            'icv_value' => 42,
            'pih_value' => 'PREVIOUS-HASH',
            'invoice_type_code' => '388',
            'invoice_sub_type' => 'B2B',
            'invoice_date' => Carbon::parse('2026-03-31'),
            'invoice_time' => '14:30:00',
            'due_date' => Carbon::parse('2026-04-01'),
            'seller_name' => 'Test Seller',
            'seller_vat' => '300000000000003',
            'seller_crn' => '1010101010',
            'seller_address' => 'King Road, Riyadh',
            'buyer_name' => 'Buyer One',
            'buyer_vat' => '300000000000013',
            'buyer_address' => 'Main Street',
            'buyer_city' => 'Riyadh',
            'buyer_postal_code' => '12345',
            'buyer_country_code' => 'SA',
            'buyer_district' => 'Al Olaya',
            'buyer_building_number' => '10',
            'total_excluding_vat' => 100.00,
            'total_vat' => 15.00,
            'total_including_vat' => 115.00,
            'total_discount' => 0.00,
            'document_discount_amount' => 0.00,
            'document_discount_reason' => null,
            'prepaid_amount' => 0.00,
            'payable_amount' => 115.00,
            'taxable_amount_15' => 100.00,
            'tax_amount_15' => 15.00,
            'taxable_amount_5' => 0.00,
            'tax_amount_5' => 0.00,
            'taxable_amount_0' => 0.00,
            'tax_amount_0' => 0.00,
            'exempt_amount' => 0.00,
            'payment_method' => '10',
            'payment_terms' => 'Cash',
            'note_reason' => null,
            'original_invoice_number' => null,
            'original_invoice_uuid' => null,
            'original_invoice_date' => null,
            'validation_status' => 'pending',
            'sync_status' => 'pending',
            'zatca_status' => null,
            'retry_count' => 0,
            'submission_attempt_count' => 0,
            'invoice_hash' => 'BASE64-INVOICE-HASH',
            'digital_signature' => 'BASE64-SIGNATURE',
            'qr_code' => 'BASE64-QR',
        ], $overrides));

        $itemPayloads = $items ?? [[]];
        $resolvedItems = collect($itemPayloads)->map(function ($item) {
            if ($item instanceof ZatcaInvoiceItem) {
                return $item;
            }

            return $this->makeZatcaInvoiceItem($item);
        });

        $invoice->setRelation('items', $resolvedItems);
        $invoice->setRelation('onboarding', new ZatcaOnboarding(array_merge([
            'organization_name' => 'Test Seller Org',
            'vat_registration_number' => '300000000000003',
            'crn_number' => '1010101010',
            'street_name' => 'King Road',
            'building_number' => '10',
            'district' => 'Al Olaya',
            'city' => 'Riyadh',
            'postal_code' => '12345',
            'country_code' => 'SA',
            'invoice_counter' => 42,
            'previous_invoice_hash' => 'PREVIOUS-HASH',
            'portal_mode' => 'simulation',
            'status' => 'active',
        ], $onboardingOverrides)));

        return $invoice;
    }

    protected function makeZatcaInvoiceItem(array $overrides = []): ZatcaInvoiceItem
    {
        return new ZatcaInvoiceItem(array_merge([
            'item_name' => 'Widget',
            'item_description' => 'Blue edition',
            'quantity' => 2,
            'unit_code' => 'PCE',
            'unit_price' => 50.00,
            'line_extension_amount' => 100.00,
            'discount_amount' => 0.00,
            'discount_reason' => null,
            'tax_rate' => 15.00,
            'tax_amount' => 15.00,
            'tax_category' => 'S',
        ], $overrides));
    }

    protected function parseBase64Tlv(string $payload): array
    {
        $binary = base64_decode($payload, true);
        $this->assertNotFalse($binary, 'Expected a valid base64 TLV payload.');

        $offset = 0;
        $decoded = [];
        $length = strlen($binary);

        while ($offset < $length) {
            $tag = ord($binary[$offset]);
            $valueLength = ord($binary[$offset + 1]);
            $value = substr($binary, $offset + 2, $valueLength);
            $decoded[$tag] = $value;
            $offset += 2 + $valueLength;
        }

        return $decoded;
    }
}
