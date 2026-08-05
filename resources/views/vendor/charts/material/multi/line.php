<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']})

    google.charts.setOnLoadCallback(draw<?php echo e($model->id, false); ?>)

    function draw<?php echo e($model->id, false); ?>() {
        var data = google.visualization.arrayToDataTable([
            [
                '',
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
        chart: {
            <?php if($model->title): ?>
                title: "<?php echo $model->title; ?>",
            <?php endif; ?>
        },
        <?php if($model->colors): ?>
            colors: [
                <?php $__currentLoopData = $model->colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    "<?php echo e($c, false); ?>",
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ],
        <?php endif; ?>
    };

    var <?php echo e($model->id, false); ?> = new google.charts.Line(document.getElementById("<?php echo e($model->id, false); ?>"))

    <?php echo e($model->id, false); ?>.draw(data, options)
}
</script>

<?php echo $__env->make('charts::_partials.container.div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
