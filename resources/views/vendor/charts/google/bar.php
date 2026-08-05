<script type="text/javascript">
    google.charts.setOnLoadCallback(draw<?php echo e($model->id, false); ?>)

    function draw<?php echo e($model->id, false); ?>() {
        var data = google.visualization.arrayToDataTable([
            ['', "<?php echo $model->element_label; ?>",
                <?php if($model->colors): ?>
                    { role: 'style' }
                <?php endif; ?>
            ],
            <?php for($i = 0; $i < count($model->values); $i++): ?>
                [
                    "<?php echo $model->labels[$i]; ?>", <?php echo e($model->values[$i], false); ?>

                    <?php if($model->colors): ?>
                        ,"<?php echo e($model->colors[$i], false); ?>"
                    <?php endif; ?>
                ],
            <?php endfor; ?>
        ])

        var options = {
            <?php echo $__env->make('charts::_partials.dimension.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            legend: { position: 'top', alignment: 'end' },
            fontSize: 12,
            <?php echo $__env->make('charts::google.titles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if($model->colors): ?>
                colors:[
                    <?php $__currentLoopData = $model->colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        "<?php echo e($color, false); ?>",
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
            <?php endif; ?>
        };

        var <?php echo e($model->id, false); ?> = new google.visualization.ColumnChart(document.getElementById("<?php echo e($model->id, false); ?>"))

        <?php echo e($model->id, false); ?>.draw(data, options)
    }
</script>

<?php if(!$model->customId): ?>
    <?php echo $__env->make('charts::_partials.container.div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
