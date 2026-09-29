<?php

namespace Tests\Unit;

use App\Support\CommercialPages;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class CommercialPagesTest extends TestCase
{
    public function testInvalidCommercialPagesJsonDoesNotThrow(): void
    {
        $originalBasePath = base_path();
        $basePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'commercial-pages-test-' . uniqid();
        $contentPath = $basePath . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Cms'
            . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . 'content';

        mkdir($contentPath, 0777, true);
        file_put_contents($contentPath . DIRECTORY_SEPARATOR . 'landing-pages.json', '{"features/pos":');

        Log::shouldReceive('error')->times(4);

        try {
            app()->setBasePath($basePath);

            $this->assertSame([], CommercialPages::all());
            $this->assertSame([], CommercialPages::forDocumentation('sales-pos-guide'));
            $this->assertSame([], CommercialPages::group('features'));
            $this->assertSame([], CommercialPages::group('industries'));
        } finally {
            app()->setBasePath($originalBasePath);
            @unlink($contentPath . DIRECTORY_SEPARATOR . 'landing-pages.json');
            @rmdir($contentPath);
            @rmdir(dirname($contentPath));
            @rmdir(dirname(dirname($contentPath)));
            @rmdir(dirname(dirname(dirname($contentPath))));
            @rmdir($basePath);
        }
    }
}
