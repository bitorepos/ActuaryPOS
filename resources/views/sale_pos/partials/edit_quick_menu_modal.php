<div class="modal-dialog modal-lg" role="document">
	<?php echo Form::open(['url' => action([\App\Http\Controllers\QuickMenuItemController::class, 'store']), 
	'method' => 'post', 'id' => 'edit_quick_menu_modal_form', 'files'=>true]); ?>

		<div class="modal-content" style="border:none;border-radius:10px;overflow:hidden;">
			<div class="modal-header" style="position:sticky;top:0;z-index:10;background:#fff;border-bottom:1px solid #e9ecef;padding:14px 20px;">
				<h5 class="modal-title fw-bold" style="font-size:16px;">
					<i class="fas fa-pen-square text-primary me-1"></i> Edit Quick Menu — <?php echo e($menu_head->name, false); ?>

				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" style="max-height:65vh;overflow-y:auto;padding:20px 24px;">

				
				<div class="row g-3 align-items-end">
					<div class="col-md-5">
				        <div class="mb-0">
							<?php echo Form::label('name', __( 'business.quick_menu_name' ) . ':', ['class'=>'form-label fw-semibold small mb-1']); ?>

				            <?php echo Form::text('name', $menu_head->name, ['class' => 'form-control', 'placeholder' => __( 'business.quick_menu' ) ]); ?>

				        </div>
				    </div>
					<div class="col-md-4">
				        <div class="mb-0">
				            <?php echo Form::label('image', 'Image:', ['class'=>'form-label fw-semibold small mb-1']); ?>

				            <?php echo Form::file('image', ['id' => 'upload_image', 'accept' => 'image/*', 'class' => 'form-control form-control-sm',]); ?>

				        </div>
				    </div>
					<div class="col-md-3">
				        <div class="form-check mb-0 pt-1">
				            <?php echo Form::checkbox('remove_image', 1, false, ['class'=>'form-check-input', 'id'=>'remove_image']); ?>

				            <?php echo Form::label('remove_image', 'Remove Image', ['class'=>'form-check-label small']); ?>

				        </div>
				    </div>
				</div>

				<hr class="my-3" style="border-color:#e9ecef;">

				
				<div class="row g-3 align-items-end">
					<div class="col-md-2">
				        <div class="mb-0">
				            <?php echo Form::label('settings[font_size]', 'Font Size:', ['class'=>'form-label fw-semibold small mb-1']); ?>

				            <?php echo Form::number('settings[font_size]', !empty($menu_head->settings->font_size) ? $menu_head->settings->font_size : 14, ['class' => 'form-control' ]); ?>

				        </div>
				    </div>
					<div class="col-md-3">
						<div class="mb-0">
							<?php echo Form::label('settings[menu_color]', 'Menu Color:', ['class'=>'form-label fw-semibold small mb-1']); ?>

							<?php echo Form::color('settings[menu_color]', !empty($menu_head->settings->menu_color) ? $menu_head->settings->menu_color : $menu_color, ['class' => 'form-control form-control-color', 'style'=>'height:38px;']); ?>

						</div>
				    </div>
					<div class="col-md-2">
				        <div class="form-check mb-0 pt-1">
				            <?php echo Form::checkbox('settings[is_bold]', 1, !empty($menu_head->settings->is_bold) ? true : false, ['class'=>'form-check-input', 'id'=>'settings_is_bold']); ?>

				            <?php echo Form::label('settings[is_bold]', 'Is Bold', ['class'=>'form-check-label small', 'for'=>'settings_is_bold']); ?>

				        </div>
				    </div>
					<div class="col-md-2">
				        <div class="form-check mb-0 pt-1">
				            <?php echo Form::checkbox('settings[hide_menu]', 1, !empty($menu_head->settings->hide_menu) ? true : false, ['class'=>'form-check-input', 'id'=>'settings_hide_menu']); ?>

				            <?php echo Form::label('settings[hide_menu]', 'Hide Menu', ['class'=>'form-check-label small', 'for'=>'settings_hide_menu']); ?>

				        </div>
				    </div>
					<div class="col-md-3">
				        <div class="form-check mb-0 pt-1">
				            <?php echo Form::checkbox('apply_all', 1, !empty($menu_head->apply_all) ? true : false, ['class'=>'form-check-input', 'id'=>'apply_all']); ?>

				            <?php echo Form::label('apply_all', 'Apply on Whole Menu', ['class'=>'form-check-label small', 'for'=>'apply_all']); ?>

				        </div>
				    </div>
				</div>

			</div>
			<div class="modal-footer" style="position:sticky;bottom:0;z-index:10;background:#fff;border-top:1px solid #e9ecef;padding:12px 20px;">
				<?php echo Form::hidden('menu_id', $menu_head->id); ?>

				<?php echo Form::hidden('qm_menu_id', $menu_head->quick_menu_id); ?>

				<?php echo Form::hidden('menu_no', $menu_no); ?>

				<?php echo Form::hidden('type', 'Menu'); ?>

				<button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i><?php echo app('translator')->get('messages.cancel'); ?></button>
				<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check me-1"></i><?php echo app('translator')->get('messages.update'); ?></button>
			</div>
		</div>
		<?php echo Form::close(); ?>

</div>
