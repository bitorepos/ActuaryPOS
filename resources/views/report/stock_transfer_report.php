
<?php $__env->startSection('title', __('lang_v1.stock_transfer_report')); ?>
<?php
    $user_settings = json_decode(auth()->user()->user_settings, true);
    $show_stock_transfer_report_cost_value = $show_stock_transfer_report_cost_value ?? empty($hide_stock_transfer_report_cost_value);
    $show_stock_transfer_report_sale_value = $show_stock_transfer_report_sale_value ?? empty($hide_stock_transfer_report_sale_value);
?>
<?php $__env->startSection('css'); ?>
<style>
    #total_stock_transfers th.text-end,
    #total_stock_transfers td.text-end,
    #stock_transfer_report_table th.text-end,
    #stock_transfer_report_table td.text-end,
    #stock_transfer_products_summary_table th.text-end,
    #stock_transfer_products_summary_table td.text-end {
        text-align: right !important;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_stock_transfer_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo e(__('lang_v1.stock_transfer_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getStockTransferReport']), 'method' => 'get', 'id' => 'stock_transfer_report_form', 'class' => 'row' ]); ?>

            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('location_id', __('lang_v1.location_from').':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('report.all_locations')]); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('str_filter_location_to', __('lang_v1.location_to').':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <?php echo Form::select('str_filter_location_to', $business_locations, null, ['class' => 'form-control select2', 'id' => 'str_filter_location_to', 'style' => 'width:100%', 'placeholder' => __('report.all_locations')]); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('str_status',  __('sale.status') . ':'); ?>

                    <?php echo Form::select('str_status', ['pending' => __('lang_v1.pending'), 'in_transit' => __('lang_v1.in_transit'), 'final' => __('restaurant.completed')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>      
            <?php if(session('business.enable_category')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('category_id', __('product.category') . ':'); ?>

                    <?php echo Form::select('category_id', $categories, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'str_filter_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                    <?php echo Form::select('sub_category_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'str_filter_sub_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub2_category_id', __('product.sub2_category') . ':'); ?>

                    <?php echo Form::select('sub2_category_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'str_filter_sub2_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_brand')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('brand_id', __('product.brand') . ':'); ?>

                    <?php echo Form::select('brand_id', $brands, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'str_filter_brand_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub_brand_id', __('product.sub_brand') . ':'); ?>

                    <?php echo Form::select('sub_brand_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'str_filter_sub_brand_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_gender')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('gender_id', __('product.gender') . ':'); ?>

                    <?php echo Form::select('gender_id', $genders, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'str_filter_gender_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub_gender_id', __('product.sub_gender') . ':'); ?>

                    <?php echo Form::select('sub_gender_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'str_filter_sub_gender_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_procurement_source')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('procurement_source_id', __('product.procurement_source') . ':'); ?>

                    <?php echo Form::select('procurement_source_id', $procurement_sources, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'str_filter_procurement_source_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub_procurement_source_id', __('product.sub_procurement_source') . ':'); ?>

                    <?php echo Form::select('sub_procurement_source_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'str_filter_sub_procurement_source_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('str_date_filter', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' =>
                    'form-control', 'id' => 'str_date_filter', 'readonly']); ?>

                </div>
            </div>
            <?php echo Form::close(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#str_totals_tab" class="nav-link active pb-2 pe-2 ps-2" data-bs-toggle="tab" aria-expanded="true"><i class="fa fa-list"
                            aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.totals'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="#str_summary_tab" class="nav-link pb-2 pe-2 ps-2" data-bs-toggle="tab" aria-expanded="true"><i
                                class="fa fa-list" aria-hidden="true"></i> <?php echo app('translator')->get('report.summary'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="#str_detailed_tab" class="nav-link pb-2 pe-2 ps-2" data-bs-toggle="tab" aria-expanded="true"><i class="fa fa-bars"
                                    aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.detailed'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="#str_products_summary_tab" class="nav-link pb-2 pe-2 ps-2" data-bs-toggle="tab" aria-expanded="true"><i class="fa fa-cubes"
                                    aria-hidden="true"></i> <?php echo app('translator')->get('report.product_summary'); ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="str_totals_tab">
                        <div class="table-">
                            <div class="text-end mb-2">
                                <button type="button" class="btn btn-primary open-stock-transfer-report-print" data-tab="totals">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                            <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="total_stock_transfers">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th class="text-end"><?php echo app('translator')->get('lang_v1.invoice_quantity'); ?></th>
                                        <th class="text-end"><?php echo app('translator')->get('lang_v1.item_quantity'); ?></th>
                                        <th class="text-end"><?php echo app('translator')->get('lang_v1.total_cost_value'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                        <th class="text-end"><?php echo app('translator')->get('lang_v1.total_selling_value'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                <tr class="bg-gray font-17 footer-total">
                                    <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                    <td id="footer_total_invoices" class="text-end"></td>
                                    <td id="footer_total_items" class="text-end"></td>
                                    <td id="footer_total" class="text-end"></td>
                                    <td id="footer_total_selling_value" class="text-end"></td>
                                </tr>
                                </tfoot>
                            </table>
</div>
                        </div>
                    </div>
                    <div class="tab-pane" id="str_summary_tab">
                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-primary open-stock-transfer-report-print" data-tab="summary">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped ajax_view table-th-skin" id="stock_transfer_report_table" style="width:100% !important">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.location_from'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.location_to'); ?></th>
                                        <th><?php echo app('translator')->get('sale.status'); ?></th>
                                        <th class="text-end"><?php echo app('translator')->get('lang_v1.shipping_charges'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                        <th class="text-end"><?php echo app('translator')->get('lang_v1.total_cost_value'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                        <th class="text-end"><?php echo app('translator')->get('lang_v1.total_selling_value'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                        <th><?php echo app('translator')->get('purchase.additional_notes'); ?></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                <tr class="bg-gray font-17 footer-total">
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                    <td class="footer_shipping_total text-end"></td>
                                    <td class="footer_total text-end"></td>
                                    <td class="footer_selling_total text-end"></td>
                                    <td ></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="str_detailed_tab">
                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-primary open-stock-transfer-report-print" data-tab="detailed">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div id="transfer_ledger_div"></div>
                    </div>
                    <div class="tab-pane" id="str_products_summary_tab">
                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-primary open-stock-transfer-report-print" data-tab="products_summary">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin" id="stock_transfer_products_summary_table" style="width:100% !important">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('sale.product'); ?></th>
                                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.unit'); ?></th>
                                        <th class="text-end"><?php echo app('translator')->get('lang_v1.count'); ?></th>
                                        <th class="text-end"><?php echo app('translator')->get('purchase.purchase_quantity'); ?></th>
                                        <?php if($show_stock_transfer_report_sale_value): ?>
                                            <th class="text-end"><?php echo app('translator')->get('lang_v1.sale_price'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                        <?php endif; ?>
                                        <?php if($show_stock_transfer_report_cost_value): ?>
                                            <th class="text-end"><?php echo app('translator')->get('lang_v1.total_cost_value'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                        <?php endif; ?>
                                        <?php if($show_stock_transfer_report_sale_value): ?>
                                            <th class="text-end"><?php echo app('translator')->get('lang_v1.total_selling_value'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total">
                                        <td colspan="3"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td class="footer_str_ps_count text-end"></td>
                                        <td class="footer_str_ps_qty text-end"></td>
                                        <?php if($show_stock_transfer_report_sale_value): ?>
                                            <td></td>
                                        <?php endif; ?>
                                        <?php if($show_stock_transfer_report_cost_value): ?>
                                            <td class="footer_str_ps_total text-end"></td>
                                        <?php endif; ?>
                                        <?php if($show_stock_transfer_report_sale_value): ?>
                                            <td class="footer_str_ps_selling_total text-end"></td>
                                        <?php endif; ?>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<div class="modal fade view_register" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
                    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<script type="text/javascript">
    $('#stock_transfer_report_form #location_id, #str_filter_location_to, #str_filter_brand_id, #str_filter_sub_brand_id, #str_filter_category_id, #str_filter_sub_category_id, #str_filter_sub2_category_id, #str_filter_gender_id, #str_filter_sub_gender_id, #str_filter_procurement_source_id, #str_filter_sub_procurement_source_id').change(function() {
        $('.nav-tabs .nav-link.active').trigger('shown.bs.tab');
    });
</script>
<script type="text/javascript">
    // Cascade sub-categories
    $('#str_filter_category_id').change(function() {
        var cat_id = $(this).val();
        $('#str_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
        $.ajax({ method: 'POST', url: '/products/get_sub_categories', dataType: 'html',
            data: { cat_id: cat_id },
            success: function(result) { if(result) { $('#str_filter_sub_category_id').html(result); } }
        });
    });
    $('#str_filter_sub_category_id').change(function() {
        var cat_id = $(this).val();
        $.ajax({ method: 'POST', url: '/products/get_sub_categories', dataType: 'html',
            data: { cat_id: cat_id },
            success: function(result) { if(result) { $('#str_filter_sub2_category_id').html(result); } }
        });
    });
    // Cascade sub-brands
    $('#str_filter_brand_id').change(function() {
        var brand_id = $(this).val();
        $('#str_filter_sub_brand_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
        if(brand_id) {
            $.ajax({ method: 'POST', url: '/brands/get_sub_brands', dataType: 'html',
                data: { brand_id: brand_id },
                success: function(result) { if(result) { $('#str_filter_sub_brand_id').append(result); } }
            });
        }
    });
    // Cascade sub-genders
    $('#str_filter_gender_id').change(function() {
        var gender_id = $(this).val();
        $('#str_filter_sub_gender_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
        if(gender_id) {
            $.ajax({ method: 'POST', url: '/genders/get_sub_genders', dataType: 'html',
                data: { gender_id: gender_id },
                success: function(result) { if(result) { $('#str_filter_sub_gender_id').append(result); } }
            });
        }
    });
    // Cascade sub-procurement-sources
    $('#str_filter_procurement_source_id').change(function() {
        var proc_id = $(this).val();
        $('#str_filter_sub_procurement_source_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
        if(proc_id) {
            $.ajax({ method: 'POST', url: '/procurement-sources/get_sub_procurement_sources', dataType: 'html',
                data: { procurement_source_id: proc_id },
                success: function(result) { if(result) { $('#str_filter_sub_procurement_source_id').append(result); } }
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        function getStockTransferReportFilterParams() {
            var params = {
                location_id: $('#location_id').val(),
                location_to: $('#str_filter_location_to').val(),
                status: $('#str_status').val(),
                category_id: $('#str_filter_category_id').val(),
                sub_category_id: $('#str_filter_sub_category_id').val(),
                sub2_category_id: $('#str_filter_sub2_category_id').val(),
                brand_id: $('#str_filter_brand_id').val(),
                sub_brand_id: $('#str_filter_sub_brand_id').val(),
                gender_id: $('#str_filter_gender_id').val(),
                sub_gender_id: $('#str_filter_sub_gender_id').val(),
                procurement_source_id: $('#str_filter_procurement_source_id').val(),
                sub_procurement_source_id: $('#str_filter_sub_procurement_source_id').val()
            };

            if ($('#str_date_filter').val()) {
                params.start_date = $('#str_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                params.end_date = $('#str_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
            }

            return params;
        }

        $(document).on('click', '.open-stock-transfer-report-print', function(e) {
            e.preventDefault();
            var params = getStockTransferReportFilterParams();
            params.tab = $(this).data('tab') || 'totals';
            var url = "<?php echo e(url('reports/stock-transfer-report-print'), false); ?>?" + $.param(params);
            window.open(url, '_blank');
        });

        var stockTransferDateRangeSettings = $('#reports_filter_date_range').length
            ? window.getAdminReportDateRangeSettings()
            : $.extend({}, dateRangeSettings, {
                startDate: moment(),
                endDate: moment()
            });
        
        $('#str_date_filter').daterangepicker(
        stockTransferDateRangeSettings,
        function (start, end) {
            $('#str_date_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            stock_transfer_report_table.ajax.reload();
            total_stock_transfers.ajax.reload();
            stock_transfer_products_summary_table.ajax.reload();
        }
        );
        var stockTransferDatePicker = $('#str_date_filter').data('daterangepicker');
        if (stockTransferDatePicker) {
            $('#str_date_filter').val(
                stockTransferDatePicker.startDate.format(moment_date_format) +
                ' ~ ' +
                stockTransferDatePicker.endDate.format(moment_date_format)
            );
        }
        $('#str_date_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#str_date_filter').val('');
            stock_transfer_report_table.ajax.reload();
            total_stock_transfers.ajax.reload();
            stock_transfer_products_summary_table.ajax.reload();
        });
        $('#str_date_filter').change( function(){
            total_stock_transfers.ajax.reload();
            stock_transfer_report_table.ajax.reload();
            stock_transfer_products_summary_table.ajax.reload();
            get_transfer_ledger();
        });

        get_transfer_ledger();

        stock_transfer_report_table = $('#stock_transfer_report_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[0, 'desc']],
            "ajax": {
                "url": '/stock-transfers',
                "data": function(d) {
                d.stock_transfer_report = 1;
                d.location_id = $('#location_id').val();
                d.location_to = $('#str_filter_location_to').val();
                d.status = $('#str_status').val();
                d.category_id = $('#str_filter_category_id').val();
                d.sub_category_id = $('#str_filter_sub_category_id').val();
                d.sub2_category_id = $('#str_filter_sub2_category_id').val();
                d.brand_id = $('#str_filter_brand_id').val();
                d.sub_brand_id = $('#str_filter_sub_brand_id').val();
                d.gender_id = $('#str_filter_gender_id').val();
                d.sub_gender_id = $('#str_filter_sub_gender_id').val();
                d.procurement_source_id = $('#str_filter_procurement_source_id').val();
                d.sub_procurement_source_id = $('#str_filter_sub_procurement_source_id').val();
                var start = null;
                var end = null;
                if($('#str_date_filter').val()) {
                    start = $('#str_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    end = $('#str_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                }
                d.start_date = start;
                d.end_date = end;
            }},
            columnDefs: [
                {
                    targets: 8,
                    orderable: false,
                    searchable: false,
                },
            ],
            columns: [
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'location_from', name: 'l1.name' },
                { data: 'location_to', name: 'l2.name' },
                { data: 'status', name: 'status' },
                { data: 'shipping_charges', name: 'shipping_charges', className: 'text-end' },
                { data: 'final_total', name: 'final_total', className: 'text-end' },
                { data: 'total_selling_value', name: 'total_selling_value', className: 'text-end' },
                { data: 'additional_notes', name: 'additional_notes' },
            ],
            fnDrawCallback: function(oSettings) {
                __currency_convert_recursively($('#stock_transfer_report_table'));
            },
            footerCallback: function ( row, data, start, end, display ) {
                var footer_total = 0;
                var footer_selling_total = 0;
                var footer_shipping_total = 0;
                for (var r in data){
                    footer_total += $(data[r].final_total).data('orig-value') ? parseFloat($(data[r].final_total).data('orig-value')) : 0;
                    footer_selling_total += $(data[r].total_selling_value).data('orig-value') ? parseFloat($(data[r].total_selling_value).data('orig-value')) : 0;
                    footer_shipping_total += $(data[r].shipping_charges).data('orig-value') ? parseFloat($(data[r].shipping_charges).data('orig-value')) : 0;
                }

                $('.footer_total').html(__currency_trans_from_en(footer_total, false));
                $('.footer_selling_total').html(__currency_trans_from_en(footer_selling_total, false));
                $('.footer_shipping_total').html(__currency_trans_from_en(footer_shipping_total, false));
            },
        });

        total_stock_transfers = $('#total_stock_transfers').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[1, 'desc']],
            "ajax": {
                "url": "/reports/stock-transfer-total",
                "data": function ( d ) {
                    d.location_id = $('#location_id').val();
                    d.location_to = $('#str_filter_location_to').val();
                    d.status = $('#str_status').val();
                    d.category_id = $('#str_filter_category_id').val();
                    d.sub_category_id = $('#str_filter_sub_category_id').val();
                    d.sub2_category_id = $('#str_filter_sub2_category_id').val();
                    d.brand_id = $('#str_filter_brand_id').val();
                    d.sub_brand_id = $('#str_filter_sub_brand_id').val();
                    d.gender_id = $('#str_filter_gender_id').val();
                    d.sub_gender_id = $('#str_filter_sub_gender_id').val();
                    d.procurement_source_id = $('#str_filter_procurement_source_id').val();
                    d.sub_procurement_source_id = $('#str_filter_sub_procurement_source_id').val();
                    var start = null;
                    var end = null;
                    if($('#str_date_filter').val()) {
                        start = $('#str_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        end = $('#str_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;
                    d = __datatable_ajax_callback(d);
                }
            },
            columns: [
                { data: 'transfer_date', name: 'transactions.transaction_date' },
                { data: 'total_invoices', name: 'total_invoices', className: 'text-end' },
                { data: 'total_items', name: 'total_items', className: 'text-end' },
                { data: 'final_total', name: 'final_total', className: 'text-end' },
                { data: 'total_selling_value', name: 'total_selling_value', className: 'text-end' }
            ],
            "fnDrawCallback": function (oSettings) {
                __currency_convert_recursively($('#total_stock_transfers'));
            },
            "footerCallback": function ( row, data, start, end, display ) {
                var footer_total = 0;
                var footer_selling_total = 0;
                var footer_total_invoices = 0;
                var footer_total_items = 0;
                for (var r in data){
                    footer_total += $(data[r].final_total).data('orig-value') ? parseFloat($(data[r].final_total).data('orig-value')) : 0;
                    footer_selling_total += $(data[r].total_selling_value).data('orig-value') ? parseFloat($(data[r].total_selling_value).data('orig-value')) : 0;
                    footer_total_invoices += data[r].total_invoices ? parseFloat(data[r].total_invoices) : 0;
                    footer_total_items += data[r].total_items ? parseFloat(data[r].total_items) : 0;;
                }
                $('#footer_total_invoices').html(__number_f(footer_total_invoices));
                $('#footer_total_items').html(__number_f(footer_total_items));
                $('#footer_total').html(__currency_trans_from_en(footer_total, false));
                $('#footer_total_selling_value').html(__currency_trans_from_en(footer_selling_total, false));
            },
            
        });

        stock_transfer_products_summary_table = $('#stock_transfer_products_summary_table').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            aaSorting: [[<?php echo e($show_stock_transfer_report_cost_value ? 5 + ($show_stock_transfer_report_sale_value ? 1 : 0) : 0, false); ?>, '<?php echo e($show_stock_transfer_report_cost_value ? 'desc' : 'asc', false); ?>']],
            ajax: {
                url: '/reports/stock-transfer-products-summary',
                data: function(d) {
                    d.location_id = $('#location_id').val();
                    d.location_to = $('#str_filter_location_to').val();
                    d.status = $('#str_status').val();
                    d.category_id = $('#str_filter_category_id').val();
                    d.sub_category_id = $('#str_filter_sub_category_id').val();
                    d.sub2_category_id = $('#str_filter_sub2_category_id').val();
                    d.brand_id = $('#str_filter_brand_id').val();
                    d.sub_brand_id = $('#str_filter_sub_brand_id').val();
                    d.gender_id = $('#str_filter_gender_id').val();
                    d.sub_gender_id = $('#str_filter_sub_gender_id').val();
                    d.procurement_source_id = $('#str_filter_procurement_source_id').val();
                    d.sub_procurement_source_id = $('#str_filter_sub_procurement_source_id').val();

                    var start = null;
                    var end = null;
                    if($('#str_date_filter').val()) {
                        start = $('#str_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        end = $('#str_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;
                }
            },
            columns: [
                { data: 'product_name', name: 'P.name' },
                { data: 'sku', name: 'V.sub_sku' },
                { data: 'unit', name: 'U.short_name', searchable: false },
                { data: 'transfer_count', name: 'transfer_count', searchable: false, orderable: false, className: 'text-end' },
                { data: 'total_quantity', name: 'total_quantity', searchable: false, orderable: false, className: 'text-end' },
                <?php if($show_stock_transfer_report_sale_value): ?>
                { data: 'selling_price', name: 'V.sell_price_inc_tax', searchable: false, orderable: false, className: 'text-end' },
                <?php endif; ?>
                <?php if($show_stock_transfer_report_cost_value): ?>
                { data: 'total_value', name: 'total_value', searchable: false, orderable: false, className: 'text-end' },
                <?php endif; ?>
                <?php if($show_stock_transfer_report_sale_value): ?>
                { data: 'total_selling_value', name: 'total_selling_value', searchable: false, orderable: false, className: 'text-end' },
                <?php endif; ?>
            ],
            fnDrawCallback: function() {
                __currency_convert_recursively($('#stock_transfer_products_summary_table'));
            },
            footerCallback: function(row, data) {
                var count = 0;
                var qty = 0;
                var total = 0;
                var total_selling_value = 0;
                for (var r in data) {
                    count += parseInt(data[r].transfer_count) || 0;
                    var rawQty = $('<div/>').html(data[r].total_quantity).text();
                    qty += parseFloat(String(rawQty).replace(/[^0-9.\-]/g, '')) || 0;
                    total += $(data[r].total_value).data('orig-value') ? parseFloat($(data[r].total_value).data('orig-value')) : 0;
                    total_selling_value += $(data[r].total_selling_value).data('orig-value') ? parseFloat($(data[r].total_selling_value).data('orig-value')) : 0;
                }
                $('.footer_str_ps_count').html(count);
                $('.footer_str_ps_qty').html(qty.toFixed(2));
                $('.footer_str_ps_total').html(__currency_trans_from_en(total, false));
                $('.footer_str_ps_selling_total').html(__currency_trans_from_en(total_selling_value, false));
            },
        });

        $(document).on('change', '#location_id, #str_filter_location_to, #str_status, #str_filter_category_id, #str_filter_sub_category_id, #str_filter_sub2_category_id, #str_filter_brand_id, #str_filter_sub_brand_id, #str_filter_gender_id, #str_filter_sub_gender_id, #str_filter_procurement_source_id, #str_filter_sub_procurement_source_id',  function() {
            total_stock_transfers.ajax.reload();
            stock_transfer_report_table.ajax.reload();
            stock_transfer_products_summary_table.ajax.reload();
            get_transfer_ledger();
        });

        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            if ($(e.target).attr('href') === '#str_products_summary_tab') {
                stock_transfer_products_summary_table.columns.adjust();
            }
        });
    });

    <?php if(!empty($user_settings['rpt_stock_strans_hide_date'])): ?>
        stock_transfer_report_table.column(0).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_strans_hide_ref_no'])): ?>
        stock_transfer_report_table.column(1).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_strans_hide_location_from'])): ?>
        stock_transfer_report_table.column(2).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_strans_hide_location_to'])): ?>
        stock_transfer_report_table.column(3).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_strans_hide_status'])): ?>
        stock_transfer_report_table.column(4).visible(false);
    <?php endif; ?>
    <?php if(! $show_stock_transfer_report_sale_value || !empty($user_settings['rpt_stock_strans_hide_shipping_charges'])): ?>
        stock_transfer_report_table.column(5).visible(false);
    <?php endif; ?>
    <?php if(! $show_stock_transfer_report_cost_value || !empty($user_settings['rpt_stock_strans_hide_total_amount'])): ?>
        stock_transfer_report_table.column(6).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_strans_hide_additional_notes'])): ?>
        stock_transfer_report_table.column(8).visible(false);
    <?php endif; ?>
    <?php if(! $show_stock_transfer_report_cost_value): ?>
        total_stock_transfers.column(3).visible(false);
    <?php endif; ?>
    <?php if(! $show_stock_transfer_report_sale_value): ?>
        stock_transfer_report_table.column(7).visible(false);
        total_stock_transfers.column(4).visible(false);
    <?php endif; ?>

    function get_transfer_ledger() {
        var location_id = $('#location_id').val();
        var location_to = $('#str_filter_location_to').val();
        var status = $('#str_status').val();
        var category_id = $('#str_filter_category_id').val();
        var brand_id = $('#str_filter_brand_id').val();
        var start = null;
        var end = null;
        if($('#str_date_filter').val()) {
            start = $('#str_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
            end = $('#str_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
        }
        var start_date = start;
        var end_date = end;

        var loader = __fa_awesome();
        $('#transfer_ledger_div').html(`
            <div class="container text-center" style="justify-content: space-around;display: flex;">
                <div style="padding: 15px;margin: 25px;font-size: 1.4em;background-color: #d0f5be;width: 40%;">Processing Report ${loader}</div>
            </div>
        `);
        $.ajax({
            url: '/reports/stock-transfer-detailed',
            data: {
                location_id : location_id,
                location_to : location_to,
                status : status,
                category_id : category_id,
                brand_id : brand_id,
                start_date : start_date,
                end_date : end_date,
            },
            dataType: 'html',
            success: function(result) {
                $('#transfer_ledger_div').html(result);
            },
        });
        }

    $(document).on('click', '#str_print_detail_report', function() {
        var report_title = <?php echo json_encode(__('lang_v1.stock_transfer_report') . ' - ' . __('lang_v1.detailed'), 15, 512) ?>;
        $('#transfer_ledger_div').printThis({
            importCSS: true,
            importStyle: true,
            printContainer: true,
            removeScripts: true,
            header: '<h3 class="text-center">' + report_title + '</h3>'
        });
    });

    $(document).on('click', '#str_export_detail_excel', function() {
        var rows = get_stock_transfer_detail_export_rows();
        if (!rows.length) {
            return;
        }

        var file_name = 'stock-transfer-detailed-' + moment().format('YYYY-MM-DD-HHmmss');

        loadXlsxLibrary().then(function(XLSX) {
            var workbook = XLSX.utils.book_new();
            var worksheet = XLSX.utils.aoa_to_sheet(rows);
            worksheet['!cols'] = [
                {wch: 18}, {wch: 18}, {wch: 24}, {wch: 24},
                {wch: 14}, {wch: 18}, {wch: 18}, {wch: 18}, {wch: 35}
            ];
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Detailed');
            XLSX.writeFile(workbook, file_name + '.xlsx');
        });
    });

    function get_stock_transfer_detail_export_rows() {
        var report_title = <?php echo json_encode(__('lang_v1.stock_transfer_report') . ' - ' . __('lang_v1.detailed'), 15, 512) ?>;
        var summaryHeader = [
            <?php echo json_encode(__('messages.date'), 15, 512) ?>,
            <?php echo json_encode(__('purchase.ref_no'), 15, 512) ?>,
            <?php echo json_encode(__('lang_v1.location_from'), 15, 512) ?>,
            <?php echo json_encode(__('lang_v1.location_to'), 15, 512) ?>,
            <?php echo json_encode(__('sale.status'), 15, 512) ?>
        ];
        <?php if($show_stock_transfer_report_sale_value): ?>
            summaryHeader.push(<?php echo json_encode(__('lang_v1.shipping_charges') . ' (' . session("currency")["symbol"] . ')', 15, 512) ?>);
        <?php endif; ?>
        <?php if($show_stock_transfer_report_cost_value): ?>
            summaryHeader.push(<?php echo json_encode(__('lang_v1.total_cost_value') . ' (' . session("currency")["symbol"] . ')', 15, 512) ?>);
        <?php endif; ?>
        <?php if($show_stock_transfer_report_sale_value): ?>
            summaryHeader.push(<?php echo json_encode(__('lang_v1.total_selling_value') . ' (' . session("currency")["symbol"] . ')', 15, 512) ?>);
        <?php endif; ?>
        summaryHeader.push(<?php echo json_encode(__('purchase.additional_notes'), 15, 512) ?>);

        var rows = [
            [report_title],
            [],
            summaryHeader
        ];

        $('#transfer_ledger_table > tbody > tr.transfer_detail_row').each(function() {
            var transfer_row = [];
            $(this).children('td').each(function() {
                transfer_row.push($.trim($(this).text()));
            });
            rows.push(transfer_row);

            var line_table = $(this).next('tr').find('table.transfer_line_details');
            if (line_table.length) {
                var lineHeader = ['', '', '#', <?php echo json_encode(__('sale.sku'), 15, 512) ?>, <?php echo json_encode(__('sale.product'), 15, 512) ?>, <?php echo json_encode(__('sale.qty'), 15, 512) ?>];
                <?php if($show_stock_transfer_report_cost_value): ?>
                    lineHeader.push(<?php echo json_encode(__('purchase.cost_price') . ' (' . session("currency")["symbol"] . ')', 15, 512) ?>);
                <?php endif; ?>
                <?php if($show_stock_transfer_report_sale_value): ?>
                    lineHeader.push(<?php echo json_encode(__('lang_v1.sale_price') . ' (' . session("currency")["symbol"] . ')', 15, 512) ?>);
                <?php endif; ?>
                <?php if($show_stock_transfer_report_cost_value): ?>
                    lineHeader.push(<?php echo json_encode(__('purchase.cost_total') . ' (' . session("currency")["symbol"] . ')', 15, 512) ?>);
                <?php endif; ?>
                rows.push(lineHeader);
                line_table.find('tr').slice(1).each(function() {
                    var line_row = ['', ''];
                    $(this).children('td').each(function() {
                        line_row.push($.trim($(this).text()));
                    });
                    rows.push(line_row);
                });
                rows.push([]);
            }
        });

        var footer = $('#transfer_ledger_table > tfoot > tr.str-detail-footer-total');
        if (footer.length) {
            var footerRow = [
                '',
                '',
                '',
                '',
                $.trim(footer.find('.str_footer_label').text())
            ];
            <?php if($show_stock_transfer_report_sale_value): ?>
                footerRow.push($.trim(footer.find('.str_footer_shipping_charges').text()));
            <?php endif; ?>
            <?php if($show_stock_transfer_report_cost_value): ?>
                footerRow.push($.trim(footer.find('.str_footer_final_total').text()));
            <?php endif; ?>
            <?php if($show_stock_transfer_report_sale_value): ?>
                footerRow.push($.trim(footer.find('.str_footer_selling_total').text()));
            <?php endif; ?>
            footerRow.push('');

            rows.push([]);
            rows.push(footerRow);
        }

        var line_footer = $('#transfer_ledger_table > tfoot .str-detail-line-footer-total');
        if (line_footer.length) {
            var lineFooterHeader = ['', '', '#', <?php echo json_encode(__('sale.sku'), 15, 512) ?>, <?php echo json_encode(__('sale.product'), 15, 512) ?>, <?php echo json_encode(__('sale.qty'), 15, 512) ?>];
            var lineFooterRow = [
                '',
                '',
                $.trim(line_footer.find('.str_footer_line_label').text()),
                '',
                '',
                $.trim(line_footer.find('.str_footer_line_qty').text())
            ];
            <?php if($show_stock_transfer_report_cost_value): ?>
                lineFooterHeader.push(<?php echo json_encode(__('purchase.cost_price') . ' (' . session("currency")["symbol"] . ')', 15, 512) ?>);
                lineFooterRow.push('');
            <?php endif; ?>
            <?php if($show_stock_transfer_report_sale_value): ?>
                lineFooterHeader.push(<?php echo json_encode(__('lang_v1.sale_price') . ' (' . session("currency")["symbol"] . ')', 15, 512) ?>);
                lineFooterRow.push('');
            <?php endif; ?>
            <?php if($show_stock_transfer_report_cost_value): ?>
                lineFooterHeader.push(<?php echo json_encode(__('purchase.cost_total') . ' (' . session("currency")["symbol"] . ')', 15, 512) ?>);
                lineFooterRow.push($.trim(line_footer.find('.str_footer_line_subtotal').text()));
            <?php endif; ?>
            rows.push(lineFooterHeader);
            rows.push(lineFooterRow);
        }

        return rows;
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>