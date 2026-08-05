
<?php $__env->startSection('title', __('lang_v1.stock_consumption_report')); ?>
<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_stock_consumption_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo e(__('lang_v1.stock_consumption_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getConsumptionReport']), 'method'
            => 'get', 'id' => 'stock_consumption_report_form', 'class' => 'row' ]); ?>


            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('location_id', __('purchase.business_location').':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'required', 'style' => 'width:100%',]); ?>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('scr_date_filter', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' =>
                    'form-control', 'id' => 'scr_date_filter', 'readonly']); ?>

                </div>
            </div>

            <?php if(session('business.enable_category')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('category_id', __('product.category') . ':'); ?>

                    <?php echo Form::select('category_id', $categories, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'scr_filter_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                    <?php echo Form::select('sub_category_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'scr_filter_sub_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub2_category_id', __('product.sub2_category') . ':'); ?>

                    <?php echo Form::select('sub2_category_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'scr_filter_sub2_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_brand')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('brand_id', __('product.brand') . ':'); ?>

                    <?php echo Form::select('brand_id', $brands, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'scr_filter_brand_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub_brand_id', __('product.sub_brand') . ':'); ?>

                    <?php echo Form::select('sub_brand_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'scr_filter_sub_brand_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_gender')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('gender_id', __('product.gender') . ':'); ?>

                    <?php echo Form::select('gender_id', $genders, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'scr_filter_gender_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub_gender_id', __('product.sub_gender') . ':'); ?>

                    <?php echo Form::select('sub_gender_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'scr_filter_sub_gender_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_procurement_source')): ?>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('procurement_source_id', __('product.procurement_source') . ':'); ?>

                    <?php echo Form::select('procurement_source_id', $procurement_sources, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'scr_filter_procurement_source_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <?php echo Form::label('sub_procurement_source_id', __('product.sub_procurement_source') . ':'); ?>

                    <?php echo Form::select('sub_procurement_source_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'scr_filter_sub_procurement_source_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>

            <?php echo Form::close(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#scr_summary_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i
                                class="fa fa-list" aria-hidden="true"></i> <?php echo app('translator')->get('report.summary'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#scr_detailed_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-bars"
                                    aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.detailed'); ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="scr_summary_tab" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped ajax_view table-th-skin" id="stock_consumption_report_table" style="width:100% !important">
                                <thead>
                                    <tr>
                                        <th class="col-md-1"><?php echo app('translator')->get('category.code'); ?></th>
                                        <th class="col-md-2"><?php echo app('translator')->get( 'category.category' ); ?></th>
                                        <th class="col-md-2"><?php echo app('translator')->get( 'lang_v1.total_sale_exc_tax' ); ?></th>
                                        <th class="col-md-2"><?php echo app('translator')->get( 'lang_v1.system_consumption_qty' ); ?></th>
                                        <th class="col-md-2"><?php echo app('translator')->get( 'lang_v1.system_consumption_cost' ); ?></th>
                                        <th class="col-md-2"><?php echo app('translator')->get( 'lang_v1.system_consumption_profit' ); ?></th>
                                        <th class="col-md-2"><?php echo app('translator')->get( 'lang_v1.actual_consumption_qty' ); ?></th>
                                        <th class="col-md-2"><?php echo app('translator')->get( 'lang_v1.actual_consumption_cost' ); ?></th>
                                        <th class="col-md-2"><?php echo app('translator')->get( 'lang_v1.actual_consumption_profit' ); ?></th>
                                        <th class="col-md-2"><?php echo app('translator')->get( 'lang_v1.difference_qty' ); ?></th>
                                        <th class="col-md-1"><?php echo app('translator')->get( 'lang_v1.difference_percentage' ); ?></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                <tr class="bg-gray font-17 footer-total">
                                    <td ></td>
                                    <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                    <td class="footer_sale_total"></td>
                                    <td class="footer_system_total"></td>
                                    <td class="footer_system_cost_total"></td>
                                    <td class="footer_system_profit_total"></td>
                                    <td class="footer_actual_total"></td>
                                    <td class="footer_actual_cost_total"></td>
                                    <td class="footer_actual_profit_total"></td>
                                    <td class="footer_diff_total"></td>
                                    <td class="footer_percent_total"></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="scr_detailed_tab">
                        <div id="transfer_ledger_div"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="print_report" class="btn btn-success float-end mr-5"><i class="fa fa-print"></i> Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<div class="modal fade view_register" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
                    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<script type="text/javascript">
    $('#stock_transfer_report_form #location_id, #str_filter_brand_id, #scr_filter_category_id, #scr_filter_sub_category_id, #scr_filter_sub2_category_id, #scr_filter_brand_id, #scr_filter_sub_brand_id, #scr_filter_gender_id, #scr_filter_sub_gender_id, #scr_filter_procurement_source_id, #scr_filter_sub_procurement_source_id').change(function() {
        $('.nav-tabs li.active').find('a[data-bs-toggle="tab"]').trigger('shown.bs.tab');
    });
</script>
<script type="text/javascript">
    // Cascade sub-categories
    $('#scr_filter_category_id').change(function() {
        var cat_id = $(this).val();
        $('#scr_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
        $.ajax({ method: 'POST', url: '/products/get_sub_categories', dataType: 'html',
            data: { cat_id: cat_id },
            success: function(result) { if(result) { $('#scr_filter_sub_category_id').html(result); } }
        });
    });
    $('#scr_filter_sub_category_id').change(function() {
        $.ajax({ method: 'POST', url: '/products/get_sub_categories', dataType: 'html',
            data: { cat_id: $(this).val() },
            success: function(result) { if(result) { $('#scr_filter_sub2_category_id').html(result); } }
        });
    });
    // Cascade sub-brands
    $('#scr_filter_brand_id').change(function() {
        var brand_id = $(this).val();
        $('#scr_filter_sub_brand_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
        if(brand_id) {
            $.ajax({ method: 'POST', url: '/brands/get_sub_brands', dataType: 'html',
                data: { brand_id: brand_id },
                success: function(result) { if(result) { $('#scr_filter_sub_brand_id').append(result); } }
            });
        }
    });
    // Cascade sub-genders
    $('#scr_filter_gender_id').change(function() {
        var gender_id = $(this).val();
        $('#scr_filter_sub_gender_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
        if(gender_id) {
            $.ajax({ method: 'POST', url: '/genders/get_sub_genders', dataType: 'html',
                data: { gender_id: gender_id },
                success: function(result) { if(result) { $('#scr_filter_sub_gender_id').append(result); } }
            });
        }
    });
    // Cascade sub-procurement-sources
    $('#scr_filter_procurement_source_id').change(function() {
        var proc_id = $(this).val();
        $('#scr_filter_sub_procurement_source_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
        if(proc_id) {
            $.ajax({ method: 'POST', url: '/procurement-sources/get_sub_procurement_sources', dataType: 'html',
                data: { procurement_source_id: proc_id },
                success: function(result) { if(result) { $('#scr_filter_sub_procurement_source_id').append(result); } }
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var stockConsumptionDateRangeSettings = $('#reports_filter_date_range').length
            ? window.getAdminReportDateRangeSettings()
            : $.extend({}, dateRangeSettings, {
                startDate: moment(),
                endDate: moment()
            });
        
        $('#scr_date_filter').daterangepicker(stockConsumptionDateRangeSettings, function (start, end) {
            $('#scr_date_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            stock_consumption_report_table.ajax.reload();
            get_detailed_report();
        }
        );
        var stockConsumptionDatePicker = $('#scr_date_filter').data('daterangepicker');
        if (stockConsumptionDatePicker) {
            $('#scr_date_filter').val(
                stockConsumptionDatePicker.startDate.format(moment_date_format) +
                ' ~ ' +
                stockConsumptionDatePicker.endDate.format(moment_date_format)
            );
        }
        $('#scr_date_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#scr_date_filter').val('');
            stock_consumption_report_table.ajax.reload();
            get_detailed_report();
        });
        $('#scr_date_filter').change( function(){
            stock_consumption_report_table.ajax.reload();
            get_detailed_report();
        });

        report_filters = [];

        stock_consumption_report_table = $('#stock_consumption_report_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[0, 'asc']],
            "ajax": {
                "url": '/reports/stock-consumption-report',
                "data": function(d) {
                    d.location_id = $('#location_id').val();
                    d.category_id = $('#scr_filter_category_id').val();
                    d.sub_category_id = $('#scr_filter_sub_category_id').val();
                    d.sub2_category_id = $('#scr_filter_sub2_category_id').val();
                    d.brand_id = $('#scr_filter_brand_id').val();
                    d.sub_brand_id = $('#scr_filter_sub_brand_id').val();
                    d.gender_id = $('#scr_filter_gender_id').val();
                    d.sub_gender_id = $('#scr_filter_sub_gender_id').val();
                    d.procurement_source_id = $('#scr_filter_procurement_source_id').val();
                    d.sub_procurement_source_id = $('#scr_filter_sub_procurement_source_id').val();
                    var start = null;
                    var end = null;
                    if($('#scr_date_filter').val()) {
                        start = $('#scr_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        end = $('#scr_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;

                    var dateRange = $('#scr_date_filter').val();
                    report_filters.push({key: 'Date Range', value: dateRange});
                    var location = $('#select2-location_id-container').text();
                    report_filters.push({key: 'Location', value: location});
                    var category = $('#select2-scr_filter_category_id-container').text();
                    report_filters.push({key: 'Category', value: category});
                }
            },
            columnDefs: [
                {
                    targets: 6,
                    orderable: false,
                    searchable: false,
                },
            ],
            columns: [
                { data: 'cat_code', name: 'cat_code' },
                { data: 'name', name: 'name' },
                { data: 'sell_total', name: 'sell_total' },
                { data: 'system', name: 'system' },
                { data: 'system_cost', name: 'system_cost' },
                { data: 'system_profit', name: 'system_profit' },
                { data: 'actual', name: 'actual' },
                { data: 'actual_cost', name: 'actual_cost' },
                { data: 'actual_profit', name: 'actual_profit' },
                { data: 'diff', name: 'diff' },
                { data: 'percent', name: 'percent' },
            ],
            footerCallback: function ( row, data, start, end, display ) {
                var footer_sale_total = 0;
                var footer_system_total = 0;
                var footer_system_cost_total = 0;
                var footer_system_profit_total = 0;
                var footer_actual_total = 0;
                var footer_actual_cost_total = 0;
                var footer_actual_profit_total = 0;
                var footer_diff_total = 0;
                var footer_percent_total = 0;
                
                for (var r in data){
                    footer_sale_total += parseFloat(data[r].sell_total_uf);
                    footer_system_total += parseFloat(data[r].system);
                    footer_system_cost_total += parseFloat(data[r].system_cost_uf);
                    footer_actual_total += parseFloat(data[r].actual);
                    footer_actual_cost_total += parseFloat(data[r].actual_cost_uf);
                }

                if (footer_sale_total != 0) {
                    footer_system_profit_total = (footer_system_cost_total / footer_sale_total) * 100; 
                    footer_actual_profit_total = (footer_actual_cost_total / footer_sale_total) * 100; 
                }

                if (footer_system_total != 0) {
                    footer_percent_total = ((parseFloat(footer_system_total - footer_actual_total) / parseFloat(footer_actual_total)) * 100); 
                }

                footer_diff_total = footer_system_total - footer_actual_total;
                

                $('.footer_sale_total').html(__currency_trans_from_en(footer_sale_total, false, false, __quantity_precision, false));
                $('.footer_system_total').html(__currency_trans_from_en(footer_system_total, false, false, __quantity_precision, true));
                $('.footer_system_cost_total').html(__currency_trans_from_en(footer_system_cost_total, false, false, __quantity_precision, false));
                $('.footer_system_profit_total').html(__currency_trans_from_en(footer_system_profit_total, false, false, __currency_precision, false) + '%');
                $('.footer_actual_total').html(__currency_trans_from_en(footer_actual_total, false, false, __quantity_precision, true));
                $('.footer_actual_cost_total').html(__currency_trans_from_en(footer_actual_cost_total, false, false, __quantity_precision, false));
                $('.footer_actual_profit_total').html(__currency_trans_from_en(footer_actual_profit_total, false, false, __currency_precision, false) + '%');
                $('.footer_diff_total').html(__currency_trans_from_en(footer_diff_total, false, false, __quantity_precision, true));
                $('.footer_percent_total').html(__currency_trans_from_en(footer_percent_total, false, false, __currency_precision, false) + '%');
                
                
            },
        });

        $(document).on('change', '#location_id, #scr_filter_category_id, #scr_filter_sub_category_id, #scr_filter_sub2_category_id, #scr_filter_brand_id, #scr_filter_sub_brand_id, #scr_filter_gender_id, #scr_filter_sub_gender_id, #scr_filter_procurement_source_id, #scr_filter_sub_procurement_source_id',  function() {
            stock_consumption_report_table.ajax.reload();
            get_detailed_report();
        });

        <?php if(!empty($user_settings['rpt_stock_scons_hide_code'])): ?>
            stock_consumption_report_table.column(0).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_scons_hide_category'])): ?>
            stock_consumption_report_table.column(1).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_scons_hide_total_sale_exc_tax'])): ?>
            stock_consumption_report_table.column(2).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_scons_hide_sys_consumption_qty'])): ?>
            stock_consumption_report_table.column(3).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_scons_hide_sys_consumption_cost'])): ?>
            stock_consumption_report_table.column(4).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_scons_hide_sys_consumption_profit'])): ?>
            stock_consumption_report_table.column(5).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_scons_hide_actual_consumption_qty'])): ?>
            stock_consumption_report_table.column(6).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_scons_hide_actual_consumption_cost'])): ?>
            stock_consumption_report_table.column(7).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_scons_hide_actual_consumption_profit'])): ?>
            stock_consumption_report_table.column(8).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_scons_hide_difference_qty'])): ?>
            stock_consumption_report_table.column(9).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_stock_scons_hide_difference_pct'])): ?>
            stock_consumption_report_table.column(10).visible(false);
        <?php endif; ?>

        get_detailed_report();

        $(document).on('click', '#print_report', function(){
            $('.consumption_report_filters').toggleClass('hide');
            $('#transfer_ledger_div').printThis({
                header: "<h1>"+document.title+"</h1>"
            });
            setTimeout(() => {
                $('.consumption_report_filters').toggleClass('hide');    
            }, 2000);
        });
    });

    function get_detailed_report() {
        var location_id = $('#location_id').val();
        var category_id = $('#scr_filter_category_id').val();
        var sub_category_id = $('#scr_filter_sub_category_id').val();
        var sub2_category_id = $('#scr_filter_sub2_category_id').val();
        var brand_id = $('#scr_filter_brand_id').val();
        var sub_brand_id = $('#scr_filter_sub_brand_id').val();
        var gender_id = $('#scr_filter_gender_id').val();
        var sub_gender_id = $('#scr_filter_sub_gender_id').val();
        var procurement_source_id = $('#scr_filter_procurement_source_id').val();
        var sub_procurement_source_id = $('#scr_filter_sub_procurement_source_id').val();
        var start = null;
        var end = null;
        if($('#scr_date_filter').val()) {
            start = $('#scr_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
            end = $('#scr_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
        }
        var start_date = start;
        var end_date = end;

        var loader = __fa_awesome();
        $('#transfer_ledger_div').html(`
            <div class="container text-center" style="justify-content: space-around;display: flex;">
                <div style="padding: 15px;margin: 25px;font-size: 1.4em;background-color: #d0f5be;width: 40%;">Processing Report ${loader}</div>
            </div>
        `);
        $.ajax({
            url: '/reports/stock-consumption-report-detailed',
            data: {
                location_id : location_id,
                category_id : category_id,
                sub_category_id : sub_category_id,
                sub2_category_id : sub2_category_id,
                brand_id : brand_id,
                sub_brand_id : sub_brand_id,
                gender_id : gender_id,
                sub_gender_id : sub_gender_id,
                procurement_source_id : procurement_source_id,
                sub_procurement_source_id : sub_procurement_source_id,
                start_date : start_date,
                end_date : end_date,
            },
            dataType: 'html',
            success: function(result) {
                $('#transfer_ledger_div').html(result);
            },
        });
        }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>