<?php

namespace Tests\Feature;

use App\Http\Controllers\DocumentationController;
use App\Utils\CoreSecurity;
use Illuminate\Http\Request;
use Modules\Cms\Entities\CmsPage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class PublicSeoMetadataTest extends TestCase
{
    private array $originalVerifiedModules = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->originalVerifiedModules = CoreSecurity::$verifiedModules;
        config(['app.name' => 'RetailMan ERP System']);
        $request = Request::create('https://retailmanerp.com/');
        $this->app->instance('request', $request);
        $this->app['url']->setRequest($request);
    }

    protected function tearDown(): void
    {
        CoreSecurity::$verifiedModules = $this->originalVerifiedModules;
        parent::tearDown();
    }

    public function testHomeHasOneDescriptionAndHonestSoftwareSchema(): void
    {
        $html = view('cms::frontend.layouts.seo', ['page' => new CmsPage()])->render();
        $this->assertStringContainsString('RetailMan ERP System - POS &amp; ERP Software for Retail', $html);
        $this->assertSame(1, substr_count($html, 'name="description"'));
        preg_match('/name="description" content="([^"]*)"/', $html, $description);
        $this->assertSame(155, mb_strlen(html_entity_decode($description[1])));
        preg_match('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $match);
        $schema = json_decode($match[1], true, 512, JSON_THROW_ON_ERROR);
        $this->assertSame('SoftwareApplication', $schema['@graph'][2]['@type']);
        $this->assertArrayNotHasKey('aggregateRating', $schema['@graph'][2]);
        $this->assertArrayNotHasKey('offers', $schema['@graph'][2]);
    }

    public function testOwnerMetadataAndCanonicalRemainAuthoritative(): void
    {
        $page = new CmsPage(['seo_title' => 'Custom title', 'meta_description' => 'Owner description.', 'canonical_url' => 'https://retailmanerp.com/custom']);
        $html = view('cms::frontend.layouts.seo', compact('page'))->render();
        $this->assertStringContainsString('<title>Custom title</title>', $html);
        $this->assertStringContainsString('content="Owner description."', $html);
        $this->assertStringContainsString('rel="canonical" href="https://retailmanerp.com/custom"', $html);
    }

    public function testSchemaTextCannotCloseTheScriptElement(): void
    {
        config(['app.name' => '</script><script>alert(1)</script>']);
        $html = view('cms::frontend.layouts.seo', ['page' => new CmsPage()])->render();
        $this->assertSame(1, substr_count($html, '</script>'));
        $this->assertStringNotContainsString('<script>alert(1)', $html);
    }

    public function testBlogListingDoesNotInheritTheLastArticleMetadata(): void
    {
        $request = Request::create('https://retailmanerp.com/c/blogs');
        $this->app->instance('request', $request);
        $this->app['url']->setRequest($request);
        $blog = new CmsPage(['seo_title' => 'Last article title', 'meta_description' => 'Last article description.']);
        $html = view('cms::frontend.layouts.seo', ['blog' => $blog, 'blogs' => collect([$blog])])->render();
        $this->assertStringNotContainsString('Last article', $html);
        $this->assertStringContainsString('rel="canonical" href="https://retailmanerp.com/c/blogs"', $html);
        $this->assertStringContainsString('property="og:type" content="website"', $html);
    }

    public function testUnknownPublicDocumentationIsAReal404(): void
    {
        $controller = new class extends DocumentationController {
            protected function resolveLanguage(Request $request): string { return 'en'; }
            public function publicTabs(string $lang = 'en'): array { return []; }
        };
        $this->expectException(NotFoundHttpException::class);
        $controller->publicDocs(Request::create('/docs/missing'), 'missing');
    }

    public function testPublicSearchUsesOnlyThePublicNavigation(): void
    {
        $controller = new class extends DocumentationController {
            public bool $publicTabs = false;
            protected function resolveLanguage(Request $request): string { return 'en'; }
            public function publicTabs(string $lang = 'en'): array { $this->publicTabs = true; return []; }
            protected function searchDocs(string $query, array $tabs, string $lang = 'en'): array { return []; }
        };
        $request = Request::create('/docs-search?q=contact');
        $route = new \Illuminate\Routing\Route('GET', 'docs-search', []);
        $route->name('docs.search');
        $request->setRouteResolver(fn () => $route);
        $controller->search($request);
        $this->assertTrue($controller->publicTabs);
    }

    public function testMissingSocialImageIsNotAdvertised(): void
    {
        $page = new CmsPage(['og_image' => 'phase2-image-does-not-exist.png']);
        $html = view('cms::frontend.layouts.seo', compact('page'))->render();
        $this->assertStringNotContainsString('property="og:image"', $html);
        $this->assertStringContainsString('name="twitter:card" content="summary"', $html);
    }

    public function testLlmsTxtExposesAgentReadablePublicEntryPoints(): void
    {
        CoreSecurity::$verifiedModules = array_values(array_unique(array_merge(CoreSecurity::$verifiedModules, ['Cms'])));

        $response = $this->get('/llms.txt');

        $response->assertOk();
        $response->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
        $response->assertSee('# RetailMan ERP System', false);
        $response->assertSee('- [Home](https://retailmanerp.com)', false);
        $response->assertSee('- [Contact](https://retailmanerp.com/c/contact-us)', false);
        $response->assertSee('## Agent Guidance', false);
    }
}
