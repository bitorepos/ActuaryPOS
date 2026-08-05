<table>
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php
		$check_decimal = $product->allow_decimal;
		$check_decimal_second_unit = $product->su_allow_decimal;
	?>
	<tr data-variation_id="<?php echo e($product->variation_id, false); ?>">
		<td>
			<?php echo e($product->product, false); ?>

			<?php if($product->type == 'single'): ?>
			 (<?php echo e($product->sku, false); ?>)
			<?php else: ?>
				- <?php echo e($product->product_variation, false); ?> - <?php echo e($product->variation, false); ?> (<?php echo e($product->sub_sku, false); ?>)
			<?php endif; ?>
			<p class="help-block"><?php echo app('translator')->get('report.current_stock'); ?>: <?php echo e(number_format($product->stock, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($product->unit, false); ?></p>
		</td>
		<td><?php echo e(number_format($product->alert_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($product->unit, false); ?></td>
		<td>
			<div class="input-group">
				<input type="hidden" name="purchases[<?php echo e($product->variation_id, false); ?>][product_id]" 
                value="<?php echo e($product->product_id, false); ?>">
                <input type="hidden" name="purchases[<?php echo e($product->variation_id, false); ?>][variation_id]" 
                value="<?php echo e($product->variation_id, false); ?>">
				<input type="text" 
                name="purchases[<?php echo e($product->variation_id, false); ?>][quantity]" 
                value="0"
                class="form-control input-sm input_number mousetrap"
                required
                data-rule-abs_digit=<?php echo e($check_decimal, false); ?>

                data-msg-abs_digit="<?php echo e(__('lang_v1.decimal_value_not_allowed'), false); ?>">
            	<div class="input-group-text">
            		<?php echo e($product->unit, false); ?>

            	</div>
			</div>

			<?php if(!empty($product->second_unit)): ?>
				<br>
				<label><?php echo app('translator')->get('lang_v1.second_quantity'); ?></label>
				<div class="input-group">
					<input type="text" 
	                name="purchases[<?php echo e($product->variation_id, false); ?>][secondary_unit_quantity]" 
	                value="0"
	                class="form-control input-sm input_number mousetrap"
	                required
	                data-rule-abs_digit=<?php echo e($check_decimal_second_unit, false); ?>

	                data-msg-abs_digit="<?php echo e(__('lang_v1.decimal_value_not_allowed'), false); ?>">
	            	<div class="input-group-text">
	            		<?php echo e($product->second_unit, false); ?>

	            	</div>
				</div>
			<?php endif; ?>
		</td>
		<td>
			<button type="button" class="btn btn-danger btn-sm remove_product_line"><i class="fas fa-times"></i></button>
		</td>
	</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
