
<!-- business information here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?php echo e(asset('css/app.css?v='.$asset_v), false); ?>">
        <title>Cash Handover Voucher</title>
    </head>
    <body>
		<div class="receipt-print-root ticket">
			<div class="text-box">
				<!-- Logo -->
				<p class="centered">
					<!-- Header text -->
					<?php if(!empty($receipt_details->header_text)): ?>
						<span class="headings"><?php echo $receipt_details->header_text; ?></span>
						<br/>
					<?php endif; ?>

					<?php if(!empty($receipt_details->display_name)): ?>
						<span style="font-size:20px"><?php echo $receipt_details->display_name; ?></span>
						<br>
					<?php endif; ?>

					<?php if(!empty($receipt_details->location_name)): ?>
					<span><?php echo $receipt_details->location_name; ?></span>
					<br>
					<?php endif; ?>

					<?php if(!empty($receipt_details->address)): ?>
						<?php echo $receipt_details->address; ?>

					<?php endif; ?>

					<!-- Title of receipt -->
					<?php if(!empty($receipt_details->invoice_heading)): ?>
						<br><span class="sub-headings" style="font-size: 20px"><?php echo $receipt_details->invoice_heading; ?></span>
					<?php endif; ?>

					<!-- Title of receipt -->
					<?php if(!empty($receipt_details->invoice_heading2)): ?>
						<br><span class="sub-headings" style="font-size: 20px"><?php echo $receipt_details->invoice_heading2; ?></span>
					<?php endif; ?>
				</p>
			</div>
			
			<div class="textbox-info border-top">
				<p class="f-left"><strong><?php echo $receipt_details->date_label; ?></strong></p>
				<p class="f-right">
					<?php echo e($receipt_details->date, false); ?>

				</p>
			</div>
			<div class="textbox-info">
				<p class="f-left"><strong><?php echo $receipt_details->register_label; ?></strong></p>
				<p class="f-right">
					<?php echo e($receipt_details->register_name, false); ?>

				</p>
			</div>
			<div class="textbox-info">
				<p class="f-left"><strong><?php echo $receipt_details->user_label; ?></strong></p>
				<p class="f-right">
					<?php echo e($receipt_details->full_name, false); ?>

				</p>
			</div>
			<br><br>
			<div class="textbox-info border-top">
				<p class="f-left amount-label"><?php echo $receipt_details->amount_label; ?></p>
				<p class="f-right amount-heading"><?php echo e($receipt_details->amount, false); ?></p>
			</div>

			<div class="textbox-info">
				<p class="f-left"><strong>In Words</strong></p>
				<p class="f-right" style="font-style: 20px">
					<?php echo e(ucwords($receipt_details->amount_in_words), false); ?>

				</p>
			</div>
			<br><br><br><br>
			<div class="textbox-info border-top">
				<p class="centerd"><strong>Prepared By. Signature</strong></p>
			</div>
			<br><br><br>
			<div class="textbox-info border-top">
				<p class="centerd"><strong>Reciever's Signature</strong></p>
			</div>
        </div>
		<p style="text-align: center; font-size:10px;"><?php echo env('BRANDING_TEXT'); ?></p>
    </body>
</html>

<style type="text/css">
.receipt-print-root .f-8 {
	font-size: 8px !important;
}
.receipt-print-root {
	color: #000000;
	background-color: #fff;
}
@media print {
	.receipt-print-root, .receipt-print-root *, .receipt-print-root :after, .receipt-print-root :before { color: #000 !important; background: #fff !important; text-shadow: none !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
	.receipt-print-root * {
    	font-size: 12px;
    	font-family: 'Times New Roman';
    	word-break: break-word;
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

.receipt-print-root .amount-label{
	font-size: 18px !important;
	margin-top: 15px !important;
	font-weight: 700 !important;
}
.receipt-print-root .amount-heading{
	font-size: 25px !important;
	font-weight: 700 !important;
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
.receipt-print-root .textbox-info p {
	margin-bottom: 0px;
	margin-top: 5px;
}
.receipt-print-root .h2{
	font-size: 20px;
}
.receipt-print-root .flex-box {
	display: flex;
	width: 100%;
}
.receipt-print-root .flex-box p {
	width: 50%;
	margin-bottom: 0px;
	white-space: nowrap;
}

.receipt-print-root .table-f-12 th, .receipt-print-root .table-f-12 td {
	font-size: 12px;
	word-break: break-word;
}

.receipt-print-root .bw {
	word-break: break-word;
}
</style>
