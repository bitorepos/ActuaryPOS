<div class="table-responsive">
<table class="table table-bordered">
    <thead>
        <tr class="row-border blue-heading text-center">
            <th>SKU</th>
            <th>Product</th>
            <th>Unit Price</th>
            <th>> Qty</th>
            <th>> Cost</th>
            <th>> Total</th>
            <th>Unit Cost</th>
            <th>Profit</th>
            <th>Gross Profit %</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $footer_sale_total = 0;
            $footer_purchase_total = 0;
        ?>

        <?php $__currentLoopData = $combo_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $total_purchase = 0;
                foreach ($cp['combo_variations'] as $cpcv){
                    $total_purchase += $cpcv['variation']->default_purchase_price * $cpcv['quantity'] * $cpcv['multiplier'];
                }
                $footer_sale_total += $cp['sale_price'];
                $footer_purchase_total += $total_purchase;
                $gross_profit = $cp['sale_price'] ? (($cp['sale_price'] - $total_purchase) / $cp['sale_price']) * 100 : 0;
            ?>

            <tr style="background-color: #ddd;">
                <td><?php echo e(trim($cp['sku']), false); ?></td>
                <td><?php echo e($cp['name'], false); ?></td>
                <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $cp['sale_price'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_purchase, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $cp['sale_price'] - $total_purchase, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $gross_profit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>%</td>
            </tr>

            <?php $__currentLoopData = $cp['combo_variations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td></td>
                    <td><?php echo e($loop->index+1, false); ?> > <?php echo e($v['variation']['product']->name, false); ?> 
                        <?php if($v['variation']['product']->type == 'variable'): ?>
                            - <?php echo e($v['variation']->name, false); ?>

                        <?php endif; ?>
                        (<?php echo e($v['variation']->sub_sku, false); ?>)
                    </td>
                    <td></td>
                    <td><?php echo e(number_format($v['quantity'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($v['unit_name'], false); ?></td>
                    <td><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $v['variation']->default_purchase_price, session("business.cost_decimal", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);
            echo $formated_number; ?></td>
                    <td><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $v['variation']->default_purchase_price * $v['quantity'] * $v['multiplier'], session("business.cost_decimal", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);
            echo $formated_number; ?></td>
                    <td></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr class="">
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php
            $footer_gross_profit = $footer_sale_total ? (($footer_sale_total - $footer_purchase_total) / $footer_sale_total) * 100 : 0;
        ?>
        <tr class="row-border blue-heading text-center">
            <th colspan="2">Grand Total</th>
            <th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $footer_sale_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
            <th></th>
            <th></th>
            <th></th>
            <th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $footer_purchase_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
            <th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $footer_sale_total - $footer_purchase_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
            <th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $footer_gross_profit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>%</th>
        </tr>
    </tbody>
</table>
</div>
