
<?php $__env->startSection('title', __('purchase.add_purchase')); ?>

<?php
    $user_settings = json_decode(auth()->user()->user_settings,true);
?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('purchase.add_purchase'); ?> <i class="fa fa-keyboard-o hover-q text-muted" aria-hidden="true"
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
    'url' => action([\App\Http\Controllers\PurchaseController::class, 'store']),
    'method' => 'post',
    'id' => 'add_purchase_form',
    'files' => true,
    ]); ?>


    <?php if(count($business_locations) == 1): ?>
        <?php
        $default_location = current(array_keys($business_locations->toArray()));
        $search_disable = false;
        ?>
    <?php else: ?>
        <?php
        $default_location = array_key_first($business_locations->toArray());
        
        if(isset($user_settings['default_location']) && !empty($user_settings['default_location'])){
            $default_location = $user_settings['default_location'];
        }
        $search_disable = true;
        ?>
    <?php endif; ?>
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
                    $default_location,
                    ['class' => 'form-control select2', 'id'=>'location_id', 'required', 'style' => 'width: 100%;'],
                    $bl_attributes,
                    ); ?>

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
        <?php if(!empty(session('business.allow_currency_change_purchase'))): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <br>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-money-bill-alt"></i>
                    </span>
                    <select name="location_currency_id" id="location_currency_id_select" class="form-control select2" style="width: 100%;">
                        <option value=""><?php echo app('translator')->get('lang_v1.default_currency'); ?></option>
                    </select>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="col-sm-3 <?php if(empty(session('business.allow_currency_change_purchase'))): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('exchange_rate', __('purchase.p_exchange_rate') . ':*'); ?>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa fa-info"></i>
                    </span>
                    <?php echo Form::number('exchange_rate', $currency_details->p_exchange_rate, [
                    'class' => 'form-control',
                    'id' => 'exchange_rate_hidden',
                    'form' => 'add_purchase_form',
                    'required',
                    'readonly',
                    ]); ?>

                    <button type="button" class="btn btn-outline-info btn-sm refresh_exchange_rate_btn" id="refresh_exchange_rate_btn" title="<?php echo app('translator')->get('lang_v1.fetch_latest_rate'); ?>"><i class="fa fa-sync-alt"></i></button>
                </div>
                <input type="hidden" name="location_currency_id" id="location_currency_id" value="" form="add_purchase_form">
            </div>
        </div>
    </div>
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
    <div class="row">

        <?php if($default_supplier != ''): ?>

            <div class="col-md-3">
            <input type="hidden" id="default_supplier_id" 
				value="<?php echo e($default_supplier_details['id'] ?? '', false); ?>" >
				<?php if($default_supplier_details['entity_type'] === 'business'): ?>
                    <input type="hidden" id="default_supplier_name" value="<?php echo e($default_supplier_details['supplier_business_name'], false); ?>">
                <?php else: ?>
                    <input type="hidden" id="default_supplier_name" value="<?php echo e($default_supplier_details['name'], false); ?>">
                <?php endif; ?>
                <div class="form-group mb-2">
                    <?php echo Form::label('supplier_id', __('purchase.supplier') . ':*'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('contact_id', [], null, [
                        'class' => 'form-control',
                        'placeholder' => __('messages.please_select'),
                        'required',
                        'id' => 'supplier_id', 'style' => 'width: 70%;'
                        ]); ?>

                        <?php if($is_offline): ?>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-sm bg-white btn-flat" id="offline_sync_contacts"><i class="fa fa-sync text-primary"></i></button>
                            </span>
                            <input class="hidden" id="is_offline" value="<?php echo e($is_offline, false); ?>">
                        <?php else: ?>
                        
                            <button class="btn btn-outline-default btn-sm add_new_supplier" type="button" data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>

                            
                        
                        <?php endif; ?>
                    </div>
                </div>
                <small class="text-danger hide contact_due_text"><strong><?php echo app('translator')->get('account.supplier_due'); ?>:</strong>
                    <span></span></small><br>
                <strong>
                    <?php echo app('translator')->get('business.address'); ?>:
                </strong>
                <div id="supplier_address_div"></div>
                <div class="form-group mb-2 mt-2">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="is_inclusive" id="is_inclusive_tax" value="1" <?php echo
                                !empty($common_settings['is_tax_inclusive_purchase']) ? 'Checked' : '' ?>>
                            Is Tax Inclusive?
                        </label>
                    </div>
                </div>
            </div>
        <?php else: ?>

            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('supplier_id', __('purchase.supplier') . ':*'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('contact_id', [], null, [
                        'class' => 'form-control',
                        'placeholder' => __('messages.please_select'),
                        'required',
                        'id' => 'supplier_id', 'style' => 'width: 70%;'
                        ]); ?>

                        <?php if($is_offline): ?>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default bg-white btn-flat" id="offline_sync_contacts"><i class="fa fa-sync text-primary"></i></button>
                        </span>
                        <input class="hidden" id="is_offline" value="<?php echo e($is_offline, false); ?>">
                        <?php else: ?>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default bg-white btn-flat add_new_supplier" data-name=""><i
                                    class="fa fa-plus-circle text-primary fa-lg"></i></button>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <small class="text-danger hide contact_due_text"><strong><?php echo app('translator')->get('account.supplier_due'); ?>:</strong>
                    <span></span></small><br>
                <strong>
                    <?php echo app('translator')->get('business.address'); ?>:
                </strong>
                <div id="supplier_address_div"></div>
                <div class="form-group mb-2 mt-2">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="is_inclusive" id="is_inclusive_tax" value="1" <?php echo
                                !empty($common_settings['is_tax_inclusive_purchase']) ? 'Checked' : '' ?>>
                            Is Tax Inclusive?
                        </label>
                    </div>
                </div>
            </div>
            
        <?php endif; ?>

            <div class="col-md-9">
            <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="form-group mb-2">
                <?php echo Form::label('ref_no', __('purchase.ref_no') . ':'); ?>

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
                <?php echo Form::text('ref_no', null, ['class' => 'form-control', empty($user_settings['enable_purchase_transaction_no']) ? 'readonly' : '',]); ?>

                <b id="ref_no_error" class="error hide"><?php echo app('translator')->get('lang_v1.not_unique', ['name' => __('purchase.ref_no') ]); ?></b>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="form-group mb-2">
                <?php echo Form::label('ref_no_no', __('purchase.ref_no_2') . ':'); ?>

                <?php echo Form::text('ref_no_2', null, ['class' => 'form-control']); ?>

            </div>
        </div>
        <?php echo $__env->make('transaction.partials.back_order_field', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php
            $is_readonly = empty($user_settings['enable_purchase_transaction_date']) ? 'disabled' : '';
        ?>
        <div class="col-sm-6 col-md-4">
            <?php echo Form::hidden('transaction_date', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['id' => 'transaction_date', 'class' => 'form-control transaction_date', 'required']); ?>

            <div class="form-group mb-2">
                <?php echo Form::label('transaction_date_text', __('purchase.purchase_date') . ':*'); ?>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <?php echo Form::text('transaction_date_text', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['id' => 'transaction_date_text', 'class' => 'form-control', $is_readonly, 'required']); ?>

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
                <?php echo Form::select(
                'status',
                $orderStatuses,
                !empty($common_settings['default_purchase_status']) ? $common_settings['default_purchase_status'] : 0,
                ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;'],
                ); ?>

            </div>
        </div>
        
        <div class="col-sm-6 col-md-4">
            <div class="form-group mb-2">
                <?php echo Form::label('pay_term_number', __('contact.pay_term') . ':'); ?>

                <?php
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
                    <?php echo Form::number('pay_term_number', null, [
                    'class' => 'form-control',
                    'placeholder' => __('contact.pay_term'),
                    'style' => 'width: 50%; border-top-right-radius: 0; border-bottom-right-radius: 0;',
                    ]); ?>


                    <?php echo Form::select('pay_term_type', ['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')],
                    null, [
                    'class' => 'form-control',
                    'placeholder' => __('messages.please_select'),
                    'id' => 'pay_term_type',
                    'style' => 'width: 50%; border-top-left-radius: 0; border-bottom-left-radius: 0;',
                    ]); ?>

                </div>
            </div>
        </div>
        <?php if(!empty($common_settings['show_invoice_layout_purchase'])): ?>
            <div class="col-sm-6 col-md-4">
                <div class="form-group mb-2">
                    <?php echo Form::label('invoice_layout_id', __('invoice.invoice_layouts') . ':'); ?>

                    <?php echo Form::select('invoice_layout_id', $invoice_layouts, $bl_attributes[$default_location]['data-purchase_layout_id'], [
                        'class' => 'form-control select2', 'id' => 'purchase_invoice_layout_id']); ?>

                </div>
            </div>
        <?php endif; ?>

        <?php if((!empty($common_settings['enable_load_products_from_qoutation']))): ?>
            <div class="col-sm-6 col-md-4">
                <div class="mb-3">
                    <?php echo Form::label('quotation_ids', __('lang_v1.load_from_quotations') . ':'); ?>

                    <?php echo Form::select('quotation_ids[]', [], null, [
                        'class' => 'form-control select2',
                        'multiple',
                        'id' => 'quotation_ids', 'style' => 'width: 100%;'
                    ]); ?>

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
        $custom_labels = json_decode(session('business.custom_labels'), true);
        ?>

        <?php
        $custom_field_1_label = !empty($custom_labels['purchase']['custom_field_1']) ?
        $custom_labels['purchase']['custom_field_1'] : '';

        $is_custom_field_1_required = !empty($custom_labels['purchase']['is_custom_field_1_required']) &&
        $custom_labels['purchase']['is_custom_field_1_required'] == 1 ? true : false;

        $custom_field_2_label = !empty($custom_labels['purchase']['custom_field_2']) ?
        $custom_labels['purchase']['custom_field_2'] : '';

        $is_custom_field_2_required = !empty($custom_labels['purchase']['is_custom_field_2_required']) &&
        $custom_labels['purchase']['is_custom_field_2_required'] == 1 ? true : false;

        $custom_field_3_label = !empty($custom_labels['purchase']['custom_field_3']) ?
        $custom_labels['purchase']['custom_field_3'] : '';

        $is_custom_field_3_required = !empty($custom_labels['purchase']['is_custom_field_3_required']) &&
        $custom_labels['purchase']['is_custom_field_3_required'] == 1 ? true : false;

        $custom_field_4_label = !empty($custom_labels['purchase']['custom_field_4']) ?
        $custom_labels['purchase']['custom_field_4'] : '';

        $is_custom_field_4_required = !empty($custom_labels['purchase']['is_custom_field_4_required']) &&
        $custom_labels['purchase']['is_custom_field_4_required'] == 1 ? true : false;

        $custom_field_5_label = !empty($custom_labels['purchase']['custom_field_5']) ?
        $custom_labels['purchase']['custom_field_5'] : '';

        $is_custom_field_5_required = !empty($custom_labels['purchase']['is_custom_field_5_required']) &&
        $custom_labels['purchase']['is_custom_field_5_required'] == 1 ? true : false;

        $custom_field_6_label = !empty($custom_labels['purchase']['custom_field_6']) ?
        $custom_labels['purchase']['custom_field_6'] : '';

        $is_custom_field_6_required = !empty($custom_labels['purchase']['is_custom_field_6_required']) &&
        $custom_labels['purchase']['is_custom_field_6_required'] == 1 ? true : false;

        $custom_field_7_label = !empty($custom_labels['purchase']['custom_field_7']) ?
        $custom_labels['purchase']['custom_field_7'] : '';

        $is_custom_field_7_required = !empty($custom_labels['purchase']['is_custom_field_7_required']) &&
        $custom_labels['purchase']['is_custom_field_7_required'] == 1 ? true : false;

        $custom_field_8_label = !empty($custom_labels['purchase']['custom_field_8']) ?
        $custom_labels['purchase']['custom_field_8'] : '';

        $is_custom_field_8_required = !empty($custom_labels['purchase']['is_custom_field_8_required']) &&
        $custom_labels['purchase']['is_custom_field_8_required'] == 1 ? true : false;

        $custom_field_9_label = !empty($custom_labels['purchase']['custom_field_9']) ?
        $custom_labels['purchase']['custom_field_9'] : '';

        $is_custom_field_9_required = !empty($custom_labels['purchase']['is_custom_field_9_required']) &&
        $custom_labels['purchase']['is_custom_field_9_required'] == 1 ? true : false;

        $custom_field_10_label = !empty($custom_labels['purchase']['custom_field_10']) ?
        $custom_labels['purchase']['custom_field_10'] : '';

        $is_custom_field_10_required = !empty($custom_labels['purchase']['is_custom_field_10_required']) &&
        $custom_labels['purchase']['is_custom_field_10_required'] == 1 ? true : false;

        $custom_field_11_label = !empty($custom_labels['purchase']['custom_field_11']) ?
        $custom_labels['purchase']['custom_field_11'] : '';

        $is_custom_field_11_required = !empty($custom_labels['purchase']['is_custom_field_11_required']) &&
        $custom_labels['purchase']['is_custom_field_11_required'] == 1 ? true : false;

        $custom_field_12_label = !empty($custom_labels['purchase']['custom_field_12']) ?
        $custom_labels['purchase']['custom_field_12'] : '';

        $is_custom_field_12_required = !empty($custom_labels['purchase']['is_custom_field_12_required']) &&
        $custom_labels['purchase']['is_custom_field_12_required'] == 1 ? true : false;

        $custom_field_13_label = !empty($custom_labels['purchase']['custom_field_13']) ?
        $custom_labels['purchase']['custom_field_13'] : '';

        $is_custom_field_13_required = !empty($custom_labels['purchase']['is_custom_field_13_required']) &&
        $custom_labels['purchase']['is_custom_field_13_required'] == 1 ? true : false;

        $custom_field_14_label = !empty($custom_labels['purchase']['custom_field_14']) ?
        $custom_labels['purchase']['custom_field_14'] : '';

        $is_custom_field_14_required = !empty($custom_labels['purchase']['is_custom_field_14_required']) &&
        $custom_labels['purchase']['is_custom_field_14_required'] == 1 ? true : false;
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

                <?php echo Form::text('custom_field_1', null, [
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

                <?php echo Form::text('custom_field_2', null, [
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

                <?php echo Form::text('custom_field_3', null, [
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

                <?php echo Form::text('custom_field_4', null, [
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

                <?php echo Form::text('custom_field_5', null, [
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

                <?php echo Form::text('custom_field_6', null, [
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

                <?php echo Form::text('custom_field_7', null, [
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

                <?php echo Form::text('custom_field_8', null, [
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

                <?php echo Form::text('custom_field_9', null, [
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

                <?php echo Form::text('custom_field_10', null, [
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

                <?php echo Form::text('custom_field_11', null, [
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

                <?php echo Form::text('custom_field_12', null, [
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

                <?php echo Form::text('custom_field_13', null, [
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

                <?php echo Form::text('custom_field_14', null, [
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

                <?php echo Form::select('purchase_order_ids[]', [], null, [
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
            <button type="button" class="btn btn-secondary btn-flat" data-bs-toggle="modal"
                data-bs-target="#import_purchase_products_modal"><?php echo app('translator')->get('product.import_products'); ?></button>
        </div>
        <div class="col-sm-8">
            <div class="form-group mb-2">
                <div class="input-group">
                    
                        <button type="button" class="btn btn-default bg-white btn-flat" id="open_products_search_modal" title="<?php echo e(__('lang_v1.products_search'), false); ?>"><i class="fas fa-search"></i></button>
                    
                    <?php echo Form::text('search_product', null, [
                    'class' => 'form-control',
                    'id' => 'search_product',
                    'placeholder' => __('lang_v1.search_product_placeholder'),
                    'disabled' => $search_disable,
                    ]); ?>

                </div>
            </div>
        </div>
        <?php if($is_offline): ?>
            
                <button type="button" class="btn btn-secondary bg-white btn-flat" id="offline_sync_products"><i class="fa fa-sync text-primary"></i></button>
            
        <?php else: ?>
        <div class="col-sm-2">
            <div class="form-group mb-2">
                <button tabindex="-1" type="button" class="btn btn-light btn-modal quick_add_product_btn"
                    data-href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'quickAdd']), false); ?>"
                    data-container=".quick_add_product_modal"><i class="fa fa-plus"></i>
                    <?php echo app('translator')->get('product.add_new_product'); ?> </button>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php
    $hide_discount = '';
    if (empty($common_settings['enable_inline_discount_purchase'])) {
     $hide_discount = 'hide';
    }
    $hide_total_discount = '';
    if (empty($common_settings['enable_inline_total_discount_purchase'])) {
     $hide_total_discount = 'hide';
    }
    $hide_discount2 = '';
    if (empty($common_settings['enable_inline_discount2_purchase'])) {
     $hide_discount2 = 'hide';
    }
    $hide_total_discount2 = '';
    if (empty($common_settings['enable_inline_total_discount2_purchase'])) {
     $hide_total_discount2 = 'hide';
    }
    $hide_discounted_cost = '';
    if (empty($common_settings['enable_inline_discount_purchase']) && empty($common_settings['enable_inline_total_discount_purchase']) && empty($common_settings['enable_inline_total_discount2_purchase'])) {
        $hide_discounted_cost = 'hide';
    }
    $hide_tax = '';
    // if( session()->get('business.enable_inline_tax') == 0){
    // $hide_tax = 'hide';
    // }
    if (empty($common_settings['enable_inline_tax_purchase']) || $taxes->isEmpty()) {
        $hide_tax = 'hide';
    }
    if (empty($common_settings['enable_serial_number'])) {
        $hide_sr_imei = 'hide';
    }
    $hide_scheme_qty = '';
    if (empty($common_settings['enable_scheme_quantity_purchase'])) {
        $hide_scheme_qty = 'hide';
    }
    $hide_brand = '';
    if (empty($user_settings['purchase_show_brand_column'])) {
        $hide_brand = 'hide';
    }
    $hide_category = '';
    if (empty($user_settings['purchase_show_category_column'])) {
        $hide_category = 'hide';
    }
    $hide_lot = '';
    if (session('business.enable_lot_number')){
        $hide_lot = 'hide';
    }
    $hide_expiry = '';
    if (session('business.enable_product_expiry')){
        $hide_expiry = 'hide';
    }   
    $hide_sp = '';
    if(!session('business.enable_editing_product_from_purchase')){
        $hide_sp = 'hide';
    }
    ?>
    
    <div class="row">
        <div class="col-sm-12">
            <div class="sell_product_div">
                <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
<table class="table table-condensed table-bordered table-th-skin table-striped"
                    id="purchase_entry_table">
                    <thead>
                        <tr>
                            <th class="text-nowrap" style="width:1%; min-width:30px">#</th>
                            <th class="text-nowrap" style="width:1%; min-width:50px">SKU</th>
                            <th class="text-nowrap" style="width:100%">Product</th>
                            <th class="text-nowrap <?php echo e($hide_brand, false); ?>">Brand</th>
                            <th class="text-nowrap <?php echo e($hide_category, false); ?>">Category</th>
                            <th class="text-nowrap <?php echo e($hide_sr_imei, false); ?>">Serial / IMEI</th>
                            <th class="text-nowrap" style="width:auto">Qty</th>
                            <th class="text-nowrap <?php echo e($hide_scheme_qty, false); ?>" style="width:auto">Scheme <br> Qty</th>
                            <th class="text-nowrap <?php echo e($hide_scheme_qty, false); ?> <?php echo e($hide_tax, false); ?>" id="purchase_scheme_tax_heading">Tax</th>
                            <th class="text-nowrap text-end">Unit Cost<br><span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
                            <th class="text-nowrap <?php echo e($hide_discount, false); ?>" id="purchase_discount_heading">Unit <br> Discount</th>
                            <th class="text-nowrap <?php echo e($hide_total_discount, false); ?>" id="purchase_total_discount_heading">Total <br> Discount</th>
                            <th class="text-nowrap <?php echo e($hide_discount2, false); ?>" id="purchase_discount2_heading">Discount 2</th>
                            <th class="text-nowrap <?php echo e($hide_total_discount2, false); ?>" id="purchase_total_discount2_heading">Total <br> Discount 2</th>
                            <th class="text-nowrap text-end <?php echo e($hide_discounted_cost, false); ?>">Discounted <br> Cost <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
                            <th class="text-nowrap text-end <?php echo e($hide_tax, false); ?>">Subtotal<br><span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
                            <th class="text-nowrap <?php echo e($hide_tax, false); ?>" id="purchase_tax_heading">Tax</th>
                            <th class="text-nowrap text-end <?php echo e($hide_tax, false); ?>">Tax Amount<br>Line Total</th>
                            <th class="text-nowrap text-end <?php echo e($hide_tax, false); ?>">Cost Inc. <br> Tax <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
                            <th class="text-nowrap text-end">Line Total<br><span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
                            <th class="text-nowrap <?php if(!session('business.enable_editing_product_from_purchase')): ?> hide <?php endif; ?>">
                                GP %
                            </th>
                            <th class="text-nowrap text-end <?php if(!session('business.enable_editing_product_from_purchase')): ?> hide <?php endif; ?>">
                                <?php echo app('translator')->get('purchase.unit_selling_price'); ?><br><small>(<?php echo app('translator')->get('product.inc_of_tax'); ?>)</small> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>
                            </th>
                            <th class="text-nowrap text-end <?php if(!session('business.enable_editing_product_from_purchase') || !session('business.enable_sub_units')): ?> hide <?php endif; ?>">
                                Pack Price<br><small>(<?php echo app('translator')->get('product.inc_of_tax'); ?>)</small> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>
                            </th>
                            <?php if(!empty($mrp_group)): ?>
                            <th class="text-nowrap text-end <?php if(!session('business.enable_editing_product_from_purchase')): ?> hide <?php endif; ?>">
                                <?php echo e($mrp_group->name, false); ?><br><small>(<?php echo app('translator')->get('product.inc_of_tax'); ?>)</small> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>
                            </th>
                            <?php endif; ?>
                            <?php if(session('business.enable_lot_number') || session('business.enable_product_expiry')): ?>
                            <th class="text-nowrap">
                                <?php if(session('business.enable_lot_number')): ?>
                                    <?php if(!empty($common_settings['lot_number_label'])): ?> <?php echo e($common_settings['lot_number_label'], false); ?> <?php else: ?> Lot <br> Number <?php endif; ?>
                                <?php endif; ?>
                                <?php if(session('business.enable_product_expiry')): ?>
                                <?php echo app('translator')->get('product.mfg_date'); ?> / <?php echo app('translator')->get('product.exp_date'); ?>
                                <?php endif; ?>
                            </th>
                            <?php endif; ?>
                            <th class="text-nowrap" style="width:1%; min-width:30px"><i class="fa fa-trash" aria-hidden="true"></i></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
</div>
            </div>
            <input type="hidden" id="row_count" value="0">
        </div>
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
                            <th class="text-end text-nowrap"><?php echo app('translator')->get('lang_v1.total_quantity'); ?>:</th>
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
                            <td class="text-end"><strong><span id="total_subtotal" class="display_currency"></span></strong><input type="hidden" id="total_subtotal_input" value=0 name="total_before_tax"></td>
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
                        <div class="form-group mb-2">
                            <?php echo Form::label('discount_type', __('purchase.discount_type') . ':'); ?>

                            <?php echo Form::select(
                            'discount_type',
                            ['' => __('lang_v1.none'), 'fixed' => __('lang_v1.fixed'), 'percentage' =>
                            __('lang_v1.percentage')],
                            !empty($common_settings['default_invoice_discount_type_purchase']) ? $common_settings['default_invoice_discount_type_purchase'] : '',
                            ['class' => 'form-control select2'],
                            ); ?>

                        </div>
                    </td>
                    <td class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('discount_amount', __('purchase.discount_amount') . ':'); ?>

                            <?php echo Form::text('discount_amount', number_format(!empty($common_settings['default_invoice_discount_purchase']) ? $common_settings['default_invoice_discount_purchase'] : 0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'required']); ?>

                        </div>
                    </td>
                    <td class="col-md-3">
                        &nbsp;
                    </td>
                    <td class="col-md-3">
                        <b><?php echo app('translator')->get('purchase.discount'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>:</b>(-)
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
                            ['' => __('lang_v1.none'), 'fixed' => __('lang_v1.fixed'), 'percentage' =>
                            __('lang_v1.percentage')],
                            !empty($common_settings['default_invoice_discount2_type_purchase']) ? $common_settings['default_invoice_discount2_type_purchase'] : '',
                            ['class' => 'form-control select2'],
                            ); ?>

                        </div>
                    </td>
                    <td class="col-md-3">
                        <div class="mb-3">
                            <?php echo Form::label('discount2_amount', __('purchase.discount2_amount') . ':'); ?>

                            <?php echo Form::text('discount2_amount', number_format(!empty($common_settings['default_invoice_discount2_purchase']) ? $common_settings['default_invoice_discount2_purchase'] : 0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'required']); ?>

                        </div>
                    </td>
                    <td class="col-md-3">
                        &nbsp;  
                    </td>
                    <td class="col-md-3">
                        <b><?php echo app('translator')->get('purchase.discount'); ?> 2 <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>:</b>(-)
                        <span id="discount2_calculated_amount" class="display_currency">0</span>
                    </td>
                </tr>
                <?php endif; ?>
                

                <?php if(!empty($common_settings['enable_total_tax_purchase'])): ?>
                <tr>
                    <td>
                        <div class="form-group mb-2">
                            <?php echo Form::label('tax_id', __('purchase.purchase_tax') . ':'); ?>

                            <select name="tax_id" id="tax_id" class="form-control select2"
                                placeholder="'Please Select'">
                                <option value="" data-tax_amount="0" data-tax_type="fixed" selected>
                                    <?php echo app('translator')->get('lang_v1.none'); ?></option>
                                <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($tax->id, false); ?>" data-tax_amount="<?php echo e($tax->amount, false); ?>"
                                    data-tax_type="<?php echo e($tax->type, false); ?>"><?php echo e($tax->name, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php echo Form::hidden('tax_amount', 0, ['id' => 'tax_amount']); ?>

                            <?php echo Form::hidden('tax_type', 'fixed', ['id' => 'tax_type']); ?>

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
                                <i class="fa fa-plus-circle text-success"></i>
                            </a>
                            <div class="note-wrapper" style="display:none;">
                                <?php echo Form::textarea('additional_notes', null, ['class' => 'form-control', 'rows' => 3]); ?>

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

                <?php echo Form::text('shipping_details', null, ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="col-md-4 col-md-offset-4">
            <div class="form-group mb-2">
                <?php echo Form::label('shipping_charges', '(+) ' . __('purchase.additional_shipping_charges') . ':'); ?>

                <?php echo Form::text('shipping_charges', 0, ['id' => 'shipping_charges', 'class' => 'form-control input_number']); ?>

            </div>
        </div>
        <?php if(in_array('upload_documents', $enabled_modules)): ?>
        <div class="col-md-4">
            <div class="form-group mb-2">
                <?php echo Form::label('shipping_documents', __('lang_v1.shipping_documents') . ':'); ?>

                <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                <?php echo Form::file('shipping_documents[]', ['id' => 'shipping_documents', 'multiple', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <?php
        $shipping_custom_label_1 = !empty($custom_labels['purchase_shipping']['custom_field_1']) ?
        $custom_labels['purchase_shipping']['custom_field_1'] : '';

        $is_shipping_custom_field_1_required = !empty($custom_labels['purchase_shipping']['is_custom_field_1_required'])
        && $custom_labels['purchase_shipping']['is_custom_field_1_required'] == 1 ? true : false;

        $shipping_custom_label_2 = !empty($custom_labels['purchase_shipping']['custom_field_2']) ?
        $custom_labels['purchase_shipping']['custom_field_2'] : '';

        $is_shipping_custom_field_2_required = !empty($custom_labels['purchase_shipping']['is_custom_field_2_required'])
        && $custom_labels['purchase_shipping']['is_custom_field_2_required'] == 1 ? true : false;

        $shipping_custom_label_3 = !empty($custom_labels['purchase_shipping']['custom_field_3']) ?
        $custom_labels['purchase_shipping']['custom_field_3'] : '';

        $is_shipping_custom_field_3_required = !empty($custom_labels['purchase_shipping']['is_custom_field_3_required'])
        && $custom_labels['purchase_shipping']['is_custom_field_3_required'] == 1 ? true : false;

        $shipping_custom_label_4 = !empty($custom_labels['purchase_shipping']['custom_field_4']) ?
        $custom_labels['purchase_shipping']['custom_field_4'] : '';

        $is_shipping_custom_field_4_required = !empty($custom_labels['purchase_shipping']['is_custom_field_4_required'])
        && $custom_labels['purchase_shipping']['is_custom_field_4_required'] == 1 ? true : false;

        $shipping_custom_label_5 = !empty($custom_labels['purchase_shipping']['custom_field_5']) ?
        $custom_labels['purchase_shipping']['custom_field_5'] : '';

        $is_shipping_custom_field_5_required = !empty($custom_labels['purchase_shipping']['is_custom_field_5_required'])
        && $custom_labels['purchase_shipping']['is_custom_field_5_required'] == 1 ? true : false;
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

                <?php echo Form::text('shipping_custom_field_1', null, [
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

                <?php echo Form::text('shipping_custom_field_2', null, [
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

                <?php echo Form::text('shipping_custom_field_3', null, [
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

                <?php echo Form::text('shipping_custom_field_4', null, [
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

                <?php echo Form::text('shipping_custom_field_5', null, [
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
                    class="fas fa-plus"></i> <?php echo app('translator')->get('lang_v1.add_additional_expenses'); ?> <i
                    class="fas fa-chevron-down"></i></button>
        </div>
        <div class="col-md-8 col-md-offset-4" id="additional_expenses_div" style="display: none;">
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
                            <?php echo Form::text('additional_expense_key_1', null, [
                            'class' => 'form-control',
                            'id' => 'additional_expense_key_1',
                            ]); ?>

                        </td>
                        <td>
                            <?php echo Form::text('additional_expense_value_1', 0, [
                            'class' => 'form-control input_number',
                            'id' => 'additional_expense_value_1',
                            ]); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo Form::text('additional_expense_key_2', null, [
                            'class' => 'form-control',
                            'id' => 'additional_expense_key_2',
                            ]); ?>

                        </td>
                        <td>
                            <?php echo Form::text('additional_expense_value_2', 0, [
                            'class' => 'form-control input_number',
                            'id' => 'additional_expense_value_2',
                            ]); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo Form::text('additional_expense_key_3', null, [
                            'class' => 'form-control',
                            'id' => 'additional_expense_key_3',
                            ]); ?>

                        </td>
                        <td>
                            <?php echo Form::text('additional_expense_value_3', 0, [
                            'class' => 'form-control input_number',
                            'id' => 'additional_expense_value_3',
                            ]); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo Form::text('additional_expense_key_4', null, [
                            'class' => 'form-control',
                            'id' => 'additional_expense_key_4',
                            ]); ?>

                        </td>
                        <td>
                            <?php echo Form::text('additional_expense_value_4', 0, [
                            'class' => 'form-control input_number',
                            'id' => 'additional_expense_value_4',
                            ]); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo Form::text('additional_expense_key_5', null, [
                            'class' => 'form-control',
                            'id' => 'additional_expense_key_5',
                            ]); ?>

                        </td>
                        <td>
                            <?php echo Form::text('additional_expense_value_5', 0, [
                            'class' => 'form-control input_number',
                            'id' => 'additional_expense_value_5',
                            ]); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo Form::text('additional_expense_key_6', null, [
                            'class' => 'form-control',
                            'id' => 'additional_expense_key_6',
                            ]); ?>

                        </td>
                        <td>
                            <?php echo Form::text('additional_expense_value_6', 0, [
                            'class' => 'form-control input_number',
                            'id' => 'additional_expense_value_6',
                            ]); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo Form::text('additional_expense_key_7', null, [
                            'class' => 'form-control',
                            'id' => 'additional_expense_key_7',
                            ]); ?>

                        </td>
                        <td>
                            <?php echo Form::text('additional_expense_value_7', 0, [
                            'class' => 'form-control input_number',
                            'id' => 'additional_expense_value_7',
                            ]); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo Form::text('additional_expense_key_8', null, [
                            'class' => 'form-control',
                            'id' => 'additional_expense_key_8',
                            ]); ?>

                        </td>
                        <td>
                            <?php echo Form::text('additional_expense_value_8', 0, [
                            'class' => 'form-control input_number',
                            'id' => 'additional_expense_value_8',
                            ]); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo Form::text('additional_expense_key_9', null, [
                            'class' => 'form-control',
                            'id' => 'additional_expense_key_9',
                            ]); ?>

                        </td>
                        <td>
                            <?php echo Form::text('additional_expense_value_9', 0, [
                            'class' => 'form-control input_number',
                            'id' => 'additional_expense_value_9',
                            ]); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo Form::text('additional_expense_key_10', null, [
                            'class' => 'form-control',
                            'id' => 'additional_expense_key_10',
                            ]); ?>

                        </td>
                        <td>
                            <?php echo Form::text('additional_expense_value_10', 0, [
                            'class' => 'form-control input_number',
                            'id' => 'additional_expense_value_10',
                            ]); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo Form::text('additional_expense_key_11', null, [
                            'class' => 'form-control',
                            'id' => 'additional_expense_key_11',
                            ]); ?>

                        </td>
                        <td>
                            <?php echo Form::text('additional_expense_value_11', 0, [
                            'class' => 'form-control input_number',
                            'id' => 'additional_expense_value_11',
                            ]); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo Form::text('additional_expense_key_12', null, [
                            'class' => 'form-control',
                            'id' => 'additional_expense_key_12',
                            ]); ?>

                        </td>
                        <td>
                            <?php echo Form::text('additional_expense_value_12', 0, [
                            'class' => 'form-control input_number',
                            'id' => 'additional_expense_value_12',
                            ]); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo Form::text('additional_expense_key_13', null, [
                            'class' => 'form-control',
                            'id' => 'additional_expense_key_13',
                            ]); ?>

                        </td>
                        <td>
                            <?php echo Form::text('additional_expense_value_13', 0, [
                            'class' => 'form-control input_number',
                            'id' => 'additional_expense_value_13',
                            ]); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo Form::text('additional_expense_key_14', null, [
                            'class' => 'form-control',
                            'id' => 'additional_expense_key_14',
                            ]); ?>

                        </td>
                        <td>
                            <?php echo Form::text('additional_expense_value_14', 0, [
                            'class' => 'form-control input_number',
                            'id' => 'additional_expense_value_14',
                            ]); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo Form::text('additional_expense_key_15', null, [
                            'class' => 'form-control',
                            'id' => 'additional_expense_key_15',
                            ]); ?>

                        </td>
                        <td>
                            <?php echo Form::text('additional_expense_value_15', 0, [
                            'class' => 'form-control input_number',
                            'id' => 'additional_expense_value_15',
                            ]); ?>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <hr>
        <div class="col-md-12 text-right">
            <?php if(!empty(session('business.allow_currency_change_purchase'))): ?>
            <b><?php echo app('translator')->get('purchase.purchase_total_base_currency'); ?> <span class="badge bg-secondary" style="font-size:11px;"><?php echo e(session('currency')['symbol'] ?? '', false); ?></span>: </b><span id="grand_total_base_currency" class="display_currency"
                data-currency_symbol='true'>0</span>
             | 
            <?php endif; ?>
            <?php echo Form::hidden('final_total', 0, ['id' => 'grand_total_hidden']); ?>

            <b><?php echo app('translator')->get('purchase.purchase_total'); ?>: <span class="selected_currency_symbol badge bg-info" style="font-size:11px;"></span></b><span id="grand_total" class="display_currency"
                data-currency_symbol='true'>0</span>
        </div>
    </div>
    <?php echo $__env->renderComponent(); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase.payments')): ?>
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('purchase.add_payment'), 'id'=>'payment_rows_div']); ?>
    <div class="box-body payment_row">
        <div class="row">
            <div class="col-md-12">
                <strong><?php echo app('translator')->get('lang_v1.advance_balance'); ?>:</strong> <span id="advance_balance_text">0</span>
                <?php echo Form::hidden('advance_balance', null, [
                'id' => 'advance_balance',
                'data-error-msg' => __('lang_v1.required_advance_balance_not_available'),
                ]); ?>

            </div>
        </div>
        <?php echo $__env->make('sale_pos.partials.payment_row_form', [
        'row_index' => 0,
        'show_date' => true,
        'show_denomination' => true,
        'transaction_type' => 'purchase',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <div class="float-end"><strong><?php echo app('translator')->get('purchase.payment_due'); ?>:</strong> <span
                        id="payment_due">0.00</span></div>
            </div>
        </div>
        <br>
    </div>
    <?php echo $__env->renderComponent(); ?>
    <?php endif; ?>
    <input type="hidden" id="save_and_print" name="save_and_print" value="">
    
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
    // Show default business currency symbol on page load
    var defaultCurrencySymbol = $('#__symbol').val() || '';
    if (defaultCurrencySymbol) {
        $('.selected_currency_symbol').text(defaultCurrencySymbol);
    }

    $('#supplier_id').focus();    
    __page_leave_confirmation('#add_purchase_form');
    $('.paid_on').datetimepicker({
        format: moment_date_format + ' ' + moment_time_format,
        ignoreReadonly: true,
    });
    $('.clearance_date').datetimepicker({
        format: moment_date_format + ' ' + moment_time_format,
        ignoreReadonly: true,
    });

    // if ($('.payment_types_dropdown').length) {
    //     $('.payment_types_dropdown').change();
    // }
    
    set_payment_type_dropdown();
    set_location_currency_dropdown();

    $('select#location_id').change(function() {
        set_payment_type_dropdown();
        set_location_currency_dropdown();
    });

    // Track whether the purchase-date calendar is currently open
    var purchaseDatePickerOpen = false;
    $('#transaction_date_text').on('dp.show', function() {
        purchaseDatePickerOpen = true;
    }).on('dp.hide', function() {
        purchaseDatePickerOpen = false;
    });

    // Update only the time of transaction_date_text every 5 seconds (skip when calendar is open)
    setInterval(function() {
        if (purchaseDatePickerOpen) {
            return;
        }
        var picker = $('#transaction_date_text').data('DateTimePicker');
        if (picker && picker.date()) {
            var currentDate = picker.date().clone();
            var now = moment();
            currentDate.hours(now.hours()).minutes(now.minutes()).seconds(now.seconds());
            picker.date(currentDate);
        }
    }, 5000);
    
});

$(document).on('change', '.payment_types_dropdown', function(e) {
    var default_accounts = $('select#location_id').length ? $('select#location_id').find(':selected').data('default_payment_accounts') : [];
    var payment_types_dropdown = $('.payment_types_dropdown');
    var payment_type = payment_types_dropdown.val();
    var payment_row = payment_types_dropdown.closest('.payment_row');
    var row_index = payment_row.find('.payment_row_index').val();

    var account_dropdown = payment_row.find('select#account_' + row_index);
    if (payment_type && payment_type != 'advance') {
        var default_account = default_accounts && default_accounts[payment_type]['account'] ?
            default_accounts[payment_type]['account'] : '';
        if (account_dropdown.length && default_accounts) {
            account_dropdown.val(default_account);
            account_dropdown.change();
        }
    }

    if (payment_type == 'advance') {
        if (account_dropdown) {
            account_dropdown.prop('disabled', true);
            account_dropdown.closest('.form-group').addClass('hide');
        }
    } else {
        if (account_dropdown) {
            account_dropdown.prop('disabled', false);
            account_dropdown.closest('.form-group').removeClass('hide');
        }
    }

    // sub_method = default_accounts[payment_type]['sub_method'];
    // if(sub_method){
    //     payment_row.find('.payment_details_div')
    //     .each(function() {
    //         if ($(this).attr('data-type') == sub_method) {
    //             sub_to_show = $(this);
    //         }else {
    //             if (!$(this).hasClass('hide')) {
    //                 $(this).addClass('hide');
    //             }
    //         }
    //     });

    //     if (sub_to_show && sub_to_show.hasClass('hide')) {
    //         sub_to_show.removeClass('hide');
    //         sub_to_show.find('input').filter(':visible:first').focus()
    //     }
    // }
});

$(document).on('change', '#location_id', function(e) {
    var default_accounts = $('select#location_id').length ? $('select#location_id').find(':selected').data('default_payment_accounts') : [];
    var payment_types_dropdown = $('.payment_types_dropdown');
    var payment_type = payment_types_dropdown.val();
    var payment_row = payment_types_dropdown.closest('.payment_row');
    var row_index = payment_row.find('.payment_row_index').val();

    var account_dropdown = payment_row.find('select#account_' + row_index);
    if (payment_type && payment_type != 'advance') {
        var default_account = default_accounts && default_accounts[payment_type]['account'] ?
            default_accounts[payment_type]['account'] : '';
        if (account_dropdown.length && default_accounts) {
            account_dropdown.val(default_account);
            account_dropdown.change();
        }
    }

    if (payment_type == 'advance') {
        if (account_dropdown) {
            account_dropdown.prop('disabled', true);
            account_dropdown.closest('.form-group mb-2').addClass('hide');
        }
    } else {
        if (account_dropdown) {
            account_dropdown.prop('disabled', false);
            account_dropdown.closest('.form-group mb-2').removeClass('hide');
        }
    }
});

function set_payment_type_dropdown() {
    var payment_settings = $('#location_id').find(':selected').data('default_payment_accounts');
    var payment_labels = $('#location_id').find(':selected').data('payment_labels');
    payment_settings = payment_settings ? payment_settings : [];
    var default_method = null;
    enabled_payment_types = [];
    for (var key in payment_settings) {
        if (payment_settings[key] && payment_settings[key]['is_enabled']) {
            enabled_payment_types.push(key);
        }
        if (payment_settings[key] && payment_settings[key]['is_default']) {
            default_method = key;
        }
    }

    // Hide/show entire payment section based on whether all methods are disabled
    var payments_disabled = $('#location_id').find(':selected').data('payments_disabled');
    if (payments_disabled) {
        $('#payment_rows_div').addClass('hide');
    } else {
        $('#payment_rows_div').removeClass('hide');
    }

    if (enabled_payment_types.length) {
        $(".payment_types_dropdown > option").each(function() {
            //skip if advance
            if ($(this).val() && $(this).val() != 'advance') {
                if (enabled_payment_types.indexOf($(this).val()) != -1) {
                    if(payment_labels && payment_labels[$(this).val()] != null && payment_labels[$(this).val()] != undefined){
                        $(this).text(payment_labels[$(this).val()]);
                    }
                    $(this).removeClass('hide');
                } else {
                    $(this).addClass('hide');
                }
            }
        });
    }
    if(default_method){
        sub_method = payment_settings[default_method]['sub_method'];
        if(sub_method){
            $(".payment_types_dropdown").val(default_method).trigger('change');
            $("input[name='payment[0][sub_method]'][value='"+sub_method+"']").prop('checked', true).trigger('change');
        }
    }
    
}

function set_location_currency_dropdown() {
    var loc_currencies = $('#location_id').find(':selected').data('loc_currencies');
    var $dropdown = $('#location_currency_id_select');
    
    // Clear existing options except the first one (please select)
    $dropdown.find('option:not(:first)').remove();
    
    if (loc_currencies && loc_currencies.length > 0) {
        $.each(loc_currencies, function(index, currency) {
            var optionText = currency.code + ' (' + currency.symbol + ') - ' + currency.multiplier;
            var option = $('<option></option>')
                .val(currency.multiplier)
                .text(optionText)
                .attr('data-id', currency.id)
                .attr('data-country', currency.country)
                .attr('data-currency', currency.currency)
                .attr('data-code', currency.code)
                .attr('data-symbol', currency.symbol)
                .attr('data-thousand_separator', currency.thousand_separator)
                .attr('data-decimal_separator', currency.decimal_separator)
                .attr('data-multiplier', currency.multiplier);
            $dropdown.append(option);
        });
    }
    
    // Re-initialize select2 if used
    if ($dropdown.hasClass('select2-hidden-accessible')) {
        $dropdown.select2('destroy').select2();
    }
}

$(document).ready(function() {
    if ($('#shipping_documents').length) {
        $('#shipping_documents').fileinput({
            showUpload: false,
            showPreview: false,
            browseLabel: '',
            removeLabel: '',
            cancelLabel: '',
        });
    }

    var $dropdown = $('#location_currency_id_select');
    $dropdown.on('change', function() {
        var selected = $(this).find(':selected');
        var loc_currency_id = selected.data('id');
        var exchangeRate = selected.data('multiplier');
        var code = selected.data('code');
        var symbol = selected.data('symbol');
        var thousand = selected.data('thousand_separator');
        var decimal = selected.data('decimal_separator');
        if(exchangeRate == undefined){
            
            // Update exchange_rate_hidden
            $('#exchange_rate_hidden').val(1);
            $('#exchange_rate_hidden').attr('readonly', true);
            $('#payment_rows_div').removeClass('hide');
            // Update currency details
            $('#p_code').val($('#__code').val());
            $('#p_symbol').val($('#__symbol').val());
            $('#p_thousand').val($('#__thousand').val());
            $('#p_decimal').val($('#__decimal').val());
            $('#location_currency_id').val('');

            __p_currency_code = $('#__code').val();
            __p_currency_symbol = $('#__symbol').val();
            __p_currency_thousand_separator = $('#__thousand').val();
            __p_currency_decimal_separator = $('#__decimal').val();

            // Show default business currency symbol
            $('.selected_currency_symbol').text($('#__symbol').val() || '');
            
        }else{
            // Update exchange_rate_hidden
            $('#exchange_rate_hidden').attr('readonly', false);
            $('#exchange_rate_hidden').val(exchangeRate);
            $('#payment_rows_div').addClass('hide');
            // Update currency details
            $('#p_code').val(code);
            $('#p_symbol').val(symbol);
            $('#p_thousand').val(thousand);
            $('#p_decimal').val(decimal);
            $('#location_currency_id').val(loc_currency_id);

            __p_currency_symbol = symbol;
            __p_currency_thousand_separator = thousand;
            __p_currency_decimal_separator = decimal;

            // Show currency symbol in headings and totals
            $('.selected_currency_symbol').text(symbol);
        }
    
    });
});

// Refresh exchange rate button handler
$(document).on('click', '.refresh_exchange_rate_btn', function(e) {
    e.preventDefault();
    var btn = $(this);
    var currencyCode = '';

    // Get currency code from the selected currency dropdown
    var selected = $('#location_currency_id_select').find(':selected');
    if (selected.val() && selected.data('code')) {
        currencyCode = selected.data('code');
    }

    if (!currencyCode) {
        toastr.warning('Please select a currency first.');
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
                $('#exchange_rate_hidden').val(response.multiplier);
                // Also update the dropdown option's multiplier data
                selected.attr('data-multiplier', response.multiplier);
                selected.val(response.multiplier);
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

</script>

<?php echo $__env->make('purchase.partials.purchase_keyboard_shortcuts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('purchase.partials.purchase_keyboard_shortcuts_help_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>