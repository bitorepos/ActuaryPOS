<?php
    $show_stock_value_report_cost_value = $show_stock_value_report_cost_value ?? ! empty($show_value_columns);
    $show_stock_value_report_sale_value = $show_stock_value_report_sale_value ?? ! empty($show_value_columns);

    $format_qty = function ($unit_quantities) {
        if (empty($unit_quantities)) {
            return '<span class="text-muted">0.00</span>';
        }

        $html = '';
        foreach ($unit_quantities as $unit => $qty) {
            $html .= '<span style="display:inline-block; margin:2px 4px 2px 0;">'
                . e(number_format((float) $qty, 2) . ' ' . $unit)
                . '</span>';
        }

        return $html;
    };

    $format_value = function ($value) {
        return number_format((float) $value, session('business.cost_decimal', 2));
    };
?>

<?php if(count($locations) > 0): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-condensed" style="margin-bottom: 0;">
            <thead>
                <tr class="bg-light-gray" style="background-color: #f5f5f5;">
                    <th><?php echo app('translator')->get('sale.location'); ?></th>
                    <th class="text-right"><?php echo app('translator')->get('product.products'); ?></th>
                    <th class="text-right"><?php echo app('translator')->get('product.variations'); ?></th>
                    <th class="text-right"><?php echo app('translator')->get('report.opening_stock'); ?></th>
                    <?php if($show_stock_value_report_cost_value): ?><th class="text-right"><?php echo app('translator')->get('report.opening_stock_value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                    <th class="text-right"><?php echo app('translator')->get('purchase.purchase'); ?></th>
                    <?php if($show_stock_value_report_cost_value): ?><th class="text-right"><?php echo app('translator')->get('purchase.purchase'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                    <th class="text-right"><?php echo app('translator')->get('purchase.purchase_return'); ?></th>
                    <?php if($show_stock_value_report_cost_value): ?><th class="text-right"><?php echo app('translator')->get('purchase.purchase_return'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                    <?php if($show_manufacturing_data): ?>
                        <th class="text-right"><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</th>
                        <?php if($show_stock_value_report_cost_value): ?><th class="text-right"><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                        <th class="text-right"><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</th>
                        <?php if($show_stock_value_report_cost_value): ?><th class="text-right"><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                    <?php endif; ?>
                    <?php if($show_stock_transfers): ?>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.stock_transfer'); ?></th>
                        <?php if($show_stock_value_report_cost_value): ?><th class="text-right"><?php echo app('translator')->get('lang_v1.stock_transfer'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                    <?php endif; ?>
                    <?php if($show_stock_adjustment): ?>
                        <th class="text-right"><?php echo app('translator')->get('stock_adjustment.stock_adjustment'); ?></th>
                        <?php if($show_stock_value_report_cost_value): ?><th class="text-right"><?php echo app('translator')->get('stock_adjustment.stock_adjustment'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                    <?php endif; ?>
                    <th class="text-right"><?php echo app('translator')->get('sale.sale'); ?></th>
                    <?php if($show_stock_value_report_sale_value): ?><th class="text-right"><?php echo app('translator')->get('sale.sale'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                    <th class="text-right"><?php echo app('translator')->get('sale.sale'); ?> <?php echo app('translator')->get('sale.return'); ?></th>
                    <?php if($show_stock_value_report_sale_value): ?><th class="text-right"><?php echo app('translator')->get('sale.sale'); ?> <?php echo app('translator')->get('sale.return'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                    <th class="text-right"><?php echo app('translator')->get('report.current_stock'); ?></th>
                    <?php if($show_stock_value_report_cost_value): ?><th class="text-right"><?php echo app('translator')->get('lang_v1.total_stock_price'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($location['location_name'], false); ?></td>
                        <td class="text-right"><?php echo e($location['product_count'], false); ?></td>
                        <td class="text-right"><?php echo e($location['variation_count'], false); ?></td>
                        <td class="text-right"><?php echo $format_qty($location['quantities']['opening_stock']); ?></td>
                        <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e($format_value($location['values']['opening_stock_value']), false); ?></td><?php endif; ?>
                        <td class="text-right"><?php echo $format_qty($location['quantities']['purchase']); ?></td>
                        <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e($format_value($location['values']['purchase_value']), false); ?></td><?php endif; ?>
                        <td class="text-right"><?php echo $format_qty($location['quantities']['purchase_return']); ?></td>
                        <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e($format_value($location['values']['purchase_return_value']), false); ?></td><?php endif; ?>
                        <?php if($show_manufacturing_data): ?>
                            <td class="text-right"><?php echo $format_qty($location['quantities']['manufacturing']); ?></td>
                            <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e($format_value($location['values']['manufacturing_value']), false); ?></td><?php endif; ?>
                            <td class="text-right"><?php echo $format_qty($location['quantities']['ingredient']); ?></td>
                            <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e($format_value($location['values']['ingredient_value']), false); ?></td><?php endif; ?>
                        <?php endif; ?>
                        <?php if($show_stock_transfers): ?>
                            <td class="text-right"><?php echo $format_qty($location['quantities']['stock_transfer']); ?></td>
                            <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e($format_value($location['values']['stock_transfer_value']), false); ?></td><?php endif; ?>
                        <?php endif; ?>
                        <?php if($show_stock_adjustment): ?>
                            <td class="text-right"><?php echo $format_qty($location['quantities']['stock_adjustment']); ?></td>
                            <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e($format_value($location['values']['stock_adjustment_value']), false); ?></td><?php endif; ?>
                        <?php endif; ?>
                        <td class="text-right"><?php echo $format_qty($location['quantities']['sales']); ?></td>
                        <?php if($show_stock_value_report_sale_value): ?><td class="text-right"><?php echo e($format_value($location['values']['sales_value']), false); ?></td><?php endif; ?>
                        <td class="text-right"><?php echo $format_qty($location['quantities']['sales_return']); ?></td>
                        <?php if($show_stock_value_report_sale_value): ?><td class="text-right"><?php echo e($format_value($location['values']['sales_return_value']), false); ?></td><?php endif; ?>
                        <td class="text-right"><?php echo $format_qty($location['quantities']['current_stock']); ?></td>
                        <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><?php echo e($format_value($location['values']['current_stock_value']), false); ?></td><?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr style="background-color: #d9edf7; font-size: 14px;">
                    <td><strong><?php echo app('translator')->get('lang_v1.grand_total'); ?>:</strong></td>
                    <td class="text-right"><strong><?php echo e($grand_product_count, false); ?></strong></td>
                    <td class="text-right"><strong><?php echo e($grand_variation_count, false); ?></strong></td>
                    <td class="text-right"><strong><?php echo $format_qty($grand_quantities['opening_stock']); ?></strong></td>
                    <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><strong><?php echo e($format_value($grand_values['opening_stock_value']), false); ?></strong></td><?php endif; ?>
                    <td class="text-right"><strong><?php echo $format_qty($grand_quantities['purchase']); ?></strong></td>
                    <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><strong><?php echo e($format_value($grand_values['purchase_value']), false); ?></strong></td><?php endif; ?>
                    <td class="text-right"><strong><?php echo $format_qty($grand_quantities['purchase_return']); ?></strong></td>
                    <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><strong><?php echo e($format_value($grand_values['purchase_return_value']), false); ?></strong></td><?php endif; ?>
                    <?php if($show_manufacturing_data): ?>
                        <td class="text-right"><strong><?php echo $format_qty($grand_quantities['manufacturing']); ?></strong></td>
                        <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><strong><?php echo e($format_value($grand_values['manufacturing_value']), false); ?></strong></td><?php endif; ?>
                        <td class="text-right"><strong><?php echo $format_qty($grand_quantities['ingredient']); ?></strong></td>
                        <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><strong><?php echo e($format_value($grand_values['ingredient_value']), false); ?></strong></td><?php endif; ?>
                    <?php endif; ?>
                    <?php if($show_stock_transfers): ?>
                        <td class="text-right"><strong><?php echo $format_qty($grand_quantities['stock_transfer']); ?></strong></td>
                        <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><strong><?php echo e($format_value($grand_values['stock_transfer_value']), false); ?></strong></td><?php endif; ?>
                    <?php endif; ?>
                    <?php if($show_stock_adjustment): ?>
                        <td class="text-right"><strong><?php echo $format_qty($grand_quantities['stock_adjustment']); ?></strong></td>
                        <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><strong><?php echo e($format_value($grand_values['stock_adjustment_value']), false); ?></strong></td><?php endif; ?>
                    <?php endif; ?>
                    <td class="text-right"><strong><?php echo $format_qty($grand_quantities['sales']); ?></strong></td>
                    <?php if($show_stock_value_report_sale_value): ?><td class="text-right"><strong><?php echo e($format_value($grand_values['sales_value']), false); ?></strong></td><?php endif; ?>
                    <td class="text-right"><strong><?php echo $format_qty($grand_quantities['sales_return']); ?></strong></td>
                    <?php if($show_stock_value_report_sale_value): ?><td class="text-right"><strong><?php echo e($format_value($grand_values['sales_return_value']), false); ?></strong></td><?php endif; ?>
                    <td class="text-right"><strong><?php echo $format_qty($grand_quantities['current_stock']); ?></strong></td>
                    <?php if($show_stock_value_report_cost_value): ?><td class="text-right"><strong><?php echo e($format_value($grand_values['current_stock_value']), false); ?></strong></td><?php endif; ?>
                </tr>
            </tfoot>
        </table>
    </div>
<?php else: ?>
    <div class="text-center py-4">
        <p class="text-muted"><?php echo app('translator')->get('lang_v1.no_data_available'); ?></p>
    </div>
<?php endif; ?>
