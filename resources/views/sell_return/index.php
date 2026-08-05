
<?php $__env->startSection('title', __('lang_v1.sell_return')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo app('translator')->get('lang_v1.sell_return'); ?>
    </h1>
</section>
<?php
    $common_settings = session()->get('business.common_settings');
    $can_delete_sell_return = auth()->user()->can('delete_sell_return')
        || auth()->user()->can('access_sell_return')
        || auth()->user()->can('access_own_sell_return');
?>
<!-- Main content -->
<section class="content no-print">
    <input type="hidden" id="business_location" value="">
    <input type="hidden" id="date_range" value="">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('sell_list_filter_location_id',  __('purchase.business_location') . ':'); ?>


                <?php echo Form::select('sell_list_filter_location_id', $business_locations, request()->get('location_id'), ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('sell_list_filter_customer_id',  __('contact.customer') . ':'); ?>

                <?php echo Form::select('sell_list_filter_customer_id', $customers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>

        
        <?php if(auth()->user()->can('access_sell_return') || auth()->user()->can('access_invoice_sell_return') || auth()->user()->can('access_direct_sell_return')): ?>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('created_by',  __('report.user') . ':'); ?>

                <?php echo Form::select('created_by', $sales_representative, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php
            $date_loc = array_key_first($date_settings);
        ?>
        <?php if(!empty($date_settings[$date_loc]['sell_return_filter_date_range'])): ?>
            <?php echo Form::hidden('sell_return_filter_date_range', $date_settings[$date_loc]['sell_return_filter_date_range'], ['id'=>'sell_return_filter_date_range']); ?>

        <?php endif; ?>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('sell_list_filter_date_range', __('report.date_range') . ':'); ?>

                <?php echo Form::text('sell_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

            </div>
        </div>
        <?php if(in_array('transactions_restoration', $enabled_modules)): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <br>
                    <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                    </label>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-3">
            <div class="mb-3">
                <br>
                <label class="form-check-label">
<?php echo Form::checkbox('show_only_duplicates', 1, false, ['class' => 'form-check-input', 'id' => 'show_only_duplicates']); ?> <strong><?php echo app('translator')->get('lang_v1.show_only_duplicates'); ?></strong>
                </label>
            </div>
        </div>
        <?php if($can_delete_sell_return): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <br>
                    <label>
                        <a class="btn btn-inline btn-warning" id="delete_duplicate_sell_returns" href="<?php echo e(action([\App\Http\Controllers\SellReturnController::class, 'deleteDuplicateSellReturns']), false); ?>">
                        <i class="fa fa-cog"></i> <?php echo app('translator')->get('lang_v1.delete_duplicate_sell_returns'); ?></a>
                    </label>
                </div>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.sell_return')]); ?>
        <?php if(!empty($common_settings['enable_direct_sale_return'])): ?>    
            <?php if(auth()->user()->can('access_sell_return') || auth()->user()->can('access_direct_sell_return') || auth()->user()->can('access_own_sell_return') || auth()->user()->can('access_own_direct_sell_return')): ?>
                <?php $__env->slot('tool'); ?>
                    <div class="box-tools">
                        <a class="btn btn-block btn-primary"
                            href="<?php echo e(action([\App\Http\Controllers\SellReturnController::class, 'create']), false); ?>">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></a>
                    </div>
                <?php $__env->endSlot(); ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php echo $__env->make('sell_return.partials.sell_return_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->renderComponent(); ?>
    
</section>

<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dojo.refund_amount_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<script src="<?php echo e(asset('js/dojo_list_refund.js?v=' . $asset_v), false); ?>"></script>
<script>
    $(document).ready(function(){
        let date_range_default = $('#sell_return_filter_date_range').val();
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
        $('#sell_list_filter_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#sell_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                var dateRange = $('#sell_list_filter_date_range').val();
                $('#date_range').val(dateRange);
                sell_return_table.ajax.reload();
            }
        );
        $('#sell_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#sell_list_filter_date_range').val('');
            $('#date_range').val('');
            sell_return_table.ajax.reload();
        });

        <?php if(request()->filled('start_date') && request()->filled('end_date')): ?>
            $('#sell_list_filter_date_range').data('daterangepicker').setStartDate(moment('<?php echo e(request()->get('start_date'), false); ?>'));
            $('#sell_list_filter_date_range').data('daterangepicker').setEndDate(moment('<?php echo e(request()->get('end_date'), false); ?>'));
            $('#sell_list_filter_date_range').val(
                moment('<?php echo e(request()->get('start_date'), false); ?>').format(moment_date_format) + ' ~ ' +
                moment('<?php echo e(request()->get('end_date'), false); ?>').format(moment_date_format)
            );
        <?php endif; ?>

        var dateRange = $('#sell_list_filter_date_range').val();
        $('#date_range').val(dateRange);

        sell_return_table = $('#sell_return_table').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "75vh",
            scrollX: true,
            scrollCollapse: true,
            aaSorting: [[1, 'desc']],
            "ajax": {
                "url": "/sell-return",
                "data": function ( d ) {
                    if($('#sell_list_filter_date_range').val()) {
                        var start = $('#sell_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        var end = $('#sell_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        d.start_date = start;
                        d.end_date = end;
                    }

                    if($('#sell_list_filter_location_id').length) {
                        d.location_id = $('#sell_list_filter_location_id').val();
                    }
                    d.customer_id = $('#sell_list_filter_customer_id').val();

                    if($('#created_by').length) {
                        d.created_by = $('#created_by').val();
                    }
                    d.show_deleted = $('#show_deleted').is(':checked');
                    d.show_only_duplicates = $('#show_only_duplicates').is(':checked');
                }
            },
            columnDefs: [ {
                "targets": [0, 8],
                "orderable": false,
                "searchable": false
            } ],
            columns: [
                { data: 'action', name: 'action'},
                { data: 'transaction_date', name: 'transaction_date'  },
                { data: 'invoice_no', name: 'invoice_no'},
                { data: 'parent_sale', name: 'T1.invoice_no'},
                { data: 'name', name: 'contacts.name'},
                { data: 'payment_status', name: 'payment_status'},
                { data: 'final_total', name: 'final_total'},
                { data: 'payment_due', name: 'payment_due'},
                { data: 'business_location', name: 'bl.name'},
                { data: 'created_at', name: 'transactions.created_at'},
                { data: 'updated_at', name: 'transactions.updated_at'}
            ],
            "fnDrawCallback": function (oSettings) {
                __currency_convert_recursively($('#sell_return_table'));
                sell_return_table.columns.adjust();
            },
            "footerCallback": function(row, data, start, end, display) {
                var json = this.api().ajax.json();
                var footer_sell_return_total = json ? parseFloat(json.footer_total || 0) : 0;
                var footer_total_due = json ? parseFloat(json.footer_due || 0) : 0;
                $('.footer_sell_return_total').html(__currency_trans_from_en(footer_sell_return_total, true));
                $('.footer_payment_status_count_sr').html(__count_status(data, 'payment_status'));
                $('.footer_total_due_sr').html(__currency_trans_from_en(footer_total_due, true));
            },
            createdRow: function( row, data, dataIndex ) {
                $( row ).find('td:eq(3)').attr('class', 'clickable_td');
            }
        });
        $(window).on('resize', function() {
            if (sell_return_table) {
                sell_return_table.columns.adjust();
            }
        });

        $(document).on('change', '#sell_list_filter_location_id, #sell_list_filter_customer_id, #created_by',  function() {
            var location = $('select#sell_list_filter_location_id').find('option:selected').text();
            $('#business_location').val(location);
            sell_return_table.ajax.reload();
        });
        $(document).on('change', 'input#show_deleted', function(e) {
            sell_return_table.ajax.reload();
        });
        $(document).on('change', 'input#show_only_duplicates', function(e) {
            sell_return_table.ajax.reload();
        });
    })

    $(document).on('click', 'a.delete_sell_return', function(e) {
        e.preventDefault();
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).attr('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'DELETE',
                    url: href,
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            sell_return_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });
    $(document).on('click', 'a.restore_sell_return', function(e) {
        e.preventDefault();
        swal({
            title: LANG.sure,
            icon: 'info',
            buttons: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).attr('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'GET',
                    url: href,
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            sell_return_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });

    $(document).on('click', '#delete_duplicate_sell_returns', function(e){
        e.preventDefault();
        var loader = __fa_awesome();
        var btn = $(this);
        var btn_html = $(this).html();
        btn.html(loader); 
        btn.attr('disabled', true);
        
        $.ajax({
            url: $(this).attr('href'),
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    toastr.success(result.msg);
                    sell_return_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
                btn.html(btn_html); 
                btn.attr('disabled', false);
            },
        });
    });
</script>
	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>