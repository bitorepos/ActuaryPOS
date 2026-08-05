<script type="text/javascript">
    FusionCharts.ready(function () {
        var <?php echo e($model->id, false); ?> = new FusionCharts({
            type: 'mscolumn2d',
            renderAt: "<?php echo e($model->id, false); ?>",
            <?php echo $__env->make('charts::_partials.dimension.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            dataFormat: 'json',
            dataSource: {
                'chart': {
                    "exportenabled": "1",
                    "exportatclient": "1",
                    <?php if($model->title): ?>
                    'caption': "<?php echo $model->title; ?>",
                    <?php endif; ?>
                    'yAxisName': "<?php echo $model->element_label; ?>",
                    'bgColor': '#ffffff',
                    'borderAlpha': '20',
                    'canvasBorderAlpha': '0',
                    'usePlotGradientColor': '0',
                    'plotBorderAlpha': '10',
                    'rotatevalues': '1',
                    'valueFontColor': '#ffffff',
                    'showXAxisLine': '1',
                    'xAxisLineColor': '#999999',
                    'divlineColor': '#999999',
                    'divLineIsDashed': '1',
                    'showAlternateHGridColor': '0',
                    'subcaptionFontBold': '0',
                    'subcaptionFontSize': '14'
                },
                'categories': [{
                    'category': [
                        <?php $__currentLoopData = $model->labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            {
                                'label': "<?php echo e($l, false); ?>",
                            },
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ]
                }],
                'dataset': [
                    <?php for($i = 0; $i < count($model->datasets); $i++): ?>
                        {
                            'seriesname': "<?php echo e($model->datasets[$i]['label'], false); ?>",
                            <?php if($model->colors and count($model->colors) > $i): ?>
                                'color': "<?php echo e($model->colors[$i], false); ?>",
                            <?php endif; ?>
                            'data': [
                                <?php $__currentLoopData = $model->datasets[$i]['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    {
                                        'value': <?php echo e($v, false); ?>

                                    },
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            ]
                        },
                    <?php endfor; ?>
                ]
            }
        }).render()
    });
</script>

<?php echo $__env->make('charts::_partials.container.div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
