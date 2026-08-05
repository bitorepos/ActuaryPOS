<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>

<?php $__env->startSection('title', __('lang_v1.payment_recovery_report')); ?>

<?php $__env->startSection('content'); ?>
<?php
    $currency_symbol = session('currency')['symbol'] ?? '';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('lang_v1.payment_recovery_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_payment_recovery_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => '#', 'method' => 'get', 'id' => 'payment_recovery_report_form', 'class' => 'row' ]); ?>

            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('location_id', __('lang_v1.payment_location').':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.all'), 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('payment_types', __('lang_v1.payment_method').':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fas fa-money-bill-alt"></i>
                        </span>
                        <?php echo Form::select('payment_types', $payment_types, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.all'), 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('customer_id', __('contact.customer') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('customer_id', $customers, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.all'), 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('transaction_location', __('lang_v1.transaction_location').':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <?php echo Form::select('transaction_location', $business_locations, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.all'), 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            
            
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('customer_group_filter', __('lang_v1.customer_group').':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-users"></i>
                        </span>
                        <?php echo Form::select('customer_group_filter', $customer_groups, null, ['class' => 'form-control
                        select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('created_by', __('restaurant.select_service_staff') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user-tie"></i>
                        </span>
                        <?php echo Form::select('created_by', $staff, null, ['class' => 'form-control select2',
                        'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">

                    <?php echo Form::label('prr_date_filter', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' =>
                    'form-control', 'id' => 'prr_date_filter', 'readonly']); ?>

                </div>
            </div>
            <?php echo Form::close(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#summary" data-bs-toggle="tab" role="tab" aria-expanded="true">Summary</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#detail" data-bs-toggle="tab" role="tab" aria-expanded="true">Detail</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="summary" role="tabpanel">
                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-primary payment-recovery-print-btn" data-tab="summary">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin"
                            id="payment_recovery_report_summary_table">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th class="text-right">No of Transactions</th>
                                    <th class="text-right">
                                        <?php echo app('translator')->get('sale.amount'); ?><?php if(! empty($currency_symbol)): ?> (<?php echo e($currency_symbol, false); ?>)<?php endif; ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="sell_payment_report_totals">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-right">Total: </th>
                                    <th class="text-right" id="total_transactions"></th>
                                    <th class="text-right" id="summary_total"></th>
                                </tr>
                            </tfoot>
                        </table>
</div>
                    </div>
                    <div class="tab-pane fade" id="detail" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-end mb-2">
                                    <button type="button" class="btn btn-primary payment-recovery-print-btn" data-tab="detail">
                                        <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                    </button>
                                </div>
                                
                                
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-th-skin"
 id="payment_recovery_report_table">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th><?php echo app('translator')->get('messages.action'); ?></th>
                                                <th><?php echo app('translator')->get('purchase.payment_no'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.payment_location'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.paid_on'); ?></th>
                                                <th class="text-right">
                                                    <?php echo app('translator')->get('sale.amount'); ?><?php if(! empty($currency_symbol)): ?> (<?php echo e($currency_symbol, false); ?>)<?php endif; ?>
                                                </th>
                                                <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                                                <th><?php echo app('translator')->get('sale.sale_no'); ?></th>
                                                <th><?php echo app('translator')->get('sale.sale_date'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.transaction_location'); ?></th>
                                                <th style="width:350px"><?php echo app('translator')->get('contact.customer'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.customer_group'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.payment_note'); ?></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr class="bg-gray font-17 footer-total text-right">
                                                <td colspan="2"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                                <td id="unique_ref_no_count"></td>
                                                <td colspan="2"></td>
                                                <td><span class="display_currency" id="footer_total_amount"></span></td>
                                                <td></td>
                                                
                                                <td colspan="7"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    </div>
                                
                                <br>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
<div class="modal fade view_register" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<script>
$(document).ready(function(){
    if ($('#prr_date_filter').length && $.fn.daterangepicker && $('table#payment_recovery_report_table').length) {
        var prrDateRangeSettings = window.getAdminReportDateRangeSettings();
        prrDateRangeSettings.autoUpdateInput = false;
        prrDateRangeSettings.locale = $.extend({}, prrDateRangeSettings.locale, {
            format: moment_date_format,
            cancelLabel: LANG.clear,
            applyLabel: LANG.apply,
            customRangeLabel: LANG.custom_range,
        });

        if ($('#prr_date_filter').data('daterangepicker')) {
            $('#prr_date_filter').data('daterangepicker').remove();
        }

        $('#prr_date_filter')
            .prop('readonly', false)
            .attr('autocomplete', 'off')
            .daterangepicker(prrDateRangeSettings, function(start, end) {
                $('#prr_date_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                if (typeof payment_recovery_report !== 'undefined') {
                    payment_recovery_report.ajax.reload();
                }
                if (typeof payment_recovery_report_summary === 'function') {
                    payment_recovery_report_summary();
                }
            });

        var prrDatePicker = $('#prr_date_filter').data('daterangepicker');
        if (prrDatePicker) {
            $('#prr_date_filter').val(
                prrDatePicker.startDate.format(moment_date_format) + ' ~ ' + prrDatePicker.endDate.format(moment_date_format)
            );
            if (typeof payment_recovery_report !== 'undefined') {
                payment_recovery_report.ajax.reload();
            }
            if (typeof payment_recovery_report_summary === 'function') {
                payment_recovery_report_summary();
            }
        }

        $('#prr_date_filter').off('cancel.daterangepicker').on('cancel.daterangepicker', function() {
            $(this).val('');
            if (typeof payment_recovery_report !== 'undefined') {
                payment_recovery_report.ajax.reload();
            }
            if (typeof payment_recovery_report_summary === 'function') {
                payment_recovery_report_summary();
            }
        });
    }

    function getPaymentRecoveryPrintParams(tab) {
        var params = {
            tab: tab,
            supplier_id: $('select#customer_id').val(),
            customer_id: $('select#customer_id').val(),
            location_id: $('select#location_id').val(),
            transaction_location: $('select#transaction_location').val(),
            payment_types: $('select#payment_types').val(),
            customer_group_id: $('select#customer_group_filter').val(),
            created_by: $('#payment_recovery_report_form select#created_by').val()
        };

        if ($('input#prr_date_filter').val() && $('input#prr_date_filter').data('daterangepicker')) {
            params.start_date = $('input#prr_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
            params.end_date = $('input#prr_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
        }

        return $.param(params);
    }

    $(document).on('click', '.payment-recovery-print-btn', function() {
        var query = getPaymentRecoveryPrintParams($(this).data('tab'));
        window.open("<?php echo e(url('reports/payment-recovery-report-print'), false); ?>?" + query, '_blank');
    });

    <?php if(!empty($user_settings['rpt_sales_precov_hide_payment_no'])): ?>
        payment_recovery_report.column(2).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_precov_hide_payment_location'])): ?>
        payment_recovery_report.column(3).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_precov_hide_paid_on'])): ?>
        payment_recovery_report.column(4).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_precov_hide_amount'])): ?>
        payment_recovery_report.column(5).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_precov_hide_payment_method'])): ?>
        payment_recovery_report.column(6).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_precov_hide_sale_no'])): ?>
        payment_recovery_report.column(7).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_precov_hide_sale_date'])): ?>
        payment_recovery_report.column(8).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_precov_hide_transaction_location'])): ?>
        payment_recovery_report.column(9).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_precov_hide_customer'])): ?>
        payment_recovery_report.column(10).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_precov_hide_customer_group'])): ?>
        payment_recovery_report.column(11).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_precov_hide_added_by'])): ?>
        payment_recovery_report.column(12).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_precov_hide_payment_note'])): ?>
        payment_recovery_report.column(13).visible(false);
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>