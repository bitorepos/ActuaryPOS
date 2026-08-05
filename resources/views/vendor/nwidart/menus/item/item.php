<?php if($item->isDivider()): ?>
	<li class="divider"></li>
<?php elseif($item->isHeader()): ?>
	<li class="dropdown-header"><?php echo e($item->title, false); ?></li>
<?php else: ?>
	<li class="<?php echo e($item->isActive() ? 'active' : '', false); ?>">
	  <a href="<?php echo e($item->getUrl(), false); ?>" <?php echo $item->getAttributes(); ?>>
	  	<?php echo $item->getIcon(); ?>

	    <?php echo e($item->title, false); ?>

	  </a>
	</li>
<?php endif; ?>
