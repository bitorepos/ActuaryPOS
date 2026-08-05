<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-4">
            <div class="mb-3">
                <?php echo Form::label('sku_prefix', __('business.sku_prefix') . ':'); ?>

                 <?php echo Form::text('sku_prefix', $business->sku_prefix, ['class' => 'form-control text-uppercase']); ?>

            </div>
        </div>
        
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

            <div class="input-group">
                <span class="input-group-text">
                    <?php echo Form::checkbox('enable_product_expiry', 1, $business->enable_product_expiry ); ?> 
                </span>

                <select class="form-control" id="expiry_type"
                    name="expiry_type" 
                    <?php if(!$business->enable_product_expiry): ?> disabled <?php endif; ?>>
                    <option value="add_expiry" <?php if($business->expiry_type == 'add_expiry'): ?> selected <?php endif; ?>>
                        <?php echo e(__('lang_v1.add_expiry'), false); ?>

                    </option>
                  <option value="add_manufacturing" <?php if($business->expiry_type == 'add_manufacturing'): ?> selected <?php endif; ?>><?php echo e(__('lang_v1.add_manufacturing_auto_expiry'), false); ?></option>
                </select>
            </div>
        </div>

        <div class="col-sm-4 <?php if(!$business->enable_product_expiry): ?> hide <?php endif; ?>" id="on_expiry_div">
            <div class="mb-3">
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

                    <?php echo Form::select('on_product_expiry',     ['keep_selling'=>__('lang_v1.keep_selling'), 'stop_selling'=>__('lang_v1.stop_selling') ], $business->on_product_expiry, ['class' => 'form-control float-start', 'style' => 'width:60%;']); ?>


                    <?php
                        $disabled = '';
                        if($business->on_product_expiry == 'keep_selling'){
                            $disabled = 'disabled';
                        }
                    ?>

                    <?php echo Form::number('stop_selling_before', $business->stop_selling_before, ['class' => 'form-control float-start', 'placeholder' => 'stop n days before', 'style' => 'width:40%;', $disabled, 'required', 'id' => 'stop_selling_before']); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="mb-3">
                <div class="form-check">
                  <label class="form-check-label">
<?php echo Form::checkbox('enable_brand', 1, $business->enable_brand, 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_brand' ), false); ?>

                  </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <div class="form-check">
                  <label class="form-check-label">
<?php echo Form::checkbox('enable_category', 1, $business->enable_category, [ 'class' => 'form-check-input', 'id' => 'enable_category']); ?> <?php echo e(__( 'lang_v1.enable_category' ), false); ?>

                  </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4 enable_sub_category <?php if($business->enable_category != 1): ?> hide <?php endif; ?>">
            <div class="mb-3">
                <div class="form-check">
                  <label class="form-check-label">
<?php echo Form::checkbox('enable_sub_category', 1, $business->enable_sub_category, [ 'class' => 'form-check-input', 'id' => 'enable_sub_category']); ?> <?php echo e(__( 'lang_v1.enable_sub_category' ), false); ?>

                  </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="mb-3">
                <div class="form-check">
                  <label class="form-check-label">
<?php echo Form::checkbox('enable_price_tax', 1, $business->enable_price_tax, [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_price_tax' ), false); ?>

                  </label>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="mb-3">
                <?php echo Form::label('default_unit', __('lang_v1.default_unit') . ':'); ?>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa fa-balance-scale"></i>
                    </span>
                    <?php echo Form::select('default_unit', $units_dropdown, $business->default_unit, ['class' => 'form-control select2', 'style' => 'width: 100%;' ]); ?>

                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <div class="form-check">
                  <label class="form-check-label">
<?php echo Form::checkbox('enable_sub_units', 1, $business->enable_sub_units, [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_sub_units' ), false); ?>

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

        <div class="clearfix"></div>

        <div class="col-sm-4">
            <div class="mb-3">
                <div class="form-check">
                  <label class="form-check-label">
<?php echo Form::checkbox('enable_racks', 1, $business->enable_racks, [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_racks' ), false); ?>

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
            <div class="mb-3">
                <div class="form-check">
                  <label class="form-check-label">
<?php echo Form::checkbox('enable_row', 1, $business->enable_row, [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_row' ), false); ?>

                  </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <div class="form-check">
                  <label class="form-check-label">
<?php echo Form::checkbox('enable_position', 1, $business->enable_position, [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_position' ), false); ?>

                  </label>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="mb-3">
                <div class="form-check">
                  <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_product_warranty]', 1, !empty($common_settings['enable_product_warranty']) ? true : false, 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_product_warranty' ), false); ?>

                  </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4 <?php if(config('constants.enable_secondary_unit') == false): ?> hide <?php endif; ?>">
            <div class="mb-3">
                <div class="form-check">
                  <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_secondary_unit]', 1, !empty($common_settings['enable_secondary_unit']) ? true : false, 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_secondary_unit' ), false); ?>

                  </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <div class="form-check">
                  <label class="form-check-label">
<?php echo Form::checkbox('common_settings[is_product_image_required]', 1, 
                        !empty($common_settings['is_product_image_required']) ? true : false, 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.is_product_image_required' ), false); ?>

                  </label>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="col-sm-4">
            <div class="mb-3">
                <div class="form-check">
                  <label class="form-check-label">
<?php echo Form::checkbox('enable_pct_code', 1, $business->enable_pct_code , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_pct_code' ), false); ?>

                  </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="mb-3">
                <div class="form-check">
                  <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_generic_name]', 1, !empty($common_settings['enable_generic_name']) ? $common_settings['enable_generic_name'] : 0 , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_generic_name' ), false); ?>

                  </label>
                </div>
            </div>
        </div>
                  
        <div class="clearfix"></div>
        <div class="col-sm-4">
        <div class="mb-3">
            <?php echo Form::label('default_product_tax_type', "Default Tax Type" . ':'); ?>

            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa fa-percent"></i>
                </span>
                <?php echo Form::select('common_settings[default_product_tax_type]', [''=> 'Please Select', 'none'=>'None','insclusive'=>'Inclusive','exclusive'=>'Exclusive'],
                 !empty($common_settings['default_product_tax_type']) ? $common_settings['default_product_tax_type'] : 0, ['class' => 'form-control select2', 'style' => 'width: 100%;' ]); ?>

            </div>
          </div>
        </div>
        <div class="col-sm-4">
            <div class="mb-3">
                <?php echo Form::label('generic_name_label', __('business.generic_name_label') . ':'); ?>

                 <?php echo Form::text('common_settings[generic_name_label]', !empty($common_settings['generic_name_label']) ? $common_settings['generic_name_label'] : '' , ['class' => 'form-control']); ?>

            </div>
        </div>

    </div>
</div>
