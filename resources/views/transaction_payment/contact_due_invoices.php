<b>Outstanding:</b>
<div class="table-responsive">
<table class="table table-striped" id="due_invoices_table" style="table-layout: auto; width: 100%;">
  <thead class="bg-success">
    <tr>
      <th class="text-nowrap">#</th>
      <th class="text-nowrap">Location</th>
      <th class="text-nowrap">Type</th>
      <th class="text-nowrap">Inv No.</th>
      <th class="text-nowrap">Date</th>
      <th class="text-nowrap text-end">Total</th>
      <th class="text-nowrap text-end">Paid</th>
      <th class="text-nowrap">Today Pay</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $invoice_total_amount = 0;
      $invoice_total_paid = 0;
      $invoice_total_due = 0;
      $ledger_discount_types = ['ledger_discount','ledger_discount2','ledger_discount3'];
    ?>
    <?php $__empty_18 = true; $__currentLoopData = $due_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
      <tr>
        <td><?php echo e($loop->index+1, false); ?></td>
        <td><?php echo e($dt->location, false); ?></td>
        <td><?php
          $type_prefixes = [
            'opening_balance' => 'OB',
            'sell'            => 'SI',
            'sell_return'     => 'SR',
            'purchase'        => 'PI',
            'purchase_return' => 'PR',
            'advance_deposit' => 'AD',
            'ledger_discount' => 'LD',
            'ledger_discount2' => 'LD2',
            'ledger_discount3' => 'LD3',
            'expense'         => 'EXP',
            'sales_order'     => 'SO',
            'purchase_order'  => 'PO',
          ];
          $type_prefix = $type_prefixes[$dt->type] ?? strtoupper(substr(str_replace('_',' ',$dt->type),0,3));
          $type_full   = ucwords(str_replace('_', ' ', $dt->type));
        ?>
        <span title="<?php echo e($type_full, false); ?>"><?php echo e($type_prefix, false); ?></span></td>
        <td><?php echo e((!empty($dt->invoice_no)) ? $dt->invoice_no : $dt->ref_no, false); ?></td>
        <td><?php echo e(\Carbon::createFromTimestamp(strtotime($dt->transaction_date))->format(session('business.date_format')), false); ?></td>
        <td>
          
          <?php if($contact_details->type == 'supplier'): ?>
            <?php if(in_array($dt->type, ['purchase_return'])): ?>
              <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            <?php elseif($dt->type == 'opening_balance' && $dt->sub_type == 'debit'): ?>
              <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            <?php elseif($dt->type == 'advance_deposit' && $dt->sub_type == 'debit'): ?>
              <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            <?php elseif(in_array($dt->type, $ledger_discount_types) && $dt->sub_type == 'purchase_discount'): ?>
              <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            <?php else: ?>
              <?php echo e(number_format($dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            <?php endif; ?>

          <?php elseif($contact_details->type == 'customer'): ?>
            <?php if(in_array($dt->type, array_merge(['sell_return'], $ledger_discount_types))): ?>
              <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            <?php elseif($dt->type == 'opening_balance' && $dt->sub_type == 'credit'): ?>
              <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            <?php elseif($dt->type == 'advance_deposit' && $dt->sub_type == 'credit'): ?>
              <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            <?php elseif(in_array($dt->type, $ledger_discount_types) && $dt->sub_type == 'sell_discount'): ?>
              <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            <?php else: ?>
              <?php echo e(number_format($dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            <?php endif; ?>

          <?php elseif($contact_details->type == 'both'): ?>
            <?php if(in_array($dt->type, ['sell_return', 'purchase'])): ?>
              <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            <?php elseif($dt->type == 'opening_balance' && $dt->sub_type == 'credit'): ?>
              <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            <?php elseif($dt->type == 'advance_deposit' && $dt->sub_type == 'credit'): ?>
              <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            <?php elseif(in_array($dt->type, $ledger_discount_types) && $dt->sub_type == 'sell_discount'): ?>
              <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            <?php else: ?>
              <?php echo e(number_format($dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            <?php endif; ?>
          <?php endif; ?>
        </td>
        <td><?php if($dt->type != 'advance'): ?><?php echo e(number_format($dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?><?php endif; ?></td>
        <td>
          <?php if($dt->type != 'advance'): ?>
          <?php
            $due_value = $dt->final_total - $dt->total_paid;
            if($contact_details->type == 'supplier'){
              if(in_array($dt->type, ['purchase_return'])){
                $due_value = -1*$due_value;
              }else if($dt->type == 'opening_balance' && $dt->sub_type == 'debit'){
                $due_value = -1*$due_value;
              }else if($dt->type == 'advance_deposit' && $dt->sub_type == 'debit'){
                $due_value = -1*$due_value;
              }else if(in_array($dt->type, $ledger_discount_types) && $dt->sub_type == 'purchase_discount'){
                $due_value = -1*$due_value;
              }
            
            }else if($contact_details->type == 'customer'){
              if(in_array($dt->type, array_merge(['sell_return'], $ledger_discount_types))){
                $due_value = -1*$due_value;
              }else if($dt->type == 'opening_balance' && $dt->sub_type == 'credit'){
                $due_value = -1*$due_value;
              }else if($dt->type == 'advance_deposit' && $dt->sub_type == 'credit'){
                $due_value = -1*$due_value;
              }else if(in_array($dt->type, $ledger_discount_types) && $dt->sub_type == 'sell_discount'){
                $due_value = -1*$due_value;
              }
            
            }else if($contact_details->type == 'both'){
              if(in_array($dt->type, ['sell_return','purchase'])){
                $due_value = -1*$due_value;
              }else if($dt->type == 'opening_balance' && $dt->sub_type == 'credit'){
                $due_value = -1*$due_value;
              }else if($dt->type == 'advance_deposit' && $dt->sub_type == 'credit'){
                $due_value = -1*$due_value;
              }else if(in_array($dt->type, $ledger_discount_types) && $dt->sub_type == 'sell_discount'){
                $due_value = -1*$due_value;
              }
            }
            if(!empty($from_date) && ($dt->transaction_date < $from_date)){
              $due_value = 0;
            }
            if(!empty($to_date) && ($dt->transaction_date > $to_date)){
              $due_value = 0;
            }
          ?>

          <input type="text" class="form-control input-sm due_invoices" name="due_invoice[<?php echo e($dt->id, false); ?>]" data-final_total="<?php echo e($dt->final_total, false); ?>" data-total_paid="<?php echo e($dt->total_paid, false); ?>" value="<?php echo e(number_format($due_value, session('business.currency_precision', 2), session('currency')['decimal_separator'], ''), false); ?>" data-invoice-type="<?php echo e($dt->type, false); ?>" data-invoice-sub-type="<?php echo e($dt->sub_type, false); ?>" data-contact-due='true'
            
            >
          <?php endif; ?>
        </td>
      </tr>
      <?php
      if($contact_details->type == 'supplier'){
        if(in_array($dt->type, ['purchase_return'])){
          $invoice_total_amount -= $dt->final_total;
          $invoice_total_paid += $dt->total_paid;
          $invoice_total_due += $due_value;
        }else if(($dt->type == 'opening_balance' && $dt->sub_type == 'debit') || ($dt->type == 'advance_deposit' && $dt->sub_type == 'debit') || (in_array($dt->type, $ledger_discount_types) && $dt->sub_type == 'purchase_discount')){
          $invoice_total_amount -= $dt->final_total;
          $invoice_total_paid += $dt->total_paid;
          $invoice_total_due += $due_value;
        }else{
          $invoice_total_amount += $dt->final_total;
          $invoice_total_paid += $dt->total_paid;
          $invoice_total_due += $due_value;
        }
      }else if($contact_details->type == 'customer'){
        if(in_array($dt->type, ['sell_return'])){
          $invoice_total_amount -= $dt->final_total;
          $invoice_total_paid += $dt->total_paid;
          $invoice_total_due += $due_value;
        }else if(($dt->type == 'opening_balance' && $dt->sub_type == 'credit') || ($dt->type == 'advance_deposit' && $dt->sub_type == 'credit') || (in_array($dt->type, $ledger_discount_types) && $dt->sub_type == 'sell_discount')){
          $invoice_total_amount -= $dt->final_total;
          $invoice_total_paid += $dt->total_paid;
          $invoice_total_due += $due_value;
        }else{
          $invoice_total_amount += $dt->final_total;
          $invoice_total_paid += $dt->total_paid;
          $invoice_total_due += $due_value;
        }
      }else if($contact_details->type == 'both'){
        if(in_array($dt->type, ['sell_return', 'purchase'])){
          $invoice_total_amount -= $dt->final_total;
          $invoice_total_paid += $dt->total_paid;
          $invoice_total_due += $due_value;
        }else if(($dt->type == 'opening_balance' && $dt->sub_type == 'credit') || ($dt->type == 'advance_deposit' && $dt->sub_type == 'credit') || (in_array($dt->type, $ledger_discount_types) && $dt->sub_type == 'sell_discount')){
          $invoice_total_amount -= $dt->final_total;
          $invoice_total_paid += $dt->total_paid;
          $invoice_total_due += $due_value;
        }else{
          $invoice_total_amount += $dt->final_total;
          $invoice_total_paid += $dt->total_paid;
          $invoice_total_due += $due_value;
        }
      }
        // // if(!in_array($dt->type, ['purchase_return', 'sell_return'])){
        //   if(in_array($dt->type, ['advance_deposit','purchase_return','sell_return', 'ledger_discount'])){
        //     $invoice_total_amount -= $dt->final_total;
        //     $invoice_total_paid += $dt->total_paid;
        //     $invoice_total_due += $due_value;
        //   }else{
        //     $invoice_total_amount += $dt->final_total;
        //     $invoice_total_paid += $dt->total_paid;
        //     $invoice_total_due += $due_value;
        //   }
          
        //   // $invoice_total_due += $due_value;
        // // }
      ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
        <td class="text-center" colspan="7">No Due Transactions</td>
    <?php endif; ?>
  </tbody>
  <tfoot class="bg-success">
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?php echo e(!empty($invoice_total_amount) ? number_format($invoice_total_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '', false); ?></td>
      <td><?php echo e(!empty($invoice_total_paid) ? number_format($invoice_total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '', false); ?></td>
      <td id="invoice_total_due_contact" value="<?php echo e($invoice_total_due, false); ?>"><?php echo e(!empty($invoice_total_due) ? number_format($invoice_total_due, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '', false); ?></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>Difference</td>
      <td id="invoice_total_diff_contact" class="text-danger"><?php echo e(number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
    </tr>
  </tfoot>
  </table>
</div>
  <input type="hidden" id="is_first" value='0'>
  <input type="hidden" id="is_change" name="is_change" value='0'>
  <input type="hidden" id="is_invalid" value='0'>
