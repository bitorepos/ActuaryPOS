<?php ($min = count($model->values) >= 2 ? $model->values[1] : 0); ?>
<?php ($max = count($model->values) >= 3 ? $model->values[2] : 100); ?>

<?php echo $__env->make('charts::_partials.container.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="<?php echo e($model->id, false); ?>" style="position: relative;<?php echo $__env->make('charts::_partials.dimension.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>"></div>

<script type="text/javascript">
    $(function() {
        var <?php echo e($model->id, false); ?> = new ProgressBar.Line('#<?php echo e($model->id, false); ?>', {
            <?php if($model->colors): ?>
                color: "<?php echo e($model->colors[0], false); ?>",
            <?php else: ?>
                color: '#ffc107',
            <?php endif; ?>
            strokeWidth: 4,
            svgStyle: {width: '100%', height: '100%'},
            easing: 'easeInOut',
            duration: 1000,
            trailColor: '#eee',
            trailWidth: 4,
        })

        <?php echo e($model->id, false); ?>.animate(<?php echo e(($model->values[0] - $min) / ($max - $min), false); ?>)

        setInterval(function() {
            $.getJSON("<?php echo e($model->url, false); ?>", function( jdata ) {
                var v = (jdata["<?php echo e($model->value_name, false); ?>"] - <?php echo e($min, false); ?>)/(<?php echo e($max, false); ?> - <?php echo e($min, false); ?>)
                <?php echo e($model->id, false); ?>.animate(v)
            })
        }, <?php echo e($model->interval, false); ?>)
    });
</script>
