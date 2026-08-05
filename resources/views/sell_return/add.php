
<?php $__env->startSection('title', __('lang_v1.sell_return')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
	<h1><?php echo app('translator')->get('lang_v1.sell_return'); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">

	<?php echo Form::hidden('location_id', $sell->location->id, ['id' => 'location_id', 'data-receipt_printer_type' => $sell->location->receipt_printer_type, 'data-default_payment_accounts' => $sell->location->default_payment_accounts, 'data-payment_labels' => json_encode($sell->location->loc_settings['payment_labels']) ]); ?>

	<input type="hidden" id="default_customer_credit_limit" value="<?php echo e($sell->contact->credit_limit ?? '', false); ?>">

	<?php echo Form::open(['url' => action([\App\Http\Controllers\SellReturnController::class, 'store']), 'method' => 'post', 'id' => 'sell_return_form' ]); ?>

	<?php echo Form::hidden('transaction_id', $sell->id); ?>

	<?php echo Form::hidden('sell_return_id', $sell->return_parent->id, ['id' => 'transaction_id']); ?>

	<?php echo Form::hidden('contact_id', $sell->contact_id); ?>

	<?php echo Form::hidden('from_pos', (str_contains(url()->previous(), 'pos/')) ? 1 : 0 ); ?>

	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title"><?php echo app('translator')->get('lang_v1.parent_sale'); ?></h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-sm-4">
					<strong><?php echo app('translator')->get('sale.invoice_no'); ?>:</strong> <?php echo e($sell->invoice_no, false); ?> <br>
					<strong><?php echo app('translator')->get('messages.date'); ?>:</strong> <?php echo e(\Carbon::createFromTimestamp(strtotime($sell->transaction_date))->format(session('business.date_format')), false); ?>

				</div>
				<div class="col-sm-4">
					<strong><?php echo app('translator')->get('contact.customer'); ?>:</strong> <?php echo e($sell->contact->name, false); ?> <br>
					<strong><?php echo app('translator')->get('purchase.business_location'); ?>:</strong> <?php echo e($sell->location->name, false); ?> <br>
					<small class="text-danger hide contact_due_text"><strong><?php echo app('translator')->get('account.customer_due'); ?>:</strong> <span></span></small>
					<br>
					<small class="text-blue hide contact_credit_limit_text"><strong><?php echo app('translator')->get('account.available_credit'); ?>:</strong> <span></span></small>
				</div>
				<div class="col-sm-4">
					<?php if(!empty($sell->commission_agent)): ?>
					<strong><?php echo app('translator')->get('lang_v1.sales_commission_agent'); ?>:</strong> <?php echo e($commission_agent[$sell->commission_agent], false); ?> <br>
					<input type="hidden" name="commission_agent" value="<?php echo e($sell->commission_agent, false); ?>">
					<?php endif; ?>
				</div>
				<div class="clearfix"></div>
				<?php
					$custom_labels = json_decode(session('business.custom_labels'), true);
			        $custom_field_1_label = !empty($custom_labels['sell']['custom_field_1']) ? $custom_labels['sell']['custom_field_1'] : '';
			        $custom_field_2_label = !empty($custom_labels['sell']['custom_field_2']) ? $custom_labels['sell']['custom_field_2'] : '';
			        $custom_field_3_label = !empty($custom_labels['sell']['custom_field_3']) ? $custom_labels['sell']['custom_field_3'] : '';
			        $custom_field_4_label = !empty($custom_labels['sell']['custom_field_4']) ? $custom_labels['sell']['custom_field_4'] : '';
		        ?>
		        <?php if(!empty($custom_field_1_label)): ?>
		        	<div class="col-sm-4">
				        <strong><?php echo e($custom_field_1_label, false); ?>:</strong>
				        <?php echo e($sell->custom_field_1, false); ?>

				    </div>
		        <?php endif; ?>
				<?php if(!empty($custom_field_2_label)): ?>
		        	<div class="col-sm-4">
				        <strong><?php echo e($custom_field_2_label, false); ?>:</strong>
				        <?php echo e($sell->custom_field_2, false); ?>

				    </div>
		        <?php endif; ?>
				<?php if(!empty($custom_field_2_label)): ?>
					<div class="clearfix"></div>
		        	<div class="col-sm-4">
				        <strong><?php echo e($custom_field_2_label, false); ?>:</strong>
				        <?php echo e($sell->custom_field_2, false); ?>

				    </div>
		        <?php endif; ?>
				<?php if(!empty($custom_field_2_label)): ?>
		        	<div class="col-sm-4">
				        <strong><?php echo e($custom_field_2_label, false); ?>:</strong>
				        <?php echo e($sell->custom_field_2, false); ?>

				    </div>
		        <?php endif; ?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group mb-2">
						<?php echo Form::label('invoice_no', __('sale.invoice_no').':'); ?>

						<?php echo Form::text('invoice_no', !empty($sell->return_parent->invoice_no) ? $sell->return_parent->invoice_no : null, ['class' => 'form-control', empty($user_settings['enable_sale_invoice_no']) ? 'readonly' : '',]); ?>

						<b id="invoice_no_error" class="error hide"><?php echo app('translator')->get('lang_v1.not_unique', ['name' => __('sale.invoice_no') ]); ?></b>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group mb-2">
						<?php echo Form::label('transaction_date', __('messages.date') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-text">
								<i class="fa fa-calendar"></i>
							</span>
							<?php
							$transaction_date = !empty($sell->return_parent->transaction_date) ? $sell->return_parent->transaction_date : 'now';
							?>
							<?php echo Form::text('transaction_date', \Carbon::createFromTimestamp(strtotime($transaction_date))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required']); ?>

						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="table-responsive">
<table class="table table-bordered table-striped ajax_view table-th-skin" id="sell_return_table">
						<?php
							$hide_discount = '';
							if (!empty($common_settings['enable_inline_discount_sales'])) {
								$hide_discount = 'hide';
							}
							$hide_tax = '';
							if (!empty($common_settings['enable_inline_tax_sales'])) {
								$hide_tax = 'hide';
							}
						?>
						<thead>
							<tr class="bg-green">
								<th style="width:1%">#</th>
								<th style="width:1%" class="text-nowrap"><?php echo app('translator')->get('product.sku'); ?></th>
								<th style="width:100%"><?php echo app('translator')->get('product.product_name'); ?></th>
								<?php if(!empty($common_settings['enable_serial_number'])): ?>
                                <th><?php echo app('translator')->get('product.sr_imei_no'); ?></th>
                                <?php endif; ?>
								<th class="text-nowrap"><?php echo app('translator')->get('lang_v1.sell_quantity'); ?></th>
								<th class="text-nowrap text-end"><?php echo app('translator')->get('sale.unit_price'); ?> <span class="badge bg-info" style="font-size:10px"><?php echo e(session('currency')['symbol'] ?? '', false); ?></span></th>
								<th class="text-nowrap text-end <?php echo e($hide_discount, false); ?>"><?php echo app('translator')->get('sale.discount'); ?> <span class="badge bg-info" style="font-size:10px"><?php echo e(session('currency')['symbol'] ?? '', false); ?></span></th>
								<th class="text-nowrap text-end <?php echo e($hide_discount, false); ?>"><?php echo app('translator')->get('sale.unit_price_after_discount'); ?> <span class="badge bg-info" style="font-size:10px"><?php echo e(session('currency')['symbol'] ?? '', false); ?></span></th>
								<th class="text-nowrap text-end <?php echo e($hide_tax, false); ?>"><?php echo app('translator')->get('sale.tax'); ?> <span class="badge bg-info" style="font-size:10px"><?php echo e(session('currency')['symbol'] ?? '', false); ?></span></th>
								<th class="text-nowrap text-end <?php echo e($hide_tax, false); ?>"><?php echo app('translator')->get('sale.price_inc_tax'); ?> <span class="badge bg-info" style="font-size:10px"><?php echo e(session('currency')['symbol'] ?? '', false); ?></span></th>
								<th class="text-nowrap"><?php echo app('translator')->get('lang_v1.status'); ?></th>
								<th class="text-nowrap" id="return_qty_heading" style="cursor:pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo app('translator')->get('lang_v1.double_click_to_fill_all_return_qty'); ?>"><?php echo app('translator')->get('lang_v1.return_quantity'); ?> <i class="fas fa-info-circle text-info" style="font-size:11px;"></i></th>
								<th class="text-nowrap text-end"><?php echo app('translator')->get('lang_v1.return_subtotal'); ?> <span class="badge bg-info" style="font-size:10px"><?php echo e(session('currency')['symbol'] ?? '', false); ?></span></th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $sell->sell_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
							$check_decimal = 'false';
							if($sell_line->product->unit->allow_decimal == 0){
								$check_decimal = 'true';
							}

							$unit_name = $sell_line->product->unit->short_name;

							if(!empty($sell_line->sub_unit)) {
							$unit_name = $sell_line->sub_unit->short_name;

							if($sell_line->sub_unit->allow_decimal == 0){
								$check_decimal = 'true';
								} else {
								$check_decimal = 'false';
								}
							}
							?>
							<tr> 
								<td><?php echo e($loop->iteration, false); ?></td>
								<td class="text-center"><?php echo e($sell_line->variations->sub_sku, false); ?></td>
								<td>
									<?php echo e($sell_line->product->name, false); ?>

									<?php if( $sell_line->product->type == 'variable'): ?>
									- <?php echo e($sell_line->variations->product_variation->name, false); ?>

									- <?php echo e($sell_line->variations->name, false); ?>

									<?php endif; ?>
									<br>
									<a href="javascript:void(0)" class="toggle-product-note" title="<?php echo app('translator')->get('lang_v1.product_note'); ?>">
										<i class="fa <?php echo e(!empty($sell_line->sell_line_note) ? 'fa-minus-circle text-danger' : 'fa-plus-circle text-success', false); ?>"></i>
										<small><?php echo app('translator')->get('lang_v1.product_note'); ?></small>
									</a>
									<div class="product-note-wrapper" style="<?php echo e(empty($sell_line->sell_line_note) ? 'display:none;' : '', false); ?>">
										<textarea class="form-control" name="products[<?php echo e($loop->index, false); ?>][sell_line_note]" rows="2"><?php echo e($sell_line->sell_line_note, false); ?></textarea>
									</div>
								</td>
								<?php if(!empty($common_settings['enable_serial_number'])): ?>
								<td><?php echo e($sell_line->serial_number, false); ?></td>
								<?php endif; ?>
								<td><?php echo e($sell_line->formatted_qty, false); ?> <?php echo e($unit_name, false); ?></td>
								<td class="text-end"><span class="display_currency" data-currency_symbol="false"><?php echo e($sell_line->unit_price_before_discount, false); ?></span></td>
								<td class="text-end <?php echo e($hide_discount, false); ?>">
									<?php if($sell_line->line_discount_type == 'fixed'): ?>
										<span class="display_currency" data-currency_symbol="false"><?php echo e($sell_line->line_discount_amount, false); ?></span>
									<?php elseif($sell_line->line_discount_type == 'percentage'): ?>
										<span class="display_currency" data-currency_symbol="false"><?php echo e($sell_line->unit_price_before_discount * ($sell_line->line_discount_amount/100), false); ?></span>
									<?php endif; ?>
								</td>
								<td class="text-end <?php echo e($hide_discount, false); ?>"><span class="display_currency" data-currency_symbol="false"><?php echo e($sell_line->unit_price, false); ?></span></td>
								<td class="text-end <?php echo e($hide_tax, false); ?>">
									<span class="display_currency" data-currency_symbol="false"><?php echo e($sell_line->item_tax, false); ?></span>
									<input class="item_tax" type="hidden" value="<?php echo e($sell_line->item_tax, false); ?>">
								</td>
								<td class="text-end <?php echo e($hide_tax, false); ?>"><span class="display_currency" data-currency_symbol="false"><?php echo e($sell_line->unit_price_inc_tax, false); ?></td>
								<td>
									<?php echo Form::select("products[$loop->index][line_return_status]", ['normal' => 'Normal', 'damage' => 'Damage'], 'normal', ['class' => 'form-control input-sm', ]); ?>

								</td>
								<td>
									<input type="text" name="products[<?php echo e($loop->index, false); ?>][quantity]" value="<?php echo e(number_format($sell_line->quantity_returned, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" class="form-control input-sm input_number return_qty input_quantity" data-rule-abs_digit="<?php echo e($check_decimal, false); ?>" data-msg-abs_digit="<?php echo app('translator')->get('lang_v1.decimal_value_not_allowed'); ?>" data-rule-max-value="<?php echo e($sell_line->quantity, false); ?>" data-msg-max-value="<?php echo app('translator')->get('validation.custom-messages.quantity_not_available', ['qty' => $sell_line->formatted_qty, 'unit' => $unit_name ]); ?>">
									<input name="products[<?php echo e($loop->index, false); ?>][unit_price_inc_tax]" type="hidden" class="unit_price" value="<?php echo e(number_format($sell_line->unit_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
									<input name="products[<?php echo e($loop->index, false); ?>][sell_line_id]" type="hidden" value="<?php echo e($sell_line->id, false); ?>">
									
									<?php if(($sell_line->product->type == 'combo' || $sell_line->product->type == 'Package') && !empty($sell_line->combo_products)): ?>
										<?php $__currentLoopData = $sell_line->combo_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $combo_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php
												$quantity_id = $k+1;
											?>

											<input type="hidden" name="products[<?php echo e($loop->index, false); ?>][combo][<?php echo e($k, false); ?>][name]" value="<?php echo e($combo_product['product_name'], false); ?>">
											<input type="hidden" name="products[<?php echo e($loop->index, false); ?>][combo][<?php echo e($k, false); ?>][product_id]" value="<?php echo e($combo_product['product_id'], false); ?>">
											<input type="hidden" name="products[<?php echo e($loop->index, false); ?>][combo][<?php echo e($k, false); ?>][variation_id]" value="<?php echo e($combo_product['variation_id'], false); ?>">
											<input type="hidden" id="<?php echo e($quantity_id, false); ?>" class="combo_product_qty" name="products[<?php echo e($loop->index, false); ?>][combo][<?php echo e($k, false); ?>][quantity]" data-unit_quantity="<?php echo e($combo_product['qty_required'], false); ?>" value="<?php echo e(number_format($combo_product['qty_returned'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
											<input type="hidden" name="products[<?php echo e($loop->index, false); ?>][combo][<?php echo e($k, false); ?>][transaction_sell_lines_id]" value="<?php echo e($combo_product['id'], false); ?>">

										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
								</td>
								<td class="text-end">
									<div class="return_subtotal"></div>
								</td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
</div>
				</div>
			</div>
			<div class="row">
				<?php
				$discount_type = !empty($sell->return_parent->discount_type) ? $sell->return_parent->discount_type : $sell->discount_type;
				$discount_amount = !empty($sell->return_parent->discount_amount) ? $sell->return_parent->discount_amount : $sell->discount_amount;
				?>
				<div class="col-md-6">
					<div class="mb-3">
						<?php echo Form::label('sale_note', __('sale.customer_note'). ':'); ?>

						<a href="javascript:void(0)" class="toggle-note">
							<i class="fa <?php echo e(!empty($sell->return_parent->additional_notes) ? 'fa-minus-circle text-danger' : 'fa-plus-circle text-success', false); ?>"></i>
						</a>
						<div class="note-wrapper" style="<?php echo e(empty($sell->return_parent->additional_notes) ? 'display:none;' : '', false); ?>">
							<?php echo Form::textarea('sale_note', $sell->return_parent->additional_notes, ['class' => 'form-control', 'rows' => 3, 'cols'=> 50 ]); ?>

						</div>
					</div>
				</div>
				
				<div class="clearfix"></div>
				<?php
					// Phase 70: prefer controller-supplied per-branch common_settings; session is the fallback.
					$common_settings = isset($common_settings) && ! empty($common_settings)
						? $common_settings
						: session()->get('business.common_settings');
				?>
				<?php if(!empty($common_settings['enable_total_discount_sale'])): ?>
				<div class="col-sm-4">
					<div class="form-group mb-2">
						<?php echo Form::label('discount_type', __( 'purchase.discount_type' ) . ':'); ?>

						<?php echo Form::select('discount_type', [ '' => __('lang_v1.none'), 'fixed' => __( 'lang_v1.fixed' ), 'percentage' => __( 'lang_v1.percentage' )], $discount_type, ['class' => 'form-select']); ?>

					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group mb-2">
						<?php echo Form::label('discount_amount', __( 'purchase.discount_amount' ) . ':'); ?>

						<?php echo Form::text('discount_amount', number_format($discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

					</div>
				</div>
				<?php endif; ?>
			</div>
			<?php if(!empty($common_settings['enable_total_tax_sale'])): ?>
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group mb-2">
						<?php echo Form::label('tax_rate_id', __('sale.order_tax') . ':*'); ?>

						<?php echo Form::select(
							'tax_rate_id',
							$taxes['tax_rates'],
							$sell->tax_id,
							['placeholder' => __('messages.please_select'), 'class' => 'form-select', 'data-default' => $default_sales_tax],
							$taxes['attributes'],
						); ?>

					</div>
				</div>
			</div>
			<?php endif; ?>
			<?php
			$tax_percent = 0;
			if(!empty($sell->tax)){
				$tax_percent = $sell->tax->amount;
			}
			?>
			<?php echo Form::hidden('tax_id', $sell->tax_id, ['id' => 'tax_id']); ?>

			<?php echo Form::hidden('tax_amount', 0, ['id' => 'tax_amount']); ?>

			<?php echo Form::hidden('tax_percent', $tax_percent, ['id' => 'tax_percent']); ?>

			<?php echo Form::hidden('tax_type', $sell->tax_type, ['id' => 'tax_type']); ?>

			<div class="row">
				<div class="col-sm-12">
					<div class="float-end">
						<strong><?php echo app('translator')->get('lang_v1.total_item_tax'); ?>:</strong>
						&nbsp; <span id="item_tax_total"></span>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="float-end">
						<strong><?php echo app('translator')->get('lang_v1.total_return_discount'); ?>:</strong>
						&nbsp;(-) <span id="total_return_discount"></span>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="float-end">
					<strong><?php echo app('translator')->get('lang_v1.total_return_tax'); ?> - <span id='total_return_tax_name'>
						<?php if(!empty($sell->tax)): ?>(<?php echo e($sell->tax->name, false); ?> - 
						<?php if($sell->tax_type == 'fixed'): ?><?php echo e('Rs', false); ?><?php endif; ?> <?php echo e($sell->tax->amount, false); ?> <?php if($sell->tax_type == 'percentage'): ?><?php echo e('%', false); ?><?php endif; ?>)
						<?php endif; ?> : </span>
					</strong>
					&nbsp;(+) <span id="total_return_tax"></span>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="float-end">
					<strong><?php echo app('translator')->get('lang_v1.return_total'); ?>: </strong>&nbsp;
					<span id="net_return">0</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php if(auth()->user()->can('sell_return.payments') || auth()->user()->can('sell.payments')): ?>
	<?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('purchase.add_payment')]); ?>
	<div class="row">
		<?php if($sell->payment_lines->isEmpty()): ?>
			<input type="hidden" id="set_payment_zero" value="true">
		<?php endif; ?>
		<div class="payment_row" id="payment_rows_div">
		<?php $__currentLoopData = $payment_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>			
			<?php if($payment_line['is_return'] == 1): ?>
				<?php
					$change_return = $payment_line;
				?>

				<?php continue; ?>
			<?php endif; ?>

			<?php echo $__env->make('sale_pos.partials.payment_row', [
				'removable' => !$loop->first,
				'row_index' => $loop->index,
				'payment_line' => $payment_line,
				'show_date' => true,
				'show_denomination' => true,
				'transaction_type' => 'sell_return',
			], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
		<input type="hidden" id="payment_row_index" value="<?php echo e(count($payment_lines), false); ?>">
		<div class="col-md-12">
			<button type="button" class="btn btn-primary btn-block" id="add-payment-row"><?php echo app('translator')->get('sale.add_payment_row'); ?></button>
		</div>
	</div>
	<?php echo $__env->renderComponent(); ?>
	<?php endif; ?>
	<?php echo Form::hidden('is_save_and_print', 0, ['id' => 'is_save_and_print']); ?>

	<?php echo Form::close(); ?>


</section>

<?php echo $__env->make('sell.partials.sell_keyboard_shortcuts_help_modal', ['is_sell_return_page' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/printer.js?v=' . $asset_v), false); ?>"></script>
<script src="<?php echo e(asset('js/sell_return.js?v=' . $asset_v), false); ?>"></script>
<?php echo $__env->make('sell_return.partials.sell_return_keyboard_shortcuts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('form#sell_return_form').validate();
		let sale_note = $('#sale_note_hidden').val();
		$('textarea[id="sale_note"').text(sale_note);
		update_sell_return_total();
		$('.payment_types_dropdown').change();
		// Initialize tooltip on return quantity heading
		$('#return_qty_heading').tooltip();
		//Date picker
		// $('#transaction_date').datepicker({
		//     autoclose: true,
		//     format: datepicker_date_format
		// });
	});
	// Double-click on Return Quantity heading to fill all return quantities from sale quantities
	$(document).on('dblclick', '#return_qty_heading', function() {
		$('table#sell_return_table tbody tr').each(function() {
			var return_input = $(this).find('input.return_qty');
			if (return_input.length) {
				var max_qty = parseFloat(return_input.attr('data-rule-max-value')) || 0;
				__write_number(return_input, max_qty);
				return_input.trigger('change');
			}
		});
	});

	// Click on individual return quantity field to fill sale quantity for that row
	$(document).on('click', 'input.return_qty', function() {
		var max_qty = parseFloat($(this).attr('data-rule-max-value')) || 0;
		__write_number($(this), max_qty);
		$(this).trigger('change');
	});

	$(document).on('change', 'input.return_qty, #discount_amount, #discount_type, #tax_rate_id', function() {
		var tr = $(this).parents('tr');
		tr.find('.combo_product_qty').each(function() {
			var unit_quantity = parseFloat($(this).data('unit_quantity')); // Get the data-unit_quantity
			var return_qty = parseFloat(tr.find('input.return_qty').val()); // Get the return_qty value
			if (!isNaN(unit_quantity) && !isNaN(return_qty)) {
				var combo_quantity = return_qty * unit_quantity; // Multiply return_qty by unit_quantity
				$(this).val(combo_quantity); // Update the value of .combo_product_qty
			} else {
				$(this).val(0); // Set to 0 if values are invalid
			}
		});
		update_sell_return_total()
	});

	$(document).on('click', 'button#submit_sell_return_form', function(e) {
		e.preventDefault();
		var submit_buttons = $('button#submit_sell_return_form, button#save-and-print');

		if ($('form#sell_return_form').data('sell_return_submit_locked')) {
			return false;
		}

		if (typeof window.lockSellReturnSubmitButtons === 'function') {
			if (!window.lockSellReturnSubmitButtons()) {
				return false;
			}
		} else {
			$('form#sell_return_form').data('sell_return_submit_locked', true);
			submit_buttons.prop('disabled', true);
		}

		//Check if product is present or not.
		let total_qty = 0;
		$('table#sell_return_table tbody tr .return_qty').each(function(){
			total_qty += __read_number($(this)) || 0;
		});

		if (total_qty <= 0) {
			toastr.warning('Please Add Return Quantity');
			if (typeof window.unlockSellReturnSubmitButtons === 'function') {
				window.unlockSellReturnSubmitButtons();
			} else {
				$('form#sell_return_form').removeData('sell_return_submit_locked');
				submit_buttons.prop('disabled', false);
			}
			return false;
		}
		$('form#sell_return_form').submit();
	});

	$(document).on('change', '.payment_types_dropdown', function(e) {
		var default_accounts = $('#location_id').data('default_payment_accounts');
		var payment_type = $(this).val();
		var payment_row = $(this).closest('.payment_row');
		if (payment_type && payment_type != 'advance' && payment_type != 'multipay') {
			var default_account = default_accounts && default_accounts[payment_type]['account'] ? 
				default_accounts[payment_type]['account'] : '';
			var row_index = payment_row.find('.payment_row_index').val();

			var account_dropdown = payment_row.find('select#account_' + row_index);
			var change_return_account_dropdown = $('#change_return_account');
			if (account_dropdown.length && default_accounts) {
				account_dropdown.val(default_account);
				account_dropdown.change();
				change_return_account_dropdown.val(default_account);
				change_return_account_dropdown.change();
			}
		}

		// //Validate max amount and disable account if advance 
		// amount_element = payment_row.find('.payment-amount');
		// account_dropdown = payment_row.find('.account-dropdown');
	
	});

	function update_sell_return_total() {
		var net_return = 0;
		var item_tax_total = 0;
		$('table#sell_return_table tbody tr').each(function() {
			var quantity = __read_number($(this).find('input.return_qty'));
			var unit_price = __read_number($(this).find('input.unit_price'));
			var item_tax = __read_number($(this).find('input.item_tax'));
			var subtotal = quantity * unit_price;
			console.log(item_tax);
			item_tax_total += quantity * item_tax;
			$(this).find('.return_subtotal').text(__currency_trans_from_en(subtotal, false));
			net_return += subtotal;
		});
		console.log(item_tax_total);
		var discount = 0;
		if ($('#discount_type').val() == 'fixed') {
			discount = __read_number($("#discount_amount"));
		} else if ($('#discount_type').val() == 'percentage') {
			var discount_percent = __read_number($("#discount_amount"));
			discount = __calculate_amount('percentage', discount_percent, net_return);
		}
		discounted_net_return = net_return - discount;

		var tax_rate_id = $('#tax_rate_id').val();
		var tax_name = $('#tax_rate_id').find('option:selected').text();
		var tax_percent = $('#tax_rate_id').find('option:selected').attr('data-rate'); 
		var tax_type = $('#tax_rate_id').find('option:selected').attr('data-type');
		// var tax_percent = $('input#tax_percent').val();
		// var tax_type = $('input#tax_type').val();
		if(tax_type == undefined){
			tax_type = 'percentage';
		}
		var total_tax = __calculate_amount(tax_type, tax_percent, discounted_net_return);
		var net_return_inc_tax = total_tax + discounted_net_return;
		
		$('input#tax_amount').val(total_tax);
		$('input#tax_type').val(tax_type);
		$('input#tax_id').val(tax_rate_id);
		$('input#tax_percent').val(tax_percent);
		
		if(tax_name != 'None'){
			if(tax_type == 'percentage'){
				$('span#total_return_tax_name').text('('+tax_name+' - '+tax_percent+'%)');
			}else if(tax_type == 'fixed'){
				$('span#total_return_tax_name').text('('+tax_name+' - Rs.'+tax_percent+')');
			}else if(tax_type == undefined){
				$('span#total_return_tax_name').text('('+tax_name+')');
			}
		}
		
		$('span#total_return_discount').text(__currency_trans_from_en(discount, true));
		$('span#item_tax_total').text(__currency_trans_from_en(item_tax_total, true));
		$('span#total_return_tax').text(__currency_trans_from_en(total_tax, true));
		$('span#net_return').text(__currency_trans_from_en(net_return_inc_tax, true));

		if ($('input#set_payment_zero').val() != 'true') {
			console.log('RAN');
			$('input.payment-amount').val(__currency_trans_from_en(net_return_inc_tax, false));
		}
		
	}

	
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>