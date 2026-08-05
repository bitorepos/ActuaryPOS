<div class="table-responsive">
<table class="table table-bordered table-th-skin" 
id="contact_payments_table">
    <thead>
        <tr>
            <th></th>
            <th><?php echo app('translator')->get('lang_v1.paid_on'); ?></th>
            <th><?php echo app('translator')->get('purchase.ref_no_short'); ?></th>
            <th><?php echo app('translator')->get('sale.amount'); ?></th>
            <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
            <th><?php echo app('translator')->get('account.payment_for'); ?></th>
            <th><?php echo app('translator')->get('messages.action'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $page_total = 0; ?>
        <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $count_child_payments = count($payment->child_payments);
                $page_total += $payment->amount;
            ?>
            
            <?php echo $__env->make('contact.partials.payment_row', compact('payment', 'count_child_payments', 'payment_types'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if($count_child_payments > 0): ?>
                <?php $__currentLoopData = $payment->child_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child_payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('contact.partials.payment_row', ['payment' => $child_payment, 'count_child_payments' => 0, 'payment_types' => $payment_types, 'parent_payment_ref_no' => $payment->payment_ref_no], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7" class="text-center"><?php echo app('translator')->get('purchase.no_records_found'); ?></td>
            </tr>
        <?php endif; ?>
    </tbody>
    <?php if($payments->count() > 0): ?>
    <tfoot>
        <tr class="table-th-skin">
            <td colspan="3" class="text-end fw-bold"><?php echo app('translator')->get('sale.total'); ?>:</td>
            <td class="fw-bold"><span class="display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $page_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span></td>
            <td colspan="3"></td>
        </tr>
    </tfoot>
    <?php endif; ?>
</table>
</div>
<div class="text-right" style="width: 100%;" id="contact_payments_pagination"><?php echo e($payments->links(), false); ?></div>
