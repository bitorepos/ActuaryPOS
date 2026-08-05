<!-- app css -->
<?php if(!empty($for_pdf)): ?>
	<link rel="stylesheet" href="<?php echo e(asset('css/app.css?v='.$asset_v), false); ?>">
<?php endif; ?>
<div class="col-md-12 col-sm-12 hide consumption_report_filters" style="background-color: white !important;margin-bottom: 10px;">
	<?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="col-md-4">
			<strong><?php echo e($key, false); ?></strong> : <?php echo e($value, false); ?>

		</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="col-md-12 col-sm-12" style="background-color: white !important">
	<div class="table-responsive">
	<table class="table table-bordered" id="transfer_ledger_table" >
		<thead>
			<tr class="row-border blue-heading text-center">
				<th class="col-md-4"><?php echo app('translator')->get( 'category.category' ); ?></th>
				<th class="col-md-1"><?php echo app('translator')->get( 'lang_v1.cost_rate' ); ?></th>
				<th class="col-md-1"><?php echo app('translator')->get( 'lang_v1.system_consumption_qty' ); ?></th>
				<th class="col-md-1"><?php echo app('translator')->get( 'lang_v1.system_consumption_value' ); ?></th>
				<th class="col-md-1"><?php echo app('translator')->get( 'lang_v1.actual_consumption_qty' ); ?></th>
				<th class="col-md-1"><?php echo app('translator')->get( 'lang_v1.actual_consumption_value' ); ?></th>
				<th class="col-md-1"><?php echo app('translator')->get( 'lang_v1.difference_qty' ); ?></th>
				<th class="col-md-1"><?php echo app('translator')->get( 'lang_v1.difference_value' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $consumption; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $con): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr style="background-color: #ccc !important;">
					<td><b><?php echo e($con['name'], false); ?></b></td>
					<td colspan="7"></td>
				</tr>
				<?php
					$yellow_system_qty_total = 0; 
					$yellow_system_value_total = 0;
					$yellow_actual_qty_total = 0;
					$yellow_actual_value_total = 0;
					$yellow_diff_qty_total = 0;
					$yellow_diff_value_total = 0;
				?>
				<?php $__currentLoopData = $con['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr class="bg-light-skin">
						<td style="padding-left:2%"><?php if(!empty($cat['code'])): ?><?php echo e($cat['code'], false); ?> - <?php endif; ?> <?php echo e($cat['name'], false); ?></td>
						<td><?php echo e(number_format($cat['rate'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
						<td><?php echo e(number_format($cat['system_qty'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
						<td><b><?php echo e(number_format($cat['system_value'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></b></td>
						<td><?php echo e(number_format($cat['actual_qty'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
						<td><b><?php echo e(number_format($cat['actual_value'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></b></td>
						<td><?php echo e(number_format($cat['diff_qty'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
						<td><?php echo e(number_format($cat['diff_value'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
					</tr>
					<?php
						$yellow_system_qty_total += $cat['system_qty']; 
						$yellow_system_value_total += $cat['system_value'];
						$yellow_actual_qty_total += $cat['actual_qty'];
						$yellow_actual_value_total += $cat['actual_value'];
						$yellow_diff_qty_total += $cat['diff_qty'];
						$yellow_diff_value_total += $cat['diff_value'];
					?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				<tr class="bg-light-skin">
					<td></td>
					<td><strong><?php echo app('translator')->get('sale.total'); ?></strong></td>
					<td><?php echo e(number_format($yellow_system_qty_total, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
					<td><b><?php echo e(number_format($yellow_system_value_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></b></td>
					<td><?php echo e(number_format($yellow_actual_qty_total, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
					<td><b><?php echo e(number_format($yellow_actual_value_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></b></td>
					<td><?php echo e(number_format($yellow_diff_qty_total, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
					<td><?php echo e(number_format($yellow_diff_value_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
				</tr>
				
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
	</div>
	<style>
		.line_details tr td, .line_details tr th, #yellow_footer td
		{
			text-align: left !important;
		}
		.bg-gray td, .center_text
		{
			text-align: center !important;
		}
		.transfer_ledger_table{
			overflow-x: scroll;
		}
		.col-md-6, .col-sm-6, .col-6 {
			float: left;
			width: 50%;
			box-sizing: border-box;
		}
	</style>
</div>
