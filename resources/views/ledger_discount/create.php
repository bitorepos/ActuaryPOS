<div class="modal fade" id="add_discount_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php echo Form::open(['url' => action([\App\Http\Controllers\LedgerDiscountController::class, 'store']), 'method' => 'post', 'id' => 'add_discount_form' ]); ?>

            <input type="hidden" name="contact_id" value="<?php echo e($contact->id, false); ?>">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang_v1.add_discount'); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <?php echo Form::label('location_id',  __('purchase.business_location') . ':*'); ?>

                    <?php echo Form::select('location_id', $ld_business_locations, null, ['class' => 'form-control', 'style' => 'width:100%']); ?>

                </div>
                
                <div class="form-group mb-2">
                    <?php echo Form::label('discount_date', __( 'lang_v1.date' ) . ':*'); ?>

                      <?php echo Form::text('date', null, ['class' => 'form-control', 'required', 'autocomplete'=> 'off', 'placeholder' => __( 'lang_v1.date' ), 'id' => 'discount_date']); ?>

                </div>

                <div class="form-group mb-2">
                    <?php echo Form::label('amount', __( 'sale.amount' ) . ':*'); ?>

                      <?php echo Form::text('amount', null, ['class' => 'form-control input_number', 'required', 'placeholder' => __( 'sale.amount' ), 
                                  'data-rule-required'=> true, 'data-msg-required'=> 'This field is required',
                                  'data-rule-min-value' => 0, 'data-msg-min-value' => 'Min Value Allowed is 0.00',
                                  'min' => 0, 'oninput' => 'if(parseFloat(this.value) < 0) this.value = 0;']); ?>

                </div>

                
                <div class="form-group mb-2">
                    <?php echo Form::label('sub_type', __( 'lang_v1.type' ) . ':'); ?>

                      <?php echo Form::select('sub_type', ['sell_discount' => __('account.credit'), 'purchase_discount' => __('account.debit')], ($contact->type == 'supplier') ? 'purchase_discount' : 'sell_discount', ['class' => 'form-control', 'required' ]); ?>

                </div>
                
                <div class="form-group mb-2">
                    <?php echo Form::label('note', __( 'brand.note' ) . ':'); ?>

                      <?php echo Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => __( 'brand.note'), 'rows' => 3 ]); ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="save_button"><?php echo app('translator')->get( 'messages.submit' ); ?></button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
            </div>
            <?php echo Form::close(); ?>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->   
</div>
