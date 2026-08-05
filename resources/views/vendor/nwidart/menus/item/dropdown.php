<li class="dropdown <?php echo e($item->hasActiveOnChild() ? 'active' : '', false); ?>">
  <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
    <?php echo e($item->title, false); ?>

    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu" role="menu">
    <?php $__currentLoopData = $item->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    	<?php if($child->hasChilds()): ?>
  			<?php echo $__env->make('menus::child.dropdown', ['item' => $child], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    	<?php else: ?>
  			<?php echo $__env->make('menus::item.item', ['item' => $child], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    	<?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>
</li>
