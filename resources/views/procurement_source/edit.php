<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\ProcurementSourceController::class, 'update'], [$procurement_source->id]), 'method' => 'PUT', 'id' => 'procurement_source_edit_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'procurement_source.edit_procurement_source' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
    </div>

    <div class="modal-body">
      <div class="form-group mb-2">
        <?php echo Form::label('name', __( 'procurement_source.procurement_source_name' ) . ':*'); ?>

          <?php echo Form::text('name', $procurement_source->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'procurement_source.procurement_source_name' )]); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('description', __( 'procurement_source.short_description' ) . ':'); ?>

          <?php echo Form::text('description', $procurement_source->description, ['class' => 'form-control','placeholder' => __( 'procurement_source.short_description' )]); ?>

      </div>

      <?php if(session('business.enable_sub_procurement_source') && !empty($parent_procurement_sources)): ?>
      <div class="form-group mb-2">
        <div class="form-check">
          <label class="form-check-label">
<?php echo Form::checkbox('add_as_sub_procurement_source', 1, !$is_parent, [ 'class' => 'toggler form-check-input', 'data-toggle_id' => 'parent_procurement_source_div' ]); ?> <?php echo app('translator')->get('lang_v1.add_as_sub_txonomy'); ?>
          </label>
        </div>
      </div>
      <div class="form-group mb-2 <?php if($is_parent): ?> <?php echo e('hide', false); ?> <?php endif; ?>" id="parent_procurement_source_div">
        <?php echo Form::label('parent_id', __( 'lang_v1.select_parent_taxonomy' ) . ':'); ?>

        <?php echo Form::select('parent_id', $parent_procurement_sources, $selected_parent, ['class' => 'form-select']); ?>

      </div>
      <?php endif; ?>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
