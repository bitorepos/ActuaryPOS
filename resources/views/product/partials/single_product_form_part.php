<?php
    $common_settings = isset($common_settings) && ! empty($common_settings) ? $common_settings : (session()->get('business.common_settings') ?? []);
?>
<?php if(empty($common_settings['enable_prices'])): ?> 
  <?php
    $default = 0;
    $class = 'hide';
  ?>
<?php else: ?>
  <?php
    $default = "0.00";
    $class = '';
  ?>
<?php endif; ?>
<input type="hidden" id="is_changed" value="0">
<div class="table-responsive">
    <table class="table table-bordered add-product-price-table table-condensed table-th-skin <?php echo e($class, false); ?>">
        <tr>
          <th><?php echo app('translator')->get('product.default_purchase_price'); ?></th>
          <th><?php echo app('translator')->get('product.profit_percent'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.profit_percent') . '"></i>';
                }
            ?></th>
          <th><?php echo app('translator')->get('product.default_selling_price'); ?></th>
          <?php if(empty($quick_add)): ?>
            <th><?php echo app('translator')->get('lang_v1.product_image'); ?></th>
          <?php endif; ?>
        </tr>
        <tr>
          <td>
            <div class="row">
            <div class="col-sm-12">
              <?php echo Form::label('single_dpp', trans('product.exc_of_tax') . ':*', ['class' => !$has_taxes ? 'hidden' : '']); ?>

              <?php echo Form::text('single_dpp', $default, ['class' => 'form-control input-sm dpp input_number', 'placeholder' => __('product.exc_of_tax'), 'required']); ?>

            </div>

            <div class="col-sm-6 hidden">
              <?php echo Form::label('single_dpp_inc_tax', trans('product.inc_of_tax') . ':*'); ?>

            
              <?php echo Form::text('single_dpp_inc_tax', $default, ['class' => 'form-control input-sm dpp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required']); ?>

            </div>
          </div>
          </td>

          <td>
            <?php if($has_taxes): ?><br/><?php endif; ?>
            <?php echo Form::text('profit_percent', number_format($profit_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm input_number', 'id' => 'profit_percent', 'required']); ?>

          </td>

          <td>
            <div class="row">
            <div class="col-sm-12">
              <label class="<?php if(!$has_taxes): ?> hidden <?php endif; ?>">
                <span class="dsp_label"><?php echo app('translator')->get('product.exc_of_tax'); ?></span>
              </label>
              <?php echo Form::text('single_dsp', $default, ['class' => 'form-control input-sm dsp input_number', 'placeholder' => __('product.exc_of_tax'), 'id' => 'single_dsp', 'required']); ?>

              
            </div>
            <div class="col-sm-6 hidden">
              <label><span class="dsp_label"><?php echo app('translator')->get('product.inc_of_tax'); ?></span></label>
              
              <?php echo Form::text('single_dsp_inc_tax', $default, ['class' => 'form-control input-sm input_number', 'placeholder' => __('product.inc_of_tax'), 'id' => 'single_dsp_inc_tax', 'required']); ?>

            </div>
          </div>
          </td>
          <?php if(empty($quick_add)): ?>
          <td>
              <div class="mb-3">
                <?php echo Form::label('variation_images', __('lang_v1.product_image') . ':'); ?>

                <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.aspect_ratio_should_be_1_1'); ?>"></i>
                <?php echo Form::file('variation_images[]', ['class' => 'variation_images', 
                    'accept' => 'image/*', 'multiple']); ?>

              </div>
          </td>
          <?php endif; ?>
        </tr>
    </table>
</div>
