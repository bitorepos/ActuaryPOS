
<?php $__env->startSection('title', __('role.edit_role')); ?>
<?php $__env->startSection('content'); ?>
<style>
    .role-permissions-container .pos-tab-menu .list-group {
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }
    .role-permissions-container .pos-tab-menu .list-group-item {
        border: none;
        border-bottom: 1px solid #f1f5f9;
        padding: 10px 14px;
        font-size: 13px;
        font-weight: 500;
        color: #475569;
        transition: all 0.15s ease;
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        background: #fff;
    }
    .role-permissions-container .pos-tab-menu .list-group-item:last-child {
        border-bottom: none;
    }
    .role-permissions-container .pos-tab-menu .list-group-item:hover {
        background: #f1f5f9;
        color: #1e293b;
    }
    .role-permissions-container .pos-tab-menu .list-group-item.active {
        background: linear-gradient(135deg, #3461ff 0%, #2850e0 100%);
        color: #fff;
        font-weight: 600;
        border-color: transparent;
    }
    .role-permissions-container .pos-tab-menu .list-group-item.active:after {
        border-left-color: #3461ff !important;
    }
    .role-permissions-container .pos-tab-menu .list-group-item i.tab-icon {
        width: 18px;
        text-align: center;
        font-size: 13px;
        opacity: 0.8;
    }
    .role-permissions-container .pos-tab-menu .list-group-item.active i.tab-icon {
        opacity: 1;
    }
    .role-permissions-container .pos-tab .pos-tab-content .check_group {
        padding: 8px 0;
    }
    .role-permissions-container .pos-tab .pos-tab-content h4 {
        font-size: 15px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 4px;
    }
    .role-permissions-container .pos-tab .pos-tab-content .form-check {
        padding: 3px 0;
    }
    .role-permissions-container .pos-tab .pos-tab-content .form-check-label {
        font-size: 13px;
        color: #475569;
        cursor: pointer;
    }
    .role-permissions-container .pos-tab .pos-tab-content hr {
        border-color: #e2e8f0;
        margin: 12px 0;
    }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'role.edit_role' ); ?></h1>
    <br>
    <?php echo $__env->make('layouts.partials.search_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>
<!-- Main content -->
<section class="content">
    <?php
    $pos_settings = !empty(session('business.pos_settings')) ? json_decode(session('business.pos_settings'), true) : [];
    $common_settings = !empty(session('business.common_settings')) ? session('business.common_settings') : [];
    ?>
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
    <?php echo Form::open(['url' => action([\App\Http\Controllers\RoleController::class, 'update'], [$role->id]), 'method' =>
    'PUT', 'id' => 'role_form' ]); ?>

    <div class="row mb-2">
        <div class="col-md-4">
            <div class="form-group mb-2">
                <?php echo Form::label('name', __( 'user.role_name' ) . ':*'); ?>

                <?php echo Form::text('name', str_replace( '#' . auth()->user()->business_id, '', $role->name) , ['class' =>
                'form-control', 'required', 'placeholder' => __( 'user.role_name' ) ]); ?>

            </div>
        </div>
    </div>
    <div class="row mb-2 role-permissions-container">
        <div class="col-12">
            <h4 class="h4"><?php echo app('translator')->get( 'user.permissions' ); ?>:</h4>
        </div>
        <div class="row col-12">
            <div class="col-2 pos-tab-menu">
                <div class="list-group">
                    <a href="#" class="list-group-item active"><i class="fas fa-ellipsis-h tab-icon"></i> <?php echo app('translator')->get( 'lang_v1.others' ); ?></a>
                    <a href="#" class="list-group-item"><i class="fas fa-tachometer-alt tab-icon"></i> <?php echo app('translator')->get('role.dashboard'); ?></a>
                    <a href="#" class="list-group-item"><i class="fas fa-address-book tab-icon"></i> <?php echo app('translator')->get( 'contact.contacts'); ?></a>
                    <?php if(in_array('pos_sale', $enabled_modules)): ?>
                    <a href="#" class="list-group-item"><i class="fas fa-cash-register tab-icon"></i> <?php echo app('translator')->get('sale.pos_sale'); ?></a>
                    <?php endif; ?>
                    <?php if(in_array('add_sale', $enabled_modules)): ?>
                    <a href="#" class="list-group-item"><i class="fas fa-shopping-cart tab-icon"></i> <?php echo app('translator')->get('sale.sale'); ?></a>
                    <?php endif; ?>
                    <a href="#" class="list-group-item"><i class="fas fa-box tab-icon"></i> <?php echo app('translator')->get( 'business.product' ); ?></a>
                    <?php if(in_array('purchases', $enabled_modules)): ?>
                    <a href="#" class="list-group-item"><i class="fas fa-truck tab-icon"></i> <?php echo app('translator')->get('role.purchases'); ?></a>
                    <?php endif; ?>
                    <?php if(in_array('stock_transfers', $enabled_modules)): ?>
                    <a href="#" class="list-group-item"><i class="fas fa-exchange-alt tab-icon"></i> <?php echo app('translator')->get('role.stock_transfers'); ?></a>
                    <?php endif; ?>
                    <?php if(in_array('stock_adjustment', $enabled_modules)): ?>
                    <a href="#" class="list-group-item"><i class="fas fa-sliders-h tab-icon"></i> <?php echo app('translator')->get('role.stock_adjustment'); ?></a>
                    <?php endif; ?>
                    <?php if(in_array('expenses', $enabled_modules)): ?>
                    <a href="#" class="list-group-item"><i class="fas fa-money-bill-wave tab-icon"></i> <?php echo app('translator')->get('lang_v1.expense'); ?></a>
                    <?php endif; ?>
                    <?php if(in_array('account', $enabled_modules)): ?>
                    <a href="#" class="list-group-item"><i class="fas fa-university tab-icon"></i> <?php echo app('translator')->get('lang_v1.payment_accounts'); ?></a>
                    <?php endif; ?>
                    <?php if(in_array('tables', $enabled_modules) || in_array('booking', $enabled_modules) || in_array('kitchen', $enabled_modules) || in_array('service_staff', $enabled_modules) || in_array('quick_menu', $enabled_modules)): ?>
                    <a href="#" class="list-group-item"><i class="fas fa-utensils tab-icon"></i> <?php echo app('translator')->get('restaurant.restaurant'); ?></a>
                    <?php endif; ?>
                    <a href="#" class="list-group-item"><i class="fas fa-chart-bar tab-icon"></i> <?php echo app('translator')->get('role.reports'); ?></a>
                    <a href="#" class="list-group-item"><i class="fas fa-user-shield tab-icon"></i> <?php echo app('translator')->get( 'user.user_security' ); ?></a>
                    <a href="#" class="list-group-item"><i class="fas fa-cog tab-icon"></i> <?php echo app('translator')->get('role.settings'); ?></a>
                    <?php $__currentLoopData = $module_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="#" class="list-group-item"><i class="fas fa-puzzle-piece tab-icon"></i> <?php echo e($key, false); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-10 pos-tab">
                
                <div class="pos-tab-content active">
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'lang_v1.others' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <?php if(in_array('service_staff', $enabled_modules)): ?>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('is_service_staff', 1, $role->is_service_staff,
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'restaurant.service_staff' ), false); ?>

                                    </label>
                                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('restaurant.tooltip_service_staff') . '"></i>';
                }
            ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'view_export_buttons', in_array('view_export_buttons',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_export_buttons' ), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="pos-tab-content">
                    <div class="row">
                        <div class="col-md-3">
                            <h4><?php echo app('translator')->get( 'role.dashboard' ); ?></h4>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'dashboard.data', in_array('dashboard.data',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.dashboard.data' ), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="pos-tab-content">
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'role.supplier' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[supplier_view]', 'supplier.view', in_array('supplier.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_all_supplier' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[supplier_view]', 'supplier.view_own',
                                        in_array('supplier.view_own', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_own_supplier' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[supplier_location_view]', 'supplier.view_all_locations',
                                        in_array('supplier.view_all_locations', $role_permissions),
                                        ['class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.view_all_locations_supplier'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[supplier_location_view]', 'supplier.view_own_location',
                                        in_array('supplier.view_own_location', $role_permissions),
                                        ['class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.view_own_location_supplier'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'supplier.create', in_array('supplier.create',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.supplier.create' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'supplier.update', in_array('supplier.update',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.supplier.update' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'supplier.delete', in_array('supplier.delete',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.supplier.delete' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'supplier.advance_deposit.edit', in_array('supplier.advance_deposit.edit', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.supplier.advance_deposit.edit' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'supplier.advance_deposit.delete', in_array('supplier.advance_deposit.delete', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.supplier.advance_deposit.delete' ), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'role.customer' ); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.customer_permissions_tooltip') . '"></i>';
                }
            ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[customer_view]', 'customer.view', in_array('customer.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_all_customer' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[customer_view]', 'customer.view_own',
                                        in_array('customer.view_own', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_own_customer' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[customer_location_view]', 'customer.view_all_locations',
                                        in_array('customer.view_all_locations', $role_permissions),
                                        ['class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.view_all_locations_customer'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[customer_location_view]', 'customer.view_own_location',
                                        in_array('customer.view_own_location', $role_permissions),
                                        ['class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.view_own_location_customer'), false); ?>

                                    </label>
                                </div>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[customer_view_by_sell]', 'customer_with_no_sell_one_month',
                                        in_array('customer_with_no_sell_one_month', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.customer_with_no_sell_one_month' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[customer_view_by_sell]', 'customer_with_no_sell_three_month',
                                        in_array('customer_with_no_sell_three_month', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.customer_with_no_sell_three_month' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[customer_view_by_sell]', 'customer_with_no_sell_six_month',
                                        in_array('customer_with_no_sell_six_month', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.customer_with_no_sell_six_month' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[customer_view_by_sell]', 'customer_with_no_sell_one_year',
                                        in_array('customer_with_no_sell_one_year', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.customer_with_no_sell_one_year' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[customer_view_by_sell]', 'customer_irrespective_of_sell',
                                        in_array('customer_irrespective_of_sell', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.customer_irrespective_of_sell' ), false); ?>

                                    </label>
                                </div>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'customer.create', in_array('customer.create',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.customer.create' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'customer.update', in_array('customer.update',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.customer.update' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'customer.delete', in_array('customer.delete',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.customer.delete' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'customer.advance_deposit.edit', in_array('customer.advance_deposit.edit', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.customer.advance_deposit.edit' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'customer.advance_deposit.delete', in_array('customer.advance_deposit.delete', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.customer.advance_deposit.delete' ), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                <?php if(in_array('pos_sale', $enabled_modules)): ?>
                <div class="pos-tab-content">
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'sale.pos_sale' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?php echo $__env->make('role.partials.location_scope_radios', [
                                'location_scope_name' => 'pos_sale_location_scope',
                                'location_scope_permission' => 'sell.view_all_locations',
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::radio('radio_option[pos_sell_view]', 'sell.view', in_array('sell.view', $role_permissions),
                                        [ 'class' => 'form-check-input pos-sell-view-radio']); ?> <?php echo e(__( 'role.sell.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::radio('radio_option[pos_sell_view]', 'sell.view_own', !in_array('sell.view', $role_permissions) && in_array('sell.view_own', $role_permissions),
                                        [ 'class' => 'form-check-input pos-sell-view-radio']); ?> <?php echo e(__( 'role.sell.view_own' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <?php if(in_array('pos_sale', $enabled_modules)): ?>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'sell.create', in_array('sell.create', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.sell.create' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'sell.update', in_array('sell.update', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.sell.update' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'sell.delete', in_array('sell.delete', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.sell.delete' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'sell.change_location', in_array('sell.change_location', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.sell.change_location' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_pos_payment',
                                        in_array('edit_pos_payment', $role_permissions), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.add_edit_payment'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'reprint_invoice', in_array('reprint_invoice',
                                        $role_permissions), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.reprint_invoice'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'disable_changing_entered_products_on_pos',
                                        in_array('disable_changing_entered_products_on_pos', $role_permissions), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.disable_changing_entered_products_on_pos'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_product_price_from_pos_screen',
                                        in_array('edit_product_price_from_pos_screen', $role_permissions), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.edit_product_price_from_pos_screen'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_product_discount_from_pos_screen',
                                        in_array('edit_product_discount_from_pos_screen', $role_permissions), ['class' =>
                                        'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.edit_product_discount_from_pos_screen'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_product_tax_from_pos_screen',
                                        in_array('edit_product_tax_from_pos_screen', $role_permissions), ['class' =>
                                        'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.edit_product_tax_from_pos_screen'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_product_subtotal_from_pos_screen',
                                        in_array('edit_product_subtotal_from_pos_screen', $role_permissions), ['class' =>
                                        'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.edit_product_subtotal_from_pos_screen'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'print_invoice', in_array('print_invoice',
                                        $role_permissions), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.print_invoice'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_invoice_discount_from_pos_screen',
                                        in_array('edit_invoice_discount_from_pos_screen', $role_permissions), ['class' =>
                                        'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.edit_invoice_discount_from_pos_screen'), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <h4>Payment Buttons</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'payment_btn.hide_draft', in_array('payment_btn.hide_draft',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.payment_btn.hide_draft' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'payment_btn.hide_quotation',
                                        in_array('payment_btn.hide_quotation', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.payment_btn.hide_quotation' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'payment_btn.hide_suspend',
                                        in_array('payment_btn.hide_suspend', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.payment_btn.hide_suspend' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'payment_btn.hide_credit_sale',
                                        in_array('payment_btn.hide_credit_sale', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.payment_btn.hide_credit_sale' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'payment_btn.hide_card', in_array('payment_btn.hide_card',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.payment_btn.hide_card' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'payment_btn.hide_multipay',
                                        in_array('payment_btn.hide_multipay', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.payment_btn.hide_multipay' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'payment_btn.hide_takeaway',
                                        in_array('payment_btn.hide_takeaway', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.payment_btn.hide_takeaway' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'payment_btn.hide_cash', in_array('payment_btn.hide_cash',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.payment_btn.hide_cash' ), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php if(!empty($payment_methods) && count($payment_methods) > 0): ?>
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'role.payment_settings' ); ?></h4>
                        </div>
                        <div class="col-md-11">
                            <div class="row">
                                <?php $__currentLoopData = $payment_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method_key => $method_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::checkbox('permissions[]', 'payment_method.disable_' . $method_key, in_array('payment_method.disable_' . $method_key, $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.payment_method.disable' ), false); ?> (<?php echo e($method_name, false); ?>)
                                        </label>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php endif; ?>
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'cash_register.cash_register' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'view_cash_register_details', in_array('view_cash_register_details',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_cash_register_details' ), false); ?>

                                    </label>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'restrict_view_cash_register_details', in_array('restrict_view_cash_register_details', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.restrict_view_cash_register_details' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'view_cash_register_closing', in_array('view_cash_register_closing', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_cash_register_closing' ), false); ?>

                                    </label>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'restrict_view_cash_register_closing', in_array('restrict_view_cash_register_closing', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.restrict_view_cash_register_closing' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'sale.draft' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[draft_view]', 'draft.view_all', in_array('draft.view_all',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_all_drafts' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[draft_view]', 'draft.view_own', in_array('draft.view_own',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_own_drafts' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'draft.update', in_array('draft.update', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.edit_draft' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'draft.delete', in_array('draft.delete', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.delete_draft' ), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(!in_array('add_sale', $enabled_modules)): ?>
                        <?php echo $__env->make('role.partials.sell_return_permissions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                
                
                <?php if(in_array('add_sale', $enabled_modules)): ?>
                <div class="pos-tab-content">
                        <div class="row check_group">
                            <div class="col-md-1">
                                <h4><?php echo app('translator')->get( 'sale.sale' ); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.sell_permissions_tooltip') . '"></i>';
                }
            ?></h4>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <?php if(in_array('add_sale', $enabled_modules)): ?>
                                <?php echo $__env->make('role.partials.location_scope_radios', [
                                    'location_scope_name' => 'direct_sell_location_scope',
                                    'location_scope_permission' => 'direct_sell.view_all_locations',
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::radio('radio_option[sell_view]', 'direct_sell.view', in_array('direct_sell.view',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_all_sale' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::radio('radio_option[sell_view]', 'view_own_sell_only', in_array('view_own_sell_only',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_own_sell_only' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'view_paid_sells_only', in_array('view_paid_sells_only',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_paid_sells_only' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'view_due_sells_only', in_array('view_due_sells_only',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_due_sells_only' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'view_partial_sells_only',
                                            in_array('view_partial_sells_only', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_partially_paid_sells_only' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'view_overdue_sells_only',
                                            in_array('view_overdue_sells_only', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_overdue_sells_only' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'direct_sell.access', in_array('direct_sell.access',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.add_sell' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'direct_sell.update', in_array('direct_sell.update',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.update_sale' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'direct_sell.delete', in_array('direct_sell.delete',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.delete_sell' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'view_commission_agent_sell',
                                            in_array('view_commission_agent_sell', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_commission_agent_sell' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'sell.payments', in_array('sell.payments',
                                            $role_permissions), ['class' => 'form-check-input']); ?>

                                            <?php echo e(__('lang_v1.add_sell_payment'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_sell_payment', in_array('edit_sell_payment',
                                            $role_permissions), ['class' => 'form-check-input']); ?>

                                            <?php echo e(__('lang_v1.edit_sell_payment'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'delete_sell_payment', in_array('delete_sell_payment',
                                            $role_permissions), ['class' => 'form-check-input']); ?>

                                            <?php echo e(__('lang_v1.delete_sell_payment'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_product_name_from_sale_screen',
                                            in_array('edit_product_name_from_sale_screen', $role_permissions), ['class' =>
                                            'form-check-input']); ?>

                                            <?php echo e(__('lang_v1.edit_product_name_from_sale_screen'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_product_price_from_sale_screen',
                                            in_array('edit_product_price_from_sale_screen', $role_permissions), ['class' =>
                                            'form-check-input']); ?>

                                            <?php echo e(__('lang_v1.edit_product_price_from_sale_screen'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_product_discount_from_sale_screen',
                                            in_array('edit_product_discount_from_sale_screen', $role_permissions), ['class' =>
                                            'form-check-input']); ?>

                                            <?php echo e(__('lang_v1.edit_product_discount_from_sale_screen'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_product_subtotal_from_sale_screen',
                                            in_array('edit_product_subtotal_from_sale_screen', $role_permissions), ['class' =>
                                            'form-check-input']); ?>

                                            <?php echo e(__('lang_v1.edit_product_subtotal_from_sale_screen'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_product_price_group_from_sale_screen',
                                            in_array('edit_product_price_group_from_sale_screen', $role_permissions), ['class' =>
                                            'form-check-input']); ?>

                                            <?php echo e(__('lang_v1.edit_product_price_group_from_sale_screen'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::checkbox('permissions[]', 'reprint_sale_invoice', in_array('reprint_sale_invoice',
                                            $role_permissions), ['class' => 'form-check-input']); ?>

                                            <?php echo e(__('lang_v1.reprint_sale_invoice'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::checkbox('permissions[]', 'discount.access', in_array('discount.access',
                                            $role_permissions), ['class' => 'form-check-input']); ?>

                                            <?php echo e(__('lang_v1.discount.access'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <?php if(in_array('types_of_service', $enabled_modules)): ?>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'access_types_of_service',
                                            in_array('access_types_of_service', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.access_types_of_service' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::checkbox('permissions[]', 'edit_sale_ref_no',  in_array('edit_sale_ref_no', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.add_edit_ref_number' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::checkbox('permissions[]', 'enable_scheme_quantity_column', in_array('enable_scheme_quantity_column',
                                            $role_permissions), ['class' =>
                                            'form-check-input']); ?>

                                            <?php echo e(__('lang_v1.enable_scheme_quantity_column'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'disable_editable_scheme_quantity', in_array('disable_editable_scheme_quantity',
                                            $role_permissions), ['class' =>
                                            'form-check-input']); ?>

                                            <?php echo e(__('lang_v1.disable_editable_scheme_quantity'), false); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php echo $__env->make('role.partials.sell_return_permissions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
                    <?php if(!empty($pos_settings['enable_sales_order'])): ?>
                    <hr>
                        <div class="row check_group">
                            <div class="col-md-1">
                                <h4><?php echo app('translator')->get( 'lang_v1.sales_order' ); ?></h4>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::radio('radio_option[so_view]', 'so.view_all', in_array('so.view_all',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_all_so' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::radio('radio_option[so_view]', 'so.view_own', in_array('so.view_own',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_own_so' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'so.create', in_array('so.create', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.create_so' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'so.update', in_array('so.update', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.edit_so' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'so.delete', in_array('so.delete', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.delete_so' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(!empty($pos_settings['enable_quotations'])): ?>
                    <hr>
                        <div class="row check_group">
                            <div class="col-md-1">
                                <h4><?php echo app('translator')->get( 'lang_v1.quotation' ); ?></h4>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::radio('radio_option[quotation_view]', 'quotation.view_all',
                                            in_array('quotation.view_all', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_all_quotations' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::radio('radio_option[quotation_view]', 'quotation.view_own',
                                            in_array('quotation.view_own', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_own_quotations' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'quotation.update', in_array('quotation.update',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.edit_quotation' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'quotation.delete', in_array('quotation.delete',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.delete_quotation' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <hr>
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'lang_v1.shipments' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[shipping_view]', 'access_shipping', in_array('access_shipping',
                                        $role_permissions), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.access_all_shipments'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[shipping_view]', 'access_own_shipping',
                                        in_array('access_own_shipping', $role_permissions), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.access_own_shipping'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'access_pending_shipments_only',
                                        in_array('access_pending_shipments_only', $role_permissions), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.access_pending_shipments_only'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'access_commission_agent_shipping',
                                        in_array('access_commission_agent_shipping', $role_permissions), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.access_commission_agent_shipping'), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php if(!empty($common_settings['enable_delivery_notes'])): ?>
                    <hr>
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'lang_v1.delivery_note' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::checkbox('permissions[]', 'delivery_note.access', in_array('delivery_note.access', $role_permissions), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.access_delivery_notes'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::checkbox('permissions[]', 'delivery_note.create', in_array('delivery_note.create', $role_permissions), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.create_delivery_notes'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::checkbox('permissions[]', 'delivery_note.edit', in_array('delivery_note.edit', $role_permissions), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.edit_delivery_notes'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::checkbox('permissions[]', 'delivery_note.delete', in_array('delivery_note.delete', $role_permissions), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.delete_delivery_notes'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::checkbox('permissions[]', 'delivery_note.allow_due_partial_invoice', in_array('delivery_note.allow_due_partial_invoice', $role_permissions), ['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.allow_due_partial_invoice_delivery_note'), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>


                
                <div class="pos-tab-content">
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'business.product' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'product.view', in_array('product.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.product.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'product.view_stock_history', in_array('product.view_stock_history',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.product.view_stock_history' ), false); ?>

                                    </label>
                                    <div class="ms-4 mt-1">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
<?php echo Form::radio('radio_option[product_view_stock_history_location_scope]', '', ! in_array('product.view_stock_history.view_all_locations', $role_permissions),
                                                ['class' => 'form-check-input']); ?> <?php echo e(__('role.own_location'), false); ?>

                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
<?php echo Form::radio('radio_option[product_view_stock_history_location_scope]', 'product.view_stock_history.view_all_locations', in_array('product.view_stock_history.view_all_locations', $role_permissions),
                                                ['class' => 'form-check-input']); ?> <?php echo e(__('role.all_locations'), false); ?>

                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'product.create', in_array('product.create',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.product.create' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'product.update', in_array('product.update',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.product.update' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'product.delete', in_array('product.delete',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.product.delete' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'product.opening_stock', in_array('product.opening_stock',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.add_opening_stock' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'view_purchase_price', in_array('view_purchase_price',
                                        $role_permissions),['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.view_purchase_price'), false); ?>

                                    </label>
                                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.view_purchase_price_tooltip') . '"></i>';
                }
            ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo e(__('lang_v1.product_note'), false); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'product_note.view', in_array('product_note.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.product_note.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'product_note.create', in_array('product_note.create', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.product_note.create' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'product_note.update', in_array('product_note.update', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.product_note.update' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'product_note.delete', in_array('product_note.delete', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.product_note.delete' ), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <h4><?php echo app('translator')->get( 'lang_v1.access_selling_price_groups' ); ?></h4>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'access_default_selling_price',
                                        in_array('access_default_selling_price', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.default_selling_price'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <?php if(count($selling_price_groups) > 0): ?>
                            <?php $__currentLoopData = $selling_price_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selling_price_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('spg_permissions[]', 'selling_price_group.' . $selling_price_group->id,
                                        in_array('selling_price_group.' . $selling_price_group->id, $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e($selling_price_group->name, false); ?>

                                    </label>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'role.unit' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'unit.view', in_array('unit.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.unit.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'unit.create', in_array('unit.create', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.unit.create' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'unit.update', in_array('unit.update', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.unit.update' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'unit.delete', in_array('unit.delete', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.unit.delete' ), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'category.category' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'category.view', in_array('category.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.category.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'category.create', in_array('category.create',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.category.create' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'category.update', in_array('category.update',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.category.update' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'category.delete', in_array('category.delete',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.category.delete' ), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'role.brand' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'brand.view', in_array('brand.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.brand.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'brand.create', in_array('brand.create', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.brand.create' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'brand.update', in_array('brand.update', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.brand.update' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'brand.delete', in_array('brand.delete', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.brand.delete' ), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 
                 
                
                
                
                
                
                
                
                
                
                <?php if(in_array('purchases', $enabled_modules)): ?>
                <div class="pos-tab-content">
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'role.purchases' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <?php echo $__env->make('role.partials.location_scope_radios', [
                                'location_scope_name' => 'purchase_location_scope',
                                'location_scope_permission' => 'purchase.view_all_locations',
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[purchase_view]', 'purchase.view', in_array('purchase.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_all_purchase' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[purchase_view]', 'view_own_purchase',
                                        in_array('view_own_purchase', $role_permissions),['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.view_own_purchase'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase.create', in_array('purchase.create',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.purchase.create' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase.update', in_array('purchase.update',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.purchase.update' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase.delete', in_array('purchase.delete',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.purchase.delete' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase.payments', in_array('purchase.payments',
                                        $role_permissions),['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.add_purchase_payment'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_purchase_payment', in_array('edit_purchase_payment',
                                        $role_permissions),['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.edit_purchase_payment'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'delete_purchase_payment',
                                        in_array('delete_purchase_payment', $role_permissions),['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.delete_purchase_payment'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase.update_status', in_array('purchase.update_status',
                                        $role_permissions),['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.update_status'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase_returns.create', in_array('purchase_returns.create',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.purchase_returns.create' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase_returns.update', in_array('purchase_returns.update',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.purchase_returns.update' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase_returns.delete', in_array('purchase_returns.delete',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.purchase_returns.delete' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase_returns.payments', in_array('purchase_returns.payments',
                                        $role_permissions),['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.add_purchase_payment'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_purchase_returns_payment', in_array('edit_purchase_returns_payment',
                                        $role_permissions),['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.edit_purchase_returns_payment'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'delete_purchase_returns_payment',
                                        in_array('delete_purchase_returns_payment', $role_permissions),['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.delete_purchase_returns_payment'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase_returns.update_status', in_array('purchase_returns.update_status',
                                        $role_permissions),['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.update_status'), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php if(!empty($common_settings['enable_purchase_requisition'])): ?>
                        <hr>
                        <div class="row check_group">
                            <div class="col-md-1">
                                <h4><?php echo app('translator')->get( 'lang_v1.purchase_requisition' ); ?></h4>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::radio('radio_option[purchase_requisition_view]', 'purchase_requisition.view_all',
                                            in_array('purchase_requisition.view_all', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_all_purchase_requisition' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::radio('radio_option[purchase_requisition_view]', 'purchase_requisition.view_own',
                                            in_array('purchase_requisition.view_own', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_own_purchase_requisition' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase_requisition.create',
                                            in_array('purchase_requisition.create', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.create_purchase_requisition' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase_requisition.delete',
                                            in_array('purchase_requisition.delete', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.delete_purchase_requisition' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($common_settings['enable_purchase_order'])): ?>
                        <hr>
                        <div class="row check_group">
                            <div class="col-md-1">
                                <h4><?php echo app('translator')->get( 'lang_v1.purchase_order' ); ?></h4>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::radio('radio_option[purchase_order_view]', 'purchase_order.view_all',
                                            in_array('purchase_order.view_all', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_all_purchase_order' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::radio('radio_option[purchase_order_view]', 'purchase_order.view_own',
                                            in_array('purchase_order.view_own', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_own_purchase_order' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase_order.create', in_array('purchase_order.create',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.create_purchase_order' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase_order.update', in_array('purchase_order.update',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.edit_purchase_order' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase_order.delete', in_array('purchase_order.delete',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.delete_purchase_order' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <?php if(in_array('stock_transfers', $enabled_modules)): ?>
                <div class="pos-tab-content">
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'role.stock_transfers' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <?php echo $__env->make('role.partials.location_scope_radios', [
                                'location_scope_name' => 'stock_transfers_location_scope',
                                'location_scope_permission' => 'stock_transfers.view_all_locations',
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[stock_transfers_view]', 'stock_transfers.view', in_array('stock_transfers.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_all_stock_transfers' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[stock_transfers_view]', 'view_own_stock_transfer',
                                        in_array('view_own_stock_transfer', $role_permissions),['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.view_own_stock_transfers'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'stock_transfers.create', in_array('stock_transfers.create',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.stock_transfers.create' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'stock_transfers.update', in_array('stock_transfers.update',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.stock_transfers.update' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'stock_transfers.delete', in_array('stock_transfers.delete',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.stock_transfers.delete' ), false); ?>

                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'stock_issue_receive', in_array('stock_issue_receive',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.stock_issue_receive' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if(in_array('stock_adjustment', $enabled_modules)): ?>
                <div class="pos-tab-content">
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'role.stock_adjustment' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <?php echo $__env->make('role.partials.location_scope_radios', [
                                'location_scope_name' => 'stock_adjustment_location_scope',
                                'location_scope_permission' => 'stock_adjustment.view_all_locations',
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[stock_adjustment_view]', 'stock_adjustment.view', in_array('stock_adjustment.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_all_stock_adjustment' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::radio('radio_option[stock_adjustment_view]', 'view_own_stock_adjustment',
                                        in_array('view_own_stock_adjustment', $role_permissions),['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.view_own_stock_adjustment'), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'stock_adjustment.create', in_array('stock_adjustment.create',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.stock_adjustment.create' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'stock_adjustment.delete', in_array('stock_adjustment.delete',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.stock_adjustment.delete' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                
                
                
                
                <?php if(in_array('expenses', $enabled_modules)): ?>
                <div class="pos-tab-content">
                   <div class="row check_group">
                       <div class="col-md-1">
                           <h4><?php echo app('translator')->get( 'lang_v1.expense' ); ?></h4>
                       </div>
                       <div class="col-md-2">
                           <div class="form-check">
                               <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                               </label>
                           </div>
                       </div>
                       <div class="col-md-9">
                            <?php echo $__env->make('role.partials.location_scope_radios', [
                                'location_scope_name' => 'expense_location_scope',
                                'location_scope_permission' => 'expense.view_all_locations',
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="col-md-12">
                               <div class="form-check">
                                   <label class="form-check-label">
                                       <?php echo Form::radio('radio_option[expense_view]', 'all_expense.access',
                                       in_array('all_expense.access', $role_permissions),
                                       [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.access_all_expense' ), false); ?>

                                   </label>
                               </div>
                           </div>
                           <div class="col-md-12">
                               <div class="form-check">
                                   <label class="form-check-label">
                                       <?php echo Form::radio('radio_option[expense_view]', 'view_own_expense', in_array('view_own_expense',
                                       $role_permissions),['class' => 'form-check-input']); ?>

                                       <?php echo e(__('lang_v1.view_own_expense'), false); ?>

                                   </label>
                               </div>
                           </div>
                           <div class="col-md-12">
                               <div class="form-check">
                                   <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'expense.add', in_array('expense.add', $role_permissions),
                                       [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'expense.add_expense' ), false); ?>

                                   </label>
                               </div>
                           </div>
                           <div class="col-md-12">
                               <div class="form-check">
                                   <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'expense.edit', in_array('expense.edit', $role_permissions),
                                       [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'expense.edit_expense' ), false); ?>

                                   </label>
                               </div>
                           </div>
                           <div class="col-md-12">
                               <div class="form-check">
                                   <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'expense.update_status', in_array('expense.update_status', $role_permissions),
                                       [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.update_status' ), false); ?>

                                   </label>
                               </div>
                           </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'expense.delete', in_array('expense.delete',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.delete_expense' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'expense_category.add', in_array('expense_category.add',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'expense.add_expense_category' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'expense_category.edit', in_array('expense_category.edit',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'expense.edit_expense_category' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'expense_category.delete', in_array('expense_category.delete',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'expense.delete_expense_category' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'expense.payments', in_array('expense.payments',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.add_expense_payment' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_expense_payment', in_array('edit_expense_payment',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.edit_expense_payment' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'delete_expense_payment', in_array('delete_expense_payment',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.delete_expense_payment' ), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                <?php endif; ?>
                <?php if(in_array('account', $enabled_modules)): ?>
                
                <div class="pos-tab-content">
                    <div class="row check_group">
                        <div class="col-md-3">
                            <h4><?php echo app('translator')->get( 'lang_v1.payment_accounts' ); ?></h4>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'account.access', in_array('account.access',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.access_accounts' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'account.add', in_array('account.add',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.add_accounts' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'account.edit', in_array('account.edit',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.edit_accounts' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'account.delete', in_array('account.delete',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.delete_accounts' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'account.account_book', in_array('account.account_book',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'account.account_book' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'account.fund_transfer', in_array('account.fund_transfer',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'account.fund_transfer' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'account.deposit', in_array('account.deposit',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'account.deposit' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'account.accounts_list', in_array('account.accounts_list',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'account.list_accounts' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'account.cash_flow', in_array('account.cash_flow',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.cash_flow' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'account.payment_account_report', in_array('account.payment_account_report',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'account.payment_account_report' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if(in_array('tables', $enabled_modules) || in_array('booking', $enabled_modules) || in_array('kitchen', $enabled_modules) || in_array('service_staff', $enabled_modules) || in_array('quick_menu', $enabled_modules)): ?>
                <div class="pos-tab-content">
                        <?php if(in_array('tables', $enabled_modules)): ?>
                        <div class="row check_group">
                            
                                <div class="col-md-1">
                                    <h4><?php echo app('translator')->get( 'restaurant.tables' ); ?></h4>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'access_tables', in_array('access_tables',
                                                $role_permissions),
                                                [ 'class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.access_tables'), false); ?>

                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'tables.add', in_array('tables.add',
                                                $role_permissions),
                                                [ 'class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.add_tables'), false); ?>

                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'tables.edit', in_array('tables.edit',
                                                $role_permissions),
                                                [ 'class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.edit_tables'), false); ?>

                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'tables.delete', in_array('tables.delete',
                                                $role_permissions),
                                                [ 'class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.delete_tables'), false); ?>

                                            </label>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                        <?php endif; ?>
                        <?php if(in_array('quick_menu', $enabled_modules)): ?>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <h4><?php echo app('translator')->get( 'business.quick_menu' ); ?></h4>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'access_quick_menu', in_array('access_quick_menu',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.access_quick_menu'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'edit_quick_menu_buttons',
                                            in_array('edit_quick_menu_buttons', $role_permissions), ['class' => 'form-check-input']); ?>

                                            <?php echo e('Edit Quick Menu Buttons', false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'allow_table_order_assign_after_bill',
                                            in_array('allow_table_order_assign_after_bill', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.allow_table_order_assign_after_bill'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'table.printed_table_order_edit', in_array('table.printed_table_order_edit',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.printed_table_order_edit'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'table.delete_order', in_array('table.delete_order',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.allow_table_order_delete'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'table.view_restricted_table', in_array('table.view_restricted_table', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.view_restricted_table'), false); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'table.order_checkout', in_array('table.order_checkout',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.disable_table_order_checkout'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'table.order_print_bill', in_array('table.order_print_bill',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.disable_table_order_print_bill'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'table.move_order', in_array('table.move_order',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.disable_table_order_move'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'table.reprint_kot', in_array('table.reprint_kot',
                                            $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.disable_table_reprint_kot'), false); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(in_array('kitchen', $enabled_modules)): ?>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <h4><?php echo app('translator')->get( 'restaurant.kitchen' ); ?></h4>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'access_kitchen_screen', in_array('access_kitchen_screen', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.access_kitchen_screen'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(in_array('service_staff', $enabled_modules)): ?>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <h4><?php echo app('translator')->get( 'restaurant.service_staff' ); ?></h4>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'access_orders_screen', in_array('access_orders_screen', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.access_orders_screen'), false); ?>

                                        </label>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(in_array('booking', $enabled_modules)): ?>
                        <hr>
                        <div class="row check_group">
                            <div class="col-md-1">
                                <h4><?php echo app('translator')->get( 'restaurant.bookings' ); ?></h4>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::radio('radio_option[bookings_view]', 'crud_all_bookings',
                                            in_array('crud_all_bookings', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'restaurant.add_edit_view_all_booking' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <?php echo Form::radio('radio_option[bookings_view]', 'crud_own_bookings',
                                            in_array('crud_own_bookings', $role_permissions),
                                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'restaurant.add_edit_view_own_booking' ), false); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                </div>
                <?php endif; ?>
                
                
                
                
                
                <?php echo $__env->make('role.partials.report_permissions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php if(false): ?>
                <div class="pos-tab-content">
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'role.reports' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::checkbox('permissions[]', 'access_reports.view',
                                        in_array('access_reports.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.access_reports' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::checkbox('permissions[]', 'report.view_all_locations',
                                        in_array('report.view_all_locations', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.report.view_all_locations' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::checkbox('permissions[]', 'profit_loss_report.view',
                                        in_array('profit_loss_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.profit_loss_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::checkbox('permissions[]', 'show_report_606.view',
                                        in_array('show_report_606.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.show_report_606.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::checkbox('permissions[]', 'show_report_607.view',
                                        in_array('show_report_607.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.show_report_607.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <?php if(in_array('purchases', $enabled_modules) || in_array('add_sale', $enabled_modules) ||
                            in_array('pos_sale', $enabled_modules)): ?>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase_n_sell_report.view',
                                        in_array('purchase_n_sell_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.purchase_n_sell_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'tax_report.view', in_array('tax_report.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.tax_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'contacts_report.view', in_array('contacts_report.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'report.contacts.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'customer_groups_report.view', in_array('customer_groups_report.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.customer_groups_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::checkbox('permissions[]', 'stock_report.view', in_array('stock_report.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.stock_report.view' ), false); ?>

                                    </label>
                                </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::checkbox('permissions[]', 'stock_report.view_all_locations', in_array('stock_report.view_all_locations',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.stock_report.view_all_locations' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'view_product_stock_value.view',
                                        in_array('view_product_stock_value.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_product_stock_value.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::checkbox('permissions[]', 'hide_stock_report_prices',
                                        in_array('hide_stock_report_prices', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_stock_report_prices' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::checkbox('permissions[]', 'view_product_reorder_report.view',
                                        in_array('view_product_reorder_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_product_reorder_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'opening_stock_report.view', in_array('opening_stock_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.opening_stock_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'stock_expiry_report.view', in_array('stock_expiry_report.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'report.stock_expiry_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'lot_report.view', in_array('lot_report.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.lot_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'stock_adjustment_report.view', in_array('stock_adjustment_report.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'report.stock_adjustment_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'stock_take_report.view', in_array('stock_take_report.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.stock_take_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'trending_product_report.view',
                                        in_array('trending_product_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.trending_product_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'sales_analysis_report.view', 
                                        in_array('sales_analysis_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.sales_analysis_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase_analysis_report.view', 
                                        in_array('purchase_analysis_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.purchase_analysis_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'items_report.view', 
                                        in_array('items_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.items_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'combo_items_report.view', 
                                        in_array('combo_items_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.combo_items_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'product_purchase_report.view', 
                                        in_array('product_purchase_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.product_purchase_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'product_sell_report.view', 
                                        in_array('product_sell_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.product_sell_report.view' ), false); ?>

                                    </label>
                                </div>
                                <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'product_sell_report.hide_product_sale_values', 
                                        in_array('product_sell_report.hide_product_sale_values', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.product_sell_report.hide_product_sale_values' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'product_status_report.view', 
                                        in_array('product_status_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.product_status_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'product_serial_report.view', 
                                        in_array('product_serial_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.product_serial_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'sale_invoices_report.view', 
                                        in_array('sale_invoices_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.sale_invoices_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'sales_returns_report.view', 
                                        in_array('sales_returns_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.sales_returns_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'stock_transfer_report.view', 
                                        in_array('stock_transfer_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.stock_transfer_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchase_payment_report.view', 
                                        in_array('purchase_payment_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.purchase_payment_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'purchases_returns_report.view', 
                                        in_array('purchases_returns_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.purchases_returns_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'sell_payment_report.view', 
                                        in_array('sell_payment_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.sell_payment_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'payment_recovery_report.view', 
                                        in_array('payment_recovery_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.payment_recovery_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'discounts_report.view', 
                                        in_array('discounts_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.discounts_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'product_booking_report.view', 
                                        in_array('product_booking_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.product_booking_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'bookings_report.view',
                                        in_array('bookings_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.bookings_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'cheque_clearance_report.view', 
                                        in_array('cheque_clearance_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.cheque_clearance_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <?php if(in_array('expenses', $enabled_modules)): ?>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'expense_report.view', in_array('expense_report.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.expense_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'register_report.view', in_array('register_report.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.register_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'summary_income_report.view', in_array('summary_income_report.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.summary_income_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'sales_representative.view',
                                        in_array('sales_representative.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.sales_representative.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'service_staff_report.view',
                                        in_array('service_staff_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'restaurant.service_staff_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <?php if(in_array('tables', $enabled_modules)): ?>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'table_report.view', in_array('table_report.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'restaurant.table_report' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'activity_log_report.view',
                                        in_array('activity_log_report.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.activity_log_report.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                 
                 <div class="pos-tab-content">
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'user.user_management' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'user.view', in_array('user.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.user.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'user.create', in_array('user.create', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.user.create' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'user.create_employee', in_array('user.create_employee', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.user.create_employee' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'user.update', in_array('user.update', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.user.update' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'user.delete', in_array('user.delete', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.user.delete' ), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'user.roles' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'roles.view', in_array('roles.view', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_role' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'roles.create', in_array('roles.create', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.add_role' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'roles.update', in_array('roles.update', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.edit_role' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'roles.delete', in_array('roles.delete', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.delete_role' ), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                <div class="pos-tab-content">
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'role.settings' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'business_settings.access',
                                        in_array('business_settings.access', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.business_settings.access' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'barcode_settings.access',
                                        in_array('barcode_settings.access', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.barcode_settings.access' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'invoice_settings.access',
                                        in_array('invoice_settings.access', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.invoice_settings.access' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'backup',
                                        in_array('backup', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.backup' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'transaction_backup.access',
                                        in_array('transaction_backup.access', $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.transaction_backup.access' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'access_printers', in_array('access_printers',
                                        $role_permissions),['class' => 'form-check-input']); ?>

                                        <?php echo e(__('lang_v1.access_printers'), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row check_group">
                        <div class="col-md-1">
                            <h4><?php echo app('translator')->get( 'role.tax_rate' ); ?></h4>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="check_all form-check-input"> <?php echo e(__( 'role.select_all' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'tax_rate.view', in_array('tax_rate.view',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.tax_rate.view' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'tax_rate.create', in_array('tax_rate.create',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.tax_rate.create' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'tax_rate.update', in_array('tax_rate.update',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.tax_rate.update' ), false); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
<?php echo Form::checkbox('permissions[]', 'tax_rate.delete', in_array('tax_rate.delete',
                                        $role_permissions),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.tax_rate.delete' ), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
                <?php echo $__env->make('role.partials.module_permissions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
    <div id="role-footer-actions-template" class="d-none">
        <button type="submit" class="btn btn-primary" form="role_form"><i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?></button>
    </div>
    <?php echo Form::close(); ?>

    <?php echo $__env->renderComponent(); ?>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>