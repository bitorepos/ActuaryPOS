
<?php $__env->startSection('title', __('lang_v1.purchase_payment_report')); ?>
<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_purchase_payment_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('lang_v1.purchase_payment_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => '#', 'method' => 'get', 'id' => 'purchase_payment_report_form', 'class' => 'row', ]); ?>

            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('location_id', __('lang_v1.payment_location').':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.all'), 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('supplier_id', __('purchase.supplier') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('supplier_id', $suppliers, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.all'), 'required', 'style' => 'width:100%']); ?>

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
                        'placeholder' => __('messages.all'), 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group mb-2">

                    <?php echo Form::label('ppr_date_filter', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' =>
                    'form-control', 'id' => 'ppr_date_filter', 'readonly']); ?>

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
                        'placeholder' => __('messages.all'), 'required', 'style' => 'width:100%']); ?>

                    </div>
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
                        <a class="nav-link pb-2 pe-2 ps-2" href="#supplier_summary" data-bs-toggle="tab" role="tab" aria-expanded="true">Supplier Summary</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#detail" data-bs-toggle="tab" role="tab" aria-expanded="true">Detail</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="summary" role="tabpanel">
                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-primary purchase-payment-print-btn" data-tab="summary">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="purchase_payment_report_summary_table" style="width:100% !important;">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>No of Transactions</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-right">Total: </th>
                                    <th id="total_transactions"></th>
                                    <th id="summary_total"></th>
                                </tr>
                            </tfoot>
                        </table>
</div>
                    </div>
                    <div class="tab-pane fade" id="supplier_summary" role="tabpanel">
                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-primary purchase-payment-print-btn" data-tab="supplier_summary">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin" id="purchase_payment_report_supplier_summary_table" style="width:100% !important;">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('purchase.supplier'); ?></th>
                                        <th>No of Transactions</th>
                                        <th><?php echo app('translator')->get('sale.amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-right">Total: </th>
                                        <th id="supplier_total_transactions"></th>
                                        <th id="supplier_summary_total"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="detail" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-end mb-2">
                                    <button type="button" class="btn btn-primary purchase-payment-print-btn" data-tab="detail">
                                        <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                    </button>
                                </div>
                                
                                <div class="table-responsive">
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-th-skin"
 style="width:100% !important;"
 id="purchase_payment_report_table">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th><?php echo app('translator')->get('messages.action'); ?></th>
                                                <th><?php echo app('translator')->get('purchase.payment_no'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.payment_location'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.paid_on'); ?></th>
                                                <th><?php echo app('translator')->get('sale.amount'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.purchase_no'); ?></th>
                                                <th><?php echo app('translator')->get('purchase.purchase_date'); ?></th>
                                                <th style="width:350px"><?php echo app('translator')->get('purchase.supplier'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.transaction_location'); ?></th>
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
                                                
                                                <td colspan="6"></td>
                                            </tr>
                                        </tfoot>
                                        
                                    </table>
                                    </div>
                                </div>
                                
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
    if ($('#ppr_date_filter').length && $.fn.daterangepicker) {
        var pprDateRangeSettings = $('#reports_filter_date_range').length
            ? window.getAdminReportDateRangeSettings()
            : $.extend({}, dateRangeSettings, {
                startDate: moment(),
                endDate: moment()
            });

        if ($('#ppr_date_filter').data('daterangepicker')) {
            $('#ppr_date_filter').data('daterangepicker').remove();
        }

        $('#ppr_date_filter')
            .prop('readonly', false)
            .attr('autocomplete', 'off')
            .daterangepicker(pprDateRangeSettings, function(start, end) {
                $('#ppr_date_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                if (typeof purchase_payment_report !== 'undefined') {
                    purchase_payment_report.ajax.reload();
                }
                if (typeof purchase_payment_report_summary === 'function') {
                    purchase_payment_report_summary();
                }
                if (typeof purchase_payment_report_supplier_summary === 'function') {
                    purchase_payment_report_supplier_summary();
                }
            });

        var pprDatePicker = $('#ppr_date_filter').data('daterangepicker');
        if (pprDatePicker) {
            $('#ppr_date_filter').val(
                pprDatePicker.startDate.format(moment_date_format) + ' ~ ' + pprDatePicker.endDate.format(moment_date_format)
            );
            if (typeof purchase_payment_report !== 'undefined') {
                purchase_payment_report.ajax.reload();
            }
            if (typeof purchase_payment_report_summary === 'function') {
                purchase_payment_report_summary();
            }
            if (typeof purchase_payment_report_supplier_summary === 'function') {
                purchase_payment_report_supplier_summary();
            }
        }

        $('#ppr_date_filter').off('cancel.daterangepicker').on('cancel.daterangepicker', function() {
            $(this).val('');
            if (typeof purchase_payment_report !== 'undefined') {
                purchase_payment_report.ajax.reload();
            }
            if (typeof purchase_payment_report_summary === 'function') {
                purchase_payment_report_summary();
            }
            if (typeof purchase_payment_report_supplier_summary === 'function') {
                purchase_payment_report_supplier_summary();
            }
        });
    }

    function getPurchasePaymentPrintParams(tab) {
        var params = {
            tab: tab,
            supplier_id: $('select#supplier_id').val(),
            location_id: $('select#location_id').val(),
            transaction_location: $('select#transaction_location').val(),
            payment_types: $('select#payment_types').val()
        };

        if ($('input#ppr_date_filter').val() && $('input#ppr_date_filter').data('daterangepicker')) {
            params.start_date = $('input#ppr_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
            params.end_date = $('input#ppr_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
        }

        $.each(params, function(key, value) {
            if (value === null || value === '') {
                delete params[key];
            }
        });

        return $.param(params);
    }

    $(document).on('click', '.purchase-payment-print-btn', function() {
        var query = getPurchasePaymentPrintParams($(this).data('tab'));
        window.open("<?php echo e(url('reports/purchase-payment-report-print'), false); ?>?" + query, '_blank');
    });

    <?php if(!empty($user_settings['rpt_purch_ppay_hide_payment_no'])): ?>
        purchase_payment_report.column(2).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_purch_ppay_hide_payment_location'])): ?>
        purchase_payment_report.column(3).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_purch_ppay_hide_paid_on'])): ?>
        purchase_payment_report.column(4).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_purch_ppay_hide_amount'])): ?>
        purchase_payment_report.column(5).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_purch_ppay_hide_payment_method'])): ?>
        purchase_payment_report.column(6).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_purch_ppay_hide_purchase_no'])): ?>
        purchase_payment_report.column(7).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_purch_ppay_hide_purchase_date'])): ?>
        purchase_payment_report.column(8).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_purch_ppay_hide_supplier'])): ?>
        purchase_payment_report.column(9).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_purch_ppay_hide_transaction_location'])): ?>
        purchase_payment_report.column(10).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_purch_ppay_hide_payment_note'])): ?>
        purchase_payment_report.column(11).visible(false);
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>