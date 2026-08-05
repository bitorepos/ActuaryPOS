<?php if(!$model->customId): ?>
    <?php echo $__env->make('charts::_partials.container.canvas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<script type="text/javascript">
    $(function (){
        var <?php echo e($model->id, false); ?> = new RadialGauge({
            renderTo: "<?php echo e($model->id, false); ?>",
            <?php if($model->colors): ?>
                colorNumbers: "<?php echo e($model->colors[0], false); ?>",
            <?php endif; ?>
            <?php echo $__env->make('charts::_partials.dimension.js2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if($model->title): ?>
                title: "<?php echo $model->title; ?>",
            <?php endif; ?>
            value: <?php echo e($model->values[0], false); ?>,
            units: "<?php echo $model->element_label; ?>",
            <?php if(count($model->values) >= 2 and $model->values[1] <= $model->values[0]): ?>
                <?php($min = $model->values[1])
                minValue: {{ $min }},
            @else
                @php($min = 0)
            @endif

            @if(count($model->values) >= 3 and $model->values[2] >= $model->values[0])
                @php($max = $model->values[2])
                maxValue: {{ $max }},
            @else
                @php($max = 100)
            @endif

            @php
                $interval = 10;
                $interval_adder = round($max / $interval, 2)
            ?>

            majorTicks: [
                <?php ($r = $min); ?>
                <?php for($i = 0; $i <= $interval; $i++): ?>
                    <?php if($i == 0): ?>
                        <?php echo e($min, false); ?>,
                    <?php elseif($i == $interval): ?>
                        <?php echo e($max, false); ?>,
                    <?php else: ?>
                        <?php echo e($r + $interval_adder, false); ?>,
                        <?php ($r = $r + $interval_adder); ?>
                    <?php endif; ?>
                <?php endfor; ?>
            ],

            animationRule: 'linear',
            highlights: [
                <?php if($model->gauge_style == 'right'): ?>
                    // Calculate warning area
                    <?php
                        $low_warning = round(0.40 * $max, 2);
                        $warning = round(0.25 * $max, 2);
                        $max_warning = round(0.10 * $max, 2);
                    ?>

                    { from: <?php echo e($low_warning, false); ?>, to: <?php echo e($max, false); ?>, color: 'rgba(0,258,0,.20)' },
                    { from: <?php echo e($warning, false); ?>, to: <?php echo e($low_warning, false); ?>, color: 'rgba(255,255,0,.35)' },
                    { from: <?php echo e($max_warning, false); ?>, to: <?php echo e($warning, false); ?>, color: 'rgba(255,69,0,.40)' },
                    { from: <?php echo e($min, false); ?>, to: <?php echo e($max_warning, false); ?>, color: 'rgba(255,0,0,.5)' },
                <?php elseif($model->gauge_style == 'center'): ?>
                    // Calculate warning area
                    <?php
                        $warning = round(0.10 * $max, 2);
                        $warning2 = round(0.25 * $max, 2);
                        $warning3 = round(0.40 * $max, 2);
                        $warning4 = round(0.60 * $max, 2);
                        $warning5 = round(0.75 * $max, 2);
                        $warning6 = round(0.90 * $max, 2);
                    ?>

                    { from: <?php echo e($warning3, false); ?>, to: <?php echo e($warning4, false); ?>, color: 'rgba(0,258,0,.20)' },
                    { from: <?php echo e($warning2, false); ?>, to: <?php echo e($warning3, false); ?>, color: 'rgba(255,255,0,.35)' },
                    { from: <?php echo e($warning4, false); ?>, to: <?php echo e($warning5, false); ?>, color: 'rgba(255,255,0,.35)' },
                    { from: <?php echo e($warning, false); ?>, to: <?php echo e($warning2, false); ?>, color: 'rgba(255,69,0,.40)' },
                    { from: <?php echo e($warning5, false); ?>, to: <?php echo e($warning6, false); ?>, color: 'rgba(255,69,0,.40)' },
                    { from: <?php echo e($min, false); ?>, to: <?php echo e($warning, false); ?>, color: 'rgba(255,0,0,.5)' },
                    { from: <?php echo e($warning6, false); ?>, to: <?php echo e($max, false); ?>, color: 'rgba(255,0,0,.5)' },
                <?php else: ?>
                    // Calculate warning area
                    <?php
                        $low_warning = round(0.60 * $max, 2);
                        $warning = round(0.75 * $max, 2);
                        $max_warning = round(0.90 * $max, 2);
                    ?>

                    { from: <?php echo e($min, false); ?>, to: <?php echo e($low_warning, false); ?>, color: 'rgba(0,258,0,.20)' },
                    { from: <?php echo e($low_warning, false); ?>, to: <?php echo e($warning, false); ?>, color: 'rgba(255,255,0,.35)' },
                    { from: <?php echo e($warning, false); ?>, to: <?php echo e($max_warning, false); ?>, color: 'rgba(255,69,0,.40)' },
                    { from: <?php echo e($max_warning, false); ?>, to: <?php echo e($max, false); ?>, color: 'rgba(255,0,0,.5)' },
                <?php endif; ?>
            ],
        }).draw()
    });
</script>
