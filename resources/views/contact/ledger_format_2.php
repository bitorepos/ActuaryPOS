<!-- app css -->
<?php if(!empty($for_pdf) || request('sub_action') == 'print'): ?>
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
<div class="col-md-12" style="margin-top: 20px;">
	<table style="margin: auto;">
		<tr><th class="text-center" style="border-top:hidden; font-size: 22px;">Invoices Due <?php echo e(__('lang_v1.statement'), false); ?></th></tr>
		
		
	</table>
</div>
<?php
    $hide_ledger_address = false;
    $ledger_header = '';
    $ledger_footer = '';
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
<div class="col-md-12 col-sm-12 col-12 <?php if(!empty($for_pdf) || request('sub_action') == 'print' ): ?> align-right <?php endif; ?>" style="<?php if(request('sub_action') != 'print'): ?> margin-top: 20px; <?php endif; ?>">
	<p>
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
<div class="col-md-12 col-sm-12 col-12 <?php if(!empty($for_pdf) || request('sub_action') == 'print' ): ?> align-right <?php endif; ?>">
    <p><?php echo $ledger_header; ?></p>
</div>
<?php endif; ?>
<div class="col-md-12 col-sm-12 col-12 <?php if(!empty($for_pdf) || request('sub_action') == 'print' ): ?> align-right <?php endif; ?>">
	<p>
		<strong style="text-align: left;"><?php echo app('translator')->get('lang_v1.to'); ?></strong><br>
		<?php if(!empty($contact->name)): ?>
		<strong><?php echo e($contact->name, false); ?></strong><br> 
		<?php endif; ?>
		<?php echo $contact->contact_address; ?> <?php if(!empty($contact->email)): ?> <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($contact->email, false); ?> <?php endif; ?>
		<br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($contact->mobile, false); ?>

		<?php if(!empty($contact->tax_number)): ?> <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($contact->tax_number, false); ?> <?php endif; ?>
</p>
</div>
<?php if(empty($for_pdf) && request()->get('sub_action') != 'print'): ?>
<div class="col-md-12 no-print">
	<div class="col-md-4 f-left no-print">
		<label for="show_paid">Show Paid Invoices</label>
		<input type='checkbox' name="show_paid" <?php if($ledger_details['show_paid'] == 'true'): ?> checked <?php endif; ?> id='show_paid'>
	</div>
</div>
<?php endif; ?>
<?php
$custom_labels = json_decode(session('business.custom_labels'), true);
$custom_field_1_label = !empty($custom_labels['sell']['custom_field_1']) ? $custom_labels['sell']['custom_field_1'] : '';
$custom_field_2_label = !empty($custom_labels['sell']['custom_field_2']) ? $custom_labels['sell']['custom_field_2'] : '';
$custom_field_3_label = !empty($custom_labels['sell']['custom_field_3']) ? $custom_labels['sell']['custom_field_3'] : '';
$custom_field_4_label = !empty($custom_labels['sell']['custom_field_4']) ? $custom_labels['sell']['custom_field_4'] : '';
?>
<div class="col-md-12 col-sm-12 <?php if(!empty($for_pdf)): ?> width-100 <?php endif; ?>">
	<?php
		$amount_due = 0;
		$current_due = 0;
		$due_7_days = 0;
		$due_8_30_days = 0;
		$due_30_60_days = 0;
		$due_60_90_days = 0;
		$due_over_90_days = 0;
		$col_span = 7;
		if(!empty($custom_field_1_label)){ $col_span++;}
		if(!empty($custom_field_2_label)){ $col_span++;}
		if(!empty($custom_field_3_label)){ $col_span++;}
		if(!empty($custom_field_4_label)){ $col_span++;}
	?>
	<?php if(!empty($for_pdf)): ?>
	<br>
	<?php endif; ?>
	<?php echo $__env->make('contact.partials.ledger_table_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="table-responsive" style="overflow-x:auto;">
<table class="table table-striped <?php if(!empty($for_pdf)): ?> table-pdf td-border <?php endif; ?>" id="ledger_table" style="white-space:nowrap;">
		<thead>
			<tr class="row-border">
				<th><?php echo app('translator')->get('lang_v1.date'); ?></th>
				<th>Number</th>
				<th><?php echo app('translator')->get('sale.ref_no'); ?></th>
				<?php if(!empty($custom_field_1_label)): ?> <th><?php echo e(ucwords($custom_field_1_label), false); ?></th> <?php endif; ?>
				<?php if(!empty($custom_field_2_label)): ?> <th><?php echo e(ucwords($custom_field_2_label), false); ?></th> <?php endif; ?>
				<?php if(!empty($custom_field_3_label)): ?> <th><?php echo e(ucwords($custom_field_3_label), false); ?></th> <?php endif; ?>
				<?php if(!empty($custom_field_4_label)): ?> <th><?php echo e(ucwords($custom_field_4_label), false); ?></th> <?php endif; ?>
				<th class="align-right"><?php echo app('translator')->get('sale.qty'); ?></th>
				<?php if(empty($common_settings['hide_amount_exc_tax_column_ledger_format2'])): ?>
				<th class="align-right">Amount Exc. <br> Tax <?php if(!empty($currency_symbol)): ?>(<?php echo e($currency_symbol, false); ?>)<?php endif; ?></th>
				<?php endif; ?>	
				<th class="align-right"><?php echo app('translator')->get('sale.amount'); ?> <?php if(!empty($currency_symbol)): ?>(<?php echo e($currency_symbol, false); ?>)<?php endif; ?></th>
				<th class="align-right"><?php echo app('translator')->get('lang_v1.balance'); ?> <?php if(!empty($currency_symbol)): ?>(<?php echo e($currency_symbol, false); ?>)<?php endif; ?></th>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $ledger_details['ledger']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
				<?php
					if($ledger_details['show_paid'] == 'false'){
						if(empty($data['total_due'])) {
							continue;
						}
					}
					if(!empty($data['due_date'])) {
					// if(!empty($data['due_date'])) {
						
						if($contact->type == 'supplier'){
							if (in_array($data['transaction_type'], ['ledger_discount', 'ledger_discount2', 'ledger_discount3']) && $data['transaction_sub_type'] == 'purchase_discount') {
								$data['total_due'] = -1 * $data['total_due'];
								$data['final_total'] = -1 * $data['final_total'];
								$data['total_before_tax'] = -1 * $data['total_before_tax'];
							}
						}else{
							if (in_array($data['transaction_type'], ['ledger_discount', 'ledger_discount2', 'ledger_discount3']) && $data['transaction_sub_type'] == 'sell_discount') {
								$data['total_due'] = -1 * $data['total_due'];
								$data['final_total'] = -1 * $data['final_total'];
								$data['total_before_tax'] = -1 * $data['total_before_tax'];
							}
						}

						$amount_due += $data['total_due'];
						$days_diff = $data['due_date']->diffInDays();
						if($days_diff == 0){
							$current_due += $data['total_due'];
						} elseif ($days_diff > 0 && $days_diff <= 7) {
							$due_7_days += $data['total_due'];
						} elseif ($days_diff > 7 && $days_diff <= 30) {
							$due_8_30_days += $data['total_due'];
						} elseif ($days_diff > 30 && $days_diff <= 60) {
							$due_30_60_days += $data['total_due'];
						} elseif ($days_diff > 60 && $days_diff <= 90) {
							$due_60_90_days += $data['total_due'];
						} elseif ($days_diff > 90) {
							$due_over_90_days += $data['total_due'];
						}
					}
					$qty = 0;
					$total_amount_exc_tax = 0;
					foreach($data['sell_lines'] as  $sl){
						if(empty($sl['children_type'])){
							$total_amount_exc_tax += ($sl['unit_price_inc_tax'] - $sl['item_tax']) * ($sl['quantity'] - $sl['foc_quantity']);
						}
					}
					if($total_amount_exc_tax == 0 && !empty($data['total_before_tax'])){
						$total_amount_exc_tax = $data['total_before_tax'];
					}
				?>
				<tr class="<?php if(!empty($for_pdf) && $loop->iteration % 2 == 0): ?> odd <?php endif; ?>" style="<?php if($data['payment_status'] == 'paid' && request('sub_action') != 'print'): ?> background-color: #c1fde4; <?php endif; ?> border:hidden;">
					<td class="row-border"><?php echo format_datetime_br($data['date']); ?></td>
					<td><?php echo $__env->make('contact.partials.ledger_type', ['type' => $data['type']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> - <?php echo $__env->make('contact.partials.ledger_ref_no', ['ref_no' => $data['ref_no']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php if(!empty($data['due_date']) && $data['payment_status'] != 'paid'): ?> <br><?php echo e(strtoupper($data['payment_status']), false); ?> <?php echo e(\Carbon::createFromTimestamp(strtotime($data['due_date']))->format(session('business.date_format')), false); ?> <?php endif; ?> <?php if($data['payment_status'] == 'paid'): ?> <br><?php echo e(strtoupper($data['payment_status']), false); ?> <?php endif; ?></td>
					<td><?php echo e($data['ref_no2'], false); ?> </td>
					<?php if(!empty($custom_field_1_label)): ?> <td><?php echo e($data['custom_field_1'], false); ?></td> <?php endif; ?>
					<?php if(!empty($custom_field_2_label)): ?> <td><?php echo e($data['custom_field_2'], false); ?></td> <?php endif; ?>
					<?php if(!empty($custom_field_3_label)): ?> <td><?php echo e($data['custom_field_3'], false); ?></td> <?php endif; ?>
					<?php if(!empty($custom_field_4_label)): ?> <td><?php echo e($data['custom_field_4'], false); ?></td> <?php endif; ?>
					<td class="ws-nowrap align-right"><?php if(!empty($data['qty'])): ?> <?php echo e(number_format($data['qty'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php endif; ?></td>
					<?php if(empty($common_settings['hide_amount_exc_tax_column_ledger_format2'])): ?>
					<td class="ws-nowrap align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_amount_exc_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
					<?php endif; ?>
					<td class="ws-nowrap align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $data['final_total'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
					<td class="ws-nowrap align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $data['total_due'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php if(count($ledger_details['ledger']) < 5): ?>
				<tr style="border:hidden;"><td colspan="<?php echo e($col_span, false); ?>">&nbsp;</td></tr>
				<tr style="border:hidden;"><td colspan="<?php echo e($col_span, false); ?>">&nbsp;</td></tr>
				<tr style="border:hidden;"><td colspan="<?php echo e($col_span, false); ?>">&nbsp;</td></tr>
				<tr style="border:hidden;"><td colspan="<?php echo e($col_span, false); ?>">&nbsp;</td></tr>
				<tr style="border:hidden;"><td colspan="<?php echo e($col_span, false); ?>">&nbsp;</td></tr>
				<tr style="border:hidden;"><td colspan="<?php echo e($col_span, false); ?>">&nbsp;</td></tr>
				<tr style="border:hidden;"><td colspan="<?php echo e($col_span, false); ?>">&nbsp;</td></tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>
	<?php $hide_color = (!empty($for_pdf) || request('sub_action') == 'print'); ?>
	<table class="table" style="margin-top: 0;">
		<tr>
			<th style="text-align: center; font-size: 12px;"><?php echo app('translator')->get('lang_v1.current'); ?></th>
			<th style="<?php if(!$hide_color): ?>color: #2dce89 !important;<?php endif; ?> text-align: center; font-size: 12px;"><?php echo e(strtoupper(__('lang_v1.7_days_past_due')), false); ?></th>
			<th style="<?php if(!$hide_color): ?>color: #2dce89 !important;<?php endif; ?> text-align: center; font-size: 12px;"><?php echo e(strtoupper(__('lang_v1.8_30_days_past_due')), false); ?></th>
			<th style="<?php if(!$hide_color): ?>color: #ffd026 !important;<?php endif; ?> text-align: center; font-size: 12px;"><?php echo e(strtoupper(__('lang_v1.30_60_days_past_due')), false); ?></th>
			<th style="<?php if(!$hide_color): ?>color: #ffa100 !important;<?php endif; ?> text-align: center; font-size: 12px;"><?php echo e(strtoupper(__('lang_v1.60_90_days_past_due')), false); ?></th>
			<th style="<?php if(!$hide_color): ?>color: #f5365c !important;<?php endif; ?> text-align: center; font-size: 12px;"><?php echo e(strtoupper(__('lang_v1.over_90_days_past_due')), false); ?></th>
			<th style="text-align: center; font-size: 12px;"><?php echo e(strtoupper(__('lang_v1.amount_due')), false); ?></th>
		</tr>
		<tr>
			<td class="ws-nowrap align-right" style="text-align: right;">
				<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $current_due, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
			</td>
			<td class="ws-nowrap align-right" style="<?php if(!$hide_color): ?>color: #2dce89 !important;<?php endif; ?> text-align: right;">
				<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $due_7_days, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
			</td>
			<td class="ws-nowrap align-right" style="<?php if(!$hide_color): ?>color: #2dce89 !important;<?php endif; ?> text-align: right;">
				<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $due_8_30_days, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
			</td>
			<td class="ws-nowrap align-right" style="<?php if(!$hide_color): ?>color: #ffd026 !important;<?php endif; ?> text-align: right;">
				<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $due_30_60_days, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
			</td>
			<td class="ws-nowrap align-right" style="<?php if(!$hide_color): ?>color: #ffa100 !important;<?php endif; ?> text-align: right;">
				<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $due_60_90_days, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
			</td>
			<td class="ws-nowrap align-right" style="<?php if(!$hide_color): ?>color: #f5365c !important;<?php endif; ?> text-align: right;">
				<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $due_over_90_days, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
			</td>
			<td class="ws-nowrap align-right" style="text-align: right;">
				<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $amount_due, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
			</td>
		</tr>
	</table>
	<?php
		// Phase 49: per-location overlay — prefer the $common_settings passed in by the controller
		// (already overlaid with the selected branch's settings by Phase 41) over the operator's
		// session value, so the ledger footer text follows the branch being printed.
		$_lf_cs = isset($common_settings) && is_array($common_settings) ? $common_settings : (session('business.common_settings') ?? []);
	?>
	<?php if(($contact->type == 'customer' || $contact->type == 'both') && !empty($_lf_cs['cutomer_ledger_format2_footer_text'])): ?>
	<div class="col-md-12 text-center">
		<br>
		<?php echo e($_lf_cs['cutomer_ledger_format2_footer_text'], false); ?>

	</div>
	<?php endif; ?>
	<?php if($contact->type == 'supplier' && !empty($_lf_cs['supplier_ledger_format2_footer_text'])): ?>
	<div class="col-md-12 text-center">
		<br>
		<?php echo e($_lf_cs['supplier_ledger_format2_footer_text'], false); ?>

	</div>
	<?php endif; ?>
	<?php if(!empty($ledger_footer)): ?>
	<div class="col-md-12 text-center">
		<br>
		<?php echo $ledger_footer; ?>

	</div>
	<?php endif; ?>
</div>
