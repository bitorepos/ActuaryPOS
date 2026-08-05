<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\WarrantyController::class, 'update'], [$warranty->id]), 'method' => 'put', 'id' => 'warranty_form']); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.edit_warranty' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
    </div>

    <div class="modal-body">
      <div class="form-group mb-2">
        <?php echo Form::label('name', __( 'lang_v1.name' ) . ':*'); ?>

          <?php echo Form::text('name', $warranty->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.name' ) ]); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('description', __( 'lang_v1.description' ) . ':'); ?>

          <?php echo Form::textarea('description', $warranty->description, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.description' ), 'rows' => 3 ]); ?>

      </div>
      <strong><?php echo Form::label('duration', __( 'lang_v1.duration' ) . ':'); ?>*</strong>
      <div class="form-group mb-2">
          <?php echo Form::number('duration', $warranty->duration, ['class' => 'form-control width-40 float-start', 'placeholder' => __( 'lang_v1.duration' ), 'required' ]); ?>


          <?php echo Form::select('duration_type', ['days' => __('lang_v1.days'), 'months' => __('lang_v1.months'), 'years' => __('lang_v1.years')], $warranty->duration_type, ['class' => 'form-select width-60 float-end','placeholder' => __('messages.please_select'), 'required']); ?>

      </div>
      <br>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
