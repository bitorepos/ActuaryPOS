<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>
<style>
<?php if(!empty($user_settings['rpt_stock_sdetail_hide_sku'])): ?>
    .stock-detail-tbl th:nth-child(1), .stock-detail-tbl td:nth-child(1) { display: none; }
<?php endif; ?>
<?php if(!empty($user_settings['rpt_stock_sdetail_hide_variation'])): ?>
    .stock-detail-tbl th:nth-child(2), .stock-detail-tbl td:nth-child(2) { display: none; }
<?php endif; ?>
<?php if(!empty($user_settings['rpt_stock_sdetail_hide_unit_price'])): ?>
    .stock-detail-tbl th:nth-child(3), .stock-detail-tbl td:nth-child(3) { display: none; }
<?php endif; ?>
<?php if(!empty($user_settings['rpt_stock_sdetail_hide_current_stock'])): ?>
    .stock-detail-tbl th:nth-child(4), .stock-detail-tbl td:nth-child(4) { display: none; }
<?php endif; ?>
<?php if(!empty($user_settings['rpt_stock_sdetail_hide_total_unit_sold'])): ?>
    .stock-detail-tbl th:nth-child(5), .stock-detail-tbl td:nth-child(5) { display: none; }
<?php endif; ?>
<?php if(!empty($user_settings['rpt_stock_sdetail_hide_total_unit_transferred'])): ?>
    .stock-detail-tbl th:nth-child(6), .stock-detail-tbl td:nth-child(6) { display: none; }
<?php endif; ?>
<?php if(!empty($user_settings['rpt_stock_sdetail_hide_total_unit_adjusted'])): ?>
    .stock-detail-tbl th:nth-child(7), .stock-detail-tbl td:nth-child(7) { display: none; }
<?php endif; ?>
</style>
<div class="row">
	<div class="col-md-10 col-md-offset-1 col-12">
		<div class="table-responsive">
			<table class="table table-condensed bg-gray stock-detail-tbl">
				<tr>
					<th>SKU</th>
					<th>Variation</th>
					<th><?php echo app('translator')->get('sale.unit_price'); ?></th>
					<th><?php echo app('translator')->get('report.current_stock'); ?></th>
					<th><?php echo app('translator')->get('report.total_unit_sold'); ?></th>
					<th><?php echo app('translator')->get('lang_v1.total_unit_transfered'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.total_unit_adjusted'); ?></th>
				</tr>
				<?php $__currentLoopData = $product_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($details->sub_sku, false); ?></td>
						<td>
							<?php echo e($details->product . '-' . $details->product_variation . 
							'-' .  $details->variation, false); ?>

						</td>
						<td><span class="display_currency" data-currency_symbol=true><?php echo e($details->sell_price_inc_tax, false); ?></span></td>
						<td>
							<?php if($details->stock): ?>
								<span class="display_currency" data-currency_symbol=false><?php echo e((float)$details->stock, false); ?></span> <?php echo e($details->unit, false); ?>

							<?php else: ?>
							 0
							<?php endif; ?>
						</td>
						<td>
							<?php if($details->total_sold): ?>
								<span class="display_currency" data-currency_symbol=false><?php echo e((float)$details->total_sold, false); ?></span> <?php echo e($details->unit, false); ?>

							<?php else: ?>
							 0
							<?php endif; ?>
						</td>
						<td>
							<?php if($details->total_transfered): ?>
								<span class="display_currency" data-currency_symbol=false><?php echo e((float)$details->total_transfered, false); ?></span> <?php echo e($details->unit, false); ?>

							<?php else: ?>
							 0
							<?php endif; ?>
						</td>
						<td>
							<?php if($details->total_adjusted): ?>
								<span class="display_currency" data-currency_symbol=false><?php echo e((float)$details->total_adjusted, false); ?></span> <?php echo e($details->unit, false); ?>

							<?php else: ?>
							 0
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
		</div>
	</div>
</div>
