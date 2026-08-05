<?php
    $role_permissions = $role_permissions ?? [];
    $location_scope_name = $location_scope_name ?? null;
    $location_scope_permission = $location_scope_permission ?? null;
?>

<?php if(!empty($location_scope_name) && !empty($location_scope_permission)): ?>
    <div class="col-md-12">
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <?php echo Form::radio('radio_option['.$location_scope_name.']', '', ! in_array($location_scope_permission, $role_permissions), ['class' => 'form-check-input']); ?>

                <?php echo e(__('role.own_location'), false); ?>

            </label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <?php echo Form::radio('radio_option['.$location_scope_name.']', $location_scope_permission, in_array($location_scope_permission, $role_permissions), ['class' => 'form-check-input']); ?>

                <?php echo e(__('role.all_locations'), false); ?>

            </label>
        </div>
    </div>
<?php endif; ?>
