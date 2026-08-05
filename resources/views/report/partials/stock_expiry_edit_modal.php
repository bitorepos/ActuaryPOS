<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><b><?php echo app('translator')->get('product.product_name'); ?>:</b> <?php echo e($purchase_line->name, false); ?>, <b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> <?php echo e($purchase_line->ref_no, false); ?></h4>
    </div>
    <form id="stock_exp_modal_form" method="post" action="<?php echo e(route('updateStockExpiryReport'), false); ?>">
    <input type="hidden" value="<?php echo e($purchase_line->id, false); ?>" name="purchase_line_id">
    <div class="modal-body">
      <div class="row">
      <div class="col-md-6">
        <div class="mb-3">
          <?php echo Form::label('exp_date', __( 'product.exp_date' ) . ':*'); ?>

          <?php echo Form::text('exp_date', \Carbon::createFromTimestamp(strtotime($purchase_line->exp_date))->format(session('business.date_format')), ['class' => 'form-control', 'required', 'id' => 'exp_date_expiry_modal', 'readonly']); ?>

          <i><p class="help-block"><?php echo app('translator')->get('lang_v1.expiry_date_will_be_changed_in_pl'); ?></p></i>
        </div>
      </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.update'); ?></button>
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.cancel'); ?></button>
    </div>
    </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
