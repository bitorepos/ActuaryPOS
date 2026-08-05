<!-- business information here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- <link rel="stylesheet" href="style.css"> -->
        <title><?php echo e($kot_print['kot_name'], false); ?>-<?php echo e($kot_print['kot_type'], false); ?>-<?php echo e($receipt_details->invoice_no, false); ?></title>
        <style>
            @page { margin: 0; padding: 0; size: auto; }
			.kot-print-root { margin: 0; padding: 0; background: #fff !important; background-color: #fff !important; height: auto !important; min-height: 0 !important; overflow: visible !important; }
            @media print {
				.kot-print-root, .kot-print-root *, .kot-print-root :after, .kot-print-root :before { background: #fff !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            }
        </style>
    </head>
    <body>
		<div class="kot-print-root ticket">
        	<div class="text-box">
				<!-- Logo -->
				<p class="centered receipt-header-block">
					<h2 class="receipt-kot-heading text-center">
						<?php echo e($kot_print['kot_name'], false); ?>

					</h2>
					<h4 class="receipt-kot-heading text-center"><?php echo e($kot_print['kot_type'], false); ?></h4>
				</p>
				</div>
			<?php if(!empty($receipt_details->invoice_no_prefix)): ?>
			<div class="border-top textbox-info">
				<p class="f-left"><strong><?php echo $receipt_details->invoice_no_prefix; ?></strong></p>
				<p class="f-right">
					<?php echo e($receipt_details->invoice_no, false); ?>

				</p>
			</div>
			<?php endif; ?>
			<div class="textbox-info">
				<p class="f-left"><strong><?php echo $receipt_details->date_label; ?></strong></p>
				<p class="f-right">
					<?php echo e($receipt_details->invoice_date, false); ?>

				</p>
			</div>
			
			<?php if(!empty($receipt_details->due_date_label)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e($receipt_details->due_date_label, false); ?></strong></p>
					<p class="f-right"><?php echo e($receipt_details->due_date ?? '', false); ?></p>
				</div>
			<?php endif; ?>

			<?php if(!empty($receipt_details->token_no)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e(!empty($receipt_details->token_no_label) ? $receipt_details->token_no_label : 'Token No', false); ?>:</strong></p>
					<p class="f-right"><?php echo e($receipt_details->token_no ?? '', false); ?></p>
				</div>		
			<?php endif; ?>

			<?php if(!empty($receipt_details->ref_no)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo $receipt_details->ref_no_label; ?></strong></p>
					<p class="f-right"><?php echo e($receipt_details->ref_no, false); ?></p>
				</div>
			<?php endif; ?>

			<?php if(!empty($receipt_details->sales_person_label)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e($receipt_details->sales_person_label, false); ?></strong></p>
				
					<p class="f-right"><?php echo e($receipt_details->sales_person, false); ?></p>
				</div>
			<?php endif; ?>
			
			<?php if(!empty($receipt_details->workstation_label)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e($receipt_details->workstation_label, false); ?></strong></p>
				
					<p class="f-right"><?php echo e($receipt_details->workstation_id, false); ?></p>
				</div>
			<?php endif; ?>
			
			<?php if(!empty($receipt_details->commission_agent_label)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e($receipt_details->commission_agent_label, false); ?></strong></p>
				
					<p class="f-right"><?php echo e($receipt_details->commission_agent, false); ?></p>
				</div>
			<?php endif; ?>

			<?php if(!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e($receipt_details->brand_label, false); ?></strong></p>
				
					<p class="f-right"><?php echo e($receipt_details->repair_brand, false); ?></p>
				</div>
			<?php endif; ?>

			<?php if(!empty($receipt_details->device_label) || !empty($receipt_details->repair_device)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e($receipt_details->device_label, false); ?></strong></p>
				
					<p class="f-right"><?php echo e($receipt_details->repair_device, false); ?></p>
				</div>
			<?php endif; ?>
			
			<?php if(!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e($receipt_details->model_no_label, false); ?></strong></p>
				
					<p class="f-right"><?php echo e($receipt_details->repair_model_no, false); ?></p>
				</div>
			<?php endif; ?>
			
			<?php if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e($receipt_details->serial_no_label, false); ?></strong></p>
				
					<p class="f-right"><?php echo e($receipt_details->repair_serial_no, false); ?></p>
				</div>
			<?php endif; ?>

			<?php if(!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong>
						<?php echo $receipt_details->repair_status_label; ?>

					</strong></p>
					<p class="f-right">
						<?php echo e($receipt_details->repair_status, false); ?>

					</p>
				</div>
        	<?php endif; ?>

        	<?php if(!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty)): ?>
	        	<div class="textbox-info">
	        		<p class="f-left"><strong>
	        			<?php echo $receipt_details->repair_warranty_label; ?>

	        		</strong></p>
	        		<p class="f-right">
	        			<?php echo e($receipt_details->repair_warranty, false); ?>

	        		</p>
	        	</div>
        	<?php endif; ?>
			
			<?php if(!empty($receipt_details->logged_in_user)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong>Logged in</strong></p>
					<p class="f-right"><?php echo e($receipt_details->logged_in_user, false); ?></p>
				</div>
			<?php endif; ?>
			<?php if(!empty($receipt_details->logged_in_user)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e($receipt_details->updated_by_label, false); ?></strong></p>
					<p class="f-right"><?php echo e($receipt_details->updated_by, false); ?></p>
				</div>
			<?php endif; ?>

        	<!-- Waiter info -->
			<?php if(!empty($receipt_details->service_staff_label) && !empty($receipt_details->service_staff)): ?>
	        	<div class="textbox-info">
	        		<p class="f-left"><strong>
	        			<?php echo $receipt_details->service_staff_label; ?>

	        		</strong></p>
	        		<p class="f-right">
	        			<?php echo e($receipt_details->service_staff, false); ?>

					</p>
	        	</div>
	        <?php endif; ?>
			
			<?php if(!$receipt_details->is_takeaway): ?>
				<?php if(!empty($receipt_details->table_label) || !empty($receipt_details->table)): ?>
					<div class="textbox-info">
						<p class="f-left"><strong>
							<?php if(!empty($receipt_details->table_label)): ?>
								<b><?php echo $receipt_details->table_label; ?></b>
							<?php endif; ?>
						</strong></p>
						<p class="f-right">
							<?php echo e($receipt_details->table, false); ?>

						</p>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if(!empty($receipt_details->types_of_service)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong>
						<?php if(!empty($receipt_details->types_of_service_label)): ?>
							<b><?php echo $receipt_details->types_of_service_label; ?></b>
						<?php endif; ?>
					</strong></p>
					<p class="f-right">
						<?php echo e($receipt_details->types_of_service, false); ?>

					</p>
				</div>
			<?php endif; ?>
			
			<?php if(!empty($receipt_details->no_of_guests)): ?>
			<div class="textbox-info">
				<p class="f-left"><strong>No of Guests</strong></p>
				<p class="f-right"><?php echo e($receipt_details->no_of_guests, false); ?></p>
			</div>
			<?php endif; ?>

	        <!-- customer info -->
	        <div class="textbox-info">
	        	<p style="vertical-align: top;"><strong>
	        		<?php echo e($receipt_details->customer_label ?? '', false); ?>

	        	</strong></p>

	        	<p>
	        		<?php if(!empty($receipt_details->customer_info)): ?>
	        			<div class="bw">
						<?php echo $receipt_details->customer_info; ?>

						</div>
					<?php endif; ?>
	        	</p>
	        </div>
			
			<?php if(!empty($receipt_details->client_id_label)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong>
						<?php echo e($receipt_details->client_id_label, false); ?>

					</strong></p>
					<p class="f-right">
						<?php echo e($receipt_details->client_id, false); ?>

					</p>
				</div>
			<?php endif; ?>
			
			<?php if(!empty($receipt_details->customer_tax_label)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong>
						<?php echo e($receipt_details->customer_tax_label, false); ?>

					</strong></p>
					<p class="f-right">
						<?php echo e($receipt_details->customer_tax_number, false); ?>

					</p>
				</div>
			<?php endif; ?>

			<?php if(!empty($receipt_details->customer_custom_fields)): ?>
				<div class="textbox-info">
					<p class="centered">
						<?php echo $receipt_details->customer_custom_fields; ?>

					</p>
				</div>
			<?php endif; ?>
			
			<?php if(!empty($receipt_details->customer_rp_label)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong>
						<?php echo e($receipt_details->customer_rp_label, false); ?>

					</strong></p>
					<p class="f-right">
						<?php echo e($receipt_details->customer_total_rp, false); ?>

					</p>
				</div>
			<?php endif; ?>
			<?php if(!empty($receipt_details->shipping_custom_field_1_label)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong>
						<?php echo $receipt_details->shipping_custom_field_1_label; ?> 
					</strong></p>
					<p class="f-right">
						<?php echo $receipt_details->shipping_custom_field_1_value ?? ''; ?>

					</p>
				</div>
			<?php endif; ?>
			<?php if(!empty($receipt_details->shipping_custom_field_2_label)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong>
						<?php echo $receipt_details->shipping_custom_field_2_label; ?> 
					</strong></p>
					<p class="f-right">
						<?php echo $receipt_details->shipping_custom_field_2_value ?? ''; ?>

					</p>
				</div>
			<?php endif; ?>
			<?php if(!empty($receipt_details->shipping_custom_field_3_label)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong>
						<?php echo $receipt_details->shipping_custom_field_3_label; ?> 
					</strong></p>
					<p class="f-right">
						<?php echo $receipt_details->shipping_custom_field_3_value ?? ''; ?>

					</p>
				</div>
			<?php endif; ?>
			<?php if(!empty($receipt_details->shipping_custom_field_4_label)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong>
						<?php echo $receipt_details->shipping_custom_field_4_label; ?> 
					</strong></p>
					<p class="f-right">
						<?php echo $receipt_details->shipping_custom_field_4_value ?? ''; ?>

					</p>
				</div>
			<?php endif; ?>
			<?php if(!empty($receipt_details->shipping_custom_field_5_label)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong>
						<?php echo $receipt_details->shipping_custom_field_5_label; ?> 
					</strong></p>
					<p class="f-right">
						<?php echo $receipt_details->shipping_custom_field_5_value ?? ''; ?>

					</p>
				</div>
			<?php endif; ?>
			<?php if(!empty($receipt_details->sale_orders_invoice_no)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong>
						<?php echo app('translator')->get('restaurant.order_no'); ?>
					</strong></p>
					<p class="f-right">
						<?php echo $receipt_details->sale_orders_invoice_no ?? ''; ?>

					</p>
				</div>
			<?php endif; ?>

			<?php if(!empty($receipt_details->sale_orders_invoice_date)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong>
						<?php echo app('translator')->get('lang_v1.order_dates'); ?>
					</strong></p>
					<p class="f-right">
						<?php echo $receipt_details->sale_orders_invoice_date ?? ''; ?>

					</p>
				</div>
			<?php endif; ?>
            <table style="margin-top: 25px !important" class="border-bottom width-100 table-f-12 mb-10">
                <thead class="border-bottom-dotted">
                    <tr>
                        <th class="serial_number">#</th>
                        <th class="<?php if(empty($receipt_details->hide_price_total)): ?> width-30 <?php endif; ?>">
                        	<?php echo e($receipt_details->table_product_label, false); ?>

                        </th>
                        <th class="text-right width-20">
                        	<?php echo e($receipt_details->table_qty_label, false); ?>

                        </th>
                        <?php if(empty($receipt_details->hide_price_total)): ?>
                        <th class="text-right width-20">
                        	<?php echo e($receipt_details->table_unit_price_label, false); ?>

                        </th>
                        
						<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
							<th class="text-right width-20">
								<?php echo e($receipt_details->inline_unit_discounted_rate_label, false); ?>

							</th>
						<?php endif; ?>
                        <th class="text-right width-20"><?php echo e($receipt_details->table_subtotal_label, false); ?></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
					<?php if(!empty($kot_print['line_keys'])): ?>
					<?php $current_set_order_kot = null; ?>
                	<?php $__empty_2 = true; $__currentLoopData = $receipt_details->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
						
						<?php if(($kot_print['line_keys'][$line['pid']] == $line['pid']) && $line['children_type'] == ''): ?>
						<?php if($current_set_order_kot !== null && $line['parent_sell_line_id'] == null && (empty($line['product_set_name']) || $line['product_set_order'] != $current_set_order_kot)): ?>
						    <tr><td colspan="20" style="border-bottom:2px solid #333;padding:0;"></td></tr>
						    <?php $current_set_order_kot = null; ?>
						<?php endif; ?>
						<?php if(!empty($line['product_set_name']) && $line['product_set_order'] != $current_set_order_kot && $line['parent_sell_line_id'] == null): ?>
							<?php $current_set_order_kot = $line['product_set_order']; ?>
<tr>
    <td colspan="20" style="padding:4px 8px;background:#f0f0f0;">
        <strong><i><?php echo e($line['product_set_name'], false); ?> #<?php echo e($line['product_set_order'], false); ?></i></strong>
    </td>
</tr>
						<?php endif; ?>
						<?php
                            $parent_id = $line['line_id'];
							if($line['type'] == 'Package'){
								$package_has_sp = $line['package_show_price'];
							}else{
								$package_has_sp = 1;
							}
                    	?>
	                    <tr>
	                        <td class="serial_number" style="vertical-align: top;">
	                        	<?php echo e($loop->iteration, false); ?>

	                        </td>
	                        <td class="">
	                        	<?php echo e($line['name'], false); ?> <?php echo e($line['product_variation'], false); ?> <?php echo e($line['variation'], false); ?>

	                        	<?php if(!empty($line['sub_sku'])): ?>, <?php echo e($line['sub_sku'], false); ?> <?php endif; ?> <?php if(!empty($line['brand'])): ?>, <?php echo e($line['brand'], false); ?> <?php endif; ?> <?php if(!empty($line['cat_code'])): ?>, <?php echo e($line['cat_code'], false); ?><?php endif; ?>
	                        	<?php if(!empty($line['product_custom_fields'])): ?>, <?php echo e($line['product_custom_fields'], false); ?> <?php endif; ?>
	                        	<?php if(!empty($line['product_description'])): ?>
	                            	<div class="f-8">
	                            		<?php echo $line['product_description']; ?>

	                            	</div>
	                            <?php endif; ?>
	                        	<?php if(!empty($line['sell_line_note'])): ?>
	                        	<br>
	                        	<span>
	                        	<?php echo $line['sell_line_note']; ?>

	                        	</span>
	                        	<?php endif; ?> 
	                        	<?php if(!empty($line['lot_number'])): ?><br> <?php echo e($line['lot_number_label'], false); ?>:  <?php echo e($line['lot_number'], false); ?> <?php endif; ?> 
	                        	<?php if(!empty($line['product_expiry'])): ?>, <?php echo e($line['product_expiry_label'], false); ?>:  <?php echo e($line['product_expiry'], false); ?> <?php endif; ?>
	                        	<?php if(!empty($line['warranty_name'])): ?>
	                            	<br>
	                            	<small>
	                            		<?php echo e($line['warranty_name'], false); ?>

	                            	</small>
	                            <?php endif; ?>
	                            <?php if(!empty($line['warranty_exp_date'])): ?>
	                            	<small>
	                            		- <?php echo e(\Carbon::createFromTimestamp(strtotime($line['warranty_exp_date']))->format(session('business.date_format')), false); ?>

	                            </small>
	                            <?php endif; ?>
	                            <?php if(!empty($line['warranty_description'])): ?>
	                            	<small> <?php echo e($line['warranty_description'] ?? '', false); ?></small>
	                            <?php endif; ?>

	                            <?php if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1): ?>
		                            <br><small>
		                            	1 <?php echo e($line['units'], false); ?> = <?php echo e($line['base_unit_multiplier'], false); ?> <?php echo e($line['base_unit_name'], false); ?> <br>
                            			<?php echo e($line['base_unit_price'], false); ?> x <?php echo e($line['orig_quantity'], false); ?> = <?php echo e($line['line_total'], false); ?>

		                            </small>
								<?php endif; ?>

								<!-- Waiter info -->
								<?php if(!empty($receipt_details->service_staff_label) && !empty($line['service_staff'])): ?>
									<br>
									<small>	
									<strong><?php echo e($receipt_details->service_staff_label, false); ?>:</strong>
									<br><?php echo e($line['service_staff'], false); ?>

									</small>
								<?php endif; ?>
								<?php if(!empty($receipt_details->preparation_time_label) && !empty($line['preparation_time'])): ?>
								<br><?php echo e($receipt_details->preparation_time_label, false); ?> : <?php echo e($line['preparation_time'], false); ?> mins
								<?php endif; ?>
	                        </td>
	                        <td class="text-right">
							<?php if(!$kot_print['seperate_kot']): ?>
								<?php echo e($line['quantity'], false); ?> 
								<?php if(!empty($receipt_details->show_unit)): ?>
									<?php echo e($line['units'], false); ?> 
								<?php endif; ?> 
								<?php if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1): ?>
                            	<br>
								<small>
                            		<?php echo e($line['quantity'], false); ?> x <?php echo e($line['base_unit_multiplier'], false); ?> = <?php echo e($line['orig_quantity'], false); ?> <?php echo e($line['base_unit_name'], false); ?>

                           		</small>
                            	<?php endif; ?>
							<?php else: ?>
								1 <?php if(!empty($receipt_details->show_unit)): ?>
									<?php echo e($line['units'], false); ?> 
								  <?php endif; ?>
								<?php if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1): ?>
								<br>
								<small>
									<?php echo e($line['quantity'], false); ?> x <?php echo e($line['base_unit_multiplier'], false); ?> = <?php echo e($line['orig_quantity'], false); ?> <?php echo e($line['base_unit_name'], false); ?>

								</small>
								<?php endif; ?>
							<?php endif; ?>
							</td>
	                        <?php if(empty($receipt_details->hide_price_total) && $package_has_sp): ?>
								<td class="text-right"><?php echo e($line['unit_price_before_discount'], false); ?></td>
								
								

								<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
								<td class="text-right">
									<?php echo e($line['unit_price_inc_tax'], false); ?> 
								</td>
								<?php endif; ?>

								<td class="price text-right"><?php echo e($line['line_total'], false); ?></td>
								<?php
									$line_total_discounts += $line['total_line_discount'];
								?>
	                        <?php endif; ?>
	                    </tr>
						<?php if($line['type'] == 'Package'): ?>
                            <?php $__currentLoopData = $receipt_details->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(($item['parent_sell_line_id'] == $parent_id) && ($item['children_type'] == 'combo') && ($item['sell_line_note'] != 'Combo Item')): ?>
								    <tr>
										<td class="serial_number" style="vertical-align: top;"></td>
										<td class="">
											<?php echo e($item['name'], false); ?> <?php echo e($item['product_variation'], false); ?> <?php echo e($item['variation'], false); ?>

											<?php if(!empty($item['sub_sku'])): ?>, <?php echo e($item['sub_sku'], false); ?> <?php endif; ?> <?php if(!empty($item['brand'])): ?>, <?php echo e($item['brand'], false); ?> <?php endif; ?> <?php if(!empty($item['cat_code'])): ?>, <?php echo e($item['cat_code'], false); ?><?php endif; ?>
											<?php if(!empty($item['product_custom_fields'])): ?>, <?php echo e($item['product_custom_fields'], false); ?> <?php endif; ?>
											<?php if(!empty($item['product_description'])): ?>
												<div class="f-8">
													<?php echo $item['product_description']; ?>

												</div>
											<?php endif; ?>
											<?php if(!empty($item['sell_line_note'])): ?>
											<br>
											<span class="f-8">
											<?php echo $item['sell_line_note']; ?>

											</span>
											<?php endif; ?> 
											<?php if(!empty($item['lot_number'])): ?><br> <?php echo e($item['lot_number_label'], false); ?>:  <?php echo e($item['lot_number'], false); ?> <?php endif; ?> 
											<?php if(!empty($item['product_expiry'])): ?>, <?php echo e($item['product_expiry_label'], false); ?>:  <?php echo e($item['product_expiry'], false); ?> <?php endif; ?>
											<?php if(!empty($item['warranty_name'])): ?>
												<br>
												<small>
													<?php echo e($item['warranty_name'], false); ?>

												</small>
											<?php endif; ?>
											<?php if(!empty($item['warranty_exp_date'])): ?>
												<small>
													- <?php echo e(\Carbon::createFromTimestamp(strtotime($item['warranty_exp_date']))->format(session('business.date_format')), false); ?>

											</small>
											<?php endif; ?>
											<?php if(!empty($item['warranty_description'])): ?>
												<small> <?php echo e($item['warranty_description'] ?? '', false); ?></small>
											<?php endif; ?>

											<?php if($receipt_details->show_base_unit_details && $item['quantity'] && $item['base_unit_multiplier'] !== 1): ?>
												<br><small>
													1 <?php echo e($item['units'], false); ?> = <?php echo e($item['base_unit_multiplier'], false); ?> <?php echo e($item['base_unit_name'], false); ?> <br>
													<?php echo e($item['base_unit_price'], false); ?> x <?php echo e($item['orig_quantity'], false); ?> = <?php echo e($item['line_total'], false); ?>

												</small>
											<?php endif; ?>

											<!-- Waiter info -->
											<?php if(!empty($receipt_details->service_staff_label) && !empty($item['service_staff'])): ?>
												<br>
												<small>	
												<strong><?php echo e($receipt_details->service_staff_label, false); ?>:</strong>
												<br><?php echo e($item['service_staff'], false); ?>

												</small>
											<?php endif; ?>
											<?php if(!empty($receipt_details->preparation_time_label) && !empty($item['preparation_time'])): ?>
											<br><?php echo e($receipt_details->preparation_time_label, false); ?> : <?php echo e($item['preparation_time'], false); ?> mins
											<?php endif; ?>
										</td>
										<td class="text-right">
										<?php if(!$kot_print['seperate_kot']): ?>
											<?php echo e($item['quantity'], false); ?> 
											<?php if(!empty($receipt_details->show_unit)): ?>
												<?php echo e($item['units'], false); ?> 
											<?php endif; ?> 
											<?php if($receipt_details->show_base_unit_details && $item['quantity'] && $item['base_unit_multiplier'] !== 1): ?>
											<br>
											<small>
												<?php echo e($item['quantity'], false); ?> x <?php echo e($item['base_unit_multiplier'], false); ?> = <?php echo e($item['orig_quantity'], false); ?> <?php echo e($item['base_unit_name'], false); ?>

											</small>
											<?php endif; ?>
										<?php else: ?>
											1 <?php if(!empty($receipt_details->show_unit)): ?>
												<?php echo e($item['units'], false); ?> 
											<?php endif; ?>
											<?php if($receipt_details->show_base_unit_details && $item['quantity'] && $item['base_unit_multiplier'] !== 1): ?>
											<br>
											<small>
												<?php echo e($item['quantity'], false); ?> x <?php echo e($item['base_unit_multiplier'], false); ?> = <?php echo e($item['orig_quantity'], false); ?> <?php echo e($item['base_unit_name'], false); ?>

											</small>
											<?php endif; ?>
										<?php endif; ?>
										</td>
										<?php if(empty($receipt_details->hide_price_total) && !$package_has_sp): ?>
											<td class="text-right"><?php echo e($item['unit_price_before_discount'], false); ?></td>
											
											

											<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
											<td class="text-right">
												<?php echo e($item['unit_price_inc_tax'], false); ?> 
											</td>
											<?php endif; ?>

											<td class="price text-right"><?php echo e($item['line_total'], false); ?></td>
											<?php
												$item_total_discounts += $item['total_line_discount'];
											?>
										<?php endif; ?>
									</tr>
								<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>

	                    <?php if(!empty($line['modifiers'])): ?>
							<?php $__currentLoopData = $line['modifiers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td>
										&nbsp;
									</td>
									<td>
			                            <?php echo e($modifier['name'], false); ?> <?php echo e($modifier['variation'], false); ?> 
			                            <?php if(!empty($modifier['sub_sku'])): ?>, <?php echo e($modifier['sub_sku'], false); ?> <?php endif; ?> <?php if(!empty($modifier['cat_code'])): ?>, <?php echo e($modifier['cat_code'], false); ?><?php endif; ?>
			                            <?php if(!empty($modifier['sell_line_note'])): ?>(<?php echo $modifier['sell_line_note']; ?>) <?php endif; ?> 
			                        </td>
									<td class="text-right"><?php echo e($modifier['quantity'], false); ?> <?php echo e($modifier['units'], false); ?> </td>
									<?php if(empty($receipt_details->hide_price_total)): ?>
										<td class="text-right"><?php echo e($modifier['unit_price_inc_tax'], false); ?></td>
										<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
											<td class="text-right"><?php echo e($modifier['unit_price_exc_tax'], false); ?></td>
										<?php endif; ?>
										<?php if(!empty($receipt_details->inline_units_discount_total_label)): ?>
											<td class="text-right">0.00</td>
										<?php endif; ?>
										<td class="text-right"><?php echo e($modifier['line_total'], false); ?></td>
									<?php endif; ?>
								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
						<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
					<?php $current_set_order_kot2 = null; ?>
					<?php $__empty_3 = true; $__currentLoopData = $receipt_details->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_3 = false; ?>
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
	                        <td class="serial_number" style="vertical-align: top;">
	                        	<?php echo e($loop->iteration, false); ?>

	                        </td>
	                        <td class="description">
	                        	<?php echo e($line['name'], false); ?> <?php echo e($line['product_variation'], false); ?> <?php echo e($line['variation'], false); ?> 
	                        	<?php if(!empty($line['sub_sku'])): ?>, <?php echo e($line['sub_sku'], false); ?> <?php endif; ?> <?php if(!empty($line['brand'])): ?>, <?php echo e($line['brand'], false); ?> <?php endif; ?> <?php if(!empty($line['cat_code'])): ?>, <?php echo e($line['cat_code'], false); ?><?php endif; ?>
	                        	<?php if(!empty($line['product_custom_fields'])): ?>, <?php echo e($line['product_custom_fields'], false); ?> <?php endif; ?>
	                        	<?php if(!empty($line['product_description'])): ?>
	                            	<div class="f-8">
	                            		<?php echo $line['product_description']; ?>

	                            	</div>
	                            <?php endif; ?>
	                        	<?php if(!empty($line['sell_line_note'])): ?>
	                        	<br>
	                        	<span class="f-8">
	                        	<?php echo $line['sell_line_note']; ?>

	                        	</span>
	                        	<?php endif; ?> 
	                        	<?php if(!empty($line['lot_number'])): ?><br> <?php echo e($line['lot_number_label'], false); ?>:  <?php echo e($line['lot_number'], false); ?> <?php endif; ?> 
	                        	<?php if(!empty($line['product_expiry'])): ?>, <?php echo e($line['product_expiry_label'], false); ?>:  <?php echo e($line['product_expiry'], false); ?> <?php endif; ?>
	                        	<?php if(!empty($line['warranty_name'])): ?>
	                            	<br>
	                            	<small>
	                            		<?php echo e($line['warranty_name'], false); ?>

	                            	</small>
	                            <?php endif; ?>
	                            <?php if(!empty($line['warranty_exp_date'])): ?>
	                            	<small>
	                            		- <?php echo e(\Carbon::createFromTimestamp(strtotime($line['warranty_exp_date']))->format(session('business.date_format')), false); ?>

	                            </small>
	                            <?php endif; ?>
	                            <?php if(!empty($line['warranty_description'])): ?>
	                            	<small> <?php echo e($line['warranty_description'] ?? '', false); ?></small>
	                            <?php endif; ?>

	                            <?php if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1): ?>
		                            <br><small>
		                            	1 <?php echo e($line['units'], false); ?> = <?php echo e($line['base_unit_multiplier'], false); ?> <?php echo e($line['base_unit_name'], false); ?> <br>
                            			<?php echo e($line['base_unit_price'], false); ?> x <?php echo e($line['orig_quantity'], false); ?> = <?php echo e($line['line_total'], false); ?>

		                            </small>
		                            <?php endif; ?>
								
									<!-- Waiter info -->
								<?php if(!empty($receipt_details->service_staff_label) && !empty($line['service_staff'])): ?>
										<br>
										<small>	
										<strong><?php echo $receipt_details->service_staff_label; ?>:</strong>
											<?php echo e($line['service_staff'], false); ?>

										</small>
								<?php endif; ?>
								<?php if(!empty($receipt_details->preparation_time_label) && !empty($line['preparation_time'])): ?>
								<br><?php echo e($receipt_details->preparation_time_label, false); ?> : <?php echo e($line['preparation_time'], false); ?> mins
								<?php endif; ?>
									
							</td>
	                        <td class="quantity text-right"><?php echo e($line['quantity'], false); ?> <?php echo e($line['units'], false); ?> <?php if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1): ?>
                            <br><small>
                            	<?php echo e($line['quantity'], false); ?> x <?php echo e($line['base_unit_multiplier'], false); ?> = <?php echo e($line['orig_quantity'], false); ?> <?php echo e($line['base_unit_name'], false); ?>

                            </small>
                            <?php endif; ?></td>
	                        <?php if(empty($receipt_details->hide_price_total)): ?>
								
								<td class="unit_price text-right"><?php echo e($line['unit_price_inc_tax'], false); ?></td>

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
	                        	<td class="price text-right"><?php echo e($line['line_total'], false); ?></td>
	                        <?php endif; ?>
							<?php
									$line_total_discounts += $line['total_line_discount'];
							?>
	                    </tr>
	                    <?php if(!empty($line['modifiers'])): ?>
							<?php $__currentLoopData = $line['modifiers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td>
										&nbsp;
									</td>
									<td>
			                            <?php echo e($modifier['name'], false); ?> <?php echo e($modifier['variation'], false); ?> 
			                            <?php if(!empty($modifier['sub_sku'])): ?>, <?php echo e($modifier['sub_sku'], false); ?> <?php endif; ?> <?php if(!empty($modifier['cat_code'])): ?>, <?php echo e($modifier['cat_code'], false); ?><?php endif; ?>
			                            <?php if(!empty($modifier['sell_line_note'])): ?>(<?php echo $modifier['sell_line_note']; ?>) <?php endif; ?> 
			                        </td>
									<td class="text-right"><?php echo e($modifier['quantity'], false); ?> <?php echo e($modifier['units'], false); ?> </td>
									<?php if(empty($receipt_details->hide_price_total)): ?>
									<td class="text-right"><?php echo e($modifier['unit_price_inc_tax'], false); ?></td>
									<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
										<td class="text-right"><?php echo e($modifier['unit_price_exc_tax'], false); ?></td>
									<?php endif; ?>
									<?php if(!empty($receipt_details->inline_units_discount_total_label)): ?>
										<td class="text-right">0.00</td>
									<?php endif; ?>
									<td class="text-right"><?php echo e($modifier['line_total'], false); ?></td>
									<?php endif; ?>
								</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					<?php endif; ?>
                    <tr>
                    	<td <?php if(!empty($receipt_details->inline_units_discount_total_label)): ?> colspan="6" <?php else: ?> colspan="5" <?php endif; ?>>&nbsp;</td>
                    	<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
    					<td></td>
    					<?php endif; ?>
                    </tr>
                					<?php if($current_set_order_kot !== null): ?>
						<tr><td colspan="20" style="border-bottom:2px solid #333;padding:0;"></td></tr>
					<?php endif; ?>
					<?php if($current_set_order_kot2 !== null): ?>
						<tr><td colspan="20" style="border-bottom:2px solid #333;padding:0;"></td></tr>
					<?php endif; ?>
</tbody>
            </table>

			<?php if(empty($receipt_details->hide_price_total)): ?>
                <div class="flex-box subtotal-bold-row" style="font-weight: <?php echo e(!empty($receipt_details->sub_total_inc_tax_bold) ? '700' : '400', false); ?> !important;">
                    <p class="left text-right">
                    	<?php echo $receipt_details->subtotal_label; ?>

                    </p>
                    <p class="width-50 text-right">
                    	<?php echo e($receipt_details->subtotal_unformatted+$line_total_discounts, false); ?>

                    </p>
                </div>
				
				<?php
					$new_discount_total = ($receipt_details->subtotal_unformatted - $receipt_details->total_unformatted) + $line_total_discounts;
				?>
				
				

				<?php if( !empty($receipt_details->line_discount_label) && !empty($new_discount_Ttotal)): ?>
					<div class="flex-box">
						<p class="width-50 text-right">
							<?php echo $receipt_details->line_discount_label; ?>

						</p>

						<p class="width-50 text-right">
							(-) <?php echo e($new_discount_total, false); ?>

						</p>
					</div>
				<?php endif; ?>

				<?php if(!empty($receipt_details->types_of_service) && !empty($receipt_details->packing_charge)): ?>
					<div class="flex-box">
						<p class="left text-right">
							
							<?php echo e($receipt_details->types_of_service, false); ?>

						</p>
						<p class="width-50 text-right">
							<?php echo e($receipt_details->packing_charge, false); ?>

						</p>
					</div>
				<?php endif; ?>
				
				<?php if(!empty($receipt_details->total)): ?>
					<div class="flex-box">
						<p class="width-50 text-right sub-headings">
							<?php echo $receipt_details->total_label; ?>

						</p>
						<p class="width-50 text-right sub-headings">
							<?php echo e($receipt_details->total, false); ?>

						</p>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			
        </div>
    </body>
</html>

<style type="text/css">
.kot-print-root .f-8 {
	font-size: 8px !important;
}
<?php
	$__slim_font = (!empty($receipt_details->slim_receipt_font)) ? $receipt_details->slim_receipt_font : ((!empty($pos_settings['slim_receipt_font'])) ? $pos_settings['slim_receipt_font'] : 'Verdana');
	$__font_stack = "'" . $__slim_font . "', Geneva, sans-serif";
?>
.kot-print-root {
	color: #000 !important;
	background-color: #fff !important;
}
	.kot-print-root *, .kot-print-root :after, .kot-print-root :before {
    	font-size: 12px;
    	font-family: <?php echo $__font_stack; ?>;
    	word-break: break-word;
		color: #000 !important;
		-webkit-print-color-adjust: exact !important;
		print-color-adjust: exact !important;
	}
	.kot-print-root .f-8 {
		font-size: 8px !important;
	}
	
.kot-print-root .headings{
	font-size: 16px;
	font-weight: 700;
	text-transform: uppercase;
	white-space: nowrap;
}

.kot-print-root .sub-headings{
	font-size: 15px !important;
	font-weight: 700 !important;
}

.kot-print-root .subtotal-bold-row .sub-headings{
	font-weight: inherit !important;
}

.kot-print-root .receipt-header-block {
	margin: 0 !important;
}

.kot-print-root .receipt-kot-heading {
	display: block;
	margin: 0 !important;
	padding: 0 !important;
	line-height: 1.05;
}

.kot-print-root .border-top{
    border-top: 1px solid #242424;
}
.kot-print-root .border-bottom{
	border-bottom: 1px solid #242424;
}

.kot-print-root .border-bottom-dotted{
	border-bottom: 1px dotted darkgray;
}

.kot-print-root td.serial_number, .kot-print-root th.serial_number{
	width: 5%;
    max-width: 5%;
}

.kot-print-root td.description,
.kot-print-root th.description {
    width: 35%;
    max-width: 35%;
}

.kot-print-root td.quantity,
.kot-print-root th.quantity {
    width: 15%;
    max-width: 15%;
    word-break: break-word;
}
.kot-print-root td.unit_price, .kot-print-root th.unit_price{
	width: 25%;
    max-width: 25%;
    word-break: break-word;
}

.kot-print-root td.price,
.kot-print-root th.price {
    width: 20%;
    max-width: 20%;
    word-break: break-word;
}

.kot-print-root .centered {
    text-align: center;
    align-content: center;
}

.kot-print-root.ticket {
    width: 100%;
    max-width: 100%;
}

.kot-print-root img {
    max-width: inherit;
    width: auto;
}

    .kot-print-root .hidden-print,
    .kot-print-root .hidden-print * {
        display: none !important;
    }
}
.kot-print-root .table-info {
	width: 100%;
}
.kot-print-root .table-info tr:first-child td, .kot-print-root .table-info tr:first-child th {
	padding-top: 8px;
}
.kot-print-root .table-info th {
	text-align: left;
}
.kot-print-root .table-info td {
	text-align: right;
}
.kot-print-root .logo {
	float: left;
	width:35%;
	padding: 10px;
}

.kot-print-root .text-with-image {
	float: left;
	width:65%;
}
.kot-print-root .text-box {
	width: 100%;
	height: auto;
}

.kot-print-root .textbox-info {
	clear: both;
}
.kot-print-root .textbox-info p {
	margin-bottom: 0px
}
.kot-print-root .flex-box {
	display: flex;
	width: 100%;
}
.kot-print-root .flex-box p {
	width: 50%;
	margin-bottom: 0px;
	white-space: nowrap;
}

.kot-print-root .table-f-12 th, .kot-print-root .table-f-12 td {
	font-size: 12px;
	word-break: break-word;
}

.kot-print-root .receipt-totals-divider {
	height: 0;
	line-height: 0;
	margin: 0;
	padding: 0;
}

.kot-print-root .receipt-additional-notes {
	margin: 2px 0 0;
}

.kot-print-root .bw {
	word-break: break-word;
}
</style>
