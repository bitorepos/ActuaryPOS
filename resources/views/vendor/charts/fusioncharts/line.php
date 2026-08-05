<script type="text/javascript">
    FusionCharts.ready(function () {
        var <?php echo e($model->id, false); ?> = new FusionCharts({
            type: 'line',
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
                    <?php if($model->colors): ?>
                        'paletteColors': "<?php echo e($model->colors[0], false); ?>",
                    <?php endif; ?>
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
                'data': [
                    <?php for($i = 0; $i < count($model->values); $i++): ?>
                        {
                            'label': "<?php echo $model->labels[$i]; ?>",
                            'value': <?php echo e($model->values[$i], false); ?>,
                        },
                    <?php endfor; ?>
                ],
            }
        }).render()
    });
</script>

<?php echo $__env->make('charts::_partials.container.div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
