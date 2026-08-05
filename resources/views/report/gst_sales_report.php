<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>

<?php $__env->startSection('title', __('lang_v1.gst_sales_report')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo e(__('lang_v1.gst_sales_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('gst_report_customer_filter', __('contact.customer') . ':'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php echo Form::select('customer_id', $customers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'gst_report_customer_filter']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('gst_sr_date_filter', __('report.date_range') . ':'); ?>

                        <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_gst_sales_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'gst_sr_date_filter', 'readonly']); ?>

                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" 
                id="gst_sales_report" style="width: 100%;">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                            <th><?php echo app('translator')->get('sale.customer_name'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.gstin_of_cutomer'); ?><br><small><?php echo e(__('contact.tax_no'), false); ?></small></th>
                            <th><?php echo app('translator')->get('lang_v1.invoice_date'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.hsn_code'); ?> <br><small><?php echo e(__( 'category.code' ), false); ?></small></th>
                            <th>GST%</th>
                            <th><?php echo app('translator')->get('sale.qty'); ?></th>
                            <th><?php echo app('translator')->get('sale.unit_price'); ?></th>
                            <th><?php echo app('translator')->get('sale.discount'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.taxable_value'); ?></th>
                            <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th>
                                    <?php echo e($tax['name'], false); ?>

                                </th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <th><?php echo app('translator')->get('sale.total'); ?></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-gray font-17 footer-total text-center">
                            <td colspan="9"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                            <td class="total_taxable_value"></td>
                            <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td class="tax_<?php echo e($tax['id'], false); ?>_total">
                                </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <td class="line_total"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <?php echo $__env->make('report.partials.reports_date_range_setting_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script type="text/javascript">
        $(document).ready( function(){
            var gstDateRangeSettings = window.getAdminReportDateRangeSettings();
            $('#gst_sr_date_filter').daterangepicker(
                gstDateRangeSettings,
                function(start, end) {
                    $('#gst_sr_date_filter').val(
                        start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
                    );
                    gst_sales_report.ajax.reload();
                }
            );
            var gstDatePicker = $('#gst_sr_date_filter').data('daterangepicker');
            if (gstDatePicker) {
                $('#gst_sr_date_filter').val(
                    gstDatePicker.startDate.format(moment_date_format) + ' ~ ' + gstDatePicker.endDate.format(moment_date_format)
                );
            }
            $('#gst_sr_date_filter').on('cancel.daterangepicker', function(ev, picker) {
                $('#gst_sr_date_filter').val('');
                gst_sales_report.ajax.reload();
            });

            $('#gst_report_customer_filter').change(function() {
                gst_sales_report.ajax.reload();
            });
            gst_sales_report = $('table#gst_sales_report').DataTable({
                processing: true,
                serverSide: true,
                aaSorting: [[3, 'desc']],
                scrollY: "75vh",
                scrollX:        true,
                scrollCollapse: true,
                ajax: {
                    url: '/reports/gst-sales-report',
                    data: function(d) {
                        var start = '';
                        var end = '';

                        if ($('#gst_sr_date_filter').val()) {
                            start = $('input#gst_sr_date_filter')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');

                            end = $('input#gst_sr_date_filter')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                        }
                        d.start_date = start;
                        d.end_date = end;
                        d.customer_id = $('select#gst_report_customer_filter').val();
                    },
                },
                columns: [
                    { data: 'invoice_no', name: 't.invoice_no' },
                    { data: 'customer', name: 'c.name' },
                    { data: 'tax_number', name: 'c.tax_number' },
                    { data: 'transaction_date', name: 't.transaction_date' },
                    { data: 'short_code', name: 'cat.short_code' },
                    { data: 'tax_percent', name: 'tr.amount' },
                    { data: 'sell_qty', name: 'transaction_sell_lines.quantity' },
                    { data: 'unit_price', name: 'transaction_sell_lines.unit_price_before_discount' },
                    { data: 'discount_amount', name: 'transaction_sell_lines.line_discount_amount' },
                    { data: 'taxable_value', name: 'taxable_value', searchable: false },

                    <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        { data: "tax_<?php echo e($tax['id'], false); ?>", searchable: false, orderable: false },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    { data: 'line_total', name: 'line_total', searchable: false },
                ],
                "footerCallback": function ( row, data, start, end, display ) {
                    var total_taxable_value = 0;
                    var line_total = 0;

                    <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        var tax_<?php echo e($tax['id'], false); ?>_total = 0;
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    for (var r in data){
                        total_taxable_value += $(data[r].taxable_value).data('orig-value') ? 
                        parseFloat($(data[r].taxable_value).data('orig-value')) : 0;

                        line_total += $(data[r].line_total).data('orig-value') ? 
                        parseFloat($(data[r].line_total).data('orig-value')) : 0;

                        <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            tax_<?php echo e($tax['id'], false); ?>_total += $(data[r].tax_<?php echo e($tax['id'], false); ?>).data('orig-value') ? 
                            parseFloat($(data[r].tax_<?php echo e($tax['id'], false); ?>).data('orig-value')) : 0;
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    }

                    <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        if (tax_<?php echo e($tax['id'], false); ?>_total !== 0) {
                            $('.tax_<?php echo e($tax["id"], false); ?>_total').html(__currency_trans_from_en(tax_<?php echo e($tax['id'], false); ?>_total, false));
                        }
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    $('.total_taxable_value').html(__currency_trans_from_en(total_taxable_value, false));
                    $('.line_total').html(__currency_trans_from_en(line_total, false));
                },
            });
        })

        <?php if(!empty($user_settings['rpt_sales_gstsale_hide_invoice_no'])): ?>
            gst_sales_report.column(0).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_gstsale_hide_customer_name'])): ?>
            gst_sales_report.column(1).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_gstsale_hide_tax_no'])): ?>
            gst_sales_report.column(2).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_gstsale_hide_invoice_date'])): ?>
            gst_sales_report.column(3).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_gstsale_hide_hsn_code'])): ?>
            gst_sales_report.column(4).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_gstsale_hide_gst_pct'])): ?>
            gst_sales_report.column(5).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_gstsale_hide_qty'])): ?>
            gst_sales_report.column(6).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_gstsale_hide_unit_price'])): ?>
            gst_sales_report.column(7).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_gstsale_hide_discount'])): ?>
            gst_sales_report.column(8).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_gstsale_hide_taxable_value'])): ?>
            gst_sales_report.column(9).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_sales_gstsale_hide_total'])): ?>
            gst_sales_report.column('line_total:name').visible(false);
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>