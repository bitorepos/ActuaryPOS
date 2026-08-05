
<table class="table line_details table-bordered <?php if(!empty($for_ledger)): ?> table-slim mb-0 bg-light-skin <?php else: ?> bg-gray <?php endif; ?>" <?php if(!empty($for_pdf)): ?> style="width: 100%;" <?php endif; ?>>
        <tr <?php if(empty($for_ledger)): ?> class="bg-green" <?php endif; ?>>
            <th style="width:8%">#</th>
            <th style="width:20%"><?php echo e(__('sale.product'), false); ?></th>
            <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
            <th style="width:6%"><?php echo e(!empty($scheme) ? __('sale.foc') : __('sale.foc_qty'), false); ?></th>
            <?php endif; ?>
            <th style="width:6%"><?php echo e(__('sale.qty'), false); ?></th>
            <th style="width:6%"><?php echo e(__('sale.unit_price'), false); ?></th>
            <th style="width:7%"><?php echo e(__('sale.discount'), false); ?></th>
            <?php if(!empty($common_settings['enable_inline_discount2_sales'])): ?>
            <th style="width:7%"><?php echo e(__('sale.discount'), false); ?> 2</th>
            <?php endif; ?>
            <th style="width:6%"><?php echo e(__('sale.tax'), false); ?></th>
            <th style="width:6%"><?php echo e(__('sale.price_exc_tax'), false); ?></th>
            <th style="width:6%"><?php echo e(__('sale.subtotal'), false); ?></th>
            <th style="width:8%"><?php echo e(__('purchase.unit_cost_exc_tax'), false); ?></th>
            <th style="width:7%"><?php echo e(__('lang_v1.total_purchase'), false); ?></th>
            <th style="width:6%"><?php echo e(__('lang_v1.profit'), false); ?></th>
            <th style="width:6%"><?php echo e(__('lang_v1.total_profit'), false); ?></th>
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
        ?>

        <tr>
            <td><?php if(empty($is_combo_item)): ?><?php echo e($loop->iteration, false); ?><?php else: ?> +> <?php endif; ?> </td>
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
            <td>
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
            <td>
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
            <td>
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
            <td>
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
            <td>
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
            <td>
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
            <td>
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
            <td>
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
            <td>
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
            <td>
                <?php
                if($sell->type == 'Sales'){
                    if(empty($is_combo_item) && !$is_combo_product){
                        $profit = (($sell_line->quantity-$sell_line->foc_quantity) * ($sell_line->unit_price_inc_tax - $sell_line->item_tax) - $total_purchase);
                        if($sell_line->quantity != 0){
                            $profit = $profit / $sell_line->quantity;
                        }
                    }elseif($is_combo_item){
                        $profit = $total_purchase / $sell_line->quantity;
                    }    

                }else{
                    $profit = (($sell_line->quantity_returned) * ($sell_line->unit_price_inc_tax - $sell_line->item_tax) - $total_purchase);
                    if($sell_line->quantity_returned != 0){
                        $profit = $profit / $sell_line->quantity_returned;
                    }
                }
                ?>
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
                <td><?php echo e($modifier->quantity, false); ?></td>
                <?php if(!empty($pos_settings['inline_service_staff'])): ?>
                    <td>
                        &nbsp;
                    </td>
                <?php endif; ?>
                <td>
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
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($modifier->unit_price, false); ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    &nbsp;
                </td>
                <td>
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
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($modifier->item_tax, false); ?></span> 
                    <?php endif; ?>
                    <?php if(!empty($taxes[$modifier->tax_id])): ?>
                    ( <?php echo e($taxes[$modifier->tax_id], false); ?> )
                    <?php endif; ?>
                </td>
                <td>
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
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($modifier->unit_price_inc_tax, false); ?></span>
                    <?php endif; ?>
                </td>
                <td>
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
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($modifier->quantity * $modifier->unit_price_inc_tax, false); ?></span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php
            if($sell->type == 'Sales'){
                $total_qty += $sell_line->quantity-$sell_line->foc_quantity;
                $discount += $sell_line->get_discount_amount();
                $discount += $sell_line->get_discount2_amount();
                $tax += $sell_line->item_tax * ($sell_line->quantity-$sell_line->foc_quantity);
                if(empty($is_combo_item)){
                    $total_subtotal += (($sell_line->quantity-$sell_line->foc_quantity) * ($sell_line->unit_price_inc_tax - $sell_line->item_tax));
                }
                $t_purchase += $total_purchase;
                
                if(!empty($is_combo_product) && empty($is_combo_item)){
                    $total_profit += $total_subtotal;
                }else if(!empty($is_combo_item)){
                    $total_profit -= ($sell_line->quantity * $profit);
                }else{
                    $total_profit += ($sell_line->quantity * $profit);
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
        <td <?php if(!empty($common_settings['enable_inline_discount2_sales'])): ?> colspan="2" <?php endif; ?>>
            <b>Total Discount:</b> <br>
            <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $discount, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?>
            <input type="hidden" class="total_discount_row" value="<?php echo e(($discount), false); ?>">
        </td>
        <td>
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
        <td>
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
        <td></td>
        <td>
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
        <td>
            <b>Total:</b> <br>
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
    </tr>
    <tr class="total_row_footer">
        <td><b>Invoice Totals</b></td>
        <td></td>
        <td></td>
        <td></td>
        <?php if(!empty($common_settings['enable_scheme_quantity_sales'])): ?>
        <td></td>
        <?php endif; ?>
        <td>
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
        <td></td>
        <td></td>
        <td>
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
        <td></td>
        <td></td>
        <td></td>
        <td>
            <b>Total:</b> <br>
            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_profit-$inv_discount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            <input type="hidden" class="total_profit_row" value="<?php echo e($total_profit-$inv_discount, false); ?>">
        </td>
    </tr>
</table>
