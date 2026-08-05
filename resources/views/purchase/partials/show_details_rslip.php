<div class="modal-header">
    <?php
      $title = $purchase->type == 'purchase_order' ? __('lang_v1.purchase_order_details') : __('purchase.purchase_details');
      $custom_labels = json_decode(session('business.custom_labels'), true);
    ?>
    <h4 class="modal-title" id="modalTitle"> <?php echo e($title, false); ?> (<b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> #<?php echo e($purchase->ref_no, false); ?>)
    </h4>
    <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
    
</div>
<div class="modal-body">
  <div class="row">
    <div class="col-sm-12">
      <p class="float-end"><b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($purchase->transaction_date))->format(session('business.date_format')), false); ?></p>
    </div>
  </div>
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      <?php echo app('translator')->get('purchase.supplier'); ?>:
      <address>
        <?php echo $purchase->contact->contact_address; ?>

        <?php if(!empty($purchase->contact->tax_number)): ?>
          <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($purchase->contact->tax_number, false); ?>

        <?php endif; ?>
        <?php if(!empty($purchase->contact->mobile)): ?>
          <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($purchase->contact->mobile, false); ?>

        <?php endif; ?>
        <?php if(!empty($purchase->contact->email)): ?>
          <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($purchase->contact->email, false); ?>

        <?php endif; ?>
      </address>
      <?php if($purchase->document_path): ?>
        
        <a href="<?php echo e($purchase->document_path, false); ?>" 
        download="<?php echo e($purchase->document_name, false); ?>" class="btn btn-sm btn-success float-start no-print">
          <i class="fa fa-download"></i> 
            &nbsp;<?php echo e(__('purchase.download_document'), false); ?>

        </a>
      <?php endif; ?>
    </div>

    <div class="col-sm-4 invoice-col">
      <?php echo app('translator')->get('business.business'); ?>:
      <address>
        <strong><?php echo e($purchase->business->name, false); ?></strong>
        <?php echo e($purchase->location->name, false); ?>

        <?php if(!empty($purchase->location->landmark)): ?>
          <br><?php echo e($purchase->location->landmark, false); ?>

        <?php endif; ?>
        <?php if(!empty($purchase->location->city) || !empty($purchase->location->state) || !empty($purchase->location->country)): ?>
          <br><?php echo e(implode(',', array_filter([$purchase->location->city, $purchase->location->state, $purchase->location->country])), false); ?>

        <?php endif; ?>
        
        <?php if(!empty($purchase->business->tax_number_1)): ?>
          <br><?php echo e($purchase->business->tax_label_1, false); ?>: <?php echo e($purchase->business->tax_number_1, false); ?>

        <?php endif; ?>

        <?php if(!empty($purchase->business->tax_number_2)): ?>
          <br><?php echo e($purchase->business->tax_label_2, false); ?>: <?php echo e($purchase->business->tax_number_2, false); ?>

        <?php endif; ?>

        <?php if(!empty($purchase->location->mobile)): ?>
          <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($purchase->location->mobile, false); ?>

        <?php endif; ?>
        <?php if(!empty($purchase->location->email)): ?>
          <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($purchase->location->email, false); ?>

        <?php endif; ?>
      </address>
    </div>

    <div class="col-sm-4 invoice-col">
      <b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> #<?php echo e($purchase->ref_no, false); ?><br/>
      <b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($purchase->transaction_date))->format(session('business.date_format')), false); ?><br/>
      <b><?php echo app('translator')->get('purchase.location'); ?>:</b> <?php echo e($purchase->location->name, false); ?><br/>
      <?php if(!empty($purchase->status)): ?>
        <b><?php echo app('translator')->get('purchase.purchase_status'); ?>:</b> <?php if($purchase->type == 'purchase_order'): ?><?php echo e($po_statuses[$purchase->status]['label'] ?? '', false); ?> <?php else: ?> <?php echo e(__('lang_v1.' . $purchase->status), false); ?> <?php endif; ?><br>
      <?php endif; ?>
      <?php if(!empty($purchase->payment_status)): ?>
      <b><?php echo app('translator')->get('purchase.payment_status'); ?>:</b> <?php echo e(__('lang_v1.' . $purchase->payment_status), false); ?>

      <?php endif; ?>

      <?php if(!empty($custom_labels['purchase']['custom_field_1'])): ?>
        <br><strong><?php echo e($custom_labels['purchase']['custom_field_1'] ?? '', false); ?>: </strong> <?php echo e($purchase->custom_field_1, false); ?>

      <?php endif; ?>
      <?php if(!empty($custom_labels['purchase']['custom_field_2'])): ?>
        <br><strong><?php echo e($custom_labels['purchase']['custom_field_2'] ?? '', false); ?>: </strong> <?php echo e($purchase->custom_field_2, false); ?>

      <?php endif; ?>
      <?php if(!empty($custom_labels['purchase']['custom_field_3'])): ?>
        <br><strong><?php echo e($custom_labels['purchase']['custom_field_3'] ?? '', false); ?>: </strong> <?php echo e($purchase->custom_field_3, false); ?>

      <?php endif; ?>
      <?php if(!empty($custom_labels['purchase']['custom_field_4'])): ?>
        <br><strong><?php echo e($custom_labels['purchase']['custom_field_4'] ?? '', false); ?>: </strong> <?php echo e($purchase->custom_field_4, false); ?>

      <?php endif; ?>
      <?php if(!empty($custom_labels['purchase']['custom_field_5'])): ?>
        <br><strong><?php echo e($custom_labels['purchase']['custom_field_5'] ?? '', false); ?>: </strong> <?php echo e($purchase->custom_field_5, false); ?>

      <?php endif; ?>
      <?php if(!empty($custom_labels['purchase']['custom_field_6'])): ?>
        <br><strong><?php echo e($custom_labels['purchase']['custom_field_6'] ?? '', false); ?>: </strong> <?php echo e($purchase->custom_field_6, false); ?>

      <?php endif; ?>
      <?php if(!empty($custom_labels['purchase']['custom_field_7'])): ?>
        <br><strong><?php echo e($custom_labels['purchase']['custom_field_7'] ?? '', false); ?>: </strong> <?php echo e($purchase->custom_field_7, false); ?>

      <?php endif; ?>
      <?php if(!empty($custom_labels['purchase']['custom_field_8'])): ?>
        <br><strong><?php echo e($custom_labels['purchase']['custom_field_8'] ?? '', false); ?>: </strong> <?php echo e($purchase->custom_field_8, false); ?>

      <?php endif; ?>
      <?php if(!empty($purchase_order_nos)): ?>
            <strong><?php echo app('translator')->get('restaurant.order_no'); ?>:</strong>
            <?php echo e($purchase_order_nos, false); ?>

        <?php endif; ?>

        <?php if(!empty($purchase_order_dates)): ?>
            <br>
            <strong><?php echo app('translator')->get('lang_v1.order_dates'); ?>:</strong>
            <?php echo e($purchase_order_dates, false); ?>

        <?php endif; ?>
      <?php if($purchase->type == 'purchase_order'): ?>
        <?php
          $custom_labels = json_decode(session('business.custom_labels'), true);
        ?>
        <strong><?php echo app('translator')->get('sale.shipping'); ?>:</strong>
        <span class="label <?php if(!empty($shipping_status_colors[$purchase->shipping_status])): ?> <?php echo e($shipping_status_colors[$purchase->shipping_status], false); ?> <?php else: ?> <?php echo e('bg-gray', false); ?> <?php endif; ?>"><?php echo e($shipping_statuses[$purchase->shipping_status] ?? '', false); ?></span><br>
        <?php if(!empty($purchase->shipping_address())): ?>
          <?php echo e($purchase->shipping_address(), false); ?>

        <?php else: ?>
          <?php echo e($purchase->shipping_address ?? '--', false); ?>

        <?php endif; ?>
        <?php if(!empty($purchase->delivered_to)): ?>
          <br><strong><?php echo app('translator')->get('lang_v1.delivered_to'); ?>: </strong> <?php echo e($purchase->delivered_to, false); ?>

        <?php endif; ?>
        <?php if(!empty($purchase->shipping_custom_field_1)): ?>
          <br><strong><?php echo e($custom_labels['shipping']['custom_field_1'] ?? '', false); ?>: </strong> <?php echo e($purchase->shipping_custom_field_1, false); ?>

        <?php endif; ?>
        <?php if(!empty($purchase->shipping_custom_field_2)): ?>
          <br><strong><?php echo e($custom_labels['shipping']['custom_field_2'] ?? '', false); ?>: </strong> <?php echo e($purchase->shipping_custom_field_2, false); ?>

        <?php endif; ?>
        <?php if(!empty($purchase->shipping_custom_field_3)): ?>
          <br><strong><?php echo e($custom_labels['shipping']['custom_field_3'] ?? '', false); ?>: </strong> <?php echo e($purchase->shipping_custom_field_3, false); ?>

        <?php endif; ?>
        <?php if(!empty($purchase->shipping_custom_field_4)): ?>
          <br><strong><?php echo e($custom_labels['shipping']['custom_field_4'] ?? '', false); ?>: </strong> <?php echo e($purchase->shipping_custom_field_4, false); ?>

        <?php endif; ?>
        <?php if(!empty($purchase->shipping_custom_field_5)): ?>
          <br><strong><?php echo e($custom_labels['shipping']['custom_field_5'] ?? '', false); ?>: </strong> <?php echo e($purchase->shipping_custom_field_5, false); ?>

        <?php endif; ?>
        <?php
          $medias = $purchase->media->where('model_media_type', 'shipping_document')->all();
        ?>
        <?php if(count($medias)): ?>
          <?php echo $__env->make('sell.partials.media_table', ['medias' => $medias], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>

  <br>
  <div class="row" style="display: none">
    <div class="col-sm-12 col-12">
      <div class="table-responsive">
        <table class="table bg-gray">
          <thead>
            <tr class="bg-green">
              <th>#</th>
              <th><?php echo app('translator')->get('product.product_name'); ?></th>
              <th><?php echo app('translator')->get('product.sku'); ?></th>
              <?php if($purchase->type == 'purchase_order'): ?>
                <th class="text-right"><?php echo app('translator')->get( 'lang_v1.quantity_remaining' ); ?></th>
              <?php endif; ?>
              <th class="text-right"><?php if($purchase->type == 'purchase_order'): ?> <?php echo app('translator')->get('lang_v1.order_quantity'); ?> <?php else: ?> <?php echo app('translator')->get('purchase.purchase_quantity'); ?> <?php endif; ?></th>
              <th class="text-right"><?php echo app('translator')->get( 'lang_v1.unit_cost_before_discount' ); ?></th>
              <th class="text-right"><?php echo app('translator')->get( 'lang_v1.discount_percent' ); ?></th>
              <th class="no-print text-right"><?php echo app('translator')->get('purchase.unit_cost_before_tax'); ?></th>
              <th class="no-print text-right"><?php echo app('translator')->get('purchase.subtotal_before_tax'); ?></th>
              <th class="text-right"><?php echo app('translator')->get('sale.tax'); ?></th>
              <th class="text-right"><?php echo app('translator')->get('purchase.unit_cost_after_tax'); ?></th>
              <?php if($purchase->type != 'purchase_order'): ?>
              <?php if(session('business.enable_lot_number')): ?>
                <th><?php echo app('translator')->get('lang_v1.lot_number'); ?></th>
              <?php endif; ?>
              <?php if(session('business.enable_product_expiry')): ?>
                <th><?php echo app('translator')->get('product.mfg_date'); ?></th>
                <th><?php echo app('translator')->get('product.exp_date'); ?></th>
              <?php endif; ?>
              <?php endif; ?>
              <th class="text-right"><?php echo app('translator')->get('sale.subtotal'); ?></th>
            </tr>
          </thead>
          <?php 
            $total_before_tax = 0.00;
          ?>
          <?php $__currentLoopData = $purchase->purchase_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($loop->iteration, false); ?></td>
              <td>
                <?php echo e($purchase_line->product->name, false); ?>

                 <?php if( $purchase_line->product->type == 'variable'): ?>
                  - <?php echo e($purchase_line->variations->product_variation->name, false); ?>

                  - <?php echo e($purchase_line->variations->name, false); ?>

                 <?php endif; ?>
              </td>
              <td>
                 <?php if( $purchase_line->product->type == 'variable'): ?>
                  <?php echo e($purchase_line->variations->sub_sku, false); ?>

                  <?php else: ?>
                  <?php echo e($purchase_line->product->sku, false); ?>

                 <?php endif; ?>
              </td>
              <?php if($purchase->type == 'purchase_order'): ?>
              <td>
                <span class="display_currency" data-is_quantity="true" data-currency_symbol="false"><?php echo e($purchase_line->quantity - $purchase_line->po_quantity_purchased, false); ?></span> <?php if(!empty($purchase_line->sub_unit)): ?> <?php echo e($purchase_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($purchase_line->product->unit->short_name, false); ?> <?php endif; ?>
              </td>
              <?php endif; ?>
              <td><span class="display_currency" data-is_quantity="true" data-currency_symbol="false"><?php echo e($purchase_line->quantity, false); ?></span> <?php if(!empty($purchase_line->sub_unit)): ?> <?php echo e($purchase_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($purchase_line->product->unit->short_name, false); ?> <?php endif; ?>

                <?php if(!empty($purchase_line->product->second_unit) && $purchase_line->secondary_unit_quantity != 0): ?>
                    <br>
                    <span class="display_currency" data-is_quantity="true" data-currency_symbol="false"><?php echo e($purchase_line->secondary_unit_quantity, false); ?></span> <?php echo e($purchase_line->product->second_unit->short_name, false); ?>

                <?php endif; ?>

              </td>
              <?php
              $tax_charged = $purchase_line->quantity * $purchase_line->item_tax;
              ?>
              <td class="text-right"><span class="display_currency" data-currency_symbol="true"><?php echo e($purchase_line->pp_without_discount, false); ?></span></td>
              <td class="text-right"><span class="display_currency"><?php echo e($purchase_line->discount_percent, false); ?></span> %</td>
              <td class="no-print text-right"><span class="display_currency" data-currency_symbol="true"><?php echo e($purchase_line->purchase_price, false); ?></span></td>
              <td class="no-print text-right"><span class="display_currency" data-currency_symbol="true"><?php echo e($purchase_line->quantity * $purchase_line->purchase_price, false); ?></span></td>
              <td class="text-right"><span class="display_currency" data-currency_symbol="true"><?php echo e($tax_charged, false); ?> </span> <br/><small>( <?php if(!empty($taxes[$purchase_line->tax_id])): ?> <?php echo e($taxes[$purchase_line->tax_id], false); ?>  <?php if($tax_types[$purchase_line->tax_id] == 'fixed'): ?> (<?php echo e('Rs '. $tax_rates[$purchase_line->tax_id], false); ?>) <?php else: ?> <?php echo e('@'.$tax_rates[$purchase_line->tax_id].'%', false); ?> <?php endif; ?>  <?php endif; ?>  )</small></td>
              <td class="text-right"><span class="display_currency" data-currency_symbol="true"><?php echo e($purchase_line->purchase_price_inc_tax, false); ?></span></td>
              <?php if($purchase->type != 'purchase_order'): ?>
              <?php if(session('business.enable_lot_number')): ?>
                <td><?php echo e($purchase_line->lot_number, false); ?></td>
              <?php endif; ?>

              <?php if(session('business.enable_product_expiry')): ?>
              <td>
                <?php if(!empty($purchase_line->mfg_date)): ?>
                    <?php echo e(\Carbon::createFromTimestamp(strtotime($purchase_line->mfg_date))->format(session('business.date_format')), false); ?>

                <?php endif; ?>
              </td>
              <td>
                <?php if(!empty($purchase_line->exp_date)): ?>
                    <?php echo e(\Carbon::createFromTimestamp(strtotime($purchase_line->exp_date))->format(session('business.date_format')), false); ?>

                <?php endif; ?>
              </td>
              <?php endif; ?>
              <?php endif; ?>
              <td class="text-right"><span class="display_currency" data-currency_symbol="true"><?php echo e($purchase_line->purchase_price_inc_tax * $purchase_line->quantity, false); ?></span></td>
            </tr>
            <?php 
              $total_inc_tax += ($purchase_line->quantity * $purchase_line->purchase_price_inc_tax);
            ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <?php if(!empty($purchase->type == 'purchase')): ?>
    <div class="col-sm-12 col-12">
      <h4><?php echo e(__('sale.payment_info'), false); ?>:</h4>
    </div>
    <div class="col-md-6 col-sm-12 col-12">
      <div class="table-responsive">
        <table class="table">
          <tr class="bg-green">
            <th>#</th>
            <th><?php echo e(__('messages.date'), false); ?></th>
            <th><?php echo e(__('purchase.ref_no'), false); ?></th>
            <th><?php echo e(__('purchase.location'), false); ?></th>
            <th><?php echo e(__('sale.amount'), false); ?></th>
            <th><?php echo e(__('sale.payment_mode'), false); ?></th>
            <th><?php echo e(__('sale.payment_note'), false); ?></th>
          </tr>
          <?php
            $total_paid = 0;
          ?>
          <?php $__empty_1 = true; $__currentLoopData = $purchase->payment_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
              $total_paid += $payment_line->amount;
            ?>
            <tr>
              <td><?php echo e($loop->iteration, false); ?></td>
              <td><?php echo e(\Carbon::createFromTimestamp(strtotime($payment_line->paid_on))->format(session('business.date_format')), false); ?></td>
              <td><?php echo e($payment_line->payment_ref_no, false); ?></td>
              <td><?php echo e($purchase->location->name, false); ?></td>
              <td><span class="display_currency" data-currency_symbol="true"><?php echo e($payment_line->amount, false); ?></span></td>
              <td><?php echo e($payment_methods[$payment_line->method] ?? '', false); ?></td>
              <td><?php if($payment_line->note): ?> 
                <?php echo e(ucfirst($payment_line->note), false); ?>

                <?php else: ?>
                --
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
              <td colspan="5" class="text-center">
                <?php echo app('translator')->get('purchase.no_payments'); ?>
              </td>
            </tr>
          <?php endif; ?>
        </table>
      </div>
    </div>
    <?php endif; ?>
    <div class="col-md-6 col-sm-12 col-12 <?php if($purchase->type == 'purchase_order'): ?> col-md-offset-6 <?php endif; ?>">
      <div class="table-responsive">
        <table class="table">
          <!-- <tr class="hide">
            <th><?php echo app('translator')->get('purchase.total_before_tax'); ?>: </th>
            <td></td>
            <td><span class="display_currency float-end"><?php echo e($total_inc_tax, false); ?></span></td>
          </tr> -->
          <tr>
            <th><?php echo app('translator')->get('purchase.net_total_amount'); ?>: </th>
            <td></td>
            <td><span class="display_currency float-end" data-currency_symbol="true"><?php echo e($total_inc_tax, false); ?></span></td>
          </tr>
          <tr>
            <th><?php echo app('translator')->get('purchase.discount'); ?>:</th>
            <td>
              <b>(-)</b>
              <?php if($purchase->discount_type == 'percentage'): ?>
                (<?php echo e($purchase->discount_amount, false); ?> %)
              <?php endif; ?>
            </td>
            <td>
              <span class="display_currency float-end" data-currency_symbol="true">
                <?php if($purchase->discount_type == 'percentage'): ?>
                  <?php echo e($purchase->discount_amount * $total_inc_tax / 100, false); ?>

                <?php else: ?>
                  <?php echo e($purchase->discount_amount, false); ?>

                <?php endif; ?>                  
              </span>
            </td>
          </tr>
          <tr>
            
            <th>Invoice Tax:</th>
            <td><b>(+)</b></td>
            <td class="text-right">
                <?php if(!empty($purchase_taxes)): ?>
                  <?php $__currentLoopData = $purchase_taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <strong><small><?php echo e($k, false); ?></small></strong> - <span class="display_currency float-end" data-currency_symbol="true"><?php echo e($v, false); ?></span><br>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                0.00
                <?php endif; ?>
              </td>
          </tr>
          <?php if( !empty( $purchase->shipping_charges ) ): ?>
            <tr>
              <th><?php echo app('translator')->get('purchase.additional_shipping_charges'); ?>:</th>
              <td><b>(+)</b></td>
              <td><span class="display_currency float-end" ><?php echo e($purchase->shipping_charges, false); ?></span></td>
            </tr>
          <?php endif; ?>
          <?php if( !empty( $purchase->additional_expense_value_1 )  && !empty( $purchase->additional_expense_key_1 )): ?>
            <tr>
              <th><?php echo e($purchase->additional_expense_key_1, false); ?>:</th>
              <td><b>(+)</b></td>
              <td><span class="display_currency float-end" ><?php echo e($purchase->additional_expense_value_1, false); ?></span></td>
            </tr>
          <?php endif; ?>
          <?php if( !empty( $purchase->additional_expense_value_2 )  && !empty( $purchase->additional_expense_key_2 )): ?>
            <tr>
              <th><?php echo e($purchase->additional_expense_key_2, false); ?>:</th>
              <td><b>(+)</b></td>
              <td><span class="display_currency float-end" ><?php echo e($purchase->additional_expense_value_2, false); ?></span></td>
            </tr>
          <?php endif; ?>
          <?php if( !empty( $purchase->additional_expense_value_3 )  && !empty( $purchase->additional_expense_key_3 )): ?>
            <tr>
              <th><?php echo e($purchase->additional_expense_key_3, false); ?>:</th>
              <td><b>(+)</b></td>
              <td><span class="display_currency float-end" ><?php echo e($purchase->additional_expense_value_3, false); ?></span></td>
            </tr>
          <?php endif; ?>
          <?php if( !empty( $purchase->additional_expense_value_4 ) && !empty( $purchase->additional_expense_key_4 )): ?>
            <tr>
              <th><?php echo e($purchase->additional_expense_key_4, false); ?>:</th>
              <td><b>(+)</b></td>
              <td><span class="display_currency float-end" ><?php echo e($purchase->additional_expense_value_4, false); ?></span></td>
            </tr>
          <?php endif; ?>
          <tr>
            <th><?php echo app('translator')->get('purchase.purchase_total'); ?>:</th>
            <td></td>
            <td><span class="display_currency float-end" data-currency_symbol="true" ><?php echo e($purchase->final_total, false); ?></span></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <strong><?php echo app('translator')->get('purchase.additional_notes'); ?>:</strong><br>
      <p class="well well-sm no-shadow bg-gray">
        <?php if($purchase->additional_notes): ?>
          <?php echo e($purchase->additional_notes, false); ?>

        <?php else: ?>
          --
        <?php endif; ?>
      </p>
    </div>
  </div>

  
  <div class="row print_section">
    <div class="col-12">
      <img class="center-block" src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($purchase->ref_no, 'C128', 2,30,array(39, 48, 54), true), false); ?>">
    </div>
  </div>
</div>
