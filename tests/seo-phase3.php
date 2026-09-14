<?php

// Read-only integration check: php tests/seo-phase3.php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$check = static function ($condition, string $message): void {
    if (!$condition) {
        throw new RuntimeException($message);
    }
};
$docs = $app->make(App\Http\Controllers\DocumentationController::class);
$controller = $app->make(Modules\Cms\Http\Controllers\CommercialPageController::class);
$titles = $descriptions = $results = [];
$pages = App\Support\CommercialPages::all();
foreach (App\Support\CommercialPages::urls() as $path) {
    $request = Illuminate\Http\Request::create('https://retailmanerp.com/' . $path . '?utm_source=test');
    $app->instance('request', $request);
    $app['url']->setRequest($request);
    $route = $app['router']->getRoutes()->match($request);
    $check($route->getName() === 'cms.commercial', 'Wrong route: ' . $path);
    $request->setRouteResolver(fn () => $route);
    [$group, $slug] = array_pad(explode('/', $path), 2, null);
    $html = $controller->show($docs, $group, $slug)->render();
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $check($xpath->query('//h1')->length === 1, 'H1 count: ' . $path);
    $check($xpath->query('//title')->length === 1, 'Title count: ' . $path);
    $check($xpath->query('//meta[@name="description"]')->length === 1, 'Description count: ' . $path);
    $check($xpath->query('//link[@rel="canonical"]')->length === 1, 'Canonical count: ' . $path);
    $canonical = $xpath->query('//link[@rel="canonical"]')->item(0)->getAttribute('href');
    $check($canonical === 'https://retailmanerp.com/' . $path, 'Canonical mismatch: ' . $canonical);
    $title = $xpath->query('//title')->item(0)->textContent;
    $description = $xpath->query('//meta[@name="description"]')->item(0)->getAttribute('content');
    $check(!in_array($title, $titles), 'Duplicate title');
    $check(!in_array($description, $descriptions), 'Duplicate description');
    $titles[] = $title;
    $descriptions[] = $description;
    $scripts = $xpath->query('//script[@type="application/ld+json"]');
    $check($scripts->length === 1, 'Schema count: ' . $path);
    $schema = json_decode($scripts->item(0)->textContent, true, 512, JSON_THROW_ON_ERROR);
    $check($schema['@type'] === 'BreadcrumbList', 'Schema type');
    $check(count($schema['itemListElement']) === ($slug ? 3 : 2), 'Breadcrumb depth');
    $check(end($schema['itemListElement'])['item'] === $canonical, 'Breadcrumb canonical');
    foreach ($pages[$path]['related'] ?? [] as $related) {
        $check(isset($pages[$related]), 'Unknown related page: ' . $related);
        $check(str_contains($html, url($related)), 'Missing related link');
    }
    $results[$path] = ['rendered' => true, 'canonical' => $canonical, 'h1' => 1, 'schema' => 'valid'];
}
try {
    $controller->show($docs, 'features', 'not-a-real-feature');
    throw new RuntimeException('Unknown page did not 404');
} catch (Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {
    $check($e->getStatusCode() === 404, 'Unknown slug status');
}
$sitemap = $app->make(App\Http\Controllers\PublicSeoController::class)->sitemap($docs)->getContent();
foreach (App\Support\CommercialPages::urls() as $path) {
    $check(str_contains($sitemap, 'https://retailmanerp.com/' . $path . '</loc>'), 'Missing sitemap URL: ' . $path);
}
foreach (['sales-pos-guide', 'stock-management-guide', 'module-manufacturing', 'module-repair-guide'] as $slug) {
    $html = view('documentation.partials.commercial-links', compact('slug'))->render();
    $check(str_contains($html, '/features/'), 'Missing docs backlink: ' . $slug);
}
echo json_encode(['pages' => $results, 'sitemap' => 'passed', 'unknown_slug' => 404, 'documentation_links' => 'passed'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
