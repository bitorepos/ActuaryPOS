<?php

namespace Tests\Unit;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Routing\ResponseFactory as ResponseFactoryContract;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Mail\MailManager;
use Illuminate\Mail\Transport\ArrayTransport;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Facade;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use Illuminate\Validation\ValidationException;
use Modules\Superadmin\Http\Controllers\SuperadminSettingsController;
use PHPUnit\Framework\TestCase;

class SuperadminTestEmailTest extends TestCase
{
    private $app;
    private $previousApp;
    private $controller;
    private $manager;
    private $allowed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->previousApp = Facade::getFacadeApplication();
        $this->app = new Application(dirname(__DIR__, 2));
        $this->app->instance('config', new Repository(['app' => ['env' => 'testing'], 'mail' => ['default' => 'array']]));
        $loader = new ArrayLoader;
        $loader->addMessages('en', 'lang', require dirname(__DIR__, 2).'/modules/Superadmin/Resources/lang/en/lang.php', 'superadmin');
        $translator = new Translator($loader, 'en');
        $this->app->instance('translator', $translator);
        $this->app->instance('validator', new Factory($translator, $this->app));
        $view = \Mockery::mock(ViewFactory::class);
        $this->app->instance('view', $view);
        $this->app->instance('events', new Dispatcher($this->app));
        $this->app->instance(ResponseFactoryContract::class, new ResponseFactory($view, \Mockery::mock(Redirector::class)));
        $user = \Mockery::mock();
        $user->shouldReceive('can')->with('superadmin')->andReturnUsing(function () { return $this->allowed; });
        $auth = \Mockery::mock(AuthFactory::class);
        $auth->shouldReceive('user')->andReturn($user);
        $this->app->instance(AuthFactory::class, $auth);
        $this->manager = \Mockery::mock(MailManager::class);
        $this->app->instance(MailManager::class, $this->manager);
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->app);

        // Exercise the action without the licensed module bootstrap or a database.
        $reflection = new \ReflectionClass(SuperadminSettingsController::class);
        $this->controller = $reflection->newInstanceWithoutConstructor();
        $property = $reflection->getProperty('mailDrivers');
        $property->setAccessible(true);
        $property->setValue($this->controller, ['smtp' => 'SMTP', 'sendmail' => 'Sendmail']);
    }

    protected function tearDown(): void
    {
        \Mockery::close();
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->previousApp);
        Application::setInstance($this->previousApp);
        parent::tearDown();
    }

    private function request(array $overrides = []): Request
    {
        return Request::create('/superadmin/settings/test-email', 'POST', array_merge([
            'test_email' => 'recipient@example.com', 'MAIL_MAILER' => 'smtp',
            'MAIL_HOST' => 'smtp.example.com', 'MAIL_PORT' => '587',
            'MAIL_USERNAME' => 'test-user', 'MAIL_PASSWORD' => 'secret-test-password',
            'MAIL_ENCRYPTION' => 'tls', 'MAIL_VERIFY_PEER' => '1',
            'MAIL_FROM_ADDRESS' => 'sender@example.com', 'MAIL_FROM_NAME' => 'Test Sender',
        ], $overrides));
    }

    public function testSendsWithSubmittedSettingsWithoutChangingDefaultMailConfiguration(): void
    {
        $transport = new ArrayTransport;
        $before = config('mail');
        $this->manager->shouldReceive('createSymfonyTransport')->once()->with(\Mockery::on(function ($config) {
            return $config['host'] === 'smtp.example.com' && $config['port'] === 587
                && $config['username'] === 'test-user' && $config['password'] === 'secret-test-password'
                && $config['verify_peer'] === true && $config['scheme'] === 'smtp';
        }))->andReturn($transport);
        $response = $this->controller->testEmail($this->request());
        $this->assertTrue($response->getData(true)['success']);
        $message = $transport->messages()->first()->getOriginalMessage();
        $this->assertSame('recipient@example.com', $message->getTo()[0]->getAddress());
        $this->assertSame('sender@example.com', $message->getFrom()[0]->getAddress());
        $this->assertSame('Email settings test', $message->getSubject());
        $this->assertSame($before, config('mail'));
    }

    public function testFailureDoesNotExposeTransportSecrets(): void
    {
        $this->manager->shouldReceive('createSymfonyTransport')->once()->andThrow(new \RuntimeException('secret-test-password'));
        $response = $this->controller->testEmail($this->request());
        $this->assertSame(422, $response->getStatusCode());
        $this->assertFalse($response->getData(true)['success']);
        $this->assertStringNotContainsString('secret-test-password', $response->getContent());
    }

    public function testInvalidRecipientAndSmtpPortAreRejectedBeforeSending(): void
    {
        $this->manager->shouldNotReceive('createSymfonyTransport');
        try {
            $this->controller->testEmail($this->request(['test_email' => 'invalid', 'MAIL_PORT' => '70000']));
            $this->fail('Expected validation errors.');
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('test_email', $e->errors());
            $this->assertArrayHasKey('MAIL_PORT', $e->errors());
        }
    }

    public function testNonSuperadminCannotSend(): void
    {
        $this->allowed = false;
        $this->manager->shouldNotReceive('createSymfonyTransport');
        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);
        $this->controller->testEmail($this->request());
    }

    public function testDemoCannotSend(): void
    {
        config(['app.env' => 'demo']);
        $this->manager->shouldNotReceive('createSymfonyTransport');
        $this->assertSame(403, $this->controller->testEmail($this->request())->getStatusCode());
    }
}
