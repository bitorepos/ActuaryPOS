<div class="pos-tab-content">
    <?php
        $disabled_dashboard_items = $common_settings['disable_dashboard_items'] ?? [];
    ?>
     <div class="row">
        <div class="col-sm-4">
            <div class="mb-3">
                <?php echo Form::label('stock_expiry_alert_days', __('business.view_stock_expiry_alert_for') . ':*'); ?>

                <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-calendar-times"></i>
                </span>
                <?php echo Form::number('stock_expiry_alert_days', $business->stock_expiry_alert_days, ['class' => 'form-control','required']); ?>

                <span class="input-group-text">
                    <?php echo app('translator')->get('business.days'); ?>
                </span>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-sm-12">
            <h4><?php echo app('translator')->get('lang_v1.dashboard_items_to_disable'); ?></h4>
        </div>

        <?php $__currentLoopData = \App\Business::DASHBOARD_DISABLE_ITEMS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dashboard_item_key => $dashboard_item_label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-4">
                <div class="checkbox">
                    <label>
                        <?php echo Form::checkbox(
                            "common_settings[disable_dashboard_items][$dashboard_item_key]",
                            1,
                            !empty($disabled_dashboard_items[$dashboard_item_key]),
                            ['class' => 'form-check-input']
                        ); ?>

                        <?php echo e(__($dashboard_item_label), false); ?>

                    </label>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
