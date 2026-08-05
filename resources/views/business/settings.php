
<?php $__env->startSection('title', __('business.business_settings')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('business.business_settings'); ?></h1>
    <br>
    <?php echo $__env->make('layouts.partials.search_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>

<style>
    .settings-section-card {
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        margin-bottom: 25px;
        background: #fff;
    }
    .settings-section-card .settings-section-header {
        padding: 12px 18px;
        border-bottom: 1px solid #e0e0e0;
        background: #f7f9fb;
        border-radius: 4px 4px 0 0;
    }
    .settings-section-card .settings-section-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
    }
    .settings-section-card .settings-section-header .settings-section-subtitle {
        display: block;
        margin-top: 4px;
        font-size: 12px;
        font-weight: normal;
        color: #6c757d;
    }
    .settings-section-card .settings-section-body {
        padding: 12px;
    }
</style>

<!-- Main content -->
<section class="content">

<?php
    $__loc_count = isset($business_locations) ? count($business_locations) : 0;
    $__active_loc = isset($active_settings_location) ? (int) $active_settings_location : (int) ($default_location ?? 0);
?>

<?php echo Form::open(['url' => action([\App\Http\Controllers\BusinessController::class, 'postBusinessSettings']), 'method' => 'post', 'id' => 'bussiness_edit_form',
           'files' => true ]); ?>

<?php echo Form::hidden('active_settings_location', $__active_loc); ?>

    <div class="container-fluid">

        
        
        
        
        <div class="settings-section-card global-settings-section">
            <div class="settings-section-header">
                <h3>
                    <i class="fa fa-globe"></i>
                    <?php echo app('translator')->get('lang_v1.global_settings', [], 'Global Settings'); ?>
                    <small class="settings-section-subtitle">
                        <?php echo app('translator')->get('lang_v1.global_settings_help', [], 'These settings apply business-wide across every location.'); ?>
                    </small>
                </h3>
            </div>
            <div class="settings-section-body">
                <div class="row pos-tab-container">
                    <div class="col-2 pos-tab-menu">
                        <div class="list-group">
                            <a href="#" class="list-group-item text-center active"><?php echo app('translator')->get('business.business'); ?></a>
                            <a href="#" class="list-group-item text-center <?php if(!in_array('products', $enabled_modules)): ?> hide <?php endif; ?>"><?php echo app('translator')->get('business.product'); ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('business.dashboard'); ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('business.system'); ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('lang_v1.sms_settings'); ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('lang_v1.modules'); ?></a>
                        </div>
                    </div>
                    <div class="col-10 pos-tab">
                        <?php echo $__env->make('business.partials.settings_business', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('business.partials.settings_product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('business.partials.settings_dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('business.partials.settings_system', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('business.partials.settings_sms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('business.partials.settings_modules', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>

        
        
        
        
        <div class="settings-section-card location-settings-section">
            <div class="settings-section-header">
                <h3>
                    <i class="fa fa-map-marker"></i>
                    <?php echo app('translator')->get('lang_v1.location_based_settings', [], 'Location-based Settings'); ?>
                    <small class="settings-section-subtitle">
                        <?php echo app('translator')->get('lang_v1.location_based_settings_help', [], 'Settings shown below apply to the selected location only. Global defaults are taken from your primary location.'); ?>
                    </small>
                </h3>
            </div>
            <div class="settings-section-body">
                <?php if($__loc_count > 1): ?>
                    
                    <div class="row" style="align-items:center; margin-bottom:15px; padding:10px 5px; background:#fafbfc; border-radius:4px;">
                        <div class="col-md-7">
                            <label class="col-form-label" style="font-weight:600; margin-right:10px;">
                                <?php echo app('translator')->get('business.business_location'); ?>:
                            </label>
                            <?php echo Form::select('active_settings_location_picker', $business_locations, $__active_loc, [
                                'class' => 'selectpicker',
                                'data-live-search' => 'true',
                                'id' => 'active_settings_location_select',
                                'style' => 'min-width:260px;',
                            ]); ?>

                        </div>
                        <div class="col-md-5 text-right">
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#copy_loc_settings_modal">
                                <i class="fa fa-copy"></i>
                                <?php echo app('translator')->get('lang_v1.copy_settings_from_another_location', [], 'Copy settings from another location'); ?>
                            </button>
                        </div>
                    </div>

                    
                    <div class="modal fade" id="copy_loc_settings_modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">
                                        <?php echo app('translator')->get('lang_v1.copy_settings_from_another_location', [], 'Copy settings from another location'); ?>
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('lang_v1.from_location', [], 'Copy from location'); ?> *</label>
                                        <?php echo Form::select('from_location_id', $business_locations, null, [
                                            'class' => 'form-control selectpicker',
                                            'data-live-search' => 'true',
                                            'form' => 'copy_loc_settings_form',
                                            'required' => 'required',
                                            'placeholder' => __('messages.please_select'),
                                        ]); ?>

                                    </div>
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('lang_v1.to_location', [], 'Copy to location'); ?> *</label>
                                        <?php echo Form::select('to_location_id', $business_locations, $__active_loc, [
                                            'class' => 'form-control selectpicker',
                                            'data-live-search' => 'true',
                                            'form' => 'copy_loc_settings_form',
                                            'required' => 'required',
                                            'placeholder' => __('messages.please_select'),
                                        ]); ?>

                                    </div>
                                    <p class="help-block text-warning">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        <?php echo app('translator')->get('lang_v1.copy_settings_warning', [], 'This will overwrite the destination location\'s per-location settings. Global settings (timezone, currency, modules, etc.) are unaffected.'); ?>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                                    <button type="submit" form="copy_loc_settings_form" class="btn btn-primary"><?php echo app('translator')->get('messages.copy', [], 'Copy'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row pos-tab-container">
                    <div class="col-2 pos-tab-menu">
                        <div class="list-group">
                            <a href="#" class="list-group-item text-center active"><?php echo app('translator')->get('business.tax'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.business_tax') . '"></i>';
                }
            ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('contact.contact'); ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('contact.expenses'); ?></a>
                            <a href="#" class="list-group-item text-center <?php if(!in_array('add_sale', $enabled_modules)): ?> hide <?php endif; ?>"><?php echo app('translator')->get('business.sale'); ?></a>
                            <a href="#" class="list-group-item text-center <?php if(!in_array('pos_sale', $enabled_modules)): ?> hide <?php endif; ?>"><?php echo app('translator')->get('sale.pos_sale'); ?></a>
                            <a href="#" class="list-group-item text-center <?php if(!in_array('pos_sale', $enabled_modules)): ?> hide <?php endif; ?>"><?php echo app('translator')->get('lang_v1.display_screen'); ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('lang_v1.payment'); ?></a>
                            <a href="#" class="list-group-item text-center <?php if(!in_array('purchases', $enabled_modules)): ?> hide <?php endif; ?>"><?php echo app('translator')->get('purchase.purchases'); ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('lang_v1.stock_transfer'); ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('lang_v1.date_range'); ?></a>
                            <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('lang_v1.reward_point_settings'); ?></a>
                        </div>
                    </div>
                    <div class="col-10 pos-tab">
                        <?php echo $__env->make('business.partials.settings_tax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('business.partials.settings_contact', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('business.partials.settings_expenses', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('business.partials.settings_sales', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('business.partials.settings_pos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('business.partials.settings_display_pos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('business.partials.settings_payment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('business.partials.settings_purchase', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('business.partials.settings_stock_transfer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('business.partials.settings_date', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('business.partials.settings_reward_point', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="business-settings-footer-actions-template" class="d-none">
        <button class="btn btn-primary" type="submit" form="bussiness_edit_form"><i class="fas fa-cog"></i> <?php echo app('translator')->get('business.update_settings'); ?></button>
    </div>
<?php echo Form::close(); ?>

<?php echo Form::open([
    'url' => action([\App\Http\Controllers\BusinessController::class, 'copyLocationSettings']),
    'method' => 'post',
    'id' => 'copy_loc_settings_form'
]); ?>

<?php echo Form::close(); ?>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    // Ensure each tab-container has its first pane active on load. The
    // Global section's first partial (settings_business) hardcodes
    // `.pos-tab-content.active`, but the Location-based section's first
    // partial (settings_tax) does not — apply active to the first pane in
    // any container that has none.
    $(function () {
        $('.pos-tab-container').each(function () {
            var $tab = $(this).find('div.pos-tab');
            if ($tab.find('> div.pos-tab-content.active').length === 0) {
                $tab.find('> div.pos-tab-content').first().addClass('active');
            }
        });
    });

    $(document).on('change', '#active_settings_location_select', function () {
        var locationId = $(this).val();
        $('input[name="active_settings_location"]').val(locationId);

        var $form = $('<form>', {
            method: 'POST',
            action: "<?php echo e(action([\App\Http\Controllers\BusinessController::class, 'setActiveSettingsLocation']), false); ?>"
        });

        $form.append($('<input>', {
            type: 'hidden',
            name: '_token',
            value: "<?php echo e(csrf_token(), false); ?>"
        }));

        $form.append($('<input>', {
            type: 'hidden',
            name: 'location_id',
            value: locationId
        }));

        $('body').append($form);
        window.onbeforeunload = null;
        $form[0].submit();
    });

    if ($('#dashboard_filter_date_range').length && !$('#dashboard_filter_date_range').is('select')) {
        $('#dashboard_filter_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#dashboard_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            }
        );
        $('#dashboard_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#dashboard_filter_date_range').val('');
        });
    }

    $('#manufacturing_filter_date_range').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#manufacturing_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
        }
    );
    $('#manufacturing_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#manufacturing_filter_date_range').val('');
    });

    if ($('#purchase_filter_date_range').length && !$('#purchase_filter_date_range').is('select')) {
        $('#purchase_filter_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#purchase_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            }
        );
        $('#purchase_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#purchase_filter_date_range').val('');
        });
    }

    $('#sale_filter_date_range').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#sale_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
        }
    );
    $('#sale_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#sale_filter_date_range').val('');
    });

    if ($('#expense_filter_date_range').length && !$('#expense_filter_date_range').is('select')) {
        $('#expense_filter_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#expense_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            }
        );
        $('#expense_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#expense_filter_date_range').val('');
        });
    }

    if ($('#accounting_filter_date_range').length && !$('#accounting_filter_date_range').is('select')) {
        $('#accounting_filter_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#accounting_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            }
        );
        $('#accounting_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#accounting_filter_date_range').val('');
        });
    }

    if ($('#reports_filter_date_range').length && !$('#reports_filter_date_range').is('select')) {
        $('#reports_filter_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#reports_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            }
        );
        $('#reports_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#reports_filter_date_range').val('');
        });
    }

    $('#crm_filter_date_range').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#crm_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
        }
    );
    $('#crm_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#crm_filter_date_range').val('');
    });

    if ($('#installments_filter_date_range').length && !$('#installments_filter_date_range').is('select')) {
        $('#installments_filter_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#installments_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            }
        );
        $('#installments_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#installments_filter_date_range').val('');
        });
    }

    if ($('#hrm_filter_date_range').length && !$('#hrm_filter_date_range').is('select')) {
        $('#hrm_filter_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#hrm_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            }
        );
        $('#hrm_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#hrm_filter_date_range').val('');
        });
    }

    if ($('#essentials_filter_date_range').length && !$('#essentials_filter_date_range').is('select')) {
        $('#essentials_filter_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#essentials_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            }
        );
        $('#essentials_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#essentials_filter_date_range').val('');
        });
    }

    $('#field_force_filter_date_range').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#field_force_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
        }
    );
    $('#field_force_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#field_force_filter_date_range').val('');
    });

    __page_leave_confirmation('#bussiness_edit_form');

     $(document).on('change', '#enable_lot_number', function() {
        if ($('#enable_lot_number').is(':checked')) {
            $('.lot_number_section').removeClass('hide');
        } else {
            $('.lot_number_section').addClass('hide');
        }
    });

    $('#date_tab_location').change(function(){
        var business_id = "<?php echo e(session()->get('business.id'), false); ?>";
        var location_id = $(this).val();
        $.ajax({
            data: {
                business_id : business_id,
                location_id : location_id,
            },
            url: "/business/get-date-settings",
            dataType: 'json',
            success: function(result) {
                $('select#dashboard_filter_date_range').val(result.dashboard_filter_date_range).trigger('change');
                $('select#manufacturing_filter_date_range').val(result.manufacturing_filter_date_range).trigger('change');
            },  
        });
    });

    $('#test_sms_btn').click( function() {
        var test_number = $('#test_number').val();
        if (test_number.trim() == '') {
            toastr.error('<?php echo e(__("lang_v1.test_number_is_required"), false); ?>');
            $('#test_number').focus();

            return false;
        }

        var data = {
            url: $('#sms_settings_url').val(),
            send_to_param_name: $('#send_to_param_name').val(),
            msg_param_name: $('#msg_param_name').val(),
            request_method: $('#request_method').val(),
            param_1: $('#sms_settings_param_key1').val(),
            param_2: $('#sms_settings_param_key2').val(),
            param_3: $('#sms_settings_param_key3').val(),
            param_4: $('#sms_settings_param_key4').val(),
            param_5: $('#sms_settings_param_key5').val(),
            param_6: $('#sms_settings_param_key6').val(),
            param_7: $('#sms_settings_param_key7').val(),
            param_8: $('#sms_settings_param_key8').val(),
            param_9: $('#sms_settings_param_key9').val(),
            param_10: $('#sms_settings_param_key10').val(),

            param_val_1: $('#sms_settings_param_val1').val(),
            param_val_2: $('#sms_settings_param_val2').val(),
            param_val_3: $('#sms_settings_param_val3').val(),
            param_val_4: $('#sms_settings_param_val4').val(),
            param_val_5: $('#sms_settings_param_val5').val(),
            param_val_6: $('#sms_settings_param_val6').val(),
            param_val_7: $('#sms_settings_param_val7').val(),
            param_val_8: $('#sms_settings_param_val8').val(),
            param_val_9: $('#sms_settings_param_val9').val(),
            param_val_10: $('#sms_settings_param_val10').val(),
            test_number: test_number
        };

        $.ajax({
            method: 'post',
            data: data,
            url: "<?php echo e(action([\App\Http\Controllers\BusinessController::class, 'testSmsConfiguration']), false); ?>",
            dataType: 'json',
            success: function(result) {
                if (result.success == true) {
                    swal({
                        text: result.msg,
                        icon: 'success'
                    });
                } else {
                    swal({
                        text: result.msg,
                        icon: 'error'
                    });
                }
            },
        });
    });

    $('#zekli_generate_token').click( function() {
        var zekli_username = $('#zekli_username').val();
        var zekli_password = $('#zekli_password').val();
        if (zekli_username.trim() == '' || zekli_password.trim() == '') {
            toastr.error('<?php echo e(__("lang_v1.zekli_user_pass_required"), false); ?>');
            $('#zekli_username').focus();
            return false;
        }

        var zekli_token = $('#zekli_token').val();
        if (zekli_token.trim() != '') {
            toastr.error('Token Already Exists - Clear Existing Token to Regenerate');
            $('#zekli_token').focus();
            return false;
        }

        var data = {
            username : zekli_username,
            password : zekli_password,
        };

        $.ajax({
            method: 'post',
            data: data,
            url: "<?php echo e(action([\App\Http\Controllers\BusinessController::class, 'zekliGenerateToken']), false); ?>",
            dataType: 'json',
            success: function(result) {
                if (result.success == true) {
                    swal({
                        text: result.msg,
                        icon: 'success'
                    });
                    $('#zekli_token').val(result.token);
                } else {
                    swal({
                        text: result.msg,
                        icon: 'error'
                    });
                }
            },
        });
    });

    $('#zekli_check_balance').click( function() {
        var zekli_token = $('#zekli_token').val();
        if (zekli_token.trim() == '') {
            toastr.error('Token Missing - Generate Token Then Check Balance');
            $('#zekli_token').focus();
            return false;
        }

        var data = {
            token : zekli_token,
        };

        $.ajax({
            method: 'post',
            data: data,
            url: "<?php echo e(action([\App\Http\Controllers\BusinessController::class, 'zekliCheckBalance']), false); ?>",
            dataType: 'json',
            success: function(result) {
                if (result.success == true) {
                    swal({
                        title: result.msg,
                        text: result.data,
                        icon: 'success'
                    });
                } else {
                    swal({
                        text: result.msg,
                        icon: 'error'
                    });
                }
            },
        });
    });

    $('#zekli_test_sms').click( function() {
        var zekli_test_number = $('#zekli_test_number').val();
        if (zekli_test_number.trim() == '') {
            toastr.error('Test Number Missing');
            $('#zekli_test_number').focus();
            return false;
        }

        var zekli_token = $('#zekli_token').val();
        if (zekli_token.trim() == '') {
            toastr.error('Token Missing - Generate Token');
            $('#zekli_token').focus();
            return false;
        }

        var zekli_deduction_type = $('#zekli_deduction_type').val();
        var zekli_maskid = $('#zekli_maskid').val();
        if (zekli_deduction_type.trim() == '' || zekli_maskid.trim() == '') {
            toastr.error('Deduction Type or MaskId Missing');
            $('#zekli_deduction_type').focus();
            return false;
        }

        var data = {
            token : zekli_token,
            deduction_type : zekli_deduction_type,
            maskid : zekli_maskid,
            number : zekli_test_number,
        };

        $.ajax({
            method: 'post',
            data: data,
            url: "<?php echo e(action([\App\Http\Controllers\BusinessController::class, 'zekliTestSms']), false); ?>",
            dataType: 'json',
            success: function(result) {
                if (result.success == true) {
                    swal({
                        text: result.msg,
                        icon: 'success'
                    });
                } else {
                    swal({
                        text: result.msg,
                        icon: 'error'
                    });
                }
            },
        });
    });

    tinymce.init({
        selector: 'textarea#display_screen_heading',
        height: 250
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>