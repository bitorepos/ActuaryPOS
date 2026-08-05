<?php
	$ratios = explode('-', $row['ratio']);
?>

<div class="row border-1px-173" data-ratio="<?php echo e($row['ratio'], false); ?>">
	<div style="width:97% !important; float:left; display:flex">
		<?php $__currentLoopData = $ratios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ratio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="droppable cell col-md-<?php echo e($ratio, false); ?>">
				<?php if(empty($row['widgets'][$key])): ?>
					<div class="add_a_widget">
						<?php echo e(__("lang_v1.add_widget_here"), false); ?>

					</div>
				<?php else: ?>
					<?php $__currentLoopData = $row['widgets'][$key]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php echo $__env->make('dashboard_configurator.partials.widget', ['widget' => $widget], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
	<div style="width:3% !important; display:inline; float:right; text-align:center">
		<i class="fas fa-grip-horizontal handle cursor-pointer" 
			title='<?php echo e(__("lang_v1.move_row"), false); ?>'></i>
		<i class="fas fa-times remove_row text-danger cursor-pointer" title='<?php echo e(__("messages.delete"), false); ?>'></i>
	</div>
</div>
