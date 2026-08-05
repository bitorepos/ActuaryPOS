<?php for($i = 0; $i < count($model->datasets); $i++): ?>
    var s<?php echo e($i, false); ?> = [
        <?php for($k = 0; $k < count($model->datasets[$i]['values']); $k++): ?>
            {
                x: "<?php echo e($model->labels[$k], false); ?>",
                y: <?php echo e($model->datasets[$i]['values'][$k], false); ?>,
            },
        <?php endfor; ?>
    ];
<?php endfor; ?>
