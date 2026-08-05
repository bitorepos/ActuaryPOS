<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>

<?php $__env->startSection('title', __('lang_v1.purchase_invoices_report')); ?>

<?php $__env->startSection('css'); ?>
<style>
    /* Let DataTables scrollX handle overflow; wrapper must not clip */
    #pir_totals_tab,
    #pir_summary_tab {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    #pir_detailed_tab .table-responsive,
    #pir_contact_ledger_div .table-responsive {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch;
    }
    #pir_contact_ledger_div .table-responsive > .table {
        min-width: 900px;
    }
    /* Prevent text wrapping in table headers/cells to maintain readable columns */
    #total_purchase_invoices th,
    #purchase_invoices_report_table th,
    #pir_ledger_table th,
    #total_purchase_invoices td,
    #purchase_invoices_report_table td {
        white-space: nowrap;
    }
    /* Fix DataTables buttons alignment */
    #pir_totals_tab .dt-buttons,
    #pir_summary_tab .dt-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        margin-bottom: 8px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_purchase_invoices_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo e(__('lang_v1.purchase_invoices_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => '#', 'method' => 'get', 'id' => 'purchase_invoices_report_form', 'class' => 'row']); ?>

            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('pir_type_filter', __('lang_v1.type') . ':'); ?>

                    <?php echo Form::select('pir_type_filter', ['purchase' => __('lang_v1.purchase'), 'purchase_return' => __('lang_v1.purchase_return')], null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('pir_payment_status', __('purchase.payment_status') . ':'); ?>

                    <?php echo Form::select('pir_payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial'), 'overdue' => __('lang_v1.overdue')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('pir_payment_method', __('purchase.payment_method') . ':'); ?>

                    <?php echo Form::select('pir_payment_method', $payment_types, null, ['class' => 'form-control select2', 'id' => 'pir_payment_method', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('pir_location_id', __('purchase.business_location').':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <?php echo Form::select('pir_location_id', $business_locations, null, ['class' => 'form-control select2',
                        'placeholder' => __('lang_v1.all'), 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('pir_supplier_id', __('purchase.supplier') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('pir_supplier_id', $suppliers, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.please_select'), 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('pir_purchase_status', __('purchase.purchase_status') . ':'); ?>

                    <?php echo Form::select('pir_purchase_status', $orderStatuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('pir_invoices', __('lang_v1.invoices') . ':'); ?>

                    <?php echo Form::select('pir_invoices', [], null, ['class' => 'form-control select2', 'id' => 'pir_invoices', 'multiple', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <label for="pir_invoice_from_to"><?php echo app('translator')->get('lang_v1.invoices'); ?> Range:</label>
                <div class="form-group mb-2">
                    <input class="form-control width-50 f-left" id="pir_invoice_from" name="pir_invoice_from" type="text" value="" placeholder="From">
                    <input class="form-control width-50 f-left" id="pir_invoice_to" name="pir_invoice_to" type="text" value="" placeholder="To">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('pir_date_filter', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('pir_date_filter', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' =>
                    'form-control', 'id' => 'pir_date_filter', 'readonly']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <?php echo Form::label('pir_start_time', __('lang_v1.time_range') . ':'); ?>

                <div class="form-group mb-2">
                    <?php echo Form::text('pir_start_time', '00:00', ['class' => 'form-control width-50 f-left', 'id' => 'pir_start_time']); ?>

                    <?php echo Form::text('pir_end_time', '23:59', ['class' => 'form-control width-50 f-left', 'id' => 'pir_end_time']); ?>

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
                        <a class="nav-link active pb-2 pe-2 ps-2" href="#pir_totals_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-list"
                            aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.totals'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#pir_summary_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i
                                class="fa fa-list" aria-hidden="true"></i> <?php echo app('translator')->get('report.summary'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#pir_detailed_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-bars"
                                    aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.detailed'); ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    
                    <div class="tab-pane fade show active" id="pir_totals_tab" role="tabpanel">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary float-end pir-print-preview-btn" data-tab="totals">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin w-100" id="total_purchase_invoices">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.invoice_quantity'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.average_invoice'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th><?php echo app('translator')->get('lang_v1.item_quantity'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.paid'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
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
                                    <td id="pir_footer_total" class="text-right"></td>
                                    <td id="pir_footer_paid" class="text-right"></td>
                                    <td id="pir_footer_due" class="text-right"></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="pir_summary_tab" role="tabpanel">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary float-end pir-print-preview-btn" data-tab="summary">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped ajax_view table-th-skin w-100" id="purchase_invoices_report_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.contact_id'); ?></th>
                                        <th style="width:350px"><?php echo app('translator')->get('purchase.supplier'); ?></th>
                                        <th style="width:350px"><?php echo app('translator')->get('contact.contact_info'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> (<?php echo app('translator')->get('product.exc_of_tax'); ?>) (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.discount'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <?php if($show_product_tax_fields): ?>
                                        <th class="text-right"><?php echo app('translator')->get('sale.tax'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <?php endif; ?>
                                        <?php if($show_product_tax_fields): ?>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> (<?php echo app('translator')->get('product.inc_of_tax'); ?>) (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <?php endif; ?>
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
                                    <td class="pir_footer_total_before_tax text-right"></td>
                                    <td class="pir_footer_discount text-right"></td>
                                    <?php if($show_product_tax_fields): ?>
                                    <td class="pir_footer_tax text-right"></td>
                                    <?php endif; ?>
                                    <?php if($show_product_tax_fields): ?>
                                    <td class="pir_footer_total text-right"></td>
                                    <?php endif; ?>
                                    <td class="pir_footer_paid text-right"></td>
                                    <td class="pir_footer_payment_method"></td>
                                    <td class="pir_footer_due text-right"></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    
                    <div class="tab-pane fade" id="pir_detailed_tab" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary float-end pir-print-preview-btn" data-tab="detailed">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div id="pir_contact_ledger_div"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<div class="modal fade view_register" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    var purchaseInvoicesDateRangeSettings = $('#reports_filter_date_range').length
        ? window.getAdminReportDateRangeSettings()
        : $.extend({}, dateRangeSettings, {
            startDate: moment(),
            endDate: moment()
        });

    $('#pir_date_filter').daterangepicker(
        purchaseInvoicesDateRangeSettings,
        function (start, end) {
            $('#pir_date_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            purchase_invoices_report_table.ajax.reload();
            total_purchase_invoices.ajax.reload();
        }
    );
    var purchaseInvoicesDatePicker = $('#pir_date_filter').data('daterangepicker');
    if (purchaseInvoicesDatePicker) {
        $('#pir_date_filter').val(
            purchaseInvoicesDatePicker.startDate.format(moment_date_format) + ' ~ ' + purchaseInvoicesDatePicker.endDate.format(moment_date_format)
        );
    }
    $('#pir_date_filter').on('cancel.daterangepicker', function(ev, picker) {
        $('#pir_date_filter').val('');
        purchase_invoices_report_table.ajax.reload();
        total_purchase_invoices.ajax.reload();
    });
    $('#pir_date_filter').change(function(){
        pir_detailed_page = 1;
        pir_get_contact_ledger(1);
        purchase_invoices_report_table.ajax.reload();
        total_purchase_invoices.ajax.reload();
        pir_get_invoices_list();
    });

    $('#pir_start_time, #pir_end_time').datetimepicker({
        format: 'HH:mm',
        ignoreReadonly: true,
    }).on('focusout', function(ev){
        pir_detailed_page = 1;
        pir_get_contact_ledger(1);
        purchase_invoices_report_table.ajax.reload();
        total_purchase_invoices.ajax.reload();
    });

    pir_get_contact_ledger();

    // ============================
    // SUMMARY TAB DataTable
    // ============================
    purchase_invoices_report_table = $('#purchase_invoices_report_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [[1, 'desc']],
        dom: '<"row margin-bottom-20"<"col-xs-12 col-2 mb-2"l><"col-xs-12 col-8 mb-2 dt-buttons-wrapper"B><"col-xs-12 col-2 mb-2"f>>rtip',
        "ajax": {
            "url": "/reports/purchase-invoices-report",
            "data": function (d) {
                var start_time = $('#pir_start_time').val();
                var end_time = $('#pir_end_time').val();
                if ($('#pir_date_filter').val()) {
                    var start = $('#pir_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    start = moment(start + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                    var end = $('#pir_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    end = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                    d.start_date = start;
                    d.end_date = end;
                }
                d.location_id = $('#pir_location_id').val();
                d.supplier_id = $('#pir_supplier_id').val();
                d.payment_status = $('#pir_payment_status').val();
                d.purchase_type = $('#pir_type_filter').val();
                d.payment_method = $('#pir_payment_method').val();
                d.purchase_status = $('#pir_purchase_status').val();
                d.invoices = $('#pir_invoices').val();
                d.invoice_from = $('#pir_invoice_from').val();
                d.invoice_to = $('#pir_invoice_to').val();
                d = __datatable_ajax_callback(d);
            }
        },
        columns: [
            { data: 'transaction_date', name: 'transactions.transaction_date' },
            { data: 'ref_no', name: 'transactions.ref_no' },
            { data: 'contact_id', name: 'contacts.contact_id' },
            { data: 'supplier_name', name: 'supplier_name' },
            { data: 'contact_info', name: 'contact_info' },
            { data: 'total_before_tax', name: 'total_before_tax', className: 'text-right' },
            { data: 'discount_amount', name: 'discount_amount', className: 'text-right' },
            <?php if($show_product_tax_fields): ?>
            { data: 'tax_amount', name: 'tax_amount', className: 'text-right' },
            <?php endif; ?>
            <?php if($show_product_tax_fields): ?>
            { data: 'final_total', name: 'final_total', className: 'text-right' },
            <?php endif; ?>
            { data: 'total_paid', name: 'total_paid', className: 'text-right' },
            { data: 'payment_methods', name: 'payment_methods' },
            { data: 'total_remaining', name: 'total_remaining', className: 'text-right' },
        ],
        "fnDrawCallback": function (oSettings) {
            __currency_convert_recursively($('#purchase_invoices_report_table'));
        },
        "footerCallback": function (row, data, start, end, display) {
            var footer_total_before_tax = 0;
            var footer_discount = 0;
            var footer_tax = 0;
            var footer_total = 0;
            var footer_paid = 0;
            var footer_due = 0;
            for (var r in data) {
                footer_total_before_tax += $(data[r].total_before_tax).data('orig-value') ? parseFloat($(data[r].total_before_tax).data('orig-value')) : 0;
                footer_discount += $(data[r].discount_amount).data('orig-value') ? parseFloat($(data[r].discount_amount).data('orig-value')) : 0;
                <?php if($show_product_tax_fields): ?>
                footer_tax += $(data[r].tax_amount).data('orig-value') ? parseFloat($(data[r].tax_amount).data('orig-value')) : 0;
                <?php endif; ?>
                <?php if($show_product_tax_fields): ?>
                footer_total += $(data[r].final_total).data('orig-value') ? parseFloat($(data[r].final_total).data('orig-value')) : 0;
                <?php endif; ?>
                footer_paid += $(data[r].total_paid).data('orig-value') ? parseFloat($(data[r].total_paid).data('orig-value')) : 0;
                footer_due += $(data[r].total_remaining).data('orig-value') ? parseFloat($(data[r].total_remaining).data('orig-value')) : 0;
            }
            $('.pir_footer_total_before_tax').html(__currency_trans_from_en(footer_total_before_tax));
            $('.pir_footer_discount').html(__currency_trans_from_en(footer_discount));
            <?php if($show_product_tax_fields): ?>
            $('.pir_footer_tax').html(__currency_trans_from_en(footer_tax));
            <?php endif; ?>
            <?php if($show_product_tax_fields): ?>
            $('.pir_footer_total').html(__currency_trans_from_en(footer_total));
            <?php endif; ?>
            $('.pir_footer_paid').html(__currency_trans_from_en(footer_paid));
            $('.pir_footer_due').html(__currency_trans_from_en(footer_due));

            $('.pir_footer_payment_method').html(__count_status(data, 'payment_methods'));
            pir_generate_printing_filters();
        },
    });

    // ============================
    // TOTALS TAB DataTable
    // ============================
    var total_purchase_invoices_columns = [
        { data: 'purchase_date', name: 'transactions.transaction_date' },
        { data: 'total_invoices', name: 'total_invoices' },
        { data: 'average_invoice', name: 'average_invoice', className: 'text-right' },
        { data: 'total_items', name: 'total_items' },
        { data: 'final_total', name: 'final_total', className: 'text-right' },
        { data: 'total_paid', name: 'total_paid', className: 'text-right' },
        { data: 'total_remaining', name: 'total_remaining', className: 'text-right' },
    ];

    total_purchase_invoices = $('#total_purchase_invoices').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [[0, 'desc']],
        dom: '<"row margin-bottom-20"<"col-xs-12 col-2 mb-2"l><"col-xs-12 col-8 mb-2 dt-buttons-wrapper"B><"col-xs-12 col-2 mb-2"f>>rtip',
        "ajax": {
            "url": "/reports/purchase-invoices-total",
            "data": function (d) {
                var start_time = $('#pir_start_time').val();
                var end_time = $('#pir_end_time').val();
                if ($('#pir_date_filter').val()) {
                    var start = $('#pir_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    start = moment(start + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                    var end = $('#pir_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    end = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                    d.start_date = start;
                    d.end_date = end;
                }
                d.purchase_type = $('#pir_type_filter').val();
                d.payment_status = $('#pir_payment_status').val();
                d.location_id = $('#pir_location_id').val();
                d.payment_method = $('#pir_payment_method').val();
                d.supplier_id = $('#pir_supplier_id').val();
                d.purchase_status = $('#pir_purchase_status').val();
                d.invoices = $('#pir_invoices').val();
                d.invoice_from = $('#pir_invoice_from').val();
                d.invoice_to = $('#pir_invoice_to').val();
                d = __datatable_ajax_callback(d);
            }
        },
        columns: total_purchase_invoices_columns,
        "fnDrawCallback": function (oSettings) {
            __currency_convert_recursively($('#total_purchase_invoices'));
        },
        "footerCallback": function (row, data, start, end, display) {
            var footer_total = 0;
            var footer_paid = 0;
            var footer_due = 0;
            for (var r in data) {
                footer_total += $(data[r].final_total).data('orig-value') ? parseFloat($(data[r].final_total).data('orig-value')) : 0;
                footer_paid += $(data[r].total_paid).data('orig-value') ? parseFloat($(data[r].total_paid).data('orig-value')) : 0;
                footer_due += $(data[r].total_remaining).data('orig-value') ? parseFloat($(data[r].total_remaining).data('orig-value')) : 0;
            }
            $('#pir_footer_total').html(__currency_trans_from_en(footer_total, false));
            $('#pir_footer_paid').html(__currency_trans_from_en(footer_paid, false));
            $('#pir_footer_due').html(__currency_trans_from_en(footer_due, false));
            pir_generate_printing_filters();
        },
    });

    // ============================
    // FILTER CHANGE HANDLERS
    // ============================
    $(document).on('change', '#pir_location_id, #pir_supplier_id, #pir_payment_status, #pir_type_filter, #pir_payment_method, #pir_purchase_status, #pir_invoice_from, #pir_invoice_to', function() {
        purchase_invoices_report_table.ajax.reload();
        pir_detailed_page = 1;
        pir_get_contact_ledger(1);
        total_purchase_invoices.ajax.reload();
        pir_get_invoices_list();
    });
    $("#pir_invoices").on("change", function () {
        purchase_invoices_report_table.ajax.reload();
        pir_detailed_page = 1;
        pir_get_contact_ledger(1);
        total_purchase_invoices.ajax.reload();
    });
    pir_get_invoices_list();

    function getPurchaseInvoicesReportPrintParams(tab) {
        var params = {
            tab: tab,
            purchase_type: $('#pir_type_filter').val(),
            payment_status: $('#pir_payment_status').val(),
            payment_method: $('#pir_payment_method').val(),
            location_id: $('#pir_location_id').val(),
            supplier_id: $('#pir_supplier_id').val(),
            purchase_status: $('#pir_purchase_status').val(),
            invoices: $('#pir_invoices').val(),
            invoice_from: $('#pir_invoice_from').val(),
            invoice_to: $('#pir_invoice_to').val()
        };

        var start_time = $('#pir_start_time').val();
        var end_time = $('#pir_end_time').val();
        if ($('#pir_date_filter').val() && $('#pir_date_filter').data('daterangepicker')) {
            var start = $('#pir_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
            params.start_date = moment(start + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
            var end = $('#pir_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
            params.end_date = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
        }

        return $.param(params);
    }

    $(document).on('click', '.pir-print-preview-btn', function(e) {
        e.preventDefault();
        window.open("<?php echo e(url('reports/purchase-invoices-report-print'), false); ?>?" + getPurchaseInvoicesReportPrintParams($(this).data('tab')), '_blank');
    });

    // Detailed tab pagination - page link clicks
    $(document).on('click', '.pir-detailed-page-link', function(e) {
        e.preventDefault();
        var $li = $(this).closest('li');
        if ($li.hasClass('disabled') || $li.hasClass('active')) return;
        var page = parseInt($(this).data('page'));
        if (page >= 1) {
            pir_get_contact_ledger(page);
        }
    });

    // Detailed tab pagination - per-page change
    $(document).on('change', '#pir_detailed_per_page', function() {
        var val = $(this).val();
        pir_detailed_per_page = val === 'All' ? 'All' : parseInt(val);
        pir_detailed_page = 1;
        pir_get_contact_ledger(1);
    });
});
</script>
<script type="text/javascript">
// Pagination variables
var pir_detailed_page = 1;
var pir_detailed_per_page = 25;

function pir_get_contact_ledger(page) {
    var start_date = '';
    var end_date = '';
    var location_id = $('#pir_location_id').val();
    var supplier_id = $('#pir_supplier_id').val();
    var payment_status = $('#pir_payment_status').val();
    var payment_method = $('#pir_payment_method').val();
    var purchase_type = $('#pir_type_filter').val();
    var purchase_status = $('#pir_purchase_status').val();
    var invoices = $('#pir_invoices').val();
    var invoice_from = $('#pir_invoice_from').val();
    var invoice_to = $('#pir_invoice_to').val();

    var start_time = $('#pir_start_time').val();
    var end_time = $('#pir_end_time').val();
    if ($('#pir_date_filter').val()) {
        start_date = $('#pir_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
        start_date = moment(start_date + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
        end_date = $('#pir_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
        end_date = moment(end_date + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
    }

    var data = {
        purchase_type: purchase_type,
        start_date: start_date,
        end_date: end_date,
        location_id: location_id,
        supplier_id: supplier_id,
        payment_status: payment_status,
        payment_method: payment_method,
        purchase_status: purchase_status,
        invoices: invoices,
        invoice_from: invoice_from,
        invoice_to: invoice_to,
        page: page || pir_detailed_page,
        per_page: pir_detailed_per_page,
    };
    var loader = __fa_awesome();
    $('#pir_contact_ledger_div').html(`
        <div class="container text-center" style="justify-content: space-around;display: flex;">
            <div style="padding: 15px;margin: 25px;font-size: 1.4em;background-color: #d0f5be;width: 40%;">Processing Report ${loader}</div>
        </div>
    `);
    $.ajax({
        url: '/reports/purchase-invoices-detailed',
        data: data,
        dataType: 'html',
        success: function(result) {
            $('#pir_contact_ledger_div').html(result);
            pir_detailed_page = parseInt(data.page) || 1;
            pir_calculate_ledger_footer_total('#pir_contact_ledger_div');
        },
    });
}

function pir_calculate_ledger_footer_total(div_id) {
    var footer_quantity_total = 0;
    var footer_discount_total = 0;
    var footer_tax_total = 0;
    var footer_subtotal_total = 0;
    var footer_sell_total = 0;
    var footer_profit_total = 0;

    $(`${div_id} .pir_total_row_footer`).each(function() {
        var total_quantity = parseFloat($(this).find('.pir_total_quantity_row').val());
        var total_discount = parseFloat($(this).find('.pir_total_discount_row').val());
        var total_tax = parseFloat($(this).find('.pir_total_tax_row').val());
        var total_subtotal = parseFloat($(this).find('.pir_total_sub_total_row').val());
        var total_sell = parseFloat($(this).find('.pir_total_sell_price_row').val());
        var total_profit = parseFloat($(this).find('.pir_total_profit_row').val());

        footer_quantity_total += isNaN(total_quantity) ? 0 : total_quantity;
        footer_discount_total += isNaN(total_discount) ? 0 : total_discount;
        footer_tax_total += isNaN(total_tax) ? 0 : total_tax;
        footer_subtotal_total += isNaN(total_subtotal) ? 0 : total_subtotal;
        footer_sell_total += isNaN(total_sell) ? 0 : total_sell;
        footer_profit_total += isNaN(total_profit) ? 0 : total_profit;
    });

    var footer_gp_percent = footer_sell_total != 0 ? (footer_profit_total / footer_sell_total) * 100 : 0;

    $(`${div_id} .pir_footer_quantity_count`).html(__number_f(footer_quantity_total, false));
    $(`${div_id} .pir_footer_discount_total`).html(__currency_trans_from_en(footer_discount_total, false));
    $(`${div_id} .pir_footer_tax_total`).html(__currency_trans_from_en(footer_tax_total, false));
    $(`${div_id} .pir_footer_subtotal`).html(__currency_trans_from_en(footer_subtotal_total, false));
    $(`${div_id} .pir_footer_sell_total`).html(__currency_trans_from_en(footer_sell_total, false));
    $(`${div_id} .pir_footer_profit_total`).html(__currency_trans_from_en(footer_profit_total, false));
    $(`${div_id} .pir_footer_gp_percent`).html(__number_f(footer_gp_percent, false) + ' %');

    var gray_invoice_total = 0;
    var gray_paid_total = 0;
    var gray_due_total = 0;
    var gray_invoice_count = 0;
    var method_data = [];

    $(`${div_id} .pir_detail_row`).each(function() {
        let final_total = parseFloat($(this).find('.pir_grey_final_total').data('amount'));
        let paid = parseFloat($(this).find('.pir_grey_paid').data('amount'));
        let due = parseFloat($(this).find('.pir_grey_due').data('orig-value'));
        gray_invoice_total += isNaN(final_total) ? 0 : final_total;
        gray_paid_total += isNaN(paid) ? 0 : paid;
        gray_due_total += isNaN(due) ? 0 : due;
        gray_invoice_count++;
        if ($(this).find('.pir_grey_method').data('orig-value')) {
            var method_name = $(this).find('.pir_grey_method').data('orig-value');
            if (!(method_name in method_data)) {
                method_data[method_name] = [];
                method_data[method_name]['count'] = 1;
                method_data[method_name]['display_name'] = $(this).find('.pir_grey_method').data('status-name');
            } else {
                method_data[method_name]['count'] += 1;
            }
        }
    });

    $(`${div_id} .pir_grey_footer_final_total`).html(__currency_trans_from_en(gray_invoice_total, false));
    $(`${div_id} .pir_grey_footer_paid`).html(__currency_trans_from_en(gray_paid_total, false));
    $(`${div_id} .pir_grey_footer_due`).html(__currency_trans_from_en(gray_due_total, false));
    $(`${div_id} .pir_grey_footer_count`).html(gray_invoice_count);

    var method_count = '<p class="text-left"><small>';
    for (var key in method_data) {
        method_count += method_data[key]['display_name'] + ' - ' + method_data[key]['count'] + '</br>';
    }
    method_count += '</small></p>';
    $(`${div_id} .pir_grey_footer_method`).html(method_count);
}

function pir_get_invoices_list() {
    if ($('#pir_invoices').length) {
        var start = null;
        var end = null;
        if ($('#pir_date_filter').val()) {
            start = $('#pir_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
            end = $('#pir_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
        }
        var supplier_id = $('select#pir_supplier_id').val();
        var location_id = $('select#pir_location_id').val();
        $.ajax({
            url: '/purchases',
            data: {
                supplier_id: supplier_id,
                location_id: location_id,
                start_date: start,
                end_date: end,
                length: 500,
            },
            dataType: 'json',
            success: function(data) {
                let select2data = [];
                if (data && data.data) {
                    $.each(data.data, function(index, item) {
                        if (item.DT_RowId) {
                            select2data.push({
                                id: item.DT_RowId,
                                text: item.ref_no
                            });
                        }
                    });
                }
                $('#pir_invoices').empty().select2({data: select2data});
            },
        });
    }
}

function pir_generate_printing_filters() {
    report_filters = [];
    var dateRange = $('#pir_date_filter').val();
    report_filters.push({key: 'Date Range', value: dateRange});
    var start_time = $('#pir_start_time').val();
    var end_time = $('#pir_end_time').val();
    report_filters.push({key: 'Time Range', value: start_time + ' - ' + end_time});
    var type = $('#select2-pir_type_filter-container').text();
    report_filters.push({key: 'Type', value: type});
    var payment_status = $('#select2-pir_payment_status-container').text();
    report_filters.push({key: 'Payment Status', value: payment_status});
    var payment_method = $('#select2-pir_payment_method-container').text();
    report_filters.push({key: 'Payment Method', value: payment_method});
    var location = $('#select2-pir_location_id-container').text();
    report_filters.push({key: 'Location', value: location});
    var supplier = $('#select2-pir_supplier_id-container').text();
    report_filters.push({key: 'Supplier', value: supplier});
    var purchase_status = $('#select2-pir_purchase_status-container').text();
    report_filters.push({key: 'Purchase Status', value: purchase_status});

    let invoices = [];
    $('#pir_invoices').next('.select2').find('.select2-selection__choice').each(function() {
        let title = $(this).attr('title');
        invoices.push(title);
    });
    let invoices_string = invoices.join(', ');
    report_filters.push({key: 'Invoices', value: invoices_string});
    var invoice_from = $('#pir_invoice_from').val();
    report_filters.push({key: 'Invoice From', value: invoice_from});
    var invoice_to = $('#pir_invoice_to').val();
    report_filters.push({key: 'Invoice To', value: invoice_to});
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>