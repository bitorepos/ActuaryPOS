<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/mismatch-report-print');
    $report_title = $report_title ?? __('report.mismatch_report');
    $total_pages = count($row_pages ?? [[]]);
    $qty_precision = session('business.quantity_precision', 2);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';

    if (! function_exists('_mm_print_qty')) {
        function _mm_print_qty($value, $precision, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, $precision, $decimal_separator, $thousand_separator);
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

        .mm-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 6.7pt;
        }
        .mm-print th,
        .mm-print td {
            border: 1px solid #d2d2d2;
            padding: 3px;
            line-height: 1.15;
            vertical-align: top;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .mm-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 6pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .mm-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .mm-print tfoot td {
            background: #e8e8e8 !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .mm-print .text-right { text-align: right; }
        .mm-print .text-center { text-align: center; }
        .mm-print .mm-positive {
            background: #eaf7ee !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .mm-print .mm-warning {
            background: #fff3cd !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .mm-print .mm-info {
            background: #e8f4fb !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage mm-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.mismatch_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(empty($page_rows)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th><?php echo e(__('business.product'), false); ?></th>
                            <th>SKU / Variation ID</th>
                            <th class="text-right"><?php echo e(__('purchase.purchase'), false); ?> Qty</th>
                            <th class="text-right"><?php echo e(__('purchase.purchase'), false); ?> Returned</th>
                            <th class="text-right"><?php echo e(__('purchase.purchase'), false); ?> Sold</th>
                            <th class="text-right"><?php echo e(__('purchase.purchase'), false); ?> Adjusted</th>
                            <th class="text-right"><?php echo e(__('purchase.purchase'), false); ?> Mfg Used</th>
                            <th class="text-right">Purchase Qty Avlb</th>
                            <th class="text-right"><?php echo e(__('sale.sale'), false); ?> Qty</th>
                            <th class="text-right"><?php echo e(__('sale.sale'), false); ?> Returned</th>
                            <th class="text-right">Sell Net Qty</th>
                            <th class="text-right">VLD Qty</th>
                            <th class="text-right">Mismatch</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($row['index'], false); ?></td>
                                <td><?php echo e($row['product_name'], false); ?></td>
                                <td><?php echo e($row['sku'], false); ?> (<?php echo e($row['variation_id'], false); ?>)</td>
                                <td class="text-right"><?php echo e(_mm_print_qty($row['pl_qty'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty($row['pl_qty_returned'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty($row['pl_qty_sold'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty(-1 * $row['pl_qty_adjusted'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty($row['pl_qty_mfg'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right mm-positive"><?php echo e(_mm_print_qty($row['pl_qty_avlb'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty($row['sl_qty'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty($row['sl_qty_returned'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right mm-warning"><?php echo e(_mm_print_qty($row['sl_qty_avlb'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right mm-info"><?php echo e(_mm_print_qty($row['vld_qty'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty($row['mismatch_qty'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <?php if($page_index === $total_pages - 1): ?>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><?php echo e(__('sale.total'), false); ?>:</td>
                                <td class="text-right"><?php echo e(_mm_print_qty($totals['pl_qty'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty($totals['pl_qty_returned'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty($totals['pl_qty_sold'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty(-1 * $totals['pl_qty_adjusted'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty($totals['pl_qty_mfg'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty($totals['pl_qty_avlb'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty($totals['sl_qty'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty($totals['sl_qty_returned'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty($totals['sl_qty_avlb'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty($totals['vld_qty'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <td class="text-right"><?php echo e(_mm_print_qty($totals['mismatch_qty'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            <?php endif; ?>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - <?php echo e(__('report.mismatch_report'), false); ?></span>
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
