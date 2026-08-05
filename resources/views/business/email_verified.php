
<?php $__env->startSection('title', 'Email Verified'); ?>

<?php $__env->startSection('css'); ?>
<style>
body { background: #ffffff !important; }
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
.authentication-content .container-fluid > .row > .col-12 > .d-flex.justify-content-between.align-items-center.p-3 {
    display: none !important;
}
.verified-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
}
.verified-card {
    width: 100%;
    max-width: 560px;
    background: #fff;
    border-radius: 18px;
    padding: 2.5rem;
    text-align: center;
    box-shadow: 0 20px 48px rgba(15, 23, 42, .14), 0 2px 8px rgba(15, 23, 42, .08);
}
.verified-icon {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #dcfce7;
    color: #16a34a;
    font-size: 3rem;
    margin-bottom: 2rem;
}
.verified-title {
    font-size: 2rem;
    line-height: 1.2;
    color: #0f172a;
    font-weight: 800;
    margin-bottom: .9rem;
}
.verified-message {
    color: #334155;
    font-size: 1.1rem;
    line-height: 1.45;
    max-width: 440px;
    margin: 0 auto 1.8rem;
}
.verified-success-strip {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .8rem;
    border-radius: 10px;
    background: #ecfdf5;
    color: #047857;
    font-size: 1rem;
    font-weight: 700;
    min-height: 64px;
    padding: .9rem 1rem;
    margin-bottom: 1.9rem;
}
.verified-login-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 60px;
    width: 100%;
    border-radius: 10px;
    background: #2563eb;
    color: #fff;
    text-decoration: none;
    font-size: 1.1rem;
    font-weight: 800;
}
.verified-login-btn:hover {
    color: #fff;
    background: #1d4ed8;
    text-decoration: none;
}
@media (max-width: 575.98px) {
    .verified-card { padding: 2rem 1.25rem; }
    .verified-title { font-size: 1.7rem; }
    .verified-message { font-size: 1rem; }
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="verified-page">
    <div class="verified-card">
        <div class="verified-icon">
            <i class="bi bi-check-lg"></i>
        </div>
        <h1 class="verified-title">Email Verified!</h1>
        <p class="verified-message">
            Your email has been successfully verified. You can now login and setup your fuel station.
        </p>
        <div class="verified-success-strip">
            <i class="bi bi-check-circle"></i>
            <span>Go to login and setup your fuel station</span>
        </div>
        <a href="<?php echo e(route('login'), false); ?>" class="verified-login-btn">Go to Login</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>