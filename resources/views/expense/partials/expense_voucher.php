
<!-- business information here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?php echo e(asset('css/app.css?v='.$asset_v), false); ?>">
        <title>Receipt-<?php echo e($receipt_details->invoice_no, false); ?></title>
    </head>
    <body>
        <div class="ticket">
			<?php if(empty($receipt_details->letter_head)): ?>
				<?php if(!empty($receipt_details->logo)): ?>
					<div class="text-box centered">
						<img style="max-height: 100px; width: auto;" src="<?php echo e($receipt_details->logo, false); ?>" alt="Logo">
					</div>
				<?php endif; ?>
				<div class="text-box">
				<!-- Logo -->
				<p class="centered">
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
					<?php if(empty($is_delivery_note)): ?>
					<?php if(!empty($receipt_details->invoice_heading)): ?>
						<br><span class="sub-headings"><?php echo $receipt_details->invoice_heading; ?></span>
					<?php endif; ?>
					<?php else: ?>
					<br><span class="sub-headings"><h4>Delivery Note</h4></span>
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
			<div class="border-top textbox-info">
				<p class="f-left"><strong><?php echo $receipt_details->invoice_no_prefix; ?></strong></p>
				<p class="f-right">
					<?php echo e($receipt_details->invoice_no, false); ?>

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

			<?php if(!empty($receipt_details->expense_category_label) || !empty($receipt_details->expense_category)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e($receipt_details->expense_category_label, false); ?></strong></p>
				
					<p class="f-right"><?php echo e($receipt_details->expense_category, false); ?></p>
				</div>
			<?php endif; ?>
			
			<?php if(!empty($receipt_details->expense_sub_category_label) || !empty($receipt_details->expense_sub_category)): ?>
				<div class="textbox-info">
					<p class="f-left"><strong><?php echo e($receipt_details->expense_sub_category_label, false); ?></strong></p>
				
					<p class="f-right"><?php echo e($receipt_details->expense_sub_category, false); ?></p>
				</div>
			<?php endif; ?>

        	<!-- Waiter info -->
			<?php if(!empty($receipt_details->expense_for_label) || !empty($receipt_details->expense_for)): ?>
	        	<div class="textbox-info">
	        		<p class="f-left"><strong>
	        			<?php echo $receipt_details->expense_for_label; ?>

	        		</strong></p>
	        		<p class="f-right">
	        			<?php echo e($receipt_details->expense_for, false); ?>

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

			<!-- customer info -->
	        <div class="textbox-info">
				<p class="f-left">
					<strong>
						Expense Note: 
	        		</strong>
				</p>
				<br>
				<p class="">
					<?php echo nl2br($receipt_details->additional_notes); ?>

	        	</p>
	        </div>

			<?php if(!empty($receipt_details->subtotal_label)): ?>
				<div class="flex-box" <?php if(!empty($receipt_details->sub_total_inc_tax_bold)): ?> style="font-weight: bold;" <?php endif; ?>>
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
			
		<div class="border-bottom width-100">&nbsp;</div>
            
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
body {
	color: #000000;
}
@media print {
	* {
    	font-size: 12px;
    	font-family: 'Times New Roman';
    	word-break: break-all;
	}
	.f-8 {
		font-size: 8px !important;
	}
	
.headings{
	font-size: 16px;
	font-weight: 700;
	text-transform: uppercase;
	white-space: nowrap;
}

.sub-headings{
	font-size: 15px !important;
	font-weight: 700 !important;
}

.border-top{
    border-top: 1px solid #242424;
}
.border-bottom{
	border-bottom: 1px solid #242424;
}

.border-bottom-dotted{
	border-bottom: 1px dotted darkgray;
}

td.serial_number, th.serial_number{
	width: 5%;
    max-width: 5%;
}

td.description,
th.description {
    width: 35%;
    max-width: 35%;
}

td.quantity,
th.quantity {
    width: 15%;
    max-width: 15%;
    word-break: break-all;
}
td.unit_price, th.unit_price{
	width: 25%;
    max-width: 25%;
    word-break: break-all;
}

td.price,
th.price {
    width: 20%;
    max-width: 20%;
    word-break: break-all;
}

.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 100%;
    max-width: 100%;
}

img {
    max-width: inherit;
    width: auto;
}

    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
.table-info {
	width: 100%;
}
.table-info tr:first-child td, .table-info tr:first-child th {
	padding-top: 8px;
}
.table-info th {
	text-align: left;
}
.table-info td {
	text-align: right;
}
.logo {
	float: left;
	width:35%;
	padding: 10px;
}

.text-with-image {
	float: left;
	width:65%;
}
.text-box {
	width: 100%;
	height: auto;
}

.textbox-info {
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

.table-f-12 th, .table-f-12 td {
	font-size: 12px;
	word-break: break-word;
}

.bw {
	word-break: break-word;
}
</style>
