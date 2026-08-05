<div class="modal-dialog modal-dialog-scrollable" role="document">
  <?php echo Form::open(['url' => action([\App\Http\Controllers\QuickMenuController::class, 'store']), 'method' => 'post', 'id' => 'quick_menu_add_form', 'class' => 'modal-content' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'business.add_quick_menu' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   
    </div>

    <div class="modal-body">

      <?php if(count($business_locations) == 1): ?>
        <?php 
            $default_location = current(array_keys($business_locations->toArray())) 
        ?>
      <?php else: ?>
        <?php $default_location = null; ?>
      <?php endif; ?>
      <div class="form-group mb-2">
        <?php echo Form::label('location_id', __('purchase.business_location').':*'); ?>

        <?php echo Form::select('location_id', $business_locations, $default_location, ['class' => 'form-select select2', 'placeholder' => __('messages.please_select'), 'required']); ?>

      </div>
      
      <div class="form-group mb-2">
        <?php echo Form::label('name', __( 'business.quick_menu_name' ) . ':*'); ?>

        <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.quick_menu' ) ]); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('no_of_menu', __( 'business.no_of_menus' ) . ':*'); ?>

          <?php echo Form::number('no_of_menu', 12, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.no_of_menus' ) ]); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('no_of_menu_items', __( 'business.no_of_menu_items' ) . ':*'); ?>

        <?php echo Form::number('no_of_menu_items', 36, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.no_of_menu_items' ) ]); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('day_of_week', __('business.day_of_week').':'); ?>

        <?php echo Form::select('day_of_week', [
            '' => __('messages.please_select'),
            'monday' => __('business.monday'),
            'tuesday' => __('business.tuesday'),
            'wednesday' => __('business.wednesday'),
            'thursday' => __('business.thursday'),
            'friday' => __('business.friday'),
            'saturday' => __('business.saturday'),
            'sunday' => __('business.sunday'),
        ], null, ['class' => 'form-select select2']); ?>

        <small class="form-text text-muted"><?php echo app('translator')->get('business.day_of_week_help'); ?></small>
      </div>

      <div class="mb-3">
        <?php echo Form::label('copy_from', __('lang_v1.copy_from').':'); ?>

        <?php echo Form::select('copy_from', $quick_menus['list'], null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')], $quick_menus['attributes']); ?>

      </div>

    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

  <?php echo Form::close(); ?>

</div><!-- /.modal-dialog -->
