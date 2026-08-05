<?php echo $__env->make('charts::_partials.container.div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">
    $(function() {
        var <?php echo e($model->id, false); ?> = new JustGage({
            id: "<?php echo e($model->id, false); ?>",
            value: <?php echo e($model->values ? $model->values[0] : '0', false); ?>,

            <?php if(count($model->values) >= 2 and $model->values[1] <= $model->values[0]): ?>
                <?php ($min = $model->values[1]); ?>
                min: <?php echo e($min, false); ?>,
            <?php else: ?>
                <?php ($min = 0); ?>
            <?php endif; ?>

            <?php if(count($model->values) >= 3 and $model->values[2] >= $model->values[0]): ?>
                <?php ($max = $model->values[2]); ?>
                max: <?php echo e($max, false); ?>,
            <?php else: ?>
                <?php ($max = 100); ?>
            <?php endif; ?>

            gaugeWidthScale: 0.6,
            pointer: true,
            counter: true,
            <?php if($model->title): ?>
                title:  "<?php echo $model->title; ?>",
            <?php endif; ?>
            label: "<?php echo $model->element_label; ?>",
            hideInnerShadow: true
        })

        setInterval(function() {
            $.getJSON("<?php echo e($model->url, false); ?>", function( jdata ) {
                <?php echo e($model->id, false); ?>.refresh(jdata["<?php echo e($model->value_name, false); ?>"])
            })
        }, <?php echo e($model->interval, false); ?>)
    });
</script>
