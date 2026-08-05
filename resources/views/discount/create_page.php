

<?php $__env->startSection('title', __('lang_v1.add_discount')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.add_discount'); ?></h1>
</section>

<section class="content">
    <?php echo $__env->make('discount.create', ['render_full_page' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>

<div id="discount-footer-actions-template" class="d-none">
    <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo e(action([\App\Http\Controllers\DiscountController::class, 'index']), false); ?>'">
        <i class="fas fa-times"></i> <?php echo app('translator')->get('messages.close'); ?>
    </button>
    <button type="submit" form="discount_form" class="btn btn-primary">
        <i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
    </button>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('discount.partials.form_javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>