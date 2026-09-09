<?php

namespace Tests\Unit;

use App\Http\Controllers\ContactController;
use App\Utils\TransactionUtil;
use Illuminate\Container\Container;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Session\ArraySessionHandler;
use Illuminate\Session\Store;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use PHPUnit\Framework\TestCase;

class ContactCreditLimitTest extends TestCase
{
    private $previousContainer;
    private $previousResolver;
    private $database;

    protected function setUp(): void
    {
        $this->previousContainer = Container::getInstance();
        $this->previousResolver = Model::getConnectionResolver();
        $container = new Container();
        Container::setInstance($container);
        $translator = new Translator(new ArrayLoader(), 'en');
        $container->instance('translator', $translator);
        $container->instance('validator', new Factory($translator, $container));
        $factory = $this->createMock(ResponseFactory::class);
        $factory->method('json')->willReturnCallback(function ($data) {
            return new JsonResponse($data);
        });
        $container->instance(ResponseFactory::class, $factory);

        $this->database = new Capsule($container);
        $this->database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $this->database->bootEloquent();
        $this->database->getConnection()->getSchemaBuilder()->create('contacts', function ($table) {
            $table->integer('id');
            $table->integer('business_id');
            $table->softDeletes();
        });
        $this->database->getConnection()->table('contacts')->insert(['id' => 10, 'business_id' => 2]);
    }

    protected function tearDown(): void
    {
        $this->database->getConnection()->disconnect();
        if ($this->previousResolver) {
            Model::setConnectionResolver($this->previousResolver);
        } else {
            Model::unsetConnectionResolver();
        }
        Container::setInstance($this->previousContainer);
        parent::tearDown();
    }

    private function request($businessId = 2): Request
    {
        $request = new class extends Request {
            public function validate(array $rules)
            {
                return app('validator')->make($this->all(), $rules)->validate();
            }
        };
        $request->query->replace(['contact_id' => 10, 'final_amount' => 100, 'amount' => 20, 'exclude_transaction_id' => 123]);
        $request->setLaravelSession(new Store('test', new ArraySessionHandler(120)));
        $request->session()->put('user.business_id', $businessId);

        return $request;
    }

    private function controller($util): ContactController
    {
        return new class($util) extends ContactController {
            public function __construct($util)
            {
                $this->transactionUtil = $util;
            }
        };
    }

    public function testAllowedCreditReturnsJsonAndExcludesTheEditedSale(): void
    {
        $util = $this->createMock(TransactionUtil::class);
        $util->expects($this->once())->method('isCustomerCreditLimitExeeded')->with([
            'status' => 'final', 'contact_id' => 10, 'final_total' => 100,
            'payment' => [['amount' => 20]],
        ], 123, false, true)->willReturn(false);

        $response = $this->controller($util)->checkCreditLimit($this->request());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(['msg' => null], $response->getData(true));
    }

    public function testZeroCreditLimitIsReturnedAsARejection(): void
    {
        $util = $this->createMock(TransactionUtil::class);
        $util->method('isCustomerCreditLimitExeeded')->willReturn(0);
        $response = $this->controller($util)->checkCreditLimit($this->request());
        $this->assertNotEmpty($response->getData(true)['msg']);
    }

    public function testExistingJsonCreditErrorIsPreserved(): void
    {
        $util = $this->createMock(TransactionUtil::class);
        $error = new JsonResponse(['msg' => 'Payment exceeds total']);
        $util->method('isCustomerCreditLimitExeeded')->willReturn($error);
        $this->assertSame($error, $this->controller($util)->checkCreditLimit($this->request()));
    }

    public function testOtherBusinessContactIsNotChecked(): void
    {
        $util = $this->createMock(TransactionUtil::class);
        $util->expects($this->never())->method('isCustomerCreditLimitExeeded');
        $this->expectException(ModelNotFoundException::class);
        $this->controller($util)->checkCreditLimit($this->request(99));
    }
}
