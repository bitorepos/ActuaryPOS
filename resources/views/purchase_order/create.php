
<?php $__env->startSection('title', __('lang_v1.add_purchase_order')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.add_purchase_order'); ?> <i class="fa fa-keyboard-o hover-q text-muted" aria-hidden="true" data-container="body" data-bs-toggle="popover" data-placement="bottom" data-content="<?php echo $__env->make('purchase.partials.keyboard_shortcuts_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>" data-html="true" data-trigger="hover" data-original-title="" title=""></i></h1>
</section>

<!-- Main content -->
<section class="content">

	<!-- Page level currency setting -->
	<input type="hidden" id="p_code" value="<?php echo e($currency_details->code, false); ?>">
	<input type="hidden" id="p_symbol" value="<?php echo e($currency_details->symbol, false); ?>">
	<input type="hidden" id="p_thousand" value="<?php echo e($currency_details->thousand_separator, false); ?>">
	<input type="hidden" id="p_decimal" value="<?php echo e($currency_details->decimal_separator, false); ?>">
	<input type="hidden" id="page_type" value="purchase">
	
	<?php echo $__env->make('layouts.partials.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<?php echo Form::open(['url' => action([\App\Http\Controllers\PurchaseOrderController::class, 'store']), 'method' => 'post', 'id' => 'add_purchase_form', 'files' => true ]); ?>


	<?php if(count($business_locations) == 1): ?>
		<?php
		$default_location = current(array_keys($business_locations->toArray()));
		$search_disable = false;
		?>
	<?php else: ?>
		<?php
		$default_location = array_key_first($business_locations->toArray());
		$user_settings = json_decode(auth()->user()->user_settings,true);
		if(isset($user_settings['default_location']) && !empty($user_settings['default_location'])){
			$default_location = $user_settings['default_location'];
		}else{
			$default_location = current(array_keys($business_locations->toArray()));
		}
		$search_disable = true;
		?>
	<?php endif; ?>
	<div class="row">
		<div class="col-sm-3">
			<div class="mb-3">
				<div class="input-group">
					<span class="input-group-text">
                        <i class="fa fa-map-marker"></i>
                    </span>
					
					<?php echo Form::select('location_id', $business_locations, $default_location, ['class' => 'form-control select2', 'id' => 'location_id', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;'], $bl_attributes); ?>

					<span class="input-group-text">
                        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.purchase_location') . '"></i>';
                }
            ?>
                    </span>
				</div>
			</div>
		</div>
	</div>

	<?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
		<input type="hidden" id="is_purchase_order">
		<input type="hidden" id="purchase_id">
		<input type="hidden" id="purchase_auto_save" value="<?php echo e(!empty($common_settings['enable_purchase_auto_save']) ? 1 : 0, false); ?>">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group mb-2">
					<?php echo Form::label('supplier_id', __('purchase.supplier') . ':*'); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-user"></i>
						</span>
						<?php echo Form::select('contact_id', [], null, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'supplier_id', 'style' => 'width: 70%;']); ?>

						
							<button type="button" class="btn btn-default bg-white btn-flat add_new_supplier" data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
						
					</div>
				</div>
				<strong>
					<?php echo app('translator')->get('business.address'); ?>:
				</strong>
				<div id="supplier_address_div"></div>
				<div class="form-group mb-2">
					<div class="form-check">
						<label class="form-check-label">
							<input type="checkbox" class="form-check-input" name="is_inclusive" id="is_inclusive_tax" value="1" <?php echo
								!empty($common_settings['is_tax_inclusive_purchase']) ? 'Checked' : '' ?>>
							Is Tax Inclusive?
						</label>
					</div>
				</div>
			</div>
			<div class="col-md-9">
			<div class="row">
			<div class="col-sm-6 col-md-4">
				<div class="form-group mb-2">
					<?php echo Form::label('ref_no', __('purchase.ref_no').':'); ?>

					<?php echo Form::text('ref_no', null, ['class' => 'form-control']); ?>

				</div>
			</div>
			<div class="col-sm-6 col-md-4">
				<div class="form-group">
					<?php echo Form::label('ref_no_no', __('purchase.ref_no_2') . ':'); ?>

					<?php echo Form::text('ref_no_2', null, ['class' => 'form-control']); ?>

				</div>
			</div>
			<div class="col-sm-6 col-md-4">
				<div class="form-group mb-2">
					<?php echo Form::label('transaction_date', __('lang_v1.order_date') . ':*'); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-calendar"></i>
						</span>
						<?php echo Form::text('transaction_date', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required']); ?>

					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4">
				<div class="form-group mb-2">
					<?php echo Form::label('delivery_date', __('lang_v1.delivery_date') . ':'); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-calendar"></i>
						</span>
						<?php echo Form::text('delivery_date', null, ['class' => 'form-control']); ?>

					</div>
				</div>
			</div>
			<!-- Currency Exchange Rate -->
			<div class="col-sm-6 col-md-4 <?php if(!$currency_details->purchase_in_diff_currency): ?> hide <?php endif; ?>">
				<div class="form-group mb-2">
					<?php echo Form::label('exchange_rate', __('purchase.p_exchange_rate') . ':*'); ?>

					<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.currency_exchange_factor') . '"></i>';
                }
            ?>
					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-info"></i>
						</span>
						<?php echo Form::number('exchange_rate', $currency_details->p_exchange_rate, ['class' => 'form-control', 'required', 'step' => 0.001]); ?>

					</div>
					<span class="help-block text-danger">
						<?php echo app('translator')->get('purchase.diff_purchase_currency_help', ['currency' => $currency_details->name]); ?>
					</span>
				</div>
			</div>

			<div class="col-sm-6 col-md-4">
				<div class="form-group mb-2">
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
						<?php echo Form::number('pay_term_number', null, ['class' => 'form-control', 'placeholder' => __('contact.pay_term'), 'style' => 'width: 50%; border-top-right-radius: 0; border-bottom-right-radius: 0;']); ?>


						<?php echo Form::select('pay_term_type', 
							['months' => __('lang_v1.months'), 
								'days' => __('lang_v1.days')], 
								null, 
							['class' => 'form-control','placeholder' => __('messages.please_select'), 'id' => 'pay_term_type', 'style' => 'width: 50%; border-top-left-radius: 0; border-bottom-left-radius: 0;']); ?>

					</div>
				</div>
			</div>
			<?php if(!empty($common_settings['show_invoice_layout_purchase'])): ?>
				<div class="col-sm-6 col-md-4">
					<div class="form-group mb-2">
						<?php echo Form::label('invoice_layout_id', __('invoice.invoice_layouts') . ':'); ?>

						<?php echo Form::select('invoice_layout_id', $invoice_layouts, $bl_attributes[$default_location]['data-purchase_layout_id'], [
							'class' => 'form-control select2', 'id' => 'purchase_order_invoice_layout_id']); ?>

					</div>
				</div>
			<?php endif; ?>
			<?php if(in_array('upload_documents', $enabled_modules)): ?>
			<?php if(empty($common_settings['hide_attach_document_purchase'])): ?>
				<div class="col-sm-6 col-md-4">
					<div class="form-group mb-2">
						<?php echo Form::label('document', __('purchase.attach_document') . ':'); ?>

						<i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
						<?php echo Form::file('document', ['id' => 'upload_document', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

					</div>
				</div>
			<?php endif; ?>
			<?php endif; ?>
			</div>
		</div>
		</div>
		<?php if(!empty($common_settings['enable_purchase_requisition'])): ?>
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group mb-2">
					<?php echo Form::label('purchase_requisition_ids', __('lang_v1.purchase_requisition').':'); ?>

					<?php echo Form::select('purchase_requisition_ids[]', [], null, ['class' => 'form-control select2', 'multiple', 'id' => 'purchase_requisition_ids']); ?>

				</div>
			</div>
		</div>
		<?php endif; ?>
	<?php echo $__env->renderComponent(); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group mb-2">
					<div class="input-group">
						
							<button type="button" class="btn btn-secondary  btn-flat" id="open_products_search_modal" title="<?php echo e(__('lang_v1.products_search'), false); ?>"><i class="fas fa-search"></i></button>
						
						<?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'disabled' => $search_disable]); ?>

					</div>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group mb-2">
					<button tabindex="-1" type="button" class="btn btn-light btn-modal"data-href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'quickAdd']), false); ?>" 
            	data-container=".quick_add_product_modal"><i class="fa fa-plus"></i> <?php echo app('translator')->get( 'product.add_new_product' ); ?> </button>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group mb-2">
					<div class="input-group">
						<span class="input-group-text">
							<i class="fas fa-layer-group"></i>
						</span>
						<?php echo Form::select('po_stock_level', [
							'low' => __('product.alert_quantity_low'),
							'medium' => __('product.alert_quantity_medium'),
							'high' => __('product.alert_quantity_high'),
							'max' => __('product.alert_quantity_max'),
						], null, ['class' => 'form-select', 'id' => 'po_stock_level', 'placeholder' => __('lang_v1.stock_level')]); ?>

						<button type="button" class="btn btn-primary" id="load_po_stock_level_products" data-select-message="<?php echo app('translator')->get('lang_v1.select_supplier_location_and_stock_level'); ?>">
							<i class="fas fa-download"></i> <?php echo app('translator')->get('lang_v1.load_products'); ?>
						</button>
					</div>
				</div>
			</div>
		</div>
		<?php
		$hide_discount = '';
		if (empty($common_settings['enable_inline_discount_purchase'])) {
			$hide_discount = 'hide';
		}
		$hide_total_discount = '';
		if (empty($common_settings['enable_inline_total_discount_purchase'])) {
			$hide_total_discount = 'hide';
		}
		$hide_discount2 = '';
		if (empty($common_settings['enable_inline_discount2_purchase'])) {
			$hide_discount2 = 'hide';
		}
		$hide_total_discount2 = '';
		if (empty($common_settings['enable_inline_total_discount2_purchase'])) {
			$hide_total_discount2 = 'hide';
		}
		$hide_discounted_cost = '';
		if (empty($common_settings['enable_inline_discount_purchase']) && empty($common_settings['enable_inline_total_discount_purchase']) && empty($common_settings['enable_inline_total_discount2_purchase'])) {
			$hide_discounted_cost = 'hide';
		}
		$hide_tax = '';
		if (empty($common_settings['enable_inline_tax_purchase']) || $taxes->isEmpty()) {
			$hide_tax = 'hide';
		}    
		$hide_brand = '';
		if (empty($user_settings['purchase_show_brand_column'])) {
			$hide_brand = 'hide';
		}
		$hide_category = '';
		if (empty($user_settings['purchase_show_category_column'])) {
			$hide_category = 'hide';
		}
		$hide_scheme_qty = '';
		if (empty($common_settings['enable_scheme_quantity_purchase'])) {
			$hide_scheme_qty = 'hide';
		}
		$hide_sr_imei = 'hide';
		if (!empty($common_settings['enable_serial_number'])) {
			$hide_sr_imei = '';
		}
		?>
		<div class="row">
			<div class="col-sm-12">
				<div class="table-responsive sell_product_div" style="max-height: 450px; overflow-y: auto;">
					<table class="table table-condensed table-bordered table-th-skin table-striped" id="purchase_entry_table">
						<thead>
							<tr>
								<th class="text-nowrap" style="width:1%; min-width:30px">#</th>
								<th class="text-nowrap" style="width:1%; min-width:50px">SKU</th>
								<th class="text-nowrap" style="width:100%">Product</th>
								<th class="text-nowrap <?php echo e($hide_brand, false); ?>">Brand</th>
								<th class="text-nowrap <?php echo e($hide_category, false); ?>">Category</th>
								<th class="text-nowrap <?php echo e($hide_sr_imei, false); ?>">Serial / IMEI</th>
								<th class="text-nowrap" style="width:auto">Order Qty</th>
								<th class="text-nowrap <?php echo e($hide_scheme_qty, false); ?>" style="width:auto">Scheme <br> Qty</th>
								<th class="text-nowrap text-end">Unit Cost<br><span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
								<th class="text-nowrap <?php echo e($hide_discount, false); ?>" id="purchase_discount_heading">Unit <br> Discount</th>
								<th class="text-nowrap <?php echo e($hide_total_discount, false); ?>" id="purchase_total_discount_heading">Total <br> Discount</th>
								<th class="text-nowrap <?php echo e($hide_discount2, false); ?>">Discount 2</th>
								<th class="text-nowrap <?php echo e($hide_total_discount2, false); ?>">Total <br> Discount 2</th>
								<th class="text-nowrap text-end <?php echo e($hide_discounted_cost, false); ?>">Discounted <br> Cost <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
								<th class="text-nowrap text-end <?php echo e($hide_tax, false); ?>">Subtotal<br><span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
								<th class="text-nowrap <?php echo e($hide_tax, false); ?>" id="purchase_tax_heading">Tax</th>
								<th class="text-nowrap text-end <?php echo e($hide_tax, false); ?>">Tax Amount<br>Line Total</th>
								<th class="text-nowrap text-end <?php echo e($hide_tax, false); ?>">Cost Inc. <br> Tax <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
								<th class="text-nowrap text-end">Line Total<br><span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
								<th class="text-nowrap hide">
									GP %
								</th>
								<th class="text-nowrap" style="width:1%; min-width:30px"><i class="fa fa-trash" aria-hidden="true"></i></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
				<hr/>
				

			<div class="col-sm-12 row">
            <hr />
            <div class="col-md-3">
                <table class="float-end col-md-12">
                    <tr>
                        <th class="col-md-7 text-right"><?php echo app('translator')->get('lang_v1.total_quantity'); ?>:</th>
                        <td class="col-md-5 text-left">
                            <span id="total_quantity" class="display_currency" data-currency_symbol="false"></span>
                        </td>
                    </tr>
                    <tr>
                        <th class="col-md-7 text-right"><?php echo app('translator')->get('lang_v1.profit_margin'); ?>:</th>
                        <td class="col-md-5 text-left">
                            <span id="total_profit_margin" class="display_currency"></span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-3">
                <table class="float-end col-md-12">
                    <tr class="">
                        <th class="col-md-7 text-right">Total Before Unit Discount:</th>
                        <td class="col-md-5 text-left">
                            <span id="total_st_before_discount" class="display_currency"></span>
                            <input type="hidden" id="st_before_discount" value=0>
                        </td>
                    </tr>

                    <tr class="">
                        <th class="col-md-7 text-right">Unit Discount:</th>
                        <td class="col-md-5 text-left">
                            <span id="total_discount" class="display_currency"></span>
                        </td>
                    </tr>
                    <tr>
                        <th class="col-md-7 text-right">Total After Unit Discount:</th>
                        <td class="col-md-5 text-left">
                            <span id="total_st_after_discount" class="display_currency"></span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-3">
                <table class="float-end col-md-12">
                    <tr class="">
                        <th class="col-md-7 text-right"><?php echo app('translator')->get('purchase.total_before_tax'); ?>:</th>
                        <td class="col-md-5 text-left">
                            <span id="total_st_before_tax" class="display_currency"></span>
                            <input type="hidden" id="st_before_tax_input" value=0>
                        </td>
                    </tr>

                    <tr>
                        <th class="col-md-7 text-right">Total Tax:</th>
                        <td class="col-md-5 text-left">
                            <span id="total_tax" class="display_currency" data-currency_symbol="false"></span>
                        </td>
                    </tr>
                    <tr>
                        <th class="col-md-7 text-right">Total After Tax:</th>
                        <td class="col-md-5 text-left">
                            <span id="total_st_after_tax" class="display_currency"></span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-3">
                <table class="float-end col-md-12">
                    <tr>
                        <th class="col-md-7 text-right"><?php echo app('translator')->get('purchase.net_total_amount'); ?>:</th>
                        <td class="col-md-5 text-left">
                            <span id="total_subtotal" class="display_currency"></span>
                            <!-- This is total before purchase tax-->
                            <input type="hidden" id="total_subtotal_input" value=0 name="total_before_tax">
                        </td>
                    </tr>
                </table>
            </div>
        </div>

				<input type="hidden" id="row_count" value="0">
			</div>
		</div>
	<?php echo $__env->renderComponent(); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group mb-2">
	            <?php echo Form::label('shipping_details', __('sale.shipping_details')); ?>

	            <?php echo Form::textarea('shipping_details',null, ['class' => 'form-control','placeholder' => __('sale.shipping_details') ,'rows' => '3', 'cols'=>'30']); ?>

	        </div>
		</div>
		<div class="col-md-4">
			<div class="form-group mb-2">
	            <?php echo Form::label('shipping_address', __('lang_v1.shipping_address')); ?>

	            <?php echo Form::textarea('shipping_address',null, ['class' => 'form-control','placeholder' => __('lang_v1.shipping_address') ,'rows' => '3', 'cols'=>'30']); ?>

	        </div>
		</div>
		<div class="col-md-4">
			<div class="form-group mb-2">
				<?php echo Form::label('shipping_charges', __('sale.shipping_charges')); ?>

				<div class="input-group">
				<span class="input-group-text">
				<i class="fa fa-info"></i>
				</span>
				<?php echo Form::text('shipping_charges',number_format(0.00, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']),['class'=>'form-control input_number','placeholder'=> __('sale.shipping_charges')]); ?>

				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="col-md-4">
			<div class="form-group mb-2">
	            <?php echo Form::label('shipping_status', __('lang_v1.shipping_status')); ?>

	            <?php echo Form::select('shipping_status',$shipping_statuses, null, ['class' => 'form-select','placeholder' => __('messages.please_select')]); ?>

	        </div>
		</div>
		<div class="col-md-4">
	        <div class="form-group mb-2">
	            <?php echo Form::label('delivered_to', __('lang_v1.delivered_to') . ':' ); ?>

	            <?php echo Form::text('delivered_to', null, ['class' => 'form-control','placeholder' => __('lang_v1.delivered_to')]); ?>

	        </div>
	    </div>
	    <?php
	    	$custom_labels = json_decode(session('business.custom_labels'), true);
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

		            <?php echo Form::text('shipping_custom_field_1', null, ['class' => 'form-control','placeholder' => $shipping_custom_label_1, 'required' => $is_shipping_custom_field_1_required]); ?>

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

		            <?php echo Form::text('shipping_custom_field_2', null, ['class' => 'form-control','placeholder' => $shipping_custom_label_2, 'required' => $is_shipping_custom_field_2_required]); ?>

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

		            <?php echo Form::text('shipping_custom_field_3', null, ['class' => 'form-control','placeholder' => $shipping_custom_label_3, 'required' => $is_shipping_custom_field_3_required]); ?>

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

		            <?php echo Form::text('shipping_custom_field_4', null, ['class' => 'form-control','placeholder' => $shipping_custom_label_4, 'required' => $is_shipping_custom_field_4_required]); ?>

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

		            <?php echo Form::text('shipping_custom_field_5', null, ['class' => 'form-control','placeholder' => $shipping_custom_label_5, 'required' => $is_shipping_custom_field_5_required]); ?>

		        </div>
		    </div>
        <?php endif; ?>
        <?php if(in_array('upload_documents', $enabled_modules)): ?>
        <div class="col-md-4">
            <div class="form-group mb-2">
                <?php echo Form::label('shipping_documents', __('lang_v1.shipping_documents') . ':'); ?>

                <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                <?php echo Form::file('shipping_documents[]', ['id' => 'shipping_documents', 'multiple', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

            </div>
        </div>
        <?php endif; ?>
	</div>
	<div class="row">
			<div class="col-md-12 text-center">
				<button type="button" class="btn btn-primary btn-sm" id="toggle_additional_expense"> <i class="fas fa-plus"></i> <?php echo app('translator')->get('lang_v1.add_additional_expenses'); ?> <i class="fas fa-chevron-down"></i></button>
			</div>
			<div class="col-md-8 col-md-offset-4" id="additional_expenses_div" style="display: none;">
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
								<?php echo Form::text('additional_expense_key_1', null, ['class' => 'form-control']); ?>

							</td>
							<td>
								<?php echo Form::text('additional_expense_value_1', 0, ['class' => 'form-control input_number', 'id' => 'additional_expense_value_1']); ?>

							</td>
						</tr>
						<tr>
							<td>
								<?php echo Form::text('additional_expense_key_2', null, ['class' => 'form-control']); ?>

							</td>
							<td>
								<?php echo Form::text('additional_expense_value_2', 0, ['class' => 'form-control input_number', 'id' => 'additional_expense_value_2']); ?>

							</td>
						</tr>
						<tr>
							<td>
								<?php echo Form::text('additional_expense_key_3', null, ['class' => 'form-control']); ?>

							</td>
							<td>
								<?php echo Form::text('additional_expense_value_3', 0, ['class' => 'form-control input_number', 'id' => 'additional_expense_value_3']); ?>

							</td>
						</tr>
						<tr>
							<td>
								<?php echo Form::text('additional_expense_key_4', null, ['class' => 'form-control']); ?>

							</td>
							<td>
								<?php echo Form::text('additional_expense_value_4', 0, ['class' => 'form-control input_number', 'id' => 'additional_expense_value_4']); ?>

							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-8">
	    <?php echo Form::hidden('final_total', 0 , ['id' => 'grand_total_hidden']); ?>

		<b><?php echo app('translator')->get('lang_v1.order_total'); ?>: </b><span id="grand_total" class="display_currency" data-currency_symbol='true'>0</span>
		</div>
	</div>
	<?php echo $__env->renderComponent(); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
		<div class="row">
			<div class="col-sm-12">
			<table class="table">
				<tr class="hide">
					<td class="col-md-3">
						<div class="form-group mb-2">
							<?php echo Form::label('discount_type', __( 'purchase.discount_type' ) . ':'); ?>

							<?php echo Form::select('discount_type', [ '' => __('lang_v1.none'), 'fixed' => __( 'lang_v1.fixed' ), 'percentage' => __( 'lang_v1.percentage' )], '', ['class' => 'form-control select2']); ?>

						</div>
					</td>
					<td class="col-md-3">
						<div class="form-group mb-2">
						<?php echo Form::label('discount_amount', __( 'purchase.discount_amount' ) . ':'); ?>

						<?php echo Form::text('discount_amount', 0, ['class' => 'form-control input_number', 'required']); ?>

						</div>
					</td>
					<td class="col-md-3">
						&nbsp;
					</td>
					<td class="col-md-3">
						<b><?php echo app('translator')->get( 'purchase.discount' ); ?>:</b>(-) 
						<span id="discount_calculated_amount" class="display_currency">0</span>
					</td>
				</tr>
				<tr class="hide">
					<td>
						<div class="form-group mb-2">
						<?php echo Form::label('tax_id', __('purchase.purchase_tax') . ':'); ?>

						<select name="tax_id" id="tax_id" class="form-control select2" placeholder="'Please Select'">
							<option value="" data-tax_amount="0" data-tax_type="fixed" selected><?php echo app('translator')->get('lang_v1.none'); ?></option>
							<?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($tax->id, false); ?>" data-tax_amount="<?php echo e($tax->amount, false); ?>" data-tax_type="<?php echo e($tax->calculation_type, false); ?>"><?php echo e($tax->name, false); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
						<?php echo Form::hidden('tax_amount', 0, ['id' => 'tax_amount']); ?>

						</div>
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>
						<b><?php echo app('translator')->get( 'purchase.purchase_tax' ); ?>:</b>(+) 
						<span id="tax_calculated_amount" class="display_currency">0</span>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="form-group mb-2">
							<?php echo Form::label('additional_notes',__('purchase.additional_notes')); ?>

							<a href="javascript:void(0)" class="toggle-note">
								<i class="fa fa-plus-circle text-success"></i>
							</a>
							<div class="note-wrapper" style="display:none;">
								<?php echo Form::textarea('additional_notes', null, ['class' => 'form-control', 'rows' => 3]); ?>

							</div>
						</div>
					</td>
				</tr>

			</table>
			</div>
		</div>
	<?php echo $__env->renderComponent(); ?>
	<input type="hidden" id="save_and_print" name="save_and_print" value="">

<?php echo Form::close(); ?>

</section>
<!-- quick product modal -->

<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	<?php echo $__env->make('contact.create', ['quick_add' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php echo $__env->make('purchase.partials.bulk_edit_product_discount_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('purchase.partials.bulk_edit_product_tax_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('js/purchase.js?v=' . $asset_v . '.' . filemtime(public_path('js/purchase.js'))), false); ?>"></script>
	<script src="<?php echo e(asset('js/product.js?v=' . $asset_v), false); ?>"></script>
	<script type="text/javascript">
		$(document).ready( function(){
      		__page_leave_confirmation('#add_purchase_form');
      		$('.paid_on').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });

            $('#shipping_documents').fileinput({
		        showUpload: false,
		        showPreview: false,
		        browseLabel: '',
		        removeLabel: '',
		        cancelLabel: '',
		    });

			if($('#location_id').length){
				$('#location_id').change();
			}
    	});
	</script>
	<?php echo $__env->make('purchase.partials.keyboard_shortcuts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>