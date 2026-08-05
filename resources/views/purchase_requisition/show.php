<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modalTitle"> <?php echo app('translator')->get('lang_v1.purchase_requisition_details'); ?> (<b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> #<?php echo e($purchase->ref_no, false); ?>)
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <strong><?php echo app('translator')->get('messages.location'); ?>: </strong> <?php echo e($purchase->location->name, false); ?><br>
                    <strong><?php echo app('translator')->get('purchase.ref_no'); ?>: </strong> <?php echo e($purchase->ref_no, false); ?>

                </div>
                <div class="col-md-6">
                    <strong><?php echo app('translator')->get('lang_v1.required_by_date'); ?>: </strong> <?php if(!empty($purchase->delivery_date)): ?><?php echo format_datetime_br($purchase->delivery_date); ?><?php endif; ?> <br>
                    <strong><?php echo app('translator')->get('lang_v1.added_by'); ?>: </strong> <?php echo e($purchase->sales_person->user_full_name, false); ?>

                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <table class="table bg-gray">
                        <thead>
                            <tr class="bg-green">
                                <th><?php echo app('translator')->get('sale.product'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.required_quantity'); ?></th>
                                <th><?php echo app('translator')->get( 'lang_v1.quantity_remaining' ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $purchase->purchase_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                <td>
                                    <?php echo e($purchase_line->product->name, false); ?>

                                    <?php if($purchase_line->product->type == 'single'): ?>
                                     (<?php echo e($purchase_line->product->sku, false); ?>)
                                    <?php else: ?>
                                        - <?php echo e($purchase_line->variations->product_variation->name, false); ?> - <?php echo e($purchase_line->variations->name, false); ?> (<?php echo e($purchase_line->variations->sub_sku, false); ?>)
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo e(number_format($purchase_line->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($purchase_line->product->unit->short_name, false); ?>


                                    <?php if(!empty($purchase_line->product->second_unit) && !empty($purchase_line->secondary_unit_quantity)): ?>
                                        <br>
                                        <?php echo e(number_format($purchase_line->secondary_unit_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($purchase_line->product->second_unit->short_name, false); ?>

                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(number_format($purchase_line->quantity - $purchase_line->po_quantity_purchased, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($purchase_line->product->unit->short_name, false); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
        </div>
  </div>
</div>
