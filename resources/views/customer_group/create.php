<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\CustomerGroupController::class, 'store']), 'method' => 'post', 'id' => 'customer_group_add_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.add_customer_group' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
    </div>

    <div class="modal-body">
      <div class="form-group mb-2">
        <?php echo Form::label('name', __( 'lang_v1.customer_group_name' ) . ':*'); ?>

          <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.customer_group_name' ) ]); ?>

      </div>

      <div class="form-group mb-2">
            <?php echo Form::label('price_calculation_type', __( 'lang_v1.price_calculation_type' ) . ':'); ?>

            <?php echo Form::select('price_calculation_type',['percentage' => __('lang_v1.percentage'), 'selling_price_group' => __('lang_v1.selling_price_group')], 'percentage', ['class' => 'form-select']); ?>

      </div>

      <div class="form-group mb-2 percentage-field">
        <?php echo Form::label('amount', __( 'lang_v1.calculation_percentage' ) . ':'); ?>

        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_calculation_percentage') . '"></i>';
                }
            ?>
        <?php echo Form::text('amount', null, ['class' => 'form-control input_number','placeholder' => __( 'lang_v1.calculation_percentage')]); ?>

      </div>

      <div class="form-group mb-2 selling_price_group-field hide">
            <?php echo Form::label('selling_price_group_id', __( 'lang_v1.selling_price_group' ) . ':'); ?>

            <?php echo Form::select('selling_price_group_id', $price_groups, null, ['class' => 'form-control']); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('sales_discount_ids', __('sale.discounts') . ':'); ?>

        <?php echo Form::select('sales_discount_ids[]', $sales_discounts ?? [], null, ['class' => 'form-control select2', 'multiple', 'style' => 'width: 100%;', 'data-dropdown-parent' => '.customer_groups_modal', 'placeholder' => __('messages.please_select')]); ?>

      </div>

    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


    <script>
      $(function () {
        $('#customer_group_add_form .select2').select2({
          dropdownParent: $('.customer_groups_modal')
        });
      });
    </script>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
