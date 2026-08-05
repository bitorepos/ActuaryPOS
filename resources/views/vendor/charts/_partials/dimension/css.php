<?php if($model->responsive): ?>
    height: 100%; width: 100%;
<?php else: ?>
    <?php if($model->height): ?>
        height: <?php echo e($model->height, false); ?>px;
    <?php endif; ?>

    <?php if($model->width): ?>
        width: <?php echo e($model->width, false); ?>px;
    <?php endif; ?>
<?php endif; ?>
