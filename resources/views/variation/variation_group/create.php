<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\VariationTemplateGroupController::class, 'store']), 'method' => 'post', 'id' => 'variation_group_add_form' ]); ?>

    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get('lang_v1.add_variation_group'); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
    </div>

    <div class="modal-body">
        <div class="form-group mb-2">
          <?php echo Form::label('name',__('lang_v1.variation_group_name') . ':*'); ?>

          <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('lang_v1.variation_group_name')]); ?>

        </div>
        <div class="form-group mb-2 ">
          <?php echo Form::label('variation_templates[]', __( 'product.variations' ) . ':*'); ?>

          <?php echo Form::select('variation_templates[]', $variation_templates, null, ['class' => 'form-control select2', 'required', 'multiple']); ?>

        </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.save'); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
