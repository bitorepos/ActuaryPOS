<div class="row">
	<div class="col-md-12">
		<h4><?php echo app('translator')->get('lang_v1.combo'); ?>:</h4>
	</div>
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table bg-gray">
				<tr class="bg-green">
					<th><?php echo app('translator')->get('product.product_name'); ?></th>
					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_purchase_price')): ?>
						<th><?php echo app('translator')->get('product.default_purchase_price'); ?> (<?php echo app('translator')->get('product.exc_of_tax'); ?>)</th>
						<th><?php echo app('translator')->get('product.default_purchase_price'); ?> (<?php echo app('translator')->get('product.inc_of_tax'); ?>)</th>
					<?php endif; ?>
					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_default_selling_price')): ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_purchase_price')): ?>
				        	<th><?php echo app('translator')->get('product.profit_percent'); ?></th>
				        <?php endif; ?>
				        <th><?php echo app('translator')->get('product.default_selling_price'); ?> (<?php echo app('translator')->get('product.exc_of_tax'); ?>)</th>
				        <th><?php echo app('translator')->get('product.default_selling_price'); ?> (<?php echo app('translator')->get('product.inc_of_tax'); ?>)</th>
			        <?php endif; ?>
			        <th><?php echo app('translator')->get('sale.qty'); ?></th>
			        <th class="text-center">
						<?php echo app('translator')->get('lang_v1.total_amount_exc_tax'); ?>
					</th>
			        <th><?php echo app('translator')->get('lang_v1.variation_images'); ?></th>
				</tr>
				<?php $__currentLoopData = $combo_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td>
						<?php echo e($variation['variation']['product']->name, false); ?> 

						<?php if($variation['variation']['product']->type == 'variable'): ?>
							- <?php echo e($variation['variation']->name, false); ?>

						<?php endif; ?>
						
						(<?php echo e($variation['variation']->sub_sku, false); ?>)
					</td>
					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_purchase_price')): ?>
						<td>
							<span class="display_currency" data-currency_symbol="true"><?php echo e($variation['variation']->default_purchase_price, false); ?></span>
						</td>
						<td>
							<span class="display_currency" data-currency_symbol="true"><?php echo e($variation['variation']->dpp_inc_tax, false); ?></span>
						</td>
					<?php endif; ?>
					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_default_selling_price')): ?>
						<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_purchase_price')): ?>
						<td>
							<?php echo e(number_format($variation['variation']->profit_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

						</td>
						<?php endif; ?>
						<td>
							<span class="display_currency" data-currency_symbol="true"><?php echo e($variation['variation']->default_sell_price, false); ?></span>
						</td>
						<td>
							<span class="display_currency" data-currency_symbol="true"><?php echo e($variation['variation']->sell_price_inc_tax, false); ?></span>
						</td>
					<?php endif; ?>
					<td>
						<span class="display_currency" data-currency_symbol="false" data-is_quantity=true ><?php echo e($variation['quantity'], false); ?></span> <?php echo e($variation['unit_name'], false); ?>

					</td>
					<td>
						<span class="display_currency" data-currency_symbol="true"><?php echo e($variation['variation']->default_purchase_price * $variation['quantity'] * $variation['multiplier'], false); ?></span>
					</td>
					<td>
			        	<?php $__currentLoopData = $variation['variation']->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			        		<?php echo $media->thumbnail([60, 60], 'img-thumbnail'); ?>

			        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			        </td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
		</div>
	</div>
	<div class="col-md-12 text-right">
		<strong><?php echo app('translator')->get('product.default_selling_price'); ?>: </strong> 
		<span class="display_currency" data-currency_symbol="true"><?php echo e($product->variations->first()->sell_price_inc_tax, false); ?></span>
	</div>
</div>
