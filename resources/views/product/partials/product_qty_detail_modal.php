<div class="modal-dialog modal-md" role="document">
	<div class="modal-content">
		<div class="modal-header bg-info">
			<h4 class="modal-title text-light text-center">
				<?php echo app('translator')->get('lang_v1.stock_qty_enquiry'); ?>
			</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-6 col-12">
					<div class="mb-3">
						<label for="sku">SKU</label>
						<input class="form-control" name="sku" type="text" value="<?php echo e($product->sku, false); ?>" disabled>
					</div>
				</div>
				<div class="col-md-6 col-12">
					<div class="mb-3">
						<label for="name">Product Name</label>
						<input class="form-control" name="name" type="text" value="<?php echo e($product->name, false); ?>" disabled>
					</div>
				</div>
				<div class="col-md-12">
					<div class="table-responsive">
					<table class="table table-bordered table-striped table-th-skin" style="width: 100%">
						<thead>
							<th class="col-md-9"><?php echo app('translator')->get('sale.location'); ?></th>
							<th><?php echo app('translator')->get('report.quantity'); ?></th>
						</thead>
						<tbody>
							<?php $total_qty = 0; ?>
							<?php $__empty_1 = true; $__currentLoopData = $product_stock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
								<tr>
									<td><?php echo e($ps['name'], false); ?></td>
									<td><?php echo e(number_format($ps['qty_available'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
								</tr>	
								<?php $total_qty += $ps['qty_available']; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
								<tr><td colspan="2"><?php echo app('translator')->get('lang_v1.no_data'); ?></td></tr>
							<?php endif; ?>

							
							<?php if(!empty($warehouse_stock)): ?>
								<?php $__currentLoopData = $warehouse_stock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ws): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><i class="fas fa-warehouse text-muted"></i> <?php echo e($ws->warehouse_name, false); ?></td>
										<td><?php echo e(number_format($ws->qty_available, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
									</tr>
									<?php $total_qty += $ws->qty_available; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</tbody>
						<tfoot>
							<tr>
								<td></td>
								<td class="bg-gray"><?php echo e(number_format($total_qty, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
							</tr>
						</tfoot>
					</table>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer bg-info justify-items-center">
			<button type="button" class="btn btn-default" data-bs-dismiss="modal">
				<i class="fas fa-window-close"></i> Close
			</button>
		</div>
	</div>
</div>
