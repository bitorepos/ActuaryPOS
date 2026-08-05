<li class="dropdown-submenu <?php echo e($item->hasActiveOnChild() ? 'active' : '', false); ?>">
	<a tabindex="-1" href="#"><?php echo e($child->title, false); ?></a>
	<ul class="dropdown-menu">
		<?php $__currentLoopData = $child->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if($item->hasChilds()): ?>
				<?php echo $__env->make('menus::child.dropdown', ['child' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<?php else: ?>
				<?php echo $__env->make('menus::child.item', compact('item'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
</li>
