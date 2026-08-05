<?php
    $us = $user_settings ?? [];
    $column_visible = function ($key) use ($us) {
        return empty($us['rpt_stock_sreorder_hide_'.$key]);
    };
?>
<table>
    <thead>
        <tr>
            <th colspan="10"><?php echo e($business_name, false); ?> - <?php echo e(__('report.stock_reorder_report'), false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <tr>
            <?php if($column_visible('sku')): ?><th>SKU</th><?php endif; ?>
            <?php if($column_visible('product')): ?><th><?php echo e(__('business.product'), false); ?></th><?php endif; ?>
            <?php if($column_visible('variation')): ?><th><?php echo e(__('lang_v1.variation'), false); ?></th><?php endif; ?>
            <?php if($column_visible('category')): ?><th><?php echo e(__('product.category'), false); ?></th><?php endif; ?>
            <?php if($column_visible('location')): ?><th><?php echo e(__('sale.location'), false); ?></th><?php endif; ?>
            <?php if($column_visible('current_stock')): ?><th><?php echo e(__('report.current_stock'), false); ?></th><?php endif; ?>
            <?php if($column_visible('alert_qty_low')): ?><th><?php echo e(__('product.alert_quantity_low'), false); ?></th><?php endif; ?>
            <?php if($column_visible('alert_qty_medium')): ?><th><?php echo e(__('product.alert_quantity_medium'), false); ?></th><?php endif; ?>
            <?php if($column_visible('alert_qty_high')): ?><th><?php echo e(__('product.alert_quantity_high'), false); ?></th><?php endif; ?>
            <?php if($column_visible('alert_qty_max')): ?><th><?php echo e(__('product.alert_quantity_max'), false); ?></th><?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php if($column_visible('sku')): ?><td><?php echo e($row['sku'], false); ?></td><?php endif; ?>
                <?php if($column_visible('product')): ?><td><?php echo e($row['product'], false); ?></td><?php endif; ?>
                <?php if($column_visible('variation')): ?><td><?php echo e($row['variation'], false); ?></td><?php endif; ?>
                <?php if($column_visible('category')): ?><td><?php echo e($row['category'], false); ?></td><?php endif; ?>
                <?php if($column_visible('location')): ?><td><?php echo e($row['location'], false); ?></td><?php endif; ?>
                <?php if($column_visible('current_stock')): ?><td><?php echo e(round($row['stock'], 2), false); ?></td><?php endif; ?>
                <?php if($column_visible('alert_qty_low')): ?><td><?php echo e(round($row['low_level'], 2), false); ?></td><?php endif; ?>
                <?php if($column_visible('alert_qty_medium')): ?><td><?php echo e(round($row['medium_level'], 2), false); ?></td><?php endif; ?>
                <?php if($column_visible('alert_qty_high')): ?><td><?php echo e(round($row['high_level'], 2), false); ?></td><?php endif; ?>
                <?php if($column_visible('alert_qty_max')): ?><td><?php echo e(round($row['max_level'], 2), false); ?></td><?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <?php
                $text_cols = 0;
                foreach (['sku', 'product', 'variation', 'category', 'location'] as $key) {
                    if ($column_visible($key)) $text_cols++;
                }
            ?>
            <?php if($text_cols > 0): ?><td colspan="<?php echo e($text_cols, false); ?>"><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
            <?php if($column_visible('current_stock')): ?><td><?php echo e(round($totals['stock'], 2), false); ?></td><?php endif; ?>
            <?php if($column_visible('alert_qty_low')): ?><td><?php echo e(round($totals['low_level'], 2), false); ?></td><?php endif; ?>
            <?php if($column_visible('alert_qty_medium')): ?><td><?php echo e(round($totals['medium_level'], 2), false); ?></td><?php endif; ?>
            <?php if($column_visible('alert_qty_high')): ?><td><?php echo e(round($totals['high_level'], 2), false); ?></td><?php endif; ?>
            <?php if($column_visible('alert_qty_max')): ?><td><?php echo e(round($totals['max_level'], 2), false); ?></td><?php endif; ?>
        </tr>
    </tbody>
</table>
