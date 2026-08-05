<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/combo-items-report-print');
    $report_title = $report_title ?? __('lang_v1.combo_items_report');
    $total_pages = count($row_pages ?? [[]]);
    $qty_precision = session('business.quantity_precision', 2);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $us = $user_settings ?? [];
    $column_visible = function ($key) use ($us) {
        return empty($us['rpt_gen_combo_hide_'.$key]);
    };

    $show_sku = $column_visible('sku');
    $show_product = $column_visible('product');
    $show_unit_price = $column_visible('unit_price');
    $show_unit_cost = $column_visible('unit_cost_exc_tax');
    $show_profit = $column_visible('profit');
    $show_gross_profit = $column_visible('gross_profit');

    $visible_summary_cols = 0;
    foreach ([$show_sku, $show_product, $show_unit_price, $show_unit_cost, $show_profit, $show_gross_profit] as $visible) {
        if ($visible) $visible_summary_cols++;
    }

    if (! function_exists('_ci_print_money')) {
        function _ci_print_money($value, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
        }
    }
    if (! function_exists('_ci_print_qty')) {
        function _ci_print_qty($value, $precision, $decimal_separator, $thousand_separator) {
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

        .ci-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 7pt;
        }
        .ci-print th,
        .ci-print td {
            border: 1px solid #d2d2d2;
            padding: 4px;
            line-height: 1.18;
            vertical-align: top;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .ci-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 6.4pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .ci-print .combo-row td,
        .ci-print tfoot td {
            background: #e8e8e8 !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .ci-print .component-wrap {
            padding: 0;
        }
        .ci-print .component-table {
            margin: 0;
            font-size: 6.8pt;
        }
        .ci-print .component-table th {
            background: #3a3a3a !important;
        }
        .ci-print .text-right { text-align: right; }
        .ci-print .text-center { text-align: center; }
        .ci-print .product-cell { font-weight: 700; }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage ci-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.combo_items_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(empty($page_rows)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <?php if($show_sku): ?><th><?php echo e(__('product.sku'), false); ?></th><?php endif; ?>
                            <?php if($show_product): ?><th><?php echo e(__('sale.product'), false); ?></th><?php endif; ?>
                            <?php if($show_unit_price): ?><th class="text-right"><?php echo e(__('sale.unit_price'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                            <?php if($show_unit_cost): ?><th class="text-right"><?php echo e(__('purchase.unit_cost_exc_tax'), false); ?></th><?php endif; ?>
                            <?php if($show_profit): ?><th class="text-right"><?php echo e(__('lang_v1.profit'), false); ?></th><?php endif; ?>
                            <?php if($show_gross_profit): ?><th class="text-right"><?php echo e(__('lang_v1.gross_profit'), false); ?></th><?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="combo-row">
                                <?php if($show_sku): ?><td><?php echo e($row['sku'], false); ?></td><?php endif; ?>
                                <?php if($show_product): ?><td class="product-cell"><?php echo e($row['name'], false); ?></td><?php endif; ?>
                                <?php if($show_unit_price): ?><td class="text-right"><?php echo e(_ci_print_money($row['sale_price'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_unit_cost): ?><td class="text-right"><?php echo e(_ci_print_money($row['purchase_total'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_profit): ?><td class="text-right"><?php echo e(_ci_print_money($row['profit'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_gross_profit): ?><td class="text-right"><?php echo e(_ci_print_money($row['gross_profit'], $decimal_separator, $thousand_separator), false); ?>%</td><?php endif; ?>
                            </tr>
                            <tr>
                                <td colspan="<?php echo e(max($visible_summary_cols, 1), false); ?>" class="component-wrap">
                                    <table class="component-table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th><?php echo e(__('sale.product'), false); ?></th>
                                                <th><?php echo e(__('sale.sku'), false); ?></th>
                                                <th class="text-right"><?php echo e(__('sale.qty'), false); ?></th>
                                                <th class="text-right"><?php echo e(__('purchase.unit_cost_exc_tax'), false); ?></th>
                                                <th class="text-right"><?php echo e(__('lang_v1.total_purchase'), false); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $row['components']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $component): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td class="text-center"><?php echo e($component['index'], false); ?></td>
                                                    <td><?php echo e($component['name'], false); ?></td>
                                                    <td><?php echo e($component['sku'], false); ?></td>
                                                    <td class="text-right"><?php echo e(_ci_print_qty($component['quantity'], $qty_precision, $decimal_separator, $thousand_separator), false); ?> <?php echo e($component['unit_name'], false); ?></td>
                                                    <td class="text-right"><?php echo e(_ci_print_money($component['unit_cost'], $decimal_separator, $thousand_separator), false); ?></td>
                                                    <td class="text-right"><?php echo e(_ci_print_money($component['total_purchase'], $decimal_separator, $thousand_separator), false); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No Products Assigned</td>
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
                                <?php if($show_sku || $show_product): ?>
                                    <td colspan="<?php echo e(($show_sku ? 1 : 0) + ($show_product ? 1 : 0), false); ?>" class="text-right"><?php echo e(__('lang_v1.grand_total'), false); ?>:</td>
                                <?php endif; ?>
                                <?php if($show_unit_price): ?><td class="text-right"><?php echo e(_ci_print_money($totals['sale_price'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_unit_cost): ?><td class="text-right"><?php echo e(_ci_print_money($totals['purchase_total'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_profit): ?><td class="text-right"><?php echo e(_ci_print_money($totals['profit'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_gross_profit): ?><td class="text-right"><?php echo e(_ci_print_money($totals['gross_profit'], $decimal_separator, $thousand_separator), false); ?>%</td><?php endif; ?>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            <?php endif; ?>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - <?php echo e(__('lang_v1.combo_items_report'), false); ?></span>
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
