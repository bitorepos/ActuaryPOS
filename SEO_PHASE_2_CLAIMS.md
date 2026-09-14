# Phase 2 marketing claims and testimonial evidence

Code/localhost content audit only. No production DB changes and no claims or quotes rewritten in this phase. Numeric UI dimensions, tax examples, test data and transaction records are not marketing evidence. Dependency bundles, logs, credentials and database backups were not treated as editorial sources.

| Claim | Location | Status | Evidence needed |
|---|---|---|---|
| 10,000+ BUSINESSES RUNNING ON AI | Local CMS statistics | NEEDS OWNER CONFIRMATION | Business records or contractual evidence; not supplied |
| 2M+ AI PREDICTIONS DELIVERED | Local CMS statistics | NEEDS OWNER CONFIRMATION | Business records or contractual evidence; not supplied |
| 40+ BUILT-IN AI CAPABILITIES | Local CMS statistics | NEEDS OWNER CONFIRMATION | Business records or contractual evidence; not supplied |
| 99.9% PLATFORM UPTIME SLA | Local CMS statistics | NEEDS OWNER CONFIRMATION | Business records or contractual evidence; not supplied |
| 23% repeat-purchase increase | Krishna Watt testimonial | NEEDS OWNER CONFIRMATION | Measurement, customer identity and consent |
| 15-30% first-quarter improvement | Stored FAQ | NEEDS OWNER CONFIRMATION | Study population, baseline, period and methodology |
| 50+ languages | Stored FAQ/module copy | NEEDS OWNER CONFIRMATION | Supported language inventory and test coverage |
| 90 days of sales data | Stored forecasting FAQ | VERIFIED implementation window | AiBusinessIntelligenceController.php:323-331 filters sales with subDays(90). This does not substantiate forecast accuracy or guaranteed stock outcomes. |
| Up to 40% less waste; unlimited branches; built-in AI everywhere | Current local CMS feature/industry/module content (inventory) | NEEDS OWNER CONFIRMATION | Reconcile production CMS; do not infer from the rewritten seeder |
| Five stars on every testimonial | CMS testimonial template | NEEDS OWNER CONFIRMATION | No rating field or verified rating source was found |
| Return on annual subscription; fast onboarding/close; lower CAC | Stored testimonial narratives | NEEDS OWNER CONFIRMATION | Original customer statements, permission and supporting measurements |
| 99.9% SLA and absolute data/privacy assurances | Stored FAQ/statistics | NEEDS OWNER CONFIRMATION | Applicable SLA, hosting configuration and AI provider data policy |

## Testimonial inventory

| Customer label | Company | Quotation source | Photo/logo | Rating | Decision |
|---|---|---|---|---|---|
| David Parr | Not supplied in the record | Full stored quote in SEO_PHASE_2_INVENTORY.json; no original evidence supplied | No uploaded photo; initials avatar fallback; no company logo verified | Template always draws five stars | NEEDS OWNER CONFIRMATION; unchanged |
| Tim Johnson | Not supplied in the record | Full stored quote in SEO_PHASE_2_INVENTORY.json; no original evidence supplied | No uploaded photo; initials avatar fallback; no company logo verified | Template always draws five stars | NEEDS OWNER CONFIRMATION; unchanged |
| Krishna Watt | Not supplied in the record | Full stored quote in SEO_PHASE_2_INVENTORY.json; no original evidence supplied | No uploaded photo; initials avatar fallback; no company logo verified | Template always draws five stars | NEEDS OWNER CONFIRMATION; unchanged |

The CMS guide previously encouraged sample user/country counts. Its instructions now require actual records and a reporting period. The revised marketing seeder already avoids inventing numerical claims and endorsements. Neither a seeder nor a database record is independent proof that a business claim is true.
