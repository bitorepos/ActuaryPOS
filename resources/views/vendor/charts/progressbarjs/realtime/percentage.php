<?php ($min = count($model->values) >= 2 ? $model->values[1] : 0); ?>
<?php ($max = count($model->values) >= 3 ? $model->values[2] : 100); ?>

<?php echo $__env->make('charts::_partials.container.div-titled', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('charts::_partials.dimension.svg', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
    $(function() {
        var <?php echo e($model->id, false); ?> = new ProgressBar.Circle('#<?php echo e($model->id, false); ?>', {
            <?php if($model->colors and count($model->colors) >= 2): ?>
                color: <?php echo e($model->colors[1], false); ?>,
            <?php else: ?>
                color: '#000',
            <?php endif; ?>
            // This has to be the same size as the maximum width to
            // prevent clipping
            strokeWidth: 4,
            trailWidth: 1,
            easing: 'easeInOut',
            duration: 1000,
            text: {
                autoStyleContainer: false
            },
            from: { color: '#aaa', width: 4 },
            to: { color: "<?php echo e($model->colors ? $model->colors[0] : '#333', false); ?>", width: 4 },
            // Set default step function for all animate calls
            step: function(state, circle) {
                circle.path.setAttribute('stroke', state.color)
                circle.path.setAttribute('stroke-width', state.width)
            }
        })

        <?php echo e($model->id, false); ?>.animate(<?php echo e(($model->values[0] - $min) / ($max - $min), false); ?>)

        setInterval(function() {
            $.getJSON("<?php echo e($model->url, false); ?>", function( jdata ) {
                var v = (jdata["<?php echo e($model->value_name, false); ?>"] - <?php echo e($min, false); ?>)/(<?php echo e($max, false); ?> - <?php echo e($min, false); ?>);
                <?php echo e($model->id, false); ?>.animate(v);
            })
        }, <?php echo e($model->interval, false); ?>)
    });
</script>
