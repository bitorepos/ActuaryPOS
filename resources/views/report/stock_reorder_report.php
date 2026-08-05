
<?php $__env->startSection('title', __('report.stock_reorder_report')); ?>
<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_stock_reorder_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('report.stock_reorder_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
              <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getStockReport']), 'method' => 'get', 'class' => 'row', 'id' => 'stock_report_filter_form' ]); ?>

                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('location_id',  __('purchase.business_location') . ':'); ?>

                        <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('supplier_id',  __('purchase.supplier') . ':'); ?>

                        <?php echo Form::select('supplier_id', $suppliers, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

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
                

                
                <?php echo Form::close(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                <?php echo $__env->make('report.partials.stock_reorder_report_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
    <script>
    $(document).ready(function(){
        function getStockReorderReportFilterParams() {
            return {
                location_id: $('#location_id').val(),
                supplier_id: $('#supplier_id').val(),
                category_id: $('#category_id').val(),
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
                show_price_exc_tax: ($('#show_price_exc_tax').length && $('#show_price_exc_tax').is(':checked')) ? 1 : 0
            };
        }

        $(document).on('click', '.open-stock-reorder-report-print', function(e) {
            e.preventDefault();
            var url = "<?php echo e(url('reports/stock-reorder-report-print'), false); ?>?" + $.param(getStockReorderReportFilterParams());
            window.open(url, '_blank');
        });

        <?php if(!empty($user_settings['rpt_stock_sreorder_hide_sku'])): ?>
            stock_reorder_report_table.column(1).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_sreorder_hide_product'])): ?>
            stock_reorder_report_table.column(2).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_sreorder_hide_variation'])): ?>
            stock_reorder_report_table.column(3).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_sreorder_hide_category'])): ?>
            stock_reorder_report_table.column(4).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_sreorder_hide_location'])): ?>
            stock_reorder_report_table.column(5).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_sreorder_hide_current_stock'])): ?>
            stock_reorder_report_table.column(6).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_sreorder_hide_alert_qty_low'])): ?>
            stock_reorder_report_table.column(7).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_sreorder_hide_alert_qty_medium'])): ?>
            stock_reorder_report_table.column(8).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_sreorder_hide_alert_qty_high'])): ?>
            stock_reorder_report_table.column(9).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_sreorder_hide_alert_qty_max'])): ?>
            stock_reorder_report_table.column(10).visible(false);
        <?php endif; ?>
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>