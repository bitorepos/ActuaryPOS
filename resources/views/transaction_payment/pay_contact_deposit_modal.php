<?php
    $advance_deposit_mode = $advance_deposit_mode ?? 'combined';
    $show_advance_deposit_form = $advance_deposit_mode != 'view';
    $show_advance_deposit_list = $advance_deposit_mode != 'add';
?>
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\TransactionPaymentController::class, 'postPayContactDeposit']), 'method' => 'post', 'id' => 'pay_contact_deposit_form' ]); ?>


    <?php echo Form::hidden("contact_id", $contact_details->contact_id); ?>

    <?php echo Form::hidden("contact_type", $contact_type); ?>

    <div class="modal-header">
      <h4 class="modal-title">
        <?php if($advance_deposit_mode == 'view'): ?>
          <?php echo app('translator')->get('lang_v1.view'); ?> <?php echo app('translator')->get('lang_v1.advance_deposit'); ?>
        <?php elseif($advance_deposit_mode == 'add'): ?>
          <?php echo app('translator')->get('lang_v1.add'); ?> <?php echo app('translator')->get('lang_v1.advance_deposit'); ?>
        <?php else: ?>
          <?php echo app('translator')->get( 'lang_v1.advance_deposit' ); ?>
        <?php endif; ?>
      </h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
            <strong>Contact ID: </strong><?php echo e($contact_details->contact_ref, false); ?><br>
            <strong><?php if($contact_type == 'customer'): ?> <?php echo app('translator')->get('contact.customer'); ?> <?php else: ?> <?php echo app('translator')->get('purchase.supplier'); ?> <?php endif; ?>: </strong><?php echo e($contact_details->name, false); ?><br>
            <?php if(!empty($contact_details->supplier_business_name)): ?><strong><?php echo app('translator')->get('business.business'); ?>: </strong><?php echo e($contact_details->supplier_business_name, false); ?><br><?php endif; ?><br>
        </div>
      </div>
      <?php if($show_advance_deposit_form): ?>
      <div class="row payment_row">
        <?php
            if($contact_type == 'supplier'){
                $default_payment_type = 'debit';
            }else{
                $default_payment_type = 'credit';
            }
        ?>
        <div class="col-md-4">
          <div class="form-group mb-2">
            <?php echo Form::label("ad_payment_type" , 'Type:'); ?>

              <?php echo Form::select("ad_payment_type", ['debit' => 'Debit', 'credit' => 'Credit'], $default_payment_type, ['class' => 'form-select select2', 'style' => 'width:100%;']); ?>

          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group mb-2">
            <?php echo Form::label("business_location" , 'Location' . ':*'); ?>

            <div class="input-group">
              <span class="input-group-text">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              <?php echo Form::select("business_location", $business_locations, null, ['class' => 'form-select select2 business_locations_dropdown', 'style' => 'width:80%;'], $bl_attributes,); ?>

            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?php
              $is_user_required_on_payments = !empty($pos_settings['is_user_required_on_payments']);
              $payment_user_attributes = ['class' => 'form-control select2', 'style' => 'width:100%;', 'placeholder' => __('messages.please_select')];
              if($is_user_required_on_payments) {
                $payment_user_attributes['required'] = true;
              }
            ?>
            <?php echo Form::label("user_id" , __('report.user') . ($is_user_required_on_payments ? ':*' : ':')); ?>

            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-user"></i>
              </span>
              <?php echo Form::select("user_id", $users, null, $payment_user_attributes); ?>

            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="form-group mb-2">
            <?php echo Form::label("method" , __('purchase.payment_method') . ':*'); ?>

            <div class="input-group">
              <span class="input-group-text">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              <?php echo Form::select("method", $payment_types, $payment_line->method, ['class' => 'form-select select2 payment_types_dropdown', 'required', 'style' => 'width:80%;']); ?>

            </div>
          </div>
        </div>
        <?php
          $date_readonly = !empty($user_settings['disable_contact_payment_date']) ? 'disabled' : '';
        ?>
        <div class="col-md-4">
          <div class="form-group mb-2">
            <?php echo Form::label("paid_on" , __('lang_v1.paid_on') . ':*'); ?>

            <div class="input-group">
              <span class="input-group-text">
                <i class="fa fa-calendar"></i>
              </span>
              <?php echo Form::text('paid_on', $default_datetime, ['class' => 'form-control', 'readonly', 'required', $date_readonly]); ?>

            </div>
,          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group mb-2">
            <?php echo Form::label("amount" , __('sale.amount') . ':*'); ?>

            <div class="input-group">
              <span class="input-group-text">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              <?php echo Form::text("amount", 0, ['class' => 'form-control input_number payment_amount', 'required', 'placeholder' => __('sale.amount'),
                            'data-rule-required'=> true, 'data-msg-required'=> 'This field is required',
                            'data-rule-min-value' => 1, 'data-msg-min-value' => 'Min Value Allowed is 1.00']); ?>

            </div>
          </div>
        </div>
        <?php
            // Phase 65: prefer controller-supplied per-branch overlay; session is the fallback.
            $pos_settings = isset($pos_settings) && ! empty($pos_settings)
                ? $pos_settings
                : (!empty(session()->get('business.pos_settings')) ? json_decode(session()->get('business.pos_settings'), true) : []);

            $enable_cash_denomination_for_payment_methods = !empty($pos_settings['enable_cash_denomination_for_payment_methods']) ? $pos_settings['enable_cash_denomination_for_payment_methods'] : [];
        ?>

        <?php if(!empty($accounts)): ?>
          <div class="col-md-4">
            <div class="form-group mb-2">
              <?php echo Form::label("account_id" , __('lang_v1.payment_account') . ':'); ?>

              <div class="input-group">
                <span class="input-group-text">
                  <i class="fas fa-money-bill-alt"></i>
                </span>
                <?php echo Form::select("account_id", $accounts, !empty($payment_line->account_id) ? $payment_line->account_id : '' , ['class' => 'form-control select2', 'id' => "account_id", 'style' => 'width:100%;']); ?>

              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="clearfix"></div>

          <?php echo $__env->make('transaction_payment.payment_type_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <div class="clearfix"></div>
          <div class="col-md-12">
            <div class="form-group mb-2">
              <?php echo Form::label("note", __('lang_v1.payment_note') . ':'); ?>

              <?php echo Form::textarea("note", $payment_line->note, ['class' => 'form-control', 'rows' => 2]); ?>

            </div>
          </div>
      </div>
      <?php endif; ?>
      <?php if($show_advance_deposit_list): ?>
      <div class="row">
        <div class="clearfix"></div>
          <div class="col-md-12">
            <div class="table-responsive">
            <table class="table table-striped table-th-skin" id="previous_advance_deposits">
              <thead class="bg-success">
                <tr>
                  <th>#</th>
                  <th>Ref No.</th>
                  <th>Location</th>
                  <th>Date</th>
                  <th>Total</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php $__empty_18 = true; $__currentLoopData = $due_advance_deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                <tr>
                  <td><?php echo e($loop->index+1, false); ?></td>
                  <td><?php echo e($ad->ref_no, false); ?></td>
                  <td><?php echo e($ad->location, false); ?></td>
                  <td><?php echo e(\Carbon::createFromTimestamp(strtotime($ad->transaction_date))->format(session('business.date_format')), false); ?></td>
                  <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ad->final_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                  <td>
                    <?php if(empty($ad->deleted_at)): ?>
                    <button type="button" class="btn btn-sm btn-success view_advance_deposit" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'viewPaymentAD'], $ad->id), false); ?>"><i class="fas fa-eye m-auto"></i></button>

                    <?php if($contact_type == 'supplier' && auth()->user()->can('supplier.advance_deposit.delete')): ?>
                    <button type="button" class="btn btn-sm btn-danger delete_advance_deposit" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'deleteAdvanceDeposit'], $ad->id), false); ?>"><i class="fas fa-trash m-auto"></i></button>
                    <?php endif; ?>
                    <?php if($contact_type != 'supplier' && auth()->user()->can('customer.advance_deposit.delete')): ?>
                    <button type="button" class="btn btn-sm btn-danger delete_advance_deposit" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'deleteAdvanceDeposit'], $ad->id), false); ?>"><i class="fas fa-trash m-auto"></i></button>
                    <?php endif; ?>

                    <?php if($contact_type == 'supplier' && auth()->user()->can('supplier.advance_deposit.edit')): ?>
                    <button type="button" class="btn btn-sm btn-primary edit_advance_deposit" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'getEditAdvanceDeposit'], $ad->id), false); ?>"><i class="fas fa-edit m-auto"></i></button>
                    <?php endif; ?>
                    <?php if($contact_type != 'supplier' && auth()->user()->can('customer.advance_deposit.edit')): ?>
                    <button type="button" class="btn btn-sm btn-primary edit_advance_deposit" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'getEditAdvanceDeposit'], $ad->id), false); ?>"><i class="fas fa-edit m-auto"></i></button>
                    <?php endif; ?>
                    
                    <?php else: ?>
                    <?php if($contact_type == 'supplier' && auth()->user()->can('supplier.advance_deposit.delete')): ?>
                    <button type="button" class="btn btn-sm btn-warning restore_advance_deposit" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'restoreAdvanceDeposit'], $ad->id), false); ?>"><i class="fas fa-redo m-auto"></i></button>
                    <?php endif; ?>
                    <?php if($contact_type != 'supplier' && auth()->user()->can('customer.advance_deposit.delete')): ?>
                    <button type="button" class="btn btn-sm btn-warning restore_advance_deposit" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'restoreAdvanceDeposit'], $ad->id), false); ?>"><i class="fas fa-redo m-auto"></i></button>
                    <?php endif; ?>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                <td class="text-center" colspan="6">
                  No records found
                </td>
                <?php endif; ?>
              </tbody>
            </table>
            </div>
          </div>
      </div>
      <?php endif; ?>
    </div>

    <div class="modal-footer">
      <input type="hidden" name="save_and_print" value='0' id="save_and_print">
      <?php if($show_advance_deposit_form): ?>
      <button type="submit" class="btn btn-primary" id="save_btn"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-primary" id="save_and_print_btn"><?php echo app('translator')->get( 'lang_v1.save_and_print' ); ?></button>
      <?php endif; ?>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>

    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
