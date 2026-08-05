<?php
  $custom_labels = json_decode(session('business.custom_labels'), true);
  $product_custom_field1 = !empty($custom_labels['product']['custom_field_1']) ? $custom_labels['product']['custom_field_1'] : null;
  $product_custom_field2 = !empty($custom_labels['product']['custom_field_2']) ? $custom_labels['product']['custom_field_2'] : null;
  $product_custom_field3 = !empty($custom_labels['product']['custom_field_3']) ? $custom_labels['product']['custom_field_3'] : null;
  $product_custom_field4 = !empty($custom_labels['product']['custom_field_4']) ? $custom_labels['product']['custom_field_4'] : null;
  $product_custom_field5 = !empty($custom_labels['product']['custom_field_5']) ? $custom_labels['product']['custom_field_5'] : null;
  $product_custom_field6 = !empty($custom_labels['product']['custom_field_6']) ? $custom_labels['product']['custom_field_6'] : null;
  $product_custom_field7 = !empty($custom_labels['product']['custom_field_7']) ? $custom_labels['product']['custom_field_7'] : null;
  $product_custom_field8 = !empty($custom_labels['product']['custom_field_8']) ? $custom_labels['product']['custom_field_8'] : null;
  $active_custom_fields_count = (!empty($product_custom_field1) ? 1 : 0) + (!empty($product_custom_field2) ? 1 : 0) + (!empty($product_custom_field3) ? 1 : 0) + (!empty($product_custom_field4) ? 1 : 0) + (!empty($product_custom_field5) ? 1 : 0) + (!empty($product_custom_field6) ? 1 : 0) + (!empty($product_custom_field7) ? 1 : 0) + (!empty($product_custom_field8) ? 1 : 0);
  $show_variation_column = $show_variation_column ?? true;
  $show_stock_report_cost_value = $show_stock_report_cost_value ?? false;
  $show_stock_report_sale_value = $show_stock_report_sale_value ?? false;
  $show_stock_report_potential_profit = $show_stock_report_potential_profit ?? false;
  $show_category_column = session('business.enable_category');
  $show_sub_category_column = session('business.enable_category') && session('business.enable_sub_category');
  $show_sub2_category_column = session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category');
  $show_brand_column = session('business.enable_brand');
  $show_sub_brand_column = session('business.enable_brand') && session('business.enable_sub_brand');
  $show_gender_column = session('business.enable_gender');
  $show_sub_gender_column = session('business.enable_gender') && session('business.enable_sub_gender');
  $show_procurement_source_column = session('business.enable_procurement_source');
  $show_sub_procurement_source_column = session('business.enable_procurement_source') && session('business.enable_sub_procurement_source');
  $enabled_product_master_columns_count = ($show_category_column ? 1 : 0) + ($show_sub_category_column ? 1 : 0) + ($show_sub2_category_column ? 1 : 0) + ($show_brand_column ? 1 : 0) + ($show_sub_brand_column ? 1 : 0) + ($show_gender_column ? 1 : 0) + ($show_sub_gender_column ? 1 : 0) + ($show_procurement_source_column ? 1 : 0) + ($show_sub_procurement_source_column ? 1 : 0);
  $footer_leading_colspan = 6 + (!empty($common_settings['enable_other_product_name']) ? 1 : 0) + ($show_variation_column ? 1 : 0) + $enabled_product_master_columns_count;
?>
<div class="col-sm-12">
    <div class="mb-3">
        <?php if($is_admin): ?>
        <a class="btn btn-success float-end me-2" id="downloadStockReportExcel"
            href="" data-href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'downloadStockReportExcel']), false); ?>"><i
                class="fa fa-download"></i> <?php echo app('translator')->get('lang_v1.download_excel'); ?></a>
        <?php endif; ?>
        <button type="button" class="sync_product_quantity btn btn-info"><?php echo app('translator')->get('lang_v1.sync_product_quantities'); ?> <i class="hide fas fa-sync fa-spin fa-fw"></i></button>
        <button type="button" class="reindex_stock_quantity btn btn-warning"><?php echo app('translator')->get('lang_v1.reindex_stock_quantities'); ?> <i class="hide fas fa-sync fa-spin fa-fw"></i></button>
        <button type="button" class="cancel_reindex_stock_quantity btn btn-danger">Cancel Reindex <i class="hide fas fa-spinner fa-spin fa-fw"></i></button>
        <button type="button" class="btn btn-primary float-end me-2 open-stock-report-print" id="openStockReportPrint" data-tab="details"><i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4</button>
    </div>
</div>
<div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="stock_report_table">
    <thead>
        <tr>
            <th><?php echo app('translator')->get('messages.action'); ?></th>
            <th>SKU</th>
            <th style="width:350px"><?php echo app('translator')->get('business.product'); ?></th>
            <?php if($common_settings['enable_other_product_name']): ?>
            <th class="other_product_name" style="width:350px"><?php echo e(!empty($common_settings['other_product_name_label']) ? $common_settings['other_product_name_label'] . ':': __('product.other_product_name') . ':', false); ?></th>
            <?php endif; ?>
            <?php if($show_variation_column): ?>
            <th class="stock-report-variation"><?php echo app('translator')->get('lang_v1.variation'); ?></th>
            <?php endif; ?>
            <?php if($show_category_column): ?>
            <th class="stock-report-category"><?php echo app('translator')->get('product.category'); ?></th>
            <?php endif; ?>
            <?php if($show_sub_category_column): ?>
            <th class="stock-report-sub-category"><?php echo app('translator')->get('product.sub_category'); ?></th>
            <?php endif; ?>
            <?php if($show_sub2_category_column): ?>
            <th class="stock-report-sub2-category"><?php echo app('translator')->get('product.sub2_category'); ?></th>
            <?php endif; ?>
            <?php if($show_brand_column): ?>
            <th class="stock-report-brand"><?php echo app('translator')->get('product.brand'); ?></th>
            <?php endif; ?>
            <?php if($show_sub_brand_column): ?>
            <th class="stock-report-sub-brand"><?php echo app('translator')->get('product.sub_brand'); ?></th>
            <?php endif; ?>
            <?php if($show_gender_column): ?>
            <th class="stock-report-gender"><?php echo app('translator')->get('product.gender'); ?></th>
            <?php endif; ?>
            <?php if($show_sub_gender_column): ?>
            <th class="stock-report-sub-gender"><?php echo app('translator')->get('product.sub_gender'); ?></th>
            <?php endif; ?>
            <?php if($show_procurement_source_column): ?>
            <th class="stock-report-procurement-source"><?php echo app('translator')->get('product.procurement_source'); ?></th>
            <?php endif; ?>
            <?php if($show_sub_procurement_source_column): ?>
            <th class="stock-report-sub-procurement-source"><?php echo app('translator')->get('product.sub_procurement_source'); ?></th>
            <?php endif; ?>
            <th><?php echo app('translator')->get('sale.location'); ?></th>
            <th><?php echo app('translator')->get('purchase.unit_cost_price'); ?></th>
            <th><?php echo app('translator')->get('purchase.unit_selling_price'); ?></th>
            <th><?php echo app('translator')->get('report.current_stock'); ?></th>
            <?php if($show_stock_report_cost_value): ?>
            <th class="stock_price"><?php echo app('translator')->get('lang_v1.total_stock_price'); ?> <br><small>(<?php echo app('translator')->get('lang_v1.by_purchase_price'); ?>)</small></th>
            <?php endif; ?>
            <?php if($show_stock_report_sale_value): ?>
            <th class="stock_value_by_sale_price"><?php echo app('translator')->get('lang_v1.total_stock_price'); ?> <br><small>(<?php echo app('translator')->get('lang_v1.by_sale_price'); ?>)</small></th>
            <?php endif; ?>
            <?php if($show_stock_report_potential_profit): ?>
            <th class="potential_profit"><?php echo app('translator')->get('lang_v1.potential_profit'); ?></th>
            <?php endif; ?>
            <th><?php echo app('translator')->get('report.total_unit_sold'); ?></th>
            <th><?php echo app('translator')->get('lang_v1.total_unit_transfered'); ?></th>
            <th><?php echo app('translator')->get('lang_v1.total_unit_adjusted'); ?></th>
            <th><?php echo app('translator')->get('lang_v1.rack_details'); ?></th>
            <?php if(!empty($product_custom_field1)): ?>
            <th class="product_custom_field1"><?php echo e($product_custom_field1, false); ?></th>
            <?php endif; ?>
            <?php if(!empty($product_custom_field2)): ?>
            <th class="product_custom_field2"><?php echo e($product_custom_field2, false); ?></th>
            <?php endif; ?>
            <?php if(!empty($product_custom_field3)): ?>
            <th class="product_custom_field3"><?php echo e($product_custom_field3, false); ?></th>
            <?php endif; ?>
            <?php if(!empty($product_custom_field4)): ?>
            <th class="product_custom_field4"><?php echo e($product_custom_field4, false); ?></th>
            <?php endif; ?>
            <?php if(!empty($product_custom_field5)): ?>
            <th class="product_custom_field5"><?php echo e($product_custom_field5, false); ?></th>
            <?php endif; ?>
            <?php if(!empty($product_custom_field6)): ?>
            <th class="product_custom_field6"><?php echo e($product_custom_field6, false); ?></th>
            <?php endif; ?>
            <?php if(!empty($product_custom_field7)): ?>
            <th class="product_custom_field7"><?php echo e($product_custom_field7, false); ?></th>
            <?php endif; ?>
            <?php if(!empty($product_custom_field8)): ?>
            <th class="product_custom_field8"><?php echo e($product_custom_field8, false); ?></th>
            <?php endif; ?>
            <?php if($show_manufacturing_data): ?>
                <th class="current_stock_mfg"><?php echo app('translator')->get('manufacturing::lang.current_stock_mfg'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('manufacturing::lang.mfg_stock_tooltip') . '"></i>';
                }
            ?></th>
            <?php endif; ?>
        </tr>
    </thead>
    <tfoot>
        <tr class="bg-gray font-17 text-center footer-total">
            <td colspan="<?php echo e($footer_leading_colspan, false); ?>"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
            <td class="footer_total_stock"></td>
            <?php if($show_stock_report_cost_value): ?>
            <td class="footer_total_stock_price"></td>
            <?php endif; ?>
            <?php if($show_stock_report_sale_value): ?>
            <td class="footer_stock_value_by_sale_price"></td>
            <?php endif; ?>
            <?php if($show_stock_report_potential_profit): ?>
            <td class="footer_potential_profit"></td>
            <?php endif; ?>
            <td class="footer_total_sold"></td>
            <td class="footer_total_transfered"></td>
            <td class="footer_total_adjusted"></td>
            <td colspan="<?php echo e(1 + $active_custom_fields_count, false); ?>"></td>
            <?php if($show_manufacturing_data): ?>
                <td class="footer_total_mfg_stock"></td>
            <?php endif; ?>
        </tr>
    </tfoot>
</table>
</div>
