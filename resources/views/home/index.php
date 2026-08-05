
<?php $__env->startSection('title', __('home.home')); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard-enhanced.css?v=' . $asset_v . '.' . filemtime(public_path('css/dashboard-enhanced.css'))), false); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content content-custom no-print">

    <?php
        $disabled_dashboard_items = $common_settings['disable_dashboard_items'] ?? [];
        $isDashboardItemDisabled = function ($item) use ($disabled_dashboard_items) {
            return !empty($disabled_dashboard_items[$item]);
        };
    ?>

    <?php if(auth()->user()->can('dashboard.data')): ?>

            <!-- Modern Dashboard Header -->
            <div class="dashboard-header">
                <div class="row align-items-center">
                    <div class="col-md-6 col-12">
                        <?php
                            $hour = (int) date('H');
                            $greeting = $hour < 12 ? __('Good Morning') : ($hour < 17 ? __('Good Afternoon') : __('Good Evening'));
                        ?>
                        <h2 class="greeting-text"><?php echo e($greeting, false); ?>, <?php echo e(Session::get('user.first_name'), false); ?>!</h2>
                        <p class="greeting-subtitle">
                            <span class="dashboard-datetime">
                                <i class="fas fa-calendar-alt"></i>
                                <?php echo e(\Carbon::now()->format('l, F j, Y'), false); ?>

                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="header-right">
                            <div>
                                <?php if(count($all_locations) > 1): ?>
                                    <?php echo Form::select('dashboard_location', $all_locations, null, [
                                        'class' => 'form-control select2',
                                        'placeholder' => __('lang_v1.select_location'),
                                        'id' => 'dashboard_location',
                                        'style' => 'min-width: 180px; max-width: 100%;',
                                    ]); ?>

                                <?php else: ?>
                                    <?php echo Form::hidden('dashboard_location', array_key_first($all_locations), ['id' => 'dashboard_location']); ?>

                                <?php endif; ?>
                            </div>
                            <div>
                                <button type="button" class="btn btn-light" id="dashboard_date_filter">
                                    <span>
                                        <i class="fa fa-calendar"></i> <?php echo e(__('messages.filter_by_date'), false); ?>

                                    </span>
                                    <i class="fa fa-caret-down"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($module_dashboard_links)): ?>
                <div class="module-dashboard-bar">
                    <?php $__currentLoopData = $module_dashboard_links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module_dashboard_link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($module_dashboard_link['url'], false); ?>" class="module-dashboard-btn"
                            title="<?php echo app('translator')->get('lang_v1.dashboard'); ?>: <?php echo e($module_dashboard_link['label'], false); ?>">
                            <i class="<?php echo e($module_dashboard_link['icon'], false); ?>"></i>
                            <span><?php echo e($module_dashboard_link['label'], false); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
            <?php if(!$isDashboardItemDisabled('quick_actions') || !$isDashboardItemDisabled('currency_rate')): ?>
            <div class="quick-actions-bar" style="display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:8px; overflow:hidden;">
                <?php if(!$isDashboardItemDisabled('quick_actions')): ?>
                <div class="quick-actions-left" style="display:flex; flex-wrap:wrap; align-items:center; gap:6px;">
                <?php if(in_array('pos_sale', $enabled_modules) && auth()->user()->can('sell.create')): ?>
                    <a href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'create']), false); ?>" class="quick-action-btn qa-pos">
                        <i class="fas fa-cash-register"></i> <?php echo app('translator')->get('sale.pos_sale'); ?>
                    </a>
                <?php endif; ?>
                <?php if(in_array('add_sale', $enabled_modules) && auth()->user()->can('direct_sell.access')): ?>
                    <a href="<?php echo e(action([\App\Http\Controllers\SellController::class, 'create']), false); ?>" class="quick-action-btn qa-sale">
                        <i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('sale.add_sale'); ?>
                    </a>
                <?php endif; ?>
                <?php if(in_array('purchases', $enabled_modules) && auth()->user()->can('purchase.create')): ?>
                    <a href="<?php echo e(action([\App\Http\Controllers\PurchaseController::class, 'create']), false); ?>" class="quick-action-btn qa-purchase">
                        <i class="fas fa-cart-plus"></i> <?php echo app('translator')->get('purchase.add_purchase'); ?>
                    </a>
                <?php endif; ?>
                <?php if(in_array('products', $enabled_modules) && auth()->user()->can('product.create')): ?>
                    <a href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'create']), false); ?>" class="quick-action-btn qa-product">
                        <i class="fas fa-box"></i> <?php echo app('translator')->get('product.add_new_product'); ?>
                    </a>
                <?php endif; ?>
                <?php if((in_array('pos_sale', $enabled_modules) || in_array('add_sale', $enabled_modules) || in_array('purchases', $enabled_modules)) && (auth()->user()->can('supplier.create') || auth()->user()->can('customer.create'))): ?>
                    <a href="javascript:void(0)" class="quick-action-btn qa-contact btn-modal"
                        data-href="<?php echo e(action([\App\Http\Controllers\ContactController::class, 'create'], ['type' => 'customer']), false); ?>"
                        data-container=".contact_modal">
                        <i class="fas fa-user-plus"></i> <?php echo app('translator')->get('contact.add_contact'); ?>
                    </a>
                <?php endif; ?>
                <?php if(in_array('expenses', $enabled_modules) && auth()->user()->can('expense.access')): ?>
                    <a href="<?php echo e(action([\App\Http\Controllers\ExpenseController::class, 'create']), false); ?>" class="quick-action-btn qa-expense">
                        <i class="fas fa-receipt"></i> <?php echo app('translator')->get('expense.add_expense'); ?>
                    </a>
                <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <?php if(!$isDashboardItemDisabled('currency_rate') && !empty($dashboard_currencies) && $dashboard_currencies->count() > 0): ?>
                <div class="quick-actions-right" style="display:flex; align-items:center; gap:4px; border-radius:8px; padding:6px 12px; box-shadow:0 2px 8px rgba(0,0,0,0.08); flex-wrap:wrap;">
                    <button type="button" class="btn btn-sm btn-outline-primary" id="dashboard_refresh_rate" title="<?php echo app('translator')->get('lang_v1.fetch_latest_rate'); ?>" style="border-radius:6px; padding:4px 8px;">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                    <span class="fw-bold" style="font-size:13px; white-space:nowrap; margin:0 4px; flex-shrink:0;">
                        1 <?php echo e(session('currency')['code'] ?? '', false); ?> =
                    </span>
                    <input type="text" id="dashboard_currency_rate" class="form-control form-control-sm text-center fw-bold" style="max-width:100px; min-width:60px; border-radius:6px; flex:0 1 auto;" readonly
                        value="<?php echo e($dashboard_currencies->first()->multiplier ?? '', false); ?>">
                    <?php if($dashboard_currencies->count() > 1): ?>
                    <select id="dashboard_currency_select" class="form-select form-select-sm fw-bold" style="max-width:120px; min-width:80px; border-radius:6px; flex:0 1 auto;">
                        <?php $__currentLoopData = $dashboard_currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($dc->code, false); ?>" data-multiplier="<?php echo e($dc->multiplier, false); ?>" data-symbol="<?php echo e($dc->symbol, false); ?>">
                                <?php echo e($dc->code, false); ?> (<?php echo e($dc->symbol, false); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php else: ?>
                    <span class="badge bg-info" style="font-size:12px; margin-left:4px;">
                        <?php echo e($dashboard_currencies->first()->code ?? '', false); ?> (<?php echo e($dashboard_currencies->first()->symbol ?? '', false); ?>)
                    </span>
                    <input type="hidden" id="dashboard_currency_select_single" value="<?php echo e($dashboard_currencies->first()->code ?? '', false); ?>">
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Today at a Glance -->
            <?php if(!$isDashboardItemDisabled('today_glance')): ?>
            <div class="row today-glance-row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-2">
                    <div class="today-glance-card">
                        <div class="glance-icon gi-transactions"><i class="fas fa-receipt"></i></div>
                        <div class="glance-info">
                            <h4 class="today_sell_count dash-loading">--</h4>
                            <p><?php echo app('translator')->get('home.today'); ?> <?php echo app('translator')->get('lang_v1.transactions'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-2">
                    <div class="today-glance-card">
                        <div class="glance-icon gi-revenue"><i class="fas fa-coins"></i></div>
                        <div class="glance-info">
                            <h4 class="today_revenue dash-loading">--</h4>
                            <p><?php echo app('translator')->get('home.today'); ?> <?php echo app('translator')->get('lang_v1.revenue'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-2">
                    <div class="today-glance-card">
                        <div class="glance-icon gi-orders"><i class="fas fa-shopping-bag"></i></div>
                        <div class="glance-info">
                            <h4 class="today_purchase_count dash-loading">--</h4>
                            <p><?php echo app('translator')->get('home.today'); ?> <?php echo app('translator')->get('lang_v1.purchases'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-2">
                    <div class="today-glance-card">
                        <div class="glance-icon gi-due"><i class="fas fa-exclamation-circle"></i></div>
                        <div class="glance-info">
                            <h4 class="today_total_due dash-loading">--</h4>
                            <p><?php echo app('translator')->get('lang_v1.total'); ?> <?php echo app('translator')->get('home.due_amount'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- ====== ADVANCED ANALYTICS SECTION ====== -->
            <?php if(!$isDashboardItemDisabled('advanced_analytics')): ?>
            <div class="dashboard-section" id="section-advanced-analytics">
                <div class="dashboard-section-header" data-section="advanced-analytics" onclick="toggleDashboardSection('advanced-analytics')">
                    <h5><i class="fas fa-chart-bar"></i> Business Analytics & Insights</h5>
                    <span class="section-toggle"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="dashboard-section-body" id="body-advanced-analytics">

                    <!-- Business Health Score + Quick Stats -->
                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="analytics-card health-score-card">
                                <div class="health-score-header">
                                    <h6><i class="fas fa-heartbeat"></i> Business Health</h6>
                                </div>
                                <div class="health-score-body">
                                    <div class="health-gauge-wrapper">
                                        <canvas id="healthGaugeChart" width="160" height="100"></canvas>
                                        <div class="health-score-value" id="healthScoreValue">--</div>
                                    </div>
                                    <div class="health-score-label" id="healthScoreLabel">Loading...</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-12 mb-3">
                            <div class="analytics-card">
                                <div class="analytics-card-header">
                                    <h6><i class="fas fa-money-bill-wave"></i> Sales by Payment Method</h6>
                                </div>
                                <div class="analytics-card-body chart-scroll-wrapper" style="height: 220px;">
                                    <canvas id="paymentMethodChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12 mb-3">
                            <div class="analytics-card">
                                <div class="analytics-card-header">
                                    <h6><i class="fas fa-clock"></i> Today's Hourly Sales</h6>
                                </div>
                                <div class="analytics-card-body chart-scroll-wrapper" style="height: 220px;">
                                    <canvas id="hourlySalesChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue vs Expense + Top Products -->
                    <div class="row mb-3">
                        <div class="col-lg-7 col-md-12 col-12 mb-3">
                            <div class="analytics-card">
                                <div class="analytics-card-header">
                                    <h6><i class="fas fa-chart-area"></i> Revenue vs Expense (Last 6 Months)</h6>
                                </div>
                                <div class="analytics-card-body chart-scroll-wrapper" style="height: 300px;">
                                    <canvas id="revenueExpenseChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12 col-12 mb-3">
                            <div class="analytics-card">
                                <div class="analytics-card-header">
                                    <h6><i class="fas fa-trophy"></i> Top 10 Selling Products</h6>
                                </div>
                                <div class="analytics-card-body chart-scroll-wrapper" style="height: 300px; overflow-y: auto;">
                                    <canvas id="topProductsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Day of Week Sales + Recent Transactions -->
                    <div class="row mb-3">
                        <div class="col-lg-5 col-md-6 col-12 mb-3">
                            <div class="analytics-card">
                                <div class="analytics-card-header">
                                    <h6><i class="fas fa-calendar-week"></i> Sales by Day of Week</h6>
                                </div>
                                <div class="analytics-card-body chart-scroll-wrapper" style="height: 280px;">
                                    <canvas id="dayOfWeekChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-12 mb-3">
                            <div class="analytics-card">
                                <div class="analytics-card-header">
                                    <h6><i class="fas fa-history"></i> Recent Transactions</h6>
                                </div>
                                <div class="analytics-card-body recent-tx-body" style="height: 280px; overflow-y: auto;">
                                    <div id="recentTransactionsList" class="recent-tx-list">
                                        <div class="text-center text-muted py-4">
                                            <i class="fas fa-spinner fa-spin"></i> Loading...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Operations Analysis: Demand Orders / Productions / Stock / Sales -->
                    <div class="row mb-3" id="operations-analysis-row">
                        <div class="col-lg-8 col-md-12 col-12 mb-3">
                            <div class="analytics-card">
                                <div class="analytics-card-header d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0"><i class="fas fa-industry"></i> Operations Overview (Last 6 Months)</h6>
                                    <small class="text-muted ops-loading-label"><i class="fas fa-spinner fa-spin"></i></small>
                                </div>
                                <div class="analytics-card-body chart-scroll-wrapper" style="height: 320px;">
                                    <canvas id="operationsOverviewChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12 mb-3">
                            <div class="analytics-card h-100">
                                <div class="analytics-card-header">
                                    <h6 class="mb-0"><i class="fas fa-boxes"></i> Stock Value by Location</h6>
                                </div>
                                <div class="analytics-card-body chart-scroll-wrapper" style="height: 280px;">
                                    <canvas id="stockByLocationChart"></canvas>
                                </div>
                                <div class="px-3 pb-2 pt-1 text-end">
                                    <small class="text-muted">Total: <strong id="totalStockValueLabel" class="text-primary">--</strong></small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stock Transfer Analysis -->
                    <div class="row mb-3" id="stock-transfer-analysis-row">
                        <div class="col-12">
                            <div class="analytics-card">
                                <div class="analytics-card-header d-flex align-items-center justify-content-between" style="gap:8px; flex-wrap:wrap;">
                                    <h6 class="mb-0"><i class="fas fa-exchange-alt"></i> Stock Transfer Between Locations</h6>
                                    <div class="text-end" style="display:flex; flex-wrap:wrap; gap:8px; justify-content:flex-end;">
                                        <small class="text-muted">Transfers: <strong id="stockTransferCountLabel" class="text-primary">--</strong></small>
                                        <small class="text-muted">Items: <strong id="stockTransferItemsLabel" class="text-primary">--</strong></small>
                                        <small class="text-muted">Value: <strong id="stockTransferValueLabel" class="text-primary">--</strong></small>
                                    </div>
                                </div>
                                <div class="analytics-card-body chart-scroll-wrapper" style="height: 320px;">
                                    <canvas id="stockTransferRoutesChart"></canvas>
                                    <div id="stockTransferRoutesEmpty" class="text-center text-muted py-4 hide">
                                        <i class="fas fa-exchange-alt"></i><br>
                                        <small>No stock transfer data</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Current Month Daily Analysis -->
                    <div class="row mb-3" id="daily-analysis-row">
                        <div class="col-12">
                            <div class="analytics-card">
                                <div class="analytics-card-header d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0"><i class="fas fa-calendar-day"></i> Daily Analysis — <span id="dailyMonthLabel">Current Month</span></h6>
                                    <small class="text-muted daily-loading-label"><i class="fas fa-spinner fa-spin"></i></small>
                                </div>
                                <div class="analytics-card-body chart-scroll-wrapper" style="height: 300px;">
                                    <canvas id="dailyBreakdownChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
            </div><!-- /dashboard-section advanced-analytics -->
            <?php endif; ?>

            <?php if(!$isDashboardItemDisabled('module_widgets') && !empty($widgets['after_sale_purchase_totals'])): ?>
                <?php $__currentLoopData = $widgets['after_sale_purchase_totals']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $widget; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <!-- Sales KPI Section -->
            <?php if(!$isDashboardItemDisabled('sales_kpi')): ?>
            <div class="dashboard-section" id="section-sales-kpi">
                <div class="dashboard-section-header" data-section="sales-kpi" onclick="toggleDashboardSection('sales-kpi')">
                    <h5><i class="fas fa-chart-line"></i> <?php echo app('translator')->get('home.total_sell'); ?> <?php echo app('translator')->get('lang_v1.overview'); ?></h5>
                    <span class="section-toggle"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="dashboard-section-body" id="body-sales-kpi">
            <div class="row">

                <div class="col-md-3 col-sm-6 col-12 col-custom">
                    <a href="<?php echo e(action([\App\Http\Controllers\SellController::class, 'index']), false); ?>" class="info-box kpi-card-enhanced dashboard-kpi-link">
                        <span class="info-box-icon kpi-icon-sales"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo e(__('home.total_sell'), false); ?></span>
                            <span class="info-box-number total_sell"><i
                                    class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                        </div>
                        <div class="kpi-sub-detail">
                            <?php echo e(__('lang_v1.total_sale_exc_tax'), false); ?>: <span class="total_sell_exc_tax"></span><br>
                            <?php echo e(__('lang_v1.total_tax'), false); ?>: <span class="total_sell_tax"></span><br>
                            <?php echo e(__('lang_v1.total_discount'), false); ?>: <span class="total_sell_discount"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-12 col-custom">
                    <a href="<?php echo e(action([\App\Http\Controllers\ReportController::class, 'getProfitLoss']), false); ?>" class="info-box kpi-card-enhanced dashboard-kpi-link">
                        <span class="info-box-icon kpi-icon-net">
                            <i class="fas fa-hand-holding-usd"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo e(__('lang_v1.net'), false); ?>

                                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.net_home_tooltip') . '"></i>';
                }
            ?></span>
                            <span class="info-box-number net"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                        </div>

                    </a>

                </div>
                <div class="col-md-3 col-sm-6 col-12 col-custom">
                    <a href="<?php echo e(action([\App\Http\Controllers\SellController::class, 'index'], ['payment_status' => 'due']), false); ?>" class="info-box kpi-card-enhanced dashboard-kpi-link">
                        <span class="info-box-icon kpi-icon-due">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo e(__('home.invoice_due'), false); ?></span>
                            <span class="info-box-number invoice_due"><i
                                    class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                        </div>

                    </a>

                </div>

                <div class="col-md-3 col-sm-6 col-12 col-custom">
                    <a href="<?php echo e(action([\App\Http\Controllers\SellReturnController::class, 'index']), false); ?>" class="info-box kpi-card-enhanced dashboard-kpi-link">
                        <span class="info-box-icon kpi-icon-return">
                            <i class="fas fa-exchange-alt"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo e(__('lang_v1.total_sell_return'), false); ?></span>
                            <span class="info-box-number total_sell_return"><i
                                    class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                        </div>
                        <div class="kpi-sub-detail"><?php echo e(__('lang_v1.total_sell_return'), false); ?>: <span
                                class="total_sr"></span><br>
                            <?php echo e(__('lang_v1.total_sell_return_paid'), false); ?><span class="total_srp"></span></div>
                    </a>
                </div>
            </div>

            <div class="row">
                <?php if(in_array('purchases', $enabled_modules)): ?>
                    <div class="col-md-3 col-sm-6 col-12 col-custom">
                        <a href="<?php echo e(action([\App\Http\Controllers\PurchaseController::class, 'index']), false); ?>" class="info-box kpi-card-enhanced dashboard-kpi-link">
                            <span class="info-box-icon kpi-icon-purchase"><i class="fas fa-truck"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo e(__('home.total_purchase'), false); ?></span>
                                <span class="info-box-number total_purchase"><i
                                        class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                            </div>

                        </a>

                    </div>


                    <div class="col-md-3 col-sm-6 col-12 col-custom">
                        <a href="<?php echo e(action([\App\Http\Controllers\PurchaseController::class, 'index'], ['payment_status' => 'due']), false); ?>" class="info-box kpi-card-enhanced dashboard-kpi-link">
                            <span class="info-box-icon kpi-icon-purchase-due">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo e(__('home.purchase_due'), false); ?></span>
                                <span class="info-box-number purchase_due"><i
                                        class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                            </div>

                        </a>

                    </div>

                    <div class="col-md-3 col-sm-6 col-12 col-custom">
                        <a href="<?php echo e(action([\App\Http\Controllers\PurchaseReturnController::class, 'index']), false); ?>" class="info-box kpi-card-enhanced dashboard-kpi-link">
                            <span class="info-box-icon kpi-icon-purchase-return">
                                <i class="fas fa-undo-alt"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo e(__('lang_v1.total_purchase_return'), false); ?></span>
                                <span class="info-box-number total_purchase_return"><i
                                        class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                            </div>

                            <div class="kpi-sub-detail"><?php echo e(__('lang_v1.total_purchase_return'), false); ?>: <span
                                    class="total_pr"></span><br>
                                <?php echo e(__('lang_v1.total_purchase_return_paid'), false); ?><span class="total_prp"></span></div>
                        </a>

                    </div>
                <?php endif; ?>
                <?php if(in_array('expenses', $enabled_modules)): ?>
                    <!-- expense -->
                    <div class="col-md-3 col-sm-6 col-12 col-custom">
                        <a href="<?php echo e(action([\App\Http\Controllers\ExpenseController::class, 'index']), false); ?>" class="info-box kpi-card-enhanced dashboard-kpi-link">
                            <span class="info-box-icon kpi-icon-expense">
                                <i class="fas fa-minus-circle"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">
                                    <?php echo e(__('lang_v1.expense'), false); ?>

                                </span>
                                <span class="info-box-number total_expense"><i
                                        class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                            </div>

                        </a>

                    </div>
                <?php endif; ?>

            </div>

            <div class="row">
                <div class="col-md-3 col-sm-6 col-12 col-custom">
                    <a href="<?php echo e(action([\App\Http\Controllers\ContactController::class, 'index'], ['type' => 'supplier', 'payment_type' => 'due']), false); ?>" class="info-box kpi-card-enhanced dashboard-kpi-link">
                        <span class="info-box-icon kpi-icon-supplier-due">
                            <i class="fas fa-handshake"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo e(__('lang_v1.suppliers'), false); ?> <?php echo e(__('lang_v1.due'), false); ?>

                                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.contact_due_home_tooltip') . '"></i>';
                }
            ?></span>
                            <span class="info-box-number supplier_due"><i
                                    class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                        </div>

                    </a>
                </div>

                <div class="col-md-3 col-sm-6 col-12 col-custom">
                    <a href="<?php echo e(action([\App\Http\Controllers\ContactController::class, 'index'], ['type' => 'customer', 'payment_type' => 'due']), false); ?>" class="info-box kpi-card-enhanced dashboard-kpi-link">
                        <span class="info-box-icon kpi-icon-customer-due">
                            <i class="fas fa-user-clock"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo e(__('contact.customer'), false); ?> <?php echo e(__('lang_v1.due'), false); ?>

                                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.contact_due_home_tooltip') . '"></i>';
                }
            ?></span>
                            <span class="info-box-number customer_due"><i
                                    class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                        </div>

                    </a>
                </div>

                <div class="col-md-3 col-sm-6 col-12 col-custom">
                    <a href="<?php echo e(action([\App\Http\Controllers\ContactController::class, 'index'], ['type' => 'both', 'payment_type' => 'due']), false); ?>" class="info-box kpi-card-enhanced dashboard-kpi-link">
                        <span class="info-box-icon kpi-icon-barterer-due">
                            <i class="fas fa-people-arrows"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo e(__('contact.barterer'), false); ?> <?php echo e(__('lang_v1.due'), false); ?>

                                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.contact_due_home_tooltip') . '"></i>';
                }
            ?></span>
                            <span class="info-box-number barterer_due"><i
                                    class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                        </div>

                    </a>
                </div>
            </div>
                </div><!-- /dashboard-section-body sales-kpi -->
            </div><!-- /dashboard-section sales-kpi -->
            <?php endif; ?>

            <!-- end is_admin check -->
            <?php if(!$is_offline): ?>
                <?php if(!$isDashboardItemDisabled('sales_charts') && (auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.view'))): ?>
                    <!-- Sales Charts Section -->
                    <div class="dashboard-section" id="section-sales-charts">
                        <div class="dashboard-section-header" data-section="sales-charts" onclick="toggleDashboardSection('sales-charts')">
                            <h5><i class="fas fa-chart-area"></i> <?php echo app('translator')->get('home.sells_last_30_days'); ?> & <?php echo app('translator')->get('home.sells_current_fy'); ?></h5>
                            <span class="section-toggle"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="dashboard-section-body" id="body-sales-charts">
                    <?php if(!empty($all_locations)): ?>
                        <!-- sales chart start -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="sales-chart-card">
                                    <div class="sales-chart-card-header">
                                        <div class="sales-chart-title-group">
                                            <div class="sales-chart-icon"><i class="fas fa-chart-line"></i></div>
                                            <div>
                                                <h6><?php echo app('translator')->get('home.sells_last_30_days'); ?></h6>
                                                <span class="sales-chart-subtitle">Daily sales performance across all locations</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sales-chart-card-body">
                                        <div class="chart-scroll-wrapper">
                                            <?php echo $sells_chart_1->container(); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($widgets['after_sales_last_30_days'])): ?>
                        <?php $__currentLoopData = $widgets['after_sales_last_30_days']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $widget; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <?php if(!empty($all_locations)): ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="sales-chart-card">
                                    <div class="sales-chart-card-header">
                                        <div class="sales-chart-title-group">
                                            <div class="sales-chart-icon fy-icon"><i class="fas fa-calendar-alt"></i></div>
                                            <div>
                                                <h6><?php echo app('translator')->get('home.sells_current_fy'); ?></h6>
                                                <span class="sales-chart-subtitle">Monthly sales trend for the current financial year</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sales-chart-card-body">
                                        <div class="chart-scroll-wrapper">
                                            <?php echo $sells_chart_2->container(); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                        </div><!-- /dashboard-section-body sales-charts -->
                    </div><!-- /dashboard-section sales-charts -->
                <?php endif; ?>
            <?php endif; ?>

            <!-- sales chart end -->
            <?php if(!$is_offline): ?>
                <!-- Reports Section -->
                <?php if(!$isDashboardItemDisabled('reports')): ?>
                <div class="dashboard-section" id="section-reports">
                    <div class="dashboard-section-header" data-section="reports" onclick="toggleDashboardSection('reports')">
                        <h5><i class="fas fa-file-alt"></i> <?php echo app('translator')->get('lang_v1.reports'); ?> <?php echo app('translator')->get('lang_v1.overview'); ?></h5>
                        <span class="section-toggle"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="dashboard-section-body" id="body-reports">
                <div class="row">
                    <?php if((auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.view')) && auth()->user()->can('product_sell_report.view')): ?>
                        <!-- Product Sale Report - Sale by Categories -->
                        <div class="col-sm-6">
                            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                                <?php $__env->slot('icon'); ?>
                                    <i class="fa fa-cash text-yellow" aria-hidden="true"></i>
                                <?php $__env->endSlot(); ?>
                                <?php $__env->slot('title'); ?>
                                    <?php echo e(__('home.income_summary'), false); ?>

                                <?php $__env->endSlot(); ?>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-text-center table-th-skin"
                                                id="income_summary_table" style="width: 100% !important">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo app('translator')->get('lang_v1.detail'); ?></th>
                                                        <th><?php echo app('translator')->get('sale.total'); ?></th>
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>
                                    </div>
                                </div>
                            <?php echo $__env->renderComponent(); ?>
                        </div>
                        <!-- Sale by Categories End -->
                    <?php endif; ?>
                    <?php if(Module::has('Woocommerce') && Module::find('Woocommerce')->isEnabled()): ?>
                        <!-- WooCommerce Synced Orders Summary -->
                        <div class="col-sm-6">
                            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                                <?php $__env->slot('icon'); ?>
                                    <i class="fab fa-wordpress text-purple" aria-hidden="true"></i>
                                <?php $__env->endSlot(); ?>
                                <?php $__env->slot('title'); ?>
                                    WooCommerce <?php echo app('translator')->get('lang_v1.orders'); ?>
                                <?php $__env->endSlot(); ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-text-center table-th-skin"
                                                id="woocommerce_summary_table" style="width: 100% !important">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo app('translator')->get('lang_v1.detail'); ?></th>
                                                        <th><?php echo app('translator')->get('sale.total'); ?></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php echo $__env->renderComponent(); ?>
                        </div>
                        <!-- WooCommerce Summary End -->
                    <?php endif; ?>
                    <div class="clearfix"></div>
                    <?php if((auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.view')) && auth()->user()->can('product_sell_report.view')): ?>
                        <!-- Product Sale Report - Sale by Categories -->
                        <div class="col-sm-6">
                            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                                <?php $__env->slot('icon'); ?>
                                    <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                                <?php $__env->endSlot(); ?>
                                <?php $__env->slot('title'); ?>
                                    <?php echo e(__('home.sells_by_category'), false); ?>

                                <?php $__env->endSlot(); ?>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-text-center table-th-skin"
                                                id="sales_by_categories_table" style="width: 100% !important">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo app('translator')->get('product.category'); ?></th>
                                                        <th><?php echo app('translator')->get('sale.total'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr class="bg-gray font-17 footer-total">
                                                        <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                                        <td id="" class="footer_total"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                            <p class="text-muted">
                                                <?php echo app('translator')->get('lang_v1.profit_note'); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php echo $__env->renderComponent(); ?>
                        </div>
                        <!-- Sale by Categories End -->
                    <?php endif; ?>

                    <?php if(auth()->user()->can('profit_loss_report.view')): ?>
                        <!-- Profit / Loss Report with Categories -->
                        <div class="col-sm-6">
                            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                                <?php $__env->slot('icon'); ?>
                                    <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                                <?php $__env->endSlot(); ?>
                                <?php $__env->slot('title'); ?>
                                    <?php echo e(__('lang_v1.profit_loss_report'), false); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_profit_loss_report') . '"></i>';
                }
            ?>
                                <?php $__env->endSlot(); ?>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-text-center table-th-skin"
                                                id="profit_by_categories_table" style="width: 100% !important">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo app('translator')->get('product.category'); ?></th>
                                                        <th><?php echo app('translator')->get('lang_v1.gross_profit'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr class="bg-gray font-17 footer-total">
                                                        <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                                        <td id="" class="footer_total"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                            <p class="text-muted">
                                                <?php echo app('translator')->get('lang_v1.profit_note'); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php echo $__env->renderComponent(); ?>
                        </div>
                        <!-- Profit / Loss Report with Categories End -->
                    <?php endif; ?>

                    <?php if(auth()->user()->can('expense_report.view')): ?>
                        <!-- Expense Report with Categories -->
                        <div class="col-sm-6">
                            <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                                <?php $__env->slot('icon'); ?>
                                    <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                                <?php $__env->endSlot(); ?>
                                <?php $__env->slot('title'); ?>
                                    <?php echo e(__('report.expense_report'), false); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_expense_report') . '"></i>';
                }
            ?>
                                <?php $__env->endSlot(); ?>

                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-text-center table-th-skin"
                                                id="expense_report_table_dashboard" style="width: 100% !important">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo app('translator')->get('expense.expense_categories'); ?></th>
                                                        <th><?php echo app('translator')->get('report.total_expense'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr class="bg-gray font-17 footer-total">
                                                        <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                                        <td id="" class="footer_total"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php echo $__env->renderComponent(); ?>
                        </div>
                        <!-- Expense Report with Categories End -->
                    <?php endif; ?>

                    <?php if(auth()->user()->can('sales_representative.view')): ?>
                        <!-- Sales by User -->
                        <div class="col-sm-6">
                            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                                <?php $__env->slot('icon'); ?>
                                    <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                                <?php $__env->endSlot(); ?>
                                <?php $__env->slot('title'); ?>
                                    <?php echo e(__('lang_v1.user_sale_report'), false); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_user_sale_report') . '"></i>';
                }
            ?>
                                <?php $__env->endSlot(); ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-text-center table-th-skin"
                                                id="sale_by_user_table" style="width: 100% !important">
                                                <thead>
                                                    <tr>
                                                        <th>User Name</th>
                                                        <th>Sale</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr class="bg-gray font-17 footer-total">
                                                        <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                                        <td id="" class="footer_total"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            <?php echo $__env->renderComponent(); ?>
                        </div>
                        <!-- Sales By User End -->
                    <?php endif; ?>
                </div>
                    </div><!-- /dashboard-section-body reports -->
                </div><!-- /dashboard-section reports -->
                <?php endif; ?>

                <?php if(!$isDashboardItemDisabled('module_widgets') && !empty($widgets['after_sales_current_fy'])): ?>
                    <?php $__currentLoopData = $widgets['after_sales_current_fy']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $widget; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <!-- Payment Dues & PDC Section -->
                <?php if(!$isDashboardItemDisabled('payment_dues')): ?>
                <div class="dashboard-section" id="section-payment-dues">
                    <div class="dashboard-section-header" data-section="payment-dues" onclick="toggleDashboardSection('payment-dues')">
                        <h5><i class="fas fa-money-check-alt"></i> <?php echo app('translator')->get('home.payment_dues'); ?> & PDC</h5>
                        <span class="section-toggle"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="dashboard-section-body" id="body-payment-dues">
                <!-- products less than alert quntity -->
                <div class="row">
                    <?php if(auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.view')): ?>
                        <div class="col-sm-6">
                            <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                                <?php $__env->slot('icon'); ?>
                                    <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                                <?php $__env->endSlot(); ?>
                                <?php $__env->slot('title'); ?>
                                    <?php echo e(__('lang_v1.sales_payment_dues'), false); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_sales_payment_dues') . '"></i>';
                }
            ?>
                                <?php $__env->endSlot(); ?>
                                <div class="row">
                                    <?php if(count($all_locations) > 1): ?>
                                        <div class="col-md-6 col-sm-6 col-md-offset-6 mb-10">
                                            <?php echo Form::select('sales_payment_dues_location', $all_locations, null, [
                                                'class' => 'form-control select2',
                                                'placeholder' => __('lang_v1.select_location'),
                                                'id' => 'sales_payment_dues_location',
                                            ]); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin"
                                            id="sales_payment_dues_table" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th><?php echo app('translator')->get('contact.customer'); ?></th>
                                                    <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                                    <th><?php echo app('translator')->get('home.due_amount'); ?></th>
                                                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                                                </tr>
                                            </thead>
                                        </table>
</div>
                                    </div>
                                </div>
                            <?php echo $__env->renderComponent(); ?>
                        </div>
                    <?php endif; ?>
                    <?php if(in_array('purchases', $enabled_modules)): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase.view')): ?>
                            <div class="col-sm-6">
                                <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                                    <?php $__env->slot('icon'); ?>
                                        <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                                    <?php $__env->endSlot(); ?>
                                    <?php $__env->slot('title'); ?>
                                        <?php echo e(__('lang_v1.purchase_payment_dues'), false); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.payment_dues') . '"></i>';
                }
            ?>
                                    <?php $__env->endSlot(); ?>
                                    <div class="row">
                                        <?php if(count($all_locations) > 1): ?>
                                            <div class="col-md-6 col-sm-6 col-md-offset-6 mb-10">
                                                <?php echo Form::select('purchase_payment_dues_location', $all_locations, null, [
                                                    'class' => 'form-control select2',
                                                    'placeholder' => __('lang_v1.select_location'),
                                                    'id' => 'purchase_payment_dues_location',
                                                ]); ?>

                                            </div>
                                        <?php endif; ?>
                                        <div class="col-md-12">
                                            <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin"
                                                id="purchase_payment_dues_table" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo app('translator')->get('purchase.supplier'); ?></th>
                                                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                                        <th><?php echo app('translator')->get('home.due_amount'); ?></th>
                                                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                                                    </tr>
                                                </thead>
                                            </table>
</div>
                                        </div>
                                    </div>
                                <?php echo $__env->renderComponent(); ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <?php if(auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.view')): ?>
                        <div class="col-sm-6">
                            <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                                <?php $__env->slot('icon'); ?>
                                    <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                                <?php $__env->endSlot(); ?>
                                <?php $__env->slot('title'); ?>
                                    <?php echo e(__('lang_v1.sales_pdc_upcoming'), false); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_sales_pdc_upcoming') . '"></i>';
                }
            ?>
                                <?php $__env->endSlot(); ?>
                                <div class="row">
                                    <?php if(count($all_locations) > 1): ?>
                                        <div class="col-md-6 col-sm-6 col-md-offset-6 mb-10">
                                            <?php echo Form::select('sales_pdc_upcoming_location', $all_locations, null, [
                                                'class' => 'form-control select2',
                                                'placeholder' => __('lang_v1.select_location'),
                                                'id' => 'sales_pdc_upcoming_location',
                                            ]); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin"
                                            id="sales_pdc_upcoming_table" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th><?php echo app('translator')->get('contact.customer'); ?></th>
                                                    <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                                    <th><?php echo app('translator')->get('To Cash on'); ?></th>
                                                    <th><?php echo app('translator')->get('sale.status'); ?></th>
                                                    <th><?php echo app('translator')->get('sale.amount'); ?></th>
                                                </tr>
                                            </thead>
                                        </table>
</div>
                                    </div>
                                </div>
                            <?php echo $__env->renderComponent(); ?>
                        </div>
                    <?php endif; ?>
                    <?php if(in_array('purchases', $enabled_modules)): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase.view')): ?>
                            <div class="col-sm-6">
                                <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                                    <?php $__env->slot('icon'); ?>
                                        <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                                    <?php $__env->endSlot(); ?>
                                    <?php $__env->slot('title'); ?>
                                        <?php echo e(__('lang_v1.purchase_pdc_upcoming'), false); ?>

                                        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_purchase_pdc_upcoming') . '"></i>';
                }
            ?>
                                    <?php $__env->endSlot(); ?>
                                    <div class="row">
                                        <?php if(count($all_locations) > 1): ?>
                                            <div class="col-md-6 col-sm-6 col-md-offset-6 mb-10">
                                                <?php echo Form::select('purchase_pdc_upcoming_location', $all_locations, null, [
                                                    'class' => 'form-control select2',
                                                    'placeholder' => __('lang_v1.select_location'),
                                                    'id' => 'purchase_pdc_upcoming_location',
                                                ]); ?>

                                            </div>
                                        <?php endif; ?>
                                        <div class="col-md-12">
                                            <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin"
                                                id="purchase_pdc_upcoming_table" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo app('translator')->get('purchase.supplier'); ?></th>
                                                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                                        <th><?php echo app('translator')->get('Date'); ?></th>
                                                        <th><?php echo app('translator')->get('sale.status'); ?></th>
                                                        <th><?php echo app('translator')->get('sale.amount'); ?></th>
                                                    </tr>
                                                </thead>
                                            </table>
</div>
                                        </div>
                                    </div>
                                <?php echo $__env->renderComponent(); ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <?php if(auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.view')): ?>
                        <div class="col-sm-6">
                            <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                                <?php $__env->slot('icon'); ?>
                                    <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                                <?php $__env->endSlot(); ?>
                                <?php $__env->slot('title'); ?>
                                    <?php echo e(__('lang_v1.customers_pdc_upcoming'), false); ?>

                                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_customers_pdc_upcoming') . '"></i>';
                }
            ?>
                                <?php $__env->endSlot(); ?>
                                <div class="row">
                                    <?php if(count($all_locations) > 1): ?>
                                        <div class="col-md-6 col-sm-6 col-md-offset-6 mb-10">
                                            <?php echo Form::select('customers_pdc_upcoming_location', $all_locations, null, [
                                                'class' => 'form-control select2',
                                                'placeholder' => __('lang_v1.select_location'),
                                                'id' => 'customers_pdc_upcoming_location',
                                            ]); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin"
                                            id="customers_pdc_upcoming_table" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th><?php echo app('translator')->get('contact.customer'); ?></th>
                                                    <th><?php echo app('translator')->get('To Cash on'); ?></th>
                                                    <th><?php echo app('translator')->get('sale.ref_no'); ?></th>
                                                    <th><?php echo app('translator')->get('sale.status'); ?></th>
                                                    <th><?php echo app('translator')->get('sale.amount'); ?></th>
                                                </tr>
                                            </thead>
                                        </table>
</div>
                                    </div>
                                </div>
                            <?php echo $__env->renderComponent(); ?>
                        </div>
                    <?php endif; ?>
                    <?php if(in_array('purchases', $enabled_modules)): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase.view')): ?>
                            <div class="col-sm-6">
                                <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                                    <?php $__env->slot('icon'); ?>
                                        <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                                    <?php $__env->endSlot(); ?>
                                    <?php $__env->slot('title'); ?>
                                        <?php echo e(__('lang_v1.supplier_pdc_upcoming'), false); ?>

                                        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_supplier_pdc_upcoming') . '"></i>';
                }
            ?>
                                    <?php $__env->endSlot(); ?>
                                    <div class="row">
                                        <?php if(count($all_locations) > 1): ?>
                                            <div class="col-md-6 col-sm-6 col-md-offset-6 mb-10">
                                                <?php echo Form::select('supplier_pdc_upcoming_location', $all_locations, null, [
                                                    'class' => 'form-control select2',
                                                    'placeholder' => __('lang_v1.select_location'),
                                                    'id' => 'supplier_pdc_upcoming_location',
                                                ]); ?>

                                            </div>
                                        <?php endif; ?>
                                        <div class="col-md-12">
                                            <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin"
                                                id="supplier_pdc_upcoming_table" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo app('translator')->get('purchase.supplier'); ?></th>
                                                        <th><?php echo app('translator')->get('To Cash on'); ?></th>
                                                        <th><?php echo app('translator')->get('sale.ref_no'); ?></th>
                                                        <th><?php echo app('translator')->get('sale.status'); ?></th>
                                                        <th><?php echo app('translator')->get('sale.amount'); ?></th>
                                                    </tr>
                                                </thead>
                                            </table>
</div>
                                        </div>
                                    </div>
                                <?php echo $__env->renderComponent(); ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                    </div><!-- /dashboard-section-body payment-dues -->
                </div><!-- /dashboard-section payment-dues -->
                <?php endif; ?>

                <!-- Orders & Shipments Section -->
                <?php if(!$isDashboardItemDisabled('orders')): ?>
                <div class="dashboard-section" id="section-orders">
                    <div class="dashboard-section-header" data-section="orders" onclick="toggleDashboardSection('orders')">
                        <h5><i class="fas fa-clipboard-list"></i> <?php echo app('translator')->get('lang_v1.orders'); ?> & <?php echo app('translator')->get('lang_v1.shipments'); ?></h5>
                        <span class="section-toggle"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="dashboard-section-body" id="body-orders">

                <?php if(!empty($pos_settings['enable_sales_order']) && (auth()->user()->can('so.view_all') || auth()->user()->can('so.view_own'))): ?>
                    <div class="row" <?php if(!auth()->user()->can('dashboard.data')): ?> style="margin-top: 190px !important;" <?php endif; ?>>
                        <div class="col-sm-12">
                            <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                                <?php $__env->slot('icon'); ?>
                                    <i class="fas fa-list-alt text-yellow fa-lg" aria-hidden="true"></i>
                                <?php $__env->endSlot(); ?>
                                <?php $__env->slot('title'); ?>
                                    <?php echo e(__('lang_v1.sales_order'), false); ?>

                                <?php $__env->endSlot(); ?>
                                <div class="row">
                                    <?php if(count($all_locations) > 1): ?>
                                        <div class="col-md-4 col-sm-6 col-md-offset-8 mb-10">
                                            <?php echo Form::select('so_location', $all_locations, null, [
                                                'class' => 'form-control select2',
                                                'placeholder' => __('lang_v1.select_location'),
                                                'id' => 'so_location',
                                            ]); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped ajax_view table-th-skin"
                                                id="sales_order_table">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                                        <th><?php echo app('translator')->get('restaurant.order_no'); ?></th>
                                                        <th><?php echo app('translator')->get('sale.customer_name'); ?></th>
                                                        <th><?php echo app('translator')->get('lang_v1.contact_no'); ?></th>
                                                        <th><?php echo app('translator')->get('sale.location'); ?></th>
                                                        <th><?php echo app('translator')->get('sale.status'); ?></th>
                                                        <th><?php echo app('translator')->get('lang_v1.shipping_status'); ?></th>
                                                        <th><?php echo app('translator')->get('lang_v1.quantity_remaining'); ?></th>
                                                        <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php echo $__env->renderComponent(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(
                    !empty($common_settings['enable_purchase_requisition']) &&
                        (auth()->user()->can('purchase_requisition.view_all') || auth()->user()->can('purchase_requisition.view_own'))): ?>
                    <div class="row" <?php if(!auth()->user()->can('dashboard.data')): ?> style="margin-top: 190px !important;" <?php endif; ?>>
                        <div class="col-sm-12">
                            <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                                <?php $__env->slot('icon'); ?>
                                    <i class="fas fa-list-alt text-yellow fa-lg" aria-hidden="true"></i>
                                <?php $__env->endSlot(); ?>
                                <?php $__env->slot('title'); ?>
                                    <?php echo app('translator')->get('lang_v1.purchase_requisition'); ?>
                                <?php $__env->endSlot(); ?>
                                <div class="row">
                                    <?php if(count($all_locations) > 1): ?>
                                        <div class="col-md-4 col-sm-6 col-md-offset-8 mb-10">
                                            <?php echo Form::select('pr_location', $all_locations, null, [
                                                'class' => 'form-control select2',
                                                'placeholder' => __('lang_v1.select_location'),
                                                'id' => 'pr_location',
                                            ]); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped ajax_view table-th-skin"
                                                id="purchase_requisition_table" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                                        <th><?php echo app('translator')->get('purchase.location'); ?></th>
                                                        <th><?php echo app('translator')->get('sale.status'); ?></th>
                                                        <th><?php echo app('translator')->get('lang_v1.required_by_date'); ?></th>
                                                        <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php echo $__env->renderComponent(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(
                    !empty($common_settings['enable_purchase_order']) &&
                        (auth()->user()->can('purchase_order.view_all') || auth()->user()->can('purchase_order.view_own'))): ?>
                    <div class="row" <?php if(!auth()->user()->can('dashboard.data')): ?> style="margin-top: 190px !important;" <?php endif; ?>>
                        <div class="col-sm-12">
                            <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                                <?php $__env->slot('icon'); ?>
                                    <i class="fas fa-list-alt text-yellow fa-lg" aria-hidden="true"></i>
                                <?php $__env->endSlot(); ?>
                                <?php $__env->slot('title'); ?>
                                    <?php echo app('translator')->get('lang_v1.purchase_order'); ?>
                                <?php $__env->endSlot(); ?>
                                <div class="row">
                                    <?php if(count($all_locations) > 1): ?>
                                        <div class="col-md-4 col-sm-6 col-md-offset-8 mb-10">
                                            <?php echo Form::select('po_location', $all_locations, null, [
                                                'class' => 'form-control select2',
                                                'placeholder' => __('lang_v1.select_location'),
                                                'id' => 'po_location',
                                            ]); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped ajax_view table-th-skin"
                                                id="purchase_order_table" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                                        <th><?php echo app('translator')->get('purchase.location'); ?></th>
                                                        <th><?php echo app('translator')->get('purchase.supplier'); ?></th>
                                                        <th><?php echo app('translator')->get('sale.status'); ?></th>
                                                        <th><?php echo app('translator')->get('lang_v1.quantity_remaining'); ?></th>
                                                        <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php echo $__env->renderComponent(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(
                    !empty($common_settings['enable_shipping_details_sale']) &&
                        (auth()->user()->can('access_pending_shipments_only') ||
                            auth()->user()->can('access_shipping') ||
                            auth()->user()->can('access_own_shipping'))): ?>
                    <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                        <?php $__env->slot('icon'); ?>
                            <i class="fas fa-list-alt text-yellow fa-lg" aria-hidden="true"></i>
                        <?php $__env->endSlot(); ?>
                        <?php $__env->slot('title'); ?>
                            <?php echo app('translator')->get('lang_v1.pending_shipments'); ?>
                        <?php $__env->endSlot(); ?>
                        <div class="row">
                            <?php if(count($all_locations) > 1): ?>
                                <div class="col-md-4 col-sm-6 col-md-offset-8 mb-10">
                                    <?php echo Form::select('pending_shipments_location', $all_locations, null, [
                                        'class' => 'form-control select2',
                                        'placeholder' => __('lang_v1.select_location'),
                                        'id' => 'pending_shipments_location',
                                    ]); ?>

                                </div>
                            <?php endif; ?>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped ajax_view table-th-skin"
                                        id="shipments_table">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get('messages.action'); ?></th>
                                                <th><?php echo app('translator')->get('messages.date'); ?></th>
                                                <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                                <th><?php echo app('translator')->get('sale.customer_name'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.contact_no'); ?></th>
                                                <th><?php echo app('translator')->get('sale.location'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.shipping_status'); ?></th>
                                                <?php if(!empty($custom_labels['shipping']['custom_field_1'])): ?>
                                                    <th>
                                                        <?php echo e($custom_labels['shipping']['custom_field_1'], false); ?>

                                                    </th>
                                                <?php endif; ?>
                                                <?php if(!empty($custom_labels['shipping']['custom_field_2'])): ?>
                                                    <th>
                                                        <?php echo e($custom_labels['shipping']['custom_field_2'], false); ?>

                                                    </th>
                                                <?php endif; ?>
                                                <?php if(!empty($custom_labels['shipping']['custom_field_3'])): ?>
                                                    <th>
                                                        <?php echo e($custom_labels['shipping']['custom_field_3'], false); ?>

                                                    </th>
                                                <?php endif; ?>
                                                <?php if(!empty($custom_labels['shipping']['custom_field_4'])): ?>
                                                    <th>
                                                        <?php echo e($custom_labels['shipping']['custom_field_4'], false); ?>

                                                    </th>
                                                <?php endif; ?>
                                                <?php if(!empty($custom_labels['shipping']['custom_field_5'])): ?>
                                                    <th>
                                                        <?php echo e($custom_labels['shipping']['custom_field_5'], false); ?>

                                                    </th>
                                                <?php endif; ?>
                                                <th><?php echo app('translator')->get('sale.payment_status'); ?></th>
                                                <th><?php echo app('translator')->get('restaurant.service_staff'); ?></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php echo $__env->renderComponent(); ?>
                <?php endif; ?>
                    </div><!-- /dashboard-section-body orders -->
                </div><!-- /dashboard-section orders -->
                <?php endif; ?>

                <?php if(!$isDashboardItemDisabled('orders') && auth()->user()->can('account.access') && in_array('account', $enabled_modules) && config('constants.show_payments_recovered_today') == true): ?>
                    <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                        <?php $__env->slot('icon'); ?>
                            <i class="fas fa-money-bill-alt text-yellow fa-lg" aria-hidden="true"></i>
                        <?php $__env->endSlot(); ?>
                        <?php $__env->slot('title'); ?>
                            <?php echo app('translator')->get('lang_v1.payment_recovered_today'); ?>
                        <?php $__env->endSlot(); ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin" id="cash_flow_table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('account.account'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.description'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.payment_details'); ?></th>
                                        <th><?php echo app('translator')->get('account.credit'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.account_balance'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.account_balance_tooltip') . '"></i>';
                }
            ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.total_balance'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.total_balance_tooltip') . '"></i>';
                }
            ?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td colspan="5"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td class="footer_total_credit"></td>
                                        <td colspan="2"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <?php echo $__env->renderComponent(); ?>
                <?php endif; ?>

                <?php if(!$isDashboardItemDisabled('orders') && $accounting_enabled && config('constants.show_payments_recovered_today') == true): ?>
                    <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                        <?php $__env->slot('icon'); ?>
                            <i class="fas fa-money-bill-alt text-yellow fa-lg" aria-hidden="true"></i>
                        <?php $__env->endSlot(); ?>
                        <?php $__env->slot('title'); ?>
                            <?php echo app('translator')->get('lang_v1.payment_recovered_today'); ?>
                        <?php $__env->endSlot(); ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-th-skin" id="accouting_payments_recovered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                                        <th><?php echo app('translator')->get('account.account'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.description'); ?></th>
                                        <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                                        
                                        <th><?php echo app('translator')->get('account.credit'); ?></th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td colspan="4"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                        <td class="footer_total_credit"></td>
                                        
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <?php echo $__env->renderComponent(); ?>
                <?php endif; ?>

                <?php if(!$isDashboardItemDisabled('module_widgets') && !empty($widgets['after_dashboard_reports'])): ?>
                    <?php $__currentLoopData = $widgets['after_dashboard_reports']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $widget; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php else: ?>
                
            <?php endif; ?>
            
    <?php endif; ?>
            <!-- can('dashboard.data') end -->

            <?php if(!$isDashboardItemDisabled('stock_alerts') && in_array('purchases', $enabled_modules) && (auth()->user()->can('stock_report.view') || session('business.enable_product_expiry') == 1)): ?>
            <!-- Stock Alerts Section -->
                <div class="dashboard-section" id="section-stock-alerts">
                    <div class="dashboard-section-header" data-section="stock-alerts" onclick="toggleDashboardSection('stock-alerts')">
                        <h5><i class="fas fa-exclamation-triangle"></i> <?php echo app('translator')->get('home.product_stock_alert'); ?></h5>
                        <span class="section-toggle"><i class="fas fa-chevron-down"></i></span>
                    </div>
                    <div class="dashboard-section-body" id="body-stock-alerts">
                            
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('stock_report.view')): ?>
                            <div class="row">
                                <div class="<?php if(session('business.enable_product_expiry') != 1 && auth()->user()->can('stock_report.view')): ?> col-sm-12 <?php else: ?> col-sm-6 <?php endif; ?>">
                                    <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                                        <?php $__env->slot('icon'); ?>
                                            <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                                        <?php $__env->endSlot(); ?>
                                        <?php $__env->slot('title'); ?>
                                            <?php echo e(__('home.product_stock_alert'), false); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.product_stock_alert') . '"></i>';
                }
            ?>
                                        <?php $__env->endSlot(); ?>
                                        <div class="row">
                                            <?php if(count($all_locations) > 1): ?>
                                                <div class="col-md-6 col-sm-6 mb-10">
                                                    <?php echo Form::select('stock_alert_location', $all_locations, null, [
                                                        'class' => 'form-control select2',
                                                        'placeholder' => __('lang_v1.select_location'),
                                                        'id' => 'stock_alert_location',
                                                    ]); ?>

                                                </div>
                                            <?php endif; ?>
                                            <div class="<?php if(count($all_locations) > 1): ?> col-md-6 col-sm-6 <?php else: ?> col-md-12 <?php endif; ?> mb-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fas fa-search"></i></span>
                                                    <input type="text" class="form-control" id="stock_alert_search" placeholder="<?php echo app('translator')->get('lang_v1.search'); ?>...">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-th-skin" id="stock_alert_table"
                                                        style="width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th><?php echo app('translator')->get('sale.product'); ?></th>
                                                                <th><?php echo app('translator')->get('business.location'); ?></th>
                                                                <th><?php echo app('translator')->get('report.current_stock'); ?></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo $__env->renderComponent(); ?>
                                </div>
                                <?php if(session('business.enable_product_expiry') == 1): ?>
                                    <div class="col-sm-6">
                                        <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                                            <?php $__env->slot('icon'); ?>
                                                <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                                            <?php $__env->endSlot(); ?>
                                            <?php $__env->slot('title'); ?>
                                                <?php echo e(__('home.stock_expiry_alert'), false); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.stock_expiry_alert', [
                                                'days'
                                                =>session('business.stock_expiry_alert_days', 30) ]) . '"></i>';
                }
            ?>
                                            <?php $__env->endSlot(); ?>
                                            <input type="hidden" id="stock_expiry_alert_days"
                                                value="<?php echo e(\Carbon::now()->addDays(session('business.stock_expiry_alert_days', 30))->format('Y-m-d'), false); ?>">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-th-skin"
                                                    id="stock_expiry_alert_table">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo app('translator')->get('business.product'); ?></th>
                                                            <th><?php echo app('translator')->get('business.location'); ?></th>
                                                            <th><?php echo app('translator')->get('report.stock_left'); ?></th>
                                                            <th><?php echo app('translator')->get('product.expires_in'); ?></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        <?php echo $__env->renderComponent(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div><!-- /dashboard-section-body stock-alerts -->
                </div><!-- /dashboard-section stock-alerts -->
                <?php endif; ?>
    </section>
    <!-- /.content -->
    
    <div class="modal fade edit_pso_status_modal" tabindex="-1" role="dialog"></div>
    <div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>

    <style>
        /* Payment recovered today tables - full width and responsive columns */
        #cash_flow_table,
        #accouting_payments_recovered {
            width: 100% !important;
        }
        #cash_flow_table th:not(:nth-child(3)),
        #cash_flow_table td:not(:nth-child(3)),
        #accouting_payments_recovered th:not(:nth-child(3)),
        #accouting_payments_recovered td:not(:nth-child(3)) {
            white-space: nowrap;
        }
        #cash_flow_table td:nth-child(3),
        #accouting_payments_recovered td:nth-child(3) {
            word-break: break-word;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/chart.umd.min.js?v=' . $asset_v), false); ?>"></script>
    <script>
        window.dashboardDateFilterDefault = <?php echo json_encode($dashboard_date_filter_range ?? 'today', 15, 512) ?>;
    </script>
    <script src="<?php echo e(asset('js/home.js?v=' . $asset_v), false); ?>"></script>
    <script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
    <script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
    <?php if ($__env->exists('sales_order.common_js')) echo $__env->make('sales_order.common_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if ($__env->exists('purchase_order.common_js')) echo $__env->make('purchase_order.common_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(!$isDashboardItemDisabled('sales_charts') && !empty($all_locations)): ?>
        <?php echo $sells_chart_1->script(); ?>

        <?php echo $sells_chart_2->script(); ?>

    <?php endif; ?>

    <!-- Reflow Highcharts after CSS responsive resize (deferred) -->
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                if (typeof Highcharts !== 'undefined') {
                    Highcharts.charts.forEach(function(chart) {
                        if (chart) chart.reflow();
                    });
                }
            }, 2000);
        });
    </script>

    <!-- Dashboard Enhancement Scripts -->
    <script type="text/javascript">
        // Collapsible Dashboard Sections
        function toggleDashboardSection(sectionId) {
            var body = document.getElementById('body-' + sectionId);
            var header = body ? body.previousElementSibling : null;
            if (!body) return;

            if (body.classList.contains('section-collapsed')) {
                body.classList.remove('section-collapsed');
                body.style.maxHeight = body.scrollHeight + 'px';
                body.style.opacity = '1';
                if (header) header.classList.remove('collapsed');
                localStorage.setItem('dash_section_' + sectionId, 'open');
            } else {
                body.classList.add('section-collapsed');
                body.style.maxHeight = '0';
                body.style.opacity = '0';
                if (header) header.classList.add('collapsed');
                localStorage.setItem('dash_section_' + sectionId, 'closed');
            }
        }

        // Restore collapsed states on page load
        document.addEventListener('DOMContentLoaded', function() {
            var sections = ['advanced-analytics', 'sales-kpi', 'sales-charts', 'reports', 'payment-dues', 'stock-alerts', 'orders'];
            sections.forEach(function(sectionId) {
                var state = localStorage.getItem('dash_section_' + sectionId);
                var body = document.getElementById('body-' + sectionId);
                if (body && state === 'closed') {
                    body.classList.add('section-collapsed');
                    body.style.maxHeight = '0';
                    body.style.opacity = '0';
                    var header = body.previousElementSibling;
                    if (header) header.classList.add('collapsed');
                } else if (body) {
                    body.style.maxHeight = 'none';
                }
            });
        });
    </script>

    <script type="text/javascript">
        // Orders & Shipments section: lazy-loaded
        window._initDashSection_orders = function() {

            <?php if(!empty($pos_settings['enable_sales_order'])): ?>
            sales_order_table = $('#sales_order_table').DataTable({
                processing: true,
                serverSide: true,
                scrollY: "75vh",
                scrollX: true,
                scrollCollapse: true,
                aaSorting: [
                    [1, 'desc']
                ],

                "ajax": {
                    "url": '<?php echo e(action([\App\Http\Controllers\SellController::class, 'index']), false); ?>?sale_type=sales_order',
                    "data": function(d) {
                        d.for_dashboard_sales_order = true;

                        if ($('#so_location').length > 0) {
                            d.location_id = $('#so_location').val();
                        }
                    }
                },
                columnDefs: [{
                    "targets": 7,
                    "orderable": false,
                    "searchable": false
                }],
                columns: [{
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'transaction_date',
                        name: 'transaction_date'
                    },
                    {
                        data: 'invoice_no',
                        name: 'invoice_no'
                    },
                    {
                        data: 'conatct_name',
                        name: 'conatct_name'
                    },
                    {
                        data: 'mobile',
                        name: 'contacts.mobile'
                    },
                    {
                        data: 'business_location',
                        name: 'bl.name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'shipping_status',
                        name: 'shipping_status'
                    },
                    {
                        data: 'so_qty_remaining',
                        name: 'so_qty_remaining',
                        "searchable": false
                    },
                    {
                        data: 'added_by',
                        name: 'u.first_name'
                    },
                ]
            });
            $('#so_location').change(function() {
                sales_order_table.ajax.reload();
            });
            <?php endif; ?>

            <?php if(auth()->user()->can('account.access') &&
                    in_array('account', $enabled_modules) &&
                    config('constants.show_payments_recovered_today') == true): ?>
            console.log('Initializing Cash Flow Table');
                // Cash Flow Table
                cash_flow_table = $('#cash_flow_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "ajax": {
                        "url": "<?php echo e(action([\App\Http\Controllers\AccountController::class, 'cashFlow']), false); ?>",
                        "data": function(d) {
                            d.type = 'credit';
                            d.only_payment_recovered = true;
                        }
                    },
                    "ordering": false,
                    "searching": false,
                    "autoWidth": true,
                    columns: [{
                            data: 'operation_date',
                            name: 'operation_date'
                        },
                        {
                            data: 'account_name',
                            name: 'account_name'
                        },
                        {
                            data: 'sub_type',
                            name: 'sub_type'
                        },
                        {
                            data: 'method',
                            name: 'TP.method'
                        },
                        {
                            data: 'payment_details',
                            name: 'payment_details',
                            searchable: false
                        },
                        {
                            data: 'credit',
                            name: 'amount'
                        },
                        {
                            data: 'balance',
                            name: 'balance'
                        },
                        {
                            data: 'total_balance',
                            name: 'total_balance'
                        },
                    ],
                    "fnDrawCallback": function(oSettings) {
                        __currency_convert_recursively($('#cash_flow_table'));
                    },
                    "footerCallback": function(row, data, start, end, display) {
                        var footer_total_credit = 0;

                        for (var r in data) {
                            footer_total_credit += $(data[r].credit).data('orig-value') ? parseFloat($(
                                data[r].credit).data('orig-value')) : 0;
                        }
                        $('.footer_total_credit').html(__currency_trans_from_en(footer_total_credit));
                    }
                });
            <?php endif; ?>

            <?php if($accounting_enabled && config('constants.show_payments_recovered_today') == true): ?>
                // Accounting Payments Account
                accouting_payments_recovered = $('#accouting_payments_recovered').DataTable({
                    processing: true,
                    serverSide: true,
                    "ajax": {
                        "url": "<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'payments_recovered_report']), false); ?>",
                        // "url": "/accounting/payments-recoverd",
                        "data": function(d) {
                            if ($('#dashboard_location').length > 0) {
                                d.start_date = $('#dashboard_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#dashboard_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#dashboard_location').val();
                            }
                        }
                    },
                    "ordering": false,
                    "searching": false,
                    "autoWidth": true,
                    columns: [{
                            data: 'operation_date',
                            name: 'operation_date'
                        },
                        {
                            data: 'account_name',
                            name: 'account_name'
                        },
                        {
                            data: 'ref_no',
                            name: 'ref_no'
                        },
                        {
                            data: 'method',
                            name: 'TP.method'
                        },
                        {
                            data: 'credit',
                            name: 'amount'
                        },
                        // {data: 'balance', name: 'balance'},
                        // {data: 'total_balance', name: 'total_balance'},
                    ],
                    "fnDrawCallback": function(oSettings) {
                        __currency_convert_recursively($('#accouting_payments_recovered'));
                    },
                    "footerCallback": function(row, data, start, end, display) {
                        var footer_total_credit = 0;

                        for (var r in data) {
                            footer_total_credit += $(data[r].credit).data('orig-value') ? parseFloat($(
                                data[r].credit).data('orig-value')) : 0;
                        }
                        $('.footer_total_credit').html(__currency_trans_from_en(footer_total_credit));
                    }
                });
                $('#dashboard_location').change(function() {
                    accouting_payments_recovered.ajax.reload();
                });
            <?php endif; ?>
            
            <?php if(!empty($common_settings['enable_purchase_order'])): ?>
                //Purchase table
                purchase_order_table = $('#purchase_order_table').DataTable({
                    processing: true,
                    serverSide: true,
                    aaSorting: [
                        [1, 'desc']
                    ],
                    scrollY: "75vh",
                    scrollX: true,
                    scrollCollapse: true,
                    ajax: {
                        url: '<?php echo e(action([\App\Http\Controllers\PurchaseOrderController::class, 'index']), false); ?>',
                        data: function(d) {
                            d.from_dashboard = true;

                            if ($('#po_location').length > 0) {
                                d.location_id = $('#po_location').val();
                            }
                        },
                    },
                    columns: [{
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'transaction_date',
                            name: 'transaction_date'
                        },
                        {
                            data: 'ref_no',
                            name: 'ref_no'
                        },
                        {
                            data: 'location_name',
                            name: 'BS.name'
                        },
                        {
                            data: 'name',
                            name: 'contacts.name'
                        },
                        {
                            data: 'status',
                            name: 'transactions.status'
                        },
                        {
                            data: 'po_qty_remaining',
                            name: 'po_qty_remaining',
                            "searchable": false
                        },
                        {
                            data: 'added_by',
                            name: 'u.first_name'
                        }
                    ]
                })

                $('#po_location').change(function() {
                    purchase_order_table.ajax.reload();
                });
            <?php endif; ?>

            <?php if(!empty($common_settings['enable_purchase_requisition'])): ?>
                //Purchase table
                purchase_requisition_table = $('#purchase_requisition_table').DataTable({
                    processing: true,
                    serverSide: true,
                    aaSorting: [
                        [1, 'desc']
                    ],
                    scrollY: "75vh",
                    scrollX: true,
                    scrollCollapse: true,
                    ajax: {
                        url: '<?php echo e(action([\App\Http\Controllers\PurchaseRequisitionController::class, 'index']), false); ?>',
                        data: function(d) {
                            d.from_dashboard = true;

                            if ($('#pr_location').length > 0) {
                                d.location_id = $('#pr_location').val();
                            }
                        },
                    },
                    columns: [{
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'transaction_date',
                            name: 'transaction_date'
                        },
                        {
                            data: 'ref_no',
                            name: 'ref_no'
                        },
                        {
                            data: 'location_name',
                            name: 'BS.name'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'delivery_date',
                            name: 'delivery_date'
                        },
                        {
                            data: 'added_by',
                            name: 'u.first_name'
                        },
                    ]
                })

                $('#pr_location').change(function() {
                    purchase_requisition_table.ajax.reload();
                });

                $(document).on('click', 'a.delete-purchase-requisition', function(e) {
                    e.preventDefault();
                    swal({
                        title: LANG.sure,
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    }).then(willDelete => {
                        if (willDelete) {
                            var href = $(this).attr('href');
                            $.ajax({
                                method: 'DELETE',
                                url: href,
                                dataType: 'json',
                                success: function(result) {
                                    if (result.success == true) {
                                        toastr.success(result.msg);
                                        purchase_requisition_table.ajax.reload();
                                    } else {
                                        toastr.error(result.msg);
                                    }
                                },
                            });
                        }
                    });
                });
            <?php endif; ?>

            sell_table = $('#shipments_table').DataTable({
                processing: true,
                serverSide: true,
                aaSorting: [
                    [1, 'desc']
                ],
                scrollY: "75vh",
                scrollX: true,
                scrollCollapse: true,
                "ajax": {
                    "url": '<?php echo e(action([\App\Http\Controllers\SellController::class, 'index']), false); ?>',
                    "data": function(d) {
                        d.only_pending_shipments = true;
                        if ($('#pending_shipments_location').length > 0) {
                            d.location_id = $('#pending_shipments_location').val();
                        }
                    }
                },
                columns: [{
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'transaction_date',
                        name: 'transaction_date'
                    },
                    {
                        data: 'invoice_no',
                        name: 'invoice_no'
                    },
                    {
                        data: 'conatct_name',
                        name: 'conatct_name'
                    },
                    {
                        data: 'mobile',
                        name: 'contacts.mobile'
                    },
                    {
                        data: 'business_location',
                        name: 'bl.name'
                    },
                    {
                        data: 'shipping_status',
                        name: 'shipping_status'
                    },
                    <?php if(!empty($custom_labels['shipping']['custom_field_1'])): ?>
                        {
                            data: 'shipping_custom_field_1',
                            name: 'shipping_custom_field_1'
                        },
                    <?php endif; ?>
                    <?php if(!empty($custom_labels['shipping']['custom_field_2'])): ?>
                        {
                            data: 'shipping_custom_field_2',
                            name: 'shipping_custom_field_2'
                        },
                    <?php endif; ?>
                    <?php if(!empty($custom_labels['shipping']['custom_field_3'])): ?>
                        {
                            data: 'shipping_custom_field_3',
                            name: 'shipping_custom_field_3'
                        },
                    <?php endif; ?>
                    <?php if(!empty($custom_labels['shipping']['custom_field_4'])): ?>
                        {
                            data: 'shipping_custom_field_4',
                            name: 'shipping_custom_field_4'
                        },
                    <?php endif; ?>
                    <?php if(!empty($custom_labels['shipping']['custom_field_5'])): ?>
                        {
                            data: 'shipping_custom_field_5',
                            name: 'shipping_custom_field_5'
                        },
                    <?php endif; ?> {
                        data: 'payment_status',
                        name: 'payment_status'
                    },
                    {
                        data: 'waiter',
                        name: 'ss.first_name',
                        <?php if(empty($is_service_staff_enabled)): ?>
                            visible: false
                        <?php endif; ?>
                    }
                ],
                "fnDrawCallback": function(oSettings) {
                    __currency_convert_recursively($('#sell_table'));
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).find('td:eq(4)').attr('class', 'clickable_td');
                }
            });

            $('#pending_shipments_location').change(function() {
                sell_table.ajax.reload();
            });
        };

        // Auto-init orders section if visible on load, staggered after other sections
        $(document).ready(function() {
            if (typeof _isSectionVisible === 'function' && _isSectionVisible('orders')) {
                setTimeout(function() { _initSectionTables('orders'); }, 2400);
            }
        });
    </script>

    <script type="text/javascript">
        $(document).on('click', '.dashboard-kpi-link', function(e) {
            var href = $(this).attr('href');
            if (!href || href === '#') {
                return;
            }

            var url = new URL(href, window.location.origin);

            if ($('#dashboard_location').length && $('#dashboard_location').val()) {
                url.searchParams.set('location_id', $('#dashboard_location').val());
            }

            if ($('#dashboard_date_filter').length && $('#dashboard_date_filter').data('daterangepicker')) {
                url.searchParams.set('start_date', $('#dashboard_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD'));
                url.searchParams.set('end_date', $('#dashboard_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD'));
            }

            $(this).attr('href', url.toString());
        });
    </script>

    <!-- Advanced Analytics Charts Script -->
    <?php if(!$isDashboardItemDisabled('advanced_analytics')): ?>
        <script src="<?php echo e(asset('js/dashboard-analytics.js?v=' . $asset_v . '.' . filemtime(public_path('js/dashboard-analytics.js'))), false); ?>"></script>
    <?php endif; ?>

    
    <?php if(!$isDashboardItemDisabled('currency_rate') && !empty($dashboard_currencies) && $dashboard_currencies->count() > 0): ?>
    <script>
    $(document).ready(function() {
        // When dropdown changes, update the rate field
        $(document).on('change', '#dashboard_currency_select', function() {
            var selected = $(this).find(':selected');
            var multiplier = selected.data('multiplier') || '';
            $('#dashboard_currency_rate').val(multiplier);
        });

        // Refresh button click
        $(document).on('click', '#dashboard_refresh_rate', function() {
            var btn = $(this);
            var currencyCode = '';

            if ($('#dashboard_currency_select').length) {
                currencyCode = $('#dashboard_currency_select').val();
            } else {
                currencyCode = $('#dashboard_currency_select_single').val();
            }

            if (!currencyCode) {
                toastr.warning('No currency selected.');
                return;
            }

            btn.prop('disabled', true).find('i').addClass('fa-spin');

            $.ajax({
                url: '<?php echo e(route("get_exchange_rate_general"), false); ?>',
                type: 'GET',
                dataType: 'json',
                data: { currency_code: currencyCode },
                success: function(response) {
                    if (response.success) {
                        $('#dashboard_currency_rate').val(response.multiplier);
                        // Update the dropdown option's data-multiplier too
                        if ($('#dashboard_currency_select').length) {
                            $('#dashboard_currency_select').find('option[value="' + currencyCode + '"]').data('multiplier', response.multiplier);
                        }
                        toastr.success(currencyCode + ' rate updated: ' + response.multiplier);
                    } else {
                        toastr.error(response.msg || 'Failed to fetch exchange rate.');
                    }
                },
                error: function() {
                    toastr.error('Could not fetch exchange rate. Check your connection.');
                },
                complete: function() {
                    btn.prop('disabled', false).find('i').removeClass('fa-spin');
                }
            });
        });
    });
    </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>