<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\InvoiceSchemeController::class, 'update'], [$invoice->id]), 'method' => 'put', 'id' => 'invoice_scheme_add_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'invoice.edit_invoice' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="option-div-group row">
          <div class="col-sm-4">
            <div class="form-group mb-2">
              <div class="option-div <?php if($invoice->scheme_type == 'blank'): ?> <?php echo e('active', false); ?> <?php endif; ?>">
                <h4>FORMAT: <br>XXXX <i class="fa fa-check-circle float-end icon"></i></h4>
                <input type="radio" name="scheme_type" value="blank" <?php if($invoice->scheme_type == 'blank'): ?> <?php echo e('checked', false); ?> <?php endif; ?>>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group mb-2">
              <div class="option-div  <?php if($invoice->scheme_type == 'year'): ?> <?php echo e('active', false); ?> <?php endif; ?>">
                <h4>FORMAT: <br><?php echo e(date('Y'), false); ?><?php echo e(config('constants.invoice_scheme_separator'), false); ?>XXXX <i class="fa fa-check-circle float-end icon"></i></h4>
                <input type="radio" name="scheme_type" value="year" <?php if($invoice->scheme_type == 'year'): ?> <?php echo e('checked', false); ?> <?php endif; ?>>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group mb-2">
            <label><?php echo app('translator')->get('invoice.preview'); ?>:</label>
            <div id="preview_format"><?php echo app('translator')->get('invoice.not_selected'); ?></div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group mb-2">
            <?php echo Form::label('name', __( 'invoice.name' ) . ':*'); ?>

              <?php echo Form::text('name', $invoice->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'invoice.name' ) ]); ?>

          </div>
        </div>
        <div id="invoice_format_settings" class="row">
        <div class="col-sm-6">
          <div class="form-group mb-2">
            <?php echo Form::label('prefix', __( 'invoice.prefix' ) . ':'); ?>

            <div class="input-group col-md-12 col-sm-12">
              <span class="input-group-text">
                  <i class="fa fa-info"></i>
              </span>
                <?php echo Form::text('prefix', $invoice->prefix, ['class' => 'form-control', 'placeholder' => '']); ?>

            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group mb-2">
            <?php echo Form::label('start_number', __( 'invoice.start_number' ) . ':'); ?>

            <div class="input-group col-md-12 col-sm-12">
              <span class="input-group-text">
                  <i class="fa fa-info"></i>
              </span>
                <?php echo Form::number('start_number', $invoice->start_number, ['class' => 'form-control', 'required', 'min' => 0 ]); ?>

            </div>
          </div>
        </div>
        
        <div class="col-sm-6">
          <div class="form-group mb-2">
            <?php echo Form::label('total_digits', __( 'invoice.total_digits' ) . ':'); ?>

            <div class="input-group col-md-12 col-sm-12">
              <span class="input-group-text">
                  <i class="fa fa-info"></i>
              </span>
              <?php echo Form::select('total_digits', ['4' => '4', '5' => '5', '6' => '6', '7' => '7', 
              '8' => '8', '9'=>'9', '10' => '10'], $invoice->total_digits, ['class' => 'form-control', 'required']); ?>

            </div>
          </div>
        </div>
        <?php if(!empty(session()->get('business.common_settings.disable_fbr') == 1)): ?>
          <div class="col-sm-3">
            <div class="form-group mb-2">
              <br>
              <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('disable', 1, !empty($invoice->disable_fbr) ? true : false); ?> <?php echo app('translator')->get('lang_v1.disable'); ?></label>
              </div>
            </div>
          </div>
        <?php endif; ?>
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
