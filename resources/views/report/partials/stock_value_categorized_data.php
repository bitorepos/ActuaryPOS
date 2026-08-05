
<?php
    $us = $user_settings ?? [];
    $show_manufacturing_data = ! empty($show_manufacturing_data);
    $show_variation_column = $show_variation_column ?? true;
    $show_stock_value_report_cost_value = $show_stock_value_report_cost_value ?? ! empty($show_value_columns);
    $show_stock_value_report_sale_value = $show_stock_value_report_sale_value ?? ! empty($show_value_columns);
?>
<?php if($total_categories > 0): ?>
<div class="row" style="margin-bottom: 10px;">
    <div class="col-md-6">
        <span class="text-muted" style="font-size: 13px;">
            <?php echo app('translator')->get('lang_v1.showing_categories', [
                'from' => (($page - 1) * $per_page) + 1,
                'to' => min($page * $per_page, $total_categories),
                'total' => $total_categories
            ]); ?>
        </span>
    </div>
    <div class="col-md-6 text-right">
        <label style="font-size: 13px; font-weight: normal; margin: 0;">
            <?php echo app('translator')->get('lang_v1.categories_per_page'); ?>:
            <select class="form-control input-sm" id="sv_categorized_per_page" style="display: inline-block; width: auto; margin-left: 5px;">
                <?php $__currentLoopData = [5, 10, 25, 50, 100]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($opt, false); ?>" <?php echo e($per_page == $opt ? 'selected' : '', false); ?>><?php echo e($opt, false); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </label>
    </div>
</div>
<?php endif; ?>

<?php $__empty_1 = true; $__currentLoopData = $categorized_page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_name => $sub_categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="card mb-2">
        <div class="card-header bg-primary" style="background-color: #3c8dbc !important; padding: 8px 15px;">
            <h4 class="mb-0 text-white" style="margin:0; font-size: 16px; font-weight: 600;">
                <i class="fas fa-folder-open"></i> <?php echo e($category_name, false); ?>

            </h4>
        </div>
        <div class="card-body" style="padding: 0;">
            <?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category_name => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="padding: 10px 15px 0 15px;">
                    <h5 style="font-size: 14px; font-weight: 600; color: #555; margin-bottom: 8px;">
                        <i class="fas fa-folder"></i> <?php echo e($sub_category_name, false); ?>

                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed" style="margin-bottom: 0; font-size: 12px;">
                        <thead>
                            <tr class="bg-light-gray" style="background-color: #f5f5f5;">
                                <?php if(empty($us['rpt_stock_svalcat_hide_sku'])): ?><th style="width:90px;">SKU</th><?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_product'])): ?><th><?php echo app('translator')->get('business.product'); ?></th><?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_unit'])): ?><th><?php echo app('translator')->get('product.unit'); ?></th><?php endif; ?>
                                <?php if($show_variation_column && empty($us['rpt_stock_svalcat_hide_variation'])): ?><th><?php echo app('translator')->get('lang_v1.variation'); ?></th><?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_location'])): ?><th><?php echo app('translator')->get('sale.location'); ?></th><?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_opening_stock'])): ?><th class="text-right"><?php echo app('translator')->get('report.opening_stock'); ?></th><?php endif; ?>
                                <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_opening_stock_value'])): ?><th class="text-right"><?php echo app('translator')->get('report.opening_stock_value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_purchase'])): ?><th class="text-right"><?php echo app('translator')->get('purchase.purchase'); ?></th><?php endif; ?>
                                <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_purchase_value'])): ?><th class="text-right"><?php echo app('translator')->get('purchase.purchase'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_purchase_return'])): ?><th class="text-right"><?php echo app('translator')->get('purchase.purchase_return'); ?></th><?php endif; ?>
                                <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_purchase_return_value'])): ?><th class="text-right"><?php echo app('translator')->get('purchase.purchase_return'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <?php if($show_manufacturing_data): ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_manufacturing'])): ?><th class="text-right"><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</th><?php endif; ?>
                                <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_manufacturing_value'])): ?><th class="text-right"><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_ingredient'])): ?><th class="text-right"><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</th><?php endif; ?>
                                <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_ingredient_value'])): ?><th class="text-right"><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <?php endif; ?>
                                <?php if(in_array('stock_transfers', session('business.enabled_modules', []))): ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_stock_transfer'])): ?><th class="text-right"><?php echo app('translator')->get('lang_v1.stock_transfer'); ?></th><?php endif; ?>
                                <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_stock_transfer_value'])): ?><th class="text-right"><?php echo app('translator')->get('lang_v1.stock_transfer'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <?php endif; ?>
                                <?php if(in_array('stock_adjustment', session('business.enabled_modules', []))): ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_stock_adjustment'])): ?><th class="text-right"><?php echo app('translator')->get('stock_adjustment.stock_adjustment'); ?></th><?php endif; ?>
                                <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_stock_adjustment_value'])): ?><th class="text-right"><?php echo app('translator')->get('stock_adjustment.stock_adjustment'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_sale'])): ?><th class="text-right"><?php echo app('translator')->get('sale.sale'); ?></th><?php endif; ?>
                                <?php if($show_stock_value_report_sale_value && empty($us['rpt_stock_svalcat_hide_sale_value'])): ?><th class="text-right"><?php echo app('translator')->get('sale.sale'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_sale_return'])): ?><th class="text-right"><?php echo app('translator')->get('sale.sale'); ?> <?php echo app('translator')->get('sale.return'); ?></th><?php endif; ?>
                                <?php if($show_stock_value_report_sale_value && empty($us['rpt_stock_svalcat_hide_sale_return_value'])): ?><th class="text-right"><?php echo app('translator')->get('sale.sale'); ?> <?php echo app('translator')->get('sale.return'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_current_stock'])): ?><th class="text-right"><?php echo app('translator')->get('report.current_stock'); ?></th><?php endif; ?>
                                <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_total_stock_price'])): ?><th class="text-right"><?php echo app('translator')->get('lang_v1.total_stock_price'); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if(empty($us['rpt_stock_svalcat_hide_sku'])): ?><td><?php echo e($product['sku'], false); ?></td><?php endif; ?>
                                    <?php if(empty($us['rpt_stock_svalcat_hide_product'])): ?><td><?php echo e($product['product_name'], false); ?></td><?php endif; ?>
                                    <?php if(empty($us['rpt_stock_svalcat_hide_unit'])): ?><td><?php echo e($product['unit'], false); ?></td><?php endif; ?>
                                    <?php if($show_variation_column && empty($us['rpt_stock_svalcat_hide_variation'])): ?><td><?php echo e($product['variation'], false); ?></td><?php endif; ?>
                                    <?php if(empty($us['rpt_stock_svalcat_hide_location'])): ?><td><?php echo e($product['location_name'], false); ?></td><?php endif; ?>
                                    <?php if(empty($us['rpt_stock_svalcat_hide_opening_stock'])): ?><td class="text-right"><?php echo e(number_format($product['opening_stock'], 2), false); ?></td><?php endif; ?>
                                    <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_opening_stock_value'])): ?><td class="text-right"><?php echo e(number_format($product['opening_stock_value'], 2), false); ?></td><?php endif; ?>
                                    <?php if(empty($us['rpt_stock_svalcat_hide_purchase'])): ?><td class="text-right"><?php echo e(number_format($product['purchase'], 2), false); ?></td><?php endif; ?>
                                    <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_purchase_value'])): ?><td class="text-right"><?php echo e(number_format($product['purchase_value'], 2), false); ?></td><?php endif; ?>
                                    <?php if(empty($us['rpt_stock_svalcat_hide_purchase_return'])): ?><td class="text-right"><?php echo e(number_format($product['purchase_return'], 2), false); ?></td><?php endif; ?>
                                    <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_purchase_return_value'])): ?><td class="text-right"><?php echo e(number_format($product['purchase_return_value'], 2), false); ?></td><?php endif; ?>
                                    <?php if($show_manufacturing_data): ?>
                                    <?php if(empty($us['rpt_stock_svalcat_hide_manufacturing'])): ?><td class="text-right"><?php echo e(number_format($product['manufacturing'], 2), false); ?></td><?php endif; ?>
                                    <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_manufacturing_value'])): ?><td class="text-right"><?php echo e(number_format($product['manufacturing_value'], 2), false); ?></td><?php endif; ?>
                                    <?php if(empty($us['rpt_stock_svalcat_hide_ingredient'])): ?><td class="text-right"><?php echo e(number_format($product['ingredient'], 2), false); ?></td><?php endif; ?>
                                    <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_ingredient_value'])): ?><td class="text-right"><?php echo e(number_format($product['ingredient_value'], 2), false); ?></td><?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(in_array('stock_transfers', session('business.enabled_modules', []))): ?>
                                    <?php if(empty($us['rpt_stock_svalcat_hide_stock_transfer'])): ?><td class="text-right"><?php echo e(number_format($product['stock_transfer'], 2), false); ?></td><?php endif; ?>
                                    <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_stock_transfer_value'])): ?><td class="text-right"><?php echo e(number_format($product['stock_transfer_value'], 2), false); ?></td><?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(in_array('stock_adjustment', session('business.enabled_modules', []))): ?>
                                    <?php if(empty($us['rpt_stock_svalcat_hide_stock_adjustment'])): ?><td class="text-right"><?php echo e(number_format($product['stock_adjustment'], 2), false); ?></td><?php endif; ?>
                                    <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_stock_adjustment_value'])): ?><td class="text-right"><?php echo e(number_format($product['stock_adjustment_value'], 2), false); ?></td><?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(empty($us['rpt_stock_svalcat_hide_sale'])): ?><td class="text-right"><?php echo e(number_format($product['sales'], 2), false); ?></td><?php endif; ?>
                                    <?php if($show_stock_value_report_sale_value && empty($us['rpt_stock_svalcat_hide_sale_value'])): ?><td class="text-right"><?php echo e(number_format($product['sales_value'], 2), false); ?></td><?php endif; ?>
                                    <?php if(empty($us['rpt_stock_svalcat_hide_sale_return'])): ?><td class="text-right"><?php echo e(number_format($product['sales_return'], 2), false); ?></td><?php endif; ?>
                                    <?php if($show_stock_value_report_sale_value && empty($us['rpt_stock_svalcat_hide_sale_return_value'])): ?><td class="text-right"><?php echo e(number_format($product['sales_return_value'], 2), false); ?></td><?php endif; ?>
                                    <?php if(empty($us['rpt_stock_svalcat_hide_current_stock'])): ?><td class="text-right"><?php echo e(number_format($product['current_stock'], 2), false); ?></td><?php endif; ?>
                                    <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_total_stock_price'])): ?><td class="text-right"><?php echo e(number_format($product['current_stock_value'], 2), false); ?></td><?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr class="font-weight-bold" style="background-color: #eef7ff;">
                                <?php
                                    $sv_text_cols = 0;
                                    if(empty($us['rpt_stock_svalcat_hide_sku'])) $sv_text_cols++;
                                    if(empty($us['rpt_stock_svalcat_hide_product'])) $sv_text_cols++;
                                    if(empty($us['rpt_stock_svalcat_hide_unit'])) $sv_text_cols++;
                                    if($show_variation_column && empty($us['rpt_stock_svalcat_hide_variation'])) $sv_text_cols++;
                                    if(empty($us['rpt_stock_svalcat_hide_location'])) $sv_text_cols++;
                                ?>
                                <?php if($sv_text_cols > 0): ?>
                                <td colspan="<?php echo e($sv_text_cols, false); ?>" class="text-right"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                <?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_opening_stock'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['opening_stock'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_opening_stock_value'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['opening_stock_value'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_purchase'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['purchase'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_purchase_value'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['purchase_value'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_purchase_return'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['purchase_return'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_purchase_return_value'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['purchase_return_value'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if($show_manufacturing_data): ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_manufacturing'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['manufacturing'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_manufacturing_value'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['manufacturing_value'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_ingredient'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['ingredient'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_ingredient_value'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['ingredient_value'], 2), false); ?></strong></td><?php endif; ?>
                                <?php endif; ?>
                                <?php if(in_array('stock_transfers', session('business.enabled_modules', []))): ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_stock_transfer'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['stock_transfer'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_stock_transfer_value'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['stock_transfer_value'], 2), false); ?></strong></td><?php endif; ?>
                                <?php endif; ?>
                                <?php if(in_array('stock_adjustment', session('business.enabled_modules', []))): ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_stock_adjustment'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['stock_adjustment'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_stock_adjustment_value'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['stock_adjustment_value'], 2), false); ?></strong></td><?php endif; ?>
                                <?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_sale'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['sales'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if($show_stock_value_report_sale_value && empty($us['rpt_stock_svalcat_hide_sale_value'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['sales_value'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_sale_return'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['sales_return'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if($show_stock_value_report_sale_value && empty($us['rpt_stock_svalcat_hide_sale_return_value'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['sales_return_value'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if(empty($us['rpt_stock_svalcat_hide_current_stock'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['current_stock'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_total_stock_price'])): ?><td class="text-right"><strong><?php echo e(number_format($data['totals']['current_stock_value'], 2), false); ?></strong></td><?php endif; ?>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <?php if(!$loop->last): ?>
                    <hr style="margin: 0;">
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="text-center py-4">
        <p class="text-muted"><?php echo app('translator')->get('lang_v1.no_data_available'); ?></p>
    </div>
<?php endif; ?>


<?php if($total_categories > 0): ?>
<div class="card mb-3">
    <div class="table-responsive">
        <table class="table table-bordered table-condensed" style="margin-bottom: 0; font-size: 12px;">
            <tfoot>
                <tr style="background-color: #d9edf7; font-size: 13px;">
                    <?php
                        $gt_sv_cols = 0;
                        if(empty($us['rpt_stock_svalcat_hide_sku'])) $gt_sv_cols++;
                        if(empty($us['rpt_stock_svalcat_hide_product'])) $gt_sv_cols++;
                        if(empty($us['rpt_stock_svalcat_hide_unit'])) $gt_sv_cols++;
                        if($show_variation_column && empty($us['rpt_stock_svalcat_hide_variation'])) $gt_sv_cols++;
                        if(empty($us['rpt_stock_svalcat_hide_location'])) $gt_sv_cols++;
                    ?>
                    <?php if($gt_sv_cols > 0): ?>
                    <td colspan="<?php echo e($gt_sv_cols, false); ?>" class="text-right"><strong><?php echo app('translator')->get('lang_v1.grand_total'); ?>:</strong></td>
                    <?php endif; ?>
                    <?php if(empty($us['rpt_stock_svalcat_hide_opening_stock'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['opening_stock'], 2), false); ?></strong></td><?php endif; ?>
                    <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_opening_stock_value'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['opening_stock_value'], 2), false); ?></strong></td><?php endif; ?>
                    <?php if(empty($us['rpt_stock_svalcat_hide_purchase'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['purchase'], 2), false); ?></strong></td><?php endif; ?>
                    <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_purchase_value'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['purchase_value'], 2), false); ?></strong></td><?php endif; ?>
                    <?php if(empty($us['rpt_stock_svalcat_hide_purchase_return'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['purchase_return'], 2), false); ?></strong></td><?php endif; ?>
                    <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_purchase_return_value'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['purchase_return_value'], 2), false); ?></strong></td><?php endif; ?>
                    <?php if($show_manufacturing_data): ?>
                    <?php if(empty($us['rpt_stock_svalcat_hide_manufacturing'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['manufacturing'], 2), false); ?></strong></td><?php endif; ?>
                    <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_manufacturing_value'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['manufacturing_value'], 2), false); ?></strong></td><?php endif; ?>
                    <?php if(empty($us['rpt_stock_svalcat_hide_ingredient'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['ingredient'], 2), false); ?></strong></td><?php endif; ?>
                    <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_ingredient_value'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['ingredient_value'], 2), false); ?></strong></td><?php endif; ?>
                    <?php endif; ?>
                    <?php if(in_array('stock_transfers', session('business.enabled_modules', []))): ?>
                    <?php if(empty($us['rpt_stock_svalcat_hide_stock_transfer'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['stock_transfer'], 2), false); ?></strong></td><?php endif; ?>
                    <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_stock_transfer_value'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['stock_transfer_value'], 2), false); ?></strong></td><?php endif; ?>
                    <?php endif; ?>
                    <?php if(in_array('stock_adjustment', session('business.enabled_modules', []))): ?>
                    <?php if(empty($us['rpt_stock_svalcat_hide_stock_adjustment'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['stock_adjustment'], 2), false); ?></strong></td><?php endif; ?>
                    <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_stock_adjustment_value'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['stock_adjustment_value'], 2), false); ?></strong></td><?php endif; ?>
                    <?php endif; ?>
                    <?php if(empty($us['rpt_stock_svalcat_hide_sale'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['sales'], 2), false); ?></strong></td><?php endif; ?>
                    <?php if($show_stock_value_report_sale_value && empty($us['rpt_stock_svalcat_hide_sale_value'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['sales_value'], 2), false); ?></strong></td><?php endif; ?>
                    <?php if(empty($us['rpt_stock_svalcat_hide_sale_return'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['sales_return'], 2), false); ?></strong></td><?php endif; ?>
                    <?php if($show_stock_value_report_sale_value && empty($us['rpt_stock_svalcat_hide_sale_return_value'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['sales_return_value'], 2), false); ?></strong></td><?php endif; ?>
                    <?php if(empty($us['rpt_stock_svalcat_hide_current_stock'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['current_stock'], 2), false); ?></strong></td><?php endif; ?>
                    <?php if($show_stock_value_report_cost_value && empty($us['rpt_stock_svalcat_hide_total_stock_price'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_totals['current_stock_value'], 2), false); ?></strong></td><?php endif; ?>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php endif; ?>


<?php if($total_pages > 1): ?>
<div class="text-center" style="margin-top: 10px;">
    <ul class="pagination" style="margin: 0;">
        <li class="<?php echo e($page <= 1 ? 'disabled' : '', false); ?>">
            <a href="#" class="sv-categorized-page-link" data-page="<?php echo e($page - 1, false); ?>">&laquo;</a>
        </li>

        <?php
            $start = max(1, $page - 2);
            $end = min($total_pages, $page + 2);
        ?>

        <?php if($start > 1): ?>
            <li><a href="#" class="sv-categorized-page-link" data-page="1">1</a></li>
            <?php if($start > 2): ?>
                <li class="disabled"><a href="#">...</a></li>
            <?php endif; ?>
        <?php endif; ?>

        <?php for($i = $start; $i <= $end; $i++): ?>
            <li class="<?php echo e($i == $page ? 'active' : '', false); ?>">
                <a href="#" class="sv-categorized-page-link" data-page="<?php echo e($i, false); ?>"><?php echo e($i, false); ?></a>
            </li>
        <?php endfor; ?>

        <?php if($end < $total_pages): ?>
            <?php if($end < $total_pages - 1): ?>
                <li class="disabled"><a href="#">...</a></li>
            <?php endif; ?>
            <li><a href="#" class="sv-categorized-page-link" data-page="<?php echo e($total_pages, false); ?>"><?php echo e($total_pages, false); ?></a></li>
        <?php endif; ?>

        <li class="<?php echo e($page >= $total_pages ? 'disabled' : '', false); ?>">
            <a href="#" class="sv-categorized-page-link" data-page="<?php echo e($page + 1, false); ?>">&raquo;</a>
        </li>
    </ul>
</div>
<?php endif; ?>
