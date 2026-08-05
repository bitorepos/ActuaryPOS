<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header no-print">
      <h4 class="modal-title no-print">
        View 
        <?php if($transaction->contact->type == 'supplier'): ?>
          <?php echo app('translator')->get('lang_v1.pay_supplier'); ?>
        <?php else: ?>
          <?php echo app('translator')->get('lang_v1.pay_customer'); ?>
        <?php endif; ?>
        
        <?php if(!empty($single_payment_line->payment_ref_no)): ?>
          ( <?php echo app('translator')->get('purchase.ref_no'); ?>: <?php echo e($single_payment_line->payment_ref_no, false); ?> )
        <?php endif; ?>
      </h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
      
    </div>
    <div class="modal-body">
      <div class="row text-center">

        <?php if(in_array($transaction->type, ['purchase', 'purchase_return'])): ?>
          <?php if(empty($common_settings['supplier_payment_hide_address'])): ?>
          <h3><?php echo e($single_payment_line->business->name, false); ?></h3>
          <p><?php echo $single_payment_line->business->business_address; ?></p>
          <?php endif; ?>
          <?php if(!empty($common_settings['supplier_payment_header'])): ?>
            <div class="col-12">
                <?php echo $common_settings['supplier_payment_header']; ?>

            </div>
          <?php endif; ?>
        <?php elseif(in_array($transaction->type, ['expense', 'expense_refund'])): ?>
          <?php if(empty($common_settings['expense_payment_hide_address'])): ?>
          <h3><?php echo e($single_payment_line->business->name, false); ?></h3>
          <p><?php echo $single_payment_line->business->business_address; ?></p>
          <?php endif; ?>
          <?php if(!empty($common_settings['expense_payment_header'])): ?>
            <div class="col-12">
                <?php echo $common_settings['expense_payment_header']; ?>

            </div>
          <?php endif; ?>
        <?php else: ?>
          <?php if(empty($common_settings['customer_payment_hide_address'])): ?>
          <h3><?php echo e($single_payment_line->business->name, false); ?></h3>
          <p><?php echo $single_payment_line->business->business_address; ?></p>
          <?php endif; ?>
          <?php if(!empty($common_settings['customer_payment_header'])): ?>
            <div class="col-12">
                <?php echo $common_settings['customer_payment_header']; ?>

            </div>
          <?php endif; ?>
        <?php endif; ?>
        <hr>
      </div>

      <?php if(!empty($transaction)): ?>
      <div class="row">
        <?php if(in_array($transaction->type, ['purchase', 'purchase_return'])): ?>
            <div class="col-6">
              <?php echo app('translator')->get('purchase.supplier'); ?>:
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
            <div class="col-6">
              <?php echo app('translator')->get('business.business'); ?>:
              <address>
                <strong><?php echo e($transaction->business->name, false); ?></strong>

                <?php if(!empty($transaction->location)): ?>
                  <?php echo e($transaction->location->name, false); ?>

                  <?php if(!empty($transaction->location->landmark)): ?>
                    <br><?php echo e($transaction->location->landmark, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($transaction->location->city) || !empty($transaction->location->state) || !empty($transaction->location->country)): ?>
                    <br><?php echo e(implode(',', array_filter([$transaction->location->city, $transaction->location->state, $transaction->location->country])), false); ?>

                  <?php endif; ?>
                <?php endif; ?>
                
                <?php if(!empty($transaction->business->tax_number_1)): ?>
                  <br><?php echo e($transaction->business->tax_label_1, false); ?>: <?php echo e($transaction->business->tax_number_1, false); ?>

                <?php endif; ?>

                <?php if(!empty($transaction->business->tax_number_2)): ?>
                  <br><?php echo e($transaction->business->tax_label_2, false); ?>: <?php echo e($transaction->business->tax_number_2, false); ?>

                <?php endif; ?>

                <?php if(!empty($transaction->location)): ?>
                  <?php if(!empty($transaction->location->mobile)): ?>
                    <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($transaction->location->mobile, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($transaction->location->email)): ?>
                    <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($transaction->location->email, false); ?>

                  <?php endif; ?>
                <?php endif; ?>
              </address>
            </div>
        <?php elseif(in_array($transaction->type, ['expense', 'expense_refund'])): ?>
          <?php if(empty($common_settings['expense_payment_hide_address'])): ?>
          <div class="col-6">
            <?php if(!empty($transaction->contact)): ?>
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
            <?php endif; ?>
          </div>
          <div class="col-6">
            <?php echo app('translator')->get('business.business'); ?>:
            <address>
              <strong><?php echo e($transaction->business->name, false); ?></strong>
              <?php if(!empty($transaction->location)): ?>
                <?php echo e($transaction->location->name, false); ?>

                <?php if(!empty($transaction->location->landmark)): ?>
                  <br><?php echo e($transaction->location->landmark, false); ?>

                <?php endif; ?>
                <?php if(!empty($transaction->location->city) || !empty($transaction->location->state) || !empty($transaction->location->country)): ?>
                  <br><?php echo e(implode(',', array_filter([$transaction->location->city, $transaction->location->state, $transaction->location->country])), false); ?>

                <?php endif; ?>
              <?php endif; ?>
              <?php if(!empty($transaction->business->tax_number_1)): ?>
                <br><?php echo e($transaction->business->tax_label_1, false); ?>: <?php echo e($transaction->business->tax_number_1, false); ?>

              <?php endif; ?>
              <?php if(!empty($transaction->business->tax_number_2)): ?>
                <br><?php echo e($transaction->business->tax_label_2, false); ?>: <?php echo e($transaction->business->tax_number_2, false); ?>

              <?php endif; ?>
              <?php if(!empty($transaction->location)): ?>
                <?php if(!empty($transaction->location->mobile)): ?>
                  <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($transaction->location->mobile, false); ?>

                <?php endif; ?>
                <?php if(!empty($transaction->location->email)): ?>
                  <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($transaction->location->email, false); ?>

                <?php endif; ?>
              <?php endif; ?>
            </address>
          </div>
          <?php endif; ?>
        <?php else: ?>
          <div class="col-6">
            <?php if($transaction->type != 'payroll' && !empty($transaction->contact)): ?>
              <?php if($transaction->contact->type == 'customer'): ?>
              <?php echo app('translator')->get('contact.customer'); ?>:
              <?php elseif($transaction->contact->type == 'both'): ?>
              <?php echo app('translator')->get('contact.barterer'); ?>:
              <?php endif; ?>
              
              <address>
                <strong><?php echo e($transaction->contact->name ?? '', false); ?></strong>
               
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
            <?php else: ?>
            <?php if(!empty($transaction->transaction_for)): ?>
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
            <?php endif; ?>
            <?php endif; ?>
          </div>
          <div class="col-6">
            <?php echo app('translator')->get('business.business'); ?>:
            <address>
              <strong><?php echo e($transaction->business->name, false); ?></strong>
              <?php if(!empty($transaction->location)): ?>
                <?php echo e($transaction->location->name, false); ?>

                <?php if(!empty($transaction->location->landmark)): ?>
                  <br><?php echo e($transaction->location->landmark, false); ?>

                <?php endif; ?>
                <?php if(!empty($transaction->location->city) || !empty($transaction->location->state) || !empty($transaction->location->country)): ?>
                  <br><?php echo e(implode(',', array_filter([$transaction->location->city, $transaction->location->state, $transaction->location->country])), false); ?>

                <?php endif; ?>
              <?php endif; ?>
              
              <?php if(!empty($transaction->business->tax_number_1)): ?>
                <br><?php echo e($transaction->business->tax_label_1, false); ?>: <?php echo e($transaction->business->tax_number_1, false); ?>

              <?php endif; ?>

              <?php if(!empty($transaction->business->tax_number_2)): ?>
                <br><?php echo e($transaction->business->tax_label_2, false); ?>: <?php echo e($transaction->business->tax_number_2, false); ?>

              <?php endif; ?>

              <?php if(!empty($transaction->location)): ?>
                <?php if(!empty($transaction->location->mobile)): ?>
                  <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($transaction->location->mobile, false); ?>

                <?php endif; ?>
                <?php if(!empty($transaction->location->email)): ?>
                  <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($transaction->location->email, false); ?>

                <?php endif; ?>
              <?php endif; ?>
            </address>
          </div>
        <?php endif; ?>
      </div>
      <?php elseif(empty($single_payment_line->transaction_id)): ?>
      <div class="row">
        <?php if($single_payment_line->contact->type == 'supplier'): ?>
            <div class="col-6">
              <?php echo app('translator')->get('purchase.supplier'); ?>:
              <address>
                <strong><?php echo e($single_payment_line->contact->supplier_business_name, false); ?></strong>
                <?php echo e($single_payment_linetransaction->contact->name, false); ?>

                <?php echo $single_payment_line->contact->contact_address; ?>

                <?php if(!empty($single_payment_line->contact->tax_number)): ?>
                  <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($single_payment_line->contact->tax_number, false); ?>

                <?php endif; ?>
                <?php if(!empty($single_payment_line->contact->mobile)): ?>
                  <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($single_payment_line->contact->mobile, false); ?>

                <?php endif; ?>
                <?php if(!empty($single_payment_line->contact->email)): ?>
                  <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($single_payment_line->contact->email, false); ?>

                <?php endif; ?>
              </address>
            </div>
            <div class="col-6">
              <?php echo app('translator')->get('business.business'); ?>:
              <address>
                <strong><?php echo e($single_payment_line->business->name, false); ?></strong>
                
                <?php if(!empty($single_payment_line->business->tax_number_1)): ?>
                  <br><?php echo e($single_payment_line->business->tax_label_1, false); ?>: <?php echo e($single_payment_line->business->tax_number_1, false); ?>

                <?php endif; ?>

                <?php if(!empty($single_payment_line->business->tax_number_2)): ?>
                  <br><?php echo e($single_payment_line->business->tax_label_2, false); ?>: <?php echo e($single_payment_line->business->tax_number_2, false); ?>

                <?php endif; ?>
              </address>
            </div>
            <?php elseif($single_payment_line->contact->type == 'both'): ?>
            <div class="col-6">
              <?php if(!empty($single_payment_line->contact)): ?>
                <?php echo app('translator')->get('contact.barterer'); ?>:
                <address>
                  <strong><?php echo e($single_payment_line->contact->name ?? '', false); ?></strong>
                 
                  <?php echo $single_payment_line->contact->contact_address; ?>

                  <?php if(!empty($single_payment_line->contact->tax_number)): ?>
                    <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($single_payment_line->contact->tax_number, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($single_payment_line->contact->mobile)): ?>
                    <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($single_payment_line->contact->mobile, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($single_payment_line->contact->email)): ?>
                    <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($single_payment_line->contact->email, false); ?>

                  <?php endif; ?>
                </address>
              <?php else: ?>
              <?php endif; ?>
            </div>
            <div class="col-6">
              <?php echo app('translator')->get('business.business'); ?>:
              <address>
                <strong><?php echo e($single_payment_line->business->name, false); ?></strong>
                <?php if(!empty($single_payment_line->business->tax_number_1)): ?>
                  <br><?php echo e($single_payment_line->business->tax_label_1, false); ?>: <?php echo e($single_payment_line->business->tax_number_1, false); ?>

                <?php endif; ?>
  
                <?php if(!empty($single_payment_line->business->tax_number_2)): ?>
                  <br><?php echo e($single_payment_line->business->tax_label_2, false); ?>: <?php echo e($single_payment_line->business->tax_number_2, false); ?>

                <?php endif; ?>
              </address>
            </div>
        <?php else: ?>
          <div class="col-6">
            <?php if(!empty($single_payment_line->contact)): ?>
              <?php echo app('translator')->get('contact.customer'); ?>:
              <address>
                <strong><?php echo e($single_payment_line->contact->name ?? '', false); ?></strong>
               
                <?php echo $single_payment_line->contact->contact_address; ?>

                <?php if(!empty($single_payment_line->contact->tax_number)): ?>
                  <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($single_payment_line->contact->tax_number, false); ?>

                <?php endif; ?>
                <?php if(!empty($single_payment_line->contact->mobile)): ?>
                  <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($single_payment_line->contact->mobile, false); ?>

                <?php endif; ?>
                <?php if(!empty($single_payment_line->contact->email)): ?>
                  <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($single_payment_line->contact->email, false); ?>

                <?php endif; ?>
              </address>
            <?php else: ?>
            <?php endif; ?>
          </div>
          <div class="col-6">
            <?php echo app('translator')->get('business.business'); ?>:
            <address>
              <strong><?php echo e($single_payment_line->business->name, false); ?></strong>
              <?php if(!empty($single_payment_line->business->tax_number_1)): ?>
                <br><?php echo e($single_payment_line->business->tax_label_1, false); ?>: <?php echo e($single_payment_line->business->tax_number_1, false); ?>

              <?php endif; ?>

              <?php if(!empty($single_payment_line->business->tax_number_2)): ?>
                <br><?php echo e($single_payment_line->business->tax_label_2, false); ?>: <?php echo e($single_payment_line->business->tax_number_2, false); ?>

              <?php endif; ?>
            </address>
          </div>
        <?php endif; ?>
      </div>
      <?php endif; ?>

      <div class="row">
          <br>
          <div class="col-xs-6">
            <?php
              $amount = $single_payment_line->amount;
              if(in_array($transaction->contact->type, ['both', 'customer'])){
                if($transaction->type == 'opening_balance' && $transaction->sub_type == 'credit'){
                    $amount = -1*$amount;
                }
              }else{
                if($transaction->type == 'opening_balance' && $transaction->sub_type == 'debit'){
                    $amount = -1*$amount;
                }
              } 
            ?>
            <strong><?php echo app('translator')->get('purchase.amount'); ?> :</strong> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?><br>
            <strong><?php echo app('translator')->get('lang_v1.payment_method'); ?> :</strong>
            <?php echo e($payment_types[$single_payment_line->method] ?? '', false); ?><br>
            <?php if($single_payment_line->method == "card"): ?>
              <strong><?php echo app('translator')->get('lang_v1.card_holder_name'); ?> :</strong>
              <?php echo e($single_payment_line->card_holder_name, false); ?> <br>
              <strong><?php echo app('translator')->get('lang_v1.card_number'); ?> :</strong>
              <?php echo e($single_payment_line->card_number, false); ?> <br>
              <strong><?php echo app('translator')->get('lang_v1.card_transaction_number'); ?> :</strong>
              <?php echo e($single_payment_line->card_transaction_number, false); ?>

              <br>
            <?php elseif($single_payment_line->method == "cheque"): ?>
              <strong><?php echo app('translator')->get('lang_v1.cheque_number'); ?> :</strong>
              <?php echo e($single_payment_line->cheque_number, false); ?>

              <br>
            <?php elseif($single_payment_line->method == "bank_transfer"): ?>

            <?php elseif($single_payment_line->method == "custom_pay_1"): ?>

              <strong><?php echo app('translator')->get('lang_v1.transaction_number'); ?> :</strong>
              <?php echo e($single_payment_line->transaction_no, false); ?>

              <br>
            <?php elseif($single_payment_line->method == "custom_pay_2"): ?>

              <strong><?php echo app('translator')->get('lang_v1.transaction_number'); ?> :</strong>
              <?php echo e($single_payment_line->transaction_no, false); ?>

              <br>
            <?php elseif($single_payment_line->method == "custom_pay_3"): ?>

              <strong> <?php echo app('translator')->get('lang_v1.transaction_number'); ?>:</strong>
              <?php echo e($single_payment_line->transaction_no, false); ?>

              <br>
            <?php endif; ?>  
            <strong><?php echo app('translator')->get('purchase.payment_note'); ?> :</strong>
              <?php echo e($single_payment_line->note, false); ?>

          </div>
          <div class="col-6">
            <b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> 
              <?php if(!empty($single_payment_line->payment_ref_no)): ?>
                <?php echo e($single_payment_line->payment_ref_no, false); ?>

              <?php else: ?>
                --
              <?php endif; ?>
              <br/>
            <b><?php echo app('translator')->get('lang_v1.paid_on'); ?>:</b> <?php echo format_datetime_br($single_payment_line->paid_on); ?><br/>
            <b><?php echo app('translator')->get('lang_v1.prepared_by'); ?>:</b> <?php echo e($single_payment_line->created_user->user_full_name, false); ?><br/>
            <br>
            <?php if(!empty($single_payment_line->document_path)): ?>
              <a href="<?php echo e($single_payment_line->document_path, false); ?>" class="btn btn-success btn-sm no-print" download="<?php echo e($single_payment_line->document_name, false); ?>"><i class="fa fa-download" data-bs-toggle="tooltip" title="<?php echo e(__('purchase.download_document'), false); ?>"></i> <?php echo e(__('purchase.download_document'), false); ?></a>
            <?php endif; ?>
          </div>
          <?php if(in_array($transaction->type, ['purchase', 'purchase_return'])): ?>
            <?php if(!empty($common_settings['supplier_payment_footer'])): ?>
              <div class="col-12 text-center">
                  <?php echo $common_settings['supplier_payment_footer']; ?>

              </div>
            <?php endif; ?>
          <?php else: ?>
            <?php if(!empty($common_settings['customer_payment_footer'])): ?>
              <div class="col-12 text-center">
                  <?php echo $common_settings['customer_payment_footer']; ?>

              </div>
            <?php endif; ?>
          <?php endif; ?>
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
  </div>
</div>
