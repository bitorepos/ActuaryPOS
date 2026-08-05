<?php $auth_user_settings = json_decode(auth()->user()->user_settings, true) ?? []; ?>
<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
  <div class="modal-content" style="font-family: <?php echo e($classic_receipt_font, false); ?>;">

    <div class="modal-header">
      <h5 class="modal-title text-center w-100">
        <?php if($is_print_out): ?>
        <?php echo app('translator')->get( 'cash_register.register_open' ); ?><br>
        <?php endif; ?>
        <?php echo e($register_details->ref_no, false); ?> <br> <?php echo app('translator')->get( 'cash_register.register_details' ); ?> (<?php echo e(to_business_timezone($register_details->open_time)->format('jS M, Y h:i A'), false); ?> -  <?php echo e(to_business_timezone($close_time)->format('jS M, Y h:i A'), false); ?>)
      </h5>
      
    </div>

    <div class="modal-body">
      
      <?php echo $__env->make('cash_register.payment_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      
      <?php if(!$is_print_out): ?>
        <?php if((empty($auth_user_settings['hide_all_details_before_register_closing']) || auth()->user()->hasRole('Admin#' . auth()->user()->business_id)) || $is_print): ?>
        <hr class="m-1">
        <div class="row p-1">
        <div class="col-sm-4">
          <div class="mb-3">
            <?php echo Form::label('closing_amount', __( 'cash_register.total_cash' ) . ':*'); ?>

              <?php echo Form::text('closing_amount', number_format($register_details->expected_cash, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'disabled', 'placeholder' => __( 'cash_register.total_cash' ) ]); ?>

          </div>
        </div>
        <?php if(!empty($register_details->total_card_slips)): ?>
        <div class="col-sm-4">
          <div class="mb-3">
            <?php echo Form::label('total_card_slips', __( 'cash_register.total_card_slips' ) . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.total_card_slips') . '"></i>';
                }
            ?>
            <?php echo Form::number('total_card_slips', $register_details->total_card_slips, ['class' => 'form-control', 'disabled', 'placeholder' => __( 'cash_register.total_card_slips' ), 'min' => 0 ]); ?>

          </div>
        </div> 
        <?php endif; ?>
        <?php if(!empty($register_details->total_cheques)): ?>
        <div class="col-sm-4">
          <div class="mb-3">
            <?php echo Form::label('total_cheques', __( 'cash_register.total_cheques' ) . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.total_cheques') . '"></i>';
                }
            ?>
              <?php echo Form::number('total_cheques', $register_details->total_cheques, ['class' => 'form-control', 'disabled', 'placeholder' => __( 'cash_register.total_cheques' ), 'min' => 0 ]); ?>

          </div>
        </div>
        <?php endif; ?>
        </div><!-- /.row -->
        <?php endif; ?>
        <div class="row">
        <?php if(!empty($register_details->extra_details)): ?>
          <?php if(!empty($register_details->extra_details['card_slips']) || !empty($register_details->extra_details['card_slips_amount'])): ?>
          <div class="col-sm-4">
            <div class="mb-3">
              <?php echo Form::label('extra_details[card_slips]', __( 'cash_register.card_slips' ) . ':*'); ?> 
                <?php echo Form::number('extra_details[card_slips]', !empty($register_details->extra_details['card_slips']) ? $register_details->extra_details['card_slips'] : 0, ['class' => 'form-control', 'required', 'disabled', 'placeholder' => __( 'cash_register.total_card_slips' ), 'min' => 0 ]); ?>

            </div>
          </div> 
          <div class="col-sm-4">
            <div class="mb-3">
              <?php echo Form::label('extra_details[card_slips_amount]', __( 'cash_register.card_slips_amount' ) . ':*'); ?>

                <?php echo Form::number('extra_details[card_slips_amount]', !empty($register_details->extra_details['card_slips_amount']) ? $register_details->extra_details['card_slips_amount'] : 0, ['class' => 'form-control', 'required', 'disabled', 'placeholder' => __( 'cash_register.total_card_slips' ).' Amount', 'min' => 0 ]); ?>

            </div>
          </div> 
          <div class="clearfix"></div>
          <?php endif; ?>
          <?php if(!empty($register_details->extra_details['bank_transfer_slips']) || !empty($register_details->extra_details['bank_transfer_amount'])): ?>
          <div class="col-sm-4">
            <div class="mb-3">
              <?php echo Form::label('extra_details[bank_transfer_slips]', __( 'cash_register.bank_transfer_slips' ) . ':*'); ?> 
                <?php echo Form::number('extra_details[bank_transfer_slips]', !empty($register_details->extra_details['bank_transfer_slips']) ? $register_details->extra_details['bank_transfer_slips'] : 0, ['class' => 'form-control', 'required', 'disabled', 'placeholder' => __( 'cash_register.total_bank_transfer_slips' ), 'min' => 0 ]); ?>

            </div>
          </div> 
          <div class="col-sm-4">
            <div class="mb-3">
              <?php echo Form::label('extra_details[bank_transfer_amount]', __( 'cash_register.bank_transfer_amount' ) . ':*'); ?>

                <?php echo Form::number('extra_details[bank_transfer_amount]', !empty($register_details->extra_details['bank_transfer_amount']) ? $register_details->extra_details['bank_transfer_amount'] : 0, ['class' => 'form-control bank_transfer_amount', 'disabled' => true, 'required' => true, 'placeholder' => __( 'cash_register.total_bank_transfer_amount' ).' Amount', 'min' => 0 ]); ?>

            </div>
          </div>
          <?php endif; ?>
        <?php endif; ?>
        </div><!-- /.row -->
        <?php if(!empty($register_details->denominations)): ?>
          <?php
            $total = 0;
          ?>
          <div class="row">
            <div class="col-md-8 col-sm-12">
              <h3><?php echo app('translator')->get( 'lang_v1.cash_denominations' ); ?></h3>
              <table class="table table-condensed table-slim">
                <thead>
                  <tr>
                    <th width="20%" class="text-right"><?php echo app('translator')->get('lang_v1.denomination'); ?></th>
                    <th width="10%">&nbsp;</th>
                    <th width="20%" class="text-center"><?php echo app('translator')->get('lang_v1.count'); ?></th>
                    <th width="10%">&nbsp;</th>
                    <th width="40%" class="text-left"><?php echo app('translator')->get('sale.subtotal'); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $register_details->denominations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($value == 0): ?>
                    <?php continue; ?>
                  <?php endif; ?>
                  <tr>
                    <td class="text-right"><?php echo e($key, false); ?></td>
                    <td class="text-center">X</td>
                    <td class="text-center"><?php echo e($value ?? 0, false); ?></td>
                    <td class="text-center">=</td>
                    <td class="text-left">
                      <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $key * $value, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                    </td>
                  </tr>
                  <?php
                    $total += ($key * $value);
                  ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot class="table-slim">
                  <tr>
                    <th colspan="4" class="text-center"><?php echo app('translator')->get('sale.total'); ?></th>
                    <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                  </tr>
                  <?php if((empty($auth_user_settings['hide_all_details_before_register_closing']) || auth()->user()->hasRole('Admin#' . auth()->user()->business_id)) || $is_print): ?>
                  <tr>
                    <?php
                    $cash_total = $register_details->expected_cash;
                    ?>
                    <th colspan="4" class="text-center"><?php if(($total-$cash_total) == 0): ?> <?php echo app('translator')->get('sale.cash_difference'); ?> <?php elseif(($total-$cash_total) < 0): ?> <?php echo app('translator')->get('sale.cash_short'); ?> <?php elseif(($total-$cash_total) > 0): ?> <?php echo app('translator')->get('sale.cash_excess'); ?> <?php endif; ?></th>
                    <td><span class="cash_difference display_currency" data-currency_symbol="true" data-orig-value="<?php echo e($total-$cash_total, false); ?>"> <?php echo e(number_format($total-$cash_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></td>
                  </tr>
                  <?php
                    $card_total = $register_details->total_card - $register_details->total_card_refund + $register_details->total_sub_card - $register_details->total_sub_card_refund + $register_details->total_card_ad - $register_details->total_card_ad_refund;
                    $card_difference = ($register_details->extra_details['card_slips_amount'] ?? 0)-$card_total;
                  ?>
                  <?php if($card_difference != 0): ?>
                  <tr>
                    <th colspan="4" class="text-center"><?php echo app('translator')->get('sale.card_difference'); ?></th>
                    <td><span class="card_difference display_currency" data-currency_symbol="true" data-orig-value="<?php echo e($card_difference, false); ?>"><?php echo e(number_format($card_difference, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></td>
                  </tr>
                  <?php endif; ?>
                  <?php
                    $bank_total = $register_details->total_bank_transfer - $register_details->total_bank_transfer_refund + $register_details->total_sub_bank_transfer - $register_details->total_sub_bank_transfer_refund + $register_details->total_sub_bank_transfer_ad - $register_details->total_sub_bank_transfer_refund;
                    $bank_difference = ($register_details->extra_details['bank_transfer_amount'] ?? 0)-$bank_total;
                  ?>
                  <?php if($bank_difference != 0): ?>
                  <tr>
                    <th colspan="4" class="text-center"><?php echo app('translator')->get('sale.bank_transfer_difference'); ?></th>
                    <td><span class="bank_transfer_difference display_currency" data-currency_symbol="true" data-orig-value="<?php echo e($bank_difference, false); ?>"><?php echo e(number_format($bank_difference, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></td>
                  </tr>
                  <?php endif; ?>
                  <tr>
                    <th colspan="4" class="text-center"><?php echo app('translator')->get('sale.net_difference'); ?></th>
                    <td><span class="net_difference display_currency" data-currency_symbol="true"><?php echo e(number_format(($total-$cash_total) + $card_difference + $bank_difference, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></td>
                  </tr>
                  <?php endif; ?>
                </tfoot>
              </table>
            </div>
          </div>
        <?php endif; ?>
      <?php endif; ?>
      
      <div class="row">
        <div class="col-6">
          <b><?php echo app('translator')->get('report.user'); ?>:</b> <?php echo e($register_details->user_name, false); ?><br>
          <b><?php echo app('translator')->get('business.email'); ?>:</b> <?php echo e($register_details->email, false); ?><br>
          <b><?php echo app('translator')->get('business.business_location'); ?>:</b> <?php echo e($register_details->location_name, false); ?><br>
        </div>
        <?php if(!empty($register_details->closing_note)): ?>
          <div class="col-6">
            <strong><?php echo app('translator')->get('cash_register.closing_note'); ?>:</strong><br>
            <?php echo e($register_details->closing_note, false); ?>

          </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="modal-footer no-print">
      <button type="button" class="btn btn-primary no-print" 
        aria-label="Print" 
          onclick="window.print();">
        <i class="fa fa-print"></i> <?php echo app('translator')->get( 'messages.print' ); ?>
      </button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.cancel' ); ?></button>
    </div>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<style type="text/css">
  @media print {
    body * {
        visibility: hidden !important;
    }
    .modal.view_modal,
    .modal.view_register,
    .modal.register_details_modal {
        display: block !important;
        visibility: visible !important;
        position: absolute !important;
        left: 0;
        top: 0;
        margin: 0;
        padding: 0;
        overflow: visible !important;
        width: 100%;
        height: auto !important;
    }
    .modal.view_modal .modal-dialog,
    .modal.view_modal .modal-content,
    .modal.view_modal .modal-content *,
    .modal.view_register .modal-dialog,
    .modal.view_register .modal-content,
    .modal.view_register .modal-content *,
    .modal.register_details_modal .modal-dialog,
    .modal.register_details_modal .modal-content,
    .modal.register_details_modal .modal-content * {
        visibility: visible !important;
    }
    .modal.view_modal .modal-dialog,
    .modal.view_register .modal-dialog,
    .modal.register_details_modal .modal-dialog {
        max-width: 100% !important;
        margin: 0 !important;
        height: auto !important;
    }
    .modal.view_modal .modal-content,
    .modal.view_register .modal-content,
    .modal.register_details_modal .modal-content {
        border: none !important;
        box-shadow: none !important;
        overflow: visible !important;
        max-height: none !important;
    }
    .modal.view_modal .modal-body,
    .modal.view_register .modal-body,
    .modal.register_details_modal .modal-body {
        overflow: visible !important;
        max-height: none !important;
    }
    .modal .no-print {
        display: none !important;
    }
    .modal-backdrop {
        display: none !important;
    }
}
</style>
