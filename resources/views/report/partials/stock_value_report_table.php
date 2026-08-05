<?php
//   $custom_labels = json_decode(session('business.custom_labels'), true);
//   $product_custom_field1 = !empty($custom_labels['product']['custom_field_1']) ? $custom_labels['product']['custom_field_1'] : __('lang_v1.product_custom_field1');
//   $product_custom_field2 = !empty($custom_labels['product']['custom_field_2']) ? $custom_labels['product']['custom_field_2'] : __('lang_v1.product_custom_field2');
//   $product_custom_field3 = !empty($custom_labels['product']['custom_field_3']) ? $custom_labels['product']['custom_field_3'] : __('lang_v1.product_custom_field3');
//   $product_custom_field4 = !empty($custom_labels['product']['custom_field_4']) ? $custom_labels['product']['custom_field_4'] : __('lang_v1.product_custom_field4');
  $show_variation_column = $show_variation_column ?? true;
  $show_stock_value_report_cost_value = $show_stock_value_report_cost_value ?? true;
  $show_stock_value_report_sale_value = $show_stock_value_report_sale_value ?? true;
  $footer_leading_colspan = $show_variation_column ? 5 : 4;
?>

<div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="stock_value_report_table">
    <thead>
        <tr>
            <th>SKU</th>
            <th><?php echo app('translator')->get('business.product'); ?></th>
            <th><?php echo app('translator')->get('product.unit'); ?></th>
            <?php if($show_variation_column): ?>
            <th class="stock-value-report-variation"><?php echo app('translator')->get('lang_v1.variation'); ?></th>
            <?php endif; ?>
            <th><?php echo app('translator')->get('sale.location'); ?></th>
            <th class="text-right"><?php echo app('translator')->get('report.opening_stock'); ?></th>
            <?php if($show_stock_value_report_cost_value): ?>
            <th class="opening_stock_cost text-right"><?php echo app('translator')->get('report.opening_stock_value'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
            <?php endif; ?>
            <th class="text-right"><?php echo app('translator')->get('purchase.purchase'); ?></th>
            <?php if($show_stock_value_report_cost_value): ?>
            <th class="quantity_purchase_cost text-right"><?php echo app('translator')->get('purchase.purchase'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
            <?php endif; ?>
            <th class="text-right"><?php echo app('translator')->get('purchase.purchase_return'); ?></th>
            <?php if($show_stock_value_report_cost_value): ?>
            <th class="quantity_returned_cost text-right"><?php echo app('translator')->get('purchase.purchase_return'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
            <?php endif; ?>
            <?php if(!empty($show_manufacturing_data)): ?>
            <th class="total_manufactured text-right"><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</th>
            <?php if($show_stock_value_report_cost_value): ?>
            <th class="total_manufactured_cost text-right"><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
            <?php endif; ?>
            <th class="total_ingredient_used text-right"><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</th>
            <?php if($show_stock_value_report_cost_value): ?>
            <th class="total_ingredient_used_cost text-right"><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
            <?php endif; ?>
            <?php endif; ?>
            <?php if(in_array('stock_transfers', session('business.enabled_modules', []))): ?>
            <th class="total_transfered text-right"><?php echo app('translator')->get('lang_v1.stock_transfer'); ?></th>
            <?php if($show_stock_value_report_cost_value): ?>
            <th class="total_transfered_cost text-right"><?php echo app('translator')->get('lang_v1.stock_transfer'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
            <?php endif; ?>
            <?php endif; ?>
            <?php if(in_array('stock_adjustment', session('business.enabled_modules', []))): ?>
            <th class="total_adjusted text-right"><?php echo app('translator')->get('stock_adjustment.stock_adjustment'); ?></th>
            <?php if($show_stock_value_report_cost_value): ?>
            <th class="total_adjusted_cost text-right"><?php echo app('translator')->get('stock_adjustment.stock_adjustment'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
            <?php endif; ?>
            <?php endif; ?>
            <th class="text-right"><?php echo app('translator')->get('sale.sale'); ?></th>
            <?php if($show_stock_value_report_sale_value): ?>
            <th class="total_sold_price text-right"><?php echo app('translator')->get('sale.sale'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
            <?php endif; ?>
            <th class="text-right"><?php echo app('translator')->get('sale.sale'); ?> <?php echo app('translator')->get('sale.return'); ?></th>
            <?php if($show_stock_value_report_sale_value): ?>
            <th class="total_sale_return_price text-right"><?php echo app('translator')->get('sale.sale'); ?> <?php echo app('translator')->get('sale.return'); ?> <?php echo app('translator')->get('report.value'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
            <?php endif; ?>
            <th class="text-right"><?php echo app('translator')->get('report.current_stock'); ?></th>
            <?php if($show_stock_value_report_cost_value): ?>
            <th class="stock_price text-right"><?php echo app('translator')->get('lang_v1.total_stock_price'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tfoot>
        <tr class="bg-gray font-17 text-center footer-total">
            <td colspan="<?php echo e($footer_leading_colspan, false); ?>"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
            <td class="footer_opening_stock text-right"></td>
            <?php if($show_stock_value_report_cost_value): ?>
            <td class="footer_opening_stock_cost text-right"></td>
            <?php endif; ?>
            <td class="footer_quantity_purchase text-right"></td>
            <?php if($show_stock_value_report_cost_value): ?>
            <td class="footer_quantity_purchase_cost text-right"></td>
            <?php endif; ?>
            <td class="footer_quantity_returned text-right"></td>
            <?php if($show_stock_value_report_cost_value): ?>
            <td class="footer_quantity_returned_cost text-right"></td>
            <?php endif; ?>
            <?php if(!empty($show_manufacturing_data)): ?>
            <td class="footer_total_manufactured text-right"></td>
            <?php if($show_stock_value_report_cost_value): ?>
            <td class="footer_total_manufactured_cost text-right"></td>
            <?php endif; ?>
            <td class="footer_total_ingredient_used text-right"></td>
            <?php if($show_stock_value_report_cost_value): ?>
            <td class="footer_total_ingredient_used_cost text-right"></td>
            <?php endif; ?>
            <?php endif; ?>
            <?php if(in_array('stock_transfers', session('business.enabled_modules', []))): ?>
            <td class="footer_stock_transfered text-right"></td>
            <?php if($show_stock_value_report_cost_value): ?>
            <td class="footer_stock_transfered_cost text-right"></td>
            <?php endif; ?>
            <?php endif; ?>
            <?php if(in_array('stock_adjustment', session('business.enabled_modules', []))): ?>
            <td class="footer_stock_adjustment text-right"></td>
            <?php if($show_stock_value_report_cost_value): ?>
            <td class="footer_stock_adjustment_cost text-right"></td>
            <?php endif; ?>
            <?php endif; ?>
            <td class="footer_total_sold text-right"></td>
            <?php if($show_stock_value_report_sale_value): ?>
            <td class="footer_total_sold_price text-right"></td>
            <?php endif; ?>
            <td class="footer_quantity_sell_return text-right"></td>
            <?php if($show_stock_value_report_sale_value): ?>
            <td class="footer_quantity_sell_return_price text-right"></td>
            <?php endif; ?>
            <td class="footer_total_stock text-right"></td>
            <?php if($show_stock_value_report_cost_value): ?>
            <td class="footer_total_stock_price text-right"></td>
            <?php endif; ?>
        </tr>
    </tfoot>
</table>
</div>
