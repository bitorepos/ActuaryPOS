<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\ExpenseCategoryController::class, 'store']), 'method' => 'post', 'id' => 'expense_category_add_form' ]); ?>

    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'expense.add_expense_category' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
      <div class="form-group mb-2">
        <?php echo Form::label('name', __( 'expense.category_name' ) . ':*'); ?>

          <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'expense.category_name' )]); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('code', __( 'expense.category_code' ) . ':'); ?>

          <?php echo Form::text('code', null, ['class' => 'form-control', 'placeholder' => __( 'expense.category_code' )]); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('budget', __( 'expense.budget' ) . ':'); ?>

          <?php echo Form::text('budget', null, ['class' => 'form-control input_number', 'placeholder' => __( 'expense.budget' ), 'inputmode' => 'decimal']); ?>

      </div>

      <div class="form-group mb-2">
          <div class="form-check">
            <label class="form-check-label">
<?php echo Form::checkbox('add_as_sub_cat', 1, false,[ 'class' => 'toggler form-check-input', 'data-toggle_id' => 'parent_cat_div' ]); ?> <?php echo app('translator')->get( 'lang_v1.add_as_sub_cat' ); ?>
            </label>
          </div>
      </div>
      <div class="form-group mb-2 hide" id="parent_cat_div">
          <?php echo Form::label('parent_id', __( 'category.select_parent_category' ) . ':'); ?>

          <?php echo Form::select('parent_id', $categories, null, ['class' => 'form-control', 'placeholder' => __('lang_v1.none')]); ?>

      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
