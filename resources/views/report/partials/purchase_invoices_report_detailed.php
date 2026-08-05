<?php
$paymentTypes = $ledger_details['paymentTypes'];
$common_settings = session()->get('business.common_settings');
$show_product_tax_fields = $show_product_tax_fields ?? (!is_array($common_settings) || !array_key_exists('enable_product_tax', $common_settings) || !empty($common_settings['enable_product_tax']));
?>
<div class="col-md-12 col-sm-12 hide pir_ledger_report_filters" style="background-color: white !important;margin-bottom: 10px;">
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
				<select class="form-control input-sm" id="pir_detailed_per_page" style="display: inline-block; width: auto; margin-left: 5px;">
					<?php $__currentLoopData = [10, 25, 50, 100, 200, 'All']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($opt, false); ?>" <?php echo e($pagination['per_page'] == $opt ? 'selected' : '', false); ?> <?php echo e(($pagination['per_page'] == $pagination['total_invoices'] && $opt == 'All') ? 'selected' : '', false); ?>><?php echo e($opt, false); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</label>
		</div>
	</div>
	<?php endif; ?>
	<div class="table-responsive">
	<table class="table table-bordered" id="pir_ledger_table" style="table-layout: fixed; width: 100%;">
		<thead>
			<tr class="row-border blue-heading">
				<th width="8%" class="text-left"><?php echo app('translator')->get('lang_v1.date'); ?></th>
				<th width="9%" class="text-left"><?php echo app('translator')->get('purchase.ref_no'); ?></th>
				<th width="12%" class="text-left"><?php echo app('translator')->get('purchase.supplier'); ?></th>
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
				<tr <?php if(!empty($data['transaction_type']) && in_array($data['transaction_type'], ['purchase', 'purchase_return'])): ?>
					class="pir_detail_row pir-invoice-info"
				<?php endif; ?>>
					<td class="row-border"><?php echo format_datetime_br($data['date']); ?></td>
					<td><?php echo e($data['ref_no'], false); ?></td>
					<td><?php echo e($data['contact_name'], false); ?></td>
					<td><?php echo e($data['type'], false); ?></td>
					<td><?php echo e($data['location'], false); ?></td>
					<td><?php echo e($data['payment_status'], false); ?></td>
					<td class="ws-nowrap align-right pir_grey_final_total" data-amount="<?php echo e($data['final_total'], false); ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $data['final_total'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
					<td class="ws-nowrap align-right pir_grey_paid" data-amount="<?php echo e($data['paid'], false); ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $data['paid'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
					<td class="pir_grey_method" data-orig-value="<?php echo e($data['payment_method'], false); ?>" data-status-name="<?php echo e(!empty($paymentTypes[$data['payment_method']]) ? $paymentTypes[$data['payment_method']] : '', false); ?>"><?php echo e(!empty($paymentTypes[$data['payment_method']]) ? $paymentTypes[$data['payment_method']] : '', false); ?></td>
					<td class="ws-nowrap align-right pir_grey_due" data-orig-value="<?php echo e($data['due'], false); ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $data['due'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
					<td><?php echo $data['others']; ?></td>
				</tr>
				<?php if(!empty($data['transaction_type']) && in_array($data['transaction_type'], ['purchase', 'purchase_return'])): ?>
					<tr>
						<td colspan="11" class="pir-invoice-detail" style="padding: 0 20px 10px;">
							<?php echo $__env->make('report.partials.purchase_line_details_pir', ['purchase' => (object)$data, 'show_product_tax_fields' => $show_product_tax_fields], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</td>
					</tr>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
		<tfoot>
			<tr class="font-17 text-center pir-footer-total" style="margin-top:10px">
				<td style="text-align: left !important;"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
				<td></td>
				<td></td>
				<td class="pir_grey_footer_count"></td>
				<td></td>
				<td></td>
				<td class="pir_grey_footer_final_total"></td>
				<td class="pir_grey_footer_paid"></td>
				<td class="pir_grey_footer_method"></td>
				<td class="pir_grey_footer_due"></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="11" style="padding: 0 20px 10px;">
					<table class="table pir_line_details table-bordered table-slim mb-0" style="table-layout: fixed; width: 100%;">
						<tr class="pir-footer-totals font-17 text-center">
							<td style="width:5%;text-align: left !important;"><strong><?php echo app('translator')->get('sale.total'); ?>s:</strong></td>
							<td style="width:23%;min-width: 23%;"></td>
							<td style="width:8%" class="pir_footer_quantity_count"></td>
							<td style="width:8%"></td>
							<td style="width:8%" class="pir_footer_discount_total"></td>
							<?php if($show_product_tax_fields): ?>
							<td style="width:8%" class="pir_footer_tax_total"></td>
							<?php endif; ?>
							<?php if($show_product_tax_fields): ?>
							<td style="width:8%"></td>
							<?php endif; ?>
							<td style="width:8%" class="pir_footer_subtotal"></td>
							<td style="width:8%" class="pir_footer_sell_total"></td>
							<td style="width:8%" class="pir_footer_profit_total"></td>
							<td style="width:8%" class="pir_footer_gp_percent"></td>
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
				<a href="#" class="pir-detailed-page-link" data-page="<?php echo e($pagination['page'] - 1, false); ?>">&laquo;</a>
			</li>

			<?php
				$pg_start = max(1, $pagination['page'] - 2);
				$pg_end = min($pagination['total_pages'], $pagination['page'] + 2);
			?>

			<?php if($pg_start > 1): ?>
				<li><a href="#" class="pir-detailed-page-link" data-page="1">1</a></li>
				<?php if($pg_start > 2): ?>
					<li class="disabled"><a href="#">...</a></li>
				<?php endif; ?>
			<?php endif; ?>

			<?php for($i = $pg_start; $i <= $pg_end; $i++): ?>
				<li class="<?php echo e($i == $pagination['page'] ? 'active' : '', false); ?>">
					<a href="#" class="pir-detailed-page-link" data-page="<?php echo e($i, false); ?>"><?php echo e($i, false); ?></a>
				</li>
			<?php endfor; ?>

			<?php if($pg_end < $pagination['total_pages']): ?>
				<?php if($pg_end < $pagination['total_pages'] - 1): ?>
					<li class="disabled"><a href="#">...</a></li>
				<?php endif; ?>
				<li><a href="#" class="pir-detailed-page-link" data-page="<?php echo e($pagination['total_pages'], false); ?>"><?php echo e($pagination['total_pages'], false); ?></a></li>
			<?php endif; ?>

			<li class="<?php echo e($pagination['page'] >= $pagination['total_pages'] ? 'disabled' : '', false); ?>">
				<a href="#" class="pir-detailed-page-link" data-page="<?php echo e($pagination['page'] + 1, false); ?>">&raquo;</a>
			</li>
		</ul>
	</div>
	<?php endif; ?>

	<style>
		/* PIR 1st Header (blue-heading) - allow text wrap */
		#pir_ledger_table .blue-heading th {
			white-space: normal !important;
			word-wrap: break-word;
		}
		/* PIR Invoice Info Row */
		.pir-invoice-info td {
			background-color: #d5f5e3 !important;
			border-bottom: 2px solid #a9dfbf;
			white-space: normal !important;
			word-wrap: break-word;
		}
		/* PIR Invoice Detail Area */
		.pir-invoice-detail {
			background-color: #fef9e7 !important;
		}
		.pir-invoice-detail .pir_line_details {
			background-color: #fef9e7 !important;
		}
		.pir-invoice-detail .pir_line_details tr td {
			background-color: #fef9e7 !important;
		}
		.pir-invoice-detail .pir_line_details tr.pir_total_row_footer td {
			background-color: #fdf3cd !important;
		}
		.pir-invoice-detail .pir_line_details tr th {
			background-color: #fdf3cd !important;
		}
		/* Footer "Total:" row */
		#pir_ledger_table > tfoot > tr.pir-footer-total td {
			background-color: #d5f5e3 !important;
			border-top: 2px solid #a9dfbf;
			text-align: right !important;
		}
		/* Footer "Totals:" row */
		#pir_ledger_table .pir-footer-totals td {
			background-color: #fdf3cd !important;
		}
		.pir_line_details tr td, .pir_line_details tr th {
			text-align: left !important;
		}
		.pir_line_details tr td.text-right, .pir_line_details tr th.text-right {
			text-align: right !important;
		}
		.pir_line_details > tbody > .pir-footer-totals td {
			text-align: right !important;
			padding: 12px 0px 12px 0px !important;
		}
		.bg-gray td, .center_text {
			text-align: center !important;
		}
		#pir_ledger_table {
			table-layout: fixed;
			word-wrap: break-word;
		}
	</style>
</div>
