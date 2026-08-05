<?php
  $is_close = $is_close ?? false;
  $is_print = $is_print ?? false;
  $is_print_out = $is_print_out ?? false;
  $auth_user_settings = json_decode(auth()->user()->user_settings, true) ?? [];
?>
<?php if((empty($auth_user_settings['hide_all_details_before_register_closing']) || auth()->user()->hasRole('Admin#' . auth()->user()->business_id))): ?>
<div class="row">
  <div class="col-sm-12">
    <table class="table table-condensed table-slim">
      <tr>
        <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
        <th><?php echo app('translator')->get('sale.sale'); ?></th>
        <th><?php echo app('translator')->get('cash_register.returns'); ?></th>
        <th><?php echo app('translator')->get('lang_v1.expense'); ?></th>
      </tr>
      <?php if($register_details->cash_in_hand != 0 || !empty($register_details->cash_out)): ?>
      <tr>
        <td>
          <?php echo app('translator')->get('cash_register.cash_in_hand'); ?>:
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->cash_in_hand, false); ?></span>
        </td>
        <?php if(!empty($register_details->cash_out)): ?>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->cash_out, false); ?></span>
        </td>
        <?php else: ?>
        <td>--</td>
        <?php endif; ?>
        <td>--</td>
      </tr>
      <?php endif; ?>
      <?php if(array_key_exists('cash', $payment_types) && ($register_details->total_cash + $register_details->total_cash_ad + $register_details->total_cash_refund + $register_details->total_cash_refund_prev + $register_details->total_cash_ad_refund + $register_details->total_cash_expense) != 0): ?>
      <tr>
        <td>
          <?php echo e(!empty($payment_types['cash']) ? $payment_types['cash'] : __('cash_register.cash_payment'), false); ?>:
        </th>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_cash + $register_details->total_cash_ad, false); ?></span>
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_cash_refund + $register_details->total_cash_refund_prev + $register_details->total_cash_ad_refund, false); ?></span>
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_cash_expense, false); ?></span>
        </td>
      </tr>
      <?php endif; ?>
      <?php if(array_key_exists('card', $payment_types) && ($register_details->total_card + $register_details->total_card_ad + $register_details->total_card_refund + $register_details->total_card_refund_prev + $register_details->total_card_ad_refund + $register_details->total_card_expense) != 0): ?>
      <tr>
        <td>
          <?php echo e(!empty($payment_types['card']) ? $payment_types['card'] : __('cash_register.card_payment'), false); ?>:
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_card + $register_details->total_card_ad, false); ?></span>
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_card_refund + $register_details->total_card_refund_prev + $register_details->total_card_ad_refund, false); ?></span>
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_card_expense, false); ?></span>
        </td>
      </tr>
      <?php endif; ?>
      <?php if(array_key_exists('cheque', $payment_types) && ($register_details->total_cheque + $register_details->total_cheque_ad + $register_details->total_cheque_refund + $register_details->total_cheque_refund_prev + $register_details->total_cheque_ad_refund + $register_details->total_cheque_expense) != 0): ?>
      <tr>
        <td>
          <?php echo e(!empty($payment_types['cheque']) ? $payment_types['cheque'] : __('cash_register.checque_payment'), false); ?>:
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_cheque + $register_details->total_cheque_ad, false); ?></span>
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_cheque_refund - $register_details->total_cheque_refund_prev + $register_details->total_cheque_ad_refund, false); ?></span>
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_cheque_expense, false); ?></span>
        </td>
      </tr>
      <?php endif; ?>
      <?php if(array_key_exists('bank_transfer', $payment_types) && ($register_details->total_bank_transfer + $register_details->total_bank_transfer_ad + $register_details->total_bank_transfer_refund + $register_details->total_bank_transfer_refund_prev + $register_details->total_bank_transfer_ad_refund + $register_details->total_bank_transfer_expense) != 0): ?>
      <tr>
        <td>
          <?php echo e(!empty($payment_types['bank_transfer']) ? $payment_types['bank_transfer'] : __('cash_register.bank_transfer'), false); ?>:
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_bank_transfer + $register_details->total_bank_transfer_ad, false); ?></span>
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_bank_transfer_refund + $register_details->total_bank_transfer_refund_prev + $register_details->total_bank_transfer_ad_refund, false); ?></span>
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_bank_transfer_expense, false); ?></span>
        </td>
      </tr>
      <?php endif; ?>
      <?php if(array_key_exists('other', $payment_types) && ($register_details->total_other + $register_details->total_other_ad + $register_details->total_other_refund + $register_details->total_other_refund_prev + $register_details->total_other_ad_refund + $register_details->total_other_expense) != 0): ?>
      <tr>
        <td>
          <?php echo e(!empty($payment_types['other']) ? $payment_types['other'] : __('cash_register.other'), false); ?>:
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_other + $register_details->total_other_ad, false); ?></span>
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_other_refund + $register_details->total_other_refund_prev + $register_details->total_other_ad_refund, false); ?></span>
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_other_expense, false); ?></span>
        </td>
      </tr>
      <?php endif; ?>
      
      <?php if(array_key_exists('custom_pay_1', $payment_types) && ($register_details->total_custom_pay_1 + $register_details->total_custom_pay_1_ad + $register_details->total_custom_pay_1_refund + $register_details->total_custom_pay_1_refund_prev + $register_details->total_custom_pay_1_ad_refund + $register_details->total_custom_pay_1_expense) != 0): ?>
        <tr>
          <td>
            <?php echo e($payment_types['custom_pay_1'], false); ?>:
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_1 + $register_details->total_custom_pay_1_ad, false); ?></span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_1_refund + $register_details->total_custom_pay_1_refund_prev + $register_details->total_custom_pay_1_ad_refund, false); ?></span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_1_expense, false); ?></span>
          </td>
        </tr>
      <?php endif; ?>
      <?php if(array_key_exists('custom_pay_2', $payment_types) && ($register_details->total_custom_pay_2 + $register_details->total_custom_pay_2_ad + $register_details->total_custom_pay_2_refund + $register_details->total_custom_pay_2_refund_prev + $register_details->total_custom_pay_2_ad_refund + $register_details->total_custom_pay_2_expense) != 0): ?>
        <tr>
          <td>
            <?php echo e($payment_types['custom_pay_2'], false); ?>:
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_2 + $register_details->total_custom_pay_2_ad, false); ?></span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_2_refund + $register_details->total_custom_pay_2_refund_prev + $register_details->total_custom_pay_2_ad_refund, false); ?></span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_2_expense, false); ?></span>
          </td>
        </tr>
      <?php endif; ?>
      <?php if(array_key_exists('custom_pay_3', $payment_types) && ($register_details->total_custom_pay_3 + $register_details->total_custom_pay_3_ad + $register_details->total_custom_pay_3_refund + $register_details->total_custom_pay_3_refund_prev + $register_details->total_custom_pay_3_ad_refund + $register_details->total_custom_pay_3_expense) != 0): ?>
        <tr>
          <td>
            <?php echo e($payment_types['custom_pay_3'], false); ?>:
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_3 + $register_details->total_custom_pay_3_ad, false); ?></span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_3_refund + $register_details->total_custom_pay_3_refund_prev + $register_details->total_custom_pay_3_ad_refund, false); ?></span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_3_expense, false); ?></span>
          </td>
        </tr>
      <?php endif; ?>
      <?php if(array_key_exists('custom_pay_4', $payment_types) && ($register_details->total_custom_pay_4 + $register_details->total_custom_pay_4_ad + $register_details->total_custom_pay_4_refund + $register_details->total_custom_pay_4_refund_prev + $register_details->total_custom_pay_4_ad_refund + $register_details->total_custom_pay_4_expense) != 0): ?>
        <tr>
          <td>
            <?php echo e($payment_types['custom_pay_4'], false); ?>:
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_4 + $register_details->total_custom_pay_4_ad, false); ?></span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_4_refund + $register_details->total_custom_pay_4_refund_prev + $register_details->total_custom_pay_4_ad_refund, false); ?></span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_4_expense, false); ?></span>
          </td>
        </tr>
      <?php endif; ?>
      <?php if(array_key_exists('custom_pay_5', $payment_types) && ($register_details->total_custom_pay_5 + $register_details->total_custom_pay_5_ad + $register_details->total_custom_pay_5_refund + $register_details->total_custom_pay_5_refund_prev + $register_details->total_custom_pay_5_ad_refund + $register_details->total_custom_pay_5_expense) != 0): ?>
        <tr>
          <td>
            <?php echo e($payment_types['custom_pay_5'], false); ?>:
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_5 + $register_details->total_custom_pay_5_ad, false); ?></span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_5_refund + $register_details->total_custom_pay_5_refund_prev + $register_details->total_custom_pay_5_ad_refund, false); ?></span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_5_expense, false); ?></span>
          </td>
        </tr>
      <?php endif; ?>
      <?php if(array_key_exists('custom_pay_6', $payment_types) && ($register_details->total_custom_pay_6 + $register_details->total_custom_pay_6_ad + $register_details->total_custom_pay_6_refund + $register_details->total_custom_pay_6_refund_prev + $register_details->total_custom_pay_6_ad_refund + $register_details->total_custom_pay_6_expense) != 0): ?>
        <tr>
          <td>
            <?php echo e($payment_types['custom_pay_6'], false); ?>:
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_6 + $register_details->total_custom_pay_6_ad, false); ?></span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_6_refund + $register_details->total_custom_pay_6_refund_prev + $register_details->total_custom_pay_6_ad_refund, false); ?></span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_6_expense, false); ?></span>
          </td>
        </tr>
      <?php endif; ?>
      <?php if(array_key_exists('custom_pay_7', $payment_types) && ($register_details->total_custom_pay_7 + $register_details->total_custom_pay_7_ad + $register_details->total_custom_pay_7_refund + $register_details->total_custom_pay_7_refund_prev + $register_details->total_custom_pay_7_ad_refund + $register_details->total_custom_pay_7_expense) != 0): ?>
        <tr>
          <td>
            <?php echo e($payment_types['custom_pay_7'], false); ?>:
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_7 + $register_details->total_custom_pay_7_ad, false); ?></span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_7_refund + $register_details->total_custom_pay_7_refund_prev + $register_details->total_custom_pay_7_ad_refund, false); ?></span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_custom_pay_7_expense, false); ?></span>
          </td>
        </tr>
      <?php endif; ?>
      
    </table>
    <?php if(!$is_print_out): ?>
    <hr>
    <table class="table table-condensed table-slim">
      <?php if(($register_details->no_of_sales + $register_details->no_of_other_sales + $details['transaction_details']->no_of_credit_sales) != 0): ?>
      <tr>
        <td>
          <?php echo app('translator')->get('cash_register.no_of_sales'); ?>:
        </td>
        <td>
          <span><?php echo e($register_details->no_of_sales + $register_details->no_of_other_sales + $details['transaction_details']->no_of_credit_sales, false); ?></span>
        </td>
      </tr>
      <?php endif; ?>
      <?php if($details['transaction_details']->total_credit_sales != 0): ?>
      <tr>
        <td>
          <?php echo app('translator')->get('lang_v1.credit_sales'); ?>:
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($details['transaction_details']->total_credit_sales, false); ?></span>
        </td>
      </tr>
      <?php endif; ?>
      <?php if($details['transaction_details']->total_sales != 0): ?>
      <tr>
        <td>
          <?php echo app('translator')->get('cash_register.paid_sales'); ?>:
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($details['transaction_details']->total_sales, false); ?></span>
        </td>
      </tr>
      <?php endif; ?>
      <?php if($details['transaction_details']->total_sales_direct != 0): ?>
      <tr>
        <td>
          <?php echo app('translator')->get('cash_register.sales_invoices_paid'); ?>:
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($details['transaction_details']->total_sales_direct, false); ?></span>
        </td>
      </tr>
      <?php endif; ?>
      
      <?php if($details['transaction_details']->total_sales_return != 0): ?>
      <tr>
        <td>
          <?php echo app('translator')->get('cash_register.sales_return'); ?>:
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true"><?php echo e($details['transaction_details']->total_sales_return, false); ?></span>
        </td>
      </tr>
      <?php endif; ?>
      <?php if($register_details->total_refund != 0): ?>
      <tr class="danger">
        <th>
          <?php echo app('translator')->get('cash_register.total_refund'); ?>
        </th>
        <td>
          <b><span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_refund, false); ?></span></b><br>
          <small>
          <?php if($register_details->total_sell_cash_refund != 0): ?>
            Cash: <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_sell_cash_refund, false); ?></span><br>
          <?php endif; ?>
          <?php if($register_details->total_sell_cheque_refund != 0): ?> 
            Cheque: <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_sell_cheque_refund, false); ?></span><br>
          <?php endif; ?>
          <?php if($register_details->total_sell_card_refund != 0): ?> 
            Card: <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_sell_card_refund, false); ?></span><br> 
          <?php endif; ?>
          <?php if($register_details->total_sell_bank_transfer_refund != 0): ?>
            Bank Transfer: <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_sell_bank_transfer_refund, false); ?></span><br>
          <?php endif; ?>
          <?php if(array_key_exists('custom_pay_1', $payment_types) && $register_details->total_sell_custom_pay_1_refund != 0): ?>
              <?php echo e($payment_types['custom_pay_1'], false); ?>: <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_sell_custom_pay_1_refund, false); ?></span>
          <?php endif; ?>
          <?php if(array_key_exists('custom_pay_2', $payment_types) && $register_details->total_sell_custom_pay_2_refund != 0): ?>
              <?php echo e($payment_types['custom_pay_2'], false); ?>: <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_sell_custom_pay_2_refund, false); ?></span>
          <?php endif; ?>
          <?php if(array_key_exists('custom_pay_3', $payment_types) && $register_details->total_sell_custom_pay_3_refund != 0): ?>
              <?php echo e($payment_types['custom_pay_3'], false); ?>: <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_sell_custom_pay_3_refund, false); ?></span>
          <?php endif; ?>
          <?php if($register_details->total_sell_other_refund != 0): ?>
            Other: <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_sell_other_refund, false); ?></span>
          <?php endif; ?>
          </small>
        </td>
      </tr>
      <?php endif; ?>
      <?php if(($register_details->total_sale + $details['transaction_details']->total_credit_sales) != 0): ?>
      <tr class="success">
        <th>
          <?php echo app('translator')->get('cash_register.net_sales'); ?>:
        </th>
        <td>
          <b><span class="display_currency" data-currency_symbol="true"><?php echo e($details['transaction_details']->total_sales + $details['transaction_details']->total_credit_sales, false); ?></span></b>
        </td>
      </tr>
      <?php endif; ?>
      <?php if(!empty($details['total_tax_collected']) && $details['total_tax_collected'] != 0): ?>
      <tr>
        <th><?php echo app('translator')->get('lang_v1.total_tax'); ?>:</th>
        <td>
          <b><span class="display_currency" data-currency_symbol="true"><?php echo e($details['total_tax_collected'], false); ?></span></b>
        </td>
      </tr>
      <?php endif; ?>
      <?php if(!empty($details['types_of_service_details']) && $details['types_of_service_details']->count() > 0): ?>
      <tr>
        <th colspan="2"><?php echo app('translator')->get('lang_v1.types_of_service'); ?></th>
      </tr>
      <?php $__currentLoopData = $details['types_of_service_details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($tos->types_of_service_name ?? __('lang_v1.none'), false); ?></td>
        <td>
          <span><?php echo e($tos->no_of_transactions, false); ?> <?php echo app('translator')->get('cash_register.no_of_sales'); ?></span>&nbsp;|&nbsp;
          <span class="display_currency" data-currency_symbol="true"><?php echo e($tos->total_sale_amount, false); ?></span>
          <?php if($tos->total_amount > 0): ?>
            &nbsp;(<small><?php echo app('translator')->get('lang_v1.service_charge'); ?>: <span class="display_currency" data-currency_symbol="true"><?php echo e($tos->total_amount, false); ?></span></small>)
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
      <?php if(!empty($details['total_product_discount']) && $details['total_product_discount'] != 0): ?>
      <tr>
        <th><?php echo app('translator')->get('lang_v1.line_discount'); ?>:</th>
        <td>
          <b><span class="display_currency" data-currency_symbol="true"><?php echo e($details['total_product_discount'], false); ?></span></b>
        </td>
      </tr>
      <?php endif; ?>
      <?php if(!empty($details['transaction_details']->total_discount) && $details['transaction_details']->total_discount != 0): ?>
      <tr>
        <th><?php echo app('translator')->get('lang_v1.total_discount'); ?>:</th>
        <td>
          <b><span class="display_currency" data-currency_symbol="true"><?php echo e($details['transaction_details']->total_discount, false); ?></span></b>
        </td>
      </tr>
      <?php endif; ?>
      <?php if(($register_details->other_sale_payments + $register_details->total_refund_prev + $register_details->total_purchase_return_prev + $register_details->other_purchase_payments + $register_details->other_opening_balance_payments + $register_details->other_advance_deposit_payments) != 0): ?>
      <tr>
        <th>
          <?php echo app('translator')->get('cash_register.other_payments'); ?>
        </th>
        <td>
          <b><span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->other_sale_payments - $register_details->total_refund_prev + $register_details->total_purchase_return_prev - $register_details->other_purchase_payments + $register_details->other_opening_balance_payments - $register_details->other_advance_deposit_payments, false); ?></span></b>
          <br>
          <small>
          <?php if($register_details->other_sale_payments != 0): ?>
            Sales: <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->other_sale_payments, false); ?></span><br>
          <?php endif; ?>
          <?php if($register_details->total_refund_prev != 0): ?>
             Sale Returns: <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_refund_prev, false); ?></span><br>
          <?php endif; ?>
          <?php if($register_details->other_purchase_payments != 0): ?>
             Purchases: <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->other_purchase_payments, false); ?></span><br>
          <?php endif; ?>
          <?php if($register_details->total_purchase_return_prev != 0): ?>
             Purchase Returns: <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_purchase_return_prev, false); ?></span><br>
          <?php endif; ?>
          <?php if($register_details->other_opening_balance_payments != 0): ?>
             Opening Balance: <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->other_opening_balance_payments, false); ?></span><br>
          <?php endif; ?>
          
          <?php if($register_details->total_advance_deposits != 0): ?>
             Advance Deposits: <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_advance_deposits, false); ?></span><br>
          <?php endif; ?>
          <?php if($register_details->total_advance_deposits_payments != 0): ?>
             Advance Deposits Adjustments: <span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_advance_deposits_payments, false); ?></span><br>
          <?php endif; ?>
          
          </small>
        </td>
      </tr>
      <?php endif; ?>
      <tr class="success">
        <th>
          <?php echo app('translator')->get('lang_v1.total_payment'); ?>
        </th>
        <td>
          <b><span class="display_currency" data-currency_symbol="true">
            <?php echo e($register_details->total_cash - ($register_details->total_cash_refund + $register_details->total_cash_refund_prev)
              + $register_details->total_card - ($register_details->total_card_refund + $register_details->total_card_refund_prev)
              + $register_details->total_cheque - ($register_details->total_cheque_refund + $register_details->total_cheque_refund_prev)  
              + $register_details->total_bank_transfer - ($register_details->total_bank_transfer_refund + $register_details->total_bank_transfer_refund_prev)
              + $register_details->total_other - ($register_details->total_other_refund + $register_details->total_other_refund_prev)
              + $register_details->total_custom_pay_1 - ($register_details->total_custom_pay_1_refund + $register_details->total_custom_pay_1_refund_prev)
              + $register_details->total_custom_pay_2 - ($register_details->total_custom_pay_2_refund + $register_details->total_custom_pay_2_refund_prev)
              + $register_details->total_custom_pay_3 - ($register_details->total_custom_pay_3_refund + $register_details->total_custom_pay_3_refund_prev)
              + $register_details->total_custom_pay_4 - ($register_details->total_custom_pay_4_refund + $register_details->total_custom_pay_4_refund_prev)
              + $register_details->total_custom_pay_5 - ($register_details->total_custom_pay_5_refund + $register_details->total_custom_pay_5_refund_prev)
              + $register_details->total_custom_pay_6 - ($register_details->total_custom_pay_6_refund + $register_details->total_custom_pay_6_refund_prev)
              + $register_details->total_custom_pay_7 - ($register_details->total_custom_pay_7_refund + $register_details->total_custom_pay_7_refund_prev)
              // + $register_details->total_purchase_return_prev - $register_details->other_purchase_payments
              - $register_details->other_advance_deposit_payments, false); ?>

          </span></b>
        </td>
      </tr>
      <?php if($register_details->total_expense != 0): ?>
      <tr class="danger">
        <th>
          <?php echo app('translator')->get('report.total_expense'); ?>:
        </th>
        <td>
          <b><span class="display_currency" data-currency_symbol="true"><?php echo e($register_details->total_expense, false); ?></span></b>
        </td>
      </tr>
      <?php endif; ?>
    </table>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>
<?php if(!empty($pos_settings['enable_product_sold_details_register']) && !empty($auth_user_settings['view_product_sold_details_register']) && (empty($auth_user_settings['hide_all_details_before_register_closing']) || auth()->user()->hasRole('Admin#' . auth()->user()->business_id)) && !$is_print_out): ?>
  <?php echo $__env->make('cash_register.register_product_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php if(!empty($pos_settings['enable_product_stock_details_register']) && !empty($auth_user_settings['view_product_stock_details_register']) && $is_close && !$is_print_out): ?>
  <?php echo $__env->make('cash_register.register_product_stock_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php if(!empty($pos_settings['enable_drafts_details_register']) && $is_close && !$is_print_out): ?>
  <?php echo $__env->make('cash_register.register_drafts_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php if(!empty($pos_settings['enable_drafts_details_register']) && $is_print_out): ?>
  <?php echo $__env->make('cash_register.register_drafts_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php if(!empty($auth_user_settings['view_expense_details_register']) && (empty($auth_user_settings['hide_all_details_before_register_closing']) || auth()->user()->hasRole('Admin#' . auth()->user()->business_id)) && !$is_print_out): ?>
  <?php echo $__env->make('cash_register.register_expense_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php if(!empty($auth_user_settings['view_paid_purchase_details_register']) && (empty($auth_user_settings['hide_all_details_before_register_closing']) || auth()->user()->hasRole('Admin#' . auth()->user()->business_id)) && !$is_print_out): ?>
  <?php echo $__env->make('cash_register.register_purchase_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
