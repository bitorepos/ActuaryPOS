<script type="text/javascript">
$(document).ready( function(){
<?php
    $show_fbr_invoice_no_column = !empty($fbr_enabled) || !empty($fbr_di_enabled);
?>
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
    function (start, end) {
        $('#sell_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
        var dateRange = $('#sell_list_filter_date_range').val();
        $('#date_range').val(dateRange);
        sell_table.ajax.reload();
    }
);

var sellListDatePicker = $('#sell_list_filter_date_range').data('daterangepicker');
if (date_range_default && sellListDatePicker) {
    $('#sell_list_filter_date_range').val(sellListDatePicker.startDate.format(moment_date_format) + ' ~ ' + sellListDatePicker.endDate.format(moment_date_format));
}

$('#sell_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
    $('#sell_list_filter_date_range').val('');
    $('#date_range').val('');
    sell_table.ajax.reload();
});

$('#sell_list_filter_start_time, #sell_list_filter_end_time').datetimepicker({
    format: 'HH:mm',
    ignoreReadonly: true,
}).on('focusout', function(ev){
    sell_table.ajax.reload();
});

var dateRange = $('#sell_list_filter_date_range').val();
$('#date_range').val(dateRange);

$(document).on('change', '#sell_list_filter_location_id, #sell_list_filter_customer_id, #sell_list_filter_customer_group_id, #sell_list_filter_payment_status, #created_by, #sales_cmsn_agnt, #service_staffs, #shipping_status, #table_id, #sell_list_filter_source, #tax_type, #station_type, #sell_list_filter_currency',  function() {
    var location = $('select#sell_list_filter_location_id').find('option:selected').text();
    $('#business_location').val(location);
    sell_table.ajax.reload();
});

sell_table = $('#sell_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [[1, 'desc']],
        scrollY: "75vh",
        scrollX:        true,
        scrollCollapse: true,
        "ajax": {
            "url": "/sells",
            "data": function ( d ) {
                var start_time = $('#sell_list_filter_start_time').val();
                var end_time = $('#sell_list_filter_end_time').val();
                
                if($('#sell_list_filter_date_range').val()) {
                    var start = $('#sell_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    start = moment(start + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                    var end = $('#sell_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    end = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');    
                    d.start_date = start;
                    d.end_date = end;
                }
                if ($('#is_direct_sale').length) {
                    d.is_direct_sale = $('#is_direct_sale').val();
                }

                if ($('#pos_sales_list').length) {
                    d.pos_sales_list = 1;
                }

                if($('#sell_list_filter_location_id').length) {
                    d.location_id = $('#sell_list_filter_location_id').val();
                }
                d.customer_id = $('#sell_list_filter_customer_id').val();
                d.customer_group_id = $('#sell_list_filter_customer_group_id').val();

                if($('#sell_list_filter_payment_status').length) {
                    d.payment_status = $('#sell_list_filter_payment_status').val();
                }
                if($('#created_by').length) {
                    d.created_by = $('#created_by').val();
                }
                if($('#sales_cmsn_agnt').length) {
                    d.sales_cmsn_agnt = $('#sales_cmsn_agnt').val();
                }
                if($('#service_staffs').length) {
                    d.service_staffs = $('#service_staffs').val();
                }

                if($('#shipping_status').length) {
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

                if($('#only_subscriptions').length && $('#only_subscriptions').is(':checked')) {
                    d.only_subscriptions = 1;
                }
                d.show_deleted = $('#show_deleted').is(':checked');
                d.show_sync_duplicates = $('#show_sync_duplicates').is(':checked');

                if($('#show_quotations').length && $('#show_quotations').is(':checked')) {
                    d.show_quotations = 1;
                }

                if ($('#only_takeaway').is(':checked')) {
                    d.only_takeaway = 1;
                }

                d = __datatable_ajax_callback(d);
            }
        },
        columns: [
            { data: 'action', name: 'action', orderable: false, "searchable": false},
            { data: 'transaction_date', name: 'transaction_date'  },
            { data: 'invoice_no', name: 'invoice_no'},
            <?php if($show_fbr_invoice_no_column): ?>
            { data: 'fbr_invoice_no', name: 'transactions.fbr_invoice_no'},
            <?php endif; ?>
            { data: 'ref_no', name: 'ref_no'},
            { data: 'conatct_name', name: 'conatct_name'},
            { data: 'mobile', name: 'contacts.mobile'},
            { data: 'payment_status', name: 'payment_status'},
            { data: 'payment_methods', orderable: false, "searchable": false},
            { data: 'final_total', name: 'final_total', className: 'text-right'},
            { data: 'total_paid', name: 'total_paid', "searchable": false, className: 'text-right'},
            { data: 'total_remaining', name: 'total_remaining', className: 'text-right'},
            { data: 'return_due', orderable: false, "searchable": false, className: 'text-right'},
            { data: 'shipping_details', name: 'shipping_details'},
            { data: 'shipping_status', name: 'shipping_status'},
            { data: 'total_items', name: 'total_items', "searchable": false, className: 'text-right'},
            { data: 'types_of_service_name', name: 'tos.name', <?php if(empty($is_types_service_enabled)): ?> visible: false <?php endif; ?>},
            { data: 'service_custom_field_1', name: 'service_custom_field_1', <?php if(empty($is_types_service_enabled)): ?> visible: false <?php endif; ?>},
            { data: 'additional_notes', name: 'additional_notes'},
            { data: 'staff_note', name: 'staff_note'},
            { data: 'table_name', name: 'tables.name', <?php if(empty($is_tables_enabled)): ?> visible: false <?php endif; ?> },
            { data: 'no_of_guests', name: 'no_of_guests', className: 'text-right', <?php if(empty($is_tables_enabled)): ?> visible: false <?php endif; ?> },
            { data: 'waiter', name: 'ss.first_name', <?php if(empty($is_service_staff_enabled)): ?> visible: false <?php endif; ?> },
            { data: 'added_by', name: 'u.first_name'},
            { data: 'station'},
            { data: 'business_location', name: 'bl.name'},
            { data: 'created_at', name: 'transactions.created_at'},
        ],
        "fnDrawCallback": function (oSettings) {
            __currency_convert_recursively($('#sell_table'));
        },
        "footerCallback": function ( row, data, start, end, display ) {
            var footer_sale_total = 0;
            var footer_total_paid = 0;
            var footer_total_remaining = 0;
            var footer_total_sell_return_due = 0;
            var footer_guest_total = 0;
            for (var r in data){
                footer_sale_total += $(data[r].final_total).data('orig-value') ? parseFloat($(data[r].final_total).data('orig-value')) : 0;
                footer_total_paid += $(data[r].total_paid).data('orig-value') ? parseFloat($(data[r].total_paid).data('orig-value')) : 0;
                footer_total_remaining += $(data[r].total_remaining).data('orig-value') ? parseFloat($(data[r].total_remaining).data('orig-value')) : 0;
                footer_total_sell_return_due += $(data[r].return_due).find('.sell_return_due').data('orig-value') ? parseFloat($(data[r].return_due).find('.sell_return_due').data('orig-value')) : 0;
                footer_guest_total += data[r].no_of_guests ? parseFloat(data[r].no_of_guests) : 0;
            }

            var show_currency_symbol = !$('#pos_sales_list').length;
            $('.footer_total_sell_return_due').html(__currency_trans_from_en(footer_total_sell_return_due, show_currency_symbol));
            $('.footer_total_remaining').html(__currency_trans_from_en(footer_total_remaining, show_currency_symbol));
            $('.footer_total_paid').html(__currency_trans_from_en(footer_total_paid, show_currency_symbol));
            $('.footer_sale_total').html(__currency_trans_from_en(footer_sale_total, show_currency_symbol));
            $('.footer_guest_count').html(footer_guest_total + ' Guests');
            $('.footer_payment_status_count').html(__count_status(data, 'payment_status'));
            $('.service_type_count').html(__count_status(data, 'types_of_service_name'));
            $('.payment_method_count').html(__count_status(data, 'payment_methods'));
        },
        createdRow: function( row, data, dataIndex ) {
            $( row ).find('td:eq(<?php echo e(5 + ($show_fbr_invoice_no_column ? 1 : 0), false); ?>)').attr('class', 'clickable_td');
        }
    });
    $(document).on('change', 'input#show_deleted', function(e) {
        sell_table.ajax.reload();
    });

    $(document).on('change', 'input#show_sync_duplicates', function(e) {
        sell_table.ajax.reload();
    });
    
    $('#only_subscriptions, #only_takeaway').on('change', function(event){
        sell_table.ajax.reload();
    });
    $('#show_quotations').on('change', function(event){
        sell_table.ajax.reload();
    });
});

</script>
