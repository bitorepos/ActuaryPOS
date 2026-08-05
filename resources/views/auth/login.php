
<?php $__env->startSection('title', __('lang_v1.login')); ?>

<?php $__env->startSection('css'); ?>
<style>
/* ===== Modern Login Page ===== */
.login-split {
    display: flex;
    min-height: 100vh;
    width: 100%;
}

/* --- Left Branding Panel --- */
.login-brand-panel {
    flex: 0 0 45%;
    max-width: 45%;
    background: linear-gradient(135deg, var(--bs-primary) 0%, var(--theme-primary-dark) 50%, var(--theme-sidebar-bg) 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    padding: 3rem 2rem;
}

.login-brand-panel::before {
    content: '';
    position: absolute;
    top: -80px;
    right: -80px;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
}
.login-brand-panel::after {
    content: '';
    position: absolute;
    bottom: -120px;
    left: -60px;
    width: 400px;
    height: 400px;
    border-radius: 50%;
    background: rgba(255,255,255,0.03);
}

.brand-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: #fff;
}
.brand-logo-wrap {
    width: 100px;
    height: 100px;
    background: #fff;
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.75rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.15);
}
.brand-logo-wrap img {
    max-width: 70px;
    max-height: 70px;
    object-fit: contain;
}
.brand-logo-wrap .brand-text-logo {
    font-size: 1.5rem;
    font-weight: 700;
    color: #fff;
    letter-spacing: .5px;
    text-shadow: 0 2px 8px rgba(0,0,0,0.45), 0 1px 0 #222;
}
.brand-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: .5rem;
    letter-spacing: -.5px;
    color: #fff;
    text-shadow: 0 2px 8px rgba(0,0,0,0.45), 0 1px 0 #222;
}
.brand-subtitle {
    font-size: 1.05rem;
    opacity: .8;
    line-height: 1.6;
    max-width: 340px;
    margin: 0 auto;
}
.brand-features {
    margin-top: 2.5rem;
    list-style: none;
    padding: 0;
    text-align: left;
}
.brand-features li {
    padding: .55rem 0;
    font-size: .95rem;
    opacity: .85;
    display: flex;
    align-items: center;
    gap: .75rem;
}
.brand-features li i {
    font-size: 1.1rem;
    opacity: .9;
    width: 20px;
    text-align: center;
}
.brand-footer-text {
    position: absolute;
    bottom: 1.5rem;
    left: 0;
    right: 0;
    text-align: center;
    color: rgba(255,255,255,.4);
    font-size: .8rem;
    z-index: 2;
}

/* AI Badge on Login */
.ai-powered-badge-login {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 18px;
    border-radius: 20px;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.25);
    color: #fff;
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    margin-top: 10px;
    margin-bottom: 4px;
    backdrop-filter: blur(8px);
    animation: ai-badge-shimmer 3s ease-in-out infinite;
}
.ai-powered-badge-login i {
    font-size: 1rem;
    animation: ai-brain-pulse 2s ease-in-out infinite;
}
@keyframes ai-badge-shimmer {
    0%, 100% { background: rgba(255,255,255,0.15); }
    50% { background: rgba(255,255,255,0.22); }
}
@keyframes ai-brain-pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.15); }
}

/* --- Right Form Panel --- */
.login-form-panel {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 2rem 1.5rem;
    background: #fff;
    position: relative;
}
.login-form-topbar {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: .75rem 1.5rem;
    z-index: 5;
}
.login-form-container {
    width: 100%;
    max-width: 420px;
}
.login-form-heading {
    font-size: 1.65rem;
    font-weight: 700;
    color: #1a1a2e;
    margin-bottom: .35rem;
}
.login-form-subheading {
    color: #6b7280;
    font-size: .95rem;
    margin-bottom: 2rem;
}

/* Input Groups */
.login-input-group {
    position: relative;
    margin-bottom: 1.25rem;
}
.login-input-group label {
    font-size: .85rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: .4rem;
    display: block;
}
.login-input-icon {
    position: absolute;
    left: 14px;
    bottom: 13px;
    color: #9ca3af;
    font-size: 1rem;
    pointer-events: none;
    transition: color .2s;
}
.login-input-group input.form-control {
    height: 48px;
    padding-left: 42px;
    border: 1.5px solid #e5e7eb;
    border-radius: 12px;
    font-size: .95rem;
    background: #f9fafb;
    transition: border-color .2s, box-shadow .2s, background .2s;
}
.login-input-group input.form-control:focus {
    border-color: var(--bs-primary);
    box-shadow: 0 0 0 3px rgba(var(--bs-primary-rgb),.1);
    background: #fff;
}
.login-input-group input.form-control:focus ~ .login-input-icon {
    color: var(--bs-primary);
}
.login-input-group input.form-control.is-invalid {
    border-color: #ef4444;
}
.login-input-group input.form-control.is-invalid ~ .login-input-icon {
    color: #ef4444;
}

/* Remember / Forgot row */
.login-meta-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}
.login-meta-row .form-check-label {
    font-size: .875rem;
    color: #6b7280;
}
.login-meta-row a {
    font-size: .875rem;
    color: var(--bs-primary);
    text-decoration: none;
    font-weight: 500;
    transition: color .2s;
}
.login-meta-row a:hover { color: var(--theme-primary-dark); }

/* Submit Button */
.btn-login-submit {
    width: 100%;
    height: 48px;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(135deg, var(--bs-primary) 0%, var(--theme-primary-dark) 100%);
    cursor: pointer;
    transition: transform .15s, box-shadow .2s, opacity .2s;
    box-shadow: 0 4px 14px rgba(var(--bs-primary-rgb),.3);
    letter-spacing: .3px;
}
.btn-login-submit:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(var(--bs-primary-rgb),.35);
    opacity: .95;
    color: #fff;
}
.btn-login-submit:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(var(--bs-primary-rgb),.25);
}

/* Register link */
.login-register-link {
    text-align: center;
    margin-top: 1.5rem;
    font-size: .9rem;
    color: #6b7280;
}
.login-register-link a {
    color: var(--bs-primary);
    font-weight: 600;
    text-decoration: none;
}
.login-register-link a:hover { text-decoration: underline; }

/* Alert */
.login-alert {
    border-radius: 12px;
    padding: .75rem 1rem;
    margin-bottom: 1.25rem;
    font-size: .9rem;
    border: none;
}

/* Continue current session */
.continue-login-box {
    margin-bottom: 1.5rem;
}
.continue-login-label {
    color: #6b7280;
    font-size: .9rem;
    font-weight: 600;
    margin-bottom: .6rem;
}
.continue-login-row {
    display: flex;
    align-items: center;
    gap: .75rem;
}
.continue-user-card {
    flex: 1;
    min-width: 0;
    display: flex;
    align-items: center;
    gap: .85rem;
    min-height: 62px;
    padding: .75rem .9rem;
    border: 1.5px solid #e5e7eb;
    border-radius: 14px;
    background: #f9fafb;
    color: #111827;
    text-decoration: none;
    transition: border-color .2s, box-shadow .2s, background .2s, transform .15s;
}
.continue-user-card:hover {
    color: #111827;
    border-color: var(--bs-primary);
    background: #fff;
    box-shadow: 0 8px 22px rgba(17, 24, 39, .08);
    transform: translateY(-1px);
    text-decoration: none;
}
.continue-user-avatar {
    flex: 0 0 42px;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(var(--bs-primary-rgb), .12);
    color: var(--bs-primary);
    font-weight: 700;
    text-transform: uppercase;
}
.continue-user-text {
    min-width: 0;
}
.continue-user-name,
.continue-user-id {
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.continue-user-name {
    font-size: .95rem;
    font-weight: 700;
}
.continue-user-id {
    color: #6b7280;
    font-size: .8rem;
    margin-top: .1rem;
}
.continue-logout-link {
    flex: 0 0 36px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
    text-decoration: none;
    transition: background .2s, color .2s;
}
.continue-logout-link:hover {
    color: #ef4444;
    background: #fee2e2;
}
.login-divider {
    display: flex;
    align-items: center;
    gap: .75rem;
    color: #9ca3af;
    font-size: .82rem;
    margin-top: 1.1rem;
}
.login-divider::before,
.login-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #e5e7eb;
}
.login-divider span {
    white-space: nowrap;
}

/* reCAPTCHA */
.login-recaptcha { margin-bottom: 1.25rem; }

/* --- Mobile First Panel --- */
.login-brand-mobile {
    display: none;
    text-align: center;
    background: linear-gradient(135deg, var(--bs-primary) 0%, var(--theme-primary-dark) 100%);
    padding: 2rem 1.5rem 1.5rem;
    color: #fff;
}
.login-brand-mobile .brand-logo-wrap {
    width: 64px;
    height: 64px;
    border-radius: 16px;
    margin-bottom: 1rem;
}
.login-brand-mobile .brand-logo-wrap img {
    max-width: 44px;
    max-height: 44px;
}
.login-brand-mobile h2 {
    font-size: 1.35rem;
    font-weight: 700;
    margin-bottom: .25rem;
}
.login-brand-mobile p {
    opacity: .8;
    font-size: .9rem;
    margin: 0;
}

/* ===== Responsive ===== */
@media (max-width: 991.98px) {
    .login-split { flex-direction: column; }
    .login-brand-panel { display: none !important; }
    .login-brand-mobile { display: block; }
    .login-form-panel { padding: 2rem 1.25rem; min-height: auto; }
    .login-form-topbar { position: relative; padding: .75rem 0; margin-bottom: .5rem; }
}
@media (max-width: 575.98px) {
    .login-form-container { max-width: 100%; }
    .login-form-heading { font-size: 1.4rem; }
    .login-brand-mobile { padding: 1.5rem 1rem 1.25rem; }
    .continue-login-row { gap: .4rem; }
    .continue-user-card { padding: .7rem; }
}

/* ===== Override auth3 layout wrappers ===== */
body { background: #fff !important; }
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
/* Hide auth3 built-in top bar — login page has its own */
.authentication-content .container-fluid > .row > .col-12 > .d-flex.justify-content-between.align-items-center.p-3 {
    display: none !important;
}
.demo-login{
    padding: 6px 14px;
    font-size: .85rem;
    margin: 0 4px 8px 0;
}

/* ===== Demo Mode Showcase ===== */
.login-split-demo .login-brand-panel {
    align-items: stretch;
    justify-content: center;
    padding: 2.25rem;
    background: linear-gradient(140deg, #0f766e 0%, #2563eb 52%, #111827 100%);
}
.login-split-demo .login-brand-panel::before,
.login-split-demo .login-brand-panel::after {
    display: none;
}
.demo-showcase-content {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 640px;
    margin: 0 auto;
    color: #fff;
}
.demo-showcase-kicker {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .35rem .75rem;
    border: 1px solid rgba(255,255,255,.28);
    border-radius: 8px;
    background: rgba(255,255,255,.14);
    font-size: .82rem;
    font-weight: 700;
}
.demo-showcase-title {
    margin: 1rem 0 .4rem;
    color: #fff;
    font-size: 2rem;
    font-weight: 800;
    letter-spacing: 0;
}
.demo-showcase-copy {
    max-width: 470px;
    margin: 0 0 1.35rem;
    color: rgba(255,255,255,.82);
    line-height: 1.6;
}
.demo-showcase-board {
    width: 100%;
    padding: 1.1rem;
    border-radius: 8px;
    background: rgba(255,255,255,.94);
    color: #111827;
    box-shadow: 0 18px 45px rgba(15,23,42,.2);
}
.demo-showcase-section-title {
    margin-bottom: .75rem;
    color: #374151;
    font-size: .88rem;
    font-weight: 700;
}
.demo-showcase-grid {
    display: flex;
    flex-wrap: wrap;
    gap: .55rem;
}
.demo-showcase-grid .demo-login,
.demo-showcase-grid .demo-doc-link {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    min-height: 38px;
    margin: 0;
    border-radius: 8px;
    white-space: normal;
    text-align: left;
}
.demo-showcase-divider {
    height: 1px;
    margin: 1rem 0;
    background: #e5e7eb;
}
.demo-showcase-note {
    display: flex;
    align-items: center;
    gap: .6rem;
    margin-top: 1rem;
    padding: .75rem .9rem;
    border-radius: 8px;
    background: rgba(255,255,255,.14);
    color: rgba(255,255,255,.9);
    font-size: .9rem;
}
@media (max-width: 991.98px) {
    .login-split-demo .login-brand-panel {
        display: flex !important;
        order: 2;
        flex: 0 0 auto;
        max-width: 100%;
        padding: 1.5rem 1rem;
    }
    .login-split-demo .login-form-panel {
        order: 1;
    }
    .login-split-demo .login-brand-mobile {
        display: none;
    }
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $is_demo = config('app.env') == 'demo';
    $demo_types = array(
        'all_in_one' => 'demo',
        'super_market' => 'grocery',
        'pharmacy' => 'admin-pharmacy',
        'electronics' => 'admin-electronics',
        'services' => 'admin-services',
        'restaurant' => 'admin-restaurant',
        'superadmin' => 'superadmin',
        'woocommerce' => 'woocommerce_user',
        'essentials' => 'admin-essentials',
        'manufacturing' => 'manufacturer-demo',
    );
?>
<div class="login-split <?php echo e($is_demo ? 'login-split-demo' : '', false); ?>">
    
    <div class="login-brand-panel">
        <?php if($is_demo): ?>
            <div class="demo-showcase-content">
                <div class="demo-showcase-kicker">
                    <i class="fas fa-store-alt"></i> Demo Environment
                </div>
                <h1 class="demo-showcase-title">Demo Showcase</h1>
                <p class="demo-showcase-copy">Choose a business type to sign in with a ready-to-use demo account.</p>

                <div class="demo-showcase-board">
                    <div class="demo-showcase-section-title">Business demos</div>
                    <div class="demo-showcase-grid">
                        <a href="?demo_type=all_in_one" class="btn bg-olive demo-login" data-bs-toggle="tooltip" title="Showcases all feature available in the application." data-admin="<?php echo e($demo_types['all_in_one'], false); ?>"><i class="fas fa-star"></i> All In One</a>
                        <a href="?demo_type=pharmacy" class="btn bg-maroon demo-login" data-bs-toggle="tooltip" title="Shops with products having expiry dates." data-admin="<?php echo e($demo_types['pharmacy'], false); ?>"><i class="fas fa-medkit"></i> Pharmacy</a>
                        <a href="?demo_type=services" class="btn bg-orange demo-login" data-bs-toggle="tooltip" title="For all service providers like Web Development, Restaurants, Repairing, Plumber, Salons, Beauty Parlors etc." data-admin="<?php echo e($demo_types['services'], false); ?>"><i class="fas fa-wrench"></i> Multi-Service Center</a>
                        <a href="?demo_type=electronics" class="btn bg-purple demo-login" data-bs-toggle="tooltip" title="Products having IMEI or Serial number code." data-admin="<?php echo e($demo_types['electronics'], false); ?>"><i class="fas fa-laptop"></i> Electronics & Mobile Shop</a>
                        <a href="?demo_type=super_market" class="btn bg-navy demo-login" data-bs-toggle="tooltip" title="Super market & Similar kind of shops." data-admin="<?php echo e($demo_types['super_market'], false); ?>"><i class="fas fa-shopping-cart"></i> Super Market</a>
                        <a href="?demo_type=restaurant" class="btn bg-red demo-login" data-bs-toggle="tooltip" title="Restaurants, Salons and other similar kind of shops." data-admin="<?php echo e($demo_types['restaurant'], false); ?>"><i class="fas fa-utensils"></i> Restaurant</a>
                    </div>

                    <div class="demo-showcase-divider"></div>

                    <div class="demo-showcase-section-title">Premium optional modules</div>
                    <div class="demo-showcase-grid">
                        <a href="?demo_type=superadmin" class="btn bg-red-active demo-login" data-bs-toggle="tooltip" title="SaaS & Superadmin extension Demo" data-admin="<?php echo e($demo_types['superadmin'], false); ?>"><i class="fas fa-university"></i> SaaS / Superadmin</a>
                        <a href="?demo_type=woocommerce" class="btn bg-woocommerce demo-login" data-bs-toggle="tooltip" title="WooCommerce demo user - Open web shop in minutes!!" style="color:white !important" data-admin="<?php echo e($demo_types['woocommerce'], false); ?>"><i class="fab fa-wordpress"></i> WooCommerce</a>
                        <a href="?demo_type=essentials" class="btn bg-navy demo-login" data-bs-toggle="tooltip" title="Essentials & HRM (human resource management) Module Demo" style="color:white !important" data-admin="<?php echo e($demo_types['essentials'], false); ?>"><i class="fas fa-check-circle"></i> Essentials & HRM</a>
                        <a href="?demo_type=manufacturing" class="btn bg-orange demo-login" data-bs-toggle="tooltip" title="Manufacturing module demo" style="color:white !important" data-admin="<?php echo e($demo_types['manufacturing'], false); ?>"><i class="fas fa-industry"></i> Manufacturing Module</a>
                        <a href="?demo_type=superadmin" class="btn bg-maroon demo-login" data-bs-toggle="tooltip" title="Project module demo" style="color:white !important" data-admin="<?php echo e($demo_types['superadmin'], false); ?>"><i class="fas fa-project-diagram"></i> Project Module</a>
                        <a href="?demo_type=services" class="btn bg-brown demo-login" data-bs-toggle="tooltip" title="Advance repair module demo" style="color:white !important; background-color: #bc8f8f" data-admin="<?php echo e($demo_types['services'], false); ?>"><i class="fas fa-wrench"></i> Advance Repair Module</a>
                        <a href="<?php echo e(url('docs'), false); ?>" target="_blank" class="btn demo-doc-link" data-bs-toggle="tooltip" title="API Documentation" style="color:white !important; background-color: #2dce89"><i class="fas fa-network-wired"></i> Connector Module / API Documentation</a>
                    </div>
                </div>

                <div class="demo-showcase-note">
                    <i class="fas fa-lock-open"></i>
                    <span>Demo credentials are filled automatically when you choose a showcase.</span>
                </div>
            </div>
        <?php else: ?>
            <div class="brand-content">
                <div class="brand-logo-wrap">
                    <?php if(file_exists(public_path('uploads/logo.png'))): ?>
                        <img src="/uploads/logo.png" alt="Logo">
                    <?php else: ?>
                        <span class="brand-text-logo"><?php echo e(substr(config('app.name', 'B'), 0, 1), false); ?></span>
                    <?php endif; ?>
                </div>
                <h1 class="brand-title"><?php echo e(config('app.name', 'BitorePOS'), false); ?></h1>
                <p class="brand-subtitle"><?php echo app('translator')->get('lang_v1.login_page_tagline'); ?></p>
                <div class="ai-powered-badge-login">
                    <i class="fas fa-brain"></i> AI-Powered ERP
                </div>
                <ul class="brand-features">
                    <li><i class="fas fa-robot"></i> 30 AI Business Intelligence Tools</li>
                    <li><i class="fas fa-chart-line"></i> AI Demand Forecasting & Insights</li>
                    <li><i class="bi bi-lightning-charge-fill"></i> Fast & intuitive point of sale</li>
                    <li><i class="bi bi-bar-chart-fill"></i> Real-time analytics & reports</li>
                    <li><i class="bi bi-shield-lock-fill"></i> Secure & reliable platform</li>
                    <li><i class="bi bi-phone-fill"></i> Works on any device</li>
                </ul>
            </div>
            <div class="brand-footer-text">
                &copy; <?php echo e(date('Y'), false); ?> <?php echo e(config('app.name', 'BitorePOS'), false); ?>. All rights reserved.
            </div>
        <?php endif; ?>
    </div>

    
    <div class="login-form-panel">
        
        <div class="login-form-topbar">
            <div>
                <select class="form-select form-select-sm" id="change_lang" style="min-width: 140px; border-radius: 8px;">
                    <?php $__currentLoopData = config('constants.langs'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>" <?php if((empty(request()->lang) && config('app.locale') == $key) || request()->lang == $key): ?> selected <?php endif; ?>>
                            <?php echo e($val['full_name'], false); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <?php if(Route::has('pricing') && config('app.env') != 'demo' && empty(\App\System::getProperty('disable_pricing'))): ?>
                    <a class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;"
                        href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PricingController::class, 'index']), false); ?>"><?php echo app('translator')->get('superadmin::lang.pricing'); ?></a>
                <?php endif; ?>
                <?php if(config('constants.allow_registration')): ?>
                    <a href="<?php echo e(registration_url(), false); ?>" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;"><?php echo app('translator')->get('business.register_now'); ?></a>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="login-brand-mobile">
            <div class="brand-logo-wrap">
                <?php if(file_exists(public_path('uploads/logo.png'))): ?>
                    <img src="/uploads/logo.png" alt="Logo">
                <?php else: ?>
                    <span class="brand-text-logo"><?php echo e(substr(config('app.name', 'B'), 0, 1), false); ?></span>
                <?php endif; ?>
            </div>
            <h2><?php echo e(config('app.name', 'BitorePOS'), false); ?></h2>
            <p><?php echo app('translator')->get('lang_v1.welcome_back'); ?></p>
            <div class="ai-powered-badge-login" style="font-size:.75rem; padding:4px 12px; margin-top:8px;">
                <i class="fas fa-brain"></i> AI-Powered ERP
            </div>
        </div>

        
        <div class="login-form-container">
            <h2 class="login-form-heading"><?php echo app('translator')->get('lang_v1.welcome_back'); ?></h2>
            <p class="login-form-subheading"><?php echo app('translator')->get('lang_v1.login_msg', ['name' => config('app.name', 'BitorePOS')]); ?></p>

            <?php if(session('status')): ?>
                <?php if(session('status.success') == 0): ?>
                    <div class="alert alert-danger login-alert" id="alert_msg">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i> <?php echo e(session('status.msg'), false); ?>

                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if(auth()->guard()->check()): ?>
                <?php
                    $continueUser = auth()->user();
                    $continueDisplayName = trim($continueUser->user_full_name);
                    $continueIdentifier = $continueUser->email ?: $continueUser->username;

                    if (empty($continueDisplayName)) {
                        $continueDisplayName = $continueIdentifier ?: $continueUser->username;
                    }

                    $continueInitialSource = trim($continueDisplayName ?: $continueIdentifier);
                    $continueInitial = strtoupper(substr($continueInitialSource, 0, 1));
                ?>
                <div class="continue-login-box">
                    <div class="continue-login-label">Continue as:</div>
                    <div class="continue-login-row">
                        <a href="<?php echo e(route('login.continue'), false); ?>" class="continue-user-card">
                            <span class="continue-user-avatar"><?php echo e($continueInitial, false); ?></span>
                            <span class="continue-user-text">
                                <span class="continue-user-name"><?php echo e($continueDisplayName, false); ?></span>
                                <?php if(!empty($continueIdentifier)): ?>
                                    <span class="continue-user-id"><?php echo e($continueIdentifier, false); ?></span>
                                <?php endif; ?>
                            </span>
                        </a>
                        <a href="<?php echo e(route('logout'), false); ?>" class="continue-logout-link" title="Sign out current user" aria-label="Sign out current user">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                    <div class="login-divider"><span>or login to another account</span></div>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login'), false); ?>" id="login-form">
                <?php echo e(csrf_field(), false); ?>

                <?php
                    $username = old('username');
                    $password = null;
                    if($is_demo){
                        $username = 'admin';
                        $password = '123456';
                        $requested_demo_type = request()->query('demo_type');
                        if(!empty($requested_demo_type) && array_key_exists($requested_demo_type, $demo_types)){
                            $username = $demo_types[$requested_demo_type];
                        }
                    }
                ?>

                
                <div class="login-input-group">
                    <label for="username"><?php echo app('translator')->get('lang_v1.username'); ?></label>
                    <input id="username" type="text"
                        class="form-control <?php echo e($errors->has('username') ? 'is-invalid' : '', false); ?>"
                        name="username" value="<?php echo e($username, false); ?>" required autofocus
                        placeholder="<?php echo app('translator')->get('lang_v1.username'); ?>">
                    <i class="bi bi-person-fill login-input-icon"></i>
                    <?php if($errors->has('username')): ?>
                        <div class="invalid-feedback"><?php echo e($errors->first('username'), false); ?></div>
                    <?php endif; ?>
                </div>

                
                <div class="login-input-group">
                    <label for="password"><?php echo app('translator')->get('lang_v1.password'); ?></label>
                    <input id="password" type="password"
                        class="form-control <?php echo e($errors->has('password') ? 'is-invalid' : '', false); ?>"
                        name="password" value="<?php echo e($password, false); ?>" required
                        placeholder="<?php echo app('translator')->get('lang_v1.password'); ?>">
                    <i class="bi bi-lock-fill login-input-icon"></i>
                    <?php if($errors->has('password')): ?>
                        <div class="invalid-feedback"><?php echo e($errors->first('password'), false); ?></div>
                    <?php endif; ?>
                </div>

                
                <div class="login-meta-row">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember" <?php echo e(old('remember') ? 'checked' : '', false); ?>>
                        <label class="form-check-label" for="remember"><?php echo app('translator')->get('lang_v1.remember_me'); ?></label>
                    </div>
                    <?php if(config('app.env') != 'demo'): ?>
                        <a href="<?php echo e(route('password.request'), false); ?>"><?php echo app('translator')->get('lang_v1.forgot_your_password'); ?></a>
                    <?php endif; ?>
                </div>

                
                <?php if(config('constants.enable_recaptcha')): ?>
                    <div class="login-recaptcha">
                        <div class="g-recaptcha" data-sitekey="<?php echo e(config('constants.google_recaptcha_key'), false); ?>"></div>
                        <?php if($errors->has('g-recaptcha-response')): ?>
                            <span class="text-danger mt-1 d-block" style="font-size:.85rem;"><?php echo e($errors->first('g-recaptcha-response'), false); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                
                <?php if(!empty(request('device_id'))): ?>
                    <input type="hidden" value="<?php echo e(request('device_id'), false); ?>" name="device_id">
                <?php endif; ?>

                
                <button type="submit" class="btn btn-login-submit">
                    <i class="bi bi-box-arrow-in-right me-1"></i> <?php echo app('translator')->get('lang_v1.login'); ?>
                </button>

                
                <?php if(config('constants.allow_registration')): ?>
                    <div class="login-register-link">
                        <?php echo app('translator')->get('lang_v1.not_yet_registered'); ?>
                        <a href="<?php echo e(registration_url(), false); ?>"><?php echo app('translator')->get('business.register_now'); ?></a>
                    </div>
                <?php endif; ?>
            </form>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#change_lang').change( function(){
            window.location = "<?php echo e(route('login'), false); ?>?lang=" + $(this).val();
        });

        <?php if(config('app.env') == 'demo'): ?>
        $('a.demo-login').click( function (e) {
           e.preventDefault();
           $('#username').val($(this).data('admin'));
           $('#password').val("<?php echo e($password ?? '', false); ?>");
           $('form#login-form').submit();
        });
        <?php endif; ?>

        setTimeout(function() {
            $('#alert_msg').fadeOut(1000);
        }, 2000);
    })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>