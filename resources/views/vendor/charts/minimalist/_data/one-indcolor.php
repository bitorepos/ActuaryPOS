var data = [
    <?php for($i = 0; $i < count($model->values); $i++): ?>
        {
            x: "<?php echo $model->labels[$i]; ?>",
            y: <?php echo e($model->values[$i], false); ?>,
            <?php if($model->colors): ?>
                color: "<?php echo e($model->colors[$i], false); ?>"
            <?php endif; ?>
        },
    <?php endfor; ?>
];
