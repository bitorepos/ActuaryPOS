<?php

namespace Tests\Unit;

use App\ReferenceCount;
use App\Utils\Util;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use PHPUnit\Framework\TestCase;

class ReferenceCountFormatTest extends TestCase
{
    private $capsule;
    private $previousResolver;
    private $util;

    protected function setUp(): void
    {
        if (! class_exists('Carbon')) {
            class_alias(Carbon::class, 'Carbon');
        }
        $this->previousResolver = Model::getConnectionResolver();
        $this->capsule = new Capsule();
        $this->capsule->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        Model::setConnectionResolver($this->capsule->getDatabaseManager());
        $this->capsule->getConnection()->getSchemaBuilder()->create('reference_counts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref_type');
            $table->integer('business_id');
            $table->integer('location_id')->nullable();
            $table->integer('year')->nullable();
            $table->integer('ref_count');
            $table->timestamps();
        });
        $this->util = new class extends Util {
            public $format = 'year';

            protected function getReferenceNumberFormat($business_id = null, $location_id = null)
            {
                return $this->format;
            }
        };
    }

    protected function tearDown(): void
    {
        $this->capsule->getDatabaseManager()->disconnect();
        if ($this->previousResolver) {
            Model::setConnectionResolver($this->previousResolver);
        } else {
            Model::unsetConnectionResolver();
        }
    }

    public function testTogglingYearContinuesTheSequenceInBothDirections(): void
    {
        $this->assertSame(1, $this->util->setAndGetReferenceCount('expense', 1, 1));
        $this->util->format = 'blank';
        $this->assertSame(2, $this->util->setAndGetReferenceCount('expense', 1, 1));
        $this->util->format = 'year';
        $this->assertSame(3, $this->util->setAndGetReferenceCount('expense', 1, 1));
        $this->util->format = 'blank';
        $this->assertSame(4, $this->util->setAndGetReferenceCount('expense', 1, 1));
    }

    public function testExistingSplitCountersUseTheHighestCount(): void
    {
        $this->seedCount(8, (int) Carbon::now()->year);
        $this->seedCount(2, null);
        $this->util->format = 'blank';
        $this->assertSame(9, $this->util->setAndGetReferenceCount('expense', 1, 1));
        $this->util->format = 'year';
        $this->assertSame(10, $this->util->setAndGetReferenceCount('expense', 1, 1));
    }

    public function testCounterContinuityStaysWithinBusinessLocationAndType(): void
    {
        $this->seedCount(50, 2026);
        $this->util->format = 'blank';
        $this->assertSame(1, $this->util->setAndGetReferenceCount('expense', 2, 1));
        $this->assertSame(1, $this->util->setAndGetReferenceCount('expense', 1, 2));
        $this->assertSame(1, $this->util->setAndGetReferenceCount('expense_payment', 1, 1));
        $this->assertSame(51, $this->util->setAndGetReferenceCount('expense', 1, 1));
    }

    public function testAnnualScopeIsPreservedUntilYearlessNumbersAreUsed(): void
    {
        $this->seedCount(50, 2025);
        $this->assertSame(1, $this->util->setAndGetReferenceCount('expense', 1, 1, 2026));
        $this->assertSame(51, $this->util->setAndGetReferenceCount('expense', 1, 1, false));
        $this->assertSame(52, $this->util->setAndGetReferenceCount('expense', 1, 1, 2026));
    }

    public function testEntityCountersRemainGlobalPerBusiness(): void
    {
        $this->assertSame(1, $this->util->setAndGetReferenceCount('contacts', 1, 1));
        $this->util->format = 'blank';
        $this->assertSame(2, $this->util->setAndGetReferenceCount('contacts', 1, 2));
        $this->assertSame(1, $this->util->setAndGetReferenceCount('contacts', 2, 1));
    }

    private function seedCount(int $count, ?int $year): void
    {
        ReferenceCount::create([
            'ref_type' => 'expense', 'business_id' => 1, 'location_id' => 1,
            'year' => $year, 'ref_count' => $count,
        ]);
    }
}
