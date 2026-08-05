<?php
  $custom_labels = json_decode(session('business.custom_labels'), true);
  $product_custom_field1 = !empty($custom_labels['product']['custom_field_1']) ? $custom_labels['product']['custom_field_1'] : __('lang_v1.product_custom_field1');
  $product_custom_field2 = !empty($custom_labels['product']['custom_field_2']) ? $custom_labels['product']['custom_field_2'] : __('lang_v1.product_custom_field2');
  $product_custom_field3 = !empty($custom_labels['product']['custom_field_3']) ? $custom_labels['product']['custom_field_3'] : __('lang_v1.product_custom_field3');
  $product_custom_field4 = !empty($custom_labels['product']['custom_field_4']) ? $custom_labels['product']['custom_field_4'] : __('lang_v1.product_custom_field4');
?>
<div class="row mb-2">
    <div class="col-sm-12 text-end">
        <button type="button" class="btn btn-primary open-stock-reorder-report-print">
            <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
        </button>
        <button type="button" class="sync_product_quantity btn btn-info"><?php echo app('translator')->get('lang_v1.sync_product_quantities'); ?> <i class="hide fas fa-sync fa-spin fa-fw"></i></button>
    </div>
</div>
<div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="stock_reorder_report_table">
    <thead>
        <tr>
            <th><?php echo app('translator')->get('messages.action'); ?></th>
            <th>SKU</th>
            <th style="width:200px"><?php echo app('translator')->get('business.product'); ?></th>
            <?php if($common_settings['enable_other_product_name']): ?>
            <th style="width:200px"><?php echo e(!empty($common_settings['other_product_name_label']) ? $common_settings['other_product_name_label'] . ':': __('product.other_product_name') . ':', false); ?></th>
            <?php endif; ?>
            <th><?php echo app('translator')->get('lang_v1.variation'); ?></th>
            <th><?php echo app('translator')->get('product.category'); ?></th>
            <th><?php echo app('translator')->get('sale.location'); ?></th>
            
            <th><?php echo app('translator')->get('report.current_stock'); ?></th>
            <th><?php echo app('translator')->get('product.alert_quantity_low'); ?></th>
            <th><?php echo app('translator')->get('product.alert_quantity_medium'); ?></th>
            <th><?php echo app('translator')->get('product.alert_quantity_high'); ?></th>
            <th><?php echo app('translator')->get('product.alert_quantity_max'); ?></th>
            
            
            
            
        </tr>
    </thead>
    <tfoot>
        <tr class="bg-gray font-17 text-center footer-total">
            <td colspan="6"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
            <td class="footer_total_stock"></td>
            
            
            <td colspan="4"></td>
            
        </tr>
    </tfoot>
</table>
</div>
