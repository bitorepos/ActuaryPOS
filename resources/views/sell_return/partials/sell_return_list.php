<style>
    #sell_return_table_wrapper .dataTables_scrollHead {
        position: static !important;
    }

    #sell_return_table_wrapper .dataTables_scrollHead table.dataTable thead th {
        padding: 4px 5px !important;
        font-size: 0.8rem;
        line-height: 1.2;
        white-space: nowrap;
        box-sizing: border-box;
    }

    #sell_return_table_wrapper .dataTables_scrollHead table.dataTable thead th.sorting,
    #sell_return_table_wrapper .dataTables_scrollHead table.dataTable thead th.sorting_asc,
    #sell_return_table_wrapper .dataTables_scrollHead table.dataTable thead th.sorting_desc {
        padding-right: 26px !important;
    }

    #sell_return_table_wrapper .dataTables_scrollBody table#sell_return_table thead th {
        height: 0 !important;
        line-height: 0 !important;
        padding-top: 0 !important;
        padding-bottom: 0 !important;
        border-top-width: 0 !important;
        border-bottom-width: 0 !important;
    }

    #sell_return_table_wrapper .dataTables_scrollBody table#sell_return_table thead th::before,
    #sell_return_table_wrapper .dataTables_scrollBody table#sell_return_table thead th::after {
        content: "" !important;
        display: none !important;
    }
</style>
<div class="table-responsive" style="min-height: 80vh">
    <table class="table table-bordered table-striped ajax_view table-th-skin" id="sell_return_table" style="width:100% !important">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('messages.action'); ?></th>
                <th><?php echo app('translator')->get('messages.date'); ?></th>
                <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.parent_sale'); ?></th>
                <th><?php echo app('translator')->get('sale.customer_name'); ?></th>
                <th><?php echo app('translator')->get('purchase.payment_status'); ?></th>
                <th><?php echo app('translator')->get('sale.total_amount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <th><?php echo app('translator')->get('purchase.payment_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <th><?php echo app('translator')->get('sale.location'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.created_at'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.updated_at'); ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 text-center footer-total">
                <td></td>
                <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="footer_payment_status_count_sr"></td>
                <td class="footer_sell_return_total"></td>
                <td class="footer_total_due_sr"></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>
