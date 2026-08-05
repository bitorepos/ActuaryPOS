
<!-- business information here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?php echo e(asset('css/app.css?v='.$asset_v), false); ?>">
		<?php $_rc_cs = isset($common_settings) && is_array($common_settings) ? $common_settings : (session()->get('business.common_settings') ?? []); ?>
		<?php if(!empty($_rc_cs['enable_urdu_typing'] ?? false)): ?>
		<style type="text/css">
			@font-face {
				font-family: 'NooriNastaleeq';
				src: url('<?php echo e(asset('/fonts/noori-nastaleeq-regular.ttf'), false); ?>') format('truetype');
				font-weight: normal;
				font-style: normal;
			}
			.receipt-print-root input, .receipt-print-root b, .receipt-print-root p, .receipt-print-root i, .receipt-print-root th, .receipt-print-root td, .receipt-print-root .product_box_menu_item {
				font-family: 'NooriNastaleeq';
			}
			/* #search_product, #products_search_text, #search_product_for_purchase_return, .product_box_menu_item, #product_table_filter > label > input, td {
				font-family: 'NooriNastaleeq';
			} */
		</style>
		<?php endif; ?>
        <title>Receipt-<?php echo e($receipt_details->invoice_no, false); ?></title>
    </head>
    <body>
		<div class="receipt-print-root ticket">
			<?php if(empty($receipt_details->letter_head)): ?>
				<div class="slim3-top-header">
				<div class="textbox-info slim3-business-header">
					<?php if(!empty($receipt_details->logo)): ?>
						<div class="col-6 f-left slim3-business-logo">
							<img style="max-height: 80px; width: auto;" src="<?php echo e($receipt_details->logo, false); ?>" alt="Logo">
						</div>
					<?php endif; ?>
					
					<!-- Logo -->
					<p class="col-6 f-right slim3-business-info">
						<!-- Header text -->
						<?php if(!empty($receipt_details->header_text)): ?>
							<span class="headings"><?php echo $receipt_details->header_text; ?></span>
							<br/>
						<?php endif; ?>

						<!-- business information here -->
						
						<?php if(!empty($receipt_details->display_name)): ?>
							<span style="font-size:<?php echo e($receipt_details->business_name_font_size, false); ?>;font-weight:600"><?php echo $receipt_details->display_name; ?></span>
						<br>
						<?php endif; ?>

						<?php if(!empty($receipt_details->location_name)): ?>
						<span><?php echo $receipt_details->location_name; ?></span>
						<br>
						<?php endif; ?>

						<?php if(!empty($receipt_details->address)): ?>
							<?php echo $receipt_details->address; ?>

						<?php endif; ?>

						<?php if(!empty($receipt_details->contact)): ?>
							<?php echo $receipt_details->contact; ?>

						<?php endif; ?>

						<?php if(!empty($receipt_details->website)): ?>
							<br>
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
					</p>
					
				</div>
				<div class="text-box centered slim3-tax-header">
					<!-- FBR / PRA & QR Code Section -->
					<?php if($receipt_details->disable_fbr != 1): ?>

						<?php if($receipt_details->fbr_invoice_no != "Not Available" && !empty($receipt_details->fbr_invoice_no)): ?>
							<div class="text-center m-3">
								<?php if(!empty($receipt_details->fbr_invoice_no)): ?>
									<?php if($receipt_details->fbr_di): ?>
										<img class="mx-auto tax-authority-logo" height="80px" width="80px" src="<?php echo e(asset('uploads/fbr-di-logo.png'), false); ?>">
										<img class="mx-auto" height="80px" width="80px" src="data:image/png;base64,<?php echo e(DNS2D::getBarcodePNG($receipt_details->fbr_invoice_no, 'QRCODE', 3, 3, [39, 48, 54]), false); ?>">
										<br>
										<b>FBR Inv No: </b> <?php echo e($receipt_details->fbr_invoice_no, false); ?><br>
										<b>Date: </b> <?php echo e($receipt_details->invoice_date, false); ?><br>
									<?php else: ?>
										<img class="mx-auto tax-authority-logo" height="80px" width="80px" src="<?php echo e(asset('uploads/fbr-logo.png'), false); ?>">
										<img class="mx-auto" height="80px" width="80px" src="data:image/png;base64,<?php echo e(DNS2D::getBarcodePNG($receipt_details->fbr_invoice_no, 'QRCODE', 3, 3, [39, 48, 54]), false); ?>">
										<br>    
										<b>FBR Inv No: </b> <?php echo e($receipt_details->fbr_invoice_no, false); ?><br>
										<?php if($receipt_details->fbr_invoice_no != "Not Available"): ?>
											<?php if(empty($receipt_details->fbr_pos_id)): ?>
												<b>FBR POS ID:</b> <?php echo e(substr($receipt_details->fbr_invoice_no, 0, 6), false); ?><br>
												<b>Date:</b> <?php echo e($receipt_details->invoice_date, false); ?><br>	
											<?php else: ?>
												<b>FBR POS ID:</b> <?php echo e($receipt_details->fbr_pos_id, false); ?><br>
												<b>Date:</b> <?php echo e($receipt_details->invoice_date, false); ?><br>	
											<?php endif; ?>
										<?php else: ?>
											<b>POS ID Invalid</b>
										<?php endif; ?>
									<?php endif; ?> 
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<?php if($receipt_details->pra_invoice_no != "Not Available" && !empty($receipt_details->pra_invoice_no)): ?>
						<div class="text-center m-3">
							<?php if(!empty($receipt_details->pra_invoice_no)): ?>
								<img class="mx-auto tax-authority-logo" height="80px" width="80px" src="<?php echo e(asset('uploads/pra-logo.png'), false); ?>">
								<img class="mx-auto" height="80px" width="80px" src="data:image/png;base64,<?php echo e(DNS2D::getBarcodePNG($receipt_details->pra_invoice_no, 'QRCODE', 3, 3, [39, 48, 54]), false); ?>">
								<br>
								<b>PRA Inv No: </b> <?php echo e($receipt_details->pra_invoice_no, false); ?><br>
								<?php if($receipt_details->pra_invoice_no != "Not Available"): ?>
									<?php if(empty($receipt_details->pra_pos_id)): ?>
										<b>PRA Pos ID:</b> <?php echo e(substr($receipt_details->pra_invoice_no, 0, 6), false); ?><br>
										<b>Date:</b> <?php echo e($receipt_details->invoice_date, false); ?><br>
									<?php else: ?>
										<b>PRA Pos ID:</b> <?php echo e($receipt_details->pra_pos_id, false); ?><br>
										<b>Date:</b> <?php echo e($receipt_details->invoice_date, false); ?><br>
									<?php endif; ?>
								<?php else: ?>
									<b>POS ID Invalid</b>
								<?php endif; ?>
							<?php endif; ?>
						</div>
						<?php endif; ?>
					<?php endif; ?>

					<?php if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text)): ?>
						<div class="text-center" style="margin-bottom: 5px;">
							<img class="center-block" height="80px" width="80px" src="data:image/png;base64,<?php echo e(DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE'), false); ?>">
						</div>
					<?php endif; ?>
				</div>
				</div>

				<div class="text-box centered slim3-invoice-title">
					<!-- Title of receipt -->
						<?php if(empty($is_delivery_note)): ?>
						<?php if(!empty($receipt_details->invoice_heading)): ?>
						<h3 class="receipt-invoice-heading text-center">
							<?php echo $receipt_details->invoice_heading; ?>

						</h3>
							
						<?php endif; ?>
						<?php else: ?>
						<br><span class="sub-headings"><h4>Delivery Note</h4></span>
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
				</div>
			<?php else: ?>
				<div class="text-box">
					<img style="width: 100%;margin-bottom: 10px;" src="<?php echo e($receipt_details->letter_head, false); ?>">
				</div>
			<?php endif; ?>
			<?php
				$customer_contact_number = trim(($receipt_details->customer_mobile ?? '') . (!empty($receipt_details->customer_landline) ? ', ' . $receipt_details->customer_landline : ''));
				$customer_inline_details = [];
				if (!empty($receipt_details->client_id_label) && !empty($receipt_details->client_id)) {
					$customer_inline_details[] = '<span><strong>' . e($receipt_details->client_id_label) . '</strong> ' . e($receipt_details->client_id) . '</span>';
				}
				if (!empty($receipt_details->customer_tax_label) && !empty($receipt_details->customer_tax_number)) {
					$customer_inline_details[] = '<span><strong>' . e($receipt_details->customer_tax_label) . '</strong> ' . e($receipt_details->customer_tax_number) . '</span>';
				}
				if (!empty($customer_contact_number)) {
					$customer_inline_details[] = '<span><strong>' . e(__('contact.contact_info')) . ':</strong> ' . e($customer_contact_number) . '</span>';
				}
			?>
			<table style="width:100%; border:none; border-collapse:collapse; margin-bottom: 5px;" class="border-top textbox-info slim3-customer-invoice-table">
				<tr>
					<td style="width:50%; vertical-align:top; text-align:left; padding-right:5px; border:none;">
						<!-- customer info -->
						<div class="textbox-info">
							<p class="f-left mr-1">
								<strong>
									<?php echo e($receipt_details->customer_label ?? '', false); ?>

								</strong>
							</p>

							<p class="">
								<br>
								<?php if(!empty($receipt_details->customer_contact_address)): ?>
									<?php echo $receipt_details->customer_contact_address; ?>

								<?php elseif(!empty($receipt_details->customer_info)): ?>
									<?php echo $receipt_details->customer_info; ?>

								<?php endif; ?>
							</p>
						</div>
						
						<?php if(!empty($customer_inline_details)): ?>
							<div class="textbox-info slim3-customer-inline">
								<?php echo implode('', $customer_inline_details); ?>

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

						<?php if(!empty($receipt_details->customer_note)): ?>
							<div class="textbox-info" style="margin-top: 5px;">
								<strong>Customer Note: </strong> 
								<br/>
								<?php echo nl2br($receipt_details->customer_note); ?>

							</div>
						<?php endif; ?>
					</td>
					<td class="slim3-invoice-cell" style="width:50%; vertical-align:top; text-align:right; padding-left:5px; border:none;">
						<div class="slim3-invoice-meta">
							<?php if(!empty($receipt_details->invoice_no_prefix)): ?>
							<div class="slim3-invoice-meta-row">
								<strong><?php echo $receipt_details->invoice_no_prefix; ?></strong>
								<span><?php echo e($receipt_details->invoice_no, false); ?></span>
							</div>
							<?php endif; ?>
							<div class="slim3-invoice-meta-row">
								<strong><?php echo $receipt_details->date_label; ?></strong>
								<span><?php echo e($receipt_details->invoice_date, false); ?></span>
							</div>
							<?php if(!empty($receipt_details->ref_no_label)): ?>
								<div class="slim3-invoice-meta-row">
									<strong><?php echo $receipt_details->ref_no_label; ?></strong>
									<span><?php echo e($receipt_details->ref_no, false); ?></span>
								</div>
							<?php endif; ?>
							<?php if(!empty($receipt_details->due_date_label)): ?>
								<div class="slim3-invoice-meta-row">
									<strong><?php echo e($receipt_details->due_date_label, false); ?></strong>
									<span><?php echo e($receipt_details->due_date ?? '', false); ?></span>
								</div>
							<?php endif; ?>
							
							<?php if(!empty($receipt_details->token_no)): ?>
								<div class="slim3-invoice-meta-row">
									<strong><?php echo e(!empty($receipt_details->token_no_label) ? $receipt_details->token_no_label : 'Token No', false); ?>:</strong>
									<span><?php echo e($receipt_details->token_no ?? '', false); ?></span>
								</div>		
							<?php endif; ?>
						</div>

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

						<?php if(!empty($receipt_details->defects_label) || !empty($receipt_details->repair_defects)): ?>
							<div class="textbox-info">
								<p class="f-left"><strong>
									<?php echo $receipt_details->defects_label; ?>

								</strong></p>
								<p class="f-right">
									<?php echo e($receipt_details->repair_defects, false); ?>

								</p>
							</div>
						<?php endif; ?>

						<?php if(!empty($receipt_details->repair_checklist_label) || !empty($receipt_details->repair_checklist)): ?>
							<div class="textbox-info">
								<p class="f-left"><strong>
									<?php echo $receipt_details->repair_checklist_label; ?>

								</strong></p>
								<p class="f-right">
									<?php echo e($receipt_details->repair_checklist, false); ?>

								</p>
							</div>
						<?php endif; ?>

						<?php if(!empty($receipt_details->repair_collection_label) || !empty($receipt_details->repair_collection_info)): ?>
							<div class="textbox-info">
								<p class="f-left"><strong>
									<?php echo $receipt_details->repair_collection_label; ?>

								</strong></p>
								<p class="f-right">
									<?php echo $receipt_details->repair_collection_info; ?>

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

						<?php if(!empty($receipt_details->table_label) && !empty($receipt_details->table)): ?>
							<div class="textbox-info">
								<p class="f-left">
									<strong>
										<?php if(!empty($receipt_details->table_label)): ?>
											<b><?php echo $receipt_details->table_label; ?></b>
										<?php endif; ?>
									</strong>
								</p>
								<p class="f-right">
									<?php echo e($receipt_details->table, false); ?>

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
					</td>
				</tr>
			</table>
            <table style="margin-top: 5px !important" class="border-bottom width-100 table-f-12 mb-10 slim-products-table">
                <thead class="border-top textbox-info border-bottom-dotted">
                    <tr>
						<?php if(empty($receipt_details->hide_sr_number)): ?>
                        <th class="serial_number">#</th>
						<?php endif; ?>
                        <?php if(!empty($receipt_details->table_product_label)): ?>
						<th class="description">
                        	<?php echo e($receipt_details->table_product_label, false); ?>

                        </th>
						<?php endif; ?>
						<?php if(!empty($receipt_details->table_qty_label)): ?>
                        <th class="quantity text-right">
                        	<?php echo e($receipt_details->table_qty_label, false); ?>

                        </th>
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
							<?php if(!empty($receipt_details->inline_group_tax_columns)): ?>
								<?php $__currentLoopData = $receipt_details->inline_group_tax_columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax_column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<th class="text-right"><?php echo e($tax_column, false); ?></th>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?>
								<?php if(!empty($receipt_details->product_tax_label)): ?>
								<th class="text-right"><?php echo e($receipt_details->product_tax_label, false); ?></th>
								<?php endif; ?>
								<?php if(!empty($receipt_details->inline_product_tax_total_label)): ?>
								<th class="text-right"><?php echo e($receipt_details->inline_product_tax_total_label, false); ?></th>
								<?php endif; ?>
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
					<?php if($receipt_details->group_products_by_categories): ?>
						<?php
						$count = 0;
						?>
						<?php $__currentLoopData = $receipt_details->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
							$cat_line_count = 0;
							foreach($receipt_details->lines as $line){
								if($line['category_id'] == $key){
									$cat_line_count ++;
								}
							}
							if($cat_line_count == 0){
								continue;
							}
							?>
							
							<tr ckass="text-center">
								<td></td>
								<td><b><?php echo e($name, false); ?><b></td>
							</tr>

							<?php $current_set_order_slim3_cat = null; ?>
							<?php $__empty_9 = true; $__currentLoopData = $receipt_details->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_9 = false; ?>
							<?php
								if($line['category_id'] != $key){
									continue;
								}
								if($line['parent_sell_line_id'] == null){
									$count++;
								}
								
								$parent_id = $line['line_id'];
								if($line['type'] == 'Package'){
									$package_has_sp = $line['package_show_price'];
								}else{
									$package_has_sp = 1;
								}
							?>
							<?php if($current_set_order_slim3_cat !== null && $line['parent_sell_line_id'] == null && (empty($line['product_set_name']) || $line['product_set_order'] != $current_set_order_slim3_cat)): ?>
							    <tr><td colspan="20" style="border-bottom:2px solid #333;padding:0;"></td></tr>
							    <?php $current_set_order_slim3_cat = null; ?>
							<?php endif; ?>
							<?php if(!empty($line['product_set_name']) && $line['product_set_order'] != $current_set_order_slim3_cat && $line['parent_sell_line_id'] == null): ?>
								<?php $current_set_order_slim3_cat = $line['product_set_order']; ?>
<tr>
    <td colspan="20" style="padding:4px 8px;background:#f0f0f0;">
        <strong><i><?php echo e($line['product_set_name'], false); ?> #<?php echo e($line['product_set_order'], false); ?></i></strong>
    </td>
</tr>
							<?php endif; ?>
							<?php if($line['parent_sell_line_id'] == null): ?>
								<tr>
									<?php if(empty($receipt_details->hide_sr_number)): ?>
									<td class="serial_number" style="vertical-align: top;">
										<?php echo e($count, false); ?>

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
									<td class="quantity text-center">
										<?php echo e($line['quantity'], false); ?> <?php if(!empty($receipt_details->show_unit)): ?> <br><?php echo e($line['units'], false); ?> <?php endif; ?>
										<?php if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1): ?>
										<div style="display:block; white-space:nowrap;"><?php echo e($line['orig_quantity'], false); ?> <?php echo e($line['base_unit_name'], false); ?></div>
										<?php endif; ?>
										</td>
									<?php endif; ?>
									<?php if(empty($receipt_details->hide_price) && $package_has_sp && empty($is_delivery_note)): ?>
										
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
										<?php if(!empty($receipt_details->inline_group_tax_columns)): ?>
											<?php $__currentLoopData = $receipt_details->inline_group_tax_columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax_column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<td class="text-right"><?php echo e($line['group_tax_amounts'][$tax_column] ?? '0.00', false); ?></td>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
											<?php if(!empty($receipt_details->product_tax_label)): ?>
											
											<td class="text-right"><?php echo e($line['tax'], false); ?></td>
											<?php endif; ?>
											<?php if(!empty($receipt_details->inline_product_tax_total_label)): ?>
											<td class="text-right"><?php echo e($line['line_tax_total_f'], false); ?></td>
											<?php endif; ?>
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
							<?php endif; ?>
							<?php if($line['type'] == 'Package'): ?>
								<?php $__currentLoopData = $receipt_details->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if(($item['parent_sell_line_id'] == $parent_id) && ($item['children_type'] == 'combo') && ($item['sell_line_note'] != 'Combo Item')): ?>
								<tr>
									<?php if(empty($receipt_details->hide_sr_number)): ?>
									<td class="serial_number" style="vertical-align: top;">
										
									</td>
									<?php endif; ?>
									<td>
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
										<?php if(!empty($receipt_details->service_staff_label)): ?>
											<br>
											<small>		
											<strong><?php echo $receipt_details->service_staff_label; ?>:</strong>
													<?php echo e($item['service_staff'], false); ?>

											</small>
										<?php endif; ?>
									</td>

									<td class="quantity text-center"><?php echo e($item['quantity'], false); ?> <?php if(!empty($receipt_details->show_unit)): ?> <br><?php echo e($item['units'], false); ?> <?php endif; ?>
									<?php if($receipt_details->show_base_unit_details && $item['quantity'] && $item['base_unit_multiplier'] !== 1): ?>
									<div style="display:block; white-space:nowrap;"><?php echo e($item['orig_quantity'], false); ?> <?php echo e($item['base_unit_name'], false); ?></div>
									<?php endif; ?></td>
									<?php if(empty($receipt_details->hide_price) && !$package_has_sp && empty($is_delivery_note)): ?>
									
									<?php if(!empty($receipt_details->table_unit_price_label)): ?>
										<td class=" text-right">
											<?php echo e($item['unit_price_before_discount'], false); ?>

										</td>
									<?php endif; ?>

									<?php if(!empty($receipt_details->price_inc_tax_label)): ?>
										<td class=" text-right">
											<?php echo e($item['unit_price_inc_tax'], false); ?>

										</td>
									<?php endif; ?>

									<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
										<td class="text-right">
											<?php echo e($item['unit_price'], false); ?> 
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
									<?php if(!empty($receipt_details->inline_group_tax_columns)): ?>
										<?php $__currentLoopData = $receipt_details->inline_group_tax_columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax_column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<td class="text-right"><?php echo e($item['group_tax_amounts'][$tax_column] ?? '0.00', false); ?></td>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php else: ?>
										<?php if(!empty($receipt_details->product_tax_label)): ?>
										
										<td class="text-right"><?php echo e($item['tax'], false); ?></td>
										<?php endif; ?>
										<?php if(!empty($receipt_details->inline_product_tax_total_label)): ?>
										<td class="text-right"><?php echo e($item['line_tax_total_f'], false); ?></td>
										<?php endif; ?>
									<?php endif; ?>
									<?php if(!empty($receipt_details->table_subtotal_exc_tax_label)): ?>
									<td class=" text-right">
										
											<?php echo e($item['line_total_exc_tax'], false); ?>

										
										
										
										
									</td>
									<?php endif; ?>
									<?php if(!empty($receipt_details->table_subtotal_label)): ?>
									<td class=" text-right">
										
											<?php echo e($item['line_total'], false); ?>

										
										
										
										
									</td>
									<?php endif; ?>
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
											<?php if(empty($receipt_details->hide_price)): ?>
												<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
													<td class="text-right"><?php echo e($modifier['unit_price_exc_tax'], false); ?></td>
												<?php endif; ?>
												<td class="text-right"><?php echo e($modifier['unit_price_inc_tax'], false); ?></td>
												
											<?php endif; ?>
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
					<?php $current_set_order_slim3 = null; ?>
					<?php $__empty_10 = true; $__currentLoopData = $receipt_details->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_10 = false; ?>
					<?php
						$parent_id = $line['line_id'];
						if($line['type'] == 'Package'){
							$package_has_sp = $line['package_show_price'];
						}else{
							$package_has_sp = 1;
						}
                    ?>
					<?php if($current_set_order_slim3 !== null && $line['parent_sell_line_id'] == null && (empty($line['product_set_name']) || $line['product_set_order'] != $current_set_order_slim3)): ?>
					    <tr><td colspan="20" style="border-bottom:2px solid #333;padding:0;"></td></tr>
					    <?php $current_set_order_slim3 = null; ?>
					<?php endif; ?>
					<?php if(!empty($line['product_set_name']) && $line['product_set_order'] != $current_set_order_slim3 && $line['parent_sell_line_id'] == null): ?>
						<?php $current_set_order_slim3 = $line['product_set_order']; ?>
<tr>
    <td colspan="20" style="padding:4px 8px;background:#f0f0f0;">
        <strong><i><?php echo e($line['product_set_name'], false); ?> #<?php echo e($line['product_set_order'], false); ?></i></strong>
    </td>
</tr>
					<?php endif; ?>
					<?php if($line['parent_sell_line_id'] == null): ?>
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
							<td class="quantity text-center">
								<?php echo e($line['quantity'], false); ?> <?php if(!empty($receipt_details->show_unit)): ?> <br><?php echo e($line['units'], false); ?> <?php endif; ?>
								<?php if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1): ?>
								<div style="display:block; white-space:nowrap;"><?php echo e($line['orig_quantity'], false); ?> <?php echo e($line['base_unit_name'], false); ?></div>
								<?php endif; ?>
								</td>
							<?php endif; ?>
	                        <?php if(empty($receipt_details->hide_price) && $package_has_sp && empty($is_delivery_note)): ?>
								
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
								<?php if(!empty($receipt_details->inline_group_tax_columns)): ?>
									<?php $__currentLoopData = $receipt_details->inline_group_tax_columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax_column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<td class="text-right"><?php echo e($line['group_tax_amounts'][$tax_column] ?? '0.00', false); ?></td>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php else: ?>
									<?php if(!empty($receipt_details->product_tax_label)): ?>
									
									<td class="text-right"><?php echo e($line['tax'], false); ?></td>
									<?php endif; ?>
									<?php if(!empty($receipt_details->inline_product_tax_total_label)): ?>
									<td class="text-right"><?php echo e($line['line_tax_total_f'], false); ?></td>
									<?php endif; ?>
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
					<?php endif; ?>
					<?php if($line['type'] == 'Package'): ?>
						<?php $__currentLoopData = $receipt_details->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if(($item['parent_sell_line_id'] == $parent_id) && ($item['children_type'] == 'combo') && ($item['sell_line_note'] != 'Combo Item')): ?>
						<tr>
							<?php if(empty($receipt_details->hide_sr_number)): ?>
	                        <td class="serial_number" style="vertical-align: top;">
	                        	
	                        </td>
							<?php endif; ?>
	                        <td>
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
								<?php if(!empty($receipt_details->service_staff_label)): ?>
									<br>
									<small>		
									<strong><?php echo $receipt_details->service_staff_label; ?>:</strong>
											<?php echo e($item['service_staff'], false); ?>

									</small>
								<?php endif; ?>
	                        </td>

	                        <td class="quantity text-right"><?php echo e($item['quantity'], false); ?> <?php if(!empty($receipt_details->show_unit)): ?> <br><?php echo e($item['units'], false); ?> <?php endif; ?>
							<?php if($receipt_details->show_base_unit_details && $item['quantity'] && $item['base_unit_multiplier'] !== 1): ?>
                            <div style="display:block; white-space:nowrap;"><?php echo e($item['orig_quantity'], false); ?> <?php echo e($item['base_unit_name'], false); ?></div>
                            <?php endif; ?></td>
	                        <?php if(empty($receipt_details->hide_price) && !$package_has_sp && empty($is_delivery_note)): ?>
	                        
							<?php if(!empty($receipt_details->table_unit_price_label)): ?>
								<td class=" text-right">
									<?php echo e($item['unit_price_before_discount'], false); ?>

								</td>
							<?php endif; ?>

							<?php if(!empty($receipt_details->price_inc_tax_label)): ?>
								<td class=" text-right">
									<?php echo e($item['unit_price_inc_tax'], false); ?>

								</td>
							<?php endif; ?>

	                        <?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
								<td class="text-right">
									<?php echo e($item['unit_price'], false); ?> 
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
							<?php if(!empty($receipt_details->inline_group_tax_columns)): ?>
								<?php $__currentLoopData = $receipt_details->inline_group_tax_columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax_column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<td class="text-right"><?php echo e($item['group_tax_amounts'][$tax_column] ?? '0.00', false); ?></td>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?>
								<?php if(!empty($receipt_details->product_tax_label)): ?>
								
								<td class="text-right"><?php echo e($item['tax'], false); ?></td>
								<?php endif; ?>
								<?php if(!empty($receipt_details->inline_product_tax_total_label)): ?>
								<td class="text-right"><?php echo e($item['line_tax_total_f'], false); ?></td>
								<?php endif; ?>
							<?php endif; ?>
							<?php if(!empty($receipt_details->table_subtotal_exc_tax_label)): ?>
	                        <td class=" text-right">
								
									<?php echo e($item['line_total_exc_tax'], false); ?>

								
								
								
								
							</td>
							<?php endif; ?>
							<?php if(!empty($receipt_details->table_subtotal_label)): ?>
	                        <td class=" text-right">
								
									<?php echo e($item['line_total'], false); ?>

								
								
								
								
							</td>
							<?php endif; ?>
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
									<?php if(empty($receipt_details->hide_price)): ?>
									<?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
										<td class="text-right"><?php echo e($modifier['unit_price_exc_tax'], false); ?></td>
									<?php endif; ?><td class="text-right"><?php echo e($modifier['unit_price_inc_tax'], false); ?></td>
									
									
									<?php endif; ?>
								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
                    
                					<?php if($current_set_order_slim3_cat !== null): ?>
						<tr><td colspan="20" style="border-bottom:2px solid #333;padding:0;"></td></tr>
					<?php endif; ?>
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
                <?php if(!empty($receipt_details->sub_total_exc_tax_label)): ?>
					<div class="flex-box subtotal-bold-row" style="font-weight: <?php echo e(!empty($receipt_details->sub_total_exc_tax_bold) ? '700' : '400', false); ?> !important;">
						<p class="left text-right sub-headings">
							<?php echo $receipt_details->sub_total_exc_tax_label; ?>

						</p>
						<p class="width-50 text-right sub-headings">
							<?php echo e($receipt_details->subtotal_exc_tax, false); ?>

						</p>
					</div>
				<?php endif; ?>

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
				<!-- Discount -->
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
				
				<?php if( !empty($receipt_details->line_tax_totals) || !empty($receipt_details->inline_group_tax_totals) || (!empty($receipt_details->total_line_taxes) && !empty($receipt_details->line_tax_label))): ?>
					<?php if(!empty($receipt_details->line_tax_totals)): ?>
						<?php $__currentLoopData = $receipt_details->line_tax_totals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax_label => $tax_total): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="flex-box">
								<p class="width-50 text-right">
									<?php echo e($tax_label, false); ?>:
								</p>
								<p class="width-50 text-right">
									(+) <?php echo e($tax_total, false); ?>

								</p>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php elseif(!empty($receipt_details->inline_group_tax_totals)): ?>
						<?php $__currentLoopData = $receipt_details->inline_group_tax_totals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax_column => $tax_total): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="flex-box">
								<p class="width-50 text-right">
									<?php echo e($tax_column, false); ?>:
								</p>
								<p class="width-50 text-right">
									(+) <?php echo e($tax_total, false); ?>

								</p>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
						<div class="flex-box">
							<p class="width-50 text-right">
								<?php echo $receipt_details->line_tax_label; ?>

							</p>
							<p class="width-50 text-right">
								(+) <?php echo e($receipt_details->total_line_taxes, false); ?>

							</p>
						</div>
					<?php endif; ?>
				<?php endif; ?> 
				
				

				<?php if( !empty($receipt_details->additional_expenses)): ?>
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
				<?php if(!empty($receipt_details->prev_bal) && !empty($receipt_details->prev_bal_label)): ?>
					<div class="flex-box">
						<p class="width-50 text-right"> 
							<?php echo $receipt_details->prev_bal_label; ?>

						</p>
						<p class="width-50 text-right">
							<?php echo e($receipt_details->prev_bal, false); ?>

						</p>
					</div>
				<?php endif; ?>
				<?php if(!empty($receipt_details->total_due) && !empty($receipt_details->total_due_label)): ?>
					<div class="flex-box">
						<p class="width-50 text-right">
							<?php echo $receipt_details->total_due_label; ?>

						</p>
						<b class="width-50 text-right">
							<?php echo e($receipt_details->total_due, false); ?>

						</b>
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
            
			<?php if($receipt_details->show_barcode): ?>
				<br/>
				<img class="center-block" src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true), false); ?>">
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
.receipt-print-root .f-8 {
	font-size: 8px !important;
}
<?php
	$__slim_font = (!empty($receipt_details->slim_receipt_font)) ? $receipt_details->slim_receipt_font : ((!empty($pos_settings['slim_receipt_font'])) ? $pos_settings['slim_receipt_font'] : 'Verdana');
	$__font_stack = "'" . $__slim_font . "', Geneva, sans-serif";
?>
.receipt-print-root {
	color: #000 !important;
	background-color: #fff !important;
}
	.receipt-print-root *, .receipt-print-root :after, .receipt-print-root :before {
    	font-size: 12px;
    	font-family: <?php echo $__font_stack; ?>;
    	word-break: break-word;
		color: #000 !important;
		-webkit-print-color-adjust: exact !important;
		print-color-adjust: exact !important;
	}
	.receipt-print-root .f-8 {
		font-size: 8px !important;
	}
	
.receipt-print-root .headings{
	font-size: 16px;
	font-weight: 700;
	text-transform: uppercase;
	white-space: nowrap;
}

.receipt-print-root .sub-headings{
	font-size: 15px !important;
	font-weight: 700 !important;
}

.receipt-print-root .subtotal-bold-row .sub-headings{
	font-weight: inherit !important;
}

.receipt-print-root .receipt-invoice-heading {
	display: block;
	margin: 10px !important;
	padding: 0 !important;
	line-height: 1.05;
	font-size: 18px;
	font-weight: 600 !important;
}

.receipt-print-root .slim3-top-header {
	display: flex;
	align-items: flex-start;
	justify-content: space-between;
	gap: 18px;
	width: 100%;
	clear: both;
}

.receipt-print-root .slim3-business-header {
	display: flex;
	align-items: flex-start;
	justify-content: flex-start;
	gap: 14px;
	flex: 0 0 52%;
	max-width: 52%;
	clear: none;
}

.receipt-print-root .slim3-business-logo,
.receipt-print-root .slim3-business-info {
	float: none !important;
	width: auto !important;
	max-width: none !important;
}

.receipt-print-root .slim3-business-logo {
	flex: 0 0 auto;
}

.receipt-print-root .slim3-business-info {
	flex: 1 1 auto;
	min-width: 0;
	margin: 0;
	text-align: left;
	line-height: 1.18;
	white-space: normal;
	overflow-wrap: break-word;
}

.receipt-print-root .slim3-tax-header {
	flex: 1 1 48%;
	max-width: 48%;
	margin: 0 !important;
	padding-top: 2px;
	text-align: center;
}

.receipt-print-root .slim3-tax-header .m-3 {
	margin: 0 !important;
}

.receipt-print-root .slim3-tax-header img {
	display: inline-block;
	vertical-align: middle;
}

.receipt-print-root .slim3-invoice-title {
	clear: both;
	margin-top: 4px;
}

.receipt-print-root .slim3-customer-invoice-table p {
	line-height: 1.16;
}

.receipt-print-root .slim3-customer-inline {
	display: flex;
	flex-wrap: wrap;
	gap: 0 12px;
	line-height: 1.16;
	margin-top: 1px;
}

.receipt-print-root .slim3-customer-inline span,
.receipt-print-root .slim3-invoice-meta-row strong,
.receipt-print-root .slim3-invoice-meta-row span {
	white-space: nowrap;
}

.receipt-print-root .slim3-invoice-meta {
	display: inline-block;
	max-width: 100%;
	text-align: left;
}

.receipt-print-root .slim3-invoice-meta-row {
	display: grid;
	grid-template-columns: max-content max-content;
	justify-content: end;
	column-gap: 14px;
	line-height: 1.16;
}

.receipt-print-root .border-top{
    border-top: 1px solid #242424;
}
.receipt-print-root .border-bottom{
	border-bottom: 1px solid #242424;
}

.receipt-print-root .border-bottom-dotted{
	border-bottom: 1px dotted darkgray;
}

.receipt-print-root td.serial_number, .receipt-print-root th.serial_number{
	width: 5%;
    max-width: 5%;
}

.receipt-print-root td.description,
.receipt-print-root th.description {
    width: 35%;
    max-width: 35%;
}

.receipt-print-root td.quantity,
.receipt-print-root th.quantity {
    width: 15%;
    max-width: 15%;
    word-break: break-word;
}
.receipt-print-root td.unit_price, .receipt-print-root th.unit_price{
	width: 25%;
    max-width: 25%;
    word-break: break-word;
}

.receipt-print-root td.price,
.receipt-print-root th.price {
    width: 20%;
    max-width: 20%;
    word-break: break-word;
}

.receipt-print-root .centered {
    text-align: center;
    align-content: center;
}

.receipt-print-root.ticket {
    width: 100%;
    max-width: 100%;
}

.receipt-print-root img {
    max-width: inherit;
    width: auto;
}

	.receipt-print-root .hidden-print,
	.receipt-print-root .hidden-print * {
        display: none !important;
    }
}
.receipt-print-root .table-info {
	width: 100%;
}
.receipt-print-root .table-info tr:first-child td, .receipt-print-root .table-info tr:first-child th {
	padding-top: 8px;
}
.receipt-print-root .table-info th {
	text-align: left;
}
.receipt-print-root .table-info td {
	text-align: right;
}
.receipt-print-root .logo {
	float: left;
	width:35%;
	padding: 10px;
}

.receipt-print-root .text-with-image {
	float: left;
	width:65%;
}
.receipt-print-root .text-box {
	width: 100%;
	height: auto;
}

.receipt-print-root .textbox-info {
	clear: both;
}
.textbox-info p {
	margin-bottom: 0px
}
.flex-box {
	display: flex;
	width: 100%;
}
.flex-box p {
	width: 50%;
	margin-bottom: 0px;
	white-space: nowrap;
}

.receipt-print-root .table-f-12 {
	width: 100%;
	table-layout: fixed;
}

.receipt-print-root td.serial_number,
.receipt-print-root th.serial_number {
	width: 4% !important;
	max-width: none;
	text-align: left !important;
	white-space: nowrap;
	word-break: normal;
	overflow-wrap: normal;
}

.receipt-print-root td.description,
.receipt-print-root th.description {
	width: 32% !important;
	max-width: none;
	text-align: left !important;
	white-space: normal;
	word-break: normal;
	overflow-wrap: break-word;
}

.receipt-print-root td.quantity,
.receipt-print-root th.quantity {
	width: 12% !important;
	max-width: none;
	text-align: right !important;
	word-break: normal;
	overflow-wrap: break-word;
}

.receipt-print-root td.unit_price,
.receipt-print-root th.unit_price,
.receipt-print-root td.price,
.receipt-print-root th.price,
.receipt-print-root .slim-products-table th.text-end:not(.serial_number):not(.description):not(.quantity),
.receipt-print-root .slim-products-table td.text-end:not(.serial_number):not(.description):not(.quantity),
.receipt-print-root .slim-products-table th.text-right:not(.serial_number):not(.description):not(.quantity),
.receipt-print-root .slim-products-table td.text-right:not(.serial_number):not(.description):not(.quantity) {
	width: 13% !important;
	max-width: none;
	text-align: right !important;
	word-break: normal;
	overflow-wrap: normal;
}

.receipt-print-root .slim-products-table th {
	font-size: 11px !important;
	line-height: 1.15;
	white-space: normal !important;
	overflow-wrap: break-word;
	vertical-align: bottom;
}

.receipt-print-root .slim-products-table td.text-end,
.receipt-print-root .slim-products-table td.text-right {
	white-space: nowrap;
}

.receipt-print-root .slim-products-table th:not(.serial_number):not(.quantity):not(.text-end):not(.text-right),
.receipt-print-root .slim-products-table td:not(.serial_number):not(.quantity):not(.text-end):not(.text-right) {
	width: auto;
	text-align: left;
	white-space: normal;
	word-break: normal;
	overflow-wrap: break-word;
}

.receipt-print-root .receipt-totals-divider {
	height: 0;
	line-height: 0;
	margin: 0;
	padding: 0;
}

.receipt-print-root .receipt-additional-notes {
	margin: 2px 0 0;
}

.receipt-print-root .table-f-12 th,
.receipt-print-root .table-f-12 td {
	font-size: 12px;
	word-break: break-word;
}

.bw {
	word-break: break-word;
}
</style>
