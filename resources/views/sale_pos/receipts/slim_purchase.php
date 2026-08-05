
<!-- business information here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?php echo e(asset('css/app.css?v='.$asset_v), false); ?>">
        <title>Receipt-<?php echo e($receipt_details->ref_no, false); ?></title>
    </head>
    <body>
		<div class="slim-purchase-print-root ticket">
			<?php if(empty($receipt_details->letter_head)): ?>
				<?php if(!empty($receipt_details->logo)): ?>
					<div class="text-box centered">
						<img style="max-height: 100px; width: auto;" src="<?php echo e($receipt_details->logo, false); ?>" alt="Logo">
					</div>
				<?php endif; ?>
				<div class="text-box">
				<!-- Logo -->
				<p class="centered receipt-header-block">
					<!-- Header text -->
					<?php if(!empty($receipt_details->header_text)): ?>
						<span class="headings"><?php echo $receipt_details->header_text; ?></span>
						<br/>
					<?php endif; ?>

					<!-- business information here -->
					
					<?php if(!empty($receipt_details->display_name)): ?>
						<span style="font-size:<?php echo e($receipt_details->business_name_font_size, false); ?>"><?php echo $receipt_details->display_name; ?></span>
					<br>
					<?php endif; ?>

					<?php if(!empty($receipt_details->address)): ?>
						<?php echo $receipt_details->address; ?>

					<?php endif; ?>

					<?php if(!empty($receipt_details->contact)): ?>
						<?php echo $receipt_details->contact; ?>

					<?php endif; ?>
					<?php if(!empty($receipt_details->contact)): ?>
					<?php endif; ?>
					<?php if(!empty($receipt_details->website)): ?>
					<?php endif; ?>
					<br>
					<?php if(!empty($receipt_details->website)): ?>
						<?php echo e($receipt_details->website, false); ?>

					<?php endif; ?>
					<?php if(!empty($receipt_details->location_custom_fields)): ?>
						<br><?php echo e($receipt_details->location_custom_fields, false); ?>

					<?php endif; ?>
					
					<?php if(!empty($receipt_details->sub_heading_line1)): ?>
					<br><?php echo e($receipt_details->sub_heading_line1, false); ?>

					<?php endif; ?>
					<?php if(!empty($receipt_details->sub_heading_line2)): ?>
					<br><?php echo e($receipt_details->sub_heading_line2, false); ?>

					<?php endif; ?>
					<?php if(!empty($receipt_details->sub_heading_line3)): ?>
					<br><?php echo e($receipt_details->sub_heading_line3, false); ?>

					<?php endif; ?>
					<?php if(!empty($receipt_details->sub_heading_line4)): ?>
					<br><?php echo e($receipt_details->sub_heading_line4, false); ?>

					<?php endif; ?>		
					<?php if(!empty($receipt_details->sub_heading_line5)): ?>
					<br><?php echo e($receipt_details->sub_heading_line5, false); ?>

					<?php endif; ?>

					<?php if(!empty($receipt_details->tax_info1)): ?>
						<br><b><?php echo e($receipt_details->tax_label1, false); ?></b> <?php echo e($receipt_details->tax_info1, false); ?>

					<?php endif; ?>

					<?php if(!empty($receipt_details->tax_info2)): ?>
						<b><?php echo e($receipt_details->tax_label2, false); ?></b> <?php echo e($receipt_details->tax_info2, false); ?>

					<?php endif; ?>

					<!-- Title of receipt -->
					<?php if(!empty($receipt_details->invoice_heading)): ?>
						<span class="receipt-invoice-heading sub-headings"><?php echo $receipt_details->invoice_heading; ?></span>
					<?php endif; ?>
					<!-- Title of receipt -->
					<?php if(!empty($receipt_details->invoice_heading2)): ?>
						<br><span class="sub-headings"><?php echo $receipt_details->invoice_heading2; ?></span>
					<?php endif; ?>
					<?php if(!empty($receipt_details->types_of_service)): ?>
						<br/>
						<span class="textbox-info">
							<strong><?php echo $receipt_details->types_of_service_label; ?></strong>
							<?php echo e($receipt_details->types_of_service, false); ?>

							<!-- Waiter info -->
							<?php if(!empty($receipt_details->types_of_service_custom_fields)): ?>
							<?php $__currentLoopData = $receipt_details->types_of_service_custom_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<strong><?php echo e($key, false); ?>: </strong> <?php echo e($value, false); ?>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</span>
					<?php endif; ?>
				</p>
				</div>
			<?php else: ?>
				<div class="text-box">
					<img style="width: 100%;margin-bottom: 10px;" src="<?php echo e($receipt_details->letter_head, false); ?>">
				</div>
			<?php endif; ?>
			<div class="border-top textbox-info">
				<p class="f-left"><strong><?php echo $receipt_details->invoice_no_prefix; ?></strong></p>
				<p class="f-right">
					<?php echo e($receipt_details->ref_no, false); ?>

				</p>
			</div>
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

        	<!-- Waiter info -->
			<?php if(!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff)): ?>
	        	<div class="textbox-info">
	        		<p class="f-left"><strong>
	        			<?php echo $receipt_details->service_staff_label; ?>

	        		</strong></p>
	        		<p class="f-right">
	        			<?php echo e($receipt_details->service_staff, false); ?>

					</p>
	        	</div>
	        <?php endif; ?>


	        <!-- customer info -->
	        <div class="textbox-info">
				<p class="f-left">
					<strong>
	        			<?php echo e($receipt_details->customer_label ?? '', false); ?>

	        		</strong>
				</p>

	        	<p class="f-right">
	        		<?php if(!empty($receipt_details->customer_info)): ?>
						<?php echo $receipt_details->customer_info; ?>

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

			<?php if(!empty($receipt_details->purchase_order_ref_no)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong>
						<?php echo app('translator')->get('restaurant.order_no'); ?>
					</strong></p>
					<p class="f-right">
						<?php echo $receipt_details->purchase_order_ref_no ?? ''; ?>

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
			<br>
			<?php if(!empty($receipt_details->customer_note)): ?>
				<strong>Customer Note: </strong> 
				<br/>
				<?php echo nl2br($receipt_details->customer_note); ?>

            <?php endif; ?>
            <table style="margin-top: 5px !important" class="border-bottom width-100 table-f-12 mb-10">
                <thead class="border-top textbox-info border-bottom-dotted">
                    <tr>
						<?php if(empty($receipt_details->hide_sr_number)): ?>
                        <th class="serial_number">#</th>
						<?php endif; ?>
                        <?php if(!empty($receipt_details->table_product_label)): ?>
						<th class="width-40">
                        	<?php echo e($receipt_details->table_product_label, false); ?>

                        </th>
						<?php endif; ?>
						<?php if(!empty($receipt_details->table_qty_label)): ?>
                        <th class=" text-right">
                        	<?php echo e($receipt_details->table_qty_label, false); ?>

                        </th>
						<?php endif; ?>
						<?php if(!empty($receipt_details->table_foc_quantity_label)): ?>
                        <th class="text-right"><?php echo e($receipt_details->table_foc_quantity_label, false); ?></th>
                        <?php endif; ?>

                        <?php if(empty($receipt_details->hide_price) && empty($is_delivery_note)): ?>
							<?php if(!empty($receipt_details->table_unit_price_label)): ?>
							<th class=" text-right">
								<?php echo e($receipt_details->table_unit_price_label, false); ?>

							</th>
							<?php endif; ?>
							<?php if(!empty($receipt_details->price_inc_tax_label)): ?>
							<th class="text-right">
								<?php echo e($receipt_details->price_inc_tax_label, false); ?>

							</th>
							<?php endif; ?>
							<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
							<th class="text-right">
								<?php echo e($receipt_details->inline_unit_discounted_rate_label, false); ?>

							</th>
							<?php endif; ?>
							<?php if(!empty($receipt_details->inline_units_discount_total_label)): ?>
							<th class="text-right"><?php echo e($receipt_details->inline_units_discount_total_label, false); ?></th>
							<?php endif; ?>
							<?php if(!empty($receipt_details->table_subtotal_exc_tax_label)): ?>
                        	<th class="text-right"><?php echo e($receipt_details->table_subtotal_exc_tax_label, false); ?></th>
							<?php endif; ?>
							<?php if(!empty($receipt_details->table_subtotal_label)): ?>
                        	<th class="text-right"><?php echo e($receipt_details->table_subtotal_label, false); ?></th>
							<?php endif; ?>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
					<?php $__empty_17 = true; $__currentLoopData = $receipt_details->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_17 = false; ?>
						<tr>
							<?php if(empty($receipt_details->hide_sr_number)): ?>
							<td class="serial_number" style="vertical-align: top;">
								<?php echo e($loop->iteration, false); ?>

							</td>
							<?php endif; ?>
							<td>
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

								<?php if(!empty($receipt_details->serial_number_label)): ?>
									
									<br>
									<?php echo e($receipt_details->serial_number_label, false); ?>: <?php echo e($line['serial_number'], false); ?>

									
									<?php endif; ?>
									<?php if(!empty($receipt_details->imei_number_labels)): ?>
									
									<?php $__currentLoopData = $receipt_details->imei_number_labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $inl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if(!empty($line['imei_numbers'][$key])): ?>
										<br>
										<?php echo e($inl, false); ?> : <?php echo e($line['imei_numbers'][$key], false); ?>    
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									
								<?php endif; ?>

								<?php if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1): ?>
									<br><small>
										1 <?php echo e($line['units'], false); ?> = <?php echo e($line['base_unit_multiplier'], false); ?> <?php echo e($line['base_unit_name'], false); ?> <br>
										<?php echo e($line['base_unit_price'], false); ?> x <?php echo e($line['orig_quantity'], false); ?> = <?php echo e($line['line_total'], false); ?>

									</small>
									<?php endif; ?>
								
								<!-- Waiter info -->
								<?php if(!empty($receipt_details->service_staff_label)): ?>
									<br>
									<small>		
									<strong><?php echo $receipt_details->service_staff_label; ?>:</strong>
											<?php echo e($line['service_staff'], false); ?>

									</small>
								<?php endif; ?>
							</td>
							<?php if(!empty($receipt_details->table_qty_label)): ?>
							<td class="quantity text-right">
								<?php echo e($line['quantity'], false); ?> <?php if(!empty($receipt_details->show_unit)): ?> <br><?php echo e($line['units'], false); ?> <?php endif; ?>
								<?php if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1): ?>
								<div style="display:block; white-space:nowrap;"><?php echo e($line['orig_quantity'], false); ?> <?php echo e($line['base_unit_name'], false); ?></div>
								<?php endif; ?>
								</td>
							<?php endif; ?>
							<?php if(empty($receipt_details->hide_price) && empty($is_delivery_note)): ?>
								
								<?php if(!empty($receipt_details->table_unit_price_label)): ?>
									<td class=" text-right">
										<?php echo e($line['unit_price_before_discount'], false); ?>

									</td>
								<?php endif; ?>

								<?php if(!empty($receipt_details->price_inc_tax_label)): ?>
									<td class=" text-right">
										<?php echo e($line['unit_price_inc_tax'], false); ?>

									</td>
								<?php endif; ?>

								<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
									<td class="text-right">
										<?php echo e($line['unit_price'], false); ?> 
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
								<?php if(!empty($receipt_details->table_subtotal_exc_tax_label)): ?>
								<td class=" text-right">
									
										<?php echo e($line['line_total_exc_tax'], false); ?>

									
									
									
									
								</td>
								<?php endif; ?>
								<?php if(!empty($receipt_details->table_subtotal_label)): ?>
								<td class=" text-right">
									
										<?php echo e($line['line_total'], false); ?>

									
									
									
									
								</td>
								<?php endif; ?>
							<?php endif; ?>
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
									<?php if(empty($receipt_details->hide_price)): ?>
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
                    
                </tbody>
            </table>
			<?php if(!empty($receipt_details->total_quantity_label)): ?>
				<div class="flex-box">
					<p class="left text-right">
						<?php echo $receipt_details->total_quantity_label; ?>

					</p>
					<p class="width-50 text-right">
						<?php echo e(implode(', ',$receipt_details->total_quantity), false); ?>

					</p>
				</div>
			<?php endif; ?>
			<?php if(!empty($receipt_details->total_items_label)): ?>
				<div class="flex-box">
					<p class="left text-right">
						<?php echo $receipt_details->total_items_label; ?>

					</p>
					<p class="width-50 text-right">
						<?php echo e($receipt_details->total_items, false); ?>

					</p>
				</div>
			<?php endif; ?>
			<?php if(empty($receipt_details->hide_price) && empty($is_delivery_note)): ?>
                <?php if(!empty($receipt_details->subtotal_label)): ?>
					<div class="flex-box subtotal-bold-row" style="font-weight: <?php echo e(!empty($receipt_details->sub_total_inc_tax_bold) ? '700' : '400', false); ?> !important;">
						<p class="left text-right sub-headings">
							<?php echo $receipt_details->subtotal_label; ?>

						</p>
						<p class="width-50 text-right sub-headings">
							<?php echo e($receipt_details->subtotal, false); ?>

						</p>
					</div>
				<?php endif; ?>

                <!-- Shipping Charges -->
				<?php if(!empty($receipt_details->shipping_charges)): ?>
					<div class="flex-box">
						<p class="left text-right">
							<?php echo $receipt_details->shipping_charges_label; ?>

						</p>
						<p class="width-50 text-right">
							<?php echo e($receipt_details->shipping_charges, false); ?>

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

				<!-- Discount -->
				<?php if(!empty($receipt_details->discount) && !empty($receipt_details->discount_label)): ?>
					<div class="flex-box">
						<p class="width-50 text-right">
							<?php echo $receipt_details->discount_label; ?>

						</p>

						<p class="width-50 text-right">
							(-) <?php echo e($receipt_details->discount, false); ?>

						</p>
					</div>
				<?php endif; ?>

				<!-- Discount 2 -->
				<?php if(!empty($receipt_details->discount2) && !empty($receipt_details->discount2_label)): ?>
					<div class="flex-box">
						<p class="width-50 text-right">
							<?php echo $receipt_details->discount2_label; ?>

						</p>

						<p class="width-50 text-right">
							(-) <?php echo e($receipt_details->discount2, false); ?>

						</p>
					</div>
				<?php endif; ?>
				
				<?php if( !empty($receipt_details->total_line_discount) && !empty($receipt_details->line_discount_label)): ?>
					<div class="flex-box">
						<p class="width-50 text-right">
							<?php echo $receipt_details->line_discount_label; ?>

						</p>

						<p class="width-50 text-right">
							(-) <?php echo e($receipt_details->total_line_discount, false); ?>

						</p>
					</div>
				<?php endif; ?>
				
				<?php if( !empty($receipt_details->total_line_taxes) && !empty($receipt_details->tax_label)): ?>
					<div class="flex-box">
						<p class="width-50 text-right">
							<?php echo $receipt_details->line_tax_label; ?>

						</p>
						<p class="width-50 text-right">
							(+) <?php echo e($receipt_details->total_line_taxes, false); ?>

						</p>
					</div>
				<?php endif; ?> 
				
				
				
				<?php if( !empty($receipt_details->additional_expenses) ): ?>
					<?php $__currentLoopData = $receipt_details->additional_expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="flex-box">
							<p class="width-50 text-right">
								<?php echo e($key, false); ?>:
							</p>

							<p class="width-50 text-right">
								(+) <?php echo e($val, false); ?>

							</p>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>

				<?php if(!empty($receipt_details->reward_point_label) ): ?>
					<div class="flex-box">
						<p class="width-50 text-right">
							<?php echo $receipt_details->reward_point_label; ?>

						</p>

						<p class="width-50 text-right">
							(-) <?php echo e($receipt_details->reward_point_amount, false); ?>

						</p>
					</div>
				<?php endif; ?>
				
				<?php if(!empty($receipt_details->tax_label)): ?> 
					<div class="flex-box">
						<p class="width-50 text-right">
							<?php echo $receipt_details->tax_label; ?>

						</p>
						<p class="width-50 text-right">
							(+) <?php echo e($receipt_details->tax, false); ?>

						</p>
					</div>
				<?php endif; ?>

				<?php if( $receipt_details->round_off_amount > 0): ?>
					<div class="flex-box">
						<p class="width-50 text-right">
							<?php echo $receipt_details->round_off_label; ?> 
						</p>
						<p class="width-50 text-right">
							<?php echo e($receipt_details->round_off, false); ?>

						</p>
					</div>
				<?php endif; ?>

				<div class="flex-box">
					<p class="width-50 text-right sub-headings">
						<?php echo $receipt_details->total_label; ?>

					</p>
					<p class="width-50 text-right sub-headings">
						<?php echo e($receipt_details->total, false); ?>

					</p>
				</div>
				<?php if(!empty($receipt_details->total_in_words)): ?>
				<p colspan="2" class="text-right mb-0">
					<small>
					(<?php echo e($receipt_details->total_in_words, false); ?>)
					</small>
				</p>
				<?php endif; ?>
				<?php if(!empty($receipt_details->payments)): ?>
					<?php $__currentLoopData = $receipt_details->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="flex-box">
							<p class="width-50 text-right"><?php echo e($payment['method'], false); ?> <?php if(!empty($receipt_details->show_payment_date)): ?>(<?php echo e($payment['date'], false); ?>)<?php endif; ?> </p>
							<p class="width-50 text-right"><?php echo e($payment['amount'], false); ?></p>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>

				<!-- Total Paid-->
				<?php if(!empty($receipt_details->total_paid_label) && !empty($receipt_details->total_paid)): ?>
					<div class="flex-box">
						<p class="width-50 text-right">
							<?php echo $receipt_details->total_paid_label; ?>

						</p>
						<p class="width-50 text-right">
							<?php echo e($receipt_details->total_paid, false); ?>

						</p>
					</div>
				<?php endif; ?>

				<!-- Total Due-->
				
				<?php if(!empty($receipt_details->all_due)): ?>
					<div class="flex-box">
						<p class="width-50 text-right">
							<?php echo $receipt_details->all_bal_label; ?>

						</p>
						<p class="width-50 text-right">
							<?php echo e($receipt_details->all_due, false); ?>

						</p>
					</div>
				<?php endif; ?>
				<?php if(!empty($receipt_details->total_due) && !empty($receipt_details->total_due_label)): ?>
					<div class="flex-box">
						<p class="width-50 text-right">
							<?php echo $receipt_details->total_due_label; ?>

						</p>
						<p class="width-50 text-right">
							<?php echo e($receipt_details->total_due, false); ?>

						</p>
					</div>
				<?php endif; ?>
			<?php endif; ?>
            <div class="receipt-totals-divider border-bottom width-100"></div>
            <?php if(empty($receipt_details->hide_price) && !empty($receipt_details->tax_summary_label) ): ?>
	            <!-- tax -->
	            <?php if(!empty($receipt_details->taxes)): ?>
	            	<table class="border-bottom width-100 table-f-12">
	            		<tr>
	            			<th colspan="2" class="text-center"><?php echo e($receipt_details->tax_summary_label, false); ?></th>
	            		</tr>
	            		<?php $__currentLoopData = $receipt_details->taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	            			<tr>
	            				<td class="left"><?php echo e($key, false); ?></td>
	            				<td class="right"><?php echo e($val, false); ?></td>
	            			</tr>
	            		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	            	</table>
	            <?php endif; ?>
            <?php endif; ?>

            <?php if(!empty($receipt_details->additional_notes)): ?>
	            <p class="centered receipt-additional-notes">
	            	<?php echo nl2br($receipt_details->additional_notes); ?>

	            </p>
            <?php endif; ?>

		<div class="container" style="padding-top:5px;">
		
		<?php if(!empty($receipt_details->fbr_pos_id) && $receipt_details->disable_fbr != 1): ?>
		<div class="row text-center">
			<?php if($receipt_details->fbr_invoice_no != "Not Available"): ?>
				<?php if($receipt_details->tax_image == 1): ?>
				<img style="margin-left:15px;" class="img-fluid" height="90px" width="90px" src="<?php echo e(env('APP_URL'), false); ?>/uploads/fbr-logo.png">
				<?php endif; ?>
				<?php if($receipt_details->tax_image == 2): ?>
				<img style="margin-left:15px;" class="img-fluid" height="90px" width="90px" src="<?php echo e(env('APP_URL'), false); ?>/uploads/pra-logo.png">
				<?php endif; ?>
				
				<span style="margin-left:50px;">
					<img class="img-fluid" height="90px" width="90px" src="data:image/png;base64,<?php echo e(DNS2D::getBarcodePNG($receipt_details->fbr_invoice_no, 'QRCODE', 3, 3, [39, 48, 54]), false); ?>">
				</span>
			<?php endif; ?>
		</div>
		<br>
		<p class="text-center"> 
			<?php if($receipt_details->tax_image == 1): ?>
				<b>FBR Inv No: </b> <?php echo e($receipt_details->fbr_invoice_no, false); ?><br>
				<?php if($receipt_details->fbr_invoice_no != "Not Available"): ?>
				<b>FBR POS ID:</b> <?php echo e($receipt_details->fbr_pos_id, false); ?><br>
				<b>Date:</b> <?php echo e($receipt_details->invoice_date, false); ?><br>
				<?php else: ?>
					<b>POS ID Invalid</b>
				<?php endif; ?>
			<?php endif; ?>
			<?php if($receipt_details->tax_image == 2): ?>
				<b>PRA Inv No: </b> <?php echo e($receipt_details->fbr_invoice_no, false); ?><br>
				<?php if($receipt_details->fbr_invoice_no != "Not Available"): ?>
				<b>PRA Pos ID:</b> <?php echo e($receipt_details->fbr_pos_id, false); ?><br>
				<b>Date:</b> <?php echo e($receipt_details->invoice_date, false); ?><br>
				<?php else: ?>
					<b>POS ID Invalid</b>
				<?php endif; ?>
			<?php endif; ?>
		</p>
		<?php endif; ?>
		
			</div>

            
			<?php if($receipt_details->show_barcode): ?>
				<br/>
				<img class="center-block" src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true), false); ?>">
			<?php endif; ?>

			<?php if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text)): ?>
				<img class="center-block mt-5" src="data:image/png;base64,<?php echo e(DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE'), false); ?>">
			<?php endif; ?>
			
			<?php if(!empty($receipt_details->footer_logo)): ?>
				<div class="text-box centered">
					<img style="max-height: 100px; width: auto;" src="<?php echo e($receipt_details->footer_logo, false); ?>" alt="Footer Logo">
				</div>
			<?php endif; ?>
			
			<?php if(!empty($receipt_details->footer_text)): ?>
				<p class="centered">
					<?php echo $receipt_details->footer_text; ?>

				</p>
			<?php endif; ?>
			
        </div>
		<div>
            <?php if(!$receipt_details->hide_invoice_branding): ?>
            <small>
                <p style="text-align: left; font-size:10px;"><?php echo env('BRANDING_TEXT'); ?></p>
            </small>
            <?php endif; ?>
        </div>
    </body>
</html>

<style type="text/css">
.slim-purchase-print-root .f-8 {
	font-size: 8px !important;
}
<?php
	$__slim_font = (!empty($receipt_details->slim_receipt_font)) ? $receipt_details->slim_receipt_font : ((!empty($pos_settings['slim_receipt_font'])) ? $pos_settings['slim_receipt_font'] : 'Verdana');
	$__font_stack = "'" . $__slim_font . "', Geneva, sans-serif";
?>
.slim-purchase-print-root {
	color: #000 !important;
	background-color: #fff !important;
}
	.slim-purchase-print-root *, .slim-purchase-print-root :after, .slim-purchase-print-root :before {
    	font-size: 12px;
    	font-family: <?php echo $__font_stack; ?>;
    	word-break: break-word;
		color: #000 !important;
		-webkit-print-color-adjust: exact !important;
		print-color-adjust: exact !important;
	}
	.slim-purchase-print-root .f-8 {
		font-size: 8px !important;
	}
	
.slim-purchase-print-root .headings{
	font-size: 16px;
	font-weight: 700;
	text-transform: uppercase;
	white-space: nowrap;
}

.slim-purchase-print-root .sub-headings{
	font-size: 15px !important;
	font-weight: 700 !important;
}

.slim-purchase-print-root .subtotal-bold-row .sub-headings{
	font-weight: inherit !important;
}

.slim-purchase-print-root .receipt-header-block {
	margin: 0 !important;
}

.slim-purchase-print-root .receipt-invoice-heading {
	display: block;
	margin: 0 !important;
	padding: 0 !important;
	line-height: 1.05;
}

.slim-purchase-print-root .border-top{
    border-top: 1px solid #242424;
}
.slim-purchase-print-root .border-bottom{
	border-bottom: 1px solid #242424;
}

.slim-purchase-print-root .border-bottom-dotted{
	border-bottom: 1px dotted darkgray;
}

.slim-purchase-print-root td.serial_number, .slim-purchase-print-root th.serial_number{
	width: 5%;
    max-width: 5%;
}

.slim-purchase-print-root td.description,
.slim-purchase-print-root th.description {
    width: 35%;
    max-width: 35%;
}

.slim-purchase-print-root td.quantity,
.slim-purchase-print-root th.quantity {
    width: 15%;
    max-width: 15%;
    word-break: break-word;
}
.slim-purchase-print-root td.unit_price, .slim-purchase-print-root th.unit_price{
	width: 25%;
    max-width: 25%;
    word-break: break-word;
}

.slim-purchase-print-root td.price,
.slim-purchase-print-root th.price {
    width: 20%;
    max-width: 20%;
    word-break: break-word;
}

.slim-purchase-print-root .centered {
    text-align: center;
    align-content: center;
}

.slim-purchase-print-root.ticket {
    width: 100%;
    max-width: 100%;
}

.slim-purchase-print-root img {
    max-width: inherit;
    width: auto;
}

    .slim-purchase-print-root .hidden-print,
    .slim-purchase-print-root .hidden-print * {
        display: none !important;
    }
}
.slim-purchase-print-root .table-info {
	width: 100%;
}
.slim-purchase-print-root .table-info tr:first-child td, .slim-purchase-print-root .table-info tr:first-child th {
	padding-top: 8px;
}
.slim-purchase-print-root .table-info th {
	text-align: left;
}
.slim-purchase-print-root .table-info td {
	text-align: right;
}
.slim-purchase-print-root .logo {
	float: left;
	width:35%;
	padding: 10px;
}

.slim-purchase-print-root .text-with-image {
	float: left;
	width:65%;
}
.slim-purchase-print-root .text-box {
	width: 100%;
	height: auto;
}

.slim-purchase-print-root .textbox-info {
	clear: both;
}
.slim-purchase-print-root .textbox-info p {
	margin-bottom: 0px
}
.slim-purchase-print-root .flex-box {
	display: flex;
	width: 100%;
}
.slim-purchase-print-root .flex-box p {
	width: 50%;
	margin-bottom: 0px;
	white-space: nowrap;
}

.slim-purchase-print-root .table-f-12 th, .slim-purchase-print-root .table-f-12 td {
	font-size: 12px;
	word-break: break-word;
}

.slim-purchase-print-root .receipt-totals-divider {
	height: 0;
	line-height: 0;
	margin: 0;
	padding: 0;
}

.slim-purchase-print-root .receipt-additional-notes {
	margin: 2px 0 0;
}

.slim-purchase-print-root .bw {
	word-break: break-word;
}
</style>
