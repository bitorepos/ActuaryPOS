

<?php $__env->startSection('title', __('sale.edit_discount')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('sale.edit_discount'); ?></h1>
</section>

<section class="content">
    <?php echo $__env->make('discount.edit', ['render_full_page' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>

<div id="discount-footer-actions-template" class="d-none">
    <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo e(action([\App\Http\Controllers\DiscountController::class, 'index']), false); ?>'">
        <i class="fas fa-times"></i> <?php echo app('translator')->get('messages.close'); ?>
    </button>
    <button type="submit" form="discount_form" class="btn btn-primary">
        <i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>
    </button>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('discount.partials.form_javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>