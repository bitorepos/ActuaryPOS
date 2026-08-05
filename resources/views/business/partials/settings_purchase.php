<!--Purchase related settings -->
<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('purchase_invoice_design_id', __('lang_v1.invoice_format') . ':'); ?>

                <?php echo Form::select('common_settings[purchase_invoice_design_id]', $invoice_designs, 
                    $common_settings['purchase_invoice_design_id'] ?? null,
                    ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

            </div>
        </div>
        <div class="clearfix"></div>
        <?php if(!config('constants.disable_purchase_in_other_currency', true)): ?>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('purchase_in_diff_currency', 1, $business->purchase_in_diff_currency ,
                        [ 'class' => 'form-check-input', 'id' => 'purchase_in_diff_currency']); ?>

                        <?php echo e(__( 'purchase.allow_purchase_different_currency' ), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.purchase_different_currency') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4 <?php if($business->purchase_in_diff_currency != 1): ?> hide <?php endif; ?>"
            id="settings_purchase_currency_div">
            <div class="form-group mb-3">
                <?php echo Form::label('purchase_currency_id', __('purchase.purchase_currency') . ':'); ?>

                <div class="input-group">
                    
                    <label class="input-group-text"><i class="fas fa-money-bill-alt"></i></label>
                    <?php echo Form::select('purchase_currency_id', $currencies, $business->purchase_currency_id, ['class' =>
                    'form-control select2', 'placeholder' => __('business.currency'), 'required', 'style' => 'width: 75%
                    !important']); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-4 <?php if($business->purchase_in_diff_currency != 1): ?> hide <?php endif; ?>"
            id="settings_currency_exchange_div">
            <div class="form-group mb-3">
                <?php echo Form::label('p_exchange_rate', __('purchase.p_exchange_rate') . ':'); ?>

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
                    <?php echo Form::number('p_exchange_rate', $business->p_exchange_rate, ['class' => 'form-control',
                    'placeholder' => __('business.p_exchange_rate'), 'required', 'step' => '0.001']); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('allow_currency_change_purchase', 1, $business->allow_currency_change_purchase, [ 'class' => 'form-check-input']); ?>

                        <?php echo e(__('lang_v1.allow_currency_change_purchase'), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.allow_currency_change_purchase_help') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('purchase_item_addition_method', __('lang_v1.purchase_item_addition_method') . ':'); ?>

                <?php echo Form::select('common_settings[purchase_item_addition_method]', [ 0 => __('lang_v1.add_item_in_new_row'), 1 => __('lang_v1.increase_item_qty')], 
                !empty($common_settings['purchase_item_addition_method']) ? $common_settings['purchase_item_addition_method'] : 0, ['class' => 'form-control select2',
                'style' => 'width: 100%;']); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('purchase_status', "Default Purchase Status" . ':'); ?>

                <div class="input-group">
                    
                    <label class="input-group-text"><i class="fas fa-balance-scale"></i></label>
                    <?php echo Form::select('common_settings[default_purchase_status]',
                    ['none'=>'None','received'=>'Received','pending'=>'Pending','ordered'=>'Ordered'],
                    !empty($common_settings['default_purchase_status']) ? $common_settings['default_purchase_status'] :
                    0, ['class' => 'form-control select2', 'style' => 'width: 80%;' ]); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('purchase_default_supplier', 'Default Supplier'); ?>

                <div class="input-group">
                    
                    <label class="input-group-text"><i class="fa fa-user"></i></label>
                    <?php echo Form::select('common_settings[purchase_default_supplier]', $suppliers, $common_settings['purchase_default_supplier'] ?? '', [
                        'class' => 'form-control select2',
                        'style' => 'width: 80%;'
                    ]); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
                        <?php echo Form::checkbox('enable_purchase_status', 1, $business->enable_purchase_status , [ 'class' =>
                        'form-check-input', 'id' => 'enable_purchase_status']); ?>

                        <?php echo e(__( 'lang_v1.enable_purchase_status' ), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_enable_purchase_status') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[is_tax_inclusive_purchase]', 1,
                        !empty($common_settings['is_tax_inclusive_purchase']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e("Is Tax Inclusive on Puchaes?", false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[show_invoice_layout_purchase]', 1,
                        !empty($common_settings['show_invoice_layout_purchase']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.show_invoice_layout' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[hide_attach_document_purchase]', 1,
                        !empty($common_settings['hide_attach_document_purchase']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_attach_document_purchase' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_purchase_order]', 1,
                        !empty($common_settings['enable_purchase_order']) , [ 'class' => 'form-check-input', 'id' =>
                        'enable_purchase_order']); ?> <?php echo e(__( 'lang_v1.enable_purchase_order' ), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.purchase_order_help_text') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_purchase_auto_save]', 1,
                        !empty($common_settings['enable_purchase_auto_save']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_purchase_auto_save' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_purchase_requisition]', 1,
                        !empty($common_settings['enable_purchase_requisition']) , [ 'class' => 'form-check-input', 'id' =>
                        'enable_purchase_requisition']); ?> <?php echo e(__( 'lang_v1.enable_purchase_requisition' ), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.purchase_requisition_help_text') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                                                <?php echo Form::checkbox('common_settings[enable_direct_purchase_return]', 1,
                        !empty($common_settings['enable_direct_purchase_return']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_direct_purchase_return' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
       
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_load_products_from_qoutation]', 1,
                        !empty($common_settings['enable_load_products_from_qoutation']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> Enable Load Products from Quotation
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[supplier_based_cost_price]', 1,
                        !empty($common_settings['supplier_based_cost_price']) ? true : false ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.supplier_based_cost_price' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[hide_sku_from_search_field_purchase]', 1,
                        !empty($common_settings['hide_sku_from_search_field_purchase']) ,
                                [ 'class' => 'form-check-input', 'id' => 'hide_sku_from_search_field_purchase']); ?>

                    <?php echo e(__( 'lang_v1.hide_sku_from_search_field' ), false); ?>

                    </label>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[hide_supplier_id_from_search_field]', 1,
                        !empty($common_settings['hide_supplier_id_from_search_field']) ,
                        [ 'class' => 'form-check-input', 'id' => 'hide_supplier_id_from_search_field']); ?>

                    <?php echo e(__( 'lang_v1.hide_supplier_id_from_search_field' ), false); ?>

                    </label>
                    
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12 mb-2">
            <h4><?php echo app('translator')->get('lang_v1.products_detailed_shown'); ?></h4>
        </div>
        <div class="col-sm-12">
            <div class="card card-body bg-light border mb-3 p-3">
                <div class="row align-items-center">
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('common_settings[enable_inline_discount_purchase]', 1,
                                    !empty($common_settings['enable_inline_discount_purchase']) ? true : false,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e("Enable Inline Unit Discount in purchase", false); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('default_inline_discount_type_purchase', 'Default Inline Unit Discount Type:'); ?>

                                <?php echo Form::select('common_settings[default_inline_discount_type_purchase]',
                                ['percentage'=>'Percentage', 'fixed'=>'Fixed'],
                                !empty($common_settings['default_inline_discount_type_purchase']) ? $common_settings['default_inline_discount_type_purchase'] : 'percentage',
                                ['class' => 'form-control select2', 'style'=>'width:100%' ]); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <div class="card card-body bg-light border mb-3 p-3">
                <div class="row align-items-center">
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('common_settings[enable_inline_total_discount_purchase]', 1,
                                    !empty($common_settings['enable_inline_total_discount_purchase']) ? true : false,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e("Enable Inline Total Discount in purchase", false); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                                <?php echo Form::label('default_inline_total_discount_type_purchase', 'Default Inline Total Discount Type:'); ?>

                                <?php echo Form::select('common_settings[default_inline_total_discount_type_purchase]',
                                ['percentage'=>'Percentage', 'fixed'=>'Fixed'],
                                !empty($common_settings['default_inline_total_discount_type_purchase']) ? $common_settings['default_inline_total_discount_type_purchase'] : 'fixed',
                                ['class' => 'form-control select2', 'style'=>'width:100%' ]); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <div class="card card-body bg-light border mb-3 p-3">
                <div class="row align-items-center">
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('common_settings[enable_inline_discount2_purchase]', 1,
                                    !empty($common_settings['enable_inline_discount2_purchase']) ? true : false,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e("Enable Inline Discount 2 in purchase", false); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                                <?php echo Form::label('default_inline_discount2_type_purchase', 'Default Inline Discount 2 Type:'); ?>

                                <?php echo Form::select('common_settings[default_inline_discount2_type_purchase]',
                                ['percentage'=>'Percentage', 'fixed'=>'Fixed'],
                                !empty($common_settings['default_inline_discount2_type_purchase']) ? $common_settings['default_inline_discount2_type_purchase'] : 'fixed',
                                ['class' => 'form-control select2', 'style'=>'width:100%' ]); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <div class="card card-body bg-light border mb-3 p-3">
                <div class="row align-items-center">
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('common_settings[enable_inline_total_discount2_purchase]', 1,
                                    !empty($common_settings['enable_inline_total_discount2_purchase']) ? true : false,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e("Enable Inline Total Discount 2 in purchase", false); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                                <?php echo Form::label('default_inline_total_discount2_type_purchase', 'Default Inline Total Discount 2 Type:'); ?>

                                <?php echo Form::select('common_settings[default_inline_total_discount2_type_purchase]',
                                ['percentage'=>'Percentage', 'fixed'=>'Fixed'],
                                !empty($common_settings['default_inline_total_discount2_type_purchase']) ? $common_settings['default_inline_total_discount2_type_purchase'] : 'fixed',
                                ['class' => 'form-control select2', 'style'=>'width:100%' ]); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_inline_tax_purchase]', 1,
                        !empty($common_settings['enable_inline_tax_purchase']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e("Enable Inline Tax in purchase", false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_inline_product_note_purchase]', 1,
                        !empty($common_settings['enable_inline_product_note_purchase']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_inline_product_note' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[purchase_inline_ui_slim]', 1,
                        !empty($common_settings['purchase_inline_ui_slim']),
                        [ 'class' => 'form-check-input', 'id' => 'purchase_inline_ui_slim']); ?>

                    <?php echo e(__( 'lang_v1.purchase_inline_ui_slim' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('enable_editing_product_from_purchase', 1,
                        $business->enable_editing_product_from_purchase ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_editing_product_from_purchase' ), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.enable_updating_product_price_tooltip') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_purchase_rack_details]', 1,
                        !empty($common_settings['enable_purchase_rack_details']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_purchase_rack_details' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_scheme_quantity_purchase]', 1,
                        !empty($common_settings['enable_scheme_quantity_purchase']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_scheme_quantity_purchase' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[is_serial_number_required_purchase]', 1,
                        !empty($common_settings['is_serial_number_required_purchase']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.is_product_serial_number_required' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[bulk_add_serial_number_purchase]', 1,
                        !empty($common_settings['bulk_add_serial_number_purchase']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.bulk_add_serial_number_purchase' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[is_imei_number_required_purchase]', 1,
                        !empty($common_settings['is_imei_number_required_purchase']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.is_product_imei_number_required' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('enable_lot_number', 1, $business->enable_lot_number , [ 'class' =>
                        'form-check-input', 'id' => 'enable_lot_number']); ?> <?php echo e(__( 'lang_v1.enable_lot_number' ), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_enable_lot_number') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4 lot_number_section <?php if(!$business->enable_lot_number): ?> hide <?php endif; ?>">
            <div class="form-group mb-3">
                <?php echo Form::text('common_settings[lot_number_label]', !empty($common_settings['lot_number_label']) ? $common_settings['lot_number_label'] : __('lang_v1.lot_number'),
                    ['class' => 'form-control', 'placeholder'=> __('lang_v1.lot_number'), 'style' => 'width:80%', 'style' => 'width: 100%;']); ?>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <h4><?php echo app('translator')->get('lang_v1.invoice_totals_shown'); ?>:</h4>
        </div>
        <div class="col-sm-12">
            <div class="card card-body bg-light border mb-3 p-3">
                <div class="row align-items-center">
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('common_settings[enable_total_discount_purchase]', 1,
                                    !empty($common_settings['enable_total_discount_purchase']) ? true : false,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_total_discount_purchase' ), false); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('default_invoice_discount_purchase', __('business.default_sales_discount') . ':*'); ?>

                            <div class="input-group">
                                <label class="input-group-text"><i class="fas fa-percent"></i></label>
                                <?php echo Form::text('common_settings[default_invoice_discount_purchase]', number_format(!empty($common_settings['default_invoice_discount_purchase']) ? $common_settings['default_invoice_discount_purchase'] : 0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' =>
                                'form-control input_number']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('default_invoice_discount_type_purchase', 'Default Invoice Discount Type:'); ?>

                                <?php echo Form::select('common_settings[default_invoice_discount_type_purchase]',
                                ['percentage'=>'Percentage', 'fixed'=>'Fixed'],
                                !empty($common_settings['default_invoice_discount_type_purchase']) ? $common_settings['default_invoice_discount_type_purchase'] : 'percentage',
                                ['class' => 'form-control select2', 'style'=>'width:100%' ]); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <div class="card card-body bg-light border mb-3 p-3">
                <div class="row align-items-center">
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('common_settings[enable_total_discount2_purchase]', 1,
                                    !empty($common_settings['enable_total_discount2_purchase']) ? true : false,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_total_discount2_purchase' ), false); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('default_invoice_discount2_purchase', __('business.default_sales_discount') . ' 2:*'); ?>

                            <div class="input-group">
                                <label class="input-group-text"><i class="fas fa-percent"></i></label>
                                <?php echo Form::text('common_settings[default_invoice_discount2_purchase]', number_format(!empty($common_settings['default_invoice_discount2_purchase']) ? $common_settings['default_invoice_discount2_purchase'] : 0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), 
                                ['class' => 'form-control input_number']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('default_invoice_discount2_type_purchase', 'Default Invoice Discount 2 Type:'); ?>

                            <?php echo Form::select('common_settings[default_invoice_discount2_type_purchase]',
                            ['percentage'=>'Percentage', 'fixed'=>'Fixed'],
                            !empty($common_settings['default_invoice_discount2_type_purchase']) ? $common_settings['default_invoice_discount2_type_purchase'] : 'percentage',
                            ['class' => 'form-control select2', 'style'=>'width:100%' ]); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_total_tax_purchase]', 1,
                        !empty($common_settings['enable_total_tax_purchase']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_total_tax_purchase' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_shipping_details_purchase]', 1,
                        !empty($common_settings['enable_shipping_details_purchase']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_shipping_details_purchase' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_additional_expense_purchase]', 1,
                        !empty($common_settings['enable_additional_expense_purchase']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_additional_expense_purchase' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <hr>
    <h4><?php echo app('translator')->get('business.add_keyboard_shortcuts'); ?> — <?php echo app('translator')->get('lang_v1.purchase_page_shortcuts'); ?>:</h4>
    <p class="help-block"><?php echo app('translator')->get('lang_v1.shortcut_help'); ?>; <?php echo app('translator')->get('lang_v1.example'); ?>: <b>ctrl+shift+b</b>, <b>ctrl+h</b></p>
    <p class="help-block">
        <b><?php echo app('translator')->get('lang_v1.available_key_names_are'); ?>:</b>
        <br> shift, ctrl, alt, backspace, tab, enter, return, capslock, esc, escape, space, pageup, pagedown, end, home,
        <br>left, up, right, down, ins, del, and plus
    </p>
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-striped">
                <tr>
                    <th><?php echo app('translator')->get('business.operations'); ?></th>
                    <th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_save'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][save_purchase]',
                        !empty($shortcuts["purchase"]["save_purchase"]) ? $shortcuts["purchase"]["save_purchase"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_save_and_print'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][save_and_print]',
                        !empty($shortcuts["purchase"]["save_and_print"]) ? $shortcuts["purchase"]["save_and_print"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_cancel'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][cancel_purchase]',
                        !empty($shortcuts["purchase"]["cancel_purchase"]) ? $shortcuts["purchase"]["cancel_purchase"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_product_search'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][product_search]',
                        !empty($shortcuts["purchase"]["product_search"]) ? $shortcuts["purchase"]["product_search"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_show_shortcuts_help'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][show_shortcuts_help]',
                        !empty($shortcuts["purchase"]["show_shortcuts_help"]) ? $shortcuts["purchase"]["show_shortcuts_help"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
            </table>
        </div>
        <div class="col-sm-6">
            <table class="table table-striped">
                <tr>
                    <th><?php echo app('translator')->get('business.operations'); ?></th>
                    <th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_focus_payment'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][focus_payment]',
                        !empty($shortcuts["purchase"]["focus_payment"]) ? $shortcuts["purchase"]["focus_payment"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_focus_supplier'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][focus_supplier]',
                        !empty($shortcuts["purchase"]["focus_supplier"]) ? $shortcuts["purchase"]["focus_supplier"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_add_new_supplier'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][add_new_supplier]',
                        !empty($shortcuts["purchase"]["add_new_supplier"]) ? $shortcuts["purchase"]["add_new_supplier"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_add_payment_row'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][add_payment_row]',
                        !empty($shortcuts["purchase"]["add_payment_row"]) ? $shortcuts["purchase"]["add_payment_row"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_focus_date'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][focus_purchase_date]',
                        !empty($shortcuts["purchase"]["focus_purchase_date"]) ? $shortcuts["purchase"]["focus_purchase_date"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_focus_ref_no'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][focus_ref_no]',
                        !empty($shortcuts["purchase"]["focus_ref_no"]) ? $shortcuts["purchase"]["focus_ref_no"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_focus_last_qty'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][focus_last_qty]',
                        !empty($shortcuts["purchase"]["focus_last_qty"]) ? $shortcuts["purchase"]["focus_last_qty"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_focus_last_price'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][focus_last_price]',
                        !empty($shortcuts["purchase"]["focus_last_price"]) ? $shortcuts["purchase"]["focus_last_price"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_focus_last_discount'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][focus_last_discount]',
                        !empty($shortcuts["purchase"]["focus_last_discount"]) ? $shortcuts["purchase"]["focus_last_discount"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_remove_last_product'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][remove_last_product]',
                        !empty($shortcuts["purchase"]["remove_last_product"]) ? $shortcuts["purchase"]["remove_last_product"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h5 class="text-muted"><i class="fas fa-undo"></i> <?php echo app('translator')->get('lang_v1.purchase_return_shortcuts'); ?>:</h5>
        </div>
        <div class="col-sm-6">
            <table class="table table-striped">
                <tr>
                    <th><?php echo app('translator')->get('business.operations'); ?></th>
                    <th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_return_save'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][save_purchase_return]',
                        !empty($shortcuts["purchase"]["save_purchase_return"]) ? $shortcuts["purchase"]["save_purchase_return"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.purchase_return_save_and_print'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[purchase][save_and_print_return]',
                        !empty($shortcuts["purchase"]["save_and_print_return"]) ? $shortcuts["purchase"]["save_and_print_return"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="clearfix"></div>
    <hr>
    <h4><?php echo app('translator')->get('business.add_keyboard_shortcuts'); ?> — <?php echo app('translator')->get('lang_v1.stock_adjustment_page_shortcuts'); ?>:</h4>
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-striped">
                <tr>
                    <th><?php echo app('translator')->get('business.operations'); ?></th>
                    <th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_adjustment_save'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_adjustment][save]',
                        !empty($shortcuts["stock_adjustment"]["save"]) ? $shortcuts["stock_adjustment"]["save"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_adjustment_focus_location'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_adjustment][focus_location]',
                        !empty($shortcuts["stock_adjustment"]["focus_location"]) ? $shortcuts["stock_adjustment"]["focus_location"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_adjustment_focus_ref_no'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_adjustment][focus_ref_no]',
                        !empty($shortcuts["stock_adjustment"]["focus_ref_no"]) ? $shortcuts["stock_adjustment"]["focus_ref_no"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_adjustment_focus_date'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_adjustment][focus_date]',
                        !empty($shortcuts["stock_adjustment"]["focus_date"]) ? $shortcuts["stock_adjustment"]["focus_date"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_adjustment_show_shortcuts_help'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_adjustment][show_shortcuts_help]',
                        !empty($shortcuts["stock_adjustment"]["show_shortcuts_help"]) ? $shortcuts["stock_adjustment"]["show_shortcuts_help"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
            </table>
        </div>
        <div class="col-sm-6">
            <table class="table table-striped">
                <tr>
                    <th><?php echo app('translator')->get('business.operations'); ?></th>
                    <th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_adjustment_product_search'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_adjustment][product_search]',
                        !empty($shortcuts["stock_adjustment"]["product_search"]) ? $shortcuts["stock_adjustment"]["product_search"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_adjustment_focus_last_qty'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_adjustment][focus_last_qty]',
                        !empty($shortcuts["stock_adjustment"]["focus_last_qty"]) ? $shortcuts["stock_adjustment"]["focus_last_qty"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_adjustment_remove_last_product'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_adjustment][remove_last_product]',
                        !empty($shortcuts["stock_adjustment"]["remove_last_product"]) ? $shortcuts["stock_adjustment"]["remove_last_product"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_adjustment_focus_recovery_amount'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_adjustment][focus_recovery_amount]',
                        !empty($shortcuts["stock_adjustment"]["focus_recovery_amount"]) ? $shortcuts["stock_adjustment"]["focus_recovery_amount"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="clearfix"></div>
    <hr>
    <h4><?php echo app('translator')->get('business.add_keyboard_shortcuts'); ?> — <?php echo app('translator')->get('lang_v1.stock_transfer_page_shortcuts'); ?>:</h4>
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-striped">
                <tr>
                    <th><?php echo app('translator')->get('business.operations'); ?></th>
                    <th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_transfer_save'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_transfer][save]',
                        !empty($shortcuts["stock_transfer"]["save"]) ? $shortcuts["stock_transfer"]["save"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_transfer_focus_location_from'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_transfer][focus_location_from]',
                        !empty($shortcuts["stock_transfer"]["focus_location_from"]) ? $shortcuts["stock_transfer"]["focus_location_from"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_transfer_focus_location_to'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_transfer][focus_location_to]',
                        !empty($shortcuts["stock_transfer"]["focus_location_to"]) ? $shortcuts["stock_transfer"]["focus_location_to"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_transfer_focus_ref_no'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_transfer][focus_ref_no]',
                        !empty($shortcuts["stock_transfer"]["focus_ref_no"]) ? $shortcuts["stock_transfer"]["focus_ref_no"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_transfer_show_shortcuts_help'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_transfer][show_shortcuts_help]',
                        !empty($shortcuts["stock_transfer"]["show_shortcuts_help"]) ? $shortcuts["stock_transfer"]["show_shortcuts_help"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
            </table>
        </div>
        <div class="col-sm-6">
            <table class="table table-striped">
                <tr>
                    <th><?php echo app('translator')->get('business.operations'); ?></th>
                    <th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_transfer_focus_date'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_transfer][focus_date]',
                        !empty($shortcuts["stock_transfer"]["focus_date"]) ? $shortcuts["stock_transfer"]["focus_date"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_transfer_product_search'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_transfer][product_search]',
                        !empty($shortcuts["stock_transfer"]["product_search"]) ? $shortcuts["stock_transfer"]["product_search"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_transfer_focus_last_qty'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_transfer][focus_last_qty]',
                        !empty($shortcuts["stock_transfer"]["focus_last_qty"]) ? $shortcuts["stock_transfer"]["focus_last_qty"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.stock_transfer_remove_last_product'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[stock_transfer][remove_last_product]',
                        !empty($shortcuts["stock_transfer"]["remove_last_product"]) ? $shortcuts["stock_transfer"]["remove_last_product"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
            </table>
        </div>
        <?php echo $__env->make('business.partials.settings_custom_label_group', [
            'custom_label_group_key' => 'purchase',
            'custom_label_group_title' => __('lang_v1.labels_for_purchase_custom_fields'),
            'custom_label_col' => 'col-sm-6',
            'custom_label_required' => true,
            'custom_label_fields' => [
                ['key' => 'custom_field_1', 'id' => 'purchase_custom_field_1_label', 'label' => __('lang_v1.product_custom_field1')],
                ['key' => 'custom_field_2', 'id' => 'purchase_custom_field_2_label', 'label' => __('lang_v1.product_custom_field2')],
                ['key' => 'custom_field_3', 'id' => 'purchase_custom_field_3_label', 'label' => __('lang_v1.product_custom_field3')],
                ['key' => 'custom_field_4', 'id' => 'purchase_custom_field_4_label', 'label' => __('lang_v1.product_custom_field4')],
                ['key' => 'custom_field_5', 'id' => 'purchase_custom_field_5_label', 'label' => __('lang_v1.custom_field', ['number' => 5])],
                ['key' => 'custom_field_6', 'id' => 'purchase_custom_field_6_label', 'label' => __('lang_v1.custom_field', ['number' => 6])],
                ['key' => 'custom_field_7', 'id' => 'purchase_custom_field_7_label', 'label' => __('lang_v1.custom_field', ['number' => 7])],
                ['key' => 'custom_field_8', 'id' => 'purchase_custom_field_8_label', 'label' => __('lang_v1.custom_field', ['number' => 8])],
                ['key' => 'custom_field_9', 'id' => 'purchase_custom_field_9_label', 'label' => __('lang_v1.custom_field', ['number' => 9])],
                ['key' => 'custom_field_10', 'id' => 'purchase_custom_field_10_label', 'label' => __('lang_v1.custom_field', ['number' => 10])],
                ['key' => 'custom_field_11', 'id' => 'purchase_custom_field_11_label', 'label' => __('lang_v1.custom_field', ['number' => 11])],
                ['key' => 'custom_field_12', 'id' => 'purchase_custom_field_12_label', 'label' => __('lang_v1.custom_field', ['number' => 12])],
                ['key' => 'custom_field_13', 'id' => 'purchase_custom_field_13_label', 'label' => __('lang_v1.custom_field', ['number' => 13])],
                ['key' => 'custom_field_14', 'id' => 'purchase_custom_field_14_label', 'label' => __('lang_v1.custom_field', ['number' => 14])],
            ],
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('business.partials.settings_custom_label_group', [
            'custom_label_group_key' => 'purchase_shipping',
            'custom_label_group_title' => __('lang_v1.labels_for_purchase_shipping_custom_fields'),
            'custom_label_col' => 'col-sm-6',
            'custom_label_required' => true,
            'custom_label_fields' => [
                ['key' => 'custom_field_1', 'id' => 'purchase_shipping_custom_field_1_label', 'label' => __('lang_v1.custom_field', ['number' => 1])],
                ['key' => 'custom_field_2', 'id' => 'purchase_shipping_custom_field_2_label', 'label' => __('lang_v1.custom_field', ['number' => 2])],
                ['key' => 'custom_field_3', 'id' => 'purchase_shipping_custom_field_3_label', 'label' => __('lang_v1.custom_field', ['number' => 3])],
                ['key' => 'custom_field_4', 'id' => 'purchase_shipping_custom_field_4_label', 'label' => __('lang_v1.custom_field', ['number' => 4])],
                ['key' => 'custom_field_5', 'id' => 'purchase_shipping_custom_field_5_label', 'label' => __('lang_v1.custom_field', ['number' => 5])],
            ],
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

</div>
