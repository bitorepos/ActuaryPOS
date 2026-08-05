<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\ExpenseCategoryController::class, 'update'], [$expense_category->id]), 'method' => 'PUT', 'id' => 'expense_category_add_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'expense.edit_expense_category' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
     <div class="form-group mb-2">
        <?php echo Form::label('name', __( 'expense.category_name' ) . ':*'); ?>

          <?php echo Form::text('name', $expense_category->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'expense.category_name' )]); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('code', __( 'expense.category_code' ) . ':'); ?>

          <?php echo Form::text('code', $expense_category->code, ['class' => 'form-control', 'placeholder' => __( 'expense.category_code' )]); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('budget', __( 'expense.budget' ) . ':'); ?>

        <?php
          $budget_value = ! is_null($expense_category->budget)
              ? rtrim(rtrim(number_format((float) $expense_category->budget, 4, '.', ''), '0'), '.')
              : null;
        ?>
          <?php echo Form::text('budget', $budget_value, ['class' => 'form-control input_number', 'placeholder' => __( 'expense.budget' ), 'inputmode' => 'decimal']); ?>

      </div>

        <div class="form-group mb-2">
            <div class="form-check">
              <label class="form-check-label">
<?php echo Form::checkbox('add_as_sub_cat', 1, !empty($expense_category->parent_id) ,[ 'class' => 'toggler form-check-input', 'data-toggle_id' => 'parent_cat_div' ]); ?> <?php echo app('translator')->get( 'lang_v1.add_as_sub_cat' ); ?>
              </label>
            </div>
        </div>
        <div class="form-group mb-2 <?php if(empty($expense_category->parent_id)): ?> hide <?php endif; ?>" id="parent_cat_div">
            <?php echo Form::label('parent_id', __( 'category.select_parent_category' ) . ':'); ?>

            <?php echo Form::select('parent_id', $categories, $expense_category->parent_id, ['class' => 'form-control', 'placeholder' => __('lang_v1.none')]); ?>

        </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
