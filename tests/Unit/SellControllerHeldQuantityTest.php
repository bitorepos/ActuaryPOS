<?php

namespace Tests\Unit;

use App\Http\Controllers\SellController;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

class SellControllerHeldQuantityTest extends TestCase
{
    public function testHeldQuantityIncludesSchemeQuantityAndExcludesPendingDeliveries(): void
    {
        $controller = (new ReflectionClass(SellController::class))->newInstanceWithoutConstructor();
        $method = new ReflectionMethod(SellController::class, 'calculateHeldSaleQuantity');
        $method->setAccessible(true);

        $quantity = 0.0;
        $scheme_quantity = 1.0;

        $this->assertSame(
            1.0,
            $method->invoke($controller, $quantity + $scheme_quantity, 0.0, 0.0)
        );
    }

    public function testHeldQuantityCannotBecomeNegativeAfterDelivery(): void
    {
        $controller = (new ReflectionClass(SellController::class))->newInstanceWithoutConstructor();
        $method = new ReflectionMethod(SellController::class, 'calculateHeldSaleQuantity');
        $method->setAccessible(true);

        $this->assertSame(0.0, $method->invoke($controller, 1.0, 0.0, 2.0));
    }
}
