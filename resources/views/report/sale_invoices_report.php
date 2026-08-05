<?php $user_settings = json_decode(auth()->user()->user_settings, true) ?? []; ?>

<?php $__env->startSection('title', __('lang_v1.sale_invoices_report')); ?>

<?php $__env->startSection('css'); ?>
<style>
    /* Let DataTables scrollX handle overflow; wrapper must not clip */
    #sir_totals_tab,
    #sir_summary_tab {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    #sir_detailed_tab .table-responsive,
    #sir_detailed_scheme_tab .table-responsive,
    #contact_ledger_div .table-responsive,
    #contact_ledger_scheme_div .table-responsive {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch;
    }
    #contact_ledger_div .table-responsive > .table,
    #contact_ledger_scheme_div .table-responsive > .table {
        min-width: 900px;
    }
    /* Prevent text wrapping in table headers/cells to maintain readable columns */
    #total_sale_invoices th,
    #sale_report_table th,
    #ledger_table th,
    #total_sale_invoices td,
    #sale_report_table td {
        white-space: nowrap;
    }
    /* Fix DataTables buttons alignment */
    #sir_totals_tab .dt-buttons,
    #sir_summary_tab .dt-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        margin-bottom: 8px;
    }
    /* Print: Prevent text wrapping in summary tab */
    @media print {
        #sale_report_table th,
        #sale_report_table td {
            white-space: nowrap !important;
            overflow: visible !important;
        }
        #sir_summary_tab .table-responsive {
            overflow: visible !important;
        }
    }
    /* DataTables Print Button: Prevent text wrapping */
    @page {
        /* size: landscape; */
        margin: 0.5cm;
    }
    /* Force no-wrap for DataTables printed output */
    .dt-print-view table th,
    .dt-print-view table td {
        white-space: nowrap !important;
    }
    .dt-print-view {
        overflow: visible !important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo e(__('lang_v1.sale_invoices_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_sale_invoices_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getStockReport']), 'method'
            => 'get', 'id' => 'product_sell_report_form', 'class' => 'row',]); ?>

            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('sir_type_filter',  __('lang_v1.type') . ':'); ?>

                    <?php
                        $sir_type_options = ['sell' => 'Sales Invoices', 'sell_return' => 'Sales Return'];
                        if (!empty($enable_sales_order)) {
                            $sir_type_options['sales_order'] = __('lang_v1.sales_order');
                        }
                        if (!empty($enable_quotations)) {
                            $sir_type_options['quotation'] = __('lang_v1.quotation');
                        }
                    ?>
                    <?php echo Form::select('sir_type_filter', $sir_type_options, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('sir_payment_status',  __('purchase.payment_status') . ':'); ?>

                    <?php echo Form::select('sir_payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial'), 'overdue' => __('lang_v1.overdue')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('sir_payment_method',  __('purchase.payment_method') . ':'); ?>

                    <?php echo Form::select('payment_method', $payment_types, null, ['class' => 'form-control select2', 'id' =>'sir_payment_method', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('location_id', __('purchase.business_location').':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2',
                        'placeholder' => __('lang_v1.all'), 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('search_product', __('lang_v1.search_product') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                        <input type="hidden" value="" id="variation_id">
                        <?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product',
                        'placeholder' => __('lang_v1.search_product_placeholder'), 'autofocus']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('sir_invoices',  __('lang_v1.invoices') . ':'); ?>

                    <?php echo Form::select('invoices', [], null, ['class' => 'form-control select2', 'id' => 'sir_invoices', 'multiple','style' => 'width:100%']); ?>

                </div>
            </div>            
            <div class="col-md-3">
                <label for="sir_invoice_from_to">Invoices Range:</label>
                <div class="form-group mb-2">
                    <input class="form-control width-50 f-left" id="sir_invoice_from" name="sir_invoice_from" type="text" value="" placeholder="From">
                    <input class="form-control width-50 f-left" id="sir_invoice_to" name="sir_invoice_to" type="text" value="" placeholder="To">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('customer_id', __('contact.customer') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('customer_id', $customers, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.please_select'), 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('sir_customer_group_id', __( 'lang_v1.customer_group_name' ) . ':'); ?>

                    <?php echo Form::select('sir_customer_group_id', $customer_group, null, ['class' => 'form-control select2',
                    'style' => 'width:100%', 'id' => 'sir_customer_group_id']); ?>

                </div>
            </div>
            <div class="col-md-3" id='city_filter'>
                <div class="form-group mb-2">
                    <?php echo Form::label('city', __('business.city') . ':'); ?>

                    <?php echo Form::select('city', $cities, null, [
                    'class' => 'form-control select2',
                    'style' => 'width:100%',
                    'id' => 'city',
                    ]); ?>

                </div>
            </div>
            <div class="col-md-3" id='state_filter'>
                <div class="form-group mb-2">
                    <?php echo Form::label('state', __('business.state') . ':'); ?>

                    <?php echo Form::select('state', $states, null, [
                    'class' => 'form-control select2',
                    'style' => 'width:100%',
                    'id' => 'state',
                    ]); ?>

                </div>
            </div>
            <div class="col-md-3" id='country_filter'>
                <div class="form-group mb-2">
                    <?php echo Form::label('country', __('business.country') . ':'); ?>

                    <?php echo Form::select('country', $countries, null, [
                    'class' => 'form-control select2',
                    'style' => 'width:100%',
                    'id' => 'country',
                    ]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('brand_id', __('product.brand') . ':'); ?>

                    <?php echo Form::select('brand_id', $brands, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_brand_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('sir_date_filter', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' =>
                    'form-control', 'id' => 'sir_date_filter', 'readonly']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <?php echo Form::label('sir_start_time', __('lang_v1.time_range') . ':'); ?>

                <div class="form-group mb-2">
                    <?php echo Form::text('start_time', '00:00', ['style' => __('lang_v1.select_a_date_range'),
                    'class' => 'form-control width-50 f-left', 'id' => 'sir_start_time']); ?>

                    <?php echo Form::text('end_time', '23:59', ['class' => 'form-control width-50 f-left', 'id'
                    => 'sir_end_time']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <br>
                    <label class="form-check-label">
                        <?php echo Form::checkbox('show_sync_duplicates', 1, false, ['class' => 'form-check-input', 'id' => 'sir_show_sync_duplicates']); ?> <strong><?php echo app('translator')->get('lang_v1.show_only_duplicates'); ?></strong>
                    </label>
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
                        <a class="nav-link active pb-2 pe-2 ps-2" href="#sir_totals_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-list"
                            aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.totals'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#sir_summary_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i
                                class="fa fa-list" aria-hidden="true"></i> <?php echo app('translator')->get('report.summary'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#sir_detailed_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-bars"
                                    aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.detailed'); ?></a>
                    </li>
                    <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#sir_detailed_scheme_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-bars"
                                    aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.detailed'); ?> <?php echo app('translator')->get('lang_v1.scheme'); ?></a>
                    </li>
                    <?php endif; ?>
                    
                    
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="sir_totals_tab" role="tabpanel">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end sir_print_btn" data-tab="totals" aria-label="Print">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin w-100" id="total_sale_invoices">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.invoice_quantity'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.average_invoice'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th><?php echo app('translator')->get('lang_v1.item_quantity'); ?></th>
                                        <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                                        <th><?php echo app('translator')->get('sale.scheme_qty'); ?></th>
                                        <?php endif; ?>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.paid'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.due'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>

                                    </tr>
                                </thead>

                                <tbody></tbody>
                                <tfoot>
                                <tr class="bg-gray font-17 footer-total text-center">
                                    <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                    <td id="footer_total_invoices"></td>
                                    <td ></td>
                                    <td id="footer_total_items"></td>
                                    <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                                    <td ></td>
                                    <?php endif; ?>
                                    <td id="footer_sale_total" class="text-right"></td>
                                    <td id="footer_total_paid" class="text-right"></td>
                                    <td id="footer_total_due" class="text-right"></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sir_summary_tab" role="tabpanel">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end sir_print_btn" data-tab="summary" aria-label="Print">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped ajax_view table-th-skin w-100" id="sale_report_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.contact_id'); ?></th>
                                        <th style="width:350px"><?php echo app('translator')->get('sale.customer_name'); ?></th>  
                                        <th style="width:350px"><?php echo app('translator')->get('contact.contact_info'); ?></th>                                       
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> (<?php echo app('translator')->get('product.exc_of_tax'); ?>) (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.discount'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <?php if(!empty($common_settings['enable_total_discount2_sale'])): ?>
                                        <th class="text-right"><?php echo app('translator')->get('sale.discount'); ?> 2 (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <?php endif; ?>
                                        <?php if($show_product_tax_fields): ?>
                                        <th class="text-right"><?php echo app('translator')->get('sale.tax'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                                        <?php endif; ?>
                                        <?php if($type_of_service_enabled): ?>
                                        <th><?php echo app('translator')->get('lang_v1.types_of_service'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.types_of_service_amount'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
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
                                    
                                    <td ></td>
                                    
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td class="footer_total_discount_amount text-right"></td>
                                    <?php if(!empty($common_settings['enable_total_discount2_sale'])): ?>
                                    <td class="footer_total_discount2_amount text-right"></td>            
                                    <?php endif; ?>
                                    <?php if($show_product_tax_fields): ?>
                                    <td class="footer_total_tax_amount text-right"></td>
                                    <?php endif; ?>
                                    
                                    <?php if($type_of_service_enabled): ?>
                                    <td class="footer_sale_tos"></td>
                                    <td class="footer_total_tos_amount text-right"></td>
                                    <?php endif; ?>
                                    <?php if($show_product_tax_fields): ?>
                                    <td class="footer_sale_total text-right"></td>
                                    <?php endif; ?>
                                    <td class="footer_total_paid text-right"></td>
                                    <td class="payment_method_count"></td>
                                    <td class="footer_total_remaining text-right"></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sir_detailed_tab" role="tabpanel">
                        <div class="row no-print">
                            <div class="col-md-12">
                                <button type="button" data-href="<?php echo e(action([\App\Http\Controllers\ReportController::class, 'getSaleInvoicesReportDetailedExcel']), false); ?>" id="export_sir_detailed_excel" class="btn btn-success float-end mr-5"><i class="fa fa-file-excel"></i> <?php echo app('translator')->get('lang_v1.export_to_excel'); ?></button>
                                <button type="button" class="btn btn-primary float-end mr-5 sir_print_btn" data-tab="detailed" aria-label="Print"><i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4</button>
                                
                            </div>
                        </div>
                        <div id="contact_ledger_div"></div>
                    </div>
                    <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                    <div class="tab-pane fade" id="sir_detailed_scheme_tab" role="tabpanel">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end sir_print_btn" data-tab="detailed_scheme" aria-label="Print">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div id="contact_ledger_scheme_div"></div>
                    </div>
                    <?php endif; ?>
                    
                    
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
    $('#product_sell_report_form #location_id, #product_sell_report_form #customer_id, #psr_filter_brand_id, #psr_customer_group_id').change(function() {
        $('.nav-tabs li.active').find('a[data-bs-toggle="tab"]').trigger('shown.bs.tab');
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var saleInvoicesDateRangeSettings = window.getAdminReportDateRangeSettings();
        saleInvoicesDateRangeSettings.autoUpdateInput = false;
        saleInvoicesDateRangeSettings.locale = $.extend({}, saleInvoicesDateRangeSettings.locale, {
            format: moment_date_format,
            cancelLabel: LANG.clear,
            applyLabel: LANG.apply,
            customRangeLabel: LANG.custom_range,
        });
        
        $('#sir_date_filter').daterangepicker(
        saleInvoicesDateRangeSettings,
        function (start, end) {
            $('#sir_date_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            sir_detailed_page = 1;
            get_contact_ledger(1);
            sale_report_table.ajax.reload();
            total_sale_invoices.ajax.reload();
            get_sales_invoices_list();
        }
        );
        var saleInvoicesDatePicker = $('#sir_date_filter').data('daterangepicker');
        if (saleInvoicesDatePicker) {
            $('#sir_date_filter').val(
                saleInvoicesDatePicker.startDate.format(moment_date_format) + ' ~ ' + saleInvoicesDatePicker.endDate.format(moment_date_format)
            );
        }
        $('#sir_date_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#sir_date_filter').val('');
            sir_detailed_page = 1;
            get_contact_ledger(1);
            sale_report_table.ajax.reload();
            total_sale_invoices.ajax.reload();
            get_sales_invoices_list();
        });
        $('#sir_date_filter').change( function(){
            sir_detailed_page = 1;
            get_contact_ledger(1);
            sale_report_table.ajax.reload();
            total_sale_invoices.ajax.reload();
            get_sales_invoices_list();
        });
        
        $('#sir_start_time, #sir_end_time').datetimepicker({
                format: 'HH:mm',
                ignoreReadonly: true,
        }).on('focusout', function(ev){
            sir_detailed_page = 1;
            get_contact_ledger(1);
            sale_report_table.ajax.reload();
            total_sale_invoices.ajax.reload();
            $('.nav-tabs li.active').find('a[data-bs-toggle="tab"]').trigger('shown.bs.tab');
        });

        get_contact_ledger();

        sale_report_table = $('#sale_report_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[1, 'desc']],
            dom: '<"row margin-bottom-20"<"col-xs-12 col-2 mb-2"l><"col-xs-12 col-8 mb-2 dt-buttons-wrapper"B><"col-xs-12 col-2 mb-2"f>>rtip',
            "ajax": {
                "url": "/sells",
                "data": function ( d ) {
                    var start_time = $('#sir_start_time').val();
                    var end_time = $('#sir_end_time').val();
                    if($('#sir_date_filter').val()) {
                        var start = $('#sir_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        start = moment(start + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                        var end = $('#sir_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        end = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                        d.start_date = start;
                        d.end_date = end;
                    }
                    d.location_id = $('#location_id').val();
                    d.customer_id = $('#customer_id').val();
                    d.customer_group_id = $('#sir_customer_group_id').val();
                    d.payment_status = $('#sir_payment_status').val();
                    d.sale_type = $('#sir_type_filter').val();
                    d.payment_method = $('#sir_payment_method').val();
                    d.sale_invoices_report = true;
                    d.invoices = $('#sir_invoices').val();
                    d.invoice_from = $('#sir_invoice_from').val();
                    d.invoice_to = $('#sir_invoice_to').val();
                    d.variation_id = $('#variation_id').val();
                    d.brand_id = $('#psr_filter_brand_id').val();
                    d.city = $('#city').val();
                    d.state = $('#state').val();
                    d.country = $('#country').val();
                    d.show_sync_duplicates = $('#sir_show_sync_duplicates').is(':checked');
                    d = __datatable_ajax_callback(d);
                }
            },
            columns: [
            { data: 'sale_date', name: 'transactions.transaction_date' },
            { data: 'invoice_no', name: 'transactions.invoice_no' },
            { data: 'contact_id', name: 'contacts.contact_id' },
            { data: 'conatct_name', name: 'conatct_name' },
            { data: 'contact_info', name: 'contact_info' },
            { data: 'total_before_tax', name: 'total_before_tax', className: 'text-right' },
            { data: 'discount_amount', name: 'discount_amount', className: 'text-right' },
            <?php if(!empty($common_settings['enable_total_discount2_sale'])): ?>
            { data: 'discount2_amount', name: 'discount2_amount', className: 'text-right' },
            <?php endif; ?>
            <?php if($show_product_tax_fields): ?>
            { data: 'tax_amount', name: 'tax_amount', className: 'text-right' },
            <?php endif; ?>
            <?php if($type_of_service_enabled): ?>
            { data: 'types_of_service_name', name: 'tos.name' },
            { data: 'types_of_service_amount', name: 'types_of_service_amount', className: 'text-right' },
            <?php endif; ?>
            <?php if($show_product_tax_fields): ?>
            { data: 'final_total', name: 'final_total', className: 'text-right' },
            <?php endif; ?>
            { data: 'total_paid', name: 'total_paid', className: 'text-right' },
            { data: 'payment_methods', name: 'payment_methods' },
            { data: 'total_remaining', name: 'total_remaining', className: 'text-right' },
            ],
            "fnDrawCallback": function (oSettings) {
                __currency_convert_recursively($('#sale_report_table'));
            },
                "footerCallback": function ( row, data, start, end, display ) {
                    var footer_sale_total = 0;
                    var footer_total_paid = 0;
                    var footer_total_remaining = 0;
                    var footer_total_sell_return_due = 0;
                    var footer_total_tax_amount = 0;
                    var footer_total_tos_amount = 0;
                    var footer_total_discount_amount = 0;
                    var footer_total_discount2_amount = 0;
                    for (var r in data){
                        <?php if($show_product_tax_fields): ?>
                        footer_sale_total += $(data[r].final_total).data('orig-value') ? parseFloat($(data[r].final_total).data('orig-value')) : 0;
                        <?php endif; ?>
                        footer_total_paid += $(data[r].total_paid).data('orig-value') ? parseFloat($(data[r].total_paid).data('orig-value')) : 0;
                        footer_total_remaining += $(data[r].total_remaining).data('orig-value') ? parseFloat($(data[r].total_remaining).data('orig-value')) : 0;
                        footer_total_sell_return_due += $(data[r].return_due).data('orig-value') ? parseFloat($(data[r].return_due).data('orig-value')) : 0;
                        <?php if($show_product_tax_fields): ?>
                        footer_total_tax_amount += $(data[r].tax_amount).data('orig-value') ? parseFloat($(data[r].tax_amount).data('orig-value')) : 0;
                        <?php endif; ?>
                        footer_total_tos_amount += $(data[r].types_of_service_amount).data('orig-value') ? parseFloat($(data[r].types_of_service_amount).data('orig-value')) : 0;
                        footer_total_discount_amount += $(data[r].discount_amount).data('orig-value') ? parseFloat($(data[r].discount_amount).data('orig-value')) : 0;
                        footer_total_discount2_amount += $(data[r].discount2_amount).data('orig-value') ? parseFloat($(data[r].discount2_amount).data('orig-value')) : 0;
                    }

                    $('.footer_total_discount_amount').html(__currency_trans_from_en(footer_total_discount_amount));
                    $('.footer_total_discount2_amount').html(__currency_trans_from_en(footer_total_discount2_amount));
                    <?php if($show_product_tax_fields): ?>
                    $('.footer_total_tax_amount').html(__currency_trans_from_en(footer_total_tax_amount));
                    <?php endif; ?>
                    $('.footer_total_tos_amount').html(__currency_trans_from_en(footer_total_tos_amount));
                    $('.footer_total_sell_return_due').html(__currency_trans_from_en(footer_total_sell_return_due));
                    $('.footer_total_remaining').html(__currency_trans_from_en(footer_total_remaining));
                    $('.footer_total_paid').html(__currency_trans_from_en(footer_total_paid));
                    <?php if($show_product_tax_fields): ?>
                    $('.footer_sale_total').html(__currency_trans_from_en(footer_sale_total));
                    <?php endif; ?>

                    $('.footer_payment_status_count').html(__count_status(data, 'payment_status'));
                    $('.service_type_count').html(__count_status(data, 'types_of_service_name'));
                    $('.payment_method_count').html(__count_status(data, 'payment_methods'));
                    generate_printing_filters();
                },
                createdRow: function( row, data, dataIndex ) {
                    $( row ).find('td:eq(6)').attr('class', 'clickable_td');
                }
            
        });

        var total_sale_invoices_columns = [
            { data: 'sale_date', name: 'transactions.transaction_date' },
            { data: 'total_invoices', name: 'total_invoices' },
            { data: 'average_invoice', name: 'average_invoice', className: 'text-right' },
            { data: 'total_items', name: 'total_items' },
        ];

        if (<?php echo json_encode(!empty($common_settings['enable_scheme_quantity_sales']), 15, 512) ?>) {
            total_sale_invoices_columns.push({ data: 'total_foc_items', name: 'total_foc_items' });
        }
        total_sale_invoices_columns.push({ data: 'final_total', name: 'final_total', className: 'text-right' },
            { data: 'total_paid', name: 'total_paid', className: 'text-right' },
            { data: 'total_remaining', name: 'total_remaining', className: 'text-right' });

        total_sale_invoices = $('#total_sale_invoices').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[1, 'desc']],
            dom: '<"row margin-bottom-20"<"col-xs-12 col-2 mb-2"l><"col-xs-12 col-8 mb-2 dt-buttons-wrapper"B><"col-xs-12 col-2 mb-2"f>>rtip',
            "ajax": {
                "url": "/reports/sale-invoices-total",
                "data": function ( d ) {
                    var start_time = $('#sir_start_time').val();
                    var end_time = $('#sir_end_time').val();
                    
                    if($('#sir_date_filter').val()) {
                        var start = $('#sir_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        start = moment(start + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                        var end = $('#sir_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        end = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                        d.start_date = start;
                        d.end_date = end;
                    }
                    d.sale_type = $('#sir_type_filter').val();
                    d.location_id = $('#location_id').val();
                    d.customer_id = $('#customer_id').val();
                    d.payment_status = $('#sir_payment_status').val();
                    d.payment_method = $('#sir_payment_method').val();
                    d.customer_group_id = $('#sir_customer_group_id').val();
                    d.invoices = $('#sir_invoices').val();
                    d.invoice_from = $('#sir_invoice_from').val();
                    d.invoice_to = $('#sir_invoice_to').val();
                    d.variation_id = $('#variation_id').val();
                    d.brand_id = $('#psr_filter_brand_id').val();
                    d.city = $('#city').val();
                    d.state = $('#state').val();
                    d.country = $('#country').val();
                    d.show_sync_duplicates = $('#sir_show_sync_duplicates').is(':checked');
                    d = __datatable_ajax_callback(d);
                }
            },
            columns: total_sale_invoices_columns,
            "fnDrawCallback": function (oSettings) {
                __currency_convert_recursively($('#sale_report_table'));
            },
                "footerCallback": function ( row, data, start, end, display ) {
                    var footer_sale_total = 0;
                    var footer_total_paid = 0;
                    var footer_total_remaining = 0;
                    var footer_total_invoices = 0;
                    var footer_total_items = 0;
                    for (var r in data){
                        footer_sale_total += $(data[r].final_total).data('orig-value') ? parseFloat($(data[r].final_total).data('orig-value')) : 0;
                        footer_total_paid += $(data[r].total_paid).data('orig-value') ? parseFloat($(data[r].total_paid).data('orig-value')) : 0;
                        footer_total_remaining += $(data[r].total_remaining).data('orig-value') ? parseFloat($(data[r].total_remaining).data('orig-value')) : 0;
                        footer_total_invoices += __number_uf(data[r].total_invoices) || 0;
                        footer_total_items += __number_uf(data[r].total_items) || 0;
                    }

                    $('#footer_total_due').html(__currency_trans_from_en(footer_total_remaining, false));
                    $('#footer_total_paid').html(__currency_trans_from_en(footer_total_paid, false));
                    $('#footer_sale_total').html(__currency_trans_from_en(footer_sale_total, false));
                    $('#footer_total_invoices').html(footer_total_invoices);
                    $('#footer_total_items').html(footer_total_items);
                    generate_printing_filters();
                },
                createdRow: function( row, data, dataIndex ) {
                    $( row ).find('td:eq(6)').attr('class', 'clickable_td');
                }
            
        });
        
        $(document).on('change', '#location_id, #customer_id, #sir_customer_group_id, #sir_payment_status, #sir_type_filter, #sir_payment_method, #sir_invoice_from, #sir_invoice_to, #variation_id, #psr_filter_brand_id, #city, #state, #country, #sir_show_sync_duplicates',  function() {
            sale_report_table.ajax.reload();
            sir_detailed_page = 1;
            get_contact_ledger(1);
            total_sale_invoices.ajax.reload();
            get_sales_invoices_list();
        });
        $("#sir_invoices").on("change", function () {
            sale_report_table.ajax.reload();
            sir_detailed_page = 1;
            get_contact_ledger(1);
            total_sale_invoices.ajax.reload();
        });
        get_sales_invoices_list();

        $(document).on('click', '#export_sir_detailed_excel', function(){
            var url = $(this).data('href') + '?' + $.param(get_sir_detailed_filter_params());
            window.open(url);
        });

        $(document).on('click', '.sir_print_btn', function(){
            var url = '<?php echo e(url('reports/sale-invoices-report-print'), false); ?>?' + $.param(get_sir_print_filter_params($(this).data('tab')));
            window.open(url, '_blank');
        });

        // Detailed tab pagination - page link clicks
        $(document).on('click', '.sir-detailed-page-link', function(e) {
            e.preventDefault();
            var $li = $(this).closest('li');
            if ($li.hasClass('disabled') || $li.hasClass('active')) return;
            var page = parseInt($(this).data('page'));
            if (page >= 1) {
                get_contact_ledger(page);
            }
        });

        // Detailed tab pagination - per-page change
        $(document).on('change', '#sir_detailed_per_page', function() {
            var val = $(this).val();
            sir_detailed_per_page = val === 'All' ? 'All' : parseInt(val);
            sir_detailed_page = 1;
            get_contact_ledger(1);
        });

        // Reset to page 1 when filters change
        $(document).on('change', '#location_id, #customer_id, #sir_customer_group_id, #sir_payment_status, #sir_type_filter, #sir_payment_method, #sir_invoice_from, #sir_invoice_to, #variation_id, #psr_filter_brand_id, #city, #state, #country, #sir_show_sync_duplicates', function() {
            sir_detailed_page = 1;
        });

        // $(document).on('click', '#print_report_pdf', function(){
        //     var start_date = '';
        //     var end_date = '';
        //     var location_id = $('#location_id').val();
        //     var customer_id = $('#customer_id').val();
        //     var customer_group_id = $('#sir_customer_group_id').val();
        //     var payment_status = $('#sir_payment_status').val();
        //     var payment_method = $('#sir_payment_method').val();
        //     var sale_type = $('#sir_type_filter').val();
        //     var invoices = $('#sir_invoices').val();
        //     var invoice_from = $('#sir_invoice_from').val();
        //     var invoice_to = $('#sir_invoice_to').val();
        //     var variation_id = $('#variation_id').val();
        //     var city = $('#city').val();
        //     var state = $('#state').val();
        //     var country = $('#country').val();    
            
            
        //     var start_time = $('#sir_start_time').val();
        //     var end_time = $('#sir_end_time').val();
        //     if($('#sir_date_filter').val()) {
        //         start_date = $('#sir_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
        //         start_date = moment(start_date + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
        //         end_date = $('#sir_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
        //         end_date = moment(end_date + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
        //     }
            
        //     var url = $(this).data('href') + '&sale_type=' + sale_type + '&start_date=' + start_date + '&end_date=' + end_date + '&location_id=' + location_id
        //             + '&contact_id=' + customer_id+'&customer_group_id=' + customer_group_id+'&payment_status='+ payment_status 
        //             + '&payment_method=' + payment_method + '&invoices=' + invoices + '&invoice_from=' + invoice_from + '&invoice_to=' + invoice_to
        //             + '&variation_id=' + variation_id + '&city=' + city + '&state=' + state + '&country=' + country;
        //     window.open(url);
        // });
    });
</script>
<script type="text/javascript">
// Pagination variables (global scope so get_contact_ledger can access them)
var sir_detailed_page = 1;
var sir_detailed_per_page = 25;
var sir_detailed_request = null;

function get_sir_detailed_filter_params() {
    var start_date = '';
    var end_date = '';
    var start_time = $('#sir_start_time').val();
    var end_time = $('#sir_end_time').val();

    if($('#sir_date_filter').val()) {
        start_date = $('#sir_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
        start_date = moment(start_date + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
        end_date = $('#sir_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
        end_date = moment(end_date + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
    }

    return {
        sale_type: $('#sir_type_filter').val(),
        start_date: start_date,
        end_date: end_date,
        format: 'format_3',
        location_id: $('#location_id').val(),
        contact_id: $('#customer_id').val(),
        customer_group_id: $('#sir_customer_group_id').val(),
        payment_status: $('#sir_payment_status').val(),
        payment_method: $('#sir_payment_method').val(),
        invoices: $('#sir_invoices').val(),
        invoice_from: $('#sir_invoice_from').val(),
        invoice_to: $('#sir_invoice_to').val(),
        variation_id: $('#variation_id').val(),
        brand_id: $('#psr_filter_brand_id').val(),
        city: $('#city').val(),
        state: $('#state').val(),
        country: $('#country').val(),
        show_sync_duplicates: $('#sir_show_sync_duplicates').is(':checked')
    };
}

function get_sir_print_filter_params(tab) {
    var params = get_sir_detailed_filter_params();
    params.tab = tab || 'totals';
    params.customer_id = $('#customer_id').val();

    $.each(params, function (key, value) {
        if (value === '' || value === null || typeof value === 'undefined' || (Array.isArray(value) && value.length === 0)) {
            delete params[key];
        }
    });

    return params;
}

function get_contact_ledger(page) {
    var data = get_sir_detailed_filter_params();
    data.page = page || sir_detailed_page;
    data.per_page = sir_detailed_per_page;

    if (sir_detailed_request && sir_detailed_request.readyState !== 4) {
        sir_detailed_request.abort();
    }

    var loader = __fa_awesome();
    $('#contact_ledger_div').html(`
        <div class="container text-center" style="justify-content: space-around;display: flex;">
            <div style="padding: 15px;margin: 25px;font-size: 1.4em;background-color: #d0f5be;width: 40%;">Processing Report ${loader}</div>
        </div>
    `);
    var request = $.ajax({
        url: '/reports/sale-invoices-detailed',
        data: data,
        dataType: 'html',
        timeout: 120000,
        success: function(result) {
            $('#contact_ledger_div')
                .html(result);
            sir_detailed_page = parseInt(data.page) || 1;
            calculate_ledger_footer_total('#contact_ledger_div');
        },
        error: function(xhr, textStatus) {
            if (textStatus === 'abort') {
                return;
            }

            var message = textStatus === 'timeout'
                ? 'Report request timed out. Please narrow the filters and try again.'
                : <?php echo json_encode(__('messages.something_went_wrong'), 15, 512) ?>;

            $('#contact_ledger_div').html(
                '<div class="alert alert-danger" style="margin: 20px;">' + message + '</div>'
            );
        },
        complete: function() {
            if (sir_detailed_request === request) {
                sir_detailed_request = null;
            }
        },
    });
    sir_detailed_request = request;

    // generate_printing_filters();

    // var loader = __fa_awesome();
    // $('#contact_ledger_scheme_div').html(`
    //     <div class="container text-center" style="justify-content: space-around;display: flex;">
    //         <div style="padding: 15px;margin: 25px;font-size: 1.4em;background-color: #d0f5be;width: 40%;">Processing Report ${loader}</div>
    //     </div>
    // `);
    // // data.scheme = true;
    // $.ajax({
    //     url: '/reports/sale-invoices-detailed',
    //     data: data,
    //     dataType: 'html',
    //     success: function(result) {
    //         $('#contact_ledger_scheme_div')
    //             .html(result);
    //         //__currency_convert_recursively($('#contact_ledger_div'));

        
    //     //    $('#ledger_table').DataTable({
    //     //     searching: true,
    //     //     ordering: false,
    //     //     paging: true,
    //     //     dom: 't'
    //     //     });
    //         calculate_ledger_footer_total('#contact_ledger_scheme_div');
    //     },
    // });
}

function calculate_ledger_footer_total(div_id){
        var footer_quantity_total = 0;
        var footer_discount_total = 0;
        var footer_tax_total = 0;
        var footer_tos_total = 0;
        var footer_subtotal_total = 0;
        var footer_profit_total = 0;
        var footer_purchase_total = 0;

        $(`${div_id} .total_row_footer`).each(function() {
            var total_quantity = parseFloat($(this).find('.total_quantity_row').val());                   
            var total_discount = parseFloat($(this).find('.total_discount_row').val());
            var total_tax = parseFloat($(this).find('.total_tax_row').val());
            var total_tos = parseFloat($(this).find('.total_tos_row').val());
            var total_subtotal = parseFloat($(this).find('.total_sub_total_row').val());
            var total_profit = parseFloat($(this).find('.total_profit_row').val());
            var total_purchase = parseFloat($(this).find('.total_purchase_row').val());

            footer_quantity_total += isNaN(total_quantity) ? 0 : total_quantity;
            footer_discount_total += isNaN(total_discount) ? 0 : total_discount;
            footer_tax_total += isNaN(total_tax) ? 0 : total_tax;
            footer_tos_total += isNaN(total_tos) ? 0 : total_tos;
            footer_subtotal_total += isNaN(total_subtotal) ? 0 : total_subtotal;
            footer_profit_total += isNaN(total_profit) ? 0 : total_profit;
            footer_purchase_total += isNaN(total_purchase) ? 0 : total_purchase;
        });
        
        $(`${div_id} .footer_quantity_count`).html(__number_f(footer_quantity_total, false));
        $(`${div_id} .footer_discount_total`).html(__currency_trans_from_en(footer_discount_total, false));
        $(`${div_id} .footer_tax_total`).html(__currency_trans_from_en(footer_tax_total, false));
        $(`${div_id} .footer_subtotal`).html(__currency_trans_from_en(footer_subtotal_total, false));
        $(`${div_id} .footer_tos_total`).html(__currency_trans_from_en(footer_tos_total, false));
        $(`${div_id} .footer_profit_total`).html(__currency_trans_from_en(footer_profit_total, false));
        $(`${div_id} .footer_purchase_total`).html(__currency_trans_from_en(footer_purchase_total, false));

        var gray_invoice_total = 0;
        var gray_paid_total = 0;
        var gray_due_total = 0;
        var gray_invoice_count = 0;
        var method_data = [];

        $(`${div_id} .sell_detail_row`).each(function() {
            let final_total = parseFloat($(this).find('.grey_final_total').data('amount'));                   
            let paid = parseFloat($(this).find('.grey_paid').data('amount'));                   
            let due = parseFloat($(this).find('.grey_due').data('orig-value'));                  
            gray_invoice_total += isNaN(final_total) ? 0 : final_total;
            gray_paid_total += isNaN(paid) ? 0 : paid;
            gray_due_total += isNaN(due) ? 0 : due;
            gray_invoice_count++;
            if ($(this).find('.grey_method').data('orig-value')) {
                var method_name = $(this).find('.grey_method').data('orig-value');
                if (!(method_name in method_data)) {
                    method_data[method_name] = [];
                    method_data[method_name]['count'] = 1;
                    method_data[method_name]['display_name'] = $(this).find('.grey_method').data('status-name');
                } else {
                    method_data[method_name]['count'] += 1;
                }
            }
        });

        $(`${div_id} .grey_footer_final_total`).html(__currency_trans_from_en(gray_invoice_total, false));
        $(`${div_id} .grey_footer_paid`).html(__currency_trans_from_en(gray_paid_total, false));
        $(`${div_id} .grey_footer_due`).html(__currency_trans_from_en(gray_due_total, false));
        $(`${div_id} .grey_footer_count`).html(gray_invoice_count);
        
        var method_count = '<p class="text-left"><small>';
        for (var key in method_data) {
            method_count += method_data[key]['display_name'] + ' - ' + method_data[key]['count'] + '</br>';
        }
        method_count += '</small></p>';
        $(`${div_id} .grey_footer_method`).html(method_count);

    }

function get_sales_invoices_list() {
    if ($('#sir_invoices').length) {
        if ($('#sir_invoices').hasClass('not_loaded')) {
            $('#sir_invoices').removeClass('not_loaded');
            return false;
        }

        var start = null;
        var end = null;
        if($('#sir_date_filter').val()) {
            var start = $('#sir_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
            var end = $('#sir_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
        }
        var customer_id = $('select#customer_id').val();
        var location_id = $('select#location_id').val();
        $.ajax({
            url: '/sells/' + customer_id + '?location_id=' + location_id+'&start_date='+start+'&end_date='+end,
            dataType: 'json',
            success: function(data) {
                let select2data = [];
                $.each(data.data, function(index, item) {
                    select2data.push({
                        id: item.sell_tran_id,        // Invoice number as ID
                        text: item.invoice_no_text  // Invoice text
                    });
                });
                $('#sir_invoices').empty().select2({data: select2data});
            },
        });
    }
}

function generate_printing_filters(){
    report_filters = [];
    var dateRange = $('#sir_date_filter').val();
    report_filters.push({key: 'Date Range', value: dateRange});
    var start_date = $('#sir_start_time').val();
    var end_date = $('#sir_end_time').val();
    report_filters.push({key: 'Time Range', value: start_date+ ' - '+ end_date});
    var type = $('#select2-sir_type_filter-container').text();
    report_filters.push({key: 'Type', value: type});
    var payment_status = $('#select2-sir_payment_status-container').text();
    report_filters.push({key: 'Payment Status', value: payment_status});
    var payment_method = $('#select2-sir_payment_method-container').text();
    report_filters.push({key: 'Payment Method', value: payment_method});
    var location = $('#select2-location_id-container').text();
    report_filters.push({key: 'Location', value: location});
    var product = $('#search_product').val();
    report_filters.push({key: 'Product', value: product});

    let invoices = [];
    $('#sir_invoices').next('.select2').find('.select2-selection__choice').each(function() {
        let title = $(this).attr('title');
        invoices.push(title);
    });
    let invoices_string = invoices.join(', ');
    report_filters.push({key: 'Invoices', value: invoices_string});
    var sir_invoice_from = $('#sir_invoice_from').val();
    report_filters.push({key: 'Invoice From', value: sir_invoice_from});
    var sir_invoice_to = $('#sir_invoice_to').val();
    report_filters.push({key: 'Invoice To', value: sir_invoice_to});
    var customer = $('#select2-customer_id-container').text();
    report_filters.push({key: 'Customer', value: customer});
    var customer_group = $('#select2-sir_customer_group_id-container').text();
    report_filters.push({key: 'Customer Group', value: customer_group});
    var city = $('#select2-city-container').text();
    report_filters.push({key: 'City', value: city});
    var state = $('#select2-state-container').text();
    report_filters.push({key: 'State', value: state});
    var country = $('#select2-country-container').text();
    report_filters.push({key: 'Countr', value: country});
    var brand = $('#select2-psr_filter_brand_id-container').text();
    report_filters.push({key: 'Brand', value: brand});
    report_filters.push({
        key: 'Show Only Duplicates',
        value: $('#sir_show_sync_duplicates').is(':checked') ? 'Yes' : 'No'
    });
}

$(document).ready(function(){
    <?php if(!empty($user_settings['rpt_sales_sinv_hide_date'])): ?>
        total_sale_invoices.column('transactions.transaction_date:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_sinv_hide_invoice_qty'])): ?>
        total_sale_invoices.column('total_invoices:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_sinv_hide_avg_invoice'])): ?>
        total_sale_invoices.column('average_invoice:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_sinv_hide_item_qty'])): ?>
        total_sale_invoices.column('total_items:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_sinv_hide_scheme_qty'])): ?>
        total_sale_invoices.column('total_foc_items:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_sinv_hide_total'])): ?>
        total_sale_invoices.column('final_total:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_sinv_hide_paid'])): ?>
        total_sale_invoices.column('total_paid:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_sinv_hide_due'])): ?>
        total_sale_invoices.column('total_remaining:name').visible(false);
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>