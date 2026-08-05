<?php if($format != 'format_4'): ?>
<table class="table <?php if(!empty($for_ledger)): ?> table-slim mb-0 bg-light-skin <?php else: ?>  mb-0 bg-gray <?php endif; ?>" <?php if(!empty($for_pdf)): ?> style="width: 100%;" <?php endif; ?>>
    <tr <?php if(empty($for_ledger)): ?> class="bg-green" <?php endif; ?>>
        <th>#</th>
        <th><?php echo e(__('sale.sku'), false); ?></th>
        <th><?php echo e(!empty($kot_layout->table_product_label) ? $kot_layout->table_product_label : __('sale.product'), false); ?></th>
        <th><?php echo e(!empty($kot_layout->table_qty_label) ? $kot_layout->table_qty_label : __('sale.qty'), false); ?></th>
        <?php if(empty($kot_layout->common_settings['hide_price_total'])): ?>
            <?php if(!empty($kot_layout->table_unit_price_label)): ?>
            <th><?php echo e($kot_layout->table_unit_price_label, false); ?></th>
            <?php endif; ?>
            <?php if(!empty($kot_layout->common_settings['price_inc_tax_label'])): ?>
            <th><?php echo e($kot_layout->common_settings['price_inc_tax_label'], false); ?></th>
            <?php endif; ?>
            <?php if(!empty($kot_layout->table_subtotal_label)): ?>
            <th><?php echo e($kot_layout->table_subtotal_label, false); ?></th>
            <?php endif; ?>
        <?php endif; ?>
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
                    <br><span class="label <?php if($sell_line->res_line_order_status == 'cooked' ): ?> bg-red <?php elseif($sell_line->res_line_order_status == 'served'): ?> bg-green <?php else: ?> bg-primary <?php endif; ?>"><?php echo app('translator')->get('restaurant.order_statuses.' . $sell_line->res_line_order_status); ?> </span>
                <?php endif; ?>
                <?php if(in_array('kitchen', $enabled_modules) && empty($for_ledger)): ?>
                    <br><span class="label bg-primary"><?php echo app('translator')->get('lang_v1.prep_time'); ?> : <?php echo e(!empty($sell_line->product->preparation_time_in_minutes) ? $sell_line->product->preparation_time_in_minutes . ' min' : '', false); ?></span>
                    <?php if($sell_line->prep_time_passed): ?>
                        <input class="prep_time_passed" type="hidden" value="1">
                    <?php endif; ?>
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
            </td>
            <td>
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
            <?php if(empty($kot_layout->common_settings['hide_price_total'])): ?>
                <?php if(!empty($kot_layout->table_unit_price_label)): ?>
                <td>
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
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->unit_price_before_discount, false); ?></span>
                    <?php endif; ?>
                </td>
                <?php endif; ?>
                <?php if(!empty($kot_layout->common_settings['price_inc_tax_label'])): ?>
                <td>
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
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->unit_price_inc_tax, false); ?></span>
                    <?php endif; ?>
                </td>
                <?php endif; ?>
                <?php if(!empty($kot_layout->table_subtotal_label)): ?>
                <td>
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
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->quantity * $sell_line->unit_price_inc_tax, false); ?></span>
                    <?php endif; ?>
                </td>
                <?php endif; ?>
            <?php endif; ?>
        </tr>
        <?php if(!empty($sell_line->modifiers)): ?>
        <?php $__currentLoopData = $sell_line->modifiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <?php echo e($modifier->product->name, false); ?> - <?php echo e($modifier->variations->name ?? '', false); ?>,
                    <?php echo e($modifier->variations->sub_sku ?? '', false); ?>

                </td>
                <td><?php echo e($modifier->quantity, false); ?></td>
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
