<style>
    .dataTables_scrollHead {
        position: static !important;
    }
</style>
<div class="table-responsive" style="min-height: 80vh">
<table class="table table-bordered table-striped ajax_view table-hover table-th-skin" id="purchase_table" style="width:100% !important">
    <thead>
        <tr>
            <th><?php echo app('translator')->get('messages.action'); ?></th>
            <th><?php echo app('translator')->get('messages.date'); ?></th>
            <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
            <th><?php echo app('translator')->get('purchase.ref_no_short'); ?></th>
            <th><?php echo app('translator')->get('purchase.supplier'); ?></th>
            <th><?php echo app('translator')->get('contact.supplier_business_name'); ?></th>
            <th><?php echo app('translator')->get('purchase.purchase_status'); ?></th>
            <th><?php echo app('translator')->get('purchase.payment_status'); ?></th>
            <th class="text-right"><?php echo app('translator')->get('purchase.grand_total'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
            <th class="text-right"><?php echo app('translator')->get('purchase.payment_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?> &nbsp;&nbsp;<i class="fa fa-info-circle text-info no-print" data-bs-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="<?php echo e(__('messages.purchase_due_tooltip'), false); ?>" aria-hidden="true"></i></th>
            <th><?php echo app('translator')->get('purchase.shipping_details'); ?></th>
            <th class="text-right"><?php echo app('translator')->get('lang_v1.shipping_charges'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
            <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
            <th><?php echo app('translator')->get('purchase.location'); ?></th>

            <?php if(!empty($common_settings['enable_ledger_discount3'])): ?>
                <?php for($i=1; $i<=20; $i++): ?>
                    <th><?php echo e(!empty($common_settings['ledger_discount3_label']) ? $common_settings['ledger_discount3_label'] . ' '. sprintf('%02d', $i)  : __('lang_v1.ledger_discount3') . ' ' . sprintf('%02d', $i), false); ?></th>
                <?php endfor; ?>
            <?php endif; ?>
            <th><?php echo app('translator')->get('lang_v1.created_at'); ?></th>
        </tr>
    </thead>
    <tfoot>
        <tr class="bg-gray font-17 text-center footer-total">
            <td colspan="6"><strong class="text-left"><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
            <td class="footer_status_count"></td>
            <td class="footer_payment_status_count"></td>
            <td class="footer_purchase_total text-right"></td>
            <td class="text-right"><small><?php echo app('translator')->get('report.purchase_due'); ?> - <span class="footer_total_due"></span><br>
            <?php echo app('translator')->get('lang_v1.purchase_return'); ?> - <span class="footer_total_purchase_return_due"></span>
            </small></td>
            <td></td>
            <td class="footer_total_shipping text-right"></td>
            <td></td>
            <td></td>
            <?php if(!empty($common_settings['enable_ledger_discount3'])): ?>
                <?php for($i=1; $i<=20; $i++): ?>
                    <td></td>
                <?php endfor; ?>
            <?php endif; ?>
            <td></td>
        </tr>
    </tfoot>
</table>
</div>
