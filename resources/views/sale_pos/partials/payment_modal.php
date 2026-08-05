<div class="modal fade" tabindex="-1" role="dialog" id="modal_payment">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white py-2">
                <h5 class="modal-title fw-semibold"><?php echo app('translator')->get('lang_v1.payment'); ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                
                <div class="payment-summary-bar d-flex flex-wrap align-items-stretch mb-3 rounded-3 overflow-hidden border">
                    <div class="payment-stat flex-fill text-center py-2 px-3 border-end">
                        <div class="payment-stat-label text-muted small fw-medium"><?php echo app('translator')->get('lang_v1.items'); ?></div>
                        <span class="payment-stat-value fw-bold fs-5 total_quantity d-block">0</span>
                    </div>
                    <div class="payment-stat flex-fill text-center py-2 px-3 border-end">
                        <div class="payment-stat-label text-muted small fw-medium"><?php echo app('translator')->get('sale.total_payable'); ?></div>
                        <span class="payment-stat-value fw-bold fs-5 text-primary total_payable_span d-block">0</span>
                    </div>
                    <div class="payment-stat flex-fill text-center py-2 px-3 border-end">
                        <div class="payment-stat-label text-muted small fw-medium"><?php echo app('translator')->get('lang_v1.total_paying'); ?></div>
                        <span class="payment-stat-value fw-bold fs-5 total_paying d-block">0</span>
                        <input type="hidden" id="total_paying_input">
                    </div>
                    <div class="payment-stat flex-fill text-center py-2 px-3 border-end">
                        <div class="payment-stat-label text-muted small fw-medium"><?php echo app('translator')->get('lang_v1.change_return'); ?></div>
                        <span class="payment-stat-value fw-bold fs-5 text-success change_return_span d-block">0</span>
                        <?php if(!empty($change_return['id'])): ?>
                        <input type="hidden" name="change_return_id" value="<?php echo e($change_return['id'], false); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="payment-stat flex-fill text-center py-2 px-3">
                        <div class="payment-stat-label text-muted small fw-medium"><?php echo app('translator')->get('lang_v1.balance'); ?></div>
                        <span class="payment-stat-value fw-bold fs-5 text-danger balance_due d-block">0</span>
                        <input type="hidden" id="in_balance_due" value=0>
                    </div>
                </div>

                
                <div class="mb-3">
                    <strong class="small"><?php echo app('translator')->get('lang_v1.advance_balance'); ?>:</strong>
                    <span id="advance_balance_text" class="fw-medium"></span>
                    <?php echo Form::hidden('advance_balance', null, ['id' => 'advance_balance', 'data-error-msg' =>
                    __('lang_v1.required_advance_balance_not_available')]); ?>

                </div>

                
                <div class="row g-3">
                    
                    <div class="<?php if(empty($pos_settings['quick_cash_buttons'])): ?> col-md-7 <?php else: ?> col-md-6 <?php endif; ?>">
                        <div id="payment_rows_div">
                                <?php $__currentLoopData = $payment_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($payment_line['is_return'] == 1): ?>
                                <?php
                                $change_return = $payment_line;
                                ?>
                                <?php continue; ?>
                                <?php endif; ?>

                                <?php echo $__env->make('sale_pos.partials.payment_row_form_modal', ['removable' => !$loop->first, 'row_index' => $loop->index, 'payment_line' => $payment_line], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <input type="hidden" id="payment_row_index" value="<?php echo e(count($payment_lines), false); ?>">

                        
                        <div class="row payment_row mt-3 g-2 align-items-center"
                            id="change_return_payment_data">
                            <div class="col-md-6 mb-2">
                                <button type="button" data-row-index="change_return" class="btn btn-outline-secondary w-100" readonly><?php echo app('translator')->get('lang_v1.change_return'); ?></button>
                            </div>
                            <div class="col-md-6 mb-2">
                                <?php
                                $_payment_method = empty($change_return['method']) && array_key_exists('cash', $payment_types) ? 'cash' : $change_return['method'];
                                $_payment_types = $payment_types;
                                if(isset($_payment_types['advance'])) {
                                    unset($_payment_types['advance']);
                                }
                                ?>
                                <div class="input-group modal_change_return_payment_row" data-method="<?php echo e($_payment_method, false); ?>">
                                    <span class="input-group-text">
                                        <i class="fas fa-money-bill-alt"></i>
                                    </span>
                                    <?php echo Form::text("change_return", $change_return['amount'], ['class' => 'form-control change_return input_number', 'readonly', 'id' => "change_return"]); ?>

                                    <?php echo Form::hidden("payment[change_return][method]", $_payment_method, ['id' => 'pay_modal_change_return_method']); ?>

                                    <?php if(!empty($accounts)): ?>
                                        <?php echo Form::hidden("payment[change_return][account_id]", $change_return['account_id'], ['class' => 'form-control', 'id' => "account_id"]); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty($pos_settings['enable_sale_note'])): ?>
                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <?php echo Form::label('sale_note', __('sale.sell_note') . ':'); ?>

                                    <?php echo Form::textarea('sale_note', !empty($transaction)?
                                    $transaction->additional_notes:null, ['class' => 'form-control', 'rows' => 3,
                                    'placeholder' => __('sale.sell_note')]); ?>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <?php echo Form::label('staff_note', __('sale.staff_note') . ':'); ?>

                                    <?php echo Form::textarea('staff_note',
                                    !empty($transaction)? $transaction->staff_note:null, ['class' => 'form-control',
                                    'rows' => 3, 'placeholder' => __('sale.staff_note')]); ?>

                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="<?php if(!empty($pos_settings['quick_cash_buttons'])): ?> col-md-4 <?php else: ?> col-md-5 <?php endif; ?> d-none d-md-block payment-numpad-col">
                        <div class="numpad-grid">
                            <div class="row g-2 mb-2">
                                <div class="col-4"><button type="button" class="btn btn-primary w-100 numpad-btn payment_cash_buttons" id="numpad_payable">Amount</button></div>
                                <div class="col-4"><button type="button" class="btn btn-primary w-100 numpad-btn payment_num_buttons" value="back"><i class="fas fa-arrow-left"></i><br>Back</button></div>
                                <div class="col-4"><button type="button" class="btn btn-primary w-100 numpad-btn payment_num_buttons" value="clear"><i class="fas fa-edit"></i><br>Clear</button></div>
                            </div>
                            <div class="row g-2 mb-2">
                                <div class="col-4"><button type="button" class="btn btn-primary w-100 numpad-btn payment_num_buttons" value="7">7</button></div>
                                <div class="col-4"><button type="button" class="btn btn-primary w-100 numpad-btn payment_num_buttons" value="8">8</button></div>
                                <div class="col-4"><button type="button" class="btn btn-primary w-100 numpad-btn payment_num_buttons" value="9">9</button></div>
                            </div>
                            <div class="row g-2 mb-2">
                                <div class="col-4"><button type="button" class="btn btn-primary w-100 numpad-btn payment_num_buttons" value="4">4</button></div>
                                <div class="col-4"><button type="button" class="btn btn-primary w-100 numpad-btn payment_num_buttons" value="5">5</button></div>
                                <div class="col-4"><button type="button" class="btn btn-primary w-100 numpad-btn payment_num_buttons" value="6">6</button></div>
                            </div>
                            <div class="row g-2 mb-2">
                                <div class="col-4"><button type="button" class="btn btn-primary w-100 numpad-btn payment_num_buttons" value="1">1</button></div>
                                <div class="col-4"><button type="button" class="btn btn-primary w-100 numpad-btn payment_num_buttons" value="2">2</button></div>
                                <div class="col-4"><button type="button" class="btn btn-primary w-100 numpad-btn payment_num_buttons" value="3">3</button></div>
                            </div>
                            <div class="row g-2">
                                <div class="col-4"><button type="button" class="btn btn-primary w-100 numpad-btn payment_num_buttons" value="0">0</button></div>
                                <div class="col-4"><button type="button" class="btn btn-primary w-100 numpad-btn payment_num_buttons" value=".">.</button></div>
                                <div class="col-4"><button type="button" class="btn btn-primary w-100 numpad-btn payment_num_buttons" value="plus_minus">+/-</button></div>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($pos_settings['quick_cash_buttons'])): ?>
                    <div class="col-md-2 d-none d-md-block payment-quickcash-col">
                        <?php $__currentLoopData = explode(',', $pos_settings['quick_cash_buttons']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cash_button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mb-2">
                            <button type="button" class="btn btn-primary btn-lg w-100 payment_cash_buttons" value="<?php echo e($cash_button, false); ?>"><?php echo e(number_format($cash_button, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></button>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="modal-footer payment-modal-footer">
				<input type="hidden" name="pos_takeway_kot" id="pos-takeway-kot" value="0">
                <input type="hidden" id="multipay_modal_enter" value="<?php echo e($pos_settings['multipay_modal_enter'], false); ?>">
                <?php echo Form::hidden('pos_save_and_print', 1, ['id' => 'pos_save_and_print']); ?>

                <button type="submit" class="btn btn-primary big-button" id="pos-save">
                    <i class="fas fa-check-circle me-1"></i> <?php echo app('translator')->get('sale.finalize_payment'); ?>
                </button>
                <button type="submit" class="btn btn-success hide big-button" id="pos-save-multipay" data-btn-value="save">
                    <i class="fas fa-save me-1"></i> <?php echo app('translator')->get('messages.save'); ?>
                </button>
                <?php if(empty($pos_settings['hide_pay_print_btn_multipay'])): ?>
                    <button type="submit" class="btn btn-info hide big-button" id="pos-save-multipay" data-btn-value='save_n_print' data-save-and-print='true'>
                        <i class="fas fa-print me-1"></i> <?php echo app('translator')->get('lang_v1.save_and_print'); ?>
                    </button> 
                <?php endif; ?>
				<button type="button" class="btn btn-outline-secondary big-button" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> <?php echo app('translator')->get('messages.close'); ?>
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" tabindex="-1" role="dialog" id="card_details_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title fw-semibold"><?php echo app('translator')->get('lang_v1.card_transaction_details'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <?php echo Form::label("card_number", __('lang_v1.card_no')); ?>

                            <?php echo Form::text("", null, ['class' => 'form-control', 'placeholder' =>
                            __('lang_v1.card_no'), 'id' => "card_number", 'autofocus']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <?php echo Form::label("card_holder_name", __('lang_v1.card_holder_name')); ?>

                            <?php echo Form::text("", null, ['class' => 'form-control', 'placeholder' =>
                            __('lang_v1.card_holder_name'), 'id' => "card_holder_name"]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <?php echo Form::label("card_transaction_number",__('lang_v1.card_transaction_no')); ?>

                            <?php echo Form::text("", null, ['class' => 'form-control', 'placeholder' =>
                            __('lang_v1.card_transaction_no'), 'id' => "card_transaction_number"]); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <?php echo Form::label("card_type", __('lang_v1.card_type')); ?>

                            <?php echo Form::select("", ['visa' => 'Visa', 'master' => 'MasterCard'], 'visa',['class' =>
                            'form-control select2', 'id' => "card_type" ]); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <?php echo Form::label("card_month", __('lang_v1.month')); ?>

                            <?php echo Form::text("", null, ['class' => 'form-control', 'placeholder' =>
                            __('lang_v1.month'),
                            'id' => "card_month" ]); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <?php echo Form::label("card_year", __('lang_v1.year')); ?>

                            <?php echo Form::text("", null, ['class' => 'form-control', 'placeholder' =>
                            __('lang_v1.year'), 'id' => "card_year" ]); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <?php echo Form::label("card_security",__('lang_v1.security_code')); ?>

                            <?php echo Form::text("", null, ['class' => 'form-control', 'placeholder' =>
                            __('lang_v1.security_code'), 'id' => "card_security"]); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="pos-save-card" data-save-and-print='true'>
                    <i class="fas fa-print me-1"></i> <?php echo app('translator')->get('lang_v1.save_and_print'); ?>
                </button>
                <button type="button" class="btn btn-primary" id="pos-save-card">
                    <i class="fas fa-save me-1"></i> <?php echo app('translator')->get('messages.save'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
