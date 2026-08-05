<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/purchases-returns-report-print');
    $total_pages = $total_pages ?? max(1, count($row_pages ?? [[]]));
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';

    if (! function_exists('_purchases_returns_report_print_number')) {
        function _purchases_returns_report_print_number($value, $decimal_separator, $thousand_separator) {
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

        .purchases-returns-report-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
            font-size: 6.8pt;
        }
        .purchases-returns-report-print th,
        .purchases-returns-report-print td {
            border: 1px solid #d2d2d2;
            padding: 3px 4px;
            line-height: 1.15;
            vertical-align: top;
            text-align: left;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .purchases-returns-report-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 6.2pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .purchases-returns-report-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .purchases-returns-report-print .text-right {
            text-align: right !important;
            white-space: nowrap;
        }
        .purchases-returns-report-print .total-row td {
            background: #e8e8e8 !important;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .purchases-returns-report-print .prr-tab-title {
            margin: 0 0 8px;
            font-size: 10pt;
            font-weight: 800;
            text-transform: uppercase;
        }
        .purchases-returns-report-print .empty-row {
            text-align: center;
            color: #777;
            padding: 28px 0;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage purchases-returns-report-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.purchases_returns_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="prr-tab-title"><?php echo e($tab_title, false); ?></div>

            <table>
                <thead>
                    <tr>
                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th class="<?php echo e(($column['type'] ?? '') === 'money' ? 'text-right' : '', false); ?>"><?php echo e($column['label'], false); ?></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($rows)): ?>
                        <tr>
                            <td colspan="<?php echo e(max(count($columns), 1), false); ?>" class="empty-row"><?php echo e(__('lang_v1.no_records_found'), false); ?></td>
                        </tr>
                    <?php else: ?>
                        <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $is_numeric = in_array(($column['type'] ?? ''), ['money', 'number']);
                                    ?>
                                    <td class="<?php echo e($is_numeric ? 'text-right' : '', false); ?>">
                                        <?php if($is_numeric): ?>
                                            <?php echo e(_purchases_returns_report_print_number($row[$column['key']] ?? 0, $decimal_separator, $thousand_separator), false); ?>

                                        <?php else: ?>
                                            <?php echo e($row[$column['key']] ?? '', false); ?>

                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>

                <?php if(! empty($rows) && $loop->last): ?>
                    <tfoot>
                        <tr class="total-row">
                            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $is_numeric = in_array(($column['type'] ?? ''), ['money', 'number']);
                                ?>
                                <?php if($loop->first): ?>
                                    <td><?php echo e(__('sale.total'), false); ?></td>
                                <?php elseif($is_numeric): ?>
                                    <td class="text-right"><?php echo e(_purchases_returns_report_print_number($totals[$column['key']] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                <?php else: ?>
                                    <td></td>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </tfoot>
                <?php endif; ?>
            </table>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($tab_title, false); ?></span>
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
