<?php
$custom_labels = json_decode(session('business.custom_labels'), true);
$custom_field_1_label = !empty($custom_labels['sell']['custom_field_1']) ? $custom_labels['sell']['custom_field_1'] : '';
$custom_field_2_label = !empty($custom_labels['sell']['custom_field_2']) ? $custom_labels['sell']['custom_field_2'] : '';
$custom_field_3_label = !empty($custom_labels['sell']['custom_field_3']) ? $custom_labels['sell']['custom_field_3'] : '';
$custom_field_4_label = !empty($custom_labels['sell']['custom_field_4']) ? $custom_labels['sell']['custom_field_4'] : '';
$hide_style = (request('sub_action') == 'print') ? false : true;
?>
<?php if(request('sub_action') != 'print' && empty($for_pdf)): ?>
	<div class="col-md-12">
		<div class="mb-3">
			<div class="form-check">
				<label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_ageing_format1]', 1,
					!empty($common_settings['hide_ageing_format1']) ? true : false,
					[ 'class' => 'form-check-input', 'id' => 'hide_ageing_front']); ?> <?php echo e(__( 'lang_v1.hide_ageing_format1' ), false); ?>

				</label>
			</div>
		</div>
	</div>
<?php endif; ?>
<div id="ageing_div" class="col-md-12 col-sm-12 <?php if(!empty($for_pdf)): ?> width-100 <?php endif; ?> <?php if(request('hide_ageing') == 'true'): ?> hide <?php endif; ?>">
	<?php
		$amount_due = 0;
		$current_due = 0;
		$due_7_days = 0;
		$due_8_30_days = 0;
		$due_30_60_days = 0;
		$due_60_90_days = 0;
		$due_over_90_days = 0;
	?>
	<div style="margin-top: <?php if(!empty($for_pdf)): ?> 8px <?php else: ?> 30px <?php endif; ?>;"></div>
			<?php $__currentLoopData = $ageing_details['ledger']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
				<?php
					if($ageing_details['show_paid'] == 'false'){
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
							}
						}else{
							if (in_array($data['transaction_type'], ['ledger_discount', 'ledger_discount2', 'ledger_discount3']) && $data['transaction_sub_type'] == 'sell_discount') {
								$data['total_due'] = -1 * $data['total_due'];
								$data['final_total'] = -1 * $data['final_total'];
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
				?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<table class="table" style="margin-top: 0; <?php if(!empty($for_pdf)): ?> page-break-inside: avoid; <?php endif; ?>">
		<tr>
			<th style="text-align: center; font-size: 12px;"><?php echo app('translator')->get('lang_v1.current'); ?></th>
			<th style="<?php if($hide_style): ?>color: #2dce89 !important; <?php endif; ?> text-align: center; font-size: 12px;"><?php echo e(strtoupper(__('lang_v1.7_days_past_due')), false); ?></th>
			<th style="<?php if($hide_style): ?>color: #2dce89 !important; <?php endif; ?> text-align: center; font-size: 12px;"><?php echo e(strtoupper(__('lang_v1.8_30_days_past_due')), false); ?></th>
			<th style="<?php if($hide_style): ?>color: #ffd026 !important; <?php endif; ?> text-align: center; font-size: 12px;"><?php echo e(strtoupper(__('lang_v1.30_60_days_past_due')), false); ?></th>
			<th style="<?php if($hide_style): ?>color: #ffa100 !important; <?php endif; ?> text-align: center; font-size: 12px;"><?php echo e(strtoupper(__('lang_v1.60_90_days_past_due')), false); ?></th>
			<th style="<?php if($hide_style): ?>color: #f5365c !important; <?php endif; ?> text-align: center; font-size: 12px;"><?php echo e(strtoupper(__('lang_v1.over_90_days_past_due')), false); ?></th>
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
			<td class="ws-nowrap align-right" style="<?php if($hide_style): ?> color: #2dce89 !important; <?php endif; ?> text-align: right;">
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
			<td class="ws-nowrap align-right" style="<?php if($hide_style): ?> color: #2dce89 !important; <?php endif; ?>  text-align: right;">
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
			<td class="ws-nowrap align-right" style="<?php if($hide_style): ?> color: #ffd026 !important; <?php endif; ?>  text-align: right;">
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
			<td class="ws-nowrap align-right" style="<?php if($hide_style): ?> color: #ffa100 !important; <?php endif; ?> text-align: right;">
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
			<td class="ws-nowrap align-right" style="<?php if($hide_style): ?> color: #f5365c !important; <?php endif; ?>  text-align: right;">
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
		// session value, so the ageing-report footer follows the branch being printed.
		$_ag_cs = isset($common_settings) && is_array($common_settings) ? $common_settings : (session('business.common_settings') ?? []);
	?>
	<?php if(($contact->type == 'customer' || $contact->type == 'both') && !empty($_ag_cs['cutomer_ledger_format2_footer_text'])): ?>
	<div class="col-md-12 text-center">
		<br>
		<?php echo e($_ag_cs['cutomer_ledger_format2_footer_text'], false); ?>

	</div>
	<?php endif; ?>
	<?php if($contact->type == 'supplier' && !empty($_ag_cs['supplier_ledger_format2_footer_text'])): ?>
	<div class="col-md-12 text-center">
		<br>
		<?php echo e($_ag_cs['supplier_ledger_format2_footer_text'], false); ?>

	</div>
	<?php endif; ?>
</div>
