<?php
    // Get the max / min index
    $max = 0;
    $min = $model->values ? $model->values[0] : 0;
?>

<?php $__currentLoopData = $model->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($dta > $max): ?>
        <?php ($max = $dta); ?>
    <?php elseif($dta < $min): ?>
        <?php ($min = $dta); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<script type="text/javascript">
    $(function () {
        var <?php echo e($model->id, false); ?> = new Highcharts.Map({
            chart: {
                renderTo:  "<?php echo e($model->id, false); ?>",
                <?php echo $__env->make('charts::_partials.dimension.js2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            },
            <?php if($model->title): ?>
                title: {
                    text:  "<?php echo $model->title; ?>"
                },
            <?php endif; ?>
            <?php if(!$model->credits): ?>
                credits: {
                    enabled: false
                },
            <?php endif; ?>
            mapNavigation: {
                enabled: true,
                enableDoubleClickZoomTo: true
            },
            colorAxis: {
                min: <?php echo e($min, false); ?>,
                <?php if($model->colors and count($model->colors) >= 2): ?>
                    minColor: "<?php echo e($model->colors[0], false); ?>",
                <?php endif; ?>

                max: <?php echo e($max, false); ?>,
                <?php if($model->colors and count($model->colors) >= 2): ?>
                    maxColor: "<?php echo e($model->colors[1], false); ?>",
                <?php endif; ?>
            },
            series : [{
                data : [
                    <?php for($i = 0; $i < count($model->values); $i++): ?>
                        {
                            'code':  "<?php echo e($model->labels[$i], false); ?>",
                            'value': <?php echo e($model->values[$i], false); ?>

                        },
                    <?php endfor; ?>
                ],
                mapData: Highcharts.maps['custom/world'],
                joinBy: ['iso-a2', 'code'],
                name: "<?php echo $model->element_label; ?>",
                states: {
                    hover: {
                        color: '#BADA55'
                    }
                },
            }]
        })
    });
</script>

<?php if(!$model->customId): ?>
    <?php echo $__env->make('charts::_partials.container.div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
