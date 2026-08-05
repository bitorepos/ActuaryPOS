<?php
    $us = $user_settings ?? [];
    $column_visible = function ($key) use ($us) {
        return empty($us['rpt_sales_pstatus_hide_'.$key]);
    };
?>
<table>
    <thead>
        <tr>
            <th colspan="14"><?php echo e($business_name, false); ?> - <?php echo e(__('lang_v1.product_status_report'), false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <tr>
            <?php if($column_visible('status')): ?><th><?php echo e(__('lang_v1.status'), false); ?></th><?php endif; ?>
            <?php if($column_visible('sku')): ?><th><?php echo e(__('product.sku'), false); ?></th><?php endif; ?>
            <?php if($column_visible('product')): ?><th><?php echo e(__('sale.product'), false); ?></th><?php endif; ?>
            <?php if($column_visible('customer_name')): ?><th><?php echo e(__('sale.customer_name'), false); ?></th><?php endif; ?>
            <?php if($column_visible('contact_id')): ?><th><?php echo e(__('lang_v1.contact_id'), false); ?></th><?php endif; ?>
            <?php if($column_visible('invoice_no')): ?><th><?php echo e(__('sale.invoice_no'), false); ?></th><?php endif; ?>
            <?php if($column_visible('date')): ?><th><?php echo e(__('messages.date'), false); ?></th><?php endif; ?>
            <?php if($column_visible('qty')): ?><th><?php echo e(__('sale.qty'), false); ?></th><?php endif; ?>
            <?php if($column_visible('unit_price')): ?><th><?php echo e(__('sale.unit_price'), false); ?></th><?php endif; ?>
            <?php if($column_visible('subtotal')): ?><th><?php echo e(__('sale.subtotal'), false); ?></th><?php endif; ?>
            <?php if($column_visible('discount')): ?><th><?php echo e(__('sale.discount'), false); ?></th><?php endif; ?>
            <?php if($column_visible('tax')): ?><th><?php echo e(__('sale.tax'), false); ?></th><?php endif; ?>
            <?php if($column_visible('price_inc_tax')): ?><th><?php echo e(__('sale.price_inc_tax'), false); ?></th><?php endif; ?>
            <?php if($column_visible('total')): ?><th><?php echo e(__('sale.total'), false); ?></th><?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php if($column_visible('status')): ?><td><?php echo e($row['status'], false); ?></td><?php endif; ?>
                <?php if($column_visible('sku')): ?><td><?php echo e($row['sub_sku'], false); ?></td><?php endif; ?>
                <?php if($column_visible('product')): ?><td><?php echo e($row['product_name'], false); ?></td><?php endif; ?>
                <?php if($column_visible('customer_name')): ?><td><?php echo e($row['customer'], false); ?></td><?php endif; ?>
                <?php if($column_visible('contact_id')): ?><td><?php echo e($row['contact_id'], false); ?></td><?php endif; ?>
                <?php if($column_visible('invoice_no')): ?><td><?php echo e($row['invoice_no'], false); ?></td><?php endif; ?>
                <?php if($column_visible('date')): ?><td><?php echo e($row['transaction_date'], false); ?></td><?php endif; ?>
                <?php if($column_visible('qty')): ?><td><?php echo e(round($row['sell_qty'], 2), false); ?> <?php echo e($row['unit'], false); ?></td><?php endif; ?>
                <?php if($column_visible('unit_price')): ?><td><?php echo e($hide_values ? '' : round($row['unit_price'], 2), false); ?></td><?php endif; ?>
                <?php if($column_visible('subtotal')): ?><td><?php echo e($hide_values ? '' : round($row['subtotal_before_discount'], 2), false); ?></td><?php endif; ?>
                <?php if($column_visible('discount')): ?><td><?php echo e($row['discount_display'], false); ?></td><?php endif; ?>
                <?php if($column_visible('tax')): ?><td><?php echo e($hide_values ? '' : round($row['item_tax'], 2), false); ?> <?php echo e(!$hide_values && !empty($row['tax']) ? '(' . $row['tax'] . ')' : '', false); ?></td><?php endif; ?>
                <?php if($column_visible('price_inc_tax')): ?><td><?php echo e($hide_values ? '' : round($row['unit_sale_price'], 2), false); ?></td><?php endif; ?>
                <?php if($column_visible('total')): ?><td><?php echo e($hide_values ? '' : round($row['subtotal'], 2), false); ?></td><?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <?php
                $lead_cols = 0;
                foreach (['status', 'sku', 'product', 'customer_name', 'contact_id', 'invoice_no', 'date'] as $key) {
                    if ($column_visible($key)) $lead_cols++;
                }
            ?>
            <?php if($lead_cols > 0): ?><td colspan="<?php echo e($lead_cols, false); ?>"><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
            <?php if($column_visible('qty')): ?><td><?php echo e(round($totals['sell_qty'], 2), false); ?></td><?php endif; ?>
            <?php if($column_visible('unit_price')): ?><td></td><?php endif; ?>
            <?php if($column_visible('subtotal')): ?><td><?php echo e($hide_values ? '' : round($totals['subtotal_before_discount'], 2), false); ?></td><?php endif; ?>
            <?php if($column_visible('discount')): ?><td></td><?php endif; ?>
            <?php if($column_visible('tax')): ?><td><?php echo e($hide_values ? '' : round($totals['item_tax'], 2), false); ?></td><?php endif; ?>
            <?php if($column_visible('price_inc_tax')): ?><td></td><?php endif; ?>
            <?php if($column_visible('total')): ?><td><?php echo e($hide_values ? '' : round($totals['subtotal'], 2), false); ?></td><?php endif; ?>
        </tr>
    </tbody>
</table>
