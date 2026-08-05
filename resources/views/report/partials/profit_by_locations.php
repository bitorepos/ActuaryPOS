<div class="table-responsive mt-2">
    <table class="table table-bordered table-striped table-text-center table-th-skin" id="profit_by_locations_table">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('sale.location'); ?></th>
                <th class="text-right"><?php echo app('translator')->get('lang_v1.gross_profit'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 footer-total">
                <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                <td class="footer_total text-right"></td>
            </tr>
        </tfoot>
    </table>
</div>
