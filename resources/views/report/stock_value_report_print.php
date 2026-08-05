<?php
    $is_pdf = ! empty($is_pdf);
    $tab = $tab ?? 'details';
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/stock-value-report-print');
    $report_title = $report_title ?? __('report.stock_value_report');
    $currency_symbol = $currency_symbol ?? '';
    $show_manufacturing_data = ! empty($show_manufacturing_data);
    $show_stock_transfers = ! empty($show_stock_transfers);
    $show_stock_adjustment = ! empty($show_stock_adjustment);
    $show_value_columns = ! empty($show_value_columns);
    $show_stock_value_report_cost_value = $show_stock_value_report_cost_value ?? $show_value_columns;
    $show_stock_value_report_sale_value = $show_stock_value_report_sale_value ?? $show_value_columns;
    $show_variation_column = $show_variation_column ?? true;
    if ($tab === 'details') {
        $total_pages = count($row_pages ?? [[]]);
    } elseif ($tab === 'categorized') {
        $total_pages = count($categorized_pages ?? [[]]);
    } elseif ($tab === 'location_details') {
        $total_pages = count($location_detail_pages ?? [[]]);
    } else {
        $total_pages = $total_pages ?? 1;
    }
    $qty_precision = session('business.quantity_precision', 2);
    $value_precision = session('business.cost_decimal', session('business.currency_precision', 2));
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';

    if (! function_exists('_sv_print_qty')) {
        function _sv_print_qty($value, $precision, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, $precision, $decimal_separator, $thousand_separator);
        }
    }

    if (! function_exists('_sv_print_value')) {
        function _sv_print_value($value, $precision, $decimal_separator, $thousand_separator) {
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

        .sv-print .table-responsive { overflow: visible !important; }
        .sv-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 5.8pt;
        }
        .sv-print th,
        .sv-print td {
            border: 1px solid #d2d2d2;
            padding: 3px;
            line-height: 1.15;
            vertical-align: top;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .sv-print th,
        .sv-print thead td,
        .sv-print .bg-light-gray {
            background: #1a1a1a !important;
            color: #fff !important;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sv-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sv-print tfoot td,
        .sv-print .font-weight-bold td {
            background: #e8e8e8 !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sv-print .bg-danger td,
        .sv-print tr.bg-danger td {
            background: #fde8e8 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sv-print .text-right { text-align: right; }
        .sv-print .text-center { text-align: center; }
        .sv-print .card,
        .sv-print .card-body,
        .sv-print .card-header {
            border: 0;
            box-shadow: none;
        }
        .sv-print .card-header,
        .sv-print .cr-group-title {
            margin-top: 8px;
            background: #1a1a1a !important;
            color: #fff !important;
            padding: 5px 8px !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sv-print h4,
        .sv-print h5 {
            margin: 0;
            font-size: 8pt !important;
            color: inherit;
        }
        .sv-print .pagination,
        .sv-print label select {
            display: none !important;
        }
        .sv-print .sv-detail-table th {
            font-size: 5.2pt;
        }
        .sv-print .sv-detail-table td {
            font-size: 5.6pt;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage sv-print" id="crStage">
    <?php if($tab === 'details'): ?>
        <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
                <?php echo $__env->make('report.partials.stock_value_report_print_header', ['page_label' => ($page_index + 1).' / '.$total_pages], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php if(empty($page_rows)): ?>
                    <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
                <?php else: ?>
                    <table class="sv-detail-table">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th><?php echo e(__('business.product'), false); ?></th>
                                <th><?php echo e(__('product.unit'), false); ?></th>
                                <?php if($show_variation_column): ?>
                                <th><?php echo e(__('lang_v1.variation'), false); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('sale.location'), false); ?></th>
                                <th class="text-right"><?php echo e(__('report.opening_stock'), false); ?></th>
                                <?php if($show_stock_value_report_cost_value): ?><th class="text-right"><?php echo e(__('report.opening_stock_value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <th class="text-right"><?php echo e(__('purchase.purchase'), false); ?></th>
                                <?php if($show_stock_value_report_cost_value): ?><th class="text-right"><?php echo e(__('purchase.purchase'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <th class="text-right"><?php echo e(__('purchase.purchase_return'), false); ?></th>
                                <?php if($show_stock_value_report_cost_value): ?><th class="text-right"><?php echo e(__('purchase.purchase_return'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <?php if($show_manufacturing_data): ?>
                                    <th class="text-right"><?php echo e(__('manufacturing::lang.manufacturing'), false); ?> (<?php echo e(__('lang_v1.in'), false); ?>)</th>
                                    <?php if($show_stock_value_report_cost_value): ?><th class="text-right"><?php echo e(__('manufacturing::lang.manufacturing'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                    <th class="text-right"><?php echo e(__('manufacturing::lang.ingredients'), false); ?> (<?php echo e(__('lang_v1.out'), false); ?>)</th>
                                    <?php if($show_stock_value_report_cost_value): ?><th class="text-right"><?php echo e(__('manufacturing::lang.ingredients'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <?php endif; ?>
                                <?php if($show_stock_transfers): ?>
                                    <th class="text-right"><?php echo e(__('lang_v1.stock_transfer'), false); ?></th>
                                    <?php if($show_stock_value_report_cost_value): ?><th class="text-right"><?php echo e(__('lang_v1.stock_transfer'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <?php endif; ?>
                                <?php if($show_stock_adjustment): ?>
                                    <th class="text-right"><?php echo e(__('stock_adjustment.stock_adjustment'), false); ?></th>
                                    <?php if($show_stock_value_report_cost_value): ?><th class="text-right"><?php echo e(__('stock_adjustment.stock_adjustment'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <?php endif; ?>
                                <th class="text-right"><?php echo e(__('sale.sale'), false); ?></th>
                                <?php if($show_stock_value_report_sale_value): ?><th class="text-right"><?php echo e(__('sale.sale'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <th class="text-right"><?php echo e(__('sale.sale'), false); ?> <?php echo e(__('sale.return'), false); ?></th>
                                <?php if($show_stock_value_report_sale_value): ?><th class="text-right"><?php echo e(__('sale.sale'), false); ?> <?php echo e(__('sale.return'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <th class="text-right"><?php echo e(__('report.current_stock'), false); ?></th>
                                <?php if($show_stock_value_report_cost_value): ?><th class="text-right"><?php echo e(__('lang_v1.total_stock_price'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo e(! empty($row['is_low_stock']) ? 'bg-danger' : '', false); ?>">
                                    <td><?php echo e($row['sku'], false); ?></td>
                                    <td><?php echo e($row['product_name'], false); ?></td>
                                    <td><?php echo e($row['unit'], false); ?></td>
                                    <?php if($show_variation_column): ?>
                                    <td><?php echo e($row['variation'], false); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e($row['location_name'], false); ?></td>
                                    <td class="text-right"><?php echo e(_sv_print_qty($row['opening_stock'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e(_sv_print_value($row['opening_stock_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <td class="text-right"><?php echo e(_sv_print_qty($row['purchase'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e(_sv_print_value($row['purchase_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <td class="text-right"><?php echo e(_sv_print_qty($row['purchase_return'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e(_sv_print_value($row['purchase_return_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php if($show_manufacturing_data): ?>
                                        <td class="text-right"><?php echo e(_sv_print_qty($row['manufacturing'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                        <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e(_sv_print_value($row['manufacturing_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                        <td class="text-right"><?php echo e(_sv_print_qty($row['ingredient'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                        <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e(_sv_print_value($row['ingredient_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php endif; ?>
                                    <?php if($show_stock_transfers): ?>
                                        <td class="text-right"><?php echo e(_sv_print_qty($row['stock_transfer'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                        <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e(_sv_print_value($row['stock_transfer_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php endif; ?>
                                    <?php if($show_stock_adjustment): ?>
                                        <td class="text-right"><?php echo e(_sv_print_qty($row['stock_adjustment'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                        <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e(_sv_print_value($row['stock_adjustment_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php endif; ?>
                                    <td class="text-right"><?php echo e(_sv_print_qty($row['sales'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_value_report_sale_value): ?><td class="text-right"><?php echo e(_sv_print_value($row['sales_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <td class="text-right"><?php echo e(_sv_print_qty($row['sales_return'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_value_report_sale_value): ?><td class="text-right"><?php echo e(_sv_print_value($row['sales_return_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <td class="text-right"><?php echo e(_sv_print_qty($row['current_stock'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e(_sv_print_value($row['current_stock_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <?php if($page_index === $total_pages - 1): ?>
                            <tfoot>
                                <tr>
                                    <td colspan="<?php echo e($show_variation_column ? 5 : 4, false); ?>" class="text-right"><?php echo e(__('sale.total'), false); ?>:</td>
                                    <td class="text-right"><?php echo e(_sv_print_qty($grand_totals['opening_stock'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e(_sv_print_value($grand_totals['opening_stock_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <td class="text-right"><?php echo e(_sv_print_qty($grand_totals['purchase'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e(_sv_print_value($grand_totals['purchase_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <td class="text-right"><?php echo e(_sv_print_qty($grand_totals['purchase_return'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e(_sv_print_value($grand_totals['purchase_return_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php if($show_manufacturing_data): ?>
                                        <td class="text-right"><?php echo e(_sv_print_qty($grand_totals['manufacturing'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                        <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e(_sv_print_value($grand_totals['manufacturing_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                        <td class="text-right"><?php echo e(_sv_print_qty($grand_totals['ingredient'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                        <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e(_sv_print_value($grand_totals['ingredient_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php endif; ?>
                                    <?php if($show_stock_transfers): ?>
                                        <td class="text-right"><?php echo e(_sv_print_qty($grand_totals['stock_transfer'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                        <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e(_sv_print_value($grand_totals['stock_transfer_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php endif; ?>
                                    <?php if($show_stock_adjustment): ?>
                                        <td class="text-right"><?php echo e(_sv_print_qty($grand_totals['stock_adjustment'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                        <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e(_sv_print_value($grand_totals['stock_adjustment_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <?php endif; ?>
                                    <td class="text-right"><?php echo e(_sv_print_qty($grand_totals['sales'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_value_report_sale_value): ?><td class="text-right"><?php echo e(_sv_print_value($grand_totals['sales_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <td class="text-right"><?php echo e(_sv_print_qty($grand_totals['sales_return'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_value_report_sale_value): ?><td class="text-right"><?php echo e(_sv_print_value($grand_totals['sales_return_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                    <td class="text-right"><?php echo e(_sv_print_qty($grand_totals['current_stock'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e(_sv_print_value($grand_totals['current_stock_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                <?php endif; ?>

                <div class="cr-foot">
                    <span><?php echo e($business_name, false); ?> - <?php echo e(__('report.stock_value_report'), false); ?></span>
                    <span><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> <?php echo e($page_index + 1, false); ?> / <?php echo e($total_pages, false); ?></span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php elseif($tab === 'categorized'): ?>
        <?php $__currentLoopData = $categorized_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $categorized_page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
                <?php echo $__env->make('report.partials.stock_value_report_print_header', ['page_label' => ($page_index + 1).' / '.$total_pages], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php echo $__env->make('report.partials.stock_value_categorized_print_page', ['categorized_print_page' => $categorized_page], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="cr-foot">
                    <span><?php echo e($business_name, false); ?> - <?php echo e(__('report.stock_value_report'), false); ?></span>
                    <span><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> <?php echo e($page_index + 1, false); ?> / <?php echo e($total_pages, false); ?></span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php elseif($tab === 'location_details'): ?>
        <?php $__currentLoopData = $location_detail_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $detail_page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
                <?php echo $__env->make('report.partials.stock_value_report_print_header', ['page_label' => ($page_index + 1).' / '.$total_pages], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php echo $__env->make('report.partials.stock_value_location_details_print_page', ['detail_page' => $detail_page], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="cr-foot">
                    <span><?php echo e($business_name, false); ?> - <?php echo e(__('report.stock_value_report'), false); ?></span>
                    <span><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> <?php echo e($page_index + 1, false); ?> / <?php echo e($total_pages, false); ?></span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="cr-sheet" id="crPage1">
            <?php echo $__env->make('report.partials.stock_value_report_print_header', ['page_label' => '1 / 1'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if($tab === 'locations'): ?>
                <?php echo $__env->make('report.partials.stock_value_locations_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - <?php echo e(__('report.stock_value_report'), false); ?></span>
                <span><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> 1 / 1</span>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</body>
</html>
