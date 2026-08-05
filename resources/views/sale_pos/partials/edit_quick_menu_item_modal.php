<div class="modal-dialog modal-lg" role="document">
	<?php echo Form::open(['url' => action([\App\Http\Controllers\QuickMenuItemController::class, 'store']), 
	'method' => 'post', 'id' => 'edit_quick_menu_item_modal_form', 'files'=>true]); ?>

		<div class="modal-content" style="border:none;border-radius:10px;overflow:hidden;">
			<div class="modal-header" style="position:sticky;top:0;z-index:10;background:#fff;border-bottom:1px solid #e9ecef;padding:14px 20px;">
				<h5 class="modal-title fw-bold" style="font-size:16px;">
					<i class="fas fa-edit text-primary me-1"></i> Edit Item <?php echo e($item_data->position, false); ?> of <?php echo e($menu_head->name, false); ?>

				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" style="max-height:65vh;overflow-y:auto;padding:20px 24px;">
				<div class="row g-3 align-items-end">
					<div class="col-md-4">
				        <div class="mb-0">
				            <?php echo Form::label('item_type', 'Item Type:', ['class'=>'form-label fw-semibold small mb-1']); ?>

				            <?php echo Form::select('item_type', ['Product' => 'Product', 'Table'=> 'Table', 'Product Set'=> 'Product Set'], !empty($item_data->item_type) ? $item_data->item_type : 'Product', ['id'=>'menu_item_type','class' => 'form-select']); ?>

				        </div>
				    </div>
					<div id="menu_item_type_content" class="col-12">
						<div class="row g-3 align-items-end">
						<?php if($item_data->item_type == 'Product'): ?>
							<?php echo $__env->make('sale_pos.partials.quick_menu_item_type_product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php elseif($item_data->item_type == 'Product Set'): ?>
							<?php echo $__env->make('sale_pos.partials.quick_menu_item_type_product_set', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php elseif($item_data->item_type == 'Table'): ?>
							<?php echo $__env->make('sale_pos.partials.quick_menu_item_type_table', [$tables, $invoice_layouts], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php endif; ?>
						</div>
					</div>
					<div class="col-md-12">
						<?php echo Form::hidden('menu_item_id', $item_data->id, ['id'=>'current_menu_item_id']); ?>

						<?php echo Form::hidden('menu_no', $menu_no); ?>

						<?php echo Form::hidden('parent_id', $item_data->parent_id , ['id'=>'parent_menu_id']); ?>

						<?php echo Form::hidden('item_color', $item_color , ['id'=>'parent_menu_item_color']); ?>

						<?php echo Form::hidden('quick_menu_id', $item_data->quick_menu_id); ?>

						<?php echo Form::hidden('position', $item_data->position); ?>

						<?php echo Form::hidden('type', $item_data->type); ?> 
						<?php echo Form::hidden('item_type_id', !empty($item_data->item_type_id) ? $item_data->item_type_id : '', ['id'=> 'item_type_id']); ?>

					</div>
				</div>
			</div>
			<div class="modal-footer" style="position:sticky;bottom:0;z-index:10;background:#fff;border-top:1px solid #e9ecef;padding:12px 20px;">
				<button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i><?php echo app('translator')->get('messages.cancel'); ?></button>
				<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check me-1"></i><?php echo app('translator')->get('messages.update'); ?></button>
			</div>
		</div>
		<?php echo Form::close(); ?>

</div>
