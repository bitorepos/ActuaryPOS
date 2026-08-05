
<?php $__env->startSection('title', __('lang_v1.daily_closing_report')); ?>

<?php $__env->startSection('css'); ?>
<style>
    #daily_closing_purchase_details .table-responsive,
    #daily_closing_stock_value_details {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    #daily_closing_purchase_details th,
    #daily_closing_purchase_details td,
    #daily_closing_stock_value_details th,
    #daily_closing_stock_value_details td {
        white-space: nowrap;
    }
    .daily-closing-report-section {
        margin-bottom: 20px;
    }
    .daily-closing-report-section .section-title {
        font-size: 18px;
        font-weight: 600;
        margin: 0 0 12px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_stock_value_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
    <h1>
        <?php echo e(__('lang_v1.daily_closing_report'), false); ?>

        <button type="button" class="btn btn-primary float-end" id="printDailyClosingReport">
            <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
        </button>
    </h1>
</section>

<section class="content no-print">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
                <?php echo Form::open(['url' => '#', 'method' => 'get', 'class' => 'row', 'id' => 'stock_report_filter_form']); ?>

                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('location_id',  __('purchase.business_location') . ':'); ?>

                        <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('as_of_date', __('report.as_of_date') . ':'); ?>

                        <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'as_of_date', 'readonly']); ?>

                    </div>
                </div>
                <?php if(session('business.enable_category')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('category_id', __('category.category') . ':'); ?>

                        <?php echo Form::select('category', $categories, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                        <?php echo Form::select('sub_category', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sub2_category_id', __('product.sub2_category') . ':'); ?>

                        <?php echo Form::select('sub2_category', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub2_category_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('supplier_id', __('purchase.supplier') . ':'); ?>

                        <?php echo Form::select('supplier_id', $suppliers, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <?php if(session('business.enable_brand')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('brand', __('product.brand') . ':'); ?>

                        <?php echo Form::select('brand', $brands, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sub_brand_id', __('product.sub_brand') . ':'); ?>

                        <?php echo Form::select('sub_brand_id', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_brand_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_gender')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('gender_id', __('product.gender') . ':'); ?>

                        <?php echo Form::select('gender_id', $genders, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sub_gender_id', __('product.sub_gender') . ':'); ?>

                        <?php echo Form::select('sub_gender_id', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_gender_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_procurement_source')): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('procurement_source_id', __('product.procurement_source') . ':'); ?>

                        <?php echo Form::select('procurement_source_id', $procurement_sources, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sub_procurement_source_id', __('product.sub_procurement_source') . ':'); ?>

                        <?php echo Form::select('sub_procurement_source_id', [], null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_procurement_source_id']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('unit',__('product.unit') . ':'); ?>

                        <?php echo Form::select('unit', $units, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <br>
                        <div class="form-check">
                            <label class="form-check-label">
                                <?php echo Form::checkbox('show_positive_quantity', 1, true, ['class' => 'form-check-input', 'id' => 'show_positive_quantity']); ?> <?php echo app('translator')->get('lang_v1.show_positive_quantity'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <br>
                        <div class="form-check">
                            <label class="form-check-label">
                                <?php echo Form::checkbox('show_negative_quantity', 1, true, ['class' => 'form-check-input', 'id' => 'show_negative_quantity']); ?> <?php echo app('translator')->get('lang_v1.show_negative_quantity'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <br>
                        <div class="form-check">
                            <label class="form-check-label">
                                <?php echo Form::checkbox('show_zero_quantity', 1, false, ['class' => 'form-check-input', 'id' => 'show_zero_quantity']); ?> <?php echo app('translator')->get('lang_v1.show_zero_quantity'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <br>
                        <div class="form-check">
                            <label class="form-check-label">
                                <?php echo Form::checkbox('show_without_history', 1, false, ['class' => 'form-check-input', 'id' => 'show_without_history']); ?> <?php echo app('translator')->get('lang_v1.show_without_history'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <br>
                        <div class="form-check">
                            <label class="form-check-label">
                                <?php echo Form::checkbox('show_price_exc_tax', 1, false, ['class' => 'form-check-input', 'id' => 'show_price_exc_tax']); ?> <?php echo app('translator')->get('lang_v1.show_price_exc_tax'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <div class="form-check">
                            <label class="form-check-label">
                                <?php echo Form::radio('show_price', 'cost_price', true, ['class'=> 'show_price radio_option mr-5']); ?> Show Cost Price
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <?php echo Form::radio('show_price', 'sell_price', false, ['class'=> 'show_price radio_option mr-5']); ?> Show Sell Price
                            </label>
                        </div>
                    </div>
                </div>
                <?php if($show_manufacturing_data): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <br>
                        <div class="form-check">
                            <label class="form-check-label">
                                <?php echo Form::checkbox('only_mfg', 1, false, ['class' => 'form-check-input', 'id' => 'only_mfg_products']); ?> <?php echo e(__('manufacturing::lang.only_mfg_products'), false); ?>

                            </label>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php echo Form::close(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row daily-closing-report-section">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                <h3 class="section-title"><?php echo e(__('lang_v1.purchase_invoices_report'), false); ?> - <?php echo app('translator')->get('lang_v1.detailed'); ?></h3>
                <div id="daily_closing_purchase_details"></div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row daily-closing-report-section">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                <h3 class="section-title"><?php echo e(__('report.stock_value_report'), false); ?> - <?php echo app('translator')->get('lang_v1.detailed'); ?></h3>
                <div id="daily_closing_stock_value_details"></div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
$(document).ready(function() {
    var dailyClosingPurchasePage = 1;
    var dailyClosingPurchasePerPage = 25;
    var reloadTimer = null;

    $('.select2').select2();

    var defaultAsOfDate = $('#reports_filter_date_range').length
        ? window.getAdminReportDateRangeSettings().endDate
        : moment().subtract(1, 'days');

    $('#as_of_date').val(defaultAsOfDate.format(moment_date_format));
    $('#as_of_date').datepicker({
        dateFormat: moment_date_format,
        onSelect: function(dateText) {
            $('#as_of_date').val(dateText);
            queueReload(true);
        }
    });

    function selectedDate() {
        var date = $('#as_of_date').val();
        var parsed = moment(date, moment_date_format);
        if (!parsed.isValid()) {
            parsed = moment().subtract(1, 'days');
        }

        return parsed;
    }

    function getStockValueFilterParams() {
        return {
            location_id: $('#location_id').val(),
            supplier_id: $('#supplier_id').val(),
            category_id: $('#category_id').val(),
            date_range: $('#as_of_date').val(),
            as_of_date: $('#as_of_date').val(),
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
            show_price_exc_tax: ($('#show_price_exc_tax').length && $('#show_price_exc_tax').is(':checked')) ? 1 : 0,
            show_price: $('.show_price:checked').val(),
            column_visibility_context: 'daily_closing'
        };
    }

    function getPurchaseInvoiceFilterParams(page) {
        var start = selectedDate().add(1, 'days').format('YYYY-MM-DD');
        var end = moment().format('YYYY-MM-DD');

        return {
            purchase_type: 'purchase',
            start_date: start + ' 00:00',
            end_date: end + ' 23:59',
            location_id: $('#location_id').val(),
            supplier_id: $('#supplier_id').val(),
            page: page || dailyClosingPurchasePage,
            per_page: dailyClosingPurchasePerPage
        };
    }

    function showLoading($target) {
        $target.html(
            '<div class="text-center py-4" style="padding: 25px;"><i class="fas fa-spinner fa-spin fa-2x"></i><br><br><?php echo app('translator')->get("lang_v1.loading_data"); ?></div>'
        );
    }

    function loadPurchaseDetails(page) {
        var data = getPurchaseInvoiceFilterParams(page);
        showLoading($('#daily_closing_purchase_details'));

        $.ajax({
            url: "<?php echo e(url('reports/daily-closing-purchase-invoices-detailed'), false); ?>",
            data: data,
            dataType: 'html',
            success: function(result) {
                $('#daily_closing_purchase_details').html(result);
                dailyClosingPurchasePage = parseInt(data.page) || 1;
                calculatePurchaseDetailsFooter('#daily_closing_purchase_details');
            },
            error: function() {
                $('#daily_closing_purchase_details').html('<div class="text-center py-4 text-danger">Error loading purchase invoice details</div>');
            }
        });
    }

    function loadStockValueDetails() {
        showLoading($('#daily_closing_stock_value_details'));

        $.ajax({
            url: "<?php echo e(action([\App\Http\Controllers\ReportController::class, 'getStockValueReportLocationDetails']), false); ?>",
            data: getStockValueFilterParams(),
            dataType: 'html',
            success: function(result) {
                $('#daily_closing_stock_value_details').html(result);
            },
            error: function() {
                $('#daily_closing_stock_value_details').html('<div class="text-center py-4 text-danger">Error loading stock value details</div>');
            }
        });
    }

    function reloadReport(resetPage) {
        if (resetPage) {
            dailyClosingPurchasePage = 1;
        }

        loadPurchaseDetails(dailyClosingPurchasePage);
        loadStockValueDetails();
    }

    function queueReload(resetPage) {
        clearTimeout(reloadTimer);
        reloadTimer = setTimeout(function() {
            reloadReport(resetPage);
        }, 250);
    }

    $(document).on('click', '.pir-detailed-page-link', function(e) {
        e.preventDefault();
        var $li = $(this).closest('li');
        if ($li.hasClass('disabled') || $li.hasClass('active')) {
            return;
        }
        var page = parseInt($(this).data('page'));
        if (page >= 1) {
            loadPurchaseDetails(page);
        }
    });

    $(document).on('change', '#pir_detailed_per_page', function() {
        var val = $(this).val();
        dailyClosingPurchasePerPage = val === 'All' ? 'All' : parseInt(val);
        dailyClosingPurchasePage = 1;
        loadPurchaseDetails(1);
    });

    $('#stock_report_filter_form').on('change', 'select, input', function() {
        queueReload(true);
    });

    $('#printDailyClosingReport').on('click', function(e) {
        e.preventDefault();

        var params = $.extend({}, getStockValueFilterParams(), getPurchaseInvoiceFilterParams(1));
        params.per_page = 'All';
        params.tab = 'daily_closing';

        window.open("<?php echo e(url('reports/daily-closing-report-print'), false); ?>?" + $.param(params), '_blank');
    });

    $('#stock_report_filter_form #category_id').change(function() {
        var cat = $(this).val();
        $('#stock_report_filter_form #sub2_category_id').html('<option value="">All</option>');
        $.ajax({
            method: 'POST',
            url: "<?php echo e(url('/products/get_sub_categories'), false); ?>",
            dataType: 'html',
            data: { cat_id: cat },
            success: function(result) {
                if (result) {
                    $('#stock_report_filter_form #sub_category_id').html(result).trigger('change.select2');
                }
            }
        });
    });

    $('#stock_report_filter_form #sub_category_id').change(function() {
        var subCat = $(this).val();
        $.ajax({
            method: 'POST',
            url: "<?php echo e(url('/products/get_sub_categories'), false); ?>",
            dataType: 'html',
            data: { cat_id: subCat },
            success: function(result) {
                if (result) {
                    $('#stock_report_filter_form #sub2_category_id').html(result).trigger('change.select2');
                }
            }
        });
    });

    $('#stock_report_filter_form #brand').change(function() {
        var brandId = $(this).val();
        if (!brandId) {
            $('#stock_report_filter_form #sub_brand_id').html('<option value="">All</option>').trigger('change.select2');
            return;
        }

        $.ajax({
            method: 'POST',
            url: "<?php echo e(url('/brands/get_sub_brands'), false); ?>",
            dataType: 'html',
            data: { brand_id: brandId },
            success: function(result) {
                if (result) {
                    $('#stock_report_filter_form #sub_brand_id').html(result).trigger('change.select2');
                }
            }
        });
    });

    $('#stock_report_filter_form #gender_id').change(function() {
        var genderId = $(this).val();
        if (!genderId) {
            $('#stock_report_filter_form #sub_gender_id').html('<option value="">All</option>').trigger('change.select2');
            return;
        }

        $.ajax({
            method: 'POST',
            url: "<?php echo e(url('/genders/get_sub_genders'), false); ?>",
            dataType: 'html',
            data: { gender_id: genderId },
            success: function(result) {
                if (result) {
                    $('#stock_report_filter_form #sub_gender_id').html(result).trigger('change.select2');
                }
            }
        });
    });

    $('#stock_report_filter_form #procurement_source_id').change(function() {
        var procurementSourceId = $(this).val();
        if (!procurementSourceId) {
            $('#stock_report_filter_form #sub_procurement_source_id').html('<option value="">All</option>').trigger('change.select2');
            return;
        }

        $.ajax({
            method: 'POST',
            url: "<?php echo e(url('/procurement-sources/get_sub_procurement_sources'), false); ?>",
            dataType: 'html',
            data: { procurement_source_id: procurementSourceId },
            success: function(result) {
                if (result) {
                    $('#stock_report_filter_form #sub_procurement_source_id').html(result).trigger('change.select2');
                }
            }
        });
    });

    reloadReport(true);
});

function calculatePurchaseDetailsFooter(divId) {
    var $sections = $(divId).find('.daily-closing-purchase-location-section');
    if ($sections.length) {
        $sections.each(function() {
            calculatePurchaseDetailsSectionFooter($(this));
        });
        return;
    }

    calculatePurchaseDetailsSectionFooter($(divId));
}

function calculatePurchaseDetailsSectionFooter($scope) {
    var footerQuantityTotal = 0;
    var footerDiscountTotal = 0;
    var footerTaxTotal = 0;
    var footerSubtotalTotal = 0;
    var footerSellTotal = 0;
    var footerProfitTotal = 0;

    $scope.find('.pir_total_row_footer').each(function() {
        footerQuantityTotal += parseFloat($(this).find('.pir_total_quantity_row').val()) || 0;
        footerDiscountTotal += parseFloat($(this).find('.pir_total_discount_row').val()) || 0;
        footerTaxTotal += parseFloat($(this).find('.pir_total_tax_row').val()) || 0;
        footerSubtotalTotal += parseFloat($(this).find('.pir_total_sub_total_row').val()) || 0;
        footerSellTotal += parseFloat($(this).find('.pir_total_sell_price_row').val()) || 0;
        footerProfitTotal += parseFloat($(this).find('.pir_total_profit_row').val()) || 0;
    });

    var footerGpPercent = footerSellTotal !== 0 ? (footerProfitTotal / footerSellTotal) * 100 : 0;
    $scope.find('.pir_footer_quantity_count').html(__number_f(footerQuantityTotal, false));
    $scope.find('.pir_footer_discount_total').html(__currency_trans_from_en(footerDiscountTotal, false));
    $scope.find('.pir_footer_tax_total').html(__currency_trans_from_en(footerTaxTotal, false));
    $scope.find('.pir_footer_subtotal').html(__currency_trans_from_en(footerSubtotalTotal, false));
    $scope.find('.pir_footer_sell_total').html(__currency_trans_from_en(footerSellTotal, false));
    $scope.find('.pir_footer_profit_total').html(__currency_trans_from_en(footerProfitTotal, false));
    $scope.find('.pir_footer_gp_percent').html(__number_f(footerGpPercent, false) + ' %');

    var invoiceTotal = 0;
    var paidTotal = 0;
    var dueTotal = 0;
    var invoiceCount = 0;
    var methodData = [];

    $scope.find('.pir_detail_row').each(function() {
        invoiceTotal += parseFloat($(this).find('.pir_grey_final_total').data('amount')) || 0;
        paidTotal += parseFloat($(this).find('.pir_grey_paid').data('amount')) || 0;
        dueTotal += parseFloat($(this).find('.pir_grey_due').data('orig-value')) || 0;
        invoiceCount++;

        if ($(this).find('.pir_grey_method').data('orig-value')) {
            var methodName = $(this).find('.pir_grey_method').data('orig-value');
            if (!(methodName in methodData)) {
                methodData[methodName] = [];
                methodData[methodName].count = 1;
                methodData[methodName].displayName = $(this).find('.pir_grey_method').data('status-name');
            } else {
                methodData[methodName].count += 1;
            }
        }
    });

    $scope.find('.pir_grey_footer_final_total').html(__currency_trans_from_en(invoiceTotal, false));
    $scope.find('.pir_grey_footer_paid').html(__currency_trans_from_en(paidTotal, false));
    $scope.find('.pir_grey_footer_due').html(__currency_trans_from_en(dueTotal, false));
    $scope.find('.pir_grey_footer_count').html(invoiceCount);

    var methodCount = '<p class="text-left"><small>';
    for (var key in methodData) {
        methodCount += methodData[key].displayName + ' - ' + methodData[key].count + '</br>';
    }
    methodCount += '</small></p>';
    $scope.find('.pir_grey_footer_method').html(methodCount);
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>