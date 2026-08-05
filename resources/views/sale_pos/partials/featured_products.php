<?php $__currentLoopData = $featured_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="col-md-3 col-4 product_list no-print">
		<div class="product_box" data-bs-toggle="tooltip" data-placement="bottom" data-variation_id="<?php echo e($variation->id, false); ?>" data-edit_price_on_sale="<?php echo e(!empty($variation->product->edit_price_on_sale) ? 1 : 0, false); ?>" title="<?php echo e($variation->full_name, false); ?>">

		<div class="image-container" 
			style="background-image: url(
					<?php if(count($variation->media) > 0): ?>
						<?php echo e($variation->media->first()->display_url, false); ?>

					<?php elseif(!empty($variation->product->image_url)): ?>
						<?php echo e($variation->product->image_url, false); ?>

					<?php else: ?>
						<?php echo e(asset('/img/default.png'), false); ?>

					<?php endif; ?>
				);
			background-repeat: no-repeat; background-position: center;
			background-size: contain;">
			
		</div>

		<div class="text_div">
			<small class="text text-muted"><?php echo e($variation->product->name, false); ?> 
			<?php if($variation->product->type == 'variable'): ?>
				- <?php echo e($variation->name, false); ?>

			<?php endif; ?>
			</small>

			<small class="text-muted">
				(<?php echo e($variation->sub_sku, false); ?>)
			</small>
		</div>
			
		</div>
	</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
