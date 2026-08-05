<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/product-purchase-report-print');
    $report_title = $report_title ?? __('lang_v1.product_purchase_report');
    $total_pages = count($row_pages ?? [[]]);
    $qty_precision = session('business.quantity_precision', 2);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';

    if (! function_exists('_ppurchase_print_money')) {
        function _ppurchase_print_money($value, $decimal_separator, $thousand_separator) {
            return $value === null || $value === '' ? '' : number_format((float) $value, 2, $decimal_separator, $thousand_separator);
        }
    }
    if (! function_exists('_ppurchase_print_qty')) {
        function _ppurchase_print_qty($value, $unit, $precision, $decimal_separator, $thousand_separator) {
            if ($value === null || $value === '') return '';
            return trim(number_format((float) $value, $precision, $decimal_separator, $thousand_separator).' '.$unit);
        }
    }
    if (! function_exists('_ppurchase_print_value')) {
        function _ppurchase_print_value($value, $type, $unit, $qty_precision, $decimal_separator, $thousand_separator) {
            if ($type === 'money') return _ppurchase_print_money($value, $decimal_separator, $thousand_separator);
            if ($type === 'qty') return _ppurchase_print_qty($value, $unit, $qty_precision, $decimal_separator, $thousand_separator);
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

        .ppurchase-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: <?php echo e(count($columns) > 9 ? '5.5pt' : '6.8pt', false); ?>;
        }
        .ppurchase-print th,
        .ppurchase-print td {
            border: 1px solid #d2d2d2;
            padding: 2px 3px;
            line-height: 1.1;
            vertical-align: top;
            text-align: left;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .ppurchase-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: <?php echo e(count($columns) > 9 ? '5pt' : '6pt', false); ?>;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .ppurchase-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .ppurchase-print tfoot td {
            background: #e8e8e8 !important;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .ppurchase-print .text-right { text-align: right !important; }
        .ppurchase-print .product-cell { font-weight: 700; }
        .ppurchase-print .amount-cell {
            background: #f7fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage ppurchase-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.product_purchase_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(empty($page_rows)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th class="<?php echo e(in_array(($column['type'] ?? ''), ['money', 'qty', 'number']) ? 'text-right' : '', false); ?>"><?php echo e($column['label'], false); ?></th>
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
                                        $value = $row[$key] ?? '';
                                        $unit = ! empty($column['unit_key']) ? ($row[$column['unit_key']] ?? '') : '';
                                        $is_amount = in_array($type, ['money', 'qty', 'number']);
                                    ?>
                                    <td class="<?php echo e($is_amount ? 'text-right' : '', false); ?> <?php echo e($type === 'money' ? 'amount-cell' : '', false); ?> <?php echo e($key === 'product_name' ? 'product-cell' : '', false); ?>">
                                        <?php echo e(_ppurchase_print_value($value, $type, $unit, $qty_precision, $decimal_separator, $thousand_separator), false); ?>

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
                                        <td class="<?php echo e(in_array($type, ['money', 'qty', 'number']) ? 'text-right' : '', false); ?>">
                                            <?php echo e(_ppurchase_print_value($totals[$key] ?? '', $type, '', $qty_precision, $decimal_separator, $thousand_separator), false); ?>

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
