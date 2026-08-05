<?php if(!$model->container): ?>
	<div>
		<?php if($model->title): ?>
			<center>
				<strong><?php echo e($model->title, false); ?></strong>
			</center>
		<?php endif; ?>
	</div>
<?php endif; ?>
