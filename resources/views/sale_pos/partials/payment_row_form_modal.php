<div class="payment-row-modal-form mb-3">
	<input type="hidden" class="payment_row_index" value="<?php echo e($row_index, false); ?>">
	<?php
		$col_class = 'col';
		// if(!empty($accounts)){
		// 	$col_class = 'col-md-3';
		// }
		$readonly = $payment_line['method'] == 'advance' ? true : false;
		// $edit_readonly = $payment_line['method'] == 'advance' || !empty($payment_line['amount']) ? true : false;
		$edit_readonly = $readonly;
		if(!empty($sell_multipay)){
			unset($payment_types['multipay']);
		}
		$_payment_method = empty($payment_line['method']) && array_key_exists('cash', $payment_types) ? 'cash' : $payment_line['method'];
	?>
	<div class="modal_payment_type_row" data-method="<?php echo e($_payment_method, false); ?>">
		<div class="<?php echo e($col_class, false); ?>">
			<div class="input-group mb-1">
				<button type="button" data-row-index="<?php echo e($row_index, false); ?>" class="btn btn-outline-secondary pay_modal_payment_type_btn"><?php echo e($payment_types[$_payment_method], false); ?></button>
				<?php echo Form::hidden("payment[$row_index][method]", $payment_line['method'], ['required', 'id' => "method_$row_index"]); ?>

				<?php if(!empty($payment_line['id'])): ?>
				<?php echo Form::hidden("payment[$row_index][payment_id]", $payment_line['id'], ['required', 'id' => "method_$row_index"]); ?>

				<?php endif; ?>
				<?php if(!empty($accounts)): ?>
					<?php echo Form::hidden("payment[$row_index][account_id]", $payment_line['account_id'], ['class' => 'form-control', 'id' => "account_id", 'style' => 'width:100%;']); ?>

				<?php endif; ?>
				<?php if(empty($hide_amount)): ?>
					<?php echo Form::text("payment[$row_index][amount]", number_format($payment_line['amount'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control payment-amount input_number', 'required', 'id' => "amount_$row_index", 'placeholder' => __('sale.amount'), 'readonly' => $edit_readonly]); ?>

					<span class="input-group-text">
						<i class="fas fa-money-bill-alt"></i>
					</span>
				<?php endif; ?>
			</div>
		</div>

	<?php
		$pos_settings = !empty(session()->get('business.pos_settings')) ? json_decode(session()->get('business.pos_settings'), true) : [];
	?>
		
		<?php if(!empty($pos_settings['enable_payment_note'])): ?>
		<div class="col-md-12">
			<div class="mb-3">
				<?php echo Form::label("note_$row_index", __('sale.payment_note') . ':'); ?>

				<?php echo Form::textarea("payment[$row_index][note]", $payment_line['note'], ['class' => 'form-control', 'rows' => 3, 'id' => "note_$row_index"]); ?>

			</div>
		</div>
		<?php endif; ?>
	</div>
</div>
