<?php
    $module_role_permissions = [];
    if (!empty($role_permissions)) {
        $module_role_permissions = $role_permissions;
    }

    $isChecked = function ($permission) use ($module_role_permissions) {
        return in_array($permission, $module_role_permissions);
    };

    $accounting_groups = [
        [
            'title' => __('lang_v1.dashboard'),
            'icon' => 'fa-tachometer-alt',
            'items' => [
                ['permission' => 'accounting.access_accounting_module', 'label' => __('accounting::lang.access_accounting_module')],
            ],
        ],
        [
            'title' => __('report.reports'),
            'icon' => 'fa-chart-bar',
            'items' => [
                [
                    'permission' => 'accounting.ledger_report.view',
                    'label' => __('accounting::lang.ledger_report'),
                    'location_scope' => true,
                    'location_scope_name' => 'accounting_ledger_report_location_scope',
                    'location_scope_permission' => 'accounting.ledger_report.view_all_locations',
                ],
                [
                    'permission' => 'accounting.cash_flow_report.view',
                    'label' => __('accounting::lang.cash_flow_report'),
                    'location_scope' => true,
                    'location_scope_name' => 'accounting_cash_flow_report_location_scope',
                    'location_scope_permission' => 'accounting.cash_flow_report.view_all_locations',
                ],
                [
                    'permission' => 'accounting.trial_balance.view',
                    'label' => __('accounting::lang.trial_balance'),
                    'location_scope' => true,
                    'location_scope_name' => 'accounting_trial_balance_location_scope',
                    'location_scope_permission' => 'accounting.trial_balance.view_all_locations',
                ],
                [
                    'permission' => 'accounting.balance_sheet.view',
                    'label' => __('accounting::lang.balance_sheet'),
                    'location_scope' => true,
                    'location_scope_name' => 'accounting_balance_sheet_location_scope',
                    'location_scope_permission' => 'accounting.balance_sheet.view_all_locations',
                ],
                [
                    'permission' => 'accounting.profit_loss.view',
                    'label' => __('accounting::lang.profit_loss'),
                    'location_scope' => true,
                    'location_scope_name' => 'accounting_profit_loss_location_scope',
                    'location_scope_permission' => 'accounting.profit_loss.view_all_locations',
                ],
                [
                    'permission' => 'accounting.account_receivable_ageing_report.view',
                    'label' => __('accounting::lang.account_recievable_ageing_report'),
                    'location_scope' => true,
                    'location_scope_name' => 'accounting_account_receivable_ageing_report_location_scope',
                    'location_scope_permission' => 'accounting.account_receivable_ageing_report.view_all_locations',
                ],
                [
                    'permission' => 'accounting.account_receivable_ageing_details.view',
                    'label' => __('accounting::lang.account_receivable_ageing_details'),
                    'location_scope' => true,
                    'location_scope_name' => 'accounting_account_receivable_ageing_details_location_scope',
                    'location_scope_permission' => 'accounting.account_receivable_ageing_details.view_all_locations',
                ],
                [
                    'permission' => 'accounting.account_payable_ageing_report.view',
                    'label' => __('accounting::lang.account_payable_ageing_report'),
                    'location_scope' => true,
                    'location_scope_name' => 'accounting_account_payable_ageing_report_location_scope',
                    'location_scope_permission' => 'accounting.account_payable_ageing_report.view_all_locations',
                ],
                [
                    'permission' => 'accounting.account_payable_ageing_details.view',
                    'label' => __('accounting::lang.account_payable_ageing_details'),
                    'location_scope' => true,
                    'location_scope_name' => 'accounting_account_payable_ageing_details_location_scope',
                    'location_scope_permission' => 'accounting.account_payable_ageing_details.view_all_locations',
                ],
                [
                    'permission' => 'accounting.daily_transactions_report.view',
                    'label' => __('accounting::lang.daily_transactions_report'),
                    'location_scope' => true,
                    'location_scope_name' => 'accounting_daily_transactions_report_location_scope',
                    'location_scope_permission' => 'accounting.daily_transactions_report.view_all_locations',
                ],
                [
                    'permission' => 'accounting.chart_of_account_report.view',
                    'label' => __('accounting::lang.chart_of_account_report'),
                    'location_scope' => true,
                    'location_scope_name' => 'accounting_chart_of_account_report_location_scope',
                    'location_scope_permission' => 'accounting.chart_of_account_report.view_all_locations',
                ],
            ],
        ],
        [
            'title' => __('accounting::lang.chart_of_accounts'),
            'icon' => 'fa-sitemap',
            'items' => [
                ['permission' => 'accounting.manage_accounts', 'label' => __('accounting::lang.manage_accounts')],
            ],
        ],
        [
            'title' => __('accounting::lang.journal_entry'),
            'icon' => 'fa-book',
            'items' => [
                [
                    'permission' => 'accounting.view_journal',
                    'label' => __('accounting::lang.view_journal'),
                    'location_scope' => true,
                    'location_scope_name' => 'accounting_journal_entry_location_scope',
                    'location_scope_permission' => 'accounting.journal_entry.view_all_locations',
                ],
                ['permission' => 'accounting.add_journal', 'label' => __('accounting::lang.add_journal')],
                ['permission' => 'accounting.edit_journal', 'label' => __('accounting::lang.edit_journal')],
                ['permission' => 'accounting.delete_journal', 'label' => __('accounting::lang.delete_journal')],
            ],
        ],
        [
            'title' => __('accounting::lang.transfer'),
            'icon' => 'fa-exchange-alt',
            'items' => [
                [
                    'permission' => 'accounting.view_transfer',
                    'label' => __('accounting::lang.view_transfer'),
                    'location_scope' => true,
                    'location_scope_name' => 'accounting_transfer_entry_location_scope',
                    'location_scope_permission' => 'accounting.transfer_entry.view_all_locations',
                ],
                ['permission' => 'accounting.add_transfer', 'label' => __('accounting::lang.add_transfer')],
                ['permission' => 'accounting.edit_transfer', 'label' => __('accounting::lang.edit_transfer')],
                ['permission' => 'accounting.delete_transfer', 'label' => __('accounting::lang.delete_transfer')],
            ],
        ],
        [
            'title' => __('accounting::lang.transactions'),
            'icon' => 'fa-receipt',
            'items' => [
                ['permission' => 'accounting.view_transactions', 'label' => __('accounting::lang.view_transactions')],
                ['permission' => 'accounting.map_transactions', 'label' => __('accounting::lang.map_transactions')],
            ],
        ],
        [
            'title' => __('accounting::lang.budget'),
            'icon' => 'fa-calculator',
            'items' => [
                ['permission' => 'accounting.manage_budget', 'label' => __('accounting::lang.manage_budget')],
            ],
        ],
        [
            'title' => __('accounting::lang.security'),
            'icon' => 'fa-user-shield',
            'items' => [
                ['permission' => 'accounting.access_settings', 'label' => __('accounting::lang.access_settings')],
            ],
        ],
        [
            'title' => __('lang_v1.others'),
            'icon' => 'fa-ellipsis-h',
            'items' => [
                ['permission' => 'accounting.manage_cheque_books', 'label' => __('accounting::lang.manage_cheque_books')],
                ['permission' => 'accounting.manage_bank_reconciliation', 'label' => __('accounting::lang.manage_bank_reconciliation')],
            ],
        ],
    ];
?>

<div class="pos-tab-content">
    <?php $__currentLoopData = $accounting_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                        <?php echo Form::radio('radio_option['.$item['location_scope_name'].']', '', ! in_array($item['location_scope_permission'], $module_role_permissions), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('role.own_location'), false); ?>

                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option['.$item['location_scope_name'].']', $item['location_scope_permission'], in_array($item['location_scope_permission'], $module_role_permissions), ['class' => 'form-check-input']); ?>

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
