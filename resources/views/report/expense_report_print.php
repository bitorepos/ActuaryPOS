<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'portrait';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/expense-report-print');
    $report_title = $report_title ?? __('report.expense_report');
    $total_pages = count($row_pages ?? [[]]);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $us = $user_settings ?? [];
    $show_category = empty($us['rpt_admin_exp_hide_expense_categories']);
    $show_total = empty($us['rpt_admin_exp_hide_total_expense']);
    $chart_max = 0;
    foreach (($rows ?? []) as $chart_row) {
        $chart_max = max($chart_max, (float) ($chart_row['total_expense'] ?? 0));
    }

    if (! function_exists('_er_print_money')) {
        function _er_print_money($value, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
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

        .expense-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 8.8pt;
        }
        .expense-print th,
        .expense-print td {
            border: 1px solid #d2d2d2;
            padding: 6px;
            line-height: 1.25;
            vertical-align: top;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .expense-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 8pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .expense-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .expense-print tfoot td {
            background: #e8e8e8 !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .expense-print .text-right { text-align: right; }
        .expense-print .amount-cell {
            background: #f7fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .expense-print .chart-box {
            border: 1px solid #d7d7d7;
            border-radius: 4px;
            padding: 8px 10px 10px;
            margin-bottom: 10px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .expense-print .chart-title {
            text-align: center;
            font-size: 12pt;
            font-weight: 700;
            margin-bottom: 6px;
        }
        .expense-print .chart-plot {
            height: 62mm;
            border-left: 1px solid #cfcfcf;
            border-bottom: 1px solid #cfcfcf;
            display: flex;
            align-items: flex-end;
            gap: 5px;
            padding: 8px 8px 0;
            background:
                linear-gradient(to top, #fff 0, #fff 24%, #ededed 25%, #fff 26%, #fff 49%, #ededed 50%, #fff 51%, #fff 74%, #ededed 75%, #fff 76%);
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .expense-print .chart-item {
            flex: 1 1 0;
            min-width: 10px;
            height: 100%;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }
        .expense-print .chart-bar {
            width: 70%;
            min-width: 7px;
            background: #79aee3 !important;
            border: 1px solid #6aa0d7;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .expense-print .chart-labels {
            display: flex;
            gap: 5px;
            padding: 4px 8px 0 9px;
            margin-left: 1px;
            font-size: 6.3pt;
            line-height: 1.08;
        }
        .expense-print .chart-label {
            flex: 1 1 0;
            min-width: 10px;
            text-align: center;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .expense-print .chart-legend {
            text-align: center;
            margin-top: 5px;
            font-size: 8pt;
            font-weight: 700;
        }
        .expense-print .chart-dot {
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #79aee3 !important;
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

<div class="cr-stage expense-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.expense_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(empty($page_rows)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
            <?php else: ?>
                <?php if($page_index === 0 && ! empty($rows)): ?>
                    <div class="chart-box">
                        <div class="chart-title"><?php echo e($report_title, false); ?></div>
                        <div class="chart-plot">
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $bar_height = $chart_max > 0 ? max(1, round(((float) $row['total_expense'] / $chart_max) * 100, 2)) : 0;
                                ?>
                                <div class="chart-item">
                                    <div class="chart-bar" style="height: <?php echo e($bar_height, false); ?>%;"></div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="chart-labels">
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="chart-label"><?php echo e($row['category'], false); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="chart-legend"><span class="chart-dot"></span><?php echo e(__('report.total_expense'), false); ?></div>
                    </div>
                <?php endif; ?>

                <table>
                    <thead>
                        <tr>
                            <?php if($show_category): ?><th><?php echo e(__('expense.expense_categories'), false); ?></th><?php endif; ?>
                            <?php if($show_total): ?><th class="text-right"><?php echo e(__('report.total_expense'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if($show_category): ?><td><?php echo e($row['category'], false); ?></td><?php endif; ?>
                                <?php if($show_total): ?><td class="text-right amount-cell"><?php echo e(_er_print_money($row['total_expense'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <?php if($page_index === $total_pages - 1): ?>
                        <tfoot>
                            <tr>
                                <?php if($show_category): ?><td class="text-right"><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
                                <?php if($show_total): ?><td class="text-right"><?php echo e(_er_print_money($total_expense, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
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
