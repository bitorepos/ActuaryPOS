<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>

<?php $__env->startSection('title', __('lang_v1.sell_payment_report')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('lang_v1.sell_payment_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_sale_payment_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-md-12">
            <input type="hidden" id="business_location" value="">
            <input type="hidden" id="date_range" value="">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => '#', 'method' => 'get', 'id' => 'sell_payment_report_form', 'class' => 'row', ]); ?>

            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('location_id', __('lang_v1.payment_location').':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.all'), 'required', 'style' => 'width:80%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('payment_types', __('lang_v1.payment_method').':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-money-bill-alt"></i>
                        </span>
                        <?php echo Form::select('payment_types', $payment_types, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.all'), 'required', 'style' => 'width:80%']); ?>

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
                        <?php echo Form::select('customer_id', $customers, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.all'), 'required', 'style' => 'width:80%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('transaction_location', __('lang_v1.transaction_location').':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <?php echo Form::select('transaction_location', $business_locations, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.all'), 'required', 'style' => 'width:80%']); ?>

                    </div>
                </div>
            </div>
            
            
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('customer_group_filter', __('lang_v1.customer_group').':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-users"></i>
                        </span>
                        <?php echo Form::select('customer_group_filter', $customer_groups, null, ['class' => 'form-control
                        select2', 'style' => 'width:80%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">

                    <?php echo Form::label('spr_date_filter', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' =>
                    'form-control', 'id' => 'spr_date_filter', 'readonly']); ?>

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
                        <a class="nav-link active pb-2 pe-2 ps-2" href="#summary" data-bs-toggle="tab" role="tab" aria-expanded="true">Summary</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#customer_summary" data-bs-toggle="tab" role="tab" aria-expanded="true">Customer Summary</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#detail" data-bs-toggle="tab" role="tab" aria-expanded="true">Detail</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="summary" role="tabpanel">
                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-primary sell-payment-print-btn" data-tab="summary">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin"
                            id="sell_payment_report_summary_table" style="width:100% !important;">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>No of Transactions</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="sell_payment_report_totals">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-right">Total: </td>
                                    <th id="total_transactions"></th>
                                    <th id="summary_total"></th>
                                </tr>
                            </tfoot>
                        </table>
</div>
                    </div>
                    <div class="tab-pane fade" id="customer_summary" role="tabpanel">
                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-primary sell-payment-print-btn" data-tab="customer_summary">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin" id="sell_payment_report_customer_summary_table" style="width:100% !important;">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('contact.customer'); ?></th>
                                        <th>No of Transactions</th>
                                        <th><?php echo app('translator')->get('sale.amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-right">Total: </th>
                                        <th id="customer_total_transactions"></th>
                                        <th id="customer_summary_total"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="detail" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-end mb-2">
                                    <button type="button" class="btn btn-primary sell-payment-print-btn" data-tab="detail">
                                        <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                    </button>
                                </div>
                                
                                
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-th-skin"
 style="width:100% !important;"
 id="sell_payment_report_table">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th><?php echo app('translator')->get('messages.action'); ?></th>
                                                <th><?php echo app('translator')->get('purchase.payment_no'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.payment_location'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.paid_on'); ?></th>
                                                <th><?php echo app('translator')->get('sale.amount'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                                                <th><?php echo app('translator')->get('sale.sale_no'); ?></th>
                                                <th><?php echo app('translator')->get('sale.sale_date'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.transaction_location'); ?></th>
                                                <th style="width:350px"><?php echo app('translator')->get('contact.customer'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.customer_group'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.payment_note'); ?></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr class="bg-gray font-17 footer-total text-right">
                                                <td colspan="2"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                                <td id="unique_ref_no_count"></td>
                                                <td colspan="2"></td>
                                                <td><span class="display_currency" id="footer_total_amount"
                                                        data-currency_symbol="true"></span></td>
                                                <td></td>
                                                
                                                <td colspan="6"></td>
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
    if ($('#spr_date_filter').length && $.fn.daterangepicker) {
        var sprDateRangeSettings = window.getAdminReportDateRangeSettings();
        sprDateRangeSettings.autoUpdateInput = false;
        sprDateRangeSettings.locale = $.extend({}, sprDateRangeSettings.locale, {
            format: moment_date_format,
            cancelLabel: LANG.clear,
            applyLabel: LANG.apply,
            customRangeLabel: LANG.custom_range,
        });

        if ($('#spr_date_filter').data('daterangepicker')) {
            $('#spr_date_filter').data('daterangepicker').remove();
        }

        $('#spr_date_filter')
            .prop('readonly', false)
            .attr('autocomplete', 'off')
            .daterangepicker(sprDateRangeSettings, function(start, end) {
                $('#spr_date_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                if (typeof sell_payment_report !== 'undefined') {
                    sell_payment_report.ajax.reload();
                }
                if (typeof sell_payment_report_summary === 'function') {
                    sell_payment_report_summary();
                }
                if (typeof sell_payment_report_customer_summary === 'function') {
                    sell_payment_report_customer_summary();
                }
            });

        var sprDatePicker = $('#spr_date_filter').data('daterangepicker');
        if (sprDatePicker) {
            $('#spr_date_filter').val(
                sprDatePicker.startDate.format(moment_date_format) + ' ~ ' + sprDatePicker.endDate.format(moment_date_format)
            );
            if (typeof sell_payment_report !== 'undefined') {
                sell_payment_report.ajax.reload();
            }
            if (typeof sell_payment_report_summary === 'function') {
                sell_payment_report_summary();
            }
            if (typeof sell_payment_report_customer_summary === 'function') {
                sell_payment_report_customer_summary();
            }
        }

        $('#spr_date_filter').off('cancel.daterangepicker').on('cancel.daterangepicker', function() {
            $(this).val('');
            if (typeof sell_payment_report !== 'undefined') {
                sell_payment_report.ajax.reload();
            }
            if (typeof sell_payment_report_summary === 'function') {
                sell_payment_report_summary();
            }
            if (typeof sell_payment_report_customer_summary === 'function') {
                sell_payment_report_customer_summary();
            }
        });
    }

    function getSellPaymentPrintParams(tab) {
        var params = {
            tab: tab,
            supplier_id: $('select#customer_id').val(),
            customer_id: $('select#customer_id').val(),
            location_id: $('select#location_id').val(),
            transaction_location: $('select#transaction_location').val(),
            payment_types: $('select#payment_types').val(),
            customer_group_id: $('select#customer_group_filter').val()
        };

        if ($('input#spr_date_filter').val() && $('input#spr_date_filter').data('daterangepicker')) {
            params.start_date = $('input#spr_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
            params.end_date = $('input#spr_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
        }

        return $.param(params);
    }

    $(document).on('click', '.sell-payment-print-btn', function() {
        var query = getSellPaymentPrintParams($(this).data('tab'));
        window.open("<?php echo e(url('reports/sell-payment-report-print'), false); ?>?" + query, '_blank');
    });

    <?php if(!empty($user_settings['rpt_sales_spay_hide_payment_no'])): ?>
        sell_payment_report.column(2).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_spay_hide_payment_location'])): ?>
        sell_payment_report.column(3).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_spay_hide_paid_on'])): ?>
        sell_payment_report.column(4).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_spay_hide_amount'])): ?>
        sell_payment_report.column(5).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_spay_hide_payment_method'])): ?>
        sell_payment_report.column(6).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_spay_hide_sale_no'])): ?>
        sell_payment_report.column(7).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_spay_hide_sale_date'])): ?>
        sell_payment_report.column(8).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_spay_hide_transaction_location'])): ?>
        sell_payment_report.column(9).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_spay_hide_customer'])): ?>
        sell_payment_report.column(10).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_spay_hide_customer_group'])): ?>
        sell_payment_report.column(11).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_spay_hide_payment_note'])): ?>
        sell_payment_report.column(12).visible(false);
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>