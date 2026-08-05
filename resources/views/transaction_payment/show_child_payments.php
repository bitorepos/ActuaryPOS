<table class="table table-condensed bg-gray">
  <tr>
    <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
    <th><?php echo app('translator')->get('lang_v1.paid_on'); ?></th>
    <th><?php echo app('translator')->get('sale.amount'); ?></th>
    <th><?php echo app('translator')->get('contact.contact'); ?></th>
    <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
    <th><?php if($child_payments->first()->transaction->type == 'purchase'): ?> <?php echo app('translator')->get('purchase.ref_no'); ?> <?php else: ?>  <?php echo app('translator')->get('sale.invoice_no'); ?> <?php endif; ?></th>
    <th class="no-print"><?php echo app('translator')->get('messages.action'); ?></th>
  </tr>
  <?php $__empty_18 = true; $__currentLoopData = $child_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
    <tr>
      <td><?php echo e($payment->payment_ref_no, false); ?></td>
      <td><?php echo format_datetime_br($payment->paid_on); ?></td>
      <td><span class="display_currency" data-currency_symbol="true"><?php echo e($payment->amount, false); ?></span></td>
      <td><?php echo e($payment->transaction->contact->name, false); ?></td>
      <td><?php echo e($payment_types[$payment->method] ?? '', false); ?></td>
      <td><?php if($payment->transaction->type != 'opening_balance'): ?> <a data-href="<?php if($payment->transaction->type == 'sell'): ?><?php echo e(action([\App\Http\Controllers\SellController::class, 'show'], [$payment->transaction_id]), false); ?><?php else: ?><?php echo e(action([\App\Http\Controllers\PurchaseController::class, 'show'], [$payment->transaction_id]), false); ?><?php endif; ?>" href="#" data-container=".view_modal" class="btn-modal"><?php if($payment->transaction->type == 'sell'): ?> <?php echo e($payment->transaction->invoice_no, false); ?> <?php else: ?> <?php echo e($payment->transaction->ref_no, false); ?> <?php endif; ?></a> <?php else: ?>
        <?php echo app('translator')->get('lang_v1.opening_balance_payments'); ?>
      <?php endif; ?></td>
      <td class="no-print">
        <button type="button" class="btn btn-primary btn-sm view_payment" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'viewPayment'], [$payment->id]), false); ?>" ><?php echo app('translator')->get("messages.view"); ?>
                    </button>
      </td>
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
    <tr class="text-center">
      <td colspan="6"><?php echo app('translator')->get('purchase.no_records_found'); ?></td>
    </tr>
  <?php endif; ?>
</table>
