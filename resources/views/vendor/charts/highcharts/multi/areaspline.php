<script type="text/javascript">
    $(function () {
        var <?php echo e($model->id, false); ?> = new Highcharts.Chart({
            chart: {
                type: 'areaspline',
                renderTo:  "<?php echo e($model->id, false); ?>",
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
                categories: [
                    <?php $__currentLoopData = $model->labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        "<?php echo $label; ?>",
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ]
            },
            yAxis: {
                title: {
                    text: "<?php echo $model->y_axis_title === null ? $model->element_label : $model->y_axis_title; ?>"
                },
            },
            legend: {
                <?php if(!$model->legend): ?>
                    enabled: false,
                <?php endif; ?>
            },
            tooltip: {
                shared: true,
                valueSuffix: ' units'
            },
             plotOptions: {
                areaspline: {
                    fillOpacity: 0.5
                }
            },
            series: [
                <?php for($i = 0; $i < count($model->datasets); $i++): ?>
                    {
                        name:  "<?php echo $model->datasets[$i]['label']; ?>",
                        <?php if($model->colors && count($model->colors) > $i): ?>
                            color: "<?php echo e($model->colors[$i], false); ?>",
                        <?php endif; ?>
                        data: [
                            <?php $__currentLoopData = $model->datasets[$i]['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($dta, false); ?>,
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        ]
                    },
                <?php endfor; ?>
            ]
        })
    });
</script>

<?php if(!$model->customId): ?>
    <?php echo $__env->make('charts::_partials.container.div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
