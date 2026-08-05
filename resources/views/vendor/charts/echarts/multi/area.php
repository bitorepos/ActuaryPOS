<?php if(!$model->customId): ?>
    <?php echo $__env->make('charts::_partials.container.div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<script type="text/javascript">
    var <?php echo e($model->id, false); ?> = echarts.init(document.getElementById("<?php echo e($model->id, false); ?>"));

    <?php echo e($model->id, false); ?>.setOption({
        title: {
            text: "<?php echo $model->title; ?>"
        },
        tooltip: {},
        toolbox: {
            right: 30,
            feature: {
                <?php if($model->export): ?>
                    saveAsImage: {
                        title: 'Save as image',
                    }
                <?php endif; ?>
            }
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            top: 50,
            data: [
                <?php $__currentLoopData = $model->datasets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    "<?php echo $ds['label']; ?>",
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ]
        },
        xAxis: {
            data: [
                <?php $__currentLoopData = $model->labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    "<?php echo $label; ?>",
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ]
        },
        yAxis: {},
        <?php if(count($model->colors) > 0): ?>
            color: [
                <?php $__currentLoopData = $model->colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    "<?php echo e($color, false); ?>",
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ],
        <?php endif; ?>
        <?php if($model->background_color): ?>
            backgroundColor: "<?php echo e($model->background_color, false); ?>",
        <?php endif; ?>
        series: [
            <?php $__currentLoopData = $model->datasets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                    name: "<?php echo $ds['label']; ?>",
                    type: 'line',
                    areaStyle: {
                        normal: {
                            color: "<?php echo e($model->colors[$loop->index], false); ?>",
                        }
                    },
                    data: [
                        <?php $__currentLoopData = $ds['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($dta, false); ?>,
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ],
                    animationDelay: function (idx) {
                        return idx * 100;
                    }
                },
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ],
    });
</script>
