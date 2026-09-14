<?php

namespace Tests\Unit;

use App\Jobs\ProcessAccountingRemap;
use App\Notifications\AccountingRemapProgressNotification;
use App\User;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Modules\Accounting\Utils\AccountingRemapUtil;
use Tests\TestCase;

class AccountingRemapAllJobTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');

        foreach ([
            'business' => 'id INTEGER PRIMARY KEY, ref_no_prefixes TEXT',
            'business_locations' => 'id INTEGER PRIMARY KEY, business_id INTEGER, name TEXT, is_active INTEGER, accounting_default_map TEXT, default_payment_accounts TEXT',
            'users' => 'id INTEGER PRIMARY KEY, user_type TEXT, surname TEXT, first_name TEXT, last_name TEXT, username TEXT, email TEXT, password TEXT, language TEXT, business_id INTEGER, remember_token TEXT, created_at TEXT, updated_at TEXT, deleted_at TEXT',
            'notifications' => 'id TEXT PRIMARY KEY, type TEXT, notifiable_type TEXT, notifiable_id INTEGER, data TEXT, read_at TEXT, created_at TEXT, updated_at TEXT',
            'permissions' => 'id INTEGER PRIMARY KEY, name TEXT, guard_name TEXT, created_at TEXT, updated_at TEXT',
            'roles' => 'id INTEGER PRIMARY KEY, name TEXT, guard_name TEXT, created_at TEXT, updated_at TEXT, deleted_at TEXT',
            'model_has_permissions' => 'permission_id INTEGER, model_type TEXT, model_id INTEGER',
            'model_has_roles' => 'role_id INTEGER, model_type TEXT, model_id INTEGER',
            'role_has_permissions' => 'permission_id INTEGER, role_id INTEGER',
        ] as $table => $columns) {
            DB::statement("CREATE TABLE IF NOT EXISTS $table ($columns)");
        }

        DB::table('business')->insert([
            'id' => 1,
            'ref_no_prefixes' => json_encode(['contact_payment' => 'PAY-CP-']),
        ]);

        DB::table('users')->insert([
            'id' => 1,
            'business_id' => 1,
            'username' => 'testuser',
            'email' => 'test@example.com',
        ]);
    }

    public function test_contact_payment_prefix_resolution_and_fallback(): void
    {
        $remapUtil = new AccountingRemapUtil();

        // Configured prefix
        $this->assertSame('PAY-CP-', $remapUtil->getContactPaymentPrefix(1));

        // Unconfigured business fallback
        DB::table('business')->insert([
            'id' => 2,
            'ref_no_prefixes' => json_encode([]),
        ]);
        $this->assertSame('CP', $remapUtil->getContactPaymentPrefix(2));

        // Non-existent business fallback
        $this->assertSame('CP', $remapUtil->getContactPaymentPrefix(999));
    }

    public function test_remap_all_missing_executes_in_tab_order_and_reports_progress(): void
    {
        $remapUtil = $this->getMockBuilder(AccountingRemapUtil::class)
            ->onlyMethods(['remapType'])
            ->getMock();

        $callOrder = [];
        $remapUtil->method('remapType')
            ->willReturnCallback(function ($type, $business_id, $user_id, $options) use (&$callOrder) {
                $callOrder[] = $type;
                return 2; // simulated 2 records remapped per type
            });

        $progressUpdates = [];
        $onProgress = function ($stepIndex, $totalSteps, $type, $label, $count, $percent, $status) use (&$progressUpdates) {
            $progressUpdates[] = [
                'step' => $stepIndex,
                'total' => $totalSteps,
                'type' => $type,
                'percent' => $percent,
            ];
        };

        $result = $remapUtil->remapAllMissing(1, 1, ['manufacturing_module', 'essentials_module'], $onProgress);

        $this->assertTrue($result['completed']);
        $this->assertGreaterThan(0, $result['total_remapped']);
        $this->assertNotEmpty($progressUpdates);

        // Opening balance first, Contact payments last
        $this->assertSame('opening_balance', $callOrder[0]);
        $this->assertSame('contact_payment', end($callOrder));
    }

    public function test_remap_all_missing_aborts_early_when_cancellation_requested(): void
    {
        $remapUtil = $this->getMockBuilder(AccountingRemapUtil::class)
            ->onlyMethods(['remapType'])
            ->getMock();

        $processed = 0;
        $remapUtil->method('remapType')
            ->willReturnCallback(function () use (&$processed) {
                $processed++;
                return 1;
            });

        $cancelAfterStep = 3;
        $currentStep = 0;
        $isCancelled = function () use (&$currentStep, $cancelAfterStep) {
            $currentStep++;
            return $currentStep > $cancelAfterStep;
        };

        $result = $remapUtil->remapAllMissing(1, 1, [], null, $isCancelled);

        $this->assertFalse($result['completed']);
        $this->assertLessThanOrEqual($cancelAfterStep, $processed);
    }

    public function test_process_accounting_remap_job_updates_notifications_and_releases_lock(): void
    {
        $notificationId = (string) Str::uuid();
        $lockToken = (string) Str::uuid();
        $lockKey = 'accounting_remap_lock_1';

        DB::table('notifications')->insert([
            'id' => $notificationId,
            'type' => AccountingRemapProgressNotification::class,
            'notifiable_type' => User::class,
            'notifiable_id' => 1,
            'data' => json_encode([
                'msg' => 'Queued...',
                'status' => 'pending',
                'percent' => 0,
                'start_time' => microtime(true),
                'business_id' => 1,
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Cache::put($lockKey, [
            'notification_id' => $notificationId,
            'token' => $lockToken,
            'business_id' => 1,
            'status' => 'queued',
        ], 3600);

        $mockRemapUtil = $this->getMockBuilder(AccountingRemapUtil::class)
            ->onlyMethods(['remapAllMissing'])
            ->getMock();

        $mockRemapUtil->method('remapAllMissing')
            ->willReturn([
                'total_remapped' => 5,
                'summary' => ['sell' => 5],
                'completed' => true,
            ]);

        $job = new ProcessAccountingRemap(
            null,
            1,
            1,
            $notificationId,
            $lockKey,
            $lockToken,
            []
        );

        $job->handle($mockRemapUtil);

        // Verify notification updated to completed
        $notification = DB::table('notifications')->where('id', $notificationId)->first();
        $this->assertNotNull($notification);
        $data = json_decode($notification->data, true);
        $this->assertSame('completed', $data['status']);
        $this->assertSame(100, $data['percent']);
        $this->assertStringContainsString('5 unmapped record(s) processed', $data['msg']);

        // Verify lock is released
        $this->assertNull(Cache::get($lockKey));
    }

    public function test_job_dispatches_on_shared_redis_connection(): void
    {
        Queue::fake();

        ProcessAccountingRemap::dispatch(
            null,
            1,
            1,
            (string) Str::uuid(),
            'accounting_remap_lock_1',
            (string) Str::uuid(),
            ['manufacturing_module']
        )->onConnection('shared_redis');

        Queue::assertPushed(ProcessAccountingRemap::class, function ($job) {
            return $job->connection === 'shared_redis'
                && $job->businessId === 1
                && in_array('manufacturing_module', $job->enabledModules, true);
        });
    }

    public function test_controller_remap_all_locks_and_dispatches_job(): void
    {
        Queue::fake();
        \App\Utils\CoreSecurity::$verifiedModules[] = 'Accounting';

        $user = User::find(1);
        $this->actingAs($user);
        session(['user.business_id' => 1]);

        $moduleUtil = $this->createMock(\App\Utils\ModuleUtil::class);
        $moduleUtil->method('hasThePermissionInSubscription')->willReturn(true);
        $moduleUtil->method('isModuleInstalled')->willReturn(false);
        $moduleUtil->method('isModuleEnabled')->willReturn(false);

        \Illuminate\Support\Facades\Gate::define('accounting.map_transactions', function () {
            return true;
        });

        $controller = new \Modules\Accounting\Http\Controllers\TransactionController(
            $this->createMock(\App\Utils\TransactionUtil::class),
            $moduleUtil,
            $this->createMock(\Modules\Accounting\Utils\AccountingUtil::class),
            new AccountingRemapUtil()
        );

        $session = app('session')->driver();
        $session->put('user.business_id', 1);

        $request = \Illuminate\Http\Request::create('/accounting/transactions/remap-all', 'POST');
        $request->setLaravelSession($session);
        app()->instance('request', $request);

        $response = $controller->remapAll($request);

        $this->assertSame(200, $response->getStatusCode());
        $data = $response->getData(true);
        $this->assertSame(1, $data['success']);

        Queue::assertPushed(ProcessAccountingRemap::class, function ($job) {
            return $job->connection === 'shared_redis'
                && $job->businessId === 1;
        });

        // Second call while lock is active should return warning
        $secondResponse = $controller->remapAll($request);
        $secondData = $secondResponse->getData(true);
        $this->assertSame(0, $secondData['success']);
        $this->assertStringContainsString('already', $secondData['msg']);
    }

    public function test_controller_cancel_remap_all_cancels_stuck_notification_without_lock(): void
    {
        \App\Utils\CoreSecurity::$verifiedModules[] = 'Accounting';

        $notificationId = (string) Str::uuid();
        DB::table('notifications')->insert([
            'id' => $notificationId,
            'type' => AccountingRemapProgressNotification::class,
            'notifiable_type' => User::class,
            'notifiable_id' => 1,
            'data' => json_encode([
                'msg' => 'Transaction remapping queued...',
                'status' => 'pending',
                'percent' => 0,
                'business_id' => 1,
                'remap_type' => 'all',
                'start_time' => microtime(true) - 43200,
            ]),
            'created_at' => now()->subHours(12),
            'updated_at' => now()->subHours(12),
        ]);

        $user = User::find(1);
        $this->actingAs($user);
        session(['user.business_id' => 1]);

        $moduleUtil = $this->createMock(\App\Utils\ModuleUtil::class);
        $moduleUtil->method('hasThePermissionInSubscription')->willReturn(true);

        \Illuminate\Support\Facades\Gate::define('accounting.map_transactions', function () {
            return true;
        });

        $controller = new \Modules\Accounting\Http\Controllers\TransactionController(
            $this->createMock(\App\Utils\TransactionUtil::class),
            $moduleUtil,
            $this->createMock(\Modules\Accounting\Utils\AccountingUtil::class),
            new AccountingRemapUtil()
        );

        $session = app('session')->driver();
        $session->put('user.business_id', 1);

        $request = \Illuminate\Http\Request::create(
            '/accounting/transactions/remap-all/cancel',
            'POST',
            [],
            [],
            [],
            ['HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest']
        );
        $request->setLaravelSession($session);
        app()->instance('request', $request);

        $response = $controller->cancelRemapAll();
        $data = $response->getData(true);

        $this->assertSame(1, $data['success']);

        $notification = DB::table('notifications')->where('id', $notificationId)->first();
        $notificationData = json_decode($notification->data, true);
        $this->assertSame('cancelled', $notificationData['status']);
        $this->assertStringContainsString('cancelled', $notificationData['msg']);
    }
}
