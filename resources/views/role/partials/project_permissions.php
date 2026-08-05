<?php
    $module_role_permissions = [];
    if (!empty($role_permissions)) {
        $module_role_permissions = $role_permissions;
    }

    $isChecked = function ($permission) use ($module_role_permissions) {
        return in_array($permission, $module_role_permissions);
    };

    $project_groups = [
        [
            'title' => __('project::lang.dashboard'),
            'icon' => 'fa-tachometer-alt',
            'items' => [
                ['permission' => 'project.access_dashboard', 'label' => __('project::lang.access_project_dashboard')],
            ],
        ],
        [
            'title' => __('project::lang.projects'),
            'icon' => 'fa-folder-open',
            'items' => [
                ['permission' => 'project.view_project', 'label' => __('project::lang.view_own_projects')],
                ['permission' => 'project.view_all_projects', 'label' => __('project::lang.view_all_projects')],
                ['permission' => 'project.create_project', 'label' => __('project::lang.create_project')],
                ['permission' => 'project.edit_project', 'label' => __('project::lang.edit_project')],
                ['permission' => 'project.delete_project', 'label' => __('project::lang.delete_project')],
                ['permission' => 'project.change_project_status', 'label' => __('project::lang.change_project_status')],
                ['permission' => 'project.manage_budget', 'label' => __('project::lang.manage_project_budget')],
                ['permission' => 'project.view_activity', 'label' => __('project::lang.view_project_activity')],
            ],
        ],
        [
            'title' => __('project::lang.tasks'),
            'icon' => 'fa-tasks',
            'items' => [
                ['permission' => 'project.view_task', 'label' => __('project::lang.view_project_tasks')],
                ['permission' => 'project.create_task', 'label' => __('project::lang.create_project_task')],
                ['permission' => 'project.edit_task', 'label' => __('project::lang.edit_project_task')],
                ['permission' => 'project.delete_task', 'label' => __('project::lang.delete_project_task')],
                ['permission' => 'project.change_task_status', 'label' => __('project::lang.change_project_task_status')],
                ['permission' => 'project.create_task_comment', 'label' => __('project::lang.create_project_task_comment')],
                ['permission' => 'project.delete_task_comment', 'label' => __('project::lang.delete_project_task_comment')],
            ],
        ],
        [
            'title' => __('project::lang.time_logs'),
            'icon' => 'fa-clock',
            'items' => [
                ['permission' => 'project.view_time_log', 'label' => __('project::lang.view_project_timelogs')],
                ['permission' => 'project.create_time_log', 'label' => __('project::lang.create_project_timelog')],
                ['permission' => 'project.edit_time_log', 'label' => __('project::lang.edit_project_timelog')],
                ['permission' => 'project.delete_time_log', 'label' => __('project::lang.delete_project_timelog')],
                ['permission' => 'project.manage_timelogs', 'label' => __('project::lang.manage_project_timelogs')],
            ],
        ],
        [
            'title' => __('project::lang.documents_and_notes'),
            'icon' => 'fa-file-alt',
            'items' => [
                ['permission' => 'project.view_documents_notes', 'label' => __('project::lang.view_documents_and_notes')],
                ['permission' => 'project.manage_documents_notes', 'label' => __('project::lang.manage_documents_and_notes')],
            ],
        ],
        [
            'title' => __('project::lang.stock'),
            'icon' => 'fa-boxes',
            'items' => [
                ['permission' => 'project.view_stock', 'label' => __('project::lang.view_project_stock')],
                ['permission' => 'project.manage_stock', 'label' => __('project::lang.manage_project_stock')],
            ],
        ],
        [
            'title' => __('expense.expenses'),
            'icon' => 'fa-receipt',
            'items' => [
                ['permission' => 'project.add_expense', 'label' => __('expense.add_expense')],
                ['permission' => 'project.edit_expense', 'label' => __('expense.edit_expense')],
                ['permission' => 'project.delete_expense', 'label' => __('lang_v1.delete_expense')],
            ],
        ],
        [
            'title' => __('project::lang.invoices'),
            'icon' => 'fa-file-invoice',
            'items' => [
                ['permission' => 'project.view_invoices', 'label' => __('project::lang.view_project_invoices')],
                ['permission' => 'project.manage_invoices', 'label' => __('project::lang.manage_project_invoices')],
            ],
        ],
        [
            'title' => __('project::lang.project_reports'),
            'icon' => 'fa-chart-bar',
            'items' => [
                ['permission' => 'project.view_reports', 'label' => __('project::lang.view_project_reports')],
            ],
        ],
        [
            'title' => __('project::lang.settings'),
            'icon' => 'fa-user-shield',
            'items' => [
                ['permission' => 'project.manage_project_category', 'label' => __('project::lang.manage_project_category_permission')],
                ['permission' => 'project.manage_settings', 'label' => __('project::lang.manage_project_settings')],
            ],
        ],
    ];
?>

<div class="pos-tab-content">
    <?php $__currentLoopData = $project_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
