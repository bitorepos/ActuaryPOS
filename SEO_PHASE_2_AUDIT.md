# SEO Phase 2 audit

2026-09-09. Current code is authoritative. The previous phase is retained. Read-only localhost inventory: `SEO_PHASE_2_INVENTORY.json` (53 registered public docs, 5 published CMS records, no custom global meta tags). This is not access to the production database. No content seeder or migration will run.

| Priority | Current state | Recommended state | File/component | Action taken / planned | Owner confirmation |
|---|---|---|---|---|---|
| GOOD | Homepage defaults to `{brand} - POS & ERP Software for Retail`; RetailMan description is 155 characters; H1 names POS/ERP for retail/growing businesses. | Preserve useful positioning, custom overrides and slogan. | CMS SEO partial, home_header, marketing seeder | KEEP; no another homepage rewrite. | None |
| GOOD | H2 sections cover operations/modules; feature cards use H3; FAQ questions now use H3. | Retain semantics and style classes. | CMS homepage partials | KEEP. | Custom DB body HTML can add headings and still needs editorial review. |
| IMPORTANT | Raw global meta HTML and optional child meta section can conflict with generated title/description/canonical/social tags. | One authoritative standard SEO source; preserve verification tags, robots and integration scripts. | CMS layout; new PublicSeo helper | Filter only managed SEO tags from supplemental head fragments. | None for duplicate correction |
| IMPORTANT | Canonicals use current request origin; retailman www/http aliases can produce different identities. | Normalize RetailMan canonicals to https://retailmanerp.com; preserve other tenants/local URLs and owner external canonicals. | Shared/CMS SEO output, docs | Targeted origin normalization; audit actual HTTP redirect behavior separately. | Production server/proxy redirect changes if not already configured |
| GOOD | OG/Twitter metadata and Organization/WebSite/SoftwareApplication/BreadcrumbList exist without fabricated ratings/offers. | Retain; validate output. | Shared SEO partial | KEEP types; normalize matching URLs. | No FAQ or rating schema added |
| IMPORTANT | OG accessor emits upload URLs even if the file no longer exists. | Omit missing social images; fall back to an existing feature image. | CmsPage accessor | Check local asset existence without renaming branding assets. | Replacing missing originals requires owner asset |
| CRITICAL | Registered `module-foodpanda-overview` points to missing public FOODPANDA_INDEX.md. Only an internal dev copy exists. | Exclude unavailable docs from public navigation/search/sitemap; return real 404. | DocumentationController public registry/load paths | Filter unavailable public sources; never publish cp-docs/dev. | A public replacement article, if desired |
| GOOD | Unknown /docs slugs already return 404. `currency-review` is only in a legacy unused registry; deployment-checklist is not public. | Verify explicit URLs remain 404, without blanket redirects. | DocumentationController | Test both known examples and intentional missing route. | No equivalent public replacement found |
| IMPORTANT | AJAX fetch/language paths can return 200 with missing-page content; public mode relies on client flag. | Public routes must use public scope and proper 404s; retain authenticated behavior. | DocumentationController | Enforce route public scope and valid-source checks. | None |
| IMPORTANT | Public docs default language may come from session; English canonicals have ?lang=en. | Deterministic default English URL; non-English selections retain language query. English sitemap URLs have no query. | Docs language resolution, canonical and navigation scripts | Normalize English identity while retaining translations/URLs. | Full multilingual/hreflang architecture is Phase 3 |
| IMPORTANT | No sitemap route or XML file. | Dynamically include enabled marketing routes, published self-canonical CMS pages/blogs and available public English docs; no private/query/404/empty-blog URLs. | Public SEO controller/routes and CMS publication scopes | Add modest dynamic sitemap; omit lastmod because view counts also update timestamps. | No fabricated dates or proposed feature/industry URLs |
| IMPORTANT | robots.txt allows everything and has no sitemap reference; repository serves multiple hosts. | Keep public content/assets crawlable; disallow explicit admin/docs-API paths; reference current host's sitemap when available. | robots response and routes | Preserve /robots.txt URL with tenant-aware output. | Authentication remains the protection for private content |
| CRITICAL | Local CMS still stores 10,000+ businesses, 2M+ predictions, 40+ AI capabilities, 99.9% SLA; FAQs include 15–30% gains, 50+ languages and unverified privacy/trial claims. | Evidence required; no invented replacements. | cms_site_details and cms_pages (inventory) | Record NEEDS OWNER CONFIRMATION; no automatic business-data edits. Revised source seeder does not validate old stored claims. | Verified customer counts, event counts, SLA contract, feature inventory, measured results, language coverage, privacy policy and commercial terms |
| CRITICAL | David Parr, Tim Johnson and Krishna Watt quotes lack source/consent/company evidence; Krishna quote reports 23% growth. No uploaded customer images; UI generates initial avatars and always draws five stars. | Verify identity, quote, consent, measured result and rating; no fictional replacement. | Published testimonials; testimonial partial | AUDIT ONLY as requested; do not modify testimonials/ratings. | All three quotes and all five-star displays; generated initials are not customer photos |
| IMPROVEMENT | CMS guide encourages impressive example counts; several English subscription/coupon labels misspell successfully. | Evidence-based admin instructions and corrected visible labels; retain legacy identifiers. | CMS_GUIDE.md, Superadmin English labels | Small copy corrections. | None |
| GOOD | No current public source occurrences of Compelte/Ai assistence. `subcription`/`andriod` remain as internal keys/parameters. | Do not rename API/storage keys for spelling. | Routes/translations/settings | KEEP identifiers; inspect rendered copy. | DB-only copy may differ |
| IMPORTANT | No dedicated published feature/industry pages found in local CMS or dedicated routes. | Plan distinct useful pages; do not manufacture URLs/content. | SEO_FEATURE_PAGE_PLAN.md; SEO_INDUSTRY_PAGE_PLAN.md | Write plans only. | All proposed new pages |
| IMPROVEMENT | tua-body-scroll-lock is loaded twice (head and footer); several Bootstrap/Popper versions coexist. | Remove the exact duplicate head include; defer risky dependency consolidation. | CMS layout | One duplicate removed; existing footer ordering preserved. | Broader JS dependency work |
| IMPROVEMENT | home.png ~399 KB; contact.jpg ~242 KB; feature fallback ~38 KB. CSS hero images are decorative; public img tags already have alt. | Keep assets; recommend format/resolution audit, dimensions and field CWV measurement. | public/modules/cms/img and CMS templates | No invented alt text or uninspected image changes. | Asset optimization and field performance baseline |
| GOOD | Docs initial HTML renders headings/tables/links; navigation and descriptive guide links exist. | Retain; audit every current public slug and discovered internal docs URL. | PublicDocumentation, docs views | Local crawl and link checks, not search-cache assumptions. | No private developer docs restored |

## Source references

Sitemap URLs should reflect canonical pages; accurate lastmod is optional and is omitted here. See [Google sitemap guidance](https://developers.google.com/search/docs/crawling-indexing/sitemaps/build-sitemap). Canonical annotations and redirects need consistent targets; see [Google canonical guidance](https://developers.google.com/search/docs/crawling-indexing/consolidate-duplicate-urls).

## Verification and final actions

The targeted code actions above are complete locally. KEEP and owner-confirmation items remain unchanged. Production deployment, large content rewrites and Phase 3 are not included.

| Priority | Additional finding | Action taken | Remaining action |
|---|---|---|---|
| CRITICAL | Live HTTP apex redirects to HTTPS apex; HTTP www redirects to HTTPS www, whose certificate fails hostname validation. | Normalized RetailMan canonical/schema URLs in application output. No server changes. | Hosting owner must provision a valid www certificate, then redirect www to https://retailmanerp.com while preserving path/query. TLS must succeed before an HTTPS redirect can be served. |
| IMPORTANT | Version-history source starts at H2 and rendered with no primary H1. | Public documentation renderer adds the registered title only when rendered content has no H1; initial and AJAX output agree. | None |
| GOOD | Forecasting code uses a 90-day sales window. | Verified against AiBusinessIntelligenceController.php:323-331; recorded separately from unsupported outcome claims. | No accuracy or revenue guarantee inferred. |

## SEO Phase 2 Completed

Preserved the established homepage title, description, primary heading, layout and product positioning. Implemented metadata deduplication, canonical normalization, dynamic discovery files, public documentation source filtering and real 404 responses, a missing documentation H1, social-image validation and small copy/script corrections.

Validation completed:

- Production build passed with Laravel Mix/webpack after installing locked dependencies using `npm ci --ignore-scripts --no-audit --no-fund`. Existing dependency deprecation notices remain; no package/lock upgrades. Unrelated generated bundle changes were restored.
- Relevant PHPUnit suites passed: 18 tests, 53 assertions, covering metadata, rendering, public/private documentation discovery, missing sources and default-language behavior. Database tests use in-memory SQLite.
- Local crawl recorded 67 route checks in `SEO_PHASE_2_ROUTES.json`. All 55 unique sitemap URLs returned HTTP 200 and matched their canonical URL. Sitemap contains no query variants or fabricated lastmod dates.
- Homepage, contact, pricing and available public documentation rendered one title, description and H1. Generated JSON-LD parsed successfully. Inspected image tags had alt attributes; this is not a claim that every uploaded image has editorially ideal alt text.
- Missing deployment-checklist, currency-review, unavailable Foodpanda overview and intentional missing documentation return actual 404 responses, including the public fetch endpoint. Proposed feature/industry route samples remain 404 because no pages were created.
- Discovered same-origin documentation links were checked. Source strings pointing to third-party library documentation were distinguished from local routes.
- English clean-URL navigation resets a previous translated session; public AJAX fetch and Urdu language switching return rendered content. Rendered inline JavaScript passed `node --check`.
- Changed Blade templates compiled and passed PHP syntax validation; modified PHP and whitespace checks passed.

These are local application, automated-test and read-only live redirect checks. No production database update, deployment, payment, contact submission or full ERP transaction regression test was performed.

## Files Changed

| File | Why |
|---|---|
| app/Support/PublicSeo.php | Centralize RetailMan-origin normalization and safe supplemental metadata filtering/noindex detection. |
| app/Http/Controllers/PublicSeoController.php | Generate tenant-aware robots and canonical, published, available-page sitemap responses. |
| routes/web.php | Register the two discovery endpoints. |
| public/robots.txt (deleted) | Let the dynamic response serve the same URL; deployment must include this deletion so the static file does not mask Laravel. |
| app/Http/Controllers/DocumentationController.php | Filter unavailable/private public sources, enforce public route scope and 404s, stabilize default language and align rendered AJAX/initial content. |
| app/Support/PublicDocumentation.php | Add the registered page heading only when public content lacks an H1. |
| resources/views/documentation/partials/scripts.blade.php | Align AJAX canonical URLs with server language and RetailMan-origin rules. |
| resources/views/layouts/partials/seo.blade.php | Normalize shared canonical metadata. |
| modules/Cms/Resources/views/frontend/layouts/seo.blade.php | Align CMS canonical/schema identity with actual page routes. |
| modules/Cms/Resources/views/frontend/layouts/app.blade.php | Prevent supplemental metadata conflicts and remove one duplicate body-scroll-lock include. |
| modules/Cms/Entities/CmsPage.php | Avoid publishing missing local social-image URLs; use a valid fallback when available. |
| cp-docs/en/CMS_GUIDE.md | Require evidence and reporting periods for statistics instead of encouraging impressive sample counts. |
| modules/Superadmin/Resources/lang/en/lang.php | Correct visible subscription/coupon success-message spelling while preserving identifiers. |
| tests/Unit/PublicSeoTest.php | Verify origin normalization, duplicate filtering, script preservation and noindex parsing. |
| tests/Unit/PublicDocumentationTest.php | Verify heading fallback without duplicate H1 output. |
| tests/Feature/PublicSeoMetadataTest.php | Verify metadata and missing-image output; align documentation stubs. |
| tests/Feature/DocumentationDiscoveryTest.php | Verify source visibility, real 404s, public AJAX scope and language reset. |
| SEO_PHASE_2_AUDIT.md | Record the initial audit, implementation decisions and final validation. |
| SEO_PHASE_2_CLAIMS.md | Record quantitative claims, testimonial evidence gaps and the verified forecast input window. |
| SEO_PHASE_2_INVENTORY.json | Preserve read-only local CMS/public registry evidence, without credentials. |
| SEO_PHASE_2_ROUTES.json | Preserve local route, canonical, heading and discovery validation results. |
| SEO_FEATURE_PAGE_PLAN.md | Plan 15 feature pages with search intent, metadata, content and links; no pages created. |
| SEO_INDUSTRY_PAGE_PLAN.md | Plan 12 industry candidates with workflow evidence requirements; no pages created. |

The separate working-tree modification to `config/author.php` belongs to the user and was left untouched.

## Technical SEO Fixes

One effective generated title/description/canonical/social source now takes precedence over duplicate supplemental tags. Existing valid schema types remain, with consistent RetailMan URLs and no invented ratings. Sitemap and robots use the current tenant origin while normalizing RetailMan to HTTPS apex. Public docs navigation, search and sitemap omit unavailable sources; missing public resources return 404. Canonical defaults now consistently identify English content; translated selections retain their language query. Existing valid public routes and descriptive links are preserved.

## Content SEO Fixes

Added the missing version-history primary heading without rewriting its content. Corrected visible success-message spelling and made the CMS statistics guide evidence-based. Kept the useful homepage POS/ERP title, approximately 155-character RetailMan description, H1 and H2/H3 structure. No fabricated factual, testimonial or AI-search content was added.

## Issues Found But Not Changed

The production www certificate/redirect setup needs hosting work. Stored local CMS copy still contains old quantitative and absolute claims; a safe source seeder does not rewrite or verify those records. Testimonials, five-star graphics, pricing, branding and existing public URLs remain unchanged. Large images and overlapping Bootstrap/Popper dependencies need separate performance work. No production CMS inventory or field Core Web Vitals measurements were available for this audit.

## NEEDS OWNER CONFIRMATION

- Evidence for 10,000+ businesses, 2M+ predictions, 40+ AI capabilities, 99.9% uptime/SLA, 15-30% gains, 40% waste reduction, 50+ languages, unlimited branches and absolute privacy/commercial assurances. See `SEO_PHASE_2_CLAIMS.md` for exact sources and requirements.
- Original quotes, identities, companies, consent, ratings and results for David Parr, Tim Johnson and Krishna Watt, including the 23% claim. Initial avatars do not verify customer identity.
- Production CMS reconciliation and approval of the proposed feature/industry pages. Specialized pharmacy, distribution, device, warranty and platform workflows must be confirmed before publishing corresponding claims.
- Hosting certificate/www normalization work. No major application URL restructuring is proposed or implemented.

## Recommended Phase 3

First resolve the www TLS/redirect issue and reconcile production claims/testimonial evidence. Then approve a small set of distinct, evidence-backed feature/industry pages from the plans, connect them with useful internal links, and measure production crawl/indexing and field performance. Optimize large assets and consolidate dependencies only after targeted regression testing. Consider multilingual/hreflang architecture separately. Phase 3 has not been implemented.
