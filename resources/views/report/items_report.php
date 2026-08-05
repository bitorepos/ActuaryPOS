
<?php $__env->startSection('title', __('lang_v1.items_report')); ?>
<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_items_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('lang_v1.items_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('ir_location_id', __('purchase.business_location').':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <?php echo Form::select('ir_location_id', $business_locations, null, ['class' => 'form-control
                        select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width:80%']); ?>

                    </div>
                </div>
            </div>
            <?php if(Module::has('Manufacturing')): ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <br>
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('only_mfg', 1, false,
                            [ 'class' => 'form-check-input', 'id' => 'only_mfg_products']); ?>

                            <?php echo e(__('manufacturing::lang.only_mfg_products'), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="clearfix"></div>

            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('ir_supplier_id', __('purchase.supplier') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('ir_supplier_id', $suppliers, null, ['class' => 'form-control select2',
                        'placeholder' => __('lang_v1.all'), 'style' => 'width:80%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('ir_purchase_date_filter', __('purchase.purchase_date') . ':'); ?>

                    <?php echo Form::text('ir_purchase_date_filter', null, ['placeholder' => __('lang_v1.select_a_date_range'),
                    'class' => 'form-control', 'readonly']); ?>

                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('ir_customer_id', __('contact.customer') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('ir_customer_id', $customers, null, ['class' => 'form-control select2',
                        'placeholder' => __('lang_v1.all'), 'style' => 'width:80%']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('ir_sale_date_filter', __('lang_v1.sell_date') . ':'); ?>

                    <?php echo Form::text('ir_sale_date_filter', null, ['placeholder' => __('lang_v1.select_a_date_range'),
                    'class' => 'form-control', 'readonly']); ?>

                </div>
            </div>
            
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="text-end mb-2">
                <button type="button" id="print_items_report" class="btn btn-primary">
                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="items_report_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('product.sku'); ?></th>
                            <th style="width:350px"><?php echo app('translator')->get('sale.product'); ?></th>
                            <th style="width:550px"><?php echo app('translator')->get('lang_v1.description'); ?></th>
                            <th><?php echo app('translator')->get('purchase.purchase_date'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.purchase'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.lot_number'); ?></th>
                            <th style="width:350px"><?php echo app('translator')->get('purchase.supplier'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.purchase_price'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                            <th><?php echo app('translator')->get('lang_v1.sell_date'); ?></th>
                            <th><?php echo app('translator')->get('business.sale'); ?></th>
                            <th style="width:350px"><?php echo app('translator')->get('contact.customer'); ?></th>
                            <th><?php echo app('translator')->get('sale.location'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.sell_quantity'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.selling_price'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                            <th><?php echo app('translator')->get('sale.subtotal'); ?> (<?php echo e(session('currency')['symbol'], false); ?>)</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-gray font-17 text-center footer-total">
                            <td colspan="7"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                            <td id="footer_total_pp" class="display_currency text-right" data-currency_symbol="true"></td>
                            <td colspan="4"></td>
                            <td id="footer_total_qty" class="text-right"></td>
                            <td id="footer_total_sp" class="display_currency text-right" data-currency_symbol="true"></td>
                            <td id="footer_total_subtotal" class="display_currency text-right" data-currency_symbol="true"></td>
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
    function getItemsReportPrintParams() {
        var purchase_start = '';
        var purchase_end = '';
        if ($('#ir_purchase_date_filter').val()) {
            purchase_start = $('input#ir_purchase_date_filter')
                .data('daterangepicker')
                .startDate.format('YYYY-MM-DD');
            purchase_end = $('input#ir_purchase_date_filter')
                .data('daterangepicker')
                .endDate.format('YYYY-MM-DD');
        }

        var sale_start = '';
        var sale_end = '';
        if ($('#ir_sale_date_filter').val()) {
            sale_start = $('input#ir_sale_date_filter')
                .data('daterangepicker')
                .startDate.format('YYYY-MM-DD');
            sale_end = $('input#ir_sale_date_filter')
                .data('daterangepicker')
                .endDate.format('YYYY-MM-DD');
        }

        return $.param({
            purchase_start: purchase_start,
            purchase_end: purchase_end,
            sale_start: sale_start,
            sale_end: sale_end,
            supplier_id: $('select#ir_supplier_id').val(),
            customer_id: $('select#ir_customer_id').val(),
            location_id: $('select#ir_location_id').val(),
            only_mfg_products: $('#only_mfg_products').length && $('#only_mfg_products').is(':checked') ? 1 : 0
        });
    }

    $(document).on('click', '#print_items_report', function() {
        window.open("<?php echo e(url('reports/items-report-print'), false); ?>?" + getItemsReportPrintParams(), '_blank');
    });

    <?php if(!empty($user_settings['rpt_gen_items_hide_sku'])): ?>
        items_report_table.column(0).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_gen_items_hide_product'])): ?>
        items_report_table.column(1).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_gen_items_hide_description'])): ?>
        items_report_table.column(2).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_gen_items_hide_purchase_date'])): ?>
        items_report_table.column(3).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_gen_items_hide_purchase'])): ?>
        items_report_table.column(4).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_gen_items_hide_lot_number'])): ?>
        items_report_table.column(5).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_gen_items_hide_supplier'])): ?>
        items_report_table.column(6).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_gen_items_hide_purchase_price'])): ?>
        items_report_table.column(7).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_gen_items_hide_sell_date'])): ?>
        items_report_table.column(8).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_gen_items_hide_sale'])): ?>
        items_report_table.column(9).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_gen_items_hide_customer'])): ?>
        items_report_table.column(10).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_gen_items_hide_location'])): ?>
        items_report_table.column(11).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_gen_items_hide_sell_qty'])): ?>
        items_report_table.column(12).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_gen_items_hide_selling_price'])): ?>
        items_report_table.column(13).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_gen_items_hide_subtotal'])): ?>
        items_report_table.column(14).visible(false);
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>