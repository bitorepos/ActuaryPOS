<?php
    $us = $user_settings ?? [];
    $scheme_enabled = ! empty($show_scheme_qty);
    $column_visible = function ($key) use ($us) {
        return empty($us['rpt_sales_pserial_hide_'.$key]);
    };
    $visible = [
        'sku' => $column_visible('sku'),
        'product' => $column_visible('product'),
        'brand_name' => $column_visible('brand_name'),
        'contact_id' => $column_visible('contact_id'),
        'contact' => $column_visible('contact'),
        'supplier_name' => $column_visible('supplier_name'),
        'type' => $column_visible('type'),
        'invoice_no' => $column_visible('invoice_no'),
        'date' => $column_visible('date'),
        'qty' => $column_visible('qty'),
        'scheme_qty' => $scheme_enabled && $column_visible('scheme_qty'),
        'sr_imei_no' => $column_visible('sr_imei_no'),
        'unit_price' => $column_visible('unit_price'),
        'subtotal' => $column_visible('subtotal'),
        'discount' => $column_visible('discount'),
        'discount_pct' => $column_visible('discount_pct'),
        'tax' => $column_visible('tax'),
        'price_inc_tax' => $column_visible('price_inc_tax'),
        'total' => $column_visible('total'),
        'days' => $column_visible('days'),
    ];
    $visible_count = 0;
    foreach ($visible as $is_visible) {
        if ($is_visible) $visible_count++;
    }
?>
<table>
    <thead>
        <tr>
            <th colspan="<?php echo e(max($visible_count, 1), false); ?>"><?php echo e($business_name, false); ?> - <?php echo e(__('lang_v1.product_serial_report'), false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <tr>
            <?php if($visible['sku']): ?><th><?php echo e(__('product.sku'), false); ?></th><?php endif; ?>
            <?php if($visible['product']): ?><th><?php echo e(__('sale.product'), false); ?></th><?php endif; ?>
            <?php if($visible['brand_name']): ?><th><?php echo e(__('brand.brand_name'), false); ?></th><?php endif; ?>
            <?php if($visible['contact_id']): ?><th><?php echo e(__('contact.contact_id'), false); ?></th><?php endif; ?>
            <?php if($visible['contact']): ?><th><?php echo e(__('contact.contact'), false); ?></th><?php endif; ?>
            <?php if($visible['supplier_name']): ?><th><?php echo e(__('lang_v1.supplier_name'), false); ?></th><?php endif; ?>
            <?php if($visible['type']): ?><th><?php echo e(__('lang_v1.type'), false); ?></th><?php endif; ?>
            <?php if($visible['invoice_no']): ?><th><?php echo e(__('sale.invoice_no'), false); ?></th><?php endif; ?>
            <?php if($visible['date']): ?><th><?php echo e(__('messages.date'), false); ?></th><?php endif; ?>
            <?php if($visible['qty']): ?><th><?php echo e(__('sale.qty'), false); ?></th><?php endif; ?>
            <?php if($visible['scheme_qty']): ?><th><?php echo e(__('sale.scheme_qty'), false); ?></th><?php endif; ?>
            <?php if($visible['sr_imei_no']): ?><th><?php echo e(__('product.sr_imei_no'), false); ?></th><?php endif; ?>
            <?php if($visible['unit_price']): ?><th><?php echo e(__('sale.unit_price'), false); ?></th><?php endif; ?>
            <?php if($visible['subtotal']): ?><th><?php echo e(__('sale.subtotal'), false); ?></th><?php endif; ?>
            <?php if($visible['discount']): ?><th><?php echo e(__('sale.discount'), false); ?></th><?php endif; ?>
            <?php if($visible['discount_pct']): ?><th><?php echo e(__('sale.discount'), false); ?> %</th><?php endif; ?>
            <?php if($visible['tax']): ?><th><?php echo e(__('sale.tax'), false); ?></th><?php endif; ?>
            <?php if($visible['price_inc_tax']): ?><th><?php echo e(__('sale.price_inc_tax'), false); ?></th><?php endif; ?>
            <?php if($visible['total']): ?><th><?php echo e(__('sale.total'), false); ?></th><?php endif; ?>
            <?php if($visible['days']): ?><th><?php echo e(__('lang_v1.days'), false); ?></th><?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php if($visible['sku']): ?><td><?php echo e($row['sub_sku'], false); ?></td><?php endif; ?>
                <?php if($visible['product']): ?><td><?php echo e($row['product_name'], false); ?></td><?php endif; ?>
                <?php if($visible['brand_name']): ?><td><?php echo e($row['brand_name'], false); ?></td><?php endif; ?>
                <?php if($visible['contact_id']): ?><td><?php echo e($row['contact_id'], false); ?></td><?php endif; ?>
                <?php if($visible['contact']): ?><td><?php echo e($row['contact'], false); ?></td><?php endif; ?>
                <?php if($visible['supplier_name']): ?><td><?php echo e($row['supplier'], false); ?></td><?php endif; ?>
                <?php if($visible['type']): ?><td><?php echo e($row['type'], false); ?></td><?php endif; ?>
                <?php if($visible['invoice_no']): ?><td><?php echo e($row['invoice_no'], false); ?></td><?php endif; ?>
                <?php if($visible['date']): ?><td><?php echo e($row['transaction_date'], false); ?></td><?php endif; ?>
                <?php if($visible['qty']): ?><td><?php echo e(round($row['sell_qty'], 2), false); ?> <?php echo e($row['unit'], false); ?></td><?php endif; ?>
                <?php if($visible['scheme_qty']): ?><td><?php echo e(round($row['foc_qty'], 2), false); ?> <?php echo e($row['unit'], false); ?></td><?php endif; ?>
                <?php if($visible['sr_imei_no']): ?><td><?php echo e($row['serial_number'], false); ?></td><?php endif; ?>
                <?php if($visible['unit_price']): ?><td><?php echo e($hide_values ? '' : round($row['unit_price'], 2), false); ?></td><?php endif; ?>
                <?php if($visible['subtotal']): ?><td><?php echo e($hide_values ? '' : round($row['subtotal_before_discount'], 2), false); ?></td><?php endif; ?>
                <?php if($visible['discount']): ?><td><?php echo e($hide_values ? '' : round($row['discount_amount'], 2), false); ?></td><?php endif; ?>
                <?php if($visible['discount_pct']): ?><td><?php echo e($row['discount_percent'], false); ?></td><?php endif; ?>
                <?php if($visible['tax']): ?><td><?php echo e($hide_values ? '' : round($row['item_tax'], 2), false); ?> <?php echo e(!$hide_values && !empty($row['tax']) ? '(' . $row['tax'] . ')' : '', false); ?></td><?php endif; ?>
                <?php if($visible['price_inc_tax']): ?><td><?php echo e($hide_values ? '' : round($row['unit_sale_price'], 2), false); ?></td><?php endif; ?>
                <?php if($visible['total']): ?><td><?php echo e($hide_values ? '' : round($row['subtotal'], 2), false); ?></td><?php endif; ?>
                <?php if($visible['days']): ?><td><?php echo e($row['days'], false); ?></td><?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <?php
                $lead_cols = 0;
                foreach (['sku', 'product', 'brand_name', 'contact_id', 'contact', 'supplier_name', 'type', 'invoice_no', 'date'] as $key) {
                    if ($visible[$key]) $lead_cols++;
                }
            ?>
            <?php if($lead_cols > 0): ?><td colspan="<?php echo e($lead_cols, false); ?>"><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
            <?php if($visible['qty']): ?><td><?php echo e(round($totals['sell_qty'], 2), false); ?></td><?php endif; ?>
            <?php if($visible['scheme_qty']): ?><td><?php echo e(round($totals['foc_qty'], 2), false); ?></td><?php endif; ?>
            <?php if($visible['sr_imei_no']): ?><td></td><?php endif; ?>
            <?php if($visible['unit_price']): ?><td></td><?php endif; ?>
            <?php if($visible['subtotal']): ?><td><?php echo e($hide_values ? '' : round($totals['subtotal_before_discount'], 2), false); ?></td><?php endif; ?>
            <?php if($visible['discount']): ?><td><?php echo e($hide_values ? '' : round($totals['discount_amount'], 2), false); ?></td><?php endif; ?>
            <?php if($visible['discount_pct']): ?><td></td><?php endif; ?>
            <?php if($visible['tax']): ?><td><?php echo e($hide_values ? '' : round($totals['item_tax'], 2), false); ?></td><?php endif; ?>
            <?php if($visible['price_inc_tax']): ?><td></td><?php endif; ?>
            <?php if($visible['total']): ?><td><?php echo e($hide_values ? '' : round($totals['subtotal'], 2), false); ?></td><?php endif; ?>
            <?php if($visible['days']): ?><td></td><?php endif; ?>
        </tr>
    </tbody>
</table>
