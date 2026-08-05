<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header no-print">
      <h4 class="modal-title no-print">
        <?php echo app('translator')->get( 'lang_v1.view_payment' ); ?>
        <?php if(!empty($single_payment_line->ref_no)): ?>
          ( <?php echo app('translator')->get('purchase.ref_no'); ?>: <?php echo e($single_payment_line->ref_no, false); ?> )
        <?php endif; ?>
      </h4>
      <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <div class="row text-center">
        <h3><?php echo e($single_payment_line->business->name, false); ?></h3>
        <p><?php echo $single_payment_line->business->business_address; ?></p>
        <?php if($single_payment_line->contact->type == 'supplier'): ?>
          <?php if(!empty($common_settings['supplier_payment_header'])): ?>
            <div class="col-12">
                <?php echo $common_settings['supplier_payment_header']; ?>

            </div>
          <?php endif; ?>
        <?php else: ?>
            <?php if(!empty($common_settings['customer_payment_header'])): ?>
                <div class="col-12">
                    <?php echo $common_settings['customer_payment_header']; ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
        <hr>
      </div>
      <h1 class="text-center">Advance Deposit Receipt</h1>
      <div class="row">
        <?php if($single_payment_line->contact->type == 'supplier'): ?>
            <div class="col-6">
              <?php echo app('translator')->get('purchase.supplier'); ?>:
              <address>
                <strong><?php echo e($single_payment_line->contact->supplier_business_name, false); ?></strong>
                <?php echo e($single_payment_line->contact->name, false); ?>

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
        <?php else: ?>
          <div class="col-6">
          <?php if($single_payment_line->contact->type == 'both'): ?>
              <?php echo app('translator')->get('contact.barterer'); ?>
          <?php else: ?>
            <?php echo e(ucwords($single_payment_line->contact->type), false); ?>

          <?php endif; ?> :
              <address>
                <strong><?php echo e($single_payment_line->contact->name ?? '', false); ?></strong>
               
                <?php echo $single_payment_line->contact->contact_address; ?>

                <?php if(!empty($single_payment_line->contact->tax_number)): ?>
                  <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($single_payment_line->contact->tax_number, false); ?>

                <?php endif; ?>
                <?php if(!empty($single_payment_line->contact->mobile)): ?>
                  <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($single_payment_line->contact->mobile, false); ?>

                <?php endif; ?>
                <?php if(!empty($transaction->contact->email)): ?>
                  <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($transaction->contact->email, false); ?>

                <?php endif; ?>
              </address>
          </div>
        <?php endif; ?>
        <div class="col-6">
        <b>Advance Deposit</b>
        <br/>
          <b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> 
            <?php if(!empty($single_payment_line->ref_no)): ?>
              <?php echo e($single_payment_line->ref_no, false); ?>

            <?php else: ?>
              --
            <?php endif; ?>
            <br/>
          <b><?php echo app('translator')->get('lang_v1.date'); ?>:</b> <?php echo format_datetime_br($single_payment_line->transaction_date); ?><br/>
          <br>
          <?php if(!empty($single_payment_line->document_path)): ?>
            <a href="<?php echo e($single_payment_line->document_path, false); ?>" class="btn btn-success btn-sm no-print" download="<?php echo e($single_payment_line->document_name, false); ?>"><i class="fa fa-download" data-bs-toggle="tooltip" title="<?php echo e(__('purchase.download_document'), false); ?>"></i> <?php echo e(__('purchase.download_document'), false); ?></a>
          <?php endif; ?>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <br>
          <div class="table-responsive">
          <table class="table table-striped table-th-skin">
            <thead class="bg-success">
              <tr>
                <th>#</th>
                <th>Type</th>
                <th>Ref No.</th>
                <th>Location</th>
                <th>Paid</th>
              </tr>
            </thead>
            <tbody>
              <?php $__empty_18 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
              
                <tr>
                  <td><?php echo e($loop->index+1, false); ?></td>
                  <td><?php echo e(ucwords(str_replace("_", " ", $tran->type)), false); ?></td>                
                  <td><?php echo e($tran->ref_no, false); ?></td>
                  <td><?php echo e($tran->purchase_location, false); ?></td>
                  <?php
                    $location = $tran->purchase_location;
                    if($single_payment_line->contact->type == 'supplier'){
                      if($tran->sub_type == 'credit'){
                        $amount = -1*$tran->amount;
                      }else{
                        $amount = $tran->amount;
                      }
                    }else if($single_payment_line->contact->type == 'customer'){
                      if($tran->sub_type == 'debit'){
                          $amount = -1*$tran->amount;
                      }else{
                        $amount = $tran->amount;
                      }
                    }else if($single_payment_line->contact->type == 'both'){
                      if($tran->sub_type == 'credit'){
                          $amount = -1*$tran->amount;
                      }else{
                        $amount = $tran->amount;
                      }
                    }
                    
                  ?>
                  <td><?php echo e(number_format($amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                </tr>  
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                <tr>
                  <td class="text-center" colspan="4">No Due Transactions</td>
                </tr>
              <?php endif; ?>
            </tbody>
            <tfoot class="table-th-skin">
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
              </tr>
            </tfoot>
          </table>
          </div>
        </div>
      </div>

      <div class="row">
          
          <div class="col-6">
            <strong><?php echo app('translator')->get('purchase.amount'); ?> :</strong>
            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?><br>
            <strong><?php echo app('translator')->get('purchase.payment_note'); ?> :</strong><?php echo e($single_payment_line->additional_notes, false); ?><br>
            <strong><?php echo app('translator')->get('sale.location'); ?> :</strong><?php echo e($location, false); ?><br>
            <strong><?php echo app('translator')->get('lang_v1.prepared_by'); ?> :</strong><?php echo e($single_payment_line->sales_person->user_full_name, false); ?>

          </div>
          <?php if($single_payment_line->contact->type == 'supplier'): ?>
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
