
<?php $__env->startSection('title', config('app.name', 'BitorePOS')); ?>

<?php $__env->startSection('content'); ?>
    <style type="text/css">
        .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
                margin-top: 10%;
            }
        .title {
                font-size: 84px;
            }
        .tagline {
                font-size:25px;
                font-weight: 300;
                text-align: center;
            }

        @media only screen and (max-width: 600px) {
            .title{
                font-size: 38px;
            }
            .tagline {
                font-size:18px;
            }
        }
    </style>
    <div class="title flex-center" style="font-weight: 600 !important;">
        Upgrade in Progress...
    </div>
    <p class="tagline">
        Please wait while we upgrade the site to new version.<br>
        For Sales & Support Queries:<br>
        Hafiz Asif<br>
        +91000000000
    </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>