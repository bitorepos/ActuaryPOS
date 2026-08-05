
<?php $__env->startSection('title', __('lang_v1.preview_imported_sales')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.preview_imported_sales'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <?php echo Form::open(['url' => action([\App\Http\Controllers\ImportSalesController::class, 'import']), 'method' => 'post', 'id' => 'import_sale_form']); ?>

    <?php echo Form::hidden('file_name', $file_name); ?>

    <?php $__env->startComponent('components.widget'); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <?php echo Form::label('group_by', __('lang_v1.group_sale_line_by') . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.group_by_tooltip') . '"></i>';
                }
            ?>
                <?php echo Form::select('group_by', $parsed_array[0], null, ['class' => 'form-control select2', 'required', 'placeholder' => __('messages.please_select')]); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <?php echo Form::label('location_id', __('business.business_location') . ':*'); ?>

                <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control', 'required', 'placeholder' => __('messages.please_select')]); ?>

            </div>
        </div>
    </div>
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('components.widget'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="scroll-top-bottom" style="max-height: 400px;">
                <table class="table table-condensed table-striped table-th-skin">
                    <?php $__currentLoopData = array_slice($parsed_array, 0, 101); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php if($loop->index > 0 ): ?><?php echo e($loop->index, false); ?> <?php else: ?> # <?php endif; ?></td>
                            <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($loop->parent->index == 0): ?>
                                    <th><?php echo e($v, false); ?></th>
                                <?php else: ?>
                                    <td><?php echo e($v, false); ?></td>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        <?php if($loop->index == 0): ?>
                            <tr>
                            <td><?php if($loop->index > 0 ): ?><?php echo e($loop->index, false); ?><?php endif; ?></td>
                            <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td>
                                    <?php echo Form::select('import_fields[' . $k . ']', $import_fields, $match_array[$k], ['class' => 'form-control import_fields select2', 'placeholder' => __('lang_v1.skip'), 'style' => 'width: 100%;']); ?>

                                </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
        </div>
    </div>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary float-end"><?php echo app('translator')->get('messages.submit'); ?></button>
        </div>
    </div>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).on('submit', 'form#import_sale_form', function(){
        var import_fields = [];

        $('.import_fields').each( function() {
            if ($(this).val()) {
                import_fields.push($(this).val());
            }
        });

        if (import_fields.indexOf('customer_phone_number') == -1 && import_fields.indexOf('customer_email') == -1) {
            alert("<?php echo e(__('lang_v1.email_or_phone_required'), false); ?>");
            return false;
        }
        if (import_fields.indexOf('product') == -1 && import_fields.indexOf('sku') == -1) {
            alert("<?php echo e(__('lang_v1.product_name_or_sku_is_required'), false); ?>");
            return false;
        }
        if (import_fields.indexOf('quantity') == -1) {
            alert("<?php echo e(__('lang_v1.quantity_is_required'), false); ?>");
            return false;
        }
        if (import_fields.indexOf('unit_price') == -1) {
            alert("<?php echo e(__('lang_v1.unit_price_is_required'), false); ?>");
            return false;
        }

        if(hasDuplicates(import_fields)) {
            alert("<?php echo e(__('lang_v1.cannot_select_a_field_twice'), false); ?>");
            return false;
        }
        
    });

    function hasDuplicates(array) {
        return (new Set(array)).size !== array.length;
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>