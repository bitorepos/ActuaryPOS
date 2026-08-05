<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>

<?php $__env->startSection('title', __('report.register_report')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('report.register_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
              <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getStockReport']), 'method' => 'get', 'class' => 'row','id' => 'register_report_filter_form' ]); ?>

                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('register_location_id',  __('purchase.business_location') . ':'); ?>

                        <?php echo Form::select('register_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('register_user_id',  __('report.user') . ':'); ?>

                        <?php echo Form::select('register_user_id', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('report.all_users')]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('register_status',  __('sale.status') . ':'); ?>

                        <?php echo Form::select('register_status', ['open' => __('cash_register.open'), 'close' => __('cash_register.close')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('report.all')]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('register_report_date_range', __('report.date_range') . ':'); ?>

                        <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_register_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo Form::text('register_report_date_range', null , ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'register_report_date_range', 'readonly']); ?>

                    </div>
                </div>
                <?php echo Form::close(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="register_report_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('messages.action'); ?></th>
                            <th><?php echo app('translator')->get('purchase.ref_no_short'); ?></th>
                            <th><?php echo app('translator')->get('report.open_time'); ?></th>
                            <th><?php echo app('translator')->get('report.close_time'); ?></th>
                            <th><?php echo app('translator')->get('sale.location'); ?></th>
                            <th><?php echo app('translator')->get('report.user'); ?></th>
                            <th class="text-right"><?php echo app('translator')->get('cash_register.total_card_slips'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                            <th class="text-right"><?php echo app('translator')->get('cash_register.total_cheques'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                            <th class="text-right"><?php echo app('translator')->get('cash_register.total_cash'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                            <th class="text-right"><?php echo app('translator')->get('lang_v1.total_bank_transfer'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                            <th class="text-right"><?php echo app('translator')->get('lang_v1.total_advance_payment'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                            <th class="text-right"><?php echo e($payment_types['custom_pay_1'], false); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                            <th class="text-right"><?php echo e($payment_types['custom_pay_2'], false); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                            <th class="text-right"><?php echo e($payment_types['custom_pay_3'], false); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                            <th class="text-right"><?php echo e($payment_types['custom_pay_4'], false); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                            <th class="text-right"><?php echo e($payment_types['custom_pay_5'], false); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                            <th class="text-right"><?php echo e($payment_types['custom_pay_6'], false); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                            <th class="text-right"><?php echo e($payment_types['custom_pay_7'], false); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                            <th class="text-right"><?php echo app('translator')->get('cash_register.other_payments'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                            <th class="text-right"><?php echo app('translator')->get('sale.total'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-gray font-17 text-center footer-total">
                            <td></td>
                            <td colspan="5"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                            <td class="footer_total_card_payment text-right"></td>
                            <td class="footer_total_cheque_payment text-right"></td>
                            <td class="footer_total_cash_payment text-right"></td>
                            <td class="footer_total_bank_transfer_payment text-right"></td>
                            <td class="footer_total_advance_payment text-right"></td>
                            <td class="footer_total_custom_pay_1 text-right"></td>
                            <td class="footer_total_custom_pay_2 text-right"></td>
                            <td class="footer_total_custom_pay_3 text-right"></td>
                            <td class="footer_total_custom_pay_4 text-right"></td>
                            <td class="footer_total_custom_pay_5 text-right"></td>
                            <td class="footer_total_custom_pay_6 text-right"></td>
                            <td class="footer_total_custom_pay_7 text-right"></td>
                            <td class="footer_total_other_payments text-right"></td>
                            <td class="footer_total text-right"></td>
                        </tr>
                    </tfoot>
                </table>
</div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<!-- /.content -->
<div class="modal fade view_register" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
    <script>
    $(document).ready(function(){
        <?php if(!empty($user_settings['rpt_pos_reg_hide_ref_no'])): ?>
            register_report_table.column(1).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_pos_reg_hide_open_time'])): ?>
            register_report_table.column(2).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_pos_reg_hide_close_time'])): ?>
            register_report_table.column(3).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_pos_reg_hide_location'])): ?>
            register_report_table.column(4).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_pos_reg_hide_user'])): ?>
            register_report_table.column(5).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_pos_reg_hide_total_card_slips'])): ?>
            register_report_table.column(6).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_pos_reg_hide_total_cheques'])): ?>
            register_report_table.column(7).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_pos_reg_hide_total_cash'])): ?>
            register_report_table.column(8).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_pos_reg_hide_total_bank_transfer'])): ?>
            register_report_table.column(9).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_pos_reg_hide_total_advance_payment'])): ?>
            register_report_table.column(10).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_pos_reg_hide_other_payments'])): ?>
            register_report_table.column(18).visible(false);
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_pos_reg_hide_total'])): ?>
            register_report_table.column(19).visible(false);
        <?php endif; ?>
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>