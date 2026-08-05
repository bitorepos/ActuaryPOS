<!-- business information here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?php echo e(asset('css/app.css?v='.$asset_v), false); ?>">
        <title>Expense-<?php echo e($receipt_details->invoice_no, false); ?></title>
    </head>
    <body>
		<div class="receipt-print-root ticket">
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

					<?php if(!empty($receipt_details->display_name)): ?>
						<span style="font-size:<?php echo e($receipt_details->business_name_font_size, false); ?>"><?php echo $receipt_details->display_name; ?></span>
					<br>
					<?php endif; ?>

					<?php if(!empty($receipt_details->location_name)): ?>
					<span><?php echo $receipt_details->location_name; ?></span>
					<br>
					<?php endif; ?>

					<?php if(empty($common_settings['expense_payment_hide_address'])): ?>
					<?php if(!empty($receipt_details->address)): ?>
						<?php echo $receipt_details->address; ?>

					<?php endif; ?>

					<?php if(!empty($receipt_details->contact)): ?>
						<?php echo $receipt_details->contact; ?>

					<?php endif; ?>
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

				</p>
				</div>
			<?php else: ?>
				<div class="text-box">
					<img style="width: 100%;margin-bottom: 10px;" src="<?php echo e($receipt_details->letter_head, false); ?>">
				</div>
			<?php endif; ?>

			<!-- Invoice Details Section -->
			<div class="border-top textbox-info">
				<p class="f-left"><strong><?php echo e(__('purchase.ref_no'), false); ?></strong></p>
				<p class="f-right">
					<?php echo e($receipt_details->invoice_no, false); ?>

				</p>
			</div>

			<div class="textbox-info">
				<p class="f-left"><strong><?php echo e(__('messages.date'), false); ?></strong></p>
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

			<!-- Expense Category -->
			<?php if(!empty($receipt_details->expense_category)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e(__('expense.expense_category'), false); ?></strong></p>
					<p class="f-right"><?php echo e($receipt_details->expense_category, false); ?></p>
				</div>
			<?php endif; ?>
			
			<!-- Expense Sub Category -->
			<?php if(!empty($receipt_details->expense_sub_category)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e(__('product.sub_category'), false); ?></strong></p>
					<p class="f-right"><?php echo e($receipt_details->expense_sub_category, false); ?></p>
				</div>
			<?php endif; ?>

			<!-- Expense For -->
			<?php if(!empty($receipt_details->expense_for)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e(__('expense.expense_for'), false); ?></strong></p>
					<p class="f-right"><?php echo e($receipt_details->expense_for, false); ?></p>
				</div>
			<?php endif; ?>

			<!-- Expense For Contact Info -->
			<?php if(!empty($receipt_details->expense_for_contact) && empty($common_settings['expense_payment_hide_address'])): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e(__('lang_v1.expense_for_contact'), false); ?></strong></p>
					<p class="f-right">
						<?php echo $receipt_details->expense_for_contact; ?>

					</p>
				</div>
			<?php endif; ?>

			<!-- Expense Notes/Additional Notes -->
			<?php if(!empty($receipt_details->additional_notes)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e(__('expense.expense_note'), false); ?></strong></p>
					<p class="f-right text-right">
						<?php echo nl2br($receipt_details->additional_notes); ?>

					</p>
				</div>
			<?php endif; ?>

			<!-- Separator -->
            <div class="receipt-totals-divider border-bottom width-100"></div>

			<!-- Totals Section -->
			<?php if(empty($receipt_details->hide_price_total)): ?>

				<!-- Subtotal -->
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
				
				<!-- Invoice Tax -->
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

				<!-- Round Off -->
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

				<!-- Total -->
				<div class="flex-box">
					<p class="width-50 text-right sub-headings">
						<?php echo $receipt_details->total_label; ?>

					</p>
					<p class="width-50 text-right sub-headings">
						<?php echo e($receipt_details->total, false); ?>

					</p>
				</div>

				<!-- Total In Words -->
				<?php if(!empty($receipt_details->total_in_words)): ?>
				<p colspan="2" class="text-right mb-0">
					<small>
					(<?php echo e($receipt_details->total_in_words, false); ?>)
					</small>
				</p>
				<?php endif; ?>

				<!-- Payments -->
				<?php if(!empty($receipt_details->payments)): ?>
					<?php $__currentLoopData = $receipt_details->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="flex-box">
							<p class="width-50 text-right"><?php echo e($payment['method'], false); ?> <?php if(!empty($receipt_details->show_payment_date)): ?>(<?php echo e($payment['date'], false); ?>)<?php endif; ?> </p>
							<p class="width-50 text-right"><?php echo e($payment['amount'], false); ?></p>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>

				<!-- Total Paid -->
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

				<!-- Total Due -->
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

            <!-- Tax Summary -->
            <?php if(empty($receipt_details->hide_price_total) && !empty($receipt_details->tax_summary_label) ): ?>
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

            <!-- Barcode -->
			<?php if($receipt_details->show_barcode): ?>
				<br/>
				<img class="center-block" src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true), false); ?>">
			<?php endif; ?>

			<!-- QR Code -->
			<?php if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text)): ?>
				<img class="center-block mt-5" src="data:image/png;base64,<?php echo e(DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE'), false); ?>">
			<?php endif; ?>
			
			<!-- Footer Logo -->
			<?php if(!empty($receipt_details->footer_logo)): ?>
				<div class="text-box centered">
					<img style="max-height: 100px; width: auto;" src="<?php echo e($receipt_details->footer_logo, false); ?>" alt="Footer Logo">
				</div>
			<?php endif; ?>
			
			<!-- Footer Text -->
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
.f-8 {
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

.receipt-print-root .receipt-header-block {
	margin: 0 !important;
}

.receipt-print-root .receipt-invoice-heading {
	display: block;
	margin: 0 !important;
	padding: 0 !important;
	line-height: 1.05;
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

/* Text box styling */
.receipt-print-root .textbox-info {
	color: #000;
	margin: 5px 0px;
	padding: 0px;
}

.receipt-print-root .textbox-info p {
	margin: 0px;
	padding: 5px 0px;
	color: #000;
	font-size: 12px;
}

.receipt-print-root .f-left {
	float: left;
	width: 50%;
	text-align: left;
}

.receipt-print-root .f-right {
	float: right;
	width: 50%;
	text-align: right;
}

.receipt-print-root .flex-box {
	display: flex;
	width: 100%;
	justify-content: space-between;
	margin: 5px 0;
}

.receipt-print-root .flex-box p {
	margin: 0;
	padding: 5px 0;
}

.receipt-print-root .receipt-totals-divider {
	height: 0;
	line-height: 0;
	margin: 0;
	padding: 0;
}

.left {
	flex-grow: 1;
	text-align: left;
}

.right {
	text-align: right;
	width: 50%;
}

.width-50 {
	width: 50%;
}

.text-right {
	text-align: right;
}

.text-center {
	text-align: center;
}

.table-f-12 {
	font-size: 12px;
	width: 100%;
	border-collapse: collapse;
}

.table-f-12 td, .table-f-12 th {
	border: 1px solid #242424;
	padding: 5px;
}

.mt-5 {
	margin-top: 5px;
}

.mb-0 {
	margin-bottom: 0;
}

.mb-10 {
	margin-bottom: 10px;
}
</style>
