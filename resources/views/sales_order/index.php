
<?php $__env->startSection('title', __( 'lang_v1.sales_order')); ?>
<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo app('translator')->get('lang_v1.sales_order'); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <input type="hidden" id="business_location" value="">
    <input type="hidden" id="date_range" value="">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('sell_list_filter_location_id',  __('purchase.business_location') . ':'); ?>


                <?php echo Form::select('sell_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('sell_list_filter_customer_id',  __('contact.customer') . ':'); ?>

                <?php echo Form::select('sell_list_filter_customer_id', $customers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('so_list_filter_status',  __('sale.status') . ':'); ?>

                <?php echo Form::select('so_list_filter_status', $sales_order_statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <?php if(!empty($shipping_statuses)): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('so_list_shipping_status', __('lang_v1.shipping_status') . ':'); ?>

                    <?php echo Form::select('so_list_shipping_status', $shipping_statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('sell_list_filter_date_range', __('report.date_range') . ':'); ?>

                <?php echo Form::text('sell_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

            </div>
        </div>
        
            <div class="col-md-3">
                <div class="mb-3">
                    <br>
                    <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                    </label>
                </div>
            </div>
        
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('so.create')): ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <a class="btn btn-block btn-primary" href="<?php echo e(action([\App\Http\Controllers\SellController::class, 'create']), false); ?>?sale_type=sales_order">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('lang_v1.add_sales_order'); ?></a>
                </div>
            <?php $__env->endSlot(); ?>
        <?php endif; ?>
        <?php if( auth()->user()->can('so.view_own') || auth()->user()->can('so.view_all')): ?>
        <div class="table-responsive" style="min-height: 80vh">
            <?php
                $custom_labels = json_decode(session('business.custom_labels'), true);
                $custom_field_1_label = !empty($custom_labels['sell']['custom_field_1']) ? $custom_labels['sell']['custom_field_1'] : '';
                $custom_field_2_label = !empty($custom_labels['sell']['custom_field_2']) ? $custom_labels['sell']['custom_field_2'] : '';
                $custom_field_3_label = !empty($custom_labels['sell']['custom_field_3']) ? $custom_labels['sell']['custom_field_3'] : '';
                $custom_field_4_label = !empty($custom_labels['sell']['custom_field_4']) ? $custom_labels['sell']['custom_field_4'] : '';
            ?>
            <div class="table-responsive" style="min-height: 80vh">
<table class="table table-bordered table-striped ajax_view table-th-skin" id="sell_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                        <th><?php echo app('translator')->get('restaurant.order_no'); ?></th>
                        <th><?php echo app('translator')->get('sale.customer_name'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.contact_no'); ?></th>
                        <th><?php echo app('translator')->get('sale.status'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.shipping_status'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.quantity_remaining'); ?></th>
                        <?php if(!empty($custom_field_1_label)): ?>
                            <th id="custom_label_1"><?php echo e($custom_field_1_label, false); ?></th>
                        <?php endif; ?>
                        <?php if(!empty($custom_field_2_label)): ?>
                            <th id="custom_label_2"><?php echo e($custom_field_2_label, false); ?></th>
                        <?php endif; ?>
                        <?php if(!empty($custom_field_3_label)): ?>
                            <th id="custom_label_3"><?php echo e($custom_field_3_label, false); ?></th>
                        <?php endif; ?>
                        <?php if(!empty($custom_field_4_label)): ?>
                            <th id="custom_label_4"><?php echo e($custom_field_4_label, false); ?></th>
                        <?php endif; ?>
                        <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                        <th><?php echo app('translator')->get('sale.location'); ?></th>
                    </tr>
                </thead>
            </table>
</div>
        </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="modal fade edit_pso_status_modal" tabindex="-1" role="dialog"></div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php if ($__env->exists('sales_order.common_js')) echo $__env->make('sales_order.common_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
$(document).ready( function(){
    $('#sell_list_filter_date_range').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#sell_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            var dateRange = $('#sell_list_filter_date_range').val();
            $('#date_range').val(dateRange);
            sell_table.ajax.reload();
        }
    );
    $('#sell_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#sell_list_filter_date_range').val('');
        $('#date_range').val('');
        sell_table.ajax.reload();
    });

    var dateRange = $('#sell_list_filter_date_range').val();
    $('#date_range').val(dateRange);

    var columns = [
        { data: 'action', name: 'action' },
        { data: 'transaction_date', name: 'transaction_date' },
        { data: 'invoice_no', name: 'invoice_no' },
        { data: 'conatct_name', name: 'conatct_name' },
        { data: 'mobile', name: 'contacts.mobile' },
        { data: 'status', name: 'status' },
        { data: 'shipping_status', name: 'shipping_status' },
        { data: 'so_qty_remaining', name: 'so_qty_remaining', "searchable": false }
    ];

    if ($('#custom_label_1').length) {
        columns.push({ data: 'custom_field_1', name: 'transactions.custom_field_1', searchable: true });
    }
    if ($('#custom_label_2').length) {
        columns.push({ data: 'custom_field_2', name: 'transactions.custom_field_2' });
    }
    if ($('#custom_label_3').length) {
        columns.push({ data: 'custom_field_3', name: 'transactions.custom_field_3' });
    }
    if ($('#custom_label_4').length) {
        columns.push({ data: 'custom_field_4', name: 'transactions.custom_field_4' });
    }

    columns.push(
        { data: 'added_by', name: 'u.first_name' },
        { data: 'business_location', name: 'bl.name' }
    );

    sell_table = $('#sell_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [[1, 'desc']],
        "ajax": {
            "url": '/sells?sale_type=sales_order',
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

                if ($('#so_list_filter_status').length) {
                    d.status = $('#so_list_filter_status').val();
                }
                if ($('#so_list_shipping_status').length) {
                    d.shipping_status = $('#so_list_shipping_status').val();
                }

                if($('#created_by').length) {
                    d.created_by = $('#created_by').val();
                }
                d.show_deleted = $('#show_deleted').is(':checked');
            }
        },
        columnDefs: [ {
            "targets": 7,
            "orderable": false,
            "searchable": false
        } ],
        // columns: [
        //     { data: 'action', name: 'action'},
        //     { data: 'transaction_date', name: 'transaction_date'  },
        //     { data: 'invoice_no', name: 'invoice_no'},
        //     { data: 'conatct_name', name: 'conatct_name'},
        //     { data: 'mobile', name: 'contacts.mobile'},
        //     { data: 'status', name: 'status'},
        //     { data: 'shipping_status', name: 'shipping_status'},
        //     { data: 'so_qty_remaining', name: 'so_qty_remaining', "searchable": false},
        //     { data: 'custom_field_1', name: 'custom_field_1'},
        //     { data: 'custom_field_2', name: 'custom_field_2'},
        //     { data: 'custom_field_3', name: 'custom_field_3'},
        //     { data: 'custom_field_4', name: 'custom_field_4'},
        //     { data: 'added_by', name: 'u.first_name'},
        //     { data: 'business_location', name: 'bl.name'},
        // ]
        columns: columns,
    });
    $(document).on('change', '#sell_list_filter_location_id, #sell_list_filter_customer_id, #created_by, #so_list_filter_status, #so_list_shipping_status',  function() {
        var location = $('select#sell_list_filter_location_id').find('option:selected').text();
        $('#business_location').val(location);
        sell_table.ajax.reload();
    });
    $(document).on('change', 'input#show_deleted', function(e) {
        sell_table.ajax.reload();
    });
});
</script>
	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>