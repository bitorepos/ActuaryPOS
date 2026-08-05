<?php
    $module_role_permissions = [];
    if (!empty($role_permissions)) {
        $module_role_permissions = $role_permissions;
    }

    $isChecked = function ($permission) use ($module_role_permissions) {
        return in_array($permission, $module_role_permissions);
    };

    $installment_groups = [
        [
            'title' => __('installment::lang.dashboard'),
            'icon' => 'fa-tachometer-alt',
            'items' => [
                ['permission' => 'installment.access_dashboard', 'label' => __('installment::lang.access_dashboard')],
            ],
        ],
        [
            'title' => __('installment::lang.installment'),
            'icon' => 'fa-money-check-alt',
            'items' => [
                ['permission' => 'installment.view', 'label' => __('installment::lang.view')],
                ['permission' => 'installment.view_customers', 'label' => __('installment::lang.view_customers')],
                ['permission' => 'installment.view_contacts', 'label' => __('installment::lang.view_contacts')],
                ['permission' => 'installment.view_sells', 'label' => __('installment::lang.view_sells')],
            ],
        ],
        [
            'title' => __('installment::lang.installment_plan'),
            'icon' => 'fa-list-alt',
            'items' => [
                ['permission' => 'installment.create', 'label' => __('installment::lang.create')],
                ['permission' => 'installment.edit', 'label' => __('installment::lang.edit')],
                ['permission' => 'installment.delete', 'label' => __('installment::lang.delete')],
                ['permission' => 'installment.print', 'label' => __('installment::lang.print')],
            ],
        ],
        [
            'title' => __('installment::lang.pebt_Collection'),
            'icon' => 'fa-hand-holding-usd',
            'items' => [
                ['permission' => 'installment.add_Collection', 'label' => __('installment::lang.add_Collection')],
                ['permission' => 'installment.delete_Collection', 'label' => __('installment::lang.delete_Collection')],
                ['permission' => 'installment.partial_payment', 'label' => __('installment::lang.partial_payment_permission')],
                ['permission' => 'installment.early_settlement', 'label' => __('installment::lang.early_settlement_permission')],
                ['permission' => 'installment.bulk_payment', 'label' => __('installment::lang.bulk_payment_permission')],
            ],
        ],
        [
            'title' => __('report.reports'),
            'icon' => 'fa-chart-bar',
            'items' => [
                ['permission' => 'installment.view_reports', 'label' => __('installment::lang.view_reports')],
            ],
        ],
        [
            'title' => __('installment::lang.settings'),
            'icon' => 'fa-user-shield',
            'items' => [
                ['permission' => 'installment.system_view', 'label' => __('installment::lang.system_view')],
                ['permission' => 'installment.system_add', 'label' => __('installment::lang.system_add')],
                ['permission' => 'installment.system_edit', 'label' => __('installment::lang.system_edit')],
                ['permission' => 'installment.system_delete', 'label' => __('installment::lang.system_delete')],
            ],
        ],
    ];
?>

<div class="pos-tab-content">
    <?php $__currentLoopData = $installment_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
