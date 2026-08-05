<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\AccountController::class, 'store']), 'method' => 'post', 'id' => 'payment_account_form' ]); ?>


    <div class="modal-header" style="position:sticky; top:0; z-index:1055; background:#fff; border-bottom:1px solid #dee2e6;">
      <h4 class="modal-title"><?php echo app('translator')->get( 'account.add_account' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body" style="max-height:70vh; overflow-y:auto; overflow-x:auto;">
            <div class="form-group mb-2">
                <?php echo Form::label('name', __( 'lang_v1.name' ) .":*"); ?>

                <?php echo Form::text('name', null, ['class' => 'form-control', 'required','placeholder' => __( 'lang_v1.name' ) ]); ?>

            </div>

            <div class="form-group mb-2">
                <?php echo Form::label('account_number', __( 'account.account_number' ) .":*"); ?>

                <?php echo Form::text('account_number', null, ['class' => 'form-control', 'required','placeholder' => __( 'account.account_number' ) ]); ?>

            </div>

            <div class="form-group mb-2">
                <?php echo Form::label('account_type_id', __( 'account.account_type' ) .":"); ?>

                <select name="account_type_id" class="form-control select2">\
                    <option><?php echo app('translator')->get('messages.please_select'); ?></option>
                    <?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <optgroup label="<?php echo e($account_type->name, false); ?>">
                            <option value="<?php echo e($account_type->id, false); ?>"><?php echo e($account_type->name, false); ?></option>
                            <?php $__currentLoopData = $account_type->sub_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($sub_type->id, false); ?>"><?php echo e($sub_type->name, false); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group mb-2">
                <?php echo Form::label('opening_balance', __( 'account.opening_balance' ) .":"); ?>

                <?php echo Form::text('opening_balance', 0, ['class' => 'form-control input_number','placeholder' => __( 'account.opening_balance' ) ]); ?>

            </div>

            <label><?php echo app('translator')->get('lang_v1.account_details'); ?>:</label>
            <table class="table table-striped">
                <tr>
                    <th>
                        <?php echo app('translator')->get('lang_v1.label'); ?>
                    </th>
                    <th>
                        <?php echo app('translator')->get('product.value'); ?>
                    </th>
                </tr>
                <?php for($i = 0; $i < 6; $i++): ?>
                    <tr>
                        <td>
                            <?php echo Form::text('account_details['.$i.'][label]', null, ['class' => 'form-control']); ?>

                        </td>
                        <td>
                            <?php echo Form::text('account_details['.$i.'][value]', null, ['class' => 'form-control']); ?>      
                        </td>
                    </tr>
                <?php endfor; ?>
            </table>
        
            <div class="form-group mb-2">
                <?php echo Form::label('note', __( 'brand.note' )); ?>

                <?php echo Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => __( 'brand.note' ), 'rows' => 4]); ?>

            </div>
    </div>

    <div class="modal-footer" style="position:sticky; bottom:0; z-index:1055; background:#fff; border-top:1px solid #dee2e6;">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
