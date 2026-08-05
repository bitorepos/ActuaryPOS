<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>

<?php $__env->startSection('title', __('lang_v1.product_sell_report')); ?>

<?php $__env->startSection('content'); ?>
<style>
    #psr_detailed_tab #product_sell_report_table {
        width: 100% !important;
    }

    #psr_detailed_tab .dataTables_wrapper > .row.margin-bottom-20 {
        align-items: center;
        row-gap: 8px;
        width: 100%;
    }

    #psr_detailed_tab .dataTables_length {
        white-space: nowrap;
    }

    #psr_detailed_tab .dt-buttons-wrapper {
        justify-content: center;
    }

    #psr_detailed_tab .dataTables_filter {
        text-align: right;
    }

    table[id^="product_sell"] tfoot td.text-right p,
    table[id^="product_sell"] tfoot th.text-right p {
        text-align: right;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo e(__('lang_v1.product_sell_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_product_sale_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getStockReport']), 'method'
            => 'get', 'class' => 'row', 'id' => 'product_sell_report_form' ]); ?>

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
                <div class="mb-3">
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
                    <?php echo Form::label('customer_id', __('contact.customer') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('customer_id', $customers, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.please_select'), 'required', 'style' => 'width:80%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('psr_customer_group_id', __( 'lang_v1.customer_group_name' ) . ':'); ?>

                    <?php echo Form::select('psr_customer_group_id', $customer_group, null, ['class' => 'form-control select2',
                    'style' => 'width:100%', 'id' => 'psr_customer_group_id']); ?>

                </div>
            </div>

            <?php if(session('business.enable_category')): ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('category_id', __('product.category') . ':'); ?>

                    <?php echo Form::select('category_id', $categories, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                    <?php echo Form::select('sub_category_id', array(), null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_sub_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category')): ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('sub2_category_id', __('product.sub2_category') . ':'); ?>

                    <?php echo Form::select('sub2_category_id', array(), null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_sub2_category_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_brand')): ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('brand_id', __('product.brand') . ':'); ?>

                    <?php echo Form::select('brand_id', $brands, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_brand_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('sub_brand_id', __('product.sub_brand') . ':'); ?>

                    <?php echo Form::select('sub_brand_id', [], null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_sub_brand_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_gender')): ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('gender_id', __('product.gender') . ':'); ?>

                    <?php echo Form::select('gender_id', $genders, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_gender_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('sub_gender_id', __('product.sub_gender') . ':'); ?>

                    <?php echo Form::select('sub_gender_id', [], null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_sub_gender_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(session('business.enable_procurement_source')): ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('procurement_source_id', __('product.procurement_source') . ':'); ?>

                    <?php echo Form::select('procurement_source_id', $procurement_sources, null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_procurement_source_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('sub_procurement_source_id', __('product.sub_procurement_source') . ':'); ?>

                    <?php echo Form::select('sub_procurement_source_id', [], null, ['class' => 'form-control select2', 'style' =>
                    'width:100%', 'id' => 'psr_filter_sub_procurement_source_id', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
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
                $srTimeFormat = session('business.time_format') == 24 ? 'H:i' : 'h:i A';
                $srStartTime = $startDay->format($srTimeFormat);
                $srEndTime = $endDay->format($srTimeFormat);
                ?>
                <div class="form-group mb-2">
                    <?php echo Form::text('start_time', $srStartTime, ['style' => __('lang_v1.select_a_date_range'),
                    'class' => 'form-control width-50 f-left', 'id' => 'product_sr_start_time']); ?>

                    <?php echo Form::text('end_time', $srEndTime, ['class' => 'form-control width-50 f-left', 'id'
                    => 'product_sr_end_time']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <br>
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('show_negative_profit', 1, false, ['class' => 'form-check-input', 'id' => 'show_negative_profit']); ?> 
                            <?php echo app('translator')->get('lang_v1.show_negative_profit'); ?>
                        </label>
                    </div>
                </div>
            </div>
            <?php echo Form::close(); ?>

            <?php echo $__env->renderComponent(); ?>
            <input id="enable_scheme_quantity_sales" type="hidden" value='<?php echo e(!empty($common_settings["enable_scheme_quantity_sales"]) ? 1 : 0, false); ?>'>
            <input id="enable_inline_product_note_sale" type="hidden" value='<?php echo e(!empty($common_settings["enable_inline_product_note_sale"]) ? 1 : 0, false); ?>'>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active pb-2 pe-2 ps-2" href="#psr_summary_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-list"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.summary'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#psr_summary_combo_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-list"
                                aria-hidden="true"></i> Summary (Combo)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#psr_detailed_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-list"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.detailed'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#psr_detailed_with_purchase_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i
                                class="fa fa-list" aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.detailed_with_purchase'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#psr_grouped_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-bars"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.grouped'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#psr_by_cat_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-bars"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.by_category'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#psr_by_sub_cat_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-bars"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.by_sub_category'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#psr_by_sub2_cat_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-bars"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.by_sub2_category'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#psr_by_brand_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-bars"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.by_brand'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#psr_by_gender_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-bars"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.by_gender'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-2 pe-2 ps-2" href="#psr_by_procurement_source_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-bars"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.by_procurement_source'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#psr_not_sold" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-bars"
                                aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.not_sold'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#psr_not_sold_combo" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-bars"
                                aria-hidden="true"></i> Not Sold (Combo)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="psr_summary_tab" role="tabpanel">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end open-product-sell-report-print" data-tab="summary">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin" id="product_sell_report_summary_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                                        <th style="width:450px"><?php echo app('translator')->get('sale.product'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.qty'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.average_product'); ?> ()</th>
                                        <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                                        <th class="text-right"><?php echo app('translator')->get('sale.scheme_qty'); ?></th>
                                        <?php endif; ?>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('purchase.cost_total'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.profit'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.gross_profit'); ?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td colspan="2"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td id="footer_total_sold_summary" class="text-right"></td>
                                        <td class="text-right"></td>
                                        <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                                        <td id="footer_total_foc_sold_summary" class="text-right"></td>
                                        <?php endif; ?>
                                        <td class="text-right"><span class="display_currency" id="footer_subtotal_summary"></span></td>
                                        <td class="text-right"><span class="display_currency" id="footer_purchase_total_summary"></span></td>
                                        <td class="text-right"><span class="display_currency" id="footer_profit_summary"></span></td>
                                        <td class="text-right"><span id="footer_gross_profit_summary"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <p class="text-muted">
                                    <?php echo app('translator')->get('lang_v1.profit_note'); ?>
                                </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="psr_summary_combo_tab" role="tabpanel">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end open-product-sell-report-print" data-tab="summary_combo">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin" id="product_sell_report_summary_combo_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                                        <th style="width:450px"><?php echo app('translator')->get('sale.product'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.qty'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.average_product'); ?> ()</th>
                                        <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                                        <th class="text-right"><?php echo app('translator')->get('sale.scheme_qty'); ?></th>
                                        <?php endif; ?>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('purchase.cost_total'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.profit'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.gross_profit'); ?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td colspan="2"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td id="footer_total_sold_summary_combo" class="text-right"></td>
                                        <td class="text-right"></td>
                                        <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                                        <td id="footer_total_foc_sold_summary_combo" class="text-right"></td>
                                        <?php endif; ?>
                                        <td class="text-right"><span class="display_currency" id="footer_subtotal_summary_combo"></span></td>
                                        <td class="text-right"><span class="display_currency" id="footer_purchase_total_summary_combo"></span></td>
                                        <td class="text-right"><span class="display_currency" id="footer_profit_summary_combo"></span></td>
                                        <td class="text-right"><span id="footer_gross_profit_summary_combo"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <p class="text-muted">
                                    <?php echo app('translator')->get('lang_v1.profit_note'); ?>
                                </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="psr_detailed_tab" role="tabpanel">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end open-product-sell-report-print" data-tab="detailed">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin" id="product_sell_report_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                                        <th style="width:450px"><?php echo app('translator')->get('sale.product'); ?></th>
                                        <?php if(!empty($common_settings['enable_inline_product_note_sale'])): ?>
                                        <th><?php echo app('translator')->get('lang_v1.product_note'); ?></th>
                                        <?php endif; ?>
                                        <th><?php echo app('translator')->get('brand.brand_name'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.contact_id'); ?></th>
                                        <th style="width:350px"><?php echo app('translator')->get('sale.customer_name'); ?></th>
                                        <th style="width:350px"><?php echo app('translator')->get('lang_v1.supplier_name'); ?></th>
                                        <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.qty'); ?></th>
                                        <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                                        <th class="text-right"><?php echo app('translator')->get('sale.scheme_qty'); ?></th>
                                        <?php endif; ?>
                                        <th><?php echo app('translator')->get('product.sr_imei_no'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.unit_price'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.subtotal'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.discount'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.discount'); ?> %</th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.tax'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.price_inc_tax'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('purchase.unit_cost_exc_tax'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('purchase.cost_total'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.profit'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.gross_profit'); ?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td colspan="<?php echo e(!empty($common_settings['enable_inline_product_note_sale']) ? 9 : 8, false); ?>"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td id="footer_total_sold" class="text-right"></td>
                                        <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                                        <td id="footer_total_foc_sold" class="text-right"></td>
                                        <?php endif; ?>
                                        <td></td>
                                        <td class="text-right"></td>
                                        <td id="footer_before_discount_subtotal" class="text-right"></td>
                                        <td id="footer_discount" class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td id="footer_tax" class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"><span class="display_currency" id="footer_subtotal"></span></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"><span class="display_currency" id="footer_purchase_total"></span></td>
                                        <td class="text-right"><span class="display_currency" id="footer_profit_total"></span></td>
                                        <td class="text-right"><span id="footer_gross_profit_total"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <p class="text-muted">
                                    <?php echo app('translator')->get('lang_v1.profit_note'); ?>
                                </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="psr_detailed_with_purchase_tab" role="tabpanel">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end open-product-sell-report-print" data-tab="detailed_with_purchase">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <?php if(session('business.enable_lot_number')): ?>
                            <input type="hidden" id="lot_enabled">
                            <?php endif; ?>
                            <table class="table table-bordered table-striped table-th-skin"
                                id="product_sell_report_with_purchase_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                                        <th style="width:450px"><?php echo app('translator')->get('sale.product'); ?></th>
                                        <th style="width:350px"><?php echo app('translator')->get('sale.customer_name'); ?></th>
                                        <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.purchase_ref_no'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.lot_number'); ?></th>
                                        <th style="width:350px"><?php echo app('translator')->get('lang_v1.supplier_name'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.qty'); ?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?></th>
                                        <th class="text-right"><span id="psr-dp-qty-total"></span></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="psr_grouped_tab" role="tabpanel">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end open-product-sell-report-print" data-tab="grouped">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin"
                                id="product_sell_grouped_report_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                                        <th style="width:450px"><?php echo app('translator')->get('sale.product'); ?></th>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('report.current_stock'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('report.total_unit_sold'); ?></th>
                                        <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                                        <th class="text-right"><?php echo app('translator')->get('report.total_foc_unit_sold'); ?></th>
                                        <?php endif; ?>
                                        <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('purchase.cost_total'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.profit'); ?> ()</th>
                                        <th class="text-right"><?php echo app('translator')->get('lang_v1.gross_profit'); ?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td colspan="4"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td id="footer_total_grouped_sold" class="text-right"></td>
                                        <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                                        <td id="footer_total_grouped_foc_sold" class="text-right"></td>
                                        <?php endif; ?>
                                        <td class="text-right"><span class="display_currency" id="footer_grouped_subtotal"></span></td>
                                        <td class="text-right"><span class="display_currency" id="footer_grouped_cost_total"></span></td>
                                        <td class="text-right"><span class="display_currency" id="footer_grouped_profit"></span></td>
                                        <td class="text-right"><span id="footer_grouped_gross_profit"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <p class="text-muted">
                                    <?php echo app('translator')->get('lang_v1.profit_note'); ?>
                                </p>
                        </div>
                    </div>
                    <?php echo $__env->make('report.partials.product_sell_report_by_category', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->make('report.partials.product_sell_report_by_sub_category', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->make('report.partials.product_sell_report_by_sub2_category', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->make('report.partials.product_sell_report_by_brand', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->make('report.partials.product_sell_report_by_gender', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->make('report.partials.product_sell_report_by_procurement_source', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="tab-pane fade" id="psr_not_sold" role="tabpanel">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end open-product-sell-report-print" data-tab="not_sold">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin"
                                id="product_sell_not_sold_report_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                                        <th style="width:450px"><?php echo app('translator')->get('sale.product'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.unit_price'); ?> ()</th>
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
                    <div class="tab-pane fade" id="psr_not_sold_combo" role="tabpanel">
                        <div class="row no-print">
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary float-end open-product-sell-report-print" data-tab="not_sold_combo">
                                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin"
                                id="product_sell_not_sold_combo_report_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                                        <th style="width:450px"><?php echo app('translator')->get('sale.product'); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('sale.unit_price'); ?> ()</th>
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
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<script type="text/javascript">
window.hideProductSellReportSaleValue = <?php echo e(! empty($hide_product_sell_report_sale_value) ? 'true' : 'false', false); ?>;
window.hideProductSellReportCostProfit = <?php echo e(! empty($hide_product_sell_report_cost_profit) ? 'true' : 'false', false); ?>;

function applyProductSellReportPermissionColumns(table) {
    if (!table || typeof table.column !== 'function') {
        return;
    }

    if (window.hideProductSellReportSaleValue) {
        table.column('subtotal:name').visible(false);
    }

    if (window.hideProductSellReportCostProfit) {
        table.column('cost_total:name').visible(false);
        table.column('profit:name').visible(false);
        table.column('profit_percent:name').visible(false);
    }
}

function getProductSellReportPrintFilterParams(tab) {
    var start = '';
    var end = '';
    var start_time = $('#product_sr_start_time').val();
    var end_time = $('#product_sr_end_time').val();

    if ($('#product_sr_date_filter').val()) {
        start = $('input#product_sr_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
        end = $('input#product_sr_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
        start = moment(start + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
        end = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
    }

    var params = {
        tab: tab || 'summary',
        start_date: start,
        end_date: end,
        variation_id: $('#variation_id').val(),
        location_id: $('select#location_id').val(),
        customer_id: $('select#customer_id').val(),
        supplier_id: $('select#supplier_id').val(),
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
        show_negative_profit: $('#show_negative_profit').length && $('#show_negative_profit').is(':checked') ? 1 : ''
    };

    $.each(params, function(key, value) {
        if (value === '' || value === null || typeof value === 'undefined') {
            delete params[key];
        }
    });

    return params;
}

$(document).on('click', '.open-product-sell-report-print', function(e) {
    e.preventDefault();
    var url = "<?php echo e(url('reports/product-sell-report-print'), false); ?>?" + $.param(getProductSellReportPrintFilterParams($(this).data('tab')));
    window.open(url, '_blank');
});

$('#product_sell_report_form #location_id, #product_sell_report_form #customer_id, #product_sell_report_form #supplier_id, #psr_filter_brand_id, #psr_filter_sub_brand_id, #psr_filter_gender_id, #psr_filter_sub_gender_id, #psr_filter_procurement_source_id, #psr_filter_sub_procurement_source_id, #psr_filter_category_id, #psr_filter_sub_category_id, #psr_filter_sub2_category_id, #psr_customer_group_id, #show_negative_profit').change(function() {
    // Reload eagerly-initialized datatables (Summary, Summary Combo, Detailed, etc.)
    if (typeof product_sell_report_summary !== 'undefined') {
        product_sell_report_summary.ajax.reload();
    }
    if (typeof product_sell_report_summary_combo !== 'undefined') {
        product_sell_report_summary_combo.ajax.reload();
    }
    if (typeof product_sell_report !== 'undefined') {
        product_sell_report.ajax.reload();
    }
    if (typeof product_sell_report_not_sold !== 'undefined') {
        product_sell_report_not_sold.ajax.reload();
    }
    if (typeof product_sell_report_not_sold_combo !== 'undefined') {
        product_sell_report_not_sold_combo.ajax.reload();
    }
    if (typeof product_sell_report_with_purchase_table !== 'undefined') {
        product_sell_report_with_purchase_table.ajax.reload();
    }
    if (typeof product_sell_grouped_report !== 'undefined') {
        product_sell_grouped_report.ajax.reload();
    }
    // Reload lazy-loaded grouped-by tab datatables (BS5: active class is on a.nav-link)
    $('.nav-tabs .nav-link.active').trigger('shown.bs.tab');
});
$(document).ready(function() {
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
        var target = $(e.target).attr('href');
        if (target == '#psr_detailed_tab' && typeof product_sell_report !== 'undefined') {
            setTimeout(function() {
                product_sell_report.columns.adjust();
            }, 0);
        }
        if (target == '#psr_by_cat_tab') {
            if (typeof product_sell_report_by_category_datatable == 'undefined') {
                product_sell_report_by_category_datatable = $('table#product_sell_report_by_category')
                    .DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/reports/product-sell-grouped-by',
                            data: function(d) {
                                var start = '';
                                var end = '';
                                var start_time = $('#product_sr_start_time').val();
                                var end_time = $('#product_sr_end_time').val();
                                if ($('#product_sr_date_filter').val()) {
                                    start = $('input#product_sr_date_filter')
                                        .data('daterangepicker')
                                        .startDate.format('YYYY-MM-DD');
                                    end = $('input#product_sr_date_filter')
                                        .data('daterangepicker')
                                        .endDate.format('YYYY-MM-DD');

                                    start = moment(start + " " + start_time, "YYYY-MM-DD" +
                                        " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                                    end = moment(end + " " + end_time, "YYYY-MM-DD" + " " +
                                        moment_time_format).format('YYYY-MM-DD HH:mm');
                                }
                                d.start_date = start;
                                d.end_date = end;
                                d.group_by = 'category';
                                d.category_id = $('select#psr_filter_category_id').val();
                                d.sub_category_id = $('select#psr_filter_sub_category_id').val();
                                d.sub2_category_id = $('select#psr_filter_sub2_category_id').val();
                                d.brand_id = $('select#psr_filter_brand_id').val();
                                d.sub_brand_id = $('select#psr_filter_sub_brand_id').val();
                                d.gender_id = $('select#psr_filter_gender_id').val();
                                d.sub_gender_id = $('select#psr_filter_sub_gender_id').val();
                                d.procurement_source_id = $('select#psr_filter_procurement_source_id').val();
                                d.sub_procurement_source_id = $('select#psr_filter_sub_procurement_source_id').val();
                                d.customer_id = $('select#customer_id').val();
                                d.supplier_id = $('select#supplier_id').val();
                                d.location_id = $('select#location_id').val();
                                d.customer_group_id = $('#psr_customer_group_id').val();
                                d.show_negative_profit = $('#show_negative_profit').length && $('#show_negative_profit').is(':checked') ? 1 : 0;
                            },
                        },
                        columns: [{
                                data: 'category_name',
                                name: 'cat.name'
                            },
                            {
                                data: 'current_stock',
                                name: 'current_stock',
                                searchable: false,
                                orderable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'total_qty_sold',
                                name: 'total_qty_sold',
                                searchable: false,
                                className: 'text-right'
                            },
                            <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                            {
                                data: 'total_foc_qty_sold',
                                name: 'total_foc_qty_sold',
                                searchable: false,
                                className: 'text-right'
                            },
                            <?php endif; ?>
                            {
                                data: 'subtotal',
                                name: 'subtotal',
                                searchable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'cost_total',
                                name: 'cost_total',
                                searchable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'profit',
                                name: 'profit',
                                searchable: false,
                                className: 'text-right'
                            },
                            { data: 'profit_percent', name: 'profit_percent', searchable: false, className: 'text-right' },
                        ],
                        fnDrawCallback: function(oSettings) {
                            $('#footer_psr_by_cat_total_sell').text(
                                sum_table_col($('#product_sell_report_by_category'),
                                    'row_subtotal')
                            );
                            $('#footer_psr_by_cat_cost_total').text(
                                sum_table_col($('#product_sell_report_by_category'),
                                    'row_cost_total')
                            );
                            $('#footer_psr_by_cat_profit').text(
                                sum_table_col($('#product_sell_report_by_category'),
                                    'row_profit')
                            );
                            $('#footer_psr_by_cat_total_sold').html(
                                __sum_stock($('#product_sell_report_by_category'),
                                    'sell_qty')
                            );
                            $('#footer_psr_by_cat_total_foc_sold').html(
                                __sum_stock($('#product_sell_report_by_category'),
                                    'foc_qty')
                            );

                            $('#footer_psr_by_cat_total_stock').html(
                                __sum_stock($('#product_sell_report_by_category'),
                                    'current_stock')
                            );
                            let gross_profit = window.productSellGrossProfitPercent($('#product_sell_report_by_category'));
                            $('#footer_psr_by_cat_gross_profit').html(__currency_trans_from_en(gross_profit, false) + '%');
                            __currency_convert_recursively($(
                                '#product_sell_report_by_category'));
                        },
                    });
            } else {
                product_sell_report_by_category_datatable.ajax.reload();
            }
        } else if (target == '#psr_by_sub_cat_tab') {
            if (typeof product_sell_report_by_sub_category_datatable == 'undefined') {
                product_sell_report_by_sub_category_datatable = $('table#product_sell_report_by_sub_category')
                    .DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/reports/product-sell-grouped-by',
                            data: function(d) {
                                var start = '';
                                var end = '';
                                var start_time = $('#product_sr_start_time').val();
                                var end_time = $('#product_sr_end_time').val();
                                if ($('#product_sr_date_filter').val()) {
                                    start = $('input#product_sr_date_filter')
                                        .data('daterangepicker')
                                        .startDate.format('YYYY-MM-DD');
                                    end = $('input#product_sr_date_filter')
                                        .data('daterangepicker')
                                        .endDate.format('YYYY-MM-DD');

                                    start = moment(start + " " + start_time, "YYYY-MM-DD" +
                                        " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                                    end = moment(end + " " + end_time, "YYYY-MM-DD" + " " +
                                        moment_time_format).format('YYYY-MM-DD HH:mm');
                                }
                                d.start_date = start;
                                d.end_date = end;
                                d.group_by = 'sub_category';
                                d.category_id = $('select#psr_filter_category_id').val();
                                d.sub_category_id = $('select#psr_filter_sub_category_id').val();
                                d.sub2_category_id = $('select#psr_filter_sub2_category_id').val();
                                d.brand_id = $('select#psr_filter_brand_id').val();
                                d.sub_brand_id = $('select#psr_filter_sub_brand_id').val();
                                d.gender_id = $('select#psr_filter_gender_id').val();
                                d.sub_gender_id = $('select#psr_filter_sub_gender_id').val();
                                d.procurement_source_id = $('select#psr_filter_procurement_source_id').val();
                                d.sub_procurement_source_id = $('select#psr_filter_sub_procurement_source_id').val();
                                d.customer_id = $('select#customer_id').val();
                                d.supplier_id = $('select#supplier_id').val();
                                d.location_id = $('select#location_id').val();
                                d.customer_group_id = $('#psr_customer_group_id').val();
                                d.show_negative_profit = $('#show_negative_profit').length && $('#show_negative_profit').is(':checked') ? 1 : 0;
                            },
                        },
                        columns: [{
                                data: 'category_name',
                                name: 'cat.name'
                            },
                            {
                                data: 'sub_category_name',
                                name: 'sub_cat.name'
                            },
                            {
                                data: 'current_stock',
                                name: 'current_stock',
                                searchable: false,
                                orderable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'total_qty_sold',
                                name: 'total_qty_sold',
                                searchable: false,
                                className: 'text-right'
                            },
                            <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                            {
                                data: 'total_foc_qty_sold',
                                name: 'total_foc_qty_sold',
                                searchable: false,
                                className: 'text-right'
                            },
                            <?php endif; ?>
                            {
                                data: 'subtotal',
                                name: 'subtotal',
                                searchable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'cost_total',
                                name: 'cost_total',
                                searchable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'profit',
                                name: 'profit',
                                searchable: false,
                                className: 'text-right'
                            },
                            { data: 'profit_percent', name: 'profit_percent', searchable: false, className: 'text-right' },
                        ],
                        fnDrawCallback: function(oSettings) {
                            $('#footer_psr_by_sub_cat_total_sell').text(
                                sum_table_col($('#product_sell_report_by_sub_category'),
                                    'row_subtotal')
                            );
                            $('#footer_psr_by_sub_cat_cost_total').text(
                                sum_table_col($('#product_sell_report_by_sub_category'),
                                    'row_cost_total')
                            );
                            $('#footer_psr_by_sub_cat_profit').text(
                                sum_table_col($('#product_sell_report_by_sub_category'),
                                    'row_profit')
                            );
                            $('#footer_psr_by_sub_cat_total_sold').html(
                                __sum_stock($('#product_sell_report_by_sub_category'),
                                    'sell_qty')
                            );
                            $('#footer_psr_by_sub_cat_total_foc_sold').html(
                                __sum_stock($('#product_sell_report_by_sub_category'),
                                    'foc_qty')
                            );

                            $('#footer_psr_by_sub_cat_total_stock').html(
                                __sum_stock($('#product_sell_report_by_sub_category'),
                                    'current_stock')
                            );
                            let gross_profit = window.productSellGrossProfitPercent($('#product_sell_report_by_sub_category'));
                            $('#footer_psr_by_sub_cat_gross_profit').html(__currency_trans_from_en(gross_profit, false) + '%');
                            __currency_convert_recursively($(
                                '#product_sell_report_by_sub_category'));
                        },
                    });
            } else {
                product_sell_report_by_sub_category_datatable.ajax.reload();
            }
        } else if (target == '#psr_by_sub2_cat_tab') {
            if (typeof product_sell_report_by_sub2_category_datatable == 'undefined') {
                product_sell_report_by_sub2_category_datatable = $('table#product_sell_report_by_sub2_category')
                    .DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/reports/product-sell-grouped-by',
                            data: function(d) {
                                var start = '';
                                var end = '';
                                var start_time = $('#product_sr_start_time').val();
                                var end_time = $('#product_sr_end_time').val();
                                if ($('#product_sr_date_filter').val()) {
                                    start = $('input#product_sr_date_filter')
                                        .data('daterangepicker')
                                        .startDate.format('YYYY-MM-DD');
                                    end = $('input#product_sr_date_filter')
                                        .data('daterangepicker')
                                        .endDate.format('YYYY-MM-DD');

                                    start = moment(start + " " + start_time, "YYYY-MM-DD" +
                                        " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                                    end = moment(end + " " + end_time, "YYYY-MM-DD" + " " +
                                        moment_time_format).format('YYYY-MM-DD HH:mm');
                                }
                                d.start_date = start;
                                d.end_date = end;
                                d.group_by = 'sub2_category';
                                d.category_id = $('select#psr_filter_category_id').val();
                                d.sub_category_id = $('select#psr_filter_sub_category_id').val();
                                d.sub2_category_id = $('select#psr_filter_sub2_category_id').val();
                                d.brand_id = $('select#psr_filter_brand_id').val();
                                d.sub_brand_id = $('select#psr_filter_sub_brand_id').val();
                                d.gender_id = $('select#psr_filter_gender_id').val();
                                d.sub_gender_id = $('select#psr_filter_sub_gender_id').val();
                                d.procurement_source_id = $('select#psr_filter_procurement_source_id').val();
                                d.sub_procurement_source_id = $('select#psr_filter_sub_procurement_source_id').val();
                                d.customer_id = $('select#customer_id').val();
                                d.supplier_id = $('select#supplier_id').val();
                                d.location_id = $('select#location_id').val();
                                d.customer_group_id = $('#psr_customer_group_id').val();
                                d.show_negative_profit = $('#show_negative_profit').length && $('#show_negative_profit').is(':checked') ? 1 : 0;
                            },
                        },
                        columns: [{
                                data: 'category_name',
                                name: 'cat.name'
                            },
                            {
                                data: 'sub_category_name',
                                name: 'sub_cat_parent.name'
                            },
                            {
                                data: 'sub2_category_name',
                                name: 'sub_cat.name'
                            },
                            {
                                data: 'current_stock',
                                name: 'current_stock',
                                searchable: false,
                                orderable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'total_qty_sold',
                                name: 'total_qty_sold',
                                searchable: false,
                                className: 'text-right'
                            },
                            <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                            {
                                data: 'total_foc_qty_sold',
                                name: 'total_foc_qty_sold',
                                searchable: false,
                                className: 'text-right'
                            },
                            <?php endif; ?>
                            {
                                data: 'subtotal',
                                name: 'subtotal',
                                searchable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'cost_total',
                                name: 'cost_total',
                                searchable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'profit',
                                name: 'profit',
                                searchable: false,
                                className: 'text-right'
                            },
                            { data: 'profit_percent', name: 'profit_percent', searchable: false, className: 'text-right' },
                        ],
                        fnDrawCallback: function(oSettings) {
                            $('#footer_psr_by_sub2_cat_total_sell').text(
                                sum_table_col($('#product_sell_report_by_sub2_category'),
                                    'row_subtotal')
                            );
                            $('#footer_psr_by_sub2_cat_cost_total').text(
                                sum_table_col($('#product_sell_report_by_sub2_category'),
                                    'row_cost_total')
                            );
                            $('#footer_psr_by_sub2_cat_profit').text(
                                sum_table_col($('#product_sell_report_by_sub2_category'),
                                    'row_profit')
                            );
                            $('#footer_psr_by_sub2_cat_total_sold').html(
                                __sum_stock($('#product_sell_report_by_sub2_category'),
                                    'sell_qty')
                            );
                            $('#footer_psr_by_sub2_cat_total_foc_sold').html(
                                __sum_stock($('#product_sell_report_by_sub2_category'),
                                    'foc_qty')
                            );

                            $('#footer_psr_by_sub2_cat_total_stock').html(
                                __sum_stock($('#product_sell_report_by_sub2_category'),
                                    'current_stock')
                            );
                            let gross_profit = window.productSellGrossProfitPercent($('#product_sell_report_by_sub2_category'));
                            $('#footer_psr_by_sub2_cat_gross_profit').html(__currency_trans_from_en(gross_profit, false) + '%');
                            __currency_convert_recursively($(
                                '#product_sell_report_by_sub2_category'));
                        },
                    });
            } else {
                product_sell_report_by_sub2_category_datatable.ajax.reload();
            }
        } else if (target == '#psr_by_brand_tab') {
            if (typeof product_sell_report_by_brand_datatable == 'undefined') {
                product_sell_report_by_brand_datatable = $('table#product_sell_report_by_brand')
                    .DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/reports/product-sell-grouped-by',
                            data: function(d) {
                                var start = '';
                                var end = '';
                                var start_time = $('#product_sr_start_time').val();
                                var end_time = $('#product_sr_end_time').val();
                                if ($('#product_sr_date_filter').val()) {
                                    start = $('input#product_sr_date_filter')
                                        .data('daterangepicker')
                                        .startDate.format('YYYY-MM-DD');
                                    end = $('input#product_sr_date_filter')
                                        .data('daterangepicker')
                                        .endDate.format('YYYY-MM-DD');

                                    start = moment(start + " " + start_time, "YYYY-MM-DD" +
                                        " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                                    end = moment(end + " " + end_time, "YYYY-MM-DD" + " " +
                                        moment_time_format).format('YYYY-MM-DD HH:mm');
                                }
                                d.start_date = start;
                                d.end_date = end;
                                d.group_by = 'brand';
                                d.category_id = $('select#psr_filter_category_id').val();
                                d.sub_category_id = $('select#psr_filter_sub_category_id').val();
                                d.sub2_category_id = $('select#psr_filter_sub2_category_id').val();
                                d.brand_id = $('select#psr_filter_brand_id').val();
                                d.sub_brand_id = $('select#psr_filter_sub_brand_id').val();
                                d.gender_id = $('select#psr_filter_gender_id').val();
                                d.sub_gender_id = $('select#psr_filter_sub_gender_id').val();
                                d.procurement_source_id = $('select#psr_filter_procurement_source_id').val();
                                d.sub_procurement_source_id = $('select#psr_filter_sub_procurement_source_id').val();
                                d.customer_id = $('select#customer_id').val();
                                d.supplier_id = $('select#supplier_id').val();
                                d.location_id = $('select#location_id').val();
                                d.customer_group_id = $('#psr_customer_group_id').val();
                                d.show_negative_profit = $('#show_negative_profit').length && $('#show_negative_profit').is(':checked') ? 1 : 0;
                            },
                        },
                        columns: [{
                                data: 'brand_name',
                                name: 'b.name'
                            },
                            {
                                data: 'current_stock',
                                name: 'current_stock',
                                searchable: false,
                                orderable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'total_qty_sold',
                                name: 'total_qty_sold',
                                searchable: false,
                                className: 'text-right'
                            },
                            <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                            {
                                data: 'total_foc_qty_sold',
                                name: 'total_foc_qty_sold',
                                searchable: false,
                                className: 'text-right'
                            },
                            <?php endif; ?>
                            {
                                data: 'subtotal',
                                name: 'subtotal',
                                searchable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'cost_total',
                                name: 'cost_total',
                                searchable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'profit',
                                name: 'profit',
                                searchable: false,
                                className: 'text-right'
                            },
                            { data: 'profit_percent', name: 'profit_percent', searchable: false, className: 'text-right' },
                        ],
                        fnDrawCallback: function(oSettings) {
                            $('#footer_psr_by_brand_total_sell').text(
                                sum_table_col($('#product_sell_report_by_brand'),
                                    'row_subtotal')
                            );
                            $('#footer_psr_by_brand_cost_total').text(
                                sum_table_col($('#product_sell_report_by_brand'),
                                    'row_cost_total')
                            );
                            $('#footer_psr_by_brand_profit').text(
                                sum_table_col($('#product_sell_report_by_brand'),
                                    'row_profit')
                            );
                            $('#footer_psr_by_brand_total_sold').html(
                                __sum_stock($('#product_sell_report_by_brand'), 'sell_qty')
                            );
                            $('#footer_psr_by_brand_total_foc_sold').html(
                                __sum_stock($('#product_sell_report_by_brand'), 'foc_qty')
                            );

                            $('#footer_psr_by_cat_total_stock').html(
                                __sum_stock($('#product_sell_report_by_brand'),
                                    'current_stock')
                            );
                            let gross_profit = window.productSellGrossProfitPercent($('#product_sell_report_by_brand'));
                            $('#footer_psr_by_brand_gross_profit').html(__currency_trans_from_en(gross_profit, false) + '%');
                            __currency_convert_recursively($('#product_sell_report_by_brand'));
                        },
                    });
            } else {
                product_sell_report_by_brand_datatable.ajax.reload();
            }
        } else if (target == '#psr_by_gender_tab') {
            if (typeof product_sell_report_by_gender_datatable == 'undefined') {
                product_sell_report_by_gender_datatable = $('table#product_sell_report_by_gender')
                    .DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/reports/product-sell-grouped-by',
                            data: function(d) {
                                var start = '';
                                var end = '';
                                var start_time = $('#product_sr_start_time').val();
                                var end_time = $('#product_sr_end_time').val();
                                if ($('#product_sr_date_filter').val()) {
                                    start = $('input#product_sr_date_filter')
                                        .data('daterangepicker')
                                        .startDate.format('YYYY-MM-DD');
                                    end = $('input#product_sr_date_filter')
                                        .data('daterangepicker')
                                        .endDate.format('YYYY-MM-DD');

                                    start = moment(start + " " + start_time, "YYYY-MM-DD" +
                                        " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                                    end = moment(end + " " + end_time, "YYYY-MM-DD" + " " +
                                        moment_time_format).format('YYYY-MM-DD HH:mm');
                                }
                                d.start_date = start;
                                d.end_date = end;
                                d.group_by = 'gender';
                                d.category_id = $('select#psr_filter_category_id').val();
                                d.sub_category_id = $('select#psr_filter_sub_category_id').val();
                                d.sub2_category_id = $('select#psr_filter_sub2_category_id').val();
                                d.brand_id = $('select#psr_filter_brand_id').val();
                                d.sub_brand_id = $('select#psr_filter_sub_brand_id').val();
                                d.gender_id = $('select#psr_filter_gender_id').val();
                                d.sub_gender_id = $('select#psr_filter_sub_gender_id').val();
                                d.procurement_source_id = $('select#psr_filter_procurement_source_id').val();
                                d.sub_procurement_source_id = $('select#psr_filter_sub_procurement_source_id').val();
                                d.customer_id = $('select#customer_id').val();
                                d.supplier_id = $('select#supplier_id').val();
                                d.location_id = $('select#location_id').val();
                                d.customer_group_id = $('#psr_customer_group_id').val();
                                d.show_negative_profit = $('#show_negative_profit').length && $('#show_negative_profit').is(':checked') ? 1 : 0;
                            },
                        },
                        columns: [{
                                data: 'gender_name',
                                name: 'genders.name'
                            },
                            {
                                data: 'current_stock',
                                name: 'current_stock',
                                searchable: false,
                                orderable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'total_qty_sold',
                                name: 'total_qty_sold',
                                searchable: false,
                                className: 'text-right'
                            },
                            <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                            {
                                data: 'total_foc_qty_sold',
                                name: 'total_foc_qty_sold',
                                searchable: false,
                                className: 'text-right'
                            },
                            <?php endif; ?>
                            {
                                data: 'subtotal',
                                name: 'subtotal',
                                searchable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'cost_total',
                                name: 'cost_total',
                                searchable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'profit',
                                name: 'profit',
                                searchable: false,
                                className: 'text-right'
                            },
                            { data: 'profit_percent', name: 'profit_percent', searchable: false, className: 'text-right' },
                        ],
                        fnDrawCallback: function(oSettings) {
                            $('#footer_psr_by_gender_total_sell').text(
                                sum_table_col($('#product_sell_report_by_gender'),
                                    'row_subtotal')
                            );
                            $('#footer_psr_by_gender_cost_total').text(
                                sum_table_col($('#product_sell_report_by_gender'),
                                    'row_cost_total')
                            );
                            $('#footer_psr_by_gender_profit').text(
                                sum_table_col($('#product_sell_report_by_gender'),
                                    'row_profit')
                            );
                            $('#footer_psr_by_gender_total_sold').html(
                                __sum_stock($('#product_sell_report_by_gender'), 'sell_qty')
                            );
                            $('#footer_psr_by_gender_total_foc_sold').html(
                                __sum_stock($('#product_sell_report_by_gender'), 'foc_qty')
                            );

                            $('#footer_psr_by_gender_total_stock').html(
                                __sum_stock($('#product_sell_report_by_gender'),
                                    'current_stock')
                            );
                            let gross_profit = window.productSellGrossProfitPercent($('#product_sell_report_by_gender'));
                            $('#footer_psr_by_gender_gross_profit').html(__currency_trans_from_en(gross_profit, false) + '%');
                            __currency_convert_recursively($('#product_sell_report_by_gender'));
                        },
                    });
            } else {
                product_sell_report_by_gender_datatable.ajax.reload();
            }
        } else if (target == '#psr_by_procurement_source_tab') {
            if (typeof product_sell_report_by_procurement_source_datatable == 'undefined') {
                product_sell_report_by_procurement_source_datatable = $('table#product_sell_report_by_procurement_source')
                    .DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/reports/product-sell-grouped-by',
                            data: function(d) {
                                var start = '';
                                var end = '';
                                var start_time = $('#product_sr_start_time').val();
                                var end_time = $('#product_sr_end_time').val();
                                if ($('#product_sr_date_filter').val()) {
                                    start = $('input#product_sr_date_filter')
                                        .data('daterangepicker')
                                        .startDate.format('YYYY-MM-DD');
                                    end = $('input#product_sr_date_filter')
                                        .data('daterangepicker')
                                        .endDate.format('YYYY-MM-DD');

                                    start = moment(start + " " + start_time, "YYYY-MM-DD" +
                                        " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                                    end = moment(end + " " + end_time, "YYYY-MM-DD" + " " +
                                        moment_time_format).format('YYYY-MM-DD HH:mm');
                                }
                                d.start_date = start;
                                d.end_date = end;
                                d.group_by = 'procurement_source';
                                d.category_id = $('select#psr_filter_category_id').val();
                                d.sub_category_id = $('select#psr_filter_sub_category_id').val();
                                d.sub2_category_id = $('select#psr_filter_sub2_category_id').val();
                                d.brand_id = $('select#psr_filter_brand_id').val();
                                d.sub_brand_id = $('select#psr_filter_sub_brand_id').val();
                                d.gender_id = $('select#psr_filter_gender_id').val();
                                d.sub_gender_id = $('select#psr_filter_sub_gender_id').val();
                                d.procurement_source_id = $('select#psr_filter_procurement_source_id').val();
                                d.sub_procurement_source_id = $('select#psr_filter_sub_procurement_source_id').val();
                                d.customer_id = $('select#customer_id').val();
                                d.supplier_id = $('select#supplier_id').val();
                                d.location_id = $('select#location_id').val();
                                d.customer_group_id = $('#psr_customer_group_id').val();
                                d.show_negative_profit = $('#show_negative_profit').length && $('#show_negative_profit').is(':checked') ? 1 : 0;
                            },
                        },
                        columns: [{
                                data: 'procurement_source_name',
                                name: 'procurement_sources.name'
                            },
                            {
                                data: 'current_stock',
                                name: 'current_stock',
                                searchable: false,
                                orderable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'total_qty_sold',
                                name: 'total_qty_sold',
                                searchable: false,
                                className: 'text-right'
                            },
                            <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                            {
                                data: 'total_foc_qty_sold',
                                name: 'total_foc_qty_sold',
                                searchable: false,
                                className: 'text-right'
                            },
                            <?php endif; ?>
                            {
                                data: 'subtotal',
                                name: 'subtotal',
                                searchable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'cost_total',
                                name: 'cost_total',
                                searchable: false,
                                className: 'text-right'
                            },
                            {
                                data: 'profit',
                                name: 'profit',
                                searchable: false,
                                className: 'text-right'
                            },
                            { data: 'profit_percent', name: 'profit_percent', searchable: false, className: 'text-right' },
                        ],
                        fnDrawCallback: function(oSettings) {
                            $('#footer_psr_by_procurement_source_total_sell').text(
                                sum_table_col($('#product_sell_report_by_procurement_source'),
                                    'row_subtotal')
                            );
                            $('#footer_psr_by_procurement_source_cost_total').text(
                                sum_table_col($('#product_sell_report_by_procurement_source'),
                                    'row_cost_total')
                            );
                            $('#footer_psr_by_procurement_source_profit').text(
                                sum_table_col($('#product_sell_report_by_procurement_source'),
                                    'row_profit')
                            );
                            $('#footer_psr_by_procurement_source_total_sold').html(
                                __sum_stock($('#product_sell_report_by_procurement_source'), 'sell_qty')
                            );
                            $('#footer_psr_by_procurement_source_total_foc_sold').html(
                                __sum_stock($('#product_sell_report_by_procurement_source'), 'foc_qty')
                            );

                            $('#footer_psr_by_procurement_source_total_stock').html(
                                __sum_stock($('#product_sell_report_by_procurement_source'),
                                    'current_stock')
                            );
                            let gross_profit = window.productSellGrossProfitPercent($('#product_sell_report_by_procurement_source'));
                            $('#footer_psr_by_procurement_source_gross_profit').html(__currency_trans_from_en(gross_profit, false) + '%');
                            __currency_convert_recursively($('#product_sell_report_by_procurement_source'));
                        },
                    });
            } else {
                product_sell_report_by_procurement_source_datatable.ajax.reload();
            }
        }
        if (typeof product_sell_report_by_category_datatable !== 'undefined') {
            applyProductSellReportPermissionColumns(product_sell_report_by_category_datatable);
        }
        if (typeof product_sell_report_by_sub_category_datatable !== 'undefined') {
            applyProductSellReportPermissionColumns(product_sell_report_by_sub_category_datatable);
        }
        if (typeof product_sell_report_by_sub2_category_datatable !== 'undefined') {
            applyProductSellReportPermissionColumns(product_sell_report_by_sub2_category_datatable);
        }
        if (typeof product_sell_report_by_brand_datatable !== 'undefined') {
            applyProductSellReportPermissionColumns(product_sell_report_by_brand_datatable);
        }
        if (typeof product_sell_report_by_gender_datatable !== 'undefined') {
            applyProductSellReportPermissionColumns(product_sell_report_by_gender_datatable);
        }
        if (typeof product_sell_report_by_procurement_source_datatable !== 'undefined') {
            applyProductSellReportPermissionColumns(product_sell_report_by_procurement_source_datatable);
        }
    });
});

$(document).ready(function(){
    <?php if(!empty($user_settings['rpt_sales_psell_hide_sku'])): ?>
        product_sell_report_summary.column('v.sub_sku:name').visible(false);
        product_sell_report.column('v.sub_sku:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_psell_hide_product'])): ?>
        product_sell_report_summary.column('p.name:name').visible(false);
        product_sell_report.column('p.name:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_psell_hide_qty'])): ?>
        product_sell_report_summary.column('transaction_sell_lines.quantity:name').visible(false);
        product_sell_report.column('transaction_sell_lines.quantity:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_psell_hide_avg_product'])): ?>
        product_sell_report_summary.column('average_product:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_psell_hide_scheme_qty'])): ?>
        product_sell_report_summary.column('transaction_sell_lines.foc_quantity:name').visible(false);
        product_sell_report.column('transaction_sell_lines.foc_quantity:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_psell_hide_total'])): ?>
        product_sell_report_summary.column('subtotal:name').visible(false);
        product_sell_report.column('subtotal:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_psell_hide_total_purchase'])): ?>
        product_sell_report_summary.column('cost_total:name').visible(false);
        product_sell_report.column('cost_total:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_psell_hide_profit'])): ?>
        product_sell_report_summary.column('profit:name').visible(false);
        product_sell_report.column('profit:name').visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_sales_psell_hide_gross_profit'])): ?>
        product_sell_report_summary.column('profit_percent:name').visible(false);
        product_sell_report.column('profit_percent:name').visible(false);
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>