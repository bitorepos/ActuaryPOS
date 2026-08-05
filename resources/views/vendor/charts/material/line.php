<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']})

    google.charts.setOnLoadCallback(draw<?php echo e($model->id, false); ?>)
        function draw<?php echo e($model->id, false); ?>() {
        var data = google.visualization.arrayToDataTable([
            ['', "<?php echo $model->element_label; ?>"],
            <?php for($i = 0; $i < count($model->values); $i++): ?>
                ["<?php echo $model->labels[$i]; ?>", <?php echo e($model->values[$i], false); ?>],
            <?php endfor; ?>
        ])

        var options = {
            chart: {
              <?php if($model->title): ?>
                title: "<?php echo $model->title; ?>",
              <?php endif; ?>
            },
            <?php if($model->colors): ?>
                colors: ["<?php echo e($model->colors[0], false); ?>"],
            <?php endif; ?>
        };

        var <?php echo e($model->id, false); ?> = new google.charts.Line(document.getElementById("<?php echo e($model->id, false); ?>"))

        <?php echo e($model->id, false); ?>.draw(data, options)
    }
</script>

<?php echo $__env->make('charts::_partials.container.div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
