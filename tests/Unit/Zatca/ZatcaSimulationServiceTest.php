<?php

namespace Tests\Unit\Zatca;

use Modules\ZATCA\Entities\ZatcaOnboarding;
use Modules\ZATCA\Services\ZatcaSimulationService;
use Tests\TestCase;

class ZatcaSimulationServiceTest extends TestCase
{
    public function testReadinessReportFlagsIncompleteSimulationOnboarding(): void
    {
        $onboarding = new ZatcaOnboarding([
            'business_id' => 1,
            'portal_mode' => 'simulation',
            'status' => 'onboarded',
            'organization_name' => 'Test Org',
            'vat_registration_number' => '300000000000003',
            'crn_number' => '1010101010',
        ]);

        $report = app(ZatcaSimulationService::class)->getReadinessReport($onboarding, 'compliance');

        $this->assertFalse($report['ready']);
        $this->assertContains('The onboarding private key is missing, so the app cannot sign a real simulation invoice.', $report['issues']);
        $this->assertContains('The compliance certificate is missing, so the app cannot authenticate against the simulation API.', $report['issues']);
    }

    public function testSmokeTestReturnsBlockedResultWhenPrerequisitesAreMissing(): void
    {
        $onboarding = new ZatcaOnboarding([
            'business_id' => 1,
            'portal_mode' => 'simulation',
            'status' => 'onboarded',
            'organization_name' => 'Test Org',
            'vat_registration_number' => '300000000000003',
            'crn_number' => '1010101010',
        ]);

        $result = app(ZatcaSimulationService::class)->runSmokeTest($onboarding, 'reporting');

        $this->assertFalse($result['success']);
        $this->assertSame('reporting', $result['mode']);
        $this->assertStringContainsString('blocked', strtolower($result['message']));
        $this->assertNotEmpty($result['issues']);
    }
}
