<?php

namespace Tests\Unit;

use App\Utils\LoginRedirect;
use Illuminate\Http\Request;
use Illuminate\Session\ArraySessionHandler;
use Illuminate\Session\Store;
use PHPUnit\Framework\TestCase;

class LoginRedirectTest extends TestCase
{
    /** @dataProvider destinations */
    public function testLoginDestinationRespectsModulesAndPermissions($modules, $permissions, $intended, $expected, $retained): void
    {
        $request = Request::create('https://example.test/login');
        $request->setLaravelSession(new Store('test', new ArraySessionHandler(120)));
        $request->session()->put('url.intended', $intended);
        $user = new class($modules, $permissions) {
            public $business;
            public $user_type = 'user';
            private $permissions;

            public function __construct($modules, $permissions)
            {
                $this->business = (object) ['enabled_modules' => $modules];
                $this->permissions = $permissions;
            }

            public function can($permission)
            {
                return in_array($permission, $this->permissions, true);
            }
        };

        $this->assertSame($expected, LoginRedirect::destination($request, $user));
        $this->assertSame($retained ? $intended : null, $request->session()->get('url.intended'));
    }

    public static function destinations(): array
    {
        return [
            'admin with disabled POS and saved URL' => [[], ['dashboard.data', 'sell.create', 'superadmin'], 'https://example.test/pos/create?location_id=1', '/home', false],
            'cashier with disabled module' => [[], ['sell.create'], '/pos/create', '/home', false],
            'disabled saved register' => [[], ['sell.create'], '/cash-register/create', '/home', false],
            'disabled POS list' => [[], ['dashboard.data'], '/pos', '/home', false],
            'no role access to POS' => [['pos_sale'], ['dashboard.data'], '/pos/create', '/home', false],
            'no role access to register' => [['pos_sale'], [], '/cash-register/create', '/home', false],
            'enabled cashier' => [['pos_sale'], ['sell.create'], '/pos/create', '/pos/create', true],
            'enabled admin' => [['pos_sale'], ['dashboard.data', 'sell.create'], '/pos/create', '/home', true],
            'unrelated saved URL' => [[], ['dashboard.data'], '/purchases', '/home', true],
        ];
    }
}
