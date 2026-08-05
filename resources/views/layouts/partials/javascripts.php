<script type="text/javascript">
    base_path = "<?php echo e(url('/'), false); ?>";
    //used for push notification
    APP = {};
    APP.PUSHER_APP_KEY = '<?php echo e(config('broadcasting.connections.pusher.key'), false); ?>';
    APP.PUSHER_APP_CLUSTER = '<?php echo e(config('broadcasting.connections.pusher.options.cluster'), false); ?>';
    APP.INVOICE_SCHEME_SEPARATOR = '<?php echo e(config('constants.invoice_scheme_separator'), false); ?>';
    //variable from app service provider
    APP.PUSHER_ENABLED = '<?php echo e($__is_pusher_enabled, false); ?>';
    <?php if(auth()->guard()->check()): ?>
        <?php
            $user = Auth::user();
            $drawer_user_settings = $user->user_settings;
            if (is_string($drawer_user_settings)) {
                $drawer_user_settings = json_decode($drawer_user_settings, true) ?: [];
            }
            if (!is_array($drawer_user_settings)) {
                $drawer_user_settings = [];
            }
        ?>
        APP.USER_ID = "<?php echo e($user->id, false); ?>";
        APP.USER_SETTINGS = {
            allow_open_cash_drawer: <?php echo e(!empty($drawer_user_settings['allow_open_cash_drawer']) ? 1 : 0, false); ?>

        };
    <?php else: ?>
        APP.USER_ID = '';
        APP.USER_SETTINGS = {};
    <?php endif; ?>
</script>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js?v=$asset_v"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js?v=$asset_v"></script>
<![endif]-->
<script src="<?php echo e(asset('js/vendor.js?v=' . $asset_v), false); ?>"></script>

<?php if(file_exists(public_path('js/lang/' . session()->get('user.language', config('app.locale')) . '.js'))): ?>
    <script src="<?php echo e(asset('js/lang/' . session()->get('user.language', config('app.locale') ) . '.js?v=' . $asset_v), false); ?>"></script>
<?php else: ?>
    <script src="<?php echo e(asset('js/lang/en.js?v=' . $asset_v), false); ?>"></script>
<?php endif; ?>
<?php
    $business_date_format = session('business.date_format', config('constants.default_date_format'));
    $datepicker_date_format = str_replace('d', 'dd', $business_date_format);
    $datepicker_date_format = str_replace('m', 'mm', $datepicker_date_format);
    $datepicker_date_format = str_replace('Y', 'yyyy', $datepicker_date_format);

    $moment_date_format = str_replace('d', 'DD', $business_date_format);
    $moment_date_format = str_replace('m', 'MM', $moment_date_format);
    $moment_date_format = str_replace('Y', 'YYYY', $moment_date_format);

    $business_time_format = session('business.time_format');
    $moment_time_format = 'HH:mm';
    if($business_time_format == 12){
        $moment_time_format = 'hh:mm A';
    }

    $common_settings = !empty(session('business.common_settings')) ? session('business.common_settings') : [];

    $default_datatable_page_entries = !empty($common_settings['default_datatable_page_entries']) ? $common_settings['default_datatable_page_entries'] : 25;
?>

<script>
    Dropzone.autoDiscover = false;
    var __appBaseUrl = <?php echo json_encode(url('/')); ?>;
    moment.tz.setDefault('<?php echo e(Session::get("business.time_zone"), false); ?>');
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Toastr global options
        toastr.options.closeButton = true;
        toastr.options.timeOut = 3000;
        toastr.options.extendedTimeOut = 1500;
        toastr.options.progressBar = true;
        toastr.options.closeDuration = 300;
        toastr.options.toastClass = 'toastr-toast';
        
        <?php if(config('app.debug') == false): ?>
            $.fn.dataTable.ext.errMode = 'throw';
        <?php endif; ?>
    });
    
    var financial_year = {
        start: moment('<?php echo e(Session::get("financial_year.start"), false); ?>'),
        end: moment('<?php echo e(Session::get("financial_year.end"), false); ?>'),
    }
    var business_start_date = moment('<?php echo e(Session::get("business.start_date"), false); ?>');

    <?php if(file_exists(public_path('AdminLTE/plugins/select2/lang/' . session()->get('user.language', config('app.locale')) . '.js'))): ?>
    //Default setting for select2
    $.fn.select2.defaults.set("language", "<?php echo e(session()->get('user.language', config('app.locale')), false); ?>");
    <?php endif; ?>

    var datepicker_date_format = "<?php echo e($datepicker_date_format, false); ?>";
    var moment_date_format = "<?php echo e($moment_date_format, false); ?>";
    var moment_time_format = "<?php echo e($moment_time_format, false); ?>";
    var report_filters = [];

    var app_locale = "<?php echo e(session()->get('user.language', config('app.locale')), false); ?>";

    var non_utf8_languages = [
        <?php $__currentLoopData = config('constants.non_utf8_languages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $const): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        "<?php echo e($const, false); ?>",
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    ];

    var __default_datatable_page_entries = "<?php echo e($default_datatable_page_entries, false); ?>";

    var __new_notification_count_interval = "<?php echo e(config('constants.new_notification_count_interval', 60), false); ?>000";
    var __background_sale_sync_interval = "<?php echo e(config('constants.background_sale_sync_interval', 10) * 60000, false); ?>";
    var __background_setting_sync_interval = "<?php echo e(config('constants.background_setting_sync_interval', 32) * 60000, false); ?>";

</script>

<script src="<?php echo e(asset('onedash/js/bootstrap.bundle.min.js'), false); ?>"></script>
<!-- OneDash plugins -->
<script src="<?php echo e(asset('onedash/plugins/simplebar/js/simplebar.min.js'), false); ?>"></script>
<script src="<?php echo e(asset('onedash/plugins/metismenu/js/metisMenu.min.js'), false); ?>"></script>
<script src="<?php echo e(asset('onedash/plugins/perfect-scrollbar/js/perfect-scrollbar.js'), false); ?>"></script>
<script src="<?php echo e(asset('onedash/js/pace.min.js'), false); ?>"></script>
<!-- OneDash app (sidebar toggle, dark mode, etc.) -->
<script src="<?php echo e(asset('onedash/js/app.js'), false); ?>"></script>
<script src="<?php echo e(asset('js/functions.js?v=' . $asset_v . '.' . filemtime(public_path('js/functions.js'))), false); ?>"></script>
<script src="<?php echo e(asset('js/common.js?v=' . $asset_v . '.' . filemtime(public_path('js/common.js'))), false); ?>"></script>
<script src="<?php echo e(asset('js/app.js?v=' . $asset_v . '.' . filemtime(public_path('js/app.js'))), false); ?>"></script>
<script src="<?php echo e(asset('js/workstation_print.js?v=' . $asset_v), false); ?>"></script>
<script src="<?php echo e(asset('js/local_transaction_backup_bridge.js?v=' . $asset_v . '.' . filemtime(public_path('js/local_transaction_backup_bridge.js'))), false); ?>"></script>
<script src="<?php echo e(asset('js/help-tour.js?v=' . $asset_v), false); ?>"></script>
<script src="<?php echo e(asset('js/documents_and_note.js?v=' . $asset_v), false); ?>"></script>
<script>
    window.loadXlsxLibrary = window.loadXlsxLibrary || function () {
        if (window.XLSX) {
            return Promise.resolve(window.XLSX);
        }

        if (window.__xlsxLoaderPromise) {
            return window.__xlsxLoaderPromise;
        }

        window.__xlsxLoaderPromise = new Promise(function (resolve, reject) {
            var script = document.createElement('script');
            script.src = "<?php echo e(asset('vendor/xlsx/xlsx.full.min.js?v=' . $asset_v), false); ?>";
            script.onload = function () {
                resolve(window.XLSX);
            };
            script.onerror = function () {
                reject(new Error('Failed to load XLSX library.'));
            };
            document.body.appendChild(script);
        });

        return window.__xlsxLoaderPromise;
    };
</script>


<!-- TODO -->
<?php if(file_exists(public_path('AdminLTE/plugins/select2/lang/' . session()->get('user.language', config('app.locale')) . '.js'))): ?>
    <script src="<?php echo e(asset('AdminLTE/plugins/select2/lang/' . session()->get('user.language', config('app.locale') ) . '.js?v=' . $asset_v), false); ?>"></script>
<?php endif; ?>
<?php
    $validation_lang_file = 'messages_' . session()->get('user.language', config('app.locale') ) . '.js';
?>
<?php if(file_exists(public_path() . '/js/jquery-validation-1.16.0/src/localization/' . $validation_lang_file)): ?>
    <script src="<?php echo e(asset('js/jquery-validation-1.16.0/src/localization/' . $validation_lang_file . '?v=' . $asset_v), false); ?>"></script>
<?php endif; ?>

<?php if(!empty($__system_settings['additional_js'])): ?>
    <?php echo $__system_settings['additional_js']; ?>

<?php endif; ?>
<?php echo $__env->yieldContent('javascript'); ?>

<?php if(Module::has('Essentials')): ?>
  <?php if ($__env->exists('essentials::layouts.partials.footer_part')) echo $__env->make('essentials::layouts.partials.footer_part', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready( function(){
        var locale = "<?php echo e(session()->get('user.language', config('app.locale')), false); ?>";
        var isRTL = <?php if(in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl'))): ?> true; <?php else: ?> false; <?php endif; ?>

        $('#calendar').fullCalendar('option', {
            locale: locale,
            isRTL: isRTL
        });
    });
</script>

<?php if(auth()->user() && in_array('booking', session('business.enabled_modules', [])) && (auth()->user()->can('crud_all_bookings') || auth()->user()->can('crud_own_bookings'))): ?>
<script type="text/javascript">
$(document).ready(function(){
    var bookingCheckInterval = 60000; // Check every 60 seconds

    function checkDueBookings() {
        $.ajax({
            url: '/bookings/get-due-bookings',
            method: 'GET',
            dataType: 'json',
            success: function(bookings) {
                if (bookings.length > 0) {
                    var html = '';
                    $.each(bookings, function(i, booking) {
                        html += '<div class="card mb-3 border-warning" data-booking-id="' + booking.id + '">';
                        html += '<div class="card-body">';
                        html += '<div class="row">';
                        html += '<div class="col-sm-6">';
                        html += '<strong><?php echo app('translator')->get("contact.customer"); ?>:</strong> ' + booking.customer + '<br>';
                        html += '<strong><?php echo app('translator')->get("restaurant.service_staff"); ?>:</strong> ' + booking.waiter + '<br>';
                        html += '<strong><?php echo app('translator')->get("restaurant.correspondent"); ?>:</strong> ' + booking.correspondent + '<br>';
                        if (booking.booking_note) {
                            html += '<strong><?php echo app('translator')->get("restaurant.customer_note"); ?>:</strong> ' + booking.booking_note;
                        }
                        html += '</div>';
                        html += '<div class="col-sm-6">';
                        html += '<strong><?php echo app('translator')->get("messages.location"); ?>:</strong> ' + booking.location + '<br>';
                        html += '<strong><?php echo app('translator')->get("restaurant.table"); ?>:</strong> ' + booking.table + '<br>';
                        html += '<strong><?php echo app('translator')->get("restaurant.booking_starts"); ?>:</strong> ' + booking.booking_start + '<br>';
                        html += '<strong><?php echo app('translator')->get("restaurant.booking_ends"); ?>:</strong> ' + booking.booking_end;
                        html += '</div>';
                        html += '</div>';
                        html += '<hr>';
                        html += '<div class="text-end">';
                        html += '<button class="btn btn-primary btn-sm btn-edit-due-booking" data-href="' + booking.edit_url + '"><i class="fa fa-pencil"></i> <?php echo app('translator')->get("restaurant.edit_booking"); ?></button> ';
                        html += '<button class="btn btn-warning btn-sm btn-snooze-booking" data-booking-id="' + booking.id + '"><i class="fa fa-clock-o"></i> <?php echo app('translator')->get("restaurant.snooze_10_min"); ?></button> ';
                        html += '<button class="btn btn-default btn-sm btn-dismiss-booking" data-booking-id="' + booking.id + '"><i class="fa fa-times"></i> <?php echo app('translator')->get("messages.close"); ?></button>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                    });

                    $('#booking_notification_body').html(html);
                    if (!$('#booking_notification_modal').hasClass('show')) {
                        $('#booking_notification_modal').modal('show');
                    }
                }
            }
        });
    }

    // Initial check after 5 seconds
    setTimeout(checkDueBookings, 5000);
    // Then check every 60 seconds
    setInterval(checkDueBookings, bookingCheckInterval);

    // Edit booking from notification
    $(document).on('click', '.btn-edit-due-booking', function() {
        var href = $(this).data('href');
        $('#booking_notification_modal').modal('hide');
        $.ajax({
            url: href,
            dataType: 'html',
            success: function(result) {
                $('div.view_modal').html(result);
                $('div.view_modal').one('shown.bs.modal', function() {
                    $('#edit_start_time').datetimepicker({
                        format: moment_date_format + ' ' + moment_time_format,
                        ignoreReadonly: true
                    });
                    $('#edit_end_time').datetimepicker({
                        format: moment_date_format + ' ' + moment_time_format,
                        ignoreReadonly: true
                    });
                });
                $('div.view_modal').modal('show');
            }
        });
    });

    // Reload tables/waiters when location changes in edit booking modal
    $(document).on('change', '#edit_booking_location_id', function() {
        var locationId = $(this).val();
        if (locationId) {
            $.ajax({
                method: 'GET',
                url: '/modules/data/get-pos-details',
                data: { location_id: locationId },
                dataType: 'html',
                success: function(result) {
                    $('div#edit_restaurant_module_span').html(result);
                }
            });
        } else {
            $('div#edit_restaurant_module_span').html('');
        }
    });

    // Edit booking form submit via AJAX (from notification modal on any page)
    $(document).on('submit', 'form#edit_booking_details_form', function(e) {
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();
        $.ajax({
            method: 'POST',
            url: form.attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success == 1) {
                    toastr.success(result.msg);
                    $('div.view_modal').modal('hide');
                } else {
                    toastr.error(result.msg);
                }
            },
            error: function() {
                toastr.error('<?php echo app('translator')->get("messages.something_went_wrong"); ?>');
            }
        });
    });

    // Snooze booking for 10 minutes
    $(document).on('click', '.btn-snooze-booking', function() {
        var bookingId = $(this).data('booking-id');
        var $card = $(this).closest('.card[data-booking-id]');
        $.ajax({
            url: '/bookings/snooze',
            method: 'POST',
            data: {
                booking_id: bookingId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function() {
                $card.fadeOut(300, function() {
                    $(this).remove();
                    if ($('#booking_notification_body .card').length === 0) {
                        $('#booking_notification_modal').modal('hide');
                    }
                });
                toastr.info('<?php echo app('translator')->get("restaurant.booking_snoozed"); ?>');
            }
        });
    });

    // Dismiss/close booking notification
    $(document).on('click', '.btn-dismiss-booking', function() {
        var bookingId = $(this).data('booking-id');
        var $card = $(this).closest('.card[data-booking-id]');
        $.ajax({
            url: '/bookings/dismiss',
            method: 'POST',
            data: {
                booking_id: bookingId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function() {
                $card.fadeOut(300, function() {
                    $(this).remove();
                    if ($('#booking_notification_body .card').length === 0) {
                        $('#booking_notification_modal').modal('hide');
                    }
                });
            }
        });
    });

    // Sell booking form - load tables when location changes
    $(document).on('change', '#sell_booking_location_id', function() {
        var locationId = $(this).val();
        if (locationId) {
            $.ajax({
                url: '/modules/data/get-pos-details',
                method: 'GET',
                data: { location_id: locationId },
                dataType: 'html',
                success: function(result) {
                    $('#sell_booking_table_span').html(result);
                }
            });
        } else {
            $('#sell_booking_table_span').html('');
        }
    });

    // Sell booking form submit
    $(document).on('submit', 'form#sell_booking_form', function(e) {
        e.preventDefault();
        var form = $(this);

        // Client-side validation for required fields
        var startTime = $('#sell_booking_start_time').val();
        var endTime = $('#sell_booking_end_time').val();
        var locationId = $('#sell_booking_location_id').val();

        if (!locationId) {
            toastr.warning('<?php echo app('translator')->get("validation.required", ["attribute" => __("purchase.business_location")]); ?>');
            return;
        }
        if (!startTime) {
            toastr.warning('<?php echo app('translator')->get("validation.required", ["attribute" => __("restaurant.start_time")]); ?>');
            return;
        }
        if (!endTime) {
            toastr.warning('<?php echo app('translator')->get("validation.required", ["attribute" => __("restaurant.end_time")]); ?>');
            return;
        }

        var data = form.serialize();
        $.ajax({
            method: 'POST',
            url: form.attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success == 1) {
                    toastr.success(result.msg);
                    // Modal hide will trigger redirect via hidden.bs.modal handler
                    $('div.view_modal').modal('hide');
                } else {
                    toastr.error(result.msg);
                }
            },
            error: function(xhr) {
                if (xhr.status == 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, messages) {
                        toastr.error(messages[0]);
                    });
                } else {
                    toastr.error('<?php echo app('translator')->get("messages.something_went_wrong"); ?>');
                }
            }
        });
    });

    // Redirect after sell booking modal is closed (saved, skipped, or X button)
    $(document).on('hidden.bs.modal', 'div.view_modal', function() {
        $(this).removeClass('modal-stacked');
        var redirectUrl = $(this).data('booking-redirect-url');
        if (redirectUrl) {
            $(this).removeData('booking-redirect-url');
            window.location = redirectUrl;
        }
    });
});
</script>
<?php endif; ?>
