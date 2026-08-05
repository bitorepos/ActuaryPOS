
<?php $__env->startSection('title', __('stock_adjustment.stock_adjustments')); ?>

<?php
    $user_settings = json_decode(auth()->user()->user_settings, true);
?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('stock_adjustment.stock_adjustments'); ?>
        <small></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('location_id',  __('purchase.business_location') . ':'); ?>

                <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'id' => 'location_id', 'style' => 'width:100%']); ?>

            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('adjustment_date_range', __('report.date_range') . ':'); ?>

                <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'adjustment_date_range', 'readonly']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('type',  __('stock_adjustment.adjustment_type') . ':'); ?>

                <?php echo Form::select('type', ['stock_adjustment' => __('stock_adjustment.stock_adjustment'), 'stock_take' => __('stock_adjustment.stock_take')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3">
                <?php echo Form::label('added_by', __('expense.added_by').':'); ?>

                <?php echo Form::select('added_by', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>

    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('stock_adjustment.all_stock_adjustments')]); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <a class="btn btn-block btn-primary" href="<?php echo e(action([\App\Http\Controllers\StockAdjustmentController::class, 'create']), false); ?>">
                <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></a>
            </div>
        <?php $__env->endSlot(); ?>
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
        <style>
            .dataTables_scrollHead {
                position: static !important;
            }
        </style>
        <div class="table-responsive" style="min-height: 80vh">
            <table class="table table-bordered table-striped ajax_view table-th-skin" id="stock_adjustment_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                        <th><?php echo app('translator')->get('business.location'); ?></th>
                        <th><?php echo app('translator')->get('stock_adjustment.adjustment_type'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('stock_adjustment.total_amount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('stock_adjustment.total_amount_recovered'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                        <th><?php echo app('translator')->get('stock_adjustment.reason_for_stock_adjustment'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.created_at'); ?></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="bg-gray font-17 text-center footer-total">
                        <td colspan="5"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                        <td class="footer_sa_total text-right"></td>
                        <td class="footer_sa_recovered text-right"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>

</section>
<!-- /.content -->

<section id="sa_receipt_section" class="print_section"></section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('js/stock_adjustment.js?v=' . $asset_v . '.' . filemtime(public_path('js/stock_adjustment.js'))), false); ?>"></script>
	<script>
		$(document).ready(function() {
			if (typeof stock_adjustment_table !== 'undefined') {
				<?php if(!empty($user_settings['stock_adj_index_hide_ref_no'])): ?>
					stock_adjustment_table.column(2).visible(false);
				<?php endif; ?>
				<?php if(!empty($user_settings['stock_adj_index_hide_location'])): ?>
					stock_adjustment_table.column(3).visible(false);
				<?php endif; ?>
				<?php if(!empty($user_settings['stock_adj_index_hide_adjustment_type'])): ?>
					stock_adjustment_table.column(4).visible(false);
				<?php endif; ?>
				<?php if(!empty($user_settings['stock_adj_index_hide_total_amount'])): ?>
					stock_adjustment_table.column(5).visible(false);
				<?php endif; ?>
				<?php if(!empty($user_settings['stock_adj_index_hide_total_recovered'])): ?>
					stock_adjustment_table.column(6).visible(false);
				<?php endif; ?>
				<?php if(!empty($user_settings['stock_adj_index_hide_reason'])): ?>
					stock_adjustment_table.column(7).visible(false);
				<?php endif; ?>
				<?php if(!empty($user_settings['stock_adj_index_hide_added_by'])): ?>
					stock_adjustment_table.column(8).visible(false);
				<?php endif; ?>
			}

		$(document).on('click', '.print-stock-adjustment', function() {
			var url = $(this).data('href');
			$.ajax({
				method: 'GET',
				url: url,
				dataType: 'json',
				success: function(result) {
					if (result.success == 1) {
						$('#sa_receipt_section').html(result.receipt.html_content);
						__currency_convert_recursively($('#sa_receipt_section'));
						var title = document.title;
						if (result.print_title) { document.title = result.print_title; }
						__print_receipt('sa_receipt_section');
						document.title = title;
					}
				}
			});
		});
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>