<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\PotencyController::class, 'update'], [$potency->id]), 'method' => 'put', 'id' => 'potency_edit_form']); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.edit_potency' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
    </div>

    <div class="modal-body">
      <div class="mb-3">
        <?php echo Form::label('potency', __( 'product.potency' ) . ':*'); ?>

          <?php echo Form::text('potency', $potency->potency, ['class' => 'form-control', 'required', 'placeholder' => __( 'product.potency' ) ]); ?>

      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
