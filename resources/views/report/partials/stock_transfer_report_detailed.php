<!-- app css -->
<?php if(!empty($for_pdf)): ?>
	<link rel="stylesheet" href="<?php echo e(asset('css/app.css?v='.$asset_v), false); ?>">
<?php endif; ?>
<?php
$statues = ['pending' => __('lang_v1.pending'), 'in_transit' => __('lang_v1.in_transit'), 'final' => __('restaurant.completed')];
$common_settings = session()->get('business.common_settings');
$transfer_shipping_total = 0;
$transfer_final_total = 0;
$transfer_selling_total = 0;
$line_quantity_total = 0;
$line_subtotal_total = 0;
$show_stock_transfer_report_cost_value = $show_stock_transfer_report_cost_value ?? empty($hide_stock_transfer_report_cost_value);
$show_stock_transfer_report_sale_value = $show_stock_transfer_report_sale_value ?? empty($hide_stock_transfer_report_sale_value);
$summary_columns = 6 + ($show_stock_transfer_report_sale_value ? 2 : 0) + ($show_stock_transfer_report_cost_value ? 1 : 0);
?>
<div class="col-md-12 col-sm-12" style="background-color: white !important">
	<div class="mb-2 text-end no-print">
		<button type="button" class="btn btn-success btn-sm" id="str_print_detail_report">
			<i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
		</button>
		<button type="button" class="btn btn-primary btn-sm" id="str_export_detail_excel">
			<i class="fa fa-file-excel"></i> <?php echo app('translator')->get('lang_v1.export_to_excel'); ?>
		</button>
	</div>
	<div class="table-responsive">
	<table class="table table-bordered" id="transfer_ledger_table" >
		<thead>
			<tr class="row-border blue-heading text-center">
				<th><?php echo app('translator')->get('messages.date'); ?></th>
				<th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
				<th><?php echo app('translator')->get('lang_v1.location_from'); ?></th>
				<th><?php echo app('translator')->get('lang_v1.location_to'); ?></th>
				<th><?php echo app('translator')->get('sale.status'); ?></th>
				<?php if($show_stock_transfer_report_sale_value): ?>
					<th class="align-right"><?php echo app('translator')->get('lang_v1.shipping_charges'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
				<?php endif; ?>
				<?php if($show_stock_transfer_report_cost_value): ?>
					<th class="align-right"><?php echo app('translator')->get('lang_v1.total_cost_value'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
				<?php endif; ?>
				<?php if($show_stock_transfer_report_sale_value): ?>
					<th class="align-right"><?php echo app('translator')->get('lang_v1.total_selling_value'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
				<?php endif; ?>
				<th><?php echo app('translator')->get('purchase.additional_notes'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php
				$transfer_selling_value = 0;
				foreach ($t['sell_lines'] as $transfer_line) {
					if (! empty($transfer_line->parent_sell_line_id)) {
						continue;
					}

					$transfer_line_selling_price = (float) (optional($transfer_line->variations)->sell_price_inc_tax ?? 0)
						* (float) (optional($transfer_line->sub_unit)->base_unit_multiplier ?: 1);
					$transfer_selling_value += (float) ($transfer_line->quantity ?? 0) * $transfer_line_selling_price;
				}
				$transfer_shipping_total += (float) ($t['shipping_charges'] ?? 0);
				$transfer_final_total += (float) ($t['final_total'] ?? 0);
				$transfer_selling_total += $transfer_selling_value;
			?>
			<tr class="bg-gray transfer_detail_row">
				<td class="row-border"><?php echo format_datetime_br($t['transaction_date']); ?></td>
				<td><?php echo e($t['ref_no'], false); ?></td>
				<td><?php echo e($t['location_from'], false); ?></td>
				<td><?php echo e($t['location_to'], false); ?></td>
				<td><?php echo e($statues[$t['status']], false); ?></td>
				<?php if($show_stock_transfer_report_sale_value): ?>
					<td class="ws-nowrap align-right grey_shipping_charges" data-amount="<?php echo e($t['shipping_charges'], false); ?>"><?php echo e(number_format($t['shipping_charges'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
				<?php endif; ?>
				<?php if($show_stock_transfer_report_cost_value): ?>
					<td class="ws-nowrap align-right grey_final_total" data-amount="<?php echo e($t['final_total'], false); ?>"><?php echo e(number_format($t['final_total'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
				<?php endif; ?>
				<?php if($show_stock_transfer_report_sale_value): ?>
					<td class="ws-nowrap align-right grey_selling_total" data-amount="<?php echo e($transfer_selling_value, false); ?>"><?php echo e(number_format($transfer_selling_value, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
				<?php endif; ?>
				<td><?php echo e($t['additional_notes'], false); ?></td>
			</tr>
			<tr>
				<td colspan="<?php echo e($summary_columns, false); ?>" class="bg-light-skin" style="padding: 0 20px 10px;">
					<table class="table transfer_line_details table-bordered table-slim mb-0 bg-light-skin">
						<tr>
							<th>#</th>
							<th><?php echo e(__('sale.sku'), false); ?></th>
							<th><?php echo e(__('sale.product'), false); ?></th>
							<th class="align-right"><?php echo e(__('sale.qty'), false); ?></th>
							<?php if($show_stock_transfer_report_cost_value): ?>
								<th class="align-right"><?php echo e(__('purchase.cost_price'), false); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
							<?php endif; ?>
							<?php if($show_stock_transfer_report_sale_value): ?>
								<th class="align-right"><?php echo e(__('lang_v1.sale_price'), false); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
							<?php endif; ?>
							<?php if($show_stock_transfer_report_cost_value): ?>
								<th class="align-right"><?php echo e(__('purchase.cost_total'), false); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
							<?php endif; ?>
						</tr>
						<?php $detail_line_number = 0; ?>
						<?php $__currentLoopData = $t['sell_lines']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tsl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if(! empty($tsl->parent_sell_line_id)) continue; ?>
						<?php
							$detail_line_number++;
							$line_quantity = (float) ($tsl->quantity ?? 0);
							$line_subtotal = $line_quantity * (float) ($tsl->unit_price_inc_tax ?? 0);
							$line_selling_price = (float) ($tsl->variations->sell_price_inc_tax ?? 0) * (float) (optional($tsl->sub_unit)->base_unit_multiplier ?: 1);
							$line_quantity_total += $line_quantity;
							$line_subtotal_total += $line_subtotal;
						?>
						<tr>
							<td><?php echo e($detail_line_number, false); ?></td>
							<td><?php echo e($tsl->variations->sub_sku, false); ?></td>
							<td><?php echo e($tsl->product->name, false); ?></td>
							<td class="align-right"><?php echo e(number_format($line_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($tsl->product->unit->short_name, false); ?></td>
							<?php if($show_stock_transfer_report_cost_value): ?>
								<td class="align-right"><?php echo e(number_format($tsl->unit_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
							<?php endif; ?>
							<?php if($show_stock_transfer_report_sale_value): ?>
								<td class="align-right"><?php echo e(number_format($line_selling_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
							<?php endif; ?>
							<?php if($show_stock_transfer_report_cost_value): ?>
								<td class="align-right"><?php echo e(number_format($line_subtotal, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
							<?php endif; ?>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</table>
				</td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
		<tfoot>
			<tr class="font-17 str-detail-footer-total" style="margin-top:10px">
				<td colspan="5" class="align-right str_footer_label"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
				<?php if($show_stock_transfer_report_sale_value): ?>
					<td class="ws-nowrap align-right str_footer_shipping_charges"><?php echo e(number_format($transfer_shipping_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
				<?php endif; ?>
				<?php if($show_stock_transfer_report_cost_value): ?>
					<td class="ws-nowrap align-right str_footer_final_total"><?php echo e(number_format($transfer_final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
				<?php endif; ?>
				<?php if($show_stock_transfer_report_sale_value): ?>
					<td class="ws-nowrap align-right str_footer_selling_total"><?php echo e(number_format($transfer_selling_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
				<?php endif; ?>
				<td></td>
			</tr>
			<tr class="str-detail-line-footer-row">
				<td colspan="<?php echo e($summary_columns, false); ?>" class="bg-light-skin" style="padding: 0 20px 10px;">
					<table class="table transfer_line_details table-bordered table-slim mb-0 bg-light-skin">
						<tr class="font-17 str-detail-line-footer-total">
							<td colspan="3" class="str_footer_line_label"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
							<td class="ws-nowrap align-right str_footer_line_qty"><?php echo e(number_format($line_quantity_total, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
							<?php if($show_stock_transfer_report_cost_value): ?>
								<td></td>
							<?php endif; ?>
							<?php if($show_stock_transfer_report_sale_value): ?>
								<td></td>
							<?php endif; ?>
							<?php if($show_stock_transfer_report_cost_value): ?>
								<td class="ws-nowrap align-right str_footer_line_subtotal"><?php echo e(number_format($line_subtotal_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
							<?php endif; ?>
						</tr>
					</table>
				</td>
			</tr>
        </tfoot>
	</table>
	</div>
	<style>
		.line_details tr td, .line_details tr th, #yellow_footer td
		{
			text-align: left !important;
		}
		.bg-gray td, .center_text
		{
			text-align: center !important;
		}
		#transfer_ledger_table .bg-gray td.align-right,
		#transfer_ledger_table th.align-right,
		#transfer_ledger_table td.align-right {
			text-align: right !important;
		}
		#transfer_ledger_table > tfoot > tr.str-detail-footer-total > td {
			background-color: #d5f5e3 !important;
			border-top: 2px solid #a9dfbf !important;
			text-align: right !important;
		}
		#transfer_ledger_table .str-detail-line-footer-total td {
			background-color: #fdf3cd !important;
			text-align: right !important;
		}
		#transfer_ledger_table .str-detail-line-footer-total td:first-child {
			text-align: left !important;
		}
		.ledger_table{
			overflow-x: scroll;
		}
	</style>
</div>
