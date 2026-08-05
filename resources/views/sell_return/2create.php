
<?php $__env->startSection('title', __('lang_v1.sell_return')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
	<h1><?php echo app('translator')->get('lang_v1.sell_return'); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">

	<?php echo Form::hidden('location_id', $sell->location->id, ['id' => 'location_id', 'data-receipt_printer_type' => $sell->location->receipt_printer_type ]); ?>


	<?php echo Form::open(['url' => action([\App\Http\Controllers\SellReturnController::class, 'store']), 'method' => 'post', 'id' => 'sell_return_form' ]); ?>

	<?php echo Form::hidden('transaction_id', $sell->id); ?>

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
					<strong><?php echo app('translator')->get('purchase.business_location'); ?>:</strong> <?php echo e($sell->location->name, false); ?>

				</div>
			</div>
		</div>
	</div>
	<div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<div class="col-sm-4">
					<div class="mb-3">
						<?php echo Form::label('invoice_no', __('sale.invoice_no').':'); ?>

						<?php echo Form::text('invoice_no', !empty($sell->return_parent->invoice_no) ? $sell->return_parent->invoice_no : null, ['class' => 'form-control']); ?>

					</div>
				</div>
				<div class="col-sm-3">
					<div class="mb-3">
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
						<thead>
							<tr class="bg-green">
								<th>#</th>
								<th><?php echo app('translator')->get('product.product_name'); ?></th>
								<th><?php echo app('translator')->get('lang_v1.sell_quantity'); ?></th>
								<th><?php echo app('translator')->get('sale.unit_price'); ?></th>
								<th><?php echo app('translator')->get('sale.discount'); ?></th>
								<th><?php echo app('translator')->get('sale.unit_price_after_discount'); ?></th>
								<th><?php echo app('translator')->get('sale.tax'); ?></th>
								<th><?php echo app('translator')->get('sale.price_inc_tax'); ?></th>
								<th><?php echo app('translator')->get('lang_v1.return_quantity'); ?></th>
								<th><?php echo app('translator')->get('lang_v1.return_subtotal'); ?></th>
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
								<td>
									<?php echo e($sell_line->product->name, false); ?>

									<?php if( $sell_line->product->type == 'variable'): ?>
									- <?php echo e($sell_line->variations->product_variation->name, false); ?>

									- <?php echo e($sell_line->variations->name, false); ?>

									<?php endif; ?>
									<br>
									<?php echo e($sell_line->variations->sub_sku, false); ?>

								</td>
								<td><?php echo e($sell_line->formatted_qty, false); ?> <?php echo e($unit_name, false); ?></td>
								<td><span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->unit_price_before_discount, false); ?></span></td>
								<td>
									<?php if($sell_line->line_discount_type == 'fixed'): ?>
										<span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->line_discount_amount, false); ?></span>
									<?php elseif($sell_line->line_discount_type == 'percentage'): ?>
										<span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->unit_price_before_discount * ($sell_line->line_discount_amount/100), false); ?></span>
									<?php endif; ?>
								</td>
								<td><span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->unit_price, false); ?></span></td>
								<td>
									<span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->item_tax, false); ?></span>
								</td>
								<td><span class="display_currency" data-currency_symbol="true"><?php echo e($sell_line->unit_price_inc_tax, false); ?></td>
								<td>
									<input type="text" name="products[<?php echo e($loop->index, false); ?>][quantity]" value="<?php echo e(number_format($sell_line->quantity_returned, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" class="form-control input-sm input_number return_qty input_quantity" data-rule-abs_digit="<?php echo e($check_decimal, false); ?>" data-msg-abs_digit="<?php echo app('translator')->get('lang_v1.decimal_value_not_allowed'); ?>" data-rule-max-value="<?php echo e($sell_line->quantity, false); ?>" data-msg-max-value="<?php echo app('translator')->get('validation.custom-messages.quantity_not_available', ['qty' => $sell_line->formatted_qty, 'unit' => $unit_name ]); ?>">
									<input name="products[<?php echo e($loop->index, false); ?>][unit_price_inc_tax]" type="hidden" class="unit_price" value="<?php echo e(number_format($sell_line->unit_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
									<input name="products[<?php echo e($loop->index, false); ?>][sell_line_id]" type="hidden" value="<?php echo e($sell_line->id, false); ?>">
								</td>
								<td>
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
						<label for="sell_note">Note:</label>
						<textarea class="form-control" rows="3" name="sale_note" cols="50" value="<?php echo e($sell->return_payment->additional_notes, false); ?>"></textarea>
					</div>
				</div>
				<div class="col-md-6">
					<?php if(!empty($sell->return_parent->additional_notes)): ?>
						Existing Notes:<br>
						<?php echo e($sell->return_parent->additional_notes, false); ?>

					<?php endif; ?>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-4">
					<div class="mb-3">
						<?php echo Form::label('discount_type', __( 'purchase.discount_type' ) . ':'); ?>

						<?php echo Form::select('discount_type', [ '' => __('lang_v1.none'), 'fixed' => __( 'lang_v1.fixed' ), 'percentage' => __( 'lang_v1.percentage' )], $discount_type, ['class' => 'form-control']); ?>

					</div>
				</div>
				<div class="col-sm-4">
					<div class="mb-3">
						<?php echo Form::label('discount_amount', __( 'purchase.discount_amount' ) . ':'); ?>

						<?php echo Form::text('discount_amount', number_format($discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

					</div>
				</div>
			</div>
			<div class="row">
				<?php
				$discount_type = !empty($sell->return_parent->discount_type) ? $sell->return_parent->discount_type : $sell->discount_type;
				$discount_amount = !empty($sell->return_parent->discount_amount) ? $sell->return_parent->discount_amount : $sell->discount_amount;
				?>
				<div class="col-sm-4">
					<div class="mb-3">
						
						<?php echo Form::label('tax_rate_id', __('sale.order_tax') . ':*'); ?>

						<?php echo Form::select(
							'tax_rate_id',
							$taxes['tax_rates'],
							$sell->tax_id,
							['placeholder' => __('messages.please_select'), 'class' => 'form-control', 'data-default' => $default_sales_tax],
							$taxes['attributes'],
						); ?>

					</div>
				</div>
				
			</div>
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
				<div class="col-sm-12 text-right">
					<strong><?php echo app('translator')->get('lang_v1.total_return_discount'); ?>:</strong>
					&nbsp;(-) <span id="total_return_discount"></span>
				</div>
				<div class="col-sm-12 text-right">
					<strong><?php echo app('translator')->get('lang_v1.total_return_tax'); ?> - <span id='total_return_tax_name'>
						<?php if(!empty($sell->tax)): ?>(<?php echo e($sell->tax->name, false); ?> - 
						<?php if($sell->tax_type == 'fixed'): ?><?php echo e('Rs', false); ?><?php endif; ?> <?php echo e($sell->tax->amount, false); ?> <?php if($sell->tax_type == 'percentage'): ?><?php echo e('%', false); ?><?php endif; ?>)
						<?php endif; ?> : </span>
					</strong>
					&nbsp;(+) <span id="total_return_tax"></span>
				</div>
				<div class="col-sm-12 text-right">
					<strong><?php echo app('translator')->get('lang_v1.return_total'); ?>: </strong>&nbsp;
					<span id="net_return">0</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<button type="submit" id="submit_sell_return_form" class="btn btn-primary float-end"><?php echo app('translator')->get('messages.save'); ?></button>
				</div>
			</div>
		</div>
	</div>
	<?php echo Form::close(); ?>


</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/printer.js?v=' . $asset_v), false); ?>"></script>
<script src="<?php echo e(asset('js/sell_return.js?v=' . $asset_v), false); ?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('form#sell_return_form').validate();
		update_sell_return_total();
		//Date picker
		// $('#transaction_date').datepicker({
		//     autoclose: true,
		//     format: datepicker_date_format
		// });
	});
	$(document).on('change', 'input.return_qty, #discount_amount, #discount_type, #tax_rate_id', function() {
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

	function update_sell_return_total() {
		var net_return = 0;
		$('table#sell_return_table tbody tr').each(function() {
			var quantity = __read_number($(this).find('input.return_qty'));
			var unit_price = __read_number($(this).find('input.unit_price'));
			var subtotal = quantity * unit_price;
			$(this).find('.return_subtotal').text(__currency_trans_from_en(subtotal, true));
			net_return += subtotal;
		});
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
		if(tax_type == 'percentage'){
			$('span#total_return_tax_name').text('('+tax_name+' - '+tax_percent+'%)');
		}else if(tax_type == 'fixed'){
			$('span#total_return_tax_name').text('('+tax_name+' - Rs.'+tax_percent+')');
		}else if(tax_type == undefined){
			$('span#total_return_tax_name').text('('+tax_name+')');
		}
		
		$('span#total_return_discount').text(__currency_trans_from_en(discount, true));
		$('span#total_return_tax').text(__currency_trans_from_en(total_tax, true));
		$('span#net_return').text(__currency_trans_from_en(net_return_inc_tax, true));
	}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>