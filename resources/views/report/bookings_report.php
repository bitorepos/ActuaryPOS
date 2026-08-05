
<?php $__env->startSection('title', __('lang_v1.bookings_report')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_bookings_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo e(__('lang_v1.bookings_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('br_location_id', __('purchase.business_location') . ':'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width:80%', 'id' => 'br_location_id']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('br_customer_id', __('contact.customer') . ':'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php echo Form::select('customer_id', $customers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width:80%', 'id' => 'br_customer_id']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('br_booking_status', __('restaurant.booking_status') . ':'); ?>

                        <?php echo Form::select('booking_status', $booking_statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'br_booking_status']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('br_date_filter', __('report.date_range') . ':'); ?>

                        <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'br_date_filter', 'readonly']); ?>

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
                    <?php echo app('translator')->get('lang_v1.bookings_report'); ?>
                <?php $__env->endSlot(); ?>
                <div class="text-end mb-2">
                    <button type="button" class="btn btn-primary" id="print_bookings_report">
                        <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-th-skin" id="bookings_report_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('restaurant.booking_starts'); ?></th>
                                <th><?php echo app('translator')->get('restaurant.booking_ends'); ?></th>
                                <th><?php echo app('translator')->get('contact.customer'); ?></th>
                                <th><?php echo app('translator')->get('restaurant.table'); ?></th>
                                <th><?php echo app('translator')->get('purchase.business_location'); ?></th>
                                <th><?php echo app('translator')->get('restaurant.service_staff'); ?></th>
                                <th><?php echo app('translator')->get('restaurant.booking_status'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.note'); ?></th>
                                <th><?php echo app('translator')->get('messages.action'); ?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 footer-total text-center">
                                <td colspan="9"><strong><?php echo app('translator')->get('sale.total'); ?>: <span id="footer_booking_count">0</span> <?php echo app('translator')->get('lang_v1.bookings'); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- Print section -->
<section class="print_section content" id="bookings_report_print">
</section>

<!-- Booking show modal -->
<div class="modal fade booking_show_modal" tabindex="-1" role="dialog" aria-labelledby="bookingShowModal">
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    $(document).ready(function() {
        function getBookingsReportDateRange() {
            var range = {
                start_date: '',
                end_date: ''
            };

            if ($('#br_date_filter').val() && $('input#br_date_filter').data('daterangepicker')) {
                range.start_date = $('input#br_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                range.end_date = $('input#br_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
            }

            return range;
        }

        function getBookingsReportPrintParams() {
            var dateRange = getBookingsReportDateRange();
            var params = {
                start_date: dateRange.start_date,
                end_date: dateRange.end_date,
                location_id: $('#br_location_id').val(),
                customer_id: $('#br_customer_id').val(),
                booking_status: $('#br_booking_status').val(),
                tab: 'all'
            };

            $.each(params, function(key, value) {
                if (value === null || value === '') {
                    delete params[key];
                }
            });

            return $.param(params);
        }

        // Date range picker
        if ($('#br_date_filter').length) {
            var bookingsDateRangeSettings = $('#reports_filter_date_range').length
                ? window.getAdminReportDateRangeSettings()
                : $.extend({}, dateRangeSettings);
            $('#br_date_filter').daterangepicker(bookingsDateRangeSettings, function(start, end) {
                $('#br_date_filter').val(
                    start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
                );
                bookings_report_table.ajax.reload();
            });
            var bookingsDatePicker = $('#br_date_filter').data('daterangepicker');
            if (bookingsDatePicker) {
                $('#br_date_filter').val(
                    bookingsDatePicker.startDate.format(moment_date_format) + ' ~ ' + bookingsDatePicker.endDate.format(moment_date_format)
                );
            }
            $('#br_date_filter').on('cancel.daterangepicker', function(ev, picker) {
                $('#br_date_filter').val('');
                bookings_report_table.ajax.reload();
            });
        }

        // DataTable
        var bookings_report_table = $('#bookings_report_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[0, 'desc']],
            ajax: {
                url: '/reports/bookings',
                data: function(d) {
                    var dateRange = getBookingsReportDateRange();
                    d.start_date      = dateRange.start_date;
                    d.end_date        = dateRange.end_date;
                    d.location_id     = $('#br_location_id').val();
                    d.customer_id     = $('#br_customer_id').val();
                    d.booking_status  = $('#br_booking_status').val();
                }
            },
            columns: [
                { data: 'booking_start',  name: 'bookings.booking_start' },
                { data: 'booking_end',    name: 'bookings.booking_end' },
                { data: 'customer_name',  name: 'c.name' },
                { data: 'table_name',     name: 'rt.name' },
                { data: 'location_name',  name: 'bl.name' },
                { data: 'waiter_name',    name: 'u.first_name', searchable: false },
                { data: 'booking_status', name: 'bookings.booking_status' },
                { data: 'booking_note',   name: 'bookings.booking_note' },
                { data: 'action',         name: 'action', orderable: false, searchable: false },
            ],
            fnDrawCallback: function(oSettings) {
                $('#footer_booking_count').text(oSettings.fnRecordsTotal());
            }
        });

        // Filter change handlers
        $('#br_location_id, #br_customer_id, #br_booking_status').change(function() {
            bookings_report_table.ajax.reload();
        });

        $(document).on('click', '#print_bookings_report', function(e) {
            e.preventDefault();
            window.open("<?php echo e(url('reports/bookings-print'), false); ?>?" + getBookingsReportPrintParams(), '_blank');
        });

        // Modal handler
        $(document).on('click', '.btn-modal', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var container = $(this).data('container');
            $.ajax({
                url: url,
                success: function(result) {
                    $(container).html(result).modal('show');
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>