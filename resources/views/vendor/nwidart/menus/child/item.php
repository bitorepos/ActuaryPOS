<?php if($item->isDivider()): ?>
	<li class="divider"></li>
<?php elseif($item->isHeader()): ?>
	<li class="dropdown-header"><?php echo e($item->title, false); ?></li>
<?php else: ?>
	<li class="<?php echo e($item->isActive() ? 'active' : '', false); ?>">
		<a tabindex="-1" href="<?php echo e($item->getUrl(), false); ?>">
			<?php echo e($item->title, false); ?>

		</a>
	</li>
<?php endif; ?>
