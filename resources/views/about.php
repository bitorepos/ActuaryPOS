
<?php $__env->startSection('title', __('lang_v1.about')); ?>

<?php $__env->startSection('css'); ?>
<style>
/* ===== About Page Styles ===== */
.about-page {
    max-width: 960px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Hero Banner */
.about-hero {
    background: linear-gradient(135deg, var(--bs-primary, #0047A5), var(--theme-primary-dark, #003781));
    border-radius: 16px;
    padding: 48px 40px;
    color: #fff;
    position: relative;
    overflow: hidden;
    margin-bottom: 28px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
}

.about-hero::before {
    content: '';
    position: absolute;
    top: -60%;
    right: -20%;
    width: 400px;
    height: 400px;
    background: rgba(255, 255, 255, 0.06);
    border-radius: 50%;
}

.about-hero::after {
    content: '';
    position: absolute;
    bottom: -40%;
    left: -10%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.04);
    border-radius: 50%;
}

.about-hero-content {
    position: relative;
    z-index: 1;
}

.about-hero .app-logo {
    width: 92px;
    height: 92px;
    background: rgba(255, 255, 255, 0.18);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    backdrop-filter: blur(4px);
}

.about-hero .app-logo img {
    width: 64px;
    height: 64px;
}

.about-hero h1 {
    font-size: 1.85rem;
    font-weight: 700;
    margin-bottom: 6px;
    letter-spacing: -0.3px;
    color: #fff;
    text-shadow: 0 2px 8px rgba(0,0,0,0.45), 0 1px 0 #222;
}

.about-hero .hero-subtitle {
    font-size: 0.95rem;
    opacity: 0.85;
    margin-bottom: 18px;
    font-weight: 400;
}

.about-hero .version-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255, 255, 255, 0.18);
    color: #fff;
    padding: 6px 16px;
    border-radius: 50px;
    font-size: 0.82rem;
    font-weight: 600;
    letter-spacing: 0.3px;
    backdrop-filter: blur(4px);
}

.about-hero .version-pill i {
    font-size: 0.9rem;
}

.about-hero .hero-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-top: 14px;
    max-width: 360px;
}

/* Section Cards */
.about-section {
    background: #fff;
    border-radius: 14px;
    border: 1px solid rgba(0, 0, 0, 0.06);
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    margin-bottom: 20px;
    overflow: hidden;
    transition: box-shadow 0.2s;
}

.about-section:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
}

.about-section-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px 24px 0;
}

.about-section-header .section-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.about-section-header .section-icon.icon-blue {
    background: rgba(var(--bs-primary-rgb, 0, 71, 165), 0.1);
    color: var(--bs-primary, #0047A5);
}

.about-section-header .section-icon.icon-green {
    background: rgba(25, 135, 84, 0.1);
    color: #198754;
}

.about-section-header .section-icon.icon-purple {
    background: rgba(111, 66, 193, 0.1);
    color: #6f42c1;
}

.about-section-header .section-icon.icon-orange {
    background: rgba(253, 126, 20, 0.1);
    color: #fd7e14;
}

.about-section-header h5 {
    font-size: 1rem;
    font-weight: 700;
    color: #1a1a2e;
    margin: 0;
}

.about-section-body {
    padding: 16px 24px 24px;
}

/* Company Overview */
.company-overview p {
    font-size: 0.9rem;
    color: #555;
    line-height: 1.7;
    margin-bottom: 0;
}

.company-url {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--bs-primary, #0047A5);
    text-decoration: none;
    margin-top: 12px;
    padding: 6px 14px;
    border-radius: 8px;
    background: rgba(var(--bs-primary-rgb, 0, 71, 165), 0.06);
    transition: all 0.15s;
}

.company-url:hover {
    background: rgba(var(--bs-primary-rgb, 0, 71, 165), 0.12);
    color: var(--theme-primary-dark, #003781);
}

/* Address Block */
.address-block {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 16px;
    background: #f8f9fa;
    border-radius: 10px;
    margin-top: 8px;
}

.address-block i {
    font-size: 1.1rem;
    color: var(--bs-primary, #0047A5);
    margin-top: 2px;
    flex-shrink: 0;
}

.address-block .address-text {
    font-size: 0.88rem;
    color: #555;
    line-height: 1.6;
}

/* Contact Grid */
.contact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 12px;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: background 0.15s;
}

.contact-item:hover {
    background: #f0f1f3;
}

.contact-item .contact-icon {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.95rem;
    flex-shrink: 0;
}

.contact-item .contact-icon.ci-phone {
    background: rgba(25, 135, 84, 0.1);
    color: #198754;
}

.contact-item .contact-icon.ci-email {
    background: rgba(var(--bs-primary-rgb, 0, 71, 165), 0.1);
    color: var(--bs-primary, #0047A5);
}

.contact-item .contact-label {
    font-size: 0.72rem;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #888;
    font-weight: 600;
}

.contact-item .contact-value {
    font-size: 0.88rem;
    font-weight: 600;
    color: #333;
    margin-top: 1px;
}

.contact-item a.contact-value {
    text-decoration: none;
    transition: color 0.15s;
}

.contact-item a.contact-value:hover {
    color: var(--bs-primary, #0047A5);
}

/* Social Links */
.social-links {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 4px;
}

.social-link {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    color: #fff;
    text-decoration: none;
    transition: transform 0.15s, box-shadow 0.15s;
}

.social-link:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    color: #fff;
}

.social-link.sl-facebook { background: #1877f2; }
.social-link.sl-instagram { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
.social-link.sl-twitter { background: #1da1f2; }
.social-link.sl-linkedin { background: #0a66c2; }
.social-link.sl-youtube { background: #ff0000; }

/* Version Details Table */
.version-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.version-table tr td {
    padding: 10px 14px;
    font-size: 0.88rem;
    border-bottom: 1px solid #f0f0f0;
}

.version-table tr:last-child td {
    border-bottom: none;
}

.version-table .vt-label {
    color: #888;
    font-weight: 500;
    width: 40%;
}

.version-table .vt-value {
    color: #333;
    font-weight: 600;
}

.version-badge-lg {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: var(--bs-primary, #0047A5);
    color: #fff;
    padding: 4px 12px;
    border-radius: 6px;
    font-size: 0.82rem;
    font-weight: 700;
    letter-spacing: 0.3px;
}

/* Footer note */
.about-footer-note {
    text-align: center;
    padding: 20px 0 10px;
    font-size: 0.82rem;
    color: #999;
}

/* ===== Dark Mode ===== */
html.dark-theme .about-section {
    background: #1e2a3a;
    border-color: rgba(255, 255, 255, 0.08);
}

html.dark-theme .about-section-header h5 {
    color: #e4e5e6;
}

html.dark-theme .company-overview p {
    color: #b0b8c4;
}

html.dark-theme .address-block,
html.dark-theme .contact-item {
    background: rgba(255, 255, 255, 0.05);
}

html.dark-theme .contact-item:hover {
    background: rgba(255, 255, 255, 0.08);
}

html.dark-theme .contact-item .contact-label {
    color: #8899aa;
}

html.dark-theme .contact-item .contact-value {
    color: #d0d5db;
}

html.dark-theme .address-block .address-text {
    color: #b0b8c4;
}

html.dark-theme .version-table .vt-label {
    color: #8899aa;
}

html.dark-theme .version-table .vt-value {
    color: #d0d5db;
}

html.dark-theme .version-table tr td {
    border-bottom-color: rgba(255, 255, 255, 0.06);
}

html.dark-theme .about-footer-note {
    color: #6b7a8a;
}

/* ===== Responsive ===== */
@media (max-width: 576px) {
    .about-hero {
        padding: 32px 24px;
    }
    .about-hero h1 {
        font-size: 1.45rem;
    }
    .about-section-body {
        padding: 14px 18px 20px;
    }
    .contact-grid {
        grid-template-columns: 1fr;
    }
    .about-hero .hero-actions {
        max-width: 100%;
        flex-wrap: wrap;
    }
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black"><?php echo app('translator')->get('lang_v1.about'); ?></h1>
</section>

<section class="content">
<div class="about-page">

    
    <div class="about-hero">
        <div class="about-hero-content">
            <div class="app-logo">
                <img src="<?php echo e(asset('uploads/logo.png'), false); ?>" alt="<?php echo e($app_display_name, false); ?>">
            </div>
            <h1><?php echo e($app_display_name, false); ?></h1>
            <p class="hero-subtitle">
                Comprehensive Point of Sale &amp; Business Management Platform
            </p>
            <div class="hero-actions">
                <a href="<?php echo e(route('documentation.index'), false); ?>" class="btn btn-light btn-sm fw-semibold">
                    <i class="bi bi-book me-1"></i> Documentation
                </a>
                <span class="version-pill">
                    <i class="bi bi-box-seam"></i>
                    Version <?php echo e($app_version, false); ?>

                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7">

            
            <div class="about-section">
                <div class="about-section-header">
                    <div class="section-icon icon-blue">
                        <i class="bi bi-building"></i>
                    </div>
                    <h5>Company Overview</h5>
                </div>
                <div class="about-section-body company-overview">
                    <p>
                        <strong><?php echo e($app_display_name, false); ?> - Hybrid System</strong> is a modern software solution designed to
                        help businesses manage their operations efficiently through a powerful POS and ERP
                        platform. Our system combines the flexibility of cloud-based technology with the
                        reliability of online and offline working capability, ensuring uninterrupted business
                        operations even when internet connectivity is limited.
                    </p>
                    <p>
                        Our flagship product, <strong><?php echo e($app_display_name, false); ?></strong>, provides a comprehensive set of tools
                        for Point-of-Sale (POS), inventory management, accounting, purchasing, sales, and advanced
                        reporting, all integrated into a single, intelligent platform.
                    </p>
                    <p>
                        Built with scalability and performance in mind, <?php echo e($app_display_name, false); ?> enables businesses of all
                        sizes to streamline operations, improve decision-making, and maintain full control over
                        their data in real time. The hybrid architecture allows users to work seamlessly both
                        online and offline, with automatic synchronization when the connection is restored.
                    </p>
                    <p>
                        With a focus on reliability, security, and user-friendly design, <?php echo e($app_display_name, false); ?> delivers
                        a complete digital solution that supports modern retail, wholesale, and service-based
                        businesses.
                    </p>
                    <?php if(!empty($vendor_url) && $vendor_url !== '#'): ?>
                        <a href="<?php echo e($vendor_url, false); ?>" target="_blank" rel="noopener" class="company-url">
                            <i class="bi bi-globe2"></i> Visit Website
                        </a>
                    <?php endif; ?>

                    
                    <?php
                        $address_parts = array_filter([
                            $company_landmark ?? null,
                            $company_city ?? null,
                            $company_state ?? null,
                            $company_zip ?? null,
                            $company_country ?? null,
                        ]);
                    ?>
                    <?php if(!empty($address_parts)): ?>
                        <div class="address-block">
                            <i class="bi bi-geo-alt-fill"></i>
                            <div class="address-text">
                                <?php echo e(implode(', ', $address_parts), false); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="about-section">
                <div class="about-section-header">
                    <div class="section-icon icon-green">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h5>Contact Information</h5>
                </div>
                <div class="about-section-body">
                    <div class="contact-grid">
                        
                        <?php if(!empty($contact_us)): ?>
                            <?php $__currentLoopData = $contact_us; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($phone['num'])): ?>
                                    <div class="contact-item">
                                        <div class="contact-icon ci-phone">
                                            <i class="bi bi-telephone-fill"></i>
                                        </div>
                                        <div>
                                            <div class="contact-label"><?php echo e($phone['label'] ?? 'Phone', false); ?></div>
                                            <a href="tel:<?php echo e($phone['num'], false); ?>" class="contact-value"><?php echo e($phone['num'], false); ?></a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        
                        <?php if(!empty($mail_us)): ?>
                            <?php $__currentLoopData = $mail_us; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($email['email'])): ?>
                                    <div class="contact-item">
                                        <div class="contact-icon ci-email">
                                            <i class="bi bi-envelope-fill"></i>
                                        </div>
                                        <div>
                                            <div class="contact-label"><?php echo e($email['label'] ?? 'Email', false); ?></div>
                                            <a href="mailto:<?php echo e($email['email'], false); ?>" class="contact-value"><?php echo e($email['email'], false); ?></a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        
                        <?php if(empty($mail_us) && !empty($company_email)): ?>
                            <div class="contact-item">
                                <div class="contact-icon ci-email">
                                    <i class="bi bi-envelope-fill"></i>
                                </div>
                                <div>
                                    <div class="contact-label">Email</div>
                                    <a href="mailto:<?php echo e($company_email, false); ?>" class="contact-value"><?php echo e($company_email, false); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-5">

            
            <div class="about-section">
                <div class="about-section-header">
                    <div class="section-icon icon-purple">
                        <i class="bi bi-cpu"></i>
                    </div>
                    <h5>Software Details</h5>
                </div>
                <div class="about-section-body">
                    <table class="version-table">
                        <tr>
                            <td class="vt-label">Application Name</td>
                            <td class="vt-value"><?php echo e($app_display_name, false); ?></td>
                        </tr>
                        <tr>
                            <td class="vt-label">Version</td>
                            <td class="vt-value">
                                <span class="version-badge-lg">
                                    <i class="bi bi-tag-fill"></i> <?php echo e($app_version, false); ?>

                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="vt-label">Developer</td>
                            <td class="vt-value"><?php echo e($vendor, false); ?></td>
                        </tr>
                        <tr>
                            <td class="vt-label">Timezone</td>
                            <td class="vt-value"><?php echo e(config('app.timezone', 'UTC'), false); ?></td>
                        </tr>
                        <?php if(!empty($last_update_date)): ?>
                        <tr>
                            <td class="vt-label">Last Updated</td>
                            <td class="vt-value">
                                <a href="<?php echo e(url('documentation/version-history'), false); ?>" class="text-decoration-none">
                                    <i class="bi bi-calendar-check"></i> <?php echo e(\Carbon\Carbon::parse($last_update_date)->format('d M Y'), false); ?>

                                </a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>

            
            <?php if(!empty($follow_us) && is_array($follow_us)): ?>
                <?php
                    $has_social = false;
                    foreach ($follow_us as $v) {
                        if (!empty($v)) { $has_social = true; break; }
                    }
                ?>
                <?php if($has_social): ?>
                    <div class="about-section">
                        <div class="about-section-header">
                            <div class="section-icon icon-orange">
                                <i class="bi bi-share-fill"></i>
                            </div>
                            <h5>Follow Us</h5>
                        </div>
                        <div class="about-section-body">
                            <div class="social-links">
                                <?php if(!empty($follow_us['facebook'])): ?>
                                    <a href="<?php echo e($follow_us['facebook'], false); ?>" target="_blank" rel="noopener" class="social-link sl-facebook" title="Facebook">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if(!empty($follow_us['instagram'])): ?>
                                    <a href="<?php echo e($follow_us['instagram'], false); ?>" target="_blank" rel="noopener" class="social-link sl-instagram" title="Instagram">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if(!empty($follow_us['twitter'])): ?>
                                    <a href="<?php echo e($follow_us['twitter'], false); ?>" target="_blank" rel="noopener" class="social-link sl-twitter" title="Twitter / X">
                                        <i class="bi bi-twitter-x"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if(!empty($follow_us['linkedin'])): ?>
                                    <a href="<?php echo e($follow_us['linkedin'], false); ?>" target="_blank" rel="noopener" class="social-link sl-linkedin" title="LinkedIn">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if(!empty($follow_us['youtube'])): ?>
                                    <a href="<?php echo e($follow_us['youtube'], false); ?>" target="_blank" rel="noopener" class="social-link sl-youtube" title="YouTube">
                                        <i class="bi bi-youtube"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>

    <div class="about-footer-note">
        <?php echo e($company_name, false); ?> &copy; <?php echo e(date('Y'), false); ?>. All rights reserved.
    </div>

</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>