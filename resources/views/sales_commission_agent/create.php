<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\SalesCommissionAgentController::class, 'store']), 'method' => 'post', 'id' => 'sale_commission_agent_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.add_sales_commission_agent' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="col-md-2">
        <div class="form-group mb-2">
          <?php echo Form::label('surname', __( 'business.prefix' ) . ':'); ?>

            <?php echo Form::text('surname', null, ['class' => 'form-control', 'placeholder' => __( 'business.prefix_placeholder' ) ]); ?>

        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group mb-2">
          <?php echo Form::label('first_name', __( 'business.first_name' ) . ':*'); ?>

            <?php echo Form::text('first_name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]); ?>

        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group mb-2">
          <?php echo Form::label('last_name', __( 'business.last_name' ) . ':'); ?>

            <?php echo Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => __( 'business.last_name' ) ]); ?>

        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-6">
        <div class="form-group mb-2">
          <?php echo Form::label('email', __( 'business.email' ) . ':'); ?>

            <?php echo Form::text('email', null, ['class' => 'form-control', 'placeholder' => __( 'business.email' ) ]); ?>

        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group mb-2">
          <?php echo Form::label('contact_no', __( 'lang_v1.contact_no' ) . ':'); ?>

            <?php echo Form::text('contact_no', null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.contact_no' ) ]); ?>

        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group mb-2">
          <?php echo Form::label('address', __( 'business.address' ) . ':'); ?>

            <?php echo Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => __( 'business.address'), 'rows' => 3 ]); ?>

        </div>
      </div>

      <div class="col-md-8">
        <div class="form-group mb-2">
          <?php echo Form::label('cmmsn_percent', __( 'lang_v1.cmmsn_percent' ) . ':'); ?>

            <?php echo Form::text('cmmsn_percent', '0.00', ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.cmmsn_percent' ), 'required' ]); ?>

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
