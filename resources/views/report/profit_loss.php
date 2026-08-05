<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>

<?php $__env->startSection('title', __( 'report.profit_loss' )); ?>
<?php $__env->startSection('css'); ?>
<style>
    .pl-report table[id^="profit_by_"] th:last-child,
    .pl-report table[id^="profit_by_"] td:last-child {
        text-align: right;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'report.profit_loss' ); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content pl-report">
    <div class="print_section"><h2><?php echo e(session()->get('business.name'), false); ?> - <?php echo app('translator')->get( 'report.profit_loss' ); ?></h2></div>
    
    
    <div class="card radius-10 mb-3 no-print">
        <div class="card-body py-2">
            <div class="row align-items-center">
                <div class="col-md-4 col-lg-3 col-6 mb-2 mb-md-0">
                    <div class="input-group">
                        <span class="input-group-text bg-light-blue"><i class="fa fa-map-marker"></i></span>
                        <select class="form-control select2" id="profit_loss_location_filter" style="width: 80%">
                            <?php $__currentLoopData = $business_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key, false); ?>"><?php echo e($value, false); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 col-6 mb-2 mb-md-0">
                    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_profit_loss_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <button type="button" class="btn btn-primary w-100" id="profit_loss_date_filter">
                        <span><i class="fa fa-calendar"></i> <?php echo e(__('messages.filter_by_date'), false); ?></span>
                        <i class="fa fa-caret-down ms-1"></i>
                    </button>
                </div>
                <div class="col-md-4 col-lg-6 text-end d-none d-md-block">
                    <button type="button" class="btn btn-outline-secondary open-profit-loss-report-print" data-tab="summary"
                        aria-label="Print">
                        <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div id="pl_data_div" class="row"></div>
    </div>
    
    
    <div class="row no-print d-md-none mb-2">
        <div class="col-sm-12">
            <button type="button" class="btn btn-outline-secondary float-end open-profit-loss-report-print" data-tab="summary"
            aria-label="Print"
            ><i class="fa fa-print"></i> <?php echo app('translator')->get( 'messages.print' ); ?> A4</button>
        </div>
    </div>

    
    <div class="card radius-10 no-print">
        <div class="card-body p-0">
            <div class="row g-0">
                
                <div class="col-lg-3 col-xl-2 pl-report-sidebar">
                    <div class="pl-report-sidebar-header d-none d-lg-block">
                        <i class="fa fa-chart-bar me-1"></i> <?php echo app('translator')->get('lang_v1.profit_by'); ?>
                    </div>
                    <ul class="nav pl-report-nav flex-lg-column" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#profit_by_products" data-bs-toggle="tab" role="tab">
                                <i class="fa fa-cubes"></i><span><?php echo app('translator')->get('lang_v1.profit_by_products'); ?></span>
                            </a>
                        </li>

                        
                        <li class="pl-nav-group-label d-none d-lg-block">
                            <small><?php echo app('translator')->get('product.category'); ?></small>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#profit_by_categories" data-bs-toggle="tab" role="tab">
                                <i class="fa fa-tags"></i><span><?php echo app('translator')->get('lang_v1.profit_by_categories'); ?></span>
                            </a>
                        </li>
                        <li class="nav-item pl-nav-child">
                            <a class="nav-link" href="#profit_by_sub_categories" data-bs-toggle="tab" role="tab">
                                <i class="fa fa-tag"></i><span><?php echo app('translator')->get('lang_v1.profit_by_sub_categories'); ?></span>
                            </a>
                        </li>
                        <li class="nav-item pl-nav-child">
                            <a class="nav-link" href="#profit_by_sub2_categories" data-bs-toggle="tab" role="tab">
                                <i class="fa fa-tag"></i><span><?php echo app('translator')->get('lang_v1.profit_by_sub2_categories'); ?></span>
                            </a>
                        </li>

                        <li class="pl-nav-divider d-none d-lg-block"></li>

                        <li class="nav-item">
                            <a class="nav-link" href="#profit_by_brands" data-bs-toggle="tab" role="tab">
                                <i class="fa fa-diamond"></i><span><?php echo app('translator')->get('lang_v1.profit_by_brands'); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#profit_by_locations" data-bs-toggle="tab" role="tab">
                                <i class="fa fa-map-marker"></i><span><?php echo app('translator')->get('lang_v1.profit_by_locations'); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#profit_by_invoice" data-bs-toggle="tab" role="tab">
                                <i class="fa fa-file-alt"></i><span><?php echo app('translator')->get('lang_v1.profit_by_invoice'); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#profit_by_date" data-bs-toggle="tab" role="tab">
                                <i class="fa fa-calendar-alt"></i><span><?php echo app('translator')->get('lang_v1.profit_by_date'); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#profit_by_customer" data-bs-toggle="tab" role="tab">
                                <i class="fa fa-user"></i><span><?php echo app('translator')->get('lang_v1.profit_by_customer'); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#profit_by_day" data-bs-toggle="tab" role="tab">
                                <i class="fa fa-calendar-week"></i><span><?php echo app('translator')->get('lang_v1.profit_by_day'); ?></span>
                            </a>
                        </li>
                    </ul>
                </div>

                
                <div class="col-lg-9 col-xl-10 pl-report-content">
                    <div class="text-end p-3 pb-0">
                        <button type="button" class="btn btn-primary open-profit-loss-report-print" data-tab="active">
                            <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                        </button>
                    </div>
                    <div class="tab-content p-3">
                        <div class="tab-pane fade show active" id="profit_by_products" role="tabpanel"> 
                            <?php echo $__env->make('report.partials.profit_by_products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="tab-pane fade" id="profit_by_categories" role="tabpanel">
                            <?php echo $__env->make('report.partials.profit_by_categories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="tab-pane fade" id="profit_by_sub_categories" role="tabpanel">
                            <?php echo $__env->make('report.partials.profit_by_sub_categories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="tab-pane fade" id="profit_by_sub2_categories" role="tabpanel">
                            <?php echo $__env->make('report.partials.profit_by_sub2_categories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="tab-pane fade" id="profit_by_brands" role="tabpanel">
                            <?php echo $__env->make('report.partials.profit_by_brands', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="tab-pane fade" id="profit_by_locations" role="tabpanel">
                            <?php echo $__env->make('report.partials.profit_by_locations', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="tab-pane fade" id="profit_by_invoice" role="tabpanel">
                            <?php echo $__env->make('report.partials.profit_by_invoice', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="tab-pane fade" id="profit_by_date" role="tabpanel">
                            <?php echo $__env->make('report.partials.profit_by_date', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="tab-pane fade" id="profit_by_customer" role="tabpanel">
                            <?php echo $__env->make('report.partials.profit_by_customer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="tab-pane fade" id="profit_by_day" role="tabpanel">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>

<script type="text/javascript">
    $(document).ready( function() {
        function getProfitLossFilterParams(tab) {
            var start = '';
            var end = '';

            if ($('#profit_loss_date_filter').data('daterangepicker')) {
                start = $('#profit_loss_date_filter')
                    .data('daterangepicker')
                    .startDate.format('YYYY-MM-DD');
                end = $('#profit_loss_date_filter')
                    .data('daterangepicker')
                    .endDate.format('YYYY-MM-DD');
            }

            return {
                tab: tab,
                start_date: start,
                end_date: end,
                location_id: $('#profit_loss_location_filter').val()
            };
        }

        function getActiveProfitLossTab() {
            var active = $('.pl-report-nav .nav-link.active').attr('href') || '#profit_by_products';
            var tabs = {
                '#profit_by_products': 'product',
                '#profit_by_categories': 'category',
                '#profit_by_sub_categories': 'sub_category',
                '#profit_by_sub2_categories': 'sub2_category',
                '#profit_by_brands': 'brand',
                '#profit_by_locations': 'location',
                '#profit_by_invoice': 'invoice',
                '#profit_by_date': 'date',
                '#profit_by_customer': 'customer',
                '#profit_by_day': 'day'
            };

            return tabs[active] || 'product';
        }

        $(document).on('click', '.open-profit-loss-report-print', function(e) {
            e.preventDefault();
            var tab = $(this).data('tab') === 'active' ? getActiveProfitLossTab() : ($(this).data('tab') || 'summary');
            var url = "<?php echo e(url('reports/profit-loss-print'), false); ?>?" + $.param(getProfitLossFilterParams(tab));
            window.open(url, '_blank');
        });

        profit_by_products_table = $('#profit_by_products_table').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "/reports/get-profit/product",
                    "data": function ( d ) {
                        d.start_date = $('#profit_loss_date_filter')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        d.end_date = $('#profit_loss_date_filter')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                        d.location_id = $('#profit_loss_location_filter').val();
                    }
                },
                columns: [
                    { data: 'product', name: 'product'  },
                    { data: 'gross_profit', "searchable": false, className: 'text-right'},
                ],
                footerCallback: function ( row, data, start, end, display ) {
                    var total_profit = 0;
                    for (var r in data){
                        total_profit += $(data[r].gross_profit).data('orig-value') ? 
                        parseFloat($(data[r].gross_profit).data('orig-value')) : 0;
                    }

                    $('#profit_by_products_table .footer_total').html(__currency_trans_from_en(total_profit, false));
                }
            });

        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr('href');
            if ( target == '#profit_by_categories') {
                if(typeof profit_by_categories_datatable == 'undefined') {
                    profit_by_categories_datatable = $('#profit_by_categories_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/category",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'category', name: 'C.name'  },
                            { data: 'gross_profit', "searchable": false, className: 'text-right'},
                        ],
                        footerCallback: function ( row, data, start, end, display ) {
                            var total_profit = 0;
                            for (var r in data){
                                total_profit += $(data[r].gross_profit).data('orig-value') ? 
                                parseFloat($(data[r].gross_profit).data('orig-value')) : 0;
                            }

                            $('#profit_by_categories_table .footer_total').html(__currency_trans_from_en(total_profit, false));
                        },
                    });
                } else {
                    profit_by_categories_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_sub_categories') {
                if(typeof profit_by_sub_categories_datatable == 'undefined') {
                    profit_by_sub_categories_datatable = $('#profit_by_sub_categories_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/sub_category",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'sub_category', name: 'SC.name'  },
                            { data: 'gross_profit', "searchable": false, className: 'text-right'},
                        ],
                        footerCallback: function ( row, data, start, end, display ) {
                            var total_profit = 0;
                            for (var r in data){
                                total_profit += $(data[r].gross_profit).data('orig-value') ? 
                                parseFloat($(data[r].gross_profit).data('orig-value')) : 0;
                            }

                            $('#profit_by_sub_categories_table .footer_total').html(__currency_trans_from_en(total_profit, false));
                        },
                    });
                } else {
                    profit_by_sub_categories_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_sub2_categories') {
                if(typeof profit_by_sub2_categories_datatable == 'undefined') {
                    profit_by_sub2_categories_datatable = $('#profit_by_sub2_categories_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/sub2_category",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'sub2_category', name: 'SC2.name'  },
                            { data: 'gross_profit', "searchable": false, className: 'text-right'},
                        ],
                        footerCallback: function ( row, data, start, end, display ) {
                            var total_profit = 0;
                            for (var r in data){
                                total_profit += $(data[r].gross_profit).data('orig-value') ? 
                                parseFloat($(data[r].gross_profit).data('orig-value')) : 0;
                            }

                            $('#profit_by_sub2_categories_table .footer_total').html(__currency_trans_from_en(total_profit, false));
                        },
                    });
                } else {
                    profit_by_sub2_categories_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_brands') {
                if(typeof profit_by_brands_datatable == 'undefined') {
                    profit_by_brands_datatable = $('#profit_by_brands_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/brand",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'brand', name: 'B.name'  },
                            { data: 'gross_profit', "searchable": false, className: 'text-right'},
                        ],
                        footerCallback: function ( row, data, start, end, display ) {
                            var total_profit = 0;
                            for (var r in data){
                                total_profit += $(data[r].gross_profit).data('orig-value') ? 
                                parseFloat($(data[r].gross_profit).data('orig-value')) : 0;
                            }

                            $('#profit_by_brands_table .footer_total').html(__currency_trans_from_en(total_profit, false));
                        },
                    });
                } else {
                    profit_by_brands_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_locations') {
                if(typeof profit_by_locations_datatable == 'undefined') {
                    profit_by_locations_datatable = $('#profit_by_locations_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/location",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'location', name: 'L.name'  },
                            { data: 'gross_profit', "searchable": false, className: 'text-right'},
                        ],
                        footerCallback: function ( row, data, start, end, display ) {
                            var total_profit = 0;
                            for (var r in data){
                                total_profit += $(data[r].gross_profit).data('orig-value') ? 
                                parseFloat($(data[r].gross_profit).data('orig-value')) : 0;
                            }

                            $('#profit_by_locations_table .footer_total').html(__currency_trans_from_en(total_profit, false));
                        },
                    });
                } else {
                    profit_by_locations_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_invoice') {
                if(typeof profit_by_invoice_datatable == 'undefined') {
                    profit_by_invoice_datatable = $('#profit_by_invoice_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/invoice",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'invoice_no', name: 'sale.invoice_no'  },
                            { data: 'gross_profit', "searchable": false, className: 'text-right'},
                        ],
                        footerCallback: function ( row, data, start, end, display ) {
                            var total_profit = 0;
                            for (var r in data){
                                total_profit += $(data[r].gross_profit).data('orig-value') ? 
                                parseFloat($(data[r].gross_profit).data('orig-value')) : 0;
                            }

                            $('#profit_by_invoice_table .footer_total').html(__currency_trans_from_en(total_profit, false));
                        },
                    });
                } else {
                    profit_by_invoice_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_date') {
                if(typeof profit_by_date_datatable == 'undefined') {
                    profit_by_date_datatable = $('#profit_by_date_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/date",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'transaction_date', name: 'sale.transaction_date'  },
                            { data: 'gross_profit', "searchable": false, className: 'text-right'},
                        ],
                        footerCallback: function ( row, data, start, end, display ) {
                            var total_profit = 0;
                            for (var r in data){
                                total_profit += $(data[r].gross_profit).data('orig-value') ? 
                                parseFloat($(data[r].gross_profit).data('orig-value')) : 0;
                            }

                            $('#profit_by_date_table .footer_total').html(__currency_trans_from_en(total_profit, false));
                        },
                    });
                } else {
                    profit_by_date_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_customer') {
                if(typeof profit_by_customers_table == 'undefined') {
                    profit_by_customers_table = $('#profit_by_customer_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/customer",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'customer', name: 'CU.name'  },
                            { data: 'gross_profit', "searchable": false, className: 'text-right'},
                        ],
                        footerCallback: function ( row, data, start, end, display ) {
                            var total_profit = 0;
                            for (var r in data){
                                total_profit += $(data[r].gross_profit).data('orig-value') ? 
                                parseFloat($(data[r].gross_profit).data('orig-value')) : 0;
                            }

                            $('#profit_by_customer_table .footer_total').html(__currency_trans_from_en(total_profit, false));
                        },
                    });
                } else {
                    profit_by_customers_table.ajax.reload();
                }
            } else if (target == '#profit_by_day') {
                var start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');

                var end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                var location_id = $('#profit_loss_location_filter').val();

                var url = '/reports/get-profit/day?start_date=' + start_date + '&end_date=' + end_date + '&location_id=' + location_id;
                $.ajax({
                        url: url,
                        dataType: 'html',
                        success: function(result) {
                           $('#profit_by_day').html(result); 
                            profit_by_days_table = $('#profit_by_day_table').DataTable({
                                    "searching": false,
                                    'paging': false,
                                    'ordering': false,
                            });
                            var total_profit = sum_table_col($('#profit_by_day_table'), 'gross-profit');
                           $('#profit_by_day_table .footer_total').text(__currency_trans_from_en(total_profit, false));
                            __currency_convert_recursively($('#profit_by_day_table'));
                        },
                    });
            } else if (target == '#profit_by_products') {
                profit_by_products_table.ajax.reload();
            }
        });

        // Reload all already-initialised tab DataTables when any filter changes
        function reloadPLTabDatatables() {
            if (typeof profit_by_products_table !== 'undefined') {
                profit_by_products_table.ajax.reload();
            }
            if (typeof profit_by_categories_datatable !== 'undefined') {
                profit_by_categories_datatable.ajax.reload();
            }
            if (typeof profit_by_sub_categories_datatable !== 'undefined') {
                profit_by_sub_categories_datatable.ajax.reload();
            }
            if (typeof profit_by_sub2_categories_datatable !== 'undefined') {
                profit_by_sub2_categories_datatable.ajax.reload();
            }
            if (typeof profit_by_brands_datatable !== 'undefined') {
                profit_by_brands_datatable.ajax.reload();
            }
            if (typeof profit_by_locations_datatable !== 'undefined') {
                profit_by_locations_datatable.ajax.reload();
            }
            if (typeof profit_by_invoice_datatable !== 'undefined') {
                profit_by_invoice_datatable.ajax.reload();
            }
            if (typeof profit_by_date_datatable !== 'undefined') {
                profit_by_date_datatable.ajax.reload();
            }
            if (typeof profit_by_customers_table !== 'undefined') {
                profit_by_customers_table.ajax.reload();
            }
        }

        $('#profit_loss_location_filter').on('change', function () {
            reloadPLTabDatatables();
        });

        $('#profit_loss_date_filter').on('apply.daterangepicker', function () {
            reloadPLTabDatatables();
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>