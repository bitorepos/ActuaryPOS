
<?php $__env->startSection('title', __('report.customer') . ' - ' . __('report.supplier') . ' ' . __('report.reports')); ?>
<?php
    $user_settings = json_decode(auth()->user()->user_settings, true);
    $common_settings = isset($common_settings) && is_array($common_settings) ? $common_settings : [];
    $show_ledger_discount = empty($common_settings['disable_ledger_discount']);
    $show_ledger_discount2 = !empty($common_settings['enable_ledger_discount2']);
    $show_ledger_discount3 = !empty($common_settings['enable_ledger_discount3']);
    $ledger_discount_label = !empty($common_settings['ledger_discount_label']) ? $common_settings['ledger_discount_label'] : __('lang_v1.ledger_discount');
    $ledger_discount2_label = !empty($common_settings['ledger_discount2_label']) ? $common_settings['ledger_discount2_label'] : __('lang_v1.ledger_discounts2');
    $ledger_discount3_label = !empty($common_settings['ledger_discount3_label']) ? $common_settings['ledger_discount3_label'] : __('lang_v1.ledger_discounts3');
?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_customer_supplier_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('report.supplier'), false); ?> & <?php echo e(__('report.customer'), false); ?> <?php echo e(__('report.reports'), false); ?></h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>

                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('cs_report_location_id', __( 'sale.location' ) . ':'); ?>

                        <?php echo Form::select('cs_report_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'cs_report_location_id']); ?>

                    </div>
                </div>

                

                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('type', __( 'lang_v1.type' ) . ':'); ?>

                        <?php echo Form::select('contact_type', $types, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'contact_type']); ?>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('scr_contact_id', __( 'report.contact' ) . ':'); ?>

                        <?php echo Form::select('scr_contact_id', $contact_dropdown, null , ['class' => 'form-control select2', 'style' => 'width:100%',  'id' => 'scr_contact_id', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('scr_date_filter', __('report.date_range') . ':'); ?>

                        <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'scr_date_filter', 'readonly']); ?>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('cg_customer_group_id', __( 'lang_v1.customer_group_name' ) . ':'); ?>

                        <?php echo Form::select('cnt_customer_group_id', $customer_group, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'cnt_customer_group_id']); ?>

                    </div>
                </div>
                <div class="col-md-3 hide">
                    <div class="mb-3">
                        <?php echo Form::label('payment_status', __( 'sale.payment_status' ) . ':'); ?>

                        <?php echo Form::select('payment_statuss', ['all'=>'All', 'due'=>'Due', 'paid'=>'Paid'], 'all', ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'payment_status']); ?>

                    </div>
                </div>
                
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="text-end mb-2">
                <button type="button" class="btn btn-primary open-contact-report-print">
                    <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="supplier_report_tbl">
                    <thead>
                        <tr>
                            <th id="scr_contact_id_col"><?php echo app('translator')->get('lang_v1.contact_id'); ?></th>
                            <th id="scr_contact_col"><?php echo app('translator')->get('report.contact'); ?></th>
                            <th id="scr_total_purchase_col"><?php echo app('translator')->get('report.total_purchase'); ?></th>
                            <th id="scr_total_purchase_return_col"><?php echo app('translator')->get('lang_v1.total_purchase_return'); ?></th>
                            <th id="scr_total_sell_col"><?php echo app('translator')->get('report.total_sell'); ?></th>
                            <th id="scr_total_sell_return_col"><?php echo app('translator')->get('lang_v1.total_sell_return'); ?></th>
                            <th id="scr_opening_balance_due_col"><?php echo app('translator')->get('lang_v1.opening_balance_due'); ?></th>
                            <?php if($show_ledger_discount): ?>
                                <th id="scr_ledger_discount_col"><?php echo e($ledger_discount_label, false); ?></th>
                            <?php endif; ?>
                            <?php if($show_ledger_discount2): ?>
                                <th id="scr_ledger_discount2_col"><?php echo e($ledger_discount2_label, false); ?></th>
                            <?php endif; ?>
                            <?php if($show_ledger_discount3): ?>
                                <th id="scr_ledger_discount3_col"><?php echo e($ledger_discount3_label, false); ?></th>
                            <?php endif; ?>
                            <th id="scr_advance_balance_col"><?php echo app('translator')->get('lang_v1.advance_balance'); ?></th>
                            <th id="scr_total_due_col"><?php echo app('translator')->get('report.total_due'); ?> &nbsp;&nbsp;<i class="fa fa-info-circle text-info no-print" data-bs-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="<?php echo e(__('messages.due_tooltip'), false); ?>" aria-hidden="true"></i></th>
                            <th id="scr_contact_type_col"><?php echo app('translator')->get('contact.contact_type'); ?></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-gray font-17 footer-total text-center">
                            <td></td>
                            <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                            <td><span class="display_currency" id="footer_total_purchase" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_purchase_return" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_sell" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_sell_return" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_opening_bal_due" data-currency_symbol ="true"></span></td>
                            <?php if($show_ledger_discount): ?>
                                <td><span class="display_currency" id="footer_total_ledger_discount" data-currency_symbol ="true"></span></td>
                            <?php endif; ?>
                            <?php if($show_ledger_discount2): ?>
                                <td><span class="display_currency" id="footer_total_ledger_discount2" data-currency_symbol ="true"></span></td>
                            <?php endif; ?>
                            <?php if($show_ledger_discount3): ?>
                                <td><span class="display_currency" id="footer_total_ledger_discount3" data-currency_symbol ="true"></span></td>
                            <?php endif; ?>
                            <td><span class="display_currency" id="footer_total_advance_deposit" data-currency_symbol ="true"></span></td>
                            <td><span class="display_currency" id="footer_total_due" data-currency_symbol ="true"></span></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
    <script>
    $(document).ready(function(){
        function getContactReportPrintParams() {
            var params = {
                customer_group_id: $('#cnt_customer_group_id').val(),
                contact_type: $('#contact_type').val(),
                location_id: $('#cs_report_location_id').val(),
                contact_id: $('#scr_contact_id').val()
            };

            if ($('input#scr_date_filter').val() && $('input#scr_date_filter').data('daterangepicker')) {
                params.start_date = $('input#scr_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                params.end_date = $('input#scr_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
            }

            $.each(params, function(key, value) {
                if (value === null || value === '') {
                    delete params[key];
                }
            });

            return $.param(params);
        }

        $(document).on('click', '.open-contact-report-print', function() {
            window.open("<?php echo e(url('reports/customer-supplier-print'), false); ?>?" + getContactReportPrintParams(), '_blank');
        });

        function hideSupplierReportColumn(columnHeaderId) {
            var columnIndex = $('#supplier_report_tbl thead th#' + columnHeaderId).index();
            if (columnIndex >= 0) {
                supplier_report_tbl.column(columnIndex).visible(false);
            }
        }

        <?php if(!empty($user_settings['rpt_gen_contact_hide_contact_id'])): ?>
            hideSupplierReportColumn('scr_contact_id_col');
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_gen_contact_hide_contact'])): ?>
            hideSupplierReportColumn('scr_contact_col');
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_gen_contact_hide_total_purchase'])): ?>
            hideSupplierReportColumn('scr_total_purchase_col');
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_gen_contact_hide_total_purchase_return'])): ?>
            hideSupplierReportColumn('scr_total_purchase_return_col');
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_gen_contact_hide_total_sell'])): ?>
            hideSupplierReportColumn('scr_total_sell_col');
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_gen_contact_hide_total_sell_return'])): ?>
            hideSupplierReportColumn('scr_total_sell_return_col');
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_gen_contact_hide_opening_balance_due'])): ?>
            hideSupplierReportColumn('scr_opening_balance_due_col');
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_gen_contact_hide_ledger_discount'])): ?>
            hideSupplierReportColumn('scr_ledger_discount_col');
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_gen_contact_hide_advance_balance'])): ?>
            hideSupplierReportColumn('scr_advance_balance_col');
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_gen_contact_hide_total_due'])): ?>
            hideSupplierReportColumn('scr_total_due_col');
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_gen_contact_hide_contact_type'])): ?>
            hideSupplierReportColumn('scr_contact_type_col');
        <?php endif; ?>
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>