<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\App\Http\Controllers\LedgerDiscountController::class, 'update3'], $discount->id), 'method' => 'put', 'id' => 'edit_discount3_form' ]); ?>

        <input type="hidden" name="contact_id" id="edit_ld3_contact_id" value="<?php echo e($discount->contact_id, false); ?>">
        <input type="hidden" name="reindex_after_submit" id="edit_ld3_reindex_after_submit" value="0">
        <div class="modal-header">
            <h4 class="modal-title">
                <?php if(!empty($common_settings['ledger_discount3_label'])): ?> <?php echo app('translator')->get('lang_v1.edit'); ?> <?php echo e($common_settings['ledger_discount3_label'], false); ?> <?php else: ?> <?php echo app('translator')->get('lang_v1.edit_discount3'); ?> <?php endif; ?>
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <?php echo Form::label('location_id', __('purchase.business_location').':*'); ?>

                        <?php echo Form::select('location_id', $business_locations, $discount->location_id, ['class' => 'form-control select2', 'required', 'id' => 'edit_ld3_location_id']); ?>

                    </div>    
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <?php echo Form::label('edit_discount3_date', __( 'lang_v1.date' ) . ':*'); ?>

                        <?php echo Form::text('date', \Carbon::createFromTimestamp(strtotime($discount->transaction_date))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.date' ), 'id' => 'edit_discount3_date']); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <?php echo Form::select('purchase_ids[]', [], [], ['class' => 'form-control select2', 'id' => 'edit_purchase_ids', 'multiple', 'style' => 'width: 100%;']); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-reponsive text-center" id="ledger_discount_3_purchase_table_edit">
                            <thead>
                                <tr>
                                    <th class="col-md-1">#</th>
                                    <th class="col-md-8"><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                    <th class="col-md-3"><?php echo app('translator')->get('sale.subtotal'); ?></th>
                                    <th>X</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($discount_purchases)): ?>
                                    <?php $purchase_amount = 0; ?>
                                    <?php $__currentLoopData = $discount_purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $purchase_amount += $p->amount; ?>
                                        <tr class="purchase_row" data-purchase-id="<?php echo e($p->id, false); ?>">
                                            <td>
                                                <span class="purchase-row-number"><?php echo e($loop->index + 1, false); ?></span>
                                            </td>
                                            <td><?php echo e($p->transaction_date ? \Carbon\Carbon::parse($p->transaction_date)->format(session('business.date_format', 'd/m/Y')) : '', false); ?></td>
                                            <td><?php echo e($p->ref_no, false); ?></td>
                                            <td class="purchase_amount" data-amount="<?php echo e($p->amount, false); ?>">
                                                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $p->amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                            </td>
                                            <td><button type="button" class="btn btn-sm btn-danger remove_purchase_row" data-purchase-id="<?php echo e($p->id, false); ?>"><i class="fa fa-trash"></i></button></td>
            
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3"></th>
                                    <th colspan="2">Total Amount : <span class="ledger_discount3_total_amount_edit"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $purchase_amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-md-6 hide">
                    <div class="mb-3">
                        <?php echo Form::label('sub_type', __( 'lang_v1.type' ) . ':'); ?>

                        <?php echo Form::select('sub_type', ['sell_discount' => __('account.credit'), 'purchase_discount' => __('account.debit')], $discount->sub_type, ['class' => 'form-control', 'required' ]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <?php echo Form::label('discount_amount', __( 'lang_v1.discount_percentage' ) . ':*'); ?>

                        <?php echo Form::text('discount_amount', number_format($discount->discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'required', 'placeholder' => __( 'lang_v1.discount_percentage' ), 
                                    'data-rule-required'=> true, 'data-msg-required'=> 'This field is required',
                                    'data-decimal' => 1,
                                    'inputmode' => 'decimal',
                                    'data-rule-min-value' => 0.0001, 'data-msg-min-value' => 'Min Value Allowed is 0.0001',
                                    'data-rule-max-value' => 100, 'data-msg-max-value' => 'Max Value Allowed is 100.00',
                                    'min' => 0.0001, 'max' => 100]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <?php echo Form::label('amount', __( 'sale.amount' ) . ':*'); ?>

                        <?php echo Form::text('amount', number_format($discount->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'required', 'readonly', 'placeholder' => __( 'sale.amount' )]); ?>

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
            <button type="submit" class="btn btn-warning" id="save_reindex_button" data-reindex-after-submit="1">Submit and Reindex</button>
            <button type="submit" class="btn btn-primary" id="save_button"><?php echo app('translator')->get( 'messages.update' ); ?></button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
