
<?php $__env->startSection('title', __( 'lang_v1.quotation')); ?>
<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo app('translator')->get('lang_v1.list_quotations'); ?>
        <small></small>
    </h1>
</section>

<!-- Main content -->
<section class="content no-print">
        <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <input type="hidden" id="business_location" value="">
        <input type="hidden" id="date_range" value="">
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
                <?php echo Form::label('created_by',  __('report.user') . ':'); ?>

                <?php echo Form::select('created_by', $sales_representative, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('status',  __('lang_v1.status') . ':'); ?>

                <?php echo Form::select('status', $draft_statuses, null, ['class' => 'form-control select2','id'=>'draft_status', 'placeholder'=> __('lang_v1.all'), 'style' => 'width:100%']); ?>

            </div>
        </div>
        <?php
            $date_loc = array_key_first($date_settings);
        ?>
        <?php if(!empty($date_settings[$date_loc]['sale_filter_date_range'])): ?>
            <?php echo Form::hidden('sale_filter_date_range', $date_settings[$date_loc]['sale_filter_date_range'], ['id'=>'sale_filter_date_range']); ?>

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
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <a class="btn btn-block btn-primary" href="<?php echo e(action([\App\Http\Controllers\SellController::class, 'create'], ['status' => 'quotation']), false); ?>">
                <i class="fa fa-plus"></i> <?php echo app('translator')->get('lang_v1.add_quotation'); ?></a>
            </div>
        <?php $__env->endSlot(); ?>
        <?php
        $custom_labels = json_decode(session('business.custom_labels'), true);
        ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped ajax_view table-th-skin" id="sell_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                        <th><?php echo app('translator')->get('sale.ref_no'); ?></th>
                        <th><?php echo app('translator')->get('sale.customer_name'); ?></th>
                        <?php if(!empty($is_customer_note_enabled)): ?>
                        <th><?php echo app('translator')->get('sale.customer_note'); ?></th>
                        <?php endif; ?>
                        <th><?php echo app('translator')->get('lang_v1.contact_no'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.status'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.total_items'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('sale.total_amount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                        <?php if(!empty($custom_labels['sell']['custom_field_1'])): ?>
                        <th><?php echo e($custom_labels['sell']['custom_field_1'] ?? 'Custom Label 1', false); ?></th>
                        <?php endif; ?>
                        <?php if(!empty($custom_labels['sell']['custom_field_2'])): ?>
                        <th><?php echo e($custom_labels['sell']['custom_field_2'] ?? 'Custom Label 2', false); ?></th>
                        <?php endif; ?>
                        <?php if(!empty($custom_labels['sell']['custom_field_3'])): ?>
                        <th><?php echo e($custom_labels['sell']['custom_field_3'] ?? 'Custom Label 3', false); ?></th>
                        <?php endif; ?>
                        <?php if(!empty($custom_labels['sell']['custom_field_4'])): ?>
                        <th><?php echo e($custom_labels['sell']['custom_field_4'] ?? 'Custom Label 4', false); ?></th>
                        <?php endif; ?>
                        <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                        <th><?php echo app('translator')->get('sale.location'); ?></th>
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
    let date_range_default = $('#sale_filter_date_range').val();
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
    }else if(date_range_default == 'this_year'){
        dateRangeSettings.startDate = moment().startOf('year');
        dateRangeSettings.endDate = moment();
    }else if(date_range_default == 'current_financial_year'){
        // dateRangeSettings.startDate = moment();
        // dateRangeSettings.endDate = moment();
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
    $('#sell_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#date_range').val('');
        $('#sell_list_filter_date_range').val('');
        sell_table.ajax.reload();
    });

    var dateRange = $('#sell_list_filter_date_range').val();
    $('#date_range').val(dateRange);
    
    sell_table = $('#sell_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [[1, 'desc']],
        "ajax": {
            "url": "<?php echo e(action([\App\Http\Controllers\SellController::class, 'getDraftDatables']), false); ?>?is_quotation=1",
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
                if($('#draft_status').length) {
                    d.draft_status = $('#draft_status').val();
                }
                d.quotation_sales_list = 1;
                d.show_deleted = $('#show_deleted').is(':checked');
            }
        },
        columnDefs: [ {
            // "targets": 8,
            "orderable": false,
            "searchable": false
        } ],
        columns: [
            { data: 'action', name: 'action', orderable: false, searchable: false},
            { data: 'transaction_date', name: 'transaction_date'  },
            { data: 'invoice_no', name: 'invoice_no'},
            { data: 'ref_no', name: 'ref_no'},
            { data: 'conatct_name', name: 'conatct_name'},
            <?php if(!empty($is_customer_note_enabled)): ?>
            {data: 'customer_note',name: 'customer_note'},
            <?php endif; ?>
            { data: 'mobile', name: 'contacts.mobile'},
            { data: 'draft_status', name: 'draft_status', "searchable": false},
            { data: 'total_items', name: 'total_items', "searchable": false, className: 'text-right'},
            { data: 'final_total', name: 'final_total', "searchable": false, className: 'text-right'},
            <?php if(!empty($custom_labels['sell']['custom_field_1'])): ?>
            {
                data: 'custom_field_1',
                name: 'transactions.custom_field_1',
            },
            <?php endif; ?>
            <?php if(!empty($custom_labels['sell']['custom_field_2'])): ?>
            {
                data: 'custom_field_2',
                name: 'transactions.custom_field_2',
            },
            <?php endif; ?>
            <?php if(!empty($custom_labels['sell']['custom_field_3'])): ?>
            {
                data: 'custom_field_3',
                name: 'transactions.custom_field_3',
            },
            <?php endif; ?>
            <?php if(!empty($custom_labels['sell']['custom_field_4'])): ?>
            {
                data: 'custom_field_4',
                name: 'transactions.custom_field_4',
            },
            <?php endif; ?>
            { data: 'added_by', name: 'added_by'},
            { data: 'business_location', name: 'bl.name'},
        ],
        "fnDrawCallback": function (oSettings) {
            __currency_convert_recursively($('#purchase_table'));
        }
    });

    function positionQuotationActionMenu($toggle, $menu) {
        var toggleRect = $toggle[0].getBoundingClientRect();
        var viewportWidth = window.innerWidth || document.documentElement.clientWidth;
        var viewportHeight = window.innerHeight || document.documentElement.clientHeight;
        var menuWidth = $menu.outerWidth();
        var menuHeight = $menu.outerHeight();
        var left = toggleRect.left;
        var top = toggleRect.bottom + 2;

        if (left + menuWidth > viewportWidth - 8) {
            left = Math.max(8, viewportWidth - menuWidth - 8);
        }

        if (top + menuHeight > viewportHeight - 8 && toggleRect.top > menuHeight) {
            top = toggleRect.top - menuHeight - 2;
        }

        $menu.css({
            position: 'fixed',
            top: top + 'px',
            left: left + 'px',
            right: 'auto',
            bottom: 'auto',
            transform: 'none',
            zIndex: 1065,
            display: 'block'
        });
    }

    $(document).on('shown.bs.dropdown', '#sell_table .btn-group', function(e) {
        var $group = $(this);
        var $toggle = $(e.relatedTarget || $group.find('[data-bs-toggle="dropdown"]').get(0));
        var $menu = $group.children('.dropdown-menu');

        if (!$toggle.length || !$menu.length) {
            return;
        }

        var $placeholder = $('<span class="quotation-action-menu-placeholder"></span>');
        $menu.after($placeholder);
        $menu
            .data('quotationDropdownParent', $group)
            .data('quotationDropdownPlaceholder', $placeholder)
            .appendTo('body');

        positionQuotationActionMenu($toggle, $menu);
        $(window).on('scroll.quotationActionMenu resize.quotationActionMenu', function() {
            positionQuotationActionMenu($toggle, $menu);
        });
    });

    $(document).on('hidden.bs.dropdown', '#sell_table .btn-group', function() {
        var group = this;
        var $menu = $('body > .dropdown-menu').filter(function() {
            var $parent = $(this).data('quotationDropdownParent');
            return $parent && $parent.get(0) === group;
        });

        var $placeholder = $menu.data('quotationDropdownPlaceholder');
        if ($placeholder && $placeholder.length) {
            $placeholder.replaceWith($menu);
        }

        $menu
            .removeAttr('style')
            .removeData('quotationDropdownParent')
            .removeData('quotationDropdownPlaceholder');
        $(window).off('.quotationActionMenu');
    });
    
    $(document).on('change', '#sell_list_filter_location_id, #sell_list_filter_customer_id, #created_by, #draft_status',  function() {
        var location = $('select#sell_list_filter_location_id').find('option:selected').text();
        $('#business_location').val(location);
        sell_table.ajax.reload();
    });

    $(document).on('change', 'input#show_deleted', function(e) {
        sell_table.ajax.reload();
    });
    $(document).on('click', 'a.convert-to-proforma', function(e){
        e.preventDefault();
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(confirm => {
            if (confirm) {
                var url = $(this).attr('href');
                $.ajax({
                    method: 'GET',
                    url: url,
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            sell_table.ajax.reload();
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