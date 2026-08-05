<span id="view_contact_page"></span>
<div class="col-md-12">
    <div class="row align-items-start" style="min-height: 0;">
        
        <div class="col-md-7">
            <div class="row">
                <div class="col-sm-4">
                    <?php echo $__env->make('contact.contact_basic_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-sm-4 mt-56">
                    <?php echo $__env->make('contact.contact_more_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <?php if( $contact->type != 'customer'): ?>
                    <div class="col-sm-4 mt-56">
                        <?php echo $__env->make('contact.contact_tax_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="col-md-5 d-flex flex-column align-items-end justify-content-center gap-2 py-2">
            <?php if( $contact->type == 'supplier'): ?>
                <?php if(($contact->total_purchase - $contact->purchase_paid + $contact->total_purchase_return - $contact->purchase_return_paid + $contact->opening_balance - $contact->opening_balance_paid + $contact->advance_deposit - $contact->advance_deposit_paid + $contact->ledger_discount - $contact->ledger_discount_paid) != 0): ?>
                    <a href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'getPayContactDue'], [$contact->id]), false); ?>?type=purchase" class="pay_purchase_due btn btn-primary btn-sm"><i class="fas fa-money-bill-alt" aria-hidden="true"></i> <?php echo app('translator')->get("contact.pay_due_amount"); ?></a>
                <?php endif; ?>
            <?php else: ?>
                <?php if(($contact->total_invoice - $contact->invoice_recieved + $contact->total_invoice_return - $contact->invoice_return_received - $contact->total_purchase - $contact->purchase_paid + $contact->total_purchase_return - $contact->purchase_return_paid + $contact->opening_balance - $contact->opening_balance_paid + $contact->advance_deposit - $contact->advance_deposit_paid + $contact->ledger_discount - $contact->ledger_discount_paid) != 0): ?>
                    <a href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'getPayContactDue'], [$contact->id]), false); ?>?type=sell" class="pay_purchase_due btn btn-primary btn-sm"><i class="fas fa-money-bill-alt" aria-hidden="true"></i> <?php echo app('translator')->get("contact.pay_due_amount"); ?></a>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(empty($common_settings['disable_ledger_discount'])): ?>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary btn-sm" id="view_ledger_discounts_modal" data-contact-id="<?php echo e($contact->id, false); ?>"><?php if(!empty($common_settings['ledger_discount_label'])): ?> <?php echo app('translator')->get('lang_v1.view'); ?> <?php echo e($common_settings['ledger_discount_label'], false); ?> <?php else: ?> <?php echo app('translator')->get('lang_v1.view_ledger_discounts'); ?> <?php endif; ?></button>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_discount_modal"><?php if(!empty($common_settings['ledger_discount_label'])): ?> <?php echo app('translator')->get('lang_v1.add'); ?> <?php echo e($common_settings['ledger_discount_label'], false); ?> <?php else: ?> <?php echo app('translator')->get('lang_v1.add_discount'); ?> <?php endif; ?></button>
            </div>
            <?php endif; ?>
            <?php if(!empty($common_settings['enable_ledger_discount2'])): ?>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary btn-sm" id="view_ledger_discounts2_modal" data-contact-id="<?php echo e($contact->id, false); ?>"><?php if(!empty($common_settings['ledger_discount2_label'])): ?> <?php echo app('translator')->get('lang_v1.view'); ?> <?php echo e($common_settings['ledger_discount2_label'], false); ?> <?php else: ?> <?php echo app('translator')->get('lang_v1.view_ledger_discounts2'); ?> <?php endif; ?></button>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_discount2_modal"><?php if(!empty($common_settings['ledger_discount2_label'])): ?> <?php echo app('translator')->get('lang_v1.add'); ?> <?php echo e($common_settings['ledger_discount2_label'], false); ?> <?php else: ?> <?php echo app('translator')->get('lang_v1.add_discount2'); ?> <?php endif; ?></button>
            </div>
            <?php endif; ?>
            <?php if(!empty($common_settings['enable_ledger_discount3']) && $contact->type == 'supplier'): ?>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary btn-sm" id="view_ledger_discounts3_modal" data-contact-id="<?php echo e($contact->id, false); ?>"><?php if(!empty($common_settings['ledger_discount3_label'])): ?> <?php echo app('translator')->get('lang_v1.view'); ?> <?php echo e($common_settings['ledger_discount3_label'], false); ?> <?php else: ?> <?php echo app('translator')->get('lang_v1.view_ledger_discounts3'); ?> <?php endif; ?></button>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_discount3_modal"><?php if(!empty($common_settings['ledger_discount3_label'])): ?> <?php echo app('translator')->get('lang_v1.add'); ?> <?php echo e($common_settings['ledger_discount3_label'], false); ?> <?php else: ?> <?php echo app('translator')->get('lang_v1.add_ledger_discount3'); ?> <?php endif; ?></button>
            </div>
            <?php endif; ?>
            <?php
                $advance_deposit_contact_type = $contact->type == 'supplier' ? 'supplier' : 'customer';
                $advance_deposit_class = $advance_deposit_contact_type == 'supplier' ? 'pay_supplier_deposit' : 'pay_customer_deposit';
                $can_open_advance_deposit = $advance_deposit_contact_type == 'supplier'
                    ? auth()->user()->can('purchase.payments')
                    : auth()->user()->can('sell.payments');
                $advance_deposit_url = action([\App\Http\Controllers\TransactionPaymentController::class, 'getPayContactDeposit'], [$contact->id]) . '?type=' . $advance_deposit_contact_type;
            ?>
            <?php if(!config('constants.is_offline') && $can_open_advance_deposit): ?>
            <div class="d-flex gap-2">
                <a href="<?php echo e($advance_deposit_url, false); ?>&mode=view" class="<?php echo e($advance_deposit_class, false); ?> btn btn-primary btn-sm"><?php echo app('translator')->get('lang_v1.view'); ?> <?php echo app('translator')->get('lang_v1.advance_deposit'); ?></a>
                <a href="<?php echo e($advance_deposit_url, false); ?>&mode=add" class="<?php echo e($advance_deposit_class, false); ?> btn btn-primary btn-sm"><?php echo app('translator')->get('lang_v1.add'); ?> <?php echo app('translator')->get('lang_v1.advance_deposit'); ?></a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
