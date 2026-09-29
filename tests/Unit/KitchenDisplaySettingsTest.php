<?php

namespace Tests\Unit;

use App\Business;
use App\Utils\BusinessUtil;
use PHPUnit\Framework\TestCase;

class KitchenDisplaySettingsTest extends TestCase
{
    public function testKitchenButtonLabelHasAnEmptyDefaultAndIsLocationAware(): void
    {
        $settings = (new BusinessUtil())->defaultPosSettings();

        $this->assertArrayHasKey('kitchen_mark_as_cooked_label', $settings);
        $this->assertSame('', $settings['kitchen_mark_as_cooked_label']);
        $this->assertContains('kitchen_mark_as_cooked_label', Business::PER_LOCATION_POS_SETTINGS_KEYS);
    }

    public function testKitchenOrderViewsUseTheCustomLabelWithTheTranslationAsFallback(): void
    {
        foreach (['show_orders.blade.php', 'line_orders.blade.php'] as $view) {
            $contents = file_get_contents(
                dirname(__DIR__, 2) . '/resources/views/restaurant/partials/' . $view
            );

            $this->assertStringContainsString("pos_settings['kitchen_mark_as_cooked_label']", $contents);
            $this->assertStringContainsString("__('restaurant.mark_as_cooked')", $contents);
            $this->assertStringNotContainsString('@php(', $contents);
        }
    }

    public function testKitchenProductRowsContainALivePreparationCountdown(): void
    {
        $lineDetails = file_get_contents(
            dirname(__DIR__, 2) . '/resources/views/restaurant/partials/sale_line_details.blade.php'
        );
        $kitchenScreen = file_get_contents(
            dirname(__DIR__, 2) . '/resources/views/restaurant/kitchen/index.blade.php'
        );

        $this->assertStringContainsString('kitchen-prep-countdown', $lineDetails);
        $this->assertStringContainsString('data-initial-remaining', $lineDetails);
        $this->assertStringContainsString('updateKitchenPrepCountdowns', $kitchenScreen);
        $this->assertStringContainsString(".toggleClass('prep-time-overtime', remainingSeconds < 0)", $kitchenScreen);
    }

    public function testKitchenOptionsAreLocatedInTheKitchenDisplayTab(): void
    {
        $posSettings = file_get_contents(
            dirname(__DIR__, 2) . '/resources/views/business/partials/settings_pos.blade.php'
        );
        $kitchenSettings = file_get_contents(
            dirname(__DIR__, 2) . '/resources/views/business/partials/settings_kitchen_display.blade.php'
        );

        foreach (['show_order_details_kitchen', 'warn_prep_time_out'] as $setting) {
            $this->assertStringNotContainsString("pos_settings[$setting]", $posSettings);
            $this->assertStringContainsString("pos_settings[$setting]", $kitchenSettings);
        }
    }
}
