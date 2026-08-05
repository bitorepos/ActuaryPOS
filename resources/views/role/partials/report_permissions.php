<?php
    $role_permissions = $role_permissions ?? [];
    $common_settings = $common_settings ?? [];

    $isChecked = function ($permission) use ($role_permissions) {
        return in_array($permission, $role_permissions);
    };

    $report_groups = [
        [
            'title' => __('report.reports'),
            'icon' => 'fa-chart-bar',
            'items' => [
                ['permission' => 'access_reports.view', 'label' => __('role.access_reports')],
            ],
        ],
        [
            'title' => 'Admin Reports',
            'icon' => 'fa-user-shield',
            'items' => [
                [
                    'permission' => 'profit_loss_report.view',
                    'label' => __('role.profit_loss_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'profit_loss_report_location_scope',
                    'location_scope_permission' => 'profit_loss_report.view_all_locations',
                ],
                [
                    'permission' => 'purchase_n_sell_report.view',
                    'label' => __('role.purchase_n_sell_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'purchase_n_sell_report_location_scope',
                    'location_scope_permission' => 'purchase_n_sell_report.view_all_locations',
                    'show' => in_array('purchases', $enabled_modules) || in_array('add_sale', $enabled_modules) || in_array('pos_sale', $enabled_modules),
                ],
                [
                    'permission' => 'tax_report.view',
                    'label' => __('role.tax_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'tax_report_location_scope',
                    'location_scope_permission' => 'tax_report.view_all_locations',
                ],
                [
                    'permission' => 'expense_report.view',
                    'label' => __('role.expense_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'expense_report_location_scope',
                    'location_scope_permission' => 'expense_report.view_all_locations',
                    'show' => in_array('expenses', $enabled_modules),
                ],
                [
                    'permission' => 'activity_log_report.view',
                    'label' => __('lang_v1.activity_log_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'activity_log_report_location_scope',
                    'location_scope_permission' => 'activity_log_report.view_all_locations',
                ],
            ],
        ],
        [
            'title' => 'POS Reports',
            'icon' => 'fa-cash-register',
            'items' => [
                [
                    'permission' => 'register_report.view',
                    'label' => __('role.register_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'register_report_location_scope',
                    'location_scope_permission' => 'register_report.view_all_locations',
                ],
                [
                    'permission' => 'summary_income_report.view',
                    'label' => __('role.summary_income_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'summary_income_report_location_scope',
                    'location_scope_permission' => 'summary_income_report.view_all_locations',
                ],
                [
                    'permission' => 'sales_representative.view',
                    'label' => __('role.sales_representative.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'sales_representative_report_location_scope',
                    'location_scope_permission' => 'sales_representative.view_all_locations',
                ],
                [
                    'permission' => 'service_staff_report.view',
                    'label' => __('restaurant.service_staff_report.view'),
                    'show' => in_array('service_staff', $enabled_modules),
                ],
                [
                    'permission' => 'table_report.view',
                    'label' => __('restaurant.table_report'),
                    'show' => in_array('tables', $enabled_modules),
                ],
                [
                    'permission' => 'types_of_service_report.view',
                    'label' => __('lang_v1.types_of_service_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'types_of_service_report_location_scope',
                    'location_scope_permission' => 'types_of_service_report.view_all_locations',
                    'show' => in_array('types_of_service', $enabled_modules) && in_array('pos_sale', $enabled_modules),
                ],
            ],
        ],
        [
            'title' => 'Sales Reports',
            'icon' => 'fa-chart-line',
            'items' => [
                [
                    'permission' => 'show_report_607.view',
                    'label' => __('role.show_report_607.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'show_report_607_location_scope',
                    'location_scope_permission' => 'show_report_607.view_all_locations',
                    'show' => ! empty(config('constants.show_report_607')),
                ],
                [
                    'permission' => 'sale_invoices_report.view',
                    'label' => __('lang_v1.sale_invoices_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'sale_invoices_report_location_scope',
                    'location_scope_permission' => 'sale_invoices_report.view_all_locations',
                    'nested_permissions' => [
                        ['permission' => 'hide_sale_invoices_report_cost_profit', 'label' => __('lang_v1.hide_sale_invoices_report_cost_profit')],
                    ],
                ],
                [
                    'permission' => 'sales_returns_report.view',
                    'label' => __('lang_v1.sales_returns_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'sales_returns_report_location_scope',
                    'location_scope_permission' => 'sales_returns_report.view_all_locations',
                ],
                [
                    'permission' => 'product_sell_report.view',
                    'label' => __('lang_v1.product_sell_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'product_sell_report_location_scope',
                    'location_scope_permission' => 'product_sell_report.view_all_locations',
                    'nested_permissions' => [
                        ['permission' => 'hide_product_sell_report_cost_profit', 'label' => __('lang_v1.hide_product_sell_report_cost_profit')],
                        ['permission' => 'hide_product_sell_report_sale_value', 'label' => __('lang_v1.hide_product_sell_report_sale_value')],
                    ],
                ],
                [
                    'permission' => 'sell_payment_report.view',
                    'label' => __('lang_v1.sell_payment_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'sell_payment_report_location_scope',
                    'location_scope_permission' => 'sell_payment_report.view_all_locations',
                ],
                [
                    'permission' => 'sales_analysis_report.view',
                    'label' => __('role.sales_analysis_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'sales_analysis_report_location_scope',
                    'location_scope_permission' => 'sales_analysis_report.view_all_locations',
                ],
                [
                    'permission' => 'trending_product_report.view',
                    'label' => __('role.trending_product_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'trending_product_report_location_scope',
                    'location_scope_permission' => 'trending_product_report.view_all_locations',
                ],
                [
                    'permission' => 'payment_recovery_report.view',
                    'label' => __('lang_v1.payment_recovery_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'payment_recovery_report_location_scope',
                    'location_scope_permission' => 'payment_recovery_report.view_all_locations',
                ],
                [
                    'permission' => 'discounts_report.view',
                    'label' => __('lang_v1.discounts_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'discounts_report_location_scope',
                    'location_scope_permission' => 'discounts_report.view_all_locations',
                ],
                [
                    'permission' => 'product_booking_report.view',
                    'label' => __('lang_v1.product_booking_report.view'),
                    'show' => ! empty($common_settings['enable_booking_hourly_services']),
                ],
                [
                    'permission' => 'stock_performance_report.view',
                    'label' => __('role.stock_performance_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'stock_performance_report_location_scope',
                    'location_scope_permission' => 'stock_performance_report.view_all_locations',
                    'nested_permissions' => [
                        ['permission' => 'hide_stock_performance_report_cost_profit', 'label' => __('lang_v1.hide_stock_performance_report_cost_profit')],
                    ],
                ],
                [
                    'permission' => 'types_of_service_report.view',
                    'label' => __('lang_v1.types_of_service_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'types_of_service_report_location_scope',
                    'location_scope_permission' => 'types_of_service_report.view_all_locations',
                    'show' => in_array('types_of_service', $enabled_modules) && ! in_array('pos_sale', $enabled_modules),
                ],
            ],
        ],
        [
            'title' => 'Stock Reports',
            'icon' => 'fa-warehouse',
            'items' => [
                [
                    'permission' => 'stock_report.view',
                    'label' => __('role.stock_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'stock_report_location_scope',
                    'location_scope_permission' => 'stock_report.view_all_locations',
                    'nested_permissions' => [
                        ['permission' => 'hide_stock_report_cost_value', 'label' => __('lang_v1.hide_stock_report_cost_value')],
                        ['permission' => 'hide_stock_report_sale_value', 'label' => __('lang_v1.hide_stock_report_sale_value')],
                    ],
                ],
                [
                    'permission' => 'view_product_stock_value.view',
                    'label' => __('lang_v1.view_product_stock_value.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'stock_value_report_location_scope',
                    'location_scope_permission' => 'view_product_stock_value.view_all_locations',
                    'nested_permissions' => [
                        ['permission' => 'hide_stock_value_report_cost_value', 'label' => __('lang_v1.hide_stock_value_report_cost_value')],
                        ['permission' => 'hide_stock_value_report_sale_value', 'label' => __('lang_v1.hide_stock_value_report_sale_value')],
                    ],
                ],
                [
                    'permission' => 'view_product_reorder_report.view',
                    'label' => __('lang_v1.view_product_reorder_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'product_reorder_report_location_scope',
                    'location_scope_permission' => 'view_product_reorder_report.view_all_locations',
                ],
                [
                    'permission' => 'opening_stock_report.view',
                    'label' => __('lang_v1.opening_stock_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'opening_stock_report_location_scope',
                    'location_scope_permission' => 'opening_stock_report.view_all_locations',
                    'nested_permissions' => [
                        ['permission' => 'hide_opening_stock_report_cost_value', 'label' => __('lang_v1.hide_opening_stock_report_cost_value')],
                        ['permission' => 'hide_opening_stock_report_sale_value', 'label' => __('lang_v1.hide_opening_stock_report_sale_value')],
                    ],
                ],
                [
                    'permission' => 'mismatch_quantity_report.view',
                    'label' => __('role.mismatch_quantity_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'mismatch_quantity_report_location_scope',
                    'location_scope_permission' => 'mismatch_quantity_report.view_all_locations',
                ],
                [
                    'permission' => 'stock_expiry_report.view',
                    'label' => __('report.stock_expiry_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'stock_expiry_report_location_scope',
                    'location_scope_permission' => 'stock_expiry_report.view_all_locations',
                ],
                [
                    'permission' => 'lot_report.view',
                    'label' => __('lang_v1.lot_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'lot_report_location_scope',
                    'location_scope_permission' => 'lot_report.view_all_locations',
                ],
                [
                    'permission' => 'stock_adjustment_report.view',
                    'label' => __('report.stock_adjustment_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'stock_adjustment_report_location_scope',
                    'location_scope_permission' => 'stock_adjustment_report.view_all_locations',
                    'nested_permissions' => [
                        ['permission' => 'hide_stock_adjustment_report_cost_value', 'label' => __('lang_v1.hide_stock_adjustment_report_cost_value')],
                        ['permission' => 'hide_stock_adjustment_report_sale_value', 'label' => __('lang_v1.hide_stock_adjustment_report_sale_value')],
                    ],
                    'show' => in_array('stock_adjustment', $enabled_modules),
                ],
                [
                    'permission' => 'stock_take_report.view',
                    'label' => __('lang_v1.stock_take_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'stock_take_report_location_scope',
                    'location_scope_permission' => 'stock_take_report.view_all_locations',
                    'show' => in_array('stock_adjustment', $enabled_modules),
                ],
                [
                    'permission' => 'stock_transfer_report.view',
                    'label' => __('lang_v1.stock_transfer_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'stock_transfer_report_location_scope',
                    'location_scope_permission' => 'stock_transfer_report.view_all_locations',
                    'nested_permissions' => [
                        ['permission' => 'hide_stock_transfer_report_cost_value', 'label' => __('lang_v1.hide_stock_transfer_report_cost_value')],
                        ['permission' => 'hide_stock_transfer_report_sale_value', 'label' => __('lang_v1.hide_stock_transfer_report_sale_value')],
                    ],
                ],
                [
                    'permission' => 'combo_items_report.view',
                    'label' => __('lang_v1.combo_items_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'combo_items_report_location_scope',
                    'location_scope_permission' => 'combo_items_report.view_all_locations',
                ],
                [
                    'permission' => 'product_status_report.view',
                    'label' => __('lang_v1.product_status_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'product_status_report_location_scope',
                    'location_scope_permission' => 'product_status_report.view_all_locations',
                ],
                [
                    'permission' => 'product_serial_report.view',
                    'label' => __('lang_v1.product_serial_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'product_serial_report_location_scope',
                    'location_scope_permission' => 'product_serial_report.view_all_locations',
                ],
            ],
        ],
        [
            'title' => 'Purchase Reports',
            'icon' => 'fa-shopping-cart',
            'items' => [
                [
                    'permission' => 'show_report_606.view',
                    'label' => __('role.show_report_606.view'),
                    'show' => ! empty(config('constants.show_report_606')),
                    'location_scope' => true,
                    'location_scope_name' => 'show_report_606_location_scope',
                    'location_scope_permission' => 'show_report_606.view_all_locations',
                ],
                [
                    'permission' => 'purchase_invoices_report.view',
                    'label' => __('lang_v1.purchase_invoices_report.view'),
                    'show' => in_array('purchases', $enabled_modules),
                    'location_scope' => true,
                    'location_scope_name' => 'purchase_invoices_report_location_scope',
                    'location_scope_permission' => 'purchase_invoices_report.view_all_locations',
                ],
                [
                    'permission' => 'purchases_returns_report.view',
                    'label' => __('lang_v1.purchases_returns_report.view'),
                    'show' => in_array('purchases', $enabled_modules),
                    'location_scope' => true,
                    'location_scope_name' => 'purchases_returns_report_location_scope',
                    'location_scope_permission' => 'purchases_returns_report.view_all_locations',
                ],
                [
                    'permission' => 'product_purchase_report.view',
                    'label' => __('lang_v1.product_purchase_report.view'),
                    'show' => in_array('purchases', $enabled_modules),
                    'location_scope' => true,
                    'location_scope_name' => 'product_purchase_report_location_scope',
                    'location_scope_permission' => 'product_purchase_report.view_all_locations',
                ],
                [
                    'permission' => 'purchase_payment_report.view',
                    'label' => __('lang_v1.purchase_payment_report.view'),
                    'show' => in_array('purchases', $enabled_modules),
                    'location_scope' => true,
                    'location_scope_name' => 'purchase_payment_report_location_scope',
                    'location_scope_permission' => 'purchase_payment_report.view_all_locations',
                ],
                [
                    'permission' => 'purchase_analysis_report.view',
                    'label' => __('role.purchase_analysis_report.view'),
                    'show' => in_array('purchases', $enabled_modules),
                    'location_scope' => true,
                    'location_scope_name' => 'purchase_analysis_report_location_scope',
                    'location_scope_permission' => 'purchase_analysis_report.view_all_locations',
                ],
            ],
        ],
        [
            'title' => 'General Reports',
            'icon' => 'fa-file-alt',
            'items' => [
                [
                    'permission' => 'contacts_report.view',
                    'label' => __('role.contacts_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'contacts_report_location_scope',
                    'location_scope_permission' => 'contacts_report.view_all_locations',
                ],
                [
                    'permission' => 'customer_groups_report.view',
                    'label' => __('lang_v1.customer_groups_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'customer_groups_report_location_scope',
                    'location_scope_permission' => 'customer_groups_report.view_all_locations',
                ],
                [
                    'permission' => 'cheque_clearance_report.view',
                    'label' => __('lang_v1.cheque_clearance_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'cheque_clearance_report_location_scope',
                    'location_scope_permission' => 'cheque_clearance_report.view_all_locations',
                ],
                [
                    'permission' => 'items_report.view',
                    'label' => __('lang_v1.items_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'items_report_location_scope',
                    'location_scope_permission' => 'items_report.view_all_locations',
                ],
                [
                    'permission' => 'bookings_report.view',
                    'label' => __('lang_v1.bookings_report.view'),
                    'location_scope' => true,
                    'location_scope_name' => 'bookings_report_location_scope',
                    'location_scope_permission' => 'bookings_report.view_all_locations',
                    'show' => in_array('booking', $enabled_modules),
                ],
            ],
        ],
    ];
?>

<div class="pos-tab-content">
    <?php $__currentLoopData = $report_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $items = collect($group['items'])->filter(function ($item) {
                return $item['show'] ?? true;
            });
        ?>

        <?php if($items->isNotEmpty()): ?>
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
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-12">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('permissions[]', $item['permission'], $isChecked($item['permission']), ['class' => 'form-check-input']); ?>

                                    <?php echo e($item['label'], false); ?>

                                </label>
                                <?php if(!empty($item['location_scope'])): ?>
                                    <?php
                                        $location_scope_name = $item['location_scope_name'] ?? $item['permission'].'_location_scope';
                                        $location_scope_permission = $item['location_scope_permission'] ?? str_replace('.view', '.view_all_locations', $item['permission']);
                                    ?>
                                    <div class="ms-4 mt-1">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <?php echo Form::radio('radio_option['.$location_scope_name.']', '', ! $isChecked($location_scope_permission), ['class' => 'form-check-input']); ?>

                                                <?php echo e(__('role.own_location'), false); ?>

                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <?php echo Form::radio('radio_option['.$location_scope_name.']', $location_scope_permission, $isChecked($location_scope_permission), ['class' => 'form-check-input']); ?>

                                                <?php echo e(__('role.all_locations'), false); ?>

                                            </label>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($item['nested_permissions'])): ?>
                                    <div class="ms-4 mt-1">
                                        <?php $__currentLoopData = $item['nested_permissions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nested_permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <?php echo Form::checkbox('permissions[]', $nested_permission['permission'], $isChecked($nested_permission['permission']), ['class' => 'form-check-input']); ?>

                                                    <?php echo e($nested_permission['label'], false); ?>

                                                </label>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
