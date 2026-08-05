
<?php $__env->startSection('title', __('lang_v1.opening_stock_report')); ?>
<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_opening_stock_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo e(__('lang_v1.opening_stock_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getStockReport']), 'method'
            => 'get', 'id' => 'opening_stock_report_form', 'class' => 'row' ]); ?>

            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('location_id', __('purchase.business_location').':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.please_select'), 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('search_product', __('lang_v1.search_product') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-search"></i>
                        </span>
                        <input type="hidden" value="" id="variation_id">
                        <?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product',
                        'placeholder' => __('lang_v1.search_product_placeholder'), 'autofocus']); ?>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('category_id', __('product.category') . ':'); ?>

                    <?php echo Form::select('category_id', $categories, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'osr_filter_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('brand_id', __('product.brand') . ':'); ?>

                    <?php echo Form::select('brand_id', $brands, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'osr_filter_brand_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('osr_date_filter', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' =>
                    'form-control', 'id' => 'osr_date_filter', 'readonly']); ?>

                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.view')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <label>&nbsp;</label>
                    <button type="button" class="btn btn-warning btn-block" id="reindex_opening_stock_report">
                        <i class="fas fa-sync"></i> <?php echo app('translator')->get('lang_v1.reindex_stock_quantities'); ?>
                    </button>
                </div>
            </div>
            <?php endif; ?>
            <?php echo Form::close(); ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.view')): ?>
            <div class="alert alert-info" style="margin-top: 12px; margin-bottom: 0;">
                <i class="fas fa-info-circle"></i>
                Reindex applies only to the rows currently shown in this report table. Use <strong>Show entries</strong> to choose the batch size; maximum allowed per run is 500 products.
            </div>
            <?php endif; ?>
            <div id="opening_stock_reindex_progress_wrap" style="display:none; margin-top: 12px;">
                <div class="progress progress-sm active" style="margin-bottom: 6px;">
                    <div id="opening_stock_reindex_progress_bar" class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="width: 0%;"></div>
                </div>
                <div class="text-muted" id="opening_stock_reindex_progress_text">Preparing opening stock reindex...</div>
            </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="row mb-2">
                <div class="col-sm-12 text-end">
                    <button type="button" class="btn btn-primary open-opening-stock-report-print">
                        <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                    </button>
                </div>
            </div>
            <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="opening_stock_report_table">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th><?php echo app('translator')->get('business.product'); ?></th>
                        <th><?php echo app('translator')->get('product.unit'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('sale.qty'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.quantity_left'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('sale.unit_price'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                        <th class="text-right"><?php echo app('translator')->get('sale.subtotal'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.note'); ?></th>
                        <th><?php echo app('translator')->get('sale.location'); ?></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="bg-gray font-17 footer-total">
                        <td colspan="2" class="text-center"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                        <td></td>
                        <td id="footer_total_quantity" class="text-right"></td>
                        <td id="footer_total_remaining_qty" class="text-right"></td>
                        <td></td>
                        <td id="footer_total_subtotal" class="text-right"></td>
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
<div class="modal fade view_register" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<script>
$(document).ready(function(){
    function getOpeningStockReportFilterParams() {
        var start = '';
        var end = '';
        if ($('#osr_date_filter').val()) {
            start = $('input#osr_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
            end = $('input#osr_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
        }

        return {
            start_date: start,
            end_date: end,
            variation_id: $('#variation_id').val(),
            location_id: $('select#location_id').val(),
            category_id: $('select#osr_filter_category_id').val(),
            brand_id: $('select#osr_filter_brand_id').val()
        };
    }

    $(document).on('click', '.open-opening-stock-report-print', function(e) {
        e.preventDefault();
        var url = "<?php echo e(url('reports/opening-stock-report-print'), false); ?>?" + $.param(getOpeningStockReportFilterParams());
        window.open(url, '_blank');
    });

    <?php if(!empty($hide_opening_stock_report_cost_value)): ?>
        opening_stock_report.column(5).visible(false);
        opening_stock_report.column(6).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_ostock_hide_sku'])): ?>
        opening_stock_report.column(0).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_ostock_hide_product'])): ?>
        opening_stock_report.column(1).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_ostock_hide_qty'])): ?>
        opening_stock_report.column(3).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_ostock_hide_qty_left'])): ?>
        opening_stock_report.column(4).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_ostock_hide_unit_price'])): ?>
        opening_stock_report.column(5).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_ostock_hide_subtotal'])): ?>
        opening_stock_report.column(6).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_ostock_hide_date'])): ?>
        opening_stock_report.column(7).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_ostock_hide_note'])): ?>
        opening_stock_report.column(8).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_stock_ostock_hide_location'])): ?>
        opening_stock_report.column(9).visible(false);
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>