
<?php $__env->startSection('title', __('lang_v1.purchase_return')); ?>

<?php $__env->startSection('content'); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo app('translator')->get('lang_v1.purchase_return'); ?> <i class="fa fa-keyboard-o hover-q text-muted" aria-hidden="true"
            style="cursor:pointer" onclick="$('#purchase_keyboard_shortcuts_modal').modal('show');"
            title="<?php echo app('translator')->get('lang_v1.purchase_show_shortcuts_help'); ?> (<?php echo e(!empty($shortcuts['purchase']['show_shortcuts_help']) ? strtoupper($shortcuts['purchase']['show_shortcuts_help']) : 'F7', false); ?>)"></i></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php echo Form::open([
            'url' => action([\App\Http\Controllers\PurchaseReturnController::class, 'store']),
            'method' => 'post',
            'id' => 'purchase_return_form',
        ]); ?>

        <?php echo Form::hidden('transaction_id', $purchase->id); ?>

        <?php echo Form::hidden('purchase_return_id', $purchase->return_parent->id, ['id'=>'purchase_return_id']); ?>

        <input type="hidden" id="page_type" value="purchase">

        <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.parent_purchase')]); ?>
            <div class="row">
                <div class="col-sm-4">
                    <strong><?php echo app('translator')->get('purchase.ref_no'); ?>:</strong> <?php echo e($purchase->ref_no, false); ?> <br>
                    <strong><?php echo app('translator')->get('messages.date'); ?>:</strong> <?php echo e(\Carbon::createFromTimestamp(strtotime($purchase->transaction_date))->format(session('business.date_format')), false); ?>

                </div>
                <div class="col-sm-4">
                    <strong><?php echo app('translator')->get('purchase.supplier'); ?>:</strong> <?php echo e($purchase->contact->name, false); ?> <br>
                    <strong><?php echo app('translator')->get('purchase.business_location'); ?>:</strong> <?php echo e($purchase->location->name, false); ?>

                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group mb-2">
                        <?php echo Form::label('ref_no', __('purchase.ref_no') . ':'); ?>

                        <?php echo Form::text('ref_no', !empty($purchase->return_parent->ref_no) ? $purchase->return_parent->ref_no : null, [
                            'class' => 'form-control',
                            empty($user_settings['enable_purchase_transaction_no']) ? 'readonly' : '',
                        ]); ?>

                        <b id="ref_no_error" class="error hide"><?php echo app('translator')->get('lang_v1.not_unique', ['name' => __('purchase.ref_no') ]); ?></b>
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="col-sm-12">
                    <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
<table class="table bg-gray" id="purchase_return_table">
                        <thead>
                            <tr class="bg-green">
                                <th class="text-nowrap" style="width:1%; min-width:30px">#</th>
                                <th class="text-nowrap" style="width:100%"><?php echo app('translator')->get('product.product_name'); ?></th>
                                <?php if(!empty($common_settings['enable_serial_number'])): ?>
                                <th class="text-nowrap"><?php echo app('translator')->get('product.sr_imei_no'); ?></th>
                                <?php endif; ?>
                                <th class="text-nowrap text-end"><?php echo app('translator')->get('sale.unit_price'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
                                <th class="text-nowrap"><?php echo app('translator')->get('purchase.purchase_quantity'); ?></th>
                                <th class="text-nowrap"><?php echo app('translator')->get('lang_v1.quantity_left'); ?></th>
                                <th class="text-nowrap"><?php echo app('translator')->get('lang_v1.return_quantity'); ?></th>
                                <th class="text-nowrap text-end"><?php echo app('translator')->get('lang_v1.return_subtotal'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $purchase->purchase_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $unit_name = $purchase_line->product->unit->short_name;
                                    
                                    $check_decimal = 'false';
                                    if ($purchase_line->product->unit->allow_decimal == 0) {
                                        $check_decimal = 'true';
                                    }
                                    
                                    if (!empty($purchase_line->sub_unit->base_unit_multiplier)) {
                                        $unit_name = $purchase_line->sub_unit->short_name;
                                    
                                        if ($purchase_line->sub_unit->allow_decimal == 0) {
                                            $check_decimal = 'true';
                                        } else {
                                            $check_decimal = 'false';
                                        }
                                    }
                                    
                                    $qty_available = $purchase_line->quantity - $purchase_line->quantity_sold - $purchase_line->quantity_adjusted;
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
                                    <?php if(!empty($common_settings['enable_serial_number'])): ?>
                                    <td><?php echo e($purchase_line->serial_number, false); ?></td>
                                    <?php endif; ?>
                                    <td class="text-end"><span class="display_currency"
                                            data-currency_symbol="false"><?php echo e($purchase_line->purchase_price_inc_tax, false); ?></span></td>
                                    <td><span class="display_currency" data-is_quantity="true"
                                            data-currency_symbol="false"><?php echo e($purchase_line->quantity, false); ?></span>
                                        <?php echo e($unit_name, false); ?></td>
                                    <td><span class="display_currency" data-currency_symbol="false"
                                            data-is_quantity="true"><?php echo e($qty_available, false); ?></span> <?php echo e($unit_name, false); ?></td>
                                    <td>
                                        <?php
                                            $check_decimal = 'false';
                                            if ($purchase_line->product->unit->allow_decimal == 0) {
                                                $check_decimal = 'true';
                                            }
                                        ?>
                                        <input type="text" name="returns[<?php echo e($purchase_line->id, false); ?>]"
                                            value="<?php echo e(number_format($purchase_line->quantity_returned, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>"
                                            class="form-control input-sm input_number return_qty input_quantity"
                                            data-rule-abs_digit="<?php echo e($check_decimal, false); ?>" data-msg-abs_digit="<?php echo app('translator')->get('lang_v1.decimal_value_not_allowed'); ?>"
                                            <?php if($purchase_line->product->enable_stock): ?> data-rule-max-value="<?php echo e($qty_available, false); ?>"
			              			data-msg-max-value="<?php echo app('translator')->get('validation.custom-messages.quantity_not_available', ['qty' => $purchase_line->formatted_qty_available, 'unit' => $unit_name ]); ?>" <?php endif; ?>>
                                        <input type="hidden" class="unit_price"
                                            value="<?php echo e(number_format($purchase_line->purchase_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
                                    </td>
                                    <td class="text-end">
                                        <div class="return_subtotal"></div>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <strong><?php echo app('translator')->get('lang_v1.total_return_discount'); ?>: </strong>
                    <span id="total_return_discount"></span>
                    <?php if(!empty($purchase->discount_amount)): ?>
                        <?php if($purchase->discount_type == 'percentage'): ?>
                            (<?php echo e(number_format($purchase->discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>%)
                        <?php else: ?>
                            (Rs <?php echo e(number_format($purchase->discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>)
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php
                        $discount_type = 'percentage';
                        if (!empty($purchase->discount_type)) {
                            $discount_type = $purchase->discount_type;
                        }
                        $discount_amount = 0;
                        if (!empty($purchase->discount_amount)) {
                            $discount_amount = $purchase->discount_amount;
                        }
                    ?>
                    <?php echo Form::hidden('discount_amount', $discount_amount, ['id' => 'discount_amount']); ?>

                    <?php echo Form::hidden('discount_type', $discount_type, ['id' => 'discount_type']); ?>

                </div>
                <div class="col-sm-4">
                    <strong><?php echo app('translator')->get('lang_v1.total_return_tax'); ?>: </strong>
                    <span id="total_return_tax"></span>
                    <?php if(!empty($purchase->tax)): ?>
                        (<?php echo e($purchase->tax->name, false); ?> - <?php echo e($purchase->tax->amount, false); ?>%)
                    <?php endif; ?>
                    <?php
                        $tax_percent = 0;
                        if (!empty($purchase->tax)) {
                            $tax_percent = $purchase->tax->amount;
                        }
                    ?>
                    <?php echo Form::hidden('tax_id', $purchase->tax_id); ?>

                    <?php echo Form::hidden('tax_amount', 0, ['id' => 'tax_amount']); ?>

                    <?php echo Form::hidden('tax_percent', $tax_percent, ['id' => 'tax_percent']); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 float-end">
                    <strong><?php echo app('translator')->get('lang_v1.return_total'); ?>: </strong>&nbsp;
                    <span id="net_return">0</span>
                </div>
            </div>
            <br>
            
        <?php echo $__env->renderComponent(); ?>

        <?php echo Form::close(); ?>


    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('form#purchase_return_form').validate();
            update_purchase_return_total();
        });
        $(document).on('change', 'input.return_qty', function() {
            update_purchase_return_total()
        });

        $(document).on('change', '#ref_no', function() {
            if($(this).val() != ''){
                $.ajax({
                    method: 'POST',
                    url: '/transactions/check-invoice-no',
                    data: {
                        id : $('#purchase_return_id').val(),
                        invoice_no : $('#ref_no').val(),
                        type : 'purchase',
                    },
                    dataType: 'json',
                    success: async function(result) {
                        if(result){
                            $('#ref_no').addClass('error');
                            $('#ref_no_error').removeClass('hide');
                        }else{
                            $('#ref_no').removeClass('error');
                            $('#ref_no_error').addClass('hide');
                        }
                    }
                });
            }else{
                $('#ref_no').removeClass('error');
                $('#ref_no_error').addClass('hide');
            }
        });

        $(document).on('click', 'button#submit_purchase_return_form', function(e) {
            e.preventDefault();
            var submit_buttons = $('button#submit_purchase_return_form');

            if ($('form#purchase_return_form').data('purchase_return_submit_locked')) {
                return false;
            }

            $('form#purchase_return_form').data('purchase_return_submit_locked', true);
            submit_buttons.prop('disabled', true);

            //Check if product is present or not.
            let total_qty = 0;
            $('table#purchase_return_table tbody tr .return_qty').each(function(){
                total_qty += $(this).val();
            });
        
            if (total_qty <= 0) {
                toastr.warning('Please Add Return Quantity');
                $('form#purchase_return_form').removeData('purchase_return_submit_locked');
                submit_buttons.prop('disabled', false);
                return false;
            }
            
            $('form#purchase_return_form').submit();
        });

        function update_purchase_return_total() {
            var net_return = 0;
            $('table#purchase_return_table tbody tr').each(function() {
                var quantity = __read_number($(this).find('input.return_qty'));
                var unit_price = __read_number($(this).find('input.unit_price'));
                var subtotal = quantity * unit_price;
                $(this).find('.return_subtotal').text(__currency_trans_from_en(subtotal, false));
                net_return += subtotal;
            });
            
            //Calculate Discount
            var discount_amount = $('input#discount_amount').val();
            var discount_type = $('input#discount_type').val();
            if(discount_type == 'percentage'){
                var total_discount = __calculate_amount('percentage', discount_amount, net_return);
            }else{
                var total_discount = __calculate_amount('fixed', discount_amount, net_return);
            }
            net_return = net_return - total_discount;
            
            //Calculate Tax
            var tax_percent = $('input#tax_percent').val();
            var total_tax = __calculate_amount('percentage', tax_percent, net_return);
            var net_return_inc_tax = total_tax + net_return;

            $('input#tax_amount').val(total_tax);
            $('span#total_return_discount').text(__currency_trans_from_en(total_discount, true));
            $('span#total_return_tax').text(__currency_trans_from_en(total_tax, true));
            $('span#net_return').text(__currency_trans_from_en(net_return_inc_tax, false));
        }
    </script>
<?php echo $__env->make('purchase_return.partials.purchase_return_keyboard_shortcuts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('purchase.partials.purchase_keyboard_shortcuts_help_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>