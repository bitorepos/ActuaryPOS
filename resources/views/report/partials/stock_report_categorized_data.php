
<?php
    $us = $user_settings ?? [];
    $show_variation_column = $show_variation_column ?? true;
    $hide_prices = ! empty($hide_prices);
    $show_unit_selling_price = empty($us['rpt_stock_stockcat_hide_unit_selling_price']) && ! $hide_prices;
    $show_unit_purchase_price = empty($us['rpt_stock_stockcat_hide_unit_purchase_price']) && ! $hide_prices;
    $show_total_selling_value = empty($us['rpt_stock_stockcat_hide_total_selling_value']) && ! empty($show_stock_report_sale_value);
    $show_total_cost_value = empty($us['rpt_stock_stockcat_hide_total_cost_value']) && ! empty($show_stock_report_cost_value);
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
            <select class="form-control input-sm" id="categorized_per_page" style="display: inline-block; width: auto; margin-left: 5px;">
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
                    <table class="table table-bordered table-striped table-condensed" style="margin-bottom: 0;">
                        <thead>
                            <tr class="bg-light-gray" style="background-color: #f5f5f5;">
                                <?php if(empty($us['rpt_stock_stockcat_hide_sku'])): ?><th style="width:100px;">SKU</th><?php endif; ?>
                                <?php if(empty($us['rpt_stock_stockcat_hide_product'])): ?><th><?php echo app('translator')->get('business.product'); ?></th><?php endif; ?>
                                <?php if($show_variation_column && empty($us['rpt_stock_stockcat_hide_variation'])): ?><th><?php echo app('translator')->get('lang_v1.variation'); ?></th><?php endif; ?>
                                <?php if(empty($us['rpt_stock_stockcat_hide_rack_details'])): ?><th><?php echo app('translator')->get('lang_v1.rack_details'); ?></th><?php endif; ?>
                                <?php if(empty($us['rpt_stock_stockcat_hide_brand'])): ?><th><?php echo app('translator')->get('product.brand'); ?></th><?php endif; ?>
                                <?php if(empty($us['rpt_stock_stockcat_hide_location'])): ?><th><?php echo app('translator')->get('sale.location'); ?></th><?php endif; ?>
                                <?php if(empty($us['rpt_stock_stockcat_hide_unit'])): ?><th><?php echo app('translator')->get('product.unit'); ?></th><?php endif; ?>
                                <?php if(empty($us['rpt_stock_stockcat_hide_quantity'])): ?><th class="text-right" style="width:100px;"><?php echo app('translator')->get('lang_v1.quantity'); ?></th><?php endif; ?>
                                <?php if($show_unit_selling_price): ?><th class="text-right"><?php echo app('translator')->get('lang_v1.unit_selling_price'); ?></th><?php endif; ?>
                                <?php if($show_total_selling_value): ?><th class="text-right"><?php echo app('translator')->get('lang_v1.total_selling_value'); ?></th><?php endif; ?>
                                <?php if($show_unit_purchase_price): ?><th class="text-right"><?php echo app('translator')->get('lang_v1.unit_purchase_price'); ?></th><?php endif; ?>
                                <?php if($show_total_cost_value): ?><th class="text-right"><?php echo app('translator')->get('lang_v1.total_cost_value'); ?></th><?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if(empty($us['rpt_stock_stockcat_hide_sku'])): ?><td><?php echo e($product['sku'], false); ?></td><?php endif; ?>
                                    <?php if(empty($us['rpt_stock_stockcat_hide_product'])): ?><td><?php echo e($product['product_name'], false); ?></td><?php endif; ?>
                                    <?php if($show_variation_column && empty($us['rpt_stock_stockcat_hide_variation'])): ?><td><?php echo e($product['variation'], false); ?></td><?php endif; ?>
                                    <?php if(empty($us['rpt_stock_stockcat_hide_rack_details'])): ?><td><?php echo e($product['rack_details'], false); ?></td><?php endif; ?>
                                    <?php if(empty($us['rpt_stock_stockcat_hide_brand'])): ?><td><?php echo e($product['brand_name'], false); ?></td><?php endif; ?>
                                    <?php if(empty($us['rpt_stock_stockcat_hide_location'])): ?><td><?php echo e($product['location_name'], false); ?></td><?php endif; ?>
                                    <?php if(empty($us['rpt_stock_stockcat_hide_unit'])): ?><td><?php echo e($product['unit'], false); ?></td><?php endif; ?>
                                    <?php if(empty($us['rpt_stock_stockcat_hide_quantity'])): ?><td class="text-right"><?php echo e(number_format($product['qty'], 2), false); ?></td><?php endif; ?>
                                    <?php if($show_unit_selling_price): ?><td class="text-right"><?php echo e(number_format($product['unit_selling_price'], 2), false); ?></td><?php endif; ?>
                                    <?php if($show_total_selling_value): ?><td class="text-right"><?php echo e(number_format($product['total_selling_value'], 2), false); ?></td><?php endif; ?>
                                    <?php if($show_unit_purchase_price): ?><td class="text-right"><?php echo e(number_format($product['unit_purchase_price'], session('business.cost_decimal', 2)), false); ?></td><?php endif; ?>
                                    <?php if($show_total_cost_value): ?><td class="text-right"><?php echo e(number_format($product['total_cost_value'], session('business.cost_decimal', 2)), false); ?></td><?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr class="font-weight-bold" style="background-color: #eef7ff;">
                                <?php
                                    $visible_text_cols = 0;
                                    if(empty($us['rpt_stock_stockcat_hide_sku'])) $visible_text_cols++;
                                    if(empty($us['rpt_stock_stockcat_hide_product'])) $visible_text_cols++;
                                    if($show_variation_column && empty($us['rpt_stock_stockcat_hide_variation'])) $visible_text_cols++;
                                    if(empty($us['rpt_stock_stockcat_hide_rack_details'])) $visible_text_cols++;
                                    if(empty($us['rpt_stock_stockcat_hide_brand'])) $visible_text_cols++;
                                    if(empty($us['rpt_stock_stockcat_hide_location'])) $visible_text_cols++;
                                    if(empty($us['rpt_stock_stockcat_hide_unit'])) $visible_text_cols++;
                                ?>
                                <?php if($visible_text_cols > 0): ?>
                                <td colspan="<?php echo e($visible_text_cols, false); ?>" class="text-right"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                <?php endif; ?>
                                <?php if(empty($us['rpt_stock_stockcat_hide_quantity'])): ?><td class="text-right"><strong><?php echo e(number_format($data['total_qty'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if($show_unit_selling_price): ?><td></td><?php endif; ?>
                                <?php if($show_total_selling_value): ?><td class="text-right"><strong><?php echo e(number_format($data['total_selling_value'], 2), false); ?></strong></td><?php endif; ?>
                                <?php if($show_unit_purchase_price): ?><td></td><?php endif; ?>
                                <?php if($show_total_cost_value): ?><td class="text-right"><strong><?php echo e(number_format($data['total_cost_value'], 2), false); ?></strong></td><?php endif; ?>
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
        <table class="table table-bordered table-condensed" style="margin-bottom: 0;">
            <tfoot>
                <tr style="background-color: #d9edf7; font-size: 14px;">
                    <?php
                        $gt_text_cols = 0;
                        if(empty($us['rpt_stock_stockcat_hide_sku'])) $gt_text_cols++;
                        if(empty($us['rpt_stock_stockcat_hide_product'])) $gt_text_cols++;
                        if($show_variation_column && empty($us['rpt_stock_stockcat_hide_variation'])) $gt_text_cols++;
                        if(empty($us['rpt_stock_stockcat_hide_rack_details'])) $gt_text_cols++;
                        if(empty($us['rpt_stock_stockcat_hide_brand'])) $gt_text_cols++;
                        if(empty($us['rpt_stock_stockcat_hide_location'])) $gt_text_cols++;
                        if(empty($us['rpt_stock_stockcat_hide_unit'])) $gt_text_cols++;
                    ?>
                    <?php if($gt_text_cols > 0): ?>
                    <td colspan="<?php echo e($gt_text_cols, false); ?>" class="text-right"><strong><?php echo app('translator')->get('lang_v1.grand_total'); ?>:</strong></td>
                    <?php endif; ?>
                    <?php if(empty($us['rpt_stock_stockcat_hide_quantity'])): ?><td class="text-right"><strong><?php echo e(number_format($grand_total_qty, 2), false); ?></strong></td><?php endif; ?>
                    <?php if($show_unit_selling_price): ?><td class="text-right"></td><?php endif; ?>
                    <?php if($show_total_selling_value): ?><td class="text-right"><strong><?php echo e(number_format($grand_total_selling, 2), false); ?></strong></td><?php endif; ?>
                    <?php if($show_unit_purchase_price): ?><td class="text-right"></td><?php endif; ?>
                    <?php if($show_total_cost_value): ?><td class="text-right"><strong><?php echo e(number_format($grand_total_cost, 2), false); ?></strong></td><?php endif; ?>
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
            <a href="#" class="categorized-page-link" data-page="<?php echo e($page - 1, false); ?>">&laquo;</a>
        </li>

        <?php
            // Show limited page numbers with ellipsis
            $start = max(1, $page - 2);
            $end = min($total_pages, $page + 2);
            if ($start > 1) {
                $start = max(1, $page - 2);
            }
        ?>

        <?php if($start > 1): ?>
            <li><a href="#" class="categorized-page-link" data-page="1">1</a></li>
            <?php if($start > 2): ?>
                <li class="disabled"><a href="#">...</a></li>
            <?php endif; ?>
        <?php endif; ?>

        <?php for($i = $start; $i <= $end; $i++): ?>
            <li class="<?php echo e($i == $page ? 'active' : '', false); ?>">
                <a href="#" class="categorized-page-link" data-page="<?php echo e($i, false); ?>"><?php echo e($i, false); ?></a>
            </li>
        <?php endfor; ?>

        <?php if($end < $total_pages): ?>
            <?php if($end < $total_pages - 1): ?>
                <li class="disabled"><a href="#">...</a></li>
            <?php endif; ?>
            <li><a href="#" class="categorized-page-link" data-page="<?php echo e($total_pages, false); ?>"><?php echo e($total_pages, false); ?></a></li>
        <?php endif; ?>

        
        <li class="<?php echo e($page >= $total_pages ? 'disabled' : '', false); ?>">
            <a href="#" class="categorized-page-link" data-page="<?php echo e($page + 1, false); ?>">&raquo;</a>
        </li>
    </ul>
</div>
<?php endif; ?>
