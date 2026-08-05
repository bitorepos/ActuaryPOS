<?php $auth_user_settings = json_decode(auth()->user()->user_settings, true) ?? []; ?>
<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
  <div class="modal-content" style="font-family: <?php echo e($classic_receipt_font, false); ?>;">
    <?php echo Form::open(['url' => action([\App\Http\Controllers\CashRegisterController::class, 'postCloseRegister']), 'method' => 'post', 'id'=> 'close_register_form', 'class' => 'd-flex flex-column overflow-hidden', 'style' => 'max-height:100%' ]); ?>


    <?php echo Form::hidden('register_id', $register_details->register_id); ?>

    <?php echo Form::hidden('user_id', $register_details->user_id); ?>

    <div class="modal-header">
      <h3 class="modal-title text-center"><?php echo e($register_details->ref_no, false); ?> <br> <?php echo app('translator')->get( 'cash_register.current_register' ); ?> ( <?php echo e(to_business_timezone($register_details->open_time)->format('jS M, Y h:i A'), false); ?> - <?php echo e(\Carbon::now(session('business.time_zone', config('app.timezone')))->format('jS M, Y h:i A'), false); ?>)</h3>
      <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
      <?php echo $__env->make('cash_register.payment_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <hr>
      <div class="row">
        <?php if((empty($auth_user_settings['hide_all_details_before_register_closing']) || auth()->user()->hasRole('Admin#' . auth()->user()->business_id))): ?>
          <div class="col-sm-4">
          <?php
              $closing_amount = $register_details->expected_cash;
          ?>
            <div class="mb-3">
              <?php echo Form::label('closing_amount', __( 'cash_register.total_cash' ) . ':*'); ?>

              <?php echo Form::text('closing_amount', number_format($closing_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'required', 'readonly', 'placeholder' => __( 'cash_register.total_cash' ) ]); ?>

            </div>
          </div>
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
                <?php echo Form::number('total_card_slips', $register_details->total_card_slips, ['class' => 'form-control', 'required', 'readonly', 'placeholder' => __( 'cash_register.total_card_slips' ), 'min' => 0 ]); ?>

            </div>
          </div> 
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
                <?php echo Form::number('total_cheques', $register_details->total_cheques, ['class' => 'form-control', 'required', 'readonly', 'placeholder' => __( 'cash_register.total_cheques' ), 'min' => 0 ]); ?>

            </div>
          </div> 
        <?php endif; ?>
        <div class="clearfix"></div>
        <div class="col-sm-4">
          <div class="mb-3">
            <?php echo Form::label('extra_details[card_slips]', __( 'cash_register.card_slips' ) . ':*'); ?> 
              <?php echo Form::number('extra_details[card_slips]', !empty($register_details->extra_details['card_slips']) ? $register_details->extra_details['card_slips'] : 0, ['class' => 'form-control', 'required', 'placeholder' => __( 'cash_register.total_card_slips' ), 'min' => 0 ]); ?>

          </div>
        </div> 
        <div class="col-sm-4">
          <div class="mb-3">
            <?php echo Form::label('extra_details[card_slips_amount]', __( 'cash_register.card_slips_amount' ) . ':*'); ?>

              <?php echo Form::number('extra_details[card_slips_amount]', !empty($register_details->extra_details['card_slips_amount']) ? $register_details->extra_details['card_slips_amount'] : 0, ['class' => 'form-control card_slips_amount', 'required', 'placeholder' => __( 'cash_register.total_card_slips' ).' Amount', 'min' => 0 ]); ?>

          </div>
        </div> 
        <div class="clearfix"></div>
        <div class="col-sm-4">
          <div class="mb-3">
            <?php echo Form::label('extra_details[bank_transfer_slips]', __( 'cash_register.bank_transfer_slips' ) . ':*'); ?> 
              <?php echo Form::number('extra_details[bank_transfer_slips]', !empty($register_details->extra_details['bank_transfer_slips']) ? $register_details->extra_details['bank_transfer_slips'] : 0, ['class' => 'form-control', 'required', 'placeholder' => __( 'cash_register.total_bank_transfer_slips' ), 'min' => 0 ]); ?>

          </div>
        </div> 
        <div class="col-sm-4">
          <div class="mb-3">
            <?php echo Form::label('extra_details[bank_transfer_amount]', __( 'cash_register.bank_transfer_amount' ) . ':*'); ?>

              <?php echo Form::number('extra_details[bank_transfer_amount]', !empty($register_details->extra_details['bank_transfer_amount']) ? $register_details->extra_details['bank_transfer_amount'] : 0, ['class' => 'form-control bank_transfer_amount', 'required', 'placeholder' => __( 'cash_register.total_bank_transfer_amount' ).' Amount', 'min' => 0 ]); ?>

          </div>
        </div> 
        <div class="clearfix"></div>
        <div class="col-md-8 col-sm-12">
          <h3><?php echo app('translator')->get( 'lang_v1.cash_denominations' ); ?></h3>
          <?php if(!empty($pos_settings['cash_denominations'])): ?>
            <table class="table table-slim">
              <thead>
                <tr>
                  <th width="20%" class="text-right"><?php echo app('translator')->get('lang_v1.denomination'); ?></th>
                  <th width="20%">&nbsp;</th>
                  <th width="20%" class="text-center"><?php echo app('translator')->get('lang_v1.count'); ?></th>
                  <th width="20%">&nbsp;</th>
                  <th width="20%" class="text-left"><?php echo app('translator')->get('sale.subtotal'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = explode(',', $pos_settings['cash_denominations']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dnm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td class="text-right"><?php echo e($dnm, false); ?></td>
                  <td class="text-center" >X</td>
                  <td><?php echo Form::number("denominations[$dnm]", null, ['class' => 'form-control cash_denomination input-sm', 'min' => 0, 'data-denomination' => $dnm, 'style' => 'width: 100px; margin:auto;' ]); ?></td>
                  <td class="text-center">=</td>
                  <td class="text-left">
                    <span class="denomination_subtotal">0</span>
                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="4" class="text-center"><?php echo app('translator')->get('sale.total'); ?></th>
                  <td><span class="denomination_total">0</span></td>
                </tr>
                <?php if((empty($auth_user_settings['hide_all_details_before_register_closing']) || auth()->user()->hasRole('Admin#' . auth()->user()->business_id))): ?>
                <tr>
                  <?php
                  $cash_total = $register_details->expected_cash;
                  ?>
                  <th colspan="4" class="text-center"><?php echo app('translator')->get('sale.cash_difference'); ?></th>
                  <td><span class="cash_difference display_currency" data-currency_symbol="true" data-orig-value="<?php echo e($cash_total, false); ?>"> <?php echo e(number_format(-1*$cash_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></td>
                </tr>
                <?php
                  $card_total = $register_details->total_card - $register_details->total_card_refund + $register_details->total_sub_card - $register_details->total_sub_card_refund + $register_details->total_card_ad - $register_details->total_card_ad_refund;
                ?>
                <tr>
                  <th colspan="4" class="text-center"><?php echo app('translator')->get('sale.card_difference'); ?></th>
                  <td><span class="card_difference display_currency" data-currency_symbol="true" data-orig-value="<?php echo e($card_total, false); ?>"><?php echo e(number_format(-1*$card_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></td>
                </tr>
                <?php
                  $bank_total = $register_details->total_bank_transfer - $register_details->total_bank_transfer_refund + $register_details->total_sub_bank_transfer - $register_details->total_sub_bank_transfer_refund + $register_details->total_sub_bank_transfer_ad - $register_details->total_sub_bank_transfer_refund;
                ?>
                <tr>
                  <th colspan="4" class="text-center"><?php echo app('translator')->get('sale.bank_transfer_difference'); ?></th>
                  <td><span class="bank_transfer_difference display_currency" data-currency_symbol="true" data-orig-value="<?php echo e($bank_total, false); ?>"><?php echo e(number_format(-1*$bank_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></td>
                </tr>
                <tr>
                  <th colspan="4" class="text-center"><?php echo app('translator')->get('sale.net_difference'); ?></th>
                  <td><span class="net_difference display_currency" data-currency_symbol="true"><?php echo e(number_format(-1*$cash_total + -1*$card_total + -1*$bank_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></td>
                </tr>
                <?php endif; ?>
              </tfoot>
            </table>
          <?php else: ?>
            <p class="help-block"><?php echo app('translator')->get('lang_v1.denomination_add_help_text'); ?></p>
          <?php endif; ?>
        </div>
        
        <div class="col-sm-12">
          <div class="mb-3">
            <?php echo Form::label('closing_note', __( 'cash_register.closing_note' ) . ':'); ?>

              <?php echo Form::textarea('closing_note', null, ['class' => 'form-control', 'placeholder' => __( 'cash_register.closing_note' ), 'rows' => 3 ]); ?>

          </div>
        </div>
      </div> 

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
      <input type="hidden" name="is_print" id="is_print" value="0">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.cancel' ); ?></button>
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'cash_register.close_register' ); ?></button>
      <button type="submit" class="btn btn-warning" id="save_and_print_btn" onclick="document.getElementById('is_print').value = 1;"><?php echo app('translator')->get( 'cash_register.close_and_print' ); ?></button>
    </div>
    <?php echo Form::close(); ?>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script type="text/javascript">
  $('#close_register_form').on('keyup keypress', 'input', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
      e.preventDefault();
      return false;
    }
  });
</script>
