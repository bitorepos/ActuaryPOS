<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\TransactionPaymentController::class, 'postPayContactDue']), 'method' => 'post', 'id' => 'pay_contact_due_form', 'files' => true ]); ?>


    <?php echo Form::hidden("contact_id", $contact_details->contact_id); ?>

    <?php echo Form::hidden("contact_type", $contact_details->contact_type, ['id'=>'due_contact_type']); ?>

    <?php echo Form::hidden("due_payment_type", $due_payment_type); ?>

    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.contact_payment' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   
    </div>

    <?php
    // Phase 64: prefer controller-supplied per-branch overlay; session is the fallback.
    $pos_settings = isset($pos_settings) && ! empty($pos_settings)
        ? $pos_settings
        : (!empty(session()->get('business.pos_settings')) ? json_decode(session()->get('business.pos_settings'), true) : []);

    $enable_cash_denomination_for_payment_methods = !empty($pos_settings['enable_cash_denomination_for_payment_methods']) ? $pos_settings['enable_cash_denomination_for_payment_methods'] : [];
    ?>

    <div class="modal-body">
      <div class="row">

        
        <?php if($due_payment_type == 'purchase'): ?>
        <?php if(($contact_details->total_purchase -  $contact_details->total_paid) != '0.00' || $ob_due != '0.00' || $payment_line->amount != '0'): ?>
          <input type="hidden" value="1" class="null_balance">
        <?php else: ?>
          <input type="hidden" value="0" class="null_balance">
        <?php endif; ?>
        <div class="col-md-6">
          <div class="p-3 border rounded bg-light">
            <strong><?php echo app('translator')->get('purchase.supplier'); ?>: </strong><?php echo e($contact_details->name, false); ?><br>
            <strong><?php echo app('translator')->get('business.business'); ?>: </strong><?php echo e($contact_details->supplier_business_name, false); ?><br><br>
          </div>
        </div>
        <div class="col-md-6">
        
          <div class="p-3 border rounded bg-light">
            <strong><?php echo app('translator')->get('report.total_purchase'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($contact_details->total_purchase, false); ?></span><br>
            <strong><?php echo app('translator')->get('contact.total_paid'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($contact_details->total_paid, false); ?></span><br>
            <strong><?php echo app('translator')->get('contact.total_purchase_due'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($contact_details->total_purchase - $contact_details->total_paid, false); ?></span><br>
             <?php if(!empty($contact_details->opening_balance) || $contact_details->opening_balance != '0.00'): ?>
                  <strong><?php echo app('translator')->get('lang_v1.opening_balance'); ?>: </strong>
                  <span class="display_currency" data-currency_symbol="true">
                  <?php echo e($contact_details->opening_balance, false); ?></span><br>
                  <strong><?php echo app('translator')->get('lang_v1.opening_balance_due'); ?>: </strong>
                  <span class="display_currency" data-currency_symbol="true">
                  <?php echo e($ob_due, false); ?></span>
              <?php endif; ?>
          </div>
        </div>
        <?php elseif($due_payment_type == 'purchase_return'): ?>
         <?php if(($contact_details->total_purchase_return -  $contact_details->total_return_paid) != '0.00' || $payment_line->amount != '0'): ?>
          <input type="hidden" value="1" class="null_balance">
        <?php else: ?>
          <input type="hidden" value="0" class="null_balance">
        <?php endif; ?>
        <div class="col-md-6">
          <div class="p-3 border rounded bg-light">
            <strong><?php echo app('translator')->get('purchase.supplier'); ?>: </strong><?php echo e($contact_details->name, false); ?><br>
            <strong><?php echo app('translator')->get('business.business'); ?>: </strong><?php echo e($contact_details->supplier_business_name, false); ?><br><br>
          </div>
        </div>
        <div class="col-md-6">
          <div class="p-3 border rounded bg-light">
            <strong><?php echo app('translator')->get('lang_v1.total_purchase_return'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($contact_details->total_purchase_return, false); ?></span><br>
            <strong><?php echo app('translator')->get('lang_v1.total_purchase_return_paid'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($contact_details->total_return_paid, false); ?></span><br>
            <strong><?php echo app('translator')->get('lang_v1.total_purchase_return_due'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($contact_details->total_purchase_return - $contact_details->total_return_paid, false); ?></span>
          </div>
          


        </div>
        <?php elseif(in_array($due_payment_type, ['sell'])): ?>
          <?php if($contact_details->contact_type == 'customer'): ?>
          <?php if(($contact_details->total_invoice -  $contact_details->total_paid) != '0.00' || $ob_due != '0.00' || $payment_line->amount != '0'): ?>
              <input type="hidden" value="1" class="null_balance">
            <?php else: ?>
              <input type="hidden" value="0" class="null_balance">
            <?php endif; ?>
            <div class="col-md-6">
              <div class="p-3 border rounded bg-light">
                <strong><?php echo app('translator')->get('sale.customer_name'); ?>: </strong><?php echo e($contact_details->name, false); ?><br>
                <strong><?php echo app('translator')->get('business.business_name'); ?>: </strong><?php echo e($contact_details->supplier_business_name, false); ?>

                <br><br>
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 border rounded bg-light">
                <strong><?php echo app('translator')->get('report.total_sell'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($contact_details->total_invoice, false); ?></span><br>
                <strong><?php echo app('translator')->get('contact.total_paid'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($contact_details->total_paid, false); ?></span><br>
                <strong><?php echo app('translator')->get('contact.total_sale_due'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($contact_details->total_invoice - $contact_details->total_paid, false); ?></span><br>
                <?php if(!empty($contact_details->opening_balance) || $contact_details->opening_balance != '0.00'): ?>
                    <strong><?php echo app('translator')->get('lang_v1.opening_balance'); ?>: </strong>
                    <span class="display_currency" data-currency_symbol="true">
                    <?php echo e($contact_details->opening_balance, false); ?></span><br>
                    <strong><?php echo app('translator')->get('lang_v1.opening_balance_due'); ?>: </strong>
                    <span class="display_currency" data-currency_symbol="true">
                    <?php echo e($ob_due, false); ?></span>
                <?php endif; ?>
              </div>
            </div>
            
            <?php elseif($contact_details->contact_type == 'both'): ?>
            
              <?php if(($contact_details->total_invoice -  $contact_details->total_paid) != '0.00' || $ob_due != '0.00' || $payment_line->amount != '0'): ?>
                <input type="hidden" value="1" class="null_balance">
              <?php else: ?>
                <input type="hidden" value="0" class="null_balance">
              <?php endif; ?>
              <div class="col-md-6">
                <div class="p-3 border rounded bg-light">
                  <strong><?php echo app('translator')->get('contact.barterer'); ?>: </strong><?php echo e($contact_details->name, false); ?><br>
                  <strong><?php echo app('translator')->get('business.business_name'); ?>: </strong><?php echo e($contact_details->supplier_business_name, false); ?>

                  <br><br>
                </div>
              </div>
              <div class="col-md-6">
                <div class="p-3 border rounded bg-light">
                  
                  <strong><?php echo app('translator')->get('report.total_sell'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($contact_details->total_invoice, false); ?></span><br>
                  <strong><?php echo app('translator')->get('contact.total_paid'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($contact_details->total_paid, false); ?></span><br>
                  <strong><?php echo app('translator')->get('contact.total_sale_due'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($contact_details->total_invoice - $contact_details->total_paid, false); ?></span><br>
                  <?php if(!empty($contact_details->opening_balance) || $contact_details->opening_balance != '0.00'): ?>
                      <strong><?php echo app('translator')->get('lang_v1.opening_balance'); ?>: </strong>
                      <span class="display_currency" data-currency_symbol="true">
                      <?php echo e($contact_details->opening_balance, false); ?></span><br>
                      <strong><?php echo app('translator')->get('lang_v1.opening_balance_due'); ?>: </strong>
                      <span class="display_currency" data-currency_symbol="true">
                      <?php echo e($ob_due, false); ?></span>
                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>
        <?php elseif(in_array($due_payment_type, ['sell_return'])): ?>
          <?php if(($contact_details->total_sell_return -  $contact_details->total_return_paid) != '0.00' || $payment_line->amount != '0'): ?>
            <input type="hidden" value="1" class="null_balance">
          <?php else: ?>
            <input type="hidden" value="0" class="null_balance">
          <?php endif; ?>
          <div class="col-md-6">
            <div class="p-3 border rounded bg-light">
              <strong><?php echo app('translator')->get('sale.customer_name'); ?>: </strong><?php echo e($contact_details->name, false); ?><br>
                <br><br>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-3 border rounded bg-light">
              <strong><?php echo app('translator')->get('lang_v1.total_sell_return'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($contact_details->total_sell_return, false); ?></span><br>
              <strong><?php echo app('translator')->get('lang_v1.total_sell_return_paid'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($contact_details->total_return_paid, false); ?></span><br>
              <strong><?php echo app('translator')->get('lang_v1.total_sell_return_due'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($contact_details->total_sell_return - $contact_details->total_return_paid, false); ?></span>
            </div>
          </div>
        <?php endif; ?>
        
      </div>
      <div class="row payment_row">
        <?php if(config('constants.show_payment_type_on_contact_pay') && ($due_payment_type == 'purchase' || $due_payment_type == 'sell')): ?>
            <?php
                $reverse_payment_types = [];

                if($due_payment_type == 'purchase') {
                    $reverse_payment_types = [
                        0 => __('lang_v1.pay_to_supplier'),
                        1 => __('lang_v1.receive_from_supplier')
                    ];
                } else if($due_payment_type == 'sell') {
                    $reverse_payment_types = [
                        0 => __('lang_v1.receive_from_customer'),
                        1 => __('lang_v1.pay_to_customer')
                    ];
                }
            ?>
            <div class="col-md-4">
                <div class="form-group mb-2">
                    <?php echo Form::label("is_reverse" , __('lang_v1.payment_type') . ':'); ?>

                    <?php echo Form::select("is_reverse", $reverse_payment_types, 0, ['class' => 'form-select select2', 'style' => 'width:80%;']); ?>

                </div>
            </div>
        <?php endif; ?>

        
        <?php if(!empty($voucher_types)): ?>
          <div class="col-md-4">
            <div class="form-group mb-2">
              <?php echo Form::label("voucher_type" , __('lang_v1.voucher_type') . ':'); ?>

                <?php echo Form::select("voucher_type", $voucher_types, array_key_last($voucher_types), ['class' => 'form-control select2', 'style' => 'width:100%;', !empty($voucher_type_required) ? 'required' : '']); ?>

            </div>
          </div>
        <?php endif; ?>
        <div class="col-md-6">
          <div class="form-group mb-2">
            <?php echo Form::label("business_location" , 'Location' . ':*'); ?>

            <div class="input-group">
              <span class="input-group-text">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              <?php echo Form::select("business_location", $business_locations, $default_location, ['class' => 'form-control select2 business_locations_dropdown', 'style' => 'width:80%;'], $bl_attributes,); ?>

            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-2">
            <?php
              $is_user_required_on_payments = !empty($pos_settings['is_user_required_on_payments']);
              $payment_user_attributes = ['class' => 'form-control select2', 'style' => 'width:100%;', 'placeholder' => __('messages.please_select')];
              if($is_user_required_on_payments) {
                $payment_user_attributes['required'] = true;
              }
            ?>
            <?php echo Form::label("user_id" , __('report.user') . ($is_user_required_on_payments ? ':*' : ':')); ?>

            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-user"></i>
              </span>
              <?php echo Form::select("user_id", $users, null, $payment_user_attributes); ?>

            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group mb-2">
            <?php echo Form::label("method" , __('purchase.payment_method') . ':*'); ?>

            <div class="input-group">
              <span class="input-group-text">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              <?php echo Form::select("method", $payment_types, $payment_line->method, ['class' => 'form-select select2 payment_types_dropdown', 'required', 'style' => 'width:80%;']); ?>

            </div>
          </div>
        </div>
        <?php
          $date_readonly = !empty($user_settings['disable_contact_payment_date']) ? 'disabled' : '';
        ?>
        <div class="col-md-4">
          <div class="form-group mb-2">
            <?php echo Form::label("paid_on" , __('lang_v1.paid_on') . ':*'); ?>

            <div class="input-group">
              <span class="input-group-text">
                <i class="fa fa-calendar"></i>
              </span>
              <?php echo Form::text('paid_on', $default_datetime, ['class' => 'form-control', 'readonly', $date_readonly, 'required']); ?>

            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group mb-2">
            <?php echo Form::label("amount" , __('sale.amount') . ':*'); ?>

            <div class="input-group">
              <span class="input-group-text">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              <?php if(in_array($due_payment_type, ['sell_return', 'purchase_return'])): ?>
                <?php echo Form::text("amount", empty($pos_settings['set_payment_modal_amount_zero']) ? number_format($payment_line->amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number payment_amount', 'required', 'placeholder' => __('sale.amount'), 'data-rule-max-value' => $payment_line->amount, 'data-msg-max-value' => __('lang_v1.max_amount_to_be_paid_is', ['amount' => $amount_formated])]); ?>

                <?php else: ?>
                <?php echo Form::text("amount", empty($pos_settings['set_payment_modal_amount_zero']) ? number_format($payment_line->amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number payment_amount', 'required', 'placeholder' => __('sale.amount'),]); ?>

              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php
            $sub_method = !empty($payment_line->sub_method) ? $payment_line->sub_method : 'cash';
        ?>
        <div class="col-md-12 mb-10">
          
          <label class="radio-inline me-2">
              <input type="radio" name="sub_method" id="payment_method_radio" value="cash" <?php echo e(($sub_method == 'cash') ? 'checked' : '', false); ?>>
              <?php echo app('translator')->get('lang_v1.cash'); ?>
          </label>
          
          
          <label class="radio-inline me-2">
            <input type="radio" name="sub_method" id="payment_method_radio" value="card" <?php echo e(($sub_method == 'card') ? 'checked' : '', false); ?>>
            <?php echo app('translator')->get('lang_v1.card'); ?>
          </label>
          
          
          <label class="radio-inline me-2">
            <input type="radio" name="sub_method" id="payment_method_radio" value="cheque" <?php echo e(($sub_method == 'cheque') ? 'checked' : '', false); ?>>
            <?php echo app('translator')->get('lang_v1.cheque'); ?>
          </label>
          
          
          <label class="radio-inline me-2">
            <input type="radio" name="sub_method" id="payment_method_radio" value="bank_transfer" <?php echo e(($sub_method == 'bank_transfer') ? 'checked' : '', false); ?>>
            <?php echo app('translator')->get('lang_v1.bank_transfer'); ?>
          </label>
          
        </div>

        <?php if(!empty($pos_settings['enable_cash_denomination_on']) && $pos_settings['enable_cash_denomination_on'] == 'all_screens'): ?>
            <input type="hidden" class="enable_cash_denomination_for_payment_methods" value="<?php echo e(json_encode($pos_settings['enable_cash_denomination_for_payment_methods']), false); ?>">
            <div class="clearfix"></div>
            <div class="col-md-12 cash_denomination_div <?php if(!in_array($payment_line->method, $enable_cash_denomination_for_payment_methods)): ?> hide <?php endif; ?>">
                <hr>
                <strong><?php echo app('translator')->get( 'lang_v1.cash_denominations' ); ?></strong>
                  <?php if(!empty($pos_settings['cash_denominations'])): ?>
                    <table class="table table-slim">
                      <thead>
                        <tr>
                          <th width="20%" class="text-right"><?php echo app('translator')->get('lang_v1.denomination'); ?></th>
                          <th width="20%">&nbsp;</th>
                          <th width="20%" class="text-center"><?php echo app('translator')->get('lang_v1.count'); ?></th>
                          <th width="20%">&nbsp;</th>
                          <th width="20%" class="text-left"><?php echo app('translator')->get('sale.subtotal'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__currentLoopData = explode(',', $pos_settings['cash_denominations']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dnm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td class="text-right"><?php echo e($dnm, false); ?></td>
                          <td class="text-center" >X</td>
                          <td><?php echo Form::number("denominations[$dnm]", null, ['class' => 'form-control cash_denomination input-sm', 'min' => 0, 'data-denomination' => $dnm, 'style' => 'width: 100px; margin:auto;' ]); ?></td>
                          <td class="text-center">=</td>
                          <td class="text-left">
                            <span class="denomination_subtotal">0</span>
                          </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="4" class="text-center"><?php echo app('translator')->get('sale.total'); ?></th>
                          <td>
                            <span class="denomination_total">0</span>
                            <input type="hidden" class="denomination_total_amount" value="0">
                            <input type="hidden" class="is_strict" value="<?php echo e($pos_settings['cash_denomination_strict_check'] ?? '', false); ?>">
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                    <p class="cash_denomination_error error hide"><?php echo app('translator')->get('lang_v1.cash_denomination_error'); ?></p>
                  <?php else: ?>
                    <p class="help-block"><?php echo app('translator')->get('lang_v1.denomination_add_help_text'); ?></p>
                  <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="clearfix"></div>
        <div class="col-md-12">
          <div class="row align-items-end">
            <div class="col-md-4" id="outstanding_location_filter">
              <div class="form-group mb-2">
                <?php echo Form::label("business_location" , 'Outstanding Invoices by' . ':'); ?>

                <?php echo Form::select('oustanding_location_id', $business_locations, $default_location, [
                    'class' => 'form-control select2 oustanding_location_id',
                    'style' => 'width:100%',
                    'placeholder' => __('lang_v1.all'),
                    'disabled' => count($location_ids) == 1
                ]); ?>

              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group mb-2">
                <?php echo Form::label("from_date" , __('lang_v1.from') . ':'); ?>

                <?php echo Form::text('from_date', null, ['class' => 'form-control', 'readonly', 'placeholder' => 'All']); ?>

              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group mb-2">
                <?php echo Form::label("to_date" , __('lang_v1.to') . ':'); ?>

                <?php echo Form::text('to_date', null, ['class' => 'form-control', 'readonly', 'placeholder' => 'All']); ?>

              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-12" id="contact_type_due_location">
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
                    <?php if($contact_details->contact_type == 'supplier'): ?>
                      <?php if(in_array($dt->type, ['purchase_return'])): ?>
                        <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif($dt->type == 'opening_balance' && $dt->sub_type == 'debit'): ?>
                        <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif($dt->type == 'advance_deposit' && $dt->sub_type == 'debit'): ?>
                        <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif(in_array($dt->type, ['ledger_discount','ledger_discount2','ledger_discount3']) && $dt->sub_type == 'purchase_discount'): ?>
                        <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php else: ?>
                        <?php echo e(number_format($dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php endif; ?>

                    <?php elseif($contact_details->contact_type == 'customer'): ?>
                      <?php if(in_array($dt->type, ['sell_return'])): ?>
                        <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif($dt->type == 'opening_balance' && $dt->sub_type == 'credit'): ?>
                        <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif($dt->type == 'advance_deposit' && $dt->sub_type == 'credit'): ?>
                        <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif(in_array($dt->type, ['ledger_discount','ledger_discount2','ledger_discount3']) && $dt->sub_type == 'sell_discount'): ?>
                        <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php else: ?>
                        <?php echo e(number_format($dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php endif; ?>

                    <?php elseif($contact_details->contact_type == 'both'): ?>
                      <?php if(in_array($dt->type, ['sell_return', 'purchase'])): ?>
                        <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif($dt->type == 'opening_balance' && $dt->sub_type == 'credit'): ?>
                        <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif($dt->type == 'advance_deposit' && $dt->sub_type == 'credit'): ?>
                        <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif(in_array($dt->type, ['ledger_discount','ledger_discount2','ledger_discount3']) && $dt->sub_type == 'sell_discount'): ?>
                        <?php echo e(number_format(-1*$dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php else: ?>
                        <?php echo e(number_format($dt->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php endif; ?>
                    <?php endif; ?>
                  </td>
                  <td>
                    
                    <?php if($contact_details->contact_type == 'supplier'): ?>
                      <?php if(in_array($dt->type, ['purchase_return'])): ?>
                        <?php echo e(number_format(-1*$dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif($dt->type == 'opening_balance' && $dt->sub_type == 'debit'): ?>
                        <?php echo e(number_format(-1*$dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif($dt->type == 'advance_deposit' && $dt->sub_type == 'debit'): ?>
                        <?php echo e(number_format(-1*$dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif(in_array($dt->type, ['ledger_discount','ledger_discount2','ledger_discount3']) && $dt->sub_type == 'purchase_discount'): ?>
                        <?php echo e(number_format(-1*$dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php else: ?>
                        <?php echo e(number_format($dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php endif; ?>

                    <?php elseif($contact_details->contact_type == 'customer'): ?>
                      <?php if(in_array($dt->type, ['sell_return'])): ?>
                        <?php echo e(number_format(-1*$dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif($dt->type == 'opening_balance' && $dt->sub_type == 'credit'): ?>
                        <?php echo e(number_format(-1*$dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif($dt->type == 'advance_deposit' && $dt->sub_type == 'credit'): ?>
                        <?php echo e(number_format(-1*$dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif(in_array($dt->type, ['ledger_discount','ledger_discount2','ledger_discount3']) && $dt->sub_type == 'sell_discount'): ?>
                        <?php echo e(number_format(-1*$dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php else: ?>
                        <?php echo e(number_format($dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php endif; ?>

                    <?php elseif($contact_details->contact_type == 'both'): ?>
                      <?php if(in_array($dt->type, ['sell_return', 'purchase'])): ?>
                        <?php echo e(number_format(-1*$dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif($dt->type == 'opening_balance' && $dt->sub_type == 'credit'): ?>
                        <?php echo e(number_format(-1*$dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif($dt->type == 'advance_deposit' && $dt->sub_type == 'credit'): ?>
                        <?php echo e(number_format(-1*$dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php elseif(in_array($dt->type, ['ledger_discount','ledger_discount2','ledger_discount3']) && $dt->sub_type == 'sell_discount'): ?>
                        <?php echo e(number_format(-1*$dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php else: ?>
                        <?php echo e(number_format($dt->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                      <?php endif; ?>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if($dt->type != 'advance'): ?>
                    <?php
                      $due_value = $dt->final_total - $dt->total_paid;
                      if($contact_details->contact_type == 'supplier'){

                        if(in_array($dt->type, ['purchase_return'])){
                          $due_value = -1*$due_value;
                        }else if($dt->type == 'opening_balance' && $dt->sub_type == 'debit'){
                          $due_value = -1*$due_value;
                        }else if($dt->type == 'advance_deposit' && $dt->sub_type == 'debit'){
                          $due_value = -1*$due_value;
                        }else if(in_array($dt->type, ['ledger_discount','ledger_discount2','ledger_discount3']) && $dt->sub_type == 'purchase_discount'){
                          $due_value = -1*$due_value;
                        }
                      
                      }else if($contact_details->contact_type == 'customer'){

                        if(in_array($dt->type, ['sell_return'])){
                          $due_value = -1*$due_value;
                        }else if($dt->type == 'opening_balance' && $dt->sub_type == 'credit'){
                          $due_value = -1*$due_value;
                        }else if($dt->type == 'advance_deposit' && $dt->sub_type == 'credit'){
                          $due_value = -1*$due_value;
                        }else if(in_array($dt->type, ['ledger_discount','ledger_discount2','ledger_discount3']) && $dt->sub_type == 'sell_discount'){
                          $due_value = -1*$due_value;
                        }
                      
                      }else if($contact_details->contact_type == 'both'){
                        if(in_array($dt->type, ['sell_return','purchase'])){
                          $due_value = -1*$due_value;
                        }else if($dt->type == 'opening_balance' && $dt->sub_type == 'credit'){
                          $due_value = -1*$due_value;
                        }else if($dt->type == 'advance_deposit' && $dt->sub_type == 'credit'){
                          $due_value = -1*$due_value;
                        }else if(in_array($dt->type, ['ledger_discount','ledger_discount2','ledger_discount3']) && $dt->sub_type == 'sell_discount'){
                          $due_value = -1*$due_value;
                        }
                      }
                    ?>

                    <input type="text" class="form-control input-sm due_invoices" name="due_invoice[<?php echo e($dt->id, false); ?>]" data-final_total="<?php echo e($dt->final_total, false); ?>" data-total_paid="<?php echo e($dt->total_paid, false); ?>"  value="<?php echo e(number_format($due_value, session('business.currency_precision', 2), session('currency')['decimal_separator'], ''), false); ?>" data-invoice-type="<?php echo e($dt->type, false); ?>" data-invoice-sub-type="<?php echo e($dt->sub_type, false); ?>"
                      
                      
                      >
                    <?php endif; ?>
                  </td>
                </tr>
                <?php
                    if($contact_details->contact_type == 'supplier'){
                      if(in_array($dt->type, ['purchase_return'])){
                        $invoice_total_amount -= $dt->final_total;
                        $invoice_total_paid += $dt->total_paid;
                        $invoice_total_due += $due_value;
                      }else if(($dt->type == 'opening_balance' && $dt->sub_type == 'debit') || ($dt->type == 'advance_deposit' && $dt->sub_type == 'debit') || (in_array($dt->type, ['ledger_discount','ledger_discount2','ledger_discount3']) && $dt->sub_type == 'purchase_discount')){
                        $invoice_total_amount -= $dt->final_total;
                        $invoice_total_paid += $dt->total_paid;
                        $invoice_total_due += $due_value;
                      }else{
                        $invoice_total_amount += $dt->final_total;
                        $invoice_total_paid += $dt->total_paid;
                        $invoice_total_due += $due_value;
                      }
                    }else if($contact_details->contact_type == 'customer'){
                      if(in_array($dt->type, ['sell_return'])){
                        $invoice_total_amount -= $dt->final_total;
                        $invoice_total_paid += $dt->total_paid;
                        $invoice_total_due += $due_value;
                      }else if(($dt->type == 'opening_balance' && $dt->sub_type == 'credit') || ($dt->type == 'advance_deposit' && $dt->sub_type == 'credit') || (in_array($dt->type, ['ledger_discount','ledger_discount2','ledger_discount3']) && $dt->sub_type == 'sell_discount')){
                        $invoice_total_amount -= $dt->final_total;
                        $invoice_total_paid += $dt->total_paid;
                        $invoice_total_due += $due_value;
                      }else{
                        $invoice_total_amount += $dt->final_total;
                        $invoice_total_paid += $dt->total_paid;
                        $invoice_total_due += $due_value;
                      }
                    }else if($contact_details->contact_type == 'both'){
                      if(in_array($dt->type, ['sell_return', 'purchase'])){
                        $invoice_total_amount -= $dt->final_total;
                        $invoice_total_paid -= $dt->total_paid;
                        $invoice_total_due += $due_value;
                      }else if(($dt->type == 'opening_balance' && $dt->sub_type == 'credit') || ($dt->type == 'advance_deposit' && $dt->sub_type == 'credit') || (in_array($dt->type, ['ledger_discount','ledger_discount2','ledger_discount3']) && $dt->sub_type == 'sell_discount')){
                        $invoice_total_amount -= $dt->final_total;
                        $invoice_total_paid += $dt->total_paid;
                        $invoice_total_due += $due_value;
                      }else{
                        $invoice_total_amount += $dt->final_total;
                        $invoice_total_paid += $dt->total_paid;
                        $invoice_total_due += $due_value;
                      }
                    }
                    // else{
                    //   if(in_array($dt->type, ['purchase_return','sell_return'])){
                    //     $invoice_total_amount -= $dt->final_total;
                    //     $invoice_total_paid += $dt->total_paid;
                    //     $invoice_total_due += $due_value;
                    //   }else if($due_payment_type == 'purchase' && $dt->type == 'opening_balance' && $dt->sub_type == 'debit'){
                    //     $invoice_total_amount -= $dt->final_total;
                    //     $invoice_total_paid += $dt->total_paid;
                    //     $invoice_total_due += $due_value;
                    //   }else if($due_payment_type == 'sell' && $dt->type == 'opening_balance' && $dt->sub_type == 'credit'){
                    //     $invoice_total_amount -= $dt->final_total;
                    //     $invoice_total_paid += $dt->total_paid;
                    //     $invoice_total_due += $due_value;
                    //   }else if($due_payment_type == 'purchase' && $dt->type == 'advance_deposit' && $dt->sub_type == 'credit'){
                    //     $invoice_total_amount -= $dt->final_total;
                    //     $invoice_total_paid += $dt->total_paid;
                    //     $invoice_total_due += $due_value;
                    //   }else if($due_payment_type == 'sell' && $dt->type == 'advance_deposit' && $dt->sub_type == 'debit'){
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
                <td colspan="5">
                  <button type="button" class="btn btn-primary btn-sm" id="auto_apply_btn">Auto Apply</button>
                </td>
                <td><?php echo e(!empty($invoice_total_amount) ? number_format($invoice_total_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '', false); ?></td>
                <td><?php echo e(!empty($invoice_total_paid) ? number_format($invoice_total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '', false); ?></td>
                <td id="invoice_total_due" value="<?php echo e($invoice_total_due, false); ?>"><?php echo e(!empty($invoice_total_due) ? number_format($invoice_total_due, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '', false); ?></td>
              </tr>
              <tr>
                <td colspan="6"></td>
                <td>Difference</td>
                <td id="invoice_total_diff" class="text-danger"><?php echo e(number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
              </tr>
            </tfoot>
           </table>
           </div>
           <input type="hidden" id="is_first" value='0'>
           <input type="hidden" id="is_change" name="is_change" value='0'>
           <input type="hidden" id="is_invalid" value='0'>
        </div>

        <?php if(!empty($accounts)): ?>
          <div class="col-md-4">
            <div class="form-group mb-2">
              <?php echo Form::label("account_id" , __('lang_v1.payment_account') . ':'); ?>

              <div class="input-group">
                <span class="input-group-text">
                  <i class="fas fa-money-bill-alt"></i>
                </span>
                <?php echo Form::select("account_id", $accounts, !empty($payment_line->account_id) ? $payment_line->account_id : '' , ['class' => 'form-select select2', 'id' => "account_id", 'style' => 'width:80%;']); ?>

              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="clearfix"></div>

          <?php echo $__env->make('transaction_payment.payment_type_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <div class="clearfix"></div>
          <?php if(in_array('upload_documents', $enabled_modules)): ?>
          <div class="col-md-4">
            <div class="form-group mb-2">
              <?php echo Form::label('document', __('purchase.attach_document') . ':'); ?>

              <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
              <?php echo Form::file('document', ['accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

            </div>
          </div>
          <?php endif; ?>
          <div class="col-md-12">
            <div class="form-group mb-2">
              <?php echo Form::label("note", __('lang_v1.payment_note') . ':'); ?>

              <?php echo Form::textarea("note", $payment_line->note, ['class' => 'form-control', 'rows' => 2]); ?>

            </div>
          </div>
      </div>
    </div>

    <div class="modal-footer">
      <input type="hidden" name="save_and_print" value='0' id="save_and_print">
      <button type="submit" class="btn btn-primary" id="save_btn"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-primary" id="save_and_print_btn"><?php echo app('translator')->get( 'lang_v1.save_and_print' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


<script>
$(document).ready(function(){

  amount = parseFloat($('#amount').val().replace(/,/g, ''));

  if ($('.null_balance').val() == 1 || amount < 0) {

    $('#save_btn').prop('disabled', false);
    $('#save_and_print_btn').prop('disabled', false);
  } else {
    $('#save_btn').prop('disabled', true);
    $('#save_and_print_btn').prop('disabled', true);
  }

  $("#amount").on('keyup input change', function(){
    if ($('#amount').val() == '0.00' || $('#amount').val() == '0') {
      $('#save_btn').prop('disabled', true);
      $('#save_and_print_btn').prop('disabled', true);
    } else {
      $('#save_btn').prop('disabled', false);
      $('#save_and_print_btn').prop('disabled', false);
    }
    });
});

</script>
