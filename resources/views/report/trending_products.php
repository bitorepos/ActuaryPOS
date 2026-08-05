
<?php $__env->startSection('title', __('report.trending_products')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('report.trending_products'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_trending_products_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row no-print">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
              <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getTrendingProducts']), 'method' => 'get', 'class' => 'row', 'id' => 'trending_products_report_form']); ?>

                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('location_id',  __('purchase.business_location') . ':'); ?>

                        <?php echo Form::select('location_id', $business_locations, request()->get('location_id'), ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('supplier_id',  __('purchase.supplier') . ':'); ?>

                        <?php echo Form::select('supplier_id', $suppliers, request()->get('supplier_id'), ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <?php if(session('business.enable_category')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('category_id', __('product.category') . ':'); ?>

                        <?php echo Form::select('category', $categories, request()->get('category'), ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                        <?php echo Form::select('sub_category', array(), request()->get('sub_category'), ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sub2_category_id', __('product.sub2_category') . ':'); ?>

                        <?php echo Form::select('sub2_category', array(), request()->get('sub2_category'), ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub2_category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_brand')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('brand', __('product.brand') . ':'); ?>

                        <?php echo Form::select('brand', $brands, request()->get('brand'), ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sub_brand', __('product.sub_brand') . ':'); ?>

                        <?php echo Form::select('sub_brand', [], request()->get('sub_brand'), ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_brand_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_gender')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('gender_id', __('product.gender') . ':'); ?>

                        <?php echo Form::select('gender', $genders, request()->get('gender'), ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'gender_id']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sub_gender_id', __('product.sub_gender') . ':'); ?>

                        <?php echo Form::select('sub_gender', [], request()->get('sub_gender'), ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_gender_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_procurement_source')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('procurement_source_id', __('product.procurement_source') . ':'); ?>

                        <?php echo Form::select('procurement_source', $procurement_sources, request()->get('procurement_source'), ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'procurement_source_id']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sub_procurement_source_id', __('product.sub_procurement_source') . ':'); ?>

                        <?php echo Form::select('sub_procurement_source', [], request()->get('sub_procurement_source'), ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_procurement_source_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('unit', __('product.unit') . ':'); ?>

                        <?php echo Form::select('unit', $units, request()->get('unit'), ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('trending_product_date_range',__('report.date_range') .  ':'); ?>

                        <?php echo Form::text('date_range', request()->get('date_range', $default_date_range ?? null), ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'trending_product_date_range', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('limit', __('lang_v1.no_of_products') . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.no_of_products_for_trending_products') . '"></i>';
                }
            ?>
                        <?php echo Form::number('limit', request()->get('limit', 5), ['placeholder' => __('lang_v1.no_of_products'), 'class' => 'form-control', 'min' => 1]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('product_type', __('product.product_type') . ':'); ?>

                        <?php echo Form::select('product_type', ['single' => __('lang_v1.single'), 'variable' => __('lang_v1.variable'), 'combo' => __('lang_v1.combo')], request()->input('product_type'), ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary float-end"><?php echo app('translator')->get('report.apply_filters'); ?></button>
                </div> 
                <?php echo Form::close(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row no-print">
        <div class="col-sm-12">
            <button type="button" class="btn btn-primary float-end open-trending-products-print">
                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                <?php $__env->slot('title'); ?>
                    <?php echo app('translator')->get('report.top_trending_products'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.top_trending_products') . '"></i>';
                }
            ?>
                <?php $__env->endSlot(); ?>
                <?php echo $chart->container(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
    <?php echo $chart->script(); ?>

    <script>
    // Cascade: category → sub-category → sub2-category
    $(document).on('change', '#category_id', function() {
        var cat_id = $(this).val();
        if (cat_id) {
            $.ajax({
                method: 'POST',
                url: '/products/get_sub_categories',
                dataType: 'html',
                data: { cat_id: cat_id },
                success: function (result) {
                    $('#sub_category_id').html(result).trigger('change');
                    $('#sub2_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>');
                },
            });
        } else {
            $('#sub_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>').trigger('change');
            $('#sub2_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>');
        }
    });
    $(document).on('change', '#sub_category_id', function() {
        var cat_id = $(this).val();
        if (cat_id) {
            $.ajax({
                method: 'POST',
                url: '/products/get_sub_categories',
                dataType: 'html',
                data: { cat_id: cat_id },
                success: function (result) {
                    $('#sub2_category_id').html(result);
                },
            });
        } else {
            $('#sub2_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>');
        }
    });
    // Cascade: brand → sub-brand
    $(document).on('change', 'select[name="brand"]', function() {
        var brand_id = $(this).val();
        if (brand_id) {
            $.ajax({ method: 'POST', url: '/brands/get_sub_brands', dataType: 'html', data: { brand_id: brand_id },
                success: function(result) { $('#sub_brand_id').html(result); }
            });
        } else {
            $('#sub_brand_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>');
        }
    });
    // Cascade: gender → sub-gender
    $(document).on('change', '#gender_id', function() {
        var gender_id = $(this).val();
        if (gender_id) {
            $.ajax({ method: 'POST', url: '/genders/get_sub_genders', dataType: 'html', data: { gender_id: gender_id },
                success: function(result) { $('#sub_gender_id').html(result); }
            });
        } else {
            $('#sub_gender_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>');
        }
    });
    // Cascade: procurement → sub-procurement
    $(document).on('change', '#procurement_source_id', function() {
        var procurement_source_id = $(this).val();
        if (procurement_source_id) {
            $.ajax({ method: 'POST', url: '/procurement-sources/get_sub_procurement_sources', dataType: 'html', data: { procurement_source_id: procurement_source_id },
                success: function(result) { $('#sub_procurement_source_id').html(result); }
            });
        } else {
            $('#sub_procurement_source_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>');
        }
    });

    $(document).on('click', '.open-trending-products-print', function(e) {
        e.preventDefault();
        var query = $('#trending_products_report_form').serialize();
        window.open("<?php echo e(url('reports/trending-products-print'), false); ?>?" + query, '_blank');
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>