<style>
	.bootstrap-datetimepicker-widget {
		z-index: 9999 !important;
	}
	/* Product Set grouping styles (similar to package rows) */
	tr.product_set_header {
		background-color: #e0f0ff !important;
	}
	tr.product_set_header td {
		padding: 5px 8px !important;
		border-bottom: 1px solid #b8daff !important;
	}
	tr.product_set_item {
		background-color: #f5f9ff !important;
	}
	tr.product_set_item td:first-child {
		border-left: 3px solid #0d6efd !important;
	}
</style>
<div class="row">
	<div class="col-md-4">
		<div class="" style="width: 100% !important">
			<div class="input-group">
				<span class="input-group-text" style="padding: 0px !important">
					<i class="fa fa-user"></i>
				</span>
				<input type="hidden" id="default_customer_id" value="<?php echo e($transaction->contact->id, false); ?>" >
				<input type="hidden" id="default_customer_name" value="<?php echo e($transaction->contact->name, false); ?>" >
				<input type="hidden" id="default_customer_balance" value="<?php echo e($transaction->contact->balance, false); ?>" >
				<input type="hidden" id="default_customer_inclusive" value="<?php echo e(!empty($transaction->is_inclusive) ? 1 : 0, false); ?>" >
				<?php echo Form::select('contact_id', 
					[], null, ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required', 'style' => 'width: 100%;', ($transaction->payment_lines->count() == 0) ? '' : 'disabled']); ?>

				
				<?php if($is_offline): ?>
				<span class="input-group-text" style="padding: 0px !important">
					<button type="button" class="btn btn-xs" id="offline_sync_customers"><i class="fa fa-sync text-primary"></i></button>
				</span>
				<input class="hidden" id="is_offline" value="<?php echo e($is_offline, false); ?>">
				<?php else: ?>
				<span class="input-group-text" style="padding: 0px !important">
					<button type="button" class="btn btn-xs add_new_customer" data-name=""  <?php if(!auth()->user()->can('customer.create')): ?> disabled <?php endif; ?> <?php echo e(($transaction->payment_lines->count() == 0) ? '' : 'disabled', false); ?>><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
				</span>
				<?php endif; ?>
			</div>
			<small class="text-danger <?php if(empty($customer_due)): ?> hide <?php endif; ?> contact_due_text"><strong><?php echo app('translator')->get('account.customer_due'); ?>:</strong> <span><?php echo e($customer_due ?? '', false); ?></span></small>
		</div>
	</div>
	<?php if(!empty($pos_settings['enable_product_search_sku_pos'])): ?>
		<div class="col-md-3 col-sm-3">
			<div class="mb-3">
				<div class="input-group">
					<div class="input-group-text" style="padding: 0px !important">
						<button type="button" class="btn btn-xs"  id="open_products_search_modal" title="<?php echo e(__('lang_v1.configure_product_search'), false); ?>"><i class="fas fa-search"></i></button>
					</div>
					<?php echo Form::text('search_product_sku', null, ['class' => 'form-control', 'id' => 'search_product_sku', 'placeholder' => __('lang_v1.search_product_sku_placeholder'),
					'disabled' => is_null($default_location)? true : false,
					'autofocus' => is_null($default_location)? false : true,
					]); ?>

				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if(empty($pos_settings['disable_product_search_pos'])): ?>
		<div class="<?php if(!empty($pos_settings['enable_product_search_sku_pos'])): ?> col-md-5 col-sm-5 <?php else: ?> col-md-8 col-sm-8 <?php endif; ?>">
		<div class="mb-3">
			<div class="input-group">
				
				<div class="input-group-text" style="padding: 0px !important">
					<button type="button" class="btn btn-xs btn-flat" id="open_products_search_modal" title="<?php echo e(__('lang_v1.products_search'), false); ?>"><i class="fas fa-search"></i></button>
				</div>
				<?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'),
				'autofocus' => true,
				]); ?>

				<span class="input-group-text" style="padding: 0px !important">

					<!-- Show button for weighing scale modal -->
					<?php if(isset($pos_settings['enable_weighing_scale']) && $pos_settings['enable_weighing_scale'] == 1): ?>
						<button type="button" class="btn btn-xs btn-flat" id="weighing_scale_btn" data-bs-toggle="modal" data-bs-target="#weighing_scale_modal" 
						title="<?php echo app('translator')->get('lang_v1.weighing_scale'); ?>"><i class="fa fa-digital-tachograph text-primary fa-lg"></i></button>
					<?php endif; ?>

					<button type="button" class="btn btn-xs btn-flat pos_add_quick_product" data-href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'quickAdd']), false); ?>" data-container=".quick_add_product_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
				</span>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>
<div class="row">
	<?php if(!empty($pos_settings['show_invoice_layout'])): ?>
	<div class="col-md-4">
		<div class="mb-3">
		<?php echo Form::select('invoice_layout_id', 
					$invoice_layouts, $transaction->location->invoice_layout_id, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.select_invoice_layout'), 'id' => 'invoice_layout_id']); ?>

		</div>
	</div>
	<?php endif; ?>
	<?php echo $__env->make('transaction.partials.back_order_field', ['transaction' => $transaction, 'field_class' => 'col-md-4 col-sm-6'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<input type="hidden" name="pay_term_number" id="pay_term_number" value="<?php echo e($transaction->pay_term_number, false); ?>">
	<input type="hidden" name="pay_term_type" id="pay_term_type" value="<?php echo e($transaction->pay_term_type, false); ?>">
	
	<?php if(!empty($commission_agent)): ?>
		<?php
			$is_commission_agent_required = !empty($pos_settings['is_commission_agent_required']);
		?>
		<div class="col-sm-4">
			<div class="mb-3">
			<?php echo Form::select('commission_agent', $commission_agent, $transaction->commission_agent, 
			array_merge(
			[
				'id' => 'commission_agent',
				'required' => $is_commission_agent_required, 'style' => 'width: 100%;'
			],
			!empty($user_settings['commission_agent_readonly']) 
				? ['class' => 'form-control', 'style' => 'pointer-events: none;background-color:#F5F5F5;']
				: ['class' => 'form-control select2',]
			)); ?>

			</div>
		</div>
		<?php endif; ?>
	<?php if(!empty($user_settings['enable_transaction_date'])): ?>
		<div class="col-md-4 col-sm-6">
			<div class="mb-3">
				<div class="input-group">
					<span class="input-group-text">
						<i class="fa fa-calendar"></i>
					</span>
					<?php echo Form::text('transaction_date', \Carbon::createFromTimestamp(strtotime($transaction->transaction_date))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required', 'id' => 'transaction_date']); ?>

				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if(config('constants.enable_sell_in_diff_currency') == true): ?>
		<div class="col-md-4 col-sm-6">
			<div class="mb-3">
				<div class="input-group">
					<span class="input-group-text">
						<i class="fas fa-exchange-alt"></i>
					</span>
					<?php echo Form::text('exchange_rate', number_format($transaction->exchange_rate, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm input_number', 'placeholder' => __('lang_v1.currency_exchange_rate'), 'id' => 'exchange_rate']); ?>

				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if(!empty($transaction->selling_price_group_id)): ?>
		<div class="col-md-4 col-sm-6 <?php if(!empty($pos_settings['disable_group_price_pos'])): ?> hide <?php endif; ?>">
			<div class="mb-3">
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
			<div class="mb-3">
				<div class="input-group">
					<span class="input-group-text">
						<i class="fas fa-external-link-square-alt text-primary service_modal_btn"></i>
					</span>
					<?php echo Form::text('types_of_service_text', $transaction->types_of_service->name, ['class' => 'form-control', 'readonly']); ?>


					<?php echo Form::hidden('types_of_service_id', $transaction->types_of_service_id, ['id' => 'types_of_service_id']); ?>

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
	<?php if($transaction->status == 'draft' && !empty($pos_settings['show_invoice_scheme'])): ?>
		<div class="col-sm-3">
			<div class="mb-3">
				<?php echo Form::select('invoice_scheme_id', $invoice_schemes, $default_invoice_schemes->id, ['class' => 'form-control', 'placeholder' => __('lang_v1.select_invoice_scheme')]); ?>

			</div>
		</div>
	<?php endif; ?>
	<!-- Restaurant module table/waiter selection moved to POS navbar -->
	<div class="col-md-4 col-sm-6 hide">
		<div class="form-group">
			<div class="checkbox">
				<label>
					<input type="checkbox" clas="form-control" name="is_inclusive" id="is_inclusive_tax"
						<?php echo !empty($transaction->is_inclusive) ? 'Checked' : '' ?>>
					Is Tax Inclusive?
				</label>
			</div>
		</div>
	</div>
    <?php if(in_array('subscription', $enabled_modules)): ?>
		<div class="col-md-4 col-sm-6">
			<label class="form-check-label">
<?php echo Form::checkbox('is_recurring', 1, $transaction->is_recurring, ['class' => 'form-check-input', 'id' => 'is_recurring']); ?> <?php echo app('translator')->get('lang_v1.subscribe'); ?>?
            </label><button type="button" data-bs-toggle="modal" data-bs-target="#recurringInvoiceModal" class="btn btn-link"><i class="fa fa-external-link-square-alt"></i></button><?php
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
<!-- include module fields -->
<?php if(!empty($pos_module_data)): ?>
    <?php $__currentLoopData = $pos_module_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!empty($value['view_path'])): ?>
            <?php if ($__env->exists($value['view_path'], ['view_data' => $value['view_data']])) echo $__env->make($value['view_path'], ['view_data' => $value['view_data']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<div class="row">
	<?php
		$psh = 80;
		if(!empty($pos_settings[$default_location->id]['hide_product_suggestion']) && $pos_settings[$default_location->id]['hide_product_suggestion'] == 2){
			$psh = !empty($pos_settings[$default_location->id]['pos_product_section_height']) ? $pos_settings[$default_location->id]['pos_product_section_height'] : 30;
		}
	?>
	<div class="col-sm-12 pos_product_div2 <?php if($pos_settings[$default_location->id]['hide_product_suggestion'] != 2): ?> pos_product_div_height <?php endif; ?>" style="height:<?php echo e($psh, false); ?>vh;max-height:<?php echo e($psh, false); ?>vh;min-height:<?php echo e($psh, false); ?>vh;">
		<input type="hidden" name="sell_price_tax" id="sell_price_tax" value="<?php echo e($business_details->sell_price_tax, false); ?>">

		<!-- Keeps count of product rows -->
		<input type="hidden" id="product_row_count" 
			value="<?php echo e(count($sell_details), false); ?>">
		<?php
			$hide_tax = '';
			if( session()->get('business.enable_inline_tax') == 0){
				$hide_tax = 'hide';
			}
			$hide_sr_no = '';
			if (empty(session()->get('business.common_settings.enable_serial_number'))) {
				$hide_sr_no = 'hide';
			}  
			$edit_subtotal = auth()->user()->can('edit_product_subtotal_from_pos_screen') ? true : false;
		?>
		<div class="table-responsive">
		<table class="table table-condensed table-th-skin table-bordered table-striped" id="pos_table">
			<thead style="position: sticky; top: 0; z-index: 1002;">
				<tr>
					<td style="width:3%">#</td>
					<th class="tex-center <?php if(!empty($pos_settings['inline_service_staff']) || !empty($pos_settings['enable_discount_column']) || !empty($pos_settings['enable_inline_tax_pos'])): ?> col-md-3 <?php else: ?> col-md-4 <?php endif; ?>">	
						<?php echo app('translator')->get('sale.product'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_sell_product_column') . '"></i>';
                }
            ?>
					</th>
					<th class="text-center col-md-1  <?php echo e($hide_sr_no, false); ?>">
						<?php echo app('translator')->get('product.sr_imei_no'); ?>
					</th>
					<th class="text-center <?php if(!empty($pos_settings['enable_numeric_keypad_on_input'])): ?> col-md-1 <?php else: ?> col-md-2 <?php endif; ?>">
						<?php echo app('translator')->get('sale.qty'); ?>
					</th>
					<?php if(!empty($pos_settings['enable_scheme_quantity_pos'])): ?>
					<th class="text-center col-md-1">
						<?php echo app('translator')->get('sale.foc'); ?>
					</th>
					<?php endif; ?>
					<?php if(!empty($pos_settings['inline_service_staff'])): ?>
						<th class="text-center col-md-1">
							<?php echo app('translator')->get('restaurant.service_staff'); ?>
						</th>
					<?php endif; ?>
					<th class="text-center <?php if(!empty($pos_settings['enable_discount_column'])): ?> col-md-1 <?php else: ?> col-md-2 <?php endif; ?>">
						<?php echo app('translator')->get('sale.unit_price'); ?>
					</th>
					<?php if(!empty($pos_settings['enable_discount_column'])): ?>
						<th class="text-center col-md-1" <?php if(auth()->user()->can('edit_product_discount_from_pos_screen')): ?> id="pos_discount_heading" <?php else: ?> id="approval_pos_discount_heading" <?php endif; ?>>
							Disc. <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.bulk_edit_product_discount') . '"></i>';
                }
            ?>
						</th>
						<th class="text-center col-md-1 <?php if(empty($pos_settings['enable_after_discount_column'])): ?> hide <?php endif; ?>">
							Price After Disc.
						</th>
					<?php endif; ?>
					<?php if(!empty($pos_settings['enable_inline_tax_pos']) && $taxes['tax_rates']->count() > 1): ?>
						<th class="text-center col-md-1" 
						<?php if(auth()->user()->can('edit_product_tax_from_pos_screen')): ?>  id="pos_tax_heading" <?php endif; ?>>
							<?php echo app('translator')->get('receipt.tax'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.bulk_edit_product_tax') . '"></i>';
                }
            ?>
						</th>
					<?php endif; ?>
					<?php if(!empty($pos_settings['enable_inclusive_tax_column']) && $taxes['tax_rates']->count() > 1): ?>
						<th class="text-center col-md-1" >
							<?php echo app('translator')->get('sale.price_inc_tax'); ?>
						</th>
					<?php endif; ?>
					<th class="text-center <?php if($edit_subtotal): ?> col-md-1 <?php else: ?> col-md-1 <?php endif; ?>">
						<?php echo app('translator')->get('sale.subtotal'); ?>
					</th>
					<th class="text-center" style="width:3%"><i class="fas fa-times" aria-hidden="true"></i></th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $sell_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php echo $__env->make('sale_pos.product_row', 
						['product' => $sell_line, 
						'row_count' => $loop->index, 
						'tax_dropdown' => $taxes, 
						'sub_units' => !empty($sell_line->unit_details) ? $sell_line->unit_details : [],
						'action' => 'edit',
						'is_tax_inclusive' => !empty($transaction->is_inclusive),
						'is_draft' => $transaction->status == 'draft'
					], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
		</div>
	</div>
</div>
<script>
// Insert product set header rows and styling for existing sell lines on edit
$(function(){
    var setGroups = {};
    $('table#pos_table tbody tr.product_row').each(function(){
        var setId = $(this).find('.product_set_group_id').val();
        if(setId){
            if(!setGroups[setId]){
                setGroups[setId] = [];
            }
            setGroups[setId].push($(this));
        }
    });
    $.each(setGroups, function(setId, rows){
        var setName = rows[0].find('input[name$="[product_set_name]"]').val() || '';
        var colCount = $('table#pos_table thead th:visible').length;
        var headerHtml = '<tr class="product_set_header set_group_' + setId + '">' +
            '<td></td>' +
            '<td colspan="' + (colCount - 2) + '" style="font-weight:bold;color:#0d6efd;padding:6px 8px;">' +
            '<i class="fas fa-box-open"></i> ' + $('<div/>').text(setName).html() + ' <span class="text-muted fw-normal" style="font-size:12px;">#' + setId + '</span>' +
            '</td>' +
            '<td class="text-center" style="width:3%"><i class="fa fa-times text-danger pos_remove_set cursor-pointer" data-set-group="' + setId + '"></i></td>' +
            '</tr>';
        rows[0].before(headerHtml);
        rows.forEach(function(row){
            row.addClass('product_set_item set_group_' + setId);
        });
    });
    if(Object.keys(setGroups).length > 0){
        product_set_order_count = Math.max.apply(null, Object.keys(setGroups).map(Number));
    }
});
</script>
