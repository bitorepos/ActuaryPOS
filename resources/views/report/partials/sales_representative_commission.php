<div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="sr_sales_with_commission_table" style="width: 100%;">
    <thead>
        <tr>
            <th><?php echo app('translator')->get('messages.date'); ?></th>
            <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
            <th><?php echo app('translator')->get('sale.customer_name'); ?></th>
            <th><?php echo app('translator')->get('sale.location'); ?></th>
            <th><?php echo app('translator')->get('sale.payment_status'); ?></th>
            <th class="text-right"><?php echo app('translator')->get('sale.total_amount'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
            <th class="text-right"><?php echo app('translator')->get('sale.total_paid'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
            <th class="text-right"><?php echo app('translator')->get('sale.total_remaining'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
        </tr>
    </thead>
    <tfoot>
        <tr class="bg-gray font-17 footer-total text-center">
            <td colspan="4"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
            <td id="footer_payment_status_count"></td>
            <td class="text-right"><span id="footer_sale_total"></span></td>
            <td class="text-right"><span id="footer_total_paid"></span></td>
            <td class="text-right"><small><?php echo app('translator')->get('lang_v1.sell_due'); ?> - <span id="footer_total_remaining"></span><br><?php echo app('translator')->get('lang_v1.sell_return_due'); ?> - <span id="footer_total_sell_return_due"></span></small></td>
        </tr>
    </tfoot>
</table>
</div>
