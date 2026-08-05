<style>
.product-set-modal .btn-check:checked + .btn-product-set,
.product-set-modal .btn-product-set.active {
    background-color: #0d6efd !important;
    border-color: #0d6efd !important;
    color: #fff !important;
}
.product-set-modal .btn-product-set {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    color: #333;
    transition: all 0.15s ease-in-out;
}
.product-set-modal .btn-product-set:hover {
    background-color: #e8f0fe;
    border-color: #0d6efd;
}
</style>
<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
  <div class="modal-content product-set-modal" style="border:none;border-radius:10px;overflow:hidden;">

    <div class="modal-header" style="border-bottom:1px solid #e9ecef;padding:12px 20px;">
      <h5 class="modal-title fw-bold" style="font-size:15px;"><?php echo app('translator')->get( 'lang_v1.product_set' ); ?>:</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body" style="padding:16px 20px;max-height:70vh;overflow-y:auto;">
        <div class="accordion" id="accordion_set_products">
			<div class="accordion-item" style="border:1px solid #e0e0e0;border-radius:8px;overflow:hidden;margin-bottom:12px;">
				<h2 class="accordion-header">
					<button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_set_products" aria-expanded="true" aria-controls="collapse_set_products" style="padding:10px 16px;font-size:14px;background:#f0f7ff;color:#0d6efd;">
						<?php echo e($set_name, false); ?>

					</button>
				</h2>

				<div id="collapse_set_products" class="accordion-collapse collapse show" data-bs-parent="#accordion_set_products">
					<div class="accordion-body" style="padding:12px;">
					<div style="display:flex;flex-wrap:wrap;gap:8px;">
						<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<input type="checkbox" autocomplete="off" name="set_products[]" value="<?php echo e($sp->id, false); ?>" class="btn-check" id="set_product_<?php echo e($sp->id, false); ?>">
						<label class="btn btn-product-set" for="set_product_<?php echo e($sp->id, false); ?>" style="padding:10px 16px;min-width:120px;flex:1 1 auto;max-width:calc(33.333% - 6px);display:inline-flex;align-items:center;justify-content:center;text-align:center;white-space:normal;word-break:break-word;font-size:13px;border-radius:6px;line-height:1.3;">
							<?php echo e($sp->product->name, false); ?> <?php if($sp->name != 'DUMMY'): ?> (<?php echo e($sp->name, false); ?>) <?php endif; ?>
						</label>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					</div>
				</div>
			</div>
        </div>

		<div class="accordion" id="accordion_set_addon_products">
			<div class="accordion-item" style="border:1px solid #e0e0e0;border-radius:8px;overflow:hidden;">
				<h2 class="accordion-header">
					<button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_set_addon_products" aria-expanded="true" aria-controls="collapse_set_addon_products" style="padding:10px 16px;font-size:14px;background:#f0f7ff;color:#0d6efd;">
						<?php echo e($set_name, false); ?> Addons
					</button>
				</h2>

				<div id="collapse_set_addon_products" class="accordion-collapse collapse show" data-bs-parent="#accordion_set_addon_products">
					<div class="accordion-body" style="padding:12px;">
					<div style="display:flex;flex-wrap:wrap;gap:8px;">
						<?php $__currentLoopData = $addon_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<input type="checkbox" name="set_addon_products[]" autocomplete="off" value="<?php echo e($sap->id, false); ?>" class="btn-check" id="set_addon_product_<?php echo e($sap->id, false); ?>">
						<label class="btn btn-product-set" for="set_addon_product_<?php echo e($sap->id, false); ?>" style="padding:10px 16px;min-width:120px;flex:1 1 auto;max-width:calc(33.333% - 6px);display:inline-flex;align-items:center;justify-content:center;text-align:center;white-space:normal;word-break:break-word;font-size:13px;border-radius:6px;line-height:1.3;">
							<?php echo e($sap->product->name, false); ?> <?php if($sap->name != 'DUMMY'): ?> (<?php echo e($sap->name, false); ?>) <?php endif; ?>
						</label>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					</div>
				</div>
			</div>
        </div>

    </div>

    <div class="modal-footer" style="border-top:1px solid #e9ecef;padding:10px 20px;gap:8px;">
      <button type="button" class="btn btn-primary btn-sm quick_menu_add_set_products" data-set-name="<?php echo e($set_name, false); ?>" style="min-width:80px;"><?php echo app('translator')->get( 'messages.add' ); ?></button>
      <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal" style="min-width:80px;"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
