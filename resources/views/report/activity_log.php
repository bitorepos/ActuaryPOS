<?php $user_settings = json_decode(auth()->user()->user_settings, true) ?? []; ?>

<?php $__env->startSection('title', __('lang_v1.activity_log')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('lang_v1.activity_log'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>

                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('al_users_filter', __( 'lang_v1.user_by' ) . ':'); ?>

                        <?php echo Form::select('al_users_filter', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'al_users_filter', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('subject_type', __( 'lang_v1.subject_type' ) . ':'); ?>

                        <?php echo Form::select('subject_type', $subject_types, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'subject_type', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('transaction_type', 'Transaction Type:'); ?>

                        <?php echo Form::select('transaction_type', $transaction_types, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'transaction_type', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('action', 'Action:'); ?>

                        <?php echo Form::select('action', $action_types, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'action', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('status_type', __( 'lang_v1.status' ) . ':'); ?>

                        <?php echo Form::select('status_type', $status_types, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'status_type', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('al_date_filter', __('report.date_range') . ':'); ?>

                        <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_activity_log_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo Form::text('al_date_filter', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

                    </div>
                </div>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row no-print">
        <div class="col-sm-12 mb-2">
            <button type="button" class="btn btn-primary float-end" id="activity_log_print_btn" aria-label="Print">
                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="activity_log_table">
                    <thead>
                        <tr>
                            <th class="al-compact-col"><?php echo app('translator')->get('lang_v1.date'); ?></th>
                            <th class="al-compact-col"><?php echo app('translator')->get('lang_v1.subject_type'); ?></th>
                            <th class="al-compact-col"><?php echo app('translator')->get('messages.action'); ?></th>
                            <th class="al-compact-col"><?php echo app('translator')->get('lang_v1.user_by'); ?></th>
                            <th class="al-note-col"><?php echo app('translator')->get('brand.note'); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
    $(document).ready( function(){
        var alDateRangeSettings = window.getAdminReportDateRangeSettings();

        $('#al_date_filter').daterangepicker(alDateRangeSettings, function(start, end) {
            $('#al_date_filter').val(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
            activity_log_table.ajax.reload();
        });
        var alDatePicker = $('#al_date_filter').data('daterangepicker');
        if (alDatePicker) {
            $('#al_date_filter').val(
                alDatePicker.startDate.format(moment_date_format) + ' ~ ' + alDatePicker.endDate.format(moment_date_format)
            );
        }
        $('#al_date_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#al_date_filter').val('');
            activity_log_table.ajax.reload();
        });

        $('#activity_log_print_btn').on('click', function () {
            var params = {
                user_id: $('#al_users_filter').val() || '',
                subject_type: $('#subject_type').val() || '',
                transaction_type: $('#transaction_type').val() || '',
                action: $('#action').val() || '',
                status_type: $('#status_type').val() || '',
                search: $('#activity_log_table_filter input').val() || ''
            };
            var picker = $('#al_date_filter').data('daterangepicker');

            if ($('#al_date_filter').val() && picker) {
                params.start_date = picker.startDate.format('YYYY-MM-DD');
                params.end_date = picker.endDate.format('YYYY-MM-DD');
            }

            window.open('<?php echo e(url('reports/activity-log-print'), false); ?>?' + $.param(params), '_blank');
        });

        activity_log_table = $('#activity_log_table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            aaSorting: [[0, 'desc']],
            "ajax": {
                "url": '<?php echo e(action([\App\Http\Controllers\ReportController::class, 'activityLog']), false); ?>',
                "data": function ( d ) {
                    var start_date = '';
                    var end_date = '';
                    if ($('#al_date_filter').val()) {
                        d.start_date = $('input#al_date_filter')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        d.end_date = $('input#al_date_filter')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }

                    d.user_id = $('#al_users_filter').val();
                    d.subject_type = $('#subject_type').val();
                    d.transaction_type = $('#transaction_type').val();
                    d.action = $('#action').val();
                    d.status_type = $('#status_type').val();
                }
            },
            columns: [
                { data: 'created_at', name: 'activity_log.created_at', className: 'al-compact-col' },
                { data: 'subject_type', "orderable": false, "searchable": false, className: 'al-compact-col' },
                { data: 'description', name: 'description', className: 'al-compact-col' },
                { data: 'created_by', name: 'created_by', className: 'al-compact-col' },
                { data: 'note', name: 'note', className: 'al-note-col' }
            ]
        });  

        function syncActivityLogTransactionFilters() {
            var disable_transaction_filters = $.inArray($('#subject_type').val(), ['contact', 'user', 'role']) !== -1;
            $('#transaction_type, #status_type').prop('disabled', disable_transaction_filters);

            if (disable_transaction_filters) {
                $('#transaction_type, #status_type').val('').trigger('change.select2');
            }
        }

        syncActivityLogTransactionFilters();

        $(document).on('change', '#subject_type', function(){
            syncActivityLogTransactionFilters();
            activity_log_table.ajax.reload();
        });

        $(document).on('change', '#al_users_filter, #transaction_type, #action, #status_type', function(){
            activity_log_table.ajax.reload();
        })

        <?php if(!empty($user_settings['rpt_admin_actlog_hide_date'])): ?>
            activity_log_table.column(0).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_admin_actlog_hide_subject_type'])): ?>
            activity_log_table.column(1).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_admin_actlog_hide_action'])): ?>
            activity_log_table.column(2).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_admin_actlog_hide_user_by'])): ?>
            activity_log_table.column(3).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_admin_actlog_hide_note'])): ?>
            activity_log_table.column(4).visible(false);
        <?php endif; ?>
    });
</script>
<style>
    #activity_log_table {
        width: 100% !important;
        table-layout: auto !important;
    }
    #activity_log_table th,
    #activity_log_table td {
        text-align: left !important;
        vertical-align: top;
    }
    #activity_log_table th.al-compact-col,
    #activity_log_table td.al-compact-col {
        width: 1%;
        white-space: nowrap;
    }
    #activity_log_table th.al-note-col,
    #activity_log_table td.al-note-col {
        width: auto;
        min-width: 360px;
        white-space: normal;
        overflow-wrap: anywhere;
        word-break: break-word;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>