<style>
.custom-btn-height {
    height: 65px; /* Adjust as needed */
}
</style>

<?php
	$is_mobile = isMobile();
	$is_admin = auth()->user()->hasRole('Admin#'.auth()->user()->business_id) ? true : false;
	$is_suggestion = ($pos_settings[$default_location->id]['hide_product_suggestion'] == 1);
	$is_quick_menu = ($pos_settings[$default_location->id]['hide_product_suggestion'] == 2);
	$pos_split_label = function ($key) {
		return str_replace(' ', '<br>', e(__($key)));
	};
?>
<div class="<?php if(!$is_quick_menu): ?> bg-pos-actions <?php endif; ?> <?php if($is_suggestion): ?> bg-pos-actions-suggestion <?php endif; ?> <?php if($is_quick_menu): ?> bg-pos-actions-qm <?php endif; ?>">
	<div class="pos-form-actions <?php if(!$is_quick_menu): ?> bg-white <?php endif; ?> <?php if($is_suggestion): ?> pos-form-actions-suggestion <?php elseif(!$is_quick_menu): ?> pos-form-actions-simple <?php elseif($is_quick_menu): ?> pos-form-actions-qm <?php else: ?> row <?php endif; ?>" <?php if($is_quick_menu): ?> style="position: relative;" <?php endif; ?>>
		
		<?php if($is_suggestion): ?>
		
		
		<div class="suggestion-footer-wrapper">
			
			<div class="suggestion-footer-left" id="pos-actions">
				<div class="suggestion-summary">
					<div class="suggestion-summary-row">
						<span class="summary-label"><?php echo app('translator')->get('lang_v1.total_quantity'); ?>:</span>
						<span class="summary-value total_quantity">0</span>
					</div>
					<div class="suggestion-summary-row" style="flex-direction: column">
						<?php if(!empty($pos_settings['enable_discount_column'])): ?>
						<div>
							<span class="summary-label"><?php echo app('translator')->get('sale.discount'); ?>:</span>
							<span class="summary-value total_discounts">0</span>
						</div>
						<?php endif; ?>
						<?php if(!empty($pos_settings['enable_inline_tax_pos']) && $taxes['tax_rates']->count() > 1): ?>
						<div>
							<span class="summary-label"><?php echo app('translator')->get('sale.tax'); ?>:</span>
							<span class="summary-value total_tax">0</span>
						</div>
						<?php endif; ?>
					</div>
					<div class="suggestion-summary-row" style="flex-direction: column">
						<?php if(in_array('types_of_service', $enabled_modules)): ?>
						<div>
							<span class="summary-label"><?php echo app('translator')->get('lang_v1.service_charge'); ?>:</span>
							<span class="summary-value" id="packing_charge_text">0</span>
						</div>
						<?php endif; ?>
						<?php if($pos_settings['disable_shipping'] == 0): ?>
						<div>
							<span class="summary-label"><?php echo app('translator')->get('sale.shipping'); ?>:
								<i class="fas fa-edit cursor-pointer" id="pos-edit-shipping" title="<?php echo app('translator')->get('lang_v1.edit_shipping'); ?>" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#posShippingModal"></i>
							</span>
							<span class="summary-value" id="shipping_charges_amount">0</span>
						</div>
						<?php endif; ?>
					</div>
			
				</div>
				
				<div class="suggestion-totals-inputs">
					<?php echo $__env->make('sale_pos.partials.pos_form_totals' , ['edit' => $edit], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
			</div>

			
			<div class="suggestion-footer-right" id="pos-actions">
				<input type="hidden" name="is_credit_sale" value="0" id="is_credit_sale">
				<input type="hidden" name="is_dojo_payment" value="0" id="is_dojo_payment">

				<?php if(empty($pos_settings['disable_credit_sale_button'])): ?>
					<?php if(auth()->user()->can('payment_btn.hide_credit_sale') != 1 || $is_admin): ?>
						<button type="button" class="btn btn-suggestion btn-flat bg-purple no-print pos-express-finalize" 
							data-pay_method="credit_sale"
							title="<?php echo app('translator')->get('lang_v1.tooltip_credit_sale'); ?>" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
							<i class="fas fa-check" aria-hidden="true"></i>
							<span class="btn-label-text"><?php echo $pos_split_label('lang_v1.credit_sale'); ?></span>
							<span class="btn-short-text">CS</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<div class="btn btn-suggestion btn-flat bg-navy" style="display: inline-flex;gap:6px;justify-content:center;align-content:center">
					<span class="summary-label" style="font-size: 0.70em"><?php echo app('translator')->get('sale.total'); ?> <br> <?php echo app('translator')->get('sale.payable'); ?>:</span>
					<input type="hidden" name="final_total" id="final_total_input" value=0>
					<br>
					<span class="summary-value" id="total_payable" style="font-size: 1.5em">0</span>
					<span class="summary-value change_return_preview_span hide">0</span>
				</div>

				<?php if($is_discount_enabled): ?>
				<button type="button" class="btn btn-suggestion btn-flat bg-warning text-white" id="pos-edit-discount" title="<?php echo app('translator')->get('sale.edit_discount'); ?>" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#posEditDiscountModal" style="display: inline-flex;gap:6px;justify-content:center;align-content:center">
					<span class="summary-label" style="font-size: 0.70em">Bill <br> Discount:</span>
					<br>
					<span class="summary-value total_inv_discount" style="font-size: 1.5em">0</span>
				</button>
				<?php endif; ?>

				<?php if($pos_settings['disable_invoice_tax'] == 0): ?>
				<button type="button" class="btn btn-suggestion btn-flat bg-danger text-white" id="pos-edit-tax" title="<?php echo app('translator')->get('sale.edit_order_tax'); ?>" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#posEditOrderTaxModal">
					<i class="fas fa-scale-balanced"></i> :
					
					
					<span class="summary-value" id="order_tax"><?php if(empty($edit)): ?> 0 <?php else: ?> <?php echo e($transaction->tax_amount, false); ?> <?php endif; ?></span>
				</button>
				<?php endif; ?>

				<?php if(empty($pos_settings['disable_draft_button']) && (empty($edit) || $transaction->status == 'draft')): ?>
					<?php if(auth()->user()->can('payment_btn.hide_draft') != 1 || $is_admin || auth()->user()->can('draft.view_all') || auth()->user()->can('draft.view_own')): ?>
						<button type="button" class="btn btn-suggestion btn-flat bg-info text-white <?php if($pos_settings['disable_draft'] != 0): ?> hide <?php endif; ?>" id="pos-draft" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
							<i class="fas fa-edit"></i>
							<span class="btn-label-text"><?php if($edit && $transaction->status == 'draft'): ?> <?php echo app('translator')->get('lang_v1.update'); ?> <?php else: ?> <?php echo app('translator')->get('sale.draft'); ?> <?php endif; ?></span>
							<span class="btn-short-text">DR</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(empty($pos_settings['disable_quotation_button'])): ?>
					<?php if(auth()->user()->can('payment_btn.hide_quotation') != 1 || $is_admin): ?>
						<button type="button" class="btn btn-suggestion btn-flat bg-yellow" id="pos-quotation" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
							<i class="fas fa-edit"></i>
							<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.quotation'); ?></span>
							<span class="btn-short-text">QT</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(empty($pos_settings['disable_suspend'])): ?>
					<?php if(auth()->user()->can('payment_btn.hide_suspend') != 1 || $is_admin): ?>
						<button type="button" class="btn btn-suggestion btn-flat bg-red no-print pos-express-finalize" 
							data-pay_method="suspend"
							title="<?php echo app('translator')->get('lang_v1.tooltip_suspend'); ?>" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
							<i class="fas fa-pause" aria-hidden="true"></i>
							<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.suspend'); ?></span>
							<span class="btn-short-text">SS</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(!$pos_payments_disabled): ?>
				<?php if(!empty($pos_settings['dojo_api_key'])): ?>
					<button type="button" class="btn btn-suggestion btn-flat bg-purple no-print pos-express-finalize" 
						data-pay_method="dojo_payment"
						title="<?php echo app('translator')->get('lang_v1.dojo'); ?>" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
						<i class="fas fa-credit-card" aria-hidden="true"></i>
						<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.dojo'); ?></span>
						<span class="btn-short-text">DJ</span>
					</button>
				<?php endif; ?>

				<?php if(auth()->user()->can('payment_btn.hide_multipay') != 1 || $is_admin || $edit): ?>
					<button type="button" class="btn btn-suggestion btn-flat bg-navy no-print <?php if($pos_settings['disable_pay_checkout'] != 0 && !$edit): ?> hide <?php endif; ?>" 
						id="pos-finalize" title="<?php echo app('translator')->get('lang_v1.tooltip_checkout_multi_pay'); ?>">
						<i class="fas fa-money-check-alt" aria-hidden="true"></i>
						<span class="btn-label-text"><?php echo $pos_split_label('lang_v1.checkout_multi_pay'); ?></span>
						<span class="btn-short-text">MP</span>
					</button>
				<?php endif; ?>

				<?php if(empty($pos_settings['disable_card_button'])): ?>
					<?php if((auth()->user()->can('payment_btn.hide_card') != 1 || $is_admin) && !$edit): ?>
						<button type="button" class="btn btn-suggestion btn-flat bg-maroon no-print pos-express-finalize <?php if(!array_key_exists('card', $payment_types)): ?> hide <?php endif; ?>" 
							data-pay_method="card"
							title="<?php echo app('translator')->get('lang_v1.tooltip_express_checkout_card'); ?>">
							<i class="fas fa-credit-card" aria-hidden="true"></i>
							<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.express_checkout_card'); ?></span>
							<span class="btn-short-text">CR</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if((auth()->user()->can('payment_btn.hide_cash') != 1 || $is_admin) && !$edit): ?>
					<button type="button" class="btn btn-suggestion btn-flat bg-lime no-print pos-express-finalize <?php if($pos_settings['disable_express_checkout'] != 0 || !array_key_exists('cash', $payment_types)): ?> hide <?php endif; ?>" 
						data-pay_method="cash" title="<?php echo app('translator')->get('tooltip.express_checkout'); ?>">
						<i class="fas fa-money-bill-alt" aria-hidden="true"></i>
						<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.express_checkout_cash'); ?></span>
						<span class="btn-short-text">EC</span>
					</button>
				<?php endif; ?>
				<?php endif; ?> 

				
				<?php if($pos_settings['enable_takeaway']): ?>
					<?php if((auth()->user()->can('payment_btn.hide_takeaway') != 1 || $is_admin) && (!$edit || ($edit && $transaction->status == 'draft'))): ?>
						<button type="button" class="btn btn-suggestion btn-flat btn-takeaway-1 no-print" id="pos-takeaway-finalize" 
							title="<?php echo app('translator')->get('lang_v1.tooltip_checkout_takeway'); ?>" 
							<?php if($pos_settings['takeaway_as_credit']): ?> data-pay_method="credit_sale" <?php endif; ?>
							data-enable_seperate_kot_qty="<?php echo e(!empty($pos_settings['takeaway_enable_seperate_kot_qty']) ? 1 : 0, false); ?>"
							data-enable_only_print_kot="<?php echo e(!empty($pos_settings['takeaway_enable_only_print_kot']) ? 1 : 0, false); ?>"
							data-takeaway='1'>
							<i class="fas fa-shopping-bag" aria-hidden="true"></i>
							<span class="btn-label-text">
								<?php if(!empty($pos_settings['enable_takeaway_label'])): ?>
									<?php echo e($pos_settings['enable_takeaway_label'], false); ?>

								<?php else: ?> 
									<?php echo app('translator')->get('lang_v1.takeaway_label'); ?> 
								<?php endif; ?>
							</span>
							<span class="btn-short-text">TA</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if($pos_settings['enable_takeaway_2']): ?>
					<?php if((auth()->user()->can('payment_btn.hide_takeaway') != 1 || $is_admin) && (!$edit || ($edit && $transaction->status == 'draft'))): ?>
						<button type="button" class="btn btn-suggestion btn-flat btn-takeaway-2 no-print" id="pos-takeaway-finalize" 
							title="<?php echo app('translator')->get('lang_v1.tooltip_checkout_takeway_credit'); ?>"
							<?php if($pos_settings['takeaway_2_as_credit']): ?> data-pay_method="credit_sale" <?php endif; ?>
							data-enable_seperate_kot_qty="<?php echo e(!empty($pos_settings['takeaway_2_enable_seperate_kot_qty']) ? 1 : 0, false); ?>"
							data-enable_only_print_kot="<?php echo e(!empty($pos_settings['takeaway_2_enable_only_print_kot']) ? 1 : 0, false); ?>"
							data-takeaway='2'>
							<i class="fas fa-motorcycle" aria-hidden="true"></i>
							<span class="btn-label-text">
								<?php if(!empty($pos_settings['enable_takeaway_2_label'])): ?>
									<?php echo e($pos_settings['enable_takeaway_2_label'], false); ?>

								<?php else: ?> 
									<?php echo app('translator')->get('lang_v1.takeaway_label'); ?> 2
								<?php endif; ?>
							</span>
							<span class="btn-short-text">TA2</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if($pos_settings['enable_takeaway_3']): ?>
					<?php if((auth()->user()->can('payment_btn.hide_takeaway') != 1 || $is_admin) && (!$edit || ($edit && $transaction->status == 'draft'))): ?>
						<button type="button" class="btn btn-suggestion btn-flat btn-takeaway-3 no-print" id="pos-takeaway-finalize" 
							title="<?php echo app('translator')->get('lang_v1.tooltip_checkout_takeway_credit'); ?>"
							<?php if($pos_settings['takeaway_3_as_credit']): ?> data-pay_method="credit_sale" <?php endif; ?>
							data-enable_seperate_kot_qty="<?php echo e(!empty($pos_settings['takeaway_3_enable_seperate_kot_qty']) ? 1 : 0, false); ?>"
							data-enable_only_print_kot="<?php echo e(!empty($pos_settings['takeaway_3_enable_only_print_kot']) ? 1 : 0, false); ?>"
							data-takeaway='3'>
							<i class="fas fa-truck" aria-hidden="true"></i>
							<span class="btn-label-text">
								<?php if(!empty($pos_settings['enable_takeaway_3_label'])): ?>
									<?php echo e($pos_settings['enable_takeaway_3_label'], false); ?>

								<?php else: ?> 
									<?php echo app('translator')->get('lang_v1.takeaway_label'); ?> 3
								<?php endif; ?>
							</span>
							<span class="btn-short-text">TA3</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(empty($edit)): ?>
					<button type="button" class="btn btn-suggestion btn-flat btn-danger" id="pos-cancel">
						<i class="fas fa-window-close"></i>
						<span class="btn-label-text"><?php echo app('translator')->get('sale.cancel'); ?></span>
						<span class="btn-short-text">CL</span>
					</button>
				<?php else: ?>
					<button type="button" class="btn btn-suggestion btn-flat btn-danger hide" id="pos-delete" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
						<i class="fas fa-trash-alt"></i>
						<span class="btn-label-text"><?php echo app('translator')->get('messages.delete'); ?></span>
						<span class="btn-short-text">DL</span>
					</button>
				<?php endif; ?>

				<?php if(!isset($user_settings['hide_recent_trans']) || $user_settings['hide_recent_trans'] == 0): ?>
					<button type="button" class="btn btn-suggestion btn-flat btn-primary" data-bs-toggle="modal" data-bs-target="#recent_transactions_modal" id="recent-transactions">
						<i class="fas fa-clock"></i>
						<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.recent'); ?></span>
						<span class="btn-short-text">RT</span>
					</button>
				<?php endif; ?>

				<input type="hidden" name="enable_seperate_kot_qty" id="enable_seperate_kot_qty" value="">
				<input type="hidden" name="enable_only_print_kot" id="enable_only_print_kot" value="">
			</div>
		</div>

		<?php elseif(!$is_quick_menu): ?>
		
		
		<div class="simple-footer-wrapper">
			
			<div class="simple-footer-left" id="pos-actions">
				<div class="simple-summary">
					<div class="simple-summary-row">
							<span class="summary-label"><?php echo app('translator')->get('lang_v1.total_quantity'); ?>:</span>
							<span class="summary-value total_quantity">0</span>
					</div>
					<div class="simple-summary-row" style="flex-direction: column">
						<?php if(!empty($pos_settings['enable_discount_column'])): ?>
						<div>
							<span class="summary-label"><?php echo app('translator')->get('sale.discount'); ?>:</span>
							<span class="summary-value total_discounts">0</span>
						</div>
						<?php endif; ?>
						<?php if(!empty($pos_settings['enable_inline_tax_pos']) && $taxes['tax_rates']->count() > 1): ?>
						<div>
							<span class="summary-label"><?php echo app('translator')->get('sale.tax'); ?>:</span>
							<span class="summary-value total_tax">0</span>
						</div>
						<?php endif; ?>
					</div>
					<div class="simple-summary-row" style="flex-direction: column">
						<?php if(in_array('types_of_service', $enabled_modules)): ?>
						<div>
							<span class="summary-label"><?php echo app('translator')->get('lang_v1.service_charge'); ?>:</span>
							<span class="summary-value" id="packing_charge_text">0</span>
						</div>
						<?php endif; ?>
						<?php if($pos_settings['disable_shipping'] == 0): ?>
						<div>
							<span class="summary-label"><?php echo app('translator')->get('sale.shipping'); ?>:
								<i class="fas fa-edit cursor-pointer" id="pos-edit-shipping" title="<?php echo app('translator')->get('lang_v1.edit_shipping'); ?>" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#posShippingModal"></i>
							</span>
							<span class="summary-value" id="shipping_charges_amount">0</span>
						</div>
						<?php endif; ?>
					</div>

				</div>
				
				<div class="simple-totals-inputs">
					<?php echo $__env->make('sale_pos.partials.pos_form_totals' , ['edit' => $edit], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
			</div>

			
			<div class="simple-footer-right" id="pos-actions">
				<input type="hidden" name="is_credit_sale" value="0" id="is_credit_sale">
				<input type="hidden" name="is_dojo_payment" value="0" id="is_dojo_payment">

				<?php if(empty($pos_settings['disable_credit_sale_button'])): ?>
					<?php if(auth()->user()->can('payment_btn.hide_credit_sale') != 1 || $is_admin): ?>
						<button type="button" class="btn btn-simple btn-flat bg-purple no-print pos-express-finalize" 
							data-pay_method="credit_sale"
							title="<?php echo app('translator')->get('lang_v1.tooltip_credit_sale'); ?>" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
							<i class="fas fa-check" aria-hidden="true"></i>
							<span class="btn-label-text"><?php echo $pos_split_label('lang_v1.credit_sale'); ?></span>
							<span class="btn-short-text">CS</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<div class="btn btn-simple btn-flat bg-navy">
					<span class="summary-label" style="font-size: 0.70em"><?php echo app('translator')->get('sale.total'); ?> <br> <?php echo app('translator')->get('sale.payable'); ?>:</span>
					<input type="hidden" name="final_total" id="final_total_input" value=0>
					<br>
					<span class="summary-value" id="total_payable" style="font-size: 1.5em">0</span>
					<span class="summary-value change_return_preview_span hide">0</span>
				</div>

				<?php if($is_discount_enabled): ?>
				<button type="button" class="btn btn-simple btn-flat bg-warning text-white" id="pos-edit-discount" title="<?php echo app('translator')->get('sale.edit_discount'); ?>" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#posEditDiscountModal" style="display: inline-flex;gap:6px;justify-content:center;align-content:center">
					<span class="summary-label" style="font-size: 0.70em">Bill <br> Discount:</span>
					<br>
					<span class="summary-value total_inv_discount" style="font-size: 1.5em">0</span>
				</button>
				<?php endif; ?>

				<?php if($pos_settings['disable_invoice_tax'] == 0): ?>
				<button type="button" class="btn btn-simple btn-flat bg-danger text-white" id="pos-edit-tax" title="<?php echo app('translator')->get('sale.edit_order_tax'); ?>" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#posEditOrderTaxModal">
					<i class="fas fa-scale-balanced"></i> :
					
					
					<span class="summary-value" id="order_tax"><?php if(empty($edit)): ?> 0 <?php else: ?> <?php echo e($transaction->tax_amount, false); ?> <?php endif; ?></span>
				</button>
				<?php endif; ?>

				<?php if(empty($pos_settings['disable_draft_button']) && (empty($edit) || $transaction->status == 'draft')): ?>
					<?php if(auth()->user()->can('payment_btn.hide_draft') != 1 || $is_admin || auth()->user()->can('draft.view_all') || auth()->user()->can('draft.view_own')): ?>
						<button type="button" class="btn btn-simple btn-flat bg-info text-white <?php if($pos_settings['disable_draft'] != 0): ?> hide <?php endif; ?>" id="pos-draft" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
							<i class="fas fa-edit"></i>
							<span class="btn-label-text"><?php if($edit && $transaction->status == 'draft'): ?> <?php echo app('translator')->get('lang_v1.update'); ?> <?php else: ?> <?php echo app('translator')->get('sale.draft'); ?> <?php endif; ?></span>
							<span class="btn-short-text">DR</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(empty($pos_settings['disable_quotation_button'])): ?>
					<?php if(auth()->user()->can('payment_btn.hide_quotation') != 1 || $is_admin): ?>
						<button type="button" class="btn btn-simple btn-flat bg-yellow" id="pos-quotation" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
							<i class="fas fa-edit"></i>
							<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.quotation'); ?></span>
							<span class="btn-short-text">QT</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(empty($pos_settings['disable_suspend'])): ?>
					<?php if(auth()->user()->can('payment_btn.hide_suspend') != 1 || $is_admin): ?>
						<button type="button" class="btn btn-simple btn-flat bg-red no-print pos-express-finalize" 
							data-pay_method="suspend"
							title="<?php echo app('translator')->get('lang_v1.tooltip_suspend'); ?>" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
							<i class="fas fa-pause" aria-hidden="true"></i>
							<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.suspend'); ?></span>
							<span class="btn-short-text">SS</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(!$pos_payments_disabled): ?>
				<?php if(!empty($pos_settings['dojo_api_key'])): ?>
					<button type="button" class="btn btn-simple btn-flat bg-purple no-print pos-express-finalize" 
						data-pay_method="dojo_payment"
						title="<?php echo app('translator')->get('lang_v1.dojo'); ?>" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
						<i class="fas fa-credit-card" aria-hidden="true"></i>
						<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.dojo'); ?></span>
						<span class="btn-short-text">DJ</span>
					</button>
				<?php endif; ?>

				<?php if(auth()->user()->can('payment_btn.hide_multipay') != 1 || $is_admin || $edit): ?>
					<button type="button" class="btn btn-simple btn-flat bg-navy no-print <?php if($pos_settings['disable_pay_checkout'] != 0 && !$edit): ?> hide <?php endif; ?>" 
						id="pos-finalize" title="<?php echo app('translator')->get('lang_v1.tooltip_checkout_multi_pay'); ?>">
						<i class="fas fa-money-check-alt" aria-hidden="true"></i>
						<span class="btn-label-text"><?php echo $pos_split_label('lang_v1.checkout_multi_pay'); ?></span>
						<span class="btn-short-text">MP</span>
					</button>
				<?php endif; ?>

				<?php if(empty($pos_settings['disable_card_button'])): ?>
					<?php if((auth()->user()->can('payment_btn.hide_card') != 1 || $is_admin) && !$edit): ?>
						<button type="button" class="btn btn-simple btn-flat bg-maroon no-print pos-express-finalize <?php if(!array_key_exists('card', $payment_types)): ?> hide <?php endif; ?>" 
							data-pay_method="card"
							title="<?php echo app('translator')->get('lang_v1.tooltip_express_checkout_card'); ?>">
							<i class="fas fa-credit-card" aria-hidden="true"></i>
							<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.express_checkout_card'); ?></span>
							<span class="btn-short-text">CR</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if((auth()->user()->can('payment_btn.hide_cash') != 1 || $is_admin) && !$edit): ?>
					<button type="button" class="btn btn-simple btn-flat bg-lime no-print pos-express-finalize <?php if($pos_settings['disable_express_checkout'] != 0 || !array_key_exists('cash', $payment_types)): ?> hide <?php endif; ?>" 
						data-pay_method="cash" title="<?php echo app('translator')->get('tooltip.express_checkout'); ?>">
						<i class="fas fa-money-bill-alt" aria-hidden="true"></i>
						<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.express_checkout_cash'); ?></span>
						<span class="btn-short-text">EC</span>
					</button>
				<?php endif; ?>
				<?php endif; ?> 

				
				<?php if($pos_settings['enable_takeaway']): ?>
					<?php if((auth()->user()->can('payment_btn.hide_takeaway') != 1 || $is_admin) && (!$edit || ($edit && $transaction->status == 'draft'))): ?>
						<button type="button" class="btn btn-simple btn-flat btn-takeaway-1 no-print" id="pos-takeaway-finalize" 
							title="<?php echo app('translator')->get('lang_v1.tooltip_checkout_takeway'); ?>" 
							<?php if($pos_settings['takeaway_as_credit']): ?> data-pay_method="credit_sale" <?php endif; ?>
							data-enable_seperate_kot_qty="<?php echo e(!empty($pos_settings['takeaway_enable_seperate_kot_qty']) ? 1 : 0, false); ?>"
							data-enable_only_print_kot="<?php echo e(!empty($pos_settings['takeaway_enable_only_print_kot']) ? 1 : 0, false); ?>"
							data-takeaway='1'>
							<i class="fas fa-shopping-bag" aria-hidden="true"></i>
							<span class="btn-label-text">
								<?php if(!empty($pos_settings['enable_takeaway_label'])): ?>
									<?php echo e($pos_settings['enable_takeaway_label'], false); ?>

								<?php else: ?> 
									<?php echo app('translator')->get('lang_v1.takeaway_label'); ?> 
								<?php endif; ?>
							</span>
							<span class="btn-short-text">TA</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if($pos_settings['enable_takeaway_2']): ?>
					<?php if((auth()->user()->can('payment_btn.hide_takeaway') != 1 || $is_admin) && (!$edit || ($edit && $transaction->status == 'draft'))): ?>
						<button type="button" class="btn btn-simple btn-flat btn-takeaway-2 no-print" id="pos-takeaway-finalize" 
							title="<?php echo app('translator')->get('lang_v1.tooltip_checkout_takeway_credit'); ?>"
							<?php if($pos_settings['takeaway_2_as_credit']): ?> data-pay_method="credit_sale" <?php endif; ?>
							data-enable_seperate_kot_qty="<?php echo e(!empty($pos_settings['takeaway_2_enable_seperate_kot_qty']) ? 1 : 0, false); ?>"
							data-enable_only_print_kot="<?php echo e(!empty($pos_settings['takeaway_2_enable_only_print_kot']) ? 1 : 0, false); ?>"
							data-takeaway='2'>
							<i class="fas fa-motorcycle" aria-hidden="true"></i>
							<span class="btn-label-text">
								<?php if(!empty($pos_settings['enable_takeaway_2_label'])): ?>
									<?php echo e($pos_settings['enable_takeaway_2_label'], false); ?>

								<?php else: ?> 
									<?php echo app('translator')->get('lang_v1.takeaway_label'); ?> 2
								<?php endif; ?>
							</span>
							<span class="btn-short-text">TA2</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if($pos_settings['enable_takeaway_3']): ?>
					<?php if((auth()->user()->can('payment_btn.hide_takeaway') != 1 || $is_admin) && (!$edit || ($edit && $transaction->status == 'draft'))): ?>
						<button type="button" class="btn btn-simple btn-flat btn-takeaway-3 no-print" id="pos-takeaway-finalize" 
							title="<?php echo app('translator')->get('lang_v1.tooltip_checkout_takeway_credit'); ?>"
							<?php if($pos_settings['takeaway_3_as_credit']): ?> data-pay_method="credit_sale" <?php endif; ?>
							data-enable_seperate_kot_qty="<?php echo e(!empty($pos_settings['takeaway_3_enable_seperate_kot_qty']) ? 1 : 0, false); ?>"
							data-enable_only_print_kot="<?php echo e(!empty($pos_settings['takeaway_3_enable_only_print_kot']) ? 1 : 0, false); ?>"
							data-takeaway='3'>
							<i class="fas fa-truck" aria-hidden="true"></i>
							<span class="btn-label-text">
								<?php if(!empty($pos_settings['enable_takeaway_3_label'])): ?>
									<?php echo e($pos_settings['enable_takeaway_3_label'], false); ?>

								<?php else: ?> 
									<?php echo app('translator')->get('lang_v1.takeaway_label'); ?> 3
								<?php endif; ?>
							</span>
							<span class="btn-short-text">TA3</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(empty($edit)): ?>
					<button type="button" class="btn btn-simple btn-flat btn-danger" id="pos-cancel">
						<i class="fas fa-window-close"></i>
						<span class="btn-label-text"><?php echo app('translator')->get('sale.cancel'); ?></span>
						<span class="btn-short-text">CL</span>
					</button>
				<?php else: ?>
					<button type="button" class="btn btn-simple btn-flat btn-danger hide" id="pos-delete" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
						<i class="fas fa-trash-alt"></i>
						<span class="btn-label-text"><?php echo app('translator')->get('messages.delete'); ?></span>
						<span class="btn-short-text">DL</span>
					</button>
				<?php endif; ?>

				<?php if(!isset($user_settings['hide_recent_trans']) || $user_settings['hide_recent_trans'] == 0): ?>
					<button type="button" class="btn btn-simple btn-flat btn-primary" data-bs-toggle="modal" data-bs-target="#recent_transactions_modal" id="recent-transactions">
						<i class="fas fa-clock"></i>
						<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.recent'); ?></span>
						<span class="btn-short-text">RT</span>
					</button>
				<?php endif; ?>

				<input type="hidden" name="enable_seperate_kot_qty" id="enable_seperate_kot_qty" value="">
				<input type="hidden" name="enable_only_print_kot" id="enable_only_print_kot" value="">
			</div>
		</div>

		<?php else: ?>
		
		
		<div class="qm-footer-wrapper">
			
			<div class="qm-footer-left <?php if(!$is_mobile): ?> hide <?php endif; ?>" id="-actions">
				<div class="qm-summary">
					<div class="qm-summary-row">
						<span class="summary-label"><?php echo app('translator')->get('lang_v1.total_quantity'); ?>:</span>
						<span class="summary-value total_quantity">0</span>
					</div>
					<?php if(!empty($pos_settings['enable_inline_tax_pos'])): ?>
					<div class="qm-summary-row">
						<span class="summary-label"><?php echo app('translator')->get('sale.tax'); ?>:</span>
						<span class="summary-value total_tax">0</span>
					</div>
					<?php endif; ?>
					<?php if($pos_settings['disable_invoice_tax'] == 0): ?>
					<div class="qm-summary-row">
						<span class="summary-label"><?php echo app('translator')->get('sale.order_tax'); ?> :
							<i class="fas fa-edit cursor-pointer" title="<?php echo app('translator')->get('sale.edit_order_tax'); ?>" aria-hidden="true"  data-bs-toggle="modal" data-bs-target="#posEditOrderTaxModal" id="pos-edit-tax" ></i> 
						</span>
						<span class="summary-value" id="order_tax"><?php if(empty($edit)): ?> 0 <?php else: ?> <?php echo e($transaction->tax_amount, false); ?> <?php endif; ?></span>
					</div>
					<?php endif; ?>
					<?php if(in_array('types_of_service', $enabled_modules)): ?>
					<div class="qm-summary-row">
						<span class="summary-label"><?php echo app('translator')->get('lang_v1.service_charge'); ?>:</span>
						
					</div>
					<?php endif; ?>
					<?php if($pos_settings['disable_shipping'] == 0): ?>
					<div class="qm-summary-row">
						<span class="summary-label"><?php echo app('translator')->get('sale.shipping'); ?>:</span>
						<span class="summary-value" id="shipping_charges_amount">0</span>
					</div>
					<?php endif; ?>
					<?php if(!empty($pos_settings['enable_discount_column'])): ?>
					<div class="qm-summary-row">
						<span class="summary-label"><?php echo app('translator')->get('sale.discount'); ?>:</span>
						<span class="summary-value total_discounts">0</span>
					</div>
					<?php endif; ?>
					<?php if($is_discount_enabled): ?>
					<div class="qm-summary-row">	
						<span class="summary-label"><?php echo app('translator')->get('sale.discount'); ?>:
						<i class="fas fa-edit cursor-pointer" id="pos-edit-discount" title="<?php echo app('translator')->get('sale.edit_discount'); ?>" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#posEditDiscountModal"></i>	
						</span>
						<span class="summary-value total_inv_discount">0</span>
					</div>
					<?php endif; ?>
				</div>
				
			</div>

			
			<div class="qm-footer-right" style="margin-top: 5px">
			<?php if($is_discount_enabled): ?>
				<button type="button" class="btn btn-qm btn-flat bg-warning text-white" id="pos-edit-discount" title="<?php echo app('translator')->get('sale.edit_discount'); ?>" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#posEditDiscountModal" style="display: inline-flex;gap:6px;justify-content:center;align-content:center">
					<span class="summary-label" style="font-size: 0.70em">Bill <br> Discount:</span>
					<br>
					<span class="summary-value total_inv_discount" style="font-size: 1.5em">0</span>
				</button>
				<?php endif; ?>

				<?php if($pos_settings['disable_invoice_tax'] == 0): ?>
				<button type="button" class="btn btn-qm btn-flat bg-danger text-white" id="pos-edit-tax" title="<?php echo app('translator')->get('sale.edit_order_tax'); ?>" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#posEditOrderTaxModal">
					<span class="btn-label-text"><i class="fas fa-scale-balanced"></i> <?php echo app('translator')->get('sale.order_tax'); ?>:</span>
					<span class="btn-short-text"><i class="fas fa-scale-balanced"></i> :</span>
					<span class="summary-value" id="order_tax"><?php if(empty($edit)): ?> 0 <?php else: ?> <?php echo e($transaction->tax_amount, false); ?> <?php endif; ?></span>
				</button>
				<?php endif; ?>

				<?php if($pos_settings['disable_shipping'] == 0): ?>
				<button type="button" class="btn btn-qm btn-flat bg-warning text-white" id="pos-edit-shipping" title="<?php echo app('translator')->get('lang_v1.edit_shipping'); ?>" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#posShippingModal">
					<span class="btn-label-text"><i class="fas fa-shipping-fast"></i> <?php echo app('translator')->get('sale.shipping'); ?>:</span>
					<span class="btn-short-text"><i class="fas fa-shipping-fast"></i> :</span>
					<span class="summary-value" id="shipping_charges_amount">0</span>
				</button>
				<?php endif; ?>

				<?php if(in_array('types_of_service', $enabled_modules)): ?>
				<button type="button" class="btn btn-qm btn-flat bg-danger text-white service_modal_btn" title="<?php echo app('translator')->get('lang_v1.service_charge'); ?>">
					<span class="btn-label-text"><i class="fas fa-box"></i> <?php echo app('translator')->get('lang_v1.service_charge'); ?>:</span>
					<span class="btn-short-text"><i class="fas fa-box"></i> :</span>
					<span class="summary-value" id="packing_charge_text">0</span>
				</button>
				<?php endif; ?>
			</div>
			<div class="qm-footer-right qm-pos-actions" id="pos-actions">
				<input type="hidden" name="is_credit_sale" value="0" id="is_credit_sale">
				<input type="hidden" name="is_dojo_payment" value="0" id="is_dojo_payment">

				<?php if(empty($pos_settings['disable_draft_button']) && (empty($edit) || $transaction->status == 'draft')): ?>
					<?php if(auth()->user()->can('payment_btn.hide_draft') != 1 || $is_admin || auth()->user()->can('draft.view_all') || auth()->user()->can('draft.view_own')): ?>
						<button type="button" class="btn btn-qm btn-flat bg-info text-white <?php if($pos_settings['disable_draft'] != 0): ?> hide <?php endif; ?>" id="pos-draft" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
							<i class="fas fa-edit"></i>
							<span class="btn-label-text"><?php if($edit && $transaction->status == 'draft'): ?> <?php echo app('translator')->get('lang_v1.update'); ?> <?php else: ?> <?php echo app('translator')->get('sale.draft'); ?> <?php endif; ?></span>
							<span class="btn-short-text">DR</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(empty($pos_settings['disable_quotation_button'])): ?>
					<?php if(auth()->user()->can('payment_btn.hide_quotation') != 1 || $is_admin): ?>
						<button type="button" class="btn btn-qm btn-flat bg-yellow" id="pos-quotation" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
							<i class="fas fa-edit"></i>
							<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.quotation'); ?></span>
							<span class="btn-short-text">QT</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(empty($pos_settings['disable_suspend'])): ?>
					<?php if(auth()->user()->can('payment_btn.hide_suspend') != 1 || $is_admin): ?>
						<button type="button" class="btn btn-qm btn-flat bg-red no-print pos-express-finalize" 
							data-pay_method="suspend"
							title="<?php echo app('translator')->get('lang_v1.tooltip_suspend'); ?>" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
							<i class="fas fa-pause" aria-hidden="true"></i>
							<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.suspend'); ?></span>
							<span class="btn-short-text">SS</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(empty($pos_settings['disable_credit_sale_button'])): ?>
					<?php if(auth()->user()->can('payment_btn.hide_credit_sale') != 1 || $is_admin): ?>
						<button type="button" class="btn btn-qm btn-flat bg-purple no-print pos-express-finalize" 
							data-pay_method="credit_sale"
							title="<?php echo app('translator')->get('lang_v1.tooltip_credit_sale'); ?>" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
							<i class="fas fa-check" aria-hidden="true"></i>
							<span class="btn-label-text"><?php echo $pos_split_label('lang_v1.credit_sale'); ?></span>
							<span class="btn-short-text">CS</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(!$pos_payments_disabled): ?>
				<?php if(!empty($pos_settings['dojo_api_key'])): ?>
					<button type="button" class="btn btn-qm btn-flat bg-purple no-print pos-express-finalize" 
						data-pay_method="dojo_payment"
						title="<?php echo app('translator')->get('lang_v1.dojo'); ?>" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
						<i class="fas fa-credit-card" aria-hidden="true"></i>
						<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.dojo'); ?></span>
						<span class="btn-short-text">DJ</span>
					</button>
				<?php endif; ?>

				<?php if(auth()->user()->can('payment_btn.hide_multipay') != 1 || $is_admin || $edit): ?>
					<button type="button" class="btn btn-qm btn-flat bg-navy no-print <?php if($pos_settings['disable_pay_checkout'] != 0 && !$edit): ?> hide <?php endif; ?>" 
						id="pos-finalize" title="<?php echo app('translator')->get('lang_v1.tooltip_checkout_multi_pay'); ?>">
						<i class="fas fa-money-check-alt" aria-hidden="true"></i>
						<span class="btn-label-text"><?php echo $pos_split_label('lang_v1.checkout_multi_pay'); ?></span>
						<span class="btn-short-text">MP</span>
					</button>
				<?php endif; ?>

				<?php if(empty($pos_settings['disable_card_button'])): ?>
					<?php if((auth()->user()->can('payment_btn.hide_card') != 1 || $is_admin) && !$edit): ?>
						<button type="button" class="btn btn-qm btn-flat bg-maroon no-print pos-express-finalize <?php if(!array_key_exists('card', $payment_types)): ?> hide <?php endif; ?>" 
							data-pay_method="card"
							title="<?php echo app('translator')->get('lang_v1.tooltip_express_checkout_card'); ?>">
							<i class="fas fa-credit-card" aria-hidden="true"></i>
							<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.express_checkout_card'); ?></span>
							<span class="btn-short-text">CR</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if((auth()->user()->can('payment_btn.hide_cash') != 1 || $is_admin) && !$edit): ?>
					<button type="button" class="btn btn-qm btn-flat bg-lime no-print pos-express-finalize <?php if($pos_settings['disable_express_checkout'] != 0 || !array_key_exists('cash', $payment_types)): ?> hide <?php endif; ?>" 
						data-pay_method="cash" title="<?php echo app('translator')->get('tooltip.express_checkout'); ?>">
						<i class="fas fa-money-bill-alt" aria-hidden="true"></i>
						<span class="btn-label-text"><?php echo app('translator')->get('lang_v1.express_checkout_cash'); ?></span>
						<span class="btn-short-text">EC</span>
					</button>
				<?php endif; ?>
				<?php endif; ?> 

				
				<?php if($pos_settings['enable_takeaway']): ?>
					<?php if((auth()->user()->can('payment_btn.hide_takeaway') != 1 || $is_admin) && (!$edit || ($edit && $transaction->status == 'draft'))): ?>
						<button type="button" class="btn btn-qm btn-flat btn-takeaway-1 no-print" id="pos-takeaway-finalize" 
							title="<?php echo app('translator')->get('lang_v1.tooltip_checkout_takeway'); ?>" 
							<?php if($pos_settings['takeaway_as_credit']): ?> data-pay_method="credit_sale" <?php endif; ?>
							data-enable_seperate_kot_qty="<?php echo e(!empty($pos_settings['takeaway_enable_seperate_kot_qty']) ? 1 : 0, false); ?>"
							data-enable_only_print_kot="<?php echo e(!empty($pos_settings['takeaway_enable_only_print_kot']) ? 1 : 0, false); ?>"
							data-takeaway='1'>
							<i class="fas fa-shopping-bag" aria-hidden="true"></i>
							<span class="btn-label-text">
								<?php if(!empty($pos_settings['enable_takeaway_label'])): ?>
									<?php echo e($pos_settings['enable_takeaway_label'], false); ?>

								<?php else: ?> 
									<?php echo app('translator')->get('lang_v1.takeaway_label'); ?> 
								<?php endif; ?>
							</span>
							<span class="btn-short-text">TA</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if($pos_settings['enable_takeaway_2']): ?>
					<?php if((auth()->user()->can('payment_btn.hide_takeaway') != 1 || $is_admin) && (!$edit || ($edit && $transaction->status == 'draft'))): ?>
						<button type="button" class="btn btn-qm btn-flat btn-takeaway-2 no-print" id="pos-takeaway-finalize" 
							title="<?php echo app('translator')->get('lang_v1.tooltip_checkout_takeway_credit'); ?>"
							<?php if($pos_settings['takeaway_2_as_credit']): ?> data-pay_method="credit_sale" <?php endif; ?>
							data-enable_seperate_kot_qty="<?php echo e(!empty($pos_settings['takeaway_2_enable_seperate_kot_qty']) ? 1 : 0, false); ?>"
							data-enable_only_print_kot="<?php echo e(!empty($pos_settings['takeaway_2_enable_only_print_kot']) ? 1 : 0, false); ?>"
							data-takeaway='2'>
							<i class="fas fa-motorcycle" aria-hidden="true"></i>
							<span class="btn-label-text">
								<?php if(!empty($pos_settings['enable_takeaway_2_label'])): ?>
									<?php echo e($pos_settings['enable_takeaway_2_label'], false); ?>

								<?php else: ?> 
									<?php echo app('translator')->get('lang_v1.takeaway_label'); ?> 2
								<?php endif; ?>
							</span>
							<span class="btn-short-text">TA2</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if($pos_settings['enable_takeaway_3']): ?>
					<?php if((auth()->user()->can('payment_btn.hide_takeaway') != 1 || $is_admin) && (!$edit || ($edit && $transaction->status == 'draft'))): ?>
						<button type="button" class="btn btn-qm btn-flat btn-takeaway-3 no-print" id="pos-takeaway-finalize" 
							title="<?php echo app('translator')->get('lang_v1.tooltip_checkout_takeway_credit'); ?>"
							<?php if($pos_settings['takeaway_3_as_credit']): ?> data-pay_method="credit_sale" <?php endif; ?>
							data-enable_seperate_kot_qty="<?php echo e(!empty($pos_settings['takeaway_3_enable_seperate_kot_qty']) ? 1 : 0, false); ?>"
							data-enable_only_print_kot="<?php echo e(!empty($pos_settings['takeaway_3_enable_only_print_kot']) ? 1 : 0, false); ?>"
							data-takeaway='3'>
							<i class="fas fa-truck" aria-hidden="true"></i>
							<span class="btn-label-text">
								<?php if(!empty($pos_settings['enable_takeaway_3_label'])): ?>
									<?php echo e($pos_settings['enable_takeaway_3_label'], false); ?>

								<?php else: ?> 
									<?php echo app('translator')->get('lang_v1.takeaway_label'); ?> 3
								<?php endif; ?>
							</span>
							<span class="btn-short-text">TA3</span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(empty($edit)): ?>
					<button type="button" class="btn btn-qm btn-flat btn-danger" id="pos-cancel">
						<i class="fas fa-window-close"></i>
						<span class="btn-label-text"><?php echo app('translator')->get('sale.cancel'); ?></span>
						<span class="btn-short-text">CL</span>
					</button>
				<?php else: ?>
					<button type="button" class="btn btn-qm btn-flat btn-danger hide" id="pos-delete" <?php if(!empty($only_payment)): ?> disabled <?php endif; ?>>
						<i class="fas fa-trash-alt"></i>
						<span class="btn-label-text"><?php echo app('translator')->get('messages.delete'); ?></span>
						<span class="btn-short-text">DL</span>
					</button>
				<?php endif; ?>

				<?php if(!isset($user_settings['hide_recent_trans']) || $user_settings['hide_recent_trans'] == 0): ?>
					<button type="button" class="btn btn-primary btn-lg col-md-12 <?php if($is_mobile): ?> col-12 <?php endif; ?> pos_numpad_btn" data-bs-toggle="modal" 
					data-bs-target="#recent_transactions_modal" id="recent-transactions" style="margin-top:10px">
					<i class="fas fa-clock"></i> <?php echo app('translator')->get('lang_v1.recent_transactions'); ?></button>
				<?php endif; ?>
				
				<input type="hidden" name="enable_seperate_kot_qty" id="enable_seperate_kot_qty" value="">
				<input type="hidden" name="enable_only_print_kot" id="enable_only_print_kot" value="">
			</div>
		</div>
		<?php endif; ?>
		<div class="col-md-12 hide" id="pos-table-print-actions">
			<?php if(auth()->user()->can('payment_btn.hide_print_bill') != 1 || $is_admin): ?>
			<button type="button" class=" btn btn-primary btn-qm btn-flat <?php if($is_mobile): ?> col-6 <?php elseif($pos_settings[$default_location->id]['hide_product_suggestion'] == 2): ?> col-6 btn-lg <?php else: ?> <?php endif; ?> custom-btn-height" id="pos-table-orders-bill" data-btn-action="save" data-table_id=""><i class="fas fa-save"></i> Save</button>
			<button type="button" class=" btn btn-default bg-yellow btn-qm btn-flat <?php if($is_mobile): ?> col-6 <?php elseif($pos_settings[$default_location->id]['hide_product_suggestion'] == 2): ?> col-6 btn-lg <?php else: ?> <?php endif; ?> custom-btn-height" id="pos-table-orders-bill" data-btn-action="save_and_print" data-table_id=""><i class="fas fa-print"></i> Print Bill</button>
			<?php endif; ?>
			<button type="button" class="btn btn-danger btn-qm btn-flat <?php if($is_mobile): ?> col-sm-6 <?php elseif($pos_settings[$default_location->id]['hide_product_suggestion'] == 2): ?> col-sm-6 btn-lg <?php else: ?> <?php endif; ?> custom-btn-height" id="pos-cancel"> <i class="fas fa-window-close"></i> <?php echo app('translator')->get('sale.cancel'); ?></button>
		</div>
		<div class="col-md-12 hide" id="pos-table-set-order-actions">
			<button type="button" class="btn btn-flat btn-qm btn-primary <?php if($is_mobile): ?> col-sm-6 <?php elseif($pos_settings[$default_location->id]['hide_product_suggestion'] == 2): ?> col-sm-6 btn-lg <?php endif; ?> custom-btn-height" id="pos-table-draft" data-qm_table_id=''>
				<i class="fas fa-save"></i> Save
			</button>
			<button type="button" class="btn btn-flat btn-qm btn-warning <?php if($is_mobile): ?> col-sm-6 <?php elseif($pos_settings[$default_location->id]['hide_product_suggestion'] == 2): ?> col-sm-6 btn-lg <?php endif; ?> custom-btn-height" id="pos-table-draft" data-qm_table_id='' data-print_kot="true">
				<i class="fas fa-print"></i> Print
			</button>
			<button type="button" class="btn btn-danger btn-qm btn-flat <?php if($is_mobile): ?> col-sm-6 <?php elseif($pos_settings[$default_location->id]['hide_product_suggestion'] == 2): ?> col-sm-6 btn-lg <?php else: ?> <?php endif; ?>" id="pos-cancel"> <i class="fas fa-window-close"></i> <?php echo app('translator')->get('sale.cancel'); ?></button>
		</div>
	</div>
	
</div>
<?php if(isset($transaction)): ?>
	<?php echo $__env->make('sale_pos.partials.edit_discount_modal', ['sales_discount' => $transaction->discount_amount, 'discount_type' => $transaction->discount_type, 'rp_redeemed' => $transaction->rp_redeemed, 'rp_redeemed_amount' => $transaction->rp_redeemed_amount, 'max_available' => !empty($redeem_details['points']) ? $redeem_details['points'] : 0], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
	<?php echo $__env->make('sale_pos.partials.edit_discount_modal', ['sales_discount' => $business_details->default_sales_discount, 'discount_type' => 'percentage', 'rp_redeemed' => 0, 'rp_redeemed_amount' => 0, 'max_available' => 0], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php if(isset($transaction)): ?>
	<?php echo $__env->make('sale_pos.partials.edit_order_tax_modal', ['selected_tax' => $transaction->tax_id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
	<?php echo $__env->make('sale_pos.partials.edit_order_tax_modal', ['selected_tax' => $business_details->default_sales_tax], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('sale_pos.partials.edit_shipping_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
