# RetailMan ERP System: SEO audit

Audited 2026-09-09 before implementation. Scope: public website, CMS templates, pricing, documentation and repository evidence. Design, branding, existing URLs and business functionality must remain intact. `SEO_CRAWL.json` records the pre-change live crawl, including titles, headings, metadata, status and image-alt coverage for each discovered important URL. Word counts include navigation and are not article word counts.

## Findings

| Priority | Page/URL | Current problem | Recommended change and SEO reason | Files/components affected |
|---|---|---|---|---|
| IMPORTANT | `/` | Title is `Home \| RetailMan ERP System`; H1 does not identify POS or ERP. Description is over 200 characters. | Use product-category title, concise description and explicit retail POS/ERP H1 to match commercial intent. Preserve custom CMS overrides. | CMS home, home_header and shared metadata |
| IMPORTANT | `/` | AI dominates all feature headings; everyday sales, inventory, purchasing and reporting benefits are harder to find. | Balance headings and introductory copy; link to verified guides using descriptive anchors. | CMS feature/industry partials and home_header |
| CRITICAL | `/` | Existing seeded copy includes 10,000+ customers, 2M+ predictions, 99.9% SLA, 15–30% gains, 40% waste reduction, instant ROI, testimonials, and absolute third-party data assurances without evidence found in this audit. | NEEDS OWNER CONFIRMATION: obtain records, consent and contractual evidence. Do not repeat these in new copy or schema. Replace unsupported hardcoded CTA promises with factual wording. Review database-owned copy separately; do not run the existing marketing seeder. | CmsMarketingContentSeeder, CMS statistics/FAQ/testimonial records, CTA |
| IMPORTANT | All CMS pages and blogs | Existing seo_title, canonical_url and OG-image fields are unused by public templates. Descriptions may be empty; social metadata and schema absent. | Reuse fields, provide safe text fallbacks, canonical URLs and matching social tags. Keep custom meta integration available. | CmsPage accessors; frontend layout and page/blog views |
| IMPORTANT | `/c/contact-us` | Empty description; no H1 (form title is H2). Response-time claims are unverified. | Add unique metadata and semantic H1, preserve form styling and submission. Replace only known seeded sales claims where safe. | contact_us view |
| IMPROVEMENT | `/c/blogs` | Generic title/H1, no description, empty listing (~58 total words including shell). | Improve topic and metadata; noindex an empty listing until articles exist. Publish useful original guides later. | blogs/index |
| IMPORTANT | `/pricing` | Generic title; no description/canonical; two H1s (brand and page title). | Product-specific pricing title, description and H1; use neutral brand heading only on pricing. Preserve all package calculations and prices. | pricing/index, layouts/auth and its brand partial |
| CRITICAL | `/docs/*` | Initial HTML contains Markdown without H1/H2/H3; depends on third-party JavaScript for readable document structure. | Render Markdown on server for public articles, keeping AJAX navigation and styling. Better initial readability for crawlers and users. | DocumentationController, documentation/public |
| IMPORTANT | `/docs`, `/docs/getting-started` | Duplicate initial article without canonical; no descriptions or social metadata across sampled guides. | Canonicalize the docs index to the selected article; preserve language query and English fallback identity. Derive description from rendered article. | DocumentationController, public metadata |
| CRITICAL | `/docs/seo-audit-missing-page` | Unknown article responds 200 with a missing-page message (soft 404). | Return an actual 404 without changing valid slugs or private-document access. | DocumentationController::publicDocs |
| IMPORTANT | `/docs/contact-superadmin` | Public help banner links to unavailable/private article, responding 200. | Link public help to existing contact page when CMS is available; retain authenticated admin help behavior. | documentation/partials/need-help |
| GOOD | `/docs/*` | Descriptive guide titles and previous/next/sidebar links already exist. | Keep navigation and useful technical content. Link users back to verified product overview. | documentation public/sidebar/scripts |
| IMPROVEMENT | `/docs/version-history` | Very long release-history page (~96,608 words including shell). | Plan release-specific archives after URL and maintenance review. Do not delete history. | VERSION_LOG.md, docs generator |
| IMPORTANT | `/sitemap.xml`, `/robots.txt` | Sitemap returns 404; robots allows crawling but advertises no sitemap. | Recommend a dynamic sitemap of published, canonical public URLs; exclude private docs, disabled pricing and drafts. Confirm primary domain and tenant scope before release. | routes, CMS publication scopes, documentation visibility |
| GOOD | Sampled public images | No missing alt attributes found. Hero uses a CSS background, which has no alt attribute. | Preserve decorative background treatment; review editorial image descriptions when adding content. Avoid invented image descriptions. | CMS image views |
| IMPORTANT | Feature and industry landing pages | No dedicated commercial pages discovered in public navigation. CMS supports `/c/page/{page}`, but undiscovered database pages may exist. | Inventory published CMS records before creating distinct landing pages. Keep tutorial and buying intent separate. | CMS pages, SEO_CONTENT_PLAN.md |
| IMPROVEMENT | Site terminology | Live buttons say `Andriod`; admin translation repeats it. Requested `Compelte` and `Ai assistence` not found in inspected CMS/docs source. | Correct Android display spelling while retaining legacy setting keys. | CMS home button labels; CMS English language file |
| IMPROVEMENT | Custom CMS content | Raw global meta HTML may contain duplicate title/description/canonical tags; body HTML may introduce extra H1s. | Centralize standard tags, retain non-SEO integration tags and inspect rendered output. Do not silently strip owner-supplied content. | CMS shared layout/settings |

## Capability evidence and limits

- POS, inventory, sales, purchases, expenses, reports, branches: `cp-docs/en/SALES_POS_GUIDE.md`, `STOCK_MANAGEMENT_GUIDE.md`, `PURCHASES_GUIDE.md`, `EXPENSES_GUIDE.md`, `REPORTS_GUIDE.md`, `LOCATIONS_GUIDE.md` and corresponding controllers.
- Accounting, CRM, HR: existing Accounting, Crm and Essentials modules; public guides `/docs/module-accounting`, `/docs/module-crm-guide`, `/docs/module-essentials`.
- AI assistance exists: `modules/AiAssistance/Http/Controllers/AiAssistanceController.php`, `AiBusinessIntelligenceController.php`, `AiMessengerController.php`. This does not prove automatic operation, accuracy, ROI, universal availability or a fixed count of features.
- Desktop app: live `/docs/desktop-app-guide` documents saved cloud/local connections, printing and local export. Local export is not proof of offline bidirectional synchronization.
- Mobile download links exist on the live homepage. Supported OS versions, full mobile feature parity, mobile offline use and synchronization guarantees: NEEDS OWNER CONFIRMATION.
- Restaurant and manufacturing workflows exist in guides/modules. Pharmacy regulatory compliance, excise compliance, enterprise capacity, industry-specific AI and guaranteed outcomes: NEEDS OWNER CONFIRMATION.
- Pricing is database-driven. No prices, free-tier promises, trial durations or plan availability should be invented.

## Live audit limitations

Direct HTTPS requests returned 200 for homepage, pricing, contact, blog and known public guides. The browsing service could not fetch the site; direct requests were used instead. No Search Console, analytics performance data or production database was accessed. Crawl discovery is not proof that no other URLs exist. No ranking or AI-answer inclusion guarantees are made.

## References

- Website audited: https://retailmanerp.com/
- Documentation audited: https://retailmanerp.com/docs
- Pre-change per-URL evidence: SEO_CRAWL.json

Implementation and verification results will be recorded separately in `SEO_IMPLEMENTATION.md`.
