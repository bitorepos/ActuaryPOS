<?php if(isset($available_widgets[$widget])): ?>
	<div class="col-md-12 draggable" data-type="<?php echo e($widget, false); ?>">
		<?php echo e($available_widgets[$widget]['title'], false); ?>

	</div>
<?php endif; ?>
