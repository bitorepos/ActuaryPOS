<?php
    $us = $user_settings ?? [];
    $summary_visible = function ($key) use ($us) {
        return empty($us['rpt_stock_sadj_hide_'.$key]);
    };
    $show_stock_adjustment_report_cost_value = $show_stock_adjustment_report_cost_value ?? empty($hide_stock_adjustment_report_cost_value);
    $show_stock_adjustment_report_sale_value = $show_stock_adjustment_report_sale_value ?? empty($hide_stock_adjustment_report_sale_value);
    $summary_money_visible = function ($key) use ($summary_visible, $show_stock_adjustment_report_cost_value, $show_stock_adjustment_report_sale_value) {
        $value_allowed = $key === 'total_recovered'
            ? $show_stock_adjustment_report_sale_value
            : $show_stock_adjustment_report_cost_value;

        return $value_allowed && $summary_visible($key);
    };
    $report_colspan = $show_stock_adjustment_report_cost_value ? 12 : 10;
    if ($tab === 'totals') {
        $report_colspan = 2 + ($show_stock_adjustment_report_cost_value ? 3 : 0) + ($show_stock_adjustment_report_sale_value ? 1 : 0);
    } elseif ($tab === 'summary') {
        $report_colspan = 0;
        foreach (['date', 'ref_no', 'location', 'adjustment_type', 'reason', 'added_by'] as $key) {
            if ($summary_visible($key)) $report_colspan++;
        }
        foreach (['total_amount', 'total_recovered'] as $key) {
            if ($summary_money_visible($key)) $report_colspan++;
        }
        $report_colspan = max($report_colspan, 1);
    } elseif ($tab === 'products_summary') {
        $report_colspan = $show_stock_adjustment_report_cost_value ? 6 : 5;
    }
?>
<table>
    <thead>
        <tr>
            <th colspan="<?php echo e($report_colspan, false); ?>"><?php echo e($business_name, false); ?> - <?php echo e(__('report.stock_adjustment_report'), false); ?> - <?php echo e($tab_title, false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <?php if($tab === 'totals'): ?>
            <tr>
                <th><?php echo e(__('messages.date'), false); ?></th>
                <th><?php echo e(__('lang_v1.count'), false); ?></th>
                <?php if($show_stock_adjustment_report_cost_value): ?>
                    <th><?php echo e(__('stock_adjustment.stock_adjustment'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                    <th><?php echo e(__('stock_adjustment.stock_take'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                    <th><?php echo e(__('report.total_stock_adjustment'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                <?php endif; ?>
                <?php if($show_stock_adjustment_report_sale_value): ?>
                    <th><?php echo e(__('report.total_recovered'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                <?php endif; ?>
            </tr>
        <?php elseif($tab === 'summary'): ?>
            <tr>
                <?php if($summary_visible('date')): ?><th><?php echo e(__('messages.date'), false); ?></th><?php endif; ?>
                <?php if($summary_visible('ref_no')): ?><th><?php echo e(__('purchase.ref_no'), false); ?></th><?php endif; ?>
                <?php if($summary_visible('location')): ?><th><?php echo e(__('business.location'), false); ?></th><?php endif; ?>
                <?php if($summary_visible('adjustment_type')): ?><th><?php echo e(__('stock_adjustment.adjustment_type'), false); ?></th><?php endif; ?>
                <?php if($summary_money_visible('total_amount')): ?><th><?php echo e(__('stock_adjustment.total_amount'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                <?php if($summary_money_visible('total_recovered')): ?><th><?php echo e(__('stock_adjustment.total_amount_recovered'), false); ?> <?php echo e($currency_symbol, false); ?></th><?php endif; ?>
                <?php if($summary_visible('reason')): ?><th><?php echo e(__('stock_adjustment.reason_for_stock_adjustment'), false); ?></th><?php endif; ?>
                <?php if($summary_visible('added_by')): ?><th><?php echo e(__('lang_v1.added_by'), false); ?></th><?php endif; ?>
            </tr>
        <?php elseif($tab === 'detailed'): ?>
            <tr>
                <th><?php echo e(__('messages.date'), false); ?></th>
                <th><?php echo e(__('purchase.ref_no'), false); ?></th>
                <th><?php echo e(__('business.location'), false); ?></th>
                <th><?php echo e(__('stock_adjustment.adjustment_type'), false); ?></th>
                <th><?php echo e(__('sale.product'), false); ?></th>
                <th><?php echo e(__('product.sku'), false); ?></th>
                <th><?php echo e(__('lang_v1.unit'), false); ?></th>
                <th><?php echo e(__('purchase.purchase_quantity'), false); ?></th>
                <?php if($show_stock_adjustment_report_cost_value): ?>
                    <th><?php echo e(__('sale.unit_price'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                    <th><?php echo e(__('sale.subtotal'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                <?php endif; ?>
                <th><?php echo e(__('stock_adjustment.reason_for_stock_adjustment'), false); ?></th>
                <th><?php echo e(__('lang_v1.added_by'), false); ?></th>
            </tr>
        <?php else: ?>
            <tr>
                <th><?php echo e(__('sale.product'), false); ?></th>
                <th><?php echo e(__('product.sku'), false); ?></th>
                <th><?php echo e(__('lang_v1.unit'), false); ?></th>
                <th><?php echo e(__('lang_v1.count'), false); ?></th>
                <th><?php echo e(__('purchase.purchase_quantity'), false); ?></th>
                <?php if($show_stock_adjustment_report_cost_value): ?>
                    <th><?php echo e(__('sale.subtotal'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                <?php endif; ?>
            </tr>
        <?php endif; ?>
    </thead>
    <tbody>
        <?php if($tab === 'totals'): ?>
            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($row['date'], false); ?></td>
                    <td><?php echo e($row['adjustment_count'], false); ?></td>
                    <?php if($show_stock_adjustment_report_cost_value): ?>
                        <td><?php echo e(round($row['total_stock_adjustment'], 2), false); ?></td>
                        <td><?php echo e(round($row['total_stock_take'], 2), false); ?></td>
                        <td><?php echo e(round($row['total_amount'], 2), false); ?></td>
                    <?php endif; ?>
                    <?php if($show_stock_adjustment_report_sale_value): ?>
                        <td><?php echo e(round($row['total_recovered'], 2), false); ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(__('sale.total'), false); ?>:</td>
                <td><?php echo e($totals['adjustment_count'], false); ?></td>
                <?php if($show_stock_adjustment_report_cost_value): ?>
                    <td><?php echo e(round($totals['total_stock_adjustment'], 2), false); ?></td>
                    <td><?php echo e(round($totals['total_stock_take'], 2), false); ?></td>
                    <td><?php echo e(round($totals['total_amount'], 2), false); ?></td>
                <?php endif; ?>
                <?php if($show_stock_adjustment_report_sale_value): ?>
                    <td><?php echo e(round($totals['total_recovered'], 2), false); ?></td>
                <?php endif; ?>
            </tr>
        <?php elseif($tab === 'summary'): ?>
            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php if($summary_visible('date')): ?><td><?php echo e($row['transaction_date'], false); ?></td><?php endif; ?>
                    <?php if($summary_visible('ref_no')): ?><td><?php echo e($row['ref_no'], false); ?></td><?php endif; ?>
                    <?php if($summary_visible('location')): ?><td><?php echo e($row['location_name'], false); ?></td><?php endif; ?>
                    <?php if($summary_visible('adjustment_type')): ?><td><?php echo e($row['adjustment_type'], false); ?></td><?php endif; ?>
                    <?php if($summary_money_visible('total_amount')): ?><td><?php echo e(round($row['final_total'], 2), false); ?></td><?php endif; ?>
                    <?php if($summary_money_visible('total_recovered')): ?><td><?php echo e(round($row['total_amount_recovered'], 2), false); ?></td><?php endif; ?>
                    <?php if($summary_visible('reason')): ?><td><?php echo e($row['additional_notes'], false); ?></td><?php endif; ?>
                    <?php if($summary_visible('added_by')): ?><td><?php echo e($row['added_by'], false); ?></td><?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php
                    $summary_text_cols = 0;
                    foreach (['date', 'ref_no', 'location', 'adjustment_type'] as $key) {
                        if ($summary_visible($key)) $summary_text_cols++;
                    }
                ?>
                <?php if($summary_text_cols > 0): ?><td colspan="<?php echo e($summary_text_cols, false); ?>"><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
                <?php if($summary_money_visible('total_amount')): ?><td><?php echo e(round($totals['final_total'], 2), false); ?></td><?php endif; ?>
                <?php if($summary_money_visible('total_recovered')): ?><td><?php echo e(round($totals['total_amount_recovered'], 2), false); ?></td><?php endif; ?>
                <?php if($summary_visible('reason')): ?><td></td><?php endif; ?>
                <?php if($summary_visible('added_by')): ?><td></td><?php endif; ?>
            </tr>
        <?php elseif($tab === 'detailed'): ?>
            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($row['transaction_date'], false); ?></td>
                    <td><?php echo e($row['ref_no'], false); ?></td>
                    <td><?php echo e($row['location_name'], false); ?></td>
                    <td><?php echo e($row['adjustment_type'], false); ?></td>
                    <td><?php echo e($row['product_name'], false); ?></td>
                    <td><?php echo e($row['sku'], false); ?></td>
                    <td><?php echo e($row['unit'], false); ?></td>
                    <td><?php echo e(round($row['quantity'], 2), false); ?></td>
                    <?php if($show_stock_adjustment_report_cost_value): ?>
                        <td><?php echo e(round($row['unit_price'], 2), false); ?></td>
                        <td><?php echo e(round($row['line_total'], 2), false); ?></td>
                    <?php endif; ?>
                    <td><?php echo e($row['additional_notes'], false); ?></td>
                    <td><?php echo e($row['added_by'], false); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td colspan="7"><?php echo e(__('sale.total'), false); ?>:</td>
                <td><?php echo e(round($totals['quantity'], 2), false); ?></td>
                <?php if($show_stock_adjustment_report_cost_value): ?>
                    <td></td>
                    <td><?php echo e(round($totals['line_total'], 2), false); ?></td>
                <?php endif; ?>
                <td></td>
                <td></td>
            </tr>
        <?php else: ?>
            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($row['product_name'], false); ?></td>
                    <td><?php echo e($row['sku'], false); ?></td>
                    <td><?php echo e($row['unit'], false); ?></td>
                    <td><?php echo e($row['adjustment_count'], false); ?></td>
                    <td><?php echo e(round($row['total_quantity'], 2), false); ?></td>
                    <?php if($show_stock_adjustment_report_cost_value): ?>
                        <td><?php echo e(round($row['total_value'], 2), false); ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td colspan="3"><?php echo e(__('sale.total'), false); ?>:</td>
                <td><?php echo e($totals['adjustment_count'], false); ?></td>
                <td><?php echo e(round($totals['total_quantity'], 2), false); ?></td>
                <?php if($show_stock_adjustment_report_cost_value): ?>
                    <td><?php echo e(round($totals['total_value'], 2), false); ?></td>
                <?php endif; ?>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
