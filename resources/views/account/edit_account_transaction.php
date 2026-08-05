<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\AccountController::class, 'updateAccountTransaction'], ['id' => $account_transaction->id ]), 'method' => 'post', 'id' => 'edit_account_transaction_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php if($account_transaction->sub_type == 'opening_balance'): ?><?php echo app('translator')->get( 'lang_v1.edit_opening_balance' ); ?> <?php elseif($account_transaction->sub_type == 'fund_transfer'): ?> <?php echo app('translator')->get( 'lang_v1.edit_fund_transfer' ); ?> <?php elseif($account_transaction->sub_type == 'deposit'): ?> <?php echo app('translator')->get( 'lang_v1.edit_deposit' ); ?> <?php endif; ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
            <div class="form-group mb-2">
                <strong><?php echo app('translator')->get('account.selected_account'); ?></strong>: 
                <?php echo e($account_transaction->account->name, false); ?>

            </div>

            <?php if($account_transaction->sub_type == 'deposit'): ?>
            <?php
              $label = !empty($account_transaction->type == 'debit') ? __( 'account.deposit_from' ) :  __('lang_v1.deposit_to');
            ?> 
            <div class="form-group mb-2">  
                <?php echo Form::label('account_id', $label .":"); ?>

                <?php echo Form::select('account_id', $accounts, $account_transaction->account_id, ['class' => 'form-select', 'placeholder' => __('messages.please_select') ]); ?>

            </div>
            <?php endif; ?>

            <?php if($account_transaction->sub_type == 'fund_transfer'): ?> 
            <?php
              $label = !empty($account_transaction->type == 'credit') ? __( 'account.transfer_to' ) :__('lang_v1.transfer_from')  ;
            ?> 
            <div class="form-group mb-2">  
                <?php echo Form::label('account_id', $label .":"); ?>

                <?php echo Form::select('account_id', $accounts, $account_transaction->account_id, ['class' => 'form-select', 'placeholder' => __('messages.please_select') ]); ?>

            </div>
            <?php endif; ?>

            <div class="form-group mb-2">
                <?php echo Form::label('amount', __( 'sale.amount' ) .":*"); ?>

                <?php echo Form::text('amount', number_format($account_transaction->amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'required','placeholder' => __( 'sale.amount' ) ]); ?>

            </div>
            <?php if($account_transaction->sub_type == 'deposit'): ?>
            <?php
              $label = !empty($account_transaction->type == 'debit') ? __('lang_v1.deposit_to') :  __( 'account.deposit_from' );
            ?> 
            <div class="form-group mb-2">  
                <?php echo Form::label('from_account', $label .":"); ?>

                <?php echo Form::select('from_account', $accounts, $account_transaction->transfer_transaction->account_id ?? null, ['class' => 'form-select', 'placeholder' => __('messages.please_select') ]); ?>

            </div>
            <?php endif; ?>
            <?php if($account_transaction->sub_type == 'fund_transfer'): ?> 
            <?php
              $label = !empty($account_transaction->type == 'credit') ? __('lang_v1.transfer_from') :  __( 'account.transfer_to' );
            ?> 
            <div class="form-group mb-2">
                <?php echo Form::label('to_account', $label .":*"); ?>

                <?php echo Form::select('to_account', $accounts, $account_transaction->transfer_transaction->account_id ?? null, ['class' => 'form-select', 'required' ]); ?>

            </div>
            <?php endif; ?>
 
            <div class="form-group mb-2">
                <?php echo Form::label('operation_date', __( 'messages.date' ) .":*"); ?>

                <div class="input-group date">
                  <?php echo Form::text('operation_date', \Carbon::createFromTimestamp(strtotime($account_transaction->operation_date))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'required','placeholder' => __( 'messages.date' ), 'id' => 'od_datetimepicker' ]); ?>

                  <span class="input-group-text">
                    <span class="fa fa-calendar"></span>
                  </span>
                </div>
            </div>
            <?php if($account_transaction->sub_type == 'fund_transfer' || $account_transaction->sub_type == 'deposit'): ?>
            <div class="form-group mb-2">
                <?php echo Form::label('note', __( 'brand.note' )); ?>

                <?php echo Form::textarea('note', $account_transaction->note, ['class' => 'form-control', 'placeholder' => __( 'brand.note' ), 'rows' => 4]); ?>

            </div>
            <?php endif; ?>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.submit' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script type="text/javascript">
  $(document).ready( function(){
    $('#od_datetimepicker').datetimepicker({
      format: moment_date_format + ' ' + moment_time_format
    });
  });
</script>
