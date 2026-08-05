<style>
/* ===================================================================
   Documentation System – Professional BS5 Theme
   =================================================================== */

:root {
    --docs-sidebar-width: 280px;
    --docs-topbar-height: 56px;
    --docs-primary: #0047A5;
    --docs-primary-light: #e8f0fe;
    --docs-border: #e5e7eb;
    --docs-sidebar-bg: #f8f9fc;
    --docs-content-bg: #ffffff;
    --docs-text: #1f2937;
    --docs-text-muted: #6b7280;
    --docs-hover-bg: #f0f4ff;
    --docs-active-bg: #dbeafe;
    --docs-active-text: #1d4ed8;
    --docs-radius: 8px;
}

/* ── Wrapper ──────────────────────────────────────────── */
.docs-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background: var(--docs-content-bg);
}

/* ── Top Bar ──────────────────────────────────────────── */
.docs-topbar {
    position: sticky;
    top: 0;
    z-index: 1030;
    background: var(--docs-primary);
    color: #fff;
    height: var(--docs-topbar-height);
    box-shadow: 0 1px 3px rgba(0,0,0,.12);
}

.docs-topbar-inner {
    display: flex;
    align-items: center;
    height: 100%;
    padding: 0 20px;
    gap: 16px;
}

.docs-brand {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #fff;
    font-weight: 700;
    font-size: 1.05rem;
    text-decoration: none;
    white-space: nowrap;
    flex-shrink: 0;
}
.docs-brand:hover { color: #fff; opacity: .9; }
.docs-brand i { font-size: 1.25rem; }

/* Search */
.docs-search-wrapper {
    flex: 1;
    max-width: 520px;
    position: relative;
}

.docs-search-box {
    display: flex;
    align-items: center;
    background: rgba(255,255,255,.15);
    border-radius: 8px;
    padding: 0 12px;
    transition: background .2s;
}
.docs-search-box:focus-within {
    background: rgba(255,255,255,.25);
}

.docs-search-icon {
    color: rgba(255,255,255,.7);
    font-size: .9rem;
    margin-right: 8px;
}

.docs-search-input {
    background: transparent;
    border: none;
    outline: none;
    color: #fff;
    font-size: .875rem;
    padding: 8px 0;
    width: 100%;
}
.docs-search-input::placeholder { color: rgba(255,255,255,.6); }

.docs-search-kbd {
    background: rgba(255,255,255,.18);
    border: 1px solid rgba(255,255,255,.2);
    border-radius: 4px;
    color: rgba(255,255,255,.7);
    font-size: .7rem;
    padding: 2px 6px;
    margin-left: 8px;
    white-space: nowrap;
}

/* Search dropdown results */
.docs-search-results {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border-radius: 0 0 var(--docs-radius) var(--docs-radius);
    box-shadow: 0 8px 24px rgba(0,0,0,.15);
    max-height: 480px;
    overflow-y: auto;
    z-index: 1050;
    scrollbar-width: thin;
    scrollbar-color: var(--docs-border) transparent;
}
.docs-search-results::-webkit-scrollbar { width: 6px; }
.docs-search-results::-webkit-scrollbar-thumb { background: var(--docs-border); border-radius: 3px; }

/* Results header with keyboard hints */
.docs-search-results .search-results-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 14px;
    background: #f8f9fa;
    border-bottom: 1px solid var(--docs-border);
    font-size: .75rem;
    color: var(--docs-text-muted);
}
.docs-search-results .search-results-header kbd {
    display: inline-block;
    background: #e9ecef;
    border: 1px solid #dee2e6;
    border-radius: 3px;
    padding: 1px 5px;
    font-size: .65rem;
    font-family: inherit;
    margin: 0 2px;
    color: #495057;
}

.docs-search-results .search-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 10px 14px;
    text-decoration: none;
    color: var(--docs-text);
    border-bottom: 1px solid var(--docs-border);
    transition: background .15s;
}
.docs-search-results .search-item:hover,
.docs-search-results .search-item.kb-active {
    background: var(--docs-hover-bg);
}
.docs-search-results .search-item.kb-active {
    box-shadow: inset 3px 0 0 var(--docs-primary);
}

/* Search item icon column */
.docs-search-results .search-item-icon {
    flex-shrink: 0;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(79,70,229,.08);
    border-radius: 6px;
    color: var(--docs-primary);
    font-size: .9rem;
    margin-top: 2px;
}

/* Search item body */
.docs-search-results .search-item-body {
    flex: 1;
    min-width: 0;
}
.docs-search-results .search-item .search-title { font-weight: 600; font-size: .875rem; line-height: 1.3; }
.docs-search-results .search-item .search-cat {
    font-size: .72rem;
    color: var(--docs-text-muted);
    margin-top: 1px;
    display: flex;
    align-items: center;
    gap: 4px;
}
.docs-search-results .search-item .search-cat i { font-size: .65rem; }
.docs-search-results .search-item .search-menu {
    font-size: .72rem;
    color: #6366f1;
    margin-top: 2px;
    display: flex;
    align-items: center;
    gap: 4px;
}
.docs-search-results .search-item .search-menu i { font-size: .65rem; }
.docs-search-results .search-item .search-snippet {
    font-size: .78rem;
    color: var(--docs-text-muted);
    margin-top: 4px;
    line-height: 1.4;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

/* Match type tags / badges */
.docs-search-results .search-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
    margin-top: 5px;
    align-items: center;
}
.docs-search-results .search-tag {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    font-size: .65rem;
    font-weight: 500;
    padding: 1px 7px;
    border-radius: 10px;
    white-space: nowrap;
}
.docs-search-results .search-tag i { font-size: .55rem; }
.search-tag.tag-feature  { background: #dbeafe; color: #1d4ed8; }
.search-tag.tag-keyword  { background: #fef3c7; color: #92400e; }
.search-tag.tag-setting  { background: #e0e7ff; color: #4338ca; }
.search-tag.tag-menu     { background: #d1fae5; color: #065f46; }
.search-tag.tag-content  { background: #f3e8ff; color: #6b21a8; }
.search-tag.tag-tab      { background: #e5e7eb; color: #374151; }

.docs-search-results .search-score {
    font-size: .6rem;
    color: var(--docs-text-muted);
    background: #f1f5f9;
    border-radius: 8px;
    padding: 1px 6px;
    margin-left: auto;
}

/* Highlight <mark> styling */
.docs-search-results mark,
.docs-article mark {
    background: #fef08a;
    color: inherit;
    padding: 0 2px;
    border-radius: 2px;
    font-weight: 600;
}
.docs-search-results .search-title mark {
    background: #fbbf24;
    color: #1a1a1a;
}

/* Empty state */
.docs-search-results .search-empty {
    padding: 24px 20px;
    text-align: center;
    color: var(--docs-text-muted);
    font-size: .875rem;
}
.docs-search-results .search-empty i {
    font-size: 1.5rem;
    display: block;
    margin-bottom: 8px;
    opacity: .5;
}
.docs-search-results .search-empty-hint {
    font-size: .75rem;
    margin-top: 6px;
    opacity: .7;
}

.docs-topbar-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
}

/* ── Theme Color Overrides ─────────────────────────────── */
.docs-wrapper[data-theme="blue"]        { --docs-primary: #3097D1; --docs-primary-light: #e8f4fd; --docs-active-text: #2a7cb4; --docs-active-bg: #d6ecf7; }
.docs-wrapper[data-theme="black"]       { --docs-primary: #343a40; --docs-primary-light: #e9ecef; --docs-active-text: #23272b; --docs-active-bg: #dee1e4; }
.docs-wrapper[data-theme="purple"]      { --docs-primary: #6f42c1; --docs-primary-light: #f0ebf8; --docs-active-text: #5a32a3; --docs-active-bg: #e3d8f1; }
.docs-wrapper[data-theme="green"]       { --docs-primary: #28a745; --docs-primary-light: #e6f5eb; --docs-active-text: #1e7e34; --docs-active-bg: #d4edda; }
.docs-wrapper[data-theme="red"]         { --docs-primary: #dc3545; --docs-primary-light: #fce4e6; --docs-active-text: #bd2130; --docs-active-bg: #f5c6cb; }
.docs-wrapper[data-theme="yellow"]      { --docs-primary: #d4a017; --docs-primary-light: #fdf5e0; --docs-active-text: #b8860b; --docs-active-bg: #faecc8; }
.docs-wrapper[data-theme="blue-light"]  { --docs-primary: #5bc0de; --docs-primary-light: #e8f6fa; --docs-active-text: #31b0d5; --docs-active-bg: #d1ecf1; }
.docs-wrapper[data-theme="black-light"] { --docs-primary: #6c757d; --docs-primary-light: #eef0f2; --docs-active-text: #5a6268; --docs-active-bg: #dee0e3; }
.docs-wrapper[data-theme="purple-light"]{ --docs-primary: #9b59b6; --docs-primary-light: #f3eaf7; --docs-active-text: #8344a5; --docs-active-bg: #e4d3ee; }
.docs-wrapper[data-theme="green-light"] { --docs-primary: #5cb85c; --docs-primary-light: #eaf5ea; --docs-active-text: #449d44; --docs-active-bg: #d4edda; }
.docs-wrapper[data-theme="red-light"]   { --docs-primary: #e74c3c; --docs-primary-light: #fde8e6; --docs-active-text: #cf3625; --docs-active-bg: #f5c6cb; }
.docs-wrapper[data-theme="custom-1"]    { --docs-primary: #0047A5; --docs-primary-light: #e8f0fb; --docs-active-text: #003781; --docs-active-bg: #ccddf3; }
.docs-wrapper[data-theme="custom-2"]    { --docs-primary: #F57421; --docs-primary-light: #fef0e4; --docs-active-text: #d4600e; --docs-active-bg: #fcddc4; }

/* ── Body Layout ──────────────────────────────────────── */
.docs-body {
    display: flex;
    flex: 1;
    min-height: calc(100vh - var(--docs-topbar-height));
}

/* ── Sidebar ──────────────────────────────────────────── */
.docs-sidebar {
    width: var(--docs-sidebar-width);
    flex-shrink: 0;
    background: var(--docs-sidebar-bg);
    border-right: 1px solid var(--docs-border);
    overflow-y: auto;
    position: sticky;
    top: var(--docs-topbar-height);
    height: calc(100vh - var(--docs-topbar-height));
    padding: 16px 0;
    scrollbar-width: thin;
    scrollbar-color: #d1d5db transparent;
}
.docs-sidebar::-webkit-scrollbar { width: 5px; }
.docs-sidebar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }

/* ── Tab Pills ────────────────────────────────────────── */
.docs-tab-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
    padding: 12px 14px;
    border-bottom: 1px solid var(--docs-border);
    margin-bottom: 4px;
}

.docs-tab-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 10px;
    font-size: .72rem;
    font-weight: 600;
    color: var(--docs-text-muted);
    background: transparent;
    border: 1px solid var(--docs-border);
    border-radius: 20px;
    cursor: pointer;
    transition: all .2s;
    white-space: nowrap;
    line-height: 1.3;
}
.docs-tab-pill i { font-size: .78rem; }
.docs-tab-pill span { display: inline; }
.docs-tab-pill:hover {
    background: var(--docs-hover-bg);
    color: var(--docs-active-text);
    border-color: var(--docs-active-text);
}
.docs-tab-pill.active {
    background: var(--docs-primary);
    color: #fff;
    border-color: var(--docs-primary);
}
.docs-tab-pill.active:hover {
    background: color-mix(in srgb, var(--docs-primary) 85%, #000);
    border-color: color-mix(in srgb, var(--docs-primary) 85%, #000);
    color: #fff;
}

/* Link-style pills (<a> tags) — reset anchor defaults to match buttons */
a.docs-tab-pill-link { text-decoration: none; }
a.docs-tab-pill-link:hover { text-decoration: none; }
a.docs-tab-pill-link.active,
a.docs-tab-pill-link.active:hover { color: #fff; text-decoration: none; }

/* ── Module Pills Wrapper ─────────────────────────────── */
.docs-module-pills-wrapper {
    border-bottom: 1px solid var(--docs-border);
    padding: 0;
}
.docs-module-pills-toggle {
    display: flex;
    align-items: center;
    gap: 6px;
    width: 100%;
    padding: 8px 14px;
    font-size: .73rem;
    font-weight: 700;
    color: var(--docs-text-muted);
    background: transparent;
    border: none;
    cursor: pointer;
    text-transform: uppercase;
    letter-spacing: .04em;
    transition: background .2s;
}
.docs-module-pills-toggle:hover {
    background: var(--docs-hover-bg);
}
.docs-module-pills-toggle i:first-child { font-size: .82rem; }
.docs-module-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 18px;
    height: 18px;
    padding: 0 5px;
    font-size: .6rem;
    font-weight: 700;
    color: var(--docs-text-muted);
    background: rgba(0,0,0,.06);
    border-radius: 10px;
}
.docs-module-chevron {
    margin-left: auto;
    font-size: .65rem;
    transition: transform .25s ease;
}
.docs-module-pills-wrapper.expanded .docs-module-chevron {
    transform: rotate(180deg);
}
.docs-module-pills {
    display: none;
    flex-wrap: wrap;
    gap: 4px;
    padding: 0 14px 10px;
}
.docs-module-pills-wrapper.expanded .docs-module-pills {
    display: flex;
}
.docs-module-pill {
    font-size: .67rem !important;
    padding: 3px 8px !important;
}
.docs-module-pill.active {
    background: var(--docs-primary);
    color: #fff;
    border-color: var(--docs-primary);
}

/* ── Tab Panels ───────────────────────────────────────── */
.docs-nav-tab-panel {
    display: none;
}
.docs-nav-tab-panel.active {
    display: block;
}

/* Item count badge */
.docs-item-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 18px;
    height: 18px;
    padding: 0 5px;
    font-size: .65rem;
    font-weight: 700;
    color: var(--docs-text-muted);
    background: rgba(0,0,0,.06);
    border-radius: 10px;
    margin-left: auto;
}

.docs-nav-category {
    margin-bottom: 6px;
}

.docs-nav-category-label {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 8px 20px 4px;
    font-size: .7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .06em;
    color: var(--docs-text-muted);
}
.docs-nav-category-label i { font-size: .8rem; }

.docs-nav-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.docs-nav-item {}

.docs-nav-link {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 7px 20px 7px 28px;
    font-size: .82rem;
    color: var(--docs-text);
    text-decoration: none;
    border-left: 3px solid transparent;
    transition: all .15s;
    line-height: 1.4;
}
.docs-nav-link i { font-size: .85rem; color: var(--docs-text-muted); flex-shrink: 0; }
.docs-nav-link:hover {
    background: var(--docs-hover-bg);
    color: var(--docs-active-text);
}
.docs-nav-link:hover i { color: var(--docs-active-text); }

.docs-nav-item.active .docs-nav-link {
    background: var(--docs-active-bg);
    color: var(--docs-active-text);
    font-weight: 600;
    border-left-color: var(--docs-primary);
}
.docs-nav-item.active .docs-nav-link i { color: var(--docs-active-text); }

/* ── Content ──────────────────────────────────────────── */
.docs-content {
    flex: 1;
    min-width: 0;
    padding: 0;
}

.docs-content-inner {
    max-width: 860px;
    margin: 0 auto;
    padding: 24px 32px 48px;
}

/* Breadcrumb */
.docs-breadcrumb {
    margin-bottom: 20px;
}
.docs-breadcrumb .breadcrumb {
    background: none;
    padding: 0;
    font-size: .8rem;
}
.docs-breadcrumb .breadcrumb-item a {
    color: var(--docs-primary);
    text-decoration: none;
}
.docs-breadcrumb .breadcrumb-item.active { color: var(--docs-text-muted); }

/* Article / Markdown Rendering */
.docs-article {
    font-size: .92rem;
    line-height: 1.72;
    color: var(--docs-text);
    word-break: break-word;
}
.docs-article h1 { font-size: 1.75rem; font-weight: 800; margin: 0 0 16px; padding-bottom: 10px; border-bottom: 2px solid var(--docs-border); }
.docs-article h2 { font-size: 1.35rem; font-weight: 700; margin: 32px 0 12px; color: var(--docs-primary); }
.docs-article h3 { font-size: 1.1rem; font-weight: 700; margin: 24px 0 8px; }
.docs-article h4 { font-size: .95rem; font-weight: 700; margin: 20px 0 6px; }

.docs-article p { margin-bottom: 14px; }
.docs-article a { color: var(--docs-primary); text-decoration: underline; }
.docs-article a:hover { text-decoration: none; }

.docs-article pre {
    background: #1e293b;
    color: #e2e8f0;
    border-radius: var(--docs-radius);
    padding: 16px 20px;
    overflow-x: auto;
    font-size: .82rem;
    line-height: 1.6;
    margin: 16px 0;
}
.docs-article code {
    background: #f1f5f9;
    color: #be185d;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: .83rem;
}
.docs-article pre code {
    background: transparent;
    color: inherit;
    padding: 0;
    border-radius: 0;
    font-size: inherit;
}

.docs-article blockquote {
    border-left: 4px solid var(--docs-primary);
    background: var(--docs-primary-light);
    padding: 12px 18px;
    margin: 16px 0;
    border-radius: 0 var(--docs-radius) var(--docs-radius) 0;
    font-size: .875rem;
}
.docs-article blockquote p:last-child { margin-bottom: 0; }

.docs-article ul, .docs-article ol {
    padding-left: 24px;
    margin-bottom: 14px;
}
.docs-article li { margin-bottom: 4px; }

.docs-article table {
    width: 100%;
    border-collapse: collapse;
    margin: 16px 0;
    font-size: .85rem;
}
.docs-article th {
    background: var(--docs-sidebar-bg);
    font-weight: 700;
    text-align: left;
    padding: 10px 12px;
    border: 1px solid var(--docs-border);
}
.docs-article td {
    padding: 8px 12px;
    border: 1px solid var(--docs-border);
}
.docs-article tr:hover td { background: #fafbfd; }

.docs-article hr {
    border: none;
    border-top: 1px solid var(--docs-border);
    margin: 28px 0;
}

.docs-article img {
    max-width: 100%;
    border-radius: var(--docs-radius);
    margin: 12px 0;
}

/* Search results (inline page) */
.docs-search-results-page {
    background: var(--docs-primary-light);
    border-radius: var(--docs-radius);
    padding: 20px 24px;
    margin-bottom: 24px;
}
.docs-search-result-item {
    padding: 10px 0;
    border-bottom: 1px solid rgba(0,0,0,.06);
}
.docs-search-result-item:last-child { border-bottom: none; }
.docs-search-result-item a {
    text-decoration: none;
    color: var(--docs-primary);
}
.docs-search-result-item a:hover strong { text-decoration: underline; }
.docs-search-snippet {
    font-size: .8rem;
    color: var(--docs-text-muted);
    margin: 4px 0 0;
    line-height: 1.5;
}

/* Page navigation */
.docs-page-nav {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    margin-top: 40px;
    padding-top: 24px;
    border-top: 1px solid var(--docs-border);
}

.docs-page-nav-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 18px;
    border: 1px solid var(--docs-border);
    border-radius: var(--docs-radius);
    text-decoration: none;
    color: var(--docs-text);
    transition: all .2s;
    max-width: 48%;
}
.docs-page-nav-link:hover {
    border-color: var(--docs-primary);
    color: var(--docs-primary);
    box-shadow: 0 2px 8px rgba(0, 71, 165, .1);
}
.docs-page-nav-link.next { margin-left: auto; text-align: right; }
.docs-page-nav-link small {
    display: block;
    font-size: .7rem;
    text-transform: uppercase;
    letter-spacing: .05em;
    color: var(--docs-text-muted);
    margin-bottom: 2px;
}
.docs-page-nav-link i { font-size: 1.1rem; }

/* Mobile sidebar toggle */
.docs-sidebar-toggle {
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 1040;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: var(--docs-primary);
    color: #fff;
    border: none;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0,0,0,.2);
    cursor: pointer;
}
.docs-sidebar-toggle:hover { opacity: .9; }

/* ── Responsive ───────────────────────────────────────── */
@media (max-width: 991.98px) {
    .docs-sidebar {
        position: fixed;
        left: -300px;
        top: var(--docs-topbar-height);
        z-index: 1035;
        transition: left .3s ease;
        box-shadow: 4px 0 12px rgba(0,0,0,.1);
    }
    .docs-sidebar.show {
        left: 0;
    }
    .docs-content-inner {
        padding: 20px 16px 40px;
    }
}

@media (max-width: 575.98px) {
    .docs-topbar-inner { padding: 0 12px; }
    .docs-search-kbd { display: none; }
    .docs-page-nav { flex-direction: column; }
    .docs-page-nav-link { max-width: 100%; }
    .docs-lang-code { display: none; }
}

/* ── Language Switcher ────────────────────────────────── */
.docs-lang-switcher {
    position: relative;
    flex-shrink: 0;
}

.docs-lang-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    background: rgba(255,255,255,.15);
    border: 1px solid rgba(255,255,255,.25);
    border-radius: 6px;
    color: #fff;
    font-size: .8rem;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s;
    white-space: nowrap;
}
.docs-lang-btn:hover {
    background: rgba(255,255,255,.25);
}
.docs-lang-flag { font-size: 1rem; line-height: 1; }
.docs-lang-code { text-transform: uppercase; letter-spacing: .04em; }
.docs-lang-chevron { font-size: .6rem; margin-left: 2px; transition: transform .2s; }
.docs-lang-switcher.open .docs-lang-chevron { transform: rotate(180deg); }

.docs-lang-dropdown {
    display: none;
    position: absolute;
    top: calc(100% + 6px);
    right: 0;
    min-width: 170px;
    background: #fff;
    border-radius: var(--docs-radius);
    box-shadow: 0 8px 24px rgba(0,0,0,.18);
    z-index: 1060;
    overflow: hidden;
    border: 1px solid var(--docs-border);
}
.docs-lang-switcher.open .docs-lang-dropdown { display: block; }

.docs-lang-option {
    display: flex;
    align-items: center;
    gap: 8px;
    width: 100%;
    padding: 9px 14px;
    border: none;
    background: transparent;
    color: var(--docs-text);
    font-size: .84rem;
    cursor: pointer;
    transition: background .15s;
    text-align: left;
}
.docs-lang-option:hover { background: var(--docs-hover-bg); }
.docs-lang-option.active {
    background: var(--docs-active-bg);
    color: var(--docs-active-text);
    font-weight: 600;
}
.docs-lang-option .docs-lang-flag { font-size: 1.05rem; }
.docs-lang-option .docs-lang-name { flex: 1; }

/* ── Fallback Notice ──────────────────────────────────── */
.docs-fallback-notice {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    margin-bottom: 16px;
    background: #fef3cd;
    border: 1px solid #ffc107;
    border-radius: var(--docs-radius);
    font-size: .84rem;
    color: #664d03;
}
.docs-fallback-notice i { font-size: 1rem; flex-shrink: 0; }

/* ── RTL Support ──────────────────────────────────────── */
[dir="rtl"] .docs-content-inner,
.docs-content[dir="rtl"] {
    direction: rtl;
    text-align: right;
}

[dir="rtl"] .docs-article {
    direction: rtl;
    text-align: right;
}
[dir="rtl"] .docs-article pre,
[dir="rtl"] .docs-article code {
    direction: ltr;
    text-align: left;
}

[dir="rtl"] .docs-nav-link {
    padding: 7px 28px 7px 20px;
    border-left: none;
    border-right: 3px solid transparent;
}
[dir="rtl"] .docs-nav-item.active .docs-nav-link {
    border-left-color: transparent;
    border-right-color: var(--docs-primary);
}

[dir="rtl"] .docs-breadcrumb .breadcrumb {
    direction: rtl;
}
[dir="rtl"] .breadcrumb-item + .breadcrumb-item::before {
    content: "\005C";
    float: right;
    padding-left: .5rem;
    padding-right: 0;
}

[dir="rtl"] .docs-page-nav-link.prev {
    flex-direction: row-reverse;
}
[dir="rtl"] .docs-page-nav-link.next {
    flex-direction: row-reverse;
    text-align: left;
}

[dir="rtl"] .docs-article ul,
[dir="rtl"] .docs-article ol {
    padding-left: 0;
    padding-right: 24px;
}

[dir="rtl"] .docs-article blockquote {
    border-left: none;
    border-right: 4px solid var(--docs-primary);
    border-radius: var(--docs-radius) 0 0 var(--docs-radius);
}

[dir="rtl"] .docs-lang-dropdown {
    right: auto;
    left: 0;
}
[dir="rtl"] .docs-lang-option {
    text-align: right;
}

/* RTL sidebar positioning for mobile */
@media (max-width: 991.98px) {
    [dir="rtl"] .docs-sidebar,
    html[dir="rtl"] .docs-sidebar {
        left: auto;
        right: -300px;
        transition: right .3s ease;
    }
    [dir="rtl"] .docs-sidebar.show,
    html[dir="rtl"] .docs-sidebar.show {
        right: 0;
        left: auto;
    }
}

/* ── Language loading animation ───────────────────────── */
.docs-article.loading {
    opacity: .4;
    pointer-events: none;
    transition: opacity .2s;
}
.docs-article.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 32px;
    height: 32px;
    border: 3px solid var(--docs-border);
    border-top-color: var(--docs-primary);
    border-radius: 50%;
    animation: docs-spin .6s linear infinite;
}
@keyframes docs-spin {
    to { transform: translate(-50%, -50%) rotate(360deg); }
}

/* ══════════════════════════════════════════════════════════
   CONTACT SUPERADMIN PAGE
   ══════════════════════════════════════════════════════════ */
.contact-admin-page {
    max-width: 800px;
}

.ca-header h1 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--docs-heading);
    margin: 0 0 8px 0;
    display: flex;
    align-items: center;
    gap: 10px;
}
.ca-header h1 i { color: var(--docs-primary); font-size: 1.3rem; }
.ca-desc {
    color: var(--docs-text-muted);
    font-size: .9rem;
    margin: 0 0 24px 0;
}

.ca-section {
    margin-bottom: 28px;
    padding-bottom: 24px;
    border-bottom: 1px solid var(--docs-border);
}
.ca-section:last-child { border-bottom: none; }
.ca-section h3 {
    font-size: 1.05rem;
    font-weight: 600;
    color: var(--docs-heading);
    margin: 0 0 14px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.ca-section h3 i { color: var(--docs-primary); font-size: .95rem; }

/* Admin table */
.ca-table {
    width: 100%;
    border-collapse: collapse;
    font-size: .875rem;
    margin-bottom: 8px;
}
.ca-table th {
    background: #f8f9fa;
    font-weight: 600;
    padding: 8px 12px;
    text-align: left;
    border-bottom: 2px solid var(--docs-border);
    color: var(--docs-text-muted);
    font-size: .78rem;
    text-transform: uppercase;
    letter-spacing: .5px;
}
.ca-table td {
    padding: 8px 12px;
    border-bottom: 1px solid var(--docs-border);
}
[dir="rtl"] .ca-table th,
[dir="rtl"] .ca-table td { text-align: right; }

/* Form */
.ca-form-group {
    margin-bottom: 14px;
}
.ca-form-group label {
    display: block;
    font-weight: 600;
    font-size: .85rem;
    color: var(--docs-heading);
    margin-bottom: 5px;
}
.ca-input, .ca-textarea {
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid var(--docs-border);
    border-radius: var(--docs-radius);
    font-size: .875rem;
    font-family: inherit;
    color: var(--docs-text);
    background: #fff;
    transition: border-color .2s, box-shadow .2s;
    box-sizing: border-box;
}
.ca-input:focus, .ca-textarea:focus {
    outline: none;
    border-color: var(--docs-primary);
    box-shadow: 0 0 0 3px rgba(79,70,229,.1);
}
.ca-textarea {
    resize: vertical;
    min-height: 100px;
}
.ca-submit-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 24px;
    background: var(--docs-primary);
    color: #fff;
    border: none;
    border-radius: var(--docs-radius);
    font-size: .875rem;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s, transform .1s;
}
.ca-submit-btn:hover { background: #4338ca; }
.ca-submit-btn:active { transform: scale(.98); }
.ca-submit-btn:disabled {
    opacity: .6;
    cursor: not-allowed;
}

/* Form status messages */
.ca-form-status {
    margin-top: 12px;
    padding: 10px 14px;
    border-radius: var(--docs-radius);
    font-size: .85rem;
    display: flex;
    align-items: center;
    gap: 8px;
}
.ca-form-status.ca-success {
    background: #d1fae5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}
.ca-form-status.ca-error {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
}

/* Login notice */
.ca-login-notice {
    text-align: center;
    padding: 32px 20px !important;
    background: #f8f9fa;
    border-radius: var(--docs-radius);
}
.ca-login-notice i { font-size: 2rem; color: var(--docs-text-muted); margin-bottom: 10px; display: block; }
.ca-login-notice p { color: var(--docs-text-muted); margin: 0 0 14px 0; }
.ca-login-btn {
    display: inline-block;
    padding: 8px 24px;
    background: var(--docs-primary);
    color: #fff;
    border-radius: var(--docs-radius);
    text-decoration: none;
    font-weight: 600;
    font-size: .85rem;
}
.ca-login-btn:hover { background: #4338ca; color: #fff; text-decoration: none; }

/* Guidelines */
.ca-guidelines ol {
    padding-left: 20px;
    margin: 0;
}
.ca-guidelines li {
    margin-bottom: 6px;
    font-size: .875rem;
    color: var(--docs-text);
    line-height: 1.5;
}
[dir="rtl"] .ca-guidelines ol { padding-left: 0; padding-right: 20px; }

/* Loading */
.ca-loading {
    display: flex;
    justify-content: center;
    padding: 30px;
}
.ca-spinner {
    width: 28px;
    height: 28px;
    border: 3px solid var(--docs-border);
    border-top-color: var(--docs-primary);
    border-radius: 50%;
    animation: docs-spin .6s linear infinite;
}

/* Empty state */
.ca-empty {
    text-align: center;
    padding: 30px;
    color: var(--docs-text-muted);
}
.ca-empty i { font-size: 2rem; margin-bottom: 8px; display: block; opacity: .5; }
.ca-empty p { margin: 0; font-size: .875rem; }

/* ── Conversation Threads ────────────────────────────── */
.ca-thread {
    border: 1px solid var(--docs-border);
    border-radius: var(--docs-radius);
    margin-bottom: 14px;
    overflow: hidden;
}
.ca-thread-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    background: #f8f9fa;
    border-bottom: 1px solid var(--docs-border);
    gap: 10px;
}
.ca-thread-subject {
    font-weight: 600;
    font-size: .9rem;
    color: var(--docs-heading);
    flex: 1;
    min-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.ca-thread-status {
    flex-shrink: 0;
    font-size: .7rem;
    font-weight: 600;
    padding: 2px 10px;
    border-radius: 10px;
    text-transform: uppercase;
    letter-spacing: .3px;
}
.ca-status-open .ca-thread-status { background: #dbeafe; color: #1d4ed8; }
.ca-status-replied .ca-thread-status { background: #d1fae5; color: #065f46; }
.ca-status-closed .ca-thread-status { background: #e5e7eb; color: #6b7280; }

.ca-thread-meta {
    padding: 4px 16px 8px;
    font-size: .72rem;
    color: var(--docs-text-muted);
    background: #f8f9fa;
}

.ca-thread-messages {
    padding: 12px 16px;
}

/* Individual messages */
.ca-msg {
    margin-bottom: 12px;
    padding: 10px 14px;
    border-radius: var(--docs-radius);
    font-size: .85rem;
}
.ca-msg:last-child { margin-bottom: 0; }

.ca-msg-mine {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    margin-right: 30px;
}
.ca-msg-admin {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    margin-left: 30px;
}
[dir="rtl"] .ca-msg-mine { margin-right: 0; margin-left: 30px; }
[dir="rtl"] .ca-msg-admin { margin-left: 0; margin-right: 30px; }

.ca-msg-sender {
    font-size: .78rem;
    font-weight: 600;
    color: var(--docs-text-muted);
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 5px;
    flex-wrap: wrap;
}
.ca-msg-sender i { font-size: .8rem; }
.ca-admin-badge {
    background: var(--docs-primary);
    color: #fff;
    font-size: .6rem;
    padding: 1px 6px;
    border-radius: 8px;
    font-weight: 600;
}
.ca-msg-time {
    font-weight: 400;
    font-size: .7rem;
    margin-left: auto;
    color: var(--docs-text-muted);
    opacity: .7;
}
[dir="rtl"] .ca-msg-time { margin-left: 0; margin-right: auto; }

.ca-msg-body {
    color: var(--docs-text);
    line-height: 1.5;
    white-space: pre-wrap;
    word-break: break-word;
}
.ca-msg-read {
    font-size: .68rem;
    color: #22c55e;
    margin-top: 4px;
    text-align: right;
}
[dir="rtl"] .ca-msg-read { text-align: left; }

/* ── Need Help? bottom help banner ─────────────────── */
.docs-need-help {
    margin-top: 2.5rem;
    padding: 1.25rem 1.5rem;
    background: linear-gradient(135deg, rgba(var(--docs-accent-rgb, 59,130,246), .07), rgba(var(--docs-accent-rgb, 59,130,246), .03));
    border: 1px solid rgba(var(--docs-accent-rgb, 59,130,246), .18);
    border-left: 4px solid var(--docs-accent, #3b82f6);
    border-radius: .65rem;
}
[dir="rtl"] .docs-need-help {
    border-left: 1px solid rgba(var(--docs-accent-rgb, 59,130,246), .18);
    border-right: 4px solid var(--docs-accent, #3b82f6);
}
.docs-need-help-inner {
    display: flex;
    align-items: flex-start;
    gap: .85rem;
}
.docs-need-help-inner > i {
    font-size: 1.35rem;
    color: var(--docs-accent, #3b82f6);
    margin-top: 2px;
    flex-shrink: 0;
}
.docs-need-help-inner strong {
    display: block;
    font-size: .95rem;
    margin-bottom: .3rem;
    color: var(--docs-heading, #1e293b);
}
.docs-need-help-inner p {
    font-size: .875rem;
    line-height: 1.6;
    color: var(--docs-text, #334155);
}
.docs-need-help-link {
    color: var(--docs-accent, #3b82f6);
    font-weight: 600;
    text-decoration: none;
    border-bottom: 1px dashed var(--docs-accent, #3b82f6);
    transition: color .15s, border-color .15s;
}
.docs-need-help-link:hover {
    color: var(--docs-accent-dark, #2563eb);
    border-bottom-style: solid;
}
@media (max-width: 576px) {
    .docs-need-help { padding: 1rem; }
    .docs-need-help-inner { gap: .6rem; }
    .docs-need-help-inner > i { font-size: 1.15rem; }
}
</style>
