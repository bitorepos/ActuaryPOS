<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\UnitController::class, 'store']), 'method' => 'post', 'id' => $quick_add ? 'quick_add_unit_form' : 'unit_add_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'unit.add_unit' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="form-group mb-2 col-sm-12">
          <?php echo Form::label('actual_name', __( 'unit.name' ) . ':*'); ?>

            <?php echo Form::text('actual_name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'unit.name' )]); ?>

        </div>

        <div class="form-group mb-2 col-sm-12">
          <?php echo Form::label('short_name', __( 'unit.short_name' ) . ':*'); ?>

            <?php echo Form::text('short_name', null, ['class' => 'form-control', 'placeholder' => __( 'unit.short_name' ), 'required']); ?>

        </div>

        <div class="form-group mb-2 col-sm-12">
          <?php echo Form::label('allow_decimal', __( 'unit.allow_decimal' ) . ':*'); ?>

            <?php echo Form::select('allow_decimal', ['1' => __('messages.yes'), '0' => __('messages.no')], null, ['placeholder' => __( 'messages.please_select' ), 'required', 'class' => 'form-control']); ?>

        </div>
        
          <div class="form-group mb-2 col-sm-12">
            <div class="form-group mb-2">
                <div class="form-check">
                  <label class="form-check-label">
<?php echo Form::checkbox('define_base_unit', 1, false,[ 'class' => 'toggler form-check-input', 'data-toggle_id' => 'base_unit_div' ]); ?> <?php echo app('translator')->get( 'lang_v1.add_as_multiple_of_base_unit' ); ?>
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
          <div class="form-group mb-2 col-sm-12 hide" id="base_unit_div">
            <table class="table">
              <tr>
                <th style="vertical-align: middle;">1 <span id="unit_name"><?php echo app('translator')->get('product.unit'); ?></span></th>
                <th style="vertical-align: middle;">=</th>
                <td style="vertical-align: middle;">
                  <?php echo Form::text('base_unit_multiplier', null, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.times_base_unit' )]); ?></td>
                <td style="vertical-align: middle;">
                  <?php echo Form::select('base_unit_id', $units, null, ['placeholder' => __( 'lang_v1.select_base_unit' ), 'class' => 'form-control']); ?>

                </td>
              </tr>
            </table>
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
