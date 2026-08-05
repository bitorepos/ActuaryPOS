<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('account/cash-flow-print');
    $total_pages = count($row_pages ?? [[]]);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';

    if (! function_exists('_cf_print_money')) {
        function _cf_print_money($value, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
        }
    }
    if (! function_exists('_cf_direction_label')) {
        function _cf_direction_label($direction) {
            if ($direction === 'inflow') return 'Inflow';
            if ($direction === 'outflow') return 'Outflow';
            return 'Inflow / Outflow';
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

        .cash-flow-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 6.4pt;
        }
        .cash-flow-print th,
        .cash-flow-print td {
            border: 1px solid #d2d2d2;
            padding: 3px 4px;
            line-height: 1.15;
            vertical-align: top;
            text-align: left;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .cash-flow-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 5.9pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .cash-flow-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .cash-flow-print .text-right {
            text-align: right;
            white-space: nowrap;
        }
        .cash-flow-print .amount-cell {
            background: #f7fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .cash-flow-print .pre-line {
            white-space: pre-line;
        }
        .cash-flow-print .summary-grid {
            display: grid;
            gap: 7px;
            grid-template-columns: repeat(3, 1fr);
            margin-bottom: 8px;
        }
        .cash-flow-print .summary-card {
            border: 1px solid #d2d2d2;
            padding: 7px 8px;
        }
        .cash-flow-print .summary-card b {
            display: block;
            font-size: 6.2pt;
            text-transform: uppercase;
        }
        .cash-flow-print .summary-card span {
            display: block;
            font-size: 10pt;
            font-weight: 800;
            margin-top: 3px;
            text-align: right;
        }
        .cash-flow-print .summary-tables {
            display: grid;
            gap: 8px;
            grid-template-columns: 1fr 1fr;
            margin-bottom: 10px;
        }
        .cash-flow-print .summary-table-title {
            background: #e8e8e8 !important;
            border: 1px solid #d2d2d2;
            border-bottom: 0;
            font-size: 6.5pt;
            font-weight: 800;
            padding: 4px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .cash-flow-print .summary-table {
            font-size: 6.2pt;
            margin-bottom: 0;
        }
        .cash-flow-print .summary-table th {
            background: #3a3a3a !important;
        }
        .cash-flow-print .total-row td {
            background: #e8e8e8 !important;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .cash-flow-print .empty-row {
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

<div class="cr-stage cash-flow-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('account.partials.cash_flow_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if($page_index === 0): ?>
                <div class="summary-grid">
                    <div class="summary-card">
                        <b>Total Inflow</b>
                        <span><?php echo e(_cf_print_money($summary['inflow'] ?? 0, $decimal_separator, $thousand_separator), false); ?></span>
                    </div>
                    <div class="summary-card">
                        <b>Total Outflow</b>
                        <span><?php echo e(_cf_print_money($summary['outflow'] ?? 0, $decimal_separator, $thousand_separator), false); ?></span>
                    </div>
                    <div class="summary-card">
                        <b><?php echo e(__('lang_v1.net_cash_flows'), false); ?></b>
                        <span><?php echo e(_cf_print_money($summary['net'] ?? 0, $decimal_separator, $thousand_separator), false); ?></span>
                    </div>
                </div>

                <div class="summary-tables">
                    <div>
                        <div class="summary-table-title">Daily Closing Sheet</div>
                        <table class="summary-table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('lang_v1.description'), false); ?></th>
                                    <th><?php echo e(__('sale.total'), false); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $summary['categories'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($category['label'] ?? '', false); ?><br><small><?php echo e(_cf_direction_label($category['direction'] ?? ''), false); ?></small></td>
                                        <td class="text-right"><?php echo e(_cf_print_money($category['amount'] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="2" class="empty-row"><?php echo e(__('lang_v1.no_data'), false); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <div class="summary-table-title"><?php echo e(__('lang_v1.payment_method'), false); ?></div>
                        <table class="summary-table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('lang_v1.payment_method'), false); ?></th>
                                    <th class="text-right">In</th>
                                    <th class="text-right">Out</th>
                                    <th class="text-right"><?php echo e(__('lang_v1.net_cash_flows'), false); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $summary['methods'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($method['label'] ?? '', false); ?></td>
                                        <td class="text-right"><?php echo e(_cf_print_money($method['inflow'] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                        <td class="text-right"><?php echo e(_cf_print_money($method['outflow'] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                        <td class="text-right"><?php echo e(_cf_print_money($method['net'] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="empty-row"><?php echo e(__('lang_v1.no_data'), false); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <table>
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
                                        $is_money = ($column['type'] ?? '') === 'money';
                                        $is_multiline = in_array($key, ['description', 'payment_details']);
                                    ?>
                                    <td class="<?php echo e($is_money ? 'text-right amount-cell' : '', false); ?> <?php echo e($is_multiline ? 'pre-line' : '', false); ?>">
                                        <?php if($is_money): ?>
                                            <?php if($row[$key] === null || $row[$key] === ''): ?>
                                                &nbsp;
                                            <?php else: ?>
                                                <?php echo e(_cf_print_money($row[$key], $decimal_separator, $thousand_separator), false); ?>

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
                                <?php $is_money = ($column['type'] ?? '') === 'money'; ?>
                                <?php if($loop->first): ?>
                                    <td><?php echo e(__('sale.total'), false); ?></td>
                                <?php elseif(! empty($column['total']) && $is_money): ?>
                                    <td class="text-right"><?php echo e(_cf_print_money($totals[$column['key']] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
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
