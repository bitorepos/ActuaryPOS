<style>
    @page { margin: 0; padding: 0; size: auto; }
	.receipt-print-root { color: #000 !important; background-color: #fff !important; }
    @media print {
		.receipt-print-root, .receipt-print-root *, .receipt-print-root :after, .receipt-print-root :before { color: #000 !important; background: #fff !important; text-shadow: none !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
		.receipt-print-root { height: auto !important; min-height: 0 !important; overflow: visible !important; }
        body.lockscreen, body.lockscreen > .wrapper, .wrapper { min-height: 0 !important; height: auto !important; overflow: visible !important; }
        .pos-content-wrapper { height: auto !important; min-height: 0 !important; max-height: none !important; overflow: visible !important; }
    }
</style>
<table class="receipt-print-root" style="width:100%; color: #000000 !important;">
	<tbody>
		<tr>
			<td>

<?php if(!empty($receipt_details->header_text)): ?>
	<div class="row invoice-info">
		<div class="col-12">
			<?php echo $receipt_details->header_text; ?>

		</div>
	</div>
<?php endif; ?>

<!-- business information here -->
<div class="row invoice-info">

	<div class="col-12 text-center color-555">
		
		<!-- Logo -->
		<?php if(!empty($receipt_details->logo)): ?>
			<img src="<?php echo e($receipt_details->logo, false); ?>" class="img">
			<br/>
		<?php endif; ?>

		<!-- Shop & Location Name  -->
		<?php if(!empty($receipt_details->display_name)): ?>
			<p>
				<strong><?php echo e($receipt_details->display_name, false); ?></strong>
				<?php if(!empty($receipt_details->address)): ?>
					<br/><?php echo $receipt_details->address; ?>

				<?php endif; ?>

				<?php if(!empty($receipt_details->contact)): ?>
					, <?php echo $receipt_details->contact; ?>

				<?php endif; ?>

				<?php if(!empty($receipt_details->website)): ?>
					, <?php echo e($receipt_details->website, false); ?>

				<?php endif; ?>

				<?php if(!empty($receipt_details->tax_info1)): ?>
					, <?php echo e($receipt_details->tax_label1, false); ?> <?php echo e($receipt_details->tax_info1, false); ?>

				<?php endif; ?>

				<?php if(!empty($receipt_details->tax_info2)): ?>
					, <?php echo e($receipt_details->tax_label2, false); ?> <?php echo e($receipt_details->tax_info2, false); ?>

				<?php endif; ?>

				<?php if(!empty($receipt_details->location_custom_fields)): ?>
					, <?php echo e($receipt_details->location_custom_fields, false); ?>

				<?php endif; ?>
			</p>
		<?php endif; ?>

		<!-- Table information-->
        <?php if(!empty($receipt_details->table_label) || !empty($receipt_details->table)): ?>
        	<p>
				<?php if(!empty($receipt_details->table_label)): ?>
					<?php echo $receipt_details->table_label; ?>

				<?php endif; ?>
				<?php echo e($receipt_details->table, false); ?>

			</p>
        <?php endif; ?>

		<!-- Waiter info -->
		<?php if(!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff)): ?>
        	<p>
				<?php if(!empty($receipt_details->service_staff_label)): ?>
					<?php echo $receipt_details->service_staff_label; ?>

				<?php endif; ?>
				<?php echo e($receipt_details->service_staff, false); ?>

			</p>
        <?php endif; ?>
	</div>

	<div class="col-12 text-center">

		<p>
			<?php if(!empty($receipt_details->invoice_no_prefix)): ?>
				<?php echo $receipt_details->invoice_no_prefix; ?>

			<?php endif; ?>

			<?php echo e($receipt_details->invoice_no, false); ?>


			<?php if(!empty($receipt_details->date_label)): ?>
				, <?php echo e($receipt_details->date_label, false); ?>

				<?php echo e($receipt_details->invoice_date, false); ?>

			<?php endif; ?>
		</p>
		<p>
			<strong><?php echo e($receipt_details->customer_label, false); ?></strong> <?php echo e($receipt_details->customer_name ?? '', false); ?> <br>
			<?php if(!empty($receipt_details->customer_info)): ?>
				<?php echo str_replace('<br>', ', ', $receipt_details->customer_info); ?>

			<?php endif; ?>
			<?php if(!empty($receipt_details->client_id_label)): ?>
				, 
				<strong><?php echo e($receipt_details->client_id_label, false); ?></strong> <?php echo e($receipt_details->client_id, false); ?>

			<?php endif; ?>
			<?php if(!empty($receipt_details->customer_tax_label)): ?>
				,
				<strong><?php echo e($receipt_details->customer_tax_label, false); ?></strong> <?php echo e($receipt_details->customer_tax_number, false); ?>

			<?php endif; ?>
			<?php if(!empty($receipt_details->customer_custom_fields)): ?>
				, <?php echo $receipt_details->customer_custom_fields; ?>

			<?php endif; ?>
			<?php if(!empty($receipt_details->sales_person_label)): ?>
				<br>
				<strong><?php echo e($receipt_details->sales_person_label, false); ?></strong> <?php echo e($receipt_details->sales_person, false); ?>

			<?php endif; ?>
		</p>
		<p>
			<?php if(!empty($receipt_details->sub_heading_line1)): ?>
				<?php echo e($receipt_details->sub_heading_line1, false); ?>

			<?php endif; ?>
			<?php if(!empty($receipt_details->sub_heading_line2)): ?>
				, <?php echo e($receipt_details->sub_heading_line2, false); ?>

			<?php endif; ?>
			<?php if(!empty($receipt_details->sub_heading_line3)): ?>
				, <?php echo e($receipt_details->sub_heading_line3, false); ?>

			<?php endif; ?>
			<?php if(!empty($receipt_details->sub_heading_line4)): ?>
				, <?php echo e($receipt_details->sub_heading_line4, false); ?>

			<?php endif; ?>		
			<?php if(!empty($receipt_details->sub_heading_line5)): ?>
				, <?php echo e($receipt_details->sub_heading_line5, false); ?>

			<?php endif; ?>
		</p>
	</div>
</div>


<div class="row color-555">
	<div class="col-12">
		<br/>
		<table class="table table-bordered table-no-top-cell-border">
			<thead>
				<tr style="background-color: #357ca5 !important; color: white !important; font-size: 20px !important" class="table-no-side-cell-border table-no-top-cell-border text-center">
					<td style="background-color: #357ca5 !important; color: white !important; width: 5% !important">#</td>
					
					<?php
						$p_width = 35;
					?>
					<?php if($receipt_details->show_cat_code != 1): ?>
						<?php
							$p_width = 45;
						?>
					<?php endif; ?>
					<td style="background-color: #357ca5 !important; color: white !important; width: <?php echo e($p_width, false); ?>% !important">
						<?php echo e($receipt_details->table_product_label, false); ?>

					</td>

					<?php if($receipt_details->show_cat_code == 1): ?>
						<td style="background-color: #357ca5 !important; color: white !important; width: 10% !important;"><?php echo e($receipt_details->cat_code_label, false); ?></td>
					<?php endif; ?>
					
					<td style="background-color: #357ca5 !important; color: white !important; width: 15% !important;">
						<?php echo e($receipt_details->table_qty_label, false); ?>

					</td>
					<td style="background-color: #357ca5 !important; color: white !important; width: 15% !important;">
						<?php echo e($receipt_details->table_unit_price_label, false); ?>

					</td>
					<td style="background-color: #357ca5 !important; color: white !important; width: 20% !important;">
						<?php echo e($receipt_details->table_subtotal_label, false); ?>

					</td>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $receipt_details->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td class="text-center">
							<?php echo e($loop->iteration, false); ?>

						</td>
						<td style="word-break: break-word;">
                            <?php echo e($line['name'], false); ?> <?php echo e($line['variation'], false); ?> 
                            <?php if(!empty($line['sub_sku'])): ?>, <?php echo e($line['sub_sku'], false); ?> <?php endif; ?> <?php if(!empty($line['brand'])): ?>, <?php echo e($line['brand'], false); ?> <?php endif; ?>
                            <?php if(!empty($line['sell_line_note'])): ?>(<?php echo e($line['sell_line_note'], false); ?>) <?php endif; ?>
                            <?php if(!empty($line['lot_number'])): ?><br> <?php echo e($line['lot_number_label'], false); ?>:  <?php echo e($line['lot_number'], false); ?> <?php endif; ?> 
                            <?php if(!empty($line['product_expiry'])): ?>, <?php echo e($line['product_expiry_label'], false); ?>:  <?php echo e($line['product_expiry'], false); ?> <?php endif; ?> 
                        </td>

						<?php if($receipt_details->show_cat_code == 1): ?>
	                        <td>
	                        	<?php if(!empty($line['cat_code'])): ?>
	                        		<?php echo e($line['cat_code'], false); ?>

	                        	<?php endif; ?>
	                        </td>
	                    <?php endif; ?>

						<td class="text-right">
							<?php echo e($line['quantity'], false); ?> <?php echo e($line['units'], false); ?>

						</td>
						<td class="text-right">
							<?php echo e($line['unit_price_exc_tax'], false); ?>

						</td>
						<td class="text-right">
							<?php echo e($line['line_total'], false); ?>

						</td>
					</tr>
					<?php if(!empty($line['modifiers'])): ?>
						<?php $__currentLoopData = $line['modifiers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td class="text-center">
									&nbsp;
								</td>
								<td>
		                            <?php echo e($modifier['name'], false); ?> <?php echo e($modifier['variation'], false); ?> 
		                            <?php if(!empty($modifier['sub_sku'])): ?>, <?php echo e($modifier['sub_sku'], false); ?> <?php endif; ?> 
		                            <?php if(!empty($modifier['sell_line_note'])): ?>(<?php echo e($modifier['sell_line_note'], false); ?>) <?php endif; ?> 
		                        </td>

								<?php if($receipt_details->show_cat_code == 1): ?>
			                        <td>
			                        	<?php if(!empty($modifier['cat_code'])): ?>
			                        		<?php echo e($modifier['cat_code'], false); ?>

			                        	<?php endif; ?>
			                        </td>
			                    <?php endif; ?>

								<td class="text-right">
									<?php echo e($modifier['quantity'], false); ?> <?php echo e($modifier['units'], false); ?>

								</td>
								<td class="text-right">
									<?php echo e($modifier['unit_price_exc_tax'], false); ?>

								</td>
								<td class="text-right">
									<?php echo e($modifier['line_total'], false); ?>

								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				<?php
					$lines = count($receipt_details->lines);
				?>

				<?php for($i = $lines; $i < 7; $i++): ?>
    				<tr>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    				</tr>
				<?php endfor; ?>

			</tbody>
		</table>
	</div>
</div>

<div class="row invoice-info color-555" style="page-break-inside: avoid !important">
	<div class="col-md-6 invoice-col width-50">
		<table class="table table-condensed">
			<?php if(!empty($receipt_details->payments)): ?>
				<?php $__currentLoopData = $receipt_details->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo $payment['method']; ?></td>
						<td><?php echo e($payment['amount'], false); ?></td>
						<td><?php echo e($payment['date'], false); ?></td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>
		</table>
		<b class="float-start">Authorized Signatory</b>
	</div>

	<div class="col-md-6 invoice-col width-50">
		<table class="table-no-side-cell-border table-no-top-cell-border width-100">
			<tbody>
				<tr class="color-555" style="font-weight: <?php echo e(!empty($receipt_details->sub_total_inc_tax_bold) ? '700' : '400', false); ?> !important;">
					<td style="width:50%">
						<?php echo $receipt_details->subtotal_label; ?>

					</td>
					<td class="text-right">
						<?php echo e($receipt_details->subtotal, false); ?>

					</td>
				</tr>
				
				<!-- Shipping Charges -->
				<?php if(!empty($receipt_details->shipping_charges)): ?>
					<tr class="color-555">
						<td style="width:50%">
							<?php echo $receipt_details->shipping_charges_label; ?>

						</td>
						<td class="text-right">
							<?php echo e($receipt_details->shipping_charges, false); ?>

						</td>
					</tr>
				<?php endif; ?>

				<!-- Tax -->
				<?php if(!empty($receipt_details->taxes)): ?>
					<?php $__currentLoopData = $receipt_details->taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr class="color-555">
							<td><?php echo e($k, false); ?></td>
							<td class="text-right">(+) <?php echo e($v, false); ?></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>

				<!-- Discount -->
				<?php if( !empty($receipt_details->discount) ): ?>
					<tr class="color-555">
						<td>
							<?php echo $receipt_details->discount_label; ?>

						</td>

						<td class="text-right">
							(-) <?php echo e($receipt_details->discount, false); ?>

						</td>
					</tr>
				<?php endif; ?>

				<?php if(!empty($receipt_details->group_tax_details)): ?>
					<?php $__currentLoopData = $receipt_details->group_tax_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr class="color-555">
							<td>
								<?php echo $key; ?>

							</td>
							<td class="text-right">
								(+) <?php echo e($value, false); ?>

							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
					<?php if( !empty($receipt_details->tax) ): ?>
						<tr class="color-555">
							<td>
								<?php echo $receipt_details->tax_label; ?>

							</td>
							<td class="text-right">
								(+) <?php echo e($receipt_details->tax, false); ?>

							</td>
						</tr>
					<?php endif; ?>
				<?php endif; ?>
				
				<!-- Total -->
				<tr>
					<th style="background-color: #357ca5 !important; color: white !important" class="font-23 padding-10">
						<?php echo $receipt_details->total_label; ?>

					</th>
					<td class="text-right font-23 padding-10" style="background-color: #357ca5 !important; color: white !important">
						<?php echo e($receipt_details->total, false); ?>

					</td>
				</tr>
			</tbody>
        </table>
	</div>
</div>

<div class="row color-555">
	<div class="col-6">
		<?php echo e($receipt_details->additional_notes, false); ?>

	</div>
</div>

<?php if($receipt_details->show_barcode): ?>
<br>
<div class="row">
		<div class="col-12">
			<img class="center-block" src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true), false); ?>">
		</div>
</div>
<?php endif; ?>

<?php if(!empty($receipt_details->footer_text)): ?>
	<div class="row color-555">
		<div class="col-12">
			<?php echo $receipt_details->footer_text; ?>

		</div>
	</div>
<?php endif; ?>

			</td>
		</tr>
	</tbody>
</table>
