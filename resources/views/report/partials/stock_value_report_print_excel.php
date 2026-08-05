<?php
    $show_manufacturing_data = ! empty($show_manufacturing_data);
    $show_stock_transfers = ! empty($show_stock_transfers);
    $show_stock_adjustment = ! empty($show_stock_adjustment);
    $show_value_columns = ! empty($show_value_columns);
    $show_stock_value_report_cost_value = $show_stock_value_report_cost_value ?? $show_value_columns;
    $show_stock_value_report_sale_value = $show_stock_value_report_sale_value ?? $show_value_columns;
    $show_variation_column = $show_variation_column ?? true;
    $currency_symbol = $currency_symbol ?? '';
    $text_colspan = $show_variation_column ? 5 : 4;
    $column_count = $text_colspan
        + 6
        + ($show_stock_value_report_cost_value ? 4 : 0)
        + ($show_stock_value_report_sale_value ? 2 : 0);
    if ($show_manufacturing_data) {
        $column_count += 2 + ($show_stock_value_report_cost_value ? 2 : 0);
    }
    if ($show_stock_transfers) {
        $column_count += 1 + ($show_stock_value_report_cost_value ? 1 : 0);
    }
    if ($show_stock_adjustment) {
        $column_count += 1 + ($show_stock_value_report_cost_value ? 1 : 0);
    }
?>

<table>
    <thead>
        <tr>
            <th colspan="<?php echo e($column_count, false); ?>"><?php echo e($business_name, false); ?> - <?php echo e(__('report.stock_value_report'), false); ?> (<?php echo e($location_name, false); ?>) - <?php echo e($generated_at, false); ?></th>
        </tr>
        <tr>
            <th>SKU</th>
            <th><?php echo e(__('business.product'), false); ?></th>
            <th><?php echo e(__('product.unit'), false); ?></th>
            <?php if($show_variation_column): ?>
            <th><?php echo e(__('lang_v1.variation'), false); ?></th>
            <?php endif; ?>
            <th><?php echo e(__('sale.location'), false); ?></th>
            <th><?php echo e(__('report.opening_stock'), false); ?></th>
            <?php if($show_stock_value_report_cost_value): ?><th><?php echo e(__('report.opening_stock_value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
            <th><?php echo e(__('purchase.purchase'), false); ?></th>
            <?php if($show_stock_value_report_cost_value): ?><th><?php echo e(__('purchase.purchase'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
            <th><?php echo e(__('purchase.purchase_return'), false); ?></th>
            <?php if($show_stock_value_report_cost_value): ?><th><?php echo e(__('purchase.purchase_return'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
            <?php if($show_manufacturing_data): ?>
                <th><?php echo e(__('manufacturing::lang.manufacturing'), false); ?> (<?php echo e(__('lang_v1.in'), false); ?>)</th>
                <?php if($show_stock_value_report_cost_value): ?><th><?php echo e(__('manufacturing::lang.manufacturing'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                <th><?php echo e(__('manufacturing::lang.ingredients'), false); ?> (<?php echo e(__('lang_v1.out'), false); ?>)</th>
                <?php if($show_stock_value_report_cost_value): ?><th><?php echo e(__('manufacturing::lang.ingredients'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
            <?php endif; ?>
            <?php if($show_stock_transfers): ?>
                <th><?php echo e(__('lang_v1.stock_transfer'), false); ?></th>
                <?php if($show_stock_value_report_cost_value): ?><th><?php echo e(__('lang_v1.stock_transfer'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
            <?php endif; ?>
            <?php if($show_stock_adjustment): ?>
                <th><?php echo e(__('stock_adjustment.stock_adjustment'), false); ?></th>
                <?php if($show_stock_value_report_cost_value): ?><th><?php echo e(__('stock_adjustment.stock_adjustment'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
            <?php endif; ?>
            <th><?php echo e(__('sale.sale'), false); ?></th>
            <?php if($show_stock_value_report_sale_value): ?><th><?php echo e(__('sale.sale'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
            <th><?php echo e(__('sale.sale'), false); ?> <?php echo e(__('sale.return'), false); ?></th>
            <?php if($show_stock_value_report_sale_value): ?><th><?php echo e(__('sale.sale'), false); ?> <?php echo e(__('sale.return'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
            <th><?php echo e(__('report.current_stock'), false); ?></th>
            <?php if($show_stock_value_report_cost_value): ?><th><?php echo e(__('lang_v1.total_stock_price'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($row['sku'], false); ?></td>
                <td><?php echo e($row['product_name'], false); ?></td>
                <td><?php echo e($row['unit'], false); ?></td>
                <?php if($show_variation_column): ?>
                <td><?php echo e($row['variation'], false); ?></td>
                <?php endif; ?>
                <td><?php echo e($row['location_name'], false); ?></td>
                <td><?php echo e(round($row['opening_stock'], 2), false); ?></td>
                <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(round($row['opening_stock_value'], 2), false); ?></td><?php endif; ?>
                <td><?php echo e(round($row['purchase'], 2), false); ?></td>
                <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(round($row['purchase_value'], 2), false); ?></td><?php endif; ?>
                <td><?php echo e(round($row['purchase_return'], 2), false); ?></td>
                <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(round($row['purchase_return_value'], 2), false); ?></td><?php endif; ?>
                <?php if($show_manufacturing_data): ?>
                    <td><?php echo e(round($row['manufacturing'], 2), false); ?></td>
                    <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(round($row['manufacturing_value'], 2), false); ?></td><?php endif; ?>
                    <td><?php echo e(round($row['ingredient'], 2), false); ?></td>
                    <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(round($row['ingredient_value'], 2), false); ?></td><?php endif; ?>
                <?php endif; ?>
                <?php if($show_stock_transfers): ?>
                    <td><?php echo e(round($row['stock_transfer'], 2), false); ?></td>
                    <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(round($row['stock_transfer_value'], 2), false); ?></td><?php endif; ?>
                <?php endif; ?>
                <?php if($show_stock_adjustment): ?>
                    <td><?php echo e(round($row['stock_adjustment'], 2), false); ?></td>
                    <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(round($row['stock_adjustment_value'], 2), false); ?></td><?php endif; ?>
                <?php endif; ?>
                <td><?php echo e(round($row['sales'], 2), false); ?></td>
                <?php if($show_stock_value_report_sale_value): ?><td><?php echo e(round($row['sales_value'], 2), false); ?></td><?php endif; ?>
                <td><?php echo e(round($row['sales_return'], 2), false); ?></td>
                <?php if($show_stock_value_report_sale_value): ?><td><?php echo e(round($row['sales_return_value'], 2), false); ?></td><?php endif; ?>
                <td><?php echo e(round($row['current_stock'], 2), false); ?></td>
                <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(round($row['current_stock_value'], 2), false); ?></td><?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
