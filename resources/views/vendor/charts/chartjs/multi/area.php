<?php if(!$model->customId): ?>
    <?php echo $__env->make('charts::_partials.container.canvas2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('charts::_partials.helpers.hex2rgb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">

    var ctx = document.getElementById("<?php echo e($model->id, false); ?>")
    var data = {
        labels: [
            <?php $__currentLoopData = $model->labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                "<?php echo $label; ?>",
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ],
        datasets: [
            <?php for($i = 0; $i < count($model->datasets); $i++): ?>
                {
                    fill: true,
                    label: "<?php echo $model->datasets[$i]['label']; ?>",
                    lineTension: 0.3,
                    <?php if($model->colors and count($model->colors) > $i): ?>
                        <?php ($c = $model->colors[$i]); ?>
                    <?php else: ?>
                        <?php ($c = sprintf('#%06X', mt_rand(0, 0xFFFFFF))); ?>
                    <?php endif; ?>
                    borderColor: "<?php echo e($c, false); ?>",
                    backgroundColor: hex2rgba_convert("<?php echo e($c, false); ?>", 50),
                    data: [
                        <?php $__currentLoopData = $model->datasets[$i]['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($dta, false); ?>,
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ],
                },
            <?php endfor; ?>
        ]
    };

    var <?php echo e($model->id, false); ?> = new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            responsive: <?php echo e($model->responsive || !$model->width ? 'true' : 'false', false); ?>,
            maintainAspectRatio: false,
            <?php if($model->title): ?>
                title: {
                    display: true,
                    text: "<?php echo $model->title; ?>",
                    fontSize: 20,
                }
            <?php endif; ?>
        }
    });


</script>
