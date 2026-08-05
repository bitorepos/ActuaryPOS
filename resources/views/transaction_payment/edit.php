<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\BrandController::class, 'update'], [$brand->id]), 'method' => 'PUT', 'id' => 'brand_edit_form' ]); ?>


    <div class="modal-header">
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'brand.edit_brand' ); ?></h4>
    </div>

    <div class="modal-body">
      <div class="mb-3">
        <?php echo Form::label('name', __( 'brand.brand_name' ) . ':*'); ?>

          <?php echo Form::text('name', $brand->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'brand.brand_name' )]); ?>

      </div>

      <div class="mb-3">
        <?php echo Form::label('description', __( 'brand.short_description' ) . ':'); ?>

          <?php echo Form::text('description', $brand->description, ['class' => 'form-control','placeholder' => __( 'brand.short_description' )]); ?>

      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
