<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/sale-invoices-report-print');
    $total_pages = $total_pages ?? max(1, count($row_pages ?? [[]]));
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $hide_sale_invoices_report_cost_profit = ! empty($hide_sale_invoices_report_cost_profit);
    $common_settings = $common_settings ?? session()->get('business.common_settings', []);
    $show_product_tax_fields = $show_product_tax_fields ?? (!is_array($common_settings) || !array_key_exists('enable_product_tax', $common_settings) || !empty($common_settings['enable_product_tax']));

    if (! function_exists('_sir_print_number')) {
        function _sir_print_number($value, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($report_title, false); ?> - <?php echo e($tab_title, false); ?></title>
    <?php echo $__env->make('report.partials.crystal_report_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        <?php if($is_pdf): ?>
        html, body { background: #fff !important; }
        .cr-stage { margin-top: 0; padding: 0; }
        .cr-sheet { box-shadow: none; }
        <?php endif; ?>

        .sir-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
            font-size: 6.8pt;
        }
        .sir-print th,
        .sir-print td {
            border: 1px solid #d2d2d2;
            padding: 3px 4px;
            line-height: 1.15;
            vertical-align: top;
            text-align: left;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .sir-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 6.2pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sir-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sir-print .text-right,
        .sir-print .align-right {
            text-align: right !important;
            white-space: nowrap;
        }
        .sir-print .total-row td {
            background: #e8e8e8 !important;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sir-print .sir-tab-title {
            margin: 0 0 8px;
            font-size: 10pt;
            font-weight: 800;
            text-transform: uppercase;
        }
        .sir-print .invoice-block {
            margin-bottom: 9px;
        }
        .sir-print .invoice-summary td {
            background: #d5f5e3 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sir-print .sir-invoice-detail,
        .sir-print .line_details td {
            background: #fef9e7 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sir-print .line_details {
            table-layout: fixed !important;
            font-size: 5.2pt;
        }
        .sir-print .line_details th,
        .sir-print .line_details td {
            padding: 2px 3px;
        }
        .sir-print .empty-row {
            text-align: center;
            color: #777;
            padding: 28px 0;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage sir-print" id="crStage">
    <?php if(in_array($tab, ['detailed', 'detailed_scheme'])): ?>
        <?php
            $paymentTypes = $ledger_details['paymentTypes'] ?? [];
            $enabled_modules = [];
            $is_warranty_enabled = false;
        ?>
        <?php $__currentLoopData = $ledger_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
                <?php echo $__env->make('report.partials.sale_invoices_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="sir-tab-title"><?php echo e($tab_title, false); ?></div>

                <?php if(empty($ledger_details['ledger'])): ?>
                    <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
                <?php else: ?>
                    <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="invoice-block">
                            <table class="invoice-summary">
                                <tr>
                                    <th><?php echo e(__('lang_v1.date'), false); ?></th>
                                    <th><?php echo e(__('purchase.ref_no'), false); ?></th>
                                    <th><?php echo e(__('sale.customer_name'), false); ?></th>
                                    <th><?php echo e(__('lang_v1.type'), false); ?></th>
                                    <th><?php echo e(__('sale.location'), false); ?></th>
                                    <th><?php echo e(__('sale.payment_status'), false); ?></th>
                                    <th class="text-right"><?php echo e(__('sale.total_amount'), false); ?></th>
                                    <th class="text-right"><?php echo e(__('lang_v1.paid'), false); ?></th>
                                    <th><?php echo e(__('lang_v1.payment_method'), false); ?></th>
                                    <th class="text-right"><?php echo e(__('lang_v1.due'), false); ?></th>
                                </tr>
                                <tr>
                                    <td><?php echo e(strip_tags(str_replace('<br>', ' ', format_datetime_br($invoice['date'] ?? ''))), false); ?></td>
                                    <td><?php echo e($invoice['ref_no'] ?? '', false); ?></td>
                                    <td><?php echo e($invoice['contact_name'] ?? '', false); ?></td>
                                    <td><?php echo e($invoice['type'] ?? '', false); ?></td>
                                    <td><?php echo e($invoice['location'] ?? '', false); ?></td>
                                    <td><?php echo e($invoice['payment_status'] ?? '', false); ?></td>
                                    <td class="text-right"><?php echo e(_sir_print_number($invoice['final_total'] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                    <td class="text-right"><?php echo e(_sir_print_number($invoice['paid'] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                    <td><?php echo e($paymentTypes[$invoice['payment_method'] ?? ''] ?? ($invoice['payment_method'] ?? ''), false); ?></td>
                                    <td class="text-right"><?php echo e(_sir_print_number($invoice['due'] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                </tr>
                            </table>

                            <?php if(! empty($invoice['sell_lines']) && in_array($invoice['transaction_type'] ?? null, ['sell', 'sell_return', 'sales_order'])): ?>
                                <div class="sir-invoice-detail">
                                    <?php
                                        $total_qty = 0;
                                        $qty_unit = '';
                                        $inv_discount = 0;
                                        $inv_discount2 = 0;
                                    ?>
                                    <?php echo $__env->make('sale_pos.partials.sale_line_details_sir', [
                                        'sell' => (object) $invoice,
                                        'enabled_modules' => [],
                                        'is_warranty_enabled' => false,
                                        'for_ledger' => true,
                                        'scheme' => $scheme ?? false,
                                        'hide_sale_invoices_report_cost_profit' => $hide_sale_invoices_report_cost_profit,
                                        'show_product_tax_fields' => $show_product_tax_fields,
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <div class="cr-foot">
                    <span><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($tab_title, false); ?></span>
                    <span><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> <?php echo e($page_index + 1, false); ?> / <?php echo e($total_pages, false); ?></span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
                <?php echo $__env->make('report.partials.sale_invoices_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="sir-tab-title"><?php echo e($tab_title, false); ?></div>

                <table>
                    <thead>
                        <tr>
                            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th class="<?php echo e(($column['type'] ?? '') === 'money' ? 'text-right' : '', false); ?>"><?php echo e($column['label'], false); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($rows)): ?>
                            <tr>
                                <td colspan="<?php echo e(max(count($columns), 1), false); ?>" class="empty-row"><?php echo e(__('lang_v1.no_records_found'), false); ?></td>
                            </tr>
                        <?php else: ?>
                            <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $is_numeric = in_array(($column['type'] ?? ''), ['money', 'number']);
                                        ?>
                                        <td class="<?php echo e($is_numeric ? 'text-right' : '', false); ?>">
                                            <?php if($is_numeric): ?>
                                                <?php echo e(_sir_print_number($row[$column['key']] ?? 0, $decimal_separator, $thousand_separator), false); ?>

                                            <?php else: ?>
                                                <?php echo e($row[$column['key']] ?? '', false); ?>

                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>

                    <?php if(! empty($rows) && $loop->last): ?>
                        <tfoot>
                            <tr class="total-row">
                                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $is_numeric = in_array(($column['type'] ?? ''), ['money', 'number']);
                                    ?>
                                    <?php if($loop->first): ?>
                                        <td><?php echo e(__('sale.total'), false); ?></td>
                                    <?php elseif($is_numeric): ?>
                                        <td class="text-right"><?php echo e(_sir_print_number($totals[$column['key']] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php else: ?>
                                        <td></td>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>

                <div class="cr-foot">
                    <span><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($tab_title, false); ?></span>
                    <span><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> <?php echo e($page_index + 1, false); ?> / <?php echo e($total_pages, false); ?></span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>

<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</body>
</html>
