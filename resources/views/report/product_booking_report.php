
<?php $__env->startSection('title', __('lang_v1.product_booking_report')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo e(__('lang_v1.product_booking_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_product_booking_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('location_id', __('purchase.business_location') . ':'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width:80%', 'id' => 'pbr_location_id']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('customer_id', __('contact.customer') . ':'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php echo Form::select('customer_id', $customers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width:80%', 'id' => 'pbr_customer_id']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('product_id', __('sale.product') . ':'); ?>

                        <?php echo Form::select('product_id', $products, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width:100%', 'id' => 'pbr_product_id']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('booking_status', __('lang_v1.booking_status') . ':'); ?>

                        <?php echo Form::select('booking_status', ['' => __('messages.all'), 'upcoming' => __('lang_v1.upcoming'), 'in_progress' => __('lang_v1.in_progress'), 'completed' => __('lang_v1.completed')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'pbr_booking_status']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('pbr_date_filter', __('report.date_range') . ':'); ?>

                        <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'pbr_date_filter', 'readonly']); ?>

                    </div>
                </div>
            </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                <?php $__env->slot('title'); ?>
                    <?php echo app('translator')->get('lang_v1.product_booking_report'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.hourly_bookings'); ?>)</small>
                <?php $__env->endSlot(); ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-th-skin" id="product_booking_report_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('lang_v1.booking_date'); ?></th>
                                <th><?php echo app('translator')->get('sale.product'); ?></th>
                                <th><?php echo app('translator')->get('contact.customer'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.start_time'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.end_time'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.duration'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.booking_status'); ?></th>
                                <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                <th><?php echo app('translator')->get('purchase.business_location'); ?></th>
                                <th><?php echo app('translator')->get('sale.unit_price'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.sold_on'); ?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 footer-total text-center">
                                <td colspan="11"><strong><?php echo app('translator')->get('sale.total'); ?>: <span id="footer_booking_count">0</span> <?php echo app('translator')->get('lang_v1.bookings'); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row no-print">
        <div class="col-sm-12">
            <button type="button" class="btn btn-primary float-end" 
            aria-label="Print" onclick="window.print();"
            ><i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4</button>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- Print section -->
<section class="print_section content" id="product_booking_report_print">
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    $(document).ready(function() {
        // Date range picker
        if ($('#pbr_date_filter').length) {
            var productBookingDateRangeSettings = window.getAdminReportDateRangeSettings();
            productBookingDateRangeSettings.autoUpdateInput = false;
            productBookingDateRangeSettings.locale = $.extend({}, productBookingDateRangeSettings.locale, {
                format: moment_date_format,
                cancelLabel: LANG.clear,
                applyLabel: LANG.apply,
                customRangeLabel: LANG.custom_range,
            });
            $('#pbr_date_filter').daterangepicker(productBookingDateRangeSettings, function(start, end) {
                $('#pbr_date_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                product_booking_report_table.ajax.reload();
            });
            var productBookingDatePicker = $('#pbr_date_filter').data('daterangepicker');
            if (productBookingDatePicker) {
                $('#pbr_date_filter').val(
                    productBookingDatePicker.startDate.format(moment_date_format) + ' ~ ' + productBookingDatePicker.endDate.format(moment_date_format)
                );
            }
            $('#pbr_date_filter').on('cancel.daterangepicker', function(ev, picker) {
                $('#pbr_date_filter').val('');
                product_booking_report_table.ajax.reload();
            });
        }

        // Initialize DataTable
        var product_booking_report_table = $('#product_booking_report_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[0, 'desc']],
            ajax: {
                url: '/reports/product-booking-report',
                data: function(d) {
                    var start = '';
                    var end = '';

                    if ($('#pbr_date_filter').val()) {
                        start = $('input#pbr_date_filter')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#pbr_date_filter')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }

                    d.start_date = start;
                    d.end_date = end;
                    d.location_id = $('#pbr_location_id').val();
                    d.customer_id = $('#pbr_customer_id').val();
                    d.product_id = $('#pbr_product_id').val();
                    d.booking_status = $('#pbr_booking_status').val();
                }
            },
            columns: [
                { data: 'booking_date', name: 'product_bookings.date' },
                { data: 'product_name', name: 'p.name' },
                { data: 'customer_name', name: 'c.name' },
                { data: 'start_time', name: 'product_bookings.start_time' },
                { data: 'end_time', name: 'product_bookings.end_time' },
                { data: 'duration', name: 'duration', searchable: false },
                { data: 'booking_status', name: 'booking_status', searchable: false },
                { data: 'invoice_no', name: 't.invoice_no' },
                { data: 'location_name', name: 'bl.name' },
                { data: 'unit_price_inc_tax', name: 'tsl.unit_price_inc_tax' },
                { data: 'transaction_date', name: 't.transaction_date' },
            ],
            fnDrawCallback: function(oSettings) {
                $('#footer_booking_count').text(oSettings.fnRecordsTotal());
                __currency_convert_recursively($('#product_booking_report_table'));
            }
        });

        // Filter change handlers
        $('#pbr_location_id, #pbr_customer_id, #pbr_product_id, #pbr_booking_status').change(function() {
            product_booking_report_table.ajax.reload();
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>