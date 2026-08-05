<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/stock-transfer-report-print');
    $report_title = $report_title ?? __('lang_v1.stock_transfer_report');
    $total_pages = count($row_pages ?? [[]]);
    $qty_precision = session('business.quantity_precision', 2);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $us = $user_settings ?? [];
    $summary_visible = function ($key) use ($us) {
        return empty($us['rpt_stock_strans_hide_'.$key]);
    };
    $show_stock_transfer_report_cost_value = $show_stock_transfer_report_cost_value ?? empty($hide_stock_transfer_report_cost_value);
    $show_stock_transfer_report_sale_value = $show_stock_transfer_report_sale_value ?? empty($hide_stock_transfer_report_sale_value);
    $summary_money_visible = function ($key) use ($summary_visible, $show_stock_transfer_report_cost_value, $show_stock_transfer_report_sale_value) {
        if ($key === 'shipping_charges') {
            return $show_stock_transfer_report_sale_value && $summary_visible($key);
        }

        if ($key === 'total_amount') {
            return $show_stock_transfer_report_cost_value && $summary_visible($key);
        }

        if ($key === 'total_selling_value') {
            return $show_stock_transfer_report_sale_value;
        }

        return $summary_visible($key);
    };
    $detailed_columns = 6 + ($show_stock_transfer_report_sale_value ? 2 : 0) + ($show_stock_transfer_report_cost_value ? 1 : 0);
    $line_detail_columns = 4 + ($show_stock_transfer_report_sale_value ? 1 : 0) + ($show_stock_transfer_report_cost_value ? 2 : 0);

    if (! function_exists('_str_print_money')) {
        function _str_print_money($value, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
        }
    }
    if (! function_exists('_str_print_qty')) {
        function _str_print_qty($value, $precision, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, $precision, $decimal_separator, $thousand_separator);
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
        <?php if($is_pdf): ?>
        html, body { background: #fff !important; }
        .cr-stage { margin-top: 0; padding: 0; }
        .cr-sheet { box-shadow: none; }
        <?php endif; ?>

        .str-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 7pt;
        }
        .str-print th,
        .str-print td {
            border: 1px solid #d2d2d2;
            padding: 4px;
            line-height: 1.18;
            vertical-align: top;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .str-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 6.4pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .str-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .str-print tfoot td,
        .str-print .transfer-row td {
            background: #e8e8e8 !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .str-print .line-table {
            margin: 0;
            font-size: 6.8pt;
        }
        .str-print .line-table th {
            background: #3a3a3a !important;
        }
        .str-print .text-right { text-align: right; }
        .str-print .text-center { text-align: center; }
        .str-print .product-cell { font-weight: 700; }
        .str-print .amount-cell {
            background: #f7fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage str-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.stock_transfer_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(empty($page_rows)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
            <?php else: ?>
                <?php if($tab === 'totals'): ?>
                    <table>
                        <thead>
                            <tr>
                                <th><?php echo e(__('messages.date'), false); ?></th>
                                <th class="text-right"><?php echo e(__('lang_v1.invoice_quantity'), false); ?></th>
                                <th class="text-right"><?php echo e(__('lang_v1.item_quantity'), false); ?></th>
                                <?php if($show_stock_transfer_report_cost_value): ?>
                                    <th class="text-right"><?php echo e(__('lang_v1.total_cost_value'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                <?php endif; ?>
                                <?php if($show_stock_transfer_report_sale_value): ?>
                                    <th class="text-right"><?php echo e(__('lang_v1.total_selling_value'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($row['transfer_date'], false); ?></td>
                                    <td class="text-right"><?php echo e(_str_print_qty($row['total_invoices'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <td class="text-right"><?php echo e(_str_print_qty($row['total_items'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_transfer_report_cost_value): ?>
                                        <td class="text-right amount-cell"><?php echo e(_str_print_money($row['final_total'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                    <?php if($show_stock_transfer_report_sale_value): ?>
                                        <td class="text-right amount-cell"><?php echo e(_str_print_money($row['total_selling_value'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <?php if($page_index === $total_pages - 1): ?>
                            <tfoot>
                                <tr>
                                    <td><?php echo e(__('sale.total'), false); ?>:</td>
                                    <td class="text-right"><?php echo e(_str_print_qty($totals['total_invoices'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <td class="text-right"><?php echo e(_str_print_qty($totals['total_items'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_transfer_report_cost_value): ?>
                                        <td class="text-right"><?php echo e(_str_print_money($totals['final_total'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                    <?php if($show_stock_transfer_report_sale_value): ?>
                                        <td class="text-right"><?php echo e(_str_print_money($totals['total_selling_value'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                <?php elseif($tab === 'summary'): ?>
                    <?php
                        $lead_cols = 0;
                        foreach (['date', 'ref_no', 'location_from', 'location_to', 'status'] as $key) {
                            if ($summary_visible($key)) $lead_cols++;
                        }
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <?php if($summary_visible('date')): ?><th><?php echo e(__('messages.date'), false); ?></th><?php endif; ?>
                                <?php if($summary_visible('ref_no')): ?><th><?php echo e(__('purchase.ref_no'), false); ?></th><?php endif; ?>
                                <?php if($summary_visible('location_from')): ?><th><?php echo e(__('lang_v1.location_from'), false); ?></th><?php endif; ?>
                                <?php if($summary_visible('location_to')): ?><th><?php echo e(__('lang_v1.location_to'), false); ?></th><?php endif; ?>
                                <?php if($summary_visible('status')): ?><th><?php echo e(__('sale.status'), false); ?></th><?php endif; ?>
                                <?php if($summary_money_visible('shipping_charges')): ?><th class="text-right"><?php echo e(__('lang_v1.shipping_charges'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                                <?php if($summary_money_visible('total_amount')): ?><th class="text-right"><?php echo e(__('lang_v1.total_cost_value'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                                <?php if($summary_money_visible('total_selling_value')): ?><th class="text-right"><?php echo e(__('lang_v1.total_selling_value'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                                <?php if($summary_visible('additional_notes')): ?><th><?php echo e(__('purchase.additional_notes'), false); ?></th><?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if($summary_visible('date')): ?><td><?php echo e($row['transaction_date'], false); ?></td><?php endif; ?>
                                    <?php if($summary_visible('ref_no')): ?><td><?php echo e($row['ref_no'], false); ?></td><?php endif; ?>
                                    <?php if($summary_visible('location_from')): ?><td><?php echo e($row['location_from'], false); ?></td><?php endif; ?>
                                    <?php if($summary_visible('location_to')): ?><td><?php echo e($row['location_to'], false); ?></td><?php endif; ?>
                                    <?php if($summary_visible('status')): ?><td><?php echo e($row['status'], false); ?></td><?php endif; ?>
                                    <?php if($summary_money_visible('shipping_charges')): ?><td class="text-right"><?php echo e(_str_print_money($row['shipping_charges'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php if($summary_money_visible('total_amount')): ?><td class="text-right amount-cell"><?php echo e(_str_print_money($row['final_total'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php if($summary_money_visible('total_selling_value')): ?><td class="text-right amount-cell"><?php echo e(_str_print_money($row['total_selling_value'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php if($summary_visible('additional_notes')): ?><td><?php echo e($row['additional_notes'], false); ?></td><?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <?php if($page_index === $total_pages - 1): ?>
                            <tfoot>
                                <tr>
                                    <?php if($lead_cols > 0): ?><td colspan="<?php echo e($lead_cols, false); ?>" class="text-right"><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
                                    <?php if($summary_money_visible('shipping_charges')): ?><td class="text-right"><?php echo e(_str_print_money($totals['shipping_charges'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php if($summary_money_visible('total_amount')): ?><td class="text-right"><?php echo e(_str_print_money($totals['final_total'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php if($summary_money_visible('total_selling_value')): ?><td class="text-right"><?php echo e(_str_print_money($totals['total_selling_value'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php if($summary_visible('additional_notes')): ?><td></td><?php endif; ?>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                <?php elseif($tab === 'detailed'): ?>
                    <table>
                        <thead>
                            <tr>
                                <th><?php echo e(__('messages.date'), false); ?></th>
                                <th><?php echo e(__('purchase.ref_no'), false); ?></th>
                                <th><?php echo e(__('lang_v1.location_from'), false); ?></th>
                                <th><?php echo e(__('lang_v1.location_to'), false); ?></th>
                                <th><?php echo e(__('sale.status'), false); ?></th>
                                <?php if($show_stock_transfer_report_sale_value): ?>
                                    <th class="text-right"><?php echo e(__('lang_v1.shipping_charges'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                <?php endif; ?>
                                <?php if($show_stock_transfer_report_cost_value): ?>
                                    <th class="text-right"><?php echo e(__('lang_v1.total_cost_value'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                <?php endif; ?>
                                <?php if($show_stock_transfer_report_sale_value): ?>
                                    <th class="text-right"><?php echo e(__('lang_v1.total_selling_value'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('purchase.additional_notes'), false); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="transfer-row">
                                    <td><?php echo e($row['transaction_date'], false); ?></td>
                                    <td><?php echo e($row['ref_no'], false); ?></td>
                                    <td><?php echo e($row['location_from'], false); ?></td>
                                    <td><?php echo e($row['location_to'], false); ?></td>
                                    <td><?php echo e($row['status'], false); ?></td>
                                    <?php if($show_stock_transfer_report_sale_value): ?>
                                        <td class="text-right"><?php echo e(_str_print_money($row['shipping_charges'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                    <?php if($show_stock_transfer_report_cost_value): ?>
                                        <td class="text-right"><?php echo e(_str_print_money($row['final_total'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                    <?php if($show_stock_transfer_report_sale_value): ?>
                                        <td class="text-right"><?php echo e(_str_print_money($row['total_selling_value'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e($row['additional_notes'], false); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="<?php echo e($detailed_columns, false); ?>">
                                        <table class="line-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th><?php echo e(__('sale.sku'), false); ?></th>
                                                    <th><?php echo e(__('sale.product'), false); ?></th>
                                                    <th class="text-right"><?php echo e(__('sale.qty'), false); ?></th>
                                                    <?php if($show_stock_transfer_report_cost_value): ?>
                                                        <th class="text-right"><?php echo e(__('purchase.cost_price'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                                    <?php endif; ?>
                                                    <?php if($show_stock_transfer_report_sale_value): ?>
                                                        <th class="text-right"><?php echo e(__('lang_v1.sale_price'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                                    <?php endif; ?>
                                                    <?php if($show_stock_transfer_report_cost_value): ?>
                                                        <th class="text-right"><?php echo e(__('purchase.cost_total'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $row['lines']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo e($line['index'], false); ?></td>
                                                        <td><?php echo e($line['sku'], false); ?></td>
                                                        <td class="product-cell"><?php echo e($line['product'], false); ?></td>
                                                        <td class="text-right"><?php echo e(_str_print_qty($line['quantity'], $qty_precision, $decimal_separator, $thousand_separator), false); ?> <?php echo e($line['unit'], false); ?></td>
                                                        <?php if($show_stock_transfer_report_cost_value): ?>
                                                            <td class="text-right"><?php echo e(_str_print_money($line['unit_price'], $decimal_separator, $thousand_separator), false); ?></td>
                                                        <?php endif; ?>
                                                        <?php if($show_stock_transfer_report_sale_value): ?>
                                                            <td class="text-right"><?php echo e(_str_print_money($line['selling_price'], $decimal_separator, $thousand_separator), false); ?></td>
                                                        <?php endif; ?>
                                                        <?php if($show_stock_transfer_report_cost_value): ?>
                                                            <td class="text-right amount-cell"><?php echo e(_str_print_money($line['subtotal'], $decimal_separator, $thousand_separator), false); ?></td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td colspan="<?php echo e($line_detail_columns, false); ?>"><?php echo e(__('lang_v1.no_records_found'), false); ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <?php if($page_index === $total_pages - 1): ?>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-right"><?php echo e(__('sale.total'), false); ?>:</td>
                                    <?php if($show_stock_transfer_report_sale_value): ?>
                                        <td class="text-right"><?php echo e(_str_print_money($totals['shipping_charges'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                    <?php if($show_stock_transfer_report_cost_value): ?>
                                        <td class="text-right"><?php echo e(_str_print_money($totals['final_total'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                    <?php if($show_stock_transfer_report_sale_value): ?>
                                        <td class="text-right"><?php echo e(_str_print_money($totals['total_selling_value'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                    <td></td>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th><?php echo e(__('sale.product'), false); ?></th>
                                <th><?php echo e(__('product.sku'), false); ?></th>
                                <th><?php echo e(__('lang_v1.unit'), false); ?></th>
                                <th class="text-center"><?php echo e(__('lang_v1.count'), false); ?></th>
                                <th class="text-right"><?php echo e(__('purchase.purchase_quantity'), false); ?></th>
                                <?php if($show_stock_transfer_report_sale_value): ?>
                                    <th class="text-right"><?php echo e(__('lang_v1.sale_price'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                <?php endif; ?>
                                <?php if($show_stock_transfer_report_cost_value): ?>
                                    <th class="text-right"><?php echo e(__('lang_v1.total_cost_value'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                <?php endif; ?>
                                <?php if($show_stock_transfer_report_sale_value): ?>
                                    <th class="text-right"><?php echo e(__('lang_v1.total_selling_value'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="product-cell"><?php echo e($row['product_name'], false); ?></td>
                                    <td><?php echo e($row['sku'], false); ?></td>
                                    <td><?php echo e($row['unit'], false); ?></td>
                                    <td class="text-center"><?php echo e($row['transfer_count'], false); ?></td>
                                    <td class="text-right"><?php echo e(_str_print_qty($row['total_quantity'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_transfer_report_sale_value): ?>
                                        <td class="text-right"><?php echo e(_str_print_money($row['selling_price'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                    <?php if($show_stock_transfer_report_cost_value): ?>
                                        <td class="text-right amount-cell"><?php echo e(_str_print_money($row['total_value'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                    <?php if($show_stock_transfer_report_sale_value): ?>
                                        <td class="text-right amount-cell"><?php echo e(_str_print_money($row['total_selling_value'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <?php if($page_index === $total_pages - 1): ?>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"><?php echo e(__('sale.total'), false); ?>:</td>
                                    <td class="text-center"><?php echo e($totals['transfer_count'], false); ?></td>
                                    <td class="text-right"><?php echo e(_str_print_qty($totals['total_quantity'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_transfer_report_sale_value): ?><td></td><?php endif; ?>
                                    <?php if($show_stock_transfer_report_cost_value): ?>
                                        <td class="text-right"><?php echo e(_str_print_money($totals['total_value'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                    <?php if($show_stock_transfer_report_sale_value): ?>
                                        <td class="text-right"><?php echo e(_str_print_money($totals['total_selling_value'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                <?php endif; ?>
            <?php endif; ?>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - <?php echo e(__('lang_v1.stock_transfer_report'), false); ?> - <?php echo e($tab_title, false); ?></span>
                <span><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> <?php echo e($page_index + 1, false); ?> / <?php echo e($total_pages, false); ?></span>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</body>
</html>
