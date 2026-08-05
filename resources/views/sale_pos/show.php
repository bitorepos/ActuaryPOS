<div class="modal-dialog modal-xl modal-dialog-scrollable no-print" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="modalTitle"> <?php echo app('translator')->get('sale.sell_details'); ?> (<b><?php if($sell->type == 'sales_order'): ?> <?php echo app('translator')->get('restaurant.order_no'); ?> <?php else: ?> <?php echo app('translator')->get('sale.invoice_no'); ?> <?php endif; ?> :</b> <?php echo e($sell->invoice_no, false); ?>)</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   
    </div>
<div class="modal-body" style="overflow-x: auto;">
    <?php
      $hdr_cs = isset($common_settings) && ! empty($common_settings) ? $common_settings : (session()->get('business.common_settings') ?? []);
      $hdr_ps = $pos_settings ?? [];

      // Determine if POS/Draft or Sales context
      $hdr_is_pos_or_draft = (!empty($sell) && (
          $sell->type == 'draft' || 
          ($sell->type == 'sell' && empty($sell->is_direct_sale))
      ));

      if ($hdr_is_pos_or_draft) {
          // POS tab header settings
          $hdr_show_pay_term    = true; // POS always shows pay term
          $hdr_hide_address     = false;
          $hdr_show_shipping    = true; // POS always shows shipping if data exists
          $hdr_show_additional_expense = true;
      } else {
          // Sales tab header settings
          $hdr_show_pay_term    = empty($hdr_cs['hide_pay_turm']);
          $hdr_hide_address     = !empty($hdr_cs['hide_address_info']);
          $hdr_show_shipping    = !empty($hdr_cs['enable_shipping_details_sale']);
          $hdr_show_additional_expense = !empty($hdr_cs['enable_additional_expense_sale']);
      }

      // Invoice layout name shown in the sale view modal.
      if (!empty($sell->invoice_layout)) {
          $hdr_layout_name = $sell->invoice_layout->name;
      } elseif ($sell->sub_status == 'table_order_bill') {
          $fallback_id = !empty($sell->table->layout_id) ? $sell->table->layout_id : null;
          if (empty($fallback_id)) {
              $fallback_id = \App\InvoiceLayout::where('business_id', $sell->business_id)
                  ->where('name', 'POS_BILL')
                  ->value('id');
          }
          if (empty($fallback_id) && !empty($sell->location)) {
              $fallback_id = $sell->location->invoice_layout_id;
          }
          $hdr_layout_name = $fallback_id ? \App\InvoiceLayout::where('id', $fallback_id)->value('name') : null;
      } elseif (!empty($sell->location)) {
          $fallback_id = $hdr_is_pos_or_draft
              ? $sell->location->invoice_layout_id
              : ($sell->location->sale_invoice_layout_id ?? $sell->location->invoice_layout_id);
          $hdr_layout_name = $fallback_id ? \App\InvoiceLayout::where('id', $fallback_id)->value('name') : null;
      } else {
          $hdr_layout_name = null;
      }

      // Round off visibility
      $hdr_show_round_off = !empty($hdr_ps['amount_rounding_method']);

      // Currency symbols for modal labels (dual: selected currency for subtotal-level, business currency for total/due)
      $business_currency_symbol = session('currency')['symbol'] ?? '';
      $business_currency_code = session('currency')['code'] ?? '';
      $selected_currency_symbol = $business_currency_symbol;
      $selected_currency_name = null;
      $selected_currency_code = null;
      if (!empty($sell->location_currency_id)) {
          $loc_currency = \App\LocationCurrency::find($sell->location_currency_id);
          if (!empty($loc_currency) && !empty($loc_currency->symbol)) {
              $selected_currency_symbol = $loc_currency->symbol;
              $selected_currency_name = $loc_currency->currency;
              $selected_currency_code = $loc_currency->code;
          }
      }
      $sel_suffix = !empty($selected_currency_symbol) ? ' (' . $selected_currency_symbol . ')' : '';
      $biz_suffix = !empty($business_currency_symbol) ? ' (' . $business_currency_symbol . ')' : '';
      $xr = $sell->exchange_rate ?: 1;
    ?>
    <div class="row">
      <div class="col-12">
          <p class="float-end"><b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(($sell->transaction_date), false); ?></p>
      </div>
    </div>
    <div class="row">
      <?php
        $custom_labels = json_decode(session('business.custom_labels'), true);
        $export_custom_fields = [];
        if (!empty($sell->is_export) && !empty($sell->export_custom_fields_info)) {
            $export_custom_fields = $sell->export_custom_fields_info;
        }
      ?>
      <div class="<?php if(!empty($export_custom_fields)): ?> col-sm-3 <?php else: ?> col-sm-4 <?php endif; ?>">
        <b><?php if($sell->type == 'sales_order'): ?> <?php echo e(__('restaurant.order_no'), false); ?> <?php else: ?> <?php echo e(__('sale.invoice_no'), false); ?> <?php endif; ?>:</b> #<?php echo e($sell->invoice_no, false); ?><br>
        <b><?php echo e(__('sale.status'), false); ?>:</b> 
          <?php if($sell->status == 'draft' && $sell->is_quotation == 1): ?>
            <?php echo e(__('lang_v1.quotation'), false); ?>

          <?php else: ?>
            <?php echo e($statuses[$sell->status] ?? __('sale.' . $sell->status), false); ?>

          <?php endif; ?>
        <br>
        <?php if($sell->type != 'sales_order'): ?>
          <b><?php echo e(__('sale.payment_status'), false); ?>:</b> <?php if(!empty($sell->payment_status)): ?><?php echo e(__('lang_v1.' . $sell->payment_status), false); ?>

          <?php endif; ?>
        <?php endif; ?>
        <?php if(!empty($sell->fbr_invoice_no)): ?>
          <br><b><?php echo e(__('lang_v1.is_inclusive'), false); ?>:</b> <?php echo e(($sell->is_inclusive) ? 'Yes' : 'No', false); ?>

        <?php endif; ?>
        <?php if(!empty($sell->fbr_invoice_no)): ?>
          <br><b><?php echo e(__('sale.fbr_invoice_no'), false); ?>:</b> <?php echo e($sell->fbr_invoice_no, false); ?>

        <?php endif; ?>
        
        <?php if(!empty($display_ref_no)): ?>
          <br><b><?php echo e(__('sale.ref_no'), false); ?>:</b> <?php echo e($display_ref_no, false); ?>

        <?php endif; ?>

        <?php if(!empty($hdr_layout_name)): ?>
          <br><b><?php echo app('translator')->get('invoice.layout_name'); ?>:</b> <?php echo e($hdr_layout_name, false); ?>

        <?php endif; ?>

        <?php if(!empty($selected_currency_name)): ?>
          <br><b><?php echo app('translator')->get('business.currency'); ?>:</b> <?php echo e($selected_currency_name, false); ?> (<?php echo e($selected_currency_code, false); ?>)
          <br><b>Conversion Rate:</b> 1 <?php echo e($selected_currency_code, false); ?> = <?php echo e(rtrim(rtrim(number_format($loc_currency->multiplier, 9, '.', ''), '0'), '.'), false); ?> <?php echo e($business_currency_code, false); ?>

        <?php else: ?>
          <br><b><?php echo app('translator')->get('business.currency'); ?>:</b> <?php echo app('translator')->get('lang_v1.default_currency'); ?> (<?php echo e($business_currency_code, false); ?>)
        <?php endif; ?>

        <?php if($hdr_show_pay_term && (!empty($sell->pay_term_number) || !empty($sell->pay_term_type))): ?>
          <br><b><?php echo app('translator')->get('contact.pay_term'); ?>:</b>
          <?php if($sell->pay_term_type == 'days'): ?>
            <?php echo e($sell->pay_term_number, false); ?> <?php echo app('translator')->get('lang_v1.days'); ?>
          <?php elseif($sell->pay_term_type == 'months'): ?>
            <?php echo e($sell->pay_term_number, false); ?> <?php echo app('translator')->get('lang_v1.months'); ?>
          <?php endif; ?>
        <?php endif; ?>

        <?php if(!empty($sell->sale_commission_agent)): ?>
          <br><b><?php echo app('translator')->get('lang_v1.commission_agent'); ?>:</b> <?php echo e($sell->sale_commission_agent->user_full_name ?? '', false); ?>

        <?php endif; ?>

        <?php if(!empty($sales_orders)): ?>
              <br><br><strong><?php echo app('translator')->get('lang_v1.sales_orders'); ?>:</strong>
             <table class="table table-slim no-border">
               <tr>
                 <th><?php echo app('translator')->get('lang_v1.sales_order'); ?></th>
                 <th><?php echo app('translator')->get('lang_v1.date'); ?></th>
               </tr>
               <?php $__currentLoopData = $sales_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $so): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($so->invoice_no, false); ?></td>
                  <td><?php echo format_datetime_br($so->transaction_date); ?></td>
                </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </table>
          <?php endif; ?>
        <?php if($sell->document_path): ?>
          <br>
          <br>
          <a href="<?php echo e($sell->document_path, false); ?>" 
          download="<?php echo e($sell->document_name, false); ?>" class="btn btn-sm btn-success float-start no-print">
            <i class="fa fa-download"></i> 
              &nbsp;<?php echo e(__('purchase.download_document'), false); ?>

          </a>
        <?php endif; ?>
      </div>
      <div class="<?php if(!empty($export_custom_fields)): ?> col-sm-3 <?php else: ?> col-sm-4 <?php endif; ?>">
        <?php if(!empty($sell->contact->supplier_business_name)): ?>
          <?php echo e($sell->contact->supplier_business_name, false); ?><br>
        <?php endif; ?>
        <?php if(!empty($sell->contact->contact_id)): ?>
          <b><?php echo app('translator')->get('lang_v1.contact_id'); ?>:</b> <?php echo e($sell->contact->contact_id, false); ?><br>
        <?php endif; ?>
        <b><?php echo e(__('sale.customer_name'), false); ?>:</b> <?php echo e($sell->contact->name, false); ?><br>
        <?php if(!empty($sell->contact->tax_number)): ?>
          <b><?php echo app('translator')->get('contact.tax_no'); ?>:</b> <?php echo e($sell->contact->tax_number, false); ?><br>
        <?php endif; ?>
        <?php if(!$hdr_hide_address): ?>
          <b><?php echo e(__('business.address'), false); ?>:</b><br>
          <?php if(!empty($sell->billing_address())): ?>
            <?php echo e($sell->billing_address(), false); ?>

          <?php else: ?>
            <?php echo $sell->contact->contact_address; ?>

            <?php if($sell->contact->mobile): ?>
            <br>
                <?php echo e(__('contact.mobile'), false); ?>: <?php echo e($sell->contact->mobile, false); ?>

            <?php endif; ?>
            <?php if($sell->contact->alternate_number): ?>
            <br>
                <?php echo e(__('contact.alternate_contact_number'), false); ?>: <?php echo e($sell->contact->alternate_number, false); ?>

            <?php endif; ?>
            <?php if($sell->contact->landline): ?>
              <br>
                <?php echo e(__('contact.landline'), false); ?>: <?php echo e($sell->contact->landline, false); ?>

            <?php endif; ?>
            <?php if($sell->contact->email): ?>
              <br>
                <?php echo e(__('business.email'), false); ?>: <?php echo e($sell->contact->email, false); ?>

            <?php endif; ?>
          <?php endif; ?>
        <?php endif; ?>

      </div>
      <div class="<?php if(!empty($export_custom_fields)): ?> col-sm-3 <?php else: ?> col-sm-4 <?php endif; ?>">
      
      <?php if(!empty($sell->business)): ?>
        <strong><?php echo app('translator')->get('business.business'); ?>:</strong>
        <address>
          <strong><?php echo e($sell->business->name, false); ?></strong>
          <?php if(!empty($sell->location)): ?>
            <?php echo e($sell->location->name, false); ?>

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
        </address>
      <?php endif; ?>

      <?php if(in_array('tables' ,$enabled_modules)): ?>
         <strong><?php echo app('translator')->get('restaurant.table'); ?>:</strong>
          <?php echo e($sell->table->name ?? '', false); ?><br>
      <?php endif; ?>
      <?php if(in_array('service_staff' ,$enabled_modules)): ?>
          <strong><?php echo app('translator')->get('restaurant.service_staff'); ?>:</strong>
          <?php echo e($sell->service_staff->user_full_name ?? '', false); ?><br>
      <?php endif; ?>

      <?php if($hdr_show_shipping): ?>
      <strong><?php echo app('translator')->get('sale.shipping'); ?>:</strong>
      <span class="label <?php if(!empty($shipping_status_colors[$sell->shipping_status])): ?> <?php echo e($shipping_status_colors[$sell->shipping_status], false); ?> <?php else: ?> <?php echo e('bg-gray', false); ?> <?php endif; ?>"><?php echo e($shipping_statuses[$sell->shipping_status] ?? '', false); ?></span><br>
      <?php if(!empty($sell->shipping_address())): ?>
        <?php echo e($sell->shipping_address(), false); ?>

      <?php else: ?>
        <?php echo e($sell->shipping_address ?? '--', false); ?>

      <?php endif; ?>
      <?php if(!empty($sell->delivered_to)): ?>
        <br><strong><?php echo app('translator')->get('lang_v1.delivered_to'); ?>: </strong> <?php echo e($sell->delivered_to, false); ?>

      <?php endif; ?>
      <?php if(!empty($sell->shipping_custom_field_1)): ?>
        <br><strong><?php echo e($custom_labels['shipping']['custom_field_1'] ?? '', false); ?>: </strong> <?php echo e($sell->shipping_custom_field_1, false); ?>

      <?php endif; ?>
      <?php if(!empty($sell->shipping_custom_field_2)): ?>
        <br><strong><?php echo e($custom_labels['shipping']['custom_field_2'] ?? '', false); ?>: </strong> <?php echo e($sell->shipping_custom_field_2, false); ?>

      <?php endif; ?>
      <?php if(!empty($sell->shipping_custom_field_3)): ?>
        <br><strong><?php echo e($custom_labels['shipping']['custom_field_3'] ?? '', false); ?>: </strong> <?php echo e($sell->shipping_custom_field_3, false); ?>

      <?php endif; ?>
      <?php if(!empty($sell->shipping_custom_field_4)): ?>
        <br><strong><?php echo e($custom_labels['shipping']['custom_field_4'] ?? '', false); ?>: </strong> <?php echo e($sell->shipping_custom_field_4, false); ?>

      <?php endif; ?>
      <?php if(!empty($sell->shipping_custom_field_5)): ?>
        <br><strong><?php echo e($custom_labels['shipping']['custom_field_5'] ?? '', false); ?>: </strong> <?php echo e($sell->shipping_custom_field_5, false); ?>

      <?php endif; ?>
      <?php
        $medias = $sell->media->where('model_media_type', 'shipping_document')->all();
      ?>
      <?php if(count($medias)): ?>
        <?php echo $__env->make('sell.partials.media_table', ['medias' => $medias], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endif; ?>
      <?php endif; ?>

      <?php if(in_array('types_of_service' ,$enabled_modules)): ?>
        <?php if(!empty($sell->types_of_service)): ?>
          <strong><?php echo app('translator')->get('lang_v1.types_of_service'); ?>:</strong>
          <?php echo e($sell->types_of_service->name, false); ?><br>
        <?php endif; ?>
        <?php if(!empty($sell->types_of_service->enable_custom_fields)): ?>
          <strong><?php echo e($custom_labels['types_of_service']['custom_field_1'] ?? __('lang_v1.service_custom_field_1' ), false); ?>:</strong>
          <?php echo e($sell->service_custom_field_1, false); ?><br>
          <strong><?php echo e($custom_labels['types_of_service']['custom_field_2'] ?? __('lang_v1.service_custom_field_2' ), false); ?>:</strong>
          <?php echo e($sell->service_custom_field_2, false); ?><br>
          <strong><?php echo e($custom_labels['types_of_service']['custom_field_3'] ?? __('lang_v1.service_custom_field_3' ), false); ?>:</strong>
          <?php echo e($sell->service_custom_field_3, false); ?><br>
          <strong><?php echo e($custom_labels['types_of_service']['custom_field_4'] ?? __('lang_v1.service_custom_field_4' ), false); ?>:</strong>
          <?php echo e($sell->service_custom_field_4, false); ?><br>
          <strong><?php echo e($custom_labels['types_of_service']['custom_field_5'] ?? __('lang_v1.custom_field', ['number' => 5]), false); ?>:</strong>
          <?php echo e($sell->service_custom_field_5, false); ?><br>
          <strong><?php echo e($custom_labels['types_of_service']['custom_field_6'] ?? __('lang_v1.custom_field', ['number' => 6]), false); ?>:</strong>
          <?php echo e($sell->service_custom_field_6, false); ?>

        <?php endif; ?>
      <?php endif; ?>
      </div>
      <?php if(!empty($export_custom_fields)): ?>
          <div class="col-sm-3">
                <?php $__currentLoopData = $export_custom_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <strong>
                        <?php
                            $export_label = __('lang_v1.export_custom_field1');
                            if ($label == 'export_custom_field_1') {
                                $export_label =__('lang_v1.export_custom_field1');
                            } elseif ($label == 'export_custom_field_2') {
                                $export_label = __('lang_v1.export_custom_field2');
                            } elseif ($label == 'export_custom_field_3') {
                                $export_label = __('lang_v1.export_custom_field3');
                            } elseif ($label == 'export_custom_field_4') {
                                $export_label = __('lang_v1.export_custom_field4');
                            } elseif ($label == 'export_custom_field_5') {
                                $export_label = __('lang_v1.export_custom_field5');
                            } elseif ($label == 'export_custom_field_6') {
                                $export_label = __('lang_v1.export_custom_field6');
                            }
                        ?>

                        <?php echo e($export_label, false); ?>

                        :
                    </strong> <?php echo e($value ?? '', false); ?> <br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
      <?php endif; ?>
    </div>
    
    <?php
      $sell_custom_fields = [];
      for ($i = 1; $i <= 14; $i++) {
          $field_key = 'custom_field_' . $i;
          if (!empty($custom_labels['sell'][$field_key])) {
              $sell_custom_fields[] = [
                  'label' => $custom_labels['sell'][$field_key],
                  'value' => $sell->$field_key ?? '',
              ];
          }
      }
    ?>
    <?php if(count($sell_custom_fields)): ?>
    <hr class="my-2">
    <div class="row">
      <?php $__currentLoopData = $sell_custom_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-sm-6 mb-1">
          <strong><?php echo e($cf['label'], false); ?>:</strong> <?php echo e($cf['value'], false); ?>

        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
    <br>
    <div class="row">
      <div class="col-sm-12 col-12">
        <h4><?php echo e(__('sale.products'), false); ?>:</h4>
      </div>

      <div class="col-sm-12 col-12">
        <div class="table-responsive">
          <?php echo $__env->make('sale_pos.partials.sale_line_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <?php
        $total_paid = 0;
      ?>
      <?php if($sell->type != 'sales_order'): ?>
      <div class="col-sm-12 col-12">
        <h4><?php echo e(__('sale.payment_info'), false); ?>:</h4>
      </div>
      <div class="col-md-6 col-sm-12 col-12">
        <div class="table-responsive">
          <table class="table bg-gray">
            <tr class="bg-green">
              <th>#</th>
              <th><?php echo e(__('messages.date'), false); ?></th>
              <th><?php echo e(__('purchase.ref_no'), false); ?></th>
              <th><?php echo e(__('sale.location'), false); ?></th>
              <th><?php echo e(__('sale.amount'), false); ?></th>
              <th><?php echo e(__('sale.payment_mode'), false); ?></th>
              <th><?php echo e(__('sale.payment_note'), false); ?></th>
            </tr>
            <?php $__currentLoopData = $sell->payment_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                if($payment_line->is_return == 1){
                  $total_paid -= $payment_line->amount;
                } else {
                  $total_paid += $payment_line->amount;
                }
              ?>
              <tr>
                <td><?php echo e($loop->iteration, false); ?></td>
                <td><?php echo e(\Carbon::createFromTimestamp(strtotime($payment_line->paid_on))->format(session('business.date_format')), false); ?></td>
                <td><?php echo e($payment_line->payment_ref_no, false); ?></td>
                <td><?php echo e($payment_line->location->name, false); ?></td>
                <td><span class="display_currency" data-currency_symbol="false"><?php if($payment_line->is_return == 1): ?><?php echo e(-1*$payment_line->amount, false); ?><?php else: ?> <?php echo e($payment_line->amount, false); ?> <?php endif; ?></span></td>
                <td>
                  <?php echo e($payment_types[$payment_line->method] ?? $payment_line->method, false); ?>

                  <?php if($payment_line->is_return == 1): ?>
                    <br/>
                    ( <?php echo e(__('lang_v1.change_return'), false); ?> )
                  <?php endif; ?>
                </td>
                <td><?php if($payment_line->note): ?> 
                  <?php echo e(ucfirst($payment_line->note), false); ?>

                  <?php else: ?>
                  --
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </table>
        </div>
      </div>
      <?php endif; ?>
      <div class="col-md-6 col-sm-12 col-12 <?php if($sell->type == 'sales_order'): ?> col-md-offset-6 <?php endif; ?>">
        <div class="table-responsive">
          <?php
            $line_discounts = 0;
            $line_discounts2 = 0;
            foreach($sell->sell_lines as $sl){
                $line_discounts += $sl->get_discount_amount($xr) * $sl->quantity;
                $line_discounts2 += $sl->get_discount2_amount($xr) * $sl->quantity;
            }
            $total_before_line_discount = ($sell->total_before_tax / $xr) + $line_discounts + $line_discounts2;
          ?>
          <table class="table bg-gray">
            <tr>
              <th><?php echo e(__('sale.total'), false); ?><?php echo e($sel_suffix, false); ?>: </th>
              <td></td>
              <td><span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($total_before_line_discount, false); ?></span></td>
            </tr>
            <tr>
              <th>
                Invoice Discount<?php echo e($sel_suffix, false); ?>:
                <?php if(!empty($sell->discount)): ?>
                <br><small>(<?php echo e($sell->discount->name, false); ?>)</small>
                <?php endif; ?>
              </th>
              <td><b>(-)</b></td>
              <td><div class="float-end"><?php if($sell->discount_type == 'fixed'): ?><span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($sell->discount_amount / $xr, false); ?></span><?php else: ?> <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $sell->discount_amount, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?>%<?php endif; ?></div></td>
            </tr>
            <?php if(!empty($hdr_cs['enable_total_discount2_sale'])): ?>
            <tr>
              <th>Invoice Discount 2<?php echo e($sel_suffix, false); ?>:</th>
              <td><b>(-)</b></td>
              <td><div class="float-end"><?php if($sell->discount2_type == 'fixed'): ?><span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($sell->discount2_amount / $xr, false); ?></span><?php else: ?> <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $sell->discount2_amount, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?>%<?php endif; ?></div></td>
            </tr>
            <?php endif; ?>
            <tr>
              <th>Inline Discount<?php echo e($sel_suffix, false); ?>:</th>
              <td></td>
                <td><div class="float-end"><span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($line_discounts, false); ?></span></div></td>
            </tr>
            <?php if(!empty($hdr_cs['enable_total_discount2_sale'])): ?>
            <tr>
              <th>Inline Discount 2<?php echo e($sel_suffix, false); ?>:</th>
              <td></td>
                <td><div class="float-end"><span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($line_discounts2, false); ?></span></div></td>
            </tr>
            <?php endif; ?>
            <?php if(in_array('types_of_service' ,$enabled_modules) && !empty($sell->packing_charge)): ?>
              <tr>
                <th> 
                  <?php if(!empty($sell->types_of_service)): ?>
                    <?php echo e($sell->types_of_service->name, false); ?>:
                  <?php else: ?>
                    <?php echo e(__('lang_v1.types_of_service'), false); ?>:
                  <?php endif; ?>
                </th>
                <td><b>(+)</b></td>
                <?php if(empty($sell->types_of_service)): ?>
                <td><div class="float-end"><span class="display_currency"><?php echo e(0, false); ?></span> % </div></td>
                <?php else: ?>
                <td><div class="float-end"><span class="display_currency <?php if($sell->packing_charge_type == 'fixed'): ?> sel-currency-val <?php endif; ?>" <?php if( $sell->packing_charge_type == 'fixed'): ?> data-currency_symbol="false" <?php endif; ?>><?php echo e($sell->packing_charge_type == 'fixed' ? $sell->packing_charge / $xr : $sell->packing_charge, false); ?></span> <?php if( $sell->packing_charge_type == 'percent'): ?> <?php echo e('%', false); ?> <?php endif; ?> </div></td>
                <?php endif; ?>
                  
              </tr>
            <?php endif; ?>
            <?php if(session('business.enable_rp') == 1 && !empty($sell->rp_redeemed) ): ?>
              <tr>
                <th><?php echo e(session('business.rp_name'), false); ?>:</th>
                <td><b>(-)</b></td>
                <td> <span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($sell->rp_redeemed_amount / $xr, false); ?></span></td>
              </tr>
            <?php endif; ?>
            <?php if(!empty($hdr_cs['enable_total_tax_sale'])): ?>
            <tr>
              <th>Invoice Tax<?php echo e($sel_suffix, false); ?>:</th>
              <td><b>(+)</b></td>
              <td class="text-right">
                <?php if(!empty($order_taxes)): ?>
                  <?php $__currentLoopData = $order_taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <strong><small><?php echo e($k, false); ?></small></strong> - <span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($v / $xr, false); ?></span><br>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                0.00
                <?php endif; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($line_taxes)): ?>
            <tr>
              <th>Inline Tax<?php echo e($sel_suffix, false); ?>:</th>
              <td></td>
              <td class="text-right">
                <?php if(!empty($line_taxes)): ?>
                  <?php $__currentLoopData = $line_taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <strong><small><?php echo e($k, false); ?></small></strong> <span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($v / $xr, false); ?></span><br>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                0.00
                <?php endif; ?>
              </td>
            </tr>
            <?php endif; ?>
            <?php if($hdr_show_shipping): ?>
            <tr>
              <th><?php echo e(__('sale.shipping'), false); ?><?php echo e($sel_suffix, false); ?>: <?php if($sell->shipping_details): ?>(<?php echo e($sell->shipping_details, false); ?>) <?php endif; ?></th>
              <td><b>(+)</b></td>
              <td><span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($sell->shipping_charges / $xr, false); ?></span></td>
            </tr>
            <?php endif; ?>

            <?php if($hdr_show_additional_expense): ?>
            <?php if( !empty( $sell->additional_expense_value_1 )  && !empty( $sell->additional_expense_key_1 )): ?>
              <tr>
                <th><?php echo e($sell->additional_expense_key_1, false); ?>:</th>
                <td><b>(+)</b></td>
                <td><span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($sell->additional_expense_value_1 / $xr, false); ?></span></td>
              </tr>
            <?php endif; ?>
            <?php if( !empty( $sell->additional_expense_value_2 )  && !empty( $sell->additional_expense_key_2 )): ?>
              <tr>
                <th><?php echo e($sell->additional_expense_key_2, false); ?>:</th>
                <td><b>(+)</b></td>
                <td><span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($sell->additional_expense_value_2 / $xr, false); ?></span></td>
              </tr>
            <?php endif; ?>
            <?php if( !empty( $sell->additional_expense_value_3 )  && !empty( $sell->additional_expense_key_3 )): ?>
              <tr>
                <th><?php echo e($sell->additional_expense_key_3, false); ?>:</th>
                <td><b>(+)</b></td>
                <td><span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($sell->additional_expense_value_3 / $xr, false); ?></span></td>
              </tr>
            <?php endif; ?>
            <?php if( !empty( $sell->additional_expense_value_4 ) && !empty( $sell->additional_expense_key_4 )): ?>
              <tr>
                <th><?php echo e($sell->additional_expense_key_4, false); ?>:</th>
                <td><b>(+)</b></td>
                <td><span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($sell->additional_expense_value_4 / $xr, false); ?></span></td>
              </tr>
            <?php endif; ?>
            <?php endif; ?>
            <?php if($hdr_show_round_off): ?>
            <tr>
              <th><?php echo e(__('lang_v1.round_off'), false); ?><?php echo e($sel_suffix, false); ?>: </th>
              <td></td>
              <td><span class="display_currency sel-currency-val float-end" data-currency_symbol="false"><?php echo e($sell->round_off_amount / $xr, false); ?></span></td>
            </tr>
            <?php endif; ?>
            <tr>
              <th><?php echo e(__('sale.total_payable'), false); ?><?php echo e($biz_suffix, false); ?>: </th>
              <td></td>
              <td><span class="display_currency float-end" data-currency_symbol="false"><?php echo e($sell->final_total, false); ?></span></td>
            </tr>
            <?php if($sell->type != 'sales_order'): ?>
            <tr>
              <th><?php echo e(__('sale.total_paid'), false); ?><?php echo e($biz_suffix, false); ?>:</th>
              <td></td>
              <td><span class="display_currency float-end" data-currency_symbol="false" ><?php echo e($total_paid, false); ?></span></td>
            </tr>
            <tr>
              <th><?php echo e(__('sale.total_remaining'), false); ?><?php echo e($biz_suffix, false); ?>:</th>
              <td></td>
              <td>
                <!-- Converting total paid to string for floating point substraction issue -->
                <?php
                  $total_paid = (string) $total_paid;
                ?>
                <span class="display_currency float-end" data-currency_symbol="false" ><?php echo e($sell->final_total - $total_paid, false); ?></span></td>
            </tr>
            <?php endif; ?>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <strong><?php echo e(__( 'sale.sell_note'), false); ?>:</strong><br>
        <p class="well well-sm no-shadow bg-gray">
          <?php if($sell->additional_notes): ?>
            <?php echo nl2br($sell->additional_notes); ?>

          <?php else: ?>
            --
          <?php endif; ?>
        </p>
      </div>
      <div class="col-sm-6">
        <strong><?php echo e(__( 'sale.staff_note'), false); ?>:</strong><br>
        <p class="well well-sm no-shadow bg-gray">
          <?php if($sell->staff_note): ?>
            <?php echo nl2br($sell->staff_note); ?>

          <?php else: ?>
            --
          <?php endif; ?>
        </p>
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
    <?php if($sell->type != 'sales_order'): ?>
    <a href="#" class="print-invoice btn btn-success" data-href="<?php echo e(route('sell.printInvoice', [$sell->id]), false); ?>?package_slip=true"><i class="fas fa-file-alt" aria-hidden="true"></i> <?php echo app('translator')->get("lang_v1.packing_slip"); ?></a>
    <?php endif; ?>
    <?php if($sell->is_direct_sale == 1): ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reprint_sale_invoice')): ?>
        <a href="#" class="print-invoice btn btn-primary" data-href="<?php echo e(route('sell.printInvoice', [$sell->id]), false); ?>"><i class="fa fa-print" aria-hidden="true"></i> <?php echo app('translator')->get("lang_v1.print_invoice"); ?></a>
      <?php endif; ?>
    <?php else: ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print_invoice')): ?>
        <a href="#" class="print-invoice btn btn-primary" data-href="<?php echo e(route('sell.printInvoice', [$sell->id]), false); ?>"><i class="fa fa-print" aria-hidden="true"></i> <?php echo app('translator')->get("lang_v1.print_invoice"); ?></a>
      <?php endif; ?>
    <?php endif; ?>
    
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
        <?php echo app('translator')->get('messages.close'); ?>
      </button>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    var element = $('div.modal-xl');
    __currency_convert_recursively(element);
  });
</script>
