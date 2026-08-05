<?php $request = app('Illuminate\Http\Request'); ?>
<!--start top header-->
<style>
    .top-header {
        --header-icon-size: 34px;
        --header-icon-font-size: 15px;
    }
    .top-header .navbar {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.5rem;
        /* height: auto !important; */
        min-height: 0 !important;
        padding: 0.45rem 0.75rem;
        align-content: center;
    }
    .top-header .top-navbar-left {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        flex: 0 0 auto;
    }
    .top-header .top-navbar-actions {
        margin-left: auto;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        min-width: 0;
    }
    .top-header .top-navbar-right {
        flex: 0 1 auto;
        min-width: 0;
        margin-left: 0 !important;
    }
    .top-header .top-navbar-right .navbar-nav {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 0.35rem !important;
    }
    .top-header .header-actions-toggle {
        display: none;
    }
    .top-header .header-actions-toggle .icon-close,
    .top-header .toggle-icon .icon-close {
        display: none;
    }
    .top-header .header-actions-toggle.is-open .icon-open,
    .top-header .toggle-icon.is-open .icon-open {
        display: none;
    }
    .top-header .header-actions-toggle.is-open .icon-close,
    .top-header .toggle-icon.is-open .icon-close {
        display: inline-block;
    }
    .top-header .dropdown-user-setting {
        margin-left: 0;
    }
    .top-header .toggle-icon {
        position: relative;
        z-index: 2;
        cursor: pointer;
        width: var(--header-icon-size);
        height: var(--header-icon-size);
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
    }
        /* Responsive adjustments for right-side header icons */
        @media (max-width: 991.98px) {
            .top-header {
                --header-icon-size: 32px;
                --header-icon-font-size: 14px;
            }
            .top-header .navbar {
                padding: 0.4rem 0.55rem;
                gap: 0.4rem;
            }
        }

        /* Sidebar z-index and toggle icon rules for all mobile/tablet sizes */
        @media (max-width: 1024px) {
            .sidebar-wrapper,
            .wrapper.toggled .sidebar-wrapper,
            .wrapper.sidebar-hovered .sidebar-wrapper {
                z-index: 1060 !important;
            }

            .top-header {
                z-index: 1040 !important;
            }

            .wrapper.toggled .top-header,
            .wrapper.sidebar-hovered .top-header {
                pointer-events: auto;
            }

            .wrapper.toggled .top-header .top-navbar-right,
            .wrapper.sidebar-hovered .top-header .top-navbar-right,
            .wrapper.toggled .top-header .dropdown-user-setting,
            .wrapper.sidebar-hovered .top-header .dropdown-user-setting,
            .wrapper.toggled .top-header .back-to-user-btn,
            .wrapper.sidebar-hovered .top-header .back-to-user-btn {
                pointer-events: none;
            }

            .wrapper.toggled .top-header .toggle-icon,
            .wrapper.sidebar-hovered .top-header .toggle-icon {
                position: fixed;
                left: 12px;
                top: 12px;
                z-index: 1070;
                pointer-events: auto;
                width: 38px;
                height: 38px;
                display: inline-flex !important;
                align-items: center;
                justify-content: center;
                border-radius: 8px;
                background: #ffffff;
                border: 1px solid #d9dee7;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
                visibility: visible;
                opacity: 1;
            }
        }

        @media (max-width: 767.98px) {
            .top-header {
                --header-icon-size: 40px;
                --header-icon-font-size: 16px;
            }
            .top-header .navbar {
                gap: 0.35rem;
                padding: 0.35rem 0.45rem;
            }
            .top-header .top-navbar-left {
                order: 1;
                flex: 0 1 auto;
                min-width: 0;
            }
            .top-header .top-navbar-actions {
                order: 2;
                flex: 1 1 0;
                min-width: 0;
                margin-left: 0;
                display: grid;
                grid-template-columns: minmax(0, 1fr) auto auto;
                align-items: center;
                justify-items: end;
                justify-content: flex-end;
                column-gap: 0.35rem;
                gap: 0.35rem;
            }
            .top-header .header-actions-toggle {
                display: inline-flex;
                grid-column: 2;
                grid-row: 1;
                transform: translateY(8px);
            }
            .top-header .top-navbar-right {
                grid-column: 1;
                grid-row: 1;
                width: 100%;
                min-width: 0;
                margin-left: 0 !important;
                overflow: hidden;
            }
            .top-header .top-navbar-right.collapse:not(.show) {
                display: none !important;
            }
            .top-header .top-navbar-right.collapse.show {
                display: block !important;
                flex: 0 0 100%;
                width: 100%;
                height: calc(var(--header-icon-size) + 18px);
                margin-top: 0;
                overflow-x: auto;
                overflow-y: hidden;
                overscroll-behavior-inline: contain;
                scrollbar-width: none;
                -ms-overflow-style: none;
                -webkit-overflow-scrolling: touch;
            }
            .top-header .top-navbar-right.collapse.show::-webkit-scrollbar {
                display: none;
            }
            .top-header .top-navbar-right .navbar-nav {
                display: flex;
                flex-wrap: nowrap;
                align-items: center;
                justify-content: center;
                min-height: 100%;
                gap: 0.35rem !important;
                width: max-content;
                min-width: 100%;
                max-width: none;
                margin: 0;
                padding: 0;
                white-space: nowrap;
            }
            .top-header .top-navbar-right .navbar-nav .nav-item {
                flex: 0 0 auto;
            }
            .back-to-user-btn .back-to-user-text {
                display: none;
            }
            .back-to-user-btn {
                width: 34px;
                height: 34px;
                padding: 0;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }
            .top-header .navbar-nav .nav-item .nav-icon-btn,
            .top-header .navbar-nav .nav-item .nav-icon-btn.nav-icon-outline {
                width: var(--header-icon-size);
                height: var(--header-icon-size);
                font-size: var(--header-icon-font-size);
                min-width: var(--header-icon-size);
                padding: 0;
            }
            .top-header .navbar-nav .nav-item {
                margin-bottom: 0;
            }
            .top-header .dropdown-user-setting {
                grid-column: 3;
                grid-row: 1;
                margin-left: 0;
                justify-self: end;
            }
        }
    .top-header .navbar-nav .nav-item .nav-icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: var(--header-icon-size);
        height: var(--header-icon-size);
        border-radius: 6px;
        font-size: var(--header-icon-font-size);
        padding: 0;
        margin: 0;
        border: none;
        color: #fff;
        background-color: var(--bs-primary, #3461ff);
        transition: background-color 0.2s, box-shadow 0.2s;
        cursor: pointer;
        text-decoration: none;
        line-height: 1;
        box-shadow: 0 1px 3px rgba(var(--bs-primary-rgb, 52, 97, 255), 0.25);
    }
    .top-header .navbar-nav .nav-item .nav-icon-btn:hover {
        background-color: var(--theme-primary-dark, #2850e0);
        box-shadow: 0 2px 6px rgba(var(--bs-primary-rgb, 52, 97, 255), 0.4);
        color: #fff;
        text-decoration: none;
    }
    .top-header .navbar-nav .nav-item .nav-icon-btn i {
        display: block;
        line-height: 1;
        font-size: var(--header-icon-font-size);
    }
    .top-header .navbar-nav .nav-item .nav-icon-btn.nav-icon-outline {
        background-color: transparent;
        color: var(--bs-primary, #3461ff);
        border: 1.5px solid #d0d5dd;
        box-shadow: none;
    }
    .top-header .navbar-nav .nav-item .nav-icon-btn.nav-icon-outline:hover {
        background-color: var(--theme-primary-light, #eef1ff);
        border-color: var(--bs-primary, #3461ff);
        color: var(--theme-primary-dark, #2850e0);
        box-shadow: none;
    }
    .top-header .navbar-nav .nav-item .software-update-btn {
        width: auto;
        min-width: 92px;
        padding: 0 10px;
        gap: 6px;
        background-color: #dc3545 !important;
        color: #fff !important;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0;
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.35);
    }
    .top-header .navbar-nav .nav-item .software-update-btn:hover {
        background-color: #bb2d3b !important;
        color: #fff !important;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.45);
    }
    .top-header .navbar-nav .nav-item .software-update-btn i {
        font-size: 12px;
    }
    .top-header .navbar-nav .nav-item .software-whats-new-btn {
        background: #fff !important;
        color: #dc3545 !important;
        border: 1.5px solid rgba(220, 53, 69, 0.35);
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.14);
    }
    .top-header .navbar-nav .nav-item .software-whats-new-btn:hover {
        background: #dc3545 !important;
        color: #fff !important;
        border-color: #dc3545;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.28);
    }
    .top-header .navbar-nav .nav-item .software-whats-new-btn i {
        font-size: 18px;
        font-weight: 700;
    }
    .top-header .navbar-nav .nav-item .software-sync-btn {
        background: #fff !important;
        color: #198754 !important;
        border: 1.5px solid rgba(25, 135, 84, 0.35);
        box-shadow: 0 2px 8px rgba(25, 135, 84, 0.14);
        position: relative;
    }
    .top-header .navbar-nav .nav-item .software-sync-btn:hover,
    .top-header .navbar-nav .nav-item .software-sync-btn.is-syncing {
        background: #198754 !important;
        color: #fff !important;
        border-color: #198754;
        box-shadow: 0 4px 12px rgba(25, 135, 84, 0.28);
    }
    .top-header .navbar-nav .nav-item .software-sync-btn.is-syncing i {
        animation: software-sync-spin 0.85s linear infinite;
    }
    @keyframes software-sync-spin {
        to { transform: rotate(360deg); }
    }
    html.dark-theme .top-header .navbar-nav .nav-item .software-whats-new-btn {
        background: rgba(220, 53, 69, 0.12) !important;
        color: #ff7b87 !important;
        border-color: rgba(255, 123, 135, 0.35);
    }
    html.dark-theme .top-header .navbar-nav .nav-item .software-whats-new-btn:hover {
        background: #dc3545 !important;
        color: #fff !important;
    }
    html.dark-theme .top-header .navbar-nav .nav-item .software-sync-btn {
        background: rgba(25, 135, 84, 0.12) !important;
        color: #52c68d !important;
        border-color: rgba(82, 198, 141, 0.35);
    }
    html.dark-theme .top-header .navbar-nav .nav-item .software-sync-btn:hover,
    html.dark-theme .top-header .navbar-nav .nav-item .software-sync-btn.is-syncing {
        background: #198754 !important;
        color: #fff !important;
    }
    @media (max-width: 767.98px) {
        .top-navbar-right .navbar-nav .software-update-nav-item {
            grid-column: span 3;
        }
        .top-header .navbar-nav .nav-item .software-update-btn {
            width: 100%;
            min-width: 0;
        }
    }
    /* Dark mode overrides for navbar icons */
    html.dark-theme .top-header .navbar-nav .nav-item .nav-icon-btn.nav-icon-outline {
        border-color: rgba(255, 255, 255, 0.18);
    }
    html.dark-theme .top-header .navbar-nav .nav-item .nav-icon-btn.nav-icon-outline:hover {
        background-color: rgba(var(--bs-primary-rgb, 52, 97, 255), 0.15);
        border-color: var(--bs-primary, #3461ff);
    }

    /* AI Header Button */
    .ai-header-btn {
        background: var(--bs-primary) !important;
        color: #fff !important;
        border: none !important;
        position: relative;
        box-shadow: 0 2px 8px rgba(var(--bs-primary-rgb), 0.35) !important;
    }
    .ai-header-btn:hover {
        filter: brightness(0.9);
        box-shadow: 0 4px 14px rgba(var(--bs-primary-rgb), 0.5) !important;
        color: #fff !important;
    }
    .ai-header-btn i {
        color: #fff !important;
    }
    .ai-header-pulse {
        position: absolute;
        top: -2px;
        right: -2px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #10b981;
        border: 1.5px solid #fff;
        animation: ai-dot-pulse 2s ease-in-out infinite;
    }
    @keyframes ai-dot-pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.3); opacity: 0.7; }
    }
    .ai-quick-dropdown { border: 1px solid #e5e7eb; box-shadow: 0 10px 40px rgba(0,0,0,0.12); }
    .ai-quick-header {
        background: var(--bs-primary);
        color: #fff;
        padding: 12px 16px;
        font-weight: 700;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .ai-quick-badge {
        background: rgba(255,255,255,0.2);
        border-radius: 8px;
        padding: 2px 8px;
        font-size: 0.7rem;
        margin-left: auto;
    }
    .ai-quick-item {
        display: flex !important;
        align-items: center;
        gap: 10px;
        padding: 10px 16px !important;
        font-size: 0.82rem;
        color: #374151;
        transition: all 0.15s;
    }
    .ai-quick-item:hover {
        background: rgba(var(--bs-primary-rgb), 0.1) !important;
        color: var(--bs-primary) !important;
    }
    .ai-quick-item i {
        width: 18px;
        text-align: center;
        color: var(--bs-primary);
        font-size: 0.9rem;
    }
    html.dark-theme .ai-quick-dropdown { background: #1f2937; border-color: #374151; }
    html.dark-theme .ai-quick-item { color: #d1d5db; }
    html.dark-theme .ai-quick-item:hover { background: rgba(var(--bs-primary-rgb), 0.15) !important; color: rgba(var(--bs-primary-rgb), 0.8) !important; }
</style>
<header class="top-header no-print">
    <nav class="navbar navbar-expand gap-3">
        <div class="top-navbar-left">
        
        <div class="toggle-icon fs-3 d-flex">
            <i class="bi bi-list icon-open"></i>
            <i class="fa fa-times icon-close"></i>
        </div>

        <?php if(Module::has('Superadmin')): ?>
        
        <?php endif; ?>

        <?php if(!empty(session('previous_user_id')) && !empty(session('previous_username'))): ?>
        
        <div class="btn-group">
            <a href="<?php echo e(route('sign-in-as-user', session('previous_user_id')), false); ?>" class="btn btn-danger btn-sm back-to-user-btn mx-0">
                <i class="fas fa-undo"></i>
                <span class="back-to-user-text">
                    <?php echo app('translator')->get('lang_v1.back_to_username', ['username' => session('previous_username')]); ?>
                </span>
            </a>
            <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false" style="height: 30px">
                <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
                <?php $__currentLoopData = session('current_business_users', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_id => $username): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a class="dropdown-item <?php if(auth()->user()->id == $user_id): ?> disabled bg-info <?php endif; ?>" 
                           href="<?php echo e(route('sign-in-as-user', $user_id), false); ?>?save_current=true&previous_user_id=<?php echo e(session('previous_user_id'), false); ?>">
                           <?php if(auth()->user()->id == $user_id): ?> <?php echo e($username, false); ?> (logged in) 
                           <?php else: ?>
                           <?php echo app('translator')->get('lang_v1.login_as_username', ['username' => $username]); ?> <?php if(auth()->user()->id == $user_id): ?> (logged in) <?php endif; ?>
                           <?php endif; ?>
                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>
        </div>

        <div class="top-navbar-actions">
        <button class="btn nav-icon-btn nav-icon-outline header-actions-toggle" type="button"
            data-bs-toggle="collapse" data-bs-target="#mainHeaderActionsCollapse"
            aria-controls="mainHeaderActionsCollapse" aria-expanded="false"
            title="<?php echo app('translator')->get('messages.actions'); ?>">
            <i class="fa fa-ellipsis-v icon-open"></i>
            <i class="fa fa-times icon-close"></i>
        </button>
        <div class="top-navbar-right ms-auto collapse d-md-block" id="mainHeaderActionsCollapse">
            <ul class="navbar-nav align-items-center gap-1">
                
                <li class="nav-item software-update-nav-item <?php if(empty($__is_update_available)): ?> d-none <?php endif; ?>" id="software_update_nav_item">
                    <a href="<?php echo e(route('install.updateConfirmation'), false); ?>"
                        title="Update software" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        class="nav-icon-btn software-update-btn">
                        <i class="fas fa-sync-alt"></i>
                        <span>UPDATE</span>
                    </a>
                </li>
                <?php if($is_offline): ?>
                <?php
                    $software_sync_icon = (\Illuminate\Support\Facades\File::isDirectory(base_path('.git')) || \Illuminate\Support\Facades\File::isDirectory(base_path('.github')))
                        ? 'fab fa-github'
                        : 'fas fa-cloud-download-alt';
                ?>
                <li class="nav-item">
                    <button type="button" id="software_git_sync_btn"
                        title="Sync updates" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        data-href="<?php echo e(route('software.sync'), false); ?>"
                        data-icon-class="<?php echo e($software_sync_icon, false); ?>"
                        class="nav-icon-btn software-sync-btn">
                        <i class="<?php echo e($software_sync_icon, false); ?>"></i>
                    </button>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('whats.new'), false); ?>"
                        title="What's new" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        class="nav-icon-btn software-whats-new-btn">
                        <i class="fas fa-question"></i>
                    </a>
                </li>

                <?php if(in_array('pos_sale', $enabled_modules)): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sell.create')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'create']), false); ?>"
                        title="<?php echo app('translator')->get('sale.pos_screen'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        class="nav-icon-btn">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </li>
                <?php endif; ?>
                <?php endif; ?>

                <?php if(Module::has('Repair')): ?>
                <?php if ($__env->exists('repair::layouts.partials.header')) echo $__env->make('repair::layouts.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>

                <?php if(Module::has('Manufacturing')): ?>
                <?php if ($__env->exists('manufacturing::layouts.partials.header')) echo $__env->make('manufacturing::layouts.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>

                <?php if(in_array('add_sale', $enabled_modules)): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('direct_sell.access')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(action([\App\Http\Controllers\SellController::class, 'create']), false); ?>"
                            title="<?php echo app('translator')->get('sale.add_sale'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            class="nav-icon-btn">
                            <i class="fas fa-file-alt"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php endif; ?>

                <?php if(in_array('add_sale', $enabled_modules) || in_array('pos_sale', $enabled_modules)): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sell.payments')): ?>
                <li class="nav-item">
                    <a href="#" class="nav-icon-btn nav_open_contact_payment_modal" data-contact_type="customer"
                        title="<?php echo app('translator')->get('lang_v1.pay_customer'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <i class="fas fa-money-bill-alt"></i>
                    </a>
                </li>
                <?php endif; ?>
                <?php endif; ?>


                <?php if(!$is_offline): ?>
                    <?php if(in_array('products', $enabled_modules)): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.create')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'create']), false); ?>"
                            title="<?php echo app('translator')->get('product.add_product'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            class="nav-icon-btn">
                            <i class="fas fa-cube"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(in_array('purchases', $enabled_modules)): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase.create')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(action([\App\Http\Controllers\PurchaseController::class, 'create']), false); ?>"
                                title="<?php echo app('translator')->get('purchase.add_purchase'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                class="nav-icon-btn">
                                <i class="fas fa-cubes"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase.payments')): ?>
                        <li class="nav-item">
                            <a href="#" class="nav-icon-btn nav_open_contact_payment_modal" data-contact_type="supplier"
                                title="<?php echo app('translator')->get('lang_v1.pay_supplier'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                <i class="fas fa-money-bill-alt"></i>
                            </a>
                        </li>
                        <?php endif; ?> 
                    <?php endif; ?>

                    <?php if(in_array('expenses', $enabled_modules)): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense.add')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(action([\App\Http\Controllers\ExpenseController::class, 'create']), false); ?>"
                            title="<?php echo app('translator')->get('expense.add_expense'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            class="nav-icon-btn">
                            <i class="fas fa-minus-circle"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(Module::has('Essentials')): ?>
                <?php if ($__env->exists('essentials::layouts.partials.header_part')) echo $__env->make('essentials::layouts.partials.header_part', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>

                
                <li class="nav-item">
                    <button id="nav_open_products_search_modal" title="<?php echo app('translator')->get('lang_v1.product_search_modal'); ?>" type="button"
                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                            class="nav-icon-btn nav-icon-outline">
                        <i class="fas fa-search"></i>
                    </button>
                </li>

                
                <li class="nav-item d-none d-sm-flex" style="position: relative;">
                    <button id="btnCalculator" title="<?php echo app('translator')->get('lang_v1.calculator'); ?>" type="button"
                        class="nav-icon-btn nav-icon-outline">
                        <i class="fas fa-calculator"></i>
                    </button>
                    <div class="calculator-dropdown" id="calculatorDropdown" style="display:none;">
                        <?php echo $__env->make('layouts.partials.calculator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </li>

                <?php if(!$is_offline): ?>
                    <?php if($request->segment(1) == 'pos'): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_cash_register_details')): ?>
                    <li class="nav-item">
                        <?php if(auth()->user()->can('restrict_view_cash_register_details') && !auth()->user()->hasRole('Admin#' . auth()->user()->business_id)): ?>
                        <button type="button" id="restrict_register_details" title="<?php echo e(__('cash_register.register_details'), false); ?>"
                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                            class="nav-icon-btn nav-icon-outline">
                            <i class="fas fa-briefcase"></i>
                        </button>
                        <?php else: ?>
                        <button type="button" id="register_details" title="<?php echo e(__('cash_register.register_details'), false); ?>"
                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                            class="nav-icon-btn nav-icon-outline btn-modal"
                            data-container=".register_details_modal"
                            data-href="<?php echo e(action([\App\Http\Controllers\CashRegisterController::class, 'getRegisterDetails']), false); ?>">
                            <i class="fas fa-briefcase"></i>
                        </button>
                        <?php endif; ?>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_cash_register_closing')): ?>
                    <li class="nav-item">
                        <?php if(auth()->user()->can('restrict_view_cash_register_closing') && !auth()->user()->hasRole('Admin#' . auth()->user()->business_id)): ?>
                        <button type="button" id="restrict_close_register" title="<?php echo e(__('cash_register.close_register'), false); ?>"
                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                            class="nav-icon-btn nav-icon-outline">
                            <i class="fas fa-window-close"></i>
                        </button>
                        <?php else: ?>
                        <button type="button" id="close_register" title="<?php echo e(__('cash_register.close_register'), false); ?>"
                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                            class="nav-icon-btn nav-icon-outline btn-modal" data-container=".close_register_modal"
                            data-href="<?php echo e(action([\App\Http\Controllers\CashRegisterController::class, 'getCloseRegister']), false); ?>">
                            <i class="fas fa-window-close"></i>
                        </button>
                        <?php endif; ?>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('profit_loss_report.view')): ?>
                <li class="nav-item">
                    <button type="button" id="view_todays_profit" title="<?php echo e(__('home.todays_profit'), false); ?>"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" class="nav-icon-btn nav-icon-outline">
                        <i class="fas fa-money-bill-alt"></i>
                    </button>
                </li>
                <?php endif; ?>

                
                <?php if(Module::has('AiAssistance') && (auth()->user()->can('superadmin') || auth()->user()->can('aiassistance.access_aiassistance_module'))): ?>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-icon-btn ai-header-btn dropdown-toggle" 
                       data-bs-toggle="dropdown" data-bs-auto-close="outside"
                       title="AI Assistant" id="aiQuickAccessBtn">
                        <i class="fas fa-brain"></i>
                        <span class="ai-header-pulse"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end ai-quick-dropdown" style="width:300px;padding:0;border-radius:12px;overflow:hidden;">
                        <li class="ai-quick-header">
                            <i class="fas fa-brain"></i> AI Business Intelligence
                            <span class="ai-quick-badge">30 Tools</span>
                        </li>
                        <li><a class="dropdown-item ai-quick-item" href="<?php echo e(url('/aiassistance/bi'), false); ?>">
                            <i class="fas fa-chart-pie"></i> AI Dashboard
                        </a></li>
                        <li><a class="dropdown-item ai-quick-item" href="<?php echo e(url('/aiassistance/bi/nl-reports/form'), false); ?>">
                            <i class="fas fa-comments"></i> Ask AI a Question
                        </a></li>
                        <li><a class="dropdown-item ai-quick-item" href="<?php echo e(url('/aiassistance/bi/document-extraction/form'), false); ?>">
                            <i class="fas fa-file-invoice"></i> Extract Documents
                        </a></li>
                        <li><a class="dropdown-item ai-quick-item" href="<?php echo e(url('/aiassistance/showcase'), false); ?>">
                            <i class="fas fa-star"></i> AI Feature Showcase
                        </a></li>
                        <li><hr class="dropdown-divider" style="margin:4px 0;"></li>
                        <li><a class="dropdown-item ai-quick-item" href="<?php echo e(url('/aiassistance/messenger'), false); ?>">
                            <i class="fas fa-robot"></i> AI Messenger
                        </a></li>
                        <li><a class="dropdown-item ai-quick-item" href="<?php echo e(url('/aiassistance/dashboard'), false); ?>">
                            <i class="fas fa-magic"></i> AI Content Tools
                        </a></li>
                    </ul>
                </li>
                <?php endif; ?>

                
                <li class="nav-item dropdown notifications-menu">
                    <a href="#" class="nav-icon-btn nav-icon-outline load_notifications dropdown-toggle" 
                       data-bs-toggle="dropdown" id="show_unread_notifications" data-loaded="false"
                       title="<?php echo app('translator')->get('lang_v1.notifications'); ?>" data-bs-auto-close="outside">
                        <i class="fas fa-bell"></i>
                        <?php
                            $unread_notif_count = auth()->user()->unreadNotifications()->count();
                        ?>
                        <?php if($unread_notif_count > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notifications_count" style="font-size:.6rem;min-width:16px;padding:2px 5px;">
                            <?php echo e($unread_notif_count, false); ?>

                        </span>
                        <?php else: ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notifications_count" style="font-size:.6rem;min-width:16px;padding:2px 5px;display:none;"></span>
                        <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="padding:0;">
                        <li class="dropdown-header d-flex justify-content-between align-items-center" style="padding:10px 14px;border-bottom:1px solid #e5e7eb;">
                            <strong style="font-size:.85rem;"><?php echo app('translator')->get('lang_v1.notifications'); ?></strong>
                            <a href="#" class="text-muted" style="font-size:.75rem;" onclick="markAllRead(event)">Mark all read</a>
                        </li>
                        <li style="display:block;max-height:360px;overflow-y:auto;overflow-x:hidden;">
                            <ul class="list-unstyled mb-0" id="notifications_list"></ul>
                        </li>
                        <li class="footer load_more_li">
                            <a href="#" class="load_more_notifications text-primary" style="font-size:.78rem;"><?php echo app('translator')->get('lang_v1.load_more'); ?></a>
                        </li>
                    </ul>
                    <input type="hidden" id="notification_page" value="1">
                </li>

                
                <li class="nav-item dark-mode d-none d-sm-flex">
                    <a class="nav-icon-btn nav-icon-outline dark-mode-icon" href="javascript:;">
                        <i class="bi bi-moon-fill"></i>
                    </a>
                </li>

            </ul>
        </div>

        
        <div class="dropdown dropdown-user-setting">
            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                <div class="user-setting d-flex align-items-center gap-2">
                    <?php
                        $profile_photo = auth()->user()->media;
                    ?>
                    <?php if(!empty($profile_photo)): ?>
                        <img src="<?php echo e($profile_photo->display_url, false); ?>" class="user-img" alt="User Image" style="width:36px;height:36px;border-radius:50%;">
                    <?php else: ?>
                        <div class="user-img d-flex align-items-center justify-content-center bg-primary text-white" style="width:36px;height:36px;border-radius:50%;font-size:14px;">
                            <?php echo e(strtoupper(substr(Auth::User()->first_name, 0, 1)), false); ?><?php echo e(strtoupper(substr(Auth::User()->last_name, 0, 1)), false); ?>

                        </div>
                    <?php endif; ?>
                    <div class="d-none d-sm-block">
                        <p class="user-name mb-0"><?php echo e(Auth::User()->first_name, false); ?> <?php echo e(Auth::User()->last_name, false); ?></p>
                    </div>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <?php if(!empty(Session::get('business.logo'))): ?>
                        <?php
                            $blogo_path = asset('uploads/business_logos/'.Session::get('business.logo'));
                            if(!file_exists($path)){
                                $blogo_path = asset('uploads/'.Session::get('business.id').'/business_logos/'.Session::get('business.logo'));
                            }
                        ?>
                        <div class="text-center p-2">
                            <img src="<?php echo e($blogo_path, false); ?>" alt="Logo" style="max-width: 120px;">
                        </div>
                        <li><hr class="dropdown-divider"></li>
                    <?php endif; ?>
                </li>
                <li>
                    <a class="dropdown-item" href="<?php echo e(action([\App\Http\Controllers\UserController::class, 'getProfile']), false); ?>">
                        <div class="d-flex align-items-center">
                            <div class=""><i class="bi bi-person-fill"></i></div>
                            <div class="ms-3"><span><?php echo app('translator')->get('lang_v1.profile'); ?></span></div>
                        </div>
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="<?php echo e(action([\App\Http\Controllers\Auth\LoginController::class, 'logout']), false); ?>">
                        <div class="d-flex align-items-center">
                            <div class=""><i class="bi bi-lock-fill"></i></div>
                            <div class="ms-3"><span><?php echo app('translator')->get('lang_v1.sign_out'); ?></span></div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        </div>

    </nav>
</header>
<!--end top header-->
<?php if($is_offline): ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var syncButton = document.getElementById('software_git_sync_btn');

    if (!syncButton) {
        return;
    }

    syncButton.addEventListener('click', function () {
        if (syncButton.disabled) {
            return;
        }

        var icon = syncButton.querySelector('i');
        var originalIconClass = syncButton.getAttribute('data-icon-class') || (icon ? icon.className : '');
        syncButton.disabled = true;
        syncButton.classList.add('is-syncing');

        if (icon) {
            icon.className = 'fas fa-sync-alt';
        }

        fetch(syncButton.getAttribute('data-href'), {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(function (response) {
            return response.json().then(function (json) {
                if (!response.ok) {
                    throw json;
                }

                return json;
            });
        }).then(function (result) {
            if (result.success) {
                toastr.success(result.msg || 'Software sync completed successfully.');

                if (result.update_available) {
                    var updateItem = document.getElementById('software_update_nav_item');

                    if (updateItem) {
                        updateItem.classList.remove('d-none');
                    }
                }
            } else {
                toastr.error(result.msg || 'Software sync failed.');
            }
        }).catch(function (error) {
            toastr.error((error && error.msg) ? error.msg : 'Software sync failed.');
        }).finally(function () {
            syncButton.disabled = false;
            syncButton.classList.remove('is-syncing');

            if (icon) {
                icon.className = originalIconClass || 'fas fa-cloud-download-alt';
            }
        });
    });
});
</script>
<?php endif; ?>
