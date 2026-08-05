<div class="table-responsive">
    <table class="table table-bordered table-striped table-th-skin" style="width: 100%"
        id="srr_product_summary_table">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('product.sku'); ?></th>
                <th style="width:450px"><?php echo app('translator')->get('sale.product'); ?></th>
                <th class="text-right"><?php echo app('translator')->get('sale.qty'); ?></th>
                <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                <th class="text-right"><?php echo app('translator')->get('sale.scheme_qty'); ?></th>
                <?php endif; ?>
                <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 footer-total text-center">
                <td colspan="2"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                <td id="footer_total_sold_summary" class="text-right"></td>
                <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                <td id="footer_total_foc_sold_summary" class="text-right"></td>
                <?php endif; ?>
                <td class="text-right"><span id="footer_subtotal_summary"></span></td>
            </tr>
        </tfoot>
    </table>
</div>
