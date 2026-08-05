<?php
    $show_stock_value_report_cost_value = $show_stock_value_report_cost_value ?? ! empty($show_value_columns);
    $show_stock_value_report_sale_value = $show_stock_value_report_sale_value ?? ! empty($show_value_columns);

    $format_qty = function ($unit_quantities) {
        if (empty($unit_quantities)) {
            return '0.00';
        }

        $parts = [];
        foreach ($unit_quantities as $unit => $qty) {
            $parts[] = trim(number_format((float) $qty, 2) . ' ' . $unit);
        }

        return implode(', ', $parts);
    };

    $format_value = function ($value) {
        return number_format((float) $value, session('business.cost_decimal', 2));
    };

    $column_count = 4
        + ($show_stock_value_report_cost_value ? 1 : 0)
        + 1 + ($show_stock_value_report_cost_value ? 1 : 0)
        + 1 + ($show_stock_value_report_cost_value ? 1 : 0)
        + ($show_manufacturing_data ? 2 + ($show_stock_value_report_cost_value ? 2 : 0) : 0)
        + ($show_stock_transfers ? 1 + ($show_stock_value_report_cost_value ? 1 : 0) : 0)
        + ($show_stock_adjustment ? 1 + ($show_stock_value_report_cost_value ? 1 : 0) : 0)
        + 1 + ($show_stock_value_report_sale_value ? 1 : 0)
        + 1 + ($show_stock_value_report_sale_value ? 1 : 0)
        + 1 + ($show_stock_value_report_cost_value ? 1 : 0);
?>

<table>
    <thead>
        <tr>
            <th colspan="<?php echo e($column_count, false); ?>" style="font-size:14px; font-weight:bold;">Stock Value Report - Locations</th>
        </tr>
        <tr><td colspan="<?php echo e($column_count, false); ?>"></td></tr>
        <tr style="font-weight:bold; background-color:#e8e8e8;">
            <td><?php echo app('translator')->get('sale.location'); ?></td>
            <td><?php echo app('translator')->get('product.products'); ?></td>
            <td><?php echo app('translator')->get('product.variations'); ?></td>
            <td><?php echo app('translator')->get('report.opening_stock'); ?></td>
            <?php if($show_stock_value_report_cost_value): ?><td><?php echo app('translator')->get('report.opening_stock_value'); ?> (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
            <td><?php echo app('translator')->get('purchase.purchase'); ?></td>
            <?php if($show_stock_value_report_cost_value): ?><td><?php echo app('translator')->get('purchase.purchase'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
            <td><?php echo app('translator')->get('purchase.purchase_return'); ?></td>
            <?php if($show_stock_value_report_cost_value): ?><td><?php echo app('translator')->get('purchase.purchase_return'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
            <?php if($show_manufacturing_data): ?>
                <td><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</td>
                <?php if($show_stock_value_report_cost_value): ?><td><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
                <td><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</td>
                <?php if($show_stock_value_report_cost_value): ?><td><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
            <?php endif; ?>
            <?php if($show_stock_transfers): ?>
                <td><?php echo app('translator')->get('lang_v1.stock_transfer'); ?></td>
                <?php if($show_stock_value_report_cost_value): ?><td><?php echo app('translator')->get('lang_v1.stock_transfer'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
            <?php endif; ?>
            <?php if($show_stock_adjustment): ?>
                <td><?php echo app('translator')->get('stock_adjustment.stock_adjustment'); ?></td>
                <?php if($show_stock_value_report_cost_value): ?><td><?php echo app('translator')->get('stock_adjustment.stock_adjustment'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
            <?php endif; ?>
            <td><?php echo app('translator')->get('sale.sale'); ?></td>
            <?php if($show_stock_value_report_sale_value): ?><td><?php echo app('translator')->get('sale.sale'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
            <td><?php echo app('translator')->get('sale.sale'); ?> <?php echo app('translator')->get('sale.return'); ?></td>
            <?php if($show_stock_value_report_sale_value): ?><td><?php echo app('translator')->get('sale.sale'); ?> <?php echo app('translator')->get('sale.return'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
            <td><?php echo app('translator')->get('report.current_stock'); ?></td>
            <?php if($show_stock_value_report_cost_value): ?><td><?php echo app('translator')->get('lang_v1.total_stock_price'); ?> (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($location['location_name'], false); ?></td>
                <td><?php echo e($location['product_count'], false); ?></td>
                <td><?php echo e($location['variation_count'], false); ?></td>
                <td><?php echo e($format_qty($location['quantities']['opening_stock']), false); ?></td>
                <?php if($show_stock_value_report_cost_value): ?><td><?php echo e($format_value($location['values']['opening_stock_value']), false); ?></td><?php endif; ?>
                <td><?php echo e($format_qty($location['quantities']['purchase']), false); ?></td>
                <?php if($show_stock_value_report_cost_value): ?><td><?php echo e($format_value($location['values']['purchase_value']), false); ?></td><?php endif; ?>
                <td><?php echo e($format_qty($location['quantities']['purchase_return']), false); ?></td>
                <?php if($show_stock_value_report_cost_value): ?><td><?php echo e($format_value($location['values']['purchase_return_value']), false); ?></td><?php endif; ?>
                <?php if($show_manufacturing_data): ?>
                    <td><?php echo e($format_qty($location['quantities']['manufacturing']), false); ?></td>
                    <?php if($show_stock_value_report_cost_value): ?><td><?php echo e($format_value($location['values']['manufacturing_value']), false); ?></td><?php endif; ?>
                    <td><?php echo e($format_qty($location['quantities']['ingredient']), false); ?></td>
                    <?php if($show_stock_value_report_cost_value): ?><td><?php echo e($format_value($location['values']['ingredient_value']), false); ?></td><?php endif; ?>
                <?php endif; ?>
                <?php if($show_stock_transfers): ?>
                    <td><?php echo e($format_qty($location['quantities']['stock_transfer']), false); ?></td>
                    <?php if($show_stock_value_report_cost_value): ?><td><?php echo e($format_value($location['values']['stock_transfer_value']), false); ?></td><?php endif; ?>
                <?php endif; ?>
                <?php if($show_stock_adjustment): ?>
                    <td><?php echo e($format_qty($location['quantities']['stock_adjustment']), false); ?></td>
                    <?php if($show_stock_value_report_cost_value): ?><td><?php echo e($format_value($location['values']['stock_adjustment_value']), false); ?></td><?php endif; ?>
                <?php endif; ?>
                <td><?php echo e($format_qty($location['quantities']['sales']), false); ?></td>
                <?php if($show_stock_value_report_sale_value): ?><td><?php echo e($format_value($location['values']['sales_value']), false); ?></td><?php endif; ?>
                <td><?php echo e($format_qty($location['quantities']['sales_return']), false); ?></td>
                <?php if($show_stock_value_report_sale_value): ?><td><?php echo e($format_value($location['values']['sales_return_value']), false); ?></td><?php endif; ?>
                <td><?php echo e($format_qty($location['quantities']['current_stock']), false); ?></td>
                <?php if($show_stock_value_report_cost_value): ?><td><?php echo e($format_value($location['values']['current_stock_value']), false); ?></td><?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    <tfoot>
        <tr style="font-weight:bold; background-color:#d9edf7;">
            <td><?php echo app('translator')->get('lang_v1.grand_total'); ?>:</td>
            <td><?php echo e($grand_product_count, false); ?></td>
            <td><?php echo e($grand_variation_count, false); ?></td>
            <td><?php echo e($format_qty($grand_quantities['opening_stock']), false); ?></td>
            <?php if($show_stock_value_report_cost_value): ?><td><?php echo e($format_value($grand_values['opening_stock_value']), false); ?></td><?php endif; ?>
            <td><?php echo e($format_qty($grand_quantities['purchase']), false); ?></td>
            <?php if($show_stock_value_report_cost_value): ?><td><?php echo e($format_value($grand_values['purchase_value']), false); ?></td><?php endif; ?>
            <td><?php echo e($format_qty($grand_quantities['purchase_return']), false); ?></td>
            <?php if($show_stock_value_report_cost_value): ?><td><?php echo e($format_value($grand_values['purchase_return_value']), false); ?></td><?php endif; ?>
            <?php if($show_manufacturing_data): ?>
                <td><?php echo e($format_qty($grand_quantities['manufacturing']), false); ?></td>
                <?php if($show_stock_value_report_cost_value): ?><td><?php echo e($format_value($grand_values['manufacturing_value']), false); ?></td><?php endif; ?>
                <td><?php echo e($format_qty($grand_quantities['ingredient']), false); ?></td>
                <?php if($show_stock_value_report_cost_value): ?><td><?php echo e($format_value($grand_values['ingredient_value']), false); ?></td><?php endif; ?>
            <?php endif; ?>
            <?php if($show_stock_transfers): ?>
                <td><?php echo e($format_qty($grand_quantities['stock_transfer']), false); ?></td>
                <?php if($show_stock_value_report_cost_value): ?><td><?php echo e($format_value($grand_values['stock_transfer_value']), false); ?></td><?php endif; ?>
            <?php endif; ?>
            <?php if($show_stock_adjustment): ?>
                <td><?php echo e($format_qty($grand_quantities['stock_adjustment']), false); ?></td>
                <?php if($show_stock_value_report_cost_value): ?><td><?php echo e($format_value($grand_values['stock_adjustment_value']), false); ?></td><?php endif; ?>
            <?php endif; ?>
            <td><?php echo e($format_qty($grand_quantities['sales']), false); ?></td>
            <?php if($show_stock_value_report_sale_value): ?><td><?php echo e($format_value($grand_values['sales_value']), false); ?></td><?php endif; ?>
            <td><?php echo e($format_qty($grand_quantities['sales_return']), false); ?></td>
            <?php if($show_stock_value_report_sale_value): ?><td><?php echo e($format_value($grand_values['sales_return_value']), false); ?></td><?php endif; ?>
            <td><?php echo e($format_qty($grand_quantities['current_stock']), false); ?></td>
            <?php if($show_stock_value_report_cost_value): ?><td><?php echo e($format_value($grand_values['current_stock_value']), false); ?></td><?php endif; ?>
        </tr>
    </tfoot>
</table>
