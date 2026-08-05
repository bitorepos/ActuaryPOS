<!-- KOT INFORMATION HERE -->
<style>
    @page { margin: 0; padding: 0; size: auto; }
	.kot-print-page { color: #000 !important; background-color: #fff !important; }
    @media print {
		.kot-print-page, .kot-print-page *, .kot-print-page :after, .kot-print-page :before { color: #000 !important; background: #fff !important; text-shadow: none !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
		.kot-print-page { height: auto !important; min-height: 0 !important; overflow: visible !important; }
        body.lockscreen, body.lockscreen > .wrapper, .wrapper { min-height: 0 !important; height: auto !important; overflow: visible !important; }
        .pos-content-wrapper { height: auto !important; min-height: 0 !important; max-height: none !important; overflow: visible !important; }
    }
</style>
<div class="kot-print-page row" style="color: #000000 !important;">
	<div class="col-12 text-center">
		<h2 class="text-center">
				<?php echo e($kot_print['kot_name'], false); ?>

		</h2>
		<h4 class="text-center"><?php echo e($kot_print['kot_type'], false); ?></h4>
		
		<!-- Invoice  number, Date  -->
		<p style="width: 100% !important" class="word-wrap">
			<span class="float-start text-center word-wrap">
				<?php if(!empty($receipt_details->invoice_no_prefix)): ?>
					<b><?php echo $receipt_details->invoice_no_prefix; ?></b>
				<?php endif; ?>
				<?php echo e($receipt_details->invoice_no, false); ?>


				<!-- Table information-->
		        <?php if(!empty($receipt_details->table_label) || !empty($receipt_details->table)): ?>
		        	<br/>
					<span class="float-start text-left">
						<?php if(!empty($receipt_details->table_label)): ?>
							<b><?php echo $receipt_details->table_label; ?></b>
						<?php endif; ?>
						<?php echo e($receipt_details->table, false); ?>


						<!-- Waiter info -->
					</span>
		        <?php endif; ?>
				
			</span>
		</p>
	</div>
</div>

<div class="row" style="color: #000000 !important;">
	<div class="col-12">
		<br/>
		<?php
			$p_width = 45;
		?>
		<?php if(!empty($receipt_details->inline_units_discount_total_label)): ?>
			<?php
				$p_width -= 10;
			?>
		<?php endif; ?>
		<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
			<?php
				$p_width -= 10;
			?>
		<?php endif; ?>
		<div class="table-responsive">
		<table class="table table-slim">
			<thead>
				<tr>
					<th width="<?php echo e($p_width, false); ?>%"><?php echo e($receipt_details->table_product_label, false); ?></th>
					<th class="text-right" width="15%"><?php echo e($receipt_details->table_qty_label, false); ?></th>
					<th class="text-right" width="15%"><?php echo e($receipt_details->table_unit_price_label, false); ?></th>
					<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
						<th class="text-right" width="10%"><?php echo e($receipt_details->inline_unit_discounted_rate_label, false); ?></th>
					<?php endif; ?>
					<?php if(!empty($receipt_details->inline_units_discount_total_label)): ?>
						<th class="text-right" width="10%"><?php echo e($receipt_details->inline_units_discount_total_label, false); ?></th>
					<?php endif; ?>
					<th class="text-right" width="15%"><?php echo e($receipt_details->table_subtotal_label, false); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($kot_print['line_keys'])): ?>
				<?php $current_set_order_kot = null; ?>
				<?php $__empty_4 = true; $__currentLoopData = $receipt_details->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_4 = false; ?>
					<?php if(($kot_print['line_keys'][$line['pid']] == $line['pid']) && ($line['parent_sell_line_id'] == null)): ?>
					<?php if(!empty($line['product_set_name']) && $line['product_set_order'] != $current_set_order_kot): ?>
						<?php $current_set_order_kot = $line['product_set_order']; ?>
<tr>
    <td colspan="20" style="padding:4px 8px;background:#f0f0f0;">
        <strong><i><?php echo e($line['product_set_name'], false); ?> #<?php echo e($line['product_set_order'], false); ?></i></strong>
    </td>
</tr>
					<?php endif; ?>
					<?php
                            $parent_id = $line['line_id'];
                    ?>
					<tr>
						<td>
							<?php if(!empty($line['image'])): ?>
								<img src="<?php echo e($line['image'], false); ?>" alt="Image" width="50" style="float: left; margin-right: 8px;">
							<?php endif; ?>
                            <?php echo e($line['name'], false); ?> <?php echo e($line['product_variation'], false); ?> <?php echo e($line['variation'], false); ?> 
                            <?php if(!empty($line['sub_sku'])): ?>, <?php echo e($line['sub_sku'], false); ?> <?php endif; ?> <?php if(!empty($line['brand'])): ?>, <?php echo e($line['brand'], false); ?> <?php endif; ?> <?php if(!empty($line['cat_code'])): ?>, <?php echo e($line['cat_code'], false); ?><?php endif; ?>
                            <?php if(!empty($line['product_custom_fields'])): ?>, <?php echo e($line['product_custom_fields'], false); ?> <?php endif; ?>
                            <?php if(!empty($line['product_description'])): ?>
                            	<small>
                            		<?php echo $line['product_description']; ?>

                            	</small>
                            <?php endif; ?> 
                            <?php if(!empty($line['sell_line_note'])): ?>
                            <br>
                            <small>
                            	<?php echo $line['sell_line_note']; ?>

                            </small>
                            <?php endif; ?> 
                            <?php if(!empty($line['lot_number'])): ?><br> <?php echo e($line['lot_number_label'], false); ?>:  <?php echo e($line['lot_number'], false); ?> <?php endif; ?> 
                            <?php if(!empty($line['product_expiry'])): ?>, <?php echo e($line['product_expiry_label'], false); ?>:  <?php echo e($line['product_expiry'], false); ?> <?php endif; ?>

                            <?php if(!empty($line['warranty_name'])): ?> <br><small><?php echo e($line['warranty_name'], false); ?> </small><?php endif; ?> <?php if(!empty($line['warranty_exp_date'])): ?> <small>- <?php echo e(\Carbon::createFromTimestamp(strtotime($line['warranty_exp_date']))->format(session('business.date_format')), false); ?> </small><?php endif; ?>
                            <?php if(!empty($line['warranty_description'])): ?> <small> <?php echo e($line['warranty_description'] ?? '', false); ?></small><?php endif; ?>

                            <?php if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1): ?>
                            <br><small>
                            	1 <?php echo e($line['units'], false); ?> = <?php echo e($line['base_unit_multiplier'], false); ?> <?php echo e($line['base_unit_name'], false); ?> <br>
                            	<?php echo e($line['base_unit_price'], false); ?> x <?php echo e($line['orig_quantity'], false); ?> = <?php echo e($line['line_total'], false); ?>

                            </small>
                            <?php endif; ?>
                        </td>
						
						<?php if(!$kot_print['seperate_kot']): ?>
							<td class="text-right">
								<?php echo e($line['quantity'], false); ?> <?php echo e($line['units'], false); ?> 

								<?php if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1): ?>
								<br><small>
									<?php echo e($line['quantity'], false); ?> x <?php echo e($line['base_unit_multiplier'], false); ?> = <?php echo e($line['orig_quantity'], false); ?> <?php echo e($line['base_unit_name'], false); ?>

								</small>
								<?php endif; ?>
							</td>
							
							<td class="text-right"><?php echo e($line['unit_price_inc_tax'], false); ?></td>
							<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
								<td class="text-right">
									<?php echo e($line['unit_price_inc_tax'], false); ?> 
								</td>
							<?php endif; ?>
							<?php if(!empty($receipt_details->inline_units_discount_total_label)): ?>
								<td class="text-right">
									<?php echo e($line['total_line_discount'] ?? '0.00', false); ?>


									<?php if(!empty($line['line_discount_percent'])): ?>
										(<?php echo e($line['line_discount_percent'], false); ?>%)
									<?php endif; ?>
								</td>
							<?php endif; ?>
							<td class="text-right"><?php echo e($line['line_total'], false); ?></td>
						
						<?php else: ?>
						
							<td class="text-right">
								1 <?php echo e($line['units'], false); ?> 

								<?php if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1): ?>
								<br><small>
									<?php echo e($line['quantity'], false); ?> x <?php echo e($line['base_unit_multiplier'], false); ?> = <?php echo e($line['orig_quantity'], false); ?> <?php echo e($line['base_unit_name'], false); ?>

								</small>
								<?php endif; ?>
							</td>
							
							<td class="text-right"><?php echo e($line['unit_price_inc_tax'], false); ?></td>
							<td class="text-right"><?php echo e($line['unit_price_inc_tax'], false); ?></td>
						<?php endif; ?>
					</tr>

					<?php if($line['type'] == 'Package'): ?>
                            <?php $__currentLoopData = $receipt_details->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(($item['parent_sell_line_id'] == $parent_id) && ($item['children_type'] == 'combo')): ?>
									<tr>
										<td>
											<?php if(!empty($item['image'])): ?>
												<img src="<?php echo e($item['image'], false); ?>" alt="Image" width="50" style="float: left; margin-right: 8px;">
											<?php endif; ?>
											<?php echo e($item['name'], false); ?> <?php echo e($item['product_variation'], false); ?> <?php echo e($item['variation'], false); ?> 
											<?php if(!empty($item['sub_sku'])): ?>, <?php echo e($item['sub_sku'], false); ?> <?php endif; ?> <?php if(!empty($item['brand'])): ?>, <?php echo e($item['brand'], false); ?> <?php endif; ?> <?php if(!empty($item['cat_code'])): ?>, <?php echo e($item['cat_code'], false); ?><?php endif; ?>
											<?php if(!empty($item['product_custom_fields'])): ?>, <?php echo e($item['product_custom_fields'], false); ?> <?php endif; ?>
											<?php if(!empty($item['product_description'])): ?>
												<small>
													<?php echo $item['product_description']; ?>

												</small>
											<?php endif; ?> 
											<?php if(!empty($item['sell_line_note'])): ?>
											<br>
											<small>
												<?php echo $item['sell_line_note']; ?>

											</small>
											<?php endif; ?> 
											<?php if(!empty($item['lot_number'])): ?><br> <?php echo e($item['lot_number_label'], false); ?>:  <?php echo e($item['lot_number'], false); ?> <?php endif; ?> 
											<?php if(!empty($item['product_expiry'])): ?>, <?php echo e($item['product_expiry_label'], false); ?>:  <?php echo e($item['product_expiry'], false); ?> <?php endif; ?>

											<?php if(!empty($item['warranty_name'])): ?> <br><small><?php echo e($item['warranty_name'], false); ?> </small><?php endif; ?> <?php if(!empty($item['warranty_exp_date'])): ?> <small>- <?php echo e(\Carbon::createFromTimestamp(strtotime($item['warranty_exp_date']))->format(session('business.date_format')), false); ?> </small><?php endif; ?>
											<?php if(!empty($item['warranty_description'])): ?> <small> <?php echo e($item['warranty_description'] ?? '', false); ?></small><?php endif; ?>

											<?php if($receipt_details->show_base_unit_details && $item['quantity'] && $item['base_unit_multiplier'] !== 1): ?>
											<br><small>
												1 <?php echo e($item['units'], false); ?> = <?php echo e($item['base_unit_multiplier'], false); ?> <?php echo e($item['base_unit_name'], false); ?> <br>
												<?php echo e($item['base_unit_price'], false); ?> x <?php echo e($item['orig_quantity'], false); ?> = <?php echo e($item['line_total'], false); ?>

											</small>
											<?php endif; ?>
										</td>
										
										<?php if(!$kot_print['seperate_kot']): ?>
											<td class="text-right">
												<?php echo e($item['quantity'], false); ?> <?php echo e($item['units'], false); ?> 

												<?php if($receipt_details->show_base_unit_details && $item['quantity'] && $item['base_unit_multiplier'] !== 1): ?>
												<br><small>
													<?php echo e($item['quantity'], false); ?> x <?php echo e($item['base_unit_multiplier'], false); ?> = <?php echo e($item['orig_quantity'], false); ?> <?php echo e($item['base_unit_name'], false); ?>

												</small>
												<?php endif; ?>
											</td>
											
											<td class="text-right"><?php echo e($item['unit_price_inc_tax'], false); ?></td>
											<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
												<td class="text-right">
													<?php echo e($item['unit_price_inc_tax'], false); ?> 
												</td>
											<?php endif; ?>
											<?php if(!empty($receipt_details->inline_units_discount_total_label)): ?>
												<td class="text-right">
													<?php echo e($item['total_line_discount'] ?? '0.00', false); ?>


													<?php if(!empty($item['line_discount_percent'])): ?>
														(<?php echo e($item['line_discount_percent'], false); ?>%)
													<?php endif; ?>
												</td>
											<?php endif; ?>
											<td class="text-right"><?php echo e($item['line_total'], false); ?></td>
										
										<?php else: ?>
										
											<td class="text-right">
												1 <?php echo e($item['units'], false); ?> 

												<?php if($receipt_details->show_base_unit_details && $item['quantity'] && $item['base_unit_multiplier'] !== 1): ?>
												<br><small>
													<?php echo e($item['quantity'], false); ?> x <?php echo e($item['base_unit_multiplier'], false); ?> = <?php echo e($item['orig_quantity'], false); ?> <?php echo e($item['base_unit_name'], false); ?>

												</small>
												<?php endif; ?>
											</td>
											
											<td class="text-right"><?php echo e($item['unit_price_inc_tax'], false); ?></td>
											<td class="text-right"><?php echo e($item['unit_price_inc_tax'], false); ?></td>
										<?php endif; ?>
									</tr>
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				<?php if(!empty($line['modifiers'])): ?>
					<?php $__currentLoopData = $line['modifiers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td>
								<?php echo e($modifier['name'], false); ?> <?php echo e($modifier['variation'], false); ?> 
								<?php if(!empty($modifier['sub_sku'])): ?>, <?php echo e($modifier['sub_sku'], false); ?> <?php endif; ?> <?php if(!empty($modifier['cat_code'])): ?>, <?php echo e($modifier['cat_code'], false); ?><?php endif; ?>
								<?php if(!empty($modifier['sell_line_note'])): ?>(<?php echo $modifier['sell_line_note']; ?>) <?php endif; ?> 
							</td>
							<td class="text-right"><?php echo e($modifier['quantity'], false); ?> <?php echo e($modifier['units'], false); ?> </td>
							<td class="text-right"><?php echo e($modifier['unit_price_inc_tax'], false); ?></td>
							<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
								<td class="text-right"><?php echo e($modifier['unit_price_exc_tax'], false); ?></td>
							<?php endif; ?>
							<?php if(!empty($receipt_details->inline_units_discount_total_label)): ?>
								<td class="text-right">0.00</td>
							<?php endif; ?>
							<td class="text-right"><?php echo e($modifier['line_total'], false); ?></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_4): ?>
					<tr>
						<td colspan="4">&nbsp;</td>
						<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
						<td></td>
						<?php endif; ?>
						<?php if(!empty($receipt_details->inline_units_discount_total_label)): ?>
						<td></td>
						<?php endif; ?>
					</tr>
				<?php endif; ?>
				
				<?php else: ?>
				<?php $current_set_order_kot2 = null; ?>
				<?php $__empty_4 = true; $__currentLoopData = $receipt_details->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_4 = false; ?>
					<?php if($current_set_order_kot2 !== null && $line['parent_sell_line_id'] == null && (empty($line['product_set_name']) || $line['product_set_order'] != $current_set_order_kot2)): ?>
					    <tr><td colspan="20" style="border-bottom:2px solid #333;padding:0;"></td></tr>
					    <?php $current_set_order_kot2 = null; ?>
					<?php endif; ?>
					<?php if(!empty($line['product_set_name']) && $line['product_set_order'] != $current_set_order_kot2 && $line['parent_sell_line_id'] == null): ?>
						<?php $current_set_order_kot2 = $line['product_set_order']; ?>
<tr>
    <td colspan="20" style="padding:4px 8px;background:#f0f0f0;">
        <strong><i><?php echo e($line['product_set_name'], false); ?> #<?php echo e($line['product_set_order'], false); ?></i></strong>
    </td>
</tr>
					<?php endif; ?>
					<tr>
						<td>
							<?php if(!empty($line['image'])): ?>
								<img src="<?php echo e($line['image'], false); ?>" alt="Image" width="50" style="float: left; margin-right: 8px;">
							<?php endif; ?>
                            <?php echo e($line['name'], false); ?> <?php echo e($line['product_variation'], false); ?> <?php echo e($line['variation'], false); ?> 
                            <?php if(!empty($line['sub_sku'])): ?>, <?php echo e($line['sub_sku'], false); ?> <?php endif; ?> <?php if(!empty($line['brand'])): ?>, <?php echo e($line['brand'], false); ?> <?php endif; ?> <?php if(!empty($line['cat_code'])): ?>, <?php echo e($line['cat_code'], false); ?><?php endif; ?>
                            <?php if(!empty($line['product_custom_fields'])): ?>, <?php echo e($line['product_custom_fields'], false); ?> <?php endif; ?>
                            <?php if(!empty($line['product_description'])): ?>
                            	<small>
                            		<?php echo $line['product_description']; ?>

                            	</small>
                            <?php endif; ?> 
                            <?php if(!empty($line['sell_line_note'])): ?>
                            <br>
                            <small>
                            	<?php echo $line['sell_line_note']; ?>

                            </small>
                            <?php endif; ?> 
                            <?php if(!empty($line['lot_number'])): ?><br> <?php echo e($line['lot_number_label'], false); ?>:  <?php echo e($line['lot_number'], false); ?> <?php endif; ?> 
                            <?php if(!empty($line['product_expiry'])): ?>, <?php echo e($line['product_expiry_label'], false); ?>:  <?php echo e($line['product_expiry'], false); ?> <?php endif; ?>

                            <?php if(!empty($line['warranty_name'])): ?> <br><small><?php echo e($line['warranty_name'], false); ?> </small><?php endif; ?> <?php if(!empty($line['warranty_exp_date'])): ?> <small>- <?php echo e(\Carbon::createFromTimestamp(strtotime($line['warranty_exp_date']))->format(session('business.date_format')), false); ?> </small><?php endif; ?>
                            <?php if(!empty($line['warranty_description'])): ?> <small> <?php echo e($line['warranty_description'] ?? '', false); ?></small><?php endif; ?>

                            <?php if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1): ?>
                            <br><small>
                            	1 <?php echo e($line['units'], false); ?> = <?php echo e($line['base_unit_multiplier'], false); ?> <?php echo e($line['base_unit_name'], false); ?> <br>
                            	<?php echo e($line['base_unit_price'], false); ?> x <?php echo e($line['orig_quantity'], false); ?> = <?php echo e($line['line_total'], false); ?>

                            </small>
                            <?php endif; ?>
                        </td>
						<td class="text-right">
							<?php echo e($line['quantity'], false); ?> <?php echo e($line['units'], false); ?> 

							<?php if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1): ?>
                            <br><small>
                            	<?php echo e($line['quantity'], false); ?> x <?php echo e($line['base_unit_multiplier'], false); ?> = <?php echo e($line['orig_quantity'], false); ?> <?php echo e($line['base_unit_name'], false); ?>

                            </small>
                            <?php endif; ?>
						</td>
						
						<td class="text-right"><?php echo e($line['unit_price_inc_tax'], false); ?></td>
						<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
							<td class="text-right">
								<?php echo e($line['unit_price_inc_tax'], false); ?> 
							</td>
						<?php endif; ?>
						<?php if(!empty($receipt_details->inline_units_discount_total_label)): ?>
							<td class="text-right">
								<?php echo e($line['total_line_discount'] ?? '0.00', false); ?>


								<?php if(!empty($line['line_discount_percent'])): ?>
								 	(<?php echo e($line['line_discount_percent'], false); ?>%)
								<?php endif; ?>
							</td>
						<?php endif; ?>
						<td class="text-right"><?php echo e($line['line_total'], false); ?></td>
					</tr>
					<?php if(!empty($line['modifiers'])): ?>
						<?php $__currentLoopData = $line['modifiers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td>
		                            <?php echo e($modifier['name'], false); ?> <?php echo e($modifier['variation'], false); ?> 
		                            <?php if(!empty($modifier['sub_sku'])): ?>, <?php echo e($modifier['sub_sku'], false); ?> <?php endif; ?> <?php if(!empty($modifier['cat_code'])): ?>, <?php echo e($modifier['cat_code'], false); ?><?php endif; ?>
		                            <?php if(!empty($modifier['sell_line_note'])): ?>(<?php echo $modifier['sell_line_note']; ?>) <?php endif; ?> 
		                        </td>
								<td class="text-right"><?php echo e($modifier['quantity'], false); ?> <?php echo e($modifier['units'], false); ?> </td>
								<td class="text-right"><?php echo e($modifier['unit_price_inc_tax'], false); ?></td>
								<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
									<td class="text-right"><?php echo e($modifier['unit_price_exc_tax'], false); ?></td>
								<?php endif; ?>
								<?php if(!empty($receipt_details->inline_units_discount_total_label)): ?>
									<td class="text-right">0.00</td>
								<?php endif; ?>
								<td class="text-right"><?php echo e($modifier['line_total'], false); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_4): ?>
						<tr>
							<td colspan="4">&nbsp;</td>
							<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
							<td></td>
							<?php endif; ?>
							<?php if(!empty($receipt_details->inline_units_discount_total_label)): ?>
							<td></td>
							<?php endif; ?>
						</tr>
					<?php endif; ?>	
				<?php endif; ?>
								<?php if($current_set_order_kot !== null): ?>
						<tr><td colspan="20" style="border-bottom:2px solid #333;padding:0;"></td></tr>
					<?php endif; ?>
					<?php if($current_set_order_kot2 !== null): ?>
						<tr><td colspan="20" style="border-bottom:2px solid #333;padding:0;"></td></tr>
					<?php endif; ?>
</tbody>
		</table>
		</div>
	</div>
	<div>
            <?php if(!$receipt_details->hide_invoice_branding): ?>
            <small>
                <p style="text-align: left; font-size:10px;"><?php echo env('BRANDING_TEXT'); ?></p>
            </small>
            <?php endif; ?>
        </div>
</div>
