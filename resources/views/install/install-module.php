
<?php $__env->startSection('title', 'Module Installation'); ?>
<?php $__env->startSection('subtitle', 'Install Module'); ?>

<?php $__env->startSection('content'); ?>
<div class="install-card">
    <div class="install-card-header">
        <h2><i class="bi bi-puzzle"></i> Install Module</h2>
        <p class="subtitle">Confirm your license details before installing this module.</p>
    </div>
    <form class="form" id="details_form" method="post" action="<?php echo e($action_url, false); ?>">
        <?php echo e(csrf_field(), false); ?>

    <div class="install-card-body">
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo session('error'); ?></div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error, false); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

            <h4 class="form-section-title">
                <i class="bi bi-shield-check"></i> License Details
                <small class="text-danger">Make sure to provide correct licensing information.</small>
            </h4>

            <p class="text-muted small">
                By clicking <strong>I Agree, Install</strong>, you confirm that you accept the license terms for this module.
            </p>
    </div>
    <div class="install-card-footer">
        <span></span>
        <button type="submit" id="install_button" class="btn btn-primary">
            <i class="bi bi-check2-circle me-1"></i> I Agree, Install
        </button>
    </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('form#details_form').submit(function () {
            $('button#install_button').attr('disabled', true).html('<i class="bi bi-hourglass-split me-1"></i> Installing...');
            $('div.install_msg').removeClass('hide');
            $('.back_button').hide();
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.install', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>