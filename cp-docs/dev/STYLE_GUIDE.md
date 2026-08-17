# Documentation Style Guide

**For documentation authors and CMS editors only.**

This guide defines the writing standards for all user-facing documentation in {application_name}. Follow these conventions to ensure consistency across all guides.

---

## General Principles

1. **Write for the end user**, not for developers.
2. Use **plain, everyday language** — avoid jargon, code snippets, and technical terms.
3. Keep sentences **short and direct** (aim for 15–20 words per sentence).
4. Use **active voice** ("Click Save" not "The Save button should be clicked").
5. Address the reader as **"you"** ("You can add a new product…").

---

## Formatting Standards

### Headings
- Use `#` for the page title (one per file).
- Use `##` for major sections.
- Use `###` for subsections.
- Keep headings **sentence case** (capitalise only the first word and proper nouns).

### UI Elements
- **Bold** all button names, menu items, tab names, and screen labels:
  - Go to **Settings → Business Settings**
  - Click **Save**
  - Open the **POS** tab

### Navigation Paths
- Use the arrow `→` to separate menu levels:
  - **Settings → Business Settings → POS Tab**

### Lists
- Use **numbered lists** for sequential steps (do this, then this).
- Use **bullet lists** for non-sequential items (features, options, tips).

### Tables
- Use tables for comparisons, feature lists, or status references.
- Keep tables simple — no more than 4–5 columns.

### Tips and Warnings
- Use blockquotes for tips:
  > **Tip:** You can export this report to Excel for further analysis.
- Use bold text for warnings:
  > **Important:** This action cannot be undone.

---

## Content Rules

### Do NOT Include
- PHP/SQL/JavaScript code blocks
- `.env` file references or environment variables
- Artisan commands (`php artisan …`)
- File paths or directory structures (`app/Http/Controllers/…`)
- Database table or column names
- API endpoints or URLs with route parameters
- Permission code keys (e.g., `product.view`, `crm.access_crm`)
- Technical architecture descriptions

### Instead, Write
| Instead of… | Write… |
|---|---|
| `php artisan migrate` | Ask your system administrator to run the required setup. |
| `storage/logs/laravel.log` | Contact your system administrator for log details. |
| `product.view` permission | **View Products** permission |
| `/sell/pos?location_id=5` | Open the POS screen for your location. |
| `ENABLE_CRM=true` in `.env` | Make sure the CRM module is enabled by your administrator. |

---

## File Naming

- All files in `cp-docs/en/` are **user-facing guides** (shown to business owners and staff).
- All files in `cp-docs/dev/` are **developer reference** (shown only to superadmins or used internally).
- Use `SCREAMING_SNAKE_CASE` with `.md` extension: `GETTING_STARTED.md`, `SALES_POS_GUIDE.md`.
- Prefix module-specific guides with the module name: `FOODPANDA_QUICK_REFERENCE.md`, `GYM_GUIDE.md`.

---

## Structure Template

Every user guide should follow this structure:

```
# Feature Name

Brief one-paragraph overview of what the feature does.

---

## Getting Started / Setup
How to enable or access the feature.

## How to Use [Feature]
Step-by-step instructions for common tasks.

## Key Features
Overview of what's available (tables, bullet lists).

## Settings and Options
What can be configured and where.

## Tips
Helpful advice for getting the most out of the feature.

## Frequently Asked Questions (optional)
Common questions with short answers.
```

---

## Review Checklist

Before publishing any documentation page, verify:

- [ ] No code blocks, file paths, or technical commands
- [ ] All UI elements are **bolded**
- [ ] Navigation paths use `→` arrows
- [ ] Steps are numbered; options/features are bulleted
- [ ] Language is simple enough for a non-technical business owner
- [ ] The `{application_name}` placeholder is used instead of a hardcoded app name

---

## Placeholders

Use these placeholders — they are replaced automatically by the system:

| Placeholder | Replaced With |
|---|---|
| `{application_name}` | The business's application name |
