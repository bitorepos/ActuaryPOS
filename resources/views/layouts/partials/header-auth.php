<?php $request = app('Illuminate\Http\Request'); ?>

<div class="container-fluid">
	<div class="d-flex justify-content-between align-items-center p-3">
		<div>
			<select class="form-select form-select-sm" id="change_lang" style="min-width: 140px;">
				<?php $__currentLoopData = config('constants.langs'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($key, false); ?>" 
						<?php if( (empty(request()->lang) && config('app.locale') == $key) 
						|| request()->lang == $key): ?> 
							selected 
						<?php endif; ?>
					>
						<?php echo e($val['full_name'], false); ?>

					</option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
		<div class="d-flex gap-2 align-items-center">
			<?php if(!($request->segment(1) == 'business' && $request->segment(2) == 'register')): ?>
				<?php if(config('constants.allow_registration')): ?>
					<a 
						href="<?php echo e(registration_url(['lang' => request()->lang]), false); ?>"
						class="btn btn-sm btn-outline-primary"
					><?php echo e(__('business.not_yet_registered'), false); ?> <?php echo e(__('business.register_now'), false); ?></a>

					<?php if(Route::has('pricing') && config('app.env') != 'demo' && $request->segment(1) != 'pricing' && empty(\App\System::getProperty('disable_pricing'))): ?>
						<a class="btn btn-sm btn-outline-info" href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PricingController::class, 'index']), false); ?>"><?php echo app('translator')->get('superadmin::lang.pricing'); ?></a>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>

			<?php if(!($request->segment(1) == 'business' && $request->segment(2) == 'register') && $request->segment(1) != 'login'): ?>
				<span class="text-muted"><?php echo e(__('business.already_registered'), false); ?></span>
				<a href="<?php echo e(action([\App\Http\Controllers\Auth\LoginController::class, 'login']), false); ?><?php if(!empty(request()->lang)): ?><?php echo e('?lang=' . request()->lang, false); ?> <?php endif; ?>" class="btn btn-sm btn-primary"><?php echo e(__('business.sign_in'), false); ?></a>
			<?php endif; ?>
		</div>
	</div>
</div>
