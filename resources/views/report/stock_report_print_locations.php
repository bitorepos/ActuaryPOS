<?php
    $locations = $locations ?? [];
    $show_stock_report_cost_value = ! empty($show_stock_report_cost_value);
    $show_stock_report_sale_value = ! empty($show_stock_report_sale_value);
    $show_stock_report_potential_profit = ! empty($show_stock_report_potential_profit);
    $show_value_columns = $show_stock_report_cost_value || $show_stock_report_sale_value || $show_stock_report_potential_profit;
    $symbol = $currency_symbol ?? (session('currency')['symbol'] ?? '');
    $qty_precision = session('business.quantity_precision', 2);
    $value_precision = session('business.cost_decimal', session('business.currency_precision', 2));
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';

    if (! function_exists('_srl_qty')) {
        function _srl_qty($value, $precision, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, $precision, $decimal_separator, $thousand_separator);
        }
    }

    if (! function_exists('_srl_value')) {
        function _srl_value($value, $precision, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, $precision, $decimal_separator, $thousand_separator);
        }
    }

    $rows_per_page = 24;
    $location_pages = array_chunk($locations, $rows_per_page, true);
    if (empty($location_pages)) {
        $location_pages = [[]];
    }

    $total_pages = count($location_pages);
    $orientation = $orientation ?? ($show_value_columns ? 'landscape' : 'portrait');
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $report_title = 'Stock Report - Locations';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($report_title, false); ?></title>
    <?php echo $__env->make('report.partials.crystal_report_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="cr-stage" id="crStage">
    <?php $__currentLoopData = $location_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_locations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <div class="cr-head">
                <div class="cr-head-left">
                    <?php if(! empty($logo)): ?>
                        <img src="<?php echo e($logo, false); ?>" class="cr-logo" alt="logo">
                    <?php endif; ?>
                    <div>
                        <div class="cr-biz-name"><?php echo e($business_name, false); ?></div>
                        <div class="cr-biz-loc"><?php echo e($location_name, false); ?></div>
                    </div>
                </div>
                <div class="cr-head-right">
                    <div class="cr-report-title">Stock Report</div>
                    <div class="cr-report-sub">Locations - Generated: <?php echo e($generated_at, false); ?></div>
                </div>
            </div>

            <?php if(! empty($filters_summary)): ?>
                <div class="cr-filters">
                    <?php $__currentLoopData = $filters_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            if (is_array($value)) {
                                $label = $value['label'] ?? $label;
                                $value = $value['value'] ?? '';
                            }
                        ?>
                        <span class="f-item"><b><?php echo e($label, false); ?>:</b> <?php echo e($value, false); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <div class="cr-group-title">Location-wise Stock Summary</div>

            <?php if(empty($page_locations)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_data_available'), false); ?></div>
            <?php else: ?>
                <table class="cr-table">
                    <thead>
                        <tr>
                            <th><?php echo e(__('sale.location'), false); ?></th>
                            <th class="r"><?php echo e(__('product.products'), false); ?></th>
                            <th class="r"><?php echo e(__('product.variations'), false); ?></th>
                            <th>Quantity Summary</th>
                            <?php if($show_stock_report_cost_value): ?>
                                <th class="r"><?php echo e(__('lang_v1.total_stock_price'), false); ?><br><small>(<?php echo e(__('lang_v1.by_purchase_price'), false); ?>)</small></th>
                            <?php endif; ?>
                            <?php if($show_stock_report_sale_value): ?>
                                <th class="r"><?php echo e(__('lang_v1.total_stock_price'), false); ?><br><small>(<?php echo e(__('lang_v1.by_sale_price'), false); ?>)</small></th>
                            <?php endif; ?>
                            <?php if($show_stock_report_potential_profit): ?>
                                <th class="r"><?php echo e(__('lang_v1.potential_profit'), false); ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $page_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="cr-prod-name"><?php echo e($location['location_name'], false); ?></td>
                                <td class="r"><?php echo e($location['product_count'], false); ?></td>
                                <td class="r"><?php echo e($location['variation_count'], false); ?></td>
                                <td>
                                    <?php $__currentLoopData = $location['unit_quantities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit => $qty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="cr-qty-chip"><?php echo e(_srl_qty($qty, $qty_precision, $decimal_separator, $thousand_separator), false); ?> <?php echo e($unit, false); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <?php if($show_stock_report_cost_value): ?>
                                    <td class="r"><?php echo e($symbol, false); ?> <?php echo e(_srl_value($location['total_purchase_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <?php endif; ?>
                                <?php if($show_stock_report_sale_value): ?>
                                    <td class="r"><?php echo e($symbol, false); ?> <?php echo e(_srl_value($location['total_sale_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <?php endif; ?>
                                <?php if($show_stock_report_potential_profit): ?>
                                    <td class="r"><?php echo e($symbol, false); ?> <?php echo e(_srl_value($location['potential_profit'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <?php if($page_index === $total_pages - 1): ?>
                        <tfoot>
                            <tr>
                                <td class="r"><?php echo e(__('lang_v1.grand_total'), false); ?>:</td>
                                <td class="r"><?php echo e($grand_product_count, false); ?></td>
                                <td class="r"><?php echo e($grand_variation_count, false); ?></td>
                                <td>
                                    <?php $__currentLoopData = $grand_unit_quantities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit => $qty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="cr-qty-chip"><?php echo e(_srl_qty($qty, $qty_precision, $decimal_separator, $thousand_separator), false); ?> <?php echo e($unit, false); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <?php if($show_stock_report_cost_value): ?>
                                    <td class="r"><?php echo e($symbol, false); ?> <?php echo e(_srl_value($grand_total_purchase_value, $value_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <?php endif; ?>
                                <?php if($show_stock_report_sale_value): ?>
                                    <td class="r"><?php echo e($symbol, false); ?> <?php echo e(_srl_value($grand_total_sale_value, $value_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <?php endif; ?>
                                <?php if($show_stock_report_potential_profit): ?>
                                    <td class="r"><?php echo e($symbol, false); ?> <?php echo e(_srl_value($grand_potential_profit, $value_precision, $decimal_separator, $thousand_separator), false); ?></td>
                                <?php endif; ?>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            <?php endif; ?>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - Stock Report (Locations)</span>
                <span>Page <?php echo e($page_index + 1, false); ?> of <?php echo e($total_pages, false); ?></span>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php echo $__env->make('report.partials.crystal_report_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
