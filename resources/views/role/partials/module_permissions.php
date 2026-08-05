 <?php if(count($module_permissions) > 0): ?>
  <?php
    $module_role_permissions = [];
    if(!empty($role_permissions)) {
      $module_role_permissions = $role_permissions;
    }
  ?>
  <?php $__currentLoopData = $module_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php if($key == 'Essentials'): ?>
    <?php echo $__env->make('role.partials.essentials_permissions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php continue; ?>
  <?php endif; ?>
  <?php if($key == 'Manufacturing'): ?>
    <?php echo $__env->make('role.partials.manufacturing_permissions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php continue; ?>
  <?php endif; ?>
  <?php if($key == 'Accounting'): ?>
    <?php echo $__env->make('role.partials.accounting_permissions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php continue; ?>
  <?php endif; ?>
  <?php if($key == 'Project'): ?>
    <?php echo $__env->make('role.partials.project_permissions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php continue; ?>
  <?php endif; ?>
  <?php if($key == 'Installment'): ?>
    <?php echo $__env->make('role.partials.installment_permissions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php continue; ?>
  <?php endif; ?>
  <div class="pos-tab-content">
    <div class="row check_group">
      <div class="col-md-3">
        <h4><?php echo e($key, false); ?></h4>
      </div>
      <div class="col-md-9">
        <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module_permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          if(empty($role_permissions) && $module_permission['default']) {
            $module_role_permissions[] = $module_permission['value'];
          }
        ?>
        <div class="col-md-12">
          <div class="form-check">
            <label>
              <?php if(!empty($module_permission['is_radio'])): ?>
                <?php echo Form::radio('radio_option[' . $module_permission['radio_input_name'] . ']', $module_permission['value'], in_array($module_permission['value'], $module_role_permissions), 
              [ 'class' => 'form-check-input']); ?> <?php echo e($module_permission['label'], false); ?>

              <?php else: ?>
              <?php echo Form::checkbox('permissions[]', $module_permission['value'], in_array($module_permission['value'], $module_role_permissions), 
              [ 'class' => 'form-check-input']); ?> <?php echo e($module_permission['label'], false); ?>

              <?php endif; ?>
            </label>
          </div>

          <?php if(isset($module_permission['end_group']) && $module_permission['end_group']): ?>
          <hr>
          <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
