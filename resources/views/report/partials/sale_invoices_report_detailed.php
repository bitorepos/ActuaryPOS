<!-- app css -->
<?php if(!empty($for_pdf)): ?>
	<link rel="stylesheet" href="<?php echo e(asset('css/app.css?v='.$asset_v), false); ?>">
<?php endif; ?>
<?php
$paymentTypes = $ledger_details['paymentTypes'];
$common_settings = session()->get('business.common_settings');
$hide_sale_invoices_report_cost_profit = ! empty($hide_sale_invoices_report_cost_profit);
$show_product_tax_fields = $show_product_tax_fields ?? (!is_array($common_settings) || !array_key_exists('enable_product_tax', $common_settings) || !empty($common_settings['enable_product_tax']));
?>
<div class="col-md-12 col-sm-12 hide ledger_report_filters" style="background-color: white !important;margin-bottom: 10px;">
	<?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="col-md-6">
			<strong><?php echo e($key, false); ?></strong> : <?php echo e($value, false); ?>

		</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="col-md-12 col-sm-12" style="background-color: white !important">
	
	<?php if(!empty($pagination) && $pagination['total_invoices'] > 0): ?>
	<div class="row" style="margin-bottom: 10px; padding: 0 15px;">
		<div class="col-md-6">
			<span class="text-muted" style="font-size: 13px;">
				Showing <?php echo e($pagination['from'], false); ?> to <?php echo e($pagination['to'], false); ?> of <?php echo e($pagination['total_invoices'], false); ?> invoices
			</span>
		</div>
		<div class="col-md-6 text-right">
			<label style="font-size: 13px; font-weight: normal; margin: 0;">
				Invoices per page:
				<select class="form-control input-sm" id="sir_detailed_per_page" style="display: inline-block; width: auto; margin-left: 5px;">
					<?php $__currentLoopData = [10, 25, 50, 100, 200, 'All']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($opt, false); ?>" <?php echo e($pagination['per_page'] == $opt ? 'selected' : '', false); ?> <?php echo e(($pagination['per_page'] == $pagination['total_invoices'] && $opt == 'All') ? 'selected' : '', false); ?>><?php echo e($opt, false); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</label>
		</div>
	</div>
	<?php endif; ?>
	<div class="table-responsive">
	<table class="table table-bordered" id="ledger_table" style="table-layout: fixed; width: 100%;">
		<thead>
			<tr class="row-border blue-heading">
				<th width="8%" class="text-left"><?php echo app('translator')->get('lang_v1.date'); ?></th>
				<th width="9%" class="text-left"><?php echo app('translator')->get('purchase.ref_no'); ?></th>
				<th width="12%" class="text-left"><?php echo app('translator')->get('sale.customer_name'); ?></th>
				<th width="6%" class="text-left"><?php echo app('translator')->get('lang_v1.type'); ?></th>
				<th width="10%" class="text-left"><?php echo app('translator')->get('sale.location'); ?></th>
				<th width="8%" class="text-left"><?php echo app('translator')->get('sale.payment_status'); ?></th>
				<th width="10%" class="text-right"><?php echo app('translator')->get('sale.total_amount'); ?></th>
				<th width="10%" class="text-right"><?php echo app('translator')->get('lang_v1.paid'); ?></th>
				<th width="8%" class="text-left"><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
				<th width="10%" class="text-right"><?php echo app('translator')->get('lang_v1.due'); ?></th>				
				<th width="9%" class="text-left"><?php echo app('translator')->get('report.others'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $ledger_details['ledger']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
				<tr <?php if(!empty($data['transaction_type']) && in_array($data['transaction_type'], ['sell', 'sell_return', 'purchase'])): ?>
					class="sell_detail_row sir-invoice-info"
					<?php if(!empty($for_pdf)): ?> style="color: #000;background-color: #d6e9f8!important;" <?php endif; ?>
				<?php endif; ?>>
					<td class="row-border"><?php echo format_datetime_br($data['date']); ?></td>
					<td><?php echo e($data['ref_no'], false); ?></td>
					<td><?php echo e($data['contact_name'], false); ?></td>
					<td><?php echo e($data['type'], false); ?></td>
					<td><?php echo e($data['location'], false); ?></td>
					<td><?php echo e($data['payment_status'], false); ?></td>
					
					<td class="ws-nowrap align-right grey_final_total" data-amount="<?php echo e($data['final_total'], false); ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $data['final_total'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
					<td class="ws-nowrap align-right grey_paid" data-amount="<?php echo e($data['paid'], false); ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $data['paid'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
					<td class="grey_method" data-orig-value="<?php echo e($data['payment_method'], false); ?>" data-status-name="<?php echo e(!empty($paymentTypes[$data['payment_method']]) ? $paymentTypes[$data['payment_method']] : '', false); ?>"><?php echo e(!empty($paymentTypes[$data['payment_method']]) ? $paymentTypes[$data['payment_method']] : '', false); ?></td>
					<td class="ws-nowrap align-right grey_due" data-orig-value="<?php echo e($data['due'], false); ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $data['due'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> </td>
					<td><?php echo $data['others']; ?></td>
				</tr>
				<?php if(!empty($data['transaction_type']) && ($data['transaction_type'] == 'sell' || $data['transaction_type'] == 'sell_return')): ?>
					<tr>
						<td colspan="11" class="sir-invoice-detail" style="padding: 0 20px 10px;">
							<?php echo $__env->make('sale_pos.partials.sale_line_details_sir', ['sell' => (object)$data, 'enabled_modules' => [], 'is_warranty_enabled' => false, 'for_ledger' => true, 'hide_sale_invoices_report_cost_profit' => $hide_sale_invoices_report_cost_profit, 'show_product_tax_fields' => $show_product_tax_fields], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</td>
					</tr>
				<?php endif; ?>
				
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
		<tfoot>
			<tr class="font-17 text-center sir-footer-total" style="margin-top:10px">
				<td style="text-align: left !important;"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
				<td></td>
				<td></td>
				<td class="grey_footer_count"></td>
				<td></td>
				<td></td>
				<td class="grey_footer_final_total"></td>
				<td class="grey_footer_paid"></td>
				<td class="grey_footer_method"></td>
				<td class="grey_footer_due"></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="12" style="padding: 0 20px 10px;">
					<table class="table line_details table-bordered <?php if(!empty($for_ledger)): ?> table-slim mb-0 <?php else: ?> <?php endif; ?>" style="table-layout: fixed; width: 100%;">
						<tr class="sir-footer-totals font-17 text-center">
							<td style="width:5%;text-align: left !important;"><strong><?php echo app('translator')->get('sale.total'); ?>s:</strong></td>
							<td style="width:20%;min-width: 20%;"></td>
							<?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
							<td style="width:6%"></td>
							<?php endif; ?>
							<td style="width:6%" class="footer_quantity_count"></td>
							<td style="width:6%"></td>
							<td style="width:7%" class="footer_discount_total"></td>
							<?php if(!empty($common_settings['enable_inline_discount2_sales'])): ?>
							<td style="width:7%"></td>
							<?php endif; ?>
							<?php if($show_product_tax_fields): ?>
							<td style="width:6%" class="footer_tax_total"></td>
							<?php endif; ?>
							<?php if($show_product_tax_fields): ?>
							<td style="width:6%"></td>
							<?php endif; ?>
							<td style="width:6%" class="footer_subtotal"></td>
							<?php if(! $hide_sale_invoices_report_cost_profit): ?>
							<?php if($show_product_tax_fields): ?>
							<td style="width:11%"></td>
							<?php endif; ?>
							<td style="width:7%" class="footer_purchase_total"></td>
							<td style="width:6%"></td>
							<td style="width:6%" class="footer_profit_total"></td>
							<?php endif; ?>
						</tr>
					</table>
				</td>
			</tr>
			
        </tfoot>
	</table>
	</div>

	
	<?php if(!empty($pagination) && $pagination['total_pages'] > 1 && !empty($grand_totals)): ?>
	<div class="table-responsive" style="margin-top: 5px;">
		<table class="table table-bordered" style="margin-bottom: 5px; table-layout: fixed; width: 100%;">
			<tr style="background-color: #d9edf7; font-size: 13px;">
				<td width="8%" class="text-center"><strong><?php echo app('translator')->get('lang_v1.grand_total'); ?>:</strong></td>
				<td width="9%"></td>
				<td width="12%"></td>
				<td width="6%"><strong><?php echo e($pagination['total_invoices'], false); ?></strong></td>
				<td width="10%"></td>
				<td width="8%"></td>
				<td width="10%" class="text-right"><strong><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $grand_totals['final_total'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></strong></td>
				<td width="10%" class="text-right"><strong><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $grand_totals['paid'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></strong></td>
				<td width="8%"></td>
				<td width="10%" class="text-right"><strong><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $grand_totals['due'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></strong></td>
				<td width="9%"></td>
			</tr>
		</table>
	</div>
	<?php endif; ?>

	
	<?php if(!empty($pagination) && $pagination['total_pages'] > 1): ?>
	<div class="text-center" style="margin-top: 10px;">
		<ul class="pagination" style="margin: 0;">
			<li class="<?php echo e($pagination['page'] <= 1 ? 'disabled' : '', false); ?>">
				<a href="#" class="sir-detailed-page-link" data-page="<?php echo e($pagination['page'] - 1, false); ?>">&laquo;</a>
			</li>

			<?php
				$pg_start = max(1, $pagination['page'] - 2);
				$pg_end = min($pagination['total_pages'], $pagination['page'] + 2);
			?>

			<?php if($pg_start > 1): ?>
				<li><a href="#" class="sir-detailed-page-link" data-page="1">1</a></li>
				<?php if($pg_start > 2): ?>
					<li class="disabled"><a href="#">...</a></li>
				<?php endif; ?>
			<?php endif; ?>

			<?php for($i = $pg_start; $i <= $pg_end; $i++): ?>
				<li class="<?php echo e($i == $pagination['page'] ? 'active' : '', false); ?>">
					<a href="#" class="sir-detailed-page-link" data-page="<?php echo e($i, false); ?>"><?php echo e($i, false); ?></a>
				</li>
			<?php endfor; ?>

			<?php if($pg_end < $pagination['total_pages']): ?>
				<?php if($pg_end < $pagination['total_pages'] - 1): ?>
					<li class="disabled"><a href="#">...</a></li>
				<?php endif; ?>
				<li><a href="#" class="sir-detailed-page-link" data-page="<?php echo e($pagination['total_pages'], false); ?>"><?php echo e($pagination['total_pages'], false); ?></a></li>
			<?php endif; ?>

			<li class="<?php echo e($pagination['page'] >= $pagination['total_pages'] ? 'disabled' : '', false); ?>">
				<a href="#" class="sir-detailed-page-link" data-page="<?php echo e($pagination['page'] + 1, false); ?>">&raquo;</a>
			</li>
		</ul>
	</div>
	<?php endif; ?>

	<style>
		/* SIR 1st Header (blue-heading) - allow text wrap */
		#ledger_table .blue-heading th {
			white-space: normal !important;
			word-wrap: break-word;
		}
		/* SIR Invoice Info Row - allow text wrap */
		.sir-invoice-info td {
			background-color: #d5f5e3 !important;
			border-bottom: 2px solid #a9dfbf;
			white-space: normal !important;
			word-wrap: break-word;
		}
		/* SIR Invoice Detail Area */
		.sir-invoice-detail {
			background-color: #fef9e7 !important;
		}
		.sir-invoice-detail .line_details {
			background-color: #fef9e7 !important;
		}
		.sir-invoice-detail .line_details tr td {
			background-color: #fef9e7 !important;
		}
		.sir-invoice-detail .line_details tr.total_row_footer td {;
			background-color: #fdf3cd !important;
		}
		.sir-invoice-detail .line_details tr th {
			background-color: #fdf3cd !important;
		}
		/* Footer "Total:" row - match 2nd header (sir-invoice-info) color */
		#ledger_table > tfoot > tr.sir-footer-total td {
			background-color: #d5f5e3 !important;
			border-top: 2px solid #a9dfbf;
			text-align: right !important;
		}
		/* Footer "Totals:" row - match 1st header (blue-heading) color */
		#ledger_table .sir-footer-totals td {			
			background-color: var(--theme-primary-light, #e8eef4) !important;
			background-color: #fdf3cd !important;
		}
		#line_details > tbody > tr.total_row_footer {
			background-color: #fdf3cd !important;
			text-align: right !important;
		}
		/* Footer "Invoice Totals" rows - match 3rd header color (already via .total_row_footer) */
		.line_details tr td, .line_details tr th, #yellow_footer td
		{
			text-align: left !important;
		}
		.line_details tr td.text-right, .line_details tr th.text-right
		{
			text-align: right !important;
		}
		.line_details > tbody > .sir-footer-totals td {
			text-align: right !important;
			padding: 12px 0px 12px 0px !important;
		}

		.bg-gray td, .center_text
		{
			text-align: center !important;
		}
		#ledger_table {
			table-layout: fixed;
			word-wrap: break-word;
		}
		.ledger_table{
			overflow-x: scroll;
		}
		.col-md-6, .col-sm-6, .col-6 {
			float: left;
			width: 50%;
			box-sizing: border-box;
		}
	</style>
</div>
