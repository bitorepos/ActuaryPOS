
<?php $__env->startSection('title', 'Offline Installation'); ?>
<?php $__env->startSection('subtitle', 'Offline Workstation Setup'); ?>

<?php $__env->startSection('content'); ?>
<div class="install-card">
    <div class="install-card-header">
        <h2><i class="bi bi-cloud-arrow-down"></i> <?php echo e(config('app.name', 'POS'), false); ?> Offline Installation</h2>
        <p class="subtitle">Configure this workstation to sync with your cloud dashboard.</p>
    </div>
    <form class="form" id="details_form" method="post" enctype="multipart/form-data"
        action="<?php echo e(route('install.postOfflineInstall'), false); ?>">
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

            <h4 class="form-section-title"><i class="bi bi-link-45deg"></i> Connection Details</h4>
            <div class="row g-3">
                <div class="col-md-12">
                    <label for="subdomain_address" class="form-label">Subdomain Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="SUBDOMAIN_ADDRESS" id="subdomain_address"
                        placeholder="name.actuarypos.com" value="" required>
                </div>
                <div class="col-md-6">
                    <label for="location_id" class="form-label">Location ID <span class="text-danger">*</span></label>
                    <input type="text" name="LOCATION_ID" value="" required placeholder="Location ID"
                        class="form-control" id="location_id">
                </div>
                <div class="col-md-6">
                    <label for="station_id" class="form-label">Workstation ID <span class="text-danger">*</span></label>
                    <input type="text" name="STATION_ID" value="" required placeholder="Workstation ID"
                        class="form-control" id="station_id">
                </div>
                <div class="col-md-12">
                    <label for="access_token" class="form-label">
                        Access Token <span class="text-danger">*</span>
                        <small class="text-muted">(generated from the Synchronization tab on the Cloud Dashboard)</small>
                    </label>
                    <textarea name="ACCESS_TOKEN" required class="form-control" rows="3" id="access_token"></textarea>
                </div>
                <div class="col-md-12">
                    <label for="DATABASE" class="form-label">Local Database Name <span class="text-danger">*</span></label>
                    <input type="text" name="DATABASE" required class="form-control" id="DATABASE">
                </div>
            </div>

            <div class="text-center text-danger install_msg hide mt-4">
                <strong><i class="bi bi-hourglass-split"></i> Installation in progress &mdash; please do not refresh, go back or close the browser.</strong>
            </div>
    </div>

    <div class="install-card-footer">
        <span class="text-muted small"><i class="bi bi-info-circle"></i> Ensure this workstation can reach your cloud subdomain.</span>
        <button type="submit" id="install_button" class="btn btn-primary btn-lg">
            <i class="bi bi-cloud-download me-1"></i>
            Install
            <i class="bi bi-arrow-repeat ms-1 hide" id="install_loading" aria-hidden="true"></i>
        </button>
    </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('form#details_form').submit(function () {
            $('button#install_button').attr('disabled', true);
            $('i#install_loading').removeClass('hide');
            $('div.install_msg').removeClass('hide');
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.install', ['no_header' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>