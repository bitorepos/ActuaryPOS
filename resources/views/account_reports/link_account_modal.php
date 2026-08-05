<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\AccountReportsController::class, 'postLinkAccount']), 'method' => 'post', 'id' => 'link_account_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'account.link_account' ); ?> - <?php echo app('translator')->get( 'account.payment_ref_no' ); ?>: - <?php echo e($payment->payment_ref_no, false); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
        <div class="form-group mb-2">
            <?php echo Form::hidden('transaction_payment_id', $payment->id); ?>

            <?php echo Form::label('account_id', __( 'account.account' ) .":"); ?>

            <?php echo Form::select('account_id', $accounts, $payment->account_id, ['class' => 'form-select', 'required']); ?>

        </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
