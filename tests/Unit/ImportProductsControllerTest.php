<?php

namespace Tests\Unit;

use App\Exports\ProductsExport;
use App\Http\Controllers\ImportProductsController;
use App\Utils\ModuleUtil;
use App\Utils\ProductUtil;
use ReflectionClass;
use stdClass;
use Tests\TestCase;

class ImportProductsControllerTest extends TestCase
{
    public function test_explicit_zero_selling_price_is_used_as_zero()
    {
        $prices = $this->calculateVariationPrices('80', '80', '0', 0, 'none', 25, 'percentage');

        $this->assertSame(0.0, $prices['dsp_exc_tax']);
        $this->assertSame(0.0, $prices['dsp_inc_tax']);
    }

    public function test_blank_selling_price_is_calculated_from_margin()
    {
        $prices = $this->calculateVariationPrices('80', '80', '', 0, 'none', 25, 'percentage');

        $this->assertSame(100.0, $prices['dsp_exc_tax']);
        $this->assertSame(100.0, $prices['dsp_inc_tax']);
    }

    public function test_product_export_preserves_selected_sub_unit_order()
    {
        $product = new stdClass();
        $product->sub_unit_ids = ['36', '1'];

        $sub_units = [
            1 => ['name' => 'Base unit'],
            36 => ['name' => 'Pack size'],
        ];

        $export = (new ReflectionClass(ProductsExport::class))->newInstanceWithoutConstructor();
        $method = (new ReflectionClass($export))->getMethod('getProductSubUnitNames');
        $method->setAccessible(true);

        $this->assertSame(['Pack size', 'Base unit'], $method->invoke($export, $product, $sub_units));
    }

    private function calculateVariationPrices($dpp_exc_tax, $dpp_inc_tax, $selling_price, $tax_amount, $tax_type, $margin, $tax_rate_type)
    {
        $controller = new ImportProductsController(new ProductUtil(), new ModuleUtil());
        $method = (new ReflectionClass($controller))->getMethod('calculateVariationPrices');
        $method->setAccessible(true);

        return $method->invoke(
            $controller,
            $dpp_exc_tax,
            $dpp_inc_tax,
            $selling_price,
            $tax_amount,
            $tax_type,
            $margin,
            $tax_rate_type
        );
    }
}
