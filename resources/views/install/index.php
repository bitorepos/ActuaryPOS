
<?php $__env->startSection('title', 'Welcome'); ?>
<?php $__env->startSection('subtitle', 'Step 1 of 3 · Welcome & Requirements'); ?>

<?php $__env->startSection('content'); ?>
<div class="install-card">
    <div class="install-card-header">
        <h2><i class="bi bi-rocket-takeoff"></i> Welcome to <?php echo e(config('app.name', 'POS'), false); ?> Installation</h2>
        <p class="subtitle">Let's get your point-of-sale system up and running in just a few minutes.</p>
    </div>
    <div class="install-card-body">
        <?php echo $__env->make('install.partials.nav', ['active' => 'install'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="alert alert-info mb-4">
            <strong><i class="bi bi-info-circle"></i> Before you begin:</strong>
            Please have the information below ready. You can pause and resume at any time.
        </div>

        <ul class="install-help-list">
            <li>
                <i class="bi bi-journal-text"></i>
                <div>
                    <strong>Documentation</strong>
                    <span><a href="https://programmaticsurface.com/docs/getting-started/installing-pos/" target="_blank" rel="noopener">Step-by-step installation guide</a></span>
                </div>
            </li>
            <li>
                <i class="bi bi-tag"></i>
                <div>
                    <strong>Application Name</strong>
                    <span>A short, meaningful name for your business.</span>
                </div>
            </li>
            <li>
                <i class="bi bi-database"></i>
                <div>
                    <strong>Database Credentials</strong>
                    <span>Host, port, name, username and password.</span>
                </div>
            </li>
            <li>
                <i class="bi bi-envelope"></i>
                <div>
                    <strong>Mail Configuration</strong>
                    <span>SMTP details for outgoing emails (optional).</span>
                </div>
            </li>
        </ul>
    </div>
    <div class="install-card-footer">
        <span class="text-muted small"><i class="bi bi-shield-check"></i> Your information stays on your server.</span>
        <a href="<?php echo e(route('install.details'), false); ?>" class="btn btn-primary">
            I understand, let's go <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.install', ['no_header' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>