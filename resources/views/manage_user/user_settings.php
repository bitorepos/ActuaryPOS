

<?php $__env->startSection('title', __( 'user.edit_user_settings' )); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e($user->user_full_name, false); ?> - <?php echo app('translator')->get( 'user.user_settings' ); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <?php echo Form::open(['url' => action([\App\Http\Controllers\ManageUserController::class, 'postUserSettings'], [$user->id]), 'method' => 'POST', 'id' => 'edit_user_settings_form']); ?>

    <div class="container-fluid">
        
        <div class="row pos-tab-container">
          <div class="col-2 pos-tab-menu">
              <div class="list-group">
                  <a href="#" class="list-group-item text-center active"><?php echo app('translator')->get( 'lang_v1.interface'); ?></a>
                  <a href="#" class="list-group-item text-center"><?php echo app('translator')->get( 'contact.contacts'); ?></a>
                  <a href="#" class="list-group-item text-center"><?php echo app('translator')->get( 'sale.pos_sale' ); ?></a>
                  <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('sale.sale'); ?></a>
                  <a href="#" class="list-group-item text-center"><?php echo app('translator')->get( 'product.products'); ?></a>
                  <a href="#" class="list-group-item text-center"><?php echo app('translator')->get( 'purchase.purchase'); ?></a>
                  <a href="#" class="list-group-item text-center"><?php echo app('translator')->get( 'lang_v1.expense'); ?></a>
                  <a href="#" class="list-group-item text-center"><?php echo app('translator')->get( 'stock_adjustment.stock_adjustment'); ?></a>
                  <a href="#" class="list-group-item text-center"><?php echo app('translator')->get( 'lang_v1.stock_transfers'); ?></a>
              </div>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-10 col-10 pos-tab">
             
            <div class="pos-tab-content active">
              <div class="row">
                <div class="col-md-4">
                  <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                  $biz_locations[$location->id] = $location->name;
                  ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="mb-3">
                        <?php echo Form::label('default_location', 'Default Location'); ?>

                        <?php echo Form::select('user_settings[default_location]', 
                        $biz_locations, !empty($user->user_settings['default_location']) ? $user->user_settings['default_location'] : null, 
                        ['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder'=> 'Please Select']); ?>

                    </div>
                </div>
                
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('user_settings[enable_delete_fbr_sale]', 1,
                            !empty($user->user_settings['enable_delete_fbr_sale']) ? true : false,
                            [ 'class' => 'form-check-input']); ?>  Enable Delete FBR Sales 
                        </label>
                        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.enable_delete_fbr_sale') . '"></i>';
                }
            ?>
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('user_settings[enable_reset_accounting_data]', 1,
                            !empty($user->user_settings['enable_reset_accounting_data']) ? true : false,
                            [ 'class' => 'form-check-input']); ?>  Enable Reset Accounting Data 
                        </label>
                        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.enable_delete_fbr_sale') . '"></i>';
                }
            ?>
                    </div>
                  </div>
              </div>
            </div>
            
            <div class="pos-tab-content">
              <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-info">
                    <i class="fas fa-info-circle me-1"></i> Merchants column visibility settings have been moved to <strong>User Profile > Indexes Column Visibility</strong>.
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[disable_contact_payment_date]', 1,
                            !empty($user->user_settings['disable_contact_payment_date']) ? true : false ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_contact_payment_date' ), false); ?>

                      </label>
                  </div>
                </div>
                </div>  
            </div>
            
            <div class="pos-tab-content">
              
              <div class="row">
                <div class="col-sm-4">

                  <div class="mb-3">
                      <div class="form-check">
                          
                          <label class="form-check-label">
<?php echo Form::checkbox('user_settings[enable_transaction_date]', 1 , !empty($user->user_settings['enable_transaction_date']) ? true : false,
                              [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_pos_transaction_date' ), false); ?>

                          </label>
                      </div>
                  </div>
                  <div class="mb-3">
                      <div class="form-check">
                          
                          <label class="form-check-label">
<?php echo Form::checkbox('user_settings[hide_recent_trans]', 1 , !empty($user->user_settings['hide_recent_trans']) ? true : false,
                              [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_recent_trans' ), false); ?>

                          </label>
                      </div>
                  </div>
                  <div class="mb-3">
                      <div class="form-check">
                          
                          <label class="form-check-label">
<?php echo Form::checkbox('user_settings[disable_recent_transaction_total]', 1 , !empty($user->user_settings['disable_recent_transaction_total']) ? true : false,
                              [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_recent_transaction_total' ), false); ?>

                          </label>
                      </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="mb-3">
                      <div class="form-check">
                          
                          <label class="form-check-label">
<?php echo Form::checkbox('user_settings[total_invoice_discount_field_readonly]', 1 , !empty($user->user_settings['total_invoice_discount_field_readonly']) ? true : false,
                              [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.total_invoice_discount_field_readonly' ), false); ?>

                          </label>
                      </div>
                  </div>
                  <div class="mb-3">
                      <div class="form-check">
                          <label class="form-check-label">
<?php echo Form::checkbox('user_settings[pos_show_total_profit]', 1 , !empty($user->user_settings['pos_show_total_profit']) ? true : false,
                              [ 'class' => 'form-check-input']); ?> Show Total Profit
                          </label>
                      </div>
                  </div>
                  <div class="mb-3">
                      <div class="form-check">
                          <label class="form-check-label">
<?php echo Form::checkbox('user_settings[allow_open_cash_drawer]', 1 , !empty($user->user_settings['allow_open_cash_drawer']) ? true : false,
                              [ 'class' => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.allow_open_cash_drawer'); ?>
                          </label>
                      </div>
                  </div>
                </div>
              </div>
              <hr>
              <h4><?php echo app('translator')->get('cash_register.cash_register'); ?></h4>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[hide_all_details_before_register_closing]', 1,
                          !empty($user->user_settings['hide_all_details_before_register_closing']) ? true : false,
                          [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_all_details_before_register_closing' ), false); ?>

                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[show_all_details_after_register_closed_print]', 1,
                          !empty($user->user_settings['show_all_details_after_register_closed_print']) ? true : false,
                          [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.show_all_details_after_register_closed_print' ), false); ?>

                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[view_product_sold_details_register]', 1,
                          !empty($user->user_settings['view_product_sold_details_register']) ? true : false,
                          [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_product_sold_details_register' ), false); ?>

                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[view_product_stock_details_register]', 1,
                          !empty($user->user_settings['view_product_stock_details_register']) ? true : false,
                          [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_product_stock_details_register' ), false); ?>

                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[view_expense_details_register]', 1,
                          !empty($user->user_settings['view_expense_details_register']) ? true : false,
                          [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_expense_details_register' ), false); ?>

                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[view_paid_purchase_details_register]', 1,
                          !empty($user->user_settings['view_paid_purchase_details_register']) ? true : false,
                          [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.view_paid_purchase_details_register' ), false); ?>

                      </label>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="pos-tab-content">
                <div class="row">
              <div class="col-md-9">
                  <div class="row">
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[sale_show_brand_column]', 1,
                          !empty($user->user_settings['sale_show_brand_column']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Enable Brand
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[sale_show_category_column]', 1,
                          !empty($user->user_settings['sale_show_category_column']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Enable Category
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('user_settings[enable_sale_transaction_date]', 1,
                              !empty($user->user_settings['enable_sale_transaction_date']) ? true : false ,
                              [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_pos_transaction_date' ), false); ?>

                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('user_settings[enable_sale_invoice_no]', 1,
                              !empty($user->user_settings['enable_sale_invoice_no']) ? true : false ,
                              [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_sale_invoice_no' ), false); ?>

                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[disable_sale_payment_date]', 1,
                            !empty($user->user_settings['disable_sale_payment_date']) ? true : false ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_sale_payment_date' ), false); ?>

                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[commission_agent_readonly]', 1,
                            !empty($user->user_settings['commission_agent_readonly']) ? true : false ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.commission_agent_readonly' ), false); ?>

                      </label>
                  </div>
              </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[warn_if_sale_price_low]', 1,
                            !empty($user->user_settings['warn_if_sale_price_low']) ? true : false,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.warn_if_sale_price_low' ), false); ?>

                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[block_if_sale_price_low]', 1,
                            !empty($user->user_settings['block_if_sale_price_low']) ? true : false,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.block_if_sale_price_low' ), false); ?>

                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[enable_inline_cost_sales]', 1,
                            !empty($user->user_settings['enable_inline_cost_sales']) ? true : false,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_inline_cost_sales' ), false); ?>

                      </label>
                  </div>
                </div> 
                  </div><!-- /.row -->
              </div>
                </div><!-- /.row -->

              <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-info">
                    <i class="fas fa-info-circle me-1"></i> Sales Index Column Visibility settings have been moved to <strong>User Profile > Indexes Column Visibility</strong>.
                  </div>
                </div>
              </div>
              
              <div class="row">
                <?php if(!empty(session('business.common_settings.enable_drugs_class'))): ?>
                <div class="col-md-3">
                  <div class="form-group mb-2">
                      <?php echo Form::label('drug_classes', __('product.drugs_class') . ':'); ?>

                      <?php echo Form::select('user_settings[drug_classes][]', $drug_classes, $user->user_settings['drug_classes'], [
                      'class' => 'form-control select2',
                      'multiple',
                      'id' => 'drug_classes',
                      ]); ?>

                  </div>
                </div>
                <?php endif; ?>
              </div>
            </div>
            
            
            <div class="pos-tab-content">
              <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-info">
                    <i class="fas fa-info-circle me-1"></i> Products Index Column Visibility settings have been moved to <strong>User Profile > Indexes Column Visibility</strong>.
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <h4>Product Search Screen Columns</h4>
              </div>
              <div class="col-md-9">
                  <div class="row">
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[ps_show_other_name]', 1,
                          !empty($user->user_settings['ps_show_other_name']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Show Other Name
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[ps_show_category]', 1,
                          !empty($user->user_settings['ps_show_category']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Show Category
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[ps_show_brand]', 1,
                          !empty($user->user_settings['ps_show_brand']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Show Brand 
                      </label>
                  </div>
              </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('user_settings[ps_show_selling_price]', 1,
                            !empty($user->user_settings['ps_show_selling_price']) ? true : false,
                            [ 'class' => 'form-check-input']); ?>  Show Selling Price 
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[ps_show_purchase_price]', 1,
                          !empty($user->user_settings['ps_show_purchase_price']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Show Purchase Price 
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[ps_show_price_inclusive]', 1,
                          !empty($user->user_settings['ps_show_price_inclusive']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Show Price Inclusive
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[ps_show_stock_quantity]', 1,
                          !empty($user->user_settings['ps_show_stock_quantity']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Show Stock Quantity 
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[ps_show_location_quantity]', 1,
                          !empty($user->user_settings['ps_show_location_quantity']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Show Locations Quantity
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[ps_show_rack_details]', 1,
                          !empty($user->user_settings['ps_show_rack_details']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Show Rack Details 
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[ps_show_custom_field1]', 1,
                          !empty($user->user_settings['ps_show_custom_field1']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Show Custom Field 1 
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[ps_show_custom_field2]', 1,
                          !empty($user->user_settings['ps_show_custom_field2']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Show Custom Field 2 
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[ps_show_custom_field3]', 1,
                          !empty($user->user_settings['ps_show_custom_field3']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Show Custom Field 3 
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[ps_show_custom_field4]', 1,
                          !empty($user->user_settings['ps_show_custom_field4']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Show Custom Field 4 
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[ps_show_supplier]', 1,
                          !empty($user->user_settings['ps_show_supplier']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Show Supplier 
                      </label>
                  </div>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[ps_show_price_group]', 1,
                          !empty($user->user_settings['ps_show_price_group']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Access Selling Price Groups 
                      </label>
                  </div>
                </div>
                <?php if(count($selling_price_groups) > 0): ?>
                  <?php $__currentLoopData = $selling_price_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selling_price_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-md-4">
                      <div class="form-check">
                          <label class="form-check-label">
<?php echo Form::checkbox('user_settings[selling_price_group_'.$selling_price_group->id.']', 1, 
                              !empty($user->user_settings['selling_price_group_'. $selling_price_group->id]) ? true : false,
                              [ 'class' => 'form-check-input']); ?> Show <?php echo e($selling_price_group->name, false); ?>

                          </label>
                      </div>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                  </div><!-- /.row -->
              </div>
              </div>  
            </div>
            
            
            <div class="pos-tab-content">
              <div class="row">
                <div class="col-md-3">
                  <h4>Purchase Screen Columns</h4>
              </div>
              <div class="col-md-9">
                  <div class="row">
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[purchase_show_brand_column]', 1,
                          !empty($user->user_settings['purchase_show_brand_column']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Enable Brand
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[purchase_show_category_column]', 1,
                          !empty($user->user_settings['purchase_show_category_column']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Enable Category
                      </label>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group mb-2">
                      <div class="form-check">
                          <label class="form-check-label">
<?php echo Form::checkbox('user_settings[enable_purchase_transaction_date]', 1,
                              !empty($user->user_settings['enable_purchase_transaction_date']) ? true : false ,
                              [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_pos_transaction_date' ), false); ?>

                          </label>
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('user_settings[enable_purchase_transaction_no]', 1,
                              !empty($user->user_settings['enable_purchase_transaction_no']) ? true : false ,
                              [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_purchase_transaction_no' ), false); ?>

                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[disable_purchase_payment_date]', 1,
                            !empty($user->user_settings['disable_purchase_payment_date']) ? true : false ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_purchase_payment_date' ), false); ?>

                      </label>
                  </div>
                </div>
                  </div><!-- /.row -->
              </div>
              </div>
            </div>

            
            <div class="pos-tab-content">
              <div class="row">
                <div class="col-md-4">
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('user_settings[enable_expense_transaction_date]', 1,
                              !empty($user->user_settings['enable_expense_transaction_date']) ? true : false ,
                              [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_pos_transaction_date' ), false); ?>

                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('user_settings[enable_expense_transaction_no]', 1,
                              !empty($user->user_settings['enable_expense_transaction_no']) ? true : false ,
                              [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_expense_transaction_no' ), false); ?>

                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[disable_expense_payment_date]', 1,
                            !empty($user->user_settings['disable_expense_payment_date']) ? true : false ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.disable_expense_payment_date' ), false); ?>

                      </label>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="pos-tab-content">
              <div class="row">
                <div class="col-md-3">
                  <h4>Product Row Columns</h4>
                </div>
              <div class="col-md-9">
                  <div class="row">
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[stock_adjustment_show_brand_column]', 1,
                          !empty($user->user_settings['stock_adjustment_show_brand_column']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Enable Brand
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[stock_adjustment_show_category_column]', 1,
                          !empty($user->user_settings['stock_adjustment_show_category_column']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Enable Category
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('user_settings[stock_adjustment_show_price_column]', 1,
                          !empty($user->user_settings['stock_adjustment_show_price_column']) ? true : false,
                          [ 'class' => 'form-check-input']); ?>  Enable Unit Price & Subtotal
                      </label>
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('user_settings[enable_stock_adjustment_transaction_date]', 1,
                              !empty($user->user_settings['enable_stock_adjustment_transaction_date']) ? true : false ,
                              [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_pos_transaction_date' ), false); ?>

                        </label>
                    </div>
                </div> 
                  </div><!-- /.row -->
              </div>
              </div>
            </div>

            
            <div class="pos-tab-content">
              <div class="row">
                <div class="col-md-3">
                  <h4>Product Row Columns</h4>
                </div>
                <div class="col-md-9">
                    <div class="row">
                  <div class="col-md-4">
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('user_settings[stock_transfer_show_brand_column]', 1,
                            !empty($user->user_settings['stock_transfer_show_brand_column']) ? true : false,
                            [ 'class' => 'form-check-input']); ?>  Enable Brand
                        </label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('user_settings[stock_transfer_show_category_column]', 1,
                            !empty($user->user_settings['stock_transfer_show_category_column']) ? true : false,
                            [ 'class' => 'form-check-input']); ?>  Enable Category
                        </label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('user_settings[stock_transfer_show_price_column]', 1,
                            !empty($user->user_settings['stock_transfer_show_price_column']) ? true : false,
                            [ 'class' => 'form-check-input']); ?>  Enable Unit Price & Subtotal
                        </label>
                    </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-check">
                          <label class="form-check-label">
<?php echo Form::checkbox('user_settings[enable_stock_transfer_transaction_date]', 1,
                                !empty($user->user_settings['enable_stock_transfer_transaction_date']) ? true : false ,
                                [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_pos_transaction_date' ), false); ?>

                          </label>
                      </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('user_settings[stock_transfer_status_readonly]', 1,
                              !empty($user->user_settings['stock_transfer_status_readonly']) ? true : false ,
                              [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.stock_transfer_status_readonly' ), false); ?>

                        </label>
                    </div>
                  </div> 
                  <div class="col-md-4">
                      <div class="form-group mb-2">
                        <?php echo Form::label('stock_transfer_default_status', __('lang_v1.stock_transfer_default_status') . ':*'); ?>

                        <?php echo Form::select('user_settings[stock_transfer_default_status]', ['pending' => __('lang_v1.pending'),'in_transit' => __('lang_v1.in_transit'),'completed' => __('restaurant.completed'),], $user->user_settings['stock_transfer_default_status'],
                      [ 'class' => 'form-control', 'placeholder' => 'Please Select']); ?>

                      
                    </div>
                  </div>

                    </div><!-- /.row -->
                </div>
              </div>
            </div>

          </div>
        </div>
        
    </div>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    //
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>