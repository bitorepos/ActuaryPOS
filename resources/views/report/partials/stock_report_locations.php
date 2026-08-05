
<div class="row" style="margin-bottom: 10px;">
    <div class="col-md-12">
        <button type="button" class="btn btn-primary float-end me-2 open-stock-report-print" id="openStockReportLocationsPrint" data-tab="locations">
            <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
        </button>
    </div>
</div>
<div id="stock_report_locations_content" style="overflow-x: auto;">
    <div class="text-center py-4">
        <p class="text-muted"><?php echo app('translator')->get('lang_v1.click_tab_to_load'); ?></p>
    </div>
</div>
