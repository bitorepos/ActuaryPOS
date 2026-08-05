<?php
    $sell_return_role_permissions = $role_permissions ?? [];
?>


<hr>
<div class="row check_group">
    <div class="col-md-1">
        <h4><?php echo app('translator')->get( 'lang_v1.sell_return' ); ?></h4>
    </div>
    <div class="col-md-2">
        <div class="form-check">
            <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

            </label>
        </div>
    </div>
    <div class="col-md-9">
        <div class="col-md-12">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'access_invoice_sell_return', in_array('access_invoice_sell_return',
                    $sell_return_role_permissions) || in_array('access_sell_return',
                    $sell_return_role_permissions),
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.access_all_invoice_sell_return' ), false); ?>

                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'access_own_invoice_sell_return', in_array('access_own_invoice_sell_return',
                    $sell_return_role_permissions) || in_array('access_own_sell_return',
                    $sell_return_role_permissions),
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.access_own_invoice_sell_return' ), false); ?>

                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'access_direct_sell_return', in_array('access_direct_sell_return',
                    $sell_return_role_permissions) || in_array('access_sell_return',
                    $sell_return_role_permissions),
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.access_all_direct_sell_return' ), false); ?>

                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'access_own_direct_sell_return', in_array('access_own_direct_sell_return',
                    $sell_return_role_permissions) || in_array('access_own_sell_return',
                    $sell_return_role_permissions),
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.access_own_direct_sell_return' ), false); ?>

                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_sell_return', in_array('edit_sell_return',
                    $sell_return_role_permissions) || in_array('access_sell_return',
                    $sell_return_role_permissions) || in_array('access_own_sell_return',
                    $sell_return_role_permissions),
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.edit_sell_return' ), false); ?>

                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'delete_sell_return', in_array('delete_sell_return',
                    $sell_return_role_permissions) || in_array('access_sell_return',
                    $sell_return_role_permissions) || in_array('access_own_sell_return',
                    $sell_return_role_permissions),
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.delete_sell_return' ), false); ?>

                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'sell_return.payments', in_array('sell_return.payments',
                    $sell_return_role_permissions) || in_array('sell.payments',
                    $sell_return_role_permissions),
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.add_sell_return_payment' ), false); ?>

                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_sell_return_payment', in_array('edit_sell_return_payment',
                    $sell_return_role_permissions) || in_array('edit_sell_payment',
                    $sell_return_role_permissions),
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.edit_sell_return_payment' ), false); ?>

                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'delete_sell_return_payment', in_array('delete_sell_return_payment',
                    $sell_return_role_permissions) || in_array('delete_sell_payment',
                    $sell_return_role_permissions),
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.delete_sell_return_payment' ), false); ?>

                </label>
            </div>
        </div>
    </div>
</div>
