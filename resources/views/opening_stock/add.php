
<?php $__env->startSection('title', __('lang_v1.add_opening_stock')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.add_opening_stock'); ?>
		
	</h1>
</section>

<!-- Main content -->
<section class="content">
	<?php echo Form::open(['url' => action([\App\Http\Controllers\OpeningStockController::class, 'save']), 'method' => 'post', 'id' => 'add_opening_stock_form' ]); ?>

	<?php echo Form::hidden('product_id', $product->id); ?>

	<?php echo $__env->make('opening_stock.form-part', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<input type="hidden" name="submit_type" id="submit_type">
	<?php echo Form::close(); ?>


	
	<div id="opening-stock-footer-actions-template" class="d-none">
		<div>
			<button type="button" class="btn btn-warning add_opening_stock_btn" id="add_opening_stock_btn" value="save_n_print_label"><?php echo app('translator')->get('lang_v1.save_n_print_label'); ?></button>
			<button type="button" class="btn bg-maroon add_opening_stock_btn" id="add_opening_stock_btn"><?php echo app('translator')->get('messages.save'); ?></button>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('js/opening_stock.js?v=' . $asset_v), false); ?>"></script>
	<script type="text/javascript">
		$(document).ready( function(){
			$('.os_date').datetimepicker({
		        format: moment_date_format + ' ' + moment_time_format,
		        ignoreReadonly: true,
		        widgetPositioning: {
		            horizontal: 'right',
		            vertical: 'bottom'
		        }
		    });
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>