<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>

<?php $__env->startSection('title', __('report.sales_representative')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('report.sales_representative'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getStockReport']), 'method'
            => 'get', 'id' => 'sales_representative_filter_form', 'class' => 'row', ]); ?>

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <?php echo Form::label('sr_business_id', __('business.business_location') . ':'); ?>

                    <?php echo Form::select('sr_business_id', $business_locations, null, ['class' => 'form-control select2',
                    'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-2">
                    <?php echo Form::label('sr_id', __('report.user') . ':'); ?>

                    <?php echo Form::select('sr_id', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%',
                    'placeholder' => __('report.all_users')]); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-2">

                    <?php echo Form::label('sr_date_filter', __('report.date_range') . ':'); ?>

                    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_sales_representative_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' =>
                    'form-control', 'id' => 'sr_date_filter', 'readonly']); ?>

                </div>
            </div>
            <?php if(session('business.enable_category')): ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('category_id', __('product.category') . ':'); ?>

                    <?php echo Form::select('category_id', $categories, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'sr_filter_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                    <?php echo Form::select('sub_category_id', array(), null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'sr_filter_sub_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category')): ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('sub2_category_id', __('product.sub2_category') . ':'); ?>

                    <?php echo Form::select('sub2_category_id', array(), null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'sr_filter_sub2_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_brand')): ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('brand_id', __('product.brand') . ':'); ?>

                    <?php echo Form::select('brand_id', $brands, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'sr_filter_brand_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('sub_brand_id', __('product.sub_brand') . ':'); ?>

                    <?php echo Form::select('sub_brand_id', [], null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'sr_filter_sub_brand_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_gender')): ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('gender_id', __('product.gender') . ':'); ?>

                    <?php echo Form::select('gender_id', $genders, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'sr_filter_gender_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('sub_gender_id', __('product.sub_gender') . ':'); ?>

                    <?php echo Form::select('sub_gender_id', [], null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'sr_filter_sub_gender_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_procurement_source')): ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('procurement_source_id', __('product.procurement_source') . ':'); ?>

                    <?php echo Form::select('procurement_source_id', $procurement_sources, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'sr_filter_procurement_source_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('sub_procurement_source_id', __('product.sub_procurement_source') . ':'); ?>

                    <?php echo Form::select('sub_procurement_source_id', [], null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'sr_filter_sub_procurement_source_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>

            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('city_filter', __('business.city') . ':'); ?>

                    <?php echo Form::select('city_filter', $cities, null, [
                    'class' => 'form-control select2',
                    'style' => 'width:100%',
                    'id' => 'sr_filter_city',
                    ]); ?>

                </div>
            </div>

            <?php echo Form::close(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <!-- Summary -->
    <div class="row">
        <div class="col-sm-12">
            <?php $__env->startComponent('components.widget', ['title' => __('report.summary')]); ?>
            <h3 class="text-muted">
                <?php echo e(__('report.total_sell'), false); ?> - <?php echo e(__('lang_v1.total_sales_return'), false); ?>:
                <span id="sr_total_sales">
                    <i class="fas fa-sync fa-spin fa-fw"></i>
                </span>
                -
                <span id="sr_total_sales_return">
                    <i class="fas fa-sync fa-spin fa-fw"></i>
                </span>
                =
                <span id="sr_total_sales_final">
                    <i class="fas fa-sync fa-spin fa-fw"></i>
                </span>
            </h3>
            <div class="hide" id="total_payment_with_commsn_div">
                <h3 class="text-muted">
                    <?php echo e(__('lang_v1.total_payment_with_commsn'), false); ?>:
                    <span id="total_payment_with_commsn">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </span>
                </h3>
            </div>
            <div class="hide" id="total_commission_div">
                <h3 class="text-muted">
                    <?php echo e(__('lang_v1.total_sale_commission'), false); ?>:
                    <span id="sr_total_commission">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </span>
                </h3>
            </div>
            <div class="hide" id="total_category_commission_div">
                <h3 class="text-muted">
                    <?php echo e(__('lang_v1.total_sale_category_commission'), false); ?>:
                    <span id="sr_total_category_commission">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </span>
                </h3>
            </div>
            <h3 class="text-muted">
                <?php echo e(__('report.total_expense'), false); ?>:
                <span id="sr_total_expenses">
                    <i class="fas fa-sync fa-spin fa-fw"></i>
                </span>
            </h3>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active pb-2 pe-2 ps-2" href="#sr_sales_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-cog"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.sales_added'); ?></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#sr_commission_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-cog"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.sales_with_commission'); ?></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sr_product_summary_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-boxes"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.product_summary'); ?></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sr_product_detailed_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-boxes"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.product_detailed'); ?></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sr_expenses_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-cog"
                                aria-hidden="true"></i> <?php echo app('translator')->get('expense.expenses'); ?></a>
                    </li>

                    <?php if(!empty($pos_settings['cmmsn_calculation_type']) && $pos_settings['cmmsn_calculation_type'] ==
                    'payment_received'): ?>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#sr_payments_with_cmmsn_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i
                                class="fa fa-cog" aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.payments_with_cmmsn'); ?></a>
                    </li>
                    <?php endif; ?>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="sr_sales_tab" role="tabpanel">
                        <?php echo $__env->make('report.partials.sales_representative_sales', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <div class="tab-pane fade" id="sr_commission_tab" role="tabpanel">
                        <?php echo $__env->make('report.partials.sales_representative_commission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <div class="tab-pane fade" id="sr_product_summary_tab" role="tabpanel">
                        <?php echo $__env->make('report.partials.sales_representative_product_summary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <div class="tab-pane fade" id="sr_product_detailed_tab" role="tabpanel">
                        <?php echo $__env->make('report.partials.sales_representative_product_detailed', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <div class="tab-pane fade" id="sr_expenses_tab" role="tabpanel">
                        <?php echo $__env->make('report.partials.sales_representative_expenses', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <?php if(!empty($pos_settings['cmmsn_calculation_type']) && $pos_settings['cmmsn_calculation_type'] ==
                    'payment_received'): ?>
                    <div class="tab-pane fade" id="sr_payments_with_cmmsn_tab" role="tabpanel">
                        <?php echo $__env->make('report.partials.sales_representative_payments_with_cmmsn', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <?php endif; ?>
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
<script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<script>
// Cascade: category → sub-category → sub2-category
$(document).on('change', '#sr_filter_category_id', function() {
    var cat_id = $(this).val();
    if (cat_id) {
        $.ajax({
            method: 'POST',
            url: '/products/get_sub_categories',
            dataType: 'html',
            data: { cat_id: cat_id },
            success: function (result) {
                $('#sr_filter_sub_category_id').html(result).trigger('change');
                $('#sr_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
            },
        });
    } else {
        $('#sr_filter_sub_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>').trigger('change');
        $('#sr_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
    }
});
$(document).on('change', '#sr_filter_sub_category_id', function() {
    var cat_id = $(this).val();
    if (cat_id) {
        $.ajax({
            method: 'POST',
            url: '/products/get_sub_categories',
            dataType: 'html',
            data: { cat_id: cat_id },
            success: function (result) {
                $('#sr_filter_sub2_category_id').html(result);
            },
        });
    } else {
        $('#sr_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
    }
});
// Cascade: brand → sub-brand
$(document).on('change', '#sr_filter_brand_id', function() {
    var brand_id = $(this).val();
    if (brand_id) {
        $.ajax({ method: 'POST', url: '/brands/get_sub_brands', dataType: 'html', data: { brand_id: brand_id },
            success: function(result) { $('#sr_filter_sub_brand_id').html(result); }
        });
    } else {
        $('#sr_filter_sub_brand_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
    }
});
// Cascade: gender → sub-gender
$(document).on('change', '#sr_filter_gender_id', function() {
    var gender_id = $(this).val();
    if (gender_id) {
        $.ajax({ method: 'POST', url: '/genders/get_sub_genders', dataType: 'html', data: { gender_id: gender_id },
            success: function(result) { $('#sr_filter_sub_gender_id').html(result); }
        });
    } else {
        $('#sr_filter_sub_gender_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
    }
});
// Cascade: procurement → sub-procurement
$(document).on('change', '#sr_filter_procurement_source_id', function() {
    var procurement_source_id = $(this).val();
    if (procurement_source_id) {
        $.ajax({ method: 'POST', url: '/procurement-sources/get_sub_procurement_sources', dataType: 'html', data: { procurement_source_id: procurement_source_id },
            success: function(result) { $('#sr_filter_sub_procurement_source_id').html(result); }
        });
    } else {
        $('#sr_filter_sub_procurement_source_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
    }
});
$(document).ready(function(){
    <?php if(!empty($user_settings['rpt_sales_srep_hide_date'])): ?>
        sr_sales_report.column(0).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_srep_hide_invoice_no'])): ?>
        sr_sales_report.column(1).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_srep_hide_customer_name'])): ?>
        sr_sales_report.column(2).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_srep_hide_location'])): ?>
        sr_sales_report.column(3).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_srep_hide_payment_status'])): ?>
        sr_sales_report.column(4).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_srep_hide_total_amount'])): ?>
        sr_sales_report.column(5).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_srep_hide_total_paid'])): ?>
        sr_sales_report.column(6).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_srep_hide_total_remaining'])): ?>
        sr_sales_report.column(7).visible(false);
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>