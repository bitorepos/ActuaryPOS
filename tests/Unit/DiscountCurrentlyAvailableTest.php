<?php

namespace Tests\Unit;

use App\Discount;
use Tests\TestCase;

class DiscountCurrentlyAvailableTest extends TestCase
{
    public function testDiscountAvailabilityUsesDailyTimeWindowInsideDateRange(): void
    {
        $query = Discount::query()->currentlyAvailable('2026-08-14', '20:57:00', 'Friday');

        $sql = $query->toSql();
        $bindings = $query->getBindings();

        $this->assertStringContainsString('date(`discounts`.`starts_at`) <= ?', $sql);
        $this->assertStringContainsString('date(`discounts`.`ends_at`) >= ?', $sql);
        $this->assertStringContainsString('`discounts`.`starts_at_time` <= `discounts`.`ends_at_time`', $sql);
        $this->assertStringContainsString('`discounts`.`starts_at_time` <= ?', $sql);
        $this->assertStringContainsString('`discounts`.`ends_at_time` >= ?', $sql);
        $this->assertContains('2026-08-14', $bindings);
        $this->assertContains('20:57:00', $bindings);
        $this->assertContains('"Friday"', $bindings);
    }
}
