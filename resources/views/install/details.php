
<?php $__env->startSection('title', 'Application & Database Configuration'); ?>
<?php $__env->startSection('subtitle', 'Step 2 of 3 · Application Configuration'); ?>

<?php $__env->startSection('content'); ?>
<div class="install-card">
    <div class="install-card-header">
        <h2><i class="bi bi-sliders"></i> Application Configuration</h2>
        <p class="subtitle">Provide your application name and database credentials to continue.</p>
    </div>
    <form class="form" id="details_form" method="post" action="<?php echo e(route('install.postDetails'), false); ?>" autocomplete="off">
        <?php echo e(csrf_field(), false); ?>

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

            <h4 class="form-section-title"><i class="bi bi-app-indicator"></i> Application Details</h4>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="app_name" class="form-label">Application Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="APP_NAME" id="app_name"
                        placeholder="RetailMan ERP System" value="Complete ERP with Hybrid Capabilities" required>
                </div>
                <div class="col-md-6">
                    <label for="app_title" class="form-label">Application Title</label>
                    <input type="text" name="APP_TITLE" value="Online / Offline Syncronization" class="form-control" id="app_title">
                </div>
            </div>

            <h4 class="form-section-title">
                <i class="bi bi-database"></i> Database Details
                <small>Provide correct credentials — these are saved to your <code>.env</code> file.</small>
            </h4>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="db_host" class="form-label">Database Host <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="db_host" name="DB_HOST" required
                        placeholder="localhost / 127.0.0.1" value="localhost">
                </div>
                <div class="col-md-4">
                    <label for="db_port" class="form-label">Database Port <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="db_port" name="DB_PORT" required value="3306">
                </div>
                <div class="col-md-4">
                    <label for="db_database" class="form-label">Database Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="db_database" name="DB_DATABASE" required>
                </div>
                <div class="col-md-6">
                    <label for="db_username" class="form-label">Database Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="db_username" name="DB_USERNAME" required>
                </div>
                <div class="col-md-6">
                    <label for="db_password" class="form-label">Database Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="db_password" name="DB_PASSWORD" autocomplete="new-password" required>
                </div>
            </div>

            <h4 class="form-section-title">
                <i class="bi bi-envelope-at"></i> Email Configuration
                <small>Used for sending notification emails.</small>
            </h4>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="MAIL_MAILER" class="form-label">Send mails using <span class="text-danger">*</span></label>
                    <select class="form-select" name="MAIL_MAILER" id="MAIL_MAILER">
                        <option value="sendmail">PHP Mail</option>
                        <option value="smtp">SMTP</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="MAIL_FROM_ADDRESS" class="form-label">Default From Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="MAIL_FROM_ADDRESS"
                        name="MAIL_FROM_ADDRESS" placeholder="hello@actuarypos.com" value="info@actuarypos.com" required>
                </div>
                <div class="col-md-6">
                    <label for="MAIL_FROM_NAME" class="form-label">Default From Name</label>
                    <input type="text" class="form-control" id="MAIL_FROM_NAME" name="MAIL_FROM_NAME"
                        placeholder="ProSurface Team">
                </div>

                <div class="col-md-4 smtp hide">
                    <label for="MAIL_HOST" class="form-label">SMTP Host <span class="text-danger">*</span></label>
                    <input type="text" class="form-control smtp_input" id="MAIL_HOST" name="MAIL_HOST" required disabled>
                </div>
                <div class="col-md-4 smtp hide">
                    <label for="MAIL_PORT" class="form-label">SMTP Port <span class="text-danger">*</span></label>
                    <input type="text" class="form-control smtp_input" id="MAIL_PORT" name="MAIL_PORT" required disabled>
                </div>
                <div class="col-md-4 smtp hide">
                    <label for="MAIL_ENCRYPTION" class="form-label">Encryption <span class="text-danger">*</span></label>
                    <input type="text" class="form-control smtp_input" id="MAIL_ENCRYPTION" name="MAIL_ENCRYPTION" required disabled placeholder="tls or ssl">
                </div>
                <div class="col-md-6 smtp hide">
                    <label for="MAIL_USERNAME" class="form-label">SMTP Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control smtp_input" id="MAIL_USERNAME" name="MAIL_USERNAME" required disabled>
                </div>
                <div class="col-md-6 smtp hide">
                    <label for="MAIL_PASSWORD" class="form-label">SMTP Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control smtp_input" id="MAIL_PASSWORD" name="MAIL_PASSWORD" autocomplete="new-password" required disabled>
                </div>
            </div>

            <div class="text-center text-danger install_msg hide mt-4">
                <strong><i class="bi bi-hourglass-split"></i> Installation in progress &mdash; please do not refresh, go back or close the browser.</strong>
            </div>
    </div>

    <div class="install-card-footer">
        <a href="<?php echo e(route('install.index'), false); ?>" class="btn btn-default back_button" tabindex="-1">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
        <button type="submit" id="install_button" class="btn btn-primary">
            <i class="bi bi-cloud-download me-1"></i> Install Now
        </button>
    </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('select#MAIL_MAILER').change(function () {
            var driver = $(this).val();
            if (driver === 'smtp') {
                $('div.smtp').removeClass('hide');
                $('input.smtp_input').attr('disabled', false);
            } else {
                $('div.smtp').addClass('hide');
                $('input.smtp_input').attr('disabled', true);
            }
        });

        $('form#details_form').submit(function () {
            $('button#install_button').attr('disabled', true).html('<i class="bi bi-hourglass-split me-1"></i> Installing...');
            $('div.install_msg').removeClass('hide');
            $('.back_button').hide();
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.install', ['no_header' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>