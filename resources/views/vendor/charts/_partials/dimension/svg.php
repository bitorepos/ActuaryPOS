<style>
#<?php echo e($model->id, false); ?> > svg {
    <?php echo $__env->make("charts::_partials.dimension.css", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
}
</style>
