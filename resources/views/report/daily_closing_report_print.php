<?php
    $is_pdf = ! empty($is_pdf);
    $is_excel = ! empty($is_excel);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/daily-closing-report-print');
    $total_pages = $total_pages ?? max(1, count($pages ?? [[]]));
    $report_title = $report_title ?? __('lang_v1.daily_closing_report');
    $tab_title = $tab_title ?? __('lang_v1.detailed');
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $common_settings = $common_settings ?? session()->get('business.common_settings', []);
    $show_product_tax_fields = $show_product_tax_fields ?? (!is_array($common_settings) || !array_key_exists('enable_product_tax', $common_settings) || !empty($common_settings['enable_product_tax']));

    if (! function_exists('_dc_print_number')) {
        function _dc_print_number($value, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($report_title, false); ?></title>
    <?php echo $__env->make('report.partials.crystal_report_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        <?php if($is_pdf || $is_excel): ?>
        html, body { background: #fff !important; }
        .cr-stage { margin-top: 0; padding: 0; }
        .cr-sheet { box-shadow: none; }
        <?php endif; ?>

        .dc-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 5.8pt;
        }
        .dc-print th,
        .dc-print td {
            border: 1px solid #d2d2d2;
            padding: 3px;
            line-height: 1.15;
            vertical-align: top;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .dc-print th,
        .dc-print thead td,
        .dc-print .bg-light-gray,
        .dc-print .blue-heading th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .dc-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .dc-print tfoot td,
        .dc-print .total-row td,
        .dc-print .pir_total_row_footer td {
            background: #e8e8e8 !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .dc-print .text-right,
        .dc-print .align-right {
            text-align: right !important;
        }
        .dc-print .text-center {
            text-align: center !important;
        }
        .dc-section-title {
            margin: 0 0 8px;
            font-size: 10pt;
            font-weight: 800;
            text-transform: uppercase;
        }
        .dc-location-title,
        .dc-print .card-header {
            margin: 8px 0 0;
            background: #1a1a1a !important;
            color: #fff !important;
            padding: 5px 8px !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .dc-location-title h4,
        .dc-print .card-header h4 {
            margin: 0;
            font-size: 8pt !important;
            color: #fff !important;
        }
        .dc-print .card,
        .dc-print .card-body {
            border: 0;
            box-shadow: none;
        }
        .dc-print .table-responsive {
            overflow: visible !important;
        }
        .dc-invoice-block {
            margin-bottom: 8px;
        }
        .dc-invoice-summary td {
            background: #d5f5e3 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .dc-print .pir_line_details {
            table-layout: fixed !important;
            font-size: 5.1pt;
        }
        .dc-print .pir_line_details th,
        .dc-print .pir_line_details td {
            padding: 2px 3px;
        }
        .dc-empty {
            color: #666;
            padding: 24px 0;
            text-align: center;
            font-size: 9pt;
        }
        .pull-right,
        .float-end {
            float: right;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf && ! $is_excel): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage dc-print" id="crStage">
    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.purchase_invoices_report_print_header', [
                'tab_title' => ($page['type'] ?? '') === 'stock'
                    ? __('report.stock_value_report').' - '.__('lang_v1.detailed')
                    : __('lang_v1.purchase_invoices_report').' - '.__('lang_v1.detailed'),
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(($page['type'] ?? '') === 'purchase'): ?>
                <?php
                    $location = $page['location'];
                    $ledger_details = $location['ledger_details'] ?? ['ledger' => [], 'paymentTypes' => []];
                    $ledger_rows = $ledger_details['ledger'] ?? [];
                    $paymentTypes = $ledger_details['paymentTypes'] ?? [];
                    $location_totals = $location['grand_totals'] ?? ['final_total' => 0, 'paid' => 0, 'due' => 0];
                ?>
                <div class="dc-section-title"><?php echo e(__('lang_v1.purchase_invoices_report'), false); ?> - <?php echo app('translator')->get('lang_v1.detailed'); ?></div>
                <div class="dc-location-title">
                    <h4>
                        <?php echo e($location['name'] ?? '', false); ?>

                        <span class="pull-right"><?php echo e(count($ledger_rows), false); ?> <?php echo app('translator')->get('lang_v1.invoices'); ?></span>
                    </h4>
                </div>

                <?php if(count($ledger_rows) > 0): ?>
                    <?php $__currentLoopData = $ledger_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="dc-invoice-block">
                            <table class="dc-invoice-summary">
                                <tr>
                                    <th style="width:8%;"><?php echo e(__('lang_v1.date'), false); ?></th>
                                    <th style="width:10%;"><?php echo e(__('purchase.ref_no'), false); ?></th>
                                    <th style="width:13%;"><?php echo e(__('purchase.supplier'), false); ?></th>
                                    <th style="width:7%;"><?php echo e(__('lang_v1.type'), false); ?></th>
                                    <th style="width:11%;"><?php echo e(__('sale.location'), false); ?></th>
                                    <th style="width:8%;"><?php echo e(__('sale.payment_status'), false); ?></th>
                                    <th class="text-right" style="width:10%;"><?php echo e(__('sale.total_amount'), false); ?></th>
                                    <th class="text-right" style="width:9%;"><?php echo e(__('lang_v1.paid'), false); ?></th>
                                    <th style="width:9%;"><?php echo e(__('lang_v1.payment_method'), false); ?></th>
                                    <th class="text-right" style="width:9%;"><?php echo e(__('lang_v1.due'), false); ?></th>
                                    <th style="width:6%;"><?php echo e(__('report.others'), false); ?></th>
                                </tr>
                                <tr>
                                    <td><?php echo format_datetime_br($invoice['date'] ?? ''); ?></td>
                                    <td><?php echo e($invoice['ref_no'] ?? '', false); ?></td>
                                    <td><?php echo e($invoice['contact_name'] ?? '', false); ?></td>
                                    <td><?php echo e($invoice['type'] ?? '', false); ?></td>
                                    <td><?php echo e($invoice['location'] ?? '', false); ?></td>
                                    <td><?php echo e($invoice['payment_status'] ?? '', false); ?></td>
                                    <td class="text-right"><?php echo e(_dc_print_number($invoice['final_total'] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                    <td class="text-right"><?php echo e(_dc_print_number($invoice['paid'] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                    <td><?php echo e($paymentTypes[$invoice['payment_method'] ?? ''] ?? ($invoice['payment_method'] ?? ''), false); ?></td>
                                    <td class="text-right"><?php echo e(_dc_print_number($invoice['due'] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                    <td><?php echo $invoice['others'] ?? ''; ?></td>
                                </tr>
                            </table>

                            <?php if(! empty($invoice['purchase_lines']) && in_array($invoice['transaction_type'] ?? null, ['purchase', 'purchase_return'])): ?>
                                <?php echo $__env->make('report.partials.purchase_line_details_pir', ['purchase' => (object) $invoice, 'show_product_tax_fields' => $show_product_tax_fields], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <table>
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="6"><?php echo e(__('sale.total'), false); ?></td>
                                <td class="text-right"><?php echo e(_dc_print_number($location_totals['final_total'] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_dc_print_number($location_totals['paid'] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                <td></td>
                                <td class="text-right"><?php echo e(_dc_print_number($location_totals['due'] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                <?php else: ?>
                    <div class="dc-empty"><?php echo app('translator')->get('lang_v1.no_data_available'); ?></div>
                <?php endif; ?>
            <?php elseif(($page['type'] ?? '') === 'stock'): ?>
                <div class="dc-section-title"><?php echo e(__('report.stock_value_report'), false); ?> - <?php echo app('translator')->get('lang_v1.detailed'); ?></div>
                <?php echo $__env->make('report.partials.stock_value_location_details_data', array_merge(get_defined_vars(), [
                    'locations' => [$page['location']],
                    'grand_totals' => $page['location']['totals'] ?? ($grand_totals ?? []),
                    'column_visibility_context' => 'daily_closing',
                ]), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                <div class="dc-empty"><?php echo app('translator')->get('lang_v1.no_records_found'); ?></div>
            <?php endif; ?>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?></span>
                <span><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> <?php echo e($page_index + 1, false); ?> / <?php echo e($total_pages, false); ?></span>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if(! $is_pdf && ! $is_excel): ?>
    <?php echo $__env->make('report.partials.crystal_report_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</body>
</html>
