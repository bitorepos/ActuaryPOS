<div class="modal-dialog" role="document">
    <?php echo Form::open(['url' => action([\App\Http\Controllers\PurchaseOrderController::class, 'postEditPurchaseOrderStatus'], ['id' => $id]), 'method' => 'put', 'id' => 'update_po_status_form']); ?>

    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"><?php echo app('translator')->get('lang_v1.edit_status'); ?></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mb-3">
                        <?php echo Form::label('po_status', __('sale.status') . ':'); ?>

                        <select name="status" id="po_status" class="form-select" style="width: 100%;">
                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $po_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key, false); ?>" <?php if($key == $status): ?> selected <?php endif; ?>>
                                    <?php echo e($po_status['label'], false); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
            <button type="submit" class="btn btn-primary ladda-button">
                <?php echo app('translator')->get('messages.update'); ?>
            </button>
        </div>
    </div><!-- /.modal-content -->
    <?php echo Form::close(); ?>

</div><!-- /.modal-dialog -->
