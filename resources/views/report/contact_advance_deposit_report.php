
<?php $__env->startSection('title', __('lang_v1.contact_advance_deposit_report')); ?>

<?php $__env->startSection('content'); ?>
<?php
    $currency_symbol = session('currency')['symbol'] ?? '';
?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_contact_advance_deposit_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
    <h1><?php echo e(__('lang_v1.contact_advance_deposit_report'), false); ?></h1>
</section>

<section class="content no-print">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('cad_location_id', __('purchase.business_location') . ':'); ?>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-map-marker"></i>
                                </span>
                                <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'cad_location_id']); ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('cad_contact_type', __('contact.contact_type') . ':'); ?>

                            <?php echo Form::select('contact_type', $types, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'cad_contact_type']); ?>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('cad_contact_id', __('report.contact') . ':'); ?>

                            <?php echo Form::select('contact_id', $contact_dropdown, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'cad_contact_id', 'placeholder' => __('lang_v1.all')]); ?>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('cad_advance_deposit_type', __('lang_v1.advance_deposit_type') . ':'); ?>

                            <?php echo Form::select('advance_deposit_type', $advance_deposit_types, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'cad_advance_deposit_type']); ?>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('cad_payment_status', __('purchase.payment_status') . ':'); ?>

                            <?php echo Form::select('payment_status', $payment_statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'cad_payment_status']); ?>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('cad_date_filter', __('report.date_range') . ':'); ?>

                            <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'cad_date_filter', 'readonly']); ?>

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
                    <?php echo app('translator')->get('lang_v1.contact_advance_deposit_report'); ?>
                <?php $__env->endSlot(); ?>
                <div class="text-end mb-2">
                    <button type="button" class="btn btn-primary" id="print_contact_advance_deposit_report">
                        <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-th-skin" id="contact_advance_deposit_report_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('lang_v1.contact_id'); ?></th>
                                <th><?php echo app('translator')->get('report.contact'); ?></th>
                                <th><?php echo app('translator')->get('contact.contact_type'); ?></th>
                                <th><?php echo app('translator')->get('purchase.business_location'); ?></th>
                                <th><?php echo app('translator')->get('messages.date'); ?></th>
                                <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.advance_deposit_type'); ?></th>
                                <th><?php echo app('translator')->get('purchase.payment_method'); ?></th>
                                <th><?php echo app('translator')->get('purchase.payment_status'); ?></th>
                                <th class="text-right"><?php echo app('translator')->get('lang_v1.deposit_amount'); ?><?php echo e(! empty($currency_symbol) ? ' ('.$currency_symbol.')' : '', false); ?></th>
                                <th class="text-right"><?php echo app('translator')->get('lang_v1.adjusted_amount'); ?><?php echo e(! empty($currency_symbol) ? ' ('.$currency_symbol.')' : '', false); ?></th>
                                <th class="text-right"><?php echo app('translator')->get('lang_v1.advance_deposit_balance'); ?><?php echo e(! empty($currency_symbol) ? ' ('.$currency_symbol.')' : '', false); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 footer-total text-center">
                                <td colspan="9"><strong><?php echo app('translator')->get('sale.total'); ?>: <span id="footer_total_records">0</span> <?php echo app('translator')->get('lang_v1.records'); ?></strong></td>
                                <td class="text-right"><span id="footer_total_deposit_amount"></span></td>
                                <td class="text-right"><span id="footer_total_adjusted_amount"></span></td>
                                <td class="text-right"><span id="footer_total_balance"></span></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    $(document).ready(function() {
        function getContactAdvanceDepositDateRange() {
            var range = {
                start_date: '',
                end_date: ''
            };

            if ($('#cad_date_filter').val() && $('input#cad_date_filter').data('daterangepicker')) {
                range.start_date = $('input#cad_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                range.end_date = $('input#cad_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
            }

            return range;
        }

        function getContactAdvanceDepositPrintParams() {
            var dateRange = getContactAdvanceDepositDateRange();
            var params = {
                start_date: dateRange.start_date,
                end_date: dateRange.end_date,
                location_id: $('#cad_location_id').val(),
                contact_type: $('#cad_contact_type').val(),
                contact_id: $('#cad_contact_id').val(),
                advance_deposit_type: $('#cad_advance_deposit_type').val(),
                payment_status: $('#cad_payment_status').val()
            };

            $.each(params, function(key, value) {
                if (value === null || value === '') {
                    delete params[key];
                }
            });

            return $.param(params);
        }

        if ($('#cad_date_filter').length) {
            var contactAdvanceDepositDateRangeSettings = $('#reports_filter_date_range').length
                ? window.getAdminReportDateRangeSettings()
                : $.extend({}, dateRangeSettings);
            $('#cad_date_filter').daterangepicker(contactAdvanceDepositDateRangeSettings, function(start, end) {
                $('#cad_date_filter').val(
                    start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
                );
                contact_advance_deposit_report_table.ajax.reload();
            });
            var contactAdvanceDepositDatePicker = $('#cad_date_filter').data('daterangepicker');
            if (contactAdvanceDepositDatePicker) {
                $('#cad_date_filter').val(
                    contactAdvanceDepositDatePicker.startDate.format(moment_date_format) + ' ~ ' + contactAdvanceDepositDatePicker.endDate.format(moment_date_format)
                );
            }
            $('#cad_date_filter').on('cancel.daterangepicker', function(ev, picker) {
                $('#cad_date_filter').val('');
                contact_advance_deposit_report_table.ajax.reload();
            });
        }

        var contact_advance_deposit_report_table = $('#contact_advance_deposit_report_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[4, 'desc']],
            ajax: {
                url: '/reports/contact-advance-deposit-report',
                data: function(d) {
                    var dateRange = getContactAdvanceDepositDateRange();
                    d.start_date = dateRange.start_date;
                    d.end_date = dateRange.end_date;
                    d.location_id = $('#cad_location_id').val();
                    d.contact_type = $('#cad_contact_type').val();
                    d.contact_id = $('#cad_contact_id').val();
                    d.advance_deposit_type = $('#cad_advance_deposit_type').val();
                    d.payment_status = $('#cad_payment_status').val();
                }
            },
            columns: [
                { data: 'contact_id', name: 'c.contact_id' },
                { data: 'contact_name', name: 'c.name' },
                { data: 'contact_type', name: 'c.type' },
                { data: 'location_name', name: 'bl.name' },
                { data: 'transaction_date', name: 'transactions.transaction_date' },
                { data: 'ref_no', name: 'transactions.ref_no' },
                { data: 'advance_deposit_type', name: 'transactions.sub_type' },
                { data: 'payment_method', name: 'transactions.sub_status' },
                { data: 'payment_status', name: 'transactions.payment_status' },
                { data: 'deposit_amount', name: 'transactions.final_total', searchable: false, className: 'text-right' },
                { data: 'adjusted_amount', name: 'adjusted_amount', searchable: false, className: 'text-right' },
                { data: 'balance', name: 'balance', searchable: false, className: 'text-right' },
                { data: 'added_by', name: 'added_by' }
            ],
            fnDrawCallback: function() {
                var json = contact_advance_deposit_report_table.ajax.json() || {};
                var totals = json.aggregates || {};

                $('#footer_total_records').text(totals.total_rows || 0);
                $('#footer_total_deposit_amount').text(__currency_trans_from_en(parseFloat(totals.total_deposit_amount || 0), false));
                $('#footer_total_adjusted_amount').text(__currency_trans_from_en(parseFloat(totals.total_adjusted_amount || 0), false));
                $('#footer_total_balance').text(__currency_trans_from_en(parseFloat(totals.total_balance || 0), false));
            }
        });

        $('#cad_location_id, #cad_contact_type, #cad_contact_id, #cad_advance_deposit_type, #cad_payment_status').change(function() {
            contact_advance_deposit_report_table.ajax.reload();
        });

        $(document).on('click', '#print_contact_advance_deposit_report', function(e) {
            e.preventDefault();
            window.open("<?php echo e(url('reports/contact-advance-deposit-report-print'), false); ?>?" + getContactAdvanceDepositPrintParams(), '_blank');
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>