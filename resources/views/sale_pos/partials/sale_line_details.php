<?php
    $xr = $xr ?? 1;
    // Determine which business settings tab to use for column visibility
    // POS tab settings: POS sale (is_direct_sale=0, type=sell) and Draft
    // Sales tab settings: Sell (is_direct_sale=1), Sale Order, Quotation, Sell Return
    $is_pos_or_draft = (!empty($sell) && (
        $sell->type == 'draft' || 
        ($sell->type == 'sell' && empty($sell->is_direct_sale))
    ));

    $cs = session()->get('business.common_settings') ?? [];

    if ($is_pos_or_draft) {
        // Use POS tab settings
        $ps = $pos_settings ?? [];
        $show_discount     = !empty($ps['enable_discount_column']);
        $show_discount2    = false; // POS tab has no discount 2 setting
        $show_tax          = !empty($ps['enable_inline_tax_pos']);
        $show_price_inc_tax = !empty($ps['enable_inclusive_tax_column']);
        $show_service_staff = !empty($ps['inline_service_staff']);
    } else {
        // Use Sales tab settings
        $ps = $pos_settings ?? [];
        $show_discount     = !empty($cs['enable_inline_discount_sales']);
        $show_discount2    = !empty($cs['enable_inline_discount2_sales']);
        $show_tax          = !empty($cs['enable_inline_tax_sales']);
        $show_price_inc_tax = !empty($ps['enable_inclusive_tax_column']);
        $show_service_staff = !empty($ps['inline_service_staff']);
    }
?>
<?php if($format != 'format_4'): ?>
<table class="table <?php if(!empty($for_ledger)): ?> table-slim mb-0 bg-light-skin <?php else: ?> bg-gray <?php endif; ?>" <?php if(!empty($for_pdf)): ?> style="width: 100%;" <?php endif; ?>>
    <tr <?php if(empty($for_ledger)): ?> class="bg-green" <?php endif; ?>>
        <th width="2%">#</th>
        <th width="3%"><?php echo e(__('sale.sku'), false); ?></th>
        <th width="25%"><?php echo e(__('sale.product'), false); ?></th>
        <?php if( session()->get('business.enable_lot_number') == 1 && empty($for_ledger)): ?>
            <th width="5%"> <?php if(!empty($common_settings['lot_number_label'])): ?> <?php echo e($common_settings['lot_number_label'], false); ?> <?php else: ?>  <?php echo e(__('lang_v1.lot_n_expiry'), false); ?> <?php endif; ?> </th>
        <?php endif; ?>
        <?php if($sell->type == 'sales_order'): ?>
            <th width="6%" class="align-right"><?php echo app('translator')->get('lang_v1.quantity_remaining'); ?></th>
        <?php endif; ?>
        <th width="6%" class="align-right"><?php echo e(__('sale.qty'), false); ?></th>
        <?php if(!empty($cs['enable_delivery_notes'])): ?>
            <th width="6%" class="align-right">Held Qty</th>
        <?php endif; ?>
        <?php if($show_service_staff): ?>
            <th width="8%">
                <?php echo app('translator')->get('restaurant.service_staff'); ?>
            </th>
        <?php endif; ?>
        <th width="4%" class="align-right"><?php echo e(__('sale.unit_price'), false); ?><?php echo e($sel_suffix ?? '', false); ?></th>
        <?php if($show_discount): ?>
        <th width="6%" class="align-right"><?php echo e(__('sale.discount'), false); ?><?php echo e($sel_suffix ?? '', false); ?></th>
        <?php endif; ?>
        <?php if($show_discount2): ?>
        <th width="6%" class="align-right"><?php echo e(__('sale.discount'), false); ?><?php echo e($sel_suffix ?? '', false); ?> 2</th>
        <?php endif; ?>
        <?php if($show_tax): ?>
        <th width="5%" class="align-right"><?php echo e(__('sale.tax'), false); ?><?php echo e($sel_suffix ?? '', false); ?></th>
        <?php endif; ?>
        <?php if($show_price_inc_tax): ?>
        <th width="5%" class="align-right"><?php echo e(__('sale.price_inc_tax'), false); ?><?php echo e($sel_suffix ?? '', false); ?></th>
        <?php endif; ?>
        <th width="5%" class="align-right"><?php echo e(__('sale.subtotal'), false); ?><?php echo e($sel_suffix ?? '', false); ?></th>
        
    </tr>
    <?php
        $total_qty = 0;
    ?>
    <?php $__currentLoopData = $sell->sell_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($loop->iteration, false); ?></td>
            <td>
                <?php echo e($sell_line->variations->sub_sku ?? '', false); ?>

            </td>
            <td>
                <?php if(!empty($sell_line->user_product_name)): ?>
                    <?php echo e($sell_line->user_product_name, false); ?>

                <?php else: ?>
                    <?php echo e($sell_line->product->name, false); ?>

                <?php endif; ?>
                <?php if( $sell_line->product->type == 'variable'): ?>
                - <?php echo e($sell_line->variations->product_variation->name ?? '', false); ?>

                - <?php echo e($sell_line->variations->name ?? '', false); ?>,
                <?php endif; ?>
                
                <?php
                $brand = $sell_line->product->brand;
                ?>
                <?php if(!empty($brand->name)): ?>
                , <?php echo e($brand->name, false); ?>

                <?php endif; ?>

                <?php if(!empty($sell_line->sell_line_note)): ?>
                <br> <?php echo e($sell_line->sell_line_note, false); ?>

                <?php endif; ?>
                <?php if($is_warranty_enabled && !empty($sell_line->warranties->first()) ): ?>
                    <br><small><?php echo e($sell_line->warranties->first()->display_name ?? '', false); ?> - <?php echo e(\Carbon::createFromTimestamp(strtotime($sell_line->warranties->first()->getEndDate($sell->transaction_date)))->format(session('business.date_format')), false); ?></small>
                    <?php if(!empty($sell_line->warranties->first()->description)): ?>
                    <br><small><?php echo e($sell_line->warranties->first()->description ?? '', false); ?></small>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(in_array('kitchen', $enabled_modules) && empty($for_ledger)): ?>
                    <br><span class="label <?php if($sell_line->res_line_order_status == 'cooked' ): ?> bg-red <?php elseif($sell_line->res_line_order_status == 'served'): ?> bg-green <?php else: ?> bg-light-blue <?php endif; ?>"><?php echo app('translator')->get('restaurant.order_statuses.' . $sell_line->res_line_order_status); ?> </span>
                <?php endif; ?>
                <?php if(!empty(session()->get('business.common_settings.enable_serial_number'))): ?>
                  <?php if(!empty(session()->get('business.common_settings.serial_number_label')) && $sell_line->product->enable_sr_no): ?>
                  <br>
                  <?php echo e(session()->get('business.common_settings.serial_number_label'), false); ?> : <?php echo e($sell_line->serial_number, false); ?>

                  <?php endif; ?>
                  
                  <?php if(!empty(session()->get('business.common_settings.enable_imei_number')) && $sell_line->product->enable_imei_no): ?>
                  <?php $__currentLoopData = $sell_line->imei_numbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $imei): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($key == 1 && !empty(session()->get('business.common_settings.imei1_number_label'))): ?>
                    <br><?php echo e(session()->get('business.common_settings.imei1_number_label'), false); ?> : <?php echo e($imei, false); ?>

                    <?php endif; ?>
                    <?php if($key == 2 && !empty(session()->get('business.common_settings.imei2_number_label'))): ?>
                    <br><?php echo e(session()->get('business.common_settings.imei2_number_label'), false); ?> : <?php echo e($imei, false); ?>

                    <?php endif; ?>
                    <?php if($key == 3 && !empty(session()->get('business.common_settings.imei3_number_label'))): ?>
                    <br><?php echo e(session()->get('business.common_settings.imei3_number_label'), false); ?> : <?php echo e($imei, false); ?>

                    <?php endif; ?>
                    <?php if($key == 4 && !empty(session()->get('business.common_settings.imei4_number_label'))): ?>
                    <br><?php echo e(session()->get('business.common_settings.imei4_number_label'), false); ?> : <?php echo e($imei, false); ?>

                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                 <?php endif; ?>
                 <?php if(!empty($sell_line->lot_details)): ?> <br> <?php echo e(session()->get('business.common_settings')['lot_number_label'], false); ?> - <?php echo e($sell_line->lot_details->lot_number ?? '', false); ?> <?php endif; ?>
            </td>
            <?php if( session()->get('business.enable_lot_number') == 1 && empty($for_ledger)): ?>
                <td><?php echo e($sell_line->lot_details->lot_number ?? '--', false); ?>

                    <?php if( session()->get('business.enable_product_expiry') == 1 && !empty($sell_line->lot_details->exp_date)): ?>
                    (<?php echo e(\Carbon::createFromTimestamp(strtotime($sell_line->lot_details->exp_date))->format(session('business.date_format')), false); ?>)
                    <?php endif; ?>
                </td>
            <?php endif; ?>
            <?php if($sell->type == 'sales_order'): ?>
                <td class="ws-nowrap align-right"><span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($sell_line->quantity - $sell_line->so_quantity_invoiced, false); ?></span> <?php if(!empty($sell_line->sub_unit)): ?> <?php echo e($sell_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($sell_line->product->unit->short_name, false); ?> <?php endif; ?></td>
            <?php endif; ?>
            <?php
                if(!empty($sell_line->quantity) && !empty($sell_line->foc_quantity)){
                    $sell_line->quantity = $sell_line->quantity + $sell_line->foc_quantity;
                }
            ?>
            <td class="ws-nowrap align-right">
                <?php if(!empty($for_ledger)): ?>
                    <?php if($sell->type == 'Sales'): ?>
                    <?php echo e(number_format($sell_line->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                    <?php else: ?>
                    <?php echo e(number_format($sell_line->quantity_returned, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                    <?php endif; ?>
                <?php else: ?>
                    <span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($sell_line->quantity, false); ?></span>
                <?php endif; ?>
                
                <?php if(!empty($sell_line->sub_unit)): ?> <?php echo e($sell_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($sell_line->product->unit->short_name, false); ?> <?php endif; ?>
                
                <?php if(!empty($sell_line->product->second_unit) && $sell_line->secondary_unit_quantity != 0): ?>
                    <br>
                    <?php if(!empty($for_ledger)): ?>
                        <?php echo e(number_format($sell_line->secondary_unit_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                    <?php else: ?>
                        <span class="display_currency" data-is_quantity="true" data-currency_symbol="false"><?php echo e($sell_line->secondary_unit_quantity, false); ?></span> 
                    <?php endif; ?>
                    <?php echo e($sell_line->product->second_unit->short_name, false); ?>

                <?php endif; ?>
                
                <?php if($sell_line->foc_quantity != 0): ?>
                    <br>
                    FOC:
                    <span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($sell_line->foc_quantity, false); ?></span>
                    <?php if(!empty($sell_line->foc_sub_unit)): ?> <?php echo e($sell_line->foc_sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($sell_line->product->unit->short_name, false); ?> <?php endif; ?>
                <?php endif; ?>
            </td>
            <?php if(!empty($cs['enable_delivery_notes'])): ?>
                <td class="ws-nowrap align-right">
                    <?php
                        $delivered_qty = \App\DeliveryNoteLine::where('transaction_sell_line_id', $sell_line->id)->sum('quantity');
                        $balance = $sell_line->quantity - $delivered_qty;
                    ?>
                    <span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($balance, false); ?></span>
                    <?php if(!empty($sell_line->sub_unit)): ?> <?php echo e($sell_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($sell_line->product->unit->short_name, false); ?> <?php endif; ?>
                </td>
            <?php endif; ?>
            <?php if($show_service_staff): ?>
                <td>
                <?php echo e($sell_line->service_staff->user_full_name ?? '', false); ?>

                </td>
            <?php endif; ?>
            <td class="ws-nowrap align-right">
                <?php if(!empty($for_ledger)): ?>
                    <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_line->unit_price_before_discount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                <?php else: ?>
                    <span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($sell_line->unit_price_before_discount / $xr, false); ?></span>
                <?php endif; ?>
            </td>
            <?php if($show_discount): ?>
            <td class="ws-nowrap align-right">
                <?php if(!empty($for_ledger)): ?>
                    <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_line->get_discount_amount(), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                <?php else: ?>
                    <span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($sell_line->get_discount_amount($xr), false); ?></span>
                <?php endif; ?>
                <?php if($sell_line->line_discount_type == 'percentage'): ?> (<?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $sell_line->line_discount_amount, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?>%) <?php endif; ?>
            </td>
            <?php endif; ?>
            <?php if($show_discount2): ?>
            <td class="ws-nowrap align-right">
                <?php if(!empty($for_ledger)): ?>
                    <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_line->get_discount2_amount(), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                <?php else: ?>
                    <span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($sell_line->get_discount2_amount($xr), false); ?></span>
                <?php endif; ?>
                <?php if($sell_line->line_discount2_type == 'percentage'): ?> (<?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $sell_line->line_discount2_amount, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?>%) <?php endif; ?>
            </td>
            <?php endif; ?>
            
            <?php if($show_tax): ?>
            <td class="ws-nowrap align-right">
                <?php if(!empty($for_ledger)): ?>
                    <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_line->item_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                <?php else: ?>
                    <span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($sell_line->item_tax / $xr, false); ?></span> 
                <?php endif; ?>
                <?php if(!empty($taxes[$sell_line->tax_id])): ?>
                ( <?php echo e($taxes[$sell_line->tax_id], false); ?> )
                <?php endif; ?>
            </td>
            <?php endif; ?>
            <?php if($show_price_inc_tax): ?>
            <td class="ws-nowrap align-right">
                <?php if(!empty($for_ledger)): ?>
                    <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_line->unit_price_inc_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                <?php else: ?>
                    <span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($sell_line->unit_price_inc_tax / $xr, false); ?></span>
                <?php endif; ?>
            </td>
            <?php endif; ?>
            <td class="ws-nowrap align-right">
                <?php if(!empty($for_ledger)): ?>
                    <?php if($sell->type == 'Sales'): ?>
                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_line->quantity * $sell_line->unit_price_inc_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                    <?php else: ?>
                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_line->quantity_returned * $sell_line->unit_price_inc_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($sell_line->quantity * $sell_line->unit_price_inc_tax / $xr, false); ?></span>
                <?php endif; ?>
            </td>
        </tr>
        <?php if(!empty($sell_line->modifiers)): ?>
        <?php $__currentLoopData = $sell_line->modifiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <?php echo e($modifier->product->name, false); ?> - <?php echo e($modifier->variations->name ?? '', false); ?>,
                    <?php echo e($modifier->variations->sub_sku ?? '', false); ?>

                </td>
                <?php if( session()->get('business.enable_lot_number') == 1): ?>
                    <td>&nbsp;</td>
                <?php endif; ?>
                <td class="ws-nowrap align-right"><?php echo e($modifier->quantity, false); ?></td>
                <?php if($show_service_staff): ?>
                    <td>
                        &nbsp;
                    </td>
                <?php endif; ?>
                <td class="ws-nowrap align-right">
                    <?php if(!empty($for_ledger)): ?>
                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $modifier->unit_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                    <?php else: ?>
                        <span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($modifier->unit_price / $xr, false); ?></span>
                    <?php endif; ?>
                </td>
                <?php if($show_discount): ?>
                <td>&nbsp;</td>
                <?php endif; ?>
                <?php if($show_discount2): ?>
                <td>&nbsp;</td>
                <?php endif; ?>
                <?php if($show_tax): ?>
                <td class="ws-nowrap align-right">
                    <?php if(!empty($for_ledger)): ?>
                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $modifier->item_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                    <?php else: ?>
                        <span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($modifier->item_tax / $xr, false); ?></span> 
                    <?php endif; ?>
                    <?php if(!empty($taxes[$modifier->tax_id])): ?>
                    ( <?php echo e($taxes[$modifier->tax_id], false); ?> )
                    <?php endif; ?>
                </td>
                <?php endif; ?>
                <?php if($show_price_inc_tax): ?>
                <td class="ws-nowrap align-right">
                    <?php if(!empty($for_ledger)): ?>
                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $modifier->unit_price_inc_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                    <?php else: ?>
                        <span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($modifier->unit_price_inc_tax / $xr, false); ?></span>
                    <?php endif; ?>
                </td>
                <?php endif; ?>
                <td class="ws-nowrap align-right">
                    <?php if(!empty($for_ledger)): ?>
                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $modifier->quantity * $modifier->unit_price_inc_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                    <?php else: ?>
                        <span class="display_currency sel-currency-val" data-currency_symbol="false"><?php echo e($modifier->quantity * $modifier->unit_price_inc_tax / $xr, false); ?></span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php
            if($sell->type == 'sell'){
                $total_qty += $sell_line->quantity;
                if(!empty($sell_line->foc_multiplier) && $sell_line->foc_multiplier != 1){
                    $total_qty += $sell_line->orig_foc_quantity / $sell_line->foc_multiplier;
                }else if(!empty($sell_line->multiplier)){
                    $total_qty += $sell_line->orig_foc_quantity / $sell_line->multiplier;
                }else{
                    $total_qty += $sell_line->orig_foc_quantity;
                }
            }else{
                $total_qty += $sell_line->quantity_returned;
            }
            $qty_unit = !empty($sell_line->sub_unit) ? $sell_line->sub_unit->short_name : $sell_line->product->unit->short_name;
        ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td></td>
        <td></td>
        <td class="ws-nowrap align-right">
          <b>Total Qty: </b> 
          <?php echo e(number_format($total_qty, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($qty_unit, false); ?>

        </td>
      </tr>
</table>

<?php else: ?>
    
    <div style="padding-top:5px">
        <strong>Product Details: </strong>
        <?php $__currentLoopData = $sell->sell_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$loop->first): ?>
            <?php echo e(', ', false); ?>

        <?php endif; ?>
        (
        <?php echo e($sell_line->product->name, false); ?>

        <?php if( $sell_line->product->type == 'variable'): ?>
            - <?php echo e($sell_line->variations->product_variation->name, false); ?>

            - <?php echo e($sell_line->variations->name, false); ?>

        <?php endif; ?>
        - <?php echo e($sell_line->variations->sub_sku ?? '', false); ?>

        <?php if($sell->type == 'Sales'): ?>
        - <?php echo e(number_format($sell_line->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php if(!empty($sell_line->sub_unit)): ?> <?php echo e($sell_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($sell_line->product->unit->short_name, false); ?> <?php endif; ?>
        <?php else: ?>
        - <?php echo e(number_format($sell_line->quantity_returned, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php if(!empty($sell_line->sub_unit)): ?> <?php echo e($sell_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($sell_line->product->unit->short_name, false); ?> <?php endif; ?>
        <?php endif; ?>
        - <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_line->unit_price_inc_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
        )
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
