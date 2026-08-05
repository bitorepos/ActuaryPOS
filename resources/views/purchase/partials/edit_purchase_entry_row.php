<?php
    $currency_precision = session('business.currency_precision', 2);
    $cost_decimal = session('business.cost_decimal', 2);
    $quantity_precision = session('business.quantity_precision', 2);
    $hide_tax = '';
    if( session()->get('business.enable_inline_tax') == 0){
        $hide_tax = 'hide';
    }
    $hide_scheme_qty = '';
    if (empty($common_settings['enable_scheme_quantity_purchase'])) {
        $hide_scheme_qty = 'hide';
    }
    $hide_discount = '';
    if (empty($common_settings['enable_inline_discount_purchase'])) {
        $hide_discount = 'hide';
    }
    $hide_total_discount = '';
    if (empty($common_settings['enable_inline_total_discount_purchase'])) {
        $hide_total_discount = 'hide';
    }
    $hide_discount2 = '';
    if (empty($common_settings['enable_inline_discount2_purchase'])) {
        $hide_discount2 = 'hide';
    }
    $hide_total_discount2 = '';
    if (empty($common_settings['enable_inline_total_discount2_purchase'])) {
        $hide_total_discount2 = 'hide';
    }
    $hide_discounted_cost = '';
    if (empty($common_settings['enable_inline_discount_purchase']) && empty($common_settings['enable_inline_total_discount_purchase']) && empty($common_settings['enable_inline_total_discount2_purchase'])) {
        $hide_discounted_cost = 'hide';
    }
    $hide_tax = '';
    if (empty($common_settings['enable_inline_tax_purchase']) || $taxes->isEmpty()) {
        $hide_tax = 'hide';
    }
    if (empty($common_settings['enable_serial_number'])) {
        $hide_sr_imei = 'hide';
    }
    $hide_brand = '';
    if (empty($user_settings['purchase_show_brand_column'])) {
        $hide_brand = 'hide';
    }
    $hide_category = '';
    if (empty($user_settings['purchase_show_category_column'])) {
        $hide_category = 'hide';
    }
?>
<div class="col-sm-12">
<div class="sell_product_div">
    <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
<table class="table table-condensed table-bordered table-th-skin table-striped" 
    id="purchase_entry_table">
    <thead>
        <tr>
          <th class="text-nowrap" style="width:1%; min-width:30px">#</th>
          <th class="text-nowrap" style="width:1%; min-width:50px">SKU</th>
          <th class="text-nowrap" style="width:100%">Product</th>
          <th class="text-nowrap <?php echo e($hide_brand, false); ?>">Brand</th>
          <th class="text-nowrap <?php echo e($hide_category, false); ?>">Category</th>
          <th class="text-nowrap <?php echo e($hide_sr_imei, false); ?>">Serial / IMEI</th>
          <th class="text-nowrap" style="width:auto"><?php if(empty($is_purchase_order)): ?> Qty <?php else: ?> Order Qty <?php endif; ?></th>
          <th class="text-nowrap <?php echo e($hide_scheme_qty, false); ?>" style="width:auto">Scheme <br> Qty</th>
          <th class="text-nowrap <?php echo e($hide_scheme_qty, false); ?> <?php echo e($hide_tax, false); ?>" id="purchase_scheme_tax_heading">Tax</th>
          <th class="text-nowrap text-end">Unit Cost<br><span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
          <th class="text-nowrap <?php echo e($hide_discount, false); ?>" id="purchase_discount_heading">Unit <br> Discount</th>
          <th class="text-nowrap <?php echo e($hide_total_discount, false); ?>" id="purchase_total_discount_heading">Total <br> Discount</th>
          <th class="text-nowrap <?php echo e($hide_discount2, false); ?>" id="purchase_discount2_heading">Discount 2</th>
          <th class="text-nowrap <?php echo e($hide_total_discount2, false); ?>" id="purchase_total_discount2_heading">Total <br> Discount 2</th>
          <th class="text-nowrap text-end <?php echo e($hide_discounted_cost, false); ?>">Discounted <br> Cost <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
          <th class="text-nowrap text-end <?php echo e($hide_tax, false); ?>">Subtotal<br><span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
          <th class="text-nowrap <?php echo e($hide_tax, false); ?>" id="purchase_tax_heading">Tax</th>
          <th class="text-nowrap text-end <?php echo e($hide_tax, false); ?>">Tax Amount<br>Line Total</th>
          <th class="text-nowrap text-end <?php echo e($hide_tax, false); ?>">Cost Inc. <br> Tax <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
          <th class="text-nowrap text-end">Line Total<br><span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
          <th class="text-nowrap <?php if(!session('business.enable_editing_product_from_purchase') || !empty($is_purchase_order)): ?> hide <?php endif; ?>">
              GP %
          </th>
          <?php if(empty($is_purchase_order)): ?>
              <th class="text-nowrap text-end <?php if(!session('business.enable_editing_product_from_purchase')): ?> hide <?php endif; ?>"><?php echo app('translator')->get( 'purchase.unit_selling_price'); ?><br><small>(<?php echo app('translator')->get('product.inc_of_tax'); ?>)</small> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
              <th class="text-nowrap text-end <?php if(!session('business.enable_editing_product_from_purchase') || !session('business.enable_sub_units')): ?> hide <?php endif; ?>">Pack Price<br><small>(<?php echo app('translator')->get('product.inc_of_tax'); ?>)</small> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
              <?php if(!empty($mrp_group)): ?>
                  <th class="text-nowrap text-end <?php if(!session('business.enable_editing_product_from_purchase')): ?> hide <?php endif; ?>"><?php echo e($mrp_group->name, false); ?><br><small>(<?php echo app('translator')->get('product.inc_of_tax'); ?>)</small> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
              <?php endif; ?>
              <?php if(session('business.enable_lot_number') || session('business.enable_product_expiry')): ?>
                <th class="text-nowrap">
                    <?php if(session('business.enable_lot_number')): ?>
                    <?php if(!empty($common_settings['lot_number_label'])): ?> <?php echo e($common_settings['lot_number_label'], false); ?> <?php else: ?> Lot <br> Number <?php endif; ?>
                    <?php endif; ?>
                    <?php if(session('business.enable_product_expiry')): ?>
                    <?php echo app('translator')->get('product.mfg_date'); ?> / <?php echo app('translator')->get('product.exp_date'); ?>
                    <?php endif; ?>
                </th>
                <?php endif; ?>
          <?php endif; ?>
          <th class="text-nowrap" style="width:1%; min-width:30px">
              <i class="fa fa-trash" aria-hidden="true"></i>
          </th>
        </tr>
  </thead>
        <tbody>
    <?php 
        $row_count = 0;
    ?>
    <?php $__currentLoopData = $purchase->purchase_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            if(!empty($purchase_line->variations->variation_sub_unit_id) && !empty($purchase_line->sub_units_options)){
                $variation_sub_unit_id = $purchase_line->variations->variation_sub_unit_id;
                $first_key = array_key_first($purchase_line->sub_units_options);
                $purchase_line->sub_units_options = array_filter(
                    $purchase_line->sub_units_options,
                    function ($value, $key) use ($first_key, $variation_sub_unit_id) {
                        return $key === $first_key || $key === $variation_sub_unit_id;
                    },
                    ARRAY_FILTER_USE_BOTH
                );               
            }
        ?>
        <tr class="product_row" <?php if(!empty($purchase_line->purchase_order_line) && !empty($common_settings['enable_purchase_order'])): ?> data-purchase_order_id="<?php echo e($purchase_line->purchase_order_line->transaction_id, false); ?>" <?php endif; ?>  <?php if(!empty($purchase_line->purchase_requisition_line) && !empty($common_settings['enable_purchase_requisition'])): ?> data-purchase_requisition_id="<?php echo e($purchase_line->purchase_requisition_line->transaction_id, false); ?>" <?php endif; ?>>
            <td><span class="sr_number"></span></td>
            <td><?php echo e($purchase_line->variations->sub_sku, false); ?></td>
            <td>
                <?php echo e($purchase_line->product->name, false); ?>

                <?php if( $purchase_line->product->type == 'variable'): ?> 
                    <br/>(<b><?php echo e($purchase_line->variations->product_variation->name, false); ?></b> : <?php echo e($purchase_line->variations->name, false); ?>)
                <?php endif; ?>
                <?php if(!empty($common_settings['enable_inline_product_note_purchase'])): ?>
                <br>
                    <a href="javascript:void(0)" class="toggle-product-note" title="<?php echo app('translator')->get('lang_v1.product_note'); ?>">
                        <i class="fa <?php echo e(!empty($purchase_line->purchase_line_note) ? 'fa-minus-circle text-danger' : 'fa-plus-circle text-success', false); ?>"></i>
                        <small><?php echo app('translator')->get('lang_v1.product_note'); ?></small>
                    </a>
                    <div class="product-note-wrapper" style="<?php echo e(empty($purchase_line->purchase_line_note) ? 'display:none;' : '', false); ?>">
                        <textarea class="form-control" name="purchases[<?php echo e($row_count, false); ?>][purchase_line_note]" rows="2"><?php echo e($purchase_line->purchase_line_note, false); ?></textarea>
                    </div>
                <?php endif; ?>
                <?php if(!empty($common_settings['enable_purchase_rack_details'])): ?>
                    <?php if(session('business.enable_racks')): ?>
                    <?php echo Form::text('purchases[' . $row_count . '][product_racks_update]['.$purchase->location_id.'][rack]', !empty($purchase_line->rack_details['rack']) ? $purchase_line->rack_details['rack'] : $purchase_line->product_rack->rack, ['class' => 'form-control input-sm', 'placeholder' => 'Rack'] ); ?>       
                    <?php endif; ?>
                    <?php if(session('business.enable_row')): ?>
                    <?php echo Form::text('purchases[' . $row_count . '][product_racks_update]['.$purchase->location_id.'][row]', !empty($purchase_line->rack_details['rack']) ? $purchase_line->rack_details['rack'] : $purchase_line->product_rack->row, ['class' => 'form-control input-sm', 'placeholder' => 'Row'] ); ?>       
                    <?php endif; ?>
                    <?php if(session('business.enable_position')): ?>
                    <?php echo Form::text('purchases[' . $row_count . '][product_racks_update]['.$purchase->location_id.'][position]', !empty($purchase_line->rack_details['rack']) ? $purchase_line->rack_details['rack'] : $purchase_line->product_rack->position, ['class' => 'form-control input-sm', 'placeholder' => 'Position'] ); ?>       
                    <?php endif; ?>
                <?php endif; ?>
            </td>
            <td class="<?php echo e($hide_brand, false); ?>"><?php echo e($purchase_line->product->brand->name, false); ?></td>
            <td class="<?php echo e($hide_category, false); ?>"><?php echo e($purchase_line->product->category->name, false); ?></td>
            <?php if(!empty($common_settings['enable_serial_number'])): ?>
            <td>
                <?php if($purchase_line->product->enable_sr_no): ?>
                <?php echo Form::text('purchases[' . $row_count . '][serial_number]', $purchase_line->serial_number, ['class' => 'form-control input-sm serial_number', 
                'placeholder' => !empty($common_settings['serial_number_label']) ? $common_settings['serial_number_label']: 'Serial Number',
                !empty($common_settings['is_serial_number_required_purchase']) ? 'required' : '' ] ); ?>       
                <?php endif; ?>
                <?php if($purchase_line->product->enable_imei_no): ?>
                <?php if(!empty($common_settings['enable_imei_number'])): ?>
                    <?php if(!empty($common_settings['imei1_number_label'])): ?>
                        <?php echo Form::text('purchases[' . $row_count . '][imei][1]', $purchase_line->imei_numbers[1], 
                        ['class' => 'form-control input-sm imei_number', 'style' => 'margin-top: 5px;',
                        'placeholder' => !empty($common_settings['imei1_number_label']) ? $common_settings['imei1_number_label']: 'IMEI1',
                        !empty($common_settings['is_imei_number_required_purchase']) ? 'required' : '' ] ); ?>       
                    <?php endif; ?>
                    <?php if(!empty($common_settings['imei2_number_label'])): ?>
                        <?php echo Form::text('purchases[' . $row_count . '][imei][2]', $purchase_line->imei_numbers[2], 
                        ['class' => 'form-control input-sm imei_number', 'style' => 'margin-top: 5px;',
                        'placeholder' => !empty($common_settings['imei2_number_label']) ? $common_settings['imei2_number_label']: 'IMEI2',
                        !empty($common_settings['is_imei_number_required_purchase']) ? 'required' : '' ] ); ?>       
                    <?php endif; ?>
                    <?php if(!empty($common_settings['imei3_number_label'])): ?>
                        <?php echo Form::text('purchases[' . $row_count . '][imei][3]', $purchase_line->imei_numbers[3], 
                        ['class' => 'form-control input-sm imei_number', 'style' => 'margin-top: 5px;',
                        'placeholder' => !empty($common_settings['imei3_number_label']) ? $common_settings['imei1_number_label']: 'IMEI3',
                        !empty($common_settings['is_imei_number_required_purchase']) ? 'required' : '' ] ); ?>       
                    <?php endif; ?>
                    <?php if(!empty($common_settings['imei4_number_label'])): ?>
                        <?php echo Form::text('purchases[' . $row_count . '][imei][4]', $purchase_line->imei_numbers[4], 
                        ['class' => 'form-control input-sm imei_number', 'style' => 'margin-top: 5px;',
                        'placeholder' => !empty($common_settings['imei4_number_label']) ? $common_settings['imei4_number_label']: 'IMEI4',
                        !empty($common_settings['is_imei_number_required_purchase']) ? 'required' : '' ] ); ?>       
                    <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>
            </td>
            <?php endif; ?>

            <td>
                <?php if(!empty($purchase_line->purchase_order_line_id) && !empty($common_settings['enable_purchase_order'])): ?>
                    <?php echo Form::hidden('purchases[' . $loop->index . '][purchase_order_line_id]', $purchase_line->purchase_order_line_id ); ?>

                <?php endif; ?>

                <?php if(!empty($purchase_line->purchase_requisition_line_id) && !empty($common_settings['enable_purchase_requisition'])): ?>
                    <?php echo Form::hidden('purchases[' . $loop->index . '][purchase_requisition_line_id]', $purchase_line->purchase_requisition_line_id ); ?>

                <?php endif; ?>

                <?php echo Form::hidden('purchases[' . $loop->index . '][product_id]', $purchase_line->product_id ); ?>

                <?php echo Form::hidden('purchases[' . $loop->index . '][variation_id]', $purchase_line->variation_id, ['class' => 'hidden_variation_id'] ); ?>

                <?php echo Form::hidden('purchases[' . $loop->index . '][purchase_line_id]',$purchase_line->id, ['class' => 'hidden_purchase_line_id']); ?>


                <?php
                    $check_decimal = 'false';
                    if($purchase_line->product->unit->allow_decimal == 0){
                        $check_decimal = 'true';
                    }
                    $max_quantity = 0;

                    // if(!empty($purchase_line->purchase_order_line_id) && !empty($common_settings['enable_purchase_order'])){
                    //     $max_quantity = $purchase_line->purchase_order_line->quantity - $purchase_line->purchase_order_line->po_quantity_purchased + $purchase_line->quantity;
                    // }
                    
                    $min_quantity = 0;
                    // if(!empty($purchase_line->quantity)){
                    //     $min_quantity = $purchase_line->quantity_sold + $purchase_line->quantity_adjusted + $purchase_line->po_quantity_purchased + $purchase_line->mfg_quantity_used;
                    // }
                    $min_quantity_uf = $min_quantity;
                    $unit_multiplier = 1;
                    if(!empty($purchase_line->sub_units_options[$purchase_line->sub_unit_id]['multiplier'])){
                        $unit_multiplier = $purchase_line->sub_units_options[$purchase_line->sub_unit_id]['multiplier'];
                    }
                    $min_quantity = $min_quantity / $unit_multiplier;
                    
                    $disable_qty = !empty($purchase_line->product->enable_sr_no) ? true : false;
                ?>

                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                <div class="multi-input input-number">
                <?php endif; ?>

                <input type="text" 
                    name="purchases[<?php echo e($loop->index, false); ?>][quantity]" 
                    value="<?php echo e(number_format($purchase_line->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>"
                    class="form-control input-sm purchase_quantity input_number mousetrap"
                    required
                    data-rule-abs_digit=<?php echo e($check_decimal, false); ?>

                    data-msg-abs_digit="<?php echo e(__('lang_v1.decimal_value_not_allowed'), false); ?>"
                    <?php if(!empty($max_quantity)): ?>
                        data-rule-max-value="<?php echo e($max_quantity, false); ?>"
                        data-msg-max-value="<?php echo e(__('lang_v1.max_quantity_quantity_allowed', ['quantity' => $max_quantity]), false); ?>" 
                    <?php endif; ?>
                    
                    <?php if(!empty($min_quantity)): ?>
                        data-rule-min-value="<?php echo e($min_quantity, false); ?>"
                        data-msg-min-value="<?php echo e(__('lang_v1.min_quantity_sold_allowed', ['quantity' => $min_quantity]), false); ?>" 
                    <?php endif; ?>
                    <?php if($disable_qty): ?> readonly <?php endif; ?>
                >
                <input type="hidden" class="min_quantity_uf" value="<?php echo e($min_quantity_uf, false); ?>">
                <input type="hidden" class="base_unit_cost" value="<?php echo e($purchase_line->variation->default_purchase_price ?? $purchase_line->pp_without_discount / $unit_multiplier, false); ?>">
                <?php if(!empty($purchase_line->sub_units_options)): ?>
                    <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                    <select name="purchases[<?php echo e($loop->index, false); ?>][sub_unit_id]" class="form-control input-sm sub_unit inline-select" <?php if($disable_qty): ?> style="pointer-events: none;background-color:#F5F5F5;" <?php endif; ?>>
                        <?php $__currentLoopData = $purchase_line->sub_units_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_units_key => $sub_units_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sub_units_key, false); ?>" 
                                data-multiplier="<?php echo e($sub_units_value['multiplier'], false); ?>"
                                <?php if($sub_units_key == $purchase_line->sub_unit_id): ?> selected <?php endif; ?>>
                                <?php echo e($sub_units_value['short_name'] ?? $sub_units_value['name'], false); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php else: ?>
                    <br>
                    <select name="purchases[<?php echo e($loop->index, false); ?>][sub_unit_id]" class="form-control input-sm sub_unit" <?php if($disable_qty): ?> style="pointer-events: none;background-color:#F5F5F5;" <?php endif; ?>>
                        <?php $__currentLoopData = $purchase_line->sub_units_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_units_key => $sub_units_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sub_units_key, false); ?>" 
                                data-multiplier="<?php echo e($sub_units_value['multiplier'], false); ?>"
                                <?php if($sub_units_key == $purchase_line->sub_unit_id): ?> selected <?php endif; ?>>
                                <?php echo e($sub_units_value['name'], false); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php endif; ?>
                <?php else: ?>
                    <?php echo e($purchase_line->product->unit->short_name, false); ?>

                <?php endif; ?>

                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                </div>
                <?php endif; ?>

                <input type="hidden" name="purchases[<?php echo e($loop->index, false); ?>][product_unit_id]" value="<?php echo e($purchase_line->product->unit->id, false); ?>">

                <input type="hidden" class="base_unit_selling_price" value="<?php echo e($purchase_line->variations->sell_price_inc_tax ?? $purchase_line->purchase_price_inc_tax / $unit_multiplier, false); ?>">

                <?php if(!empty($purchase_line->product->second_unit)): ?>
                    <br><br>
                    <span style="white-space: nowrap;">
                    <?php echo app('translator')->get('lang_v1.quantity_in_second_unit', ['unit' => $purchase_line->product->second_unit->short_name]); ?>*:</span><br>
                    <input type="text" 
                    name="purchases[<?php echo e($row_count, false); ?>][secondary_unit_quantity]" 
                    value="<?php echo e(number_format($purchase_line->secondary_unit_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>"
                    class="form-control input-sm input_number"
                    required>
                <?php endif; ?>
            </td>
            <td class="<?php echo e($hide_scheme_qty, false); ?>">
                <?php
                    $check_decimal = 'false';
                    if($purchase_line->product->unit->allow_decimal == 0){
                        $check_decimal = 'true';
                    }
                    $max_foc_quantity = 0;

                    // if(!empty($purchase_line->purchase_order_line_id) && !empty($common_settings['enable_purchase_order'])){
                    //     $max_foc_quantity = $purchase_line->purchase_order_line->quantity - $purchase_line->purchase_order_line->po_quantity_purchased + $purchase_line->quantity;
                    // }
                    $min_foc_quantity = 0;
                    // if(!empty($purchase_line->quantity)){
                    //     $min_foc_quantity = $purchase_line->quantity_sold + $purchase_line->quantity_adjusted + $purchase_line->po_quantity_purchased + $purchase_line->mfg_quantity_used;
                    // }
                    $min_foc_quantity_uf = $min_foc_quantity;
                    // $unit_foc_multiplier = 1;
                    // if(!empty($purchase_line->sub_units_options[$purchase_line->foc_sub_unit_id]['multiplier'])){
                    //     $unit_foc_multiplier = $purchase_line->sub_units_options[$purchase_line->foc_sub_unit_id]['multiplier'];
                    // }
                    // $min_foc_quantity = $min_foc_quantity / $unit_foc_multiplier;
                    
                    $disable_qty = !empty($purchase_line->product->enable_sr_no) ? true : false;
                ?>

                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                <div class="multi-input input-number">
                <?php endif; ?>

                <input type="text" 
                    name="purchases[<?php echo e($loop->index, false); ?>][foc_quantity]" 
                    value="<?php echo e(number_format($purchase_line->foc_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>"
                    class="form-control input-sm purchase_foc_quantity input_number mousetrap"
                    required
                    data-rule-abs_digit=<?php echo e($check_decimal, false); ?>

                    data-msg-abs_digit="<?php echo e(__('lang_v1.decimal_value_not_allowed'), false); ?>"
                <?php if(!empty($max_foc_quantity)): ?>
                    data-rule-max-value="<?php echo e($max_foc_quantity, false); ?>"
                    data-msg-max-value="<?php echo e(__('lang_v1.max_quantity_quantity_allowed', ['quantity' => $max_foc_quantity]), false); ?>" 
                <?php endif; ?>
                
                <?php if(!empty($min_foc_quantity)): ?>
                    data-rule-min-value="<?php echo e($min_foc_quantity, false); ?>"
                    data-msg-min-value="<?php echo e(__('lang_v1.min_quantity_sold_allowed', ['quantity' => $min_foc_quantity]), false); ?>" 
                <?php endif; ?>
                <?php if($disable_qty): ?> readonly <?php endif; ?>
                >
                <input type="hidden" class="min_foc_quantity_uf" value="<?php echo e($min_foc_quantity_uf, false); ?>">
                <?php if(!empty($purchase_line->sub_units_options)): ?>
                    <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                    <select name="purchases[<?php echo e($loop->index, false); ?>][foc_sub_unit_id]" class="form-control input-sm foc_sub_unit inline-select" <?php if($disable_qty): ?> style="pointer-events: none;background-color:#F5F5F5;" <?php endif; ?>>
                        <?php $__currentLoopData = $purchase_line->sub_units_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_units_key => $sub_units_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sub_units_key, false); ?>" 
                                data-multiplier="<?php echo e($sub_units_value['multiplier'], false); ?>"
                                <?php if($sub_units_key == $purchase_line->foc_sub_unit_id): ?> selected <?php endif; ?>>
                                <?php echo e($sub_units_value['short_name'] ?? $sub_units_value['name'], false); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php else: ?>
                    <br>
                    <select name="purchases[<?php echo e($loop->index, false); ?>][foc_sub_unit_id]" class="form-control input-sm foc_sub_unit" <?php if($disable_qty): ?> style="pointer-events: none;background-color:#F5F5F5;" <?php endif; ?>>
                        <?php $__currentLoopData = $purchase_line->sub_units_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_units_key => $sub_units_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sub_units_key, false); ?>" 
                                data-multiplier="<?php echo e($sub_units_value['multiplier'], false); ?>"
                                <?php if($sub_units_key == $purchase_line->foc_sub_unit_id): ?> selected <?php endif; ?>>
                                <?php echo e($sub_units_value['name'], false); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php endif; ?>
                <?php else: ?>
                    <?php echo e($purchase_line->product->unit->short_name, false); ?>

                <?php endif; ?>

                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                </div>
                <?php endif; ?>
            </td>
            <td class="<?php echo e($hide_scheme_qty, false); ?> <?php echo e($hide_tax, false); ?>">
                <?php
                    $scheme_tax_id = $purchase_line->scheme_tax_id ?? $purchase_line->tax_id ?? null;
                ?>
                <div class="input-group">
                    <select name="purchases[<?php echo e($loop->index, false); ?>][scheme_tax_id]" class="form-control input-sm purchase_scheme_tax_id" placeholder="'Please Select'">
                        <option value="" data-tax_amount="0" data-tax_type="fixed" <?php if(empty($scheme_tax_id)): ?> selected <?php endif; ?>><?php echo app('translator')->get('lang_v1.none'); ?></option>
                        <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tax->id, false); ?>" data-tax_amount="<?php echo e($tax->amount, false); ?>" data-tax_type="<?php echo e($tax->type, false); ?>" <?php if($scheme_tax_id == $tax->id): ?> selected <?php endif; ?>><?php echo e($tax->name, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php echo Form::hidden('purchases[' . $loop->index . '][scheme_item_tax]', number_format(($purchase_line->scheme_item_tax ?? 0) / $purchase->exchange_rate, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator), ['class' => 'purchase_scheme_unit_tax']); ?>

                <small class="text-muted purchase_scheme_tax_total_text" style="display:block">
                    <?php echo e(number_format(($purchase_line->scheme_item_tax ?? 0) * $purchase_line->foc_quantity, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                </small>
            </td>
            <td class="text-end">
                <?php echo Form::text('purchases[' . $loop->index . '][pp_without_discount]', number_format($purchase_line->pp_without_discount/$purchase->exchange_rate, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator), ['class' => 'form-control input-sm purchase_unit_cost_without_discount input_number input_cost', 'required']); ?>

            </td>
            <?php
                if($purchase_line->discount_type == 'fixed'){
                    $purchase_line->discount_percent = $purchase_line->discount_percent / $purchase->exchange_rate;
                }
                if($purchase_line->total_discount_type == 'fixed'){
                    $purchase_line->total_discount_amount = $purchase_line->total_discount_amount / $purchase->exchange_rate;
                }
                if($purchase_line->discount2_type == 'fixed'){
                    $purchase_line->discount2_percent = $purchase_line->discount2_percent / $purchase->exchange_rate;
                }
                if($purchase_line->total_discount2_type == 'fixed'){
                    $purchase_line->total_discount2_amount = $purchase_line->total_discount2_amount / $purchase->exchange_rate;
                }
            ?>
            <td class="<?php echo e($hide_discount, false); ?>">
                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                <div class="multi-input input-number">
                <?php endif; ?>
                <?php echo Form::text('purchases[' . $loop->index . '][discount_percent]', number_format($purchase_line->discount_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm inline_discounts input_number', 'required']); ?>

                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                <?php echo Form::select("purchases[$row_count][discount_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $purchase_line->discount_type , ['class' => 'form-control input-sm inline_discount_type inline-select']); ?>

                <?php else: ?>
                <br>
                <?php echo Form::select("purchases[$row_count][discount_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $purchase_line->discount_type , ['class' => 'form-control inline_discount_type']); ?>

                <?php endif; ?>
                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                </div>
                <?php endif; ?>
            </td>
            <td class="<?php echo e($hide_total_discount, false); ?>">
                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                <div class="multi-input input-number">
                <?php endif; ?>
                <?php echo Form::text('purchases[' . $loop->index . '][total_discount_amount]', number_format($purchase_line->total_discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm inline_total_discounts input_number', 'required']); ?>

                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                <?php echo Form::select("purchases[$row_count][total_discount_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $purchase_line->total_discount_type ?? ($common_settings['default_inline_total_discount_type_purchase'] ?? 'fixed') , ['class' => 'form-control input-sm inline_total_discount_type inline-select']); ?>

                <?php else: ?>
                <br>
                <?php echo Form::select("purchases[$row_count][total_discount_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $purchase_line->total_discount_type ?? ($common_settings['default_inline_total_discount_type_purchase'] ?? 'fixed') , ['class' => 'form-control inline_total_discount_type']); ?>

                <?php endif; ?>
                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                </div>
                <?php endif; ?>
            </td>
            <td class="<?php echo e($hide_discount2, false); ?>">
                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                <div class="multi-input input-number">
                <?php endif; ?>
                <?php echo Form::text('purchases[' . $loop->index . '][discount2_percent]', number_format($purchase_line->discount2_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm inline_discounts2 input_number', 'required']); ?>

                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                <?php echo Form::select("purchases[$row_count][discount2_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $purchase_line->discount2_type , ['class' => 'form-control input-sm inline_discount2_type inline-select']); ?>

                <?php else: ?>
                <br>
                <?php echo Form::select("purchases[$row_count][discount2_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $purchase_line->discount2_type , ['class' => 'form-control inline_discount2_type']); ?>

                <?php endif; ?>
                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                </div>
                <?php endif; ?>
            </td>
            <td class="<?php echo e($hide_total_discount2, false); ?>">
                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                <div class="multi-input input-number">
                <?php endif; ?>
                <?php echo Form::text('purchases[' . $loop->index . '][total_discount2_amount]', number_format($purchase_line->total_discount2_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm inline_total_discounts2 input_number', 'required']); ?>

                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                <?php echo Form::select("purchases[$row_count][total_discount2_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $purchase_line->total_discount2_type ?? ($common_settings['default_inline_total_discount2_type_purchase'] ?? 'fixed') , ['class' => 'form-control input-sm inline_total_discount2_type inline-select']); ?>

                <?php else: ?>
                <br>
                <?php echo Form::select("purchases[$row_count][total_discount2_type]", ['fixed' => session('currency')['symbol'] ?? __('lang_v1.fixed'), 'percentage' => '%'], $purchase_line->total_discount2_type ?? ($common_settings['default_inline_total_discount2_type_purchase'] ?? 'fixed') , ['class' => 'form-control inline_total_discount2_type']); ?>

                <?php endif; ?>
                <?php if(!empty($common_settings['purchase_inline_ui_slim'])): ?>
                </div>
                <?php endif; ?>
            </td>
            <td class="text-end <?php echo e($hide_discounted_cost, false); ?>">
                <?php echo Form::text('purchases[' . $loop->index . '][purchase_price]', 
                number_format($purchase_line->purchase_price/$purchase->exchange_rate, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator), ['class' => 'form-control input-sm purchase_unit_cost input_number input_cost', 'required']); ?>

            </td>
            <td class="text-end <?php echo e($hide_tax, false); ?>">
                <span class="row_subtotal_before_tax">
                    <?php echo e(number_format($purchase_line->quantity * $purchase_line->purchase_price/$purchase->exchange_rate, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator), false); ?>

                </span>
                <input type="hidden" class="row_subtotal_before_tax_hidden" value="<?php echo e(number_format($purchase_line->quantity * $purchase_line->purchase_price/$purchase->exchange_rate, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator), false); ?>">
                <input type="hidden" class="product_tax_type" value="<?php echo e($purchase_line->product->tax_type, false); ?>">
            </td>

            <?php
                $tax_type_group_name = !empty($mrp_group->name) ? $mrp_group->name : __('lang_v1.group_price');
                $product_tax_type_labels = [
                    'inclusive' => __('product.inclusive'),
                    'inclusive_sell_price' => __('product.inclusive_sell_price'),
                    'inclusive_gp_price' => __('product.inclusive_on') . ' ' . $tax_type_group_name,
                    'exclusive' => __('product.exclusive'),
                    'none' => 'None',
                ];
                $product_tax_type_label = $product_tax_type_labels[$purchase_line->product->tax_type] ?? ($purchase_line->product->tax_type ?: 'None');
                $product_tax_type_tooltip = __('product.selling_price_tax_type') . ': ' . $product_tax_type_label;
            ?>
            <td class="<?php echo e($hide_tax, false); ?> purchase-tax-type-tooltip" title="<?php echo e($product_tax_type_tooltip, false); ?>" data-tax-type-title="<?php echo e($product_tax_type_tooltip, false); ?>">
                <div class="input-group" title="<?php echo e($product_tax_type_tooltip, false); ?>">
                    <select name="purchases[<?php echo e($loop->index, false); ?>][purchase_line_tax_id]" class="form-control input-sm purchase_line_tax_id" placeholder="'Please Select'" title="<?php echo e($product_tax_type_tooltip, false); ?>">
                        <option value="" data-tax_amount="0" <?php if( empty( $purchase_line->tax_id ) ): ?>
                        selected <?php endif; ?> ><?php echo app('translator')->get('lang_v1.none'); ?></option>
                        <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tax->id, false); ?>" data-tax_amount="<?php echo e($tax->amount, false); ?>"  data-tax_type="<?php echo e($tax->type, false); ?>" <?php if( $purchase_line->tax_id == $tax->id): ?> selected <?php endif; ?> ><?php echo e($tax->name, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php echo Form::hidden('purchases[' . $loop->index . '][item_tax]', number_format($purchase_line->item_tax/$purchase->exchange_rate, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator), ['class' => 'purchase_product_unit_tax']); ?>

            </td>
            <td class="text-end <?php echo e($hide_tax, false); ?>">
                <span class="purchase_product_unit_tax_text" style="display:block">
                    <?php echo e(number_format($purchase_line->item_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                </span>
                <span class="purchase_product_unit_total_tax_text" style="display:block"><?php echo e(number_format($purchase_line->item_tax * $purchase_line->quantity, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
            </td>
            <td class="text-end <?php echo e($hide_tax, false); ?>">
                <?php echo Form::text('purchases[' . $loop->index . '][purchase_price_inc_tax]', number_format($purchase_line->purchase_price_inc_tax/$purchase->exchange_rate, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator), ['class' => 'form-control input-sm purchase_unit_cost_after_tax input_number input_cost', 'required', 'readonly']); ?>

            </td>
            <td class="text-end">
                
                <input type="text" class="form-control input-sm row_subtotal_after_tax input_number input_cost" value="<?php echo e(number_format($purchase_line->purchase_price_inc_tax * $purchase_line->quantity/$purchase->exchange_rate, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator), false); ?>">
                <input type="hidden" class="row_subtotal_after_tax_hidden" value="<?php echo e(number_format($purchase_line->purchase_price_inc_tax * $purchase_line->quantity/$purchase->exchange_rate, $cost_decimal, $currency_details->decimal_separator, $currency_details->thousand_separator), false); ?>">
            </td>

            <td class="<?php if(!session('business.enable_editing_product_from_purchase') || !empty($is_purchase_order)): ?> hide <?php endif; ?>">
                <?php
                    $pp = $purchase_line->purchase_price_inc_tax;
                    $base_sp = $purchase_line->variations->sell_price_inc_tax;
                    $sp = $base_sp * $unit_multiplier;
                    if(!empty($purchase_line->sell_price) && $purchase_line->sell_price != 0){
                        $sp = $purchase_line->sell_price;
                        $base_sp = !empty($unit_multiplier) ? $sp / $unit_multiplier : $sp;
                    }
                    if($pp == 0){
                        $profit_percent = 100;
                    } elseif ($sp != 0) { 
                        $profit_percent = (($sp - $pp) / $sp) * 100;
                    } else {
                        $profit_percent = 0;
                    }
                ?>
                
                <?php echo Form::text('purchases[' . $loop->index . '][profit_percent]', 
                number_format($profit_percent, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), 
                ['class' => 'form-control input-sm input_number profit_percent', 'required',
                'data-rule-min-value' => 0,
                'data-msg-min-value' => 'Gross Profit is Less Than 0']); ?>

            </td>
            <?php if(empty($is_purchase_order)): ?>
            <td class="text-end <?php echo e(empty(session('business.enable_editing_product_from_purchase')) ? 'hide': '', false); ?>">
                <?php if(session('business.enable_editing_product_from_purchase')): ?>
                    <?php echo Form::text('purchases[' . $loop->index . '][default_sell_price]', number_format($base_sp, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), ['class' => 'form-control input-sm input_number default_sell_price', 'required']); ?>

                <?php else: ?>
                    <?php if(!empty($purchase_line->sell_price)): ?>
                    <?php echo Form::text('purchases[' . $loop->index . '][default_sell_price]', number_format($purchase_line->sell_price, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), ['class' => 'form-control input-sm input_number default_sell_price', 'required']); ?>

                    <?php endif; ?>
                    <?php echo e(number_format($sp, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), false); ?>

                <?php endif; ?>
            </td>
            <?php if(session('business.enable_editing_product_from_purchase') && session('business.enable_sub_units')): ?>
                <td class="text-end">
                    <?php echo Form::text('purchases[' . $loop->index . '][pack_sell_price]', number_format($sp, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), ['class' => 'form-control input-sm input_number pack_sell_price', 'required', 'readonly']); ?>

                </td>
            <?php endif; ?>
            <?php if(!empty($mrp_group)): ?>
            <td class="text-end <?php echo e(empty(session('business.enable_editing_product_from_purchase')) ? 'hide': '', false); ?>">
                <?php
                    $mrp_price = !empty($purchase_line->sell_group_price) && $purchase_line->sell_group_price != 0
                        ? $purchase_line->sell_group_price
                        : \App\VariationGroupPrice::where('variation_id', $purchase_line->variation_id)->where('price_group_id', $mrp_group->id)->value('price_inc_tax');
                    $mrp_price_val = !empty($mrp_price) ? $mrp_price : $purchase_line->variations->sell_price_inc_tax;
                ?>
                <?php if(session('business.enable_editing_product_from_purchase')): ?>
                    <?php echo Form::text('purchases[' . $loop->index . '][mrp_price]', number_format($mrp_price_val, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), ['class' => 'form-control input-sm input_number mrp_price', 'required']); ?>

                <?php else: ?>
                    <?php echo e(number_format($mrp_price_val, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), false); ?>

                <?php endif; ?>
            </td>
            <?php endif; ?>
            <?php endif; ?>
            <?php if(session('business.enable_lot_number') || session('business.enable_product_expiry')): ?>
                <td>
                    <?php if(session('business.enable_lot_number')): ?>
                    <?php echo Form::text('purchases[' . $loop->index . '][lot_number]', $purchase_line->lot_number, ['class' => 'form-control input-sm']); ?>

                    <?php endif; ?>
                    <?php if(session('business.enable_product_expiry')): ?>
                    <?php
                        $expiry_period_type = !empty($purchase_line->product->expiry_period_type) ? $purchase_line->product->expiry_period_type : 'month';
                    ?>
                    <?php if(!empty($expiry_period_type)): ?>
                    <input type="hidden" class="row_product_expiry" value="<?php echo e($purchase_line->product->expiry_period, false); ?>">
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

                    <b class="<?php if($hide_mfg): ?> hide <?php endif; ?>"><small><?php echo app('translator')->get('product.mfg_date'); ?>:</small></b>
                    <?php
                        $mfg_date = null;
                        $exp_date = null;
                        if(!empty($purchase_line->mfg_date)){
                            $mfg_date = $purchase_line->mfg_date;
                        }
                        if(!empty($purchase_line->exp_date)){
                            $exp_date = $purchase_line->exp_date;
                        }
                    ?>
                    <div class="input-group <?php if($hide_mfg): ?> hide <?php endif; ?>">
                        
                        <?php echo Form::text('purchases[' . $loop->index . '][mfg_date]', !empty($mfg_date) ? \Carbon::createFromTimestamp(strtotime($mfg_date))->format(session('business.date_format')) : null, ['class' => 'form-control input-sm expiry_datepicker mfg_date', 'readonly']); ?>

                    </div>
                    <b><small><?php echo app('translator')->get('product.exp_date'); ?>:</small></b>
                    <div class="input-group">
                        
                        <?php echo Form::text('purchases[' . $loop->index . '][exp_date]', !empty($exp_date) ? \Carbon::createFromTimestamp(strtotime($exp_date))->format(session('business.date_format')) : null, ['class' => 'form-control input-sm expiry_datepicker exp_date', 'readonly']); ?>

                    </div>
                    <?php else: ?>
                    <div class="text-center">
                        <?php echo app('translator')->get('product.not_applicable'); ?>
                    </div>
                    <?php endif; ?>
                
                <?php endif; ?>
                </td>
            <?php endif; ?>
            
            <td>
                <?php if(!empty($common_settings['bulk_add_serial_number_purchase'])): ?>
                    <?php if($purchase_line->quantity_sold == 0): ?>
                    <i class="fa fa-times remove_purchase_entry_row text-danger" title="Remove" style="cursor:pointer;"></i>    
                    <?php else: ?>
                    <i class="fa fa-times text-gray" title="Remove"></i>    
                    <?php endif; ?>
                <?php else: ?>
                <i class="fa fa-times remove_purchase_entry_row text-danger" title="Remove" style="cursor:pointer;"></i>
                <?php endif; ?>
                
            </td>
        </tr>
        <?php $row_count = $loop->index + 1 ; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
</div>
<input type="hidden" id="row_count" value="<?php echo e($row_count, false); ?>">
</div>
