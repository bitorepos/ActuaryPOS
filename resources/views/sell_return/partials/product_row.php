<tr class="product_row">
	<?php
		$hide_discount = '';
		if (session()->get('business.common_settings.enable_inline_discount_sales') == 0) {
			$hide_discount = 'hide';
		}
		$hide_discount2 = '';
		if (session()->get('business.common_settings.enable_inline_discount2_sales') == 0) {
			$hide_discount2 = 'hide';
		}
		$hide_tax = '';
		if (session()->get('business.common_settings.enable_inline_tax_sales') == 0 || $tax_dropdown['tax_rates']->count() <= 1) {
			$hide_tax = 'hide';
		}
		$discount_type = !empty($product->line_discount_type) ? $product->line_discount_type : (!empty(session()->get('business.common_settings.default_item_discount_type')) ? session()->get('business.common_settings.default_item_discount_type') : 'percentage');
		$discount_amount = !empty($product->line_discount_amount) ? $product->line_discount_amount : 0;
		$discount2_type = !empty($product->line_discount2_type) ? $product->line_discount2_type : (!empty(session()->get('business.common_settings.default_item_discount2_type')) ? session()->get('business.common_settings.default_item_discount2_type') : 'fixed');
		$discount2_amount = !empty($product->line_discount2_amount) ? $product->line_discount2_amount : 0;
		if($product->unit_price_before_discount){
			$product->default_sell_price = $product->unit_price_before_discount;
		}
	?>
	<td><span class="sr_number"></span></td>
	<td class="text-center"><?php echo e($product->sub_sku, false); ?></td>
	<td>
		<?php if(empty($product->name)): ?><?php echo e($product->product_name, false); ?><?php else: ?><?php echo e($product->name, false); ?><?php endif; ?>
		&nbsp;
		<input type="hidden" class="enable_sr_no" value="<?php echo e($product->enable_sr_no, false); ?>">
		<input type="hidden" name="products[<?php echo e($row_count, false); ?>][product_type]" value="<?php echo e($product->product_type, false); ?>">
		<?php
			$sell_line_note = '';
			if(!empty($product->sell_line_note)){
				$sell_line_note = $product->sell_line_note;
			}
		?>
		<br>
		<a href="javascript:void(0)" class="toggle-product-note" title="<?php echo app('translator')->get('lang_v1.product_note'); ?>">
			<i class="fa <?php echo e(!empty($sell_line_note) ? 'fa-minus-circle text-danger' : 'fa-plus-circle text-success', false); ?>"></i>
			<small><?php echo app('translator')->get('lang_v1.product_note'); ?></small>
		</a>
		<div class="product-note-wrapper" style="<?php echo e(empty($sell_line_note) ? 'display:none;' : '', false); ?>">
			<textarea class="form-control" name="products[<?php echo e($row_count, false); ?>][sell_line_note]" rows="2"><?php echo e($sell_line_note, false); ?></textarea>
		</div>
	</td>
	<?php if(!empty($user_settings['sale_show_brand_column'])): ?>
	<td> <?php echo e($product->brand, false); ?></td>
	<?php endif; ?>

	<?php if(!empty($user_settings['sale_show_category_column'])): ?>
	<td> <?php echo e($product->category, false); ?></td>
	<?php endif; ?>
	
	<td class="text-end">
		<input type="text" name="products[<?php echo e($row_count, false); ?>][unit_price]" class="form-control pos_unit_price input_number mousetrap" value="<?php echo e(number_format($product->default_sell_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
		<?php if(!empty($last_sell_line)): ?>
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
	<td class="<?php echo e($hide_discount, false); ?>">
		<?php echo Form::text("products[$row_count][line_discount_amount]", number_format($discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number row_discount_amount',
					'data-default' => '0',
					'data-max-discount' => $max_discount,
					'data-max-discount-error_msg' => __('lang_v1.max_inline_discount_error_msg', ['discount' => $max_discount != '' ? number_format($max_discount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '',])]); ?><br>		
		<?php echo Form::select("products[$row_count][line_discount_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $discount_type , ['class' => 'form-control row_discount_type']); ?>

		<?php if(!empty($discount)): ?>
			<p class="help-block"><?php echo __('lang_v1.applied_discount_text', ['discount_name' => $discount->name, 'starts_at' => $discount->formated_starts_at, 'ends_at' => $discount->formated_ends_at]); ?></p>
		<?php endif; ?>
		<?php if(!empty($last_sell_line) && !empty($last_sell_line->line_discount_amount)): ?>
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
	</td>
	<td class="<?php echo e($hide_discount2, false); ?>">
		<?php echo Form::text("products[$row_count][line_discount2_amount]", number_format($discount2_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number row_discount2_amount',
					'data-default' => '0',
					'data-max-discount' => $max_discount,
					'data-max-discount-error_msg' => __('lang_v1.max_inline_discount_error_msg', ['discount' => $max_discount != '' ? number_format($max_discount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '',])]); ?><br>		
		<?php echo Form::select("products[$row_count][line_discount2_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $discount2_type , ['class' => 'form-control row_discount2_type']); ?>

		<?php if(!empty($last_sell_line) && !empty($last_sell_line->line_discount2_amount)): ?>
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
	<td class="text-end <?php echo e($hide_discount, false); ?>">
		<?php
			if($discount_type == 'fixed'){
				$sp_after_discount = $product->default_sell_price - $discount_amount;
			}elseif ($discount_type == 'percentage'){ 
				$sp_discount = $product->default_sell_price * ($discount_amount / 100);
				$sp_after_discount = $product->default_sell_price- $sp_discount;
			}

			if($discount2_type == 'fixed'){
				$sp_after_discount -= $discount2_amount;
			}elseif ($discount2_type == 'percentage'){
				$sp_discount = $product->default_sell_price * ($discount2_amount / 100);
				$sp_after_discount = $sp_after_discount - $sp_discount;
			}
		?>
		<input type="hidden" class='pos_unit_price_after_discount_hidden' name="products[<?php echo e($row_count, false); ?>][pos_unit_price_after_discount]" value="<?php echo e($sp_after_discount, false); ?>">
		<span class="pos_unit_price_after_discount"><?php echo e(number_format($sp_after_discount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
	</td>
	<?php    
		$tax_id = $product->tax_id;
		$unit_price_inc_tax = $product->sell_price_inc_tax;
		if($hide_tax == 'hide'){
			$tax_id = null;
			$unit_price_inc_tax = $sp_after_discount;
		}
	?>
	<td class="<?php echo e($hide_tax, false); ?>">
		<?php
			if($hide_tax == 'hide'){
				$item_tax = 0;
			}elseif(!empty($product->item_tax)){
				$item_tax = $product->item_tax;
			}else{
				$item_tax = $product->sell_price_inc_tax - $product->default_sell_price;
			}
		?>
		<input type="hidden" name="products[<?php echo e($row_count, false); ?>][item_tax]" class="form-control item_tax" value="<?php echo e($item_tax, false); ?>">
		<?php echo Form::select("products[$row_count][tax_id]", $tax_dropdown['tax_rates'], $tax_id, ['placeholder' => 'Select', 'class' => 'form-control tax_id'], $tax_dropdown['attributes']); ?>

	</td>
	<td class="text-end <?php echo e($hide_tax, false); ?>">
		<input type="text" name="products[<?php echo e($row_count, false); ?>][unit_price_inc_tax]" class="form-control pos_unit_price_inc_tax input_number" value="<?php echo e(number_format($unit_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
	</td>
	
	<td>
		<?php echo Form::select("products[$row_count][line_return_status]", ['normal' => 'Normal', 'damage' => 'Damage'], !empty($product->line_return_status) ? $product->line_return_status : 'normal', ['class' => 'form-control input-sm', ]); ?>

	</td>
	<td>
		<input type="hidden" name="products[<?php echo e($row_count, false); ?>][product_id]" class="form-control product_id" value="<?php echo e($product->product_id, false); ?>">

		<input type="hidden" value="<?php echo e($product->variation_id, false); ?>" 
			name="products[<?php echo e($row_count, false); ?>][variation_id]" class="row_variation_id">

		<input type="hidden" value="<?php echo e($product->enable_stock, false); ?>" 
			name="products[<?php echo e($row_count, false); ?>][enable_stock]">
		<?php if(!empty($product->transaction_sell_lines_id)): ?>
			<input type="hidden" name="products[<?php echo e($row_count, false); ?>][sell_line_id]" value="<?php echo e($product->transaction_sell_lines_id, false); ?>">
		<?php endif; ?>
		
		<?php if(empty($product->quantity_ordered)): ?>
			<?php
				$product->quantity_ordered = 1;
			?>
		<?php endif; ?>
		<div class="input-group input-number">
		<span class="input-group-btn d-none d-md-inline"><button type="button" class="btn btn-default btn-flat quantity-down"><i class="fa fa-minus text-danger"></i></button></span>
		<input type="text" class="form-control pos_quantity input_number mousetrap" value="<?php echo e(number_format($product->quantity_ordered, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" name="products[<?php echo e($row_count, false); ?>][quantity]" 
		<?php if($product->unit_allow_decimal == 1): ?> data-decimal=1 <?php else: ?> data-decimal=0 data-rule-abs_digit="true" data-msg-abs_digit="<?php echo app('translator')->get('lang_v1.decimal_value_not_allowed'); ?>" <?php endif; ?>
		data-rule-required="true" data-msg-required="<?php echo app('translator')->get('validation.custom-messages.this_field_is_required'); ?>" >
		<span class="input-group-btn d-none d-md-inline"><button type="button" class="btn btn-default btn-flat quantity-up"><i class="fa fa-plus text-success"></i></button></span>
		</div>
		<?php echo e($product->unit, false); ?>

		
		<?php if(($product->product_type == 'combo' || $product->product_type == 'Package') && !empty($product->combo_products)): ?>
		<?php $__currentLoopData = $product->combo_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $combo_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php
				$quantity_id = $k+1;
			?>

			<input type="hidden" name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][name]" value="<?php echo e($combo_product['product_name'], false); ?>">
			<input type="hidden" name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][product_id]" value="<?php echo e($combo_product['product_id'], false); ?>">
			<input type="hidden" name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][variation_id]" value="<?php echo e($combo_product['variation_id'], false); ?>">
			<?php if($edit): ?>
			<input type="hidden" id="<?php echo e($quantity_id, false); ?>" class="combo_product_qty" name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][quantity]" data-unit_quantity="<?php echo e($combo_product['qty_required'], false); ?>" value="<?php echo e(number_format($combo_product['qty_returned'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
			<?php else: ?>
			<input type="hidden" id="<?php echo e($quantity_id, false); ?>" class="combo_product_qty" name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][quantity]" data-unit_quantity="<?php echo e($combo_product['qty_required'], false); ?>" value="<?php echo e(number_format($combo_product['qty_required'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
			<?php endif; ?>
			<input type="hidden" name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][price]" value="<?php echo e($combo_product['price'], false); ?>">
			<input type="hidden" name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][sell_line_id]" value="<?php echo e($combo_product['id'], false); ?>">

		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>
	</td>
	<td class="text-end">
		<input type="hidden" class="form-control pos_line_total" value="<?php echo e(number_format($product->quantity_ordered*$unit_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
		<span class="display_currency pos_line_total_text <?php if(!empty($pos_settings['is_pos_subtotal_editable'])): ?> hide <?php endif; ?>" data-currency_symbol="false"><?php echo e(number_format($product->quantity_ordered*$unit_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
	</td>
	<td class="text-center">
		<i class="fa fa-trash pos_remove_row cursor-pointer" aria-hidden="true"></i>
	</td>
</tr>
<?php if(!$edit): ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('input.expiry_datepicker').datepicker({
        	autoclose: true,
        	format:datepicker_date_format
    	});
	});
</script>
<?php endif; ?>
