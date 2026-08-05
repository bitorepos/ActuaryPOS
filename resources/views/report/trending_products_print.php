<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/trending-products-print');
    $report_title = $report_title ?? __('report.trending_products');
    $section_title = $section_title ?? __('report.top_trending_products');
    $total_pages = count($row_pages ?? [[]]);
    $qty_precision = session('business.quantity_precision', 2);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $chart_max = 0;

    foreach (($rows ?? []) as $chart_row) {
        $chart_max = max($chart_max, (float) ($chart_row['total_unit_sold'] ?? 0));
    }

    if (! function_exists('_tp_print_value')) {
        function _tp_print_value($value, $type, $qty_precision, $decimal_separator, $thousand_separator) {
            if ($value === null || $value === '') return '';
            if ($type === 'quantity') return number_format((float) $value, $qty_precision, $decimal_separator, $thousand_separator);
            if ($type === 'number') return number_format((float) $value, 0, $decimal_separator, $thousand_separator);
            return $value;
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

        .tp-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 8pt;
        }
        .tp-print th,
        .tp-print td {
            border: 1px solid #d2d2d2;
            padding: 4px 5px;
            line-height: 1.18;
            vertical-align: top;
            text-align: left;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .tp-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 7pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .tp-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .tp-print tfoot td {
            background: #e8e8e8 !important;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .tp-print .text-right { text-align: right !important; }
        .tp-print .text-center { text-align: center !important; }
        .tp-print .amount-cell {
            background: #f7fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .tp-print .chart-box {
            border: 1px solid #d7d7d7;
            border-radius: 4px;
            padding: 8px 10px 10px;
            margin-bottom: 10px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .tp-print .chart-title {
            text-align: center;
            font-size: 11pt;
            font-weight: 700;
            margin-bottom: 6px;
        }
        .tp-print .chart-plot {
            height: 62mm;
            border-left: 1px solid #cfcfcf;
            border-bottom: 1px solid #cfcfcf;
            display: flex;
            align-items: flex-end;
            gap: 4px;
            padding: 8px 7px 0;
            background:
                linear-gradient(to top, #fff 0, #fff 24%, #ededed 25%, #fff 26%, #fff 49%, #ededed 50%, #fff 51%, #fff 74%, #ededed 75%, #fff 76%);
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .tp-print .chart-group {
            flex: 1 1 0;
            min-width: 0;
            height: 100%;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }
        .tp-print .chart-bar {
            width: 100%;
            min-width: 4px;
            max-width: 22px;
            border: 1px solid rgba(0, 0, 0, .18);
            background: #5b9bd5 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .tp-print .chart-labels {
            display: flex;
            gap: 4px;
            padding: 4px 7px 0 8px;
            margin-left: 1px;
            font-size: <?php echo e(count($rows ?? []) > 18 ? '5.2pt' : '6.2pt', false); ?>;
            line-height: 1.05;
        }
        .tp-print .chart-label {
            flex: 1 1 0;
            min-width: 0;
            text-align: center;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .tp-print .chart-legend {
            text-align: center;
            margin-top: 5px;
            font-size: 7pt;
            font-weight: 700;
        }
        .tp-print .legend-dot {
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            margin-right: 4px;
            background: #5b9bd5 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage tp-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.trending_products_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(empty($page_rows)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
            <?php else: ?>
                <?php if($page_index === 0 && ! empty($rows)): ?>
                    <div class="chart-box">
                        <div class="chart-title"><?php echo e($section_title, false); ?></div>
                        <div class="chart-plot">
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $qty = (float) ($row['total_unit_sold'] ?? 0);
                                    $bar_height = $chart_max > 0 ? max(1, round(($qty / $chart_max) * 100, 2)) : 0;
                                ?>
                                <div class="chart-group">
                                    <div class="chart-bar" style="height: <?php echo e($bar_height, false); ?>%;"></div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="chart-labels">
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="chart-label"><?php echo e($row['product'], false); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="chart-legend"><span class="legend-dot"></span><?php echo e(__('report.total_unit_sold'), false); ?></div>
                    </div>
                <?php endif; ?>

                <table>
                    <colgroup>
                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <col style="width: <?php echo e($column['width'] ?? 'auto', false); ?>;">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </colgroup>
                    <thead>
                        <tr>
                            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th class="<?php echo e(in_array(($column['type'] ?? ''), ['number', 'quantity']) ? 'text-right' : '', false); ?>"><?php echo e($column['label'], false); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $type = $column['type'] ?? 'text';
                                        $key = $column['key'];
                                        $is_number = in_array($type, ['number', 'quantity']);
                                    ?>
                                    <td class="<?php echo e($is_number ? 'text-right' : '', false); ?> <?php echo e($type === 'quantity' ? 'amount-cell' : '', false); ?>">
                                        <?php echo e(_tp_print_value($row[$key] ?? '', $type, $qty_precision, $decimal_separator, $thousand_separator), false); ?>

                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <?php if(! empty($rows) && $loop->last): ?>
                        <tfoot>
                            <tr>
                                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $type = $column['type'] ?? 'text';
                                        $key = $column['key'];
                                    ?>
                                    <?php if($loop->first): ?>
                                        <td><?php echo e(__('sale.total'), false); ?>:</td>
                                    <?php elseif(! empty($column['total'])): ?>
                                        <td class="<?php echo e(in_array($type, ['number', 'quantity']) ? 'text-right' : '', false); ?>">
                                            <?php echo e(_tp_print_value($totals[$key] ?? '', $type, $qty_precision, $decimal_separator, $thousand_separator), false); ?>

                                        </td>
                                    <?php else: ?>
                                        <td></td>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            <?php endif; ?>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?></span>
                <span>Page <?php echo e($page_index + 1, false); ?> / <?php echo e($total_pages, false); ?></span>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</body>
</html>
