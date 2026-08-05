<?php $request = app('Illuminate\Http\Request'); ?>
<!--start top header-->
<style>
    .top-header .navbar-nav .nav-item .nav-icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 6px;
        font-size: 15px;
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
        font-size: 15px;
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
    /* Dark mode overrides for navbar icons */
    html.dark-theme .top-header .navbar-nav .nav-item .nav-icon-btn.nav-icon-outline {
        border-color: rgba(255, 255, 255, 0.18);
    }
    html.dark-theme .top-header .navbar-nav .nav-item .nav-icon-btn.nav-icon-outline:hover {
        background-color: rgba(var(--bs-primary-rgb, 52, 97, 255), 0.15);
        border-color: var(--bs-primary, #3461ff);
    }
</style>
<header class="top-header no-print">
    <nav class="navbar navbar-expand gap-3">
        
        <div class="toggle-icon fs-3 d-flex"><i class="bi bi-list"></i></div>

        <?php if(Module::has('Superadmin')): ?>
        
        <?php endif; ?>

        <?php if(!empty(session('previous_user_id')) && !empty(session('previous_username'))): ?>
        <a href="<?php echo e(route('sign-in-as-user', session('previous_user_id')), false); ?>"
            class="btn btn-danger btn-sm"><i class="fas fa-undo"></i>
            <?php echo app('translator')->get('lang_v1.back_to_username', ['username' => session('previous_username')]); ?></a>
        <?php endif; ?>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                
                    <!-- original button comment by asif  -->
                    <!-- <button id="header_shortcut_dropdown" type="button" class="btn btn-success dropdown-toggle btn-flat pull-left m-8 btn-sm mt-10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-plus-circle fa-lg"></i>
                    </button> -->
                    <?php if(in_array('pos_sale', $enabled_modules)): ?>
                        <?php if(auth()->user()->can('sell.create')): ?>
                        <a href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'create']), false); ?>"
                            title="<?php echo app('translator')->get('sale.pos_sale'); ?>" data-toggle="tooltip" data-placement="bottom"
                            class="btn bg-transparent pull-left mr-5 btn-md mt-10 btn-primary">
                            <strong><i class="fa fa-shopping-cart fa-lg"></i></strong>
                        </a>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if(Module::has('Repair')): ?>
                    <?php if ($__env->exists('repair::layouts.partials.header')) echo $__env->make('repair::layouts.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                    <?php if(Module::has('Manufacturing')): ?>
                    <?php if ($__env->exists('manufacturing::layouts.partials.header')) echo $__env->make('manufacturing::layouts.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                    <?php if(in_array('add_sale', $enabled_modules)): ?>
                        <?php if(auth()->user()->can('direct_sell.access')): ?>
                        <a href="<?php echo e(action([\App\Http\Controllers\SellController::class, 'create']), false); ?>"
                            title="<?php echo app('translator')->get('sale.add_sale'); ?>" data-toggle="tooltip" data-placement="bottom"
                            class="btn bg-transparent pull-left mr-5 btn-md mt-10 btn-primary">
                            <strong><i class="fas fa-file-alt fa-lg"></i></strong>
                        </a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(in_array('add_sale', $enabled_modules) || in_array('pos_sale', $enabled_modules)): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sell.payments')): ?>
                    <button id="nav_open_contact_payment_modal" title="<?php echo app('translator')->get('lang_v1.pay_customer'); ?>" data-contact_type="customer" type="button"
                            data-toggle="tooltip" data-placement="bottom"
                            class="btn bg-transparent pull-left mr-5 btn-md mt-10 btn-primary">
                        <strong><i class="fa fa-money-bill-alt fa-lg" aria-hidden="true"></i></strong>
                    </button>
                    <?php endif; ?>
                    <?php endif; ?>

                    <?php if(!$is_offline): ?>
                        <?php if(in_array('products', $enabled_modules)): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.create')): ?>
                        <a href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'create']), false); ?>"
                            title="<?php echo app('translator')->get('product.add_product'); ?>" data-toggle="tooltip" data-placement="bottom"
                            class="btn bg-transparent pull-left mr-5 btn-md mt-10 btn-primary">
                            <strong><i class="fas fa-cube fa-lg"></i></strong>
                        </a>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(in_array('purchases', $enabled_modules)): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase.create')): ?>
                        <a href="<?php echo e(action([\App\Http\Controllers\PurchaseController::class, 'create']), false); ?>"
                            title="<?php echo app('translator')->get('purchase.add_purchase'); ?>" data-toggle="tooltip" data-placement="bottom"
                            class="btn bg-transparent pull-left mr-5 btn-md mt-10 btn-primary">
                            <strong><i class="fas fa-cubes fa-lg"></i></strong>
                        </a>
                        <?php endif; ?>
                        <?php endif; ?>

                        <?php if(in_array('purchases', $enabled_modules)): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase.payments')): ?>
                        <button id="nav_open_contact_payment_modal" title="<?php echo app('translator')->get('lang_v1.pay_supplier'); ?>" data-contact_type="supplier" type="button"
                                data-toggle="tooltip" data-placement="bottom"
                                class="btn bg-transparent pull-left mr-5 btn-md mt-10 btn-primary">
                            <strong><i class="fa fa-money-bill-alt fa-lg" aria-hidden="true"></i></strong>
                        </button>
                        <?php endif; ?>
                        <?php endif; ?>


                        <?php if(in_array('expenses', $enabled_modules)): ?>
                            <?php if(auth()->user()->can('expense.add')): ?>
                            <a href="<?php echo e(action([\App\Http\Controllers\ExpenseController::class, 'create']), false); ?>"
                                title="<?php echo app('translator')->get('expense.add_expense'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                class="nav-icon-btn">
                                <i class="fas fa-minus-circle"></i>
                            </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(Module::has('Essentials')): ?>
                    <?php if ($__env->exists('essentials::layouts.partials.header_part')) echo $__env->make('essentials::layouts.partials.header_part', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    <!-- </div>
                    <div class="btn-group"> -->
    
                    <?php if(in_array('products', $enabled_modules)): ?>
                        
                    <button id="nav_open_products_search_modal" title="<?php echo app('translator')->get('lang_v1.product_search_modal'); ?>" type="button"
                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                            class="nav-icon-btn nav-icon-outline">
                        <i class="fas fa-search"></i>
                    </button>
                    <?php endif; ?>

                
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

    </nav>
</header>
<!--end top header-->
