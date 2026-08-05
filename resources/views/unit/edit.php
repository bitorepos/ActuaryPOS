<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\UnitController::class, 'update'], [$unit->id]), 'method' => 'PUT', 'id' => 'unit_edit_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'unit.edit_unit' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="form-group mb-2 col-sm-12">
          <?php echo Form::label('actual_name', __( 'unit.name' ) . ':*'); ?>

            <?php echo Form::text('actual_name', $unit->actual_name, ['class' => 'form-control', 'required', 'placeholder' => __( 'unit.name' )]); ?>

        </div>

        <div class="form-group mb-2 col-sm-12">
          <?php echo Form::label('short_name', __( 'unit.short_name' ) . ':*'); ?>

            <?php echo Form::text('short_name', $unit->short_name, ['class' => 'form-control', 'placeholder' => __( 'unit.short_name' ), 'required']); ?>

        </div>

        <div class="form-group mb-2 col-sm-12">
          <?php echo Form::label('allow_decimal', __( 'unit.allow_decimal' ) . ':*'); ?>

            <?php echo Form::select('allow_decimal', ['1' => __('messages.yes'), '0' => __('messages.no')], $unit->allow_decimal, ['placeholder' => __( 'messages.please_select' ), 'required', 'class' => 'form-control']); ?>

        </div>
        <div class="form-group mb-2 col-sm-12">
            <div class="form-group mb-2">
                <div class="form-check">
                  <label class="form-check-label">
<?php echo Form::checkbox('define_base_unit', 1, !empty($unit->base_unit_id),[ 'class' => 'toggler form-check-input', 'data-toggle_id' => 'base_unit_div' ]); ?> <?php echo app('translator')->get( 'lang_v1.add_as_multiple_of_base_unit' ); ?>
                  </label> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.multi_unit_help') . '"></i>';
                }
            ?>
                </div>
            </div>
          </div>
        <div class="form-group mb-2 col-sm-12 <?php if(empty($unit->base_unit_id)): ?> hide <?php endif; ?>" id="base_unit_div">
          <table class="table">
            <tr>
              <th style="vertical-align: middle;">1 <span id="unit_name"><?php echo e($unit->actual_name, false); ?></span></th>
              <th style="vertical-align: middle;">=</th>
              <td style="vertical-align: middle;">
                <?php echo Form::text('base_unit_multiplier', !empty($unit->base_unit_multiplier) ? $unit->base_unit_multiplier : null, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.times_base_unit' )]); ?></td>
              <td style="vertical-align: middle;">
                <?php echo Form::select('base_unit_id', $units, $unit->base_unit_id, ['placeholder' => __( 'lang_v1.select_base_unit' ), 'class' => 'form-control']); ?>

              </td>
            </tr>
            <tr><td colspan="4" style="padding-top: 0;">
            <p class="help-block">*<?php echo app('translator')->get('lang_v1.edit_multi_unit_help_text'); ?></p></td></tr>
          </table>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <input type="hidden" id="unit_id" value="<?php echo e($unit->id, false); ?>">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
