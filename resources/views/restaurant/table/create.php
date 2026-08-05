<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\Restaurant\TableController::class, 'store']), 'method' => 'post', 'id' => 'table_add_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'restaurant.add_table' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   
    </div>

    <div class="modal-body">

      <?php if(count($business_locations) == 1): ?>
        <?php 
            $default_location = current(array_keys($business_locations->toArray())) 
        ?>
      <?php else: ?>
        <?php $default_location = null; ?>
      <?php endif; ?>
      <div class="form-group mb-2">
        <?php echo Form::label('location_id', __('purchase.business_location').':*'); ?>

        <?php echo Form::select('location_id', $business_locations, $default_location, ['class' => 'form-select select2', 'placeholder' => __('messages.please_select'), 'required']); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('layout_id', 'Invoice Layout:'); ?>

        <?php echo Form::select('layout_id', $invoice_layouts, null, ['class' => 'form-select select2', 'placeholder' => __('messages.please_select')]); ?>

      </div>
      
      <div class="form-group mb-2">
        <?php echo Form::label('name', __( 'restaurant.table_name' ) . ':*'); ?>

          <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'restaurant.table_name' ) ]); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('description', __( 'restaurant.short_description' ) . ':'); ?>

          <?php echo Form::text('description', null, ['class' => 'form-control','placeholder' => __( 'restaurant.short_description' )]); ?>

      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
