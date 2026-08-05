<?php $__currentLoopData = $purchase_requisition->purchase_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php if($purchase_line->quantity - $purchase_line->po_quantity_purchased > 0): ?>
		<?php echo $__env->make('purchase.partials.purchase_entry_row', [
			'variations' => [$purchase_line->variations],
			'product' => $purchase_line->product,
			'row_count' => $row_count,
			'variation_id' => $purchase_line->variation_id,
			'taxes' => $taxes,
			'currency_details' => $currency_details,
			'hide_tax' => $hide_tax,
			'sub_units' => $sub_units_array[$purchase_line->id],
			'purchase_requisition_line' => $purchase_line,
			'purchase_requisition' => $purchase_requisition
		], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php
			$row_count++;
		?>
	<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
