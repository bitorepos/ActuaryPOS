<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/discounts-report-print');
    $report_title = $report_title ?? __('lang_v1.discounts_report');
    $total_pages = count($row_pages ?? [[]]);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';

    if (! function_exists('_drp_print_value')) {
        function _drp_print_value($value, $type, $decimal_separator, $thousand_separator) {
            if ($value === null || $value === '') return '';
            if ($type === 'money') return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
            if ($type === 'quantity') return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
            if ($type === 'number') return number_format((float) $value, 0, $decimal_separator, $thousand_separator);
            if ($type === 'percent') return number_format((float) $value, 2, $decimal_separator, $thousand_separator).'%';
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
        html, body { background: #fff !important; }
        .cr-stage { margin-top: 0; padding: 0; }
        .cr-sheet { box-shadow: none; }
        <?php endif; ?>

        .drp-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: <?php echo e(count($columns) > 8 ? '5.5pt' : '7.6pt', false); ?>;
        }
        .drp-print th,
        .drp-print td {
            border: 1px solid #d2d2d2;
            padding: 3px 4px;
            line-height: 1.12;
            vertical-align: top;
            text-align: left;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .drp-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: <?php echo e(count($columns) > 8 ? '4.9pt' : '6.8pt', false); ?>;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .drp-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .drp-print tfoot td {
            background: #e8e8e8 !important;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .drp-print .text-right { text-align: right !important; }
        .drp-print .amount-cell {
            background: #f7fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .drp-metrics {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 6px;
            margin-bottom: 8px;
        }
        .drp-metric {
            border: 1px solid #d2d2d2;
            background: #f7fbff;
            padding: 6px 8px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .drp-metric-label {
            color: #555;
            font-size: 7.3pt;
            text-transform: uppercase;
            font-weight: 700;
        }
        .drp-metric-value {
            color: #111;
            font-size: 10.5pt;
            font-weight: 800;
            margin-top: 2px;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage drp-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.discounts_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if($page_index === 0 && ! empty($summary_cards)): ?>
                <div class="drp-metrics">
                    <?php $__currentLoopData = $summary_cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="drp-metric">
                            <div class="drp-metric-label"><?php echo e($card['label'], false); ?></div>
                            <div class="drp-metric-value">
                                <?php echo e(_drp_print_value($card['value'] ?? '', $card['type'] ?? 'text', $decimal_separator, $thousand_separator), false); ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

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
                                <th class="<?php echo e(in_array(($column['type'] ?? ''), ['money', 'number', 'quantity', 'percent']) ? 'text-right' : '', false); ?>"><?php echo e($column['label'], false); ?></th>
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
                                        $is_amount = in_array($type, ['money', 'number', 'quantity', 'percent']);
                                    ?>
                                    <td class="<?php echo e($is_amount ? 'text-right' : '', false); ?> <?php echo e($type === 'money' ? 'amount-cell' : '', false); ?>">
                                        <?php echo e(_drp_print_value($row[$key] ?? '', $type, $decimal_separator, $thousand_separator), false); ?>

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
                                        <td class="<?php echo e(in_array($type, ['money', 'number', 'quantity', 'percent']) ? 'text-right' : '', false); ?>">
                                            <?php echo e(_drp_print_value($totals[$key] ?? '', $type, $decimal_separator, $thousand_separator), false); ?>

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
