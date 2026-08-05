<tr class="product_row">
    <td><span class="sr_number"><?php echo e($row_index+1, false); ?></span></td>
	<td class="text-center"><?php echo e($product->sub_sku, false); ?></td>
    <td>
        <?php echo e($product->product_name, false); ?>

        <?php
            $purchase_line_note = '';
            if(!empty($product->purchase_line_note)){
                $purchase_line_note = $product->purchase_line_note;
            }
        ?>
        <?php if(!empty(session()->get('business.common_settings.enable_inline_product_note_purchase'))): ?>
            <br>
            <a href="javascript:void(0)" class="toggle-product-note" title="<?php echo app('translator')->get('lang_v1.product_note'); ?>">
                <i class="fa <?php echo e(!empty($purchase_line_note) ? 'fa-minus-circle text-danger' : 'fa-plus-circle text-success', false); ?>"></i>
                <small><?php echo app('translator')->get('lang_v1.product_note'); ?></small>
            </a>
            <div class="product-note-wrapper" style="<?php echo e(empty($purchase_line_note) ? 'display:none;' : '', false); ?>">
                <textarea class="form-control" name="products[<?php echo e($row_index, false); ?>][purchase_line_note]" rows="2"><?php echo e($purchase_line_note, false); ?></textarea>
            </div>
        <?php endif; ?>
    </td>
    <td class="<?php echo e(empty($user_settings['purchase_show_brand_column']) ? 'hide' : '', false); ?>"><?php echo e($product->brand, false); ?></td>
    <td class="<?php echo e(empty($user_settings['purchase_show_category_column']) ? 'hide' : '', false); ?>"><?php echo e($product->category, false); ?></td>
    
    <td>
        <input type="hidden" name="products[<?php echo e($row_index, false); ?>][product_id]" class="form-control product_id" value="<?php echo e($product->product_id, false); ?>">

        <input type="hidden" value="<?php echo e($product->variation_id, false); ?>" 
            name="products[<?php echo e($row_index, false); ?>][variation_id]">

        <input type="hidden" value="<?php echo e($product->enable_stock, false); ?>" 
            name="products[<?php echo e($row_index, false); ?>][enable_stock]">

        <?php if(!empty($last_purchase_line)): ?>
            
            <?php
                $qty = 1;
                $purchase_price = $last_purchase_line->purchase_price;
            ?>
        <?php else: ?> 
            <?php
                $edit = $edit ?? false;
                if($edit){
                    echo '<input type="hidden" value="'. $product->purchase_line_id.'" name="products['.$row_index.'][purchase_line_id]">';
                    $qty = $product->quantity_returned;
                    $purchase_price = $product->purchase_price;
                }else{
                    $qty = 1;
                    $purchase_price = $product->default_purchase_price;
                }
            ?>
        <?php endif; ?>
        <?php 
            $edit = $edit ?? false;
            $purchase_inclusive = false;
            $cost_decimal = session('business.cost_decimal', 2);
            if(!empty($is_tax_inclusive)){
                $purchase_inclusive = true;
            }
            if($edit){
                if($product->purchase_price == $product->purchase_price_inc_tax){
                    $purchase_inclusive = true;
                }
            }else{
                if(!empty($last_purchase_line) && $last_purchase_line->purchase_price == $last_purchase_line->purchase_price_inc_tax){
                    $purchase_inclusive = true;
                }
            }
        ?>

        <input type="text" class="form-control product_quantity input_number input_quantity" value="<?php echo e(number_format($qty, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" name="products[<?php echo e($row_index, false); ?>][quantity]" 
        <?php if($product->unit_allow_decimal == 1): ?> data-decimal=1 <?php else: ?> data-rule-abs_digit="true" data-msg-abs_digit="<?php echo app('translator')->get('lang_v1.decimal_value_not_allowed'); ?>" data-decimal=0 <?php endif; ?>
        data-rule-required="true" data-msg-required="<?php echo app('translator')->get('validation.custom-messages.this_field_is_required'); ?>" 
        
         <?php if($product->unit_allow_decimal != 1): ?> data-rule-min-value="1" data-msg-min-value="Quantity cannot be zero" <?php endif; ?>>
         <?php echo e($product->unit, false); ?>

    </td>
    <?php 
    if($edit){
        $pp_without_discount = $product->pp_without_discount;
        $discount_percent = $product->discount_percent;
        $discount2_percent = $product->discount2_percent;
        $tax_id = $product->tax_id;
        $item_tax = $product->item_tax;

    }else{
        $pp_without_discount = (!empty($last_purchase_line) && !empty($last_purchase_line->pp_without_discount)) ? $last_purchase_line->pp_without_discount : $product->default_purchase_price;
        $discount_percent = !empty($last_purchase_line) ? ($last_purchase_line->discount_percent ?? 0) : 0;
        $discount2_percent = !empty($last_purchase_line) ? ($last_purchase_line->discount2_percent ?? 0) : 0;
        $tax_id = !empty($last_purchase_line) ? $last_purchase_line->tax_id : null;
        $item_tax = !empty($last_purchase_line) ? $last_purchase_line->item_tax : 0;
        if(empty($tax_id)){
            if(!empty($product->tax_id)){
                $tax_id = $product->tax_id;
                $item_tax = $product->dpp_inc_tax-$product->default_purchase_price;
            }    
        }
    }
    ?>
    <td class="text-end">
        <input type="text" name="products[<?php echo e($row_index, false); ?>][pp_without_discount]" class="form-control pp_without_discount input_number input_cost" 
        value="<?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $pp_without_discount, session("business.cost_decimal", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);
            echo $formated_number; ?>">
    </td>
    
    <?php 
        $hide_discount = '';
        if(empty($common_settings['enable_inline_discount_purchase'])){
				$hide_discount = 'hide';
		}
    ?>
    <td class="<?php echo e($hide_discount, false); ?>">
        <?php echo Form::text('products[' . $row_index . '][discount_percent]', number_format($discount_percent, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), 
        ['class' => 'form-control input-sm inline_discounts input_number', 'required']); ?>

    </td>

    <?php 
        $hide_discount2 = '';
        if(empty($common_settings['enable_inline_discount2_purchase'])){
            $hide_discount2 = 'hide';
		}
    ?>

    <td class="<?php echo e($hide_discount2, false); ?>">
        <?php echo Form::text('products[' . $row_index . '][discount2_percent]', number_format($discount2_percent, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), 
        ['class' => 'form-control input-sm inline_discounts2 input_number', 'required']); ?>

    </td>
    
    <td class="text-end <?php echo e($hide_discount, false); ?>">
        <?php echo Form::text('products[' . $row_index . '][unit_price]',
        number_format($purchase_price, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator), 
        ['class' => 'form-control input-sm product_unit_price input_number input_cost', 'required']); ?>

    </td>

        <?php 
        $hide_tax = '';
        if(empty($common_settings['enable_inline_tax_purchase']) || $taxes->isEmpty()){
				$hide_tax = 'hide';
		}
        ?>

        <td class="text-end <?php echo e($hide_tax, false); ?>">
            <span class="row_subtotal_before_tax display_currency"><?php echo e($qty * $purchase_price, false); ?></span>
            <input type="hidden" class="product_tax_type" value="<?php echo e($product->tax_type, false); ?>">
        </td>
        <td class="<?php echo e($hide_tax, false); ?>">
            <div class="input-group">
                <select name="products[<?php echo e($row_index, false); ?>][purchase_line_tax_id]" class="form-control select2 input-sm purchase_line_tax_id" placeholder="'Please Select'">
                    <option value="" data-tax_amount="0" <?php if( $hide_tax == 'hide' ): ?>
                    selected <?php endif; ?> ><?php echo app('translator')->get('lang_v1.none'); ?></option>
                    <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tax->id, false); ?>" data-tax_amount="<?php echo e($tax->amount, false); ?>" data-tax_type="<?php echo e($tax->type, false); ?>" <?php if( $tax_id == $tax->id && $hide_tax != 'hide'): ?> selected <?php endif; ?> ><?php echo e($tax->name, false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php echo Form::hidden('products[' . $row_index . '][item_tax]', $item_tax, ['class' => 'purchase_product_unit_tax']); ?>

                <span class="input-group-text purchase_product_unit_tax_text">
                    <?php echo e(number_format($item_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
                <span class="input-group-text purchase_product_unit_total_tax_text"><?php echo e(number_format($qty * $item_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
            </div>
        </td>
        <td class="text-end <?php echo e($hide_tax, false); ?>">
            <?php
                if(!$purchase_inclusive){
                    $dpp_inc_tax = number_format($purchase_price+$item_tax, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator);
                    if($hide_tax == 'hide' && !empty($last_purchase_line)){
                        $dpp_inc_tax = number_format($last_purchase_line->purchase_price, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator);
                    }
                }else{
                    $dpp_inc_tax = number_format($purchase_price, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator);
                }

                // if(!empty($last_purchase_line->tax_id)){
                //     $dpp_inc_tax = number_format($purchase_price+$item_tax, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator);
                // }

                // $dpp_inc_tax = !empty($purchase_order_line) ? number_format($purchase_order_line->purchase_price_inc_tax/$purchase_order->exchange_rate, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator) : $dpp_inc_tax;

            ?> 
            <?php echo Form::text('products[' . $row_index . '][purchase_price_inc_tax]', $dpp_inc_tax, ['class' => 'form-control input-sm purchase_unit_cost_after_tax input_number input_cost', 'required', 'readonly']); ?>

        </td>
        
        
        
    <td class="text-end">
        <input type="text" readonly name="products[<?php echo e($row_index, false); ?>][product_line_total]" class="form-control product_line_total" value="<?php echo e(number_format($qty*$dpp_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
    </td>
    <?php if(session('business.enable_lot_number')): ?>
        <td>
            <input type="text" name="products[<?php echo e($row_index, false); ?>][lot_number]" class="form-control" value="<?php echo e($product->lot_number ?? '', false); ?>">
        </td>
        <?php endif; ?>
        <?php if(session('business.enable_product_expiry')): ?>
        <td>
            <input type="text" name="products[<?php echo e($row_index, false); ?>][exp_date]" class="form-control expiry_datepicker" value="<?php if(!empty($product->exp_date)): ?><?php echo e(\Carbon::createFromTimestamp(strtotime($product->exp_date))->format(session('business.date_format')), false); ?><?php endif; ?>" readonly>
        </td>
        <?php endif; ?>
    <td class="text-center">
        <i class="fa fa-trash remove_product_row cursor-pointer" aria-hidden="true"></i>
    </td>
</tr>
