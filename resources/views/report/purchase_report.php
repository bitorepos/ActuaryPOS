
<?php $__env->startSection('title', 'Report 606 (' . __('lang_v1.purchase') . ')'); ?>
<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_purchase_606_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>Report 606 (<?php echo app('translator')->get('lang_v1.purchase'); ?>)
    </h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('purchase_list_filter_location_id',  __('purchase.business_location') . ':'); ?>

                <?php echo Form::select('purchase_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('purchase_list_filter_supplier_id',  __('purchase.supplier') . ':'); ?>

                <?php echo Form::select('purchase_list_filter_supplier_id', $suppliers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('purchase_list_filter_status',  __('purchase.purchase_status') . ':'); ?>

                <?php echo Form::select('purchase_list_filter_status', $orderStatuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('purchase_list_filter_payment_status',  __('purchase.payment_status') . ':'); ?>

                <?php echo Form::select('purchase_list_filter_payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial'), 'overdue' => __('lang_v1.overdue')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('purchase_list_filter_date_range', __('report.date_range') . ':'); ?>

                <?php echo Form::text('purchase_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <div class="row mb-3">
        <div class="col-sm-12">
            <button type="button" class="btn btn-primary float-end open-purchase-report-print">
                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
            </button>
        </div>
    </div>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="table-responsive">
    <table class="table table-bordered table-striped ajax_view table-th-skin" id="purchase_report_table">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('lang_v1.contact_id'); ?></th>
                <th style="width:350px"><?php echo app('translator')->get('purchase.supplier'); ?></th>
                <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                <th><?php echo app('translator')->get('purchase.purchase_date'); ?> (<?php echo app('translator')->get('lang_v1.year_month'); ?>)</th>
                <th><?php echo app('translator')->get('purchase.purchase_date'); ?> (<?php echo app('translator')->get('lang_v1.day'); ?>)</th>
                <th><?php echo app('translator')->get('lang_v1.payment_date'); ?> (<?php echo app('translator')->get('lang_v1.year_month'); ?>)</th>
                <th><?php echo app('translator')->get('lang_v1.payment_date'); ?> (<?php echo app('translator')->get('lang_v1.day'); ?>)</th>
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
                <th></th>
                <th></th>
                <th></th>
                <th>Total: </th>
                <th><span id="span_total_exc_tax">0</span></th>
                <th><span id="span_total_discount">0</span></th>
                <th><span id="span_total_tax">0</span></th>
                <th><span id="span_total_inc_tax">0</span></th>
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
        //Purchase report table
        purchase_report_table = $('#purchase_report_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/reports/purchase-report',
                data: function(d) {
                    if ($('#purchase_list_filter_location_id').length) {
                        d.location_id = $('#purchase_list_filter_location_id').val();
                    }
                    if ($('#purchase_list_filter_supplier_id').length) {
                        d.supplier_id = $('#purchase_list_filter_supplier_id').val();
                    }
                    if ($('#purchase_list_filter_payment_status').length) {
                        d.payment_status = $('#purchase_list_filter_payment_status').val();
                    }
                    if ($('#purchase_list_filter_status').length) {
                        d.status = $('#purchase_list_filter_status').val();
                    }

                    var start = '';
                    var end = '';
                    if ($('#purchase_list_filter_date_range').val()) {
                        start = $('input#purchase_list_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#purchase_list_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;

                    d = __datatable_ajax_callback(d);
                },
            },
            columns: [
                { data: 'contact_id', name: 'contacts.contact_id' },
                { data: 'name', name: 'contacts.name' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'purchase_year_month', name: 'transaction_date' },
                { data: 'purchase_day', name: 'transaction_date' },
                { data: 'payment_year_month', searching: false },
                { data: 'payment_day', searching: false },
                { data: 'total_before_tax', name: 'total_before_tax' },
                { data: 'discount_amount', name: 'discount_amount' },
                { data: 'tax_amount', name: 'tax_amount' },
                { data: 'final_total', name: 'final_total' },
                { data: 'payment_method', name: 'payment_method' },
            ],
            fnDrawCallback: function(oSettings) {
                $('#span_total_exc_tax').text(__currency_trans_from_en(sum_table_col($('#purchase_report_table'), 'total_before_tax')));
                $('#span_total_discount').text(__currency_trans_from_en(sum_table_col($('#purchase_report_table'), 'total-discount')));
                $('#span_total_tax').text(__currency_trans_from_en(sum_table_col($('#purchase_report_table'), 'tax_amount')));
                $('#span_total_inc_tax').text(__currency_trans_from_en(sum_table_col($('#purchase_report_table'), 'final_total')));
                __currency_convert_recursively($('#purchase_report_table'));
            }
        });

        $(document).on(
            'change',
            '#purchase_list_filter_location_id, \
                        #purchase_list_filter_supplier_id, #purchase_list_filter_payment_status,\
                         #purchase_list_filter_status',
            function() {
                purchase_report_table.ajax.reload();
            }
        );
        var purchaseReportDateRangeSettings = $('#reports_filter_date_range').length
            ? window.getAdminReportDateRangeSettings()
            : $.extend({}, dateRangeSettings);

        $('#purchase_list_filter_date_range').daterangepicker(
            purchaseReportDateRangeSettings,
            function (start, end) {
                $('#purchase_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
               purchase_report_table.ajax.reload();
            }
        );
        var purchaseReportDatePicker = $('#purchase_list_filter_date_range').data('daterangepicker');
        if (purchaseReportDatePicker) {
            $('#purchase_list_filter_date_range').val(
                purchaseReportDatePicker.startDate.format(moment_date_format) + ' ~ ' + purchaseReportDatePicker.endDate.format(moment_date_format)
            );
            purchase_report_table.ajax.reload();
        }
        $('#purchase_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#purchase_list_filter_date_range').val('');
            purchase_report_table.ajax.reload();
        });

        function getPurchaseReportPrintParams() {
            var params = {
                location_id: $('#purchase_list_filter_location_id').val(),
                supplier_id: $('#purchase_list_filter_supplier_id').val(),
                payment_status: $('#purchase_list_filter_payment_status').val(),
                status: $('#purchase_list_filter_status').val()
            };

            if ($('#purchase_list_filter_date_range').val() && $('#purchase_list_filter_date_range').data('daterangepicker')) {
                params.start_date = $('#purchase_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                params.end_date = $('#purchase_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
            }

            return $.param(params);
        }

        $(document).on('click', '.open-purchase-report-print', function(e) {
            e.preventDefault();
            window.open("<?php echo e(url('reports/purchase-report-print'), false); ?>?" + getPurchaseReportPrintParams(), '_blank');
        });

        <?php if(!empty($user_settings['rpt_purch_purch_hide_contact_id'])): ?>
            purchase_report_table.column(0).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_purch_purch_hide_supplier'])): ?>
            purchase_report_table.column(1).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_purch_purch_hide_ref_no'])): ?>
            purchase_report_table.column(2).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_purch_purch_hide_purchase_date_ym'])): ?>
            purchase_report_table.column(3).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_purch_purch_hide_purchase_date_d'])): ?>
            purchase_report_table.column(4).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_purch_purch_hide_payment_date_ym'])): ?>
            purchase_report_table.column(5).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_purch_purch_hide_payment_date_d'])): ?>
            purchase_report_table.column(6).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_purch_purch_hide_total_exc_tax'])): ?>
            purchase_report_table.column(7).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_purch_purch_hide_discount'])): ?>
            purchase_report_table.column(8).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_purch_purch_hide_tax'])): ?>
            purchase_report_table.column(9).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_purch_purch_hide_total_inc_tax'])): ?>
            purchase_report_table.column(10).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_purch_purch_hide_payment_method'])): ?>
            purchase_report_table.column(11).visible(false);
        <?php endif; ?>
    });
</script>
	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>