<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/items-report-print');
    $total_pages = count($row_pages ?? [[]]);
    $qty_precision = session('business.quantity_precision', 2);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';

    if (! function_exists('_ir_print_money')) {
        function _ir_print_money($value, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
        }
    }
    if (! function_exists('_ir_print_qty')) {
        function _ir_print_qty($value, $precision, $decimal_separator, $thousand_separator) {
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

        .ir-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: <?php echo e(count($columns) > 12 ? '5.25pt' : '6.3pt', false); ?>;
        }
        .ir-print th,
        .ir-print td {
            border: 1px solid #d2d2d2;
            padding: 3px 4px;
            line-height: 1.12;
            vertical-align: top;
            text-align: left;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .ir-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: <?php echo e(count($columns) > 12 ? '4.75pt' : '5.9pt', false); ?>;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .ir-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .ir-print .text-right {
            text-align: right;
        }
        .ir-print .amount-cell {
            background: #f7fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .ir-print .qty-note {
            color: #555;
            font-size: 90%;
            margin-top: 2px;
        }
        .ir-print .total-row td {
            background: #e8e8e8 !important;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .ir-print .empty-row {
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

<div class="cr-stage ir-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.items_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <table>
                <thead>
                    <tr>
                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $is_amount = in_array($column['type'] ?? '', ['money', 'qty']); ?>
                            <th class="<?php echo e($is_amount ? 'text-right' : '', false); ?>">
                                <?php echo e($column['label'], false); ?>

                                <?php if(($column['type'] ?? '') === 'money' && ! empty($currency_symbol)): ?>
                                    (<?php echo e($currency_symbol, false); ?>)
                                <?php endif; ?>
                            </th>
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
                                        $key = $column['key'];
                                        $type = $column['type'] ?? 'text';
                                    ?>
                                    <td class="<?php echo e(in_array($type, ['money', 'qty']) ? 'text-right' : '', false); ?> <?php echo e($type === 'money' ? 'amount-cell' : '', false); ?>">
                                        <?php if($type === 'money'): ?>
                                            <?php echo e(_ir_print_money($row[$key] ?? 0, $decimal_separator, $thousand_separator), false); ?>

                                        <?php elseif($type === 'qty'): ?>
                                            <?php echo e(_ir_print_qty($row[$key] ?? 0, $qty_precision, $decimal_separator, $thousand_separator), false); ?>

                                            <?php if(! empty($row[$key.'_unit'])): ?>
                                                <?php echo e($row[$key.'_unit'], false); ?>

                                            <?php endif; ?>
                                            <?php if(! empty($row[$key.'_note'])): ?>
                                                <div class="qty-note"><?php echo e($row[$key.'_note'], false); ?></div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php echo e($row[$key] ?? '', false); ?>

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
                                <?php $type = $column['type'] ?? 'text'; ?>
                                <?php if($loop->first): ?>
                                    <td><?php echo e(__('sale.total'), false); ?></td>
                                <?php elseif(! empty($column['total']) && $type === 'money'): ?>
                                    <td class="text-right"><?php echo e(_ir_print_money($totals[$column['key']] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                <?php elseif(! empty($column['total']) && $type === 'qty'): ?>
                                    <td class="text-right"><?php echo e(_ir_print_qty($totals[$column['key']] ?? 0, $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <?php else: ?>
                                    <td></td>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </tfoot>
                <?php endif; ?>
            </table>

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
