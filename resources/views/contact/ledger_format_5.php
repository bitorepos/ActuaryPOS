<!-- app css -->
<?php if(!empty($for_pdf) && request('sub_action') != 'print'): ?>
<style>
	.text-center{ text-align: center; }
	.col-md-6, .col-sm-6, .col-6 { float: left; width: 50%; box-sizing: border-box; }
	.col-md-12 { float: left; width: 100%; box-sizing: border-box; }
	.text-right { text-align: right !important; }
	.align-right { text-align: right; }
	.align-left { text-align: left; }
	.align-center { text-align: center; }
	.f-left { float: left; }
	.f-right { float: right; }
	.width-50 { width: 50% !important; }
	.width-100 { width: 100% !important; }
	.hide { display: none; }
	.p-4 { padding: 4px; }
	.mb-0 { margin-bottom: 0; }
	.table { width: 100%; border-collapse: collapse; }
	.table th, .table td { padding: 4px; }
	.table-pdf { border-collapse: collapse; width: 100%; }
	.table-pdf thead tr { background-color: #357ca5 !important; color: #fff; }
	.table-pdf thead tr th { color: #fff !important; border: 1px solid #000; padding: 4px; }
	.table-pdf td { border: 0.5px solid #999; padding: 4px; }
	.table-pdf .odd { background-color: #DCE6F1; }
	.blue-heading { background-color: #357ca5; color: #fff; }
	.table-condensed th, .table-condensed td { padding: 2px 4px; }
	.table-striped tbody tr:nth-child(odd) { background-color: #DCE6F1; }
	table { border-spacing: 0; width: 100%; }
	.btn-modal { text-decoration: none; color: black; }
	.no-print { display: none; }
	.footer-total { font-weight: bold; }
	.row-border { border: 1px solid #000; }
</style>
<?php elseif(request('sub_action') == 'print'): ?>
<style>
    .col-md-6, .col-sm-6, .col-6 {
        float: left;
        width: 50%;
        box-sizing: border-box;
    }

	.col-md-12{
		float: left;
        width: 100%;
        box-sizing: border-box;
	}
    .text-right {
        text-align: right !important;
    }
    .align-right {
        text-align: right;
    }
    .align-left {
        text-align: left;
    }
	.align-center {
		text-align: center;
	}

    table {
        border: 1px solid black;
        border-spacing: 0;
        width: 100%;
        /* margin-bottom: 10px; */
    }
    
    thead {
        border: 5px solid black;
    }

    tbody {
        /* border: 5px solid black; */
    }

    tr {
        /* border: 0.5px solid black; */
    }

    th {
        border: 1px solid black;
    }
    
    td {
        border: 0.5px solid black;
    }
	.hide {
		display: none;
	}
	.btn-modal{
		text-decoration: none;
		color:black;
	}

	/* Force black & white for print */
	* { color: #000 !important; }
	body, table, tr, td, th, div, p, span, strong, b, i, h1, h2, h3, h4, h5, h6, small, label, a {
		color: #000 !important;
		background-color: transparent !important;
		background: none !important;
	}
	.blue-heading, .bg-gray, .odd, .footer-total, .row-border {
		color: #000 !important;
		background-color: transparent !important;
		background: none !important;
	}
</style>
<?php endif; ?>
<?php $_lf5_cs = isset($common_settings) && is_array($common_settings) ? $common_settings : (session()->get('business.common_settings') ?? []); ?>
<?php if(!empty($_lf5_cs['enable_urdu_typing'] ?? false)): ?>
<style type="text/css">
	@font-face {
		font-family: 'NooriNastaleeq';
		src: url('/fonts/noori-nastaleeq-regular.ttf') format('truetype');
		font-weight: normal;
		font-style: normal;
	}
	input, b, p, i, th, td, .product_box_menu_item {
		font-family: 'NooriNastaleeq';
	}
	/* #search_product, #products_search_text, #search_product_for_purchase_return, .product_box_menu_item, #product_table_filter > label > input, td {
		font-family: 'NooriNastaleeq';
	} */
</style>
<?php endif; ?>
<?php
    $hide_ledger_address = false;
    $ledger_header = '';
    $ledger_footer = '';
    $active_location_count = $contact->business->locations->where('is_active', 1)->where('location_type', 'location')->count();
    $show_location_column = $active_location_count > 1;
    if(isset($common_settings)) {
        if(in_array($contact->type, ['customer', 'both']) && !empty($common_settings['customer_ledger_hide_address'])) {
            $hide_ledger_address = true;
        }
        if(in_array($contact->type, ['supplier', 'both']) && !empty($common_settings['supplier_ledger_hide_address'])) {
            $hide_ledger_address = true;
        }
        if(in_array($contact->type, ['customer', 'both']) && !empty($common_settings['customer_ledger_header'])) {
            $ledger_header = $common_settings['customer_ledger_header'];
        } elseif(in_array($contact->type, ['supplier']) && !empty($common_settings['supplier_ledger_header'])) {
            $ledger_header = $common_settings['supplier_ledger_header'];
        }
        if(in_array($contact->type, ['customer', 'both']) && !empty($common_settings['customer_ledger_footer'])) {
            $ledger_footer = $common_settings['customer_ledger_footer'];
        } elseif(in_array($contact->type, ['supplier']) && !empty($common_settings['supplier_ledger_footer'])) {
            $ledger_footer = $common_settings['supplier_ledger_footer'];
        }
    }
?>
<?php if(!$hide_ledger_address): ?>
<div class="col-md-12 col-sm-12 <?php if(!empty($for_pdf)): ?> align-center width-100 <?php endif; ?>">
		<p class="text-center align-center">
			<?php if(!empty($location)): ?>
    		<strong><?php echo e($location->name, false); ?></strong><br>	
			<?php echo $location->location_address; ?>

			<?php else: ?>
				<strong><?php echo e($contact->business->name, false); ?></strong><br>
				<?php echo $contact->business->business_address; ?>

			<?php endif; ?>
        </p>
</div>
<?php endif; ?>
<?php if(!empty($ledger_header)): ?>
<div class="col-md-12 col-sm-12 <?php if(!empty($for_pdf)): ?> align-center width-100 <?php endif; ?>">
    <p class="text-center align-center"><?php echo $ledger_header; ?></p>
</div>
<?php endif; ?>
<div class="col-md-6 col-sm-6 col-6 <?php if(!empty($for_pdf)): ?> width-50 f-left  <?php endif; ?>" >
	<p   style="<?php if(empty($for_pdf)): ?> font-size:<?php echo e($common_settings['customer_label_font_size'], false); ?> <?php endif; ?>" ><?php echo $contact->contact_address; ?> <?php if(!empty($contact->email)): ?> <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($contact->email, false); ?> <?php endif; ?>
	<br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($contact->mobile, false); ?>

	<?php if(!empty($contact->tax_number)): ?> <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($contact->tax_number, false); ?> <?php endif; ?>
</p>
</div>
<div class="col-md-6 col-sm-6 col-6 text-right align-right <?php if(!empty($for_pdf)): ?> width-50 f-right <?php endif; ?>">
	<?php if(request('sub_action') != 'print' && empty($for_pdf)): ?>
	<div class="col-sm-12" style="top: -13px;">
            <div class="mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_account_summary]', 1,
                        !empty($common_settings['hide_account_summary']) ? true : false,
                        [ 'class' => 'form-check-input', 'id' => 'hide_account_summary_front']); ?> <?php echo e(__( 'lang_v1.hide_account_summary' ), false); ?>

                    </label>
                </div>
            </div>
    </div>
	<?php endif; ?>
	<div id="account_summary_div" class="<?php if(request('hide_acc_summary') == 'true'): ?> hide <?php endif; ?>">
		<h3 class="mb-0 blue-heading p-4"><?php echo app('translator')->get('lang_v1.account_summary'); ?></h3>
		<hr>
		<table class="table table-condensed text-left align-left <?php if(!empty($for_pdf)): ?> table-pdf <?php endif; ?>">
			<tr>
				<td><?php echo app('translator')->get('lang_v1.brought_forward'); ?></td>
				<td class="align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ledger_details['brought_forward'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
			</tr>
			<tr>
				<td><?php echo app('translator')->get('lang_v1.opening_balance'); ?></td>
				<td class="align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ledger_details['beginning_balance'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
			</tr>
		<?php if( $contact->type == 'supplier' || $contact->type == 'both'): ?>
			<tr>
				<td><?php echo app('translator')->get('report.total_purchase'); ?></td>
				<td class="align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ledger_details['total_purchase'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
			</tr>
		<?php endif; ?>
		<?php if( $contact->type == 'customer' || $contact->type == 'both'): ?>
			<tr>
				<td><?php echo app('translator')->get('lang_v1.total_invoice'); ?></td>
				<td class="align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ledger_details['total_invoice'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
			</tr>
		<?php endif; ?>
		<tr>
			<td><?php echo app('translator')->get('sale.total_paid'); ?></td>
			<td class="align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ledger_details['total_paid'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
		</tr>
		<tr>
			<td><strong><?php echo app('translator')->get('lang_v1.invoices_balance_due'); ?></strong></td>
			
			<?php if($contact->type != 'both'): ?>
				<?php if($ledger_details['total_invoice'] != 0): ?>
					<td class="align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) ($ledger_details['total_invoice'] - $ledger_details['total_purchase']) - $ledger_details['total_paid'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
				<?php elseif($ledger_details['total_purchase'] != 0): ?>
					<td class="align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) ($ledger_details['total_purchase']) - $ledger_details['total_paid'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
				<?php endif; ?>
			<?php else: ?>
			<td class="align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ledger_details['total_invoice'] + $ledger_details['total_purchase'] - $ledger_details['total_paid'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
			<?php endif; ?>
		</tr>
		<tr>
			<td><?php echo app('translator')->get('lang_v1.advance_balance'); ?></td>
			<td class="align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ledger_details['advance_deposit'] - $ledger_details['total_reverse_payment'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
		</tr>
		<?php if($ledger_details['ledger_discount'] != 0): ?>
			<tr>
				<td><?php echo app('translator')->get('lang_v1.ledger_discount'); ?></td>
				<td class="align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ledger_details['ledger_discount'] - $ledger_details['ledger_discount_paid'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
			</tr>
		<?php endif; ?>
		<tr>
			<td><strong><?php echo app('translator')->get('lang_v1.balance_due'); ?></strong></td>
			<?php if($contact->type == 'customer'): ?>
				<td class="align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ledger_details['balance_due'] - $ledger_details['ledger_discount'] - (($ledger_details['advance_deposit'] - $ledger_details['total_reverse_payment'])) + $ledger_details['brought_forward'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
			<?php elseif($contact->type == 'supplier'): ?>
				<td class="align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ledger_details['balance_due'] - $ledger_details['ledger_discount'] - (($ledger_details['advance_deposit'] - $ledger_details['total_reverse_payment'])) + $ledger_details['brought_forward'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
			<?php elseif($contact->type == 'both'): ?>
				<td class="align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ledger_details['balance_due'] + $ledger_details['ledger_discount'] - (($ledger_details['advance_deposit'] - $ledger_details['total_reverse_payment'])) + $ledger_details['brought_forward'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
			<?php endif; ?>
		</tr>
		</table>
	</div>
</div>
<div class="col-md-12 col-sm-12 <?php if(!empty($for_pdf)): ?> width-100 <?php endif; ?>">
	<p class="text-center" style="text-align: center;"><strong><?php echo app('translator')->get('lang_v1.ledger_table_heading', ['start_date' => $ledger_details['start_date'], 'end_date' => $ledger_details['end_date']]); ?></strong></p>
	<?php echo $__env->make('contact.partials.ledger_table_toolbar', ['show_footer_toggle' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="table-responsive" style="overflow-x:auto;">
	<table class="table table-striped <?php if(!empty($for_pdf)): ?> table-pdf <?php endif; ?>" id="ledger_table" style="white-space:nowrap;">
		<thead>
			<tr class="row-border blue-heading">
				<th class="text-center"><?php echo app('translator')->get('lang_v1.date'); ?></th>
				<th class="text-center">Number</th>
				<th class="text-center">Party <br> Ref no.</th>
				<?php if($show_location_column): ?> <th class="text-center"><?php echo app('translator')->get('sale.location'); ?></th><?php endif; ?>
				
				<th class="text-center contact-ledger-description-column"><?php echo app('translator')->get('report.descriptions'); ?></th>
				
				
				<th class="text-center"><?php echo app('translator')->get('account.debit'); ?> <?php if(!empty($currency_symbol)): ?>(<?php echo e($currency_symbol, false); ?>)<?php endif; ?></th>
				<th class="text-center"><?php echo app('translator')->get('account.credit'); ?> <?php if(!empty($currency_symbol)): ?>(<?php echo e($currency_symbol, false); ?>)<?php endif; ?></th>
				<th class="text-center"><?php echo app('translator')->get('lang_v1.balance'); ?> <?php if(!empty($currency_symbol)): ?>(<?php echo e($currency_symbol, false); ?>)<?php endif; ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$total_debit = 0;
				$total_credit = 0;
				$total_balance = 0;
			?>
			<?php $__currentLoopData = $ledger_details['ledger']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php
					$payment_type_color = '';
					$payment_type_class = '';
					if(request('sub_action') != 'print'){
						if($data['payment_type'] == 'contact_payment'){
							$payment_type_color = '#EBE3D5';
							$payment_type_class = 'ledger-row-contact-payment';
						}else if($data['payment_type'] == 'advance_deposit_payment'){
							$payment_type_color = '#EBE3D5';
							$payment_type_class = 'ledger-row-advance-deposit';
						}else if($data['payment_type'] == 'sell_payment'){
							$payment_type_color = '#E0F4FF';
							$payment_type_class = 'ledger-row-sell-payment';
						}else if($data['payment_type'] == 'purchase_payment'){
							$payment_type_color = '#E5D4FF';
							$payment_type_class = 'ledger-row-purchase-payment';
						}else if($data['payment_type'] == 'ledger_discount'){
							$payment_type_color = '#ECE3CE';
							$payment_type_class = 'ledger-row-ledger-discount';
						}
					}
					$total_debit += (float) $data['debit'];
					$total_credit += (float) $data['credit'];
					$total_balance = $data['balance'];
				?>
				<tr class="<?php if(!empty($for_pdf) && $loop->iteration % 2 == 0): ?>odd <?php endif; ?><?php echo e($payment_type_class, false); ?>" <?php if(!empty($for_pdf) && !empty($payment_type_color)): ?> style="background-color:<?php echo e($payment_type_color, false); ?>" <?php endif; ?>>
					<td class="row-border"><?php echo e(\Carbon::createFromTimestamp(strtotime($data['date']))->format(session('business.date_format')), false); ?></td>
					<td>
					
						<?php if($data['type'] == 'Sales'): ?>
							<a data-href="<?php echo e(action([\App\Http\Controllers\SellController::class, 'show'], [$data['transaction_id']]), false); ?>" 
								href="#" data-container=".view_modal" class="btn-modal">
							<?php echo $__env->make('contact.partials.ledger_ref_no', ['ref_no' => $data['ref_no']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							</a>

						<?php elseif($data['type'] == 'Sale Return'): ?>
							<?php if(!empty($data['return_parent_id'])): ?>
							<a data-href="<?php echo e(action([\App\Http\Controllers\SellReturnController::class, 'show'], [$data['return_parent_id']]), false); ?>" 
								href="#" data-container=".view_modal" class="btn-modal">
							<?php else: ?>
							<a data-href="<?php echo e(action([\App\Http\Controllers\SellReturnController::class, 'show'], [$data['transaction_id']]), false); ?>" 
								href="#" data-container=".view_modal" class="btn-modal">
							<?php endif; ?>
								<?php echo $__env->make('contact.partials.ledger_ref_no', ['ref_no' => $data['ref_no']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							</a>
						<?php elseif($data['type'] == 'Purchase'): ?>
							<a data-href="<?php echo e(action([\App\Http\Controllers\PurchaseController::class, 'show'], [$data['transaction_id']]), false); ?>" 
								href="#" data-container=".view_modal" class="btn-modal">
							<?php echo $__env->make('contact.partials.ledger_ref_no', ['ref_no' => $data['ref_no']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							</a>
						<?php elseif($data['type'] == 'Purchase Return'): ?>
							<?php if(!empty($data['return_parent_id'])): ?>
							<a data-href="<?php echo e(action([\App\Http\Controllers\PurchaseReturnController::class, 'show'], [$data['return_parent_id']]), false); ?>" 
								href="#" data-container=".view_modal" class="btn-modal">
							<?php else: ?>
							<a data-href="<?php echo e(action([\App\Http\Controllers\PurchaseReturnController::class, 'show'], [$data['transaction_id']]), false); ?>" 
							href="#" data-container=".view_modal" class="btn-modal">
							<?php endif; ?>
							<?php echo $__env->make('contact.partials.ledger_ref_no', ['ref_no' => $data['ref_no']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							</a>
						<?php else: ?>
							<?php echo $__env->make('contact.partials.ledger_ref_no', ['ref_no' => $data['ref_no']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php endif; ?>
					</td>
					<td>
						<?php echo e($data['ref_no2'], false); ?>

						<?php echo e($data['payment_method'], false); ?>

					</td>
					<?php if($show_location_column): ?> <td><?php echo e($data['location'], false); ?></td><?php endif; ?>
					<td class="contact-ledger-description-column">
						<?php if($data['type'] == 'Brought Forward'): ?>
						<?php echo $__env->make('contact.partials.ledger_type', ['type' => $data['type']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php endif; ?>
						
						<?php if(!empty($data['others'])): ?>
						<?php echo $data['others']; ?>

						<br>
						<?php endif; ?>

						<?php if(($data['payment_method_key'] == 'cheque' || $data['payment_sub_method_key'] == 'cheque') && !empty($data['cheque_number'])): ?>
							<?php if(!empty($data['cheque_number'])): ?>								
								Cheque No.<br> <?php echo e($data['cheque_number'], false); ?>

							<?php endif; ?>
							<?php if($data['cheque_status'] == 'pending'): ?>
								<?php echo app('translator')->get('lang_v1.issue_date'); ?>:<br> <?php echo e(\Carbon::createFromTimestamp(strtotime($data['clearance_date']))->format(session('business.date_format')), false); ?>

								<br><a href="#" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'updatePDCPaymentStatus'], $data['payment_id']), false); ?>" class="update_pdc_payment_status"> Cleared</a>									
							<?php else: ?>
								<br><?php echo e(ucwords($data['cheque_status']), false); ?>

							<?php endif; ?>
						<?php endif; ?>
						
						<?php if(empty($data['payment_type']) && !empty($data['transaction_type']) && !empty((object)$data['sell_lines']) && ($data['transaction_type'] == 'sell' || $data['transaction_type'] == 'sell_return' )): ?>
							<strong>Product Details: </strong><br>
							<?php
							$sell = (object) $data;
							?>
							<?php $__currentLoopData = $sell->sell_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if(!$loop->first): ?>
								<?php echo e(', ', false); ?>

							<?php endif; ?>
							(
							<?php echo e($sell_line->product->name, false); ?>

							<?php if( $sell_line->product->type == 'variable'): ?>
								- <?php echo e($sell_line->variations->product_variation->name, false); ?>

								- <?php echo e($sell_line->variations->name, false); ?>

							<?php endif; ?>
							<?php if($sell->type == 'Sales'): ?>
							- <?php echo e(number_format($sell_line->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php if(!empty($sell_line->sub_unit)): ?> <?php echo e($sell_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($sell_line->product->unit->short_name, false); ?> <?php endif; ?>
							<?php else: ?>
							- <?php echo e(number_format($sell_line->quantity_returned, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php if(!empty($sell_line->sub_unit)): ?> <?php echo e($sell_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($sell_line->product->unit->short_name, false); ?> <?php endif; ?>
							<?php endif; ?>
							- <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_line->unit_price_inc_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
							)
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
						
						<?php if(empty($data['payment_type']) && !empty($data['transaction_type']) && !empty((object)$data['purchase_lines']) && ($data['transaction_type'] == 'purchase' || $data['transaction_type'] == 'purchase_return' )): ?>
							<strong>Product Details: </strong> <br>
							<?php
							$purchase = (object) $data;
							?>
							<?php $__currentLoopData = $purchase->purchase_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if(!$loop->first): ?>
								<?php echo e(', ', false); ?>

							<?php endif; ?>
							(
							<?php echo e($purchase_line->product->name, false); ?>

							<?php if( $purchase_line->product->type == 'variable'): ?>
								- <?php echo e($purchase_line->variations->product_variation->name, false); ?>

								- <?php echo e($purchase_line->variations->name, false); ?>

							<?php endif; ?>
							<?php if($purchase->type == 'Purchase'): ?>
							- <?php echo e(number_format($purchase_line->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php if(!empty($purchase_line->sub_unit)): ?> <?php echo e($purchase_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($purchase_line->product->unit->short_name, false); ?> <?php endif; ?>
							<?php else: ?>
							- <?php echo e(number_format($purchase_line->quantity_returned, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php if(!empty($purchase_line->sub_unit)): ?> <?php echo e($purchase_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($purchase_line->product->unit->short_name, false); ?> <?php endif; ?>
							<?php endif; ?>
							- <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $purchase_line->purchase_price_inc_tax, session("business.cost_decimal", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);
            echo $formated_number; ?>
							)
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>

						<?php if(!empty($data['parent_id'])): ?>
							<?php echo e($data['parent_id'], false); ?>

						<?php endif; ?>

					</td>
					
					
						
					
					<td class="ws-nowrap align-right"><?php if($data['debit'] != ''): ?> <?php if(!empty($for_pdf)): ?> <?php echo e(number_format($data['debit'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php else: ?> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $data['debit'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php endif; ?> <?php endif; ?></td>
					<td class="ws-nowrap align-right"><?php if($data['credit'] != ''): ?> <?php if(!empty($for_pdf)): ?> <?php echo e(number_format($data['credit'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php else: ?> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $data['credit'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php endif; ?> <?php endif; ?></td>
					<td class="ws-nowrap align-right"><?php echo e($data['balance'], false); ?></td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
		<?php if(request('hide_footer') != 'true'): ?>
		<tfoot id="total_footer">
			<tr class="bg-gray font-17 text-right footer-total">
                <td <?php if($show_location_column): ?> colspan="5" <?php else: ?> colspan="4" <?php endif; ?>><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                <td><strong><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_debit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></strong></td>
                <td><strong><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_credit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></strong></td>
                <td><strong><?php echo e($total_balance, false); ?></strong></td>
                
			</tr>
		</tfoot>
		<?php endif; ?>
	</table>
	</div>
</div>
<?php if(!empty($ledger_footer)): ?>
<div class="col-md-12 col-sm-12 <?php if(!empty($for_pdf)): ?> align-center width-100 <?php endif; ?>">
    <p class="text-center align-center"><?php echo $ledger_footer; ?></p>
</div>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function() {
        function summaryVisibility() {
			if ($('#hide_account_summary_front').is(':checked')) {
				$('#account_summary_div').css('display', 'none');
			} else {
				$('#account_summary_div').css('display', '');
			}
		}

		function ageingVisibility() {
			if ($('#hide_ageing_front').is(':checked')) {
				$('#ageing_div').css('display', 'none');
			} else {
				$('#ageing_div').css('display', '');
			}
		}

		function clearingVisibility() {
			if ($('#hide_clearing').is(':checked')) {
				$('#cheque_clearance_div').css('display', 'none');
			} else {
				$('#cheque_clearance_div').css('display', '');
			}
		}

		function footerVisibility() {
			if ($('#hide_footer_total_front').is(':checked')) {
				$('#total_footer').css('display', 'none');
			} else {
				$('#total_footer').css('display', '');
			}
		}

        summaryVisibility();
		ageingVisibility();
		clearingVisibility();
		footerVisibility();

        $('#hide_account_summary_front').on('change', function() {
            summaryVisibility();
        });

        $('#hide_ageing_front').on('change', function() {
            ageingVisibility();
        });

		$('#hide_clearing').on('change', function() {
            clearingVisibility();
        });

        $('#hide_footer_total_front').on('change', function() {
            footerVisibility();
        });
    });
	
</script>
