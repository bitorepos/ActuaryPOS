<div class="modal-dialog modal-md" role="document">
	<div class="modal-content">
		<div class="modal-header bg-info">
			<h4 class="modal-title text-light text-center">
				<?php echo app('translator')->get('lang_v1.stock_on_po_detail'); ?>
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
							<th>Order Date</th>
							<th>Ref. No</th>
							<th>Quantity</th>
							<th>Delivery Date</th>
						</thead>
						<tbody>
							<?php $__empty_1 = true; $__currentLoopData = $stock_on_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $so): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
								<tr>
									<td><?php echo format_datetime_br($so['order_date']); ?></td>
									<td><?php echo e($so['ref_no'], false); ?></td>
									<td><?php echo e(number_format($so['quantity'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
									<td><?php echo format_datetime_br($so['delivery_date']); ?></td>
								</tr>	
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
								<tr>
									<td colspan="4" class="text-center">No Stock on Order</td>
								</tr>
							<?php endif; ?>
						</tbody>
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
