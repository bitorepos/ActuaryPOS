<?php if($format != 'format_4'): ?>
<table class="table table-slim mb-0 bg-light-skin" <?php if(!empty($for_pdf)): ?> style="width: 100%;" <?php endif; ?>>
        <tr>
          <th width="2%">#</th>
          <th width="25%"><?php echo app('translator')->get('sale.product'); ?></th>
          <th width="6%" class="align-right"><?php echo e(__('sale.qty'), false); ?></th>
          <th width="4%" class="align-right"><?php echo e(__('sale.unit_price'), false); ?></th>
          <th width="5%" class="align-right"><?php echo app('translator')->get( 'lang_v1.discount_percent' ); ?></th>
          <th width="5%" class="align-right"><?php echo app('translator')->get('sale.tax'); ?></th>
          <th width="5%" class="align-right"><?php echo e(__('sale.price_inc_tax'), false); ?></th>
          <th width="5%" class="align-right"><?php echo app('translator')->get('sale.subtotal'); ?></th>
          
        </tr>
  <?php $__currentLoopData = $purchase->purchase_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td><?php echo e($loop->iteration, false); ?></td>
      <td>
        <?php echo e($purchase_line->product->name, false); ?>

         <?php if( $purchase_line->product->type == 'variable'): ?>
          - <?php echo e($purchase_line->variations->product_variation->name, false); ?>

          - <?php echo e($purchase_line->variations->name, false); ?>

         <?php endif; ?>
         - <?php echo e($purchase_line->variations->sub_sku ?? '', false); ?>

         <?php $_lpld_cs = isset($common_settings) && is_array($common_settings) ? $common_settings : (session()->get('business.common_settings') ?? []); ?>
         <?php if(!empty($purchase_line->lot_number)): ?> <br> <?php echo e($_lpld_cs['lot_number_label'] ?? '', false); ?> - <?php echo e($purchase_line->lot_number ?? '', false); ?> <?php endif; ?>
      </td>
      <?php if($purchase->type == 'Purchase'): ?>
      <td class="ws-nowrap align-right">
        <?php echo e(number_format($purchase_line->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php if(!empty($purchase_line->sub_unit)): ?> <?php echo e($purchase_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($purchase_line->product->unit->short_name, false); ?> <?php endif; ?>
      </td>
      <?php else: ?>
      <td class="ws-nowrap align-right">
        <?php echo e(number_format($purchase_line->quantity_returned, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php if(!empty($purchase_line->sub_unit)): ?> <?php echo e($purchase_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($purchase_line->product->unit->short_name, false); ?> <?php endif; ?>
      </td>
      <?php endif; ?>
      <td class="ws-nowrap align-right"><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $purchase_line->pp_without_discount, session("business.cost_decimal", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);
            echo $formated_number; ?></td>
      <td class="ws-nowrap align-right"><?php echo e(number_format($purchase_line->discount_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> %</td>
      <td class="ws-nowrap align-right"><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $purchase_line->item_tax, session("business.cost_decimal", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);
            echo $formated_number; ?></td>
      <td class="ws-nowrap align-right"><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $purchase_line->purchase_price_inc_tax, session("business.cost_decimal", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);
            echo $formated_number; ?></span></td>
      <?php if($purchase->type == 'Purchase'): ?>
      <td class="ws-nowrap align-right"><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $purchase_line->purchase_price_inc_tax * $purchase_line->quantity, session("business.cost_decimal", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);
            echo $formated_number; ?></td>
      <?php else: ?>
      <td class="ws-nowrap align-right"><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $purchase_line->purchase_price_inc_tax * $purchase_line->quantity_returned, session("business.cost_decimal", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);
            echo $formated_number; ?></td>
      <?php endif; ?>
      
    </tr>
    <?php
      if($purchase->type == 'Purchase'){
        $total_qty += $purchase_line->quantity;
      }else{
        $total_qty += $purchase_line->quantity_returned;
      }
      $qty_unit = !empty($purchase_line->sub_unit) ? $purchase_line->sub_unit->short_name : $purchase_line->product->unit->short_name;
    ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <td></td>
    <td></td>
    <td class="ws-nowrap align-right">
      <b>Total Qty:</b> 
      <?php echo e($total_qty, false); ?> <?php echo e($qty_unit, false); ?>

    </td>
  </tr>

</table>
<?php else: ?>
  <div style="padding-top:5px">
    <strong>Product Details: </strong>
    <?php $__currentLoopData = $purchase->purchase_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if(!$loop->first): ?>
        <?php echo e(', ', false); ?>

      <?php endif; ?>
      (
      <?php echo e($purchase_line->product->name, false); ?>

      <?php if( $purchase_line->product->type == 'variable'): ?>
        - <?php echo e($purchase_line->variations->product_variation->name, false); ?>

        - <?php echo e($purchase_line->variations->name, false); ?>

      <?php endif; ?>
      - <?php echo e($purchase_line->variations->sub_sku ?? '', false); ?>

      <?php if($purchase->type == 'Purchase'): ?>
      - <?php echo e(number_format($purchase_line->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php if(!empty($purchase_line->sub_unit)): ?> <?php echo e($purchase_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($purchase_line->product->unit->short_name, false); ?> <?php endif; ?>
        <?php if(!empty($purchase_line->secondary_unit_quantity)): ?>
          - <?php echo e(number_format($purchase_line->secondary_unit_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($purchase_line->product->second_unit->short_name, false); ?>

        <?php endif; ?>
      <?php else: ?>
      - <?php echo e(number_format($purchase_line->quantity_returned, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php if(!empty($purchase_line->sub_unit)): ?> <?php echo e($purchase_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($purchase_line->product->unit->short_name, false); ?> <?php endif; ?>
      <?php endif; ?>
      - <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $purchase_line->purchase_price_inc_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
      )
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
<?php endif; ?>
