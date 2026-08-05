<?php
    $is_excel = $is_excel ?? false;
    $us = $user_settings ?? [];
    $format_qty = function ($value) {
        return number_format((float) $value, 2);
    };
    $format_value = function ($value) {
        return number_format((float) $value, session('business.cost_decimal', 2));
    };
    $show_stock_value_report_cost_value = $show_stock_value_report_cost_value ?? ! empty($show_value_columns);
    $show_stock_value_report_sale_value = $show_stock_value_report_sale_value ?? ! empty($show_value_columns);
    $visibilityContext = $column_visibility_context ?? null;
    $visibilityCategoryKey = $visibilityContext === 'daily_closing' ? 'admin' : 'stock';
    $visibilityReportKey = $visibilityContext === 'daily_closing' ? 'dcsval' : 'sval';
    $useLocationVisibility = $visibilityContext === 'daily_closing';
    $visibilityLocationIds = [];
    if ($useLocationVisibility) {
        foreach (($locations ?? []) as $locationKey => $location) {
            $visibilityLocationId = $location['location_id'] ?? (is_numeric($locationKey) ? $locationKey : null);
            if ($visibilityLocationId !== null && $visibilityLocationId !== '') {
                $visibilityLocationIds[] = $visibilityLocationId;
            }
        }
    }

    $resolveVisibility = function ($locationId = null) use ($us, $visibilityCategoryKey, $visibilityReportKey, $useLocationVisibility, $visibilityLocationIds, $show_variation_column, $show_manufacturing_data, $show_stock_transfers, $show_stock_adjustment, $show_stock_value_report_cost_value, $show_stock_value_report_sale_value) {
        $column_visible = function ($key) use ($us, $visibilityCategoryKey, $visibilityReportKey, $useLocationVisibility, $visibilityLocationIds, $locationId) {
            if ($useLocationVisibility && $locationId !== null && $locationId !== '') {
                $locationSettingKey = 'rpt_'.$visibilityCategoryKey.'_'.$visibilityReportKey.'_loc_'.$locationId.'_hide_'.$key;
                if (array_key_exists($locationSettingKey, $us)) {
                    return empty($us[$locationSettingKey]);
                }
            }

            if ($useLocationVisibility && ($locationId === null || $locationId === '')) {
                foreach ($visibilityLocationIds as $visibilityLocationId) {
                    $locationSettingKey = 'rpt_'.$visibilityCategoryKey.'_'.$visibilityReportKey.'_loc_'.$visibilityLocationId.'_hide_'.$key;
                    if (! empty($us[$locationSettingKey])) {
                        return false;
                    }
                }
            }

            return empty($us['rpt_'.$visibilityCategoryKey.'_'.$visibilityReportKey.'_hide_'.$key]);
        };

        $show_sku = $column_visible('sku');
        $show_product = $column_visible('product');
        $show_unit = $column_visible('unit');
        $show_variation = ($show_variation_column ?? true) && $column_visible('variation');
        $show_location = $column_visible('location');
        $show_opening_stock = $column_visible('opening_stock');
        $show_opening_stock_value = $show_stock_value_report_cost_value && $column_visible('opening_stock_value');
        $show_purchase = $column_visible('purchase');
        $show_purchase_value = $show_stock_value_report_cost_value && $column_visible('purchase_value');
        $show_purchase_return = $column_visible('purchase_return');
        $show_purchase_return_value = $show_stock_value_report_cost_value && $column_visible('purchase_return_value');
        $show_manufacturing = $show_manufacturing_data && $column_visible('manufacturing');
        $show_manufacturing_value = $show_manufacturing_data && $show_stock_value_report_cost_value && $column_visible('manufacturing_value');
        $show_ingredient = $show_manufacturing_data && $column_visible('ingredient');
        $show_ingredient_value = $show_manufacturing_data && $show_stock_value_report_cost_value && $column_visible('ingredient_value');
        $show_stock_transfer = $show_stock_transfers && $column_visible('stock_transfer');
        $show_stock_transfer_value = $show_stock_transfers && $show_stock_value_report_cost_value && $column_visible('stock_transfer_value');
        $show_stock_adjustment_col = $show_stock_adjustment && $column_visible('stock_adjustment');
        $show_stock_adjustment_value = $show_stock_adjustment && $show_stock_value_report_cost_value && $column_visible('stock_adjustment_value');
        $show_sale = $column_visible('sale');
        $show_sale_value = $show_stock_value_report_sale_value && $column_visible('sale_value');
        $show_sale_return = $column_visible('sale_return');
        $show_sale_return_value = $show_stock_value_report_sale_value && $column_visible('sale_return_value');
        $show_current_stock = $column_visible('current_stock');
        $show_total_stock_price = $show_stock_value_report_cost_value && $column_visible('total_stock_price');

        $text_cols = 0;
        if ($show_sku) $text_cols++;
        if ($show_product) $text_cols++;
        if ($show_unit) $text_cols++;
        if ($show_variation) $text_cols++;
        if ($show_location) $text_cols++;

        $column_count = $text_cols;
        foreach ([
            $show_opening_stock, $show_opening_stock_value, $show_purchase, $show_purchase_value,
            $show_purchase_return, $show_purchase_return_value,
            $show_manufacturing, $show_manufacturing_value,
            $show_ingredient, $show_ingredient_value,
            $show_stock_transfer, $show_stock_transfer_value,
            $show_stock_adjustment_col, $show_stock_adjustment_value,
            $show_sale, $show_sale_value, $show_sale_return, $show_sale_return_value,
            $show_current_stock, $show_total_stock_price,
        ] as $visible) {
            if ($visible) $column_count++;
        }

        return compact(
            'show_sku',
            'show_product',
            'show_unit',
            'show_variation',
            'show_location',
            'show_opening_stock',
            'show_opening_stock_value',
            'show_purchase',
            'show_purchase_value',
            'show_purchase_return',
            'show_purchase_return_value',
            'show_manufacturing',
            'show_manufacturing_value',
            'show_ingredient',
            'show_ingredient_value',
            'show_stock_transfer',
            'show_stock_transfer_value',
            'show_stock_adjustment_col',
            'show_stock_adjustment_value',
            'show_sale',
            'show_sale_value',
            'show_sale_return',
            'show_sale_return_value',
            'show_current_stock',
            'show_total_stock_price',
            'text_cols',
            'column_count'
        );
    };
?>

<?php if(count($locations) > 0): ?>
    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locationKey => $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $locationId = $location['location_id'] ?? (is_numeric($locationKey) ? $locationKey : null);
            extract($resolveVisibility($locationId));
        ?>
        <?php if($is_excel): ?>
            <table>
                <tr>
                    <td colspan="<?php echo e($column_count, false); ?>" style="background-color:#3c8dbc; color:#ffffff; font-weight:bold;">
                        <?php echo e($location['location_name'], false); ?> (<?php echo e(count($location['products']), false); ?> <?php echo app('translator')->get('product.products'); ?>)
                    </td>
                </tr>
            </table>
        <?php else: ?>
            <div class="card mb-2 sv-location-detail-section">
                <div class="card-header bg-primary" style="background-color: #3c8dbc !important; padding: 8px 15px;">
                    <h4 class="mb-0 text-white" style="margin:0; font-size: 16px; font-weight: 600;">
                        <i class="fas fa-map-marker-alt"></i> <?php echo e($location['location_name'], false); ?>

                        <span class="pull-right" style="font-size: 12px; font-weight: normal;"><?php echo e(count($location['products']), false); ?> <?php echo app('translator')->get('product.products'); ?></span>
                    </h4>
                </div>
                <div class="card-body" style="padding: 0;">
        <?php endif; ?>

        <div class="<?php echo e($is_excel ? '' : 'table-responsive', false); ?>">
            <table class="table table-bordered table-striped table-condensed" style="margin-bottom: <?php echo e($is_excel ? '10px' : '0', false); ?>; font-size: 12px;">
                <thead>
                    <tr class="bg-light-gray" style="background-color: #f5f5f5; font-weight: bold;">
                        <?php if($show_sku): ?><th>SKU</th><?php endif; ?>
                        <?php if($show_product): ?><th><?php echo app('translator')->get('business.product'); ?></th><?php endif; ?>
                        <?php if($show_unit): ?><th><?php echo app('translator')->get('product.unit'); ?></th><?php endif; ?>
                        <?php if($show_variation): ?><th><?php echo app('translator')->get('lang_v1.variation'); ?></th><?php endif; ?>
                        <?php if($show_location): ?><th><?php echo app('translator')->get('sale.location'); ?></th><?php endif; ?>
                        <?php if($show_opening_stock): ?><th class="text-right"><?php echo app('translator')->get('report.opening_stock'); ?></th><?php endif; ?>
                        <?php if($show_opening_stock_value): ?><th class="text-right"><?php echo app('translator')->get('report.opening_stock_value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                        <?php if($show_purchase): ?><th class="text-right"><?php echo app('translator')->get('purchase.purchase'); ?></th><?php endif; ?>
                        <?php if($show_purchase_value): ?><th class="text-right"><?php echo app('translator')->get('purchase.purchase'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                        <?php if($show_purchase_return): ?><th class="text-right"><?php echo app('translator')->get('purchase.purchase_return'); ?></th><?php endif; ?>
                        <?php if($show_purchase_return_value): ?><th class="text-right"><?php echo app('translator')->get('purchase.purchase_return'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                        <?php if($show_manufacturing): ?>
                            <th class="text-right"><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</th>
                            <?php if($show_manufacturing_value): ?><th class="text-right"><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                        <?php endif; ?>
                        <?php if($show_ingredient): ?><th class="text-right"><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</th><?php endif; ?>
                        <?php if($show_ingredient_value): ?><th class="text-right"><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                        <?php if($show_stock_transfer): ?><th class="text-right"><?php echo app('translator')->get('lang_v1.stock_transfer'); ?></th><?php endif; ?>
                        <?php if($show_stock_transfer_value): ?><th class="text-right"><?php echo app('translator')->get('lang_v1.stock_transfer'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                        <?php if($show_stock_adjustment_col): ?><th class="text-right"><?php echo app('translator')->get('stock_adjustment.stock_adjustment'); ?></th><?php endif; ?>
                        <?php if($show_stock_adjustment_value): ?><th class="text-right"><?php echo app('translator')->get('stock_adjustment.stock_adjustment'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                        <?php if($show_sale): ?><th class="text-right"><?php echo app('translator')->get('sale.sale'); ?></th><?php endif; ?>
                        <?php if($show_sale_value): ?><th class="text-right"><?php echo app('translator')->get('sale.sale'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                        <?php if($show_sale_return): ?><th class="text-right"><?php echo app('translator')->get('sale.sale'); ?> <?php echo app('translator')->get('sale.return'); ?></th><?php endif; ?>
                        <?php if($show_sale_return_value): ?><th class="text-right"><?php echo app('translator')->get('sale.sale'); ?> <?php echo app('translator')->get('sale.return'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                        <?php if($show_current_stock): ?><th class="text-right"><?php echo app('translator')->get('report.current_stock'); ?></th><?php endif; ?>
                        <?php if($show_total_stock_price): ?><th class="text-right"><?php echo app('translator')->get('lang_v1.total_stock_price'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $location['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="<?php echo e(!empty($product['is_low_stock']) && !$is_excel ? 'bg-danger' : '', false); ?>">
                            <?php if($show_sku): ?><td><?php echo e($product['sku'], false); ?></td><?php endif; ?>
                            <?php if($show_product): ?><td><?php echo e($product['product_name'], false); ?></td><?php endif; ?>
                            <?php if($show_unit): ?><td><?php echo e($product['unit'], false); ?></td><?php endif; ?>
                            <?php if($show_variation): ?><td><?php echo e($product['variation'], false); ?></td><?php endif; ?>
                            <?php if($show_location): ?><td><?php echo e($product['location_name'], false); ?></td><?php endif; ?>
                            <?php if($show_opening_stock): ?><td class="text-right"><?php echo e($format_qty($product['opening_stock']), false); ?></td><?php endif; ?>
                            <?php if($show_opening_stock_value): ?><td class="text-right"><?php echo e($format_value($product['opening_stock_value']), false); ?></td><?php endif; ?>
                            <?php if($show_purchase): ?><td class="text-right"><?php echo e($format_qty($product['purchase']), false); ?></td><?php endif; ?>
                            <?php if($show_purchase_value): ?><td class="text-right"><?php echo e($format_value($product['purchase_value']), false); ?></td><?php endif; ?>
                            <?php if($show_purchase_return): ?><td class="text-right"><?php echo e($format_qty($product['purchase_return']), false); ?></td><?php endif; ?>
                            <?php if($show_purchase_return_value): ?><td class="text-right"><?php echo e($format_value($product['purchase_return_value']), false); ?></td><?php endif; ?>
                            <?php if($show_manufacturing): ?>
                                <td class="text-right"><?php echo e($format_qty($product['manufacturing']), false); ?></td>
                                <?php if($show_manufacturing_value): ?><td class="text-right"><?php echo e($format_value($product['manufacturing_value']), false); ?></td><?php endif; ?>
                            <?php endif; ?>
                            <?php if($show_ingredient): ?><td class="text-right"><?php echo e($format_qty($product['ingredient']), false); ?></td><?php endif; ?>
                            <?php if($show_ingredient_value): ?><td class="text-right"><?php echo e($format_value($product['ingredient_value']), false); ?></td><?php endif; ?>
                            <?php if($show_stock_transfer): ?><td class="text-right"><?php echo e($format_qty($product['stock_transfer']), false); ?></td><?php endif; ?>
                            <?php if($show_stock_transfer_value): ?><td class="text-right"><?php echo e($format_value($product['stock_transfer_value']), false); ?></td><?php endif; ?>
                            <?php if($show_stock_adjustment_col): ?><td class="text-right"><?php echo e($format_qty($product['stock_adjustment']), false); ?></td><?php endif; ?>
                            <?php if($show_stock_adjustment_value): ?><td class="text-right"><?php echo e($format_value($product['stock_adjustment_value']), false); ?></td><?php endif; ?>
                            <?php if($show_sale): ?><td class="text-right"><?php echo e($format_qty($product['sales']), false); ?></td><?php endif; ?>
                            <?php if($show_sale_value): ?><td class="text-right"><?php echo e($format_value($product['sales_value']), false); ?></td><?php endif; ?>
                            <?php if($show_sale_return): ?><td class="text-right"><?php echo e($format_qty($product['sales_return']), false); ?></td><?php endif; ?>
                            <?php if($show_sale_return_value): ?><td class="text-right"><?php echo e($format_value($product['sales_return_value']), false); ?></td><?php endif; ?>
                            <?php if($show_current_stock): ?><td class="text-right"><?php echo e($format_qty($product['current_stock']), false); ?></td><?php endif; ?>
                            <?php if($show_total_stock_price): ?><td class="text-right"><?php echo e($format_value($product['current_stock_value']), false); ?></td><?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr style="background-color: #eef7ff; font-weight: bold;">
                        <?php if($text_cols > 0): ?><td colspan="<?php echo e($text_cols, false); ?>" class="text-right"><?php echo app('translator')->get('sale.total'); ?>:</td><?php endif; ?>
                        <?php if($show_opening_stock): ?><td class="text-right"><?php echo e($format_qty($location['totals']['opening_stock']), false); ?></td><?php endif; ?>
                        <?php if($show_opening_stock_value): ?><td class="text-right"><?php echo e($format_value($location['totals']['opening_stock_value']), false); ?></td><?php endif; ?>
                        <?php if($show_purchase): ?><td class="text-right"><?php echo e($format_qty($location['totals']['purchase']), false); ?></td><?php endif; ?>
                        <?php if($show_purchase_value): ?><td class="text-right"><?php echo e($format_value($location['totals']['purchase_value']), false); ?></td><?php endif; ?>
                        <?php if($show_purchase_return): ?><td class="text-right"><?php echo e($format_qty($location['totals']['purchase_return']), false); ?></td><?php endif; ?>
                        <?php if($show_purchase_return_value): ?><td class="text-right"><?php echo e($format_value($location['totals']['purchase_return_value']), false); ?></td><?php endif; ?>
                        <?php if($show_manufacturing): ?>
                            <td class="text-right"><?php echo e($format_qty($location['totals']['manufacturing']), false); ?></td>
                            <?php if($show_manufacturing_value): ?><td class="text-right"><?php echo e($format_value($location['totals']['manufacturing_value']), false); ?></td><?php endif; ?>
                        <?php endif; ?>
                        <?php if($show_ingredient): ?><td class="text-right"><?php echo e($format_qty($location['totals']['ingredient']), false); ?></td><?php endif; ?>
                        <?php if($show_ingredient_value): ?><td class="text-right"><?php echo e($format_value($location['totals']['ingredient_value']), false); ?></td><?php endif; ?>
                        <?php if($show_stock_transfer): ?><td class="text-right"><?php echo e($format_qty($location['totals']['stock_transfer']), false); ?></td><?php endif; ?>
                        <?php if($show_stock_transfer_value): ?><td class="text-right"><?php echo e($format_value($location['totals']['stock_transfer_value']), false); ?></td><?php endif; ?>
                        <?php if($show_stock_adjustment_col): ?><td class="text-right"><?php echo e($format_qty($location['totals']['stock_adjustment']), false); ?></td><?php endif; ?>
                        <?php if($show_stock_adjustment_value): ?><td class="text-right"><?php echo e($format_value($location['totals']['stock_adjustment_value']), false); ?></td><?php endif; ?>
                        <?php if($show_sale): ?><td class="text-right"><?php echo e($format_qty($location['totals']['sales']), false); ?></td><?php endif; ?>
                        <?php if($show_sale_value): ?><td class="text-right"><?php echo e($format_value($location['totals']['sales_value']), false); ?></td><?php endif; ?>
                        <?php if($show_sale_return): ?><td class="text-right"><?php echo e($format_qty($location['totals']['sales_return']), false); ?></td><?php endif; ?>
                        <?php if($show_sale_return_value): ?><td class="text-right"><?php echo e($format_value($location['totals']['sales_return_value']), false); ?></td><?php endif; ?>
                        <?php if($show_current_stock): ?><td class="text-right"><?php echo e($format_qty($location['totals']['current_stock']), false); ?></td><?php endif; ?>
                        <?php if($show_total_stock_price): ?><td class="text-right"><?php echo e($format_value($location['totals']['current_stock_value']), false); ?></td><?php endif; ?>
                    </tr>
                </tfoot>
            </table>
        </div>

        <?php if(!$is_excel): ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php if(($column_visibility_context ?? '') !== 'daily_closing'): ?>
        <?php extract($resolveVisibility(null)); ?>
        <div class="<?php echo e($is_excel ? '' : 'table-responsive', false); ?>" style="margin-top: <?php echo e($is_excel ? '0' : '10px', false); ?>;">
            <table class="table table-bordered table-condensed" style="margin-bottom: 0; font-size: 12px;">
                <tfoot>
                    <tr style="background-color: #d9edf7; font-weight: bold;">
                        <?php if($text_cols > 0): ?><td colspan="<?php echo e($text_cols, false); ?>" class="text-right"><?php echo app('translator')->get('lang_v1.grand_total'); ?>:</td><?php endif; ?>
                        <?php if($show_opening_stock): ?><td class="text-right"><?php echo e($format_qty($grand_totals['opening_stock']), false); ?></td><?php endif; ?>
                        <?php if($show_opening_stock_value): ?><td class="text-right"><?php echo e($format_value($grand_totals['opening_stock_value']), false); ?></td><?php endif; ?>
                        <?php if($show_purchase): ?><td class="text-right"><?php echo e($format_qty($grand_totals['purchase']), false); ?></td><?php endif; ?>
                        <?php if($show_purchase_value): ?><td class="text-right"><?php echo e($format_value($grand_totals['purchase_value']), false); ?></td><?php endif; ?>
                        <?php if($show_purchase_return): ?><td class="text-right"><?php echo e($format_qty($grand_totals['purchase_return']), false); ?></td><?php endif; ?>
                        <?php if($show_purchase_return_value): ?><td class="text-right"><?php echo e($format_value($grand_totals['purchase_return_value']), false); ?></td><?php endif; ?>
                        <?php if($show_manufacturing): ?>
                            <td class="text-right"><?php echo e($format_qty($grand_totals['manufacturing']), false); ?></td>
                            <?php if($show_manufacturing_value): ?><td class="text-right"><?php echo e($format_value($grand_totals['manufacturing_value']), false); ?></td><?php endif; ?>
                        <?php endif; ?>
                        <?php if($show_ingredient): ?><td class="text-right"><?php echo e($format_qty($grand_totals['ingredient']), false); ?></td><?php endif; ?>
                        <?php if($show_ingredient_value): ?><td class="text-right"><?php echo e($format_value($grand_totals['ingredient_value']), false); ?></td><?php endif; ?>
                        <?php if($show_stock_transfer): ?><td class="text-right"><?php echo e($format_qty($grand_totals['stock_transfer']), false); ?></td><?php endif; ?>
                        <?php if($show_stock_transfer_value): ?><td class="text-right"><?php echo e($format_value($grand_totals['stock_transfer_value']), false); ?></td><?php endif; ?>
                        <?php if($show_stock_adjustment_col): ?><td class="text-right"><?php echo e($format_qty($grand_totals['stock_adjustment']), false); ?></td><?php endif; ?>
                        <?php if($show_stock_adjustment_value): ?><td class="text-right"><?php echo e($format_value($grand_totals['stock_adjustment_value']), false); ?></td><?php endif; ?>
                        <?php if($show_sale): ?><td class="text-right"><?php echo e($format_qty($grand_totals['sales']), false); ?></td><?php endif; ?>
                        <?php if($show_sale_value): ?><td class="text-right"><?php echo e($format_value($grand_totals['sales_value']), false); ?></td><?php endif; ?>
                        <?php if($show_sale_return): ?><td class="text-right"><?php echo e($format_qty($grand_totals['sales_return']), false); ?></td><?php endif; ?>
                        <?php if($show_sale_return_value): ?><td class="text-right"><?php echo e($format_value($grand_totals['sales_return_value']), false); ?></td><?php endif; ?>
                        <?php if($show_current_stock): ?><td class="text-right"><?php echo e($format_qty($grand_totals['current_stock']), false); ?></td><?php endif; ?>
                        <?php if($show_total_stock_price): ?><td class="text-right"><?php echo e($format_value($grand_totals['current_stock_value']), false); ?></td><?php endif; ?>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php endif; ?>
<?php else: ?>
    <div class="text-center py-4">
        <p class="text-muted"><?php echo app('translator')->get('lang_v1.no_data_available'); ?></p>
    </div>
<?php endif; ?>
