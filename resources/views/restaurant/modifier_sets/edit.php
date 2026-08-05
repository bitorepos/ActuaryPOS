<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\Restaurant\ModifierSetsController::class, 'update'], [$modifer_set->id]), 'method' => 'PUT', 'id' => 'edit_form' ]); ?>


    <div class="modal-header">
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'restaurant.edit_modifier' ); ?></h4>
    </div>

    <div class="modal-body">

      <div class="row">
        
        <div class="col-sm-12">
          <div class="mb-3">
            <?php echo Form::label('name', __( 'restaurant.modifier_set' ) . ':*'); ?>

            <?php echo Form::text('name', $modifer_set->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.name' ) ]); ?>

          </div>
        </div>

        <div class="col-sm-12">
          <h4><?php echo app('translator')->get( 'restaurant.modifiers' ); ?></h4>
        </div>

        <div class="col-sm-12">
          <div class="table-responsive">
<table class="table table-condensed" id="add-modifier-table">
            <thead>
              <tr>
                <th><?php echo app('translator')->get( 'restaurant.modifier'); ?></th>
                <th>
                  <?php echo app('translator')->get( 'lang_v1.price'); ?>

                  <?php
                    $html = '<tr><td>
                          <div class="mb-3">
                            <input type="text" name="modifier_name[]" 
                            class="form-control" 
                            placeholder="' . __( 'lang_v1.name' ) . '" required>
                          </div>
                        </td>
                        <td>
                          <div class="mb-3">
                            <input type="text" name="modifier_price[]" class="form-control input_number" 
                            placeholder="' . __( 'lang_v1.price' ) . '" required>
                          </div>
                        </td>
                        <td>
                          <button class="btn btn-danger btn-sm float-end remove-modifier-row" type="button"><i class="fa fa-minus"></i></button>
                        </td>
                        </tr>';
                  ?>
                </th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $modifer_set->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td>
                    <div class="mb-3">
                      <input type="text" name="modifier_name_edit[<?php echo e($modifier->id, false); ?>]" 
                        class="form-control" value="<?php echo e($modifier->name, false); ?>" placeholder="<?php echo app('translator')->get( 'lang_v1.name' ); ?>" required>
                    </div>
                  </td>
                  <td>
                    <div class="mb-3">
                      <input type="text" name="modifier_price_edit[<?php echo e($modifier->id, false); ?>]" 
                      class="form-control input_number" value="<?php echo e(number_format($modifier->sell_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" placeholder="<?php echo app('translator')->get( 'lang_v1.price' ); ?>" required>
                    </div>
                  </td>
                  <td>
                    <?php if(!$loop->first): ?>
                      <button class="btn btn-danger btn-sm float-end remove-modifier-row" type="button"><i class="fa fa-minus"></i></button>
                    <?php else: ?>
                      <button class="btn btn-primary btn-sm float-end add-modifier-row" type="button" data-html="<?php echo e($html, false); ?>">
                        <i class="fa fa-plus"></i>
                      </button>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
</div>
        </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
