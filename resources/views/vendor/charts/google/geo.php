<script type="text/javascript">
    google.charts.setOnLoadCallback(draw<?php echo e($model->id, false); ?>)

    function draw<?php echo e($model->id, false); ?>() {
        var data = google.visualization.arrayToDataTable([
            ['Country', "<?php echo $model->element_label; ?>"],
            <?php for($i = 0; $i < count($model->values); $i++): ?>
                ["<?php echo e($model->labels[$i], false); ?>", <?php echo e($model->values[$i], false); ?>],
            <?php endfor; ?>
        ])

        var options = {
            <?php echo $__env->make('charts::_partials.dimension.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            colorAxis: {
                colors: [
                    <?php if($model->colors and count($model->colors >= 2)): ?>
                        "<?php echo e($model->colors[0], false); ?>", "<?php echo e($model->colors[1], false); ?>"
                    <?php endif; ?>
                ]
            },
            region: "<?php echo e($model->region ? $model->region : 'world', false); ?>",
            datalessRegionColor: "#e0e0e0",
            defaultColor: "#607D8",
        };

        var <?php echo e($model->id, false); ?> = new google.visualization.GeoChart(document.getElementById("<?php echo e($model->id, false); ?>"))

        <?php echo e($model->id, false); ?>.draw(data, options)
    }
</script>

<?php if(!$model->customId): ?>
    <?php echo $__env->make('charts::_partials/container.div-titled', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
