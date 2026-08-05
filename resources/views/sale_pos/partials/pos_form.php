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
<div class="row pt-10">
	<div class="col-md-4 col-sm-4">
		<div class="form-group mb-1">
		<?php if($default_customer == 'CO0001'): ?>
			<div class="input-group">
				<span class="input-group-text">
					<i class="fa fa-user"></i>
				</span>
				<input type="hidden" id="default_customer_id" value="<?php echo e($walk_in_customer['id'] ?? '', false); ?>" >
				<input type="hidden" id="default_customer_name" value="<?php echo e($walk_in_customer['name'] ?? '', false); ?>" >
				<input type="hidden" id="default_customer_not_ask_prompt" value="<?php echo e($walk_in_customer['not_ask_prompt'] ?? '', false); ?>" >
				<input type="hidden" id="default_customer_balance" value="<?php echo e($walk_in_customer['balance'] ?? '', false); ?>" >
				<input type="hidden" id="default_customer_address" value="<?php echo e($walk_in_customer['shipping_address'] ?? '', false); ?>" >
				<input type="hidden" id="default_customer_inclusive" value="<?php echo e($walk_in_customer['is_inclusive'] ?? 0, false); ?>" >
				<?php if(!empty($walk_in_customer['price_calculation_type']) && $walk_in_customer['price_calculation_type'] == 'selling_price_group'): ?>
					<input type="hidden" id="default_selling_price_group" value="<?php echo e($walk_in_customer['selling_price_group_id'] ?? '', false); ?>" >
				<?php endif; ?>
				<?php echo Form::select('contact_id', 
					[], null, ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required']); ?>

				
				<?php if($is_offline): ?>
				<button type="button" class="btn btn-light" id="offline_sync_customers"><i class="fa fa-sync text-primary"></i></button>
				<button type="button" class="btn btn-light add_new_customer" data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
				<input type="hidden" id="is_offline" value="<?php echo e($is_offline, false); ?>">
				<?php else: ?>
				<button type="button" class="btn btn-light add_new_customer" data-name="" <?php if(!auth()->user()->can('customer.create')): ?> disabled <?php endif; ?>><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
				<?php endif; ?>
			</div>
		<?php elseif($default_customer == '0'): ?>
			<div class="input-group">
				<span class="input-group-text">
					<i class="fa fa-user"></i>
				</span>
				<input type="hidden" id="default_customer_id" value="" >
				<input type="hidden" id="default_customer_name" value="" >
				<input type="hidden" id="default_customer_balance" value="" >
				<input type="hidden" id="default_customer_address" value="" >
				<input type="hidden" id="default_customer_not_ask_prompt" value="0" >
				<input type="hidden" id="default_customer_inclusive" value="0" >
				<?php   
				  $none = ['None', '0'];    
				?>
				<?php echo Form::select('contact_id', 
					$none, 0, ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required']); ?>

				<?php if($is_offline): ?>
				<button type="button" class="btn btn-light" id="offline_sync_customers"><i class="fa fa-sync text-primary"></i></button>
				<button type="button" class="btn btn-light add_new_customer" data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
				<input type="hidden" id="is_offline" value="<?php echo e($is_offline, false); ?>">
				<?php else: ?>
				<button type="button" class="btn btn-light add_new_customer" data-name="" <?php if(!auth()->user()->can('customer.create')): ?> disabled <?php endif; ?>><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
				<?php endif; ?>
			</div>
		<?php else: ?>
			<div class="input-group">
				<span class="input-group-text">
					<i class="fa fa-user"></i>
				</span>
				<input type="hidden" id="default_customer_id" value="<?php echo e($default_customer_details['id'] ?? '', false); ?>" >
				<?php if($default_customer_details['entity_type'] === 'business'): ?>
                    <input type="hidden" id="default_customer_name" value="<?php echo e($default_customer_details['supplier_business_name'], false); ?>">
                <?php else: ?>
                    <input type="hidden" id="default_customer_name" value="<?php echo e($default_customer_details['name'], false); ?>">
                <?php endif; ?>
				<input type="hidden" id="default_customer_balance" value="<?php echo e($default_customer_details['balance'] ?? '', false); ?>" >
				<input type="hidden" id="default_customer_address" value="<?php echo e($default_customer_details['shipping_address'] ?? '', false); ?>" >
				<input type="hidden" id="default_customer_not_ask_prompt" value="<?php echo e($default_customer_details['not_ask_prompt'] ?? '', false); ?>" >
				<input type="hidden" id="default_customer_inclusive" value="<?php echo e($default_customer_details['is_inclusive'] ?? 0, false); ?>" >
				
				<?php if(!empty($default_customer_details['price_calculation_type']) && $default_customer_details['price_calculation_type'] == 'selling_price_group'): ?>
					<input type="hidden" id="default_selling_price_group" value="<?php echo e($default_customer_details['selling_price_group_id'] ?? '', false); ?>" >
				<?php endif; ?>
				<?php echo Form::select('contact_id', 
					[], null, ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required']); ?>

				<?php if($is_offline): ?>
				<button type="button" class="btn btn-light" id="offline_sync_customers"><i class="fa fa-sync text-primary"></i></button>
				<button type="button" class="btn btn-light add_new_customer" data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
				<input type="hidden" id="is_offline" value="<?php echo e($is_offline, false); ?>">
				<?php else: ?>
				<button type="button" class="btn btn-light add_new_customer" data-name="" <?php if(!auth()->user()->can('customer.create')): ?> disabled <?php endif; ?>><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
				<?php endif; ?>
			</div>
		<?php endif; ?>
			<small class="text-danger hide contact_due_text"><strong><?php echo app('translator')->get('account.customer_due'); ?>:</strong> <span></span></small>
		</div>
		<?php if(!empty($pos_settings[$default_location->id]['require_customer_always'])): ?>
		<input type="hidden" id="require_customer_always">
		<input type="hidden" id="require_customer_id" name="contact_id" value="">
		<?php echo $__env->make('sale_pos.partials.select_customer_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	
		<?php endif; ?>
	</div>
	<?php if(!empty($pos_settings['enable_product_search_sku_pos'])): ?>
		<div class="col-md-3 col-sm-3">
			<div class="form-group mb-1">
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
			<div class="form-group mb-1">
				<div class="input-group">
					<div class="input-group-text" style="padding: 0px !important">
						<button type="button" class="btn" id="open_products_search_modal" title="<?php echo e(__('lang_v1.products_search'), false); ?>"><i class="fas fa-search"></i></button>
					</div>
					<?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'),
					'disabled' => is_null($default_location)? true : false,
					'autofocus' => is_null($default_location)? false : true,
					]); ?>

					<div class="input-group-text" style="padding: 0px !important">

						<!-- Show button for weighing scale modal -->
						<?php if(isset($pos_settings['enable_weighing_scale']) && $pos_settings['enable_weighing_scale'] == 1): ?>
							<button type="button" class="btn" id="weighing_scale_btn" data-bs-toggle="modal" data-bs-target="#weighing_scale_modal" 
							title="<?php echo app('translator')->get('lang_v1.weighing_scale'); ?>"><i class="fa fa-digital-tachograph text-primary fa-lg"></i></button>
						<?php endif; ?>

						<?php if($is_offline): ?>
							<button type="button" class="btn" id="offline_sync_products"><i class="fa fa-sync text-primary"></i></button>
						<?php else: ?>
							<button type="button" class="btn pos_add_quick_product" data-href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'quickAdd']), false); ?>" data-container=".quick_add_product_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	
	<input type="hidden" name="pay_term_number" id="pay_term_number" value="<?php echo e($walk_in_customer['pay_term_number'] ?? '', false); ?>">
	<input type="hidden" name="pay_term_type" id="pay_term_type" value="<?php echo e($walk_in_customer['pay_term_type'] ?? '', false); ?>">

	<?php if(!empty($user_settings['enable_transaction_date'])): ?>
		<div class="col-md-4 col-sm-6">
			<div class="form-group mb-1">
				<div class="input-group">
					<span class="input-group-text">
						<i class="fa fa-calendar"></i>
					</span>
					<?php echo Form::text('transaction_date', $default_datetime, ['class' => 'form-control', 'readonly', 'required', 'id' => 'transaction_date']); ?>

				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if(config('constants.enable_sell_in_diff_currency') == true && !empty($business_details->allow_currency_change_pos)): ?>
		<div class="col-md-4 col-sm-6">
			<div class="form-group mb-1">
				<div class="input-group">
					<span class="input-group-text">
						<i class="fas fa-exchange-alt"></i>
					</span>
					<?php echo Form::text('exchange_rate', config('constants.currency_exchange_rate'), ['class' => 'form-control input-sm input_number', 'placeholder' => __('lang_v1.currency_exchange_rate'), 'id' => 'exchange_rate']); ?>

				</div>
			</div>
		</div>
	<?php elseif(config('constants.enable_sell_in_diff_currency') == true): ?>
		<!-- Currency change disabled on POS screen -->
		<input type="hidden" name="exchange_rate" id="exchange_rate" value="<?php echo e(config('constants.currency_exchange_rate'), false); ?>">
	<?php endif; ?>
	<?php if(!empty($price_groups) && count($price_groups) > 1): ?>
		<div class="col-md-4 col-sm-6 <?php if(!empty($pos_settings['disable_group_price_pos'])): ?> hide <?php endif; ?>">
			<div class="mb-3">
				<div class="input-group">
					<span class="input-group-text">
						<i class="fas fa-money-bill-alt"></i>
					</span>
					<?php
						reset($price_groups);
						$selected_price_group = !empty($default_price_group_id) && array_key_exists($default_price_group_id, $price_groups) ? $default_price_group_id : null;
					?>
					<?php echo Form::hidden('hidden_price_group', key($price_groups), ['id' => 'hidden_price_group']); ?>

					<?php echo Form::select('price_group', $price_groups, $selected_price_group, ['class' => 'form-select select2', 'id' => 'price_group', 'style' => 'width:70%']); ?>

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
	<?php else: ?>
		<?php
			reset($price_groups);
		?>
		<?php echo Form::hidden('price_group', key($price_groups), ['id' => 'price_group']); ?>

	<?php endif; ?>
	<?php if(!empty($default_price_group_id)): ?>
		<?php echo Form::hidden('default_price_group', $default_price_group_id, ['id' => 'default_price_group']); ?>

	<?php endif; ?>

	<?php if(in_array('types_of_service', $enabled_modules) && !empty($types_of_service)): ?>
		<div class="col-md-4 col-sm-6">
			<div class="form-group mb-1">
				<div class="input-group">
					<span class="input-group-text">
						<i class="fa fa-external-link-square-alt text-primary service_modal_btn"></i>
					</span>
					<?php echo Form::select('types_of_service_id', $types_of_service, null, ['class' => 'form-control', 'id' => 'types_of_service_id', 'style' => 'width: 80%;', 'placeholder' => __('lang_v1.select_types_of_service')]); ?>


					<?php echo Form::hidden('types_of_service_price_group', null, ['id' => 'types_of_service_price_group']); ?>


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
				<small><p class="help-block hide" id="price_group_text"><?php echo app('translator')->get('lang_v1.price_group'); ?>: <span></span></p></small>
			</div>
		</div>
		<div class="modal fade types_of_service_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
	<?php endif; ?>

	<?php if(!empty($pos_settings['show_invoice_scheme'])): ?>
		<?php
			$invoice_scheme_id = $default_invoice_schemes->id;
			if(!empty($default_location->invoice_scheme_id)) {
				$invoice_scheme_id = $default_location->invoice_scheme_id;
			}
		?>
		<div class="col-md-4 col-sm-4">
			<div class="form-group mb-1">
				<?php echo Form::select('invoice_scheme_id', $invoice_schemes, $invoice_scheme_id, 
					['class' => 'form-select', 'placeholder' => __('lang_v1.select_invoice_scheme'), 
					'id' => 'invoice_scheme_id']); ?>

			</div>
		</div>
	<?php endif; ?>
	<?php if(!empty($pos_settings['show_invoice_layout'])): ?>
		<div class="col-md-4 col-sm-4">
			<div class="form-group mb-1">
			<?php echo Form::select('invoice_layout_id', 
						$invoice_layouts, $default_location->invoice_layout_id, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.select_invoice_layout'), 'id' => 'invoice_layout_id']); ?>

			</div>
		</div>
	<?php endif; ?>
	<?php echo $__env->make('transaction.partials.back_order_field', ['field_class' => 'col-md-4 col-sm-6'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="col-md-4 col-sm-6 hide">
		<div class="form-group">
			<div class="checkbox">
				<label>
					<input type="checkbox" clas="form-control" name="is_inclusive" id="is_inclusive_tax">
						
					Is Tax Inclusive?
				</label>
			</div>
		</div>
	</div>
	<?php if(in_array('subscription', $enabled_modules)): ?>
		<div class="col-md-4 col-sm-6">
			<label class="form-check-label">
<?php echo Form::checkbox('is_recurring', 1, false, ['class' => 'form-check-input', 'id' => 'is_recurring']); ?> <?php echo app('translator')->get('lang_v1.subscribe'); ?>?
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
	<!-- Restaurant module table/waiter selection moved to POS navbar -->
	 <?php if(in_array('tables', $enabled_modules) || in_array('service_staff', $enabled_modules)): ?>
		<span id="restaurant_module_span" class="d-inline-flex align-items-center hide"
			<?php if(!empty($transaction->id)): ?> data-transaction_id="<?php echo e($transaction->id, false); ?>" <?php endif; ?>>
		</span>
	<?php endif; ?>

	<?php if(!empty($commission_agent)): ?>
		<?php
			$is_commission_agent_required = !empty($pos_settings['is_commission_agent_required']);
		?>
		<div class="col-md-4 col-sm-4">
			<div class="form-group mb-1">
			<?php echo Form::select('commission_agent', $commission_agent, null, 
			array_merge(
			[
				'id' => 'commission_agent',
				'required' => $is_commission_agent_required, 'style' => 'width: 80%;',
				'placeholder' => __('lang_v1.select_staff_agent')
			],
			!empty($user_settings['commission_agent_readonly']) 
				? ['class' => 'form-control', 'style' => 'pointer-events: none;background-color:#F5F5F5;']
				: ['class' => 'form-control select2',]
			)); ?>

			</div>
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
		$psh = 75;
		if(!empty($pos_settings[$default_location->id]['hide_product_suggestion']) && $pos_settings[$default_location->id]['hide_product_suggestion'] == 2){
			$psh = !empty($pos_settings[$default_location->id]['pos_product_section_height']) ? $pos_settings[$default_location->id]['pos_product_section_height'] : 30;
		}
	?>
	<div class="col-sm-12 pos_product_div2 <?php if($pos_settings[$default_location->id]['hide_product_suggestion'] != 2): ?> pos_product_div_height <?php endif; ?>" style="height:<?php echo e($psh, false); ?>vh;max-height:<?php echo e($psh, false); ?>vh;min-height:<?php echo e($psh, false); ?>vh;margin-bottom: 0px;">
		<input type="hidden" name="sell_price_tax" id="sell_price_tax" value="<?php echo e($business_details->sell_price_tax, false); ?>">

		<!-- Keeps count of product rows -->
		<input type="hidden" id="product_row_count" 
			value="0">
		<?php
			$product_name_td_width = 15;
			$hide_tax = '';
			if(empty($pos_settings['enable_inline_tax_pos']) || $taxes['tax_rates']->count() <= 1){
				$hide_tax = 'hide';
				$product_name_td_width += 8;
			}
			$hide_sr_no = '';
			if (empty(session()->get('business.common_settings.enable_serial_number'))) {
				$hide_sr_no = 'hide';
				$product_name_td_width += 5;
			}   
			$edit_subtotal = auth()->user()->can('edit_product_subtotal_from_pos_screen') ? true : false;
		?>
		<div class="table-responsive">
		<table class="table table-condensed table-th-skin table-bordered table-striped mb-0" id="pos_table" style="table-layout: fixed; width: 100%; word-wrap: break-word;z-index: 1000">
			<thead style="position: sticky; top: 0; z-index: 1002;">
				<tr>
					<th class="text-center" style="width:3%" id="pos_row_num_heading">#</th>
					<th class="text-center" style="width: <?php echo e($product_name_td_width, false); ?>%" id="pos_product_heading">	
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
					<th class="text-center <?php echo e($hide_sr_no, false); ?>" style="width:7%">
						<?php echo app('translator')->get('product.sr_imei_no'); ?>
					</th>
					<th class="text-center" style="width:5%" id="pos_quantity_heading">
						<?php echo app('translator')->get('sale.qty'); ?>
					</th>
					<?php if(!empty($pos_settings['enable_scheme_quantity_pos'])): ?>
					<th class="text-center" style="width:6%">
						<?php echo app('translator')->get('sale.foc'); ?>
					</th>
					<?php endif; ?>
					<?php if(!empty($pos_settings['inline_service_staff'])): ?>
						<th class="text-center" style="width:8%">
							<?php echo app('translator')->get('restaurant.service_staff'); ?>
						</th>
					<?php endif; ?>
					<th class="text-center" style="width:7%" id="pos_unit_price_heading">
						<?php echo app('translator')->get('sale.unit_price'); ?>
					</th>
					<?php if(!empty($pos_settings['enable_discount_column'])): ?>
						<th class="text-center" style="width:9%" <?php if(auth()->user()->can('edit_product_discount_from_pos_screen')): ?> id="pos_discount_heading" <?php else: ?> id="approval_pos_discount_heading" <?php endif; ?>>
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
						<th class="text-center <?php if(empty($pos_settings['enable_after_discount_column'])): ?> hide <?php endif; ?>" style="width:7%">
							Price After Disc.
						</th>
					<?php endif; ?>
					
					<th class="text-center <?php echo e($hide_tax, false); ?>" style="width:9%"
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
					
					
					
						<th class="text-center <?php echo e($hide_tax, false); ?> <?php if(empty($pos_settings['enable_inclusive_tax_column']) || $taxes['tax_rates']->count() <= 1): ?> hide <?php endif; ?>" style="width:7%">
							<?php echo app('translator')->get('sale.price_inc_tax'); ?>
						</th>
					
					<th class="text-center" style="width:7%" id="pos_subtotal_heading">
						<?php echo app('translator')->get('sale.subtotal'); ?>
					</th>
					<th class="text-center" style="width:3%" id="pos_remove_heading"><i class="fas fa-times" aria-hidden="true"></i></th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
		</div>
	</div>
</div>
