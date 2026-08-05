
<?php $__env->startSection('title', __('Sales & Returns Report')); ?>

<?php $__env->startSection('css'); ?>
<style>
    #srr_summary_tab {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    #srr_sale_report_table th,
    #srr_sale_report_table td {
        white-space: nowrap;
    }
    #srr_summary_tab .dt-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        margin-bottom: 8px;
    }
    @media print {
        #srr_sale_report_table th,
        #srr_sale_report_table td {
            white-space: nowrap !important;
            overflow: visible !important;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header -->
<section class="content-header no-print">
    <h1>Sales &amp; Returns Report</h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_sales_returns_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => '#', 'method' => 'get', 'id' => 'srr_filter_form', 'class' => 'row']); ?>

            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('srr_type_filter', __('lang_v1.type') . ':'); ?>

                    <?php echo Form::select('srr_type_filter', ['sales_returns' => __('lang_v1.all'), 'sell' => 'Sale Invoices', 'sell_return' => 'Sale Returns'], 'sales_returns', ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'srr_type_filter']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('srr_location_id', __('purchase.business_location').':'); ?>

                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                        <?php echo Form::select('srr_location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.all'), 'style' => 'width:100%', 'id' => 'srr_location_id']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('srr_customer_id', __('contact.customer') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <?php echo Form::select('srr_customer_id', $customers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width:100%', 'id' => 'srr_customer_id']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('srr_customer_group_id', __('lang_v1.customer_group_name') . ':'); ?>

                    <?php echo Form::select('srr_customer_group_id', $customer_group, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'srr_customer_group_id']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('srr_payment_status', __('purchase.payment_status') . ':'); ?>

                    <?php echo Form::select('srr_payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial'), 'overdue' => __('lang_v1.overdue')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all'), 'id' => 'srr_payment_status']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('srr_payment_method', __('purchase.payment_method') . ':'); ?>

                    <?php echo Form::select('srr_payment_method', $payment_types, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all'), 'id' => 'srr_payment_method']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('srr_date_filter', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('srr_date_filter', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'srr_date_filter', 'readonly']); ?>

                </div>
            </div>
            <?php echo Form::close(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active pb-2 pe-2 ps-2" href="#srr_summary_tab" data-bs-toggle="tab" role="tab" aria-expanded="true">
                            <i class="fa fa-list" aria-hidden="true"></i> <?php echo app('translator')->get('report.summary'); ?>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="srr_summary_tab" role="tabpanel">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end" id="srr_print_btn" aria-label="Print">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped ajax_view table-th-skin w-100" id="srr_sale_report_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                        <th>Type</th>
                                        <th><?php echo app('translator')->get('lang_v1.contact_id'); ?></th>
                                        <th style="width:350px"><?php echo app('translator')->get('sale.customer_name'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> (<?php echo app('translator')->get('product.exc_of_tax'); ?>) (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.discount'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.tax'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> (<?php echo app('translator')->get('product.inc_of_tax'); ?>) (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.paid'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.due'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="srr_footer_total_before_tax text-right"></td>
                                        <td class="srr_footer_total_discount text-right"></td>
                                        <td class="srr_footer_total_tax text-right"></td>
                                        <td class="srr_footer_sale_total text-right"></td>
                                        <td class="srr_footer_total_paid text-right"></td>
                                        <td></td>
                                        <td class="srr_footer_total_remaining text-right"></td>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    var salesReturnsDateRangeSettings = window.getAdminReportDateRangeSettings();
    salesReturnsDateRangeSettings.autoUpdateInput = false;
    salesReturnsDateRangeSettings.locale = $.extend({}, salesReturnsDateRangeSettings.locale, {
        format: moment_date_format,
        cancelLabel: LANG.clear,
        applyLabel: LANG.apply,
        customRangeLabel: LANG.custom_range,
    });
    
    $('#srr_date_filter').daterangepicker(
        salesReturnsDateRangeSettings,
        function (start, end) {
            $('#srr_date_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            srr_table.ajax.reload();
        }
    );
    var salesReturnsDatePicker = $('#srr_date_filter').data('daterangepicker');
    if (salesReturnsDatePicker) {
        $('#srr_date_filter').val(
            salesReturnsDatePicker.startDate.format(moment_date_format) + ' ~ ' + salesReturnsDatePicker.endDate.format(moment_date_format)
        );
    }
    $('#srr_date_filter').on('cancel.daterangepicker', function(ev, picker) {
        $('#srr_date_filter').val('');
        srr_table.ajax.reload();
    });
    $('#srr_date_filter').change(function(){
        srr_table.ajax.reload();
    });

    function getSalesReturnsReportFilterParams() {
        var params = {
            sale_type: $('#srr_type_filter').val() || 'sales_returns',
            location_id: $('#srr_location_id').val() || '',
            customer_id: $('#srr_customer_id').val() || '',
            customer_group_id: $('#srr_customer_group_id').val() || '',
            payment_status: $('#srr_payment_status').val() || '',
            payment_method: $('#srr_payment_method').val() || ''
        };

        if ($('#srr_date_filter').val()) {
            var picker = $('#srr_date_filter').data('daterangepicker');
            if (picker) {
                params.start_date = picker.startDate.format('YYYY-MM-DD') + ' 00:00';
                params.end_date = picker.endDate.format('YYYY-MM-DD') + ' 23:59';
            }
        }

        $.each(params, function(key, value) {
            if (value === '' || value === null || typeof value === 'undefined') {
                delete params[key];
            }
        });

        return params;
    }

    $('#srr_print_btn').on('click', function () {
        window.open('<?php echo e(url('reports/sales-returns-report-print'), false); ?>?' + $.param(getSalesReturnsReportFilterParams()), '_blank');
    });

    // Init DataTable - fetches both sell & sell_return via /sells endpoint
    var srr_table = $('#srr_sale_report_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [[0, 'desc']],
        dom: '<"row margin-bottom-20"<"col-xs-12 col-2 mb-2"l><"col-xs-12 col-8 mb-2 dt-buttons-wrapper"B><"col-xs-12 col-2 mb-2"f>>rtip',
        ajax: {
            url: "/sells",
            data: function (d) {
                $.extend(d, getSalesReturnsReportFilterParams());
                d = __datatable_ajax_callback(d);
            }
        },
        columns: [
            { data: 'sale_date', name: 'transactions.transaction_date' },
            { data: 'invoice_no_text', name: 'transactions.invoice_no' },
            { data: 'type', name: 'transactions.type', searchable: false },
            { data: 'contact_id', name: 'contacts.contact_id' },
            { data: 'conatct_name', name: 'conatct_name' },
            { data: 'total_before_tax', name: 'total_before_tax', className: 'text-right' },
            { data: 'discount_amount', name: 'discount_amount', className: 'text-right' },
            { data: 'tax_amount', name: 'tax_amount', className: 'text-right' },
            { data: 'final_total', name: 'final_total', className: 'text-right' },
            { data: 'total_paid', name: 'total_paid', className: 'text-right' },
            { data: 'payment_methods', name: 'payment_methods' },
            { data: 'total_remaining', name: 'total_remaining', className: 'text-right' },
        ],
        fnDrawCallback: function (oSettings) {
            __currency_convert_recursively($('#srr_sale_report_table'));
        },
        footerCallback: function (row, data, start, end, display) {
            var footer_sale_total = 0;
            var footer_total_paid = 0;
            var footer_total_remaining = 0;
            var footer_total_tax = 0;
            var footer_total_discount = 0;
            var footer_total_before_tax = 0;
            for (var r in data) {
                footer_sale_total += $(data[r].final_total).data('orig-value') ? parseFloat($(data[r].final_total).data('orig-value')) : 0;
                footer_total_paid += $(data[r].total_paid).data('orig-value') ? parseFloat($(data[r].total_paid).data('orig-value')) : 0;
                footer_total_remaining += $(data[r].total_remaining).data('orig-value') ? parseFloat($(data[r].total_remaining).data('orig-value')) : 0;
                footer_total_tax += $(data[r].tax_amount).data('orig-value') ? parseFloat($(data[r].tax_amount).data('orig-value')) : 0;
                footer_total_discount += $(data[r].discount_amount).data('orig-value') ? parseFloat($(data[r].discount_amount).data('orig-value')) : 0;
                footer_total_before_tax += $(data[r].total_before_tax).data('orig-value') ? parseFloat($(data[r].total_before_tax).data('orig-value')) : 0;
            }
            $('.srr_footer_total_before_tax').html(__currency_trans_from_en(footer_total_before_tax));
            $('.srr_footer_total_discount').html(__currency_trans_from_en(footer_total_discount));
            $('.srr_footer_total_tax').html(__currency_trans_from_en(footer_total_tax));
            $('.srr_footer_sale_total').html(__currency_trans_from_en(footer_sale_total));
            $('.srr_footer_total_paid').html(__currency_trans_from_en(footer_total_paid));
            $('.srr_footer_total_remaining').html(__currency_trans_from_en(footer_total_remaining));
        },
        buttons: [
            {
                extend: 'csv',
                text: '<i class="fa fa-file-csv"></i> CSV',
                className: 'btn btn-default btn-sm',
                exportOptions: { columns: ':visible' }
            },
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel"></i> Excel',
                className: 'btn btn-default btn-sm',
                exportOptions: { columns: ':visible' }    
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> Print A4',
                className: 'btn btn-default btn-sm',
                exportOptions: { columns: ':visible' }
            },
            {
                extend: 'colvis',
                text: '<i class="fa fa-columns"></i> Columns',
                className: 'btn btn-default btn-sm'
            }
        ]
    });

    // Filter change handlers
    $(document).on('change', '#srr_type_filter, #srr_location_id, #srr_customer_id, #srr_customer_group_id, #srr_payment_status, #srr_payment_method', function() {
        srr_table.ajax.reload();
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>