<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-12">
            <h4><?php echo app('translator')->get('lang_v1.general_product_settings'); ?>:</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('sku_prefix', __('business.sku_prefix') . ':'); ?>

                <?php echo Form::text('sku_prefix', $business->sku_prefix, ['class' => 'form-control text-uppercase']); ?>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <div class="card card-body bg-light border mb-3 p-3">
                <div class="row align-items-center">
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('default_unit', __('lang_v1.default_unit') . ':'); ?>

                            <div class="input-group mb-3">
                                
                                <label class="input-group-text"><i class="fa fa-balance-scale"></i></label>
                                <?php echo Form::select('default_unit', $units_dropdown, $business->default_unit, ['class' => 'form-select
                                select2', 'style' => 'width: 80%;']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <br>
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('enable_sub_units', 1, $business->enable_sub_units, [ 'class' =>
                                    'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_sub_units' ), false); ?>

                                </label>
                                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.sub_units_tooltip') . '"></i>';
                }
            ?>
                            </div>
                        </div>    
                    </div>
                    <div class="col-sm-4 <?php if(config('constants.enable_secondary_unit') == false): ?> hide <?php endif; ?>">
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <br>
                                <label class="form-check-label">
                                    <?php echo Form::checkbox('common_settings[enable_secondary_unit]', 1,
                                    !empty($common_settings['enable_secondary_unit']) ? true : false,
                                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_secondary_unit' ), false); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <?php echo Form::label('enable_product_expiry', __( 'product.enable_product_expiry' ) . ':'); ?>

            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_enable_expiry') . '"></i>';
                }
            ?>
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <?php echo Form::checkbox('enable_product_expiry', 1, $business->enable_product_expiry ); ?>

                </span>
                <select class="form-select" id="expiry_type" name="expiry_type" <?php if(!$business->enable_product_expiry): ?>
                    disabled <?php endif; ?>>
                    <option value="add_expiry" <?php if($business->expiry_type == 'add_expiry'): ?> selected <?php endif; ?>>
                        <?php echo e(__('lang_v1.add_expiry'), false); ?>

                    </option>
                    <option value="add_manufacturing" <?php if($business->expiry_type == 'add_manufacturing'): ?> selected
                        <?php endif; ?>><?php echo e(__('lang_v1.add_manufacturing_auto_expiry'), false); ?></option>
                </select>
            </div>
        </div>
        <div class="col-sm-4 <?php if(!$business->enable_product_expiry): ?> hide <?php endif; ?>" id="on_expiry_div">
            <div class="form-group mb-3">
                <div class="multi-input">
                    <?php echo Form::label('on_product_expiry', __('lang_v1.on_product_expiry') . ':'); ?>

                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_on_product_expiry') . '"></i>';
                }
            ?>
                    <br>
                    <?php echo Form::select('on_product_expiry', ['keep_selling'=>__('lang_v1.keep_selling'),
                    'stop_selling'=>__('lang_v1.stop_selling') ], $business->on_product_expiry, ['class' =>
                    'form-control float-start', 'style' => 'width:60%;']); ?>

                    <?php
                    $disabled = '';
                    if($business->on_product_expiry == 'keep_selling'){
                    $disabled = 'disabled';
                    }
                    ?>
                    <?php echo Form::number('stop_selling_before', $business->stop_selling_before, ['class' => 'form-control
                    float-start', 'placeholder' => 'stop n days before', 'style' => 'width:40%;', $disabled, 'required',
                    'id' => 'stop_selling_before']); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('default_product_tax_type', "Default Tax Type" . ':'); ?>

                <div class="input-group mb-3">
                    
                    <label class="input-group-text"><i class="fa fa-percent"></i></label>
                    <?php echo Form::select('common_settings[default_product_tax_type]', [''=> 'Please Select',
                    'none'=>'None','insclusive'=>'Inclusive','exclusive'=>'Exclusive'],
                    !empty($common_settings['default_product_tax_type']) ?
                    $common_settings['default_product_tax_type']
                    : 0, ['class' => 'form-select select2', 'style' => 'width: 80%;' ]); ?>

                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('ps_page_length', "Product Search No. of Results" . ':'); ?>

                <div class="input-group mb-3">
                    
                    <label class="input-group-text"><i class="fa fa-list"></i></label>
                    <?php echo Form::select('common_settings[ps_page_length]', ['10'=> '10', '20'=>'20', '25'=>'25','30'=>'30','50'=>'50','100'=>'100'],
                    !empty($common_settings['ps_page_length']) ?
                    $common_settings['ps_page_length']
                    : 10, ['class' => 'form-select select2', 'style' => 'width: 80%;' ]); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('default_stock_adjustment_type', __('stock_adjustment.adjustment_type') . ':'); ?>

                <div class="input-group mb-3">
                    <label class="input-group-text"><i class="fa fa-sliders-h"></i></label>
                    <?php echo Form::select(
                        'common_settings[default_stock_adjustment_type]',
                        [
                            'stock_adjustment' => __('stock_adjustment.stock_adjustment'),
                            'stock_take' => __('stock_adjustment.stock_take'),
                        ],
                        !empty($common_settings['default_stock_adjustment_type']) ? $common_settings['default_stock_adjustment_type'] : 'stock_adjustment',
                        ['class' => 'form-select select2', 'style' => 'width: 80%;']
                    ); ?>

                </div>
            </div>
        </div>
        <!-- </div> -->
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('enable_category', 1, $business->enable_category, [ 'class' =>
                        'form-check-input', 'id' => 'enable_category']); ?> <?php echo e(__( 'lang_v1.enable_category' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4 enable_sub_category <?php if($business->enable_category != 1): ?> hide <?php endif; ?>">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('enable_sub_category', 1, $business->enable_sub_category, [ 'class' =>
                        'form-check-input', 'id' => 'enable_sub_category']); ?> <?php echo e(__( 'lang_v1.enable_sub_category' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4 enable_sub2_category <?php if($business->enable_sub_category != 1): ?> hide <?php endif; ?>">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('enable_sub2_category', 1, $business->enable_sub2_category, [ 'class' =>
                        'form-check-input', 'id' => 'enable_sub2_category']); ?> <?php echo e(__( 'lang_v1.enable_sub2_category' ), false); ?>

                    </label>
                </div>
            </div>
        </div>        
        <!-- <div class="row"> -->
        <div class="col-sm-4">
                
                <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('enable_brand', 1, $business->enable_brand,
                        [ 'class' => 'form-check-input', 'id' => 'enable_brand']); ?> <?php echo e(__( 'lang_v1.enable_brand' ), false); ?>

                    </label>
                </div>
                </div>
               
                
        </div>
        <div class="col-sm-4 enable_sub_brand <?php if($business->enable_brand != 1): ?> hide <?php endif; ?>">
                <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('enable_sub_brand', 1, $business->enable_sub_brand,
                        [ 'class' => 'form-check-input', 'id' => 'enable_sub_brand']); ?> <?php echo e(__( 'lang_v1.enable_sub_brand' ), false); ?>

                    </label>
                </div>
                </div>
        </div>
        <div class="col-sm-4">
                <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('enable_gender', 1, $business->enable_gender,
                        [ 'class' => 'form-check-input', 'id' => 'enable_gender']); ?> <?php echo e(__( 'lang_v1.enable_gender' ), false); ?>

                    </label>
                </div>
                </div>
        </div>
        <div class="col-sm-4 enable_sub_gender <?php if($business->enable_gender != 1): ?> hide <?php endif; ?>">
                <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('enable_sub_gender', 1, $business->enable_sub_gender,
                        [ 'class' => 'form-check-input', 'id' => 'enable_sub_gender']); ?> <?php echo e(__( 'lang_v1.enable_sub_gender' ), false); ?>

                    </label>
                </div>
                </div>
        </div>
        <div class="col-sm-4">
                <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('enable_procurement_source', 1, $business->enable_procurement_source,
                        [ 'class' => 'form-check-input', 'id' => 'enable_procurement_source']); ?> <?php echo e(__( 'lang_v1.enable_procurement_source' ), false); ?>

                    </label>
                </div>
                </div>
        </div>
        <div class="col-sm-4 enable_sub_procurement_source <?php if($business->enable_procurement_source != 1): ?> hide <?php endif; ?>">
                <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('enable_sub_procurement_source', 1, $business->enable_sub_procurement_source,
                        [ 'class' => 'form-check-input', 'id' => 'enable_sub_procurement_source']); ?> <?php echo e(__( 'lang_v1.enable_sub_procurement_source' ), false); ?>

                    </label>
                </div> 
                </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[product_custom_labels_textarea]', 1,
                        !empty($common_settings['product_custom_labels_textarea']) ?
                        $common_settings['product_custom_labels_textarea'] :
                        0 ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e("Make Custom Labels Textarea", false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_product_description]', 1,
                        !empty($common_settings['enable_product_description']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_product_description' ), false); ?>

                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_product_weight]', 1,
                        !empty($common_settings['enable_product_weight']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_product_weight' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_product_image]', 1,
                        !empty($common_settings['enable_product_image']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_product_image' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[is_product_image_required]', 1,
                        !empty($common_settings['is_product_image_required']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.is_product_image_required' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_product_brochure]', 1,
                        !empty($common_settings['enable_product_brochure']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_product_brochure' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        
        <!-- </div> -->
        <div class="clearfix"></div>
        <!-- <div class="row"> -->
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('enable_racks', 1, $business->enable_racks, [ 'class' =>
                        'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_racks' ), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_enable_racks') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('enable_row', 1, $business->enable_row, [ 'class' => 'form-check-input']); ?>

                        <?php echo e(__( 'lang_v1.enable_row' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('enable_position', 1, $business->enable_position, [ 'class' =>
                        'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_position' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_kot_printer_prepration_time]', 1, 
                        !empty($common_settings['enable_kot_printer_prepration_time']) ? true : false,
                         [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_kot_printer_prepration_time' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_prompt_msg]', 1, 
                        !empty($common_settings['enable_prompt_msg']) ? true : false,
                         [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_prompt_msg' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[warn_negative_profit_margin]', 1, 
                        !empty($common_settings['warn_negative_profit_margin']) ? true : false,
                         [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.warn_negative_profit_margin' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_prices]', 1, 
                        empty($common_settings['enable_prices']) ? false : true,
                         [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_prices' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_product_tax]', 1,
                        !array_key_exists('enable_product_tax', $common_settings) || !empty($common_settings['enable_product_tax']),
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_product_tax' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_discount]', 1,
                        !empty($common_settings['enable_discount']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_discount' ), false); ?>

                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('enable_pct_code', 1, $business->enable_pct_code ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_pct_code' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[send_zero_if_pct_code_missing]', 1,
                        !empty($common_settings['send_zero_if_pct_code_missing']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.send_zero_if_pct_code_missing' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_product_warranty]', 1,
                        !empty($common_settings['enable_product_warranty']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_product_warranty' ), false); ?>

                    </label>
                </div>
            </div>
        </div>

        

        

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_potency]', 1,
                        !empty($common_settings['enable_potency']) ? $common_settings['enable_potency'] :
                        0 ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_potency' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_drugs_class]', 1,
                        !empty($common_settings['enable_drugs_class']) ? $common_settings['enable_drugs_class'] :
                        0 ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_drugs_class' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[warn_same_product_name]', 1,
                        !empty($common_settings['warn_same_product_name']) ? $common_settings['warn_same_product_name'] :
                        0 ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.warn_same_product_name' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_purchase_price_for_purchased]', 1, 
                        !empty($common_settings['enable_purchase_price_for_purchased']) ? true : false,
                         [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_purchase_price_for_purchased' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_stock_issue_receive]', 1, 
                        !empty($common_settings['enable_stock_issue_receive']) ? true : false,
                         [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_stock_issue_receive' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[enable_booking_hourly_services]', 1, 
                        !empty($common_settings['enable_booking_hourly_services']) ? true : false,
                         [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_booking_hourly_services' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('common_settings[variation_sku_suffix_length]', "Variation SKU Suffix Length" . ':'); ?>

                <div class="input-group mb-3">
                    <label class="input-group-text"><i class="fa fa-list"></i></label>
                    <?php echo Form::select('common_settings[variation_sku_suffix_length]', ['1'=> '01', '2'=>'001', '3'=>'0001'],
                    !empty($common_settings['variation_sku_suffix_length']) ?
                    $common_settings['variation_sku_suffix_length']
                    : 1, ['class' => 'form-select select2', 'style' => 'width: 80%;' ]); ?>

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
                                    <?php echo Form::checkbox('common_settings[enable_other_product_name]', 1,
                                    !empty($common_settings['enable_other_product_name']) ? $common_settings['enable_other_product_name'] :
                                    0,
                                    [ 'class' => 'form-check-input', 'id'=> 'enable_other_product_name']); ?> <?php echo e(__( 'lang_v1.enable_other_product_name' ), false); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class=" col-sm-4 <?php if(empty($common_settings['enable_other_product_name'])){ echo "hide" ;} ?>"
                                id="other_product_name_label_div">
                            <div class="form-group mb-3">
                                
                                <?php echo Form::text('common_settings[other_product_name_label]',
                                !empty($common_settings['other_product_name_label'])
                                ?
                                $common_settings['other_product_name_label'] : 'Other Product Name' , ['class' => 'form-control',
                                'style' => 'width: 75%']); ?>

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
                                    <?php echo Form::checkbox('common_settings[enable_generic_name]', 1,
                                    !empty($common_settings['enable_generic_name']) ? $common_settings['enable_generic_name'] :
                                    0,
                                    [ 'class' => 'form-check-input', 'id'=> 'enable_generic_name']); ?> <?php echo e(__( 'lang_v1.enable_generic_name' ), false); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class=" col-sm-4 <?php if(empty($common_settings['enable_generic_name'])){ echo "hide" ;} ?>"
                                id="generic_name_label_div">
                            <div class="form-group mb-3">
                                
                                <?php echo Form::text('common_settings[generic_name_label]',
                                !empty($common_settings['generic_name_label'])
                                ?
                                $common_settings['generic_name_label'] : 'Generic Name' , ['class' => 'form-control',
                                'style' => 'width: 75%']); ?>

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
                                    <?php echo Form::checkbox('common_settings[enable_serial_number]', 1,
                                    !empty($common_settings['enable_serial_number']) ? $common_settings['enable_serial_number'] :
                                    0 ,
                                    [ 'class' => 'form-check-input', 'id'=>'enable_serial_number']); ?>  <?php echo app('translator')->get('lang_v1.enable_serial_number'); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class=" col-sm-4 <?php if(empty($common_settings['enable_serial_number'])){ echo "hide" ;} ?>"
                                id="serial_number_label_div">
                            <div class="form-group mb-3">
                                
                                <?php echo Form::text('common_settings[serial_number_label]',
                                !empty($common_settings['serial_number_label'])
                                ?
                                $common_settings['serial_number_label'] : 'Serial Number' , ['class' => 'form-control',
                                'style' => 'width: 75%']); ?>

                            </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class=" col-sm-4 <?php if(empty($common_settings['enable_serial_number'])){ echo "hide" ;} ?>"
                                id="serial_number_label_div">
                                <div class="form-group mb-3">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                    <?php echo Form::checkbox('common_settings[enable_imei_number]', 1,
                                            !empty($common_settings['enable_imei_number']) ? $common_settings['enable_imei_number'] :
                                            0 ,
                                            [ 'class' => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.enable_imei_number'); ?>
                                        </label>
                                    </div>
                                </div>
                    </div>

                    <div class=" col-sm-4 <?php if(empty($common_settings['enable_serial_number'])){ echo "hide" ;} ?>"
                                id="serial_number_label_div">
                            <div class="form-group mb-3">
                                
                                <?php echo Form::text('common_settings[imei1_number_label]',
                                !empty($common_settings['imei1_number_label'])
                                ?
                                $common_settings['imei1_number_label'] : '' , ['class' => 'form-control', 'placeholder'=> 'IMEI-1 Number Label',
                                'style' => 'width: 75%']); ?>

                            </div>
                            <div class="form-group mb-3">
                                
                                <?php echo Form::text('common_settings[imei3_number_label]',
                                !empty($common_settings['imei3_number_label'])
                                ?
                                $common_settings['imei3_number_label'] : '' , ['class' => 'form-control', 'placeholder'=> 'IMEI-3 Number Label',
                                'style' => 'width: 75%']); ?>

                            </div>
                    </div>

                    <div class=" col-sm-4 <?php if(empty($common_settings['enable_serial_number'])){ echo "hide" ;} ?>"
                                id="serial_number_label_div">
                            <div class="form-group mb-3">
                                
                                <?php echo Form::text('common_settings[imei2_number_label]',
                                !empty($common_settings['imei2_number_label'])
                                ?
                                $common_settings['imei2_number_label'] : '' , ['class' => 'form-control', 'placeholder'=> 'IMEI-2 Number Label',
                                'style' => 'width: 75%']); ?>

                            </div>
                            <div class="form-group mb-3">
                                
                                <?php echo Form::text('common_settings[imei4_number_label]',
                                !empty($common_settings['imei4_number_label'])
                                ?
                                $common_settings['imei4_number_label'] : '' , ['class' => 'form-control', 'placeholder'=> 'IMEI-4 Number Label',
                                'style' => 'width: 75%']); ?>

                            </div>
                    </div>        
                </div>        
            </div>        
        </div>        
        <div class="col-sm-12">
            <h4><?php echo app('translator')->get('lang_v1.hide_sidebar_products_feature'); ?>:</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_print_labels]', 1,
                        !empty($common_settings['hide_print_labels']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_print_labels' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_product_variations]', 1,
                        !empty($common_settings['hide_product_variations']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_product_variations' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_import_products]', 1,
                        !empty($common_settings['hide_import_products']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_import_products' ), false); ?>

                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_import_opening_stock]', 1,
                        !empty($common_settings['hide_import_opening_stock']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_import_opening_stock' ), false); ?>

                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_selling_price_group]', 1,
                        !empty($common_settings['hide_selling_price_group']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_selling_price_group' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        

        <div class="col-sm-12">
            <h4><?php echo app('translator')->get('lang_v1.add_quick_product'); ?>:</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_categories]', 1,
                        !empty($common_settings['hide_categories']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_categories' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_brand]', 1,
                        !empty($common_settings['hide_brand']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_brand' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_custom_fields]', 1,
                        !empty($common_settings['hide_custom_fields']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_custom_fields' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_product_description]', 1,
                        !empty($common_settings['hide_product_description']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_product_description' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_product_image]', 1,
                        !empty($common_settings['hide_product_image']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_product_image' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
       
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_Woocommerce]', 1,
                        !empty($common_settings['hide_Woocommerce']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_Woocommerce' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_Not_for_selling]', 1,
                        !empty($common_settings['hide_Not_for_selling']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_Not_for_selling' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_warranty]', 1,
                        !empty($common_settings['hide_warranty']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_warranty' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_weight]', 1,
                        !empty($common_settings['hide_weight']) ,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_weight' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        
        <?php echo $__env->make('business.partials.settings_custom_label_group', [
            'custom_label_group_key' => 'product',
            'custom_label_group_title' => __('lang_v1.labels_for_product_custom_fields'),
            'custom_label_col' => 'col-sm-3',
            'custom_label_fields' => [
                ['key' => 'custom_field_1', 'id' => 'product_custom_field_1_label', 'label' => __('lang_v1.product_custom_field1')],
                ['key' => 'custom_field_2', 'id' => 'product_custom_field_2_label', 'label' => __('lang_v1.product_custom_field2')],
                ['key' => 'custom_field_3', 'id' => 'product_custom_field_3_label', 'label' => __('lang_v1.product_custom_field3')],
                ['key' => 'custom_field_4', 'id' => 'product_custom_field_4_label', 'label' => __('lang_v1.product_custom_field4')],
                ['key' => 'custom_field_5', 'id' => 'product_custom_field_5_label', 'label' => __('lang_v1.product_custom_field5')],
                ['key' => 'custom_field_6', 'id' => 'product_custom_field_6_label', 'label' => __('lang_v1.product_custom_field6')],
                ['key' => 'custom_field_7', 'id' => 'product_custom_field_7_label', 'label' => __('lang_v1.product_custom_field7')],
                ['key' => 'custom_field_8', 'id' => 'product_custom_field_8_label', 'label' => __('lang_v1.product_custom_field8')],
            ],
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
