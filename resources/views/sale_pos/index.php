
<?php $__env->startSection('title', __( 'sale.list_pos')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo app('translator')->get('sale.pos_sale'); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
    <?php echo $__env->make('sell.partials.sell_list_filters', ['merge_station_with_source_filter' => true, 'date_range_setting_key' => 'pos_sale_filter_date_range', 'date_range_setting_default' => 'today'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if($fbr_enabled && empty($common_settings['disable_bulk_fbr_sync'])): ?>
    <div class="col-md-4">
        <div class="mb-3">
            <br>
            <label>
            <a class="btn btn-inline btn-warning" id="sync_pra_sales" href="<?php echo e(route('sells.syncPraSales'), false); ?>" data-confirm-text="<?php echo app('translator')->get('lang_v1.sync_pra_sales_confirm'); ?>">
            <i class="fa fa-sync"></i> <?php echo app('translator')->get('lang_v1.sync_pra_sales'); ?></a>
            </label>
            <p class="help-block"><?php echo app('translator')->get('lang_v1.fbr_pos_bulk_sync_unavailable'); ?></p>
        </div>
    </div>
    <?php endif; ?>
    <?php if(!empty($fbr_di_enabled)): ?>
    <div class="col-md-4">
        <div class="mb-3">
            <br>
            <label>
            <a class="btn btn-inline btn-info" id="sync_fbr_di_sales" href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'syncFbrDISales']), false); ?>" data-confirm-text="<?php echo app('translator')->get('lang_v1.sync_fbr_di_sales_confirm'); ?>">
            <i class="fa fa-cloud-upload-alt"></i> <?php echo app('translator')->get('lang_v1.sync_fbr_di_sales'); ?></a>
            </label>
        </div>
    </div>
    <?php endif; ?>
    <input type="hidden" id="business_location" value="">
    <input type="hidden" id="date_range" value="">
    <?php if(in_array('transactions_restoration', $enabled_modules)): ?>
        <div class="col-md-4">
            <div class="mb-3">
                <br>
                <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                </label>
            </div>
        </div>
    <?php endif; ?>
    <div class="col-md-4">
        <div class="mb-3">
            <br>
            <label class="form-check-label">
<?php echo Form::checkbox('show_sync_duplicates', 1, false, ['class' => 'form-check-input', 'id' => 'show_sync_duplicates']); ?> <strong><?php echo app('translator')->get('lang_v1.show_only_duplicates'); ?></strong>
            </label>
        </div>
    </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'sale.list_pos')]); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sell.create')): ?>
    <?php $__env->slot('tool'); ?>
    <div class="box-tools">
        <a class="btn btn-block btn-primary"
            href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'create']), false); ?>">
            <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></a>
    </div>
    <?php $__env->endSlot(); ?>
    <?php endif; ?>
    <?php if(auth()->user()->hasRole('Admin#' . auth()->user()->business_id) || auth()->user()->hasAnyPermission(['sell.view', 'sell.view_own'])): ?>
    <input type="hidden" name="is_direct_sale" id="is_direct_sale" value="0">
    <input type="hidden" id="pos_sales_list" value="1">
    <?php echo $__env->make('sale_pos.partials.sales_table', ['show_currency_in_value_headers' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<!-- /.content -->
<div class="modal fade register_details_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

<!-- This will be printed -->
<!-- <section class="invoice print_section" id="receipt_section">
</section> -->


<?php echo $__env->make('dojo.refund_amount_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('sale_pos.partials.change_invoice_layout_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/dojo_list_refund.js?v=' . $asset_v), false); ?>"></script>
<?php echo $__env->make('sale_pos.partials.sale_table_javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '#sync_pra_sales, #sync_fbr_di_sales', function(e){
            e.preventDefault();
            var loader = __fa_awesome();
            var btn = $(this);
            var btn_html = $(this).html();
            var confirm_text = btn.data('confirm-text') || 'This will submit all not submitted sales.';
            btn.html(loader); 
            btn.attr('disabled', true);

            var start_time = $('#sell_list_filter_start_time').val();
            var end_time = $('#sell_list_filter_end_time').val();
            var start = null;
            var end = null;
            
            if($('#sell_list_filter_date_range').val()) {
                start = $('#sell_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                start = moment(start + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                end = $('#sell_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                end = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');    
            }
            
            swal({
                title: LANG.sure,
                text: confirm_text,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willContinue => {
                if (willContinue) {
                    $.ajax({
                        url: $(this).attr('href'),
                        data: {
                            start_date : start,
                            end_date : end
                        },
                        dataType: 'json',
                        success: function(result) {
                            if (result.success) {
                                toastr.success(result.msg);
                            } else {
                                toastr.error(result.msg);
                            }
                            btn.html(btn_html); 
                            btn.attr('disabled', false);
                        },
                        error: function() {
                            toastr.error(LANG.something_went_wrong);
                            btn.html(btn_html);
                            btn.attr('disabled', false);
                        },
                    });
                } else {
                    btn.html(btn_html); 
                    btn.attr('disabled', false);
                }
            });
        })
    });
</script>

<script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>