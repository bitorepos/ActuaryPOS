<?php
    $show_variation_column = $show_variation_column ?? true;
    $show_stock_report_cost_value = ! empty($show_stock_report_cost_value);
    $show_stock_report_sale_value = ! empty($show_stock_report_sale_value);
    $show_stock_report_potential_profit = ! empty($show_stock_report_potential_profit);
    $value_column_count = ($show_stock_report_cost_value ? 1 : 0) + ($show_stock_report_sale_value ? 1 : 0) + ($show_stock_report_potential_profit ? 1 : 0);
    $leading_cols = 5 + ($show_variation_column ? 1 : 0) + ($hide_prices ? 0 : 2);
?>
<table>
    <thead>
        <tr>
            <th colspan="<?php echo e($leading_cols + 1 + $value_column_count + 1 + ($show_manufacturing_data ? 1 : 0), false); ?>">
                <?php echo e($business_name, false); ?> — <?php echo e(__('report.stock_report'), false); ?> (<?php echo e($location_name, false); ?>) — <?php echo e($generated_at, false); ?>

            </th>
        </tr>
        <tr>
            <th>#</th>
            <th>SKU</th>
            <th><?php echo e(__('business.product'), false); ?></th>
            <?php if($show_variation_column): ?>
            <th><?php echo e(__('lang_v1.variation'), false); ?></th>
            <?php endif; ?>
            <th><?php echo e(__('product.category'), false); ?></th>
            <th><?php echo e(__('sale.location'), false); ?></th>
            <?php if(!$hide_prices): ?>
            <th><?php echo e(__('purchase.unit_cost_price'), false); ?></th>
            <th><?php echo e(__('purchase.unit_selling_price'), false); ?></th>
            <?php endif; ?>
            <th><?php echo e(__('report.current_stock'), false); ?></th>
            <?php if($show_stock_report_cost_value): ?>
            <th><?php echo e(__('lang_v1.total_stock_price'), false); ?> (<?php echo e(__('lang_v1.by_purchase_price'), false); ?>)</th>
            <?php endif; ?>
            <?php if($show_stock_report_sale_value): ?>
            <th><?php echo e(__('lang_v1.total_stock_price'), false); ?> (<?php echo e(__('lang_v1.by_sale_price'), false); ?>)</th>
            <?php endif; ?>
            <?php if($show_stock_report_potential_profit): ?>
            <th><?php echo e(__('lang_v1.potential_profit'), false); ?></th>
            <?php endif; ?>
            <th><?php echo e(__('report.total_unit_sold'), false); ?></th>
            <?php if($show_manufacturing_data): ?>
            <th><?php echo e(__('manufacturing::lang.current_stock_mfg'), false); ?></th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0; ?>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $i++; ?>
        <tr>
            <td><?php echo e($i, false); ?></td>
            <td><?php echo e($r['sku'], false); ?></td>
            <td><?php echo e($r['product'], false); ?><?php echo e(!empty($r['other_name']) ? ' ('.$r['other_name'].')' : '', false); ?></td>
            <?php if($show_variation_column): ?>
            <td><?php echo e($r['variation'], false); ?></td>
            <?php endif; ?>
            <td><?php echo e($r['category'], false); ?></td>
            <td><?php echo e($r['location'], false); ?></td>
            <?php if(!$hide_prices): ?>
            <td><?php echo e(round($r['cost_price'], 2), false); ?></td>
            <td><?php echo e(round($r['unit_price'], 2), false); ?></td>
            <?php endif; ?>
            <td><?php echo e($r['enable_stock'] ? round($r['stock'], 4).' '.$r['unit'] : '--', false); ?></td>
            <?php if($show_stock_report_cost_value): ?>
            <td><?php echo e(round($r['stock_value_cost'], 2), false); ?></td>
            <?php endif; ?>
            <?php if($show_stock_report_sale_value): ?>
            <td><?php echo e(round($r['stock_value_sale'], 2), false); ?></td>
            <?php endif; ?>
            <?php if($show_stock_report_potential_profit): ?>
            <td><?php echo e(round($r['potential_profit'], 2), false); ?></td>
            <?php endif; ?>
            <td><?php echo e(round($r['total_sold'], 4), false); ?> <?php echo e($r['unit'], false); ?></td>
            <?php if($show_manufacturing_data): ?>
            <td><?php echo e(round($r['total_mfg_stock'], 4), false); ?> <?php echo e($r['unit'], false); ?></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="<?php echo e($leading_cols, false); ?>"><?php echo e(__('sale.total'), false); ?></td>
            <td><?php echo e(round($totals['stock'], 4), false); ?></td>
            <?php if($show_stock_report_cost_value): ?>
            <td><?php echo e(round($totals['stock_value_cost'], 2), false); ?></td>
            <?php endif; ?>
            <?php if($show_stock_report_sale_value): ?>
            <td><?php echo e(round($totals['stock_value_sale'], 2), false); ?></td>
            <?php endif; ?>
            <?php if($show_stock_report_potential_profit): ?>
            <td><?php echo e(round($totals['potential_profit'], 2), false); ?></td>
            <?php endif; ?>
            <td><?php echo e(round($totals['total_sold'], 4), false); ?></td>
            <?php if($show_manufacturing_data): ?>
            <td><?php echo e(round($totals['total_mfg_stock'], 4), false); ?></td>
            <?php endif; ?>
        </tr>
    </tfoot>
</table>
