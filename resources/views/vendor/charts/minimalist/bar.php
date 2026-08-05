<?php echo $__env->make('charts::_partials.container.svg', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">
    $(function() {
        <?php echo $__env->make('charts::minimalist._data.one-indcolor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        var xScale = new Plottable.Scales.Category()
        var yScale = new Plottable.Scales.Linear()

        var plot = new Plottable.Plots.Bar()
            .addDataset(new Plottable.Dataset(data))
            .x(function(d) { return d.x; }, xScale)
            .y(function(d) { return d.y; }, yScale)
            <?php if($model->colors): ?>
                .attr('fill', function(d) { return d.color; })
            <?php endif; ?>
            .renderTo('svg#<?php echo e($model->id, false); ?>')

        window.addEventListener('resize', function() {
            plot.redraw()
        })
    });
</script>
