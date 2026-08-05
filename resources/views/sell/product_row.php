<?php
	// Phase 67: prefer controller-supplied per-branch common_settings; session is the fallback.
	$common_settings = isset($common_settings) && ! empty($common_settings)
		? $common_settings
		: session()->get('business.common_settings');
	$exchange_rate = $sell->exchange_rate ?? 1;
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

<tr class="product_row" id="product_row_<?php echo e($row_count, false); ?>" data-row_index="<?php echo e($row_count, false); ?>" <?php if(!empty($so_line)): ?> data-so_id="<?php echo e($so_line->transaction_id, false); ?>" <?php endif; ?>>
	<td><span class="sr_number"><?php if($edit): ?><?php echo e($row_index, false); ?><?php endif; ?></span></td>
	<td class="text-center pos_line_sku"><?php echo e($product->sub_sku, false); ?></td>
	<td>
		<?php if(!empty($so_line)): ?>
			<input type="hidden" 
			name="products[<?php echo e($row_count, false); ?>][so_line_id]" 
			value="<?php echo e($so_line->id, false); ?>">
		<?php endif; ?>
		<?php
			$product_name = $product->product_name;
			// if($pos_settings['hide_product_suggestion'] == 2 || auth()->user()->can('edit_product_name_from_sale_screen')){
			// 	$product_name = $product->product_name . ' ' . $product->sub_sku;
			// }
			if(!empty($product->brand)){ $product_name .= ' ' . $product->brand ;}
			$user_product_name_changed = 0;
			if(!empty($product->user_product_name)){
				$product_name = $product->user_product_name;
				$user_product_name_changed = 1;
			}
		?>
		
		<?php if( ($edit_price || $edit_discount) && empty($is_direct_sell) ): ?>
		<div title="<?php echo app('translator')->get('lang_v1.pos_edit_product_price_help'); ?>">
		<span class="text-link text-info cursor-pointer" data-bs-toggle="modal" data-bs-target="#row_edit_product_price_modal_<?php echo e($row_count, false); ?>">
			<?php echo $product_name; ?> -
			&nbsp;<i class="fa fa-info-circle"></i>
		</span>
		</div>
		<?php else: ?>
			<?php if(auth()->user()->can('edit_product_name_from_sale_screen') && !empty($common_settings['sale_product_name_editable'])): ?> 
			
			<?php echo Form::textarea('products['.$row_count.'][user_product_name]', $product_name, ['class' => 'form-control user_product_name', 'rows'=>2 ]); ?>

			<input type="hidden" class="user_product_name_changed" name="products[<?php echo e($row_count, false); ?>][product_name_changed]" value="<?php echo e($user_product_name_changed, false); ?>">
			
			<?php else: ?>
			<span class="text-wrap">
			<?php echo $product_name; ?>

			</span>
			<?php endif; ?>
		<?php endif; ?>
		<input type="hidden" class="enable_sr_no" value="<?php echo e($product->enable_sr_no, false); ?>">
		<input type="hidden" name="pct_code" class="pct_code" value="<?php echo e(!empty($product->pct_code) ? $product->pct_code : (!empty(session('business.common_settings.send_zero_if_pct_code_missing')) ? 0 : ''), false); ?>">
		<input type="hidden" class="product_type" name="products[<?php echo e($row_count, false); ?>][product_type]" value="<?php echo e($product->product_type, false); ?>">
		<input type="hidden" class="printer_id" name="products[<?php echo e($row_count, false); ?>][printer_id]" value="<?php echo e($product->printer_id, false); ?>">
		<input type="hidden" id="product_prompt" value="<?php echo e($product->prompt, false); ?>">
		<?php

			$hide_tax = 'hide';
	        if($common_settings['enable_inline_tax_sales'] == 1 && $tax_dropdown['tax_rates']->count() > 1){
	            $hide_tax = '';
	        }
	        $tax_id = $product->tax_id;
			$item_tax = !empty($product->item_tax) ? $product->item_tax / $exchange_rate : 0;
			$unit_price_inc_tax = $product->sell_price_inc_tax / $exchange_rate;

			if($hide_tax == 'hide'){
				$tax_id = null;
				$unit_price_inc_tax = $product->default_sell_price / $exchange_rate;
			}

			if(!empty($so_line) && $action !== 'edit') {
				$tax_id = $so_line->tax_id;
				$item_tax = $so_line->item_tax / $exchange_rate;
				$unit_price_inc_tax = $so_line->unit_price_inc_tax / $exchange_rate;
			}

			$default_discount_type = !empty($common_settings['default_item_discount_type']) && in_array($common_settings['default_item_discount_type'], ['fixed', 'percentage'])
				? $common_settings['default_item_discount_type']
				: 'percentage';
			$discount_type = !empty($product->line_discount_type) ? $product->line_discount_type : $default_discount_type;
			$discount_amount = !empty($product->line_discount_amount) ? $product->line_discount_amount : 0;
			if($discount_type == 'fixed') {
				$discount_amount = $discount_amount  / $exchange_rate;
			}
			
			$default_discount2_type = !empty($common_settings['default_item_discount2_type']) && in_array($common_settings['default_item_discount2_type'], ['fixed', 'percentage'])
				? $common_settings['default_item_discount2_type']
				: 'fixed';
			$discount2_type = !empty($product->line_discount2_type) ? $product->line_discount2_type : $default_discount2_type;
			$discount2_amount = !empty($product->line_discount2_amount) ? $product->line_discount2_amount : 0;
			if($discount2_type == 'fixed') {
				$discount2_amount = $discount2_amount  / $exchange_rate;
			}
			

			if(!empty($discount)) {
				$discount_type = $discount->discount_type;
				$discount_amount = $discount->discount_amount;
				if($discount_type == 'fixed') {
					$discount_amount = $discount_amount  / $exchange_rate;
				}
			}

			if(!empty($so_line) && $action !== 'edit') {
				$discount_type = $so_line->line_discount_type;
				$discount_amount = $so_line->line_discount_amount;
				$discount2_type = $so_line->line_discount2_type;
				$discount2_amount = $so_line->line_discount2_amount;
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
			if($discount2_type == 'fixed') {
				$discount2_amount = $discount2_amount * $multiplier;
			}
		?>

		<?php if(empty($is_direct_sell)): ?>
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

		<?php
			$max_quantity = $product->qty_available;
			$formatted_max_quantity = $product->formatted_qty_available;

			if(!empty($action) && $action == 'edit') {
				if(!empty($so_line)) {
					if($so_line->transaction->type == 'sales_order'){
						$qty_available = $so_line->quantity - $so_line->so_quantity_invoiced + $product->quantity_ordered;
						$max_quantity = $qty_available;
						$formatted_max_quantity = number_format($qty_available, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']);
					}else{
						$qty_available = $so_line->quantity + $product->quantity_ordered;
						$max_quantity = $qty_available;
						$formatted_max_quantity = number_format($qty_available, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']);						
					}
				}
			} else {
				if(!empty($so_line) && $so_line->qty_available <= $max_quantity) {
					$max_quantity = $so_line->qty_available;
					$formatted_max_quantity = $so_line->formatted_qty_available;
				}
			}

			$max_qty_rule = $max_quantity;
			$max_foc_qty_rule = $max_quantity - ($product->quantity_ordered * $multiplier); 
			$max_qty_msg = __('validation.custom-messages.quantity_not_available', ['qty'=> $formatted_max_quantity, 'unit' => $product->unit  ]);
			$max_foc_qty_msg = __('validation.custom-messages.quantity_not_available', ['qty'=> $max_foc_qty_rule, 'unit' => $product->unit  ]);
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
			<select class="form-control lot_number input-sm" name="products[<?php echo e($row_count, false); ?>][lot_no_line_id]" <?php if(!empty($product->transaction_sell_lines_id)): ?> disabled <?php endif; ?>>
				<option value=""> <?php if(!empty($common_settings['lot_number_label'])): ?> <?php echo e($common_settings['lot_number_label'], false); ?> <?php else: ?> <?php echo app('translator')->get('lang_v1.lot_n_expiry'); ?> <?php endif; ?></option>
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
	<?php if(!empty($is_direct_sell)): ?>
	<br>
	<small class="text-muted" style="white-space: nowrap;"><?php echo app('translator')->get('report.current_stock'); ?>: <?php if(!empty($product->qty_available)): ?> <?php echo e(number_format($product->qty_available, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php else: ?> 0 <?php endif; ?> <?php echo e($product->unit, false); ?></small>	
		<?php if(!empty($common_settings['enable_inline_product_note_sale'])): ?>
			<br>
			<a href="javascript:void(0)" class="toggle-product-note" title="<?php echo app('translator')->get('lang_v1.product_note'); ?>">
				<i class="fa <?php echo e(!empty($sell_line_note) ? 'fa-minus-circle text-danger' : 'fa-plus-circle text-success', false); ?>"></i>
				<small><?php echo app('translator')->get('lang_v1.product_note'); ?></small>
			</a>
			<div class="product-note-wrapper" style="<?php echo e(empty($sell_line_note) ? 'display:none;' : '', false); ?>">
				<textarea class="form-control" name="products[<?php echo e($row_count, false); ?>][sell_line_note]" rows="2"><?php echo e($sell_line_note, false); ?></textarea>
			</div>
		<?php endif; ?>
		<input type="hidden" class="current_stock" value="<?php echo e((!empty($product->qty_available)) ? $product->qty_available : 0, false); ?>">	
		<input type="hidden" class="row_stock_sku" value="<?php echo e($product->sub_sku, false); ?>">
	<?php endif; ?>
	</td>
	<?php if(!empty($user_settings['sale_show_brand_column'])): ?>
	<td> <?php echo e($product->brand, false); ?></td>
	<?php endif; ?>

	<?php if(!empty($user_settings['sale_show_category_column'])): ?>
	<td> <?php echo e($product->category, false); ?></td>
	<?php endif; ?>

	<?php if(!empty($common_settings['enable_serial_number'])): ?>
	<td>
		<?php if($product->enable_sr_no && empty($common_settings['bulk_add_serial_number_sales'])): ?>
			<?php echo Form::text('products['.$row_count.'][serial_number]', $product->serial_number, ['class' => 'form-control input-sm serial_number', 
			'placeholder' => !empty($common_settings['serial_number_label']) ? $common_settings['serial_number_label']: 'Serial Number',
			!empty($common_settings['is_serial_number_required_sale']) ? 'required' : '', 
			'is-validate' => (!empty($common_settings['is_serial_number_required_sale']) && !empty($common_settings['is_serial_number_required_purchase'])) ? 'true' : ''  ] ); ?>       
		<?php elseif($product->enable_sr_no && !empty($common_settings['bulk_add_serial_number_sales'])): ?>
		<button type="button" class="btn btn-sm btn-primary row_add_serial_numbers_btn" data-bs-toggle="modal" data-bs-target="#add_serial_numbers_modal_<?php echo e($row_count, false); ?>" data-is_required="<?php if(!empty($common_settings['is_serial_number_required_sale'])): ?> 1 <?php else: ?> 0 <?php endif; ?>">Add Serial Nos.</button>
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
		<?php if($product->enable_sr_no && !empty($common_settings['bulk_add_serial_number_sales'])): ?>
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
		<input type="hidden" value="<?php echo e($product->purchase_line_id, false); ?>" name="products[<?php echo e($row_count, false); ?>][purchase_line_id]" class="hidden_purchase_line_id">

		<input type="hidden" value="<?php echo e($product->enable_stock, false); ?>" name="products[<?php echo e($row_count, false); ?>][enable_stock]">
		<input type="hidden" value="<?php if(empty($pos_settings['allow_overselling'])): ?><?php echo e(false, false); ?><?php else: ?><?php echo e(true, false); ?><?php endif; ?>" name="products[<?php echo e($row_count, false); ?>][allow_overselling]">
		
		<?php if((!isset($product->quantity_ordered) || $product->quantity_ordered === '') && empty($product->foc_quantity)): ?>
			<?php
				$product->quantity_ordered = 1;
			?>
		<?php endif; ?>

		<?php if(!empty($so_line->sub_unit_id)): ?>
			<?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($so_line->transaction->type == 'sales_order'): ?>
					<?php if(!empty($so_line->sub_unit_id) && $so_line->sub_unit_id == $key && !empty($value)): ?>
						<?php
							$product->quantity_ordered = ($so_line->quantity - $so_line->so_quantity_invoiced) / $value['multiplier'];
						?>
					<?php endif; ?>
				<?php else: ?>
					<?php if(!empty($so_line->sub_unit_id) && $so_line->sub_unit_id == $key && !empty($value)): ?>
						<?php
							$product->quantity_ordered = $so_line->quantity / $value['multiplier'];
						?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>

		<?php
			$allow_decimal = true;
			if($product->unit_allow_decimal != 1) {
				$allow_decimal = false;
			}
			$disable_qty = (!empty($product->enable_sr_no) && empty($common_settings['bulk_add_serial_number_sales'])) ? true : false;
			$disable_qty_unit = !empty($product->enable_sr_no) ? true : false;
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
			<?php if(!empty($so_line->sub_unit_id) && $so_line->sub_unit_id == $key): ?>
        		<?php
        			$max_qty_rule = $max_qty_rule / $multiplier;
        			$unit_name = $value['name'];
        			$max_qty_msg = __('validation.custom-messages.quantity_not_available', ['qty'=> $max_qty_rule, 'unit' => $unit_name  ]);

        			if(!empty($so_line->lot_no_line_id)){
        				$max_qty_msg = __('lang_v1.quantity_error_msg_in_lot', ['qty'=> $max_qty_rule, 'unit' => $unit_name  ]);
        			}

        			if($value['allow_decimal']) {
        				$allow_decimal = true;
        			}
        		?>
        	<?php endif; ?>
			<?php if(!empty($so_line->foc_sub_unit_id) && $so_line->foc_sub_unit_id == $key): ?>
        		<?php
        			$max_foc_qty_rule = $max_foc_qty_rule / $foc_multiplier;
        			$foc_unit_name = $value['name'];
        			$max_foc_qty_msg = __('validation.custom-messages.quantity_not_available', ['qty'=> $max_foc_qty_rule, 'unit' => $foc_unit_name  ]);

        			if(!empty($so_line->lot_no_line_id)){
        				$max_foc_qty_msg = __('lang_v1.quantity_error_msg_in_lot', ['qty'=> $max_foc_qty_rule, 'unit' => $foc_unit_name  ]);
        			}

        			if($value['allow_decimal']) {
        				$allow_decimal = true;
        			}
        		?>
        	<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<div class="<?php if(!empty($common_settings['sale_inline_ui_slim'])): ?> multi-input <?php else: ?> input-group <?php endif; ?> input-number ">
			<?php if(empty($common_settings['sale_inline_ui_slim'])): ?>
			<span class="input-group-btn d-none d-md-inline">
				<button type="button" class="btn btn-default btn-flat quantity-down" <?php if($disable_qty): ?> disabled <?php endif; ?>><i class="fa fa-minus text-danger"></i></button>
			</span>
			<?php endif; ?>
		
			<input type="text" data-min="1" 
				class="form-control pos_quantity input_number mousetrap input_quantity" 
				value="<?php echo e(number_format($product->quantity_ordered, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" name="products[<?php echo e($row_count, false); ?>][quantity]" data-allow-overselling="<?php if(empty($pos_settings['allow_overselling'])): ?><?php echo e('false', false); ?><?php else: ?><?php echo e('true', false); ?><?php endif; ?>" 
				<?php if($allow_decimal): ?>  
					data-decimal=1 
				<?php else: ?> 
					data-decimal=0 
					data-rule-abs_digit="true" 
					data-msg-abs_digit="<?php echo app('translator')->get('lang_v1.decimal_value_not_allowed'); ?>" 
				<?php endif; ?>
				data-rule-required="true" 
				data-msg-required="<?php echo app('translator')->get('validation.custom-messages.this_field_is_required'); ?>" 
				<?php if($product->enable_stock && empty($pos_settings['allow_overselling']) && empty($is_sales_order) && empty($is_quotation)): ?>
					data-rule-max-value="<?php echo e($max_qty_rule, false); ?>" data-qty_available="<?php echo e($product->qty_available, false); ?>" data-msg-max-value="<?php echo e($max_qty_msg, false); ?>" 
					data-msg_max_default="<?php echo app('translator')->get('validation.custom-messages.quantity_not_available', ['qty'=> $product->formatted_qty_available, 'unit' => $product->unit  ]); ?>" 
				<?php endif; ?> 
				<?php if($disable_qty): ?> readonly <?php endif; ?>
			>
			<?php if(empty($common_settings['sale_inline_ui_slim'])): ?>
			<span class="input-group-btn d-none d-md-inline">
				<button type="button" class="btn btn-default btn-flat quantity-up" <?php if($disable_qty): ?> disabled <?php endif; ?>><i class="fa fa-plus text-success"></i></button>
			</span>
			<?php endif; ?>

			<?php if(!empty($common_settings['sale_inline_ui_slim'])): ?>
			<?php if(count($sub_units) > 0): ?>
				<select name="products[<?php echo e($row_count, false); ?>][sub_unit_id]" class="form-control input-sm sub_unit inline-select <?php if($pos_settings['hide_quantity_unit']): ?> hide <?php endif; ?>" <?php if($disable_qty_unit): ?> style="pointer-events: none;background-color:#F5F5F5;" <?php endif; ?>>
					<?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($key, false); ?>" data-multiplier="<?php echo e($value['multiplier'], false); ?>" data-unit_name="<?php echo e($value['name'], false); ?>" data-allow_decimal="<?php echo e($value['allow_decimal'], false); ?>" <?php if(!empty($product->sub_unit_id) && $product->sub_unit_id == $key): ?> selected <?php endif; ?>>
							<?php echo e($value['short_name'] ?? $value['name'], false); ?>

					</option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			<?php endif; ?>
			<?php endif; ?>
				
		</div>
		
		<input type="hidden" name="products[<?php echo e($row_count, false); ?>][product_unit_id]" value="<?php echo e($product->unit_id, false); ?>">
		
		<?php if(empty($common_settings['sale_inline_ui_slim'])): ?>
		<?php if(count($sub_units) > 0): ?>
			<br>
			<select name="products[<?php echo e($row_count, false); ?>][sub_unit_id]" class="form-control input-sm sub_unit <?php if($pos_settings['hide_quantity_unit']): ?> hide  <?php endif; ?>" <?php if($disable_qty_unit): ?> style="pointer-events: none;background-color:#F5F5F5;" <?php endif; ?>>
                <?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key, false); ?>" data-multiplier="<?php echo e($value['multiplier'], false); ?>" data-unit_name="<?php echo e($value['name'], false); ?>" data-allow_decimal="<?php echo e($value['allow_decimal'], false); ?>" <?php if(!empty($product->sub_unit_id) && $product->sub_unit_id == $key || !empty($so_line->sub_unit_id) && $so_line->sub_unit_id == $key): ?> selected <?php endif; ?>>
                        <?php echo e($value['name'], false); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           </select>
		<?php else: ?>
			<?php echo e($product->unit, false); ?>

		<?php endif; ?>
		<?php endif; ?>

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

		<input type="hidden" class="base_unit_multiplier" name="products[<?php echo e($row_count, false); ?>][base_unit_multiplier]" value="<?php echo e($multiplier, false); ?>">

		<?php if(!empty($so_line->sub_unit_id)): ?>
			<input type="hidden" class="hidden_base_unit_sell_price" value="<?php echo e($product->default_sell_price * $multiplier / $exchange_rate, false); ?>">
		<?php else: ?>
			<input type="hidden" class="hidden_base_unit_sell_price" value="<?php echo e($product->default_sell_price / $multiplier / $exchange_rate, false); ?>">
		<?php endif; ?>
		
		<?php if((!empty($user_settings['warn_if_sale_price_low']) || !empty($user_settings['block_if_sale_price_low'])) && !empty($product->default_purchase_price)): ?>
			<input type="hidden" class="default_purchase_price" value="<?php echo e($product->default_purchase_price / $exchange_rate, false); ?>">
			<?php if(!empty($user_settings['ps_show_purchase_price'])): ?>
				<div class="alert alert-danger p-4 mt-5 hide underprice_warning">Selling Price Less than Cost Price : <?php echo e(number_format($product->default_purchase_price / $exchange_rate, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></div>
			<?php else: ?>
				<div class="alert alert-danger p-4 mt-5 hide underprice_warning">Selling Price is too low</div>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php if($product->product_type == 'combo'&& !empty($product->combo_products)): ?>

			<?php $__currentLoopData = $product->combo_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $combo_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<?php if(isset($action) && $action == 'edit'): ?>
					<?php
						$combo_product['qty_required'] = $combo_product['quantity'] / $product->quantity_ordered;

						$qty_total = $combo_product['quantity'];
					?>
				<?php else: ?>
					<?php
						$qty_total = $combo_product['qty_required'];
					?>
				<?php endif; ?>

				<input type="hidden" 
					name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][product_id]"
					value="<?php echo e($combo_product['product_id'], false); ?>">

					<input type="hidden" 
					name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][variation_id]"
					value="<?php echo e($combo_product['variation_id'], false); ?>">

					<input type="hidden"
					class="combo_product_qty" 
					name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][quantity]"
					data-unit_quantity="<?php echo e($combo_product['qty_required'], false); ?>"
					value="<?php echo e($qty_total, false); ?>">

					<?php if(isset($action) && $action == 'edit'): ?>
						<input type="hidden" 
							name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][transaction_sell_lines_id]"
							value="<?php echo e($combo_product['id'], false); ?>">
					<?php endif; ?>

			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
	</td>
	
	<?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
	<?php if(auth()->user()->can('enable_scheme_quantity_column')): ?>
	<?php
		if(empty($product->foc_quantity) && (!empty($so_line) && !empty($so_line->foc_quantity))){
			$product->foc_quantity = $so_line->foc_quantity;
		}
	?>
	<td>
		<div class="input-group input-number">
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
		<br>
		<?php if(count($sub_units) > 0): ?>
			<br>
			<select name="products[<?php echo e($row_count, false); ?>][foc_sub_unit_id]" class="form-control input-sm foc_sub_unit <?php if($pos_settings['hide_quantity_unit']): ?> hide  <?php endif; ?>" 
			<?php if(auth()->user()->id != session()->get('business.owner_id') && auth()->user()->can('disable_editable_scheme_quantity')): ?> readonly <?php endif; ?>>
                <?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key, false); ?>" data-multiplier="<?php echo e($value['multiplier'], false); ?>" data-unit_name="<?php echo e($value['name'], false); ?>" data-allow_decimal="<?php echo e($value['allow_decimal'], false); ?>" <?php if(!empty($product->foc_sub_unit_id) && $product->foc_sub_unit_id == $key || !empty($so_line->foc_sub_unit_id) && $so_line->foc_sub_unit_id == $key): ?> selected <?php endif; ?>>
                        <?php echo e($value['name'], false); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           </select>
		<?php else: ?>
			<?php echo e($product->unit, false); ?>

		<?php endif; ?>

		<?php if(!empty($product->second_unit)): ?>
            <br>
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
				<div class="mb-3">
					<div class="input-group">
						<?php echo Form::select("products[" . $row_count . "][res_service_staff_id]", $waiters, !empty($product->res_service_staff_id) ? $product->res_service_staff_id : null, ['class' => 'form-control select2 order_line_service_staff', 'placeholder' => __('restaurant.select_service_staff'), 'required' => (!empty($pos_settings['is_service_staff_required']) && $pos_settings['is_service_staff_required'] == 1) ? true : false ]); ?>

					</div>
				</div>
			</td>
		<?php endif; ?>
		<?php
			$pos_unit_price = !empty($product->unit_price_before_discount) ? $product->unit_price_before_discount : $product->default_sell_price;
			$pos_unit_price = $pos_unit_price / $exchange_rate;

			if(!empty($so_line) && $action !== 'edit') {
				$pos_unit_price = $so_line->unit_price_before_discount / $exchange_rate;
			}
			$use_sp_as_min = !empty($product->use_sp_as_min) ? $product->use_sp_as_min : $pos_unit_price;
		?>
		<td class="text-end <?php if(!auth()->user()->can('edit_product_price_from_sale_screen')): ?> hide <?php endif; ?>">
			<input type="text" name="products[<?php echo e($row_count, false); ?>][unit_price]" class="form-control pos_unit_price input_number mousetrap" 
			value="<?php echo e(number_format($pos_unit_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" <?php if(!empty($pos_settings['enable_msp'])): ?> data-rule-min-value="<?php echo e($use_sp_as_min, false); ?>" 
			data-msg-min-value="<?php echo e(__('lang_v1.minimum_selling_price_error_msg', ['price' => number_format($use_sp_as_min, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])]), false); ?>" <?php endif; ?>
			<?php if(empty($is_direct_sell)): ?> readonly <?php endif; ?> <?php if(!$edit_price): ?> readonly <?php endif; ?>> 
			<?php if(!empty($last_sell_line) && !empty($is_direct_sell)): ?>
				<br>
				<small class="text-muted"><?php echo app('translator')->get('lang_v1.prev_unit_price'); ?>: <?php echo e(number_format($last_sell_line->unit_price_before_discount / $exchange_rate, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></small>
			<?php endif; ?>
		</td>

		<?php if(!empty($common_settings['enable_inline_discount_sales'])): ?>
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
				<?php if(!empty($common_settings['sale_inline_ui_slim'])): ?>
				<div class="multi-input input-number">
				<?php endif; ?>

				<?php echo Form::text("products[$row_count][line_discount_amount]", number_format($discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number row_discount_amount', 
					'readonly' => !$edit_discount,
					'data-default' => '0',
					'data-max-discount' => $max_discount,
					'data-max-discount-error_msg' => __('lang_v1.max_inline_discount_error_msg', ['discount' => $max_discount != '' ? number_format($max_discount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '',])]); ?>

				<?php if(!empty($common_settings['sale_inline_ui_slim'])): ?>
					<?php echo Form::select("products[$row_count][line_discount_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $discount_type , ['class' => 'form-control input-sm row_discount_type inline-select', 'disabled' => !$edit_discount]); ?>

				<?php else: ?>
					<br>
					<?php echo Form::select("products[$row_count][line_discount_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $discount_type , ['class' => 'form-control row_discount_type', 'disabled' => !$edit_discount]); ?>


					<?php if(!empty($discount)): ?>
						<p class="help-block"><?php echo __('lang_v1.applied_discount_text', ['discount_name' => $discount->name, 'starts_at' => $discount->formated_starts_at, 'ends_at' => $discount->formated_ends_at]); ?></p>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(!empty($common_settings['sale_inline_ui_slim'])): ?>
				</div>
				<?php endif; ?>

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

		<?php if(!empty($common_settings['enable_inline_discount2_sales'])): ?>
		<?php
			$max_discount2 = !is_null(auth()->user()->max_sales_discount_percent) ? auth()->user()->max_sales_discount_percent : '';
			//if sale discount is more than user max discount change it to max discount
			$sales_discount = $business_details->default_sales_discount;
			if ($max_discount2 != '' && $sales_discount > $max_discount2) {
				$sales_discount = $max_discount2;
			}
			$default_sales_tax = $business_details->default_sales_tax;
			if ($sale_type == 'sales_order') {
				$sales_discount = 0;
				$default_sales_tax = null;
			}
		?>
			
			<td>
				<?php if(!empty($common_settings['sale_inline_ui_slim'])): ?>
				<div class="multi-input input-number">
				<?php endif; ?>

				<?php echo Form::text("products[$row_count][line_discount2_amount]", number_format($discount2_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number row_discount2_amount',
					'readonly' => !$edit_discount,
					'data-default' => '0',
					'data-max-discount' => $max_discount,
					'data-max-discount-error_msg' => __('lang_v1.max_inline_discount_error_msg', ['discount' => $max_discount2 != '' ? number_format($max_discount2, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '',])]); ?>

				<?php if(!empty($common_settings['sale_inline_ui_slim'])): ?>
					<?php echo Form::select("products[$row_count][line_discount2_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $discount2_type , ['class' => 'form-control input-sm row_discount2_type inline-select', 'disabled' => !$edit_discount]); ?>

				<?php else: ?>
					<br>
					<?php echo Form::select("products[$row_count][line_discount2_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $discount2_type , ['class' => 'form-control row_discount2_type', 'disabled' => !$edit_discount]); ?>

				<?php endif; ?>

				<?php if(!empty($common_settings['sale_inline_ui_slim'])): ?>
				</div>
				<?php endif; ?>

				<?php if(!empty($last_sell_line) && !empty($is_direct_sell)): ?>
					<br>
					<small class="text-muted">
						<?php echo app('translator')->get('lang_v1.prev_discount'); ?>: 
						<?php if($last_sell_line->line_discount2_type == 'percentage'): ?>
							<?php echo e(number_format($last_sell_line->line_discount2_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>%
						<?php else: ?>
							<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $last_sell_line->line_discount2_amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
						<?php endif; ?>
					</small>
				<?php endif; ?>
			</td>
		<?php endif; ?>

		<?php if(!empty($common_settings['enable_inline_discount_sales']) || !empty($common_settings['enable_inline_discount2_sales'])): ?>
			
			<td class="text-end">
				<?php
				$sp_after_discount = $pos_unit_price;
				if($discount_type == 'fixed'){
					$sp_after_discount = $pos_unit_price - $discount_amount;
				}elseif ($discount_type == 'percentage'){ 
					$sp_discount = $pos_unit_price * ($discount_amount / 100);
					$sp_after_discount = $pos_unit_price - $sp_discount;
				}

				if(!empty($discount2_amount)){
					if($discount2_type == 'fixed'){
						$sp_after_discount = $sp_after_discount - $discount2_amount;
					}elseif ($discount2_type == 'percentage'){ 
						$sp_discount = $pos_unit_price * ($discount2_amount / 100);
						$sp_after_discount = $sp_after_discount - $sp_discount;
					}
				}
				
				?>
				<input type="hidden" class='pos_unit_price_after_discount_hidden' value="<?php echo e($sp_after_discount, false); ?>">
				<span class="pos_unit_price_after_discount"><?php echo e(number_format($sp_after_discount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
			</td>
		<?php endif; ?>

		<?php if(!empty($common_settings['enable_inline_tax_sales'])): ?>
		<td class="text-center <?php echo e($hide_tax, false); ?>">
			
			<?php echo Form::select("products[$row_count][tax_id]", $tax_dropdown['tax_rates'], $tax_id, ['class' => 'form-control sell_line_tax_id'], $tax_dropdown['attributes']); ?>

			<?php echo Form::hidden("products[$row_count][item_tax]", number_format($item_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'item_tax']); ?>

			<?php echo Form::hidden("products[$row_count][tax_not_applicable]", $product->tax_not_applicable, ['class' => 'inline_tax_not_applicable']); ?>

			<?php if(empty($common_settings['sale_inline_ui_slim'])): ?>
			<?php if(!empty($is_direct_sell)): ?>
				<br>
				<b>Unit Tax: </b>
				<span class="sell_product_unit_tax_text"><?php echo e(number_format($item_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span><br>
				<b>Line Total: </b>
				<span class="sell_product_unit_total_tax_text"><?php echo e(number_format($product->quantity_ordered * $item_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
				<?php else: ?>
				<b>Unit Tax: </b>
				<span class="sell_product_unit_tax_text"><?php echo e(number_format($item_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
			<?php endif; ?>
			<?php endif; ?>
		</td>
		<?php endif; ?>

	<?php else: ?>
		<?php if(!empty($pos_settings['inline_service_staff'])): ?>
			<td>
				<div class="form-group inline">
					<div class="input-group">
						<?php echo Form::select("products[" . $row_count . "][res_service_staff_id]", $waiters, !empty($product->res_service_staff_id) ? $product->res_service_staff_id : null, ['class' => 'form-control select2 order_line_service_staff', 'placeholder' => __('restaurant.select_service_staff'), 'required' => (!empty($pos_settings['is_service_staff_required']) && $pos_settings['is_service_staff_required'] == 1) ? true : false ]); ?>

					</div>
				</div>
			</td>
		<?php endif; ?>
	<?php endif; ?>
	<?php
			$edit_price = !empty($pos_settings['is_pos_unit_price_editable']) ? true : false;
	?>
	<td class="text-end <?php echo e($hide_tax, false); ?>">
		
		<input type="text" name="products[<?php echo e($row_count, false); ?>][unit_price_inc_tax]" class="form-control pos_unit_price_inc_tax input_number" value="<?php echo e(number_format($unit_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" readonly <?php if(!empty($pos_settings['enable_msp'])): ?> data-rule-min-value="<?php echo e($use_sp_as_min, false); ?>" data-msg-min-value="<?php echo e(__('lang_v1.minimum_selling_price_error_msg', ['price' => number_format($use_sp_as_min, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])]), false); ?>" <?php endif; ?>>
		<input type="hidden" value="<?php echo e($product->tax_type, false); ?>" class="item_tax_type">
		<?php if(empty($common_settings['sale_inline_ui_slim'])): ?>
				
		<?php if(!empty($common_settings['sell_enable_inline_group_price']) && !empty($price_groups) && !empty($user_settings['ps_show_price_group'])): ?>
			<br>
			<div class="input-group">
				<?php echo Form::select("products[" . $row_count . "][price_group]", $price_groups, !empty($default_price_group_id) ? $default_price_group_id : null, ['class' => 'form-control select2 sell_line_price_group', ], $price_groups_price); ?>

			</div>
		<?php endif; ?>
		<?php endif; ?>
	</td>
	<?php if(!empty($common_settings['enable_product_warranty']) && !empty($is_direct_sell)): ?>
		<td>
			<?php echo Form::select("products[$row_count][warranty_id]", $warranties, $warranty_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control']); ?>

		</td>
	<?php endif; ?>

	
	
	<td class="text-end">
		<?php
			$edit_subtotal = auth()->user()->can('edit_product_subtotal_from_sale_screen') ? true : false;
			$subtotal_type = $edit_subtotal ? 'text' : 'hidden';
		?>
		<input type="<?php echo e($subtotal_type, false); ?>" class="form-control pos_line_total <?php if(!empty($pos_settings['is_pos_subtotal_editable'])): ?> input_number <?php endif; ?>" value="<?php echo e(number_format($product->quantity_ordered*$unit_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
		<span class="display_currency pos_line_total_text <?php if($edit_subtotal): ?> hide <?php endif; ?>" data-currency_symbol="false"><?php echo e($product->quantity_ordered*$unit_price_inc_tax, false); ?></span>
	</td>
	
	<?php if(!empty($is_direct_sell)): ?>

		<?php if(!empty($common_settings['enable_inline_profit_sales'])): ?>
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
		<?php endif; ?>

		<td class="text-center <?php if(empty($user_settings['enable_inline_cost_sales'])): ?> hide <?php endif; ?>">
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
	
	<td class="text-center v-center">
		<i class="fa fa-times text-danger pos_remove_row cursor-pointer" aria-hidden="true"></i>
	</td>
	
</tr>
