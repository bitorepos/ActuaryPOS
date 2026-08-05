<script type="text/javascript">
    FusionCharts.ready(function () {
        var <?php echo e($model->id, false); ?> = new FusionCharts({
            type: 'doughnut2d',
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
                    'paletteColors': '#0075c2',
                    'bgColor': '#ffffff',
                    'showBorder': '0',
                    'use3DLighting': '0',
                    'showShadow': '0',
                    'enableSmartLabels': '1',
                    'startingAngle': '0',
                    'showPercentValues': '1',
                    'showPercentInTooltip': '0',
                    'decimals': '1',
                    'captionFontSize': '14',
                    'subcaptionFontSize': '14',
                    'subcaptionFontBold': '0',
                    'toolTipColor': '#ffffff',
                    'toolTipBorderThickness': '0',
                    'toolTipBgColor': '#000000',
                    'toolTipBgAlpha': '80',
                    'toolTipBorderRadius': '2',
                    'toolTipPadding': '5',
                    'showHoverEffect':'1',
                    'showLegend': '1',
                    'legendBgColor': '#ffffff',
                    'legendBorderAlpha': '0',
                    'legendShadow': '0',
                    'legendItemFontSize': '10',
                    'legendItemFontColor': '#666666'
                },
                'data': [
                    <?php for($i = 0; $i < count($model->values); $i++): ?>
                        {
                            'label': "<?php echo $model->labels[$i]; ?>",
                            'value': <?php echo e($model->values[$i], false); ?>,
                            <?php if($model->colors): ?>
                                'color': "<?php echo e($model->colors[$i], false); ?>",
                            <?php endif; ?>
                        },
                    <?php endfor; ?>
                ],
            }
        }).render()
    });
</script>

<?php echo $__env->make('charts::_partials.container.div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
