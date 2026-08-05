<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/stock-reorder-report-print');
    $report_title = $report_title ?? __('report.stock_reorder_report');
    $total_pages = count($row_pages ?? [[]]);
    $qty_precision = session('business.quantity_precision', 2);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $us = $user_settings ?? [];
    $column_visible = function ($key) use ($us) {
        return empty($us['rpt_stock_sreorder_hide_'.$key]);
    };

    $show_sku = $column_visible('sku');
    $show_product = $column_visible('product');
    $show_variation = $column_visible('variation');
    $show_category = $column_visible('category');
    $show_location = $column_visible('location');
    $show_current_stock = $column_visible('current_stock');
    $show_low = $column_visible('alert_qty_low');
    $show_medium = $column_visible('alert_qty_medium');
    $show_high = $column_visible('alert_qty_high');
    $show_max = $column_visible('alert_qty_max');

    $text_cols = 0;
    foreach ([$show_sku, $show_product, $show_variation, $show_category, $show_location] as $visible) {
        if ($visible) $text_cols++;
    }

    if (! function_exists('_sr_print_qty')) {
        function _sr_print_qty($value, $unit, $precision, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, $precision, $decimal_separator, $thousand_separator).' '.$unit;
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

        .sr-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 7pt;
        }
        .sr-print th,
        .sr-print td {
            border: 1px solid #d2d2d2;
            padding: 4px;
            line-height: 1.2;
            vertical-align: top;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .sr-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 6.7pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sr-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sr-print tfoot td {
            background: #e8e8e8 !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sr-print .text-right { text-align: right; }
        .sr-print .text-center { text-align: center; }
        .sr-print .sr-product { font-weight: 700; }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage sr-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.stock_reorder_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(empty($page_rows)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <?php if($show_sku): ?><th>SKU</th><?php endif; ?>
                            <?php if($show_product): ?><th><?php echo e(__('business.product'), false); ?></th><?php endif; ?>
                            <?php if($show_variation): ?><th><?php echo e(__('lang_v1.variation'), false); ?></th><?php endif; ?>
                            <?php if($show_category): ?><th><?php echo e(__('product.category'), false); ?></th><?php endif; ?>
                            <?php if($show_location): ?><th><?php echo e(__('sale.location'), false); ?></th><?php endif; ?>
                            <?php if($show_current_stock): ?><th class="text-right"><?php echo e(__('report.current_stock'), false); ?></th><?php endif; ?>
                            <?php if($show_low): ?><th class="text-right"><?php echo e(__('product.alert_quantity_low'), false); ?></th><?php endif; ?>
                            <?php if($show_medium): ?><th class="text-right"><?php echo e(__('product.alert_quantity_medium'), false); ?></th><?php endif; ?>
                            <?php if($show_high): ?><th class="text-right"><?php echo e(__('product.alert_quantity_high'), false); ?></th><?php endif; ?>
                            <?php if($show_max): ?><th class="text-right"><?php echo e(__('product.alert_quantity_max'), false); ?></th><?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if($show_sku): ?><td><?php echo e($row['sku'], false); ?></td><?php endif; ?>
                                <?php if($show_product): ?><td class="sr-product"><?php echo e($row['product'], false); ?></td><?php endif; ?>
                                <?php if($show_variation): ?><td><?php echo e($row['variation'], false); ?></td><?php endif; ?>
                                <?php if($show_category): ?><td><?php echo e($row['category'], false); ?></td><?php endif; ?>
                                <?php if($show_location): ?><td><?php echo e($row['location'], false); ?></td><?php endif; ?>
                                <?php if($show_current_stock): ?><td class="text-right"><?php echo e(_sr_print_qty($row['stock'], $row['unit'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_low): ?><td class="text-right"><?php echo e(_sr_print_qty($row['low_level'], $row['unit'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_medium): ?><td class="text-right"><?php echo e(_sr_print_qty($row['medium_level'], $row['unit'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_high): ?><td class="text-right"><?php echo e(_sr_print_qty($row['high_level'], $row['unit'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_max): ?><td class="text-right"><?php echo e(_sr_print_qty($row['max_level'], $row['unit'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <?php if($page_index === $total_pages - 1): ?>
                        <tfoot>
                            <tr>
                                <?php if($text_cols > 0): ?><td colspan="<?php echo e($text_cols, false); ?>" class="text-right"><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
                                <?php if($show_current_stock): ?><td class="text-right"><?php echo e(number_format((float) $totals['stock'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_low): ?><td class="text-right"><?php echo e(number_format((float) $totals['low_level'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_medium): ?><td class="text-right"><?php echo e(number_format((float) $totals['medium_level'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_high): ?><td class="text-right"><?php echo e(number_format((float) $totals['high_level'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($show_max): ?><td class="text-right"><?php echo e(number_format((float) $totals['max_level'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            <?php endif; ?>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - <?php echo e(__('report.stock_reorder_report'), false); ?></span>
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
