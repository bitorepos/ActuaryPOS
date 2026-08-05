
<?php $__env->startSection('title', __('lang_v1.purchase_return')); ?>

<?php $__env->startSection('content'); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header no-print">
        <h1><?php echo app('translator')->get('lang_v1.purchase_return'); ?>
        </h1>
    </section>
    <?php
    // Phase 71: prefer controller-supplied per-branch common_settings; session is the fallback.
    $common_settings = isset($common_settings) && ! empty($common_settings)
        ? $common_settings
        : session()->get('business.common_settings');
    ?>
    <!-- Main content -->
    <section class="content no-print">
        <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <input type="hidden" id="business_location" value="">
            <input type="hidden" id="date_range" value="">
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('purchase_list_filter_location_id', __('purchase.business_location') . ':'); ?>

                    <?php echo Form::select('purchase_list_filter_location_id', $business_locations, request()->get('location_id'), [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'placeholder' => __('lang_v1.all'),
                    ]); ?>

                </div>
            </div>
            <?php
                $date_loc = array_key_first($date_settings);
            ?>
            <?php if(!empty($date_settings[$date_loc]['purchase_return_filter_date_range'])): ?>
                <?php echo Form::hidden('purchase_return_filter_date_range', $date_settings[$date_loc]['purchase_return_filter_date_range'], ['id'=>'purchase_return_filter_date_range']); ?>

            <?php endif; ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('purchase_list_filter_date_range', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('purchase_list_filter_date_range', null, [
                        'placeholder' => __('lang_v1.select_a_date_range'),
                        'class' => 'form-control',
                        'readonly',
                    ]); ?>

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
        <?php echo $__env->renderComponent(); ?>
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.all_purchase_returns')]); ?>
            <?php if(!$is_offline): ?>
            <?php if(!empty($common_settings['enable_direct_purchase_return'])): ?>    
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase_returns.create')): ?>
                    <?php $__env->slot('tool'); ?>
                        <div class="box-tools">
                            <a class="btn btn-block btn-primary"
                                href="<?php echo e(action([\App\Http\Controllers\CombinedPurchaseReturnController::class, 'create']), false); ?>">
                                <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></a>
                        </div>
                    <?php $__env->endSlot(); ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase.view')): ?>
                <?php echo $__env->make('purchase_return.partials.purchase_return_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php echo $__env->renderComponent(); ?>

        

    </section>

    <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
    <script>
        $(document).ready(function() {
            let date_range_default = $('#purchase_return_filter_date_range').val();
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

            $('#purchase_list_filter_date_range').daterangepicker(
                dateRangeSettings,
                function(start, end) {
                    $('#purchase_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end
                        .format(moment_date_format));
                    var dateRange = $('#purchase_list_filter_date_range').val();
                    $('#date_range').val(dateRange);
                    purchase_return_table.ajax.reload();
                }
            );
            $('#purchase_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#purchase_list_filter_date_range').val('');
                $('#date_range').val('');
                purchase_return_table.ajax.reload();
            });

            <?php if(request()->filled('start_date') && request()->filled('end_date')): ?>
                $('#purchase_list_filter_date_range').data('daterangepicker').setStartDate(moment('<?php echo e(request()->get('start_date'), false); ?>'));
                $('#purchase_list_filter_date_range').data('daterangepicker').setEndDate(moment('<?php echo e(request()->get('end_date'), false); ?>'));
                $('#purchase_list_filter_date_range').val(
                    moment('<?php echo e(request()->get('start_date'), false); ?>').format(moment_date_format) + ' ~ ' +
                    moment('<?php echo e(request()->get('end_date'), false); ?>').format(moment_date_format)
                );
            <?php endif; ?>

            //Purchase table
            purchase_return_table = $('#purchase_return_datatable').DataTable({
                processing: true,
                serverSide: true,
                scrollY: "75vh",
                scrollX: true,
                scrollCollapse: true,
                aaSorting: [
                    [0, 'desc']
                ],
                ajax: {
                    url: '/purchase-return',
                    data: function(d) {
                        if ($('#purchase_list_filter_location_id').length) {
                            d.location_id = $('#purchase_list_filter_location_id').val();
                        }

                        var start = '';
                        var end = '';
                        if ($('#purchase_list_filter_date_range').val()) {
                            start = $('input#purchase_list_filter_date_range')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            end = $('input#purchase_list_filter_date_range')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                        }
                        d.start_date = start;
                        d.end_date = end;
                        d.show_deleted = $('#show_deleted').is(':checked');
                        d.purchase_return_list = 1;
                    },
                },
                columnDefs: [{
                    "targets": [7, 8],
                    "orderable": false,
                    "searchable": false
                }],
                columns: [{
                        data: 'transaction_date',
                        name: 'transaction_date'
                    },
                    {
                        data: 'ref_no',
                        name: 'ref_no'
                    },
                    {
                        data: 'parent_purchase',
                        name: 'T.ref_no'
                    },
                    
                    {
                        data: 'name',
                        name: 'contacts.name'
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status'
                    },
                    {
                        data: 'final_total',
                        name: 'final_total',
                        className: 'text-right'
                    },
                    {
                        data: 'payment_due',
                        name: 'payment_due',
                        className: 'text-right'
                    },
                    {
                        data: 'location_name',
                        name: 'BS.name'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                "fnDrawCallback": function(oSettings) {
                    $('#footer_payment_status_count').html(__sum_status_html($(
                        '#purchase_return_datatable'), 'payment-status-label'));

                    __currency_convert_recursively($('#purchase_return_datatable'));
                },
                "footerCallback": function(row, data, start, end, display) {
                    var json = this.api().ajax.json();
                    var footer_purchase_total = json ? parseFloat(json.footer_total || 0) : 0;
                    var footer_total_due = json ? parseFloat(json.footer_due || 0) : 0;
                    $('#footer_purchase_return_total').html(__currency_trans_from_en(footer_purchase_total, false));
                    $('#footer_total_due').html(__currency_trans_from_en(footer_total_due, false));
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).find('td:eq(5)').addClass('clickable_td');
                }
            });

            $(document).on(
                'change',
                '#purchase_list_filter_location_id',
                function() {
                    var location = $('select#purchase_list_filter_location_id').find('option:selected').text();
                    $('#business_location').val(location);
                    purchase_return_table.ajax.reload();
                }
            );

            $(document).on('change', 'input#show_deleted', function(e) {
                purchase_return_table.ajax.reload();
            });

            var dateRange = $('#purchase_list_filter_date_range').val();
            $('#date_range').val(dateRange);
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>