<?php
	$subtype = '';
	$is_admin = auth()->user()->hasRole('Admin#'.auth()->user()->business_id) ? true : false;
	$rt_total = 0;
	if (!is_array($user_settings ?? null)) {
		$user_settings = !empty($user_settings) ? json_decode($user_settings, true) : [];
		$user_settings = is_array($user_settings) ? $user_settings : [];
	}
?>
<?php if(!empty($transaction_sub_type)): ?>
	<?php
		$subtype = '?sub_type='.$transaction_sub_type;
	?>
<?php endif; ?>

<?php if(!empty($transactions)): ?>
	<div class="pre-scrollable">
		<table class="table table-slim no-border rt-selectable-table">
			<?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
						$bg_color = '';
						if($transaction->sub_status == 'table_order_bill'){
							$bg_color = 'bg-green';
						}
						if($transaction->sub_status == 'table_order_final'){
							$bg_color = 'bg-info';
						}

						// Build action data attributes
						$can_edit = auth()->user()->can('sell.update') || auth()->user()->can('direct_sell.update') || ($transaction->status == 'draft' && auth()->user()->can('draft.update'));
						$can_delete = auth()->user()->can('sell.delete') || auth()->user()->can('direct_sell.delete') || ($transaction->status == 'draft' && auth()->user()->can('draft.delete'));
						$needs_approval_edit = !$can_edit;
						$needs_approval_delete = !$can_delete;
						$can_payment = !auth()->user()->can('sell.update') && auth()->user()->can('edit_pos_payment');
						$can_print = auth()->user()->can('reprint_invoice');
						$needs_approval_print = !$can_print;
						$is_admin = auth()->user()->hasRole('Admin#'.auth()->user()->business_id);
						$can_kot = (($transaction->sub_type == 'Takeaway' || $transaction->sub_type == 'Takeaway 2' || $transaction->sub_type == 'Takeaway 3') && (!auth()->user()->can('table.reprint_kot') || $is_admin));

						if(!empty($transaction->fbr_invoice_no) || !empty($transaction->pra_invoice_no)){
							$can_edit = false;
							$can_delete = false;
						}

						$display_total = $transaction->recent_display_total ?? $transaction->final_total;
						$draft_status_label = '';
						$draft_status_class = 'bg-info';
						if($transaction->status == 'draft' && !empty($transaction->draft_status)){
							$draft_status_label = $transaction->draft_status == 'cancelled' ? __('restaurant.cancelled') : __('lang_v1.' . $transaction->draft_status);
							if($transaction->draft_status == 'autosaved'){
								$draft_status_class = 'bg-success';
							}
						}
					?>
				<tr class="cursor-pointer rt-row <?php echo e($bg_color, false); ?>"
					data-transaction-id="<?php echo e($transaction->id, false); ?>"
					data-loc-id="<?php echo e($transaction->location_id, false); ?>"
					data-status="<?php echo e($transaction->status, false); ?>"
					data-sub-status="<?php echo e($transaction->sub_status ?? '', false); ?>"
					data-edit-url="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'edit'], [$transaction->id]).'?status='.$transaction->status, false); ?>"
					data-delete-url="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'destroy'], [$transaction->id]), false); ?>"
					data-print-url="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'printInvoice'], [$transaction->id]), false); ?>"
					<?php if($can_payment): ?>
					data-payment-url="<?php echo e(route('edit-pos-payment', ['id' => $transaction->id]), false); ?>"
					<?php endif; ?>
					<?php if($can_kot): ?>
					data-kot-url="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'printKOT'], [$transaction->id]), false); ?>"
					<?php endif; ?>
					data-can-edit="<?php echo e($can_edit ? 1 : 0, false); ?>"
					data-can-delete="<?php echo e($can_delete ? 1 : 0, false); ?>"
					data-can-print="<?php echo e($can_print ? 1 : 0, false); ?>"
					data-can-payment="<?php echo e($can_payment ? 1 : 0, false); ?>"
					data-can-kot="<?php echo e($can_kot ? 1 : 0, false); ?>"
					data-needs-approval-edit="<?php echo e($needs_approval_edit ? 1 : 0, false); ?>"
					data-needs-approval-delete="<?php echo e($needs_approval_delete ? 1 : 0, false); ?>"
					data-needs-approval-print="<?php echo e($needs_approval_print ? 1 : 0, false); ?>"
					title="Customer: <?php echo e($transaction->contact?->full_name_with_business, false); ?> 
						<?php if(!empty($transaction->contact->mobile) && $transaction->contact->is_default == 0): ?>
							<br/>Mobile: <?php echo e($transaction->contact->mobile, false); ?>

						<?php endif; ?>
					" >
					<td class="rt-checkbox-cell">
						<input type="checkbox" class="rt-row-check form-check-input" />
					</td>
					<td>
						<?php echo e($loop->iteration, false); ?>.
					</td>
					<td class="transaction_date" data-orig="<?php echo e($transaction->transaction_date, false); ?>">
						<?php echo format_datetime_br($transaction->transaction_date); ?>

					</td>
					<?php if($kitchen): ?>
					<td>
						<?php echo e(!empty($transaction->res_order_status) ? ucwords($transaction->res_order_status) : 'Sent', false); ?>

					</td>
					<?php endif; ?>
					
					<td>
						<?php echo e($transaction->invoice_no, false); ?> <?php if(empty($transaction->sub_status)): ?> (<?php echo e($transaction->contact?->full_name_with_business, false); ?>) <?php endif; ?>
						<?php if(!empty($draft_status_label)): ?>
							<span class="badge <?php echo e($draft_status_class, false); ?> ms-2"><?php echo e($draft_status_label, false); ?></span>
						<?php endif; ?>
						<?php if(!empty($transaction->sub_type)): ?>
							- <?php echo e($transaction->sub_type, false); ?>

						<?php endif; ?>
						<?php if(!empty($transaction->table)): ?>
							- <?php echo e($transaction->table->name, false); ?>

						<?php endif; ?>
					</td>
					<td class="display_currency rt-amount-cell">
						<?php echo e($display_total, false); ?>

					</td>
				</tr>
				<?php 
					$rt_total += $display_total;
				?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
	</div>
	<?php if(empty($user_settings['disable_recent_transaction_total'])): ?>
	<hr>
	<p class="rt-total-summary">
		<span><b>Total</b> :</span>
		<span class="rt-total-amount"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $rt_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
	</p>
	<?php endif; ?>
<?php else: ?>
	<p><?php echo app('translator')->get('sale.no_recent_transactions'); ?></p>
<?php endif; ?>
