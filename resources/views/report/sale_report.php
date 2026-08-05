<?php $user_settings = json_decode(auth()->user()->user_settings, true) ?? []; ?>

<?php $__env->startSection('title', 'Report 607 (' . __('business.sale') . ')'); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>Report 607 (<?php echo app('translator')->get('business.sale'); ?>)
    </h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_sale_607_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
    <?php echo $__env->make('sell.partials.sell_list_filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row no-print">
        <div class="col-sm-12 mb-2">
            <button type="button" class="btn btn-primary float-end" id="sale_report_print_btn" aria-label="Print">
                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
            </button>
        </div>
    </div>
    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped ajax_view table-th-skin" id="sale_report_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('lang_v1.contact_id'); ?></th>
                    <th style="width:350px"><?php echo app('translator')->get('sale.customer_name'); ?></th>
                    <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                    <th><?php echo app('translator')->get('messages.date'); ?></th>
                    <th><?php echo app('translator')->get('sale.total'); ?> (<?php echo app('translator')->get('product.exc_of_tax'); ?>)</th>
                    <th><?php echo app('translator')->get('sale.discount'); ?></th>
                    <th><?php echo app('translator')->get('sale.tax'); ?></th>
                    <th><?php echo app('translator')->get('sale.total'); ?> (<?php echo app('translator')->get('product.inc_of_tax'); ?>)</th>
                    <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Total: </th>
                    <th><span id="span_total_exc_tax" class="span_total_exc_tax">0</span></th>
                    <th><span id="span_total_discount" class="span_total_discount">0</span></th>
                    <th><span id="span_total_tax" class="span_total_tax">0</span></th>
                    <th><span id="span_total_inc_tax" class="span_total_inc_tax">0</span></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php echo $__env->renderComponent(); ?>
    
</section>

<section id="receipt_section" class="print_section"></section>

<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">
    $(document).ready(function() {
        function getSaleReportFilterParams() {
            var params = {
                location_id: $('#sell_list_filter_location_id').val() || '',
                customer_id: $('#sell_list_filter_customer_id').val() || '',
                customer_group_id: $('#sell_list_filter_customer_group_id').val() || '',
                payment_status: $('#sell_list_filter_payment_status').val() || '',
                created_by: $('#created_by').val() || '',
                sales_cmsn_agnt: $('#sales_cmsn_agnt').val() || '',
                service_staffs: $('#service_staffs').val() || '',
                tax_type: $('#tax_type').val() || '',
                station_type: $('#station_type').val() || '',
                currency_filter: $('#sell_list_filter_currency').val() || '',
                only_subscriptions: $('#only_subscriptions').is(':checked') ? 1 : '',
                only_takeaway: $('#only_takeaway').is(':checked') ? 1 : '',
                sale_report_607: 1
            };

            var start_time = $('#sell_list_filter_start_time').val() || '00:00';
            var end_time = $('#sell_list_filter_end_time').val() || '23:59';
            var picker = $('#sell_list_filter_date_range').data('daterangepicker');

            if ($('#sell_list_filter_date_range').val() && picker) {
                var start = picker.startDate.format('YYYY-MM-DD');
                params.start_date = moment(start + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                var end = picker.endDate.format('YYYY-MM-DD');
                params.end_date = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
            }

            $.each(params, function (key, value) {
                if (value === '' || value === null || typeof value === 'undefined') {
                    delete params[key];
                }
            });

            return params;
        }

        let saleReportDateRangeSettings = window.getAdminReportDateRangeSettings();
        saleReportDateRangeSettings.autoUpdateInput = false;
        saleReportDateRangeSettings.locale = $.extend({}, saleReportDateRangeSettings.locale, {
            format: moment_date_format,
            cancelLabel: LANG.clear,
            applyLabel: LANG.apply,
            customRangeLabel: LANG.custom_range,
        });
        $('#sell_list_filter_date_range').daterangepicker(
        saleReportDateRangeSettings,
        function (start, end) {
            $('#sell_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            sale_report_table.ajax.reload();
        }
        );
        let saleReportDatePicker = $('#sell_list_filter_date_range').data('daterangepicker');
        if (saleReportDatePicker) {
            $('#sell_list_filter_date_range').val(
                saleReportDatePicker.startDate.format(moment_date_format) + ' ~ ' + saleReportDatePicker.endDate.format(moment_date_format)
            );
        }
        $('#sell_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#sell_list_filter_date_range').val('');
            sale_report_table.ajax.reload();
        });
       
        $('#sell_list_filter_start_time, #sell_list_filter_end_time').datetimepicker({
                format: moment_time_format,
                ignoreReadonly: true,
        }).on('focusout', function(ev){
            sale_report_table.ajax.reload();
        });

        $('#sale_report_print_btn').on('click', function () {
            window.open('<?php echo e(url('reports/sale-report-print'), false); ?>?' + $.param(getSaleReportFilterParams()), '_blank');
        });

        sale_report_table = $('#sale_report_table').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            aaSorting: [[1, 'desc']],
            "ajax": {
                "url": "/sells",
                "data": function ( d ) {
                    $.extend(d, getSaleReportFilterParams());
                    d = __datatable_ajax_callback(d);
                }
            },
            columns: [
            { data: 'contact_id', name: 'contacts.contact_id' },
            { data: 'conatct_name', name: 'conatct_name' },
            { data: 'invoice_no_text', name: 'transactions.invoice_no' },
            { data: 'sale_date', name: 'transactions.transaction_date' },
            { data: 'total_before_tax', name: 'total_before_tax' },
            { data: 'discount_amount', name: 'discount_amount' },
            { data: 'tax_amount', name: 'tax_amount' },
            { data: 'final_total', name: 'final_total' },
            { data: 'payment_methods', name: 'payment_methods' },
            ],
            "fnDrawCallback": function (oSettings) {
                __currency_convert_recursively($('#sale_report_table'));

                // Recalculate footer totals from the rendered table rows on
                // every draw. Reading from the DOM guarantees the footer
                // always matches what the user actually sees — when the
                // filter yields no rows, every total resets to 0.
                var footer_total_exc_tax = 0;
                var footer_discount = 0;
                var footer_tax = 0;
                var footer_total_inc_tax = 0;

                $('#sale_report_table tbody tr').each(function () {
                    var $row = $(this);
                    // Skip the "No data available in table" placeholder row.
                    if ($row.find('td').length <= 1) {
                        return;
                    }
                    var v;
                    v = parseFloat($row.find('.total_before_tax').attr('data-orig-value'));
                    if (!isNaN(v)) footer_total_exc_tax += v;
                    v = parseFloat($row.find('.total-discount').attr('data-orig-value'));
                    if (!isNaN(v)) footer_discount += v;
                    v = parseFloat($row.find('.total-tax').attr('data-orig-value'));
                    if (!isNaN(v)) footer_tax += v;
                    v = parseFloat($row.find('.final-total').attr('data-orig-value'));
                    if (!isNaN(v)) footer_total_inc_tax += v;
                });

                // Use class selectors because scrollX clones the tfoot,
                // resulting in two elements sharing the same id (only the
                // cloned one is visible). Class selector updates both.
                $('.span_total_exc_tax').text(__currency_trans_from_en(footer_total_exc_tax));
                $('.span_total_discount').text(__currency_trans_from_en(footer_discount));
                $('.span_total_tax').text(__currency_trans_from_en(footer_tax));
                $('.span_total_inc_tax').text(__currency_trans_from_en(footer_total_inc_tax));
            }
        });
        
        $(document).on('change', '#sell_list_filter_location_id, #sell_list_filter_customer_id, #sell_list_filter_customer_group_id, #sell_list_filter_payment_status, #created_by, #sales_cmsn_agnt, #service_staffs, #tax_type, #station_type, #sell_list_filter_currency, #only_subscriptions, #only_takeaway',  function() {
            sale_report_table.ajax.reload();
        });

        <?php if(!empty($user_settings['rpt_sales_sale_hide_contact_id'])): ?>
            sale_report_table.column(0).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_sale_hide_customer_name'])): ?>
            sale_report_table.column(1).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_sale_hide_invoice_no'])): ?>
            sale_report_table.column(2).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_sale_hide_date'])): ?>
            sale_report_table.column(3).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_sale_hide_total_exc_tax'])): ?>
            sale_report_table.column(4).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_sale_hide_discount'])): ?>
            sale_report_table.column(5).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_sale_hide_tax'])): ?>
            sale_report_table.column(6).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_sale_hide_total_inc_tax'])): ?>
            sale_report_table.column(7).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_sale_hide_payment_method'])): ?>
            sale_report_table.column(8).visible(false);
        <?php endif; ?>
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>