
<?php $__env->startSection('title', !empty($common_settings['lot_number_label']) ? $common_settings['lot_number_label'].' '.__('report.report')  : __('lang_v1.lot_report')); ?>
<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>
<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php if(!empty($common_settings['lot_number_label'])): ?> <?php echo e($common_settings['lot_number_label'], false); ?> <?php echo app('translator')->get('report.report'); ?> <?php else: ?> <?php echo app('translator')->get('lang_v1.lot_report'); ?> <?php endif; ?> </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
              <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getStockReport']), 'method' => 'get', 'id' => 'stock_report_filter_form', 'class' => 'row' ]); ?>

                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('location_id',  __('purchase.business_location') . ':'); ?>

                        <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('category_id', __('category.category') . ':'); ?>

                        <?php echo Form::select('category', $categories, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                        <?php echo Form::select('sub_category', array(), null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('brand', __('product.brand') . ':'); ?>

                        <?php echo Form::select('brand', $brands, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('unit',__('product.unit') . ':'); ?>

                        <?php echo Form::select('unit', $units, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <?php if(Module::has('Manufacturing')): ?>
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
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="text-end mb-2">
                <button type="button" class="btn btn-primary open-lot-report-print">
                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="lot_report">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th><?php echo app('translator')->get('business.product'); ?></th>
                            <th><?php if(!empty($common_settings['lot_number_label'])): ?> <?php echo e($common_settings['lot_number_label'], false); ?> <?php else: ?> <?php echo app('translator')->get('lang_v1.lot_number'); ?> <?php endif; ?></th>
                            <th><?php echo app('translator')->get('product.exp_date'); ?></th>
                            <th><?php echo app('translator')->get('report.current_stock'); ?></th>
                            <th><?php echo app('translator')->get('report.total_unit_sold'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.total_unit_adjusted'); ?></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-gray font-17 text-center footer-total">
                            <td colspan="4"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                            <td id="footer_total_stock"></td>
                            <td id="footer_total_sold"></td>
                            <td id="footer_total_adjusted"></td>
                        </tr>
                    </tfoot>
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
    $(document).ready(function(){
        function getLotReportFilterParams() {
            return {
                location_id: $('#location_id').val(),
                category_id: $('#category_id').val(),
                sub_category_id: $('#sub_category_id').val(),
                brand_id: $('#brand').val(),
                unit_id: $('#unit').val(),
                only_mfg_products: $('#only_mfg_products').length && $('#only_mfg_products').is(':checked') ? 1 : 0
            };
        }

        $(document).on('click', '.open-lot-report-print', function(e) {
            e.preventDefault();
            var url = "<?php echo e(url('reports/lot-report-print'), false); ?>?" + $.param(getLotReportFilterParams());
            window.open(url, '_blank');
        });

        <?php if(!empty($user_settings['rpt_stock_lot_hide_sku'])): ?>
            lot_report.column(0).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_lot_hide_product'])): ?>
            lot_report.column(1).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_lot_hide_lot_number'])): ?>
            lot_report.column(2).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_lot_hide_exp_date'])): ?>
            lot_report.column(3).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_lot_hide_current_stock'])): ?>
            lot_report.column(4).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_lot_hide_total_unit_sold'])): ?>
            lot_report.column(5).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_lot_hide_total_unit_adjusted'])): ?>
            lot_report.column(6).visible(false);
        <?php endif; ?>
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>