
<?php $__env->startSection('title', __( 'lang_v1.all_sales')); ?>
<?php
$user_settings = json_decode(auth()->user()->user_settings, true);
$show_fbr_invoice_no_column = !empty($fbr_enabled) || !empty($fbr_di_enabled);
?>
<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo app('translator')->get( 'sale.sells'); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
    <input type="hidden" id="business_location" value="">
    <input type="hidden" id="date_range" value="">
    <?php echo $__env->make('sell.partials.sell_list_filters', ['merge_station_with_source_filter' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if($fbr_enabled && empty($common_settings['disable_bulk_fbr_sync'])): ?>
    <div class="col-md-4">
        <div class="mb-3">
            <br>
            <label>
            <a class="btn btn-inline btn-warning" id="sync_pra_sales" href="<?php echo e(route('sells.syncPraSales'), false); ?>" data-confirm-text="<?php echo app('translator')->get('lang_v1.sync_pra_sales_confirm'); ?>">
            <i class="fa fa-sync"></i> <?php echo app('translator')->get('lang_v1.sync_pra_sales'); ?></a>
            </label>
            <p class="help-block"><?php echo app('translator')->get('lang_v1.fbr_pos_bulk_sync_unavailable'); ?></p>
        </div>
    </div>
    <?php endif; ?>
    <?php if(!empty($fbr_di_enabled)): ?>
    <div class="col-md-4">
        <div class="mb-3">
            <br>
            <label>
            <a class="btn btn-inline btn-info" id="sync_fbr_di_sales" href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'syncFbrDISales']), false); ?>" data-confirm-text="<?php echo app('translator')->get('lang_v1.sync_fbr_di_sales_confirm'); ?>">
            <i class="fa fa-cloud-upload-alt"></i> <?php echo app('translator')->get('lang_v1.sync_fbr_di_sales'); ?></a>
            </label>
        </div>
    </div>
    <?php endif; ?>
    <?php if(in_array('transactions_restoration', $enabled_modules)): ?>
        <div class="col-md-4">
            <div class="mb-3">
                <br>
                <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                </label>
            </div>
        </div>
    <?php endif; ?>
    <div class="col-md-4">
        <div class="mb-3">
            <br>
            <label class="form-check-label">
<?php echo Form::checkbox('show_sync_duplicates', 1, false, ['class' => 'form-check-input', 'id' => 'show_sync_duplicates']); ?> <strong><?php echo app('translator')->get('lang_v1.show_only_duplicates'); ?></strong>
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <br>
            <label>
        <a class="btn btn-inline btn-warning" id="delete_duplicate_sales" href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'deleteDuplicateSales']), false); ?>">
        <i class="fa fa-cog"></i> <?php echo app('translator')->get('lang_v1.delete_duplicate_sell_returns'); ?></a>
            </label>
        </div>
    </div>
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'lang_v1.all_sales')]); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('direct_sell.access')): ?>
    <?php $__env->slot('tool'); ?>
    <div class="box-tools">
        <a class="btn btn-inline btn-primary" href="<?php echo e(action([\App\Http\Controllers\SellController::class, 'create']), false); ?>">
            <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></a>
    </div>
    <?php $__env->endSlot(); ?>
    <?php endif; ?>
    <?php if(auth()->user()->can('direct_sell.view') || auth()->user()->can('view_own_sell_only') ||
    auth()->user()->can('view_commission_agent_sell')): ?>
    <?php
    $custom_labels = json_decode(session('business.custom_labels'), true);
    ?>
    <style>
        .dataTables_scrollHead{
    position: static !important;
}
    </style>
    <div class="table-responsive" style="min-height: 80vh">
<table class="table table-bordered table-striped ajax_view table-hover table-th-skin" id="sell_table">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('messages.action'); ?></th>
                <th><?php echo app('translator')->get('messages.date'); ?></th>
                <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                <?php if($show_fbr_invoice_no_column): ?>
                <th><?php echo app('translator')->get('sale.fbr_invoice_no'); ?></th>
                <?php endif; ?>
                <th><?php echo app('translator')->get('sale.ref_no'); ?></th>
                <th><?php echo app('translator')->get('sale.customer_name'); ?></th>
                <?php if(!empty($is_customer_note_enabled)): ?>
                <th><?php echo app('translator')->get('sale.customer_note'); ?></th>
                <?php endif; ?>
                <th><?php echo app('translator')->get('lang_v1.contact_no'); ?></th>
                <th><?php echo app('translator')->get('sale.payment_status'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.payment_terms'); ?></th>
                <th class="text-right"><?php echo app('translator')->get('sale.total_amount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <th class="text-right"><?php echo app('translator')->get('sale.total_paid'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <th class="text-right"><?php echo app('translator')->get('lang_v1.sell_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <th class="text-right"><?php echo app('translator')->get('lang_v1.sell_return_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <th><?php echo app('translator')->get('sale.shipping_details'); ?></th>
                <th class="text-right"><?php echo app('translator')->get('lang_v1.shipping_charges'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <th><?php echo app('translator')->get('lang_v1.shipping_status'); ?></th>
                <th class="text-right"><?php echo app('translator')->get('lang_v1.total_items'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.types_of_service'); ?></th>
                <th><?php echo e($custom_labels['types_of_service']['custom_field_1'] ?? __('lang_v1.service_custom_field_1' ), false); ?></th>
                <th><?php echo app('translator')->get('sale.sell_note'); ?></th>
                <th><?php echo app('translator')->get('sale.staff_note'); ?></th>
                <th><?php echo app('translator')->get('restaurant.table'); ?></th>
                <th class="text-right"><?php echo app('translator')->get('restaurant.no_of_guests'); ?></th>
                <th><?php echo app('translator')->get('restaurant.service_staff'); ?></th>
                <th><?php echo e($custom_labels['sell']['custom_field_1'] ?? 'Custom Label 1', false); ?></th>
                <th><?php echo e($custom_labels['sell']['custom_field_2'] ?? 'Custom Label 2', false); ?></th>
                <th><?php echo e($custom_labels['sell']['custom_field_3'] ?? 'Custom Label 3', false); ?></th>
                <th><?php echo e($custom_labels['sell']['custom_field_4'] ?? 'Custom Label 4', false); ?></th>
                <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.workstation'); ?></th>
                <th><?php echo app('translator')->get('sale.location'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.updated_at'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.created_at'); ?></th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr class="bg-gray font-17 footer-total text-center">
                <td colspan="<?php echo e((!empty($is_customer_note_enabled) ? 7 : 6) + ($show_fbr_invoice_no_column ? 1 : 0), false); ?>"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                <td class="footer_payment_status_count"></td>
                <td class="payment_method_count"></td>
                <td></td>
                <td class="footer_sale_total text-right"></td>
                <td class="footer_total_paid text-right"></td>
                <td class="footer_total_remaining text-right"></td>
                <td class="footer_total_sell_return_due text-right"></td>
                <td></td>
                <td class="footer_total_shipping text-right"></td>
                <td colspan="2"></td>
                <td class="service_type_count"></td>
                <td colspan="4"></td>
                <td class="footer_guest_count text-right"></td>
                <td colspan="10"></td>
            </tr>
        </tfoot>
    </table>
</div>
    <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

    

</section>
<!-- /.content -->

<!-- This will be printed -->
<!-- <section class="invoice print_section" id="receipt_section">
</section> -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('dojo.refund_amount_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('sale_pos.partials.change_invoice_layout_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/dojo_list_refund.js?v=' . $asset_v), false); ?>"></script>
<script type="text/javascript">
$(document).ready(function() {

    let date_range_default = $('#sale_filter_date_range').val();
    if(date_range_default == 'today'){
        dateRangeSettings.startDate = moment();
        dateRangeSettings.endDate = moment();
    }else if(date_range_default == 'yesterday'){
        dateRangeSettings.startDate = moment().subtract(1, 'days');
        dateRangeSettings.endDate = moment().subtract(1, 'days');
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
    }else if(date_range_default == 'current_financial_year' && typeof financial_year !== 'undefined'){
        dateRangeSettings.startDate = moment(financial_year.start);
        dateRangeSettings.endDate = moment(financial_year.end);
    }else if(date_range_default == 'all_time'){
        dateRangeSettings.startDate = moment(business_start_date);
        dateRangeSettings.endDate = moment();
    }
    
    //Date range as a button
    $('#sell_list_filter_date_range').daterangepicker(
        dateRangeSettings,
        function(start, end) {
            $('#sell_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(
                moment_date_format));
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

    <?php if(request()->filled('start_date') && request()->filled('end_date')): ?>
        $('#sell_list_filter_date_range').data('daterangepicker').setStartDate(moment('<?php echo e(request()->get('start_date'), false); ?>'));
        $('#sell_list_filter_date_range').data('daterangepicker').setEndDate(moment('<?php echo e(request()->get('end_date'), false); ?>'));
        $('#sell_list_filter_date_range').val(
            moment('<?php echo e(request()->get('start_date'), false); ?>').format(moment_date_format) + ' ~ ' +
            moment('<?php echo e(request()->get('end_date'), false); ?>').format(moment_date_format)
        );
    <?php endif; ?>

    <?php if(!request()->filled('start_date') || !request()->filled('end_date')): ?>
        var sellListDatePicker = $('#sell_list_filter_date_range').data('daterangepicker');
        if (date_range_default && sellListDatePicker) {
            $('#sell_list_filter_date_range').val(sellListDatePicker.startDate.format(moment_date_format) + ' ~ ' + sellListDatePicker.endDate.format(moment_date_format));
        }
    <?php endif; ?>

    $('#sell_list_filter_start_time, #sell_list_filter_end_time').datetimepicker({
            format: 'HH:mm',
            ignoreReadonly: true,
    }).on('focusout', function(ev){
        sell_table.ajax.reload();
    });

    var dateRange = $('#sell_list_filter_date_range').val();
    $('#date_range').val(dateRange);

    sell_table = $('#sell_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [
            [1, 'desc']
        ],
        "ajax": {
            "url": "/sells",
            "data": function(d) {
                var start_time = $('#sell_list_filter_start_time').val();
                var end_time = $('#sell_list_filter_end_time').val();
                
                if ($('#sell_list_filter_date_range').val()) {
                    var start = $('#sell_list_filter_date_range').data('daterangepicker').startDate
                        .format('YYYY-MM-DD');
                    start = moment(start + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                    var end = $('#sell_list_filter_date_range').data('daterangepicker').endDate
                        .format('YYYY-MM-DD');
                    end = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');    
                    d.start_date = start;
                    d.end_date = end;
                }
                d.is_direct_sale = 1;
                d.sells_sales_list = 1;

                d.location_id = $('#sell_list_filter_location_id').val();
                d.customer_id = $('#sell_list_filter_customer_id').val();
                d.customer_group_id = $('#sell_list_filter_customer_group_id').val();
                d.payment_status = $('#sell_list_filter_payment_status').val();
                d.created_by = $('#created_by').val();
                d.sales_cmsn_agnt = $('#sales_cmsn_agnt').val();
                d.service_staffs = $('#service_staffs').val();
                d.show_deleted = $('#show_deleted').is(':checked');
                d.show_sync_duplicates = $('#show_sync_duplicates').is(':checked');

                if ($('#shipping_status').length) {
                    d.shipping_status = $('#shipping_status').val();
                }

                if ($('#tax_type').length) {
                    d.tax_type = $('#tax_type').val();
                }

                if ($('#station_type').length) {
                    d.station_type = $('#station_type').val();
                }

                if ($('#sell_list_filter_currency').length) {
                    d.currency_filter = $('#sell_list_filter_currency').val();
                }

                if ($('#table_id').length) {
                    d.table_id = $('#table_id').val();
                }

                if ($('#sell_list_filter_source').length) {
                    var source_filter = $('#sell_list_filter_source').val();
                    if (source_filter && source_filter.indexOf('station:') === 0) {
                        d.station_type = source_filter.replace('station:', '');
                    } else {
                        d.source = source_filter;
                    }
                }

                if ($('#only_subscriptions').is(':checked')) {
                    d.only_subscriptions = 1;
                }

                if ($('#only_takeaway').is(':checked')) {
                    d.only_takeaway = 1;
                }

                d = __datatable_ajax_callback(d);
            }
        },
        scrollY: "100vh",
        scrollX: true,
        scrollCollapse: true,
        columns: [{
                data: 'action',
                name: 'action',
                orderable: false,
                "searchable": false
            },
            {
                data: 'transaction_date',
                name: 'transaction_date'
            },
            {
                data: 'invoice_no',
                name: 'invoice_no',
                <?php if(!empty($user_settings['sale_index_hide_invoice_no'])): ?> visible: false, <?php endif; ?>
            },
            <?php if($show_fbr_invoice_no_column): ?>
            {
                data: 'fbr_invoice_no',
                name: 'transactions.fbr_invoice_no',
            },
            <?php endif; ?>
            {
                data: 'ref_no',
                name: 'ref_no',
                <?php if(!empty($user_settings['sale_index_hide_ref_no'])): ?> visible: false, <?php endif; ?>
            },
            {
                data: 'conatct_name',
                name: 'conatct_name',
                <?php if(!empty($user_settings['sale_index_hide_customer_name'])): ?> visible: false, <?php endif; ?>
            },
            <?php if(!empty($is_customer_note_enabled)): ?>
            {
                data: 'customer_note',
                name: 'customer_note',
            },
            <?php endif; ?>
            {
                data: 'mobile',
                name: 'contacts.mobile',
                <?php if(!empty($user_settings['sale_index_hide_contact_no'])): ?> visible: false, <?php endif; ?>
            },
            
            {
                data: 'payment_status',
                name: 'payment_status',
                <?php if(!empty($user_settings['sale_index_hide_payment_status'])): ?> visible: false, <?php endif; ?>
            },
            {
                data: 'payment_methods',
                orderable: false,
                "searchable": false,
                <?php if(!empty($user_settings['sale_index_hide_payment_method'])): ?> visible: false, <?php endif; ?>
            },
            {
                data: 'pay_term',
                <?php if(!empty($user_settings['sale_index_hide_payment_terms'])): ?> visible: false, <?php endif; ?>
            },
            {
                data: 'final_total',
                name: 'final_total',
                className: 'text-right',
                <?php if(!empty($user_settings['sale_index_hide_total_amount'])): ?> visible: false, <?php endif; ?>
            },
            {
                data: 'total_paid',
                name: 'total_paid',
                "searchable": false,
                className: 'text-right',
                <?php if(!empty($user_settings['sale_index_hide_total_paid'])): ?> visible: false, <?php endif; ?>
            },
            {
                data: 'total_remaining',
                name: 'total_remaining',
                className: 'text-right',
                <?php if(!empty($user_settings['sale_index_hide_sell_due'])): ?> visible: false, <?php endif; ?>
            },
            {
                data: 'return_due',
                orderable: false,
                "searchable": false,
                className: 'text-right',
                <?php if(!empty($user_settings['sale_index_hide_sell_return_due'])): ?> visible: false, <?php endif; ?>
            },
            {
                data: 'shipping_details',
                name: 'shipping_details',
                <?php if(!empty($user_settings['sale_index_hide_shipping_details'])): ?> visible: false, <?php endif; ?>
            },
            {
                data: 'shipping_charges',
                name: 'shipping_charges',
                className: 'text-right',
                <?php if(!empty($user_settings['sale_index_hide_shipping_details'])): ?> visible: false, <?php endif; ?>
            },
            {
                data: 'shipping_status',
                name: 'shipping_status',
                <?php if(!empty($user_settings['sale_index_hide_shipping_status'])): ?> visible: false, <?php endif; ?>
            },
            {
                data: 'total_items',
                name: 'total_items',
                "searchable": false,
                className: 'text-right',
                <?php if(!empty($user_settings['sale_index_hide_total_items'])): ?> visible: false, <?php endif; ?>
            },
            {
                data: 'types_of_service_name',
                name: 'tos.name',
                <?php if(empty($is_types_service_enabled) || !empty($user_settings['sale_index_hide_types_of_service'])): ?> visible: false <?php endif; ?>
            },
            {
                data: 'service_custom_field_1',
                name: 'service_custom_field_1',
                <?php if(empty($is_types_service_enabled)): ?> visible: false <?php endif; ?>
            },
            {
                data: 'additional_notes',
                name: 'additional_notes',
                <?php if(!empty($user_settings['sale_index_hide_sell_note'])): ?> visible: false, <?php endif; ?>
            },
            {
                data: 'staff_note',
                name: 'staff_note',
                <?php if(!empty($user_settings['sale_index_hide_staff_note'])): ?> visible: false, <?php endif; ?>
            },
            
            {
                data: 'table_name',
                name: 'tables.name',
                <?php if(empty($is_tables_enabled) || !empty($user_settings['sale_index_hide_table'])): ?> visible: false <?php endif; ?>
            },
            {
                data: 'no_of_guests',
                name: 'no_of_guests',
                className: 'text-right',
                <?php if(empty($is_tables_enabled)): ?> visible: false <?php endif; ?>
            },
            {
                data: 'waiter',
                name: 'ss.first_name',
                <?php if(empty($is_service_staff_enabled) || !empty($user_settings['sale_index_hide_service_staff'])): ?> visible: false <?php endif; ?>
            },
            {
                data: 'custom_field_1',
                name: 'transactions.custom_field_1',
                <?php if(empty($custom_labels['sell']['custom_field_1'])): ?> visible: false <?php endif; ?>
            },
            {
                data: 'custom_field_2',
                name: 'transactions.custom_field_2',
                <?php if(empty($custom_labels['sell']['custom_field_2'])): ?> visible: false <?php endif; ?>
            },
            {
                data: 'custom_field_3',
                name: 'transactions.custom_field_3',
                <?php if(empty($custom_labels['sell']['custom_field_3'])): ?> visible: false <?php endif; ?>
            },
            {
                data: 'custom_field_4',
                name: 'transactions.custom_field_4',
                <?php if(empty($custom_labels['sell']['custom_field_4'])): ?> visible: false <?php endif; ?>
            },
            {
                data: 'added_by',
                name: 'u.first_name',
                <?php if(!empty($user_settings['sale_index_hide_added_by'])): ?> visible: false, <?php endif; ?>
            },
            {
                data: 'station',
                <?php if(!empty($user_settings['sale_index_hide_workstation'])): ?> visible: false, <?php endif; ?>
            },
            {
                data: 'business_location',
                name: 'bl.name',
                <?php if(!empty($user_settings['sale_index_hide_location'])): ?> visible: false, <?php endif; ?>
            },
            {
                data: 'updated_at',
                name: 'transactions.updated_at',
            },
            {
                data: 'created_at',
                name: 'transactions.created_at',
            }
            
        ],
        "fnDrawCallback": function(oSettings) {
            __currency_convert_recursively($('#sell_table'));
            // $('.dataTables_processing').addClass('content-wrapper');/
        },
        "footerCallback": function(row, data, start, end, display) {
            var footer_sale_total = 0;
            var footer_total_paid = 0;
            var footer_total_remaining = 0;
            var footer_total_sell_return_due = 0;
            var footer_guest_total = 0;
            var footer_total_shipping = 0;
            for (var r in data) {
                footer_sale_total += $(data[r].final_total).data('orig-value') ? parseFloat($(data[
                    r].final_total).data('orig-value')) : 0;
                footer_total_paid += $(data[r].total_paid).data('orig-value') ? parseFloat($(data[r]
                    .total_paid).data('orig-value')) : 0;
                footer_total_remaining += $(data[r].total_remaining).data('orig-value') ?
                    parseFloat($(data[r].total_remaining).data('orig-value')) : 0;
                footer_total_sell_return_due += $(data[r].return_due).find('.sell_return_due').data(
                    'orig-value') ? parseFloat($(data[r].return_due).find('.sell_return_due')
                    .data('orig-value')) : 0;
                footer_total_shipping += $(data[r].shipping_charges).data('orig-value') ? parseFloat($(data[r].shipping_charges).data('orig-value')) : 0;
                footer_guest_total += data[r].no_of_guests ? parseFloat(data[r].no_of_guests) : 0;
            }
            $('.footer_total_sell_return_due').html(__currency_trans_from_en(
                footer_total_sell_return_due, false));
            $('.footer_total_remaining').html(__currency_trans_from_en(footer_total_remaining, false));
            $('.footer_total_paid').html(__currency_trans_from_en(footer_total_paid, false));
            $('.footer_sale_total').html(__currency_trans_from_en(footer_sale_total, false));
            $('.footer_total_shipping').html(__currency_trans_from_en(footer_total_shipping, false));

            $('.footer_payment_status_count').html(__count_status(data, 'payment_status'))
            $('.footer_guest_count').html(footer_guest_total + ' Guests');
            $('.service_type_count').html(__count_status(data, 'types_of_service_name'));
            $('.payment_method_count').html(__count_status(data, 'payment_methods'));
        },
        createdRow: function(row, data, dataIndex) {
            $(row).find('td:eq(<?php echo e(5 + ($show_fbr_invoice_no_column ? 1 : 0) + (!empty($is_customer_note_enabled) ? 1 : 0), false); ?>)').attr('class', 'clickable_td');
        }
    });

    $(document).on('change', 'input#show_deleted', function(e) {
        sell_table.ajax.reload();
    });

    $(document).on('change', 'input#show_sync_duplicates', function(e) {
        sell_table.ajax.reload();
    });

    $(document).on('click', '#delete_duplicate_sales', function(e){
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
                    sell_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
                btn.html(btn_html); 
                btn.attr('disabled', false);
            },
        });
    })

    $(document).on('change',
        '#sell_list_filter_location_id, #sell_list_filter_customer_id, #sell_list_filter_customer_group_id, #sell_list_filter_payment_status, #created_by, #sales_cmsn_agnt, #service_staffs, #shipping_status, #table_id, #sell_list_filter_source, #tax_type, #station_type, #sell_list_filter_currency',
        function() {
            var location = $('select#sell_list_filter_location_id').find('option:selected').text();
            $('#business_location').val(location);
            sell_table.ajax.reload();
        });

    $('#only_subscriptions, #only_takeaway').on('change', function(event) {
        sell_table.ajax.reload();
    });

    $(document).on('submit', 'form#change_sell_location_form', function(e) {
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();
        var submit_button = form.find('button[type="submit"]');
        submit_button.attr('disabled', true);

        $.ajax({
            method: 'PUT',
            url: form.attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success) {
                    $('div.view_modal').modal('hide');
                    toastr.success(result.msg);
                    sell_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            },
            error: function() {
                toastr.error(LANG.something_went_wrong);
            },
            complete: function() {
                submit_button.attr('disabled', false);
            },
        });
    });

    $(document).on('click', '#sync_pra_sales, #sync_fbr_di_sales', function(e){
        e.preventDefault();
        var loader = __fa_awesome();
        var btn = $(this);
        var btn_html = $(this).html();
        var confirm_text = btn.data('confirm-text') || 'This will submit all not submitted sales.';
        btn.html(loader); 
        btn.attr('disabled', true);

        var start_time = $('#sell_list_filter_start_time').val();
        var end_time = $('#sell_list_filter_end_time').val();
        var start = null;
        var end = null;
        
        if($('#sell_list_filter_date_range').val()) {
            start = $('#sell_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
            start = moment(start + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
            end = $('#sell_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
            end = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');    
        }
        
        swal({
            title: LANG.sure,
            text: confirm_text,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willContinue => {
            if (willContinue) {
                $.ajax({
                    url: $(this).attr('href'),
                    data: {
                        start_date : start,
                        end_date : end
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success) {
                            toastr.success(result.msg);
                        } else {
                            toastr.error(result.msg);
                        }
                        btn.html(btn_html); 
                        btn.attr('disabled', false);
                    },
                    error: function() {
                        toastr.error(LANG.something_went_wrong);
                        btn.html(btn_html);
                        btn.attr('disabled', false);
                    },
                });
            } else {
                btn.html(btn_html); 
                btn.attr('disabled', false);
            }
        });
    });
});
</script>
<script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>