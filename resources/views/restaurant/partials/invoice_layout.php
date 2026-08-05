<?php
	$default = [];
	$default['show_table'] = 1;
	$default['table_label'] = 'Table';

	$default['show_service_staff'] = 1;
	$default['service_staff_label'] = 'Service staff';
	$default['hide_price_total'] = 0;
	
	if(!empty($edit_il)){
		$default['show_table'] = isset($module_info['tables']['show_table']) ? $module_info['tables']['show_table'] : 0;
		$default['table_label'] = isset($module_info['tables']['table_label']) ? $module_info['tables']['table_label'] : '';

		$default['show_service_staff'] = isset($module_info['service_staff']['show_service_staff']) ? $module_info['service_staff']['show_service_staff'] : 0;
		
		$default['service_staff_label'] = isset($module_info['service_staff']['service_staff_label']) ? $module_info['service_staff']['service_staff_label'] : '';
		$default['hide_price_total'] = isset($hide_price_total) ? $hide_price_total : 0;
	}
?>

<?php if(!empty($enabled_modules)): ?>
<div class="box box-primary">
    <div class="box-body">
    	<div class="box-header">
            <h3 class="box-title"><?php echo app('translator')->get('lang_v1.restaurant_module_settings'); ?></h3>
			<?php echo e($show_product_price_total, false); ?>

        </div>
		<div class="row">
		<?php if(in_array('tables', $enabled_modules) ): ?>
			<div class="col-sm-3">
				<div class="mb-3">
					<div class="form-check">
						<br>
						<label class="form-check-label">
<?php echo Form::checkbox('module_info[tables][show_table]', 1, $default['show_table'], ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('restaurant.show_table'); ?>
						</label>
					</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="mb-3">
					<?php echo Form::label('module_info[tables][table_label]', __('restaurant.table_label') . ':' ); ?>

					<?php echo Form::text('module_info[tables][table_label]', $default['table_label'], ['class' => 'form-control', 'placeholder' => __('restaurant.table_label') ]); ?>

				</div>
			</div>
		<?php endif; ?>
		<?php if(in_array('service_staff', $enabled_modules) ): ?>
			<div class="col-sm-3">
				<div class="mb-3">
					<div class="form-check">
						<br>
						<label class="form-check-label">
<?php echo Form::checkbox('module_info[service_staff][show_service_staff]', 1, $default['show_service_staff'], ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('restaurant.show_service_staff'); ?>
						</label>
					</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="mb-3">
					<?php echo Form::label('module_info[service_staff][service_staff_label]', __('restaurant.service_staff_label') . ':' ); ?>

					<?php echo Form::text('module_info[service_staff][service_staff_label]', $default['service_staff_label'], ['class' => 'form-control', 'placeholder' => __('restaurant.service_staff_label') ]); ?>

				</div>
			</div>
		<?php endif; ?>
		<div class="clearfix"></div>
		<div class="col-sm-4">
			<div class="mb-3">
			  <div class="form-check">
				<label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_price_total]', 1, $default['hide_price_total'], ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.hide_product_price_total'); ?></label>
				</div>
			</div>
		  </div>

		</div>
	</div>
</div>
<?php endif; ?>
