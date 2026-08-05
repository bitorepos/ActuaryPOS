<?php
    $us = $user_settings ?? [];
    $column_visible = function ($key) use ($us) {
        return empty($us['rpt_stock_stake_hide_'.$key]);
    };
?>
<table>
    <thead>
        <tr>
            <th colspan="6"><?php echo e($business_name, false); ?> - <?php echo e(__('report.stock_take_report'), false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <tr>
            <?php if($column_visible('sku')): ?><th>SKU</th><?php endif; ?>
            <?php if($column_visible('product')): ?><th><?php echo e(__('business.product'), false); ?></th><?php endif; ?>
            <?php if($column_visible('variation')): ?><th><?php echo e(__('lang_v1.variation'), false); ?></th><?php endif; ?>
            <?php if($column_visible('rack_details')): ?><th><?php echo e(__('lang_v1.rack_details'), false); ?></th><?php endif; ?>
            <?php if($column_visible('on_hand')): ?><th><?php echo e(__('stock_adjustment.on_hand'), false); ?></th><?php endif; ?>
            <?php if($column_visible('actual_counted')): ?><th><?php echo e(__('lang_v1.actual_counted'), false); ?></th><?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php if($column_visible('sku')): ?><td><?php echo e($row['sku'], false); ?></td><?php endif; ?>
                <?php if($column_visible('product')): ?><td><?php echo e($row['product'], false); ?></td><?php endif; ?>
                <?php if($column_visible('variation')): ?><td><?php echo e($row['variation'], false); ?></td><?php endif; ?>
                <?php if($column_visible('rack_details')): ?><td>Rack: <?php echo e($row['rack'], false); ?> Row: <?php echo e($row['row'], false); ?> Position: <?php echo e($row['position'], false); ?></td><?php endif; ?>
                <?php if($column_visible('on_hand')): ?><td><?php if($row['enable_stock']): ?><?php echo e(round($row['stock'], 2), false); ?> <?php echo e($row['unit'], false); ?><?php else: ?> -- <?php endif; ?></td><?php endif; ?>
                <?php if($column_visible('actual_counted')): ?><td><?php echo e($row['actual'], false); ?></td><?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($column_visible('on_hand')): ?>
            <tr>
                <?php
                    $text_cols = 0;
                    foreach (['sku', 'product', 'variation', 'rack_details'] as $key) {
                        if ($column_visible($key)) $text_cols++;
                    }
                ?>
                <?php if($text_cols > 0): ?><td colspan="<?php echo e($text_cols, false); ?>"><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
                <td><?php echo e(round($totals['stock'], 2), false); ?></td>
                <?php if($column_visible('actual_counted')): ?><td></td><?php endif; ?>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
