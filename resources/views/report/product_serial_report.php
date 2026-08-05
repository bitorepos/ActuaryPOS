<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>

<?php $__env->startSection('title', __('lang_v1.product_serial_report')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_product_serial_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo e(__('lang_v1.product_serial_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getStockReport']), 'method'
            => 'get', 'id' => 'product_serial_report_form', 'class' => 'row' ]); ?>

            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('type', __('lang_v1.type') . ':'); ?>

                    <?php echo Form::select('type', ['sell' => 'Sell', 'purchase' => 'Purchase'], null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_type', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
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
                <div class="form-group">
                    <?php echo Form::label('serial_number', __('lang_v1.serial_number') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-barcode"></i>
                        </span>
                        <?php echo Form::text('serial_number', null, ['class' => 'form-control', 'id' => 'psr_serial_number',
                        'placeholder' => __('lang_v1.serial_number')]); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('supplier_id', __('contact.supplier') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('supplier_id', $suppliers, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.please_select'), 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('customer_id', __('contact.contact') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('customer_id', $customers, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.please_select'), 'required', 'style' => 'width:100%']); ?>

                    </div>
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
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    
                    <li class="nav-item">
                        <a class="nav-link active" href="#psr_detailed_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-list"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.detailed'); ?></a>
                    </li>
                    
                </ul>
                <div class="tab-content">
                    
                    <div class="tab-pane fade show active" id="psr_detailed_tab" role="tabpanel">
                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-primary open-product-serial-report-print">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin"
                                id="product_serial_report_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                                        <th style="width:450px"><?php echo app('translator')->get('sale.product'); ?></th>
                                        <th><?php echo app('translator')->get('brand.brand_name'); ?></th>
                                        <th><?php echo app('translator')->get('contact.contact_id'); ?></th>
                                        <th style="width:350px"><?php echo app('translator')->get('contact.contact'); ?></th>
                                        <th style="width:350px"><?php echo app('translator')->get('lang_v1.supplier_name'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.type'); ?></th>
                                        <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('sale.qty'); ?></th>
                                        <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                                        <th><?php echo app('translator')->get('sale.scheme_qty'); ?></th>
                                        <?php endif; ?>
                                        <th><?php echo app('translator')->get('product.sr_imei_no'); ?></th>
                                        <th><?php echo app('translator')->get('sale.unit_price'); ?></th>
                                        <th><?php echo app('translator')->get('sale.subtotal'); ?></th>
                                        <th><?php echo app('translator')->get('sale.discount'); ?></th>
                                        <th><?php echo app('translator')->get('sale.discount'); ?> %</th>
                                        <th><?php echo app('translator')->get('sale.tax'); ?></th>
                                        <th><?php echo app('translator')->get('sale.price_inc_tax'); ?></th>
                                        <th><?php echo app('translator')->get('sale.total'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.days'); ?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td colspan="9"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td id="footer_total_sold"></td>
                                        <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                                        <td id="footer_total_foc_sold"></td>
                                        <?php endif; ?>
                                        <td></td>
                                        <td></td>
                                        <td id="footer_before_discount_subtotal"></td>
                                        <td id="footer_discount"></td>
                                        <td></td>
                                        <td id="footer_tax"></td>
                                        <td></td>
                                        <td><span class="display_currency" id="footer_subtotal"
                                                data-currency_symbol="true"></span></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <p class="text-muted">
                                    <?php echo app('translator')->get('lang_v1.profit_note'); ?>
                                </p>
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
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<script type="text/javascript">
$('#product_serial_report_form #location_id, #product_serial_report_form #customer_id, #product_serial_report_form #supplier_id, #psr_filter_brand_id, #psr_filter_sub_brand_id, #psr_filter_gender_id, #psr_filter_sub_gender_id, #psr_filter_procurement_source_id, #psr_filter_sub_procurement_source_id, #psr_filter_category_id, #psr_filter_sub_category_id, #psr_filter_sub2_category_id, #psr_customer_group_id, #psr_serial_number').change(function() {
    $('.nav-tabs li.active').find('a[data-toggle="tab"]').trigger('shown.bs.tab');
});
$(document).ready(function() {
    function getProductSerialReportFilterParams() {
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
            type: $('select#psr_filter_type').val(),
            customer_id: $('select#customer_id').val(),
            supplier_id: $('select#supplier_id').val(),
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
            customer_group_id: $('#psr_customer_group_id').val(),
            serial_number: $('#psr_serial_number').val()
        };
    }

    $(document).on('click', '.open-product-serial-report-print', function(e) {
        e.preventDefault();
        var url = "<?php echo e(url('reports/product-serial-report-print'), false); ?>?" + $.param(getProductSerialReportFilterParams());
        window.open(url, '_blank');
    });

    <?php if(!empty($user_settings['rpt_sales_pserial_hide_sku'])): ?>
        product_serial_report.column(0).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_product'])): ?>
        product_serial_report.column(1).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_brand_name'])): ?>
        product_serial_report.column(2).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_contact_id'])): ?>
        product_serial_report.column(3).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_contact'])): ?>
        product_serial_report.column(4).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_supplier_name'])): ?>
        product_serial_report.column(5).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_type'])): ?>
        product_serial_report.column(6).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_invoice_no'])): ?>
        product_serial_report.column(7).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_date'])): ?>
        product_serial_report.column(8).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_qty'])): ?>
        product_serial_report.column(9).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_scheme_qty'])): ?>
        product_serial_report.column('transaction_sell_lines.foc_quantity:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_sr_imei_no'])): ?>
        product_serial_report.column('transaction_sell_lines.serial_number:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_unit_price'])): ?>
        product_serial_report.column('transaction_sell_lines.unit_price_before_discount:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_subtotal'])): ?>
        product_serial_report.column('subtotal_before_discount:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_discount'])): ?>
        product_serial_report.column('transaction_sell_lines.line_discount_amount:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_discount_pct'])): ?>
        product_serial_report.column('discount_percent:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_tax'])): ?>
        product_serial_report.column('tax_rates.name:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_price_inc_tax'])): ?>
        product_serial_report.column('transaction_sell_lines.unit_price_inc_tax:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_total'])): ?>
        product_serial_report.column('subtotal:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_pserial_hide_days'])): ?>
        var psr_last = product_serial_report.columns()[0].length - 1;
        product_serial_report.column(psr_last).visible(false);
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>