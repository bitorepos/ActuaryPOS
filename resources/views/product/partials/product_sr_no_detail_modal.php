<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header bg-info">
			<h4 class="modal-title text-light text-center">
				<?php echo app('translator')->get('lang_v1.serial_no_detail'); ?>
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
<?php
    $common_settings = isset($common_settings) && ! empty($common_settings) ? $common_settings : (session()->get('business.common_settings') ?? []);
?>
					<table class="table table-bordered table-striped table-th-skin" style="width: 100%">
						<thead>
							<th>Type</th>
							<th>Serial Number</th>
							<?php if(!empty($common_settings['enable_imei_number'])): ?>
							<th>IMEI Numbers</th>
							<?php endif; ?>
							<th>Brand</th>
							<th>Contact</th>
							<th>Price</th>
							<th>Date</th>
							<th>Days</th>
						</thead>
						<tbody>
							<?php
								$imei_number_labels = [
									$common_settings['imei1_number_label'] ?? '',
									$common_settings['imei2_number_label'] ?? '',
									$common_settings['imei3_number_label'] ?? '',
									$common_settings['imei4_number_label'] ?? '',
								];
							?>
							<?php $__empty_1 = true; $__currentLoopData = $sr_no_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $srd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
								<tr class=" <?php if($searched_term == $srd['serial_number']): ?> bg-yellow <?php endif; ?> ">
									<td><?php echo e(ucwords(str_replace('_', ' ', $srd['type'])), false); ?></td>
									<td>
										<?php echo e($srd['serial_number'], false); ?>

									</td>
									<?php if(!empty($common_settings['enable_imei_number'])): ?>
									<td>	
										<?php $__currentLoopData = $srd['imei_numbers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $imei): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if(!empty($imei_number_labels[$key-1])): ?>
												<b><?php echo e($imei_number_labels[$key-1], false); ?>:</b>
											<?php endif; ?>
											<?php echo e($imei, false); ?>

											<br>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</td>
									<?php endif; ?>
									<td><?php echo e($srd['brand_name'], false); ?></td>
									<td><?php echo e($srd['contact_name'], false); ?></td>
									<td><?php echo e(number_format($srd['price'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
									<td><?php echo format_datetime_br($srd['date']); ?></td>
									<td><?php echo e($srd['days'], false); ?></td>
								</tr>	
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
								<tr>
									<td colspan="8" class="text-center">No Serial No Details</td>
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
