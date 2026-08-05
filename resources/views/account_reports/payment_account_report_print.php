<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('account/payment-account-report-print');
    $total_pages = count($row_pages ?? [[]]);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';

    if (! function_exists('_par_print_money')) {
        function _par_print_money($value, $decimal_separator, $thousand_separator) {
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
        @page { size: <?php echo e($page_size, false); ?>; margin: 0; }
        <?php if($is_pdf): ?>
        html, body { background: #fff !important; }
        .cr-stage { margin-top: 0; padding: 0; }
        .cr-sheet { box-shadow: none; }
        <?php endif; ?>

        .payment-account-print table {
            border-collapse: collapse;
            font-size: 7.1pt;
            table-layout: fixed;
            width: 100%;
        }
        .payment-account-print th,
        .payment-account-print td {
            border: 1px solid #d2d2d2;
            line-height: 1.18;
            overflow-wrap: anywhere;
            padding: 4px 5px;
            text-align: left;
            vertical-align: top;
            white-space: normal;
            word-break: break-word;
        }
        .payment-account-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 6.4pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .payment-account-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .payment-account-print .text-right {
            text-align: right;
            white-space: nowrap;
        }
        .payment-account-print .summary-grid {
            display: grid;
            gap: 7px;
            grid-template-columns: repeat(4, 1fr);
            margin-bottom: 8px;
        }
        .payment-account-print .summary-card {
            border: 1px solid #d2d2d2;
            padding: 7px 8px;
        }
        .payment-account-print .summary-card b {
            display: block;
            font-size: 6.2pt;
            text-transform: uppercase;
        }
        .payment-account-print .summary-card span {
            display: block;
            font-size: 10pt;
            font-weight: 800;
            margin-top: 3px;
            text-align: right;
        }
        .payment-account-print .total-row td {
            background: #e8e8e8 !important;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .payment-account-print .empty-row {
            color: #777;
            padding: 28px 0;
            text-align: center;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage payment-account-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('account_reports.partials.payment_account_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if($page_index === 0): ?>
                <div class="summary-grid">
                    <div class="summary-card">
                        <b>Total Payments</b>
                        <span><?php echo e($summary['total_payments'] ?? 0, false); ?></span>
                    </div>
                    <div class="summary-card">
                        <b><?php echo e(__('account.linked'), false); ?></b>
                        <span><?php echo e($summary['linked_count'] ?? 0, false); ?></span>
                    </div>
                    <div class="summary-card">
                        <b><?php echo e(__('account.not_linked'), false); ?></b>
                        <span><?php echo e($summary['not_linked_count'] ?? 0, false); ?></span>
                    </div>
                    <div class="summary-card">
                        <b><?php echo e(__('sale.amount'), false); ?></b>
                        <span><?php echo e(_par_print_money($summary['total_amount'] ?? 0, $decimal_separator, $thousand_separator), false); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <table>
                <colgroup>
                    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <col style="width: <?php echo e($column['width'] ?? 'auto', false); ?>;">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </colgroup>
                <thead>
                    <tr>
                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th class="<?php echo e(($column['type'] ?? '') === 'money' ? 'text-right' : '', false); ?>">
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
                                    <td class="<?php echo e($type === 'money' ? 'text-right' : '', false); ?>">
                                        <?php if($type === 'money'): ?>
                                            <?php echo e($row[$key] === null || $row[$key] === '' ? '' : _par_print_money($row[$key], $decimal_separator, $thousand_separator), false); ?>

                                        <?php else: ?>
                                            <?php echo e($row[$key] ?? '', false); ?>

                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
                <?php if($page_index + 1 === $total_pages && ! empty($rows)): ?>
                    <tfoot>
                        <tr class="total-row">
                            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($loop->first): ?>
                                    <td><?php echo e(__('sale.total'), false); ?></td>
                                <?php elseif(! empty($column['total']) && ($column['type'] ?? '') === 'money'): ?>
                                    <td class="text-right"><?php echo e(_par_print_money($totals[$column['key']] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                <?php else: ?>
                                    <td></td>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </tfoot>
                <?php endif; ?>
            </table>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</body>
</html>
