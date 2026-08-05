<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\ProductNoteController::class, 'update'], [$product_note->id]), 'method' => 'put', 'id' => 'product_note_form']); ?>


    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get('product.edit_product_note'); ?></h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
        <?php echo Form::label('product_id', __('sale.product') . ':*'); ?>

        <?php echo Form::select('product_id', $product_dropdown, $product_note->product_id, ['class' => 'form-control product-note-product-select', 'required', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); ?>

      </div>

      <div class="form-group">
        <?php echo Form::label('priority_status', __('product.priority_status') . ':*'); ?>

        <?php echo Form::select('priority_status', $priority_statuses, $product_note->priority_status, ['class' => 'form-control select2', 'required', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); ?>

      </div>

      <div class="form-group">
        <?php echo Form::label('note', __('product.note') . ':*'); ?>

        <?php echo Form::textarea('note', $product_note->note, ['class' => 'form-control', 'required', 'rows' => 4, 'placeholder' => __('product.note')]); ?>

      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.update'); ?></button>
      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div>
</div>
