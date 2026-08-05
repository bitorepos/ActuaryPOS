<?php
	$user_settings = json_decode(auth()->user()->user_settings,true);
	// Phase 68: prefer controller-supplied per-branch common_settings; session is the fallback.
	$common_settings = isset($common_settings) && ! empty($common_settings)
		? $common_settings
		: session()->get('business.common_settings');
?>

<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\App\Http\Controllers\ExpenseController::class, 'store']), 'method' => 'post', 'id' => 'add_expense_modal_form', 'files' => true, 'class' => 'd-flex flex-column overflow-hidden', 'style' => 'max-height:100%' ]); ?>

        <div class="modal-header bg-primary text-white">
            <h4 class="modal-title"><i class="fas fa-receipt me-2"></i><?php echo app('translator')->get( 'expense.add_expense' ); ?></h4>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
            <div class="border rounded p-3 mb-3 bg-light">
                <h6 class="fw-bold text-primary mb-3"><i class="fas fa-info-circle me-1"></i> <?php echo app('translator')->get('expense.expense_details'); ?></h6>
                <?php if(count($business_locations) == 1): ?>
                    <?php $default_location = current(array_keys($business_locations->toArray())) ?>
                <?php else: ?>
                    <?php $default_location = request()->input('location_id'); ?>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('expense_location_id', __('purchase.business_location').':*'); ?>

                            <?php echo Form::select('location_id', $business_locations, $default_location, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'expense_location_id'], $bl_attributes); ?>

                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('expense_ref_no', __('purchase.ref_no').':'); ?>

                            <?php echo Form::text('ref_no', null, ['class' => 'form-control', 'id' => 'expense_ref_no', empty($user_settings['enable_expense_transaction_no']) ? 'readonly' : '']); ?>

                            <b id="ref_no_error" class="error hide"><?php echo app('translator')->get('lang_v1.not_unique', ['name' => __('purchase.ref_no') ]); ?></b>
                            <p class="help-block"><?php echo app('translator')->get('lang_v1.leave_empty_to_autogenerate'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                        $is_readonly = empty($user_settings['enable_expense_transaction_date']) ? 'disabled' : '';
                    ?>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('expense_transaction_date', __('messages.date') . ':*'); ?>

                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                <?php echo Form::text('transaction_date', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required', 'id' => 'expense_transaction_date', $is_readonly]); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('expense_modal_status', __('expense.expense_status') . ':*'); ?>

                            <?php
                                $default_expense_status = $default_expense_status ?? 'final';
                                $status_attributes = ['class' => 'form-control select2', 'required', 'id' => 'expense_modal_status'];
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
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('expense_job_sheet_ids', __('truckmate::lang.jobs').':*'); ?>

                            <?php echo Form::select('job_sheet_ids[]', [], null, ['class' => 'form-control select2', 'id' => 'expense_job_sheet_ids', 'style' => 'width: 100%;', 'required']); ?>

                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('expense_category_id', __('expense.expense_category').':'); ?>

                            <?php echo Form::select('expense_category_id', $expense_categories, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('expense_sub_category_id', __('product.sub_category').':'); ?>

                            <?php echo Form::select('expense_sub_category_id', [], null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'id' => 'expense_sub_category_id']); ?>

                        </div>
                    </div>
                    <?php if(empty($common_settings['hide_expense_for_user'])): ?>
                    <div class="col-md-4 col-sm-6">
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
                </div>
                <?php echo $__env->make('expense.partials.project_step_fields', [
                    'project_select_id' => 'expense_pjt_project_id',
                    'step_select_id' => 'expense_pjt_project_step_id',
                    'projects' => $projects ?? collect(),
                    'project_steps_by_project' => $project_steps_by_project ?? [],
                    'selected_project_id' => $selected_project_id ?? null,
                    'selected_project_step_id' => $selected_project_step_id ?? null,
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            
            <div class="border rounded p-3 mb-3" style="border-color: #f0ad4e !important;">
                <h6 class="fw-bold text-warning mb-3"><i class="fas fa-money-bill-wave me-1"></i> <?php echo app('translator')->get('sale.total_amount'); ?></h6>
                <div class="row">
                    <?php if($accounting_enabled): ?>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('acc_account_id', __('lang_v1.post_to_account').':'); ?>

                            <?php echo Form::select('acc_account_id', $acc_accounts, $default_acc_account->id ?? null, ['class' => 'form-control acc_account_id select2', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if(empty($common_settings['hide_expense_apllicable_tax'])): ?>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('expense_tax_id', __('product.applicable_tax') . ':'); ?>

                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-info"></i></span>
                                <?php echo Form::select('tax_id', $taxes['tax_rates'], null, ['class' => 'form-select', 'id'=>'expense_tax_id'], $taxes['attributes']); ?>

                                <input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" value="0">
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('expense_final_total', __('sale.total_amount') . ':*'); ?>

                            <?php echo Form::text('final_total', null, ['class' => 'form-control input_number', 'placeholder' => __('sale.total_amount'), 'required', 'id' => 'expense_final_total']); ?>

                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('expense_additional_notes', __('expense.expense_note') . ':'); ?>

                            <?php echo Form::textarea('additional_notes', null, ['class' => 'form-control', 'rows' => 3, 'id' => 'expense_additional_notes']); ?>

                        </div>
                    </div>
                </div>
                <?php if(in_array('upload_documents', $enabled_modules)): ?>
                <?php if(empty($common_settings['hide_expense_attach_document'])): ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group mb-2">
                            <?php echo Form::label('document', __('purchase.attach_document') . ':'); ?>

                            <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                            <?php echo Form::file('document', ['id' => 'upload_document', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>
            </div>

            
            <div class="border rounded p-3 mb-2" id="expense_modal_payment_section" style="border-color: #5bc0de !important;">
                <h6 class="fw-bold text-info mb-3"><i class="fas fa-credit-card me-1"></i> <?php echo app('translator')->get('purchase.add_payment'); ?></h6>
                <?php echo Form::hidden('expense_payment_amount_user_set_zero', 0, ['id' => 'expense_modal_payment_amount_user_set_zero']); ?>

                <div class="payment_row">
                    <?php echo $__env->make('sale_pos.partials.payment_row_form', ['row_index' => 0, 'show_date' => true, 'transaction_type' => 'expense'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <hr>
                    <?php if(in_array('upload_documents', $enabled_modules)): ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <?php echo Form::label('payment_document', __('purchase.attach_document') . ':'); ?>

                                <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                                <?php echo Form::file('payment[0][document]', ['id' => 'upload_payment_document_modal', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

                            </div>
                        </div>
                        <div class="col-sm-6 d-flex align-items-center justify-content-end">
                            <div class="text-end">
                                <strong><?php echo app('translator')->get('purchase.payment_due'); ?>:</strong>
                                <span id="expense_payment_due" class="fs-5 fw-bold text-danger"><?php echo e(number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="row">
                        <div class="col-sm-12 d-flex align-items-center justify-content-end">
                            <div class="text-end">
                                <strong><?php echo app('translator')->get('purchase.payment_due'); ?>:</strong>
                                <span id="expense_payment_due" class="fs-5 fw-bold text-danger"><?php echo e(number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <?php echo Form::hidden('expense_save_and_print', 0, ['id' => 'expense_save_and_print']); ?>

            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-dismiss="modal"><i class="fas fa-times me-1"></i><?php echo app('translator')->get( 'messages.close' ); ?></button>
            <button type="submit" class="btn btn-primary" id="expense_modal_save"><i class="fas fa-save me-1"></i><?php echo app('translator')->get( 'messages.save' ); ?></button>
            <button type="submit" class="btn btn-success" id="expense_modal_save" data-save-and-print='true'><i class="fas fa-print me-1"></i><?php echo app('translator')->get( 'lang_v1.save_and_print' ); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    function toggle_expense_modal_payment_section() {
        if ($('#expense_modal_status').val() == 'draft') {
            $('#expense_modal_payment_section').addClass('hide');
        } else {
            $('#expense_modal_payment_section').removeClass('hide');
        }
    }

    $(document)
        .off('change.expenseModalStatus', '#expense_modal_status')
        .on('change.expenseModalStatus', '#expense_modal_status', function() {
            toggle_expense_modal_payment_section();
        });

    toggle_expense_modal_payment_section();

    $(document)
        .off('input.expenseModalPaymentZero change.expenseModalPaymentZero', '#add_expense_modal_form input.payment-amount')
        .on('input.expenseModalPaymentZero change.expenseModalPaymentZero', '#add_expense_modal_form input.payment-amount', function() {
            var payment_amount = __read_number($(this));
            $('#expense_modal_payment_amount_user_set_zero').val(payment_amount == 0 ? 1 : 0);
        });

    // Load job sheets when location changes
    $('#expense_location_id').change(function() {
        load_expense_job_sheets();
    });

    function load_expense_job_sheets() {
        var location_id = $('#expense_location_id').val();
        if ($('#expense_job_sheet_ids').length && location_id) {
            $.ajax({
                url: '/truckmate/get-location-job-sheets?location_id=' + location_id,
                dataType: 'json',
                success: function(data) {
                    if(data && data.length > 0){
                        $('#expense_job_sheet_ids').empty().select2({data: data});
                        
                        // Pre-select job if job_sheet_id was passed
                        var urlParams = new URLSearchParams(window.location.search);
                        var jobSheetId = '<?php echo e(request()->get("job_sheet_id"), false); ?>';
                        if (jobSheetId) {
                            $('#expense_job_sheet_ids').val([jobSheetId]).trigger('change');
                        }
                    } else {
                        $('#expense_job_sheet_ids').empty().select2({data: [{id: '', text: 'No Jobs Available'}]});
                    }
                },
                error: function() {
                    console.log('error loading job sheets');
                    $('#expense_job_sheet_ids').empty().select2({data: [{id: '', text: 'Click to Select'}]});
                }
            });
        }
    }

    // Load job sheets on modal show if location is already selected
    if ($('#expense_location_id').val()) {
        load_expense_job_sheets();
    }
});
</script>
