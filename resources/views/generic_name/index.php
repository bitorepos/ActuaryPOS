
<?php $__env->startSection('title', __('product.generic_name')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.generic_names'); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'lang_v1.generic_names' )]); ?>
        <?php if(!$is_offline): ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <button type="button" class="btn btn-primary btn-modal" 
                    data-href="<?php echo e(action([\App\Http\Controllers\GenericNameController::class, 'create']), false); ?>" 
                    data-container=".view_modal">   
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
                    <a class="btn btn-success" 
                    href="import-generic-names"> Import </a>
                
            </div>
        <?php $__env->endSlot(); ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group mb-2">
                    <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                    </label>
                </div>
            </div>
        </div>
        <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="generic_name_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get( 'lang_v1.name' ); ?></th>
                    <th>Created By</th>
                    <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                </tr>
            </thead>
        </table>
</div>
    <?php echo $__env->renderComponent(); ?>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>