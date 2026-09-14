<?php

namespace Tests\Unit;

use App\Support\PublicDocumentation;
use PHPUnit\Framework\TestCase;

class PublicDocumentationTest extends TestCase
{
    public function testMarkdownHasHeadingsLinksAndTablesWithoutJavascript(): void
    {
        $html = PublicDocumentation::render("# Sales guide\n\nRecord a sale.\n\n## Stock\n\n[Inventory](/docs/stock-management-guide)\n\n| Product | Stock |\n| --- | --- |\n| Shirt | 4 |");

        $this->assertStringStartsWith('<!--RAWHTML-->', $html);
        $this->assertStringContainsString('<h1>Sales guide</h1>', $html);
        $this->assertStringContainsString('<h2>Stock</h2>', $html);
        $this->assertStringContainsString('href="/docs/stock-management-guide"', $html);
        $this->assertStringContainsString('<table>', $html);
    }

    public function testGeneratedHtmlIsPreservedAndUnsafeMarkdownLinksAreRejected(): void
    {
        $html = '<!--RAWHTML--><h1>Contact</h1><form><input name="message"></form>';
        $this->assertSame($html, PublicDocumentation::render($html));
        $this->assertStringNotContainsString('href="javascript:', PublicDocumentation::render('[Bad](javascript:alert%281%29)'));
    }

    public function testDescriptionUsesArticleTextRatherThanHeadings(): void
    {
        $this->assertSame('Track stock & purchases. Review sales.', PublicDocumentation::description('<h1>Guide</h1><p>Track stock &amp; purchases.</p><h2>Reports</h2><p>Review sales.</p>'));
        $this->assertLessThanOrEqual(160, mb_strlen(PublicDocumentation::description(str_repeat('Inventory records. ', 30))));
    }

    public function testTitleFillsMissingH1WithoutDuplicatingExistingHeading(): void
    {
        $html = PublicDocumentation::render('## Release notes', 'Changes & Updates');
        $this->assertStringContainsString('<h1>Changes &amp; Updates</h1>', $html);
        $this->assertSame(1, substr_count(PublicDocumentation::render('# Sales', 'Guide'), '<h1>'));
    }
}
