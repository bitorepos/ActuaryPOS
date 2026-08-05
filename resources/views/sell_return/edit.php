
<?php $__env->startSection('title', __('lang_v1.sell_return')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo app('translator')->get('lang_v1.sell_return'); ?></h1>
</section>

<!-- Main content -->
<section class="content no-print">

	<?php echo $__env->make('layouts.partials.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<?php $default_location = $sell_return->location->id; ?>

	<?php
		$custom_labels = json_decode(session('business.custom_labels'), true);
		// Phase 70: prefer controller-supplied per-branch common_settings; session is the fallback.
		$common_settings = isset($common_settings) && ! empty($common_settings)
			? $common_settings
			: session()->get('business.common_settings');
	?>
	<div class="row">
		<div class="col-sm-3">
			<div class="form-group mb-2">
				<input type="hidden" id="default_customer_id" value="<?php echo e($sell_return->contact->id, false); ?>" >
				<input type="hidden" id="default_customer_name" value="<?php echo e(!empty($sell_return->contact->name) ? $sell_return->contact->name : $sell_return->contact->supplier_business_name, false); ?>" >
				<input type="hidden" id="default_customer_credit_limit" value="<?php echo e($sell_return->contact->credit_limit ?? '', false); ?>" >
                                
				<?php echo Form::label('location_id', __('purchase.business_location').':*'); ?>

				<?php echo Form::select('location_id', $business_locations, $default_location, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 
				'id' => 'select_location_id', 'style' => 'width: 80%;', 'disabled']); ?>

			</div>
		</div>
		<input type="hidden" id='sale_return_edit' value="0">
	</div>
	
	<?php echo Form::open(['url' => action([\App\Http\Controllers\SellReturnController::class, 'save']), 'method' => 'post', 'id' => 'sell_return_form' ]); ?>

	
	<div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<?php echo Form::hidden('location_id', $sell_return->location->id, ['id' => 'location_id', 'data-default_payment_accounts' => $sell_return->location->default_payment_accounts, 'data-payment_labels' => json_encode($sell_return->location->loc_settings['payment_labels'] ?? [])]); ?>

				<?php echo Form::hidden('transaction_id', $sell_return->id, ['id' => 'transaction_id']); ?>


				<div class="col-sm-3">
					<div class="form-group mb-2">
						<?php echo Form::label('contact_id', __('contact.customer') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-text">
								<i class="fa fa-user"></i>
							</span>
							<?php echo Form::select('contact_id', [], null, ['class' => 'form-control', 'style' => 'width: 80%;', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required']); ?>

							<?php echo Form::hidden('customer_group_id', $sell_return->customer_group_id, ['id' => 'hidden_customer_group_id', ]); ?>

						</div>
						<small class="text-danger hide contact_due_text"><strong><?php echo app('translator')->get('account.customer_due'); ?>:</strong> <span></span></small>
						<br>
						<small class="text-blue hide contact_credit_limit_text"><strong><?php echo app('translator')->get('account.available_credit'); ?>:</strong> <span></span></small>
					</div>
				</div>
				<?php if(!empty($price_groups)): ?>
					<div class="col-sm-3">
						<div class="form-group mb-2">
							<?php echo Form::label('price_group', __('lang_v1.selling_price_group') . ':*'); ?>

							<div class="input-group">
								<span class="input-group-text">
									<i class="fas fa-money-bill-alt"></i>
								</span>
								<?php echo Form::hidden('hidden_price_group', $sell_return->selling_price_group_id, ['id' => 'hidden_price_group']); ?>

								<?php echo Form::select('price_group', $price_groups, $sell_return->selling_price_group_id, [
									'class' => 'form-control select2',
									'id' => 'price_group',
									'style' => 'width: 70%;'
								]); ?>

								<span class="input-group-text">
									<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.price_group_help_text') . '"></i>';
                }
            ?>
								</span>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<div class="col-sm-3">
					<div class="form-group mb-2">
						<?php echo Form::label('invoice_no', __('purchase.ref_no').':'); ?>

						<?php echo Form::text('invoice_no', $sell_return->invoice_no, ['class' => 'form-control', empty($user_settings['enable_sale_invoice_no']) ? 'readonly' : '',]); ?>

						<b id="invoice_no_error" class="error hide"><?php echo app('translator')->get('lang_v1.not_unique', ['name' => __('purchase.ref_no') ]); ?></b>
					</div>
				</div>

				<div class="col-sm-3">
					<div class="form-group mb-2">
						<?php echo Form::label('transaction_date', __('sale.sale_date') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-text">
								<i class="fa fa-calendar"></i>
							</span>
							<?php echo Form::text('transaction_date', \Carbon::createFromTimestamp(strtotime($sell_return->transaction_date))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required']); ?>

						</div>
					</div>
				</div>
				<?php if(!empty($commission_agent)): ?>
					<?php
						$is_commission_agent_required = !empty($pos_settings['is_commission_agent_required']);
					?>
					<div class="col-sm-3">
						<div class="form-group mb-2">
							<?php echo Form::label('commission_agent', __('lang_v1.commission_agent') . ':'); ?>

							<?php echo Form::select('commission_agent', $commission_agent, $sell_return->commission_agent, [
								'class' => 'form-control select2',
								'id' => 'commission_agent',
								'required' => $is_commission_agent_required, 'style' => 'width: 80%;'
							]); ?>

						</div>
					</div>
				<?php endif; ?>
				<div class="clearfix"></div>
				<?php
			        $custom_field_1_label = !empty($custom_labels['sell']['custom_field_1']) ? $custom_labels['sell']['custom_field_1'] : '';

			        $is_custom_field_1_required = !empty($custom_labels['sell']['is_custom_field_1_required']) && $custom_labels['sell']['is_custom_field_1_required'] == 1 ? true : false;

			        $custom_field_2_label = !empty($custom_labels['sell']['custom_field_2']) ? $custom_labels['sell']['custom_field_2'] : '';

			        $is_custom_field_2_required = !empty($custom_labels['sell']['is_custom_field_2_required']) && $custom_labels['sell']['is_custom_field_2_required'] == 1 ? true : false;

			        $custom_field_3_label = !empty($custom_labels['sell']['custom_field_3']) ? $custom_labels['sell']['custom_field_3'] : '';

			        $is_custom_field_3_required = !empty($custom_labels['sell']['is_custom_field_3_required']) && $custom_labels['sell']['is_custom_field_3_required'] == 1 ? true : false;

			        $custom_field_4_label = !empty($custom_labels['sell']['custom_field_4']) ? $custom_labels['sell']['custom_field_4'] : '';

			        $is_custom_field_4_required = !empty($custom_labels['sell']['is_custom_field_4_required']) && $custom_labels['sell']['is_custom_field_4_required'] == 1 ? true : false;

			        $custom_field_5_label = !empty($custom_labels['sell']['custom_field_5']) ? $custom_labels['sell']['custom_field_5'] : '';

			        $is_custom_field_5_required = !empty($custom_labels['sell']['is_custom_field_5_required']) && $custom_labels['sell']['is_custom_field_5_required'] == 1 ? true : false;

			        $custom_field_6_label = !empty($custom_labels['sell']['custom_field_6']) ? $custom_labels['sell']['custom_field_6'] : '';

			        $is_custom_field_6_required = !empty($custom_labels['sell']['is_custom_field_6_required']) && $custom_labels['sell']['is_custom_field_6_required'] == 1 ? true : false;

			        $custom_field_7_label = !empty($custom_labels['sell']['custom_field_7']) ? $custom_labels['sell']['custom_field_7'] : '';

			        $is_custom_field_7_required = !empty($custom_labels['sell']['is_custom_field_7_required']) && $custom_labels['sell']['is_custom_field_7_required'] == 1 ? true : false;

			        $custom_field_8_label = !empty($custom_labels['sell']['custom_field_8']) ? $custom_labels['sell']['custom_field_8'] : '';

			        $is_custom_field_8_required = !empty($custom_labels['sell']['is_custom_field_8_required']) && $custom_labels['sell']['is_custom_field_8_required'] == 1 ? true : false;
		        ?>
		        <?php if(!empty($custom_field_1_label)): ?>
		        	<?php
		        		$label_1 = $custom_field_1_label . ':';
		        		if($is_custom_field_1_required) {
		        			$label_1 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group mb-2">
				            <?php echo Form::label('custom_field_1', $label_1 ); ?>

				            <?php echo Form::text('custom_field_1', $sell_return->custom_field_1, ['class' => 'form-control','placeholder' => $custom_field_1_label, 'required' => $is_custom_field_1_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_2_label)): ?>
		        	<?php
		        		$label_2 = $custom_field_2_label . ':';
		        		if($is_custom_field_2_required) {
		        			$label_2 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group mb-2">
				            <?php echo Form::label('custom_field_2', $label_2 ); ?>

				            <?php echo Form::text('custom_field_2', $sell_return->custom_field_2, ['class' => 'form-control','placeholder' => $custom_field_2_label, 'required' => $is_custom_field_2_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_3_label)): ?>
		        	<?php
		        		$label_3 = $custom_field_3_label . ':';
		        		if($is_custom_field_3_required) {
		        			$label_3 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group mb-2">
				            <?php echo Form::label('custom_field_3', $label_3 ); ?>

				            <?php echo Form::text('custom_field_3', $sell_return->custom_field_3, ['class' => 'form-control','placeholder' => $custom_field_3_label, 'required' => $is_custom_field_3_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_4_label)): ?>
		        	<?php
		        		$label_4 = $custom_field_4_label . ':';
		        		if($is_custom_field_4_required) {
		        			$label_4 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
				        <div class="form-group mb-2">
				            <?php echo Form::label('custom_field_4', $label_4 ); ?>

				            <?php echo Form::text('custom_field_4', $sell_return->custom_field_4, ['class' => 'form-control','placeholder' => $custom_field_4_label, 'required' => $is_custom_field_4_required]); ?>

				        </div>
				    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_5_label)): ?>
		        	<?php
		        		$label_5 = $custom_field_5_label . ':';
		        		if($is_custom_field_5_required) {
		        			$label_5 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
			        <div class="form-group">
			            <?php echo Form::label('custom_field_5', $label_5 ); ?>

			            <?php echo Form::text('custom_field_5', $sell_return->custom_field_5, ['class' => 'form-control','placeholder' => $custom_field_5_label, 'required' => $is_custom_field_5_required]); ?>

			        </div>
			    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_6_label)): ?>
		        	<?php
		        		$label_6 = $custom_field_6_label . ':';
		        		if($is_custom_field_6_required) {
		        			$label_6 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
			        <div class="form-group">
			            <?php echo Form::label('custom_field_6', $label_6 ); ?>

			            <?php echo Form::text('custom_field_6', $sell_return->custom_field_6, ['class' => 'form-control','placeholder' => $custom_field_6_label, 'required' => $is_custom_field_6_required]); ?>

			        </div>
			    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_7_label)): ?>
		        	<?php
		        		$label_7 = $custom_field_7_label . ':';
		        		if($is_custom_field_7_required) {
		        			$label_7 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
			        <div class="form-group">
			            <?php echo Form::label('custom_field_7', $label_7 ); ?>

			            <?php echo Form::text('custom_field_7', $sell_return->custom_field_7, ['class' => 'form-control','placeholder' => $custom_field_7_label, 'required' => $is_custom_field_7_required]); ?>

			        </div>
			    </div>
		        <?php endif; ?>
		        <?php if(!empty($custom_field_8_label)): ?>
		        	<?php
		        		$label_8 = $custom_field_8_label . ':';
		        		if($is_custom_field_8_required) {
		        			$label_8 .= '*';
		        		}
		        	?>

		        	<div class="col-md-6">
			        <div class="form-group">
			            <?php echo Form::label('custom_field_8', $label_8 ); ?>

			            <?php echo Form::text('custom_field_8', $sell_return->custom_field_8, ['class' => 'form-control','placeholder' => $custom_field_8_label, 'required' => $is_custom_field_8_required]); ?>

			        </div>
			    </div>
		        <?php endif; ?>
				<div class="clearfix"></div>
				
			</div>
		</div>
	</div> <!--box end-->

	<div class="box box-primary"><!--box start-->
		<div class="box-body">
			<div class="row">
				<div class="col-sm-8 offset-sm-2">
					<div class="form-group mb-2">
						<div class="input-group">
							
								<button type="button" class="btn btn-info bg-white btn-flat" id="open_products_search_modal" title="<?php echo e(__('lang_v1.products_search'), false); ?>"><i class="fas fa-search"></i></button>
							
							<?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product_sale_return', 
								'placeholder' => __('lang_v1.search_product_placeholder'),
								'disabled' => is_null($default_location)? true : false,
								'autofocus' => is_null($default_location)? false : true,
								]); ?>

						</div>
					</div>
				</div>
			</div>
			<?php
				$hide_tax = '';
				if( session()->get('business.enable_inline_tax') == 0){
					$hide_tax = 'hide';
				}
			?>

			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
						<table class="table table-condensed table-bordered table-th-skin table-striped" id="sale_return_entry_table">
							<?php
							$hide_discount = '';
							if (session()->get('business.common_settings.enable_inline_discount_sales') == 0) {
								$hide_discount = 'hide';
							}
							$hide_discount2 = '';
							if (empty($common_settings['enable_inline_discount2_sales'])) {
								$hide_discount2 = 'hide';
							}
							$hide_tax = '';
							if (session()->get('business.common_settings.enable_inline_tax_sales') == 0 || $taxes['tax_rates']->count() <= 1) {
								$hide_tax = 'hide';
							}
							?>
							<thead>
								<tr>
									<th style="width:1%" class="text-nowrap">#</th>
									<th style="width:1%" class="text-nowrap"><?php echo app('translator')->get('product.sku'); ?></th>
									<th style="width:100%"><?php echo app('translator')->get('product.product_name'); ?></th>
									
									<th class="text-nowrap text-end"><?php echo app('translator')->get('sale.unit_price'); ?> <span class="badge bg-info" style="font-size:10px"><?php echo e(session('currency')['symbol'] ?? '', false); ?></span></th>
									<th class="text-nowrap <?php echo e($hide_discount, false); ?>"><?php echo app('translator')->get('sale.discount'); ?></th>
									<th class="text-nowrap <?php echo e($hide_discount2, false); ?>"><?php echo app('translator')->get('sale.discount'); ?> 2</th>
									<th class="text-nowrap text-end <?php echo e($hide_discount, false); ?>"><?php echo app('translator')->get('sale.unit_price_after_discount'); ?> <span class="badge bg-info" style="font-size:10px"><?php echo e(session('currency')['symbol'] ?? '', false); ?></span></th>
									<th class="text-nowrap <?php echo e($hide_tax, false); ?>"><?php echo app('translator')->get('sale.tax'); ?></th>
									<th class="text-nowrap text-end <?php echo e($hide_tax, false); ?>"><?php echo app('translator')->get('sale.price_inc_tax'); ?> <span class="badge bg-info" style="font-size:10px"><?php echo e(session('currency')['symbol'] ?? '', false); ?></span></th>
									<th class="text-nowrap"><?php echo app('translator')->get('lang_v1.status'); ?></th>
									<th class="text-nowrap"><?php echo app('translator')->get('lang_v1.return_quantity'); ?></th>
									<th class="text-nowrap text-end"><?php echo app('translator')->get('lang_v1.return_subtotal'); ?> <span class="badge bg-info" style="font-size:10px"><?php echo e(session('currency')['symbol'] ?? '', false); ?></span></th>
									<th style="width:1%"></th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $sell_return->sell_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php echo $__env->make('sell_return.partials.product_row', [
										'product' => $sl,
										'row_count' => $loop->index,
										'edit' => true,
										'tax_dropdown'=> $taxes,
									], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									<?php
										$row_index = $loop->iteration;
									?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>
					<hr/>
					<div class="row">
					<div class="col-md-3">
						<table class="float-end col-md-12">
							<tr>
								<th class="col-md-7 text-right"><?php echo app('translator')->get('lang_v1.total_quantity'); ?>:</th>
								<td class="col-md-5 text-left">
									<span id="quantity_total" class="display_currency quantity_total" data-currency_symbol="false"></span>
								</td>
							</tr>
						</table>
					</div>
					<div class="col-md-3">
						<table class="float-end col-md-12">		
							<tr class="">
								<th class="col-md-7 text-right"><?php echo app('translator')->get('purchase.discount'); ?>:</th>
								<td class="col-md-5 text-left">
									<span id="discount_total" class="display_currency discount_total"></span>
								</td>
							</tr>
						</table>
					</div>
					<div class="col-md-3">
						<table class="float-end col-md-12">
							<tr>
								<th class="col-md-7 text-right">Total Tax:</th>
								<td class="col-md-5 text-left">
									<span id="tax_total" class="display_currency tax_total" data-currency_symbol="false"></span>
								</td>
							</tr>
						</table>
					</div>
					<div class="col-md-3">
						<table class="float-end col-md-12">
							<tr>
								<th class="col-md-7 text-right"><?php echo app('translator')->get('purchase.net_total_amount'); ?>:</th>
								<td class="col-md-5 text-left">
									<span id="total_subtotal" class="display_currency price_total"></span>
									<!-- This is total before purchase tax-->
									<input type="hidden" id="total_subtotal_input" value=0 name="total_before_tax">
								</td>
							</tr>
						</table>
					</div>
					<div class="float-end col-md-5">
						<input type="hidden" id="product_row_index" value=<?php echo e($row_index, false); ?>>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div><!--box end-->
	<div class="box box-primary"><!--box start-->
		<div class="box-body">
			<div class="row">
				<div class="col-sm-12">
				<table class="table">
					<?php if(!empty($common_settings['enable_total_discount_sale'])): ?>
					<tr>
						<td class="col-md-3">
							<div class="form-group mb-2">
								<?php echo Form::label('discount_type', __( 'purchase.discount_type' ) . ':'); ?>

								<?php echo Form::select('discount_type', [ '' => __('lang_v1.none'), 'fixed' => __( 'lang_v1.fixed' ), 'percentage' => __( 'lang_v1.percentage' )], $sell_return->discount_type, ['class' => 'form-select']); ?>

							</div>
						</td>
						<td class="col-md-3">
							<div class="form-group mb-2">
							<?php echo Form::label('discount_amount', __( 'purchase.discount_amount' ) . ':'); ?>

							<?php echo Form::text('discount_amount', number_format($sell_return->discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'required']); ?>

							</div>
						</td>
						<td class="col-md-3">
							&nbsp;
						</td>
						<td class="col-md-3">
							<b><?php echo app('translator')->get( 'purchase.discount' ); ?>:</b>(-) 
							<span id="total_discount" class="display_currency"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_return->discount_amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
						</td>
					</tr>
					<?php endif; ?>
					<?php if(!empty($common_settings['enable_total_tax_sale'])): ?>
					<?php
						$default_sales_tax = $sell_return->tax_id;
					?>
					<tr>
						<td class="col-md-3">
							<?php echo Form::label('tax_rate_id', __('sale.order_tax') . ':*'); ?>

							<?php echo Form::select(
								'tax_rate_id',
								$taxes['tax_rates'],
								$default_sales_tax,
								['class' => 'form-select'],
								$taxes['attributes'],
							); ?>

						</td>
						<td class="col-md-3">
							&nbsp;
						</td>
						<td class="col-md-3">
							&nbsp;
						</td>
						<td class="col-md-3">
							<b><?php echo app('translator')->get( 'sale.tax' ); ?>:</b>(-) 
							<span id="total_tax" class="display_currency"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_return->tax_amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
						</td>
					</tr>
					<?php endif; ?>
					<tr>
						<td colspan="2">
							<div class="form-group mb-2">
								<?php echo Form::label('sell_note',__('sale.sell_note')); ?>

								<a href="javascript:void(0)" class="toggle-note">
									<i class="fa <?php echo e(!empty($sell_return->additional_notes) ? 'fa-minus-circle text-danger' : 'fa-plus-circle text-success', false); ?>"></i>
								</a>
								<div class="note-wrapper" style="<?php echo e(empty($sell_return->additional_notes) ? 'display:none;' : '', false); ?>">
									<?php echo Form::textarea('sell_note', $sell_return->additional_notes, ['class' => 'form-control', 'rows' => 3]); ?>

								</div>
							</div>
						</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>
							<?php echo Form::hidden('final_total', 0 , ['id' => 'final_total_input']); ?>

							<b><?php echo app('translator')->get('lang_v1.total_credit_amt'); ?>: </b><span id="total_payable" class="display_currency" data-currency_symbol='true'><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sell_return->final_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
						</td>
					</tr>
					

				</table>
				</div>
			</div>
		</div>
		<?php if(auth()->user()->can('sell_return.payments') || auth()->user()->can('sell.payments')): ?>
		<?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('purchase.add_payment')]); ?>
		<div class="row">
			<div class="payment_row" id="payment_rows_div">
			<?php $__currentLoopData = $payment_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($payment_line['is_return'] == 1): ?>
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
		<div class="row">
		<div class="col-sm-12 text-center">
			<?php echo Form::hidden('is_save_and_print', 0, ['id' => 'is_save_and_print']); ?>

		</div>
		</div>

	</div><!--box end-->
<?php echo Form::close(); ?>

</section>
    
<!-- /.content -->
<?php echo $__env->make('sell.partials.sell_keyboard_shortcuts_help_modal', ['is_sell_return_page' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('js/sell_return.js?v=' . $asset_v), false); ?>"></script>
	<?php echo $__env->make('sell_return.partials.sell_return_keyboard_shortcuts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<script>
		update_table_sr_number();
		$(document).ready(function() {
			update_table_total();
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>