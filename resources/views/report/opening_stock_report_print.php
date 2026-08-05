<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/opening-stock-report-print');
    $report_title = $report_title ?? __('lang_v1.opening_stock_report');
    $total_pages = count($row_pages ?? [[]]);
    $qty_precision = session('business.quantity_precision', 2);
    $value_precision = session('business.cost_decimal', session('business.currency_precision', 2));
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $currency_symbol = session('currency')['symbol'] ?? '';
    $us = $user_settings ?? [];
    $column_visible = function ($key) use ($us) {
        return empty($us['rpt_stock_ostock_hide_'.$key]);
    };

    $show_sku = $column_visible('sku');
    $show_product = $column_visible('product');
    $show_unit = true;
    $show_qty = $column_visible('qty');
    $show_qty_left = $column_visible('qty_left');
    $show_opening_stock_report_cost_value = $show_opening_stock_report_cost_value ?? empty($hide_opening_stock_report_cost_value);
    $show_unit_price = $show_opening_stock_report_cost_value && $column_visible('unit_price');
    $show_subtotal = $show_opening_stock_report_cost_value && $column_visible('subtotal');
    $show_date = $column_visible('date');
    $show_note = $column_visible('note');
    $show_location = $column_visible('location');

    $text_cols = 0;
    foreach ([$show_sku, $show_product, $show_unit] as $visible) {
        if ($visible) $text_cols++;
    }

    if (! function_exists('_os_print_qty')) {
        function _os_print_qty($value, $precision, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, $precision, $decimal_separator, $thousand_separator);
        }
    }

    if (! function_exists('_os_print_value')) {
        function _os_print_value($value, $precision, $decimal_separator, $thousand_separator) {
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

        .os-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 7pt;
        }
        .os-print th,
        .os-print td {
            border: 1px solid #d2d2d2;
            padding: 4px;
            line-height: 1.2;
            vertical-align: top;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .os-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 6.7pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .os-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .os-print tfoot td {
            background: #e8e8e8 !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .os-print .text-right { text-align: right; }
        .os-print .os-product { font-weight: 700; }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage os-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.opening_stock_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(empty($page_rows)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <?php if($show_sku): ?><th>SKU</th><?php endif; ?>
                            <?php if($show_product): ?><th><?php echo e(__('business.product'), false); ?></th><?php endif; ?>
                            <?php if($show_unit): ?><th><?php echo e(__('product.unit'), false); ?></th><?php endif; ?>
                            <?php if($show_qty): ?><th class="text-right"><?php echo e(__('sale.qty'), false); ?></th><?php endif; ?>
                            <?php if($show_qty_left): ?><th class="text-right"><?php echo e(__('lang_v1.quantity_left'), false); ?></th><?php endif; ?>
                            <?php if($show_unit_price): ?><th class="text-right"><?php echo e(__('sale.unit_price'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                            <?php if($show_subtotal): ?><th class="text-right"><?php echo e(__('sale.subtotal'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                            <?php if($show_date): ?><th><?php echo e(__('messages.date'), false); ?></th><?php endif; ?>
                            <?php if($show_note): ?><th><?php echo e(__('lang_v1.note'), false); ?></th><?php endif; ?>
                            <?php if($show_location): ?><th><?php echo e(__('sale.location'), false); ?></th><?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if($show_sku): ?><td><?php echo e($row['sku'], false); ?></td><?php endif; ?>
                                <?php if($show_product): ?><td class="os-product"><?php echo e($row['product_name'], false); ?></td><?php endif; ?>
                                <?php if($show_unit): ?><td><?php echo e($row['unit'], false); ?></td><?php endif; ?>
                                <?php if($show_qty): ?><td class="text-right"><?php echo e(_os_print_qty($row['quantity'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_qty_left): ?><td class="text-right"><?php echo e(_os_print_qty($row['remaining_qty'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_unit_price): ?><td class="text-right"><?php echo e(_os_print_value($row['purchase_price'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_subtotal): ?><td class="text-right"><?php echo e(_os_print_value($row['final_total'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_date): ?><td><?php echo e($row['transaction_date'], false); ?></td><?php endif; ?>
                                <?php if($show_note): ?><td><?php echo e($row['additional_notes'], false); ?></td><?php endif; ?>
                                <?php if($show_location): ?><td><?php echo e($row['location'], false); ?></td><?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <?php if($page_index === $total_pages - 1): ?>
                        <tfoot>
                            <tr>
                                <?php if($text_cols > 0): ?><td colspan="<?php echo e($text_cols, false); ?>" class="text-right"><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
                                <?php if($show_qty): ?><td class="text-right"><?php echo e(_os_print_qty($totals['quantity'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_qty_left): ?><td class="text-right"><?php echo e(_os_print_qty($totals['remaining_qty'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_unit_price): ?><td></td><?php endif; ?>
                                <?php if($show_subtotal): ?><td class="text-right"><?php echo e(_os_print_value($totals['final_total'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_date): ?><td></td><?php endif; ?>
                                <?php if($show_note): ?><td></td><?php endif; ?>
                                <?php if($show_location): ?><td></td><?php endif; ?>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            <?php endif; ?>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - <?php echo e(__('lang_v1.opening_stock_report'), false); ?></span>
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
