<!--Purchase related settings -->
<div class="pos-tab-content">
    <div class="row">
    <?php if(!config('constants.disable_purchase_in_other_currency', true)): ?>
    <div class="col-sm-4">
        <div class="mb-3">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('purchase_in_diff_currency', 1, $business->purchase_in_diff_currency , 
                [ 'class' => 'form-check-input', 'id' => 'purchase_in_diff_currency']); ?> <?php echo e(__( 'purchase.allow_purchase_different_currency' ), false); ?>

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
    <div class="col-sm-4 <?php if($business->purchase_in_diff_currency != 1): ?> hide <?php endif; ?>" id="settings_purchase_currency_div">
        <div class="mb-3">
            <?php echo Form::label('purchase_currency_id', __('purchase.purchase_currency') . ':'); ?>

            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-money-bill-alt"></i>
                </span>
                <?php echo Form::select('purchase_currency_id', $currencies, $business->purchase_currency_id, ['class' => 'form-control select2', 'placeholder' => __('business.currency'), 'required', 'style' => 'width:100% !important']); ?>

            </div>
        </div>
    </div>
    <div class="col-sm-4 <?php if($business->purchase_in_diff_currency != 1): ?> hide <?php endif; ?>" id="settings_currency_exchange_div">
        <div class="mb-3">
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
                <?php echo Form::number('p_exchange_rate', $business->p_exchange_rate, ['class' => 'form-control', 'placeholder' => __('business.p_exchange_rate'), 'required', 'step' => '0.001']); ?>

            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="clearfix"></div>
    
    <div class="col-sm-4">
        <div class="mb-3">
            <?php echo Form::label('purchase_status', "Default Purchase Status" . ':'); ?>

            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa fa-balance-scale"></i>
                </span>
                <?php echo Form::select('common_settings[default_purchase_status]', ['none'=>'None','received'=>'Received','pending'=>'Pending','ordered'=>'Ordered'],
                 !empty($common_settings['default_purchase_status']) ? $common_settings['default_purchase_status'] : 0, ['class' => 'form-control select2', 'style' => 'width: 100%;' ]); ?>

            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    
    <div class="col-sm-6">
        <div class="mb-3">
            <div class="form-check">
              <label class="form-check-label">
<?php echo Form::checkbox('enable_editing_product_from_purchase', 1, $business->enable_editing_product_from_purchase , 
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

    <div class="col-sm-6">
        <div class="mb-3">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('enable_purchase_status', 1, $business->enable_purchase_status , [ 'class' => 'form-check-input', 'id' => 'enable_purchase_status']); ?> <?php echo e(__( 'lang_v1.enable_purchase_status' ), false); ?>

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
<div class="clearfix"></div>
    <div class="col-sm-6">
        <div class="mb-3">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('enable_lot_number', 1, $business->enable_lot_number , [ 'class' => 'form-check-input', 'id' => 'enable_lot_number']); ?> <?php echo e(__( 'lang_v1.enable_lot_number' ), false); ?>

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

    <div class="col-sm-6">
        <div class="mb-3">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_purchase_order]', 1, !empty($common_settings['enable_purchase_order']) , [ 'class' => 'form-check-input', 'id' => 'enable_purchase_order']); ?> <?php echo e(__( 'lang_v1.enable_purchase_order' ), false); ?>

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

    <div class="clearfix"></div>

    <div class="col-sm-6">
        <div class="mb-3">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_purchase_requisition]', 1, !empty($common_settings['enable_purchase_requisition']) , [ 'class' => 'form-check-input', 'id' => 'enable_purchase_requisition']); ?> <?php echo e(__( 'lang_v1.enable_purchase_requisition' ), false); ?>

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

    <div class="clearfix"></div>
        
        <div class="col-sm-4">
            <div class="mb-3">
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
            <div class="mb-3">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[is_tax_inclusive_purchase]', 1, 
                        !empty($common_settings['is_tax_inclusive_purchase']) ? true : false, 
                    [ 'class' => 'form-check-input']); ?> <?php echo e("Is Tax Inclusive on Puchaes?", false); ?>

                  </label>
                </div>
            </div>
        </div>

    </div>
</div>
