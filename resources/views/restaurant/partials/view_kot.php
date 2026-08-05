<div class="modal-dialog modal-md no-print" role="document">
  <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title" id="modalTitle"> <?php echo app('translator')->get('sale.sell_details'); ?> (<b><?php if($sell->type == 'sales_order'): ?> <?php echo app('translator')->get('restaurant.order_no'); ?> <?php else: ?> <?php echo app('translator')->get('sale.invoice_no'); ?> <?php endif; ?> :</b> <?php echo e($sell->invoice_no, false); ?>)
    </h4>
    <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
    
</div>
<div class="modal-body">
    <div class="row">
      <div class="col-12">
          <p class="float-end"><b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($sell->transaction_date))->format(session('business.date_format')), false); ?></p>
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
        <b><?php if($sell->type == 'sales_order'): ?> <?php echo e(__('restaurant.order_no'), false); ?> <?php else: ?> <?php echo e(__('sale.invoice_no'), false); ?> <?php endif; ?>:</b><br> #<?php echo e($sell->invoice_no, false); ?><br>
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
          <br><b><?php echo e(__('sale.fbr_invoice_no'), false); ?>:</b> <?php echo e($sell->fbr_invoice_no, false); ?>

        <?php endif; ?>
        <?php if(!empty($sell->ref_no)): ?>
          <br><b><?php echo e(__('sale.ref_no'), false); ?>:</b> <?php echo e($sell->ref_no, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_1'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_1'] ?? '', false); ?>: </strong> <?php echo e($sell->custom_field_1, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_2'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_2'] ?? '', false); ?>: </strong> <?php echo e($sell->custom_field_2, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_3'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_3'] ?? '', false); ?>: </strong> <?php echo e($sell->custom_field_3, false); ?>

        <?php endif; ?>
        <?php if(!empty($custom_labels['sell']['custom_field_4'])): ?>
          <br><strong><?php echo e($custom_labels['sell']['custom_field_4'] ?? '', false); ?>: </strong> <?php echo e($sell->custom_field_4, false); ?>

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
        <b><?php echo e(__('sale.customer_name'), false); ?>:</b> <?php echo e($sell->contact->name, false); ?><br>
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
        
      </div>
      <div class="<?php if(!empty($export_custom_fields)): ?> col-sm-3 <?php else: ?> col-sm-4 <?php endif; ?>">
      <?php if(in_array('tables' ,$enabled_modules)): ?>
         <strong><?php echo app('translator')->get('restaurant.table'); ?>:</strong>
          <?php echo e($sell->table->name ?? '', false); ?><br>
      <?php endif; ?>
      <?php if(in_array('service_staff' ,$enabled_modules)): ?>
          <strong><?php echo app('translator')->get('restaurant.service_staff'); ?>:</strong>
          <?php echo e($sell->service_staff->user_full_name ?? '', false); ?><br>
      <?php endif; ?>

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
    <br>
    <div class="row">
      <div class="col-sm-12 col-12">
        <h4><?php echo e(__('sale.products'), false); ?>:</h4>
      </div>

      <div class="col-sm-12 col-12">
        <div class="table-responsive">
          <?php echo $__env->make('restaurant.partials.sale_line_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
      </div>
    </div>
    <?php if(empty($kot_layout->common_settings['hide_price_total'])): ?>
    <div class="row">
      <?php
        $kot_layout->module_info = json_decode($kot_layout->module_info, true);
        $total_paid = 0;
      ?>
      <div class="col-md-12 col-sm-12 col-12">
        <div class="table-responsive">
          <table class="table bg-gray">
            <?php if(!empty($kot_layout->sub_total_label)): ?>
            <tr>
              <th><?php echo e(!empty($kot_layout->sub_total_label) ? $kot_layout->sub_total_label : __('sale.subtotal'), false); ?>: </th>
              <td></td>
              <td><span class="display_currency float-end" data-currency_symbol="true"><?php echo e($sell->total_before_tax, false); ?></span></td>
            </tr>
            <?php endif; ?>
            <?php if(in_array('types_of_service' , $enabled_modules) && !empty($sell->packing_charge)): ?>
              <tr>
                <th><?php echo e(!empty($kot_layout->module_info['types_of_service']['types_of_service_label']) ? $kot_layout->module_info['types_of_service']['types_of_service_label'] : __('lang_v1.packing_charge'), false); ?>:</th>
                <td><b>(+)</b></td>
                <td><div class="float-end"><span class="display_currency" <?php if( $sell->packing_charge_type == 'fixed'): ?> data-currency_symbol="true" <?php endif; ?>><?php echo e($sell->packing_charge, false); ?></span> <?php if( $sell->packing_charge_type == 'percent'): ?> <?php echo e('%', false); ?> <?php endif; ?> </div></td>
              </tr>
            <?php endif; ?>
            
            <?php if(!empty($kot_layout->total_label)): ?>
            <tr>
              <th><?php echo e(!empty($kot_layout->total_label) ? $kot_layout->total_label : __('sale.total'), false); ?>: </th>
              <td></td>
              <td><span class="display_currency float-end" data-currency_symbol="true"><?php echo e($sell->final_total, false); ?></span></td>
            </tr>
            <?php endif; ?>
          </table>
        </div>
      </div>
    </div>
    <?php endif; ?>
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
  </div>
  <div class="modal-footer">
      <button type="button" class="btn btn-default no-print" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    var element = $('div.modal-xl');
    __currency_convert_recursively(element);
  });
</script>
