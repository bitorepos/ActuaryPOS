<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
(function() {
    'use strict';

    // ── Config from Blade ───────────────────────────────
    <?php
        $isPublicRoute = !empty($isPublic);
        $searchUrl = $isPublicRoute ? route('docs.search') : route('documentation.search');
        $baseRoute = $isPublicRoute ? route('docs.public', '') : route('documentation.index', '');
        $switchLangUrl = $isPublicRoute ? route('docs.switchLang') : route('documentation.switchLang');
        $fetchPageUrl = $isPublicRoute ? route('docs.fetchPage') : route('documentation.fetchPage');

        // Build tab→firstSlug map for JS
        $tabFirstSlugs = [];
        foreach ($tabs as $tSlug => $tData) {
            $firstKey = array_key_first($tData['items'] ?? []);
            if ($firstKey) {
                $tabFirstSlugs[$tSlug] = $firstKey;
            }
        }
    ?>

    var searchUrl    = <?php echo json_encode($searchUrl, 15, 512) ?>;
    var baseRoute    = <?php echo json_encode(rtrim($baseRoute, '/'), 512) ?>;
    var switchLangUrl = <?php echo json_encode($switchLangUrl, 15, 512) ?>;
    var fetchPageUrl = <?php echo json_encode($fetchPageUrl, 15, 512) ?>;
    var isPublicMode = <?php echo json_encode($isPublicRoute, 15, 512) ?>;
    var tabFirstSlugs = <?php echo json_encode($tabFirstSlugs, 15, 512) ?>;
    var csrfToken    = document.querySelector('meta[name="csrf-token"]')
                        ? document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        : '';

    // ── Markdown rendering (skip RAWHTML content) ─────
    var articleEl = document.getElementById('docs-article');
    function renderMarkdown(el) {
        if (!el || typeof marked === 'undefined') return;
        var raw = el.textContent || el.innerText;
        // Skip if content starts with RAWHTML marker (already HTML from server)
        if (raw.trim().indexOf('<!--RAWHTML-->') === 0 || el.getAttribute('data-raw-html') === '1') {
            return;
        }
        if (raw.match(/^#{1,6}\s|^\*\*|^- |^\d+\.\s|^```/m)) {
            marked.setOptions({ gfm: true, breaks: true, headerIds: true, mangle: false });
            el.innerHTML = marked.parse(raw);
        }
    }

    /**
     * Set article content - handles both markdown and raw HTML.
     */
    function setArticleContent(content) {
        if (!articleEl) return;
        if (content.trim().indexOf('<!--RAWHTML-->') === 0) {
            // Raw HTML content — insert directly, skip markdown
            articleEl.innerHTML = content.replace('<!--RAWHTML-->', '').trim();
            articleEl.setAttribute('data-raw-html', '1');
            initContactForm(); // Re-init contact form if present
        } else {
            articleEl.removeAttribute('data-raw-html');
            articleEl.textContent = content;
            renderMarkdown(articleEl);
        }
    }

    // Initial render
    if (articleEl) {
        var initialContent = articleEl.textContent || articleEl.innerText;
        if (initialContent.trim().indexOf('<!--RAWHTML-->') === 0) {
            articleEl.innerHTML = initialContent.replace('<!--RAWHTML-->', '').trim();
            articleEl.setAttribute('data-raw-html', '1');
            initContactForm();
        } else {
            renderMarkdown(articleEl);
        }
    }

    // ── Sidebar toggle (mobile) ─────────────────────────
    var toggleBtn = document.getElementById('docs-sidebar-toggle');
    var sidebar = document.getElementById('docs-sidebar');
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
        document.addEventListener('click', function(e) {
            if (sidebar.classList.contains('show') &&
                !sidebar.contains(e.target) &&
                !toggleBtn.contains(e.target)) {
                sidebar.classList.remove('show');
            }
        });
    }

    // ── AJAX page loader ──────────────────────────────
    var isNavigating = false;
    var tabPills = document.querySelectorAll('.docs-tab-pill');
    var tabPanels = document.querySelectorAll('.docs-nav-tab-panel');

    /**
     * Load a documentation page via AJAX (no full reload).
     * Updates content, URL, breadcrumb, active states, and page nav.
     */
    function navigateToSlug(slug, pushState) {
        if (!slug || isNavigating) return;
        isNavigating = true;

        // Show loading state
        if (articleEl) { articleEl.classList.add('loading'); }

        var url = fetchPageUrl + '?slug=' + encodeURIComponent(slug) +
                  '&is_public=' + (isPublicMode ? '1' : '0');

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            isNavigating = false;
            if (articleEl) { articleEl.classList.remove('loading'); }

            // Update article content
            if (data.content) {
                setArticleContent(data.content);
            }

            // Update page title
            if (data.pageTitle) {
                document.title = data.pageTitle + ' - ' +
                    (document.title.split(' - ').slice(1).join(' - ') || 'Documentation');
            }

            // Update breadcrumb
            var breadcrumbTitle = document.getElementById('docs-breadcrumb-title');
            if (breadcrumbTitle && data.pageTitle) {
                breadcrumbTitle.textContent = data.pageTitle;
            }
            // Update breadcrumb tab label
            var breadcrumbItems = document.querySelectorAll('.breadcrumb-item');
            if (breadcrumbItems.length >= 2 && data.tabLabel) {
                breadcrumbItems[1].textContent = data.tabLabel;
            }

            // Update fallback notice
            var fallbackNotice = document.getElementById('docs-fallback-notice');
            if (data.isFallback && data.lang !== 'en') {
                if (fallbackNotice) { fallbackNotice.style.display = ''; }
            } else if (fallbackNotice) {
                fallbackNotice.style.display = 'none';
            }

            // Update URL without reload
            if (pushState !== false) {
                var newUrl = baseRoute + '/' + slug;
                history.pushState({ slug: slug, tab: data.tab }, data.pageTitle || '', newUrl);
            }

            // Switch active tab pill & panel
            if (data.tab) {
                switchTabUI(data.tab);
            }

            // Update sidebar active nav item
            updateActiveNavItem(slug);

            // Update page navigation (prev/next)
            updatePageNav(data);

            // Update content direction
            var contentMain = document.getElementById('docs-content-main');
            if (contentMain && data.dir) {
                contentMain.setAttribute('dir', data.dir);
            }

            // Toggle "Need Help?" banner (hide on contact page)
            var helpBanner = document.getElementById('docs-need-help');
            if (helpBanner) {
                helpBanner.style.display = (slug === 'contact-superadmin') ? 'none' : '';
            }

            // Scroll content to top
            if (contentMain) { contentMain.scrollTop = 0; }
        })
        .catch(function(err) {
            isNavigating = false;
            if (articleEl) { articleEl.classList.remove('loading'); }
            console.error('Page fetch failed:', err);
        });
    }

    /**
     * Switch the active tab UI (pill + panel) without navigation.
     */
    function switchTabUI(tabKey) {
        tabPills.forEach(function(p) { p.classList.remove('active'); });
        tabPanels.forEach(function(p) { p.classList.remove('active'); });

        // Activate the pill
        var targetPill = document.querySelector('.docs-tab-pill[data-tab="' + tabKey + '"]');
        if (targetPill) { targetPill.classList.add('active'); }

        // Activate the panel
        var targetPanel = document.querySelector('.docs-nav-tab-panel[data-tab-panel="' + tabKey + '"]');
        if (targetPanel) { targetPanel.classList.add('active'); }

        // Auto-expand module section if it's a module tab
        var moduleWrapper = document.querySelector('.docs-module-pills-wrapper');
        if (moduleWrapper && targetPill && targetPill.classList.contains('docs-module-pill')) {
            moduleWrapper.classList.add('expanded');
        }
    }

    /**
     * Update sidebar nav item active state.
     */
    function updateActiveNavItem(slug) {
        document.querySelectorAll('.docs-nav-item').forEach(function(item) {
            item.classList.remove('active');
        });
        var targetLink = document.querySelector('.docs-nav-link[data-slug="' + slug + '"]');
        if (targetLink) {
            targetLink.closest('.docs-nav-item').classList.add('active');
        }
    }

    /**
     * Update prev/next page navigation links.
     */
    function updatePageNav(data) {
        var pageNav = document.querySelector('.docs-page-nav');
        if (!pageNav) return;

        var html = '';
        if (data.prevSlug) {
            html += '<a href="' + baseRoute + '/' + data.prevSlug + '" class="docs-page-nav-link prev" data-nav-slug="' + data.prevSlug + '">' +
                    '<i class="bi bi-arrow-left"></i><span><small>Previous</small>' + (data.prevTitle || '') + '</span></a>';
        } else {
            html += '<span></span>';
        }
        if (data.nextSlug) {
            html += '<a href="' + baseRoute + '/' + data.nextSlug + '" class="docs-page-nav-link next" data-nav-slug="' + data.nextSlug + '">' +
                    '<span><small>Next</small>' + (data.nextTitle || '') + '</span><i class="bi bi-arrow-right"></i></a>';
        }
        pageNav.innerHTML = html;

        // Re-bind click handlers on new nav links
        pageNav.querySelectorAll('[data-nav-slug]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                navigateToSlug(this.getAttribute('data-nav-slug'), true);
            });
        });
    }

    // ── Handle browser back/forward ────────────────────
    window.addEventListener('popstate', function(e) {
        if (e.state && e.state.slug) {
            navigateToSlug(e.state.slug, false);
        }
    });

    // Set initial history state
    var initialActiveLink = document.querySelector('.docs-nav-item.active .docs-nav-link');
    if (initialActiveLink) {
        var initialSlug = initialActiveLink.getAttribute('data-slug');
        var initialTab = document.querySelector('.docs-tab-pill.active');
        history.replaceState(
            { slug: initialSlug, tab: initialTab ? initialTab.getAttribute('data-tab') : '' },
            document.title,
            window.location.href
        );
    }

    // ── Tab pill switching ──────────────────────────────
    if (tabPills.length) {
        tabPills.forEach(function(pill) {
            pill.addEventListener('click', function(e) {
                // For link-pills (<a> tags), prevent default navigation so AJAX takes over
                if (this.tagName === 'A') { e.preventDefault(); }

                var tabKey = this.getAttribute('data-tab');

                // Switch tab UI immediately
                switchTabUI(tabKey);

                // If this pill has a direct slug (link-pill), navigate to it
                var directSlug = this.getAttribute('data-slug');
                if (directSlug) {
                    navigateToSlug(directSlug, true);
                } else if (tabFirstSlugs[tabKey]) {
                    // Load the first page of the clicked tab via AJAX
                    navigateToSlug(tabFirstSlugs[tabKey], true);
                }
            });
        });
    }

    // ── Sidebar nav link click → AJAX load ─────────────
    document.querySelectorAll('.docs-nav-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var slug = this.getAttribute('data-slug');
            if (slug) {
                navigateToSlug(slug, true);
            }
            // Close mobile sidebar
            if (sidebar && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });
    });

    // ── Initial page-nav (prev/next) AJAX binding ──────
    document.querySelectorAll('.docs-page-nav-link[data-nav-slug]').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            navigateToSlug(this.getAttribute('data-nav-slug'), true);
        });
    });

    // ── "Need Help?" banner link → AJAX navigation ─────
    var helpLink = document.querySelector('.docs-need-help-link[data-slug]');
    if (helpLink) {
        helpLink.addEventListener('click', function(e) {
            e.preventDefault();
            navigateToSlug(this.getAttribute('data-slug'), true);
        });
    }

    // ── Module pills toggle (expand/collapse) ──────────
    var moduleToggle = document.getElementById('docs-module-pills-toggle');
    var moduleWrapper = moduleToggle ? moduleToggle.closest('.docs-module-pills-wrapper') : null;
    if (moduleToggle && moduleWrapper) {
        // Auto-expand if a module tab is active
        var activeModulePill = moduleWrapper.querySelector('.docs-module-pill.active');
        if (activeModulePill) {
            moduleWrapper.classList.add('expanded');
        }
        moduleToggle.addEventListener('click', function() {
            moduleWrapper.classList.toggle('expanded');
        });
    }

    // ── Language Switcher ───────────────────────────────
    var langSwitcher = document.getElementById('docs-lang-switcher');
    var langBtn = document.getElementById('docs-lang-btn');
    var langDropdown = document.getElementById('docs-lang-dropdown');

    if (langBtn && langSwitcher) {
        // Toggle dropdown
        langBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            langSwitcher.classList.toggle('open');
        });

        // Close on outside click
        document.addEventListener('click', function(e) {
            if (!langSwitcher.contains(e.target)) {
                langSwitcher.classList.remove('open');
            }
        });

        // Language option click → AJAX switch
        var langOptions = langDropdown.querySelectorAll('.docs-lang-option');
        langOptions.forEach(function(opt) {
            opt.addEventListener('click', function() {
                var newLang = this.getAttribute('data-lang');
                var newDir  = this.getAttribute('data-dir');
                var wrapper = document.querySelector('.docs-wrapper');
                var currentLang = wrapper ? wrapper.getAttribute('data-lang') : 'en';

                if (newLang === currentLang) {
                    langSwitcher.classList.remove('open');
                    return;
                }

                // Find active slug from sidebar
                var activeLink = document.querySelector('.docs-nav-item.active .docs-nav-link');
                var slug = activeLink ? activeLink.getAttribute('data-slug') : '';

                // Show loading state
                if (articleEl) { articleEl.classList.add('loading'); }
                langSwitcher.classList.remove('open');

                // AJAX request to switch language
                var formData = new FormData();
                formData.append('lang', newLang);
                formData.append('slug', slug);
                formData.append('is_public', isPublicMode ? '1' : '0');

                var fetchOpts = {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                };
                if (csrfToken) {
                    fetchOpts.headers['X-CSRF-TOKEN'] = csrfToken;
                }

                fetch(switchLangUrl, fetchOpts)
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    // Update content
                    if (articleEl) {
                        articleEl.classList.remove('loading');
                        setArticleContent(data.content || '');
                    }

                    // Update content direction
                    var contentMain = document.getElementById('docs-content-main');
                    if (contentMain) {
                        contentMain.setAttribute('dir', data.dir);
                    }

                    // Update <html> dir for public view
                    if (isPublicMode) {
                        document.documentElement.setAttribute('dir', data.dir);
                        document.documentElement.setAttribute('lang', data.lang);
                    }

                    // Update wrapper data attrs
                    if (wrapper) {
                        wrapper.setAttribute('data-lang', data.lang);
                        wrapper.setAttribute('data-dir', data.dir);
                    }

                    // Update breadcrumb title
                    var breadcrumbTitle = document.getElementById('docs-breadcrumb-title');
                    if (breadcrumbTitle && data.pageTitle) {
                        breadcrumbTitle.textContent = data.pageTitle;
                    }

                    // Update fallback notice
                    var fallbackNotice = document.getElementById('docs-fallback-notice');
                    if (data.isFallback && data.lang !== 'en') {
                        if (!fallbackNotice) {
                            fallbackNotice = document.createElement('div');
                            fallbackNotice.id = 'docs-fallback-notice';
                            fallbackNotice.className = 'docs-fallback-notice';
                            var contentInner = document.querySelector('.docs-content-inner');
                            if (contentInner) {
                                contentInner.insertBefore(fallbackNotice, contentInner.firstChild);
                            }
                        }
                        fallbackNotice.innerHTML = '<i class="bi bi-info-circle"></i> ' +
                            (data.uiStrings ? data.uiStrings.fallback_notice : 'Showing English fallback.');
                        fallbackNotice.style.display = '';
                    } else if (fallbackNotice) {
                        fallbackNotice.style.display = 'none';
                    }

                    // Update search placeholder
                    var searchInput = document.getElementById('docs-search-input');
                    if (searchInput && data.uiStrings) {
                        searchInput.setAttribute('placeholder', data.uiStrings.search_placeholder);
                    }

                    // Update language button display
                    var flagSpan = langBtn.querySelector('.docs-lang-flag');
                    var codeSpan = langBtn.querySelector('.docs-lang-code');
                    var selectedOpt = langDropdown.querySelector('[data-lang="' + data.lang + '"]');
                    if (selectedOpt) {
                        var selFlag = selectedOpt.querySelector('.docs-lang-flag');
                        if (flagSpan && selFlag) { flagSpan.textContent = selFlag.textContent; }
                        if (codeSpan) { codeSpan.textContent = data.lang.toUpperCase(); }
                    }

                    // Update active state in dropdown
                    langOptions.forEach(function(o) {
                        o.classList.remove('active');
                        var chk = o.querySelector('.bi-check2');
                        if (chk) { chk.remove(); }
                    });
                    if (selectedOpt) {
                        selectedOpt.classList.add('active');
                        var checkIcon = document.createElement('i');
                        checkIcon.className = 'bi bi-check2 ms-auto';
                        selectedOpt.appendChild(checkIcon);
                    }
                })
                .catch(function(err) {
                    console.error('Language switch failed:', err);
                    if (articleEl) { articleEl.classList.remove('loading'); }
                });
            });
        });
    }

    // ── Live search (enhanced with highlights & keyboard nav) ──
    var searchInput = document.getElementById('docs-search-input');
    var searchResults = document.getElementById('docs-search-results');
    var searchDebounce = null;
    var activeResultIndex = -1;

    // Tag label map for match badges
    var tagLabels = {
        feature: { label: 'Feature', icon: 'bi-star-fill', cls: 'tag-feature' },
        keyword: { label: 'Keyword', icon: 'bi-tag-fill', cls: 'tag-keyword' },
        setting: { label: 'Setting', icon: 'bi-gear-fill', cls: 'tag-setting' },
        menu:    { label: 'Menu',    icon: 'bi-list',      cls: 'tag-menu' },
        content: { label: 'Content', icon: 'bi-file-text', cls: 'tag-content' },
        tab:     { label: 'Tab',     icon: 'bi-folder',    cls: 'tag-tab' }
    };

    function renderSearchItem(item, idx) {
        var html = '<a class="search-item" href="' + baseRoute + '/' + item.slug + '" data-idx="' + idx + '">';
        html += '<div class="search-item-icon"><i class="bi ' + item.icon + '"></i></div>';
        html += '<div class="search-item-body">';

        // Title with highlight marks (already has <mark> from server)
        html += '<div class="search-title">' + (item.highlightTitle || item.title) + '</div>';

        // Tab category
        html += '<div class="search-cat"><i class="bi bi-folder2-open"></i> ' + item.tab + '</div>';

        // Menu path (if matched)
        if (item.menu && item.matchTags && item.matchTags.indexOf('menu') !== -1) {
            html += '<div class="search-menu"><i class="bi bi-signpost-split"></i> ' + item.menu + '</div>';
        }

        // Snippet with highlights (already has <mark> from server)
        if (item.snippet) {
            html += '<div class="search-snippet">' + item.snippet + '</div>';
        }

        // Match type badges
        if (item.matchTags && item.matchTags.length) {
            html += '<div class="search-tags">';
            item.matchTags.forEach(function(tag) {
                var info = tagLabels[tag] || { label: tag, icon: 'bi-dot', cls: '' };
                html += '<span class="search-tag ' + info.cls + '">';
                html += '<i class="bi ' + info.icon + '"></i> ' + info.label;
                html += '</span>';
            });

            // Score badge
            html += '<span class="search-score">' + item.score + '</span>';
            html += '</div>';
        }

        html += '</div></a>';
        return html;
    }

    function setActiveResult(idx) {
        var items = searchResults.querySelectorAll('.search-item');
        items.forEach(function(el) { el.classList.remove('kb-active'); });
        if (idx >= 0 && idx < items.length) {
            items[idx].classList.add('kb-active');
            items[idx].scrollIntoView({ block: 'nearest' });
        }
        activeResultIndex = idx;
    }

    function doSearch(q) {
        var url = searchUrl + '?q=' + encodeURIComponent(q);
        // Both public and auth use AJAX live search
        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            activeResultIndex = -1;
            if (!data.length) {
                searchResults.innerHTML = '<div class="search-empty">' +
                    '<i class="bi bi-search"></i> No results for "<strong>' +
                    q.replace(/</g, '&lt;') + '</strong>"' +
                    '<div class="search-empty-hint">Try different keywords, wildcards (*), or partial words</div>' +
                    '</div>';
                searchResults.style.display = 'block';
                return;
            }
            var html = '<div class="search-results-header">' +
                '<span>' + data.length + ' result' + (data.length > 1 ? 's' : '') + '</span>' +
                '<kbd>↑↓</kbd> navigate <kbd>↵</kbd> open <kbd>Esc</kbd> close' +
                '</div>';
            data.forEach(function(item, idx) {
                html += renderSearchItem(item, idx);
            });
            searchResults.innerHTML = html;
            searchResults.style.display = 'block';
        })
        .catch(function() {
            searchResults.style.display = 'none';
        });
    }

    if (searchInput && searchResults) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchDebounce);
            var q = this.value.trim();
            if (q.length < 2) {
                searchResults.style.display = 'none';
                searchResults.innerHTML = '';
                activeResultIndex = -1;
                return;
            }
            searchDebounce = setTimeout(function() { doSearch(q); }, 300);
        });

        // Keyboard navigation in search results
        searchInput.addEventListener('keydown', function(e) {
            var items = searchResults.querySelectorAll('.search-item');
            if (!items.length || searchResults.style.display === 'none') return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                var next = activeResultIndex + 1;
                if (next >= items.length) next = 0;
                setActiveResult(next);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                var prev = activeResultIndex - 1;
                if (prev < 0) prev = items.length - 1;
                setActiveResult(prev);
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (activeResultIndex >= 0 && items[activeResultIndex]) {
                    items[activeResultIndex].click();
                } else if (items.length) {
                    items[0].click();
                }
            }
        });

        // Hover sets active state too
        searchResults.addEventListener('mouseover', function(e) {
            var item = e.target.closest('.search-item');
            if (item) {
                var idx = parseInt(item.getAttribute('data-idx'), 10);
                if (!isNaN(idx)) setActiveResult(idx);
            }
        });

        // Hide results when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchResults.contains(e.target) && e.target !== searchInput) {
                searchResults.style.display = 'none';
                activeResultIndex = -1;
            }
        });

        // Show results again when focusing back on input
        searchInput.addEventListener('focus', function() {
            if (searchResults.innerHTML && this.value.trim().length >= 2) {
                searchResults.style.display = 'block';
            }
        });

        // Focus search on Ctrl+K
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                searchInput.focus();
                searchInput.select();
            }
            if (e.key === 'Escape') {
                searchResults.style.display = 'none';
                searchInput.blur();
                activeResultIndex = -1;
            }
        });
    }

    // ── Smooth scroll for anchor links within article ───
    if (articleEl) {
        articleEl.addEventListener('click', function(e) {
            var link = e.target.closest('a');
            if (link && link.getAttribute('href') && link.getAttribute('href').startsWith('#')) {
                e.preventDefault();
                var target = document.querySelector(link.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    }

    // ── Contact Superadmin Form & Conversations ─────────
    function initContactForm() {
        var form = document.getElementById('contact-admin-form');
        var statusDiv = document.getElementById('ca-form-status');
        var submitBtn = document.getElementById('ca-submit-btn');
        var convContainer = document.getElementById('ca-conversations');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                var url = form.getAttribute('data-url');
                var subject = document.getElementById('ca-subject').value.trim();
                var message = document.getElementById('ca-message').value.trim();

                if (!subject || !message) return;

                // Disable button
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Sending...';

                var formData = new FormData();
                formData.append('subject', subject);
                formData.append('message', message);

                var fetchOpts = {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                };
                if (csrfToken) {
                    fetchOpts.headers['X-CSRF-TOKEN'] = csrfToken;
                }

                fetch(url, fetchOpts)
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="bi bi-send"></i> Send Message';

                    if (data.success) {
                        statusDiv.className = 'ca-form-status ca-success';
                        statusDiv.innerHTML = '<i class="bi bi-check-circle-fill"></i> ' + data.msg;
                        statusDiv.style.display = 'block';
                        form.reset();
                        // Reload conversations
                        loadConversations();
                        // Auto-hide success after 5s
                        setTimeout(function() { statusDiv.style.display = 'none'; }, 5000);
                    } else {
                        statusDiv.className = 'ca-form-status ca-error';
                        statusDiv.innerHTML = '<i class="bi bi-exclamation-triangle-fill"></i> ' + (data.msg || 'Failed to send.');
                        statusDiv.style.display = 'block';
                    }
                })
                .catch(function(err) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="bi bi-send"></i> Send Message';
                    statusDiv.className = 'ca-form-status ca-error';
                    statusDiv.innerHTML = '<i class="bi bi-exclamation-triangle-fill"></i> Network error. Please try again.';
                    statusDiv.style.display = 'block';
                });
            });
        }

        // Load conversation history
        if (convContainer) {
            loadConversations();
        }
    }

    function loadConversations() {
        var convContainer = document.getElementById('ca-conversations');
        if (!convContainer) return;

        var url = convContainer.getAttribute('data-url');
        if (!url || url === '#') return;

        convContainer.innerHTML = '<div class="ca-loading"><div class="ca-spinner"></div></div>';

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(function(r) { return r.json(); })
        .then(function(threads) {
            if (!threads.length) {
                convContainer.innerHTML = '<div class="ca-empty"><i class="bi bi-chat-square-text"></i><p>No conversations yet. Send your first message above!</p></div>';
                return;
            }

            var html = '';
            threads.forEach(function(thread) {
                var statusClass = 'ca-status-' + thread.status;
                var statusLabel = thread.status.charAt(0).toUpperCase() + thread.status.slice(1);

                html += '<div class="ca-thread ' + statusClass + '">';
                html += '<div class="ca-thread-header">';
                html += '<div class="ca-thread-subject">' + escHtml(thread.subject) + '</div>';
                html += '<span class="ca-thread-status">' + statusLabel + '</span>';
                html += '</div>';
                html += '<div class="ca-thread-meta">' + thread.created_at + '</div>';

                // Render messages in thread
                html += '<div class="ca-thread-messages">';
                thread.messages.forEach(function(msg) {
                    var msgClass = msg.is_mine ? 'ca-msg-mine' : 'ca-msg-admin';
                    html += '<div class="ca-msg ' + msgClass + '">';
                    html += '<div class="ca-msg-sender">';
                    html += '<i class="bi ' + (msg.is_mine ? 'bi-person-circle' : 'bi-shield-check') + '"></i> ';
                    html += escHtml(msg.sender);
                    if (!msg.is_mine) html += ' <span class="ca-admin-badge">Admin</span>';
                    html += '<span class="ca-msg-time">' + msg.created_at + '</span>';
                    html += '</div>';
                    html += '<div class="ca-msg-body">' + escHtml(msg.message) + '</div>';
                    if (msg.read_at) {
                        html += '<div class="ca-msg-read"><i class="bi bi-check2-all"></i> Read</div>';
                    }
                    html += '</div>';
                });
                html += '</div>';
                html += '</div>';
            });

            convContainer.innerHTML = html;
        })
        .catch(function() {
            convContainer.innerHTML = '<div class="ca-empty ca-error-state"><i class="bi bi-exclamation-circle"></i><p>Could not load conversations.</p></div>';
        });
    }

    function escHtml(str) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(str || ''));
        return div.innerHTML;
    }

    // Init contact form if already on that page
    initContactForm();

})();
</script>
