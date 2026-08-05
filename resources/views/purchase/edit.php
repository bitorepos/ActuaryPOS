
<?php $__env->startSection('title', __('purchase.edit_purchase')); ?>

<?php $__env->startSection('content'); ?>

    <?php
        $custom_labels = json_decode(session('business.custom_labels'), true);
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo app('translator')->get('purchase.edit_purchase'); ?> <i class="fa fa-keyboard-o hover-q text-muted" aria-hidden="true"
                style="cursor:pointer" onclick="$('#purchase_keyboard_shortcuts_modal').modal('show');"
                title="<?php echo app('translator')->get('lang_v1.purchase_show_shortcuts_help'); ?> (<?php echo e(!empty($shortcuts['purchase']['show_shortcuts_help']) ? strtoupper($shortcuts['purchase']['show_shortcuts_help']) : 'F7', false); ?>)"></i></h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Page level currency setting -->
        <input type="hidden" id="p_code" value="<?php echo e($currency_details->code, false); ?>">
        <input type="hidden" id="p_symbol" value="<?php echo e($currency_details->symbol, false); ?>">
        <input type="hidden" id="p_thousand" value="<?php echo e($currency_details->thousand_separator, false); ?>">
        <input type="hidden" id="p_decimal" value="<?php echo e($currency_details->decimal_separator, false); ?>">
        <input type="hidden" id="page_type" value="purchase">
        <input type="hidden" id="item_addition_method" value="<?php if(empty($common_settings['purchase_item_addition_method'])): ?><?php echo e(0, false); ?><?php else: ?><?php echo e($common_settings['purchase_item_addition_method'], false); ?><?php endif; ?>">
        <?php echo $__env->make('layouts.partials.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo Form::open([
            'url' => action([\App\Http\Controllers\PurchaseController::class, 'update'], [$purchase->id]),
            'method' => 'PUT',
            'id' => 'add_purchase_form',
            'files' => true,
        ]); ?>


        <?php
            $currency_precision = session('business.currency_precision', 2);
        ?>

        <input type="hidden" id="purchase_id" value="<?php echo e($purchase->id, false); ?>">

        <div class="row">
            <div class="col-sm-3">
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        
                        <?php echo Form::select(
                        'location_id',
                        $business_locations,
                        $purchase->location_id,
                        ['class' => 'form-control select2', 'id'=>'location_id', 'required', 'style' => 'width: 100%;']); ?>

                        <span class="input-group-text">
                            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.purchase_location') . '"></i>';
                }
            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('supplier_id', __('purchase.supplier') . ':*'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php echo Form::select('contact_id', [$purchase->contact_id => !empty($purchase->contact->name) ? $purchase->contact->name : $purchase->contact->supplier_business_name], $purchase->contact_id, [
                                'class' => 'form-control',
                                'placeholder' => __('messages.please_select'),
                                'required',
                                'id' => 'supplier_id',
                                ($purchase->payment_status != 'due') ? 'disabled' : '', 'style' => 'width: 70%;'
                            ]); ?>

                            <?php if($is_offline): ?>
                            
                                <button type="button" class="btn btn-default bg-white btn-flat" id="offline_sync_contacts"><i class="fa fa-sync text-primary"></i></button>
                            
                            <input class="hidden" id="is_offline" value="<?php echo e($is_offline, false); ?>">
                            <?php else: ?>
                            
                                <button type="button" class="btn btn-default bg-white btn-flat add_new_supplier" <?php if($purchase->payment_status != 'due'): ?> <?php echo e('disabled', false); ?> <?php endif; ?>
                                    data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                            
                            <?php endif; ?>
                        </div>
                    </div>
                    <strong>
                        <?php echo app('translator')->get('business.address'); ?>:
                    </strong>
                    <div id="supplier_address_div">
                        <?php echo $purchase->contact->contact_address; ?>

                        <?php if(!empty($purchase->contact->tax_number)): ?>
                        <br><?php echo app('translator')->get('contact.tax_no_short'); ?>: <?php echo e($purchase->contact->tax_number, false); ?>

                        <?php endif; ?>
                    </div>
                    <div class="form-group mb-2">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="is_inclusive" value="1" id="is_inclusive_tax"
                                    <?php echo !empty($purchase->is_inclusive) ? 'Checked' : '' ?>>
                                Is Tax Inclusive?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                <div class="row">

                <div class="col-sm-6 col-md-4">
                    <div class="form-group mb-2">
                        <?php echo Form::label('ref_no', __('purchase.ref_no') . '*'); ?>

                        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.leave_empty_to_autogenerate') . '"></i>';
                }
            ?>
                        <?php echo Form::text('ref_no', $purchase->ref_no, ['class' => 'form-control', 'required', empty($user_settings['enable_purchase_transaction_no']) ? 'readonly' : '',]); ?>

                        <b id="ref_no_error" class="error hide"><?php echo app('translator')->get('lang_v1.not_unique', ['name' => __('purchase.ref_no') ]); ?></b>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group mb-2">
                        <?php echo Form::label('ref_no_no', __('purchase.ref_no_2') . ':'); ?>

                        <?php echo Form::text('ref_no_2', $purchase->ref_no_2, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <?php echo $__env->make('transaction.partials.back_order_field', ['purchase' => $purchase], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php
                    $is_readonly = empty($user_settings['enable_purchase_transaction_date']) ? 'disabled' : '';
                ?>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group mb-2">
                        <?php echo Form::label('transaction_date', __('purchase.purchase_date') . ':*'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <?php echo Form::text('transaction_date', \Carbon::createFromTimestamp(strtotime($purchase->transaction_date))->format(session('business.date_format') . ' ' . 'h:i A'), [
                                'class' => 'form-control',
                                'readonly',
                                'required',
                                'id' => 'transaction_date_text',
                                $is_readonly,
                            ]); ?>

                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 <?php if(!empty($default_purchase_status)): ?> hide <?php endif; ?>">
                    <div class="form-group mb-2">
                        <?php echo Form::label('status', __('purchase.purchase_status') . ':*'); ?>

                        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.order_status') . '"></i>';
                }
            ?>
                        <?php echo Form::select('status', $orderStatuses, $purchase->status, [
                            'class' => 'form-control select2',
                            'placeholder' => __('messages.please_select'),
                            'required', 'style' => 'width: 100%;'
                        ]); ?>

                    </div>
                </div>


                <!-- Currency Exchange Rate -->
                
                

                <div class="col-sm-6 col-md-4 <?php if(empty(session('business.allow_currency_change_purchase'))): ?> hide <?php endif; ?>">
                    <div class="form-group mb-2">
                        <?php echo Form::label('exchange_rate', __('purchase.p_exchange_rate') . ':*'); ?>

                        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.currency_exchange_factor') . '"></i>';
                }
            ?>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-info"></i>
                            </span>
                            <?php echo Form::number('exchange_rate', $purchase->exchange_rate, [
                                'class' => 'form-control',
                                'required',
                                'step' => 0.001,
                            ]); ?>

                            <button type="button" class="btn btn-outline-info btn-sm refresh_exchange_rate_btn" id="refresh_exchange_rate_btn" title="<?php echo app('translator')->get('lang_v1.fetch_latest_rate'); ?>"><i class="fa fa-sync-alt"></i></button>
                        </div>
                        <span class="help-block text-danger">
                            <?php echo app('translator')->get('purchase.diff_purchase_currency_help', ['currency' => $currency_details->name]); ?>
                        </span>
                        <input type="hidden" name="location_currency_id" id="location_currency_id" value="<?php echo e($purchase->location_currency_id, false); ?>" data-currency-code="<?php echo e(optional(\App\LocationCurrency::find($purchase->location_currency_id))->code ?? '', false); ?>" data-currency-symbol="<?php echo e(optional(\App\LocationCurrency::find($purchase->location_currency_id))->symbol ?? '', false); ?>">
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group mb-2">
                        <?php echo Form::label('pay_term_number', __('contact.pay_term') . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.pay_term') . '"></i>';
                }
            ?>
                        <div class="d-flex">
                            <?php echo Form::number('pay_term_number', $purchase->pay_term_number, [
                                'class' => 'form-control',
                                'placeholder' => __('contact.pay_term'),
                                'style' => 'width: 50%; border-top-right-radius: 0; border-bottom-right-radius: 0;',
                            ]); ?>


                            <?php echo Form::select(
                                'pay_term_type',
                                ['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')],
                                $purchase->pay_term_type,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => __('messages.please_select'),
                                    'id' => 'pay_term_type',
                                    'style' => 'width: 50%; border-top-left-radius: 0; border-bottom-left-radius: 0;',
                                ],
                            ); ?>

                        </div>
                    </div>
                </div>
                <?php if(!empty($common_settings['show_invoice_layout_purchase'])): ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group mb-2">
                            <?php echo Form::label('invoice_layout_id', __('invoice.invoice_layouts') . ':'); ?>

                            <?php echo Form::select('invoice_layout_id', $invoice_layouts, !empty($purchase->invoice_layout_id) ? $purchase->invoice_layout_id : $purchase->location->loc_settings['purchase_layout_id'], [
                                'class' => 'form-control select2', 'id' => 'purchase_invoice_layout_id']); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(in_array('upload_documents', $enabled_modules)): ?>
                <?php if(empty($common_settings['hide_attach_document_purchase'])): ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group mb-2">
                            <?php echo Form::label('document', __('purchase.attach_document') . ':'); ?>

                            <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                            <?php echo Form::file('document', [
                                'id' => 'upload_document',
                                'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types'))),
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php endif; ?>
                </div>
            </div>
            </div>
            <div class="row">
                <?php
                    $custom_field_1_label = !empty($custom_labels['purchase']['custom_field_1']) ? $custom_labels['purchase']['custom_field_1'] : '';
                    
                    $is_custom_field_1_required = !empty($custom_labels['purchase']['is_custom_field_1_required']) && $custom_labels['purchase']['is_custom_field_1_required'] == 1 ? true : false;
                    
                    $custom_field_2_label = !empty($custom_labels['purchase']['custom_field_2']) ? $custom_labels['purchase']['custom_field_2'] : '';
                    
                    $is_custom_field_2_required = !empty($custom_labels['purchase']['is_custom_field_2_required']) && $custom_labels['purchase']['is_custom_field_2_required'] == 1 ? true : false;
                    
                    $custom_field_3_label = !empty($custom_labels['purchase']['custom_field_3']) ? $custom_labels['purchase']['custom_field_3'] : '';
                    
                    $is_custom_field_3_required = !empty($custom_labels['purchase']['is_custom_field_3_required']) && $custom_labels['purchase']['is_custom_field_3_required'] == 1 ? true : false;
                    
                    $custom_field_4_label = !empty($custom_labels['purchase']['custom_field_4']) ? $custom_labels['purchase']['custom_field_4'] : '';
                    
                    $is_custom_field_4_required = !empty($custom_labels['purchase']['is_custom_field_4_required']) && $custom_labels['purchase']['is_custom_field_4_required'] == 1 ? true : false;

                    $custom_field_5_label = !empty($custom_labels['purchase']['custom_field_5']) ? $custom_labels['purchase']['custom_field_5'] : '';
                    
                    $is_custom_field_5_required = !empty($custom_labels['purchase']['is_custom_field_5_required']) && $custom_labels['purchase']['is_custom_field_5_required'] == 1 ? true : false;

                    $custom_field_6_label = !empty($custom_labels['purchase']['custom_field_6']) ? $custom_labels['purchase']['custom_field_6'] : '';
                    
                    $is_custom_field_6_required = !empty($custom_labels['purchase']['is_custom_field_6_required']) && $custom_labels['purchase']['is_custom_field_6_required'] == 1 ? true : false;

                    $custom_field_7_label = !empty($custom_labels['purchase']['custom_field_7']) ? $custom_labels['purchase']['custom_field_7'] : '';
                    
                    $is_custom_field_7_required = !empty($custom_labels['purchase']['is_custom_field_7_required']) && $custom_labels['purchase']['is_custom_field_7_required'] == 1 ? true : false;

                    $custom_field_8_label = !empty($custom_labels['purchase']['custom_field_8']) ? $custom_labels['purchase']['custom_field_8'] : '';
                    
                    $is_custom_field_8_required = !empty($custom_labels['purchase']['is_custom_field_8_required']) && $custom_labels['purchase']['is_custom_field_8_required'] == 1 ? true : false;

                    $custom_field_9_label = !empty($custom_labels['purchase']['custom_field_9']) ? $custom_labels['purchase']['custom_field_9'] : '';

                    $is_custom_field_9_required = !empty($custom_labels['purchase']['is_custom_field_9_required']) && $custom_labels['purchase']['is_custom_field_9_required'] == 1 ? true : false;

                    $custom_field_10_label = !empty($custom_labels['purchase']['custom_field_10']) ? $custom_labels['purchase']['custom_field_10'] : '';

                    $is_custom_field_10_required = !empty($custom_labels['purchase']['is_custom_field_10_required']) && $custom_labels['purchase']['is_custom_field_10_required'] == 1 ? true : false;

                    $custom_field_11_label = !empty($custom_labels['purchase']['custom_field_11']) ? $custom_labels['purchase']['custom_field_11'] : '';

                    $is_custom_field_11_required = !empty($custom_labels['purchase']['is_custom_field_11_required']) && $custom_labels['purchase']['is_custom_field_11_required'] == 1 ? true : false;

                    $custom_field_12_label = !empty($custom_labels['purchase']['custom_field_12']) ? $custom_labels['purchase']['custom_field_12'] : '';

                    $is_custom_field_12_required = !empty($custom_labels['purchase']['is_custom_field_12_required']) && $custom_labels['purchase']['is_custom_field_12_required'] == 1 ? true : false;

                    $custom_field_13_label = !empty($custom_labels['purchase']['custom_field_13']) ? $custom_labels['purchase']['custom_field_13'] : '';

                    $is_custom_field_13_required = !empty($custom_labels['purchase']['is_custom_field_13_required']) && $custom_labels['purchase']['is_custom_field_13_required'] == 1 ? true : false;

                    $custom_field_14_label = !empty($custom_labels['purchase']['custom_field_14']) ? $custom_labels['purchase']['custom_field_14'] : '';

                    $is_custom_field_14_required = !empty($custom_labels['purchase']['is_custom_field_14_required']) && $custom_labels['purchase']['is_custom_field_14_required'] == 1 ? true : false;
                ?>
                <?php if(!empty($custom_field_1_label)): ?>
                    <?php
                        $label_1 = $custom_field_1_label . ':';
                        if ($is_custom_field_1_required) {
                            $label_1 .= '*';
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('custom_field_1', $label_1); ?>

                            <?php echo Form::text('custom_field_1', $purchase->custom_field_1, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_1_label,
                                'required' => $is_custom_field_1_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($custom_field_2_label)): ?>
                    <?php
                        $label_2 = $custom_field_2_label . ':';
                        if ($is_custom_field_2_required) {
                            $label_2 .= '*';
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('custom_field_2', $label_2); ?>

                            <?php echo Form::text('custom_field_2', $purchase->custom_field_2, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_2_label,
                                'required' => $is_custom_field_2_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($custom_field_3_label)): ?>
                    <?php
                        $label_3 = $custom_field_3_label . ':';
                        if ($is_custom_field_3_required) {
                            $label_3 .= '*';
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('custom_field_3', $label_3); ?>

                            <?php echo Form::text('custom_field_3', $purchase->custom_field_3, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_3_label,
                                'required' => $is_custom_field_3_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($custom_field_4_label)): ?>
                    <?php
                        $label_4 = $custom_field_4_label . ':';
                        if ($is_custom_field_4_required) {
                            $label_4 .= '*';
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('custom_field_4', $label_4); ?>

                            <?php echo Form::text('custom_field_4', $purchase->custom_field_4, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_4_label,
                                'required' => $is_custom_field_4_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($custom_field_5_label)): ?>
                    <?php
                        $label_5 = $custom_field_5_label . ':';
                        if ($is_custom_field_5_required) {
                            $label_5 .= '*';
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('custom_field_5', $label_5); ?>

                            <?php echo Form::text('custom_field_5', $purchase->custom_field_5, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_5_label,
                                'required' => $is_custom_field_5_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($custom_field_6_label)): ?>
                    <?php
                        $label_6 = $custom_field_6_label . ':';
                        if ($is_custom_field_6_required) {
                            $label_6 .= '*';
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('custom_field_6', $label_6); ?>

                            <?php echo Form::text('custom_field_6', $purchase->custom_field_6, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_6_label,
                                'required' => $is_custom_field_6_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($custom_field_7_label)): ?>
                    <?php
                        $label_7 = $custom_field_7_label . ':';
                        if ($is_custom_field_7_required) {
                            $label_7 .= '*';
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('custom_field_7', $label_7); ?>

                            <?php echo Form::text('custom_field_7', $purchase->custom_field_7, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_7_label,
                                'required' => $is_custom_field_7_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($custom_field_8_label)): ?>
                    <?php
                        $label_8 = $custom_field_8_label . ':';
                        if ($is_custom_field_8_required) {
                            $label_8 .= '*';
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('custom_field_8', $label_8); ?>

                            <?php echo Form::text('custom_field_8', $purchase->custom_field_8, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_8_label,
                                'required' => $is_custom_field_8_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($custom_field_9_label)): ?>
                    <?php
                        $label_9 = $custom_field_9_label . ':';
                        if ($is_custom_field_9_required) {
                            $label_9 .= '*';
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('custom_field_9', $label_9); ?>

                            <?php echo Form::text('custom_field_9', $purchase->custom_field_9, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_9_label,
                                'required' => $is_custom_field_9_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($custom_field_10_label)): ?>
                    <?php
                        $label_10 = $custom_field_10_label . ':';
                        if ($is_custom_field_10_required) {
                            $label_10 .= '*';
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('custom_field_10', $label_10); ?>

                            <?php echo Form::text('custom_field_10', $purchase->custom_field_10, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_10_label,
                                'required' => $is_custom_field_10_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($custom_field_11_label)): ?>
                    <?php
                        $label_11 = $custom_field_11_label . ':';
                        if ($is_custom_field_11_required) {
                            $label_11 .= '*';
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('custom_field_11', $label_11); ?>

                            <?php echo Form::text('custom_field_11', $purchase->custom_field_11, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_11_label,
                                'required' => $is_custom_field_11_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($custom_field_12_label)): ?>
                    <?php
                        $label_12 = $custom_field_12_label . ':';
                        if ($is_custom_field_12_required) {
                            $label_12 .= '*';
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('custom_field_12', $label_12); ?>

                            <?php echo Form::text('custom_field_12', $purchase->custom_field_12, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_12_label,
                                'required' => $is_custom_field_12_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($custom_field_13_label)): ?>
                    <?php
                        $label_13 = $custom_field_13_label . ':';
                        if ($is_custom_field_13_required) {
                            $label_13 .= '*';
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('custom_field_13', $label_13); ?>

                            <?php echo Form::text('custom_field_13', $purchase->custom_field_13, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_13_label,
                                'required' => $is_custom_field_13_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($custom_field_14_label)): ?>
                    <?php
                        $label_14 = $custom_field_14_label . ':';
                        if ($is_custom_field_14_required) {
                            $label_14 .= '*';
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('custom_field_14', $label_14); ?>

                            <?php echo Form::text('custom_field_14', $purchase->custom_field_14, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_14_label,
                                'required' => $is_custom_field_14_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php if(!empty($common_settings['enable_purchase_order'])): ?>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('purchase_order_ids', __('lang_v1.purchase_order') . ':'); ?>

                            <?php echo Form::select('purchase_order_ids[]', $purchase_orders, $purchase->purchase_order_ids, [
                                'class' => 'form-control select2',
                                'multiple',
                                'id' => 'purchase_order_ids',
                            ]); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="row">
                <div class="col-sm-2 text-center">
                    <button type="button" class="btn btn-primary btn-flat" data-bs-toggle="modal"
                        data-bs-target="#import_purchase_products_modal"><?php echo app('translator')->get('product.import_products'); ?></button>
                </div>
                <div class="col-sm-8">
                    <div class="form-group mb-2">
                        <div class="input-group">
                            
                                <button type="button" class="btn btn-secondary btn-flat" id="open_products_search_modal" title="<?php echo e(__('lang_v1.products_search'), false); ?>"><i class="fas fa-search"></i></button>
                            
                            <?php echo Form::text('search_product', null, [
                                'class' => 'form-control',
                                'id' => 'search_product',
                                'placeholder' => __('lang_v1.search_product_placeholder'),
                                'autofocus',
                            ]); ?>

                        </div>
                    </div>
                </div>
                <?php if($is_offline): ?>
                    
                        <button type="button" class="btn btn-secondary bg-white btn-flat" id="offline_sync_products"><i class="fa fa-sync text-primary"></i></button>
                    
                <?php else: ?>
                <div class="col-sm-2">
                    <div class="form-group mb-2">
                        <button tabindex="-1" type="button"
                            class="btn btn-light btn-modal quick_add_product_btn" data-href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'quickAdd']), false); ?>"
                            data-container=".quick_add_product_modal"><i class="fa fa-plus"></i> <?php echo app('translator')->get('product.add_new_product'); ?> </button>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <?php
                $hide_discount = empty($common_settings['enable_inline_discount_purchase']) ? 'hide' : '';
                $hide_total_discount = empty($common_settings['enable_inline_total_discount_purchase']) ? 'hide' : '';
                $hide_discount2 = empty($common_settings['enable_inline_discount2_purchase']) ? 'hide' : '';
                $hide_total_discount2 = empty($common_settings['enable_inline_total_discount2_purchase']) ? 'hide' : '';
                $hide_tax = (empty($common_settings['enable_inline_tax_purchase']) || $taxes->isEmpty()) ? 'hide' : '';
                $hide_scheme_qty = empty($common_settings['enable_scheme_quantity_purchase']) ? 'hide' : '';
            ?>

            <div class="row">
                <?php echo $__env->make('purchase.partials.edit_purchase_entry_row', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
                <div class="col-sm-12">
                    <hr />
                    <style>
                        .sell-totals-row .table-sm th,
                        .sell-totals-row .table-sm td {
                            padding-top: 1px !important;
                            padding-bottom: 1px !important;
                            line-height: 1.5;
                        }
                    </style>
                    <div class="row gx-2 sell-totals-row" style="font-size:12px;">
                        
                        <div class="col">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <th class="text-end text-nowrap"><?php echo app('translator')->get('lang_v1.total_items'); ?>:</th>
                                    <td class="text-end"><span id="total_quantity" class="display_currency" data-currency_symbol="false"></span></td>
                                </tr>
                                <tr class="<?php echo e($hide_scheme_qty, false); ?>">
                                    <th class="text-end text-nowrap">Scheme Quantity:</th>
                                    <td class="text-end"><span id="total_scheme_quantity" class="display_currency" data-currency_symbol="false"></span></td>
                                </tr>
                                <tr>
                                    <th class="text-end text-nowrap">Gross Profit %:</th>
                                    <td class="text-end"><span id="total_profit_margin" class="display_currency"></span></td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col <?php echo e($hide_discount, false); ?>">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <th class="text-end text-nowrap">Total Before Unit Discount:</th>
                                    <td class="text-end"><span id="total_st_before_discount" class="display_currency"></span><input type="hidden" id="st_before_discount" value=0></td>
                                </tr>
                                <tr>
                                    <th class="text-end text-nowrap">Unit Discount:</th>
                                    <td class="text-end"><span id="total_discount" class="display_currency"></span></td>
                                </tr>
                                <tr>
                                    <th class="text-end text-nowrap">Total After Unit Discount:</th>
                                    <td class="text-end"><span id="total_st_after_discount" class="display_currency"></span></td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col <?php echo e($hide_total_discount, false); ?>">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <th class="text-end text-nowrap">Total Before Total Discount:</th>
                                    <td class="text-end"><span id="total_st_before_total_discount" class="display_currency"></span></td>
                                </tr>
                                <tr>
                                    <th class="text-end text-nowrap">Total Discount:</th>
                                    <td class="text-end"><span id="total_total_discount_items" class="display_currency"></span></td>
                                </tr>
                                <tr>
                                    <th class="text-end text-nowrap">Total After Total Discount:</th>
                                    <td class="text-end"><span id="total_st_after_total_discount" class="display_currency"></span></td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col <?php echo e($hide_discount2, false); ?>">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <th class="text-end text-nowrap">Total Before Discount2:</th>
                                    <td class="text-end"><span id="total_st_before_discount2" class="display_currency"></span></td>
                                </tr>
                                <tr>
                                    <th class="text-end text-nowrap">Discount2:</th>
                                    <td class="text-end"><span id="total_discount2_items" class="display_currency"></span></td>
                                </tr>
                                <tr>
                                    <th class="text-end text-nowrap">Total After Discount2:</th>
                                    <td class="text-end"><span id="total_st_after_discount2" class="display_currency"></span></td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col <?php echo e($hide_total_discount2, false); ?>">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <th class="text-end text-nowrap">Total Before Total Discount2:</th>
                                    <td class="text-end"><span id="total_st_before_total_discount2" class="display_currency"></span></td>
                                </tr>
                                <tr>
                                    <th class="text-end text-nowrap">Total Discount2:</th>
                                    <td class="text-end"><span id="total_total_discount2_items" class="display_currency"></span></td>
                                </tr>
                                <tr>
                                    <th class="text-end text-nowrap">Total After Total Discount2:</th>
                                    <td class="text-end"><span id="total_st_after_total_discount2" class="display_currency"></span></td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col <?php echo e($hide_tax, false); ?>">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <th class="text-end text-nowrap"><?php echo app('translator')->get('purchase.total_before_tax'); ?>:</th>
                                    <td class="text-end"><span id="total_st_before_tax" class="display_currency"></span><input type="hidden" id="st_before_tax_input" value=0></td>
                                </tr>
                                <tr>
                                    <th class="text-end text-nowrap">Total Tax:</th>
                                    <td class="text-end"><span id="total_tax" class="display_currency" data-currency_symbol="false"></span></td>
                                </tr>
                                <tr class="<?php echo e($hide_scheme_qty, false); ?> <?php echo e($hide_tax, false); ?>">
                                    <th class="text-end text-nowrap">Scheme Tax:</th>
                                    <td class="text-end"><span id="total_scheme_tax" class="display_currency" data-currency_symbol="false"></span></td>
                                </tr>
                                <tr>
                                    <th class="text-end text-nowrap">Total After Tax:</th>
                                    <td class="text-end"><span id="total_st_after_tax" class="display_currency"></span></td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col d-flex align-items-center">
                            <table class="table table-sm table-borderless mb-0">
                                <tr style="font-size:14px;">
                                    <th class="text-end text-nowrap"><?php echo app('translator')->get('purchase.net_total_amount'); ?>:</th>
                                    <td class="text-end"><strong><span id="total_subtotal" class="display_currency"></span></strong><input type="hidden" id="total_subtotal_input" value='0' name="total_before_tax"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table">
                        <?php if(!empty($common_settings['enable_total_discount_purchase'])): ?>
                            <tr>
                                <td class="col-md-3">
                                    <div class="mb-3">
                                        <?php echo Form::label('discount_type', __('purchase.discount_type') . ':'); ?>

                                        <?php echo Form::select(
                                            'discount_type',
                                            ['' => __('lang_v1.none'), 'fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')],
                                            $purchase->discount_type,
                                            ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')],
                                        ); ?>

                                    </div>
                                </td>
                                <td class="col-md-3">
                                    <div class="mb-3">
                                        <?php echo Form::label('discount_amount', __('purchase.discount_amount') . ':'); ?>

                                        <?php echo Form::text(
                                            'discount_amount',
                                        
                                            $purchase->discount_type == 'fixed'
                                                ? number_format(
                                                    $purchase->discount_amount / $purchase->exchange_rate,
                                                    $currency_precision,
                                                    $currency_details->decimal_separator,
                                                    $currency_details->thousand_separator,
                                                )
                                                : number_format(
                                                    $purchase->discount_amount,
                                                    $currency_precision,
                                                    $currency_details->decimal_separator,
                                                    $currency_details->thousand_separator,
                                                ),
                                            ['class' => 'form-control input_number'],
                                        ); ?>

                                    </div>
                                </td>
                                <td class="col-md-3">
                                    &nbsp;
                                </td>
                                <td class="col-md-3">
                                    <b>Discount <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>:</b>(-)
                                    <span id="discount_calculated_amount" class="display_currency">0</span>
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php if(!empty($common_settings['enable_total_discount2_purchase'])): ?>
                            <tr>
                                <td class="col-md-3">
                                    <div class="mb-3">
                                        <?php echo Form::label('discount2_type', __('purchase.discount2_type') . ':'); ?>

                                        <?php echo Form::select(
                                            'discount2_type',
                                            ['' => __('lang_v1.none'), 'fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')],
                                            $purchase->discount2_type,
                                            ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')],
                                        ); ?>

                                    </div>
                                </td>
                                <td class="col-md-3">
                                    <div class="mb-3">
                                        <?php echo Form::label('discount2_amount', __('purchase.discount2_amount') . ':'); ?>

                                        <?php echo Form::text(
                                            'discount2_amount',
                                            $purchase->discount2_type == 'fixed'
                                                ? number_format(
                                                    $purchase->discount2_amount / $purchase->exchange_rate,
                                                    $currency_precision,
                                                    $currency_details->decimal_separator,
                                                    $currency_details->thousand_separator,
                                                )
                                                : number_format(
                                                    $purchase->discount2_amount,
                                                    $currency_precision,
                                                    $currency_details->decimal_separator,
                                                    $currency_details->thousand_separator,
                                                ),
                                            ['class' => 'form-control input_number'],
                                        ); ?>

                                    </div>
                                </td>
                                <td class="col-md-3">
                                    &nbsp;
                                </td>
                                <td class="col-md-3">
                                    <b>Discount <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>:</b>(-)
                                    <span id="discount2_calculated_amount" class="display_currency">0</span>
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php if(!empty($common_settings['enable_total_tax_purchase'])): ?>
                                <tr>
                                    <td>
                                        <div class="mb-3">
                                            <?php echo Form::label('tax_id', __('purchase.purchase_tax') . ':'); ?>

                                            <select name="tax_id" id="tax_id" class="form-control select2"
                                                placeholder="'Please Select'">
                                                <option value="" data-tax_amount="0" data-tax_type="fixed" selected><?php echo app('translator')->get('lang_v1.none'); ?></option>
                                                <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($tax->id, false); ?>"
                                                        <?php if($purchase->tax_id == $tax->id): ?> <?php echo e('selected', false); ?> <?php endif; ?>
                                                        data-tax_amount="<?php echo e($tax->amount, false); ?>" data-tax_type="<?php echo e($tax->type, false); ?>">
                                                        <?php echo e($tax->name, false); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php echo Form::hidden('tax_amount', $purchase->tax_amount, ['id' => 'tax_amount']); ?>

                                            <?php echo Form::hidden('tax_type', $purchase->tax_type, ['id' => 'tax_type']); ?>

                                        </div>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <b><?php echo app('translator')->get('purchase.purchase_tax'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>:</b>(+)
                                        <span id="tax_calculated_amount" class="display_currency">0</span>
                                    </td>
                                </tr>
                        <?php endif; ?>

                        <tr>
                            <td colspan="4">
                                <div class="form-group mb-2">
                                    <?php echo Form::label('additional_notes', __('purchase.additional_notes')); ?>

                                    <a href="javascript:void(0)" class="toggle-note">
                                        <i class="fa <?php echo e(!empty($purchase->additional_notes) ? 'fa-minus-circle text-danger' : 'fa-plus-circle text-success', false); ?>"></i>
                                    </a>
                                    <div class="note-wrapper" style="<?php echo e(empty($purchase->additional_notes) ? 'display:none;' : '', false); ?>">
                                        <?php echo Form::textarea('additional_notes', $purchase->additional_notes, ['class' => 'form-control', 'rows' => 3]); ?>

                                    </div>
                                </div>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php if(!empty($common_settings['enable_shipping_details_purchase'])): ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <?php echo Form::label('shipping_details', __('purchase.shipping_details') . ':'); ?>

                        <?php echo Form::text('shipping_details', $purchase->shipping_details, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <div class="form-group mb-2">
                        <?php echo Form::label('shipping_charges', '(+) ' . __('purchase.additional_shipping_charges') . ':'); ?>

                        <?php echo Form::text(
                            'shipping_charges',
                            number_format(
                                $purchase->shipping_charges / $purchase->exchange_rate,
                                $currency_precision,
                                $currency_details->decimal_separator,
                                $currency_details->thousand_separator,
                            ),
                            ['id' => 'shipping_charges', 'class' => 'form-control input_number'],
                        ); ?>

                    </div>
                </div>
                <?php if(in_array('upload_documents', $enabled_modules)): ?>
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <?php echo Form::label('shipping_documents', __('lang_v1.shipping_documents') . ':'); ?>

                            <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                            <?php echo Form::file('shipping_documents[]', ['id' => 'shipping_documents', 'multiple', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

                            <?php
                                $medias = $purchase->media->where('model_media_type', 'shipping_document')->all();
                            ?>
                            <?php echo $__env->make('sell.partials.media_table', ['medias' => $medias, 'delete' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <?php
                    $shipping_custom_label_1 = !empty($custom_labels['purchase_shipping']['custom_field_1']) ? $custom_labels['purchase_shipping']['custom_field_1'] : '';
                    
                    $is_shipping_custom_field_1_required = !empty($custom_labels['purchase_shipping']['is_custom_field_1_required']) && $custom_labels['purchase_shipping']['is_custom_field_1_required'] == 1 ? true : false;
                    
                    $shipping_custom_label_2 = !empty($custom_labels['purchase_shipping']['custom_field_2']) ? $custom_labels['purchase_shipping']['custom_field_2'] : '';
                    
                    $is_shipping_custom_field_2_required = !empty($custom_labels['purchase_shipping']['is_custom_field_2_required']) && $custom_labels['purchase_shipping']['is_custom_field_2_required'] == 1 ? true : false;
                    
                    $shipping_custom_label_3 = !empty($custom_labels['purchase_shipping']['custom_field_3']) ? $custom_labels['purchase_shipping']['custom_field_3'] : '';
                    
                    $is_shipping_custom_field_3_required = !empty($custom_labels['purchase_shipping']['is_custom_field_3_required']) && $custom_labels['purchase_shipping']['is_custom_field_3_required'] == 1 ? true : false;
                    
                    $shipping_custom_label_4 = !empty($custom_labels['purchase_shipping']['custom_field_4']) ? $custom_labels['purchase_shipping']['custom_field_4'] : '';
                    
                    $is_shipping_custom_field_4_required = !empty($custom_labels['purchase_shipping']['is_custom_field_4_required']) && $custom_labels['purchase_shipping']['is_custom_field_4_required'] == 1 ? true : false;
                    
                    $shipping_custom_label_5 = !empty($custom_labels['purchase_shipping']['custom_field_5']) ? $custom_labels['purchase_shipping']['custom_field_5'] : '';
                    
                    $is_shipping_custom_field_5_required = !empty($custom_labels['purchase_shipping']['is_custom_field_5_required']) && $custom_labels['purchase_shipping']['is_custom_field_5_required'] == 1 ? true : false;
                ?>

                <?php if(!empty($shipping_custom_label_1)): ?>
                    <?php
                        $label_1 = $shipping_custom_label_1 . ':';
                        if ($is_shipping_custom_field_1_required) {
                            $label_1 .= '*';
                        }
                    ?>

                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <?php echo Form::label('shipping_custom_field_1', $label_1); ?>

                            <?php echo Form::text('shipping_custom_field_1', $purchase->shipping_custom_field_1 ?? null, [
                                'class' => 'form-control',
                                'placeholder' => $shipping_custom_label_1,
                                'required' => $is_shipping_custom_field_1_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($shipping_custom_label_2)): ?>
                    <?php
                        $label_2 = $shipping_custom_label_2 . ':';
                        if ($is_shipping_custom_field_2_required) {
                            $label_2 .= '*';
                        }
                    ?>

                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <?php echo Form::label('shipping_custom_field_2', $label_2); ?>

                            <?php echo Form::text('shipping_custom_field_2', $purchase->shipping_custom_field_2 ?? null, [
                                'class' => 'form-control',
                                'placeholder' => $shipping_custom_label_2,
                                'required' => $is_shipping_custom_field_2_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($shipping_custom_label_3)): ?>
                    <?php
                        $label_3 = $shipping_custom_label_3 . ':';
                        if ($is_shipping_custom_field_3_required) {
                            $label_3 .= '*';
                        }
                    ?>

                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <?php echo Form::label('shipping_custom_field_3', $label_3); ?>

                            <?php echo Form::text('shipping_custom_field_3', $purchase->shipping_custom_field_3 ?? null, [
                                'class' => 'form-control',
                                'placeholder' => $shipping_custom_label_3,
                                'required' => $is_shipping_custom_field_3_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($shipping_custom_label_4)): ?>
                    <?php
                        $label_4 = $shipping_custom_label_4 . ':';
                        if ($is_shipping_custom_field_4_required) {
                            $label_4 .= '*';
                        }
                    ?>

                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <?php echo Form::label('shipping_custom_field_4', $label_4); ?>

                            <?php echo Form::text('shipping_custom_field_4', $purchase->shipping_custom_field_4 ?? null, [
                                'class' => 'form-control',
                                'placeholder' => $shipping_custom_label_4,
                                'required' => $is_shipping_custom_field_4_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($shipping_custom_label_5)): ?>
                    <?php
                        $label_5 = $shipping_custom_label_5 . ':';
                        if ($is_shipping_custom_field_5_required) {
                            $label_5 .= '*';
                        }
                    ?>

                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <?php echo Form::label('shipping_custom_field_5', $label_5); ?>

                            <?php echo Form::text('shipping_custom_field_5', $purchase->shipping_custom_field_5 ?? null, [
                                'class' => 'form-control',
                                'placeholder' => $shipping_custom_label_5,
                                'required' => $is_shipping_custom_field_5_required,
                            ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php if(!empty($common_settings['enable_additional_expense_purchase'])): ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-primary btn-sm" id="toggle_additional_expense"> <i
                            class="fas fa-plus"></i> <?php echo app('translator')->get('lang_v1.add_additional_expenses'); ?> <i class="fas fa-chevron-down"></i></button>
                </div>
                <div class="col-md-8 col-md-offset-4" id="additional_expenses_div">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('lang_v1.additional_expense_name'); ?></th>
                                <th><?php echo app('translator')->get('sale.amount'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo Form::text('additional_expense_key_1', $purchase->additional_expense_key_1, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_1',
                                    ]); ?>

                                </td>
                                <td>
                                    <?php echo Form::text(
                                        'additional_expense_value_1',
                                        number_format(
                                            $purchase->additional_expense_value_1 / $purchase->exchange_rate,
                                            $currency_precision,
                                            $currency_details->decimal_separator,
                                            $currency_details->thousand_separator,
                                        ),
                                        ['class' => 'form-control input_number', 'id' => 'additional_expense_value_1'],
                                    ); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo Form::text('additional_expense_key_2', $purchase->additional_expense_key_2, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_2',
                                    ]); ?>

                                </td>
                                <td>
                                    <?php echo Form::text(
                                        'additional_expense_value_2',
                                        number_format(
                                            $purchase->additional_expense_value_2 / $purchase->exchange_rate,
                                            $currency_precision,
                                            $currency_details->decimal_separator,
                                            $currency_details->thousand_separator,
                                        ),
                                        ['class' => 'form-control input_number', 'id' => 'additional_expense_value_2'],
                                    ); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo Form::text('additional_expense_key_3', $purchase->additional_expense_key_3, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_3',
                                    ]); ?>

                                </td>
                                <td>
                                    <?php echo Form::text(
                                        'additional_expense_value_3',
                                        number_format(
                                            $purchase->additional_expense_value_3 / $purchase->exchange_rate,
                                            $currency_precision,
                                            $currency_details->decimal_separator,
                                            $currency_details->thousand_separator,
                                        ),
                                        ['class' => 'form-control input_number', 'id' => 'additional_expense_value_3'],
                                    ); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo Form::text('additional_expense_key_4', $purchase->additional_expense_key_4, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_4',
                                    ]); ?>

                                </td>
                                <td>
                                    <?php echo Form::text(
                                        'additional_expense_value_4',
                                        number_format(
                                            $purchase->additional_expense_value_4 / $purchase->exchange_rate,
                                            $currency_precision,
                                            $currency_details->decimal_separator,
                                            $currency_details->thousand_separator,
                                        ),
                                        ['class' => 'form-control input_number', 'id' => 'additional_expense_value_4'],
                                    ); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo Form::text('additional_expense_key_5', $purchase->additional_expense_key_5, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_5',
                                    ]); ?>

                                </td>
                                <td>
                                    <?php echo Form::text(
                                        'additional_expense_value_5',
                                        number_format(
                                            $purchase->additional_expense_value_5 / $purchase->exchange_rate,
                                            $currency_precision,
                                            $currency_details->decimal_separator,
                                            $currency_details->thousand_separator,
                                        ),
                                        ['class' => 'form-control input_number', 'id' => 'additional_expense_value_5'],
                                    ); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo Form::text('additional_expense_key_6', $purchase->additional_expense_key_6, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_6',
                                    ]); ?>

                                </td>
                                <td>
                                    <?php echo Form::text(
                                        'additional_expense_value_6',
                                        number_format(
                                            $purchase->additional_expense_value_6 / $purchase->exchange_rate,
                                            $currency_precision,
                                            $currency_details->decimal_separator,
                                            $currency_details->thousand_separator,
                                        ),
                                        ['class' => 'form-control input_number', 'id' => 'additional_expense_value_6'],
                                    ); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo Form::text('additional_expense_key_7', $purchase->additional_expense_key_7, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_7',
                                    ]); ?>

                                </td>
                                <td>
                                    <?php echo Form::text(
                                        'additional_expense_value_7',
                                        number_format(
                                            $purchase->additional_expense_value_7 / $purchase->exchange_rate,
                                            $currency_precision,
                                            $currency_details->decimal_separator,
                                            $currency_details->thousand_separator,
                                        ),
                                        ['class' => 'form-control input_number', 'id' => 'additional_expense_value_7'],
                                    ); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo Form::text('additional_expense_key_8', $purchase->additional_expense_key_8, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_8',
                                    ]); ?>

                                </td>
                                <td>
                                    <?php echo Form::text(
                                        'additional_expense_value_8',
                                        number_format(
                                            $purchase->additional_expense_value_8 / $purchase->exchange_rate,
                                            $currency_precision,
                                            $currency_details->decimal_separator,
                                            $currency_details->thousand_separator,
                                        ),
                                        ['class' => 'form-control input_number', 'id' => 'additional_expense_value_8'],
                                    ); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo Form::text('additional_expense_key_9', $purchase->additional_expense_key_9, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_9',
                                    ]); ?>

                                </td>
                                <td>
                                    <?php echo Form::text(
                                        'additional_expense_value_9',
                                        number_format(
                                            $purchase->additional_expense_value_9 / $purchase->exchange_rate,
                                            $currency_precision,
                                            $currency_details->decimal_separator,
                                            $currency_details->thousand_separator,
                                        ),
                                        ['class' => 'form-control input_number', 'id' => 'additional_expense_value_9'],
                                    ); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo Form::text('additional_expense_key_10', $purchase->additional_expense_key_10, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_10',
                                    ]); ?>

                                </td>
                                <td>
                                    <?php echo Form::text(
                                        'additional_expense_value_10',
                                        number_format(
                                            $purchase->additional_expense_value_10 / $purchase->exchange_rate,
                                            $currency_precision,
                                            $currency_details->decimal_separator,
                                            $currency_details->thousand_separator,
                                        ),
                                        ['class' => 'form-control input_number', 'id' => 'additional_expense_value_10'],
                                    ); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo Form::text('additional_expense_key_11', $purchase->additional_expense_key_11, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_11',
                                    ]); ?>

                                </td>
                                <td>
                                    <?php echo Form::text(
                                        'additional_expense_value_11',
                                        number_format(
                                            $purchase->additional_expense_value_11 / $purchase->exchange_rate,
                                            $currency_precision,
                                            $currency_details->decimal_separator,
                                            $currency_details->thousand_separator,
                                        ),
                                        ['class' => 'form-control input_number', 'id' => 'additional_expense_value_11'],
                                    ); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo Form::text('additional_expense_key_12', $purchase->additional_expense_key_12, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_12',
                                    ]); ?>

                                </td>
                                <td>
                                    <?php echo Form::text(
                                        'additional_expense_value_12',
                                        number_format(
                                            $purchase->additional_expense_value_12 / $purchase->exchange_rate,
                                            $currency_precision,
                                            $currency_details->decimal_separator,
                                            $currency_details->thousand_separator,
                                        ),
                                        ['class' => 'form-control input_number', 'id' => 'additional_expense_value_12'],
                                    ); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo Form::text('additional_expense_key_13', $purchase->additional_expense_key_13, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_13',
                                    ]); ?>

                                </td>
                                <td>
                                    <?php echo Form::text(
                                        'additional_expense_value_13',
                                        number_format(
                                            $purchase->additional_expense_value_13 / $purchase->exchange_rate,
                                            $currency_precision,
                                            $currency_details->decimal_separator,
                                            $currency_details->thousand_separator,
                                        ),
                                        ['class' => 'form-control input_number', 'id' => 'additional_expense_value_13'],
                                    ); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo Form::text('additional_expense_key_14', $purchase->additional_expense_key_14, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_14',
                                    ]); ?>

                                </td>
                                <td>
                                    <?php echo Form::text(
                                        'additional_expense_value_14',
                                        number_format(
                                            $purchase->additional_expense_value_14 / $purchase->exchange_rate,
                                            $currency_precision,
                                            $currency_details->decimal_separator,
                                            $currency_details->thousand_separator,
                                        ),
                                        ['class' => 'form-control input_number', 'id' => 'additional_expense_value_14'],
                                    ); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo Form::text('additional_expense_key_15', $purchase->additional_expense_key_15, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_15',
                                    ]); ?>

                                </td>
                                <td>
                                    <?php echo Form::text(
                                        'additional_expense_value_15',
                                        number_format(
                                            $purchase->additional_expense_value_15 / $purchase->exchange_rate,
                                            $currency_precision,
                                            $currency_details->decimal_separator,
                                            $currency_details->thousand_separator,
                                        ),
                                        ['class' => 'form-control input_number', 'id' => 'additional_expense_value_15'],
                                    ); ?>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    <?php endif; ?>

            <div class="row">
                <div class="col-md-12 text-right">
                    <?php echo Form::hidden('final_total', $purchase->final_total, ['id' => 'grand_total_hidden']); ?>

                    <b><?php echo app('translator')->get('purchase.purchase_total'); ?>: <span class="selected_currency_symbol badge bg-info" style="font-size:11px;"></span></b><span id="grand_total" class="display_currency"
                        data-currency_symbol='true'><?php echo e($purchase->final_total, false); ?></span>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <div class="row">
            <div class="col-sm-12 text-center">
                
                    <div class="form-check">
                        <label class="form-check-label">
<input type="checkbox" class="form-check-input" name="reindex" value="1" id="reindex">
                            Re-Index Stock
                        </label>
                    </div>
                
                <input type="hidden" id="save_and_print" name="save_and_print" value="">
            </div>
        </div>
        <?php echo Form::close(); ?>

    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modals'); ?>
    <!-- quick product modal -->
    
    <div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        <?php echo $__env->make('contact.create', ['quick_add' => true, 'supplier' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    
    <?php echo $__env->make('purchase.partials.import_purchase_products_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('purchase.partials.bulk_edit_product_discount_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('purchase.partials.bulk_edit_product_tax_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/purchase.js?v=' . $asset_v . '.' . filemtime(public_path('js/purchase.js'))), false); ?>"></script>
    <script src="<?php echo e(asset('js/product.js?v=' . $asset_v), false); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            update_table_total();
            update_grand_total();
             $('#search_product').focus();    
            __page_leave_confirmation('#add_purchase_form');

            if ($('#shipping_documents').length) {
                $('#shipping_documents').fileinput({
                    showUpload: false,
                    showPreview: false,
                    browseLabel: '',
                    removeLabel: '',
                    cancelLabel: '',
                });
            }
            
                // Refresh exchange rate button handler
                $(document).on('click', '.refresh_exchange_rate_btn', function(e) {
                    e.preventDefault();
                    var btn = $(this);
                    var currencyCode = $('#location_currency_id').data('currency-code') || '';

                    if (!currencyCode) {
                        toastr.warning('No foreign currency set for this transaction.');
                        return;
                    }

                    btn.prop('disabled', true).find('i').addClass('fa-spin');

                    $.ajax({
                        url: '/get-exchange-rate',
                        type: 'GET',
                        dataType: 'json',
                        data: { currency_code: currencyCode },
                        success: function(response) {
                            if (response.success) {
                                $('input[name="exchange_rate"]').val(response.multiplier);
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

            // Show currency symbol in headings/totals on page load for edit
            var editCurrencySymbol = $('#location_currency_id').data('currency-symbol') || '';
            if (editCurrencySymbol) {
                $('.selected_currency_symbol').text(editCurrencySymbol);
            } else {
                // Show default business currency symbol
                var defaultSymbol = $('#__symbol').val() || '';
                if (defaultSymbol) {
                    $('.selected_currency_symbol').text(defaultSymbol);
                }
            }

        });
    </script>
    <?php echo $__env->make('purchase.partials.purchase_keyboard_shortcuts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('purchase.partials.purchase_keyboard_shortcuts_help_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>