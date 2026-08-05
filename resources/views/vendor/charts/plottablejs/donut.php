<?php echo $__env->make('charts::_partials.container.svg', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">
    $(function() {
        <?php echo $__env->make('charts::plottablejs._data.one', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        var xScale = new Plottable.Scales.Category()
        var yScale = new Plottable.Scales.Linear()

        var xAxis = new Plottable.Axes.Category(xScale, 'bottom')
        var yAxis = new Plottable.Axes.Numeric(yScale, 'left')

        var reverseMap = {};
        data.forEach(function(d) { reverseMap[d.y] = d.x;});

        var plot = new Plottable.Plots.Pie()
            .addDataset(new Plottable.Dataset(data))
            .sectorValue(function(d) { return d.y; }, yScale)
            <?php if($model->colors): ?>
                .attr('fill', function(d) { return d.color; })
            <?php endif; ?>
            .innerRadius(250, yScale)
            .outerRadius(500, yScale)
            .labelsEnabled(true)
            .labelFormatter(function(n){ return reverseMap[n] ;})
            .animated(true);

        var title;
        <?php if($model->title): ?>
            title = new Plottable.Components.TitleLabel("<?php echo $model->title; ?>").yAlignment('center');
        <?php endif; ?>

        var table = new Plottable.Components.Table([[title],[plot]]);
        table.renderTo('svg#<?php echo e($model->id, false); ?>');

        window.addEventListener('resize', function() {
            table.redraw()
        })
    });
</script>
