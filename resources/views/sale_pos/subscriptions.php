
<?php $__env->startSection('title', __( 'lang_v1.subscriptions')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo app('translator')->get( 'lang_v1.subscriptions'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.recurring_invoice_help') . '"></i>';
                }
            ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
	<div class="box box-primary">
        <div class="box-header">
        	<!-- <h3 class="box-title"></h3> -->
        </div>
        <div class="box-body">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sell.view')): ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <?php echo Form::label('subscriptions_filter_date_range', __('report.date_range') . ':'); ?>

                            <?php echo Form::text('subscriptions_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

                        </div>
                    </div>
                </div>
                <?php echo $__env->make('sale_pos.partials.subscriptions_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('sale_pos.partials.subscriptions_table_javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>