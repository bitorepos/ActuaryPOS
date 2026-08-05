<!DOCTYPE html>
<?php $request = app('Illuminate\Http\Request'); ?>
<?php
    $user_settings = json_decode(auth()->user()->user_settings,true);
    $common_settings = session()->get('business.common_settings');  
    
?>
<?php if($request->segment(1) == 'pos' && ($request->segment(2) == 'create' || $request->segment(3) == 'edit'
 || $request->segment(2) == 'payment')): ?>
    <?php
    
        $pos_layout = true;
    ?>
<?php else: ?>
    <?php
        $pos_layout = false;
    ?>
<?php endif; ?>

<?php
    $is_customer_display = ($request->segment(1) == 'customer-display');
?>

<?php
    $whitelist = ['127.0.0.1', '::1'];
?>

<html lang="<?php echo e(app()->getLocale(), false); ?>" dir="<?php echo e(in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl')) ? 'rtl' : 'ltr', false); ?>">
    <head>
        <meta charset="utf-8">
        <!-- Restore dark mode instantly to prevent flash of light theme -->
        <script>
            (function(){
                var t = localStorage.getItem('theme');
                if(t === 'dark') document.documentElement.classList.add('dark-theme');
                else if(t === 'semi-dark') document.documentElement.classList.add('semi-dark');
                else if(t === 'minimal') document.documentElement.classList.add('minimal-theme');
            })();
        </script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">

        <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e(Session::get('business.name'), false); ?></title>
        
        <?php echo $__env->make('layouts.partials.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldContent('css'); ?>
        <style>
            #ps_product_stock_history_div .stock-summary-table,
            #product_stock_history .stock-summary-table { margin-bottom: 0 !important; }
            #ps_product_stock_history_div .stock-summary-table th,
            #ps_product_stock_history_div .stock-summary-table td,
            #product_stock_history .stock-summary-table th,
            #product_stock_history .stock-summary-table td { padding: 1px 5px !important; font-size: 13px; line-height: 1.2; }
        </style>
    </head>

    <?php
        $font_family_map = [
            'arial' => 'Arial, Helvetica, sans-serif',
            'verdana' => 'Verdana, Geneva, sans-serif',
            'tahoma' => 'Tahoma, Geneva, sans-serif',
            'trebuchet-ms' => '"Trebuchet MS", Helvetica, sans-serif',
            'georgia' => 'Georgia, "Times New Roman", serif',
            'times-new-roman' => '"Times New Roman", Times, serif',
            'courier-new' => '"Courier New", Courier, monospace',
            'roboto' => '"Roboto", sans-serif',
            'open-sans' => '"Open Sans", sans-serif',
            'lato' => '"Lato", sans-serif',
            'poppins' => '"Poppins", sans-serif',
            'nunito' => '"Nunito", sans-serif',
            'montserrat' => '"Montserrat", sans-serif',
            'inter' => '"Inter", sans-serif',
            'raleway' => '"Raleway", sans-serif',
            'ubuntu' => '"Ubuntu", sans-serif',
            'calibri' => 'Calibri, "Gill Sans", "Segoe UI", sans-serif',
        ];
        $user_font = $user_settings['font_style'] ?? 'poppins';
        if (empty($user_font) || $user_font === 'default') {
            $user_font = 'poppins';
        }
    ?>
    <body class="<?php if($pos_layout): ?> lockscreen <?php endif; ?> <?php if(!empty($user_settings['theme_color'])): ?> theme-<?php echo e($user_settings['theme_color'], false); ?> <?php endif; ?>" <?php if(!empty($user_font) && isset($font_family_map[$user_font])): ?> style="font-family: <?php echo e($font_family_map[$user_font], false); ?> !important;" <?php endif; ?>>

        <!--start wrapper-->
        <div class="wrapper" >
            <script>
            document.addEventListener("DOMContentLoaded", function () {

                // Sync dark mode icon with stored theme
                var storedTheme = localStorage.getItem('theme');
                var darkIcon = document.querySelector('.dark-mode-icon i');
                if (darkIcon && storedTheme === 'dark') {
                    darkIcon.className = 'bi bi-brightness-high-fill';
                }

                const wrapper = document.querySelector(".wrapper");
                const sidebar = document.querySelector(".sidebar-wrapper");
                const MOBILE_BREAKPOINT = 1024;

                function isMobileViewport() {
                    return window.innerWidth <= MOBILE_BREAKPOINT;
                }

                <?php if(!isMobile()): ?>
                    if (!isMobileViewport() && localStorage.getItem("upos_sidebar_collapse") === "true") {
                        wrapper.classList.add("toggled");
                    }
                <?php endif; ?>

                // On mobile, restore saved sidebar state
                if (isMobileViewport()) {
                    if (localStorage.getItem("upos_sidebar_open") === "true") {
                        wrapper.classList.add("toggled");
                        var overlay = document.querySelector(".sidebar-overlay");
                        if (overlay) overlay.style.display = "block";
                        document.body.classList.add("sidebar-open");
                        document.body.style.top = "-" + window.scrollY + "px";
                    } else {
                        wrapper.classList.remove("toggled");
                    }
                    wrapper.classList.remove("sidebar-hovered");
                }

                if(sidebar){
                    // Hover behaviour — desktop only (non-touch)
                    sidebar.addEventListener("mouseenter", () => {
                        if (!isMobileViewport()) {
                            wrapper.classList.add("sidebar-hovered");
                        }
                    });

                    sidebar.addEventListener("mouseleave", () => {
                        if (!isMobileViewport()) {
                            wrapper.classList.remove("sidebar-hovered");
                        }
                    });
                }

            });
            </script>
            <?php if(!$pos_layout && !$is_customer_display): ?>
                <?php echo $__env->make('layouts.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('layouts.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
                <div class="sidebar-overlay" style="display:none;"></div>
            <?php elseif(!$is_customer_display): ?>
                <?php echo $__env->make('layouts.partials.header-pos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)): ?>
                <input type="hidden" id="__is_localhost" value="true">
            <?php endif; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="<?php if(!$pos_layout): ?> content-wrapper <?php else: ?> pos-content-wrapper <?php endif; ?>" <?php if($pos_layout): ?> style="height: 100vh;" <?php endif; ?> >
                <!-- empty div for vuejs -->
                <div id="app">
                    <?php echo $__env->yieldContent('vue'); ?>
                </div>
                <!-- Add currency related field-->
                <input type="hidden" id="__code" value="<?php echo e(session('currency')['code'], false); ?>">
                <input type="hidden" id="__symbol" value="<?php echo e(session('currency')['symbol'], false); ?>">
                <input type="hidden" id="__thousand" value="<?php echo e(session('currency')['thousand_separator'], false); ?>">
                <input type="hidden" id="__decimal" value="<?php echo e(session('currency')['decimal_separator'], false); ?>">
                <input type="hidden" id="__symbol_placement" value="<?php echo e(session('business.currency_symbol_placement'), false); ?>">
                <input type="hidden" id="__precision" value="<?php echo e(session('business.currency_precision', 2), false); ?>">
                <input type="hidden" id="__quantity_precision" value="<?php echo e(session('business.quantity_precision', 2), false); ?>">
                <input type="hidden" id="__cost_decimal" value="<?php echo e(session('business.cost_decimal', 2), false); ?>">
                <input type="hidden" id="__discount_precision" value="<?php echo e(session('business.discount_precision', 2), false); ?>">
                <!-- End of currency related field-->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_export_buttons')): ?>
                    <input type="hidden" id="view_export_buttons">
                <?php endif; ?>
                <?php if(isMobile()): ?>
                    <input type="hidden" id="__is_mobile">
                <?php endif; ?>
                <?php if(session('status')): ?>
                    <input type="hidden" id="status_span" data-status="<?php echo e(session('status.success'), false); ?>" data-msg="<?php echo e(session('status.msg'), false); ?>" data-fbr_msg="<?php echo e(session('status.fbr_msg'), false); ?>">
                    <?php if(!empty(session('status.open_modal'))): ?>
                    <input type="hidden" id="open_modal_span" data-for="<?php echo e(session('status.open_modal.for'), false); ?>" data-id="<?php echo e(session('status.open_modal.id'), false); ?>" data-fbr_msg="<?php echo e(session('status.fbr_msg'), false); ?>"
                        data-print="<?php echo e(session('status.open_modal.print'), false); ?>" data-auto_print="<?php echo e(session('status.open_modal.auto_print'), false); ?>" data-print_out="<?php echo e(session('status.open_modal.print_out'), false); ?>" data-from_pos="<?php echo e(session('status.open_modal.from_pos'), false); ?>" data-invoice_layout_id="<?php echo e(session('status.open_modal.invoice_layout_id'), false); ?>">
                    <?php endif; ?>
                <?php endif; ?>
                <?php echo $__env->yieldContent('content'); ?>

                <div class='scrolltop no-print'>
                    <div class='scroll icon'><i class="fas fa-angle-up"></i></div>
                </div>

                <?php if(config('constants.iraqi_selling_price_adjustment')): ?>
                    <input type="hidden" id="iraqi_selling_price_adjustment">
                <?php endif; ?>

                <!-- This will be printed -->
                <section class="invoice print_section" id="receipt_section">
                </section>
                
            </div>
            <?php echo $__env->make('home.todays_profit_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- /.content-wrapper -->

            <?php if(!$pos_layout): ?>
                <?php echo $__env->make('layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                
            <?php endif; ?>

            <audio id="success-audio">
              <source src="<?php echo e(asset('/audio/success.ogg?v=' . $asset_v), false); ?>" type="audio/ogg">
              <source src="<?php echo e(asset('/audio/success.mp3?v=' . $asset_v), false); ?>" type="audio/mpeg">
            </audio>
            <audio id="error-audio">
              <source src="<?php echo e(asset('/audio/error.ogg?v=' . $asset_v), false); ?>" type="audio/ogg">
              <source src="<?php echo e(asset('/audio/error.mp3?v=' . $asset_v), false); ?>" type="audio/mpeg">
            </audio>
            <audio id="warning-audio">
              <source src="<?php echo e(asset('/audio/warning.ogg?v=' . $asset_v), false); ?>" type="audio/ogg">
              <source src="<?php echo e(asset('/audio/warning.mp3?v=' . $asset_v), false); ?>" type="audio/mpeg">
            </audio>

        </div>
        <!--end wrapper-->

        <?php if(!empty($__additional_html)): ?>
            <?php echo $__additional_html; ?>

        <?php endif; ?>

        <?php echo $__env->make('layouts.partials.javascripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldContent('modals'); ?>

        <?php echo $__env->make('product.partials.camera_capture_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>
        <div class="modal fade" id="products_search_modal" tabindex="-1" data-bs-focus="false" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
        <div class="modal fade" id="product_qty_detail_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
        <div class="modal fade search_contact_payment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
        <div class="modal fade pay_contact_due_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" style=""></div>
        <div class="modal fade pay_contact_deposit_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
        <div class="modal fade" id="edit_advance_deposit_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
        <?php echo $__env->make('product.partials.product_history_detail_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="modal fade view_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
        <div class="modal fade print_view_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id='print_modal_section'></div>
            </div>
        </div>
        <div class="modal fade payment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
        <div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>

        <!-- Booking Due Notification Modal -->
        <div class="modal fade" id="booking_notification_modal" tabindex="-1" role="dialog" aria-labelledby="bookingNotificationLabel" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h4 class="modal-title" id="bookingNotificationLabel">
                            <i class="fa fa-bell"></i> <?php echo app('translator')->get('restaurant.booking_due_notification'); ?>
                        </h4>
                    </div>
                    <div class="modal-body" id="booking_notification_body">
                    </div>
                </div>
            </div>
        </div>
        
        <?php if(!empty($__additional_views) && is_array($__additional_views)): ?>
            <?php $__currentLoopData = $__additional_views; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additional_view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if ($__env->exists($additional_view)) echo $__env->make($additional_view, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </body>

</html>
