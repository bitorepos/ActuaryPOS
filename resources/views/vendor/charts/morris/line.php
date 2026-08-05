<?php echo $__env->make('charts::_partials/container.div-titled', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">
    $(function (){
        Morris.Line({
            element: "<?php echo e($model->id, false); ?>",
            resize: true,
            data: [
                <?php for($l = 0; $l < count($model->values); $l++): ?>
                    {
                        x: "<?php echo e($model->labels[$l], false); ?>",
                        y: "<?php echo e($model->values[$l], false); ?>"
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
