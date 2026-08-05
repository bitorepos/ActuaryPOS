<?php
    $us = $user_settings ?? [];
    $summary_visible = function ($key) use ($us) {
        return empty($us['rpt_stock_strans_hide_'.$key]);
    };
    $show_stock_transfer_report_cost_value = $show_stock_transfer_report_cost_value ?? empty($hide_stock_transfer_report_cost_value);
    $show_stock_transfer_report_sale_value = $show_stock_transfer_report_sale_value ?? empty($hide_stock_transfer_report_sale_value);
    $summary_money_visible = function ($key) use ($summary_visible, $show_stock_transfer_report_cost_value, $show_stock_transfer_report_sale_value) {
        if ($key === 'shipping_charges') {
            return $show_stock_transfer_report_sale_value && $summary_visible($key);
        }

        if ($key === 'total_amount') {
            return $show_stock_transfer_report_cost_value && $summary_visible($key);
        }

        if ($key === 'total_selling_value') {
            return $show_stock_transfer_report_sale_value;
        }

        return $summary_visible($key);
    };
    $title_colspan = 10;
    if ($tab === 'totals') {
        $title_colspan = 3 + ($show_stock_transfer_report_cost_value ? 1 : 0) + ($show_stock_transfer_report_sale_value ? 1 : 0);
    } elseif ($tab === 'summary') {
        $title_colspan = 0;
        foreach (['date', 'ref_no', 'location_from', 'location_to', 'status', 'additional_notes'] as $key) {
            if ($summary_visible($key)) {
                $title_colspan++;
            }
        }
        if ($summary_money_visible('shipping_charges')) {
            $title_colspan++;
        }
        if ($summary_money_visible('total_amount')) {
            $title_colspan++;
        }
        if ($summary_money_visible('total_selling_value')) {
            $title_colspan++;
        }
    } elseif ($tab === 'detailed') {
        $summary_colspan = 6 + ($show_stock_transfer_report_sale_value ? 2 : 0) + ($show_stock_transfer_report_cost_value ? 1 : 0);
        $line_colspan = 6 + ($show_stock_transfer_report_sale_value ? 1 : 0) + ($show_stock_transfer_report_cost_value ? 2 : 0);
        $title_colspan = max($summary_colspan, $line_colspan);
    } else {
        $title_colspan = 5 + ($show_stock_transfer_report_sale_value ? 2 : 0) + ($show_stock_transfer_report_cost_value ? 1 : 0);
    }
?>
<table>
    <thead>
        <tr>
            <th colspan="<?php echo e(max($title_colspan, 1), false); ?>"><?php echo e($business_name, false); ?> - <?php echo e(__('lang_v1.stock_transfer_report'), false); ?> - <?php echo e($tab_title, false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <?php if($tab === 'totals'): ?>
            <tr>
                <th><?php echo e(__('messages.date'), false); ?></th>
                <th><?php echo e(__('lang_v1.invoice_quantity'), false); ?></th>
                <th><?php echo e(__('lang_v1.item_quantity'), false); ?></th>
                <?php if($show_stock_transfer_report_cost_value): ?><th><?php echo e(__('lang_v1.total_cost_value'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                <?php if($show_stock_transfer_report_sale_value): ?><th><?php echo e(__('lang_v1.total_selling_value'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
            </tr>
        <?php elseif($tab === 'summary'): ?>
            <tr>
                <?php if($summary_visible('date')): ?><th><?php echo e(__('messages.date'), false); ?></th><?php endif; ?>
                <?php if($summary_visible('ref_no')): ?><th><?php echo e(__('purchase.ref_no'), false); ?></th><?php endif; ?>
                <?php if($summary_visible('location_from')): ?><th><?php echo e(__('lang_v1.location_from'), false); ?></th><?php endif; ?>
                <?php if($summary_visible('location_to')): ?><th><?php echo e(__('lang_v1.location_to'), false); ?></th><?php endif; ?>
                <?php if($summary_visible('status')): ?><th><?php echo e(__('sale.status'), false); ?></th><?php endif; ?>
                <?php if($summary_money_visible('shipping_charges')): ?><th><?php echo e(__('lang_v1.shipping_charges'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                <?php if($summary_money_visible('total_amount')): ?><th><?php echo e(__('lang_v1.total_cost_value'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                <?php if($summary_money_visible('total_selling_value')): ?><th><?php echo e(__('lang_v1.total_selling_value'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                <?php if($summary_visible('additional_notes')): ?><th><?php echo e(__('purchase.additional_notes'), false); ?></th><?php endif; ?>
            </tr>
        <?php elseif($tab === 'detailed'): ?>
            <tr>
                <th><?php echo e(__('messages.date'), false); ?></th>
                <th><?php echo e(__('purchase.ref_no'), false); ?></th>
                <th><?php echo e(__('lang_v1.location_from'), false); ?></th>
                <th><?php echo e(__('lang_v1.location_to'), false); ?></th>
                <th><?php echo e(__('sale.status'), false); ?></th>
                <?php if($show_stock_transfer_report_sale_value): ?><th><?php echo e(__('lang_v1.shipping_charges'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                <?php if($show_stock_transfer_report_cost_value): ?><th><?php echo e(__('lang_v1.total_cost_value'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                <?php if($show_stock_transfer_report_sale_value): ?><th><?php echo e(__('lang_v1.total_selling_value'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                <th><?php echo e(__('purchase.additional_notes'), false); ?></th>
            </tr>
        <?php else: ?>
            <tr>
                <th><?php echo e(__('sale.product'), false); ?></th>
                <th><?php echo e(__('product.sku'), false); ?></th>
                <th><?php echo e(__('lang_v1.unit'), false); ?></th>
                <th><?php echo e(__('lang_v1.count'), false); ?></th>
                <th><?php echo e(__('purchase.purchase_quantity'), false); ?></th>
                <?php if($show_stock_transfer_report_sale_value): ?><th><?php echo e(__('lang_v1.sale_price'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                <?php if($show_stock_transfer_report_cost_value): ?><th><?php echo e(__('lang_v1.total_cost_value'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                <?php if($show_stock_transfer_report_sale_value): ?><th><?php echo e(__('lang_v1.total_selling_value'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
            </tr>
        <?php endif; ?>
    </thead>
    <tbody>
        <?php if($tab === 'totals'): ?>
            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($row['transfer_date'], false); ?></td>
                    <td><?php echo e(round($row['total_invoices'], 2), false); ?></td>
                    <td><?php echo e(round($row['total_items'], 2), false); ?></td>
                    <?php if($show_stock_transfer_report_cost_value): ?><td><?php echo e(round($row['final_total'], 2), false); ?></td><?php endif; ?>
                    <?php if($show_stock_transfer_report_sale_value): ?><td><?php echo e(round($row['total_selling_value'], 2), false); ?></td><?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(__('sale.total'), false); ?>:</td>
                <td><?php echo e(round($totals['total_invoices'], 2), false); ?></td>
                <td><?php echo e(round($totals['total_items'], 2), false); ?></td>
                <?php if($show_stock_transfer_report_cost_value): ?><td><?php echo e(round($totals['final_total'], 2), false); ?></td><?php endif; ?>
                <?php if($show_stock_transfer_report_sale_value): ?><td><?php echo e(round($totals['total_selling_value'], 2), false); ?></td><?php endif; ?>
            </tr>
        <?php elseif($tab === 'summary'): ?>
            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php if($summary_visible('date')): ?><td><?php echo e($row['transaction_date'], false); ?></td><?php endif; ?>
                    <?php if($summary_visible('ref_no')): ?><td><?php echo e($row['ref_no'], false); ?></td><?php endif; ?>
                    <?php if($summary_visible('location_from')): ?><td><?php echo e($row['location_from'], false); ?></td><?php endif; ?>
                    <?php if($summary_visible('location_to')): ?><td><?php echo e($row['location_to'], false); ?></td><?php endif; ?>
                    <?php if($summary_visible('status')): ?><td><?php echo e($row['status'], false); ?></td><?php endif; ?>
                    <?php if($summary_money_visible('shipping_charges')): ?><td><?php echo e(round($row['shipping_charges'], 2), false); ?></td><?php endif; ?>
                    <?php if($summary_money_visible('total_amount')): ?><td><?php echo e(round($row['final_total'], 2), false); ?></td><?php endif; ?>
                    <?php if($summary_money_visible('total_selling_value')): ?><td><?php echo e(round($row['total_selling_value'], 2), false); ?></td><?php endif; ?>
                    <?php if($summary_visible('additional_notes')): ?><td><?php echo e($row['additional_notes'], false); ?></td><?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php
                    $lead_cols = 0;
                    foreach (['date', 'ref_no', 'location_from', 'location_to', 'status'] as $key) {
                        if ($summary_visible($key)) $lead_cols++;
                    }
                ?>
                <?php if($lead_cols > 0): ?><td colspan="<?php echo e($lead_cols, false); ?>"><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
                <?php if($summary_money_visible('shipping_charges')): ?><td><?php echo e(round($totals['shipping_charges'], 2), false); ?></td><?php endif; ?>
                <?php if($summary_money_visible('total_amount')): ?><td><?php echo e(round($totals['final_total'], 2), false); ?></td><?php endif; ?>
                <?php if($summary_money_visible('total_selling_value')): ?><td><?php echo e(round($totals['total_selling_value'], 2), false); ?></td><?php endif; ?>
                <?php if($summary_visible('additional_notes')): ?><td></td><?php endif; ?>
            </tr>
        <?php elseif($tab === 'detailed'): ?>
            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($row['transaction_date'], false); ?></td>
                    <td><?php echo e($row['ref_no'], false); ?></td>
                    <td><?php echo e($row['location_from'], false); ?></td>
                    <td><?php echo e($row['location_to'], false); ?></td>
                    <td><?php echo e($row['status'], false); ?></td>
                    <?php if($show_stock_transfer_report_sale_value): ?><td><?php echo e(round($row['shipping_charges'], 2), false); ?></td><?php endif; ?>
                    <?php if($show_stock_transfer_report_cost_value): ?><td><?php echo e(round($row['final_total'], 2), false); ?></td><?php endif; ?>
                    <?php if($show_stock_transfer_report_sale_value): ?><td><?php echo e(round($row['total_selling_value'], 2), false); ?></td><?php endif; ?>
                    <td><?php echo e($row['additional_notes'], false); ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>#</td>
                    <td><?php echo e(__('sale.sku'), false); ?></td>
                    <td colspan="2"><?php echo e(__('sale.product'), false); ?></td>
                    <td><?php echo e(__('sale.qty'), false); ?></td>
                    <?php if($show_stock_transfer_report_cost_value): ?>
                        <td><?php echo e(__('purchase.cost_price'), false); ?> <?php echo e($currency_symbol, false); ?></td>
                    <?php endif; ?>
                    <?php if($show_stock_transfer_report_sale_value): ?>
                        <td><?php echo e(__('lang_v1.sale_price'), false); ?> <?php echo e($currency_symbol, false); ?></td>
                    <?php endif; ?>
                    <?php if($show_stock_transfer_report_cost_value): ?>
                        <td><?php echo e(__('purchase.cost_total'), false); ?> <?php echo e($currency_symbol, false); ?></td>
                    <?php endif; ?>
                </tr>
                <?php $__currentLoopData = $row['lines']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td></td>
                        <td><?php echo e($line['index'], false); ?></td>
                        <td><?php echo e($line['sku'], false); ?></td>
                        <td colspan="2"><?php echo e($line['product'], false); ?></td>
                        <td><?php echo e(round($line['quantity'], 2), false); ?> <?php echo e($line['unit'], false); ?></td>
                        <?php if($show_stock_transfer_report_cost_value): ?>
                            <td><?php echo e(round($line['unit_price'], 2), false); ?></td>
                        <?php endif; ?>
                        <?php if($show_stock_transfer_report_sale_value): ?>
                            <td><?php echo e(round($line['selling_price'], 2), false); ?></td>
                        <?php endif; ?>
                        <?php if($show_stock_transfer_report_cost_value): ?>
                            <td><?php echo e(round($line['subtotal'], 2), false); ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td colspan="5"><?php echo e(__('sale.total'), false); ?>:</td>
                <?php if($show_stock_transfer_report_sale_value): ?><td><?php echo e(round($totals['shipping_charges'], 2), false); ?></td><?php endif; ?>
                <?php if($show_stock_transfer_report_cost_value): ?><td><?php echo e(round($totals['final_total'], 2), false); ?></td><?php endif; ?>
                <?php if($show_stock_transfer_report_sale_value): ?><td><?php echo e(round($totals['total_selling_value'], 2), false); ?></td><?php endif; ?>
                <td></td>
            </tr>
        <?php else: ?>
            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($row['product_name'], false); ?></td>
                    <td><?php echo e($row['sku'], false); ?></td>
                    <td><?php echo e($row['unit'], false); ?></td>
                    <td><?php echo e($row['transfer_count'], false); ?></td>
                    <td><?php echo e(round($row['total_quantity'], 2), false); ?></td>
                    <?php if($show_stock_transfer_report_sale_value): ?><td><?php echo e(round($row['selling_price'], 2), false); ?></td><?php endif; ?>
                    <?php if($show_stock_transfer_report_cost_value): ?><td><?php echo e(round($row['total_value'], 2), false); ?></td><?php endif; ?>
                    <?php if($show_stock_transfer_report_sale_value): ?><td><?php echo e(round($row['total_selling_value'], 2), false); ?></td><?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td colspan="3"><?php echo e(__('sale.total'), false); ?>:</td>
                <td><?php echo e($totals['transfer_count'], false); ?></td>
                <td><?php echo e(round($totals['total_quantity'], 2), false); ?></td>
                <?php if($show_stock_transfer_report_sale_value): ?><td></td><?php endif; ?>
                <?php if($show_stock_transfer_report_cost_value): ?><td><?php echo e(round($totals['total_value'], 2), false); ?></td><?php endif; ?>
                <?php if($show_stock_transfer_report_sale_value): ?><td><?php echo e(round($totals['total_selling_value'], 2), false); ?></td><?php endif; ?>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
