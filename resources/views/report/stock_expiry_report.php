
<?php $__env->startSection('title', __('report.stock_expiry_report')); ?>
<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>
<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('report.stock_expiry_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
              <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getStockExpiryReport']), 'method' => 'get', 'id' => 'stock_report_filter_form', 'class' => 'row' ]); ?>

                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('location_id',  __('purchase.business_location') . ':'); ?>

                        <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <?php if(session('business.enable_category')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('category_id', __('product.category') . ':'); ?>

                        <?php echo Form::select('category', $categories, null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                        <?php echo Form::select('sub_category', array(), null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('sub2_category_id', __('product.sub2_category') . ':'); ?>

                        <?php echo Form::select('sub2_category', array(), null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub2_category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_brand')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('brand', __('product.brand') . ':'); ?>

                        <?php echo Form::select('brand', $brands, null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('sub_brand_id', __('product.sub_brand') . ':'); ?>

                        <?php echo Form::select('sub_brand_id', [], null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_brand_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_gender')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('gender_id', __('product.gender') . ':'); ?>

                        <?php echo Form::select('gender_id', $genders, null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('sub_gender_id', __('product.sub_gender') . ':'); ?>

                        <?php echo Form::select('sub_gender_id', [], null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_gender_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_procurement_source')): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('procurement_source_id', __('product.procurement_source') . ':'); ?>

                        <?php echo Form::select('procurement_source_id', $procurement_sources, null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('sub_procurement_source_id', __('product.sub_procurement_source') . ':'); ?>

                        <?php echo Form::select('sub_procurement_source_id', [], null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_procurement_source_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('unit', __('product.unit') . ':'); ?>

                        <?php echo Form::select('unit', $units, null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('view_stock_filter', __('report.view_stocks') . ':'); ?>

                        <?php echo Form::select('view_stock_filter', $view_stock_filter, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('expiry_from_date', __('report.expiry_from_date') . ':'); ?>

                        <?php echo Form::date('expiry_from_date', null, ['class' => 'form-control', 'format'=>'yyyy-mm-dd', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('expiry_to_date', __('report.expiry_to_date') . ':'); ?>

                        <?php echo Form::date('expiry_to_date', \Carbon\Carbon::now()->addDays(30)->format('Y-m-d'), ['class' => 'form-control', 'format'=>'yyyy-mm-dd', 'style' => 'width:100%']); ?>

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
            <div class="row mb-2">
                <div class="col-sm-12 text-end">
                    <button type="button" class="btn btn-primary open-stock-expiry-report-print">
                        <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="stock_expiry_report_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('business.product'); ?></th>
                            <th>SKU</th>
                            <!-- <th><?php echo app('translator')->get('purchase.ref_no'); ?></th> -->
                            <th><?php echo app('translator')->get('business.location'); ?></th>
                            <th><?php echo app('translator')->get('report.stock_left'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.lot_number'); ?></th>
                            <th><?php echo app('translator')->get('product.exp_date'); ?></th>
                            <th><?php echo app('translator')->get('product.mfg_date'); ?></th>
                           <!--  <th><?php echo app('translator')->get('messages.edit'); ?></th> -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-gray font-17 text-center footer-total">
                            <td colspan="3"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                            <td id="footer_total_stock_left"></td>
                            <td colspan="3"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<!-- /.content -->

<div class="modal fade exp_update_modal" tabindex="-1" role="dialog">
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
    <script>
    $(document).ready(function(){
        function getStockExpiryReportFilterParams() {
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
                exp_date_filter: $('#view_stock_filter').val(),
                expiry_from_date: $('#expiry_from_date').val(),
                expiry_to_date: $('#expiry_to_date').val(),
                only_mfg_products: ($('#only_mfg_products').length && $('#only_mfg_products').is(':checked')) ? 1 : 0
            };
        }

        $(document).on('click', '.open-stock-expiry-report-print', function(e) {
            e.preventDefault();
            var url = "<?php echo e(url('reports/stock-expiry-print'), false); ?>?" + $.param(getStockExpiryReportFilterParams());
            window.open(url, '_blank');
        });

        <?php if(!empty($user_settings['rpt_stock_sexp_hide_product'])): ?>
            stock_expiry_report_table.column(0).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_sexp_hide_sku'])): ?>
            stock_expiry_report_table.column(1).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_sexp_hide_location'])): ?>
            stock_expiry_report_table.column(2).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_sexp_hide_stock_left'])): ?>
            stock_expiry_report_table.column(3).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_sexp_hide_lot_number'])): ?>
            stock_expiry_report_table.column(4).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_sexp_hide_exp_date'])): ?>
            stock_expiry_report_table.column(5).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_sexp_hide_mfg_date'])): ?>
            stock_expiry_report_table.column(6).visible(false);
        <?php endif; ?>
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>