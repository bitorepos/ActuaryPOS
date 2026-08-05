<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\TaxRateController::class, 'update'], [$tax_rate->id]), 'method' => 'PUT', 'id' => 'tax_rate_edit_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'tax_rate.edit_taxt_rate' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   
    </div>

    <div class="modal-body">
      <div class="form-group mb-2">
        <?php echo Form::label('name', __( 'tax_rate.name' ) . ':*'); ?>

          <?php echo Form::text('name', $tax_rate->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'tax_rate.name' )]); ?>

      </div>
      <div class="form-group mb-2">
        <?php echo Form::label('tax_type_modal', __('tax_rate.rate_type') . ':*' ); ?>

        <?php echo Form::select('type', ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], empty($tax_rate->type) ?  'percentage' : $tax_rate->type  , ['class' => 'form-control']); ?>  
      </div>
      <div class="form-group mb-2">
        <?php echo Form::label('amount', __( 'tax_rate.rate' ) . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tax_exempt_help') . '"></i>';
                }
            ?>
          <?php echo Form::text('amount', $tax_rate->amount, ['class' => 'form-control input_number', 'required']); ?>

      </div>

      <div class="mb-3">
        <?php echo Form::label('desc', __( 'lang_v1.description' ) . ':*'); ?>

        <?php echo Form::text('desc', $tax_rate->desc, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.description' )]); ?>

      </div>

      <div class="mb-3">
        <?php echo Form::label('payment_methods', __('tax_rate.payment_methods') . ':'); ?>

        <?php echo Form::select('payment_methods[]', $payment_methods, $tax_rate->payment_methods, [
        'class' => 'form-control select2',
        'multiple',
        'style'=> 'width:100%',
        'id' => 'payment_methods',
        ]); ?>

      </div>
      <script>
        $(document).ready(function() {
          $('#payment_methods').select2();
        });
      </script>
      <div class="form-group mb-2">
        <div class="form-check">
          <label class="form-check-label">
<?php echo Form::checkbox('for_tax_group', 1, !empty($tax_rate->for_tax_group), [ 'class' => 'input_icheck form-check-input']); ?> <?php echo app('translator')->get( 'lang_v1.for_tax_group_only' ); ?>
          </label> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.for_tax_group_only_help') . '"></i>';
                }
            ?>
        </div>
      </div>

    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
