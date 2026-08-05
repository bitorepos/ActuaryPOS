<div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="stock_performance_summary_table" style="width:100%">
    <thead>
        <tr>
            <th>SKU</th>
            <th><?php echo app('translator')->get('report.product_name'); ?></th>
            <th><?php echo app('translator')->get('report.last_sold'); ?></th>
            <th><?php echo app('translator')->get('report.on_hand'); ?></th>
            <th><?php echo app('translator')->get('report.cost_rs'); ?></th>
            <th><?php echo app('translator')->get('report.amount_rs'); ?></th>
            <th><?php echo app('translator')->get('report.qty_sold'); ?></th>
            <th><?php echo app('translator')->get('report.profit_rs'); ?></th>
            <th><?php echo app('translator')->get('report.gp_profit_percent'); ?></th>
        </tr>
    </thead>
    <tfoot>
        <tr class="bg-gray font-17 text-center footer-total">
            <td colspan="3"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
            <td class="sp_footer_on_hand"></td>
            <td class="sp_footer_cost"></td>
            <td class="sp_footer_amount"></td>
            <td class="sp_footer_qty_sold"></td>
            <td class="sp_footer_profit"></td>
            <td></td>
        </tr>
    </tfoot>
</table>
</div>
