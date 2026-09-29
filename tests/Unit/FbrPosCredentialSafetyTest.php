<?php

namespace Tests\Unit;

use App\BusinessLocation;
use App\Http\Controllers\SellPosController;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use RuntimeException;

class FbrPosCredentialSafetyTest extends TestCase
{
    /** @test */
    public function it_uses_the_token_assigned_to_the_business_location(): void
    {
        $location = new BusinessLocation();
        $location->loc_settings = ['fbr_token' => '  location-specific-token  '];

        $this->assertSame('location-specific-token', $this->resolveToken($location));
    }

    /** @test */
    public function it_fails_closed_when_the_location_has_no_fbr_token(): void
    {
        $location = new BusinessLocation();
        $location->loc_settings = [];

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('FBR POS Token is missing for this business location');

        $this->resolveToken($location);
    }

    private function resolveToken(BusinessLocation $location): string
    {
        $reflection = new ReflectionClass(SellPosController::class);
        $controller = $reflection->newInstanceWithoutConstructor();
        $method = $reflection->getMethod('fbrAuthToken');
        $method->setAccessible(true);

        return $method->invoke($controller, $location);
    }
}
