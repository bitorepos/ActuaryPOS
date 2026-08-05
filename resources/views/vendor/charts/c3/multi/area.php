<?php echo $__env->make('charts::_partials.container.div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
var <?php echo e($model->id, false); ?> = c3.generate({
    bindto: '#<?php echo e($model->id, false); ?>',
    data: {
        columns: [
            <?php $__currentLoopData = $model->datasets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                ["<?php echo e($ds['label'], false); ?>",<?php $__currentLoopData = $ds['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($value, false); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ],
        type: 'area',
    },
    axis: {
        x: {
            type: 'category',
            categories: [<?php $__currentLoopData = $model->labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>"<?php echo $label; ?>",<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>]
        },
        y: {
            label: {
                text: "<?php echo $model->element_label; ?>",
                position: 'outer-middle',
            }
        },
    },
    <?php if($model->title): ?>
    title: {
        text:  "<?php echo $model->title; ?>",
        x: -20 //center
    },
    <?php endif; ?>
});
</script>
