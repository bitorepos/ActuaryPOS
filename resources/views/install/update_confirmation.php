
<?php $__env->startSection('title', 'Update Confirmation'); ?>
<?php $__env->startSection('subtitle', 'System Update'); ?>

<?php $__env->startSection('content'); ?>
<div class="install-card">
    <div class="install-card-header">
        <h2><i class="bi bi-arrow-up-circle"></i> Update <?php echo e(config('app.name', 'POS'), false); ?></h2>
        <p class="subtitle">Apply the latest updates to your installation.</p>
    </div>
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

        <div class="alert alert-danger">
            <strong><i class="bi bi-exclamation-triangle"></i> Important.</strong>
            Updating may break a production environment. Please verify the update on a staging or
            development system before applying it to production. We recommend taking a full database
            and file backup first.
        </div>

        <form class="form" id="details_form" method="post" action="<?php echo e(url('/install/update'), false); ?>">
            <?php echo e(csrf_field(), false); ?>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <button type="submit" id="install_button" class="btn btn-primary">
                    <i class="bi bi-arrow-up-circle me-1"></i> I Understand, Update
                </button>
            </div>
        </form>
    </div>
    <div class="install-card-footer">
        <span class="text-muted small"><i class="bi bi-shield-lock"></i> A backup is strongly recommended.</span>
        <span></span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('form#details_form').submit(function (e) {
            e.preventDefault();

            var form = this;
            var $button = $('button#install_button');
            $button.attr('disabled', true).html('<i class="bi bi-hourglass-split me-1"></i> Updating...');

            clearUpdateBrowserCaches().always(function () {
                form.submit();
            });
        });

        function clearUpdateBrowserCaches() {
            var tasks = [];

            if ('caches' in window) {
                tasks.push(
                    caches.keys().then(function (cacheNames) {
                        return Promise.all(cacheNames.map(function (cacheName) {
                            return caches.delete(cacheName);
                        }));
                    })
                );
            }

            if ('serviceWorker' in navigator) {
                tasks.push(
                    navigator.serviceWorker.getRegistrations().then(function (registrations) {
                        return Promise.all(registrations.map(function (registration) {
                            return registration.unregister();
                        }));
                    })
                );
            }

            if (! tasks.length) {
                return $.Deferred().resolve().promise();
            }

            return $.when.apply($, tasks.map(function (task) {
                return $.Deferred(function (deferred) {
                    Promise.resolve(task).then(deferred.resolve).catch(deferred.resolve);
                }).promise();
            }));
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.install', ['no_header' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>