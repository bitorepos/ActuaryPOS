<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/sales-analysis-print');
    $report_title = $report_title ?? __('report.sales_analysis');
    $total_pages = count($row_pages ?? [[]]);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $chart_max = 0;
    $chart_colors = ['#5b9bd5', '#ed7d31', '#70ad47', '#ffc000', '#4472c4', '#a5a5a5', '#264478', '#9e480e'];

    foreach (($rows ?? []) as $chart_row) {
        foreach (($chart_row['values'] ?? []) as $value) {
            $chart_max = max($chart_max, abs((float) $value));
        }
    }

    if (! function_exists('_sa_print_value')) {
        function _sa_print_value($value, $type, $decimal_separator, $thousand_separator) {
            if ($value === null || $value === '') return '';
            if ($type === 'number') return number_format((float) $value, 0, $decimal_separator, $thousand_separator);
            return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($report_title, false); ?> - <?php echo e($period_title, false); ?></title>
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
            font-size: 8pt;
        }
        .sa-print th,
        .sa-print td {
            border: 1px solid #d2d2d2;
            padding: 4px 5px;
            line-height: 1.18;
            vertical-align: top;
            text-align: left;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .sa-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 7pt;
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
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sa-print .text-right { text-align: right !important; }
        .sa-print .amount-cell {
            background: #f7fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sa-print .chart-box {
            border: 1px solid #d7d7d7;
            border-radius: 4px;
            padding: 8px 10px 10px;
            margin-bottom: 10px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sa-print .chart-title {
            text-align: center;
            font-size: 11pt;
            font-weight: 700;
            margin-bottom: 6px;
        }
        .sa-print .chart-plot {
            height: 64mm;
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
        .sa-print .chart-group {
            flex: 1 1 0;
            min-width: 8px;
            height: 100%;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            gap: 1px;
        }
        .sa-print .chart-bar {
            flex: 1 1 0;
            min-width: 3px;
            border: 1px solid rgba(0, 0, 0, .18);
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sa-print .chart-labels {
            display: flex;
            gap: 4px;
            padding: 4px 7px 0 8px;
            margin-left: 1px;
            font-size: <?php echo e(count($rows ?? []) > 18 ? '5.2pt' : '6.2pt', false); ?>;
            line-height: 1.05;
        }
        .sa-print .chart-label {
            flex: 1 1 0;
            min-width: 8px;
            text-align: center;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .sa-print .chart-legend {
            text-align: center;
            margin-top: 5px;
            font-size: 7pt;
            font-weight: 700;
        }
        .sa-print .legend-item { margin: 0 5px; display: inline-block; }
        .sa-print .legend-dot {
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            margin-right: 4px;
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
            <?php echo $__env->make('report.partials.sales_analysis_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(empty($page_rows)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
            <?php else: ?>
                <?php if($page_index === 0 && ! empty($rows)): ?>
                    <div class="chart-box">
                        <div class="chart-title"><?php echo e($title_text, false); ?></div>
                        <div class="chart-plot">
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="chart-group">
                                    <?php $__currentLoopData = $table_datasets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataset_index => $dataset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $value = (float) ($row['values'][$dataset['key']] ?? 0);
                                            $bar_height = $chart_max > 0 ? max(1, round((abs($value) / $chart_max) * 100, 2)) : 0;
                                            $bar_color = $chart_colors[$dataset_index % count($chart_colors)];
                                        ?>
                                        <div class="chart-bar" style="height: <?php echo e($bar_height, false); ?>%; background: <?php echo e($bar_color, false); ?> !important;"></div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="chart-labels">
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="chart-label"><?php echo e($row['label'], false); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="chart-legend">
                            <?php $__currentLoopData = $table_datasets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataset_index => $dataset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="legend-item"><span class="legend-dot" style="background: <?php echo e($chart_colors[$dataset_index % count($chart_colors)], false); ?> !important;"></span><?php echo e($dataset['label'], false); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <table>
                    <thead>
                        <tr>
                            <th><?php echo e($period_title, false); ?></th>
                            <?php $__currentLoopData = $table_datasets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th class="text-right"><?php echo e($dataset['label'], false); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($row['label'], false); ?></td>
                                <?php $__currentLoopData = $table_datasets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td class="text-right amount-cell">
                                        <?php echo e(_sa_print_value($row['values'][$dataset['key']] ?? 0, $dataset['type'] ?? $measure_type, $decimal_separator, $thousand_separator), false); ?>

                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <?php if($page_index === $total_pages - 1): ?>
                        <tfoot>
                            <tr>
                                <td><?php echo e(__('sale.total'), false); ?>:</td>
                                <?php $__currentLoopData = $table_datasets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td class="text-right">
                                        <?php echo e(_sa_print_value($totals[$dataset['key']] ?? 0, $dataset['type'] ?? $measure_type, $decimal_separator, $thousand_separator), false); ?>

                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            <?php endif; ?>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($period_title, false); ?></span>
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
