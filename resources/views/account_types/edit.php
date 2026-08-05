<div class="modal-dialog" role="document">
  	<div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\AccountTypeController::class, 'update'], $account_type->id), 'method' => 'put', 'id' => 'account_type_form' ]); ?>

    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.edit_account_type' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
      	<div class="mb-3">
        	<?php echo Form::label('name', __( 'lang_v1.name' ) . ':*'); ?>

          	<?php echo Form::text('name', $account_type->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.name' )]); ?>

      	</div>

      <div class="mb-3">
        	<?php echo Form::label('parent_account_type_id', __( 'lang_v1.parent_account_type' ) . ':'); ?>

          	<?php echo Form::select('parent_account_type_id', $account_types->pluck('name', 'id'), $account_type->parent_account_type_id, ['class' => 'form-select', 'placeholder' => __( 'messages.please_select' )]); ?>

      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
