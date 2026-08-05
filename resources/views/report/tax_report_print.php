<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/tax-report-print');
    $report_title = $report_title ?? __('report.tax_report');
    $total_pages = count($row_pages ?? [[]]);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';

    if (! function_exists('_tr_print_money')) {
        function _tr_print_money($value, $decimal_separator, $thousand_separator) {
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
        html, body { background: #fff !important; }
        .cr-stage { margin-top: 0; padding: 0; }
        .cr-sheet { box-shadow: none; }
        <?php endif; ?>

        .tax-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 6.7pt;
        }
        .tax-print th,
        .tax-print td {
            border: 1px solid #d2d2d2;
            padding: 3px;
            line-height: 1.15;
            vertical-align: top;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .tax-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 6.2pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .tax-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .tax-print tfoot td {
            background: #e8e8e8 !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .tax-print .text-right { text-align: right; }
        .tax-print .amount-cell {
            background: #f7fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .tax-print .overview-title {
            margin: 7px 0 4px;
            font-size: 10pt;
            font-weight: 800;
            color: #111;
        }
        .tax-print .overview-table {
            margin-bottom: 8px;
            font-size: 8pt;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage tax-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.tax_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if($page_index === 0): ?>
                <div class="overview-title"><?php echo e(__('lang_v1.tax_overall'), false); ?></div>
                <table class="overview-table">
                    <thead>
                        <tr>
                            <th><?php echo e(__('lang_v1.description'), false); ?></th>
                            <th class="text-right"><?php echo e(__('sale.total'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $overview_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $overview_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($overview_row['label'], false); ?></td>
                                <td class="text-right amount-cell"><?php echo e(_tr_print_money($overview_row['value'], $decimal_separator, $thousand_separator), false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <?php if(empty($page_rows)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $is_value_column = $column['type'] === 'money' || $column['key'] === 'discount_amount'; ?>
                                <th class="<?php echo e($is_value_column ? 'text-right' : '', false); ?>">
                                    <?php echo e($column['label'], false); ?>

                                    <?php if($is_value_column): ?>
                                        (<?php echo e($currency_symbol, false); ?>)
                                    <?php endif; ?>
                                </th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $value = $row[$column['key']] ?? '';
                                        $is_tax_column = strpos($column['key'], 'tax_') === 0;
                                        $is_value_column = $column['type'] === 'money' || $column['key'] === 'discount_amount';
                                    ?>
                                    <td class="<?php echo e($is_value_column ? 'text-right' : '', false); ?> <?php echo e($column['type'] === 'money' ? 'amount-cell' : '', false); ?>">
                                        <?php if($column['type'] === 'money'): ?>
                                            <?php echo e($is_tax_column && (float) $value == 0 ? '' : _tr_print_money($value, $decimal_separator, $thousand_separator), false); ?>

                                        <?php else: ?>
                                            <?php echo e($value, false); ?>

                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <?php if($page_index === $total_pages - 1): ?>
                        <tfoot>
                            <tr>
                                <?php $total_label_printed = false; ?>
                                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $is_tax_column = strpos($column['key'], 'tax_') === 0;
                                        $is_value_column = $column['type'] === 'money' || $column['key'] === 'discount_amount';
                                    ?>
                                    <td class="<?php echo e($is_value_column ? 'text-right' : '', false); ?>">
                                        <?php if($column['key'] === 'total_before_tax'): ?>
                                            <?php echo e(_tr_print_money($totals['total_before_tax'] ?? 0, $decimal_separator, $thousand_separator), false); ?>

                                        <?php elseif($is_tax_column): ?>
                                            <?php echo e(_tr_print_money($totals[$column['key']] ?? 0, $decimal_separator, $thousand_separator), false); ?>

                                        <?php elseif($column['key'] === 'payment_methods'): ?>
                                            <?php echo e($payment_method_summary, false); ?>

                                        <?php elseif(! $total_label_printed): ?>
                                            <?php echo e(__('sale.total'), false); ?>:
                                            <?php $total_label_printed = true; ?>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
</div>

<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</body>
</html>
