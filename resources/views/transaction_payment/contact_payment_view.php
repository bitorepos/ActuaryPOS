<?php
  $single_payment_direction_label = 'From';
  $contact_payment_direction_label = 'To';
  $payment_view_title = $single_payment_line->contact->type == 'supplier'
    ? __('lang_v1.pay_supplier')
    : __('lang_v1.pay_customer');
  $top_payment_line = $single_payment_line;
  $bottom_payment_line = $contact_payment_line ?? null;
  $top_payment_direction_label = $single_payment_direction_label;
  $bottom_payment_direction_label = $contact_payment_direction_label;

  if(!empty($contact_payment_line)){
    $single_payment_direction_label = $single_payment_line->id < $contact_payment_line->id ? 'From' : 'To';
    $contact_payment_direction_label = $contact_payment_line->id < $single_payment_line->id ? 'From' : 'To';

    if($single_payment_line->method == 'contact'){
      $ledger_discount_types = ['ledger_discount', 'ledger_discount2', 'ledger_discount3'];

      $contact_payment_direction_score = function ($contact_id, $contact_type) use ($transactions, $ledger_discount_types) {
        $score = 0;

        foreach($transactions as $transaction){
          if((int) $transaction->contact_id !== (int) $contact_id){
            continue;
          }

          $transaction_type = $transaction->type;
          $sub_type = $transaction->sub_type;

          if($contact_type == 'supplier'){
            if(
              $transaction_type == 'purchase_return'
              || ($transaction_type == 'opening_balance' && $sub_type == 'debit')
              || ($transaction_type == 'advance_deposit' && $sub_type == 'debit')
              || (in_array($transaction_type, $ledger_discount_types) && $sub_type == 'purchase_discount')
            ){
              $score++;
            }elseif(
              $transaction_type == 'purchase'
              || $transaction_type == 'sell_return'
              || ($transaction_type == 'opening_balance' && $sub_type == 'credit')
              || ($transaction_type == 'advance_deposit' && $sub_type == 'credit')
              || (in_array($transaction_type, $ledger_discount_types) && $sub_type == 'sell_discount')
            ){
              $score--;
            }
          }elseif($contact_type == 'customer'){
            if(
              $transaction_type == 'sell'
              || $transaction_type == 'purchase_return'
              || ($transaction_type == 'opening_balance' && $sub_type == 'debit')
              || ($transaction_type == 'advance_deposit' && $sub_type == 'debit')
              || (in_array($transaction_type, $ledger_discount_types) && $sub_type == 'purchase_discount')
            ){
              $score++;
            }elseif(
              $transaction_type == 'sell_return'
              || $transaction_type == 'purchase'
              || ($transaction_type == 'opening_balance' && $sub_type == 'credit')
              || ($transaction_type == 'advance_deposit' && $sub_type == 'credit')
              || (in_array($transaction_type, $ledger_discount_types) && $sub_type == 'sell_discount')
            ){
              $score--;
            }
          }elseif($contact_type == 'both'){
            if(
              $transaction_type == 'sell'
              || $transaction_type == 'purchase_return'
              || ($transaction_type == 'opening_balance' && $sub_type == 'debit')
              || ($transaction_type == 'advance_deposit' && $sub_type == 'debit')
              || (in_array($transaction_type, $ledger_discount_types) && $sub_type == 'purchase_discount')
            ){
              $score++;
            }elseif(
              $transaction_type == 'purchase'
              || $transaction_type == 'sell_return'
              || ($transaction_type == 'opening_balance' && $sub_type == 'credit')
              || ($transaction_type == 'advance_deposit' && $sub_type == 'credit')
              || (in_array($transaction_type, $ledger_discount_types) && $sub_type == 'sell_discount')
            ){
              $score--;
            }
          }
        }

        return $score;
      };

      $single_payment_score = $contact_payment_direction_score(
        $single_payment_line->contact->id,
        $single_payment_line->contact->type
      );
      $contact_payment_score = $contact_payment_direction_score(
        $contact_payment_line->contact->id,
        $contact_payment_line->contact->type
      );

      if($single_payment_score > 0 && $contact_payment_score <= 0){
        $single_payment_direction_label = 'From';
        $contact_payment_direction_label = 'To';
      }elseif($single_payment_score < 0 && $contact_payment_score >= 0){
        $single_payment_direction_label = 'To';
        $contact_payment_direction_label = 'From';
      }elseif(in_array($single_payment_line->contact->type, ['customer', 'both']) && $contact_payment_line->contact->type == 'supplier'){
        $single_payment_direction_label = 'From';
        $contact_payment_direction_label = 'To';
      }elseif($single_payment_line->contact->type == 'supplier' && in_array($contact_payment_line->contact->type, ['customer', 'both'])){
        $single_payment_direction_label = 'To';
        $contact_payment_direction_label = 'From';
      }

      $payment_view_title = 'Customer to Supplier Payment';
    }

    if($single_payment_direction_label == 'From'){
      $top_payment_line = $single_payment_line;
      $bottom_payment_line = $contact_payment_line;
      $top_payment_direction_label = $single_payment_direction_label;
      $bottom_payment_direction_label = $contact_payment_direction_label;
    }else{
      $top_payment_line = $contact_payment_line;
      $bottom_payment_line = $single_payment_line;
      $top_payment_direction_label = $contact_payment_direction_label;
      $bottom_payment_direction_label = $single_payment_direction_label;
    }
  }
?>
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header no-print">
      <h4 class="modal-title no-print">
        View <?php echo e($payment_view_title, false); ?>

        <?php if(!empty($single_payment_line->payment_ref_no)): ?>
          ( <?php echo app('translator')->get('purchase.ref_no'); ?>: <?php echo e($single_payment_line->payment_ref_no, false); ?> )
        <?php endif; ?>
      </h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <div class="row text-center">
        <?php if($single_payment_line->contact->type == 'supplier'): ?>
          <?php if(empty($common_settings['supplier_payment_hide_address'])): ?>
            <h3><?php echo e($single_payment_line->business->name, false); ?></h3>
            <p><?php echo $single_payment_line->business->business_address; ?></p>
          <?php endif; ?> 
          <?php if(!empty($common_settings['supplier_payment_header'])): ?>
            <div class="col-12">
                <?php echo $common_settings['supplier_payment_header']; ?>

            </div>
          <?php endif; ?>
        <?php else: ?>
          <?php if(empty($common_settings['customer_payment_hide_address'])): ?>
            <h3><?php echo e($single_payment_line->business->name, false); ?></h3>
            <p><?php echo $single_payment_line->business->business_address; ?></p>
          <?php endif; ?> 
          <?php if(!empty($common_settings['customer_payment_header'])): ?>
              <div class="col-xs-12">
                  <?php echo $common_settings['customer_payment_header']; ?>

              </div>
          <?php endif; ?>
        <?php endif; ?>
        <hr>
      </div>
      <h1 class="text-center"><?php echo e($payment_view_title, false); ?></h1>
      <div class="row">
        <?php if($top_payment_line->contact->type == 'supplier'): ?>
            <div class="col-xs-6">
              <?php if($single_payment_line->method == 'contact'): ?>
               <b> <?php echo e($top_payment_direction_label, false); ?></b>
              <?php endif; ?>
              <?php echo app('translator')->get('purchase.supplier'); ?>:
              <address>
                <strong><?php echo e($top_payment_line->contact->supplier_business_name, false); ?></strong>
                <?php if($top_payment_line->contact->name != $top_payment_line->contact->supplier_business_name): ?>
                  <?php echo e($top_payment_line->contact->name, false); ?>

                <?php endif; ?>
                <?php if(!empty($top_payment_line->contact->address_line_1)): ?>
                  <br><?php echo e($top_payment_line->contact->address_line_1, false); ?>

                <?php endif; ?>
                <?php if(!empty($top_payment_line->contact->address_line_2)): ?>
                  <br><?php echo e($top_payment_line->contact->address_line_2, false); ?>

                <?php endif; ?>
                <?php if(!empty($top_payment_line->contact->city)): ?>
                  <br><?php echo e($top_payment_line->contact->city, false); ?>

                <?php endif; ?>
                <?php if(!empty($top_payment_line->contact->state)): ?>
                  <?php echo e($top_payment_line->contact->state, false); ?>

                <?php endif; ?>
                <?php if(!empty($top_payment_line->contact->country)): ?>
                  <?php echo e($top_payment_line->contact->country, false); ?>

                <?php endif; ?>
                <?php if(!empty($top_payment_line->contact->tax_number)): ?>
                  <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($top_payment_line->contact->tax_number, false); ?>

                <?php endif; ?>
                <?php if(!empty($top_payment_line->contact->mobile)): ?>
                  <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($top_payment_line->contact->mobile, false); ?>

                <?php endif; ?>
                <?php if(!empty($top_payment_line->contact->email)): ?>
                  <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($top_payment_line->contact->email, false); ?>

                <?php endif; ?>
              </address>
            </div>
        <?php elseif($top_payment_line->contact->type == 'both'): ?>
            <div class="col-xs-6">
                <?php if($single_payment_line->method == 'contact'): ?>
                <b> <?php echo e($top_payment_direction_label, false); ?></b>
                <?php endif; ?>
                <?php echo app('translator')->get('contact.barterer'); ?>:
                <address>
                  <strong><?php echo e($top_payment_line->contact->name ?? '', false); ?></strong>
                  <?php if(!empty($top_payment_line->contact->address_line_1)): ?>
                    <br><?php echo e($top_payment_line->contact->address_line_1, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($top_payment_line->contact->address_line_2)): ?>
                    <br><?php echo e($top_payment_line->contact->address_line_2, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($top_payment_line->contact->city)): ?>
                    <br><?php echo e($top_payment_line->contact->city, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($top_payment_line->contact->state)): ?>
                    <?php echo e($top_payment_line->contact->state, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($top_payment_line->contact->country)): ?>
                    <?php echo e($top_payment_line->contact->country, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($top_payment_line->contact->tax_number)): ?>
                    <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($top_payment_line->contact->tax_number, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($top_payment_line->contact->mobile)): ?>
                    <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($top_payment_line->contact->mobile, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($top_payment_line->contact->email)): ?>
                    <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($top_payment_line->contact->email, false); ?>

                  <?php endif; ?>
                </address>
            </div>
          <?php else: ?>
          <div class="col-xs-6">
              <?php if($single_payment_line->method == 'contact'): ?>
               <b> <?php echo e($top_payment_direction_label, false); ?></b>
              <?php endif; ?>
              <?php echo app('translator')->get('contact.customer'); ?>:
              <address>
                <strong><?php echo e($top_payment_line->contact->name ?? '', false); ?></strong>
                <?php if(!empty($top_payment_line->contact->address_line_1)): ?>
                  <br><?php echo e($top_payment_line->contact->address_line_1, false); ?>

                <?php endif; ?>
                <?php if(!empty($top_payment_line->contact->address_line_2)): ?>
                  <br><?php echo e($top_payment_line->contact->address_line_2, false); ?>

                <?php endif; ?>
                <?php if(!empty($top_payment_line->contact->city)): ?>
                  <br><?php echo e($top_payment_line->contact->city, false); ?>

                <?php endif; ?>
                <?php if(!empty($top_payment_line->contact->state)): ?>
                  <?php echo e($top_payment_line->contact->state, false); ?>

                <?php endif; ?>
                <?php if(!empty($top_payment_line->contact->country)): ?>
                  <?php echo e($top_payment_line->contact->country, false); ?>

                <?php endif; ?>
                <?php if(!empty($top_payment_line->contact->tax_number)): ?>
                  <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($top_payment_line->contact->tax_number, false); ?>

                <?php endif; ?>
                <?php if(!empty($top_payment_line->contact->mobile)): ?>
                  <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($top_payment_line->contact->mobile, false); ?>

                <?php endif; ?>
                <?php if(!empty($top_payment_line->contact->email)): ?>
                  <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($top_payment_line->contact->email, false); ?>

                <?php endif; ?>
              </address>
          </div>
        <?php endif; ?>
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
              <?php
                $total_paid = 0;
                $count = 1;
              ?>
              <?php $__empty_18 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                <?php if($top_payment_line->contact->id != $tran->contact_id): ?>
                  <?php continue; ?>
                <?php endif; ?>
                <tr>
                  <td><?php echo e($count, false); ?></td>
                  <td><?php echo e(ucwords(str_replace("_", " ", $tran->type)), false); ?></td>
                  <?php if(!empty($tran->invoice_no)): ?>
                  <td><?php echo e($tran->invoice_no, false); ?></td>
                  <?php else: ?>
                  <td><?php echo e($tran->ref_no, false); ?></td>
                  <?php endif; ?>
                  <td><?php echo e($tran->purchase_location, false); ?></td>
                  <?php
                    $location_payment = $tran->payment_location;
                  ?>

                  <?php
                    $count++;
                    $amount = 0;
                    if($top_payment_line->contact->type == 'supplier'){
                      if(in_array($tran->type, ['purchase_return', 'ledger_discount', 'ledger_discount2', 'ledger_discount3'])
                        || ($tran->type == 'opening_balance' && $tran->sub_type == 'debit')
                        || ($tran->type == 'advance_deposit' && $tran->sub_type == 'debit' || $tran->is_return)
                      ){
                        $amount = -1*$tran->amount;
                      }else{
                        $amount = $tran->amount;
                      }
                    }else if($top_payment_line->contact->type == 'customer'){
                      if(in_array($tran->type, ['sell_return', 'ledger_discount', 'ledger_discount2', 'ledger_discount3'])
                        || ($tran->type == 'opening_balance' && $tran->sub_type == 'credit') || ($tran->final_total < $tran->total_paid_before)
                        || ($tran->type == 'advance_deposit' && $tran->sub_type == 'credit' || $tran->is_return)
                      ){
                        
                        if($tran->type == 'sell_return' && ($tran->final_total < $tran->total_paid_before)){
                          $amount = $tran->amount;
                        }else{
                          $amount = -1*$tran->amount;
                        }

                      }else{
                        $amount = $tran->amount;
                      }
                    }else if($top_payment_line->contact->type == 'both'){
                      if(in_array($tran->type, ['sell_return', 'purchase', 'ledger_discount', 'ledger_discount2', 'ledger_discount3'])
                        || ($tran->type == 'opening_balance' && $tran->sub_type == 'credit') || ($tran->final_total < $tran->total_paid_before)
                        || ($tran->type == 'advance_deposit' && $tran->sub_type == 'credit' || $tran->is_return)
                      ){
                        $amount = -1*$tran->amount;
                      }else{
                        $amount = $tran->amount;
                      }
                    }
                    $total_paid += $amount;
                  ?>
                  <td>
                    <?php echo e(number_format($amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                    <?php if($tran->final_total < $tran->total_paid_before || $tran->is_return): ?>
                    <br><small>Overpaid</small>
                    <?php endif; ?>
                  </td>
                </tr>  
                
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                <tr>
                  <td class="text-center" colspan="4">No Due Transactions</td>
                </tr>
              <?php endif; ?>
              <tr class="table-th-skin"> 
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_paid, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
              </tr>
            </tbody>
          </table>
          </div>
        </div>
      </div>

      <?php if($single_payment_line->method == 'contact'): ?>
      <div class="row">
        <?php if($bottom_payment_line->contact->type == 'supplier'): ?>
            <div class="col-6">
              <b> <?php echo e($bottom_payment_direction_label, false); ?></b>
              <?php echo app('translator')->get('purchase.supplier'); ?>:
              <address>
                <strong><?php echo e($bottom_payment_line->contact->supplier_business_name, false); ?></strong>
                <?php if($bottom_payment_line->contact->name != $bottom_payment_line->contact->supplier_business_name): ?>
                  <?php echo e($bottom_payment_line->contact->name, false); ?>

                <?php endif; ?>
                <?php if(!empty($bottom_payment_line->contact->address_line_1)): ?>
                  <br><?php echo e($bottom_payment_line->contact->address_line_1, false); ?>

                <?php endif; ?>
                <?php if(!empty($bottom_payment_line->contact->address_line_2)): ?>
                  <br><?php echo e($bottom_payment_line->contact->address_line_2, false); ?>

                <?php endif; ?>
                <?php if(!empty($bottom_payment_line->contact->city)): ?>
                  <br><?php echo e($bottom_payment_line->contact->city, false); ?>

                <?php endif; ?>
                <?php if(!empty($bottom_payment_line->contact->state)): ?>
                  <?php echo e($bottom_payment_line->contact->state, false); ?>

                <?php endif; ?>
                <?php if(!empty($bottom_payment_line->contact->country)): ?>
                  <?php echo e($bottom_payment_line->contact->country, false); ?>

                <?php endif; ?>
                <?php if(!empty($bottom_payment_line->contact->tax_number)): ?>
                  <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($bottom_payment_line->contact->tax_number, false); ?>

                <?php endif; ?>
                <?php if(!empty($bottom_payment_line->contact->mobile)): ?>
                  <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($bottom_payment_line->contact->mobile, false); ?>

                <?php endif; ?>
                <?php if(!empty($bottom_payment_line->contact->email)): ?>
                  <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($bottom_payment_line->contact->email, false); ?>

                <?php endif; ?>
              </address>
            </div>
        <?php elseif($bottom_payment_line->contact->type == 'both'): ?>
            <div class="col-6">
                <b> <?php echo e($bottom_payment_direction_label, false); ?></b>
                <?php echo app('translator')->get('contact.barterer'); ?>:
                <address>
                  <strong><?php echo e($bottom_payment_line->contact->name ?? '', false); ?></strong>
                  <?php if(!empty($bottom_payment_line->contact->address_line_1)): ?>
                    <br><?php echo e($bottom_payment_line->contact->address_line_1, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($bottom_payment_line->contact->address_line_2)): ?>
                    <br><?php echo e($bottom_payment_line->contact->address_line_2, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($bottom_payment_line->contact->city)): ?>
                    <br><?php echo e($bottom_payment_line->contact->city, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($bottom_payment_line->contact->state)): ?>
                    <?php echo e($bottom_payment_line->contact->state, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($bottom_payment_line->contact->country)): ?>
                    <?php echo e($bottom_payment_line->contact->country, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($bottom_payment_line->contact->tax_number)): ?>
                    <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($bottom_payment_line->contact->tax_number, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($bottom_payment_line->contact->mobile)): ?>
                    <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($bottom_payment_line->contact->mobile, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($bottom_payment_line->contact->email)): ?>
                    <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($bottom_payment_line->contact->email, false); ?>

                  <?php endif; ?>
                </address>
            </div>
          <?php else: ?>
          <div class="col-6">
              <b> <?php echo e($bottom_payment_direction_label, false); ?></b>
              <?php echo app('translator')->get('contact.customer'); ?>:
              <address>
                <strong><?php echo e($bottom_payment_line->contact->name ?? '', false); ?></strong>
                <?php if(!empty($bottom_payment_line->contact->address_line_1)): ?>
                  <br><?php echo e($bottom_payment_line->contact->address_line_1, false); ?>

                <?php endif; ?>
                <?php if(!empty($bottom_payment_line->contact->address_line_2)): ?>
                  <br><?php echo e($bottom_payment_line->contact->address_line_2, false); ?>

                <?php endif; ?>
                <?php if(!empty($bottom_payment_line->contact->city)): ?>
                  <br><?php echo e($bottom_payment_line->contact->city, false); ?>

                <?php endif; ?>
                <?php if(!empty($bottom_payment_line->contact->state)): ?>
                  <?php echo e($bottom_payment_line->contact->state, false); ?>

                <?php endif; ?>
                <?php if(!empty($bottom_payment_line->contact->country)): ?>
                  <?php echo e($bottom_payment_line->contact->country, false); ?>

                <?php endif; ?>
                <?php if(!empty($bottom_payment_line->contact->tax_number)): ?>
                  <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($bottom_payment_line->contact->tax_number, false); ?>

                <?php endif; ?>
                <?php if(!empty($bottom_payment_line->contact->mobile)): ?>
                  <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($bottom_payment_line->contact->mobile, false); ?>

                <?php endif; ?>
                <?php if(!empty($bottom_payment_line->contact->email)): ?>
                  <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($bottom_payment_line->contact->email, false); ?>

                <?php endif; ?>
              </address>
          </div>
        <?php endif; ?>
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
              <?php
                $total_paid = 0;
                $count = 1;
              ?>
              <?php $__empty_18 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                <?php if($bottom_payment_line->contact->id != $tran->contact_id): ?>
                  <?php continue; ?>
                <?php endif; ?>
                <tr>
                  <td><?php echo e($count, false); ?></td>
                  <td><?php echo e(ucwords(str_replace("_", " ", $tran->type)), false); ?></td>
                  <?php if(!empty($tran->invoice_no)): ?>
                  <td><?php echo e($tran->invoice_no, false); ?></td>
                  <?php else: ?>
                  <td><?php echo e($tran->ref_no, false); ?></td>
                  <?php endif; ?>
                  <td><?php echo e($tran->purchase_location, false); ?></td>
                  <?php
                    $location_payment = $tran->payment_location;
                  ?>

                  <?php
                    $count++;
                    $amount = 0;
                    if($tran->contact_type == 'supplier'){
                      if(in_array($tran->type, ['purchase_return', 'ledger_discount', 'ledger_discount2', 'ledger_discount3']) || ($tran->final_total < $tran->total_paid_before)
                        || ($tran->type == 'opening_balance' && $tran->sub_type == 'debit')
                        || ($tran->type == 'advance_deposit' && $tran->sub_type == 'debit')
                      ){
                        $amount = -1*$tran->amount;
                      }else{
                        $amount = $tran->amount;
                      }
                    }else if($tran->contact_type == 'customer'){
                      if(in_array($tran->type, ['sell_return', 'ledger_discount', 'ledger_discount2', 'ledger_discount3']) || ($tran->final_total < $tran->total_paid_before)
                        || ($tran->type == 'opening_balance' && $tran->sub_type == 'credit')
                        || ($tran->type == 'advance_deposit' && $tran->sub_type == 'credit')
                      ){
                        $amount = -1*$tran->amount;
                      }else{
                        $amount = $tran->amount;
                      }
                    }else if($tran->contact_type == 'both'){
                      if(in_array($tran->type, ['sell_return', 'purchase', 'ledger_discount', 'ledger_discount2', 'ledger_discount3']) || ($tran->final_total < $tran->total_paid_before)
                        || ($tran->type == 'opening_balance' && $tran->sub_type == 'credit')
                        || ($tran->type == 'advance_deposit' && $tran->sub_type == 'credit')
                      ){
                        $amount = -1*$tran->amount;
                      }else{
                        $amount = $tran->amount;
                      }
                    }
                    $total_paid += $amount;
                  ?>
                  <td>
                    <?php echo e(number_format($amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                    <?php if($tran->final_total < $tran->total_paid_before): ?>
                    <br><small>Overpaid</small>
                    <?php endif; ?>
                  </td>
                </tr>  
                
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                <tr>
                  <td class="text-center" colspan="4">No Due Transactions</td>
                </tr>
              <?php endif; ?>
              <tr class="table-th-skin"> 
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_paid, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
              </tr>
            </tbody>
          </table>
          </div>
        </div>
      </div>
      <?php endif; ?>

      <div class="row">
          
          <div class="col-6">
            <strong><?php echo app('translator')->get('purchase.amount'); ?> :</strong>
            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_paid, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?><br>
            <strong><?php echo app('translator')->get('lang_v1.payment_method'); ?> :</strong>
            <?php echo e($payment_types[$single_payment_line->method] ?? '', false); ?><br>
            <?php if($single_payment_line->method == "card" || $single_payment_line->sub_method == "card"): ?>
              <strong><?php echo app('translator')->get('lang_v1.card_holder_name'); ?> :</strong>
              <?php echo e($single_payment_line->card_holder_name, false); ?> <br>
              <strong><?php echo app('translator')->get('lang_v1.card_number'); ?> :</strong>
              <?php echo e($single_payment_line->card_number, false); ?> <br>
              <strong><?php echo app('translator')->get('lang_v1.card_transaction_number'); ?> :</strong>
              <?php echo e($single_payment_line->card_transaction_number, false); ?>

              
            <?php elseif($single_payment_line->method == "cheque" || $single_payment_line->sub_method == "cheque"): ?>
              <strong><?php echo app('translator')->get('lang_v1.cheque_number'); ?> :</strong>
              <?php echo e($single_payment_line->cheque_number, false); ?><br>
              <strong><?php echo app('translator')->get('lang_v1.clearance_date'); ?> :</strong>
              <?php echo format_datetime_br($single_payment_line->clearance_date); ?><br>
              
            <?php elseif($single_payment_line->method == "bank_transfer" || $single_payment_line->sub_method == "bank_transfer"): ?>
              <strong><?php echo app('translator')->get('lang_v1.bank_account_number'); ?> :</strong>
                <?php echo e($single_payment_line->bank_account_number, false); ?><br>
            <?php elseif($single_payment_line->method == "custom_pay_1"): ?>

              <strong><?php echo app('translator')->get('lang_v1.transaction_number'); ?> :</strong>
              <?php echo e($single_payment_line->transaction_no, false); ?>

            <?php elseif($single_payment_line->method == "custom_pay_2"): ?>

              <strong><?php echo app('translator')->get('lang_v1.transaction_number'); ?> :</strong>
              <?php echo e($single_payment_line->transaction_no, false); ?>

            <?php elseif($single_payment_line->method == "custom_pay_3"): ?>

              <strong> <?php echo app('translator')->get('lang_v1.transaction_number'); ?>:</strong>
              <?php echo e($single_payment_line->transaction_no, false); ?>

            <?php endif; ?>
            <strong><?php echo app('translator')->get('purchase.payment_note'); ?> :</strong>
              <?php echo e($single_payment_line->note, false); ?><br>
            <strong><?php echo app('translator')->get('sale.location'); ?> :</strong>
            <?php echo e($location_payment, false); ?>

              
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
      <button type="button" class="btn btn-primary no-print print_cp_view" 
        aria-label="Print">
        <i class="fa fa-print"></i> <?php echo app('translator')->get( 'messages.print' ); ?>
      </button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>
  </div>
</div>
