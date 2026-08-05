<?php if(!$model->container): ?>
	<?php echo $__env->make('charts::_partials.container.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('charts::_partials.loader.container-top', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<div id="<?php echo e($model->id, false); ?>" style="<?php echo $__env->make('charts::_partials.dimension.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>" class="ct-chart ct-perfect-fourth"></div>
	<?php echo $__env->make('charts::_partials.loader.container-bottom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
