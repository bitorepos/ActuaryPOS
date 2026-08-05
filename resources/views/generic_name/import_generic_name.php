
<?php $__env->startSection('title', __('product.import_products')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.import_generic_names'); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    
    <?php if(session('notification') || !empty($notification)): ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                    <?php if(!empty($notification['msg'])): ?>
                        <?php echo e($notification['msg'], false); ?>

                    <?php elseif(session('notification.msg')): ?>
                        <?php echo e(session('notification.msg'), false); ?>

                    <?php endif; ?>
                </div>
            </div>  
        </div>     
    <?php endif; ?>
    
    <div class="row">
        <div class="col-sm-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                <?php echo Form::open(['url' => action([\App\Http\Controllers\ImportGenericNameController::class, 'store']), 'method' => 'post', 'enctype' => 'multipart/form-data' ]); ?>

                    <div class="row">
                        <div class="col-sm-6">
                        <div class="col-sm-8">
                            <div class="mb-3">
                                <?php echo Form::label('name', __( 'product.file_to_import' ) . ':'); ?>

                                <?php echo Form::file('generic_name_csv', ['accept'=> '.xls, .xlsx, .csv', 'required' => 'required']); ?>

                            </div>
                        </div>
                        <div class="col-sm-4">
                        <br>
                            <input type="hidden" name="created_by" value="<?php echo e(Session::get('user.id'), false); ?>">
                            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.submit'); ?></button>
                        </div>
                        </div>
                    </div>

                <?php echo Form::close(); ?>

                
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.instructions')]); ?>
                <strong><?php echo app('translator')->get('lang_v1.instruction_line1'); ?></strong><br>
                    <?php echo app('translator')->get('lang_v1.instruction_line2'); ?>
                    <br><br>
                <table class="table table-striped">
                    <tr>
                        <th><?php echo app('translator')->get('lang_v1.col_no'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.col_name'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.instruction'); ?></th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td><?php echo app('translator')->get('product.generic_name'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.required'); ?>)</small></td>
                        <td>Only the Generic Name, no potency or weightage</td>
                    </tr>

                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>