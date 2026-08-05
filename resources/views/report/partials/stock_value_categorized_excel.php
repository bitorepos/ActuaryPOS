<?php
    $show_manufacturing_data = ! empty($show_manufacturing_data);
    $show_variation_column = $show_variation_column ?? true;
    $show_stock_transfers = in_array('stock_transfers', session('business.enabled_modules', []));
    $show_stock_adjustment = in_array('stock_adjustment', session('business.enabled_modules', []));
    $show_stock_value_report_cost_value = $show_stock_value_report_cost_value ?? ! empty($show_value_columns);
    $show_stock_value_report_sale_value = $show_stock_value_report_sale_value ?? ! empty($show_value_columns);
    $text_colspan = $show_variation_column ? 5 : 4;
    $column_count = $text_colspan
        + 6
        + ($show_stock_value_report_cost_value ? 4 : 0)
        + ($show_stock_value_report_sale_value ? 2 : 0)
        + ($show_manufacturing_data ? 2 + ($show_stock_value_report_cost_value ? 2 : 0) : 0)
        + ($show_stock_transfers ? 1 + ($show_stock_value_report_cost_value ? 1 : 0) : 0)
        + ($show_stock_adjustment ? 1 + ($show_stock_value_report_cost_value ? 1 : 0) : 0);
?>
<table>
    <thead>
        <tr>
            <th colspan="<?php echo e($column_count, false); ?>" style="font-size:14px; font-weight:bold;">Stock Value Report - Categorized</th>
        </tr>
        <tr><td colspan="<?php echo e($column_count, false); ?>"></td></tr>
    </thead>
</table>
<?php $__currentLoopData = $categorized; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_name => $sub_categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<table>
    <tr>
        <td colspan="<?php echo e($column_count, false); ?>" style="background-color:#3c8dbc; color:#ffffff; font-weight:bold; font-size:13px;"><?php echo e($category_name, false); ?></td>
    </tr>
</table>
<?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category_name => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<table>
    <tr>
        <td colspan="<?php echo e($column_count, false); ?>" style="background-color:#f0f0f0; font-weight:bold;"><?php echo e($sub_category_name, false); ?></td>
    </tr>
    <tr style="font-weight:bold; background-color:#e8e8e8;">
        <td>SKU</td>
        <td><?php echo app('translator')->get('business.product'); ?></td>
        <td><?php echo app('translator')->get('product.unit'); ?></td>
        <?php if($show_variation_column): ?>
        <td><?php echo app('translator')->get('lang_v1.variation'); ?></td>
        <?php endif; ?>
        <td><?php echo app('translator')->get('sale.location'); ?></td>
        <td><?php echo app('translator')->get('report.opening_stock'); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td>Opening Stock Value (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
        <td><?php echo app('translator')->get('purchase.purchase'); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td>Purchase Value (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
        <td><?php echo app('translator')->get('purchase.purchase_return'); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td>Purchase Return Value (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
        <?php if($show_manufacturing_data): ?>
        <td><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
        <td><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
        <?php endif; ?>
        <?php if($show_stock_transfers): ?>
        <td><?php echo app('translator')->get('lang_v1.stock_transfer'); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td>Stock Transfer Value (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
        <?php endif; ?>
        <?php if($show_stock_adjustment): ?>
        <td><?php echo app('translator')->get('stock_adjustment.stock_adjustment'); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td>Stock Adjustment Value (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
        <?php endif; ?>
        <td><?php echo app('translator')->get('sale.sale'); ?></td>
        <?php if($show_stock_value_report_sale_value): ?><td>Sales Value (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
        <td>Sales Return</td>
        <?php if($show_stock_value_report_sale_value): ?><td>Sales Return Value (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
        <td><?php echo app('translator')->get('report.current_stock'); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td>Current Stock Value (<?php echo e($currency_symbol, false); ?>)</td><?php endif; ?>
    </tr>
    <?php $__currentLoopData = $data['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($product['sku'], false); ?></td>
        <td><?php echo e($product['product_name'], false); ?></td>
        <td><?php echo e($product['unit'], false); ?></td>
        <?php if($show_variation_column): ?>
        <td><?php echo e($product['variation'], false); ?></td>
        <?php endif; ?>
        <td><?php echo e($product['location_name'], false); ?></td>
        <td><?php echo e(number_format($product['opening_stock'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($product['opening_stock_value'], 2), false); ?></td><?php endif; ?>
        <td><?php echo e(number_format($product['purchase'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($product['purchase_value'], 2), false); ?></td><?php endif; ?>
        <td><?php echo e(number_format($product['purchase_return'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($product['purchase_return_value'], 2), false); ?></td><?php endif; ?>
        <?php if($show_manufacturing_data): ?>
        <td><?php echo e(number_format($product['manufacturing'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($product['manufacturing_value'], 2), false); ?></td><?php endif; ?>
        <td><?php echo e(number_format($product['ingredient'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($product['ingredient_value'], 2), false); ?></td><?php endif; ?>
        <?php endif; ?>
        <?php if($show_stock_transfers): ?>
        <td><?php echo e(number_format($product['stock_transfer'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($product['stock_transfer_value'], 2), false); ?></td><?php endif; ?>
        <?php endif; ?>
        <?php if($show_stock_adjustment): ?>
        <td><?php echo e(number_format($product['stock_adjustment'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($product['stock_adjustment_value'], 2), false); ?></td><?php endif; ?>
        <?php endif; ?>
        <td><?php echo e(number_format($product['sales'], 2), false); ?></td>
        <?php if($show_stock_value_report_sale_value): ?><td><?php echo e(number_format($product['sales_value'], 2), false); ?></td><?php endif; ?>
        <td><?php echo e(number_format($product['sales_return'], 2), false); ?></td>
        <?php if($show_stock_value_report_sale_value): ?><td><?php echo e(number_format($product['sales_return_value'], 2), false); ?></td><?php endif; ?>
        <td><?php echo e(number_format($product['current_stock'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($product['current_stock_value'], 2), false); ?></td><?php endif; ?>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr style="font-weight:bold; background-color:#eef7ff;">
        <td colspan="<?php echo e($text_colspan, false); ?>" style="text-align:right;"><?php echo app('translator')->get('sale.total'); ?>:</td>
        <td><?php echo e(number_format($data['totals']['opening_stock'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($data['totals']['opening_stock_value'], 2), false); ?></td><?php endif; ?>
        <td><?php echo e(number_format($data['totals']['purchase'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($data['totals']['purchase_value'], 2), false); ?></td><?php endif; ?>
        <td><?php echo e(number_format($data['totals']['purchase_return'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($data['totals']['purchase_return_value'], 2), false); ?></td><?php endif; ?>
        <?php if($show_manufacturing_data): ?>
        <td><?php echo e(number_format($data['totals']['manufacturing'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($data['totals']['manufacturing_value'], 2), false); ?></td><?php endif; ?>
        <td><?php echo e(number_format($data['totals']['ingredient'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($data['totals']['ingredient_value'], 2), false); ?></td><?php endif; ?>
        <?php endif; ?>
        <?php if($show_stock_transfers): ?>
        <td><?php echo e(number_format($data['totals']['stock_transfer'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($data['totals']['stock_transfer_value'], 2), false); ?></td><?php endif; ?>
        <?php endif; ?>
        <?php if($show_stock_adjustment): ?>
        <td><?php echo e(number_format($data['totals']['stock_adjustment'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($data['totals']['stock_adjustment_value'], 2), false); ?></td><?php endif; ?>
        <?php endif; ?>
        <td><?php echo e(number_format($data['totals']['sales'], 2), false); ?></td>
        <?php if($show_stock_value_report_sale_value): ?><td><?php echo e(number_format($data['totals']['sales_value'], 2), false); ?></td><?php endif; ?>
        <td><?php echo e(number_format($data['totals']['sales_return'], 2), false); ?></td>
        <?php if($show_stock_value_report_sale_value): ?><td><?php echo e(number_format($data['totals']['sales_return_value'], 2), false); ?></td><?php endif; ?>
        <td><?php echo e(number_format($data['totals']['current_stock'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($data['totals']['current_stock_value'], 2), false); ?></td><?php endif; ?>
    </tr>
</table>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<table>
    <tr><td colspan="<?php echo e($column_count, false); ?>"></td></tr>
    <tr style="font-weight:bold; background-color:#d9edf7; font-size:13px;">
        <td colspan="<?php echo e($text_colspan, false); ?>" style="text-align:right;"><?php echo app('translator')->get('lang_v1.grand_total'); ?>:</td>
        <td><?php echo e(number_format($grand_totals['opening_stock'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($grand_totals['opening_stock_value'], 2), false); ?></td><?php endif; ?>
        <td><?php echo e(number_format($grand_totals['purchase'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($grand_totals['purchase_value'], 2), false); ?></td><?php endif; ?>
        <td><?php echo e(number_format($grand_totals['purchase_return'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($grand_totals['purchase_return_value'], 2), false); ?></td><?php endif; ?>
        <?php if($show_manufacturing_data): ?>
        <td><?php echo e(number_format($grand_totals['manufacturing'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($grand_totals['manufacturing_value'], 2), false); ?></td><?php endif; ?>
        <td><?php echo e(number_format($grand_totals['ingredient'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($grand_totals['ingredient_value'], 2), false); ?></td><?php endif; ?>
        <?php endif; ?>
        <?php if($show_stock_transfers): ?>
        <td><?php echo e(number_format($grand_totals['stock_transfer'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($grand_totals['stock_transfer_value'], 2), false); ?></td><?php endif; ?>
        <?php endif; ?>
        <?php if($show_stock_adjustment): ?>
        <td><?php echo e(number_format($grand_totals['stock_adjustment'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($grand_totals['stock_adjustment_value'], 2), false); ?></td><?php endif; ?>
        <?php endif; ?>
        <td><?php echo e(number_format($grand_totals['sales'], 2), false); ?></td>
        <?php if($show_stock_value_report_sale_value): ?><td><?php echo e(number_format($grand_totals['sales_value'], 2), false); ?></td><?php endif; ?>
        <td><?php echo e(number_format($grand_totals['sales_return'], 2), false); ?></td>
        <?php if($show_stock_value_report_sale_value): ?><td><?php echo e(number_format($grand_totals['sales_return_value'], 2), false); ?></td><?php endif; ?>
        <td><?php echo e(number_format($grand_totals['current_stock'], 2), false); ?></td>
        <?php if($show_stock_value_report_cost_value): ?><td><?php echo e(number_format($grand_totals['current_stock_value'], 2), false); ?></td><?php endif; ?>
    </tr>
</table>
