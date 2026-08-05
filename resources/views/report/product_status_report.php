<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>

<?php $__env->startSection('title', __('lang_v1.product_status_report')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_product_status_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo e(__('lang_v1.product_status_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getStockReport']), 'method'
            => 'get', 'id' => 'product_status_report_form', 'class' => 'row' ]); ?>

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
                    <?php echo Form::label('customer_id', __('contact.customer') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('customer_id', $customers, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.please_select'), 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('psr_customer_group_id', __( 'lang_v1.customer_group_name' ) . ':'); ?>

                    <?php echo Form::select('psr_customer_group_id', $customer_group, null, ['class' => 'form-control select2',
                    'style' => 'width:100%', 'id' => 'psr_customer_group_id']); ?>

                </div>
            </div>

            <?php if(session('business.enable_category')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('category_id', __('product.category') . ':'); ?>

                    <?php echo Form::select('category_id', $categories, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                    <?php echo Form::select('sub_category_id', array(), null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_sub_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub2_category_id', __('product.sub2_category') . ':'); ?>

                    <?php echo Form::select('sub2_category_id', array(), null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_sub2_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_brand')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('brand_id', __('product.brand') . ':'); ?>

                    <?php echo Form::select('brand_id', $brands, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_brand_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub_brand_id', __('product.sub_brand') . ':'); ?>

                    <?php echo Form::select('sub_brand_id', [], null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_sub_brand_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_gender')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('gender_id', __('product.gender') . ':'); ?>

                    <?php echo Form::select('gender_id', $genders, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_gender_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub_gender_id', __('product.sub_gender') . ':'); ?>

                    <?php echo Form::select('sub_gender_id', [], null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_sub_gender_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_procurement_source')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('procurement_source_id', __('product.procurement_source') . ':'); ?>

                    <?php echo Form::select('procurement_source_id', $procurement_sources, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_procurement_source_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub_procurement_source_id', __('product.sub_procurement_source') . ':'); ?>

                    <?php echo Form::select('sub_procurement_source_id', [], null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_sub_procurement_source_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('product_sr_date_filter', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' =>
                    'form-control', 'id' => 'product_sr_date_filter', 'readonly']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <?php echo Form::label('product_sr_start_time', __('lang_v1.time_range') . ':'); ?>

                <?php
                $startDay = Carbon::now()->startOfDay();
                $endDay = $startDay->copy()->endOfDay();
                ?>
                <div class="mb-3">
                    <?php echo Form::text('start_time', \Carbon::createFromTimestamp(strtotime($startDay))->format('h:i A'), ['style' => __('lang_v1.select_a_date_range'),
                    'class' => 'form-control width-50 f-left', 'id' => 'product_sr_start_time']); ?>

                    <?php echo Form::text('end_time', \Carbon::createFromTimestamp(strtotime($endDay))->format('h:i A'), ['class' => 'form-control width-50 f-left', 'id'
                    => 'product_sr_end_time']); ?>

                </div>
            </div>
            <?php echo Form::close(); ?>

            <?php echo $__env->renderComponent(); ?>
            <input id="enable_scheme_quantity_sales" type="hidden" value='<?php echo e(!empty($common_settings["enable_scheme_quantity_sales"]) ? 1 : 0, false); ?>'>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="text-end mb-2">
                <button type="button" class="btn btn-primary open-product-status-report-print">
                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                </button>
            </div>
            <div class="table-responsive">
                    <table class="table table-bordered table-striped table-th-skin"
                        id="product_status_report_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('lang_v1.status'); ?></th>
                                <th><?php echo app('translator')->get('product.sku'); ?></th>
                                <th style="width:450px"><?php echo app('translator')->get('sale.product'); ?></th>
                                <th style="width:350px"><?php echo app('translator')->get('sale.customer_name'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.contact_id'); ?></th>
                                <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                <th><?php echo app('translator')->get('messages.date'); ?></th>
                                <th><?php echo app('translator')->get('sale.qty'); ?></th>
                                <th><?php echo app('translator')->get('sale.unit_price'); ?></th>
                                <th><?php echo app('translator')->get('sale.subtotal'); ?></th>
                                <th><?php echo app('translator')->get('sale.discount'); ?></th>
                                <th><?php echo app('translator')->get('sale.tax'); ?></th>
                                <th><?php echo app('translator')->get('sale.price_inc_tax'); ?></th>
                                <th><?php echo app('translator')->get('sale.total'); ?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 footer-total text-center">
                                <td colspan="7"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                <td id="footer_total_sold"></td>
                                <td></td>
                                <td id="footer_before_discount_subtotal"></td>
                                <td></td>
                                
                                <td id="footer_tax"></td>
                                <td></td>
                                <td><span class="display_currency" id="footer_subtotal"
                                        data-currency_symbol="true"></span></td>
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
<script type="text/javascript">
$('#product_sell_report_form #location_id, #product_sell_report_form #customer_id, #psr_filter_brand_id, #psr_filter_sub_brand_id, #psr_filter_gender_id, #psr_filter_sub_gender_id, #psr_filter_procurement_source_id, #psr_filter_sub_procurement_source_id, #psr_filter_category_id, #psr_filter_sub_category_id, #psr_filter_sub2_category_id, #psr_customer_group_id').change(function() {
    $('.nav-tabs li.active').find('a[data-bs-toggle="tab"]').trigger('shown.bs.tab');
});
$(document).ready(function() {
    function getProductStatusReportFilterParams() {
        var start = '';
        var end = '';
        var start_time = $('#product_sr_start_time').val();
        var end_time = $('#product_sr_end_time').val();

        if ($('#product_sr_date_filter').val()) {
            start = $('input#product_sr_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
            start = moment(start + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
            end = $('input#product_sr_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
            end = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
        }

        return {
            start_date: start,
            end_date: end,
            variation_id: $('#variation_id').val(),
            customer_id: $('select#customer_id').val(),
            location_id: $('select#location_id').val(),
            category_id: $('select#psr_filter_category_id').val(),
            sub_category_id: $('select#psr_filter_sub_category_id').val(),
            sub2_category_id: $('select#psr_filter_sub2_category_id').val(),
            brand_id: $('select#psr_filter_brand_id').val(),
            sub_brand_id: $('select#psr_filter_sub_brand_id').val(),
            gender_id: $('select#psr_filter_gender_id').val(),
            sub_gender_id: $('select#psr_filter_sub_gender_id').val(),
            procurement_source_id: $('select#psr_filter_procurement_source_id').val(),
            sub_procurement_source_id: $('select#psr_filter_sub_procurement_source_id').val(),
            customer_group_id: $('#psr_customer_group_id').val()
        };
    }

    $(document).on('click', '.open-product-status-report-print', function(e) {
        e.preventDefault();
        var url = "<?php echo e(url('reports/product-status-report-print'), false); ?>?" + $.param(getProductStatusReportFilterParams());
        window.open(url, '_blank');
    });

    $(document).on('click', '.change-return-status', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: $(this).data('href'),
            dataType: 'json',
            success: function(result) {
                if (result.success == true) {
                    toastr.success(result.msg);
                    product_status_report.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    <?php if(!empty($user_settings['rpt_sales_pstatus_hide_status'])): ?>
        product_status_report.column(0).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pstatus_hide_sku'])): ?>
        product_status_report.column(1).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pstatus_hide_product'])): ?>
        product_status_report.column(2).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pstatus_hide_customer_name'])): ?>
        product_status_report.column(3).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pstatus_hide_contact_id'])): ?>
        product_status_report.column(4).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pstatus_hide_invoice_no'])): ?>
        product_status_report.column(5).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pstatus_hide_date'])): ?>
        product_status_report.column(6).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pstatus_hide_qty'])): ?>
        product_status_report.column(7).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pstatus_hide_unit_price'])): ?>
        product_status_report.column(8).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pstatus_hide_subtotal'])): ?>
        product_status_report.column(9).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pstatus_hide_discount'])): ?>
        product_status_report.column(10).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pstatus_hide_tax'])): ?>
        product_status_report.column(11).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pstatus_hide_price_inc_tax'])): ?>
        product_status_report.column(12).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pstatus_hide_total'])): ?>
        product_status_report.column(13).visible(false);
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>