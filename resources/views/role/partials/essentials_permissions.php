<?php
    $module_role_permissions = [];
    if (!empty($role_permissions)) {
        $module_role_permissions = $role_permissions;
    }

    $isChecked = function ($permission) use ($module_role_permissions) {
        return in_array($permission, $module_role_permissions);
    };

    $essentials_groups = [
        [
            'title' => __('essentials::lang.essentials'),
            'icon' => 'fa-check-circle',
            'items' => [
                ['permission' => 'essentials.access_essentials', 'label' => __('essentials::lang.access_essentials')],
            ],
        ],
        [
            'title' => __('essentials::lang.todo'),
            'icon' => 'fa-list-ul',
            'items' => [
                ['permission' => 'essentials.add_todos', 'label' => __('essentials::lang.add_todos')],
                ['permission' => 'essentials.edit_todos', 'label' => __('essentials::lang.edit_todos')],
                ['permission' => 'essentials.delete_todos', 'label' => __('essentials::lang.delete_todos')],
                ['permission' => 'essentials.assign_todos', 'label' => __('essentials::lang.assign_todos')],
            ],
        ],
        [
            'title' => __('essentials::lang.messages'),
            'icon' => 'fa-comments',
            'items' => [
                ['permission' => 'essentials.view_message', 'label' => __('essentials::lang.view_message')],
                ['permission' => 'essentials.create_message', 'label' => __('essentials::lang.create_message')],
            ],
        ],
        [
            'title' => __('essentials::lang.hrm'),
            'icon' => 'fa-users',
            'items' => [
                ['permission' => 'essentials.access_hrm', 'label' => __('essentials::lang.access_hrm')],
            ],
        ],
        [
            'title' => __('essentials::lang.leave'),
            'icon' => 'fa-user-times',
            'items' => [
                ['permission' => 'essentials.crud_leave_type', 'label' => __('essentials::lang.crud_leave_type')],
                ['permission' => 'essentials.crud_all_leave', 'label' => __('essentials::lang.crud_all_leave'), 'is_radio' => true, 'radio_input_name' => 'leave_crud'],
                ['permission' => 'essentials.crud_own_leave', 'label' => __('essentials::lang.crud_own_leave'), 'is_radio' => true, 'radio_input_name' => 'leave_crud'],
                ['permission' => 'essentials.approve_leave', 'label' => __('essentials::lang.approve_leave')],
            ],
        ],
        [
            'title' => __('essentials::lang.holidays'),
            'icon' => 'fa-umbrella-beach',
            'items' => [
                ['permission' => 'essentials.view_holidays', 'label' => __('essentials::lang.view_holidays')],
                ['permission' => 'essentials.manage_holidays', 'label' => __('essentials::lang.manage_holidays')],
            ],
        ],
        [
            'title' => __('essentials::lang.attendance'),
            'icon' => 'fa-clipboard-check',
            'items' => [
                ['permission' => 'essentials.crud_all_attendance', 'label' => __('essentials::lang.crud_all_attendance'), 'is_radio' => true, 'radio_input_name' => 'attendance_crud'],
                ['permission' => 'essentials.view_own_attendance', 'label' => __('essentials::lang.view_own_attendance'), 'is_radio' => true, 'radio_input_name' => 'attendance_crud'],
                ['permission' => 'essentials.allow_users_for_attendance_from_web', 'label' => __('essentials::lang.allow_users_for_attendance_from_web')],
                ['permission' => 'essentials.allow_users_for_attendance_from_api', 'label' => __('essentials::lang.allow_users_for_attendance_from_api')],
                ['permission' => 'essentials.crud_attendance', 'label' => __('essentials::lang.crud_attendance_devices')],
            ],
        ],
        [
            'title' => __('essentials::lang.payroll'),
            'icon' => 'fa-wallet',
            'items' => [
                ['permission' => 'essentials.view_all_payroll', 'label' => __('essentials::lang.view_all_payroll')],
                ['permission' => 'essentials.create_payroll', 'label' => __('essentials::lang.add_payroll')],
                ['permission' => 'essentials.update_payroll', 'label' => __('essentials::lang.edit_payroll')],
                ['permission' => 'essentials.delete_payroll', 'label' => __('essentials::lang.delete_payroll')],
                ['permission' => 'essentials.view_allowance_and_deduction', 'label' => __('essentials::lang.view_pay_component')],
                ['permission' => 'essentials.add_allowance_and_deduction', 'label' => __('essentials::lang.add_pay_component')],
            ],
        ],
        [
            'title' => __('essentials::lang.organization'),
            'icon' => 'fa-sitemap',
            'items' => [
                ['permission' => 'essentials.crud_department', 'label' => __('essentials::lang.crud_department')],
                ['permission' => 'essentials.crud_designation', 'label' => __('essentials::lang.crud_designation')],
                ['permission' => 'essentials.access_sales_target', 'label' => __('essentials::lang.access_sales_target')],
            ],
        ],
        [
            'title' => __('report.reports'),
            'icon' => 'fa-chart-bar',
            'items' => [
                ['permission' => 'essentials.attendance_report.view', 'label' => __('essentials::lang.attendance_report_view')],
                ['permission' => 'essentials.payroll_report.view', 'label' => __('essentials::lang.payroll_report_view')],
            ],
        ],
        [
            'title' => __('lang_v1.others'),
            'icon' => 'fa-ellipsis-h',
            'items' => [
                ['permission' => 'essentials.view_employee_documents', 'label' => __('essentials::lang.view_employee_documents')],
                ['permission' => 'essentials.manage_employee_documents', 'label' => __('essentials::lang.manage_employee_documents')],
                ['permission' => 'essentials.view_warnings', 'label' => __('essentials::lang.view_warnings')],
                ['permission' => 'essentials.manage_warnings', 'label' => __('essentials::lang.manage_warnings')],
                ['permission' => 'essentials.view_awards', 'label' => __('essentials::lang.view_awards')],
                ['permission' => 'essentials.manage_awards', 'label' => __('essentials::lang.manage_awards')],
                ['permission' => 'essentials.view_announcements', 'label' => __('essentials::lang.view_announcements')],
                ['permission' => 'essentials.manage_announcements', 'label' => __('essentials::lang.manage_announcements')],
                ['permission' => 'essentials.view_leave_quotas', 'label' => __('essentials::lang.view_leave_quotas')],
                ['permission' => 'essentials.manage_leave_quotas', 'label' => __('essentials::lang.manage_leave_quotas')],
            ],
        ],
        [
            'title' => __('essentials::lang.security'),
            'icon' => 'fa-user-shield',
            'items' => [
                ['permission' => 'edit_essentials_settings', 'label' => __('essentials::lang.edit_essentials_settings')],
            ],
        ],
    ];
?>

<div class="pos-tab-content">
    <?php $__currentLoopData = $essentials_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                <?php if(!empty($item['is_radio'])): ?>
                                    <?php echo Form::radio('radio_option[' . $item['radio_input_name'] . ']', $item['permission'], $isChecked($item['permission']), ['class' => 'form-check-input']); ?>

                                <?php else: ?>
                                    <?php echo Form::checkbox('permissions[]', $item['permission'], $isChecked($item['permission']), ['class' => 'form-check-input']); ?>

                                <?php endif; ?>
                                <?php echo e($item['label'], false); ?>

                            </label>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
