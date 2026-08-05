<div class="modal fade" id="add_discount2_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <?php
                $ld2_serial_enabled = !empty($common_settings['enable_serial_number']);
                $ld2_serial_required = $ld2_serial_enabled && !empty($common_settings['is_serial_number_required_purchase']);
                $ld2_total_items_colspan = $ld2_serial_enabled ? 3 : 2;
            ?>
            <?php echo Form::open(['url' => action([\App\Http\Controllers\LedgerDiscountController::class, 'store2']), 'method' => 'post', 'id' => 'add_discount2_form', 'data-serial-enabled' => $ld2_serial_enabled ? 1 : 0, 'data-serial-required' => $ld2_serial_required ? 1 : 0 ]); ?>

            <input type="hidden" name="contact_id" value="<?php echo e($contact->id, false); ?>">
            <div class="modal-header">
                <h4 class="modal-title"><?php if(!empty($common_settings['ledger_discount2_label'])): ?> <?php echo app('translator')->get('lang_v1.add'); ?> <?php echo e($common_settings['ledger_discount2_label'], false); ?> <?php else: ?> <?php echo app('translator')->get('lang_v1.add_discount2'); ?> <?php endif; ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <?php echo Form::label('location_id',  __('purchase.business_location') . ':*'); ?>

                            <?php echo Form::select('location_id', $ld_business_locations, null, ['class' => 'form-control', 'style' => 'width:100%']); ?>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <?php echo Form::label('discount2_date', __( 'lang_v1.date' ) . ':*'); ?>

                            <?php echo Form::text('date', null, ['class' => 'form-control', 'required', 'autocomplete'=> 'off', 'placeholder' => __( 'lang_v1.date' ), 'id' => 'discount2_date']); ?>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <input type="text" class="form-control mousetrap" id="ledger_discount_2_product_search" placeholder="Search Product" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-12">
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
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="<?php echo e($ld2_total_items_colspan, false); ?>">Total Items : <span class="ledger_discount2_total_items"><?php echo e(number_format(0, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></th>
                                    <th colspan="2">Total Qty : <span class="ledger_discount2_total_qty"><?php echo e(number_format(0, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></th>
                                    <th colspan="3">Total Amount : <span class="ledger_discount2_total_amount"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

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

                            <?php echo Form::select('sub_type', ['sell_discount' => __('account.credit'), 'purchase_discount' => __('account.debit')], ($contact->type == 'supplier') ? 'purchase_discount' : 'sell_discount', ['class' => 'form-control', 'required' ]); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <?php echo Form::label('amount', __( 'sale.amount' ) . ':*'); ?>

                            <?php echo Form::text('amount', null, ['class' => 'form-control input_number', 'required', 'placeholder' => __( 'sale.amount' ), 
                                        'data-rule-required'=> true, 'data-msg-required'=> 'This field is required',
                                        'data-rule-min-value' => 0, 'data-msg-min-value' => 'Min Value Allowed is 0.00',
                                        'min' => 0, 'oninput' => 'if(parseFloat(this.value) < 0) this.value = 0;']); ?>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <?php echo Form::label('note', __( 'brand.note' ) . ':'); ?>

                            <?php echo Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => __( 'brand.note'), 'rows' => 3 ]); ?>

                        </div>
                    </div>
                </div>
            
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="save_button"><?php echo app('translator')->get( 'messages.submit' ); ?></button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
            </div>
            <?php echo Form::close(); ?>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->   
</div>
