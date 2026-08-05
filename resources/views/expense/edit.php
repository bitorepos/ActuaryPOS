
<?php $__env->startSection('title', __('expense.edit_expense')); ?>

<?php $__env->startSection('content'); ?>
<?php
	// Phase 68: prefer controller-supplied per-branch common_settings; session is the fallback.
	$common_settings = isset($common_settings) && ! empty($common_settings)
		? $common_settings
		: session()->get('business.common_settings');
?>

<!-- Content Header -->
<section class="content-header">
    <h1><?php echo app('translator')->get('expense.edit_expense'); ?> <i class="fas fa-keyboard text-muted" title="<?php echo app('translator')->get('lang_v1.expense_show_shortcuts_help'); ?>: <?php echo e(!empty($shortcuts['expense']['show_shortcuts_help']) ? strtoupper($shortcuts['expense']['show_shortcuts_help']) : 'F7', false); ?>" style="font-size: 16px; cursor: pointer;" onclick="$('#expenseKeyboardShortcutsModal').modal('show');"></i></h1>
</section>

<!-- Main content -->
<section class="content">
	<?php echo Form::hidden('transaction_id', $expense->id, ['id' => 'transaction_id']); ?>

	<?php echo Form::open(['url' => action([\App\Http\Controllers\ExpenseController::class, 'update'], [$expense->id]), 'method' => 'PUT', 'id' => 'add_expense_form', 'files' => true ]); ?>


	
	<?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('expense.edit_expense')]); ?>
		<?php $__env->slot('icon'); ?>
			<i class="fas fa-receipt fa-lg text-primary"></i>
		<?php $__env->endSlot(); ?>

		<div class="row">
			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('location_id', __('purchase.business_location').':*'); ?>

					<?php echo Form::select('location_id', $business_locations, $expense->location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); ?>

				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('ref_no', __('purchase.ref_no').':*'); ?>

					<?php echo Form::text('ref_no', $expense->ref_no, ['class' => 'form-control', 'required', empty($user_settings['enable_expense_transaction_no']) ? 'readonly' : '']); ?>

					<b id="ref_no_error" class="error hide"><?php echo app('translator')->get('lang_v1.not_unique', ['name' => __('purchase.ref_no') ]); ?></b>
					<p class="help-block"><?php echo app('translator')->get('lang_v1.leave_empty_to_autogenerate'); ?></p>
				</div>
			</div>

			<?php
				$is_readonly = empty($user_settings['enable_expense_transaction_date']) ? 'disabled' : '';
			?>
			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('transaction_date', __('messages.date') . ':*'); ?>

					<div class="input-group">
						<span class="input-group-text"><i class="fa fa-calendar"></i></span>
						<?php echo Form::text('transaction_date', \Carbon::createFromTimestamp(strtotime($expense->transaction_date))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required', 'id' => 'expense_transaction_date', $is_readonly]); ?>

					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('status', __('expense.expense_status') . ':*'); ?>

					<?php
						$status_attributes = ['class' => 'form-control select2', 'required', 'id' => 'expense_status'];
						$expense_status_change_disabled = !auth()->user()->can('expense.update_status') || !empty($expense_status_locked);
						if ($expense_status_change_disabled) {
							$status_attributes['disabled'] = 'disabled';
						}
					?>
					<?php echo Form::select('status', ['final' => __('sale.final'), 'draft' => __('sale.draft')], !empty($expense->status) ? $expense->status : 'final', $status_attributes); ?>

					<?php if(!empty($expense_status_change_disabled)): ?>
						<input type="hidden" name="status" value="<?php echo e($expense->status, false); ?>">
					<?php endif; ?>
				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('job_sheet_ids', __('truckmate::lang.jobs').':*'); ?>

					<?php echo Form::select('job_sheet_ids[]', [], null, ['class' => 'form-control select2', 'id' => 'job_sheet_ids', 'style' => 'width: 100%;', 'required']); ?>

				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('expense_category_id', __('expense.expense_category').':'); ?>

					<?php echo Form::select('expense_category_id', $expense_categories, $expense->expense_category_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('expense_sub_category_id', __('product.sub_category') . ':'); ?>

					<?php echo Form::select('expense_sub_category_id', $sub_categories, $expense->expense_sub_category_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']); ?>

				</div>
			</div>

			<?php if(empty($common_settings['hide_expense_for_user'])): ?>
			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('expense_for', __('expense.expense_for').':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.expense_for') . '"></i>';
                }
            ?>
					<?php echo Form::select('expense_for', $users, $expense->expense_for, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

				</div>
			</div>
			<?php endif; ?>

			<?php if(empty($common_settings['hide_expense_for_marchant'])): ?>
			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('contact_id', __('lang_v1.expense_for_contact').':'); ?>

					<?php echo Form::select('contact_id', $contacts, $expense->contact_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

				</div>
			</div>
			<?php endif; ?>
		</div>
		<?php echo $__env->make('expense.partials.project_step_fields', [
			'project_select_id' => 'pjt_project_id',
			'step_select_id' => 'pjt_project_step_id',
			'projects' => $projects ?? collect(),
			'project_steps_by_project' => $project_steps_by_project ?? [],
			'selected_project_id' => $selected_project_id ?? null,
			'selected_project_step_id' => $selected_project_step_id ?? null,
		], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->renderComponent(); ?>

	
	<?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('sale.total_amount')]); ?>
		<?php $__env->slot('icon'); ?>
			<i class="fas fa-money-bill-wave fa-lg text-warning"></i>
		<?php $__env->endSlot(); ?>
		<div class="row">
			<?php if($accounting_enabled): ?>
			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('acc_account_id', __('lang_v1.post_to_account').':'); ?>

					<?php echo Form::select('acc_account_id', $acc_accounts, $expense->prefer_payment_account ?? $default_acc_account->id, ['class' => 'form-control acc_account_id', 'placeholder' => __('messages.please_select')]); ?>

				</div>
			</div>
			<?php endif; ?>

			<?php if(empty($common_settings['hide_expense_apllicable_tax'])): ?>
			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('tax_id', __('product.applicable_tax') . ':'); ?>

					<div class="input-group">
						<span class="input-group-text"><i class="fa fa-info"></i></span>
						<?php echo Form::select('tax_id', $taxes['tax_rates'], $expense->tax_id, ['class' => 'form-select'], $taxes['attributes']); ?>

						<input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" value="0">
					</div>
				</div>
			</div>
			<?php endif; ?>

			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('final_total', __('sale.total_amount') . ':*'); ?>

					<?php echo Form::text('final_total', number_format($expense->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'placeholder' => __('sale.total_amount'), 'required']); ?>

				</div>
			</div>

			<?php if(empty($common_settings['hide_expense_is_refund'])): ?>
			<div class="col-md-3 col-sm-6 d-flex align-items-end pb-2">
				<div class="form-check">
					<label class="form-check-label">
						<?php echo Form::checkbox('is_refund', 1, ($expense->type == 'expense_refund'), ['class' => 'form-check-input', 'id' => 'is_refund']); ?> <?php echo app('translator')->get('lang_v1.is_refund'); ?>?
					</label><?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.is_refund_help') . '"></i>';
                }
            ?>
				</div>
			</div>
			<?php endif; ?>
		</div>

		<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('additional_notes', __('expense.expense_note') . ':'); ?>

					<?php echo Form::textarea('additional_notes', $expense->additional_notes, ['class' => 'form-control', 'rows' => 3]); ?>

				</div>
			</div>

			<?php if(in_array('upload_documents', $enabled_modules)): ?>
			<?php if(empty($common_settings['hide_expense_attach_document'])): ?>
			<div class="col-md-6 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('document', __('purchase.attach_document') . ':'); ?>

					<i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
					<?php echo Form::file('document', ['id' => 'upload_document', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

				</div>
			</div>
			<?php endif; ?>
			<?php endif; ?>
		</div>
	<?php echo $__env->renderComponent(); ?>

	
	<?php if(empty($common_settings['hide_expense_is_recurring'])): ?>
		<?php echo $__env->make('expense.recur_expense_form_part', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>

	<div id="expense-footer-actions-template" class="d-none">
		<button type="submit" form="add_expense_form" class="btn btn-primary expense_submit_action"><i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?></button>
	</div>

	<?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready( function(){
		$('#expense_transaction_date').datetimepicker({
        format: moment_date_format + ' ' + moment_time_format,
        ignoreReadonly: true,
    });
    $('#expense_transaction_date').on('dp.change', function(e) {
        var transaction_date_value = $(this).val();
        $('#expense_transaction_date').val(transaction_date_value);
    });

    // Load job sheets on page load
    if ($('select#location_id').val()) {
			get_job_sheets_for_expense();
		}
  });

  // Load job sheets when location changes
	$('select#location_id').change(function() {
		get_job_sheets_for_expense();
	});

	function get_job_sheets_for_expense() {
		var location_id = $('select#location_id').val();
		if ($('#job_sheet_ids').length && location_id) {
			$.ajax({
				url: '/truckmate/get-location-job-sheets?location_id=' + location_id,
				dataType: 'json',
				success: function(data) {
					if(data && data.length > 0){
						$('#job_sheet_ids').select2('destroy').empty().select2({data: data});
						
						// Pre-select job sheets if editing
						<?php if(isset($selected_job_sheets) && !empty($selected_job_sheets)): ?>
							var selectedIds = <?php echo json_encode($selected_job_sheets); ?>;
							$('#job_sheet_ids').val(selectedIds).trigger('change');
						<?php endif; ?>
					} else {
						$('#job_sheet_ids').select2('destroy').empty().select2({data: [{id: '', text: 'No Jobs Available'}]});
					}
				},
				error: function() {
					$('#job_sheet_ids').select2('destroy').empty().select2({data: [{id: '', text: 'Click to Select'}]});
				}
			});
		}
	}

  $(document).on('change', '#ref_no', function() {
		if($(this).val() != ''){
			$.ajax({
				method: 'POST',
				url: '/transactions/check-invoice-no',
				data: {
					id : $('#transaction_id').val(),
          invoice_no : $('#ref_no').val(),
					type : 'expense',
				},
				dataType: 'json',
				success: async function(result) {
					if(result){
						$('#ref_no').addClass('error');
						$('#ref_no_error').removeClass('hide');
					}else{
						$('#ref_no').removeClass('error');
						$('#ref_no_error').addClass('hide');
					}
				}
			});
		}else{
			$('#ref_no').removeClass('error');
			$('#ref_no_error').addClass('hide');
		}
	});
  __page_leave_confirmation('#add_expense_form');

	function unlockExpenseSubmitButtons() {
		$('form#add_expense_form').removeData('expense_submit_locked');
		$('.expense_submit_action, button[form="add_expense_form"], form#add_expense_form button[type="submit"]').each(function() {
			var button = $(this);

			if (button.data('expense_was_enabled')) {
				button.prop('disabled', false);
				button.removeData('expense_was_enabled');
			}
		});
	}

	$(document).on('click', '.expense_submit_action, button[form="add_expense_form"], form#add_expense_form button[type="submit"]', function(e) {
		e.preventDefault();
		var form = $('form#add_expense_form');
		var submit_buttons = $('.expense_submit_action, button[form="add_expense_form"], form#add_expense_form button[type="submit"]');

		if (form.data('expense_submit_locked')) {
			return false;
		}

		form.data('expense_submit_locked', true);
		submit_buttons.each(function() {
			var button = $(this);

			if (!button.prop('disabled')) {
				button.data('expense_was_enabled', true);
				button.prop('disabled', true);
			}
		});

		if (form.valid()) {
			form.submit();
		} else {
			unlockExpenseSubmitButtons();
		}
	});
</script>
	<?php echo $__env->make('expense.partials.expense_keyboard_shortcuts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('expense.partials.expense_keyboard_shortcuts_help_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>