

<?php $__env->startSection('title', __('contact.add_contact')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('contact.add_contact'); ?></h1>
</section>

<section class="content">
    <?php echo $__env->make('contact.create', ['render_full_page' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>

<div id="contact-footer-actions-template" class="d-none">
    <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo e(action([\App\Http\Controllers\ContactController::class, 'index'], ['type' => $selected_type ?: $type]), false); ?>'">
        <i class="fas fa-times"></i> <?php echo app('translator')->get('messages.close'); ?>
    </button>
    <button type="submit" form="contact_add_form" class="btn btn-primary">
        <i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
    </button>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>