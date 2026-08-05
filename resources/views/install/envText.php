
<?php $__env->startSection('title', 'Review Configuration'); ?>
<?php $__env->startSection('subtitle', 'Step 2 of 3 · Review & Confirm'); ?>

<?php $__env->startSection('content'); ?>
<div class="install-card">
    <div class="install-card-header">
        <h2><i class="bi bi-file-earmark-text"></i> Review your configuration</h2>
        <p class="subtitle">
            We'll create the <code>.env</code> file at
            <code><?php echo e($envPath, false); ?></code> when you click <strong>Install</strong>.
        </p>
    </div>

    <form class="form" method="post" action="<?php echo e(route('install.installAlternate'), false); ?>" id="env_details_form" autocomplete="off">
        <?php echo e(csrf_field(), false); ?>

        <input type="hidden" name="env_content" value="<?php echo e($envContent, false); ?>">

        <div class="install-card-body">
            <?php echo $__env->make('install.partials.nav', ['active' => 'app_details'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

            <div class="alert alert-info install_instuction">
                <i class="bi bi-info-circle me-1"></i>
                The values below will be written to your <code>.env</code> file automatically.
                You can review the content first; clicking <strong>Install</strong> will create the file
                and run the database migrations.
            </div>

            <div class="mb-2 d-flex align-items-center justify-content-between install_instuction">
                <label class="form-label mb-0"><i class="bi bi-code-slash me-1"></i> .env preview</label>
                <button type="button" class="btn btn-default btn-sm" id="copy_env_btn">
                    <i class="bi bi-clipboard me-1"></i> Copy
                </button>
            </div>

            <textarea id="env_preview" class="form-control install_instuction" rows="18"
                style="font-family: 'JetBrains Mono', Consolas, monospace; font-size: 0.82rem; background:#f8f9ff;"
                readonly><?php echo e($envContent, false); ?></textarea>

            <div class="text-center text-danger install_msg hide mt-4">
                <strong><i class="bi bi-hourglass-split"></i> Installation in progress &mdash; please do not refresh, go back or close the browser.</strong>
            </div>
        </div>

        <div class="install-card-footer">
            <a href="<?php echo e(route('install.details'), false); ?>" class="btn btn-default back_button">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
            <button type="submit" class="btn btn-primary" id="install_button">
                <i class="bi bi-cloud-download me-1"></i> Install
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#copy_env_btn').on('click', function () {
            var ta = document.getElementById('env_preview');
            ta.select();
            ta.setSelectionRange(0, 99999);
            try {
                document.execCommand('copy');
                $(this).html('<i class="bi bi-check2 me-1"></i> Copied');
                var self = this;
                setTimeout(function () {
                    $(self).html('<i class="bi bi-clipboard me-1"></i> Copy');
                }, 1500);
            } catch (e) { /* noop */ }
            window.getSelection().removeAllRanges();
        });

        $('form#env_details_form').submit(function () {
            $('button#install_button')
                .attr('disabled', true)
                .html('<i class="bi bi-hourglass-split me-1"></i> Installing...');
            $('.install_instuction').addClass('hide');
            $('div.install_msg').removeClass('hide');
            $('.back_button').hide();
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.install', ['no_header' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>