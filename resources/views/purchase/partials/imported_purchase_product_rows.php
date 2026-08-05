<?php $__currentLoopData = $formatted_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php echo $__env->make('purchase.partials.purchase_entry_row', [
		'variations' => [$data['variation']],
		'product' => $data['product'],
		'row_count' => $row_count,
		'variation_id' => $data['variation']->id,
		'taxes' => $taxes,
		'currency_details' => $currency_details,
		'hide_tax' => $hide_tax,
		'sub_units' => $data['sub_units'],
		'imported_data' =>  $data
	], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php
		$row_count++;
	?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
