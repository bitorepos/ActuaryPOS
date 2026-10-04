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

    public function test_unlink_permission_error_is_reported_as_a_local_checkout_problem(): void
    {
        $message = $this->syncFailureMessage(
            new \RuntimeException("error: unable to unlink old 'artisan': Permission denied")
        );

        $this->assertStringContainsString('cannot update files in this checkout', $message);
        $this->assertStringContainsString('modify and delete application files', $message);
        $this->assertStringNotContainsString('GitHub access was denied', $message);
    }

    public function test_github_access_error_is_still_reported_as_an_authentication_problem(): void
    {
        $message = $this->syncFailureMessage(
            new \RuntimeException('remote: Permission denied to repository')
        );

        $this->assertStringContainsString('GitHub access was denied', $message);
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

    private function syncFailureMessage(\Throwable $exception): string
    {
        $method = new ReflectionMethod(SoftwareSyncController::class, 'syncFailureMessage');
        $method->setAccessible(true);

        return $method->invoke(new SoftwareSyncController(), $exception);
    }
}
