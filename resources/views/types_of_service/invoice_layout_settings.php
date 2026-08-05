<div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title"><?php echo app('translator')->get('lang_v1.types_of_service_module_settings'); ?></h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-3">
          <div class="mb-3">
            <?php echo Form::label('types_of_service_label', __('lang_v1.types_of_service_label') . ':' ); ?>

            <?php echo Form::text('module_info[types_of_service][types_of_service_label]', !empty($module_info['types_of_service']['types_of_service_label']) ? $module_info['types_of_service']['types_of_service_label'] : null, ['class' => 'form-control',
              'placeholder' => __('lang_v1.types_of_service_label') ]); ?>

          </div>
        </div>
        <div class="col-sm-3">
          <div class="mb-3">
            <br>
            <div class="form-check">
              <label class="form-check-label">
<?php echo Form::checkbox('module_info[types_of_service][show_types_of_service]', 1, !empty($module_info['types_of_service']['show_types_of_service']), ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_types_of_service'); ?></label>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="mb-3">
            <br>
            <div class="form-check">
              <label class="form-check-label">
<?php echo Form::checkbox('module_info[types_of_service][show_tos_custom_fields]', 1, !empty($module_info['types_of_service']['show_tos_custom_fields']), ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_tos_custom_fields'); ?></label>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
