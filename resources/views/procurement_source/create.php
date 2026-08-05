<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\ProcurementSourceController::class, 'store']), 'method' => 'post', 'id' => $quick_add ? 'quick_add_procurement_source_form' : 'procurement_source_add_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'procurement_source.add_procurement_source' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
    </div>

    <div class="modal-body">
      <div class="form-group mb-2">
        <?php echo Form::label('name', __( 'procurement_source.procurement_source_name' ) . ':*'); ?>

          <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'procurement_source.procurement_source_name' ) ]); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('description', __( 'procurement_source.short_description' ) . ':'); ?>

          <?php echo Form::text('description', null, ['class' => 'form-control','placeholder' => __( 'procurement_source.short_description' )]); ?>

      </div>

      <?php if(session('business.enable_sub_procurement_source') && !empty($parent_procurement_sources)): ?>
      <div class="form-group mb-2">
        <div class="form-check">
          <label class="form-check-label">
<?php echo Form::checkbox('add_as_sub_procurement_source', 1, false, [ 'class' => 'toggler form-check-input', 'data-toggle_id' => 'parent_procurement_source_div' ]); ?> <?php echo app('translator')->get('lang_v1.add_as_sub_txonomy'); ?>
          </label>
        </div>
      </div>
      <div class="form-group mb-2 hide" id="parent_procurement_source_div">
        <?php echo Form::label('parent_id', __( 'lang_v1.select_parent_taxonomy' ) . ':'); ?>

        <?php echo Form::select('parent_id', $parent_procurement_sources, null, ['class' => 'form-select']); ?>

      </div>
      <?php endif; ?>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
