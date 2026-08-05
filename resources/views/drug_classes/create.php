<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\DrugClassController::class, 'store']), 'method' => 'post', 'id' => 'drug_class_add_form']); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.add_drug_class' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
    </div>

    <div class="modal-body">
      <div class="form-group mb-2">
        <?php echo Form::label('name', __( 'lang_v1.drug_class' ) . ':*'); ?>

          <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.drug_class' ) ]); ?>

      </div>
      <input type="hidden" name="created_by" value="<?php echo e(Session::get('user.id'), false); ?>">
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
