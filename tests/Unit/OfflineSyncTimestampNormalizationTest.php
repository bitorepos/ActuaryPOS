<?php

namespace Tests\Unit;

use App\Http\Controllers\OfflineSyncController;
use ReflectionClass;
use ReflectionMethod;
use Tests\TestCase;

class OfflineSyncTimestampNormalizationTest extends TestCase
{
    public function test_it_normalizes_nested_cloud_timestamps_for_eloquent(): void
    {
        $payload = [
            'id' => 10,
            'created_at' => '2026-09-24T18:15:12.000000Z',
            'updated_at' => '2026-09-24T18:16:13+00:00',
            'product_variations' => [[
                'id' => 20,
                'updated_at' => '2026-09-24T18:17:14.123456Z',
                'variations' => [[
                    'id' => 30,
                    'deleted_at' => null,
                    'created_at' => '2026-09-24 18:18:15',
                ]],
            ]],
        ];

        $normalized = $this->normalize($payload);

        $this->assertSame('2026-09-24 18:15:12', $normalized['created_at']);
        $this->assertSame('2026-09-24 18:16:13', $normalized['updated_at']);
        $this->assertSame('2026-09-24 18:17:14', $normalized['product_variations'][0]['updated_at']);
        $this->assertSame('2026-09-24 18:18:15', $normalized['product_variations'][0]['variations'][0]['created_at']);
        $this->assertNull($normalized['product_variations'][0]['variations'][0]['deleted_at']);
    }

    public function test_it_omits_an_invalid_timestamp_without_changing_other_values(): void
    {
        $normalized = $this->normalize([
            'id' => 10,
            'name' => 'Test product',
            'updated_at' => 'not-a-date',
        ]);

        $this->assertSame(10, $normalized['id']);
        $this->assertSame('Test product', $normalized['name']);
        $this->assertArrayNotHasKey('updated_at', $normalized);
    }

    private function normalize(array $payload): array
    {
        $reflection = new ReflectionClass(OfflineSyncController::class);
        $controller = $reflection->newInstanceWithoutConstructor();
        $method = new ReflectionMethod(OfflineSyncController::class, 'normalizeCloudTimestamps');
        $method->setAccessible(true);

        return $method->invoke($controller, $payload);
    }
}
