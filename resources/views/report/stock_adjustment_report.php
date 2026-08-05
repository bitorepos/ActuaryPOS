
<?php $__env->startSection('title', __( 'report.stock_adjustment_report' )); ?>
<?php
    $user_settings = json_decode(auth()->user()->user_settings, true);
    $show_stock_adjustment_report_cost_value = $show_stock_adjustment_report_cost_value ?? empty($hide_stock_adjustment_report_cost_value);
    $show_stock_adjustment_report_sale_value = $show_stock_adjustment_report_sale_value ?? empty($hide_stock_adjustment_report_sale_value);
?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_stock_adjustment_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'report.stock_adjustment_report' ); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3 offset-md-7 col-6">
            <div class="input-group">
                <span class="input-group-text bg-light-blue"><i class="fa fa-map-marker"></i></span>
                 <select class="form-control select2" id="stock_adjustment_location_filter" style="width: 80%">
                    <?php $__currentLoopData = $business_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>"><?php echo e($value, false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="form-group mb-2 float-end">
                <div class="input-group">
                  <button type="button" class="btn btn-primary" id="stock_adjustment_date_filter">
                    <span>
                      <i class="fa fa-calendar"></i> <?php echo e(__('messages.filter_by_date'), false); ?>

                    </span>
                    <i class="fa fa-caret-down"></i>
                  </button>
                </div>
            </div>
        </div>
    </div>
    <br>

    
    <?php if($show_stock_adjustment_report_cost_value || $show_stock_adjustment_report_sale_value): ?>
        <div class="row">
            <?php if($show_stock_adjustment_report_cost_value): ?>
                <div class="col-sm-6">
                    <?php $__env->startComponent('components.widget'); ?>
                        <table class="table no-border mb-0">
                            <tr>
                                <th><?php echo e(__('report.total_stock_adjustment'), false); ?>:</th>
                                <td><span class="total_amount"><i class="fas fa-sync fa-spin fa-fw"></i></span></td>
                            </tr>
                        </table>
                    <?php echo $__env->renderComponent(); ?>
                </div>
            <?php endif; ?>
            <?php if($show_stock_adjustment_report_sale_value): ?>
                <div class="col-sm-6">
                    <?php $__env->startComponent('components.widget'); ?>
                        <table class="table no-border mb-0">
                            <tr>
                                <th><?php echo e(__('report.total_recovered'), false); ?>:</th>
                                <td><span class="total_recovered"><i class="fas fa-sync fa-spin fa-fw"></i></span></td>
                            </tr>
                        </table>
                    <?php echo $__env->renderComponent(); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#sar_totals_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-calculator" aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.totals'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sar_summary_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-list" aria-hidden="true"></i> <?php echo app('translator')->get('report.summary'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sar_detailed_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-bars" aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.detailed'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sar_products_summary_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-cubes" aria-hidden="true"></i> <?php echo app('translator')->get('report.product_summary'); ?></a>
                    </li>
                </ul>
                <div class="tab-content">

                    
                    <div class="tab-pane fade show active" id="sar_totals_tab">
                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-primary open-stock-adjustment-report-print" data-tab="totals">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin" id="stock_adjustment_totals_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.count'); ?></th>
                                        <th><?php echo app('translator')->get('stock_adjustment.stock_adjustment'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                        <th><?php echo app('translator')->get('stock_adjustment.stock_take'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                        <th><?php echo app('translator')->get('report.total_stock_adjustment'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                        <th><?php echo app('translator')->get('report.total_recovered'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total">
                                        <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td class="footer_totals_count text-center"></td>
                                        <td class="footer_totals_sa"></td>
                                        <td class="footer_totals_st"></td>
                                        <td class="footer_totals_amount"></td>
                                        <td class="footer_totals_recovered"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="sar_summary_tab">
                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-primary open-stock-adjustment-report-print" data-tab="summary">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped ajax_view table-th-skin" id="stock_adjustment_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                        <th><?php echo app('translator')->get('business.location'); ?></th>
                                        <th><?php echo app('translator')->get('stock_adjustment.adjustment_type'); ?></th>
                                        <th><?php echo app('translator')->get('stock_adjustment.total_amount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                        <th><?php echo app('translator')->get('stock_adjustment.total_amount_recovered'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                        <th><?php echo app('translator')->get('stock_adjustment.reason_for_stock_adjustment'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total">
                                        <td colspan="5"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td class="footer_sar_total"></td>
                                        <td class="footer_sar_recovered"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="sar_detailed_tab">
                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-primary open-stock-adjustment-report-print" data-tab="detailed">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped ajax_view table-th-skin" id="stock_adjustment_detailed_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                        <th><?php echo app('translator')->get('business.location'); ?></th>
                                        <th><?php echo app('translator')->get('stock_adjustment.adjustment_type'); ?></th>
                                        <th><?php echo app('translator')->get('sale.product'); ?></th>
                                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.unit'); ?></th>
                                        <th><?php echo app('translator')->get('purchase.purchase_quantity'); ?></th>
                                        <th><?php echo app('translator')->get('sale.unit_price'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                        <th><?php echo app('translator')->get('sale.subtotal'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                        <th><?php echo app('translator')->get('stock_adjustment.reason_for_stock_adjustment'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total">
                                        <td colspan="9"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td class="footer_sar_detail_total"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="sar_products_summary_tab">
                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-primary open-stock-adjustment-report-print" data-tab="products_summary">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin" id="stock_adjustment_products_summary_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('sale.product'); ?></th>
                                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.unit'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.count'); ?></th>
                                        <th><?php echo app('translator')->get('purchase.purchase_quantity'); ?></th>
                                        <th><?php echo app('translator')->get('sale.subtotal'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total">
                                        <td colspan="3"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td class="footer_sar_ps_count text-center"></td>
                                        <td class="footer_sar_ps_qty text-end"></td>
                                        <td class="footer_sar_ps_total"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
	

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="<?php echo e(asset('js/stock_adjustment.js?v=' . $asset_v), false); ?>"></script>
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<script>
$(document).ready(function(){
    function getStockAdjustmentReportFilterParams() {
        var params = {
            location_id: $('#stock_adjustment_location_filter').val()
        };
        var sarPicker = $('#stock_adjustment_date_filter').data('daterangepicker');
        if (sarPicker) {
            params.start_date = sarPicker.startDate.format('YYYY-MM-DD');
            params.end_date = sarPicker.endDate.format('YYYY-MM-DD');
        }

        return params;
    }

    $(document).on('click', '.open-stock-adjustment-report-print', function(e) {
        e.preventDefault();
        var params = getStockAdjustmentReportFilterParams();
        params.tab = $(this).data('tab') || 'totals';
        var url = "<?php echo e(url('reports/stock-adjustment-report-print'), false); ?>?" + $.param(params);
        window.open(url, '_blank');
    });

    <?php if(!empty($user_settings['rpt_stock_sadj_hide_date'])): ?>
        stock_adjustment_table.column(1).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_sadj_hide_ref_no'])): ?>
        stock_adjustment_table.column(2).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_sadj_hide_location'])): ?>
        stock_adjustment_table.column(3).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_sadj_hide_adjustment_type'])): ?>
        stock_adjustment_table.column(4).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_sadj_hide_total_amount'])): ?>
        stock_adjustment_table.column(5).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_sadj_hide_total_recovered'])): ?>
        stock_adjustment_table.column(6).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_sadj_hide_reason'])): ?>
        stock_adjustment_table.column(7).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_sadj_hide_added_by'])): ?>
        stock_adjustment_table.column(8).visible(false);
    <?php endif; ?>
    <?php if(!empty($hide_stock_adjustment_report_cost_value)): ?>
        if (typeof stock_adjustment_table !== 'undefined' && stock_adjustment_table) {
            stock_adjustment_table.column(5).visible(false);
        }
    <?php endif; ?>
    <?php if(!empty($hide_stock_adjustment_report_sale_value)): ?>
        if (typeof stock_adjustment_table !== 'undefined' && stock_adjustment_table) {
            stock_adjustment_table.column(6).visible(false);
        }
    <?php endif; ?>

    // ── Totals (daily breakdown) table ──────────────────────────────────────
    // Note: tables are exposed on `window` so any consumer (report.js,
    // stock_adjustment.js, future code) can reload them. Local `var` would
    // hide them from those scripts, which previously broke real-time refresh.
    window.stock_adjustment_totals_table = $('#stock_adjustment_totals_table').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        aaSorting: [[0, 'desc']],
        ajax: {
            url: '/reports/stock-adjustment-totals',
            data: function(d) {
                d.location_id = $('#stock_adjustment_location_filter').val();
                var sarPicker = $('#stock_adjustment_date_filter').data('daterangepicker');
                if (sarPicker) {
                    d.start_date = sarPicker.startDate.format('YYYY-MM-DD');
                    d.end_date   = sarPicker.endDate.format('YYYY-MM-DD');
                }
            }
        },
        columns: [
            { data: 'date',                  name: 'date',              searchable: false },
            { data: 'adjustment_count',      name: 'adjustment_count',  searchable: false, className: 'text-center' },
            { data: 'total_stock_adjustment',name: 'total_stock_adjustment', searchable: false },
            { data: 'total_stock_take',      name: 'total_stock_take',  searchable: false },
            { data: 'total_amount',          name: 'total_amount',      searchable: false },
            { data: 'total_recovered',       name: 'total_recovered',   searchable: false },
        ],
        fnDrawCallback: function() {
            __currency_convert_recursively($('#stock_adjustment_totals_table'));
        },
        footerCallback: function(row, data) {
            var count = 0, sa = 0, st = 0, total = 0, recovered = 0;
            for (var r in data) {
                count     += parseInt(data[r].adjustment_count) || 0;
                sa        += $(data[r].total_stock_adjustment).data('orig-value') ? parseFloat($(data[r].total_stock_adjustment).data('orig-value')) : 0;
                st        += $(data[r].total_stock_take).data('orig-value')       ? parseFloat($(data[r].total_stock_take).data('orig-value'))       : 0;
                total     += $(data[r].total_amount).data('orig-value')            ? parseFloat($(data[r].total_amount).data('orig-value'))            : 0;
                recovered += $(data[r].total_recovered).data('orig-value')         ? parseFloat($(data[r].total_recovered).data('orig-value'))         : 0;
            }
            $('.footer_totals_count').html(count);
            $('.footer_totals_sa').html(__currency_trans_from_en(sa, true));
            $('.footer_totals_st').html(__currency_trans_from_en(st, true));
            $('.footer_totals_amount').html(__currency_trans_from_en(total, true));
            $('.footer_totals_recovered').html(__currency_trans_from_en(recovered, true));
        },
    });

    // ── Detailed table — initialise immediately (no longer deferred until
    // tab-show, so date-range / location filters apply in real time even
    // when the user has not opened the Detailed tab yet). scrollX-rendering
    // inside the hidden tab-pane is corrected by the columns.adjust() call
    // in the shown.bs.tab handler below.
    window.stock_adjustment_detailed_table = $('#stock_adjustment_detailed_table').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        aaSorting: [[0, 'desc']],
        ajax: {
            url: '/reports/stock-adjustment-detailed',
            data: function(d) {
                d.location_id = $('#stock_adjustment_location_filter').val();
                var sarPicker = $('#stock_adjustment_date_filter').data('daterangepicker');
                if (sarPicker) {
                    d.start_date = sarPicker.startDate.format('YYYY-MM-DD');
                    d.end_date   = sarPicker.endDate.format('YYYY-MM-DD');
                }
            }
        },
        columns: [
            { data: 'transaction_date', name: 'T.transaction_date' },
            { data: 'ref_no',           name: 'T.ref_no' },
            { data: 'location_name',    name: 'BL.name' },
            { data: 'adjustment_type',  name: 'T.adjustment_type' },
            { data: 'product_name',     name: 'P.name' },
            { data: 'sku',              name: 'V.sub_sku' },
            { data: 'unit',             name: 'U.short_name' },
            { data: 'quantity',         name: 'stock_adjustment_lines.quantity' },
            { data: 'unit_price',       name: 'stock_adjustment_lines.unit_price' },
            { data: 'line_total',       name: 'line_total', searchable: false },
            { data: 'additional_notes', name: 'T.additional_notes' },
            { data: 'added_by',         name: 'usr.first_name' },
        ],
        fnDrawCallback: function() {
            __currency_convert_recursively($('#stock_adjustment_detailed_table'));
        },
        footerCallback: function(row, data) {
            var total = 0;
            for (var r in data) {
                total += $(data[r].line_total).data('orig-value') ?
                    parseFloat($(data[r].line_total).data('orig-value')) : 0;
            }
            $('.footer_sar_detail_total').html(__currency_trans_from_en(total, true));
        },
    });

    // ── Products Summary table — per-product aggregates over the filtered
    // date range / location. Initialised on page load so the picker can
    // refresh it in real time even before the tab is opened.
    window.stock_adjustment_products_summary_table = $('#stock_adjustment_products_summary_table').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        aaSorting: [[5, 'desc']],
        ajax: {
            url: '/reports/stock-adjustment-products-summary',
            data: function(d) {
                d.location_id = $('#stock_adjustment_location_filter').val();
                var sarPicker = $('#stock_adjustment_date_filter').data('daterangepicker');
                if (sarPicker) {
                    d.start_date = sarPicker.startDate.format('YYYY-MM-DD');
                    d.end_date   = sarPicker.endDate.format('YYYY-MM-DD');
                }
            }
        },
        columns: [
            { data: 'product_name',     name: 'P.name' },
            { data: 'sku',              name: 'V.sub_sku' },
            { data: 'unit',             name: 'U.short_name', searchable: false },
            { data: 'adjustment_count', name: 'adjustment_count', searchable: false, orderable: false, className: 'text-center' },
            { data: 'total_quantity',   name: 'total_quantity',   searchable: false, orderable: false, className: 'text-end' },
            { data: 'total_value',      name: 'total_value',      searchable: false, orderable: false },
        ],
        fnDrawCallback: function() {
            __currency_convert_recursively($('#stock_adjustment_products_summary_table'));
        },
        footerCallback: function(row, data) {
            var count = 0, qty = 0, total = 0;
            for (var r in data) {
                count += parseInt(data[r].adjustment_count) || 0;
                var rawQty = $('<div/>').html(data[r].total_quantity).text();
                qty   += parseFloat(String(rawQty).replace(/[^0-9.\-]/g, '')) || 0;
                total += $(data[r].total_value).data('orig-value') ? parseFloat($(data[r].total_value).data('orig-value')) : 0;
            }
            $('.footer_sar_ps_count').html(count);
            $('.footer_sar_ps_qty').html(qty.toFixed(2));
            $('.footer_sar_ps_total').html(__currency_trans_from_en(total, true));
        },
    });

    <?php if(!empty($hide_stock_adjustment_report_cost_value)): ?>
        stock_adjustment_totals_table.column(2).visible(false);
        stock_adjustment_totals_table.column(3).visible(false);
        stock_adjustment_totals_table.column(4).visible(false);
        stock_adjustment_detailed_table.column(8).visible(false);
        stock_adjustment_detailed_table.column(9).visible(false);
        stock_adjustment_products_summary_table.column(5).visible(false);
    <?php endif; ?>
    <?php if(!empty($hide_stock_adjustment_report_sale_value)): ?>
        stock_adjustment_totals_table.column(5).visible(false);
    <?php endif; ?>

    // Single source of truth for "filters changed → refetch every tab".
    function reloadAllSarTables() {
        if (window.stock_adjustment_totals_table)            window.stock_adjustment_totals_table.ajax.reload(null, false);
        if (window.stock_adjustment_detailed_table)          window.stock_adjustment_detailed_table.ajax.reload(null, false);
        if (window.stock_adjustment_products_summary_table)  window.stock_adjustment_products_summary_table.ajax.reload(null, false);
        // Summary table (defined globally by stock_adjustment.js)
        if (typeof stock_adjustment_table !== 'undefined' && stock_adjustment_table) {
            stock_adjustment_table.ajax.reload(null, false);
        }
    }

    // ── Reload every tab when filters change ────────────────────────────────
    $('#stock_adjustment_location_filter').on('change', reloadAllSarTables);
    $('#stock_adjustment_date_filter').on('apply.daterangepicker cancel.daterangepicker', reloadAllSarTables);

    // ── Recalculate DataTables column widths whenever a tab becomes visible ──
    // Without this, scrollX tables initialised inside hidden tab-panes can
    // render with broken layout. We use columns.adjust() (no draw) so it
    // does NOT issue an extra server-side fetch.
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr('href');
        if (target === '#sar_totals_tab' && window.stock_adjustment_totals_table) {
            window.stock_adjustment_totals_table.columns.adjust();
        }
        if (target === '#sar_summary_tab' && typeof stock_adjustment_table !== 'undefined' && stock_adjustment_table) {
            stock_adjustment_table.columns.adjust();
        }
        if (target === '#sar_detailed_tab' && window.stock_adjustment_detailed_table) {
            window.stock_adjustment_detailed_table.columns.adjust();
        }
        if (target === '#sar_products_summary_tab' && window.stock_adjustment_products_summary_table) {
            window.stock_adjustment_products_summary_table.columns.adjust();
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>