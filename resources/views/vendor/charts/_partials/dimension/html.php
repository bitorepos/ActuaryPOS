<?php if($model->responsive): ?>
    height="100%" width="100%"
<?php else: ?>
    <?php if($model->height): ?>
        height="<?php echo e($model->height, false); ?>"
    <?php endif; ?>

    <?php if($model->width): ?>
        width="<?php echo e($model->width, false); ?>"
    <?php endif; ?>
<?php endif; ?>
