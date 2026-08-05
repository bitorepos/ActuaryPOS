<!doctype html>
<html lang="<?php echo e(config('app.locale'), false); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <!-- Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,600" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="<?php echo e(asset('css/vendor.css'), false); ?>">
    <!-- Styles -->
    <style>
        body {
            min-height: 100vh;
            /* background-color: rgb(79, 126, 141); */
            background-color: #3C84AB;
            color: rgb(0, 0, 0);
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.12'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .navbar-default {
            background-color: #79E0EE;
            background-color: #79E0EE;
            background-image: linear-gradient(to right, #79E0EE, #3C84AB);
            border: none;
        }
        .navbar-static-top {
            margin-bottom: 19px;
        }
        .navbar-default .navbar-nav>li>a {
            color: rgb(0, 0, 0);
            font-weight: 600;
            font-size: 15px;
        }
        .navbar-default .navbar-nav>li>a:hover {
            color: white;
            box-shadow: 0 10px 20px 0 rgba(5, 16, 44, .15);
            border-radius: 20px 0px 20px 0px;
            background: #ADDDD0;
            margin-top: 2px;
            -webkit-transition: all .3s ease-in-out;
            -moz-transition: all .3s ease-in-out;
            -ms-transition: all .3s ease-in-out;
            -o-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
        }
        .navbar-default .navbar-brand {
            color: rgb(0, 0, 0);
        }
    </style>
</head>
<body>
    <?php echo $__env->make('layouts.partials.home_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        <div class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    <?php echo $__env->make('layouts.partials.javascripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Scripts -->
    <script src="<?php echo e(asset('js/login.js?v=' . $asset_v), false); ?>"></script>
    <?php echo $__env->yieldContent('javascript'); ?>
</body>
</html>
