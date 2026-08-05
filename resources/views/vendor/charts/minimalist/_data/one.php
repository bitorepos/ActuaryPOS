var data = [
    <?php for($i = 0; $i < count($model->values); $i++): ?>
        {
            x: "<?php echo $model->labels[$i]; ?>",
            y: <?php echo e($model->values[$i], false); ?>,
        },
    <?php endfor; ?>
];
