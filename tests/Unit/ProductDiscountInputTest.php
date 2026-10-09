<?php

namespace Tests\Unit;

use App\Http\Controllers\ProductController;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;
use App\Utils\ProductUtil;
use App\Utils\Util;
use Illuminate\Http\Request;
use ReflectionClass;
use Tests\TestCase;

class ProductDiscountInputTest extends TestCase
{
    public function test_zero_discount_amount_is_preserved_for_product_updates(): void
    {
        $controller = new ProductController(
            new ProductUtil(),
            new ModuleUtil(),
            new Util(),
            new BusinessUtil()
        );
        $method = (new ReflectionClass($controller))->getMethod('productDiscountInput');
        $method->setAccessible(true);

        $discount = $method->invoke(
            $controller,
            Request::create('/', 'POST', [
                'discount_type' => 'fixed',
                'discount_amount' => '0',
            ])
        );

        $this->assertSame(0.0, $discount['discount_amount']);
    }
}
