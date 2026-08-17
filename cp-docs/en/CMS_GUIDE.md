# CMS (Content Management System) Module – User Manual

## Table of Contents
1. [Overview](#overview)
2. [Getting Started](#getting-started)
3. [Pages Management](#pages-management)
4. [Blog Marketing](#blog-marketing)
5. [Testimonials & Social Proof](#testimonials--social-proof)
6. [Contact Leads & Lead Pipeline](#contact-leads--lead-pipeline)
7. [SEO Best Practices](#seo-best-practices)
8. [Content Scheduling & Status Workflow](#content-scheduling--status-workflow)
9. [Site Settings & Integrations](#site-settings--integrations)
10. [Analytics & Tracking](#analytics--tracking)
11. [Permissions & Access Control](#permissions--access-control)
12. [FAQ & Troubleshooting](#faq--troubleshooting)

---

## Overview

The **CMS Module** powers your business's public-facing website — the landing page, blog, testimonials, contact form, and site-wide settings. It is designed with a **marketing-first approach** to help you:

- **Attract customers** through SEO-optimized blogs and landing pages
- **Build trust** with customer testimonials and social proof
- **Capture leads** from contact form inquiries with a full lead pipeline
- **Schedule content** with draft/published/scheduled/archived workflow
- **Track performance** with view counts, reading time, and conversion metrics
- **Integrate marketing tools** like Google Analytics, Facebook Pixel, and chat widgets

### Module Location
- **Admin Sidebar**: CMS (dropdown with Pages, Blogs, Testimonials, Contact Leads, Settings)
- **Your Website Pages**:
  - **Home page** — Your main landing page
  - **Blog listing** — Shows all your blog posts
  - **Individual blog post** — Each blog has its own page
  - **Contact us** — Contact form for visitors
  - **Custom pages** — Any additional pages you create

---

## Getting Started

### Accessing the CMS
1. Log in to the admin panel
2. Find **CMS** in the left sidebar (with a window icon)
3. The dropdown shows: Pages, Blogs, Testimonials, Contact Leads, Settings

### First-Time Setup Checklist
1. Go to **CMS > Settings** and configure:
   - Upload your **logo** (60×42 px recommended)
   - Set **contact information** (phone numbers, emails)
   - Add **social media links** (Facebook, Twitter, Instagram, etc.)
   - Configure **notification email** for contact form submissions
   - Add **Google Analytics** or **Facebook Pixel** tracking codes
2. Create your **Home page** (auto-created on install as "home" layout)
3. Create your **Contact page** (auto-created on install as "contact" layout)
4. Add at least **3 testimonials** for social proof
5. Write your first **blog post** with SEO fields filled in
6. Configure **FAQs** and **statistics** for the home page

---

## Pages Management

### Creating a Page
1. Navigate to **CMS > Pages**
2. Click **Add**
3. Fill in:
   - **Title** — The page heading (also used for URL slug generation)
   - **Content** — Rich text content (HTML supported)
   - **Meta Description** — 160-character summary for search engines
   - **Tags** — Comma-separated keywords for SEO meta keywords
   - **Feature Image** — Hero/thumbnail image
   - **Priority** — Sort order (lower = appears first)
   - **Is Enabled** — Toggle page visibility
4. **SEO Settings** (marketing enhancement):
   - **SEO Title** — Custom title for search results (overrides page title)
   - **OG Image** — Social media sharing image (1200×630 px recommended)
   - **Canonical URL** — Prevents duplicate content penalties
   - **Schema Markup** — JSON-LD structured data for rich search results
5. **Content Scheduling**:
   - **Status** — Draft, Published, Scheduled, or Archived
   - **Published At** — Schedule a future publish date/time
   - **Author Name** — For attribution
6. Click **Save**

### Special Layout Pages
- **Home Layout** — The main landing page at `/`
  - Shows testimonials, FAQs, statistics, and hero content
  - Only one page should have the "home" layout
- **Contact Layout** — The contact page at `/c/contact-us`
  - Includes the lead capture form
  - Only one page should have the "contact" layout

### Marketing Tips for Pages
- Keep titles under 60 characters for optimal search display
- Write compelling meta descriptions (120–160 characters) with a call-to-action
- Use high-quality feature images — they appear in social media shares
- Add schema markup for product/service pages to get rich snippets in Google

---

## Blog Marketing

Blogging is one of the most effective inbound marketing strategies. Use the CMS blog to attract organic traffic and convert visitors into leads.

### Creating a Blog Post
1. Navigate to **CMS > Blogs**
2. Click **Add**
3. Fill in all the same fields as pages, plus:
   - **Author Name** — Builds personal brand and trust
   - **Reading Time** — Auto-calculated based on word count (~200 words/min)
4. Set status to **Published** or **Scheduled** for a future date
5. Click **Save**

### Blog Content Strategy
| Strategy | Description | Impact |
|----------|-------------|--------|
| **Problem-Solution Posts** | Write about problems your POS system solves | Attracts searchers looking for solutions |
| **How-To Guides** | Tutorial content (e.g., "How to manage inventory") | Builds authority, long-tail SEO |
| **Industry News** | Comment on retail/restaurant/business trends | Shows thought leadership |
| **Case Studies** | Real customer success stories | Builds trust, supports testimonials |
| **Product Updates** | Announce new features | Retains existing users, attracts new ones |
| **Comparison Posts** | "POS System A vs B" type content | Captures comparison shoppers |

### Blog SEO Checklist
- [ ] Title includes primary keyword (under 60 characters)
- [ ] Meta description written with CTA (under 160 characters)
- [ ] SEO title customized if different from blog title
- [ ] Feature image uploaded (for social sharing)
- [ ] OG Image set (1200×630 px for Facebook/LinkedIn)
- [ ] Tags/keywords added (5–10 relevant terms)
- [ ] Internal links to other pages/blogs
- [ ] Schema markup added (Article type)
- [ ] Content is at least 300+ words (ideally 1000+)
- [ ] Canonical URL set if content exists elsewhere

### View Tracking
Every blog post automatically tracks **view count** when visitors read it. Use this data to:
- Identify your most popular content
- Double down on topics that attract traffic
- Repurpose high-performing blogs into other formats

---

## Testimonials & Social Proof

Testimonials are critical for building trust. Research shows **92% of consumers** read online reviews before purchasing.

### Adding Testimonials
1. Navigate to **CMS > Testimonials**
2. Click **Add**
3. Fill in:
   - **Title** — Customer name or company
   - **Content** — The testimonial quote
   - **Feature Image** — Customer photo or company logo
   - **Author Name** — Customer designation/role
   - **Priority** — Sort order on the home page
   - **Is Enabled** — Toggle visibility

### Testimonial Best Practices
- Include the customer's **full name and role** (e.g., "Jane Smith, Restaurant Owner")
- Add a **photo** — testimonials with photos are 3x more credible
- Keep testimonials **specific** — mention exact results (e.g., "Saved 2 hours daily")
- Rotate testimonials regularly — fresh social proof is more convincing
- Aim for **5–10 testimonials** covering different use cases (retail, restaurant, etc.)

---

## Contact Leads & Lead Pipeline

The CMS captures every contact form submission as a **lead** in the database, creating a marketing pipeline for follow-up.

### Viewing Leads
1. Navigate to **CMS > Contact Leads**
2. View the dashboard with:
   - **Total Leads** — All-time inquiry count
   - **New Leads** — Uncontacted inquiries
   - **This Month** — Recent 30-day count
   - **Conversion Rate** — Percentage of leads marked as "converted"

### Lead Pipeline Statuses
| Status | Meaning | Action |
|--------|---------|--------|
| **New** | Just submitted, not yet reviewed | Review within 24 hours |
| **Contacted** | Admin has reached out | Follow up within 48 hours |
| **Qualified** | Lead shows purchase intent | Prepare proposal/demo |
| **Converted** | Lead became a customer | 🎉 Track in sales |
| **Lost** | Lead did not convert | Analyze why, improve |

### Managing a Lead
1. Click on a lead to view full details (name, email, mobile, message, source, IP)
2. Use the **status buttons** to update the lead through the pipeline
3. Add **Admin Notes** to track communication history
4. The system tracks **who handled** each lead

### Exporting Leads
- Click **Export Leads (CSV)** to download all leads for external CRM import or analysis

### Lead Sources
Leads are automatically tagged with their source:
- **Contact Form** — From the `/c/contact-us` page
- **Blog** — Future: from blog-specific CTAs
- **Landing Page** — Future: from dedicated landing pages
- **Social Media** — Future: from social campaign links
- **Referral** — Future: from referral links

### Lead Response Best Practices
- **Respond within 1 hour** — leads contacted within the first hour are 7x more likely to convert
- **Personalize your response** — reference their specific message/inquiry
- **Offer a demo or trial** — reduce friction to conversion
- **Follow up 3 times** — most conversions happen after 2–3 touches

---

## SEO Best Practices

### On-Page SEO Fields
Each page/blog has dedicated SEO fields:

| Field | Purpose | Best Practice |
|-------|---------|---------------|
| **SEO Title** | Custom search result title | Include primary keyword, under 60 chars |
| **Meta Description** | Search result snippet | Include CTA, 120–160 characters |
| **Tags** | Meta keywords | 5–10 relevant keywords |
| **OG Image** | Social media preview image | 1200×630 px, include text overlay |
| **Canonical URL** | Prevent duplicate content | Set if content exists on multiple URLs |
| **Schema Markup** | Rich search results | Use JSON-LD format |

### Schema Markup Examples

Schema markup is special information you can add to help your pages appear better in Google search results (sometimes called "rich snippets"). Your system administrator can help you set this up if needed.

For most users, filling in the **SEO Title**, **Meta Description**, and **OG Image** fields is sufficient for good search engine results.

---

## Content Scheduling & Status Workflow

### Status Workflow
```
Draft  →  Published  →  Archived
  ↓
Scheduled  →  Published (auto on date)
```

| Status | Visibility | Use Case |
|--------|-----------|----------|
| **Draft** | Hidden (admin only) | Work-in-progress content |
| **Published** | Visible to public | Live content |
| **Scheduled** | Hidden until publish date | Pre-written content for future |
| **Archived** | Hidden from public | Old content kept for reference |

### Scheduling Content
1. Set status to **Scheduled**
2. Set the **Publish Date & Time**
3. The content will automatically become visible when the system is checked after that date
4. Monitor scheduled content from the pages/blogs listing

### Content Calendar Tips
- **Plan 2–4 weeks ahead** — maintain consistent publishing
- **Mix content types** — alternate between blogs, testimonials, and page updates
- **Align with marketing campaigns** — schedule content around product launches or promotions
- **Review analytics monthly** — adjust strategy based on view counts and lead generation

---

## Site Settings & Integrations

### Accessing Settings
Navigate to **CMS > Settings** to configure:

### General Settings
- **Logo** — Site logo (60×42 px recommended, displayed in header)
- **Meta Tags** — Global SEO keywords

### Contact Information
- **Contact Numbers** — Display phone numbers on the website
- **Email Addresses** — Display email addresses
- **Social Media Links** — Facebook, Twitter, Instagram, LinkedIn, YouTube, etc.
- **Notification Email** — Where contact form submissions are sent

### Marketing Integrations
| Integration | Purpose | Setup |
|-------------|---------|-------|
| **Google Analytics** | Track visitors, behavior, conversions | Paste tracking code |
| **Facebook Pixel** | Retarget visitors on Facebook/Instagram | Paste pixel code |
| **Chat Widget** | Live chat (Tidio, Tawk.to, etc.) | Paste widget code |
| **Custom JS** | Any third-party scripts | Add `<script>` tags |
| **Custom CSS** | Style customizations | Add `<style>` tags |

### FAQ Management
- Add frequently asked questions that appear on the home page
- Each FAQ has a **question** and **answer**
- FAQs improve SEO (Google often features FAQ content in search results)
- Keep answers concise—link to detailed pages for complex topics

### Statistics / Social Proof Numbers
- Display impressive numbers on the home page (e.g., "10,000+ Users", "50+ Countries")
- Each statistic has an **icon**, **number**, **label**, and **description**

### Download Buttons
- Configure links for Android, iOS, and Desktop app downloads
- These appear as call-to-action buttons on the home page

---

## Analytics & Tracking

### Built-in Analytics
The CMS tracks the following automatically:
- **Page Views** — Every page and blog post tracks view count
- **Blog Popularity** — Sort blogs by most viewed
- **Reading Time** — Auto-calculated per blog post
- **Lead Metrics** — Total leads, new leads, monthly leads, conversion rate

### Marketing KPIs to Monitor
| KPI | Where to Find | Target |
|-----|--------------|--------|
| Total Page Views | Page/Blog listing (view count column) | Growing month-over-month |
| Blog Views | Blog listing | Top posts getting 100+ views |
| Lead Count | Contact Leads dashboard | Increasing monthly |
| Conversion Rate | Contact Leads dashboard | > 10% is good |
| Response Time | Admin notes timestamps | < 1 hour |

### External Analytics Setup
1. Go to **CMS > Settings > Integration**
2. Paste your **Google Analytics** tracking code (GA4 recommended)
3. Paste your **Facebook Pixel** code for retargeting
4. Add **Google Tag Manager** via Custom JS if needed
5. Monitor results in Google Analytics / Facebook Ads Manager

---

## Permissions & Access Control

### Available Permissions
| Permission | Description |
|-----------|-------------|
| **Manage Pages** | Create, edit, delete pages |
| **Manage Blogs** | Create, edit, delete blog posts |
| **Manage Testimonials** | Create, edit, delete testimonials |
| **View Leads** | View contact leads (read-only) |
| **Manage Leads** | Update lead status, add notes, delete, export |
| **Manage Settings** | Modify site settings, integrations, FAQs |

### Setting Up Permissions
1. Go to **User Management > Roles**
2. Edit a role and scroll to the CMS section
3. Enable the relevant permissions for each role
4. **Superadmin** always has full access

### Recommended Role Setup
| Role | Recommended Permissions |
|------|------------------------|
| **Marketing Manager** | All CMS permissions |
| **Content Writer** | manage_pages, manage_blogs |
| **Sales Team** | view_leads, manage_leads |
| **Support Staff** | view_leads only |

---

## FAQ & Troubleshooting

### Common Questions

**Q: How do I change the home page content?**
A: Go to CMS > Pages, find the page with "home" layout, and edit its content.

**Q: Why isn't my blog showing on the public site?**
A: Check that: (1) Status is "Published", (2) "Is Enabled" is checked, (3) Published At date is in the past or empty.

**Q: How do I add a new testimonial?**
A: Go to CMS > Testimonials > Add. Fill in the customer name, quote, and photo.

**Q: Where do contact form submissions go?**
A: They are stored in **CMS > Contact Leads** AND emailed to the notification email set in Settings.

**Q: Can I schedule a blog post for later?**
A: Yes! Set status to "Scheduled" and pick a future "Published At" date/time.

**Q: How do I add Google Analytics?**
A: Go to CMS > Settings > Integration > paste your GA tracking code.

**Q: Can I add custom CSS/JS to the site?**
A: Yes, go to CMS > Settings > Integration > Custom CSS / Custom JavaScript.

**Q: How do I improve my blog's SEO?**
A: Fill in the SEO Title, Meta Description, Tags, OG Image, and Schema Markup for each blog post. See the [SEO Best Practices](#seo-best-practices) section.

**Q: How do I export leads for my CRM?**
A: Go to CMS > Contact Leads and click "Export Leads (CSV)".

### Troubleshooting

**Issue: Pages not showing on the frontend**
- Ensure the page is enabled (the **Is Enabled** switch is turned on)
- Check the status is set to "Published" (not Draft or Archived)
- Clear your browser cache

**Issue: Contact form not sending emails**
- Verify the notification email is set in CMS > Settings
- Contact your system administrator to check the email (SMTP) settings

**Issue: Images not displaying**
- Ensure the image was uploaded successfully (not exceeding the size limit)
- Contact your system administrator to verify file storage settings

---

*Module Version: 2.0 (Marketing Enhanced) | Last Updated: June 2025*
