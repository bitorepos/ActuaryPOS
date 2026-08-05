<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>

<?php $__env->startSection('title', __('lang_v1.customer_groups_report')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_customer_group_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('lang_v1.customer_groups_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>

            <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getCustomerGroup']),
            'method' => 'get', 'class'=> 'row', 'id' => 'cg_report_filter_form' ]); ?>

            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('cg_location_id', __('purchase.business_location') . ':'); ?>

                    <?php echo Form::select('cg_location_id', $business_locations, null, ['class' => 'form-control select2',
                    'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('cg_customer_group_id', __( 'lang_v1.customer_group_name' ) . ':'); ?>

                    <?php echo Form::select('cg_customer_group_id', $customer_group, null, ['class' => 'form-control select2',
                    'style' => 'width:100%', 'id' => 'cg_customer_group_id']); ?>

                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('cg_date_range', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' =>
                    'form-control', 'id' => 'cg_date_range', 'readonly']); ?>

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
                <button type="button" class="btn btn-primary open-customer-group-report-print">
                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="cg_report_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('lang_v1.customer_group'); ?></th>
                            <th><?php echo app('translator')->get('report.total_sell'); ?></th>
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
$(document).ready(function() {
    function getCustomerGroupReportPrintParams() {
        var params = {
            location_id: $('#cg_location_id').val(),
            customer_group_id: $('#cg_customer_group_id').val()
        };

        if ($('#cg_date_range').val() && $('#cg_date_range').data('daterangepicker')) {
            params.start_date = $('#cg_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
            params.end_date = $('#cg_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
        }

        $.each(params, function(key, value) {
            if (value === null || value === '') {
                delete params[key];
            }
        });

        return $.param(params);
    }

    $(document).on('click', '.open-customer-group-report-print', function() {
        window.open("<?php echo e(url('reports/customer-group-print'), false); ?>?" + getCustomerGroupReportPrintParams(), '_blank');
    });

    if ($('#cg_date_range').length == 1) {
        var customerGroupDateRangeSettings = $('#reports_filter_date_range').length
            ? window.getAdminReportDateRangeSettings()
            : $.extend({}, dateRangeSettings);
        $('#cg_date_range').daterangepicker(
            customerGroupDateRangeSettings,
            function(start, end) {
                $('#cg_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(
                    moment_date_format));
                cg_report_table.ajax.reload();
            }
        );
        var customerGroupDatePicker = $('#cg_date_range').data('daterangepicker');
        if (customerGroupDatePicker) {
            $('#cg_date_range').val(
                customerGroupDatePicker.startDate.format(moment_date_format) + ' ~ ' + customerGroupDatePicker.endDate.format(moment_date_format)
            );
        }

        $('#cg_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            cg_report_table.ajax.reload();
        });
    }

    cg_report_table = $('#cg_report_table').DataTable({
        processing: true,
        serverSide: true,
        "ajax": {
            "url": "/reports/customer-group",
            "data": function(d) {
                d.location_id = $('#cg_location_id').val();
                d.customer_group_id = $('#cg_customer_group_id').val();
                if ($('#cg_date_range').val() && $('#cg_date_range').data('daterangepicker')) {
                    d.start_date = $('#cg_date_range').data('daterangepicker').startDate.format(
                        'YYYY-MM-DD');
                    d.end_date = $('#cg_date_range').data('daterangepicker').endDate.format(
                        'YYYY-MM-DD');
                }
            }
        },
        columns: [{
                data: 'name',
                name: 'CG.name'
            },
            {
                data: 'total_sell',
                name: 'total_sell',
                searchable: false
            }
        ],
        "fnDrawCallback": function(oSettings) {
            __currency_convert_recursively($('#cg_report_table'));
        }
    });
    //Customer Group report filter
    $('select#cg_location_id, select#cg_customer_group_id, #cg_date_range').change(function() {
        cg_report_table.ajax.reload();
    });

    <?php if(!empty($user_settings['rpt_sales_cgrp_hide_customer_group'])): ?>
        cg_report_table.column(0).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_cgrp_hide_total_sell'])): ?>
        cg_report_table.column(1).visible(false);
    <?php endif; ?>
})
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>