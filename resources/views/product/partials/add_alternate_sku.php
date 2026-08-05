<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <?php echo Form::open(['url' => action([\App\Http\Controllers\ProductController::class, 'postCreateAlternateSku']), 'method' => 'post', 'id' => 'add_alternate_sku_form' ]); ?>

  
      <div class="modal-header">
        <h4 class="modal-title">Add Alternate Sku</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   
      </div>
  
      <div class="modal-body">

        <span class="visually-hidden" id="dummy">
          <table>
            <tbody>
              <tr>
                <td>
                     <div class="mb-3">
                         <input name="alternate_sku[0][id]" type="hidden" value="">
                         <input name="alternate_sku[0][product_id]" type="hidden" value="<?php echo e($product_id, false); ?>">
                         <input class="form-control sku" placeholder="SKU" name="alternate_sku[0][sku]" type="text" value="0">
                     </div>
                </td>
                <td>
                     <div class="mb-3">
                         <input class="form-control" id="pp_exc_tax" placeholder="Exc Tax : 100" name="alternate_sku[0][pp_exc_tax]" type="text" value="">
                     </div>
                     <div class="mb-3">
                         <input class="form-control" id="pp_inc_tax" placeholder="Inc Tax : 110" name="alternate_sku[0][pp_inc_tax]" type="text" value="">
                     </div>
                </td>
                <td>
                     <div class="mb-3">
                         <input class="form-control" id="profit_margin" placeholder="25" name="alternate_sku[0][profit_margin]" type="text" value="<?php echo e(number_format($default_profit_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
                     </div>
                </td>
                <td>
                     <div class="mb-3">
                         <input class="form-control" id="sp_exc_tax" placeholder="Exc Tax : 125" name="alternate_sku[0][sp_exc_tax]" type="text" value="">
                     </div>
                     <div class="mb-3">
                         <input class="form-control" id="sp_inc_tax" placeholder="Inc Tax : 137.50" name="alternate_sku[0][sp_inc_tax]" type="text" value="">
                     </div>
                </td>
                <td></td>
             </tr>
            </tbody>
          </table>
        </span>

        <input type="hidden" id="product_tax_type" value="<?php echo e($tax->tax_type, false); ?>">
        <input type="hidden" id="tax_amount" value="<?php echo e($tax->amount, false); ?>">
        <input type="hidden" id="tax_type" value="<?php echo e($tax->type, false); ?>">
        <div class="table-responsive">
        <table class="table table-striped table-th-skin" id="sub_sku_table">
            <thead>
                <tr>
                    <th>SKU</th>
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
                    <th>
                        <button type="button" class="btn btn-primary btn-sm add_sub_sku_row" data-row-count="<?php echo e(count($alternate_skus)-1, false); ?>"><i class="fa fa-plus"></i></button> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.add_sku_row') . '"></i>';
                }
            ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $alternate_skus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alt_sku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                         <div class="mb-3">
                             <?php echo Form::hidden('alternate_sku['.$loop->index.'][id]', $alt_sku->id,); ?>

                             <?php echo Form::hidden('alternate_sku['.$loop->index.'][product_id]', $product_id,); ?>

                             <?php echo Form::text('alternate_sku['.$loop->index.'][sku]', $alt_sku->sub_sku, ['class' => 'form-control sku', 'placeholder' => __('product.sku')]); ?>

                         </div>
                    </td>
                    <td>
                         <div class="mb-3">
                             <?php echo Form::text('alternate_sku['.$loop->index.'][pp_exc_tax]', number_format($alt_sku->default_purchase_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control', 'id'=> 'pp_exc_tax', 'placeholder' => 'Exc Tax : 100']); ?>

                         </div>
                         <div class="mb-3">
                             <?php echo Form::text('alternate_sku['.$loop->index.'][pp_inc_tax]', number_format($alt_sku->dpp_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control', 'id'=> 'pp_inc_tax', 'placeholder' => 'Inc Tax : 110']); ?>

                         </div>
                    </td>
                    <td>
                         <div class="mb-3">
                             <?php echo Form::text('alternate_sku['.$loop->index.'][profit_margin]', number_format($alt_sku->profit_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control', 'id'=> 'profit_margin', 'placeholder' => '25']); ?>

                         </div>
                    </td>
                    <td>
                         <div class="mb-3">
                             <?php echo Form::text('alternate_sku['.$loop->index.'][sp_exc_tax]', number_format($alt_sku->default_sell_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control', 'id'=> 'sp_exc_tax', 'placeholder' => 'Exc Tax : 125']); ?>

                         </div>
                         <div class="mb-3">
                             <?php echo Form::text('alternate_sku['.$loop->index.'][sp_inc_tax]', number_format($alt_sku->sell_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control', 'id'=> 'sp_inc_tax', 'placeholder' => 'Inc Tax : 137.50']); ?>

                         </div>
                    </td>
                    <td></td>
                 </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <tr id="empty_row" class="text-center">
                    <td colspan="5">No Alternate SKU Exist</td>
                  </tr>
                <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
  
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
        <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
      </div>
  
      <?php echo Form::close(); ?>

  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
