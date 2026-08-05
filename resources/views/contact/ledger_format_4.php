<!-- app css -->
<?php if(!empty($for_pdf) && request('sub_action') != 'print'): ?>
<style>
	.text-center { text-align: center; }
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
	.no-print { display: none; }
	.footer-total { font-weight: bold; }
	.row-border { border: 1px solid #000; }
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
<div class="col-md-12 col-sm-12 <?php if(!empty($for_pdf)): ?> width-100 align-right <?php endif; ?>">
    <p class="text-right align-right">
		<?php if(!empty($location)): ?>
    		<strong><?php echo e($location->name, false); ?></strong><br>	
			<?php echo $location->location_address; ?>

			<?php if(!empty($location->mobile) || !empty($location->alternate_number)): ?>
			<br>
			<?php endif; ?>
			<?php if(!empty($location->mobile)): ?> <?php echo $location->mobile; ?> <?php endif; ?>
			<?php if(!empty($location->alternate_number)): ?> <?php echo $location->alternate_number; ?> <?php endif; ?>
			<?php if(!empty($location->email) || !empty($location->website)): ?>
			<br>
			<?php endif; ?>
			<?php if(!empty($location->email)): ?> <?php echo $location->email; ?> <?php endif; ?>
			<?php if(!empty($location->website)): ?> <?php echo $location->website; ?> <?php endif; ?>
    	<?php else: ?>
			<strong><?php echo e($contact->business->name, false); ?></strong><br>
    		<?php echo $contact->business->business_address; ?>

			<?php echo $contact->business->business_detail; ?>

    	<?php endif; ?>
    </p>
</div>
<?php endif; ?>
<?php if(!empty($ledger_header)): ?>
<div class="col-md-12 col-sm-12 <?php if(!empty($for_pdf)): ?> width-100 align-right <?php endif; ?>">
    <p class="text-right align-right"><?php echo $ledger_header; ?></p>
</div>
<?php endif; ?>
<div class="col-md-6 col-sm-6 col-6 <?php if(!empty($for_pdf)): ?> width-50 f-left <?php endif; ?>">
	<p class="blue-heading p-4 width-50"><?php echo app('translator')->get('lang_v1.to'); ?>:</p>
	<p><?php echo $contact->contact_address; ?> <?php if(!empty($contact->email)): ?> <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($contact->email, false); ?> <?php endif; ?>
	<br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($contact->mobile, false); ?>

	<?php if(!empty($contact->tax_number)): ?> <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($contact->tax_number, false); ?> <?php endif; ?>
	</p>
</div>
<div class="col-md-6 col-sm-6 col-6 text-right align-right <?php if(!empty($for_pdf)): ?> width-50 f-left <?php endif; ?>">
	<?php echo $__env->make('contact.partials.ledger_account_summary_toggle', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div id="account_summary_div" class="account-summary-div <?php if(request('hide_acc_summary') == 'true'): ?> hide <?php endif; ?>">
	<h3 class="mb-0 blue-heading p-4"><?php echo app('translator')->get('lang_v1.account_summary'); ?></h3>
	<hr>
	
		
	
	
	<table class="table table-condensed text-left align-left no-border <?php if(!empty($for_pdf)): ?> table-pdf <?php endif; ?>">
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
	<?php if($ledger_details['ledger_discount'] > 0): ?>
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
		<?php elseif($contact->type == 'supplier' || $contact->type == 'both'): ?>
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
		<?php endif; ?>
	</tr>
	</table>
	</div>
</div>

<div class="col-md-12 col-sm-12 <?php if(!empty($for_pdf)): ?> width-100 <?php endif; ?>">
	<p class="text-center" style="text-align: center;"><strong><?php echo app('translator')->get('lang_v1.ledger_table_heading', ['start_date' => $ledger_details['start_date'], 'end_date' => $ledger_details['end_date']]); ?></strong></p>
	<?php echo $__env->make('contact.partials.ledger_table_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="table-responsive" style="overflow-x:auto;">
	<table class="table <?php if(!empty($for_pdf)): ?> table-pdf td-border <?php endif; ?>" id="ledger_table" style="white-space:nowrap;">
		<thead>
			<tr class="row-border blue-heading">
				<th class="text-center"><?php echo app('translator')->get('lang_v1.date'); ?></th>
				<th class="text-center">Number</th>
				<th class="text-center"><?php echo app('translator')->get('lang_v1.type'); ?></th>
				<th class="text-center <?php if(!$show_location_column): ?> hide <?php endif; ?>"><?php echo app('translator')->get('sale.location'); ?></th>
				<th class="text-center contact-ledger-description-column"><?php echo app('translator')->get('report.others'); ?></th>
				<th class="text-center">Payment <br> Method</th>
				<th class="text-center">Payment <br> Status</th>

				<?php
					// For 'both' contact type, show both sell and purchase custom field headers
					if($contact->type == 'both' && !empty($sell_labels)) {
						$labels_to_show = $sell_labels;
					} else {
						$labels_to_show = $custom_field_labels;
					}
				?>

				<?php if(!empty($labels_to_show['custom_field_1'])): ?><th class="text-center" title="<?php echo e($labels_to_show['custom_field_1'], false); ?>"><?php echo e($labels_to_show['custom_field_1'], false); ?></th><?php endif; ?>
				<?php if(!empty($labels_to_show['custom_field_2'])): ?><th class="text-center" title="<?php echo e($labels_to_show['custom_field_2'], false); ?>"><?php echo e($labels_to_show['custom_field_2'], false); ?></th><?php endif; ?>
				<?php if(!empty($labels_to_show['custom_field_3'])): ?><th class="text-center" title="<?php echo e($labels_to_show['custom_field_3'], false); ?>"><?php echo e($labels_to_show['custom_field_3'], false); ?></th><?php endif; ?>
				<?php if(!empty($labels_to_show['custom_field_4'])): ?><th class="text-center" title="<?php echo e($labels_to_show['custom_field_4'], false); ?>"><?php echo e($labels_to_show['custom_field_4'], false); ?></th><?php endif; ?>
				<?php if(!empty($labels_to_show['custom_field_5'])): ?><th class="text-center" title="<?php echo e($labels_to_show['custom_field_5'], false); ?>"><?php echo e($labels_to_show['custom_field_5'], false); ?></th><?php endif; ?>
				<?php if(!empty($labels_to_show['custom_field_6'])): ?><th class="text-center" title="<?php echo e($labels_to_show['custom_field_6'], false); ?>"><?php echo e($labels_to_show['custom_field_6'], false); ?></th><?php endif; ?>
				<?php if(!empty($labels_to_show['custom_field_7'])): ?><th class="text-center" title="<?php echo e($labels_to_show['custom_field_7'], false); ?>"><?php echo e($labels_to_show['custom_field_7'], false); ?></th><?php endif; ?>
				<?php if(!empty($labels_to_show['custom_field_8'])): ?><th class="text-center" title="<?php echo e($labels_to_show['custom_field_8'], false); ?>"><?php echo e($labels_to_show['custom_field_8'], false); ?></th><?php endif; ?>

				<?php if($contact->type == 'both' && !empty($purchase_labels)): ?>
					<!-- Purchase-specific custom field headers for 'both' contacts -->
					<?php if(!empty($purchase_labels['custom_field_1'])): ?><th class="text-center" title="(Purchase) <?php echo e($purchase_labels['custom_field_1'], false); ?>">(Purchase) <?php echo e($purchase_labels['custom_field_1'], false); ?></th><?php endif; ?>
					<?php if(!empty($purchase_labels['custom_field_2'])): ?><th class="text-center" title="(Purchase) <?php echo e($purchase_labels['custom_field_2'], false); ?>">(Purchase) <?php echo e($purchase_labels['custom_field_2'], false); ?></th><?php endif; ?>
					<?php if(!empty($purchase_labels['custom_field_3'])): ?><th class="text-center" title="(Purchase) <?php echo e($purchase_labels['custom_field_3'], false); ?>">(Purchase) <?php echo e($purchase_labels['custom_field_3'], false); ?></th><?php endif; ?>
					<?php if(!empty($purchase_labels['custom_field_4'])): ?><th class="text-center" title="(Purchase) <?php echo e($purchase_labels['custom_field_4'], false); ?>">(Purchase) <?php echo e($purchase_labels['custom_field_4'], false); ?></th><?php endif; ?>
					<?php if(!empty($purchase_labels['custom_field_5'])): ?><th class="text-center" title="(Purchase) <?php echo e($purchase_labels['custom_field_5'], false); ?>">(Purchase) <?php echo e($purchase_labels['custom_field_5'], false); ?></th><?php endif; ?>
					<?php if(!empty($purchase_labels['custom_field_6'])): ?><th class="text-center" title="(Purchase) <?php echo e($purchase_labels['custom_field_6'], false); ?>">(Purchase) <?php echo e($purchase_labels['custom_field_6'], false); ?></th><?php endif; ?>
					<?php if(!empty($purchase_labels['custom_field_7'])): ?><th class="text-center" title="(Purchase) <?php echo e($purchase_labels['custom_field_7'], false); ?>">(Purchase) <?php echo e($purchase_labels['custom_field_7'], false); ?></th><?php endif; ?>
					<?php if(!empty($purchase_labels['custom_field_8'])): ?><th class="text-center" title="(Purchase) <?php echo e($purchase_labels['custom_field_8'], false); ?>">(Purchase) <?php echo e($purchase_labels['custom_field_8'], false); ?></th><?php endif; ?>
				<?php endif; ?>
				
				
				<th class="text-center"><?php echo app('translator')->get('account.debit'); ?> <?php if(!empty($currency_symbol)): ?>(<?php echo e($currency_symbol, false); ?>)<?php endif; ?></th>
				<th class="text-center"><?php echo app('translator')->get('account.credit'); ?> <?php if(!empty($currency_symbol)): ?>(<?php echo e($currency_symbol, false); ?>)<?php endif; ?></th>
				<th class="text-center"><?php echo app('translator')->get('lang_v1.balance'); ?> <?php if(!empty($currency_symbol)): ?>(<?php echo e($currency_symbol, false); ?>)<?php endif; ?></th>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $ledger_details['ledger']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr <?php if(!empty($data['transaction_type']) && in_array($data['transaction_type'], ['sell', 'purchase'])): ?>
					class="bg-gray"
					<?php if(!empty($for_pdf)): ?> style="color: #000;background-color: #d2d6de!important;" <?php endif; ?>
				<?php endif; ?>>
					<td class="row-border"><?php echo format_datetime_br($data['date']); ?></td>
					<td><?php echo $__env->make('contact.partials.ledger_ref_no', ['ref_no' => $data['ref_no']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
					<td><?php echo $__env->make('contact.partials.ledger_type', ['type' => $data['type']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
					<td class="<?php if(!$show_location_column): ?> hide <?php endif; ?>"><?php echo e($data['location'], false); ?></td>
					<td class="contact-ledger-description-column">
						<?php echo $data['others']; ?>


					</td>
					<td><?php echo e($data['payment_method'], false); ?></td>
					<td><?php echo e($data['payment_status'], false); ?></td>

					<?php
						// For 'both' contact type, use sell labels for primary custom fields
						if($contact->type == 'both' && !empty($sell_labels)) {
							$labels_to_display = $sell_labels;
						} else {
							$labels_to_display = $custom_field_labels;
						}
					?>

					<?php if($contact->type == 'both' && !empty($purchase_labels)): ?>
						<?php if($data['transaction_type'] == 'sell' || $data['transaction_type'] == 'sell_return'): ?>
							<?php if(!empty($sell_labels['custom_field_1'])): ?><td><?php echo e($data['custom_field_1'], false); ?></td><?php endif; ?>
							<?php if(!empty($sell_labels['custom_field_2'])): ?><td><?php echo e($data['custom_field_2'], false); ?></td><?php endif; ?>
							<?php if(!empty($sell_labels['custom_field_3'])): ?><td><?php echo e($data['custom_field_3'], false); ?></td><?php endif; ?>
							<?php if(!empty($sell_labels['custom_field_4'])): ?><td><?php echo e($data['custom_field_4'], false); ?></td><?php endif; ?>
							<?php if(!empty($sell_labels['custom_field_5'])): ?><td><?php echo e($data['custom_field_5'], false); ?></td><?php endif; ?>
							<?php if(!empty($sell_labels['custom_field_6'])): ?><td><?php echo e($data['custom_field_6'], false); ?></td><?php endif; ?>
							<?php if(!empty($sell_labels['custom_field_7'])): ?><td><?php echo e($data['custom_field_7'], false); ?></td><?php endif; ?>
							<?php if(!empty($sell_labels['custom_field_8'])): ?><td><?php echo e($data['custom_field_8'], false); ?></td><?php endif; ?>
							<?php if(!empty($purchase_labels['custom_field_1'])): ?><td></td><?php endif; ?>
							<?php if(!empty($purchase_labels['custom_field_2'])): ?><td></td><?php endif; ?>
							<?php if(!empty($purchase_labels['custom_field_3'])): ?><td></td><?php endif; ?>
							<?php if(!empty($purchase_labels['custom_field_4'])): ?><td></td><?php endif; ?>
							<?php if(!empty($purchase_labels['custom_field_5'])): ?><td></td><?php endif; ?>
							<?php if(!empty($purchase_labels['custom_field_6'])): ?><td></td><?php endif; ?>
							<?php if(!empty($purchase_labels['custom_field_7'])): ?><td></td><?php endif; ?>
							<?php if(!empty($purchase_labels['custom_field_8'])): ?><td></td><?php endif; ?>
							
						<?php else: ?>
							<?php if(!empty($sell_labels['custom_field_1'])): ?><td></td><?php endif; ?>
							<?php if(!empty($sell_labels['custom_field_2'])): ?><td></td><?php endif; ?>
							<?php if(!empty($sell_labels['custom_field_3'])): ?><td></td><?php endif; ?>
							<?php if(!empty($sell_labels['custom_field_4'])): ?><td></td><?php endif; ?>
							<?php if(!empty($sell_labels['custom_field_5'])): ?><td></td><?php endif; ?>
							<?php if(!empty($sell_labels['custom_field_6'])): ?><td></td><?php endif; ?>
							<?php if(!empty($sell_labels['custom_field_7'])): ?><td></td><?php endif; ?>
							<?php if(!empty($sell_labels['custom_field_8'])): ?><td></td><?php endif; ?>
							<!-- Purchase-specific custom field values for 'both' contacts -->
							<?php if(!empty($purchase_labels['custom_field_1'])): ?><td><?php echo e($data['custom_field_1'], false); ?></td><?php endif; ?>
							<?php if(!empty($purchase_labels['custom_field_2'])): ?><td><?php echo e($data['custom_field_2'], false); ?></td><?php endif; ?>
							<?php if(!empty($purchase_labels['custom_field_3'])): ?><td><?php echo e($data['custom_field_3'], false); ?></td><?php endif; ?>
							<?php if(!empty($purchase_labels['custom_field_4'])): ?><td><?php echo e($data['custom_field_4'], false); ?></td><?php endif; ?>
							<?php if(!empty($purchase_labels['custom_field_5'])): ?><td><?php echo e($data['custom_field_5'], false); ?></td><?php endif; ?>
							<?php if(!empty($purchase_labels['custom_field_6'])): ?><td><?php echo e($data['custom_field_6'], false); ?></td><?php endif; ?>
							<?php if(!empty($purchase_labels['custom_field_7'])): ?><td><?php echo e($data['custom_field_7'], false); ?></td><?php endif; ?>
							<?php if(!empty($purchase_labels['custom_field_8'])): ?><td><?php echo e($data['custom_field_8'], false); ?></td><?php endif; ?>
						<?php endif; ?>
					<?php else: ?> 
						<?php if(!empty($labels_to_display['custom_field_1'])): ?><td><?php echo e($data['custom_field_1'], false); ?></td><?php endif; ?>
						<?php if(!empty($labels_to_display['custom_field_2'])): ?><td><?php echo e($data['custom_field_2'], false); ?></td><?php endif; ?>
						<?php if(!empty($labels_to_display['custom_field_3'])): ?><td><?php echo e($data['custom_field_3'], false); ?></td><?php endif; ?>
						<?php if(!empty($labels_to_display['custom_field_4'])): ?><td><?php echo e($data['custom_field_4'], false); ?></td><?php endif; ?>
						<?php if(!empty($labels_to_display['custom_field_5'])): ?><td><?php echo e($data['custom_field_5'], false); ?></td><?php endif; ?>
						<?php if(!empty($labels_to_display['custom_field_6'])): ?><td><?php echo e($data['custom_field_6'], false); ?></td><?php endif; ?>
						<?php if(!empty($labels_to_display['custom_field_7'])): ?><td><?php echo e($data['custom_field_7'], false); ?></td><?php endif; ?>
						<?php if(!empty($labels_to_display['custom_field_8'])): ?><td><?php echo e($data['custom_field_8'], false); ?></td><?php endif; ?>
					<?php endif; ?>

					
					<td class="ws-nowrap align-right"><?php if($data['debit'] != ''): ?> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $data['debit'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php endif; ?></td>
					<td class="ws-nowrap align-right"><?php if($data['credit'] != ''): ?> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $data['credit'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php endif; ?></td>
					<td class="ws-nowrap align-right"><?php echo e($data['balance'], false); ?></td>
					
				</tr>
				<?php if(!empty($data['transaction_type']) && $data['transaction_type'] == 'sell'): ?>
					<tr>
						<td colspan="10" class="bg-light-skin" style="padding: 0 20px 10px;">
							<?php echo $__env->make('sale_pos.partials.sale_line_details', ['sell' => (object)$data, 'enabled_modules' => [], 'is_warranty_enabled' => false, 'for_ledger' => true ,'format' => 'format_4'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</td>
					</tr>
				<?php endif; ?>

				<?php if(!empty($data['transaction_type']) && $data['transaction_type'] == 'sell_return'): ?>
					<tr>
						<td colspan="10" class="bg-light-skin" style="padding: 0 20px 10px;">
							<?php echo $__env->make('sale_pos.partials.sale_line_details', ['sell' => (object)$data, 'enabled_modules' => [], 'is_warranty_enabled' => false, 'for_ledger' => true ,'format' => 'format_4'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</td>
					</tr>
				<?php endif; ?>

				<?php if(!empty($data['transaction_type']) && $data['transaction_type'] == 'purchase'): ?>
					<tr>
						<td colspan="10" class="bg-light-skin" style="padding: 0 20px 10px;">
							<?php echo $__env->make('contact.partials.ledger_purchase_lines_details', ['purchase' => (object)$data, 'format' => 'format_4'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</td>
					</tr>
				<?php endif; ?>

				<?php if(!empty($data['transaction_type']) && $data['transaction_type'] == 'purchase_return'): ?>
					<tr>
						<td colspan="10" class="bg-light-skin" style="padding: 0 20px 10px;">
							<?php echo $__env->make('contact.partials.ledger_purchase_lines_details', ['purchase' => (object)$data, 'format' => 'format_4'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</td>
					</tr>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
	</div>
	<?php if(!empty($ledger_footer)): ?>
	<div class="col-md-12 col-sm-12 <?php if(!empty($for_pdf)): ?> width-100 align-right <?php endif; ?>">
		<p class="text-right align-right"><?php echo $ledger_footer; ?></p>
	</div>
	<?php endif; ?>
	<?php if(request('sub_action') != 'print' && empty($for_pdf)): ?>
	<p class="pt-5 no-print">
		<a href="<?php echo e(action([\App\Http\Controllers\ContactController::class, 'exportLedgerExcel'], ['contact_id' => $contact->id, 'start_date' => $ledger_details['start_date'], 'end_date' => $ledger_details['end_date'], 'format' => 'format_4', 'location_id' => request('location_id')]), false); ?>" class="btn btn-success btn-sm"><i class="fas fa-file-excel" aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.export_to_excel'); ?></a>
	</p>
	<?php endif; ?>
	
</div>
