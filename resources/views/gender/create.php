<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\GenderController::class, 'store']), 'method' => 'post', 'id' => $quick_add ? 'quick_add_gender_form' : 'gender_add_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'gender.add_gender' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
    </div>

    <div class="modal-body">
      <div class="form-group mb-2">
        <?php echo Form::label('name', __( 'gender.gender_name' ) . ':*'); ?>

          <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'gender.gender_name' ) ]); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('description', __( 'gender.short_description' ) . ':'); ?>

          <?php echo Form::text('description', null, ['class' => 'form-control','placeholder' => __( 'gender.short_description' )]); ?>

      </div>

      <?php if(session('business.enable_sub_gender') && !empty($parent_genders)): ?>
      <div class="form-group mb-2">
        <div class="form-check">
          <label class="form-check-label">
<?php echo Form::checkbox('add_as_sub_gender', 1, false, [ 'class' => 'toggler form-check-input', 'data-toggle_id' => 'parent_gender_div' ]); ?> <?php echo app('translator')->get('lang_v1.add_as_sub_txonomy'); ?>
          </label>
        </div>
      </div>
      <div class="form-group mb-2 hide" id="parent_gender_div">
        <?php echo Form::label('parent_id', __( 'lang_v1.select_parent_taxonomy' ) . ':'); ?>

        <?php echo Form::select('parent_id', $parent_genders, null, ['class' => 'form-select']); ?>

      </div>
      <?php endif; ?>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
