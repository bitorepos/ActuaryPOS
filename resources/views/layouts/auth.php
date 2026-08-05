<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale(), false); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">
    <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e(config('app.name', 'POS'), false); ?></title>
    <!-- OneDash Auth CSS -->
    <link href="<?php echo e(asset('onedash/css/bootstrap.min.css'), false); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('onedash/css/bootstrap-extended.css'), false); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('onedash/css/style.css'), false); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('onedash/css/icons.css'), false); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('vendor/bootstrap-icons/bootstrap-icons.css'), false); ?>">
    <link href="<?php echo e(asset('onedash/css/light-theme.css'), false); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('css/vendor.css?v='.$asset_v), false); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css?v='.$asset_v), false); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap5-theme.css?v='.$asset_v), false); ?>">
    <?php echo $__env->yieldContent('css'); ?>
    <style>
        body { background-color: #f7f8fa; }
        .auth-wrapper { min-height: 100vh; display: flex; align-items: center; justify-content: center; }
    </style>
</head>

<body class="<?php $__default_theme = \App\System::getProperty('default_theme_color'); ?> <?php echo e(!empty($__default_theme) ? 'theme-'.$__default_theme : 'theme-blue', false); ?>">
    <?php if(session('status')): ?>
        <input type="hidden" id="status_span" data-status="<?php echo e(session('status.success'), false); ?>" data-msg="<?php echo e(session('status.msg'), false); ?>">
    <?php endif; ?>

    <?php if(!isset($no_header)): ?>
        <?php echo $__env->make('layouts.partials.header-auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <div class="wrapper">
        <main class="authentication-content">
            <div class="container-fluid">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>

    <!-- Add currency related field-->
    <input type="hidden" id="__code" value="PKR">
    <input type="hidden" id="__symbol" value="">
    <input type="hidden" id="__thousand" value=",">
    <input type="hidden" id="__decimal" value=".">
    <input type="hidden" id="__symbol_placement" value="before">
    <input type="hidden" id="__precision" value="<?php echo e(session('business.currency_precision', 2), false); ?>">
    <input type="hidden" id="__quantity_precision" value="<?php echo e(session('business.quantity_precision', 2), false); ?>">
    <input type="hidden" id="__cost_decimal" value="<?php echo e(session('business.cost_decimal', 2), false); ?>">
    <?php echo $__env->make('layouts.partials.javascripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="modal fade view_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel"></div>
    <script src="<?php echo e(asset('js/login.js?v=' . $asset_v), false); ?>"></script>
    <?php echo $__env->yieldContent('javascript'); ?>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.select2_register').select2();
        });
    </script>
</body>
</html>
