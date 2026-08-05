<?php
    $show_variation_column = $show_variation_column ?? true;
    $hide_prices = ! empty($hide_prices);
    $show_unit_prices = ! $hide_prices;
    $show_total_selling_value = ! empty($show_stock_report_sale_value);
    $show_total_cost_value = ! empty($show_stock_report_cost_value);
    $text_colspan = $show_variation_column ? 7 : 6;
    $total_colspan = $text_colspan + 1
        + ($show_unit_prices ? 1 : 0)
        + ($show_total_selling_value ? 1 : 0)
        + ($show_unit_prices ? 1 : 0)
        + ($show_total_cost_value ? 1 : 0);
?>
<table>
    <thead>
        <tr>
            <th colspan="<?php echo e($total_colspan, false); ?>" style="font-size:14px; font-weight:bold;">Stock Quantity Report - Categorized</th>
        </tr>
        <tr><td colspan="<?php echo e($total_colspan, false); ?>"></td></tr>
    </thead>
</table>
<?php $__currentLoopData = $categorized; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_name => $sub_categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<table>
    <tr>
        <td colspan="<?php echo e($total_colspan, false); ?>" style="background-color:#3c8dbc; color:#ffffff; font-weight:bold; font-size:13px;"><?php echo e($category_name, false); ?></td>
    </tr>
</table>
<?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category_name => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<table>
    <tr>
        <td colspan="<?php echo e($total_colspan, false); ?>" style="background-color:#f0f0f0; font-weight:bold;"><?php echo e($sub_category_name, false); ?></td>
    </tr>
    <tr style="font-weight:bold; background-color:#e8e8e8;">
        <td>SKU</td>
        <td><?php echo app('translator')->get('business.product'); ?></td>
        <?php if($show_variation_column): ?>
        <td><?php echo app('translator')->get('lang_v1.variation'); ?></td>
        <?php endif; ?>
        <td><?php echo app('translator')->get('lang_v1.rack_details'); ?></td>
        <td><?php echo app('translator')->get('product.brand'); ?></td>
        <td><?php echo app('translator')->get('sale.location'); ?></td>
        <td><?php echo app('translator')->get('product.unit'); ?></td>
        <td><?php echo app('translator')->get('lang_v1.quantity'); ?></td>
        <?php if($show_unit_prices): ?><td><?php echo app('translator')->get('lang_v1.unit_selling_price'); ?></td><?php endif; ?>
        <?php if($show_total_selling_value): ?><td><?php echo app('translator')->get('lang_v1.total_selling_value'); ?></td><?php endif; ?>
        <?php if($show_unit_prices): ?><td><?php echo app('translator')->get('lang_v1.unit_purchase_price'); ?></td><?php endif; ?>
        <?php if($show_total_cost_value): ?><td><?php echo app('translator')->get('lang_v1.total_cost_value'); ?></td><?php endif; ?>
    </tr>
    <?php $__currentLoopData = $data['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($product['sku'], false); ?></td>
        <td><?php echo e($product['product_name'], false); ?></td>
        <?php if($show_variation_column): ?>
        <td><?php echo e($product['variation'], false); ?></td>
        <?php endif; ?>
        <td><?php echo e($product['rack_details'], false); ?></td>
        <td><?php echo e($product['brand_name'], false); ?></td>
        <td><?php echo e($product['location_name'], false); ?></td>
        <td><?php echo e($product['unit'], false); ?></td>
        <td><?php echo e(number_format($product['qty'], 2), false); ?></td>
        <?php if($show_unit_prices): ?><td><?php echo e(number_format($product['unit_selling_price'], 2), false); ?></td><?php endif; ?>
        <?php if($show_total_selling_value): ?><td><?php echo e(number_format($product['total_selling_value'], 2), false); ?></td><?php endif; ?>
        <?php if($show_unit_prices): ?><td><?php echo e(number_format($product['unit_purchase_price'], session('business.cost_decimal', 2)), false); ?></td><?php endif; ?>
        <?php if($show_total_cost_value): ?><td><?php echo e(number_format($product['total_cost_value'], session('business.cost_decimal', 2)), false); ?></td><?php endif; ?>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr style="font-weight:bold; background-color:#eef7ff;">
        <td colspan="<?php echo e($text_colspan, false); ?>" style="text-align:right;"><?php echo app('translator')->get('sale.total'); ?>:</td>
        <td><?php echo e(number_format($data['total_qty'], 2), false); ?></td>
        <?php if($show_unit_prices): ?><td></td><?php endif; ?>
        <?php if($show_total_selling_value): ?><td><?php echo e(number_format($data['total_selling_value'], 2), false); ?></td><?php endif; ?>
        <?php if($show_unit_prices): ?><td></td><?php endif; ?>
        <?php if($show_total_cost_value): ?><td><?php echo e(number_format($data['total_cost_value'], 2), false); ?></td><?php endif; ?>
    </tr>
</table>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<table>
    <tr><td colspan="<?php echo e($total_colspan, false); ?>"></td></tr>
    <tr style="font-weight:bold; background-color:#d9edf7; font-size:13px;">
        <td colspan="<?php echo e($text_colspan, false); ?>" style="text-align:right;"><?php echo app('translator')->get('lang_v1.grand_total'); ?>:</td>
        <td><?php echo e(number_format($grand_total_qty, 2), false); ?></td>
        <?php if($show_unit_prices): ?><td></td><?php endif; ?>
        <?php if($show_total_selling_value): ?><td><?php echo e(number_format($grand_total_selling, 2), false); ?></td><?php endif; ?>
        <?php if($show_unit_prices): ?><td></td><?php endif; ?>
        <?php if($show_total_cost_value): ?><td><?php echo e(number_format($grand_total_cost, 2), false); ?></td><?php endif; ?>
    </tr>
</table>
