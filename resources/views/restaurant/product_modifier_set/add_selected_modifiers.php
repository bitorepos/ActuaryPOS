<?php if(empty($edit_modifiers)): ?>
<small>
	<?php $__currentLoopData = $modifiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="product_modifier">
		<?php echo e($modifier->name, false); ?>(<span class="modifier_price_text"><?php echo e(number_format($modifier->sell_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span> X <span class="modifier_qty_text"><?php echo e(number_format($quantity, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>)
		<input type="hidden" name="products[<?php echo e($index, false); ?>][modifier][]" 
			value="<?php echo e($modifier->id, false); ?>">
		<input type="hidden" class="modifiers_price" 
			name="products[<?php echo e($index, false); ?>][modifier_price][]" 
			value="<?php echo e(number_format($modifier->sell_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
		<input type="hidden" class="modifiers_quantity" 
			name="products[<?php echo e($index, false); ?>][modifier_quantity][]" 
			value="<?php echo e($quantity, false); ?>">
		<input type="hidden" 
			name="products[<?php echo e($index, false); ?>][modifier_set_id][]" 
			value="<?php echo e($modifier->product_id, false); ?>">
		</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</small>
<?php else: ?>
	<?php $__currentLoopData = $modifiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="product_modifier">
		<?php echo e($modifier->variations->name ?? '', false); ?>(<span class="modifier_price_text"><?php echo e(number_format($modifier->unit_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span> X <span class="modifier_qty_text"><?php echo e(number_format($modifier->quantity, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>)
		<input type="hidden" name="products[<?php echo e($index, false); ?>][modifier][]" 
			value="<?php echo e($modifier->variation_id, false); ?>">
		<input type="hidden" class="modifiers_price" 
			name="products[<?php echo e($index, false); ?>][modifier_price][]" 
			value="<?php echo e(number_format($modifier->unit_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
		<input type="hidden" class="modifiers_quantity" 
			name="products[<?php echo e($index, false); ?>][modifier_quantity][]" 
			value="<?php echo e($modifier->quantity, false); ?>">
		<input type="hidden" 
			name="products[<?php echo e($index, false); ?>][modifier_set_id][]" 
			value="<?php echo e($modifier->product_id, false); ?>">
		<input type="hidden" 
			name="products[<?php echo e($index, false); ?>][modifier_sell_line_id][]" 
			value="<?php echo e($modifier->id, false); ?>">
		</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
