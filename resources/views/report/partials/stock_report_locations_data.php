<?php
    $format_qty = function ($qty) {
        return number_format((float) $qty, 2);
    };

    $format_value = function ($value) {
        return number_format((float) $value, session('business.cost_decimal', 2));
    };

    $show_stock_report_cost_value = ! empty($show_stock_report_cost_value);
    $show_stock_report_sale_value = ! empty($show_stock_report_sale_value);
    $show_stock_report_potential_profit = ! empty($show_stock_report_potential_profit);
?>

<?php if(count($locations) > 0): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-condensed" style="margin-bottom: 0;">
            <thead>
                <tr class="bg-light-gray" style="background-color: #f5f5f5;">
                    <th><?php echo app('translator')->get('sale.location'); ?></th>
                    <th class="text-right" style="width: 120px;"><?php echo app('translator')->get('product.products'); ?></th>
                    <th class="text-right" style="width: 120px;"><?php echo app('translator')->get('product.variations'); ?></th>
                    <th>Quantity Summary</th>
                    <?php if($show_stock_report_cost_value): ?>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.total_stock_price'); ?> <br><small>(<?php echo app('translator')->get('lang_v1.by_purchase_price'); ?>)</small></th>
                    <?php endif; ?>
                    <?php if($show_stock_report_sale_value): ?>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.total_stock_price'); ?> <br><small>(<?php echo app('translator')->get('lang_v1.by_sale_price'); ?>)</small></th>
                    <?php endif; ?>
                    <?php if($show_stock_report_potential_profit): ?>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.potential_profit'); ?></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($location['location_name'], false); ?></td>
                        <td class="text-right"><?php echo e($location['product_count'], false); ?></td>
                        <td class="text-right"><?php echo e($location['variation_count'], false); ?></td>
                        <td>
                            <?php $__currentLoopData = $location['unit_quantities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit => $qty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span style="display: inline-block; margin: 2px 4px 2px 0;">
                                    <?php echo e($format_qty($qty), false); ?> <?php echo e($unit, false); ?>

                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <?php if($show_stock_report_cost_value): ?>
                            <td class="text-right"><?php echo e($format_value($location['total_purchase_value']), false); ?></td>
                        <?php endif; ?>
                        <?php if($show_stock_report_sale_value): ?>
                            <td class="text-right"><?php echo e($format_value($location['total_sale_value']), false); ?></td>
                        <?php endif; ?>
                        <?php if($show_stock_report_potential_profit): ?>
                            <td class="text-right"><?php echo e($format_value($location['potential_profit']), false); ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr style="background-color: #d9edf7; font-size: 14px;">
                    <td><strong><?php echo app('translator')->get('lang_v1.grand_total'); ?>:</strong></td>
                    <td class="text-right"><strong><?php echo e($grand_product_count, false); ?></strong></td>
                    <td class="text-right"><strong><?php echo e($grand_variation_count, false); ?></strong></td>
                    <td>
                        <?php $__currentLoopData = $grand_unit_quantities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit => $qty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span style="display: inline-block; margin: 2px 4px 2px 0;">
                                <?php echo e($format_qty($qty), false); ?> <?php echo e($unit, false); ?>

                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <?php if($show_stock_report_cost_value): ?>
                        <td class="text-right"><strong><?php echo e($format_value($grand_total_purchase_value), false); ?></strong></td>
                    <?php endif; ?>
                    <?php if($show_stock_report_sale_value): ?>
                        <td class="text-right"><strong><?php echo e($format_value($grand_total_sale_value), false); ?></strong></td>
                    <?php endif; ?>
                    <?php if($show_stock_report_potential_profit): ?>
                        <td class="text-right"><strong><?php echo e($format_value($grand_potential_profit), false); ?></strong></td>
                    <?php endif; ?>
                </tr>
            </tfoot>
        </table>
    </div>
<?php else: ?>
    <div class="text-center py-4">
        <p class="text-muted"><?php echo app('translator')->get('lang_v1.no_data_available'); ?></p>
    </div>
<?php endif; ?>
