
<?php $__env->startSection('title', __('lang_v1.product_purchase_report')); ?>
<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_product_purchase_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>
    table[id^="product_purchase_report"] tfoot td.text-right p {
        text-align: right;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('lang_v1.product_purchase_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getStockReport']), 'method'
            => 'get', 'id' => 'product_purchase_report_form', 'class' => 'row', ]); ?>

            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('location_id', __('purchase.business_location').':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.please_select'), 'required', 'style' => 'width:80%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('search_product', __('lang_v1.search_product') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                        <input type="hidden" value="" id="variation_id">
                        <?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product',
                        'placeholder' => __('lang_v1.search_product_placeholder'), 'autofocus']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('supplier_id', __('purchase.supplier') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('supplier_id', $suppliers, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.please_select'), 'required', 'style' => 'width:80%']); ?>

                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group mb-2">

                    <?php echo Form::label('product_pr_date_filter', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' =>
                    'form-control', 'id' => 'product_pr_date_filter', 'readonly']); ?>

                </div>
            </div>

            <?php if(session('business.enable_category')): ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('category_id', __('product.category') . ':'); ?>

                    <?php echo Form::select('category_id', $categories, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'ppr_filter_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                    <?php echo Form::select('sub_category_id', array(), null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'ppr_filter_sub_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category')): ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('sub2_category_id', __('product.sub2_category') . ':'); ?>

                    <?php echo Form::select('sub2_category_id', array(), null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'ppr_filter_sub2_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_brand')): ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('ppr_brand_id', __('product.brand').':'); ?>

                    <?php echo Form::select('ppr_brand_id', $brands, null, ['class' => 'form-control select2', 'placeholder' =>
                    __('lang_v1.all'), 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('ppr_sub_brand_id', __('product.sub_brand').':'); ?>

                    <?php echo Form::select('ppr_sub_brand_id', [], null, ['class' => 'form-control select2', 'placeholder' =>
                    __('lang_v1.all'), 'style' => 'width:100%']); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_gender')): ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('ppr_gender_id', __('product.gender').':'); ?>

                    <?php echo Form::select('ppr_gender_id', $genders, null, ['class' => 'form-control select2', 'placeholder' =>
                    __('lang_v1.all'), 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('ppr_sub_gender_id', __('product.sub_gender').':'); ?>

                    <?php echo Form::select('ppr_sub_gender_id', [], null, ['class' => 'form-control select2', 'placeholder' =>
                    __('lang_v1.all'), 'style' => 'width:100%']); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_procurement_source')): ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('ppr_procurement_source_id', __('product.procurement_source').':'); ?>

                    <?php echo Form::select('ppr_procurement_source_id', $procurement_sources, null, ['class' => 'form-control select2', 'placeholder' =>
                    __('lang_v1.all'), 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('ppr_sub_procurement_source_id', __('product.sub_procurement_source').':'); ?>

                    <?php echo Form::select('ppr_sub_procurement_source_id', [], null, ['class' => 'form-control select2', 'placeholder' =>
                    __('lang_v1.all'), 'style' => 'width:100%']); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php echo Form::close(); ?>

            <?php echo $__env->renderComponent(); ?>
            <input id="enable_inline_product_note_purchase" type="hidden" value='<?php echo e(!empty($common_settings["enable_inline_product_note_purchase"]) ? 1 : 0, false); ?>'>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#ppr_summary_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.summary'); ?></a>
                    </li>
                    <li>
                        <a href="#ppr_detailed_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.detailed'); ?></a>
                    </li>
                    <li>
                        <a href="#ppr_by_cat_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-bars"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.by_category'); ?></a>
                    </li>
                    <?php if(session('business.enable_sub_category')): ?>
                    <li>
                        <a href="#ppr_by_sub_cat_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-bars"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.by_sub_category'); ?></a>
                    </li>
                    <?php endif; ?>
                    <li>
                        <a href="#ppr_by_sub2_cat_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-bars"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.by_sub2_category'); ?></a>
                    </li>
                    <li>
                        <a href="#ppr_by_brand_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-bars"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.by_brand'); ?></a>
                    </li>
                    <li>
                        <a href="#ppr_by_gender_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-bars"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.by_gender'); ?></a>
                    </li>
                    <li>
                        <a href="#ppr_by_procurement_source_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-bars"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.by_procurement_source'); ?></a>
                    </li>
                    <li>
                        <a href="#ppr_not_purchased" data-toggle="tab" aria-expanded="true"><i class="fa fa-bars"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.not_purchased'); ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="ppr_summary_tab">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end open-product-purchase-report-print" data-tab="summary">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin" id="product_purchase_report_summary_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                                        <th style="width:450px"><?php echo app('translator')->get('sale.product'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.qty'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.total_unit_adjusted'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.average_product'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> ()</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td colspan="2"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td id="footer_total_purchase_summary" class="text-right"></td>
                                        <td id="footer_total_adjusted_summary" class="text-right"></td>
                                        <td></td>
                                        <td class="text-right"><span class="display_currency" id="footer_subtotal_summary"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="ppr_detailed_tab">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end open-product-purchase-report-print" data-tab="detailed">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin" id="product_purchase_report_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                                        <th style="width:450px"><?php echo app('translator')->get('sale.product'); ?></th>
                                        <?php if(!empty($common_settings['enable_inline_product_note_purchase'])): ?>
                                        <th><?php echo app('translator')->get('lang_v1.product_note'); ?></th>
                                        <?php endif; ?>
                                        <th style="width:350px"><?php echo app('translator')->get('purchase.supplier'); ?></th>
                                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.qty'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.total_unit_adjusted'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.unit_perchase_price'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.subtotal'); ?> ()</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td colspan="<?php echo e(!empty($common_settings['enable_inline_product_note_purchase']) ? 6 : 5, false); ?>"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td id="footer_total_purchase" class="text-right"></td>
                                        <td id="footer_total_adjusted" class="text-right"></td>
                                        <td></td>
                                        <td class="text-right"><span class="display_currency" id="footer_subtotal"></span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="ppr_by_cat_tab">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end open-product-purchase-report-print" data-tab="by_category">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin"
                                id="product_purchase_report_by_category" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('product.category'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.qty'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> ()</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td id="footer_total_by_cat_purchase" class="text-right"></td>
                                        <td class="text-right"><span class="display_currency" id="footer_subtotal_by_cat"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="ppr_by_sub_cat_tab">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end open-product-purchase-report-print" data-tab="by_sub_category">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin"
                                id="product_purchase_report_by_sub_category" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('product.sub_category'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.qty'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> ()</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td id="footer_total_by_sub_cat_purchase" class="text-right"></td>
                                        <td class="text-right"><span class="display_currency" id="footer_subtotal_by_sub_cat"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="ppr_by_sub2_cat_tab">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end open-product-purchase-report-print" data-tab="by_sub2_category">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin"
                                id="product_purchase_report_by_sub2_category" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang_v1.sub2_category'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.qty'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> ()</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td id="footer_total_by_sub2_cat_purchase" class="text-right"></td>
                                        <td class="text-right"><span class="display_currency" id="footer_subtotal_by_sub2_cat"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="ppr_by_brand_tab">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end open-product-purchase-report-print" data-tab="by_brand">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin"
                                id="product_purchase_report_by_brand" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('product.brand'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.qty'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> ()</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td id="footer_total_by_brand_purchase" class="text-right"></td>
                                        <td class="text-right"><span class="display_currency" id="footer_subtotal_by_brand"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="ppr_by_gender_tab">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end open-product-purchase-report-print" data-tab="by_gender">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin"
                                id="product_purchase_report_by_gender" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('product.gender'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.qty'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> ()</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td id="footer_total_by_gender_purchase" class="text-right"></td>
                                        <td class="text-right"><span class="display_currency" id="footer_subtotal_by_gender"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="ppr_by_procurement_source_tab">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end open-product-purchase-report-print" data-tab="by_procurement_source">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin"
                                id="product_purchase_report_by_procurement_source" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('product.procurement_source'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.qty'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> ()</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td id="footer_total_by_procurement_source_purchase" class="text-right"></td>
                                        <td class="text-right"><span class="display_currency" id="footer_subtotal_by_procurement_source"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="ppr_not_purchased">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end open-product-purchase-report-print" data-tab="not_purchased">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin"
                                id="product_purchase_not_purchased_report_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                                        <th style="width:450px"><?php echo app('translator')->get('sale.product'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('purchase.unit_cost_exc_tax'); ?> ()</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td colspan="3"></td>
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
<div class="modal fade view_register" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function() {
    dateRangeSettings.startDate = moment().startOf('month');
    dateRangeSettings.endDate = moment().endOf('month');
});

window.getProductPurchaseReportFilterParams = function(tab) {
    var start = '';
    var end = '';

    if ($('#product_pr_date_filter').val()) {
        var picker = $('input#product_pr_date_filter').data('daterangepicker');
        if (picker) {
            start = picker.startDate.format('YYYY-MM-DD');
            end = picker.endDate.format('YYYY-MM-DD');
        }
    }

    var params = {
        tab: tab || 'summary',
        start_date: start,
        end_date: end,
        variation_id: $('#variation_id').val(),
        location_id: $('select#location_id').val(),
        supplier_id: $('select#supplier_id').val(),
        category_id: $('#ppr_filter_category_id').val(),
        sub_category_id: $('#ppr_filter_sub_category_id').val(),
        sub2_category_id: $('#ppr_filter_sub2_category_id').val(),
        brand_id: $('select#ppr_brand_id').val(),
        sub_brand_id: $('select#ppr_sub_brand_id').val(),
        gender_id: $('select#ppr_gender_id').val(),
        sub_gender_id: $('select#ppr_sub_gender_id').val(),
        procurement_source_id: $('select#ppr_procurement_source_id').val(),
        sub_procurement_source_id: $('select#ppr_sub_procurement_source_id').val()
    };

    $.each(params, function(key, value) {
        if (value === '' || value === null || typeof value === 'undefined') {
            delete params[key];
        }
    });

    return params;
};
</script>
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<script type="text/javascript">
$(document).on('click', '.open-product-purchase-report-print', function(e) {
    e.preventDefault();
    var url = "<?php echo e(url('reports/product-purchase-report-print'), false); ?>?" + $.param(getProductPurchaseReportFilterParams($(this).data('tab')));
    window.open(url, '_blank');
});

// Cascade: category → sub-category → sub2-category
$('#ppr_filter_category_id').on('change', function () {
    var cat_id = $(this).val();
    if (cat_id) {
        $.ajax({
            method: 'POST',
            url: '/products/get_sub_categories',
            dataType: 'html',
            data: { cat_id: cat_id },
            success: function (result) {
                $('#ppr_filter_sub_category_id').html(result).trigger('change');
                $('#ppr_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
            },
        });
    } else {
        $('#ppr_filter_sub_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>').trigger('change');
        $('#ppr_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
    }
});
$('#ppr_filter_sub_category_id').on('change', function () {
    var cat_id = $(this).val();
    if (cat_id) {
        $.ajax({
            method: 'POST',
            url: '/products/get_sub_categories',
            dataType: 'html',
            data: { cat_id: cat_id },
            success: function (result) {
                $('#ppr_filter_sub2_category_id').html(result);
            },
        });
    } else {
        $('#ppr_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
    }
});
// Cascade: brand → sub-brand
$(document).on('change', '#ppr_brand_id', function() {
    var brand_id = $(this).val();
    if (brand_id) {
        $.ajax({ method: 'POST', url: '/brands/get_sub_brands', dataType: 'html', data: { brand_id: brand_id },
            success: function(result) { $('#ppr_sub_brand_id').html(result); }
        });
    } else {
        $('#ppr_sub_brand_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
    }
});
// Cascade: gender → sub-gender
$(document).on('change', '#ppr_gender_id', function() {
    var gender_id = $(this).val();
    if (gender_id) {
        $.ajax({ method: 'POST', url: '/genders/get_sub_genders', dataType: 'html', data: { gender_id: gender_id },
            success: function(result) { $('#ppr_sub_gender_id').html(result); }
        });
    } else {
        $('#ppr_sub_gender_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
    }
});
// Cascade: procurement → sub-procurement
$(document).on('change', '#ppr_procurement_source_id', function() {
    var procurement_source_id = $(this).val();
    if (procurement_source_id) {
        $.ajax({ method: 'POST', url: '/procurement-sources/get_sub_procurement_sources', dataType: 'html', data: { procurement_source_id: procurement_source_id },
            success: function(result) { $('#ppr_sub_procurement_source_id').html(result); }
        });
    } else {
        $('#ppr_sub_procurement_source_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
    }
});
$('#product_purchase_report_form #location_id, #product_purchase_report_form #supplier_id, #ppr_brand_id, #ppr_sub_brand_id, #ppr_gender_id, #ppr_sub_gender_id, #ppr_procurement_source_id, #ppr_sub_procurement_source_id, #ppr_filter_category_id, #ppr_filter_sub_category_id, #ppr_filter_sub2_category_id').change(function() {
    $('.nav-tabs li.active').find('a[data-toggle="tab"]').trigger('shown.bs.tab');
});

$(document).ready(function() {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        var target = $(e.target).attr('href');
        
        if (target == '#ppr_by_cat_tab') {
            if (typeof product_purchase_report_by_category_datatable == 'undefined') {
                product_purchase_report_by_category_datatable = $('table#product_purchase_report_by_category')
                    .DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/reports/product-purchase-grouped-by',
                            data: function(d) {
                                $.extend(d, getProductPurchaseReportFilterParams('by_category'));
                                d.group_by = 'category';
                                delete d.tab;
                            },
                        },
                        columns: [
                            { data: 'category', name: 'c1.name' },
                            { data: 'total_quantity_purchased', name: 'total_quantity_purchased', searchable: false, className: 'text-right' },
                            { data: 'subtotal', name: 'subtotal', searchable: false, className: 'text-right' },
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_qty = sum_table_col($('#product_purchase_report_by_category'), 'total_quantity_purchased');
                            $('#footer_total_by_cat_purchase').text(__number_f(total_qty));

                            var subtotal = sum_table_col($('#product_purchase_report_by_category'), 'subtotal');
                            $('#footer_subtotal_by_cat').text(subtotal);
                            __currency_convert_recursively($('#product_purchase_report_by_category'));
                        },
                    });
            } else {
                product_purchase_report_by_category_datatable.ajax.reload();
            }
        }
        
        if (target == '#ppr_by_sub_cat_tab') {
            if (typeof product_purchase_report_by_sub_category_datatable == 'undefined') {
                product_purchase_report_by_sub_category_datatable = $('table#product_purchase_report_by_sub_category')
                    .DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/reports/product-purchase-grouped-by',
                            data: function(d) {
                                $.extend(d, getProductPurchaseReportFilterParams('by_sub_category'));
                                d.group_by = 'sub_category';
                                delete d.tab;
                            },
                        },
                        columns: [
                            { data: 'sub_category', name: 'sub_cat.name' },
                            { data: 'total_quantity_purchased', name: 'total_quantity_purchased', searchable: false, className: 'text-right' },
                            { data: 'subtotal', name: 'subtotal', searchable: false, className: 'text-right' },
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_qty = sum_table_col($('#product_purchase_report_by_sub_category'), 'total_quantity_purchased');
                            $('#footer_total_by_sub_cat_purchase').text(__number_f(total_qty));
                            var subtotal = sum_table_col($('#product_purchase_report_by_sub_category'), 'subtotal');
                            $('#footer_subtotal_by_sub_cat').text(subtotal);
                            __currency_convert_recursively($('#product_purchase_report_by_sub_category'));
                        },
                    });
            } else {
                product_purchase_report_by_sub_category_datatable.ajax.reload();
            }
        }

        if (target == '#ppr_by_sub2_cat_tab') {
            if (typeof product_purchase_report_by_sub2_category_datatable == 'undefined') {
                product_purchase_report_by_sub2_category_datatable = $('table#product_purchase_report_by_sub2_category')
                    .DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/reports/product-purchase-grouped-by',
                            data: function(d) {
                                $.extend(d, getProductPurchaseReportFilterParams('by_sub2_category'));
                                d.group_by = 'sub2_category';
                                delete d.tab;
                            },
                        },
                        columns: [
                            { data: 'sub2_category', name: 'sub2_cat.name' },
                            { data: 'total_quantity_purchased', name: 'total_quantity_purchased', searchable: false, className: 'text-right' },
                            { data: 'subtotal', name: 'subtotal', searchable: false, className: 'text-right' },
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_qty = sum_table_col($('#product_purchase_report_by_sub2_category'), 'total_quantity_purchased');
                            $('#footer_total_by_sub2_cat_purchase').text(__number_f(total_qty));
                            var subtotal = sum_table_col($('#product_purchase_report_by_sub2_category'), 'subtotal');
                            $('#footer_subtotal_by_sub2_cat').text(subtotal);
                            __currency_convert_recursively($('#product_purchase_report_by_sub2_category'));
                        },
                    });
            } else {
                product_purchase_report_by_sub2_category_datatable.ajax.reload();
            }
        }

        if (target == '#ppr_by_brand_tab') {
            if (typeof product_purchase_report_by_brand_datatable == 'undefined') {
                product_purchase_report_by_brand_datatable = $('table#product_purchase_report_by_brand')
                    .DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/reports/product-purchase-grouped-by',
                            data: function(d) {
                                $.extend(d, getProductPurchaseReportFilterParams('by_brand'));
                                d.group_by = 'brand';
                                delete d.tab;
                            },
                        },
                        columns: [
                            { data: 'brand', name: 'brands.name' },
                            { data: 'total_quantity_purchased', name: 'total_quantity_purchased', searchable: false, className: 'text-right' },
                            { data: 'subtotal', name: 'subtotal', searchable: false, className: 'text-right' },
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_qty = sum_table_col($('#product_purchase_report_by_brand'), 'total_quantity_purchased');
                            $('#footer_total_by_brand_purchase').text(__number_f(total_qty));

                            var subtotal = sum_table_col($('#product_purchase_report_by_brand'), 'subtotal');
                            $('#footer_subtotal_by_brand').text(subtotal);
                            __currency_convert_recursively($('#product_purchase_report_by_brand'));
                        },
                    });
            } else {
                product_purchase_report_by_brand_datatable.ajax.reload();
            }
        }
        
        if (target == '#ppr_by_gender_tab') {
            if (typeof product_purchase_report_by_gender_datatable == 'undefined') {
                product_purchase_report_by_gender_datatable = $('table#product_purchase_report_by_gender')
                    .DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/reports/product-purchase-grouped-by',
                            data: function(d) {
                                $.extend(d, getProductPurchaseReportFilterParams('by_gender'));
                                d.group_by = 'gender';
                                delete d.tab;
                            },
                        },
                        columns: [
                            { data: 'gender', name: 'genders.name' },
                            { data: 'total_quantity_purchased', name: 'total_quantity_purchased', searchable: false, className: 'text-right' },
                            { data: 'subtotal', name: 'subtotal', searchable: false, className: 'text-right' },
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_qty = sum_table_col($('#product_purchase_report_by_gender'), 'total_quantity_purchased');
                            $('#footer_total_by_gender_purchase').text(__number_f(total_qty));

                            var subtotal = sum_table_col($('#product_purchase_report_by_gender'), 'subtotal');
                            $('#footer_subtotal_by_gender').text(subtotal);
                            __currency_convert_recursively($('#product_purchase_report_by_gender'));
                        },
                    });
            } else {
                product_purchase_report_by_gender_datatable.ajax.reload();
            }
        }
        
        if (target == '#ppr_by_procurement_source_tab') {
            if (typeof product_purchase_report_by_procurement_source_datatable == 'undefined') {
                product_purchase_report_by_procurement_source_datatable = $('table#product_purchase_report_by_procurement_source')
                    .DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/reports/product-purchase-grouped-by',
                            data: function(d) {
                                $.extend(d, getProductPurchaseReportFilterParams('by_procurement_source'));
                                d.group_by = 'procurement_source';
                                delete d.tab;
                            },
                        },
                        columns: [
                            { data: 'procurement_source', name: 'procurement_sources.name' },
                            { data: 'total_quantity_purchased', name: 'total_quantity_purchased', searchable: false, className: 'text-right' },
                            { data: 'subtotal', name: 'subtotal', searchable: false, className: 'text-right' },
                        ],
                        fnDrawCallback: function(oSettings) {
                            var total_qty = sum_table_col($('#product_purchase_report_by_procurement_source'), 'total_quantity_purchased');
                            $('#footer_total_by_procurement_source_purchase').text(__number_f(total_qty));

                            var subtotal = sum_table_col($('#product_purchase_report_by_procurement_source'), 'subtotal');
                            $('#footer_subtotal_by_procurement_source').text(subtotal);
                            __currency_convert_recursively($('#product_purchase_report_by_procurement_source'));
                        },
                    });
            } else {
                product_purchase_report_by_procurement_source_datatable.ajax.reload();
            }
        }
    });
});

<?php if(!empty($user_settings['rpt_purch_ppurch_hide_sku'])): ?>
    product_purchase_report_summary.column(0).visible(false);
    product_purchase_report.column(0).visible(false);
<?php endif; ?>
<?php if(!empty($user_settings['rpt_purch_ppurch_hide_product'])): ?>
    product_purchase_report_summary.column(1).visible(false);
    product_purchase_report.column(1).visible(false);
<?php endif; ?>
<?php if(!empty($user_settings['rpt_purch_ppurch_hide_supplier'])): ?>
    product_purchase_report.column(2).visible(false);
<?php endif; ?>
<?php if(!empty($user_settings['rpt_purch_ppurch_hide_ref_no'])): ?>
    product_purchase_report.column(3).visible(false);
<?php endif; ?>
<?php if(!empty($user_settings['rpt_purch_ppurch_hide_date'])): ?>
    product_purchase_report.column(4).visible(false);
<?php endif; ?>
<?php if(!empty($user_settings['rpt_purch_ppurch_hide_qty'])): ?>
    product_purchase_report_summary.column(2).visible(false);
    product_purchase_report.column(5).visible(false);
<?php endif; ?>
<?php if(!empty($user_settings['rpt_purch_ppurch_hide_total_unit_adjusted'])): ?>
    product_purchase_report_summary.column(3).visible(false);
    product_purchase_report.column(6).visible(false);
<?php endif; ?>
<?php if(!empty($user_settings['rpt_purch_ppurch_hide_unit_purchase_price'])): ?>
    product_purchase_report_summary.column(4).visible(false);
    product_purchase_report.column(7).visible(false);
<?php endif; ?>
<?php if(!empty($user_settings['rpt_purch_ppurch_hide_subtotal'])): ?>
    product_purchase_report_summary.column(5).visible(false);
    product_purchase_report.column(8).visible(false);
<?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>