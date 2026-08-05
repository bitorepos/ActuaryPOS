<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-condensed bg-gray">
				<thead>
					<tr class="bg-green">
						<th>SKU</th>
		                <th><?php echo app('translator')->get('business.product'); ?></th>
		                <th><?php echo app('translator')->get('business.location'); ?></th>
		                <th><?php echo app('translator')->get('sale.unit_price'); ?></th>
		                <th>Pack Stock Quantity</th>
						<th>Open Stock Quantity</th>
						<th><?php echo app('translator')->get('report.current_stock'); ?></th>
		                <th><?php echo app('translator')->get('lang_v1.total_stock_price'); ?></th>
		                <th><?php echo app('translator')->get('report.total_unit_sold'); ?></th>
		                <th><?php echo app('translator')->get('lang_v1.total_unit_transfered'); ?></th>
		                <th><?php echo app('translator')->get('lang_v1.total_unit_adjusted'); ?></th>
		            </tr>
	            </thead>
	            <tbody>
	            	<?php $__currentLoopData = $product_stock_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	            		<tr>
	            			<td><?php echo e($product->sku, false); ?></td>
	            			<td>
	            				<?php
	            				$name = $product->product;
			                    if ($product->type == 'variable') {
			                        $name .= ' - ' . $product->product_variation . '-' . $product->variation_name;
			                    }
			                    ?>
			                    <?php echo e($name, false); ?>

	            			</td>
	            			<td><?php echo e($product->location_name, false); ?></td>
	            			<td>
                        		<span class="display_currency" data-currency_symbol=true ><?php echo e($product->unit_price ?? 0, false); ?></span>
                        	</td>
							<?php
								if(!empty($product->sub_unit_multiplier)){
									$pack_quantity = floor($product->stock / $product->sub_unit_multiplier);
									$open_quantity = (($product->stock / $product->sub_unit_multiplier) - floor($product->stock / $product->sub_unit_multiplier)) * $product->sub_unit_multiplier;
									$pack_unit_name = $product->sub_unit_short_name;
								}
								if(!empty($product->variation_sub_unit_multiplier) && $product->variation_sub_unit_short_name != $product->unit){
									$pack_quantity = floor($product->stock / $product->variation_sub_unit_multiplier);
									$open_quantity = (($product->stock / $product->variation_sub_unit_multiplier) - floor($product->stock / $product->variation_sub_unit_multiplier)) * $product->variation_sub_unit_multiplier;
									$pack_unit_name = $product->variation_sub_unit_short_name;
								}
							?>
	            			<td>
                        		<span data-is_quantity="true" class="display_currency" data-currency_symbol=false ><?php echo e($pack_quantity ?? 0, false); ?></span> <?php echo e($pack_unit_name ?? $product->unit, false); ?>

                        	</td>
							<td>
                        		<span data-is_quantity="true" class="display_currency" data-currency_symbol=false ><?php echo e($open_quantity ?? 0, false); ?></span> <?php echo e($product->unit, false); ?>

                        	</td>
							<td>
                        		<span data-is_quantity="true" class="display_currency" data-currency_symbol=false ><?php echo e($product->stock ?? 0, false); ?></span> <?php echo e($product->unit, false); ?>

                        	</td>
                        	<td>
                        		<span class="display_currency" data-currency_symbol=true ><?php echo e($product->unit_price * $product->stock, false); ?></span>
                        	</td>
                        	<td>
                        		<span data-is_quantity="true" class="display_currency" data-currency_symbol=false ><?php echo e($product->total_sold ?? 0, false); ?></span><?php echo e($product->unit, false); ?>

                        	</td>
                        	<td>
                        		<span data-is_quantity="true" class="display_currency" data-currency_symbol=false ><?php echo e($product->total_transfered ?? 0, false); ?></span><?php echo e($product->unit, false); ?>

                        	</td>
                        	<td>
                        		<span data-is_quantity="true" class="display_currency" data-currency_symbol=false ><?php echo e($product->total_adjusted ?? 0, false); ?></span><?php echo e($product->unit, false); ?>

                        	</td>
	            		</tr>
	            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	            </tbody>
	            <?php
	            	$psd_total_stock = 0;
	            	$psd_total_value = 0;
	            	$psd_total_sold = 0;
	            	$psd_total_transfered = 0;
	            	$psd_total_adjusted = 0;
	            	$psd_unit = '';
	            	foreach ($product_stock_details as $__p) {
	            		$psd_total_stock += (float) ($__p->stock ?? 0);
	            		$psd_total_value += (float) ($__p->unit_price ?? 0) * (float) ($__p->stock ?? 0);
	            		$psd_total_sold += (float) ($__p->total_sold ?? 0);
	            		$psd_total_transfered += (float) ($__p->total_transfered ?? 0);
	            		$psd_total_adjusted += (float) ($__p->total_adjusted ?? 0);
	            		$psd_unit = $__p->unit ?? $psd_unit;
	            	}
	            ?>
	            <tfoot>
	            	<tr class="bg-gray font-17">
	            		<td colspan="6" class="text-end"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
	            		<td>
	            			<span data-is_quantity="true" class="display_currency" data-currency_symbol="false"><?php echo e($psd_total_stock, false); ?></span> <?php echo e($psd_unit, false); ?>

	            		</td>
	            		<td>
	            			<span class="display_currency" data-currency_symbol="true"><?php echo e($psd_total_value, false); ?></span>
	            		</td>
	            		<td>
	            			<span data-is_quantity="true" class="display_currency" data-currency_symbol="false"><?php echo e($psd_total_sold, false); ?></span><?php echo e($psd_unit, false); ?>

	            		</td>
	            		<td>
	            			<span data-is_quantity="true" class="display_currency" data-currency_symbol="false"><?php echo e($psd_total_transfered, false); ?></span><?php echo e($psd_unit, false); ?>

	            		</td>
	            		<td>
	            			<span data-is_quantity="true" class="display_currency" data-currency_symbol="false"><?php echo e($psd_total_adjusted, false); ?></span><?php echo e($psd_unit, false); ?>

	            		</td>
	            	</tr>
	            </tfoot>
	     	</table>
     	</div>
    </div>
</div>

<?php if(!empty($warehouse_stock_details) && $warehouse_stock_details->count() > 0): ?>
<div class="row" style="margin-top: 10px;">
	<div class="col-md-12">
		<h4 style="margin-bottom: 5px;"><i class="fas fa-warehouse"></i> <?php echo app('translator')->get('warehouse::lang.warehouse'); ?> <?php echo app('translator')->get('report.stock_report'); ?></h4>
		<div class="table-responsive">
			<table class="table table-condensed bg-gray">
				<thead>
					<tr class="bg-green">
						<th>SKU</th>
						<th><?php echo app('translator')->get('business.product'); ?></th>
						<th><?php echo app('translator')->get('warehouse::lang.warehouse'); ?></th>
						<th><?php echo app('translator')->get('sale.unit_price'); ?></th>
						<th><?php echo app('translator')->get('report.current_stock'); ?></th>
						<th><?php echo app('translator')->get('lang_v1.total_stock_price'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $warehouse_stock_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wh_stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($wh_stock->sku, false); ?></td>
							<td>
								<?php
								$wh_name = $wh_stock->product;
								if ($wh_stock->type == 'variable') {
									$wh_name .= ' - ' . $wh_stock->product_variation . '-' . $wh_stock->variation_name;
								}
								?>
								<?php echo e($wh_name, false); ?>

							</td>
							<td><?php echo e($wh_stock->warehouse_name, false); ?></td>
							<td>
								<span class="display_currency" data-currency_symbol=true><?php echo e($wh_stock->unit_price ?? 0, false); ?></span>
							</td>
							<td>
								<span data-is_quantity="true" class="display_currency" data-currency_symbol=false><?php echo e($wh_stock->stock ?? 0, false); ?></span> <?php echo e($wh_stock->unit, false); ?>

							</td>
							<td>
								<span class="display_currency" data-currency_symbol=true><?php echo e(($wh_stock->unit_price ?? 0) * ($wh_stock->stock ?? 0), false); ?></span>
							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php endif; ?>
