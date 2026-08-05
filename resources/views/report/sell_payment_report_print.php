<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/sell-payment-report-print');
    $report_title = $report_title ?? __('lang_v1.sell_payment_report');
    $total_pages = count($row_pages ?? [[]]);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';

    if (! function_exists('_spay_print_value')) {
        function _spay_print_value($value, $type, $decimal_separator, $thousand_separator) {
            if ($value === null || $value === '') return '';
            if ($type === 'money') return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
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
    <title><?php echo e($report_title, false); ?> - <?php echo e($tab_title, false); ?></title>
    <?php echo $__env->make('report.partials.crystal_report_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        <?php if($is_pdf): ?>
        @page { margin: 8mm; }
        html, body {
            background: #fff !important;
            margin: 0;
            padding: 0;
        }
        .cr-stage {
            display: block;
            margin: 0;
            padding: 0;
            width: 100%;
        }
        .cr-sheet {
            box-shadow: none;
            display: block;
            min-height: 0;
            padding: 4mm;
            page-break-after: auto !important;
            width: auto;
        }
        .pdf-page-break {
            page-break-after: always !important;
        }
        .cr-head {
            display: table;
            table-layout: fixed;
            width: 100%;
        }
        .cr-head-left,
        .cr-head-right {
            display: table-cell;
            vertical-align: top;
            width: 50%;
        }
        .cr-head-left > div {
            display: inline-block;
            vertical-align: top;
        }
        .cr-report-title {
            font-size: 13pt;
            letter-spacing: 0;
        }
        .cr-filters {
            display: block;
        }
        .cr-filters .f-item {
            display: inline-block;
            margin-right: 12px;
        }
        .cr-foot {
            display: table;
            margin-top: 8px;
            width: 100%;
        }
        .cr-foot span {
            display: table-cell;
            width: 50%;
        }
        .cr-foot span:last-child {
            text-align: right;
        }
        <?php endif; ?>

        .spay-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: <?php echo e(count($columns) > 6 ? '6pt' : '8pt', false); ?>;
        }
        .spay-print th,
        .spay-print td {
            border: 1px solid #d2d2d2;
            padding: 3px 4px;
            line-height: 1.15;
            vertical-align: top;
            text-align: left;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .spay-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: <?php echo e(count($columns) > 6 ? '5.3pt' : '7pt', false); ?>;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .spay-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .spay-print tfoot td {
            background: #e8e8e8 !important;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .spay-print .text-right { text-align: right !important; }
        .spay-print .amount-cell {
            background: #f7fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        <?php if($is_pdf && count($columns) > 6): ?>
        .spay-print table {
            font-size: 5.4pt;
        }
        .spay-print th {
            font-size: 4.8pt;
            padding: 2px 2px;
        }
        .spay-print td {
            font-size: 5.3pt;
            padding: 2px 2px;
        }
        <?php endif; ?>
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage spay-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet <?php if($is_pdf && ! $loop->last): ?> pdf-page-break <?php endif; ?>" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.sell_payment_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(empty($page_rows)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
            <?php else: ?>
                <table>
                    <colgroup>
                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <col style="width: <?php echo e($column['width'] ?? 'auto', false); ?>;">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </colgroup>
                    <thead>
                        <tr>
                            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th class="<?php echo e(in_array(($column['type'] ?? ''), ['money', 'number']) ? 'text-right' : '', false); ?>"><?php echo e($column['label'], false); ?></th>
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
                                        $is_amount = in_array($type, ['money', 'number']);
                                    ?>
                                    <td class="<?php echo e($is_amount ? 'text-right' : '', false); ?> <?php echo e($type === 'money' ? 'amount-cell' : '', false); ?>">
                                        <?php echo e(_spay_print_value($row[$key] ?? '', $type, $decimal_separator, $thousand_separator), false); ?>

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
                                        <td class="<?php echo e(in_array($type, ['money', 'number']) ? 'text-right' : '', false); ?>">
                                            <?php echo e(_spay_print_value($totals[$key] ?? '', $type, $decimal_separator, $thousand_separator), false); ?>

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
