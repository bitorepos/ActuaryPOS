<script type="text/javascript">
    $(function () {
        Highcharts.setOptions({global: { useUTC: false } })

        <?php echo e($model->id, false); ?> = new Highcharts.Chart({
            chart: {
                renderTo:  "<?php echo e($model->id, false); ?>",
                events: {
                    load: update<?php echo e($model->id, false); ?>

                },
                <?php echo $__env->make('charts::_partials.dimension.js2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            },
            <?php if($model->title): ?>
                title: {
                    text:  "<?php echo $model->title; ?>",
                    x: -20 //center
                },
            <?php endif; ?>
            <?php if(!$model->credits): ?>
                credits: {
                    enabled: false
                },
            <?php endif; ?>
            xAxis: {
                type: 'datetime',
            },
            yAxis: {
                title: {
                    text: "<?php echo $model->element_label; ?>"
                },
                plotLines: [{
                    value: 0,
                    height: 0.5,
                    width: 1,
                    color: '#808080'
                }]
            },
            <?php if($model->colors): ?>
                plotOptions: {
                    series: {
                        color: "<?php echo e($model->colors[0], false); ?>"
                    }
                },
            <?php endif; ?>
            legend: {
                <?php if(!$model->legend): ?>
                    enabled: false,
                <?php endif; ?>
            },
            series: [{
                name: "<?php echo $model->element_label; ?>",
                data: [],
                pointStart: new Date().getTime(),
                pointInterval: <?php echo e(($model->interval / 1000) * 1000, false); ?> // one day
            }]
        })

        function update<?php echo e($model->id, false); ?>() {
            $.ajax({
                url:  "<?php echo e($model->url, false); ?>",
                success: function(point) {
                    var series = <?php echo e($model->id, false); ?>.series[0],
                        shift = series.data.length >= <?php echo e($model->max_values, false); ?>; // shift if the series is longer than 20

                    // add the point
                    <?php echo e($model->id, false); ?>.series[0].addPoint(point[ "<?php echo e($model->value_name, false); ?>"], true, shift)
                    <?php echo e($model->id, false); ?>.xAxis.categories

                    // call it again after one second
                    setTimeout(update<?php echo e($model->id, false); ?>, <?php echo e($model->interval, false); ?>)
                },
                cache: false
            })
        }
    });
</script>

<?php if(!$model->customId): ?>
    <?php echo $__env->make('charts::_partials.container.div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
