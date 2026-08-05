<div class="modal-dialog" role="document">
    <?php echo Form::open(['url' => action([\App\Http\Controllers\SalesOrderController::class, 'postEditSalesOrderStatus'], ['id' => $id]), 'method' => 'put', 'id' => 'update_so_status_form']); ?>

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title"><?php echo app('translator')->get('lang_v1.edit_status'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mb-3">
                        <?php echo Form::label('so_status', __('sale.status') . ':'); ?>

                        <select name="status" id="so_status" class="form-control" style="width: 100%;">
                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $so_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key, false); ?>" <?php if($key == $status): ?> selected <?php endif; ?>>
                                    <?php echo e($so_status['label'], false); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
            <button type="submit" class="btn btn-primary ladda-button">
                <?php echo app('translator')->get('messages.update'); ?>
            </button>
        </div>
    </div><!-- /.modal-content -->
    <?php echo Form::close(); ?>

</div><!-- /.modal-dialog -->
