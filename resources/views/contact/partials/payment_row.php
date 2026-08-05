<?php
    $same_ref_payments = [];
    $station_id = config('constants.station_id');
    $allow_delete = ($station_id == $payment->transaction->station_id) ? true : false;
    $cp_prefix = request()->session()->get('business.ref_no_prefixes')['contact_payment'];
    $bpv_prefix = request()->session()->get('business.ref_no_prefixes')['bank_payment_voucher'];
    $cpv_prefix = request()->session()->get('business.ref_no_prefixes')['cash_payment_voucher'];
    $brv_prefix = request()->session()->get('business.ref_no_prefixes')['bank_receipt_voucher'];
    $crv_prefix = request()->session()->get('business.ref_no_prefixes')['cash_receipt_voucher'];
    $ledger_discount_types = ['ledger_discount', 'ledger_discount2', 'ledger_discount3'];
    $transaction_type = !empty($payment->transaction) ? $payment->transaction->type : ($payment->transaction_type ?? null);
    $can_edit_payment = (in_array($transaction_type, ['purchase', 'purchase_return']) && auth()->user()->can('edit_purchase_payment'))
        || (in_array($transaction_type, ['sell']) && auth()->user()->can('edit_sell_payment'))
        || ($transaction_type == 'sell_return' && (auth()->user()->can('edit_sell_return_payment') || auth()->user()->can('edit_sell_payment')))
        || ($transaction_type == 'expense' && auth()->user()->can('edit_expense_payment'));
    $can_delete_payment = (in_array($transaction_type, ['purchase', 'purchase_return']) && auth()->user()->can('delete_purchase_payment'))
        || (in_array($transaction_type, ['sell']) && auth()->user()->can('delete_sell_payment'))
        || ($transaction_type == 'sell_return' && (auth()->user()->can('delete_sell_return_payment') || auth()->user()->can('delete_sell_payment')))
        || ($transaction_type == 'expense' && auth()->user()->can('delete_expense_payment'));
?>
<?php if(\Str::startsWith($payment->payment_ref_no, $cp_prefix) || \Str::startsWith($payment->payment_ref_no, $bpv_prefix) 
|| \Str::startsWith($payment->payment_ref_no, $cpv_prefix) || \Str::startsWith($payment->payment_ref_no, $brv_prefix)
|| \Str::startsWith($payment->payment_ref_no, $crv_prefix)): ?>
    <?php
        $same_ref_payments = \App\TransactionPayment::leftjoin('transactions as t', 'transaction_payments.transaction_id', '=', 't.id')
            ->where('transaction_payments.business_id', $payment->business_id)
            ->where('transaction_payments.payment_ref_no', $payment->payment_ref_no)
            // ->whereNot('transaction_payments.id', $payment->id)
            ->whereNull('transaction_payments.parent_id')
            ->where('transaction_payments.payment_for', $payment->payment_for)
                ->select(
                    'transaction_payments.id',
                    'transaction_payments.amount',
                    'transaction_payments.is_return',
                    'transaction_payments.is_advance',
                    'transaction_payments.payment_for',
                    'transaction_payments.method',
                    'transaction_payments.paid_on',
                    'transaction_payments.payment_ref_no',
                    'transaction_payments.parent_id',
                    'transaction_payments.transaction_no',
                    't.invoice_no',
                    't.is_created_from_api',
                    't.station_id',
                    't.ref_no',
                    't.type as transaction_type',
                    't.sub_type as t_sub_type',
                    't.return_parent_id',
                    't.final_total',
                    't.id as transaction_id',
                    'transaction_payments.cheque_number',
                    'transaction_payments.card_transaction_number',
                    'transaction_payments.bank_account_number',
                    'transaction_payments.id as DT_RowId',
                    \DB::raw("(SELECT SUM(tp1.amount) 
                            FROM transaction_payments AS tp1 
                            WHERE tp1.transaction_id = transaction_payments.transaction_id 
                            AND tp1.paid_on < transaction_payments.paid_on
                            AND tp1.deleted_at IS NULL
                            AND tp1.business_id = transaction_payments.business_id) AS total_paid_before") 
                )
                // ->groupBy('transaction_payments.payment_ref_no')
                ->groupBy('transaction_payments.id')
                ->orderByDesc('transaction_payments.paid_on')->get();
    ?>
<?php endif; ?>
<tr>
    <td>
        <?php if(count($same_ref_payments) > 1): ?>
        <button class="btn btn-sm btn-primary toggle_cp_payment" type="button" data-bs-target="<?php echo e($payment->payment_ref_no, false); ?>">
            <span class="fa fas fa-plus-circle"></span>
        </button>
        <?php endif; ?>
    </td>
    <?php if(empty($payment->parent_id)): ?>
    <td <?php if($count_child_payments > 1): ?> rowspan="<?php echo e($count_child_payments + 1, false); ?>" style="vertical-align:middle;" <?php endif; ?>>
        <?php echo format_datetime_br($payment->paid_on); ?> <?php echo e($payments[$index]->payment_ref_no, false); ?>

    </td>
    <?php endif; ?>
    <td <?php if($count_child_payments > 0): ?> class="bg-gray" <?php endif; ?>>
        <a href="#" class="btn-modal" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'viewPayment'], [$payment->id]), false); ?>" data-container=".view_modal"><?php echo e($payment->payment_ref_no, false); ?></a>
        <?php if(!empty($parent_payment_ref_no)): ?>
            <br><?php echo app('translator')->get('lang_v1.parent_payment'); ?>: <?php echo e($parent_payment_ref_no, false); ?>

        <?php endif; ?>
    </td>
    <td <?php if($count_child_payments > 0): ?> class="bg-gray" <?php endif; ?>>
        <?php if(count($same_ref_payments) <= 1): ?>
        <span class="display_currency paid-amount" data-orig-value=" <?php echo e($payment->amount, false); ?>" data-currency_symbol ="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $payment->amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
        <?php endif; ?>
        <?php if(count($same_ref_payments) > 1): ?>
            <?php
                $amount_total = 0;   
            ?>
            <?php $__currentLoopData = $same_ref_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($payment->contact_type == 'supplier'): ?>
                     <?php
                        if(($ap->transaction_type == 'opening_balance' && $ap->t_sub_type == 'credit') || ($ap->transaction_type == 'advance_deposit' && $ap->t_sub_type == 'credit') || $ap->transaction_type == 'purchase' || $ap->transaction_type == 'sell_return'){
                            if($ap->final_total < $ap->total_paid_before){
                                $amount_total -= $ap->amount;
                            }else{
                                $amount_total += $ap->amount;
                            }
                        }else{
                            if(in_array($ap->transaction_type, $ledger_discount_types) && $ap->t_sub_type == 'sell_discount'){
                                $amount_total += $ap->amount;
                            }else{
                                $amount_total -= $ap->amount;
                            }
                        }
                    ?>
                <?php elseif($payment->contact_type == 'customer'): ?>
                    <?php
                    if(($ap->transaction_type == 'opening_balance' && $ap->t_sub_type == 'debit') || ($ap->transaction_type == 'advance_deposit' && $ap->t_sub_type == 'debit') || $ap->transaction_type == 'sell' || $ap->transaction_type == 'purchase_return'){
                        if($ap->final_total < $ap->total_paid_before){
                            $amount_total -= $ap->amount;
                        }else{
                            $amount_total += $ap->amount;
                        }
                    }else{
                        if(in_array($ap->transaction_type, $ledger_discount_types) && $ap->t_sub_type == 'purchase_discount'){
                            $amount_total += $ap->amount;
                        }else{
                            if($ap->transaction_type == 'sell_return' && $ap->final_total < $ap->total_paid_before){
                                $amount_total += $ap->amount;
                            }else{
                                $amount_total -= $ap->amount;
                            }
                        }
                    }
                    ?>
                <?php elseif($payment->contact_type == 'both'): ?>
                    <?php
                    if(($ap->transaction_type == 'opening_balance' && $ap->t_sub_type == 'debit') || ($ap->transaction_type == 'advance_deposit' && $ap->t_sub_type == 'debit') || (in_array($ap->transaction_type, $ledger_discount_types) && $ap->t_sub_type == 'purchase_discount') || $ap->transaction_type == 'sell' || $ap->transaction_type == 'purchase_return'){
                        if($ap->final_total < $ap->total_paid_before){
                            $amount_total -= $ap->amount;
                        }else{
                            $amount_total += $ap->amount;
                        }
                    }else{
                        if(in_array($ap->transaction_type, $ledger_discount_types) && $ap->t_sub_type == 'sell_discount'){
                            if($ap->final_total < 0){  
                                $amount_total += $ap->amount;
                            }else{
                                $amount_total -= $ap->amount;
                            }
                        }else{
                            $amount_total -= $ap->amount;
                        }
                    }  
                    ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $amount_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
        <?php endif; ?>
    </td>
    <td <?php if($count_child_payments > 0): ?> class="bg-gray" <?php endif; ?>>
        <?php
            $method = !empty($payment_types[$payment->method]) ? $payment_types[$payment->method] : '';
            if ($payment->method == 'cheque') {
                $method .= '<br>(' . __('lang_v1.cheque_no') . ': ' . $payment->cheque_number . ')';
            } elseif ($payment->method == 'card') {
                $method .= '<br>(' . __('lang_v1.card_transaction_no') . ': ' . $payment->card_transaction_number . ')';
            } elseif ($payment->method == 'bank_transfer') {
                $method .= '<br>(' . __('lang_v1.bank_account_no') . ': ' . $payment->bank_account_number . ')';
            } elseif ($payment->method == 'custom_pay_1') {
                $method .= '<br>(' . __('lang_v1.transaction_no') . ': ' . $payment->transaction_no . ')';
            } elseif ($payment->method == 'custom_pay_2') {
                $method .= '<br>(' . __('lang_v1.transaction_no') . ': ' . $payment->transaction_no . ')';
            } elseif ($payment->method == 'custom_pay_3') {
                $method .= '<br>(' . __('lang_v1.transaction_no') . ': ' . $payment->transaction_no . ')';
            }
            if ($payment->is_return == 1) {
                $method .= '<br><small>(' . __('lang_v1.change_return') . ')</small>';
            }
        ?>
        <?php echo $method ?? ''; ?>

    </td>
    <td class="text-wrap <?php if($count_child_payments > 0): ?> bg-gray <?php endif; ?>" >
        <?php if(count($same_ref_payments) <= 1): ?>
            <?php
                $transaction_type = $payment->transaction->type ?? $payment->transaction_type;
                $transaction_id = $payment->transaction->id ?? $payment->transaction_id;
                $invoice_no = $payment->transaction->invoice_no ?? $payment->invoice_no;
                $return_parent_id = $payment->transaction->return_parent_id ? $payment->return_parent_id : 0;
                $ref_no = $payment->transaction->ref_no ?? $payment->ref_no;
            ?>
            <?php if($transaction_type == 'sell'): ?>
                <a data-href="<?php echo e(action([\App\Http\Controllers\SellController::class, 'show'], [$transaction_id]), false); ?>" href="#" data-container=".view_modal" class="btn-modal"><?php echo e($invoice_no, false); ?></a> <br> <small>(<?php echo e(__('sale.sale'), false); ?>) </small>

            <?php elseif($transaction_type == 'sell_return'): ?>
                <a data-href="<?php echo e(action([\App\Http\Controllers\SellReturnController::class, 'show'], [$return_parent_id]), false); ?>" href="#" data-container=".view_modal" class="btn-modal"><?php echo e($invoice_no, false); ?></a> <br> <small>(<?php echo e(__('lang_v1.sell_return'), false); ?>) </small>
            <?php elseif($transaction_type == 'purchase_return'): ?>
                <a data-href="<?php echo e(action([\App\Http\Controllers\PurchaseReturnController::class, 'show'], [$return_parent_id]), false); ?>" href="#" data-container=".view_modal" class="btn-modal"><?php echo e($ref_no, false); ?></a> <br> <small>(<?php echo e(__('lang_v1.purchase_return'), false); ?>) </small>
            <?php elseif($transaction_type == 'purchase'): ?>
                <a data-href="<?php echo e(action([\App\Http\Controllers\PurchaseController::class, 'show'], [$transaction_id]), false); ?>" href="#" data-container=".view_modal" class="btn-modal"><?php echo e($ref_no, false); ?></a> <br> <small>(<?php echo e(__('lang_v1.purchase'), false); ?>) </small>
            <?php else: ?> 
                <?php if(!empty($transaction_id)): ?>
                    <?php echo e($ref_no, false); ?> <br> <small>(<?php echo e(__('lang_v1.' . $transaction_type), false); ?>) </small>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php if(count($same_ref_payments) > 1): ?>
            <?php echo e(count($same_ref_payments), false); ?> Transactions
        <?php endif; ?>
    </td>
    <td <?php if($count_child_payments > 0): ?> class="bg-gray" <?php endif; ?>>
        <button type="button" class="btn btn-primary btn-sm btn-modal" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'viewPayment'], [$payment->id]), false); ?>" data-container=".view_modal"><i class="fas fa-eye"></i><?php echo e(__('messages.view'), false); ?></button>

        <?php if(!empty($transaction_id) && strpos($payment->payment_ref_no, $cp_prefix) !== 0 && count($same_ref_payments) == 1): ?>
            <?php if($can_edit_payment): ?>
                <button type="button" class="btn btn-info btn-sm btn-modal edit_payment" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'edit'], [$payment->id]), false); ?>"><i class="fas fa-edit"></i> <?php echo e(__('messages.edit'), false); ?></button>
            <?php endif; ?>
        <?php endif; ?>

        

        <?php if($count_child_payments <= 0): ?>
            
            <?php if($allow_delete): ?>
                <?php if($can_delete_payment
                || ((empty($transaction_type) || $transaction_type=='opening_balance' || $transaction_type=='advance_deposit') 
                || in_array($transaction_type, $ledger_discount_types) &&  (auth()->user()->can('customer.create') || auth()->user()->can('customer.update') || auth()->user()->can('supplier.create') || auth()->user()->can('supplier.update') ) )): ?>
                    <button type="button" class="btn btn-danger btn-sm delete_payment" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'destroy'], [$payment->id]), false); ?>" > <i class="fas fa-trash"></i><?php echo e(__('messages.delete'), false); ?></button>
                <?php endif; ?>    
            <?php endif; ?>
        <?php endif; ?>
    </td>
</tr>
    <?php if(count($same_ref_payments) != 0): ?>
        <?php
            $parent_payment_contact_type = $payment->contact_type;
            $main_payment_id = $payment->id;
        ?>
        <?php $__currentLoopData = $same_ref_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr class="hide <?php echo e($payment->payment_ref_no, false); ?> bg-gray">
            <td></td>
            <?php if(empty($payment->parent_id)): ?>
            <td <?php if($count_child_payments > 0): ?> rowspan="<?php echo e($count_child_payments + 1, false); ?>" style="vertical-align:middle;" <?php endif; ?>>
                <?php echo format_datetime_br($payment->paid_on); ?> <?php echo e($payments[$index]->payment_ref_no, false); ?>

            </td>
            <?php endif; ?>
            <td <?php if($count_child_payments > 0): ?> class="bg-gray" <?php endif; ?>>
                <a href="#" class="btn-modal" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'viewPayment'], [$payment->id]), false); ?>" data-container=".view_modal"><?php echo e($payment->payment_ref_no, false); ?></a>
                <?php if(!empty($parent_payment_ref_no)): ?>
                    <br><?php echo app('translator')->get('lang_v1.parent_payment'); ?>: <?php echo e($parent_payment_ref_no, false); ?>

                <?php endif; ?>
            </td>
            <td <?php if($count_child_payments > 0): ?> class="bg-gray" <?php endif; ?>>
                <?php
                    $payment_row_amount = 0;
                ?>
                <?php if($parent_payment_contact_type == 'supplier'): ?>
                     <?php
                        if(($payment->transaction_type == 'opening_balance' && $payment->t_sub_type == 'credit') || ($payment->transaction_type == 'advance_deposit' && $payment->t_sub_type == 'credit') || $payment->transaction_type == 'purchase' || $payment->transaction_type == 'sell_return'){
                            $payment_row_amount = $payment->amount;
                            if($payment->final_total < $payment->total_paid_before){
                                $payment_row_amount = -1*$payment->amount;
                            }
                        }else{
                            if(in_array($payment->transaction_type, $ledger_discount_types) && $payment->t_sub_type == 'sell_discount'){
                                $payment_row_amount = $payment->amount;
                            }else{
                                $payment_row_amount = -1*$payment->amount;
                            }
                        }  
                    ?>
                <?php elseif($parent_payment_contact_type == 'customer'): ?>
                    <?php
                    if(($payment->transaction_type == 'opening_balance' && $payment->t_sub_type == 'debit') || ($payment->transaction_type == 'advance_deposit' && $payment->t_sub_type == 'debit') || $payment->transaction_type == 'sell' || $payment->transaction_type == 'purchase_return'){
                        $payment_row_amount = $payment->amount;
                        if($payment->final_total < $payment->total_paid_before){
                            $payment_row_amount = -1*$payment->amount;
                        }
                    }else{
                        if(in_array($payment->transaction_type, $ledger_discount_types) && $payment->t_sub_type == 'purchase_discount'){
                            $payment_row_amount = $payment->amount;
                        }else{
                            if($payment->transaction_type == 'sell_return' && $payment->final_total < $payment->total_paid_before){
                                $payment_row_amount = $payment->amount;
                            }else{
                                $payment_row_amount = -1*$payment->amount;
                            }
                        }
                    }  
                    ?>
                <?php elseif($parent_payment_contact_type == 'both'): ?>
                    <?php
                    if(($payment->transaction_type == 'opening_balance' && $payment->t_sub_type == 'debit') || ($payment->transaction_type == 'advance_deposit' && $payment->t_sub_type == 'debit') || (in_array($payment->transaction_type, $ledger_discount_types) && $payment->t_sub_type == 'purchase_discount') || $payment->transaction_type == 'sell' || $payment->transaction_type == 'purchase_return'){
                        $payment_row_amount = $payment->amount;
                        if($payment->final_total < $payment->total_paid_before){
                            $payment_row_amount = -1*$payment->amount;
                        }
                    }else{
                        if(in_array($payment->transaction_type, $ledger_discount_types) && $payment->t_sub_type == 'purchase_discount'){
                            $payment_row_amount = $payment->amount;
                        }else{
                            $payment_row_amount = -1*$payment->amount;
                        }
                    }  
                    ?>
                <?php endif; ?>
                <span class="display_currency paid-amount" data-orig-value="<?php echo e($payment_row_amount, false); ?>" data-currency_symbol ="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $payment_row_amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
            </td>
            <td <?php if($count_child_payments > 0): ?> class="bg-gray" <?php endif; ?>>
                <?php
                    $method = !empty($payment_types[$payment->method]) ? $payment_types[$payment->method] : '';
                    if ($payment->method == 'cheque') {
                        $method .= '<br>(' . __('lang_v1.cheque_no') . ': ' . $payment->cheque_number . ')';
                    } elseif ($payment->method == 'card') {
                        $method .= '<br>(' . __('lang_v1.card_transaction_no') . ': ' . $payment->card_transaction_number . ')';
                    } elseif ($payment->method == 'bank_transfer') {
                        $method .= '<br>(' . __('lang_v1.bank_account_no') . ': ' . $payment->bank_account_number . ')';
                    } elseif ($payment->method == 'custom_pay_1') {
                        $method .= '<br>(' . __('lang_v1.transaction_no') . ': ' . $payment->transaction_no . ')';
                    } elseif ($payment->method == 'custom_pay_2') {
                        $method .= '<br>(' . __('lang_v1.transaction_no') . ': ' . $payment->transaction_no . ')';
                    } elseif ($payment->method == 'custom_pay_3') {
                        $method .= '<br>(' . __('lang_v1.transaction_no') . ': ' . $payment->transaction_no . ')';
                    }
                    if ($payment->is_return == 1) {
                        $method .= '<br><small>(' . __('lang_v1.change_return') . ')</small>';
                    }
                ?>
                <?php echo $method ?? ''; ?>

            </td>
            <td <?php if($count_child_payments > 0): ?> class="bg-gray" <?php endif; ?>>
                <?php
                    $transaction_type = $payment->transaction->type ?? $payment->transaction_type;
                    $transaction_id = $payment->transaction->id ?? $payment->transaction_id;
                    $invoice_no = $payment->transaction->invoice_no ?? $payment->invoice_no;
                    $return_parent_id = $payment->transaction->return_parent_id ? $payment->return_parent_id : 0;
                    $ref_no = $payment->transaction->ref_no ?? $payment->ref_no;
                ?>
                <?php if($transaction_type == 'sell'): ?>
                    <a data-href="<?php echo e(action([\App\Http\Controllers\SellController::class, 'show'], [$transaction_id]), false); ?>" href="#" data-container=".view_modal" class="btn-modal"><?php echo e($invoice_no, false); ?></a> <br> <small>(<?php echo e(__('sale.sale'), false); ?>) </small>
        
                <?php elseif($transaction_type == 'sell_return'): ?>
                    <a data-href="<?php echo e(action([\App\Http\Controllers\SellReturnController::class, 'show'], [$return_parent_id]), false); ?>" href="#" data-container=".view_modal" class="btn-modal"><?php echo e($invoice_no, false); ?></a> <br> <small>(<?php echo e(__('lang_v1.sell_return'), false); ?>) </small>
                <?php elseif($transaction_type == 'purchase_return'): ?>
                    <a data-href="<?php echo e(action([\App\Http\Controllers\PurchaseReturnController::class, 'show'], [$return_parent_id]), false); ?>" href="#" data-container=".view_modal" class="btn-modal"><?php echo e($ref_no, false); ?></a> <br> <small>(<?php echo e(__('lang_v1.purchase_return'), false); ?>) </small>
                <?php elseif($transaction_type == 'purchase'): ?>
                    <a data-href="<?php echo e(action([\App\Http\Controllers\PurchaseController::class, 'show'], [$transaction_id]), false); ?>" href="#" data-container=".view_modal" class="btn-modal"><?php echo e($ref_no, false); ?></a> <br> <small>(<?php echo e(__('lang_v1.purchase'), false); ?>) </small>
                <?php else: ?> 
                    <?php if(!empty($transaction_id)): ?>
                        <?php echo e($ref_no, false); ?> <br> <small>(<?php echo e(__('lang_v1.' . $transaction_type), false); ?>) </small>
                    <?php endif; ?>
                <?php endif; ?>
            </td>
            <td <?php if($count_child_payments > 0): ?> class="bg-gray" <?php endif; ?>></td>
        </tr>    
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
