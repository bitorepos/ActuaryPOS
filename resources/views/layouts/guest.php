<!DOCTYPE html>
<html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">

    <title><?php echo $__env->yieldContent('title'); ?></title> 

    <link rel="stylesheet" href="<?php echo e(asset('css/vendor.css?v='.$asset_v), false); ?>">
    <!-- Bootstrap 5 -->
    <link href="<?php echo e(asset('onedash/css/bootstrap.min.css'), false); ?>" rel="stylesheet">

    <!-- app css -->
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css?v='.$asset_v), false); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap5-theme.css?v='.$asset_v), false); ?>">
    <style>
        @media print {
            .invoice-print-page {
                height: auto !important;
                min-height: 0 !important;
            }
            .invoice-print-footer-push {
                flex: 0 1 auto !important;
                justify-content: flex-start !important;
            }
        }
    </style>
    <?php echo $__env->yieldContent('extra_css'); ?>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="<?php echo $__env->yieldContent('body_class'); ?>">
    <div id="app"></div>
    <?php if(session('status')): ?>
        <input type="hidden" id="status_span" data-status="<?php echo e(session('status.success'), false); ?>" data-msg="<?php echo e(session('status.msg'), false); ?>">
    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js?v=$asset_v"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js?v=$asset_v"></script>
    <![endif]-->

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo e(asset('js/vendor.js?v=' . $asset_v), false); ?>"></script>
    <script src="<?php echo e(asset('js/functions.js?v=' . $asset_v), false); ?>"></script>
    <script src="<?php echo e(asset('onedash/js/bootstrap.bundle.min.js'), false); ?>"></script>

    <?php echo $__env->yieldContent('javascript'); ?>
</body>

</html>
