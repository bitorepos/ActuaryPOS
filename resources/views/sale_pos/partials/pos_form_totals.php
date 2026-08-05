<div class="row pos_form_totals">
	<div class="col-md-12">
		<table class="table table-condensed">
			<tr>
				
				<td><b><?php echo app('translator')->get('lang_v1.total_quantity'); ?>:</b>&nbsp;
					<span class="total_quantity">0</span>
				</td>
				<?php if(!empty($pos_settings['enable_discount_column'])): ?>
				<td>
					<b><?php echo app('translator')->get('sale.discount'); ?>:</b> &nbsp;
					<span class="total_discounts">0</span>
				</td>
				<?php endif; ?>
				<?php if(!empty($pos_settings['enable_inline_tax_pos'])): ?>
				<td>
					<b><?php echo app('translator')->get('sale.tax'); ?>:</b> &nbsp;
					<span class="total_tax">0</span>
				</td>
				<?php endif; ?>
				<td>
					<b><?php echo app('translator')->get('sale.total'); ?>:</b> &nbsp;
					<span class="price_total">0</span>
				</td>
			</tr>
			<tr class="hide">
				
				<td>
					<span class="<?php if(!$is_discount_enabled && !$is_rp_enabled): ?> hide <?php endif; ?>">
					<b>
						<?php if($is_discount_enabled): ?>
							<?php echo app('translator')->get('sale.discount'); ?>
							<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.sale_discount') . '"></i>';
                }
            ?>
						<?php endif; ?>
						<?php if($is_rp_enabled): ?>
							<?php echo e(session('business.rp_name'), false); ?>

						<?php endif; ?>
						(-):
					</b>
					
					<?php if(auth()->user()->can('edit_invoice_discount_from_pos_screen')): ?>
					<i class="fas fa-edit cursor-pointer" id="pos-edit-discount" title="<?php echo app('translator')->get('sale.edit_discount'); ?>" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#posEditDiscountModal"></i>
					<?php endif; ?>
				
					<span id="total_discount">0</span>

					<input type="hidden" name="discount_id" id="discount_id" value="<?php if(!empty($edit)): ?><?php echo e($transaction->discount_id, false); ?><?php endif; ?>">

					<input type="hidden" name="discount_type" id="discount_type" value="<?php if(empty($edit)): ?><?php echo e('percentage', false); ?><?php else: ?><?php echo e($transaction->discount_type, false); ?><?php endif; ?>" data-default="percentage">

					<input type="hidden" name="discount_amount" id="discount_amount" value="<?php if(empty($edit)): ?> <?php echo e(number_format($business_details->default_sales_discount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php else: ?> <?php echo e(number_format($transaction->discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php endif; ?>" data-default="<?php echo e($business_details->default_sales_discount, false); ?>">

					<input type="hidden" name="rp_redeemed" id="rp_redeemed" value="<?php if(empty($edit)): ?><?php echo e('0', false); ?><?php else: ?><?php echo e($transaction->rp_redeemed, false); ?><?php endif; ?>">

					<input type="hidden" name="rp_redeemed_amount" id="rp_redeemed_amount" value="<?php if(empty($edit)): ?><?php echo e('0', false); ?><?php else: ?> <?php echo e($transaction->rp_redeemed_amount, false); ?> <?php endif; ?>">

					</span>
				</td>
				<td class="<?php if($pos_settings['disable_invoice_tax'] != 0): ?> hide <?php endif; ?>">
					<span>
						<b><?php echo app('translator')->get('sale.order_tax'); ?>(+): <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.sale_tax') . '"></i>';
                }
            ?></b>
						<i class="fas fa-edit cursor-pointer" title="<?php echo app('translator')->get('sale.edit_order_tax'); ?>" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#posEditOrderTaxModal" id="pos-edit-tax" ></i> 
						<span id="order_tax">
							<?php if(empty($edit)): ?>
								0
							<?php else: ?>
								<?php echo e($transaction->tax_amount, false); ?>

							<?php endif; ?>
						</span>

						<input type="hidden" name="tax_rate_id" 
							id="tax_rate_id" 
							value="<?php if(empty($edit)): ?> <?php echo e($business_details->default_sales_tax, false); ?> <?php else: ?> <?php echo e($transaction->tax_id, false); ?> <?php endif; ?>" 
							data-default="<?php echo e($business_details->default_sales_tax, false); ?>">

						<input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" 
							value="<?php if(empty($edit)): ?><?php echo e(number_format($business_details->tax_calculation_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?><?php else: ?><?php echo e(number_format($transaction->tax?->amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?><?php endif; ?>" data-default="<?php echo e($business_details->tax_calculation_amount, false); ?>">
						<input type="hidden" name="tax_calculation_type" id="tax_calculation_type" 
							value="<?php if(empty($edit)): ?><?php echo e($business_details->tax_calculation_type, false); ?><?php else: ?><?php echo e($transaction->tax?->type, false); ?><?php endif; ?>" data-default="fixed">
					</span>
				</td>
				<td class="<?php if($pos_settings['disable_shipping'] != 0): ?> hide <?php endif; ?>">
					<span>

						<b><?php echo app('translator')->get('sale.shipping'); ?>(+): <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.shipping') . '"></i>';
                }
            ?></b> 
						<i class="fas fa-edit cursor-pointer"  title="<?php echo app('translator')->get('sale.shipping'); ?>" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#posShippingModal"></i>
						<span id="shipping_charges_amount">0</span>
						<input type="hidden" name="shipping_details" id="shipping_details" value="<?php if(empty($edit)): ?><?php echo e('', false); ?><?php else: ?><?php echo e($transaction->shipping_details, false); ?><?php endif; ?>" data-default="">

						<input type="hidden" name="shipping_address" id="shipping_address" value="<?php if(empty($edit)): ?><?php echo e('', false); ?><?php else: ?><?php echo e($transaction->shipping_address, false); ?><?php endif; ?>">

						<input type="hidden" name="shipping_status" id="shipping_status" value="<?php if(empty($edit)): ?><?php echo e('', false); ?><?php else: ?><?php echo e($transaction->shipping_status, false); ?><?php endif; ?>">

						<input type="hidden" name="delivered_to" id="delivered_to" value="<?php if(empty($edit)): ?><?php echo e('', false); ?><?php else: ?><?php echo e($transaction->delivered_to, false); ?><?php endif; ?>">

						<input type="hidden" name="shipping_charges" id="shipping_charges" value="<?php if(empty($edit)): ?><?php echo e(number_format(0.00, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php else: ?><?php echo e(number_format($transaction->shipping_charges, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php endif; ?>" data-default="0.00">
						<input type="hidden" name="sale_ref_no" id='sale_ref_no' value="<?php if(empty($edit)): ?><?php echo e('', false); ?><?php else: ?><?php echo e($transaction->token_no ?? '', false); ?><?php endif; ?>">
						<input type="hidden" name="enable_prompt_token_no" id='enable_prompt_token_no' value="<?php if(!empty($pos_settings['prompt_token_no'])): ?><?php echo e('1', false); ?><?php else: ?><?php echo e('0', false); ?><?php endif; ?>">
						<input type="hidden" name="prompt_token_label" id='prompt_token_label' value="<?php if(!empty($pos_settings['prompt_token_label'])): ?><?php echo e($pos_settings['prompt_token_label'], false); ?><?php else: ?><?php echo e('Token', false); ?><?php endif; ?>">
						<input type="hidden" id='prompt_token_prefix' value="<?php if(!empty(session('business.ref_no_prefixes')['token_no'])): ?><?php echo e(session('business.ref_no_prefixes')['token_no'], false); ?><?php else: ?><?php echo e('', false); ?><?php endif; ?>">
						<input type="hidden" name="auto_generate_token_no" id='auto_generate_token_no' value="<?php if(!empty($pos_settings['auto_generate_token_no'])): ?><?php echo e('1', false); ?><?php else: ?><?php echo e('0', false); ?><?php endif; ?>">
						<input type="hidden" id='prompt_token_require' value="<?php if(!empty($pos_settings['require_token_no'])): ?><?php echo e('1', false); ?><?php else: ?><?php echo e('0', false); ?><?php endif; ?>">
						<input type="hidden" name="table_order_checkout" id="table_order_checkout" value="">
						<input type="hidden" name="qm_table_name" id="qm_table_name" value="">
						<input type="hidden" name="table_guest_count" id="table_guest_count" value="<?php if(empty($edit)): ?><?php echo e('', false); ?><?php else: ?><?php echo e($transaction->no_of_guests, false); ?><?php endif; ?>">
						<input type="hidden" name="table_checkout_orders" id="table_checkout_orders" value="">
						<input type="hidden" name="updated_by" id="updated_by" value="<?php echo e(session('updated_by'), false); ?>">
						<input type="hidden" name="reason" id="reason" value="<?php echo e(session('reason'), false); ?>">
						<input type="hidden" name="other_reason" id="other_reason" value="<?php echo e(session('other_reason'), false); ?>">
						<input type="hidden" name="user_system_time" id="user_system_time" value="">
						<?php if(!empty($edit)): ?>
						<input type="hidden" name="sub_status" id="sub_status" value="<?php echo e($transaction->sub_status, false); ?>">
						<input type="hidden" name="draft_status" id="draft_status" value="<?php echo e($transaction->draft_status, false); ?>">
						<?php endif; ?>
						
					</span>
				</td>
				<?php if(in_array('types_of_service', $enabled_modules)): ?>
					<td class="col-sm-3 col-6 d-inline-table">
						
						<input type="hidden" id="default_tos_id" value="<?php if(empty($edit)): ?><?php echo e($pos_settings[$default_location->id]['default_types_of_service'], false); ?><?php endif; ?>">
						<input type="hidden" id="packing_charge_amount" name="packing_charge_amount" value="0">
					</td>
				<?php endif; ?>
				<?php if(!empty($pos_settings['amount_rounding_method']) && $pos_settings['amount_rounding_method'] > 0): ?>
				<td>
					<b id="round_off"><?php echo app('translator')->get('lang_v1.round_off'); ?>:</b> <span id="round_off_text">0</span>								
					<input type="hidden" name="round_off_amount" id="round_off_amount" value=0>
				</td>
				<?php endif; ?>
			</tr>
		</table>
	</div>
</div>
