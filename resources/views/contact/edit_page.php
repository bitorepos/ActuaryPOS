

<?php $__env->startSection('title', __('contact.edit_contact')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('contact.edit_contact'); ?></h1>
</section>

<section class="content">
    <?php echo $__env->make('contact.edit', ['render_full_page' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>

<div id="contact-footer-actions-template" class="d-none">
    <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo e(action([\App\Http\Controllers\ContactController::class, 'index'], ['type' => $contact->type]), false); ?>'">
        <i class="fas fa-times"></i> <?php echo app('translator')->get('messages.close'); ?>
    </button>
    <button type="submit" form="contact_edit_form" class="btn btn-primary">
        <i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>
    </button>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>