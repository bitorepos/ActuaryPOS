<?php
	$quantity = isset($quantity) ? $quantity: 1;
	$multiplier = isset($multiplier) ? $multiplier: 1;
	$unit_id = isset($unit_id) ? $unit_id: null;
?>

<?php $__currentLoopData = $variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
		<td class="text-center">
			<?php if($product->type == 'variable'): ?>
				<?php echo e($product->name, false); ?> (<?php echo e($variation->name, false); ?>) - <?php echo e($variation->sub_sku, false); ?>

				<?php else: ?>
					<?php echo e($product->name, false); ?> - <?php echo e($variation->sub_sku, false); ?>

				<?php endif; ?>

				<input type="hidden" name="composition_variation_id[]" value="<?php echo e($variation->id, false); ?>">
		</td>
		<td class="text-center">
			<div class="d-flex align-items-center justify-content-center gap-1">
				<?php echo Form::text('quantity[]', number_format($quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control col-sm-12 input-sm quantity input_quantity input_number mousetrap', 'required', 'style '=> "width: 77px"]); ?>


				<?php if(!empty($sub_units)): ?>
					<select name="unit[]" 
						class="form-control input-sm sub_unit" style="width: auto; min-width: 60px;">
						<?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($key, false); ?>" 
							   data-multiplier="<?php echo e($value['multiplier'], false); ?>"
							   <?php if($unit_id == $key): ?> selected <?php endif; ?>
							>
								<?php echo e($value['short_name'], false); ?>

							</option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				<?php else: ?> 
					<input type="hidden" name="unit[]" value="<?php echo e($product->unit->id, false); ?>">
					<span class="text-muted"><?php echo e($product->unit->short_name, false); ?></span>
				<?php endif; ?>
			</div>
		</td>
		<td class="text-center">
			<span class="purchase_price display_currency purchase_price_text" data-currency_symbol="true">
				<?php echo e($variation->default_purchase_price, false); ?>

			</span>
			<input type="hidden" class="purchase_price" value="<?php echo e($variation->default_purchase_price, false); ?>">
		</td>
		<td class="text-center">
			<span class="item_level_purchase_price display_currency" data-currency_symbol="true">
				<?php echo e($variation->default_purchase_price * $quantity * $multiplier, false); ?>

			</span>
			<input type="hidden" class="item_level_purchase_price" value="<?php echo e($variation->default_purchase_price * $quantity * $multiplier, false); ?>">
		</td>
		<td class="text-center">
			<span>
				<i class="fa fa-times remove_combo_product_entry_row text-danger" title="Remove" style="cursor:pointer;"></i>
			</span>
		</td>
	</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
