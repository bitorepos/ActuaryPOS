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
			</p>

			</td>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>

<!-- business information here -->
<div class="row invoice-info">

	<div class="col-md-6 invoice-col width-50 color-555">
		
		<!-- Logo -->
		<?php if(!empty($receipt_details->logo)): ?>
			<img style="max-height: 120px; width: auto;" src="<?php echo e($receipt_details->logo, false); ?>" class="img">
			<br/>
		<?php endif; ?>

		<!-- Shop & Location Name  -->
		<?php if(!empty($receipt_details->display_name)): ?>
			<p><span style="font-size:24px; font-weight:900; color:black;">
				<?php echo e($receipt_details->display_name, false); ?></span>
				<?php if(!empty($receipt_details->address)): ?>
					<br/><?php echo $receipt_details->address; ?>

				<?php endif; ?>

				<?php if(!empty($receipt_details->contact)): ?>
					<br/><?php echo $receipt_details->contact; ?>

				<?php endif; ?>

				<?php if(!empty($receipt_details->website)): ?>
					<br/><?php echo e($receipt_details->website, false); ?>

				<?php endif; ?>

				<?php if(!empty($receipt_details->tax_info1)): ?>
					<br/><?php echo e($receipt_details->tax_label1, false); ?> <?php echo e($receipt_details->tax_info1, false); ?>

				<?php endif; ?>

				<?php if(!empty($receipt_details->tax_info2)): ?>
					<br/><?php echo e($receipt_details->tax_label2, false); ?> <?php echo e($receipt_details->tax_info2, false); ?>

				<?php endif; ?>

				<?php if(!empty($receipt_details->location_custom_fields)): ?>
					<br/><?php echo e($receipt_details->location_custom_fields, false); ?>

				<?php endif; ?>
			</p>
		<?php endif; ?>
	</div>

	<div class="col-md-6 invoice-col width-50">

		<p class="text-right font-17">
			<?php if(!empty($receipt_details->invoice_no_prefix)): ?>
				<span class="float-start"><?php echo $receipt_details->invoice_no_prefix; ?></span>
			<?php endif; ?>

			<?php echo e($receipt_details->invoice_no, false); ?>

		</p>
		<!-- Date-->
		<?php if(!empty($receipt_details->date_label)): ?>
			<p class="text-right font-17">
				<span class="float-start">
					<?php echo e($receipt_details->date_label, false); ?>

				</span>

				<?php echo e($receipt_details->invoice_date, false); ?>

			</p>
		<?php endif; ?>

		
	</div>
	<div class="col-md-6 invoice-col width-50 word-wrap">
		<?php if(!empty($receipt_details->customer_label)): ?>
			<b><?php echo e($receipt_details->customer_label, false); ?></b><br/>
		<?php endif; ?>

		<?php if(!empty($receipt_details->customer_info)): ?>
			<?php echo $receipt_details->customer_info; ?>

		<?php endif; ?>
		<?php if(!empty($receipt_details->client_id_label)): ?>
			<br/>
			<strong><?php echo e($receipt_details->client_id_label, false); ?></strong> <?php echo e($receipt_details->client_id, false); ?>

		<?php endif; ?>
		<?php if(!empty($receipt_details->customer_tax_number)): ?>
			<br/>
			<strong><?php echo e($receipt_details->customer_tax_label, false); ?></strong> <?php echo e($receipt_details->customer_tax_number, false); ?>

		<?php endif; ?>
		<?php if(!empty($receipt_details->customer_custom_fields)): ?>
			<br/><?php echo $receipt_details->customer_custom_fields; ?>

		<?php endif; ?>
		<?php if(!empty($receipt_details->sales_person_label)): ?>
			<br/>
			<strong><?php echo e($receipt_details->sales_person_label, false); ?></strong> <?php echo e($receipt_details->sales_person, false); ?>

		<?php endif; ?>
	</div>
</div>
<!-- 
<div class="row invoice-info color-555">
	<br/>
	<div class="col-md-6 invoice-col width-50 word-wrap">
		<?php if(!empty($receipt_details->customer_label)): ?>
			<b><?php echo e($receipt_details->customer_label, false); ?></b><br/>
		<?php endif; ?>

		
		<?php if(!empty($receipt_details->customer_name)): ?>
			<?php echo e($receipt_details->customer_name, false); ?><br>
		<?php endif; ?>
		<?php if(!empty($receipt_details->customer_info)): ?>
			<?php echo $receipt_details->customer_info; ?>

		<?php endif; ?>
		<?php if(!empty($receipt_details->client_id_label)): ?>
			<br/>
			<strong><?php echo e($receipt_details->client_id_label, false); ?></strong> <?php echo e($receipt_details->client_id, false); ?>

		<?php endif; ?>
		<?php if(!empty($receipt_details->customer_tax_label)): ?>
			<br/>
			<strong><?php echo e($receipt_details->customer_tax_label, false); ?></strong> <?php echo e($receipt_details->customer_tax_number, false); ?>

		<?php endif; ?>
		<?php if(!empty($receipt_details->customer_custom_fields)): ?>
			<br/><?php echo $receipt_details->customer_custom_fields; ?>

		<?php endif; ?>
		<?php if(!empty($receipt_details->sales_person_label)): ?>
			<br/>
			<strong><?php echo e($receipt_details->sales_person_label, false); ?></strong> <?php echo e($receipt_details->sales_person, false); ?>

		<?php endif; ?>
	</div>
	<div class="col-md-6 invoice-col width-50 word-wrap">
		<strong><?php echo app('translator')->get('lang_v1.shipping_address'); ?>:</strong><br>
		<?php echo $receipt_details->shipping_address; ?>

		<?php if(!empty($receipt_details->shipping_custom_field_1_label)): ?>
			<br><strong><?php echo $receipt_details->shipping_custom_field_1_label; ?> :</strong> <?php echo $receipt_details->shipping_custom_field_1_value ?? ''; ?>

		<?php endif; ?>

		<?php if(!empty($receipt_details->shipping_custom_field_2_label)): ?>
			<br><strong><?php echo $receipt_details->shipping_custom_field_2_label; ?>:</strong> <?php echo $receipt_details->shipping_custom_field_2_value ?? ''; ?>

		<?php endif; ?>

		<?php if(!empty($receipt_details->shipping_custom_field_3_label)): ?>
			<br><strong><?php echo $receipt_details->shipping_custom_field_3_label; ?>:</strong> <?php echo $receipt_details->shipping_custom_field_3_value ?? ''; ?>

		<?php endif; ?>

		<?php if(!empty($receipt_details->shipping_custom_field_4_label)): ?>
			<br><strong><?php echo $receipt_details->shipping_custom_field_4_label; ?>:</strong> <?php echo $receipt_details->shipping_custom_field_4_value ?? ''; ?>

		<?php endif; ?>

		<?php if(!empty($receipt_details->shipping_custom_field_5_label)): ?>
			<br><strong><?php echo $receipt_details->shipping_custom_field_2_label; ?>:</strong> <?php echo $receipt_details->shipping_custom_field_5_value ?? ''; ?>

		<?php endif; ?>
	</div>
</div>
 -->

<div class="row color-555">
	<div class="col-12">
		<br/>
		<table class="table table-bordered table-no-top-cell-border">
			<thead>
				<tr style="background-color: #357ca5 !important; color: white !important; font-size: 20px !important" class="table-no-side-cell-border table-no-top-cell-border text-center">
					<td style="background-color: #357ca5 !important; color: white !important; width: 5% !important">#</td>
					
					<td style="background-color: #357ca5 !important; color: white !important; width: 65% !important">
						<?php echo e($receipt_details->table_product_label, false); ?>

					</td>
					
					<td style="background-color: #357ca5 !important; color: white !important; width: 30% !important;">
						<?php echo e($receipt_details->table_qty_label, false); ?>

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
                            <?php echo e($line['name'], false); ?> <?php echo e($line['product_variation'], false); ?> <?php echo e($line['variation'], false); ?> 
                            <?php if(!empty($line['sub_sku'])): ?>, <?php echo e($line['sub_sku'], false); ?> <?php endif; ?> <?php if(!empty($line['brand'])): ?>, <?php echo e($line['brand'], false); ?> <?php endif; ?>
                            <?php if(!empty($line['product_custom_fields'])): ?>, <?php echo e($line['product_custom_fields'], false); ?> <?php endif; ?>
                            <?php if(!empty($line['sell_line_note'])): ?>(<?php echo $line['sell_line_note']; ?>) <?php endif; ?>
                            <?php if(!empty($line['lot_number'])): ?><br> <?php echo e($line['lot_number_label'], false); ?>:  <?php echo e($line['lot_number'], false); ?> <?php endif; ?> 
                            <?php if(!empty($line['product_expiry'])): ?>, <?php echo e($line['product_expiry_label'], false); ?>:  <?php echo e($line['product_expiry'], false); ?> <?php endif; ?> 
                        </td>
						<td class="text-right">
							<?php echo e($line['quantity'], false); ?> <?php echo e($line['units'], false); ?>

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
		                            <?php if(!empty($modifier['sell_line_note'])): ?>(<?php echo $modifier['sell_line_note']; ?>) <?php endif; ?> 
		                        </td>
								<td class="text-right">
									<?php echo e($modifier['quantity'], false); ?> <?php echo e($modifier['units'], false); ?>

								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				<?php
					$lines = count($receipt_details->lines);
				?>

				<?php for($i = $lines; $i < 1; $i++): ?>
    				<tr>
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
		<b class="float-start">Above mentioned items received in good condition</b>
	</div>
</div>
</br>
<div class="row invoice-info color-555" style="page-break-inside: avoid !important">
	<div class="col-md-6 invoice-col width-80">
		<b class="float-start">Recieved by : </b>
	</div>
</div>
</br>
<div class="row invoice-info color-555" style="page-break-inside: avoid !important">
	<div class="col-md-6 invoice-col width-50">
		<b class="float-start">Date:</b>
	</div>
</div>
</br>
<div class="row invoice-info color-555" style="page-break-inside: avoid !important">
	<div class="col-md-6 invoice-col width-50">
		<b class="float-start"><?php echo app('translator')->get('lang_v1.authorized_signatory'); ?></b>
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
