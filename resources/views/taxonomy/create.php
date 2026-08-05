<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\TaxonomyController::class, 'store']), 'method' => 'post', 'id' => $quick_add ? 'quick_category_add_form' : 'category_add_form' ]); ?>

    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'messages.add' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
    </div>

    <div class="modal-body">
      <input type="hidden" name="category_type" value="<?php echo e($category_type, false); ?>">
      <?php
        $name_label = !empty($module_category_data['taxonomy_label']) ? $module_category_data['taxonomy_label'] : __( 'category.category_name' );
        $cat_code_enabled = isset($module_category_data['enable_taxonomy_code']) && !$module_category_data['enable_taxonomy_code'] ? false : true;

        $cat_code_label = !empty($module_category_data['taxonomy_code_label']) ? $module_category_data['taxonomy_code_label'] : __( 'category.code' );

        $enable_sub_category = isset($module_category_data['enable_sub_taxonomy']) && !$module_category_data['enable_sub_taxonomy'] ? false : true;

        $category_code_help_text = !empty($module_category_data['taxonomy_code_help_text']) ? $module_category_data['taxonomy_code_help_text'] : __('lang_v1.category_code_help');
      ?>
      <div class="form-group mb-2">
        <?php echo Form::label('name', $name_label . ':*'); ?>

          <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => $name_label]); ?>

      </div>
      <?php if($cat_code_enabled): ?>
        <?php if($fbr_di_integration && $category_type == 'product'): ?>
        <div class="form-group mb-2">
          <?php echo Form::label('select_fbr_hs_code', __( 'category.code' ) . ':'); ?>

          <?php echo Form::select('select_fbr_hs_code', [], null, ['class' => 'form-control select2']); ?>

          <?php echo Form::hidden('short_code', null, ['id' => 'short_code']); ?>

          <p class="help-block"><?php echo $category_code_help_text; ?></p>
        </div>
        <?php else: ?> 
        <div class="form-group mb-2">
          <?php echo Form::label('short_code', $cat_code_label . ':'); ?>

          <?php echo Form::text('short_code', null, ['class' => 'form-control', 'placeholder' => $cat_code_label]); ?>

          <p class="help-block"><?php echo $category_code_help_text; ?></p>
        </div>
        <?php endif; ?>
      <?php endif; ?>

      <div class="form-group mb-2">
        <?php echo Form::label('description', __( 'lang_v1.description' ) . ':'); ?>

        <?php echo Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.description'), 'rows' => 3]); ?>

      </div>
      <?php if($category_type == 'product'): ?>
      <div class="form-group mb-2">
        <?php echo Form::label('cmmsn_percent', __( 'lang_v1.cmmsn_percent' ) . ':'); ?>

          <?php echo Form::text('cmmsn_percent', 0, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.cmmsn_percent' ), 'required' ]); ?>

      </div>
      <div class="form-group mb-2">
        <div class="form-check">
          <label class="form-check-label" title="<?php echo app('translator')->get('lang_v1.tooltip_not_for_selling'); ?>" data-bs-toggle="tooltip">
            <?php echo Form::checkbox('not_for_selling', 1, false, ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.not_for_selling'); ?>
          </label>
        </div>
      </div>
      <?php endif; ?>
      
      <?php if(!empty($parent_categories) && $enable_sub_category): ?>
        <div class="form-group mb-2">
            <div class="form-check">
              <label class="form-check-label">
<?php echo Form::checkbox('add_as_sub_cat', 1, false,[ 'class' => 'toggler form-check-input', 'data-toggle_id' => 'parent_cat_div' ]); ?> <?php echo app('translator')->get( 'lang_v1.add_as_sub_txonomy' ); ?>
              </label>
            </div>
        </div>
        <div class="form-group mb-2 hide" id="parent_cat_div">
          <?php echo Form::label('parent_id', __( 'category.select_parent_category' ) . ':'); ?>

          <?php echo Form::select('parent_id', $parent_categories, null, ['class' => 'form-select']); ?>

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
