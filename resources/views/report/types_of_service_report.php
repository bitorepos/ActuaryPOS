
<?php $__env->startSection('title', __('lang_v1.types_of_service_report')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.types_of_service_report'); ?>
        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.types_of_service_report_help') . '"></i>';
                }
            ?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
                
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('tos_date_range', __('report.date_range') . ':'); ?>

                        <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_types_of_service_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo Form::text('tos_date_range', \Carbon::createFromTimestamp(strtotime('first day of this month'))->format(session('business.date_format')) . ' ~ ' . \Carbon::createFromTimestamp(strtotime('last day of this month'))->format(session('business.date_format')), [
                            'placeholder' => __('lang_v1.select_a_date_range'),
                            'class'       => 'form-control',
                            'id'          => 'tos_date_range',
                            'readonly',
                        ]); ?>

                    </div>
                </div>

                
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('tos_location_id', __('purchase.business_location') . ':'); ?>

                        <?php echo Form::select('tos_location_id', $business_locations, null, [
                            'class'       => 'form-control select2',
                            'id'          => 'tos_location_id',
                            'style'       => 'width:100%',
                            'placeholder' => __('lang_v1.all'),
                        ]); ?>

                    </div>
                </div>

                
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('tos_filter_id', __('lang_v1.types_of_service') . ':'); ?>

                        <?php echo Form::select('tos_filter_id', $types_of_service, null, [
                            'class'       => 'form-control select2',
                            'id'          => 'tos_filter_id',
                            'style'       => 'width:100%',
                            'placeholder' => __('lang_v1.all'),
                        ]); ?>

                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tos_total_tab" data-bs-toggle="tab" role="tab">
                            <i class="fa fas fa-calendar-alt" aria-hidden="true"></i>
                            &nbsp;<?php echo app('translator')->get('report.total'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tos_summary_tab" data-bs-toggle="tab" role="tab">
                            <i class="fa fa-chart-pie" aria-hidden="true"></i>
                            &nbsp;<?php echo app('translator')->get('report.summary'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tos_details_tab" data-bs-toggle="tab" role="tab">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                            &nbsp;<?php echo app('translator')->get('lang_v1.detailed'); ?>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">

                    
                    <div class="tab-pane fade show active" id="tos_total_tab" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin w-100" id="tos_total_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.total_orders'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total_amount'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td><strong id="tos_total_footer_qty"></strong></td>
                                        <td><strong id="tos_total_footer_amount"></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="tos_summary_tab" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin w-100" id="tos_summary_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang_v1.types_of_service'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.total_orders'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total_amount'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.avg_order_value'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td><strong id="tos_summary_footer_qty"></strong></td>
                                        <td><strong id="tos_summary_footer_amount"></strong></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="tos_details_tab" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin w-100" id="tos_details_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                        <th><?php echo app('translator')->get('contact.customer'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.invoice_total'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th><?php echo app('translator')->get('lang_v1.types_of_service'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.service_amount'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td colspan="3"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td><strong id="tos_detail_footer_invoice"></strong></td>
                                        <td></td>
                                        <td><strong id="tos_detail_footer_service"></strong></td>
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
<script type="text/javascript">
$(document).ready(function () {

    /* ——— Date range picker ——— */
    if ($('#tos_date_range').length) {
        var typesOfServiceDateRangeSettings = window.getAdminReportDateRangeSettings();
        typesOfServiceDateRangeSettings.autoUpdateInput = false;
        typesOfServiceDateRangeSettings.locale = $.extend({}, typesOfServiceDateRangeSettings.locale, {
            format: moment_date_format,
        });
        $('#tos_date_range').daterangepicker(typesOfServiceDateRangeSettings);
        var typesOfServiceDatePicker = $('#tos_date_range').data('daterangepicker');
        if (typesOfServiceDatePicker) {
            $('#tos_date_range').val(typesOfServiceDatePicker.startDate.format(moment_date_format) + ' ~ ' + typesOfServiceDatePicker.endDate.format(moment_date_format));
        }
        $('#tos_date_range').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format(moment_date_format) + ' ~ ' + picker.endDate.format(moment_date_format));
            reloadAll();
        });
        $('#tos_date_range').on('cancel.daterangepicker', function () {
            $(this).val('');
            reloadAll();
        });
    }

    /* ——— Helpers ——— */
    function getFilterData() {
        var dates = {};
        if ($('#tos_date_range').val()) {
            var picker = $('#tos_date_range').data('daterangepicker');
            dates.start_date = picker.startDate.format('YYYY-MM-DD');
            dates.end_date   = picker.endDate.format('YYYY-MM-DD');
        }
        return $.extend(dates, {
            location_id:         $('#tos_location_id').val(),
            types_of_service_id: $('#tos_filter_id').val(),
        });
    }

    function reloadAll() {
        tos_total.ajax.reload();
        tos_summary.ajax.reload();
        tos_details.ajax.reload();
    }

    /* ——— Total DataTable ——— */
    var tos_total = $('table#tos_total_table').DataTable({
        processing:  true,
        serverSide:  true,
        aaSorting:   [[0, 'desc']],
        ajax: {
            url:  '<?php echo e(action([\App\Http\Controllers\ReportController::class, "getTypesOfServiceReportTotal"]), false); ?>',
            data: function (d) { return $.extend(d, getFilterData()); },
        },
        columns: [
            { data: 'date',         name: 'date' },
            { data: 'total_qty',    name: 'total_qty',    className: 'text-right' },
            { data: 'total_amount', name: 'total_amount', className: 'text-right' },
        ],
        fnDrawCallback: function () {
            var qty = 0;
            $('table#tos_total_table tbody tr td:nth-child(2)').each(function () {
                qty += parseInt($(this).text().trim().replace(/[^0-9]/g, '')) || 0;
            });
            $('#tos_total_footer_qty').text(qty);
            $('#tos_total_footer_amount').text(sum_table_col($('table#tos_total_table'), 'total-amount'));
            __currency_convert_recursively($('table#tos_total_table'));
        },
    });

    /* ——— Summary DataTable ——— */
    var tos_summary = $('table#tos_summary_table').DataTable({
        processing:  true,
        serverSide:  true,
        aaSorting:   [[2, 'desc']],
        ajax: {
            url:  '<?php echo e(action([\App\Http\Controllers\ReportController::class, "getTypesOfServiceReportSummary"]), false); ?>',
            data: function (d) { return $.extend(d, getFilterData()); },
        },
        columns: [
            { data: 'service_name', name: 'service_name' },
            { data: 'total_qty',    name: 'total_qty',    className: 'text-right' },
            { data: 'total_amount', name: 'total_amount', className: 'text-right' },
            { data: 'avg_amount',   name: 'avg_amount',   className: 'text-right', orderable: false },
        ],
        fnDrawCallback: function () {
            var qty = 0;
            $('table#tos_summary_table tbody tr td:nth-child(2)').each(function () {
                qty += parseInt($(this).text().trim().replace(/[^0-9]/g, '')) || 0;
            });
            $('#tos_summary_footer_qty').text(qty);
            $('#tos_summary_footer_amount').text(sum_table_col($('table#tos_summary_table'), 'total-amount'));
            __currency_convert_recursively($('table#tos_summary_table'));
        },
    });

    /* ——— Detail DataTable ——— */
    var tos_details = $('table#tos_details_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting:  [[0, 'desc']],
        ajax: {
            url:  '<?php echo e(action([\App\Http\Controllers\ReportController::class, "getTypesOfServiceReportData"]), false); ?>',
            data: function (d) { return $.extend(d, getFilterData()); },
        },
        columns: [
            { data: 'transaction_date', name: 'transactions.transaction_date' },
            { data: 'invoice_no',       name: 'transactions.invoice_no' },
            { data: 'customer_name',    name: 'c.name' },
            { data: 'final_total',      name: 'transactions.final_total',  className: 'text-right' },
            { data: 'service_name',     name: 'tos.name' },
            { data: 'service_amount',   name: 'service_amount', className: 'text-right', searchable: false, orderable: false },
        ],
        fnDrawCallback: function () {
            $('#tos_detail_footer_invoice').text(sum_table_col($('table#tos_details_table'), 'final-total'));
            $('#tos_detail_footer_service').text(sum_table_col($('table#tos_details_table'), 'service-amount'));
            __currency_convert_recursively($('table#tos_details_table'));
        },
    });

    /* ——— Filter listeners ——— */
    $('#tos_location_id, #tos_filter_id').on('change', function () {
        reloadAll();
    });

    /* ——— Lazy-load on tab activation ——— */
    $('a[href="#tos_summary_tab"]').on('shown.bs.tab', function () {
        tos_summary.ajax.reload();
    });
    $('a[href="#tos_details_tab"]').on('shown.bs.tab', function () {
        tos_details.ajax.reload();
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>