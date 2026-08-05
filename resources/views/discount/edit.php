<?php
  $render_full_page = !empty($render_full_page);
?>

<?php if($render_full_page): ?>
<div class="box box-primary discount-page-form">
  <div class="box-body">
<?php else: ?>
<div class="modal-dialog" role="document">
  <div class="modal-content">
<?php endif; ?>

    <?php echo Form::open(['url' => action([\App\Http\Controllers\DiscountController::class, 'update'], [$discount->id]), 'method' => 'put', 'id' => 'discount_form' ]); ?>


    <?php if(!$render_full_page): ?>
    <div class="modal-header" style="position: sticky; top: 0; z-index: 1055; background: inherit;">
      <h4 class="modal-title"><?php echo app('translator')->get( 'sale.edit_discount' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
    </div>
    <?php endif; ?>

    <div class="<?php echo e($render_full_page ? 'box-body' : 'modal-body', false); ?>" <?php if(!$render_full_page): ?> style="max-height: 70vh; overflow-y: auto; overflow-x: auto;" <?php endif; ?>>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group mb-2">
            <?php echo Form::label('type', __('lang_v1.type') . ':*'); ?>

              <?php echo Form::select('type', ['product' => 'Product Based', 'invoice' => 'Invoice Based'], $discount->type, [ 'class' => 'form-control']); ?>

          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group mb-2">
            <?php echo Form::label('name', __( 'unit.name' ) . ':*'); ?>

              <?php echo Form::text('name', $discount->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'unit.name' ) ]); ?>

          </div>
        </div>
        <div class="col-md-12 product_fields <?php if($discount->type == 'invoice'): ?> hide <?php endif; ?>">
          <div class="form-group mb-2">
            <?php echo Form::label('variation_ids', __('report.products') . ':'); ?>

              <?php echo Form::select('variation_ids[]', $variations, array_keys($variations), ['id' => "variation_ids", 'class' => 'form-control', 'multiple']); ?>

          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group mb-2">
            <?php echo Form::label('customers', __('lang_v1.customers') . ':'); ?>

              <?php echo Form::select('customers[]', $customers, array_keys($customers), ['id' => "customer_ids", 'class' => 'form-control', 'multiple']); ?>

          </div>
        </div>
        <div class="col-md-6 product_fields <?php if(!session('business.enable_brand')): ?> hide <?php endif; ?> <?php if(!empty($variations)): ?> hide <?php endif; ?> <?php if($discount->type == 'invoice'): ?> hide <?php endif; ?>" id="brand_input">
          <div class="form-group mb-2">
            <?php ($selected_brand_ids = $discount->brands->pluck('id')->toArray()); ?>
            <?php ($selected_brand_ids = empty($selected_brand_ids) && !empty($discount->brand_id) ? [$discount->brand_id] : $selected_brand_ids); ?>
            <?php echo Form::label('brand_ids', __('product.brand') . ':'); ?>

              <?php echo Form::select('brand_ids[]', $brands, $selected_brand_ids, ['id' => 'brand_ids', 'class' => 'form-control select2', 'multiple', 'style' => 'width: 100%;']); ?>

          </div>
        </div>
        <div class="col-sm-6 product_fields <?php if(!session('business.enable_category')): ?> hide <?php endif; ?> <?php if(!empty($variations)): ?> hide <?php endif; ?> <?php if($discount->type == 'invoice'): ?> hide <?php endif; ?>" id="category_input">
          <div class="form-group mb-2">
            <?php echo Form::label('category_ids', __('product.category') . ':'); ?>

              <?php echo Form::select('category_ids[]', $categories, $discount->categories->pluck('id')->toArray(), ['id' => 'category_ids', 'class' => 'form-control select2', 'multiple', 'style' => 'width: 100%;']); ?>

          </div>
        </div>
        <div class="col-sm-6 product_fields <?php if(!session('business.enable_gender')): ?> hide <?php endif; ?> <?php if(!empty($variations)): ?> hide <?php endif; ?> <?php if($discount->type == 'invoice'): ?> hide <?php endif; ?>" id="gender_input">
          <div class="form-group mb-2">
            <?php echo Form::label('gender_ids', __('product.gender') . ':'); ?>

              <?php echo Form::select('gender_ids[]', $genders, $discount->genders->pluck('id')->toArray(), ['id' => 'gender_ids', 'class' => 'form-control select2', 'multiple', 'style' => 'width: 100%;']); ?>

          </div>
        </div>
        <div class="col-sm-6 product_fields <?php if(!session('business.enable_procurement_source')): ?> hide <?php endif; ?> <?php if(!empty($variations)): ?> hide <?php endif; ?> <?php if($discount->type == 'invoice'): ?> hide <?php endif; ?>" id="procurement_source_input">
          <div class="form-group mb-2">
            <?php echo Form::label('procurement_source_ids', __('product.procurement_source') . ':'); ?>

              <?php echo Form::select('procurement_source_ids[]', $procurement_sources, $discount->procurementSources->pluck('id')->toArray(), ['id' => 'procurement_source_ids', 'class' => 'form-control select2', 'multiple', 'style' => 'width: 100%;']); ?>

          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group mb-2">
            <?php echo Form::label('location_id', __('sale.location') . ':*'); ?>

              <?php echo Form::select('location_id', $locations, $discount->location_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'required']); ?>

          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-2">
            <?php echo Form::label('priority', __( 'lang_v1.priority' ) . ':'); ?>

              <?php echo Form::text('priority', $discount->priority, ['class' => 'form-control input_number', 'required', 'placeholder' => __( 'lang_v1.priority' ) ]); ?>

          </div>
        </div>
         <div class="col-sm-6">
          <div class="form-group mb-2">
            <?php echo Form::label('discount_type', __('sale.discount_type') . ':*'); ?>

              <?php echo Form::select('discount_type', ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage'), 'buy_for' => __('lang_v1.buy_for'), 'buy_for_unit_price' => __('lang_v1.buy_for_unit_price'), 'buy_get_free' => __('lang_v1.buy_get_free')], $discount->discount_type, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'required']); ?>

          </div>
        </div>
        <div class="col-md-6 <?php if(in_array($discount->discount_type, ['buy_for', 'buy_for_unit_price', 'buy_get_free'])): ?> hide <?php endif; ?>" id='default_discount_section'>
          <div class="form-group mb-2">
            <?php echo Form::label('discount_amount', __( 'sale.discount_amount' ) . ':*'); ?>

              <?php echo Form::text('discount_amount', number_format($discount->discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'required', 'placeholder' => __( 'sale.discount_amount' ) ]); ?>

          </div>
        </div>
        <div class="col-md-6 <?php if(!in_array($discount->discount_type, ['buy_for', 'buy_for_unit_price', 'buy_get_free'])): ?> hide <?php endif; ?>" id='buy_qty_div'>
          <div class="form-group mb-2">
              <?php echo Form::label('buy_qty', __( 'lang_v1.quantity' ) . ':*'); ?> 
              
              <?php echo Form::text('buy_qty', number_format($discount->buy_qty, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.quantity' ) ]); ?>

          </div>
        </div>

        <div class="col-md-6 <?php if(!in_array($discount->discount_type, ['buy_for', 'buy_for_unit_price'])): ?> hide <?php endif; ?>" id='buy_price_div'>
          <div class="form-group mb-2">
              <label for="buy_price" id="buy_price_label"><?php echo e($discount->discount_type == 'buy_for_unit_price' ? __('lang_v1.unit_price_label') : __('lang_v1.total_price'), false); ?>*</label>
              <?php echo Form::text('buy_price', number_format($discount->buy_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.total_price' ) ]); ?>

          </div>
        </div>
        <div class="col-md-6 <?php if(!in_array($discount->discount_type, ['buy_get_free'])): ?> hide <?php endif; ?>" id='buy_free_qty_div'>
          <div class="form-group mb-2">
              <?php echo Form::label('buy_free_qty', __( 'lang_v1.free_quantity' ) . ':*'); ?> 
              
              <?php echo Form::text('buy_free_qty', number_format($discount->buy_free_qty, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.free_quantity' ) ]); ?>

          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
          <div class="form-group mb-2">
            <?php echo Form::label('starts_at', __( 'lang_v1.start_date' ) . ':'); ?>

              <?php echo Form::text('starts_at', $starts_at, ['class' => 'form-control discount_date', 'placeholder' => __( 'lang_v1.starts_at' ), 'readonly' ]); ?>

          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-2">
            <?php echo Form::label('ends_at', __( 'lang_v1.end_date' ) . ':'); ?>

              <?php echo Form::text('ends_at', $ends_at, ['class' => 'form-control discount_date', 'placeholder' => __( 'lang_v1.ends_at' ), 'readonly' ]); ?>

          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-2">
            <?php echo Form::label('starts_at_time', __( 'lang_v1.start_time' ) . ':'); ?>

              <?php echo Form::text('starts_at_time', $starts_at_time, ['class' => 'form-control discount_time', 'placeholder' => __( 'lang_v1.start_time' ), 'readonly' ]); ?>

          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-2">
            <?php echo Form::label('ends_at_time', __( 'lang_v1.end_time' ) . ':'); ?>

              <?php echo Form::text('ends_at_time', $ends_at_time, ['class' => 'form-control discount_time', 'placeholder' => __( 'lang_v1.end_time' ), 'readonly' ]); ?>

          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group mb-2">
            <?php echo Form::label('discount_days', __('lang_v1.discount_days') . ':'); ?>

              <?php echo Form::select('discount_days[]', ['Monday'=>'Monday', 'Tuesday'=>'Tuesday', 'Wednesday'=>'Wednesday', 'Thursday'=>'Thursday', 'Friday'=>'Friday', 'Saturday'=>'Saturday', 'Sunday'=>'Sunday'], $discount->discount_days, ['id' => "discount_days", 'class' => 'form-control select2', 'multiple']); ?>

          </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-md-6 invoice_fields <?php if($discount->type == 'product'): ?> hide <?php endif; ?>">
          <div class="form-group mb-2">
              <?php echo Form::label('invoice_limit', __( 'lang_v1.discount_invoice_limit' ) . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.discount_invoice_limit_help') . '"></i>';
                }
            ?>
              <?php echo Form::text('invoice_limit', $discount->invoice_limit, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.discount_invoice_limit' ) ]); ?>

          </div>
        </div>
        <div class="col-md-6 invoice_fields <?php if($discount->type == 'product'): ?> hide <?php endif; ?>">
          <div class="form-group mb-2">
              <?php echo Form::label('usage_limit', __( 'lang_v1.discount_usage_limit' ) . ':'); ?>

              <?php echo Form::text('usage_limit', $discount->usage_limit, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.discount_usage_limit' ) ]); ?>

          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group mb-2">
            <?php echo Form::label('spg', __('lang_v1.selling_price_group') . ':'); ?>

            <select name="spg" class="form-control">
              <option value="" <?php if(is_null($discount->spg)): ?> selected <?php endif; ?>><?php echo app('translator')->get('lang_v1.all'); ?></option>
              <?php $__currentLoopData = $price_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($k, false); ?>" <?php if($discount->spg === (string)$k): ?> selected <?php endif; ?>><?php echo e($v, false); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="form-group mb-2">
            <label class="form-check-label">
<?php echo Form::checkbox('applicable_in_cg', 1, !empty($discount->applicable_in_cg), ['class' => 'form-check-input']); ?> <strong><?php echo app('translator')->get('lang_v1.applicable_in_cg'); ?></strong>
            </label>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group mb-2">
            <label class="form-check-label">
<?php echo Form::checkbox('is_active', 1, !empty($discount->is_active), ['class' => 'form-check-input']); ?> <strong><?php echo app('translator')->get('lang_v1.is_active'); ?></strong>
            </label>
          </div>
        </div>
        <div class="col-sm-6 product_fields <?php if($discount->type == 'invoice'): ?> hide <?php endif; ?>">
          <div class="form-group mb-2">
            <label class="form-check-label">
<?php echo Form::checkbox('is_combination', 1, !empty($discount->is_combination), ['class' => 'form-check-input']); ?> <strong>Combination Discount</strong>
            </label>
          </div>
        </div>

      </div>
    </div>

    <?php if(!$render_full_page): ?>
    <div class="modal-footer" style="position: sticky; bottom: 0; z-index: 1055; background: inherit;">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>
    <?php endif; ?>

    <?php echo Form::close(); ?>


  <?php if($render_full_page): ?>
  </div>
</div>
  <?php else: ?>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
  <?php endif; ?>
