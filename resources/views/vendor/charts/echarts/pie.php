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

            top: 50,
            data: [
                <?php $__currentLoopData = $model->labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    "<?php echo $label; ?>",
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ]
        },
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
        series: [{
            name: "<?php echo $model->element_label; ?>",
            type: 'pie',
            data: [
                <?php for($i = 0; count($model->values) > $i; $i++): ?>
                    {value: <?php echo e($model->values[$i], false); ?>, name: "<?php echo e($model->labels[$i], false); ?>" },
                <?php endfor; ?>
            ],
            animationDelay: function (idx) {
                return idx * 100;
            }
        }],
    });
</script>
