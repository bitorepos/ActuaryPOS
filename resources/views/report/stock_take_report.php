
<?php $__env->startSection('title', __('report.stock_take_report')); ?>
<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_stock_take_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('report.stock_take_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getStockTakeReport']), 'method' => 'get', 'id' => 'stock_report_filter_form', 'class' => 'row' ]); ?>

            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('location_id', __('purchase.business_location') . ':'); ?>

                    <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <?php if(session('business.enable_category')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('category_id', __('category.category') . ':'); ?>

                    <?php echo Form::select('category', $categories, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                    <?php echo Form::select('sub_category', array(), null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub2_category_id', __('product.sub2_category') . ':'); ?>

                    <?php echo Form::select('sub2_category', array(), null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub2_category_id']); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_brand')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('brand', __('product.brand') . ':'); ?>

                    <?php echo Form::select('brand', $brands, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub_brand_id', __('product.sub_brand') . ':'); ?>

                    <?php echo Form::select('sub_brand_id', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_brand_id']); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_gender')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('gender_id', __('product.gender') . ':'); ?>

                    <?php echo Form::select('gender_id', $genders, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub_gender_id', __('product.sub_gender') . ':'); ?>

                    <?php echo Form::select('sub_gender_id', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_gender_id']); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_procurement_source')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('procurement_source_id', __('product.procurement_source') . ':'); ?>

                    <?php echo Form::select('procurement_source_id', $procurement_sources, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub_procurement_source_id', __('product.sub_procurement_source') . ':'); ?>

                    <?php echo Form::select('sub_procurement_source_id', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_procurement_source_id']); ?>

                </div>
            </div>
            <?php endif; ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('unit',__('product.unit') . ':'); ?>

                    <?php echo Form::select('unit', $units, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

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
                <div class="mb-3">
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
                <div class="mb-3">
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
                <div class="mb-3">
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
                <div class="mb-3">
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
                <div class="mb-3">
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
        <div class="col-md-12">
            <div class="form-group float-end">
                <button type="button" class="btn btn-primary open-stock-take-report-print">
                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                </button>
                <button type="button" class="sync_product_quantity btn btn-info"><?php echo app('translator')->get('lang_v1.sync_product_quantities'); ?> <i class="hide fas fa-sync fa-spin fa-fw"></i></button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="stock_take_report_table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th style="width:350px"><?php echo app('translator')->get('business.product'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.variation'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.rack_details'); ?></th>
                            <th><?php echo app('translator')->get('stock_adjustment.on_hand'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.actual_counted'); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<script>
    $(document).ready(function() {
        function getStockTakeReportFilterParams() {
            return {
                location_id: $('#location_id').val(),
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

        $(document).on('click', '.open-stock-take-report-print', function(e) {
            e.preventDefault();
            var url = "<?php echo e(url('reports/stock-take-report-print'), false); ?>?" + $.param(getStockTakeReportFilterParams());
            window.open(url, '_blank');
        });

        stock_take_report_table.ajax.reload();

        <?php if(!empty($user_settings['rpt_stock_stake_hide_sku'])): ?>
        stock_take_report_table.column(0).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_stake_hide_product'])): ?>
        stock_take_report_table.column(1).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_stake_hide_variation'])): ?>
        stock_take_report_table.column(2).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_stake_hide_rack_details'])): ?>
        stock_take_report_table.column(3).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_stake_hide_on_hand'])): ?>
        stock_take_report_table.column(4).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_stake_hide_actual_counted'])): ?>
        stock_take_report_table.column(5).visible(false);
        <?php endif; ?>
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>