<style>
    .dataTables_scrollHead {
        position: static !important;
    }
</style>
<div class="table-responsive" style="min-height: 80vh">
    <table class="table table-bordered table-striped ajax_view table-th-skin" id="purchase_return_datatable">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('messages.date'); ?></th>
                <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.parent_purchase'); ?></th>
                <th><?php echo app('translator')->get('purchase.supplier'); ?></th>
                <th><?php echo app('translator')->get('purchase.payment_status'); ?></th>
                <th class="text-right"><?php echo app('translator')->get('purchase.grand_total'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <th class="text-right"><?php echo app('translator')->get('purchase.payment_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?> &nbsp;&nbsp;<i class="fa fa-info-circle text-info" data-bs-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="<?php echo e(__('messages.purchase_due_tooltip'), false); ?>" aria-hidden="true"></i></th>
                <th><?php echo app('translator')->get('purchase.location'); ?></th>
                <th><?php echo app('translator')->get('messages.action'); ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 text-center footer-total">
                <td colspan="4"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                <td id="footer_payment_status_count"></td>
                <td class="text-right"><span id="footer_purchase_return_total"></span></td>
                <td class="text-right"><span id="footer_total_due"></span></td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>
