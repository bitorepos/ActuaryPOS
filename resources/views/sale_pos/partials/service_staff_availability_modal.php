<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><?php echo app('translator')->get('lang_v1.service_staff_availability_status'); ?></h4>
		</div>
		<div class="modal-body overlay-wrapper">
			<div class="row eq-height-row">
				<?php $__currentLoopData = $service_staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service_staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
	            		$is_available = true;

	            		if(!empty($service_staff->available_at) && \Carbon::parse($service_staff->available_at)->gt(\Carbon::now()) && empty($service_staff->paused_at)) {
	            			$is_available = false;
	            		}
	            	?>
					<div class="col-md-3 col-6 eq-height-col">
						<div class="small-box <?php if($is_available && empty($service_staff->paused_at)): ?> bg-green <?php elseif(!empty($service_staff->paused_at)): ?> bg-gray <?php else: ?>  bg-yellow <?php endif; ?> width-100">
				            <div class="inner">
				            	<img src="<?php echo e($service_staff->image_url, false); ?>" alt="Profile photo" style="width: 100%;">
				            	<p class="text-center text-white"><?php echo e($service_staff->username, false); ?></p>
				            	<h4 class="text-center text-white"><i class="fas fa-user"></i> <?php echo e($service_staff->user_full_name, false); ?></h4>
				            	
				            	<?php if(!$is_available): ?>
				            		<h4 class="text-center text-white">
				            			<?php echo e(\Carbon::now()->diff(\Carbon::parse($service_staff->available_at))->format('%H:%I'), false); ?>

				            		</h4>
				            		<p class="text-center text-white"><?php echo app('translator')->get('lang_v1.will_be_available_at'); ?> <?php echo e(\Carbon::parse($service_staff->available_at)->format('H:i'), false); ?></p>
				            	<?php elseif(!empty($service_staff->paused_at)): ?>
				            		<h4 class="text-center text-white"><i class="fa fa-pause-circle"></i> <?php echo app('translator')->get('lang_v1.paused'); ?></h4>
				            		<?php
				            			$is_available = false;
				            		?>
				            	<?php else: ?>
				            		<h4 class="text-center text-white" style="margin-top: 35%;"><?php echo app('translator')->get('lang_v1.available'); ?></h4>
				            	<?php endif; ?>
				            </div>
				            <?php if(!$is_available): ?>
				            <div <?php if(!empty($service_staff->paused_at)): ?> style="position: absolute; bottom: 0;" <?php endif; ?>>
				            	<a class="btn btn-flat small-box-footer bg-light-blue mark_as_available width-100" href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'markAsAvailable'], [$service_staff->id]), false); ?>"><?php echo app('translator')->get('lang_v1.mark_as_available'); ?> <i class="fa fa-arrow-circle-right"></i></a>

				            	<?php if(empty($service_staff->paused_at)): ?>
			            			<button type="button" class="btn btn-flat small-box-footer bg-red pause_resume_timer width-100" data-href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'pauseResumeServiceStaffTimer'], [$service_staff->id]), false); ?>"><?php echo app('translator')->get('lang_v1.pause_timer'); ?> <i class="fa fa-pause-circle"></i></button>
			            		<?php else: ?>
			            			<button type="button" class="btn btn-flat small-box-footer bg-green pause_resume_timer width-100" data-href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'pauseResumeServiceStaffTimer'], [$service_staff->id]), false); ?>"><?php echo app('translator')->get('lang_v1.resume_timer'); ?> <i class="fa fa-redo"></i></button>
			            		<?php endif; ?>
			            	</div>
				            <?php endif; ?>
				         </div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
			<div class="overlay hide">
				<i class="fa fas fa-sync fa-spin"></i>
			</div>
		</div>

		<div class="modal-footer">
			<button type="button" id="refresh_service_staff_availability_status" title="<?php echo app('translator')->get('lang_v1.refresh'); ?>" class="btn btn-success"><i class="fas fa-redo"></i> <?php echo app('translator')->get('lang_v1.refresh'); ?></button>

		    <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
		</div>
	</div>
</div>
