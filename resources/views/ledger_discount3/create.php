<div class="modal fade" id="add_discount3_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <?php echo Form::open(['url' => action([\App\Http\Controllers\LedgerDiscountController::class, 'store3']), 'method' => 'post', 'id' => 'add_discount3_form' ]); ?>

            <input type="hidden" name="contact_id" id="ld3_contact_id" value="<?php echo e($contact->id, false); ?>">
            <input type="hidden" name="reindex_after_submit" id="ld3_reindex_after_submit" value="0">
            <div class="modal-header">
                <h4 class="modal-title"><?php if(!empty($common_settings['ledger_discount3_label'])): ?> <?php echo app('translator')->get('lang_v1.add'); ?> <?php echo e($common_settings['ledger_discount3_label'], false); ?> <?php else: ?> <?php echo app('translator')->get('lang_v1.add_ledger_discount3'); ?> <?php endif; ?></h4>
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
                            <?php echo Form::label('discount3_date', __( 'lang_v1.date' ) . ':*'); ?>

                            <?php echo Form::text('date', null, ['class' => 'form-control', 'required', 'autocomplete'=> 'off', 'placeholder' => __( 'lang_v1.date' ), 'id' => 'discount3_date']); ?>

                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="mb-3">
                            <?php echo Form::label('ld3_from_date', 'From Date:'); ?>

                            <input type="text" class="form-control" id="ld3_from_date" autocomplete="off" placeholder="From Date">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                            <?php echo Form::label('ld3_to_date', 'To Date:'); ?>

                            <input type="text" class="form-control" id="ld3_to_date" autocomplete="off" placeholder="To Date">
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="mb-3 w-100">
                            <button type="button" class="btn btn-info w-100" id="load_ld3_invoices">Load Invoices</button>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <?php echo Form::select('purchase_ids[]', [], null, ['class' => 'form-control select2', 'id' => 'purchase_ids', 'multiple', 'style' => 'width: 80%;']); ?>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-reponsive text-center" id="ledger_discount_3_purchase_table">
                                <thead>
                                    <tr>
                                        <th class="col-md-1">#</th>
                                        <th class="col-md-3"><?php echo app('translator')->get('lang_v1.date'); ?></th>
                                        <th class="col-md-5"><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                        <th class="col-md-2"><?php echo app('translator')->get('sale.subtotal'); ?></th>
                                        <th>X</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3"></th>
                                        <th colspan="2">Total Amount : <span class="ledger_discount3_total_amount"><?php 
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
                    <div class="col-md-6 hide">
                        <div class="mb-3">
                            <?php echo Form::label('sub_type', __( 'lang_v1.type' ) . ':'); ?>

                            <?php echo Form::select('sub_type', ['sell_discount' => __('account.credit'), 'purchase_discount' => __('account.debit')], ($contact->type == 'supplier') ? 'purchase_discount' : 'sell_discount', ['class' => 'form-control', 'required' ]); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <?php echo Form::label('discount_amount', __( 'lang_v1.discount_percentage' ) . ':*'); ?>

                            <?php echo Form::text('discount_amount', null, ['class' => 'form-control input_number', 'required', 'placeholder' => __( 'lang_v1.discount_percentage' ), 
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

                            <?php echo Form::text('amount', null, ['class' => 'form-control input_number', 'required', 'readonly', 'placeholder' => __( 'sale.amount' ),]); ?>

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
                <button type="submit" class="btn btn-warning" id="save_reindex_button" data-reindex-after-submit="1">Submit and Reindex</button>
                <button type="submit" class="btn btn-primary" id="save_button"><?php echo app('translator')->get( 'messages.submit' ); ?></button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
            </div>
            <?php echo Form::close(); ?>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->   
</div>
