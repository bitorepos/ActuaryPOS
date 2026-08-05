<?php echo $__env->make('charts::_partials.container.svg', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">
    $(function() {
        <?php echo $__env->make('charts::plottablejs._data.multi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        var xScale = new Plottable.Scales.Category();
        var yScale = new Plottable.Scales.Linear();

        var xAxis = new Plottable.Axes.Category(xScale, 'bottom');
        var yAxis = new Plottable.Axes.Numeric(yScale, 'left');

        var plot = new Plottable.Plots.Area()
            <?php for($i = 0; $i < count($model->datasets); $i++): ?>
                .addDataset(new Plottable.Dataset(s<?php echo e($i, false); ?>))
            <?php endfor; ?>
            .x(function(d) { return d.x; }, xScale)
            .y(function(d) { return d.y; }, yScale)
            <?php if($model->colors): ?>
                .attr('stroke', "<?php echo e($model->colors[0], false); ?>")
                .attr('fill', "<?php echo e($model->colors[0], false); ?>")
            <?php endif; ?>
            .animated(true);

        var title;
        <?php if($model->title): ?>
            title = new Plottable.Components.TitleLabel("<?php echo $model->title; ?>").yAlignment('center');
        <?php endif; ?>

        var label = new Plottable.Components.AxisLabel("<?php echo $model->element_label; ?>").yAlignment('center').angle(270);

        var table = new Plottable.Components.Table([[null,null, title],[label, yAxis, plot],[null, null, xAxis]]);
        table.renderTo('svg#<?php echo e($model->id, false); ?>');

        window.addEventListener('resize', function() {
            table.redraw()
        })
    });
</script>
