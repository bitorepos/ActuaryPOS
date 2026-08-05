<div class="pos-tab-content">
	<div class="row">
	<?php if(!empty($modules)): ?>
    <div class="col-sm-12">
      <h3><?php echo app('translator')->get('lang_v1.enable_disable_modules'); ?>:</h3>
    </div>
		
		<?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-sm-4">
          <div class="form-group mb-3">
              <div class="form-check">
              <br>
                <label class="form-check-label">
                <?php echo Form::checkbox('enabled_modules[]', $k,  in_array($k, $enabled_modules) , ['class' => 'form-check-input']); ?> <?php echo e($v['name'], false); ?>

                </label>
                <?php if(!empty($v['tooltip'])): ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . $v['tooltip'] . '"></i>';
                }
            ?> <?php endif; ?>
              </div>
          </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    <div class="col-sm-12">
        <hr>
        <h3><?php echo app('translator')->get('lang_v1.designer_settings'); ?>:</h3>
    </div>
    <div class="col-sm-4">
        <div class="form-group mb-3">
            <div class="form-check">
                <br>
                <label class="form-check-label">
                    <?php echo Form::checkbox('common_settings[custom_designer]', 1,
                        !empty($common_settings['custom_designer']) ? true : false,
                        ['class' => 'form-check-input']); ?>

                    <?php echo e(__('lang_v1.custom_designer'), false); ?>

                </label>
                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.custom_designer_tooltip') . '"></i>';
                }
            ?>
            </div>
        </div>
    </div>
	<?php endif; ?>
	</div>
</div>
