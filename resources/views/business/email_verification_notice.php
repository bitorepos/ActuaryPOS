
<?php $__env->startSection('title', 'Check Your Email'); ?>

<?php $__env->startSection('css'); ?>
<style>
body { background: linear-gradient(135deg, #cfe0ff 0%, #eef5ff 56%, #ffffff 100%) !important; }
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
.verification-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
}
.verification-panel {
    width: 100%;
    max-width: 620px;
    text-align: center;
    color: #111827;
}
.verification-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #dcfce7;
    color: #16a34a;
    font-size: 2.1rem;
    margin-bottom: 1.35rem;
}
.verification-title {
    font-size: 2.65rem;
    font-weight: 800;
    margin-bottom: 1rem;
    color: #0f172a;
}
.verification-message {
    color: #4b5563;
    font-size: 1.25rem;
    line-height: 1.45;
    max-width: 540px;
    margin: 0 auto 1.1rem;
}
.verification-email {
    display: block;
    color: #2563eb;
    font-size: 1.25rem;
    font-weight: 800;
    margin-bottom: 2rem;
    overflow-wrap: anywhere;
}
.verification-login-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 56px;
    padding: 0 2rem;
    border-radius: 8px;
    background: #2563eb;
    color: #fff;
    font-size: 1.05rem;
    font-weight: 700;
    text-decoration: none;
    margin-bottom: 1.8rem;
}
.verification-login-btn:hover {
    color: #fff;
    background: #1d4ed8;
    text-decoration: none;
}
.verification-resend-copy {
    color: #6b7280;
    font-size: 1rem;
    margin-bottom: .55rem;
}
.verification-resend-btn {
    border: 0;
    background: transparent;
    color: #2563eb;
    padding: 0;
    font-size: 1.1rem;
    font-weight: 600;
}
.verification-resend-btn:hover {
    color: #1d4ed8;
    text-decoration: underline;
}
.verification-status {
    max-width: 460px;
    margin: 0 auto 1.4rem;
    border-radius: 10px;
    padding: .8rem 1rem;
    background: rgba(255, 255, 255, .75);
    color: #166534;
    font-weight: 600;
}
@media (max-width: 575.98px) {
    .verification-title { font-size: 2rem; }
    .verification-message,
    .verification-email { font-size: 1.05rem; }
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="verification-page">
    <div class="verification-panel">
        <div class="verification-icon">
            <i class="bi bi-envelope"></i>
        </div>
        <h1 class="verification-title">Check Your Email</h1>
        <p class="verification-message">
            We have sent a verification link to your email address. Please click the link to verify your account before logging in.
        </p>
        <?php if(!empty($email)): ?>
            <span class="verification-email"><?php echo e($email, false); ?></span>
        <?php endif; ?>

        <?php if(session('verification_status')): ?>
            <div class="verification-status"><?php echo e(session('verification_status'), false); ?></div>
        <?php endif; ?>

        <a href="<?php echo e(route('login'), false); ?>" class="verification-login-btn">Go to Login</a>

        <?php if(!empty($email)): ?>
            <p class="verification-resend-copy">Didn't receive the email?</p>
            <form method="POST" action="<?php echo e(route('business.email.resend'), false); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="email" value="<?php echo e($email, false); ?>">
                <button type="submit" class="verification-resend-btn">Resend verification email</button>
            </form>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>