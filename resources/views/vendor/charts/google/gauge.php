<script type="text/javascript">
    google.charts.setOnLoadCallback(draw<?php echo e($model->id, false); ?>)

    function draw<?php echo e($model->id, false); ?>() {
        var data = google.visualization.arrayToDataTable([
            ['Element', 'Value'],
            ["<?php echo $model->element_label; ?>", <?php echo e($model->values[0], false); ?>],
        ])

        var options = {
            <?php echo $__env->make('charts::_partials.dimension.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(count($model->values) >= 2 and $model->values[1] <= $model->values[0]): ?>
                <?php($min = $model->values[1])
                min: {{ $min }},
            @else
                @php($min = 0)
            @endif

            @if(count($model->values) >= 3 and $model->values[2] >= $model->values[0])
                @php($max = $model->values[2])
                max: {{ $max }},
            @else
                @php($max = 100)
            @endif

            @if($model->gauge_style == 'right')
                // Calculate warning area
                @php
                    $low_warning = round(0.40 * $max, 2)
                    $warning = round(0.25 * $max, 2)
                    $max_warning = round(0.10 * $max, 2)
                ?>

                greenColor: '#c8e6c9', yellowColor: '#ffd54f', redColor: '#e57373',
                greenFrom: $low_warning, greenTo: $max,
                yellowFrom: $max_warning, yellowTo: $low_warning,
                redFrom: $min, redTo: $max_warning,
            <?php elseif($model->gauge_style == 'center'): ?> {
                // Calculate warning area
                <?php
                    $warning = round(0.25 * $max, 2)
                    $warning2 = round(0.75 * $max, 2)
                ?>

                greenColor: '#c8e6c9', yellowColor: '#ffd54f', redColor: '#ffd54f',
                greenFrom: $warning, greenTo: $warning2,
                yellowFrom: $min, yellowTo: $warning,
                redFrom: $warning2, redTo: $max,
            <?php else: ?>
                // Calculate warning area
                <?php
                    $low_warning = round(0.60 * $max, 2)
                    $warning = round(0.75 * $max, 2)
                    $max_warning = round(0.90 * $max, 2)
                ?>

                greenColor: '#c8e6c9', yellowColor: '#ffd54f', redColor: '#e57373',
                greenFrom: $min, greenTo: $low_warning,
                yellowFrom: $low_warning, yellowTo: $max_warning,
                redFrom: $max_warning, redTo: $max,
            <?php endif; ?>

            minorTicks: 10,
        };

        var <?php echo e($model->id, false); ?> = new google.visualization.Gauge(document.getElementById("<?php echo e($model->id, false); ?>"))
        <?php echo e($model->id, false); ?>.draw(data, options)
    }
</script>

<?php if(!$model->customId): ?>
    <?php echo $__env->make('charts::_partials/container.div-titled', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
