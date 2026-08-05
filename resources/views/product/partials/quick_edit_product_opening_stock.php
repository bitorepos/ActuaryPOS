<div class="row" id="quick_product_opening_stock_div">
	<div class="col-sm-12">
		<h4><?php echo app('translator')->get('lang_v1.add_opening_stock'); ?></h4>
	</div>
	<div class="col-sm-12">
		<div class="table-responsive">
<table class="table table-condensed table-bordered table-striped table-th-skin" id="quick_product_opening_stock_table">
			<thead>
			<tr>
				<th><?php echo app('translator')->get('sale.location'); ?></th>
				<th><?php echo app('translator')->get( 'lang_v1.quantity' ); ?></th>
				<th><?php echo app('translator')->get( 'purchase.unit_cost_before_tax' ); ?></th>
				<?php if($enable_expiry): ?>
					<th><?php echo app('translator')->get('lang_v1.expiry_date'); ?></th>
				<?php endif; ?>
				<?php if($enable_lot): ?>
					<th><?php echo app('translator')->get( 'lang_v1.lot_number' ); ?></th>
				<?php endif; ?>
				<th><?php echo app('translator')->get( 'purchase.subtotal_before_tax' ); ?></th>
				<th></th>
			</tr>
			</thead>
			<tbody>
		<?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

			<?php $__currentLoopData = $product->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<?php $__empty_1 = true; $__currentLoopData = $purchases[$key][$variation->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_key => $var): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
					<?php
				
					$purchase_line_id = $var['purchase_line_id'];
				
					$qty = $var['quantity'];
					$qty_remaining = $var['quantity_remaining'];
					$min_quantity = $qty - $qty_remaining;
				
					$purchase_price = $var['purchase_price'];
				
					$row_total = $qty * $purchase_price;
				
					// $subtotal += $row_total;
					// $lot_number = $var['lot_number'];
					// $transaction_date = $var['transaction_date'];
					// $purchase_line_note = $var['purchase_line_note'];
					?>

					<tr>
						<td>
							<?php echo e($value, false); ?>

							<?php if(!empty($var['purchase_line_id'])): ?>
								<?php echo Form::hidden('opening_stock[' . $key . '][' . $sub_key . '][' . $key . '][purchase_line_id]', $purchase_line_id); ?>

							<?php endif; ?>
						</td>
						<td><?php echo Form::text('opening_stock[' . $key . ']['.$sub_key.'][' . $key . '][quantity]', number_format($qty, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm input_number purchase_quantity', 'required']); ?></td>
						<td><?php echo Form::text('opening_stock[' . $key . ']['.$sub_key.'][' . $key . '][purchase_price]', number_format($purchase_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) , ['class' => 'form-control input-sm input_number unit_price', 'required']); ?></td>
						<?php if($enable_expiry): ?>
							<td>
								<?php echo Form::text('opening_stock[' . $key . ']['.$sub_key.'][' . $key . '][exp_date]', null , ['class' => 'form-control input-sm os_exp_date', 'readonly']); ?>

							</td>
						<?php endif; ?>
						<?php if($enable_lot): ?>
							<td>
								<?php echo Form::text('opening_stock[' . $key . ']['.$sub_key.'][' . $key . '][lot_number]', null , ['class' => 'form-control input-sm']); ?>

							</td>
						<?php endif; ?>
						<td>
							<span class="row_subtotal_before_tax"><?php echo e(number_format($row_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
						</td>
						<td>
							<?php if($loop->index == 0): ?>
							<button type="button" class="btn btn-primary btn-sm add_edit_stock_row" data-sub-key="<?php echo e(count($purchases[$key][$variation->id]), false); ?>"
								data-row-html='<tr>
												<td>
													<?php echo e($value, false); ?>

												</td>
												<td><?php echo Form::text('opening_stock[' . $key . '][__subkey__][' . $key . '][quantity]', number_format(0, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm input_number purchase_quantity', 'required']); ?></td>
												<td><?php echo Form::text('opening_stock[' . $key . '][__subkey__][' . $key . '][purchase_price]', number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) , ['class' => 'form-control input-sm input_number unit_price', 'required']); ?></td>
												<?php if($enable_expiry): ?>
													<td>
														<?php echo Form::text('opening_stock[' . $key . '][__subkey__][' . $key . '][exp_date]', null , ['class' => 'form-control input-sm os_exp_date', 'readonly']); ?>

													</td>
												<?php endif; ?>
												<?php if($enable_lot): ?>
													<td>
														<?php echo Form::text('opening_stock[' . $key . '][__subkey__][' . $key . '][lot_number]', null , ['class' => 'form-control input-sm']); ?>

													</td>
												<?php endif; ?>
												<td>
													<span class="row_subtotal_before_tax"><?php echo e(number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
												</td>
												<td></td>
											</tr>'> 
								<i class="fa fa-plus"></i>
							</button>
							<?php endif; ?>
						</td>
					</tr>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
					<tr>
						<td>
							<?php echo e($value, false); ?>

						</td>
						<td><?php echo Form::text('opening_stock[' . $key . '][0][' . $key . '][quantity]', number_format(0, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm input_number purchase_quantity', 'required']); ?></td>
						<td><?php echo Form::text('opening_stock[' . $key . '][0][' . $key . '][purchase_price]', number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) , ['class' => 'form-control input-sm input_number unit_price', 'required']); ?></td>
						<?php if($enable_expiry): ?>
							<td>
								<?php echo Form::text('opening_stock[' . $key . '][0][' . $key . '][exp_date]', null , ['class' => 'form-control input-sm os_exp_date', 'readonly']); ?>

							</td>
						<?php endif; ?>
						<?php if($enable_lot): ?>
							<td>
								<?php echo Form::text('opening_stock[' . $key . '][0][' . $key . '][lot_number]', null , ['class' => 'form-control input-sm']); ?>

							</td>
						<?php endif; ?>
						<td>
							<span class="row_subtotal_before_tax"><?php echo e(number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
						</td>
						<td>
							<button type="button" class="btn btn-primary btn-sm add_edit_stock_row" data-sub-key="1"
								data-row-html='<tr>
									<td>
										<?php echo e($value, false); ?>

									</td>
									<td><?php echo Form::text('opening_stock[' . $key . '][__subkey__][' . $key . '][quantity]', number_format(0, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm input_number purchase_quantity', 'required']); ?></td>
									<td><?php echo Form::text('opening_stock[' . $key . '][__subkey__][' . $key . '][purchase_price]', number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) , ['class' => 'form-control input-sm input_number unit_price', 'required']); ?></td>
									<?php if($enable_expiry): ?>
										<td>
											<?php echo Form::text('opening_stock[' . $key . '][__subkey__][' . $key . '][exp_date]', null , ['class' => 'form-control input-sm os_exp_date', 'readonly']); ?>

										</td>
									<?php endif; ?>
									<?php if($enable_lot): ?>
										<td>
											<?php echo Form::text('opening_stock[' . $key . '][__subkey__][' . $key . '][lot_number]', null , ['class' => 'form-control input-sm']); ?>

										</td>
									<?php endif; ?>
									<td>
										<span class="row_subtotal_before_tax"><?php echo e(number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
									</td>
									<td></td>
								</tr>'> 
								<i class="fa fa-plus"></i>
							</button>
						</td>
					</tr>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
		</table>
</div>
	</div>
</div>
