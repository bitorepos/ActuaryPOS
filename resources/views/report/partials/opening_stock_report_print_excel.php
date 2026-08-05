<?php
    $us = $user_settings ?? [];
    $column_visible = function ($key) use ($us) {
        return empty($us['rpt_stock_ostock_hide_'.$key]);
    };

    $show_opening_stock_report_cost_value = $show_opening_stock_report_cost_value ?? empty($hide_opening_stock_report_cost_value);
    $show_unit_price = $show_opening_stock_report_cost_value && $column_visible('unit_price');
    $show_subtotal = $show_opening_stock_report_cost_value && $column_visible('subtotal');
    $header_colspan = ($column_visible('sku') ? 1 : 0)
        + ($column_visible('product') ? 1 : 0)
        + 1
        + ($column_visible('qty') ? 1 : 0)
        + ($column_visible('qty_left') ? 1 : 0)
        + ($show_unit_price ? 1 : 0)
        + ($show_subtotal ? 1 : 0)
        + ($column_visible('date') ? 1 : 0)
        + ($column_visible('note') ? 1 : 0)
        + ($column_visible('location') ? 1 : 0);
?>
<table>
    <thead>
        <tr>
            <th colspan="<?php echo e(max($header_colspan, 1), false); ?>"><?php echo e($business_name, false); ?> - <?php echo e(__('lang_v1.opening_stock_report'), false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <tr>
            <?php if($column_visible('sku')): ?><th>SKU</th><?php endif; ?>
            <?php if($column_visible('product')): ?><th><?php echo e(__('business.product'), false); ?></th><?php endif; ?>
            <th><?php echo e(__('product.unit'), false); ?></th>
            <?php if($column_visible('qty')): ?><th><?php echo e(__('sale.qty'), false); ?></th><?php endif; ?>
            <?php if($column_visible('qty_left')): ?><th><?php echo e(__('lang_v1.quantity_left'), false); ?></th><?php endif; ?>
            <?php if($show_unit_price): ?><th><?php echo e(__('sale.unit_price'), false); ?></th><?php endif; ?>
            <?php if($show_subtotal): ?><th><?php echo e(__('sale.subtotal'), false); ?></th><?php endif; ?>
            <?php if($column_visible('date')): ?><th><?php echo e(__('messages.date'), false); ?></th><?php endif; ?>
            <?php if($column_visible('note')): ?><th><?php echo e(__('lang_v1.note'), false); ?></th><?php endif; ?>
            <?php if($column_visible('location')): ?><th><?php echo e(__('sale.location'), false); ?></th><?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php if($column_visible('sku')): ?><td><?php echo e($row['sku'], false); ?></td><?php endif; ?>
                <?php if($column_visible('product')): ?><td><?php echo e($row['product_name'], false); ?></td><?php endif; ?>
                <td><?php echo e($row['unit'], false); ?></td>
                <?php if($column_visible('qty')): ?><td><?php echo e(round($row['quantity'], 2), false); ?></td><?php endif; ?>
                <?php if($column_visible('qty_left')): ?><td><?php echo e(round($row['remaining_qty'], 2), false); ?></td><?php endif; ?>
                <?php if($show_unit_price): ?><td><?php echo e(round($row['purchase_price'], 2), false); ?></td><?php endif; ?>
                <?php if($show_subtotal): ?><td><?php echo e(round($row['final_total'], 2), false); ?></td><?php endif; ?>
                <?php if($column_visible('date')): ?><td><?php echo e($row['transaction_date'], false); ?></td><?php endif; ?>
                <?php if($column_visible('note')): ?><td><?php echo e($row['additional_notes'], false); ?></td><?php endif; ?>
                <?php if($column_visible('location')): ?><td><?php echo e($row['location'], false); ?></td><?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <?php
                $text_cols = 1;
                foreach (['sku', 'product'] as $key) {
                    if ($column_visible($key)) $text_cols++;
                }
            ?>
            <td colspan="<?php echo e($text_cols, false); ?>"><?php echo e(__('sale.total'), false); ?>:</td>
            <?php if($column_visible('qty')): ?><td><?php echo e(round($totals['quantity'], 2), false); ?></td><?php endif; ?>
            <?php if($column_visible('qty_left')): ?><td><?php echo e(round($totals['remaining_qty'], 2), false); ?></td><?php endif; ?>
            <?php if($show_unit_price): ?><td></td><?php endif; ?>
            <?php if($show_subtotal): ?><td><?php echo e(round($totals['final_total'], 2), false); ?></td><?php endif; ?>
            <?php if($column_visible('date')): ?><td></td><?php endif; ?>
            <?php if($column_visible('note')): ?><td></td><?php endif; ?>
            <?php if($column_visible('location')): ?><td></td><?php endif; ?>
        </tr>
    </tbody>
</table>
