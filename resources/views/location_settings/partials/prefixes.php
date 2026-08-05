<div class="p-3">
     <?php
        $format_key = 'transaction_number_format';
        $transaction_number_format = !empty($location->ref_no_prefixes[$format_key]) ? $location->ref_no_prefixes[$format_key] : 'year';
        $transaction_number_format = in_array($transaction_number_format, ['blank', 'year']) ? $transaction_number_format : 'year';
        $preview_prefix = !empty($location->ref_no_prefixes['purchase']) ? $location->ref_no_prefixes['purchase'] : 'PI';
        $preview_location_code = !empty($location->loc_code) ? $location->loc_code : '01';
        $preview_number = $preview_prefix . $preview_location_code . ($transaction_number_format == 'year' ? date('Y') : '') . config('constants.invoice_scheme_separator') . '000001';
     ?>
     <div class="row mb-3">
        <div class="col-sm-12">
            <label class="mb-2"><?php echo app('translator')->get('lang_v1.transaction_number_format'); ?>:</label>
        </div>
        <div class="option-div-group row">
            <div class="col-sm-4">
                <div class="form-group mb-2">
                    <div class="option-div <?php if($transaction_number_format == 'blank'): ?> active <?php endif; ?>">
                        <h4>FORMAT: <br>XXXX <i class="fa fa-check-circle float-end icon"></i></h4>
                        <input type="radio" name="ref_no_prefixes[transaction_number_format]" value="blank" <?php if($transaction_number_format == 'blank'): ?> checked <?php endif; ?>>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group mb-2">
                    <div class="option-div <?php if($transaction_number_format == 'year'): ?> active <?php endif; ?>">
                        <h4>FORMAT: <br><?php echo e(date('Y'), false); ?><?php echo e(config('constants.invoice_scheme_separator'), false); ?>XXXX <i class="fa fa-check-circle float-end icon"></i></h4>
                        <input type="radio" name="ref_no_prefixes[transaction_number_format]" value="year" <?php if($transaction_number_format == 'year'): ?> checked <?php endif; ?>>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group mb-2">
                    <label><?php echo app('translator')->get('invoice.preview'); ?>:</label>
                    <div id="location_prefix_preview"
                        data-location-code="<?php echo e($preview_location_code, false); ?>"
                        data-prefix-selector="input[name='ref_no_prefixes[purchase]']"><?php echo e($preview_number, false); ?></div>
                </div>
            </div>
        </div>
     </div>
     <div class="row">
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $business_location_prefix = '';
                    if(!empty($location->ref_no_prefixes['business_location'])){
                        $business_location_prefix = $location->ref_no_prefixes['business_location'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[business_location]', __('business.business_location') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[business_location]', $business_location_prefix, ['class' => 'form-control','placeholder' => __('BL')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $username_prefix = !empty($location->ref_no_prefixes['username']) ? $location->ref_no_prefixes['username'] : '';
                ?>
                <?php echo Form::label('ref_no_prefixes[username]', __('business.username') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[username]', $username_prefix, ['class' => 'form-control','placeholder' => __('UR')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $contacts_prefix = '';
                    if(!empty($location->ref_no_prefixes['contacts'])){
                        $contacts_prefix = $location->ref_no_prefixes['contacts'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[contacts]', __('contact.contacts') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[contacts]', $contacts_prefix, ['class' => 'form-control','placeholder' => __('CO')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $contact_payment_prefix = '';
                    if(!empty($location->ref_no_prefixes['contact_payment'])){
                        $contact_payment_prefix = $location->ref_no_prefixes['contact_payment'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[contact_payment]', __('contact.contact_payment') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[contact_payment]', $contact_payment_prefix, ['class' => 'form-control','placeholder' => __('CP')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $opening_balance_prefix = '';
                    if(!empty($location->ref_no_prefixes['opening_balance'])){
                        $opening_balance_prefix = $location->ref_no_prefixes['opening_balance'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[opening_balance]', __('contact.opening_balance') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[opening_balance]', $opening_balance_prefix, ['class' => 'form-control','placeholder' => __('OB')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $advance_deposit_prefix = '';
                    if(!empty($location->ref_no_prefixes['advance_deposit'])){
                        $advance_deposit_prefix = $location->ref_no_prefixes['advance_deposit'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[advance_deposit]', __('lang_v1.advance_deposit') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[advance_deposit]', $advance_deposit_prefix, ['class' => 'form-control','placeholder' => __('AD')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $ledger_discount_prefix = '';
                    if(!empty($location->ref_no_prefixes['ledger_discount'])){
                        $ledger_discount_prefix = $location->ref_no_prefixes['ledger_discount'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[ledger_discount]', __('lang_v1.ledger_discount') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[ledger_discount]', $ledger_discount_prefix, ['class' => 'form-control','placeholder' => __('LD')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $ledger_discount2_prefix = '';
                    if(!empty($location->ref_no_prefixes['ledger_discount2'])){
                        $ledger_discount2_prefix = $location->ref_no_prefixes['ledger_discount2'];
                    }
                    $common_settings = !empty($business->common_settings) ? (is_array($business->common_settings) ? $business->common_settings : json_decode($business->common_settings, true)) : [];
                    $ld2_label = !empty($common_settings['ledger_discount2_label']) ? $common_settings['ledger_discount2_label'] : __('lang_v1.ledger_discounts2');
                ?>
                <?php echo Form::label('ref_no_prefixes[ledger_discount2]', $ld2_label . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[ledger_discount2]', $ledger_discount2_prefix, ['class' => 'form-control','placeholder' => 'LPD']); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $ledger_discount3_prefix = '';
                    if(!empty($location->ref_no_prefixes['ledger_discount3'])){
                        $ledger_discount3_prefix = $location->ref_no_prefixes['ledger_discount3'];
                    }
                    $common_settings = !empty($business->common_settings) ? (is_array($business->common_settings) ? $business->common_settings : json_decode($business->common_settings, true)) : [];
                    $ld3_label = !empty($common_settings['ledger_discount3_label']) ? $common_settings['ledger_discount3_label'] : __('lang_v1.ledger_discounts3');
                ?>
                <?php echo Form::label('ref_no_prefixes[ledger_discount3]', $ld3_label . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[ledger_discount3]', $ledger_discount3_prefix, ['class' => 'form-control','placeholder' => 'LID']); ?>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <h4><?php echo e(__('contact.customer') .' '.__('lang_v1.payment'), false); ?></h4>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php
                    $bank_receipt_voucher_prefix = '';
                    if(!empty($location->ref_no_prefixes['bank_receipt_voucher'])){
                        $bank_receipt_voucher_prefix = $location->ref_no_prefixes['bank_receipt_voucher'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[bank_receipt_voucher]', __('lang_v1.bank_receipt_voucher_prefix') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[bank_receipt_voucher]', $bank_receipt_voucher_prefix, ['class' => 'form-control', 'placeholder' => __('BRV')]); ?>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php
                    $bank_receipt_voucher_label = '';
                    if(!empty($location->ref_no_prefixes['bank_receipt_voucher_label'])){
                        $bank_receipt_voucher_label = $location->ref_no_prefixes['bank_receipt_voucher_label'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[bank_receipt_voucher_label]', __('lang_v1.bank_receipt_voucher_label') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[bank_receipt_voucher_label]', $bank_receipt_voucher_label, ['class' => 'form-control','placeholder' => __('lang_v1.bank_receipt_voucher')]); ?>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php
                    $cash_receipt_voucher_prefix = '';
                    if(!empty($location->ref_no_prefixes['cash_receipt_voucher'])){
                        $cash_receipt_voucher_prefix = $location->ref_no_prefixes['cash_receipt_voucher'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[cash_receipt_voucher]', __('lang_v1.cash_receipt_voucher_prefix') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[cash_receipt_voucher]', $cash_receipt_voucher_prefix, ['class' => 'form-control','placeholder' => __('CRV')]); ?>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php
                    $cash_receipt_voucher_label = '';
                    if(!empty($location->ref_no_prefixes['cash_receipt_voucher_label'])){
                        $cash_receipt_voucher_label = $location->ref_no_prefixes['cash_receipt_voucher_label'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[cash_receipt_voucher_label]', __('lang_v1.cash_receipt_voucher_label') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[cash_receipt_voucher_label]', $cash_receipt_voucher_label, ['class' => 'form-control','placeholder' => __('lang_v1.cash_receipt_voucher')]); ?>

            </div>
        </div>
        
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <h4><?php echo e(__('contact.supplier') .' '.__('lang_v1.payment'), false); ?></h4>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php
                    $bank_payment_voucher_prefix = '';
                    if(!empty($location->ref_no_prefixes['bank_payment_voucher'])){
                        $bank_payment_voucher_prefix = $location->ref_no_prefixes['bank_payment_voucher'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[bank_payment_voucher]', __('lang_v1.bank_payment_voucher_prefix') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[bank_payment_voucher]', $bank_payment_voucher_prefix, ['class' => 'form-control', 'placeholder' => __('BPV')]); ?>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php
                    $bank_payment_voucher_label = '';
                    if(!empty($location->ref_no_prefixes['bank_payment_voucher_label'])){
                        $bank_payment_voucher_label = $location->ref_no_prefixes['bank_payment_voucher_label'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[bank_payment_voucher_label]', __('lang_v1.bank_payment_voucher_label') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[bank_payment_voucher_label]', $bank_payment_voucher_label, ['class' => 'form-control','placeholder' => __('lang_v1.bank_payment_voucher')]); ?>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php
                    $cash_payment_voucher_prefix = '';
                    if(!empty($location->ref_no_prefixes['cash_payment_voucher'])){
                        $cash_payment_voucher_prefix = $location->ref_no_prefixes['cash_payment_voucher'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[cash_payment_voucher]', __('lang_v1.cash_payment_voucher_prefix') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[cash_payment_voucher]', $cash_payment_voucher_prefix, ['class' => 'form-control','placeholder' => __('CPV')]); ?>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php
                    $cash_payment_voucher_label = '';
                    if(!empty($location->ref_no_prefixes['cash_payment_voucher_label'])){
                        $cash_payment_voucher_label = $location->ref_no_prefixes['cash_payment_voucher_label'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[cash_payment_voucher_label]', __('lang_v1.cash_payment_voucher_label') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[cash_payment_voucher_label]', $cash_payment_voucher_label, ['class' => 'form-control','placeholder' => __('lang_v1.cash_payment_voucher')]); ?>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $purchase_prefix = '';
                    if(!empty($location->ref_no_prefixes['purchase'])){
                        $purchase_prefix = $location->ref_no_prefixes['purchase'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[purchase]', __('lang_v1.purchase') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[purchase]', $purchase_prefix, ['class' => 'form-control','placeholder' => __('PI')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $purchase_payment = '';
                    if(!empty($location->ref_no_prefixes['purchase_payment'])){
                        $purchase_payment = $location->ref_no_prefixes['purchase_payment'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[purchase_payment]', __('lang_v1.purchase_payment') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[purchase_payment]', $purchase_payment, ['class' => 'form-control','placeholder' => __('PP')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $purchase_order_prefix = !empty($location->ref_no_prefixes['purchase_order']) ? $location->ref_no_prefixes['purchase_order'] : '';
                ?>
                <?php echo Form::label('ref_no_prefixes[purchase_order]', __('lang_v1.purchase_order') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[purchase_order]', $purchase_order_prefix, ['class' => 'form-control','placeholder' => __('PO')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $purchase_return = '';
                    if(!empty($location->ref_no_prefixes['purchase_return'])){
                        $purchase_return = $location->ref_no_prefixes['purchase_return'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[purchase_return]', __('lang_v1.purchase_return') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[purchase_return]', $purchase_return, ['class' => 'form-control','placeholder' => __('PR')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $purchase_return_payment = '';
                    if(!empty($location->ref_no_prefixes['purchase_return_payment'])){
                        $purchase_return_payment = $location->ref_no_prefixes['purchase_return_payment'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[purchase_return_payment]', __('lang_v1.purchase_return_payment') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[purchase_return_payment]', $purchase_return_payment, ['class' => 'form-control','placeholder' => __('PRP')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $purchase_requisition_prefix = !empty($location->ref_no_prefixes['purchase_requisition']) ? $location->ref_no_prefixes['purchase_requisition'] : '';
                ?>
                <?php echo Form::label('ref_no_prefixes[purchase_requisition]', __('lang_v1.purchase_requisition') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[purchase_requisition]', $purchase_requisition_prefix, ['class' => 'form-control','placeholder' => __('PQ')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $sales_order_prefix = !empty($location->ref_no_prefixes['sales_order']) ? $location->ref_no_prefixes['sales_order'] : '';
                ?>
                <?php echo Form::label('ref_no_prefixes[sales_order]', __('lang_v1.sales_order') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[sales_order]', $sales_order_prefix, ['class' => 'form-control','placeholder' => __('SO')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $back_order_prefix = !empty($location->ref_no_prefixes['back_order']) ? $location->ref_no_prefixes['back_order'] : 'BO';
                ?>
                <?php echo Form::label('ref_no_prefixes[back_order]', __('lang_v1.back_order') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[back_order]', $back_order_prefix, ['class' => 'form-control','placeholder' => __('BO')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $draft_prefix = !empty($location->ref_no_prefixes['draft']) ? $location->ref_no_prefixes['draft'] : '';
                ?>
                <?php echo Form::label('ref_no_prefixes[draft]', __('sale.draft') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[draft]', $draft_prefix, ['class' => 'form-control','placeholder' => __('DR')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $sell_payment = '';
                    if(!empty($location->ref_no_prefixes['sell_payment'])){
                        $sell_payment = $location->ref_no_prefixes['sell_payment'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[sell_payment]', __('lang_v1.sell_payment') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[sell_payment]', $sell_payment, ['class' => 'form-control','placeholder' => __('SP')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $sell_return_prefix = '';
                    if(!empty($location->ref_no_prefixes['sell_return'])){
                        $sell_return_prefix = $location->ref_no_prefixes['sell_return'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[sell_return]', __('lang_v1.sell_return') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[sell_return]', $sell_return_prefix, ['class' => 'form-control','placeholder' => __('SR')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $sell_return_payment_prefix = '';
                    if(!empty($location->ref_no_prefixes['sell_return_payment'])){
                        $sell_return_payment_prefix = $location->ref_no_prefixes['sell_return_payment'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[sell_return_payment]', __('lang_v1.sell_return_payment') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[sell_return_payment]', $sell_return_payment_prefix, ['class' => 'form-control','placeholder' => __('SRP')]); ?>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $stock_transfer_prefix = '';
                    if(!empty($location->ref_no_prefixes['stock_transfer'])){
                        $stock_transfer_prefix = $location->ref_no_prefixes['stock_transfer'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[stock_transfer]', __('lang_v1.stock_transfer') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[stock_transfer]', $stock_transfer_prefix, ['class' => 'form-control','placeholder' => __('ST')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $stock_transfer_expense_prefix = '';
                    if(!empty($location->ref_no_prefixes['stock_transfer_expense'])){
                        $stock_transfer_expense_prefix = $location->ref_no_prefixes['stock_transfer_expense'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[stock_transfer_expense]', __('lang_v1.stock_transfer_expense') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[stock_transfer_expense]', $stock_transfer_expense_prefix, ['class' => 'form-control','placeholder' => __('STE')]); ?>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $stock_adjustment_prefix = '';
                    if(!empty($location->ref_no_prefixes['stock_adjustment'])){
                        $stock_adjustment_prefix = $location->ref_no_prefixes['stock_adjustment'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[stock_adjustment]', __('stock_adjustment.stock_adjustment') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[stock_adjustment]', $stock_adjustment_prefix, ['class' => 'form-control','placeholder' => __('SA')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $stock_adjustment_payment_prefix = '';
                    if(!empty($location->ref_no_prefixes['stock_adjustment_payment'])){
                        $stock_adjustment_payment_prefix = $location->ref_no_prefixes['stock_adjustment_payment'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[stock_adjustment_payment]', __('stock_adjustment.stock_adjustment_payment') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[stock_adjustment_payment]', $stock_adjustment_payment_prefix, ['class' => 'form-control','placeholder' => __('SAP')]); ?>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $expenses_prefix = '';
                    if(!empty($location->ref_no_prefixes['expense'])){
                        $expenses_prefix = $location->ref_no_prefixes['expense'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[expense]', __('expense.expenses') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[expense]', $expenses_prefix, ['class' => 'form-control','placeholder' => __('EX')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $expense_payment = '';
                    if(!empty($location->ref_no_prefixes['expense_payment'])){
                        $expense_payment = $location->ref_no_prefixes['expense_payment'];
                    }
                ?>
                <?php echo Form::label('ref_no_prefixes[expense_payment]', __('lang_v1.expense_payment') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[expense_payment]', $expense_payment, ['class' => 'form-control','placeholder' => __('EP')]); ?>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $subscription_prefix = !empty($location->ref_no_prefixes['subscription']) ? $location->ref_no_prefixes['subscription'] : '';
                ?>
                <?php echo Form::label('ref_no_prefixes[subscription]', __('lang_v1.subscription_no') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[subscription]', $subscription_prefix, ['class' => 'form-control','placeholder' => __('SB')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $token_no_prefix = !empty($location->ref_no_prefixes['token_no']) ? $location->ref_no_prefixes['token_no'] : '';
                ?>
                <?php echo Form::label('ref_no_prefixes[token_no]', __('lang_v1.token_no') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[token_no]', $token_no_prefix, ['class' => 'form-control','placeholder' => __('TK')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $cash_register_prefix = !empty($location->ref_no_prefixes['cash_register']) ? $location->ref_no_prefixes['cash_register'] : '';
                ?>
                <?php echo Form::label('ref_no_prefixes[cash_register]', __('lang_v1.cash_register_skim') . ':'); ?>

                <?php echo Form::text('ref_no_prefixes[cash_register]', $cash_register_prefix, ['class' => 'form-control','placeholder' => __('CR')]); ?>

            </div>
        </div>
    </div>
</div>
