<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\Restaurant\ModifierSetsController::class, 'store']), 'method' => 'post', 'id' => 'table_add_form' ]); ?>


    <div class="modal-header">
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'restaurant.add_modifier' ); ?></h4>
    </div>

    <div class="modal-body">
      <div class="row">
        
        <div class="col-sm-12">
          <div class="mb-3">
            <?php echo Form::label('name', __( 'restaurant.modifier_set' ) . ':*'); ?>

            <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.name' ) ]); ?>

          </div>
        </div>

        <div class="col-sm-12">
          <h4><?php echo app('translator')->get( 'restaurant.modifiers' ); ?></h4>
        </div>


        <div class="col-sm-12">
          <div class="table-responsive">
<table class="table table-condensed" id="add-modifier-table">
            <thead>
              <tr>
                <th><?php echo app('translator')->get( 'restaurant.modifier'); ?></th>
                <th>
                  <?php echo app('translator')->get( 'lang_v1.price'); ?>

                  <?php
                    $html = '<tr><td>
                          <div class="mb-3">
                            <input type="text" name="modifier_name[]" 
                            class="form-control" 
                            placeholder="' . __( 'lang_v1.name' ) . '" required>
                          </div>
                        </td>
                        <td>
                          <div class="mb-3">
                            <input type="text" name="modifier_price[]" class="form-control input_number" 
                            placeholder="' . __( 'lang_v1.price' ) . '" required>
                          </div>
                        </td>';

                    $html_other_row = $html . '<td>
                            <button class="btn btn-danger btn-sm float-end remove-modifier-row" type="button"><i class="fa fa-minus"></i></button>
                          </td>
                        </tr>';

                    $html_first_row = $html . "<td>
                            <button class='btn btn-primary btn-sm float-end add-modifier-row' type='button'
                            data-html='{{ $html_other_row }}'>
                            <i class='fa fa-plus'></i></button>
                          </td>
                        </tr>";

                  ?>
                  
                  
                </th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?php echo $html_first_row; ?>

            </tbody>
          </table>
</div>
        </div>

      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
