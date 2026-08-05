<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\BrandController::class, 'update'], [$brand->id]), 'method' => 'PUT', 'id' => 'brand_edit_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'brand.edit_brand' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
    </div>

    <div class="modal-body">
      <div class="form-group mb-2">
        <?php echo Form::label('name', __( 'brand.brand_name' ) . ':*'); ?>

          <?php echo Form::text('name', $brand->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'brand.brand_name' )]); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('description', __( 'brand.short_description' ) . ':'); ?>

          <?php echo Form::text('description', $brand->description, ['class' => 'form-control','placeholder' => __( 'brand.short_description' )]); ?>

      </div>

      <?php if(session('business.enable_sub_brand') && !empty($parent_brands)): ?>
      <div class="form-group mb-2">
        <div class="form-check">
          <label class="form-check-label">
<?php echo Form::checkbox('add_as_sub_brand', 1, !$is_parent, [ 'class' => 'toggler form-check-input', 'data-toggle_id' => 'parent_brand_div' ]); ?> <?php echo app('translator')->get('lang_v1.add_as_sub_txonomy'); ?>
          </label>
        </div>
      </div>
      <div class="form-group mb-2 <?php if($is_parent): ?> <?php echo e('hide', false); ?> <?php endif; ?>" id="parent_brand_div">
        <?php echo Form::label('parent_id', __( 'lang_v1.select_parent_taxonomy' ) . ':'); ?>

        <?php echo Form::select('parent_id', $parent_brands, $selected_parent, ['class' => 'form-select']); ?>

      </div>
      <?php endif; ?>

        <?php if($is_repair_installed): ?>
          <div class="form-group mb-2">
             <label class="form-check-label">
<?php echo Form::checkbox('use_for_repair', 1, $brand->use_for_repair, ['class' => 'form-check-input']); ?>

                <?php echo e(__( 'repair::lang.use_for_repair' ), false); ?>

            </label>
            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('repair::lang.use_for_repair_help_text') . '"></i>';
                }
            ?>
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
