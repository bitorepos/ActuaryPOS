<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-12">
            <h3><?php echo app('translator')->get('lang_v1.pos_settings'); ?>:</h3>
        </div>
        <div class="col-sm-12">
            <h4><?php echo app('translator')->get('lang_v1.pos_header'); ?>:</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('pos_invoice_design_id', __('lang_v1.invoice_format') . ':'); ?>

                <?php echo Form::select('pos_settings[invoice_design_id]', $invoice_designs, 
                    $pos_settings[$default_location]['invoice_design_id'] ?? null,
                    ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('hide_product_suggestion', __('lang_v1.pos_screen_interface') . ':*'); ?>

                <?php echo Form::select('pos_settings[hide_product_suggestion]', [0 =>'Simple', 1 =>'Show Product Suggestion',
                2=>'Enable Quick Buttons', 3=>'Big Buttons'],
                $pos_settings[$default_location]['hide_product_suggestion'],['class' => 'form-control select2', 'id'=>'hide_product_suggestion', 'style' => 'width:
                100%;']); ?> 
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('pos_search_box_speed', __('lang_v1.pos_search_box_speed') . ':'); ?>

                <?php echo Form::select('pos_settings[pos_search_box_speed]', [2000 =>'Slow', 1500 =>'Medium', 1000 =>'Normal', 500 =>'Medium Fast', 100 => 'Fast'],
                $pos_settings[$default_location]['pos_search_box_speed'], ['class' => 'form-control select2', 'id'=>'pos_search_box_speed', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('pos_product_section_height', __('lang_v1.pos_product_section_height') . ':'); ?>

                <?php echo Form::select('pos_settings[pos_product_section_height]', [25 =>'Height Setting 1 (Default)', 30 =>'Height Setting 2', 40 => 'Height Setting 3', 50 =>'Height Setting 4', 60 =>'Height Setting 5', 70 =>'Height Setting 6', 80 =>'Height Setting 7'],
                $pos_settings[$default_location]['pos_product_section_height'], ['class' => 'form-control select2', 'id'=>'pos_product_section_height', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('default_types_of_service', __('lang_v1.default_types_of_service') . ':'); ?>

                <div class="input-group">
                    <?php echo Form::select('pos_settings[default_types_of_service]', $types_of_service, $pos_settings[$default_location]['default_types_of_service'], ['class' =>
                    'form-control select2','placeholder' => __('None'), 'style' => 'width:
                    100%;']); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('pos_default_customer', 'Default Customer'); ?>

                <div class="input-group">
                    <?php echo Form::select('pos_settings[pos_default_customer]', $customers, $pos_settings[$default_location]['pos_default_customer'] ?? 'CO0001', [
                        'class' => 'form-control select2',
                        'style' => 'width: 100%;'
                    ]); ?>

                </div>
            </div>
        </div>  
        <div class="col-sm-4">
            <div class="form-group">
                <?php echo Form::label('auto_cursor_on_barcode_delay', __('lang_v1.auto_cursor_on_barcode_delay') . ':'); ?>

                <?php echo Form::select('pos_settings[auto_cursor_on_barcode_delay]', [15000 => '15 sec', 14000 => '14 sec', 13000 => '13 sec', 12000 => '12 sec', 11000 => '11 sec', 
                10000 => '10 sec', 9000 => '9 sec', 8000 => '8 sec', 7000 => '7 sec', 6000 => '6 sec', 5000 => '5 sec', 4000 => '4 sec', 3000 => '3 sec', 2500 => '2 sec', 1000 => '1 sec'],
                $pos_settings['auto_cursor_on_barcode_delay'], ['class' => 'form-control select2', 'id' => 'auto_cursor_on_barcode_delay', 'style' => 'width: 100%;']); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                    <?php echo Form::hidden('default_types_of_service', $business->default_types_of_service); ?>

            </div>
        </div>
        
        <div class="clearfix"></div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[is_tax_inclusive_pos]', 1,
                        !empty($pos_settings['is_tax_inclusive_pos']) ? true : false,
                        [ 'class' => 'form-check-input', 'checked' => empty($pos_settings) ? true : false ]); ?>

                        <?php echo e(__( 'lang_v1.is_tax_inclusive_pos' ), false); ?>

                    </label>
                </div>
            </div>
        </div>

        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    

                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_product_search_sku_pos]', 1,
                        empty($pos_settings['enable_product_search_sku_pos']) ? 0 : 1 ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_product_search_sku_pos' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    

                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[disable_product_search_pos]', 1,
                        empty($pos_settings['disable_product_search_pos']) ? 0 : 1 ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_product_search_pos' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
                        <?php echo Form::checkbox('allow_currency_change_pos', 1, $business->allow_currency_change_pos, [ 'class' => 'form-check-input']); ?>

                        <?php echo e(__( 'lang_v1.allow_currency_change_pos' ), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.allow_currency_change_pos_help') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                    

                    <label class="form-check-label">
                        <?php echo Form::checkbox('pos_settings[is_service_staff_required]', 1,
                        empty($pos_settings['is_service_staff_required']) ? 0 : 1 ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.is_service_staff_required' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[show_invoice_scheme]', 1,
                        empty($pos_settings['show_invoice_scheme']) ? 0 : 1 ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.show_invoice_scheme' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[show_invoice_layout]', 1,
                        !empty($pos_settings['show_invoice_layout']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.show_invoice_layout' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[require_customer_always]', 1,
                        !empty($pos_settings[$default_location]['require_customer_always']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.require_customer_always' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[show_pricing_on_product_sugesstion]', 1,
                        !empty($pos_settings['show_pricing_on_product_sugesstion']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.show_price_on_product_btn' ), false); ?>

                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[disable_group_price_pos]', 1,
                        !empty($pos_settings['disable_group_price_pos']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_group_price_pos' ), false); ?>

                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[show_change_return_modal]', 1,
                        !empty($pos_settings['show_change_return_modal']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.show_change_return_modal' ), false); ?>

                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[restrict_sale_total_zero]', 1,
                        !empty($pos_settings['restrict_sale_total_zero']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.restrict_sale_total_zero' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[show_order_details_kitchen]', 1,
                        !empty($pos_settings['show_order_details_kitchen']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.show_order_details_kitchen' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[warn_prep_time_out]', 1,
                        !empty($pos_settings['warn_prep_time_out']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.warn_prep_time_out' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                    
                    <label class="form-check-label">
                        <?php echo Form::checkbox('pos_settings[warn_if_product_not_found]', 1,
                        !empty($pos_settings['warn_if_product_not_found']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.warn_if_product_not_found' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                    
                    <label class="form-check-label">
                        <?php echo Form::checkbox('pos_settings[print_group_kot]', 1,
                        !empty($pos_settings['print_group_kot']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.print_group_kot' ), false); ?>

                    </label>
                </div>
            </div>
        </div>

        <!-- HEADER END -->
    

        <!-- RIGHT SIDE END  -->
        <div class="col-sm-12 mb-2">
            <h4><?php echo app('translator')->get('lang_v1.pos_products_table_screen'); ?>:</h4>
        </div>

        
        
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_inline_stock_quantity]', 1,
                empty($pos_settings['enable_inline_stock_quantity']) ? 0 : 1 ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_inline_stock_quantity' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_inline_product_note]', 1,
                empty($pos_settings['enable_inline_product_note']) ? 0 : 1 ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_inline_product_note' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[hide_quantity_unit]', 1,
                empty($pos_settings['hide_quantity_unit']) ? 0 : 1 ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_quantity_unit' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[inline_service_staff]', 1,
                !empty($pos_settings['inline_service_staff']) ? true : false ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_service_staff_in_product_line' ), false); ?>

            </label>
            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.inline_service_staff_tooltip') . '"></i>';
                }
            ?>
        </div>
    </div>
</div>


<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_discount_column]', 1,
                empty($pos_settings['enable_discount_column']) ? 0 : 1 ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_discount_column' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_after_discount_column]', 1,
                empty($pos_settings['enable_after_discount_column']) ? 0 : 1 ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_after_discount_column' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_inline_tax_pos]', 1,
                !empty($pos_settings['enable_inline_tax_pos']) ? true : false,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_tax_column' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_inclusive_tax_column]', 1,
                !empty($pos_settings['enable_inclusive_tax_column']) ? true : false,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_inclusive_tax_column' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_scheme_quantity_pos]', 1,
                !empty($pos_settings['enable_scheme_quantity_pos']) ? true : false,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_scheme_quantity_sales' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_expiry_date_inline]', 1,
                !empty($pos_settings['enable_expiry_date_inline']) ? true : false,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_expiry_date_inline' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_group_price_inline_pos]', 1,
                !empty($pos_settings['enable_group_price_inline_pos']) ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_group_price_inline_pos' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_numeric_keypad_on_input]', 1,
                !empty($pos_settings['enable_numeric_keypad_on_input']) ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_numeric_keypad_on_input' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            <label class="form-check-label">
<?php echo Form::checkbox('common_settings[bulk_add_serial_number_pos]', 1,
                !empty($common_settings['bulk_add_serial_number_pos']) ? true : false,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.bulk_add_serial_number_pos' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_product_description_on_pos]', 1, !empty($common_settings['enable_product_description_on_pos']) ? true : false,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_product_description_on_pos' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_inline_discount_detail]', 1, !empty($common_settings['show_inline_discount_detail']) ? true : false,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.show_inline_discount_detail' ), false); ?>

            </label>
        </div>
    </div>
</div>


 <div class="col-sm-12 mb-2">
            <h4><?php echo app('translator')->get('lang_v1.pos_totals_menu'); ?>:</h4>
        </div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[disable_discount]', 1, $pos_settings['disable_discount'] ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_discount' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[disable_invoice_tax]', 1, $pos_settings['disable_invoice_tax'] ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_invoice_tax' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[disable_shipping]', 1, $pos_settings['disable_shipping'] ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_shipping' ), false); ?>

            </label>
        </div>
    </div>
</div>



<!-- MAIN SCREEN END  -->
<div class="col-sm-12 mb-2">
    <h4><?php echo app('translator')->get('lang_v1.pos_footer'); ?>:</h4>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[disable_draft]', 1,
                $pos_settings['disable_draft'] ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_draft' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[disable_suspend]', 1,
                empty($pos_settings['disable_suspend']) ? 0 : 1 ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_suspend_sale' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[print_on_suspend]', 1,
                !empty($pos_settings['print_on_suspend']) ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.print_on_suspend' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[disable_credit_sale_button]', 1,
                empty($pos_settings['disable_credit_sale_button']) ? 0 : 1 ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_credit_sale_button' ), false); ?>

            </label>
            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.show_credit_sale_btn_help') . '"></i>';
                }
            ?>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[disable_quotation_button]', 1,
                empty($pos_settings['disable_quotation_button']) ? 0 : 1 ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_quotation_button' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[disable_pay_checkout]', 1,
                $pos_settings['disable_pay_checkout'] ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_pay_checkout' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[disable_card_button]', 1,
                empty($pos_settings['disable_card_button']) ? 0 : 1 ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_card_button' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[disable_card_details_modal]', 1,
                empty($pos_settings['disable_card_details_modal']) ? 0 : 1 ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_card_details_modal' ), false); ?>

            </label>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[disable_express_checkout]', 1,
                $pos_settings['disable_express_checkout'] ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_express_checkout' ), false); ?>

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
                                    <?php echo Form::checkbox('pos_settings[enable_takeaway]', 1,
                                    !empty($pos_settings['enable_takeaway']) ? true : false ,
                                    [ 'class' => 'form-check-input', 'id'=> 'enable_takeaway']); ?> Enable Takeaway
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 <?php if(empty($pos_settings['enable_takeaway'])){ echo "hide" ; } ?>" id="enable_takeaway_label_div">
                            <div class="form-group mb-3">
                                <?php echo Form::text('pos_settings[enable_takeaway_label]', !empty($pos_settings['enable_takeaway_label'])
                                ? $pos_settings['enable_takeaway_label'] : '' , ['class' => 'form-control', 'placeholder'=>'Takeaway Label', 'style' => 'width: 75%', 'style' => 'width: 100%;']); ?>

                            </div>
                    </div>
                    <div class="col-sm-4 <?php if(empty($pos_settings['enable_takeaway'])){ echo "hide" ; } ?>" id="enable_takeaway_label_div">
                        <div class="form-group mb-3">
                            <div class="form-check">
                                
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('pos_settings[takeaway_enable_only_print_kot]', 1,
                                    empty($pos_settings['takeaway_enable_only_print_kot']) ? 0 : 1 ,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_only_print_kot' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-check">
                                
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('pos_settings[takeaway_enable_seperate_kot_qty]', 1,
                                    empty($pos_settings['takeaway_enable_seperate_kot_qty']) ? 0 : 1 ,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_seperate_kot_qty' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('pos_settings[takeaway_as_credit]', 1,
                                    empty($pos_settings['takeaway_as_credit']) ? 0 : 1 ,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_takeaway_as_credit' ), false); ?>

                                </label>
                            </div>
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
                                    <?php echo Form::checkbox('pos_settings[enable_takeaway_2]', 1,
                                    !empty($pos_settings['enable_takeaway_2']) ? true : false ,
                                    [ 'class' => 'form-check-input', 'id'=> 'enable_takeaway_2']); ?> Enable Takeaway 2
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 <?php if(empty($pos_settings['enable_takeaway_2'])){ echo "hide" ; } ?>" id="enable_takeaway_2_label_div">
                            <div class="form-group mb-3">
                                <?php echo Form::text('pos_settings[enable_takeaway_2_label]', !empty($pos_settings['enable_takeaway_2_label'])
                                ? $pos_settings['enable_takeaway_2_label'] : '' , ['class' => 'form-control', 'placeholder'=>'Takeaway 2 Label', 'style' => 'width: 75%', 'style' => 'width: 100%;']); ?>

                            </div>
                    </div>
                    <div class="col-sm-4 <?php if(empty($pos_settings['enable_takeaway_2'])){ echo "hide" ; } ?>" id="enable_takeaway_2_label_div">
                        <div class="form-group mb-3">
                            <div class="form-check">
                                
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('pos_settings[takeaway_2_enable_only_print_kot]', 1,
                                    empty($pos_settings['takeaway_2_enable_only_print_kot']) ? 0 : 1 ,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_only_print_kot' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-check">
                                
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('pos_settings[takeaway_2_enable_seperate_kot_qty]', 1,
                                    empty($pos_settings['takeaway_2_enable_seperate_kot_qty']) ? 0 : 1 ,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_seperate_kot_qty' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('pos_settings[takeaway_2_as_credit]', 1,
                                    empty($pos_settings['takeaway_2_as_credit']) ? 0 : 1 ,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_takeaway_as_credit' ), false); ?>

                                </label>
                            </div>
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
                                    <?php echo Form::checkbox('pos_settings[enable_takeaway_3]', 1,
                                    !empty($pos_settings['enable_takeaway_3']) ? true : false ,
                                    [ 'class' => 'form-check-input', 'id'=> 'enable_takeaway_3']); ?> Enable Takeaway 3
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 <?php if(empty($pos_settings['enable_takeaway_3'])){ echo "hide" ; } ?>" id="enable_takeaway_3_label_div">
                            <div class="form-group mb-3">
                                <?php echo Form::text('pos_settings[enable_takeaway_3_label]', !empty($pos_settings['enable_takeaway_3_label'])
                                ? $pos_settings['enable_takeaway_3_label'] : '' , ['class' => 'form-control', 'placeholder'=>'Takeaway 3 Label', 'style' => 'width:80%', 'style' => 'width: 100%;']); ?>

                            </div>
                    </div>
                    <div class="col-sm-4 <?php if(empty($pos_settings['enable_takeaway_3'])){ echo "hide" ; } ?>" id="enable_takeaway_3_label_div">
                        <div class="form-group mb-3">
                            <div class="form-check">
                                
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('pos_settings[takeaway_3_enable_only_print_kot]', 1,
                                    empty($pos_settings['takeaway_3_enable_only_print_kot']) ? 0 : 1 ,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_only_print_kot' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-check">
                                
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('pos_settings[takeaway_3_enable_seperate_kot_qty]', 1,
                                    empty($pos_settings['takeaway_3_enable_seperate_kot_qty']) ? 0 : 1 ,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_seperate_kot_qty' ), false); ?>

                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('pos_settings[takeaway_3_as_credit]', 1,
                                    empty($pos_settings['takeaway_3_as_credit']) ? 0 : 1 ,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_takeaway_as_credit' ), false); ?>

                                </label>
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
                        <?php echo Form::checkbox('pos_settings[prompt_token_no]', 1,
                        !empty($pos_settings['prompt_token_no']) ? true : false ,
                        [ 'class' => 'form-check-input', 'id'=> 'prompt_token_no']); ?> <?php echo e(__( 'lang_v1.prompt_token_no'), false); ?>

                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4 <?php if(empty($pos_settings['prompt_token_no'])){ echo " hide"; } ?>" id="prompt_token_label_div">
            <div class="form-group mb-3">
                <?php echo Form::text('pos_settings[prompt_token_label]', !empty($pos_settings['prompt_token_label'])
                ?
                $pos_settings['prompt_token_label'] : '' , ['class' => 'form-control', 'placeholder'=> 'Token Label',
                'style' => 'width: 75%']); ?>

            </div>
        </div>
        <div class="col-sm-4 <?php if(empty($pos_settings['prompt_token_no'])){ echo " hide"; } ?>" id="prompt_token_label_div">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label style="margin-left:20px">
                        <input name="pos_settings[auto_generate_token_no]" type="checkbox" id="auto_generate_token_no" <?php
                            if(!empty($pos_settings['auto_generate_token_no']) &&
                            $pos_settings['auto_generate_token_no']==1){ echo "value='1' checked" ; }else{ echo "value='1'"
                            ; } ?>>
                        <?php echo e(__( 'lang_v1.auto_generate_token_no'), false); ?>

                    </label>
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="form-check">
                    <label style="margin-left:20px">
                        <input name="pos_settings[require_token_no]" type="checkbox" id="require_token_no" <?php
                            if(!empty($pos_settings['require_token_no']) &&
                            $pos_settings['require_token_no']==1){ echo "value='1' checked" ; }else{ echo "value='1'"
                            ; } ?>>
                        <?php echo e(__( 'lang_v1.require_token_no'), false); ?>

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
                                <?php echo Form::checkbox('pos_settings[enable_customer_display]', 1,
                                !empty($pos_settings['enable_customer_display']) ? true : false ,
                                [ 'class' => 'form-check-input', 'id'=> 'enable_customer_display']); ?> <?php echo e(__( 'lang_v1.enable_customer_display'), false); ?>

                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 <?php if(empty($pos_settings['enable_customer_display'])){ echo " hide"; } ?>" id="enable_customer_display_div">
                    <div class="form-group mb-3">
                        <?php echo Form::label('customer_display_width', __('lang_v1.customer_display_width') . ':'); ?>

                        <?php echo Form::text('pos_settings[customer_display_width]', !empty($pos_settings['customer_display_width']) ? $pos_settings['customer_display_width'] : 800 , ['class' => 'form-control', 'placeholder'=> '800',
                        'style' => 'width: 75%']); ?>

                    </div>
                </div>
                <div class="col-sm-4 <?php if(empty($pos_settings['enable_customer_display'])){ echo " hide"; } ?>" id="enable_customer_display_div">
                    <div class="form-group mb-3">
                        <?php echo Form::label('customer_display_heigt', __('lang_v1.customer_display_height') . ':'); ?>

                        <?php echo Form::text('pos_settings[customer_display_height]', !empty($pos_settings['customer_display_height']) ? $pos_settings['customer_display_height'] : 600 , ['class' => 'form-control', 'placeholder'=> '600',
                        'style' => 'width: 75%']); ?>

                    </div>
                </div>
                <div class="col-sm-4 <?php if(empty($pos_settings['enable_customer_display'])){ echo " hide"; } ?>" id="enable_customer_display_div">
                    <div class="form-group mb-3">
                        <?php echo Form::label('customer_display_data_timeout', __('lang_v1.customer_display_data_timeout') . ':'); ?>

                        <?php echo Form::text('pos_settings[customer_display_data_timeout]', !empty($pos_settings['customer_display_data_timeout']) ? $pos_settings['customer_display_data_timeout'] : 10 , ['class' => 'form-control', 'placeholder'=> 'Time in Seconds',
                        'style' => 'width:80%']); ?>

                    </div>
                </div>
                <div class="col-sm-4 <?php if(empty($pos_settings['enable_customer_display'])){ echo " hide"; } ?>" id="enable_customer_display_div">
                    <div class="form-group mb-3">
                        <?php echo Form::label('customer_display_footer_text', __('lang_v1.customer_display_footer_text') . ':'); ?>

                        <?php echo Form::text('pos_settings[customer_display_footer_text]', !empty($pos_settings['customer_display_footer_text']) ? $pos_settings['customer_display_footer_text'] : null , ['class' => 'form-control', 'placeholder'=> 'Thanks for Shopping with us',
                        'style' => 'width:80%']); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</span>
<div class="clearfix"></div>
</div>
<hr>
<div class="col-sm-4">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_weighing_scale]', 1,
                empty($pos_settings['enable_weighing_scale']) ? 0 : 1 ,
                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_weighing_scale' ), false); ?>

            </label>
        </div>
    </div>
</div>
<?php echo $__env->make('business.partials.settings_weighing_scale', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<hr>
<h4><?php echo app('translator')->get('business.add_keyboard_shortcuts'); ?>:</h4>
<p class="help-block"><?php echo app('translator')->get('lang_v1.shortcut_help'); ?>; <?php echo app('translator')->get('lang_v1.example'); ?>: <b>ctrl+shift+b</b>, <b>ctrl+h</b>
</p>
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
                <td><?php echo __('sale.express_finalize'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][express_checkout]',
                    !empty($shortcuts["pos"]["express_checkout"]) ? $shortcuts["pos"]["express_checkout"] : null,
                    ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('sale.finalize'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][pay_n_ckeckout]', !empty($shortcuts["pos"]["pay_n_ckeckout"]) ?
                    $shortcuts["pos"]["pay_n_ckeckout"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('sale.draft'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][draft]', !empty($shortcuts["pos"]["draft"]) ?
                    $shortcuts["pos"]["draft"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('messages.cancel'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][cancel]', !empty($shortcuts["pos"]["cancel"]) ?
                    $shortcuts["pos"]["cancel"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.recent_product_quantity'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][recent_product_quantity]',
                    !empty($shortcuts["pos"]["recent_product_quantity"]) ?
                    $shortcuts["pos"]["recent_product_quantity"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.weighing_scale'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][weighing_scale]', !empty($shortcuts["pos"]["weighing_scale"]) ?
                    $shortcuts["pos"]["weighing_scale"] : null, ['class' => 'form-control']); ?>

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
                <td><?php echo app('translator')->get('sale.edit_discount'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][edit_discount]', !empty($shortcuts["pos"]["edit_discount"]) ?
                    $shortcuts["pos"]["edit_discount"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('sale.edit_order_tax'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][edit_order_tax]', !empty($shortcuts["pos"]["edit_order_tax"]) ?
                    $shortcuts["pos"]["edit_order_tax"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('sale.add_payment_row'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][add_payment_row]', !empty($shortcuts["pos"]["add_payment_row"]) ?
                    $shortcuts["pos"]["add_payment_row"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('sale.finalize_payment'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][finalize_payment]', !empty($shortcuts["pos"]["finalize_payment"])
                    ? $shortcuts["pos"]["finalize_payment"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.add_new_product'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][add_new_product]', !empty($shortcuts["pos"]["add_new_product"]) ?
                    $shortcuts["pos"]["add_new_product"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <table class="table table-striped">
            <tr>
                <th><?php echo app('translator')->get('business.operations'); ?></th>
                <th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.focus_customer'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][focus_customer]', !empty($shortcuts["pos"]["focus_customer"]) ?
                    $shortcuts["pos"]["focus_customer"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.add_new_customer_shortcut'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][add_new_customer]', !empty($shortcuts["pos"]["add_new_customer"]) ?
                    $shortcuts["pos"]["add_new_customer"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.quotation'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][quotation]', !empty($shortcuts["pos"]["quotation"]) ?
                    $shortcuts["pos"]["quotation"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.suspend'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][suspend]', !empty($shortcuts["pos"]["suspend"]) ?
                    $shortcuts["pos"]["suspend"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.credit_sale'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][credit_sale]', !empty($shortcuts["pos"]["credit_sale"]) ?
                    $shortcuts["pos"]["credit_sale"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.express_card_shortcut'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][express_card]', !empty($shortcuts["pos"]["express_card"]) ?
                    $shortcuts["pos"]["express_card"] : null, ['class' => 'form-control']); ?>

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
                <td><?php echo app('translator')->get('lang_v1.recent_transactions'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][recent_transactions]', !empty($shortcuts["pos"]["recent_transactions"]) ?
                    $shortcuts["pos"]["recent_transactions"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.quick_add_product'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][quick_add_product]', !empty($shortcuts["pos"]["quick_add_product"]) ?
                    $shortcuts["pos"]["quick_add_product"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.focus_sku_search'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][focus_sku_search]', !empty($shortcuts["pos"]["focus_sku_search"]) ?
                    $shortcuts["pos"]["focus_sku_search"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.show_shortcuts_help'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][show_shortcuts_help]', !empty($shortcuts["pos"]["show_shortcuts_help"]) ?
                    $shortcuts["pos"]["show_shortcuts_help"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.fullscreen_toggle'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][fullscreen_toggle]', !empty($shortcuts["pos"]["fullscreen_toggle"]) ?
                    $shortcuts["pos"]["fullscreen_toggle"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.edit_shipping'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][edit_shipping]', !empty($shortcuts["pos"]["edit_shipping"]) ?
                    $shortcuts["pos"]["edit_shipping"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.service_charge'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][service_charge]', !empty($shortcuts["pos"]["service_charge"]) ?
                    $shortcuts["pos"]["service_charge"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.takeaway_1'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][takeaway_1]', !empty($shortcuts["pos"]["takeaway_1"]) ?
                    $shortcuts["pos"]["takeaway_1"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.takeaway_2'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][takeaway_2]', !empty($shortcuts["pos"]["takeaway_2"]) ?
                    $shortcuts["pos"]["takeaway_2"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.takeaway_3'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][takeaway_3]', !empty($shortcuts["pos"]["takeaway_3"]) ?
                    $shortcuts["pos"]["takeaway_3"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h5 class="text-muted"><i class="fas fa-bars"></i> <?php echo app('translator')->get('lang_v1.pos_navbar_shortcuts'); ?>:</h5>
    </div>
    <div class="col-sm-6">
        <table class="table table-striped">
            <tr>
                <th><?php echo app('translator')->get('business.operations'); ?></th>
                <th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.cash_pull'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][cash_pull]', !empty($shortcuts["pos"]["cash_pull"]) ?
                    $shortcuts["pos"]["cash_pull"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.calculator_shortcut'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][calculator]', !empty($shortcuts["pos"]["calculator"]) ?
                    $shortcuts["pos"]["calculator"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.customer_display'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][customer_display]', !empty($shortcuts["pos"]["customer_display"]) ?
                    $shortcuts["pos"]["customer_display"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.open_cash_drawer_shortcut'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][open_cash_drawer]', !empty($shortcuts["pos"]["open_cash_drawer"]) ?
                    $shortcuts["pos"]["open_cash_drawer"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.view_suspended_shortcut'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][view_suspended]', !empty($shortcuts["pos"]["view_suspended"]) ?
                    $shortcuts["pos"]["view_suspended"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.sell_return_shortcut'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][sell_return]', !empty($shortcuts["pos"]["sell_return"]) ?
                    $shortcuts["pos"]["sell_return"] : null, ['class' => 'form-control']); ?>

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
                <td><?php echo app('translator')->get('lang_v1.add_expense_shortcut'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][add_expense]', !empty($shortcuts["pos"]["add_expense"]) ?
                    $shortcuts["pos"]["add_expense"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.register_details_shortcut'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][register_details]', !empty($shortcuts["pos"]["register_details"]) ?
                    $shortcuts["pos"]["register_details"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.close_register_shortcut'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][close_register]', !empty($shortcuts["pos"]["close_register"]) ?
                    $shortcuts["pos"]["close_register"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.service_staff_shortcut'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][service_staff]', !empty($shortcuts["pos"]["service_staff"]) ?
                    $shortcuts["pos"]["service_staff"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('lang_v1.go_back_shortcut'); ?>:</td>
                <td>
                    <?php echo Form::text('shortcuts[pos][go_back]', !empty($shortcuts["pos"]["go_back"]) ?
                    $shortcuts["pos"]["go_back"] : null, ['class' => 'form-control']); ?>

                </td>
            </tr>
        </table>
    </div>
</div>
<hr>
<div class="col-sm-12">
    <div class="form-group mb-3">
        <div class="form-check">
            
            <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[ask_deletion_reason]', 1,
                !empty($pos_settings[$default_location]['ask_deletion_reason']) ,
                [ 'class' => 'form-check-input', 'id'=>'ask_deletion_reason']); ?> <?php echo e(__( 'lang_v1.ask_deletion_reason' ), false); ?>

            </label>
        </div>
    </div>
</div>
<h4><?php echo app('translator')->get('business.provide_reasons_deletion_and_edits'); ?>:</h4>
<p class="help-block"><?php echo app('translator')->get('lang_v1.reasoons_help'); ?>
</p>

<div class="row">
    <div class="col-sm-6">
        <table class="table table-striped">
            <tr>
                <th><?php echo app('translator')->get('business.reasons'); ?></th>
                <th><?php echo app('translator')->get('business.questions'); ?></th>
            </tr>
            <tr>
                <td><?php echo __('sale.reason1'); ?>:</td>
                <td>
                    <?php echo Form::text('pos_settings[reasons][1]',
                    !empty($pos_settings[$default_location]['reasons'][1]) ? $pos_settings[$default_location]['reasons'][1] : null,
                    ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('sale.reason2'); ?>:</td>
                <td>
                    <?php echo Form::text('pos_settings[reasons][2]',
                    !empty($pos_settings[$default_location]['reasons'][2]) ? $pos_settings[$default_location]['reasons'][2] : null,
                    ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('sale.reason3'); ?>:</td>
                <td>
                    <?php echo Form::text('pos_settings[reasons][3]',
                    !empty($pos_settings[$default_location]['reasons'][3]) ? $pos_settings[$default_location]['reasons'][3] : null,
                    ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('sale.reason4'); ?>:</td>
                <td>
                    <?php echo Form::text('pos_settings[reasons][4]',
                    !empty($pos_settings[$default_location]['reasons'][4]) ? $pos_settings[$default_location]['reasons'][4] : null,
                    ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('sale.reason5'); ?>:</td>
                <td>
                    <?php echo Form::text('pos_settings[reasons][5]',
                    !empty($pos_settings[$default_location]['reasons'][5]) ? $pos_settings[$default_location]['reasons'][5] : null,
                    ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('sale.reason6'); ?>:</td>
                <td>
                    <?php echo Form::text('pos_settings[reasons][6]',
                    !empty($pos_settings[$default_location]['reasons'][6]) ? $pos_settings[$default_location]['reasons'][6] : null,
                    ['class' => 'form-control']); ?>

                </td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('sale.other'); ?>:</td>
                <td>
                    <?php echo Form::textarea('pos_settings[reasons][other]',
                    !empty($pos_settings[$default_location]['reasons']['other']) ? $pos_settings[$default_location]['reasons']['other'] : null,
                    ['class' => 'form-control']); ?>

                </td>
            </tr>
        </table>
    </div>
    
</div>
</div>
