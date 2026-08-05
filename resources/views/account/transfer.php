<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\AccountController::class, 'postFundTransfer']), 'method' => 'post', 'id' => 'fund_transfer_form', 'files' => true ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'account.fund_transfer' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">

            <div class="form-group mb-2">
                <?php echo Form::label('from_account', __( 'account.transfer_from' ) .":*"); ?>

                <?php echo Form::select('from_account', $to_accounts, $from_account->id, ['class' => 'form-select', 'required' ]); ?>

            </div>

            <div class="form-group mb-2">
                <?php echo Form::label('to_account', __( 'account.transfer_to' ) .":*"); ?>

                <?php echo Form::select('to_account', $to_accounts, null, ['class' => 'form-select', 'required' ]); ?>

            </div>

            <div class="form-group mb-2">
                <?php echo Form::label('amount', __( 'sale.amount' ) .":*"); ?>

                <?php echo Form::text('amount', 0, ['class' => 'form-control input_number', 'required','placeholder' => __( 'sale.amount' ) ]); ?>

            </div>

            <div class="form-group mb-2">
                <?php echo Form::label('od_datetimepicker', __( 'messages.date' ) .":*"); ?>

                <div class="input-group">
                  <?php echo Form::text('operation_date', null, ['class' => 'form-control', 'required','placeholder' => __( 'messages.date' ), 'id' => 'od_datetimepicker' ]); ?>

                  <span class="input-group-text">
                    <span class="fa fa-calendar"></span>
                  </span>
                </div>
            </div>

            <div class="form-group mb-2">
                <?php echo Form::label('note', __( 'brand.note' )); ?>

                <?php echo Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => __( 'brand.note' ), 'rows' => 4]); ?>

            </div>

            <?php if(in_array('upload_documents', $enabled_modules)): ?>
            <div class="form-group mb-2">
                <?php echo Form::label('document', __('purchase.attach_document') . ':'); ?>

                <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                <?php echo Form::file('document', ['id' => 'upload_document', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

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
