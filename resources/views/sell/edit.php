

<?php
	$title = $transaction->type == 'sales_order' ? __('lang_v1.edit_sales_order') : __('sale.edit_sale');
?>
<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e($title, false); ?> <small>(<?php if($transaction->type == 'sales_order'): ?> <?php echo app('translator')->get('restaurant.order_no'); ?> <?php else: ?> <?php echo app('translator')->get('sale.invoice_no'); ?> <?php endif; ?>: <span class="text-success">#<?php echo e($transaction->invoice_no, false); ?>)</span></small></h1>
</section>
<!-- Main content -->
<section class="content">
<input type="hidden" id="amount_rounding_method" value="<?php echo e($pos_settings['amount_rounding_method'] ?? '', false); ?>">
<input type="hidden" id="amount_rounding_method" value="<?php echo e($pos_settings['amount_rounding_method'] ?? 'none', false); ?>">
<?php
	$custom_labels = json_decode(session('business.custom_labels'), true);
	// Phase 69: prefer controller-supplied per-branch common_settings; session is the fallback.
	$common_settings = isset($common_settings) && ! empty($common_settings)
		? $common_settings
		: session()->get('business.common_settings');
?>
<?php if(!empty($pos_settings['allow_overselling'])): ?>
	<input type="hidden" id="is_overselling_allowed">
<?php endif; ?>
<?php if(!empty($pos_settings['is_sales_order_required'])): ?>
	<input type="hidden" id="is_sales_order_required">
<?php endif; ?>
<?php if(!empty($pos_settings['is_quotation_required'])): ?>
	<input type="hidden" id="is_quotation_required">
<?php endif; ?>
<?php if(session('business.enable_rp') == 1): ?>
    <input type="hidden" id="reward_point_enabled">
<?php endif; ?>
<?php if(!empty($common_settings['disable_change_return_on_sale'])): ?>
	<input type="hidden" id="disable_change_return_on_sale">
<?php endif; ?>
	<!-- Page level currency setting -->
<input type="hidden" id="p_code" value="<?php echo e($currency_details->code, false); ?>">
<input type="hidden" id="p_symbol" value="<?php echo e($currency_details->symbol, false); ?>">
<input type="hidden" id="p_thousand" value="<?php echo e($currency_details->thousand_separator, false); ?>">
<input type="hidden" id="p_decimal" value="<?php echo e($currency_details->decimal_separator, false); ?>">    

<input type="hidden" id="item_addition_method" value="<?php echo e($business_details->item_addition_method, false); ?>">
<input type="hidden" id="customer_discount_type" value="<?php echo e($transaction->contact->discount_type, false); ?>">
<input type="hidden" id="customer_discount_amount" value="<?php echo e($transaction->contact->discount_amount, false); ?>">
	<?php echo Form::open(['url' => action([\App\Http\Controllers\SellPosController::class, 'update'], ['po' => $transaction->id ]), 'method' => 'put', 'id' => 'edit_sell_form', 'files' => true ]); ?>


	<?php echo Form::hidden('location_id', $transaction->location_id, ['id' => 'location_id', 'data-receipt_printer_type' => !empty($location_printer_type) ? $location_printer_type : 'browser', 'data-default_payment_accounts' => $transaction->location->default_payment_accounts]); ?>

	<?php echo Form::hidden('edit_transaction_id', $transaction->id, ['id' => 'edit_transaction_id']); ?>

	<?php if($transaction->type == 'sales_order'): ?>
	 	<input type="hidden" id="sale_type" value="<?php echo e($transaction->type, false); ?>">
	<?php endif; ?>
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<?php $__env->startComponent('components.widget', ['class' => 'box-success']); ?>
				<div class="row">
				<?php if(!empty($transaction->selling_price_group_id)): ?>
					<div class="col-md-4 col-sm-6">
						<div class="form-group mb-2">
							<div class="input-group">
								<span class="input-group-text">
									<i class="fas fa-money-bill-alt"></i>
								</span>
								<?php echo Form::hidden('price_group', $transaction->selling_price_group_id, ['id' => 'price_group']); ?>

								<?php echo Form::text('price_group_text', $transaction->price_group->name, ['class' => 'form-control', 'readonly']); ?>

								<span class="input-group-text">
									<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.price_group_help_text') . '"></i>';
                }
            ?>
								</span> 
							</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if(in_array('types_of_service', $enabled_modules) && !empty($transaction->types_of_service)): ?>
					<div class="col-md-4 col-sm-6">
						<div class="form-group mb-2">
							<div class="input-group">
								<span class="input-group-text">
									<i class="fas fa-external-link-square-alt text-primary service_modal_btn"></i>
								</span>
								<?php echo Form::select('types_of_service_id', $types_of_service, $transaction->types_of_service_id, [
                                        'class' => 'form-control',
                                        'id' => 'types_of_service_id',
                                        'style' => 'width: 80%;',
                                        'placeholder' => __('lang_v1.select_types_of_service'),
                                    ]); ?>

								

								<span class="input-group-text">
									<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.types_of_service_help') . '"></i>';
                }
            ?>
								</span> 
							</div>
							<small><p class="help-block <?php if(empty($transaction->selling_price_group_id)): ?> hide <?php endif; ?>" id="price_group_text"><?php echo app('translator')->get('lang_v1.price_group'); ?>: <span><?php if(!empty($transaction->selling_price_group_id)): ?><?php echo e($transaction->price_group->name, false); ?><?php endif; ?></span></p></small>
						</div>
					</div>
					<div class="modal fade types_of_service_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
						<?php if(!empty($transaction->types_of_service)): ?>
						<?php echo $__env->make('types_of_service.pos_form_modal', ['types_of_service' => $transaction->types_of_service], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="clearfix"></div>
				<div class="row">
				<div class="col-md-3">
					<div class="form-group mb-2">
						<?php echo Form::label('contact_id', __('contact.customer') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-text">
								<i class="fa fa-user"></i>
							</span>
							<input type="hidden" id="default_customer_id" 
							value="<?php echo e($transaction->contact->id, false); ?>" >
							<input type="hidden" id="default_customer_name" 
							value="<?php echo e(!empty($transaction->contact->name) ? $transaction->contact->name : $transaction->contact->supplier_business_name, false); ?>" >
							<input type="hidden" id="default_customer_balance" 
							value="<?php echo e($contact_deposit->advance_deposit- $contact_deposit->advance_deposit_paid, false); ?>" >
							
							<?php echo Form::select('contact_id', 
								[], $transaction->contact_id, ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required', 'style' => 'width: 70%;', ($transaction->payment_lines->count() == 0) ? '' : 'disabled']); ?>

							<?php if($is_offline): ?>
							
								<button type="button" class="btn btn-secondary bg-white btn-flat" id="offline_sync_customers"><i class="fa fa-sync text-primary"></i></button>
							
							<input class="hidden" id="is_offline" value="<?php echo e($is_offline, false); ?>">
							<?php else: ?>
							
								<button type="button" class="btn btn-secondary btn-sm bg-white btn-flat add_new_customer" <?php echo e(($transaction->payment_lines->count() == 0) ? '' : 'disabled', false); ?> data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
							
							<?php endif; ?>
						</div>
						<small class="text-danger <?php if(empty($customer_due)): ?> hide <?php endif; ?> contact_due_text"><strong><?php echo app('translator')->get('account.customer_due'); ?>:</strong> <span><?php echo e($customer_due ?? '', false); ?></span></small>
					</div>
					<?php if((!empty($pos_settings['enable_customer_note']))): ?>
						<div class="form-group mb-2">
							<?php echo Form::label('customer_note', __('sale.customer_note'). ':'); ?>

							<a href="javascript:void(0)" class="toggle-note" title="<?php echo e(__('sale.customer_note'), false); ?>">
								<i class="fa <?php echo e(!empty($transaction->customer_note) ? 'fa-minus-circle text-danger' : 'fa-plus-circle text-success', false); ?>"></i>
							</a>
							<div class="note-wrapper" style="<?php echo e(empty($transaction->customer_note) ? 'display:none;' : '', false); ?>">
								<?php echo Form::textarea('customer_note', $transaction->customer_note, ['class' => 'form-control', 'rows' => 3]); ?>

							</div>
						</div>
					<?php endif; ?>
					<?php if(empty($common_settings['hide_address_info'])): ?>
					<small>
						<strong>
							<?php echo app('translator')->get('lang_v1.billing_address'); ?>:
						</strong>
						<div id="billing_address_div">
							<?php echo $transaction->contact->contact_address ?? ''; ?>

							<?php if(!empty($transaction->contact->tax_number)): ?>
							<br><?php echo app('translator')->get('contact.tax_no_short'); ?>: <?php echo e($transaction->contact->tax_number, false); ?>

							<?php endif; ?>
							
						</div>
						<br>
						<strong>
							<?php echo app('translator')->get('lang_v1.shipping_address'); ?>:
						</strong>
						<div id="shipping_address_div">
							<?php echo $transaction->contact->supplier_business_name ?? ''; ?>, <br>
							<?php echo $transaction->contact->name ?? ''; ?>, <br>
							<?php echo $transaction->contact->shipping_address ?? ''; ?>

						</div>
						<?php if($fbr_di_integration): ?>

							<input type="hidden" id="default_customer_tax_number" value="<?php echo e($transaction->contact->tax_number, false); ?>">
							<input type="hidden" id="default_customer_fbr_st_reg_type" value="<?php echo e($transaction->contact->fbr_st_reg_type, false); ?>">
							<strong><?php echo app('translator')->get('lang_v1.fbr_st_reg_type'); ?>:</strong> <p id="fbr_st_reg_type"><?php echo e(!empty($transaction->contact->fbr_st_reg_type) ? $transaction->contact->fbr_st_reg_type : 'Unregistered', false); ?></p>
							<strong><?php echo app('translator')->get('lang_v1.fbr_statl_status'); ?>:</strong>
							<p class="badge hide" id='fbr_st_atl_status'></p>
						<?php endif; ?>						
					</small>
					<?php endif; ?>
					<div class="d-flex flex-wrap gap-3">
						<div class="form-check">
							<label class="form-check-label">
								<input type="checkbox" class="form-check-input" name="is_inclusive" id="is_inclusive_tax"
									<?php echo !empty($transaction->is_inclusive) ? 'Checked' : '' ?>>
								Is Tax Inclusive?
							</label>
						</div>
						<?php if(in_array('subscription', $enabled_modules)): ?>
							<div class="form-check">
								<label class="form-check-label">
									<?php echo Form::checkbox('is_recurring', 1, $transaction->is_recurring, ['class' => 'form-check-input', 'id' => 'is_recurring']); ?> <?php echo app('translator')->get('lang_v1.subscribe'); ?>?
								</label>
								<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.recurring_invoice_help') . '"></i>';
                }
            ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-md-9">
				<div class="row">
				<?php if(empty($common_settings['hide_pay_turm'])): ?>
					<div class="col-sm-6 col-md-4">
						<div class="form-group mb-2">
							<?php
								$is_pay_term_required = !empty($pos_settings['is_pay_term_required']);
							?>
							<?php echo Form::label('pay_term_number', __('contact.pay_term') . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.pay_term') . '"></i>';
                }
            ?>
							<div class="d-flex">
								<?php echo Form::number('pay_term_number', $transaction->pay_term_number, 
								['class' => 'form-control', 'placeholder' => __('contact.pay_term'),
								'required' => $is_pay_term_required,
								'style' => 'width: 50%; border-top-right-radius: 0; border-bottom-right-radius: 0;',
								!empty($common_settings['make_pay_term_readonly']) ? 'readonly' : '']); ?>

								<?php echo Form::select('pay_term_type', 
									['months' => __('lang_v1.months'), 
										'days' => __('lang_v1.days')], 
										$transaction->pay_term_type, 
										array_merge(
											[
											'class' => 'form-control',
											'placeholder' => __('messages.please_select'),
											'required' => $is_pay_term_required,
											],
											!empty($common_settings['make_pay_term_readonly']) 
											? ['style' => 'pointer-events: none; background-color:#F5F5F5; width: 50%; border-top-left-radius: 0; border-bottom-left-radius: 0;']
											: ['style' => 'width: 50%; border-top-left-radius: 0; border-bottom-left-radius: 0;']
										),
									); ?>

							</div>
						</div>
					</div>
				<?php endif; ?>
				<?php
					$is_readonly = empty($user_settings['enable_sale_transaction_date']) ? 'disabled' : '';
				?>
				<div class="col-sm-6 col-md-4">
					<div class="form-group mb-2">
						<?php echo Form::label('transaction_date', __('sale.sale_date') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-text">
								<i class="fa fa-calendar"></i>
							</span>
							<?php echo Form::text('transaction_date', $transaction->transaction_date, ['class' => 'form-control', 'readonly', 'required', $is_readonly]); ?>

						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4">
					<div class="form-group mb-2">
						<?php echo Form::label('invoice_no', $transaction->type == 'sales_order' ? __('restaurant.order_no'): __('sale.invoice_no') . ':'); ?>

						<?php echo Form::text('invoice_no', $transaction->invoice_no, 
						['class' => 'form-control', 
						 'placeholder' => $transaction->type == 'sales_order' ? __('restaurant.order_no'): __('sale.invoice_no'),
						]); ?>

						<b id="invoice_no_error" class="error hide"><?php echo app('translator')->get('lang_v1.not_unique', ['name' => $transaction->type == 'sales_order' ? __('restaurant.order_no') : __('sale.invoice_no') ]); ?></b>
					</div>
				</div>				
				<?php echo $__env->make('transaction.partials.back_order_field', ['transaction' => $transaction], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				
				<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_sale_ref_no')): ?>
				<div class="col-sm-6 col-md-4">
					<div class="form-group mb-2">
						<?php echo Form::label('ref_no',__('sale.ref_no') . ':',); ?>

						<?php echo Form::text('ref_no', $transaction->ref_no, ['class' => 'form-control','placeholder' => __('sale.ref_no'),]); ?>

					</div>

				<?php
					if($transaction->status == 'draft' && $transaction->is_quotation == 1){
						$status = 'quotation';
					} else if ($transaction->status == 'draft' && $transaction->sub_status == 'proforma') {
						$status = 'proforma';
					} else {
						$status = $transaction->status;
					}
				?>
				<?php if(in_array($status, ['draft', 'quotation'])): ?>
				<input type="hidden" id="disable_qty_alert">
				<?php if(!empty($common_settings['enable_draft_auto_save'])): ?>
					<input type="hidden" id="draft_auto_save" value="<?php echo e($common_settings['enable_draft_auto_save'], false); ?>">
				<?php endif; ?>
				<?php endif; ?>
				<?php if($status == 'draft'): ?>
				<input type="hidden" name="draft_status" value="<?php if($transaction->draft_status == 'autosaved' || empty($transaction->draft_status)): ?> ordered <?php else: ?> <?php echo e($transaction->draft_status, false); ?> <?php endif; ?>">
				<?php endif; ?>
				<?php if($transaction->type == 'sales_order'): ?>
					<input type="hidden" name="status" id="status" value="<?php echo e($transaction->status, false); ?>">
				<?php else: ?>
					<div class="form-group mb-2">
						<?php echo Form::label('status', __('sale.status') . ':*'); ?>

						<?php echo Form::select(
							'status',
							$statuses,
							$status,
							array_merge(
								['class' => 'form-select', 'placeholder' => __('messages.please_select'), 'required'],
								empty($common_settings['readonly_sale_status']) 
									? ['style' => 'width: 80%;'] 
									: ['style' => 'pointer-events: none;background-color:#F5F5F5;']
							)
						); ?>

					</div>
				<?php endif; ?>
				</div>
				<?php endif; ?>
				<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('edit_sale_ref_no')): ?>
				<?php
					if($transaction->status == 'draft' && $transaction->is_quotation == 1){
						$status = 'quotation';
					} else if ($transaction->status == 'draft' && $transaction->sub_status == 'proforma') {
						$status = 'proforma';
					} else {
						$status = $transaction->status;
					}
				?>
				<?php if(in_array($status, ['draft', 'quotation'])): ?>
				<input type="hidden" id="disable_qty_alert">
				<?php if(!empty($common_settings['enable_draft_auto_save'])): ?>
					<input type="hidden" id="draft_auto_save" value="<?php echo e($common_settings['enable_draft_auto_save'], false); ?>">
				<?php endif; ?>
				<?php endif; ?>
				<?php if($status == 'draft'): ?>
				<input type="hidden" name="draft_status" value="<?php if($transaction->draft_status == 'autosaved' || empty($transaction->draft_status)): ?> ordered <?php else: ?> <?php echo e($transaction->draft_status, false); ?> <?php endif; ?>">
				<?php endif; ?>
				<?php if($transaction->type == 'sales_order'): ?>
					<input type="hidden" name="status" id="status" value="<?php echo e($transaction->status, false); ?>">
				<?php else: ?>
					<div class="col-sm-6 col-md-4">
						<div class="form-group mb-2">
							<?php echo Form::label('status', __('sale.status') . ':*'); ?>

							<?php echo Form::select(
								'status',
								$statuses,
								$status,
								array_merge(
									['class' => 'form-select', 'placeholder' => __('messages.please_select'), 'required'],
									empty($common_settings['readonly_sale_status']) 
										? ['style' => 'width: 80%;'] 
										: ['style' => 'pointer-events: none;background-color:#F5F5F5;']
								)
							); ?>

						</div>
					</div>
				<?php endif; ?>
				<?php endif; ?>
				
				<?php if($transaction->status == 'draft'): ?>
				<div class="col-sm-6 col-md-4">
					<div class="form-group mb-2">
						<?php echo Form::label('invoice_scheme_id', __('invoice.invoice_scheme') . ':'); ?>

						<?php echo Form::select('invoice_scheme_id', $invoice_schemes, $default_invoice_schemes->id, ['class' => 'form-control select2']); ?>

					</div>
				</div>
				<?php endif; ?>

				<?php if($fbr_di_integration && $fbr_di_sandbox): ?>
				<div class="col-sm-6 col-md-4">
					<div class="mb-3">
						<?php echo Form::label('fbr_di_scenario', __('lang_v1.fbr_di_scenario') . ':*'); ?>

						<?php echo Form::select('fbr_di_scenario', $fbr_di_sandbox_scenarios, 'SN002', ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

					</div>
				</div>
				<?php endif; ?>
				
				<?php if(!empty($common_settings['show_invoice_layout'])): ?>
				<?php
				$default_layout_id = $transaction->location->sale_invoice_layout_id;
				if($status == 'quotation' && !empty($transaction->location->loc_settings['quotation_layout_id'])){
					$default_layout_id = $transaction->location->loc_settings['quotation_layout_id'];
				}
				?>
				<div class="col-sm-6 col-md-4">
					<div class="form-group mb-2">
						<?php echo Form::label('invoice_scheme_id', __('invoice.invoice_layouts') . ':'); ?>

						<?php echo Form::select('invoice_layout_id', $invoice_layouts, !empty($transaction->invoice_layout_id) ? $transaction->invoice_layout_id : $default_layout_id, [
							'class' => 'form-control select2', 'id' => 'invoice_layout_id']); ?>

					</div>
				</div>
				<?php endif; ?>

				<?php if(!empty($commission_agent)): ?>
				<?php
					$is_commission_agent_required = !empty($pos_settings['is_commission_agent_required']);
				?>
				<div class="col-sm-6 col-md-4">
					<div class="form-group mb-2">
					<?php echo Form::label('commission_agent', __('lang_v1.commission_agent') . ':'); ?>

					<?php echo Form::select('commission_agent', $commission_agent, $transaction->commission_agent, 
					array_merge(
					[
						'id' => 'commission_agent',
						'required' => $is_commission_agent_required, 'style' => 'width: 80%;'
					],
					!empty($user_settings['commission_agent_readonly']) 
						? ['class' => 'form-control', 'style' => 'pointer-events: none;background-color:#F5F5F5;']
						: ['class' => 'form-control select2',]
					)
					); ?>

					</div>
				</div>
				<?php endif; ?>
				<?php if(in_array('upload_documents', $enabled_modules)): ?>
				<?php if(empty($common_settings['hide_attach_document_sale'])): ?>
					<div class="col-sm-6 col-md-4">
						<div class="form-group mb-2">
							<?php echo Form::label('upload_document', __('purchase.attach_document') . ':'); ?>

							<i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
							<?php echo Form::file('sell_document', ['id' => 'upload_document', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

						</div>
					</div>
				<?php endif; ?>
				<?php endif; ?>
				<?php if(!empty(session('business.allow_currency_change_sales'))): ?>
				<div class="col-sm-6 col-md-4">
					<div class="form-group mb-2">
						<?php echo Form::label('location_currency_id_select', __('lang_v1.currency') . ':'); ?>

						<select name="location_currency_id_edit" id="location_currency_id_select" class="form-control select2" style="width: 100%;">
							<option value=""><?php echo app('translator')->get('lang_v1.default_currency'); ?></option>
							<?php if(!empty($location_currencies)): ?>
								<?php $__currentLoopData = $location_currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc_cur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($loc_cur->multiplier, false); ?>"
										data-id="<?php echo e($loc_cur->id, false); ?>"
										data-country="<?php echo e($loc_cur->country, false); ?>"
										data-currency="<?php echo e($loc_cur->currency, false); ?>"
										data-code="<?php echo e($loc_cur->code, false); ?>"
										data-symbol="<?php echo e($loc_cur->symbol, false); ?>"
										data-thousand_separator="<?php echo e($loc_cur->thousand_separator, false); ?>"
										data-decimal_separator="<?php echo e($loc_cur->decimal_separator, false); ?>"
										data-multiplier="<?php echo e(number_format($loc_cur->multiplier, 9, '.', ''), false); ?>"
										<?php echo e($transaction->location_currency_id == $loc_cur->id ? 'selected' : '', false); ?>

									><?php echo e($loc_cur->code, false); ?> (<?php echo e($loc_cur->symbol, false); ?>) - <?php echo e(number_format($loc_cur->multiplier, 9, '.', ''), false); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</select>
					</div>
				</div>
				<?php endif; ?>
				<div class="col-sm-6 col-md-4 <?php if(empty(session('business.allow_currency_change_sales'))): ?> hide <?php endif; ?>">
                    <div class="form-group mb-2">
                        <?php echo Form::label('exchange_rate', __('purchase.p_exchange_rate') . ':*'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-info"></i>
                            </span>
                            <?php echo Form::number('exchange_rate', $transaction->exchange_rate, [
                                'class' => 'form-control',
                                'required',
								'id' => 'exchange_rate_hidden',
                                'step' => 'any',
                            ]); ?>

                            <button type="button" class="btn btn-outline-info btn-sm refresh_exchange_rate_btn" id="refresh_exchange_rate_btn" title="<?php echo app('translator')->get('lang_v1.fetch_latest_rate'); ?>"><i class="fa fa-sync-alt"></i></button>
                        </div>
                        <span class="help-block text-danger">
                            <?php echo app('translator')->get('purchase.diff_purchase_currency_help', ['currency' => $currency_details->name]); ?>
                        </span>
                        <input type="hidden" name="location_currency_id" id="location_currency_id" value="<?php echo e($transaction->location_currency_id, false); ?>" data-currency-code="<?php echo e(optional(\App\LocationCurrency::find($transaction->location_currency_id))->code ?? '', false); ?>" data-currency-symbol="<?php echo e(optional(\App\LocationCurrency::find($transaction->location_currency_id))->symbol ?? '', false); ?>">
                    </div>
                </div>
				</div>
				<div class="<?php if(!empty($commission_agent)): ?> col-sm-3 <?php else: ?> col-sm-3 <?php endif; ?>"></div>
				</div>
		        <div class="clearfix"></div>
				<?php
			        $custom_field_1_label = !empty($custom_labels['sell']['custom_field_1']) ? $custom_labels['sell']['custom_field_1'] : '';

			        $is_custom_field_1_required = !empty($custom_labels['sell']['is_custom_field_1_required']) && $custom_labels['sell']['is_custom_field_1_required'] == 1 ? true : false;

			        $custom_field_2_label = !empty($custom_labels['sell']['custom_field_2']) ? $custom_labels['sell']['custom_field_2'] : '';

			        $is_custom_field_2_required = !empty($custom_labels['sell']['is_custom_field_2_required']) && $custom_labels['sell']['is_custom_field_2_required'] == 1 ? true : false;

			        $custom_field_3_label = !empty($custom_labels['sell']['custom_field_3']) ? $custom_labels['sell']['custom_field_3'] : '';

			        $is_custom_field_3_required = !empty($custom_labels['sell']['is_custom_field_3_required']) && $custom_labels['sell']['is_custom_field_3_required'] == 1 ? true : false;

			        $custom_field_4_label = !empty($custom_labels['sell']['custom_field_4']) ? $custom_labels['sell']['custom_field_4'] : '';

			        $is_custom_field_4_required = !empty($custom_labels['sell']['is_custom_field_4_required']) && $custom_labels['sell']['is_custom_field_4_required'] == 1 ? true : false;

					$custom_field_5_label = !empty($custom_labels['sell']['custom_field_5']) ? $custom_labels['sell']['custom_field_5'] : '';

					$is_custom_field_5_required = !empty($custom_labels['sell']['is_custom_field_5_required']) && $custom_labels['sell']['is_custom_field_5_required'] == 1 ? true : false;

					$custom_field_6_label = !empty($custom_labels['sell']['custom_field_6']) ? $custom_labels['sell']['custom_field_6'] : '';

					$is_custom_field_6_required = !empty($custom_labels['sell']['is_custom_field_6_required']) && $custom_labels['sell']['is_custom_field_6_required'] == 1 ? true : false;

					$custom_field_7_label = !empty($custom_labels['sell']['custom_field_7']) ? $custom_labels['sell']['custom_field_7'] : '';

					$is_custom_field_7_required = !empty($custom_labels['sell']['is_custom_field_7_required']) && $custom_labels['sell']['is_custom_field_7_required'] == 1 ? true : false;

					$custom_field_8_label = !empty($custom_labels['sell']['custom_field_8']) ? $custom_labels['sell']['custom_field_8'] : '';

					$is_custom_field_8_required = !empty($custom_labels['sell']['is_custom_field_8_required']) && $custom_labels['sell']['is_custom_field_8_required'] == 1 ? true : false;

					$custom_field_9_label = !empty($custom_labels['sell']['custom_field_9']) ? $custom_labels['sell']['custom_field_9'] : '';

					$is_custom_field_9_required = !empty($custom_labels['sell']['is_custom_field_9_required']) && $custom_labels['sell']['is_custom_field_9_required'] == 1 ? true : false;

					$custom_field_10_label = !empty($custom_labels['sell']['custom_field_10']) ? $custom_labels['sell']['custom_field_10'] : '';

					$is_custom_field_10_required = !empty($custom_labels['sell']['is_custom_field_10_required']) && $custom_labels['sell']['is_custom_field_10_required'] == 1 ? true : false;

					$custom_field_11_label = !empty($custom_labels['sell']['custom_field_11']) ? $custom_labels['sell']['custom_field_11'] : '';

					$is_custom_field_11_required = !empty($custom_labels['sell']['is_custom_field_11_required']) && $custom_labels['sell']['is_custom_field_11_required'] == 1 ? true : false;

					$custom_field_12_label = !empty($custom_labels['sell']['custom_field_12']) ? $custom_labels['sell']['custom_field_12'] : '';

					$is_custom_field_12_required = !empty($custom_labels['sell']['is_custom_field_12_required']) && $custom_labels['sell']['is_custom_field_12_required'] == 1 ? true : false;

					$custom_field_13_label = !empty($custom_labels['sell']['custom_field_13']) ? $custom_labels['sell']['custom_field_13'] : '';

					$is_custom_field_13_required = !empty($custom_labels['sell']['is_custom_field_13_required']) && $custom_labels['sell']['is_custom_field_13_required'] == 1 ? true : false;

					$custom_field_14_label = !empty($custom_labels['sell']['custom_field_14']) ? $custom_labels['sell']['custom_field_14'] : '';

					$is_custom_field_14_required = !empty($custom_labels['sell']['is_custom_field_14_required']) && $custom_labels['sell']['is_custom_field_14_required'] == 1 ? true : false;
		        ?>
		        <?php if(!empty($custom_field_1_label)): ?>
		        	<?php
		        		$label_1 = $custom_field_1_label . ':';
		        		if($is_custom_field_1_required) {
		        			$label_1 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group mb-2">
				            <?php echo Form::label('custom_field_1', $label_1 ); ?>

				            <?php echo Form::text('custom_field_1', $transaction->custom_field_1, ['class' => 'form-control','placeholder' => $custom_field_1_label, 'required' => $is_custom_field_1_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_2_label)): ?>
		        	<?php
		        		$label_2 = $custom_field_2_label . ':';
		        		if($is_custom_field_2_required) {
		        			$label_2 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group mb-2">
				            <?php echo Form::label('custom_field_2', $label_2 ); ?>

				            <?php echo Form::text('custom_field_2', $transaction->custom_field_2, ['class' => 'form-control','placeholder' => $custom_field_2_label, 'required' => $is_custom_field_2_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_3_label)): ?>
		        	<?php
		        		$label_3 = $custom_field_3_label . ':';
		        		if($is_custom_field_3_required) {
		        			$label_3 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group mb-2">
				            <?php echo Form::label('custom_field_3', $label_3 ); ?>

				            <?php echo Form::text('custom_field_3', $transaction->custom_field_3, ['class' => 'form-control','placeholder' => $custom_field_3_label, 'required' => $is_custom_field_3_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_4_label)): ?>
		        	<?php
		        		$label_4 = $custom_field_4_label . ':';
		        		if($is_custom_field_4_required) {
		        			$label_4 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group mb-2">
				            <?php echo Form::label('custom_field_4', $label_4 ); ?>

				            <?php echo Form::text('custom_field_4', $transaction->custom_field_4, ['class' => 'form-control','placeholder' => $custom_field_4_label, 'required' => $is_custom_field_4_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
				<div class="clearfix"></div>
		        <?php if(!empty($custom_field_5_label)): ?>
		        	<?php
		        		$label_5 = $custom_field_5_label . ':';
		        		if($is_custom_field_5_required) {
		        			$label_5 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group">
				            <?php echo Form::label('custom_field_5', $label_5 ); ?>

				            <?php echo Form::text('custom_field_5', $transaction->custom_field_5, ['class' => 'form-control','placeholder' => $custom_field_5_label, 'required' => $is_custom_field_5_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_6_label)): ?>
		        	<?php
		        		$label_6 = $custom_field_6_label . ':';
		        		if($is_custom_field_6_required) {
		        			$label_6 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group">
				            <?php echo Form::label('custom_field_6', $label_6 ); ?>

				            <?php echo Form::text('custom_field_6', $transaction->custom_field_6, ['class' => 'form-control','placeholder' => $custom_field_6_label, 'required' => $is_custom_field_6_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_7_label)): ?>
		        	<?php
		        		$label_7 = $custom_field_7_label . ':';
		        		if($is_custom_field_7_required) {
		        			$label_7 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group">
				            <?php echo Form::label('custom_field_7', $label_7 ); ?>

				            <?php echo Form::text('custom_field_7', $transaction->custom_field_7, ['class' => 'form-control','placeholder' => $custom_field_7_label, 'required' => $is_custom_field_7_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_8_label)): ?>
		        	<?php
		        		$label_8 = $custom_field_8_label . ':';
		        		if($is_custom_field_8_required) {
		        			$label_8 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group">
				            <?php echo Form::label('custom_field_8', $label_8 ); ?>

				            <?php echo Form::text('custom_field_8', $transaction->custom_field_8, ['class' => 'form-control','placeholder' => $custom_field_8_label, 'required' => $is_custom_field_8_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_9_label)): ?>
		        	<?php
		        		$label_9 = $custom_field_9_label . ':';
		        		if($is_custom_field_9_required) {
		        			$label_9 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group">
				            <?php echo Form::label('custom_field_9', $label_9 ); ?>

				            <?php echo Form::text('custom_field_9', $transaction->custom_field_9, ['class' => 'form-control','placeholder' => $custom_field_9_label, 'required' => $is_custom_field_9_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_10_label)): ?>
		        	<?php
		        		$label_10 = $custom_field_10_label . ':';
		        		if($is_custom_field_10_required) {
		        			$label_10 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group">
				            <?php echo Form::label('custom_field_10', $label_10 ); ?>

				            <?php echo Form::text('custom_field_10', $transaction->custom_field_10, ['class' => 'form-control','placeholder' => $custom_field_10_label, 'required' => $is_custom_field_10_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_11_label)): ?>
		        	<?php
		        		$label_11 = $custom_field_11_label . ':';
		        		if($is_custom_field_11_required) {
		        			$label_11 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group">
				            <?php echo Form::label('custom_field_11', $label_11 ); ?>

				            <?php echo Form::text('custom_field_11', $transaction->custom_field_11, ['class' => 'form-control','placeholder' => $custom_field_11_label, 'required' => $is_custom_field_11_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_12_label)): ?>
		        	<?php
		        		$label_12 = $custom_field_12_label . ':';
		        		if($is_custom_field_12_required) {
		        			$label_12 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group">
				            <?php echo Form::label('custom_field_12', $label_12 ); ?>

				            <?php echo Form::text('custom_field_12', $transaction->custom_field_12, ['class' => 'form-control','placeholder' => $custom_field_12_label, 'required' => $is_custom_field_12_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_13_label)): ?>
		        	<?php
		        		$label_13 = $custom_field_13_label . ':';
		        		if($is_custom_field_13_required) {
		        			$label_13 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group">
				            <?php echo Form::label('custom_field_13', $label_13 ); ?>

				            <?php echo Form::text('custom_field_13', $transaction->custom_field_13, ['class' => 'form-control','placeholder' => $custom_field_13_label, 'required' => $is_custom_field_13_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_14_label)): ?>
		        	<?php
		        		$label_14 = $custom_field_14_label . ':';
		        		if($is_custom_field_14_required) {
		        			$label_14 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group">
				            <?php echo Form::label('custom_field_14', $label_14 ); ?>

				            <?php echo Form::text('custom_field_14', $transaction->custom_field_14, ['class' => 'form-control','placeholder' => $custom_field_14_label, 'required' => $is_custom_field_14_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
				<div class="clearfix"></div>
		        
		        <?php if((!empty($pos_settings['enable_sales_order']) && $transaction->type != 'sales_order') || $is_order_request_enabled): ?>
					<div class="col-sm-3">
						<div class="form-group mb-2">
							<?php echo Form::label('sales_order_ids', __('lang_v1.sales_order').':'); ?>

							<?php echo Form::select('sales_order_ids[]', $sales_orders, $transaction->sales_order_ids, ['class' => 'form-control select2 not_loaded', 'multiple', 'id' => 'sales_order_ids', 'style' => 'width: 80%;']); ?>

							<span class="help-block text-danger required-reference-warning hide" id="sales_order_required_warning">
								<?php echo app('translator')->get('lang_v1.sales_order_required_error'); ?>
							</span>
						</div>
					</div>
					<div class="clearfix"></div>
				<?php endif; ?>
				<!-- Call restaurant module if defined -->
		        <?php if(in_array('tables' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules)): ?>
		        	<span id="restaurant_module_span" 
		        		data-transaction_id="<?php echo e($transaction->id, false); ?>">
		        	</span>
		        <?php endif; ?>
			</div>
			</div>
			<?php echo $__env->renderComponent(); ?>
			
			<?php $__env->startComponent('components.widget', ['class' => 'box-success']); ?>
				<div class="col-sm-10 offset-md-1">
					<div class="form-group mb-2">
						<div class="input-group">
							
								
                                <button type="button" class="btn btn-primary" id="open_products_search_modal" title="<?php echo e(__('lang_v1.products_search'), false); ?>"><i class="fas fa-search"></i></button>
                                     
								
							
							<?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'),
							'autofocus' => true,
							]); ?>

							<?php if($is_offline): ?>
								
									<button type="button" class="btn btn-outline-secondary" id="offline_sync_products"><i class="fa fa-sync text-primary"></i></button>
								
							<?php else: ?>
								
									<button type="button" class="btn btn-outline-secondary pos_add_quick_product" data-href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'quickAdd']), false); ?>" data-container=".quick_add_product_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
								
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php
					$hide_discount = '';
					if (empty($common_settings['enable_inline_discount_sales'])) {
                        $hide_discount = 'hide';
                    }
                    $hide_discount2 = '';
                    if (empty($common_settings['enable_inline_discount2_sales'])) {
                        $hide_discount2 = 'hide';
                    }
                    $hide_tax = '';
                    if (empty($common_settings['enable_inline_tax_sales']) || $taxes['tax_rates']->count() <= 1) {
                        $hide_tax = 'hide';
                    }
					// if(empty($common_settings['enable_inline_tax_purchase'])){
					// 	$hide_tax = 'hide';
					// }
				?>
				<div class="row col-sm-12" style="min-height: 0">

					<input type="hidden" name="sell_price_tax" id="sell_price_tax" value="<?php echo e($business_details->sell_price_tax, false); ?>">

					<!-- Keeps count of product rows -->
					<input type="hidden" id="product_row_count" 
						value="<?php echo e(count($sell_details), false); ?>">
					<div class="sell_product_div">
					<div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
					<table class="table table-condensed table-th-skin table-bordered table-striped" id="pos_table">
						<thead>
							<tr>
								<th class="text-nowrap" style="width:1%; min-width:30px">#</th>
								<th class="text-center text-nowrap" style="width:1%; min-width:50px"><?php echo app('translator')->get('product.sku'); ?></th>
								<th class="text-center" style="width:100%">	
									<?php echo app('translator')->get('sale.product'); ?>
								</th>
								<?php if(!empty($common_settings['enable_serial_number'])): ?>
								<th class="text-center text-nowrap">
									<?php echo app('translator')->get('product.sr_imei_no'); ?>
								</th>
								<?php endif; ?>
								<?php if(!empty($user_settings['sale_show_brand_column'])): ?>
									<th class="text-center text-nowrap">
										<?php echo app('translator')->get('product.brand'); ?>
									</th>
								<?php endif; ?>
								<?php if(!empty($user_settings['sale_show_category_column'])): ?>
									<th class="text-center text-nowrap">
										<?php echo app('translator')->get('product.category'); ?>
									</th>
								<?php endif; ?>
								<th class="text-center text-nowrap">
									<?php echo app('translator')->get('sale.qty'); ?>
								</th>
								<?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
									<th class="text-center text-nowrap <?php if(!auth()->user()->can('enable_scheme_quantity_column')): ?> hide <?php endif; ?>">
										<?php echo app('translator')->get('sale.foc'); ?>
									</th>
								<?php endif; ?>
								<?php if(!empty($pos_settings['inline_service_staff'])): ?>
									<th class="text-center text-nowrap">
										<?php echo app('translator')->get('restaurant.service_staff'); ?>
									</th>
								<?php endif; ?>
								<th class="text-end text-nowrap <?php if(!auth()->user()->can('edit_product_price_from_sale_screen')): ?> hide <?php endif; ?>">
									<?php echo app('translator')->get('sale.unit_price'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>
								</th>
								<th class="text-center text-nowrap <?php echo e($hide_discount, false); ?>  <?php if(!auth()->user()->can('edit_product_discount_from_sale_screen')): ?> hide <?php endif; ?>" id="pos_discount_heading">
									<?php echo app('translator')->get('receipt.discount'); ?>
								</th>
								<th class="text-center text-nowrap <?php echo e($hide_discount2, false); ?>  <?php if(!auth()->user()->can('edit_product_discount_from_sale_screen')): ?> hide <?php endif; ?>" id="pos_discount2_heading">
									<?php echo app('translator')->get('receipt.discount'); ?> 2
								</th>
								<th class="text-end text-nowrap <?php echo e($hide_discount, false); ?> <?php if(!auth()->user()->can('edit_product_discount_from_sale_screen')): ?> hide <?php endif; ?>">
									<?php echo app('translator')->get('sale.unit_price_after_discount'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>
								</th>
								<th class="text-center text-nowrap <?php echo e($hide_tax, false); ?>" id="pos_tax_heading">
									<?php echo app('translator')->get('sale.tax'); ?>
								</th>
								<th class="text-end text-nowrap <?php echo e($hide_tax, false); ?>">
									<?php echo app('translator')->get('sale.price_inc_tax'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>
								</th>
								<?php if(!empty($common_settings['enable_product_warranty'])): ?>
									<th class="text-nowrap"><?php echo app('translator')->get('lang_v1.warranty'); ?></th>
								<?php endif; ?>
								<th class="text-end text-nowrap">
									<?php echo app('translator')->get('sale.subtotal'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>
								</th>
								<?php if(!empty($common_settings['enable_inline_profit_sales'])): ?>
								<th class="text-center text-nowrap">
									<?php echo app('translator')->get('lang_v1.profit_margin'); ?>
								</th>
								<?php endif; ?>
								<?php if(!empty($user_settings['enable_inline_cost_sales'])): ?>
								<th class="text-center text-nowrap">
									<?php echo app('translator')->get('lang_v1.last_purchase_price'); ?>
								</th>
								<?php endif; ?>
								<th class="text-center text-nowrap" style="width:1%; min-width:30px"><i class="fas fa-times" aria-hidden="true"></i></th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $sell_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo $__env->make('sell.product_row', ['sell'=> $transaction, 'product' => $sell_line, 'row_count' => $loop->index, 'tax_dropdown' => $taxes, 'sub_units' => !empty($sell_line->unit_details) ? $sell_line->unit_details : [], 'action' => 'edit', 'is_direct_sell' => true, 'so_line' => $sell_line->so_line, 'last_sell_line' => $sell_line->last_sell_line, 'is_sales_order' => $transaction->type == 'sales_order', 'is_quotation' => $transaction->is_quotation], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
					</div>
					</div>
				</div>

				<style>
					.sell-totals-row .table-sm th,
					.sell-totals-row .table-sm td {
						padding-top: 1px !important;
						padding-bottom: 1px !important;
						line-height: 1.5;
					}
				</style>
				<div class="row col-sm-12 gx-2 sell-totals-row" style="font-size:12px;">
					
					<div class="col">
						<table class="table table-sm table-borderless mb-0">
							<tr>
								<th class="text-end text-nowrap"><?php echo app('translator')->get('sale.item'); ?>:</th>
								<td class="text-end"><span class="total_quantity">0</span></td>
							</tr>
							<tr>
								<th class="text-end text-nowrap">Gross Profit %:</th>
								<td class="text-end"><span class="profit_percent">0</span></td>
							</tr>
						</table>
					</div>
					
					<div class="col <?php echo e($hide_discount, false); ?>">
						<table class="table table-sm table-borderless mb-0">
							<tr>
								<th class="text-end text-nowrap">Total Before Discount: <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
								<td class="text-end"><span class="total_before_discounts">0</span></td>
							</tr>
							<tr>
								<th class="text-end text-nowrap"><?php echo app('translator')->get('purchase.discount'); ?>: <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
								<td class="text-end"><span class="total_discounts">0</span></td>
							</tr>
							<tr>
								<th class="text-end text-nowrap">Total After Discount: <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
								<td class="text-end"><span class="total_after_discounts">0</span></td>
							</tr>
						</table>
					</div>
					
					<div class="col <?php echo e($hide_discount2, false); ?>">
						<table class="table table-sm table-borderless mb-0">
							<tr>
								<th class="text-end text-nowrap">Total Before Discount2: <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
								<td class="text-end"><span class="total_before_discounts2">0</span></td>
							</tr>
							<tr>
								<th class="text-end text-nowrap">Discount2: <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
								<td class="text-end"><span class="total_discounts2_items">0</span></td>
							</tr>
							<tr>
								<th class="text-end text-nowrap">Total After Discount2: <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
								<td class="text-end"><span class="total_after_discounts2">0</span></td>
							</tr>
						</table>
					</div>
					
					<div class="col <?php echo e($hide_tax, false); ?>">
						<table class="table table-sm table-borderless mb-0">
							<?php if(!empty($common_settings['enable_inline_tax_sales'])): ?>
							<tr>
								<th class="text-end text-nowrap">Total Before Tax: <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
								<td class="text-end"><span class="total_before_tax">0</span></td>
							</tr>
							<tr>
								<th class="text-end text-nowrap">Total Tax: <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
								<td class="text-end"><span class="total_tax">0</span></td>
							</tr>
							<tr>
								<th class="text-end text-nowrap">Total After Tax: <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
								<td class="text-end"><span class="total_after_tax">0</span></td>
							</tr>
							<?php endif; ?>
						</table>
					</div>
					
					<div class="col d-flex align-items-center">
						<table class="table table-sm table-borderless mb-0">
							<tr style="font-size:14px;">
								<th class="text-end text-nowrap"><?php echo app('translator')->get('sale.total'); ?>:</th>
								<td class="text-end"><strong><span class="price_total">0</span></strong></td>
							</tr>
						</table>
					</div>
				</div>
			<?php echo $__env->renderComponent(); ?>

			<?php $__env->startComponent('components.widget', ['class' => 'box-success']); ?>
                <?php if(!empty($common_settings['enable_total_discount_sale'])): ?>
					<div class="col-md-4 <?php if($transaction->type == 'sales_order'): ?> hide <?php endif; ?>">
						<div class="mb-3">
							<?php echo Form::label('discount_type', __('sale.discount_type') . ':*' ); ?>

							<div class="input-group">
								<span class="input-group-text">
									<i class="fa fa-info"></i>
								</span>
								<?php echo Form::select('discount_type', ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], $transaction->discount_type , ['class' => 'form-control','placeholder' => __('messages.please_select'), 'required', 'data-default' => 'percentage']); ?>

							</div>
						</div>
					</div>
					<?php
						$max_discount = !is_null(auth()->user()->max_sales_discount_percent) ? auth()->user()->max_sales_discount_percent : '';
						$inv_discount = $transaction->discount_amount;
						if($transaction->discount_type == 'fixed'){
							$inv_discount = $inv_discount / $transaction->exchange_rate;
						}
					?>
					<div class="col-md-4 <?php if($transaction->type == 'sales_order'): ?> hide <?php endif; ?>">
						<div class="mb-3">
							<?php echo Form::label('discount_amount', __('sale.discount_amount') . ':*' ); ?>

							<div class="input-group">
								<span class="input-group-text">
									<i class="fa fa-info"></i>
								</span>
								<?php echo Form::text('discount_amount', number_format($inv_discount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'data-default' => $business_details->default_sales_discount, 'data-max-discount' => $max_discount, 'data-max-discount-error_msg' => __('lang_v1.max_discount_error_msg', ['discount' => $max_discount != '' ? number_format($max_discount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '']) ]); ?>

							</div>
						</div>
					</div>
					<div class="col-md-4 <?php if($transaction->type == 'sales_order'): ?> hide <?php endif; ?>"><br>
						<b><?php echo app('translator')->get( 'sale.discount_amount' ); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>:</b>(-) 
						<span class="display_currency" id="total_discount">0</span>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12 well well-sm bg-light-skin <?php if(session('business.enable_rp') != 1 || $transaction->type == 'sales_order'): ?> hide <?php endif; ?>">
						<input type="hidden" name="rp_redeemed" id="rp_redeemed" value="<?php echo e($transaction->rp_redeemed, false); ?>">
						<input type="hidden" name="rp_redeemed_amount" id="rp_redeemed_amount" value="<?php echo e($transaction->rp_redeemed_amount, false); ?>">
						<div class="col-md-12"><h4><?php echo e(session('business.rp_name'), false); ?></h4></div>
						<div class="col-md-4">
							<div class="mb-3">
								<?php echo Form::label('rp_redeemed_modal', __('lang_v1.redeemed') . ':' ); ?>

								<div class="input-group">
									<span class="input-group-text">
										<i class="fa fa-gift"></i>
									</span>
									<?php echo Form::number('rp_redeemed_modal', $transaction->rp_redeemed, ['class' => 'form-control direct_sell_rp_input', 'data-amount_per_unit_point' => session('business.redeem_amount_per_unit_rp'), 'min' => 0, 'data-max_points' => !empty($redeem_details['points']) ? $redeem_details['points'] : 0, 'data-min_order_total' => session('business.min_order_total_for_redeem') ]); ?>

									<input type="hidden" id="rp_name" value="<?php echo e(session('business.rp_name'), false); ?>">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<p><strong><?php echo app('translator')->get('lang_v1.available'); ?>:</strong> <span id="available_rp"><?php echo e($redeem_details['points'] ?? 0, false); ?></span></p>
						</div>
						<div class="col-md-4">
							<p><strong><?php echo app('translator')->get('lang_v1.redeemed_amount'); ?>:</strong> (-)<span id="rp_redeemed_amount_text"><?php echo e(number_format($transaction->rp_redeemed_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></p>
						</div>
					</div>
				<?php endif; ?>

				<?php if(!empty($common_settings['enable_total_discount2_sale'])): ?>
					<div class="col-md-4 <?php if($transaction->type == 'sales_order'): ?> hide <?php endif; ?>">
						<div class="mb-3">
							<?php echo Form::label('discount2_type', __('sale.discount2_type') . ':*' ); ?>

							<div class="input-group">
								<span class="input-group-text">
									<i class="fa fa-info"></i>
								</span>
								<?php echo Form::select('discount2_type', ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], $transaction->discount2_type , 
								['class' => 'form-control','placeholder' => __('lang_v1.none'), 'required', 
								'data-default' => !empty($common_settings['default_invoice_discount2_type']) ? $common_settings['default_invoice_discount2_type'] : 'fixed']); ?>

							</div>
						</div>
					</div>
					<?php
						$max_discount = !is_null(auth()->user()->max_sales_discount_percent) ? auth()->user()->max_sales_discount_percent : '';
					?>
					<div class="col-md-4 <?php if($transaction->type == 'sales_order'): ?> hide <?php endif; ?>">
						<div class="mb-3">
							<?php echo Form::label('discount2_amount', __('sale.discount2_amount') . ':*' ); ?>

							<div class="input-group">
								<span class="input-group-text">
									<i class="fa fa-info"></i>
								</span>
								<?php echo Form::text('discount2_amount', number_format($transaction->discount2_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 
								'data-default' => $business_details->default_sales_discount, 
								'data-max-discount' => $max_discount, 'data-max-discount-error_msg' => __('lang_v1.max_discount_error_msg', ['discount' => $max_discount != '' ? number_format($max_discount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '']) ]); ?>

							</div>
						</div>
					</div>
					<div class="col-md-4 <?php if($transaction->type == 'sales_order'): ?> hide <?php endif; ?>"><br>
						<b><?php echo app('translator')->get( 'sale.discount2_amount' ); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>:</b>(-) 
						<span class="display_currency" id="total_discount2">0</span>
					</div>
				<?php endif; ?>

			    <div class="clearfix"></div>
                <?php if(!empty($common_settings['enable_total_tax_sale'])): ?>

			    <div class="col-md-4 <?php if($transaction->type == 'sales_order'): ?> hide <?php endif; ?>">
			    	<div class="form-group mb-2">
			            <?php echo Form::label('tax_rate_id', __('sale.order_tax') . ':*' ); ?>

			            <div class="input-group">
			                <span class="input-group-text">
			                    <i class="fa fa-info"></i>
			                </span>
			                <?php echo Form::select('tax_rate_id', $taxes['tax_rates'], $transaction->tax_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control', 'data-default'=> $business_details->default_sales_tax], $taxes['attributes']); ?>


							<input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" 
							value="<?php echo e(number_format($transaction->tax?->amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" data-default="<?php echo e($business_details->tax_calculation_amount, false); ?>">
			            </div>
			        </div>
			    </div>
			    <div class="col-md-4 col-md-offset-4 <?php if($transaction->type == 'sales_order'): ?> hide <?php endif; ?>">
			    	<b><?php echo app('translator')->get( 'sale.order_tax' ); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>:</b>(+) 
					<span class="display_currency" id="order_tax"><?php echo e($transaction->tax_amount, false); ?></span>
			    </div>
                    <?php endif; ?>
				<?php if(!empty($pos_settings['enable_sale_note'])): ?>
			    <div class="col-md-12">
			    	<div class="form-group mb-2">
						<?php echo Form::label('sell_note',__('sale.sell_note') . ':'); ?>

						<a href="javascript:void(0)" class="toggle-note" title="<?php echo e(__('sale.sell_note'), false); ?>">
							<i class="fa <?php echo e(!empty($transaction->additional_notes) ? 'fa-minus-circle text-danger' : 'fa-plus-circle text-success', false); ?>"></i>
						</a>
						<div class="note-wrapper" style="<?php echo e(empty($transaction->additional_notes) ? 'display:none;' : '', false); ?>">
							<?php echo Form::textarea('sale_note', $transaction->additional_notes, ['class' => 'form-control', 'rows' => 3]); ?>

						</div>
					</div>
			    </div>
				<?php endif; ?>
			    <input type="hidden" name="is_direct_sale" value="1">
			<?php echo $__env->renderComponent(); ?>

			<?php $__env->startComponent('components.widget', ['class' => 'box-success']); ?>
                <?php if(!empty($common_settings['enable_shipping_details_sale'])): ?>

			<div class="col-md-4">
				<div class="form-group mb-2">
		            <?php echo Form::label('shipping_details', __('sale.shipping_details')); ?>

		            <?php echo Form::textarea('shipping_details',$transaction->shipping_details, ['class' => 'form-control','placeholder' => __('sale.shipping_details') ,'rows' => '3', 'cols'=>'30']); ?>

		        </div>
			</div>
			<div class="col-md-4">
				<div class="form-group mb-2">
		            <?php echo Form::label('shipping_address', __('lang_v1.shipping_address')); ?>

		            <?php echo Form::textarea('shipping_address', $transaction->shipping_address, ['class' => 'form-control','placeholder' => __('lang_v1.shipping_address') ,'rows' => '3', 'cols'=>'30']); ?>

		        </div>
			</div>
			<div class="col-md-4">
				<div class="form-group mb-2">
					<?php echo Form::label('shipping_charges', __('sale.shipping_charges')); ?>

					<div class="input-group">
					<span class="input-group-text">
					<i class="fa fa-info"></i>
					</span>
					<?php echo Form::text('shipping_charges',number_format($transaction->shipping_charges, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']),['class'=>'form-control input_number','placeholder'=> __('sale.shipping_charges')]); ?>

					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-4">
				<div class="form-group mb-2">
		            <?php echo Form::label('shipping_status', __('lang_v1.shipping_status')); ?>

		            <?php echo Form::select('shipping_status',$shipping_statuses, $transaction->shipping_status, ['class' => 'form-control','placeholder' => __('messages.please_select')]); ?>

		        </div>
			</div>
			<div class="col-md-4">
		        <div class="form-group mb-2">
		            <?php echo Form::label('delivered_to', __('lang_v1.delivered_to') . ':' ); ?>

		            <?php echo Form::text('delivered_to', $transaction->delivered_to, ['class' => 'form-control','placeholder' => __('lang_v1.delivered_to')]); ?>

		        </div>
		    </div>

		    <?php
		        $shipping_custom_label_1 = !empty($custom_labels['shipping']['custom_field_1']) ? $custom_labels['shipping']['custom_field_1'] : '';

		        $is_shipping_custom_field_1_required = !empty($custom_labels['shipping']['is_custom_field_1_required']) && $custom_labels['shipping']['is_custom_field_1_required'] == 1 ? true : false;

		        $shipping_custom_label_2 = !empty($custom_labels['shipping']['custom_field_2']) ? $custom_labels['shipping']['custom_field_2'] : '';

		        $is_shipping_custom_field_2_required = !empty($custom_labels['shipping']['is_custom_field_2_required']) && $custom_labels['shipping']['is_custom_field_2_required'] == 1 ? true : false;

		        $shipping_custom_label_3 = !empty($custom_labels['shipping']['custom_field_3']) ? $custom_labels['shipping']['custom_field_3'] : '';
		        
		        $is_shipping_custom_field_3_required = !empty($custom_labels['shipping']['is_custom_field_3_required']) && $custom_labels['shipping']['is_custom_field_3_required'] == 1 ? true : false;

		        $shipping_custom_label_4 = !empty($custom_labels['shipping']['custom_field_4']) ? $custom_labels['shipping']['custom_field_4'] : '';
		        
		        $is_shipping_custom_field_4_required = !empty($custom_labels['shipping']['is_custom_field_4_required']) && $custom_labels['shipping']['is_custom_field_4_required'] == 1 ? true : false;

		        $shipping_custom_label_5 = !empty($custom_labels['shipping']['custom_field_5']) ? $custom_labels['shipping']['custom_field_5'] : '';
		        
		        $is_shipping_custom_field_5_required = !empty($custom_labels['shipping']['is_custom_field_5_required']) && $custom_labels['shipping']['is_custom_field_5_required'] == 1 ? true : false;
	        ?>

	        <?php if(!empty($shipping_custom_label_1)): ?>
	        	<?php
	        		$label_1 = $shipping_custom_label_1 . ':';
	        		if($is_shipping_custom_field_1_required) {
	        			$label_1 .= '*';
	        		}
	        	?>

	        	<div class="col-md-4">
			        <div class="form-group mb-2">
			            <?php echo Form::label('shipping_custom_field_1', $label_1 ); ?>

			            <?php echo Form::text('shipping_custom_field_1', !empty($transaction->shipping_custom_field_1) ? $transaction->shipping_custom_field_1 : null, ['class' => 'form-control','placeholder' => $shipping_custom_label_1, 'required' => $is_shipping_custom_field_1_required]); ?>

			        </div>
			    </div>
	        <?php endif; ?>
	        <?php if(!empty($shipping_custom_label_2)): ?>
	        	<?php
	        		$label_2 = $shipping_custom_label_2 . ':';
	        		if($is_shipping_custom_field_2_required) {
	        			$label_2 .= '*';
	        		}
	        	?>

	        	<div class="col-md-4">
			        <div class="form-group mb-2">
			            <?php echo Form::label('shipping_custom_field_2', $label_2 ); ?>

			            <?php echo Form::text('shipping_custom_field_2', !empty($transaction->shipping_custom_field_2) ? $transaction->shipping_custom_field_2 : null, ['class' => 'form-control','placeholder' => $shipping_custom_label_2, 'required' => $is_shipping_custom_field_2_required]); ?>

			        </div>
			    </div>
	        <?php endif; ?>
	        <?php if(!empty($shipping_custom_label_3)): ?>
	        	<?php
	        		$label_3 = $shipping_custom_label_3 . ':';
	        		if($is_shipping_custom_field_3_required) {
	        			$label_3 .= '*';
	        		}
	        	?>

	        	<div class="col-md-4">
			        <div class="form-group mb-2">
			            <?php echo Form::label('shipping_custom_field_3', $label_3 ); ?>

			            <?php echo Form::text('shipping_custom_field_3', !empty($transaction->shipping_custom_field_3) ? $transaction->shipping_custom_field_3 : null, ['class' => 'form-control','placeholder' => $shipping_custom_label_3, 'required' => $is_shipping_custom_field_3_required]); ?>

			        </div>
			    </div>
	        <?php endif; ?>
	        <?php if(!empty($shipping_custom_label_4)): ?>
	        	<?php
	        		$label_4 = $shipping_custom_label_4 . ':';
	        		if($is_shipping_custom_field_4_required) {
	        			$label_4 .= '*';
	        		}
	        	?>

	        	<div class="col-md-4">
			        <div class="form-group mb-2">
			            <?php echo Form::label('shipping_custom_field_4', $label_4 ); ?>

			            <?php echo Form::text('shipping_custom_field_4', !empty($transaction->shipping_custom_field_4) ? $transaction->shipping_custom_field_4 : null, ['class' => 'form-control','placeholder' => $shipping_custom_label_4, 'required' => $is_shipping_custom_field_4_required]); ?>

			        </div>
			    </div>
	        <?php endif; ?>
	        <?php if(!empty($shipping_custom_label_5)): ?>
	        	<?php
	        		$label_5 = $shipping_custom_label_5 . ':';
	        		if($is_shipping_custom_field_5_required) {
	        			$label_5 .= '*';
	        		}
	        	?>

	        	<div class="col-md-4">
			        <div class="form-group mb-2">
			            <?php echo Form::label('shipping_custom_field_5', $label_5 ); ?>

			            <?php echo Form::text('shipping_custom_field_5', !empty($transaction->shipping_custom_field_5) ? $transaction->shipping_custom_field_5 : null, ['class' => 'form-control','placeholder' => $shipping_custom_label_5, 'required' => $is_shipping_custom_field_5_required]); ?>

			        </div>
			    </div>
	        <?php endif; ?>
	        <?php if(in_array('upload_documents', $enabled_modules)): ?>
	        <div class="col-md-4">
                <div class="form-group mb-2">
                    <?php echo Form::label('shipping_documents', __('lang_v1.shipping_documents') . ':'); ?>

                    <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                    <?php echo Form::file('shipping_documents[]', ['id' => 'shipping_documents', 'multiple', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

                    <?php
                    	$medias = $transaction->media->where('model_media_type', 'shipping_document')->all();
                    ?>
                    <?php echo $__env->make('sell.partials.media_table', ['medias' => $medias, 'delete' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
            <?php endif; ?>
			<?php endif; ?>
	        <div class="clearfix"></div>
                <?php if(!empty($common_settings['enable_additional_expense_sale'])): ?>

	        <div class="col-md-12 text-center">
				<button type="button" class="btn btn-primary btn-sm" id="toggle_additional_expense"> <i class="fas fa-plus"></i> <?php echo app('translator')->get('lang_v1.add_additional_expenses'); ?> <i class="fas fa-chevron-down"></i></button>
			</div>
			<div class="col-md-8 col-md-offset-4" id="additional_expenses_div">
				<table class="table table-condensed">
					<thead>
						<tr>
							<th><?php echo app('translator')->get('lang_v1.additional_expense_name'); ?></th>
							<th><?php echo app('translator')->get('sale.amount'); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<?php echo Form::text('additional_expense_key_1', $transaction->additional_expense_key_1, ['class' => 'form-control', 'id' => 'additional_expense_key_1']); ?>

							</td>
							<td>
								<?php echo Form::text('additional_expense_value_1', number_format($transaction->additional_expense_value_1, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'id' => 'additional_expense_value_1']); ?>

							</td>
						</tr>
						<tr>
							<td>
								<?php echo Form::text('additional_expense_key_2', $transaction->additional_expense_key_2, ['class' => 'form-control', 'id' => 'additional_expense_key_2']); ?>

							</td>
							<td>
								<?php echo Form::text('additional_expense_value_2', number_format($transaction->additional_expense_value_2, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'id' => 'additional_expense_value_2']); ?>

							</td>
						</tr>
						<tr>
							<td>
								<?php echo Form::text('additional_expense_key_3', $transaction->additional_expense_key_3, ['class' => 'form-control', 'id' => 'additional_expense_key_3']); ?>

							</td>
							<td>
								<?php echo Form::text('additional_expense_value_3', number_format($transaction->additional_expense_value_3, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'id' => 'additional_expense_value_3']); ?>

							</td>
						</tr>
						<tr>
							<td>
								<?php echo Form::text('additional_expense_key_4', $transaction->additional_expense_key_4, ['class' => 'form-control', 'id' => 'additional_expense_key_4']); ?>

							</td>
							<td>
								<?php echo Form::text('additional_expense_value_4', number_format($transaction->additional_expense_value_4, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'id' => 'additional_expense_value_4']); ?>

							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php endif; ?>
		    <div class="col-md-4 col-md-offset-8">
		    	<?php if(!empty($pos_settings['amount_rounding_method']) && $pos_settings['amount_rounding_method'] > 0): ?>
		    	<small id="round_off"><br>(<?php echo app('translator')->get('lang_v1.round_off'); ?>: <span id="round_off_text">0</span>)</small>
				<br/>
				<input type="hidden" name="round_off_amount" 
					id="round_off_amount" value=0>
				<?php endif; ?>
				<?php if(!empty(session('business.allow_currency_change_sales'))): ?>
				<div><b><?php echo app('translator')->get('sale.total_payable_base_currency'); ?> <span class="badge bg-secondary" style="font-size:11px;"><?php echo e(session('currency')['symbol'] ?? '', false); ?></span>: </b>
					<span id="total_payable_base_currency"></span>
				</div>
				<?php endif; ?>
		    	<div><b><?php echo app('translator')->get('sale.total_payable'); ?>: <span class="selected_currency_symbol badge bg-info" style="font-size:11px;"></span></b>
					<input type="hidden" name="final_total" id="final_total_input">
					<span id="total_payable">0</span>
				</div>
		    </div>
			<?php echo $__env->renderComponent(); ?>
			<?php if(!empty($common_settings['is_enabled_export']) && $transaction->type != 'sales_order'): ?>
				<?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('lang_v1.export')]); ?>
					<div class="col-md-12 mb-12">
		                <div class="form-check">
		                    <input type="checkbox" name="is_export" class="form-check-input" id="is_export" <?php if(!empty($transaction->is_export)): ?> checked <?php endif; ?>>
		                    <label class="form-check-label" for="is_export"><?php echo app('translator')->get('lang_v1.is_export'); ?></label>
		                </div>
		            </div>
			        <?php
	                	$i = 1;
		            ?>
		            <?php for($i; $i <= 6 ; $i++): ?>
		                <div class="col-md-4 export_div" <?php if(empty($transaction->is_export)): ?> style="display: none;" <?php endif; ?>>
		                    <div class="form-group mb-2">
		                        <?php echo Form::label('export_custom_field_'.$i, __('lang_v1.export_custom_field'.$i).':'); ?>

		                        <?php echo Form::text('export_custom_fields_info['.'export_custom_field_'.$i.']', !empty($transaction->export_custom_fields_info['export_custom_field_'.$i]) ? $transaction->export_custom_fields_info['export_custom_field_'.$i] : null, ['class' => 'form-control','placeholder' => __('lang_v1.export_custom_field'.$i), 'id' => 'export_custom_field_'.$i]); ?>

		                    </div>
		                </div>
		            <?php endfor; ?>
				<?php echo $__env->renderComponent(); ?>
			<?php endif; ?>
		</div>
	</div>
	<?php
		$is_enabled_download_pdf = config('constants.enable_download_pdf');
		$is_enabled_download_pdf = false;
	?>
	<?php if($is_enabled_download_pdf && $transaction->type != 'sales_order'): ?>
		<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sell.payments')): ?>
			<?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('purchase.add_payment')]); ?>
				<div class="well row">
					<div class="col-md-6">
						<div class="form-group mb-2">
							<?php echo Form::label("prefer_payment_method" , __('lang_v1.prefer_payment_method') . ':'); ?>

							<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.this_will_be_shown_in_pdf') . '"></i>';
                }
            ?>
							<div class="input-group">
								<span class="input-group-text">
									<i class="fas fa-money-bill-alt"></i>
								</span>
								<?php echo Form::select("prefer_payment_method", $payment_types, $transaction->prefer_payment_method, ['class' => 'form-control','style' => 'width:80%;']); ?>

							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group mb-2">
							<?php echo Form::label("prefer_payment_account" , __('lang_v1.prefer_payment_account') . ':'); ?>

							<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.this_will_be_shown_in_pdf') . '"></i>';
                }
            ?>
							<div class="input-group">
								<span class="input-group-text">
									<i class="fas fa-money-bill-alt"></i>
								</span>
								<?php echo Form::select("prefer_payment_account", $accounts, $transaction->prefer_payment_account, ['class' => 'form-control','style' => 'width:80%;']); ?>

							</div>
						</div>
					</div>
				</div>
			<?php echo $__env->renderComponent(); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if($transaction->type == 'sell' && $transaction->type != 'sales_order' && !in_array($transaction->status, ['quotation', 'draft'])): ?>
	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sell.payments')): ?>
		<?php $__env->startComponent('components.widget', ['class' => 'box-success '.($transaction->exchange_rate != 1 ? 'hide' : '').'', 'title' => __('purchase.add_payment')]); ?>
		<div class="row">
			<div class="payment_row" id="payment_rows_div">
			<?php $__currentLoopData = $payment_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>			
				<?php if($payment_line['is_return'] == 1): ?>
					<?php
						$change_return = $payment_line;
					?>

					<?php continue; ?>
				<?php endif; ?>

				<?php if(!empty($payment_line['id'])): ?>
        			<?php echo Form::hidden("payment[$loop->index][payment_id]", $payment_line['id']); ?>

        		<?php endif; ?>
				<?php if(empty($payment_line['id'])): ?>

				<div class="row">
					<div class="col-md-12 mb-12">
						<strong><?php echo app('translator')->get('lang_v1.advance_balance'); ?>:</strong> <span id="advance_balance_text"></span>
						<?php echo Form::hidden('advance_balance', null, [
							'id' => 'advance_balance',
							'data-error-msg' => __('lang_v1.required_advance_balance_not_available'),
						]); ?>

					</div>
				</div>
				<?php endif; ?>

				<?php echo $__env->make('sale_pos.partials.payment_row_form', ['row_index' => $loop->index, 'show_date' => true, 'payment_line' => $payment_line, 'show_denomination' => true, 'transaction_type' => 'sell', 'transaction' => $transaction], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>

			<div class="col-md-12">
        		<hr>
        		<strong>
        			<?php echo app('translator')->get('lang_v1.change_return'); ?>:
        		</strong>
        		<br/>
        		<span class="lead text-bold change_return_span">0</span>
        		<?php echo Form::hidden("change_return", $change_return['amount'], ['class' => 'form-control change_return input_number', 'required', 'id' => "change_return"]); ?>

        		<!-- <span class="lead text-bold total_quantity">0</span> -->
        		<?php if(!empty($change_return['id'])): ?>
            		<input type="hidden" name="change_return_id" 
            		value="<?php echo e($change_return['id'], false); ?>">
            	<?php endif; ?>
			</div>
		</div>
		<div class="row <?php if($change_return['amount'] == 0): ?> hide <?php endif; ?> payment_row" id="change_return_payment_data">
			<div class="col-md-4">
				<div class="form-group mb-2">
					<?php echo Form::label("change_return_method" , __('lang_v1.change_return_payment_method') . ':*'); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fas fa-money-bill-alt"></i>
						</span>
						<?php
							$_payment_method = empty($change_return['method']) && array_key_exists('cash', $payment_types) ? 'cash' : $change_return['method'];

							$_payment_types = $payment_types;
							if(isset($_payment_types['advance'])) {
								unset($_payment_types['advance']);
							}
						?>
						<?php echo Form::select("payment[change_return][method]", $_payment_types, $_payment_method, ['class' => 'form-control col-md-12 payment_types_dropdown', 'id' => 'change_return_method', 'style' => 'width:80%;']); ?>

					</div>
				</div>
			</div>
			<?php if(!empty($accounts)): ?>
			<div class="col-md-4">
				<div class="form-group mb-2">
					<?php echo Form::label("change_return_account" , __('lang_v1.change_return_payment_account') . ':'); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fas fa-money-bill-alt"></i>
						</span>
						<?php echo Form::select("payment[change_return][account_id]", $accounts, !empty($change_return['account_id']) ? $change_return['account_id'] : '' , ['class' => 'form-control select2', 'id' => 'change_return_account', 'style' => 'width:80%;']); ?>

					</div>
				</div>
			</div>
			<?php endif; ?>
			<?php echo $__env->make('sale_pos.partials.payment_type_details', ['payment_line' => $change_return, 'row_index' => 'change_return', 'transaction' => $transaction], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-12">
				<div class="float-end"><strong><?php echo app('translator')->get('lang_v1.balance'); ?>:</strong> <span
						class="balance_due">0.00</span></div>
			</div>
		</div>
		<?php echo $__env->renderComponent(); ?>
	<?php endif; ?>
	<?php endif; ?>
	<?php if(in_array('booking', session('business.enabled_modules', [])) && (auth()->user()->can('crud_all_bookings') || auth()->user()->can('crud_own_bookings'))): ?>
	<div class="row mt-2 mb-2">
		<div class="col-sm-12">
			<div class="form-check">
				<input type="checkbox" name="add_booking_reminder" class="form-check-input" id="add_booking_reminder" value="1">
				<label class="form-check-label" for="add_booking_reminder">
					<i class="fa fa-calendar"></i> <?php echo app('translator')->get('restaurant.add_booking_reminder'); ?>
				</label>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php echo Form::hidden('is_save_and_print', 0, ['id' => 'is_save_and_print']); ?>

	<?php if(in_array('subscription', $enabled_modules)): ?>
		<?php echo $__env->make('sale_pos.partials.recurring_invoice_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>
	<?php echo Form::close(); ?>

</section>
<?php if(!$is_offline): ?>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	<?php echo $__env->make('contact.create', ['quick_add' => true, 'customer' => true, 'from' => 'sell'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php endif; ?>
<!-- /.content -->
<div class="modal fade register_details_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>
<!-- quick product modal -->

<?php echo $__env->make('sale_pos.partials.bulk_edit_product_tax_modal', ['selected_tax' => $business_details->default_sales_tax], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('sale_pos.partials.bulk_edit_product_discount_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('sale_pos.partials.configure_search_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="loading" style="display: none">
	
	<div class="loading-animation"></div>
</div>
<?php echo $__env->make('sell.partials.sell_keyboard_shortcuts_help_modal', ['is_sell_return_page' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('js/pos.js?v=' . $asset_v), false); ?>"></script>
	<script src="<?php echo e(asset('js/product.js?v=' . $asset_v), false); ?>"></script>
	<script src="<?php echo e(asset('js/opening_stock.js?v=' . $asset_v), false); ?>"></script>
	<!-- Call restaurant module if defined -->
    <?php if(in_array('tables' ,$enabled_modules) || in_array('modifiers' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules)): ?>
    	<script src="<?php echo e(asset('js/restaurant.js?v=' . $asset_v), false); ?>"></script>
    <?php endif; ?>
    <?php echo $__env->make('sell.partials.sell_keyboard_shortcuts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script type="text/javascript">
    	$(document).ready( function(){
    		$('#shipping_documents').fileinput({
		        showUpload: false,
		        showPreview: false,
		        browseLabel: '',
		        removeLabel: '',
		        cancelLabel: '',
		    });
			$('#customer_id').focus();

		    $('#is_export').on('change', function () {
	            if ($(this).is(':checked')) {
	                $('div.export_div').show();
	            } else {
	                $('div.export_div').hide();
	            }
	        });

	        $('#status').change(function(){
    			if ($(this).val() == 'final') {
    				$('#payment_rows_div').removeClass('hide');
    			} else {
    				$('#payment_rows_div').addClass('hide');
    			}
    		});
    		$('.paid_on').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });
			$('.clearance_date').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });
			
			$(document).on('click', 'button#add-payment-row', function() {
                var row_index = $('#payment_row_index').val();
                var location_id = $('input#location_id').val();

                $.ajax({
                    method: 'POST',
                    url: '/sells/pos/get_payment_row',
                    data: { row_index: row_index, location_id: location_id, show_date : true },
                    dataType: 'html',
                    success: function(result) {
                        if (result) {
                            var appended = $('#payment_rows_div #payment_rows_div').append(result);

                            var total_payable = __read_number($('input#final_total_input'));
                            var total_paying = __read_number($('input#total_paying_input'));
                            var b_due = total_payable - total_paying;
                            $(appended).find('.paid_on').datetimepicker({
                                format: moment_date_format + ' ' + moment_time_format,
                                ignoreReadonly: true,
                            });
                            $(appended)
                                .find('input.payment-amount')
                                .focus();
                            $(appended)
                                .find('input.payment-amount')
                                .last()
                                .val(__currency_trans_from_en(b_due, false))
                                .change()
                                .select();
                            __select2($(appended).find('.select2'));
                            $(appended).find('#method_' + row_index).change();
                            
                            $('#payment_row_index').val(parseInt(row_index) + 1);
                        }
                    },
                });
            });

            $(document).on('click', '.remove_payment_row', function() {
                swal({
                    title: LANG.sure,
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then(willDelete => {
                    if (willDelete) {
                        $(this)
                            .closest('.payment_row')
                            .remove();
                        calculate_balance_due();
                    }
                });
            });

			$(document).on('change', '#invoice_no', function() {
				if($(this).val() != ''){
					$.ajax({
						method: 'POST',
						url: '/transactions/check-invoice-no',
						data: {
							id : $('#edit_transaction_id').val(),
							invoice_no : $('#invoice_no').val(),
							type : 'sell',
						},
						dataType: 'json',
						success: async function(result) {
							if(result){
								$('#invoice_no').addClass('error');
								$('#invoice_no_error').removeClass('hide');
							}else{
								$('#invoice_no').removeClass('error');
								$('#invoice_no_error').addClass('hide');
							}
						}
					});
				}else{
					$('#invoice_no').removeClass('error');
					$('#invoice_no_error').addClass('hide');
				}
            });

            // Currency dropdown change handler
            $('#location_currency_id_select').on('change', function() {
                var selected = $(this).find(':selected');
                var loc_currency_id = selected.data('id');
                var exchangeRate = selected.data('multiplier');
                var code = selected.data('code');
                var symbol = selected.data('symbol');
                var thousand = selected.data('thousand_separator');
                var decimal = selected.data('decimal_separator');

                if(exchangeRate == undefined){
                    $('#exchange_rate_hidden').val(1);
                    $('#exchange_rate_hidden').attr('readonly', true);
                    $('#p_code').val($('#__code').val());
                    $('#p_symbol').val($('#__symbol').val());
                    $('#p_thousand').val($('#__thousand').val());
                    $('#p_decimal').val($('#__decimal').val());
                    $('#location_currency_id').val('');

                    __p_currency_code = $('#__code').val();
                    __p_currency_symbol = $('#__symbol').val();
                    __p_currency_thousand_separator = $('#__thousand').val();
                    __p_currency_decimal_separator = $('#__decimal').val();

                    $('.selected_currency_symbol').text($('#__symbol').val() || '');
                } else {
                    $('#exchange_rate_hidden').val(exchangeRate);
                    $('#exchange_rate_hidden').attr('readonly', false);
                    $('#p_code').val(code);
                    $('#p_symbol').val(symbol);
                    $('#p_thousand').val(thousand);
                    $('#p_decimal').val(decimal);
                    $('#location_currency_id').val(loc_currency_id);

                    __p_currency_symbol = symbol;
                    __p_currency_thousand_separator = thousand;
                    __p_currency_decimal_separator = decimal;

                    $('.selected_currency_symbol').text(symbol);
                }
                pos_total_row();
            });

            // Refresh exchange rate button handler
            $(document).on('click', '.refresh_exchange_rate_btn', function(e) {
                e.preventDefault();
                var btn = $(this);
                var currencyCode = '';

                // Try to get from dropdown first, then fallback to hidden field
                var selected = $('#location_currency_id_select').find(':selected');
                if (selected.val() && selected.data('code')) {
                    currencyCode = selected.data('code');
                } else {
                    currencyCode = $('#location_currency_id').data('currency-code') || '';
                }

                if (!currencyCode) {
                    toastr.warning('No foreign currency set for this transaction.');
                    return;
                }

                btn.prop('disabled', true).find('i').addClass('fa-spin');

                $.ajax({
                    url: '/get-exchange-rate',
                    type: 'GET',
                    dataType: 'json',
                    data: { currency_code: currencyCode },
                    success: function(response) {
                        if (response.success) {
                            $('#exchange_rate_hidden').val(response.multiplier);
                            pos_total_row();
                            toastr.success(currencyCode + ' rate updated: ' + response.multiplier);
                        } else {
                            toastr.error(response.msg || 'Failed to fetch exchange rate.');
                        }
                    },
                    error: function() {
                        toastr.error('Could not fetch exchange rate. Check your connection.');
                    },
                    complete: function() {
                        btn.prop('disabled', false).find('i').removeClass('fa-spin');
                    }
                });
            });

            // Show currency symbol in headings/totals on page load for edit
            var editCurrencySymbol = $('#location_currency_id').data('currency-symbol') || '';
            if (editCurrencySymbol) {
                $('.selected_currency_symbol').text(editCurrencySymbol);
            } else {
                // Show default business currency symbol
                var defaultSymbol = $('#__symbol').val() || '';
                if (defaultSymbol) {
                    $('.selected_currency_symbol').text(defaultSymbol);
                }
            }

    	});
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>