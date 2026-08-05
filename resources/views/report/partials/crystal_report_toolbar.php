
<?php
    $print_url = $print_url ?? url('reports/stock-report-print');
?>
<div class="cr-toolbar">
    <span class="cr-title"><?php echo e($report_title, false); ?></span>

    <div class="cr-group">
        <button class="cr-btn cr-iconbtn" id="zoomOut" title="Zoom Out">&minus;</button>
        <span class="cr-zoom-label" id="zoomLabel">100%</span>
        <button class="cr-btn cr-iconbtn" id="zoomIn" title="Zoom In">+</button>
        <button class="cr-btn cr-iconbtn" id="zoomReset" title="Fit / Reset" style="font-size:12px;">100%</button>
    </div>

    <div class="cr-group">
        <button class="cr-btn cr-iconbtn" id="prevPage" title="Previous Page">&#8249;</button>
        <span class="cr-page-label"><input type="text" class="cr-page-input" id="pageInput" value="1"> / <?php echo e($total_pages, false); ?></span>
        <button class="cr-btn cr-iconbtn" id="nextPage" title="Next Page">&#8250;</button>
    </div>

    <div class="cr-group">
        <a class="cr-btn success" href="<?php echo e($print_url, false); ?>?output=excel<?php echo e(!empty($query_string) ? '&'.$query_string : '', false); ?>">
            &#128202; <?php echo e(__('lang_v1.export_to_excel') ?? 'Excel', false); ?>

        </a>
        <a class="cr-btn danger" href="<?php echo e($print_url, false); ?>?output=pdf<?php echo e(!empty($query_string) ? '&'.$query_string : '', false); ?>">
            &#128196; PDF
        </a>
        <button class="cr-btn primary" id="printBtn">&#128424; <?php echo e(__('messages.print'), false); ?> A4</button>
        <button class="cr-btn" id="closeBtn">&times; <?php echo e(__('messages.close'), false); ?></button>
    </div>
</div>
