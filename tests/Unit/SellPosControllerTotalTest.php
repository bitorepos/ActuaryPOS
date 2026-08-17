<?php

namespace Tests\Unit;

use App\Http\Controllers\SellPosController;
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
}
