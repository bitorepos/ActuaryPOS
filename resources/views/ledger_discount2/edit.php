<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php
            $ld2_serial_enabled = !empty($common_settings['enable_serial_number']);
            $ld2_serial_required = $ld2_serial_enabled && !empty($common_settings['is_serial_number_required_purchase']);
            $ld2_total_items_colspan = $ld2_serial_enabled ? 3 : 2;
        ?>
        <?php echo Form::open(['url' => action([\App\Http\Controllers\LedgerDiscountController::class, 'update2'], $discount->id), 'method' => 'put', 'id' => 'edit_discount2_form', 'data-serial-enabled' => $ld2_serial_enabled ? 1 : 0, 'data-serial-required' => $ld2_serial_required ? 1 : 0 ]); ?>

        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">
                <?php if(!empty($common_settings['ledger_discount2_label'])): ?> <?php echo app('translator')->get('lang_v1.edit'); ?> <?php echo e($common_settings['ledger_discount2_label'], false); ?> <?php else: ?> <?php echo app('translator')->get('lang_v1.edit_discount2'); ?> <?php endif; ?>
            </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <?php echo Form::label('location_id', __('purchase.business_location').':*'); ?>

                        <?php echo Form::select('location_id', $business_locations, $discount->location_id, ['class' => 'form-control', 'required']); ?>

                    </div>    
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <?php echo Form::label('edit_discount_date', __( 'lang_v1.date' ) . ':*'); ?>

                        <?php echo Form::text('date', \Carbon::createFromTimestamp(strtotime($discount->transaction_date))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.date' ), 'id' => 'edit_discount_date']); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <input type="text" class="form-control mousetrap" id="ledger_discount_2_product_search" placeholder="Search Product" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-12">
                    <?php
                    $total_items = 0;
                    $total_qty = 0;
                    $total_amount = 0;
                    ?>
                    <div class="table-responsive">
<table class="table table-reponsive text-center" id="ledger_discount_2_product_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="col-md-1"><?php echo app('translator')->get('product.sku'); ?></th>
                                <?php if($ld2_serial_enabled): ?>
                                    <th class="col-md-1"><?php echo app('translator')->get('product.sr_imei_no'); ?></th>
                                <?php endif; ?>
                                <th class="col-md-3"><?php echo app('translator')->get('sale.product'); ?></th>
                                <th class="col-md-2"><?php echo app('translator')->get('sale.qty'); ?></th>
                                <th class="col-md-2"><?php if(!empty($common_settings['ledger_discount2_label'])): ?> <?php echo e($common_settings['ledger_discount2_label'], false); ?> <?php else: ?> Discount 2 <?php endif; ?></th>
                                <th class="col-md-2"><?php echo app('translator')->get('sale.subtotal'); ?></th>
                                <th>X</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $total_items++;
                                $total_qty += $p->quantity;
                                $total_amount += $p->quantity * $p->amount;
                                ?>
                                <tr class="product_row" data-row_index="<?php echo e($loop->index, false); ?>">
                                    <td><?php echo e($loop->index + 1, false); ?></td>
                                    <td>
                                        <?php echo e($p->sku, false); ?>

                                        <input type="hidden" name="products[<?php echo e($loop->index, false); ?>][product_id]" value="<?php echo e($p->product_id, false); ?>" class="row_product_id">
                                        <input type="hidden" name="products[<?php echo e($loop->index, false); ?>][variation_id]" value="<?php echo e($p->variation_id, false); ?>" class="row_variation_id">
                                        <input type="hidden" name="products[<?php echo e($loop->index, false); ?>][name]" value="<?php echo e($p->name, false); ?>" class="row_product_name">
                                        <input type="hidden" name="products[<?php echo e($loop->index, false); ?>][purchase_line_id]" value="<?php echo e($p->pl_id, false); ?>" class="row_purchase_line_id">
                                        <input type="hidden" name="products[<?php echo e($loop->index, false); ?>][bulk_serial_numbers]" value='<?php echo json_encode($p->bulk_serial_numbers, 15, 512) ?>' class="row_bulk_serial_numbers">
                                    </td>
                                    <?php if($ld2_serial_enabled): ?>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary row_add_serial_numbers_btn" data-row_index="<?php echo e($loop->index, false); ?>">Add Serial Nos.</button>
                                        </td>
                                    <?php endif; ?>
                                    <td><?php echo e($p->name, false); ?></td>
                                    <td>
                                        <input type="text" name="products[<?php echo e($loop->index, false); ?>][quantity]" value="<?php echo e(number_format($p->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" class="form-control input-sm product_quantity input_number mousetrap" required>
                                    </td>
                                    <td>
                                        <input type="text" name="products[<?php echo e($loop->index, false); ?>][amount]" value="<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $p->amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>" class="form-control input-sm product_amount input_number mousetrap" required>
                                    </td>
                                    <td>
                                        <input type="text" name="products[<?php echo e($loop->index, false); ?>][total]" value="<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $p->quantity*$p->amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>" class="form-control input-sm product_total input_number" readonly>
                                    </td>
                                    <td>
                                        <i class="fa fa-trash bg-danger remove_product_row"></i>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="<?php echo e($ld2_total_items_colspan, false); ?>">Total Items : <span class="ledger_discount2_total_items"><?php echo e(number_format($total_items, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></th>
                                <th colspan="2">Total Qty : <span class="ledger_discount2_total_qty"><?php echo e(number_format($total_qty, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></th>
                                <th colspan="3">Total Amount : <span class="ledger_discount2_total_amount"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span></th>
                            </tr>
                        </tfoot>
                    </table>
</div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <?php echo Form::label('sub_type', __( 'lang_v1.type' ) . ':'); ?>

                        <?php echo Form::select('sub_type', ['sell_discount' => __('account.credit'), 'purchase_discount' => __('account.debit')], $discount->sub_type, ['class' => 'form-control', 'required' ]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <?php echo Form::label('amount', __( 'sale.amount' ) . ':*'); ?>

                        <?php echo Form::text('amount', number_format($discount->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'required', 'placeholder' => __( 'sale.amount' ),
                                            'data-rule-required'=> true, 'data-msg-required'=> 'This field is required',
                                        'data-rule-min-value' => 0, 'data-msg-min-value' => 'Min Value Allowed is 0.00',
                                        'min' => 0, 'oninput' => 'if(parseFloat(this.value) < 0) this.value = 0;']); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <?php echo Form::label('note', __( 'brand.note' ) . ':'); ?>

                        <?php echo Form::textarea('note', $discount->additional_notes, ['class' => 'form-control', 'placeholder' => __( 'brand.note'), 'rows' => 3 ]); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="contact_id" value="<?php echo e($discount->contact_id, false); ?>">
            <button type="submit" class="btn btn-primary" id="save_button"><?php echo app('translator')->get( 'messages.update' ); ?></button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
