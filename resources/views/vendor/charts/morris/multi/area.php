<?php echo $__env->make('charts::_partials/container.div-titled', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">
    $(function (){
        Morris.Area({
            element: "<?php echo e($model->id, false); ?>",
            resize: true,
            data: [
                <?php for($k = 0; $k < count($model->labels); $k++): ?>
                    {
                        x: "<?php echo e($model->labels[$k], false); ?>",
                        <?php for($i = 0; $i < count($model->datasets); $i++): ?>
                            s<?php echo e($i, false); ?>: "<?php echo e($model->datasets[$i]['values'][$k], false); ?>",
                        <?php endfor; ?>
                    },
                <?php endfor; ?>
            ],
            xkey: 'x',
            labels: [
                <?php for($i = 0; $i < count($model->datasets); $i++): ?>
                    "<?php echo e($model->datasets[$i]['label'], false); ?>",
                <?php endfor; ?>
            ],
            ykeys: [
                <?php for($i = 0; $i < count($model->datasets); $i++): ?>
                    "s<?php echo e($i, false); ?>",
                <?php endfor; ?>
            ],
            hideHover: 'auto',
            parseTime: false,
            <?php if($model->colors): ?>
                lineColors: [
                    <?php $__currentLoopData = $model->colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        "<?php echo e($c, false); ?>",
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
            <?php endif; ?>
        })
    });
</script>
