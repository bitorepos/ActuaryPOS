<?php

namespace Tests\Unit;

use App\Utils\BusinessFeatureSettingsUtil;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class BusinessFeatureSettingsUtilTest extends TestCase
{
    private $previousApplication;
    private $database;

    protected function setUp(): void
    {
        parent::setUp();
        $this->previousApplication = Facade::getFacadeApplication();
        $this->database = new Capsule();
        $this->database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $container = $this->database->getContainer();
        $container->instance('db', $this->database->getDatabaseManager());
        $container->bind('db.schema', function () {
            return DB::connection()->getSchemaBuilder();
        });
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($container);
        DB::connection()->getSchemaBuilder()->create('business', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->text('common_settings')->nullable();
        });
    }

    protected function tearDown(): void
    {
        $this->database->getDatabaseManager()->disconnect();
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->previousApplication);
        parent::tearDown();
    }

    private function insertBusiness(int $id, array $settings): void
    {
        DB::table('business')->insert(['id' => $id, 'common_settings' => json_encode($settings)]);
    }

    private function settings(int $id): array
    {
        return json_decode(DB::table('business')->where('id', $id)->value('common_settings'), true);
    }

    public function testRepeatedUpdatesPreserveEachBusinessAndAllowOtherSettingsToChange(): void
    {
        $this->insertBusiness(62, ['hidden_features' => ['pos', 'reports'], 'existing' => 1]);
        $this->insertBusiness(63, ['hidden_features' => []]);
        $this->insertBusiness(64, ['hidden_features' => ['purchases']]);
        $this->insertBusiness(65, []);

        for ($version = 1; $version <= 2; $version++) {
            $result = (new BusinessFeatureSettingsUtil())->preserveDuring(function () use ($version) {
                DB::table('business')->update(['common_settings' => json_encode(['version' => $version])]);

                return 'updated';
            });

            $this->assertSame('updated', $result);
            $this->assertSame(['version' => $version, 'hidden_features' => ['pos', 'reports']], $this->settings(62));
            $this->assertSame(['version' => $version, 'hidden_features' => []], $this->settings(63));
            $this->assertSame(['version' => $version, 'hidden_features' => ['purchases']], $this->settings(64));
            $this->assertSame(['version' => $version], $this->settings(65));
        }
    }

    public function testFailedUpdateStillPreservesSelections(): void
    {
        $this->insertBusiness(62, ['hidden_features' => ['reports']]);
        try {
            (new BusinessFeatureSettingsUtil())->preserveDuring(function () {
                DB::table('business')->update(['common_settings' => null]);
                throw new RuntimeException('Update failed');
            });
            $this->fail('Expected the update error to propagate.');
        } catch (RuntimeException $exception) {
            $this->assertSame('Update failed', $exception->getMessage());
        }

        $this->assertSame(['hidden_features' => ['reports']], $this->settings(62));
    }

    public function testDeletedBusinessesAreNotRecreatedAndNewBusinessesKeepTheirSettings(): void
    {
        $this->insertBusiness(62, ['hidden_features' => ['reports']]);
        (new BusinessFeatureSettingsUtil())->preserveDuring(function () {
            DB::table('business')->where('id', 62)->delete();
            $this->insertBusiness(63, ['hidden_features' => ['pos']]);
        });

        $this->assertFalse(DB::table('business')->where('id', 62)->exists());
        $this->assertSame(['hidden_features' => ['pos']], $this->settings(63));
    }
}
