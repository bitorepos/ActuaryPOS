<?php echo $__env->make('charts::_partials/container.div-titled', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">
    $(function () {
        Morris.Bar({
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
            <?php if($model->colors): ?>
                barColors: function (row, series, type) {
                    <?php for($i = 0; $i < count($model->colors); $i++): ?>
                        <?php if($i == 0): ?>
                            if(row.label == "<?php echo e($model->labels[$i], false); ?>") return "<?php echo e($model->colors[$i], false); ?>"
                        <?php else: ?>
                            else if(row.label == "<?php echo e($model->labels[$i], false); ?>") return "<?php echo e($model->colors[$i], false); ?>"
                        <?php endif; ?>
                    <?php endfor; ?>
                }
            <?php endif; ?>
        })
    });
</script>
