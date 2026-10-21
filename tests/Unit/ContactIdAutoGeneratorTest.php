<?php

namespace Tests\Unit;

use App\ContactIdAutoGenerator;
use RuntimeException;
use Tests\TestCase;

class ContactIdAutoGeneratorTest extends TestCase
{
    public function test_it_formats_the_number_using_the_configured_length()
    {
        $generator = new ContactIdAutoGenerator([
            'prefix' => 'cu',
            'number_length' => 6,
        ]);

        $this->assertSame('CU000001', $generator->formatContactId(1));
        $this->assertSame('CU000042', $generator->formatContactId(42));
    }

    public function test_it_rejects_a_number_that_exceeds_the_configured_length()
    {
        $generator = new ContactIdAutoGenerator([
            'prefix' => 'CU',
            'number_length' => 2,
        ]);

        $this->expectException(RuntimeException::class);
        $generator->formatContactId(100);
    }
}
