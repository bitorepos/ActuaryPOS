
<?php $__env->startSection('title', __('expense.add_expense')); ?>

<?php $__env->startSection('content'); ?>
<?php
	$user_settings = json_decode(auth()->user()->user_settings,true);
	// Phase 68: prefer controller-supplied per-branch common_settings; session is the fallback.
	$common_settings = isset($common_settings) && ! empty($common_settings)
		? $common_settings
		: session()->get('business.common_settings');
?>

<!-- Content Header -->
<section class="content-header">
    <h1><?php echo app('translator')->get('expense.add_expense'); ?> <i class="fas fa-keyboard text-muted" title="<?php echo app('translator')->get('lang_v1.expense_show_shortcuts_help'); ?>: <?php echo e(!empty($shortcuts['expense']['show_shortcuts_help']) ? strtoupper($shortcuts['expense']['show_shortcuts_help']) : 'F7', false); ?>" style="font-size: 16px; cursor: pointer;" onclick="$('#expenseKeyboardShortcutsModal').modal('show');"></i></h1>
</section>

<!-- Main content -->
<section class="content">
	<?php echo Form::open(['url' => action([\App\Http\Controllers\ExpenseController::class, 'store']), 'method' => 'post', 'id' => 'add_expense_form', 'files' => true ]); ?>


	
	<?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('expense.add_expense')]); ?>
		<?php $__env->slot('icon'); ?>
			<i class="fas fa-receipt fa-lg text-primary"></i>
		<?php $__env->endSlot(); ?>

		<?php if(count($business_locations) == 1): ?>
			<?php $default_location = current(array_keys($business_locations->toArray())) ?>
		<?php elseif(isset($location_id)): ?>
			<?php $default_location = $location_id; ?>
		<?php else: ?>
			<?php $default_location = null; ?>
		<?php endif; ?>

		<div class="row">
			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('location_id', __('purchase.business_location').':*'); ?>

					<?php echo Form::select('location_id', $business_locations, $default_location, ['class' => 'form-control select2', 'required'], $bl_attributes); ?>

				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('ref_no', __('purchase.ref_no').':'); ?>

					<?php echo Form::text('ref_no', null, ['class' => 'form-control', empty($user_settings['enable_expense_transaction_no']) ? 'readonly' : '']); ?>

					<b id="ref_no_error" class="error hide"><?php echo app('translator')->get('lang_v1.not_unique', ['name' => __('purchase.ref_no') ]); ?></b>
					<p class="help-block"><?php echo app('translator')->get('lang_v1.leave_empty_to_autogenerate'); ?></p>
				</div>
			</div>

			<?php
				$is_readonly = empty($user_settings['enable_expense_transaction_date']) ? 'disabled' : '';
			?>
			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::hidden('transaction_date', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['id' => 'expense_transaction_date', 'class' => 'form-control', 'required']); ?>

					<?php echo Form::label('transaction_date', __('messages.date') . ':*'); ?>

					<div class="input-group">
						<span class="input-group-text"><i class="fa fa-calendar"></i></span>
						<?php echo Form::text('transaction_date_text', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['id' => 'expense_transaction_date_text', 'class' => 'form-control', $is_readonly, 'required']); ?>

					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('status', __('expense.expense_status') . ':*'); ?>

					<?php
						$default_expense_status = $default_expense_status ?? 'final';
						$status_attributes = ['class' => 'form-control select2', 'required', 'id' => 'expense_status'];
						if (!auth()->user()->can('expense.update_status')) {
							$status_attributes['disabled'] = 'disabled';
						}
					?>
					<?php echo Form::select('status', ['final' => __('sale.final'), 'draft' => __('sale.draft')], $default_expense_status, $status_attributes); ?>

					<?php if(!auth()->user()->can('expense.update_status')): ?>
						<input type="hidden" name="status" value="<?php echo e($default_expense_status, false); ?>">
					<?php endif; ?>
				</div>
			</div>

			<?php if($truckmate_enabled): ?>
			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('job_sheet_ids', __('truckmate::lang.jobs').':*'); ?>

					<?php echo Form::select('job_sheet_ids[]', [], null, ['class' => 'form-control select2', 'id' => 'job_sheet_ids', 'style' => 'width: 100%;', 'required']); ?>

				</div>
			</div>
			<?php endif; ?>
		</div>

		<div class="row">
			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('expense_category_id', __('expense.expense_category').':'); ?>

					<?php echo Form::select('expense_category_id', $expense_categories, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('expense_sub_category_id', __('product.sub_category') . ':'); ?>

					<?php echo Form::select('expense_sub_category_id', [], null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']); ?>

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
					<?php echo Form::select('expense_for', $users, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

				</div>
			</div>
			<?php endif; ?>

			<?php if(empty($common_settings['hide_expense_for_marchant'])): ?>
			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('contact_id', __('lang_v1.expense_for_contact').':'); ?>

					<?php echo Form::select('contact_id', $contacts, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

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

					<?php echo Form::select('acc_account_id', $acc_accounts, $default_acc_account->id ?? null, ['class' => 'form-control acc_account_id', 'placeholder' => __('messages.please_select')]); ?>

				</div>
			</div>
			<?php endif; ?>

			<?php if(empty($common_settings['hide_expense_apllicable_tax'])): ?>
			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('tax_id', __('product.applicable_tax') . ':'); ?>

					<div class="input-group">
						<span class="input-group-text"><i class="fa fa-info"></i></span>
						<?php echo Form::select('tax_id', $taxes['tax_rates'], null, ['class' => 'form-select'], $taxes['attributes']); ?>

						<input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" value="0">
					</div>
				</div>
			</div>
			<?php endif; ?>

			<div class="col-md-3 col-sm-6">
				<div class="form-group mb-2">
					<?php echo Form::label('final_total', __('sale.total_amount') . ':*'); ?>

					<?php echo Form::text('final_total', null, ['class' => 'form-control input_number', 'placeholder' => __('sale.total_amount'), 'required']); ?>

				</div>
			</div>

			<?php if(empty($common_settings['hide_expense_is_refund'])): ?>
			<div class="col-md-3 col-sm-6 d-flex align-items-end pb-2">
				<div class="form-check">
					<label class="form-check-label">
						<?php echo Form::checkbox('is_refund', 1, false, ['class' => 'form-check-input', 'id' => 'is_refund']); ?> <?php echo app('translator')->get('lang_v1.is_refund'); ?>?
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

					<?php echo Form::textarea('additional_notes', null, ['class' => 'form-control', 'rows' => 3]); ?>

				</div>
			</div>

			<?php if(in_array('upload_documents', $enabled_modules)): ?>
			<?php if(empty($common_settings['hide_expense_attach_document'])): ?>
			<div class="col-md-3 col-sm-6">
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

	
	<?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'id' => "payment_rows_div", 'title' => __('purchase.add_payment')]); ?>
		<?php $__env->slot('icon'); ?>
			<i class="fas fa-credit-card fa-lg text-success"></i>
		<?php $__env->endSlot(); ?>
		<?php echo Form::hidden('expense_payment_amount_user_set_zero', 0, ['id' => 'expense_payment_amount_user_set_zero']); ?>

		<div class="payment_row">
			<?php echo $__env->make('sale_pos.partials.payment_row_form', ['row_index' => 0, 'show_date' => true, 'transaction_type' => 'expense'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<hr>
			<?php if(in_array('upload_documents', $enabled_modules)): ?>
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo Form::label('payment_document', __('purchase.attach_document') . ':'); ?>

						<i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
						<?php echo Form::file('payment[0][document]', ['id' => 'upload_payment_document', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

					</div>
				</div>
				<div class="col-sm-8">
					<div class="pull-right">
						<strong><?php echo app('translator')->get('purchase.payment_due'); ?>:</strong>
						<span id="payment_due"><?php echo e(number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
					</div>
				</div>
			</div>
			<?php else: ?>
			<div class="row">
				<div class="col-sm-12">
					<div class="pull-right">
						<strong><?php echo app('translator')->get('purchase.payment_due'); ?>:</strong>
						<span id="payment_due"><?php echo e(number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<div id="expense-footer-actions-template" class="d-none">
			<button type="submit" form="add_expense_form" class="btn btn-primary expense_submit_action"><i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?></button>
		</div>
	<?php echo $__env->renderComponent(); ?>

<?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready( function(){
		$('.paid_on').datetimepicker({
            format: moment_date_format + ' ' + moment_time_format,
            ignoreReadonly: true,
        });
		set_payment_type_dropdown();
		$('select#location_id').change(function() {
			set_payment_type_dropdown();
		});
		if($('.payment_types_dropdown').length){
			$('.payment_types_dropdown').change();
		}
		if($('select.acc_account_id').length){
			$('select.acc_account_id').select2();
		}
	});

	// Dedicated, side-effect-free handler that toggles the bottom payment section
	// based on the selected business location's payment options. Kept separate
	// from set_payment_type_dropdown() (which has other side effects) and minimal
	// so it ALWAYS fires on location change and never interferes with the select2
	// dropdown closing. Show when at least one payment method is enabled; hide
	// when the location has methods configured but all are disabled.
	function toggle_expense_payment_section() {
		if ($('#expense_status').val() == 'draft') {
			$('#payment_rows_div').addClass('hide');
			return;
		}

		var selected = $('select#location_id').find(':selected');
		var pa = selected.data('default_payment_accounts') || {};
		var has_any_method = false;
		var has_enabled_method = false;
		for (var k in pa) {
			if (k === 'advance') { continue; }
			has_any_method = true;
			if (pa[k] && pa[k]['is_enabled']) { has_enabled_method = true; }
		}
		var server_payments_disabled = selected.data('payments_disabled') == 1;
		var hide = has_any_method ? !has_enabled_method : server_payments_disabled;
		$('#payment_rows_div').toggleClass('hide', hide);
	}

	$(document).on('change', 'select#location_id', function() {
		toggle_expense_payment_section();
	});

	$(document).on('change', '#expense_status', function() {
		toggle_expense_payment_section();
	});

	// Apply once on initial page load for the default selected location.
	$(function() {
		toggle_expense_payment_section();
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
						
						// Pre-select job if job_sheet_id query parameter is present
						<?php if(request()->has('job_sheet_id')): ?>
							var jobSheetId = '<?php echo e(request()->get('job_sheet_id'), false); ?>';
							if (jobSheetId) {
								$('#job_sheet_ids').val([jobSheetId]).trigger('change');
							}
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

	// Load job sheets on page load if location is already selected
	$(document).ready(function() {
		if ($('select#location_id').val()) {
			get_job_sheets_for_expense();
		}
	});
	
	__page_leave_confirmation('#add_expense_form');
	var expense_payment_syncing = false;
	var expense_payment_user_changed = false;

	function expensePaymentAmountInput() {
		return $('form#add_expense_form input.payment-amount').first();
	}

	function setExpensePaymentZeroOverride() {
		var payment_amount = __read_number(expensePaymentAmountInput());
		$('#expense_payment_amount_user_set_zero').val(payment_amount == 0 ? 1 : 0);
	}

	function markExpensePaymentZeroIfNeeded() {
		if (__read_number(expensePaymentAmountInput()) == 0) {
			$('#expense_payment_amount_user_set_zero').val(1);
		}
	}

	function syncExpensePaymentAmount() {
		if (expense_payment_user_changed) {
			calculateExpensePaymentDue();
			return;
		}

		var final_total = __read_number($('form#add_expense_form input#final_total'));
		var payment_input = expensePaymentAmountInput();

		if (!payment_input.length) {
			return;
		}

		expense_payment_syncing = true;
		__write_number(payment_input, final_total);
		payment_input.trigger('change');
		expense_payment_syncing = false;
	}

	$(document).on('input change', 'form#add_expense_form input#final_total', function() {
		syncExpensePaymentAmount();
	});
	$(document).on('input change', 'form#add_expense_form input.payment-amount', function() {
		if (!expense_payment_syncing) {
			expense_payment_user_changed = true;
			setExpensePaymentZeroOverride();
		}

		calculateExpensePaymentDue();
	});

	// Keep the submitted payment amount exactly as entered; 0 means no payment.
	$(document).on('submit', '#add_expense_form', function() {
		if ($('#expense_status').val() == 'draft') {
			return;
		}

		markExpensePaymentZeroIfNeeded();
		calculateExpensePaymentDue();
	});

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

	function calculateExpensePaymentDue() {
		var final_total = __read_number($('form#add_expense_form input#final_total'));
		var payment_amount = __read_number(expensePaymentAmountInput());
		var payment_due = final_total - payment_amount;
		$('#payment_due').text(__currency_trans_from_en(payment_due, true, false));
	}

	$(document).on('change', '#recur_interval_type', function() {
	    if ($(this).val() == 'months') {
	        $('.recur_repeat_on_div').removeClass('hide');
	    } else {
	        $('.recur_repeat_on_div').addClass('hide');
	    }
	});

	$('#is_refund').on('change', function(event){
		if ($(this).is(':checked')) {
			$('#recur_expense_div').addClass('hide');
		} else {
			$('#recur_expense_div').removeClass('hide');
		}
	});

	$(document).on('change', '.payment_types_dropdown, #location_id', function(e) {
	    var default_accounts = $('select#location_id').length ? 
	                $('select#location_id')
	                .find(':selected')
	                .data('default_payment_accounts') : [];
	    var payment_types_dropdown = $('.payment_types_dropdown');
	    var payment_type = payment_types_dropdown.val();
	    if (payment_type) {
	        var default_account = default_accounts && default_accounts[payment_type]['account'] ? 
	            default_accounts[payment_type]['account'] : '';
	        var payment_row = payment_types_dropdown.closest('.payment_row');
	        var row_index = payment_row.find('.payment_row_index').val();

	        var account_dropdown = payment_row.find('select#account_' + row_index);
	        if (account_dropdown.length && default_accounts) {
	            account_dropdown.val(default_account);
	            account_dropdown.change();
	        }
	    }
	});

	function set_payment_type_dropdown() {
		var payment_settings = $('#location_id').find(':selected').data('default_payment_accounts');
		payment_settings = payment_settings ? payment_settings : [];
		enabled_payment_types = [];
		var default_method = null;
		for (var key in payment_settings) {
			if (payment_settings[key] && payment_settings[key]['is_enabled']) {
				enabled_payment_types.push(key);
			}
			if (payment_settings[key] && payment_settings[key]['is_default']) {
				default_method = key;
			}
		}

		// Hide/show entire payment section based on whether all methods are disabled
		// for the selected business location's payment options.
		// Primary source of truth: the location's actual per-method data parsed
		// below (excluding the always-on 'advance' method). The server computed
		// flag is only used as a fallback when per-method data is unavailable.
		var server_payments_disabled = $('#location_id').find(':selected').data('payments_disabled') == 1;

		var has_any_method = false;
		var has_enabled_method = false;
		for (var pkey in payment_settings) {
			if (pkey === 'advance') {
				continue;
			}
			has_any_method = true;
			if (payment_settings[pkey] && payment_settings[pkey]['is_enabled']) {
				has_enabled_method = true;
			}
		}

		// Hide only when the location has payment methods configured and every
		// one of them is disabled. The location's actual payment options are the
		// source of truth; the server flag is used only when we cannot read the
		// per-method data (so locations without any config stay visible).
		var should_hide_payment;
		if (has_any_method) {
			should_hide_payment = !has_enabled_method;
		} else {
			should_hide_payment = server_payments_disabled;
		}
		if ($('#expense_status').val() == 'draft') {
			should_hide_payment = true;
		}

		if (should_hide_payment) {
			$('#payment_rows_div').addClass('hide');
		} else {
			$('#payment_rows_div').removeClass('hide');
		}

		if (enabled_payment_types.length) {
			$(".payment_types_dropdown > option").each(function() {
				//skip if advance
				if ($(this).val() && $(this).val() != 'advance') {
					if (enabled_payment_types.indexOf($(this).val()) != -1) {
						$(this).removeClass('hide');
					} else {
						$(this).addClass('hide');
					}
				}
			});
		}

		if(default_method){
			sub_method = payment_settings[default_method]['sub_method'];
			if(sub_method){
				$(".payment_types_dropdown").val(default_method).trigger('change');
				$("input[name='payment[0][sub_method]'][value='"+sub_method+"']").prop('checked', true).trigger('change');
			}
		}
		
	}

	$(document).on('change', '#ref_no', function() {
		if($(this).val() != ''){
			$.ajax({
				method: 'POST',
				url: '/transactions/check-invoice-no',
				data: {
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
</script>
	<?php echo $__env->make('expense.partials.expense_keyboard_shortcuts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('expense.partials.expense_keyboard_shortcuts_help_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>