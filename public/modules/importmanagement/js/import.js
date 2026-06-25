/**
 * Import Management Module - Main JS
 * Handles DataTable initialization on index page and shared behaviors
 */
$(document).ready(function () {

    // ---- Index Page: DataTable ----
    if ($('#imports_table').length) {
        var imports_table = $('#imports_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: $('#imports_table').data('url') || '/import-management',
                data: function (d) {
                    d.location_id = $('#import_list_filter_location').val();
                    d.supplier_id = $('#import_list_filter_supplier').val();
                    d.status      = $('#import_list_filter_status').val();
                    d.start_date  = $('#import_list_filter_date_range').data('daterangepicker')
                        ? $('#import_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD')
                        : '';
                    d.end_date    = $('#import_list_filter_date_range').data('daterangepicker')
                        ? $('#import_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD')
                        : '';
                }
            },
            columns: [
                { data: 'import_date', name: 'import_date' },
                { data: 'import_ref_no', name: 'import_ref_no' },
                { data: 'contact_name', name: 'contacts.name' },
                { data: 'location_name', name: 'bl.name' },
                { data: 'status', name: 'status' },
                { data: 'total_items_cost_base', name: 'total_items_cost_base' },
                { data: 'total_charges', name: 'total_charges' },
                { data: 'total_landed_cost', name: 'total_landed_cost' },
                { data: 'final_total', name: 'final_total' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            order: [[0, 'desc']],
            fnDrawCallback: function () {
                __currency_convert_recursively($('#imports_table'));
            }
        });

        // Filter button click
        $(document).on('click', '#import_list_filter_btn', function () {
            imports_table.ajax.reload();
        });

        // Clear filter
        $(document).on('click', '#import_list_clear_filter', function () {
            $('#import_list_filter_location, #import_list_filter_supplier, #import_list_filter_status').val('').trigger('change');
            $('#import_list_filter_date_range').val('');
            imports_table.ajax.reload();
        });

        // Delete import
        $(document).on('click', '.delete_import', function (e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                text: LANG.confirm_delete_import || 'This import will be deleted permanently.',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(function (willDelete) {
                if (willDelete) {
                    var href = $(e.target).closest('a').attr('href') || $(e.target).closest('a').data('href');
                    $.ajax({
                        url: href,
                        method: 'DELETE',
                        dataType: 'json',
                        success: function (result) {
                            if (result.success) {
                                toastr.success(result.msg);
                                imports_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });
        });

        // Receive stock modal
        $(document).on('click', '.receive_import_stock', function (e) {
            e.preventDefault();
            var url = $(this).data('href') || $(this).attr('href');
            $.ajax({
                url: url,
                success: function (html) {
                    $('div.import_receive_modal').html(html).modal('show');
                }
            });
        });

        // Update status
        $(document).on('click', '.update_import_status', function (e) {
            e.preventDefault();
            var href   = $(this).data('href') || $(this).attr('href');
            var status = $(this).data('status');
            swal({
                title: LANG.sure,
                text: 'Update status to: ' + status + '?',
                icon: 'info',
                buttons: true,
            }).then(function (confirm) {
                if (confirm) {
                    $.ajax({
                        url: href,
                        method: 'POST',
                        data: { status: status },
                        dataType: 'json',
                        success: function (result) {
                            if (result.success) {
                                toastr.success(result.msg);
                                imports_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });
        });
    }
});
