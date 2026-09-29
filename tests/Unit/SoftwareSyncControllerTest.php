<?php

namespace Tests\Unit;

use App\Http\Controllers\SoftwareSyncController;
use ReflectionMethod;
use Tests\TestCase;

class SoftwareSyncControllerTest extends TestCase
{
    public function test_clean_github_url_uses_anonymous_fetch_before_configured_token(): void
    {
        config(['constants.software_sync_auth_mode' => 'token']);

        $this->assertTrue($this->shouldFetchAnonymouslyFirst(
            'https://github.com/bitorepos/BitorePOS502.git'
        ));
    }

    public function test_public_mode_does_not_retry_as_token_fallback(): void
    {
        config(['constants.software_sync_auth_mode' => 'public']);

        $this->assertFalse($this->shouldFetchAnonymouslyFirst(
            'https://github.com/bitorepos/BitorePOS502.git'
        ));
    }

    public function test_non_github_repository_does_not_retry_without_token(): void
    {
        config(['constants.software_sync_auth_mode' => 'token']);

        $this->assertFalse($this->shouldFetchAnonymouslyFirst(
            'https://git.example.com/bitorepos/BitorePOS502.git'
        ));
    }

    private function shouldFetchAnonymouslyFirst(string $repositoryUrl): bool
    {
        $method = new ReflectionMethod(SoftwareSyncController::class, 'shouldFetchAnonymouslyFirst');
        $method->setAccessible(true);

        return $method->invoke(
            new SoftwareSyncController(),
            $repositoryUrl
        );
    }
}
