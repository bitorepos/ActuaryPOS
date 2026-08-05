<?php
$sub_units_before = $sub_units;
?>
<?php $__currentLoopData = $variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
if($is_tax_inclusive == 'true'){
    $variation->default_purchase_price = $variation->dpp_inc_tax;
}
if(!empty($variation->variation_sub_unit_id) && !empty($sub_units_before)){
    $variation_sub_unit_id = $variation->variation_sub_unit_id;
    $first_key = array_key_first($sub_units_before);
    $sub_units = array_filter(
        $sub_units_before,
        function ($value, $key) use ($first_key, $variation_sub_unit_id) {
            return $key === $first_key || $key === $variation_sub_unit_id;
        },
        ARRAY_FILTER_USE_BOTH
    );
}else{
    $sub_units = $sub_units_before;
}
if(!empty($supplier_based_pricing) && !empty($supplier_id)){
    $variation->default_purchase_price = !empty($last_purchase_line->pp_without_discount) ? $last_purchase_line->pp_without_discount : $variation->default_purchase_price;
}
?>
    <tr class="product_row" id="product_row_<?php echo e($row_count, false); ?>" <?php if(!empty($purchase_order_line)): ?> data-purchase_order_id="<?php echo e($purchase_order_line->transaction_id, false); ?>" <?php endif; ?> <?php if(!empty($purchase_requisition_line)): ?> data-purchase_requisition_id="<?php echo e($purchase_requisition_line->transaction_id, false); ?>" <?php endif; ?>>
        <td><span class="sr_number"></span></td>
        <td><?php echo e($variation->sub_sku, false); ?></td>
        <td>
            <?php echo e($product->name, false); ?>

            <?php if( $product->type == 'variable' ): ?>
                <br/>
                (<b><?php echo e($variation->product_variation->name, false); ?></b> : <?php echo e($variation->name, false); ?>)
            <?php endif; ?>
            <?php if($product->enable_stock == 1): ?>
                <br>
                <small class="text-muted" style="white-space: wrap;"><?php echo app('translator')->get('report.current_stock'); ?>: <?php if(!empty($variation->variation_location_details->first())): ?> <?php echo e(number_format($variation->variation_location_details->first()->qty_available, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php else: ?> 0 <?php endif; ?> <?php echo e($product->unit->short_name, false); ?></small>
            <?php endif; ?>
            <?php
                $purchase_line_note = '';
                if(!empty($purchase_order_line)){
                    $purchase_line_note = $purchase_order_line->purchase_line_note;
                }
            ?>
            <?php if(!empty($common_settings['enable_inline_product_note_purchase'])): ?>
            <br>
                <a href="javascript:void(0)" class="toggle-product-note" title="<?php echo app('translator')->get('lang_v1.product_note'); ?>">
                    <i class="fa <?php echo e(!empty($purchase_line_note) ? 'fa-minus-circle text-danger' : 'fa-plus-circle text-success', false); ?>"></i>
                    <small><?php echo app('translator')->get('lang_v1.product_note'); ?></small>
                </a>
                <div class="product-note-wrapper" style="<?php echo e(empty($purchase_line_note) ? 'display:none;' : '', false); ?>">
                    <textarea class="form-control" name="purchases[<?php echo e($row_count, false); ?>][purchase_line_note]" rows="2"><?php echo e($purchase_line_note, false); ?></textarea>
                </div>
            <?php endif; ?>
            <?php if(!empty($common_settings['enable_purchase_rack_details'])): ?>
                <?php if(session('business.enable_racks')): ?>
                <?php echo Form::text('purchases[' . $row_count . '][product_racks]['.$location_id.'][rack]', $rack_details->rack ?? null, ['class' => 'form-control input-sm', 'placeholder' => 'Rack'] ); ?>       
                <?php endif; ?>
                <?php if(session('business.enable_row')): ?>
                <?php echo Form::text('purchases[' . $row_count . '][product_racks]['.$location_id.'][row]', $rack_details->row ?? null, ['class' => 'form-control input-sm', 'placeholder' => 'Row'] ); ?>       
                <?php endif; ?>
                <?php if(session('business.enable_position')): ?>
                <?php echo Form::text('purchases[' . $row_count . '][product_racks]['.$location_id.'][position]', $rack_details->position ?? null, ['class' => 'form-control input-sm', 'placeholder' => 'Position'] ); ?>       
                <?php endif; ?>
            <?php endif; ?>
        </td>
        <?php if(!empty($user_settings['purchase_show_brand_column'])): ?>
        <td><?php echo e($product->brand->name, false); ?></td>
        <?php endif; ?>
        <?php if(!empty($user_settings['purchase_show_category_column'])): ?>
        <td><?php echo e($product->category->name, false); ?></td>
        <?php endif; ?>
        <?php if(!empty($common_settings['enable_serial_number'])): ?>
        <td>
            <?php if($product->enable_sr_no && empty($common_settings['bulk_add_serial_number_purchase'])): ?>
            <?php echo Form::text('purchases[' . $row_count . '][serial_number]', $purchase_order_line->serial_number, ['class' => 'form-control input-sm serial_number', 
             'placeholder' => !empty($common_settings['serial_number_label']) ? $common_settings['serial_number_label']: 'Serial Number',
             !empty($common_settings['is_serial_number_required_purchase']) ? 'required' : '' ] ); ?>       
            <?php elseif($product->enable_sr_no && !empty($common_settings['bulk_add_serial_number_purchase'])): ?>
                <button type="button" class="btn btn-sm btn-primary row_add_serial_numbers_btn" data-is_required="<?php if(!empty($common_settings['is_serial_number_required_purchase'])): ?> 1 <?php else: ?> 0 <?php endif; ?>"  data-bs-toggle="modal" data-bs-target="#add_serial_numbers_modal_<?php echo e($row_count, false); ?>">Add Serial Nos.</button>
            <?php endif; ?>

            <?php if($product->enable_imei_no): ?>
            <?php if(!empty($common_settings['enable_imei_number'])): ?>
                <?php if(!empty($common_settings['imei1_number_label'])): ?>
                    <?php echo Form::text('purchases[' . $row_count . '][imei][1]', $purchase_order_line->imei_numbers[1], 
                    ['class' => 'form-control input-sm imei_number', 'style' => 'margin-top: 5px;',
                    'placeholder' => !empty($common_settings['imei1_number_label']) ? $common_settings['imei1_number_label']: 'IMEI1',
                    !empty($common_settings['is_imei_number_required_purchase']) ? 'required' : '' ] ); ?>       
                <?php endif; ?>
                <?php if(!empty($common_settings['imei2_number_label'])): ?>
                    <?php echo Form::text('purchases[' . $row_count . '][imei][2]', $purchase_order_line->imei_numbers[2], 
                    ['class' => 'form-control input-sm imei_number', 'style' => 'margin-top: 5px;',
                    'placeholder' => !empty($common_settings['imei2_number_label']) ? $common_settings['imei2_number_label']: 'IMEI2',
                    !empty($common_settings['is_imei_number_required_purchase']) ? 'required' : '' ] ); ?>       
                <?php endif; ?>
                <?php if(!empty($common_settings['imei3_number_label'])): ?>
                    <?php echo Form::text('purchases[' . $row_count . '][imei][3]', $purchase_order_line->imei_numbers[3], 
                    ['class' => 'form-control input-sm imei_number', 'style' => 'margin-top: 5px;',
                    'placeholder' => !empty($common_settings['imei3_number_label']) ? $common_settings['imei1_number_label']: 'IMEI3',
                    !empty($common_settings['is_imei_number_required_purchase']) ? 'required' : '' ] ); ?>       
                <?php endif; ?>
                <?php if(!empty($common_settings['imei4_number_label'])): ?>
                    <?php echo Form::text('purchases[' . $row_count . '][imei][4]', $purchase_order_line->imei_numbers[4], 
                    ['class' => 'form-control input-sm imei_number', 'style' => 'margin-top: 5px;',
                    'placeholder' => !empty($common_settings['imei4_number_label']) ? $common_settings['imei4_number_label']: 'IMEI4',
                    !empty($common_settings['is_imei_number_required_purchase']) ? 'required' : '' ] ); ?>       
                <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>

            <?php if($product->enable_sr_no && !empty($common_settings['bulk_add_serial_number_purchase'])): ?>
            <div class="modal fade bulk_add_serial_numbers_modal" id="add_serial_numbers_modal_<?php echo e($row_count, false); ?>" tabindex="-1" role="dialog">
                <?php echo $__env->make('purchase.partials.add_serial_numbers_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <?php endif; ?>
            
        </td>
        <?php endif; ?>
        <td>
            <?php if(!empty($purchase_order_line)): ?>
                <?php echo Form::hidden('purchases[' . $row_count . '][purchase_order_line_id]', $purchase_order_line->id ); ?>

            <?php endif; ?>

            <?php if(!empty($purchase_requisition_line)): ?>
                <?php echo Form::hidden('purchases[' . $row_count . '][purchase_requisition_line_id]', $purchase_requisition_line->id ); ?>

            <?php endif; ?>

            <?php echo Form::hidden('purchases[' . $row_count . '][product_id]', $product->id ); ?>

            <?php echo Form::hidden('purchases[' . $row_count . '][variation_id]', $variation->id , ['class' => 'hidden_variation_id']); ?>


            <?php
                $check_decimal = 'false';
                if($product->unit->allow_decimal == 0){
                    $check_decimal = 'true';
                }
                $currency_precision = session('business.currency_precision', 2);
                $cost_decimal = session('business.cost_decimal', 2);
                $quantity_precision = session('business.quantity_precision', 2);

                $quantity_value = !empty($purchase_order_line) ? $purchase_order_line->quantity : 1;

                $quantity_value = !empty($purchase_requisition_line) ? $purchase_requisition_line->quantity - $purchase_requisition_line->po_quantity_purchased : $quantity_value;
                $max_quantity = 0;
                // $max_quantity = !empty($purchase_order_line) ? $purchase_order_line->quantity - $purchase_order_line->po_quantity_purchased : 0;

                // $max_quantity = !empty($purchase_requisition_line) ? $purchase_requisition_line->quantity - $purchase_requisition_line->po_quantity_purchased : $max_quantity;

                $quantity_value = !empty($imported_data) ? $imported_data['quantity'] : $quantity_value;
                $defualt_unit = !empty($imported_data) ? $imported_data['sub_unit_id'] : null;
                $selected_sub_unit_multiplier = 1;
                if (!empty($sub_units)) {
                    if (!empty($defualt_unit) && !empty($sub_units[$defualt_unit]['multiplier'])) {
                        $selected_sub_unit_multiplier = $sub_units[$defualt_unit]['multiplier'];
                    } else {
                        $first_sub_unit = reset($sub_units);
                        $selected_sub_unit_multiplier = $first_sub_unit['multiplier'] ?? 1;
                    }
                }
                $disable_qty = (!empty($product->enable_sr_no) && empty($common_settings['bulk_add_serial_number_purchase'])) ? true : false;
                $disable_qty_unit = !empty($product->enable_sr_no) ? true : false;
            ?>
            
<?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
            <div class="multi-input input-number">
            <?php endif; ?>

            <input type="text" 
                name="purchases[<?php echo e($row_count, false); ?>][quantity]" 
                value="<?php echo e(number_format($quantity_value, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>"
                class="form-control input-sm purchase_quantity input_number mousetrap"
                required
                data-rule-abs_digit=<?php echo e($check_decimal, false); ?>

                data-msg-abs_digit="<?php echo e(__('lang_v1.decimal_value_not_allowed'), false); ?>"
                <?php if(!empty($max_quantity)): ?>
                    data-rule-max-value="<?php echo e($max_quantity, false); ?>"
                    data-msg-max-value="<?php echo e(__('lang_v1.max_quantity_quantity_allowed', ['quantity' => $max_quantity]), false); ?>"
                <?php endif; ?>
                <?php if($disable_qty): ?> readonly <?php endif; ?>
            >

            <input type="hidden" class="base_unit_cost2" value="<?php echo e($variation->default_purchase_price, false); ?>">
            <input type="hidden" class="base_unit_cost" value="<?php echo e($variation->default_purchase_price, false); ?>">
            <input type="hidden" class="base_unit_selling_price" value="<?php echo e($variation->sell_price_inc_tax, false); ?>">

            <input type="hidden" name="purchases[<?php echo e($row_count, false); ?>][product_unit_id]" value="<?php echo e($product->unit->id, false); ?>">
            <?php if(!empty($sub_units)): ?>
                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                <select name="purchases[<?php echo e($row_count, false); ?>][sub_unit_id]" class="form-control input-sm sub_unit inline-select" <?php if($disable_qty_unit): ?> style="pointer-events: none;background-color:#F5F5F5;" <?php endif; ?>  <?php if(!empty($defualt_unit)): ?> data-default-bypassed="<?php echo e($defualt_unit, false); ?>" <?php endif; ?>>
                    <?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>" <?php if(!empty($defualt_unit) && $defualt_unit == $key): ?> <?php echo e('selected', false); ?> <?php endif; ?> data-multiplier="<?php echo e($value['multiplier'], false); ?>">
                            <?php echo e($value['short_name'] ?? $value['name'], false); ?>

                        </option> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php else: ?>
                <br>
                <select name="purchases[<?php echo e($row_count, false); ?>][sub_unit_id]" class="form-control input-sm sub_unit" <?php if($disable_qty_unit): ?> style="pointer-events: none;background-color:#F5F5F5;" <?php endif; ?>  <?php if(!empty($defualt_unit)): ?> data-default-bypassed="<?php echo e($defualt_unit, false); ?>" <?php endif; ?>>
                    <?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>" <?php if(!empty($defualt_unit) && $defualt_unit == $key): ?> <?php echo e('selected', false); ?> <?php endif; ?> data-multiplier="<?php echo e($value['multiplier'], false); ?>">
                            <?php echo e($value['name'], false); ?>

                        </option> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php endif; ?>
            <?php else: ?> 
                <?php echo e($product->unit->short_name, false); ?>

            <?php endif; ?>

            <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
            </div>
            <?php endif; ?>

            <?php if(!empty($product->second_unit)): ?>
                <?php
                    $secondary_unit_quantity = !empty($purchase_requisition_line) ? $purchase_requisition_line->secondary_unit_quantity : "";
                ?>
                <br>
                <span style="white-space: nowrap;">
                <?php echo app('translator')->get('lang_v1.quantity_in_second_unit', ['unit' => $product->second_unit->short_name]); ?>*:</span><br>
                <input type="text" 
                name="purchases[<?php echo e($row_count, false); ?>][secondary_unit_quantity]" 
                <?php if($secondary_unit_quantity !== ''): ?>value="<?php echo e(number_format($secondary_unit_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" <?php endif; ?>
                class="form-control input-sm input_number"
                required>
            <?php endif; ?>
        </td>
        <?php 
        $hide_scheme_qty = '';
        if (empty($common_settings['enable_scheme_quantity_purchase'])) {
            $hide_scheme_qty = 'hide';
        }
        ?>
        <?php if(!empty($common_settings['enable_scheme_quantity_purchase'])): ?>
        <td class="<?php echo e($hide_scheme_qty, false); ?>">
            <?php
                $check_decimal = 'false';
                if($product->unit->allow_decimal == 0){
                    $check_decimal = 'true';
                }
                $currency_precision = session('business.currency_precision', 2);
                $quantity_precision = session('business.quantity_precision', 2);

                $foc_quantity_value = !empty($purchase_order_line) ? $purchase_order_line->foc_quantity : 0;

                $foc_quantity_value = !empty($purchase_requisition_line) ? $purchase_requisition_line->foc_quantity : $foc_quantity_value;
                $max_foc_quantity = !empty($purchase_order_line) ? $purchase_order_line->quantity - $purchase_order_line->foc_quantity : 0;

                $max_foc_quantity = !empty($purchase_requisition_line) ? $purchase_requisition_line->quantity - $purchase_requisition_line->foc_quantity : $max_foc_quantity;

                $max_foc_quantity = 0;

                $quantity_value = !empty($imported_data) ? $imported_data['foc_quantity'] : $foc_quantity_value;
                $disable_qty = !empty($product->enable_sr_no) ? true : false;
            ?>
            
            <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
            <div class="multi-input input-number">
            <?php endif; ?>

            <input type="text" 
                name="purchases[<?php echo e($row_count, false); ?>][foc_quantity]" 
                value="<?php echo e(number_format($foc_quantity_value, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>"
                class="form-control input-sm purchase_foc_quantity input_number mousetrap"
                required
                data-rule-abs_digit=<?php echo e($check_decimal, false); ?>

                data-msg-abs_digit="<?php echo e(__('lang_v1.decimal_value_not_allowed'), false); ?>"
                <?php if(!empty($max_foc_quantity)): ?>
                    data-rule-max-value="<?php echo e($max_foc_quantity, false); ?>"
                    data-msg-max-value="<?php echo e(__('lang_v1.max_quantity_quantity_allowed', ['quantity' => $max_foc_quantity]), false); ?>"
                <?php endif; ?>
                <?php if($disable_qty): ?> readonly <?php endif; ?>
            >
            <?php if(!empty($sub_units)): ?>
                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                <select name="purchases[<?php echo e($row_count, false); ?>][foc_sub_unit_id]" class="form-control input-sm foc_sub_unit inline-select" <?php if($disable_qty): ?> style="pointer-events: none;background-color:#F5F5F5;" <?php endif; ?>>
                    <?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>" data-multiplier="<?php echo e($value['multiplier'], false); ?>">
                            <?php echo e($value['short_name'] ?? $value['name'], false); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php else: ?>
                <br>
                <select name="purchases[<?php echo e($row_count, false); ?>][foc_sub_unit_id]" class="form-control input-sm foc_sub_unit" <?php if($disable_qty): ?> style="pointer-events: none;background-color:#F5F5F5;" <?php endif; ?>>
                    <?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>" data-multiplier="<?php echo e($value['multiplier'], false); ?>">
                            <?php echo e($value['name'], false); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php endif; ?>
            <?php else: ?> 
                <?php echo e($product->unit->short_name, false); ?>

            <?php endif; ?>

            <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
            </div>
            <?php endif; ?>

            
        </td>
        <?php endif; ?>
        <?php
        $hide_tax = '';
        if(empty($common_settings['enable_inline_tax_purchase']) || $taxes->isEmpty()){
				$hide_tax = 'hide';
		}
        $scheme_tax_id = !empty($purchase_order_line)
            ? ($purchase_order_line->scheme_tax_id ?? $purchase_order_line->tax_id ?? $product->tax)
            : $product->tax;
        $scheme_tax_id = !empty($imported_data['tax_id']) ? $imported_data['tax_id'] : $scheme_tax_id;
        $scheme_tax_id = !empty($imported_data['scheme_tax_id']) ? $imported_data['scheme_tax_id'] : $scheme_tax_id;
        ?>
        <?php if(!empty($common_settings['enable_scheme_quantity_purchase'])): ?>
        <td class="<?php echo e($hide_scheme_qty, false); ?> <?php echo e($hide_tax, false); ?>">
            <div class="input-group">
                <select name="purchases[<?php echo e($row_count, false); ?>][scheme_tax_id]" class="form-control select2 input-sm purchase_scheme_tax_id" placeholder="'Please Select'">
                    <option value="" data-tax_amount="0" data-tax_type="fixed" <?php if( $hide_tax == 'hide' ): ?> selected <?php endif; ?>><?php echo app('translator')->get('lang_v1.none'); ?></option>
                    <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tax->id, false); ?>" data-tax_amount="<?php echo e($tax->amount, false); ?>" data-tax_type="<?php echo e($tax->type, false); ?>" <?php if( $scheme_tax_id == $tax->id && $hide_tax != 'hide'): ?> selected <?php endif; ?>><?php echo e($tax->name, false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <?php echo Form::hidden('purchases[' . $row_count . '][scheme_item_tax]', 0, ['class' => 'purchase_scheme_unit_tax']); ?>

            <small class="text-muted purchase_scheme_tax_total_text" style="display:block"><?php echo e(number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></small>
        </td>
        <?php endif; ?>
        <td class="text-end">
            <?php
                $pp_without_discount = !empty($purchase_order_line) ? $purchase_order_line->pp_without_discount/$purchase_order->exchange_rate : $variation->default_purchase_price;

                $discount_percent = !empty($purchase_order_line) ? $purchase_order_line->discount_percent : 0;
                $discount_type = !empty($purchase_order_line) || $purchase_order_line->discount_type != null ? $purchase_order_line->discount_type : $common_settings['default_inline_discount_type_purchase'];
                $total_discount_amount = !empty($purchase_order_line) ? $purchase_order_line->total_discount_amount : 0;
                $total_discount_type = (!empty($purchase_order_line) && $purchase_order_line->total_discount_type != null) ? $purchase_order_line->total_discount_type : ($common_settings['default_inline_total_discount_type_purchase'] ?? 'fixed');
                $discount2_percent = !empty($purchase_order_line) ? $purchase_order_line->discount2_percent : 0;
                $discount2_type = !empty($purchase_order_line) || $purchase_order_line->discount2_type != null ? $purchase_order_line->discount2_type : $common_settings['default_inline_discount2_type_purchase'];
                $total_discount2_amount = !empty($purchase_order_line) ? $purchase_order_line->total_discount2_amount : 0;
                $total_discount2_type = (!empty($purchase_order_line) && $purchase_order_line->total_discount2_type != null) ? $purchase_order_line->total_discount2_type : ($common_settings['default_inline_total_discount2_type_purchase'] ?? 'fixed');

                $purchase_price = !empty($purchase_order_line) ? $purchase_order_line->purchase_price/$purchase_order->exchange_rate : $variation->default_purchase_price;

                $tax_id = !empty($purchase_order_line) ? $purchase_order_line->tax_id : $product->tax;

                $tax_id = !empty($imported_data['tax_id']) ? $imported_data['tax_id'] : $tax_id;

                $pp_without_discount = !empty($imported_data['unit_cost_before_discount']) ? $imported_data['unit_cost_before_discount'] : $pp_without_discount;

                $discount_percent = !empty($imported_data['discount_percent']) ? $imported_data['discount_percent'] : $discount_percent;
                $discount_type = !empty($imported_data['discount_type']) ? $imported_data['discount_type'] : $discount_type;
                $total_discount_amount = !empty($imported_data['total_discount_amount']) ? $imported_data['total_discount_amount'] : $total_discount_amount;
                $total_discount_type = !empty($imported_data['total_discount_type']) ? $imported_data['total_discount_type'] : $total_discount_type;
                $discount2_percent = !empty($imported_data['discount2_percent']) ? $imported_data['discount2_percent'] : $discount2_percent;
                $discount2_type = !empty($imported_data['discount2_type']) ? $imported_data['discount2_type'] : $discount2_type;
                $total_discount2_amount = !empty($imported_data['total_discount2_amount']) ? $imported_data['total_discount2_amount'] : $total_discount2_amount;
                $total_discount2_type = !empty($imported_data['total_discount2_type']) ? $imported_data['total_discount2_type'] : $total_discount2_type;
            ?>
            <?php echo Form::text('purchases[' . $row_count . '][pp_without_discount]', number_format($pp_without_discount, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator), ['class' => 'form-control input-sm purchase_unit_cost_without_discount input_number input_cost', 'required']); ?>

            <?php if(!empty($last_purchase_line)): ?>
                <br>
                <small class="text-muted"><?php echo app('translator')->get('lang_v1.prev_unit_price'); ?>: <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $last_purchase_line->pp_without_discount, session("business.cost_decimal", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);
            echo $formated_number; ?></small>
            <?php endif; ?>
        </td>
        <?php 
        $hide_discount = '';
        if(empty($common_settings['enable_inline_discount_purchase'])){
				$hide_discount = 'hide';
		}
        $hide_total_discount = '';
        if(empty($common_settings['enable_inline_total_discount_purchase'])){
				$hide_total_discount = 'hide';
		}
        $hide_total_discount2 = '';
        if(empty($common_settings['enable_inline_total_discount2_purchase'])){
				$hide_total_discount2 = 'hide';
		}
        $hide_discounted_cost = '';
        if(empty($common_settings['enable_inline_discount_purchase']) && empty($common_settings['enable_inline_total_discount_purchase']) && empty($common_settings['enable_inline_total_discount2_purchase'])){
				$hide_discounted_cost = 'hide';
		}
        ?>
        <td class="<?php echo e($hide_discount, false); ?>">
            <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
            <div class="multi-input input-number">
            <?php endif; ?>
            <?php echo Form::text('purchases[' . $row_count . '][discount_percent]', number_format($discount_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']),
             ['class' => 'form-control input-sm inline_discounts input_number', 'required']); ?>

            <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
            <?php echo Form::select("purchases[$row_count][discount_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $discount_type , ['class' => 'form-control input-sm inline_discount_type inline-select']); ?>

            <?php else: ?>
            <br>
            <?php echo Form::select("purchases[$row_count][discount_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $discount_type , ['class' => 'form-control input-sm inline_discount_type']); ?>

            <?php endif; ?>
            <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
            </div>
            <?php endif; ?>
            <?php if(!empty($last_purchase_line)): ?>
                <br>
                <small class="text-muted">
                    <?php echo app('translator')->get('lang_v1.prev_discount'); ?>: 
                    <?php if($last_purchase_line->discount_type == 'fixed'): ?> Rs. <?php endif; ?>
                    <?php echo e(number_format($last_purchase_line->discount_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                    <?php if($last_purchase_line->discount_type == 'percentage'): ?> % <?php endif; ?>
                </small>
            <?php endif; ?>
        </td>
        <td class="<?php echo e($hide_total_discount, false); ?>">
            <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
            <div class="multi-input input-number">
            <?php endif; ?>
            <?php echo Form::text('purchases[' . $row_count . '][total_discount_amount]', number_format($total_discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']),
             ['class' => 'form-control input-sm inline_total_discounts input_number', 'required']); ?>

            <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
            <?php echo Form::select("purchases[$row_count][total_discount_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $total_discount_type , ['class' => 'form-control input-sm inline_total_discount_type inline-select']); ?>

            <?php else: ?>
            <br>
            <?php echo Form::select("purchases[$row_count][total_discount_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $total_discount_type , ['class' => 'form-control input-sm inline_total_discount_type']); ?>

            <?php endif; ?>
            <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
            </div>
            <?php endif; ?>
        </td>
        <?php 
        $hide_discount2 = '';
        if(empty($common_settings['enable_inline_discount2_purchase'])){
				$hide_discount2 = 'hide';
		}
        ?>
        <td class="<?php echo e($hide_discount2, false); ?>">
            <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
            <div class="multi-input input-number">
            <?php endif; ?>
            <?php echo Form::text('purchases[' . $row_count . '][discount2_percent]', number_format($discount2_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']),
             ['class' => 'form-control input-sm inline_discounts2 input_number', 'required']); ?>

            <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
            <?php echo Form::select("purchases[$row_count][discount2_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], 
                $discount2_type , ['class' => 'form-control input-sm inline_discount2_type inline-select']); ?>

            <?php else: ?>
            <br>
            <?php echo Form::select("purchases[$row_count][discount2_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], 
                $discount2_type , ['class' => 'form-control input-sm inline_discount2_type']); ?>

            <?php endif; ?>
            <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
            </div>
            <?php endif; ?>
            <?php if(!empty($last_purchase_line)): ?>
                <br>
                <small class="text-muted">
                    <?php echo app('translator')->get('lang_v1.prev_discount'); ?>: 
                    <?php if($last_purchase_line->discount2_type == 'fixed'): ?> Rs. <?php endif; ?>
                    <?php echo e(number_format($last_purchase_line->discount2_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                    <?php if($last_purchase_line->discount2_type == 'percentage'): ?> % <?php endif; ?>
                </small>
            <?php endif; ?>
        </td>
        <td class="<?php echo e($hide_total_discount2, false); ?>">
            <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
            <div class="multi-input input-number">
            <?php endif; ?>
            <?php echo Form::text('purchases[' . $row_count . '][total_discount2_amount]', number_format($total_discount2_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']),
             ['class' => 'form-control input-sm inline_total_discounts2 input_number', 'required']); ?>

            <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
            <?php echo Form::select("purchases[$row_count][total_discount2_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $total_discount2_type , ['class' => 'form-control input-sm inline_total_discount2_type inline-select']); ?>

            <?php else: ?>
            <br>
            <?php echo Form::select("purchases[$row_count][total_discount2_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $total_discount2_type , ['class' => 'form-control input-sm inline_total_discount2_type']); ?>

            <?php endif; ?>
            <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
            </div>
            <?php endif; ?>
        </td>
        <td class="text-end <?php echo e($hide_discounted_cost, false); ?>">
            <?php echo Form::text('purchases[' . $row_count . '][purchase_price]',
            number_format($purchase_price, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator), ['class' => 'form-control input-sm purchase_unit_cost input_number input_cost', 'required']); ?>

        </td>
        <?php 
        $hide_tax = '';
        if(empty($common_settings['enable_inline_tax_purchase']) || $taxes->isEmpty()){
				$hide_tax = 'hide';
		}
        $tax_type_group_name = !empty($mrp_group->name) ? $mrp_group->name : __('lang_v1.group_price');
        $product_tax_type_labels = [
            'inclusive' => __('product.inclusive'),
            'inclusive_sell_price' => __('product.inclusive_sell_price'),
            'inclusive_gp_price' => __('product.inclusive_on') . ' ' . $tax_type_group_name,
            'exclusive' => __('product.exclusive'),
            'none' => 'None',
        ];
        $product_tax_type_label = $product_tax_type_labels[$product->tax_type] ?? ($product->tax_type ?: 'None');
        $product_tax_type_tooltip = __('product.selling_price_tax_type') . ': ' . $product_tax_type_label;
        ?>
        <td class="text-end <?php echo e($hide_tax, false); ?>">
            <span class="row_subtotal_before_tax display_currency">0</span>
            <input type="hidden" class="row_subtotal_before_tax_hidden" value=0>
            <input type="hidden" class="product_tax_type" value="<?php echo e($product->tax_type, false); ?>">
        </td>
        <td class="<?php echo e($hide_tax, false); ?> purchase-tax-type-tooltip" title="<?php echo e($product_tax_type_tooltip, false); ?>" data-tax-type-title="<?php echo e($product_tax_type_tooltip, false); ?>">
            <div class="input-group" title="<?php echo e($product_tax_type_tooltip, false); ?>">
                <select name="purchases[<?php echo e($row_count, false); ?>][purchase_line_tax_id]" class="form-control select2 input-sm purchase_line_tax_id" placeholder="'Please Select'" title="<?php echo e($product_tax_type_tooltip, false); ?>">
                    <option value="" data-tax_amount="0" <?php if( $hide_tax == 'hide' ): ?>
                    selected <?php endif; ?> ><?php echo app('translator')->get('lang_v1.none'); ?></option>
                    <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tax->id, false); ?>" data-tax_amount="<?php echo e($tax->amount, false); ?>" data-tax_type="<?php echo e($tax->type, false); ?>" <?php if( $tax_id == $tax->id && $hide_tax != 'hide'): ?> selected <?php endif; ?> ><?php echo e($tax->name, false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <?php echo Form::hidden('purchases[' . $row_count . '][item_tax]', 0, ['class' => 'purchase_product_unit_tax']); ?>

        </td>
        <td class="text-end <?php echo e($hide_tax, false); ?>">
            <span class="purchase_product_unit_tax_text" style="display: block"><?php echo e(number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
            <span class="purchase_product_unit_total_tax_text" style="display: block"><?php echo e(number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
        </td>
        <td class="text-end <?php echo e($hide_tax, false); ?>">
            <?php
                $dpp_inc_tax = number_format($variation->dpp_inc_tax, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator);
                if($hide_tax == 'hide'){
                    $dpp_inc_tax = number_format($variation->default_purchase_price, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator);
                }

                $dpp_inc_tax = !empty($purchase_order_line) ? number_format($purchase_order_line->purchase_price_inc_tax/$purchase_order->exchange_rate, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator) : $dpp_inc_tax;

            ?>
            <?php echo Form::text('purchases[' . $row_count . '][purchase_price_inc_tax]', $dpp_inc_tax, ['class' => 'form-control input-sm purchase_unit_cost_after_tax input_number input_cost', 'required']); ?>

        </td>
        <td class="text-end">
            
            <input type="text" class="form-control input-sm row_subtotal_after_tax input_number" value="<?php echo e(number_format((float)$dpp_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
		    <input type="hidden" class="row_subtotal_after_tax_hidden" value="">
        </td>
        <td class="<?php if(!session('business.enable_editing_product_from_purchase') || !empty($is_purchase_order)): ?> hide <?php endif; ?>">
            <?php echo Form::text('purchases[' . $row_count . '][profit_percent]', number_format($variation->profit_percent, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), 
            ['class' => 'form-control input-sm input_number profit_percent', 'required',
                'data-rule-min-value' => 0,
                'data-msg-min-value' => 'Gross Profit is Less Than 0'
            ]); ?>

        </td>
        <?php if(empty($is_purchase_order)): ?>
        <?php if(session('business.enable_editing_product_from_purchase')): ?>
        <td class="text-end">
            <?php if(session('business.enable_editing_product_from_purchase')): ?>
                <?php echo Form::text('purchases[' . $row_count . '][default_sell_price]', number_format($variation->sell_price_inc_tax, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), ['class' => 'form-control input-sm input_number default_sell_price', 'required']); ?>

            <?php else: ?>
                <?php echo e(number_format($variation->sell_price_inc_tax, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), false); ?>

            <?php endif; ?>
        </td>
        <?php if(session('business.enable_sub_units')): ?>
            <td class="text-end">
                <?php echo Form::text('purchases[' . $row_count . '][pack_sell_price]', number_format($variation->sell_price_inc_tax * $selected_sub_unit_multiplier, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), ['class' => 'form-control input-sm input_number pack_sell_price', 'required', 'readonly']); ?>

            </td>
        <?php endif; ?>
        <?php if(!empty($mrp_group)): ?>
        <td class="text-end">
            <?php
                $mrp_price = \App\VariationGroupPrice::where('variation_id', $variation->id)->where('price_group_id', $mrp_group->id)->value('price_inc_tax');
                $mrp_price_val = !empty($mrp_price) ? $mrp_price : $variation->sell_price_inc_tax;
            ?>
            <?php if(session('business.enable_editing_product_from_purchase')): ?>
                <?php echo Form::text('purchases[' . $row_count . '][mrp_price]', number_format($mrp_price_val, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), ['class' => 'form-control input-sm input_number mrp_price', 'required']); ?>

            <?php else: ?>
                <?php echo e(number_format($mrp_price_val, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), false); ?>

            <?php endif; ?>
        </td>
        <?php endif; ?>
        <?php endif; ?>
        <?php if(session('business.enable_lot_number') || session('business.enable_product_expiry')): ?>
            <?php
                $lot_number = !empty($imported_data['lot_number']) ? $imported_data['lot_number'] : null;
            ?>
            <td>
                <?php if(session('business.enable_lot_number')): ?>
                <?php echo Form::text('purchases[' . $row_count . '][lot_number]', $lot_number, ['class' => 'form-control input-sm']); ?>

                <?php endif; ?>
                <?php if(session('business.enable_product_expiry')): ?>

                
                <?php
                    $expiry_period_type = !empty($product->expiry_period_type) ? $product->expiry_period_type : 'month';
                ?>
                <?php if(!empty($expiry_period_type)): ?>
                <input type="hidden" class="row_product_expiry" value="<?php echo e($product->expiry_period, false); ?>">
                <input type="hidden" class="row_product_expiry_type" value="<?php echo e($expiry_period_type, false); ?>">

                <?php if(session('business.expiry_type') == 'add_manufacturing'): ?>
                    <?php
                        $hide_mfg = false;
                    ?>
                <?php else: ?>
                    <?php
                        $hide_mfg = true;
                    ?>
                <?php endif; ?>

                <?php
                    $mfg_date = !empty($imported_data['mfg_date']) ? $imported_data['mfg_date'] : null;
                    $exp_date = !empty($imported_data['exp_date']) ? $imported_data['exp_date'] : null;
                ?>

                <b class="<?php if($hide_mfg): ?> hide <?php endif; ?>"><small><?php echo app('translator')->get('product.mfg_date'); ?>:</small></b>
                <div class="input-group <?php if($hide_mfg): ?> hide <?php endif; ?>">
                    
                    <?php echo Form::text('purchases[' . $row_count . '][mfg_date]', $mfg_date, ['class' => 'form-control input-sm expiry_datepicker mfg_date', 'readonly']); ?>

                </div>
                <b><small><?php echo app('translator')->get('product.exp_date'); ?>:</small></b>
                <div class="input-group">
                    
                    <?php echo Form::text('purchases[' . $row_count . '][exp_date]', $exp_date, ['class' => 'form-control input-sm expiry_datepicker exp_date', 'readonly']); ?>

                </div>
                <?php else: ?>
                <div class="text-center">
                    <?php echo app('translator')->get('product.not_applicable'); ?>
                </div>
                <?php endif; ?>
            </td>
        <?php endif; ?>
        <?php endif; ?>
        
        <?php endif; ?>
        <?php $row_count++ ;?>

        <td><i class="fa fa-times remove_purchase_entry_row text-danger" title="Remove" style="cursor:pointer;"></i></td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<input type="hidden" id="row_count" value="<?php echo e($row_count, false); ?>">
