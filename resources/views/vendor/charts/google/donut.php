<script type="text/javascript">
    google.charts.setOnLoadCallback(draw<?php echo e($model->id, false); ?>)

    function draw<?php echo e($model->id, false); ?>() {
        var data = google.visualization.arrayToDataTable([
            ['Element', 'Value'],
            <?php for($l = 0; $l < count($model->values); $l++): ?>
                ["<?php echo $model->labels[$i]; ?>", <?php echo e($model->values[$i], false); ?>],
            <?php endfor; ?>
        ])

        var options = {
            <?php echo $__env->make('charts::_partials.dimension.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            fontSize: 12,
            pieHole: 0.4,
            <?php echo $__env->make('charts::google.titles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('charts::google.colors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        };

        var <?php echo e($model->id, false); ?> = new google.visualization.PieChart(document.getElementById("<?php echo e($model->id, false); ?>"))
        <?php echo e($model->id, false); ?>.draw(data, options)
    }
</script>

<?php if(!$model->customId): ?>
    <?php echo $__env->make('charts::_partials.container.div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
