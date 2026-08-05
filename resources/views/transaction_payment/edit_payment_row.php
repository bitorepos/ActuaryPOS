<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\TransactionPaymentController::class, 'update'], [$payment_line->id]), 'method' => 'put', 'id' => 'transaction_payment_add_form', 'files' => true ]); ?>

    <?php echo Form::hidden('default_payment_accounts', !empty($transaction->location) ? $transaction->location->default_payment_accounts : '[]', ['id' => 'default_payment_accounts']); ?>

    <?php echo Form::hidden('payment_id', $payment_line->id, ['id' => 'payment_id']); ?>

    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'purchase.edit_payment' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
    </div>

    <div class="modal-body">
      <div class="row">
        <?php if(!empty($transaction->contact)): ?>
        <div class="col-md-4">
          <div class="p-3 border rounded bg-light">
            <strong><?php if($transaction->contact->type == 'supplier'): ?> <?php echo app('translator')->get('purchase.supplier'); ?>: <?php else: ?> <?php echo app('translator')->get('contact.customer'); ?>: <?php endif; ?> </strong><?php echo e($transaction->contact->full_name_with_business, false); ?><br>
            <strong><?php echo app('translator')->get('business.business'); ?>: </strong><?php echo e($transaction->contact->supplier_business_name, false); ?>

          </div>
        </div>
        <?php endif; ?>
        <?php if($transaction->type != 'opening_balance'): ?>
        <div class="col-md-4">
          <div class="p-3 border rounded bg-light">
            <strong><?php echo app('translator')->get('purchase.ref_no'); ?>: </strong><?php echo e($transaction->ref_no, false); ?><br>
            <?php if(!empty($transaction->location)): ?>
              <strong><?php echo app('translator')->get('purchase.location'); ?>: </strong><?php echo e($transaction->location->name, false); ?>

            <?php endif; ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-3 border rounded bg-light">
            <strong><?php echo app('translator')->get('sale.total_amount'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($transaction->final_total, false); ?></span><br>
            <strong><?php echo app('translator')->get('purchase.payment_note'); ?>: </strong>
            <?php if(!empty($transaction->additional_notes)): ?>
            <?php echo e($transaction->additional_notes, false); ?>

            <?php else: ?>
              --
            <?php endif; ?>
          </div>
        </div>
        <?php endif; ?>
      </div>
      <div class="row payment_row">
        <div class="col-md-4">
          <div class="form-group mb-2">
            <?php echo Form::label("method" , __('purchase.payment_method') . ':*'); ?>

            <div class="input-group">
              <span class="input-group-text">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              <?php echo Form::select("method", $payment_types, $payment_line->method, ['class' => 'form-control select2 payment_types_dropdown', 'required', 'style' => 'width:80%;']); ?>

            </div>
          </div>
        </div>
        <?php
          $date_readonly = '';
          if(in_array($transaction->type, ['sell', 'sell_return'])){
            $date_readonly = !empty($user_settings['disable_sale_payment_date']) ? 'disabled' : '';
          }else if(in_array($transaction->type, ['purchase', 'purchase_return'])){
            $date_readonly = !empty($user_settings['disable_purchase_payment_date']) ? 'disabled' : '';
          }else if(in_array($transaction->type, ['expense'])){
            $date_readonly = !empty($user_settings['disable_expense_payment_date']) ? 'disabled' : '';
          }
        ?>
        <div class="col-md-4">
          <div class="form-group mb-2">
            <?php echo Form::label("paid_on" , __('lang_v1.paid_on') . ':*'); ?>

            <div class="input-group">
              <span class="input-group-text">
                <i class="fa fa-calendar"></i>
              </span>
              <?php echo Form::text('paid_on', \Carbon::createFromTimestamp(strtotime($payment_line->paid_on))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', $date_readonly, 'required']); ?>

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
              <?php echo Form::text("amount", number_format($payment_line->amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number payment_amount', 'required', 'placeholder' => 'Amount']); ?>

            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
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
              <?php echo Form::select("user_id", $users, $payment_line->created_by, $payment_user_attributes); ?>

            </div>
          </div>
        </div>
        <div class="col-md-12 mb-10">
          
          <label class="radio-inline">
              <input type="radio" name="sub_method" id="payment_method_radio" value="cash" <?php echo e(($payment_line->sub_method == 'cash') ? 'checked' : '', false); ?> >
              <?php echo app('translator')->get('lang_v1.cash'); ?>
          </label>
          
          
          <label class="radio-inline">
            <input type="radio" name="sub_method" id="payment_method_radio" value="card" <?php echo e(($payment_line->sub_method == 'card') ? 'checked' : '', false); ?>>
            <?php echo app('translator')->get('lang_v1.card'); ?>
          </label>
          
          
          <label class="radio-inline">
            <input type="radio" name="sub_method" id="payment_method_radio" value="cheque" <?php echo e(($payment_line->sub_method == 'cheque') ? 'checked' : '', false); ?>>
            <?php echo app('translator')->get('lang_v1.cheque'); ?>
          </label>
          
          
          <label class="radio-inline">
            <input type="radio" name="sub_method" id="payment_method_radio" value="bank_transfer" <?php echo e(($payment_line->sub_method == 'bank_transfer') ? 'checked' : '', false); ?>>
            <?php echo app('translator')->get('lang_v1.bank_transfer'); ?>
          </label>
          
        </div>

         <?php
            // Phase 66: prefer controller-supplied per-branch overlay; session is the fallback.
            $pos_settings = isset($pos_settings) && ! empty($pos_settings)
                ? $pos_settings
                : (!empty(session()->get('business.pos_settings')) ? json_decode(session()->get('business.pos_settings'), true) : []);

            $enable_cash_denomination_for_payment_methods = !empty($pos_settings['enable_cash_denomination_for_payment_methods']) ? $pos_settings['enable_cash_denomination_for_payment_methods'] : [];
        ?>

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
                        <?php
                            $total = 0;
                        ?>
                        <?php $__currentLoopData = explode(',', $pos_settings['cash_denominations']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dnm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $count = 0;
                            $sub_total = 0;
                            foreach($payment_line->denominations as $d) {
                                if($d->amount == $dnm) {
                                    $count = $d->total_count; 
                                    $sub_total = $d->total_count * $d->amount;
                                    $total += $sub_total;
                                }
                            }
                        ?>
                        <tr>
                          <td class="text-right"><?php echo e($dnm, false); ?></td>
                          <td class="text-center" >X</td>
                          <td><?php echo Form::number("denominations[$dnm]", $count, ['class' => 'form-control cash_denomination input-sm', 'min' => 0, 'data-denomination' => $dnm, 'style' => 'width: 100px; margin:auto;' ]); ?></td>
                          <td class="text-center">=</td>
                          <td class="text-left">
                            <span class="denomination_subtotal"><?php echo e(number_format($sub_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
                          </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="4" class="text-center"><?php echo app('translator')->get('sale.total'); ?></th>
                          <td>
                            <span class="denomination_total"><?php echo e(number_format($total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
                            <input type="hidden" class="denomination_total_amount" value="<?php echo e($total, false); ?>">
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
            <div class="clearfix"></div>
        <?php endif; ?>
       
        
        
        <div class="clearfix"></div>
        <?php
        $default_datetime = $payment_line->paid_on;
        ?>
          <?php echo $__env->make('transaction_payment.payment_type_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <div class="col-md-12">
            <div class="mb-3">
              <?php echo Form::label("note", __('lang_v1.payment_note') . ':'); ?>

              <?php echo Form::textarea("note", $payment_line->note, ['class' => 'form-control', 'rows' => 3]); ?>

            </div>
          </div>
          <?php if(in_array('upload_documents', $enabled_modules)): ?>
          <div class="col-md-4">
            <div class="mb-3">
              <?php echo Form::label('document', __('purchase.attach_document') . ':'); ?>

              <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('lang_v1.previous_file_will_be_replaced'); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
              <?php echo Form::file('document', ['accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

            </div>
          </div>
          <?php endif; ?>
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
