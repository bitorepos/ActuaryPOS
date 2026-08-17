<?php

namespace Tests\Unit\Zatca;

use Illuminate\Support\Carbon;
use Modules\ZATCA\Entities\ZatcaInvoice;
use Modules\ZATCA\Services\ZatcaSyncService;
use Tests\TestCase;

class ZatcaSyncServiceTest extends TestCase
{
    protected function makeService(): ZatcaSyncService
    {
        return new class extends ZatcaSyncService {
            public function __construct()
            {
            }

            public function classifyFailure(ZatcaInvoice $invoice, array $result): array
            {
                return $this->classifySubmissionFailure($invoice, $result);
            }

            public function nextCounterValue(int $currentCounter): int
            {
                return $this->nextInvoiceCounterValue($currentCounter);
            }
        };
    }

    public function testServerErrorsAreQueuedForRetry(): void
    {
        $invoice = new ZatcaInvoice(['submission_attempt_count' => 1]);

        $result = $this->makeService()->classifyFailure($invoice, [
            'http_status' => 503,
            'errors' => [['message' => 'Temporary upstream outage']],
        ]);

        $this->assertSame('retrying', $result['sync_status']);
        $this->assertTrue($result['retryable']);
        $this->assertSame('server', $result['category']);
        $this->assertInstanceOf(Carbon::class, $result['next_retry_at']);
    }

    public function testDuplicateResponsesAreMarkedAsTerminalDuplicates(): void
    {
        $invoice = new ZatcaInvoice(['submission_attempt_count' => 2]);

        $result = $this->makeService()->classifyFailure($invoice, [
            'http_status' => 409,
            'errors' => [['message' => 'Invoice already reported']],
        ]);

        $this->assertSame('failed', $result['sync_status']);
        $this->assertFalse($result['retryable']);
        $this->assertSame('duplicate', $result['category']);
        $this->assertNull($result['next_retry_at']);
    }

    public function testNetworkFailuresStopRetryingAfterMaxAttempts(): void
    {
        $invoice = new ZatcaInvoice(['submission_attempt_count' => 5]);

        $result = $this->makeService()->classifyFailure($invoice, [
            'http_status' => 0,
            'errors' => [['message' => 'Connection timed out']],
        ]);

        $this->assertSame('failed', $result['sync_status']);
        $this->assertFalse($result['retryable']);
        $this->assertSame('network', $result['category']);
        $this->assertTrue($result['exhausted']);
        $this->assertNull($result['next_retry_at']);
    }

    public function testInvoiceCounterStartsAtOneAndThenIncrementsSequentially(): void
    {
        $service = $this->makeService();

        $this->assertSame(1, $service->nextCounterValue(0));
        $this->assertSame(1, $service->nextCounterValue(-5));
        $this->assertSame(43, $service->nextCounterValue(42));
    }
}
