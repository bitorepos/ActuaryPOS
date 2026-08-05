<?php echo $__env->make('charts::_partials/container.div-titled', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">
    $(function() {
        Morris.Area({
            element: "<?php echo e($model->id, false); ?>",
            resize: true,
            data: [
                <?php for($i = 0; $i < count($model->values); $i++): ?>
                    {
                        x: "<?php echo $model->labels[$i]; ?>",
                        y: <?php echo e($model->values[$i], false); ?>

                    },
                <?php endfor; ?>
            ],
            xkey: 'x',
            ykeys: ['y'],
            labels: ["<?php echo $model->element_label; ?>"],
            hideHover: 'auto',
            parseTime: false,
            <?php if($model->colors): ?>
                lineColors: ["<?php echo e($model->colors[0], false); ?>"],
            <?php endif; ?>
        })
    });
</script>
