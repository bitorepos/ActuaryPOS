<?php

namespace Tests\Unit;

use App\Http\Controllers\SellReturnController;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class SellReturnPaymentLimitTest extends TestCase
{
    private function makeController(): SellReturnController
    {
        $controller = (new ReflectionClass(SellReturnController::class))->newInstanceWithoutConstructor();
        $transaction_util = new class {
            public function num_uf($value)
            {
                return (float) str_replace(',', '', (string) $value);
            }
        };

        $property = new \ReflectionProperty(SellReturnController::class, 'transactionUtil');
        $property->setAccessible(true);
        $property->setValue($controller, $transaction_util);

        return $controller;
    }

    public function testRefundEqualToReturnTotalIsAllowed(): void
    {
        $controller = $this->makeController();
        $method = new \ReflectionMethod(SellReturnController::class, 'sellReturnPaymentsExceedTotal');
        $method->setAccessible(true);

        $this->assertFalse($method->invoke($controller, [['amount' => '250.00']], 250.00));
    }

    public function testRefundAboveReturnTotalIsRejectedAcrossPaymentMethods(): void
    {
        $controller = $this->makeController();
        $method = new \ReflectionMethod(SellReturnController::class, 'sellReturnPaymentsExceedTotal');
        $method->setAccessible(true);

        $this->assertTrue($method->invoke($controller, [
            ['amount' => '150.00', 'method' => 'cash'],
            ['amount' => '100.01', 'method' => 'card'],
        ], 250.00));
    }

    public function testRefundTotalParsesFormattedPaymentAmounts(): void
    {
        $controller = $this->makeController();
        $method = new \ReflectionMethod(SellReturnController::class, 'sellReturnPaymentsExceedTotal');
        $method->setAccessible(true);

        $this->assertFalse($method->invoke($controller, [['amount' => '1,250.00']], 1250.00));
    }
}
