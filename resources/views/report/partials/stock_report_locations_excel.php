<?php
    $show_stock_report_cost_value = ! empty($show_stock_report_cost_value);
    $show_stock_report_sale_value = ! empty($show_stock_report_sale_value);
    $show_stock_report_potential_profit = ! empty($show_stock_report_potential_profit);
    $show_value_columns = $show_stock_report_cost_value || $show_stock_report_sale_value || $show_stock_report_potential_profit;
    $symbol = $currency_symbol ?? (session('currency')['symbol'] ?? '');
    $value_precision = session('business.cost_decimal', session('business.currency_precision', 2));

    if (! function_exists('_srl_excel_qty')) {
        function _srl_excel_qty($value) {
            return number_format((float) $value, 2);
        }
    }

    if (! function_exists('_srl_excel_value')) {
        function _srl_excel_value($value, $precision) {
            return number_format((float) $value, $precision);
        }
    }

    $colspan = 4
        + ($show_stock_report_cost_value ? 1 : 0)
        + ($show_stock_report_sale_value ? 1 : 0)
        + ($show_stock_report_potential_profit ? 1 : 0);
?>

<table>
    <thead>
        <tr>
            <th colspan="<?php echo e($colspan, false); ?>">
                <?php echo e($business_name, false); ?> - <?php echo e(__('report.stock_report'), false); ?> (Locations) - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?>

            </th>
        </tr>
        <tr>
            <th><?php echo e(__('sale.location'), false); ?></th>
            <th><?php echo e(__('product.products'), false); ?></th>
            <th><?php echo e(__('product.variations'), false); ?></th>
            <th>Quantity Summary</th>
            <?php if($show_stock_report_cost_value): ?>
                <th><?php echo e(__('lang_v1.total_stock_price'), false); ?> (<?php echo e(__('lang_v1.by_purchase_price'), false); ?>)</th>
            <?php endif; ?>
            <?php if($show_stock_report_sale_value): ?>
                <th><?php echo e(__('lang_v1.total_stock_price'), false); ?> (<?php echo e(__('lang_v1.by_sale_price'), false); ?>)</th>
            <?php endif; ?>
            <?php if($show_stock_report_potential_profit): ?>
                <th><?php echo e(__('lang_v1.potential_profit'), false); ?></th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($location['location_name'], false); ?></td>
                <td><?php echo e($location['product_count'], false); ?></td>
                <td><?php echo e($location['variation_count'], false); ?></td>
                <td>
                    <?php $__currentLoopData = $location['unit_quantities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit => $qty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e(_srl_excel_qty($qty), false); ?> <?php echo e($unit, false); ?><?php if(!$loop->last): ?>, <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <?php if($show_stock_report_cost_value): ?>
                    <td><?php echo e($symbol, false); ?> <?php echo e(_srl_excel_value($location['total_purchase_value'], $value_precision), false); ?></td>
                <?php endif; ?>
                <?php if($show_stock_report_sale_value): ?>
                    <td><?php echo e($symbol, false); ?> <?php echo e(_srl_excel_value($location['total_sale_value'], $value_precision), false); ?></td>
                <?php endif; ?>
                <?php if($show_stock_report_potential_profit): ?>
                    <td><?php echo e($symbol, false); ?> <?php echo e(_srl_excel_value($location['potential_profit'], $value_precision), false); ?></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="<?php echo e($colspan, false); ?>"><?php echo e(__('lang_v1.no_data_available'), false); ?></td>
            </tr>
        <?php endif; ?>
    </tbody>
    <?php if(! empty($locations)): ?>
        <tfoot>
            <tr>
                <td><?php echo e(__('lang_v1.grand_total'), false); ?></td>
                <td><?php echo e($grand_product_count, false); ?></td>
                <td><?php echo e($grand_variation_count, false); ?></td>
                <td>
                    <?php $__currentLoopData = $grand_unit_quantities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit => $qty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e(_srl_excel_qty($qty), false); ?> <?php echo e($unit, false); ?><?php if(!$loop->last): ?>, <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <?php if($show_stock_report_cost_value): ?>
                    <td><?php echo e($symbol, false); ?> <?php echo e(_srl_excel_value($grand_total_purchase_value, $value_precision), false); ?></td>
                <?php endif; ?>
                <?php if($show_stock_report_sale_value): ?>
                    <td><?php echo e($symbol, false); ?> <?php echo e(_srl_excel_value($grand_total_sale_value, $value_precision), false); ?></td>
                <?php endif; ?>
                <?php if($show_stock_report_potential_profit): ?>
                    <td><?php echo e($symbol, false); ?> <?php echo e(_srl_excel_value($grand_potential_profit, $value_precision), false); ?></td>
                <?php endif; ?>
            </tr>
        </tfoot>
    <?php endif; ?>
</table>
