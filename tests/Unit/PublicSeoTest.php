<?php

namespace Tests\Unit;

use App\Support\PublicSeo;
use PHPUnit\Framework\TestCase;

class PublicSeoTest extends TestCase
{
    public function testRetailmanCanonicalPreservesPageAndLanguage(): void
    {
        $this->assertSame('https://retailmanerp.com/pricing', PublicSeo::canonical('http://www.retailmanerp.com/pricing'));
        $this->assertSame('https://retailmanerp.com/docs/sales-pos-guide?lang=ur', PublicSeo::canonical('http://retailmanerp.com/docs/sales-pos-guide?lang=ur'));
        $this->assertSame('http://localhost:8765/pricing', PublicSeo::canonical('http://localhost:8765/pricing'));
        $this->assertSame('https://tenant.example/pricing', PublicSeo::canonical('https://tenant.example/pricing'));
    }

    public function testSupplementalHeadKeepsIntegrationsAndRobotsButRemovesConflicts(): void
    {
        $script = '<script>window.sample = "<meta name=description content=example>";</script>';
        $html = '<title>Old title</title><meta NAME="description" content="Old description"><link rel="canonical" href="/wrong">'
            . '<meta property="og:title" content="Old social title"><meta name="twitter:card" content="summary">'
            . '<meta name="google-site-verification" content="keep-me"><meta name="robots" content="noindex, follow">'
            . '<link rel="preconnect" href="https://fonts.googleapis.com">' . $script;
        $result = PublicSeo::supplementalHead($html);
        $this->assertStringNotContainsString('Old title', $result);
        $this->assertStringNotContainsString('Old description', $result);
        $this->assertStringNotContainsString('rel="canonical"', $result);
        $this->assertStringNotContainsString('Old social title', $result);
        $this->assertStringNotContainsString('name="twitter:card"', $result);
        $this->assertStringContainsString('content="keep-me"', $result);
        $this->assertStringContainsString('content="noindex, follow"', $result);
        $this->assertStringContainsString('rel="preconnect"', $result);
        $this->assertStringContainsString($script, $result);
    }

    public function testNoindexIsDetectedWithoutTreatingScriptStringsAsTags(): void
    {
        $this->assertTrue(PublicSeo::hasNoindex('<meta name="robots" content="noindex, follow">'));
        $this->assertTrue(PublicSeo::hasNoindex('<meta name="googlebot" content="none">'));
        $this->assertFalse(PublicSeo::hasNoindex('<meta name="robots" content="index, follow">'));
        $this->assertFalse(PublicSeo::hasNoindex('<script>var example = "<meta name=robots content=noindex>";</script>'));
    }
}
