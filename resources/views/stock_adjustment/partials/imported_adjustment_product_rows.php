<?php $__currentLoopData = $formatted_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	<?php echo $__env->make('stock_adjustment.partials.product_table_row', [
		'product' => $data['product'],
		'row_index' => $row_index,
		'sub_units' => $data['sub_units'],
		'pos_settings' => $pos_settings,
		'user_settings' => $user_settings,
		'show_stock_take' => $show_stock_take,
	], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<?php
		$row_index++;
	?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
