<?php
    $us = $user_settings ?? [];
    $column_visible = function ($key) use ($us) {
        return empty($us['rpt_stock_sexp_hide_'.$key]);
    };
?>
<table>
    <thead>
        <tr>
            <th colspan="7"><?php echo e($business_name, false); ?> - <?php echo e(__('report.stock_expiry_report'), false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <tr>
            <?php if($column_visible('product')): ?><th><?php echo e(__('business.product'), false); ?></th><?php endif; ?>
            <?php if($column_visible('sku')): ?><th>SKU</th><?php endif; ?>
            <?php if($column_visible('location')): ?><th><?php echo e(__('business.location'), false); ?></th><?php endif; ?>
            <?php if($column_visible('stock_left')): ?><th><?php echo e(__('report.stock_left'), false); ?></th><?php endif; ?>
            <?php if($column_visible('lot_number')): ?><th><?php echo e(__('lang_v1.lot_number'), false); ?></th><?php endif; ?>
            <?php if($column_visible('exp_date')): ?><th><?php echo e(__('product.exp_date'), false); ?></th><?php endif; ?>
            <?php if($column_visible('mfg_date')): ?><th><?php echo e(__('product.mfg_date'), false); ?></th><?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php if($column_visible('product')): ?><td><?php echo e($row['product'], false); ?></td><?php endif; ?>
                <?php if($column_visible('sku')): ?><td><?php echo e($row['sku'], false); ?></td><?php endif; ?>
                <?php if($column_visible('location')): ?><td><?php echo e($row['location'], false); ?></td><?php endif; ?>
                <?php if($column_visible('stock_left')): ?><td><?php echo e(round($row['stock_left'], 2), false); ?> <?php echo e($row['unit'], false); ?></td><?php endif; ?>
                <?php if($column_visible('lot_number')): ?><td><?php echo e($row['lot_number'], false); ?></td><?php endif; ?>
                <?php if($column_visible('exp_date')): ?><td><?php echo e($row['exp_date'], false); ?></td><?php endif; ?>
                <?php if($column_visible('mfg_date')): ?><td><?php echo e($row['mfg_date'], false); ?></td><?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($column_visible('stock_left')): ?>
            <tr>
                <?php
                    $text_cols = 0;
                    foreach (['product', 'sku', 'location'] as $key) {
                        if ($column_visible($key)) $text_cols++;
                    }
                ?>
                <?php if($text_cols > 0): ?><td colspan="<?php echo e($text_cols, false); ?>"><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
                <td><?php echo e(round($totals['stock_left'], 2), false); ?></td>
                <?php if($column_visible('lot_number')): ?><td></td><?php endif; ?>
                <?php if($column_visible('exp_date')): ?><td></td><?php endif; ?>
                <?php if($column_visible('mfg_date')): ?><td></td><?php endif; ?>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
