<table>
    <thead>
        <tr>
            <th colspan="14"><?php echo e($business_name, false); ?> - <?php echo e(__('report.mismatch_report'), false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <tr>
            <th>#</th>
            <th><?php echo e(__('business.product'), false); ?></th>
            <th>SKU</th>
            <th>Variation ID</th>
            <th><?php echo e(__('purchase.purchase'), false); ?> Qty</th>
            <th><?php echo e(__('purchase.purchase'), false); ?> Returned</th>
            <th><?php echo e(__('purchase.purchase'), false); ?> Sold</th>
            <th><?php echo e(__('purchase.purchase'), false); ?> Adjusted</th>
            <th><?php echo e(__('purchase.purchase'), false); ?> Mfg Used</th>
            <th>Purchase Qty Avlb</th>
            <th><?php echo e(__('sale.sale'), false); ?> Qty</th>
            <th><?php echo e(__('sale.sale'), false); ?> Returned</th>
            <th>Sell Net Qty</th>
            <th>VLD Qty</th>
            <th>Mismatch</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($row['index'], false); ?></td>
                <td><?php echo e($row['product_name'], false); ?></td>
                <td><?php echo e($row['sku'], false); ?></td>
                <td><?php echo e($row['variation_id'], false); ?></td>
                <td><?php echo e(round($row['pl_qty'], 2), false); ?></td>
                <td><?php echo e(round($row['pl_qty_returned'], 2), false); ?></td>
                <td><?php echo e(round($row['pl_qty_sold'], 2), false); ?></td>
                <td><?php echo e(round(-1 * $row['pl_qty_adjusted'], 2), false); ?></td>
                <td><?php echo e(round($row['pl_qty_mfg'], 2), false); ?></td>
                <td><?php echo e(round($row['pl_qty_avlb'], 2), false); ?></td>
                <td><?php echo e(round($row['sl_qty'], 2), false); ?></td>
                <td><?php echo e(round($row['sl_qty_returned'], 2), false); ?></td>
                <td><?php echo e(round($row['sl_qty_avlb'], 2), false); ?></td>
                <td><?php echo e(round($row['vld_qty'], 2), false); ?></td>
                <td><?php echo e(round($row['mismatch_qty'], 2), false); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td colspan="4"><?php echo e(__('sale.total'), false); ?>:</td>
            <td><?php echo e(round($totals['pl_qty'], 2), false); ?></td>
            <td><?php echo e(round($totals['pl_qty_returned'], 2), false); ?></td>
            <td><?php echo e(round($totals['pl_qty_sold'], 2), false); ?></td>
            <td><?php echo e(round(-1 * $totals['pl_qty_adjusted'], 2), false); ?></td>
            <td><?php echo e(round($totals['pl_qty_mfg'], 2), false); ?></td>
            <td><?php echo e(round($totals['pl_qty_avlb'], 2), false); ?></td>
            <td><?php echo e(round($totals['sl_qty'], 2), false); ?></td>
            <td><?php echo e(round($totals['sl_qty_returned'], 2), false); ?></td>
            <td><?php echo e(round($totals['sl_qty_avlb'], 2), false); ?></td>
            <td><?php echo e(round($totals['vld_qty'], 2), false); ?></td>
            <td><?php echo e(round($totals['mismatch_qty'], 2), false); ?></td>
        </tr>
    </tbody>
</table>
