<?php
    $common_settings = session()->get('business.common_settings');
    $show_product_tax_fields = $show_product_tax_fields ?? (!is_array($common_settings) || !array_key_exists('enable_product_tax', $common_settings) || !empty($common_settings['enable_product_tax']));
?>
<table class="table pir_line_details table-bordered table-slim mb-0 bg-light-skin" style="table-layout: fixed; width: 100%;">
    <tr>
        <th style="width:5%">#</th>
        <th style="width:23%;min-width: 23%;"><?php echo e(__('sale.product'), false); ?></th>
        <th style="width:8%"><?php echo e(__('sale.qty'), false); ?></th>
        <th style="width:8%" class="text-right"><?php echo e(__('purchase.unit_cost_before_tax'), false); ?></th>
        <th style="width:8%" class="text-right"><?php echo e(__('sale.discount'), false); ?></th>
        <?php if($show_product_tax_fields): ?>
        <th style="width:8%" class="text-right"><?php echo e(__('sale.tax'), false); ?></th>
        <?php endif; ?>
        <?php if($show_product_tax_fields): ?>
        <th style="width:8%" class="text-right"><?php echo e(__('purchase.unit_cost_after_tax'), false); ?></th>
        <?php endif; ?>
        <th style="width:8%" class="text-right"><?php echo e(__('sale.subtotal'), false); ?></th>
        <th style="width:8%" class="text-right"><?php echo e(__('purchase.unit_selling_price'), false); ?></th>
        <th style="width:8%" class="text-right"><?php echo e(__('lang_v1.profit'), false); ?></th>
        <th style="width:8%" class="text-right"><?php echo e(__('lang_v1.profit_margin'), false); ?></th>
    </tr>
    <?php
        $total_qty = 0;
        $discount = 0;
        $tax = 0;
        $total_subtotal = 0;
        $total_sell_price = 0;
        $total_profit = 0;
    ?>
    <?php if(!empty($purchase->purchase_lines)): ?>
    <?php $__currentLoopData = $purchase->purchase_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $qty = $purchase->transaction_type == 'purchase_return' ? $line->quantity_returned : $line->quantity;
            $unit_cost = $line->purchase_price ?? 0;
            $unit_cost_inc_tax = $line->purchase_price_inc_tax ?? 0;
            $sell_price = !empty($line->sell_price) ? $line->sell_price : ($line->variations->sell_price_inc_tax ?? 0);
            $line_discount = $line->get_discount_amount();
            $line_tax = $line->item_tax ?? 0;
            $subtotal = $qty * $unit_cost_inc_tax;
            $sell_price_total = $sell_price * $qty;
            $profit = ($sell_price - $unit_cost_inc_tax) * $qty;
            $gp_percent = $sell_price_total != 0 ? ($profit / $sell_price_total) * 100 : 0;

            $total_qty += $qty;
            $discount += $line_discount;
            $tax += $line_tax * $qty;
            $total_subtotal += $subtotal;
            $total_sell_price += $sell_price_total;
            $total_profit += $profit;
        ?>
        <tr>
            <td><?php echo e($loop->iteration, false); ?></td>
            <td style="text-wrap:auto">
                <?php echo e($line->product->name ?? '', false); ?>

                <?php if(!empty($line->product) && $line->product->type == 'variable'): ?>
                    - <?php echo e($line->variations->product_variation->name ?? '', false); ?>

                    - <?php echo e($line->variations->name ?? '', false); ?>

                <?php endif; ?>
                <?php echo e($line->variations->sub_sku ?? '', false); ?>

                <?php
                    $brand = $line->product->brand ?? null;
                ?>
                <?php if(!empty($brand) && !empty($brand->name)): ?>
                    , <?php echo e($brand->name, false); ?>

                <?php endif; ?>
            </td>
            <td>
                <?php echo e(number_format($qty, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                <?php if(!empty($line->sub_unit)): ?>
                    <?php echo e($line->sub_unit->short_name, false); ?>

                <?php elseif(!empty($line->product) && !empty($line->product->unit)): ?>
                    <?php echo e($line->product->unit->short_name, false); ?>

                <?php endif; ?>
                <?php if(!empty($line->product) && !empty($line->product->second_unit) && !empty($line->secondary_unit_quantity) && $line->secondary_unit_quantity != 0): ?>
                    <br><?php echo e(number_format($line->secondary_unit_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($line->product->second_unit->short_name, false); ?>

                <?php endif; ?>
            </td>
            <td class="text-right">
                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $unit_cost, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            </td>
            <td class="text-right">
                <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $line_discount, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?>
                <?php if($line->discount_type == 'percentage'): ?>
                    <br>(<?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $line->discount_percent, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?> %)
                <?php endif; ?>
            </td>
            <?php if($show_product_tax_fields): ?>
            <td class="text-right">
                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $line_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                <?php if(!empty($line->line_tax)): ?>
                    <br><small>(<?php echo e($line->line_tax->name, false); ?>)</small>
                <?php endif; ?>
            </td>
            <?php endif; ?>
            <?php if($show_product_tax_fields): ?>
            <td class="text-right">
                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $unit_cost_inc_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            </td>
            <?php endif; ?>
            <td class="text-right">
                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $subtotal, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            </td>
            <td class="text-right">
                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            </td>
            <td class="text-right">
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
            </td>
            <td class="text-right">
                <?php echo e(number_format($gp_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> %
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php
        $total_gp_percent = $total_sell_price != 0 ? ($total_profit / $total_sell_price) * 100 : 0;
    ?>
    <tr class="pir_total_row_footer">
        <td><b>Product Totals</b></td>
        <td></td>
        <td>
            <b>Total Qty:</b><br>
            <?php echo e(number_format($total_qty, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

            <input type="hidden" class="pir_total_quantity_row" value="<?php echo e($total_qty, false); ?>">
        </td>
        <td></td>
        <td class="text-right">
            <b>Total Discount:</b><br>
            <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $discount, session("business.discount_precision", 2) , ".");
            echo $formated_number; ?>
            <input type="hidden" class="pir_total_discount_row" value="<?php echo e($discount, false); ?>">
        </td>
        <?php if($show_product_tax_fields): ?>
        <td class="text-right">
            <b>Total Tax:</b><br>
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
            <input type="hidden" class="pir_total_tax_row" value="<?php echo e($tax, false); ?>">
        </td>
        <td></td>
        <?php endif; ?>
        <td class="text-right">
            <b>Total:</b><br>
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
            <input type="hidden" class="pir_total_sub_total_row" value="<?php echo e($total_subtotal, false); ?>">
        </td>
        <td class="text-right">
            <b>Total Sell:</b><br>
            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_sell_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            <input type="hidden" class="pir_total_sell_price_row" value="<?php echo e($total_sell_price, false); ?>">
        </td>
        <td class="text-right">
            <b>Total Profit:</b><br>
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
            <input type="hidden" class="pir_total_profit_row" value="<?php echo e($total_profit, false); ?>">
        </td>
        <td class="text-right">
            <b>G.P %:</b><br>
            <?php echo e(number_format($total_gp_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> %
        </td>
    </tr>
    <tr class="pir_total_row_footer">
        <td><b>Invoice Totals</b></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right">
            <b>Invoice Discount:</b><br>
            <?php
                $inv_discount = 0;
                if (!empty($purchase->discount_type) && !empty($purchase->discount_amount)) {
                    if ($purchase->discount_type == 'fixed') {
                        $inv_discount = $purchase->discount_amount;
                    } elseif ($purchase->discount_type == 'percentage') {
                        $inv_discount = ($purchase->total_before_tax * $purchase->discount_amount) / 100;
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
            <input type="hidden" class="pir_total_discount_row" value="<?php echo e($inv_discount, false); ?>">
        </td>
        <?php if($show_product_tax_fields): ?>
        <td></td>
        <?php endif; ?>
        <?php if($show_product_tax_fields): ?>
        <td></td>
        <?php endif; ?>
        <td class="text-right">
            <b>Total:</b><br>
            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_subtotal - $inv_discount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            <input type="hidden" class="pir_total_sub_total_row" value="<?php echo e($total_subtotal - $inv_discount, false); ?>">
        </td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
