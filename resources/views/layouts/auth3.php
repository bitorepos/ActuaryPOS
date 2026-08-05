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
    <?php if(!isLocalInstall() && config('constants.enable_recaptcha')): ?>
        <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <?php endif; ?>
    <style>
        body { background-color: #f7f8fa; margin: 0; }
        .auth-wrapper { min-height: 100vh; display: flex; align-items: center; justify-content: center; }
    </style>
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body class="<?php $__default_theme = \App\System::getProperty('default_theme_color'); ?> <?php echo e(!empty($__default_theme) ? 'theme-'.$__default_theme : 'theme-blue', false); ?>">
    <?php $request = app('Illuminate\Http\Request'); ?>
    <?php if(session('status') && session('status.success')): ?>
        <input type="hidden" id="status_span" data-status="<?php echo e(session('status.success'), false); ?>" data-msg="<?php echo e(session('status.msg'), false); ?>">
    <?php endif; ?>

    <div class="wrapper">
        <main class="authentication-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <div>
                                <select class="form-select form-select-sm" id="change_lang" style="min-width: 140px;">
                                    <?php $__currentLoopData = config('constants.langs'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key, false); ?>" <?php if((empty(request()->lang) && config('app.locale') == $key) || request()->lang == $key): ?> selected <?php endif; ?>>
                                            <?php echo e($val['full_name'], false); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <?php if(!($request->segment(1) == 'business' && $request->segment(2) == 'register')): ?>
                                    <?php if(Route::has('pricing') && config('app.env') != 'demo' && $request->segment(1) != 'pricing' && empty(\App\System::getProperty('disable_pricing'))): ?>
                                        <a class="btn btn-sm btn-outline-info"
                                            href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PricingController::class, 'index']), false); ?>"><?php echo app('translator')->get('superadmin::lang.pricing'); ?></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if($request->segment(1) != 'login'): ?>
                                    <span class="text-muted"><?php echo e(__('business.already_registered'), false); ?></span>
                                    <a href="<?php echo e(action([\App\Http\Controllers\Auth\LoginController::class, 'login']), false); ?><?php if(!empty(request()->lang)): ?> <?php echo e('?lang=' . request()->lang, false); ?> <?php endif; ?>" class="btn btn-sm btn-primary"><?php echo e(__('business.sign_in'), false); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php echo $__env->make('layouts.partials.javascripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="<?php echo e(asset('js/login.js?v=' . $asset_v), false); ?>"></script>
    <?php echo $__env->yieldContent('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2_register').select2();
        });
    </script>
</body>
</html>
