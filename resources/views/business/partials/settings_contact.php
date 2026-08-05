<!--Purchase related settings -->
<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group mb-3">
                <?php echo Form::label('default_credit_limit',__('lang_v1.default_credit_limit') . ':'); ?>

                <?php echo Form::text('common_settings[default_credit_limit]', $common_settings['default_credit_limit'] ?? '',
                ['class' => 'form-control input_number',
                'placeholder' => __('lang_v1.default_credit_limit'), 'id' => 'default_credit_limit']); ?>

            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[contact_mobile_num_required]', 1,
                        !empty($common_settings['contact_mobile_num_required']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.contact_mobile_num_required' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_account_summary]', 1,
                        !empty($common_settings['hide_account_summary']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_account_summary' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_ageing_format1]', 1,
                        !empty($common_settings['hide_ageing_format1']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_ageing_format1' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_footer_total_format1]', 1,
                        !empty($common_settings['hide_footer_total_format1']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_footer_total_format1' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_custom_discount]', 1,
                        !empty($common_settings['enable_custom_discount']) ? true : false,
                        [ 'class' => 'form-check-input', 'id' => 'enable_custom_discount']); ?> Enable Custom Discount Label
                    </label>
                </div>
            </div>
        </div>
        <div class=" col-sm-4 <?php if(empty($common_settings['enable_custom_discount'])){ echo "hide" ; } ?>"
                    id="enable_custom_discount_label_div">
                <div class="form-group mb-3">
                    <?php echo Form::text('common_settings[enable_custom_discount_label]', !empty($common_settings['enable_custom_discount_label'])
                    ? $common_settings['enable_custom_discount_label'] : '' , ['class' => 'form-control', 'placeholder'=>'Discount Label', 'style' => 'width: 75%', 'style' => 'width: 100%;']); ?>

                </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-3">
            <?php echo Form::label('default_customer_type',__('lang_v1.default_customer_type') . ':'); ?>

            <div class="form-check">
                <label class="form-check-label">
                    <?php echo Form::radio('common_settings[default_customer_type]', 'individual', 
                    (empty($common_settings['default_customer_type']) || $common_settings['default_customer_type'] == 'individual') ? true : false,
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.individual' ), false); ?>

                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <?php echo Form::radio('common_settings[default_customer_type]', 'business', 
                    (!empty($common_settings['default_customer_type']) && $common_settings['default_customer_type'] == 'business') ? true : false,
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.business' ), false); ?>

                </label>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="form-group mb-3">
                <?php echo Form::label('cutomer_ledger_format2_footer_text',__('lang_v1.cutomer_ledger_format2_footer_text') . ':'); ?>

                <?php echo Form::textarea('common_settings[cutomer_ledger_format2_footer_text]', $common_settings['cutomer_ledger_format2_footer_text'] ?? '',
                ['class' => 'form-control', 'placeholder' => __('invoice.footer_text'), 'rows' => 3, 'id' => 'cutomer_ledger_format2_footer_text']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <?php echo Form::label('default_supplier_type',__('lang_v1.default_supplier_type') . ':'); ?>

            <div class="form-check">
                <label class="form-check-label">
                    <?php echo Form::radio('common_settings[default_supplier_type]', 'individual',
                    (!empty($common_settings['default_supplier_type']) && $common_settings['default_supplier_type'] == 'individual') ? true : false,
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.individual' ), false); ?>

                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <?php echo Form::radio('common_settings[default_supplier_type]', 'business', 
                    (empty($common_settings['default_supplier_type']) || $common_settings['default_supplier_type'] == 'business') ? true : false,
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.business' ), false); ?>

                </label>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="form-group mb-3">
                <?php echo Form::label('supplier_ledger_format2_footer_text',__('lang_v1.supplier_ledger_format2_footer_text') . ':'); ?>

                <?php echo Form::textarea('common_settings[supplier_ledger_format2_footer_text]', $common_settings['supplier_ledger_format2_footer_text'] ?? '',
                ['class' => 'form-control', 'placeholder' => __('invoice.footer_text'), 'rows' => 3, 'id' => 'supplier_ledger_format2_footer_text']); ?>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                <br>
                  <label class="form-check-label">
                    <?php echo Form::checkbox('common_settings[customer_ledger_hide_address]', 1,  
                        !empty($common_settings['customer_ledger_hide_address']) , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.customer_ledger_hide_address' ), false); ?>

                  </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                <br>
                  <label class="form-check-label">
                    <?php echo Form::checkbox('common_settings[supplier_ledger_hide_address]', 1,  
                        !empty($common_settings['supplier_ledger_hide_address']) , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.supplier_ledger_hide_address' ), false); ?>

                  </label>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <div class="form-group mb-3">
                <?php echo Form::label('customer_ledger_header',__('lang_v1.customer_ledger_header') . ':'); ?>

                <?php echo Form::textarea('common_settings[customer_ledger_header]', $common_settings['customer_ledger_header'] ?? '',
                ['class' => 'form-control', 'placeholder' => __('lang_v1.customer_ledger_header'), 'rows' => 3, 'id' => 'customer_ledger_header']); ?>

            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group mb-3">
                <?php echo Form::label('supplier_ledger_header',__('lang_v1.supplier_ledger_header') . ':'); ?>

                <?php echo Form::textarea('common_settings[supplier_ledger_header]', $common_settings['supplier_ledger_header'] ?? '',
                ['class' => 'form-control', 'placeholder' => __('lang_v1.supplier_ledger_header'), 'rows' => 3, 'id' => 'supplier_ledger_header']); ?>

            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group mb-3">
                <?php echo Form::label('customer_ledger_footer',__('lang_v1.customer_ledger_footer') . ':'); ?>

                <?php echo Form::textarea('common_settings[customer_ledger_footer]', $common_settings['customer_ledger_footer'] ?? '',
                ['class' => 'form-control', 'placeholder' => __('lang_v1.customer_ledger_footer'), 'rows' => 3, 'id' => 'customer_ledger_footer']); ?>

            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group mb-3">
                <?php echo Form::label('supplier_ledger_footer',__('lang_v1.supplier_ledger_footer') . ':'); ?>

                <?php echo Form::textarea('common_settings[supplier_ledger_footer]', $common_settings['supplier_ledger_footer'] ?? '',
                ['class' => 'form-control', 'placeholder' => __('lang_v1.supplier_ledger_footer'), 'rows' => 3, 'id' => 'supplier_ledger_footer']); ?>

            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="form-check">
                    
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[merchant_hide_entity_type]', 1, !empty($common_settings['merchant_hide_entity_type']),
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.merchant_hide_entity_type' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <?php echo Form::label('tax_number_label',__('lang_v1.tax_number_label') . ':'); ?>

                <?php echo Form::text('common_settings[merchant_tax_number_label]', !empty($common_settings['merchant_tax_number_label']) ? $common_settings['merchant_tax_number_label'] : 'Tax Number',
                             ['class' => 'form-control', 'placeholder'=> 'Tax Number', 'style' => 'width:80%']); ?>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <?php echo Form::label('zip_code_label',__('lang_v1.zip_code_label') . ':'); ?>

                <?php echo Form::text('common_settings[merchant_zip_code_label]', !empty($common_settings['merchant_zip_code_label']) ? $common_settings['merchant_zip_code_label'] : 'Zip Code',
                             ['class' => 'form-control', 'placeholder'=> 'Zip Code', 'style' => 'width:80%']); ?>

            </div>
        </div>
        <div class="clearfix"></div>
        <hr>
        
        <div class="col-sm-6">
            <div class="card card-body bg-light border mb-3 p-3">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <div class="form-check mb-0">
                            <label class="form-check-label">
                                <?php echo Form::checkbox('common_settings[disable_ledger_discount]', 1, !empty($common_settings['disable_ledger_discount']),
                                    ['class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.disable_ledger_discount'), false); ?>

                            </label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group mb-0">
                            <?php echo Form::label('ledger_discount_label', __('lang_v1.ledger_discount_label') . ':'); ?>

                            <?php echo Form::text('common_settings[ledger_discount_label]',
                                !empty($common_settings['ledger_discount_label']) ? $common_settings['ledger_discount_label'] : 'Ledger Discount',
                                ['class' => 'form-control', 'placeholder' => 'Ledger Discount Label']); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-sm-6">
            <div class="card card-body bg-light border mb-3 p-3">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <div class="form-check mb-0">
                            <label class="form-check-label">
                                <?php echo Form::checkbox('common_settings[enable_ledger_discount2]', 1, !empty($common_settings['enable_ledger_discount2']),
                                    ['class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.enable_ledger_discount2'), false); ?>

                            </label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group mb-0">
                            <?php echo Form::label('ledger_discount2_label', __('lang_v1.ledger_discount2_label') . ':'); ?>

                            <?php echo Form::text('common_settings[ledger_discount2_label]',
                                !empty($common_settings['ledger_discount2_label']) ? $common_settings['ledger_discount2_label'] : 'Adjustment',
                                ['class' => 'form-control', 'placeholder' => 'Ledger Discount 2 Label']); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-sm-6">
            <div class="card card-body bg-light border mb-3 p-3">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <div class="form-check mb-0">
                            <label class="form-check-label">
                                <?php echo Form::checkbox('common_settings[enable_ledger_discount3]', 1, !empty($common_settings['enable_ledger_discount3']),
                                    ['class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.enable_ledger_discount3'), false); ?>

                            </label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group mb-0">
                            <?php echo Form::label('ledger_discount3_label', __('lang_v1.ledger_discount3_label') . ':'); ?>

                            <?php echo Form::text('common_settings[ledger_discount3_label]',
                                !empty($common_settings['ledger_discount3_label']) ? $common_settings['ledger_discount3_label'] : 'Invoice Discount',
                                ['class' => 'form-control', 'placeholder' => 'Ledger Discount 3 Label']); ?>

                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-check mb-0">
                            <label class="form-check-label">
                                <?php echo Form::checkbox('common_settings[ld3_calculate_discount_on_new_cost]', 1, !empty($common_settings['ld3_calculate_discount_on_new_cost']),
                                    ['class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.ld3_calculate_discount_on_new_cost'), false); ?>

                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <hr>
        <div class="col-sm-12">
            <h4><?php echo app('translator')->get('lang_v1.hide_contact_ledger_columns'); ?>:</h4>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_refno_column_ledger_format1]', 1,
                        !empty($common_settings['hide_refno_column_ledger_format1']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_refno_column_ledger_format1' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_type_column_ledger_format1]', 1,
                        !empty($common_settings['hide_type_column_ledger_format1']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_type_column_ledger_format1' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_payment_status_column_ledger_format1]', 1,
                        !empty($common_settings['hide_payment_status_column_ledger_format1']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_payment_status_column_ledger_format1' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_payment_method_column_ledger_format1]', 1,
                        !empty($common_settings['hide_payment_method_column_ledger_format1']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_payment_method_column_ledger_format1' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[hide_amount_exc_tax_column_ledger_format2]', 1,
                        !empty($common_settings['hide_amount_exc_tax_column_ledger_format2']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_amount_exc_tax_column_ledger_format2' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-sm-12">
            <h4><?php echo app('translator')->get('lang_v1.hide_contact_extra_field_marchants'); ?>:</h4>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_customer_group]', 1,
                            !empty($common_settings['hide_contact_customer_group']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_customer_group' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_prefix]', 1,
                            !empty($common_settings['hide_contact_prefix']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'business.hide_contact_prefix' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_middle_name]', 1,
                            !empty($common_settings['hide_contact_middle_name']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_middle_name' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_last_name]', 1,
                            !empty($common_settings['hide_contact_last_name']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'business.hide_contact_last_name' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_alternate_number]', 1,
                            !empty($common_settings['hide_contact_alternate_number']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'contact.hide_contact_alternate_number' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_landline]', 1,
                            !empty($common_settings['hide_contact_landline']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'contact.hide_contact_landline' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_email]', 1,
                            !empty($common_settings['hide_contact_email']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'business.hide_contact_email' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_dob]', 1,
                            !empty($common_settings['hide_contact_dob']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_dob' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_is_inclusive]', 1,
                            !empty($common_settings['hide_contact_is_inclusive']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_is_inclusive' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_location]', 1,
                            !empty($common_settings['hide_contact_location']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_location' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_assigned_users]', 1,
                            !empty($common_settings['hide_contact_assigned_users']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_assigned_users' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_assigned_menus]', 1,
                            !empty($common_settings['hide_contact_assigned_menus']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_assigned_menus' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_invoice_layout]', 1,
                            !empty($common_settings['hide_contact_invoice_layout']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_invoice_layout' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
                            <?php echo Form::checkbox('common_settings[hide_contact_default_currency]', 1,
                            !empty($common_settings['hide_contact_default_currency']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_default_currency' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_allow_login]', 1,
                            !empty($common_settings['hide_contact_allow_login']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_allow_login' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_more_info]', 1,
                            !empty($common_settings['hide_contact_more_info']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_more_info' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <hr>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_opening_balance]', 1,
                            !empty($common_settings['hide_contact_opening_balance']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_opening_balance' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_tax_no]', 1,
                            !empty($common_settings['hide_contact_tax_no']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'contact.hide_contact_tax_no' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_pay_term]', 1,
                            !empty($common_settings['hide_contact_pay_term']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'contact.hide_contact_pay_term' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_credit_limit]', 1,
                            !empty($common_settings['hide_contact_credit_limit']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_credit_limit' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_discount]', 1,
                            !empty($common_settings['hide_contact_discount']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_discount' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_default_tax]', 1,
                            !empty($common_settings['hide_contact_default_tax']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_default_tax' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_address_line_1]', 1,
                            !empty($common_settings['hide_contact_address_line_1']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_address_line_1' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_address_line_2]', 1,
                            !empty($common_settings['hide_contact_address_line_2']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_address_line_2' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_city]', 1,
                            !empty($common_settings['hide_contact_city']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'business.hide_contact_city' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_state]', 1,
                            !empty($common_settings['hide_contact_state']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'business.hide_contact_state' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_country]', 1,
                            !empty($common_settings['hide_contact_country']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'business.hide_contact_country' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_zip_code]', 1,
                            !empty($common_settings['hide_contact_zip_code']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'business.hide_contact_zip_code' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_shipping_custom_labels]', 1,
                            !empty($common_settings['hide_contact_shipping_custom_labels']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_shipping_custom_labels' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_contact_shipping_address]', 1,
                            !empty($common_settings['hide_contact_shipping_address']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_contact_shipping_address' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            
        </div>
        <?php echo $__env->make('business.partials.settings_contact_custom_labels', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
