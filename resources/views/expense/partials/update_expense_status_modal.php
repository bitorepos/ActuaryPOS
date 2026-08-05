<div class="modal fade" id="update_expense_status_modal" tabindex="-1" role="dialog" aria-labelledby="updateExpenseStatusLabel" style="z-index: 1090 !important;">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<?php echo Form::open(['url' => '#', 'method' => 'post', 'id' => 'update_expense_status_form', 'data-no-double-submit-prevention' => '1']); ?>


			<div class="modal-header">
				<h4 class="modal-title" id="updateExpenseStatusLabel"><?php echo app('translator')->get('lang_v1.update_status'); ?></h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body">
				<div class="mb-3">
					<?php echo Form::label('expense_status', __('expense.expense_status') . ':*'); ?>

					<?php echo Form::select('status', ['final' => __('sale.final'), 'draft' => __('sale.draft')], null, ['class' => 'form-control', 'required', 'id' => 'expense_status']); ?>

				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="update_expense_status_btn"><?php echo app('translator')->get('messages.update'); ?></button>
				<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
			</div>

			<?php echo Form::close(); ?>

		</div>
	</div>
</div>
