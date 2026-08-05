<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\GroupTaxController::class, 'store']), 'method' => 'post', 'id' => 'tax_group_add_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'tax_rate.add_tax_group' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
    </div>

    <div class="modal-body">
      <div class="form-group mb-2">
          <?php echo Form::label('name', __( 'tax_rate.name' ) . ':*'); ?>

          <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'tax_rate.name' )]); ?>

      </div>

      <div class="mb-3">
        <?php echo Form::label('desc', __( 'lang_v1.description' ) . ':*'); ?>

        <?php echo Form::text('desc', null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.description' )]); ?>

      </div>
      
      <div class="mb-3">
          <?php echo Form::label('taxes[]', __( 'tax_rate.sub_taxes' ) . ':*'); ?>

          <?php echo Form::select('taxes[]', $taxes, null, ['class' => 'form-control select2', 'id' => 'taxes_dropdown', 'required', 'multiple']); ?>

      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
