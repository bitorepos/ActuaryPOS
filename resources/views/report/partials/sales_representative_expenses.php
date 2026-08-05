<div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="sr_expenses_report" style="width: 100%;">
    <thead>
        <tr>
            <th><?php echo app('translator')->get('messages.date'); ?></th>
            <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
            <th><?php echo app('translator')->get('expense.expense_category'); ?></th>
            <th><?php echo app('translator')->get('business.location'); ?></th>
            <th><?php echo app('translator')->get('sale.payment_status'); ?></th>
            <th class="text-right"><?php echo app('translator')->get('sale.total_amount'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
            <th><?php echo app('translator')->get('expense.expense_for'); ?></th>
            <th><?php echo app('translator')->get('expense.expense_note'); ?></th>
        </tr>
    </thead>
    <tfoot>
        <tr class="bg-gray font-17 text-center footer-total">
            <td colspan="4"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
            <td id="er_footer_payment_status_count"></td>
            <td class="text-right"><span id="footer_expense_total"></span></td>
            <td colspan="2"></td>
        </tr>
    </tfoot>
</table>
</div>
