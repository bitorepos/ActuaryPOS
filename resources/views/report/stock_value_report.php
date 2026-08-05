
<?php $__env->startSection('title', __('report.stock_value_report')); ?>
<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_stock_value_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('report.stock_value_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
                <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getStockReport']), 'method' => 'get', 'class'=>'row', 'id' => 'stock_report_filter_form' ]); ?>

                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('location_id',  __('purchase.business_location') . ':'); ?>

                        <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('as_of_date', __('report.as_of_date') . ':'); ?>

                        <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' =>
                        'form-control', 'id' => 'as_of_date', 'readonly']); ?>

                    </div>
                </div>
                <?php if(session('business.enable_category')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('category_id', __('category.category') . ':'); ?>

                        <?php echo Form::select('category', $categories, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                        <?php echo Form::select('sub_category', array(), null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sub2_category_id', __('product.sub2_category') . ':'); ?>

                        <?php echo Form::select('sub2_category', array(), null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub2_category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('supplier_id', __('purchase.supplier') . ':'); ?>

                        <?php echo Form::select('supplier_id', $suppliers, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <?php if(session('business.enable_brand')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('brand', __('product.brand') . ':'); ?>

                        <?php echo Form::select('brand', $brands, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sub_brand_id', __('product.sub_brand') . ':'); ?>

                        <?php echo Form::select('sub_brand_id', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_brand_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_gender')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('gender_id', __('product.gender') . ':'); ?>

                        <?php echo Form::select('gender_id', $genders, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sub_gender_id', __('product.sub_gender') . ':'); ?>

                        <?php echo Form::select('sub_gender_id', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_gender_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_procurement_source')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('procurement_source_id', __('product.procurement_source') . ':'); ?>

                        <?php echo Form::select('procurement_source_id', $procurement_sources, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sub_procurement_source_id', __('product.sub_procurement_source') . ':'); ?>

                        <?php echo Form::select('sub_procurement_source_id', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_procurement_source_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('unit',__('product.unit') . ':'); ?>

                        <?php echo Form::select('unit', $units, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <br>
                        <div class="form-check">
                            <label class="form-check-label">
<?php echo Form::checkbox('show_positive_quantity', 1, true, ['class' => 'form-check-input', 'id' => 'show_positive_quantity']); ?> <?php echo app('translator')->get('lang_v1.show_positive_quantity'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <br>
                        <div class="form-check">
                            <label class="form-check-label">
<?php echo Form::checkbox('show_negative_quantity', 1, true, ['class' => 'form-check-input', 'id' => 'show_negative_quantity']); ?> 
                                <?php echo app('translator')->get('lang_v1.show_negative_quantity'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <br>
                        <div class="form-check">
                            <label class="form-check-label">
<?php echo Form::checkbox('show_zero_quantity', 1, false, ['class' => 'form-check-input', 'id' => 'show_zero_quantity']); ?> 
                                <?php echo app('translator')->get('lang_v1.show_zero_quantity'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <br>
                        <div class="form-check">
                            <label class="form-check-label">
<?php echo Form::checkbox('show_without_history', 1, false, ['class' => 'form-check-input', 'id' => 'show_without_history']); ?> 
                                <?php echo app('translator')->get('lang_v1.show_without_history'); ?>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <br>
                        <div class="form-check">
                            <label class="form-check-label">
<?php echo Form::checkbox('show_price_exc_tax', 1, false, ['class' => 'form-check-input', 'id' => 'show_price_exc_tax']); ?> 
                                <?php echo app('translator')->get('lang_v1.show_price_exc_tax'); ?>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <div class="form-check">
                        
                        <label class="form-check-label">
                        <?php echo Form::radio('show_price', 'cost_price', true, ['class'=> 'show_price radio_option mr-5']); ?> Show Cost Price
                        </label>
                        </div>
                        <div class="form-check">
                        <label class="form-check-label">
                        <?php echo Form::radio('show_price', 'sell_price', false, ['class'=> 'show_price radio_option mr-5']); ?> Show Sell Price
                        </label>
                        </div>
                    </div>
                </div>

                <?php if($show_manufacturing_data): ?>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <br>
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('only_mfg', 1, false, 
                                  [ 'class' => 'form-check-input', 'id' => 'only_mfg_products']); ?> <?php echo e(__('manufacturing::lang.only_mfg_products'), false); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php echo Form::close(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#stock_value_details_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list" aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.details'); ?></a>
                    </li>
                    <li>
                        <a href="#stock_value_categorized_tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-th-large" aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.categorized'); ?></a>
                    </li>
                    <li>
                        <a href="#stock_value_locations_tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-map-marker" aria-hidden="true"></i> Locations</a>
                    </li>
                    <li>
                        <a href="#stock_value_location_details_tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-map" aria-hidden="true"></i> Location Details</a>
                    </li>
                </ul>
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="stock_value_details_tab">
                        <?php echo $__env->make('report.partials.stock_value_report_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    
                    <div class="tab-pane" id="stock_value_categorized_tab">
                        <?php echo $__env->make('report.partials.stock_value_categorized', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    
                    <div class="tab-pane" id="stock_value_locations_tab">
                        <?php echo $__env->make('report.partials.stock_value_locations', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    
                    <div class="tab-pane" id="stock_value_location_details_tab">
                        <?php echo $__env->make('report.partials.stock_value_location_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>
        window.stock_value_report_url = "<?php echo e(action([\App\Http\Controllers\ReportController::class, 'getStockValueReport']), false); ?>";
        if (window.jQuery) {
            $.ajaxPrefilter(function(options) {
                if (options.url === '/reports/stock-value-report') {
                    options.url = window.stock_value_report_url;
                }
            });
        }
    </script>
    <script src="<?php echo e(asset('js/report.js?v=' . $asset_v . '.' . filemtime(public_path('js/report.js'))), false); ?>"></script>
        <script>

        $(document).ready(function() {
            var sv_categorized_loaded = false;
            var sv_categorized_page = 1;
            var sv_categorized_per_page = 5;
            var sv_locations_loaded = false;
            var sv_location_details_loaded = false;

            function getStockValueReportFilterParams() {
                return {
                    location_id: $('#location_id').val(),
                    supplier_id: $('#supplier_id').val(),
                    category_id: $('#category_id').val(),
                    date_filter: $('#date_filter').val(),
                    date_range: $('#as_of_date').val(),
                    as_of_date: $('#as_of_date').val(),
                    sub_category_id: $('#sub_category_id').val(),
                    sub2_category_id: $('#sub2_category_id').val(),
                    brand_id: $('#brand').val(),
                    sub_brand_id: $('#sub_brand_id').val(),
                    gender_id: $('#gender_id').val(),
                    sub_gender_id: $('#sub_gender_id').val(),
                    procurement_source_id: $('#procurement_source_id').val(),
                    sub_procurement_source_id: $('#sub_procurement_source_id').val(),
                    unit_id: $('#unit').val(),
                    only_mfg_products: ($('#only_mfg_products').length && $('#only_mfg_products').is(':checked')) ? 1 : 0,
                    show_positive_quantity: ($('#show_positive_quantity').length && $('#show_positive_quantity').is(':checked')) ? 1 : 0,
                    show_negative_quantity: ($('#show_negative_quantity').length && $('#show_negative_quantity').is(':checked')) ? 1 : 0,
                    show_zero_quantity: ($('#show_zero_quantity').length && $('#show_zero_quantity').is(':checked')) ? 1 : 0,
                    show_without_history: ($('#show_without_history').length && $('#show_without_history').is(':checked')) ? 1 : 0,
                    show_price_exc_tax: ($('#show_price_exc_tax').length && $('#show_price_exc_tax').is(':checked')) ? 1 : 0,
                    show_price: $('.show_price:checked').val()
                };
            }

            function openStockValueReportPrint(tab) {
                var params = getStockValueReportFilterParams();
                params.tab = tab || 'details';
                var url = "<?php echo e(url('reports/stock-value-report-print'), false); ?>?" + $.param(params);
                window.open(url, '_blank');
            }

            if (typeof stock_value_report !== 'undefined' && stock_value_report.button) {
                stock_value_report.button().add(3, {
                    text: '<i class="fa fa-print"></i> ' + <?php echo json_encode(__('messages.print'), 15, 512) ?> + ' A4',
                    className: 'btn-sm btn-primary',
                    attr: {
                        id: 'openStockValueDetailsPrint',
                        'data-tab': 'details',
                    },
                    action: function(e, dt, button) {
                        openStockValueReportPrint($(button).attr('data-tab') || 'details');
                    },
                });
            }

            function loadSVCategorizedReport(page) {
                page = page || sv_categorized_page;
                var url = "<?php echo e(action([\App\Http\Controllers\ReportController::class, 'getStockValueReportCategorized']), false); ?>";
                var data = getStockValueReportFilterParams();
                data.page = page;
                data.per_page = sv_categorized_per_page;
                
                $('#stock_value_categorized_content').html(
                    '<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x"></i><br><br><?php echo app('translator')->get("lang_v1.loading_data"); ?></div>'
                );

                $.ajax({
                    url: url,
                    data: data,
                    success: function(response) {
                        $('#stock_value_categorized_content').html(response);
                        sv_categorized_loaded = true;
                        sv_categorized_page = page;
                    },
                    error: function() {
                        $('#stock_value_categorized_content').html(
                            '<div class="text-center py-4 text-danger"><i class="fas fa-exclamation-triangle"></i> Error loading data</div>'
                        );
                    }
                });
            }

            function loadSVLocationsReport(callback) {
                var url = "<?php echo e(action([\App\Http\Controllers\ReportController::class, 'getStockValueReportLocations']), false); ?>";
                var data = getStockValueReportFilterParams();

                $('#stock_value_locations_content').html(
                    '<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x"></i><br><br><?php echo app('translator')->get("lang_v1.loading_data"); ?></div>'
                );

                $.ajax({
                    url: url,
                    data: data,
                    success: function(response) {
                        $('#stock_value_locations_content').html(response);
                        sv_locations_loaded = true;
                        if (typeof callback === 'function') {
                            callback();
                        }
                    },
                    error: function() {
                        $('#stock_value_locations_content').html(
                            '<div class="text-center py-4 text-danger"><i class="fas fa-exclamation-triangle"></i> Error loading data</div>'
                        );
                        if (typeof callback === 'function') {
                            callback();
                        }
                    }
                });
            }

            function loadSVLocationDetailsReport(callback) {
                var url = "<?php echo e(action([\App\Http\Controllers\ReportController::class, 'getStockValueReportLocationDetails']), false); ?>";
                var data = getStockValueReportFilterParams();

                $('#stock_value_location_details_content').html(
                    '<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x"></i><br><br><?php echo app('translator')->get("lang_v1.loading_data"); ?></div>'
                );

                $.ajax({
                    url: url,
                    data: data,
                    success: function(response) {
                        $('#stock_value_location_details_content').html(response);
                        sv_location_details_loaded = true;
                        if (typeof callback === 'function') {
                            callback();
                        }
                    },
                    error: function() {
                        $('#stock_value_location_details_content').html(
                            '<div class="text-center py-4 text-danger"><i class="fas fa-exclamation-triangle"></i> Error loading data</div>'
                        );
                        if (typeof callback === 'function') {
                            callback();
                        }
                    }
                });
            }

            // Handle pagination link clicks
            $(document).on('click', '.sv-categorized-page-link', function(e) {
                e.preventDefault();
                var $li = $(this).closest('li');
                if ($li.hasClass('disabled') || $li.hasClass('active')) return;
                var page = parseInt($(this).data('page'));
                if (page >= 1) {
                    loadSVCategorizedReport(page);
                }
            });

            // Handle per-page change
            $(document).on('change', '#sv_categorized_per_page', function() {
                sv_categorized_per_page = parseInt($(this).val());
                sv_categorized_page = 1;
                loadSVCategorizedReport(1);
            });

            // Export to Excel
            $(document).on('click', '#exportSVCategorizedExcel', function(e) {
                e.preventDefault();
                var url = "<?php echo e(action([\App\Http\Controllers\ReportController::class, 'exportStockValueReportCategorized']), false); ?>";
                window.location.href = url + '?' + $.param(getStockValueReportFilterParams());
            });

            $(document).on('click', '#exportSVLocationsExcel', function(e) {
                e.preventDefault();
                var url = "<?php echo e(action([\App\Http\Controllers\ReportController::class, 'exportStockValueReportLocations']), false); ?>";
                window.location.href = url + '?' + $.param(getStockValueReportFilterParams());
            });

            $(document).on('click', '#exportSVLocationDetailsExcel', function(e) {
                e.preventDefault();
                var url = "<?php echo e(action([\App\Http\Controllers\ReportController::class, 'exportStockValueReportLocationDetails']), false); ?>";
                window.location.href = url + '?' + $.param(getStockValueReportFilterParams());
            });

            $(document).on('click', '.open-stock-value-report-print', function(e) {
                e.preventDefault();
                openStockValueReportPrint($(this).data('tab') || 'details');
            });

            // Load categorized data when tab is clicked
            $('a[href="#stock_value_categorized_tab"]').on('shown.bs.tab', function() {
                loadSVCategorizedReport(sv_categorized_page);
            });

            $('a[href="#stock_value_locations_tab"]').on('shown.bs.tab', function() {
                if (!sv_locations_loaded) {
                    loadSVLocationsReport();
                }
            });

            $('a[href="#stock_value_location_details_tab"]').on('shown.bs.tab', function() {
                if (!sv_location_details_loaded) {
                    loadSVLocationDetailsReport();
                }
            });

            // Reload lazy tabs when filters change (if tab is active)
            $('#stock_report_filter_form').on('change', 'select, input', function() {
                if ($('#stock_value_categorized_tab').hasClass('active')) {
                    sv_categorized_loaded = false;
                    sv_categorized_page = 1;
                    setTimeout(function() {
                        loadSVCategorizedReport(1);
                    }, 300);
                } else {
                    sv_categorized_loaded = false;
                    sv_categorized_page = 1;
                }

                if ($('#stock_value_locations_tab').hasClass('active')) {
                    sv_locations_loaded = false;
                    setTimeout(function() {
                        loadSVLocationsReport();
                    }, 300);
                } else {
                    sv_locations_loaded = false;
                }

                if ($('#stock_value_location_details_tab').hasClass('active')) {
                    sv_location_details_loaded = false;
                    setTimeout(function() {
                        loadSVLocationDetailsReport();
                    }, 300);
                } else {
                    sv_location_details_loaded = false;
                }
            });

            <?php if(!empty($user_settings['rpt_stock_sval_hide_sku'])): ?>
                stock_value_report.column('variations.sub_sku:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_product'])): ?>
                stock_value_report.column('p.name:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_unit'])): ?>
                stock_value_report.column('units.short_name:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_variation'])): ?>
                stock_value_report.column('variation:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_location'])): ?>
                stock_value_report.column('l.name:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_opening_stock'])): ?>
                stock_value_report.column('opening_stock:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_opening_stock_value'])): ?>
                stock_value_report.column('opening_stock_cost:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_purchase'])): ?>
                stock_value_report.column('quantity_purchase:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_purchase_value'])): ?>
                stock_value_report.column('quantity_purchase_cost:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_purchase_return'])): ?>
                stock_value_report.column('quantity_returned:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_purchase_return_value'])): ?>
                stock_value_report.column('quantity_returned_cost:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_stock_transfer'])): ?>
                stock_value_report.column('total_transfered:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_stock_transfer_value'])): ?>
                stock_value_report.column('total_transfered_cost:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_stock_adjustment'])): ?>
                stock_value_report.column('total_adjusted:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_stock_adjustment_value'])): ?>
                stock_value_report.column('total_adjusted_cost:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_sale'])): ?>
                stock_value_report.column('total_sold:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_sale_value'])): ?>
                stock_value_report.column('total_sold_price:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_sale_return'])): ?>
                stock_value_report.column('total_sale_return:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_sale_return_value'])): ?>
                stock_value_report.column('total_sale_return_price:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_current_stock'])): ?>
                stock_value_report.column('stock:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_sval_hide_total_stock_price'])): ?>
                stock_value_report.column('stock_price:name').visible(false);
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>