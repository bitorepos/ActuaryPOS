<?php

namespace Tests\Unit;

use App\Utils\CoreSecurity;
use Illuminate\Http\Request;
use Illuminate\Session\ArraySessionHandler;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Hash;
use Modules\Cms\Http\Controllers\CmsController;
use Modules\Cms\Utils\CmsUtil;
use Tests\TestCase;

class CmsContactEmailVerificationTest extends TestCase
{
    private array $originalVerifiedModules = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->originalVerifiedModules = CoreSecurity::$verifiedModules;
        CoreSecurity::$verifiedModules = array_values(array_unique(array_merge(CoreSecurity::$verifiedModules, ['Cms'])));
    }

    protected function tearDown(): void
    {
        CoreSecurity::$verifiedModules = $this->originalVerifiedModules;
        parent::tearDown();
    }

    public function testContactEmailVerificationCodeMustMatchAndBeUnexpired(): void
    {
        $controller = new class(new CmsUtil) extends CmsController {
            public function keyFor(string $email): string
            {
                return $this->contactEmailVerificationSessionKey($email);
            }

            public function validCode(Request $request, string $email, string $code): bool
            {
                return $this->isValidContactEmailVerificationCode($request, $email, $code);
            }
        };

        $request = Request::create('/c/submit-contact-form', 'POST');
        $request->setLaravelSession(new Store('test', new ArraySessionHandler(60)));

        $email = 'customer@example.com';
        $sessionKey = $controller->keyFor($email);

        $this->assertFalse($controller->validCode($request, $email, '123456'));

        $request->session()->put($sessionKey, [
            'hash' => Hash::make('123456'),
            'expires_at' => now()->addMinutes(15)->timestamp,
        ]);

        $this->assertFalse($controller->validCode($request, $email, '654321'));
        $this->assertTrue($controller->validCode($request, $email, '123456'));

        $request->session()->put($sessionKey, [
            'hash' => Hash::make('123456'),
            'expires_at' => now()->subMinute()->timestamp,
        ]);

        $this->assertFalse($controller->validCode($request, $email, '123456'));
        $this->assertFalse($request->session()->has($sessionKey));
    }
}
