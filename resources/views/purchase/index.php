
<?php $__env->startSection('title', __('purchase.purchases')); ?>

<?php
    $user_settings = json_decode(auth()->user()->user_settings, true);
?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo app('translator')->get('purchase.purchases'); ?>
        <small></small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content no-print">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <input type="hidden" id="business_location" value="">
        <input type="hidden" id="date_range" value="">
        <div class="col-md-3">
            <div class="form-group mb-2">
                <?php echo Form::label('purchase_list_filter_location_id',  __('purchase.business_location') . ':'); ?>

                <?php echo Form::select('purchase_list_filter_location_id', $business_locations, request()->get('location_id'), ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-2">
                <?php echo Form::label('purchase_list_filter_supplier_id',  __('purchase.supplier') . ':'); ?>

                <?php echo Form::select('purchase_list_filter_supplier_id', $suppliers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-2">
                <?php echo Form::label('purchase_list_filter_status',  __('purchase.purchase_status') . ':'); ?>

                <?php echo Form::select('purchase_list_filter_status', $orderStatuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-2">
                <?php echo Form::label('purchase_list_filter_payment_status',  __('purchase.payment_status') . ':'); ?>

                <?php echo Form::select('purchase_list_filter_payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial'), 'overdue' => __('lang_v1.overdue')], request()->get('payment_status'), ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <?php
            $date_loc = array_key_first($date_settings);
        ?>
        <?php if(!empty($date_settings[$date_loc]['purchase_filter_date_range'])): ?>
            <?php echo Form::hidden('purchase_filter_date_range', $date_settings[$date_loc]['purchase_filter_date_range'], ['id'=>'purchase_filter_date_range']); ?>

        <?php endif; ?>
        <div class="col-md-3">
            <div class="form-group mb-2">
                <?php echo Form::label('purchase_list_filter_date_range', __('report.date_range') . ':'); ?>

                <?php echo Form::text('purchase_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

            </div>
        </div>
        <?php if(in_array('transactions_restoration', $enabled_modules)): ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <br>
                    <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                    </label>
                </div>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('purchase.all_purchases')]); ?>
        <?php if(!$is_offline): ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase.create')): ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <a class="btn btn-block btn-primary" href="<?php echo e(action([\App\Http\Controllers\PurchaseController::class, 'create']), false); ?>">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></a>
                </div>
            <?php $__env->endSlot(); ?>
        <?php endif; ?>
        <?php endif; ?>
        <?php echo $__env->make('purchase.partials.purchase_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="modal fade product_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

    

    

    <?php echo $__env->make('purchase.partials.update_purchase_status_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</section>

<section id="receipt_section" class="print_section"></section>
<div class="loading" style="display: none">
    
    <div class="loading-animation"></div>
</div>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php if(!empty($common_settings['enable_ledger_discount3'])): ?>
<script>
    window.enable_ledger_discount3 = true;
</script>
<?php endif; ?>
<script src="<?php echo e(asset('js/purchase.js?v=' . $asset_v), false); ?>"></script>
<script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<script>
    let date_range_default = $('#purchase_filter_date_range').val();
    if(date_range_default == 'today'){
        dateRangeSettings.startDate = moment();
        dateRangeSettings.endDate = moment();
    }else if(date_range_default == 'last_seven_days'){
        dateRangeSettings.startDate = moment().subtract(6,'day');
        dateRangeSettings.endDate = moment();
    }else if(date_range_default == 'last_thirty_days'){
        dateRangeSettings.startDate = moment().subtract(29,'day');
        dateRangeSettings.endDate = moment();
    }else if(date_range_default == 'this_month'){
        dateRangeSettings.startDate = moment().startOf('month');
        dateRangeSettings.endDate = moment();
    }else if(date_range_default == 'last_month'){
        dateRangeSettings.startDate = moment().subtract(1, 'month').startOf('month');
        dateRangeSettings.endDate = moment().subtract(1, 'month').endOf('month');
    }else if(date_range_default == 'this_year'){
        dateRangeSettings.startDate = moment().startOf('year');
        dateRangeSettings.endDate = moment();
    }else if(date_range_default == 'last_year'){
        dateRangeSettings.startDate = moment().subtract(1, 'year').startOf('year');
        dateRangeSettings.endDate = moment().subtract(1, 'year').endOf('year');
    }else if(date_range_default == 'current_financial_year'){
        // dateRangeSettings.startDate = moment();
        // dateRangeSettings.endDate = moment();
    }else if(date_range_default == 'all_time'){
        dateRangeSettings.startDate = moment(business_start_date);
        dateRangeSettings.endDate = moment();
    }

    //Date range as a button
    $('#purchase_list_filter_date_range').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#purchase_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            var dateRange = $('#purchase_list_filter_date_range').val();
            $('#date_range').val(dateRange);
            purchase_table.ajax.reload();
        }
    );
    $('#purchase_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#purchase_list_filter_date_range').val('');
        $('#date_range').val('');
        purchase_table.ajax.reload();
    });

    <?php if(request()->filled('start_date') && request()->filled('end_date')): ?>
        $('#purchase_list_filter_date_range').data('daterangepicker').setStartDate(moment('<?php echo e(request()->get('start_date'), false); ?>'));
        $('#purchase_list_filter_date_range').data('daterangepicker').setEndDate(moment('<?php echo e(request()->get('end_date'), false); ?>'));
        $('#purchase_list_filter_date_range').val(
            moment('<?php echo e(request()->get('start_date'), false); ?>').format(moment_date_format) + ' ~ ' +
            moment('<?php echo e(request()->get('end_date'), false); ?>').format(moment_date_format)
        );
    <?php endif; ?>

    $(document).on('change', 'input#show_deleted', function(e) {
        purchase_table.ajax.reload();
    });

    $(document).on('click', '.update_status', function(e){
        e.preventDefault();
        e.stopPropagation();
        $('#update_purchase_status_form').find('#status').val($(this).data('status'));
        $('#update_purchase_status_form').find('#purchase_id').val($(this).data('purchase_id'));
        $('#update_purchase_status_modal').modal('show');
    });

    var dateRange = $('#purchase_list_filter_date_range').val();
    $('#date_range').val(dateRange);

    $(document).on('submit', '#update_purchase_status_form', function(e){
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            beforeSend: function(xhr) {
                __disable_submit_button(form.find('button[type="submit"]'));
            },
            success: function(result) {
                if (result.success == true) {
                    $('#update_purchase_status_modal').modal('hide');
                    toastr.success(result.msg);
                    purchase_table.ajax.reload();
                    $('#update_purchase_status_form')
                        .find('button[type="submit"]')
                        .attr('disabled', false);
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('submit', '#add_purchase_shipping_charges_form', function(e){
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);

        $.ajax({
            method: form.attr('method'),
            url: form.attr('action'),
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                __disable_submit_button(form.find('button[type="submit"]'));
            },
            success: function(result) {
                if (result.success) {
                    toastr.success(result.msg);
                    $('.view_modal').modal('hide');
                    if (typeof purchase_table !== 'undefined') {
                        purchase_table.ajax.reload();
                    }
                } else {
                    toastr.error(result.msg);
                    form.find('button[type="submit"]').attr('disabled', false);
                }
            },
            error: function() {
                toastr.error("<?php echo e(__('messages.something_went_wrong'), false); ?>");
                form.find('button[type="submit"]').attr('disabled', false);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        if (typeof purchase_table !== 'undefined') {
            <?php if(!empty($user_settings['purchase_index_hide_ref_no'])): ?>
                purchase_table.column(2).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['purchase_index_hide_ref_no_short'])): ?>
                purchase_table.column(3).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['purchase_index_hide_supplier'])): ?>
                purchase_table.column(4).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['purchase_index_hide_supplier_business_name'])): ?>
                purchase_table.column(5).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['purchase_index_hide_purchase_status'])): ?>
                purchase_table.column(6).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['purchase_index_hide_payment_status'])): ?>
                purchase_table.column(7).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['purchase_index_hide_grand_total'])): ?>
                purchase_table.column(8).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['purchase_index_hide_payment_due'])): ?>
                purchase_table.column(9).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['purchase_index_hide_added_by'])): ?>
                purchase_table.column(12).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['purchase_index_hide_location'])): ?>
                purchase_table.column(13).visible(false);
            <?php endif; ?>
        }
    });
</script>
	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>