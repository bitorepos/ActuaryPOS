<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'portrait';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/stock-adjustment-report-print');
    $report_title = $report_title ?? __('report.stock_adjustment_report');
    $total_pages = count($row_pages ?? [[]]);
    $qty_precision = session('business.quantity_precision', 2);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $us = $user_settings ?? [];
    $summary_visible = function ($key) use ($us) {
        return empty($us['rpt_stock_sadj_hide_'.$key]);
    };
    $show_stock_adjustment_report_cost_value = $show_stock_adjustment_report_cost_value ?? empty($hide_stock_adjustment_report_cost_value);
    $show_stock_adjustment_report_sale_value = $show_stock_adjustment_report_sale_value ?? empty($hide_stock_adjustment_report_sale_value);
    $summary_money_visible = function ($key) use ($summary_visible, $show_stock_adjustment_report_cost_value, $show_stock_adjustment_report_sale_value) {
        $value_allowed = $key === 'total_recovered'
            ? $show_stock_adjustment_report_sale_value
            : $show_stock_adjustment_report_cost_value;

        return $value_allowed && $summary_visible($key);
    };

    if (! function_exists('_sa_print_money')) {
        function _sa_print_money($value, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
        }
    }
    if (! function_exists('_sa_print_qty')) {
        function _sa_print_qty($value, $precision, $decimal_separator, $thousand_separator) {
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

        .sa-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 7pt;
        }
        .sa-print th,
        .sa-print td {
            border: 1px solid #d2d2d2;
            padding: 4px;
            line-height: 1.18;
            vertical-align: top;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .sa-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 6.4pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sa-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sa-print tfoot td {
            background: #e8e8e8 !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sa-print .text-right { text-align: right; }
        .sa-print .text-center { text-align: center; }
        .sa-print .sa-product { font-weight: 700; }
        .sa-print .amount-cell {
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

<div class="cr-stage sa-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.stock_adjustment_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(empty($page_rows)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
            <?php else: ?>
                <?php if($tab === 'totals'): ?>
                    <table>
                        <thead>
                            <tr>
                                <th><?php echo e(__('messages.date'), false); ?></th>
                                <th class="text-center"><?php echo e(__('lang_v1.count'), false); ?></th>
                                <?php if($show_stock_adjustment_report_cost_value): ?>
                                    <th class="text-right"><?php echo e(__('stock_adjustment.stock_adjustment'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                    <th class="text-right"><?php echo e(__('stock_adjustment.stock_take'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                    <th class="text-right"><?php echo e(__('report.total_stock_adjustment'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                <?php endif; ?>
                                <?php if($show_stock_adjustment_report_sale_value): ?>
                                    <th class="text-right"><?php echo e(__('report.total_recovered'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($row['date'], false); ?></td>
                                    <td class="text-center"><?php echo e($row['adjustment_count'], false); ?></td>
                                    <?php if($show_stock_adjustment_report_cost_value): ?>
                                        <td class="text-right"><?php echo e(_sa_print_money($row['total_stock_adjustment'], $decimal_separator, $thousand_separator), false); ?></td>
                                        <td class="text-right"><?php echo e(_sa_print_money($row['total_stock_take'], $decimal_separator, $thousand_separator), false); ?></td>
                                        <td class="text-right amount-cell"><?php echo e(_sa_print_money($row['total_amount'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                    <?php if($show_stock_adjustment_report_sale_value): ?>
                                        <td class="text-right"><?php echo e(_sa_print_money($row['total_recovered'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <?php if($page_index === $total_pages - 1): ?>
                            <tfoot>
                                <tr>
                                    <td><?php echo e(__('sale.total'), false); ?>:</td>
                                    <td class="text-center"><?php echo e($totals['adjustment_count'], false); ?></td>
                                    <?php if($show_stock_adjustment_report_cost_value): ?>
                                        <td class="text-right"><?php echo e(_sa_print_money($totals['total_stock_adjustment'], $decimal_separator, $thousand_separator), false); ?></td>
                                        <td class="text-right"><?php echo e(_sa_print_money($totals['total_stock_take'], $decimal_separator, $thousand_separator), false); ?></td>
                                        <td class="text-right"><?php echo e(_sa_print_money($totals['total_amount'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                    <?php if($show_stock_adjustment_report_sale_value): ?>
                                        <td class="text-right"><?php echo e(_sa_print_money($totals['total_recovered'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                <?php elseif($tab === 'summary'): ?>
                    <?php
                        $summary_leading_cols = 0;
                        foreach (['date', 'ref_no', 'location', 'adjustment_type'] as $key) {
                            if ($summary_visible($key)) $summary_leading_cols++;
                        }
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <?php if($summary_visible('date')): ?><th><?php echo e(__('messages.date'), false); ?></th><?php endif; ?>
                                <?php if($summary_visible('ref_no')): ?><th><?php echo e(__('purchase.ref_no'), false); ?></th><?php endif; ?>
                                <?php if($summary_visible('location')): ?><th><?php echo e(__('business.location'), false); ?></th><?php endif; ?>
                                <?php if($summary_visible('adjustment_type')): ?><th><?php echo e(__('stock_adjustment.adjustment_type'), false); ?></th><?php endif; ?>
                                <?php if($summary_money_visible('total_amount')): ?><th class="text-right"><?php echo e(__('stock_adjustment.total_amount'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                                <?php if($summary_money_visible('total_recovered')): ?><th class="text-right"><?php echo e(__('stock_adjustment.total_amount_recovered'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                                <?php if($summary_visible('reason')): ?><th><?php echo e(__('stock_adjustment.reason_for_stock_adjustment'), false); ?></th><?php endif; ?>
                                <?php if($summary_visible('added_by')): ?><th><?php echo e(__('lang_v1.added_by'), false); ?></th><?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if($summary_visible('date')): ?><td><?php echo e($row['transaction_date'], false); ?></td><?php endif; ?>
                                    <?php if($summary_visible('ref_no')): ?><td><?php echo e($row['ref_no'], false); ?></td><?php endif; ?>
                                    <?php if($summary_visible('location')): ?><td><?php echo e($row['location_name'], false); ?></td><?php endif; ?>
                                    <?php if($summary_visible('adjustment_type')): ?><td><?php echo e($row['adjustment_type'], false); ?></td><?php endif; ?>
                                    <?php if($summary_money_visible('total_amount')): ?><td class="text-right amount-cell"><?php echo e(_sa_print_money($row['final_total'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php if($summary_money_visible('total_recovered')): ?><td class="text-right"><?php echo e(_sa_print_money($row['total_amount_recovered'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php if($summary_visible('reason')): ?><td><?php echo e($row['additional_notes'], false); ?></td><?php endif; ?>
                                    <?php if($summary_visible('added_by')): ?><td><?php echo e($row['added_by'], false); ?></td><?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <?php if($page_index === $total_pages - 1): ?>
                            <tfoot>
                                <tr>
                                    <?php if($summary_leading_cols > 0): ?><td colspan="<?php echo e($summary_leading_cols, false); ?>" class="text-right"><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
                                    <?php if($summary_money_visible('total_amount')): ?><td class="text-right"><?php echo e(_sa_print_money($totals['final_total'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php if($summary_money_visible('total_recovered')): ?><td class="text-right"><?php echo e(_sa_print_money($totals['total_amount_recovered'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php if($summary_visible('reason')): ?><td></td><?php endif; ?>
                                    <?php if($summary_visible('added_by')): ?><td></td><?php endif; ?>
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
                                <th><?php echo e(__('business.location'), false); ?></th>
                                <th><?php echo e(__('stock_adjustment.adjustment_type'), false); ?></th>
                                <th><?php echo e(__('sale.product'), false); ?></th>
                                <th><?php echo e(__('product.sku'), false); ?></th>
                                <th><?php echo e(__('lang_v1.unit'), false); ?></th>
                                <th class="text-right"><?php echo e(__('purchase.purchase_quantity'), false); ?></th>
                                <?php if($show_stock_adjustment_report_cost_value): ?>
                                    <th class="text-right"><?php echo e(__('sale.unit_price'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                    <th class="text-right"><?php echo e(__('sale.subtotal'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('stock_adjustment.reason_for_stock_adjustment'), false); ?></th>
                                <th><?php echo e(__('lang_v1.added_by'), false); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($row['transaction_date'], false); ?></td>
                                    <td><?php echo e($row['ref_no'], false); ?></td>
                                    <td><?php echo e($row['location_name'], false); ?></td>
                                    <td><?php echo e($row['adjustment_type'], false); ?></td>
                                    <td class="sa-product"><?php echo e($row['product_name'], false); ?></td>
                                    <td><?php echo e($row['sku'], false); ?></td>
                                    <td><?php echo e($row['unit'], false); ?></td>
                                    <td class="text-right"><?php echo e(_sa_print_qty($row['quantity'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_adjustment_report_cost_value): ?>
                                        <td class="text-right"><?php echo e(_sa_print_money($row['unit_price'], $decimal_separator, $thousand_separator), false); ?></td>
                                        <td class="text-right amount-cell"><?php echo e(_sa_print_money($row['line_total'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e($row['additional_notes'], false); ?></td>
                                    <td><?php echo e($row['added_by'], false); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <?php if($page_index === $total_pages - 1): ?>
                            <tfoot>
                                <tr>
                                    <td colspan="7" class="text-right"><?php echo e(__('sale.total'), false); ?>:</td>
                                    <td class="text-right"><?php echo e(_sa_print_qty($totals['quantity'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_adjustment_report_cost_value): ?>
                                        <td></td>
                                        <td class="text-right"><?php echo e(_sa_print_money($totals['line_total'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                    <td></td>
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
                                <?php if($show_stock_adjustment_report_cost_value): ?>
                                    <th class="text-right"><?php echo e(__('sale.subtotal'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="sa-product"><?php echo e($row['product_name'], false); ?></td>
                                    <td><?php echo e($row['sku'], false); ?></td>
                                    <td><?php echo e($row['unit'], false); ?></td>
                                    <td class="text-center"><?php echo e($row['adjustment_count'], false); ?></td>
                                    <td class="text-right"><?php echo e(_sa_print_qty($row['total_quantity'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_adjustment_report_cost_value): ?>
                                        <td class="text-right amount-cell"><?php echo e(_sa_print_money($row['total_value'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <?php if($page_index === $total_pages - 1): ?>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"><?php echo e(__('sale.total'), false); ?>:</td>
                                    <td class="text-center"><?php echo e($totals['adjustment_count'], false); ?></td>
                                    <td class="text-right"><?php echo e(_sa_print_qty($totals['total_quantity'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_adjustment_report_cost_value): ?>
                                        <td class="text-right"><?php echo e(_sa_print_money($totals['total_value'], $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php endif; ?>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                <?php endif; ?>
            <?php endif; ?>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - <?php echo e(__('report.stock_adjustment_report'), false); ?> - <?php echo e($tab_title, false); ?></span>
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
