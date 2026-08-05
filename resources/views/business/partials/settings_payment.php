<!--payment related settings -->
<div class="pos-tab-content">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <?php echo Form::label('cash_denominations', __('lang_v1.cash_denominations') . ':'); ?>

                 <?php echo Form::text('pos_settings[cash_denominations]', isset($pos_settings['cash_denominations']) ? $pos_settings['cash_denominations'] : null, ['class' => 'form-control', 'id' => 'cash_denominations']); ?>

                 <p class="help-block"><?php echo e(__('lang_v1.cash_denominations_help'), false); ?></p>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('enable_cash_denomination_on', __('lang_v1.enable_cash_denomination_on') . ':'); ?>

                <?php echo Form::select('pos_settings[enable_cash_denomination_on]', ['pos_screen' => __('lang_v1.pos_screen'), 'all_screens' => __('lang_v1.all_screen')], isset($pos_settings['enable_cash_denomination_on']) ? $pos_settings['enable_cash_denomination_on'] : 'pos_screen', ['class' => 'form-control', 'style' => 'width: 100%;' ]); ?>

            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('enable_cash_denomination_for_payment_methods', __('lang_v1.enable_cash_denomination_for_payment_methods') . ':'); ?>

                <?php echo Form::select('pos_settings[enable_cash_denomination_for_payment_methods][]', $payment_types, isset($pos_settings['enable_cash_denomination_for_payment_methods']) ? $pos_settings['enable_cash_denomination_for_payment_methods'] : null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'multiple' ]); ?>

            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                <br>
                  <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[cash_denomination_strict_check]', 1,  
                        !empty($pos_settings['cash_denomination_strict_check']) , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.strict_check' ), false); ?>

                  </label>
                  <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.strict_check_help') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <?php echo Form::label('quick_cash_buttons', __('lang_v1.quick_cash_buttons') . ':'); ?>

                 <?php echo Form::text('pos_settings[quick_cash_buttons]', isset($pos_settings['quick_cash_buttons']) ? $pos_settings['quick_cash_buttons'] : null, ['class' => 'form-control', 'id' => 'quick_cash_buttons']); ?>

                 <p class="help-block"><?php echo e(__('lang_v1.quick_cash_buttons_help'), false); ?></p>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('cheque_posting_ledger', __('lang_v1.cheque_posting_ledger') . ':'); ?>

                <?php echo Form::select('common_settings[cheque_posting_ledger]', ['issue_date' => __('lang_v1.issue_date'), 'posting_date' => __('lang_v1.posting_date'), 'clearance_date' => __('lang_v1.clearance_date')], isset($common_settings['cheque_posting_ledger']) ? $common_settings['cheque_posting_ledger'] : 'issue_date', ['class' => 'form-control', 'style' => 'width: 100%;' ]); ?>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                <br>
                  <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_product_sold_details_register]', 1,  
                        !empty($pos_settings['enable_product_sold_details_register']) , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_product_sold_details_register' ), false); ?>

                  </label>
                  
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                <br>
                  <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_product_stock_details_register]', 1,  
                        !empty($pos_settings['enable_product_stock_details_register']) , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_product_stock_details_register' ), false); ?>

                  </label>
                  
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                <br>
                  <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_drafts_details_register]', 1,  
                        !empty($pos_settings['enable_drafts_details_register']) , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_drafts_details_register' ), false); ?>

                  </label>
                  
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                <br>
                  <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_expense_details_register]', 1,  
                        !empty($pos_settings['enable_expense_details_register']) , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_expense_details_register' ), false); ?>

                  </label>
                  
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                <br>
                  <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_paid_purchase_details_register]', 1,  
                        !empty($pos_settings['enable_paid_purchase_details_register']) , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_paid_purchase_details_register' ), false); ?>

                  </label>
                  
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                <br>
                  <label class="form-check-label">
                    <?php echo Form::checkbox('pos_settings[enable_cash_register_sync_with_workstations]', 1,  
                        !empty($pos_settings['enable_cash_register_sync_with_workstations']) , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_cash_register_sync_with_workstations' ), false); ?>

                  </label>
                  
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                <br>
                  <label class="form-check-label">
                    <?php echo Form::checkbox('pos_settings[set_payment_modal_amount_zero]', 1,  
                        !empty($pos_settings['set_payment_modal_amount_zero']) , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.set_payment_modal_amount_zero' ), false); ?>

                  </label>
                  
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                <br>
                  <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[is_user_required_on_payments]', 1,
                        !empty($pos_settings['is_user_required_on_payments']) ,
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.is_user_required_on_payments' ), false); ?>

                  </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                <br>
                  <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_payment_note]', 1,  
                        !empty($pos_settings['enable_payment_note']) , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_payment_note' ), false); ?>

                  </label>
                  
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                <br>
                  <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[hide_pay_print_btn_multipay]', 1,  
                        !empty($pos_settings['hide_pay_print_btn_multipay']) , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_pay_print_btn_multipay' ), false); ?>

                  </label>
                  
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <br>
                On Multipay Modal Enter:
                <br>
                <label class="radio-inline">
                    <input type="radio" name="pos_settings[multipay_modal_enter]" id="multipay_modal_enter" value="save_n_print" 
                    <?php if(!empty($pos_settings['multipay_modal_enter']) && $pos_settings['multipay_modal_enter'] == 'save_n_print'): ?> checked <?php elseif($pos_settings['multipay_modal_enter'] != 'save'): ?>  checked <?php endif; ?>>
                    <?php echo app('translator')->get('lang_v1.save_and_print'); ?>
                </label>
                <label class="radio-inline">
                    <input type="radio" name="pos_settings[multipay_modal_enter]" id="multipay_modal_enter" value="save" 
                    <?php if(!empty($pos_settings['multipay_modal_enter']) && $pos_settings['multipay_modal_enter'] == 'save'): ?> checked <?php endif; ?>>
                    <?php echo app('translator')->get('messages.save'); ?>
                </label>
            </div>
        </div>
        <div class="clearfix"></div>
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                
                <div class="form-check">
                <br>
                  <label class="form-check-label">
<?php echo Form::checkbox('pos_settings[enable_cash_pull]', 1,  
                        !empty($pos_settings['enable_cash_pull']), 
                    [ 'class' => 'form-check-input', 'id'=> 'enable_cash_pull']); ?> <?php echo e(__( 'lang_v1.enable_cash_pull' ), false); ?>

                  </label>
                  
                </div>
            </div>
        </div>
        
        <div class="col-sm-4 <?php if(empty($pos_settings['enable_cash_pull'])){ echo " hide"; } ?>" id="enable_cash_pull_div">
            <div class="form-group mb-3">
                <?php echo Form::label('cash_pull_limit', __('lang_v1.cash_pull_limit') . ':'); ?>

                <?php echo Form::text('pos_settings[cash_pull_limit]', !empty($pos_settings['cash_pull_limit']) ? $pos_settings['cash_pull_limit'] : null , ['class' => 'form-control', 'placeholder'=> 'Amount',
                'style' => 'width:80%']); ?>

            </div>
        </div>
        <div class="col-sm-4 <?php if(empty($pos_settings['enable_cash_pull'])){ echo " hide"; } ?>" id="enable_cash_pull_div">
            <div class="form-group mb-3">
                <?php echo Form::label('cash_pull_warn_interval', __('lang_v1.cash_pull_warn_interval') . ':'); ?>

                <?php echo Form::text('pos_settings[cash_pull_warn_interval]', !is_null($pos_settings['cash_pull_warn_interval']) ? $pos_settings['cash_pull_warn_interval'] : 10 , ['class' => 'form-control', 'placeholder'=> 'Enter Minutes',
                'style' => 'width:80%']); ?>

            </div>
        </div>
    
        <div class="clearfix"></div>
        <hr>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                <br>
                  <label class="form-check-label">
                    <?php echo Form::checkbox('common_settings[customer_payment_hide_address]', 1,  
                        !empty($common_settings['customer_payment_hide_address']) , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.customer_payment_hide_address' ), false); ?>

                  </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                <br>
                  <label class="form-check-label">
                    <?php echo Form::checkbox('common_settings[supplier_payment_hide_address]', 1,  
                        !empty($common_settings['supplier_payment_hide_address']) , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.supplier_payment_hide_address' ), false); ?>

                  </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-check">
                <br>
                  <label class="form-check-label">
                    <?php echo Form::checkbox('common_settings[expense_payment_hide_address]', 1,  
                        !empty($common_settings['expense_payment_hide_address']) , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.expense_payment_hide_address' ), false); ?>

                  </label>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <div class="form-group mb-3">
                <?php echo Form::label('customer_payment_header',__('lang_v1.customer_payment_header') . ':'); ?>

                <?php echo Form::textarea('common_settings[customer_payment_header]', $common_settings['customer_payment_header'] ?? '',
                ['class' => 'form-control', 'placeholder' => __('lang_v1.customer_payment_header'), 'rows' => 3, 'id' => 'customer_payment_header']); ?>

            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group mb-3">
                <?php echo Form::label('supplier_payment_header',__('lang_v1.supplier_payment_header') . ':'); ?>

                <?php echo Form::textarea('common_settings[supplier_payment_header]', $common_settings['supplier_payment_header'] ?? '',
                ['class' => 'form-control', 'placeholder' => __('lang_v1.supplier_payment_header'), 'rows' => 3, 'id' => 'supplier_payment_header']); ?>

            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group mb-3">
                <?php echo Form::label('expense_payment_header',__('lang_v1.expense_payment_header') . ':'); ?>

                <?php echo Form::textarea('common_settings[expense_payment_header]', $common_settings['expense_payment_header'] ?? '',
                ['class' => 'form-control', 'placeholder' => __('lang_v1.expense_payment_header'), 'rows' => 3, 'id' => 'expense_payment_header']); ?>

            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group mb-3">
                <?php echo Form::label('customer_payment_footer',__('lang_v1.customer_payment_footer') . ':'); ?>

                <?php echo Form::textarea('common_settings[customer_payment_footer]', $common_settings['customer_payment_footer'] ?? '',
                ['class' => 'form-control', 'placeholder' => __('lang_v1.customer_payment_footer'), 'rows' => 3, 'id' => 'customer_payment_footer']); ?>

            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group mb-3">
                <?php echo Form::label('supplier_payment_footer',__('lang_v1.supplier_payment_footer') . ':'); ?>

                <?php echo Form::textarea('common_settings[supplier_payment_footer]', $common_settings['supplier_payment_footer'] ?? '',
                ['class' => 'form-control', 'placeholder' => __('lang_v1.supplier_payment_footer'), 'rows' => 3, 'id' => 'supplier_payment_footer']); ?>

            </div>
        </div>
    </div>
</div>
