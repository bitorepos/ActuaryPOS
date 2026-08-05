
<?php $__env->startSection('title', __('lang_v1.import_tables')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.import_tables'); ?>
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
                <?php echo Form::open(['url' => action([\App\Http\Controllers\Restaurant\TableController::class, 'importTables']), 'method' => 'post', 'enctype' => 'multipart/form-data' ]); ?>

                    <div class="row">
                        <div class="col-sm-6">
                        <div class="col-sm-8">
                            <div class="mb-3">
                                <?php echo Form::label('name', __( 'product.file_to_import' ) . ':'); ?>

                                <?php echo Form::file('tables_csv', ['accept'=> '.xls, .xlsx, .csv', 'required' => 'required']); ?>

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

                <br><br>
                <div class="row">
                    <div class="col-sm-4">
                        <a href="<?php echo e(asset('files/import_tables_template.xlsx'), false); ?>" class="btn btn-success" download><i class="fa fa-download"></i> <?php echo app('translator')->get('lang_v1.download_template_file'); ?></a>
                    </div>
                </div>
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
                        <td><?php echo app('translator')->get('purchase.business_location'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.required'); ?>)</small></td>
                        <td>Business Location Name</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><?php echo app('translator')->get('invoice.invoice_layout'); ?> </td>
                        <td>Invoice Layout Name</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><?php echo app('translator')->get('restaurant.table'); ?> Name <small class="text-muted">(<?php echo app('translator')->get('lang_v1.required'); ?>)</small></td>
                        <td>Table Name</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><?php echo app('translator')->get('restaurant.description'); ?></td>
                        <td>Table Description</td>
                    </tr>

                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>