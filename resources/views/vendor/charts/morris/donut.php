<?php echo $__env->make('charts::_partials/container.div-titled', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">
    $(function (){
        Morris.Donut({
            element: "<?php echo e($model->id, false); ?>",
            resize: true,
            data: [
                <?php for($i = 0; $i < count($model->values); $i++): ?>
                    {
                        label: "<?php echo $model->labels[$i]; ?>",
                        value: "<?php echo e($model->values[$i], false); ?>"
                    },
                <?php endfor; ?>
            ],
            <?php if($model->colors): ?>
                colors: [
                    <?php $__currentLoopData = $model->colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        "<?php echo e($c, false); ?>",
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ]
            <?php endif; ?>
        })
    });
</script>
