<div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="sr_payments_with_commission_table" style="width: 100%;">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.paid_on'); ?></th>
                <th class="text-right"><?php echo app('translator')->get('sale.amount'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                <th><?php echo app('translator')->get('contact.customer'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                <th><?php echo app('translator')->get('sale.sale'); ?></th>
                <th><?php echo app('translator')->get('messages.action'); ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 footer-total text-center">
                <td colspan="2"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                <td class="text-right"><span id="footer_total_amount"></span></td>
                <td colspan="4"></td>
            </tr>
        </tfoot>
    </table>
</div>
