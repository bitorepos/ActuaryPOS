<?php

namespace Tests\Unit;

use App\SkuAutoGenerator;
use RuntimeException;
use Tests\TestCase;

class SkuAutoGeneratorTest extends TestCase
{
    public function test_it_formats_the_number_using_the_configured_length()
    {
        $generator = new SkuAutoGenerator([
            'prefix' => 'br01',
            'number_length' => 6,
        ]);

        $this->assertSame('BR01000001', $generator->formatSku(1));
        $this->assertSame('BR01000042', $generator->formatSku(42));
    }

    public function test_it_rejects_a_number_that_exceeds_the_configured_length()
    {
        $generator = new SkuAutoGenerator([
            'prefix' => 'BR01',
            'number_length' => 2,
        ]);

        $this->expectException(RuntimeException::class);
        $generator->formatSku(100);
    }
}
