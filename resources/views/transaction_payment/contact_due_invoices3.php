<b>Outstanding:</b>
<div class="table-responsive">
<table class="table table-striped" id="due_invoices_table" style="table-layout: auto; width: 100%;">
            <thead class="bg-success">
              <tr>
                <th style="width:1%;" class="text-nowrap">#</th>
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
                  <td><?php echo e(ucwords(str_replace('_', ' ', $dt->type)), false); ?></td>
                  <td><?php echo e((!empty($dt->invoice_no)) ? $dt->invoice_no : $dt->ref_no, false); ?></td>
                  <td><?php echo e(\Carbon::createFromTimestamp(strtotime($dt->transaction_date))->format(session('business.date_format')), false); ?></td>
                  <td>
                    <?php if($contact_details->type == 'supplier'): ?>
                      <?php if(($dt->type == 'opening_balance' && $dt->sub_type == 'credit') || ($dt->type == 'advance_deposit' && $dt->sub_type == 'credit') || (in_array($dt->type, $ledger_discount_types) && $dt->sub_type == 'sell_discount') || $dt->type == 'purchase' || $dt->type == 'sell_return'): ?>
                        <?php echo e(number_format($dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php else: ?>
                        <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php endif; ?>
                    <?php elseif($contact_details->type == 'customer'): ?>
                      <?php if(($dt->type == 'opening_balance' && $dt->sub_type == 'debit') || ($dt->type == 'advance_deposit' && $dt->sub_type == 'debit') || (in_array($dt->type, $ledger_discount_types) && $dt->sub_type == 'purchase_discount') || $dt->type == 'sell' || $dt->type == 'purchase_return'): ?>
                        <?php echo e(number_format($dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php else: ?>
                        <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php endif; ?>
                    <?php elseif($contact_details->type == 'both'): ?>
                      <?php if(($dt->type == 'opening_balance' && $dt->sub_type == 'debit') || ($dt->type == 'advance_deposit' && $dt->sub_type == 'debit') || (in_array($dt->type, $ledger_discount_types) && $dt->sub_type == 'purchase_discount') || $dt->type == 'sell' || $dt->type == 'purchase_return'): ?>
                        <?php echo e(number_format($dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php else: ?>
                        <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php endif; ?>
                    <?php endif; ?>
                  </td>
                  <td><?php if($dt->type != 'advance'): ?><?php echo e(number_format($dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?><?php endif; ?></td>
                  <td>
                    <?php if($dt->type != 'advance'): ?>
                    <?php
                      $due_value = $dt->final_total - $dt->total_paid;
                      if($contact_details->type == 'supplier'){
                        if(($dt->type == 'opening_balance' && $dt->sub_type == 'debit') || ($dt->type == 'advance_deposit' && $dt->sub_type == 'debit') || (in_array($dt->type, $ledger_discount_types) && $dt->sub_type == 'purchase_discount') || $dt->type == 'purchase_return' || $dt->type == 'sell'){
                          $due_value = -1*$due_value;
                        }
                      }else if($contact_details->type == 'customer'){
                        if(($dt->type == 'opening_balance' && $dt->sub_type == 'credit') || ($dt->type == 'advance_deposit' && $dt->sub_type == 'credit') || (in_array($dt->type, $ledger_discount_types) && $dt->sub_type == 'sell_discount') || $dt->type == 'sell_return' || $dt->type == 'purchase'){
                          $due_value = -1*$due_value;
                        }
                      }else if($contact_details->type == 'both'){
                        // if(in_array($dt->type, ['advance_deposit','purchase_return', 'sell']) && $due_payment_type == 'purchase'){
                        //   $due_value = -1*$due_value;
                        // }elseif(in_array($dt->type, ['advance_deposit','sell_return', 'purchase']) && $due_payment_type == 'sell'){
                        //   $due_value = -1*$due_value;
                        // }
                        if(($dt->type == 'opening_balance' && $dt->sub_type == 'credit') || ($dt->type == 'advance_deposit' && $dt->sub_type == 'credit') || (in_array($dt->type, $ledger_discount_types) && $dt->sub_type == 'sell_discount') || $dt->type == 'sell_return' || $dt->type == 'purchase'){
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

                    <input type="text" class="form-control input-sm due_invoices" name="due_invoice[<?php echo e($dt->id, false); ?>]" data-final_total="<?php echo e($dt->final_total, false); ?>" data-total_paid="<?php echo e($dt->total_paid, false); ?>" value="<?php echo e(number_format($due_value, session('business.currency_precision', 2), session('currency')['decimal_separator'], ''), false); ?>" data-invoice-type="<?php echo e($dt->type, false); ?>" data-invoice-sub-type="<?php echo e($dt->sub_type, false); ?>"
                      
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
                      if(in_array($dt->type, array_merge(['sell_return', 'purchase'], $ledger_discount_types))){
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
                    // if($contact_details->type == 'both'){
                    //   if(in_array($dt->type, ['advance_deposit','purchase_return','purchase','sell_return'])){
                    //     $invoice_total_amount -= $dt->final_total;
                    //     $invoice_total_paid += $dt->total_paid;
                    //     $invoice_total_due += $due_value;
                    //   }else{
                    //     $invoice_total_amount += $dt->final_total;
                    //     $invoice_total_paid += $dt->total_paid;
                    //     $invoice_total_due += $due_value;
                    //   }
                    // }else{
                    //   if(in_array($dt->type, ['advance_deposit','purchase_return','sell_return'])){
                    //     $invoice_total_amount -= $dt->final_total;
                    //     $invoice_total_paid += $dt->total_paid;
                    //     $invoice_total_due += $due_value;
                    //   }else{
                    //     $invoice_total_amount += $dt->final_total;
                    //     $invoice_total_paid += $dt->total_paid;
                    //     $invoice_total_due += $due_value;
                    //   }
                    // }
                ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                  <td class="text-center" colspan="7">No Due Transactions</td>
              <?php endif; ?>
            </tbody>
            <tfoot class="bg-success">
              <tr>
                <td>
                  <button type="button" class="btn btn-primary btn-sm" id="auto_apply_btn">Auto Apply</button>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?php echo e(!empty($invoice_total_amount) ? number_format($invoice_total_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '', false); ?></td>
                <td><?php echo e(!empty($invoice_total_paid) ? number_format($invoice_total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '', false); ?></td>
                <td id="invoice_total_due" value="<?php echo e($invoice_total_due, false); ?>"><?php echo e(!empty($invoice_total_due) ? number_format($invoice_total_due, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '', false); ?></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Difference</td>
                <td id="invoice_total_diff" class="text-danger"><?php echo e(number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
              </tr>
            </tfoot>
           </table>
</div>
           <input type="hidden" id="is_first" value='0'>
           <input type="hidden" id="is_change" name="is_change" value='0'>
           <input type="hidden" id="is_invalid" value='0'>
