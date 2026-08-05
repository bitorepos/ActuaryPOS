
<?php $__env->startSection('title', __('lang_v1.combo_items_report')); ?>
<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_combo_items_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('lang_v1.combo_items_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('cir_location_id', __('purchase.business_location').':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <?php echo Form::select('cir_location_id', $business_locations, null, ['class' => 'form-control
                        select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('cir_product_type', __('product.product_type') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('cir_product_type', ['combo' => __('lang_v1.combo'), 'Package' => __('lang_v1.Package')], null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.all'), 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <?php if(session('business.enable_category')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('cir_category_id', __('category.category') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-tags"></i>
                        </span>
                        <?php echo Form::select('cir_category_id', $categories, null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('cir_sub_category_id', __('product.sub_category') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-tag"></i>
                        </span>
                        <?php echo Form::select('cir_sub_category_id', [], null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('cir_sub2_category_id', __('product.sub2_category') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-tag"></i>
                        </span>
                        <?php echo Form::select('cir_sub2_category_id', [], null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('cir_search_product', __('lang_v1.search_product') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-search"></i>
                        </span>
                        <input type="hidden" value="" id="cir_variation_id">
                        <?php echo Form::text('cir_search_product', null, ['class' => 'form-control', 'id' => 'cir_search_product',
                        'placeholder' => __('lang_v1.search_product_placeholder')]); ?>

                    </div>
                </div>
            </div>
            
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-success float-end margin-left-10" id="combo_items_report_excel" href="<?php echo e(url('reports/combo-items-report-print'), false); ?>?output=excel"><i class="fa fa-download"></i> <?php echo app('translator')->get('lang_v1.download_excel'); ?></a>
                        <button type="button" id="print_report" class="btn btn-primary float-end mr-5"><i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4</button>
                    </div>
                </div>
                <div id="combo_report_div"></div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<!-- /.content -->
<div class="modal fade view_register" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<style>
<?php if(!empty($user_settings['rpt_gen_combo_hide_sku'])): ?>
    #combo_report_div table th:nth-child(1), #combo_report_div table td:nth-child(1) { display: none; }
<?php endif; ?>
<?php if(!empty($user_settings['rpt_gen_combo_hide_product'])): ?>
    #combo_report_div table th:nth-child(2), #combo_report_div table td:nth-child(2) { display: none; }
<?php endif; ?>
<?php if(!empty($user_settings['rpt_gen_combo_hide_unit_price'])): ?>
    #combo_report_div table th:nth-child(3), #combo_report_div table td:nth-child(3) { display: none; }
<?php endif; ?>
<?php if(!empty($user_settings['rpt_gen_combo_hide_unit_cost_exc_tax'])): ?>
    #combo_report_div table th:nth-child(4), #combo_report_div table td:nth-child(4) { display: none; }
<?php endif; ?>
<?php if(!empty($user_settings['rpt_gen_combo_hide_profit'])): ?>
    #combo_report_div table th:nth-child(5), #combo_report_div table td:nth-child(5) { display: none; }
<?php endif; ?>
<?php if(!empty($user_settings['rpt_gen_combo_hide_gross_profit'])): ?>
    #combo_report_div table th:nth-child(6), #combo_report_div table td:nth-child(6) { display: none; }
<?php endif; ?>
</style>
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<script type="text/javascript">
$(document).ready( function(){
    get_combo_items_report();

    // Product search autocomplete
    if ($('#cir_search_product').length > 0) {
        var __cir_strip_html = function (html) {
            return $('<div>').html(html).text().replace(/\s+/g, ' ').trim();
        };
        $('#cir_search_product').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: '<?php echo e(action([\App\Http\Controllers\PurchaseController::class, 'getProducts']), false); ?>?check_enable_stock=false&hide_combo=false',
                    dataType: 'json',
                    data: { term: request.term },
                    success: function (data) {
                        response(
                            $.map(data, function (v, i) {
                                if (v.variation_id) {
                                    return { label: v.text, value: v.variation_id };
                                }
                                return false;
                            })
                        );
                    },
                });
            },
            minLength: 2,
            select: function (event, ui) {
                $('#cir_variation_id').val(ui.item.value);
                event.preventDefault();
                $(this).val(__cir_strip_html(ui.item.label));
                get_combo_items_report();
            },
            focus: function (event, ui) {
                event.preventDefault();
                $(this).val(__cir_strip_html(ui.item.label));
            }
        }).autocomplete('instance')._renderItem = function (ul, item) {
            return $('<li>')
                .append($('<div>').html(item.label))
                .appendTo(ul);
        };
    }

    // Clear search product
    $(document).on('input', '#cir_search_product', function() {
        if ($(this).val() === '') {
            $('#cir_variation_id').val('');
            get_combo_items_report();
        }
    });

    $(document).on('change', '#cir_category_id', function(){
        var category_id = $(this).val();
        $('#cir_sub_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>').trigger('change.select2');
        $('#cir_sub2_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>').trigger('change.select2');

        if (category_id) {
            $.ajax({
                method: 'POST',
                url: '<?php echo e(action([\App\Http\Controllers\ProductController::class, 'getSubCategories']), false); ?>',
                dataType: 'html',
                data: { cat_id: category_id },
                success: function(result) {
                    if (result) {
                        $('#cir_sub_category_id').html(result).trigger('change.select2');
                    }
                }
            });
        }

        get_combo_items_report();
    });

    $(document).on('change', '#cir_sub_category_id', function(){
        var sub_category_id = $(this).val();
        $('#cir_sub2_category_id').html('<option value=""><?php echo e(__("messages.all"), false); ?></option>').trigger('change.select2');

        if (sub_category_id) {
            $.ajax({
                method: 'POST',
                url: '<?php echo e(action([\App\Http\Controllers\ProductController::class, 'getSubCategories']), false); ?>',
                dataType: 'html',
                data: { cat_id: sub_category_id },
                success: function(result) {
                    if (result) {
                        $('#cir_sub2_category_id').html(result).trigger('change.select2');
                    }
                }
            });
        }

        get_combo_items_report();
    });

    $(document).on('change', '#cir_product_type, #cir_location_id, #cir_sub2_category_id', function(){
        get_combo_items_report();
    });

    $(document).on('click', '#print_report', function(){
        var data = getComboItemsReportFilterParams();
        var url = '<?php echo e(url('reports/combo-items-report-print'), false); ?>?' + $.param(data);
        window.open(url, '_blank');
    });

});

function getComboItemsReportFilterParams() {
    return {
        location_id: $('#cir_location_id').val(),
        product_type: $('#cir_product_type').val(),
        variation_id: $('#cir_variation_id').val(),
        category_id: $('#cir_category_id').val(),
        sub_category_id: $('#cir_sub_category_id').val(),
        sub2_category_id: $('#cir_sub2_category_id').val()
    };
}

function get_combo_items_report() {

    var data = getComboItemsReportFilterParams();
    $('#combo_items_report_excel').attr('href', '<?php echo e(url('reports/combo-items-report-print'), false); ?>?output=excel&' + $.param(data));
    var loader = __fa_awesome();
    $('#combo_report_div').html(`
        <div class="container text-center" style="justify-content: space-around;display: flex;">
            <div style="padding: 15px;margin: 25px;font-size: 1.4em;background-color: #d0f5be;width: 40%;">Processing Report ${loader}</div>
        </div>
    `);
    $.ajax({
        url: '<?php echo e(action([\App\Http\Controllers\ReportController::class, 'comboItemsReport']), false); ?>',
        data: data,
        dataType: 'html',
        timeout: 120000,
        success: function(result) {
            $('#combo_report_div').html(result);
            // calculate_ledger_footer_total('#contact_ledger_div');.
        },
        error: function(xhr, textStatus) {
            var message = textStatus === 'timeout'
                ? 'Report request timed out. Please narrow the filters and try again.'
                : <?php echo json_encode(__('messages.something_went_wrong'), 15, 512) ?>;

            $('#combo_report_div').html(
                '<div class="alert alert-danger" style="margin: 20px;">' + message + '</div>'
            );
        },
    });
}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>