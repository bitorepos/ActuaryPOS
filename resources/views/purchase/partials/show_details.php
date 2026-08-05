<div class="modal-header">
    <?php
      $title = $purchase->type == 'purchase_order' ? __('lang_v1.purchase_order_details') : __('purchase.purchase_details');
      $custom_labels = json_decode(session('business.custom_labels'), true);
      // Phase 72: prefer controller-supplied per-branch common_settings; session is the fallback.
      $phdr_cs = isset($common_settings) && ! empty($common_settings)
          ? $common_settings
          : (session()->get('business.common_settings') ?? []);
      $phdr_show_shipping = ($purchase->type == 'purchase_order') || !empty($phdr_cs['enable_shipping_details_purchase']);
      $phdr_show_additional_expense = !empty($phdr_cs['enable_additional_expense_purchase']);

      // Invoice layout name
      if (!empty($purchase->invoice_layout)) {
          $phdr_layout_name = $purchase->invoice_layout->name;
      } elseif (!empty($purchase->location)) {
          $loc_settings = $purchase->location->loc_settings ?? [];
          $fallback_id = $loc_settings['purchase_layout_id'] ?? null;
          $phdr_layout_name = $fallback_id ? \App\InvoiceLayout::where('id', $fallback_id)->value('name') : null;
      } else {
          $phdr_layout_name = null;
      }

      // Currency symbols for modal labels (dual: selected currency for subtotal-level, business currency for total/due)
      $business_currency_symbol = session('currency')['symbol'] ?? '';
      $business_currency_code = session('currency')['code'] ?? '';
      $selected_currency_symbol = $business_currency_symbol;
      $selected_currency_name = null;
      $selected_currency_code = null;
      if (!empty($purchase->location_currency_id)) {
          $loc_currency = \App\LocationCurrency::find($purchase->location_currency_id);
          if (!empty($loc_currency) && !empty($loc_currency->symbol)) {
              $selected_currency_symbol = $loc_currency->symbol;
              $selected_currency_name = $loc_currency->currency;
              $selected_currency_code = $loc_currency->code;
          }
      }
      $sel_suffix = !empty($selected_currency_symbol) ? ' (' . $selected_currency_symbol . ')' : '';
      $biz_suffix = !empty($business_currency_symbol) ? ' (' . $business_currency_symbol . ')' : '';
      $xr = $purchase->exchange_rate ?: 1;
    ?>
    <h4 class="modal-title" id="modalTitle"> <?php echo e($title, false); ?> (<b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> #<?php echo e($purchase->ref_no, false); ?>)
    </h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body" style="overflow-x: auto;">
  <div class="row">
    <div class="col-sm-12">
      <p class="float-end"><b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($purchase->transaction_date))->format(session('business.date_format')), false); ?></p>
    </div>
  </div>
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      <?php echo app('translator')->get('purchase.supplier'); ?>:
      <address>
        <?php if(!empty($purchase->contact->contact_id)): ?>
          <strong><?php echo app('translator')->get('lang_v1.contact_id'); ?>:</strong> <?php echo e($purchase->contact->contact_id, false); ?><br>
        <?php endif; ?>
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
      <?php if(!empty($purchase->pay_term_number)): ?>
        <br><b><?php echo app('translator')->get('contact.pay_term'); ?>:</b> <?php echo e($purchase->pay_term_number, false); ?> <?php echo e(__('lang_v1.' . ($purchase->pay_term_type ?? 'days')), false); ?>

      <?php endif; ?>
      <?php if(!empty($phdr_layout_name)): ?>
        <br><b><?php echo app('translator')->get('invoice.invoice_layouts'); ?>:</b> <?php echo e($phdr_layout_name, false); ?>

      <?php endif; ?>

      <?php if(!empty($selected_currency_name)): ?>
        <br><b><?php echo app('translator')->get('business.currency'); ?>:</b> <?php echo e($selected_currency_name, false); ?> (<?php echo e($selected_currency_code, false); ?>)
        <br><b>Conversion Rate:</b> 1 <?php echo e($selected_currency_code, false); ?> = <?php echo e(rtrim(rtrim(number_format($loc_currency->multiplier, 9, '.', ''), '0'), '.'), false); ?> <?php echo e($business_currency_code, false); ?>

      <?php else: ?>
        <br><b><?php echo app('translator')->get('business.currency'); ?>:</b> <?php echo app('translator')->get('lang_v1.default_currency'); ?> (<?php echo e($business_currency_code, false); ?>)
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
      <?php if($phdr_show_shipping): ?>
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
  
  <?php
    $purchase_custom_fields = [];
    for ($i = 1; $i <= 14; $i++) {
        $field_key = 'custom_field_' . $i;
        if (!empty($custom_labels['purchase'][$field_key])) {
            $purchase_custom_fields[] = [
                'label' => $custom_labels['purchase'][$field_key],
                'value' => $purchase->$field_key ?? '',
            ];
        }
    }
  ?>
  <?php if(count($purchase_custom_fields)): ?>
  <hr class="my-2">
  <div class="row">
    <?php $__currentLoopData = $purchase_custom_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-sm-6 mb-1">
        <strong><?php echo e($cf['label'], false); ?>:</strong> <?php echo e($cf['value'], false); ?>

      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <?php endif; ?>

  <br>
  <?php
    // Phase 72: prefer controller-supplied per-branch common_settings; session is the fallback.
    $pcs = isset($common_settings) && ! empty($common_settings)
        ? $common_settings
        : (session()->get('business.common_settings') ?? []);
    $p_show_discount  = !empty($pcs['enable_inline_discount_purchase']);
    $p_show_discount2 = !empty($pcs['enable_inline_discount2_purchase']);
    $p_show_tax       = !empty($pcs['enable_inline_tax_purchase']);
    $p_pos_settings   = json_decode(\App\Business::where('id', session('user.business_id'))->value('pos_settings') ?? '{}', true);
    $p_show_price_inc_tax = !empty($p_pos_settings['enable_inclusive_tax_column']);
    $p_show_gp_sell_price = session('business.enable_editing_product_from_purchase') && $purchase->type != 'purchase_order';
  ?>
  <div class="row">
    <div class="col-sm-12 col-12">
      <div class="table-responsive">
        <table class="table bg-gray">
          <thead>
            <tr class="bg-green">
              <th>#</th>
              <th><?php echo app('translator')->get('product.sku'); ?></th>
              <th><?php echo app('translator')->get('product.product_name'); ?></th>
              <?php if($purchase->type == 'purchase_order'): ?>
                <th class="text-right"><?php echo app('translator')->get( 'lang_v1.quantity_remaining' ); ?></th>
              <?php endif; ?>
              <th class="text-right"><?php if($purchase->type == 'purchase_order'): ?> <?php echo app('translator')->get('lang_v1.order_quantity'); ?> <?php else: ?> <?php echo app('translator')->get('purchase.purchase_quantity'); ?> <?php endif; ?></th>
              <th class="text-right"><?php echo app('translator')->get( 'lang_v1.unit_cost_before_discount' ); ?><?php echo e($sel_suffix, false); ?></th>
              <?php if($p_show_discount): ?>
              <th class="text-right"><?php echo app('translator')->get( 'lang_v1.discount' ); ?><?php echo e($sel_suffix, false); ?></th>
              <?php endif; ?>
              <?php if($p_show_discount2): ?>
              <th class="text-right"><?php echo app('translator')->get( 'lang_v1.discount' ); ?><?php echo e($sel_suffix, false); ?> 2</th>   
              <?php endif; ?>
              <th class="no-print text-right"><?php echo app('translator')->get('purchase.unit_cost_before_tax'); ?><?php echo e($sel_suffix, false); ?></th>
              <th class="no-print text-right"><?php echo app('translator')->get('purchase.subtotal_before_tax'); ?><?php echo e($sel_suffix, false); ?></th>
              <?php if($p_show_tax): ?>
              <th class="text-right"><?php echo app('translator')->get('sale.tax'); ?><?php echo e($sel_suffix, false); ?></th>
              <?php endif; ?>
              <?php if($p_show_price_inc_tax): ?>
              <th class="text-right"><?php echo app('translator')->get('purchase.unit_cost_after_tax'); ?><?php echo e($sel_suffix, false); ?></th>
              <?php endif; ?>
              <?php if($purchase->type != 'purchase_order'): ?>
              <?php if(session('business.enable_lot_number')): ?>
                <th><?php if(!empty($common_settings['lot_number_label'])): ?> <?php echo e($common_settings['lot_number_label'], false); ?> <?php else: ?> <?php echo app('translator')->get('lang_v1.lot_number'); ?> <?php endif; ?></th>
              <?php endif; ?>
              <?php if(session('business.enable_product_expiry')): ?>
                <th><?php echo app('translator')->get('product.mfg_date'); ?></th>
                <th><?php echo app('translator')->get('product.exp_date'); ?></th>
              <?php endif; ?>
              <?php endif; ?>
              <th class="text-right"><?php echo app('translator')->get('sale.subtotal'); ?><?php echo e($sel_suffix, false); ?></th>
              <?php if($p_show_gp_sell_price): ?>
              <th class="text-right">G.P %</th>
              <th class="text-right">Sell Price<?php echo e($sel_suffix, false); ?></th>
              <?php endif; ?>
            </tr>
          </thead>
          <?php 
            $total_before_tax = 0.00;
          ?>
          <?php $__currentLoopData = $purchase->purchase_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($loop->iteration, false); ?></td>
              <td>
                <?php if( $purchase_line->product->type == 'variable'): ?>
                 <?php echo e($purchase_line->variations->sub_sku, false); ?>

                 <?php else: ?>
                 <?php echo e($purchase_line->product->sku, false); ?>

                <?php endif; ?>
             </td>
              <td>
                <?php echo e($purchase_line->product->name, false); ?>

                 <?php if( $purchase_line->product->type == 'variable'): ?>
                  - <?php echo e($purchase_line->variations->product_variation->name, false); ?>

                  - <?php echo e($purchase_line->variations->name, false); ?>

                 <?php endif; ?>
                 <?php if(!empty($purchase_line->purchase_line_note)): ?>
                 <br> <?php echo e($purchase_line->purchase_line_note, false); ?>

                 <?php endif; ?>
                 <?php if(!empty($pcs['enable_serial_number'])): ?>
                  <?php if(!empty($pcs['serial_number_label']) && $purchase_line->product->enable_sr_no): ?>
                  <br>
                  <?php echo e($pcs['serial_number_label'], false); ?> : <?php echo e($purchase_line->serial_number, false); ?>

                  <?php endif; ?>
                  
                  <?php if(!empty($pcs['enable_imei_number']) && $purchase_line->product->enable_imei_no): ?>
                  <?php $__currentLoopData = $purchase_line->imei_numbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $imei): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($key == 1 && !empty($pcs['imei1_number_label'])): ?>
                    <br><?php echo e($pcs['imei1_number_label'], false); ?> : <?php echo e($imei, false); ?>

                    <?php endif; ?>
                    <?php if($key == 2 && !empty($pcs['imei2_number_label'])): ?>
                    <br><?php echo e($pcs['imei2_number_label'], false); ?> : <?php echo e($imei, false); ?>

                    <?php endif; ?>
                    <?php if($key == 3 && !empty($pcs['imei3_number_label'])): ?>
                    <br><?php echo e($pcs['imei3_number_label'], false); ?> : <?php echo e($imei, false); ?>

                    <?php endif; ?>
                    <?php if($key == 4 && !empty($pcs['imei4_number_label'])): ?>
                    <br><?php echo e($pcs['imei4_number_label'], false); ?> : <?php echo e($imei, false); ?>

                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>

                 <?php endif; ?>
              </td>
              
              <?php if($purchase->type == 'purchase_order'): ?>
              <td>
                <span class="display_currency" data-is_quantity="true" data-currency_symbol="false"><?php echo e($purchase_line->quantity - $purchase_line->po_quantity_purchased, false); ?></span> <?php if(!empty($purchase_line->sub_unit)): ?> <?php echo e($purchase_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($purchase_line->product->unit->short_name, false); ?> <?php endif; ?>
              </td>
              <?php endif; ?>
              <td>
                <span class="display_currency" data-is_quantity="true" data-currency_symbol="false"><?php echo e($purchase_line->quantity, false); ?></span> <?php if(!empty($purchase_line->sub_unit)): ?> <?php echo e($purchase_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($purchase_line->product->unit->short_name, false); ?> <?php endif; ?>
                
                <?php if($purchase_line->foc_quantity != 0): ?>
                    <br>
                    FOC: 
                    <span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($purchase_line->foc_quantity, false); ?></span>
                    <?php if(!empty($purchase_line->foc_sub_unit)): ?> <?php echo e($purchase_line->foc_sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($purchase_line->product->unit->short_name, false); ?> <?php endif; ?>
                <?php endif; ?>

                <?php if(!empty($purchase_line->product->second_unit) && $purchase_line->secondary_unit_quantity != 0): ?>
                    <br>
                    <span class="display_currency" data-is_quantity="true" data-currency_symbol="false"><?php echo e($purchase_line->secondary_unit_quantity, false); ?></span> <?php echo e($purchase_line->product->second_unit->short_name, false); ?>

                <?php endif; ?>

              </td>
              <?php
              $tax_charged = $purchase_line->quantity * $purchase_line->item_tax;
              ?>
              <td class="text-right"><span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($purchase_line->pp_without_discount / $xr, false); ?></span></td>
              <?php if($p_show_discount): ?>
              <td class="text-right">
                <?php if($purchase_line->discount_type == 'fixed'): ?>
                <span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($purchase_line->discount_percent / $xr, false); ?></span>
                <?php else: ?>
                <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $purchase_line->discount_percent, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?> %
                <?php endif; ?>
              </td>
              <?php endif; ?>
              <?php if($p_show_discount2): ?>
              <td class="text-right">
                <?php if($purchase_line->discount2_type == 'fixed'): ?>
                <span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($purchase_line->discount2_percent / $xr, false); ?></span>
                <?php else: ?>
                <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $purchase_line->discount2_percent, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?> %
                <?php endif; ?>
              </td>
              <?php endif; ?>
              <td class="no-print text-right"><span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($purchase_line->purchase_price / $xr, false); ?></span></td>
              <td class="no-print text-right"><span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($purchase_line->quantity * $purchase_line->purchase_price / $xr, false); ?></span></td>
              <?php if($p_show_tax): ?>
              <td class="text-right"><span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($tax_charged / $xr, false); ?> </span> <br/><small>( <?php if(!empty($taxes[$purchase_line->tax_id])): ?> <?php echo e($taxes[$purchase_line->tax_id], false); ?>  <?php if($tax_types[$purchase_line->tax_id] == 'fixed'): ?> (<?php echo e('Rs '. $tax_rates[$purchase_line->tax_id], false); ?>) <?php else: ?> <?php echo e('@'.$tax_rates[$purchase_line->tax_id].'%', false); ?> <?php endif; ?>  <?php endif; ?>  )</small></td>
              <?php endif; ?>
              <?php if($p_show_price_inc_tax): ?>
              <td class="text-right"><span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($purchase_line->purchase_price_inc_tax / $xr, false); ?></span></td>
              <?php endif; ?>
              <?php if($p_show_gp_sell_price): ?>
                <?php
                  $pp = $purchase_line->purchase_price_inc_tax;
                  $sp = $purchase_line->variations->sell_price_inc_tax ?? 0;
                  if(!empty($purchase_line->sub_unit->base_unit_multiplier)) {
                      $sp = $sp * $purchase_line->sub_unit->base_unit_multiplier;
                  }
                  if(!empty($purchase_line->sell_price) && $purchase_line->sell_price != 0) {
                      $sp = $purchase_line->sell_price;
                  }
                  if($pp == 0) {
                      $profit_percent = 100;
                  } elseif ($sp != 0) {
                      $profit_percent = (($sp - $pp) / $sp) * 100;
                  } else {
                      $profit_percent = 0;
                  }
                ?>
              <?php endif; ?>
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
              <td class="text-right"><span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($purchase_line->purchase_price_inc_tax * $purchase_line->quantity / $xr, false); ?></span></td>
              <?php if($p_show_gp_sell_price): ?>
                <td class="text-right"><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $profit_percent, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?> %</td>
                <td class="text-right"><span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($sp / $xr, false); ?></span></td>
              <?php endif; ?>
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
              <td><span class="display_currency" data-currency_symbol="false"><?php echo e($payment_line->amount, false); ?></span></td>
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
            <th><?php echo app('translator')->get('purchase.net_total_amount'); ?><?php echo e($sel_suffix, false); ?>: </th>
            <td></td>
            <td><span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($total_inc_tax / $xr, false); ?></span></td>
          </tr>
          <tr>
            <th>Invoice Discount<?php echo e($sel_suffix, false); ?>:</th>
            <td>
              <b>(-)</b>
              <?php if($purchase->discount_type == 'percentage'): ?>
                (<?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $purchase->discount_amount, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?> %)
              <?php endif; ?>
            </td>
            <td>
              <span class="display_currency sel-currency-val float-end" data-currency_symbol="false">
                <?php if($purchase->discount_type == 'percentage'): ?>
                  <?php echo e($purchase->discount_amount * $total_inc_tax / 100 / $xr, false); ?>

                <?php else: ?>
                  <?php echo e($purchase->discount_amount / $xr, false); ?>

                <?php endif; ?>                  
              </span>
            </td>
          </tr>
          <?php if(!empty($pcs['enable_total_discount2_purchase'])): ?>
          <tr>
            <th>Invoice Discount 2<?php echo e($sel_suffix, false); ?>:</th>
            <td>
              <b>(-)</b>
              <?php if($purchase->discount2_type == 'percentage'): ?>
                (<?php echo e($purchase->discount2_amount, false); ?> %)
              <?php endif; ?>
            </td>
            <td>
              <span class="display_currency sel-currency-val float-end" data-currency_symbol="false">
                <?php if($purchase->discount2_type == 'percentage'): ?>
                  <?php echo e($purchase->discount2_amount * $total_inc_tax / 100 / $xr, false); ?>

                <?php else: ?>
                  <?php echo e($purchase->discount2_amount / $xr, false); ?>

                <?php endif; ?>                  
              </span>
            </td>
          </tr>
          <?php endif; ?>
          <?php if(!empty($pcs['enable_total_tax_purchase'])): ?>
          <tr>
            
            <th>Invoice Tax<?php echo e($sel_suffix, false); ?>:</th>
            <td><b>(+)</b></td>
            <td class="text-right">
                <?php if(!empty($purchase_taxes)): ?>
                  <?php $__currentLoopData = $purchase_taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <strong><small><?php echo e($k, false); ?></small></strong> - <span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($v / $xr, false); ?></span><br>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                0.00
                <?php endif; ?>
              </td>
          </tr>
          <?php endif; ?>
          <?php if($phdr_show_shipping && !empty( $purchase->shipping_charges )): ?>
            <tr>
              <th><?php echo app('translator')->get('purchase.additional_shipping_charges'); ?><?php echo e($sel_suffix, false); ?>:</th>
              <td><b>(+)</b></td>
              <td><span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($purchase->shipping_charges / $xr, false); ?></span></td>
            </tr>
          <?php endif; ?>
          <?php if($phdr_show_additional_expense): ?>
          <?php if( !empty( $purchase->additional_expense_value_1 )  && !empty( $purchase->additional_expense_key_1 )): ?>
            <tr>
              <th><?php echo e($purchase->additional_expense_key_1, false); ?>:</th>
              <td><b>(+)</b></td>
              <td><span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($purchase->additional_expense_value_1 / $xr, false); ?></span></td>
            </tr>
          <?php endif; ?>
          <?php if( !empty( $purchase->additional_expense_value_2 )  && !empty( $purchase->additional_expense_key_2 )): ?>
            <tr>
              <th><?php echo e($purchase->additional_expense_key_2, false); ?>:</th>
              <td><b>(+)</b></td>
              <td><span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($purchase->additional_expense_value_2 / $xr, false); ?></span></td>
            </tr>
          <?php endif; ?>
          <?php if( !empty( $purchase->additional_expense_value_3 )  && !empty( $purchase->additional_expense_key_3 )): ?>
            <tr>
              <th><?php echo e($purchase->additional_expense_key_3, false); ?>:</th>
              <td><b>(+)</b></td>
              <td><span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($purchase->additional_expense_value_3 / $xr, false); ?></span></td>
            </tr>
          <?php endif; ?>
          <?php if( !empty( $purchase->additional_expense_value_4 ) && !empty( $purchase->additional_expense_key_4 )): ?>
            <tr>
              <th><?php echo e($purchase->additional_expense_key_4, false); ?>:</th>
              <td><b>(+)</b></td>
              <td><span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($purchase->additional_expense_value_4 / $xr, false); ?></span></td>
            </tr>
          <?php endif; ?>
          <?php endif; ?>
          <tr>
            <th><?php echo app('translator')->get('purchase.purchase_total'); ?><?php echo e($biz_suffix, false); ?>:</th>
            <td></td>
            <td><span class="display_currency float-end" data-currency_symbol="false" ><?php echo e($purchase->final_total, false); ?></span></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
    <?php if($phdr_show_shipping): ?>
    <div class="col-sm-6">
      <strong><?php echo app('translator')->get('purchase.shipping_details'); ?>:</strong><br>
      <p class="well well-sm no-shadow bg-gray">
        <?php echo e($purchase->shipping_details ?? '', false); ?>


        <?php if(!empty($purchase->shipping_custom_field_1)): ?>
          <br><strong><?php echo e($custom_labels['purchase_shipping']['custom_field_1'] ?? '', false); ?>: </strong> <?php echo e($purchase->shipping_custom_field_1, false); ?>

        <?php endif; ?>
        <?php if(!empty($purchase->shipping_custom_field_2)): ?>
          <br><strong><?php echo e($custom_labels['purchase_shipping']['custom_field_2'] ?? '', false); ?>: </strong> <?php echo e($purchase->shipping_custom_field_2, false); ?>

        <?php endif; ?>
        <?php if(!empty($purchase->shipping_custom_field_3)): ?>
          <br><strong><?php echo e($custom_labels['purchase_shipping']['custom_field_3'] ?? '', false); ?>: </strong> <?php echo e($purchase->shipping_custom_field_3, false); ?>

        <?php endif; ?>
        <?php if(!empty($purchase->shipping_custom_field_4)): ?>
          <br><strong><?php echo e($custom_labels['purchase_shipping']['custom_field_4'] ?? '', false); ?>: </strong> <?php echo e($purchase->shipping_custom_field_4, false); ?>

        <?php endif; ?>
        <?php if(!empty($purchase->shipping_custom_field_5)): ?>
          <br><strong><?php echo e($custom_labels['purchase_shipping']['custom_field_5'] ?? '', false); ?>: </strong> <?php echo e($purchase->shipping_custom_field_5, false); ?>

        <?php endif; ?>
      </p>
    </div>
    <?php endif; ?>
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
  <?php if(!empty($activities)): ?>
  <div class="row">
    <div class="col-md-12">
          <strong><?php echo e(__('lang_v1.activities'), false); ?>:</strong><br>
          <?php if ($__env->exists('activity_log.activities', ['activity_type' => 'purchase'])) echo $__env->make('activity_log.activities', ['activity_type' => 'purchase'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
  </div>
  <?php endif; ?>

  
  <div class="row print_section">
    <div class="col-12">
      <img class="center-block" src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($purchase->ref_no, 'C128', 2,30,array(39, 48, 54), true), false); ?>">
    </div>
  </div>
</div>
