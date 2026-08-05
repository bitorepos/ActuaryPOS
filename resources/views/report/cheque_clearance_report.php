<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>

<?php $__env->startSection('title', __('lang_v1.cheque_clearance_report')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_cheque_clearance_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('lang_v1.cheque_clearance_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => '#', 'method' => 'get', 'id' => 'cheque_clearance_report_form', 'class' => 'row' ]); ?>

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
                    <?php echo Form::label('contact_type', __('contact.contact_type') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-list"></i>
                        </span>
                        <?php echo Form::select('contact_type', ['customer' => 'Customers', 'supplier' => 'Suppliers', 'both' => 'Barterers'], null, ['class' => 'form-control select2',
                            'placeholder' => __('messages.all'), 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('contact_id', __('contact.contact') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('contact_id', $contacts, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.all'), 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('spr_date_filter', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' =>
                    'form-control', 'id' => 'spr_date_filter', 'readonly']); ?>

                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('cheque_status', __('lang_v1.status') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-list"></i>
                        </span>
                        <?php echo Form::select('cheque_status', ['pending' => 'Pending', 'cleared' => 'Cleared'], 'pending', ['class' => 'form-control select2',
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
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                <div class="text-end mb-2">
                    <button type="button" class="btn btn-primary open-cheque-clearance-report-print">
                        <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                    </button>
                </div>
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin"
 id="cheque_clearance_report_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('purchase.payment_no'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.issue_date'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.contact_id'); ?></th> 
                            <th><?php echo app('translator')->get('contact.contact_name'); ?></th> 
                            <th><?php echo app('translator')->get('lang_v1.transaction'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.bank_name'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.cheque_no'); ?></th>
                            <th><?php echo app('translator')->get('sale.amount'); ?></th>
                            <?php if(count($business_locations) > 1): ?>
                            <th id="ccr_location"><?php echo app('translator')->get('business.location'); ?></th>
                            <?php endif; ?>
                            <th><?php echo app('translator')->get('lang_v1.clearance_date'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.status'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.cleared_date'); ?></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-gray font-17 footer-total text-right">
                            <td colspan="7"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                            <td><span class="display_currency" id="footer_total_amount"
                                    data-currency_symbol="true"></span></td>
                            <td colspan="<?php if(count($business_locations) > 1): ?> 4 <?php else: ?> 3 <?php endif; ?>"></td>
                        </tr>
                    </tfoot>
                </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

</section>
<!-- /.content -->
<div class="modal fade pdc_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog no-print" role="document">
    <div class="modal-content">
          <div class="modal-header">
          <h4 class="modal-title" id="modalTitle">Set Cleared Date</h4>
            <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
          
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                  <?php echo Form::label("cleared_on" , __('lang_v1.cleared_on') . ':*'); ?>

                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </span>
                    <?php echo Form::text('cleared_on', \Carbon::createFromTimestamp(strtotime(now()))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required']); ?>

                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="update_pdc_payment_status_post btn btn-primary">Proceed </a>
            <button type="button" class="btn btn-default no-print" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
var pdc_url = null;
$(document).on('click', '.update_pdc_payment_status', function(e) {
    e.preventDefault();
    if($(this).data('status') == 'pending'){
        $.ajax({
            url: $(this).data('href'),
            dataType: 'json',
            success: function(result) {
                cheque_clearance_report_table.ajax.reload();
            },
        });
    }else{
        pdc_url = $(this).data('href');
        $('div.pdc_modal').modal('show');
        $('#cleared_on').datetimepicker({
            format: moment_date_format + ' ' + moment_time_format,
            ignoreReadonly: true,
        });
        $('#cleared_on').datetimepicker('date', moment());
    }
});
$(document).on('click', '.update_pdc_payment_status_post', function(e) {
    e.preventDefault();
    $('div.pdc_modal').modal('hide');
    $.ajax({
        url: pdc_url,
        data: {
            cleared_on : $('#cleared_on').datetimepicker('date').format(moment_date_format + ' ' + moment_time_format),
        },
        dataType: 'json',
        success: function(result) {
            cheque_clearance_report_table.ajax.reload();
        },
    });
});
</script>
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<script>
$(document).ready(function(){
    function getChequeClearanceReportPrintParams() {
        var params = {
            contact_type: $('select#contact_type').val(),
            contact_id: $('select#contact_id').val(),
            location_id: $('select#location_id').val(),
            cheque_status: $('select#cheque_status').val()
        };

        if ($('input#spr_date_filter').val() && $('input#spr_date_filter').data('daterangepicker')) {
            params.start_date = $('input#spr_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
            params.end_date = $('input#spr_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
        }

        $.each(params, function(key, value) {
            if (value === null || value === '') {
                delete params[key];
            }
        });

        return $.param(params);
    }

    $(document).on('click', '.open-cheque-clearance-report-print', function() {
        window.open("<?php echo e(url('reports/cheque-clearance-report-print'), false); ?>?" + getChequeClearanceReportPrintParams(), '_blank');
    });

    <?php if(!empty($user_settings['rpt_sales_chqclr_hide_payment_no'])): ?>
        cheque_clearance_report_table.column(0).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_chqclr_hide_issue_date'])): ?>
        cheque_clearance_report_table.column(1).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_chqclr_hide_contact_id'])): ?>
        cheque_clearance_report_table.column(2).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_chqclr_hide_contact_name'])): ?>
        cheque_clearance_report_table.column(3).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_chqclr_hide_transaction'])): ?>
        cheque_clearance_report_table.column(4).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_chqclr_hide_bank_name'])): ?>
        cheque_clearance_report_table.column(5).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_chqclr_hide_cheque_no'])): ?>
        cheque_clearance_report_table.column(6).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_chqclr_hide_amount'])): ?>
        cheque_clearance_report_table.column(7).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_chqclr_hide_location'])): ?>
        cheque_clearance_report_table.column('location:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_chqclr_hide_clearance_date'])): ?>
        cheque_clearance_report_table.column('clearance_date:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_chqclr_hide_status'])): ?>
        cheque_clearance_report_table.column('status:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_chqclr_hide_cleared_date'])): ?>
        cheque_clearance_report_table.column('cleared_date:name').visible(false);
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>