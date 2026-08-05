<?php
    $payment_status_label = '-';

    if (!empty($transaction->payment_status)) {
        $payment_status_key = 'lang_v1.' . $transaction->payment_status;
        $payment_status_label = __($payment_status_key);

        if ($payment_status_label === $payment_status_key) {
            $payment_status_label = ucwords(str_replace(['-', '_'], ' ', $transaction->payment_status));
        }
    }

    $can_edit_installment_plan = auth()->user()->can('installment.edit');
    $can_delete_installment_plan = auth()->user()->can('installment.delete');
    $can_add_payment = (auth()->user()->can('purchase.payments') && in_array($transaction->type, ['purchase', 'purchase_return']))
        || (auth()->user()->can('sell.payments') && in_array($transaction->type, ['sell', 'gym_subscription']))
        || ((auth()->user()->can('sell_return.payments') || auth()->user()->can('sell.payments')) && $transaction->type == 'sell_return')
        || (auth()->user()->can('truckmate.add_payment') && $transaction->type == 'sell')
        || (auth()->user()->can('expense.payments') && $transaction->type == 'expense');
    $can_edit_payment = (auth()->user()->can('edit_purchase_payment') && in_array($transaction->type, ['purchase', 'purchase_return']))
        || (auth()->user()->can('edit_sell_payment') && in_array($transaction->type, ['sell', 'gym_subscription']))
        || ((auth()->user()->can('edit_sell_return_payment') || auth()->user()->can('edit_sell_payment')) && $transaction->type == 'sell_return')
        || (auth()->user()->can('truckmate.edit_payment') && in_array($transaction->type, ['sell', 'gym_subscription']))
        || (auth()->user()->can('edit_expense_payment') && $transaction->type == 'expense');
    $can_delete_payment = (auth()->user()->can('delete_purchase_payment') && in_array($transaction->type, ['purchase', 'purchase_return']))
        || (auth()->user()->can('delete_sell_payment') && in_array($transaction->type, ['sell', 'gym_subscription']))
        || ((auth()->user()->can('delete_sell_return_payment') || auth()->user()->can('delete_sell_payment')) && $transaction->type == 'sell_return')
        || (auth()->user()->can('truckmate.delete_payment') && in_array($transaction->type, ['sell', 'gym_subscription']))
        || (auth()->user()->can('delete_expense_payment') && $transaction->type == 'expense');
?>

<div class="modal-dialog modal-lg" role="document" style="width:800px">
    <div class="modal-content">
        <div class="modal-header d-flex flex-column align-items-center position-relative">
            <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button> 

            <?php if($transaction->contact->type == 'supplier'): ?>
            <h1 class="m-0">Payment</h1>
            <?php else: ?>
            <h1 class="m-0">Receipt</h1>
            <?php endif; ?>
            
            <hr class="w-100 my-2"> 
            <h4 class="modal-title no-print">
                <?php if($transaction->contact->type == 'supplier'): ?>
                <?php echo app('translator')->get( 'purchase.view_payments' ); ?> 
                <?php else: ?>
                <?php echo app('translator')->get( 'purchase.view_receipts' ); ?> 
                <?php endif; ?>
                (
                <?php if(in_array($transaction->type, ['purchase', 'expense', 'purchase_return', 'payroll'])): ?>    
                    <?php echo app('translator')->get('purchase.ref_no'); ?>: <?php echo e($transaction->ref_no, false); ?> 
                <?php elseif(in_array($transaction->type, ['sell', 'sell_return'])): ?>
                    <?php echo app('translator')->get('sale.invoice_no'); ?>: <?php echo e($transaction->invoice_no, false); ?>

                <?php elseif(in_array($transaction->type, ['hms_booking'])): ?>
                    <?php echo app('translator')->get('hms::lang.booking_Id'); ?>: <?php echo e($transaction->ref_no, false); ?>

                <?php elseif(in_array($transaction->type, ['gym_subscription'])): ?>
                    <?php echo app('translator')->get('sale.invoice_no'); ?>: <?php echo e($transaction->ref_no, false); ?>

                <?php endif; ?>
                )
            </h4>
            
            <h4 class="modal-title text-center d-none d-print-block">
                <?php if(in_array($transaction->type, ['purchase', 'expense', 'purchase_return', 'payroll'])): ?> 
                    <?php echo app('translator')->get('purchase.ref_no'); ?>: <?php echo e($transaction->ref_no, false); ?>

                <?php elseif($transaction->type == 'sell'): ?>
                    <?php echo app('translator')->get('sale.invoice_no'); ?>: <?php echo e($transaction->invoice_no, false); ?>

                <?php elseif(in_array($transaction->type, ['hms_booking'])): ?>
                    <?php echo app('translator')->get('hms::lang.booking_Id'); ?>: <?php echo e($transaction->ref_no, false); ?>

                <?php elseif(in_array($transaction->type, ['gym_subscription'])): ?>
                    <?php echo app('translator')->get('sale.invoice_no'); ?>: <?php echo e($transaction->ref_no, false); ?>

                <?php endif; ?>
            </h4>
        </div>

        <div class="modal-body">
            <div class="row text-center">
                <?php if(in_array($transaction->type, ['purchase', 'purchase_return'])): ?>
                    <?php if(empty($common_settings['supplier_payment_hide_address'])): ?>
                    <h3><?php echo e($transaction->business->name, false); ?></h3>
                    <p><?php echo $transaction->business->business_address; ?></p>
                    <?php endif; ?>

                    <?php if(!empty($common_settings['supplier_payment_header'])): ?>
                        <div class="col-12">
                            <?php echo $common_settings['supplier_payment_header']; ?>

                        </div>
                    <?php endif; ?>
                <?php elseif(in_array($transaction->type, ['expense', 'expense_refund'])): ?>
                    <?php if(empty($common_settings['expense_payment_hide_address'])): ?>
                    <h3><?php echo e($transaction->business->name, false); ?></h3>
                    <p><?php echo $transaction->business->business_address; ?></p>
                    <?php endif; ?>
                    <?php if(!empty($common_settings['expense_payment_header'])): ?>
                        <div class="col-12">
                            <?php echo $common_settings['expense_payment_header']; ?>

                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(empty($common_settings['customer_payment_hide_address'])): ?>
                    <h3><?php echo e($transaction->business->name, false); ?></h3>
                    <p><?php echo $transaction->business->business_address; ?></p>
                    <?php endif; ?>

                    <?php if(!empty($common_settings['customer_payment_header'])): ?>
                        <div class="col-12">
                            <?php echo $common_settings['customer_payment_header']; ?>

                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <hr>
                <br>
            </div>
            <?php if(in_array($transaction->type, ['purchase', 'purchase_return'])): ?>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <?php echo $__env->make('transaction_payment.transaction_supplier_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    
                    <div class="col-md-4 invoice-col">
                    <?php if(empty($common_settings['supplier_payment_hide_address'])): ?>
                        <?php echo $__env->make('transaction_payment.payment_business_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    </div>
                    
                    <div class="col-sm-4 invoice-col">
                        <b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> #<?php echo e($transaction->ref_no, false); ?><br/>
                        <b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($transaction->transaction_date))->format(session('business.date_format')), false); ?><br/>
                        <b><?php echo app('translator')->get('purchase.purchase_status'); ?>:</b> <?php echo e(__('lang_v1.' . $transaction->status), false); ?><br>
                        <b><?php echo app('translator')->get('purchase.payment_status'); ?>:</b> <?php echo e($payment_status_label, false); ?><br>
                    </div>
                </div>
            <?php elseif(in_array($transaction->type, ['expense', 'expense_refund'])): ?>
                <div class="row invoice-info">
                    <?php if(!empty($transaction->contact) && empty($common_settings['expense_payment_hide_address'])): ?>
                        <div class="col-sm-4 invoice-col">
                            <?php echo app('translator')->get('expense.expense_for'); ?>:
                            <address>
                                <strong><?php echo e($transaction->contact->supplier_business_name, false); ?></strong>
                                <?php echo e($transaction->contact->name, false); ?>

                                <?php echo $transaction->contact->contact_address; ?>

                                <?php if(!empty($transaction->contact->tax_number)): ?>
                                    <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($transaction->contact->tax_number, false); ?>

                                <?php endif; ?>
                                <?php if(!empty($transaction->contact->mobile)): ?>
                                    <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($transaction->contact->mobile, false); ?>

                                <?php endif; ?>
                                <?php if(!empty($transaction->contact->email)): ?>
                                    <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($transaction->contact->email, false); ?>

                                <?php endif; ?>
                            </address>
                        </div>
                    <?php endif; ?>
                    <?php if(empty($common_settings['expense_payment_hide_address'])): ?>
                    <div class="col-md-4 invoice-col">
                        <?php echo $__env->make('transaction_payment.payment_business_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <?php endif; ?>

                    <div class="col-sm-4 invoice-col">
                        <b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> #<?php echo e($transaction->ref_no, false); ?><br/>
                        <b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($transaction->transaction_date))->format(session('business.date_format')), false); ?><br/>
                        <b><?php echo app('translator')->get('purchase.payment_status'); ?>:</b> <?php echo e($payment_status_label, false); ?><br>
                    </div>
                </div>
            <?php elseif($transaction->type == 'payroll'): ?>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <?php echo app('translator')->get('essentials::lang.payroll_for'); ?>:
                        <address>
                            <strong><?php echo e($transaction->transaction_for->user_full_name, false); ?></strong>
                            <?php if(!empty($transaction->transaction_for->address)): ?>
                                <br><?php echo e($transaction->transaction_for->address, false); ?>

                            <?php endif; ?>
                            <?php if(!empty($transaction->transaction_for->contact_number)): ?>
                                <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($transaction->transaction_for->contact_number, false); ?>

                            <?php endif; ?>
                            <?php if(!empty($transaction->transaction_for->email)): ?>
                                <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($transaction->transaction_for->email, false); ?>

                            <?php endif; ?>
                        </address>
                    </div>
                    <div class="col-md-4 invoice-col">
                        <?php echo $__env->make('transaction_payment.payment_business_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> #<?php echo e($transaction->ref_no, false); ?><br/>
                        <?php
                            $transaction_date = \Carbon::parse($transaction->transaction_date);
                        ?>
                        <b><?php echo app('translator')->get( 'essentials::lang.month_year' ); ?>:</b> <?php echo e($transaction_date->format('F'), false); ?> <?php echo e($transaction_date->format('Y'), false); ?><br/>
                        <b><?php echo app('translator')->get('purchase.payment_status'); ?>:</b> <?php echo e($payment_status_label, false); ?><br>
                    </div>
                </div>
            <?php else: ?>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <?php echo app('translator')->get('contact.customer'); ?>:
                        <address>
                            <strong><?php echo e($transaction->contact->name, false); ?></strong>

                            <?php echo $transaction->contact->contact_address; ?>

                            <?php if(!empty($transaction->contact->tax_number)): ?>
                                <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($transaction->contact->tax_number, false); ?>

                            <?php endif; ?>
                            <?php if(!empty($transaction->contact->mobile)): ?>
                                <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($transaction->contact->mobile, false); ?>

                            <?php endif; ?>
                            <?php if(!empty($transaction->contact->email)): ?>
                                <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($transaction->contact->email, false); ?>

                            <?php endif; ?>
                        </address>
                    </div>
                    <div class="col-md-4 invoice-col">
                        <?php if(empty($common_settings['customer_payment_hide_address'])): ?>
                        <?php echo $__env->make('transaction_payment.payment_business_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b><?php echo app('translator')->get('sale.invoice_no'); ?>:</b> #<?php echo e($transaction->invoice_no, false); ?><br/>
                        <b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($transaction->transaction_date))->format(session('business.date_format')), false); ?><br/>
                        <b><?php echo app('translator')->get('purchase.payment_status'); ?>:</b> <?php echo e($payment_status_label, false); ?><br>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('send_notification')): ?>
                <?php if($transaction->type == 'purchase'): ?>
                    <div class="row no-print">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-info btn-modal btn-sm" 
                            data-href="<?php echo e(action([\App\Http\Controllers\NotificationController::class, 'getTemplate'], ['transaction_id' => $transaction->id,'template_for' => 'payment_paid']), false); ?>" data-container=".view_modal"><i class="fa fa-envelope"></i> <?php echo app('translator')->get('lang_v1.payment_paid_notification'); ?></button>
                        </div>
                    </div>
                    <br>
                <?php endif; ?>
                <?php if($transaction->type == 'sell'): ?>
                    <div class="row no-print">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-info btn-modal btn-sm" 
                            data-href="<?php echo e(action([\App\Http\Controllers\NotificationController::class, 'getTemplate'], ['transaction_id' => $transaction->id,'template_for' => 'payment_received']), false); ?>" data-container=".view_modal"><i class="fa fa-envelope"></i> <?php echo app('translator')->get('lang_v1.payment_received_notification'); ?></button>
                          
                            <?php if($transaction->payment_status != 'paid'): ?>
                                &nbsp;
                                <button type="button" class="btn btn-warning btn-modal btn-sm" data-href="<?php echo e(action([\App\Http\Controllers\NotificationController::class, 'getTemplate'], ['transaction_id' => $transaction->id,'template_for' => 'payment_reminder']), false); ?>" data-container=".view_modal"><i class="fa fa-envelope"></i> <?php echo app('translator')->get('lang_v1.send_payment_reminder'); ?></button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <br>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(!empty($installment_plan) && ($can_edit_installment_plan || $can_delete_installment_plan)): ?>
                <div class="row no-print">
                    <div class="col-md-12 text-right">
                        <?php if($can_edit_installment_plan): ?>
                            <button type="button"
                                class="btn btn-primary btn-sm edit_installment_plan_from_payment"
                                data-href="<?php echo e(action([\Modules\Installment\Http\Controllers\CustomerController::class, 'edit'], [$installment_plan->id]), false); ?>">
                                <i class="fas fa-edit"></i> Edit Plan
                            </button>
                        <?php endif; ?>
                        <?php if($can_delete_installment_plan): ?>
                            <button type="button"
                                class="btn btn-danger btn-sm delete_installment_plan_from_payment"
                                data-href="<?php echo e(action([\Modules\Installment\Http\Controllers\CustomerController::class, 'destroy'], [$installment_plan->id]), false); ?>">
                                <i class="fas fa-trash"></i> Delete Plan
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
                <br>
            <?php endif; ?>
            <?php if($transaction->payment_status != 'paid' && empty($installment_plan)): ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php if($can_add_payment): ?>
                            <a href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'addPayment'], [$transaction->id]), false); ?>" class="btn btn-primary btn-sm float-end add_payment_modal no-print"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo app('translator')->get("purchase.add_payment"); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                        <tr>
                          <th><?php echo app('translator')->get('messages.date'); ?></th>
                          <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                          <th><?php echo app('translator')->get('purchase.amount'); ?></th>
                          <?php if($business_locations->count() > 1): ?>
                          <th><?php echo app('translator')->get('purchase.location'); ?></th>
                          <?php endif; ?>
                          <th><?php echo app('translator')->get('purchase.payment_method'); ?></th>
                          <th><?php echo app('translator')->get('purchase.payment_note'); ?></th>
                          <?php if($accounts_enabled): ?>
                            <th><?php echo app('translator')->get('lang_v1.payment_account'); ?></th>
                          <?php endif; ?>
                          <th class="no-print"><?php echo app('translator')->get('messages.actions'); ?></th>
                        </tr>
                        <?php $__empty_18 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                              <td><?php echo format_datetime_br($payment->paid_on); ?></td>
                              <td><?php echo e($payment->payment_ref_no, false); ?></td>
                              <td><span class="display_currency" data-currency_symbol="true"><?php if($payment->is_return == 1): ?> <?php echo e(-1*$payment->amount, false); ?> <?php else: ?> <?php echo e($payment->amount, false); ?> <?php endif; ?></span></td>
                              
                              <?php if($business_locations->count() > 1): ?>
                                <td><?php echo e($payment->location->name, false); ?></td>
                              <?php endif; ?>
                              <td><?php echo e($payment_types[$payment->method] ?? '', false); ?>

                                <?php if($payment->is_return == 1): ?>
                                    <br/>
                                    ( <?php echo e(__('lang_v1.change_return'), false); ?> )
                                <?php endif; ?>
                              </td>
                              <td><?php if(!empty($payment->gateway)): ?><?php echo e($payment->gateway, false); ?> - <?php endif; ?> <?php echo e($payment->note, false); ?></td>
                              <?php if($accounts_enabled): ?>
                                <td><?php echo e($payment->payment_account->name ?? '', false); ?></td>
                              <?php endif; ?>
                              <td class="no-print" style="display: flex;">
                              <?php if($can_edit_payment): ?>
                                    <?php
                                    $cp_prefix = request()->session()->get('business.ref_no_prefixes')['contact_payment'];
                                    $cp_payment = substr($payment->payment_ref_no, 0, strlen($cp_prefix));
                                    $same_ref_payments = \App\TransactionPayment::where('transaction_payments.business_id', $payment->business_id)
                                            ->where('transaction_payments.payment_ref_no', $payment->payment_ref_no)
                                            ->get()->count();
                                    ?>
                                    <?php if($payment->method != 'advance' && $cp_payment != $cp_prefix && $same_ref_payments <= 1): ?>
                                        <button type="button" class="btn btn-info btn-sm edit_payment" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'edit'], [$payment->id]), false); ?>">
                                        <i class="fa fa-edit m-auto"></i>
                                        </button>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if($can_delete_payment): ?>
                                    &nbsp; <button type="button" class="btn btn-danger btn-sm delete_payment" 
                                    data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'destroy'], [$payment->id]), false); ?>"
                                    ><i class="fa fa-trash m-auto" aria-hidden="true"></i></button>
                                <?php endif; ?>
                              &nbsp;
                                <button type="button" class="btn btn-primary btn-sm view_payment" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'viewPayment'], [$payment->id]), false); ?>">
                                  <i class="fa fa-eye m-auto" aria-hidden="true"></i>
                                </button>
                              <?php if(!empty($payment->document_path)): ?>
                                &nbsp;
                                <a href="<?php echo e($payment->document_path, false); ?>" class="btn btn-success btn-sm" download="<?php echo e($payment->document_name, false); ?>"><i class="fa fa-download m-auto" data-bs-toggle="tooltip" title="<?php echo e(__('purchase.download_document'), false); ?>"></i></a>
                                <?php if(isFileImage($payment->document_name)): ?>
                                &nbsp;
                                  <button data-href="<?php echo e($payment->document_path, false); ?>" class="btn btn-info btn-sm view_uploaded_document" data-bs-toggle="tooltip" title="<?php echo e(__('lang_v1.view_document'), false); ?>"><i class="fa fa-picture-o m-auto"></i></button>
                                <?php endif; ?>

                              <?php endif; ?>
                              </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr class="text-center">
                              <td colspan="6"><?php echo app('translator')->get('purchase.no_records_found'); ?></td>
                            </tr>
                        <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer no-print">
            <button type="button" class="btn btn-primary no-print" 
              aria-label="Print" 
                onclick="$(this).closest('div.modal-content').printThis();">
                <i class="fa fa-print"></i> <?php echo app('translator')->get( 'messages.print' ); ?>
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
