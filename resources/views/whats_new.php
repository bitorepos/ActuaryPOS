
<?php $__env->startSection('title', "What's New in " . $app_display_name); ?>

<?php $__env->startSection('css'); ?>
<style>
    .whats-new-page {
        max-width: 1180px;
        margin: 0 auto;
        padding: 18px 15px 32px;
    }
    .wn-hero {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 22px;
    }
    .wn-hero-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 10px;
    }
    .wn-hero-icon {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #eef7ff;
        color: #0b76c5;
        font-size: 24px;
        flex: 0 0 auto;
    }
    .wn-hero h1 {
        margin: 0;
        font-size: 2rem;
        line-height: 1.15;
        font-weight: 800;
        color: #111827;
        letter-spacing: 0;
    }
    .wn-hero p {
        margin: 0;
        color: #4b5563;
        font-size: 0.98rem;
        max-width: 650px;
    }
    .wn-version-flow {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }
    .wn-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 999px;
        padding: 8px 12px;
        font-weight: 700;
        font-size: 0.84rem;
        border: 1px solid #d1d5db;
        background: #f9fafb;
        color: #1f2937;
        white-space: nowrap;
    }
    .wn-pill-previous {
        background: #eef7ff;
        border-color: #bfdbfe;
        color: #075985;
    }
    .wn-pill-current {
        background: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }
    .wn-flow-arrow {
        color: #9ca3af;
        font-size: 1.1rem;
    }
    .wn-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: flex-end;
        margin-top: 14px;
    }
    .wn-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 8px;
        padding: 9px 13px;
        font-weight: 700;
        font-size: 0.86rem;
        text-decoration: none;
    }
    .wn-action-primary {
        background: #dc3545;
        color: #fff;
        border: 1px solid #dc3545;
    }
    .wn-action-primary:hover {
        color: #fff;
        background: #bb2d3b;
        border-color: #bb2d3b;
    }
    .wn-action-secondary {
        background: #fff;
        color: #0b76c5;
        border: 1px solid #bfdbfe;
    }
    .wn-action-secondary:hover {
        color: #075985;
        background: #eef7ff;
    }
    .wn-notice {
        border-radius: 8px;
        border: 1px solid #fde68a;
        background: #fffbeb;
        color: #92400e;
        padding: 12px 14px;
        margin-bottom: 18px;
        display: flex;
        gap: 10px;
        align-items: flex-start;
        font-weight: 600;
    }
    .wn-release {
        margin-bottom: 24px;
    }
    .wn-release-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 12px;
        padding: 0 2px;
    }
    .wn-release-title {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
    }
    .wn-release-title h2 {
        margin: 0;
        font-size: 1.24rem;
        font-weight: 800;
        color: #111827;
        letter-spacing: 0;
    }
    .wn-release-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #17a673;
        box-shadow: 0 0 0 4px rgba(23, 166, 115, 0.14);
        flex: 0 0 auto;
    }
    .wn-release-date {
        color: #6b7280;
        font-weight: 700;
        font-size: 0.85rem;
        white-space: nowrap;
    }
    .wn-module-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }
    .wn-module-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 16px;
        min-width: 0;
    }
    .wn-module-top {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 12px;
    }
    .wn-module-icon {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #0f766e;
        background: #ccfbf1;
        flex: 0 0 auto;
    }
    .wn-module-top h3 {
        margin: 3px 0 0;
        font-size: 1rem;
        line-height: 1.3;
        font-weight: 800;
        color: #111827;
        letter-spacing: 0;
    }
    .wn-section + .wn-section {
        margin-top: 13px;
    }
    .wn-section h4 {
        margin: 0 0 7px;
        color: #0b76c5;
        font-size: 0.82rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0;
    }
    .wn-section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .wn-section li {
        position: relative;
        padding-left: 18px;
        margin-bottom: 8px;
        color: #374151;
        line-height: 1.45;
        font-size: 0.92rem;
    }
    .wn-section li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0.58em;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #f59e0b;
    }
    .wn-empty {
        background: #fff;
        border: 1px dashed #cbd5e1;
        border-radius: 8px;
        padding: 26px;
        text-align: center;
        color: #475569;
    }
    html.dark-theme .wn-hero,
    html.dark-theme .wn-module-card,
    html.dark-theme .wn-empty {
        background: #1f2937;
        border-color: #374151;
    }
    html.dark-theme .wn-hero h1,
    html.dark-theme .wn-release-title h2,
    html.dark-theme .wn-module-top h3 {
        color: #f9fafb;
    }
    html.dark-theme .wn-hero p,
    html.dark-theme .wn-release-date,
    html.dark-theme .wn-section li,
    html.dark-theme .wn-empty {
        color: #d1d5db;
    }
    html.dark-theme .wn-pill {
        background: #111827;
        border-color: #374151;
        color: #e5e7eb;
    }
    html.dark-theme .wn-pill-previous {
        background: #082f49;
        border-color: #075985;
        color: #bfdbfe;
    }
    html.dark-theme .wn-pill-current {
        background: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }
    html.dark-theme .wn-action-secondary {
        background: #111827;
        color: #93c5fd;
        border-color: #334155;
    }
    html.dark-theme .wn-action-secondary:hover {
        background: #1e3a5f;
        color: #bfdbfe;
    }
    html.dark-theme .wn-notice {
        background: rgba(245, 158, 11, 0.12);
        border-color: rgba(245, 158, 11, 0.35);
        color: #fcd34d;
    }
    @media (max-width: 991.98px) {
        .wn-hero {
            align-items: flex-start;
            flex-direction: column;
        }
        .wn-version-flow,
        .wn-actions {
            justify-content: flex-start;
        }
        .wn-module-grid {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 575.98px) {
        .whats-new-page {
            padding: 12px 10px 24px;
        }
        .wn-hero {
            padding: 18px;
        }
        .wn-hero-title {
            align-items: flex-start;
        }
        .wn-hero h1 {
            font-size: 1.55rem;
        }
        .wn-release-header {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content content-custom no-print">
    <div class="whats-new-page">
        <div class="wn-hero">
            <div>
                <div class="wn-hero-title">
                    <span class="wn-hero-icon"><i class="bi bi-stars"></i></span>
                    <h1>What's New in <?php echo e($app_display_name, false); ?></h1>
                </div>
                <p>
                    Simple user guide from version <?php echo e($whats_new_from_display_version ?: 'Unknown', false); ?> to version <?php echo e($app_display_version, false); ?>. These notes explain what users can do in everyday wording.
                </p>
            </div>
            <div>
                <div class="wn-version-flow">
                    <span class="wn-pill wn-pill-previous">
                        <i class="bi bi-hdd-stack"></i>
                        <?php echo e($from_version_label, false); ?> <?php echo e($whats_new_from_display_version ?: 'Unknown', false); ?>

                    </span>
                    <i class="bi bi-arrow-right wn-flow-arrow"></i>
                    <span class="wn-pill wn-pill-current">
                        <i class="bi bi-box-arrow-down"></i>
                        Current <?php echo e($app_display_version, false); ?>

                    </span>
                </div>
                <div class="wn-actions">
                    <?php if($is_update_available): ?>
                        <a href="<?php echo e(route('install.updateConfirmation'), false); ?>" class="wn-action-btn wn-action-primary">
                            <i class="fas fa-sync-alt"></i>
                            Update Now
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo e(url('documentation/version-history'), false); ?>" class="wn-action-btn wn-action-secondary">
                        <i class="bi bi-clock-history"></i>
                        Version History
                    </a>
                </div>
            </div>
        </div>

        <?php if($showing_fallback_notes): ?>
            <div class="wn-notice">
                <i class="bi bi-info-circle"></i>
                <span>No exact guide notes were found for this installed-to-current version range, so the latest available user guide notes are shown.</span>
            </div>
        <?php endif; ?>

        <?php $__empty_18 = true; $__currentLoopData = $release_notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $release): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
            <section class="wn-release">
                <div class="wn-release-header">
                    <div class="wn-release-title">
                        <span class="wn-release-dot"></span>
                        <h2>Version <?php echo e($release['label'], false); ?></h2>
                    </div>
                    <?php if(!empty($release['release_date'])): ?>
                        <span class="wn-release-date">
                            <i class="bi bi-calendar3"></i>
                            <?php echo e($release['release_date'], false); ?>

                        </span>
                    <?php endif; ?>
                </div>

                <div class="wn-module-grid">
                    <?php $__currentLoopData = $release['modules']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="wn-module-card">
                            <div class="wn-module-top">
                                <span class="wn-module-icon"><i class="bi bi-lightning-charge-fill"></i></span>
                                <h3><?php echo e($module['name'], false); ?></h3>
                            </div>

                            <?php $__currentLoopData = $module['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="wn-section">
                                    <h4><?php echo e($section['title'], false); ?></h4>
                                    <ul>
                                        <?php $__currentLoopData = $section['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($item, false); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
            <div class="wn-empty">
                <h3>No guide notes found</h3>
                <p class="mb-0">Add simple user guide notes in <code>cp-docs/VERSION_LOG.md</code> to show them here.</p>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>