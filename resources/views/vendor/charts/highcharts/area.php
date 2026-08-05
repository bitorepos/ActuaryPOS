<script type="text/javascript">
    $(function () {
        var <?php echo e($model->id, false); ?> = new Highcharts.Chart({
            chart: {
                type: 'area',
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
                title: {
                    text: "<?php echo $model->x_axis_title; ?>"
                },
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
                data: [
                    <?php $__currentLoopData = $model->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($dta, false); ?>,
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ]
            }]
        })
    });
</script>

<?php if(!$model->customId): ?>
    <?php echo $__env->make('charts::_partials.container.div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
