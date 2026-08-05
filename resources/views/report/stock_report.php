
<?php $__env->startSection('title', __('report.stock_report')); ?>
<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_stock_quantity_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('report.stock_report'), false); ?></h1>
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
                <?php if(session('business.enable_category')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('category_id', __('category.category') . ':'); ?>

                        <?php echo Form::select('category_id', $categories, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                        <?php echo Form::select('sub_category_id', array(), null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); ?>

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
                    <div class="mb-3">
                        <?php echo Form::label('supplier_id', __('purchase.supplier') . ':'); ?>

                        <?php echo Form::select('supplier_id', $suppliers, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <?php if(session('business.enable_brand')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('brand_id', __('product.brand') . ':'); ?>

                        <?php echo Form::select('brand_id', $brands, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <?php if(session('business.enable_brand') && session('business.enable_sub_brand')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('sub_brand_id', __('product.sub_brand') . ':'); ?>

                        <?php echo Form::select('sub_brand_id', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_brand_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>
                <?php if(session('business.enable_gender')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('gender_id', __('product.gender') . ':'); ?>

                        <?php echo Form::select('gender_id', $genders, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <?php if(session('business.enable_gender') && session('business.enable_sub_gender')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('sub_gender_id', __('product.sub_gender') . ':'); ?>

                        <?php echo Form::select('sub_gender_id', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_gender_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>
                <?php if(session('business.enable_procurement_source')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('procurement_source_id', __('product.procurement_source') . ':'); ?>

                        <?php echo Form::select('procurement_source_id', $procurement_sources, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <?php if(session('business.enable_procurement_source') && session('business.enable_sub_procurement_source')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('sub_procurement_source_id', __('product.sub_procurement_source') . ':'); ?>

                        <?php echo Form::select('sub_procurement_source_id', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_procurement_source_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('unit',__('product.unit') . ':'); ?>

                        <?php echo Form::select('unit', $units, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('pr_rack',__('lang_v1.rack') . ':'); ?>

                        <?php echo Form::select('pr_rack', $racks, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('pr_row',__('lang_v1.row') . ':'); ?>

                        <?php echo Form::select('pr_row', $rows, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('pr_pos',__('lang_v1.position') . ':'); ?>

                        <?php echo Form::select('pr_pos', $positions, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
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
    <?php if(! empty($show_stock_report_cost_value) || ! empty($show_stock_report_sale_value) || ! empty($show_stock_report_potential_profit)): ?>
    <div class="row hide">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <table class="table no-border">
                <tr>
                    <?php if(! empty($show_stock_report_sale_value)): ?>
                    <td><?php echo app('translator')->get('report.closing_stock'); ?> (<?php echo app('translator')->get('lang_v1.by_sale_price'); ?>)</td>
                    <?php endif; ?>
                    <?php if(! empty($show_stock_report_cost_value)): ?>
                    <td><?php echo app('translator')->get('report.closing_stock'); ?> (<?php echo app('translator')->get('lang_v1.by_purchase_price'); ?>)</td>
                    <?php endif; ?>
                    <?php if(! empty($show_stock_report_potential_profit)): ?>
                    <td><?php echo app('translator')->get('lang_v1.potential_profit'); ?></td>
                    <td><?php echo app('translator')->get('lang_v1.profit_margin'); ?></td>
                    <td><?php echo app('translator')->get('lang_v1.profit_markup'); ?></td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <?php if(! empty($show_stock_report_sale_value)): ?>
                    <td><h3 id="closing_stock_by_sp" class="mb-0 mt-0"></h3></td>
                    <?php endif; ?>
                    <?php if(! empty($show_stock_report_cost_value)): ?>
                    <td><h3 id="closing_stock_by_pp" class="mb-0 mt-0"></h3></td>
                    <?php endif; ?>
                    <?php if(! empty($show_stock_report_potential_profit)): ?>
                    <td><h3 id="potential_profit" class="mb-0 mt-0"></h3></td>
                    <td><h3 id="profit_margin" class="mb-0 mt-0"></h3></td>
                    <td><h3 id="profit_markup" class="mb-0 mt-0"></h3></td>
                    <?php endif; ?>
                </tr>
            </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <?php endif; ?>

    
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#stock_report_details_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list" aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.details'); ?></a>
                    </li>
                    <li>
                        <a href="#stock_report_categorized_tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-th-large" aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.categorized'); ?></a>
                    </li>
                    <li>
                        <a href="#stock_report_locations_tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-map-marker" aria-hidden="true"></i> Locations</a>
                    </li>
                </ul>
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="stock_report_details_tab">
                        <?php echo $__env->make('report.partials.stock_report_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    
                    <div class="tab-pane" id="stock_report_categorized_tab">
                        <?php echo $__env->make('report.partials.stock_report_categorized', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    
                    <div class="tab-pane" id="stock_report_locations_tab">
                        <?php echo $__env->make('report.partials.stock_report_locations', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="loading" style="display: none">
        
        <div class="loading-animation"></div>
    </div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
    <script>
        $(document).ready(function() {
            var categorized_loaded = false;
            var categorized_page = 1;
            var categorized_per_page = 5;
            var locations_loaded = false;

            function getStockReportFilterParams() {
                return {
                    location_id: $('#location_id').val(),
                    supplier_id: $('#supplier_id').val(),
                    category_id: $('#category_id').val(),
                    sub_category_id: $('#sub_category_id').val(),
                    sub2_category_id: $('#sub2_category_id').val(),
                    brand_id: $('#brand_id').val(),
                    sub_brand_id: $('#sub_brand_id').val(),
                    gender_id: $('#gender_id').val(),
                    sub_gender_id: $('#sub_gender_id').val(),
                    procurement_source_id: $('#procurement_source_id').val(),
                    sub_procurement_source_id: $('#sub_procurement_source_id').val(),
                    unit_id: $('#unit').val(),
                    pr_rack: $('#pr_rack').val(),
                    pr_row: $('#pr_row').val(),
                    pr_pos: $('#pr_pos').val(),
                    only_mfg_products: ($('#only_mfg_products').length && $('#only_mfg_products').is(':checked')) ? 1 : 0,
                    show_positive_quantity: ($('#show_positive_quantity').length && $('#show_positive_quantity').is(':checked')) ? 1 : 0,
                    show_negative_quantity: ($('#show_negative_quantity').length && $('#show_negative_quantity').is(':checked')) ? 1 : 0,
                    show_zero_quantity: ($('#show_zero_quantity').length && $('#show_zero_quantity').is(':checked')) ? 1 : 0,
                    show_without_history: ($('#show_without_history').length && $('#show_without_history').is(':checked')) ? 1 : 0,
                    show_price_exc_tax: ($('#show_price_exc_tax').length && $('#show_price_exc_tax').is(':checked')) ? 1 : 0
                };
            }

            function loadCategorizedReport(page) {
                page = page || categorized_page;
                var url = "<?php echo e(action([\App\Http\Controllers\ReportController::class, 'getStockReportCategorized']), false); ?>";
                var data = getStockReportFilterParams();
                data.page = page;
                data.per_page = categorized_per_page;
                
                $('#stock_report_categorized_content').html(
                    '<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x"></i><br><br><?php echo app('translator')->get("lang_v1.loading_data"); ?></div>'
                );

                $.ajax({
                    url: url,
                    data: data,
                    success: function(response) {
                        $('#stock_report_categorized_content').html(response);
                        categorized_loaded = true;
                        categorized_page = page;
                    },
                    error: function() {
                        $('#stock_report_categorized_content').html(
                            '<div class="text-center py-4 text-danger"><i class="fas fa-exclamation-triangle"></i> Error loading data</div>'
                        );
                    }
                });
            }

            function loadLocationsReport() {
                var url = "<?php echo e(action([\App\Http\Controllers\ReportController::class, 'getStockReportLocations']), false); ?>";
                var data = getStockReportFilterParams();

                $('#stock_report_locations_content').html(
                    '<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x"></i><br><br><?php echo app('translator')->get("lang_v1.loading_data"); ?></div>'
                );

                $.ajax({
                    url: url,
                    data: data,
                    success: function(response) {
                        $('#stock_report_locations_content').html(response);
                        locations_loaded = true;
                    },
                    error: function() {
                        $('#stock_report_locations_content').html(
                            '<div class="text-center py-4 text-danger"><i class="fas fa-exclamation-triangle"></i> Error loading data</div>'
                        );
                    }
                });
            }

            // Handle pagination link clicks
            $(document).on('click', '.categorized-page-link', function(e) {
                e.preventDefault();
                var $li = $(this).closest('li');
                if ($li.hasClass('disabled') || $li.hasClass('active')) return;
                var page = parseInt($(this).data('page'));
                if (page >= 1) {
                    loadCategorizedReport(page);
                }
            });

            // Handle per-page change
            $(document).on('change', '#categorized_per_page', function() {
                categorized_per_page = parseInt($(this).val());
                categorized_page = 1;
                loadCategorizedReport(1);
            });

            // Export to Excel
            $(document).on('click', '#exportCategorizedExcel', function(e) {
                e.preventDefault();
                var url = "<?php echo e(action([\App\Http\Controllers\ReportController::class, 'exportStockReportCategorized']), false); ?>";
                window.location.href = url + '?' + $.param(getStockReportFilterParams());
            });

            // Crystal-report style printable Stock Report (A4 with branding, zoom, page nav, export)
            $(document).on('click', '.open-stock-report-print', function(e) {
                e.preventDefault();
                var params = getStockReportFilterParams();
                params.tab = $(this).data('tab') || 'details';
                var url = "<?php echo e(url('reports/stock-report-print'), false); ?>?" + $.param(params);
                window.open(url, '_blank');
            });

            // Load categorized data when tab is clicked
            $('a[href="#stock_report_categorized_tab"]').on('shown.bs.tab', function() {
                loadCategorizedReport(categorized_page);
            });

            $('a[href="#stock_report_locations_tab"]').on('shown.bs.tab', function() {
                if (!locations_loaded) {
                    loadLocationsReport();
                }
            });

            // Reload lazy tabs when filters change (if tab is active)
            $('#stock_report_filter_form').on('change', 'select, input', function() {
                if ($('#stock_report_categorized_tab').hasClass('active')) {
                    categorized_loaded = false;
                    categorized_page = 1;
                    setTimeout(function() {
                        loadCategorizedReport(1);
                    }, 300);
                } else {
                    categorized_loaded = false;
                    categorized_page = 1;
                }

                if ($('#stock_report_locations_tab').hasClass('active')) {
                    locations_loaded = false;
                    setTimeout(function() {
                        loadLocationsReport();
                    }, 300);
                } else {
                    locations_loaded = false;
                }
            });

            <?php if(!empty($user_settings['rpt_stock_stock_hide_sku'])): ?>
                stock_report_table.column('variations.sub_sku:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_product'])): ?>
                stock_report_table.column('p.name:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_variation'])): ?>
                stock_report_table.column('variation:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_category'])): ?>
                stock_report_table.column('c.name:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_sub_category'])): ?>
                stock_report_table.column('sub_category_name:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_sub2_category'])): ?>
                stock_report_table.column('sub2_category_name:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_brand'])): ?>
                stock_report_table.column('brand_name:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_sub_brand'])): ?>
                stock_report_table.column('sub_brand_name:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_gender'])): ?>
                stock_report_table.column('gender_name:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_sub_gender'])): ?>
                stock_report_table.column('sub_gender_name:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_procurement_source'])): ?>
                stock_report_table.column('procurement_source_name:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_sub_procurement_source'])): ?>
                stock_report_table.column('sub_procurement_source_name:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_location'])): ?>
                stock_report_table.column('l.name:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_unit_cost_price'])): ?>
                stock_report_table.column('cost_price:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_unit_selling_price'])): ?>
                stock_report_table.column('variations.sell_price_inc_tax:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_current_stock'])): ?>
                stock_report_table.column('stock:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_total_stock_purchase'])): ?>
                stock_report_table.column('stock_price:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($hide_stock_report_cost_value)): ?>
                stock_report_table.column('stock_price:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_total_stock_sale'])): ?>
                stock_report_table.column('stock_value_by_sale_price:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($hide_stock_report_sale_value)): ?>
                stock_report_table.column('stock_value_by_sale_price:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_potential_profit'])): ?>
                stock_report_table.column('potential_profit:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($hide_stock_report_potential_profit)): ?>
                stock_report_table.column('potential_profit:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_total_unit_sold'])): ?>
                stock_report_table.column('total_sold:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_total_unit_transferred'])): ?>
                stock_report_table.column('total_transfered:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_total_unit_adjusted'])): ?>
                stock_report_table.column('total_adjusted:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_rack_details'])): ?>
                stock_report_table.column('rack_details:name').visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['rpt_stock_stock_hide_current_stock_mfg'])): ?>
                stock_report_table.column('total_mfg_stock:name').visible(false);
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>