<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\BusinessLocationController::class, 'update'], [$location->id]), 'method' => 'PUT', 'id' => 'business_location_add_form' ]); ?>


    <div class="modal-header">
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'business.edit_business_location' ); ?></h4>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="mb-3">
            <?php echo Form::label('name', __( 'invoice.name' ) . ':*'); ?>

              <?php echo Form::text('name', $location->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'invoice.name' ) ]); ?>

          </div>
        </div>
        <div class="col-sm-12">
          <div class="mb-3">
            <?php echo Form::label('landmark', __( 'business.landmark' ) . ':'); ?>

              <?php echo Form::text('landmark', $location->landmark, ['class' => 'form-control', 'placeholder' => __( 'business.landmark' ) ]); ?>

          </div>
        </div>
        <div class="col-sm-12">
          <div class="mb-3">
            <?php echo Form::label('city', __( 'business.city' ) . ':*'); ?>

              <?php echo Form::text('city', $location->city, ['class' => 'form-control', 'placeholder' => __( 'business.city'), 'required' ]); ?>

          </div>
        </div>
        <div class="col-sm-12">
          <div class="mb-3">
            <?php echo Form::label('zip_code', __( 'business.zip_code' ) . ':*'); ?>

              <?php echo Form::text('zip_code', $location->zip_code, ['class' => 'form-control', 'placeholder' => __( 'business.zip_code'), 'required' ]); ?>

          </div>
        </div>
        <div class="col-sm-12">
          <div class="mb-3">
            <?php echo Form::label('state', __( 'business.state' ) . ':*'); ?>

              <?php echo Form::text('state', $location->state, ['class' => 'form-control', 'placeholder' => __( 'business.state'), 'required' ]); ?>

          </div>
        </div>
        <div class="col-sm-12">
          <div class="mb-3">
            <?php echo Form::label('country', __( 'business.country' ) . ':*'); ?>

              <?php echo Form::text('country', $location->country, ['class' => 'form-control', 'placeholder' => __( 'business.country'), 'required' ]); ?>

          </div>
        </div>
        <div class="col-sm-12">
          <div class="mb-3">
            <?php echo Form::label('invoice_scheme_id', __('invoice.invoice_scheme') . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.invoice_scheme') . '"></i>';
                }
            ?>
              <?php echo Form::select('invoice_scheme_id', $invoice_schemes, $location->invoice_scheme_id, ['class' => 'form-control', 'required',
              'placeholder' => __('messages.please_select')]); ?>

          </div>
        </div>
        <div class="col-sm-12">
          <div class="mb-3">
            <?php echo Form::label('invoice_layout_id', __('invoice.invoice_layout') . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.invoice_layout') . '"></i>';
                }
            ?>
              <?php echo Form::select('invoice_layout_id', $invoice_layouts,  $location->invoice_layout_id, ['class' => 'form-control', 'required',
              'placeholder' => __('messages.please_select')]); ?>

          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
