<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'portrait';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/stock-take-report-print');
    $report_title = $report_title ?? __('report.stock_take_report');
    $total_pages = count($row_pages ?? [[]]);
    $qty_precision = session('business.quantity_precision', 2);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $us = $user_settings ?? [];
    $column_visible = function ($key) use ($us) {
        return empty($us['rpt_stock_stake_hide_'.$key]);
    };

    $show_sku = $column_visible('sku');
    $show_product = $column_visible('product');
    $show_variation = $column_visible('variation');
    $show_rack_details = $column_visible('rack_details');
    $show_on_hand = $column_visible('on_hand');
    $show_actual_counted = $column_visible('actual_counted');

    $text_cols = 0;
    foreach ([$show_sku, $show_product, $show_variation, $show_rack_details] as $visible) {
        if ($visible) $text_cols++;
    }

    if (! function_exists('_stake_print_qty')) {
        function _stake_print_qty($value, $unit, $precision, $decimal_separator, $thousand_separator) {
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

        .stake-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 7.3pt;
        }
        .stake-print th,
        .stake-print td {
            border: 1px solid #d2d2d2;
            padding: 4px;
            line-height: 1.2;
            vertical-align: top;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .stake-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 6.8pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .stake-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .stake-print tfoot td {
            background: #e8e8e8 !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .stake-print .text-right { text-align: right; }
        .stake-print .stake-product { font-weight: 700; }
        .stake-print .actual-cell {
            height: 24px;
            background: #fff !important;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage stake-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.stock_take_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(empty($page_rows)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <?php if($show_sku): ?><th>SKU</th><?php endif; ?>
                            <?php if($show_product): ?><th><?php echo e(__('business.product'), false); ?></th><?php endif; ?>
                            <?php if($show_variation): ?><th><?php echo e(__('lang_v1.variation'), false); ?></th><?php endif; ?>
                            <?php if($show_rack_details): ?><th><?php echo e(__('lang_v1.rack_details'), false); ?></th><?php endif; ?>
                            <?php if($show_on_hand): ?><th class="text-right"><?php echo e(__('stock_adjustment.on_hand'), false); ?></th><?php endif; ?>
                            <?php if($show_actual_counted): ?><th><?php echo e(__('lang_v1.actual_counted'), false); ?></th><?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if($show_sku): ?><td><?php echo e($row['sku'], false); ?></td><?php endif; ?>
                                <?php if($show_product): ?><td class="stake-product"><?php echo e($row['product'], false); ?></td><?php endif; ?>
                                <?php if($show_variation): ?><td><?php echo e($row['variation'], false); ?></td><?php endif; ?>
                                <?php if($show_rack_details): ?>
                                    <td>
                                        Rack: <?php echo e($row['rack'], false); ?><br>
                                        Row: <?php echo e($row['row'], false); ?><br>
                                        Position: <?php echo e($row['position'], false); ?>

                                    </td>
                                <?php endif; ?>
                                <?php if($show_on_hand): ?>
                                    <td class="text-right">
                                        <?php if($row['enable_stock']): ?>
                                            <?php echo e(_stake_print_qty($row['stock'], $row['unit'], $qty_precision, $decimal_separator, $thousand_separator), false); ?>

                                        <?php else: ?>
                                            --
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                                <?php if($show_actual_counted): ?><td class="actual-cell"><?php echo e($row['actual'], false); ?></td><?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <?php if($page_index === $total_pages - 1 && $show_on_hand): ?>
                        <tfoot>
                            <tr>
                                <?php if($text_cols > 0): ?><td colspan="<?php echo e($text_cols, false); ?>" class="text-right"><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
                                <td class="text-right"><?php echo e(number_format((float) $totals['stock'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <?php if($show_actual_counted): ?><td></td><?php endif; ?>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            <?php endif; ?>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - <?php echo e(__('report.stock_take_report'), false); ?></span>
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
