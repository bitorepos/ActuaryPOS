<div class="tab-pane fade" id="psr_by_cat_tab" role="tabpanel">
    <div class="row no-print">
        <div class="col-sm-12 mb-2">
            <button type="button" class="btn btn-primary float-end open-product-sell-report-print" data-tab="by_category">
                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-th-skin" 
        id="product_sell_report_by_category" style="width: 100%;">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('category.category'); ?></th>
                    <th class="text-right"><?php echo app('translator')->get('report.current_stock'); ?></th>
                    <th class="text-right"><?php echo app('translator')->get('report.total_unit_sold'); ?></th>
                    <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                    <th class="text-right"><?php echo app('translator')->get('report.total_foc_unit_sold'); ?></th>
                    <?php endif; ?>
                    <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> ()</th>
                    <th class="text-right"><?php echo app('translator')->get('purchase.cost_total'); ?> ()</th>
                    <th class="text-right"><?php echo app('translator')->get('lang_v1.profit'); ?> ()</th>
                    <th class="text-right"><?php echo app('translator')->get('lang_v1.gross_profit'); ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr class="bg-gray font-17 footer-total text-center">
                    <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                    <td id="footer_psr_by_cat_total_stock" class="text-right"></td>
                    <td id="footer_psr_by_cat_total_sold" class="text-right"></td>
                    <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                    <td id="footer_psr_by_cat_total_foc_sold" class="text-right"></td>
                    <?php endif; ?>
                    <td class="text-right"><span class="display_currency" id="footer_psr_by_cat_total_sell"></span></td>
                    <td class="text-right"><span class="display_currency" id="footer_psr_by_cat_cost_total"></span></td>
                    <td class="text-right"><span class="display_currency" id="footer_psr_by_cat_profit"></span></td>
                    <td class="text-right"><span id="footer_psr_by_cat_gross_profit"></span></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
