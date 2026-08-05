<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'portrait';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/profit-loss-print');
    $report_title = $report_title ?? __('report.profit_loss');
    $total_pages = $tab === 'summary' ? 1 : count($row_pages ?? [[]]);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';

    if (! function_exists('_pl_print_money')) {
        function _pl_print_money($value, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($report_title, false); ?> - <?php echo e($tab_title, false); ?></title>
    <?php echo $__env->make('report.partials.crystal_report_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        <?php if($is_pdf): ?>
        @page { size: <?php echo e($page_size, false); ?>; margin: 0; }
        html, body { background: #fff !important; }
        .cr-stage {
            display: block;
            gap: 0;
            margin-top: 0;
            padding: 0;
        }
        .cr-sheet {
            box-shadow: none;
            display: block;
            margin: 0;
            min-height: auto;
            padding: 9mm 10mm;
            width: auto;
        }
        .cr-head {
            display: table;
            table-layout: fixed;
            width: 100%;
        }
        .cr-head-left {
            display: table-cell;
            vertical-align: top;
            width: 42%;
        }
        .cr-head-right {
            display: table-cell;
            text-align: right;
            vertical-align: top;
            width: 58%;
        }
        .cr-report-title {
            font-size: 13pt;
            letter-spacing: .02em;
        }
        .cr-report-sub {
            font-size: 8pt;
        }
        <?php endif; ?>

        .pl-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 8pt;
        }
        .pl-print th,
        .pl-print td {
            border: 1px solid #d2d2d2;
            padding: 5px;
            line-height: 1.22;
            vertical-align: top;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .pl-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 7.4pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .pl-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .pl-print tfoot td {
            background: #e8e8e8 !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .pl-print .text-right { text-align: right; }
        .pl-print .section-title {
            margin: 8px 0 4px;
            font-size: 10pt;
            font-weight: 800;
            color: #111;
        }
        .pl-print .amount-cell {
            background: #f7fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .pl-print .amount-col {
            width: 30%;
        }
        .pl-print .label-col {
            width: 70%;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage pl-print" id="crStage">
    <?php if($tab === 'summary'): ?>
        <div class="cr-sheet" id="crPage1">
            <?php echo $__env->make('report.partials.profit_loss_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php $__currentLoopData = $summary_sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="section-title"><?php echo e($section['title'], false); ?></div>
                <table>
                    <colgroup>
                        <col class="label-col">
                        <col class="amount-col">
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo e(__('lang_v1.description'), false); ?></th>
                            <th class="text-right"><?php echo e(__('sale.total'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $section['rows']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($row['label'], false); ?></td>
                                <td class="text-right amount-cell"><?php echo e(_pl_print_money($row['value'], $decimal_separator, $thousand_separator), false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?></span>
                <span><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> 1 / 1</span>
            </div>
        </div>
    <?php else: ?>
        <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
                <?php echo $__env->make('report.partials.profit_loss_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php if(empty($page_rows)): ?>
                    <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
                <?php else: ?>
                    <table>
                        <colgroup>
                            <col class="label-col">
                            <col class="amount-col">
                        </colgroup>
                        <thead>
                            <tr>
                                <th><?php echo e($tab_label, false); ?></th>
                                <th class="text-right"><?php echo e(__('lang_v1.gross_profit'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($row['label'], false); ?></td>
                                    <td class="text-right amount-cell"><?php echo e(_pl_print_money($row['gross_profit'], $decimal_separator, $thousand_separator), false); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <?php if($page_index === $total_pages - 1): ?>
                            <tfoot>
                                <tr>
                                    <td class="text-right"><?php echo e(__('sale.total'), false); ?>:</td>
                                    <td class="text-right"><?php echo e(_pl_print_money($totals['gross_profit'], $decimal_separator, $thousand_separator), false); ?></td>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                <?php endif; ?>

                <div class="cr-foot">
                    <span><?php echo e($business_name, false); ?> - <?php echo e($tab_title, false); ?></span>
                    <span><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> <?php echo e($page_index + 1, false); ?> / <?php echo e($total_pages, false); ?></span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>

<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</body>
</html>
