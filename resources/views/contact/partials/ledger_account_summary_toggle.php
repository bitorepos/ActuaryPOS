<?php if(request('sub_action') != 'print' && empty($for_pdf)): ?>
	<div class="col-sm-12" style="top: -13px;">
		<div class="mb-3">
			<div class="form-check">
				<label class="form-check-label">
					<?php echo Form::checkbox('common_settings[hide_account_summary]', 1,
						!empty($common_settings['hide_account_summary']) ? true : false,
						['class' => 'form-check-input', 'id' => 'hide_account_summary_front']); ?>

					<?php echo e(__('lang_v1.hide_account_summary'), false); ?>

				</label>
			</div>
		</div>
	</div>
<?php endif; ?>
