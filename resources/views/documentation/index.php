
<?php $__env->startSection('title', $pageTitle . ' - Documentation'); ?>

<?php $__env->startSection('css'); ?>
<?php echo $__env->make('documentation.partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="docs-wrapper" data-lang="<?php echo e($currentLang, false); ?>" data-dir="<?php echo e($currentDir, false); ?>" data-theme="<?php echo e($docsThemeColor ?? '', false); ?>">
    
    <div class="docs-topbar">
        <div class="docs-topbar-inner">
            <a href="<?php echo e(route('documentation.index'), false); ?>" class="docs-brand">
                <i class="bi bi-book-half"></i>
                <span><?php echo e(config('app.name', 'BitorePOS'), false); ?> <?php echo e($uiStrings['docs'], false); ?></span>
            </a>
            <div class="docs-search-wrapper">
                <div class="docs-search-box">
                    <i class="bi bi-search docs-search-icon"></i>
                    <input type="text"
                           id="docs-search-input"
                           class="docs-search-input"
                           placeholder="<?php echo e($uiStrings['search_placeholder'], false); ?>"
                           value="<?php echo e($searchQuery, false); ?>"
                           autocomplete="off">
                    <kbd class="docs-search-kbd">Ctrl+K</kbd>
                </div>
                <div class="docs-search-results" id="docs-search-results" style="display:none;"></div>
            </div>
            <div class="docs-topbar-actions">
                
                <div class="docs-lang-switcher" id="docs-lang-switcher">
                    <button class="docs-lang-btn" id="docs-lang-btn" title="<?php echo e($uiStrings['language'], false); ?>">
                        <span class="docs-lang-flag"><?php echo e($languages[$currentLang]['flag'], false); ?></span>
                        <span class="docs-lang-code"><?php echo e(strtoupper($currentLang), false); ?></span>
                        <i class="bi bi-chevron-down docs-lang-chevron"></i>
                    </button>
                    <div class="docs-lang-dropdown" id="docs-lang-dropdown">
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $langInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button class="docs-lang-option <?php echo e($code === $currentLang ? 'active' : '', false); ?>"
                                    data-lang="<?php echo e($code, false); ?>"
                                    data-dir="<?php echo e($langInfo['dir'], false); ?>">
                                <span class="docs-lang-flag"><?php echo e($langInfo['flag'], false); ?></span>
                                <span class="docs-lang-name"><?php echo e($langInfo['native'], false); ?></span>
                                <?php if($code === $currentLang): ?>
                                    <i class="bi bi-check2 ms-auto"></i>
                                <?php endif; ?>
                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="docs-body">
        
        <aside class="docs-sidebar" id="docs-sidebar">
            <div class="docs-tab-pills">
                <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabSlug => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(($tab['type'] ?? 'tab') !== 'module-tab'): ?>
                        <?php if(!empty($tab['link_slug'])): ?>
                            <a href="<?php echo e(route('documentation.index', $tab['link_slug']), false); ?>"
                               class="docs-tab-pill docs-tab-pill-link <?php echo e($tabSlug === $activeTab ? 'active' : '', false); ?>"
                               data-tab="<?php echo e($tabSlug, false); ?>"
                               data-slug="<?php echo e($tab['link_slug'], false); ?>"
                               title="<?php echo e($tab['label'], false); ?>">
                                <i class="bi <?php echo e($tab['icon'], false); ?>"></i>
                                <span><?php echo e($tab['label'], false); ?></span>
                            </a>
                        <?php else: ?>
                            <button class="docs-tab-pill <?php echo e($tabSlug === $activeTab ? 'active' : '', false); ?>"
                                    data-tab="<?php echo e($tabSlug, false); ?>"
                                    title="<?php echo e($tab['label'], false); ?>">
                                <i class="bi <?php echo e($tab['icon'], false); ?>"></i>
                                <span><?php echo e($tab['label'], false); ?></span>
                            </button>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <?php $hasModuleTabs = collect($tabs)->where('type', 'module-tab')->isNotEmpty(); ?>
            <?php if($hasModuleTabs): ?>
            <div class="docs-module-pills-wrapper">
                <button class="docs-module-pills-toggle" id="docs-module-pills-toggle" type="button">
                    <i class="bi bi-puzzle"></i>
                    <span>Modules</span>
                    <span class="docs-module-count"><?php echo e(collect($tabs)->where('type', 'module-tab')->count(), false); ?></span>
                    <i class="bi bi-chevron-down docs-module-chevron" id="docs-module-chevron"></i>
                </button>
                <div class="docs-module-pills" id="docs-module-pills">
                    <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabSlug => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(($tab['type'] ?? 'tab') === 'module-tab'): ?>
                            <button class="docs-tab-pill docs-module-pill <?php echo e($tabSlug === $activeTab ? 'active' : '', false); ?>"
                                    data-tab="<?php echo e($tabSlug, false); ?>"
                                    title="<?php echo e($tab['label'], false); ?>">
                                <i class="bi <?php echo e($tab['icon'], false); ?>"></i>
                                <span><?php echo e($tab['label'], false); ?></span>
                            </button>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>

            <nav class="docs-nav">
                <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabSlug => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="docs-nav-tab-panel <?php echo e($tabSlug === $activeTab ? 'active' : '', false); ?>"
                         data-tab-panel="<?php echo e($tabSlug, false); ?>">
                        <div class="docs-nav-category">
                            <div class="docs-nav-category-label">
                                <i class="bi <?php echo e($tab['icon'], false); ?>"></i>
                                <?php echo e($tab['label'], false); ?>

                                <span class="docs-item-count"><?php echo e(count($tab['items']), false); ?></span>
                            </div>
                            <ul class="docs-nav-list">
                                <?php $__currentLoopData = $tab['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="docs-nav-item <?php echo e($slug === $activeSlug ? 'active' : '', false); ?>">
                                        <a href="<?php echo e(route('documentation.index', $slug), false); ?>" class="docs-nav-link" data-slug="<?php echo e($slug, false); ?>">
                                            <i class="bi <?php echo e($item['icon'], false); ?>"></i>
                                            <?php echo e($item['title'], false); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </nav>
        </aside>

        
        <main class="docs-content" dir="<?php echo e($currentDir, false); ?>" id="docs-content-main">
            <div class="docs-content-inner">
                
                <?php if($isFallback && $currentLang !== 'en'): ?>
                    <div class="docs-fallback-notice" id="docs-fallback-notice">
                        <i class="bi bi-info-circle"></i>
                        <?php echo e($uiStrings['fallback_notice'], false); ?>

                    </div>
                <?php endif; ?>

                
                <nav aria-label="breadcrumb" class="docs-breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('documentation.index'), false); ?>"><?php echo e($uiStrings['docs'], false); ?></a></li>
                        <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabSlug => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($tab['items'][$activeSlug])): ?>
                                <li class="breadcrumb-item"><?php echo e($tab['label'], false); ?></li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li class="breadcrumb-item active" id="docs-breadcrumb-title"><?php echo e($pageTitle, false); ?></li>
                    </ol>
                </nav>

                
                <?php if(!empty($searchQuery) && !empty($searchResults)): ?>
                    <div class="docs-search-results-page">
                        <h5 class="mb-3">
                            <i class="bi bi-search"></i> <?php echo e($uiStrings['search_results_for'], false); ?> "<?php echo e($searchQuery, false); ?>"
                            <span class="badge bg-primary ms-2"><?php echo e(count($searchResults), false); ?></span>
                        </h5>
                        <?php $__currentLoopData = $searchResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="docs-search-result-item">
                                <a href="<?php echo e(route('documentation.index', $result['slug']), false); ?>">
                                    <i class="bi <?php echo e($result['icon'], false); ?>"></i>
                                    <strong><?php echo e($result['title'], false); ?></strong>
                                    <span class="badge bg-secondary ms-2"><?php echo e($result['tab'], false); ?></span>
                                </a>
                                <?php if(!empty($result['snippet'])): ?>
                                    <p class="docs-search-snippet"><?php echo e($result['snippet'], false); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                
                <article class="docs-article" id="docs-article">
                    <?php echo $content; ?>

                </article>

                
                <?php
                    $tabSlugs = [];
                    if (isset($tabs[$activeTab])) {
                        $tabSlugs = array_keys($tabs[$activeTab]['items']);
                    }
                    $currentIdx = array_search($activeSlug, $tabSlugs);
                    $prevSlug = ($currentIdx !== false && $currentIdx > 0) ? $tabSlugs[$currentIdx - 1] : null;
                    $nextSlug = ($currentIdx !== false && $currentIdx < count($tabSlugs) - 1) ? $tabSlugs[$currentIdx + 1] : null;

                    $findTitle = function($slug) use ($tabs) {
                        foreach ($tabs as $tab) {
                            if (isset($tab['items'][$slug])) return $tab['items'][$slug]['title'];
                        }
                        return '';
                    };
                ?>
                <div class="docs-page-nav">
                    <?php if($prevSlug): ?>
                        <a href="<?php echo e(route('documentation.index', $prevSlug), false); ?>" class="docs-page-nav-link prev" data-nav-slug="<?php echo e($prevSlug, false); ?>">
                            <i class="bi bi-arrow-left"></i>
                            <span>
                                <small><?php echo e($uiStrings['previous'], false); ?></small>
                                <?php echo e($findTitle($prevSlug), false); ?>

                            </span>
                        </a>
                    <?php else: ?>
                        <span></span>
                    <?php endif; ?>
                    <?php if($nextSlug): ?>
                        <a href="<?php echo e(route('documentation.index', $nextSlug), false); ?>" class="docs-page-nav-link next" data-nav-slug="<?php echo e($nextSlug, false); ?>">
                            <span>
                                <small><?php echo e($uiStrings['next'], false); ?></small>
                                <?php echo e($findTitle($nextSlug), false); ?>

                            </span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    <?php endif; ?>
                </div>

                
                <?php echo $__env->make('documentation.partials.need-help', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </main>
    </div>

    
    <button class="docs-sidebar-toggle d-lg-none" id="docs-sidebar-toggle" title="Toggle sidebar">
        <i class="bi bi-list"></i>
    </button>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('documentation.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>