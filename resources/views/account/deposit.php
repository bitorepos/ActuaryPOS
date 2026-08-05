<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\AccountController::class, 'postDeposit']), 'method' => 'post', 'id' => 'deposit_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'account.deposit' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
            <div class="form-group mb-2">
                <strong><?php echo app('translator')->get('account.selected_account'); ?></strong>: 
                <?php echo e($account->name, false); ?>

                <?php echo Form::hidden('account_id', $account->id); ?>

            </div>

            <div class="form-group mb-2">
                <?php echo Form::label('account_id', __( 'lang_v1.deposit_to' ) .":"); ?>

                <?php echo Form::select('account_id', $from_accounts, $account->id, ['class' => 'form-control' ]); ?>

            </div>

            <div class="form-group mb-2">
                <?php echo Form::label('amount', __( 'sale.amount' ) .":*"); ?>

                <?php echo Form::text('amount', 0, ['class' => 'form-control input_number', 'required','placeholder' => __( 'sale.amount' ) ]); ?>

            </div>

            <div class="form-group mb-2">
                <?php echo Form::label('from_account', __( 'account.deposit_from' ) .":"); ?>

                <?php echo Form::select('from_account', $from_accounts, null, ['class' => 'form-control', 'placeholder' => __('messages.please_select') ]); ?>

            </div>

            <div class="form-group mb-2">
                <?php echo Form::label('operation_date', __( 'messages.date' ) .":*"); ?>

                <div class="input-group date">
                  <?php echo Form::text('operation_date', null, ['class' => 'form-control', 'required','placeholder' => __( 'messages.date' ), 'id'=>'od_datetimepicker' ]); ?>

                  <span class="input-group-text">
                    <span class="fa fa-calendar"></span>
                  </span>
                </div>
            </div>

            <div class="form-group mb-2">
                <?php echo Form::label('note', __( 'brand.note' )); ?>

                <?php echo Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => __( 'brand.note' ), 'rows' => 4]); ?>

            </div>
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
