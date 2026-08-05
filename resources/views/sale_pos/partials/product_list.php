<?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	<div class="col-md-4 col-sm-4 col-4 product_list no-print">
		<div class="product_box" data-variation_id="<?php echo e($product->id, false); ?>"
			data-edit_price_on_sale="<?php echo e(!empty($product->edit_price_on_sale) ? 1 : 0, false); ?>"
			title="<?php echo e($product->name, false); ?> <?php if($product->type == 'variable'): ?>- <?php echo e($product->variation, false); ?> <?php endif; ?> <?php echo e('(' . $product->sub_sku . ')', false); ?> <?php if(!empty($show_prices)): ?> <?php echo app('translator')->get('lang_v1.default'); ?> - <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $product->selling_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php $__currentLoopData = $product->group_prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group_price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if(array_key_exists($group_price->price_group_id, $allowed_group_prices)): ?> <?php echo e($allowed_group_prices[$group_price->price_group_id], false); ?> - <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $group_price->price_inc_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>">

			<?php
				$img_url = asset('/img/default.png');
				if (count($product->media) > 0) {
					$img_url = $product->media->first()->display_url;
				} elseif (!empty($product->product_image)) {
					$img_url = asset('/uploads/img/' . rawurlencode($product->product_image));
				}
			?>
			<div class="image-container" style="background-image: url('<?php echo e($img_url, false); ?>'); background-repeat: no-repeat; background-position: center; background-size: contain;">
				<span class="bb-product-stock-badge d-none">
					<?php echo e(number_format($product->qty_available ?? 0, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?><?php if(!empty($product->unit)): ?> <?php echo e(strtoupper($product->unit), false); ?> <?php endif; ?>
				</span>
			</div>

			<div class="text_div">
				<small class="text text-muted"><?php echo e($product->name, false); ?>

					<?php if($product->type == 'variable'): ?>
						- <?php echo e($product->variation, false); ?>

					<?php endif; ?>
				</small>

				<small class="text-muted">
					(<?php echo e($product->sub_sku, false); ?>)
				</small>
				<?php if(!empty($show_prices)): ?>
					<br>
					<small class="text-muted">
						<?php
							$display_price = $is_tax_inclusive ? $product->sell_price_inc_tax : $product->default_sell_price;
							if (!empty($location_price_group_id)) {
								$loc_group_price = $product->group_prices->firstWhere('price_group_id', $location_price_group_id);
								if (!empty($loc_group_price)) {
									$display_price = $loc_group_price->price_inc_tax;
								}
							}
						?>
						<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $display_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
					</small>
				<?php endif; ?>
			</div>

		</div>
	</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
	<input type="hidden" id="no_products_found">
	<div class="col-md-12">
		<h4 class="text-center">
			<?php echo app('translator')->get('lang_v1.no_products_to_display'); ?>
		</h4>
	</div>
<?php endif; ?>
