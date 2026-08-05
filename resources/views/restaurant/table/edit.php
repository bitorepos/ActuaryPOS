<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\Restaurant\TableController::class, 'update'], [$table->id]), 'method' => 'PUT', 'id' => 'table_edit_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'restaurant.edit_table' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
    </div>

    <div class="modal-body">
      
      <div class="form-group mb-2">
        <?php echo Form::label('location_id', __('purchase.business_location').':*'); ?>

        <?php echo Form::select('location_id', $business_locations, $table->location_id, ['class' => 'form-select select2', 'placeholder' => __('messages.please_select'), 'required']); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('layout_id', 'Invoice Layout:'); ?>

        <?php echo Form::select('layout_id', $invoice_layouts, $table->layout_id, ['class' => 'form-select select2', 'placeholder' => __('messages.please_select')]); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('name', __( 'restaurant.table_name' ) . ':*'); ?>

          <?php echo Form::text('name', $table->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'brand.brand_name' )]); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('description', __( 'restaurant.short_description' ) . ':'); ?>

          <?php echo Form::text('description', $table->description, ['class' => 'form-control','placeholder' => __( 'brand.short_description' )]); ?>

      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
