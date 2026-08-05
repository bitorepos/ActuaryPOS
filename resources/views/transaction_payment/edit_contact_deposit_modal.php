<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\TransactionPaymentController::class, 'postEditAdvanceDeposit']), 'method' => 'post', 'id' => 'edit_contact_deposit_form' ]); ?>

    <?php echo Form::hidden("transaction_id", $transaction->id); ?>

    <div class="modal-header">
      <h4 class="modal-title">Edit <?php echo app('translator')->get( 'lang_v1.advance_deposit' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
      <div class="row payment_row">
        <?php
          if(empty($transaction->sub_type)){
            if($contact_type == 'supplier'){
                $default_payment_type = 'debit';
            }else{
                $default_payment_type = 'credit';
            }
          }else{
            $default_payment_type = $transaction->sub_type; 
          }
          $date_readonly = !empty($user_settings['disable_contact_payment_date']) ? 'disabled' : '';
        ?>
        <div class="col-md-4">
          <div class="form-group mb-2">
            <?php echo Form::label("ad_payment_type" , 'Type:'); ?>

              <?php echo Form::select("ad_payment_type", ['debit' => 'Debit', 'credit' => 'Credit'], $default_payment_type, ['class' => 'form-select select2', 'style' => 'width:80%;']); ?>

          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group mb-2">
            <?php echo Form::label("business_location" , 'Location' . ':*'); ?>

            <div class="input-group">
              <span class="input-group-text">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              <?php echo Form::select("business_location", $business_locations, $transaction->location_id, ['class' => 'form-select select2 business_locations_dropdown', 'style' => 'width:80%;'], $bl_attributes,); ?>

            </div>
          </div>
        </div>
        <div class="col-md-4">
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
              <?php echo Form::select("user_id", $users, $transaction->created_by, $payment_user_attributes); ?>

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
              <?php echo Form::select("method", $payment_types, $transaction->sub_status, ['class' => 'form-select select2 payment_types_dropdown', 'required', 'style' => 'width:80%;']); ?>

            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group mb-2">
            <?php echo Form::label("paid_on" , __('lang_v1.paid_on') . ':*'); ?>

            <div class="input-group">
              <span class="input-group-text">
                <i class="fa fa-calendar"></i>
              </span>
              <?php echo Form::text('paid_on', \Carbon::createFromTimestamp(strtotime($transaction->transaction_date))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required', $date_readonly]); ?>

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
              <?php echo Form::text("amount", number_format($transaction->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number payment_amount', 'required', 'placeholder' => __('sale.amount'),
              'data-rule-min-value' => $transaction->advance_deposit_paid, 'data-msg-min-value' => "Min Value Allowed is ".number_format($transaction->advance_deposit_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']).""]); ?>

            </div>
          </div>
        </div>

        <?php if(!empty($accounts)): ?>
          <div class="col-md-4">
            <div class="form-group mb-2">
              <?php echo Form::label("account_id" , __('lang_v1.payment_account') . ':'); ?>

              <div class="input-group">
                <span class="input-group-text">
                  <i class="fas fa-money-bill-alt"></i>
                </span>
                <?php echo Form::select("account_id", $accounts, !empty($transaction->prefer_payment_account) ? $transaction->prefer_payment_account : '' , ['class' => 'form-select select2', 'id' => "account_id", 'style' => 'width:80%;']); ?>

              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="clearfix"></div>

          <?php echo $__env->make('transaction_payment.payment_type_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <div class="clearfix"></div>
          <div class="col-md-12">
            <div class="form-group mb-2">
              <?php echo Form::label("note", __('lang_v1.payment_note') . ':'); ?>

              <?php echo Form::textarea("note", $transaction->additional_notes, ['class' => 'form-control', 'rows' => 2]); ?>

            </div>
          </div>
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
