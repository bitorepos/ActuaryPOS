<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale(), false); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">

    <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e(config('app.name', 'POS'), false); ?></title>

    <?php echo $__env->make('layouts.partials.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <link rel="stylesheet" href="<?php echo e(asset('css/install-onedash.css?v=' . ($asset_v ?? time())), false); ?>">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition install-wizard">
    <?php if(session('status')): ?>
        <input type="hidden" id="status_span" data-status="<?php echo e(session('status.success'), false); ?>" data-msg="<?php echo e(session('status.msg'), false); ?>">
    <?php endif; ?>

    <div class="install-shell">
        <div class="install-brand">
            <div class="brand-logo">
                <i class="bi bi-shop-window"></i>
            </div>
            <h1><?php echo e(config('app.name', 'BitorePOS'), false); ?></h1>
            <p><?php echo $__env->yieldContent('subtitle', 'Setup Wizard'); ?></p>
        </div>

        <?php echo $__env->yieldContent('content'); ?>

        <div class="install-footer-note">
            &copy; <?php echo e(date('Y'), false); ?> <?php echo e(config('app.name', 'BitorePOS'), false); ?> &middot; Need help?
            <a href="https://programmaticsurface.com/docs/getting-started/installing-pos/" target="_blank" rel="noopener">View Documentation</a>
        </div>
    </div>

    <?php echo $__env->make('layouts.partials.javascripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="<?php echo e(asset('js/login.js?v=' . ($asset_v ?? time())), false); ?>"></script>
    <?php echo $__env->yieldContent('javascript'); ?>

    <script type="text/javascript">
        $(document).ready(function () {
            if (typeof $.fn.select2 === 'function') {
                $('.select2_register').select2();
            }
        });
    </script>
</body>
</html>
