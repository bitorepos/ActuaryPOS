
<?php $__env->startSection('title', __('lang_v1.purchase_requisition')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo app('translator')->get('lang_v1.purchase_requisition'); ?><br>
        <small><?php echo app('translator')->get('lang_v1.purchase_requisition_help_text'); ?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <input type="hidden" id="business_location" value="">
        <input type="hidden" id="date_range" value="">
        <div class="col-md-3">
            <div class="form-group mb-2">
                <?php echo Form::label('pr_list_filter_location_id',  __('purchase.business_location') . ':'); ?>

                <?php echo Form::select('pr_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-2">
                <?php echo Form::label('pr_list_filter_status',  __('sale.status') . ':'); ?>

                <?php echo Form::select('pr_list_filter_status', $purchaseRequisitionStatuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-2">
                <?php echo Form::label('po_list_filter_date_range', __('report.date_range') . ':'); ?>

                <?php echo Form::text('po_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group mb-2">
                <?php echo Form::label('pr_list_filter_required_by_date', __('lang_v1.required_by_date') . ':'); ?>

                <?php echo Form::text('pr_list_filter_required_by_date', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control']); ?>

            </div>
        </div>
        
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <br>
                    <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                    </label>
                </div>
            </div>
        
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase_requisition.create')): ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <a class="btn btn-block btn-primary" href="<?php echo e(action([\App\Http\Controllers\PurchaseRequisitionController::class, 'create']), false); ?>">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></a>
                </div>
            <?php $__env->endSlot(); ?>
        <?php endif; ?>

        <div class="table-responsive" style="min-height: 80vh">
<table class="table table-bordered table-striped ajax_view table-th-skin" id="purchase_requisition_table" style="width: 100%;">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                    <th><?php echo app('translator')->get('messages.date'); ?></th>
                    <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                    <th><?php echo app('translator')->get('purchase.location'); ?></th>
                    <th><?php echo app('translator')->get('sale.status'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.required_by_date'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                </tr>
            </thead>
        </table>
</div>
    <?php echo $__env->renderComponent(); ?>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>	
<script type="text/javascript">
    $(document).ready( function(){
        
        //Purchase table
        purchase_requisition_table = $('#purchase_requisition_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[1, 'desc']],
            scrollY: "75vh",
            scrollX:        true,
            scrollCollapse: true,
            ajax: {
                url: '<?php echo e(action([\App\Http\Controllers\PurchaseRequisitionController::class, 'index']), false); ?>',
                data: function(d) {
                    if ($('#pr_list_filter_location_id').length) {
                        d.location_id = $('#pr_list_filter_location_id').val();
                    }
                    d.status = $('#pr_list_filter_status').val();

                    var start = '';
                    var end = '';
                    if ($('#po_list_filter_date_range').val()) {
                        start = $('input#po_list_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#po_list_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;
                    d.show_deleted = $('#show_deleted').is(':checked');

                    if ($('#pr_list_filter_required_by_date').val()) {
                        required_by_start = $('input#pr_list_filter_required_by_date')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        required_by_end = $('input#pr_list_filter_required_by_date')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');

                        d.required_by_start = required_by_start;
                        d.required_by_end = required_by_end;
                    }

                    d = __datatable_ajax_callback(d);
                },
            },
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'location_name', name: 'BS.name' },
                { data: 'status', name: 'status' },
                { data: 'delivery_date', name: 'delivery_date' },
                { data: 'added_by', name: 'u.first_name' },
            ]
        });

        

        $(document).on(
            'change',
            '#pr_list_filter_location_id, #pr_list_filter_status',
            function() {
                var location = $('select#pr_list_filter_location_id').find('option:selected').text();
                $('#business_location').val(location);
                purchase_requisition_table.ajax.reload();
            }
        );

        $('#po_list_filter_date_range').daterangepicker(
        dateRangeSettings,
            function (start, end) {
                $('#po_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                var dateRange = $('#po_list_filter_date_range').val();
                $('#date_range').val(dateRange);
               purchase_requisition_table.ajax.reload();
            }
        );
        $('#po_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#po_list_filter_date_range').val('');
            $('#date_range').val('');
            purchase_requisition_table.ajax.reload();
        });

        dateRangeSettings.autoUpdateInput = false;
        $('#pr_list_filter_required_by_date').daterangepicker(
        dateRangeSettings,
            function (start, end) {
                $('#pr_list_filter_required_by_date').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
               purchase_requisition_table.ajax.reload();
            }
        );
        $('#pr_list_filter_required_by_date').on('cancel.daterangepicker', function(ev, picker) {
            $('#pr_list_filter_required_by_date').val('');
            purchase_requisition_table.ajax.reload();
        });

        $(document).on('change', 'input#show_deleted', function(e) {
                purchase_requisition_table.ajax.reload();
        });

        var dateRange = $('#po_list_filter_date_range').val();
        $('#date_range').val(dateRange);

        $(document).on('click', 'a.delete-purchase-requisition', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    var href = $(this).attr('href');
                    $.ajax({
                        method: 'DELETE',
                        url: href,
                        dataType: 'json',
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                purchase_requisition_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });
        $(document).on('click', 'button.restore-purchase-requisition', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                icon: 'info',
                buttons: true,
            }).then(willDelete => {
                if (willDelete) {
                    var href = $(this).attr('data-href');
                    $.ajax({
                        method: 'GET',
                        url: href,
                        dataType: 'json',
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                purchase_requisition_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>