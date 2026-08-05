<?php
    $us = $user_settings ?? [];
    $column_visible = function ($key) use ($us) {
        return empty($us['rpt_stock_lot_hide_'.$key]);
    };
    $visible = [
        'sku' => $column_visible('sku'),
        'product' => $column_visible('product'),
        'lot_number' => $column_visible('lot_number'),
        'exp_date' => $column_visible('exp_date'),
        'current_stock' => $column_visible('current_stock'),
        'total_unit_sold' => $column_visible('total_unit_sold'),
        'total_unit_adjusted' => $column_visible('total_unit_adjusted'),
    ];
    $visible_count = 0;
    foreach ($visible as $is_visible) {
        if ($is_visible) $visible_count++;
    }
?>
<table>
    <thead>
        <tr>
            <th colspan="<?php echo e(max($visible_count, 1), false); ?>"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <tr>
            <?php if($visible['sku']): ?><th>SKU</th><?php endif; ?>
            <?php if($visible['product']): ?><th><?php echo e(__('business.product'), false); ?></th><?php endif; ?>
            <?php if($visible['lot_number']): ?><th><?php echo e($lot_number_label, false); ?></th><?php endif; ?>
            <?php if($visible['exp_date']): ?><th><?php echo e(__('product.exp_date'), false); ?></th><?php endif; ?>
            <?php if($visible['current_stock']): ?><th><?php echo e(__('report.current_stock'), false); ?></th><?php endif; ?>
            <?php if($visible['total_unit_sold']): ?><th><?php echo e(__('report.total_unit_sold'), false); ?></th><?php endif; ?>
            <?php if($visible['total_unit_adjusted']): ?><th><?php echo e(__('lang_v1.total_unit_adjusted'), false); ?></th><?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php if($visible['sku']): ?><td><?php echo e($row['sub_sku'], false); ?></td><?php endif; ?>
                <?php if($visible['product']): ?><td><?php echo e($row['product'], false); ?></td><?php endif; ?>
                <?php if($visible['lot_number']): ?><td><?php echo e($row['lot_number'], false); ?></td><?php endif; ?>
                <?php if($visible['exp_date']): ?><td><?php echo e($row['exp_date'], false); ?></td><?php endif; ?>
                <?php if($visible['current_stock']): ?><td><?php echo e(round($row['stock'], 2), false); ?> <?php echo e($row['unit'], false); ?></td><?php endif; ?>
                <?php if($visible['total_unit_sold']): ?><td><?php echo e(round($row['total_sold'], 2), false); ?> <?php echo e($row['unit'], false); ?></td><?php endif; ?>
                <?php if($visible['total_unit_adjusted']): ?><td><?php echo e(round($row['total_adjusted'], 2), false); ?> <?php echo e($row['unit'], false); ?></td><?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <?php
                $lead_cols = 0;
                foreach (['sku', 'product', 'lot_number', 'exp_date'] as $key) {
                    if ($visible[$key]) $lead_cols++;
                }
            ?>
            <?php if($lead_cols > 0): ?><td colspan="<?php echo e($lead_cols, false); ?>"><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
            <?php if($visible['current_stock']): ?><td><?php echo e(round($totals['stock'], 2), false); ?></td><?php endif; ?>
            <?php if($visible['total_unit_sold']): ?><td><?php echo e(round($totals['total_sold'], 2), false); ?></td><?php endif; ?>
            <?php if($visible['total_unit_adjusted']): ?><td><?php echo e(round($totals['total_adjusted'], 2), false); ?></td><?php endif; ?>
        </tr>
    </tbody>
</table>
