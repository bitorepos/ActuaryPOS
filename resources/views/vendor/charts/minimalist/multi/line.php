<?php echo $__env->make('charts::_partials.container.svg', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">
    $(function() {
        <?php echo $__env->make('charts::minimalist._data.multi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        var xScale = new Plottable.Scales.Category()
        var yScale = new Plottable.Scales.Linear()

        var plot = new Plottable.Plots.Line()
            <?php for($i = 0; $i < count($model->datasets); $i++): ?>
                .addDataset(new Plottable.Dataset(s<?php echo e($i, false); ?>))
            <?php endfor; ?>
            .x(function(d) { return d.x; }, xScale)
            .y(function(d) { return d.y; }, yScale)
            <?php if($model->colors): ?>
                .attr('stroke', "<?php echo e($model->colors[0], false); ?>")
            <?php endif; ?>
            .renderTo('svg#<?php echo e($model->id, false); ?>')

        window.addEventListener('resize', function() {
            plot.redraw()
        })
    });
</script>
