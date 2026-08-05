
<?php $__env->startSection('title', __('account.payment_account_report')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('account.payment_account_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid" id="accordion">
              <div class="box-header with-border">
                <h3 class="box-title">
                  <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#collapseFilter">
                    <i class="fa fa-filter" aria-hidden="true"></i> <?php echo app('translator')->get('report.filters'); ?>
                  </a>
                </h3>
              </div>
              <div id="collapseFilter" class="panel-collapse active collapse in" aria-expanded="true">
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('account_id', __('account.account') . ':'); ?>

                            <?php echo Form::select('account_id', $accounts, null, ['class' => 'form-control select2']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php
                                $date_loc = array_key_first($date_settings ?? []);
                                $accounting_filter_date_range = ! is_null($date_loc) && is_array($date_settings[$date_loc] ?? null)
                                    ? ($date_settings[$date_loc]['accounting_filter_date_range'] ?? null)
                                    : ($date_settings['accounting_filter_date_range'] ?? null);
                            ?>
                            <?php if(!empty($accounting_filter_date_range)): ?>
                                <?php echo Form::hidden('accounting_filter_date_range', $accounting_filter_date_range, ['id'=>'accounting_filter_date_range']); ?>

                            <?php endif; ?>
                            <?php echo Form::label('date_filter', __('report.date_range') . ':'); ?>

                            <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'date_filter', 'readonly']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <?php echo Form::label('link_type', __('account.link_type') . ':'); ?>

                            <?php echo Form::select('link_type', ['linked' => __('account.linked'), 'not_linked' => __('account.not_linked')], null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.all')]); ?>

                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="mb-3">
                            <button type="button" class="btn btn-warning" id="link_default_btn">
                                <i class="fas fa-link"></i> <?php echo app('translator')->get('account.link_default'); ?>
                            </button>
                        </div>
                    </div>
                    </div><!-- /.row -->
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="text-right mb-2">
                <button type="button" id="print_payment_account_report" class="btn btn-primary">
                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                </button>
            </div>
            <div class="box box-primary">
                <div class="box-body box box-primary">
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-th-skin" id="payment_account_report">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('messages.date'); ?></th>
                                <th><?php echo app('translator')->get('account.payment_ref_no'); ?></th>
                                <th><?php echo app('translator')->get('account.invoice_ref_no'); ?></th>
                                <th class="text-right"><?php echo app('translator')->get('sale.amount'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                                <th><?php echo app('translator')->get('lang_v1.payment_type'); ?></th>
                                <th><?php echo app('translator')->get('account.account'); ?></th>
                                <th><?php echo app('translator')->get( 'lang_v1.description' ); ?></th>
                                <th><?php echo app('translator')->get('messages.action'); ?></th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    
    <script type="text/javascript">
        $(document).ready(function(){
            function getPaymentAccountReportPrintParams() {
                var start_date = '';
                var end_date = '';

                if ($('#date_filter').val()) {
                    start_date = $('#date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    end_date = $('#date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                }

                return $.param({
                    account_id: $('#account_id').val(),
                    link_type: $('#link_type').val(),
                    start_date: start_date,
                    end_date: end_date,
                    tab: 'all'
                });
            }

            $(document).on('click', '#print_payment_account_report', function() {
                window.open("<?php echo e(action([\App\Http\Controllers\AccountReportsController::class, 'printPaymentAccountReport']), false); ?>?" + getPaymentAccountReportPrintParams(), '_blank');
            });

            if($('#date_filter').length == 1){
                let payment_account_report_date_range_settings = $.extend({}, dateRangeSettings);
                let payment_account_report_date_range_default = $('#accounting_filter_date_range').val();
                if(payment_account_report_date_range_default == 'today'){
                    payment_account_report_date_range_settings.startDate = moment();
                    payment_account_report_date_range_settings.endDate = moment();
                }else if(payment_account_report_date_range_default == 'last_seven_days'){
                    payment_account_report_date_range_settings.startDate = moment().subtract(6,'day');
                    payment_account_report_date_range_settings.endDate = moment();
                }else if(payment_account_report_date_range_default == 'last_thirty_days'){
                    payment_account_report_date_range_settings.startDate = moment().subtract(29,'day');
                    payment_account_report_date_range_settings.endDate = moment();
                }else if(payment_account_report_date_range_default == 'this_month'){
                    payment_account_report_date_range_settings.startDate = moment().startOf('month');
                    payment_account_report_date_range_settings.endDate = moment();
                }else if(payment_account_report_date_range_default == 'last_month'){
                    payment_account_report_date_range_settings.startDate = moment().subtract(1, 'month').startOf('month');
                    payment_account_report_date_range_settings.endDate = moment().subtract(1, 'month').endOf('month');
                }else if(payment_account_report_date_range_default == 'this_year'){
                    payment_account_report_date_range_settings.startDate = moment().startOf('year');
                    payment_account_report_date_range_settings.endDate = moment();
                }else if(payment_account_report_date_range_default == 'last_year'){
                    payment_account_report_date_range_settings.startDate = moment().subtract(1, 'year').startOf('year');
                    payment_account_report_date_range_settings.endDate = moment().subtract(1, 'year').endOf('year');
                }else if(payment_account_report_date_range_default == 'all_time'){
                    payment_account_report_date_range_settings.startDate = moment(business_start_date);
                    payment_account_report_date_range_settings.endDate = moment();
                }

                $('#date_filter').daterangepicker(
                    payment_account_report_date_range_settings,
                    function (start, end) {
                        $('#date_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                        payment_account_report.ajax.reload();
                    }
                );

                $('#date_filter').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                    payment_account_report.ajax.reload();
                });
            }

            payment_account_report = $('#payment_account_report').DataTable({
                            processing: true,
                            serverSide: true,
                            "ajax": {
                                "url": "<?php echo e(action([\App\Http\Controllers\AccountReportsController::class, 'paymentAccountReport']), false); ?>",
                                "data": function ( d ) {
                                    d.account_id = $('#account_id').val();
                                    d.link_type = $('#link_type').val();
                                    var start_date = '';
                                    var endDate = '';
                                    if($('#date_filter').val()){
                                        var start_date = $('#date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                                        var endDate = $('#date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                                    }
                                    d.start_date = start_date;
                                    d.end_date = endDate;
                                }
                            },
                            columnDefs:[{
                                "targets": 7,
                                "orderable": false,
                                "searchable": false
                            }],
                            columns: [
                                {data: 'paid_on', name: 'paid_on'},
                                {data: 'payment_ref_no', name: 'payment_ref_no'},
                                {data: 'transaction_number', name: 'transaction_number'},
                                {data: 'amount', name: 'amount', className: 'text-right'},
                                {data: 'type', name: 'T.type'},
                                {data: 'account', name: 'account'},
                                {data: 'details', name: 'details', "searchable": false},
                                {data: 'action', name: 'action'}
                            ],
                            "fnDrawCallback": function (oSettings) {
                                __currency_convert_recursively($('#payment_account_report'));
                            }
                        });
            
            $('select#account_id, #date_filter, select#link_type').change( function(){
                payment_account_report.ajax.reload();
            });
        })

        $(document).on('submit', 'form#link_account_form', function(e){
            e.preventDefault();
            var data = $(this).serialize();

            $.ajax({
                method: $(this).attr("method"),
                url: $(this).attr("action"),
                dataType: "json",
                data: data,
                success: function(result){
                    if(result.success === true){
                        $('div.view_modal').modal('hide');
                        toastr.success(result.msg);
                        payment_account_report.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });

        $(document).on('click', '#link_default_btn', function(){
            swal({
                title: LANG.sure,
                text: '<?php echo e(__("account.link_default_confirm"), false); ?>',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(function(willProceed) {
                if (willProceed) {
                    var btn = $('#link_default_btn');
                    btn.prop('disabled', true);
                    $.ajax({
                        method: 'POST',
                        url: '<?php echo e(action([\App\Http\Controllers\AccountReportsController::class, "linkDefaultAccounts"]), false); ?>',
                        dataType: 'json',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function(result){
                            btn.prop('disabled', false);
                            if(result.success === true){
                                toastr.success(result.msg);
                                payment_account_report.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                        error: function(){
                            btn.prop('disabled', false);
                            toastr.error('<?php echo e(__("messages.something_went_wrong"), false); ?>');
                        }
                    });
                }
            });
        });
    </script>
    <script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>