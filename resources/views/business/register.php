
<?php $__env->startSection('title', __('lang_v1.register')); ?>

<?php $__env->startSection('css'); ?>
<style>
/* ===== Modern Register Page ===== */

/* --- Override auth3 layout wrappers --- */
body { background: var(--theme-primary-light, #f0f4f8) !important; }
.wrapper { padding: 0 !important; margin: 0 !important; }
.authentication-content,
.authentication-content .container-fluid,
.authentication-content .container-fluid > .row,
.authentication-content .container-fluid > .row > .col-12 {
    padding: 0 !important;
    margin: 0 !important;
    max-width: 100% !important;
    width: 100% !important;
}
/* Hide auth3 built-in top bar — register page has its own */
.authentication-content .container-fluid > .row > .col-12 > .d-flex.justify-content-between.align-items-center.p-3 {
    display: none !important;
}

/* --- Page Layout --- */
.register-page-wrap {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* Top bar */
.register-topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: .75rem 2rem;
    background: #fff;
    border-bottom: 1px solid #e5e7eb;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
    flex-shrink: 0;
}
.register-topbar .topbar-brand {
    display: flex;
    align-items: center;
    gap: .75rem;
    text-decoration: none;
    color: var(--bs-primary);
    font-weight: 700;
    font-size: 1.15rem;
}
.register-topbar .topbar-brand img {
    max-height: 36px;
    object-fit: contain;
}
.register-topbar .topbar-actions {
    display: flex;
    align-items: center;
    gap: .75rem;
}

/* Hero banner */
.register-hero {
    background: linear-gradient(135deg, var(--bs-primary) 0%, var(--theme-primary-dark) 50%, var(--theme-sidebar-bg) 100%);
    padding: 2.5rem 2rem 2rem;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
    flex-shrink: 0;
}
.register-hero::before {
    content: '';
    position: absolute;
    top: -60px;
    right: -60px;
    width: 220px;
    height: 220px;
    border-radius: 50%;
    background: rgba(255,255,255,.04);
}
.register-hero::after {
    content: '';
    position: absolute;
    bottom: -80px;
    left: -40px;
    width: 280px;
    height: 280px;
    border-radius: 50%;
    background: rgba(255,255,255,.03);
}
.register-hero h1 {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: .35rem;
    position: relative;
    z-index: 2;
}
.register-hero p {
    opacity: .85;
    font-size: 1rem;
    max-width: 460px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

/* Form card */
.register-form-card {
    flex: 1;
    max-width: 960px;
    width: 100%;
    margin: -1.5rem auto 2rem;
    position: relative;
    z-index: 10;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0,0,0,.08), 0 1px 4px rgba(0,0,0,.04);
    overflow: hidden;
    padding: 0;
}

/* === jQuery Steps Wizard Override === */
.register-form-card .wizard > .steps {
    padding: 0;
    margin: 0;
}
.register-form-card .wizard > .steps > ul {
    display: flex !important;
    list-style: none;
    padding: 0;
    margin: 0;
    background: var(--theme-primary-light, #f0f4f8);
    border-bottom: 1px solid #e5e7eb;
}
.register-form-card .wizard > .steps > ul > li {
    flex: 1;
    width: auto !important;
    float: none !important;
    text-align: center;
    position: relative;
}
.register-form-card .wizard > .steps > ul > li a {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    padding: 1rem .75rem;
    font-size: .9rem;
    font-weight: 600;
    color: #6b7280;
    text-decoration: none;
    border-bottom: 3px solid transparent;
    transition: color .2s, border-color .2s, background .2s;
    cursor: default;
}
.register-form-card .wizard > .steps > ul > li a .number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #d1d5db;
    color: #fff;
    font-size: .8rem;
    font-weight: 700;
    transition: background .2s;
    flex-shrink: 0;
}
.register-form-card .wizard > .steps > ul > li.current a {
    color: var(--bs-primary);
    border-bottom-color: var(--bs-primary);
    background: rgba(var(--bs-primary-rgb), .04);
}
.register-form-card .wizard > .steps > ul > li.current a .number {
    background: var(--bs-primary);
}
.register-form-card .wizard > .steps > ul > li.done a {
    color: var(--bs-success, #28a745);
}
.register-form-card .wizard > .steps > ul > li.done a .number {
    background: var(--bs-success, #28a745);
}

/* Content area */
.register-form-card .wizard > .content {
    background: #fff !important;
    padding: 2rem 2.5rem !important;
    min-height: 0 !important;
    overflow: visible !important;
    position: relative !important;
}
.register-form-card .wizard > .content > .body {
    width: 100% !important;
    height: auto !important;
    padding: 0 !important;
    position: relative !important;
    float: none !important;
}

/* Actions row (Previous / Next / Finish) */
.register-form-card .wizard > .actions {
    padding: 1rem 2.5rem 1.5rem;
    background: #fff;
    border-top: 1px solid #f3f4f6;
}
.register-form-card .wizard > .actions > ul {
    display: flex;
    justify-content: space-between;
    list-style: none;
    padding: 0;
    margin: 0;
}
.register-form-card .wizard > .actions > ul > li > a {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    padding: .65rem 1.75rem;
    border-radius: 10px;
    font-size: .95rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: transform .15s, box-shadow .2s, opacity .2s;
}
/* Next / Finish button */
.register-form-card .wizard > .actions > ul > li:last-child > a,
.register-form-card .wizard > .actions > ul > li:nth-child(2) > a {
    background: linear-gradient(135deg, var(--bs-primary) 0%, var(--theme-primary-dark) 100%) !important;
    color: #fff !important;
    box-shadow: 0 4px 14px rgba(var(--bs-primary-rgb), .3);
    border: none;
}
.register-form-card .wizard > .actions > ul > li:last-child > a:hover,
.register-form-card .wizard > .actions > ul > li:nth-child(2) > a:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(var(--bs-primary-rgb), .35);
    opacity: .95;
}
/* Previous button */
.register-form-card .wizard > .actions > ul > li:first-child > a {
    background: transparent !important;
    color: #6b7280 !important;
    border: 1.5px solid #d1d5db !important;
}
.register-form-card .wizard > .actions > ul > li:first-child > a:hover {
    background: #f3f4f6 !important;
    color: #374151 !important;
}
/* Hide disabled links */
.register-form-card .wizard > .actions > ul > li.disabled {
    display: none;
}

/* === Form Fields Styling === */
.register-form-card legend {
    color: var(--bs-primary) !important;
    font-size: 1.1rem;
    font-weight: 700;
    border-bottom: 2px solid var(--theme-primary-light, #e8f0fb);
    padding-bottom: .5rem;
    margin-bottom: 1.25rem;
    margin-top: .5rem;
}
.register-form-card label {
    color: #374151 !important;
    font-size: .85rem;
    font-weight: 600;
    margin-bottom: .3rem;
}
.register-form-card .form-control,
.register-form-card .form-select {
    height: 44px;
    border: 1.5px solid #e5e7eb;
    border-radius: 10px;
    font-size: .92rem;
    background: #f9fafb;
    transition: border-color .2s, box-shadow .2s, background .2s;
}
.register-form-card .form-control:focus,
.register-form-card .form-select:focus {
    border-color: var(--bs-primary);
    box-shadow: 0 0 0 3px rgba(var(--bs-primary-rgb), .1);
    background: #fff;
}
.register-form-card .input-group-text {
    background: var(--theme-primary-light, #f0f4f8);
    border: 1.5px solid #e5e7eb;
    border-right: none;
    border-radius: 10px 0 0 10px;
    color: var(--bs-primary);
    font-size: .9rem;
    min-width: 42px;
    justify-content: center;
}
.register-form-card .input-group .form-control,
.register-form-card .input-group .form-select {
    border-radius: 0 10px 10px 0;
    border-left-color: transparent;
}
.register-form-card .input-group .form-control:focus,
.register-form-card .input-group .form-select:focus {
    border-left-color: var(--bs-primary);
}

/* Validation */
.register-form-card label.error {
    color: #ef4444 !important;
    font-size: .8rem;
    font-weight: 500;
    margin-top: .2rem;
}
.register-form-card .form-control.error,
.register-form-card .form-select.error {
    border-color: #ef4444;
}

/* File input */
.register-form-card input[type="file"] {
    font-size: .85rem;
    padding: .5rem;
}

/* Select2 override */
.register-form-card .select2-container--default .select2-selection--single {
    height: 44px !important;
    border: 1.5px solid #e5e7eb !important;
    border-radius: 0 10px 10px 0 !important;
    background: #f9fafb !important;
    padding-top: 6px;
}
.register-form-card .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 42px !important;
}
.register-form-card .select2-container--default.select2-container--focus .select2-selection--single,
.register-form-card .select2-container--default.select2-container--open .select2-selection--single {
    border-color: var(--bs-primary) !important;
    box-shadow: 0 0 0 3px rgba(var(--bs-primary-rgb), .1);
}

/* T&C link */
.register-form-card .terms_condition {
    color: var(--bs-primary);
    font-weight: 600;
}

/* jQuery Steps h3 headings (step labels) — hidden by plugin, but ensure no leftover styling */
.register-form-card h3 {
    display: none;
}

/* Footer */
.register-footer {
    text-align: center;
    padding: 1rem;
    color: #9ca3af;
    font-size: .82rem;
    flex-shrink: 0;
}
.register-footer a {
    color: var(--bs-primary);
    text-decoration: none;
    font-weight: 600;
}

/* === Responsive === */
@media (max-width: 767.98px) {
    .register-hero { padding: 1.75rem 1rem 1.5rem; }
    .register-hero h1 { font-size: 1.4rem; }
    .register-form-card { margin: -1rem .75rem 1.5rem; border-radius: 12px; }
    .register-form-card .wizard > .content { padding: 1.25rem 1rem !important; }
    .register-form-card .wizard > .actions { padding: .75rem 1rem 1rem; }
    .register-form-card .wizard > .steps > ul > li a { padding: .75rem .3rem; font-size: .75rem; gap: .3rem; }
    .register-form-card .wizard > .steps > ul > li a .number { width: 24px; height: 24px; font-size: .7rem; }
    .register-topbar { padding: .5rem 1rem; }
}
@media (max-width: 575.98px) {
    .register-form-card .wizard > .steps > ul { flex-wrap: nowrap; overflow-x: auto; }
    .register-form-card .wizard > .steps > ul > li { min-width: 100px; }
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="register-page-wrap">
    
    <div class="register-topbar">
        <a href="/" class="topbar-brand">
            <?php if(file_exists(public_path('uploads/logo.png'))): ?>
                <img src="/uploads/logo.png" alt="Logo">
            <?php endif; ?>
            <span><?php echo e(config('app.name', 'BitorePOS'), false); ?></span>
        </a>
        <div class="topbar-actions">
            <select class="form-select form-select-sm" id="change_lang" style="min-width: 130px; border-radius: 8px;">
                <?php $__currentLoopData = config('constants.langs'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key, false); ?>" <?php if((empty(request()->lang) && config('app.locale') == $key) || request()->lang == $key): ?> selected <?php endif; ?>>
                        <?php echo e($val['full_name'], false); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php if(Route::has('pricing') && config('app.env') != 'demo' && empty(\App\System::getProperty('disable_pricing'))): ?>
                <a class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;"
                    href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PricingController::class, 'index']), false); ?>"><?php echo app('translator')->get('superadmin::lang.pricing'); ?></a>
            <?php endif; ?>
            <span class="text-muted d-none d-sm-inline"><?php echo app('translator')->get('business.already_registered'); ?></span>
            <a href="<?php echo e(action([\App\Http\Controllers\Auth\LoginController::class, 'login']), false); ?><?php if(!empty(request()->lang)): ?><?php echo e('?lang=' . request()->lang, false); ?><?php endif; ?>" class="btn btn-sm btn-primary" style="border-radius: 8px;"><?php echo app('translator')->get('business.sign_in'); ?></a>
        </div>
    </div>

    
    <div class="register-hero">
        <h1><?php echo app('translator')->get('business.register_and_get_started_in_minutes'); ?></h1>
        <p><?php echo app('translator')->get('lang_v1.register_page_subtitle'); ?></p>
    </div>

    
    <div class="register-form-card">
        <?php echo Form::open(['url' => route('business.postRegister'), 'method' => 'post',
                        'id' => 'business_register_form', 'files' => true, 'data-email-required' => !empty($is_email_required) ? 1 : 0]); ?>

            <?php echo $__env->make('business.partials.register_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo Form::hidden('package_id', $package_id); ?>

        <?php echo Form::close(); ?>

    </div>

    
    <div class="register-footer">
        &copy; <?php echo e(date('Y'), false); ?> <?php echo e(config('app.name', 'BitorePOS'), false); ?>. <?php echo app('translator')->get('lang_v1.all_rights_reserved', [], 'All rights reserved.'); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#change_lang').change(function(){
            var registerUrl = <?php echo json_encode(registration_url(), 15, 512) ?>;
            var separator = registerUrl.indexOf('?') === -1 ? '?' : '&';
            window.location = registerUrl + separator + 'lang=' + encodeURIComponent($(this).val());
        });
    })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>