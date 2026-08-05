
<?php $__env->startSection('title', 'Installation Complete'); ?>
<?php $__env->startSection('subtitle', 'Step 3 of 3 · All done!'); ?>

<?php $__env->startSection('content'); ?>
<div class="install-card">
    <div class="install-card-body text-center">
        <?php echo $__env->make('install.partials.nav', ['active' => 'success'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="install-success-icon">
            <i class="bi bi-check2"></i>
        </div>

        <h2 class="mb-2" style="font-weight:700;">You're all set!</h2>
        <p class="text-muted mb-4">
            <strong><?php echo e(config('app.name', 'POS'), false); ?></strong> has been installed successfully.<br>
            All configuration details are saved in the <code>.env</code> file and can be updated at any time.
        </p>

        <div class="d-flex flex-wrap justify-content-center gap-2">
            <a href="<?php echo e(registration_url(), false); ?>" class="btn btn-primary btn-lg">
                <i class="bi bi-person-plus me-1"></i> Register Now
            </a>
            <a href="https://programmaticsurface.com/docs/getting-started/" target="_blank" rel="noopener" class="btn btn-default">
                <i class="bi bi-journal-text me-1"></i> Read Documentation
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.install', ['no_header' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>