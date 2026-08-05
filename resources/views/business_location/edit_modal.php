<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\BusinessLocationController::class, 'update'], [$location->id]), 'method' => 'PUT', 'id' => 'business_location_add_form' ]); ?>


    <?php echo Form::hidden('hidden_id', $location->id, ['id' => 'hidden_id']); ?>

    <div class="modal-header">
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'business.edit_business_location' ); ?></h4>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="<?php if(!$fbr_integration): ?> col-sm-12 <?php else: ?> col-sm-6 <?php endif; ?>">
          <div class="mb-3">
            <?php echo Form::label('name', __( 'invoice.name' ) . ':*'); ?>

              <?php echo Form::text('name', $location->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'invoice.name' ) ]); ?>

          </div>
        </div>

        <?php if($fbr_integration): ?>
          <div class="col-sm-6">
            <div class="mb-3">
              <?php echo Form::label('FBR POS ID'); ?>

                <?php echo Form::text('fbr_pos_id', $location->fbr_pos_id, ['class' => 'form-control', 'placeholder' => __( 'FBR POS ID' ) ]); ?>

            </div>
          </div>
          <div class="col-sm-6">
            <div class="mb-3">
              <?php echo Form::label('FBR Token'); ?>

                <?php echo Form::text('loc_settings[fbr_token]', $location->loc_settings['fbr_token'] ?? null, ['class' => 'form-control', 'placeholder' => __( 'FBR Token' ) ]); ?>

            </div>
          </div>
          <div class="col-sm-6">
            <div class="mb-3">
              <?php echo Form::label('PRA POS ID'); ?>

                <?php echo Form::text('pra_pos_id', $location->pra_pos_id, ['class' => 'form-control', 'placeholder' => __( 'PRA POS ID' ) ]); ?>

            </div>
          </div>
          <div class="col-sm-6">
            <div class="mb-3">
              <?php echo Form::label('PRA Token'); ?>

                <?php echo Form::text('pra_token', $location->pra_token, ['class' => 'form-control', 'placeholder' => __( 'PRA Token' ) ]); ?>

            </div>
          </div>
        <?php endif; ?>

        <?php if($fbr_di_integration): ?>
        <div class="col-sm-10">
          <div class="mb-3">
              <?php echo Form::label('FBR Digital Invoicing Token:'); ?>

              <?php echo Form::text('fbr_di_token', $location->fbr_di_token, ['class' => 'form-control', 'placeholder' => __( 'FBR Digital Invoicing Token' ) ]); ?>

          </div>
        </div>
        <div class="col-sm-2">
          <div class="mb-3">
            <br>
            <?php echo Form::checkbox('loc_settings[fbr_di_sandbox]', 1, !empty($location->loc_settings['fbr_di_sandbox'])); ?> Is Sandbox
          </div>
        </div>
        <?php endif; ?>

        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="mb-3">
            <?php echo Form::label('location_id', __( 'lang_v1.location_id' ) . ':'); ?>

              <?php echo Form::text('location_id', $location->location_id, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.location_id' ) ]); ?>

          </div>
        </div>
        <div class="col-sm-6">
          <div class="mb-3">
            <?php echo Form::label('landmark', __( 'business.landmark' ) . ':'); ?>

              <?php echo Form::text('landmark', $location->landmark, ['class' => 'form-control', 'placeholder' => __( 'business.landmark' ) ]); ?>

          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="mb-3">
            <?php echo Form::label('city', __( 'business.city' ) . ':*'); ?>

              <?php echo Form::text('city', $location->city, ['class' => 'form-control', 'placeholder' => __( 'business.city'), 'required' ]); ?>

          </div>
        </div>
        <div class="col-sm-6">
          <div class="mb-3">
            <?php echo Form::label('zip_code', __( 'business.zip_code' ) . ':'); ?>

              <?php echo Form::text('zip_code', $location->zip_code, ['class' => 'form-control', 'placeholder' => __( 'business.zip_code')]); ?>

          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="mb-3">
            <?php echo Form::label('state', __( 'business.state' ) . ':*'); ?>

              <?php echo Form::text('state', $location->state, ['class' => 'form-control', 'placeholder' => __( 'business.state'), 'required' ]); ?>

          </div>
        </div>
        <div class="col-sm-6">
          <div class="mb-3">
            <?php echo Form::label('country', __( 'business.country' ) . ':*'); ?>

              <?php echo Form::text('country', $location->country, ['class' => 'form-control', 'placeholder' => __( 'business.country'), 'required' ]); ?>

          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="mb-3">
            <?php echo Form::label('mobile', __( 'business.mobile' ) . ':'); ?>

            <?php echo Form::text('mobile', $location->mobile, ['class' => 'form-control', 'placeholder' => __( 'business.mobile')]); ?>

          </div>
        </div>
        <div class="col-sm-6">
          <div class="mb-3">
            <?php echo Form::label('alternate_number', __( 'business.alternate_number' ) . ':'); ?>

            <?php echo Form::text('alternate_number', $location->alternate_number, ['class' => 'form-control', 'placeholder' => __( 'business.alternate_number')]); ?>

          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="mb-3">
            <?php echo Form::label('email', __( 'business.email' ) . ':'); ?>

            <?php echo Form::email('email', $location->email, ['class' => 'form-control', 'placeholder' => __( 'business.email')]); ?>

          </div>
        </div>
        <div class="col-sm-6">
          <div class="mb-3">
            <?php echo Form::label('website', __( 'lang_v1.website' ) . ':'); ?>

            <?php echo Form::text('website', $location->website, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.website')]); ?>

          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
          <div class="mb-3">
            <?php echo Form::label('invoice_scheme_id', __('invoice.invoice_scheme') . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.invoice_scheme') . '"></i>';
                }
            ?>
              <?php echo Form::select('invoice_scheme_id', $invoice_schemes, $location->invoice_scheme_id, ['class' => 'form-control', 'required',
              'placeholder' => __('messages.please_select')]); ?>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="mb-3">
            <?php echo Form::label('loc_settings[quotation_scheme_id]', __('lang_v1.quotation_invoice_scheme') . ':'); ?>

              <?php echo Form::select('loc_settings[quotation_scheme_id]', $invoice_schemes, $location->loc_settings['quotation_scheme_id'], ['class' => 'form-control',
              'placeholder' => __('messages.please_select')]); ?>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="mb-3">
            <?php echo Form::label('invoice_layout_id', __('lang_v1.invoice_layout_for_pos') . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.invoice_layout') . '"></i>';
                }
            ?>
              <?php echo Form::select('invoice_layout_id', $invoice_layouts,  $location->invoice_layout_id, ['class' => 'form-control', 'required',
              'placeholder' => __('messages.please_select')]); ?>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="mb-3">
            <?php echo Form::label('sale_invoice_layout_id', __('lang_v1.invoice_layout_for_sale') . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.invoice_layout') . '"></i>';
                }
            ?>
              <?php echo Form::select('sale_invoice_layout_id', $invoice_layouts,  $location->sale_invoice_layout_id, ['class' => 'form-control', 'required',
              'placeholder' => __('messages.please_select')]); ?>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="mb-3">
            <?php echo Form::label('loc_settings[sale_return_layout_id]', __('lang_v1.invoice_layout_for_sale_return') . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.invoice_layout_for_sale_return_tooltip') . '"></i>';
                }
            ?>
              <?php echo Form::select('loc_settings[sale_return_layout_id]', $invoice_layouts, $location->loc_settings['sale_return_layout_id'], ['class' => 'form-control',
              'placeholder' => __('messages.please_select')]); ?>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="mb-3">
            <?php echo Form::label('loc_settings[quotation_layout_id]', __('lang_v1.invoice_layout_for_quotation') . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.invoice_layout_for_quotation_tooltip') . '"></i>';
                }
            ?>
              <?php echo Form::select('loc_settings[quotation_layout_id]', $invoice_layouts, $location->loc_settings['quotation_layout_id'], ['class' => 'form-control',
              'placeholder' => __('messages.please_select')]); ?>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="mb-3">
            <?php echo Form::label('loc_settings[purchase_layout_id]', __('lang_v1.invoice_layout_for_purchase') . ':*'); ?> 
            <?php echo Form::select('loc_settings[purchase_layout_id]', $invoice_layouts, $location->loc_settings['purchase_layout_id'], ['class' => 'form-control',
              'placeholder' => __('messages.please_select')]); ?>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="mb-3">
            <?php echo Form::label('loc_settings[purchase_order_layout_id]', __('lang_v1.invoice_layout_for_purchase_order') . ':*'); ?> 
            <?php echo Form::select('loc_settings[purchase_order_layout_id]', $invoice_layouts, $location->loc_settings['purchase_order_layout_id'], ['class' => 'form-control',
              'placeholder' => __('messages.please_select')]); ?>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="mb-3">
            <?php echo Form::label('selling_price_group_id', __('lang_v1.default_selling_price_group') . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.location_price_group_help') . '"></i>';
                }
            ?>
              <?php echo Form::select('selling_price_group_id', $price_groups, $location->selling_price_group_id, ['class' => 'form-control',
              'placeholder' => __('messages.please_select')]); ?>

          </div>
        </div>
        <div class="clearfix"></div>
        <?php
          $custom_labels = json_decode(session('business.custom_labels'), true);
          $location_custom_field1 = !empty($custom_labels['location']['custom_field_1']) ? $custom_labels['location']['custom_field_1'] : __('lang_v1.location_custom_field1');
          $location_custom_field2 = !empty($custom_labels['location']['custom_field_2']) ? $custom_labels['location']['custom_field_2'] : __('lang_v1.location_custom_field2');
          $location_custom_field3 = !empty($custom_labels['location']['custom_field_3']) ? $custom_labels['location']['custom_field_3'] : __('lang_v1.location_custom_field3');
          $location_custom_field4 = !empty($custom_labels['location']['custom_field_4']) ? $custom_labels['location']['custom_field_4'] : __('lang_v1.location_custom_field4');
        ?>
        <div class="col-sm-3">
        <div class="mb-3">
            <?php echo Form::label('custom_field1', $location_custom_field1 . ':'); ?>

            <?php echo Form::text('custom_field1', $location->custom_field1, ['class' => 'form-control', 
                'placeholder' => $location_custom_field1]); ?>

        </div>
      </div>
      <div class="col-sm-3">
        <div class="mb-3">
            <?php echo Form::label('custom_field2', $location_custom_field2 . ':'); ?>

            <?php echo Form::text('custom_field2', $location->custom_field2, ['class' => 'form-control', 
                'placeholder' => $location_custom_field2]); ?>

        </div>
      </div>
      <div class="col-sm-3">
        <div class="mb-3">
            <?php echo Form::label('custom_field3', $location_custom_field3 . ':'); ?>

            <?php echo Form::text('custom_field3', $location->custom_field3, ['class' => 'form-control', 
                'placeholder' => $location_custom_field3]); ?>

        </div>
      </div>
      <div class="col-sm-3">
        <div class="mb-3">
            <?php echo Form::label('custom_field4', $location_custom_field4 . ':'); ?>

            <?php echo Form::text('custom_field4', $location->custom_field4, ['class' => 'form-control', 
                'placeholder' => $location_custom_field4]); ?>

        </div>
      </div>
      <div class="clearfix"></div>
      <hr>
      <div class="col-sm-12">
        <div class="mb-3">
          <?php echo Form::label('featured_products', __('lang_v1.pos_screen_featured_products') . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.featured_products_help') . '"></i>';
                }
            ?>
          <?php echo Form::select('featured_products[]', $featured_products, $location->featured_products, ['class' => 'form-control', 'id' => 'featured_products', 'multiple']); ?>

        </div>
      </div>
      
      
          <div class="col-sm-12 payment-options">
            <strong><?php echo app('translator')->get('lang_v1.payment_options'); ?>: <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.payment_option_help') . '"></i>';
                }
            ?></strong>
            <div class="mb-3">
            <table class="table table-condensed table-striped">
              <thead>
                <tr>
                  <th class="text-center"><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                  <th class="text-center"><?php echo app('translator')->get('lang_v1.enable'); ?></th>
                  <th class="text-center <?php if(empty($accounts) || !empty($acc_accounts)): ?> hide <?php endif; ?>"><?php echo app('translator')->get('lang_v1.default_accounts'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.default_account_help') . '"></i>';
                }
            ?></th>
                  <th class="text-center <?php if(empty($acc_accounts)): ?> hide <?php endif; ?>"><?php echo app('translator')->get('lang_v1.default_accounts'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.default_account_help') . '"></i>';
                }
            ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $default_payment_accounts = !empty($location->default_payment_accounts) ?
                                      json_decode($location->default_payment_accounts, true) : [];
                ?>
                <?php $__currentLoopData = $payment_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td class="text-center">
                      <?php echo Form::text('loc_settings[payment_labels]['.$key.']', $value, ['class' => 'form-control', 'placeholder' => $value ]); ?>

                      
                    </td>
                    <td class="text-center"><?php echo Form::checkbox('default_payment_accounts[' . $key . '][is_enabled]', 1, !empty($default_payment_accounts[$key]['is_enabled'])); ?></td>
                    <?php if(!empty($accounts) && empty($acc_accounts)): ?>
                    <td class="text-center">
                      <?php echo Form::select('default_payment_accounts[' . $key . '][account]', $accounts, !empty($default_payment_accounts[$key]['account']) ? $default_payment_accounts[$key]['account'] : null, ['class' => 'form-control input-sm']); ?>

                    </td>
                    <?php endif; ?>
                    <?php if(!empty($acc_accounts)): ?>
                    <td class="text-center">
                      <?php echo Form::select('default_payment_accounts[' . $key . '][account]', $acc_accounts, !empty($default_payment_accounts[$key]['account']) ? $default_payment_accounts[$key]['account'] : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control accounts-dropdown input-sm']); ?>

                    </td>
                    <?php endif; ?>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
