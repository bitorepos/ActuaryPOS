<?php if($tables_enabled): ?>
<div class="col-sm-4">
	<div class="form-group mb-1">
		<div class="input-group">
			<span class="input-group-text">
				<i class="fa fa-table"></i>
			</span>
			<?php echo Form::select('res_table_id', $tables, $view_data['res_table_id'], [ 'id'=> 'res_table_id', 'class' => 'form-control', ($hide_table_dropdown == 'true') ? 'disabled': '', 'placeholder' => __('restaurant.select_table')]); ?>

		</div>
	</div>
</div>
<?php endif; ?>
<?php if($waiters_enabled): ?>
<div class="col-sm-4">
	<div class="form-group mb-1">
		<div class="input-group">
			<span class="input-group-text">
				<i class="fa fa-user-secret"></i>
			</span>
			<?php echo Form::select('res_waiter_id', $waiters, $view_data['res_waiter_id'], ['class' => 'form-select', 'placeholder' => __('restaurant.select_service_staff'), 'id' => 'res_waiter_id', 'required' => $is_service_staff_required ? true : false]); ?>

			<?php if(!empty($pos_settings['inline_service_staff'])): ?>
			<div class="input-group-btn">
                <button type="button" class="btn btn-default bg-white btn-flat" id="select_all_service_staff" data-bs-toggle="tooltip" title="<?php echo app('translator')->get('lang_v1.select_same_for_all_rows'); ?>"><i class="fa fa-check"></i></button>
            </div>
            <?php endif; ?>
		</div>
	</div>
</div>
<?php endif; ?>
