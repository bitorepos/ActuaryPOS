<div class="modal-dialog modal-xl no-print" role="document">
  <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title" id="modalTitle"> <?php echo app('translator')->get('lang_v1.sell_return'); ?> (<b><?php echo app('translator')->get('sale.invoice_no'); ?>:</b> <?php echo e($sell->return_parent->invoice_no, false); ?>)
    </h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
</div>
<div class="modal-body">
   <?php
     $custom_labels = json_decode(session('business.custom_labels'), true) ?? [];
     // Invoice layout name
     if (!empty($sell->invoice_layout)) {
         $sr_layout_name = $sell->invoice_layout->name;
     } elseif (!empty($sell->location)) {
         $fallback_id = $sell->location->sale_invoice_layout_id ?? $sell->location->invoice_layout_id;
         $sr_layout_name = $fallback_id ? \App\InvoiceLayout::where('id', $fallback_id)->value('name') : null;
     } else {
         $sr_layout_name = null;
     }
   ?>
   <div class="row">
      <div class="col-sm-4 col-12">
        <h4><?php echo app('translator')->get('lang_v1.sell_return_details'); ?>:</h4>
        <strong><?php echo app('translator')->get('lang_v1.return_date'); ?>:</strong> <?php echo e(\Carbon::createFromTimestamp(strtotime($sell->return_parent->transaction_date))->format(session('business.date_format')), false); ?><br>
        <strong><?php echo app('translator')->get('contact.customer'); ?>:</strong> <?php echo e($sell->contact->name, false); ?>

        <?php if(!empty($sell->contact->tax_number)): ?>
          <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($sell->contact->tax_number, false); ?>

        <?php endif; ?>
        <br><strong><?php echo app('translator')->get('purchase.business_location'); ?>:</strong> <?php echo e($sell->location->name, false); ?>

        <?php if(!empty($sell->pay_term_number)): ?>
          <br><strong><?php echo app('translator')->get('contact.pay_term'); ?>:</strong> <?php echo e($sell->pay_term_number, false); ?> <?php echo e(__('lang_v1.' . ($sell->pay_term_type ?? 'days')), false); ?>

        <?php endif; ?>
        <?php if(!empty($sell->sale_commission_agent)): ?>
          <br><strong><?php echo app('translator')->get('lang_v1.commission_agent'); ?>:</strong> <?php echo e($sell->sale_commission_agent->user_full_name ?? '', false); ?>

        <?php endif; ?>
        <?php if(!empty($sr_layout_name)): ?>
          <br><strong><?php echo app('translator')->get('invoice.invoice_layouts'); ?>:</strong> <?php echo e($sr_layout_name, false); ?>

        <?php endif; ?>
      </div>
      <div class="col-sm-4 col-12">
        <h4><?php echo app('translator')->get('lang_v1.sell_details'); ?>:</h4>
        <strong><?php echo app('translator')->get('sale.invoice_no'); ?>:</strong> <?php echo e($sell->invoice_no, false); ?> <br>
        <strong><?php echo app('translator')->get('messages.date'); ?>:</strong> <?php echo e(\Carbon::createFromTimestamp(strtotime($sell->transaction_date))->format(session('business.date_format')), false); ?>

        <?php if(!empty($custom_labels['sell']['custom_field_1'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_1'], false); ?>:</strong> <?php echo e($sell->custom_field_1, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_2'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_2'], false); ?>:</strong> <?php echo e($sell->custom_field_2, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_3'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_3'], false); ?>:</strong> <?php echo e($sell->custom_field_3, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_4'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_4'], false); ?>:</strong> <?php echo e($sell->custom_field_4, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_5'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_5'], false); ?>:</strong> <?php echo e($sell->custom_field_5, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_6'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_6'], false); ?>:</strong> <?php echo e($sell->custom_field_6, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_7'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_7'], false); ?>:</strong> <?php echo e($sell->custom_field_7, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_8'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_8'], false); ?>:</strong> <?php echo e($sell->custom_field_8, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_9'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_9'], false); ?>:</strong> <?php echo e($sell->custom_field_9, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_10'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_10'], false); ?>:</strong> <?php echo e($sell->custom_field_10, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_11'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_11'], false); ?>:</strong> <?php echo e($sell->custom_field_11, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_12'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_12'], false); ?>:</strong> <?php echo e($sell->custom_field_12, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_13'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_13'], false); ?>:</strong> <?php echo e($sell->custom_field_13, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_14'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_14'], false); ?>:</strong> <?php echo e($sell->custom_field_14, false); ?>

        <?php endif; ?>
      </div>
      <div class="col-sm-4 col-12">
        <?php if(!empty($sell->business)): ?>
          <h4><?php echo app('translator')->get('business.business'); ?>:</h4>
          <strong><?php echo e($sell->business->name, false); ?></strong>
          <?php if(!empty($sell->location)): ?>
            <br><?php echo e($sell->location->name, false); ?>

            <?php if(!empty($sell->location->landmark)): ?>
              <br><?php echo e($sell->location->landmark, false); ?>

            <?php endif; ?>
            <?php if(!empty($sell->location->city) || !empty($sell->location->state) || !empty($sell->location->country)): ?>
              <br><?php echo e(implode(', ', array_filter([$sell->location->city, $sell->location->state, $sell->location->country])), false); ?>

            <?php endif; ?>
            <?php if(!empty($sell->location->mobile)): ?>
              <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($sell->location->mobile, false); ?>

            <?php endif; ?>
            <?php if(!empty($sell->location->email)): ?>
              <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($sell->location->email, false); ?>

            <?php endif; ?>
          <?php endif; ?>
          <?php if(!empty($sell->business->tax_number_1)): ?>
            <br><?php echo e($sell->business->tax_label_1, false); ?>: <?php echo e($sell->business->tax_number_1, false); ?>

          <?php endif; ?>
          <?php if(!empty($sell->business->tax_number_2)): ?>
            <br><?php echo e($sell->business->tax_label_2, false); ?>: <?php echo e($sell->business->tax_number_2, false); ?>

          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
    <br>
    <?php
      $scs = session()->get('business.common_settings') ?? [];
      $sr_show_discount  = !empty($scs['enable_inline_discount_sales']);
      $sr_show_discount2 = !empty($scs['enable_inline_discount2_sales']);
      $sr_show_tax       = !empty($scs['enable_inline_tax_sales']);
    ?>
    <div class="row">
      <div class="col-sm-12">
        <br>
        <table class="table bg-gray">
          <thead>
            <tr class="bg-green">
                <th>#</th>
                <th><?php echo app('translator')->get('product.sku'); ?></th>
                <th><?php echo app('translator')->get('product.product_name'); ?></th>
                <th><?php echo app('translator')->get('sale.unit_price'); ?></th>
                <?php if($sr_show_discount): ?>
                <th><?php echo app('translator')->get('sale.discount'); ?></th>
                <?php endif; ?>
                <?php if($sr_show_discount2): ?>
                <th><?php echo app('translator')->get('sale.discount'); ?> 2</th>
                <?php endif; ?>
                <?php if($sr_show_tax): ?>
                <th><?php echo app('translator')->get('sale.tax'); ?></th>
                <?php endif; ?>
                <th><?php echo app('translator')->get('lang_v1.return_quantity'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.return_subtotal'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
              $total_before_tax = 0;
            ?>
            <?php $__currentLoopData = $sell->sell_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php if($sell_line->quantity_returned == 0): ?>
                <?php continue; ?>
            <?php endif; ?>

            <?php
              $unit_name = $sell_line->product->unit->short_name;

              if(!empty($sell_line->sub_unit)) {
                $unit_name = $sell_line->sub_unit->short_name;
              }
            ?>

            <tr>
                <td><?php echo e($loop->iteration, false); ?></td>
                <td><?php echo e($sell_line->variations->sub_sku ?? $sell_line->product->sku ?? '', false); ?></td>
                <td>
                  <?php echo e($sell_line->product->name, false); ?>

                  <?php if( $sell_line->product->type == 'variable'): ?>
                    - <?php echo e($sell_line->variations->product_variation->name, false); ?>

                    - <?php echo e($sell_line->variations->name, false); ?>

                  <?php endif; ?>
                </td>
                <td><span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->unit_price_inc_tax, false); ?></span></td>
                <?php if($sr_show_discount): ?>
                <td>
                  <?php if(!empty($sell_line->line_discount_amount)): ?>
                    <span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->get_discount_amount(), false); ?></span>
                    <?php if($sell_line->line_discount_type == 'percentage'): ?> (<?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $sell_line->line_discount_amount, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?>%) <?php endif; ?>
                  <?php endif; ?>
                </td>
                <?php endif; ?>
                <?php if($sr_show_discount2): ?>
                <td>
                  <?php if(!empty($sell_line->line_discount2_amount)): ?>
                    <span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->get_discount2_amount(), false); ?></span>
                    <?php if($sell_line->line_discount2_type == 'percentage'): ?> (<?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $sell_line->line_discount2_amount, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?>%) <?php endif; ?>
                  <?php endif; ?>
                </td>
                <?php endif; ?>
                <?php if($sr_show_tax): ?>
                <td>
                  <span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->item_tax, false); ?></span>
                </td>
                <?php endif; ?>
                <td><?php echo e(number_format($sell_line->quantity_returned, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($unit_name, false); ?></td>
                <td>
                  <?php
                    $line_total = $sell_line->unit_price_inc_tax * $sell_line->quantity_returned;
                    $total_before_tax += $line_total ;
                  ?>
                  <span class="display_currency" data-currency_symbol="true"><?php echo e($line_total, false); ?></span>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-6 offset-md-6">
      <table class="table">
        <tr>
          <th><?php echo app('translator')->get('purchase.net_total_amount'); ?>: </th>
          <td></td>
          <td><span class="display_currency float-end" data-currency_symbol="true"><?php echo e($total_before_tax, false); ?></span></td>
        </tr>

        <tr>
          <th><?php echo app('translator')->get('lang_v1.return_discount'); ?>: </th>
          <td><b>(-)</b></td>
          <td class="text-right"><?php if($sell->return_parent->discount_type == 'percentage'): ?>
              @<strong><small><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $sell->return_parent->discount_amount, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?>%</small></strong> -
              <?php endif; ?>
          <span class="display_currency float-end" data-currency_symbol="true"><?php echo e($total_discount, false); ?></span></td>
        </tr>
        
        <tr>
          <th><?php echo app('translator')->get('lang_v1.total_return_tax'); ?>:</th>
          <td><b>(+)</b></td>
          <td class="text-right">
              <?php if(!empty($sell_taxes)): ?>
                <?php $__currentLoopData = $sell_taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <strong><small><?php echo e($k, false); ?></small></strong> - <span class="display_currency float-end" data-currency_symbol="true"><?php echo e($v, false); ?></span><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              0.00
              <?php endif; ?>
            </td>
        </tr>
        <tr>
          <th><?php echo app('translator')->get('lang_v1.return_total'); ?>:</th>
          <td></td>
          <td><span class="display_currency float-end" data-currency_symbol="true" ><?php echo e($sell->return_parent->final_total, false); ?></span></td>
        </tr>
      </table>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-12">
          <strong><?php echo e(__('lang_v1.activities'), false); ?>:</strong><br>
          <?php if ($__env->exists('activity_log.activities', ['activity_type' => 'sell'])) echo $__env->make('activity_log.activities', ['activity_type' => 'sell'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
  </div>

</div>
<div class="modal-footer">
    <a href="#" class="print-invoice btn btn-primary" data-href="<?php echo e(action([\App\Http\Controllers\SellReturnController::class, 'printInvoice'], [$sell->return_parent->id]), false); ?>"><i class="fa fa-print" aria-hidden="true"></i> <?php echo app('translator')->get("messages.print"); ?></a>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    var element = $('div.modal-xl');
    __currency_convert_recursively(element);
  });
</script>
