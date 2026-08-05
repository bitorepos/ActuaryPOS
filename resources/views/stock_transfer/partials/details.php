<div class="row">
	<div class="col-12 col-sm-10 col-sm-offset-1">
		<div class="table-responsive">
			<table class="table table-condensed bg-gray">
				<tr>
					<th><?php echo app('translator')->get('sale.product'); ?></th>
					<th><?php echo app('translator')->get('sale.qty'); ?></th>
					<th><?php echo app('translator')->get('sale.unit_price'); ?></th>
					<th><?php echo app('translator')->get('sale.subtotal'); ?></th>
				</tr>
				<?php $__currentLoopData = $stock_adjustment_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td>
							<?php echo e($details->product, false); ?> 
							<?php if( $details->type == 'variable'): ?>
							 <?php echo e('-' . $details->product_variation . '-' . $details->variation, false); ?> 
							<?php endif; ?> 
							( <?php echo e($details->sub_sku, false); ?> )
						</td>
						<td>
							<?php echo e(number_format($details->quantity, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

						</td>
						<td>
							<?php echo e(number_format($details->unit_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

						</td>
						<td>
							<?php echo e(number_format($details->unit_price * $details->quantity, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

						</td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
		</div>
	</div>
</div>
