<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalTitle"> <?php echo app('translator')->get('lang_v1.purchase_return_details'); ?> (<b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b>
                #<?php echo e($purchase->return_parent->ref_no ?? $purchase->ref_no, false); ?>)
            </h4>
            <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
            
        </div>

        <div class="modal-body">
            <?php
              $custom_labels = json_decode(session('business.custom_labels'), true) ?? [];
              // Invoice layout name
              if (!empty($purchase->invoice_layout)) {
                  $pr_layout_name = $purchase->invoice_layout->name;
              } elseif (!empty($purchase->location)) {
                  $loc_settings = $purchase->location->loc_settings ?? [];
                  $fallback_id = $loc_settings['purchase_layout_id'] ?? null;
                  $pr_layout_name = $fallback_id ? \App\InvoiceLayout::where('id', $fallback_id)->value('name') : null;
              } else {
                  $pr_layout_name = null;
              }
            ?>
            <div class="row">
                <?php if(!empty($purchase->return_parent)): ?>
                    <div class="col-sm-4 col-12">
                        <h4><?php echo app('translator')->get('lang_v1.purchase_return_details'); ?>:</h4>
                        <strong><?php echo app('translator')->get('lang_v1.return_date'); ?>:</strong>
                        <?php echo e(\Carbon::createFromTimestamp(strtotime($purchase->return_parent->transaction_date))->format(session('business.date_format')), false); ?><br>
                        <strong><?php echo app('translator')->get('purchase.supplier'); ?>:</strong> <?php echo $purchase->contact->contact_address; ?>

                        <?php if(!empty($purchase->contact->tax_number)): ?>
                          <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($purchase->contact->tax_number, false); ?>

                        <?php endif; ?>
                        <br><strong><?php echo app('translator')->get('purchase.business_location'); ?>:</strong> <?php echo e($purchase->location->name, false); ?>

                        <?php if(!empty($purchase->pay_term_number)): ?>
                          <br><strong><?php echo app('translator')->get('contact.pay_term'); ?>:</strong> <?php echo e($purchase->pay_term_number, false); ?> <?php echo e(__('lang_v1.' . ($purchase->pay_term_type ?? 'days')), false); ?>

                        <?php endif; ?>
                        <?php if(!empty($pr_layout_name)): ?>
                          <br><strong><?php echo app('translator')->get('invoice.invoice_layouts'); ?>:</strong> <?php echo e($pr_layout_name, false); ?>

                        <?php endif; ?>
                    </div>
                    <div class="col-sm-4 col-12">
                        <h4><?php echo app('translator')->get('purchase.purchase_details'); ?>:</h4>
                        <strong><?php echo app('translator')->get('purchase.ref_no'); ?>:</strong> <?php echo e($purchase->ref_no, false); ?> <br>
                        <strong><?php echo app('translator')->get('messages.date'); ?>:</strong> <?php echo e(\Carbon::createFromTimestamp(strtotime($purchase->transaction_date))->format(session('business.date_format')), false); ?>

                        <?php if(!empty($custom_labels['purchase']['custom_field_1'])): ?>
                          <br><strong><?php echo e($custom_labels['purchase']['custom_field_1'], false); ?>:</strong> <?php echo e($purchase->custom_field_1, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($custom_labels['purchase']['custom_field_2'])): ?>
                          <br><strong><?php echo e($custom_labels['purchase']['custom_field_2'], false); ?>:</strong> <?php echo e($purchase->custom_field_2, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($custom_labels['purchase']['custom_field_3'])): ?>
                          <br><strong><?php echo e($custom_labels['purchase']['custom_field_3'], false); ?>:</strong> <?php echo e($purchase->custom_field_3, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($custom_labels['purchase']['custom_field_4'])): ?>
                          <br><strong><?php echo e($custom_labels['purchase']['custom_field_4'], false); ?>:</strong> <?php echo e($purchase->custom_field_4, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($custom_labels['purchase']['custom_field_5'])): ?>
                          <br><strong><?php echo e($custom_labels['purchase']['custom_field_5'], false); ?>:</strong> <?php echo e($purchase->custom_field_5, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($custom_labels['purchase']['custom_field_6'])): ?>
                          <br><strong><?php echo e($custom_labels['purchase']['custom_field_6'], false); ?>:</strong> <?php echo e($purchase->custom_field_6, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($custom_labels['purchase']['custom_field_7'])): ?>
                          <br><strong><?php echo e($custom_labels['purchase']['custom_field_7'], false); ?>:</strong> <?php echo e($purchase->custom_field_7, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($custom_labels['purchase']['custom_field_8'])): ?>
                          <br><strong><?php echo e($custom_labels['purchase']['custom_field_8'], false); ?>:</strong> <?php echo e($purchase->custom_field_8, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($custom_labels['purchase']['custom_field_9'])): ?>
                          <br><strong><?php echo e($custom_labels['purchase']['custom_field_9'], false); ?>:</strong> <?php echo e($purchase->custom_field_9, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($custom_labels['purchase']['custom_field_10'])): ?>
                          <br><strong><?php echo e($custom_labels['purchase']['custom_field_10'], false); ?>:</strong> <?php echo e($purchase->custom_field_10, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($custom_labels['purchase']['custom_field_11'])): ?>
                          <br><strong><?php echo e($custom_labels['purchase']['custom_field_11'], false); ?>:</strong> <?php echo e($purchase->custom_field_11, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($custom_labels['purchase']['custom_field_12'])): ?>
                          <br><strong><?php echo e($custom_labels['purchase']['custom_field_12'], false); ?>:</strong> <?php echo e($purchase->custom_field_12, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($custom_labels['purchase']['custom_field_13'])): ?>
                          <br><strong><?php echo e($custom_labels['purchase']['custom_field_13'], false); ?>:</strong> <?php echo e($purchase->custom_field_13, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($custom_labels['purchase']['custom_field_14'])): ?>
                          <br><strong><?php echo e($custom_labels['purchase']['custom_field_14'], false); ?>:</strong> <?php echo e($purchase->custom_field_14, false); ?>

                        <?php endif; ?>
                    </div>
                    <div class="col-sm-4 col-12">
                      <?php if(!empty($purchase->business)): ?>
                        <h4><?php echo app('translator')->get('business.business'); ?>:</h4>
                        <strong><?php echo e($purchase->business->name, false); ?></strong>
                        <?php if(!empty($purchase->location)): ?>
                          <br><?php echo e($purchase->location->name, false); ?>

                          <?php if(!empty($purchase->location->landmark)): ?>
                            <br><?php echo e($purchase->location->landmark, false); ?>

                          <?php endif; ?>
                          <?php if(!empty($purchase->location->city) || !empty($purchase->location->state) || !empty($purchase->location->country)): ?>
                            <br><?php echo e(implode(', ', array_filter([$purchase->location->city, $purchase->location->state, $purchase->location->country])), false); ?>

                          <?php endif; ?>
                          <?php if(!empty($purchase->location->mobile)): ?>
                            <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($purchase->location->mobile, false); ?>

                          <?php endif; ?>
                          <?php if(!empty($purchase->location->email)): ?>
                            <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($purchase->location->email, false); ?>

                          <?php endif; ?>
                        <?php endif; ?>
                        <?php if(!empty($purchase->business->tax_number_1)): ?>
                          <br><?php echo e($purchase->business->tax_label_1, false); ?>: <?php echo e($purchase->business->tax_number_1, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($purchase->business->tax_number_2)): ?>
                          <br><?php echo e($purchase->business->tax_label_2, false); ?>: <?php echo e($purchase->business->tax_number_2, false); ?>

                        <?php endif; ?>
                      <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="col-sm-4 col-12">
                        <h4><?php echo app('translator')->get('lang_v1.purchase_return_details'); ?>:</h4>
                        <strong><?php echo app('translator')->get('lang_v1.return_date'); ?>:</strong> <?php echo e(\Carbon::createFromTimestamp(strtotime($purchase->transaction_date))->format(session('business.date_format')), false); ?><br>
                        <strong><?php echo app('translator')->get('purchase.supplier'); ?>:</strong> <?php echo $purchase->contact->contact_address; ?>

                        <?php if(!empty($purchase->contact->tax_number)): ?>
                          <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($purchase->contact->tax_number, false); ?>

                        <?php endif; ?>
                        <br><strong><?php echo app('translator')->get('purchase.business_location'); ?>:</strong> <?php echo e($purchase->location->name, false); ?>

                        <?php if(!empty($purchase->pay_term_number)): ?>
                          <br><strong><?php echo app('translator')->get('contact.pay_term'); ?>:</strong> <?php echo e($purchase->pay_term_number, false); ?> <?php echo e(__('lang_v1.' . ($purchase->pay_term_type ?? 'days')), false); ?>

                        <?php endif; ?>
                        <?php if(!empty($pr_layout_name)): ?>
                          <br><strong><?php echo app('translator')->get('invoice.invoice_layouts'); ?>:</strong> <?php echo e($pr_layout_name, false); ?>

                        <?php endif; ?>
                    </div>
                    <div class="col-sm-4 col-12">
                      <?php if(!empty($purchase->business)): ?>
                        <h4><?php echo app('translator')->get('business.business'); ?>:</h4>
                        <strong><?php echo e($purchase->business->name, false); ?></strong>
                        <?php if(!empty($purchase->location)): ?>
                          <br><?php echo e($purchase->location->name, false); ?>

                          <?php if(!empty($purchase->location->landmark)): ?>
                            <br><?php echo e($purchase->location->landmark, false); ?>

                          <?php endif; ?>
                          <?php if(!empty($purchase->location->city) || !empty($purchase->location->state) || !empty($purchase->location->country)): ?>
                            <br><?php echo e(implode(', ', array_filter([$purchase->location->city, $purchase->location->state, $purchase->location->country])), false); ?>

                          <?php endif; ?>
                          <?php if(!empty($purchase->location->mobile)): ?>
                            <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($purchase->location->mobile, false); ?>

                          <?php endif; ?>
                          <?php if(!empty($purchase->location->email)): ?>
                            <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($purchase->location->email, false); ?>

                          <?php endif; ?>
                        <?php endif; ?>
                        <?php if(!empty($purchase->business->tax_number_1)): ?>
                          <br><?php echo e($purchase->business->tax_label_1, false); ?>: <?php echo e($purchase->business->tax_number_1, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($purchase->business->tax_number_2)): ?>
                          <br><?php echo e($purchase->business->tax_label_2, false); ?>: <?php echo e($purchase->business->tax_number_2, false); ?>

                        <?php endif; ?>
                      <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if(empty($purchase->return_parent)): ?>
                    <?php if($purchase->document_path): ?>
                        <div class="col-md-12">
                            <a href="<?php echo e($purchase->document_path, false); ?>" download="<?php echo e($purchase->document_name, false); ?>"
                                class="btn btn-sm btn-success float-end no-print">
                                <i class="fa fa-download"></i>
                                &nbsp;<?php echo e(__('purchase.download_document'), false); ?>

                            </a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <br>
            <?php
              // Phase 71: prefer controller-supplied per-branch common_settings; session is the fallback.
              $prcs = isset($common_settings) && ! empty($common_settings)
                  ? $common_settings
                  : (session()->get('business.common_settings') ?? []);
              $pr_show_discount  = !empty($prcs['enable_inline_discount_purchase']);
              $pr_show_discount2 = !empty($prcs['enable_inline_discount2_purchase']);
              $pr_show_tax       = !empty($prcs['enable_inline_tax_purchase']);
            ?>
            <div class="row">
                <div class="col-sm-12">
                    <br>
                    <table class="table bg-gray">
                        <thead>
                            <tr class="bg-green">
                                <th>#</th>
                                <th><?php echo app('translator')->get('product.product_name'); ?></th>
                                <th><?php echo app('translator')->get('sale.unit_price'); ?></th>
                                <?php if($pr_show_discount): ?>
                                <th><?php echo app('translator')->get('lang_v1.discount'); ?></th>
                                <?php endif; ?>
                                <?php if($pr_show_discount2): ?>
                                <th><?php echo app('translator')->get('lang_v1.discount'); ?> 2</th>
                                <?php endif; ?>
                                <?php if($pr_show_tax): ?>
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
                            <?php $__currentLoopData = $purchase->purchase_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($purchase_line->quantity_returned == 0): ?>
                                    <?php continue; ?>
                                <?php endif; ?>

                                <?php
                                    $unit_name = $purchase_line->product->unit->short_name;
                                    if (!empty($purchase_line->sub_unit)) {
                                        $unit_name = $purchase_line->sub_unit->short_name;
                                    }
                                ?>
                                <tr>
                                    <td><?php echo e($loop->iteration, false); ?></td>
                                    <td>
                                        <?php echo e($purchase_line->product->name, false); ?>

                                        <?php if($purchase_line->product->type == 'variable'): ?>
                                            - <?php echo e($purchase_line->variations->product_variation->name, false); ?>

                                            - <?php echo e($purchase_line->variations->name, false); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><span class="display_currency"
                                            data-currency_symbol="true"><?php echo e($purchase_line->purchase_price_inc_tax, false); ?></span>
                                    </td>
                                    <?php if($pr_show_discount): ?>
                                    <td>
                                      <?php if($purchase_line->discount_type == 'fixed'): ?>
                                        <span class="display_currency" data-currency_symbol="true"><?php echo e($purchase_line->discount_percent, false); ?></span>
                                      <?php elseif(!empty($purchase_line->discount_percent)): ?>
                                        <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $purchase_line->discount_percent, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?> %
                                      <?php endif; ?>
                                    </td>
                                    <?php endif; ?>
                                    <?php if($pr_show_discount2): ?>
                                    <td>
                                      <?php if($purchase_line->discount2_type == 'fixed'): ?>
                                        <span class="display_currency" data-currency_symbol="true"><?php echo e($purchase_line->discount2_percent, false); ?></span>
                                      <?php elseif(!empty($purchase_line->discount2_percent)): ?>
                                        <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $purchase_line->discount2_percent, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?> %
                                      <?php endif; ?>
                                    </td>
                                    <?php endif; ?>
                                    <?php if($pr_show_tax): ?>
                                    <td>
                                      <span class="display_currency" data-currency_symbol="true"><?php echo e($purchase_line->item_tax, false); ?></span>
                                    </td>
                                    <?php endif; ?>
                                    <td><?php echo e(number_format($purchase_line->quantity_returned, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($unit_name, false); ?>

                                    </td>
                                    <td>
                                        <?php
                                            $line_total = $purchase_line->purchase_price_inc_tax * $purchase_line->quantity_returned;
                                            $total_before_tax += $line_total;
                                        ?>
                                        <span class="display_currency"
                                            data-currency_symbol="true"><?php echo e($line_total, false); ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-6 col-6 col-xs-offset-6">
                    <table class="table">
                        <tr>
                            <th><?php echo app('translator')->get('purchase.net_total_amount'); ?>: </th>
                            <td></td>
                            <td><span class="display_currency float-end"
                                    data-currency_symbol="true"><?php echo e($total_before_tax, false); ?></span></td>
                        </tr>

                        <tr>
                            <th><?php echo app('translator')->get('lang_v1.total_return_tax'); ?>:</th>
                            <td><b>(+)</b></td>
                            <td class="text-right">
                                <?php if(!empty($purchase_taxes)): ?>
                                    <?php $__currentLoopData = $purchase_taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <strong><small><?php echo e($k, false); ?></small></strong> - <span
                                            class="display_currency float-end"
                                            data-currency_symbol="true"><?php echo e($v, false); ?></span><br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    0.00
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('lang_v1.return_total'); ?>:</th>
                            <td></td>
                            <td><span class="display_currency float-end"
                                    data-currency_symbol="true"><?php echo e($purchase->return_parent->final_total ?? $purchase->final_total, false); ?></span>
                            </td>
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
            <button type="button" class="btn btn-primary no-print" aria-label="Print"
                onclick="$(this).closest('div.modal-content').printThis();"><i class="fa fa-print"></i>
                <?php echo app('translator')->get('messages.print'); ?>
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var element = $('div.modal-xl');
        __currency_convert_recursively(element);
    });
</script>
