<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'portrait';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/lot-report-print');
    $report_title = $report_title ?? __('lang_v1.lot_report');
    $total_pages = count($row_pages ?? [[]]);
    $qty_precision = session('business.quantity_precision', 2);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $us = $user_settings ?? [];
    $column_visible = function ($key) use ($us) {
        return empty($us['rpt_stock_lot_hide_'.$key]);
    };

    $visible = [
        'sku' => $column_visible('sku'),
        'product' => $column_visible('product'),
        'lot_number' => $column_visible('lot_number'),
        'exp_date' => $column_visible('exp_date'),
        'current_stock' => $column_visible('current_stock'),
        'total_unit_sold' => $column_visible('total_unit_sold'),
        'total_unit_adjusted' => $column_visible('total_unit_adjusted'),
    ];

    $lead_cols = 0;
    foreach (['sku', 'product', 'lot_number', 'exp_date'] as $key) {
        if ($visible[$key]) $lead_cols++;
    }

    if (! function_exists('_lot_print_qty')) {
        function _lot_print_qty($value, $unit, $precision, $decimal_separator, $thousand_separator) {
            return trim(number_format((float) $value, $precision, $decimal_separator, $thousand_separator).' '.$unit);
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

        .lot-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 7.4pt;
        }
        .lot-print th,
        .lot-print td {
            border: 1px solid #d2d2d2;
            padding: 4px;
            line-height: 1.18;
            vertical-align: top;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .lot-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 6.8pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .lot-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .lot-print tfoot td {
            background: #e8e8e8 !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .lot-print .text-right { text-align: right; }
        .lot-print .product-cell { font-weight: 700; }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage lot-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.lot_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(empty($page_rows)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <?php if($visible['sku']): ?><th>SKU</th><?php endif; ?>
                            <?php if($visible['product']): ?><th><?php echo e(__('business.product'), false); ?></th><?php endif; ?>
                            <?php if($visible['lot_number']): ?><th><?php echo e($lot_number_label, false); ?></th><?php endif; ?>
                            <?php if($visible['exp_date']): ?><th><?php echo e(__('product.exp_date'), false); ?></th><?php endif; ?>
                            <?php if($visible['current_stock']): ?><th class="text-right"><?php echo e(__('report.current_stock'), false); ?></th><?php endif; ?>
                            <?php if($visible['total_unit_sold']): ?><th class="text-right"><?php echo e(__('report.total_unit_sold'), false); ?></th><?php endif; ?>
                            <?php if($visible['total_unit_adjusted']): ?><th class="text-right"><?php echo e(__('lang_v1.total_unit_adjusted'), false); ?></th><?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if($visible['sku']): ?><td><?php echo e($row['sub_sku'], false); ?></td><?php endif; ?>
                                <?php if($visible['product']): ?><td class="product-cell"><?php echo e($row['product'], false); ?></td><?php endif; ?>
                                <?php if($visible['lot_number']): ?><td><?php echo e($row['lot_number'], false); ?></td><?php endif; ?>
                                <?php if($visible['exp_date']): ?><td><?php echo e($row['exp_date'], false); ?></td><?php endif; ?>
                                <?php if($visible['current_stock']): ?><td class="text-right"><?php echo e(_lot_print_qty($row['stock'], $row['unit'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['total_unit_sold']): ?><td class="text-right"><?php echo e(_lot_print_qty($row['total_sold'], $row['unit'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['total_unit_adjusted']): ?><td class="text-right"><?php echo e(_lot_print_qty($row['total_adjusted'], $row['unit'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <?php if($page_index === $total_pages - 1): ?>
                        <tfoot>
                            <tr>
                                <?php if($lead_cols > 0): ?><td colspan="<?php echo e($lead_cols, false); ?>" class="text-right"><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
                                <?php if($visible['current_stock']): ?><td class="text-right"><?php echo e(_lot_print_qty($totals['stock'], '', $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['total_unit_sold']): ?><td class="text-right"><?php echo e(_lot_print_qty($totals['total_sold'], '', $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['total_unit_adjusted']): ?><td class="text-right"><?php echo e(_lot_print_qty($totals['total_adjusted'], '', $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            <?php endif; ?>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?></span>
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
