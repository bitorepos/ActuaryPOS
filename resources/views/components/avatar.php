<?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php if($loop->iteration < $max_count): ?>
		<?php if(isset($member->media->display_url)): ?>
			<img class="user_avatar" src="<?php echo e($member->media->display_url, false); ?>" data-bs-toggle="tooltip" title="<?php echo e($member->user_full_name, false); ?>">
		<?php else: ?>
			<?php if(config('constants.is_offline')): ?>
				<img class="user_avatar" src="data:image/svg+xml,<?php echo e(rawurlencode('<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;128&quot; height=&quot;128&quot;><rect width=&quot;128&quot; height=&quot;128&quot; fill=&quot;#6c757d&quot;/><text x=&quot;50%&quot; y=&quot;54%&quot; dominant-baseline=&quot;middle&quot; text-anchor=&quot;middle&quot; fill=&quot;#fff&quot; font-size=&quot;64&quot; font-family=&quot;Arial,sans-serif&quot;>' . strtoupper(mb_substr($member->first_name, 0, 1)) . '</text></svg>'), false); ?>" data-bs-toggle="tooltip" title="<?php echo e($member->user_full_name, false); ?>">
			<?php else: ?>
				<img class="user_avatar" src="https://ui-avatars.com/api/?name=<?php echo e($member->first_name, false); ?>" data-bs-toggle="tooltip" title="<?php echo e($member->user_full_name, false); ?>">
			<?php endif; ?>
		<?php endif; ?>
	<?php elseif($loop->iteration == $max_count): ?>
		<?php if(config('constants.is_offline')): ?>
			<img class="user_avatar" src="data:image/svg+xml,<?php echo e(rawurlencode('<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;128&quot; height=&quot;128&quot;><rect width=&quot;128&quot; height=&quot;128&quot; fill=&quot;#6c757d&quot;/><text x=&quot;50%&quot; y=&quot;54%&quot; dominant-baseline=&quot;middle&quot; text-anchor=&quot;middle&quot; fill=&quot;#fff&quot; font-size=&quot;64&quot; font-family=&quot;Arial,sans-serif&quot;>...</text></svg>'), false); ?>" data-bs-toggle="tooltip" title="...">
		<?php else: ?>
			<img class="user_avatar" src="https://ui-avatars.com/api/?name=...." data-bs-toggle="tooltip" title="...">
		<?php endif; ?>
	<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
