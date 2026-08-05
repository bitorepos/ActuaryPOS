<div class="charts" style="background: <?php echo e($model->background_color, false); ?>;">
    <div data-duration="<?php echo e($model->loader_duration, false); ?>" class="charts-loader <?php echo e($model->loader ? 'enabled' : '', false); ?>" style="display: none; position: relative; top: <?php echo e(($model->height / 2) - 30, false); ?>px; height: 0;">
        <center>
            <div class="loading-spinner" style="border: 3px solid <?php echo e($model->loader_color, false); ?>; border-right-color: transparent;"></div>
        </center>
    </div>
    <div class="charts-chart">
