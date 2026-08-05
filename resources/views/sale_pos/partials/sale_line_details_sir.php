<?php
    $common_settings = $common_settings ?? session()->get('business.common_settings', []);
    $hide_sale_invoices_report_cost_profit = ! empty($hide_sale_invoices_report_cost_profit);
    $show_product_tax_fields = $show_product_tax_fields ?? (!is_array($common_settings) || !array_key_exists('enable_product_tax', $common_settings) || !empty($common_settings['enable_product_tax']));
?>
<table class="table line_details table-bordered <?php if(!empty($for_ledger)): ?> table-slim mb-0 bg-light-skin <?php else: ?> bg-gray <?php endif; ?>" style="table-layout: fixed; width: 100%;">
        <tr <?php if(empty($for_ledger)): ?> class="bg-green" <?php endif; ?>>
            <th style="width:5%">#</th>
            <th style="width:20%;min-width: 20%;"><?php echo e(__('sale.product'), false); ?></th>
            <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
            <th style="width:6%"><?php echo e(!empty($scheme) ? __('sale.foc') : __('sale.foc_qty'), false); ?></th>
            <?php endif; ?>
            <th style="width:6%"><?php echo e(__('sale.qty'), false); ?></th>
            <th style="width:6%" class="text-right"><?php echo e(__('sale.unit_price'), false); ?></th>
            <th style="width:7%" class="text-right"><?php echo e(__('sale.discount'), false); ?></th>
            <?php if(!empty($common_settings['enable_inline_discount2_sales'])): ?>
            <th style="width:7%" class="text-right"><?php echo e(__('sale.discount'), false); ?> 2</th>
            <?php endif; ?>
            <?php if($show_product_tax_fields): ?>
            <th style="width:6%" class="text-right"><?php echo e(__('sale.tax'), false); ?></th>
            <?php endif; ?>
            <?php if($show_product_tax_fields): ?>
            <th style="width:6%" class="text-right"><?php echo e(__('sale.price_exc_tax'), false); ?></th>
            <?php endif; ?>
            <th style="width:6%" class="text-right"><?php echo e(__('sale.subtotal'), false); ?></th>
            <?php if(! $hide_sale_invoices_report_cost_profit): ?>
            <?php if($show_product_tax_fields): ?>
            <th style="width:11%" class="text-right"><?php echo e(__('purchase.unit_cost_exc_tax'), false); ?></th>
            <?php endif; ?>
            <th style="width:7%" class="text-right"><?php echo e(__('lang_v1.total_purchase'), false); ?></th>
            <th style="width:6%" class="text-right"><?php echo e(__('lang_v1.profit'), false); ?></th>
            <th style="width:6%" class="text-right"><?php echo e(__('lang_v1.total_profit'), false); ?></th>
            <?php endif; ?>
        </tr>
    <?php
        $discount = 0;
        $tax = 0;
        $total_subtotal = 0;
        $t_profit = 0;
        $total_profit = 0;
        $t_purchase = 0;
    ?>
    <?php $__currentLoopData = $sell->sell_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            if(! empty($sell_line->purchase_price)) { 
                if($sell_line->purchase_price == $sell_line->purchase_price_inc_tax){
                    $unit_price = $sell_line->purchase_price_inc_tax-$sell_line->purchase_item_tax;
                }else{
                    $unit_price = $sell_line->purchase_price;
                }
            }else { 
                $unit_price = $sell_line->variations->default_purchase_price; 
            }
            $unit_multiplier = !empty($sell_line->sub_unit) ? $sell_line->sub_unit->base_unit_multiplier : 1;
            $unit_price = $unit_price * $unit_multiplier;
            $is_combo_item = false;
            if(!empty($sell_line->children_type)){
                $is_combo_item = true;
            }
            $is_combo_product = false;
            if($sell_line->product->type == 'combo'){
                $is_combo_product = true;
                // $unit_price = 0;
            }
            $is_pack_product = false;
            if($sell_line->product->type == 'Package'){
                $is_pack_product = true;
                // $unit_price = 0;
            }
            if(!empty($sell_line->parent_sell_line_id)){
                continue;
            }
            $total_purchase = 0;
        ?>

        <tr>
            <td><?php if(empty($is_combo_item)): ?><?php echo e($loop->iteration, false); ?><?php else: ?> +> <?php endif; ?> </td>
            <td style="text-wrap:auto">
                <?php if(!empty($sell_line->user_product_name)): ?>
                    <?php echo e($sell_line->user_product_name, false); ?>

                <?php else: ?>
                    <?php echo e($sell_line->product->name, false); ?>

                <?php endif; ?>
                <?php if( $sell_line->product->type == 'variable'): ?>
                - <?php echo e($sell_line->variations->product_variation->name ?? '', false); ?>

                - <?php echo e($sell_line->variations->name ?? '', false); ?>,
                <?php endif; ?>
                <?php echo e($sell_line->variations->sub_sku ?? '', false); ?>

                <?php
                $brand = $sell_line->product->brand;
                ?>
                <?php if(!empty($brand->name)): ?>
                , <?php echo e($brand->name, false); ?>

                <?php endif; ?>

                <?php if(empty($is_combo_item)): ?>
                <?php if(!empty($sell_line->sell_line_note)): ?>
                <br> <?php echo e($sell_line->sell_line_note, false); ?>

                <?php endif; ?>
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
            </td>
            <?php if( session()->get('business.enable_lot_number') == 1 && empty($for_ledger)): ?>
                <td><?php echo e($sell_line->lot_details->lot_number ?? '--', false); ?>

                    <?php if( session()->get('business.enable_product_expiry') == 1 && !empty($sell_line->lot_details->exp_date)): ?>
                    (<?php echo e(\Carbon::createFromTimestamp(strtotime($sell_line->lot_details->exp_date))->format(session('business.date_format')), false); ?>)
                    <?php endif; ?>
                </td>
            <?php endif; ?>
            <?php if($sell->type == 'sales_order'): ?>
                <td><span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($sell_line->quantity - $sell_line->so_quantity_invoiced, false); ?></span> <?php if(!empty($sell_line->sub_unit)): ?> <?php echo e($sell_line->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($sell_line->product->unit->short_name, false); ?> <?php endif; ?></td>
            <?php endif; ?>
            <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
            <td>
                <?php if(!empty($for_ledger)): ?>
                    <?php echo e(number_format($sell_line->foc_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                <?php else: ?>
                    <span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($sell_line->foc_quantity, false); ?></span> 
                <?php endif; ?>
                    <?php if(!empty($sell_line->foc_unit_details)): ?> <?php echo e($sell_line->foc_unit_details->short_name, false); ?> <?php else: ?> <?php echo e($sell_line->product->unit->short_name, false); ?> <?php endif; ?>
            </td>
            <?php endif; ?>
            <td>
                <?php if(!empty($for_ledger)): ?>
                    <?php if($sell->type == 'Sales'): ?>
                        <?php echo e(number_format($sell_line->quantity - $sell_line->foc_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

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
            </td>
            <?php if(!empty($pos_settings['inline_service_staff'])): ?>
                <td>
                <?php echo e($sell_line->service_staff->user_full_name ?? '', false); ?>

                </td>
            <?php endif; ?>
            <td class="text-right">
                <?php if(!empty($for_ledger)): ?>
                    <?php if(empty($is_combo_item)): ?>
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
                    <?php endif; ?>
                <?php else: ?>
                    <span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->unit_price_before_discount, false); ?></span>
                <?php endif; ?>
            </td>
            <td class="text-right">
                <?php if(!empty($for_ledger)): ?>
                    <?php if(empty($is_combo_item)): ?>
                    <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $sell_line->get_discount_amount(), session("business.discount_precision", 2) , ".");
            echo $formated_number; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="display_currency" data-currency_symbol="true"><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $sell_line->get_discount_amount() * $sell_line->quantity, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?></span>
                <?php endif; ?>
                <?php if($sell_line->line_discount_type == 'percentage'): ?> <br>(<?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $sell_line->line_discount_amount, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?> %) <?php endif; ?>
            </td>
            <?php if(!empty($common_settings['enable_inline_discount2_sales'])): ?>
            <td class="text-right">
                <?php if(!empty($for_ledger)): ?>
                    <?php if(empty($is_combo_item)): ?>
                    <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $sell_line->get_discount2_amount(), session("business.discount_precision", 2) , ".");
            echo $formated_number; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="display_currency" data-currency_symbol="true"><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $sell_line->get_discount2_amount() * $sell_line->quantity, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?></span>
                <?php endif; ?>
                <?php if($sell_line->line_discount2_type == 'percentage'): ?> <br>(<?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $sell_line->line_discount2_amount, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?> %) <?php endif; ?>
            </td>
            <?php endif; ?>
            <?php if($show_product_tax_fields): ?>
            <td class="text-right">
                <?php if(!empty($for_ledger)): ?>
                    <?php if(empty($is_combo_item)): ?>
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
                    <?php endif; ?>
                <?php else: ?>
                    <span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->item_tax, false); ?></span> 
                <?php endif; ?>
                <?php if(!empty($taxes[$sell_line->tax_id])): ?>
                ( <?php echo e($taxes[$sell_line->tax_id], false); ?> )
                <?php endif; ?>
            </td>
            <?php endif; ?>
            <?php if($show_product_tax_fields): ?>
            <td class="text-right">
                <?php if(!empty($for_ledger)): ?>
                    <?php if(empty($is_combo_item)): ?>
                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_line->unit_price_inc_tax - $sell_line->item_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="display_currency" data-currency_symbol="true"><?php echo e(($sell_line->unit_price_inc_tax - $sell_line->item_tax), false); ?></span>
                <?php endif; ?>
            </td>
            <?php endif; ?>
            <td class="text-right">
                <?php if(!empty($for_ledger)): ?>
                    <?php if($sell->type == 'Sales'): ?>
                        <?php if(empty($is_combo_item)): ?>
                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) ($sell_line->quantity-$sell_line->foc_quantity) * ($sell_line->unit_price_inc_tax - $sell_line->item_tax), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_line->quantity_returned * ($sell_line->unit_price_inc_tax - $sell_line->item_tax), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                    <?php endif; ?>
                <?php else: ?>
                    
                    <span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->quantity * ($sell_line->unit_price_inc_tax - $sell_line->item_tax), false); ?></span>
                <?php endif; ?>
            </td>
            <?php
                if(!$is_combo_product){
                    if($sell->type == 'Sales'){
                        if(!empty($scheme)){
                            $total_purchase = ($sell_line->quantity- (float)$sell_line->foc_quantity) * $unit_price;
                        }else{
                            $total_purchase = $sell_line->quantity * $unit_price;
                        }
                    }else{
                        $total_purchase = $sell_line->quantity_returned * $unit_price;
                    }
                }
            ?>
            <?php if(! $hide_sale_invoices_report_cost_profit): ?>
            <?php if($show_product_tax_fields): ?>
            <td class="text-right">
                <?php if(!empty($for_ledger)): ?>
                    <?php if(!$is_combo_product): ?>
                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $unit_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="display_currency" data-currency_symbol="true"><?php echo e($unit_price, false); ?></span>
                <?php endif; ?>
            </td>
            <?php endif; ?>
            <td class="text-right">
                <?php if(!empty($for_ledger)): ?>
                    <?php if(!$is_combo_product): ?>
                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_purchase, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="display_currency" data-currency_symbol="true"><?php echo e($total_purchase, false); ?></span>
                <?php endif; ?>
            </td>
            <?php endif; ?>
            <?php
            $profit = 0;
            if($sell->type == 'Sales'){
                if(empty($is_combo_item) && !$is_combo_product){
                    $profit = (($sell_line->quantity-$sell_line->foc_quantity) * ($sell_line->unit_price_inc_tax - $sell_line->item_tax) - $total_purchase);
                    if($sell_line->quantity != 0){
                        $profit = $profit / $sell_line->quantity;
                    }
                    // if(($sell_line->quantity-$sell_line->foc_quantity) == 0){
                    //     $profit = -1*($sell_line->quantity * $unit_price);  
                    // }
                }elseif($is_combo_item){
                    $profit = $unit_price;
                }    
            }else{
                $profit = (($sell_line->quantity_returned) * ($sell_line->unit_price_inc_tax - $sell_line->item_tax) - $total_purchase);
                if($sell_line->quantity_returned != 0){
                    $profit = $profit / $sell_line->quantity_returned;
                }
            }
            ?>
            <?php if(! $hide_sale_invoices_report_cost_profit): ?>
            <td class="text-right">
                
            <?php if(!$is_combo_product && !$is_combo_item): ?>
                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $profit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            <?php endif; ?>
 
            </td>
            <?php endif; ?>
                <?php
                if($sell->type == 'Sales'){
                    if(empty($is_combo_item) && !$is_combo_product){
                        $profit = (($sell_line->quantity-$sell_line->foc_quantity) * ($sell_line->unit_price_inc_tax - $sell_line->item_tax) - $total_purchase);
                        if($sell_line->quantity != 0){
                            $profit = $profit / $sell_line->quantity;
                        }
                    }elseif($is_combo_item){
                        $profit = (float) $sell_line->quantity != 0 ? $total_purchase / $sell_line->quantity : 0;
                    }

                }else{
                    $profit = (($sell_line->quantity_returned) * ($sell_line->unit_price_inc_tax - $sell_line->item_tax) - $total_purchase);
                    if($sell_line->quantity_returned != 0){
                        $profit = $profit / $sell_line->quantity_returned;
                    }
                }
                ?>
            <?php if(! $hide_sale_invoices_report_cost_profit): ?>
            <td class="text-right">
                <?php if(!empty($for_ledger)): ?>
                    <?php if($sell->type == 'Sales'): ?>
                        <?php if(!$is_combo_product && !$is_combo_item): ?>
                            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_line->quantity * $profit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>                       
                        <?php endif; ?>
                    <?php else: ?>
                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_line->quantity_returned * $profit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->quantity * $profit, false); ?></span>
                <?php endif; ?>
            </td>
            <?php endif; ?>
        </tr>

        <?php
            if($sell->type == 'Sales'){
                $total_qty += $sell_line->quantity-$sell_line->foc_quantity;
                $discount += $sell_line->get_discount_amount();
                $discount += $sell_line->get_discount2_amount();
                $tax += $sell_line->item_tax * ($sell_line->quantity-$sell_line->foc_quantity);
                if(empty($is_combo_item)){
                    $total_subtotal += (($sell_line->quantity-$sell_line->foc_quantity) * ($sell_line->unit_price_inc_tax - $sell_line->item_tax));
                }

                // if(!$is_pack_product){
                    $t_purchase += $total_purchase;
                // }
                
                $line_total_subtotal = (($sell_line->quantity-$sell_line->foc_quantity) * ($sell_line->unit_price_inc_tax - $sell_line->item_tax));
                
                // if(!empty($is_combo_product) && empty($is_combo_item)){
                    // $total_profit += $total_subtotal;
                // }else if(!empty($is_combo_item)){
                    // $total_profit -= ($sell_line->quantity * $profit);
                // }else{
                    // $total_profit += ($sell_line->quantity * $profit);
                // }

                if(!empty($total_purchase)){
                    // $total_profit += $line_total_subtotal - $total_purchase;
                    $total_profit += ($sell_line->quantity * $profit);
                }else{
                    $total_profit += $line_total_subtotal - $total_purchase;
                }

            }else{
                $total_qty += $sell_line->quantity_returned;

                $discount += $sell_line->get_discount_amount();
                $discount += $sell_line->get_discount2_amount();
                
                $tax += $sell_line->item_tax * $sell_line->quantity_returned;                
                $total_subtotal += ($sell_line->quantity_returned * ($sell_line->unit_price_inc_tax - $sell_line->item_tax));
                $t_purchase += $total_purchase;
                $total_profit += ($sell_line->quantity_returned * $profit);
            }
            
            $qty_unit = !empty($sell_line->sub_unit) ? $sell_line->sub_unit->short_name : $sell_line->product->unit->short_name;
        ?>

            <?php $__currentLoopData = $sell->sell_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php

                if($item->parent_sell_line_id != $sell_line->id){
                    continue;
                }
                if(! empty($item->purchase_price)) { 
                    if($item->purchase_price == $item->purchase_price_inc_tax){
                        $unit_price = $item->purchase_price_inc_tax-$item->purchase_item_tax;
                    }else{
                        $unit_price = $item->purchase_price;
                    }
                }else { 
                    $unit_price = $item->variations->default_purchase_price; 
                }
                $unit_multiplier = !empty($item->sub_unit) ? $item->sub_unit->base_unit_multiplier : 1;
                $unit_price = $unit_price * $unit_multiplier;
                $is_combo_item = false;
                if(!empty($item->children_type)){
                    $is_combo_item = true;
                }
                $is_combo_product = false;
                if($item->product->type == 'combo'){
                    $is_combo_product = true;
                    // $unit_price = 0;
                }
                $total_purchase = 0;

            ?>
            
            <tr>
                <td>--></td>
                <td>
                    <?php echo e('&nbsp;&nbsp;&nbsp;&nbsp;', false); ?>

                    <?php if(!empty($item->user_product_name)): ?>
                        <?php echo e($item->user_product_name, false); ?>

                    <?php else: ?>
                        <?php echo e($item->product->name, false); ?>

                    <?php endif; ?>
                    <?php if( $item->product->type == 'variable'): ?>
                    - <?php echo e($item->variations->product_variation->name ?? '', false); ?>

                    - <?php echo e($item->variations->name ?? '', false); ?>,
                    <?php endif; ?>
                    <?php echo e($item->variations->sub_sku ?? '', false); ?>

                    <?php
                    $brand = $item->product->brand;
                    ?>
                    <?php if(!empty($brand->name)): ?>
                    , <?php echo e($brand->name, false); ?>

                    <?php endif; ?>

                    <?php if(empty($is_combo_item)): ?>
                    <?php if(!empty($item->item_note)): ?>
                    <br> <?php echo e($item->item_note, false); ?>

                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if($is_warranty_enabled && !empty($item->warranties->first()) ): ?>
                        <br><small><?php echo e($item->warranties->first()->display_name ?? '', false); ?> - <?php echo e(\Carbon::createFromTimestamp(strtotime($item->warranties->first()->getEndDate($sell->transaction_date)))->format(session('business.date_format')), false); ?></small>
                        <?php if(!empty($item->warranties->first()->description)): ?>
                        <br><small><?php echo e($item->warranties->first()->description ?? '', false); ?></small>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(in_array('kitchen', $enabled_modules) && empty($for_ledger)): ?>
                        <br><span class="label <?php if($item->res_line_order_status == 'cooked' ): ?> bg-red <?php elseif($item->res_line_order_status == 'served'): ?> bg-green <?php else: ?> bg-light-blue <?php endif; ?>"><?php echo app('translator')->get('restaurant.order_statuses.' . $item->res_line_order_status); ?> </span>
                    <?php endif; ?>
                </td>
                <?php if( session()->get('business.enable_lot_number') == 1 && empty($for_ledger)): ?>
                    <td><?php echo e($item->lot_details->lot_number ?? '--', false); ?>

                        <?php if( session()->get('business.enable_product_expiry') == 1 && !empty($item->lot_details->exp_date)): ?>
                        (<?php echo e(\Carbon::createFromTimestamp(strtotime($item->lot_details->exp_date))->format(session('business.date_format')), false); ?>)
                        <?php endif; ?>
                    </td>
                <?php endif; ?>
                <?php if($sell->type == 'sales_order'): ?>
                    <td><span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($item->quantity - $item->so_quantity_invoiced, false); ?></span> <?php if(!empty($item->sub_unit)): ?> <?php echo e($item->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($item->product->unit->short_name, false); ?> <?php endif; ?></td>
                <?php endif; ?>
                <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
                <td>
                    <?php if(!empty($for_ledger)): ?>
                        <?php echo e(number_format($item->foc_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                    <?php else: ?>
                        <span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($item->foc_quantity, false); ?></span> 
                    <?php endif; ?>
                        <?php if(!empty($item->foc_unit_details)): ?> <?php echo e($item->foc_unit_details->short_name, false); ?> <?php else: ?> <?php echo e($item->product->unit->short_name, false); ?> <?php endif; ?>
                </td>
                <?php endif; ?>
                <td>
                    <?php if(!empty($for_ledger)): ?>
                        <?php if($sell->type == 'Sales'): ?>
                            <?php echo e(number_format($item->quantity - $item->foc_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                        <?php else: ?>
                            <?php echo e(number_format($item->quantity_returned, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                        <?php endif; ?>
                    <?php else: ?>
                        <span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($item->quantity, false); ?></span> 
                    <?php endif; ?>
                    
                    <?php if(!empty($item->sub_unit)): ?> <?php echo e($item->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($item->product->unit->short_name, false); ?> <?php endif; ?>

                    <?php if(!empty($item->product->second_unit) && $item->secondary_unit_quantity != 0): ?>
                        <br>
                        <?php if(!empty($for_ledger)): ?>
                            <?php echo e(number_format($item->secondary_unit_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                        <?php else: ?>
                            <span class="display_currency" data-is_quantity="true" data-currency_symbol="false"><?php echo e($item->secondary_unit_quantity, false); ?></span> 
                        <?php endif; ?>
                        <?php echo e($item->product->second_unit->short_name, false); ?>

                    <?php endif; ?>
                </td>
                <?php if(!empty($pos_settings['inline_service_staff'])): ?>
                    <td>
                    <?php echo e($item->service_staff->user_full_name ?? '', false); ?>

                    </td>
                <?php endif; ?>
                <td class="text-right">
                    <?php if(!empty($for_ledger)): ?>
                        <?php if(empty($is_combo_item)): ?>
                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $item->unit_price_before_discount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($item->unit_price_before_discount, false); ?></span>
                    <?php endif; ?>
                </td>
                <td class="text-right">
                    <?php if(!empty($for_ledger)): ?>
                        <?php if(empty($is_combo_item)): ?>
                        <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $item->get_discount_amount(), session("business.discount_precision", 2) , ".");
            echo $formated_number; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="display_currency" data-currency_symbol="true"><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $item->get_discount_amount() * $item->quantity, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?></span>
                    <?php endif; ?>
                    <?php if($item->line_discount_type == 'percentage'): ?> <br>(<?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $item->line_discount_amount, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?> %) <?php endif; ?>
                </td>
                <?php if(!empty($common_settings['enable_inline_discount2_sales'])): ?>
                <td class="text-right">
                    <?php if(!empty($for_ledger)): ?>
                        <?php if(empty($is_combo_item)): ?>
                        <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $item->get_discount2_amount(), session("business.discount_precision", 2) , ".");
            echo $formated_number; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="display_currency" data-currency_symbol="true"><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $item->get_discount2_amount() * $item->quantity, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?></span>
                    <?php endif; ?>
                    <?php if($item->line_discount2_type == 'percentage'): ?> <br>(<?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $item->line_discount2_amount, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?> %) <?php endif; ?>
                </td>
                <?php endif; ?>
                <?php if($show_product_tax_fields): ?>
                <td class="text-right">
                    <?php if(!empty($for_ledger)): ?>
                        <?php if(empty($is_combo_item)): ?>
                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $item->item_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($item->item_tax, false); ?></span> 
                    <?php endif; ?>
                    <?php if(!empty($taxes[$item->tax_id])): ?>
                    ( <?php echo e($taxes[$item->tax_id], false); ?> )
                    <?php endif; ?>
                </td>
                <?php endif; ?>
                <?php if($show_product_tax_fields): ?>
                <td class="text-right">
                    <?php if(!empty($for_ledger)): ?>
                        <?php if(empty($is_combo_item)): ?>
                            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $item->unit_price_inc_tax - $item->item_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="display_currency" data-currency_symbol="true"><?php echo e(($item->unit_price_inc_tax - $item->item_tax), false); ?></span>
                    <?php endif; ?>
                </td>
                <?php endif; ?>
                <td class="text-right">
                    <?php if(!empty($for_ledger)): ?>
                        <?php if($sell->type == 'Sales'): ?>
                            <?php if(empty($is_combo_item)): ?>
                            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) ($item->quantity-$item->foc_quantity) * ($item->unit_price_inc_tax - $item->item_tax), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $item->quantity_returned * ($item->unit_price_inc_tax - $item->item_tax), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($item->quantity * ($item->unit_price_inc_tax - $item->item_tax), false); ?></span>
                    <?php endif; ?>
                </td>
                <?php
                    if(!$is_combo_product){
                        if($sell->type == 'Sales'){
                            if(!empty($scheme)){
                                $total_purchase = ($item->quantity - (float)$item->foc_quantity) * $unit_price;
                            }else{
                                $total_purchase = $item->quantity * $unit_price;
                            }
                        }else{
                            $total_purchase = $item->quantity_returned * $unit_price;
                        }
                    }
                ?>
                <?php if(! $hide_sale_invoices_report_cost_profit): ?>
                <?php if($show_product_tax_fields): ?>
                <td class="text-right">
                    <?php if(!empty($for_ledger)): ?>
                        <?php if(!$is_combo_product): ?>
                            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $unit_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($unit_price, false); ?></span>
                    <?php endif; ?>
                </td>
                <?php endif; ?>
                <td class="text-right">
                    <?php if(!empty($for_ledger)): ?>
                        <?php if(!$is_combo_product): ?>
                            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_purchase, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($total_purchase, false); ?></span>
                    <?php endif; ?>
                </td>
                <?php endif; ?>
                <?php
                $profit = 0;
                if($sell->type == 'Sales'){
                    if(empty($is_combo_item) && !$is_combo_product){
                        $profit = (($item->quantity-$item->foc_quantity) * ($item->unit_price_inc_tax - $item->item_tax) - $total_purchase);
                        if($item->quantity != 0){
                            $profit = $profit / $item->quantity;
                        }
                        // if(($item->quantity-$item->foc_quantity) == 0){
                        //     $profit = -1*($item->quantity * $unit_price);  
                        // }
                    }elseif($is_combo_item){
                        $profit = $unit_price;
                    }    
                }else{
                    $profit = (($item->quantity_returned) * ($item->unit_price_inc_tax - $item->item_tax) - $total_purchase);
                    if($item->quantity_returned != 0){
                        $profit = $profit / $item->quantity_returned;
                    }
                }
                ?>
                <?php if(! $hide_sale_invoices_report_cost_profit): ?>
                <td class="text-right">
                    
                <?php if(!$is_combo_product && !$is_combo_item): ?>
                    <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $profit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                <?php endif; ?>
    
                </td>
                <?php endif; ?>
                    <?php
                    if($sell->type == 'Sales'){
                        if(empty($is_combo_item) && !$is_combo_product){
                            $profit = (($item->quantity-$item->foc_quantity) * ($item->unit_price_inc_tax - $item->item_tax) - $total_purchase);
                            if($item->quantity != 0){
                                $profit = $profit / $item->quantity;
                            }
                        }elseif($is_combo_item){
                            $profit = (float) $item->quantity != 0 ? $total_purchase / $item->quantity : 0;
                        }

                    }else{
                        $profit = (($item->quantity_returned) * ($item->unit_price_inc_tax - $item->item_tax) - $total_purchase);
                        if($item->quantity_returned != 0){
                            $profit = $profit / $item->quantity_returned;
                        }
                    }
                    ?>
                <?php if(! $hide_sale_invoices_report_cost_profit): ?>
                <td class="text-right">
                    <?php if(!empty($for_ledger)): ?>
                        <?php if($sell->type == 'Sales'): ?>
                            <?php if(!$is_combo_product && !$is_combo_item): ?>
                                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $item->quantity * $profit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>                       
                            <?php endif; ?>
                        <?php else: ?>
                            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $item->quantity_returned * $profit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($item->quantity * $profit, false); ?></span>
                    <?php endif; ?>
                </td>
                <?php endif; ?>
            </tr>

            <?php
                if($sell->type == 'Sales'){
                    // $total_qty += $item->quantity-$sell_line->foc_quantity;
                    // $discount += $item->get_discount_amount();
                    // $discount += $item->get_discount2_amount();
                    // $tax += $item->item_tax * ($item->quantity-$item->foc_quantity);
                    // if(empty($is_combo_item)){
                    //     $total_subtotal += (($item->quantity-$item->foc_quantity) * ($item->unit_price_inc_tax - $item->item_tax));
                    // }
                    if($sell_line->product->type != 'Package'){
                        $t_purchase += $total_purchase;
                    }

                    // if(!empty($is_combo_product) && empty($is_combo_item)){
                    //     $total_profit += $total_subtotal - $t_purchase;    
                    // }else if(!empty($is_combo_item)){
                    //     // $total_profit = $total_subtotal - $t_purchase;
                    //     $total_profit += ($item->quantity * $profit);
                    // }else{
                    //     // $total_profit += ($item->quantity * $profit);
                    // }

                    if($sell_line->product->type != 'Package'){
                        $total_profit -= $total_purchase;
                    }

                }else{
                    $total_qty += $item->quantity_returned;

                    $discount += $item->get_discount_amount();
                    $discount += $item->get_discount2_amount();
                    
                    $tax += $item->item_tax * $item->quantity_returned;                
                    // $total_subtotal += ($item->quantity_returned * ($item->unit_price_inc_tax - $item->item_tax));
                    // $t_purchase += $total_purchase;
                    // $total_profit += ($item->quantity_returned * $profit);
                }
                
                // $qty_unit = !empty($item->sub_unit) ? $item->sub_unit->short_name : $item->product->unit->short_name;
            ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr class="total_row_footer">
        <td><b>Product Totals</b></td>
        <td></td>
        <td></td>
        <td>
          <b>Total Qty:</b><br>
          <?php echo e($total_qty, false); ?> <?php echo e($qty_unit, false); ?>

          <input type="hidden" class="total_quantity_row" value="<?php echo e($total_qty, false); ?>">
        </td>
        <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
        <td></td>
        <?php endif; ?>
        <td <?php if(!empty($common_settings['enable_inline_discount2_sales'])): ?> colspan="2" <?php endif; ?> class="text-right">
            <b>Total Discount:</b> <br>
            <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $discount, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?>
            <input type="hidden" class="total_discount_row" value="<?php echo e(($discount), false); ?>">
        </td>
        <?php if($show_product_tax_fields): ?>
        <td class="text-right">
            <b>Total Tax:</b> <br>
            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            <input type="hidden" class="total_tax_row" value="<?php echo e($tax, false); ?>">
        </td>
        <td></td>
        <?php endif; ?>
        <td class="text-right">
            <b>Total:</b> <br>
            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_subtotal, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            <input type="hidden" class="" value="<?php echo e($total_subtotal, false); ?>">
        </td>
        <?php if(! $hide_sale_invoices_report_cost_profit): ?>
            <?php if($show_product_tax_fields): ?>
            <td></td>
            <?php endif; ?>
            <td class="text-right">
            <b>Total Purchase:</b> <br>
                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $t_purchase, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                <input type="hidden" class="total_purchase_row" value="<?php echo e($t_purchase, false); ?>"></td>
            <td></td>
            <td class="text-right">
                <b>Total Profit:</b> <br>
                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_profit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                <input type="hidden" class="" value="<?php echo e($total_profit, false); ?>">
            </td>
        <?php endif; ?>
    </tr>
    <tr class="total_row_footer">
        <td><b>Invoice Totals</b></td>
        <td></td>
        <td></td>
        <td></td>
        <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
        <td></td>
        <?php endif; ?>
        <td class="text-right">
            <b>Invoice Discount:</b> <br>
            <?php
            $inv_discout = 0;
            if (! empty($sell->discount_type) && ! empty($sell->discount_amount)) {
                if ($sell->discount_type == 'fixed') {
                    $inv_discount = $sell->discount_amount;
                } elseif ($sell->discount_type == 'percentage') {
                    $inv_discount = ($sell->total_before_tax * $sell->discount_amount) / 100;
                }
            }
            ?>
            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $inv_discount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            <?php if(!empty($common_settings['enable_total_discount2_sale'])): ?>
            <br><b>Discount 2:</b> <br>
            <?php
            if (! empty($sell->discount2_type) && ! empty($sell->discount2_amount)) {
                if ($sell->discount2_type == 'fixed') {
                    $inv_discount2 = $sell->discount2_amount;
                } elseif ($sell->discount2_type == 'percentage') {
                    $inv_discount2 = ($sell->total_before_tax * $sell->discount2_amount) / 100;
                }
            }
            $inv_discount += $inv_discount2;
            ?>
            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $inv_discount2, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            <?php endif; ?>
            <input type="hidden" class="total_discount_row" value="<?php echo e(($inv_discount), false); ?>">
        </td>
        <?php if($show_product_tax_fields): ?>
        <td></td>
        <td></td>
        <?php endif; ?>
        <td class="text-right">
            <b>Total:</b> <br>
            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_subtotal-$inv_discount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            <input type="hidden" class="total_sub_total_row" value="<?php echo e(($total_subtotal-$inv_discount), false); ?>">
        </td>
        <?php if(! $hide_sale_invoices_report_cost_profit): ?>
            <?php if($show_product_tax_fields): ?>
            <td class="text-right">
                <?php if(!empty($sell->tos_name)): ?>
                    <b><?php echo e($sell->tos_name, false); ?>:</b> <br>
                    <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell->tos_amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                    <input type="hidden" class="total_tos_row" value="<?php echo e($sell->tos_amount, false); ?>">
                <?php endif; ?>
            </td>
            <?php endif; ?>
            <td></td>
            <td></td>
            <td class="text-right">
                <b>Net Profit:</b> <br>
                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_profit-$inv_discount+$sell->tos_amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                <input type="hidden" class="total_profit_row" value="<?php echo e($total_profit-$inv_discount+$sell->tos_amount, false); ?>">
            </td>
        <?php endif; ?>
    </tr>
</table>
