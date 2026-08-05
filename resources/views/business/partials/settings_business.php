<div class="pos-tab-content active">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('name',__('business.business_name') . ':*'); ?>

                <div class="input-group ">
                    <span class="input-group-text">
                        <i class="fas fa-building"></i>
                    </span>
                    <?php echo Form::text('name', $business->name, ['class' => 'form-control', 'required',
                    'placeholder' => __('business.business_name')]); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('start_date', __('business.start_date') . ':'); ?>

                <div class="input-group ">
                    <span class="input-group-text">
                        <i class="fas fa-calendar"></i>
                    </span>
                    <?php echo Form::text('start_date', \Carbon::createFromTimestamp(strtotime($business->start_date))->format(session('business.date_format')), ['class' => 'form-control
                    start-date-picker','placeholder' => __('business.start_date'), 'readonly']); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('business_logo', __('business.upload_logo') . ':'); ?>

                <?php echo Form::file('business_logo', ['accept' => 'image/*', 'class' => 'form-control']); ?>

                <p class="help-block"><i> <?php echo app('translator')->get('business.logo_help'); ?></i></p>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('currency_id', __('business.currency') . ':'); ?>

                
                <div class="input-group ">
                    <label class="input-group-text"><i class="fas fa-money-bill-alt"></i></label>
                    <?php echo Form::select('currency_id', $currencies, $business->currency_id, ['class' => 'form-select',
                    'placeholder' => __('business.currency'), 'required',]); ?>

                  </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <?php echo Form::label('currency_symbol_placement', __('lang_v1.currency_symbol_placement') . ':'); ?>

                <div class="input-group ">
                    
                    <label class="input-group-text"><i class="fas fa-money-bill-alt"></i></label>
                    <?php echo Form::select('currency_symbol_placement', ['before' => __('lang_v1.before_amount'), 'after' =>
                    __('lang_v1.after_amount')], $business->currency_symbol_placement, ['class' => 'form-select', 'required' ]); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('default_profit_percent', __('business.default_profit_percent') . ':*'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.default_profit_percent') . '"></i>';
                }
            ?>
                <div class="input-group ">
                    <span class="input-group-text">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    <?php echo Form::text('default_profit_percent', number_format($business->default_profit_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' =>
                    'form-control input_number']); ?>

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <?php echo Form::label('fy_start_month', __('business.fy_start_month') . ':'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.fy_start_month') . '"></i>';
                }
            ?>
                <div class="input-group ">
                    
                    <label class="input-group-text"><i class="fa fa-calendar"></i></label>
                    <?php echo Form::select('fy_start_month', $months, $business->fy_start_month, ['class' => 'form-select', 'required', ]); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('accounting_method', __('business.accounting_method') . ':*'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.accounting_method') . '"></i>';
                }
            ?>
                <div class="input-group ">
                    
                    <label class="input-group-text"><i class="fa fa-calculator"></i></label>
                    <?php echo Form::select('accounting_method', $accounting_methods, $business->accounting_method, ['class' =>
                    'form-select', 'required', ]); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('transaction_edit_days', __('business.transaction_edit_days') . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.transaction_edit_days') . '"></i>';
                }
            ?>
                <div class="input-group ">
                    <span class="input-group-text">
                        <i class="fa fa-edit"></i>
                    </span>
                    <?php echo Form::number('transaction_edit_days', $business->transaction_edit_days, ['class' =>
                    'form-control','placeholder' => __('business.transaction_edit_days'), 'required']); ?>

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('date_format', __('lang_v1.date_format') . ':*'); ?>

                <div class="input-group ">
                    
                    <label class="input-group-text"><i class="fa fa-calendar"></i></label>
                    <?php echo Form::select('date_format', $date_formats, $business->date_format, ['class' => 'form-select', 'required', ]); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('time_format', __('lang_v1.time_format') . ':*'); ?>

                <div class="input-group ">
                    
                    <label class="input-group-text"><i class="fas fa-clock"></i></label>
                    <?php echo Form::select('time_format', [12 => __('lang_v1.12_hour'), 24 => __('lang_v1.24_hour')],
                    $business->time_format, ['class' => 'form-select', 'required', ]); ?>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <?php echo Form::label('time_zone', __('business.time_zone') . ':'); ?>

                <div class="input-group ">
                    
                    <label class="input-group-text"><i class="fa fa-clock"></i></label>
                    <?php echo Form::select('time_zone', $timezone_list, $business->time_zone, ['class' => 'form-select', 'required', ]); ?>

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('currency_precision', __('lang_v1.currency_precision') . ':*'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.currency_precision_help') . '"></i>';
                }
            ?>
                <?php echo Form::select('currency_precision', [0 =>0, 1=>1, 2=>2, 3=>3,4=>4], $business->currency_precision,
                ['class' => 'form-select', 'required', ]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('quantity_precision', __('lang_v1.quantity_precision') . ':*'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.quantity_precision_help') . '"></i>';
                }
            ?>
                <?php echo Form::select('quantity_precision', [0 =>0, 1=>1, 2=>2, 3=>3,4=>4], $business->quantity_precision,
                ['class' => 'form-select', 'required', ]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('discount_precision', __('lang_v1.discount_precision') . ':*'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.discount_precision_help') . '"></i>';
                }
            ?>
                <?php echo Form::select('discount_precision', [0 =>0, 1=>1, 2=>2, 3=>3,4=>4], $business->discount_precision,
                ['class' => 'form-select', 'required', ]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('cost_decimal', __('lang_v1.cost_decimal') . ':*'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.cost_decimal_help') . '"></i>';
                }
            ?>
                <?php echo Form::select('cost_decimal', [0 =>0, 1=>1, 2=>2, 3=>3,4=>4], $business->cost_decimal ?? 2,
                ['class' => 'form-select', 'required', ]); ?>

            </div>
        </div>
        
    </div>
    
    <div class="row hide">
        <div class="col-sm-6">
            <div class="form-group mb-3">
                <?php echo Form::label('code_label_1', __('lang_v1.code_1_name') . ':'); ?>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa fa-info"></i>
                    </span>
                    <?php echo Form::text('code_label_1', $business->code_label_1, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group mb-3">
                <?php echo Form::label('code_1', __('lang_v1.code_1') . ':'); ?>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa fa-info"></i>
                    </span>
                    <?php echo Form::text('code_1', $business->code_1, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group mb-3">
                <?php echo Form::label('code_label_2', __('lang_v1.code_2_name') . ':'); ?>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa fa-info"></i>
                    </span>
                    <?php echo Form::text('code_label_2', $business->code_label_2, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group mb-3">
                <?php echo Form::label('code_2', __('lang_v1.code_2') . ':'); ?>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa fa-info"></i>
                    </span>
                    <?php echo Form::text('code_2', $business->code_2, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="row hide">
        <div class="col-sm-8">
            <div class="form-group mb-3">
                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[is_enabled_export]', true,
                    !empty($common_settings['is_enabled_export']) ? true : false ,
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_export' ), false); ?>

                </label>
            </div>
        </div>
    </div>
    <div class="row hide">
        <div class="col-sm-8">
            <?php echo Form::checkbox('common_settings[disable_fbr]', true,
            !empty($common_settings['disable_fbr']) ? true : false ,
            [ 'class' => 'form-check-input']); ?>

            <?php echo Form::checkbox('common_settings[hide_invoice_branding]', true,
            !empty($common_settings['hide_invoice_branding']) ? true : false ,
            [ 'class' => 'form-check-input']); ?>

            <?php echo Form::checkbox('common_settings[access_backup]', true,
            !empty($common_settings['access_backup']) ? true : false ,
            [ 'class' => 'form-check-input']); ?>


            <br>
        </div>
    </div>
    <div class="row">
        <?php echo $__env->make('business.partials.settings_custom_label_group', [
            'custom_label_group_key' => 'payments',
            'custom_label_group_title' => __('lang_v1.labels_for_custom_payments'),
            'custom_label_col' => 'col-sm-4',
            'custom_label_hide' => true,
            'custom_label_fields' => [
                ['key' => 'cash', 'id' => 'custom_cash_label', 'label' => __('lang_v1.cash'), 'default' => __('lang_v1.cash')],
                ['key' => 'card', 'id' => 'custom_card_label', 'label' => __('lang_v1.card'), 'default' => __('lang_v1.card')],
                ['key' => 'cheque', 'id' => 'custom_cheque_label', 'label' => __('lang_v1.cheque'), 'default' => __('lang_v1.cheque')],
                ['key' => 'bank_transfer', 'id' => 'custom_bank_transfer_label', 'label' => __('lang_v1.bank_transfer'), 'default' => __('lang_v1.bank_transfer')],
                ['key' => 'other', 'id' => 'custom_other_label', 'label' => __('lang_v1.other'), 'default' => __('lang_v1.other')],
                ['key' => 'custom_pay_1', 'id' => 'custom_payment_1', 'label' => __('lang_v1.custom_payment_1')],
                ['key' => 'custom_pay_2', 'id' => 'custom_payment_2', 'label' => __('lang_v1.custom_payment_2')],
                ['key' => 'custom_pay_3', 'id' => 'custom_payment_3', 'label' => __('lang_v1.custom_payment_3')],
                ['key' => 'custom_pay_4', 'id' => 'custom_payment_4', 'label' => __('lang_v1.custom_payment', ['number' => 4])],
                ['key' => 'custom_pay_5', 'id' => 'custom_payment_5', 'label' => __('lang_v1.custom_payment', ['number' => 5])],
                ['key' => 'custom_pay_6', 'id' => 'custom_payment_6', 'label' => __('lang_v1.custom_payment', ['number' => 6])],
                ['key' => 'custom_pay_7', 'id' => 'custom_payment_7', 'label' => __('lang_v1.custom_payment', ['number' => 7])],
            ],
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
