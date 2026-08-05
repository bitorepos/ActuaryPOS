<?php $user_settings = json_decode(auth()->user()->user_settings, true) ?? []; ?>

<?php $__env->startSection('title', __( 'report.purchase_sell' )); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'report.purchase_sell' ); ?>
        <small><?php echo app('translator')->get( 'report.purchase_sell_msg' ); ?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="print_section"><h2><?php echo e(session()->get('business.name'), false); ?> - <?php echo app('translator')->get( 'report.purchase_sell' ); ?></h2></div>
    <div class="row no-print">
        <div class="col-md-3 offset-md-7 col-6">
            <div class="input-group">
                <span class="input-group-text bg-light-blue"><i class="fa fa-map-marker"></i></span>
                 <select class="form-control select2" id="purchase_sell_location_filter" style="width: 80%">
                    <?php $__currentLoopData = $business_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>"><?php echo e($value, false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="col-md-2 col-sm-6">
            <div class="form-group mb-2 float-end">
                <div class="input-group">
                  <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_purchase_sell_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <button type="button" class="btn btn-primary" id="purchase_sell_date_filter">
                    <span>
                      <i class="fa fa-calendar"></i> <?php echo e(__('messages.filter_by_date'), false); ?>

                    </span>
                    <i class="fa fa-caret-down"></i>
                  </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row no-print">
        <div class="col-sm-12">
            <button type="button" class="btn btn-primary float-end" id="purchase_sell_print_btn" aria-label="Print">
                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
            </button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <?php $__env->startComponent('components.widget', ['title' => __('purchase.purchases')]); ?>
                <table class="table table-striped">
                    <?php if(empty($user_settings['rpt_admin_ps_hide_purchase_exc_tax'])): ?>
                    <tr>
                        <th><?php echo e(__('report.purchase_exc_tax'), false); ?>:</th>
                        <td>
                            <span class="total_purchase">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php if(empty($user_settings['rpt_admin_ps_hide_purchase_inc_tax'])): ?>
                    <tr>
                        <th><?php echo e(__('report.purchase_inc_tax'), false); ?>:</th>
                        <td>
                             <span class="purchase_inc_tax">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php if(empty($user_settings['rpt_admin_ps_hide_purchase_return_inc_tax'])): ?>
                    <tr>
                        <th><?php echo e(__('lang_v1.total_purchase_return_inc_tax'), false); ?>:</th>
                        <td>
                             <span class="purchase_return_inc_tax">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php if(empty($user_settings['rpt_admin_ps_hide_purchase_due'])): ?>
                    <tr>
                        <th><?php echo e(__('report.purchase_due'), false); ?>: <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.purchase_due') . '"></i>';
                }
            ?></th>
                        <td>
                             <span class="purchase_due">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                    <?php endif; ?>
                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>

        <div class="col-sm-6">
            <?php $__env->startComponent('components.widget', ['title' => __('sale.sells')]); ?>
                <table class="table table-striped">
                    <?php if(empty($user_settings['rpt_admin_ps_hide_total_sell'])): ?>
                    <tr>
                        <th><?php echo e(__('report.total_sell'), false); ?>:</th>
                        <td>
                            <span class="total_sell">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php if(empty($user_settings['rpt_admin_ps_hide_sell_inc_tax'])): ?>
                    <tr>
                        <th><?php echo e(__('report.sell_inc_tax'), false); ?>:</th>
                        <td>
                             <span class="sell_inc_tax">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php if(empty($user_settings['rpt_admin_ps_hide_sell_return_inc_tax'])): ?>
                    <tr>
                        <th><?php echo e(__('lang_v1.total_sell_return_inc_tax'), false); ?>:</th>
                        <td>
                             <span class="total_sell_return">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php if(empty($user_settings['rpt_admin_ps_hide_sell_due'])): ?>
                    <tr>
                        <th><?php echo e(__('report.sell_due'), false); ?>: <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.sell_due') . '"></i>';
                }
            ?></th>
                        <td>
                            <span class="sell_due">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                    <?php endif; ?>
                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?php $__env->startComponent('components.widget'); ?>
                <?php $__env->slot('title'); ?>
                    <?php echo e(__('lang_v1.overall'), false); ?> 
                    ((<?php echo app('translator')->get('business.sale'); ?> - <?php echo app('translator')->get('lang_v1.sell_return'); ?>) - (<?php echo app('translator')->get('lang_v1.purchase'); ?> - <?php echo app('translator')->get('lang_v1.purchase_return'); ?>) ) 
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.over_all_sell_purchase') . '"></i>';
                }
            ?>
                <?php $__env->endSlot(); ?>
                <h3 class="text-muted">
                    <?php echo e(__('report.sell_minus_purchase'), false); ?>: 
                    <span class="sell_minus_purchase">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </span>
                </h3>

                <h3 class="text-muted">
                    <?php echo e(__('report.difference_due'), false); ?>: 
                    <span class="difference_due">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </span>
                </h3>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<script>
    $(document).ready(function () {
        $('#purchase_sell_print_btn').on('click', function () {
            var params = {
                location_id: $('#purchase_sell_location_filter').val() || ''
            };
            var picker = $('#purchase_sell_date_filter').data('daterangepicker');

            if (picker) {
                params.start_date = picker.startDate.format('YYYY-MM-DD');
                params.end_date = picker.endDate.format('YYYY-MM-DD');
            }

            window.open('<?php echo e(url('reports/purchase-sell-print'), false); ?>?' + $.param(params), '_blank');
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>