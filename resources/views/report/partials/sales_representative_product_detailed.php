<div class="table-responsive">
    <table class="table table-bordered table-striped table-th-skin"
        id="srr_product_detailed_table">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('product.sku'); ?></th>
                <th style="width:450px"><?php echo app('translator')->get('sale.product'); ?></th>
                <th style="width:350px"><?php echo app('translator')->get('sale.customer_name'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.contact_id'); ?></th>
                <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                <th><?php echo app('translator')->get('messages.date'); ?></th>
                <th class="text-right"><?php echo app('translator')->get('sale.qty'); ?></th>
                <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                <th class="text-right"><?php echo app('translator')->get('sale.scheme_qty'); ?></th>
                <?php endif; ?>
                <th class="text-right"><?php echo app('translator')->get('sale.unit_price'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                <th class="text-right"><?php echo app('translator')->get('sale.subtotal'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                <th class="text-right"><?php echo app('translator')->get('sale.discount'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                <th class="text-right"><?php echo app('translator')->get('sale.tax'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                <th class="text-right"><?php echo app('translator')->get('sale.price_inc_tax'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 footer-total text-center">
                <td colspan="6"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                <td id="footer_total_sold" class="text-right"></td>
                <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                <td id="footer_total_foc_sold" class="text-right"></td>
                <?php endif; ?><td class="text-right"></td>
                <td id="footer_before_discount_subtotal" class="text-right"></td>
                <td class="text-right"></td>
                
                <td id="footer_tax" class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"><span id="footer_subtotal"></span></td>
            </tr>
        </tfoot>
    </table>
</div>
