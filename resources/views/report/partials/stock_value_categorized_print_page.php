<?php
    $categorized_print_page = $categorized_print_page ?? [];
    $page_type = $categorized_print_page['type'] ?? 'subcategory';
    $page_rows = $categorized_print_page['products'] ?? [];
    $page_totals = $categorized_print_page['totals'] ?? [];
    $us = $user_settings ?? [];
    $column_visible = function ($key) use ($us) {
        return empty($us['rpt_stock_svalcat_hide_'.$key]);
    };
    $show_stock_value_report_cost_value = $show_stock_value_report_cost_value ?? ! empty($show_value_columns);
    $show_stock_value_report_sale_value = $show_stock_value_report_sale_value ?? ! empty($show_value_columns);

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
    $show_manufacturing_col = $show_manufacturing_data && $column_visible('manufacturing');
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
?>

<?php if($page_type === 'empty'): ?>
    <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
<?php else: ?>
    <div class="cr-group-title">
        <h4>
            <?php echo e($categorized_print_page['category_name'], false); ?>

            <?php if($page_type === 'subcategory'): ?>
                <span style="float:right; font-size:6pt; font-weight:400;">
                    <?php echo e($categorized_print_page['sub_category_name'], false); ?>

                    | <?php echo e($categorized_print_page['product_count'] ?? count($page_rows), false); ?> <?php echo app('translator')->get('product.products'); ?>
                    <?php if(! empty($categorized_print_page['part_label'])): ?>
                        | <?php echo e(__('lang_v1.page'), false); ?> <?php echo e($categorized_print_page['part_label'], false); ?>

                    <?php endif; ?>
                </span>
            <?php endif; ?>
        </h4>
    </div>

    <table class="sv-detail-table">
        <thead>
            <tr>
                <?php if($show_sku): ?><th>SKU</th><?php endif; ?>
                <?php if($show_product): ?><th><?php echo e(__('business.product'), false); ?></th><?php endif; ?>
                <?php if($show_unit): ?><th><?php echo e(__('product.unit'), false); ?></th><?php endif; ?>
                <?php if($show_variation): ?><th><?php echo e(__('lang_v1.variation'), false); ?></th><?php endif; ?>
                <?php if($show_location): ?><th><?php echo e(__('sale.location'), false); ?></th><?php endif; ?>
                <?php if($show_opening_stock): ?><th class="text-right"><?php echo e(__('report.opening_stock'), false); ?></th><?php endif; ?>
                <?php if($show_opening_stock_value): ?><th class="text-right"><?php echo e(__('report.opening_stock_value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                <?php if($show_purchase): ?><th class="text-right"><?php echo e(__('purchase.purchase'), false); ?></th><?php endif; ?>
                <?php if($show_purchase_value): ?><th class="text-right"><?php echo e(__('purchase.purchase'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                <?php if($show_purchase_return): ?><th class="text-right"><?php echo e(__('purchase.purchase_return'), false); ?></th><?php endif; ?>
                <?php if($show_purchase_return_value): ?><th class="text-right"><?php echo e(__('purchase.purchase_return'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                <?php if($show_manufacturing_col): ?><th class="text-right"><?php echo e(__('manufacturing::lang.manufacturing'), false); ?> (<?php echo e(__('lang_v1.in'), false); ?>)</th><?php endif; ?>
                <?php if($show_manufacturing_value): ?><th class="text-right"><?php echo e(__('manufacturing::lang.manufacturing'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                <?php if($show_ingredient): ?><th class="text-right"><?php echo e(__('manufacturing::lang.ingredients'), false); ?> (<?php echo e(__('lang_v1.out'), false); ?>)</th><?php endif; ?>
                <?php if($show_ingredient_value): ?><th class="text-right"><?php echo e(__('manufacturing::lang.ingredients'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                <?php if($show_stock_transfer): ?><th class="text-right"><?php echo e(__('lang_v1.stock_transfer'), false); ?></th><?php endif; ?>
                <?php if($show_stock_transfer_value): ?><th class="text-right"><?php echo e(__('lang_v1.stock_transfer'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                <?php if($show_stock_adjustment_col): ?><th class="text-right"><?php echo e(__('stock_adjustment.stock_adjustment'), false); ?></th><?php endif; ?>
                <?php if($show_stock_adjustment_value): ?><th class="text-right"><?php echo e(__('stock_adjustment.stock_adjustment'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                <?php if($show_sale): ?><th class="text-right"><?php echo e(__('sale.sale'), false); ?></th><?php endif; ?>
                <?php if($show_sale_value): ?><th class="text-right"><?php echo e(__('sale.sale'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                <?php if($show_sale_return): ?><th class="text-right"><?php echo e(__('sale.sale'), false); ?> <?php echo e(__('sale.return'), false); ?></th><?php endif; ?>
                <?php if($show_sale_return_value): ?><th class="text-right"><?php echo e(__('sale.sale'), false); ?> <?php echo e(__('sale.return'), false); ?> <?php echo e(__('report.value'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                <?php if($show_current_stock): ?><th class="text-right"><?php echo e(__('report.current_stock'), false); ?></th><?php endif; ?>
                <?php if($show_total_stock_price): ?><th class="text-right"><?php echo e(__('lang_v1.total_stock_price'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
            </tr>
        </thead>
        <?php if($page_type === 'subcategory'): ?>
            <tbody>
                <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <?php if($show_sku): ?><td><?php echo e($product['sku'], false); ?></td><?php endif; ?>
                        <?php if($show_product): ?><td><?php echo e($product['product_name'], false); ?></td><?php endif; ?>
                        <?php if($show_unit): ?><td><?php echo e($product['unit'], false); ?></td><?php endif; ?>
                        <?php if($show_variation): ?><td><?php echo e($product['variation'], false); ?></td><?php endif; ?>
                        <?php if($show_location): ?><td><?php echo e($product['location_name'], false); ?></td><?php endif; ?>
                        <?php if($show_opening_stock): ?><td class="text-right"><?php echo e(_sv_print_qty($product['opening_stock'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_opening_stock_value): ?><td class="text-right"><?php echo e(_sv_print_value($product['opening_stock_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_purchase): ?><td class="text-right"><?php echo e(_sv_print_qty($product['purchase'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_purchase_value): ?><td class="text-right"><?php echo e(_sv_print_value($product['purchase_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_purchase_return): ?><td class="text-right"><?php echo e(_sv_print_qty($product['purchase_return'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_purchase_return_value): ?><td class="text-right"><?php echo e(_sv_print_value($product['purchase_return_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_manufacturing_col): ?><td class="text-right"><?php echo e(_sv_print_qty($product['manufacturing'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_manufacturing_value): ?><td class="text-right"><?php echo e(_sv_print_value($product['manufacturing_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_ingredient): ?><td class="text-right"><?php echo e(_sv_print_qty($product['ingredient'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_ingredient_value): ?><td class="text-right"><?php echo e(_sv_print_value($product['ingredient_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_stock_transfer): ?><td class="text-right"><?php echo e(_sv_print_qty($product['stock_transfer'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_stock_transfer_value): ?><td class="text-right"><?php echo e(_sv_print_value($product['stock_transfer_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_stock_adjustment_col): ?><td class="text-right"><?php echo e(_sv_print_qty($product['stock_adjustment'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_stock_adjustment_value): ?><td class="text-right"><?php echo e(_sv_print_value($product['stock_adjustment_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_sale): ?><td class="text-right"><?php echo e(_sv_print_qty($product['sales'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_sale_value): ?><td class="text-right"><?php echo e(_sv_print_value($product['sales_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_sale_return): ?><td class="text-right"><?php echo e(_sv_print_qty($product['sales_return'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_sale_return_value): ?><td class="text-right"><?php echo e(_sv_print_value($product['sales_return_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_current_stock): ?><td class="text-right"><?php echo e(_sv_print_qty($product['current_stock'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                        <?php if($show_total_stock_price): ?><td class="text-right"><?php echo e(_sv_print_value($product['current_stock_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        <?php endif; ?>
        <?php if($page_type === 'grand_total' || ! empty($categorized_print_page['show_subcategory_total'])): ?>
            <tfoot>
                <tr>
                    <?php if($text_cols > 0): ?>
                        <td colspan="<?php echo e($text_cols, false); ?>" class="text-right">
                            <?php echo e($page_type === 'grand_total' ? __('lang_v1.grand_total') : __('sale.total'), false); ?>:
                        </td>
                    <?php endif; ?>
                    <?php if($show_opening_stock): ?><td class="text-right"><?php echo e(_sv_print_qty($page_totals['opening_stock'] ?? 0, $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_opening_stock_value): ?><td class="text-right"><?php echo e(_sv_print_value($page_totals['opening_stock_value'] ?? 0, $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_purchase): ?><td class="text-right"><?php echo e(_sv_print_qty($page_totals['purchase'] ?? 0, $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_purchase_value): ?><td class="text-right"><?php echo e(_sv_print_value($page_totals['purchase_value'] ?? 0, $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_purchase_return): ?><td class="text-right"><?php echo e(_sv_print_qty($page_totals['purchase_return'] ?? 0, $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_purchase_return_value): ?><td class="text-right"><?php echo e(_sv_print_value($page_totals['purchase_return_value'] ?? 0, $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_manufacturing_col): ?><td class="text-right"><?php echo e(_sv_print_qty($page_totals['manufacturing'] ?? 0, $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_manufacturing_value): ?><td class="text-right"><?php echo e(_sv_print_value($page_totals['manufacturing_value'] ?? 0, $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_ingredient): ?><td class="text-right"><?php echo e(_sv_print_qty($page_totals['ingredient'] ?? 0, $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_ingredient_value): ?><td class="text-right"><?php echo e(_sv_print_value($page_totals['ingredient_value'] ?? 0, $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_stock_transfer): ?><td class="text-right"><?php echo e(_sv_print_qty($page_totals['stock_transfer'] ?? 0, $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_stock_transfer_value): ?><td class="text-right"><?php echo e(_sv_print_value($page_totals['stock_transfer_value'] ?? 0, $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_stock_adjustment_col): ?><td class="text-right"><?php echo e(_sv_print_qty($page_totals['stock_adjustment'] ?? 0, $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_stock_adjustment_value): ?><td class="text-right"><?php echo e(_sv_print_value($page_totals['stock_adjustment_value'] ?? 0, $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_sale): ?><td class="text-right"><?php echo e(_sv_print_qty($page_totals['sales'] ?? 0, $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_sale_value): ?><td class="text-right"><?php echo e(_sv_print_value($page_totals['sales_value'] ?? 0, $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_sale_return): ?><td class="text-right"><?php echo e(_sv_print_qty($page_totals['sales_return'] ?? 0, $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_sale_return_value): ?><td class="text-right"><?php echo e(_sv_print_value($page_totals['sales_return_value'] ?? 0, $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_current_stock): ?><td class="text-right"><?php echo e(_sv_print_qty($page_totals['current_stock'] ?? 0, $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                    <?php if($show_total_stock_price): ?><td class="text-right"><?php echo e(_sv_print_value($page_totals['current_stock_value'] ?? 0, $value_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                </tr>
            </tfoot>
        <?php endif; ?>
    </table>
<?php endif; ?>
