<?php $auth_user_settings = json_decode(auth()->user()->user_settings, true) ?? []; ?>
<div class="row">
  <div class="col-md-12">
    <?php if((empty($auth_user_settings['hide_all_details_before_register_closing']) || auth()->user()->hasRole('Admin#' . auth()->user()->business_id))): ?>
    <hr>
    <?php endif; ?>
    <h3><?php echo app('translator')->get('lang_v1.product_stock_details_register'); ?></h3>
    <table class="table table-condensed table-striped">
      <tr>
        <th>#</th>
        <th class="col-md-2"><?php echo app('translator')->get('product.sku'); ?></th>
        <th class="col-md-4"><?php echo app('translator')->get('sale.product'); ?></th>
        <?php if((empty($auth_user_settings['hide_all_details_before_register_closing']) || auth()->user()->hasRole('Admin#' . auth()->user()->business_id)) || $is_print): ?>
        <th class="col-md-2"><?php echo app('translator')->get('stock_adjustment.on_hand'); ?></th>
        <?php endif; ?>
        <th class="col-md-2"><?php echo app('translator')->get('stock_adjustment.counted'); ?></th>
        <?php if((empty($auth_user_settings['hide_all_details_before_register_closing']) || auth()->user()->hasRole('Admin#' . auth()->user()->business_id)) || $is_print): ?>
        <th class="col-md-2"><?php echo app('translator')->get('stock_adjustment.difference'); ?></th>
        <?php endif; ?>
      </tr>
      <?php $__currentLoopData = $details['product_stock_details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td>
            <?php echo e($loop->iteration, false); ?>.
          </td>
          <td>
            <?php echo e($detail->sku, false); ?>

          </td>
          <td>
            <?php echo e($detail->product_name, false); ?>

            <?php if($detail->type == 'variable'): ?>
             <?php echo e($detail->product_variation_name, false); ?> - <?php echo e($detail->variation_name, false); ?>

            <?php endif; ?>
          </td>
          <?php if($register_details->status != 'close'): ?>
            <?php if((empty($auth_user_settings['hide_all_details_before_register_closing']) || auth()->user()->hasRole('Admin#' . auth()->user()->business_id))): ?>
            <td>
              <?php echo e(number_format($detail->qty_on_hand, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            </td>
            <?php endif; ?>
            <td>
              <?php echo Form::hidden('stock_details['.$detail->v_id.'][on_hand]', $detail->qty_on_hand, ['class' => 'register_stock_on_hand']); ?>

              <?php echo Form::number('stock_details['.$detail->v_id.'][counted]', number_format(0, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control register_stock_counted']); ?>

              <?php echo Form::hidden('stock_details['.$detail->v_id.'][difference]', 0, ['class' => 'register_stock_difference']); ?>

            </td>
            <?php if((empty($auth_user_settings['hide_all_details_before_register_closing']) || auth()->user()->hasRole('Admin#' . auth()->user()->business_id))): ?>
            <td><span class="register_stock_difference_span"><?php echo e(number_format(0, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></td>
            <?php endif; ?>
          <?php else: ?>
          <?php
          $on_hand = !empty($register_details->stock_details[$detail->v_id]['on_hand']) ? $register_details->stock_details[$detail->v_id]['on_hand'] : 0;
          $counted = !empty($register_details->stock_details[$detail->v_id]['counted']) ? $register_details->stock_details[$detail->v_id]['counted'] : 0;
          $difference = !empty($register_details->stock_details[$detail->v_id]['difference']) ? $register_details->stock_details[$detail->v_id]['difference'] : 0;
          ?>
            <?php if((empty($auth_user_settings['hide_all_details_before_register_closing']) || auth()->user()->hasRole('Admin#' . auth()->user()->business_id)) || $is_print): ?>
            <td><?php echo e(number_format($on_hand, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
            <?php endif; ?>
            <td><?php echo e(number_format($counted, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
            <?php if((empty($auth_user_settings['hide_all_details_before_register_closing']) || auth()->user()->hasRole('Admin#' . auth()->user()->business_id)) || $is_print): ?>
            <td><?php echo e(number_format($difference, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
            <?php endif; ?>
          <?php endif; ?>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
  </div>
</div>
