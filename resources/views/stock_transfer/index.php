
<?php $__env->startSection('title', __('lang_v1.stock_transfers')); ?>

<?php
    $user_settings = json_decode(auth()->user()->user_settings, true);
?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo app('translator')->get('lang_v1.stock_transfers'); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content no-print">
   
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <?php
            $date_loc = array_key_first($date_settings ?? []);
            $stock_transfer_filter_date_range = ! is_null($date_loc) && is_array($date_settings[$date_loc] ?? null)
                ? ($date_settings[$date_loc]['stock_transfer_filter_date_range'] ?? null)
                : ($date_settings['stock_transfer_filter_date_range'] ?? null);
        ?>
        <?php if(!empty($stock_transfer_filter_date_range)): ?>
            <?php echo Form::hidden('stock_transfer_filter_date_range', $stock_transfer_filter_date_range, ['id'=>'stock_transfer_filter_date_range']); ?>

        <?php endif; ?>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('location_from',  __('lang_v1.location_from') . ':'); ?>

                <?php echo Form::select('location_from', $business_locations, null, ['class' => 'form-control select2', 'id' => 'location_from', 'style' => 'width:100%']); ?>

            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('location_to',  __('lang_v1.location_to') . ':'); ?>

                <?php echo Form::select('location_to', $business_locations, null, ['class' => 'form-control select2', 'id' => 'location_to', 'style' => 'width:100%']); ?>

            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('transfer_date_range', __('report.date_range') . ':'); ?>

                <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'transfer_date_range', 'readonly']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('status',  __('sale.status') . ':'); ?>

                <?php echo Form::select('status', $statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <?php echo Form::label('added_by', __('expense.added_by').':'); ?>

                <?php echo Form::select('added_by', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>

    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.all_stock_transfers')]); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('stock_transfers.create')): ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <a class="btn btn-block btn-primary" href="<?php echo e(action([\App\Http\Controllers\StockTransferController::class, 'create']), false); ?>">
                <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></a>
            </div>
        <?php $__env->endSlot(); ?>
        <?php endif; ?>
        <?php if(in_array('transactions_restoration', $enabled_modules)): ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <br>
                        <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                        </label>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php
        $is_admin = auth()->user()->hasRole('Admin#'.auth()->user()->business_id);
        $hide_price = '';
        if (empty($user_settings['stock_transfer_show_price_column']) && !$is_admin) {
            $hide_price = 'hide';
        }
        ?>
        <?php if($hide_price == 'hide'): ?>
        <input type="hidden" id="stock_transfer_hide_price_column">
        <?php endif; ?>
        <style>
            .dataTables_scrollHead {
                position: static !important;
            }
        </style>
        <div class="table-responsive" style="min-height: 80vh">
            <table class="table table-bordered table-striped ajax_view table-th-skin" id="stock_transfer_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.location_from'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.location_to'); ?></th>
                        <?php if(!empty($common_settings['enable_stock_issue_receive'])): ?>
                        <th id="stock_ir_type"><?php echo app('translator')->get('lang_v1.stock_type'); ?></th>
                        <th id="stock_ir_category"><?php echo app('translator')->get('product.category'); ?></th>
                        <?php endif; ?>
                        <th><?php echo app('translator')->get('sale.status'); ?></th>
                        <?php if($hide_price != 'hide'): ?>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.shipping_charges'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.total_cost_value'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.total_selling_value'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                        <?php endif; ?>
                        <th><?php echo app('translator')->get('purchase.additional_notes'); ?></th>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.created_at'); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>

<?php echo $__env->make('stock_transfer.partials.update_status_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section id="receipt_section" class="print_section"></section>

<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('js/stock_transfer.js?v=' . $asset_v . '.' . filemtime(public_path('js/stock_transfer.js'))), false); ?>"></script>
	<script>
		$(document).ready(function() {
			if (typeof stock_transfer_table !== 'undefined') {
				<?php if(!empty($user_settings['stock_transfer_index_hide_ref_no'])): ?>
					stock_transfer_table.column('ref_no:name').visible(false);
				<?php endif; ?>
				<?php if(!empty($user_settings['stock_transfer_index_hide_location_from'])): ?>
					stock_transfer_table.column('l1.name:name').visible(false);
				<?php endif; ?>
				<?php if(!empty($user_settings['stock_transfer_index_hide_location_to'])): ?>
					stock_transfer_table.column('l2.name:name').visible(false);
				<?php endif; ?>
				<?php if(!empty($user_settings['stock_transfer_index_hide_status'])): ?>
					stock_transfer_table.column('status:name').visible(false);
				<?php endif; ?>
				<?php if(!empty($user_settings['stock_transfer_index_hide_shipping_charges'])): ?>
					stock_transfer_table.column('shipping_charges:name').visible(false);
				<?php endif; ?>
				<?php if(!empty($user_settings['stock_transfer_index_hide_total_amount'])): ?>
					stock_transfer_table.column('final_total:name').visible(false);
				<?php endif; ?>
				<?php if(!empty($user_settings['stock_transfer_index_hide_total_selling_value'])): ?>
					stock_transfer_table.column('total_selling_value:name').visible(false);
				<?php endif; ?>
				<?php if(!empty($user_settings['stock_transfer_index_hide_additional_notes'])): ?>
					stock_transfer_table.column('additional_notes:name').visible(false);
				<?php endif; ?>
			}
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>