
<?php $__env->startSection('title', __('report.stock_performance_report')); ?>
<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('report.stock_performance_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_stock_performance_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
              <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getStockPerformanceReport']), 'method' => 'get', 'class' => 'row', 'id' => 'stock_performance_filter_form' ]); ?>

                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sp_location_id',  __('purchase.business_location') . ':'); ?>

                        <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sp_location_id']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sp_supplier_id',  __('purchase.supplier') . ':'); ?>

                        <?php echo Form::select('supplier_id', $suppliers, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sp_supplier_id']); ?>

                    </div>
                </div>
                <?php if(session('business.enable_category')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sp_category_id', __('category.category') . ':'); ?>

                        <?php echo Form::select('category_id', $categories, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sp_category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sp_sub_category_id', __('product.sub_category') . ':'); ?>

                        <?php echo Form::select('sub_category_id', array(), null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sp_sub_category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sp_sub2_category_id', __('lang_v1.sub2_category') . ':'); ?>

                        <?php echo Form::select('sub2_category_id', array(), null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sp_sub2_category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_brand')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sp_brand', __('product.brand') . ':'); ?>

                        <?php echo Form::select('brand', $brands, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sp_brand']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sp_sub_brand_id', __('product.sub_brand') . ':'); ?>

                        <?php echo Form::select('sub_brand_id', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sp_sub_brand_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_gender')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sp_gender_id', __('product.gender') . ':'); ?>

                        <?php echo Form::select('gender_id', $genders, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sp_gender_id']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sp_sub_gender_id', __('product.sub_gender') . ':'); ?>

                        <?php echo Form::select('sub_gender_id', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sp_sub_gender_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_procurement_source')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sp_procurement_source_id', __('product.procurement_source') . ':'); ?>

                        <?php echo Form::select('procurement_source_id', $procurement_sources, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sp_procurement_source_id']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sp_sub_procurement_source_id', __('product.sub_procurement_source') . ':'); ?>

                        <?php echo Form::select('sub_procurement_source_id', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sp_sub_procurement_source_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sp_date_range', __('report.date_range') . ':'); ?>

                        <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'sp_date_range', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <br>
                        <label>
                            <?php echo Form::checkbox('show_on_hand_zero_quantity', 1, false, ['class' => 'form-check-input', 'id' => 'sp_show_on_hand_zero_quantity']); ?>

                            <?php echo app('translator')->get('report.show_on_hand_zero_quantity'); ?>
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <br>
                        <label>
                            <?php echo Form::checkbox('show_zero_qty_sold_quantity', 1, false, ['class' => 'form-check-input', 'id' => 'sp_show_zero_qty_sold_quantity']); ?>

                            <?php echo app('translator')->get('report.show_zero_qty_sold_quantity'); ?>
                        </label>
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
                    <li class="active">
                        <a href="#sp_summary_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list" aria-hidden="true"></i> <?php echo app('translator')->get('report.summary'); ?></a>
                    </li>
                    <li>
                        <a href="#sp_average_sold_tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-chart-bar" aria-hidden="true"></i> <?php echo app('translator')->get('report.average_sold'); ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="sp_summary_tab">
                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-primary stock-performance-print-btn" data-tab="summary">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <?php echo $__env->make('report.partials.stock_performance_summary_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    
                    <div class="tab-pane" id="sp_average_sold_tab">
                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-primary stock-performance-print-btn" data-tab="average_sold">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <?php echo $__env->make('report.partials.stock_performance_average_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
    <script>
    window.hideStockPerformanceReportCostProfit = <?php echo e(! empty($hide_stock_performance_report_cost_profit) ? 'true' : 'false', false); ?>;
    $(document).ready(function(){
        var stockPerformanceReloadTimer = null;
        var reloadStockPerformanceTables = function () {
            clearTimeout(stockPerformanceReloadTimer);
            stockPerformanceReloadTimer = setTimeout(function () {
                if (typeof stock_performance_summary_table !== 'undefined') {
                    stock_performance_summary_table.ajax.reload();
                }
                if (typeof stock_performance_average_table !== 'undefined') {
                    stock_performance_average_table.ajax.reload();
                }
            }, 50);
        };

        var setStockPerformanceDateRange = function (start, end) {
            $('#sp_date_range').val(
                start.format(moment_date_format) + ' - ' + end.format(moment_date_format)
            );
        };

        // Date range picker for stock performance report
        if ($('#sp_date_range').length == 1) {
            var stockPerformanceDateRangeSettings = window.getAdminReportDateRangeSettings();
            stockPerformanceDateRangeSettings.autoUpdateInput = false;
            stockPerformanceDateRangeSettings.locale = $.extend({}, stockPerformanceDateRangeSettings.locale, {
                format: moment_date_format,
                cancelLabel: LANG.clear,
                applyLabel: LANG.apply,
                customRangeLabel: LANG.custom_range,
            });

            $('#sp_date_range').daterangepicker(stockPerformanceDateRangeSettings, function (start, end) {
                setStockPerformanceDateRange(start, end);
                reloadStockPerformanceTables();
            });

            var stockPerformanceDatePicker = $('#sp_date_range').data('daterangepicker');
            setStockPerformanceDateRange(stockPerformanceDatePicker.startDate, stockPerformanceDatePicker.endDate);
            reloadStockPerformanceTables();

            $('#sp_date_range').on('apply.daterangepicker', function (ev, picker) {
                setStockPerformanceDateRange(picker.startDate, picker.endDate);
                reloadStockPerformanceTables();
            });

            $('#sp_date_range').on('cancel.daterangepicker', function (ev, picker) {
                $('#sp_date_range').val('');
                reloadStockPerformanceTables();
                picker.hide();
            });

            $('#sp_date_range').on('show.daterangepicker', function (ev, picker) {
                picker.container.find('.ranges li').off('click.stockPerformance').on('click.stockPerformance', function () {
                    setTimeout(function () {
                        setStockPerformanceDateRange(picker.startDate, picker.endDate);
                        reloadStockPerformanceTables();
                        picker.hide();
                    }, 0);
                });
            });
        }

        // Cascade sub-categories
        $('#sp_category_id').change(function () {
            var cat = $(this).val();
            $('#sp_sub2_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>');
            $.ajax({
                method: 'POST',
                url: '/products/get_sub_categories',
                dataType: 'html',
                data: { cat_id: cat },
                success: function (result) {
                    if (result) {
                        $('#sp_sub_category_id').html(result);
                    }
                },
            });
        });

        // Cascade sub2-categories
        $('#sp_sub_category_id').change(function () {
            var sub_cat = $(this).val();
            $.ajax({
                method: 'POST',
                url: '/products/get_sub_categories',
                dataType: 'html',
                data: { cat_id: sub_cat },
                success: function (result) {
                    if (result) {
                        $('#sp_sub2_category_id').html(result);
                    }
                },
            });
        });

        // Cascade sub-brands
        $('#sp_brand').change(function () {
            var brand_id = $(this).val();
            $('#sp_sub_brand_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>');
            if (brand_id) {
                $.ajax({ method: 'POST', url: '/brands/get_sub_brands', dataType: 'html',
                    data: { brand_id: brand_id },
                    success: function (result) { if (result) { $('#sp_sub_brand_id').append(result); } }
                });
            }
        });

        // Cascade sub-genders
        $('#sp_gender_id').change(function () {
            var gender_id = $(this).val();
            $('#sp_sub_gender_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>');
            if (gender_id) {
                $.ajax({ method: 'POST', url: '/genders/get_sub_genders', dataType: 'html',
                    data: { gender_id: gender_id },
                    success: function (result) { if (result) { $('#sp_sub_gender_id').append(result); } }
                });
            }
        });

        // Cascade sub-procurement-sources
        $('#sp_procurement_source_id').change(function () {
            var proc_id = $(this).val();
            $('#sp_sub_procurement_source_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>');
            if (proc_id) {
                $.ajax({ method: 'POST', url: '/procurement-sources/get_sub_procurement_sources', dataType: 'html',
                    data: { procurement_source_id: proc_id },
                    success: function (result) { if (result) { $('#sp_sub_procurement_source_id').append(result); } }
                });
            }
        });

        // Reload both tables on filter change
        $('#stock_performance_filter_form #sp_location_id, #stock_performance_filter_form #sp_supplier_id, #stock_performance_filter_form #sp_category_id, #stock_performance_filter_form #sp_sub_category_id, #stock_performance_filter_form #sp_sub2_category_id, #stock_performance_filter_form #sp_brand, #stock_performance_filter_form #sp_sub_brand_id, #stock_performance_filter_form #sp_gender_id, #stock_performance_filter_form #sp_sub_gender_id, #stock_performance_filter_form #sp_procurement_source_id, #stock_performance_filter_form #sp_sub_procurement_source_id, #stock_performance_filter_form #sp_show_on_hand_zero_quantity, #stock_performance_filter_form #sp_show_zero_qty_sold_quantity').change(function () {
            reloadStockPerformanceTables();
        });

        // Recalculate column widths when switching tabs
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            if ($(e.target).attr('href') == '#sp_summary_tab' && typeof stock_performance_summary_table !== 'undefined') {
                stock_performance_summary_table.columns.adjust().draw(false);
            }
            if ($(e.target).attr('href') == '#sp_average_sold_tab' && typeof stock_performance_average_table !== 'undefined') {
                stock_performance_average_table.columns.adjust().draw(false);
            }
        });

        function getStockPerformancePrintParams(tab) {
            return $.param({
                tab: tab,
                location_id: $('#sp_location_id').val(),
                supplier_id: $('#sp_supplier_id').val(),
                category_id: $('#sp_category_id').val(),
                sub_category_id: $('#sp_sub_category_id').val(),
                sub2_category_id: $('#sp_sub2_category_id').val(),
                brand_id: $('#sp_brand').val(),
                sub_brand_id: $('#sp_sub_brand_id').val(),
                gender_id: $('#sp_gender_id').val(),
                sub_gender_id: $('#sp_sub_gender_id').val(),
                procurement_source_id: $('#sp_procurement_source_id').val(),
                sub_procurement_source_id: $('#sp_sub_procurement_source_id').val(),
                date_range: $('#sp_date_range').val(),
                show_on_hand_zero_quantity: $('#sp_show_on_hand_zero_quantity').is(':checked') ? 1 : 0,
                show_zero_qty_sold_quantity: $('#sp_show_zero_qty_sold_quantity').is(':checked') ? 1 : 0
            });
        }

        $(document).on('click', '.stock-performance-print-btn', function () {
            var query = getStockPerformancePrintParams($(this).data('tab'));
            window.open("<?php echo e(url('reports/stock-performance-report-print'), false); ?>?" + query, '_blank');
        });
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>