<?php

namespace Tests\Unit;

use App\Http\Controllers\SellPosController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class SellPosControllerTotalTest extends TestCase
{
    public function testPosSaleStatusDefaultsToFinalWhenMissing(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'normalizePosSaleStatus');
        $method->setAccessible(true);

        $input = [];

        $method->invokeArgs($controller, [&$input]);

        $this->assertSame('final', $input['status']);
    }

    public function testPosSaleStatusDefaultsToFinalWhenBlank(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'normalizePosSaleStatus');
        $method->setAccessible(true);

        $input = ['status' => ''];

        $method->invokeArgs($controller, [&$input]);

        $this->assertSame('final', $input['status']);
    }

    public function testPosSaleStatusKeepsExplicitDraft(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'normalizePosSaleStatus');
        $method->setAccessible(true);

        $input = ['status' => 'draft'];

        $method->invokeArgs($controller, [&$input]);

        $this->assertSame('draft', $input['status']);
    }

    public function testFinalTotalValidationUsesPreTaxBaseForPercentageServiceCharge(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $property = new \ReflectionProperty(SellPosController::class, 'transactionUtil');
        $property->setAccessible(true);
        $property->setValue($controller, new class {
            public function num_uf($value)
            {
                return is_numeric($value) ? $value : str_replace(',', '', (string) $value);
            }
        });

        $method = new \ReflectionMethod(SellPosController::class, 'validateInvoiceFinalTotal');
        $method->setAccessible(true);

        $input = [
            'status' => 'final',
            'final_total' => '28,289.985',
            'discount_type' => 'percentage',
            'discount_amount' => 0,
            'discount2_type' => null,
            'discount2_amount' => 0,
            'tax_rate_id' => null,
            'packing_charge_type' => 'percent',
            'packing_charge' => 5,
            'round_off_amount' => 1,
            'products' => [
                [
                    'quantity' => 1,
                    'unit_price_inc_tax' => '27,037.260',
                    'item_tax' => '2,002.760',
                ],
            ],
        ];

        $invoice_total = [
            'total_before_tax' => 27037.260,
            'tax' => 0,
        ];

        $this->assertNull($method->invoke($controller, $input, $invoice_total));
    }

    public function testFinalTotalMismatchIsLoggedButDoesNotBlockPosSale(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $property = new \ReflectionProperty(SellPosController::class, 'transactionUtil');
        $property->setAccessible(true);
        $property->setValue($controller, new class {
            public function num_uf($value)
            {
                return is_numeric($value) ? $value : str_replace(',', '', (string) $value);
            }
        });

        $method = new \ReflectionMethod(SellPosController::class, 'validateInvoiceFinalTotal');
        $method->setAccessible(true);

        $input = [
            'status' => 'final',
            'final_total' => '5,238.00',
            'discount_type' => 'fixed',
            'discount_amount' => 0,
            'discount2_type' => null,
            'discount2_amount' => 0,
            'tax_rate_id' => null,
            'round_off_amount' => 0,
        ];

        $invoice_total = [
            'total_before_tax' => 5480.50,
            'tax' => 0,
        ];

        $this->assertNull($method->invoke($controller, $input, $invoice_total));
    }

    public function testFinalTotalMismatchDoesNotBlockTypesOfServiceInvoices(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $property = new \ReflectionProperty(SellPosController::class, 'transactionUtil');
        $property->setAccessible(true);
        $property->setValue($controller, new class {
            public function num_uf($value)
            {
                return is_numeric($value) ? $value : str_replace(',', '', (string) $value);
            }
        });

        $method = new \ReflectionMethod(SellPosController::class, 'validateInvoiceFinalTotal');
        $method->setAccessible(true);

        // Scenario from Image 3: submitted 1,250.00 with line subtotal 1,250.00
        $input = [
            'status' => 'final',
            'final_total' => '1,250.00',
            'discount_type' => 'fixed',
            'discount_amount' => 0,
            'tax_rate_id' => null,
            'packing_charge' => 5,
            'packing_charge_type' => 'percent',
        ];
        $invoice_total = [
            'total_before_tax' => 1250.00,
            'tax' => 0,
        ];
        $this->assertNull($method->invoke($controller, $input, $invoice_total));

        // Scenario from Image 4: submitted 5,839.5 with line subtotal 5,839.5
        $input4 = [
            'status' => 'final',
            'final_total' => '5,839.5',
            'discount_type' => 'fixed',
            'discount_amount' => 0,
            'tax_rate_id' => null,
        ];
        $invoice_total4 = [
            'total_before_tax' => 5839.50,
            'tax' => 0,
        ];
        $this->assertNull($method->invoke($controller, $input4, $invoice_total4));
    }

    public function testAutosaveForcesCalculatedFinalTotalWhenSubmittedTotalIsZero(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $property = new \ReflectionProperty(SellPosController::class, 'transactionUtil');
        $property->setAccessible(true);
        $property->setValue($controller, new class {
            public function num_uf($value)
            {
                return is_numeric($value) ? $value : str_replace(',', '', (string) $value);
            }
        });

        $method = new \ReflectionMethod(SellPosController::class, 'setCalculatedFinalTotal');
        $method->setAccessible(true);

        $input = [
            'status' => 'draft',
            'final_total' => '0.00',
            'discount_type' => 'fixed',
            'discount_amount' => '58.50',
            'discount2_type' => null,
            'discount2_amount' => 0,
            'tax_rate_id' => null,
            'round_off_amount' => 0,
        ];

        $invoice_total = [
            'total_before_tax' => 1170.00,
            'tax' => 0,
        ];

        $method->invokeArgs($controller, [&$input, $invoice_total, true]);

        $this->assertSame(1111.5, $input['final_total']);
    }

    public function testFinalSaleZeroSubmittedTotalFallsBackToCalculatedTotal(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $property = new \ReflectionProperty(SellPosController::class, 'transactionUtil');
        $property->setAccessible(true);
        $property->setValue($controller, new class {
            public function num_uf($value)
            {
                return is_numeric($value) ? $value : str_replace(',', '', (string) $value);
            }
        });

        $method = new \ReflectionMethod(SellPosController::class, 'setCalculatedFinalTotal');
        $method->setAccessible(true);

        $input = [
            'status' => 'final',
            'final_total' => '0.00',
            'discount_type' => null,
            'discount_amount' => 0,
            'discount2_type' => null,
            'discount2_amount' => 0,
            'tax_rate_id' => null,
            'round_off_amount' => 0,
        ];

        $invoice_total = [
            'total_before_tax' => 104485.20,
            'tax' => 0,
        ];

        $method->invokeArgs($controller, [&$input, $invoice_total]);

        $this->assertSame(104485.20, $input['final_total']);
    }

    public function testFinalSaleAllowsZeroAmountPaymentRowForUnpaidInvoice(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $property = new \ReflectionProperty(SellPosController::class, 'transactionUtil');
        $property->setAccessible(true);
        $property->setValue($controller, new class {
            public function num_uf($value)
            {
                return is_numeric($value) ? $value : str_replace(',', '', (string) $value);
            }
        });

        $method = new \ReflectionMethod(SellPosController::class, 'validateFinalSalePaymentPayload');
        $method->setAccessible(true);

        $input = [
            'status' => 'final',
            'final_total' => '620.00',
            'discount_type' => 'fixed',
            'discount_amount' => 0,
            'discount2_type' => null,
            'discount2_amount' => 0,
            'tax_rate_id' => null,
            'round_off_amount' => 0,
            'payment' => [
                [
                    'amount' => '0.00',
                    'method' => 'cash',
                    'paid_on' => '17/08/2026 12:06 PM',
                ],
            ],
        ];

        $invoice_total = [
            'total_before_tax' => 620.00,
            'tax' => 0,
        ];

        $this->assertNull($method->invoke($controller, $input, $invoice_total));
    }

    public function testFinalSaleBlocksWhenPaymentPayloadIsMissing(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $property = new \ReflectionProperty(SellPosController::class, 'transactionUtil');
        $property->setAccessible(true);
        $property->setValue($controller, new class {
            public function num_uf($value)
            {
                return is_numeric($value) ? $value : str_replace(',', '', (string) $value);
            }
        });

        $method = new \ReflectionMethod(SellPosController::class, 'validateFinalSalePaymentPayload');
        $method->setAccessible(true);

        $input = [
            'status' => 'final',
            'final_total' => '620.00',
            'discount_type' => 'fixed',
            'discount_amount' => 0,
            'discount2_type' => null,
            'discount2_amount' => 0,
            'tax_rate_id' => null,
            'round_off_amount' => 0,
            'payment' => [],
        ];

        $invoice_total = [
            'total_before_tax' => 620.00,
            'tax' => 0,
        ];

        $result = $method->invoke($controller, $input, $invoice_total);

        $this->assertSame(0, $result['success']);
        $this->assertSame('Payment information was not received. Sale was not finalized. Please try again.', $result['msg']);
    }

    public function testTimerAutosaveSkipsNewDraftWhenCalculatedLineAmountIsZero(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $property = new \ReflectionProperty(SellPosController::class, 'transactionUtil');
        $property->setAccessible(true);
        $property->setValue($controller, new class {
            public function num_uf($value)
            {
                return is_numeric($value) ? $value : str_replace(',', '', (string) $value);
            }
        });

        $method = new \ReflectionMethod(SellPosController::class, 'shouldSkipNewZeroValueAutosave');
        $method->setAccessible(true);

        $input = [
            'status' => 'draft',
            'final_total' => 0,
            'discount_type' => 'fixed',
            'discount_amount' => 0,
            'discount2_type' => null,
            'discount2_amount' => 0,
            'tax_rate_id' => null,
            'round_off_amount' => 0,
            'products' => [
                [
                    'quantity' => 1,
                    'unit_price_inc_tax' => 0,
                    'line_total' => 0,
                ],
            ],
        ];

        $invoice_total = [
            'total_before_tax' => 0,
            'tax' => 0,
        ];

        $this->assertTrue($method->invoke($controller, Request::create('/'), $input, $invoice_total));
    }

    public function testAutoDraftSaveIsBlockedWhenSettingIsDisabled(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $property = new \ReflectionProperty(SellPosController::class, 'businessUtil');
        $property->setAccessible(true);
        $property->setValue($controller, new class {
            public function getDetails($business_id, $location_id = null)
            {
                return (object) ['common_settings' => ['enable_draft_auto_save' => 0]];
            }
        });

        $method = new \ReflectionMethod(SellPosController::class, 'shouldBlockAutoDraftSave');
        $method->setAccessible(true);

        $request = Request::create('/', 'POST', [
            'auto_draft_save' => 1,
            'location_id' => 5,
        ]);

        $this->assertTrue($method->invoke($controller, $request, 1, ['location_id' => 5]));
    }

    public function testAutoDraftSaveIsAllowedWhenSettingIsEnabled(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $property = new \ReflectionProperty(SellPosController::class, 'businessUtil');
        $property->setAccessible(true);
        $property->setValue($controller, new class {
            public function getDetails($business_id, $location_id = null)
            {
                return (object) ['common_settings' => ['enable_draft_auto_save' => 1]];
            }
        });

        $method = new \ReflectionMethod(SellPosController::class, 'shouldBlockAutoDraftSave');
        $method->setAccessible(true);

        $request = Request::create('/', 'POST', [
            'auto_draft_save' => 1,
            'location_id' => 5,
        ]);

        $this->assertFalse($method->invoke($controller, $request, 1, ['location_id' => 5]));
    }

    public function testManualDraftSaveIsAllowedWhenAutoSaveSettingIsDisabled(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $property = new \ReflectionProperty(SellPosController::class, 'businessUtil');
        $property->setAccessible(true);
        $property->setValue($controller, new class {
            public function getDetails($business_id, $location_id = null)
            {
                return (object) ['common_settings' => ['enable_draft_auto_save' => 0]];
            }
        });

        $method = new \ReflectionMethod(SellPosController::class, 'shouldBlockAutoDraftSave');
        $method->setAccessible(true);

        $request = Request::create('/', 'POST', [
            'auto_draft_save' => 1,
            'manual_draft_save' => 1,
            'location_id' => 5,
        ]);

        $this->assertFalse($method->invoke($controller, $request, 1, ['location_id' => 5]));
    }

    public function testManualDraftSaveUsesOrderedDraftStatus(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'draftStatusForDraftSave');
        $method->setAccessible(true);

        $request = Request::create('/', 'POST', [
            'manual_draft_save' => 1,
        ]);

        $this->assertSame('ordered', $method->invoke($controller, $request));
    }

    public function testBackgroundDraftAutoSaveUsesAutosavedDraftStatus(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'draftStatusForDraftSave');
        $method->setAccessible(true);

        $request = Request::create('/', 'POST', [
            'auto_draft_save' => 1,
        ]);

        $this->assertSame('autosaved', $method->invoke($controller, $request));
    }

    public function testManualDraftSaveMessageDoesNotSayAutosaved(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'draftSaveMessage');
        $method->setAccessible(true);

        $request = Request::create('/', 'POST', [
            'manual_draft_save' => 1,
        ]);

        $this->assertSame('Draft Saved Successfully', $method->invoke($controller, $request));
    }

    public function testBackgroundDraftAutoSaveMessageSaysAutosaved(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'draftSaveMessage');
        $method->setAccessible(true);

        $request = Request::create('/', 'POST', [
            'auto_draft_save' => 1,
        ]);

        $this->assertSame('Draft Autosaved Successfully', $method->invoke($controller, $request));
    }

    public function testFbrDIRateDescriptionNormalizesLocalTaxLabelToPercent(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'localFbrDIRate');
        $method->setAccessible(true);

        $line = [
            'tax_desc' => 'Sales Tax 18%',
            'tax_percent' => 18,
        ];

        $this->assertSame('18%', $method->invoke($controller, $line));
    }

    public function testFbrDIRateDescriptionFallsBackToTaxPercentWhenTaxLabelHasNoPercent(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'localFbrDIRate');
        $method->setAccessible(true);

        $line = [
            'tax_desc' => 'GST',
            'tax_percent' => 18,
        ];

        $this->assertSame('18%', $method->invoke($controller, $line));
    }

    public function testFbrDIRateMatcherUsesFbrDescriptionForMatchingPercent(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'matchFbrDIRate');
        $method->setAccessible(true);

        $line = [
            'tax_percent' => 18,
        ];

        $allowed_rates = [
            ['ratE_ID' => 734, 'ratE_DESC' => '18% along with rupees 60 per kilogram', 'ratE_VALUE' => 18],
            ['ratE_ID' => 280, 'ratE_DESC' => '0%', 'ratE_VALUE' => 0],
        ];

        $this->assertSame('18% along with rupees 60 per kilogram', $method->invoke($controller, $line, '18%', $allowed_rates));
    }

    public function testFbrDIRateFallbackUsesFirstFbrAllowedDescription(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'firstFbrDIRateDescription');
        $method->setAccessible(true);

        $allowed_rates = [
            ['ratE_ID' => 280, 'ratE_DESC' => '0%', 'ratE_VALUE' => 0],
            ['ratE_ID' => 734, 'ratE_DESC' => '18%', 'ratE_VALUE' => 18],
        ];

        $this->assertSame('0%', $method->invoke($controller, $allowed_rates));
    }

    public function testFbrDIRateMatcherRejectsMismatchedSaleTypeRate(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'matchFbrDIRate');
        $method->setAccessible(true);

        $line = [
            'tax_percent' => 18,
        ];

        $allowed_rates = [
            ['ratE_ID' => 742, 'ratE_DESC' => '25%', 'ratE_VALUE' => 25],
        ];

        $this->assertNull($method->invoke($controller, $line, '18%', $allowed_rates));
    }

    public function testFbrDISroIsRequiredForNonStandardRate(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'shouldResolveFbrDISro');
        $method->setAccessible(true);

        $this->assertTrue($method->invoke($controller, [
            'rate' => '25%',
            'sroScheduleNo' => '',
            'sroItemSerialNo' => '',
        ]));

        $this->assertFalse($method->invoke($controller, [
            'rate' => '18%',
            'sroScheduleNo' => '',
            'sroItemSerialNo' => '',
        ]));
    }

    public function testFbrDISroScheduleMatcherPrefersSaleTypeTextMatch(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'matchFbrDISroSchedule');
        $method->setAccessible(true);

        $schedules = [
            ['srO_ID' => 1, 'srO_DESC' => 'Other Schedule'],
            ['srO_ID' => 2, 'srO_DESC' => 'SRO.297(I)/2023'],
        ];

        $this->assertSame($schedules[1], $method->invoke($controller, 'Goods as per SRO.297(|)/2023', $schedules));
    }

    public function testFbrDISroItemSerialUsesDescriptionBeforeId(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'firstFbrDISroItemSerial');
        $method->setAccessible(true);

        $sro_items = [
            ['srO_ITEM_ID' => 17853, 'srO_ITEM_DESC' => '50'],
        ];

        $this->assertSame('50', $method->invoke($controller, $sro_items));
    }

    public function testFbrDISroItemSerialAcceptsAlternateFbrSerialKeys(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'firstFbrDISroItemSerial');
        $method->setAccessible(true);

        $sro_items = [
            ['sroItemSerialNo' => '12', 'SRO_ITEM_ID' => 44812],
        ];

        $this->assertSame('12', $method->invoke($controller, $sro_items));
    }

    public function testFbrDISroItemMatcherPrefersHsCodeMatchedSerial(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'matchFbrDISroItemSerial');
        $method->setAccessible(true);

        $sro_items = [
            ['sroItemSerialNo' => '5', 'hsCode' => '0101.0000'],
            ['sroItemSerialNo' => '12', 'hsCode' => '6110.1200'],
        ];

        $this->assertSame('12', $method->invoke($controller, $sro_items, ['hsCode' => '6110.1200']));
    }

    public function testFbrDIProvinceCodeUsesDocumentedFallbackForPunjabAndSindh(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'resolveFbrDIProvinceCode');
        $method->setAccessible(true);

        $this->assertSame(7, $method->invoke($controller, 'Punjab', ''));
        $this->assertSame(8, $method->invoke($controller, 'Sindh', ''));
    }

    public function testFbrDIUomMatcherMapsPiecesToFbrNumbersDescription(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'matchFbrDIUom');
        $method->setAccessible(true);

        $allowed_uoms = [
            ['uoM_ID' => 1, 'description' => 'KG'],
            ['uoM_ID' => 2, 'description' => 'Numbers, pieces, units'],
        ];

        $this->assertSame('Numbers, pieces, units', $method->invoke($controller, 'Pcs', $allowed_uoms));
    }

    public function testFbrDIUomFallbackUsesFirstFbrAllowedDescription(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'firstFbrDIUomDescription');
        $method->setAccessible(true);

        $allowed_uoms = [
            ['uoM_ID' => 9, 'description' => 'KG'],
            ['uoM_ID' => 2, 'description' => 'Numbers, pieces, units'],
        ];

        $this->assertSame('KG', $method->invoke($controller, $allowed_uoms));
    }

    public function testFbrDIItemErrorContextIncludesProductHsAndUom(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'fbrDIItemErrorContext');
        $method->setAccessible(true);

        $context = $method->invoke($controller, [[
            'name' => 'Sample Item',
            'hs_code' => '4805.1900',
            'rate' => '18%',
            'sale_type' => 'Goods at standard rate (default)',
            'sro_schedule_no' => '',
            'sro_item_serial_no' => '',
            'local_uom' => 'Pcs',
            'submitted_uom' => 'Numbers, pieces, units',
        ]], 1);

        $this->assertStringContainsString('Product: Sample Item', $context);
        $this->assertStringContainsString('HS: 4805.1900', $context);
        $this->assertStringContainsString('Rate: 18%', $context);
        $this->assertStringContainsString('Sale Type: Goods at standard rate (default)', $context);
        $this->assertStringContainsString('SRO: ', $context);
        $this->assertStringContainsString('SRO Item: ', $context);
        $this->assertStringContainsString('UoM: Numbers, pieces, units', $context);
        $this->assertStringContainsString('Local UoM: Pcs', $context);
    }

    public function testOwnPosSellPermissionTakesPrecedenceForRecentTransactions(): void
    {
        $controller = (new ReflectionClass(SellPosController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(SellPosController::class, 'canViewAllRecentPosTransactions');
        $method->setAccessible(true);

        $this->assertFalse($method->invoke($controller, false, true, true));
        $this->assertTrue($method->invoke($controller, false, true, false));
        $this->assertTrue($method->invoke($controller, true, true, true));
    }

    public function testPosOwnSelectionDoesNotGetAllPosSellFromDirectSellCompatibility(): void
    {
        $controller = (new ReflectionClass(RoleController::class))->newInstanceWithoutConstructor();
        $method = new \ReflectionMethod(RoleController::class, 'normalizePermissionCompatibility');
        $method->setAccessible(true);

        $permissions = $method->invoke($controller, ['direct_sell.view', 'sell.view_own'], [
            'pos_sell_view' => 'sell.view_own',
            'sell_view' => 'direct_sell.view',
        ]);

        $this->assertContains('direct_sell.view', $permissions);
        $this->assertContains('sell.view_own', $permissions);
        $this->assertNotContains('sell.view', $permissions);
    }
}
