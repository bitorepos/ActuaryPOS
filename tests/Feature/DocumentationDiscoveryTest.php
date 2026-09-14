<?php

namespace Tests\Feature;

use App\Http\Controllers\DocumentationController;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class DocumentationDiscoveryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'seo_memory', 'database.connections.seo_memory' => [
            'driver' => 'sqlite', 'database' => ':memory:', 'prefix' => '',
        ]]);
        Schema::create('documentations', function (Blueprint $table) {
            $table->string('slug');
            $table->string('language');
            $table->string('visibility');
            $table->text('content');
        });
        DB::table('documentations')->insert([
            ['slug' => 'public-db', 'language' => 'en', 'visibility' => 'public', 'content' => '# Public guide'],
            ['slug' => 'private-db', 'language' => 'en', 'visibility' => 'private', 'content' => '# Private guide'],
        ]);
    }

    private function controller(): DocumentationController
    {
        return new class extends DocumentationController {
            protected function buildTabs(bool $isPublic = false): array
            {
                return ['guides' => ['items' => [
                    'public-db' => ['title' => 'Public DB guide', 'file' => '__missing__.md'],
                    'private-db' => ['title' => 'Private guide', 'file' => '__missing__.md'],
                    'missing' => ['title' => 'Missing', 'file' => '__missing__.md'],
                    'public-file' => ['title' => 'Sales guide', 'file' => 'SALES_POS_GUIDE.md'],
                ]]];
            }
            protected function resolveLanguage(Request $request): string { return 'en'; }
        };
    }

    public function testOnlyPublicExistingSourcesAreDiscoverable(): void
    {
        $tabs = $this->controller()->publicTabs('en');
        $this->assertSame(['public-db', 'public-file'], array_keys($tabs['guides']['items']));
        $this->assertSame(['public-db', 'public-file'], array_keys($this->controller()->publicTabs('ur')['guides']['items']));
    }

    public function testMissingRegisteredDocumentReturns404(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $this->controller()->publicDocs(Request::create('/docs/missing'), 'missing');
    }

    public function testPublicAjaxCannotOptIntoPrivateDiscovery(): void
    {
        $request = Request::create('/docs-fetch-page?slug=private-db&is_public=0');
        $route = new \Illuminate\Routing\Route('GET', 'docs-fetch-page', []);
        $route->name('docs.fetchPage');
        $request->setRouteResolver(fn () => $route);
        $this->expectException(NotFoundHttpException::class);
        $this->controller()->fetchPage($request);
    }

    public function testDefaultPublicLanguageAlsoResetsAjaxSessionLanguage(): void
    {
        $controller = new class extends DocumentationController {
            public function languageForTest(Request $request): string { return $this->resolveLanguage($request); }
        };
        $request = Request::create('/docs/sales-pos-guide');
        $route = new \Illuminate\Routing\Route('GET', 'docs/{slug?}', []);
        $route->name('docs.public');
        $request->setRouteResolver(fn () => $route);
        session(['docs_lang' => 'ur']);
        $this->assertSame('en', $controller->languageForTest($request));
        $this->assertSame('en', session('docs_lang'));
    }
}
