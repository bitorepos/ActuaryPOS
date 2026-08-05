<script type="text/javascript">
    chart = google.charts.setOnLoadCallback(draw<?php echo e($model->id, false); ?>)

    function draw<?php echo e($model->id, false); ?>() {
        var data = google.visualization.arrayToDataTable([
            [
                'Element',
                <?php for($i = 0; $i < count($model->datasets); $i++): ?>
                    "<?php echo e($model->datasets[$i]['label'], false); ?>",
                <?php endfor; ?>
            ],
            <?php for($l = 0; $l < count($model->labels); $l++): ?>
                [
                    "<?php echo e($model->labels[$l], false); ?>",
                    <?php for($i = 0; $i < count($model->datasets); $i++): ?>
                        <?php echo e($model->datasets[$i]['values'][$l], false); ?>,
                    <?php endfor; ?>
                ],
            <?php endfor; ?>
        ])

        var options = {
            <?php echo $__env->make('charts::_partials.dimension.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            fontSize: 12,
            <?php echo $__env->make('charts::google.titles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('charts::google.colors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            legend: { position: 'top', alignment: 'end' }
        };

        var <?php echo e($model->id, false); ?> = new google.visualization.AreaChart(document.getElementById("<?php echo e($model->id, false); ?>"))

        <?php echo e($model->id, false); ?>.draw(data, options)
    }
</script>

<?php if(!$model->customId): ?>
    <?php echo $__env->make('charts::_partials.container.div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
