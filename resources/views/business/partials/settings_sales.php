<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-12">
            <h4><?php echo app('translator')->get('lang_v1.sales_header_shown'); ?>:</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('sale_invoice_design_id', __('lang_v1.invoice_format') . ':'); ?>

                <?php echo Form::select('common_settings[sale_invoice_design_id]', $invoice_designs, 
                    $common_settings['sale_invoice_design_id'] ?? null,
                    ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('sale_status', "Default Sale Status" . ':'); ?>

                <div class="input-group">
                    
                    <label class="input-group-text"><i class="fa fa-balance-scale"></i></label>
                    <?php echo Form::select('common_settings[default_sale_status]',
                    ['none'=>'None','final'=>'Final','draft'=>'Draft','quotation'=>'Quotation', 'performa'=>'Performa'],
                    !empty($common_settings['default_sale_status']) ? $common_settings['default_sale_status'] : 0,
                    ['class' => 'form-control select2', 'style' => 'width: 80%;' ]); ?>

                </div>
            </div>
        </div>

        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('enable_layby', __('lang_v1.enable_layby') . ':'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.enable_layby_help') . '"></i>';
                }
            ?>
                <br>
                <label class="form-check form-switch">
                    <?php echo Form::checkbox('common_settings[enable_layby]', 1,
                        !empty($common_settings['enable_layby']) ? true : false,
                        ['class' => 'form-check-input', 'id' => 'enable_layby']); ?>

                    <span class="form-check-label"><?php echo e(__('lang_v1.enable_layby_label'), false); ?></span>
                </label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('layby_default_due_days', __('lang_v1.layby_default_due_days') . ':'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.layby_default_due_days_help') . '"></i>';
                }
            ?>
                <?php echo Form::number('common_settings[layby_default_due_days]',
                    $common_settings['layby_default_due_days'] ?? 30,
                    ['class' => 'form-control', 'min' => 1, 'max' => 365, 'style' => 'width: 80%;']); ?>

            </div>
        </div>

       
        <!-- <div class="clearfix"></div> -->
        <!--  -->
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('item_addition_method', __('lang_v1.sales_item_addition_method') . ':'); ?>

                <?php echo Form::select('item_addition_method', [ 0 => __('lang_v1.add_item_in_new_row'), 1 =>
                __('lang_v1.increase_item_qty')], $business->item_addition_method, ['class' => 'form-select select2',
                'style' => 'width: 100%;']); ?>

            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('sale_default_types_of_service', __('lang_v1.default_types_of_service') . ':'); ?>

                <div class="input-group">
                    
                    <label class="input-group-text"><i class="fa fa-external-link-square-alt"></i></label>
                    <?php echo Form::select('pos_settings[sale_default_types_of_service]', $types_of_service, $pos_settings[$default_location]['sale_default_types_of_service'], ['class' =>
                    'form-select select2','placeholder' => __('None'), 'style' => 'width: 80%;']); ?>

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('sale_default_customer', 'Default Customer'); ?>

                <div class="input-group">
                    
                    <label class="input-group-text"><i class="fa fa-user"></i></label>
                    <?php echo Form::select('pos_settings[sale_default_customer]', $customers, $pos_settings[$default_location]['sale_default_customer'] ?? 'CO0001', [
                        'class' => 'form-select select2',
                        'style' => 'width: 80%;'
                    ]); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('allow_currency_change_sales', 1, $business->allow_currency_change_sales, [ 'class' => 'form-check-input']); ?>

                        <?php echo e(__('lang_v1.allow_currency_change_sales'), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.allow_currency_change_sales_help') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[is_tax_inclusive_sales]', 1,
                        !empty($common_settings['is_tax_inclusive_sales']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.is_tax_inclusive_sales' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <br>
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_msp]', 1,
                        !empty($pos_settings['enable_msp']) ? true : false ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.sale_price_is_minimum_sale_price' ), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.minimum_sale_price_help') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[allow_overselling]', 1,
                        !empty($pos_settings['allow_overselling']) ? true : false ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.allow_overselling' ), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.allow_overselling_help') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[warn_if_no_stock]', 1,
                        !empty($pos_settings['warn_if_no_stock']) ? true : false ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.warn_if_no_stock' ), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.warn_if_no_stock_help') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[is_pay_term_required]', 1,
                        !empty($pos_settings['is_pay_term_required']) , [ 'class' => 'form-check-input', 'id' =>
                        'is_pay_term_required']); ?> <?php echo e(__( 'lang_v1.is_pay_term_required' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_pay_turm]', 1,
                        !empty($common_settings['hide_pay_turm']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_pay_turm' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[make_pay_term_readonly]', 1,
                        !empty($common_settings['make_pay_term_readonly']) ,
                        [ 'class' => 'form-check-input', 'id' => 'make_pay_term_readonly']); ?>

                        <?php echo e(__( 'lang_v1.make_pay_term_readonly' ), false); ?>

                    </label>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_attach_document_sale]', 1,
                        !empty($common_settings['hide_attach_document_sale']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_attach_document_sale' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[readonly_sale_status]', 1,
                        !empty($common_settings['readonly_sale_status']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.readonly_sale_status' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
       
        <div class="col-sm-4">
            <div class="form-group mb-3">
                
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_invoice_scheme]', 1,
                        !empty($common_settings['show_invoice_scheme']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.show_invoice_scheme' ), false); ?>

                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_invoice_layout]', 1,
                        !empty($common_settings['show_invoice_layout']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.show_invoice_layout' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_address_info]', 1,
                        !empty($common_settings['hide_address_info']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_address_info' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_customer_note]', 1,
                        !empty($pos_settings['enable_customer_note']) ,
                        [ 'class' => 'form-check-input', 'id' => 'enable_customer_note']); ?>

                        <?php echo e(__( 'lang_v1.enable_customer_note' ), false); ?>

                    </label>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[customer_based_sell_price]', 1,
                        !empty($pos_settings['customer_based_sell_price']) ? true : false ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.customer_based_sell_price' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_sales_order]', 1,
                        !empty($pos_settings['enable_sales_order']) ,
                        [ 'class' => 'form-check-input', 'id' => 'enable_sales_order']); ?>

                        <?php echo e(__( 'lang_v1.enable_sales_order' ), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.sales_order_help_text') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_delivery_notes]', 1,
                            !empty($common_settings['enable_delivery_notes']) ? true : false,
                            ['class' => 'form-check-input', 'id' => 'enable_delivery_notes']); ?>

                        Enable Delivery Notes
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[is_sales_order_required]', 1,
                        !empty($pos_settings['is_sales_order_required']) ,
                        [ 'class' => 'form-check-input', 'id' => 'is_sales_order_required']); ?>

                        <?php echo e(__( 'lang_v1.is_sales_order_required' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_back_order]', 1,
                            !empty($common_settings['enable_back_order']) ? true : false,
                            ['class' => 'form-check-input', 'id' => 'enable_back_order']); ?>

                        <?php echo e(__('lang_v1.enable_back_order'), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.back_order_help_text') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[restrict_sale_of_so_qty]', 1,
                        !empty($pos_settings['restrict_sale_of_so_qty']) ? true : false ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.restrict_sale_of_so_qty' ), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.restrict_sale_of_so_qty_help') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        <div id="so_settings_div" class="<?php if(empty($pos_settings['enable_sales_order'])): ?> hide <?php endif; ?>">
            <div class="col-sm-4">
                <div class="form-group mb-3">
                    <div class="form-check">
                        <label class="form-check-label">
                            <?php echo Form::checkbox('pos_settings[enable_order_request_custom1]', 1,
                            !empty($pos_settings['enable_order_request_custom1']) ? true : false ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_order_request_custom1' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_quotations]', 1,
                        !empty($pos_settings['enable_quotations']) ,
                        [ 'class' => 'form-check-input', 'id' => 'enable_quotations']); ?>

                        <?php echo e(__( 'lang_v1.enable_quotations' ), false); ?>

                    </label>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[is_quotation_required]', 1,
                        !empty($pos_settings['is_quotation_required']) ,
                        [ 'class' => 'form-check-input', 'id' => 'is_quotation_required']); ?>

                        <?php echo e(__( 'lang_v1.is_quotation_required' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_draft_auto_save]', 1,
                        !empty($common_settings['enable_draft_auto_save']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_draft_auto_save' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_load_purchase_to_sale_dropdown]', 1,
                        !empty($pos_settings['enable_load_purchase_to_sale_dropdown']) ,
                        [ 'class' => 'form-check-input', 'id' => 'enable_load_purchase_to_sale_dropdown']); ?>

                        <?php echo e(__( 'lang_v1.enable_load_purchase_to_sale_dropdown' ), false); ?>

                    </label>
                    
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_load_production_to_sale_dropdown]', 1,
                        !empty($pos_settings['enable_load_production_to_sale_dropdown']) ,
                        [ 'class' => 'form-check-input', 'id' => 'enable_load_production_to_sale_dropdown']); ?>

                        <?php echo e(__( 'lang_v1.enable_load_production_to_sale_dropdown' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
       
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_direct_sale_return]', 1,
                        !empty($common_settings['enable_direct_sale_return']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_direct_sale_return' ), false); ?>

                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[disable_load_products_from_quotation]', 1,
                        !empty($pos_settings['disable_load_products_from_quotation']) ,
                        [ 'class' => 'form-check-input', 'id' => 'disable_load_products_from_quotation']); ?>

                        <?php echo e(__( 'lang_v1.disable_load_products_from_quotation' ), false); ?>

                    </label>
                    
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_sale_note]', 1,
                        !empty($pos_settings['enable_sale_note']) ,
                        [ 'class' => 'form-check-input', 'id' => 'enable_sale_note']); ?>

                        <?php echo e(__( 'lang_v1.enable_sale_note' ), false); ?>

                    </label>
                    
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[disable_bulk_fbr_sync]', 1,
                        !empty($pos_settings['disable_bulk_fbr_sync']) ,
                        [ 'class' => 'form-check-input', 'id' => 'disable_bulk_fbr_sync']); ?>

                        <?php echo e(__( 'lang_v1.disable_bulk_fbr_sync' ), false); ?>

                    </label>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[change_search_filtering_sales]', 1,
                        !empty($common_settings['change_search_filtering_sales']) ,
                        [ 'class' => 'form-check-input', 'id' => 'change_search_filtering_sales']); ?>

                        <?php echo e(__( 'lang_v1.change_search_filtering_sales' ), false); ?>

                    </label>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[show_last_customer_sold_price_search]', 1,
                        !empty($common_settings['show_last_customer_sold_price_search']) ,
                        [ 'class' => 'form-check-input', 'id' => 'show_last_customer_sold_price_search']); ?>

                    <?php echo e(__( 'lang_v1.show_last_customer_sold_price_search' ), false); ?>

                    </label>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[hide_sku_from_search_field_sale]', 1,
                        !empty($common_settings['hide_sku_from_search_field_sale']) ,
                        [ 'class' => 'form-check-input', 'id' => 'hide_sku_from_search_field_sale']); ?>

                    <?php echo e(__( 'lang_v1.hide_sku_from_search_field' ), false); ?>

                    </label>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[hide_customer_id_from_search_field]', 1,
                        !empty($common_settings['hide_customer_id_from_search_field']) ,
                        [ 'class' => 'form-check-input', 'id' => 'hide_customer_id_from_search_field']); ?>

                    <?php echo e(__( 'lang_v1.hide_customer_id_from_search_field' ), false); ?>

                    </label>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[sale_inline_ui_slim]', 1,
                        !empty($common_settings['sale_inline_ui_slim']) ,
                        [ 'class' => 'form-check-input', 'id' => 'sale_inline_ui_slim']); ?>

                    <?php echo e(__( 'lang_v1.sale_inline_ui_slim' ), false); ?>

                    </label>
                    
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <h4><?php echo app('translator')->get('lang_v1.products_detailed_shown'); ?>:</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[sale_product_name_editable]', 1,
                        !empty($common_settings['sale_product_name_editable']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.sale_product_name_editable' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_inline_product_note_sale]', 1,
                        !empty($common_settings['enable_inline_product_note_sale']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_inline_product_note' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[is_serial_number_required_sale]', 1,
                        !empty($common_settings['is_serial_number_required_sale']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.is_product_serial_number_required' ), false); ?>

                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[is_imei_number_required_sale]', 1,
                        !empty($common_settings['is_imei_number_required_sale']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.is_product_imei_number_required' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_scheme_quantity_sales]', 1,
                        !empty($common_settings['enable_scheme_quantity_sales']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_scheme_quantity_sales' ), false); ?>

                    </label>
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
                                    <?php echo Form::checkbox('common_settings[enable_inline_discount_sales]', 1,
                                    !empty($common_settings['enable_inline_discount_sales']) ? true : false,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_inline_discount_sales' ), false); ?> 
                                </label>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('default_item_discount_type', 'Default Item Discount Type:'); ?>

                                <?php echo Form::select('common_settings[default_item_discount_type]',
                                ['percentage'=>'Percentage', 'fixed'=>'Fixed'],
                                !empty($common_settings['default_item_discount_type']) ? $common_settings['default_item_discount_type'] : 0,
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
                                    <?php echo Form::checkbox('common_settings[enable_inline_discount2_sales]', 1,
                                    !empty($common_settings['enable_inline_discount2_sales']) ? true : false,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_inline_discount2_sales' ), false); ?> 
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('default_item_discount2_type', 'Default Item Discount 2 Type:'); ?>

                                <?php echo Form::select('common_settings[default_item_discount2_type]',
                                ['percentage'=>'Percentage', 'fixed'=>'Fixed'],
                                !empty($common_settings['default_item_discount2_type']) ? $common_settings['default_item_discount2_type'] : 0,
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
<?php echo Form::checkbox('common_settings[sell_enable_inline_group_price]', 1,
                        !empty($common_settings['sell_enable_inline_group_price']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.sell_enable_inline_group_price' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_inline_tax_sales]', 1,
                        !empty($common_settings['enable_inline_tax_sales']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_inline_tax_sales' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_inline_profit_sales]', 1,
                        !empty($common_settings['enable_inline_profit_sales']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_inline_profit_sales' ), false); ?>

                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[bulk_add_serial_number_sales]', 1,
                        !empty($common_settings['bulk_add_serial_number_sales']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.bulk_add_serial_number_sales' ), false); ?>

                    </label>
                </div>
            </div>
        </div>

        
        <div class="col-sm-12 mb-2">
            <h4><?php echo app('translator')->get('lang_v1.invoice_totals_shown'); ?></h4>
        </div>
        <div class="col-sm-12">
            <div class="card card-body bg-light border mb-3 p-3">
                <div class="row align-items-center">
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <br>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('common_settings[enable_total_discount_sale]', 1,
                                    !empty($common_settings['enable_total_discount_sale']) ? true : false,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_total_discount_sale' ), false); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('default_sales_discount', __('business.default_sales_discount') . ':*'); ?>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-percent"></i>
                                </span>
                                <?php echo Form::text('default_sales_discount', number_format($business->default_sales_discount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' =>
                                'form-control input_number']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('default_invoice_discount_type', 'Default Invoice Discount Type:'); ?>

                                <?php echo Form::select('common_settings[default_invoice_discount_type]',
                                ['percentage'=>'Percentage', 'fixed'=>'Fixed'],
                                !empty($common_settings['default_invoice_discount_type']) ? $common_settings['default_invoice_discount_type'] : 'fixed',
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
                            <br>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('common_settings[enable_total_discount2_sale]', 1,
                                    !empty($common_settings['enable_total_discount2_sale']) ? true : false,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_total_discount2_sale' ), false); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('default_invoice_discount2', __('business.default_sales_discount') . ' 2:*'); ?>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-percent"></i>
                                </span>
                                <?php echo Form::text('common_settings[default_invoice_discount2]', number_format(!empty($common_settings['default_invoice_discount2']) ? $common_settings['default_invoice_discount2'] : 0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' =>
                                'form-control input_number']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('default_invoice_discount2_type', 'Default Invoice Discount 2 Type:'); ?>

                                <?php echo Form::select('common_settings[default_invoice_discount2_type]',
                                ['percentage'=>'Percentage', 'fixed'=>'Fixed'],
                                !empty($common_settings['default_invoice_discount2_type']) ? $common_settings['default_invoice_discount2_type'] : 'fixed',
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
                            <br>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('common_settings[enable_total_tax_sale]', 1,
                                    !empty($common_settings['enable_total_tax_sale']) ? true : false,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_total_tax_sale' ), false); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('default_sales_tax', __('business.default_sales_tax') . ':'); ?>

                            <div class="input-group">
                                
                                <label class="input-group-text"><i class="fa fa-info"></i></label>
                                <?php echo Form::select('default_sales_tax', $tax_rates, $business->default_sales_tax, ['class' =>
                                'form-control select2','placeholder' => __('business.default_sales_tax'), 'style' => 'width:
                                80%;']); ?>

                            </div>
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
<?php echo Form::checkbox('common_settings[enable_shipping_details_sale]', 1,
                        !empty($common_settings['enable_shipping_details_sale']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_shipping_details_sale' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_additional_expense_sale]', 1,
                        !empty($common_settings['enable_additional_expense_sale']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_additional_expense_sale' ), false); ?>

                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('amount_rounding_method', __('lang_v1.amount_rounding_method') . ':'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.amount_rounding_method_help') . '"></i>';
                }
            ?>
                <?php echo Form::select('pos_settings[amount_rounding_method]',
                [
                '1' => __('lang_v1.round_to_nearest_whole_number'),
                '0.05' => __('lang_v1.round_to_nearest_decimal', ['multiple' => 0.05]),
                '0.1' => __('lang_v1.round_to_nearest_decimal', ['multiple' => 0.1]),
                '0.5' => __('lang_v1.round_to_nearest_decimal', ['multiple' => 0.5])
                ],
                !empty($pos_settings['amount_rounding_method']) ? $pos_settings['amount_rounding_method'] : null,
                ['class' =>
                'form-control select2', 'style' => 'width: 100%;', 'placeholder' => __('lang_v1.none')]); ?>

            </div>
        </div>

        <div class="col-sm-12 mb-2">
            <h4><?php echo app('translator')->get('lang_v1.payment_detailed_shown'); ?></h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[set_sale_invoice_payment_zero]', 1,
                        !empty($common_settings['set_sale_invoice_payment_zero']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.set_sale_invoice_payment_zero' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[disable_change_return_on_sale]', 1,
                        !empty($common_settings['disable_change_return_on_sale']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_change_return_on_sale' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
    </div>
    
    <hr>
    <div class="row">
        <div class="col-md-12 mb-3">
            <h4><?php echo app('translator')->get('lang_v1.commission_agent'); ?>:</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('sales_cmsn_agnt', __('lang_v1.sales_commission_agent') . ':'); ?>

                <div class="input-group">
                    
                    <label class="input-group-text"><i class="fa fa-info"></i></label>
                    <?php echo Form::select('sales_cmsn_agnt', $commission_agent_dropdown, $business->sales_cmsn_agnt, ['class'
                    =>
                    'form-control select2', 'style' => 'width: 80%;']); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('cmmsn_calculation_type', __('lang_v1.cmmsn_calculation_type') . ':'); ?>

                <div class="input-group">
                    
                    <label class="input-group-text"><i class="fa fa-info"></i></label>
                    <?php echo Form::select('pos_settings[cmmsn_calculation_type]', ['invoice_value' =>
                    __('lang_v1.invoice_value'), 'payment_received' => __('lang_v1.payment_received')],
                    !empty($pos_settings['cmmsn_calculation_type']) ? $pos_settings['cmmsn_calculation_type'] : null,
                    ['class' => 'form-control select2', 'style' => 'width: 80%;', 'id' => 'cmmsn_calculation_type']); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <br>
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[is_commission_agent_required]', 1,
                        !empty($pos_settings['is_commission_agent_required']) , [ 'class' => 'form-check-input', 'id' =>
                        'is_commission_agent_required']); ?> <?php echo e(__( 'lang_v1.is_commission_agent_required' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12 mb-3">
            <h4><?php echo app('translator')->get('lang_v1.payment_link'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.payment_link_help_text') . '"></i>';
                }
            ?>:</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_payment_link]', 1,
                        !empty($pos_settings['enable_payment_link']) , [ 'class' => 'form-check-input', 'id' =>
                        'enable_payment_link']); ?> <?php echo e(__( 'lang_v1.enable_payment_link' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h4>Razorpay: <small>(For INR India)</small></h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('razor_pay_key_id', 'Key ID:'); ?>

                <?php echo Form::text('pos_settings[razor_pay_key_id]', $pos_settings['razor_pay_key_id'] ?? '', ['class' =>
                'form-control', 'id' => 'razor_pay_key_id']); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('razor_pay_key_secret', 'Key Secret:'); ?>

                <?php echo Form::text('pos_settings[razor_pay_key_secret]', $pos_settings['razor_pay_key_secret'] ?? '',
                ['class'
                => 'form-control', 'id' => 'razor_pay_key_secret']); ?>

            </div>
        </div>
        <div class="col-md-12">
            <h4>Stripe:</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('stripe_public_key', __('lang_v1.stripe_public_key') . ':'); ?>

                <?php echo Form::text('pos_settings[stripe_public_key]', $pos_settings['stripe_public_key'] ?? '', ['class' =>
                'form-control', 'id' => 'stripe_public_key']); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('stripe_secret_key', __('lang_v1.stripe_secret_key') . ':'); ?>

                <?php echo Form::text('pos_settings[stripe_secret_key]', $pos_settings['stripe_secret_key'] ?? '', ['class' =>
                'form-control', 'id' => 'stripe_secret_key']); ?>

            </div>
        </div>
        <?php if($dojo_enabled): ?>
        <div class="col-md-12">
            <h4>Dojo:</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <?php echo Form::label('dojo_api_key', __('lang_v1.dojo_api_key') . ':'); ?>

                <?php echo Form::text('pos_settings[dojo_api_key]', $pos_settings['dojo_api_key'] ?? '', ['class' =>
                'form-control', 'id' => 'dojo_api_key']); ?>

                <span id="dojo_api_key_status" class="help-block" style="display:none;"></span>
            </div>
        </div>
        <?php endif; ?>

        <div class="clearfix"></div>
        <hr>
        <h4><?php echo app('translator')->get('business.add_keyboard_shortcuts'); ?> — <?php echo app('translator')->get('lang_v1.sell_page_shortcuts'); ?>:</h4>
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
                        <td><?php echo app('translator')->get('lang_v1.sell_save'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][save_sell]',
                            !empty($shortcuts["sell"]["save_sell"]) ? $shortcuts["sell"]["save_sell"] : null,
                            ['class' => 'form-control']); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo app('translator')->get('lang_v1.sell_save_and_print'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][save_and_print]',
                            !empty($shortcuts["sell"]["save_and_print"]) ? $shortcuts["sell"]["save_and_print"] : null,
                            ['class' => 'form-control']); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo app('translator')->get('lang_v1.sell_cancel'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][cancel_sell]',
                            !empty($shortcuts["sell"]["cancel_sell"]) ? $shortcuts["sell"]["cancel_sell"] : null,
                            ['class' => 'form-control']); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo app('translator')->get('lang_v1.sell_product_search'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][product_search]',
                            !empty($shortcuts["sell"]["product_search"]) ? $shortcuts["sell"]["product_search"] : null,
                            ['class' => 'form-control']); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo app('translator')->get('lang_v1.sell_show_shortcuts_help'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][show_shortcuts_help]',
                            !empty($shortcuts["sell"]["show_shortcuts_help"]) ? $shortcuts["sell"]["show_shortcuts_help"] : null,
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
                        <td><?php echo app('translator')->get('lang_v1.sell_focus_payment'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][focus_payment]',
                            !empty($shortcuts["sell"]["focus_payment"]) ? $shortcuts["sell"]["focus_payment"] : null,
                            ['class' => 'form-control']); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo app('translator')->get('lang_v1.sell_focus_customer'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][focus_customer]',
                            !empty($shortcuts["sell"]["focus_customer"]) ? $shortcuts["sell"]["focus_customer"] : null,
                            ['class' => 'form-control']); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo app('translator')->get('lang_v1.sell_add_new_customer'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][add_new_customer]',
                            !empty($shortcuts["sell"]["add_new_customer"]) ? $shortcuts["sell"]["add_new_customer"] : null,
                            ['class' => 'form-control']); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo app('translator')->get('lang_v1.sell_add_payment_row'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][add_payment_row]',
                            !empty($shortcuts["sell"]["add_payment_row"]) ? $shortcuts["sell"]["add_payment_row"] : null,
                            ['class' => 'form-control']); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo app('translator')->get('lang_v1.sell_focus_sale_date'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][focus_sale_date]',
                            !empty($shortcuts["sell"]["focus_sale_date"]) ? $shortcuts["sell"]["focus_sale_date"] : null,
                            ['class' => 'form-control']); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo app('translator')->get('lang_v1.sell_focus_ref_no'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][focus_ref_no]',
                            !empty($shortcuts["sell"]["focus_ref_no"]) ? $shortcuts["sell"]["focus_ref_no"] : null,
                            ['class' => 'form-control']); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo app('translator')->get('lang_v1.sell_focus_last_qty'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][focus_last_qty]',
                            !empty($shortcuts["sell"]["focus_last_qty"]) ? $shortcuts["sell"]["focus_last_qty"] : null,
                            ['class' => 'form-control']); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo app('translator')->get('lang_v1.sell_focus_last_price'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][focus_last_price]',
                            !empty($shortcuts["sell"]["focus_last_price"]) ? $shortcuts["sell"]["focus_last_price"] : null,
                            ['class' => 'form-control']); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo app('translator')->get('lang_v1.sell_focus_last_discount'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][focus_last_discount]',
                            !empty($shortcuts["sell"]["focus_last_discount"]) ? $shortcuts["sell"]["focus_last_discount"] : null,
                            ['class' => 'form-control']); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo app('translator')->get('lang_v1.sell_remove_last_product'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][remove_last_product]',
                            !empty($shortcuts["sell"]["remove_last_product"]) ? $shortcuts["sell"]["remove_last_product"] : null,
                            ['class' => 'form-control']); ?>

                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h5 class="text-muted"><i class="fas fa-undo"></i> <?php echo app('translator')->get('lang_v1.sell_return_shortcuts'); ?>:</h5>
            </div>
            <div class="col-sm-6">
                <table class="table table-striped">
                    <tr>
                        <th><?php echo app('translator')->get('business.operations'); ?></th>
                        <th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
                    </tr>
                    <tr>
                        <td><?php echo app('translator')->get('lang_v1.sell_return_save'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][save_sell_return]',
                            !empty($shortcuts["sell"]["save_sell_return"]) ? $shortcuts["sell"]["save_sell_return"] : null,
                            ['class' => 'form-control']); ?>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo app('translator')->get('lang_v1.sell_return_save_and_print'); ?>:</td>
                        <td>
                            <?php echo Form::text('shortcuts[sell][save_and_print_return]',
                            !empty($shortcuts["sell"]["save_and_print_return"]) ? $shortcuts["sell"]["save_and_print_return"] : null,
                            ['class' => 'form-control']); ?>

                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <?php echo $__env->make('business.partials.settings_custom_label_group', [
            'custom_label_group_key' => 'sell',
            'custom_label_group_title' => __('lang_v1.labels_for_sell_custom_fields'),
            'custom_label_col' => 'col-sm-6',
            'custom_label_required' => true,
            'custom_label_fields' => [
                ['key' => 'custom_field_1', 'id' => 'sell_custom_field_1_label', 'label' => __('lang_v1.product_custom_field1')],
                ['key' => 'custom_field_2', 'id' => 'sell_custom_field_2_label', 'label' => __('lang_v1.product_custom_field2')],
                ['key' => 'custom_field_3', 'id' => 'sell_custom_field_3_label', 'label' => __('lang_v1.product_custom_field3')],
                ['key' => 'custom_field_4', 'id' => 'sell_custom_field_4_label', 'label' => __('lang_v1.product_custom_field4')],
                ['key' => 'custom_field_5', 'id' => 'sell_custom_field_5_label', 'label' => __('lang_v1.custom_field', ['number' => 5])],
                ['key' => 'custom_field_6', 'id' => 'sell_custom_field_6_label', 'label' => __('lang_v1.custom_field', ['number' => 6])],
                ['key' => 'custom_field_7', 'id' => 'sell_custom_field_7_label', 'label' => __('lang_v1.custom_field', ['number' => 7])],
                ['key' => 'custom_field_8', 'id' => 'sell_custom_field_8_label', 'label' => __('lang_v1.custom_field', ['number' => 8])],
                ['key' => 'custom_field_9', 'id' => 'sell_custom_field_9_label', 'label' => __('lang_v1.custom_field', ['number' => 9])],
                ['key' => 'custom_field_10', 'id' => 'sell_custom_field_10_label', 'label' => __('lang_v1.custom_field', ['number' => 10])],
                ['key' => 'custom_field_11', 'id' => 'sell_custom_field_11_label', 'label' => __('lang_v1.custom_field', ['number' => 11])],
                ['key' => 'custom_field_12', 'id' => 'sell_custom_field_12_label', 'label' => __('lang_v1.custom_field', ['number' => 12])],
                ['key' => 'custom_field_13', 'id' => 'sell_custom_field_13_label', 'label' => __('lang_v1.custom_field', ['number' => 13])],
                ['key' => 'custom_field_14', 'id' => 'sell_custom_field_14_label', 'label' => __('lang_v1.custom_field', ['number' => 14])],
            ],
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('business.partials.settings_custom_label_group', [
            'custom_label_group_key' => 'shipping',
            'custom_label_group_title' => __('lang_v1.labels_for_sale_shipping_custom_fields'),
            'custom_label_col' => 'col-sm-6',
            'custom_label_required' => true,
            'custom_label_contact_default' => true,
            'custom_label_fields' => [
                ['key' => 'custom_field_1', 'id' => 'shipping_custom_field_1_label', 'label' => __('lang_v1.custom_field', ['number' => 1])],
                ['key' => 'custom_field_2', 'id' => 'shipping_custom_field_2_label', 'label' => __('lang_v1.custom_field', ['number' => 2])],
                ['key' => 'custom_field_3', 'id' => 'shipping_custom_field_3_label', 'label' => __('lang_v1.custom_field', ['number' => 3])],
                ['key' => 'custom_field_4', 'id' => 'shipping_custom_field_4_label', 'label' => __('lang_v1.custom_field', ['number' => 4])],
                ['key' => 'custom_field_5', 'id' => 'shipping_custom_field_5_label', 'label' => __('lang_v1.custom_field', ['number' => 5])],
            ],
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('business.partials.settings_custom_label_group', [
            'custom_label_group_key' => 'types_of_service',
            'custom_label_group_title' => __('lang_v1.labels_for_types_of_service_custom_fields'),
            'custom_label_col' => 'col-sm-3',
            'custom_label_fields' => [
                ['key' => 'custom_field_1', 'id' => 'types_of_service_custom_field_1_label', 'label' => __('lang_v1.service_custom_field_1')],
                ['key' => 'custom_field_2', 'id' => 'types_of_service_custom_field_2_label', 'label' => __('lang_v1.service_custom_field_2')],
                ['key' => 'custom_field_3', 'id' => 'types_of_service_custom_field_3_label', 'label' => __('lang_v1.service_custom_field_3')],
                ['key' => 'custom_field_4', 'id' => 'types_of_service_custom_field_4_label', 'label' => __('lang_v1.service_custom_field_4')],
                ['key' => 'custom_field_5', 'id' => 'types_of_service_custom_field_5_label', 'label' => __('lang_v1.custom_field', ['number' => 5])],
                ['key' => 'custom_field_6', 'id' => 'types_of_service_custom_field_6_label', 'label' => __('lang_v1.custom_field', ['number' => 6])],
            ],
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
