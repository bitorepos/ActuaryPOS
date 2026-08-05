
<?php $__env->startSection('title', __('lang_v1.discounts_report')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header -->
<section class="content-header">
    <h1><?php echo e(__('lang_v1.discounts_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_discounts_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => '#', 'method' => 'get', 'id' => 'discounts_report_form', 'class' => 'row']); ?>

            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('dr_location_id', __('purchase.business_location') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                        <?php echo Form::select('dr_location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'style' => 'width:80%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('dr_customer_id', __('contact.customer') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <?php echo Form::select('dr_customer_id', $customers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'style' => 'width:80%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('dr_discount_id', __('lang_v1.discount') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                        <?php echo Form::select('dr_discount_id', $discounts, null, ['class' => 'form-control select2', 'style' => 'width:80%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('dr_date_filter', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('dr_date_filter', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'dr_date_filter', 'readonly']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('dr_discount_type_filter', __('lang_v1.discount') . ' ' . __('lang_v1.type') . ':'); ?>

                    <?php echo Form::select('dr_discount_type_filter', ['' => __('messages.all'), 'line_only' => __('lang_v1.line_discount'), 'order_only' => __('lang_v1.order_discount')], null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <?php echo Form::close(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <div class="row mb-3" id="discount_kpi_cards">
        <div class="col-md-3 col-sm-6">
            <div class="card radius-10">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-1"><?php echo app('translator')->get('lang_v1.total_discount'); ?></h6>
                    <h4 class="mb-0"><span id="kpi_total_discount" class="display_currency" data-currency_symbol="true">0</span></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card radius-10">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-1"><?php echo app('translator')->get('lang_v1.line_discount'); ?></h6>
                    <h4 class="mb-0"><span id="kpi_line_discount" class="display_currency" data-currency_symbol="true">0</span></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card radius-10">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-1"><?php echo app('translator')->get('lang_v1.order_discount'); ?></h6>
                    <h4 class="mb-0"><span id="kpi_order_discount" class="display_currency" data-currency_symbol="true">0</span></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card radius-10">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-1"><?php echo app('translator')->get('lang_v1.discount_to_sales_ratio'); ?></h6>
                    <h4 class="mb-0"><span id="kpi_discount_ratio">0</span>%</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active pb-2 pe-2 ps-2" href="#dr_summary" data-bs-toggle="tab" role="tab"><?php echo app('translator')->get('report.summary'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#dr_detail" data-bs-toggle="tab" role="tab"><?php echo app('translator')->get('lang_v1.details'); ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    
                    <div class="tab-pane fade show active" id="dr_summary" role="tabpanel">
                        <div class="text-end mb-2 mt-3">
                            <button type="button" class="btn btn-primary discounts-report-print-btn" data-tab="summary">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div class="row mt-3">
                            
                            <div class="col-md-6">
                                <h5><?php echo app('translator')->get('lang_v1.line_discount'); ?> <?php echo app('translator')->get('report.summary'); ?></h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-th-skin" id="line_discount_summary_table">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get('lang_v1.discount'); ?> <?php echo app('translator')->get('lang_v1.name'); ?></th>
                                                <th><?php echo app('translator')->get('sale.qty'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.no_of_transactions'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.total_discount'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="line_discount_summary_body"></tbody>
                                        <tfoot>
                                            <tr class="bg-gray font-17 text-right">
                                                <th><?php echo app('translator')->get('sale.total'); ?>:</th>
                                                <th id="line_total_lines">0</th>
                                                <th id="line_total_transactions">0</th>
                                                <th id="line_total_amount">0</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5><?php echo app('translator')->get('lang_v1.order_discount'); ?> <?php echo app('translator')->get('report.summary'); ?></h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-th-skin" id="order_discount_summary_table">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get('lang_v1.discount'); ?> <?php echo app('translator')->get('lang_v1.name'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.no_of_transactions'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.total_discount'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="order_discount_summary_body"></tbody>
                                        <tfoot>
                                            <tr class="bg-gray font-17 text-right">
                                                <th><?php echo app('translator')->get('sale.total'); ?>:</th>
                                                <th id="order_total_transactions">0</th>
                                                <th id="order_total_amount">0</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-th-skin">
                                        <thead>
                                            <tr class="bg-light">
                                                <th><?php echo app('translator')->get('lang_v1.total_sales'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.total_transactions'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.total_discount'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.discount_to_sales_ratio'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span id="summary_total_sales" class="display_currency" data-currency_symbol="true">0</span></td>
                                                <td><span id="summary_total_transactions">0</span></td>
                                                <td><span id="summary_grand_total_discount" class="display_currency" data-currency_symbol="true">0</span></td>
                                                <td><span id="summary_discount_ratio">0</span>%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="dr_detail" role="tabpanel">
                        <div class="text-end mb-2 mt-3">
                            <button type="button" class="btn btn-primary discounts-report-print-btn" data-tab="detail">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-striped table-th-skin" id="discounts_report_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('sale.location'); ?></th>
                                        <th><?php echo app('translator')->get('contact.customer'); ?></th>
                                        <th><?php echo app('translator')->get('sale.product'); ?></th>
                                        <th><?php echo app('translator')->get('sale.qty'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.unit_price_before_discount'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.line_discount'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.line_discount'); ?> <?php echo app('translator')->get('sale.total'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.order_discount'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.order_discount'); ?> <?php echo app('translator')->get('sale.total'); ?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-right">
                                        <td colspan="5"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td id="dr_footer_qty"></td>
                                        <td></td>
                                        <td></td>
                                        <td><span class="display_currency" id="dr_footer_line_discount" data-currency_symbol="true"></span></td>
                                        <td></td>
                                        <td><span class="display_currency" id="dr_footer_order_discount" data-currency_symbol="true"></span></td>
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

<div class="modal fade view_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<script>
$(document).ready(function () {

    // ========== Details DataTable ==========
    var discounts_report_table = $('table#discounts_report_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [[1, 'desc']],
        ajax: {
            url: '/reports/discounts-report',
            data: function (d) {
                d.location_id = $('select#dr_location_id').val();
                d.customer_id = $('select#dr_customer_id').val();
                d.discount_id = $('select#dr_discount_id').val();
                d.discount_type_filter = $('select#dr_discount_type_filter').val();
                var start = '', end = '';
                if ($('input#dr_date_filter').val()) {
                    start = $('input#dr_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    end = $('input#dr_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                }
                d.start_date = start;
                d.end_date = end;
            },
        },
        columns: [
            { data: 'invoice_no', name: 'transactions.invoice_no' },
            { data: 'transaction_date', name: 'transactions.transaction_date' },
            { data: 'location_name', name: 'bl.name' },
            { data: 'customer_name', orderable: false, searchable: false },
            { data: 'product_name', name: 'p.name' },
            { data: 'quantity', name: 'transaction_sell_lines.quantity' },
            { data: 'unit_price_before_discount', name: 'transaction_sell_lines.unit_price_before_discount' },
            { data: 'line_discount_display', orderable: false, searchable: false },
            { data: 'line_discount_total', orderable: false, searchable: false },
            { data: 'order_discount_display', orderable: false, searchable: false },
            { data: 'order_discount_total', orderable: false, searchable: false },
        ],
        fnDrawCallback: function (oSettings) {
            var total_line = sum_table_col($('#discounts_report_table'), 'line-discount-total');
            $('#dr_footer_line_discount').text(total_line);
            var total_order = sum_table_col($('#discounts_report_table'), 'order-discount-total');
            $('#dr_footer_order_discount').text(total_order);
            __currency_convert_recursively($('#discounts_report_table'));
        },
    });

    // ========== Summary loader ==========
    function loadDiscountsSummary() {
        var start = '', end = '';
        if ($('input#dr_date_filter').val()) {
            start = $('input#dr_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
            end = $('input#dr_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
        }
        $.ajax({
            url: '/reports/discounts-report-summary',
            data: {
                start_date: start,
                end_date: end,
                location_id: $('select#dr_location_id').val(),
                customer_id: $('select#dr_customer_id').val(),
                discount_id: $('select#dr_discount_id').val(),
                discount_type_filter: $('select#dr_discount_type_filter').val(),
            },
            success: function (data) {
                // Line discounts summary
                var lineHtml = '';
                var lineTotalLines = 0, lineTotalTrans = 0, lineTotalAmt = 0;
                $.each(data.line_discounts, function (i, row) {
                    var lineCount = row.line_count || 0;
                    lineTotalLines += parseInt(lineCount);
                    lineTotalTrans += parseInt(row.transaction_count);
                    lineTotalAmt += parseFloat(row.total_discount);
                    lineHtml += '<tr>' +
                        '<td>' + row.discount_name + '</td>' +
                        '<td>' + lineCount + '</td>' +
                        '<td>' + row.transaction_count + '</td>' +
                        '<td><span class="display_currency" data-currency_symbol="true">' + parseFloat(row.total_discount).toFixed(2) + '</span></td>' +
                        '</tr>';
                });
                $('#line_discount_summary_body').html(lineHtml);
                $('#line_total_lines').text(lineTotalLines);
                $('#line_total_transactions').text(lineTotalTrans);
                $('#line_total_amount').html('<span class="display_currency" data-currency_symbol="true">' + lineTotalAmt.toFixed(2) + '</span>');

                // Order discounts summary
                var orderHtml = '';
                var orderTotalTrans = 0, orderTotalAmt = 0;
                $.each(data.order_discounts, function (i, row) {
                    orderTotalTrans += parseInt(row.transaction_count);
                    orderTotalAmt += parseFloat(row.total_discount);
                    orderHtml += '<tr>' +
                        '<td>' + row.discount_name + '</td>' +
                        '<td>' + row.transaction_count + '</td>' +
                        '<td><span class="display_currency" data-currency_symbol="true">' + parseFloat(row.total_discount).toFixed(2) + '</span></td>' +
                        '</tr>';
                });
                $('#order_discount_summary_body').html(orderHtml);
                $('#order_total_transactions').text(orderTotalTrans);
                $('#order_total_amount').html('<span class="display_currency" data-currency_symbol="true">' + orderTotalAmt.toFixed(2) + '</span>');

                // KPI cards
                $('#kpi_total_discount').text(__currency_trans_from_en(data.total_discount, false));
                $('#kpi_line_discount').text(__currency_trans_from_en(data.total_line_discount, false));
                $('#kpi_order_discount').text(__currency_trans_from_en(data.total_order_discount, false));
                $('#kpi_discount_ratio').text(data.discount_to_sales_ratio);

                // Grand totals
                $('#summary_total_sales').text(__currency_trans_from_en(data.total_sales, false));
                $('#summary_total_transactions').text(data.total_transactions);
                $('#summary_grand_total_discount').text(__currency_trans_from_en(data.total_discount, false));
                $('#summary_discount_ratio').text(data.discount_to_sales_ratio);

                __currency_convert_recursively($('#dr_summary'));
            },
        });
    }

    // ========== Date Range Picker ==========
    if ($('#dr_date_filter').length == 1) {
        var discountsDateRangeSettings = window.getAdminReportDateRangeSettings();
        discountsDateRangeSettings.autoUpdateInput = false;
        discountsDateRangeSettings.locale = $.extend({}, discountsDateRangeSettings.locale, {
            format: moment_date_format,
            cancelLabel: LANG.clear,
            applyLabel: LANG.apply,
            customRangeLabel: LANG.custom_range,
        });
        $('#dr_date_filter').daterangepicker(discountsDateRangeSettings, function (start, end) {
            $('#dr_date_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            discounts_report_table.ajax.reload();
            loadDiscountsSummary();
        });
        var discountsDatePicker = $('#dr_date_filter').data('daterangepicker');
        if (discountsDatePicker) {
            $('#dr_date_filter').val(
                discountsDatePicker.startDate.format(moment_date_format) + ' ~ ' + discountsDatePicker.endDate.format(moment_date_format)
            );
            discounts_report_table.ajax.reload();
        }
        $('#dr_date_filter').on('cancel.daterangepicker', function () {
            $(this).val('');
            discounts_report_table.ajax.reload();
            loadDiscountsSummary();
        });
    }

    // Initial load
    loadDiscountsSummary();

    // ========== Filter change handlers ==========
    $('#discounts_report_form #dr_location_id, #discounts_report_form #dr_customer_id, #discounts_report_form #dr_discount_id, #discounts_report_form #dr_discount_type_filter').change(function () {
        discounts_report_table.ajax.reload();
        loadDiscountsSummary();
    });

    function getDiscountsReportPrintParams(tab) {
        var params = {
            tab: tab,
            location_id: $('select#dr_location_id').val(),
            customer_id: $('select#dr_customer_id').val(),
            discount_id: $('select#dr_discount_id').val(),
            discount_type_filter: $('select#dr_discount_type_filter').val()
        };

        if ($('input#dr_date_filter').val() && $('input#dr_date_filter').data('daterangepicker')) {
            params.start_date = $('input#dr_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
            params.end_date = $('input#dr_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
        }

        return $.param(params);
    }

    $(document).on('click', '.discounts-report-print-btn', function () {
        var query = getDiscountsReportPrintParams($(this).data('tab'));
        window.open("<?php echo e(url('reports/discounts-report-print'), false); ?>?" + query, '_blank');
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>