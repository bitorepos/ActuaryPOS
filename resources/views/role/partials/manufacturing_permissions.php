<?php
    $module_role_permissions = [];
    if (!empty($role_permissions)) {
        $module_role_permissions = $role_permissions;
    }

    $isChecked = function ($permission) use ($module_role_permissions) {
        return in_array($permission, $module_role_permissions);
    };

    $mfg_groups = [
        [
            'title' => __('manufacturing::lang.dashboard'),
            'icon' => 'fa-tachometer-alt',
            'items' => [
                ['permission' => 'manufacturing.access_dashboard', 'label' => __('manufacturing::lang.access_dashboard')],
            ],
        ],
        [
            'title' => __('manufacturing::lang.recipe'),
            'icon' => 'fa-utensils',
            'items' => [
                ['permission' => 'manufacturing.access_recipe', 'label' => __('manufacturing::lang.access_recipe')],
                ['permission' => 'manufacturing.add_recipe', 'label' => __('manufacturing::lang.add_recipe')],
                ['permission' => 'manufacturing.edit_recipe', 'label' => __('manufacturing::lang.edit_recipe')],
            ],
        ],
        [
            'title' => __('manufacturing::lang.production'),
            'icon' => 'fa-cogs',
            'items' => [
                [
                    'permission' => 'manufacturing.access_production',
                    'label' => __('manufacturing::lang.access_production'),
                    'location_scope' => true,
                    'location_scope_name' => 'manufacturing_production_location_scope',
                    'location_scope_permission' => 'manufacturing.production.view_all_locations',
                ],
                ['permission' => 'manufacturing.view_own_production', 'label' => __('manufacturing::lang.view_own_production')],
            ],
        ],
        [
            'title' => __('manufacturing::lang.demand_order'),
            'icon' => 'fa-clipboard-list',
            'items' => [
                [
                    'permission' => 'manufacturing.access_demand_order',
                    'label' => __('manufacturing::lang.access_demand_order'),
                    'location_scope' => true,
                    'location_scope_name' => 'manufacturing_demand_order_location_scope',
                    'location_scope_permission' => 'manufacturing.demand_order.view_all_locations',
                ],
                ['permission' => 'manufacturing.add_demand_order', 'label' => __('manufacturing::lang.add_demand_order')],
                ['permission' => 'manufacturing.edit_demand_order', 'label' => __('manufacturing::lang.edit_demand_order')],
                ['permission' => 'manufacturing.delete_demand_order', 'label' => __('manufacturing::lang.delete_demand_order')],
                ['permission' => 'manufacturing.approve_demand_order', 'label' => __('manufacturing::lang.approve_demand_order')],
            ],
        ],
        [
            'title' => __('manufacturing::lang.reports'),
            'icon' => 'fa-chart-bar',
            'items' => [
                ['permission' => 'manufacturing.access_reports', 'label' => __('manufacturing::lang.access_reports')],
                [
                    'permission' => 'manufacturing.demand_order_report.view',
                    'label' => __('manufacturing::lang.demand_order_report_view'),
                    'location_scope' => true,
                    'location_scope_name' => 'manufacturing_demand_order_report_location_scope',
                    'location_scope_permission' => 'manufacturing.demand_order_report.view_all_locations',
                ],
                [
                    'permission' => 'manufacturing.demand_ingredient_report.view',
                    'label' => __('manufacturing::lang.demand_ingredient_report_view'),
                    'location_scope' => true,
                    'location_scope_name' => 'manufacturing_demand_ingredient_report_location_scope',
                    'location_scope_permission' => 'manufacturing.demand_ingredient_report.view_all_locations',
                ],
                [
                    'permission' => 'manufacturing.manufacturing_report.view',
                    'label' => __('manufacturing::lang.manufacturing_report_view'),
                    'location_scope' => true,
                    'location_scope_name' => 'manufacturing_manufacturing_report_location_scope',
                    'location_scope_permission' => 'manufacturing.manufacturing_report.view_all_locations',
                ],
                ['permission' => 'manufacturing.recipe_report.view', 'label' => __('manufacturing::lang.recipe_report_view')],
                [
                    'permission' => 'manufacturing.productions_report.view',
                    'label' => __('manufacturing::lang.productions_report_view'),
                    'location_scope' => true,
                    'location_scope_name' => 'manufacturing_productions_report_location_scope',
                    'location_scope_permission' => 'manufacturing.productions_report.view_all_locations',
                ],
                [
                    'permission' => 'manufacturing.production_transfer_products_summary.view',
                    'label' => __('manufacturing::lang.production_transfer_products_summary_report_view'),
                    'location_scope' => true,
                    'location_scope_name' => 'manufacturing_production_transfer_products_summary_location_scope',
                    'location_scope_permission' => 'manufacturing.production_transfer_products_summary.view_all_locations',
                ],
            ],
        ],
        [
            'title' => __('manufacturing::lang.security'),
            'icon' => 'fa-user-shield',
            'items' => [
                ['permission' => 'manufacturing.manage_production_status', 'label' => __('manufacturing::lang.manage_production_status')],
                ['permission' => 'manufacturing.access_settings', 'label' => __('manufacturing::lang.access_settings')],
            ],
        ],
        [
            'title' => __('lang_v1.others'),
            'icon' => 'fa-ellipsis-h',
            'items' => [
                ['permission' => 'manufacturing.access_quality_control', 'label' => __('manufacturing::lang.access_quality_control')],
                ['permission' => 'manufacturing.add_quality_inspection', 'label' => __('manufacturing::lang.add_quality_inspection')],
            ],
        ],
    ];
?>

<div class="pos-tab-content">
    <?php $__currentLoopData = $mfg_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$loop->first): ?>
            <hr>
        <?php endif; ?>
        <div class="row check_group">
            <div class="col-md-3">
                <h4><i class="fas <?php echo e($group['icon'], false); ?> me-1"></i> <?php echo e($group['title'], false); ?></h4>
            </div>
            <div class="col-md-2">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="check_all form-check-input"> <?php echo e(__('role.select_all'), false); ?>

                    </label>
                </div>
            </div>
            <div class="col-md-7">
                <?php $__currentLoopData = $group['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-12">
                        <div class="form-check">
                            <label class="form-check-label">
                                <?php echo Form::checkbox('permissions[]', $item['permission'], $isChecked($item['permission']), ['class' => 'form-check-input']); ?>

                                <?php echo e($item['label'], false); ?>

                            </label>
                        </div>
                        <?php if(!empty($item['location_scope'])): ?>
                            <div class="pl-4 mt-1 mb-2" style="padding-left: 24px;">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option['.$item['location_scope_name'].']', '', ! $isChecked($item['location_scope_permission']), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('role.own_location'), false); ?>

                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option['.$item['location_scope_name'].']', $item['location_scope_permission'], $isChecked($item['location_scope_permission']), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('role.all_locations'), false); ?>

                                    </label>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
