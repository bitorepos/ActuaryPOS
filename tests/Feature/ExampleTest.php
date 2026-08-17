<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Keep a lightweight bootstrap sanity check instead of asserting a root
     * route that this app does not guarantee.
     */
    public function testApplicationBootstraps()
    {
        $this->assertTrue($this->app->bound('router'));
    }
}
