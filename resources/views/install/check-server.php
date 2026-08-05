
<?php $__env->startSection('title', 'Server Requirements'); ?>
<?php $__env->startSection('subtitle', 'Server Compatibility Check'); ?>

<?php
    $checks = [
        ['label' => 'PHP &gt;= 7.1', 'key' => 'php'],
        ['label' => 'OpenSSL PHP Extension', 'key' => 'openssl'],
        ['label' => 'PDO PHP Extension', 'key' => 'pdo'],
        ['label' => 'Mbstring PHP Extension', 'key' => 'mbstring'],
        ['label' => 'Tokenizer PHP Extension', 'key' => 'tokenizer'],
        ['label' => 'XML PHP Extension', 'key' => 'xml'],
        ['label' => 'cURL PHP Extension', 'key' => 'curl'],
        ['label' => 'ZIP PHP Extension', 'key' => 'zip'],
        ['label' => 'GD PHP Extension', 'key' => 'gd'],
    ];
?>

<?php $__env->startSection('content'); ?>
<div class="install-card">
    <div class="install-card-header">
        <h2><i class="bi bi-hdd-stack"></i> Server Requirements</h2>
        <p class="subtitle">Verifying that your server meets the minimum requirements.</p>
    </div>
    <div class="install-card-body">
        <?php echo $__env->make('install.partials.nav', ['active' => 'server'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <table class="install-check-table">
            <?php $__currentLoopData = $checks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo $c['label']; ?></td>
                    <td>
                        <?php if(!empty($output[$c['key']])): ?>
                            <span class="check-badge ok" title="Available"><i class="bi bi-check-lg"></i></span>
                        <?php else: ?>
                            <span class="check-badge fail" title="Missing"><i class="bi bi-x-lg"></i></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><code><?php echo e(storage_path(), false); ?></code> is writable?</td>
                <td>
                    <?php if($output['storage_writable']): ?>
                        <span class="check-badge ok"><i class="bi bi-check-lg"></i></span>
                    <?php else: ?>
                        <span class="check-badge fail"><i class="bi bi-x-lg"></i></span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td><code><?php echo e(base_path('bootstrap/cache'), false); ?></code> is writable?</td>
                <td>
                    <?php if($output['cache_writable']): ?>
                        <span class="check-badge ok"><i class="bi bi-check-lg"></i></span>
                    <?php else: ?>
                        <span class="check-badge fail"><i class="bi bi-x-lg"></i></span>
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <?php if(!$output['next']): ?>
            <div class="alert alert-danger mt-3">
                <strong><i class="bi bi-exclamation-triangle"></i> Some requirements are missing.</strong>
                Please fix the items marked above before continuing.
            </div>
        <?php endif; ?>
    </div>
    <div class="install-card-footer">
        <a href="<?php echo e(route('install.index'), false); ?>" class="btn btn-default">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
        <a <?php if($output['next']): ?> href="<?php echo e(route('install.details'), false); ?>" <?php endif; ?>
            class="btn btn-primary <?php if(!$output['next']): ?> disabled <?php endif; ?>"
            <?php if(!$output['next']): ?> onclick="return false;" tabindex="-1" <?php endif; ?>>
            Continue <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.install', ['no_header' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>