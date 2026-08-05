<?php
	$common_settings = isset($common_settings) && ! empty($common_settings)
		? $common_settings
		: (request()->session()->get('business.common_settings') ?? []);
	
	$multiplier = 1;
	$foc_multiplier = 1;
	$action = !empty($action) ? $action : '';
?>

<?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php if(!empty($product->sub_unit_id) && $product->sub_unit_id == $key): ?>
		<?php
			$multiplier = $value['multiplier'];
		?>
	<?php endif; ?>
	<?php if(!empty($product->foc_sub_unit_id) && $product->foc_sub_unit_id == $key): ?>
		<?php
			$foc_multiplier = $value['multiplier'];
		?>
	<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php
	
?>

<tr class="product_row" id="product_row_<?php echo e($row_count, false); ?>" data-row_index="<?php echo e($row_count, false); ?>" <?php if(!empty($so_line)): ?> data-so_id="<?php echo e($so_line->transaction_id, false); ?>" <?php endif; ?>>
	<td style="width:3%"><span class="sr_number"></span></td>
	<td class="product_name_td">
		<div class="width-90 float-start">
		<?php if(!empty($so_line)): ?>
			<input type="hidden" 
			name="products[<?php echo e($row_count, false); ?>][so_line_id]" 
			value="<?php echo e($so_line->id, false); ?>">
		<?php endif; ?>
		<?php
			if($pos_settings['hide_product_suggestion'] == 2){
				$product_name = $product->product_name . ' ' . $product->sub_sku ;
			}else{
				$product_name = $product->product_name . '<br/>' . $product->sub_sku ;
			}
			if(!empty($product->brand)){ $product_name .= ' ' . $product->brand ;}
		?>
		
		<?php if( ($edit_price || $edit_discount) && empty($is_direct_sell) && !empty($common_settings['enable_product_description_on_pos'])): ?>
		<div title="<?php echo app('translator')->get('lang_v1.pos_edit_product_price_help'); ?>">
		<span class="text-link text-info cursor-pointer" data-bs-toggle="modal" data-bs-target="#row_edit_product_price_modal_<?php echo e($row_count, false); ?>">
			<?php echo $product_name; ?> -
			&nbsp;<i class="fa fa-info-circle"></i>
		</span>
		</div>
		<?php else: ?>
			<?php echo $product_name; ?>

		<?php endif; ?>
		<input type="hidden" class="product_name" value="<?php echo e($product_name, false); ?>">
		<input type="hidden" class="enable_sr_no" value="<?php echo e($product->enable_sr_no, false); ?>">
		<input type="hidden" class="enable_booking_hourly" value="<?php echo e($product->enable_booking_hourly, false); ?>">
		<input type="hidden" class="inline_edit_price_on_sale" value="<?php echo e(!empty($product->edit_price_on_sale) ? 1 : 0, false); ?>">
		<input type="hidden" name="pct_code" class="pct_code" value="<?php echo e(!empty($product->pct_code) ? $product->pct_code : (!empty(session('business.common_settings.send_zero_if_pct_code_missing')) ? 0 : ''), false); ?>">
		<input type="hidden" class="current_stock" value="<?php echo e((!empty($product->qty_available)) ? $product->qty_available : 0, false); ?>">	
		<input type="hidden" class="row_stock_sku" value="<?php echo e($product->sub_sku, false); ?>">
		<input type="hidden" class="product_type" name="products[<?php echo e($row_count, false); ?>][product_type]" value="<?php echo e($product->product_type, false); ?>">
		<input type="hidden" class="printer_id" name="products[<?php echo e($row_count, false); ?>][printer_id]" value="<?php echo e($product->printer_id, false); ?>">
		<input type="hidden" class="printer_path" name="products[<?php echo e($row_count, false); ?>][printer_path]" value="<?php echo e($product->printer_path, false); ?>">
		<input type="hidden" id="product_prompt" value="<?php echo e($product->prompt, false); ?>">
		<?php

			$hide_tax = 'hide';
	        if(!empty($pos_settings['enable_inline_tax_pos']) && $tax_dropdown['tax_rates']->count() > 1){
	            $hide_tax = '';
	        }
	        $tax_id = $product->tax_id;
			$item_tax = !empty($product->item_tax) ? $product->item_tax : 0;
			$unit_price_inc_tax = $product->sell_price_inc_tax;

			if($hide_tax == 'hide'){
				$tax_id = null;
				$unit_price_inc_tax = $product->default_sell_price;
			}

			if(!empty($so_line) && $action !== 'edit') {
				$tax_id = $so_line->tax_id;
				$item_tax = $so_line->item_tax;
				$unit_price_inc_tax = $so_line->unit_price_inc_tax;
			}

			if($product->product_type == 'Package' && $unit_price_inc_tax == '0')
			{
				foreach($product->combo_products as $k => $combo_product){
					$base_price = $combo_product['price'] * $combo_product['qty_required'];
					$sub_total_value += $base_price;
				}
						
			}
			$default_discount_type = !empty($common_settings['default_item_discount_type']) && in_array($common_settings['default_item_discount_type'], ['fixed', 'percentage'])
				? $common_settings['default_item_discount_type']
				: 'percentage';
			$discount_type = !empty($product->line_discount_type) ? $product->line_discount_type : $default_discount_type;
			$discount_amount = !empty($product->line_discount_amount) ? $product->line_discount_amount : 0;
			
			if(!empty($discount)) {
				//ToGetBack
				$discount_type = $discount->discount_type;
				$discount_amount = $discount->discount_amount;
			}

			if(!empty($so_line) && $action !== 'edit') {
				$discount_type = $so_line->line_discount_type;
				$discount_amount = $so_line->line_discount_amount;
			}

  			$sell_line_note = '';
  			if(!empty($product->sell_line_note)){
  				$sell_line_note = $product->sell_line_note;
  			}
			  if(!empty($so_line)){
  				$sell_line_note = $so_line->sell_line_note;
  			}
  		?>

		<?php if(!empty($discount)): ?>
			<?php echo Form::hidden("products[$row_count][discount_id]", $discount->id); ?>

			<?php if(!empty($discount->is_combination)): ?>
			<?php $discount_variations = []; ?>
				<?php $__currentLoopData = $discount->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
						$discount_variations[] = $dv->product_variation_id;
					?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<input type="hidden" id="is_combination" data-discount-variations="<?php echo json_encode($discount_variations); ?>" 
				data-discount-amount="<?php echo e($discount_amount, false); ?>" data-discount-type="<?php echo e($discount_type, false); ?>"
				data-discount-id="<?php echo e($discount->id, false); ?>">	
			<?php endif; ?>
		<?php endif; ?>

		<?php
			$warranty_id = !empty($action) && $action == 'edit' && !empty($product->warranties->first())  ? $product->warranties->first()->id : $product->warranty_id;

			if($discount_type == 'fixed') {
				$discount_amount = $discount_amount * $multiplier;
			}
		?>

		<?php if(empty($is_direct_sell) && !empty($common_settings['enable_product_description_on_pos'])): ?>
		<div class="modal fade row_edit_product_price_model" id="row_edit_product_price_modal_<?php echo e($row_count, false); ?>" tabindex="-1" role="dialog">
			<?php echo $__env->make('sale_pos.partials.row_edit_product_price_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
		<?php endif; ?>

		<!-- Description modal end -->
		<?php if(in_array('modifiers' , $enabled_modules)): ?>
			<div class="modifiers_html">
				<?php if(!empty($product->product_ms)): ?>
					<?php echo $__env->make('restaurant.product_modifier_set.modifier_for_product', array('edit_modifiers' => true, 'row_count' => $loop->index, 'product_ms' => $product->product_ms ) , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if(!empty($pos_settings['enable_inline_stock_quantity'])): ?>
		<small class="text-muted float-end px-1" style="white-space: nowrap;">
			<?php echo app('translator')->get('lang_v1.current_stock'); ?>: <?php if(!empty($product->qty_available)): ?> <?php echo e(number_format($product->qty_available, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php else: ?> 0 <?php endif; ?> <?php echo e($product->unit, false); ?>

		</small>
		<?php endif; ?>
		</div>
		<?php
			$max_quantity = $product->qty_available;
			$formatted_max_quantity = $product->formatted_qty_available;

			if(!empty($action) && $action == 'edit') {
				if(!empty($so_line)) {
					$qty_available = $so_line->quantity - $so_line->so_quantity_invoiced + $product->quantity_ordered;
					$max_quantity = $qty_available;
					$formatted_max_quantity = number_format($qty_available, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']);
				}
			} else {
				if(!empty($so_line) && $so_line->qty_available <= $max_quantity) {
					$max_quantity = $so_line->qty_available;
					$formatted_max_quantity = $so_line->formatted_qty_available;
				}
			}
			

			$max_qty_rule = $max_quantity;
			$max_qty_msg = __('validation.custom-messages.quantity_not_available', ['qty'=> $formatted_max_quantity, 'unit' => $product->unit  ]);
		?>

		<?php if( session()->get('business.enable_lot_number') == 1 || session()->get('business.enable_product_expiry') == 1): ?>
		<?php
			$lot_enabled = session()->get('business.enable_lot_number');
			$exp_enabled = session()->get('business.enable_product_expiry');
			$lot_no_line_id = '';
			if(!empty($product->lot_no_line_id)){
				$lot_no_line_id = $product->lot_no_line_id;
			}
		?>
		<?php if(!empty($product->lot_numbers) && empty($is_sales_order)): ?>
			<select class="form-control lot_number input-sm inline-select <?php if(empty($pos_settings['enable_expiry_date_inline'])): ?> hide <?php endif; ?>" name="products[<?php echo e($row_count, false); ?>][lot_no_line_id]" <?php if(!empty($product->transaction_sell_lines_id)): ?> disabled <?php endif; ?>>
				<option value=""><?php echo app('translator')->get('lang_v1.lot_n_expiry'); ?></option>
				<?php $__currentLoopData = $product->lot_numbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lot_number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
						$selected = "";
						if($lot_number->purchase_line_id == $lot_no_line_id){
							$selected = "selected";

							$max_qty_rule = $lot_number->qty_available;
							$max_qty_msg = __('lang_v1.quantity_error_msg_in_lot', ['qty'=> $lot_number->qty_formated, 'unit' => $product->unit  ]);
						}

						$expiry_text = '';
						if($exp_enabled == 1 && !empty($lot_number->exp_date)){
							if( \Carbon::now()->gt(\Carbon::createFromFormat('Y-m-d', $lot_number->exp_date)) ){
								$expiry_text = '(' . __('report.expired') . ')';
							}
						}

						//preselected lot number if product searched by lot number
						if(!empty($purchase_line_id) && $purchase_line_id == $lot_number->purchase_line_id) {
							$selected = "selected";

							$max_qty_rule = $lot_number->qty_available;
							$max_qty_msg = __('lang_v1.quantity_error_msg_in_lot', ['qty'=> $lot_number->qty_formated, 'unit' => $product->unit  ]);
						}
					?>
					<option value="<?php echo e($lot_number->purchase_line_id, false); ?>" data-qty_available="<?php echo e($lot_number->qty_available, false); ?>" data-msg-max="<?php echo app('translator')->get('lang_v1.quantity_error_msg_in_lot', ['qty'=> $lot_number->qty_formated, 'unit' => $product->unit  ]); ?>" <?php echo e($selected, false); ?>><?php if(!empty($lot_number->lot_number) && $lot_enabled == 1): ?><?php echo e($lot_number->lot_number, false); ?> <?php endif; ?> <?php if($lot_enabled == 1 && $exp_enabled == 1): ?> - <?php endif; ?> <?php if($exp_enabled == 1 && !empty($lot_number->exp_date)): ?> <?php echo app('translator')->get('product.exp_date'); ?>: <?php echo e(\Carbon::createFromTimestamp(strtotime($lot_number->exp_date))->format(session('business.date_format')), false); ?> <?php endif; ?> <?php echo e($expiry_text, false); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		<?php endif; ?>
	<?php endif; ?>
	<?php if(!empty($common_settings['enable_booking_hourly_services'])): ?>
		<?php if($product->enable_booking_hourly): ?>
		<div class="width-90">
			<a href="#" class="open_booking_hourly_modal" data-bs-target="add_booking_hourly_modal_<?php echo e($row_count, false); ?>" data-row-index="<?php echo e($row_count, false); ?>"><i class="glyphicon glyphicon-edit"></i> Booking</a>
		</div>
		<div class="modal fade bulk_add_booking_hourly_modal" id="add_booking_hourly_modal_<?php echo e($row_count, false); ?>" tabindex="-1" role="dialog">
			<?php echo $__env->make('sale_pos.partials.add_booking_hourly_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
		
		<?php endif; ?>
	<?php endif; ?>
	<?php if(!empty($pos_settings['enable_inline_product_note'])): ?>
		<br>
		<a href="javascript:void(0)" class="toggle-product-note" title="<?php echo app('translator')->get('lang_v1.product_note'); ?>">
			<i class="fa <?php echo e(!empty($sell_line_note) ? 'fa-minus-circle text-danger' : 'fa-plus-circle text-success', false); ?>"></i>
			<small><?php echo app('translator')->get('lang_v1.note'); ?></small>
		</a>
		<div class="product-note-wrapper" style="<?php echo e(empty($sell_line_note) ? 'display:none;' : '', false); ?>">
			<textarea class="form-control" name="products[<?php echo e($row_count, false); ?>][sell_line_note]" rows="2"><?php echo e($sell_line_note, false); ?></textarea>
		</div>
	<?php endif; ?>
	</td>

	<?php if(!empty($common_settings['enable_serial_number'])): ?>
	<td>
		<?php if($product->enable_sr_no && empty($common_settings['bulk_add_serial_number_pos'])): ?>
		<?php echo Form::text('products['.$row_count.'][serial_number]', $product->serial_number, ['class' => 'form-control input-sm serial_number', 
		 'placeholder' => !empty($common_settings['serial_number_label']) ? $common_settings['serial_number_label']: 'Serial Number',
		 !empty($common_settings['is_serial_number_required_sale']) ? 'required' : '', 
		 'is-validate' => (!empty($common_settings['is_serial_number_required_sale']) && !empty($common_settings['is_serial_number_required_purchase'])) ? 'true' : ''  ] ); ?>       
		<?php elseif($product->enable_sr_no && !empty($common_settings['bulk_add_serial_number_sales'])): ?>
			<button type="button" class="btn btn-sm btn-primary row_add_serial_numbers_btn" data-bs-toggle="modal" data-is_required="<?php if(!empty($common_settings['is_serial_number_required_sale'])): ?> 1 <?php else: ?> 0 <?php endif; ?>" data-bs-target="#add_serial_numbers_modal_<?php echo e($row_count, false); ?>">Add Serial Nos.</button>
		<?php endif; ?>
		<?php if($product->enable_imei_no): ?>
			<?php if(!empty($common_settings['enable_imei_number'])): ?>
				<?php if(!empty($common_settings['imei1_number_label'])): ?>
					<?php echo Form::text('products['.$row_count.'][imei][1]', $product->imei_numbers[1], 
					['class' => 'form-control input-sm imei_number', 'style' => 'margin-top: 5px;',
					'placeholder' => !empty($common_settings['imei1_number_label']) ? $common_settings['imei1_number_label']: 'IMEI1',
					!empty($common_settings['is_imei_number_required_sale']) ? 'required' : '',
					'is-validate' => (!empty($common_settings['is_imei_number_required_sale']) && !empty($common_settings['is_imei_number_required_purchase'])) ? 'true' : '' ] ); ?>       
				<?php endif; ?>
				<?php if(!empty($common_settings['imei2_number_label'])): ?>
					<?php echo Form::text('products['.$row_count.'][imei][2]', $product->imei_numbers[2], 
					['class' => 'form-control input-sm imei_number', 'style' => 'margin-top: 5px;',
					'placeholder' => !empty($common_settings['imei2_number_label']) ? $common_settings['imei2_number_label']: 'IMEI2',
					!empty($common_settings['is_imei_number_required_sale']) ? 'required' : '',
					'is-validate' => (!empty($common_settings['is_imei_number_required_sale']) && !empty($common_settings['is_imei_number_required_purchase'])) ? 'true' : '' ] ); ?>       
				<?php endif; ?>
				<?php if(!empty($common_settings['imei3_number_label'])): ?>
					<?php echo Form::text('products['.$row_count.'][imei][3]', $product->imei_numbers[3], 
					['class' => 'form-control input-sm imei_number', 'style' => 'margin-top: 5px;',
					'placeholder' => !empty($common_settings['imei3_number_label']) ? $common_settings['imei1_number_label']: 'IMEI3',
					!empty($common_settings['is_imei_number_required_sale']) ? 'required' : '',
					'is-validate' => (!empty($common_settings['is_imei_number_required_required_sale']) && !empty($common_settings['is_imei_number_required_purchase'])) ? 'true' : '' ] ); ?>       
				<?php endif; ?>
				<?php if(!empty($common_settings['imei4_number_label'])): ?>
					<?php echo Form::text('products['.$row_count.'][imei][4]', $product->imei_numbers[4], 
					['class' => 'form-control input-sm imei_number', 'style' => 'margin-top: 5px;',
					'placeholder' => !empty($common_settings['imei4_number_label']) ? $common_settings['imei4_number_label']: 'IMEI4',
					!empty($common_settings['is_imei_number_required_sale']) ? 'required' : '',
					'is-validate' => (!empty($common_settings['is_imei_number_required_sale']) && !empty($common_settings['is_imei_number_required_purchase'])) ? 'true' : '' ] ); ?>       
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
		<?php if($product->enable_sr_no && !empty($common_settings['bulk_add_serial_number_pos'])): ?>
		<div class="modal fade bulk_add_serial_numbers_modal" id="add_serial_numbers_modal_<?php echo e($row_count, false); ?>" tabindex="-1" role="dialog">
			<?php echo $__env->make('sell.partials.add_serial_numbers_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
		<?php endif; ?>
	</td>
	<?php endif; ?>
	
	<td>
		
		<?php if(!empty($product->transaction_sell_lines_id) && !$table_transaction): ?>
			<input type="hidden" name="products[<?php echo e($row_count, false); ?>][transaction_sell_lines_id]" class="form-control" value="<?php echo e($product->transaction_sell_lines_id, false); ?>">
		<?php endif; ?>

		<input type="hidden" name="products[<?php echo e($row_count, false); ?>][product_id]" class="form-control product_id" value="<?php echo e($product->product_id, false); ?>">

		<input type="hidden" value="<?php echo e($product->variation_id, false); ?>" 
			name="products[<?php echo e($row_count, false); ?>][variation_id]" class="row_variation_id">
		<input type="hidden" value="" name="products[<?php echo e($row_count, false); ?>][purchase_line_id]" 
				class="hidden_purchase_line_id">
		<input type="hidden" value="<?php echo e($product->enable_stock, false); ?>" 
			name="products[<?php echo e($row_count, false); ?>][enable_stock]">
		
		<?php if((!isset($product->quantity_ordered) || $product->quantity_ordered === '') && empty($product->foc_quantity)): ?>
			<?php
				$product->quantity_ordered = 1;
			?>
		<?php endif; ?>

		<?php
			$allow_decimal = true;
			if($product->unit_allow_decimal != 1) {
				$allow_decimal = false;
			}
			$disable_qty = (!empty($product->enable_sr_no) && empty($common_settings['bulk_add_serial_number_pos'])) ? true : false;
			$disable_qty_unit = !empty($product->enable_sr_no) ? true : false;
			$disable_qty = (!empty($product->enable_booking_hourly) && !empty($common_settings['enable_booking_hourly_services'])) ? true : $disable_qty;
			$disable_qty_unit = !empty($product->enable_booking_hourly && !empty($common_settings['enable_booking_hourly_services'])) ? true : $disable_qty_unit;
		?>
		<?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        	<?php if(!empty($product->sub_unit_id) && $product->sub_unit_id == $key): ?>
        		<?php
        			$max_qty_rule = $max_qty_rule / $multiplier;
        			$unit_name = $value['name'];
        			$max_qty_msg = __('validation.custom-messages.quantity_not_available', ['qty'=> $max_qty_rule, 'unit' => $unit_name  ]);

        			if(!empty($product->lot_no_line_id)){
        				$max_qty_msg = __('lang_v1.quantity_error_msg_in_lot', ['qty'=> $max_qty_rule, 'unit' => $unit_name  ]);
        			}

        			if($value['allow_decimal']) {
        				$allow_decimal = true;
        			}
        		?>
        	<?php endif; ?>
			<?php if(!empty($product->foc_sub_unit_id) && $product->foc_sub_unit_id == $key): ?>
        		<?php
        			$max_foc_qty_rule = $max_foc_qty_rule / $foc_multiplier;
        			$foc_unit_name = $value['name'];
        			$max_foc_qty_msg = __('validation.custom-messages.quantity_not_available', ['qty'=> $max_foc_qty_rule, 'unit' => $foc_unit_name  ]);

        			if(!empty($product->lot_no_line_id)){
        				$max_foc_qty_msg = __('lang_v1.quantity_error_msg_in_lot', ['qty'=> $max_foc_qty_rule, 'unit' => $foc_unit_name  ]);
        			}

        			if($value['allow_decimal']) {
        				$allow_decimal = true;
        			}
        		?>
        	<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<div class="multi-input input-number">
			<?php if(empty($pos_settings['enable_numeric_keypad_on_input'])): ?>
			
           	<button type="button" class="btn btn-default btn-flat width-20 float-start quantity-down d-none d-md-inline-block" <?php if($disable_qty): ?> disabled <?php endif; ?>>
				<i class="fa fa-minus text-danger m-auto"></i>
			</button>
			<?php endif; ?>
			
			<input type="text" class="form-control pos_quantity input_number input-xs mousetrap input_quantity" 
				value="<?php echo e(number_format($product->quantity_ordered, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" name="products[<?php echo e($row_count, false); ?>][quantity]" data-allow-overselling="<?php if(empty($pos_settings['allow_overselling'])): ?><?php echo e('false', false); ?><?php else: ?><?php echo e('true', false); ?><?php endif; ?>" 
				data-min="1"
				<?php if($allow_decimal): ?> 
					data-decimal=1 
				<?php else: ?> 
					data-decimal=0 
					data-rule-abs_digit="true" 
					data-msg-abs_digit="<?php echo app('translator')->get('lang_v1.decimal_value_not_allowed'); ?>" 
				<?php endif; ?>
				data-rule-required="true" 
				data-msg-required="<?php echo app('translator')->get('validation.custom-messages.this_field_is_required'); ?>" 
				<?php if($product->enable_stock && empty($pos_settings['allow_overselling']) && empty($is_sales_order) && empty($is_draft) ): ?>
					data-rule-max-value="<?php echo e($max_qty_rule, false); ?>" data-qty_available="<?php echo e($product->qty_available, false); ?>" data-msg-max-value="<?php echo e($max_qty_msg, false); ?>" 
					data-msg_max_default="<?php echo app('translator')->get('validation.custom-messages.quantity_not_available', ['qty'=> $product->formatted_qty_available, 'unit' => $product->unit  ]); ?>" 
				<?php endif; ?> 
				<?php if($disable_qty): ?> readonly <?php endif; ?>
			>
			
			<?php if(empty($pos_settings['enable_numeric_keypad_on_input'])): ?>
           	<button type="button" class="btn btn-default btn-flat width-20 quantity-up d-none d-md-inline-block" <?php if($disable_qty): ?> disabled <?php endif; ?>>
				<i class="fa fa-plus text-success m-auto"></i>
			</button>
			
			<?php endif; ?>
			<?php if(!empty($pos_settings['enable_numeric_keypad_on_input']) && !empty($product->edit_quantity_on_sale)): ?>
			<input type="hidden" id="open_quantity_numpad">
			<?php endif; ?>
	
			<?php if(count($sub_units) > 0): ?>
				<select name="products[<?php echo e($row_count, false); ?>][sub_unit_id]" class="form-control input-sm sub_unit inline-select <?php if($pos_settings['hide_quantity_unit']): ?> hide <?php endif; ?>" <?php if($disable_qty_unit): ?> style="pointer-events: none;background-color:#F5F5F5;" <?php endif; ?>>
					<?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($key, false); ?>" data-multiplier="<?php echo e($value['multiplier'], false); ?>" data-unit_name="<?php echo e($value['name'], false); ?>" data-allow_decimal="<?php echo e($value['allow_decimal'], false); ?>" <?php if(!empty($product->sub_unit_id) && $product->sub_unit_id == $key): ?> selected <?php endif; ?>>
							<?php echo e($value['short_name'] ?? $value['name'], false); ?>

						</option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			<?php else: ?>
				<input type="hidden" value="<?php echo e($product->unit, false); ?>" class="product_unit_text">
			<?php endif; ?>
			<span class="btn-group d-sm-none hide">
				<button type="button" class="btn btn-default btn-flat quantity-down" <?php if($disable_qty): ?> disabled <?php endif; ?> style="width:50%"><i class="fa fa-minus text-danger"></i></button>
				<button type="button" class="btn btn-default btn-flat quantity-up" <?php if($disable_qty): ?> disabled <?php endif; ?> style="width:50%"><i class="fa fa-plus text-success"></i></button>
			</span>
		</div>

		<?php if(!empty($product->second_unit)): ?>
            <br>
            <span style="white-space: nowrap;">
            <?php echo app('translator')->get('lang_v1.quantity_in_second_unit', ['unit' => $product->second_unit]); ?>*:</span><br>
            <input type="text" 
            name="products[<?php echo e($row_count, false); ?>][secondary_unit_quantity]" 
            value="<?php echo e(number_format($product->secondary_unit_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>"
            class="form-control input-sm input_number"
            required
			<?php if($disable_qty_unit): ?> readonly <?php endif; ?>>
        <?php endif; ?>
		<input type="hidden" name="products[<?php echo e($row_count, false); ?>][product_unit_id]" value="<?php echo e($product->unit_id, false); ?>">
		<input type="hidden" class="base_unit_multiplier" name="products[<?php echo e($row_count, false); ?>][base_unit_multiplier]" value="<?php echo e($multiplier, false); ?>">

		<input type="hidden" class="hidden_base_unit_sell_price" value="<?php echo e($product->default_sell_price / $multiplier, false); ?>">
		
		
		<?php if(($product->product_type == 'combo' || $product->product_type == 'Package')&& !empty($product->combo_products)): ?>
		

			<?php $__currentLoopData = $product->combo_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $combo_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php
					$quantity_id = $k +1;
					$base_price = $combo_product['price'] * $combo_product['qty_required'];
				?>

				<?php if(isset($action) && $action == 'edit'): ?>
					<?php
						// $combo_product['qty_required'] = $combo_product['quantity'] / $product->quantity_ordered;
						// $qty_total = $combo_product['quantity'];
						$qty_total = $combo_product['qty_required'] * $product->quantity_ordered * $multiplier;
					?>
				<?php else: ?>
					<?php
						$qty_total = $combo_product['qty_required'];
					?>
				<?php endif; ?>

				<input type="hidden" 
					value="<?php echo e($row_count, false); ?>" 
					class="row_count_input">
				
				<input type="hidden" 
					name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][product_id]"
					value="<?php echo e($combo_product['product_id'], false); ?>">

					<input type="hidden" 
					name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][name]"
					value="<?php echo e($combo_product['product_name'], false); ?>">

					<input type="hidden" 
					name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][variation_id]"
					value="<?php echo e($combo_product['variation_id'], false); ?>">

					<input type="hidden"
					id="<?php echo e($quantity_id, false); ?>"
					class="combo_product_qty" 
					name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][quantity]"
					data-unit_quantity="<?php echo e($combo_product['qty_required'], false); ?>"
					value="<?php echo e($qty_total, false); ?>">

					<input type="hidden"
					id="<?php echo e($quantity_id, false); ?>"
					class="combo_product_price" 
					name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][price]"
					data-unit_price="<?php echo e($base_price, false); ?>"
					value="<?php echo e($base_price, false); ?>">


					<?php if(isset($action) && $action == 'edit'): ?>
						<input type="hidden" 
							name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][transaction_sell_lines_id]"
							value="<?php echo e($combo_product['id'], false); ?>">
					<?php endif; ?>

			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>

		
		<?php if(!empty($product->product_set_name)): ?>
			<input type="hidden" name="products[<?php echo e($row_count, false); ?>][product_set_name]" value="<?php echo e($product->product_set_name, false); ?>">
			<input type="hidden" name="products[<?php echo e($row_count, false); ?>][product_set_order]" value="<?php echo e($product->product_set_order, false); ?>">
			<input type="hidden" class="product_set_group_id" value="<?php echo e($product->product_set_order, false); ?>">
		<?php endif; ?>
	</td>


	
	<?php if(!empty($pos_settings['enable_scheme_quantity_pos'])): ?>
	<?php if(auth()->user()->can('enable_scheme_quantity_column')): ?>
	<?php
		if(empty($product->foc_quantity) && (!empty($so_line) && !empty($so_line->foc_quantity))){
			$product->foc_quantity = $so_line->foc_quantity;
		}
	?>
	<td>
		<div class="multi-input input-number">
			<input type="text" data-min="1" 
				
				class="form-control foc_quantity input_number mousetrap input_quantity"
				value="<?php echo e(number_format($product->foc_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" name="products[<?php echo e($row_count, false); ?>][foc_quantity]" data-allow-overselling="<?php if(empty($pos_settings['allow_overselling'])): ?><?php echo e('false', false); ?><?php else: ?><?php echo e('true', false); ?><?php endif; ?>" 
				<?php if($allow_decimal): ?>  
					data-decimal=1 
				<?php else: ?> 
					data-decimal=0 
					data-rule-abs_digit="true" 
					data-msg-abs_digit="<?php echo app('translator')->get('lang_v1.decimal_value_not_allowed'); ?>" 
				<?php endif; ?>
				
				
				<?php if($product->enable_stock && empty($pos_settings['allow_overselling']) && empty($is_sales_order) && empty($is_quotation) && empty($so_line)): ?>
					data-rule-max-value="<?php echo e($max_foc_qty_rule, false); ?>" data-qty_available="0" data-msg-max-value="<?php echo e($max_foc_qty_msg, false); ?>" 
					data-msg_max_default="<?php echo app('translator')->get('validation.custom-messages.quantity_not_available', ['qty'=> 0, 'unit' => $foc_unit_name  ]); ?>"
					data-rule-min-value="Minimum Value greater than 0 allowed" data-msg_min_default="<?php echo app('translator')->get('validation.custom-messages.quantity_not_available', ['qty'=> 0, 'unit' => $foc_unit_name  ]); ?>" 
				<?php endif; ?> 
				<?php if(auth()->user()->id != session()->get('business.owner_id') && auth()->user()->can('disable_editable_scheme_quantity')): ?> readonly <?php endif; ?>
			>
			<?php if(count($sub_units) > 0): ?>
				<select name="products[<?php echo e($row_count, false); ?>][foc_sub_unit_id]" class="form-control input-sm foc_sub_unit inline-select <?php if($pos_settings['hide_quantity_unit']): ?> hide <?php endif; ?>" 
					<?php if(auth()->user()->id != session()->get('business.owner_id') && auth()->user()->can('disable_editable_scheme_quantity')): ?> readonly <?php endif; ?>>
					<?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($key, false); ?>" data-multiplier="<?php echo e($value['multiplier'], false); ?>" data-unit_name="<?php echo e($value['name'], false); ?>" data-allow_decimal="<?php echo e($value['allow_decimal'], false); ?>" <?php if(!empty($product->foc_sub_unit_id) && $product->foc_sub_unit_id == $key || !empty($so_line->foc_sub_unit_id) && $so_line->foc_sub_unit_id == $key): ?> selected <?php endif; ?>>
							<?php echo e($value['short_name'] ?? $value['name'], false); ?>

						</option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			<?php else: ?>
				<input type="hidden" value="<?php echo e($product->unit, false); ?>" class="foc_unit_text">
			<?php endif; ?>
	
			<?php if(!empty($product->second_unit)): ?>
				<span style="white-space: nowrap;">
				<?php echo app('translator')->get('lang_v1.quantity_in_second_unit', ['unit' => $product->second_unit]); ?>*:</span><br>
				<input type="text" 
				name="products[<?php echo e($row_count, false); ?>][foc_secondary_unit_quantity]" 
				value="<?php echo e(number_format($product->secondary_unit_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>"
				class="form-control input-sm input_number"
				required <?php if(auth()->user()->id != session()->get('business.owner_id') && auth()->user()->can('disable_editable_scheme_quantity')): ?> readonly <?php endif; ?>>
			<?php endif; ?>
	
			<input type="hidden" class="foc_base_unit_multiplier" name="products[<?php echo e($row_count, false); ?>][foc_base_unit_multiplier]" value="<?php echo e($foc_multiplier, false); ?>">
			</div>
	</td>
	<?php endif; ?>
	<?php endif; ?>
	
	
	
	<?php if(1 === 1): ?> 
		<?php if(!empty($pos_settings['inline_service_staff'])): ?>
			<td>
				<div class="">
					<?php echo Form::select("products[" . $row_count . "][res_service_staff_id]", $waiters, !empty($product->res_service_staff_id) ? $product->res_service_staff_id : null, ['class' => 'form-control select2 order_line_service_staff', 'placeholder' => __('restaurant.select_service_staff'), 'required' => (!empty($pos_settings['is_service_staff_required']) && $pos_settings['is_service_staff_required'] == 1) ? true : false ]); ?>

				</div>
			</td>
		<?php endif; ?>
		<?php
			$pos_unit_price = !empty($product->unit_price_before_discount) ? $product->unit_price_before_discount : $product->default_sell_price;

			if(!empty($so_line) && $action !== 'edit') {
				$pos_unit_price = $so_line->unit_price_before_discount;
			}

			if($product->product_type == 'Package' && $unit_price_inc_tax == '0')
			{
					$pos_unit_price = $sub_total_value;
					$unit_price_inc_tax = $sub_total_value;
			}

			$use_sp_as_min = !empty($product->use_sp_as_min) ? $product->use_sp_as_min : $pos_unit_price;
		?>
		<td>
			<div class="input-number <?php if(!empty($pos_settings['enable_group_price_inline_pos']) && !empty($price_groups) && !empty($user_settings['ps_show_price_group'])): ?> multi-input <?php endif; ?>">
			<input type="text" name="products[<?php echo e($row_count, false); ?>][unit_price]" class="form-control pos_unit_price input_number mousetrap" 
			value="<?php echo e(number_format($pos_unit_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" <?php if(!empty($pos_settings['enable_msp'])): ?> data-rule-min-value="<?php echo e($use_sp_as_min, false); ?>" 
			data-msg-min-value="<?php echo e(__('lang_v1.minimum_selling_price_error_msg', ['price' => number_format($use_sp_as_min, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])]), false); ?>" <?php endif; ?>
			 <?php if(!$edit_price): ?> readonly <?php endif; ?>
			 <?php if(!empty($pos_settings['enable_group_price_inline_pos']) && !empty($price_groups) && !empty($user_settings['ps_show_price_group'])): ?>
			 style="width: 100px !important"
			 <?php endif; ?>> 
			<?php if(!empty($pos_settings['enable_group_price_inline_pos']) && !empty($price_groups) && !empty($user_settings['ps_show_price_group'])): ?>
				<?php echo Form::select("products[" . $row_count . "][price_group]", $price_groups, null, ['class' => 'form-control input-sm sell_line_price_group inline-select width-40', ], $price_groups_price); ?>

			<?php endif; ?>
			</div>

			<?php if(!empty($last_sell_line) && !empty($is_direct_sell)): ?>
				<br>
				<small class="text-muted"><?php echo app('translator')->get('lang_v1.prev_unit_price'); ?>: <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $last_sell_line->unit_price_before_discount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></small>
			<?php endif; ?>
		</td>

		<?php if(!empty($pos_settings['enable_discount_column'])): ?>
			<?php
				$max_discount = !is_null(auth()->user()->max_sales_discount_percent) ? auth()->user()->max_sales_discount_percent : '';
				//if sale discount is more than user max discount change it to max discount
				if(!empty($discount)){
					$max_discount = $discount->discount_amount;
				}
				$sales_discount = $business_details->default_sales_discount;
				if ($max_discount != '' && $sales_discount > $max_discount) {
					$sales_discount = $max_discount;
				}
				$default_sales_tax = $business_details->default_sales_tax;
				if ($sale_type == 'sales_order') {
					$sales_discount = 0;
					$default_sales_tax = null;
				}
			?>
			
			<td>
				<div class="multi-input input-number">
					<?php echo Form::text("products[$row_count][line_discount_amount]", number_format($discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number row_discount_amount',
					'data-default' => '0',
						'data-max-discount' => $max_discount,
						'data-max-discount-error_msg' => __('lang_v1.max_inline_discount_error_msg', ['discount' => $max_discount != '' ? number_format($max_discount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '',]),
					'readonly' => !$edit_discount]); ?>

					<?php echo Form::select("products[$row_count][line_discount_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $discount_type , ['class' => 'form-control input-sm row_discount_type inline-select', 'style' => 'width: 50% !important;min-width: 30%;', 'disabled' => !$edit_discount]); ?>

					<?php if(!empty($discount) && !empty($common_settings['show_inline_discount_detail'])): ?>
						<p class="help-block"><?php echo __('lang_v1.applied_discount_text', ['discount_name' => $discount->name, 'starts_at' => $discount->formated_starts_at, 'ends_at' => $discount->formated_ends_at]); ?></p>
					<?php endif; ?>
				</div>
				<?php if(!empty($last_sell_line) && !empty($is_direct_sell)): ?>
					<br>
					<small class="text-muted">
						<?php echo app('translator')->get('lang_v1.prev_discount'); ?>: 
						<?php if($last_sell_line->line_discount_type == 'percentage'): ?>
							<?php echo e(number_format($last_sell_line->line_discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>%
						<?php else: ?>
							<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $last_sell_line->line_discount_amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
						<?php endif; ?>
					</small>
				<?php endif; ?>
				<?php echo Form::hidden("products[$row_count][discount_not_applicable]", $product->discount_not_applicable, ['class' => 'inline_discount_not_applicable']); ?>

			</td>
		<?php endif; ?>

		<?php
			if($discount_type == 'fixed'){
				$sp_after_discount = $pos_unit_price - $discount_amount;
			}elseif ($discount_type == 'percentage'){ 
				$sp_discount = $pos_unit_price * ($discount_amount / 100);
				$sp_after_discount = $pos_unit_price - $sp_discount;
			}else{
				$sp_after_discount = $pos_unit_price - $discount_amount;	
			}

			$row_is_tax_inclusive = !empty($is_tax_inclusive) && $is_tax_inclusive !== 'false';
			if($product->tax_type == 'inclusive') {
				$row_is_tax_inclusive = true;
			} elseif($product->tax_type == 'exclusive') {
				$row_is_tax_inclusive = false;
			}
			$row_unit_price_inc_tax = $row_is_tax_inclusive ? $sp_after_discount : ($sp_after_discount + $item_tax);
		?>
		
		<td class=" text-center <?php if(empty($pos_settings['enable_discount_column'])): ?> hide <?php endif; ?> <?php if(empty($pos_settings['enable_after_discount_column'])): ?> hide <?php endif; ?>">
			<span class="pos_unit_price_after_discount"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sp_after_discount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
		</td>
		
		<input type="hidden" class='pos_unit_price_after_discount_hidden' value="<?php echo e($sp_after_discount, false); ?>">

		
		<?php
			$edit_tax = auth()->user()->can('edit_product_tax_from_pos_screen') ? true : false;
		?>
		<td class="text-center <?php echo e($hide_tax, false); ?>">
			<div class="multi-input input-number">
				
				<span class="sell_product_unit_tax_text"><?php echo e(number_format($item_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
				<?php echo Form::select("products[$row_count][tax_id]", $tax_dropdown['tax_rates'], $tax_id, ['class' => 'form-control input-sm sell_line_tax_id inline-select', 'style' => 'width: 50% !important;', 'disabled'=>!$edit_tax], $tax_dropdown['attributes']); ?>

				<?php echo Form::hidden("products[$row_count][item_tax]", number_format($item_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'item_tax']); ?>

				<?php echo Form::hidden("products[$row_count][tax_not_applicable]", $product->tax_not_applicable, ['class' => 'inline_tax_not_applicable']); ?>

			</div>
		</td>
		

	<?php else: ?>
		<?php if(!empty($pos_settings['inline_service_staff'])): ?>
			<td>
				<div class="">
					<?php echo Form::select("products[" . $row_count . "][res_service_staff_id]", $waiters, !empty($product->res_service_staff_id) ? $product->res_service_staff_id : null, ['class' => 'form-control select2 order_line_service_staff', 'placeholder' => __('restaurant.select_service_staff'), 'required' => (!empty($pos_settings['is_service_staff_required']) && $pos_settings['is_service_staff_required'] == 1) ? true : false ]); ?>

				</div>
			</td>
		<?php endif; ?>
	<?php endif; ?>
	<?php
		$edit_price = auth()->user()->can('edit_product_price_from_pos_screen') ? true : false;
	?>
	
	<td class="<?php echo e($hide_tax, false); ?> <?php if(empty($pos_settings['enable_inclusive_tax_column'])): ?> hide <?php endif; ?>">
		<input type="text" name="products[<?php echo e($row_count, false); ?>][unit_price_inc_tax]" class="form-control pos_unit_price_inc_tax input_number" value="<?php echo e(number_format($row_unit_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" readonly >
		<input type="hidden" value="<?php echo e($product->tax_type, false); ?>" class="item_tax_type">
	</td>
	
	<?php if(!empty($common_settings['enable_product_warranty']) && !empty($is_direct_sell)): ?>
		<td>
			<?php echo Form::select("products[$row_count][warranty_id]", $warranties, $warranty_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control']); ?>

		</td>
	<?php endif; ?>
	
	
	<td class="text-center">
		<?php
			$edit_subtotal = auth()->user()->can('edit_product_subtotal_from_pos_screen') ? true : false;
			$sub_total_value = $product->quantity_ordered*$row_unit_price_inc_tax;
			if($product->product_type == 'Package' && $unit_price_inc_tax == '0')
			{
				foreach($product->combo_products as $k => $combo_product){
					$base_price = $combo_product['price'] * $combo_product['qty_required'];
					$sub_total_value += $base_price;
				}
				
			}
			if(empty($sub_total_value)){
				$sub_total_value = $product->quantity_ordered * $unit_price_inc_tax;
			}
			if($action == 'edit'){
				$sub_total_value = $product->quantity_ordered * $row_unit_price_inc_tax;
			}
		?>
		<input type="<?php echo e($edit_subtotal ? 'text' : 'hidden', false); ?>" class="form-control pos_line_total <?php if($edit_subtotal): ?> input_number <?php endif; ?>" data-before="<?php echo e(number_format($sub_total_value, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" value="<?php echo e(number_format($sub_total_value, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
		<span class="display_currency pos_line_total_text <?php if($edit_subtotal): ?> hide <?php endif; ?>" data-currency_symbol="true"><?php echo e($sub_total_value, false); ?></span>
		<?php if(empty($is_direct_sell)): ?>
			<input type="hidden" class="last_purchase_price" value="<?php echo e($product->last_purchased_price ?? 0, false); ?>">
		<?php endif; ?>
	</td>
	<?php if(!empty($is_direct_sell)): ?>
	<td class="text-center">
		<?php
			$line_pm = 0;
			if($product->last_purchased_price != 0 && $unit_price_inc_tax != 0){
				//Calculate Gross Profit
				$line_pm = (($unit_price_inc_tax - $product->last_purchased_price) / $unit_price_inc_tax) * 100 ; 
			}
		?>
		<span class="profit_margin_text"><?php echo e(number_format($line_pm, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>%</span>
	</td>
	<td class="text-center">
		<?php if(!empty($product->last_purchased_price)): ?>
			<input type="hidden" class="last_purchase_price" value="<?php echo e($product->last_purchased_price, false); ?>">
			<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $product->last_purchased_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
		<?php else: ?>
			<input type="hidden" class="last_purchase_price" value="0">
			0
		<?php endif; ?>
	</td>
	<?php endif; ?>
	
	<td class="text-center v-center" style="width: 3%">
		<?php if(!auth()->user()->can('disable_changing_entered_products_on_pos') && !auth()->user()->hasRole('Admin#'.auth()->user()->business_id)): ?>
			<i class="fa fa-times text-danger pos_remove_row cursor-pointer" aria-hidden="true"></i>
		<?php elseif(auth()->user()->hasRole('Admin#'.auth()->user()->business_id)): ?>
			<i class="fa fa-times text-danger pos_remove_row cursor-pointer" aria-hidden="true"></i>
		<?php elseif(empty($product->transaction_sell_lines_id)): ?>
			<i class="fa fa-times text-danger pos_remove_row cursor-pointer" aria-hidden="true"></i>
		<?php else: ?> 
			<i class="fa fa-times text-danger pos-approval-edit-remove-row cursor-pointer" data-id="<?php echo e($product->variation_id, false); ?>" aria-hidden="true"></i>
		<?php endif; ?>
	</td>
	
</tr>
<?php if($product->product_type == 'Package'): ?>
	<?php $__currentLoopData = $product->combo_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $combo_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php
	$package_product_price = $combo_product['price'];
	if($product->default_sell_price != '0.00')
	{	
		$package_product_price = 0;
	}
	if(isset($product->variation_default_sell_price) && (float)$product->variation_default_sell_price == 0){
		$package_product_price = $combo_product['price'];
	}
	$quantity_k = $k + 1;
	?>
	<?php if(isset($action) && $action == 'edit'): ?>
	<?php
		// $combo_product['qty_required'] = $combo_product['quantity'] / $product->quantity_ordered;
		// $qty_total = $combo_product['quantity'];
		$qty_total = $combo_product['qty_required'] * $product->quantity_ordered * $multiplier;
	?>
	<?php else: ?>
		<?php
			$qty_total = $combo_product['qty_required'];
		?>
	<?php endif; ?>
		<tr class="package_row row_<?php echo e($row_count, false); ?>">
			<td></td>
			<td class="text-center v-center">
				<?php echo e($combo_product['product_name'], false); ?>

				<input type="hidden" name="package[<?php echo e($k, false); ?>][product_name]" value="<?php echo e($combo_product['product_name'], false); ?>">
				<input type="hidden" name="package[<?php echo e($k, false); ?>][printer_id]" value="<?php echo e($combo_product['printer_id'], false); ?>">
				<input type="hidden" name="package[<?php echo e($k, false); ?>][printer_path]" value="<?php echo e($combo_product['printer_path'], false); ?>">
			</td>
			<td class="text-center v-center">
				<input type="text" value="<?php echo e(number_format($qty_total, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" 
				name="package[<?php echo e($k, false); ?>][product_quantity]" id="package_product_quantity_<?php echo e($quantity_k, false); ?>_<?php echo e($row_count, false); ?>" 
				class="package_product_quantity input_quantity" disabled>
			</td>
			<td>
				<input type="hidden" value="<?php echo e($row_count, false); ?>" id="row_count_input">
				<input type="text" value="<?php echo e(number_format($package_product_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" 
				id="" name="" class="" disabled>
			</td>
			<td class="text-center v-center">
				<input type="text" value="<?php echo e(number_format($package_product_price*$combo_product['qty_required'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" 
				id="package_product_price_<?php echo e($quantity_k, false); ?>_<?php echo e($row_count, false); ?>" name="package[<?php echo e($k, false); ?>][product_price]" 
				class="package_product_price" disabled>
			</td>
			<td>
				<input type="hidden" value="<?php echo e(number_format($combo_product['qty_required'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>"
				id="base_quantity_<?php echo e($quantity_k, false); ?>_<?php echo e($row_count, false); ?>"><input type="hidden" 
				value="<?php echo e(number_format($package_product_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" id="base_price_<?php echo e($quantity_k, false); ?>_<?php echo e($row_count, false); ?>">
			</td>
		</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>
